<?php
$ds_page  = 'components/demos/stepper';
$ds_title = 'Stepper';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Stepper</h1>
    <p>A number input between a decrement and an increment button, for a value that is edited in fixed jumps but stays typeable.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            The value has a natural jump size and a bounded range &mdash; a duration in fives, a participant count, a number of rounds. The buttons make the common edit one click; the field keeps the uncommon one possible. It replaces the hand-rolled <code>app-contribute__stepper</code> and the planner's <code>duration-stepper</code>.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            Any number is as likely as any other, or the range is wide &mdash; a year, a price, a percentage. That is a plain <a href="<?= $ds_base ?>/components/demos/input.php">Input</a> of type number. For a handful of fixed choices use <a href="<?= $ds_base ?>/components/demos/select.php">Select</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Bare</h3>
        <p class="ds-section-desc">Without a label the input has no accessible name, so only use this form beside visible text in your own markup, and point <code class="ds-code-inline">attrs =&gt; ['aria-label' =&gt; …]</code> at it.</p>
        <div class="ds-card" style="max-width: 240px;">
            <?= ws_stepper('demo_bare', ['value' => 3, 'min' => 1, 'max' => 10, 'attrs' => ['aria-label' => 'Rounds']]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_stepper('rounds', ['value' => 3, 'min' => 1, 'max' => 10, 'attrs' => ['aria-label' => 'Rounds']]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With a label and a unit</h3>
        <p class="ds-section-desc">The preferred form. The label renders the <code class="ds-code-inline">ws-field</code> wrapper and binds to the input; the unit sits inside the row so the number reads as a quantity.</p>
        <div class="ds-card" style="max-width: 320px;">
            <?= ws_stepper('demo_duration', ['label' => 'Duration', 'value' => 30, 'min' => 5, 'max' => 480, 'step' => 5, 'unit' => 'min']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_stepper('duration', [
    'label' => 'Duration',
    'value' => 30,
    'min'   => 5,
    'max'   => 480,
    'step'  => 5,
    'unit'  => 'min',
]) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>Buttons on <code>--gray-100</code>, the number centred and semibold.</td></tr>
            <tr><td>Hover</td><td>A button takes the brand tint (<code>--brand-tint</code>) with <code>--brand-ink</code> ink.</td></tr>
            <tr><td>Focus</td><td>The real <code>&lt;input type="number"&gt;</code> keeps the platform focus ring; the buttons are real <code>&lt;button type="button"&gt;</code> elements and keep theirs.</td></tr>
            <tr><td>At a bound</td><td>Nothing visual: the page's handler clamps to <code>data-min</code> / <code>data-max</code>. Disable a button yourself if you want the bound to show.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The exercise contribution form. No component here ships JavaScript, so the page wires one delegated handler to the hooks the component renders &mdash; which is enough for every stepper on the page.</p>
    <div class="ds-card" style="max-width: 320px;">
        <?= ws_stepper('demo_real', ['label' => 'Duration', 'id' => 'demoDuration', 'value' => 30, 'min' => 5, 'max' => 480, 'step' => 5, 'unit' => 'min']) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_stepper('duration', ['label' => 'Duration', 'id' => 'ceDuration',
                        'value' => 30, 'min' => 5, 'max' => 480, 'step' => 5, 'unit' => 'min']) ?&gt;

&lt;script&gt;
document.addEventListener('click', function (event) {
    var btn = event.target.closest('[data-ws-stepper-dec], [data-ws-stepper-inc]');
    if (!btn) return;
    var box   = btn.closest('[data-ws-stepper]');
    var input = box.querySelector('input');
    var size  = parseInt(box.dataset.step, 10) || 1;
    var next  = (parseInt(input.value, 10) || 0) + (btn.hasAttribute('data-ws-stepper-dec') ? -size : size);
    var min = parseInt(box.dataset.min, 10), max = parseInt(box.dataset.max, 10);
    if (!isNaN(min)) next = Math.max(min, next);
    if (!isNaN(max)) next = Math.min(max, next);
    input.value = next;
    input.dispatchEvent(new Event('change', { bubbles: true }));
});
&lt;/script&gt;</pre></div>
    <script>
    document.addEventListener('click', function (event) {
        var btn = event.target.closest('[data-ws-stepper-dec], [data-ws-stepper-inc]');
        if (!btn) return;
        var box   = btn.closest('[data-ws-stepper]');
        var input = box.querySelector('input');
        var size  = parseInt(box.dataset.step, 10) || 1;
        var next  = (parseInt(input.value, 10) || 0) + (btn.hasAttribute('data-ws-stepper-dec') ? -size : size);
        var min = parseInt(box.dataset.min, 10), max = parseInt(box.dataset.max, 10);
        if (!isNaN(min)) next = Math.max(min, next);
        if (!isNaN(max)) next = Math.min(max, next);
        input.value = next;
    });
    </script>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>$name</code></td><td>string</td><td><code>''</code></td><td>Positional. The input's <code>name</code>.</td></tr>
            <tr><td><code>label</code></td><td>string</td><td><code>null</code></td><td>Field label. When set, the component renders the <code>ws-field</code> wrapper and binds the label to the input.</td></tr>
            <tr><td><code>value</code></td><td>int|string</td><td><code>0</code></td><td>Initial value</td></tr>
            <tr><td><code>min</code> / <code>max</code></td><td>int|string</td><td><code>null</code></td><td>Bounds. Applied to the input and exposed as <code>data-min</code> / <code>data-max</code> for the page's handler.</td></tr>
            <tr><td><code>step</code></td><td>int|string</td><td><code>1</code></td><td>Jump per click. Applied to the input and exposed as <code>data-step</code>.</td></tr>
            <tr><td><code>unit</code></td><td>string</td><td><code>null</code></td><td>Trailing unit text inside the row</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>'ws-stepper-' . uniqid()</code></td><td>Input ID. Set it when the page script needs a stable handle.</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes on the row</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra HTML attributes on the number input</td></tr>
            <tr><td><code>decreaseLabel</code> / <code>increaseLabel</code></td><td>string</td><td>"Decrease by 5 min"</td><td>aria-labels for the two buttons, derived from <code>step</code> and <code>unit</code> unless given</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Semantics</td><td>A real <code>&lt;input type="number"&gt;</code> with <code>min</code>, <code>max</code> and <code>step</code>, so the keyboard's arrow keys already step it before any script runs.</td></tr>
            <tr><td>Buttons</td><td>Real <code>&lt;button type="button"&gt;</code> elements via <a href="<?= $ds_base ?>/components/demos/icon-button.php">Icon Button</a>, each with an <code>aria-label</code> that names the jump ("Increase by 5 min"), not the icon.</td></tr>
            <tr><td>Labelling</td><td>Pass <code>label</code> and the input is named through a <code>&lt;label for&gt;</code>. Without it, name the input yourself through <code>attrs</code>.</td></tr>
            <tr><td>Hidden spinners</td><td>The native spin buttons are hidden with <code>appearance: textfield</code>. They were a second control at a second step size; the arrow keys still work.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--space-2</code></td><td>Gap between buttons, field and unit</td></tr>
            <tr><td><code>--gray-100</code></td><td>Button fill at rest</td></tr>
            <tr><td><code>--brand-tint</code> / <code>--brand-ink</code></td><td>Button fill and ink on hover</td></tr>
            <tr><td><code>--color-ink-secondary</code></td><td>Button ink at rest, and the unit</td></tr>
            <tr><td><code>--font-semibold</code></td><td>The number</td></tr>
            <tr><td><code>--text-caption</code></td><td>The unit</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-stepper</code></td><td>The row. Carries <code>data-ws-stepper</code>, <code>data-step</code>, <code>data-min</code>, <code>data-max</code>.</td></tr>
            <tr><td><code>.ws-stepper__btn</code></td><td>Either button. Carries <code>data-ws-stepper-dec</code> or <code>data-ws-stepper-inc</code>.</td></tr>
            <tr><td><code>.ws-stepper__field</code></td><td>The <code>ws_input</code> wrapper, flattened into one cell of the row</td></tr>
            <tr><td><code>.ws-stepper__unit</code></td><td>The unit text</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_stepper()</code> helper function</td></tr>
            <tr><td><code>includes/components/stepper.php</code></td><td>Template &mdash; the row, the two icon buttons and the input</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-stepper</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
