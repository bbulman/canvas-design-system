<?php
$ds_page  = 'components/javascript';
$ds_title = 'Components in JavaScript';

require_once __DIR__ . '/../../includes/icon.php';
require_once __DIR__ . '/../../includes/components/helpers.php';

$escape = static fn($value) => htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');

/* Each sample: the PHP call and what it prints, beside the ws.* call, which runs on this page as written. */
$samples = [
    'button' => [
        'title' => 'Button',
        'php'   => "ws_button('Save workshop', ['icon' => 'save']) . ws_button('Cancel', ['variant' => 'secondary'])",
        'html'  => ws_button('Save workshop', ['icon' => 'save']) . ws_button('Cancel', ['variant' => 'secondary']),
        'js'    => "ws.button('Save workshop', { icon: 'save' }) + ws.button('Cancel', { variant: 'secondary' })",
    ],
    'badge' => [
        'title' => 'Badge, status and duration',
        'php'   => "ws_status('Completed', 'success') . ws_duration('45 min') . ws_category('Exercise', '#2563EB')",
        'html'  => ws_status('Completed', 'success') . ws_duration('45 min') . ws_category('Exercise', '#2563EB'),
        'js'    => "ws.status('Completed', 'success') + ws.duration('45 min') + ws.category('Exercise', '#2563EB')",
    ],
    'pill' => [
        'title' => 'Pill',
        'php'   => "ws_pill('Remote-friendly') . ws_pill('Beginner', ['variant' => 'solid', 'color' => 'learn'])",
        'html'  => ws_pill('Remote-friendly') . ws_pill('Beginner', ['variant' => 'solid', 'color' => 'learn']),
        'js'    => "ws.pill('Remote-friendly') + ws.pill('Beginner', { variant: 'solid', color: 'learn' })",
    ],
    'alert' => [
        'title' => 'Alert',
        'php'   => "ws_alert('Your co-facilitators see the new version now.', ['variant' => 'success', 'title' => 'Agenda saved'])",
        'html'  => ws_alert('Your co-facilitators see the new version now.', ['variant' => 'success', 'title' => 'Agenda saved']),
        'js'    => "ws.alert(ws.esc('Your co-facilitators see the new version now.'), { variant: 'success', title: 'Agenda saved' })",
    ],
    'input' => [
        'title' => 'Input',
        'php'   => "ws_input('php-title', ['label' => 'Workshop title', 'hint' => 'Give your workshop a name.'])",
        'html'  => ws_input('php-title', ['label' => 'Workshop title', 'hint' => 'Give your workshop a name.']),
        'js'    => "ws.input('js-title', { label: 'Workshop title', hint: 'Give your workshop a name.' })",
    ],
    'select' => [
        'title' => 'Select',
        'php'   => "ws_select('php-length', ['90' => '90 minutes', '120' => '2 hours', '240' => 'Half day'], ['label' => 'Workshop length', 'value' => '120'])",
        'html'  => ws_select('php-length', ['90' => '90 minutes', '120' => '2 hours', '240' => 'Half day'], ['label' => 'Workshop length', 'value' => '120']),
        'js'    => "ws.select('js-length', [[90, '90 minutes'], [120, '2 hours'], [240, 'Half day']], { label: 'Workshop length', value: 120 })",
    ],
    'avatar' => [
        'title' => 'Avatar',
        'php'   => "ws_avatar('Priya Shah') . ws_avatar('Marcus Webb', ['status' => 'online'])",
        'html'  => ws_avatar('Priya Shah') . ws_avatar('Marcus Webb', ['status' => 'online']),
        'js'    => "ws.avatar('Priya Shah') + ws.avatar('Marcus Webb', { status: 'online' })",
    ],
    'tabs' => [
        'title' => 'Tabs and panels',
        'php'   => "ws_tabs([['id' => 'php-agenda', 'label' => 'Agenda', 'active' => true], ['id' => 'php-notes', 'label' => 'Notes', 'count' => 3]], ['id' => 'php-tabs', 'label' => 'Sections'])\n// then ws_tab_panel_start('php-agenda') ... ws_tab_panel_end() for each panel",
        'html'  => (function () {
            ob_start();
            echo ws_tabs([['id' => 'php-agenda', 'label' => 'Agenda', 'active' => true], ['id' => 'php-notes', 'label' => 'Notes', 'count' => 3]], ['id' => 'php-tabs', 'label' => 'Sections']);
            ws_tab_panel_start('php-agenda');
            echo '<p>Arrive by nine.</p>';
            ws_tab_panel_end();
            ws_tab_panel_start('php-notes');
            echo '<p>Three notes from the last run.</p>';
            ws_tab_panel_end();
            return ob_get_clean();
        })(),
        'js'    => "ws.tabs([{ id: 'js-agenda', label: 'Agenda', active: true }, { id: 'js-notes', label: 'Notes', count: 3 }], { id: 'js-tabs', label: 'Sections' })\n    + ws.tabPanel('js-agenda', '<p>Arrive by nine.</p>')\n    + ws.tabPanel('js-notes', '<p>Three notes from the last run.</p>')",
    ],
    'skeleton' => [
        'title' => 'Skeleton',
        'php'   => "ws_skeleton(['lines' => 3])",
        'html'  => ws_skeleton(['lines' => 3]),
        'js'    => "ws.skeleton({ lines: 3 })",
    ],
    'empty-state' => [
        'title' => 'Empty state',
        'php'   => "ws_empty_state('No workshops yet', ['description' => 'Your saved workshops will appear here.', 'icon' => 'event_note'])",
        'html'  => ws_empty_state('No workshops yet', ['description' => 'Your saved workshops will appear here.', 'icon' => 'event_note']),
        'js'    => "ws.emptyState('No workshops yet', { description: 'Your saved workshops will appear here.', icon: 'event_note' })",
    ],
    'card' => [
        'title' => 'Card',
        'php'   => "ws_card('<h3>Product planning</h3><p>A two-hour workshop for the product team.</p>')",
        'html'  => ws_card('<h3>Product planning</h3><p>A two-hour workshop for the product team.</p>'),
        'js'    => "ws.card('<h3>Product planning</h3><p>A two-hour workshop for the product team.</p>')",
    ],
];

require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>Components in JavaScript</h1>
    <p>A script that draws a component calls its twin in <code class="ds-code-inline">js/ws.js</code> instead of copying the component's <code class="ds-code-inline">ws-*</code> markup. Each <code class="ds-code-inline">ws.*</code> function takes the PHP helper's arguments in the same order and its options by the same names, and returns an HTML string. Below, the left column is the PHP helper printed on the server and the right is the <code class="ds-code-inline">ws.*</code> call run in this page; <code class="ds-code-inline">tests/design-system/ws-components.spec.js</code> holds the two to the same markup for every playground state.</p>
</div>

<section class="ds-section" aria-labelledby="js-rules">
    <h2 class="ds-section-title" id="js-rules">How to use it</h2>
    <p class="ds-section-desc">Load it after <code class="ds-code-inline">components.js</code>, with a cache-bust, and after <code class="ds-code-inline">js/ws-agent.js</code> on a page that draws the AI badge. Every value is escaped except an alert's message and a card's content, which take markup as their PHP slots do: put text through <code class="ds-code-inline">ws.esc()</code> first. Markup added after the page loaded has no behaviour yet, so once it is in the page, panels included, call <code class="ds-code-inline">ws.init(container)</code>. The catalog entry's <code class="ds-code-inline">js</code> field names each twin, and <code class="ds-code-inline">npm run ds:find</code> prints it.</p>
    <div class="ds-code"><pre>&lt;script src="/js/ws.js?v=&lt;?= filemtime(WS_ROOT . '/js/ws.js') ?&gt;"&gt;&lt;/script&gt;

list.innerHTML = rows.map(r =&gt; ws.button(r.title, { variant: 'secondary', attrs: { 'data-id': r.id } })).join('');
ws.init(list);</pre></div>
</section>

<?php foreach ($samples as $key => $s): ?>
<section class="ds-section" aria-labelledby="sample-<?= $escape($key) ?>">
    <h2 class="ds-section-title" id="sample-<?= $escape($key) ?>"><?= $escape($s['title']) ?></h2>
    <div class="ds-grid-2 ds-js-pair">
        <div>
            <h3 class="ds-subsection-title">PHP</h3>
            <div class="ds-card ds-js-sample"><?= $s['html'] ?></div>
            <div class="ds-code"><pre>&lt;?= <?= $escape($s['php']) ?> ?&gt;</pre></div>
        </div>
        <div>
            <h3 class="ds-subsection-title">JavaScript</h3>
            <div class="ds-card ds-js-sample" data-ws-sample="<?= $escape($key) ?>"></div>
            <div class="ds-code"><pre><?= $escape($s['js']) ?></pre></div>
        </div>
    </div>
</section>
<?php endforeach; ?>

<style>
/* A grid column grows to its longest code line unless it may shrink; the code then scrolls in its own box. */
.ds-js-pair > div { min-width: 0; }
.ds-js-sample { display: flex; flex-wrap: wrap; gap: var(--space-3); align-items: center; }
.ds-js-sample > .ws-field, .ds-js-sample > .ws-tabs, .ds-js-sample > .ws-tab-pane, .ds-js-sample > .ws-skeleton-text, .ds-js-sample > .ws-alert, .ds-js-sample > .ws-card, .ds-js-sample > .ws-empty-state { flex-basis: 100%; }
</style>
<script src="<?= $site_base ?>/js/ws-agent.js?v=<?= filemtime(__DIR__ . '/../../js/ws-agent.js') ?>"></script>
<script src="<?= $site_base ?>/js/ws.js?v=<?= filemtime(__DIR__ . '/../../js/ws.js') ?>"></script>
<script>
/* Each sample's ws.* call, exactly as printed beside it, drawn while the page loads; ws.init waits for components.js. */
var wsSamples = {
<?php foreach ($samples as $key => $s): ?>
    <?= json_encode($key) ?>: function () { return <?= $s['js'] ?>; },
<?php endforeach; ?>
};
document.querySelectorAll('[data-ws-sample]').forEach(function (host) {
    host.innerHTML = wsSamples[host.getAttribute('data-ws-sample')]();
    ws.init(host);
});
</script>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
