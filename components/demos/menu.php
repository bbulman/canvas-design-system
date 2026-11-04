<?php
$ds_page  = 'components/demos/menu';
$ds_title = 'Action Menu';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';

// The workshop row's menu, used live in Variants and on the card below.
$demoRowItems = [
    ['label' => 'Open in Planner', 'href' => '/app/?view=plan&step=build&plan=42', 'icon' => 'edit_note', 'current' => true],
    ['label' => 'Run in Facilitator', 'href' => '/app/?view=facilitate&step=run&plan=42', 'icon' => 'play_arrow'],
    ['type' => 'separator'],
    ['label' => 'Duplicate', 'action' => 'duplicate', 'icon' => 'content_copy'],
    ['label' => 'Copy share link', 'action' => 'share', 'icon' => 'link'],
    ['label' => 'Save as template', 'action' => 'template', 'icon' => 'bookmark_add', 'disabled' => true, 'description' => 'Add an agenda first'],
    ['type' => 'separator'],
    ['label' => 'Delete', 'action' => 'delete', 'icon' => 'delete', 'danger' => true, 'modal' => 'demo-menu-confirm-delete'],
];
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">
<style>
    /* A scrolling, clipping container: the case a menu must escape. */
    .ds-menu-demo-scroll {
        max-block-size: 9rem;
        overflow: auto;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-lg);
    }
    .ds-menu-demo-scroll .ds-table { margin: 0; }
</style>

<div class="ds-page-header">
    <h1>Action Menu</h1>
    <p>The three dots at the end of a row or card, or a labelled button, that open a short list of actions on that one thing. A disclosure mode does the same for a few links to other pages.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            One card, row or page has three or more actions that do not each deserve a button: Open, Duplicate, Copy share link, Delete at the end of a workshop row. Put navigation first, then actions, then the one destructive item last, after a separator. Labels are sentence case and start with a verb. Past about seven items, group them under headings. For a few links to other pages (Buy on Kindle, Read online), use <code>'mode' =&gt; 'disclosure'</code>.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            There are one or two actions: show them as <a href="<?= $ds_base ?>/components/demos/button.php">Buttons</a>. The reader picks a value a form submits: that is a <a href="<?= $ds_base ?>/components/demos/select.php">Select</a>. The choices need a search, a form or more than about ten entries: use a <a href="<?= $ds_base ?>/components/demos/side-panel.php">Side Panel</a>. A facilitator needs the tool in the moment while running a session: keep it visible, not one click away (DESIGN.md §10.3). The workshop list's own card menu stays <code>ws_wl_menu</code> until it moves onto this one. A disclosure must not be a page's only route somewhere: without script its panel stays hidden.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Icon trigger: the actions on a row</h3>
        <p class="ds-section-desc">The default. A quiet <code>more_horiz</code> button named by the label (&ldquo;Actions for Quarterly planning offsite&rdquo;), which also names the menu. Delete opens its confirmation dialog.</p>
        <div class="ds-code"><pre>&lt;?= ws_menu('Actions for ' . $plan['name'], [
    ['label' => 'Open in Planner', 'href' => $planUrl, 'icon' => 'edit_note'],
    ['label' => 'Run in Facilitator', 'href' => $runUrl, 'icon' => 'play_arrow'],
    ['type' => 'separator'],
    ['label' => 'Duplicate', 'action' => 'duplicate', 'icon' => 'content_copy'],
    ['label' => 'Copy share link', 'action' => 'share', 'icon' => 'link'],
    ['type' => 'separator'],
    ['label' => 'Delete', 'action' => 'delete', 'icon' => 'delete', 'danger' => true, 'modal' => 'confirm-delete'],
], ['id' => 'plan-' . $id . '-menu', 'attrs' => ['data-plan-id' => $id]]) ?&gt;</pre></div>
        <div class="ds-card">
            <?= ws_menu('Actions for Quarterly planning offsite', $demoRowItems, ['id' => 'demo-menu-row', 'attrs' => ['data-plan-id' => '42']]) ?>
        </div>
        <p class="ds-section-desc">A disabled item names its reason in <code>description</code>: here <code>'disabled' =&gt; !$hasAgenda, 'description' =&gt; 'Add an agenda first'</code> on Save as template.</p>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Button trigger</h3>
        <p class="ds-section-desc"><code>'trigger' =&gt; 'button'</code> shows the label with a chevron that turns while the menu is open. Here the items are links, so a middle click opens a new tab.</p>
        <div class="ds-card">
            <?= ws_menu('Export', [
                ['label' => 'PDF', 'href' => '/app/?view=plan&step=build&plan=42&export=pdf', 'icon' => 'picture_as_pdf'],
                ['label' => 'Slide deck', 'href' => '/app/?view=plan&step=build&plan=42&export=pptx', 'icon' => 'slideshow'],
                ['label' => 'Run-of-show', 'href' => '/app/?view=plan&step=build&plan=42&export=run-of-show', 'icon' => 'format_list_numbered'],
            ], ['id' => 'demo-menu-export', 'trigger' => 'button', 'variant' => 'secondary', 'align' => 'start']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_menu('Export', [
    ['label' =&gt; 'PDF', 'href' =&gt; $pdfUrl, 'icon' =&gt; 'picture_as_pdf'],
    ['label' =&gt; 'Slide deck', 'href' =&gt; $deckUrl, 'icon' =&gt; 'slideshow'],
    ['label' =&gt; 'Run-of-show', 'href' =&gt; $runUrl, 'icon' =&gt; 'format_list_numbered'],
], ['trigger' =&gt; 'button', 'variant' =&gt; 'secondary', 'align' =&gt; 'start']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Headings, descriptions and the current item</h3>
        <p class="ds-section-desc">A <code>heading</code> starts a group that runs to the next heading or separator. <code>description</code> is a muted second line, and <code>current</code> marks where the reader already is. Create workspace opens a dialog, and closing the dialog brings focus back to this trigger.</p>
        <div class="ds-card">
            <?= ws_menu('Switch workspace', [
                ['type' => 'heading', 'label' => 'Personal'],
                ['label' => 'Bill Bulman', 'description' => 'Personal space', 'icon' => 'person', 'action' => 'workspace-personal', 'current' => true],
                ['type' => 'heading', 'label' => 'Workspaces'],
                ['label' => 'Acme facilitation', 'description' => 'Owner', 'icon' => 'groups', 'action' => 'workspace-acme'],
                ['label' => 'Northwind training', 'description' => 'Editor', 'icon' => 'groups', 'action' => 'workspace-northwind'],
                ['type' => 'separator'],
                ['label' => 'Create workspace', 'icon' => 'add', 'modal' => 'demo-menu-create'],
            ], ['id' => 'demo-menu-sections', 'trigger' => 'button', 'align' => 'start']) ?>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Disclosure: a few links</h3>
        <p class="ds-section-desc"><code>'mode' =&gt; 'disclosure'</code> is for navigation. The panel is a plain list of links in the Tab order, with no menu roles, so a screen reader keeps its reading mode. Items that open a dialog are dropped in this mode. Known limitation: the panel is hidden until <code>components.js</code> opens it, so without script these links cannot be reached; link the same places elsewhere on the page too.</p>
        <div class="ds-card">
            <?= ws_menu('Get the book', [
                ['label' => 'Buy on Kindle', 'href' => '/academy/learn/1/index.php#getbook', 'icon' => 'shopping_bag'],
                ['label' => 'Read online', 'href' => '/academy/learn/1/book1.php#about', 'icon' => 'auto_stories'],
            ], ['id' => 'demo-menu-book', 'mode' => 'disclosure', 'trigger' => 'button', 'variant' => 'primary', 'align' => 'start']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_menu('Get the book', [
    ['label' =&gt; 'Buy on Kindle', 'href' =&gt; $buyHref, 'icon' =&gt; 'shopping_bag'],
    ['label' =&gt; 'Read online', 'href' =&gt; '#about', 'icon' =&gt; 'auto_stories'],
], ['mode' =&gt; 'disclosure', 'trigger' =&gt; 'button', 'variant' =&gt; 'primary']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">A long list</h3>
        <p class="ds-section-desc">Past the room on the page the list scrolls inside the panel. Type a letter to jump: S goes to Silent timer, S again to Sketch.</p>
        <div class="ds-card">
            <?= ws_menu('Add a step', array_map(static fn(string $step): array => ['label' => $step, 'action' => strtolower(str_replace(' ', '-', $step))], ['Brainstorm', 'Check-in', 'Coffee break', 'Debrief', 'Dot voting', 'Energiser', 'Poll', 'Quiz', 'Reflection', 'Silent timer', 'Sketch', 'Story round']), ['id' => 'demo-menu-long', 'trigger' => 'button', 'variant' => 'secondary', 'align' => 'start']) ?>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">One panel for a whole list</h3>
        <p class="ds-section-desc">When every row of a list has the same menu, render the entries once with <a href="<?= $ds_base ?>/components/demos/menu-panel.php"><code>ws_menu_panel()</code></a>, and give each row's <code>ws_menu</code> the <code>panel</code> option naming it. The row draws only its trigger; the panel is cloned in after it when it opens and removed when it closes, and <code>ws-menu-open</code> lets the page drop the entries that row lacks and fill in its ids. A page of forty rows then carries one set of entries, not forty. The workshop list's card menu works this way.</p>
        <div class="ds-card">
            <?= ws_menu_panel([['label' => 'Open in Planner', 'href' => '/app/?view=plan&step=build', 'icon' => 'edit_note'], ['label' => 'Duplicate', 'action' => 'duplicate', 'icon' => 'content_copy'], ['label' => 'Copy share link', 'action' => 'share', 'icon' => 'link']], ['id' => 'demo-list-menu']) ?>
            <?php ws_cluster_start(['gap' => '4']); ?>
                <?= ws_menu('Actions for Quarterly planning offsite', [], ['id' => 'demo-list-42-menu', 'panel' => 'demo-list-menu']) ?>
                <?= ws_menu('Actions for Team retrospective', [], ['id' => 'demo-list-43-menu', 'panel' => 'demo-list-menu']) ?>
            <?php ws_cluster_end(); ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_menu_panel($rowItems, ['id' =&gt; 'plans-menu']) ?&gt;   // once, in the list

&lt;?php foreach ($plans as $plan): ?&gt;
    &lt;?= ws_menu('Actions for ' . $plan['name'], [], [
        'id'    =&gt; 'plan-' . $plan['id'] . '-menu',
        'panel' =&gt; 'plans-menu',
        'attrs' =&gt; ['data-plan-id' =&gt; $plan['id']],
    ]) ?&gt;
&lt;?php endforeach; ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">On a card that lifts on hover</h3>
        <p class="ds-section-desc">A hovered card moves with a transform, which would carry a fixed panel with it. The panel sits in the top layer instead, so it stays put and nothing on the card clips it.</p>
        <?php ws_grid_start(['min' => 'md', 'gap' => '4']); ?>
            <?php ws_card_start(['hoverable' => true, 'bordered' => true]); ?>
                <?php ws_cluster_start(['justify' => 'between', 'align' => 'start', 'gap' => '3']); ?>
                    <div>
                        <?= ws_text('Quarterly planning offsite', ['variant' => 'title']) ?>
                        <?= ws_text('Two days, 14 people', ['variant' => 'caption']) ?>
                    </div>
                    <?= ws_menu('Actions for Quarterly planning offsite', $demoRowItems, ['id' => 'demo-menu-card', 'attrs' => ['data-plan-id' => '42']]) ?>
                <?php ws_cluster_end(); ?>
            <?php ws_card_end(); ?>
        <?php ws_grid_end(); ?>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">In a scrolling table</h3>
        <p class="ds-section-desc">The table below scrolls and clips its overflow. The open panel is not cut off; scroll the table and the panel follows its trigger, and closes once the trigger has scrolled out of view.</p>
        <div class="ds-menu-demo-scroll">
            <table class="ds-table">
                <thead><tr><th>Workshop</th><th>Length</th><th>Actions</th></tr></thead>
                <tbody>
                    <tr><td>Team retrospective</td><td>90 min</td><td><?= ws_menu('Actions for Team retrospective', [['label' => 'Open in Planner', 'href' => '/app/?view=plan&step=build&plan=7', 'icon' => 'edit_note'], ['label' => 'Duplicate', 'action' => 'duplicate', 'icon' => 'content_copy'], ['label' => 'Copy share link', 'action' => 'share', 'icon' => 'link']], ['id' => 'demo-menu-table-7']) ?></td></tr>
                    <tr><td>Design sprint kickoff</td><td>Half day</td><td><?= ws_menu('Actions for Design sprint kickoff', [['label' => 'Open in Planner', 'href' => '/app/?view=plan&step=build&plan=8', 'icon' => 'edit_note'], ['label' => 'Duplicate', 'action' => 'duplicate', 'icon' => 'content_copy']], ['id' => 'demo-menu-table-8']) ?></td></tr>
                    <tr><td>Onboarding workshop</td><td>2 hours</td><td><?= ws_menu('Actions for Onboarding workshop', [['label' => 'Open in Planner', 'href' => '/app/?view=plan&step=build&plan=9', 'icon' => 'edit_note'], ['label' => 'Duplicate', 'action' => 'duplicate', 'icon' => 'content_copy']], ['id' => 'demo-menu-table-9']) ?></td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Open</td><td>The trigger's <code>aria-expanded="true"</code>; an icon trigger keeps its hover look while open, a button trigger's chevron turns.</td></tr>
            <tr><td>Active item</td><td>Hover and the arrow keys share one active item: hovering an item focuses it, so the arrows carry on from where the pointer is. The focus ring shows only from the keyboard.</td></tr>
            <tr><td>Current</td><td><code>aria-current="true"</code>, red and semibold: where the reader already is.</td></tr>
            <tr><td>Disabled</td><td><code>aria-disabled="true"</code>. Still focusable, so it is found and its <code>description</code> heard as the reason; it never activates and the menu stays open.</td></tr>
            <tr><td>Danger</td><td>Error red text and icon. Always confirms in a <code>ws_modal</code>: the item is a button that opens the dialog named by its <code>modal</code>, even when it was also given an <code>href</code>. With no <code>modal</code> it renders disabled.</td></tr>
            <tr><td>Busy</td><td>A listener may set <code>aria-busy="true"</code> on an item during a slow action; it reads faint and does not activate.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The workshop list's card menu (<code>ws_wl_menu</code> in <code>app/includes/workshop-list.php</code>) is a <code>ws_menu</code> on one shared panel per list. Its <code>app/js/workshop-list-menu.js</code> cuts each clone down to the row on <code>ws-menu-open</code>, runs duplicate, share, template and comments on <code>ws-menu-action</code>, and fills the page's one delete confirmation on <code>ws-menu-dialog</code>. The team page's row menus, the book pages' Get the book and the planner landing's switcher come next; each builds its own copy today.</p>
</section>

<!-- 6. Keyboard and events -->
<section class="ds-section">
    <h2 class="ds-section-title">Keyboard</h2>
    <table class="ds-table">
        <thead><tr><th>Key</th><th>Where</th><th>Menu mode</th><th>Disclosure</th></tr></thead>
        <tbody>
            <tr><td><kbd>Enter</kbd>, <kbd>Space</kbd></td><td>Trigger</td><td>Open on the first item</td><td>Open or close; focus stays on the trigger</td></tr>
            <tr><td><kbd>&darr;</kbd> / <kbd>&uarr;</kbd></td><td>Trigger</td><td>Open on the first / last item</td><td>Nothing</td></tr>
            <tr><td><kbd>&darr;</kbd> / <kbd>&uarr;</kbd></td><td>Item</td><td>Next / previous item, wrapping; disabled items included, headings and separators skipped</td><td>Next / previous link, wrapping</td></tr>
            <tr><td><kbd>Home</kbd> / <kbd>End</kbd></td><td>Item</td><td>First / last item</td><td>First / last link</td></tr>
            <tr><td>A letter</td><td>Item</td><td>The next item starting with it</td><td>Nothing</td></tr>
            <tr><td><kbd>Enter</kbd>, <kbd>Space</kbd></td><td>Item</td><td>Choose it</td><td>The link's own</td></tr>
            <tr><td><kbd>Esc</kbd></td><td>Anywhere in the menu</td><td>Close, focus on the trigger</td><td>Close, focus on the trigger</td></tr>
            <tr><td><kbd>Tab</kbd></td><td>Item</td><td>Close, and move on to the control after the menu</td><td>The browser's; leaving the panel closes it</td></tr>
            <tr><td><kbd>Shift</kbd>+<kbd>Tab</kbd></td><td>Item</td><td>Close, focus on the trigger</td><td>The browser's</td></tr>
        </tbody>
    </table>

    <h3 class="ds-subsection-title">Events</h3>
    <p class="ds-section-desc">All bubble from the menu's wrapper. <code>ws-menu-open</code> fires once the panel is shown and placed, before focus moves, so a listener can still edit the entries; <code>ws-menu-close</code> carries its <code>reason</code> (escape, outside, tab, select, toggle, scroll, api); <code>ws-menu-action</code> fires when an item with an <code>action</code> that acts at once is chosen, after the menu has closed and focus is back on the trigger. An item that opens a dialog (a <code>modal</code> or <code>sidePanel</code>) never fires <code>ws-menu-action</code>: it fires <code>ws-menu-dialog</code> with <code>action</code>, <code>modal</code> or <code>sidePanel</code>, <code>item</code>, <code>menu</code> and <code>trigger</code>, just before the dialog opens, so the page can say in the dialog which workshop it is about. Only the dialog's own button deletes. Choose an item above to see the event here.</p>
    <p class="ds-section-desc" id="demo-menu-log" role="status">No action chosen yet.</p>
    <div class="ds-code"><pre>document.addEventListener('ws-menu-action', function (e) {
    if (e.detail.action === 'duplicate') duplicatePlan(e.detail.menu.dataset.planId);
});
document.addEventListener('ws-menu-dialog', function (e) {
    // Fill in the confirmation; it opens next. Its own Delete button deletes.
    if (e.detail.modal === 'confirm-delete') confirmDelete.dataset.planId = e.detail.menu.dataset.planId;
});</pre></div>
    <p class="ds-section-desc">Scripting: <code>wsMenuOpen(menu, { focus: 'first' })</code>, <code>wsMenuClose(menu, { restoreFocus, reason })</code> and <code>wsMenuToggle(menu)</code>, where <code>menu</code> is the wrapper or its id. From JavaScript, draw one with <code>ws.menu(label, items, options)</code> from <code>js/ws.js</code>; it needs no <code>ws.init()</code>.</p>
</section>

<!-- 7. Do and don't -->
<section class="ds-section">
    <h2 class="ds-section-title">Do and Don't</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do:</strong>
            show one or two actions as buttons, where they can be seen.
            <div class="ds-gap-above">
                <?php ws_cluster_start(['gap' => '2']); ?>
                    <?= ws_button('Duplicate', ['variant' => 'ghost', 'size' => 'sm', 'icon' => 'content_copy']) ?>
                    <?= ws_button('Copy share link', ['variant' => 'ghost', 'size' => 'sm', 'icon' => 'link']) ?>
                <?php ws_cluster_end(); ?>
            </div>
        </div>
        <div class="ds-dont">
            <strong>Don't:</strong>
            give a destructive item no confirmation. A <code>danger</code> item always names a <code>modal</code>, the confirmation <a href="<?= $ds_base ?>/patterns/composition.php">the destructive-confirmation recipe</a> builds. Without one it renders disabled and the dev server warns; an <code>href</code> on it is ignored.
            <div class="ds-code"><pre>['label' =&gt; 'Delete', 'href' =&gt; '/x?delete=1', 'danger' =&gt; true]   // no modal: disabled, the href ignored</pre></div>
        </div>
    </div>
</section>

<!-- 8. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Values</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>$label</code></td><td>string</td><td>required</td><td>The trigger's accessible name and, through <code>aria-labelledby</code>, the menu's; a button trigger's visible text</td></tr>
            <tr><td><code>$items</code></td><td>array</td><td>required</td><td>The entries, below. With none left to show the helper prints nothing</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>ws-menu-{n}</code></td><td>Wrapper id; the trigger, panel, list and items derive theirs. Pass one per row</td></tr>
            <tr><td><code>trigger</code></td><td><code>icon</code> | <code>button</code></td><td><code>icon</code></td><td>An icon-only button named by the label, or a button showing it</td></tr>
            <tr><td><code>icon</code></td><td>Material Symbols name</td><td><code>more_horiz</code></td><td>The icon trigger's glyph</td></tr>
            <tr><td><code>variant</code></td><td><code>ghost</code> | <code>secondary</code> | <code>primary</code></td><td><code>ghost</code></td><td>The trigger's button variant</td></tr>
            <tr><td><code>size</code></td><td><code>sm</code> | <code>md</code></td><td><code>sm</code></td><td>The trigger's button size</td></tr>
            <tr><td><code>align</code></td><td><code>end</code> | <code>start</code></td><td><code>end</code></td><td>Which edge of the panel lines up with the trigger's</td></tr>
            <tr><td><code>placement</code></td><td><code>bottom</code> | <code>top</code></td><td><code>bottom</code></td><td>The preferred side; it flips when that side lacks room</td></tr>
            <tr><td><code>mode</code></td><td><code>menu</code> | <code>disclosure</code></td><td><code>menu</code></td><td>Actions, or a few links to other pages</td></tr>
            <tr><td><code>class</code>, <code>attrs</code></td><td>string, array</td><td></td><td>On the wrapper (the row's data, such as <code>data-plan-id</code>)</td></tr>
            <tr><td><code>triggerAttrs</code></td><td>array</td><td></td><td>Extra attributes on the trigger; its ids, name and ARIA stay the component's</td></tr>
            <tr><td><code>panel</code></td><td>a <code>ws_menu_panel()</code> id</td><td></td><td>Clone that shared panel on open instead of items of its own; the menu draws only its trigger</td></tr>
        </tbody>
    </table>
    <h3 class="ds-subsection-title">Item keys</h3>
    <table class="ds-table">
        <thead><tr><th>Key</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>type</code></td><td><code>item</code> (the default), <code>separator</code>, or <code>heading</code>, which starts a group</td></tr>
            <tr><td><code>label</code></td><td>Required; an item with none is dropped. Sentence case, verb first</td></tr>
            <tr><td><code>href</code></td><td>A link. Wins over everything below, except on a danger item. Only http, https, mailto, tel, relative and fragment hrefs; any other scheme, such as <code>javascript:</code>, is dropped</td></tr>
            <tr><td><code>action</code></td><td>A button; choosing it fires <code>ws-menu-action</code> with this name</td></tr>
            <tr><td><code>icon</code></td><td>A leading 24px icon</td></tr>
            <tr><td><code>description</code></td><td>A muted second line, and the item's accessible description: a disabled item's reason</td></tr>
            <tr><td><code>danger</code></td><td>Destructive. Put it last, after a separator, and give it a <code>modal</code>: it is always a button that opens that confirmation, and without one it is disabled</td></tr>
            <tr><td><code>disabled</code></td><td>Focusable, never activates. A disabled link renders as a button</td></tr>
            <tr><td><code>current</code></td><td>Where the reader already is</td></tr>
            <tr><td><code>modal</code></td><td>A <code>ws_modal</code> id: the menu closes, focus goes to the trigger, <code>ws-menu-dialog</code> fires, the dialog opens, and closing it returns focus to the trigger. Menu mode only</td></tr>
            <tr><td><code>sidePanel</code></td><td>A <code>ws_side_panel</code> id, the same way. Menu mode only</td></tr>
            <tr><td><code>attrs</code></td><td>Extra attributes on the item, names lowercased. Nothing the item writes itself (role, tabindex, href, type, its ARIA, <code>data-ws-menu-*</code>) can be set here</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <p class="ds-section-desc">Menu mode is the <a href="https://www.w3.org/WAI/ARIA/apg/patterns/menu-button/" target="_blank" rel="noopener">WAI-ARIA menu button</a>; disclosure mode is the <a href="https://www.w3.org/WAI/ARIA/apg/patterns/disclosure/" target="_blank" rel="noopener">disclosure</a> APG recommends for site navigation.</p>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Names</td><td>The trigger is named by the label (its <code>aria-label</code> on an icon trigger, its text on a button trigger), and the menu by the trigger through <code>aria-labelledby</code>. An item is named by its label alone; its description is its <code>aria-describedby</code>. A group is named by its heading.</td></tr>
            <tr><td>Roles and state</td><td>Menu mode: <code>role="menu"</code>, <code>menuitem</code>, <code>separator</code> and <code>group</code>; the trigger has <code>aria-haspopup="menu"</code>. Disclosure: no menu roles, a list of links. The trigger's <code>aria-expanded</code> is always true or false and its <code>aria-controls</code> names an element in the page.</td></tr>
            <tr><td>Keyboard</td><td>As the table above. Items are out of the Tab order in menu mode, reached with the arrows. Focus never lands on something hidden: every close either returns it to the trigger or leaves it where the reader put it.</td></tr>
            <tr><td>Dialogs</td><td>An item that opens a <code>ws_modal</code> or side panel closes the menu and focuses the trigger first, so the dialog hands focus back to the trigger. Escape in a menu inside an open modal closes only the menu. A menu that closes on its own (scrolled away, or closed by a script) puts focus on the trigger rather than dropping it.</td></tr>
            <tr><td>Disabled</td><td><code>aria-disabled="true"</code>, still focusable, so it is found and its reason heard. GrayText in forced colours.</td></tr>
            <tr><td>Targets</td><td>40px items and a 40px trigger with a fine pointer; 44px (<code>--target-comfortable</code>) on touch.</td></tr>
            <tr><td>Contrast</td><td>Trigger icon <code>--text-muted</code> (5.39:1 on white), items <code>--text-default</code> (7.66:1), danger <code>--color-error-dark</code> (4.83:1), current <code>--brand-ink</code> (5.02:1). A focused danger item and its description turn <code>--color-error-ink</code> on the danger tint (6.6:1). Disabled text is exempt; its reason is not and stays <code>--text-muted</code>.</td></tr>
            <tr><td>Motion</td><td>One 150ms entrance, a 4px drift away from the trigger; none under reduced motion. Closing is instant.</td></tr>
            <tr><td>Forced colours</td><td>The focused item takes a Highlight outline, separators are drawn in CanvasText and disabled items in GrayText; danger and current carry their meaning in words and weight, not colour alone.</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Use</th></tr></thead>
        <tbody>
            <tr><td><code>--ws-menu-gap</code> / <code>--ws-menu-edge</code></td><td>Space between trigger and panel (<code>--space-1-5</code>), and the margin the panel keeps from the viewport's edge (<code>--space-2</code>)</td></tr>
            <tr><td><code>--ws-menu-min-width</code> / <code>--ws-menu-max-width</code> / <code>--ws-menu-max-height</code></td><td>216px, 320px and 360px by default; set them on the wrapper</td></tr>
            <tr><td><code>--bg-surface</code>, <code>--gray-200</code>, <code>--radius-lg</code>, <code>--shadow-lg</code></td><td>The white panel, its edge, corners and lift</td></tr>
            <tr><td><code>--z-dropdown</code></td><td>The stacking of the fallback panel where the browser has no top layer</td></tr>
            <tr><td><code>--text-default</code>, <code>--text-dark</code>, <code>--text-muted</code>, <code>--gray-100</code></td><td>Item text, the active item and its background, icons, descriptions and headings</td></tr>
            <tr><td><code>--brand-ink</code>, <code>--brand</code></td><td>The current item's text and icon</td></tr>
            <tr><td><code>--color-error-dark</code>, <code>--color-error-very-light</code>, <code>--color-error-ink</code></td><td>Danger at rest and active</td></tr>
            <tr><td><code>--text-faint</code>, <code>--gray-50</code></td><td>Disabled</td></tr>
            <tr><td><code>--target-min</code>, <code>--icon-lg</code>, <code>--space-2</code>, <code>--target-comfortable</code></td><td>Item height: one icon plus its padding (40px) with a fine pointer, 44px on touch</td></tr>
            <tr><td><code>--focus-ring</code>, <code>--focus-ring-width</code></td><td>The keyboard ring, inset on an item</td></tr>
            <tr><td><code>--duration-fast</code>, <code>--ease-out</code></td><td>The entrance and the chevron's turn</td></tr>
        </tbody>
    </table>
</section>

<!-- 11. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-menu</code></td><td>The wrapper; <code>--align-start</code>/<code>--align-end</code>, <code>--top</code> and <code>--disclosure</code> modifiers</td></tr>
            <tr><td><code>.ws-menu__trigger</code></td><td>The trigger, a <code>ws_button</code></td></tr>
            <tr><td><code>.ws-menu__panel</code></td><td>The panel; <code>[data-side]</code> says which side it opened on</td></tr>
            <tr><td><code>.ws-menu__list</code></td><td>The <code>role="menu"</code> list, or a disclosure's <code>&lt;ul&gt;</code></td></tr>
            <tr><td><code>.ws-menu__item</code></td><td>An item; <code>--danger</code> for a destructive one</td></tr>
            <tr><td><code>.ws-menu__icon</code>, <code>.ws-menu__text</code>, <code>.ws-menu__label</code>, <code>.ws-menu__desc</code></td><td>An item's parts</td></tr>
            <tr><td><code>.ws-menu__group</code>, <code>.ws-menu__heading</code>, <code>.ws-menu__separator</code></td><td>Grouping</td></tr>
        </tbody>
    </table>
</section>

<!-- 12. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_menu()</code> and <code>ws_menu_panel()</code></td></tr>
            <tr><td><code>includes/components/menu.php</code></td><td>Template</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles, in the MENU COMPONENT block</td></tr>
            <tr><td><code>includes/components/components.js</code></td><td><code>wsMenuOpen/Close/Toggle()</code>, placement, keys, focus and dismissal, all delegated</td></tr>
            <tr><td><code>js/ws.js</code></td><td><code>ws.menu()</code>, the same markup from JavaScript</td></tr>
        </tbody>
    </table>
</section>

<?= ws_modal('<p>Delete <strong>Quarterly planning offsite</strong> and its 14 agenda items? This cannot be undone.</p>'
    . ws_modal_footer([
        'cancel' => ['text' => 'Keep workshop', 'attrs' => ['data-modal-close' => 'demo-menu-confirm-delete']],
        'primary' => ['text' => 'Delete workshop', 'variant' => 'danger', 'icon' => 'delete', 'attrs' => ['data-modal-close' => 'demo-menu-confirm-delete']],
    ]), ['id' => 'demo-menu-confirm-delete', 'title' => 'Delete this workshop?', 'size' => 'sm']) ?>
<?= ws_modal(ws_input('demo-workspace-name', ['label' => 'Workspace name', 'required' => true])
    . ws_modal_footer([
        'cancel' => ['text' => 'Cancel', 'attrs' => ['data-modal-close' => 'demo-menu-create']],
        'primary' => ['text' => 'Create workspace', 'icon' => 'add', 'attrs' => ['data-modal-close' => 'demo-menu-create']],
    ]), ['id' => 'demo-menu-create', 'title' => 'Create a workspace', 'size' => 'sm']) ?>

<script>
['ws-menu-action', 'ws-menu-dialog'].forEach(function (type) {
    document.addEventListener(type, function (e) {
        var log = document.getElementById('demo-menu-log');
        var from = e.detail.trigger.getAttribute('aria-label') || e.detail.trigger.textContent.trim();
        var opens = e.detail.modal || e.detail.sidePanel;
        if (log) log.textContent = type + ': ' + (e.detail.action || 'no action') + ', from ' + from + (opens ? ', opening ' + opens : '');
    });
});
</script>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
