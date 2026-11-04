<?php
$ds_page  = 'components/demos/source-chip';
$ds_title = 'Source Chip';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Source Chip</h1>
    <p>Where a line in an AI result came from: a glyph for the kind of source, a short label, and a link back to it, so the person can check the claim against what was actually said.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            The AI wrote something from material the person gave it and the person should be able to trace it: after each sentence of a Synthesize recap, beside a quote in an Impact Report, under a theme built from notes. One chip per source, straight after the claim it supports.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            It is a topic or metadata tag (<a href="<?= $ds_base ?>/components/demos/pill.php">Pill</a>), a status or a count (<a href="<?= $ds_base ?>/components/demos/badge.php">Badge</a>), or an ordinary link in running text that is not saying where a claim came from.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">In a recap</h3>
        <p class="ds-section-desc">Chips sit inline after the sentence they support. Keep the label short and specific: whose note and when, which poll and how many voted.</p>
        <div class="ds-card ds-measure">
            <p class="ds-prose">Pricing won the vote, 9 of 12. <?= ws_source_chip('Poll 3, 9 of 12', ['kind' => 'poll', 'href' => '#poll-3']) ?> <?= ws_source_chip('Your note 10:31', ['kind' => 'note', 'href' => '#note-42']) ?> Enterprise SSO was the closest miss; two leaders asked for it to come back next quarter. <?= ws_source_chip('Recording 10:18', ['kind' => 'recording', 'href' => '#recording-1018']) ?></p>
        </div>
        <div class="ds-code"><pre>Pricing won the vote, 9 of 12. &lt;?= ws_source_chip('Poll 3, 9 of 12', ['kind' =&gt; 'poll', 'href' =&gt; '#poll-3']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Every kind</h3>
        <p class="ds-section-desc"><code class="ds-code-inline">kind</code> picks the glyph and the words a screen reader hears first. Leave it out and the chip has no glyph.</p>
        <div class="ds-card ds-row">
            <?= ws_source_chip('Your note 10:31', ['kind' => 'note']) ?>
            <?= ws_source_chip('Recording 10:18', ['kind' => 'recording']) ?>
            <?= ws_source_chip('Whiteboard photo', ['kind' => 'photo']) ?>
            <?= ws_source_chip('Pre-read.pdf', ['kind' => 'document']) ?>
            <?= ws_source_chip('Miro board', ['kind' => 'board']) ?>
            <?= ws_source_chip('Poll 3', ['kind' => 'poll']) ?>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Unlinked</h3>
        <p class="ds-section-desc">When the source can no longer be opened (deleted, or never uploaded), <code class="ds-code-inline">'unlinked' =&gt; true</code> drops the link, dashes the border and says "not linked" in words.</p>
        <div class="ds-card">
            <?= ws_source_chip('Whiteboard photo', ['kind' => 'photo', 'unlinked' => true]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_source_chip('Whiteboard photo', ['kind' =&gt; 'photo', 'unlinked' =&gt; true]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">From JavaScript</h3>
        <p class="ds-section-desc"><code class="ds-code-inline">WsAgent.sourceChip(label, options)</code> in <code class="ds-code-inline">/js/ws-agent.js</code> prints the same markup for a recap drawn in the browser.</p>
        <div class="ds-card" id="dsSourceChipJs"></div>
        <div class="ds-code"><pre>line.insertAdjacentHTML('beforeend', ' ' + WsAgent.sourceChip('Help request 10:18', { kind: 'recording', href: '#help-3' }));</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Linked</td><td>An <code>&lt;a&gt;</code>. Hover turns it to the brand tint; keyboard focus draws the focus ring.</td></tr>
            <tr><td>Plain</td><td>No <code>href</code>: a <code>&lt;span&gt;</code>, for a source that has nowhere to open.</td></tr>
            <tr><td>Unlinked</td><td>A <code>&lt;span&gt;</code> with a dashed border and the words "not linked".</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>$label</code></td><td>string</td><td></td><td>Short name of the source</td></tr>
            <tr><td><code>kind</code></td><td>string</td><td><code>null</code></td><td><code>note</code> | <code>recording</code> | <code>photo</code> | <code>document</code> | <code>board</code> | <code>poll</code></td></tr>
            <tr><td><code>href</code></td><td>string</td><td><code>''</code></td><td>Where the source opens; renders a link</td></tr>
            <tr><td><code>unlinked</code></td><td>bool</td><td><code>false</code></td><td>The source can no longer be opened</td></tr>
            <tr><td><code>id</code> / <code>class</code> / <code>attrs</code></td><td>string / string / array</td><td></td><td>Element id, classes and attributes</td></tr>
        </tbody>
    </table>
</section>

<!-- 6. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Element</td><td>A link when it has <code>href</code>, plain text when not, so only chips that go somewhere are in the Tab order.</td></tr>
            <tr><td>Kind in words</td><td>The glyph is <code>aria-hidden</code>; visually hidden words give the kind before the label ("From a poll: Poll 3, 9 of 12"), or "Source:" when there is no kind.</td></tr>
            <tr><td>Unlinked</td><td>Says "not linked" in visible text, so the dashed border is never the only sign.</td></tr>
            <tr><td>Focus</td><td>The sky-blue focus ring, offset from the chip.</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--gray-100</code> / <code>--gray-200</code> / <code>--gray-300</code></td><td>Fill and borders</td></tr>
            <tr><td><code>--brand-tint</code> / <code>--brand-line</code> / <code>--brand-ink</code></td><td>Hover on a linked chip</td></tr>
            <tr><td><code>--text-caption</code> / <code>--radius-sm</code></td><td>Size and shape, small enough to sit inside a sentence</td></tr>
            <tr><td><code>--focus-ring</code> / <code>--focus-ring-offset</code></td><td>Keyboard focus</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-source-chip</code></td><td>The chip; <code>--unlinked</code> when the source cannot be opened</td></tr>
            <tr><td><code>.ws-source-chip__glyph</code></td><td>The kind's glyph</td></tr>
            <tr><td><code>.ws-source-chip__label</code></td><td>The label, which truncates rather than wraps</td></tr>
            <tr><td><code>.ws-source-chip__state</code></td><td>The words "not linked"</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_source_chip()</code> helper</td></tr>
            <tr><td><code>includes/components/source-chip.php</code></td><td>Template</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles, in the agent components section</td></tr>
            <tr><td><code>js/ws-agent.js</code></td><td><code>WsAgent.sourceChip()</code>, the JavaScript twin</td></tr>
        </tbody>
    </table>
</section>

<script src="<?= $site_base ?>/js/ws-agent.js?v=<?= filemtime(__DIR__ . '/../../../js/ws-agent.js') ?>"></script>
<script>
document.getElementById('dsSourceChipJs').innerHTML = 'The group asked for a break at 10:18. ' + WsAgent.sourceChip('Help request 10:18', { kind: 'recording', href: '#help-3' });
</script>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
