<?php
$ds_page  = 'components/demos/session-shape';
$ds_title = 'Session Shape';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';

$demoParts = [
    ['name' => 'Check-in', 'minutes' => 10, 'kind' => 'frame', 'energy' => 2, 'href' => '#'],
    ['name' => 'Reverse Brainstorming', 'minutes' => 25, 'energy' => 4, 'href' => '#'],
    ['name' => 'TRIZ', 'minutes' => 20, 'energy' => 4, 'href' => '#'],
    ['name' => '15% Solutions', 'minutes' => 20, 'energy' => 3, 'href' => '#'],
    ['name' => 'Commit: who does what by when', 'minutes' => 15, 'kind' => 'frame', 'energy' => 1, 'href' => '#'],
];
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Session Shape</h1>
    <p>A short session at a glance: an energy line over a time bar, on one horizontal scale. Each block is as wide as its minutes; the line over it is how lively that part runs.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            A session should be read at a glance before its steps: a recipe page shows one above its exercise tiles. Give each part an <code>href</code> to its step further down.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The reader needs start times (an <a href="<?= $ds_base ?>/components/demos/agenda.php">Agenda</a>), a workshop is being graded with a score and metrics (an <a href="<?= $ds_base ?>/components/demos/energy-arc-card.php">Energy Arc Card</a>), or there is one proportion to show (a <a href="<?= $ds_base ?>/components/demos/progress.php">Progress</a> bar).
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">A 90-minute recipe</h3>
        <p class="ds-section-desc">Opening and closing are grey, exercises the soft brand fill. Below 600px the names give way to the minutes, and each block keeps its spoken name.</p>
        <div class="ds-card">
            <?= ws_session_shape($demoParts) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_session_shape([
    ['name' =&gt; 'Check-in', 'minutes' =&gt; 10, 'kind' =&gt; 'frame', 'energy' =&gt; 2, 'href' =&gt; '#recipe-step-1'],
    ['name' =&gt; 'Reverse Brainstorming', 'minutes' =&gt; 25, 'energy' =&gt; 4, 'href' =&gt; '#recipe-step-2'],
    ['name' =&gt; 'TRIZ', 'minutes' =&gt; 20, 'energy' =&gt; 4, 'href' =&gt; '#recipe-step-3'],
    ['name' =&gt; '15% Solutions', 'minutes' =&gt; 20, 'energy' =&gt; 3, 'href' =&gt; '#recipe-step-4'],
    ['name' =&gt; 'Commit: who does what by when', 'minutes' =&gt; 15, 'kind' =&gt; 'frame', 'energy' =&gt; 1, 'href' =&gt; '#recipe-step-5'],
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With a control under the time bar</h3>
        <p class="ds-section-desc">A control that reshapes the session sits as its own row, on the time bar's scale, with an axis word beside it. The control names itself; the axis word is hidden from assistive technology.</p>
        <div class="ds-card">
            <?= ws_session_shape($demoParts, [
                'control' => ws_range('demo_length', ['label' => 'Length', 'hideLabel' => true, 'min' => 60, 'max' => 90, 'step' => 30, 'value' => 90, 'valueText' => '90 minutes', 'id' => 'demo-length']),
                'controlLabel' => 'Length',
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_session_shape($parts, [
    'control' =&gt; ws_range('length', ['label' =&gt; 'Length', 'hideLabel' =&gt; true, 'min' =&gt; 60, 'max' =&gt; 90, 'step' =&gt; 30, 'value' =&gt; 90, 'valueText' =&gt; '90 minutes']),
    'controlLabel' =&gt; 'Length',
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">The time bar alone</h3>
        <p class="ds-section-desc">With <code>showEnergy</code> false the energy line goes and the time bar stands on its own, for when only the minutes matter. A recipe page draws it this way, with its length and setting switches above the card.</p>
        <div class="ds-card">
            <?= ws_session_shape($demoParts, ['showEnergy' => false]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_session_shape($parts, ['showEnergy' =&gt; false]) ?&gt;</pre></div>
    </div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>$parts</code></td><td>array</td><td>required</td><td>Each part: <code>name</code>, <code>minutes</code>, <code>kind</code> (<code>frame</code> or <code>exercise</code>), <code>energy</code> (1 to 5, default 3), <code>href</code></td></tr>
            <tr><td><code>label</code></td><td>string</td><td><code>'Shape of the session'</code></td><td>The group's accessible name</td></tr>
            <tr><td><code>showEnergy</code></td><td>bool</td><td><code>true</code></td><td>Draw the energy line over the time bar; <code>false</code> leaves the time bar on its own</td></tr>
            <tr><td><code>control</code></td><td>string</td><td><code>''</code></td><td>Rendered HTML for a row under the time bar, on its scale: a <code>ws_range</code> that reshapes the session</td></tr>
            <tr><td><code>controlLabel</code></td><td>string</td><td><code>''</code></td><td>The control row's axis word, beside it like "Time"</td></tr>
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
            <tr><td>Group</td><td>A group named by <code>label</code>.</td></tr>
            <tr><td>Energy line</td><td>An image named in words: "Energy starts low at Check-in, peaks during Reverse Brainstorming and ends low at Commit".</td></tr>
            <tr><td>Time bar</td><td>An ordered list, each block named "Check-in, 10 minutes", so the shortened names and the "10m" are never all a screen reader hears. A part with <code>href</code> is a link with a focus ring.</td></tr>
            <tr><td>Colour</td><td>Opening and closing differ from exercises in fill and in the legend's words, never by colour alone.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--brand</code></td><td>The energy line</td></tr>
            <tr><td><code>--brand-soft</code>, <code>--brand-ink</code></td><td>Exercise blocks</td></tr>
            <tr><td><code>--gray-100</code>, <code>--text-default</code></td><td>Opening and closing blocks</td></tr>
            <tr><td><code>--text-micro</code>, <code>--text-caption</code>, <code>--text-muted</code></td><td>The axis labels, block text and legend</td></tr>
            <tr><td><code>--focus-ring</code></td><td>A linked block's focus ring</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-session-shape</code></td><td>The group</td></tr>
            <tr><td><code>.ws-session-shape__energy</code></td><td>The line, an SVG</td></tr>
            <tr><td><code>.ws-session-shape__time</code></td><td>The time bar, an ordered list</td></tr>
            <tr><td><code>.ws-session-shape__block--frame</code> / <code>--exercise</code></td><td>A block's kind</td></tr>
            <tr><td><code>.ws-session-shape__block--m5</code> to <code>--m120</code></td><td>A block's width, its minutes rounded to 5</td></tr>
            <tr><td><code>.ws-session-shape__legend</code></td><td>The key</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_session_shape()</code></td></tr>
            <tr><td><code>includes/components/session-shape.php</code></td><td>Template: the line, the bar and the legend</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-session-shape</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
