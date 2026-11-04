<?php
$ds_page  = 'redesign/sidenav';
$ds_title = 'Side Navigation';

require_once __DIR__ . '/../../includes/icon.php';
require_once __DIR__ . '/../../includes/components/helpers.php';

require_once __DIR__ . '/../includes/ds-header.php';

/** The platform journey, in phase order — the canonical set. */
$ws_nav = [
    ['label' => 'Home',       'icon' => 'home',              'href' => '/'],
    ['label' => 'Strategize', 'icon' => 'knight',            'href' => '/strategist/app.php', 'active' => true],
    ['label' => 'Plan',       'icon' => 'calendar_view_day', 'href' => '/planner/'],
    ['label' => 'Facilitate', 'icon' => 'groups',            'href' => '/facilitator/'],
    ['label' => 'Synthesize', 'icon' => 'hub',               'href' => '/synthesize/'],
    ['type'  => 'divider'],
    ['label' => 'Library',      'icon' => 'auto_stories', 'href' => '/library/'],
    ['label' => 'Rescue Cards', 'icon' => 'stacks',       'href' => '/library/collections/', 'badge' => 37],
    ['label' => 'More', 'icon' => 'more_horiz', 'expands' => true, 'id' => 'dsMore', 'children' => [
        ['label' => 'Academy',  'icon' => 'school',        'href' => '/academy/'],
        ['label' => 'Tips',     'icon' => 'emoji_objects', 'href' => '/tips/'],
        ['label' => 'Changelog','icon' => 'article',       'href' => '/changelog/'],
    ]],
];
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<style>
/* Demo scaffolding only — the component itself supplies its own height. */
/* No token fallbacks here — the design-system shell always loads
   platform-tokens.css, so a fallback would only mask a missing token. */
.ds-nav-stage {
    display: flex;
    height: 620px;
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-lg);
    background: var(--bg-surface);
}
.ds-nav-stage--wide   { width: 460px; }
.ds-nav-stage--mid    { width: 320px; }
.ds-nav-stage--states { width: 300px; height: auto; }
.ds-nav-stage__body {
    flex: 1;
    padding: var(--space-6);
    color: var(--text-muted);
    font-size: var(--text-small);
}
.ds-nav-row { display: flex; gap: var(--space-8); flex-wrap: wrap; }
.ds-table--spaced { margin-top: var(--space-6); }
</style>

<div class="ds-page-header">
    <h1>Side Navigation</h1>
    <p>The vertical rail an app shell wears down its left edge &mdash; <code class="ds-code-inline">ws_sidenav()</code>. Built for the chromeless window, where there is no browser chrome and no horizontal platform nav, so this is the only way between apps.</p>
</div>

<div class="ds-note">
    <span class="material-symbols-outlined">info</span>
    <span><strong>This is the Material 3 navigation rail.</strong> M3 supplies the geometry and the interaction model &mdash; the pill-shaped active indicator, 24dp icons, a 56&times;32 indicator in the rail and a 56dp-tall pill when expanded, and state layers at 8%&thinsp;/&thinsp;10% instead of flat hover swatches. Workshopr supplies every colour: <code>secondaryContainer</code> &rarr; <code>--phase-learn-light</code>, <code>onSecondaryContainer</code> &rarr; <code>--color-ink</code>, <code>onSurfaceVariant</code> &rarr; <code>--color-ink-secondary</code>. Red Unification and <code>platform-tokens.css</code> outrank an imported palette, so none of Material's own colour roles ship. (Ink rather than red on the indicator is also the more faithful M3 reading &mdash; Material's light theme puts a near-black tone on the tonal pill &mdash; and red measured 4.11:1 there, under the AA floor.)</span>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            A full-height app shell needs persistent navigation between apps &mdash; the chromeless window, a kiosk or popup mode, or any surface where <code>ws_header()</code>'s horizontal nav has been suppressed. It pairs with <a href="<?= $ds_base ?>/components/demos/app-bar.php">App Bar</a>: the rail moves you between apps, the bar acts on the open document.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The page is an ordinary web page &mdash; that already has <code>ws_header()</code>, and two navs competing for the same job is worse than either alone. Don't use it for in-page section links (use <a href="<?= $ds_base ?>/components/demos/tabs.php">Tabs</a>) or for a trail back up a hierarchy (use <a href="<?= $ds_base ?>/components/demos/breadcrumb.php">Breadcrumb</a>).
        </div>
    </div>
</section>

<!-- 3. Anatomy -->
<section class="ds-section">
    <h2 class="ds-section-title">Anatomy</h2>
    <p class="ds-section-desc">Four regions, top to bottom. Only the list is required.</p>
    <table class="ds-table">
        <thead><tr><th>Part</th><th>Class</th><th>Role</th></tr></thead>
        <tbody>
            <tr><td>Brand</td><td><code>.ws-sidenav__brand</code></td><td>Optional mark and app name at the top; becomes a link when given an <code>href</code></td></tr>
            <tr><td>List</td><td><code>.ws-sidenav__list</code></td><td>The items, in journey order, with dividers and headings between groups</td></tr>
            <tr><td>Item</td><td><code>.ws-sidenav__item</code></td><td>Icon + label + optional badge. An <code>&lt;a&gt;</code> when it navigates, a <code>&lt;button&gt;</code> when it discloses</td></tr>
            <tr><td>Toggle</td><td><code>.ws-sidenav__toggle</code></td><td>Optional expand/collapse control, pinned to the bottom</td></tr>
            <tr><td>Footer</td><td><code>.ws-sidenav__footer</code></td><td>Raw HTML slot for an account chip or version string</td></tr>
        </tbody>
    </table>
</section>

<!-- 4. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>
    <p class="ds-section-desc">Two, matching M3's collapsed and expanded rail. Labels show in both &mdash; M3 keeps them, and so do we. What changes is where the label sits and what the active indicator wraps.</p>

    <div class="ds-nav-row">
        <div class="ds-subsection">
            <h3 class="ds-subsection-title">Expanded &mdash; 240px (default)</h3>
            <p class="ds-section-desc">Icon beside label. The 56px pill <em>is</em> the item container, inset 20px per M3's expanded indicator.</p>
            <div class="ds-nav-stage ds-nav-stage--wide">
                <?= ws_sidenav($ws_nav, [
                    'brand' => ['label' => 'Workshopr', 'sub' => 'Strategist', 'icon' => 'graph_3', 'href' => '/'],
                    'ariaLabel' => 'Primary (expanded demo)',
                ]) ?>
                <div class="ds-nav-stage__body">App content</div>
            </div>
        </div>

        <div class="ds-subsection">
            <h3 class="ds-subsection-title">Rail &mdash; 80px</h3>
            <p class="ds-section-desc">M3's collapsed rail: label under the icon, 60px destinations, and a 56&times;32 indicator around the icon alone.</p>
            <div class="ds-nav-stage ds-nav-stage--mid">
                <?= ws_sidenav($ws_nav, [
                    'variant' => 'rail',
                    'brand' => ['label' => 'Workshopr', 'icon' => 'graph_3', 'href' => '/'],
                    'ariaLabel' => 'Primary (rail demo)',
                ]) ?>
                <div class="ds-nav-stage__body">Hover or focus a destination &mdash; a tooltip backs up any label the 80px width has truncated.</div>
            </div>
        </div>
    </div>

    <div class="ds-code"><pre>&lt;?= ws_sidenav([
    ['label' =&gt; 'Home',       'icon' =&gt; 'home',              'href' =&gt; '/'],
    ['label' =&gt; 'Strategize', 'icon' =&gt; 'knight',            'href' =&gt; '/strategist/app.php', 'active' =&gt; true],
    ['label' =&gt; 'Plan',       'icon' =&gt; 'calendar_view_day', 'href' =&gt; '/planner/'],
    ['label' =&gt; 'Facilitate', 'icon' =&gt; 'groups',            'href' =&gt; '/facilitator/'],
    ['label' =&gt; 'Synthesize', 'icon' =&gt; 'hub',               'href' =&gt; '/synthesize/'],
    ['type'  =&gt; 'divider'],
    ['label' =&gt; 'Library',      'icon' =&gt; 'auto_stories', 'href' =&gt; '/library/'],
    ['label' =&gt; 'Rescue Cards', 'icon' =&gt; 'stacks',       'href' =&gt; '/library/collections/', 'badge' =&gt; 37],
    ['label' =&gt; 'More', 'icon' =&gt; 'more_horiz', 'expands' =&gt; true, 'id' =&gt; 'navMore', 'children' =&gt; [...]],
], ['variant' =&gt; 'rail']) ?&gt;</pre></div>
</section>

<!-- 5. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <p class="ds-section-desc">Every state below is rendered live. Hover and focus are interactive &mdash; tab through the rail to see the focus ring and the tooltip appear together.</p>

    <div class="ds-nav-stage ds-nav-stage--states">
        <?= ws_sidenav([
            ['type' => 'heading', 'label' => 'States'],
            ['label' => 'Rest',            'icon' => 'home',        'href' => '#'],
            ['label' => 'Hover me',        'icon' => 'calendar_view_day', 'href' => '#'],
            ['label' => 'Focus me (tab)',  'icon' => 'hub',         'href' => '#'],
            ['label' => 'Active / current','icon' => 'knight',      'href' => '#', 'active' => true],
            ['label' => 'With badge',      'icon' => 'stacks',      'href' => '#', 'badge' => 37],
            ['label' => 'Disabled',        'icon' => 'auto_stories','href' => '#', 'disabled' => true],
            ['label' => 'Disclosure (closed)', 'icon' => 'more_horiz', 'expands' => true, 'id' => 'dsClosed', 'children' => [
                ['label' => 'Hidden child', 'icon' => 'article', 'href' => '#'],
            ]],
            ['label' => 'Disclosure (open)', 'icon' => 'more_horiz', 'expands' => true, 'open' => true, 'id' => 'dsOpen', 'children' => [
                ['label' => 'Child item',   'icon' => 'school',        'href' => '#'],
                ['label' => 'Child, active','icon' => 'emoji_objects', 'href' => '#', 'active' => true],
            ]],
        ], ['ariaLabel' => 'State matrix demo']) ?>
        <div class="ds-nav-stage__body">&larr; all states</div>
    </div>

    <table class="ds-table ds-table--spaced">
        <thead><tr><th>State</th><th>Trigger</th><th>Treatment</th></tr></thead>
        <tbody>
            <tr><td>Rest</td><td>&mdash;</td><td>Transparent container, <code>--color-ink-secondary</code> icon and label (M3 <code>onSurfaceVariant</code>)</td></tr>
            <tr><td>Hover</td><td><code>:hover</code></td><td>M3 state layer &mdash; <code>currentColor</code> at <strong>8%</strong> over the container, not a swatch swap</td></tr>
            <tr><td>Focus</td><td><code>:focus-visible</code></td><td>State layer at <strong>10%</strong>, plus the sky-blue <code>--focus-ring</code>. M3 has no visible focus ring of its own, so the platform's is kept &mdash; a keyboard user needs it</td></tr>
            <tr><td>Pressed</td><td><code>:active</code></td><td>State layer at <strong>10%</strong></td></tr>
            <tr><td>Active</td><td><code>active =&gt; true</code></td><td><code>aria-current="page"</code> and the M3 pill indicator. Expanded: the 56px item container fills. Rail: only the 56&times;32 pill around the icon fills. The indicator is a filled <em>shape</em>, so "current" is not signalled by hue alone</td></tr>
            <tr><td>Disabled</td><td><code>disabled =&gt; true</code></td><td>M3's 38% content opacity, <code>pointer-events: none</code>. Links get <code>aria-disabled</code> + <code>tabindex="-1"</code>; buttons get the native attribute</td></tr>
            <tr><td>Badge</td><td><code>badge =&gt; 37</code></td><td>Trailing count pill when expanded; anchored to the indicator's top-right corner in the rail</td></tr>
            <tr><td>Disclosure</td><td><code>expands =&gt; true</code></td><td>Caret rotates 180&deg; on <code>aria-expanded="true"</code>; the sublist uses the real <code>hidden</code> attribute, not opacity</td></tr>
            <tr><td>Tooltip</td><td>rail + hover/focus</td><td>Not an M3 feature. Kept because our destination names are longer than the short words an M3 rail assumes, so a truncated label must stay recoverable. Suppressed entirely when expanded</td></tr>
        </tbody>
    </table>
</section>

<!-- 6. API -->
<section class="ds-section">
    <h2 class="ds-section-title">API</h2>
    <h3 class="ds-subsection-title">ws_sidenav(array $items, array $options = [])</h3>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Notes</th></tr></thead>
        <tbody>
            <tr><td><code>variant</code></td><td>string</td><td><code>expanded</code></td><td><code>expanded</code> | <code>rail</code>. Anything else falls back to expanded</td></tr>
            <tr><td><code>ariaLabel</code></td><td>string</td><td><code>Primary</code></td><td>Landmark name. Give each nav on a page a distinct one</td></tr>
            <tr><td><code>brand</code></td><td>array</td><td>&mdash;</td><td><code>label</code>, <code>sub</code>, <code>icon</code>, <code>href</code></td></tr>
            <tr><td><code>collapsible</code></td><td>bool</td><td><code>false</code></td><td>Renders the expand/collapse toggle. Wiring the click is the app's job</td></tr>
            <tr><td><code>footer</code></td><td>string</td><td><code>''</code></td><td>Raw HTML pinned to the bottom</td></tr>
            <tr><td><code>id</code> / <code>class</code> / <code>attrs</code></td><td>string / string / array</td><td>&mdash;</td><td>Element hooks</td></tr>
        </tbody>
    </table>

    <h3 class="ds-subsection-title ds-table--spaced">Item shape</h3>
    <table class="ds-table">
        <thead><tr><th>Key</th><th>Type</th><th>Notes</th></tr></thead>
        <tbody>
            <tr><td><code>label</code></td><td>string</td><td>Required. Always in the DOM &mdash; it is the accessible name in both variants</td></tr>
            <tr><td><code>icon</code></td><td>string</td><td>Name from <code>images/icons/</code>; falls back to the Material Symbols ligature if no SVG exists</td></tr>
            <tr><td><code>href</code></td><td>string</td><td>Present &rarr; <code>&lt;a&gt;</code>. Absent &rarr; <code>&lt;button&gt;</code></td></tr>
            <tr><td><code>active</code></td><td>bool</td><td>Sets <code>aria-current="page"</code> and the left marker</td></tr>
            <tr><td><code>disabled</code></td><td>bool</td><td>See States</td></tr>
            <tr><td><code>badge</code></td><td>string|int</td><td>Count pill</td></tr>
            <tr><td><code>expands</code> / <code>open</code> / <code>children</code></td><td>bool / bool / array</td><td>Disclosure row. Forces a <code>&lt;button&gt;</code> even with an <code>href</code></td></tr>
            <tr><td><code>target</code>, <code>id</code>, <code>class</code>, <code>attrs</code></td><td>&mdash;</td><td><code>target="_blank"</code> also sets <code>rel="noopener"</code></td></tr>
            <tr><td><code>type</code></td><td>string</td><td><code>divider</code> or <code>heading</code> instead of an item</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <ul class="ds-list">
        <li><strong>Landmark.</strong> Renders a <code>&lt;nav&gt;</code> with <code>aria-label</code>. If a page carries more than one nav, every label must differ or screen-reader users get an undifferentiated list.</li>
        <li><strong>List semantics.</strong> Items sit in a <code>&lt;ul&gt;</code>/<code>&lt;li&gt;</code>, so AT announces "list, 8 items" and users can jump by item.</li>
        <li><strong>Current page.</strong> <code>aria-current="page"</code>, not just a colour class. M3's indicator is a filled pill rather than a tint, so the state reads as a shape and survives greyscale; a <code>forced-colors</code> block maps it to <code>Highlight</code>.</li>
        <li><strong>Keyboard.</strong> Plain Tab order &mdash; these are links in a landmark, which is what APG prescribes for site navigation. No roving tabindex, because arrow-key trapping in a nav surprises more users than it helps. The disclosure is a real button: Enter and Space both toggle it.</li>
        <li><strong>The rail's labels.</strong> Visible, as M3 prescribes &mdash; an icon-only rail forces everyone to learn a glyph vocabulary. Where 80px truncates a longer name the tooltip backs it up on hover <em>and</em> focus, so it is reachable from the keyboard. The tooltip is <code>aria-hidden</code>: it repeats the label, and exposing it would double-read.</li>
        <li><strong>Disabled links.</strong> HTML has no <code>disabled</code> for anchors, so the component sets <code>aria-disabled="true"</code> and <code>tabindex="-1"</code> rather than leaving a focusable dead control.</li>
        <li><strong>Icons.</strong> Decorative in every case &mdash; the label carries the meaning, so SVGs render inline and the ligature fallback is <code>aria-hidden</code>.</li>
        <li><strong>Motion.</strong> All transitions drop under <code>prefers-reduced-motion: reduce</code>.</li>
        <li><strong>Contrast, measured not assumed.</strong> Rest label <code>#57534E</code> on <code>#FAFAF9</code> is 7.3:1; active label <code>#2C2416</code> on the <code>#FEE2E2</code> indicator is 12.5:1; badge <code>#FFFFFF</code> on <code>#C73E3E</code> is 5.0:1. All clear AA. Two earlier pairings did not and were changed: red <code>#C73E3E</code> on the indicator measured 4.11:1, and a <code>--phase-learn</code> badge measured 3.82:1.</li>
        <li><strong>The indicator is a tint, so it is never the only cue.</strong> At 1.17:1 against the surface, M3's tonal pill is deliberately quiet &mdash; it is backed by a weight change to semibold and by <code>aria-current="page"</code>, and it maps to <code>Highlight</code> under forced colours.</li>
    </ul>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens consumed</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--gray-50</code> / <code>--gray-100</code> / <code>--gray-200</code></td><td>Rail ground, hover ground, borders and dividers</td></tr>
            <tr><td><code>--color-ink</code> / <code>--color-ink-secondary</code> / <code>--text-faint</code></td><td>Label at hover, rest and disabled</td></tr>
            <tr><td><code>--phase-learn</code> / <code>--phase-learn-dark</code></td><td>Active marker, badge, brand mark, active label</td></tr>
            <tr><td><code>--phase-learn-very-light</code> / <code>--phase-learn-light</code></td><td>Active ground and its hover</td></tr>
            <tr><td><code>--space-1</code> &hellip; <code>--space-4</code></td><td>Padding, gaps and dividers</td></tr>
            <tr><td><code>--radius-sm</code> / <code>--radius-md</code> / <code>--radius-full</code></td><td>Rows, marker, badge</td></tr>
            <tr><td><code>--text-nano</code> / <code>--text-meta</code> / <code>--text-small</code> / <code>--text-body</code></td><td>Headings, children, labels, brand</td></tr>
            <tr><td><code>--font-body</code> / <code>--font-heading</code> / <code>--font-medium</code> / <code>--font-semibold</code> / <code>--font-bold</code></td><td>Type</td></tr>
            <tr><td><code>--focus-ring</code> / <code>--focus-ring-offset</code></td><td>Focus state</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
