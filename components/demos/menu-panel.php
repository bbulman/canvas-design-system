<?php
$ds_page  = 'components/demos/menu-panel';
$ds_title = 'Action Menu: one panel per list';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Action Menu: one panel per list</h1>
    <p>A list whose rows share one menu renders its entries once. <code>ws_menu_panel</code> prints the panel as a template, and each row's <a href="<?= $ds_base ?>/components/demos/menu.php">Action Menu</a> names it with <code>panel</code>.</p>
</div>

<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            Every row of a list has the same menu, give or take a few entries a row may lack: a list of workshops, of team members, of files. Render the entries once with <code>ws_menu_panel</code>, give each row <code>ws_menu($label, [], ['panel' =&gt; $id])</code>, and drop the entries a row lacks in a <code>ws-menu-open</code> listener. The page carries one set of entries instead of one per row.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            There is one menu, or the rows' menus differ in more than a few removable entries: give each <code>ws_menu</code> its own items. The panel's <code>mode</code> must match the menus that use it.
        </div>
    </div>
</section>

<section class="ds-section">
    <h2 class="ds-section-title">Example</h2>
    <p class="ds-section-desc">Two rows, one panel. Open either menu: the panel is cloned in after that row's trigger, and removed when it closes.</p>
    <div class="ds-card">
        <?= ws_menu_panel([['label' => 'Open in Planner', 'href' => '/app/?view=plan&step=build', 'icon' => 'edit_note'], ['label' => 'Duplicate', 'action' => 'duplicate', 'icon' => 'content_copy'], ['label' => 'Copy share link', 'action' => 'share', 'icon' => 'link']], ['id' => 'demo-shared-menu']) ?>
        <?php ws_cluster_start(['gap' => '4']); ?>
            <?= ws_menu('Actions for Quarterly planning offsite', [], ['id' => 'demo-shared-42-menu', 'panel' => 'demo-shared-menu', 'attrs' => ['data-plan-id' => '42']]) ?>
            <?= ws_menu('Actions for Team retrospective', [], ['id' => 'demo-shared-43-menu', 'panel' => 'demo-shared-menu', 'attrs' => ['data-plan-id' => '43']]) ?>
        <?php ws_cluster_end(); ?>
    </div>
    <div class="ds-code"><pre>document.addEventListener('ws-menu-open', function (e) {
    const id = e.target.dataset.planId;           // the row's own facts, on its menu
    e.detail.panel.querySelectorAll('a[href]').forEach(a =&gt; a.href += '&amp;plan=' + id);
});</pre></div>
</section>

<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>At rest</td><td>The template is inert, so the page holds no entries and the trigger promises no <code>aria-controls</code> it cannot keep.</td></tr>
            <tr><td>Open</td><td>The clone is the panel <code>ws_menu</code> renders: its list is <code>role="menu"</code>, named by the row's trigger, and the trigger's <code>aria-controls</code> names it while it is in the page. Keys, focus and dismissal are <code>ws_menu</code>'s.</td></tr>
            <tr><td>Closed</td><td>The clone is removed and <code>aria-controls</code> with it; the next open clones afresh against the row as it is then.</td></tr>
        </tbody>
    </table>
</section>

<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_menu_panel()</code>, and <code>ws_menu()</code>'s <code>panel</code> option</td></tr>
            <tr><td><code>includes/components/menu.php</code></td><td>The template both render through</td></tr>
            <tr><td><code>includes/components/components.js</code></td><td><code>wsMenuClonePanel()</code>: the clone on open, removed by <code>wsMenuClose()</code></td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
