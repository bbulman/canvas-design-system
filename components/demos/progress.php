<?php
$ds_page  = 'components/demos/progress';
$ds_title = 'Progress';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Progress</h1>
    <p>Shows how far along something is, as a proportion of a known whole.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            You can express the state as a percentage &mdash; an upload, a multi-step form, a completion score. Use the <code>indeterminate</code> mode when work is genuinely underway but unmeasurable.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            You're waiting for content whose shape you know &mdash; <a href="<?= $ds_base ?>/components/demos/skeleton.php">Skeleton</a> gives a better sense of what's coming. Don't use it as a decorative meter for a rating or a score with no notion of "complete".
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Colour</h3>
        <p class="ds-section-desc">Five variants. Colour carries meaning, so drive it from the state rather than the page's palette &mdash; <code class="ds-code-inline">success</code> at 100%, <code class="ds-code-inline">error</code> when something failed part-way.</p>
        <div class="ds-card" style="display: flex; flex-direction: column; gap: 16px;">
            <div>
                <div class="ds-progress-demo-label">Primary &mdash; 75%</div>
                <?= ws_progress(75, ['variant' => 'primary']) ?>
            </div>
            <div>
                <div class="ds-progress-demo-label">Success &mdash; 100%</div>
                <?= ws_progress(100, ['variant' => 'success']) ?>
            </div>
            <div>
                <div class="ds-progress-demo-label">Warning &mdash; 50%</div>
                <?= ws_progress(50, ['variant' => 'warning']) ?>
            </div>
            <div>
                <div class="ds-progress-demo-label">Error &mdash; 25%</div>
                <?= ws_progress(25, ['variant' => 'error']) ?>
            </div>
            <div>
                <div class="ds-progress-demo-label">Info &mdash; 60%</div>
                <?= ws_progress(60, ['variant' => 'info']) ?>
            </div>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_progress(75, ['variant' => 'primary']) ?&gt;
&lt;?= ws_progress(100, ['variant' => 'success']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Sizes</h3>
        <div class="ds-card" style="display: flex; flex-direction: column; gap: 16px;">
            <div>
                <div class="ds-progress-demo-label">Small</div>
                <?= ws_progress(60, ['size' => 'sm']) ?>
            </div>
            <div>
                <div class="ds-progress-demo-label">Medium (default)</div>
                <?= ws_progress(60, ['size' => 'md']) ?>
            </div>
            <div>
                <div class="ds-progress-demo-label">Large</div>
                <?= ws_progress(60, ['size' => 'lg']) ?>
            </div>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_progress(60, ['size' => 'sm']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With label and value</h3>
        <p class="ds-section-desc">The label doubles as the bar's accessible name, so set it whenever the surrounding text doesn't already explain what's progressing.</p>
        <div class="ds-card" style="display: flex; flex-direction: column; gap: 20px;">
            <?= ws_progress(65, ['variant' => 'primary', 'label' => 'Uploading file…', 'showValue' => true]) ?>
            <?= ws_progress(100, ['variant' => 'success', 'label' => 'Complete', 'showValue' => true]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_progress(65, [
    'variant'   => 'primary',
    'label'     => 'Uploading file…',
    'showValue' => true,
]) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Striped and animated</h3>
        <p class="ds-section-desc"><code class="ds-code-inline">animated</code> requires <code class="ds-code-inline">striped</code> &mdash; the animation moves the stripes, so on its own it does nothing visible.</p>
        <div class="ds-card" style="display: flex; flex-direction: column; gap: 16px;">
            <div>
                <div class="ds-progress-demo-label">Striped</div>
                <?= ws_progress(70, ['variant' => 'info', 'striped' => true]) ?>
            </div>
            <div>
                <div class="ds-progress-demo-label">Animated stripes</div>
                <?= ws_progress(70, ['variant' => 'primary', 'striped' => true, 'animated' => true]) ?>
            </div>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_progress(70, ['striped' => true, 'animated' => true]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Indeterminate</h3>
        <p class="ds-section-desc">For work with no measurable proportion. The bar loops continuously, the width style is dropped, and the percentage is suppressed even if <code class="ds-code-inline">showValue</code> is set.</p>
        <div class="ds-card">
            <?= ws_progress(0, ['indeterminate' => true, 'label' => 'Loading…']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_progress(0, ['indeterminate' => true, 'label' => 'Loading…']) ?&gt;</pre></div>
    </div>

    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Value out of range</td><td>Clamped with <code>max(0, min(100, $value))</code>, so a stray 150 or &minus;10 renders as 100 or 0 rather than overflowing the track.</td></tr>
            <tr><td>Zero</td><td>Renders an empty track. Visually identical to "not started", which is usually what you want.</td></tr>
            <tr><td>Complete</td><td>No automatic treatment at 100% &mdash; switch to <code>variant: 'success'</code> yourself if completion should read differently.</td></tr>
            <tr><td>Indeterminate</td><td>Adds <code>.ws-progress__bar--indeterminate</code> and omits the inline width. <code>aria-valuenow</code> is also omitted, so no false percentage is announced.</td></tr>
            <tr><td>Reduced motion</td><td>Honored. Under <code>prefers-reduced-motion: reduce</code> both loops stop; the indeterminate bar fills its track at reduced opacity so it still reads as in-progress.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">A workshop's setup completion on MyWorkshopr: value derived from real task state, label naming what's measured, and the variant flipping to success once everything's done.</p>
    <div class="ds-card" style="max-width: 460px;">
        <?= ws_progress(60, [
            'variant'   => 'primary',
            'label'     => 'Workshop setup',
            'showValue' => true,
        ]) ?>
    </div>
    <div class="ds-code"><pre>&lt;?php
$done  = count(array_filter($tasks, fn($t) => $t['done']));
$pct   = $tasks ? round($done / count($tasks) * 100) : 0;
?&gt;
&lt;?= ws_progress($pct, [
    'variant'   => $pct === 100 ? 'success' : 'primary',
    'label'     => 'Workshop setup',
    'showValue' => true,
]) ?&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>$value</code></td><td>int|float</td><td><code>0</code></td><td>Positional. 0&ndash;100, clamped to that range.</td></tr>
            <tr><td><code>variant</code></td><td>string</td><td><code>'primary'</code></td><td><code>primary</code> | <code>success</code> | <code>warning</code> | <code>error</code> | <code>info</code></td></tr>
            <tr><td><code>size</code></td><td>string</td><td><code>'md'</code></td><td><code>sm</code> | <code>md</code> | <code>lg</code> &mdash; track height</td></tr>
            <tr><td><code>label</code></td><td>string</td><td><code>null</code></td><td>Visible label, also used as the bar's <code>aria-label</code></td></tr>
            <tr><td><code>showValue</code></td><td>bool</td><td><code>false</code></td><td>Show the percentage. Suppressed when indeterminate.</td></tr>
            <tr><td><code>striped</code></td><td>bool</td><td><code>false</code></td><td>Diagonal stripe pattern</td></tr>
            <tr><td><code>animated</code></td><td>bool</td><td><code>false</code></td><td>Animates the stripes. Has no effect without <code>striped</code>.</td></tr>
            <tr><td><code>indeterminate</code></td><td>bool</td><td><code>false</code></td><td>Continuous loop for unmeasurable work</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>null</code></td><td>Element ID</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra HTML attributes as key/value pairs</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>ARIA</td><td>Emits <code>role="progressbar"</code> with <code>aria-valuemin="0"</code> and <code>aria-valuemax="100"</code>. <code>aria-valuenow</code> is added for determinate bars and correctly omitted when <code>indeterminate</code> is set.</td></tr>
            <tr><td>Labelling</td><td>When <code>label</code> is set it becomes <code>aria-label</code>. Without one the bar is announced as an unnamed progressbar, so pass a label unless neighbouring text clearly names it.</td></tr>
            <tr><td>Keyboard</td><td>Not focusable, which is correct &mdash; a progress bar reports state and accepts no input.</td></tr>
            <tr><td>Live updates</td><td>Updating <code>aria-valuenow</code> in the DOM is announced by most screen readers without a live region. Don't wrap the bar in <code>aria-live="assertive"</code> &mdash; that produces a stream of interruptions on every tick.</td></tr>
            <tr><td>Colour independence</td><td>Variant colour is the only signal distinguishing error from success at the same percentage. Put the state in the label too.</td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">check_circle</span>
        <span><strong>Fixed July 2026.</strong> Two gaps closed: <code>aria-valuenow</code> was emitted even when indeterminate, so assistive tech announced a bogus percentage for work of unknown length; and neither animation honoured <code>prefers-reduced-motion</code>, unlike <a href="<?= $ds_base ?>/components/demos/skeleton.php">Skeleton</a>. Both now behave correctly.</span>
    </div>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--gray-100</code></td><td>Track background</td></tr>
            <tr><td><code>--mainsite-gradient</code></td><td>Primary bar fill</td></tr>
            <tr><td><code>--color-success</code> / <code>--color-success-dark</code></td><td>Success bar</td></tr>
            <tr><td><code>--color-warning</code> / <code>--color-warning-dark</code></td><td>Warning bar</td></tr>
            <tr><td><code>--color-error</code> / <code>--color-error-dark</code></td><td>Error bar</td></tr>
            <tr><td><code>--color-info</code> / <code>--color-info-dark</code></td><td>Info bar</td></tr>
            <tr><td><code>--radius-full</code></td><td>Rounded track and bar ends</td></tr>
            <tr><td><code>--text-dark</code> / <code>--text-default</code></td><td>Label and value text</td></tr>
            <tr><td><code>--text-meta</code></td><td>Label and value type scale</td></tr>
            <tr><td><code>--font-body</code> / <code>--font-medium</code> / <code>--font-semibold</code></td><td>Face and weights</td></tr>
            <tr><td><code>--transition-base</code></td><td>Width transition as the value changes</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-progress-wrapper</code></td><td>Outer wrapper holding the label row and the track</td></tr>
            <tr><td><code>.ws-progress</code></td><td>The track &mdash; carries <code>role="progressbar"</code></td></tr>
            <tr><td><code>.ws-progress--sm / --md / --lg</code></td><td>Track height</td></tr>
            <tr><td><code>.ws-progress__label</code></td><td>Label text</td></tr>
            <tr><td><code>.ws-progress__value</code></td><td>Percentage readout</td></tr>
            <tr><td><code>.ws-progress__bar</code></td><td>The filled portion</td></tr>
            <tr><td><code>.ws-progress__bar--primary / --success / --warning / --error / --info</code></td><td>Bar colours</td></tr>
            <tr><td><code>.ws-progress__bar--striped</code></td><td>Stripe pattern</td></tr>
            <tr><td><code>.ws-progress__bar--animated</code></td><td>Moving stripes (needs <code>--striped</code>)</td></tr>
            <tr><td><code>.ws-progress__bar--indeterminate</code></td><td>Continuous loop</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_progress()</code> helper function</td></tr>
            <tr><td><code>includes/components/progress.php</code></td><td>Template &mdash; clamping, ARIA, and class assembly</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles and the stripe/indeterminate keyframes (<code>.ws-progress</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<style>
.ds-progress-demo-label {
    font-size: var(--text-caption, 12px);
    color: var(--text-muted, #78716C);
    margin-bottom: 6px;
}
</style>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
