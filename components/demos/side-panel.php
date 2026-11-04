<?php
$ds_page  = 'components/demos/side-panel';
$ds_title = 'Side Panel';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Side Panel</h1>
    <p>A panel that slides in from the right edge, beside the page rather than in front of it. The page stays live while it is open.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            The work runs alongside what is open and the reader needs both at once: a workshop's comments beside its agenda, notes beside a running session. It is opened from a control in the page's own chrome, usually an icon on the <a href="<?= $ds_base ?>/components/demos/app-bar.php">App Bar</a>.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The reader has to finish or refuse something before going on. That is a <a href="<?= $ds_base ?>/components/demos/modal.php">Modal</a>, which traps focus and holds the page still; a side panel does neither.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Heading, subtitle and a body</h3>
        <p class="ds-section-desc">One shape. The head carries the title, an optional line under it, and the close button; the body scrolls on its own. Open it from the button below: any element with <code>data-ws-side-panel-open</code> toggles the panel it names.</p>
        <div class="ds-card">
            <?= ws_button('Open the panel', ['variant' => 'secondary', 'icon' => 'mode_comment', 'id' => 'dsSidePanelOpen', 'attrs' => [
                'data-ws-side-panel-open' => 'dsSidePanel', 'aria-controls' => 'dsSidePanel', 'aria-expanded' => 'false',
            ]]) ?>
        </div>
        <?= ws_side_panel(
            '<p class="ds-section-desc">The body is whatever the feature needs: a form, a list, a thread. It scrolls inside the panel, so a long thread never pushes the head away.</p>'
            . ws_form_row(ws_input('demo_note', ['type' => 'textarea', 'rows' => 3, 'placeholder' => 'A note beside the page']), ['label' => 'Note'])
            . ws_button('Save note', ['variant' => 'primary', 'fullWidth' => true, 'type' => 'button']),
            ['id' => 'dsSidePanel', 'title' => 'Leave a comment', 'subtitle' => 'Everyone working on this workshop reads what you post here.']
        ) ?>
        <div class="ds-code"><pre>&lt;?= ws_side_panel($bodyHtml, [
    'id'       =&gt; 'wsComments',
    'title'    =&gt; 'Leave a comment',
    'subtitle' =&gt; 'Everyone working on this workshop reads what you post here.',
]) ?&gt;

&lt;?= ws_button('Comments', ['icon' =&gt; 'mode_comment', 'attrs' =&gt; [
    'data-ws-side-panel-open' =&gt; 'wsComments',
    'aria-controls'           =&gt; 'wsComments',
    'aria-expanded'           =&gt; 'false',
]]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Branded</h3>
        <p class="ds-section-desc"><code>'variant' =&gt; 'branded'</code> puts the head on the red band the branded <a href="<?= $ds_base ?>/components/demos/modal.php">Modal</a> wears: white title, the subtitle and close stepped back, and an optional <code>icon</code> in a pill. The comments panel wears it.</p>
        <div class="ds-card">
            <?= ws_button('Open the branded panel', ['variant' => 'secondary', 'icon' => 'mode_comment', 'id' => 'dsSidePanelBrandedOpen', 'attrs' => [
                'data-ws-side-panel-open' => 'dsSidePanelBranded', 'aria-controls' => 'dsSidePanelBranded', 'aria-expanded' => 'false',
            ]]) ?>
        </div>
        <?= ws_side_panel(
            '<p class="ds-section-desc">The same body, under the red band.</p>',
            ['id' => 'dsSidePanelBranded', 'title' => 'Leave a comment', 'subtitle' => 'Everyone working on this workshop reads what you post here.', 'variant' => 'branded', 'icon' => 'mode_comment']
        ) ?>
        <div class="ds-code"><pre>&lt;?= ws_side_panel($bodyHtml, [
    'id'      =&gt; 'wsComments',
    'title'   =&gt; 'Leave a comment',
    'variant' =&gt; 'branded',
    'icon'    =&gt; 'mode_comment',
]) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">Each phase's comments (<code>app/includes/comments-panel.php</code>): the Comments button sits beside the save on Strategize, Plan, Facilitate and Synthesize's red bars, and the panel it opens holds the Leave a comment form and the workshop's thread. The panel loads its thread when it opens, from the <code>ws-side-panel-open</code> event.</p>
</section>

<!-- 5. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>$body</code></td><td>string</td><td>Panel body HTML, already escaped by the caller</td></tr>
            <tr><td><code>id</code></td><td>string</td><td>Required. Triggers point at it, and the heading and subtitle take <code>{id}-title</code> and <code>{id}-subtitle</code></td></tr>
            <tr><td><code>title</code></td><td>string</td><td>The heading, in Fraunces</td></tr>
            <tr><td><code>subtitle</code></td><td>string</td><td>One line under the heading; a script can reword it through <code>#{id}-subtitle</code></td></tr>
            <tr><td><code>variant</code></td><td>string</td><td><code>default</code> or <code>branded</code>, the red header band</td></tr>
            <tr><td><code>icon</code></td><td>string</td><td>A Material Symbols name, in a pill beside the heading</td></tr>
            <tr><td><code>class</code></td><td>string</td><td>Additional classes</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td>Additional attributes</td></tr>
        </tbody>
    </table>
    <p class="ds-section-desc">Scripting: <code>wsSidePanelOpen(id, trigger)</code>, <code>wsSidePanelClose(id)</code> and <code>wsSidePanelToggle(id, trigger)</code>. The panel fires <code>ws-side-panel-open</code> and <code>ws-side-panel-close</code> on itself.</p>
</section>

<!-- 6. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <ul class="ds-list">
        <li>A non-modal dialog: <code>role="dialog"</code> with <code>aria-modal="false"</code>, named by its heading. Nothing behind it goes inert and focus is not trapped.</li>
        <li>Opening moves focus to the panel; closing hands it back to the control that opened it, but only if focus was still in the panel.</li>
        <li>Escape closes it while focus is in the panel or on its toggle. A modal open on top keeps Escape for itself.</li>
        <li>Every toggle's <code>aria-expanded</code> follows the panel. On the App Bar an open panel's button turns white with a red icon, and the panel starts under the bar, so that button stays in reach to close it. If the bar scrolls with its page, the panel's top follows it up to <code>--ws-side-panel-top</code>.</li>
        <li>Once it has slid out it takes <code>[hidden]</code>, so it leaves the tab order and the accessibility tree. Under reduced motion the slide is instant.</li>
    </ul>
</section>

<!-- 7. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Use</th></tr></thead>
        <tbody>
            <tr><td><code>--ws-side-panel-top</code> / <code>--ws-side-panel-bottom</code></td><td>Where it starts and stops (default 0). The app shell keeps its 60px header and its footer clear. Below 600px the panel takes the whole screen</td></tr>
            <tr><td><code>--ws-side-panel-width</code></td><td>360px by default, never wider than the viewport</td></tr>
            <tr><td><code>--duration-enter</code> + <code>--ease-spring</code></td><td>Sliding in</td></tr>
            <tr><td><code>--duration-exit</code> + <code>--ease-in</code></td><td>Sliding out</td></tr>
            <tr><td><code>--z-overlay</code> minus 100</td><td>One step under overlays, so a modal, a toast, a header menu or the launcher opened while it is out lands on top of it</td></tr>
            <tr><td><code>--shadow-lg</code>, <code>--bg-surface</code>, <code>--gray-200</code></td><td>Lift, surface and the left edge</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-side-panel</code></td><td>The panel; <code>.is-open</code> while it is in view</td></tr>
            <tr><td><code>.ws-side-panel__head</code></td><td>Heading block and close button</td></tr>
            <tr><td><code>.ws-side-panel__title</code> / <code>__subtitle</code></td><td>The heading and the line under it</td></tr>
            <tr><td><code>.ws-side-panel__close</code></td><td>The close button</td></tr>
            <tr><td><code>.ws-side-panel__body</code></td><td>The scrolling body</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_side_panel()</code> helper function</td></tr>
            <tr><td><code>includes/components/side-panel.php</code></td><td>Template</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-side-panel</code> rules)</td></tr>
            <tr><td><code>includes/components/components.js</code></td><td><code>wsSidePanelOpen/Close/Toggle()</code>, the delegated toggles and Escape</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
