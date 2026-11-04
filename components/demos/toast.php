<?php
$ds_page  = 'components/demos/toast';
$ds_title = 'Toast';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Toast</h1>
    <p>Confirms that something happened, without interrupting what the user is doing.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            An action succeeded on the page the person is still on and they don't need to do anything about it &mdash; saved, copied, deleted. Toasts confirm; they don't ask. Call <code>wsToast()</code> from <code>components.js</code>: the older <code>window.Toast</code> in <code>js/toast.js</code> and the Planner's own <code>showToast()</code> are legacy, kept only where they already are.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The message needs a decision or must not be missed &mdash; use <a href="<?= $ds_base ?>/components/demos/alert.php">Alert</a> inline or a <a href="<?= $ds_base ?>/components/demos/modal.php">Modal</a>. A save that failed is never a toast alone, and a save that reloaded the page is confirmed with an Alert: a toast fired during page load is easily missed, and screen readers may not announce it. Toasts vanish on a timer, so anything the user must read doesn't belong in one. Don't stack more than three.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>
    <p class="ds-section-desc">Four severities, each with its own icon. Every one is created from JavaScript &mdash; there is no PHP call that renders a toast.</p>
    <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 12px;">
        <button class="ws-btn ws-btn--ghost ws-btn--sm" onclick="wsToastSuccess('Changes saved successfully.')">Success</button>
        <button class="ws-btn ws-btn--ghost ws-btn--sm" onclick="wsToastError('Something went wrong')">Error</button>
        <button class="ws-btn ws-btn--ghost ws-btn--sm" onclick="wsToastWarning('Please review before continuing')">Warning</button>
        <button class="ws-btn ws-btn--ghost ws-btn--sm" onclick="wsToastInfo('New updates available')">Info</button>
    </div>
    <div class="ds-code"><pre>wsToastSuccess('Changes saved.');
wsToastError('Something went wrong');
wsToastWarning('Please review');
wsToastInfo('New updates');</pre></div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With an action</h3>
        <p class="ds-section-desc">One action, typically Undo. Keep the window generous &mdash; the default four seconds is short for anyone navigating by keyboard.</p>
        <div class="ds-card">
            <button class="ws-btn ws-btn--ghost ws-btn--sm" onclick="wsToast('Item deleted', 'info', { duration: 10000, action: { label: 'Undo', onClick: function() { wsToastSuccess('Restored'); } } })">Show with Undo</button>
        </div>
        <div class="ds-code"><pre>wsToast('Item deleted', 'info', {
    duration: 10000,           // give people time to reach it
    action: { label: 'Undo', onClick: () =&gt; restoreItem(id) },
});</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Duration</h3>
        <p class="ds-section-desc">Four seconds by default. Longer for anything actionable, longer still for errors the user may want to read twice.</p>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 12px;">
            <button class="ws-btn ws-btn--ghost ws-btn--sm" onclick="wsToastInfo('Quick toast', { duration: 2000 })">2s</button>
            <button class="ws-btn ws-btn--ghost ws-btn--sm" onclick="wsToastInfo('Long toast', { duration: 8000 })">8s</button>
        </div>
        <div class="ds-code"><pre>wsToastInfo('Quick toast', { duration: 2000 });
wsToastInfo('Long toast',  { duration: 8000 });</pre></div>
    </div>

    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Appearing</td><td>The toast is created and appended to <code>#ws-toast-container</code>, which is fixed-position and always in the DOM.</td></tr>
            <tr><td>Visible</td><td>Persists for <code>duration</code> milliseconds &mdash; 4000 by default.</td></tr>
            <tr><td>Dismissing</td><td>Removed automatically on timeout, or immediately via the close button. There's no hover-to-pause, so a toast can expire while it's being read.</td></tr>
            <tr><td>Closable</td><td>On by default. Pass <code>closable: false</code> to omit the button &mdash; only sensible for very short, purely informational toasts.</td></tr>
            <tr><td>Stacking</td><td>Multiple toasts stack in the container. Nothing caps the number, so guard against loops that could fire dozens.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The save-and-confirm pattern used across the Planner: success on the happy path, error with a longer duration on failure, and no toast at all when the user can already see the result.</p>
    <div class="ds-card" style="display: flex; gap: 12px;">
        <button class="ws-btn ws-btn--primary ws-btn--sm" onclick="wsToastSuccess('Workshop saved')">Simulate save</button>
        <button class="ws-btn ws-btn--ghost ws-btn--sm" onclick="wsToastError('Could not save &mdash; check your connection', { duration: 8000 })">Simulate failure</button>
    </div>
    <div class="ds-code"><pre>async function savePlan(plan) {
    try {
        const res  = await fetch('/api/plans.php', { method: 'POST', body: JSON.stringify(plan) });
        const data = await res.json();
        if (!data.success) throw new Error(data.message);
        wsToastSuccess('Workshop saved');
    } catch (err) {
        // Errors get longer on screen than confirmations.
        wsToastError('Could not save — ' + err.message, { duration: 8000 });
    }
}</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>

    <h3 class="ds-subsection-title">PHP setup</h3>
    <p class="ds-section-desc">Render the container once per page, usually in the footer. Without it, every <code class="ds-code-inline">wsToast()</code> call silently does nothing.</p>
    <div class="ds-code"><pre>&lt;?= ws_toast_container() ?&gt;</pre></div>

    <h3 class="ds-subsection-title">JavaScript API</h3>
    <table class="ds-table">
        <thead><tr><th>Function</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>wsToast(message, variant, options)</code></td><td>Full control. The message and action label are plain text, set with <code>textContent</code>: pass them raw, never escaped or as markup</td></tr>
            <tr><td><code>wsToastSuccess(message, options)</code></td><td>Success shorthand</td></tr>
            <tr><td><code>wsToastError(message, options)</code></td><td>Error shorthand</td></tr>
            <tr><td><code>wsToastWarning(message, options)</code></td><td>Warning shorthand</td></tr>
            <tr><td><code>wsToastInfo(message, options)</code></td><td>Info shorthand</td></tr>
        </tbody>
    </table>

    <h3 class="ds-subsection-title">Options object</h3>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>message</code></td><td>string</td><td>&mdash;</td><td>First argument. One short sentence, no full stop needed.</td></tr>
            <tr><td><code>variant</code></td><td>string</td><td><code>'info'</code></td><td><code>success</code> | <code>error</code> | <code>warning</code> | <code>info</code></td></tr>
            <tr><td><code>duration</code></td><td>number</td><td><code>4000</code></td><td>Milliseconds before auto-dismiss. Falsy values fall back to the default, so <code>0</code> will not make a toast persist.</td></tr>
            <tr><td><code>closable</code></td><td>bool</td><td><code>true</code></td><td>Show the close button. Only an explicit <code>false</code> removes it.</td></tr>
            <tr><td><code>action.label</code></td><td>string</td><td><code>null</code></td><td>Action button text</td></tr>
            <tr><td><code>action.onClick</code></td><td>function</td><td><code>null</code></td><td>Action click handler</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Live region</td><td>The container is <code>aria-live="polite"</code>, so new toasts are announced once the screen reader finishes its current sentence &mdash; the right choice for confirmations, which shouldn't interrupt. Each toast carries its own <code>aria-atomic="true"</code>, so only the new one is read, not the whole stack.</td></tr>
            <tr><td>Keyboard</td><td>The close and action buttons are real buttons, reachable with <kbd>Tab</kbd>. Because the container is at the end of the document, reaching them may take many presses from where the user was.</td></tr>
            <tr><td>Colour independence</td><td>Variant colour and icon are the only difference between success and error. Put the outcome in the words &mdash; "Workshop saved", not "Done".</td></tr>
            <tr><td>Contrast</td><td>All variants render on the dark <code>--toast-bg</code> with <code>--toast-text</code>, a single tested pairing.</td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">warning</span>
        <span><strong>Two limitations worth knowing:</strong>
        <br>(1) <strong>Auto-dismiss conflicts with WCAG 2.2.1 (Timing Adjustable).</strong> Content disappears on a timer with no way to pause or extend it, and there's no hover-to-pause. Keep anything that matters out of a toast, and give actionable toasts a long duration.
        <br>(2) <strong>Error toasts are announced politely.</strong> A failure may be missed if the screen reader is mid-sentence. For errors that block the user's goal, put an <a href="<?= $ds_base ?>/components/demos/alert.php">Alert</a> on the page as well.</span>
    </div>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--toast-bg</code> / <code>--toast-text</code></td><td>Toast surface and message colour</td></tr>
            <tr><td><code>--toast-radius</code> / <code>--toast-shadow</code></td><td>Corners and elevation above the page</td></tr>
            <tr><td><code>--text-inverse</code></td><td>Text on the dark surface</td></tr>
            <tr><td><code>--brand-soft</code></td><td>Action button accent</td></tr>
            <tr><td><code>--gray-400</code></td><td>Close button, resting</td></tr>
            <tr><td><code>--radius-md</code></td><td>Action and close button corners</td></tr>
            <tr><td><code>--space-3</code></td><td>Internal spacing and the gap between stacked toasts</td></tr>
            <tr><td><code>--text-caption</code> / <code>--text-meta</code></td><td>Message and action type scale</td></tr>
            <tr><td><code>--font-body</code> / <code>--font-medium</code> / <code>--font-semibold</code></td><td>Face and weights</td></tr>
            <tr><td><code>--transition-fast</code></td><td>Button hover</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-toast-container</code></td><td>Fixed container, <code>id="ws-toast-container"</code> &mdash; the node the JS appends into</td></tr>
            <tr><td><code>.ws-toast</code></td><td>Individual toast</td></tr>
            <tr><td><code>.ws-toast--success / --error / --warning / --info</code></td><td>Variant colours</td></tr>
            <tr><td><code>.ws-toast__icon</code></td><td>Variant icon</td></tr>
            <tr><td><code>.ws-toast__message</code></td><td>Message text</td></tr>
            <tr><td><code>.ws-toast__action</code></td><td>Optional action button</td></tr>
            <tr><td><code>.ws-toast__close</code></td><td>Dismiss button</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_toast_container()</code> helper function</td></tr>
            <tr><td><code>includes/components/toast.php</code></td><td>The container element and its live-region attributes</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-toast</code> rules)</td></tr>
            <tr><td><code>includes/components/components.js</code></td><td><code>wsToast()</code> and the four shorthands</td></tr>
        </tbody>
    </table>
</section>

<!-- Toast container for the demos on this page -->
<?= ws_toast_container() ?>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
