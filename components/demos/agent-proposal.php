<?php
$ds_page  = 'components/demos/agent-proposal';
$ds_title = 'Agent Proposal';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Agent Proposal</h1>
    <p>A change the AI wants to make to something the person owns, shown in full before anything happens: what changes, from what to what, and why. Then Apply, an optional Adjust, and Not now, which is always there.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            The AI proposes a change to the person's agenda, recap or live session and the person decides whether it happens. Show every item that changes, before and after, and the reason in their terms. The facilitator is the expert; the proposal is a second set of eyes they can turn down in one click, and undo in one more.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The AI is recommending one library item to add; that is the <a href="<?= $ds_base ?>/components/demos/suggestion-card.php">Suggestion Card</a>. A change the person asked for and already confirmed needs no second proposal, only a <a href="<?= $ds_base ?>/components/demos/toast.php">Toast</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">A timed change, with Adjust</h3>
        <p class="ds-section-desc">Each change is a <code class="ds-code-inline">label</code> with an optional <code class="ds-code-inline">at</code> (a time or a position), and <code class="ds-code-inline">was</code> and <code class="ds-code-inline">new</code>. A change with only <code class="ds-code-inline">new</code> is an addition. Try the buttons: Apply hides the card and offers Undo in a toast, Not now removes it, and the line under the card shows each event.</p>
        <div class="ds-card ds-measure">
            <?= ws_agent_proposal([
                'id'      => 'dsProposalTimed',
                'title'   => 'Still end at 11:00, and keep the full decision',
                'changes' => [
                    ['at' => '9:55', 'label' => 'Break', 'was' => '15m', 'new' => '5m'],
                    ['at' => '10:12', 'label' => 'Restate the question', 'new' => 'New, 3m'],
                    ['at' => '10:45', 'label' => 'Commit: owners and first steps', 'was' => '20m', 'new' => '15m'],
                ],
                'why'     => 'You are 12 minutes behind, and three people asked which question they are answering. Restating it costs 3 minutes; the break and the close pay for it.',
                'apply'   => 'Apply to the session',
                'adjust'  => 'Adjust',
                'toast'   => 'Applied. The session still ends at 11:00.',
            ]) ?>
            <p class="ds-section-desc ds-gap-above" id="dsProposalLog" role="status">No event yet.</p>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_agent_proposal([
    'id'      =&gt; 'adapt-' . $proposalId,
    'title'   =&gt; 'Still end at 11:00, and keep the full decision',
    'changes' =&gt; [
        ['at' =&gt; '9:55',  'label' =&gt; 'Break', 'was' =&gt; '15m', 'new' =&gt; '5m'],
        ['at' =&gt; '10:12', 'label' =&gt; 'Restate the question', 'new' =&gt; 'New, 3m'],
    ],
    'why'     =&gt; 'You are 12 minutes behind, and three people asked which question they are answering.',
    'apply'   =&gt; 'Apply to the session',
    'adjust'  =&gt; 'Adjust',
    'toast'   =&gt; 'Applied. The session still ends at 11:00.',
]) ?&gt;
&lt;?= ws_toast_container() ?&gt;
&lt;script src="/js/ws-agent.js?v=&lt;?= filemtime(WS_ROOT . '/js/ws-agent.js') ?&gt;"&gt;&lt;/script&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Removed items, no Adjust</h3>
        <p class="ds-section-desc"><code class="ds-code-inline">'removed' =&gt; true</code> strikes the item through and says Removed in words. Without an <code class="ds-code-inline">adjust</code> label there is no Adjust button; Not now is always there.</p>
        <div class="ds-card ds-measure">
            <?= ws_agent_proposal([
                'id'      => 'dsProposalRemoved',
                'title'   => 'Make room for the decision',
                'changes' => [
                    ['label' => 'Lightning Demos', 'removed' => true],
                    ['label' => 'Dot voting', 'was' => '10m', 'new' => '25m'],
                ],
                'why'     => 'The decision needs about 24 minutes for 12 people choosing 3 of 12.',
            ]) ?>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Proposed by the agenda rules</h3>
        <p class="ds-section-desc"><code class="ds-code-inline">'source' =&gt; 'rules'</code> for a change the agenda rules worked out rather than a model, such as the cockpit's "get back on time" cuts. It drops the AI mark, so the card never claims an AI made what a rule did, and sets <code class="ds-code-inline">data-ws-proposal-source="rules"</code>. Everything else, Undo included, is the same.</p>
        <div class="ds-card ds-measure">
            <?= ws_agent_proposal([
                'id'      => 'dsProposalRules',
                'source'  => 'rules',
                'kicker'  => 'From your agenda rules',
                'title'   => 'Still end at 15:00',
                'changes' => [
                    ['at' => '14:32', 'label' => 'Dot Vote on Themes', 'was' => '8m', 'new' => '5m'],
                    ['at' => '14:57', 'label' => 'Facilitator Self-Reflection', 'removed' => true],
                ],
                'why'     => 'You are 7 minutes behind. A vote runs fine short, and the self-reflection is marked optional, so the break, Action Items and One Word Close stay whole.',
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_agent_proposal(['id' =&gt; 'cut-late', 'source' =&gt; 'rules', 'kicker' =&gt; 'From your agenda rules', 'title' =&gt; 'Still end at 15:00', 'changes' =&gt; $cuts, 'why' =&gt; $why]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">From JavaScript, and saving before you confirm</h3>
        <p class="ds-section-desc"><code class="ds-code-inline">WsAgent.proposal(proposal)</code> prints the same markup, so a chat reply can draw one. When Apply has to save first, prevent the event, save, then call <code class="ds-code-inline">WsAgent.applied(card)</code>, which hides the card and offers Undo.</p>
        <div class="ds-code"><pre>thread.insertAdjacentHTML('beforeend', WsAgent.proposal({ id: 'chat-7', title: 'Tighten the recap', changes, why }));

document.addEventListener('ws:proposal-apply', async (event) =&gt; {
    event.preventDefault();                       // the toast waits for the save
    await saveChange(event.detail.id);
    WsAgent.applied(event.detail.proposal);
});
document.addEventListener('ws:proposal-undo', (event) =&gt; revertChange(event.detail.id));
document.addEventListener('ws:proposal-dismiss', (event) =&gt; logDismissed(event.detail.id));
document.addEventListener('ws:proposal-adjust', (event) =&gt; openEditor(event.detail.id));</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Proposed</td><td>The card, its changes, the reason and the actions.</td></tr>
            <tr><td>Applied</td><td><code>ws:proposal-apply</code> ran and nothing prevented it: the card is <code>hidden</code>, carries <code>data-ws-proposal-state="applied"</code>, and a success toast says so with Undo (unless <code>'undo' =&gt; false</code>). It stays in the page so Undo can bring it back.</td></tr>
            <tr><td>Undone</td><td>Undo dispatches <code>ws:proposal-undo</code>; unless prevented, the card comes back and its Apply button takes focus.</td></tr>
            <tr><td>Dismissed</td><td>Not now dispatches <code>ws:proposal-dismiss</code>; unless prevented, the card is removed.</td></tr>
            <tr><td>Adjusting</td><td>Adjust dispatches <code>ws:proposal-adjust</code>. The card stays; the page opens its own editor.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">Synthesize's "Draft a change" and Agenda Check's "Fix" move onto it; Synthesize gains the Not now it never had. Facilitate's Help me adapt proposes changes to the rest of a live session the same way.</p>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>id</code></td><td>string</td><td><code>'ws-agent-proposal'</code></td><td>Required in practice: unique on the page. The title takes <code>{id}-title</code>; events carry it as <code>detail.id</code>.</td></tr>
            <tr><td><code>kicker</code></td><td>string</td><td><code>'Suggested change'</code></td><td>The line above the title</td></tr>
            <tr><td><code>title</code></td><td>string</td><td><code>''</code></td><td>What the change achieves, in a sentence</td></tr>
            <tr><td><code>changes</code></td><td>array</td><td><code>[]</code></td><td>Each: <code>label</code>, <code>at</code>, <code>was</code>, <code>new</code>, <code>removed</code></td></tr>
            <tr><td><code>why</code></td><td>string</td><td><code>''</code></td><td>The reason, in the person's terms</td></tr>
            <tr><td><code>apply</code> / <code>adjust</code> / <code>dismiss</code></td><td>string</td><td><code>'Apply'</code> / <code>''</code> / <code>'Not now'</code></td><td>Button text. No Adjust without its text.</td></tr>
            <tr><td><code>toast</code></td><td>string</td><td><code>'Change applied.'</code></td><td>The toast after Apply</td></tr>
            <tr><td><code>undo</code></td><td>bool</td><td><code>true</code></td><td>Offer Undo in that toast. Turn it off only when the change truly cannot be reversed.</td></tr>
            <tr><td><code>returnFocus</code></td><td>string</td><td><code>''</code></td><td>A selector for where focus goes when the card leaves</td></tr>
            <tr><td><code>class</code> / <code>attrs</code></td><td>string / array</td><td></td><td>Additional classes and attributes</td></tr>
        </tbody>
    </table>
    <p class="ds-section-desc">Markup contract: the section carries <code class="ds-code-inline">data-ws-proposal="{id}"</code> and <code class="ds-code-inline">data-ws-proposal-toast</code>; the buttons carry <code class="ds-code-inline">data-ws-proposal-action</code> (<code class="ds-code-inline">apply</code> | <code class="ds-code-inline">adjust</code> | <code class="ds-code-inline">dismiss</code>). The page needs <code class="ds-code-inline">ws_toast_container()</code>, <code class="ds-code-inline">components.js</code> and <code class="ds-code-inline">/js/ws-agent.js</code>.</p>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Region</td><td>A <code>&lt;section&gt;</code> named by its title through <code>aria-labelledby</code>, so a screen reader can find it among the page's regions; the title is an <code>h3</code>.</td></tr>
            <tr><td>Before and after</td><td>Strikethrough is not read aloud, so each change carries visually hidden words: "was 15m, now 5m". A removed item says Removed in visible text.</td></tr>
            <tr><td>Actions</td><td>Apply, Adjust and Not now are real buttons, in that order, so Tab reaches the primary action first.</td></tr>
            <tr><td>Focus when the card leaves</td><td>Focus moves to <code>returnFocus</code> when set, else to the next proposal beside it, else the previous one, else to the card's container. Undo brings the card back and focuses its Apply button.</td></tr>
            <tr><td>The toast</td><td>The success toast is announced by the toast container, and it pauses while hovered or focused, so there is time to reach Undo.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--brand</code></td><td>The 2px border that marks a decision waiting</td></tr>
            <tr><td><code>--brand-tint</code> / <code>--brand-line</code> / <code>--brand-ink</code></td><td>The head, its rule, the kicker and the new values</td></tr>
            <tr><td><code>--font-heading</code> / <code>--text-h4</code></td><td>The title</td></tr>
            <tr><td><code>--card-bg</code></td><td>The actions row</td></tr>
            <tr><td><code>--radius-xl</code> / <code>--shadow-sm</code></td><td>Shape and lift, matched to the cards around it</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-agent-proposal</code></td><td>The section</td></tr>
            <tr><td><code>.ws-agent-proposal__head</code> / <code>__kicker</code> / <code>__title</code></td><td>The head</td></tr>
            <tr><td><code>.ws-agent-proposal__changes</code> / <code>__change</code></td><td>The list of changes; <code>__change--removed</code> for a removed item</td></tr>
            <tr><td><code>.ws-agent-proposal__at</code> / <code>__what</code> / <code>__delta</code> / <code>__was</code> / <code>__new</code></td><td>The parts of one change</td></tr>
            <tr><td><code>.ws-agent-proposal__why</code> / <code>__why-label</code></td><td>The reason</td></tr>
            <tr><td><code>.ws-agent-proposal__actions</code></td><td>The buttons</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_agent_proposal()</code> helper</td></tr>
            <tr><td><code>includes/components/agent-proposal.php</code></td><td>Template</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles, in the agent components section</td></tr>
            <tr><td><code>js/ws-agent.js</code></td><td><code>WsAgent.proposal()</code>, <code>WsAgent.applied()</code> and the events</td></tr>
        </tbody>
    </table>
</section>

<?= ws_toast_container() ?>
<script src="<?= $site_base ?>/js/ws-agent.js?v=<?= filemtime(__DIR__ . '/../../../js/ws-agent.js') ?>"></script>
<script>
(function () {
    var log = document.getElementById('dsProposalLog');
    ['ws:proposal-apply', 'ws:proposal-undo', 'ws:proposal-dismiss', 'ws:proposal-adjust'].forEach(function (name) {
        document.addEventListener(name, function (event) {
            log.textContent = name + ' fired for ' + event.detail.id + '.';
        });
    });
})();
</script>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
