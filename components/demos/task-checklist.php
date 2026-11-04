<?php
$ds_page  = 'components/demos/task-checklist';
$ds_title = 'Task Checklist';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Task Checklist</h1>
    <p>Tracks activation tasks against real data, with each undone item linking to the place it gets done.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            A user has setup steps left and each one lives somewhere specific &mdash; the MyWorkshopr Getting Started list is the canonical case. Done state must be computed from real data, never hardcoded.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The list is explanatory rather than tracked &mdash; that's <a href="<?= $ds_base ?>/components/demos/checklist.php">Checklist</a> or <a href="<?= $ds_base ?>/components/demos/how-steps.php">How Steps</a>. For a single proportion use <a href="<?= $ds_base ?>/components/demos/progress.php">Progress</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Full &mdash; progress, phases, descriptions</h3>
        <p class="ds-section-desc">The complete form. Descriptions explain the value of each step and disappear once it's done, so the list gets quieter as the user progresses.</p>
        <div class="ds-card">
            <?= ws_task_checklist([
                ['label' => 'Build your first agenda', 'description' => 'Drag a few activities onto the timeline &mdash; it takes about five minutes.', 'href' => '/planner/', 'done' => true, 'phase' => 'Plan', 'key' => 'build'],
                ['label' => 'Save it so it\'s yours anywhere', 'description' => 'A saved agenda opens on any device and can be shared with your team.', 'href' => '/planner/', 'done' => true, 'phase' => 'Plan', 'key' => 'save'],
                ['label' => 'Take the 3-minute DNA quiz', 'description' => 'Find out which of the five facilitator archetypes matches how you run a room.', 'href' => '/dna/', 'done' => false, 'phase' => 'Reflect', 'key' => 'dna'],
                ['label' => 'Find an exercise you\'d actually run', 'description' => 'Browse the library and favourite one for your next session.', 'href' => '/library/', 'done' => false, 'phase' => 'Learn', 'key' => 'library'],
            ], [
                'title' => 'Getting started',
                'subtitle' => 'Four steps to your first workshop that works.',
                'dismissible' => true,
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_task_checklist([
    ['label'       => 'Build your first agenda',
     'description' => 'Drag a few activities onto the timeline.',
     'href'        => '/planner/',
     'done'        => $user-&gt;hasPlan(),
     'phase'       => 'Plan',
     'key'         => 'build'],
], [
    'title'       => 'Getting started',
    'subtitle'    => 'Four steps to your first workshop that works.',
    'dismissible' => true,
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Complete &mdash; the celebration card</h3>
        <p class="ds-section-desc">Every item done, and the card says so: a red-tinted surface, red filled checks, and labels back to full ink. These lines are the achievement being named, not chores being crossed off. Pass past-tense labels, <code class="ds-code-inline">dismissible</code>, and a <code class="ds-code-inline">cta</code> that points forward. Decide deliberately what happens after dismissal &mdash; a finished checklist that never goes away becomes clutter. The app shell's rail journey card (<code class="ds-code-inline">app/includes/rail.php</code>) is the reference consumer.</p>
        <div class="ds-card">
            <?= ws_task_checklist([
                ['label' => 'Built the agenda', 'done' => true, 'phase' => 'Plan'],
                ['label' => 'Ran the session', 'done' => true, 'phase' => 'Facilitate'],
                ['label' => 'Synthesized the results', 'done' => true, 'phase' => 'Synthesize'],
            ], [
                'title'       => "That's one all the way round.",
                'subtitle'    => 'Designed, delivered, synthesized. From here the dashboard reads from your own workshops.',
                'dismissible' => true,
                'cta'         => ['label' => 'Plan the next one', 'href' => '/app/?view=plan&step=home'],
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_task_checklist($doneSteps, [
    'title'       =&gt; "That's one all the way round.",
    'subtitle'    =&gt; 'Designed, delivered, synthesized. From here the dashboard reads from your own workshops.',
    'dismissible' =&gt; true,
    'cta'         =&gt; ['label' =&gt; 'Plan the next one', 'href' =&gt; '/app/?view=plan&amp;step=home'],
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Counted &mdash; a row that names its queue</h3>
        <p class="ds-section-desc">A row can carry a <code class="ds-code-inline">badge</code>: a short count the label needs to say out loud, rendered as a quiet pill after it. Use it where the step is about things the user has waiting, so the row and the number agree, and point the row's <code class="ds-code-inline">href</code> at the first of them rather than at a list to hunt through. A done row with a badge keeps its link and arrow &mdash; the step has been taken once and more is queued behind it.</p>
        <div class="ds-card">
            <?= ws_task_checklist([
                ['label' => 'Build the agenda', 'done' => true, 'href' => '/app/?view=plan&step=home', 'key' => 'build'],
                ['label' => 'Run the session', 'done' => true, 'href' => '/app/?view=facilitate&step=run&plan=42', 'badge' => '2 ready', 'key' => 'run'],
                ['label' => 'Synthesize the results', 'done' => false, 'href' => '/app/?view=synthesize&step=make&plan=42', 'badge' => '3 waiting', 'key' => 'synthesize'],
            ], ['title' => 'Getting started', 'progress' => false]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_task_checklist([
    ['label' =&gt; 'Synthesize the results',
     'done'  =&gt; false,
     'href'  =&gt; '/app/?view=synthesize&amp;step=make&amp;plan=' . $firstWaitingId,
     'badge' =&gt; $waiting . ' waiting',
     'key'   =&gt; 'synthesize'],
], ['title' =&gt; 'Getting started', 'progress' =&gt; false]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Minimal</h3>
        <p class="ds-section-desc">No progress bar, no phases, no descriptions &mdash; for a short list where the count would be noise.</p>
        <div class="ds-card">
            <?= ws_task_checklist([
                ['label' => 'Invite a teammate', 'href' => '/myworkshopr/settings.php#team', 'done' => false],
                ['label' => 'Pick a template', 'href' => '/planner/templates.php', 'done' => false],
            ], ['title' => 'Set up your team', 'progress' => false]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_task_checklist($items, ['title' => 'Set up your team', 'progress' => false]) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Undone</td><td>Renders as a link to <code>href</code> with a hollow icon, its description, and a trailing arrow. This is the actionable state.</td></tr>
            <tr><td>Done</td><td>Filled check in <code>--color-success</code>, description hidden, and no longer a link &mdash; there's nothing left to do there.</td></tr>
            <tr><td>Complete</td><td>All items done adds <code>.ws-task-checklist--complete</code>: red-tinted surface, red checks, labels back to full ink. Pair with <code>dismissible</code> and a forward-pointing <code>cta</code>.</td></tr>
            <tr><td>CTA</td><td><code>cta</code> renders one <code>ws_button</code> inside the card, below the items &mdash; the card travels as one object into a rail or a panel.</td></tr>
            <tr><td>Undone with no <code>href</code></td><td>Renders as plain text. Valid, but the user is then told what to do without being shown where &mdash; supply an <code>href</code>.</td></tr>
            <tr><td>Progress</td><td>On by default: an "x of N done" count and a bar, both computed from the items' <code>done</code> flags. No separate total to keep in sync.</td></tr>
            <tr><td>Dismissed</td><td><code>dismissible</code> renders a button carrying <code>data-checklist-dismiss</code>. <strong>The component doesn't handle the click</strong> &mdash; wire it and persist the choice, or the checklist returns on the next load.</td></tr>
            <tr><td>Hover</td><td>Undone rows lift their background; done rows are inert.</td></tr>
            <tr><td>Focus</td><td>Undone rows are links with a <code>--focus-ring</code> outline.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The MyWorkshopr activation panel. Every <code class="ds-code-inline">done</code> flag is a query against real state &mdash; that's the contract, and it's what stops the list lying to the user.</p>
    <div class="ds-code"><pre>&lt;?php
$hasPlan  = (bool) getPlanCount($userId);
$hasSaved = (bool) getSavedPlanCount($userId);
$hasDna   = (bool) getDnaResult($userId);
$hasFav   = (bool) getFavouriteCount($userId);
$tasks = [
    ['label' => 'Build your first agenda', 'href' => '/planner/',  'done' => $hasPlan,
     'phase' => 'Plan',    'key' => 'build',
     'description' => 'Drag a few activities onto the timeline.'],
    ['label' => 'Save it so it\'s yours anywhere', 'href' => '/planner/', 'done' => $hasSaved,
     'phase' => 'Plan',    'key' => 'save'],
    ['label' => 'Take the 3-minute DNA quiz', 'href' => '/dna/',   'done' => $hasDna,
     'phase' => 'Reflect', 'key' => 'dna'],
    ['label' => 'Find an exercise you\'d actually run', 'href' => '/library/', 'done' => $hasFav,
     'phase' => 'Learn',   'key' => 'library'],
];

// Hide it entirely once everything is done, rather than showing a finished list.
if (in_array(false, array_column($tasks, 'done'), true)):
?&gt;
    &lt;?= ws_task_checklist($tasks, ['title' => 'Getting started', 'dismissible' => true]) ?&gt;
&lt;?php endif; ?&gt;

&lt;script&gt;
document.querySelector('[data-checklist-dismiss]')?.addEventListener('click', async () =&gt; {
    await fetch('/api/prefs.php?action=dismiss_checklist', { method: 'POST' });
    document.querySelector('.ws-task-checklist').remove();
});
&lt;/script&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>

    <h3 class="ds-subsection-title">Checklist options</h3>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>$items</code></td><td>array</td><td><code>[]</code></td><td>Positional. The task definitions, in the order they should be done.</td></tr>
            <tr><td><code>title</code></td><td>string</td><td><code>'Getting started'</code></td><td>Heading, set in Fraunces</td></tr>
            <tr><td><code>subtitle</code></td><td>string</td><td><code>null</code></td><td>Supporting line under the title</td></tr>
            <tr><td><code>progress</code></td><td>bool</td><td><code>true</code></td><td>Show the "x of N done" count and bar</td></tr>
            <tr><td><code>dismissible</code></td><td>bool</td><td><code>false</code></td><td>Render the dismiss button. Your JS handles the click.</td></tr>
            <tr><td><code>cta</code></td><td>array</td><td><code>null</code></td><td>In-card action below the items, via <code>ws_button</code>: <code>label</code> (required), <code>href</code>, <code>variant</code> (default primary), <code>icon</code> (default arrow_forward).</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>null</code></td><td>Element ID</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
        </tbody>
    </table>

    <h3 class="ds-subsection-title">Item options</h3>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>label</code></td><td>string</td><td>required</td><td>The task. Phrase it as the outcome the user gets.</td></tr>
            <tr><td><code>done</code></td><td>bool</td><td><code>false</code></td><td>Completion state. Compute it from real data.</td></tr>
            <tr><td><code>href</code></td><td>string</td><td><code>null</code></td><td>Where the task happens. Undone items with an href render as links.</td></tr>
            <tr><td><code>description</code></td><td>string</td><td><code>null</code></td><td>Why it's worth doing. Hidden once done.</td></tr>
            <tr><td><code>phase</code></td><td>string</td><td><code>null</code></td><td>Uppercase eyebrow &mdash; Learn, Plan, Facilitate, Reflect</td></tr>
            <tr><td><code>key</code></td><td>string</td><td><code>null</code></td><td>Emitted as <code>data-task</code> for JS and analytics</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>State icons</td><td>The done and todo icons carry <code>aria-hidden="true"</code>, so the tick isn't read as stray text.</td></tr>
            <tr><td>Dismiss button</td><td>Labelled <code>aria-label="Hide this checklist"</code> &mdash; it says what it does rather than just "close".</td></tr>
            <tr><td>Keyboard</td><td>Undone items are real links in the tab order; done items aren't focusable, which correctly signals there's nothing to do.</td></tr>
            <tr><td>Focus</td><td>Links use <code>--focus-ring</code> with <code>--focus-ring-offset</code>, matching the rest of the platform.</td></tr>
            <tr><td>Completion state</td><td><strong>Worth knowing:</strong> done versus undone is conveyed by icon and colour, with no text equivalent on the row. The progress count ("2 of 4 done") carries it for the list as a whole, but an individual row's state isn't announced. If a checklist ships without the progress bar, consider adding visually-hidden text to each row.</td></tr>
            <tr><td>Link text</td><td>The label is the link's accessible name, so it must stand alone in a screen reader's link list &mdash; "Build your first agenda" does; "Get started" wouldn't.</td></tr>
            <tr><td>Contrast</td><td>Done uses <code>--color-success</code>, phase eyebrows <code>--brand-ink</code>, descriptions <code>--text-muted</code> &mdash; all tested.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--card-bg</code> / <code>--bg-subtle</code></td><td>Panel background and row hover</td></tr>
            <tr><td><code>--color-success</code></td><td>Completed check</td></tr>
            <tr><td><code>--brand</code></td><td>Progress bar fill</td></tr>
            <tr><td><code>--brand-ink</code></td><td>Phase eyebrow</td></tr>
            <tr><td><code>--gray-100</code> / <code>--gray-300</code></td><td>Dividers, progress track, and the todo icon</td></tr>
            <tr><td><code>--text-dark</code> / <code>--text-muted</code> / <code>--text-faint</code></td><td>Title, description, and completed-label text</td></tr>
            <tr><td><code>--focus-ring</code> / <code>--focus-ring-offset</code></td><td>Link focus treatment</td></tr>
            <tr><td><code>--card-radius</code> / <code>--radius-lg</code> / <code>--radius-full</code></td><td>Panel, row, and progress-bar corners</td></tr>
            <tr><td><code>--text-h3</code> / <code>--text-body</code> / <code>--text-small</code> / <code>--text-meta</code> / <code>--text-caption</code></td><td>Type scale across title, label, and eyebrow</td></tr>
            <tr><td><code>--font-heading</code> / <code>--font-body</code> / <code>--font-medium</code> / <code>--font-semibold</code></td><td>Fraunces title, Inter body</td></tr>
            <tr><td><code>--tracking-wide</code></td><td>Phase eyebrow letter-spacing</td></tr>
            <tr><td><code>--card-padding</code>, and <code>--space-1</code> through <code>--space-4</code></td><td>Internal rhythm</td></tr>
            <tr><td><code>--transition-fast</code></td><td>Row hover</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-task-checklist</code></td><td>Panel container</td></tr>
            <tr><td><code>.ws-task-checklist__header</code></td><td>Title, subtitle, and dismiss row</td></tr>
            <tr><td><code>.ws-task-checklist__title</code> / <code>__subtitle</code></td><td>Heading text</td></tr>
            <tr><td><code>.ws-task-checklist__dismiss</code></td><td>Dismiss button, carrying <code>data-checklist-dismiss</code></td></tr>
            <tr><td><code>.ws-task-checklist__progress</code> / <code>__progress-bar</code> / <code>__progress-count</code></td><td>Progress display</td></tr>
            <tr><td><code>.ws-task-checklist__body</code> / <code>__items</code></td><td>List wrappers</td></tr>
            <tr><td><code>.ws-task-checklist__item</code> / <code>__row</code></td><td>An individual task and its layout row</td></tr>
            <tr><td><code>.ws-task-checklist__check</code></td><td>State icon holder</td></tr>
            <tr><td><code>.ws-task-checklist__icon-done</code> / <code>__icon-todo</code></td><td>The two state icons</td></tr>
            <tr><td><code>.ws-task-checklist__phase</code></td><td>Uppercase phase eyebrow</td></tr>
            <tr><td><code>.ws-task-checklist__label</code> / <code>__desc</code></td><td>Task text</td></tr>
            <tr><td><code>.ws-task-checklist__arrow</code></td><td>Trailing arrow on actionable rows</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_task_checklist()</code> helper function</td></tr>
            <tr><td><code>includes/components/task-checklist.php</code></td><td>Template &mdash; progress calculation and row markup</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-task-checklist</code> rules)</td></tr>
        </tbody>
    </table>
    <p class="ds-section-desc">No JS file &mdash; dismissal is left to the consumer, as noted in States.</p>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
