<?php
$ds_page  = 'components/demos/select';
$ds_title = 'Select';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Select</h1>
    <p>Picks one value from a known list, wrapping the native <code class="ds-code-inline">&lt;select&gt;</code> so it matches the rest of the form.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            The user picks exactly one option from four or more known values &mdash; a category, a workshop type, a filter. The list is fixed and short enough to scroll.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            There are three or fewer options &mdash; use <a href="<?= $ds_base ?>/components/demos/radio-card-group.php">Radio Card Group</a> so they're all visible. For dozens of values, use a searchable input; for on/off, use <a href="<?= $ds_base ?>/components/demos/toggle.php">Toggle</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Basic</h3>
        <p class="ds-section-desc">Options are flat <code class="ds-code-inline">value =&gt; label</code> pairs. A <code class="ds-code-inline">placeholder</code> adds a leading prompt option.</p>
        <div class="ds-card" style="max-width: 400px;">
            <?= ws_select('category', [
                'ideation' => 'Ideation',
                'strategy' => 'Strategy',
                'team' => 'Team Building',
                'feedback' => 'Feedback',
            ], [
                'label' => 'Category',
                'placeholder' => 'Select a category…',
                'required' => true
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_select('category', [
    'ideation' => 'Ideation',
    'strategy' => 'Strategy',
    'team'     => 'Team Building',
], [
    'label'       => 'Category',
    'placeholder' => 'Select a category…',
    'required'    => true,
]) ?&gt;</pre></div>
        <div class="ds-note">
            <span class="material-symbols-outlined">info</span>
            <span>The options shape here is <strong>not</strong> the same as <code>ws_input(type: 'select')</code>, which wants a list of arrays. When you need a dropdown, this helper is the one to reach for &mdash; see <a href="<?= $ds_base ?>/components/demos/input.php">Input</a>.</span>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Sizes</h3>
        <div class="ds-card" style="max-width: 400px; display: flex; flex-direction: column; gap: 16px;">
            <?= ws_select('small', ['a' => 'Option A', 'b' => 'Option B'], ['label' => 'Small', 'size' => 'sm', 'value' => 'a']) ?>
            <?= ws_select('medium', ['a' => 'Option A', 'b' => 'Option B'], ['label' => 'Medium (default)', 'value' => 'a']) ?>
            <?= ws_select('large', ['a' => 'Option A', 'b' => 'Option B'], ['label' => 'Large', 'size' => 'lg', 'value' => 'a']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_select('field', $opts, ['label' => 'Small', 'size' => 'sm']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Pre-selected value</h3>
        <p class="ds-section-desc">Pass <code class="ds-code-inline">value</code> to mark the current selection &mdash; essential when redisplaying a form after a validation failure.</p>
        <div class="ds-card" style="max-width: 400px;">
            <?= ws_select('workshop_type', [
                'design_sprint' => 'Design Sprint',
                'retrospective' => 'Retrospective',
                'brainstorm' => 'Brainstorming',
                'kickoff' => 'Project Kickoff',
            ], [
                'label' => 'Workshop type',
                'value' => 'retrospective'
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_select('workshop_type', $types, [
    'label' => 'Workshop type',
    'value' => $plan['type'] ?? '',
]) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <div class="ds-card" style="max-width: 400px; display: flex; flex-direction: column; gap: 16px;">
        <?= ws_select('helper_select', ['a' => 'Option A', 'b' => 'Option B'], [
            'label' => 'With helper text',
            'value' => 'a',
            'helper' => 'Choose the option that best fits your needs'
        ]) ?>
        <?= ws_select('error_select', ['a' => 'Option A', 'b' => 'Option B'], [
            'label' => 'With an error',
            'error' => 'Please select an option'
        ]) ?>
        <?= ws_select('disabled_select', ['a' => 'Option A', 'b' => 'Option B'], [
            'label' => 'Disabled',
            'value' => 'a',
            'disabled' => true
        ]) ?>
    </div>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>Bordered field with the chevron drawn as a separate <code>.ws-select__arrow</code> element, since native dropdown arrows can't be styled.</td></tr>
            <tr><td>Hover</td><td>Border shifts to <code>--gray-300</code>.</td></tr>
            <tr><td>Focus</td><td><code>--input-border-focus</code> plus the <code>--input-ring</code> halo, matching Input exactly.</td></tr>
            <tr><td>Error</td><td>Derived from a non-empty <code>error</code> &mdash; there's no separate state option. Sets <code>aria-invalid="true"</code>, points <code>aria-describedby</code> at the message, and renders it with <code>role="alert"</code>.</td></tr>
            <tr><td>Helper</td><td>Shown below the field. Like Input, the error takes the describedby slot when both are present.</td></tr>
            <tr><td>Disabled</td><td>Native <code>disabled</code>: greyed, unfocusable, not submitted.</td></tr>
            <tr><td>Open</td><td>The dropdown list is rendered by the OS, so its appearance isn't ours to style &mdash; and doesn't need to be.</td></tr>
        </tbody>
    </table>
    <div class="ds-code"><pre>&lt;?= ws_select('category', $opts, ['error'  => 'Please select an option']) ?&gt;
&lt;?= ws_select('category', $opts, ['helper' => 'Helpful description']) ?&gt;</pre></div>
    <div class="ds-note">
        <span class="material-symbols-outlined">warning</span>
        <span><strong>Naming inconsistency:</strong> help text is <code>helper</code> here but <code>hint</code> on <a href="<?= $ds_base ?>/components/demos/input.php">Input</a>. The two aren't interchangeable &mdash; passing the wrong one is silently ignored. <a href="<?= $ds_base ?>/components/demos/form-row.php">Form Row</a> also uses <code>helper</code>.</span>
    </div>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">A category filter above a library listing: options built from the database, the current query-string value pre-selected, and a submit-on-change handler passed through <code class="ds-code-inline">attrs</code>.</p>
    <div class="ds-card" style="max-width: 400px;">
        <?= ws_select('category_filter', [
            'all' => 'All categories',
            'ideation' => 'Ideation (24)',
            'research' => 'Research (18)',
            'analysis' => 'Analysis (11)',
        ], [
            'label' => 'Filter by category',
            'value' => 'ideation',
        ]) ?>
    </div>
    <div class="ds-code"><pre>&lt;?php
$opts = ['all' => 'All categories'];
foreach ($categories as $c) {
    $opts[$c['slug']] = $c['name'] . ' (' . $c['exercise_count'] . ')';
}
?&gt;
&lt;?= ws_select('category', $opts, [
    'label' => 'Filter by category',
    'value' => $_GET['category'] ?? 'all',
    'attrs' => ['onchange' => 'this.form.submit()'],
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
            <tr><td><code>$name</code></td><td>string</td><td><code>''</code></td><td>First positional. Field name, and the default <code>id</code>.</td></tr>
            <tr><td><code>$selectOptions</code></td><td>array</td><td><code>[]</code></td><td>Second positional. Flat <code>value =&gt; label</code> pairs.</td></tr>
            <tr><td><code>label</code></td><td>string</td><td><code>null</code></td><td>Visible label. Effectively required.</td></tr>
            <tr><td><code>value</code></td><td>string</td><td><code>''</code></td><td>Pre-selected value</td></tr>
            <tr><td><code>placeholder</code></td><td>string</td><td><code>null</code></td><td>Leading prompt option</td></tr>
            <tr><td><code>required</code></td><td>bool</td><td><code>false</code></td><td>Native required attribute. Draws no asterisk (DESIGN.md &sect;11.3)</td></tr>
            <tr><td><code>optional</code></td><td>bool</td><td><code>false</code></td><td>Appends "(optional)" to the label, for a select that may be left on its empty choice</td></tr>
            <tr><td><code>disabled</code></td><td>bool</td><td><code>false</code></td><td>Disabled state</td></tr>
            <tr><td><code>error</code></td><td>string</td><td><code>null</code></td><td>Error message. Non-empty <em>is</em> the error state.</td></tr>
            <tr><td><code>helper</code></td><td>string</td><td><code>null</code></td><td>Help text below the field. Note: <code>helper</code>, not <code>hint</code>.</td></tr>
            <tr><td><code>size</code></td><td>string</td><td><code>'md'</code></td><td><code>sm</code> | <code>md</code> | <code>lg</code></td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>$name</code></td><td>Element ID, used to bind the label</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra HTML attributes &mdash; where <code>onchange</code> and <code>data-*</code> go</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Semantics</td><td>A native <code>&lt;select&gt;</code>. Keyboard interaction, type-ahead, and the platform's own picker on mobile all come free &mdash; the main reason not to build a custom dropdown.</td></tr>
            <tr><td>Labelling</td><td><code>&lt;label for&gt;</code> bound to the field <code>id</code>. Without <code>label</code> the control is unnamed; a placeholder option doesn't count.</td></tr>
            <tr><td>Errors</td><td><code>aria-invalid="true"</code> on the field, <code>aria-describedby</code> pointing at the message, and <code>role="alert"</code> on the message so it's announced when it appears.</td></tr>
            <tr><td>Keyboard</td><td>Native throughout: <kbd>Tab</kbd> to reach, arrows or typing to change, <kbd>Enter</kbd>/<kbd>Esc</kbd> to commit or cancel on platforms with a popup list.</td></tr>
            <tr><td>Placeholder option</td><td>Rendered as a real option. If the field is required, make sure its value is empty so native validation rejects it.</td></tr>
            <tr><td>Submit on change</td><td>Reloading the page on change moves focus and can strand keyboard users mid-list. Prefer an explicit apply button, or restore focus after the reload.</td></tr>
            <tr><td>Contrast</td><td>Field text uses <code>--text-dark</code> and the arrow <code>--gray-400</code>. The arrow is decorative &mdash; the control is identifiable without it.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--bg-surface</code></td><td>Field background</td></tr>
            <tr><td><code>--gray-200</code> / <code>--gray-300</code></td><td>Border, resting and hover</td></tr>
            <tr><td><code>--gray-400</code></td><td>Chevron colour</td></tr>
            <tr><td><code>--gray-50</code></td><td>Disabled fill</td></tr>
            <tr><td><code>--input-border-focus</code> / <code>--input-ring</code> / <code>--input-ring-width</code></td><td>Focus border and halo, shared with Input</td></tr>
            <tr><td><code>--focus-ring-width</code> / <code>--focus-ring-offset</code></td><td>Shared focus geometry</td></tr>
            <tr><td><code>--radius-xl</code></td><td>Field corners</td></tr>
            <tr><td><code>--text-dark</code></td><td>Selected value text</td></tr>
            <tr><td><code>--text-body</code> / <code>--text-ui</code> / <code>--text-meta</code></td><td>Type scale across sizes</td></tr>
            <tr><td><code>--font-body</code></td><td>Body face</td></tr>
            <tr><td><code>--transition-interactive</code></td><td>Border and ring transitions</td></tr>
            <tr><td><code>--icon-lg</code></td><td>Icons, at least 24px on every page (DESIGN.md §8)</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-select</code></td><td>The native <code>&lt;select&gt;</code></td></tr>
            <tr><td><code>.ws-select--sm / --lg</code></td><td>Size modifiers (<code>md</code> emits nothing)</td></tr>
            <tr><td><code>.ws-select-wrap</code></td><td>Positioning context for the field and its arrow</td></tr>
            <tr><td><code>.ws-select__arrow</code></td><td>The chevron overlay</td></tr>
            <tr><td><code>.ws-field</code></td><td>Outer field wrapper, shared with Input</td></tr>
            <tr><td><code>.ws-field--error</code></td><td>Error state on the wrapper</td></tr>
            <tr><td><code>.ws-field__label</code> / <code>__error</code> / <code>__helper</code></td><td>Label, error, and helper text, shared with Input</td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">info</span>
        <span><code>ws_input(type: 'select')</code> emits <code>.ws-select-wrapper</code> &mdash; a different class from this component's <code>.ws-select-wrap</code>. Another reason to standardise on <code>ws_select()</code> for dropdowns.</span>
    </div>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_select()</code> helper function</td></tr>
            <tr><td><code>includes/components/select.php</code></td><td>Template &mdash; option loop and ARIA wiring</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-select</code> and shared <code>.ws-field</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
