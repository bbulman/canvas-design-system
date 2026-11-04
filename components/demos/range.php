<?php
$ds_page  = 'components/demos/range';
$ds_title = 'Range';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">
<style>
    /* Demo only: a two-pane figure whose divider the page draws, to show the bare variant. */
    .ds-range-split {
        --split: 50;
        position: relative;
        display: grid;
        grid-template-columns: calc(var(--split) * 1%) 1fr;
        min-height: 160px;
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-lg);
        overflow: hidden;
    }
    .ds-range-narrow { max-width: 420px; }
    .ds-range-split__pane { padding: var(--space-4); }
    .ds-range-split__pane--a { background: var(--bg-paper); color: var(--text-muted); }
    .ds-range-split__pane--b { background: var(--bg-surface); color: var(--text-dark); border-left: 2px solid var(--gray-300); }
    .ds-range-split__grip {
        position: absolute;
        top: 50%;
        left: calc(var(--split) * 1%);
        width: 44px;
        height: 44px;
        margin: -22px 0 0 -22px;
        border-radius: var(--radius-full);
        background: var(--bg-surface);
        border: 1px solid var(--gray-300);
        box-shadow: var(--shadow-sm);
        pointer-events: none;
    }
    /* The input spans the travel plus half a thumb each side, so the thumb's centre lands on the divider,
       and is one thumb tall, centred on the grip. */
    .ds-range-split .ws-range {
        position: absolute;
        top: 50%;
        left: -22px;
        right: -22px;
        margin-top: -22px;
        z-index: 1;
    }
</style>

<div class="ds-page-header">
    <h1>Range</h1>
    <p>A slider for a value picked by feel along a continuous scale, built on the native range input.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            The reader is choosing roughly how much, and seeing the effect matters more than the number: a break length, a mix between two things, how much of a figure each side takes. The bare variant is for a handle the page draws itself, such as a divider between two panes.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The exact value matters or will be typed: use <a href="<?= $ds_base ?>/components/demos/input.php">Input</a> with <code>type="number"</code>, or <a href="<?= $ds_base ?>/components/demos/stepper.php">Stepper</a> for fixed jumps the reader counts. For a handful of named choices use <a href="<?= $ds_base ?>/components/demos/select.php">Select</a> or <a href="<?= $ds_base ?>/components/demos/radio-card-group.php">Radio Card Group</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Default</h3>
        <p class="ds-section-desc">The browser's own slider, tinted with <code class="ds-code-inline">--brand</code> through <code class="ds-code-inline">accent-color</code>. No script is needed for it to work. Pass <code class="ds-code-inline">valueText</code> so a screen reader hears what the value means, and update <code class="ds-code-inline">aria-valuetext</code> as it moves.</p>
        <div class="ds-card ds-range-narrow">
            <?= ws_range('demo_break', ['label' => 'Break length', 'min' => 5, 'max' => 30, 'step' => 5, 'value' => 15, 'valueText' => '15 minutes', 'description' => '15 minutes', 'id' => 'demo-break', 'attrs' => ['data-unit' => 'minutes']]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_range('break_length', [
    'label'     =&gt; 'Break length',
    'min'       =&gt; 5,
    'max'       =&gt; 30,
    'step'      =&gt; 5,
    'value'     =&gt; 15,
    'valueText' =&gt; '15 minutes',
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Bare</h3>
        <p class="ds-section-desc">The track and thumb go transparent and the page draws the handle underneath. The input stays real: focusable, labelled (here with <code class="ds-code-inline">hideLabel</code>), and moved with the arrow keys. The focus ring goes round the thumb, where the drawn handle is. The input is one thumb tall (<code class="ds-code-inline">--ws-range-thumb</code>, 44px by default), so position its wrapper centred on the handle and spanning the travel plus half a thumb each side.</p>
        <div class="ds-card">
            <div class="ds-range-split" id="demo-split">
                <div class="ds-range-split__pane ds-range-split__pane--a">Before</div>
                <div class="ds-range-split__pane ds-range-split__pane--b">After</div>
                <span class="ds-range-split__grip" aria-hidden="true"></span>
                <?= ws_range('demo_split', ['label' => 'Move the divider between before and after', 'hideLabel' => true, 'min' => 20, 'max' => 80, 'step' => 2, 'value' => 50, 'valueText' => 'Before 50%, After 50%', 'variant' => 'bare', 'id' => 'demo-split-range']) ?>
            </div>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_range('split', [
    'label'     =&gt; 'Move the divider between before and after',
    'hideLabel' =&gt; true,
    'min'       =&gt; 20,
    'max'       =&gt; 80,
    'value'     =&gt; 50,
    'valueText' =&gt; 'Before 50%, After 50%',
    'variant'   =&gt; 'bare',
]) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <div class="ds-card ds-range-narrow">
        <?= ws_range('demo_locked', ['label' => 'Room size', 'min' => 2, 'max' => 40, 'value' => 12, 'valueText' => '12 people', 'disabled' => true, 'description' => 'Set by the session you joined']) ?>
    </div>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>The browser paints the track and thumb; <code>accent-color</code> fills the travelled part with the brand colour.</td></tr>
            <tr><td>Hover</td><td>Pointer cursor on the default variant, <code>ew-resize</code> on the bare one. The bare variant's drawn handle can react with <code>:has(.ws-range__input:hover)</code>.</td></tr>
            <tr><td>Focus</td><td>The platform focus ring (<code>--focus-ring</code>) round the input on the default variant, and round the thumb on the bare one.</td></tr>
            <tr><td>Disabled</td><td>Native <code>disabled</code> plus <code>.ws-range--disabled</code>, which dims the whole field. Skipped by <kbd>Tab</kbd>.</td></tr>
        </tbody>
    </table>
    <div class="ds-code"><pre>&lt;?= ws_range('room_size', ['label' =&gt; 'Room size', 'value' =&gt; 12, 'disabled' =&gt; true]) ?&gt;</pre></div>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The homepage candidate at <code>/index4.php</code> uses the bare variant for its hinge: the page draws a divider and a grip between how a workshop lives now and how it lives in Workshopr, and the range sits over the grip so a reader can drag it or move it with the arrow keys. The page's script listens for <code>input</code>, moves the split and rewrites <code>aria-valuetext</code>:</p>
    <div class="ds-code"><pre>const range = document.querySelector('#i4-split');
range.addEventListener('input', () =&gt; {
    const now = Number(range.value);
    figure.style.setProperty('--i4-split', now);
    range.setAttribute('aria-valuetext', `How it lives now ${now}%, In Workshopr ${100 - now}%`);
});</pre></div>
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
            <tr><td><code>label</code></td><td>string</td><td><code>null</code></td><td>A real <code>&lt;label for&gt;</code>. Always pass one: a range with no name is announced only as "slider".</td></tr>
            <tr><td><code>hideLabel</code></td><td>bool</td><td><code>false</code></td><td>Hides the label visually (<code>.ws-visually-hidden</code>) while it still names the input. For when the page shows the meaning another way.</td></tr>
            <tr><td><code>description</code></td><td>string</td><td><code>null</code></td><td>Sub-text under the slider, wired as <code>aria-describedby</code>.</td></tr>
            <tr><td><code>min</code> / <code>max</code></td><td>int|float</td><td><code>0</code> / <code>100</code></td><td>The ends of the scale.</td></tr>
            <tr><td><code>step</code></td><td>int|float</td><td><code>1</code></td><td>Distance between values, and how far one arrow key moves it.</td></tr>
            <tr><td><code>value</code></td><td>int|float</td><td>halfway</td><td>The starting value.</td></tr>
            <tr><td><code>valueText</code></td><td>string</td><td><code>null</code></td><td>What the starting value means, as <code>aria-valuetext</code> ("15 minutes"). Update it from script as the value moves.</td></tr>
            <tr><td><code>variant</code></td><td>string</td><td><code>'default'</code></td><td><code>default</code> or <code>bare</code>.</td></tr>
            <tr><td><code>disabled</code></td><td>bool</td><td><code>false</code></td><td>Native disabled state plus the dimmed wrapper class.</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>'ws-range-' . uniqid()</code></td><td>Input ID. Set it when script needs a stable handle.</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional classes on the wrapper, which is what a page positions.</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra attributes on the input, for <code>data-*</code> hooks.</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Semantics</td><td>A native <code>&lt;input type="range"&gt;</code>, so the slider role, value, min and max come from the browser. Both variants keep it; the bare one only makes its paint transparent.</td></tr>
            <tr><td>Keyboard</td><td>Native: <kbd>Tab</kbd> to reach, arrow keys move one step, <kbd>Page Up</kbd>/<kbd>Page Down</kbd> move further, <kbd>Home</kbd>/<kbd>End</kbd> jump to the ends.</td></tr>
            <tr><td>Labelling</td><td>A <code>&lt;label for&gt;</code>, visually hidden with <code>hideLabel</code> and never removed. The description is announced after it through <code>aria-describedby</code>.</td></tr>
            <tr><td>Value</td><td>Without <code>aria-valuetext</code> a screen reader reads the bare number. Pass <code>valueText</code> and keep it current from script so it hears "15 minutes" or "Before 40%, After 60%".</td></tr>
            <tr><td>Target size</td><td>The default variant's box is 44px tall. The bare variant's thumb is 44px square unless the page sets <code>--ws-range-thumb</code>; keep it at 44px or more.</td></tr>
            <tr><td>Forced colours</td><td>The bare variant's input keeps a transparent outline rather than none, so Windows High Contrast repaints a visible ring.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--brand</code></td><td><code>accent-color</code> on the default variant</td></tr>
            <tr><td><code>--focus-ring</code> / <code>--focus-ring-offset</code></td><td>Focus ring round the default variant</td></tr>
            <tr><td><code>--focus-ring-width</code> / <code>--focus-ring-color</code> / <code>--focus-ring-halo</code></td><td>Focus ring and halo round the bare variant's thumb</td></tr>
            <tr><td><code>--text-small</code> / <code>--text-muted</code></td><td>Description</td></tr>
            <tr><td><code>--space-2</code></td><td>Gap between label, slider and description</td></tr>
            <tr><td><code>--radius-full</code></td><td>Bare thumb shape</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-range</code></td><td>Field wrapper: label, slider, description</td></tr>
            <tr><td><code>.ws-range--bare</code></td><td>Transparent track and thumb for a page-drawn handle; sets <code>--ws-range-thumb</code></td></tr>
            <tr><td><code>.ws-range--disabled</code></td><td>Dimmed disabled field</td></tr>
            <tr><td><code>.ws-range__label</code></td><td>The label (also carries <code>.ws-field__label</code>)</td></tr>
            <tr><td><code>.ws-range__input</code></td><td>The range input</td></tr>
            <tr><td><code>.ws-range__description</code></td><td>Sub-text</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_range()</code> helper function</td></tr>
            <tr><td><code>includes/components/range.php</code></td><td>Template: label, input and description wiring</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-range</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<script>
    // Demo only: keep aria-valuetext and the visible readout current.
    (function () {
        var brk = document.getElementById('demo-break');
        if (brk) {
            var desc = document.getElementById('demo-break-desc');
            brk.addEventListener('input', function () {
                var text = brk.value + ' ' + brk.dataset.unit;
                brk.setAttribute('aria-valuetext', text);
                if (desc) desc.textContent = text;
            });
        }
        var split = document.getElementById('demo-split-range');
        var fig = document.getElementById('demo-split');
        if (split && fig) {
            split.addEventListener('input', function () {
                var a = Number(split.value);
                fig.style.setProperty('--split', a);
                split.setAttribute('aria-valuetext', 'Before ' + a + '%, After ' + (100 - a) + '%');
            });
        }
    })();
</script>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
