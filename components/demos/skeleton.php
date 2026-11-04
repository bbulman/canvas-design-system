<?php
$ds_page  = 'components/demos/skeleton';
$ds_title = 'Skeleton';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Skeleton</h1>
    <p>Holds the shape of content that hasn't arrived yet, so the layout doesn't jump when it does.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            You know the shape of what's loading and the wait is likely to be noticeable &mdash; a plan list, a card grid, a profile block. Match the real content's dimensions so nothing shifts on arrival.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The wait is under ~300ms (the flash is worse than the pause), the shape is unknown, or the region is empty rather than loading &mdash; use <a href="<?= $ds_base ?>/components/demos/empty-state.php">Empty State</a>. For determinate work with a known percentage, use <a href="<?= $ds_base ?>/components/demos/progress.php">Progress</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>
    <p class="ds-section-desc">Seven variants. <code class="ds-code-inline">text</code>, <code class="ds-code-inline">avatar</code>, <code class="ds-code-inline">button</code>, <code class="ds-code-inline">input</code>, and <code class="ds-code-inline">image</code> are single primitives; <code class="ds-code-inline">card</code> and <code class="ds-code-inline">workshop</code> are pre-composed multi-part placeholders.</p>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Text</h3>
        <div class="ds-card" style="max-width: 400px;">
            <?= ws_skeleton(['variant' => 'text']) ?>
            <div style="height: 8px;"></div>
            <?= ws_skeleton(['variant' => 'text', 'lines' => 3]) ?>
        </div>
        <p class="ds-section-desc">Passing <code class="ds-code-inline">lines</code> greater than 1 wraps the run in <code class="ds-code-inline">.ws-skeleton-text</code> and shortens the last line, mimicking a ragged paragraph edge.</p>
        <div class="ds-code"><pre>&lt;?= ws_skeleton(['variant' => 'text']) ?&gt;
&lt;?= ws_skeleton(['variant' => 'text', 'lines' => 3]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Avatar</h3>
        <div class="ds-card" style="display: flex; gap: 16px; align-items: center;">
            <?= ws_skeleton(['variant' => 'avatar', 'size' => 'sm']) ?>
            <?= ws_skeleton(['variant' => 'avatar', 'size' => 'md']) ?>
            <?= ws_skeleton(['variant' => 'avatar', 'size' => 'lg']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_skeleton(['variant' => 'avatar', 'size' => 'lg']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Button</h3>
        <div class="ds-card" style="display: flex; gap: 16px; align-items: center;">
            <?= ws_skeleton(['variant' => 'button', 'size' => 'sm']) ?>
            <?= ws_skeleton(['variant' => 'button', 'size' => 'md']) ?>
            <?= ws_skeleton(['variant' => 'button', 'size' => 'lg']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_skeleton(['variant' => 'button', 'size' => 'md']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Input</h3>
        <div class="ds-card" style="max-width: 400px; display: flex; flex-direction: column; gap: 12px;">
            <?= ws_skeleton(['variant' => 'input', 'size' => 'sm']) ?>
            <?= ws_skeleton(['variant' => 'input', 'size' => 'md']) ?>
            <?= ws_skeleton(['variant' => 'input', 'size' => 'lg']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_skeleton(['variant' => 'input', 'size' => 'md']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Image</h3>
        <div class="ds-card" style="max-width: 300px;">
            <?= ws_skeleton(['variant' => 'image']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_skeleton(['variant' => 'image']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Card (composite)</h3>
        <div class="ds-grid-3">
            <?= ws_skeleton(['variant' => 'card']) ?>
            <?= ws_skeleton(['variant' => 'card']) ?>
            <?= ws_skeleton(['variant' => 'card']) ?>
        </div>
        <p class="ds-section-desc">Emits image + title + two body lines in one call. <code class="ds-code-inline">lines</code>, <code class="ds-code-inline">width</code>, and <code class="ds-code-inline">height</code> are ignored &mdash; the composite owns its own proportions.</p>
        <div class="ds-code"><pre>&lt;?= ws_skeleton(['variant' => 'card']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Custom dimensions</h3>
        <div class="ds-card" style="display: flex; gap: 16px; align-items: flex-end;">
            <?= ws_skeleton(['width' => '100px', 'height' => '100px', 'rounded' => true]) ?>
            <?= ws_skeleton(['width' => '150px', 'height' => '40px']) ?>
            <?= ws_skeleton(['width' => '60px', 'height' => '60px', 'circle' => true]) ?>
        </div>
        <p class="ds-section-desc">Reach for this only when no variant fits. <code class="ds-code-inline">width</code> and <code class="ds-code-inline">height</code> are emitted as inline styles, so they bypass the token scale &mdash; prefer a named variant where one exists.</p>
        <div class="ds-code"><pre>&lt;?= ws_skeleton(['width' => '100px', 'height' => '100px', 'rounded' => true]) ?&gt;
&lt;?= ws_skeleton(['width' => '60px', 'height' => '60px', 'circle' => true]) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <p class="ds-section-desc">Skeleton has one visual state &mdash; shimmering &mdash; and one environmental override.</p>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>A 1.5s <code>ws-skeleton-shimmer</code> loop sweeps a lighter band across the fill, left to right, forever.</td></tr>
            <tr><td>Reduced motion</td><td>Under <code>prefers-reduced-motion: reduce</code> the animation is dropped entirely and the fill becomes flat <code>--gray-100</code>. Handled in CSS &mdash; you don't branch for it.</td></tr>
            <tr><td>Removal</td><td>There is no exit transition. The caller swaps the skeleton for real content; keep the replacement's dimensions identical or the swap will visibly jump.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Workshop card &mdash; the three app homes</h3>
        <p class="ds-section-desc">The placeholder Planner, Facilitator, and Synthesize show while the plan list loads. It mirrors the saved-workshop card exactly &mdash; name, meta row, lifecycle strip, footer action &mdash; so nothing shifts when the real cards arrive. <code class="ds-code-inline">count</code> emits sibling cards that drop straight into the app's own grid; <code class="ds-code-inline">grid</code> adds the component's own responsive wrapper for pages that don't have one.</p>
        <?= ws_skeleton(['variant' => 'workshop', 'count' => 3, 'grid' => true]) ?>
        <div class="ds-code"><pre>&lt;?php // inside an app's own grid:
echo ws_skeleton(['variant' => 'workshop', 'count' => 3]);

// standalone, with the component's grid:
echo ws_skeleton(['variant' => 'workshop', 'count' => 3, 'grid' => true, 'id' => 'fachLoading']); ?&gt;</pre></div>
        <div class="ds-note">
            <span class="material-symbols-outlined">info</span>
            <span>When <code>grid</code> is set, <code>id</code> and <code>attrs</code> move to the wrapper &mdash; that's the node your page toggles. Without it they land on the first card.</span>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Composed user card</h3>
        <p class="ds-section-desc">Primitives compose. Build the placeholder from the same box model as the real component rather than reaching for a custom width and height.</p>
        <div class="ds-card" style="max-width: 300px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                <?= ws_skeleton(['variant' => 'avatar', 'size' => 'md']) ?>
                <div style="flex: 1;">
                    <?= ws_skeleton(['variant' => 'text', 'width' => '80%']) ?>
                    <div style="height: 6px;"></div>
                    <?= ws_skeleton(['variant' => 'text', 'width' => '50%']) ?>
                </div>
            </div>
            <?= ws_skeleton(['variant' => 'text', 'lines' => 2]) ?>
            <div style="height: 12px;"></div>
            <?= ws_skeleton(['variant' => 'button', 'size' => 'md']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_skeleton(['variant' => 'avatar', 'size' => 'md']) ?&gt;
&lt;?= ws_skeleton(['variant' => 'text', 'width' => '80%']) ?&gt;
&lt;?= ws_skeleton(['variant' => 'text', 'lines' => 2]) ?&gt;
&lt;?= ws_skeleton(['variant' => 'button', 'size' => 'md']) ?&gt;</pre></div>
    </div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <p class="ds-section-desc">Every option is passed in a single array &mdash; <code class="ds-code-inline">ws_skeleton()</code> takes no positional arguments.</p>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>variant</code></td><td>string</td><td><code>'text'</code></td><td><code>text</code> | <code>avatar</code> | <code>image</code> | <code>card</code> | <code>workshop</code> | <code>button</code> | <code>input</code>. For a round placeholder use the <code>circle</code> option below, not a variant.</td></tr>
            <tr><td><code>size</code></td><td>string</td><td><code>'md'</code></td><td><code>sm</code> | <code>md</code> | <code>lg</code>. Applies to <code>avatar</code>, <code>button</code>, and <code>input</code>; <code>md</code> emits no modifier class.</td></tr>
            <tr><td><code>lines</code></td><td>int</td><td><code>1</code></td><td><code>text</code> only. Above 1, wraps in <code>.ws-skeleton-text</code> and shortens the final line.</td></tr>
            <tr><td><code>count</code></td><td>int</td><td><code>1</code></td><td><code>workshop</code> only. Number of sibling cards. Floored at 1.</td></tr>
            <tr><td><code>grid</code></td><td>bool</td><td><code>false</code></td><td><code>workshop</code> only. Wraps the cards in <code>.ws-skeleton-grid</code> and moves <code>id</code>/<code>attrs</code> to that wrapper.</td></tr>
            <tr><td><code>width</code></td><td>string</td><td><code>null</code></td><td>Inline width override, e.g. <code>'80%'</code>, <code>'200px'</code>. Ignored by <code>card</code> and <code>workshop</code>.</td></tr>
            <tr><td><code>height</code></td><td>string</td><td><code>null</code></td><td>Inline height override. Same exclusions as <code>width</code>.</td></tr>
            <tr><td><code>rounded</code></td><td>bool</td><td><code>null</code></td><td>Forces <code>.ws-skeleton--rounded</code>. Only <code>true</code> adds the class; the per-variant default applies otherwise.</td></tr>
            <tr><td><code>circle</code></td><td>bool</td><td><code>false</code></td><td>Forces a circular shape via <code>.ws-skeleton--circle</code>.</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>null</code></td><td>Element ID &mdash; usually the handle your JS uses to hide the placeholder.</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes.</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra HTML attributes as key/value pairs.</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>ARIA</td><td>Every node the component emits carries <code>aria-hidden="true"</code>, including each sibling in a <code>count</code> run. Assistive tech skips the placeholder entirely rather than announcing meaningless boxes.</td></tr>
            <tr><td>Keyboard</td><td>None &mdash; skeletons are non-interactive and never focusable. Nothing enters the tab order.</td></tr>
            <tr><td>Focus</td><td>If you replace a focused element with a skeleton, focus is lost to <code>&lt;body&gt;</code>. Restore it to the replacement content once loaded.</td></tr>
            <tr><td>Reduced motion</td><td>Honored in CSS. <code>prefers-reduced-motion: reduce</code> removes the shimmer and renders a flat <code>--gray-100</code> fill.</td></tr>
            <tr><td>Announcing the wait</td><td>Not handled here &mdash; because the markup is <code>aria-hidden</code>, screen-reader users get no signal from it. Pair a live region (<code>aria-live="polite"</code>) with the loading state when the wait is long enough to matter.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--gray-100</code></td><td>Shimmer base and the flat reduced-motion fill</td></tr>
            <tr><td><code>--gray-200</code></td><td>Shimmer highlight band (the 50% gradient stop)</td></tr>
            <tr><td><code>--bg-surface</code></td><td>Composite card background (<code>card</code>, <code>workshop</code>)</td></tr>
            <tr><td><code>--radius-sm</code> / <code>--radius-md</code> / <code>--radius-lg</code> / <code>--radius-xl</code></td><td>Corner radii per variant</td></tr>
            <tr><td><code>--radius-full</code></td><td>Circular shapes (<code>avatar</code>, <code>circle</code>)</td></tr>
            <tr><td><code>--space-2</code> / <code>--space-3</code> / <code>--space-4</code></td><td>Internal gaps in the composite variants</td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">info</span>
        <span>Skeleton is deliberately colorless &mdash; it consumes no phase or brand token, so it reads the same in every app.</span>
    </div>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-skeleton</code></td><td>Base shimmer fill &mdash; on every primitive and every part of a composite</td></tr>
            <tr><td><code>.ws-skeleton--text</code></td><td>Text-line proportions</td></tr>
            <tr><td><code>.ws-skeleton--text-title</code></td><td>Taller, wider first line inside composites</td></tr>
            <tr><td><code>.ws-skeleton--text-short</code></td><td>Shortened final line in a multi-line run</td></tr>
            <tr><td><code>.ws-skeleton--avatar</code></td><td>Avatar variant</td></tr>
            <tr><td><code>.ws-skeleton--button</code></td><td>Button variant</td></tr>
            <tr><td><code>.ws-skeleton--input</code></td><td>Input variant</td></tr>
            <tr><td><code>.ws-skeleton--image</code></td><td>Image variant</td></tr>
            <tr><td><code>.ws-skeleton--sm / --md / --lg</code></td><td>Size modifiers (<code>md</code> is implicit and emits nothing)</td></tr>
            <tr><td><code>.ws-skeleton--circle</code></td><td>Circular shape override</td></tr>
            <tr><td><code>.ws-skeleton--rounded</code></td><td>Rounded-corner override</td></tr>
            <tr><td><code>.ws-skeleton-text</code></td><td>Wrapper for a multi-line text run</td></tr>
            <tr><td><code>.ws-skeleton-card</code> / <code>.ws-skeleton-card__body</code></td><td>Composite card shell and its text block</td></tr>
            <tr><td><code>.ws-skeleton-grid</code></td><td>Responsive grid wrapper (<code>grid: true</code>)</td></tr>
            <tr><td><code>.ws-skeleton-workshop</code></td><td>Workshop card shell</td></tr>
            <tr><td><code>.ws-skeleton-workshop__meta</code></td><td>Meta chip row</td></tr>
            <tr><td><code>.ws-skeleton-workshop__chip</code> / <code>__chip--wide</code></td><td>Individual meta chips</td></tr>
            <tr><td><code>.ws-skeleton-workshop__life</code></td><td>Lifecycle strip row</td></tr>
            <tr><td><code>.ws-skeleton-workshop__dot</code> / <code>__bar</code></td><td>Lifecycle nodes and connectors</td></tr>
            <tr><td><code>.ws-skeleton-workshop__foot</code></td><td>Footer action row</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_skeleton()</code> helper function</td></tr>
            <tr><td><code>includes/components/skeleton.php</code></td><td>Template &mdash; variant switch and class assembly</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles and the <code>ws-skeleton-shimmer</code> keyframes (<code>.ws-skeleton</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
