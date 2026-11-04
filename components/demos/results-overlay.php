<?php
$ds_page  = 'components/demos/results-overlay';
$ds_title = 'Results Overlay';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Results Overlay</h1>
    <p>Reports what a batch operation actually did, as an itemised list the user can read before moving on.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            An operation changed several things at once and the user needs the itemised account &mdash; agenda cleanup, bulk import, a batch edit. The list is the point: "3 durations rounded, 1 break added".
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            One thing happened and one line covers it &mdash; use <a href="<?= $ds_base ?>/components/demos/toast.php">Toast</a>. For a failure the user must resolve, use <a href="<?= $ds_base ?>/components/demos/alert.php">Alert</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Overlay</h3>
        <p class="ds-section-desc">Covers its positioned parent &mdash; typically a modal body once the operation finishes. It needs a <code class="ds-code-inline">position: relative</code> ancestor or it will cover the wrong thing.</p>
        <div class="ds-card" style="position: relative; min-height: 250px;">
            <p style="color: var(--text-muted, #78716C);">This content sits behind the overlay.</p>
            <?= ws_results_overlay([
                'id' => 'demoOverlay',
                'variant' => 'overlay',
                'title' => 'Cleanup complete',
                'icon' => 'check_circle',
                'buttonText' => 'Done',
                'buttonId' => 'demoOverlayDone',
            ]) ?>
        </div>
        <div style="margin-top: 8px; display: flex; gap: 8px;">
            <?= ws_button('Show overlay', ['variant' => 'secondary', 'size' => 'sm', 'attrs' => ['onclick' => "const o=document.getElementById('demoOverlay'); o.classList.add('visible'); o.style.display='flex';"]]) ?>
            <?= ws_button('Hide', ['variant' => 'ghost', 'size' => 'sm', 'attrs' => ['onclick' => "const o=document.getElementById('demoOverlay'); o.classList.remove('visible'); o.style.display='none';"]]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_results_overlay([
    'id'         => 'cleanupResults',
    'variant'    => 'overlay',
    'title'      => 'Cleanup complete',
    'icon'       => 'check_circle',
    'buttonText' => 'Done',
    'buttonId'   => 'cleanupDoneBtn',
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Inline</h3>
        <p class="ds-section-desc">Sits in the flow below the content it reports on, with no button and no overlay positioning. Use it when the user stays on the page afterwards.</p>
        <div class="ds-card">
            <div class="ws-results ws-results--inline" style="display: block;">
                <div class="ws-results__header">
                    <span class="ws-results__icon"><?= icon('check_circle') ?></span>
                    <span class="ws-results__title">Cleanup complete</span>
                </div>
                <ul class="ws-results__list">
                    <li>Rounded 3 activity durations</li>
                    <li>Added 1 break after 90 minutes</li>
                    <li>Fixed 2 title formatting issues</li>
                </ul>
            </div>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_results_overlay([
    'id'      => 'inlineResults',
    'variant' => 'inline',
    'title'   => 'Cleanup complete',
]) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Hidden</td><td>The initial state. The markup renders on page load but stays hidden until you reveal it.</td></tr>
            <tr><td>Visible</td><td>You add <code>.visible</code> and set the display. <strong>The component ships no JS</strong> &mdash; there is no <code>wsResultsShow()</code>; revealing and hiding are yours.</td></tr>
            <tr><td>Populated</td><td>The list renders empty. Fill <code>#{id}-list</code> with <code>&lt;li&gt;</code> items from your operation's real result &mdash; the component has no knowledge of what happened.</td></tr>
            <tr><td>Empty result</td><td>An operation that changed nothing produces an empty list under a "complete" heading, which reads as a bug. Branch on the result count and show a different message.</td></tr>
            <tr><td>Button</td><td>Overlay variant only. Rendered with your <code>buttonId</code> so you can bind to it &mdash; nothing is bound for you.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The Planner's agenda cleanup modal. The overlay is placed inside the modal body, populated from the API response, and revealed when the operation finishes &mdash; with the announcement and focus handling the component doesn't provide.</p>
    <div class="ds-code"><pre>&lt;?php ws_modal_start(['id' => 'cleanup', 'title' => 'Clean up agenda']); ?&gt;
    &lt;div style="position: relative;"&gt;
        &lt;?= ws_checkbox_card_group($operations, ['label' => 'What should we clean up?']) ?&gt;
        &lt;?= ws_results_overlay([
            'id'         => 'cleanupResults',
            'title'      => 'Cleanup complete',
            'buttonText' => 'Done',
            'buttonId'   => 'cleanupDone',
        ]) ?&gt;
    &lt;/div&gt;
&lt;?php ws_modal_end(); ?&gt;

&lt;script&gt;
async function runCleanup(planId, ops) {
    const res     = await fetch('/api/plan-items.php?action=cleanup', { /* … */ });
    const data    = await res.json();
    const overlay = document.getElementById('cleanupResults');
    const list    = document.getElementById('cleanupResults-list');

    if (!data.changes.length) {          // nothing changed — don't claim success
        wsToastInfo('Nothing needed cleaning up');
        return;
    }

    list.innerHTML = data.changes.map(c =&gt; `&lt;li&gt;${escapeHtml(c)}&lt;/li&gt;`).join('');
    overlay.classList.add('visible');
    overlay.style.display = 'flex';

    // The component announces nothing and moves no focus — do both.
    overlay.setAttribute('role', 'status');
    document.getElementById('cleanupDone').focus();
}

document.getElementById('cleanupDone').addEventListener('click', () =&gt; {
    wsModalClose('cleanup');
    location.reload();
});
&lt;/script&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>id</code></td><td>string</td><td><code>''</code></td><td>Required in practice &mdash; every other ID derives from it, and it's how you reveal the panel.</td></tr>
            <tr><td><code>variant</code></td><td>string</td><td><code>'overlay'</code></td><td><code>overlay</code> | <code>inline</code></td></tr>
            <tr><td><code>title</code></td><td>string</td><td><code>'Complete'</code></td><td>Heading. Name the operation: "Cleanup complete".</td></tr>
            <tr><td><code>icon</code></td><td>string</td><td><code>'check_circle'</code></td><td>Material icon beside the title</td></tr>
            <tr><td><code>buttonText</code></td><td>string</td><td><code>'Done'</code></td><td>Action button label. Overlay variant only.</td></tr>
            <tr><td><code>buttonId</code></td><td>string</td><td><code>'{id}-done'</code></td><td>Button ID for binding. Overlay variant only.</td></tr>
            <tr><td><code>listId</code></td><td>string</td><td><code>'{id}-list'</code></td><td>The <code>&lt;ul&gt;</code> you populate</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Structure</td><td>Results are a real <code>&lt;ul&gt;</code>, so once populated the count and items are announced properly.</td></tr>
            <tr><td>Keyboard</td><td>The overlay's action button is a real button. The inline variant has nothing focusable.</td></tr>
            <tr><td>Announcement</td><td><strong>Missing.</strong> No <code>role="status"</code> or <code>aria-live</code> is applied, so revealing the overlay is silent to screen-reader users &mdash; the operation appears to have done nothing. Set <code>role="status"</code> on the container when you reveal it, as in the example above.</td></tr>
            <tr><td>Focus</td><td><strong>Missing.</strong> Focus isn't moved when the overlay appears, so a keyboard user stays wherever they were &mdash; behind a panel they can't see. Move focus to the Done button on reveal.</td></tr>
            <tr><td>Covering content</td><td>The overlay hides its parent visually but doesn't hide it from assistive tech &mdash; no <code>aria-hidden</code> or <code>inert</code> is applied underneath. A screen reader can still reach the covered controls.</td></tr>
            <tr><td>Icon</td><td>Decorative. The title carries the outcome, so don't rely on the tick to convey success.</td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">warning</span>
        <span>This component provides markup only. Announcement, focus management, and inerting the content behind it are all the consumer's responsibility &mdash; and all three are easy to forget, which is why they're spelled out in the example.</span>
    </div>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <p class="ds-section-desc">The panel draws on the shared surface, success, radius, and type scales rather than defining its own token set &mdash; deliberately, so a results panel matches whatever surface it covers. See <a href="<?= $ds_base ?>/resources/tokens.php">Token Reference</a> for current values and the <code class="ds-code-inline">.ws-results</code> rules in <code class="ds-code-inline">components.css</code> for the exact declarations.</p>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-results</code></td><td>Base panel, hidden until revealed</td></tr>
            <tr><td><code>.ws-results--inline</code></td><td>Inline variant &mdash; no overlay positioning</td></tr>
            <tr><td><code>.ws-results.visible</code></td><td>Revealed state. Added by your code, not the component.</td></tr>
            <tr><td><code>.ws-results__header</code></td><td>Icon and title row</td></tr>
            <tr><td><code>.ws-results__icon</code></td><td>Outcome icon</td></tr>
            <tr><td><code>.ws-results__title</code></td><td>Heading text</td></tr>
            <tr><td><code>.ws-results__list</code></td><td>The <code>&lt;ul&gt;</code> you populate, <code>id="{id}-list"</code></td></tr>
        </tbody>
    </table>
    <p class="ds-section-desc">The class prefix is <code class="ds-code-inline">.ws-results</code>, not <code class="ds-code-inline">.ws-results-overlay</code> &mdash; helper and class names differ here, as with the planner rails.</p>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_results_overlay()</code> helper function</td></tr>
            <tr><td><code>includes/components/results-overlay.php</code></td><td>Template &mdash; header, empty list, and optional button</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-results</code> rules)</td></tr>
        </tbody>
    </table>
    <p class="ds-section-desc">No JS file &mdash; reveal, populate, announce, and focus are all consumer-side.</p>
</section>

<script>
// Populate the demo overlay's list so the panel has something to show.
const demoList = document.getElementById('demoOverlay-list');
if (demoList) {
    demoList.innerHTML = '<li>Rounded 3 activity durations</li>'
                       + '<li>Added 1 break after 90 minutes</li>'
                       + '<li>Fixed 2 title formatting issues</li>';
}
</script>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
