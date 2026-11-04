<?php
$ds_page  = 'components/demos/input';
$ds_title = 'Input';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Input</h1>
    <p>Collects a value from the user, with the label, hint, and error wiring already correct.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            You need any free-text or numeric field in a form. It covers text, email, password, number, tel, url, search, textarea, and select through one call, so the label and validation markup stay consistent. A textarea's <code>rows</code> is its starting height, and the person can drag it taller: 3 for a sentence or two (a reason, a short summary), the default 4 for a short paragraph, 6 for notes or a message someone writes freely. Mark a field that may be left empty with <code>optional</code>, even when it is the only field, and keep the label short ("Your notes"); say what it is for in <code>hint</code>. The field's <code>id</code> defaults to its name, so pass an <code>id</code> of its own when the name is a common word that something else on the page may use, such as a tab's id.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The choice is boolean &mdash; use <a href="<?= $ds_base ?>/components/demos/toggle.php">Toggle</a>. For a richer dropdown use <a href="<?= $ds_base ?>/components/demos/select.php">Select</a>, and for multi-value entry use <a href="<?= $ds_base ?>/components/demos/chip-input.php">Chip Input</a>.
        </div>
    </div>
</section>

<div class="ds-note" style="margin-bottom: 32px;">
    <span class="material-symbols-outlined">warning</span>
    <span><strong>Corrected July 2026.</strong> This page previously demonstrated <code>icon</code>, <code>iconPosition</code>, <code>state</code>, and <code>helper</code> options. The template reads none of them &mdash; code copied from those examples silently did nothing. The real option for help text is <code>hint</code>, and the error state is inferred from <code>error</code> being non-empty. See Options below.</span>
</div>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Basic</h3>
        <p class="ds-section-desc">The label is bound to the field by <code class="ds-code-inline">id</code>, which defaults to the field name. Always pass a label.</p>
        <div class="ds-card" style="max-width: 400px;">
            <?= ws_input('workshop_name', [
                'label' => 'Workshop name',
                'placeholder' => 'Enter workshop name…',
                'required' => true
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_input('workshop_name', [
    'label'       => 'Workshop name',
    'placeholder' => 'Enter workshop name…',
    'required'    => true,
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Types</h3>
        <p class="ds-section-desc">One helper covers nine types. <code class="ds-code-inline">textarea</code> and <code class="ds-code-inline">select</code> render different elements but keep the same label, hint, and error treatment.</p>
        <div class="ds-card" style="max-width: 400px; display: flex; flex-direction: column; gap: 16px;">
            <?= ws_input('email_demo', [
                'type' => 'email',
                'label' => 'Email address',
                'placeholder' => 'you@example.com',
                'autocomplete' => 'email',
            ]) ?>
            <?= ws_input('password_demo', [
                'type' => 'password',
                'label' => 'Password',
                'placeholder' => 'Enter password…',
            ]) ?>
            <?= ws_input('duration_demo', [
                'type' => 'number',
                'label' => 'Duration (minutes)',
                'value' => '45',
            ]) ?>
            <?= ws_input('category_demo', [
                'type' => 'select',
                'label' => 'Category',
                'placeholder' => 'Select category…',
                'options' => [
                    ['value' => 'ideation', 'label' => 'Ideation'],
                    ['value' => 'strategy', 'label' => 'Strategy'],
                    ['value' => 'team',     'label' => 'Team Building'],
                ],
            ]) ?>
            <?= ws_input('description_demo', [
                'type' => 'textarea',
                'label' => 'Description',
                'placeholder' => 'Enter a description…',
                'rows' => 4,
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_input('email', ['type' => 'email', 'label' => 'Email address']) ?&gt;
&lt;?= ws_input('description', ['type' => 'textarea', 'label' => 'Description', 'rows' => 4]) ?&gt;

&lt;!-- NOTE the options shape — list of arrays, not value => label pairs --&gt;
&lt;?= ws_input('category', [
    'type'        => 'select',
    'label'       => 'Category',
    'placeholder' => 'Select category…',
    'options'     => [
        ['value' => 'ideation', 'label' => 'Ideation'],
        ['value' => 'strategy', 'label' => 'Strategy'],
    ],
]) ?&gt;</pre></div>
        <div class="ds-note">
            <span class="material-symbols-outlined">warning</span>
            <span><strong>Options shape differs from <a href="<?= $ds_base ?>/components/demos/select.php">Select</a>.</strong> <code>ws_input(type: 'select')</code> wants a list of <code>['value' =&gt; …, 'label' =&gt; …, 'disabled' =&gt; …]</code> arrays. <code>ws_select()</code> wants flat <code>value =&gt; label</code> pairs. Passing the flat shape here throws <em>Cannot access offset of type string on string</em> &mdash; a fatal, not a silent miss. This page previously shipped that exact bug. When you want a dropdown, prefer <code>ws_select()</code>.</span>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Sizes</h3>
        <div class="ds-card" style="max-width: 400px; display: flex; flex-direction: column; gap: 16px;">
            <?= ws_input('small_demo', ['label' => 'Small', 'size' => 'sm', 'placeholder' => 'Small input']) ?>
            <?= ws_input('medium_demo', ['label' => 'Medium (default)', 'placeholder' => 'Medium input']) ?>
            <?= ws_input('large_demo', ['label' => 'Large', 'size' => 'lg', 'placeholder' => 'Large input']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_input('small', ['label' => 'Small', 'size' => 'sm']) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <p class="ds-section-desc">There is no <code class="ds-code-inline">state</code> option. The error state is derived: pass a non-empty <code class="ds-code-inline">error</code> and the field styles itself, sets <code class="ds-code-inline">aria-invalid</code>, and points <code class="ds-code-inline">aria-describedby</code> at the message.</p>
    <div class="ds-card" style="max-width: 400px; display: flex; flex-direction: column; gap: 16px;">
        <?= ws_input('hint_demo', [
            'type' => 'email',
            'label' => 'Email with a hint',
            'value' => 'user@example.com',
            'hint' => 'We only use this for session reminders.',
        ]) ?>
        <?= ws_input('error_demo', [
            'type' => 'email',
            'label' => 'Email with an error',
            'value' => 'invalid-email',
            'error' => 'Please enter a valid email address',
        ]) ?>
        <?= ws_input('disabled_demo', [
            'label' => 'Disabled field',
            'value' => 'Cannot edit',
            'disabled' => true,
        ]) ?>
        <?= ws_input('readonly_demo', [
            'label' => 'Read-only field',
            'value' => 'Displayed, not editable',
            'readonly' => true,
        ]) ?>
    </div>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>Bordered field using the <code>--input-*</code> token family.</td></tr>
            <tr><td>Hover</td><td>Border shifts to <code>--input-border-hover</code>.</td></tr>
            <tr><td>Focus</td><td>Border becomes <code>--input-border-focus</code> with a <code>--input-ring</code> halo. This is the sanctioned non-red focus accent &mdash; don't remove it.</td></tr>
            <tr><td>Error</td><td>Triggered by a non-empty <code>error</code>. Adds <code>.ws-input--error</code> and <code>.ws-field--error</code>, sets <code>aria-invalid="true"</code>, and renders the message with <code>role="alert"</code>.</td></tr>
            <tr><td>Hint</td><td>Rendered only when there's no error &mdash; the error replaces the hint rather than stacking below it.</td></tr>
            <tr><td>Disabled</td><td>Native <code>disabled</code>: greyed, unfocusable, and not submitted with the form.</td></tr>
            <tr><td>Read-only</td><td>Native <code>readonly</code>: still focusable and still submitted, unlike disabled. Use it for values the user should see and copy but not change.</td></tr>
            <tr><td>Success</td><td><code>.ws-input--success</code> exists in CSS but nothing in the template emits it. Apply it yourself through <code>class</code> if you want a verified-field treatment.</td></tr>
        </tbody>
    </table>
    <div class="ds-code"><pre>&lt;?= ws_input('email', [
    'label' => 'Email address',
    'error' => $errors['email'] ?? null,   // non-empty ⇒ error state
    'hint'  => 'We only use this for session reminders.',
]) ?&gt;</pre></div>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">A save-workshop form on redisplay after failed validation: values echoed back, per-field errors from the validation array, and autocomplete hints set so browsers fill sensibly.</p>
    <div class="ds-card" style="max-width: 440px; display: flex; flex-direction: column; gap: 16px;">
        <?= ws_input('title_demo', [
            'label' => 'Workshop title',
            'value' => 'Q3 Planning Offsite',
            'required' => true,
            'maxlength' => 120,
        ]) ?>
        <?= ws_input('duration_real', [
            'type' => 'number',
            'label' => 'Duration (minutes)',
            'value' => '0',
            'error' => 'Duration must be at least 15 minutes',
        ]) ?>
        <?= ws_input('goal_demo', [
            'type' => 'textarea',
            'label' => 'Goal',
            'value' => '',
            'hint' => 'One sentence on what the group should leave with.',
            'rows' => 3,
        ]) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_input('title', [
    'label'     => 'Workshop title',
    'value'     => $plan['title'] ?? '',
    'error'     => $errors['title'] ?? null,
    'required'  => true,
    'maxlength' => 120,
]) ?&gt;

&lt;?= ws_input('goal', [
    'type'  => 'textarea',
    'label' => 'Goal',
    'value' => $plan['goal'] ?? '',
    'error' => $errors['goal'] ?? null,
    'hint'  => 'One sentence on what the group should leave with.',
    'rows'  => 3,
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
            <tr><td><code>$name</code></td><td>string</td><td><code>''</code></td><td>Positional. The field name, and the default <code>id</code>.</td></tr>
            <tr><td><code>type</code></td><td>string</td><td><code>'text'</code></td><td><code>text</code> | <code>email</code> | <code>password</code> | <code>number</code> | <code>tel</code> | <code>url</code> | <code>search</code> | <code>date</code> | <code>time</code> | <code>color</code> | <code>file</code> | <code>textarea</code> | <code>select</code>. <code>color</code> gets a full-height swatch so it matches a text field; <code>file</code> draws its picker button as a secondary button.</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>$name</code></td><td>Element ID, used to bind the label</td></tr>
            <tr><td><code>label</code></td><td>string</td><td><code>null</code></td><td>Visible label. Effectively required &mdash; see Accessibility.</td></tr>
            <tr><td><code>placeholder</code></td><td>string</td><td><code>''</code></td><td>Placeholder text. Never a substitute for a label.</td></tr>
            <tr><td><code>value</code></td><td>string</td><td><code>''</code></td><td>Current value</td></tr>
            <tr><td><code>error</code></td><td>string</td><td><code>null</code></td><td>Error message. A non-empty value <em>is</em> the error state.</td></tr>
            <tr><td><code>hint</code></td><td>string</td><td><code>null</code></td><td>Help text below the field. Hidden while an error is showing.</td></tr>
            <tr><td><code>required</code></td><td>bool</td><td><code>false</code></td><td>Native required attribute. Draws no asterisk: Workshopr defaults to required (DESIGN.md &sect;11.3)</td></tr>
            <tr><td><code>optional</code></td><td>bool</td><td><code>false</code></td><td>Appends "(optional)" to the label: the way an optional field is marked</td></tr>
            <tr><td><code>disabled</code></td><td>bool</td><td><code>false</code></td><td>Disabled and excluded from submission</td></tr>
            <tr><td><code>readonly</code></td><td>bool</td><td><code>false</code></td><td>Not editable, but focusable and submitted</td></tr>
            <tr><td><code>autocomplete</code></td><td>string</td><td><code>null</code></td><td>Autocomplete token &mdash; set it on name, email, and address fields</td></tr>
            <tr><td><code>minlength</code> / <code>maxlength</code></td><td>int</td><td><code>null</code></td><td>Native length constraints</td></tr>
            <tr><td><code>pattern</code></td><td>string</td><td><code>null</code></td><td>Native validation pattern</td></tr>
            <tr><td><code>options</code></td><td>array</td><td><code>[]</code></td><td><code>select</code> type only. A <strong>list of arrays</strong>: <code>[['value' =&gt; …, 'label' =&gt; …, 'disabled' =&gt; false]]</code>. Not the same shape as <code>ws_select()</code>.</td></tr>
            <tr><td><code>rows</code></td><td>int</td><td><code>4</code></td><td><code>textarea</code> type only. The starting height: 3 for a sentence or two, 4 for a short paragraph, 6 for free notes. It resizes vertically.</td></tr>
            <tr><td><code>showPasswordToggle</code></td><td>bool</td><td><code>true</code></td><td><code>password</code> type only &mdash; the visibility toggle button</td></tr>
            <tr><td><code>size</code></td><td>string</td><td><code>'md'</code></td><td><code>sm</code> | <code>md</code> | <code>lg</code></td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra HTML attributes as key/value pairs</td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">info</span>
        <span><strong>Not supported:</strong> <code>icon</code>, <code>iconPosition</code>, <code>state</code>, <code>helper</code>. The CSS carries <code>.ws-input-wrap__icon--left/right</code> rules, but no template emits them &mdash; leading icons would need markup you write yourself, or a template change.</span>
    </div>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Labelling</td><td>A real <code>&lt;label for&gt;</code> bound to the field's <code>id</code>. Omitting <code>label</code> leaves the field unnamed &mdash; a placeholder does not substitute, since it vanishes on typing.</td></tr>
            <tr><td>Errors</td><td>The message carries <code>role="alert"</code>, so it's announced when it appears, and the field gets <code>aria-invalid="true"</code> plus <code>aria-describedby</code> pointing at it.</td></tr>
            <tr><td>Hints</td><td>Wired through <code>aria-describedby</code> to the hint's ID &mdash; but only when there's no error. Error takes the slot; the two never both describe the field.</td></tr>
            <tr><td>Password toggle</td><td>A real button labelled <code>aria-label="Toggle password visibility"</code>, with both eye icons marked <code>aria-hidden</code>. It swaps the input's <code>type</code> via an inline handler.</td></tr>
            <tr><td>Keyboard</td><td>All native. Disabled fields leave the tab order; read-only fields stay in it.</td></tr>
            <tr><td>Required and optional</td><td><code>required</code> sets the native attribute, so the state is announced and the browser checks it; there is no asterisk. <code>optional</code> puts "(optional)" inside the label, so it is part of the field's name for everyone.</td></tr>
            <tr><td>Autofill</td><td>Pass <code>autocomplete</code> on personal-data fields. It's an accessibility feature (WCAG 1.3.5), not just convenience.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--input-bg</code> / <code>--input-text</code> / <code>--input-radius</code></td><td>Field surface, text, and corners</td></tr>
            <tr><td><code>--input-border</code> / <code>--input-border-hover</code> / <code>--input-border-focus</code></td><td>Border across resting, hover, and focus</td></tr>
            <tr><td><code>--input-ring</code> / <code>--input-ring-width</code></td><td>Focus halo</td></tr>
            <tr><td><code>--focus-ring-width</code> / <code>--focus-ring-offset</code></td><td>Shared focus geometry</td></tr>
            <tr><td><code>--input-placeholder</code> / <code>--gray-400</code></td><td>Placeholder text</td></tr>
            <tr><td><code>--gray-50</code></td><td>Disabled fill</td></tr>
            <tr><td><code>--color-error</code> / <code>--color-error-light</code></td><td>Error border and message</td></tr>
            <tr><td><code>--color-success</code> / <code>--color-success-light</code></td><td>The unused success treatment</td></tr>
            <tr><td><code>--brand</code> / <code>--brand-ink</code> / <code>--brand-tint</code></td><td>Accent</td></tr>
            <tr><td><code>--text-body</code> / <code>--text-ui</code> / <code>--text-meta</code></td><td>Field, label, and hint type scale</td></tr>
            <tr><td><code>--font-body</code></td><td>Body face</td></tr>
            <tr><td><code>--transition-interactive</code></td><td>Border and ring transitions</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-input</code></td><td>The field element</td></tr>
            <tr><td><code>.ws-input--sm / --lg</code></td><td>Size modifiers (<code>md</code> emits nothing)</td></tr>
            <tr><td><code>.ws-input--error</code></td><td>Error styling, emitted when <code>error</code> is set</td></tr>
            <tr><td><code>.ws-input--success</code></td><td>Success styling &mdash; defined in CSS, never emitted by the template</td></tr>
            <tr><td><code>.ws-field--error</code></td><td>Error class on the wrapper, for styling the label and message together</td></tr>
            <tr><td><code>.ws-input-wrap</code></td><td>Wrapper for a field with adornments</td></tr>
            <tr><td><code>.ws-input-wrap--has-icon-left / --has-icon-right</code></td><td>Padding adjustments for icons &mdash; <strong>orphaned</strong>, since no template emits them</td></tr>
            <tr><td><code>.ws-input-wrap__icon</code> / <code>--left</code> / <code>--right</code></td><td>Icon positioning &mdash; also orphaned</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_input()</code> helper function</td></tr>
            <tr><td><code>includes/components/input.php</code></td><td>Template &mdash; type branching, ARIA wiring, password toggle</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-input</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
