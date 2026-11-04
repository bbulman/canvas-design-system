<?php
$ds_page  = 'components/demos/agent-status';
$ds_title = 'Agent Status';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Agent Status</h1>
    <p>What the AI is doing right now, while the person waits: a single thinking line, or the stages of a longer run, each done, failed, in progress or still to come.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            The AI is working and the person is waiting on it. Thinking mode is for a short wait with nothing to report, such as a chat reply being written. Stages mode is for a run with three or more steps worth naming, such as generating an agenda or synthesizing a workshop: a long wait shows how far it has got, and a failure says which step broke and what to do about it. Thinking at <code class="ds-code-inline">size</code> <code class="ds-code-inline">sm</code> sits inline beside the control that started the work, such as "Drafting" next to a Generate button.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The wait is not the AI working. A list fetching from the server is a <a href="<?= $ds_base ?>/components/demos/skeleton.php">Skeleton</a>; an upload with a known percentage is <a href="<?= $ds_base ?>/components/demos/progress.php">Progress</a>. The record of what a finished run did, with its details, is <a href="<?= $ds_base ?>/components/demos/agent-steps.php">Agent Steps</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Stages</h3>
        <p class="ds-section-desc">An ordered list of the run's stages. Each is <code class="ds-code-inline">done</code>, <code class="ds-code-inline">failed</code>, <code class="ds-code-inline">now</code> or <code class="ds-code-inline">todo</code>, with an optional detail line. A failed stage takes a <code class="ds-code-inline">recovery</code> sentence and one <code class="ds-code-inline">action</code>, so the person always knows what to do next.</p>
        <div class="ds-card">
            <?= ws_agent_status([
                'id'     => 'dsStatusStages',
                'label'  => 'Building your agenda',
                'stages' => [
                    ['key' => 'brief', 'label' => 'Read the brief', 'state' => 'done', 'detail' => '12 product leaders, 2 hours, one decision to make.'],
                    ['key' => 'recording', 'label' => 'Transcribe the kickoff recording', 'state' => 'failed', 'recovery' => 'The file stopped at 12 minutes. Upload it again, or carry on without it.', 'action' => ['label' => 'Try again']],
                    ['key' => 'pick', 'label' => 'Choose activities from the library', 'state' => 'now'],
                    ['key' => 'check', 'label' => 'Check the timings and the breaks', 'state' => 'todo'],
                ],
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_agent_status([
    'id'     =&gt; 'generator-status',
    'label'  =&gt; 'Building your agenda',
    'stages' =&gt; [
        ['key' =&gt; 'brief', 'label' =&gt; 'Read the brief', 'state' =&gt; 'done', 'detail' =&gt; '12 product leaders, 2 hours.'],
        ['key' =&gt; 'recording', 'label' =&gt; 'Transcribe the kickoff recording', 'state' =&gt; 'failed',
         'recovery' =&gt; 'The file stopped at 12 minutes. Upload it again, or carry on without it.',
         'action' =&gt; ['label' =&gt; 'Try again']],
        ['key' =&gt; 'pick', 'label' =&gt; 'Choose activities from the library', 'state' =&gt; 'now'],
        ['key' =&gt; 'check', 'label' =&gt; 'Check the timings and the breaks', 'state' =&gt; 'todo'],
    ],
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Thinking</h3>
        <p class="ds-section-desc">One line: the AI mark, a sentence, three dots. The sentence says what it is doing when you know ("Reading your notes"); "Working on it" is the default. A quieter <code class="ds-code-inline">detail</code> can follow.</p>
        <div class="ds-card ds-row">
            <?= ws_agent_status() ?>
            <?= ws_agent_status(['label' => 'Reading your notes', 'detail' => '14 notes and 2 recordings']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_agent_status() ?&gt;
&lt;?= ws_agent_status(['label' =&gt; 'Reading your notes', 'detail' =&gt; '14 notes and 2 recordings']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Inline (size sm)</h3>
        <p class="ds-section-desc">The thinking line at button size, with no fill, border or padding, so it sits in a button row or beside a field. Put it right after the control that started the work and give it the verb of what is happening ("Drafting", "Checking"). Stages have no inline form.</p>
        <div class="ds-card ds-row">
            <?= ws_button('Generate', ['variant' => 'primary', 'size' => 'sm', 'disabled' => true]) ?>
            <?= ws_agent_status(['label' => 'Drafting', 'size' => 'sm']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_button('Generate', ['variant' =&gt; 'primary', 'size' =&gt; 'sm', 'disabled' =&gt; true]) ?&gt;
&lt;?= ws_agent_status(['label' =&gt; 'Drafting', 'size' =&gt; 'sm']) ?&gt;

// The same from JavaScript
row.insertAdjacentHTML('beforeend', WsAgent.status({ label: 'Drafting', size: 'sm' }));</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">From JavaScript</h3>
        <p class="ds-section-desc">Most AI waits start in the browser. <code class="ds-code-inline">WsAgent.status(options)</code> prints the same markup, and <code class="ds-code-inline">WsAgent.setStage(root, key, patch)</code> redraws one stage as the run moves on; the list's live region reads that stage out. Press the button to move this run forward.</p>
        <div class="ds-card">
            <div id="dsStatusJs"></div>
            <div class="ds-gap-above"><?= ws_button('Next stage', ['variant' => 'secondary', 'size' => 'sm', 'id' => 'dsStatusNext']) ?></div>
        </div>
        <div class="ds-code"><pre>&lt;script src="/js/ws-agent.js?v=&lt;?= filemtime(WS_ROOT . '/js/ws-agent.js') ?&gt;"&gt;&lt;/script&gt;
panel.innerHTML = WsAgent.status({ id: 'gen', label: 'Building your agenda', stages: [
    { key: 'brief', label: 'Read the brief', state: 'now' },
    { key: 'pick',  label: 'Choose activities', state: 'todo' },
] });
WsAgent.setStage('gen', 'brief', { state: 'done', detail: '12 people, 2 hours.' });
WsAgent.setStage('gen', 'pick', { state: 'failed', recovery: 'The library did not answer.', action: { label: 'Try again' } });
document.addEventListener('ws:agent-retry', e =&gt; restart(e.detail.stage));</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>Stage</th><th>Looks</th><th>Says</th></tr></thead>
        <tbody>
            <tr><td><code>done</code></td><td>A tick in a stone circle; the name in ink</td><td>"Done:"</td></tr>
            <tr><td><code>failed</code></td><td>An exclamation in an amber circle, the recovery sentence in amber ink, and the action</td><td>"Failed:"</td></tr>
            <tr><td><code>now</code></td><td>A turning ring in a filled red circle; still under reduced motion</td><td>"In progress:", and <code>aria-current="step"</code></td></tr>
            <tr><td><code>todo</code></td><td>An empty circle; the name muted</td><td>"Not started:"</td></tr>
            <tr><td>Thinking</td><td>Three dots that pulse, and hold still under reduced motion</td><td>Its sentence, as a status</td></tr>
            <tr><td>Thinking, <code>sm</code></td><td>The same line at button text size, with no fill or border</td><td>Its sentence, as a status</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">It replaces the Planner generator's loading view and Synthesize's hand-built progress screen, and the six thinking indicators around the chat surfaces. The failed stage is the part those screens never had: say which step broke, what the person can do, and give them the one button that does it.</p>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>mode</code></td><td>string</td><td><code>'stages'</code> when stages are passed, else <code>'thinking'</code></td><td><code>thinking</code> | <code>stages</code></td></tr>
            <tr><td><code>size</code></td><td>string</td><td><code>'md'</code></td><td><code>sm</code> | <code>md</code>. Thinking only: <code>sm</code> is the inline, button-sized form</td></tr>
            <tr><td><code>label</code></td><td>string</td><td><code>''</code></td><td>Thinking: the sentence ("Working on it" when empty). Stages: the list's title.</td></tr>
            <tr><td><code>detail</code></td><td>string</td><td><code>''</code></td><td>Thinking only: a second, quieter sentence</td></tr>
            <tr><td><code>stages</code></td><td>array</td><td><code>[]</code></td><td>Each: <code>label</code>, <code>state</code> (<code>done</code> | <code>failed</code> | <code>now</code> | <code>todo</code>), <code>detail</code>, <code>key</code> (default: its position from 1), <code>recovery</code> and <code>action</code> (failed only; the action takes <code>ws_button</code> options plus <code>label</code>)</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>''</code></td><td>Element id. With a label in stages mode the list is named by <code>{id}-title</code>; <code>WsAgent.setStage()</code> takes it.</td></tr>
            <tr><td><code>class</code> / <code>attrs</code></td><td>string / array</td><td></td><td>Additional classes and attributes</td></tr>
        </tbody>
    </table>
    <p class="ds-section-desc">Events: a failed stage's action dispatches <code class="ds-code-inline">ws:agent-retry</code> with <code class="ds-code-inline">detail.stage</code> (its key) and <code class="ds-code-inline">detail.status</code> (the root). Load <code class="ds-code-inline">/js/ws-agent.js</code> for it.</p>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Thinking</td><td>The line is <code>role="status"</code>, so its sentence is read when it appears. The dots are <code>aria-hidden</code> and stop under <code>prefers-reduced-motion</code>. The <code>sm</code> form keeps both, and its words, never the dots alone, say what is happening.</td></tr>
            <tr><td>Stage changes</td><td>The stage list is a polite live region. When <code>WsAgent.setStage()</code> redraws a stage, a screen reader hears that stage whole: its state, its name, its detail.</td></tr>
            <tr><td>State in words</td><td>Every stage starts with visually hidden words for its state ("Done:", "Failed:", "In progress:", "Not started:"), and each state has its own glyph, so nothing rests on colour. The stage in progress carries <code>aria-current="step"</code>.</td></tr>
            <tr><td>Recovery</td><td>A failed stage's action is a real button in reading order, right after the sentence that says what went wrong.</td></tr>
            <tr><td>Motion</td><td>The turning ring and the dots stop under reduced motion; the red circle and the words still say the run is going.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--brand</code> / <code>--brand-tint</code> / <code>--brand-line</code></td><td>The dots, the stage in progress, and the thinking line's fill and border</td></tr>
            <tr><td><code>--color-warning</code> / <code>--color-warning-surface</code> / <code>--color-warning-surface-ink</code></td><td>A failed stage and its recovery sentence</td></tr>
            <tr><td><code>--gray-100</code> / <code>--gray-300</code></td><td>Done and still-to-come circles</td></tr>
            <tr><td><code>--text-dark</code> / <code>--text-default</code> / <code>--text-muted</code></td><td>Names, details, stages not started</td></tr>
            <tr><td><code>--font-heading</code> / <code>--text-h4</code></td><td>The stages title</td></tr>
            <tr><td><code>--space-*</code> / <code>--radius-lg</code> / <code>--radius-full</code></td><td>Spacing and shape</td></tr>
            <tr><td><code>--ease-in-out</code></td><td>The dots' pulse</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-agent-status</code></td><td>Root; <code>--thinking</code> or <code>--stages</code>, and <code>--sm</code> for the inline thinking line</td></tr>
            <tr><td><code>.ws-agent-status__text</code> / <code>__label</code> / <code>__detail</code> / <code>__dots</code></td><td>The thinking line</td></tr>
            <tr><td><code>.ws-agent-status__title</code></td><td>The stages title, with the AI mark</td></tr>
            <tr><td><code>.ws-agent-status__stages</code></td><td>The live list</td></tr>
            <tr><td><code>.ws-agent-status__stage</code></td><td>One stage, <code>--done</code> / <code>--failed</code> / <code>--now</code> / <code>--todo</code>; carries <code>data-ws-stage</code></td></tr>
            <tr><td><code>.ws-agent-status__icon</code> / <code>__glyph</code></td><td>The state circle and its glyph</td></tr>
            <tr><td><code>.ws-agent-status__name</code> / <code>__recovery</code> / <code>__action</code></td><td>A stage's name, recovery sentence and action</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_agent_status()</code> helper</td></tr>
            <tr><td><code>includes/components/agent-status.php</code></td><td>Template</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles, in the agent components section</td></tr>
            <tr><td><code>js/ws-agent.js</code></td><td><code>WsAgent.status()</code>, <code>WsAgent.setStage()</code> and <code>ws:agent-retry</code></td></tr>
        </tbody>
    </table>
</section>

<script src="<?= $site_base ?>/js/ws-agent.js?v=<?= filemtime(__DIR__ . '/../../../js/ws-agent.js') ?>"></script>
<script>
(function () {
    var order = ['brief', 'pick', 'check'];
    var run = [
        ['brief', { state: 'done', detail: '12 product leaders, 2 hours, one decision to make.' }],
        ['pick', { state: 'now' }],
        ['pick', { state: 'done', detail: '6 activities, 1h 55m.' }],
        ['check', { state: 'now' }],
        ['check', { state: 'failed', recovery: 'The morning runs 100 minutes without a break.', action: { label: 'Fix the timings' } }],
    ];
    var step = 0;
    function reset() {
        document.getElementById('dsStatusJs').innerHTML = WsAgent.status({ id: 'dsStatusRun', label: 'Building your agenda', stages: [
            { key: order[0], label: 'Read the brief', state: 'now' },
            { key: order[1], label: 'Choose activities from the library', state: 'todo' },
            { key: order[2], label: 'Check the timings and the breaks', state: 'todo' },
        ] });
        step = 0;
    }
    reset();
    document.getElementById('dsStatusNext').addEventListener('click', function () {
        if (step >= run.length) { reset(); return; }
        WsAgent.setStage('dsStatusRun', run[step][0], run[step][1]);
        step++;
    });
    document.addEventListener('ws:agent-retry', function (event) {
        if (event.detail.status && event.detail.status.id === 'dsStatusRun') reset();
    });
})();
</script>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
