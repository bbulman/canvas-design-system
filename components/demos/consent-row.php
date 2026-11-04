<?php
$ds_page  = 'components/demos/consent-row';
$ds_title = 'Consent Row';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Consent Row</h1>
    <p>Confirm before Workshopr sends something out or acts on its own. It says what will be sent, where, and when; the person turns it on; only then can they send. And there is always another way.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            Something is about to leave Workshopr, or run without the person watching: posting a recap to Slack, creating Linear issues, emailing participants, scheduled check-ins. Name the destination exactly (#design-team, not "your workspace") and say how often.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The action stays inside Workshopr. Deleting for good is the destructive confirmation (a <a href="<?= $ds_base ?>/components/demos/modal.php">Modal</a>); an ordinary setting that sends nothing is a <a href="<?= $ds_base ?>/components/demos/toggle.php">Toggle</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">A one-off push</h3>
        <p class="ds-section-desc">The switch starts off, always. Send stays disabled until it is on; Copy it instead works either way. The line under the row shows each event.</p>
        <?= ws_consent_row([
            'id'          => 'dsConsentSlack',
            'title'       => 'Send the recap to Slack',
            'what'        => 'The recap and 6 actions, with owners',
            'where'       => '#design-team in Slack',
            'when'        => 'Once, when you press Send to Slack',
            'consent'     => 'Post it to #design-team',
            'action'      => 'Send to Slack',
            'alternative' => 'Copy it instead',
        ]) ?>
        <p class="ds-section-desc ds-gap-above" id="dsConsentLog" role="status">No event yet.</p>
        <div class="ds-code"><pre>&lt;?= ws_consent_row([
    'id'          =&gt; 'slack-recap',
    'title'       =&gt; 'Send the recap to Slack',
    'what'        =&gt; 'The recap and 6 actions, with owners',
    'where'       =&gt; '#design-team in Slack',
    'when'        =&gt; 'Once, when you press Send to Slack',
    'consent'     =&gt; 'Post it to #design-team',
    'action'      =&gt; 'Send to Slack',
    'alternative' =&gt; 'Copy it instead',
]) ?&gt;
&lt;script src="/js/ws-agent.js?v=&lt;?= filemtime(WS_ROOT . '/js/ws-agent.js') ?&gt;"&gt;&lt;/script&gt;
&lt;script&gt;
document.addEventListener('ws:consent-confirm', e =&gt; e.detail.id === 'slack-recap' &amp;&amp; postToSlack());
document.addEventListener('ws:consent-alternative', e =&gt; e.detail.id === 'slack-recap' &amp;&amp; copyRecap());
&lt;/script&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Something that runs on its own</h3>
        <p class="ds-section-desc">For automation, the when is a schedule, and the alternative is the person doing it themselves.</p>
        <?= ws_consent_row([
            'id'          => 'dsConsentCheckins',
            'title'       => 'Let Workshopr run the check-ins',
            'what'        => 'One email to each owner, asking how their commitment is going',
            'where'       => 'The 6 owners, from your address',
            'when'        => '7 and 30 days after the workshop',
            'consent'     => 'Send the check-ins for me',
            'action'      => 'Start check-ins',
            'alternative' => 'I will follow up myself',
        ]) ?>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Not yet agreed (always on render)</td><td>The switch is off and the action is disabled. The template never renders it checked.</td></tr>
            <tr><td>Agreed</td><td>The switch is on and the action is enabled. Pressing it dispatches <code>ws:consent-confirm</code>.</td></tr>
            <tr><td>Declined</td><td>The alternative dispatches <code>ws:consent-alternative</code> whatever the switch says.</td></tr>
            <tr><td>Back to the page</td><td>The switch goes back off, even if the browser restored it: consent is given on the page, never carried in.</td></tr>
            <tr><td>Without ws-agent.js</td><td>The action stays disabled, so nothing can be sent without the person's say-so.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>id</code></td><td>string</td><td><code>'ws-consent'</code></td><td>Required in practice: unique on the page. The parts take <code>{id}-title</code>, <code>{id}-consent</code> and <code>{id}-hint</code>; events carry it as <code>detail.id</code>.</td></tr>
            <tr><td><code>title</code></td><td>string</td><td><code>''</code></td><td>What is about to happen, in a sentence</td></tr>
            <tr><td><code>what</code> / <code>where</code> / <code>when</code></td><td>string</td><td><code>''</code></td><td>What goes, where it goes, and when and how often</td></tr>
            <tr><td><code>consent</code></td><td>string</td><td><code>'Yes, go ahead'</code></td><td>The switch's label; say the destination again</td></tr>
            <tr><td><code>name</code></td><td>string</td><td><code>'{id}-consent'</code></td><td>The checkbox's form name</td></tr>
            <tr><td><code>action</code></td><td>string | array</td><td><code>'Send'</code></td><td>The action's text, or <code>ws_button</code> options with <code>label</code></td></tr>
            <tr><td><code>alternative</code></td><td>string | array</td><td><code>null</code></td><td>The other way, as text or <code>ws_button</code> options with <code>label</code>. Always pass one.</td></tr>
            <tr><td><code>hint</code></td><td>string</td><td><code>'Nothing leaves Workshopr until you switch this on.'</code></td><td>The line under the actions; it describes the action</td></tr>
            <tr><td><code>class</code> / <code>attrs</code></td><td>string / array</td><td></td><td>Additional classes and attributes</td></tr>
        </tbody>
    </table>
</section>

<!-- 6. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Group</td><td><code>role="group"</code> named by its title, so everything inside is heard in that context.</td></tr>
            <tr><td>What, where, when</td><td>A description list, read as term and value.</td></tr>
            <tr><td>Consent</td><td>A <code>ws_toggle</code> checkbox with a visible label, never checked on render. Space turns it on.</td></tr>
            <tr><td>The action</td><td>A real button, disabled until consent and described by the hint under it. The alternative is always enabled.</td></tr>
            <tr><td>Keyboard</td><td>Switch, action, alternative: Tab reaches each in reading order; Space and Enter work.</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--bg-surface</code> / <code>--card-border</code> / <code>--card-radius</code> / <code>--card-padding</code></td><td>The row's surface, matched to the cards around it</td></tr>
            <tr><td><code>--text-dark</code> / <code>--text-muted</code></td><td>Values and terms, the hint</td></tr>
            <tr><td><code>--space-*</code></td><td>Spacing</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-consent</code></td><td>The row; carries <code>data-ws-consent="{id}"</code></td></tr>
            <tr><td><code>.ws-consent__text</code> / <code>__title</code></td><td>The words</td></tr>
            <tr><td><code>.ws-consent__facts</code> / <code>__fact</code></td><td>What, where and when</td></tr>
            <tr><td><code>.ws-consent__controls</code> / <code>__actions</code> / <code>__hint</code></td><td>The switch, the buttons and the line under them</td></tr>
        </tbody>
    </table>
    <p class="ds-section-desc">Hooks: the checkbox carries <code class="ds-code-inline">data-ws-consent-check</code>, the action <code class="ds-code-inline">data-ws-consent-action</code>, the alternative <code class="ds-code-inline">data-ws-consent-alternative</code>.</p>
</section>

<!-- 9. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_consent_row()</code> helper</td></tr>
            <tr><td><code>includes/components/consent-row.php</code></td><td>Template</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles, in the agent components section</td></tr>
            <tr><td><code>js/ws-agent.js</code></td><td>Enables the action and dispatches the events</td></tr>
        </tbody>
    </table>
</section>

<script src="<?= $site_base ?>/js/ws-agent.js?v=<?= filemtime(__DIR__ . '/../../../js/ws-agent.js') ?>"></script>
<script>
(function () {
    var log = document.getElementById('dsConsentLog');
    ['ws:consent-confirm', 'ws:consent-alternative'].forEach(function (name) {
        document.addEventListener(name, function (event) {
            log.textContent = name + ' fired for ' + event.detail.id + '.';
        });
    });
})();
</script>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
