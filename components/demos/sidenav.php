<?php
$ds_page  = 'components/demos/sidenav';
$ds_title = 'Side Navigation';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';

/** The platform journey in phase order, plus the shelves. The canonical set. */
$ds_sidenav_items = [
    ['label' => 'Home',       'icon' => 'home',              'href' => '/app/'],
    ['label' => 'Strategize', 'icon' => 'knight',            'href' => '/app/?view=strategize', 'active' => true],
    ['label' => 'Plan',       'icon' => 'calendar_view_day', 'href' => '/app/?view=plan'],
    ['label' => 'Facilitate', 'icon' => 'groups',            'href' => '/app/?view=facilitate'],
    ['label' => 'Synthesize', 'icon' => 'hub',               'href' => '/app/?view=synthesize'],
    ['type'  => 'divider'],
    ['label' => 'Library',      'icon' => 'auto_stories', 'href' => '/app/?view=library'],
    ['label' => 'Rescue Cards', 'icon' => 'stacks',       'href' => '/app/?view=cards', 'badge' => 37],
];
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<style>
/* Demo scaffolding only. The nav is height: 100%, so it needs a parent with a
   height to sit in; in production that parent is the app shell's body. */
.ds-nav-stage {
    display: flex;
    height: 560px;
    overflow: hidden;
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-lg);
    background: var(--bg-surface);
}
.ds-nav-stage--auto { height: auto; }
.ds-nav-stage--wide { max-width: 520px; }
.ds-nav-stage--matrix { max-width: 420px; }
.ds-nav-stage__body {
    flex: 1;
    min-width: 0;
    padding: var(--space-6);
    color: var(--text-muted);
    font-size: var(--text-small);
}
.ds-nav-pair {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
    gap: var(--space-6);
}
@media (max-width: 768px) { .ds-nav-pair { grid-template-columns: 1fr; } }
.ds-nav-gap-top { margin-top: var(--space-6); }
.ds-nav-footer-chip {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    font-size: var(--text-meta);
    color: var(--text-muted);
}
</style>

<div class="ds-page-header">
    <h1>Side Navigation</h1>
    <p>The vertical rail down an app shell's left edge: the only way between apps when there is no browser chrome and no horizontal header nav.</p>
</div>

<div class="ds-note" style="margin-bottom: 32px;">
    <span class="material-symbols-outlined">info</span>
    <span>This page documents the API and the states. The Material 3 provenance, the role mapping onto Workshopr tokens, and the measured contrast decisions live on <a href="<?= $ds_base ?>/redesign/sidenav.php">Side Navigation in the Redesign track</a>. Read that one for <em>why</em>; read this one for <em>what to pass</em>.</span>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            A full-height app shell needs persistent navigation between apps: the installed PWA frame, a kiosk or popup mode, or any surface where <code>ws_header()</code>'s horizontal nav has been suppressed. It pairs with <code>ws_app_bar()</code>, which acts on the open document while the rail moves between apps.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The page is an ordinary web page. That already has <code>ws_header()</code>, and two navs competing for the same job is worse than either alone. For in-page sections use <a href="<?= $ds_base ?>/components/demos/tabs.php">Tabs</a>; for a trail back up a hierarchy use <a href="<?= $ds_base ?>/components/demos/breadcrumb.php">Breadcrumb</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>
    <p class="ds-section-desc">Two. Labels show in both: what changes is where the label sits and what the active indicator wraps. Any value other than <code class="ds-code-inline">expanded</code> or <code class="ds-code-inline">rail</code> is silently coerced to <code class="ds-code-inline">expanded</code>, so a typo degrades rather than breaking.</p>

    <div class="ds-nav-pair">
        <div class="ds-subsection">
            <h3 class="ds-subsection-title">Expanded, 240px (default)</h3>
            <p class="ds-section-desc">Icon beside label. The 56px pill is the item container itself, inset 20px from the edge.</p>
            <div class="ds-nav-stage">
                <?= ws_sidenav($ds_sidenav_items, [
                    'ariaLabel' => 'Demo, expanded',
                    'brand'     => ['label' => 'Workshopr', 'sub' => 'App shell', 'icon' => 'graph_3', 'href' => '/app/'],
                ]) ?>
                <div class="ds-nav-stage__body">App content</div>
            </div>
        </div>

        <div class="ds-subsection">
            <h3 class="ds-subsection-title">Rail, 80px</h3>
            <p class="ds-section-desc">Label under the icon, 60px destinations, and a 56 by 32 indicator around the icon alone. Hover or focus a destination: a tooltip backs up any label the width has truncated.</p>
            <div class="ds-nav-stage">
                <?= ws_sidenav($ds_sidenav_items, [
                    'variant'   => 'rail',
                    'ariaLabel' => 'Demo, rail',
                    'brand'     => ['label' => 'Workshopr', 'icon' => 'graph_3', 'href' => '/app/'],
                ]) ?>
                <div class="ds-nav-stage__body">App content</div>
            </div>
        </div>
    </div>

    <div class="ds-code"><pre>&lt;?= ws_sidenav([
    ['label' => 'Home',       'icon' => 'home',              'href' => '/app/'],
    ['label' => 'Strategize', 'icon' => 'knight',            'href' => '/app/?view=strategize', 'active' => true],
    ['label' => 'Plan',       'icon' => 'calendar_view_day', 'href' => '/app/?view=plan'],
    ['type'  => 'divider'],
    ['label' => 'Library',      'icon' => 'auto_stories', 'href' => '/app/?view=library'],
    ['label' => 'Rescue Cards', 'icon' => 'stacks',       'href' => '/app/?view=cards', 'badge' => 37],
], ['variant' => 'rail']) ?&gt;</pre></div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With a brand, a collapse toggle, and a footer</h3>
        <p class="ds-section-desc">The three optional regions. <code class="ds-code-inline">footer</code> takes raw HTML and is printed unescaped, so never pass anything a user typed. <code class="ds-code-inline">collapsible</code> renders the toggle button but wires nothing: the shell owns which variant is showing, since that choice has to persist.</p>
        <div class="ds-nav-stage ds-nav-stage--wide">
            <?= ws_sidenav($ds_sidenav_items, [
                'ariaLabel'   => 'Demo, full anatomy',
                'brand'       => ['label' => 'Workshopr', 'sub' => 'App shell', 'icon' => 'graph_3', 'href' => '/app/'],
                'collapsible' => true,
                'footer'      => '<div class="ds-nav-footer-chip"><span class="material-symbols-outlined">account_circle</span> Signed in</div>',
            ]) ?>
            <div class="ds-nav-stage__body">App content</div>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_sidenav($navItems, [
    'id'          => 'appSidenav',
    'variant'     => 'rail',
    'ariaLabel'   => 'Sections',
    'collapsible' => true,
]) ?&gt;

&lt;script&gt;
// The component ships the button; the shell decides what it does and remembers it.
var nav = document.getElementById('appSidenav');
nav.querySelector('.ws-sidenav__toggle').addEventListener('click', function () {
    var next = nav.classList.contains('ws-sidenav--rail') ? 'expanded' : 'rail';
    nav.classList.toggle('ws-sidenav--rail', next === 'rail');
    nav.classList.toggle('ws-sidenav--expanded', next !== 'rail');
    localStorage.setItem('workshopr_app_rail', next);
});
&lt;/script&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <p class="ds-section-desc">Every state below is live. Hover and focus are real: tab into the rail to see the focus ring and the state layer together.</p>

    <div class="ds-nav-stage ds-nav-stage--auto ds-nav-stage--matrix">
        <?= ws_sidenav([
            ['type' => 'heading', 'label' => 'States'],
            ['label' => 'Rest',              'icon' => 'home',              'href' => '#'],
            ['label' => 'Hover me',          'icon' => 'calendar_view_day', 'href' => '#'],
            ['label' => 'Focus me with tab', 'icon' => 'hub',               'href' => '#'],
            ['label' => 'Active, current',   'icon' => 'knight',            'href' => '#', 'active' => true],
            ['label' => 'With a badge',      'icon' => 'stacks',            'href' => '#', 'badge' => 37],
            ['label' => 'Disabled link',     'icon' => 'auto_stories',      'href' => '#', 'disabled' => true],
            ['label' => 'Acts, no href',     'icon' => 'more_horiz'],
            ['type' => 'divider'],
            ['label' => 'Disclosure, closed', 'icon' => 'folder', 'expands' => true, 'id' => 'dsClosed', 'children' => [
                ['label' => 'Hidden child', 'icon' => 'article', 'href' => '#'],
            ]],
            ['label' => 'Disclosure, open', 'icon' => 'folder_open', 'expands' => true, 'open' => true, 'id' => 'dsOpen', 'children' => [
                ['label' => 'Child item',    'icon' => 'school',        'href' => '#'],
                ['label' => 'Child, active', 'icon' => 'emoji_objects', 'href' => '#', 'active' => true],
            ]],
        ], ['ariaLabel' => 'Demo, state matrix']) ?>
        <div class="ds-nav-stage__body">All states</div>
    </div>

    <table class="ds-table">
        <thead><tr><th>State</th><th>Trigger</th><th>Treatment</th></tr></thead>
        <tbody>
            <tr><td>Rest</td><td>default</td><td>Transparent container, <code>--color-ink-secondary</code> icon and label.</td></tr>
            <tr><td>Hover</td><td><code>:hover</code></td><td>A state layer: <code>currentColor</code> at 8% over the container, not a swatch swap.</td></tr>
            <tr><td>Focus</td><td><code>:focus-visible</code></td><td>State layer at 10%, plus the platform's sky-blue <code>--focus-ring</code>.</td></tr>
            <tr><td>Pressed</td><td><code>:active</code></td><td>State layer at 10%.</td></tr>
            <tr><td>Active</td><td><code>'active' =&gt; true</code></td><td><code>aria-current="page"</code>, the filled pill indicator, semibold label, and the icon switched to Material's filled style. Expanded fills the whole item; rail fills only the pill around the icon.</td></tr>
            <tr><td>Disabled</td><td><code>'disabled' =&gt; true</code></td><td>38% content opacity and <code>pointer-events: none</code>. A link also gets <code>aria-disabled="true"</code> and <code>tabindex="-1"</code>, since HTML has no <code>disabled</code> for anchors; a button gets the native attribute.</td></tr>
            <tr><td>Badge</td><td><code>'badge' =&gt; 37</code></td><td>Trailing count pill when expanded; anchored to the indicator's top-right corner in the rail. Escaped, so a string works as well as a number.</td></tr>
            <tr><td>Disclosure</td><td><code>'expands' =&gt; true</code></td><td>Always a <code>&lt;button&gt;</code>, even with an <code>href</code>. Caret rotates on <code>aria-expanded="true"</code>; the sublist uses the real <code>hidden</code> attribute. Give the item an <code>id</code> or <code>aria-controls</code> is omitted and the panel is unlinked.</td></tr>
            <tr><td>Acts rather than navigates</td><td>no <code>href</code>, no <code>expands</code></td><td>Renders a plain <code>&lt;button&gt;</code>. This is how the shell's More entry opens the app launcher.</td></tr>
            <tr><td>Tooltip</td><td>rail, hover or focus</td><td>Backs up a truncated label. Suppressed entirely when expanded, and <code>aria-hidden</code> in both, since it only repeats the label.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The consolidated app shell, <code class="ds-code-inline">app/index.php</code>. Items are built from the view registry so the active state is derived from <code class="ds-code-inline">?view=</code> rather than hand-set per page, which is what stops the rail and the page disagreeing.</p>
    <div class="ds-code"><pre>&lt;?php
$navItems = [];
foreach (['home', 'strategize', 'plan', 'facilitate', 'synthesize'] as $k) {
    $navItems[] = [
        'label'  => $views[$k]['label'],
        'icon'   => $views[$k]['icon'],
        'href'   => '/app/?view=' . $k,
        'active' => $view === $k,
    ];
}
$navItems[] = ['type' => 'divider'];
// More acts rather than navigates: no href and no `expands`, which is the
// combination that renders a plain push control.
$navItems[] = ['label' => 'More', 'icon' => 'more_horiz', 'id' => 'appMoreBtn'];
?&gt;

&lt;?= ws_sidenav($navItems, [
    'id'          => 'appSidenav',
    'variant'     => 'rail',
    'ariaLabel'   => 'Sections',
    'collapsible' => true,
]) ?&gt;</pre></div>
    <p class="ds-section-desc">Every M3 metric is exposed as a custom property on <code class="ds-code-inline">.ws-sidenav</code>, so a shell can retune width, item height, indicator size, inset, icon size or label scale without forking the component. Override them on the element, not in the component's own rules.</p>
    <div class="ds-code"><pre>#appSidenav {
    --ws-sidenav-width: 200px;
    --ws-sidenav-item-height: 48px;
    --ws-sidenav-label-size: var(--text-meta);
}</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <h3 class="ds-subsection-title"><code>ws_sidenav(array $items, array $options = [])</code></h3>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>$items</code></td><td>array</td><td><code>[]</code></td><td>Positional and required. Entries in render order; see the item table below.</td></tr>
            <tr><td><code>variant</code></td><td>string</td><td><code>'expanded'</code></td><td><code>expanded</code> | <code>rail</code>. Anything else is coerced to <code>expanded</code>.</td></tr>
            <tr><td><code>ariaLabel</code></td><td>string</td><td><code>'Primary'</code></td><td>Landmark name on the <code>&lt;nav&gt;</code>. Give every nav on a page a distinct one.</td></tr>
            <tr><td><code>brand</code></td><td>array</td><td><code>null</code></td><td><code>label</code>, <code>sub</code>, <code>icon</code>, <code>href</code>. With an <code>href</code> it renders as a link, without one as a <code>&lt;div&gt;</code>.</td></tr>
            <tr><td><code>collapsible</code></td><td>bool</td><td><code>false</code></td><td>Renders the expand/collapse button, with <code>aria-expanded</code> and the matching label pre-set for the current variant. Wiring the click is the caller's job.</td></tr>
            <tr><td><code>footer</code></td><td>string</td><td><code>''</code></td><td>Raw HTML pinned to the bottom. <strong>Printed unescaped</strong>, so never build it from user input.</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>null</code></td><td>ID on the <code>&lt;nav&gt;</code>. Pass one if any JS has to find the rail.</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Extra classes, appended after <code>.ws-sidenav</code> and the variant modifier.</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra HTML attributes on the <code>&lt;nav&gt;</code>. Every entry renders as <code>key="value"</code>.</td></tr>
        </tbody>
    </table>

    <h3 class="ds-subsection-title ds-nav-gap-top">Item shape</h3>
    <table class="ds-table">
        <thead><tr><th>Key</th><th>Type</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>type</code></td><td>string</td><td><code>divider</code> or <code>heading</code> instead of an item. A heading also needs <code>label</code>; it is <code>aria-hidden</code> and hidden outright in the rail.</td></tr>
            <tr><td><code>label</code></td><td>string</td><td>Required for an item. Always in the DOM, in both variants, because it is the accessible name.</td></tr>
            <tr><td><code>short</code></td><td>string</td><td>A shorter name for widths the full one cannot survive, such as a rail laid out as a mobile bottom bar. Both labels ship in the DOM: <code>.ws-sidenav__label--short</code> is hidden by default, and the layout that wants it shows it and hides <code>.ws-sidenav__label--long</code>. The item takes <code>label</code> as its <code>aria-label</code>, so the accessible name never shortens with the screen. Ignored when it matches <code>label</code>.</td></tr>
            <tr><td><code>icon</code></td><td>string</td><td>Name from <code>images/icons/</code>. Falls back to the Material Symbols ligature when no SVG exists, so a missing asset never renders an iconless row. The active row prefers a <code>{name}-fill.svg</code> and otherwise uses the font's FILL axis.</td></tr>
            <tr><td><code>href</code></td><td>string</td><td>Present renders an <code>&lt;a&gt;</code>; absent renders a <code>&lt;button&gt;</code>.</td></tr>
            <tr><td><code>active</code></td><td>bool</td><td>Sets <code>aria-current="page"</code>, the pill indicator, and the filled icon.</td></tr>
            <tr><td><code>disabled</code></td><td>bool</td><td>See States. Handled differently for links and buttons.</td></tr>
            <tr><td><code>badge</code></td><td>string|int</td><td>Count pill. Skipped when <code>null</code> or the empty string, so <code>0</code> does render.</td></tr>
            <tr><td><code>target</code></td><td>string</td><td>Links only. <code>_blank</code> also sets <code>rel="noopener"</code>.</td></tr>
            <tr><td><code>expands</code></td><td>bool</td><td>Disclosure row. Forces a <code>&lt;button&gt;</code> even when <code>href</code> is set.</td></tr>
            <tr><td><code>open</code></td><td>bool</td><td>Renders the disclosure expanded. Not listed in the design system JSON, but the template reads it.</td></tr>
            <tr><td><code>children</code></td><td>array</td><td>Sub-items, same shape. Rendered only alongside <code>expands</code>.</td></tr>
            <tr><td><code>id</code></td><td>string</td><td>Element ID. On a disclosure it also produces <code>aria-controls</code> and the panel's <code>id</code>, so pass one there.</td></tr>
            <tr><td><code>class</code> / <code>attrs</code></td><td>string / array</td><td>Per-item hooks on the anchor or button.</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Landmark</td><td>A real <code>&lt;nav&gt;</code> with <code>aria-label</code>. If a page carries more than one nav, every label must differ or the landmark list is undifferentiated.</td></tr>
            <tr><td>Structure</td><td>Items sit in a <code>&lt;ul&gt;</code> / <code>&lt;li&gt;</code>, so AT announces the count and users can jump by item. Dividers carry <code>role="separator"</code>.</td></tr>
            <tr><td>Current page</td><td><code>aria-current="page"</code>, not just a colour class. The indicator is a filled shape rather than a tint, and a <code>forced-colors</code> block maps it to <code>Highlight</code>.</td></tr>
            <tr><td>Keyboard</td><td>Plain tab order, which is what APG prescribes for site navigation. No roving tabindex, because arrow-key trapping in a nav surprises more people than it helps. The disclosure is a real button, so Enter and Space both toggle it.</td></tr>
            <tr><td>Labels in the rail</td><td>Visible, not icon-only. Where 80px truncates a name, the tooltip appears on hover <em>and</em> focus, so it is reachable from the keyboard. The tooltip is <code>aria-hidden</code> because it repeats the label.</td></tr>
            <tr><td>Disabled links</td><td><code>aria-disabled="true"</code> plus <code>tabindex="-1"</code> rather than a focusable dead control.</td></tr>
            <tr><td>Icons</td><td>Decorative in every case; the label carries the meaning, so the ligature fallback is <code>aria-hidden</code>.</td></tr>
            <tr><td>Motion</td><td>All transitions drop under <code>prefers-reduced-motion: reduce</code>.</td></tr>
            <tr><td>Disclosure without an id</td><td><strong>Your responsibility.</strong> Omit <code>id</code> on an <code>expands</code> item and both <code>aria-controls</code> and the panel's <code>id</code> are dropped, leaving the button and its sublist unconnected for AT.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <p class="ds-section-desc">The component defines its own <code class="ds-code-inline">--ws-sidenav-*</code> layer on <code class="ds-code-inline">.ws-sidenav</code> and resolves each one to a platform token. Retune the local layer per shell; never hardcode past it.</p>
    <table class="ds-table">
        <thead><tr><th>Local property</th><th>Resolves to</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--ws-sidenav-surface</code></td><td><code>--gray-50</code></td><td>Rail ground</td></tr>
            <tr><td><code>--ws-sidenav-indicator</code></td><td><code>--phase-learn-light</code></td><td>The active pill</td></tr>
            <tr><td><code>--ws-sidenav-on-indicator</code></td><td><code>--color-ink</code></td><td>Active label and icon. Ink rather than red: red on the pill measures 4.11:1 and fails AA.</td></tr>
            <tr><td><code>--ws-sidenav-on-surface</code></td><td><code>--color-ink-secondary</code></td><td>Resting label and icon</td></tr>
            <tr><td><code>--ws-sidenav-radius</code></td><td><code>--radius-full</code></td><td>The pill shape</td></tr>
            <tr><td><code>--ws-sidenav-inset</code></td><td><code>--space-5</code></td><td>Item inset from the container edge</td></tr>
            <tr><td><code>--ws-sidenav-item-gap</code></td><td><code>--space-1</code></td><td>Gap between destinations</td></tr>
            <tr><td><code>--ws-sidenav-icon-size</code></td><td><code>--icon-lg</code></td><td>Glyph box</td></tr>
            <tr><td><code>--ws-sidenav-label-size</code> / <code>--ws-sidenav-rail-label-size</code></td><td><code>--text-small</code> / <code>--text-meta</code></td><td>Label scale per variant</td></tr>
            <tr><td colspan="2"><code>--gray-200</code></td><td>Right border and dividers</td></tr>
            <tr><td colspan="2"><code>--focus-ring</code> / <code>--focus-ring-offset</code></td><td>Focus state</td></tr>
            <tr><td colspan="2"><code>--font-body</code> / <code>--font-medium</code> / <code>--font-semibold</code></td><td>Face, resting weight, active weight</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-sidenav</code></td><td>The <code>&lt;nav&gt;</code>, carrying the local custom-property layer</td></tr>
            <tr><td><code>.ws-sidenav--expanded</code> / <code>--rail</code></td><td>The two variants. Both are emitted, so a shell can swap them at runtime by toggling classes.</td></tr>
            <tr><td><code>.ws-sidenav__brand</code> / <code>__brand-text</code> / <code>__brand-label</code> / <code>__brand-sub</code></td><td>Optional mark at the top</td></tr>
            <tr><td><code>.ws-sidenav__list</code> / <code>__row</code></td><td>The <code>&lt;ul&gt;</code> and each <code>&lt;li&gt;</code></td></tr>
            <tr><td><code>.ws-sidenav__divider</code> / <code>__heading</code></td><td>The two non-item entry types</td></tr>
            <tr><td><code>.ws-sidenav__item</code></td><td>One destination, with <code>--active</code>, <code>--disabled</code> and <code>--child</code> modifiers. Its <code>::after</code> is the state layer.</td></tr>
            <tr><td><code>.ws-sidenav__indicator</code></td><td>Sizing box in the expanded variant; the 56 by 32 pill in the rail</td></tr>
            <tr><td><code>.ws-sidenav__icon</code> / <code>__icon--filled</code></td><td>Glyph, and the active row's FILL axis</td></tr>
            <tr><td><code>.ws-sidenav__label</code> / <code>__badge</code> / <code>__caret</code> / <code>__tip</code></td><td>Label, count pill, disclosure caret, rail tooltip</td></tr>
            <tr><td><code>.ws-sidenav__sublist</code></td><td>Disclosure panel, hidden with the native <code>hidden</code> attribute</td></tr>
            <tr><td><code>.ws-sidenav__toggle</code> / <code>__footer</code></td><td>Collapse control and the raw-HTML footer slot</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_sidenav()</code> helper function</td></tr>
            <tr><td><code>includes/components/sidenav.php</code></td><td>Template: item rendering, icon fallbacks, ARIA wiring</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-sidenav</code> rules), plus the reduced-motion and forced-colors blocks</td></tr>
            <tr><td><code>app/index.php</code></td><td>The shipping caller: item construction and the collapse toggle's wiring</td></tr>
            <tr><td><code>design-system/redesign/sidenav.php</code></td><td>The Material 3 provenance, role mapping and measured contrast</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
