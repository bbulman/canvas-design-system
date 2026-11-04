<?php
$ds_page  = 'components/demos/ai-mark';
$ds_title = 'AI Mark';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>AI Mark</h1>
    <p>The one glyph that says the AI made something. Material Symbols auto_awesome, drawn through <code class="ds-code-inline">icon()</code>, in brand red. It replaces the three glyphs AI screens used to choose between.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            Something on the screen was written or proposed by the AI and the person should know to check it: the head of a proposal, a generated summary's title, the avatar beside an AI message, the button that asks the AI for something. The mark is already inside the agent proposal, the agent status and the AI badge, so reach for it on its own only where none of those fits.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The thing was made by a person, or you want a general "new" or "magic" sparkle. The mark means one thing, the AI made this, and it stops meaning it the first time it decorates something else. When the mark needs words beside it, use the <a href="<?= $ds_base ?>/components/demos/badge.php">Badge</a> ai variant.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Sizes</h3>
        <p class="ds-section-desc">Two sizes. <code class="ds-code-inline">sm</code> sits beside body text and inside kickers and badges; <code class="ds-code-inline">md</code>, the default, stands beside a heading or alone.</p>
        <div class="ds-card ds-row">
            <?= ws_ai_mark(['size' => 'sm']) ?>
            <?= ws_ai_mark(['size' => 'md']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_ai_mark(['size' =&gt; 'sm']) ?&gt;
&lt;?= ws_ai_mark() ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Beside words</h3>
        <p class="ds-section-desc">Most of the time the mark sits in front of the words that say what the AI did. The badge ai variant is that pairing, ready-made, and the agent status and agent proposal carry the mark in their titles.</p>
        <div class="ds-card ds-row">
            <?= ws_badge('Prepared by Workshopr', ['variant' => 'ai']) ?>
            <?= ws_agent_status(['label' => 'Reading your notes']) ?>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">From JavaScript</h3>
        <p class="ds-section-desc"><code class="ds-code-inline">WsAgent.aiMark(options)</code> in <code class="ds-code-inline">/js/ws-agent.js</code> prints the same markup, for chat avatars and anything else drawn in the browser. The mark below was drawn by it.</p>
        <div class="ds-card ds-row" id="dsAiMarkJs"></div>
        <div class="ds-code"><pre>&lt;script src="/js/ws-agent.js?v=&lt;?= filemtime(WS_ROOT . '/js/ws-agent.js') ?&gt;"&gt;&lt;/script&gt;
avatar.innerHTML = WsAgent.aiMark({ size: 'md', label: 'Workshopr' });</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Decorative (default)</td><td><code>aria-hidden="true"</code>. The words beside it carry the meaning.</td></tr>
            <tr><td>Labelled</td><td>With <code>label</code> it becomes <code>role="img"</code> named by the label. Use it when the mark stands alone, as an avatar does.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>size</code></td><td>string</td><td><code>'md'</code></td><td><code>sm</code> | <code>md</code></td></tr>
            <tr><td><code>label</code></td><td>string</td><td><code>''</code></td><td>Accessible name. Without one the mark is decorative.</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>''</code></td><td>Element id</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional classes</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Additional attributes</td></tr>
        </tbody>
    </table>
</section>

<!-- 6. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Decorative by default</td><td>The mark is <code>aria-hidden</code>, because the words beside it ("Suggested change", "Prepared by Workshopr") already say the AI made this.</td></tr>
            <tr><td>Standing alone</td><td>Pass <code>label</code> and it becomes <code>role="img"</code> with that name, so an AI avatar is announced rather than skipped.</td></tr>
            <tr><td>Never the only sign</td><td>Someone who cannot see the mark still has to learn the work is AI-made, so there are always words for it: a label, the badge, or the kicker above a proposal.</td></tr>
            <tr><td>Contrast</td><td>Brand red on white and on the brand tint clears 3:1, the bar for a graphic.</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--brand</code></td><td>The glyph</td></tr>
            <tr><td><code>--text-body</code> / <code>--text-h3</code></td><td>The <code>sm</code> and <code>md</code> sizes (the glyph is 1em)</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-ai-mark</code></td><td>The mark's box, 1em square</td></tr>
            <tr><td><code>.ws-ai-mark--sm</code> / <code>--md</code></td><td>Sizes</td></tr>
            <tr><td><code>.ws-ai-mark__glyph</code></td><td>The SVG <code>icon()</code> prints, or the ligature when there is no SVG, clipped to its box</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_ai_mark()</code> helper</td></tr>
            <tr><td><code>includes/components/ai-mark.php</code></td><td>Template</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles, in the agent components section</td></tr>
            <tr><td><code>js/ws-agent.js</code></td><td><code>WsAgent.aiMark()</code>, the JavaScript twin</td></tr>
        </tbody>
    </table>
</section>

<script src="<?= $site_base ?>/js/ws-agent.js?v=<?= filemtime(__DIR__ . '/../../../js/ws-agent.js') ?>"></script>
<script>
document.getElementById('dsAiMarkJs').innerHTML = WsAgent.aiMark({ size: 'sm' }) + WsAgent.aiMark({ size: 'md', label: 'Workshopr' }) + WsAgent.aiBadge('');
</script>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
