<?php
$ds_page  = 'components/demos/toggle';
$ds_title = 'Toggle';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Toggle</h1>
    <p>A switch for a setting with two states that takes effect the moment it's flipped.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            The setting is on or off and applies immediately &mdash; notification preferences, profile visibility, feature opt-ins. It replaces the hand-rolled <code>toggle-*</code> and <code>launchpad-toggle-*</code> markup with one accessible checkbox-based switch.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The change only lands on submit &mdash; that's a checkbox, and a switch that silently doesn't save is a trust bug. For more than two options use <a href="<?= $ds_base ?>/components/demos/radio-card-group.php">Radio Card Group</a> or <a href="<?= $ds_base ?>/components/demos/select.php">Select</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Bare switch</h3>
        <p class="ds-section-desc">Without a label the switch has no accessible name, so only use this form when a visible label sits beside it in your own markup &mdash; a settings row where the left column names the setting.</p>
        <div class="ds-card" style="display: flex; flex-direction: column; gap: 16px;">
            <?= ws_toggle('demo_off') ?>
            <?= ws_toggle('demo_on', ['checked' => true]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_toggle('demo_off') ?&gt;
&lt;?= ws_toggle('demo_on', ['checked' => true]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With a label</h3>
        <p class="ds-section-desc">The preferred form. The label becomes the switch's accessible name and its click target, so the hit area covers the text as well as the switch.</p>
        <div class="ds-card" style="display: flex; flex-direction: column; gap: 16px;">
            <?= ws_toggle('digest_only', ['checked' => true, 'label' => 'Subscribe to digest']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_toggle('digest', ['label' => 'Subscribe to digest', 'checked' => true]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With a description</h3>
        <p class="ds-section-desc">Add a description when the consequence isn't obvious from the label. It's wired as <code class="ds-code-inline">aria-describedby</code>, so it's announced after the label rather than merged into it.</p>
        <div class="ds-card" style="display: flex; flex-direction: column; gap: 16px;">
            <?= ws_toggle('marketing_emails', ['checked' => true, 'label' => 'Subscribe to digest', 'description' => 'Weekly facilitation tips in your inbox']) ?>
            <?= ws_toggle('public_profile', ['label' => 'Public profile', 'description' => 'Let other facilitators find your workshops']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_toggle('marketing_emails', [
    'checked'     => true,
    'label'       => 'Subscribe to digest',
    'description' => 'Weekly facilitation tips in your inbox',
]) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <div class="ds-card" style="display: flex; flex-direction: column; gap: 16px;">
        <?= ws_toggle('locked_off', ['disabled' => true, 'label' => 'Locked off']) ?>
        <?= ws_toggle('locked_on', ['disabled' => true, 'checked' => true, 'label' => 'Locked on']) ?>
    </div>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Off</td><td>Default. Track is <code>--gray-200</code>, knob sits left.</td></tr>
            <tr><td>On</td><td>Track fills with the brand colour and the knob slides right over <code>--transition-base</code>. Driven by the native <code>:checked</code> state, not a class.</td></tr>
            <tr><td>Hover</td><td>No distinct hover treatment on the track &mdash; the label's pointer cursor is the affordance.</td></tr>
            <tr><td>Focus</td><td>The real <code>&lt;input type="checkbox"&gt;</code> is visually hidden but still focusable, so the browser's focus ring lands on the switch. Don't replace the input with a styled <code>&lt;div&gt;</code>; this is what makes it keyboard-operable.</td></tr>
            <tr><td>Disabled</td><td>Sets the native <code>disabled</code> attribute and adds <code>.ws-toggle-container--disabled</code>, which dims the whole row. Works in both on and off positions, as above.</td></tr>
        </tbody>
    </table>
    <div class="ds-code"><pre>&lt;?= ws_toggle('locked_off', ['disabled' => true, 'label' => 'Locked off']) ?&gt;</pre></div>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">A notification settings panel: each toggle names the setting, describes the consequence, and persists on change rather than waiting for a save button &mdash; which is the contract that justifies a switch over a checkbox.</p>
    <div class="ds-card" style="display: flex; flex-direction: column; gap: 20px; max-width: 480px;">
        <?= ws_toggle('notify_digest', ['checked' => true, 'label' => 'Weekly digest', 'description' => 'A Saturday roundup of new exercises and articles']) ?>
        <?= ws_toggle('notify_session', ['label' => 'Session reminders', 'description' => 'An email the morning of any workshop you have scheduled']) ?>
        <?= ws_toggle('notify_product', ['disabled' => true, 'checked' => true, 'label' => 'Account and security emails', 'description' => 'Always on &mdash; these cover password changes and billing']) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_toggle('notify_digest', [
    'checked'     => $prefs['digest'],
    'label'       => 'Weekly digest',
    'description' => 'A Saturday roundup of new exercises and articles',
    'attrs'       => ['data-pref' => 'digest'],
]) ?&gt;

&lt;script&gt;
// Persist on change — a switch must not need a save button.
document.querySelectorAll('[data-pref]').forEach(el =&gt;
    el.addEventListener('change', () =&gt; savePref(el.dataset.pref, el.checked)));
&lt;/script&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>$name</code></td><td>string</td><td><code>''</code></td><td>Positional. The input's <code>name</code> &mdash; effectively required, since it identifies the setting on submit.</td></tr>
            <tr><td><code>checked</code></td><td>bool</td><td><code>false</code></td><td>Initial state. Drive it from stored preference, never hardcode.</td></tr>
            <tr><td><code>label</code></td><td>string</td><td><code>null</code></td><td>Trailing label. Also becomes the accessible name via <code>aria-labelledby</code>.</td></tr>
            <tr><td><code>description</code></td><td>string</td><td><code>null</code></td><td>Sub-text under the label, wired as <code>aria-describedby</code></td></tr>
            <tr><td><code>disabled</code></td><td>bool</td><td><code>false</code></td><td>Native disabled state plus the dimmed container class</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>'ws-toggle-' . uniqid()</code></td><td>Input ID. Auto-generated so labels always bind correctly &mdash; only set it if you need a stable JS handle.</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes on the wrapper</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra HTML attributes on the checkbox input &mdash; where <code>data-*</code> hooks and event bindings go</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <p class="ds-section-desc">This is among the best-wired components in the library &mdash; it builds on a native checkbox rather than simulating one.</p>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Semantics</td><td>A real <code>&lt;input type="checkbox" role="switch"&gt;</code>, visually hidden and styled through its adjacent slider. Checked state, focusability, and form submission all come free from the native checkbox; the role only changes what a screen reader calls it.</td></tr>
            <tr><td>Keyboard</td><td>Native: <kbd>Tab</kbd> to reach, <kbd>Space</kbd> to flip. Disabled toggles are skipped.</td></tr>
            <tr><td>Labelling</td><td>The whole row is one <code>&lt;label&gt;</code>, so a click on the text or the description flips the switch, not only a click on the slider. The label text has an ID referenced by <code>aria-labelledby</code>, which names the switch with that text alone; the description gets its own ID via <code>aria-describedby</code>. Both are announced, in that order.</td></tr>
            <tr><td>Unlabelled toggles</td><td><strong>Your responsibility.</strong> Calling <code>ws_toggle()</code> without a <code>label</code> produces a switch with no accessible name. Either pass a label or point <code>attrs =&gt; ['aria-label' =&gt; …]</code> at the visible text beside it.</td></tr>
            <tr><td>Announced as a switch</td><td>Since October 2026 the input carries <code>role="switch"</code>, so screen readers say "switch, on" rather than "checkbox, checked", matching what the control promises: it applies the moment it is flipped. Keyboard, form submission and the checked state stay native. A control whose effect waits for a later action, like the consent in <code>ws_consent_row</code>, passes <code>attrs =&gt; ['role' =&gt; 'checkbox']</code> and is announced as a checkbox.</td></tr>
            <tr><td>Immediate effect</td><td>Flipping a switch changes something right away with no confirmation step. If the change is destructive or slow, either confirm it or surface the result &mdash; silence reads as failure.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--gray-200</code></td><td>Track in the off position</td></tr>
            <tr><td><code>--brand</code> / <code>--color-primary</code></td><td>Track fill when on, per context</td></tr>
            <tr><td><code>--color-ink</code> / <code>--color-ink-muted</code> / <code>--color-ink-faint</code></td><td>Label, description, and disabled text</td></tr>
            <tr><td><code>--radius-full</code></td><td>Track and knob shape</td></tr>
            <tr><td><code>--shadow-sm</code></td><td>Knob elevation</td></tr>
            <tr><td><code>--space-3</code></td><td>Gap between the switch and the label block</td></tr>
            <tr><td><code>--text-ui</code> / <code>--text-caption</code></td><td>Label and description type scale</td></tr>
            <tr><td><code>--font-body</code> / <code>--font-medium</code></td><td>Face and label weight</td></tr>
            <tr><td><code>--transition-base</code></td><td>Knob slide and track colour change</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-toggle-container</code></td><td>Row wrapper holding the switch and the label block</td></tr>
            <tr><td><code>.ws-toggle-container--disabled</code></td><td>Dimmed disabled row</td></tr>
            <tr><td><code>.ws-toggle</code></td><td>The switch itself &mdash; the label element wrapping input and slider</td></tr>
            <tr><td><code>.ws-toggle__input</code></td><td>The visually hidden checkbox. Focusable; do not <code>display: none</code> it.</td></tr>
            <tr><td><code>.ws-toggle__slider</code></td><td>Track and knob, driven by the input's <code>:checked</code> state</td></tr>
            <tr><td><code>.ws-toggle__label-wrap</code></td><td>Label plus description column</td></tr>
            <tr><td><code>.ws-toggle__label</code></td><td>Label text</td></tr>
            <tr><td><code>.ws-toggle__description</code></td><td>Sub-text</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_toggle()</code> helper function</td></tr>
            <tr><td><code>includes/components/toggle.php</code></td><td>Template &mdash; ID generation and ARIA wiring</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-toggle</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
