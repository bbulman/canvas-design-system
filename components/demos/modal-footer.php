<?php
$ds_page  = 'components/demos/modal-footer';
$ds_title = 'Modal Footer';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Modal Footer</h1>
    <p>Fixes the button order in a modal's action row, so every dialog on the platform resolves the same way.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            Any <a href="<?= $ds_base ?>/components/demos/modal.php">Modal</a> needs actions. It replaced the hand-written footers across 30-plus modals, which is precisely the value &mdash; cancel and confirm land in the same place every time.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The actions aren't in a modal. For a form's own submit row, lay out <a href="<?= $ds_base ?>/components/demos/button.php">Button</a> directly &mdash; this component's border and padding assume a dialog edge.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Cancel and confirm</h3>
        <p class="ds-section-desc">The default. Cancel is a ghost button, the primary sits to its right &mdash; the rightmost position being the one people reach for.</p>
        <div class="ds-card" style="padding: 0;">
            <?= ws_modal_footer([
                'cancel' => ['text' => 'Cancel', 'id' => 'cancelBtn'],
                'primary' => ['text' => 'Export Now', 'id' => 'exportBtn'],
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_modal_footer([
    'cancel'  => ['text' => 'Cancel',     'id' => 'cancelBtn'],
    'primary' => ['text' => 'Export Now', 'id' => 'exportBtn'],
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With a left action</h3>
        <p class="ds-section-desc">A third button, pushed to the far left, for a secondary path that isn't cancelling &mdash; downloading, learning more, switching method. Keep it visually quieter than the primary.</p>
        <div class="ds-card" style="padding: 0;">
            <?= ws_modal_footer([
                'left' => ['text' => 'Download .ics', 'icon' => 'download', 'id' => 'downloadBtn', 'variant' => 'ghost'],
                'cancel' => ['text' => 'Cancel', 'id' => 'cancelBtn2'],
                'primary' => ['text' => 'Send Invite', 'id' => 'sendBtn', 'icon' => 'send'],
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_modal_footer([
    'left'    => ['text' => 'Download .ics', 'icon' => 'download', 'variant' => 'ghost'],
    'cancel'  => ['text' => 'Cancel'],
    'primary' => ['text' => 'Send Invite',   'icon' => 'send'],
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Single full-width action</h3>
        <p class="ds-section-desc">When there's nothing to cancel &mdash; an acknowledgement, or a modal whose only exit is the close button. Adds <code class="ds-code-inline">.ws-modal-footer--single</code>.</p>
        <div class="ds-card" style="padding: 0;">
            <?= ws_modal_footer([
                'primary' => ['text' => 'Add Activity', 'id' => 'addBtn', 'fullWidth' => true],
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_modal_footer([
    'primary' => ['text' => 'Add Activity', 'fullWidth' => true],
]) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>A top border separating the footer from the modal body, with the buttons right-aligned in <code>.ws-modal-footer__right</code>.</td></tr>
            <tr><td>With a left action</td><td>The left button occupies <code>.ws-modal-footer__left</code> and the row becomes space-between.</td></tr>
            <tr><td>Single</td><td><code>.ws-modal-footer--single</code> adjusts the layout so one full-width button fills the row.</td></tr>
            <tr><td>Button states</td><td>Hover, focus, disabled, and loading all belong to <a href="<?= $ds_base ?>/components/demos/button.php">Button</a>. Pass <code>loading</code> or <code>disabled</code> through the relevant slot's array.</td></tr>
            <tr><td>Omitted slots</td><td>Every slot is optional. Passing none renders an empty bordered strip &mdash; skip the call instead.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">A destructive confirmation. The primary slot takes <code class="ds-code-inline">variant</code>, so the confirm button becomes the danger variant while keeping its position &mdash; muscle memory intact, colour signalling the consequence.</p>
    <div class="ds-card" style="padding: 0;">
        <?= ws_modal_footer([
            'cancel' => ['text' => 'Keep it', 'id' => 'keepBtn'],
            'primary' => ['text' => 'Delete workshop', 'id' => 'deleteBtn', 'icon' => 'delete', 'variant' => 'danger'],
        ]) ?>
    </div>
    <div class="ds-code"><pre>&lt;?php ws_modal_start(['id' => 'confirm-delete', 'title' => 'Delete this workshop?', 'size' => 'sm']); ?&gt;
    &lt;p&gt;This cannot be undone.&lt;/p&gt;
    &lt;?= ws_modal_footer([
        'cancel'  => ['text' => 'Keep it',
                      'attrs' => ['onclick' => "wsModalClose('confirm-delete')"]],
        'primary' => ['text'    => 'Delete workshop',
                      'icon'    => 'delete',
                      'variant' => 'danger',
                      'attrs' => ['onclick' => 'deleteWorkshop(42)']],
    ]) ?&gt;
&lt;?php ws_modal_end(); ?&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <p class="ds-section-desc">Three button slots plus wrapper options. Each slot takes an array that's forwarded to <code class="ds-code-inline">ws_button()</code>, so anything Button accepts works there.</p>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>cancel</code></td><td>array</td><td><code>null</code></td><td>Dismiss button, rendered as a ghost. Accepts <code>text</code>, <code>id</code>, <code>class</code>, <code>attrs</code>.</td></tr>
            <tr><td><code>primary</code></td><td>array</td><td><code>null</code></td><td>Confirm button, rightmost. Accepts <code>text</code>, <code>id</code>, <code>icon</code>, <code>variant</code> (default <code>primary</code>; <code>danger</code> for a destructive confirm), <code>class</code>, <code>attrs</code>, <code>fullWidth</code>.</td></tr>
            <tr><td><code>left</code></td><td>array</td><td><code>null</code></td><td>Far-left secondary action. Accepts <code>text</code>, <code>id</code>, <code>icon</code>, <code>variant</code>, <code>class</code>, <code>attrs</code>.</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>null</code></td><td>ID on the footer element</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes on the footer</td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">info</span>
        <span>Cancel is always ghost &mdash; that is the consistency the component exists to enforce. <code>primary</code> accepts a <code>variant</code>, defaulting to <code>primary</code>; the only other value with a job is <code>danger</code>, for a confirm that destroys something. Before this option existed the Settings cancel-subscription modal hand-rolled its whole footer to get a red button, which is the failure this closes.</span>
    </div>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Semantics</td><td>A plain container of real <code>&lt;button&gt;</code> elements. No ARIA is added, and none is needed &mdash; the surrounding <code>role="dialog"</code> provides the context.</td></tr>
            <tr><td>Keyboard</td><td>Native. Tab order follows the DOM: left action, then cancel, then primary &mdash; which matches the visual left-to-right reading.</td></tr>
            <tr><td>Focus</td><td>Each button keeps its native focus ring. The modal's focus trap keeps <kbd>Tab</kbd> cycling within the dialog.</td></tr>
            <tr><td>Button labels</td><td>Name the action, not the answer: "Delete workshop" beats "OK". A screen-reader user reaching the footer out of context should still know what the button does.</td></tr>
            <tr><td>Destructive actions</td><td>Colour alone can't mark danger. Put the verb in the label, as in "Delete workshop" &mdash; the red is reinforcement.</td></tr>
            <tr><td>Cancel and Esc</td><td>Both should do the same thing. If your cancel button runs cleanup, make sure the modal's Esc handler runs it too &mdash; Esc bypasses the button entirely.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--border-default</code></td><td>Top border separating footer from body</td></tr>
            <tr><td><code>--space-2</code> / <code>--space-3</code></td><td>Gap between buttons and the footer's internal padding</td></tr>
        </tbody>
    </table>
    <p class="ds-section-desc">The footer is deliberately thin on tokens &mdash; it's a layout shell. All colour and type come from the buttons inside it.</p>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-modal-footer</code></td><td>Footer row with its top border</td></tr>
            <tr><td><code>.ws-modal-footer--single</code></td><td>Single full-width button layout</td></tr>
            <tr><td><code>.ws-modal-footer__left</code></td><td>Left action group</td></tr>
            <tr><td><code>.ws-modal-footer__right</code></td><td>Cancel and primary group</td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">info</span>
        <span><a href="<?= $ds_base ?>/components/demos/modal.php">Modal</a> also defines <code>.ws-modal__footer</code> with <code>--between</code> and <code>--start</code> modifiers &mdash; a separate, older set of footer styles. Prefer this component so the ordering stays consistent.</span>
    </div>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_modal_footer()</code> helper function</td></tr>
            <tr><td><code>includes/components/modal-footer.php</code></td><td>Template &mdash; slot layout and the button calls</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-modal-footer</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
