<?php
$ds_page  = 'components/demos/checkbox-card-group';
$ds_title = 'Checkbox Card Group';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Checkbox Card Group</h1>
    <p>A stacked list of independent on/off options, each with an icon, a title, and an explanation.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            The user selects any number of independent options that apply together &mdash; cleanup operations, feature opt-ins, batch actions. Each row explains what it will do before the user commits.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            Only one option can apply &mdash; use <a href="<?= $ds_base ?>/components/demos/radio-card-group.php">Radio Card Group</a>. For a single setting that takes effect immediately use <a href="<?= $ds_base ?>/components/demos/toggle.php">Toggle</a>; for a list with no input, <a href="<?= $ds_base ?>/components/demos/checklist.php">Checklist</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Default</h3>
        <p class="ds-section-desc">One row per option. Pre-check the ones that are safe by default and leave the consequential ones off &mdash; here, reordering the agenda is opt-in.</p>
        <div class="ds-card">
            <?= ws_checkbox_card_group([
                ['id' => 'roundDurations', 'title' => 'Round durations', 'description' => 'Round all activity times to the nearest 5 minutes', 'icon' => 'schedule', 'iconColor' => 'blue', 'checked' => true],
                ['id' => 'ensureBreaks', 'title' => 'Ensure breaks', 'description' => 'Add breaks every 90 minutes of activity', 'icon' => 'coffee', 'iconColor' => 'orange', 'checked' => true],
                ['id' => 'fixFormatting', 'title' => 'Fix formatting', 'description' => 'Clean up titles and descriptions', 'icon' => 'text_format', 'iconColor' => 'purple'],
                ['id' => 'applyStructure', 'title' => 'Apply recommended structure', 'description' => 'Reorder for optimal flow', 'icon' => 'auto_fix_high', 'iconColor' => 'red', 'highlight' => true],
            ], ['label' => 'Cleanup options']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_checkbox_card_group([
    ['id'          => 'roundDurations',
     'title'       => 'Round durations',
     'description' => 'Round all times to the nearest 5 minutes',
     'icon'        => 'schedule',
     'iconColor'   => 'blue',
     'checked'     => true],
    ['id'          => 'applyStructure',
     'title'       => 'Apply recommended structure',
     'description' => 'Reorder for optimal flow',
     'icon'        => 'auto_fix_high',
     'iconColor'   => 'red',
     'highlight'   => true],
], ['label' => 'Cleanup options']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Icon colours</h3>
        <p class="ds-section-desc">Five accent keys: <code class="ds-code-inline">blue</code>, <code class="ds-code-inline">orange</code>, <code class="ds-code-inline">purple</code>, <code class="ds-code-inline">red</code>, <code class="ds-code-inline">green</code>. These are functional coding &mdash; use one colour per category of operation and hold it, rather than cycling for variety.</p>
        <div class="ds-card">
            <?= ws_checkbox_card_group([
                ['id' => 'demoBlue', 'title' => 'Blue', 'description' => 'Timing and scheduling operations', 'icon' => 'schedule', 'iconColor' => 'blue'],
                ['id' => 'demoOrange', 'title' => 'Orange', 'description' => 'Structural additions', 'icon' => 'coffee', 'iconColor' => 'orange'],
                ['id' => 'demoPurple', 'title' => 'Purple', 'description' => 'Text and formatting', 'icon' => 'text_format', 'iconColor' => 'purple'],
                ['id' => 'demoRed', 'title' => 'Red', 'description' => 'Destructive or far-reaching changes', 'icon' => 'auto_fix_high', 'iconColor' => 'red'],
                ['id' => 'demoGreen', 'title' => 'Green', 'description' => 'Additive, safe operations', 'icon' => 'add_circle', 'iconColor' => 'green'],
            ], ['label' => 'Accent keys']) ?>
        </div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Unchecked</td><td>Default row treatment, driven by the input's native state.</td></tr>
            <tr><td>Checked</td><td>Set by <code>checked</code> on the item and maintained by the native <code>:checked</code> pseudo-class &mdash; no JS keeps it in sync.</td></tr>
            <tr><td>Highlight</td><td><code>highlight: true</code> gives a row a featured treatment. Use it for the option with the largest consequence, not for the recommended one.</td></tr>
            <tr><td>Hover</td><td>Row background shifts; the whole row is the click target because the label wraps it.</td></tr>
            <tr><td>Focus</td><td>The real checkbox takes focus and shows its ring on the row.</td></tr>
            <tr><td>Disabled</td><td><strong>Not supported.</strong> Unlike <a href="<?= $ds_base ?>/components/demos/radio-card-group.php">Radio Card Group</a>, items have no <code>disabled</code> option. Omit an unavailable option, or explain in its description why it can't be used.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The Planner's agenda cleanup modal: the safe operations start checked, the one that reorders the user's work does not, and it carries <code class="ds-code-inline">highlight</code> so it reads as the significant choice.</p>
    <div class="ds-card">
        <?= ws_checkbox_card_group([
            ['id' => 'realRound', 'title' => 'Round durations', 'description' => 'Nearest 5 minutes, so timings read cleanly', 'icon' => 'schedule', 'iconColor' => 'blue', 'checked' => true],
            ['id' => 'realBreaks', 'title' => 'Ensure breaks', 'description' => 'Insert a break after every 90 minutes of activity', 'icon' => 'coffee', 'iconColor' => 'orange', 'checked' => true],
            ['id' => 'realReorder', 'title' => 'Reorder for energy flow', 'description' => 'Moves your activities. Review the result before saving.', 'icon' => 'auto_fix_high', 'iconColor' => 'red', 'highlight' => true],
        ], ['label' => 'What should we clean up?']) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_checkbox_card_group($operations, ['label' => 'What should we clean up?']) ?&gt;

&lt;script&gt;
// Item `id` becomes the checkbox id — read them back by that.
const selected = $operations
    .map(op =&gt; op.id)
    .filter(id =&gt; document.getElementById(id).checked);
&lt;/script&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>

    <h3 class="ds-subsection-title">Group options</h3>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>$items</code></td><td>array</td><td><code>[]</code></td><td>Positional. The option definitions.</td></tr>
            <tr><td><code>label</code></td><td>string</td><td><code>null</code></td><td>Group label. <strong>Not programmatically associated</strong> &mdash; see Accessibility.</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>null</code></td><td>Container ID</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
        </tbody>
    </table>

    <h3 class="ds-subsection-title">Item options</h3>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>id</code></td><td>string</td><td><code>''</code></td><td>Required in practice &mdash; it becomes the checkbox's <code>id</code> and the handle you read the value back by. Each must be unique on the page.</td></tr>
            <tr><td><code>title</code></td><td>string</td><td><code>''</code></td><td>Row title. Phrase it as the action: "Round durations".</td></tr>
            <tr><td><code>description</code></td><td>string</td><td><code>''</code></td><td>What checking it will do</td></tr>
            <tr><td><code>icon</code></td><td>string</td><td><code>null</code></td><td>Material icon name</td></tr>
            <tr><td><code>iconColor</code></td><td>string</td><td><code>'blue'</code></td><td><code>blue</code> | <code>orange</code> | <code>purple</code> | <code>red</code> | <code>green</code></td></tr>
            <tr><td><code>checked</code></td><td>bool</td><td><code>false</code></td><td>Initially checked</td></tr>
            <tr><td><code>highlight</code></td><td>bool</td><td><code>false</code></td><td>Featured row treatment</td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">info</span>
        <span>There's no group <code>name</code>, so the checkboxes aren't submitted as an array. Read them back individually by their <code>id</code>, as in the example above.</span>
    </div>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Semantics</td><td>Real <code>&lt;input type="checkbox"&gt;</code> elements, so checked state, focusability, and keyboard operation are all native.</td></tr>
            <tr><td>Keyboard</td><td><kbd>Tab</kbd> between rows, <kbd>Space</kbd> to toggle. Each checkbox is its own tab stop, which is correct for independent options.</td></tr>
            <tr><td>Labelling per option</td><td>The row is a <code>&lt;label&gt;</code> wrapping its input, so title and description are both part of the accessible name and the whole row is clickable.</td></tr>
            <tr><td>Group label</td><td><strong>Not associated.</strong> Like <a href="<?= $ds_base ?>/components/demos/radio-card-group.php">Radio Card Group</a>, the <code>label</code> renders as a plain element with no <code>&lt;fieldset&gt;</code>/<code>&lt;legend&gt;</code> and no <code>role="group"</code> with <code>aria-labelledby</code>. Wrap the call yourself when the question matters.</td></tr>
            <tr><td>Icon colour</td><td>Decorative. The five accents carry no meaning to assistive tech, so never let colour be the only thing distinguishing two rows &mdash; the title and description must stand alone.</td></tr>
            <tr><td>Highlight</td><td>Visual only, with no text equivalent. If a row is highlighted because it's consequential, say so in the description.</td></tr>
        </tbody>
    </table>
    <div class="ds-code"><pre>&lt;fieldset&gt;
    &lt;legend&gt;What should we clean up?&lt;/legend&gt;
    &lt;?= ws_checkbox_card_group($operations) ?&gt;
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
        </tbody>
    </table>
    <p class="ds-section-desc">The rows lean on the shared card and toggle rules for surface, border, and the five icon accents rather than defining tokens of their own.</p>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-checkbox-card-group</code></td><td>Stacked container</td></tr>
            <tr><td><code>.ws-checkbox-card-group__label</code></td><td>Group label (unassociated &mdash; see Accessibility)</td></tr>
        </tbody>
    </table>
    <p class="ds-section-desc">Row-level styling comes from the shared checkbox-card rules rather than a per-row modifier &mdash; which is why the class list here is short.</p>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_checkbox_card_group()</code> helper function</td></tr>
            <tr><td><code>includes/components/checkbox-card-group.php</code></td><td>Template &mdash; row markup and icon accent mapping</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-checkbox-card-group</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
