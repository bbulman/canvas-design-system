<?php
$ds_page  = 'components/demos/chip-input';
$ds_title = 'Chip Input';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Chip Input</h1>
    <p>Collects several values into removable tokens &mdash; the markup and styling only; the behaviour is yours to write.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            A field holds an open-ended list the user builds up &mdash; attendee emails, tags, keywords. Each value becomes a token they can see and remove individually.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The field holds one value (<a href="<?= $ds_base ?>/components/demos/input.php">Input</a>) or the options are known in advance (<a href="<?= $ds_base ?>/components/demos/select.php">Select</a> or <a href="<?= $ds_base ?>/components/demos/checkbox-card-group.php">Checkbox Card Group</a>). For a read-only tag, use <a href="<?= $ds_base ?>/components/demos/pill.php">Pill</a>.
        </div>
    </div>
</section>

<div class="ds-note" style="margin-bottom: 32px;">
    <span class="material-symbols-outlined">warning</span>
    <span><strong>This component ships no JavaScript.</strong> <code>components.js</code> contains nothing for chips. The helper renders a labelled field, an add button, and an empty list container &mdash; adding, removing, validating, and serialising values for submit are all yours to implement. Budget for that, and see Accessibility for what your handlers must do.</span>
</div>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With a label and add text</h3>
        <p class="ds-section-desc">Giving the add button text as well as an icon is the accessible default &mdash; an icon-only button here has no accessible name.</p>
        <div class="ds-card">
            <?= ws_chip_input('attendees', [
                'label' => 'Attendees',
                'placeholder' => 'Enter email address',
                'type' => 'email',
                'addIcon' => 'person_add',
                'addText' => 'Add',
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_chip_input('attendees', [
    'label'       => 'Attendees',
    'placeholder' => 'Enter email address',
    'type'        => 'email',
    'addIcon'     => 'person_add',
    'addText'     => 'Add',
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Tag input, no label</h3>
        <p class="ds-section-desc">Omitting the label is only safe when a heading beside the field already names it. Otherwise the input has nothing to announce.</p>
        <div class="ds-card">
            <?= ws_chip_input('tags', [
                'placeholder' => 'Add tag…',
                'addIcon' => 'add',
                'addText' => 'Add',
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_chip_input('tags', ['placeholder' => 'Add tag…', 'addText' => 'Add']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Chip markup</h3>
        <p class="ds-section-desc">Your JavaScript renders chips into the <code class="ds-code-inline">__list</code> container. This is the structure the CSS expects &mdash; note the <code class="ds-code-inline">aria-label</code> on the remove button, which names <em>which</em> chip it removes.</p>
        <div class="ds-card">
            <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                <div class="ws-chip">
                    <span>alice@example.com</span>
                    <button class="ws-chip__remove" type="button" aria-label="Remove alice@example.com">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                <div class="ws-chip">
                    <span>bob@example.com</span>
                    <button class="ws-chip__remove" type="button" aria-label="Remove bob@example.com">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="ds-code"><pre>&lt;div class="ws-chip"&gt;
    &lt;span&gt;alice@example.com&lt;/span&gt;
    &lt;button class="ws-chip__remove" type="button"
            aria-label="Remove alice@example.com"&gt;
        &lt;span class="material-symbols-outlined"&gt;close&lt;/span&gt;
    &lt;/button&gt;
&lt;/div&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Empty</td><td>As rendered: an empty <code>.ws-chip-input__list</code> and a field showing the placeholder.</td></tr>
            <tr><td>With chips</td><td>Entirely your code's doing. Nothing populates the list server-side, so pre-existing values need rendering into it on page load.</td></tr>
            <tr><td>Hover</td><td>The field border moves from <code>--border-default</code> to <code>--border-hover</code>; the add button surface shifts to <code>--surface-hover</code>.</td></tr>
            <tr><td>Focus</td><td>The inner input is a standard <code>.ws-input</code>, so it inherits Input's focus ring.</td></tr>
            <tr><td>Invalid entry</td><td>No validation is provided. With <code>type: 'email'</code> the input gets native email semantics, but nothing checks a value before it becomes a chip &mdash; validate in your add handler.</td></tr>
            <tr><td>Duplicate entry</td><td>Not prevented. Guard against it yourself, or the same email can be added repeatedly.</td></tr>
            <tr><td>Disabled</td><td>Not supported. There's no <code>disabled</code> option on the helper.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">Inviting participants to a session. The sketch below covers what the component leaves to you: Enter-to-add, validation, deduplication, an accessible remove button, and a hidden field so the values actually submit.</p>
    <div class="ds-card">
        <?= ws_chip_input('invitees', [
            'label' => 'Invite participants',
            'placeholder' => 'name@company.com',
            'type' => 'email',
            'addIcon' => 'person_add',
            'addText' => 'Add',
        ]) ?>
    </div>
    <div class="ds-code"><pre>const field = document.getElementById('invitees');
const list  = document.getElementById('invitees-list');
const store = document.getElementById('invitees-value');  // your hidden input
const emails = [];

function addEmail() {
    const value = field.value.trim();
    if (!value || !field.checkValidity()) return;   // validate
    if (emails.includes(value)) { field.value = ''; return; }   // dedupe

    emails.push(value);
    store.value = emails.join(',');                  // so the form submits it

    const chip = document.createElement('div');
    chip.className = 'ws-chip';
    chip.innerHTML = `&lt;span&gt;${escapeHtml(value)}&lt;/span&gt;`;

    const remove = document.createElement('button');
    remove.type = 'button';
    remove.className = 'ws-chip__remove';
    remove.setAttribute('aria-label', `Remove ${value}`);   // names the chip
    remove.innerHTML = '&lt;span class="material-symbols-outlined"&gt;close&lt;/span&gt;';
    remove.addEventListener('click', () =&gt; {
        emails.splice(emails.indexOf(value), 1);
        store.value = emails.join(',');
        chip.remove();
        field.focus();          // never strand focus on a removed element
    });

    chip.appendChild(remove);
    list.appendChild(chip);
    field.value = '';
    field.focus();
}

// Enter should add — users will expect it, and it isn't wired for you.
field.addEventListener('keydown', e =&gt; {
    if (e.key === 'Enter') { e.preventDefault(); addEmail(); }
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
            <tr><td><code>$name</code></td><td>string</td><td><code>''</code></td><td>Positional. Field name and the ID prefix &mdash; the list container becomes <code>{name}-list</code>.</td></tr>
            <tr><td><code>label</code></td><td>string</td><td><code>null</code></td><td>Label text</td></tr>
            <tr><td><code>optional</code></td><td>bool</td><td><code>false</code></td><td>Appends "(optional)" to the label. Workshopr defaults to required, so this is how an optional field is marked</td></tr>
            <tr><td><code>placeholder</code></td><td>string</td><td><code>'Add item...'</code></td><td>Input placeholder</td></tr>
            <tr><td><code>type</code></td><td>string</td><td><code>'text'</code></td><td><code>email</code> | <code>text</code>. Sets the input type, giving email fields the right keyboard on mobile.</td></tr>
            <tr><td><code>addIcon</code></td><td>string</td><td><code>'add'</code></td><td>Icon on the add button</td></tr>
            <tr><td><code>addText</code></td><td>string</td><td><code>null</code></td><td>Text on the add button. Without it the button is icon-only and falls back to an <code>aria-label</code> derived from <code>label</code>.</td></tr>
            <tr><td><code>removeIcon</code></td><td>string</td><td><code>'close'</code></td><td>Intended for the chip remove button. Since chips are yours to render, this is advisory.</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>$name</code></td><td>Element ID</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra HTML attributes</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <p class="ds-section-desc">Because the behaviour is yours, so is most of the accessibility. The list below separates what the component gives you from what your code has to add.</p>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Label binding</td><td>Correctly wired: the template emits <code>&lt;label for="{id}-input"&gt;</code> bound to the field. Passing <code>label</code> gives the input a proper accessible name &mdash; unlike <a href="<?= $ds_base ?>/components/demos/form-row.php">Form Row</a>, which doesn't bind. Omit <code>label</code> and the field is unnamed, so supply one or pass <code>attrs =&gt; ['aria-label' =&gt; …]</code>.</td></tr>
            <tr><td>Add button</td><td>A real <code>&lt;button type="button"&gt;</code>, so it won't accidentally submit the form. With <code>addText</code> it's named by its visible text; without, it falls back to <code>aria-label="Add {label}"</code> so an icon-only button still has a name.</td></tr>
            <tr><td>Enter to add</td><td>Not implemented. Users will press Enter; wire it, and call <code>preventDefault()</code> so it doesn't submit the form.</td></tr>
            <tr><td>Remove buttons</td><td>Yours to render. Give each an <code>aria-label</code> naming the value &mdash; "Remove alice@example.com". A column of buttons all labelled "Remove" is unusable by screen reader.</td></tr>
            <tr><td>Focus after removal</td><td>Removing a chip destroys the focused element and drops focus to <code>&lt;body&gt;</code>. Move focus back to the input, as in the example above.</td></tr>
            <tr><td>Announcing changes</td><td>Chips appear and disappear silently. Consider a visually-hidden <code>aria-live="polite"</code> region announcing "alice@example.com added" so the action is confirmed non-visually.</td></tr>
            <tr><td>Submitting values</td><td>Chips are <code>&lt;div&gt;</code>s, not form controls &mdash; they submit nothing. Maintain a hidden input, or the user's carefully built list is lost on submit.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--surface-default</code> / <code>--surface-hover</code></td><td>Chip and add-button backgrounds</td></tr>
            <tr><td><code>--border-default</code> / <code>--border-hover</code></td><td>Field and chip borders</td></tr>
            <tr><td><code>--color-ink</code></td><td>Chip and label text</td></tr>
            <tr><td><code>--radius-sm</code></td><td>Chip corners</td></tr>
            <tr><td><code>--space-2</code></td><td>Gap between chips and internal padding</td></tr>
            <tr><td><code>--text-small</code></td><td>Chip text and label type scale</td></tr>
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
            <tr><td><code>.ws-chip-input__label</code></td><td>Field label, bound to the input via <code>for="{id}-input"</code></td></tr>
            <tr><td><code>.ws-chip-input__field</code></td><td>Row holding the input and add button</td></tr>
            <tr><td><code>.ws-chip-input__add</code></td><td>Add button</td></tr>
            <tr><td><code>.ws-chip-input__list</code></td><td>Container your chips render into, <code>id="{name}-list"</code></td></tr>
            <tr><td><code>.ws-chip</code></td><td>An individual chip. Styled here, rendered by you.</td></tr>
            <tr><td><code>.ws-chip__remove</code></td><td>Chip remove button</td></tr>
        </tbody>
    </table>
    <p class="ds-section-desc">The inner input also carries <code class="ds-code-inline">.ws-input</code>, so it inherits every Input state and token.</p>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_chip_input()</code> helper function</td></tr>
            <tr><td><code>includes/components/chip-input.php</code></td><td>Template &mdash; label, field, add button, empty list</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-chip</code> and <code>.ws-chip-input</code> rules)</td></tr>
        </tbody>
    </table>
    <p class="ds-section-desc">There is deliberately no JS file in this list &mdash; the interaction layer doesn't exist yet.</p>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
