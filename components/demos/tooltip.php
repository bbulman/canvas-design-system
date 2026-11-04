<?php
$ds_page  = 'components/demos/tooltip';
$ds_title = 'Tooltip';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Tooltip</h1>
    <p>Supplementary text on hover or focus. Unusually, this helper returns attributes rather than an element.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            A focusable control needs a short clarification &mdash; naming an icon button, expanding a truncated label, explaining a form field. Keep the text to a few words.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The information is required to finish the task &mdash; put it inline, or use <a href="<?= $ds_base ?>/components/demos/alert.php">Alert</a>. Never attach one to a non-focusable element, and never put links or buttons inside; there's no way to reach them.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Positions</h3>
        <p class="ds-section-desc">Four positions. There's no collision detection &mdash; the position you pass is the position you get, so pick one that won't run off the viewport or under a sticky bar.</p>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 16px; justify-content: center; padding: 40px;">
            <button class="ws-btn ws-btn--ghost ws-btn--sm" <?= ws_tooltip('Tooltip on top', ['position' => 'top']) ?>>Top</button>
            <button class="ws-btn ws-btn--ghost ws-btn--sm" <?= ws_tooltip('Tooltip on bottom', ['position' => 'bottom']) ?>>Bottom</button>
            <button class="ws-btn ws-btn--ghost ws-btn--sm" <?= ws_tooltip('Tooltip on left', ['position' => 'left']) ?>>Left</button>
            <button class="ws-btn ws-btn--ghost ws-btn--sm" <?= ws_tooltip('Tooltip on right', ['position' => 'right']) ?>>Right</button>
        </div>
        <div class="ds-code"><pre>&lt;button &lt;?= ws_tooltip('Helpful info', ['position' => 'top']) ?&gt;&gt;Hover me&lt;/button&gt;
&lt;button &lt;?= ws_tooltip('Helpful info', ['position' => 'right']) ?&gt;&gt;Hover me&lt;/button&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Colour</h3>
        <p class="ds-section-desc">Dark by default. Use light only against a dark surface where the dark tooltip would disappear.</p>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 16px; justify-content: center; padding: 40px;">
            <button class="ws-btn ws-btn--ghost ws-btn--sm" <?= ws_tooltip('Dark tooltip (default)') ?>>Dark (default)</button>
            <button class="ws-btn ws-btn--primary ws-btn--sm" <?= ws_tooltip('Light tooltip style', ['variant' => 'light']) ?>>Light</button>
        </div>
        <div class="ds-code"><pre>&lt;button &lt;?= ws_tooltip('Light style', ['variant' => 'light']) ?&gt;&gt;Light&lt;/button&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Without the arrow</h3>
        <p class="ds-section-desc">Drop the arrow when the tooltip sits far enough from its trigger that the pointer would be misleading.</p>
        <div class="ds-card" style="display: flex; justify-content: center; padding: 40px;">
            <button class="ws-btn ws-btn--ghost ws-btn--sm" <?= ws_tooltip('No arrow tooltip', ['arrow' => false]) ?>>No Arrow</button>
        </div>
        <div class="ds-code"><pre>&lt;button &lt;?= ws_tooltip('No arrow', ['arrow' => false]) ?&gt;&gt;Hover me&lt;/button&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Hidden</td><td>Default. The tooltip exists only as a CSS pseudo-element, so there's nothing in the DOM to inspect.</td></tr>
            <tr><td>Hover</td><td>Shown via <code>:hover</code> on the trigger. No delay &mdash; it appears immediately.</td></tr>
            <tr><td>Focus</td><td>Shown via <code>:focus</code>, so keyboard users get the same information as mouse users. This only works if the trigger is genuinely focusable.</td></tr>
            <tr><td>Dismissed</td><td><kbd>Esc</kbd> sets <code>data-tooltip-dismissed="true"</code> on the trigger and CSS hides it, without moving focus &mdash; this is the WCAG 2.2 SC 1.4.13 requirement. The flag clears on the next <code>mouseleave</code> or <code>blur</code>, so the tooltip works again afterwards.</td></tr>
            <tr><td>Touch</td><td>No hover and often no focus, so the tooltip effectively never appears. Assume touch users will not see it.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The archetypal case &mdash; an icon-only toolbar button whose meaning isn't obvious from the glyph. Here the tooltip text also becomes the button's accessible name, which is exactly what you want when there's no visible label.</p>
    <div class="ds-card" style="display: flex; gap: 8px; justify-content: center; padding: 32px;">
        <button class="ws-btn ws-btn--ghost ws-btn--sm ws-btn--icon-only" <?= ws_tooltip('Duplicate workshop') ?>><span class="material-symbols-outlined">content_copy</span></button>
        <button class="ws-btn ws-btn--ghost ws-btn--sm ws-btn--icon-only" <?= ws_tooltip('Share workshop') ?>><span class="material-symbols-outlined">share</span></button>
        <button class="ws-btn ws-btn--ghost ws-btn--sm ws-btn--icon-only" <?= ws_tooltip('Archive workshop') ?>><span class="material-symbols-outlined">inventory_2</span></button>
    </div>
    <div class="ds-code"><pre>&lt;!-- Icon-only: let the tooltip supply the accessible name --&gt;
&lt;button class="ws-btn ws-btn--icon-only" &lt;?= ws_tooltip('Duplicate workshop') ?&gt;&gt;
    &lt;span class="material-symbols-outlined"&gt;content_copy&lt;/span&gt;
&lt;/button&gt;

&lt;!-- Labelled control: suppress the aria-label so the visible text wins --&gt;
&lt;button class="ws-btn" &lt;?= ws_tooltip('Saves to your library', ['label' => false]) ?&gt;&gt;
    Save workshop
&lt;/button&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <p class="ds-section-desc"><code class="ds-code-inline">ws_tooltip()</code> returns a string of HTML <strong>attributes</strong>, not an element. Echo it inside a tag, never as a child of one.</p>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>$text</code></td><td>string</td><td><code>''</code></td><td>Positional tooltip text. Escaped for both the data attribute and the label.</td></tr>
            <tr><td><code>position</code></td><td>string</td><td><code>'top'</code></td><td><code>top</code> | <code>bottom</code> | <code>left</code> | <code>right</code></td></tr>
            <tr><td><code>variant</code></td><td>string</td><td><code>'dark'</code></td><td><code>dark</code> | <code>light</code></td></tr>
            <tr><td><code>arrow</code></td><td>bool</td><td><code>true</code></td><td>Show the pointer arrow. Only <code>false</code> emits an attribute.</td></tr>
            <tr><td><code>label</code></td><td>bool</td><td><code>true</code></td><td>Emit <code>aria-label</code> with the tooltip text. <strong>Set this to <code>false</code> on any control that already has visible text</strong> &mdash; see below.</td></tr>
        </tbody>
    </table>
    <div class="ds-code"><pre>&lt;!-- The helper outputs attributes like: --&gt;
data-tooltip="Duplicate workshop"
data-tooltip-position="top"
data-tooltip-variant="dark"
aria-label="Duplicate workshop"</pre></div>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <p class="ds-section-desc">The implementation is CSS-only, so it doesn't follow the <a href="https://www.w3.org/WAI/ARIA/apg/patterns/tooltip/" target="_blank" rel="noopener">WAI-ARIA Tooltip pattern</a> literally &mdash; a pseudo-element can't carry <code class="ds-code-inline">role="tooltip"</code> and there's no node for <code class="ds-code-inline">aria-describedby</code> to point at. It reaches the same outcome through <code class="ds-code-inline">aria-label</code> instead.</p>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>ARIA</td><td>With <code>label: true</code> (the default) the trigger gets <code>aria-label</code> carrying the tooltip text. There is no <code>role="tooltip"</code> and no <code>aria-describedby</code> &mdash; the visual tooltip is a pseudo-element and invisible to assistive tech.</td></tr>
            <tr><td>Naming vs describing</td><td><strong>The critical distinction.</strong> <code>aria-label</code> <em>replaces</em> the accessible name. On an icon-only button that's ideal. On a button with visible text it overrides that text, which breaks WCAG 2.5.3 Label in Name and desyncs voice control. Pass <code>label =&gt; false</code> there.</td></tr>
            <tr><td>Keyboard</td><td>Appears on <kbd>Tab</kbd> focus and hides on blur, both from CSS. <kbd>Esc</kbd> dismisses without moving focus.</td></tr>
            <tr><td>Focusable triggers only</td><td>On a <code>&lt;span&gt;</code> or <code>&lt;div&gt;</code> the tooltip is hover-only &mdash; unreachable by keyboard and unannounced. Attach only to buttons, links, and inputs, or add <code>tabindex="0"</code>.</td></tr>
            <tr><td>Touch</td><td>Not available without hover. Never let a tooltip be the only place important information lives.</td></tr>
            <tr><td>Contrast</td><td>Dark and light variants each pair tested foreground and background tokens.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <p class="ds-section-desc">Tooltip styling lives on attribute selectors rather than a class block, so its declarations sit outside the usual <code class="ds-code-inline">.ws-*</code> rules. It draws on the shared ink, surface, radius, and type scales &mdash; see <a href="<?= $ds_base ?>/resources/tokens.php">Token Reference</a> for current values, and read the <code class="ds-code-inline">[data-tooltip]</code> rules in <code class="ds-code-inline">components.css</code> for the exact set.</p>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <p class="ds-section-desc">There are none &mdash; this component is styled entirely through attribute selectors, which is why it composes onto any element without touching its class list.</p>
    <table class="ds-table">
        <thead><tr><th>Selector</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>[data-tooltip]</code></td><td>Base styles. Content comes from <code>content: attr(data-tooltip)</code>.</td></tr>
            <tr><td><code>[data-tooltip-position="top|bottom|left|right"]</code></td><td>Placement</td></tr>
            <tr><td><code>[data-tooltip-variant="light"]</code></td><td>Light colour scheme</td></tr>
            <tr><td><code>[data-tooltip-arrow="false"]</code></td><td>Suppresses the arrow</td></tr>
            <tr><td><code>[data-tooltip-dismissed="true"]</code></td><td>Set by the <kbd>Esc</kbd> handler; hides the tooltip until pointer or focus leaves</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_tooltip()</code> helper function</td></tr>
            <tr><td><code>includes/components/tooltip.php</code></td><td>Template &mdash; builds the attribute string</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Pseudo-element styling (<code>[data-tooltip]</code> rules)</td></tr>
            <tr><td><code>includes/components/components.js</code></td><td><kbd>Esc</kbd> dismissal for WCAG 2.2 SC 1.4.13, and the flag cleanup on <code>mouseleave</code>/<code>blur</code></td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
