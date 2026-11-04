<?php
/**
 * Page design-system checker.
 *
 * Companion to check-drift.php: that one guards the token/JSON mirror, this one
 * guards the pages themselves. Wired to a PostToolUse hook so violations come
 * back to the agent mid-turn instead of being found in an audit weeks later.
 *
 *   php design-system/tools/check-page.php <file>...   check specific files
 *   php design-system/tools/check-page.php --all       scan every page
 *   php design-system/tools/check-page.php --baseline  rewrite the ratchet baseline
 *   php design-system/tools/check-page.php --baseline-lower [<page>...]
 *                                                lower the baseline only: a count
 *                                                drops to what the page has now,
 *                                                never rises, and no file is added;
 *                                                with pages listed, only those
 *   php design-system/tools/check-page.php --count [--json [--detail]]
 *                                                print the live total, net of
 *                                                approved exceptions; writes nothing.
 *                                                --detail adds every file's per-rule
 *                                                counts (the burn-down queue reads it)
 *   php design-system/tools/check-page.php --legacy-baseline
 *                                                trim legacy-baseline.json
 *
 * EXCEPTIONS: page-exceptions.json holds violations that are right where they
 * are (a reason and Bill's approval each). --count subtracts the approved ones,
 * so "solved" means --count reports 0. Unapproved entries are only proposals.
 * Ratchet checks are unchanged: the baseline still tolerates excepted counts.
 *
 * Exit 0 = no new violations. Exit 1 = new violations (hook turns this into a 2).
 *
 * RATCHET: page-baseline.json records how many violations each file already has
 * per rule. Existing counts are tolerated; anything above them fails, and a file
 * absent from the baseline must be clean. That stops new drift without blocking
 * work on the ~148 legacy pages that predate this check.
 *
 * LEGACY LOOKALIKES: the class patterns in legacy-patterns.json (.modal-overlay,
 * .template-card, ...) and page-local CSS rules for a card class are counted
 * against legacy-baseline.json, a separate file so --baseline can never raise
 * them. --legacy-baseline only lowers a count; a pattern it has not seen before
 * is seeded at today's count. Raising one means editing the file by hand.
 * Comments are not counted: PHP comments and HTML comments are blanked first.
 * Only class usage is counted (see classSpans()): a class attribute, a PHP class
 * option or variable, a JS class or selector call, a <style> selector. The same
 * word in copy, an id or a file path is not.
 *
 * SCOPE: only .php files are checked. Standalone .js and .css files are not
 * read, so a legacy class added by a script (classList.add('modal-overlay'))
 * or styled in a stylesheet is invisible here.
 */

const BASELINE_FILE = __DIR__ . '/../baselines/page-baseline.json';
const LEGACY_PATTERNS_FILE = __DIR__ . '/../legacy-patterns.json';
const LEGACY_BASELINE_FILE = __DIR__ . '/../baselines/legacy-baseline.json';
const EXCEPTIONS_FILE = __DIR__ . '/../baselines/page-exceptions.json';
const CARD_RULE = 'card-rule';

$root = dirname(__DIR__, 2);

// Files that legitimately own their whole document and must not be checked.
// Emails need standalone HTML; print/handout sheets are deliberately bare;
// api/ and cron/ emit HTML incidentally; design-system/ demos raw markup by nature.
const SKIP_PATTERNS = [
    '#^vendor/#', '#^node_modules/#', '#^\.claude/#', '#^\.git/#',
    // Agent working directories. These hold scratch copies of real pages
    // (.superpowers/sdd/ keeps a pre-task snapshot per step), so scanning them
    // double-counts drift that is already tracked against the real file.
    '#^\.scratch/#', '#^\.superpowers/#', '#^\.omc/#', '#^\.impeccable/#',
    '#^emails/#', '#^includes/email-templates/#', '#^includes/email\.php$#',
    '#^cron/#', '#^tests/#', '#^api/#', '#^admin/api/#',
    '#^admin/(tools|test-|migrate-|setup-|update-|import-)#',
    '#^design-system/#',
    // Print sheets: Plays (content/handouts) and exercise templates
    // (library/templates) are standalone pages Puppeteer renders to PDF.
    '#print\.php$#', '#^content/handouts/#', '#^library/templates/#', '#/mockups?/#',
    '#\.legacy\.php$#', '#^survey/includes/#',
    // Retired admin pages: .htaccess denies every request (admin/_archive/README.md).
    '#^admin/_archive/#',
    // ws_* component templates: raw controls inside a component ARE the
    // component, the same reason design-system/ demos are skipped (Bill, 14 Oct 2026).
    '#^includes/components/#',
];

// The only files allowed to emit <!DOCTYPE>. Everything else must go through
// the shared layout. Trim this list as forks are retired — that's the point.
const LAYOUT_FILES = [
    'includes/header.php',
    // The nav gallery renders standalone preview documents, so it owns its own
    // <!DOCTYPE> by design rather than going through the shared layout.
    'includes/nav-example.php',
    'planner/includes/header.php',
    'strategist/includes/header.php',
    // The shared stsh-shell layout: document head for apps wearing the
    // phase-journey chrome (Synthesize; Strategist's own header predates it).
    'includes/components/stsh-header.php',
    'academy/includes/header.php',
    'academy/training/header.php',
    'admin/includes/admin-header.php',
    'admin/includes/admin-auth.php',
    'tips/custom/_chrome.php',
    'tips/custom/v2/_chrome.php',
    'sidekick/includes/oauth-callback.php',
    'sidekick_new/includes/layout.php',
];

/** @return array<string,int> rule => count */
function checkFile(string $abs, string $rel): array
{
    $src = @file_get_contents($abs);
    if ($src === false) return [];

    $counts = [];
    $bump = function (string $rule) use (&$counts) {
        $counts[$rule] = ($counts[$rule] ?? 0) + 1;
    };

    // 1. Hand-rolled document. The single biggest driver of page-to-page drift:
    //    a forked <head> silently drops CSRF meta, SEO tags, analytics, and components.js.
    if (!in_array($rel, LAYOUT_FILES, true) && stripos($src, '<!DOCTYPE') !== false) {
        $bump('doctype-outside-layout');
    }

    // 2. Hardcoded colour where a token exists. Only inspects style="" attributes
    //    and <style> blocks — a hex in PHP data (chart series, seed content) is not
    //    a styling decision and shouldn't be flagged.
    $styleChunks = [];
    if (preg_match_all('#\sstyle\s*=\s*"([^"]*)"#i', $src, $m)) {
        $styleChunks = array_merge($styleChunks, $m[1]);
    }
    if (preg_match_all('#<style\b[^>]*>(.*?)</style>#is', $src, $m)) {
        $styleChunks = array_merge($styleChunks, $m[1]);
    }
    foreach ($styleChunks as $chunk) {
        // A hex inside var(--token, #hex) is the fallback, not a hardcoded value —
        // the token IS being used. ds-lint.mjs stopped counting these in 8dcdacfe;
        // this rule kept doing it, so ~15% of every reported hex was the codebase's
        // own defensive convention. Strip only the fallback, so a chunk carrying
        // both a real hex and a fallback still reports the real one.
        $chunk = preg_replace('/var\(\s*--[a-z0-9-]+\s*,[^)]*\)/i', '', $chunk);
        if (preg_match_all('/#[0-9a-fA-F]{3,8}\b/', $chunk, $hits)) {
            foreach ($hits[0] as $_) $bump('hardcoded-hex');
        }
    }

    // 3. Raw control where a ws_* helper exists. Hidden inputs are plumbing, not UI.
    if (preg_match_all('#<(button|select|textarea)\b#i', $src, $m)) {
        foreach ($m[0] as $_) $bump('raw-component');
    }
    if (preg_match_all('#<input\b[^>]*>#i', $src, $m)) {
        foreach ($m[0] as $tag) {
            if (!preg_match('#type\s*=\s*["\']?hidden#i', $tag)) $bump('raw-component');
        }
    }

    // 4. Local asset with no cache bust. Manual FTP deploys plus stale caches
    //    otherwise ship mixed CSS/JS versions against new markup.
    if (preg_match_all('#(?:href|src)\s*=\s*"(/[^"]+\.(?:css|js))(\?[^"]*)?"#i', $src, $m, PREG_SET_ORDER)) {
        foreach ($m as $hit) {
            if (empty($hit[2]) || strpos($hit[2], 'v=') === false) $bump('uncachebusted-asset');
        }
    }

    return $counts;
}

/**
 * The class entries of legacy-patterns.json as [pattern, PCRE, use, why].
 * Read only: the file is curated by hand. Missing file or a bad regex: skipped.
 */
function legacyPatterns(): array
{
    static $out = null;
    if ($out !== null) return $out;
    $out = [];
    $json = @file_get_contents(LEGACY_PATTERNS_FILE);
    $data = $json === false ? null : json_decode($json, true);
    foreach (($data['classes'] ?? []) as $c) {
        if (empty($c['pattern']) || empty($c['match'])) continue;
        $re = '~' . str_replace('~', '\~', $c['match']) . '~';
        if (@preg_match($re, '') === false) continue;
        $out[] = [$c['pattern'], $re, $c['use'] ?? '', $c['why'] ?? ''];
    }
    return $out;
}

// The design system's own classes contain the legacy names (.ws-modal-overlay,
// .wl-card) and are never legacy.
function inDesignSystemClass(string $src, int $at): bool
{
    $start = $at;
    while ($start > 0 && preg_match('/[\w-]/', $src[$start - 1])) $start--;
    return preg_match('/^(ws|wl)-/', substr($src, $start, 3)) === 1;
}

/**
 * CSS rule blocks in the page's own <style> that style a card class: .card or
 * any *-card, BEM parts included (.x-card__title, .x-card--featured). One count
 * per block.
 */
function cardRuleCount(string $src): int
{
    if (!preg_match_all('#<style\b[^>]*>(.*?)</style>#is', $src, $m)) return 0;
    $n = 0;
    foreach ($m[1] as $css) {
        $css = preg_replace(['#/\*.*?\*/#s', '#<\?.*?\?>#s'], '', $css);
        if (!preg_match_all('/([^{};]+)\{/', $css, $blocks)) continue;
        foreach ($blocks[1] as $prelude) {
            $prelude = trim($prelude);
            if ($prelude === '' || $prelude[0] === '@') continue;
            if (!preg_match_all('/\.(-?[_a-zA-Z][\w-]*)/', $prelude, $cls)) continue;
            foreach ($cls[1] as $c) {
                if (preg_match('/^(ws|wl)-/', $c)) continue;
                $base = preg_split('/__|--/', $c)[0];
                if ($base === 'card' || substr($base, -5) === '-card') {
                    $n++;
                    break;
                }
            }
        }
    }
    return $n;
}

/**
 * The source with PHP comments (//, # and block comments) and HTML comments
 * blanked, so a comment that names a legacy class is not counted as a use. Only comment
 * tokens and comments in inline HTML go: markup in PHP strings, heredocs and
 * script blocks still counts. Blanking keeps newlines and byte offsets. PHP
 * inside an HTML comment only prints into the comment, so it is blanked too.
 */
function withoutComments(string $src): string
{
    $blank = fn(string $s): string => preg_replace('/[^\n]/', ' ', $s);
    $out = '';
    $inHtmlComment = false;
    foreach (token_get_all($src) as $t) {
        [$id, $text] = is_array($t) ? [$t[0], $t[1]] : [null, $t];
        if ($id === T_COMMENT || $id === T_DOC_COMMENT) {
            $out .= $blank($text);
            continue;
        }
        if ($id !== T_INLINE_HTML) {
            $out .= $inHtmlComment ? $blank($text) : $text;
            continue;
        }
        $pos = 0;
        $len = strlen($text);
        while ($pos < $len) {
            $at = strpos($text, $inHtmlComment ? '-->' : '<!--', $pos);
            if ($at === false) {
                $rest = substr($text, $pos);
                $out .= $inHtmlComment ? $blank($rest) : $rest;
                break;
            }
            if ($inHtmlComment) {
                $out .= $blank(substr($text, $pos, $at + 3 - $pos));
                $pos = $at + 3;
            } else {
                $out .= substr($text, $pos, $at - $pos);
                $pos = $at;
            }
            $inHtmlComment = !$inHtmlComment;
        }
    }
    return $out;
}

/**
 * Where a class name can be used, as [start, end, selector] byte spans of the
 * comment-blanked source. A legacy name outside every span is prose (a heading,
 * a hint, a string of copy) and is not counted. A selector span only counts a
 * name written as a class, .empty-state, so #empty-state or a bare word is not.
 *
 *   class="..." and class='...', PHP tags inside the value included
 *   'class' => ... (any key with "class" in it) and $class = ... (or $cls)
 *   classList.add(...) and the rest, className = ..., getElementsByClassName,
 *     jQuery's addClass family
 *   querySelector(All), closest, matches, $() and jQuery(): selector
 *   rule selectors in the page's own <style> blocks: selector
 */
function classSpans(string $src): array
{
    $spans = [];
    // A regex that fails (backtrack or JIT limit on a large page) counts the
    // whole source, as before this filter, rather than letting the ratchet go quiet.
    $add = function (string $re, bool $selector, int $group = 1, string $in = '', int $base = 0) use (&$spans, $src) {
        $found = preg_match_all($re, $in === '' ? $src : $in, $m, PREG_OFFSET_CAPTURE);
        if ($found === false) {
            $spans[] = [0, strlen($src), false];
            return;
        }
        if (!$found) return;
        foreach ($m[$group] as [$text, $at]) {
            if ($at >= 0) $spans[] = [$base + $at, $base + $at + strlen($text), $selector];
        }
    };
    $add('#\bclass\s*=\s*\\\\?"((?:<\?.*?\?>|[^"<]++|<(?!\?))*+)"#is', false);
    $add("#\\bclass\\s*=\\s*\\\\?'((?:<\\?.*?\\?>|[^'<]++|<(?!\\?))*+)'#is", false);
    $add('#[\'"][\w-]*class[\w-]*[\'"]\s*=>\s*([^,\]\n]*)#i', false);
    $add('#\$\w*(?:class|cls)\w*\s*\.?=(?!=)\s*([^;\n]*)#i', false);
    $add('#\bclassList\s*\.\s*(?:add|remove|toggle|contains|replace)\s*\(([^)]*)\)#', false);
    $add('#\bclassName\s*\+?=(?!=)\s*([^;\n]*)#', false);
    $add('#\b(?:getElementsByClassName|addClass|removeClass|toggleClass|hasClass)\s*\(([^)]*)\)#', false);
    $add('#(?:\b(?:querySelector(?:All)?|closest|matches|jQuery)|\$)\s*\(\s*((["\'`]).*?\2)#s', true);
    $styles = preg_match_all('#<style\b[^>]*>(.*?)</style>#is', $src, $m, PREG_OFFSET_CAPTURE);
    if ($styles === false) $spans[] = [0, strlen($src), false];
    if ($styles) {
        foreach ($m[1] as [$css, $base]) $add('/([^{};]+)\{/', true, 1, $css, $base);
    }
    return $spans;
}

/**
 * The source with comments inside <style> and <script> blanked: CSS and JS
 * block comments, and JS line comments that start their line (a // after code
 * may be inside a URL string, so it stays). Keeps newlines and byte offsets.
 */
function withoutCodeComments(string $src): string
{
    $blank = fn(array $c): string => preg_replace('/[^\n]/', ' ', $c[0]);
    return preg_replace_callback('#(<(style|script)\b[^>]*>)(.*?)(</\2>)#is', function ($b) use ($blank) {
        $body = preg_replace_callback('#/\*.*?\*/#s', $blank, $b[3]) ?? $b[3];
        if (strtolower($b[2]) === 'script') {
            $body = preg_replace_callback('#^[ \t]*//[^\n]*#m', $blank, $body) ?? $body;
        }
        return $b[1] . $body . $b[4];
    }, $src) ?? $src;
}

function inClassSpan(array $spans, string $src, int $at): bool
{
    foreach ($spans as [$start, $end, $selector]) {
        if ($at < $start || $at >= $end) continue;
        if (!$selector) return true;
        $name = $at;
        while ($name > $start && preg_match('/[\w-]/', $src[$name - 1])) $name--;
        if ($name > 0 && $src[$name - 1] === '.') return true;
    }
    return false;
}

/** @return array<string,int> legacy pattern (or card-rule) => count */
function legacyCounts(string $src): array
{
    $src = withoutCodeComments(withoutComments($src));
    $spans = classSpans($src);
    $counts = [];
    foreach (legacyPatterns() as [$key, $re]) {
        if (!preg_match_all($re, $src, $m, PREG_OFFSET_CAPTURE)) continue;
        $n = 0;
        foreach ($m[0] as [, $at]) {
            if (!inDesignSystemClass($src, $at) && inClassSpan($spans, $src, $at)) $n++;
        }
        if ($n) $counts[$key] = $n;
    }
    $cards = cardRuleCount($src);
    if ($cards) $counts[CARD_RULE] = $cards;
    return $counts;
}

function shouldSkip(string $rel): bool
{
    foreach (SKIP_PATTERNS as $p) {
        if (preg_match($p, $rel)) return true;
    }
    return false;
}

function allPages(string $root): array
{
    $out = [];
    $it = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS)
    );
    foreach ($it as $f) {
        if (!$f->isFile() || $f->getExtension() !== 'php') continue;
        $rel = substr($f->getPathname(), strlen($root) + 1);
        if (shouldSkip($rel)) continue;
        $out[] = $rel;
    }
    sort($out);
    return $out;
}

/**
 * Approved exceptions, rel => rule => count. Entries without "approved": true
 * are proposals and count for nothing until Bill approves them.
 *
 * @return array<string,array<string,int>>
 */
function approvedExceptions(): array
{
    if (!file_exists(EXCEPTIONS_FILE)) return [];
    $data = json_decode((string) file_get_contents(EXCEPTIONS_FILE), true) ?: [];
    $out = [];
    foreach ($data['files'] ?? [] as $rel => $byRule) {
        foreach ($byRule as $rule => $entry) {
            if (($entry['approved'] ?? false) === true && (int) ($entry['count'] ?? 0) > 0) {
                $out[$rel][$rule] = (int) $entry['count'];
            }
        }
    }
    return $out;
}

// ── main ─────────────────────────────────────────────────────────────
$args = array_slice($argv, 1);
$mode = 'check';
if (in_array('--baseline', $args, true)) $mode = 'baseline';
if (in_array('--all', $args, true)) $mode = $mode === 'baseline' ? 'baseline' : 'all';
if (in_array('--legacy-baseline', $args, true)) $mode = 'legacy-baseline';
if (in_array('--baseline-lower', $args, true)) $mode = 'baseline-lower';
if (in_array('--count', $args, true)) $mode = 'count';

$baseline = file_exists(BASELINE_FILE)
    ? (json_decode(file_get_contents(BASELINE_FILE), true) ?: [])
    : [];

if ($mode === 'count') {
    $exceptions = approvedExceptions();
    $byRule = [];
    $files = [];
    $detail = [];
    $total = 0;
    foreach (allPages($root) as $rel) {
        foreach (checkFile($root . '/' . $rel, $rel) as $rule => $n) {
            $net = max(0, $n - ($exceptions[$rel][$rule] ?? 0));
            if (!$net) continue;
            $byRule[$rule] = ($byRule[$rule] ?? 0) + $net;
            $files[$rel] = ($files[$rel] ?? 0) + $net;
            $detail[$rel][$rule] = $net;
            $total += $net;
        }
    }
    ksort($byRule);
    arsort($files);
    $baselineTotal = array_sum(array_map('array_sum', $baseline));
    $excepted = array_sum(array_map('array_sum', $exceptions));
    if (in_array('--json', $args, true)) {
        fwrite(STDOUT, json_encode([
            'total' => $total,
            'files' => count($files),
            'by_rule' => $byRule,
            'baseline_total' => $baselineTotal,
            'approved_exceptions' => $excepted,
            'top_files' => array_slice($files, 0, 20, true),
        ] + (in_array('--detail', $args, true) ? ['files_by_rule' => $detail] : []),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n");
    } else {
        fwrite(STDOUT, "Live: $total violation(s) in " . count($files) . " file(s), net of $excepted approved exception(s). Baseline: $baselineTotal.\n");
        foreach ($byRule as $rule => $n) fwrite(STDOUT, "  $rule: $n\n");
    }
    exit(0);
}

if ($mode === 'baseline-lower') {
    // With page paths after the flag, only those pages are lowered, so a run's
    // baseline change stays the size of its fix. With none, every page is.
    $only = array_values(array_filter($args, fn($a) => substr($a, 0, 2) !== '--'));
    $only = $only ? array_flip(array_map(fn($p) => ltrim(str_replace($root . '/', '', realpath($p) ?: $p), './'), $only)) : null;
    $new = [];
    $lowered = 0;
    foreach ($baseline as $rel => $byRule) {
        if (shouldSkip($rel)) { // a skipped path is no longer measured, so it leaves the baseline
            $lowered += array_sum($byRule);
            continue;
        }
        if ($only !== null && !isset($only[$rel])) {
            $new[$rel] = $byRule;
            continue;
        }
        $abs = $root . '/' . $rel;
        $now = is_file($abs) ? checkFile($abs, $rel) : [];
        foreach ($byRule as $rule => $was) {
            $keep = min($was, $now[$rule] ?? 0);
            $lowered += $was - $keep;
            if ($keep) $new[$rel][$rule] = $keep;
        }
    }
    ksort($new);
    // Two-space indent, matching the committed file, so a run's diff is only
    // the lines it lowered.
    $json = json_encode($new, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    $json = preg_replace_callback('/^( +)/m', fn($m) => str_repeat(' ', intdiv(strlen($m[1]), 2)), $json);
    file_put_contents(BASELINE_FILE, $json . "\n");
    $before = array_sum(array_map('array_sum', $baseline));
    $after = array_sum(array_map('array_sum', $new));
    fwrite(STDOUT, "Baseline lowered: $before -> $after ($lowered fewer), " . count($new) . " files. Nothing was raised or added.\n");
    exit(0);
}

$legacyBaseline = file_exists(LEGACY_BASELINE_FILE)
    ? (json_decode(file_get_contents(LEGACY_BASELINE_FILE), true) ?: [])
    : [];
$legacySeeded = array_flip($legacyBaseline['patterns'] ?? []);
$legacyAllowed = $legacyBaseline['files'] ?? [];

if ($mode === 'legacy-baseline') {
    $keys = array_merge(array_column(legacyPatterns(), 0), [CARD_RULE]);
    $files = [];
    $seeded = $trimmed = 0;
    foreach (allPages($root) as $rel) {
        $src = @file_get_contents($root . '/' . $rel);
        if ($src === false) continue;
        foreach (legacyCounts($src) as $key => $n) {
            $was = $legacyAllowed[$rel][$key] ?? 0;
            $keep = isset($legacySeeded[$key]) ? min($n, $was) : $n;
            if (!isset($legacySeeded[$key])) $seeded += $n;
            if ($keep) $files[$rel][$key] = $keep;
        }
    }
    foreach ($legacyAllowed as $rel => $byKey) {
        foreach ($byKey as $key => $was) {
            if (isset($legacySeeded[$key])) $trimmed += $was - ($files[$rel][$key] ?? 0);
        }
    }
    ksort($files);
    file_put_contents(LEGACY_BASELINE_FILE, json_encode([
        '_comment' => 'Legacy lookalikes per page, counted by check-page.php from legacy-patterns.json plus page-local card rules (card-rule). A count may only go down: --legacy-baseline lowers counts and seeds patterns it has not seen before, and never raises one. Raise a count by hand only when a new use is genuinely right, and say why in the commit.',
        'patterns' => $keys,
        'files' => $files,
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n");
    $total = array_sum(array_map('array_sum', $files));
    fwrite(STDOUT, "Legacy baseline written: " . count($files) . " files, $total occurrences ($seeded seeded, $trimmed trimmed).\n");
    exit(0);
}

if ($mode === 'baseline') {
    $new = [];
    foreach (allPages($root) as $rel) {
        $c = checkFile($root . '/' . $rel, $rel);
        if ($c) $new[$rel] = $c;
    }
    ksort($new);
    file_put_contents(
        BASELINE_FILE,
        json_encode($new, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n"
    );
    $total = array_sum(array_map('array_sum', $new));
    fwrite(STDOUT, "Baseline written: " . count($new) . " files, $total violations.\n");
    exit(0);
}

$targets = $mode === 'all'
    ? allPages($root)
    : array_values(array_filter($args, fn($a) => substr($a, 0, 2) !== '--'));

$failures = [];
$trims = [];
$unseeded = [];
foreach ($targets as $t) {
    $abs = (strpos($t, '/') === 0) ? $t : $root . '/' . $t;
    $abs = realpath($abs) ?: $abs;
    if (!is_file($abs)) continue;
    if (substr($abs, -4) !== '.php') continue;

    $rel = (strpos($abs, $root) === 0) ? substr($abs, strlen($root) + 1) : $t;
    if (shouldSkip($rel)) continue;

    $counts = checkFile($abs, $rel);
    foreach ($counts as $rule => $n) {
        $allowed = $baseline[$rel][$rule] ?? 0;
        if ($n > $allowed) {
            $failures[] = [$rel, $rule, $n, $allowed];
        }
    }

    $legacy = legacyCounts((string) @file_get_contents($abs));
    foreach (array_keys($legacy + ($legacyAllowed[$rel] ?? [])) as $key) {
        $n = $legacy[$key] ?? 0;
        $allowed = $legacyAllowed[$rel][$key] ?? 0;
        if (!isset($legacySeeded[$key])) {
            if ($n) $unseeded[$key] = true;
        } elseif ($n > $allowed) {
            $failures[] = [$rel, "legacy $key", $n, $allowed];
        } elseif ($n < $allowed) {
            $trims[] = [$rel, $key, $n, $allowed];
        }
    }
}

if ($trims) {
    fwrite(STDOUT, "Legacy lookalikes went down; trim the baseline with: php design-system/tools/check-page.php --legacy-baseline\n");
    foreach ($trims as [$rel, $key, $n, $allowed]) {
        fwrite(STDOUT, "  $rel\n    legacy $key: " . ($allowed - $n) . " fewer ($n found, $allowed baselined)\n");
    }
}
if ($unseeded) {
    fwrite(STDOUT, "Legacy pattern(s) with no baseline yet, not enforced: " . implode(', ', array_keys($unseeded))
        . ". Seed them with: php design-system/tools/check-page.php --legacy-baseline\n");
}

if (!$failures) exit(0);

$hints = [
    'doctype-outside-layout' => 'Do not hand-roll <!DOCTYPE>/<head>. Set $page_title / $header_property / $body_class, then require includes/header.php and includes/footer.php.',
    'hardcoded-hex'          => 'Use a token from design-system/platform-tokens.css (e.g. var(--brand-ink)) instead of a hex literal.',
    'raw-component'          => 'Use the ws_* helper instead of raw markup: ws_button(), ws_input(), ws_select(). See includes/components/helpers.php.',
    'uncachebusted-asset'    => 'Append ?v=<?= filemtime(...) ?> to local CSS/JS. Manual FTP deploys otherwise serve stale assets.',
    'legacy ' . CARD_RULE    => 'Do not style a card class in the page. Use ws_card(), ws_planner_card(), ws_listing_card() or ws_choice_card(); npm run ds:find -- "card" picks one.',
];
foreach (legacyPatterns() as [$key, , $use, $why]) {
    $hints["legacy $key"] = "Legacy lookalike: use $use instead. $why";
}

fwrite(STDERR, "Design-system check failed — " . count($failures) . " new violation(s).\n\n");
$seen = [];
foreach ($failures as [$rel, $rule, $n, $allowed]) {
    $delta = $n - $allowed;
    fwrite(STDERR, "  $rel\n    $rule: $delta new ($n found, $allowed baselined)\n");
    if (!isset($seen[$rule])) {
        fwrite(STDERR, "    → {$hints[$rule]}\n");
        $seen[$rule] = true;
    }
}
fwrite(STDERR, "\nFix these before finishing. If a violation is genuinely correct here,\n");
fwrite(STDERR, "say so and re-baseline with: php design-system/tools/check-page.php --baseline\n");
if (array_filter($failures, fn($f) => strpos($f[1], 'legacy ') === 0)) {
    fwrite(STDERR, "Legacy counts only go down: --baseline does not touch them. Raise one by hand in\n");
    fwrite(STDERR, "design-system/baselines/legacy-baseline.json only when the new use is genuinely right, and say why.\n");
}
exit(1);
