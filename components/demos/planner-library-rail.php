<?php
$ds_page  = 'components/demos/planner-library-rail';
$ds_title = 'Planner Library Rail';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Planner Library Rail</h1>
    <p>The Planner's left column: search, category navigation, and the draggable activity palette.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            You're building the Planner's left column, or a surface that needs the same search &rarr; browse &rarr; drag flow. Every activity goes through <a href="<?= $ds_base ?>/components/demos/planner-card.php">Planner Card</a> at <code>sm</code>, so the palette and the canvas speak the same card language.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            Your sidebar needs regions beyond search, categories, and item sections. This is a layout shell with a fixed anatomy &mdash; compose your own <code>&lt;aside&gt;</code> and reuse <code>ws_planner_card()</code> directly instead of forcing it.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Canonical</h3>
        <p class="ds-section-desc">All three regions: a search field with its keyboard hint, a category list with dots and counts, and grouped sections of draggable cards. Expect a column of 260&ndash;320px.</p>
        <div class="ds-card">
            <div class="ds-rail-stage">
                <div class="ds-rail-shell">
                    <?= ws_planner_library_rail([
                        'search' => [
                            'placeholder' => 'Search 2,418 exercises…',
                            'kbd'         => '⌘K',
                            'name'        => 'q',
                        ],
                        'categories' => [
                            'title' => 'Library',
                            'count' => '2,418',
                            'items' => [
                                ['label' => 'Strategy',        'color' => '#0284C7', 'count' => 284, 'active' => true],
                                ['label' => 'Discovery',       'color' => '#D87F1F', 'count' => 192],
                                ['label' => 'Retrospective',   'color' => '#7C4DFF', 'count' => 156],
                                ['label' => 'Team building',   'color' => '#10B981', 'count' => 312],
                                ['label' => 'Research',        'color' => '#C2410C', 'count' => 141],
                                ['label' => 'Decision making', 'color' => '#888888', 'count' => 118],
                            ],
                        ],
                        'sections' => [
                            [
                                'title' => 'Strategy · drag to add',
                                'meta'  => 'top 5',
                                'items' => [
                                    ['title' => 'Lightning Decision Jam', 'type' => 'exercise', 'duration' => '45m', 'meta' => '6-12 ppl'],
                                    ['title' => 'Stakeholder mapping',    'type' => 'exercise', 'duration' => '30m', 'meta' => '4-8 ppl'],
                                    ['title' => '2×2 prioritization',     'type' => 'exercise', 'duration' => '25m', 'meta' => 'any group'],
                                    ['title' => 'Premortem',              'type' => 'exercise', 'duration' => '35m', 'meta' => '4-12 ppl'],
                                    ['title' => 'Vision sprint',          'type' => 'exercise', 'duration' => '90m', 'meta' => '5-8 ppl'],
                                ],
                            ],
                            [
                                'title' => 'Quick adds',
                                'items' => [
                                    ['title' => 'Two truths and a lie', 'type' => 'icebreaker', 'duration' => '10m', 'meta' => 'icebreaker'],
                                    ['title' => 'Coffee break',         'type' => 'break',      'duration' => '10m', 'meta' => 'break'],
                                    ['title' => 'Lunch',                'type' => 'break',      'duration' => '45m', 'meta' => 'break'],
                                ],
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_planner_library_rail([
    'search'     => ['placeholder' => 'Search 2,418 exercises…', 'kbd' => '⌘K', 'name' => 'q'],
    'categories' => [
        'title' => 'Library',
        'count' => '2,418',
        'items' => [
            ['label' => 'Strategy', 'color' => $cat['color'], 'count' => 284, 'active' => true],
        ],
    ],
    'sections'   => [
        ['title' => 'Strategy · drag to add', 'meta' => 'top 5', 'items' => [
            ['title' => 'Lightning Decision Jam', 'type' => 'exercise',
             'duration' => '45m', 'meta' => '6-12 ppl'],
        ]],
    ],
]) ?&gt;</pre></div>
        <div class="ds-note">
            <span class="material-symbols-outlined">info</span>
            <span>Category colours come from the <code>categories</code> table per record &mdash; they're data, not phase tokens, which is why they aren't red. Pass <code>$cat['color']</code> straight through rather than hardcoding.</span>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Minimal &mdash; no categories</h3>
        <p class="ds-section-desc">Search plus item sections. Use it when the rail is already scoped to one category and the nav would be redundant. Passing <code class="ds-code-inline">null</code> for <code class="ds-code-inline">search</code> hides that region too.</p>
        <div class="ds-card">
            <div class="ds-rail-stage">
                <div class="ds-rail-shell" style="height: 420px;">
                    <?= ws_planner_library_rail([
                        'search' => ['placeholder' => 'Search icebreakers…', 'kbd' => '⌘K'],
                        'sections' => [
                            [
                                'title' => 'Fast icebreakers',
                                'meta'  => 'under 10m',
                                'items' => [
                                    ['title' => 'Two truths and a lie', 'type' => 'icebreaker', 'duration' => '10m', 'meta' => 'any group'],
                                    ['title' => 'One-word check-in',    'type' => 'icebreaker', 'duration' => '5m',  'meta' => 'any group'],
                                    ['title' => 'Rose / bud / thorn',   'type' => 'icebreaker', 'duration' => '8m',  'meta' => 'any group'],
                                ],
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_planner_library_rail([
    'search'   => ['placeholder' => 'Search icebreakers…'],
    'sections' => [['title' => 'Fast icebreakers', 'items' => $items]],
]) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Active category</td><td><code>active =&gt; true</code> applies the phase colour, swaps the dot to white, and sets <code>aria-current="page"</code>.</td></tr>
            <tr><td>Category as link vs button</td><td>With an <code>href</code> the row is an <code>&lt;a&gt;</code>; without one it's a <code>&lt;button&gt;</code> carrying <code>data-category-id</code> and <code>data-category-name</code> for your click handler.</td></tr>
            <tr><td>Section collapsed / expanded</td><td>Section headers toggle via <code>data-rail-toggle</code>, with <code>aria-expanded</code> and <code>aria-controls</code> kept in sync. Your JS owns the toggle.</td></tr>
            <tr><td>Show more / less</td><td>Long sections emit <code>data-rail-show-more</code> with <code>data-label-more</code> and <code>data-label-less</code>, so the button text swaps without hardcoding strings in JS.</td></tr>
            <tr><td>Card states</td><td>Hover, disabled, and the swap affordance all belong to <a href="<?= $ds_base ?>/components/demos/planner-card.php">Planner Card</a>.</td></tr>
            <tr><td>Empty section</td><td>Renders the header with no items. Filter empty sections out before passing them.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The Planner's real left column, built from the category and exercise tables. Items are forwarded wholesale to Planner Card, so any card option can travel in the item array &mdash; including <code class="ds-code-inline">attrs</code> for the drag payload.</p>
    <div class="ds-code"><pre>&lt;?= ws_planner_library_rail([
    'search'     => ['placeholder' => "Search {$total} exercises…", 'kbd' => '⌘K', 'name' => 'q',
                     'value' => $_GET['q'] ?? ''],
    'categories' => [
        'title' => 'Library',
        'count' => number_format($total),
        'items' => array_map(fn($c) => [
            'label'  => $c['name'],
            'color'  => $c['color'],
            'count'  => $c['exercise_count'],
            'active' => $c['id'] === $activeCategoryId,
            'id'     => $c['id'],
        ], $categories),
    ],
    'sections'   => [[
        'title' => $activeCategoryName . ' · drag to add',
        'meta'  => 'top ' . count($exercises),
        'items' => array_map(fn($e) => [
            'title'    => $e['name'],
            'type'     => 'exercise',
            'duration' => (int) $e['duration'],
            'meta'     => $e['group_size'],
            'attrs'    => ['data-exercise-id' => $e['id']],   // the drag payload
        ], $exercises),
    ]],
]) ?&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>search</code></td><td>array|null</td><td><code>['placeholder', 'kbd', 'name', 'value']</code>. <code>null</code> hides the region. <code>kbd</code> is the shortcut hint shown in the field.</td></tr>
            <tr><td><code>categories</code></td><td>array|null</td><td><code>['title', 'count', 'items']</code>, each item <code>['label', 'color', 'count?', 'active?', 'href?', 'id?']</code>. <code>null</code> hides the nav.</td></tr>
            <tr><td><code>sections</code></td><td>array</td><td><code>[['title', 'meta?', 'items']]</code>. Each item is forwarded to <code>ws_planner_card()</code> with <code>size=sm</code> and <code>draggable=true</code>, so every card option is valid.</td></tr>
            <tr><td><code>id</code></td><td>string</td><td>Element ID</td></tr>
            <tr><td><code>class</code></td><td>string</td><td>Additional CSS classes</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td>Extra HTML attributes</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <p class="ds-section-desc">The best-wired component in the library &mdash; treat its markup as the reference for the other rails.</p>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Landmarks</td><td>The search region carries <code>role="search"</code>, making it a named landmark screen-reader users can jump to.</td></tr>
            <tr><td>Lists</td><td>Category and item groups use <code>role="list"</code> and <code>role="listitem"</code>, so counts and positions are announced.</td></tr>
            <tr><td>Current category</td><td><code>aria-current="page"</code> on the active row &mdash; the state is conveyed without relying on the colour swap.</td></tr>
            <tr><td>Collapsible sections</td><td>Headers pair <code>aria-expanded</code> with <code>aria-controls</code> pointing at <code>{sectionId}-body</code>, the correct disclosure pattern.</td></tr>
            <tr><td>Search field</td><td>Labelled by <code>aria-label</code> taken from the placeholder, so it has a name even though there's no visible label.</td></tr>
            <tr><td>Decorative icons</td><td>Category dots and chevrons carry <code>aria-hidden="true"</code>.</td></tr>
            <tr><td>Drag to add</td><td><strong>Known gap:</strong> dragging a card to the canvas is pointer-only. A keyboard user can reach and focus a palette card but cannot place it. Provide an "Add to agenda" action as an equivalent path &mdash; this is the rail's most significant accessibility limitation.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <p class="ds-section-desc">The rail is a layout shell, so most of its visual weight comes from the cards inside it. Its own rules draw on the shared surface, border, ink, and spacing scales; the activity accents come from <code class="ds-code-inline">--planner-*</code> by way of <a href="<?= $ds_base ?>/components/demos/planner-card.php">Planner Card</a>, and category dots take their colour from record data rather than a token.</p>
    <p class="ds-section-desc">Rail width is governed by <code class="ds-code-inline">--app-rail-width</code> (320px) in the app shell &mdash; see <a href="<?= $ds_base ?>/apps/app-planner.php">the Planner guide</a>. Don't hardcode a width on the container.</p>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <p class="ds-section-desc">Note the prefix is <code class="ds-code-inline">.ws-planner-rail</code>, not <code class="ds-code-inline">.ws-planner-library-rail</code> &mdash; the helper and the class don't share a name.</p>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-planner-rail</code></td><td>Rail container</td></tr>
            <tr><td><code>.ws-planner-rail__search</code> / <code>__search-icon</code> / <code>__search-kbd</code></td><td>Search region and its adornments</td></tr>
            <tr><td><code>.ws-planner-rail__categories</code> / <code>__cat-grid</code></td><td>Category nav wrappers</td></tr>
            <tr><td><code>.ws-planner-rail__cat-btn</code> / <code>-name</code> / <code>-count</code> / <code>-icon</code></td><td>A category row and its parts</td></tr>
            <tr><td><code>.ws-planner-rail__cat-dot</code></td><td>Colour dot, tinted from record data</td></tr>
            <tr><td><code>.ws-planner-rail__h</code> / <code>__h--toggle</code> / <code>__h-left</code> / <code>__h-right</code> / <code>__h-icon</code> / <code>__h-chevron</code></td><td>Section header and its disclosure control</td></tr>
            <tr><td><code>.ws-planner-rail__body</code></td><td>Collapsible section body, targeted by <code>aria-controls</code></td></tr>
            <tr><td><code>.ws-planner-rail__items</code></td><td>Card list</td></tr>
            <tr><td><code>.ws-planner-rail__filter</code></td><td>Filter control row</td></tr>
            <tr><td><code>.ws-planner-rail__instructions</code></td><td>Helper text, e.g. "drag to add"</td></tr>
            <tr><td><code>.ws-planner-rail__footer</code> / <code>-btn</code> / <code>-label</code> / <code>-btn-icon</code></td><td>Rail footer actions</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_planner_library_rail()</code> helper function</td></tr>
            <tr><td><code>includes/components/planner-library-rail.php</code></td><td>Template &mdash; regions, ARIA wiring, and the card loop</td></tr>
            <tr><td><code>includes/components/planner-card.php</code></td><td>Renders every activity in the rail</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-planner-rail</code> rules)</td></tr>
            <tr><td><code>css/planner/components/_sidebar.css</code></td><td>Planner-side rail styling</td></tr>
        </tbody>
    </table>
</section>

<style>
.ds-rail-stage {
    display: flex;
    gap: 24px;
    flex-wrap: wrap;
}
.ds-rail-shell {
    width: 280px;
    height: 640px;
    border: 1px solid var(--color-border, #E5E7EB);
    border-radius: var(--radius-xl, 12px);
    overflow: hidden;
    background: var(--bg-surface, rgba(255, 255, 255, 0.6));
}
</style>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
