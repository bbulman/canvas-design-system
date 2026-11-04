<?php
$ds_page  = 'components/demos/prompt-select';
$ds_title = 'Prompt Select';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Prompt Select</h1>
    <p>A dropdown that reads as the end of a sentence &mdash; "I need help with [Goal&hellip;]" &mdash; for conversational navigation.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            A hero or landing section should route the reader by intent rather than by menu. The phrasing does the work: the prompt sets up a sentence and the dropdown completes it.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            It's a form field &mdash; use <a href="<?= $ds_base ?>/components/demos/select.php">Select</a>, which has proper label, error, and helper wiring. Past six to eight options, a search input or a listing page serves better.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Default</h3>
        <p class="ds-section-desc">Brand-bordered dropdown with the serif-italic prompt. The first option doubles as the placeholder, so give it an empty value.</p>
        <div class="ds-card" style="max-width: 520px;">
            <?= ws_prompt_select('I need help with', 'demoGoal', [
                '' => 'Goal…',
                'team-building' => 'Team Building',
                'ideation' => 'Ideation',
                'strategy' => 'Strategic Planning',
                'feedback' => 'Giving Feedback',
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_prompt_select('I need help with', 'goalSelect', [
    ''              => 'Goal…',
    'team-building' => 'Team Building',
    'ideation'      => 'Ideation',
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Muted</h3>
        <p class="ds-section-desc">Grey border and subdued prompt, for a secondary instance or one sitting on an already-busy surface.</p>
        <div class="ds-card" style="max-width: 520px;">
            <?= ws_prompt_select('Filter by', 'demoFilter', [
                '' => 'Category…',
                'design' => 'Design',
                'leadership' => 'Leadership',
                'agile' => 'Agile',
            ], ['variant' => 'muted']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_prompt_select('Filter by', 'filterSelect', $opts, ['variant' => 'muted']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Responsive</h3>
        <p class="ds-section-desc">Below 480px the row stacks: the prompt moves above the dropdown at a reduced size, and the dropdown goes full width. Nothing to configure.</p>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <div class="ds-card" style="max-width: 520px;">
        <?= ws_prompt_select('Most popular', 'demoPopular', [
            '' => 'Workshops, exercises…',
            'workshops' => 'Workshops',
            'exercises' => 'Exercises',
            'icebreakers' => 'Icebreakers',
        ], ['onchange' => "alert('Navigate to: ' + this.value)"]) ?>
    </div>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>Native <code>&lt;select&gt;</code> with the brand border and a custom chevron.</td></tr>
            <tr><td>Focus</td><td><code>--focus-ring-width</code> and <code>--focus-ring-offset</code>, the platform's shared focus geometry.</td></tr>
            <tr><td>Changed</td><td>The <code>onchange</code> string runs as an inline handler. Because this component navigates rather than collects, that's usually where the routing happens &mdash; try it above.</td></tr>
            <tr><td>Pre-selected</td><td><code>value</code> marks the current option. Useful when the prompt reflects a filter already applied.</td></tr>
            <tr><td>Disabled</td><td>Not supported &mdash; there's no <code>disabled</code> option.</td></tr>
            <tr><td>Error</td><td>Not supported. Another reason this isn't a form control: there's nowhere to put validation.</td></tr>
        </tbody>
    </table>
    <div class="ds-code"><pre>&lt;?= ws_prompt_select('Most popular', 'popularSelect', $opts, [
    'onchange' => 'goToPopular(this)',
]) ?&gt;</pre></div>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The homepage hero's intent router: goals come from the database, and selecting one navigates straight to that goal's collection. Note the <code class="ds-code-inline">aria-label</code> passed through to give the select an accessible name &mdash; see Accessibility for why that's necessary.</p>
    <div class="ds-card" style="max-width: 520px;">
        <?= ws_prompt_select('I need help with', 'heroGoal', [
            '' => 'Goal…',
            'alignment' => 'Getting the team aligned',
            'ideas' => 'Generating new ideas',
            'decisions' => 'Making a decision',
            'retro' => 'Learning from what happened',
        ]) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_prompt_select('I need help with', 'heroGoal', $goalOptions, [
    'onchange' => 'if (this.value) location.href = "/library/goals/" + this.value;',
]) ?&gt;

&lt;script&gt;
// The prompt is a &lt;span&gt;, so name the control explicitly.
document.getElementById('heroGoal')
        .setAttribute('aria-label', 'I need help with');
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
            <tr><td><code>$label</code></td><td>string</td><td><code>''</code></td><td>First positional. The prompt, rendered serif-italic. Write it so the option completes the sentence.</td></tr>
            <tr><td><code>$name</code></td><td>string</td><td><code>''</code></td><td>Second positional. Field name and default ID.</td></tr>
            <tr><td><code>$selectOptions</code></td><td>array</td><td><code>[]</code></td><td>Third positional. Flat <code>value =&gt; label</code> pairs, same shape as <a href="<?= $ds_base ?>/components/demos/select.php">Select</a>.</td></tr>
            <tr><td><code>value</code></td><td>string</td><td><code>''</code></td><td>Pre-selected value</td></tr>
            <tr><td><code>onchange</code></td><td>string</td><td><code>''</code></td><td>Inline JS handler, typically the navigation</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>$name</code></td><td>Element ID</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes on the wrapper</td></tr>
            <tr><td><code>variant</code></td><td>string</td><td><code>'default'</code></td><td><code>default</code> | <code>muted</code></td></tr>
        </tbody>
    </table>
    <p class="ds-section-desc">There's no <code class="ds-code-inline">attrs</code> option, so attributes can't be passed to the select directly &mdash; set them from JS using the <code class="ds-code-inline">id</code>.</p>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Semantics</td><td>A native <code>&lt;select&gt;</code>, so keyboard operation, type-ahead, and the mobile picker are all native.</td></tr>
            <tr><td>Labelling</td><td><strong>Missing.</strong> The prompt renders as <code>&lt;span class="ws-prompt-select__label"&gt;</code>, not a <code>&lt;label for&gt;</code>, and no <code>aria-label</code> is emitted. The select therefore has no accessible name &mdash; a screen reader announces an unnamed combo box. Set <code>aria-label</code> from JS using the element's <code>id</code>, as shown above.</td></tr>
            <tr><td>Click target</td><td>Because the prompt isn't a real label, clicking it doesn't open the dropdown &mdash; a usability loss for everyone.</td></tr>
            <tr><td>Keyboard</td><td><kbd>Tab</kbd> to reach, arrows or typing to change. Standard.</td></tr>
            <tr><td>Navigate on change</td><td>Changing the value navigates away. Keyboard users move through options with arrows, which fires <code>change</code> on each one &mdash; on some browsers that means navigating before they reach their choice. Prefer a <code>Go</code> button, or navigate on <code>blur</code> instead.</td></tr>
            <tr><td>Placeholder option</td><td>Give the first option an empty value so the handler can guard against it, as in the example.</td></tr>
            <tr><td>Contrast</td><td>Default and muted variants both pair tested border and text tokens.</td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">warning</span>
        <span>Two fixes worth making in the template: render the prompt as <code>&lt;label for="{id}"&gt;</code> rather than a span (which solves naming and click-to-open at once), and accept an <code>attrs</code> option so callers can pass ARIA without JavaScript.</span>
    </div>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--color-primary</code></td><td>Default variant border</td></tr>
            <tr><td><code>--gray-200</code></td><td>Muted variant border</td></tr>
            <tr><td><code>--bg-surface</code></td><td>Select background</td></tr>
            <tr><td><code>--color-ink</code> / <code>--color-ink-muted</code></td><td>Prompt and muted-prompt colour</td></tr>
            <tr><td><code>--focus-ring-width</code> / <code>--focus-ring-offset</code></td><td>Focus ring geometry</td></tr>
            <tr><td><code>--text-body</code> / <code>--text-ui</code></td><td>Prompt and option type scale</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-prompt-select</code></td><td>Flex wrapper, stacking below 480px</td></tr>
            <tr><td><code>.ws-prompt-select--muted</code></td><td>Muted variant</td></tr>
            <tr><td><code>.ws-prompt-select__label</code></td><td>Serif-italic prompt (a <code>&lt;span&gt;</code> &mdash; see Accessibility)</td></tr>
            <tr><td><code>.ws-prompt-select__dropdown</code></td><td>Positioning context for the select and chevron</td></tr>
            <tr><td><code>.ws-prompt-select__select</code></td><td>The native <code>&lt;select&gt;</code></td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_prompt_select()</code> helper function</td></tr>
            <tr><td><code>includes/components/prompt-select.php</code></td><td>Template &mdash; prompt, select, and chevron markup</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-prompt-select</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
