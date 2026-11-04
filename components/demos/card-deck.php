<?php
$ds_page  = 'components/demos/card-deck';
$ds_title = 'Card Deck';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';

$demoCards = [
    ['title' => 'The Naysayer', 'caption' => 'Difficult Participants · 1 of 3', 'icon' => 'support'],
    ['title' => 'The Silent One'],
    ['title' => 'Running Over'],
];
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<style>
    /* A stand-in for the cockpit panel: the positioned box a floating deck pins to. */
    .ds-deck-stage { position: relative; min-height: calc(var(--space-16) * 4); }
</style>

<div class="ds-page-header">
    <h1>Card Deck</h1>
    <p>Up to three suggested cards cascaded in a corner: the front card whole, the two behind it showing only their titles. The whole deck is one link to the full set.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            A few suggested cards should be in reach without taking the screen: the Intervention Card peek in the live cockpit, where the top three cards for the running block wait in the corner, one tap from the full set.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The reader compares the cards or acts on each one. Lay them out with <a href="<?= $ds_base ?>/components/demos/layout.php">ws_grid_start</a> and a <a href="<?= $ds_base ?>/components/demos/card.php">Card</a> each; one route into a task is a <a href="<?= $ds_base ?>/components/demos/choice-card.php">Choice Card</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">One, two or three cards</h3>
        <p class="ds-section-desc">Pass the cards front first. The front card shows its title, its icon and its caption; each card behind it shows a title strip. Only the first three are drawn, and a deck with no card renders nothing.</p>
        <div class="ds-card">
            <?php ws_grid_start(['min' => 'sm', 'gap' => '6']) ?>
            <?= ws_card_deck([['title' => 'The Naysayer', 'caption' => 'Difficult Participants · 1 of 3', 'icon' => 'support'], ['title' => 'The Silent One'], ['title' => 'Running Over']], ['href' => '#cards']) ?>
            <?= ws_card_deck(array_slice($demoCards, 0, 2), ['href' => '#cards']) ?>
            <?= ws_card_deck(array_slice($demoCards, 0, 1), ['href' => '#cards']) ?>
            <?php ws_grid_end() ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_card_deck([
    ['title' =&gt; 'The Naysayer', 'caption' =&gt; 'Difficult Participants · 1 of 3', 'icon' =&gt; 'support'],
    ['title' =&gt; 'The Silent One'],
    ['title' =&gt; 'Running Over'],
], ['href' =&gt; '/intervention/']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Floating</h3>
        <p class="ds-section-desc"><code class="ds-code-inline">position =&gt; 'float'</code> pins the deck to the bottom right of its positioned container, over the content, as in the cockpit. A page with a dock lifts it clear by setting <code class="ds-code-inline">--ws-card-deck-bottom</code> on the container.</p>
        <div class="ds-card ds-deck-stage">
            <?= ws_text('Sailboat Retrospective', ['variant' => 'title']) ?>
            <?= ws_card_deck($demoCards, ['href' => '#cards', 'position' => 'float']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_card_deck($cards, ['href' =&gt; $cardsUrl, 'position' =&gt; 'float']) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>Every card on <code>--shadow-md</code>; the cards behind are scaled to 95% and 90% from their top edge, a strip apart.</td></tr>
            <tr><td>Hover and focus</td><td>The shadows deepen to <code>--shadow-lg</code> and the strips fan open: each card behind lifts a little further than the one in front of it. Under <code>prefers-reduced-motion</code> only the shadow changes.</td></tr>
            <tr><td>Focus</td><td>The platform's focus ring around the whole deck.</td></tr>
            <tr><td>No cards</td><td>Nothing is rendered: an empty deck is not a link to nowhere.</td></tr>
            <tr><td>Long titles</td><td>Each title stays on one line and ends in an ellipsis; the full titles are in the deck's accessible name.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The live cockpit ranks the Intervention Cards for the running block and how late the room is, then peeks the top three from the corner of the panel. The deck opens the cards screen.</p>
    <div class="ds-card ds-deck-stage ds-measure">
        <?php ws_stack_start(['gap' => '3']) ?>
        <?= ws_activity_badge('exercise', ['size' => 'sm']) ?>
        <?= ws_text('Sailboat Retrospective', ['variant' => 'title']) ?>
        <?= ws_run_clock(['seconds' => 440, 'planned' => 20, 'size' => 'md']) ?>
        <?php ws_stack_end() ?>
        <?= ws_card_deck($demoCards, ['href' => '#cards', 'position' => 'float', 'id' => 'demoCardDeck']) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_card_deck(array_map(fn($c, $i) =&gt; [
    'title' =&gt; $c['title'],
    'caption' =&gt; $i === 0 ? $c['category'] . ' · 1 of ' . count($top) : null,
    'icon' =&gt; 'support',
], $top, array_keys($top)), ['href' =&gt; $cardsUrl, 'position' =&gt; 'float']) ?&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>$cards</code></td><td>array</td><td>required</td><td>Positional. Front first; each card has <code>title</code> (required), <code>caption</code> and <code>icon</code> (a Material Symbols name). Only the front card shows its caption and icon.</td></tr>
            <tr><td><code>href</code></td><td>string</td><td><code>''</code></td><td>Where the deck leads. Without it the deck is a named group rather than a link.</td></tr>
            <tr><td><code>name</code></td><td>string</td><td><code>'Intervention Cards'</code></td><td>What the deck holds; it opens the accessible name</td></tr>
            <tr><td><code>label</code></td><td>string</td><td>derived</td><td>Replaces the derived accessible name</td></tr>
            <tr><td><code>position</code></td><td>string</td><td><code>'inline'</code></td><td><code>inline</code> or <code>float</code> (bottom right of the positioned container)</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>''</code></td><td>Element ID</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra HTML attributes, such as <code>data-sk-go</code></td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Semantics</td><td>One link, so one Tab stop, however many cards it shows. Without <code>href</code> it is a group.</td></tr>
            <tr><td>Name</td><td>Says what it holds and every card in it, front first: "Intervention Cards, 3 suggested: The Naysayer, The Silent One, Running Over". <code>label</code> replaces it.</td></tr>
            <tr><td>Icon</td><td><code>aria-hidden</code>: the name already says what the deck is.</td></tr>
            <tr><td>Focus</td><td>The sky-blue focus ring (<code>--focus-ring</code>) around the whole deck.</td></tr>
            <tr><td>Motion</td><td>The hover lift is a transform and is left out under <code>prefers-reduced-motion</code>.</td></tr>
            <tr><td>Target</td><td>220 by about 140 pixels, far above the 44px minimum.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--shadow-md</code> / <code>--shadow-lg</code></td><td>Each card at rest, and on hover and focus</td></tr>
            <tr><td><code>--space-8</code></td><td>The strip each card behind shows</td></tr>
            <tr><td><code>--space-10</code>, <code>--space-5</code>, <code>--space-16</code>, <code>--space-2</code></td><td>The deck's width and a back card's height</td></tr>
            <tr><td><code>--space-4</code></td><td>The floating deck's inset from the right and, by default, the bottom</td></tr>
            <tr><td><code>--ws-card-deck-bottom</code></td><td>Set on the container to lift a floating deck clear of a dock</td></tr>
            <tr><td><code>--brand-ink</code></td><td>The front card's icon</td></tr>
            <tr><td><code>--card-radius</code></td><td>The deck's corners, which the focus ring follows</td></tr>
            <tr><td><code>--focus-ring</code> / <code>--focus-ring-offset</code></td><td>Keyboard focus</td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">info</span>
        <span>Each card is a <code>ws-card ws-card--compact</code>, so its fill, border, radius and padding are the Card's own tokens.</span>
    </div>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-card-deck</code></td><td>The deck: a link (or a group) holding the cards</td></tr>
            <tr><td><code>.ws-card-deck--float</code></td><td>Pinned to the bottom right of the positioned container</td></tr>
            <tr><td><code>.ws-card-deck__card</code></td><td>Each card, on <code>.ws-card.ws-card--compact</code></td></tr>
            <tr><td><code>.ws-card-deck__card--1</code> / <code>--2</code> / <code>--3</code></td><td>Front, second and third. The back cards come first in the markup, so the front paints over them.</td></tr>
            <tr><td><code>.ws-card-deck__head</code></td><td>The front card's title and icon row</td></tr>
            <tr><td><code>.ws-card-deck__icon</code></td><td>The front card's icon</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_card_deck()</code> helper function</td></tr>
            <tr><td><code>includes/components/card-deck.php</code></td><td>Template: the cards, back first, and the accessible name</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-card-deck</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
