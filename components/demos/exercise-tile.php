<?php
$ds_page  = 'components/demos/exercise-tile';
$ds_title = 'Exercise Tile';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';

$demoTiles = [
    ['symbol' => 'Bw', 'name' => 'Brainwriting', 'minutes' => 20, 'href' => '/library/exercises/detail/?code=brwritg'],
    ['symbol' => 'Af', 'name' => 'Affinity Diagramming', 'minutes' => 20, 'href' => '/library/exercises/detail/?code=affinity'],
    ['symbol' => 'Dv', 'name' => 'Dot Voting', 'minutes' => 25, 'href' => '/library/exercises/detail/?code=dotvote'],
];
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Exercise Tile</h1>
    <p>One exercise as a square: its two-letter symbol, the step's minutes and its name. Three in a row, joined by plus signs, are a recipe.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            A recipe names its exercises. <code>ws_exercise_formula</code> draws them in the order they run; a single <code>ws_exercise_tile</code> is one exercise at a glance. The minutes are the step's, so they change with the recipe's length.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            Browsing exercises, where a <a href="<?= $ds_base ?>/components/demos/listing-card.php">Listing Card</a> carries the title, duration and category; or inside the Planner, which uses its own planner card. A running order with start times is an <a href="<?= $ds_base ?>/components/demos/agenda.php">Agenda</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">The formula</h3>
        <p class="ds-section-desc">Three tiles in order, joined by plus signs. Every tile keeps the same width; below 600px they stack, with each plus sign between them.</p>
        <div class="ds-card">
            <?= ws_exercise_formula($demoTiles, ['label' => 'The three exercises, in order']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_exercise_formula([
    ['symbol' =&gt; 'Bw', 'name' =&gt; 'Brainwriting', 'minutes' =&gt; 20, 'href' =&gt; '/library/exercises/detail/?code=brwritg'],
    ['symbol' =&gt; 'Af', 'name' =&gt; 'Affinity Diagramming', 'minutes' =&gt; 20, 'href' =&gt; '/library/exercises/detail/?code=affinity'],
    ['symbol' =&gt; 'Dv', 'name' =&gt; 'Dot Voting', 'minutes' =&gt; 25, 'href' =&gt; '/library/exercises/detail/?code=dotvote'],
], ['label' =&gt; 'The three exercises, in order']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">One tile</h3>
        <p class="ds-section-desc">With <code class="ds-code-inline">href</code> the whole tile is a link; without <code class="ds-code-inline">minutes</code> the corner stays empty.</p>
        <div class="ds-card">
            <?php ws_grid_start(['min' => 'sm', 'gap' => '6']) ?>
            <?= ws_exercise_tile(['symbol' => 'Pv', 'name' => 'Point of View Statement', 'minutes' => 15, 'href' => '/library/exercises/detail/?code=povstatement']) ?>
            <?= ws_exercise_tile(['symbol' => 'Sf', 'name' => 'Stinky Fish']) ?>
            <?php ws_grid_end() ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_exercise_tile(['symbol' =&gt; 'Pv', 'name' =&gt; 'Point of View Statement', 'minutes' =&gt; 15, 'href' =&gt; '/library/exercises/detail/?code=povstatement']) ?&gt;
&lt;?= ws_exercise_tile(['symbol' =&gt; 'Sf', 'name' =&gt; 'Stinky Fish']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With actions</h3>
        <p class="ds-section-desc">Hover the tile, or tab into it, and its buttons rise into the middle row; on a touch screen they are always there. A recipe page gives each tile Swap and Quick view, each opening a <a href="<?= $ds_base ?>/components/demos/side-panel.php">Side Panel</a>, and passes the Quick view's trigger as <code class="ds-code-inline">linkAttrs</code>, so a click anywhere else on the tile opens it too.</p>
        <div class="ds-card">
            <?php ws_grid_start(['min' => 'sm', 'gap' => '6']) ?>
            <?= ws_exercise_tile(['symbol' => 'Bw', 'name' => 'Brainwriting', 'minutes' => 20, 'href' => '/library/exercises/detail/?code=brwritg', 'actions' => [
                ['icon' => 'swap_horiz', 'label' => 'Swap'],
                ['icon' => 'visibility', 'label' => 'Quick view'],
            ]]) ?>
            <?= ws_exercise_tile(['symbol' => 'Pv', 'name' => 'Point of View Statement', 'minutes' => 15, 'href' => '/library/exercises/detail/?code=povstatement', 'actions' => [
                ['icon' => 'visibility', 'label' => 'Quick view'],
            ]]) ?>
            <?php ws_grid_end() ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_exercise_tile([
    'symbol' =&gt; 'Bw', 'name' =&gt; 'Brainwriting', 'minutes' =&gt; 20,
    'href' =&gt; '/library/exercises/detail/?code=brwritg',
    'actions' =&gt; [
        ['icon' =&gt; 'swap_horiz', 'label' =&gt; 'Swap', 'attrs' =&gt; ['data-ws-side-panel-open' =&gt; 'swap-brwritg', 'aria-controls' =&gt; 'swap-brwritg', 'aria-expanded' =&gt; 'false']],
        ['icon' =&gt; 'visibility', 'label' =&gt; 'Quick view', 'attrs' =&gt; ['data-ws-side-panel-open' =&gt; 'peek-brwritg', 'aria-controls' =&gt; 'peek-brwritg', 'aria-expanded' =&gt; 'false']],
    ],
]) ?&gt;</pre></div>
    </div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <h3 class="ds-subsection-title">ws_exercise_tile</h3>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>symbol</code></td><td>string</td><td>required</td><td>Two letters, capital then lowercase, one per exercise everywhere it appears</td></tr>
            <tr><td><code>name</code></td><td>string</td><td>required</td><td>The exercise's display name. The capitals are CSS.</td></tr>
            <tr><td><code>minutes</code></td><td>int</td><td><code>null</code></td><td>The step's minutes; omitted, the corner stays empty</td></tr>
            <tr><td><code>href</code></td><td>string</td><td><code>''</code></td><td>Makes the whole tile a link</td></tr>
            <tr><td><code>linkAttrs</code></td><td>array</td><td><code>[]</code></td><td>Needs <code>href</code>. Extra attributes on the tile's link. A recipe passes its Quick view's <code>data-ws-side-panel-open</code>, so a click on the tile opens the panel; a Ctrl- or Cmd-click, and a page without script, still follow <code>href</code>.</td></tr>
            <tr><td><code>actions</code></td><td>array</td><td><code>[]</code></td><td>Needs <code>href</code>. Icon buttons, each <code>icon</code>, <code>label</code> (the verb) and <code>attrs</code>, shown on hover or focus and always on touch. Each is named "{label} {name}", with the label as its tooltip.</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>''</code></td><td>Element ID</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra HTML attributes</td></tr>
        </tbody>
    </table>
    <h3 class="ds-subsection-title">ws_exercise_formula</h3>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>$tiles</code></td><td>array</td><td>required</td><td>Each tile's <code>ws_exercise_tile</code> options, in order</td></tr>
            <tr><td><code>label</code></td><td>string</td><td><code>''</code></td><td>The list's accessible name, when no heading right above names it</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>''</code></td><td>Element ID</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra HTML attributes</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Reading order</td><td>The name comes first in the markup and the minutes follow in words, so a tile reads "Brainwriting, 20 minutes". The grid areas move them visually only.</td></tr>
            <tr><td>Symbol</td><td><code>aria-hidden</code>: it is a visual shorthand, and "B w" read aloud means nothing.</td></tr>
            <tr><td>Capitals</td><td><code>text-transform</code>, not typed capitals, so a screen reader never spells the name letter by letter.</td></tr>
            <tr><td>Formula</td><td>An ordered list, announced with its count. The plus signs are <code>aria-hidden</code>: the order already says what follows what.</td></tr>
            <tr><td>Links</td><td>With <code>href</code> the tile is one link named by its text, with a visible focus ring.</td></tr>
            <tr><td>Actions</td><td>The name is the link, stretched over the tile; each action is a real button beside it, never inside it, named "Swap Brainwriting" and at least 44px square. They follow the link in the Tab order, show on <code>:focus-within</code> as well as on hover, and are always shown where there is no hover. The rise is opacity and a 4px lift over <code>--duration-fast</code>; under reduced motion only the opacity changes.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--bg-surface</code>, <code>--card-border</code></td><td>The tile's white fill and its 2px border</td></tr>
            <tr><td><code>--brand-ink</code></td><td>The symbol and the plus signs</td></tr>
            <tr><td><code>--font-heading</code>, <code>--text-display-lg</code></td><td>The symbol: Fraunces</td></tr>
            <tr><td><code>--font-body</code>, <code>--text-small</code>, <code>--text-meta</code></td><td>The minutes and the name: Inter</td></tr>
            <tr><td><code>--brand</code></td><td>A linked tile's border on hover</td></tr>
            <tr><td><code>--focus-ring</code></td><td>A linked tile's focus ring</td></tr>
            <tr><td><code>--duration-fast</code>, <code>--ease-out</code>, <code>--space-1</code></td><td>The actions' rise: fade and a 4px lift</td></tr>
            <tr><td><code>--target-comfortable</code></td><td>Each action's 44px target</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-exercise-tile</code></td><td>The square</td></tr>
            <tr><td><code>.ws-exercise-tile--link</code></td><td>A tile with <code>href</code></td></tr>
            <tr><td><code>.ws-exercise-tile--actions</code></td><td>A tile with <code>actions</code>: a box, not a link</td></tr>
            <tr><td><code>.ws-exercise-tile__link</code></td><td>The name as the link, stretched over the tile by <code>::after</code></td></tr>
            <tr><td><code>.ws-exercise-tile__actions</code> / <code>__action</code></td><td>The row of buttons in the middle of the tile, and each button</td></tr>
            <tr><td><code>.ws-exercise-tile__symbol</code> / <code>__minutes</code> / <code>__name</code></td><td>Top left, top right, bottom right</td></tr>
            <tr><td><code>.ws-exercise-formula</code></td><td>The ordered list</td></tr>
            <tr><td><code>.ws-exercise-formula__item</code></td><td>One tile's slot, all the same width</td></tr>
            <tr><td><code>.ws-exercise-formula__plus</code></td><td>The plus sign in the gap before a tile</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_exercise_tile()</code> and <code>ws_exercise_formula()</code></td></tr>
            <tr><td><code>includes/components/exercise-tile.php</code></td><td>Template: one tile</td></tr>
            <tr><td><code>includes/components/exercise-formula.php</code></td><td>Template: the list of tiles and plus signs</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-exercise-tile</code> and <code>.ws-exercise-formula</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
