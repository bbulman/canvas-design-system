<?php
$ds_page  = 'components/demos/breadcrumb';
$ds_title = 'Breadcrumb';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Breadcrumb</h1>
    <p>Shows where the current page sits in the hierarchy, and gives one-click routes back up it.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            The page sits two or more levels deep in a real hierarchy readers navigate &mdash; a workshop inside a category inside the library. Breadcrumbs answer "where am I" and "how do I get back up".
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The page is top-level, or the "hierarchy" is really a linear flow &mdash; a wizard needs <a href="<?= $ds_base ?>/components/demos/progress.php">Progress</a>, not a trail. Don't use it to record how the reader arrived; it reflects structure, not history.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>
    <p class="ds-section-desc">There's one visual treatment. What changes is depth &mdash; and the only structural rule is that the final item has no <code class="ds-code-inline">href</code>, because it's the page you're on.</p>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Two levels</h3>
        <div class="ds-card">
            <?= ws_breadcrumb([
                ['label' => 'Home', 'href' => '/'],
                ['label' => 'About'],
            ]) ?>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Three levels</h3>
        <div class="ds-card">
            <?= ws_breadcrumb([
                ['label' => 'Home', 'href' => '/'],
                ['label' => 'Workshops', 'href' => '/library/workshops/'],
                ['label' => 'Design Sprint'],
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_breadcrumb([
    ['label' => 'Home', 'href' => '/'],
    ['label' => 'Workshops', 'href' => '/library/workshops/'],
    ['label' => 'Design Sprint'],
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Deep nesting</h3>
        <p class="ds-section-desc">Four levels is the practical ceiling. Past that, shorten the labels or reconsider the information architecture &mdash; the trail wraps and stops being scannable.</p>
        <div class="ds-card">
            <?= ws_breadcrumb([
                ['label' => 'Home', 'href' => '/'],
                ['label' => 'Coach', 'href' => '/coach/'],
                ['label' => 'Prep Mode', 'href' => '/planner/prep.php'],
                ['label' => 'Agenda Review'],
            ]) ?>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Custom separator</h3>
        <p class="ds-section-desc">Any Material icon name works. Change it only for a deliberate reason &mdash; the chevron is the platform default and consistency is worth more than novelty.</p>
        <div class="ds-card">
            <?= ws_breadcrumb([
                ['label' => 'Home', 'href' => '/'],
                ['label' => 'Library', 'href' => '/library/'],
                ['label' => 'Icebreakers'],
            ], ['separator' => 'arrow_forward_ios']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_breadcrumb($items, ['separator' => 'arrow_forward_ios']) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Ancestor link</td><td>Rendered as an <code>&lt;a class="ws-breadcrumb__link"&gt;</code> in <code>--text-muted</code>.</td></tr>
            <tr><td>Hover</td><td>Link shifts to <code>--brand</code> over <code>--transition-fast</code>.</td></tr>
            <tr><td>Focus</td><td>Native browser focus ring on the anchor &mdash; the component adds no custom outline.</td></tr>
            <tr><td>Current page</td><td>The last item is emitted as <code>&lt;span class="ws-breadcrumb__text"&gt;</code> inside an item marked <code>.ws-breadcrumb__item--current</code>, carrying <code>aria-current="page"</code>. It's deliberately not a link.</td></tr>
            <tr><td>Item with no <code>href</code></td><td>Any item can omit <code>href</code>, not just the last &mdash; it renders as plain text. Use this for a real but unlinkable tier, such as a grouping that has no index page.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">A library exercise page builds the trail from the record's own category, so the breadcrumb tracks the data rather than being hand-written per page.</p>
    <div class="ds-card">
        <?= ws_breadcrumb([
            ['label' => 'Home', 'href' => '/'],
            ['label' => 'Exercises', 'href' => '/library/exercises/'],
            ['label' => 'Ideation', 'href' => '/library/exercises/?category=ideation'],
            ['label' => 'Crazy 8s'],
        ]) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_breadcrumb([
    ['label' => 'Home',      'href' => '/'],
    ['label' => 'Exercises', 'href' => '/library/exercises/'],
    ['label' => $ex['category_name'],
     'href'  => '/library/exercises/?category=' . urlencode($ex['category_slug'])],
    ['label' => $ex['name']],
]) ?&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>$items</code></td><td>array</td><td>required</td><td>Positional. Ordered list of <code>['label' => …, 'href' => …]</code>, root first. Omit <code>href</code> on the last item.</td></tr>
            <tr><td><code>separator</code></td><td>string</td><td><code>'chevron_right'</code></td><td>Material icon name rendered between items</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>null</code></td><td>Element ID</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
        </tbody>
    </table>

    <h3 class="ds-subsection-title">Item options</h3>
    <table class="ds-table">
        <thead><tr><th>Key</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>label</code></td><td>string</td><td>&mdash;</td><td>Visible text. Keep it to the noun &mdash; "Exercises", not "All exercises in the library".</td></tr>
            <tr><td><code>href</code></td><td>string</td><td><code>null</code></td><td>Destination. Omit to render the item as plain text.</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <p class="ds-section-desc">This is one of the better-wired components in the set &mdash; it follows the <a href="https://www.w3.org/WAI/ARIA/apg/patterns/breadcrumb/" target="_blank" rel="noopener">WAI-ARIA Breadcrumb pattern</a> as shipped.</p>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Landmark</td><td>Wrapped in <code>&lt;nav aria-label="Breadcrumb"&gt;</code>, so it's reachable as a named landmark and distinguishable from other navs on the page.</td></tr>
            <tr><td>Structure</td><td>An ordered <code>&lt;ol&gt;</code>, so screen readers announce position and count &mdash; "3 of 4".</td></tr>
            <tr><td>Current page</td><td>The final item carries <code>aria-current="page"</code> and is not a link, so it isn't announced as an actionable destination.</td></tr>
            <tr><td>Keyboard</td><td>Ancestor links are standard anchors in <kbd>Tab</kbd> order, activated with <kbd>Enter</kbd>. Nothing custom.</td></tr>
            <tr><td>Separators</td><td>Decorative icons between items. Keep them out of the accessible name &mdash; never encode meaning in the separator alone.</td></tr>
            <tr><td>Contrast</td><td>Ancestors use <code>--text-muted</code> against the page surface; the current item uses <code>--text-dark</code>. The current item is intentionally the highest-contrast element.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--text-muted</code></td><td>Ancestor link colour</td></tr>
            <tr><td><code>--text-dark</code> / <code>--text-default</code></td><td>Current-page text</td></tr>
            <tr><td><code>--brand</code></td><td>Link hover colour</td></tr>
            <tr><td><code>--gray-400</code></td><td>Separator icon</td></tr>
            <tr><td><code>--space-1</code></td><td>Gap between item, separator, and next item</td></tr>
            <tr><td><code>--text-meta</code></td><td>Label type scale</td></tr>
            <tr><td><code>--font-body</code> / <code>--font-medium</code></td><td>Face, and the weight bump on the current item</td></tr>
            <tr><td><code>--transition-fast</code></td><td>Link hover</td></tr>
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
            <tr><td><code>.ws-breadcrumb</code></td><td>The <code>&lt;nav&gt;</code> wrapper</td></tr>
            <tr><td><code>.ws-breadcrumb__list</code></td><td>The <code>&lt;ol&gt;</code></td></tr>
            <tr><td><code>.ws-breadcrumb__item</code></td><td>Each <code>&lt;li&gt;</code></td></tr>
            <tr><td><code>.ws-breadcrumb__item--current</code></td><td>The final item</td></tr>
            <tr><td><code>.ws-breadcrumb__link</code></td><td>Ancestor anchor</td></tr>
            <tr><td><code>.ws-breadcrumb__text</code></td><td>Non-link label (current page, or any item without <code>href</code>)</td></tr>
            <tr><td><code>.ws-breadcrumb__separator</code></td><td>Separator icon</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_breadcrumb()</code> helper function</td></tr>
            <tr><td><code>includes/components/breadcrumb.php</code></td><td>Template &mdash; list markup and ARIA wiring</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-breadcrumb</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
