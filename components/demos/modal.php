<?php
$ds_page  = 'components/demos/modal';
$ds_title = 'Modal';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Modal</h1>
    <p>Interrupts the page for one focused task, trapping keyboard focus until it's resolved.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            A task must be finished or abandoned before the page continues &mdash; confirming a destructive action, a short focused form, a detail view that would otherwise lose the reader's place.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The content belongs on a page of its own, or the message needs no decision &mdash; use <a href="<?= $ds_base ?>/components/demos/toast.php">Toast</a> or <a href="<?= $ds_base ?>/components/demos/alert.php">Alert</a>. Never stack one modal on another.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Sizes</h3>
        <p class="ds-section-desc">Five widths. Pick the smallest that fits &mdash; a large modal holding one sentence reads as an error.</p>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 12px;">
            <button class="ws-btn ws-btn--ghost ws-btn--sm" onclick="wsModalOpen('demo-modal-sm')">Small</button>
            <button class="ws-btn ws-btn--ghost ws-btn--sm" onclick="wsModalOpen('demo-modal')">Default</button>
            <button class="ws-btn ws-btn--ghost ws-btn--sm" onclick="wsModalOpen('demo-modal-lg')">Large</button>
        </div>
        <table class="ds-table">
            <thead><tr><th>Size</th><th>Use for</th></tr></thead>
            <tbody>
                <tr><td><code>sm</code></td><td>Confirmations and single-question prompts</td></tr>
                <tr><td><code>default</code></td><td>Most cases &mdash; a short form or a paragraph with actions</td></tr>
                <tr><td><code>lg</code></td><td>Multi-field forms</td></tr>
                <tr><td><code>xl</code></td><td>Dense content such as a picker with a preview</td></tr>
                <tr><td><code>full</code></td><td>Near-fullscreen. Consider whether this should be a page instead.</td></tr>
            </tbody>
        </table>
        <div class="ds-code"><pre>&lt;?php ws_modal_start(['id' => 'my-modal', 'title' => 'Modal Title', 'size' => 'lg']); ?&gt;
    &lt;p&gt;Modal content here&lt;/p&gt;
&lt;?php ws_modal_end(); ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Presentation</h3>
        <p class="ds-section-desc">Beyond the centred dialog, <code class="ds-code-inline">variant</code> offers <code class="ds-code-inline">drawer</code> (slides from the edge) and <code class="ds-code-inline">bottom-sheet</code> (rises from the bottom, suited to touch).</p>
        <div class="ds-code"><pre>&lt;?php ws_modal_start(['id' => 'filters', 'title' => 'Filters', 'variant' => 'drawer']); ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Branded header</h3>
        <p class="ds-section-desc">The red header band the planner dialogs, the Agenda Check dialog and the app launcher wear, available by name: <code class="ds-code-inline">variant =&gt; 'branded'</code>. Reach for this before <code class="ds-code-inline">headerColor</code> &mdash; the variant is one vocabulary across the platform, where a per-call colour is a fork waiting to drift. (The variant was documented in the JSON long before it had styles; it renders properly as of v2.197.0.)</p>
        <div class="ds-card">
            <button class="ws-btn ws-btn--secondary ws-btn--md" onclick="wsModalOpen('demo-modal-branded')">Branded modal</button>
        </div>
        <div class="ds-code"><pre>&lt;?php ws_modal_start([
    'id'      => 'planCheckModal',
    'title'   => 'Check an agenda',
    'variant' => 'branded',
]); ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Coloured header</h3>
        <p class="ds-section-desc">A custom header background, for the rare surface whose colour genuinely isn't the brand band. Pass a token reference rather than a literal hex so the modal follows the palette.</p>
        <div class="ds-card">
            <button class="ws-btn ws-btn--secondary ws-btn--md" onclick="wsModalOpen('demo-modal-red')">Coloured header modal</button>
        </div>
        <div class="ds-code"><pre>&lt;?php ws_modal_start([
    'id'          => 'planner-modal',
    'title'       => 'Save Workshop',
    'headerColor' => 'var(--brand)',
]); ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Title adornments</h3>
        <p class="ds-section-desc">An <code class="ds-code-inline">icon</code> renders in a pill beside the title, and <code class="ds-code-inline">subtitle</code> adds a line beneath it. The subtitle accepts HTML for inline emphasis.</p>
        <div class="ds-code"><pre>&lt;?php ws_modal_start([
    'id'       => 'import',
    'title'    => 'Import session',
    'subtitle' => 'From &lt;strong&gt;Q3 Planning Offsite&lt;/strong&gt;',
    'icon'     => 'hub',
]); ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Closed</td><td>Default. The overlay is in the DOM without <code>.is-open</code> and hidden by CSS &mdash; markup renders inline on the page, wherever you placed it.</td></tr>
            <tr><td>Open</td><td><code>wsModalOpen(id)</code> adds <code>.is-open</code>, sets <code>body { overflow: hidden }</code> to stop background scroll, engages the focus trap, and fires a bubbling <code>ws-modal-open</code> event.</td></tr>
            <tr><td>Closing</td><td><code>wsModalClose(id)</code> reverses all of that, releases the trap, and fires <code>ws-modal-close</code>.</td></tr>
            <tr><td>Backdrop click</td><td>Closes when <code>backdrop</code> is true &mdash; wired at DOM-ready via <code>data-close-on-click</code>, and only when the click target is the overlay itself.</td></tr>
            <tr><td>Escape</td><td>A document-level handler closes whichever overlay has <code>.is-open</code>, unless it carries <code>data-closable="false"</code>.</td></tr>
            <tr><td>Not closable</td><td><code>closable: false</code> hides the close button and blocks Esc. Backdrop dismissal is controlled separately by <code>backdrop</code> &mdash; set both to <code>false</code> for a modal that can only be resolved by acting.</td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">info</span>
        <span>Both events bubble, so a single listener on <code>document</code> can track modal usage rather than wiring each one.</span>
    </div>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">A destructive confirmation: small size, the consequence stated plainly in the body, and a <a href="<?= $ds_base ?>/components/demos/modal-footer.php">Modal Footer</a> putting the danger action on the right.</p>
    <div class="ds-card">
        <button class="ws-btn ws-btn--danger ws-btn--md" onclick="wsModalOpen('demo-modal-confirm')">Delete workshop&hellip;</button>
    </div>
    <div class="ds-code"><pre>&lt;?php ws_modal_start([
    'id'    => 'confirm-delete',
    'title' => 'Delete this workshop?',
    'size'  => 'sm',
]); ?&gt;
    &lt;p&gt;&lt;strong&gt;Q3 Planning Offsite&lt;/strong&gt; and its 12 agenda items
       will be permanently removed. This cannot be undone.&lt;/p&gt;
    &lt;?= ws_modal_footer([
        'cancel'  => ['text' => 'Keep it'],
        'primary' => ['text' => 'Delete workshop', 'class' => 'ws-btn--danger'],
    ]) ?&gt;
&lt;?php ws_modal_end(); ?&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <p class="ds-section-desc">Content goes between <code class="ds-code-inline">ws_modal_start()</code> and <code class="ds-code-inline">ws_modal_end()</code>. <code class="ds-code-inline">ws_modal($content, $options)</code> is the same thing for a string.</p>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>id</code></td><td>string</td><td><code>'ws-modal-' . uniqid()</code></td><td>Effectively required &mdash; the JS API targets it. Auto-generated IDs can't be reopened.</td></tr>
            <tr><td><code>title</code></td><td>string</td><td><code>null</code></td><td>Header title. Also the modal's accessible name via <code>aria-labelledby</code>.</td></tr>
            <tr><td><code>subtitle</code></td><td>string</td><td><code>null</code></td><td>Line below the title. HTML allowed, so escape any user data.</td></tr>
            <tr><td><code>icon</code></td><td>string</td><td><code>null</code></td><td>Material icon in a pill beside the title</td></tr>
            <tr><td><code>size</code></td><td>string</td><td><code>'default'</code></td><td><code>sm</code> | <code>default</code> | <code>lg</code> | <code>xl</code> | <code>full</code></td></tr>
            <tr><td><code>variant</code></td><td>string</td><td><code>'default'</code></td><td><code>default</code> | <code>drawer</code> | <code>bottom-sheet</code> | <code>branded</code></td></tr>
            <tr><td><code>closable</code></td><td>bool</td><td><code>true</code></td><td>Show the close button. <strong>Spelled <code>closable</code></strong>, not <code>closeable</code> &mdash; this page previously documented the wrong spelling, which is silently ignored.</td></tr>
            <tr><td><code>backdrop</code></td><td>bool</td><td><code>true</code></td><td>Close on backdrop click</td></tr>
            <tr><td><code>headerColor</code></td><td>string</td><td><code>null</code></td><td>Custom header background</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra HTML attributes</td></tr>
        </tbody>
    </table>

    <h3 class="ds-subsection-title">JavaScript API</h3>
    <div class="ds-code"><pre>wsModalOpen('my-modal');    // open
wsModalClose('my-modal');   // close
wsModalToggle('my-modal');  // toggle

document.addEventListener('ws-modal-open',  e =&gt; { /* e.target is the overlay */ });
document.addEventListener('ws-modal-close', e =&gt; { /* … */ });</pre></div>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <p class="ds-section-desc">Partially conformant with the <a href="https://www.w3.org/WAI/ARIA/apg/patterns/dialog-modal/" target="_blank" rel="noopener">WAI-ARIA Dialog (Modal) pattern</a>. The table below reflects what the code actually does &mdash; two commonly-assumed behaviours are missing.</p>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>ARIA</td><td>The dialog carries <code>role="dialog"</code>, <code>aria-modal="true"</code>, and <code>aria-labelledby</code> pointing at the title element. The close button is labelled <code>aria-label="Close modal"</code>.</td></tr>
            <tr><td>Focus trap</td><td><strong>Implemented.</strong> <code>wsTrapFocus()</code> collects focusable elements and wraps <kbd>Tab</kbd> and <kbd>Shift+Tab</kbd> at the ends. The listener is removed on close, and re-binding is guarded against duplicates.</td></tr>
            <tr><td>Initial focus</td><td>Focus moves to the first focusable element inside the modal once the open transition settles. If there are none, the trap exits early and focus stays put.</td></tr>
            <tr><td>Escape</td><td>Closes the open overlay from a document-level handler, honouring <code>closable</code>.</td></tr>
            <tr><td>Focus return</td><td><strong>Implemented.</strong> The element focused before opening is restored on close, so keyboard users resume where they were rather than at the top of the page.</td></tr>
            <tr><td>Background scroll</td><td>Locked via <code>body { overflow: hidden }</code> while open.</td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">check_circle</span>
        <span><strong>Fixed July 2026,</strong> covered by <code>tests/modal-focus.spec.js</code>:
        <br>(1) <strong>Initial focus now actually enters the dialog.</strong> It never did: the overlay animates in from <code>visibility: hidden</code>, and an unrendered element can't take focus, so the <code>focus()</code> call was a silent no-op and focus stayed on the trigger &mdash; outside the trap. <code>wsFocusWhenVisible()</code> now waits for the transition to settle. Waiting a single frame isn't enough; the overlay reads <code>visible</code> while still mid-fade and only becomes focusable once painted.
        <br>(2) <strong>Focus returns to the trigger.</strong> <code>wsModalOpen()</code> records <code>document.activeElement</code> and <code>wsModalClose()</code> restores it, guarded on <code>isConnected</code> in case the trigger was removed meanwhile.
        <br>(3) <strong><code>closable: false</code> blocks Esc.</strong> The template emits <code>data-closable="false"</code> and the handler skips those overlays.</span>
    </div>
    <div class="ds-note">
        <span class="material-symbols-outlined">warning</span>
        <span><strong>Still open:</strong> background content is not inert. No <code>inert</code> or <code>aria-hidden</code> is applied outside the dialog, so a screen reader can still browse the page behind it &mdash; the focus trap covers <kbd>Tab</kbd> but not virtual-cursor navigation. Fixing it properly means marking siblings inert on open and restoring them on close, which touches page structure rather than the component alone.</span>
    </div>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--modal-bg</code> / <code>--modal-radius</code> / <code>--modal-shadow</code></td><td>Dialog surface, corners, and elevation</td></tr>
            <tr><td><code>--modal-backdrop</code></td><td>Overlay scrim</td></tr>
            <tr><td><code>--z-modal</code> / <code>--z-modal-backdrop</code></td><td>Stacking order</td></tr>
            <tr><td><code>--border-default</code> / <code>--gray-100</code> / <code>--gray-200</code></td><td>Header and footer dividers</td></tr>
            <tr><td><code>--gray-300</code> / <code>--gray-500</code></td><td>Close button, resting and hover</td></tr>
            <tr><td><code>--text-dark</code> / <code>--text-inverse</code></td><td>Title, and title on a coloured header</td></tr>
            <tr><td><code>--text-h4</code> / <code>--text-meta</code></td><td>Title and subtitle type scale</td></tr>
            <tr><td><code>--font-heading</code> / <code>--font-semibold</code></td><td>Fraunces title and its weight</td></tr>
            <tr><td><code>--radius-2xl</code> / <code>--radius-md</code></td><td>Dialog and icon-pill corners</td></tr>
            <tr><td><code>--space-2</code> / <code>--space-3</code></td><td>Header and footer internal spacing</td></tr>
            <tr><td><code>--transition-interactive</code> / <code>--transition-slow</code></td><td>Close-button hover, and the open/close animation</td></tr>
            <tr><td><code>--icon-lg</code></td><td>Icons, at least 24px on every page (DESIGN.md §8)</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-modal-overlay</code></td><td>Backdrop and positioning layer. Its ID is <code>{id}-overlay</code> &mdash; the node the JS toggles.</td></tr>
            <tr><td><code>.ws-modal-overlay--drawer</code></td><td>Drawer-variant overlay</td></tr>
            <tr><td><code>.ws-modal-overlay.is-open</code></td><td>Open state</td></tr>
            <tr><td><code>.ws-modal</code></td><td>The dialog &mdash; carries <code>role="dialog"</code></td></tr>
            <tr><td><code>.ws-modal--sm / --default / --lg / --xl / --full</code></td><td>Size modifiers</td></tr>
            <tr><td><code>.ws-modal--drawer / --bottom-sheet</code></td><td>Presentation variants</td></tr>
            <tr><td><code>.ws-modal__header</code></td><td>Header bar</td></tr>
            <tr><td><code>.ws-modal__header--illustrated</code></td><td>Header with artwork</td></tr>
            <tr><td><code>.ws-modal__title-wrap</code> / <code>__title</code> / <code>__subtitle</code></td><td>Title block</td></tr>
            <tr><td><code>.ws-modal__icon</code></td><td>Icon pill beside the title</td></tr>
            <tr><td><code>.ws-modal__close</code></td><td>Close button</td></tr>
            <tr><td><code>.ws-modal__body</code></td><td>Scrollable content region</td></tr>
            <tr><td><code>.ws-modal__footer</code> / <code>--between</code> / <code>--start</code></td><td>Footer and its alignment modifiers</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_modal_start()</code>, <code>ws_modal_end()</code>, <code>ws_modal()</code></td></tr>
            <tr><td><code>includes/components/modal.php</code></td><td>Opening markup &mdash; overlay, dialog, header, ARIA</td></tr>
            <tr><td><code>includes/components/modal-close.php</code></td><td>Closing markup emitted by <code>ws_modal_end()</code></td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-modal</code> rules)</td></tr>
            <tr><td><code>includes/components/components.js</code></td><td><code>wsModalOpen/Close/Toggle()</code>, <code>wsTrapFocus()</code>, <code>wsReleaseFocus()</code>, <code>wsFocusWhenVisible()</code>, and the Esc/backdrop handlers</td></tr>
            <tr><td><code>tests/modal-focus.spec.js</code></td><td>Playwright coverage for initial focus, focus return, and Esc with <code>closable: false</code></td></tr>
        </tbody>
    </table>
</section>

<!-- Demo modals -->
<?php ws_modal_start(['id' => 'demo-modal', 'title' => 'Default Modal', 'size' => 'default']); ?>
    <p style="margin-bottom: 16px;">A standard centred dialog with a backdrop.</p>
    <p>Click the backdrop or press <kbd>Esc</kbd> to close.</p>
<?php ws_modal_end(); ?>

<?php ws_modal_start(['id' => 'demo-modal-sm', 'title' => 'Small Modal', 'size' => 'sm']); ?>
    <p>A compact modal for confirmations.</p>
<?php ws_modal_end(); ?>

<?php ws_modal_start(['id' => 'demo-modal-lg', 'title' => 'Large Modal', 'size' => 'lg']); ?>
    <p style="margin-bottom: 16px;">A larger modal for multi-field forms.</p>
    <div style="display: grid; gap: 16px;">
        <?= ws_input('modal_name', ['label' => 'Name', 'placeholder' => 'Enter name…']) ?>
        <?= ws_input('modal_email', ['type' => 'email', 'label' => 'Email', 'placeholder' => 'you@example.com']) ?>
    </div>
<?php ws_modal_end(); ?>

<?php ws_modal_start(['id' => 'demo-modal-branded', 'title' => 'Branded', 'size' => 'default', 'variant' => 'branded']); ?>
<p>The named form of the red header band. One vocabulary, no per-call colour.</p>
<?php
echo ws_modal_footer([
    'cancel'  => ['text' => 'Close', 'attrs' => ['onclick' => "wsModalClose('demo-modal-branded')"]],
]);
ws_modal_end();
?>

<?php ws_modal_start(['id' => 'demo-modal-red', 'title' => 'Coloured Header', 'size' => 'default', 'headerColor' => 'var(--brand)']); ?>
    <p style="margin-bottom: 16px;">A coloured header, as used in the Planner.</p>
    <?= ws_modal_footer([
        'cancel'  => ['text' => 'Cancel', 'attrs' => ['onclick' => "wsModalClose('demo-modal-red')"]],
        'primary' => ['text' => 'Save'],
    ]) ?>
<?php ws_modal_end(); ?>

<?php ws_modal_start(['id' => 'demo-modal-confirm', 'title' => 'Delete this workshop?', 'size' => 'sm']); ?>
    <p style="margin-bottom: 8px;"><strong>Q3 Planning Offsite</strong> and its 12 agenda items will be permanently removed. This cannot be undone.</p>
    <?= ws_modal_footer([
        'cancel'  => ['text' => 'Keep it', 'attrs' => ['onclick' => "wsModalClose('demo-modal-confirm')"]],
        'primary' => ['text' => 'Delete workshop', 'class' => 'ws-btn--danger'],
    ]) ?>
<?php ws_modal_end(); ?>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
