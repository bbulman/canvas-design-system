<?php
$ds_page  = 'components/demos/listing-card';
$ds_title = 'Listing Card';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">
<link rel="stylesheet" href="<?= $site_base ?>/css/listing-redesign.css">

<div class="ds-page-header">
    <h1>Listing Card</h1>
    <p>The library's content card &mdash; one workshop, exercise, or icebreaker, ready to open.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            You're rendering library items in a grid or list &mdash; the exercises, workshops, and icebreakers pages. Each card links to a detail page and carries the favourite, notes, and share actions.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The content isn't a library record &mdash; use <a href="<?= $ds_base ?>/components/demos/card.php">Card</a> for a generic container or <a href="<?= $ds_base ?>/components/demos/feature-card.php">Feature Card</a> for marketing grids. Inside the Planner, use <a href="<?= $ds_base ?>/components/demos/planner-card.php">Planner Card</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>
    <p class="ds-section-desc">There's one card. What varies is the record it's given &mdash; the category icon and colour, the duration, and whether the item is already in a collection or has comments. All of it comes from <code class="ds-code-inline">prepareCardData()</code>.</p>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
        <?= ws_listing_card([
            'id' => 'demo-1',
            'title' => 'Design Sprint',
            'category' => 'strategy',
            'category_class' => 'strategy',
            'category_icon' => 'rocket_launch',
            'category_color' => '#3B82F6',
            'duration' => '5 days',
            'duration_raw' => 2400,
            'overview' => 'A 5-day process for answering critical business questions through design, prototyping, and testing ideas with customers.',
            'detail_url' => '#',
            'type' => 'workshop',
            'views' => 1240,
            'created_at' => '2025-06-15',
            'in_collection' => false,
            'comment_count' => 3,
        ]) ?>

        <?= ws_listing_card([
            'id' => 'demo-2',
            'title' => 'Crazy Eights',
            'category' => 'ideation',
            'category_class' => 'ideation',
            'category_icon' => 'lightbulb',
            'category_color' => '#F59E0B',
            'duration' => '8 min',
            'duration_raw' => 8,
            'overview' => 'A fast sketching exercise that challenges people to sketch 8 distinct ideas in 8 minutes.',
            'detail_url' => '#',
            'type' => 'exercise',
            'views' => 892,
            'created_at' => '2025-08-22',
            'in_collection' => true,
            'comment_count' => 0,
        ]) ?>

        <?= ws_listing_card([
            'id' => 'demo-3',
            'title' => 'Two Truths and a Lie',
            'category' => 'team building',
            'category_class' => 'team-building',
            'category_icon' => 'groups',
            'category_color' => '#10B981',
            'duration' => '15 min',
            'duration_raw' => 15,
            'overview' => 'A classic icebreaker where each person shares two true statements and one false one. The group guesses the lie.',
            'detail_url' => '#',
            'type' => 'icebreaker',
            'views' => 2103,
            'created_at' => '2025-04-10',
            'in_collection' => false,
            'comment_count' => 7,
        ]) ?>

        <?= ws_listing_card([
            'id' => 'demo-4',
            'title' => 'Pre-mortem',
            'category' => 'strategy',
            'category_class' => 'strategy',
            'category_icon' => 'rocket_launch',
            'category_color' => '#3B82F6',
            'duration' => '45 min',
            'duration_raw' => 45,
            'overview' => 'Imagine the project has already failed, then work back to the risks people privately worry about but rarely say out loud.',
            'detail_url' => '#',
            'type' => 'exercise',
            'views' => 640,
            'created_at' => '2025-09-02',
            'in_collection' => false,
            'comment_count' => 0,
        ]) ?>
    </div>
    <div class="ds-note">
        <span class="material-symbols-outlined">info</span>
        <span>Category colours come from the <code>categories</code> table per record. They're data, not phase tokens &mdash; which is why they aren't red and shouldn't be replaced with one.</span>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>The whole card is an <code>&lt;a&gt;</code> to <code>detail_url</code>, with the action buttons layered in the footer.</td></tr>
            <tr><td>Hover</td><td>Card lifts; action buttons brighten.</td></tr>
            <tr><td>Focus</td><td>Native focus ring on the card link and on each action button.</td></tr>
            <tr><td>In a collection</td><td><code>in_collection: true</code> renders the favourite button in its active state.</td></tr>
            <tr><td>Has comments</td><td>A count badge appears in the meta row when <code>comment_count</code> is above zero, with a <code>title</code> pluralised for one comment.</td></tr>
            <tr><td>Has notes</td><td>The notes button gains <code>.has-note</code> and a red <code>note_add</code> icon &mdash; applied by JS after load, not server-rendered, so it appears a moment after the card.</td></tr>
            <tr><td>No sketch or description</td><td>The card never shows a sketch or a description, whatever the record carries: <code>overview</code> and <code>illustration</code> are ignored. Title, duration and category are the card; the full text and the sketch live on the detail page.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The exercises listing. <code class="ds-code-inline">prepareCardData()</code> does the shaping &mdash; category lookup, duration formatting &mdash; so pages don't build the array by hand.</p>
    <div class="ds-code"><pre>&lt;?php
require_once 'includes/listing-helpers.php';
?&gt;
&lt;div class="listing-grid"&gt;
    &lt;?php foreach ($exercises as $item): ?&gt;
        &lt;?= ws_listing_card(prepareCardData($item, $pageData)) ?&gt;
    &lt;?php endforeach; ?&gt;
&lt;/div&gt;

&lt;?php if (!$exercises): ?&gt;
    &lt;?= ws_empty_state('Nothing matches those filters', [
        'icon' => 'filter_alt_off', 'action' => 'Clear filters', 'actionHref' => '?',
    ]) ?&gt;
&lt;?php endif; ?&gt;</pre></div>
    <p class="ds-section-desc">Including the partial directly still works and produces the same markup &mdash; the helper just wraps it:</p>
    <div class="ds-code"><pre>&lt;?php
$card = prepareCardData($item, $pageData);
include 'includes/partials/listing-card.php';
?&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <p class="ds-section-desc"><code class="ds-code-inline">ws_listing_card()</code> takes one positional array &mdash; the output of <code class="ds-code-inline">prepareCardData()</code>. These are the keys it reads.</p>
    <table class="ds-table">
        <thead>
            <tr><th>Key</th><th>Type</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>id</code></td><td>string</td><td>Record ID, used by the action buttons</td></tr>
            <tr><td><code>title</code></td><td>string</td><td>Card heading</td></tr>
            <tr><td><code>detail_url</code></td><td>string</td><td>Where the card links. Effectively required &mdash; without it the card links nowhere.</td></tr>
            <tr><td><code>category</code></td><td>string</td><td>Category name shown in the footer badge</td></tr>
            <tr><td><code>category_class</code></td><td>string</td><td>Slug used as a styling hook</td></tr>
            <tr><td><code>category_icon</code></td><td>string</td><td>Material icon for the header</td></tr>
            <tr><td><code>category_color</code></td><td>string</td><td>Hex from the record, tinting the icon holder</td></tr>
            <tr><td><code>duration</code></td><td>string</td><td>Formatted duration for display</td></tr>
            <tr><td><code>duration_raw</code></td><td>int</td><td>Minutes, for sorting and filtering</td></tr>
            <tr><td><code>type</code></td><td>string</td><td><code>workshop</code> | <code>exercise</code> | <code>icebreaker</code></td></tr>
            <tr><td><code>views</code></td><td>int</td><td>View count</td></tr>
            <tr><td><code>created_at</code></td><td>string</td><td>ISO date, for sorting</td></tr>
            <tr><td><code>in_collection</code></td><td>bool</td><td>Drives the favourite button's active state</td></tr>
            <tr><td><code>comment_count</code></td><td>int</td><td>Shows a badge when above zero</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Card link</td><td>The card is a real <code>&lt;a&gt;</code>, so it's focusable and announced as a link. Its accessible name comes from the card's text, led by the title, so it is distinct per card in a link list.</td></tr>
            <tr><td>Heading</td><td>The title is an <code>&lt;h3&gt;</code>, so a grid of cards is navigable by heading. Check that <code>h3</code> suits your page outline.</td></tr>
            <tr><td>Nested actions</td><td><strong>Structural issue:</strong> the favourite, notes, and share buttons sit inside the card's own anchor. Interactive elements nested in a link are invalid HTML and produce unpredictable focus and click behaviour &mdash; the buttons rely on <code>stopPropagation</code> to avoid triggering navigation. Moving the actions outside the anchor would fix it.</td></tr>
            <tr><td>Action labels</td><td>Favourite and notes carry <code>aria-label</code>; <strong>share has only a <code>title</code></strong>, so its accessible name is weaker and inconsistent with its siblings. All three are also generic &mdash; "Add to favorites" repeated across 24 cards gives no way to tell which item is being favourited. Name the item: "Add Design Sprint to favorites".</td></tr>
            <tr><td>Notes state</td><td><code>.has-note</code> is applied by JS after load, and conveyed by icon and colour with no text equivalent. A screen-reader user can't tell an annotated card from a plain one.</td></tr>
            <tr><td>Category colour</td><td>Decorative. The category name appears as text in the footer badge, so colour is reinforcement.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <p class="ds-section-desc">Listing Card's styles live in <code class="ds-code-inline">css/listing-redesign.css</code>, not <code class="ds-code-inline">components.css</code> &mdash; a page rendering these cards must load that stylesheet too. It draws on the shared surface, border, radius, ink, and type scales; the only per-record colour is <code class="ds-code-inline">category_color</code>, applied inline from the database rather than from a token.</p>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <p class="ds-section-desc">These use the <code class="ds-code-inline">.listing-card-</code> prefix, not <code class="ds-code-inline">.ws-</code> &mdash; the component predates the library's naming convention.</p>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.card-wrapper</code></td><td>Outer grid cell</td></tr>
            <tr><td><code>.listing-card</code></td><td>The card anchor</td></tr>
            <tr><td><code>.listing-card-header</code></td><td>Icon, title, and meta row</td></tr>
            <tr><td><code>.listing-card-icon</code></td><td>Category icon holder, tinted from <code>category_color</code></td></tr>
            <tr><td><code>.listing-card-title</code></td><td>The <code>&lt;h3&gt;</code></td></tr>
            <tr><td><code>.listing-card-meta</code></td><td>Duration and comment count</td></tr>
            <tr><td><code>.listing-card-comments</code></td><td>Comment count badge</td></tr>
            <tr><td><code>.listing-card-footer</code></td><td>Category badge and actions</td></tr>
            <tr><td><code>.listing-card-actions</code></td><td>Action button group</td></tr>
            <tr><td><code>.listing-card-action</code></td><td>An action button</td></tr>
            <tr><td><code>.favorite-btn</code> / <code>.note-btn</code></td><td>Favourite and notes buttons</td></tr>
            <tr><td><code>.note-btn.has-note</code></td><td>Annotated state, applied by JS</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_listing_card()</code> &mdash; a thin wrapper around the partial</td></tr>
            <tr><td><code>includes/partials/listing-card.php</code></td><td>The actual card markup</td></tr>
            <tr><td><code>includes/listing-helpers.php</code></td><td><code>prepareCardData()</code> and the category utilities</td></tr>
            <tr><td><code>css/listing-redesign.css</code></td><td>All card styles (<code>.listing-card-*</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
