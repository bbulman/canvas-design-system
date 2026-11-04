<?php
$ds_page  = 'components/demos/pill';
$ds_title = 'Pill';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Pill</h1>
    <p>A read-only tag for descriptive metadata &mdash; difficulty, topic, format, phase.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            You're tagging content with a descriptive attribute that the reader scans &mdash; "Beginner", "Remote-friendly", "Design". It replaces the hand-rolled <code>.detail-pill</code> and <code>.ae-difficulty-pill</code> classes that grew across the apps.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The tag can be removed or clicked &mdash; use a <a href="<?= $ds_base ?>/components/demos/chip-input.php">Chip Input</a> chip or a <a href="<?= $ds_base ?>/components/demos/button.php">Button</a>. For a measurement or status use <a href="<?= $ds_base ?>/components/demos/badge.php">Badge</a>; for an agenda item's type use <a href="<?= $ds_base ?>/components/demos/activity-badge.php">Activity Badge</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Style</h3>
        <p class="ds-section-desc">Three weights of the same tag. <code class="ds-code-inline">tint</code> is the default and the right choice nearly always; <code class="ds-code-inline">solid</code> is for a single pill that must stand out; <code class="ds-code-inline">ghost</code> is for dense rows where fills would overwhelm.</p>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
            <?= ws_pill('Tint (default)', ['variant' => 'tint', 'color' => 'learn']) ?>
            <?= ws_pill('Solid', ['variant' => 'solid', 'color' => 'learn']) ?>
            <?= ws_pill('Ghost', ['variant' => 'ghost', 'color' => 'learn']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_pill('Tint (default)', ['variant' => 'tint', 'color' => 'learn']) ?&gt;
&lt;?= ws_pill('Solid', ['variant' => 'solid', 'color' => 'learn']) ?&gt;
&lt;?= ws_pill('Ghost', ['variant' => 'ghost', 'color' => 'learn']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Colour</h3>
        <p class="ds-section-desc">Five colour keys. Since Red Unification the four phase keys all resolve to the same red, so in practice the meaningful distinction is <strong>phase versus neutral</strong> &mdash; the four below are identical by design, not by accident. Keep passing the semantically correct phase so the markup stays truthful if the palette ever diverges again.</p>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
            <?= ws_pill('Learn', ['color' => 'learn']) ?>
            <?= ws_pill('Plan', ['color' => 'plan']) ?>
            <?= ws_pill('Facilitate', ['color' => 'facilitate']) ?>
            <?= ws_pill('Reflect', ['color' => 'reflect']) ?>
            <?= ws_pill('Neutral', ['color' => 'neutral']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_pill('Learn', ['color' => 'learn']) ?&gt;
&lt;?= ws_pill('Neutral', ['color' => 'neutral']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Sizes and icons</h3>
        <p class="ds-section-desc">Two sizes. An optional leading icon helps when several pills of different kinds sit in one row.</p>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
            <?= ws_pill('Small', ['size' => 'sm', 'color' => 'plan']) ?>
            <?= ws_pill('Medium', ['size' => 'md', 'color' => 'plan']) ?>
            <?= ws_pill('Design', ['icon' => 'palette', 'color' => 'facilitate']) ?>
            <?= ws_pill('Beginner', ['icon' => 'school', 'variant' => 'tint', 'color' => 'reflect']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_pill('Small', ['size' => 'sm', 'color' => 'plan']) ?&gt;
&lt;?= ws_pill('Design', ['icon' => 'palette', 'color' => 'facilitate']) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>The only state. Pills are static <code>&lt;span&gt;</code>s with no hover, focus, active, selected, or disabled treatment.</td></tr>
            <tr><td>Unknown colour key</td><td>Emits <code>.ws-pill--{key}</code>, which matches no rule &mdash; the pill renders with base styling only. Stick to the five documented keys.</td></tr>
            <tr><td>Long text</td><td>Pills don't truncate. A long label stretches the pill and can wrap, so keep to one or two words.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">An exercise detail header: difficulty and format as pills, with the measurable facts left to Badge. The split is the useful rule &mdash; pills describe, badges measure.</p>
    <div class="ds-card" style="max-width: 460px;">
        <div style="font-weight: 600; margin-bottom: 10px;">Assumption Mapping</div>
        <div style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
            <?= ws_pill('Beginner', ['icon' => 'school', 'color' => 'learn', 'size' => 'sm']) ?>
            <?= ws_pill('Remote-friendly', ['icon' => 'videocam', 'color' => 'neutral', 'size' => 'sm']) ?>
            <?= ws_duration('30 min') ?>
        </div>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_pill($ex['difficulty'], ['icon' => 'school', 'color' => 'learn', 'size' => 'sm']) ?&gt;
&lt;?php if ($ex['remote_friendly']): ?&gt;
    &lt;?= ws_pill('Remote-friendly', ['icon' => 'videocam', 'color' => 'neutral', 'size' => 'sm']) ?&gt;
&lt;?php endif; ?&gt;
&lt;?= ws_duration($ex['duration'] . ' min') ?&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>$text</code></td><td>string</td><td><code>''</code></td><td>Positional label. One or two words.</td></tr>
            <tr><td><code>variant</code></td><td>string</td><td><code>'tint'</code></td><td><code>solid</code> | <code>ghost</code> | <code>tint</code></td></tr>
            <tr><td><code>color</code></td><td>string</td><td><code>'neutral'</code></td><td><code>learn</code> | <code>plan</code> | <code>facilitate</code> | <code>reflect</code> | <code>neutral</code></td></tr>
            <tr><td><code>size</code></td><td>string</td><td><code>'md'</code></td><td><code>sm</code> | <code>md</code></td></tr>
            <tr><td><code>icon</code></td><td>string</td><td><code>null</code></td><td>Optional leading Material Symbols icon</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra HTML attributes as key/value pairs</td></tr>
        </tbody>
    </table>
    <p class="ds-section-desc">Note there's no <code class="ds-code-inline">id</code> option &mdash; unlike most components in the set. Pass one through <code class="ds-code-inline">attrs</code> if you need it.</p>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>ARIA</td><td>None applied, and none needed &mdash; the pill is text in a <code>&lt;span&gt;</code>, read in document order alongside whatever it labels.</td></tr>
            <tr><td>Keyboard</td><td>Not focusable. If a pill ever needs to filter or toggle, it's the wrong component.</td></tr>
            <tr><td>Colour independence</td><td>The label always carries the meaning. Since every phase colour now renders the same red, colour conveys almost nothing on its own &mdash; which makes the text mandatory, not optional.</td></tr>
            <tr><td>Icons</td><td>Decorative and unlabelled. Never ship an icon-only pill; there'd be no accessible text at all.</td></tr>
            <tr><td>Contrast</td><td>Each variant/colour pair uses tested tokens. The <code>ghost</code> variant is the lightest &mdash; check it against any non-standard background before using it there.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--brand</code> / <code>--brand-soft</code></td><td>Learn colour key, solid and tint fills</td></tr>
            <tr><td><code>--brand</code> / <code>--phase-plan-light</code></td><td>Plan colour key</td></tr>
            <tr><td><code>--phase-facilitate</code> / <code>--phase-facilitate-light</code></td><td>Facilitate colour key</td></tr>
            <tr><td><code>--phase-reflect</code> / <code>--phase-reflect-light</code></td><td>Reflect colour key</td></tr>
            <tr><td><code>--gray-100</code></td><td>Neutral tint fill</td></tr>
            <tr><td><code>--color-ink</code> / <code>--color-ink-secondary</code></td><td>Label colour on tint and ghost</td></tr>
            <tr><td><code>--color-border-dark</code></td><td>Ghost variant border</td></tr>
            <tr><td><code>--radius-full</code></td><td>The pill shape itself</td></tr>
            <tr><td><code>--text-caption</code> / <code>--text-micro</code></td><td>Label size at <code>md</code> and <code>sm</code></td></tr>
            <tr><td><code>--font-body</code> / <code>--font-semibold</code></td><td>Face and weight</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-pill</code></td><td>Base styles and the full radius</td></tr>
            <tr><td><code>.ws-pill--tint</code></td><td>Tinted fill (default)</td></tr>
            <tr><td><code>.ws-pill--solid</code></td><td>Solid fill with inverse text</td></tr>
            <tr><td><code>.ws-pill--ghost</code></td><td>Outline only</td></tr>
            <tr><td><code>.ws-pill--learn / --plan / --facilitate / --reflect</code></td><td>Phase colour keys</td></tr>
            <tr><td><code>.ws-pill--neutral</code></td><td>Neutral grey key</td></tr>
            <tr><td><code>.ws-pill--sm / --md</code></td><td>Size modifiers</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_pill()</code> helper function</td></tr>
            <tr><td><code>includes/components/pill.php</code></td><td>Template &mdash; variant and colour class assembly</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-pill</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
