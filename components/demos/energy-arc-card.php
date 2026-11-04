<?php
$ds_page  = 'components/demos/energy-arc-card';
$ds_title = 'Energy Arc Card';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Energy Arc Card</h1>
    <p>Summarises how a session's energy moved: a score, an interpretive badge, a sparkline, and four contributing metrics.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            You're showing the energy arc of a specific workshop &mdash; the top of the Coach retrospective, the Planner's inspector rail, a Facilitator debrief. It carries session-retrospective semantics, not generic scoring.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            You need a generic number &mdash; use <a href="<?= $ds_base ?>/components/demos/stat.php">Stat</a>. For a single proportion use <a href="<?= $ds_base ?>/components/demos/progress.php">Progress</a>. Don't stretch it past ~400px; the chart and metric grid are tuned for that width.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Canonical (light)</h3>
        <p class="ds-section-desc">The default. Four regions: eyebrow header, score row, sparkline with axis labels, and a 2&times;2 metric grid.</p>
        <div class="ds-card">
            <div class="ds-ea-stage">
                <?= ws_energy_arc_card([
                    'eyebrow'    => 'Energy Arc',
                    'timeUsed'   => '8 of 8h used',
                    'status'     => ['text' => 'Complete', 'type' => 'success'],
                    'score'      => 82,
                    'scoreBadge' => ['text' => 'Needs Work', 'type' => 'warning'],
                    'chartData'  => [
                        ['time' => '9:00',  'value' => 48],
                        ['time' => '10:30', 'value' => 88],
                        ['time' => '12:00', 'value' => 70],
                        ['time' => '1:00',  'value' => 62],
                        ['time' => '3:00',  'value' => 82],
                        ['time' => '5:00',  'value' => 92],
                    ],
                    'timeLabels' => ['9:00', '10:30', '1:00', '5:00'],
                    'metrics' => [
                        ['label' => 'Pacing',     'value' => '~17m', 'fill' => 30],
                        ['label' => 'Variety',    'value' => '3/7',  'fill' => 43],
                        ['label' => 'Recovery',   'value' => '55m',  'fill' => 70],
                        ['label' => 'Engagement', 'value' => '63%',  'fill' => 63],
                    ],
                ]) ?>
            </div>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_energy_arc_card([
    'eyebrow'    => 'Energy Arc',
    'timeUsed'   => '8 of 8h used',
    'status'     => ['text' => 'Complete', 'type' => 'success'],
    'score'      => 82,
    'scoreBadge' => ['text' => 'Needs Work', 'type' => 'warning'],
    'chartData'  => [['time' => '9:00', 'value' => 48], /* … */],
    'timeLabels' => ['9:00', '10:30', '1:00', '5:00'],
    'metrics'    => [
        ['label' => 'Pacing',     'value' => '~17m', 'fill' => 30],
        ['label' => 'Engagement', 'value' => '63%',  'fill' => 63],
    ],
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Dark</h3>
        <p class="ds-section-desc">For presentation mode and dark dashboards. Badges and bars switch to a tinted-on-dark treatment.</p>
        <div class="ds-card">
            <div class="ds-ea-stage ds-ea-stage--dark">
                <?= ws_energy_arc_card([
                    'timeUsed'   => '6 of 8h used',
                    'status'     => ['text' => 'In Progress', 'type' => 'info'],
                    'score'      => 71,
                    'scoreBadge' => ['text' => 'On Track', 'type' => 'info'],
                    'chartData'  => [
                        ['time' => '9:00',  'value' => 40],
                        ['time' => '10:30', 'value' => 72],
                        ['time' => '12:00', 'value' => 60],
                        ['time' => '1:00',  'value' => 55],
                        ['time' => '3:00',  'value' => 75],
                    ],
                    'timeLabels' => ['9:00', '11:00', '1:00', '3:00'],
                    'metrics' => [
                        ['label' => 'Pacing',     'value' => '~12m', 'fill' => 55],
                        ['label' => 'Variety',    'value' => '4/7',  'fill' => 57],
                        ['label' => 'Recovery',   'value' => '40m',  'fill' => 50],
                        ['label' => 'Engagement', 'value' => '71%',  'fill' => 71],
                    ],
                    'theme' => 'dark',
                ]) ?>
            </div>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_energy_arc_card([/* … */ 'theme' => 'dark']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Score tiers</h3>
        <p class="ds-section-desc">The badge does the interpreting. Drive its <code class="ds-code-inline">type</code> from the score so colour reinforces the number: 85+ success, 70+ info, 50+ warning, below 50 danger.</p>
        <div class="ds-card">
            <div class="ds-ea-stage">
                <?= ws_energy_arc_card([
                    'timeUsed'   => '8 of 8h used',
                    'status'     => ['text' => 'Complete', 'type' => 'success'],
                    'score'      => 94,
                    'scoreBadge' => ['text' => 'Excellent', 'type' => 'success'],
                    'chartData'  => [
                        ['time' => '9:00', 'value' => 65], ['time' => '10:30', 'value' => 80],
                        ['time' => '12:00', 'value' => 92], ['time' => '3:00', 'value' => 96],
                    ],
                    'timeLabels' => ['9:00', '12:00', '3:00'],
                    'metrics' => [
                        ['label' => 'Pacing',     'value' => '~10m', 'fill' => 85],
                        ['label' => 'Variety',    'value' => '6/7',  'fill' => 86],
                        ['label' => 'Recovery',   'value' => '40m',  'fill' => 80],
                        ['label' => 'Engagement', 'value' => '91%',  'fill' => 91],
                    ],
                ]) ?>
                <?= ws_energy_arc_card([
                    'timeUsed'   => '4 of 8h used',
                    'status'     => ['text' => 'At Risk', 'type' => 'danger'],
                    'score'      => 42,
                    'scoreBadge' => ['text' => 'At Risk', 'type' => 'danger'],
                    'chartData'  => [
                        ['time' => '9:00', 'value' => 55], ['time' => '10:30', 'value' => 40],
                        ['time' => '12:00', 'value' => 30], ['time' => '1:00', 'value' => 35],
                    ],
                    'timeLabels' => ['9:00', '11:00', '1:00'],
                    'metrics' => [
                        ['label' => 'Pacing',     'value' => '~32m', 'fill' => 22],
                        ['label' => 'Variety',    'value' => '1/7',  'fill' => 14],
                        ['label' => 'Recovery',   'value' => '15m',  'fill' => 20],
                        ['label' => 'Engagement', 'value' => '38%',  'fill' => 38],
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>Static. The card reports; nothing in it is interactive.</td></tr>
            <tr><td>Score clamped</td><td>Values below 0 become 0, above <code>scoreMax</code> become <code>scoreMax</code>. A bad score can't overflow the row.</td></tr>
            <tr><td>Header hidden</td><td><code>showHeader =&gt; false</code> drops the eyebrow row so a container can supply its own title. This is what <a href="<?= $ds_base ?>/components/demos/planner-inspector-rail.php">Planner Inspector Rail</a> sets automatically.</td></tr>
            <tr><td>Badge variant</td><td><code>scoreBadge.variant</code> is <code>pill</code> by default; <code>note</code> gives the smaller mono tag the inspector rail uses.</td></tr>
            <tr><td>Too few chart points</td><td>Fewer than four points renders a near-flat line that reads as no data. Pass four to eight; beyond ten the arc loses definition at this width.</td></tr>
            <tr><td>No chart data</td><td>The chart region renders empty. Guard on the array and show <a href="<?= $ds_base ?>/components/demos/empty-state.php">Empty State</a> instead.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The Coach retrospective header. The badge tier is derived from the score rather than hand-set, so the colour can never contradict the number.</p>
    <div class="ds-code"><pre>&lt;?php
$score = $energyScorer-&gt;score($planId);
$tier  = match (true) {
    $score &gt;= 85 =&gt; ['Excellent',  'success'],
    $score &gt;= 70 =&gt; ['On Track',   'info'],
    $score &gt;= 50 =&gt; ['Needs Work', 'warning'],
    default      =&gt; ['At Risk',    'danger'],
};
?&gt;
&lt;?= ws_energy_arc_card([
    'eyebrow'    => 'Energy Arc',
    'timeUsed'   => formatDuration($used) . ' of ' . formatDuration($planned) . ' used',
    'status'     => ['text' => $session['status_label'], 'type' => $session['status_type']],
    'score'      => $score,
    'scoreBadge' => ['text' => $tier[0], 'type' => $tier[1]],
    'chartData'  => $energyScorer-&gt;series($planId),      // 4–8 points
    'timeLabels' => $energyScorer-&gt;axisLabels($planId),
    'metrics'    => $energyScorer-&gt;dimensions($planId),  // up to 4
]) ?&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>score</code></td><td>int</td><td><code>0</code></td><td>Effectively required. Clamped to 0&ndash;<code>scoreMax</code>.</td></tr>
            <tr><td><code>scoreMax</code></td><td>int</td><td><code>100</code></td><td>Denominator shown beside the score</td></tr>
            <tr><td><code>scoreBadge</code></td><td>array</td><td><code>null</code></td><td><code>['text' =&gt; …, 'type' =&gt; …, 'variant' =&gt; …]</code>. Types: <code>success</code> | <code>warning</code> | <code>danger</code> | <code>info</code> | <code>neutral</code>. <code>variant</code> is <code>pill</code> (default) or <code>note</code>.</td></tr>
            <tr><td><code>eyebrow</code></td><td>string</td><td><code>'Energy Arc'</code></td><td>Top-left label, rendered uppercase</td></tr>
            <tr><td><code>timeUsed</code></td><td>string</td><td><code>''</code></td><td>Muted progress text in the header</td></tr>
            <tr><td><code>status</code></td><td>array</td><td><code>null</code></td><td><code>['text' =&gt; …, 'type' =&gt; …]</code>, same types as the badge</td></tr>
            <tr><td><code>showHeader</code></td><td>bool</td><td><code>true</code></td><td>Render the eyebrow row. <strong>Undocumented in the helper's docblock</strong>, but supported &mdash; the inspector rail relies on it.</td></tr>
            <tr><td><code>chartData</code></td><td>array</td><td><code>[]</code></td><td><code>[['time' =&gt; …, 'value' =&gt; 0..100]]</code>. Values are clamped.</td></tr>
            <tr><td><code>timeLabels</code></td><td>array</td><td><code>[]</code></td><td>X-axis tick strings, spaced evenly. Independent of <code>chartData</code> &mdash; they don't have to match point-for-point.</td></tr>
            <tr><td><code>metrics</code></td><td>array</td><td><code>[]</code></td><td>Up to 4: <code>['label', 'value', 'fill' =&gt; 0..100, 'barColor'?]</code>. Keep values to 3&ndash;5 characters.</td></tr>
            <tr><td><code>theme</code></td><td>string</td><td><code>'light'</code></td><td><code>light</code> | <code>dark</code>. <strong>Corrected:</strong> this page previously documented the default as <code>dark</code>; the template defaults to <code>light</code>.</td></tr>
            <tr><td><code>accent</code></td><td>string</td><td>theme default</td><td>Overrides the accent as an inline CSS variable. Pass a token reference, not a literal hex.</td></tr>
            <tr><td><code>id</code> / <code>class</code> / <code>attrs</code></td><td>string / string / array</td><td>&mdash;</td><td>Standard passthrough</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Chart</td><td>The sparkline carries <code>role="img"</code> with <code>aria-label="Energy arc over time"</code>, so it's announced as one graphic rather than a pile of SVG nodes. Good &mdash; but the label is generic and conveys no shape or trend.</td></tr>
            <tr><td>Decorative parts</td><td>Grid lines and the axis carry <code>aria-hidden="true"</code>.</td></tr>
            <tr><td>Score</td><td>Score and denominator are adjacent text, so "82 out of 100" is announced in order without extra wiring.</td></tr>
            <tr><td>Metrics</td><td>Label and value are text; the bar is presentational. The number carries the meaning, so the fill is safe reinforcement.</td></tr>
            <tr><td>Keyboard</td><td>Nothing is focusable, which is correct for a read-only summary.</td></tr>
            <tr><td>Colour independence</td><td>The badge text names the tier &mdash; "At Risk", not just red. Keep it that way; the tier must never live in colour alone.</td></tr>
            <tr><td>Data alternative</td><td><strong>Worth improving:</strong> the trend itself is only available visually. Consider extending the chart's <code>aria-label</code> to describe the shape &mdash; "rises to a peak mid-morning, dips after lunch, recovers by close" &mdash; or offering the series as a table.</td></tr>
            <tr><td>Contrast</td><td>Light and dark themes each pair tested foreground and background. A custom <code>accent</code> bypasses that &mdash; verify it against both themes if the card appears in each.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <p class="ds-section-desc">The card resolves a theme-scoped accent and surface set on its root, so the light and dark treatments share one set of internal rules. The accent is overridable through the <code class="ds-code-inline">accent</code> option, which writes an inline CSS variable.</p>
    <table class="ds-table">
        <thead><tr><th>Token group</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td>Accent</td><td>Chart line, metric bar fills, and score emphasis. Theme-derived unless overridden.</td></tr>
            <tr><td>Surface and border</td><td>Card background and edge, swapped per theme</td></tr>
            <tr><td>Ink scale</td><td>Score, labels, metric values, and the muted header text</td></tr>
            <tr><td>Status colours</td><td>The five badge and status types &mdash; success, warning, danger, info, neutral</td></tr>
            <tr><td>Type scale</td><td>Display score, mono eyebrow, caption-size metric labels</td></tr>
        </tbody>
    </table>
    <p class="ds-section-desc">See the <code class="ds-code-inline">.ws-energy-arc</code> rules in <code class="ds-code-inline">components.css</code> for the exact declarations, and <a href="<?= $ds_base ?>/resources/tokens.php">Token Reference</a> for current values.</p>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-energy-arc</code></td><td>Root container</td></tr>
            <tr><td><code>.ws-energy-arc--dark</code></td><td>Dark theme. The light theme's modifier is emitted but has no rule &mdash; light is the base styling.</td></tr>
            <tr><td><code>.ws-energy-arc__card</code></td><td>Inner card surface</td></tr>
            <tr><td><code>.ws-energy-arc__header</code> / <code>__eyebrow</code></td><td>Top row, suppressed by <code>showHeader: false</code></td></tr>
            <tr><td><code>.ws-energy-arc__status</code> (+ <code>--success</code> / <code>--warning</code> / <code>--danger</code> / <code>--info</code>)</td><td>Header status chip</td></tr>
            <tr><td><code>.ws-energy-arc__score-row</code> / <code>__score</code> / <code>__score-value</code> / <code>__score-max</code></td><td>Score display</td></tr>
            <tr><td><code>.ws-energy-arc__badge</code> (+ type modifiers, plus <code>--note</code>)</td><td>Interpretive badge and its two variants</td></tr>
            <tr><td><code>.ws-energy-arc__chart</code> / <code>__axis</code></td><td>Sparkline and its tick labels</td></tr>
            <tr><td><code>.ws-energy-arc__metrics</code> / <code>__metric</code></td><td>The 2&times;2 grid and its cells</td></tr>
            <tr><td><code>.ws-energy-arc__metric-label</code> / <code>-value</code> / <code>-bar</code> / <code>-bar-fill</code></td><td>Metric internals</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_energy_arc_card()</code> helper function</td></tr>
            <tr><td><code>includes/components/energy-arc-card.php</code></td><td>Template &mdash; clamping, theme resolution, chart and metric markup</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-energy-arc</code> rules)</td></tr>
            <tr><td><code>includes/components/planner-inspector-rail.php</code></td><td>Wraps this card with <code>showHeader: false</code></td></tr>
        </tbody>
    </table>
</section>

<style>
.ds-ea-stage { display: flex; flex-wrap: wrap; gap: 24px; }
.ds-ea-stage--dark {
    background: var(--color-ink, #05070E);
    border-radius: var(--radius-2xl, 16px);
    padding: 24px;
}
</style>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
