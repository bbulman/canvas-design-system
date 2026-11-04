<?php
$ds_page  = 'components/demos/radio-card-group';
$ds_title = 'Radio Card Group';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Radio Card Group</h1>
    <p>A one-from-many picker where each option is a card, so the choices are visible without opening anything.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            The user picks exactly one of two to eight options and seeing them all at once helps &mdash; export formats, workshop templates, session types. The icons and descriptions do work a dropdown can't.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            There are many options or they're purely textual &mdash; use <a href="<?= $ds_base ?>/components/demos/select.php">Select</a>. For multiple selection use <a href="<?= $ds_base ?>/components/demos/checkbox-card-group.php">Checkbox Card Group</a>; for switching views rather than choosing a value, <a href="<?= $ds_base ?>/components/demos/tabs.php">Tabs</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Four columns (default)</h3>
        <p class="ds-section-desc">Best for short labels with icons. Exactly one item should carry <code class="ds-code-inline">checked</code>.</p>
        <div class="ds-card">
            <?= ws_radio_card_group('exportFormat', [
                ['value' => 'pdf', 'label' => 'PDF Document', 'icon' => 'description', 'checked' => true],
                ['value' => 'docx', 'label' => 'Word Document', 'icon' => 'article'],
                ['value' => 'markdown', 'label' => 'Markdown', 'icon' => 'code'],
                ['value' => 'excel', 'label' => 'Excel', 'icon' => 'table_chart'],
            ], ['label' => 'Select format']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_radio_card_group('exportFormat', [
    ['value' => 'pdf',      'label' => 'PDF Document',  'icon' => 'description', 'checked' => true],
    ['value' => 'docx',     'label' => 'Word Document', 'icon' => 'article'],
    ['value' => 'markdown', 'label' => 'Markdown',      'icon' => 'code'],
], ['label' => 'Select format']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Three columns with descriptions</h3>
        <p class="ds-section-desc">Fewer columns give each card room for a description. Use it when the label alone doesn't distinguish the options.</p>
        <div class="ds-card">
            <?= ws_radio_card_group('templateType', [
                ['value' => 'design', 'label' => 'Design Sprint', 'icon' => 'palette', 'description' => '5-day process', 'checked' => true],
                ['value' => 'retro', 'label' => 'Retrospective', 'icon' => 'replay', 'description' => '60&ndash;90 minutes'],
                ['value' => 'ideation', 'label' => 'Ideation', 'icon' => 'lightbulb', 'description' => '2&ndash;3 hours'],
            ], ['columns' => 3, 'label' => 'Template type']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_radio_card_group('templateType', $items, [
    'columns' => 3,
    'label'   => 'Template type',
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Two columns</h3>
        <p class="ds-section-desc">For a binary choice that still deserves explanation. If neither option needs a description, a <a href="<?= $ds_base ?>/components/demos/toggle.php">Toggle</a> is lighter.</p>
        <div class="ds-card">
            <?= ws_radio_card_group('sessionMode', [
                ['value' => 'inperson', 'label' => 'In person', 'icon' => 'groups', 'description' => 'Everyone in the same room', 'checked' => true],
                ['value' => 'remote', 'label' => 'Remote', 'icon' => 'videocam', 'description' => 'Distributed over video'],
            ], ['columns' => 2, 'label' => 'How will you run it?']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_radio_card_group('sessionMode', $items, ['columns' => 2]) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Unselected</td><td>Default card treatment, driven by the input's unchecked state rather than a class.</td></tr>
            <tr><td>Selected</td><td>Set by <code>checked</code> on the item. Styling follows the native <code>:checked</code> pseudo-class, so it stays correct after the user interacts &mdash; no JS keeps it in sync.</td></tr>
            <tr><td>Hover</td><td>Border and background shift on the card label.</td></tr>
            <tr><td>Focus</td><td>The real radio input receives focus and its ring shows on the card. Don't hide the input with <code>display: none</code> &mdash; that removes it from the tab order.</td></tr>
            <tr><td>Disabled</td><td><code>disabled</code> on an item sets the native attribute, so the option is skipped by keyboard and can't be chosen.</td></tr>
            <tr><td>Nothing checked</td><td>Valid but rarely wanted &mdash; the group renders with no selection. Mark a sensible default unless "no choice yet" is meaningful.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The export dialog: format options rendered from config, the user's last choice pre-selected, and the group inside a form so the value posts under the group name.</p>
    <div class="ds-card">
        <?= ws_radio_card_group('exportTarget', [
            ['value' => 'pdf', 'label' => 'PDF', 'icon' => 'picture_as_pdf', 'description' => 'Print-ready agenda', 'checked' => true],
            ['value' => 'miro', 'label' => 'Miro', 'icon' => 'dashboard', 'description' => 'Board with sticky notes'],
            ['value' => 'ics', 'label' => 'Calendar', 'icon' => 'event', 'description' => 'One event per activity'],
        ], ['columns' => 3, 'label' => 'Export as']) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_radio_card_group('exportTarget', array_map(fn($f) => [
    'value'       => $f['key'],
    'label'       => $f['name'],
    'icon'        => $f['icon'],
    'description' => $f['blurb'],
    'checked'     => $f['key'] === ($prefs['last_export'] ?? 'pdf'),
], $formats), ['columns' => 3, 'label' => 'Export as']) ?&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>

    <h3 class="ds-subsection-title">Group options</h3>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>$name</code></td><td>string</td><td><code>''</code></td><td>First positional. The shared radio name &mdash; what makes the options mutually exclusive, and the key the value posts under.</td></tr>
            <tr><td><code>$items</code></td><td>array</td><td><code>[]</code></td><td>Second positional. The option definitions.</td></tr>
            <tr><td><code>label</code></td><td>string</td><td><code>null</code></td><td>Group label. <strong>Not programmatically associated</strong> &mdash; see Accessibility.</td></tr>
            <tr><td><code>columns</code></td><td>int</td><td><code>4</code></td><td><code>2</code> | <code>3</code> | <code>4</code></td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>'{name}-group'</code></td><td>Container ID</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
        </tbody>
    </table>

    <h3 class="ds-subsection-title">Item options</h3>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>value</code></td><td>string</td><td><code>''</code></td><td>Submitted value</td></tr>
            <tr><td><code>label</code></td><td>string</td><td><code>''</code></td><td>Card title</td></tr>
            <tr><td><code>icon</code></td><td>string</td><td><code>null</code></td><td>Material icon above the label</td></tr>
            <tr><td><code>description</code></td><td>string</td><td><code>null</code></td><td>Supporting line. Best at two or three columns.</td></tr>
            <tr><td><code>checked</code></td><td>bool</td><td><code>false</code></td><td>Pre-selected. Mark exactly one.</td></tr>
            <tr><td><code>disabled</code></td><td>bool</td><td><code>false</code></td><td>Native disabled state</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Semantics</td><td>Real <code>&lt;input type="radio"&gt;</code> elements sharing one <code>name</code>. Grouping, arrow-key navigation, and form submission are all native &mdash; a genuine strength over a div-based picker.</td></tr>
            <tr><td>Keyboard</td><td>Native radio behaviour: <kbd>Tab</kbd> enters the group at the selected option, then <kbd>←</kbd>/<kbd>→</kbd>/<kbd>↑</kbd>/<kbd>↓</kbd> move between options and select as they go. Nothing custom is needed, and nothing custom is present.</td></tr>
            <tr><td>Labelling per option</td><td>Each card is a <code>&lt;label&gt;</code> wrapping its input, so the whole card is both the click target and the accessible name. Icon, title, and description are all announced.</td></tr>
            <tr><td>Group label</td><td><strong>Not associated.</strong> The <code>label</code> option renders as a plain element with no <code>&lt;fieldset&gt;</code>/<code>&lt;legend&gt;</code> and no <code>role="radiogroup"</code> with <code>aria-labelledby</code>. Screen-reader users hear each option but not what the group is asking. Wrap the call in your own <code>&lt;fieldset&gt;&lt;legend&gt;</code> when the question isn't obvious from surrounding text.</td></tr>
            <tr><td>Focus</td><td>Comes from the input. Keep it in the accessibility tree &mdash; visually-hidden techniques are fine, <code>display: none</code> is not.</td></tr>
            <tr><td>Contrast</td><td>The selected state is marked by border and background together, not colour alone.</td></tr>
        </tbody>
    </table>
    <div class="ds-code"><pre>&lt;fieldset&gt;
    &lt;legend&gt;Select format&lt;/legend&gt;
    &lt;?= ws_radio_card_group('exportFormat', $items) ?&gt;
&lt;/fieldset&gt;</pre></div>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--color-ink-secondary</code></td><td>Group label colour</td></tr>
            <tr><td><code>--text-small</code></td><td>Group label size</td></tr>
            <tr><td><code>--space-3</code></td><td>Grid gap between cards</td></tr>
        </tbody>
    </table>
    <p class="ds-section-desc">The cards themselves inherit surface, border, and radius tokens from the shared card rules rather than defining their own.</p>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-radio-card-group</code></td><td>Grid container</td></tr>
            <tr><td><code>.ws-radio-card-group--cols-2 / --cols-3 / --cols-4</code></td><td>Column count</td></tr>
            <tr><td><code>.ws-radio-card-group__label</code></td><td>Group label (unassociated &mdash; see Accessibility)</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_radio_card_group()</code> helper function</td></tr>
            <tr><td><code>includes/components/radio-card-group.php</code></td><td>Template &mdash; grid and per-option label/input markup</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-radio-card-group</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
