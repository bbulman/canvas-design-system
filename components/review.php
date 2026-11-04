<?php
/**
 * Design system review: the cases agents left for Bill to decide, the swaps made
 * automatically, and suggested new components (spec sections 5, 7 and 9).
 *
 * Local only. dsReviewAllowed() refuses anything but PHP's built-in server on a
 * loopback address, before anything else loads, and a change also needs this
 * page's own Origin. It reads and writes the enforcer's JSON in dsReviewDir() and
 * never touches the database. An agent carries out the decisions later
 * (apply_review); this page only records them.
 */
require_once __DIR__ . '/../includes/review-data.php';

$refuse = static function (int $status, string $message): void {
    http_response_code($status);
    header('Content-Type: text/plain; charset=UTF-8');
    echo $message;
    exit;
};
if (!dsReviewAllowed()) $refuse(403, 'The review page only runs on the local dev server.');

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    if (!dsReviewPostAllowed()) $refuse(403, 'The review page only takes changes made on the page itself.');
    $field = static fn(string $name): string => is_string($_POST[$name] ?? null) ? $_POST[$name] : '';
    $action = $field('action');
    if ($action === 'seen') {
        dsReviewMarkSeen(is_array($_POST['ids'] ?? null) ? $_POST['ids'] : []);
        http_response_code(204);
        exit;
    }
    if ($action === 'decide') {
        $done = $field('decision');
        $saved = dsReviewDecide($field('id'), $done, $field('chosen') !== '' ? $field('chosen') : null);
        $query = $done === 'undo' ? ['area' => 'changed'] : ['area' => 'waiting', 'case' => max(1, (int) $field('case'))];
    } elseif ($action === 'suggestion') {
        $done = $field('verdict');
        $saved = dsReviewSuggestion($field('id'), $done);
        $query = ['area' => 'suggested'];
    } else {
        $refuse(400, 'The review page does not know that action.');
    }
    // Post, then redirect: a reload never sends the decision twice.
    header('Location: ' . $_SERVER['SCRIPT_NAME'] . '?' . http_build_query($query + ['saved' => $saved ? $done : 'none']), true, 303);
    exit;
}

require_once __DIR__ . '/../../includes/icon.php';
require_once __DIR__ . '/../../includes/components/helpers.php';
require_once __DIR__ . '/../includes/playground-fixtures.php';

$review = dsReviewLoad();
$e = static fn($value): string => htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$isSwap = static fn(array $c): bool => ($c['kind'] ?? '') === 'swapped-automatically';
$undecided = static fn(array $c): bool => in_array($c['decision'] ?? 'pending', ['pending', 'later'], true);

$waiting = array_values(array_filter($review['cases'], fn($c) => !$isSwap($c) && ($c['status'] ?? '') === 'open' && $undecided($c)));
// Decide later sends a case to the back of the queue.
usort($waiting, fn($a, $b) => [($a['decision'] ?? '') === 'later', (string) ($a['created'] ?? '')] <=> [($b['decision'] ?? '') === 'later', (string) ($b['created'] ?? '')]);
$toApply = count(array_filter($review['cases'], fn($c) => !$isSwap($c) && ($c['status'] ?? '') === 'open' && !$undecided($c)));
$swaps = array_values(array_filter($review['cases'], $isSwap));
usort($swaps, fn($a, $b) => strcmp((string) ($b['created'] ?? ''), (string) ($a['created'] ?? '')));
$unseen = array_values(array_filter($swaps, fn($c) => ($c['seen'] ?? false) !== true));
$history = array_values(array_filter($swaps, fn($c) => ($c['seen'] ?? false) === true));
$suggestions = $review['suggestions'];
$underBar = $review['underBar'];
$minPages = $review['minPages'];

$total = count($waiting);
$number = $total ? min(max(1, (int) ($_GET['case'] ?? 1)), $total) : 0;
$current = $number ? $waiting[$number - 1] : null;

$savedMessages = [
    'use-component' => 'Saved: use the component. An agent makes the change when you tell it to apply the design system review.',
    'keep' => "Saved: keep the agent's version.",
    'later' => 'Saved for later. The case has moved to the back of the queue.',
    'fine' => 'Saved: fine as it is.',
    'should-become' => 'Saved: it joins the suggested new components the next time that list is refreshed.',
    'undo' => 'Saved: undo this change. An agent puts the original markup back when you tell it to apply the design system review.',
    'dismiss' => 'Dismissed. It will not be suggested again.',
    'build' => 'Added to the build list for a future design system task.',
];
$saved = is_string($_GET['saved'] ?? null) ? $_GET['saved'] : '';

$heading = static fn(string $text, string $tag = 'h3'): string => ws_text($text, ['variant' => 'title', 'tag' => $tag]);
$note = static fn(string $text): string => '<p class="review-note">' . $e($text) . '</p>';
$code = static fn(string $text, string $label): string => '<div class="ds-code review-code"><pre tabindex="0" aria-label="' . $e($label) . '"><code>' . $e($text) . '</code></pre></div>';
$plural = static fn(int $n, string $one, string $many): string => $n === 1 ? "1 $one" : "$n $many";

$when = static function ($iso): string {
    try {
        return (new DateTimeImmutable((string) $iso))->setTimezone(new DateTimeZone(date_default_timezone_get()))->format('j M Y, H:i');
    } catch (Exception) {
        return '';
    }
};
$meta = static function (array $c) use ($e, $when): void {
    $line = is_int($c['line'] ?? null) ? ', line ' . $c['line'] : '';
    $agent = trim((string) ($c['agent'] ?? '')) ?: 'main session';
    ws_cluster_start(['gap' => '4', 'class' => 'review-meta']);
    echo '<code>' . $e(($c['file'] ?? 'Unknown file') . $line) . '</code>';
    echo '<span>' . $e($agent === 'main session' ? 'Built in the main session' : 'Built by ' . $agent) . '</span>';
    if ($date = $when($c['created'] ?? '')) echo '<span>' . $e($date) . '</span>';
    ws_cluster_end();
};

$agentColumn = static function (array $c, string $title, string $frameTitle) use ($heading, $code): void {
    echo '<div class="review-column">' . $heading($title);
    echo dsReviewFrame($frameTitle, (string) ($c['sample'] ?? ''), dsReviewStylesheets($c));
    echo $code((string) ($c['markup'] ?? ''), 'The markup the agent wrote') . '</div>';
};
$componentColumn = static function (array $candidate, string $title) use ($e, $heading, $code, $note): void {
    $helper = $candidate['helper'];
    echo '<div class="review-column">' . $heading($title);
    $html = dsReviewComponentHtml($candidate);
    if ($html === null) {
        echo $note($helper . '() cannot be shown here: it is not in the catalogue, it could reach the database, it only closes a block, or it needs arguments its catalogue example does not give.');
    } else {
        echo dsReviewFrame($helper . '(), rendered', $html);
        echo $code((string) dsReviewComponentCode($candidate), 'PHP for ' . $helper . '()');
    }
    if ($preview = dsReviewPreviewUrl($helper)) {
        echo '<p class="review-note"><a href="' . $e(str_replace('&preview=1', '', $preview)) . '" target="_blank" rel="noopener">Try ' . $e($helper) . '() in the playground</a></p>';
    }
    echo '</div>';
};
$decideForm = static function (array $c, array $buttons, ?string $chosen = null) use ($e, $number): void {
    echo '<form method="post">';
    echo '<input type="hidden" name="action" value="decide"><input type="hidden" name="id" value="' . $e($c['id']) . '"><input type="hidden" name="case" value="' . $number . '">';
    if ($chosen !== null) echo '<input type="hidden" name="chosen" value="' . $e($chosen) . '">';
    ws_cluster_start(['gap' => '3']);
    foreach ($buttons as [$label, $decision, $variant]) {
        echo ws_button($label, ['type' => 'submit', 'variant' => $variant, 'attrs' => ['name' => 'decision', 'value' => $decision]]);
    }
    ws_cluster_end();
    echo '</form>';
};

/* One screen of layout A: the agent's version beside one candidate (or alone), its reason, the buttons. */
$comparison = static function (array $c, ?array $candidate, array $buttons) use ($e, $heading, $agentColumn, $componentColumn, $decideForm): void {
    ws_stack_start(['gap' => '6']);
    ws_grid_start(['gap' => '6']);
    $agentColumn($c, "The agent's version", "The agent's version, rendered");
    if ($candidate) $componentColumn($candidate, 'The component: ' . $candidate['helper'] . '()');
    ws_grid_end();
    $reason = trim((string) ($c['reason'] ?? ''));
    echo '<div>' . $heading("The agent's reason") . '<p class="review-reason">' . $e($reason !== '' ? $reason : 'The agent gave no reason.') . '</p></div>';
    $decideForm($c, $buttons, $candidate['helper'] ?? null);
    ws_stack_end();
};

$swap = static function (array $c) use ($e, $heading, $meta, $note, $agentColumn, $componentColumn): void {
    $chosen = is_string($c['chosen'] ?? null) ? $c['chosen'] : null;
    $after = null;
    foreach ((array) ($c['candidates'] ?? []) as $candidate) {
        $candidate = dsReviewCandidate($candidate);
        if ($candidate && $candidate['helper'] === $chosen) { $after = $candidate; break; }
    }
    $after ??= $chosen !== null ? (dsReviewCandidate($chosen) ?: null) : null;
    ws_card_start(['tag' => 'article', 'bordered' => true, 'attrs' => ['data-case' => $c['id']]]);
    ws_stack_start(['gap' => '4']);
    $meta($c);
    ws_grid_start(['gap' => '6']);
    $agentColumn($c, 'Before', 'Before, rendered');
    if ($after) {
        $componentColumn($after, 'After: ' . $after['helper'] . '()');
    } else {
        echo '<div class="review-column">' . $heading('After') . $note('The change named no component.') . '</div>';
    }
    ws_grid_end();
    if (($c['decision'] ?? '') === 'undo') {
        echo ws_badge('Undo recorded', ['variant' => 'status', 'status' => 'info']);
    } elseif (in_array($c['status'] ?? '', ['open', 'applied'], true)) {
        if (($c['status'] ?? '') === 'open') echo $note('The agent has not switched yet.');
        echo '<form method="post"><input type="hidden" name="action" value="decide"><input type="hidden" name="id" value="' . $e($c['id']) . '">';
        echo ws_button('Undo', ['type' => 'submit', 'variant' => 'secondary', 'attrs' => ['name' => 'decision', 'value' => 'undo']]);
        echo '</form>';
    }
    ws_stack_end();
    ws_card_end();
};

$suggestion = static function (array $s) use ($e, $heading, $note, $plural): void {
    $name = trim((string) ($s['name'] ?? '')) ?: $s['id'];
    $files = array_values(array_filter((array) ($s['files'] ?? []), 'is_string'));
    $examples = array_values(array_filter((array) ($s['examples'] ?? []), fn($x) => is_array($x) && is_string($x['file'] ?? null)));
    $closest = array_values(array_filter((array) ($s['closest'] ?? []), fn($h) => is_string($h) && preg_match('/^ws_[a-z0-9_]+$/D', $h)));
    // A family entry (solo-*-card) or a spread word (-menu) is several bespoke classes; one class names itself.
    $classes = array_values(array_filter((array) ($s['classes'] ?? []), fn($c) => is_string($c) && $c !== ''));
    $reasons = array_values(array_filter(array_map(fn($r) => is_string($r) ? trim($r) : '', (array) ($s['reasons'] ?? [])), fn($r) => $r !== ''));
    $found = array_values(array_intersect_key(['scan' => 'the codebase scan', 'case' => "an agent's case", 'bill' => 'you'], array_flip(array_filter((array) ($s['sources'] ?? []), 'is_string'))));

    ws_card_start(['tag' => 'article', 'bordered' => true, 'attrs' => ['data-suggestion' => $s['id']]]);
    ws_stack_start(['gap' => '3']);
    ws_cluster_start(['gap' => '3']);
    echo $heading($name);
    if (!empty($s['onBuildList'])) echo ws_badge('On the build list', ['variant' => 'status', 'status' => 'success']);
    ws_cluster_end();
    echo '<div><p>' . $e($plural((int) ($s['count'] ?? count($files)), 'place', 'places') . ' in ' . $plural(count($files), 'file', 'files')
        . (is_int($s['pages'] ?? null) ? ', hand-written on ' . $plural($s['pages'], 'page', 'pages') : '')) . '</p>';
    if ($found) echo ws_text('Found by ' . implode(' and ', $found) . '.', ['variant' => 'caption']);
    echo '</div>';
    if (count($classes) > 1) {
        $shown = array_slice($classes, 0, 8);
        echo '<p>Classes: ' . implode(', ', array_map(fn($c) => '<code>' . $e($c) . '</code>', $shown))
            . (count($classes) > 8 ? ' and ' . (count($classes) - 8) . ' more' : '') . '</p>';
    }
    echo '<p>' . ($closest
        ? 'Closest components: ' . implode(', ', array_map(fn($h) => '<code>' . $e($h) . '()</code>', $closest))
        : 'No component ranks clearly above a passing mention.') . '</p>';
    // Spec section 9: why the closest components do not fit, in the words of the agents that built it.
    if ($reasons) {
        echo '<div><p>' . $e($closest ? "Why they do not fit, from the agents' reasons:" : "The agents' reasons:") . '</p>';
        ws_stack_start(['tag' => 'ul', 'gap' => '1']);
        foreach ($reasons as $r) echo '<li>' . $e($r) . '</li>';
        ws_stack_end();
        echo '</div>';
    }
    if ($examples) {
        echo '<div><p>Where it appears:</p>';
        ws_cluster_start(['tag' => 'ul', 'gap' => '3']);
        // Paths, never links: a live file on the dev server can be an admin tool that runs against production on a GET.
        foreach ($examples as $x) {
            echo '<li><code>' . $e($x['file'] . (is_int($x['line'] ?? null) ? ', line ' . $x['line'] : '')) . '</code></li>';
        }
        ws_cluster_end();
        echo '</div>';
        if (is_string($examples[0]['sample'] ?? null)) echo dsReviewFrame($name . ' example, rendered', $examples[0]['sample']);
    } else {
        echo $note('No examples were recorded.');
    }
    // Harvest finds a component's copies by its class; a piece an agent described in words has none to find.
    $buildable = $classes || preg_match('/^[a-z][\w-]*$/iD', $name);
    if (!$buildable) echo $note('Described in words, with no class to find its copies by, so the build loop cannot make it: it needs a design task.');
    echo '<form method="post"><input type="hidden" name="action" value="suggestion"><input type="hidden" name="id" value="' . $e($s['id']) . '">';
    ws_cluster_start(['gap' => '3']);
    if (empty($s['onBuildList']) && $buildable) echo ws_button('Build this', ['type' => 'submit', 'attrs' => ['name' => 'verdict', 'value' => 'build']]);
    echo ws_button('Dismiss', ['type' => 'submit', 'variant' => 'secondary', 'attrs' => ['name' => 'verdict', 'value' => 'dismiss']]);
    ws_cluster_end();
    echo '</form>';
    ws_stack_end();
    ws_card_end();
};

// One line per pattern under the bar: what it is, where it stands, and Dismiss. Nothing builds one yet.
$underBarRow = static function (array $s) use ($e, $plural): string {
    $name = trim((string) ($s['name'] ?? '')) ?: $s['id'];
    $files = array_values(array_filter((array) ($s['files'] ?? []), 'is_string'));
    ob_start();
    echo '<form method="post" data-under-bar="' . $e($s['id']) . '"><input type="hidden" name="action" value="suggestion"><input type="hidden" name="id" value="' . $e($s['id']) . '">';
    ws_cluster_start(['gap' => '3', 'justify' => 'between', 'align' => 'center']);
    echo '<div>' . ws_text($name, ['variant' => 'title'])
        . ws_text('Hand-written on ' . $plural((int) $s['pages'], 'page', 'pages') . ', ' . $plural(count($files), 'file', 'files') . ' in all'
            . (!empty($s['onBuildList']) ? '. On the build list.' : '.'), ['variant' => 'caption']) . '</div>';
    echo ws_button('Dismiss', ['type' => 'submit', 'variant' => 'secondary', 'size' => 'sm', 'attrs' => ['name' => 'verdict', 'value' => 'dismiss', 'aria-label' => 'Dismiss ' . $name]]);
    ws_cluster_end();
    echo '</form>';
    return (string) ob_get_clean();
};

$ds_page = 'components/review';
$ds_title = 'Design system review';
ob_start();
require __DIR__ . '/../includes/ds-header.php';
// ds-header.php opens <main>; it carries the state directory so a test can tell which queue it would change.
echo preg_replace('/<main\b/', '<main data-review-dir="' . $e(dsReviewDir()) . '"', (string) ob_get_clean(), 1);
?>
<link rel="stylesheet" href="<?= $ds_base ?>/assets/review.css?v=<?= filemtime(__DIR__ . '/../assets/review.css') ?>">
<div class="ds-page-header"><h1>Design system review</h1><p>What the agents left for you to decide, what they changed on their own, and components the codebase seems to be missing. Your choices are saved on this machine. An agent carries them out when you tell it to apply the design system review.</p></div>
<?php foreach ($review['problems'] as $file): ?>
<?= ws_alert($file . ' could not be read, so this page shows nothing from it and changes nothing in it. Fix or remove the file, then reload.', ['variant' => 'error', 'title' => 'A review file is damaged']) ?>
<?php endforeach; ?>
<?php if ($saved === 'none'): ?>
<?= ws_alert('That was not saved: it may have changed since the page loaded. Reload to see it as it is now.', ['variant' => 'warning']) ?>
<?php elseif (isset($savedMessages[$saved])): ?>
<?= ws_alert($savedMessages[$saved], ['variant' => 'success']) ?>
<?php endif; ?>
<?= ws_tabs([
    ['id' => 'waiting', 'label' => 'Waiting for you', 'count' => $total ?: null, 'active' => true],
    ['id' => 'changed', 'label' => 'Changed automatically', 'count' => count($unseen) ?: null],
    ['id' => 'suggested', 'label' => 'Suggested new components', 'count' => count($suggestions) ?: null],
], ['id' => 'review-areas', 'label' => 'Review areas', 'param' => 'area']) ?>

<?php ws_tab_panel_start('waiting'); ?>
<?php if ($toApply): ?>
<?= ws_alert($plural($toApply, 'decision is', 'decisions are') . ' ready to carry out. Tell an agent to apply the design system review.', ['variant' => 'info']) ?>
<?php endif; ?>
<?php if ($current === null): ?>
<?= ws_empty_state('Nothing is waiting for you', ['description' => 'When an agent keeps its own version where a component fits, or builds something nothing in the catalogue covers, the case comes here for you to decide.', 'icon' => 'task_alt']) ?>
<?php else:
    $kind = (string) ($current['kind'] ?? 'kept');
    $candidates = array_values(array_filter(array_map('dsReviewCandidate', (array) ($current['candidates'] ?? []))));
    $piece = is_array($current['piece'] ?? null) ? trim((string) ($current['piece']['description'] ?? '')) : '';
    $keptButtons = [['Use the component', 'use-component', 'primary'], ["Keep the agent's version", 'keep', 'secondary'], ['Decide later', 'later', 'ghost']];
    ws_cluster_start(['justify' => 'between', 'class' => 'review-pager']);
    echo ws_text("Case $number of $total", ['variant' => 'caption']);
    ws_cluster_start(['gap' => '2']);
    if ($number > 1) echo ws_button('Previous case', ['variant' => 'ghost', 'size' => 'sm', 'href' => '?area=waiting&case=' . ($number - 1)]);
    if ($number < $total) echo ws_button('Next case', ['variant' => 'ghost', 'size' => 'sm', 'href' => '?area=waiting&case=' . ($number + 1)]);
    ws_cluster_end();
    ws_cluster_end();

    ws_card_start(['tag' => 'article', 'bordered' => true, 'attrs' => ['data-case' => $current['id'], 'aria-label' => "Case $number of $total"]]);
    ws_stack_start(['gap' => '4']);
    ws_cluster_start(['gap' => '2']);
    if ($kind === 'unconsulted') echo ws_badge('Written without a consult', ['variant' => 'status', 'status' => 'warning']);
    elseif ($kind === 'nothing-fitting') echo ws_badge('Nothing fitting', ['variant' => 'status', 'status' => 'info']);
    else echo ws_badge('Kept its own version');
    if (($current['decision'] ?? '') === 'later') echo ws_badge('Saved for later');
    ws_cluster_end();
    $meta($current);
    if ($piece !== '') {
        echo '<div><p class="review-said">The agent said it was building:</p><p class="review-piece">' . $e($piece) . '</p></div>';
    } else {
        $found = explode('|', (string) ($current['finding'] ?? ''), 3)[2] ?? '';
        echo '<p class="review-said">The agent did not say what it was building' . ($kind === 'unconsulted' ? ', because it wrote this without a consult' : '') . '.'
            . ($found !== '' ? ' The enforcer found <code>' . $e($found) . '</code> here.' : '') . '</p>';
    }

    if ($kind === 'nothing-fitting') {
        echo $note('Nothing in the catalogue fitted, so the agent built it from scratch.');
        $comparison($current, null, [['Fine as it is', 'fine', 'primary'], ['Should become a component', 'should-become', 'secondary']]);
    } elseif (!$candidates) {
        echo $note('No component came up to compare it with.');
        $comparison($current, null, array_slice($keptButtons, 1));
    } elseif (count($candidates) === 1) {
        $comparison($current, $candidates[0], $keptButtons);
    } else {
        $tabs = [];
        foreach ($candidates as $i => $candidate) $tabs[] = ['id' => 'review-candidate-' . ($i + 1), 'label' => $candidate['helper'] . '()', 'active' => $i === 0];
        echo ws_tabs($tabs, ['id' => 'review-candidates', 'label' => 'Components that fit', 'variant' => 'pill', 'size' => 'sm']);
        foreach ($candidates as $i => $candidate) {
            ws_tab_panel_start('review-candidate-' . ($i + 1));
            $comparison($current, $candidate, $keptButtons);
            ws_tab_panel_end();
        }
    }
    ws_stack_end();
    ws_card_end();
endif; ?>
<?php ws_tab_panel_end(); ?>

<?php ws_tab_panel_start('changed'); ?>
<?php if (!$swaps): ?>
<?= ws_empty_state('Nothing has been changed automatically', ['description' => 'With autoSwap on, an agent that hand-builds a clear match for a component is made to switch. Each change is listed here with Undo.', 'icon' => 'published_with_changes']) ?>
<?php else:
    ws_stack_start(['gap' => '4']);
    echo $heading('New since you last looked', 'h2');
    if (!$unseen) echo $note('Nothing new. Earlier changes are under History.');
    ws_stack_start(['gap' => '6', 'id' => 'review-unseen', 'attrs' => ['data-unseen' => json_encode(array_column($unseen, 'id'))]]);
    foreach ($unseen as $c) $swap($c);
    ws_stack_end();
    if ($history) {
        echo ws_text('History', ['variant' => 'title', 'tag' => 'h2', 'class' => 'review-later-section']);
        ws_stack_start(['gap' => '6', 'id' => 'review-history']);
        foreach ($history as $c) $swap($c);
        ws_stack_end();
    }
    ws_stack_end();
endif; ?>
<?php ws_tab_panel_end(); ?>

<?php ws_tab_panel_start('suggested'); ?>
<?php ws_stack_start(['gap' => '6']); ?>
<?php if ($minPages): ?>
<?= ws_text('A pattern is offered here once it is hand-written on ' . $minPages . ' pages or more, or when you mark a case as one that should become a component. Fewer pages is not worth a component yet.', ['variant' => 'caption']) ?>
<?php endif; ?>
<?php if (!$suggestions): ?>
<?= ws_empty_state('No new components suggested', ['description' => 'Bespoke patterns hand-written on enough pages that no component covers them, and pieces you marked as ones that should become components, are listed here, the most used first.', 'icon' => 'lightbulb']) ?>
<?php else:
    foreach ($suggestions as $s) $suggestion($s);
endif; ?>
<?php if ($underBar): ?>
<?= ws_accordion([[
    'title' => 'Under the bar: ' . $plural(count($underBar), 'pattern', 'patterns') . ' on fewer than ' . $minPages . ' pages',
    'content' => (static function () use ($underBarRow, $underBar): string {
        ob_start();
        ws_stack_start(['gap' => '4']);
        foreach ($underBar as $s) echo $underBarRow($s);
        ws_stack_end();
        return (string) ob_get_clean();
    })(),
]], ['id' => 'under-bar']) ?>
<?php endif; ?>
<?php ws_stack_end(); ?>
<?php ws_tab_panel_end(); ?>

<script>
// Opening Changed automatically marks what it shows as seen, so the session summary stops naming it.
(function () {
    var list = document.getElementById('review-unseen');
    var ids = list ? JSON.parse(list.getAttribute('data-unseen') || '[]') : [];
    if (!ids.length) return;
    var sent = false;
    function markSeen() {
        if (sent) return;
        sent = true;
        var body = new URLSearchParams({ action: 'seen' });
        ids.forEach(function (id) { body.append('ids[]', id); });
        fetch(window.location.pathname, { method: 'POST', body: body });
    }
    var panel = document.getElementById('changed-panel');
    if (panel && panel.classList.contains('is-active')) markSeen();
    document.addEventListener('ws-tab-change', function (event) {
        if (event.detail && event.detail.tabId === 'changed') markSeen();
    });
})();
</script>
<?php require __DIR__ . '/../includes/ds-footer.php'; ?>
