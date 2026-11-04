<?php
$ds_page  = 'components/demos/activity-badge';
$ds_title = 'Activity Badge';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Activity Badge</h1>
    <p>Labels an agenda item with its activity type: the Planner's colours on the canvas, the sanctioned exercise and icebreaker tokens everywhere else.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            You're labelling something as an exercise, icebreaker, break, or custom item &mdash; on planner cards, agenda rows, library listings, or search results. It replaces the older hand-rolled <code>.item-type-badge</code> and <code>.type-badge</code> markup.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The label isn't an activity type. For duration, category, or status use <a href="<?= $ds_base ?>/components/demos/badge.php">Badge</a>; for a free-text tag use <a href="<?= $ds_base ?>/components/demos/pill.php">Pill</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Types</h3>
        <p class="ds-section-desc">Four types. Inside the Planner each takes its <code class="ds-code-inline">--planner-*</code> colour, so items stay distinguishable on the canvas. Everywhere else exercise and icebreaker take the sanctioned activity-type tokens (<code class="ds-code-inline">--exercise-very-light</code>, <code class="ds-code-inline">--icebreaker-very-light</code>) with the text colour each was measured against, and break and custom are neutral grey. Both are the documented exception to Red Unification, so don't re-theme them.</p>
        <div class="ds-card" style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
            <?= ws_activity_badge('exercise') ?>
            <?= ws_activity_badge('icebreaker') ?>
            <?= ws_activity_badge('break') ?>
            <?= ws_activity_badge('custom') ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_activity_badge('exercise') ?&gt;
&lt;?= ws_activity_badge('icebreaker') ?&gt;
&lt;?= ws_activity_badge('break') ?&gt;
&lt;?= ws_activity_badge('custom') ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Sizes</h3>
        <p class="ds-section-desc">Use <code class="ds-code-inline">sm</code> inside compact library cards, <code class="ds-code-inline">md</code> on the timeline canvas.</p>
        <div class="ds-card" style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
            <?= ws_activity_badge('exercise', ['size' => 'sm']) ?>
            <?= ws_activity_badge('icebreaker', ['size' => 'sm']) ?>
            <?= ws_activity_badge('break', ['size' => 'sm']) ?>
            <?= ws_activity_badge('custom', ['size' => 'sm']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_activity_badge('exercise', ['size' => 'sm']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Custom text</h3>
        <p class="ds-section-desc">The label defaults to the capitalised type. Override it when the domain has a more precise word &mdash; but keep the type argument accurate, because that's what drives the colour.</p>
        <div class="ds-card" style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
            <?= ws_activity_badge('exercise', ['text' => 'Design Exercise']) ?>
            <?= ws_activity_badge('icebreaker', ['text' => 'Energizer']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_activity_badge('exercise', ['text' => 'Design Exercise']) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>The only state. The badge is a static <code>&lt;span&gt;</code> with no hover, focus, active, or disabled treatment.</td></tr>
            <tr><td>Unknown type</td><td>An unrecognised type still emits <code>.ws-activity-badge--{type}</code>, which matches no rule, so the badge has no fill and inherits its text colour. Validate the type upstream.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">On a library card the badge sits in the meta row beside the duration &mdash; small size, default text, so the type reads at a glance while scanning the palette.</p>
    <div class="ds-card" style="max-width: 380px;">
        <div style="font-weight: 600; margin-bottom: 8px;">Crazy 8s</div>
        <div style="display: flex; gap: 8px; align-items: center;">
            <?= ws_activity_badge('exercise', ['size' => 'sm']) ?>
            <?= ws_duration('8 min') ?>
        </div>
    </div>
    <div class="ds-code"><pre>&lt;div class="meta-row"&gt;
    &lt;?= ws_activity_badge($item['item_type'], ['size' => 'sm']) ?&gt;
    &lt;?= ws_duration($item['duration'] . ' min') ?&gt;
&lt;/div&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>$type</code></td><td>string</td><td><code>'exercise'</code></td><td>Positional. <code>exercise</code> | <code>icebreaker</code> | <code>break</code> | <code>custom</code>. Drives both the colour and the default label.</td></tr>
            <tr><td><code>text</code></td><td>string</td><td><code>ucfirst($type)</code></td><td>Overrides the displayed label without changing the colour</td></tr>
            <tr><td><code>size</code></td><td>string</td><td><code>'md'</code></td><td><code>sm</code> | <code>md</code>. Only <code>sm</code> emits a modifier class.</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>null</code></td><td>Element ID</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>ARIA</td><td>None applied &mdash; and none needed. The badge is plain text in a <code>&lt;span&gt;</code>, so the type is read out as written rather than inferred from colour.</td></tr>
            <tr><td>Keyboard</td><td>Not focusable and not interactive. Nothing enters the tab order.</td></tr>
            <tr><td>Colour independence</td><td>This is the component's main accessibility property: the type is always spelled out in the label, so colour is reinforcement, never the sole carrier. Don't blank the text and rely on the swatch.</td></tr>
            <tr><td>Contrast</td><td>Outside the Planner every pair passes AA: exercise <code>--color-info-strong</code> on <code>--exercise-very-light</code> (7.23:1), icebreaker <code>--color-success-ink</code> on <code>--icebreaker-very-light</code> (6.42:1), break <code>--gray-600</code> on <code>--gray-100</code> (6.99:1), custom <code>--gray-700</code> on <code>--gray-200</code> (8.18:1). Inside it each type pairs a <code>--planner-*-bg</code> tint with its <code>--planner-*-color</code>. Override one and you break the tested pair.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--planner-exercise-bg</code> / <code>--planner-exercise-color</code></td><td>Exercise tint and text inside the Planner (blue)</td></tr>
            <tr><td><code>--planner-icebreaker-bg</code> / <code>--planner-icebreaker-color</code></td><td>Icebreaker tint and text inside the Planner (green)</td></tr>
            <tr><td><code>--planner-break-bg</code> / <code>--planner-break-color</code></td><td>Break tint and text inside the Planner (grey)</td></tr>
            <tr><td><code>--planner-custom-bg</code> / <code>--planner-custom-color</code></td><td>Custom tint and text inside the Planner (purple)</td></tr>
            <tr><td><code>--exercise-very-light</code> / <code>--color-info-strong</code></td><td>Exercise fill and text everywhere else</td></tr>
            <tr><td><code>--icebreaker-very-light</code> / <code>--color-success-ink</code></td><td>Icebreaker fill and text everywhere else</td></tr>
            <tr><td><code>--gray-100</code> / <code>--gray-600</code></td><td>Break fill and text everywhere else</td></tr>
            <tr><td><code>--gray-200</code> / <code>--gray-700</code></td><td>Custom fill and text everywhere else</td></tr>
            <tr><td><code>--text-caption</code> / <code>--text-micro</code></td><td>Label size at <code>md</code> and <code>sm</code></td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">info</span>
        <span>The activity-type colours are the documented exception to Red Unification: see <a href="<?= $ds_base ?>/foundations/colors.php">Colors</a>. Every other badge on the platform is red-family.</span>
    </div>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-activity-badge</code></td><td>Base badge</td></tr>
            <tr><td><code>.ws-activity-badge--exercise</code></td><td>Exercise type colours</td></tr>
            <tr><td><code>.ws-activity-badge--icebreaker</code></td><td>Icebreaker type colours</td></tr>
            <tr><td><code>.ws-activity-badge--break</code></td><td>Break type colours</td></tr>
            <tr><td><code>.ws-activity-badge--custom</code></td><td>Custom type colours</td></tr>
            <tr><td><code>.ws-activity-badge--sm</code></td><td>Small size (<code>md</code> is the default and emits nothing)</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_activity_badge()</code> helper function</td></tr>
            <tr><td><code>includes/components/activity-badge.php</code></td><td>Template &mdash; type-to-class mapping</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-activity-badge</code> rules)</td></tr>
            <tr><td><code>css/planner/base/_variables.css</code></td><td>Source of the <code>--planner-*</code> activity colours, which win inside the Planner</td></tr>
            <tr><td><code>design-system/platform-tokens.css</code></td><td>Source of the <code>--exercise-*</code> and <code>--icebreaker-*</code> tokens used everywhere else</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
