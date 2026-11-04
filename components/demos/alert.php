<?php
$ds_page  = 'components/demos/alert';
$ds_title = 'Alert';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Alert</h1>
    <p>An inline message that interrupts the reading flow to report the outcome or state of something.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            You need to report a result, a risk, or a required next step in place &mdash; a save that failed, a save confirmed after the page reloaded, a validation summary, a session-expiry warning. Alert sits in the content flow, next to what it's about. A save the person stays on the page for is confirmed with a toast instead.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The message is transient and needs no acknowledgement &mdash; use <a href="<?= $ds_base ?>/components/demos/toast.php">Toast</a>. For a full-width page-top announcement use <a href="<?= $ds_base ?>/components/demos/banner.php">Banner</a>; for a single field's error, use the <code class="ds-code-inline">error</code> option on <a href="<?= $ds_base ?>/components/demos/input.php">Input</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Severity</h3>
        <p class="ds-section-desc">Four severities, each with an automatic icon. Pass <code class="ds-code-inline">icon</code> only when you need to override that default.</p>
        <div class="ds-card" style="display: flex; flex-direction: column; gap: 12px;">
            <?= ws_alert('This is an informational message.', ['variant' => 'info']) ?>
            <?= ws_alert('Your changes have been saved successfully.', ['variant' => 'success']) ?>
            <?= ws_alert('Please review the form before submitting.', ['variant' => 'warning']) ?>
            <?= ws_alert('An error occurred. Please try again.', ['variant' => 'error']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_alert('Your changes have been saved.', ['variant' => 'success']) ?&gt;
&lt;?= ws_alert('Please review the form', ['variant' => 'warning']) ?&gt;
&lt;?= ws_alert('An error occurred', ['variant' => 'error']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With a title</h3>
        <p class="ds-section-desc">Add a title when the message needs more than one sentence. Keep the title to a noun phrase and let the body carry the instruction.</p>
        <div class="ds-card" style="display: flex; flex-direction: column; gap: 12px;">
            <?= ws_alert('Your session will expire in 5 minutes. Save your work to avoid losing changes.', [
                'variant' => 'warning',
                'title' => 'Session Expiring'
            ]) ?>
            <?= ws_alert('Check your email for a confirmation link to complete registration.', [
                'variant' => 'info',
                'title' => 'Verification Required'
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_alert('Message here', [
    'variant' => 'warning',
    'title'   => 'Session Expiring',
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Filled</h3>
        <p class="ds-section-desc">Solid background instead of a tint. Reserve it for the one alert on a page that must win attention &mdash; several filled alerts together cancel each other out.</p>
        <div class="ds-card" style="display: flex; flex-direction: column; gap: 12px;">
            <?= ws_alert('Information with filled background.', ['variant' => 'info', 'filled' => true]) ?>
            <?= ws_alert('Success with filled background.', ['variant' => 'success', 'filled' => true]) ?>
            <?= ws_alert('Warning with filled background.', ['variant' => 'warning', 'filled' => true]) ?>
            <?= ws_alert('Error with filled background.', ['variant' => 'error', 'filled' => true]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_alert('Message', ['variant' => 'success', 'filled' => true]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Without the border accent</h3>
        <p class="ds-section-desc">The left border is on by default. Drop it when the alert sits inside an already-bordered container and the double edge reads as noise.</p>
        <div class="ds-card">
            <?= ws_alert('Alert without left border accent.', ['variant' => 'info', 'bordered' => false]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_alert('Message', ['bordered' => false]) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Dismissible</h3>
        <p class="ds-section-desc">Adds a close button that removes the alert from the DOM. Use it for messages the reader can finish with &mdash; never for an error they still need to act on.</p>
        <div class="ds-card" style="display: flex; flex-direction: column; gap: 12px;">
            <?= ws_alert('You can dismiss this alert with the close button.', [
                'variant' => 'info',
                'dismissible' => true
            ]) ?>
            <?= ws_alert('This warning can be dismissed once acknowledged.', [
                'variant' => 'warning',
                'title' => 'Heads Up',
                'dismissible' => true
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_alert('Message', ['dismissible' => true]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With actions</h3>
        <p class="ds-section-desc">Actions render as links when given <code class="ds-code-inline">href</code>, and as buttons otherwise. Keep to two &mdash; a third is a sign the alert should be a modal.</p>
        <div class="ds-card">
            <?= ws_alert('A new version is available. Update now to get the latest features.', [
                'variant' => 'info',
                'title' => 'Update Available',
                'actions' => [
                    ['text' => 'Update Now', 'href' => '#'],
                    ['text' => 'Learn More', 'href' => '#']
                ]
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_alert('Message', [
    'variant' => 'info',
    'actions' => [
        ['text' => 'Action',  'href'    => '/url'],
        ['text' => 'Another', 'onclick' => 'doSomething()'],
    ],
]) ?&gt;</pre></div>
    </div>

    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>Tinted background, severity-coloured left border, auto icon.</td></tr>
            <tr><td>Dismissed</td><td>The close button runs <code>this.parentElement.remove()</code>, deleting the whole alert. There is no animation and no event &mdash; if you need to know it was dismissed, add your own handler via <code>attrs</code>.</td></tr>
            <tr><td>Hover (actions)</td><td>Action links and buttons carry a <code>--transition-fast</code> colour shift; the alert body itself has no hover state.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">A form-level validation summary &mdash; error severity, a title naming the problem, the body listing what to fix, and no dismiss button because the reader still has work to do.</p>
    <div class="ds-card">
        <?= ws_alert('Add at least one activity to the agenda, and give the workshop a title before saving.', [
            'variant' => 'error',
            'title'   => 'This workshop can\'t be saved yet',
        ]) ?>
    </div>
    <div class="ds-code"><pre>&lt;?php if ($errors): ?&gt;
    &lt;?= ws_alert(implode(' ', $errors), [
        'variant' => 'error',
        'title'   => "This workshop can't be saved yet",
    ]) ?&gt;
&lt;?php endif; ?&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <p class="ds-section-desc">The message is the first positional argument; everything else goes in the options array.</p>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>$message</code></td><td>string</td><td><code>''</code></td><td>Body text. Positional. <strong>Rendered as raw HTML</strong> &mdash; see the security note below.</td></tr>
            <tr><td><code>variant</code></td><td>string</td><td><code>'info'</code></td><td><code>info</code> | <code>success</code> | <code>warning</code> | <code>error</code></td></tr>
            <tr><td><code>title</code></td><td>string</td><td><code>null</code></td><td>Optional heading above the message. Escaped.</td></tr>
            <tr><td><code>icon</code></td><td>string</td><td>by variant</td><td>Overrides the automatic icon: <code>check_circle</code> (success), <code>warning</code>, <code>error</code>, <code>info</code>.</td></tr>
            <tr><td><code>dismissible</code></td><td>bool</td><td><code>false</code></td><td>Adds the close button and the <code>.ws-alert--dismissible</code> class.</td></tr>
            <tr><td><code>bordered</code></td><td>bool</td><td><code>true</code></td><td>Left border accent. On by default &mdash; pass <code>false</code> to remove.</td></tr>
            <tr><td><code>filled</code></td><td>bool</td><td><code>false</code></td><td>Solid background instead of a tint.</td></tr>
            <tr><td><code>actions</code></td><td>array</td><td><code>[]</code></td><td><code>[['text' => …, 'href' => …]]</code> renders links; omit <code>href</code> and pass <code>onclick</code> for buttons.</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>null</code></td><td>Element ID</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra HTML attributes as key/value pairs</td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">warning</span>
        <span><strong>Security:</strong> <code>$message</code> is echoed unescaped so it can carry inline markup, while <code>title</code> and action text are escaped. Never pass unsanitised user input as the message &mdash; escape it at the call site with <code>htmlspecialchars()</code>.</span>
    </div>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>ARIA</td><td>The container always carries <code>role="alert"</code> &mdash; an assertive live region. Content injected after page load is announced immediately, interrupting whatever the screen reader was saying.</td></tr>
            <tr><td>Keyboard</td><td>The alert itself isn't focusable. The close button and any action buttons/links are standard focusable controls reachable with <kbd>Tab</kbd> and activated with <kbd>Enter</kbd> or <kbd>Space</kbd>.</td></tr>
            <tr><td>Focus</td><td>Dismissing removes the alert while focus is still on its close button, dropping focus to <code>&lt;body&gt;</code>. Move focus somewhere sensible yourself if the alert was part of a keyboard flow.</td></tr>
            <tr><td>Labelling</td><td>The close button is labelled <code>aria-label="Dismiss"</code>. The severity is conveyed by colour and icon only &mdash; put the severity in the words too, so it survives without either.</td></tr>
            <tr><td>Contrast</td><td>Tinted variants pair a <code>--color-*-light</code> background with a <code>--color-*-dark</code> foreground; filled variants use <code>--text-inverse</code>. Don't override one side alone.</td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">warning</span>
        <span><strong>Known gap:</strong> <code>role="alert"</code> is applied unconditionally, including to informational alerts rendered with the page. For non-urgent messages a polite region would be the better fit; today you'd override it with <code>attrs =&gt; ['role' =&gt; 'status']</code>, which appends a second <code>role</code> attribute rather than replacing it &mdash; so the assertive one still wins.</span>
    </div>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--color-info-light</code> / <code>--color-info-strong</code> / <code>--color-info-dark</code></td><td>Info tint, text, and filled background</td></tr>
            <tr><td><code>--color-success-light</code> / <code>--color-success-ink</code> / <code>--color-success-darker</code></td><td>Success tint, text, and filled background</td></tr>
            <tr><td><code>--color-warning-very-light</code> / <code>--color-warning-ink</code> / <code>--color-warning-ink-dark</code> / <code>--color-warning-darker</code></td><td>Warning tint, text, and border accent</td></tr>
            <tr><td><code>--color-error-light</code> / <code>--color-error-ink</code> / <code>--color-error-dark</code></td><td>Error tint, text, and filled background</td></tr>
            <tr><td><code>--text-inverse</code></td><td>Foreground on filled variants</td></tr>
            <tr><td><code>--radius-md</code> / <code>--radius-xl</code></td><td>Container and action-button corners</td></tr>
            <tr><td><code>--icon-lg</code></td><td>The icon, 24px on every page</td></tr>
            <tr><td><code>--text-small</code> / <code>--text-meta</code></td><td>Title and message type scale</td></tr>
            <tr><td><code>--font-body</code> / <code>--font-semibold</code></td><td>Body face and title weight</td></tr>
            <tr><td><code>--transition-fast</code></td><td>Action and close-button hover</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-alert</code></td><td>Base container</td></tr>
            <tr><td><code>.ws-alert--info / --success / --warning / --error</code></td><td>Severity modifiers</td></tr>
            <tr><td><code>.ws-alert--bordered</code></td><td>Left border accent (applied by default)</td></tr>
            <tr><td><code>.ws-alert--filled</code></td><td>Solid background</td></tr>
            <tr><td><code>.ws-alert--dismissible</code></td><td>Reserves space for the close button</td></tr>
            <tr><td><code>.ws-alert__icon</code></td><td>Leading severity icon</td></tr>
            <tr><td><code>.ws-alert__content</code></td><td>Title + message + actions column</td></tr>
            <tr><td><code>.ws-alert__title</code></td><td>Optional heading</td></tr>
            <tr><td><code>.ws-alert__message</code></td><td>Body text</td></tr>
            <tr><td><code>.ws-alert__actions</code></td><td>Action row</td></tr>
            <tr><td><code>.ws-alert__action</code></td><td>Individual action link or button</td></tr>
            <tr><td><code>.ws-alert__close</code></td><td>Dismiss button</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_alert()</code> helper function</td></tr>
            <tr><td><code>includes/components/alert.php</code></td><td>Template &mdash; variant icon mapping and markup</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-alert</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
