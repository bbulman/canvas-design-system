<?php
$ds_page  = 'components/demos/agent-steps';
$ds_title = 'Agent Steps';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Agent Steps</h1>
    <p>The visible history of an AI run: each step it took and what it found, down to the check that failed and the revision that fixed it, with an optional summary row under the list.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            A multi-step AI run has produced something and the person should be able to see how it got there: Prepare my workshop's working pane, a generated agenda's "how this was made" panel. Say what each step found, in numbers where you have them ("5 open commitments become the candidate priorities").
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The person is waiting on live progress with nothing else to look at; that is <a href="<?= $ds_base ?>/components/demos/agent-status.php">Agent Status</a> in stages mode. Verdicts against a list of rules are <a href="<?= $ds_base ?>/components/demos/agent-check.php">Agent Check</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">A run with a summary row</h3>
        <p class="ds-section-desc">Each step is <code class="ds-code-inline">done</code>, <code class="ds-code-inline">fail</code>, <code class="ds-code-inline">now</code> or <code class="ds-code-inline">todo</code>, with a detail line. <code class="ds-code-inline">fail</code> is a step whose own check failed and that the run went on to fix, so it is amber, not an error. A step can swap its state's glyph with <code class="ds-code-inline">icon</code>, as the revision does here. The <code class="ds-code-inline">summary</code> row closes the list.</p>
        <div class="ds-card ds-measure">
            <?= ws_agent_steps([
                ['label' => 'Read the brief and Q3 Roadmap Offsite', 'state' => 'done', 'detail' => '5 open commitments become the candidate priorities.'],
                ['label' => 'Built a first agenda from 7 library activities', 'state' => 'done'],
                ['label' => 'Round 1: 2 of 7 checks failed', 'state' => 'fail', 'detail' => 'The decision had 8 minutes. Choosing 3 of 12 with 12 people needs about 24.'],
                ['label' => 'Revised', 'state' => 'done', 'icon' => 'auto_fix_high', 'detail' => 'Swapped Crazy 8s for 1-2-4-All and gave the decision 30 minutes.'],
                ['label' => 'Checking again', 'state' => 'now'],
                ['label' => 'Write the pre-read and your notes', 'state' => 'todo'],
            ], ['summary' => ['label' => 'Rounds', 'value' => '2 of 3']]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_agent_steps([
    ['label' =&gt; 'Read the brief and Q3 Roadmap Offsite', 'state' =&gt; 'done',
     'detail' =&gt; '5 open commitments become the candidate priorities.'],
    ['label' =&gt; 'Round 1: 2 of 7 checks failed', 'state' =&gt; 'fail', 'detail' =&gt; '...'],
    ['label' =&gt; 'Revised', 'state' =&gt; 'done', 'icon' =&gt; 'auto_fix_high', 'detail' =&gt; '...'],
    ['label' =&gt; 'Checking again', 'state' =&gt; 'now'],
    ['label' =&gt; 'Write the pre-read and your notes', 'state' =&gt; 'todo'],
], ['summary' =&gt; ['label' =&gt; 'Rounds', 'value' =&gt; '2 of 3']]) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>Step</th><th>Looks</th><th>Says</th></tr></thead>
        <tbody>
            <tr><td><code>done</code></td><td>A tick in a stone circle</td><td>"Done:"</td></tr>
            <tr><td><code>fail</code></td><td>An exclamation in an amber circle</td><td>"Needs another pass:"</td></tr>
            <tr><td><code>now</code></td><td>A turning ring in a filled red circle; still under reduced motion</td><td>"In progress:", and <code>aria-current="step"</code></td></tr>
            <tr><td><code>todo</code></td><td>An empty circle, the title muted</td><td>"Not started:"</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>$steps</code></td><td>array</td><td></td><td>Each: <code>label</code>, <code>state</code> (<code>done</code> | <code>fail</code> | <code>now</code> | <code>todo</code>), <code>detail</code>, <code>icon</code></td></tr>
            <tr><td><code>label</code></td><td>string</td><td><code>'What Workshopr did'</code></td><td>The list's accessible name</td></tr>
            <tr><td><code>summary</code></td><td>array</td><td><code>null</code></td><td>A row under the list: <code>label</code> and <code>value</code></td></tr>
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
            <tr><td>Structure</td><td>An ordered list named by <code>label</code>, so the run reads in order and a screen reader says how many steps there are.</td></tr>
            <tr><td>State in words</td><td>Each step starts with visually hidden words for its state ("Done:", "Needs another pass:", "In progress:", "Not started:"), and each state has its own glyph shape, so nothing rests on colour. The step in progress carries <code>aria-current="step"</code>.</td></tr>
            <tr><td>Glyphs</td><td><code>aria-hidden</code>; the words carry the meaning. The turning ring stops under reduced motion.</td></tr>
            <tr><td>Not live</td><td>This is a record, not a live region. For progress a screen reader should hear as it happens, use Agent Status.</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--brand</code></td><td>The step in progress</td></tr>
            <tr><td><code>--color-warning</code> / <code>--color-warning-surface</code> / <code>--color-warning-surface-ink</code></td><td>A step that needs another pass</td></tr>
            <tr><td><code>--gray-100</code> / <code>--gray-200</code> / <code>--gray-300</code></td><td>Done circles, the connecting line, still-to-come circles</td></tr>
            <tr><td><code>--card-bg</code> / <code>--radius-lg</code></td><td>The summary row</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-agent-steps</code></td><td>Root</td></tr>
            <tr><td><code>.ws-agent-steps__list</code></td><td>The ordered list</td></tr>
            <tr><td><code>.ws-agent-steps__step</code></td><td>One step, <code>--done</code> / <code>--fail</code> / <code>--now</code> / <code>--todo</code>; draws the line to the next</td></tr>
            <tr><td><code>.ws-agent-steps__icon</code> / <code>__glyph</code></td><td>The state circle and its glyph</td></tr>
            <tr><td><code>.ws-agent-steps__title</code> / <code>__detail</code></td><td>A step's title and detail</td></tr>
            <tr><td><code>.ws-agent-steps__summary</code> / <code>__summary-value</code></td><td>The summary row</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_agent_steps()</code> helper</td></tr>
            <tr><td><code>includes/components/agent-steps.php</code></td><td>Template</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles, in the agent components section</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
