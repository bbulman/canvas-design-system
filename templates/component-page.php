<?php
/**
 * TEMPLATE — component/pattern documentation page.
 * Copy into design-system/components/demos/<name>.php and fill every section.
 * Section order is fixed (see templates/README.md); delete only sections
 * marked optional there. Replace ws_example() calls with the real helper.
 */
$ds_page  = 'components/COMPONENT-NAME';
$ds_title = 'Component Name';

require_once dirname(__DIR__, 2) . '/includes/icon.php';
require_once dirname(__DIR__, 2) . '/includes/components/helpers.php';
require_once dirname(__DIR__) . '/includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <!-- Status badge: stable pages omit the span; beta/deprecated declare it -->
    <h1>Component Name <span class="ds-status ds-status--beta">beta</span></h1>
    <p>One sentence: what it is and the job it does. Lead with the job.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            The concrete situations this component serves.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The near-miss cases &mdash; and link the alternative, e.g.
            <a href="<?= $ds_base ?>/components/demos/alert.php">Alert</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>
    <p class="ds-section-desc">Live render every variant; group related ones in a grid.</p>
    <div class="ds-grid-3">
        <!-- <?php /* ws_example(['variant' => 'primary']) */ ?> -->
    </div>
    <div class="ds-code"><pre>&lt;?= ws_example(['variant' =&gt; 'primary']) ?&gt;</pre></div>
</section>

<!-- 4. States (optional — delete if the component has none) -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <p class="ds-section-desc">Hover, focus, disabled, loading, error — rendered, not described.</p>
</section>

<!-- 5. Real-world usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">At least one example with production data shapes, copied from a live page.</p>
</section>

<!-- 6. Options / API -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>variant</code></td><td>string</td><td><code>'primary'</code></td><td>&hellip;</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility (never delete — write "None — static content" if truly none) -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Keyboard</td><td>&hellip;</td></tr>
            <tr><td>ARIA</td><td>&hellip;</td></tr>
            <tr><td>Focus</td><td>&hellip;</td></tr>
            <tr><td>Reduced motion</td><td>&hellip;</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens (optional) -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--card-radius</code></td><td>&hellip;</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-example</code></td><td>&hellip;</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td>Helper function</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles</td></tr>
        </tbody>
    </table>
</section>

<?php require_once dirname(__DIR__) . '/includes/ds-footer.php'; ?>
