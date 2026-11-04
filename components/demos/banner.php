<?php
$ds_page  = 'components/demos/banner';
$ds_title = 'Banner';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Banner</h1>
    <p>A full-width strip at the top of a page carrying one announcement that applies to the whole page.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            The message is about the site or the session rather than about anything on the page &mdash; a maintenance window, a feature launch, a time-limited offer. One banner per page, at the very top.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The message concerns a specific region or action &mdash; use <a href="<?= $ds_base ?>/components/demos/alert.php">Alert</a> inline. For a page's own headline use <a href="<?= $ds_base ?>/components/demos/hero.php">Hero</a>, and for a transient confirmation use <a href="<?= $ds_base ?>/components/demos/toast.php">Toast</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Core</h3>
        <p class="ds-section-desc">Five documented variants. The icon is never automatic &mdash; pass one that matches the message.</p>
        <div class="ds-card" style="display: flex; flex-direction: column; gap: 12px;">
            <?= ws_banner('This is a default announcement banner.') ?>
            <?= ws_banner('New feature: Custom Exercise Builder is now live.', ['variant' => 'brand', 'icon' => 'auto_awesome']) ?>
            <?= ws_banner('Your workshop has been saved successfully.', ['variant' => 'success', 'icon' => 'check_circle']) ?>
            <?= ws_banner('Scheduled maintenance this Saturday 2&ndash;4 AM UTC.', ['variant' => 'warning', 'icon' => 'schedule']) ?>
            <?= ws_banner('Limited time: 30% off annual plans.', ['variant' => 'dark', 'icon' => 'local_offer']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_banner('Default announcement.') ?&gt;
&lt;?= ws_banner('Brand message', ['variant' => 'brand', 'icon' => 'auto_awesome']) ?&gt;
&lt;?= ws_banner('Success message', ['variant' => 'success', 'icon' => 'check_circle']) ?&gt;
&lt;?= ws_banner('Warning message', ['variant' => 'warning', 'icon' => 'schedule']) ?&gt;
&lt;?= ws_banner('Dark banner', ['variant' => 'dark', 'icon' => 'local_offer']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Phase</h3>
        <p class="ds-section-desc">Five more variants for phase-scoped surfaces. The site banner admin sets them through a banner's phase. Since the Red Unification <code class="ds-code-inline">learn</code>, <code class="ds-code-inline">plan</code>, <code class="ds-code-inline">facilitate</code> and <code class="ds-code-inline">reflect</code> all draw one red gradient from <code class="ds-code-inline">--brand</code>, whose light stop gives white text only 3.82:1; <code class="ds-code-inline">brand</code> starts darker (4.8:1), so new code picks <code class="ds-code-inline">brand</code>. <code class="ds-code-inline">dna</code> keeps its own gradient and shimmer for Facilitator DNA.</p>
        <div class="ds-card" style="display: flex; flex-direction: column; gap: 12px;">
            <?= ws_banner('Learn-phase banner.', ['variant' => 'learn', 'icon' => 'school']) ?>
            <?= ws_banner('Plan-phase banner.', ['variant' => 'plan', 'icon' => 'edit_note']) ?>
            <?= ws_banner('Facilitate-phase banner.', ['variant' => 'facilitate', 'icon' => 'groups']) ?>
            <?= ws_banner('Reflect-phase banner.', ['variant' => 'reflect', 'icon' => 'insights']) ?>
            <?= ws_banner('Facilitator DNA banner.', ['variant' => 'dna', 'icon' => 'fingerprint']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_banner('Plan-phase banner.', ['variant' => 'plan', 'icon' => 'edit_note']) ?&gt;</pre></div>
        <div class="ds-note">
            <span class="material-symbols-outlined">info</span>
            <span>Because the variant is interpolated rather than validated, a typo produces <code>.ws-banner--typo</code>, which matches nothing &mdash; the banner renders unstyled rather than erroring. Check the class list below for valid values.</span>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Alignment</h3>
        <p class="ds-section-desc">Centred by default. Set <code class="ds-code-inline">centered</code> to <code class="ds-code-inline">false</code> when the banner sits above left-aligned page content and the centring looks detached.</p>
        <div class="ds-card">
            <?= ws_banner('Left-aligned banner for contextual pages.', [
                'icon' => 'info',
                'centered' => false,
                'action' => 'Learn more',
                'href' => '#',
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_banner('Left-aligned banner.', [
    'centered' => false,
    'action'   => 'Learn more',
    'href'     => '/docs/',
]) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With an action</h3>
        <p class="ds-section-desc">One action per banner, rendered as a link with a trailing arrow. Give it a verb.</p>
        <div class="ds-card" style="display: flex; flex-direction: column; gap: 12px;">
            <?= ws_banner('New: Run Mode lets you present your workshop like a pro.', [
                'variant' => 'brand',
                'icon' => 'slideshow',
                'action' => 'Try it now',
                'href' => '#',
            ]) ?>
            <?= ws_banner('Workshop planning just got easier with drag-and-drop.', [
                'variant' => 'dark',
                'icon' => 'drag_indicator',
                'action' => 'Open Planner',
                'href' => '#',
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_banner('New feature announcement.', [
    'variant' => 'brand',
    'icon'    => 'slideshow',
    'action'  => 'Try it now',
    'href'    => '/planner/',
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Dismissible</h3>
        <p class="ds-section-desc">Adds a close button. The dismissal is visual only and lasts until the next page load &mdash; persist it yourself if it should stick.</p>
        <div class="ds-card" style="display: flex; flex-direction: column; gap: 12px;">
            <?= ws_banner('Maintenance window: Saturday 2&ndash;4 AM UTC.', [
                'variant' => 'warning',
                'icon' => 'construction',
                'dismissible' => true,
            ]) ?>
            <?= ws_banner('Welcome back. Your 3 saved workshops are ready.', [
                'variant' => 'success',
                'icon' => 'waving_hand',
                'action' => 'View workshops',
                'href' => '#',
                'dismissible' => true,
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_banner('Dismissible banner.', [
    'variant'     => 'warning',
    'icon'        => 'construction',
    'dismissible' => true,
]) ?&gt;</pre></div>
    </div>

    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>Full-bleed background; contents constrained by <code>.ws-banner__inner</code>.</td></tr>
            <tr><td>Hover (action)</td><td>The action link shifts colour over <code>--transition-fast</code>; the arrow nudges right.</td></tr>
            <tr><td>Dismissed</td><td>The close button sets <code>display: none</code> on the banner via an inline <code>onclick</code>. The element stays in the DOM and no event fires &mdash; to remember the dismissal, write your own handler and a cookie or <code>localStorage</code> flag.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The standard site-wide pattern: rendered above the header, gated on a flag, dismissible, with the action pointing at the thing being announced.</p>
    <div class="ds-card">
        <?= ws_banner('Synthesize turns your session notes into a shareable readout.', [
            'variant'     => 'brand',
            'icon'        => 'hub',
            'action'      => 'Open Synthesize',
            'href'        => '#',
            'dismissible' => true,
        ]) ?>
    </div>
    <div class="ds-code"><pre>&lt;?php if (!isset($_COOKIE['dismissed_synthesize_banner'])): ?&gt;
    &lt;?= ws_banner('Synthesize turns your session notes into a shareable readout.', [
        'variant'     => 'brand',
        'icon'        => 'hub',
        'action'      => 'Open Synthesize',
        'href'        => '/synthesize/',
        'dismissible' => true,
    ]) ?&gt;
&lt;?php endif; ?&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>$message</code></td><td>string</td><td>&mdash;</td><td>Positional banner text. <strong>Rendered as raw HTML</strong> so it can carry inline markup &mdash; see the security note.</td></tr>
            <tr><td><code>variant</code></td><td>string</td><td><code>'default'</code></td><td><code>default</code> | <code>brand</code> | <code>success</code> | <code>warning</code> | <code>dark</code> | <code>learn</code> | <code>plan</code> | <code>facilitate</code> | <code>reflect</code> | <code>dna</code>. The four phase names share one lighter red gradient; prefer <code>brand</code>.</td></tr>
            <tr><td><code>icon</code></td><td>string</td><td><code>''</code></td><td>Material icon name. No default &mdash; omit for no icon.</td></tr>
            <tr><td><code>action</code></td><td>string</td><td><code>''</code></td><td>Action link text. Omit for no action.</td></tr>
            <tr><td><code>href</code></td><td>string</td><td><code>'#'</code></td><td>Action URL. Note the default is <code>'#'</code>, not empty &mdash; set it whenever you set <code>action</code>.</td></tr>
            <tr><td><code>onclick</code></td><td>string</td><td><code>''</code></td><td>Inline JS handler on the action</td></tr>
            <tr><td><code>dismissible</code></td><td>bool</td><td><code>false</code></td><td>Show the close button</td></tr>
            <tr><td><code>centered</code></td><td>bool</td><td><code>true</code></td><td>Centre the inner content. On by default.</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>''</code></td><td>Element ID</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">warning</span>
        <span><strong>Security:</strong> <code>$message</code> is echoed unescaped. Banners are usually authored copy, so that's normally fine &mdash; but escape with <code>htmlspecialchars()</code> at the call site the moment any part of the message comes from user data.</span>
    </div>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>ARIA</td><td>No role is applied. As page-load content that's correct &mdash; the banner is read in document order. If you inject one after load and it's urgent, add <code>role="status"</code> yourself.</td></tr>
            <tr><td>Keyboard</td><td>The action link and close button are native focusable controls, reached with <kbd>Tab</kbd> in that order. The banner body isn't focusable.</td></tr>
            <tr><td>Focus</td><td>Dismissing hides the banner while focus is on its close button, leaving focus on a hidden element. Move focus to the page heading afterwards if the banner is dismissible in a keyboard flow.</td></tr>
            <tr><td>Labelling</td><td>The close button is labelled <code>aria-label="Dismiss banner"</code>. The action link is labelled by its own text, so make that text meaningful on its own &mdash; "Open Planner", not "Click here".</td></tr>
            <tr><td>Reading order</td><td>A banner above the header is the first thing announced on every page. Keep it short, and remove it once the announcement is stale.</td></tr>
            <tr><td>Contrast</td><td>Each variant pairs tested token foreground and background, including <code>--text-inverse</code> on the dark and brand fills. Don't override one side alone.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--gray-100</code></td><td>Default variant background</td></tr>
            <tr><td><code>--mainsite-gradient</code> / <code>--brand</code> / <code>--brand-soft</code></td><td>Brand variant fill and accents</td></tr>
            <tr><td><code>--color-success-surface</code> / <code>--color-success-ink</code> / <code>--color-success-darker</code></td><td>Success variant</td></tr>
            <tr><td><code>--color-warning-ink</code></td><td>Warning variant foreground</td></tr>
            <tr><td><code>--color-ink</code></td><td>Dark variant background</td></tr>
            <tr><td><code>--brand</code> / <code>--phase-facilitate</code> / <code>--phase-reflect</code>, with <code>--brand-ink</code></td><td>Colour-key variant fills (learn and plan read <code>--brand</code>) and borders</td></tr>
            <tr><td><code>--text-inverse</code> / <code>--text-dark</code> / <code>--text-muted</code></td><td>Foreground across variants</td></tr>
            <tr><td><code>--text-ui</code> / <code>--text-small</code> / <code>--text-meta</code></td><td>Message and action type scale</td></tr>
            <tr><td><code>--radius-sm</code></td><td>Action link corners</td></tr>
            <tr><td><code>--font-body</code></td><td>Body face</td></tr>
            <tr><td><code>--transition-fast</code></td><td>Action hover</td></tr>
            <tr><td><code>--icon-lg</code></td><td>Icons, at least 24px on every page (DESIGN.md §8)</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-banner</code></td><td>Full-bleed wrapper</td></tr>
            <tr><td><code>.ws-banner--default</code></td><td>Light neutral background</td></tr>
            <tr><td><code>.ws-banner--brand</code></td><td>Brand gradient</td></tr>
            <tr><td><code>.ws-banner--success</code></td><td>Green tint</td></tr>
            <tr><td><code>.ws-banner--warning</code></td><td>Amber tint</td></tr>
            <tr><td><code>.ws-banner--dark</code></td><td>Dark fill</td></tr>
            <tr><td><code>.ws-banner--learn / --plan / --facilitate / --reflect / --dna</code></td><td>Phase-scoped fills</td></tr>
            <tr><td><code>.ws-banner--centered</code></td><td>Centre-aligned inner content (applied by default)</td></tr>
            <tr><td><code>.ws-banner__inner</code></td><td>Max-width flex container</td></tr>
            <tr><td><code>.ws-banner__icon</code></td><td>Leading icon</td></tr>
            <tr><td><code>.ws-banner__message</code></td><td>Text content</td></tr>
            <tr><td><code>.ws-banner__action</code></td><td>Action link</td></tr>
            <tr><td><code>.ws-banner__arrow</code></td><td>Trailing arrow on the action</td></tr>
            <tr><td><code>.ws-banner__close</code></td><td>Dismiss button</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_banner()</code> helper function</td></tr>
            <tr><td><code>includes/components/banner.php</code></td><td>Template &mdash; variant class assembly and markup</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-banner</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
