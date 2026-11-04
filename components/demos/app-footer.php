<?php
$ds_page  = 'components/demos/app-footer';
$ds_title = 'App Footer';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>App Footer</h1>
    <p>How an app page ends, in two weights: the 24px stone rail, or the app frame's beta bar &mdash; both in place of the marketing footer.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            Never, by hand &mdash; and that's the point. Any page under one of the paths in <code>WS_APP_PATHS</code> gets this automatically, whichever way it reaches the footer. Call <code>ws_app_footer()</code> directly only to force the rail on a page outside those paths.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            You're ending a content or marketing page. Those close on the <a href="<?= $ds_base ?>/components/demos/footer.php">Footer</a> composite &mdash; the Level Up grid and the newsletter CTA are how those pages earn their keep, and stripping them costs signups. Laying out the view itself is the page grid, <code>.app-page</code>: a six-column main beside the two-column rail (<a href="<?= $ds_base ?>/apps/app-shell-layouts.php">App Shell Layouts</a>).
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>
    <p class="ds-section-desc"><strong>band</strong> (default) is the 24px rail: one height, one colour, no content. A tool page should end quietly, and anything configurable there would be an invitation to put marketing back.</p>
    <div class="ds-code"><pre>&lt;?= ws_app_footer() ?&gt;</pre></div>
    <p class="ds-section-desc"><strong>full</strong> is the consolidated shell's frame bar, from the app wireframes: a 56px <code class="ds-code-inline">--gray-500</code> band carrying the wordmark and the build version (read live from the changelog's newest entry) on the left, and Send feedback / Resources / Company on the right. An <strong>Install the app</strong> action sits hidden before them, revealed only when Chrome fires <code class="ds-code-inline">beforeinstallprompt</code> &mdash; the installed app is the one window a browser draws without a URL row, so the bar offers it exactly when the browser permits (Safari and Firefox never fire the event and never see the button). Send feedback opens a <code class="ds-code-inline">ws_modal</code> wired to <code class="ds-code-inline">api/contact.php</code>; Resources and Company open small link panels above their buttons, carrying the same links as the marketing footer's columns. The launcher has no footer entry point &mdash; the rail's More button is its one way in. The composite's automatic routing calls with no arguments, so the shell picks this variant through <code class="ds-code-inline">$GLOBALS['ws_app_footer_options']</code> before the footer runs. Full-bleed tool steps take no footer at all (DESIGN.md &sect;12.7).</p>
    <div class="ds-code"><pre>// app/index.php — before includes/footer.php runs
$GLOBALS['ws_app_footer_options'] = ['variant' => 'full'];</pre></div>
    <div class="ds-demo">
        <?php /* Styles only, then static preview markup: the real template
                 carries a page-level render-once guard, so including it whole
                 would consume this page's one footer. $appFooterStylesOnly is
                 the template's documented escape hatch for exactly this. */ ?>
        <?php $appFooterStylesOnly = true; include __DIR__ . '/../../../includes/components/app-footer.php'; unset($appFooterStylesOnly); ?>
        <footer class="ws-app-footer ws-app-footer--full" style="position:static">
            <div class="ws-app-footer__identity">
                <span class="ws-app-footer__wordmark">Workshopr</span>
                <span class="ws-app-footer__version">v2.197.0</span>
            </div>
            <div class="ws-app-footer__actions">
                <span class="ws-app-footer__feedback"><span class="ws-app-footer__dot" aria-hidden="true"></span>Send feedback</span>
                <span class="ws-app-footer__link">Resources</span>
                <span class="ws-app-footer__sep" aria-hidden="true">&middot;</span>
                <span class="ws-app-footer__link">Company</span>
            </div>
        </footer>
    </div>
</section>

<!-- 4. Routing -->
<section class="ds-section">
    <h2 class="ds-section-title">How a page gets it</h2>
    <p class="ds-section-desc">Every route to a footer &mdash; <code class="ds-code-inline">ws_footer()</code>, a direct <code class="ds-code-inline">components/footer.php</code> include, or the legacy <code class="ds-code-inline">includes/footer.php</code> &mdash; passes through the composite template. That template runs one test and delegates, so no page needs per-page wiring and no app can drift.</p>
    <div class="ds-code"><pre>// includes/components/footer.php
if (ws_is_app_page()) {
    include __DIR__ . '/app-footer.php';
    return;
}</pre></div>
    <p class="ds-section-desc"><code class="ds-code-inline">ws_is_app_page()</code> matches the first segment of the request path against <code class="ds-code-inline">WS_APP_PATHS</code>, which mirrors the app inventory in PRODUCT.md §5:</p>
    <table class="ds-table">
        <thead><tr><th>Phase</th><th>Paths</th></tr></thead>
        <tbody>
            <tr><td>Learn</td><td><code>library</code>, <code>academy</code>, <code>tips</code>, <code>podcasts</code></td></tr>
            <tr><td>Plan</td><td><code>planner</code>, <code>agenda-check</code>, <code>toolkits</code>, <code>myworkshopr</code></td></tr>
            <tr><td>Facilitate</td><td><code>facilitator</code>, <code>sidekick</code>, <code>intervention</code></td></tr>
            <tr><td>Reflect</td><td><code>dna</code>, <code>synthesize</code>, <code>coach</code></td></tr>
            <tr><td>Other</td><td><code>strategist</code>, <code>admin</code></td></tr>
        </tbody>
    </table>
    <p class="ds-section-desc">Adding an app means adding its path there and nothing else. Don't add a marketing page that happens to live under an app directory.</p>
</section>

<!-- 5. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>First render</td><td>Defines <code>WS_GLOBAL_FOOTER_RENDERED</code>, emits the token link, the style block, the rail, and the toast/auth functional core.</td></tr>
            <tr><td>Subsequent renders</td><td>The shared guard returns early. A page gets one footer of one kind &mdash; whichever composite reaches the guard first wins.</td></tr>
            <tr><td>Short page</td><td>The rail sits in normal flow, so on a page shorter than the viewport it lands under the content rather than at the window bottom. It does not stick.</td></tr>
            <tr><td>Fixed-viewport page</td><td>Not rendered. The Planner builder, <code>facilitator/app.php</code> and <code>synthesize/app.php</code> are <code>100vh</code> workspaces &mdash; 24px more would buy a scrollbar on a canvas designed not to scroll, and the rail would sit below the fold. Those pages end at <code>&lt;/body&gt;</code>.</td></tr>
        </tbody>
    </table>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <p class="ds-section-desc">The helper takes no arguments. If you find yourself wanting one, the page probably wants the full <a href="<?= $ds_base ?>/components/demos/footer.php">Footer</a> instead.</p>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Landmark</td><td>Carries <code>aria-hidden="true"</code>. The rail holds no content, and an empty contentinfo landmark is noise a screen-reader user has to check and discard.</td></tr>
            <tr><td>Contrast</td><td>Not applicable &mdash; there is no text. <code>--gray-400</code> is documented as decorative-only for exactly this reason; never put essential text on it.</td></tr>
            <tr><td>Focus</td><td>Nothing focusable, so it adds no tab stops between the last control on the page and the end of the document.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Value</th><th>Use</th></tr></thead>
        <tbody>
            <tr><td><code>--gray-400</code></td><td><code>#A8A29E</code></td><td>The rail's fill &mdash; the only colour in the component</td></tr>
        </tbody>
    </table>
    <p class="ds-section-desc">The component emits <code class="ds-code-inline">platform-tokens.css</code> itself, because app pages such as the Planner and Facilitator run their own CSS stacks and don't all load the shared sheet. Browsers dedupe the identical href. See <a href="<?= $ds_base ?>/resources/tokens.php">Token Reference</a> for current values.</p>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-app-footer</code></td><td>The rail. 24px tall, <code>flex: none</code> so a flex page layout can't compress it.</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_app_footer()</code>, <code>ws_is_app_page()</code>, and the <code>WS_APP_PATHS</code> list</td></tr>
            <tr><td><code>includes/components/app-footer.php</code></td><td>The template, the shared render-once guard, and the bundled style</td></tr>
            <tr><td><code>includes/components/footer.php</code></td><td>The composite that delegates here on an app page</td></tr>
        </tbody>
    </table>
</section>

<!-- Live render -->
<section class="ds-section">
    <h2 class="ds-section-title">Live render</h2>
    <p class="ds-section-desc">The real component follows, full-bleed. The stone band below this line is the whole thing.</p>
</section>
<?= ws_app_footer() ?>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
