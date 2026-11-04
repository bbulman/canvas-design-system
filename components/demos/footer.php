<?php
$ds_page  = 'components/demos/footer';
$ds_title = 'Footer';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Footer</h1>
    <p>The one site footer: the Level Up grid, the newsletter CTA, and the dark brand bar, composed into a single self-contained block.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            Ending any content or marketing page. Pages using the legacy <code>includes/footer.php</code> get it automatically; redesigned pages call <code>ws_footer()</code> directly. A render-once guard means either route &mdash; or both &mdash; produces exactly one footer.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            You're inside a sub-application. Those pages close on the <a href="<?= $ds_base ?>/components/demos/app-footer.php">App Footer</a> rail instead, and they get there on their own &mdash; the composite delegates whenever <code>ws_is_app_page()</code> matches (DESIGN.md §12.7). Never build a page-local footer, and never call <a href="<?= $ds_base ?>/components/demos/level-up-grid.php">Level Up Grid</a> on a page that already ends in this composite &mdash; you'd get the grid twice.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>
    <p class="ds-section-desc">One footer, identical everywhere, is the point &mdash; so the options array trims regions rather than restyling them. <code class="ds-code-inline">hide_level_up</code> drops the grid, <code class="ds-code-inline">hide_phases</code> hides named phases within it, and pages on the legacy <code class="ds-code-inline">includes/footer.php</code> pass the same array through <code class="ds-code-inline">$ws_footer_options</code>. Reach for these only where a page already says the same thing in its own body. The three regions it composes are:</p>
    <table class="ds-table">
        <thead><tr><th>Region</th><th>Contents</th></tr></thead>
        <tbody>
            <tr><td>Level Up grid</td><td>The full app catalogue grouped by phase, via <a href="<?= $ds_base ?>/components/demos/level-up-grid.php">Level Up Grid</a></td></tr>
            <tr><td>Letter CTA</td><td>Newsletter signup &mdash; title, subtitle, email field, and submit</td></tr>
            <tr><td>Brand bar</td><td>Logo, tagline, link columns, social links, and the legal line on the dark surface</td></tr>
        </tbody>
    </table>
    <div class="ds-code"><pre>&lt;?= ws_footer() ?&gt;

&lt;?= ws_footer(['hide_level_up' =&gt; true]) ?&gt;

// legacy include, set before requiring includes/footer.php
$ws_footer_options = ['hide_level_up' =&gt; true];</pre></div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>First render</td><td>Defines <code>WS_GLOBAL_FOOTER_RENDERED</code> and emits the full composite, including its styles, tokens, fonts, and the toast/auth functional core.</td></tr>
            <tr><td>Subsequent renders</td><td>The guard returns early, so nothing is emitted. This is what makes double inclusion safe.</td></tr>
            <tr><td>Newsletter idle</td><td>Empty field, submit ready.</td></tr>
            <tr><td>Newsletter submitted</td><td>The response lands in <code>.cta__msg</code>, which is an <code>aria-live="polite"</code> region &mdash; so success and failure are both announced without stealing focus.</td></tr>
            <tr><td>Honeypot</td><td><code>.cta__hp</code> is a hidden field for spam trapping. It's visually hidden and must stay empty &mdash; don't repurpose or label it.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The standard page close. Because the component is self-contained, a page needs nothing else at the bottom &mdash; no extra stylesheet, no toast container, no auth script.</p>
    <div class="ds-code"><pre>&lt;?php
require_once 'config.php';
$header_section = 'library';
require_once 'includes/header.php';
?&gt;

&lt;main&gt;
    &lt;!-- …page content… --&gt;
&lt;/main&gt;

&lt;?= ws_footer() ?&gt;
&lt;/body&gt;&lt;/html&gt;</pre></div>
    <p class="ds-section-desc">The same call inside an app renders the <a href="<?= $ds_base ?>/components/demos/app-footer.php">App Footer</a> rail instead &mdash; there's no "hidden" or "compact" mode to reach for, and nothing to change per page.</p>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>$options</code></td><td>array</td><td><code>[]</code></td><td>Reserved for future variants. Nothing is read from it today &mdash; passing values has no effect.</td></tr>
        </tbody>
    </table>
    <p class="ds-section-desc">The link columns, social links, and CTA copy are defined in the template rather than passed in. Change them there so every page moves together.</p>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Landmark</td><td>A real <code>&lt;footer&gt;</code> element, so it's exposed as the contentinfo landmark and skippable.</td></tr>
            <tr><td>Newsletter feedback</td><td><code>.cta__msg</code> is <code>aria-live="polite"</code>, so the submit result is announced without interrupting or moving focus. This is the right pattern.</td></tr>
            <tr><td>Social links</td><td>Icon-only, each with an explicit <code>aria-label</code> naming the network &mdash; "LinkedIn", "Bluesky". Decorative glyphs inside carry <code>aria-hidden="true"</code>.</td></tr>
            <tr><td>Hidden text</td><td>Uses an <code>.sr-only</code> class for visually-hidden labels, so context reaches screen readers without appearing on screen.</td></tr>
            <tr><td>Honeypot</td><td>Hidden from sighted users. Confirm it's also out of the tab order and unlabelled so assistive-tech users aren't prompted to fill a trap field.</td></tr>
            <tr><td>Contrast</td><td>The legal line is white at 0.55 alpha over the ink surface, measured at roughly 5.8:1 &mdash; above the 4.5:1 AA threshold for body text. Don't reduce the alpha further.</td></tr>
            <tr><td>Link volume</td><td>The Level Up grid contributes a dozen links at the end of every page. Keeping the footer consistent in position and structure is what makes it easy to skip past.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <p class="ds-section-desc">The footer bundles its own styles inline and emits the platform token sheet itself, so it renders correctly even on a page that loads nothing else. It uses the ink surface for the brand bar, the shared type and spacing scales throughout, and the brand red for the CTA &mdash; the Level Up grid inside it resolves the phase tokens, all of which are now the same red.</p>
    <p class="ds-section-desc">See <a href="<?= $ds_base ?>/components/demos/level-up-grid.php">Level Up Grid</a> for the phase token detail, and <a href="<?= $ds_base ?>/resources/tokens.php">Token Reference</a> for current values.</p>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <p class="ds-section-desc">The footer's own classes are unprefixed (<code class="ds-code-inline">.footer-*</code>, <code class="ds-code-inline">.cta__*</code>) because the styles ship inline with the component rather than in the shared sheet. The grid inside it keeps the <code class="ds-code-inline">.ws-level-up</code> prefix.</p>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.footer</code></td><td>The <code>&lt;footer&gt;</code> landmark</td></tr>
            <tr><td><code>.footer-container</code></td><td>Max-width wrapper</td></tr>
            <tr><td><code>.footer-brand</code> / <code>.footer-logo</code> / <code>.footer-tagline</code></td><td>Brand block</td></tr>
            <tr><td><code>.footer-col</code> / <code>.footer-links</code></td><td>Link columns</td></tr>
            <tr><td><code>.footer-social</code></td><td>Social link row</td></tr>
            <tr><td><code>.footer-bottom</code></td><td>Legal line</td></tr>
            <tr><td><code>.cta</code> / <code>.cta__title</code> / <code>.cta__sub</code> / <code>.cta__rule</code></td><td>Newsletter block and its heading</td></tr>
            <tr><td><code>.cta__form</code> / <code>.cta__row</code> / <code>.cta__input</code></td><td>Signup form</td></tr>
            <tr><td><code>.cta__msg</code></td><td>Live region for the submit result</td></tr>
            <tr><td><code>.cta__note</code></td><td>Small print under the form</td></tr>
            <tr><td><code>.cta__hp</code></td><td>Honeypot field &mdash; leave alone</td></tr>
            <tr><td><code>.sr-only</code></td><td>Visually-hidden text</td></tr>
            <tr><td><code>.ws-level-up*</code></td><td>The embedded app grid &mdash; see its own page</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_footer()</code> helper function</td></tr>
            <tr><td><code>includes/components/footer.php</code></td><td>The composite template, the render-once guard, and the bundled styles</td></tr>
            <tr><td><code>includes/components/level-up-grid.php</code></td><td>The app grid rendered inside it</td></tr>
            <tr><td><code>includes/footer.php</code></td><td>Legacy page footer &mdash; now just calls <code>ws_footer()</code></td></tr>
        </tbody>
    </table>
</section>

<!-- Live render -->
<section class="ds-section">
    <h2 class="ds-section-title">Live render</h2>
    <p class="ds-section-desc">The real component follows, full-bleed. Everything below this line is the footer itself.</p>
</section>
<?= ws_footer() ?>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
