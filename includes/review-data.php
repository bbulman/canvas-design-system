<?php
/**
 * The review page's data: the guard that keeps it on the local dev server, the
 * queue (review.json) and suggestions (suggestions.json) the enforcer writes, and
 * the component renders.
 *
 * Nothing here loads config.php, shared-auth.php or db.php: the local .env points
 * at the production database. A file under design-system/ can reach the host by
 * FTP, so the guard refuses any server but PHP's built-in one on a loopback
 * address, and every change also needs this page's own Origin.
 *
 * The Node side (gate/queue.mjs) writes review.json under a directory lock beside
 * it; writes here take the same lock and go through a temp file and rename.
 * dsReviewComponentHtml() needs icon.php, includes/components/helpers.php and
 * playground-fixtures.php loaded first.
 */

const DS_REVIEW_DECISIONS = ['use-component', 'keep', 'later', 'undo', 'fine', 'should-become'];

/* Which decisions each kind of case can take; anything else is refused. */
const DS_REVIEW_KIND_DECISIONS = [
    'kept' => ['use-component', 'keep', 'later'],
    'unconsulted' => ['use-component', 'keep', 'later'],
    'nothing-fitting' => ['fine', 'should-become'],
    'swapped-automatically' => ['undo'],
];

/* The lock is shared with gate/settings.mjs: the same wait cap and stale age. */
const DS_REVIEW_LOCK_WAIT_MS = 200;
const DS_REVIEW_LOCK_STALE_S = 2;

function dsReviewRoot(): string
{
    return dirname(__DIR__, 2);
}

function dsReviewAllowed(): bool
{
    if (php_sapi_name() !== 'cli-server') return false;
    if (!in_array($_SERVER['REMOTE_ADDR'] ?? '', ['127.0.0.1', '::1', '::ffff:127.0.0.1'], true)) return false;
    return (bool) preg_match('/^(localhost|127\.0\.0\.1)(:\d+)?$/D', (string) ($_SERVER['HTTP_HOST'] ?? ''));
}

/** A browser sends Origin with every POST; another site's form or script carries its own. */
function dsReviewPostAllowed(): bool
{
    return dsReviewAllowed() && ($_SERVER['HTTP_ORIGIN'] ?? null) === 'http://' . $_SERVER['HTTP_HOST'];
}

/** DS_REVIEW_DIR, else the Node side's DS_ENFORCER_STATE_DIR, else .ds-enforcer; a relative path is from the repo root. */
function dsReviewDir(): string
{
    foreach (['DS_REVIEW_DIR', 'DS_ENFORCER_STATE_DIR'] as $name) {
        $dir = getenv($name);
        if (is_string($dir) && $dir !== '') return str_starts_with($dir, '/') ? rtrim($dir, '/') : dsReviewRoot() . '/' . rtrim($dir, '/');
    }
    return dsReviewRoot() . '/.ds-enforcer';
}

/**
 * The cases and the suggestions still on offer (not dismissed), the strongest
 * first. 'suggestions' are the ones at or over the page bar the scan stores
 * (minPages) and the ones Bill asked for; 'underBar' are hand-written on fewer
 * pages, so harvest neither emails nor builds them yet. 'problems' names a state
 * file that exists but could not be read, so the page can say so instead of
 * showing an empty queue.
 */
function dsReviewLoad(): array
{
    $problems = [];
    $queue = dsReviewRead('review.json', $problems);
    $cases = array_values(array_filter((array) ($queue['cases'] ?? []), fn($c) => is_array($c) && is_string($c['id'] ?? null)));

    $stored = dsReviewRead('suggestions.json', $problems);
    $dismissed = array_filter((array) ($stored['dismissed'] ?? []), 'is_string');
    $build = array_filter((array) ($stored['build'] ?? []), 'is_string');
    $minPages = is_int($stored['minPages'] ?? null) ? $stored['minPages'] : 0;
    $suggestions = [];
    $underBar = [];
    foreach ((array) ($stored['entries'] ?? []) as $entry) {
        if (!is_array($entry) || !is_string($entry['id'] ?? null) || in_array($entry['id'], $dismissed, true)) continue;
        $entry['onBuildList'] = in_array($entry['id'], $build, true);
        // An entry written before the scan stored page counts has none, and stays on offer.
        $below = is_int($entry['pages'] ?? null) && $entry['pages'] < $minPages
            && !in_array('bill', (array) ($entry['sources'] ?? []), true);
        if ($below) $underBar[] = $entry;
        else $suggestions[] = $entry;
    }
    $strongest = fn($a, $b) => (int) ($b['count'] ?? 0) <=> (int) ($a['count'] ?? 0);
    usort($suggestions, $strongest);
    usort($underBar, $strongest);

    return ['cases' => $cases, 'suggestions' => $suggestions, 'underBar' => $underBar, 'minPages' => $minPages, 'problems' => $problems];
}

/** The decoded file, [] when it does not exist yet, or [] plus a problem when it cannot be read. */
function dsReviewRead(string $name, array &$problems): array
{
    $path = dsReviewDir() . '/' . $name;
    if (!is_file($path)) return [];
    $raw = @file_get_contents($path);
    $data = is_string($raw) ? json_decode($raw, true) : null;
    if (is_array($data)) return $data;
    if (trim((string) $raw) !== '') $problems[] = $name;
    return [];
}

/**
 * Record Bill's decision on an open case. $chosen names the candidate he picked
 * when the decision is use-component. False when the id, the decision or the
 * candidate does not fit the case, or nothing could be written.
 */
function dsReviewDecide(string $id, string $decision, ?string $chosen = null): bool
{
    if (!preg_match('/^C-[0-9a-f]{6}$/D', $id) || !in_array($decision, DS_REVIEW_DECISIONS, true)) return false;
    return dsReviewChange('review.json', 'review.lock', function (object $queue) use ($id, $decision, $chosen): bool {
        foreach (is_array($queue->cases ?? null) ? $queue->cases : [] as $case) {
            if (!is_object($case) || ($case->id ?? null) !== $id) continue;
            $kind = (string) ($case->kind ?? 'kept');
            if (!in_array($decision, DS_REVIEW_KIND_DECISIONS[$kind] ?? [], true)) return false;
            // A swap the agent already made can still be undone; anything else must be open.
            $status = $case->status ?? null;
            if (!($status === 'open' || ($kind === 'swapped-automatically' && $status === 'applied'))) return false;
            if ($decision === 'use-component') {
                $helpers = array_values(array_filter(array_map(fn($c) => dsReviewCandidate($c)['helper'] ?? null, (array) ($case->candidates ?? []))));
                if (!$helpers || ($chosen !== null && !in_array($chosen, $helpers, true))) return false;
                $case->chosen = $chosen ?? $helpers[0];
            }
            $case->decision = $decision;
            return true;
        }
        return false;
    });
}

/** Mark the automatic swaps Bill has now been shown. */
function dsReviewMarkSeen(array $ids): void
{
    $ids = array_values(array_filter($ids, fn($id) => is_string($id) && preg_match('/^C-[0-9a-f]{6}$/D', $id)));
    if (!$ids) return;
    dsReviewChange('review.json', 'review.lock', function (object $queue) use ($ids): bool {
        $changed = false;
        foreach (is_array($queue->cases ?? null) ? $queue->cases : [] as $case) {
            if (!is_object($case) || !in_array($case->id ?? null, $ids, true)) continue;
            if (($case->kind ?? null) !== 'swapped-automatically' || ($case->seen ?? false) === true) continue;
            $case->seen = true;
            $changed = true;
        }
        return $changed;
    });
}

/** Dismiss a suggestion (it never returns) or put it on the build list. */
function dsReviewSuggestion(string $id, string $verdict): bool
{
    if (!preg_match('/^S-[0-9a-f]{6}$/D', $id) || !in_array($verdict, ['dismiss', 'build'], true)) return false;
    return dsReviewChange('suggestions.json', 'suggestions.lock', function (object $stored) use ($id, $verdict): bool {
        $entries = is_array($stored->entries ?? null) ? $stored->entries : [];
        $known = array_filter($entries, fn($e) => is_object($e) && ($e->id ?? null) === $id);
        if (!$known) return false;
        $list = $verdict === 'dismiss' ? 'dismissed' : 'build';
        $ids = is_array($stored->$list ?? null) ? $stored->$list : [];
        if (!in_array($id, $ids, true)) $ids[] = $id;
        $stored->$list = $ids;
        if ($verdict === 'dismiss') $stored->entries = array_values(array_filter($entries, fn($e) => !is_object($e) || ($e->id ?? null) !== $id));
        return true;
    });
}

/**
 * Read, change and write one state file under its lock. The file is decoded to
 * objects so an empty {} stays an object for the Node side. A file that is
 * missing or cannot be parsed is never written: it may be the only copy of the
 * queue. $change returns whether it changed anything.
 */
function dsReviewChange(string $name, string $lockName, callable $change): bool
{
    $dir = dsReviewDir();
    return dsReviewWithLock($dir . '/' . $lockName, function () use ($dir, $name, $change): bool {
        $path = $dir . '/' . $name;
        $raw = is_file($path) ? @file_get_contents($path) : false;
        $data = is_string($raw) ? json_decode($raw) : null;
        if (!is_object($data) || !$change($data)) return false;
        return dsReviewWriteAtomic($path, $data);
    });
}

/** The temp file sits beside the target: rename is only atomic within one filesystem. */
function dsReviewWriteAtomic(string $path, object $data): bool
{
    try {
        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRESERVE_ZERO_FRACTION | JSON_THROW_ON_ERROR);
    } catch (JsonException) {
        return false;
    }
    // Node writes two-space indentation; JSON strings never hold a raw newline, so only indentation starts a line.
    $json = preg_replace_callback('/^(?: {4})+/m', fn($m) => str_repeat('  ', intdiv(strlen($m[0]), 4)), $json) . "\n";
    $tmp = dirname($path) . '/.' . basename($path) . '.' . getmypid() . '.' . bin2hex(random_bytes(4)) . '.tmp';
    if (@file_put_contents($tmp, $json) !== strlen($json) || !@rename($tmp, $path)) {
        @unlink($tmp);
        return false;
    }
    return true;
}

/**
 * Run $fn holding the directory lock at $lockPath. mkdir is an exclusive create;
 * a lock older than the stale age belongs to a killed process. After the wait cap
 * it proceeds unlocked, as the Node side does.
 */
function dsReviewWithLock(string $lockPath, callable $fn)
{
    $held = false;
    $start = microtime(true);
    while (is_dir(dirname($lockPath))) {
        if (@mkdir($lockPath)) { $held = true; break; }
        if ((microtime(true) - $start) * 1000 >= DS_REVIEW_LOCK_WAIT_MS) break;
        clearstatcache(true, $lockPath);
        if (!is_dir($lockPath)) continue;  // released between the mkdir and this check
        $mtime = @filemtime($lockPath);
        if ($mtime !== false && time() - $mtime > DS_REVIEW_LOCK_STALE_S) { @rmdir($lockPath); continue; }
        usleep(3000);
    }
    try {
        return $fn();
    } finally {
        if ($held) @rmdir($lockPath);
    }
}

/** A case's candidate as ['helper' => name, 'args' => ...], from a { helper, args? } object or a bare name. */
function dsReviewCandidate($candidate): array
{
    if (is_object($candidate)) $candidate = json_decode((string) json_encode($candidate), true);
    if (is_string($candidate)) $candidate = ['helper' => $candidate];
    if (!is_array($candidate) || !is_string($candidate['helper'] ?? null) || !preg_match('/^ws_[a-z0-9_]+$/D', $candidate['helper'])) return [];
    return $candidate;
}

/**
 * The helper's markup, or null when the helper is not in the catalogue, is an end
 * helper, is one the playground refuses (dsPlaygroundSkipReason, which includes
 * dsPlaygroundDatabaseRisk) or fails with these arguments. Arguments
 * are data only: a nested helper call in them is dropped, never run.
 */
function dsReviewComponentHtml(array $candidate): ?string
{
    $call = dsReviewCall($candidate);
    if ($call === null) return null;
    // The page is itself built with ws_* helpers, whose open stacks, cards and tab panels
    // live in $GLOBALS['_ws_*']; a start helper rendered here must not close one of the page's.
    $saved = array_filter($GLOBALS, fn($key) => is_string($key) && str_starts_with($key, '_ws_'), ARRAY_FILTER_USE_KEY);
    $level = ob_get_level();
    try {
        $html = dsPlaygroundValue($call);
    } catch (Throwable) {
        $html = null;
    } finally {
        // A start helper (ws_tab_panel_start) leaves its own buffer open.
        while (ob_get_level() > $level) ob_end_clean();
        foreach (array_keys($GLOBALS) as $key) {
            if (is_string($key) && str_starts_with($key, '_ws_') && !array_key_exists($key, $saved)) unset($GLOBALS[$key]);
        }
        foreach ($saved as $key => $value) $GLOBALS[$key] = $value;
    }
    return is_string($html) ? $html : null;
}

/** Page stylesheets a case names, as site paths: project-relative .css files that exist. */
function dsReviewStylesheets(array $case): array
{
    $out = [];
    foreach ((array) ($case['stylesheets'] ?? []) as $path) {
        if (!is_string($path) || !preg_match('#^[A-Za-z0-9_][A-Za-z0-9/_.-]*\.css$#D', $path) || str_contains($path, '..')) continue;
        if (is_file(dsReviewRoot() . '/' . $path) && !in_array('/' . $path, $out, true)) $out[] = '/' . $path;
    }
    return $out;
}

/* Folders a frame may load anything from: they hold only static files. */
const DS_REVIEW_FRAME_STATIC = ['/images/', '/css/'];
/* The stylesheets every frame loads, named one by one: their folders also hold PHP that runs on a GET. */
const DS_REVIEW_FRAME_SHEETS = ['/design-system/platform-tokens.css', '/includes/components/components.css', '/design-system/assets/review.css'];

/**
 * An iframe that renders $body as a document of its own. sandbox="" runs no script,
 * submits no form and cannot reach this page. The policy keeps it to static files: the
 * folders in DS_REVIEW_FRAME_STATIC, the frame's own stylesheets and the fonts. Any other
 * path on the dev server can be a PHP page, and admin/tools/ scripts run against the
 * production database on a plain GET, which an agent's <img> or <link> would send.
 */
function dsReviewFrame(string $title, string $body, array $stylesheets = []): string
{
    $host = 'http://' . ($_SERVER['HTTP_HOST'] ?? '127.0.0.1');
    // Only plain site paths to a .css file can name a source in the policy.
    $sheets = array_values(array_unique(array_filter(array_merge(DS_REVIEW_FRAME_SHEETS, $stylesheets), fn($href) => is_string($href) && preg_match('#^/[A-Za-z0-9_][A-Za-z0-9/_.-]*\.css$#D', $href) && !str_contains($href, '..'))));
    $static = implode(' ', array_map(fn($dir) => $host . $dir, DS_REVIEW_FRAME_STATIC));
    $styles = implode(' ', array_map(fn($href) => $host . $href, $sheets));
    $head = '<meta charset="UTF-8">'
        . '<meta http-equiv="Content-Security-Policy" content="default-src \'none\'; style-src \'unsafe-inline\' ' . $static . ' ' . $styles . ' https://fonts.googleapis.com; font-src ' . $static . ' https://fonts.gstatic.com; img-src ' . $static . ' data:">'
        . '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fraunces:wght@400;600;700&amp;family=Inter:wght@400;500;600;700&amp;family=Material+Symbols+Outlined&amp;display=swap">';
    foreach ($sheets as $href) {
        $head .= '<link rel="stylesheet" href="' . htmlspecialchars($href, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '">';
    }
    $doc = '<!DOCTYPE html><html lang="en"><head>' . $head . '</head><body class="review-frame">' . $body . '</body></html>';
    // Lazy: most frames sit in a closed tab or further down a list.
    return '<iframe class="review-frame-box" sandbox="" loading="lazy" title="' . htmlspecialchars($title, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')
        . '" srcdoc="' . htmlspecialchars($doc, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '"></iframe>';
}

/** The helper call as the page shows it, or null when it cannot be rendered. */
function dsReviewComponentCode(array $candidate): ?string
{
    $call = dsReviewCall($candidate);
    if ($call === null) return null;
    $void = (string) (new ReflectionFunction($call['__call']))->getReturnType() === 'void';
    $php = dsPlaygroundExport($call);
    return $void ? "<?php $php; ?>" : "<?= $php ?>";
}

/** The catalogue's playground preview for the helper, or null. */
function dsReviewPreviewUrl(string $helper): ?string
{
    $url = function_exists('dsPlaygroundCatalog') ? (dsPlaygroundCatalog()[$helper]['preview'] ?? null) : null;
    return is_string($url) && str_starts_with($url, '/design-system/components/playground.php?') ? $url : null;
}

/** dsPlaygroundCall() for a candidate the playground can render here, or null. */
function dsReviewCall(array $candidate): ?array
{
    $candidate = dsReviewCandidate($candidate);
    if (!$candidate || !function_exists('dsPlaygroundSkipReason')) return null;
    $helper = $candidate['helper'];
    // An end helper closes the block its start opened: here that would be the page's own open tab panel or stack.
    if (str_ends_with($helper, '_end')) return null;
    $entry = dsPlaygroundCatalog()[$helper] ?? null;
    // The playground's own refusals: a source that could reach the database (dsPlaygroundDatabaseRisk),
    // an app-local helper, one that returns data, or one with no plain source path.
    if (!is_array($entry) || dsPlaygroundSkipReason($helper, $entry) !== null) return null;
    $source = (string) $entry['source'];
    // Page-level helpers live in their own file under includes/components/; helpers.php loads the rest.
    if (!function_exists($helper) && preg_match('#^/includes/components/[a-z0-9-]+\.php$#D', $source)) {
        require_once dsReviewRoot() . $source;
    }
    if (!function_exists($helper)) return null;
    $args = is_array($candidate['args'] ?? null)
        ? array_values(dsReviewPlainArgs($candidate['args']))
        : dsReviewLeadingArgs(dsPlaygroundExampleArgs($helper, (string) ($entry['example'] ?? '')));
    return dsPlaygroundCall($helper, $args);
}

/** Strings, numbers, booleans, null and arrays of them; a '__call' key would make dsPlaygroundValue() call a helper. */
function dsReviewPlainArgs(array $args): array
{
    $out = [];
    foreach ($args as $key => $value) {
        if ($key === '__call') continue;
        if (is_array($value)) $out[$key] = dsReviewPlainArgs($value);
        elseif (is_scalar($value) || $value === null) $out[$key] = $value;
    }
    return $out;
}

/** The example's arguments up to its first one that is not a literal: a gap would shift the rest. */
function dsReviewLeadingArgs(array $args): array
{
    $out = [];
    for ($i = 0; array_key_exists($i, $args); $i++) $out[] = $args[$i];
    return $out;
}
