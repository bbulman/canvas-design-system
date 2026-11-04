<?php
$ds_page  = 'components/demos/nav';
$ds_title = 'Navigation';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Navigation</h1>
    <p>The unified site header: brand, section nav, app switcher, and account menu &mdash; one component, <code class="ds-code-inline">ws_header()</code>.</p>
</div>

<div class="ds-note" style="margin-bottom: 32px;">
    <span class="material-symbols-outlined">warning</span>
    <span><strong>Rewritten July 2026.</strong> This page previously documented a <code>data-property</code> attribute and a <code>.property-switcher-*</code> / <code>.ps-*</code> class family. None of those exist in <code>includes/components/header.php</code> &mdash; the real API is <code>ws_header($section, $opts)</code> and the real prefix is <code>.wsh-</code>. The old per-app colour table also listed four retired pre-unification hexes. Everything below is checked against the current source.</span>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            Any page that needs the site header. Call <code>ws_header('planner')</code> with the section the page belongs to &mdash; that one argument drives the brand wordmark, the nav items, the active state, and the app switcher's current entry.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            You're inside a full-height app shell that supplies its own bar &mdash; those use <code>ws_app_bar()</code> beneath the header, not instead of it. Never hand-roll a header; the account and auth wiring lives here.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Sections</h3>
        <p class="ds-section-desc">The section key selects a preset: its nav items, wordmark, and accent. Seventeen are defined; passing an unknown key falls back to <code class="ds-code-inline">home</code> rather than erroring.</p>
        <table class="ds-table">
            <thead><tr><th>Key</th><th>Surface</th></tr></thead>
            <tbody>
                <tr><td><code>home</code></td><td>Main site &mdash; the fallback for any unrecognised key</td></tr>
                <tr><td><code>library</code></td><td>Exercises, workshops, icebreakers, collections, goals</td></tr>
                <tr><td><code>planner</code></td><td>Workshop Builder</td></tr>
                <tr><td><code>facilitator</code></td><td>Facilitator app</td></tr>
                <tr><td><code>synthesize</code></td><td>Post-session synthesis</td></tr>
                <tr><td><code>coach</code></td><td>AI Coach</td></tr>
                <tr><td><code>strategist</code></td><td>Workshop Strategist</td></tr>
                <tr><td><code>sidekick</code></td><td>Sidekick</td></tr>
                <tr><td><code>agenda-check</code></td><td>Agenda Check</td></tr>
                <tr><td><code>intervention</code></td><td>Intervention Cards</td></tr>
                <tr><td><code>myworkshopr</code></td><td>MyWorkshopr dashboard</td></tr>
                <tr><td><code>dna</code></td><td>Facilitator DNA</td></tr>
                <tr><td><code>academy</code></td><td>Academy / training</td></tr>
                <tr><td><code>tips</code></td><td>Tips</td></tr>
                <tr><td><code>podcasts</code></td><td>Podcasts</td></tr>
                <tr><td><code>toolkits</code></td><td>Toolkits, including the Hybrid Kit</td></tr>
                <tr><td><code>roi</code></td><td>ROI calculator</td></tr>
            </tbody>
        </table>
        <div class="ds-code"><pre>&lt;?= ws_header('planner') ?&gt;</pre></div>
        <div class="ds-note">
            <span class="material-symbols-outlined">info</span>
            <span>This list is the header's own section table. <a href="<?= $ds_base ?>/../PRODUCT.md">PRODUCT.md §5</a> remains the canonical app inventory &mdash; if the two disagree, PRODUCT.md wins and the header needs updating.</span>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Custom nav items</h3>
        <p class="ds-section-desc">Passing <code class="ds-code-inline">nav</code> in the options replaces the section's preset nav entirely &mdash; useful for a sub-app that shares a section but needs its own links.</p>
        <div class="ds-code"><pre>&lt;?= ws_header('library', ['nav' => [
    ['label' => 'Exercises',   'href' => '/library/exercises/'],
    ['label' => 'Icebreakers', 'href' => '/library/icebreakers/'],
]]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Resolution order</h3>
        <p class="ds-section-desc">The section is resolved from the first of these that's set, so most pages never pass it explicitly &mdash; they set a global once and the header picks it up.</p>
        <table class="ds-table">
            <thead><tr><th>Order</th><th>Source</th></tr></thead>
            <tbody>
                <tr><td>1</td><td>The <code>$section</code> argument</td></tr>
                <tr><td>2</td><td><code>$GLOBALS['header_section']</code></td></tr>
                <tr><td>3</td><td><code>$GLOBALS['header_property']</code> &mdash; the legacy name, still honoured</td></tr>
                <tr><td>4</td><td><code>'home'</code></td></tr>
            </tbody>
        </table>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Active nav item</td><td>Marked with <code>aria-current="page"</code>, so the current location is conveyed structurally rather than by styling alone.</td></tr>
            <tr><td>App switcher closed</td><td>The trigger is labelled "Switch app" with <code>aria-expanded="false"</code> and <code>aria-haspopup="dialog"</code>.</td></tr>
            <tr><td>App switcher open</td><td>The panel lists apps grouped by phase, each with a name and description.</td></tr>
            <tr><td>Signed out</td><td>A sign-in control replaces the account cluster.</td></tr>
            <tr><td>Signed in</td><td>Avatar initials and name, with a menu trigger labelled "Account menu" carrying <code>aria-haspopup="menu"</code>.</td></tr>
            <tr><td>Styles emitted once</td><td>The component tracks a static flag and emits its CSS on first call only, so multiple invocations on one page don't duplicate it.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The standard page opening. Most pages set the global in their config block and let the shared header include do the call.</p>
    <div class="ds-code"><pre>&lt;?php
require_once 'config.php';
require_once 'includes/shared-auth.php';

$header_section = 'library';        // resolved by ws_header()
require_once 'includes/header.php';
?&gt;

&lt;!-- …page content… --&gt;

&lt;?= ws_footer() ?&gt;</pre></div>
    <p class="ds-section-desc">Calling it directly is equivalent, and clearer in a standalone template:</p>
    <div class="ds-code"><pre>&lt;?= ws_header('library') ?&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>$section</code></td><td>?string</td><td><code>null</code></td><td>Positional. One of the 17 keys above. <code>null</code> falls through the resolution order.</td></tr>
            <tr><td><code>nav</code></td><td>array</td><td>the section's preset</td><td>Replaces the nav items. Each entry takes <code>label</code> and <code>href</code>.</td></tr>
        </tbody>
    </table>
    <p class="ds-section-desc">The signature is <code class="ds-code-inline">ws_header(?string $section = null, array $opts = [])</code>. It returns markup as a string, like the other <code class="ds-code-inline">ws_*</code> helpers.</p>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <p class="ds-section-desc">Among the better-wired components in the platform &mdash; every interactive cluster carries a name and a state.</p>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Landmark</td><td>The header is labelled "Site header", and the nav is labelled per section &mdash; so a page with several navs stays distinguishable.</td></tr>
            <tr><td>Current page</td><td><code>aria-current="page"</code> on the active nav item.</td></tr>
            <tr><td>App switcher</td><td>Trigger labelled "Switch app", with <code>aria-haspopup="dialog"</code> and <code>aria-expanded</code> reflecting the panel.</td></tr>
            <tr><td>Account menu</td><td>Labelled "Account menu" with <code>aria-haspopup="menu"</code>. The avatar control is labelled "Account".</td></tr>
            <tr><td>Icon controls</td><td>Search and MyWorkshopr shortcuts carry explicit <code>aria-label</code>s rather than relying on their glyphs.</td></tr>
            <tr><td>Keyboard</td><td>All triggers are real buttons and nav items real links, so tabbing and activation are native.</td></tr>
            <tr><td>Focus in panels</td><td><strong>Worth checking per surface:</strong> the switcher and account panels don't trap focus or return it to the trigger on close &mdash; the same gap as <a href="<?= $ds_base ?>/components/demos/modal.php">Modal</a>. For a dropdown this is less severe than for a dialog, but <kbd>Esc</kbd>-to-close with focus return would be an improvement.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <p class="ds-section-desc">The header emits its accent as an inline custom property computed from the section, with a literal fallback beside the <code class="ds-code-inline">var()</code> so it still paints if tokens haven't loaded.</p>
    <div class="ds-note">
        <span class="material-symbols-outlined">warning</span>
        <span><strong>Every section accent is now Learn Red.</strong> The old table on this page assigned <code>#F87171</code> to Tips, <code>#BE123C</code> to Podcasts, <code>#0284C7</code> to Planner, and <code>#7C4DFF</code> to Coach and Interventions. All were retired by Red Unification &mdash; <code>--phase-learn</code>, <code>--phase-plan</code>, <code>--phase-facilitate</code>, and <code>--phase-reflect</code> all resolve to <code>#E54D4D</code>. Sections still exist as semantic grouping; they no longer differ in colour. See <a href="<?= $ds_base ?>/foundations/colors.php">Colors</a>.</span>
    </div>
    <p class="ds-section-desc">Beyond the accent, the header draws on the shared surface, ink, radius, and type scales. Read the <code class="ds-code-inline">.wsh-header</code> rules in <code class="ds-code-inline">includes/components/header.php</code> &mdash; the styles are emitted by the component itself rather than living in <code class="ds-code-inline">components.css</code>.</p>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <p class="ds-section-desc">The prefix is <code class="ds-code-inline">.wsh-</code>. The <code class="ds-code-inline">.property-switcher-*</code> and <code class="ds-code-inline">.ps-*</code> classes this page used to list do not exist.</p>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.wsh-header</code></td><td>The <code>&lt;header&gt;</code> landmark</td></tr>
            <tr><td><code>.wsh-header__left</code> / <code>__right</code></td><td>The two clusters</td></tr>
            <tr><td><code>.wsh-header__brand</code> / <code>__brandwrap</code> / <code>__mark</code> / <code>__word</code> / <code>__tag</code></td><td>Logo, wordmark, and section tag</td></tr>
            <tr><td><code>.wsh-header__nav</code> / <code>__navitem</code></td><td>Section nav and its links</td></tr>
            <tr><td><code>.wsh-header__switcher</code> / <code>__panel</code></td><td>App switcher trigger and panel</td></tr>
            <tr><td><code>.wsh-panel__group</code> / <code>__app</code> / <code>__desc</code></td><td>Phase group, app entry, and its description inside the panel</td></tr>
            <tr><td><code>.wsh-header__account</code> / <code>__avatar</code> / <code>__avatar-initial</code></td><td>Account cluster</td></tr>
            <tr><td><code>.wsh-header__menu</code> / <code>__menu-head</code> / <code>__menu-name</code> / <code>__menu-email</code> / <code>__menu-item</code></td><td>Account dropdown</td></tr>
            <tr><td><code>.wsh-header__submenu</code> / <code>__submenu-item</code></td><td>Nested menu level</td></tr>
            <tr><td><code>.wsh-header__signin</code></td><td>Signed-out control</td></tr>
            <tr><td><code>.wsh-header__icon-btn</code></td><td>Search and shortcut buttons</td></tr>
            <tr><td><code>.wsh-header__caret</code> / <code>__dot</code></td><td>Disclosure caret and status dot</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/header.php</code></td><td><code>ws_header()</code> &mdash; the section table, markup, and inline styles. The source of truth for this page.</td></tr>
            <tr><td><code>includes/header.php</code></td><td>Shared page include that calls <code>ws_header()</code></td></tr>
            <tr><td><code>design-system/platform-tokens.css</code></td><td>Phase tokens the accent resolves against</td></tr>
            <tr><td><code>PRODUCT.md</code> §5</td><td>Canonical app inventory &mdash; the header's section list should match it</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
