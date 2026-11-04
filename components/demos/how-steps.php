<?php
$ds_page  = 'components/demos/how-steps';
$ds_title = 'How Steps';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>How Steps</h1>
    <p>Explains a short flow as two to four numbered steps.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            A marketing or onboarding page needs to show that something is simple &mdash; quiz flows, product explainers, getting-started sections. The numbering is the point: it promises the whole thing is this short.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The steps track real completion &mdash; that needs <a href="<?= $ds_base ?>/components/demos/progress.php">Progress</a> or <a href="<?= $ds_base ?>/components/demos/task-checklist.php">Task Checklist</a>. For parallel capabilities with no order, use <a href="<?= $ds_base ?>/components/demos/feature-card.php">Feature Card</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Three columns (default)</h3>
        <p class="ds-section-desc">Three is the sweet spot &mdash; enough to show a process, few enough to still read as easy.</p>
        <div class="ds-card">
            <?= ws_how_steps([
                ['title' => 'Take the quiz', 'description' => 'Answer 15 quick questions about how you facilitate.', 'icon' => 'quiz'],
                ['title' => 'Get your DNA', 'description' => 'Discover your archetype and what makes it work.', 'icon' => 'insights'],
                ['title' => 'Level up', 'description' => 'Apply tailored tips in your next workshop.', 'icon' => 'emoji_events'],
            ], ['color' => 'learn', 'columns' => 3]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_how_steps([
    ['title' => 'Take the quiz', 'description' => 'Answer 15 questions…', 'icon' => 'quiz'],
    ['title' => 'Get your DNA',  'description' => 'Discover your archetype…', 'icon' => 'insights'],
    ['title' => 'Level up',      'description' => 'Apply tailored tips…', 'icon' => 'emoji_events'],
], ['color' => 'learn', 'columns' => 3]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Two columns with custom badges</h3>
        <p class="ds-section-desc">Steps auto-number as <code class="ds-code-inline">01</code>, <code class="ds-code-inline">02</code>&hellip; unless you pass a <code class="ds-code-inline">badge</code>. Override it when the sequence isn't really numeric &mdash; phases, or before/during/after.</p>
        <div class="ds-card">
            <?= ws_how_steps([
                ['title' => 'Before the session', 'description' => 'Prep your agenda and share the join link.', 'badge' => 'A'],
                ['title' => 'During the session', 'description' => 'Run the timer and capture decisions live.', 'badge' => 'B'],
            ], ['color' => 'plan', 'columns' => 2]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_how_steps([
    ['title' => 'Before the session', 'description' => '…', 'badge' => 'A'],
    ['title' => 'During the session', 'description' => '…', 'badge' => 'B'],
], ['color' => 'plan', 'columns' => 2]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Four columns</h3>
        <p class="ds-section-desc">The maximum. Beyond four the grid stops reading as a simple flow &mdash; if you need more, the process probably needs its own page.</p>
        <div class="ds-card">
            <?= ws_how_steps([
                ['title' => 'Learn', 'description' => 'Browse the library.', 'icon' => 'school'],
                ['title' => 'Plan', 'description' => 'Build the agenda.', 'icon' => 'edit_note'],
                ['title' => 'Facilitate', 'description' => 'Run the room.', 'icon' => 'groups'],
                ['title' => 'Reflect', 'description' => 'Turn notes into a readout.', 'icon' => 'hub'],
            ], ['columns' => 4]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_how_steps($steps, ['columns' => 4]) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>The only state. Steps are static and non-interactive &mdash; no hover, focus, current, or completed treatment.</td></tr>
            <tr><td>No completion tracking</td><td>Every step looks identical regardless of the user's progress. If a step should read as done, this isn't the component.</td></tr>
            <tr><td>Missing icon</td><td>The badge number still renders; only the icon is omitted. Use icons on all steps or none.</td></tr>
            <tr><td>Auto-numbering</td><td>Zero-padded from the item's index &mdash; the first step is <code>01</code>. Reordering the array renumbers automatically.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The Facilitator DNA landing page, between the hero and the CTA. Three steps, icons throughout, each description one sentence &mdash; matched lengths keep the cards the same height.</p>
    <div class="ds-card">
        <?= ws_how_steps([
            ['title' => 'Answer honestly', 'description' => 'Fifteen questions about how you actually run a room.', 'icon' => 'quiz'],
            ['title' => 'Meet your archetype', 'description' => 'See the strengths you lean on and the ones you skip.', 'icon' => 'fingerprint'],
            ['title' => 'Put it to work', 'description' => 'Get exercises picked for the way you facilitate.', 'icon' => 'rocket_launch'],
        ], ['columns' => 3]) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_section_header('How it works', ['align' => 'center']) ?&gt;
&lt;?= ws_how_steps($dnaSteps, ['columns' => 3]) ?&gt;
&lt;?= ws_cta_section('Discover your Facilitator DNA', [
    'primaryBtn' => ['text' => 'Take the quiz', 'href' => '/dna/'],
]) ?&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>

    <h3 class="ds-subsection-title">Group options</h3>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>$steps</code></td><td>array</td><td><code>[]</code></td><td>Positional. The step definitions, in order.</td></tr>
            <tr><td><code>color</code></td><td>string</td><td><code>'learn'</code></td><td><code>learn</code> | <code>plan</code> | <code>facilitate</code> | <code>reflect</code> | <code>neutral</code>. The four phase keys render identically since Red Unification.</td></tr>
            <tr><td><code>columns</code></td><td>int</td><td><code>3</code></td><td><code>2</code> | <code>3</code> | <code>4</code></td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes on the container</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra HTML attributes on the container</td></tr>
        </tbody>
    </table>

    <h3 class="ds-subsection-title">Step options</h3>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>title</code></td><td>string</td><td><code>''</code></td><td>Step title. A verb phrase reads best: "Take the quiz".</td></tr>
            <tr><td><code>description</code></td><td>string</td><td><code>''</code></td><td>One sentence. Keep lengths even across the row.</td></tr>
            <tr><td><code>icon</code></td><td>string</td><td><code>null</code></td><td>Material icon name</td></tr>
            <tr><td><code>badge</code></td><td>string</td><td><code>sprintf('%02d', $index + 1)</code></td><td>Overrides the auto-number</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Headings</td><td>Each step title is a real <code>&lt;h3&gt;</code>, so steps appear in the document outline and can be navigated by heading. Check that <code>h3</code> is the right level where you place the component &mdash; it isn't configurable.</td></tr>
            <tr><td>Keyboard</td><td>Nothing is focusable, which is correct &mdash; the steps are explanatory, not interactive.</td></tr>
            <tr><td>Sequence</td><td><strong>Minor gap:</strong> steps are <code>&lt;div&gt;</code>s in a grid rather than an <code>&lt;ol&gt;</code>, so the sequence isn't conveyed structurally &mdash; no "1 of 3" announcement. The visible badge is read as text, which mitigates it, but an ordered list would be more robust.</td></tr>
            <tr><td>Badges</td><td>Rendered as text, so "01" is announced. Custom badges should be readable out loud &mdash; a bare glyph or symbol won't be.</td></tr>
            <tr><td>Icons</td><td>Decorative. Titles carry the meaning.</td></tr>
            <tr><td>Reading order</td><td>DOM order matches visual order left to right, so the announced sequence matches the numbering.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--brand</code> / <code>--phase-facilitate</code> / <code>--phase-reflect</code>, with <code>--brand-soft</code> / <code>--phase-plan-light</code> / <code>--phase-facilitate-light</code> / <code>--phase-reflect-light</code></td><td>Badge and icon accent per colour key (learn and plan read <code>--brand</code>)</td></tr>
            <tr><td><code>--gray-100</code> / <code>--gray-200</code></td><td>Neutral key accent and card borders</td></tr>
            <tr><td><code>--color-ink-muted</code></td><td>Description text</td></tr>
            <tr><td><code>--space-4</code> / <code>--space-6</code> / <code>--space-8</code></td><td>Grid gap and internal step spacing</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-how-steps</code></td><td>Grid container</td></tr>
            <tr><td><code>.ws-how-steps--cols-2 / --cols-3 / --cols-4</code></td><td>Column count</td></tr>
            <tr><td><code>.ws-how-steps--learn / --plan / --facilitate / --reflect / --neutral</code></td><td>Colour keys</td></tr>
            <tr><td><code>.ws-how-step</code></td><td>An individual step</td></tr>
            <tr><td><code>.ws-how-step__header</code></td><td>Badge and icon row</td></tr>
            <tr><td><code>.ws-how-step__body</code></td><td>Title and description block</td></tr>
            <tr><td><code>.ws-how-step__title</code></td><td>The <code>&lt;h3&gt;</code></td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_how_steps()</code> helper function</td></tr>
            <tr><td><code>includes/components/how-steps.php</code></td><td>Template &mdash; grid, auto-numbering, and step markup</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-how-steps</code> and <code>.ws-how-step</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
