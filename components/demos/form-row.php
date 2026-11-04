<?php
$ds_page  = 'components/demos/form-row';
$ds_title = 'Form Row';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Form Row</h1>
    <p>Wraps a field, or a group of fields, in a consistent label, helper, and error layout. The label names what it wraps.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            You need to label something that has no label option of its own &mdash; a group of related controls, a custom widget, a pair of fields under one heading. Also useful for the <code>columns</code> span in multi-column form grids.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The field already accepts a <code>label</code> &mdash; which <a href="<?= $ds_base ?>/components/demos/input.php">Input</a> and <a href="<?= $ds_base ?>/components/demos/select.php">Select</a> both do. Use the field's own label, hint and error; a row around it adds nothing but a second wrapper. Never label both the field and the row: the control would carry two names.
        </div>
    </div>
</section>

<div class="ds-note" style="margin-bottom: 32px;">
    <span class="material-symbols-outlined">info</span>
    <span><strong>The label is bound (since October 2026).</strong> With one control inside, the row gives its label <code>for</code> that control, adding an id if the control has none, and points the control's <code>aria-describedby</code> at the helper or error. With several controls, the row is a <code>role="group"</code> named by its label. Before this, the label carried no <code>for</code> and a field labelled only here had no accessible name.</span>
</div>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Stacked (default)</h3>
        <p class="ds-section-desc">Label above, field below, helper underneath. The standard vertical form rhythm.</p>
        <div class="ds-card">
            <?= ws_form_row(ws_input('fr_email', ['type' => 'email', 'placeholder' => 'you@example.com']), [
                'label' => 'Email address',
                'required' => true,
                'helper' => "We'll never share your email.",
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_form_row(
    ws_input('email', ['type' => 'email', 'placeholder' => 'you@example.com']),
    [
        'label'    => 'Email address',
        'required' => true,
        'helper'   => "We'll never share your email.",
    ]
) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Inline</h3>
        <p class="ds-section-desc">Label beside the field. Use it in settings panels where a column of labels aids scanning; avoid it on narrow layouts where it forces the field too small.</p>
        <div class="ds-card">
            <?= ws_form_row(ws_input('fr_name', ['placeholder' => 'Jane Doe']), [
                'label' => 'Full name',
                'inline' => true,
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_form_row(ws_input('name'), ['label' => 'Full name', 'inline' => true]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Wrapping a select</h3>
        <p class="ds-section-desc">Any field HTML can be the content &mdash; the row doesn't care what it wraps.</p>
        <div class="ds-card">
            <?= ws_form_row(ws_select('fr_role', ['facilitator' => 'Facilitator', 'participant' => 'Participant', 'observer' => 'Observer'], ['placeholder' => 'Choose a role…']), [
                'label' => 'Role',
                'helper' => 'Select your role in the workshop.',
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_form_row(
    ws_select('role', $roles, ['placeholder' => 'Choose a role…']),
    ['label' => 'Role', 'helper' => 'Select your role in the workshop.']
) ?&gt;</pre></div>
    </div>
    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Around content that helpers print</h3>
        <p class="ds-section-desc"><code>ws_form_row_start</code> and <code>ws_form_row_end</code> take content written with helpers that print rather than return, such as a stack of switches, with no output buffering of your own. The end prints the row, so the label binding is the same as <code>ws_form_row</code>'s: here two switches make the row a group named by its label.</p>
        <div class="ds-card">
            <?php ws_form_row_start(['label' => 'Email me about', 'helper' => 'Each one changes as soon as you switch it.', 'id' => 'fr-notify']) ?>
                <?php ws_stack_start(['gap' => '3']) ?>
                    <?= ws_toggle('fr_reminders', ['label' => 'Session reminders', 'description' => 'The day before a workshop you are running.']) ?>
                    <?= ws_toggle('fr_digest', ['label' => 'Weekly digest', 'description' => 'New exercises, every Monday.']) ?>
                <?php ws_stack_end() ?>
            <?php ws_form_row_end() ?>
        </div>
        <div class="ds-code"><pre>&lt;?php ws_form_row_start(['label' =&gt; 'Email me about', 'helper' =&gt; 'Each one changes as soon as you switch it.']) ?&gt;
    &lt;?php ws_stack_start(['gap' =&gt; '3']) ?&gt;
        &lt;?= ws_toggle('reminders', ['label' =&gt; 'Session reminders']) ?&gt;
        &lt;?= ws_toggle('digest', ['label' =&gt; 'Weekly digest']) ?&gt;
    &lt;?php ws_stack_end() ?&gt;
&lt;?php ws_form_row_end() ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <div class="ds-card">
        <?= ws_form_row(ws_input('fr_password', ['type' => 'password', 'placeholder' => 'Enter password']), [
            'label' => 'Password',
            'required' => true,
            'error' => 'Password must be at least 8 characters.',
        ]) ?>
    </div>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>Label, field, and optional helper stacked with <code>--space-1</code> / <code>--space-4</code> rhythm.</td></tr>
            <tr><td>Required and optional</td><td><code>required</code> sets <code>aria-required="true"</code> on a single control that has neither <code>required</code> nor <code>aria-required</code>, and draws no asterisk: Workshopr defaults to required (DESIGN.md &sect;11.3). <code>optional</code> appends "(optional)" to the label.</td></tr>
            <tr><td>Error</td><td>A non-empty <code>error</code> adds <code>.ws-form-row--error</code> and replaces the helper text with the message, which carries <code>role="alert"</code>. A single control gets <code>aria-invalid="true"</code> and the error in its <code>aria-describedby</code>.</td></tr>
            <tr><td>Helper</td><td>Shown below the field, hidden while an error is present.</td></tr>
            <tr><td>Inline</td><td><code>.ws-form-row--inline</code> switches to a horizontal label/field arrangement.</td></tr>
            <tr><td>Columns</td><td><code>columns</code> emits an inline <code>grid-column: span N</code>, letting one row span multiple columns of a grid form.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">A two-column form where the email row spans both columns. Note the labels live on the <em>fields</em>, not on the rows &mdash; the rows are doing layout only, which is the pattern to copy.</p>
    <div class="ds-card">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <?= ws_form_row(ws_input('fr_first', ['label' => 'First name', 'placeholder' => 'Jane']), []) ?>
            <?= ws_form_row(ws_input('fr_last', ['label' => 'Last name', 'placeholder' => 'Doe']), []) ?>
            <?= ws_form_row(ws_input('fr_email2', ['type' => 'email', 'label' => 'Email', 'placeholder' => 'you@example.com']), ['columns' => 2]) ?>
        </div>
    </div>
    <div class="ds-code"><pre>&lt;form style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;"&gt;
    &lt;!-- Label on the field, so it is properly bound --&gt;
    &lt;?= ws_form_row(ws_input('first', ['label' => 'First name']), []) ?&gt;
    &lt;?= ws_form_row(ws_input('last',  ['label' => 'Last name']),  []) ?&gt;

    &lt;!-- Row spans both columns --&gt;
    &lt;?= ws_form_row(
        ws_input('email', ['type' => 'email', 'label' => 'Email']),
        ['columns' => 2]
    ) ?&gt;
&lt;/form&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>$content</code></td><td>string</td><td>&mdash;</td><td>Positional. The field HTML, typically <code>ws_input()</code> or <code>ws_select()</code> output. Rendered raw.</td></tr>
            <tr><td><code>label</code></td><td>string</td><td><code>''</code></td><td>Row label. Bound to a single control with <code>for</code>, or names the row as a group.</td></tr>
            <tr><td><code>required</code></td><td>bool</td><td><code>false</code></td><td>Asterisk, plus <code>aria-required</code> on a single control. Set <code>required</code> on the field itself when the browser should enforce it.</td></tr>
            <tr><td><code>helper</code></td><td>string</td><td><code>''</code></td><td>Help text below the field. Note: <code>helper</code>, matching Select rather than Input's <code>hint</code>.</td></tr>
            <tr><td><code>error</code></td><td>string</td><td><code>''</code></td><td>Error message. Replaces the helper and adds the error class.</td></tr>
            <tr><td><code>inline</code></td><td>bool</td><td><code>false</code></td><td>Horizontal label and field</td></tr>
            <tr><td><code>columns</code></td><td>int</td><td><code>null</code></td><td>Grid column span, as an inline style</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>''</code></td><td>ID on the row wrapper, not the field</td></tr>
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
            <tr><td>Label binding</td><td>One control inside (hidden inputs aside): the label gets <code>for</code> its id, and the row adds an id when the control has none. Several controls, or none: the row is <code>role="group"</code> with <code>aria-labelledby</code> on its label, so a screen reader announces the group's name as focus enters it.</td></tr>
            <tr><td>Error association</td><td>The helper or error gets an id, and a single control lists it in <code>aria-describedby</code>, after any description the field already had (an Input hint stays). A group points its own <code>aria-describedby</code> at it. The error carries <code>role="alert"</code>, so it is announced when it appears.</td></tr>
            <tr><td>Required indicator</td><td>The asterisk is <code>aria-hidden</code>; the requirement reaches assistive technology as <code>aria-required</code> on a single control.</td></tr>
            <tr><td>Keyboard</td><td>The row adds nothing focusable. Clicking the label focuses a single control.</td></tr>
            <tr><td>Contrast</td><td>Label uses <code>--text-default</code>, helper <code>--text-muted</code>, and error <code>--color-error</code>, all tested.</td></tr>
        </tbody>
    </table>

    <h3 class="ds-subsection-title">What to do instead</h3>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do:</strong>
            Give a field that takes a label its own <code>label</code>, <code>hint</code> or <code>helper</code>, and <code>error</code>. Use the row's label for what has no label option: a group of related controls, a custom widget, a pair of fields under one heading.
        </div>
        <div class="ds-dont">
            <strong>Don't:</strong>
            Don't label both the row and the field inside it: the control ends up with two names, read one after the other.
        </div>
    </div>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--text-default</code></td><td>Label colour</td></tr>
            <tr><td><code>--text-muted</code></td><td>Helper text</td></tr>
            <tr><td><code>--color-error</code></td><td>Error text and the required asterisk</td></tr>
            <tr><td><code>--text-small</code> / <code>--text-caption</code></td><td>Label and helper type scale</td></tr>
            <tr><td><code>--font-medium</code></td><td>Label weight</td></tr>
            <tr><td><code>--space-1</code> / <code>--space-4</code></td><td>Label-to-field and field-to-helper spacing</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-form-row</code></td><td>Row wrapper</td></tr>
            <tr><td><code>.ws-form-row--inline</code></td><td>Horizontal label and field</td></tr>
            <tr><td><code>.ws-form-row--error</code></td><td>Error state on the row</td></tr>
            <tr><td><code>.ws-form-row__label</code></td><td>Label element, bound to a single control or naming the group</td></tr>
            <tr><td><code>.ws-form-row__optional</code></td><td>The "(optional)" marker in the label</td></tr>
            <tr><td><code>.ws-form-row__field</code></td><td>Field container</td></tr>
            <tr><td><code>.ws-form-row__helper</code></td><td>Helper text</td></tr>
            <tr><td><code>.ws-form-row__error</code></td><td>Error text</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_form_row()</code> helper function</td></tr>
            <tr><td><code>includes/components/form-row.php</code></td><td>Template &mdash; label, field slot, helper/error branch</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-form-row</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
