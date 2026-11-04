<?php
$ds_page  = 'components/demos/agent-check';
$ds_title = 'Agent Check';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Agent Check</h1>
    <p>The rules an AI result was held to, each with its verdict and its evidence: passed, worth a look, or failed.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            The AI checked its own work against named rules and the person should see the verdicts before they trust it: the review pane of a generated agenda (fits the time, breaks every 90 minutes, works for the group size), the checks a recap passed before it can be shared. Name the rule in the title and put the evidence in the detail.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            It is form validation (the field's own error), a to-do list the person works through (<a href="<?= $ds_base ?>/components/demos/checklist.php">Checklist</a> and the task checklist), or the steps a run took rather than the rules it met (<a href="<?= $ds_base ?>/components/demos/agent-steps.php">Agent Steps</a>).
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Verdicts</h3>
        <p class="ds-section-desc">Each check is <code class="ds-code-inline">pass</code>, <code class="ds-code-inline">warn</code> or <code class="ds-code-inline">fail</code>. Warn is for a rule that holds but deserves a second look; fail is a rule the result breaks.</p>
        <div class="ds-card ds-measure">
            <?= ws_agent_check([
                ['title' => 'Fits 2 hours', 'state' => 'pass', 'detail' => '1h 55m, inside the 12% allowance. No stretch over 90 minutes without a break.'],
                ['title' => 'Works for 12 people', 'state' => 'warn', 'detail' => 'Two Truths and a Bet lists "any size". Fine, but it runs long past 15.'],
                ['title' => 'Serves the outcome', 'state' => 'fail', 'detail' => 'The decision has 8 minutes. Choosing 3 of 12 with 12 people needs about 24.'],
                ['title' => 'Materials', 'state' => 'pass', 'detail' => 'A pre-read, and notes for every item.'],
            ], ['label' => 'Checks this agenda was held to']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_agent_check([
    ['title' =&gt; 'Fits 2 hours', 'state' =&gt; 'pass', 'detail' =&gt; '1h 55m, inside the 12% allowance.'],
    ['title' =&gt; 'Works for 12 people', 'state' =&gt; 'warn', 'detail' =&gt; 'Two Truths and a Bet runs long past 15.'],
    ['title' =&gt; 'Serves the outcome', 'state' =&gt; 'fail', 'detail' =&gt; 'The decision has 8 minutes; it needs about 24.'],
], ['label' =&gt; 'Checks this agenda was held to']) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>Verdict</th><th>Looks</th><th>Says</th></tr></thead>
        <tbody>
            <tr><td><code>pass</code></td><td>A ticked circle in green</td><td>"Passed:"</td></tr>
            <tr><td><code>warn</code></td><td>A triangle in amber</td><td>"Worth a look:"</td></tr>
            <tr><td><code>fail</code></td><td>An exclamation circle in red</td><td>"Failed:"</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>$checks</code></td><td>array</td><td></td><td>Each: <code>title</code>, <code>state</code> (<code>pass</code> | <code>warn</code> | <code>fail</code>), <code>detail</code></td></tr>
            <tr><td><code>label</code></td><td>string</td><td><code>''</code></td><td>The list's accessible name, when no heading above it names it</td></tr>
            <tr><td><code>id</code> / <code>class</code> / <code>attrs</code></td><td>string / string / array</td><td></td><td>Element id, classes and attributes</td></tr>
        </tbody>
    </table>
</section>

<!-- 6. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Structure</td><td>A list, named by <code>label</code> when you pass one; otherwise put a heading above it.</td></tr>
            <tr><td>Verdict in words</td><td>Each check starts with visually hidden words for its verdict ("Passed:", "Worth a look:", "Failed:"), and each verdict has its own glyph shape, so nothing rests on colour.</td></tr>
            <tr><td>Glyphs</td><td><code>aria-hidden</code>; green, amber and red glyphs each clear 3:1 on white.</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--color-success-dark</code> / <code>--color-warning-darker</code> / <code>--color-error-dark</code></td><td>The verdict glyphs</td></tr>
            <tr><td><code>--bg-surface</code> / <code>--card-border</code> / <code>--card-radius</code></td><td>The list's surface, matched to the cards around it</td></tr>
            <tr><td><code>--gray-100</code></td><td>The rule between checks</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-agent-check</code></td><td>The list</td></tr>
            <tr><td><code>.ws-agent-check__item</code></td><td>One check, <code>--pass</code> / <code>--warn</code> / <code>--fail</code></td></tr>
            <tr><td><code>.ws-agent-check__glyph</code></td><td>The verdict glyph</td></tr>
            <tr><td><code>.ws-agent-check__title</code> / <code>__detail</code></td><td>The rule and its evidence</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_agent_check()</code> helper</td></tr>
            <tr><td><code>includes/components/agent-check.php</code></td><td>Template</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles, in the agent components section</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
