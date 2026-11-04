<?php
$ds_page  = 'components/demos/agenda';
$ds_title = 'Agenda';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';

$morning = [
    ['title' => 'Welcome and goals', 'duration' => 10, 'type' => 'custom'],
    ['title' => 'Two truths and a lie', 'duration' => 15, 'type' => 'icebreaker'],
    ['title' => 'Dot voting on the roadmap', 'duration' => 30, 'type' => 'exercise', 'description' => 'Everyone gets three dots. Silent first, then discuss the top five.'],
    ['title' => 'Coffee', 'duration' => 15, 'type' => 'break'],
    ['title' => 'Owners and first steps', 'duration' => 20, 'type' => 'exercise'],
];
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Agenda</h1>
    <p>A read-only running order: each activity's start time, title, type and duration, in order.</p>
</div>

<!-- When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            Someone needs to read a workshop's running order rather than edit it: on a workshop or library page, in a briefing, beside an AI proposal, in a summary or report. Pass <code>start</code> and the times follow from each duration.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The agenda is being edited. Inside the Planner the activities are <code>ws_planner_card</code>, which drag, swap and open the inspector. For a list that is not an agenda, use a stack.
        </div>
    </div>
</section>

<!-- Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With start times</h3>
        <p class="ds-section-desc">The first activity starts at <code>start</code> and each later time adds the duration before it. An item with its own <code>start</code> resets the clock; a duration written as text stops it, so no later time is invented.</p>
        <div class="ds-card">
            <?= ws_agenda($morning, ['start' => '09:30', 'label' => 'Morning agenda']) ?>
        </div>
        <div class="ds-code"><pre><?= htmlspecialchars(<<<'PHP'
<?= ws_agenda([
    ['title' => 'Welcome and goals', 'duration' => 10, 'type' => 'custom'],
    ['title' => 'Two truths and a lie', 'duration' => 15, 'type' => 'icebreaker'],
    ['title' => 'Dot voting on the roadmap', 'duration' => 30, 'type' => 'exercise',
     'description' => 'Everyone gets three dots. Silent first, then discuss the top five.'],
    ['title' => 'Coffee', 'duration' => 15, 'type' => 'break'],
    ['title' => 'Owners and first steps', 'duration' => 20, 'type' => 'exercise'],
], ['start' => '09:30', 'label' => 'Morning agenda']) ?>
PHP) ?></pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Without times</h3>
        <p class="ds-section-desc">With no start anywhere the time column goes, and the order and durations carry the plan.</p>
        <div class="ds-card">
            <?= ws_agenda(array_slice($morning, 0, 3), ['label' => 'Opening activities']) ?>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Over several days</h3>
        <p class="ds-section-desc">Items with a <code>day</code> are grouped under Day labels, each list named by its label.</p>
        <div class="ds-card">
            <?= ws_agenda([
                ['title' => 'Kickoff and context', 'start' => '09:00', 'duration' => 45, 'type' => 'custom', 'day' => 1],
                ['title' => 'Lightning demos', 'duration' => 60, 'type' => 'exercise', 'day' => 1],
                ['title' => 'Decide and storyboard', 'start' => '09:00', 'duration' => 90, 'type' => 'exercise', 'day' => 2],
                ['title' => 'Lunch', 'duration' => 60, 'type' => 'break', 'day' => 2],
            ], ['label' => 'Design sprint agenda', 'id' => 'sprint-agenda']) ?>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Live, as the session runs</h3>
        <p class="ds-section-desc">Give each item a <code>state</code> and set <code>live</code>. Done rows show what the block really took against its plan, and a block within 60 seconds of it either way is On time; the running row sits on the brand tint with <code>aria-current="step"</code>; a start that has moved says what it was; the list's name gains ", live". Every state is also said in words for a screen reader: a done row is read once, as "Done, took 7 of 5 minutes, 2 over".</p>
        <div class="ds-card">
            <?= ws_agenda([
                ['title' => '3-Part Question', 'start' => '14:00', 'duration' => 5, 'type' => 'icebreaker', 'state' => 'done', 'actual' => 7],
                ['title' => 'Sailboat Retrospective', 'start' => '14:07', 'duration' => 20, 'type' => 'exercise', 'state' => 'now'],
                ['title' => 'Dot Vote on Themes', 'start' => '14:32', 'planned_start' => '14:25', 'duration' => 5, 'type' => 'exercise', 'state' => 'next', 'change' => 'trimmed'],
                ['title' => 'Break', 'start' => '14:37', 'planned_start' => '14:33', 'duration' => 5, 'type' => 'break', 'state' => 'next'],
                ['title' => 'Facilitator Self-Reflection', 'start' => '14:57', 'duration' => 4, 'type' => 'exercise', 'state' => 'next', 'change' => 'skipped'],
            ], ['label' => 'Running order', 'live' => true, 'id' => 'live-agenda']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_agenda([
    ['title' =&gt; '3-Part Question', 'start' =&gt; '14:00', 'duration' =&gt; 5, 'type' =&gt; 'icebreaker', 'state' =&gt; 'done', 'actual' =&gt; 7],
    ['title' =&gt; 'Sailboat Retrospective', 'start' =&gt; '14:07', 'duration' =&gt; 20, 'type' =&gt; 'exercise', 'state' =&gt; 'now'],
    ['title' =&gt; 'Dot Vote on Themes', 'start' =&gt; '14:32', 'planned_start' =&gt; '14:25', 'duration' =&gt; 5, 'state' =&gt; 'next', 'change' =&gt; 'trimmed'],
], ['label' =&gt; 'Running order', 'live' =&gt; true]) ?&gt;</pre></div>
    </div>
</section>

<!-- Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>$items</code></td><td>array</td><td>&mdash;</td><td>Positional. The activities in order; see the item fields below</td></tr>
            <tr><td><code>start</code></td><td>string</td><td><code>null</code></td><td><code>'HH:MM'</code> the first activity starts</td></tr>
            <tr><td><code>label</code></td><td>string</td><td><code>''</code></td><td>Accessible name for the list, such as <code>'Morning agenda'</code></td></tr>
            <tr><td><code>live</code></td><td>bool</td><td><code>false</code></td><td>A live running order: the item with <code>state</code> now gets <code>aria-current="step"</code>, and the list's <code>label</code> gains ", live". Items may then carry the live fields below.</td></tr>
            <tr><td><code>id</code>, <code>class</code>, <code>attrs</code></td><td>&mdash;</td><td>&mdash;</td><td>On the wrapper</td></tr>
        </tbody>
    </table>
    <table class="ds-table">
        <thead><tr><th>Item field</th><th>Type</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>title</code></td><td>string</td><td>Required. The activity's name</td></tr>
            <tr><td><code>duration</code></td><td>int or string</td><td>Minutes as an int (shown as "15 min" or "1 hr 15 min"), or text shown as written</td></tr>
            <tr><td><code>type</code></td><td>string</td><td><code>exercise</code>, <code>icebreaker</code>, <code>break</code> or <code>custom</code>, written out under the title; a break is muted</td></tr>
            <tr><td><code>start</code></td><td>string</td><td><code>'HH:MM'</code>; resets the clock from this item on</td></tr>
            <tr><td><code>description</code></td><td>string</td><td>One line under the title</td></tr>
            <tr><td><code>day</code></td><td>int</td><td>Groups items under Day labels when more than one day appears</td></tr>
            <tr><td><code>state</code></td><td>string</td><td>Live: <code>done</code>, <code>now</code> or <code>next</code></td></tr>
            <tr><td><code>actual</code> / <code>actual_seconds</code></td><td>int</td><td>Live, on a done row: what the block really took, in minutes or in seconds (seconds win). Shown as "7 of 5 min" with a delta: "On time" within 60 seconds of the plan either way, else "+2 min" or "1 min under"</td></tr>
            <tr><td><code>planned_seconds</code></td><td>int</td><td>Live: the plan a done row is measured against, when it is not <code>duration</code> &times; 60</td></tr>
            <tr><td><code>planned_start</code></td><td>string</td><td>Live: <code>'HH:MM'</code> the block was planned for, shown as "was 14:25" when <code>start</code> has moved</td></tr>
            <tr><td><code>change</code></td><td>string</td><td>Live: <code>trimmed</code>, <code>skipped</code> or <code>added</code>, as a badge in words</td></tr>
        </tbody>
    </table>
</section>

<!-- Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Structure</td><td>An ordered list with <code>role="list"</code> kept explicitly, named by <code>label</code>, so a screen reader announces how many activities there are and reads each row as time, title, type, duration. Over several days each list is named by its Day label.</td></tr>
            <tr><td>Times</td><td>Each time is a <code>&lt;time datetime&gt;</code> in 24-hour <code>HH:MM</code>.</td></tr>
            <tr><td>Colour</td><td>The type is written out, never shown by colour alone, and breaks are muted with full-contrast text. Activity-type colours stay on the Planner's canvas (Red Unification).</td></tr>
            <tr><td>Live state</td><td>Each state is said in visually hidden words ahead of the title: "Now", "Next", and for a done row the whole result once ("Done, took 7 of 5 minutes, 2 over", "1 under", "on time"), with the short visible "7 of 5 min" and its badge hidden from a screen reader so it is not read twice. A live list's name ends ", live".</td></tr>
            <tr><td>Keyboard</td><td>Nothing in it is interactive, so it adds no Tab stops.</td></tr>
        </tbody>
    </table>
</section>

<!-- Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--text-dark</code> / <code>--text-default</code></td><td>Title; time, type, duration and description</td></tr>
            <tr><td><code>--gray-200</code></td><td>The rule between rows</td></tr>
            <tr><td><code>--space-12</code></td><td>The time column</td></tr>
        </tbody>
    </table>
</section>

<!-- CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-agenda</code>, <code>.ws-agenda--no-times</code></td><td>Wrapper; without a time column</td></tr>
            <tr><td><code>.ws-agenda__list</code>, <code>.ws-agenda__item</code>, <code>.ws-agenda__item--{type}</code></td><td>The list and each row</td></tr>
            <tr><td><code>.ws-agenda__time</code>, <code>__title</code>, <code>__type</code>, <code>__description</code>, <code>__duration</code>, <code>__day</code></td><td>Row parts and the Day label</td></tr>
        </tbody>
    </table>
</section>

<!-- Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_agenda()</code></td></tr>
            <tr><td><code>includes/components/agenda.php</code></td><td>Template: the clock, the rows, the day groups</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles, the <code>AGENDA (ws_agenda)</code> block</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
