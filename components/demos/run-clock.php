<?php
$ds_page  = 'components/demos/run-clock';
$ds_title = 'Run Clock';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';

// The live example ends 7 minutes 20 seconds after this page was served.
$demoEndsAt = (time() + 440) * 1000;
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Run Clock</h1>
    <p>The time left on the running block, readable across a room. It counts down, then counts up past the plan with a plus sign.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            A block is running and the facilitator needs the time left at a glance: the cockpit, the run screen, Sidekick. Give it <code>endsAt</code> and the clock keeps itself right from that timestamp.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The duration does not move. A planned length is the duration in an <a href="<?= $ds_base ?>/components/demos/agenda.php">Agenda</a> or a <a href="<?= $ds_base ?>/components/demos/badge.php">Badge</a>; a proportion of a whole is a <a href="<?= $ds_base ?>/components/demos/progress.php">Progress</a> bar; a headline number is a <a href="<?= $ds_base ?>/components/demos/stat.php">Stat</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Sizes</h3>
        <p class="ds-section-desc"><code class="ds-code-inline">md</code> is the run bar's size, <code class="ds-code-inline">lg</code> (the default) the side panel's, <code class="ds-code-inline">xl</code> the wide cockpit's.</p>
        <div class="ds-card">
            <?php ws_stack_start(['gap' => '5']) ?>
            <?= ws_run_clock(['seconds' => 440, 'planned' => 20, 'size' => 'md']) ?>
            <?= ws_run_clock(['seconds' => 440, 'planned' => 20]) ?>
            <?= ws_run_clock(['seconds' => 440, 'planned' => 20, 'size' => 'xl']) ?>
            <?php ws_stack_end() ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_run_clock(['seconds' =&gt; 440, 'planned' =&gt; 20, 'size' =&gt; 'md']) ?&gt;
&lt;?= ws_run_clock(['seconds' =&gt; 440, 'planned' =&gt; 20]) ?&gt;
&lt;?= ws_run_clock(['seconds' =&gt; 440, 'planned' =&gt; 20, 'size' =&gt; 'xl']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">The four states</h3>
        <p class="ds-section-desc">Pass <code class="ds-code-inline">seconds</code> and the state follows: the last two minutes are <code class="ds-code-inline">ending</code>, anything below zero is <code class="ds-code-inline">over</code>. Only <code class="ds-code-inline">paused</code> is ever passed by hand.</p>
        <div class="ds-card">
            <?php ws_grid_start(['min' => 'sm', 'gap' => '6']) ?>
            <?= ws_run_clock(['seconds' => 440, 'planned' => 20]) ?>
            <?= ws_run_clock(['seconds' => 90, 'planned' => 20]) ?>
            <?= ws_run_clock(['seconds' => -310, 'planned' => 20]) ?>
            <?= ws_run_clock(['seconds' => 440, 'planned' => 20, 'state' => 'paused']) ?>
            <?php ws_grid_end() ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_run_clock(['seconds' =&gt; 440, 'planned' =&gt; 20]) ?&gt;   // running
&lt;?= ws_run_clock(['seconds' =&gt; 90, 'planned' =&gt; 20]) ?&gt;    // ending
&lt;?= ws_run_clock(['seconds' =&gt; -310, 'planned' =&gt; 20]) ?&gt;  // over
&lt;?= ws_run_clock(['seconds' =&gt; 440, 'planned' =&gt; 20, 'state' =&gt; 'paused']) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Running</td><td>Counts down in <code>--text-dark</code>, labelled "left of 20 min".</td></tr>
            <tr><td>Ending</td><td>The last two minutes, in <code>--color-warning-ink</code>. The live region says "Two minutes left" once.</td></tr>
            <tr><td>Over</td><td>Counts up with a plus sign in <code>--brand-ink</code>, labelled "over its 20 min". The live region says so, then once for each further minute.</td></tr>
            <tr><td>Paused</td><td>The value in <code>--text-muted</code>, labelled "Paused". Remove <code>data-ends-at</code> and the script stops moving it.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The cockpit's Now card. The server sends when the block is due to end; <code class="ds-code-inline">/js/ws-run-clock.js</code> does the rest. This one is live.</p>
    <div class="ds-card ds-measure">
        <?php ws_stack_start(['gap' => '3']) ?>
        <?= ws_activity_badge('exercise', ['size' => 'sm']) ?>
        <?= ws_text('Sailboat Retrospective', ['variant' => 'title']) ?>
        <?= ws_run_clock(['seconds' => 440, 'planned' => 20, 'endsAt' => $demoEndsAt, 'id' => 'demoRunClock']) ?>
        <?php ws_stack_end() ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_run_clock(['seconds' =&gt; $left, 'planned' =&gt; 20, 'endsAt' =&gt; $endsAtMs]) ?&gt;
&lt;script src="/js/ws-run-clock.js?v=2"&gt;&lt;/script&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>seconds</code></td><td>int</td><td><code>null</code></td><td>Seconds left on the block; negative means over. Builds the value, the label, the state and the accessible name.</td></tr>
            <tr><td><code>value</code></td><td>string</td><td><code>''</code></td><td>The text shown when <code>seconds</code> is not given</td></tr>
            <tr><td><code>planned</code></td><td>int</td><td><code>null</code></td><td>The block's planned minutes, for the label</td></tr>
            <tr><td><code>label</code></td><td>string</td><td>derived</td><td>Replaces the derived label; the script then leaves it alone</td></tr>
            <tr><td><code>state</code></td><td>string</td><td>derived</td><td><code>running</code>, <code>ending</code>, <code>over</code> or <code>paused</code></td></tr>
            <tr><td><code>size</code></td><td>string</td><td><code>'lg'</code></td><td><code>md</code>, <code>lg</code> or <code>xl</code></td></tr>
            <tr><td><code>endsAt</code></td><td>int</td><td><code>null</code></td><td>Epoch milliseconds the block is due to end. With it the script keeps the clock moving.</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>''</code></td><td>Element ID</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra HTML attributes</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Semantics</td><td><code>role="timer"</code>, which is <code>aria-live="off"</code>, so a second ticking by is never read out.</td></tr>
            <tr><td>Name</td><td>The accessible name says the time in words ("7 minutes 20 seconds left of 20 minutes") and follows the clock to the second, so 07:20 is never spelled out. A timer is never read aloud on its own, so the name can change without speaking.</td></tr>
            <tr><td>Announcements</td><td>A polite live region inside the clock speaks on entering the last two minutes, on going over, and once for each further minute over. Never on page load.</td></tr>
            <tr><td>Colour</td><td>State is in the text (the plus sign and the label), never colour alone. <code>--brand-ink</code> and <code>--color-warning-ink</code> pass AA on white and on paper.</td></tr>
            <tr><td>Motion</td><td>No pulse or flash in any state.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--text-h1</code> / <code>--text-display-lg</code> / <code>--text-display-xl</code></td><td>The value at <code>md</code>, <code>lg</code> and <code>xl</code></td></tr>
            <tr><td><code>--font-body</code>, <code>--font-bold</code>, <code>--tracking-tight</code></td><td>The value: Inter, bold, tight, with tabular figures</td></tr>
            <tr><td><code>--text-dark</code></td><td>Running</td></tr>
            <tr><td><code>--color-warning-ink</code></td><td>Ending</td></tr>
            <tr><td><code>--brand-ink</code></td><td>Over</td></tr>
            <tr><td><code>--text-muted</code></td><td>Paused</td></tr>
            <tr><td><code>--text-small</code>, <code>--text-default</code></td><td>The label</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-run-clock</code></td><td>The clock. Carries <code>data-ws-run-clock</code>, <code>data-state</code>, and <code>data-planned</code> / <code>data-ends-at</code> when given.</td></tr>
            <tr><td><code>.ws-run-clock--md</code> / <code>--lg</code> / <code>--xl</code></td><td>Size</td></tr>
            <tr><td><code>.ws-run-clock--running</code> / <code>--ending</code> / <code>--over</code> / <code>--paused</code></td><td>State; the script swaps it as time passes</td></tr>
            <tr><td><code>.ws-run-clock__value</code></td><td>The readout</td></tr>
            <tr><td><code>.ws-run-clock__label</code></td><td>The label beside it</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_run_clock()</code> and its formatting helpers</td></tr>
            <tr><td><code>includes/components/run-clock.php</code></td><td>Template: the clock, its label and its live region</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-run-clock</code> rules)</td></tr>
            <tr><td><code>js/ws-run-clock.js</code></td><td>Keeps clocks with <code>data-ends-at</code> right from the timestamp</td></tr>
        </tbody>
    </table>
</section>

<script src="<?= $site_base ?>/js/ws-run-clock.js?v=2"></script>
<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
