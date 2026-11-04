<?php
$ds_page  = 'components/demos/card';
$ds_title = 'Card';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">
<link rel="stylesheet" href="<?= $site_base ?>/css/listing-redesign.css">

<div class="ds-page-header">
    <h1>Card</h1>
    <p>Groups related content into one bounded block, so a list of things reads as a list of things.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            You're presenting repeated items of the same kind (exercises, workshops, saved plans), or grouping a self-contained block such as a stat summary or a set of form fields. Cards create the boundary that makes a grid scannable. An item card in a grid is <code>variant</code> content (the <code>--card-padding</code> every card shares); add <code>bordered</code> when the cards sit straight on the page background, as the screen recipes do, and give every card in one grid the same options. Inside it, a stack at gap 3 holds the title (<code>ws_text</code>, <code>variant</code> title), a cluster at gap 2 for duration and category, and the action; the page around the grid is a stack at gap 5. <code>compact</code> is for dense rails and sidebars, <code>feature</code> for marketing grids, and <code>hoverable</code> goes only with <code>href</code>. Before calling it done, measure it against the cards beside it on the real page.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The content is a single run of prose &mdash; that's a paragraph. For a full-width message use <a href="<?= $ds_base ?>/components/demos/alert.php">Alert</a>; for a pre-composed library item use <a href="<?= $ds_base ?>/components/demos/listing-card.php">Listing Card</a>. Don't nest a card inside a card.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Padding variants</h3>
        <p class="ds-section-desc">The four variants differ only in internal padding. Pick by density, not importance.</p>
        <div class="ds-grid-3">
            <?php ws_card_start(['variant' => 'content']); ?>
                <strong>Content</strong>
                <p class="ds-card-demo-note">Standard padding. The default for listings and most grids.</p>
            <?php ws_card_end(); ?>

            <?php ws_card_start(['variant' => 'feature']); ?>
                <strong>Feature</strong>
                <p class="ds-card-demo-note">Roomier. For a small number of prominent cards.</p>
            <?php ws_card_end(); ?>

            <?php ws_card_start(['variant' => 'compact']); ?>
                <strong>Compact</strong>
                <p class="ds-card-demo-note">Tighter. For dense UI such as sidebars and rails.</p>
            <?php ws_card_end(); ?>
        </div>
        <div class="ds-code"><pre>&lt;?php ws_card_start(['variant' => 'content']); ?&gt;
    Content here...
&lt;?php ws_card_end(); ?&gt;</pre></div>
        <p class="ds-section-desc">The fourth, <code class="ds-code-inline">flush</code>, removes padding entirely so the header/body/footer slots can own their own spacing &mdash; see Real-World Usage.</p>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Modifiers</h3>
        <p class="ds-section-desc">Modifiers stack with any variant. <code class="ds-code-inline">elevated</code> and <code class="ds-code-inline">bordered</code> are mutually exclusive in practice &mdash; elevation drops the border.</p>
        <div class="ds-grid-3">
            <?php ws_card_start(['variant' => 'content', 'hoverable' => true]); ?>
                <strong>Hoverable</strong>
                <p class="ds-card-demo-note">Lifts on hover. Only use when the card actually does something.</p>
            <?php ws_card_end(); ?>

            <?php ws_card_start(['variant' => 'content', 'elevated' => true]); ?>
                <strong>Elevated</strong>
                <p class="ds-card-demo-note">Pre-raised with a shadow, no border.</p>
            <?php ws_card_end(); ?>

            <?php ws_card_start(['variant' => 'content', 'bordered' => true]); ?>
                <strong>Bordered</strong>
                <p class="ds-card-demo-note">Heavier border for emphasis.</p>
            <?php ws_card_end(); ?>
        </div>
        <div class="ds-code"><pre>&lt;?php ws_card_start(['variant' => 'content', 'hoverable' => true]); ?&gt;
    Hoverable card...
&lt;?php ws_card_end(); ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>Surface fill, 1px border, standard radius. No interaction affordance.</td></tr>
            <tr><td>Hover</td><td>Only with <code>hoverable</code>: <code>cursor: pointer</code>, a translate lift, and a shadow step over <code>--transition-base</code>.</td></tr>
            <tr><td>Focus</td><td>Only when <code>href</code> is set &mdash; the card becomes an <code>&lt;a&gt;</code> and gets the native focus ring. A <code>hoverable</code> <code>&lt;div&gt;</code> has <strong>no</strong> focus state, which is why a click handler on a plain card is a bug.</td></tr>
            <tr><td>Elevated</td><td>Static <code>--shadow-md</code>, escalating to <code>--shadow-lg</code> when also hoverable.</td></tr>
            <tr><td>Disabled</td><td>Not supported. There's no disabled treatment &mdash; omit the card, or render it without the link.</td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">warning</span>
        <span><code>hoverable</code> changes the cursor to a pointer. If nothing happens on click, that's a false affordance &mdash; use it only alongside <code>href</code> or a genuine action.</span>
    </div>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Library listing grid</h3>
        <p class="ds-section-desc">The exercises listing composes a card from icon, title, duration badge, description, category badge, and row actions. Category colours come from the database per record: that's data, not decoration, which is why they aren't tokens. It records how the library page was built before <code class="ds-code-inline">ws_text</code>: do not copy its page-local <code class="ds-code-inline">listing-card-*</code> classes. A library record is <code class="ds-code-inline">ws_listing_card</code>; any other item card follows the filtered-workshop-list recipe, with its title from <code class="ds-code-inline">ws_text</code>.</p>
        <div class="ds-grid-3">
            <?php
            $demoCards = [
                ['icon' => 'lightbulb',  'color' => '#F59E0B', 'title' => 'Crazy 8s Sketching',  'dur' => '30 min', 'cat' => 'Ideation',  'desc' => 'Rapid sketching exercise where participants fold paper into 8 panels and sketch one idea per panel in one minute each.'],
                ['icon' => 'groups',     'color' => '#10B981', 'title' => 'Stakeholder Mapping', 'dur' => '45 min', 'cat' => 'Research',  'desc' => 'Identify and map key stakeholders by influence and interest to align engagement strategies throughout the project.'],
                ['icon' => 'psychology', 'color' => '#6366F1', 'title' => 'Affinity Mapping',    'dur' => '60 min', 'cat' => 'Analysis',  'desc' => 'Organize research findings and ideas into meaningful clusters to reveal themes and patterns across qualitative data.'],
            ];
            foreach ($demoCards as $c):
                ws_card_start(['variant' => 'content', 'hoverable' => true, 'class' => 'listing-card-demo']); ?>
                <div class="listing-card-header">
                    <div class="listing-card-icon" style="background: <?= $c['color'] ?>1A; color: <?= $c['color'] ?>;">
                        <?= icon($c['icon'], 'icon') ?>
                    </div>
                    <div>
                        <h3 class="listing-card-title"><?= $c['title'] ?></h3>
                        <div class="listing-card-meta"><?= ws_duration($c['dur']) ?></div>
                    </div>
                </div>
                <p class="listing-card-description"><?= $c['desc'] ?></p>
                <div class="listing-card-footer">
                    <?= ws_category($c['cat'], $c['color']) ?>
                    <div class="listing-card-actions">
                        <button class="listing-card-action" aria-label="Favourite <?= $c['title'] ?>"><?= icon('favorite_border', 'icon') ?></button>
                        <button class="listing-card-action" aria-label="Share <?= $c['title'] ?>"><?= icon('share', 'icon') ?></button>
                    </div>
                </div>
            <?php ws_card_end();
            endforeach; ?>
        </div>
        <div class="ds-code"><pre>&lt;?php ws_card_start(['variant' => 'content', 'hoverable' => true, 'href' => $url]); ?&gt;
    &lt;div class="listing-card-header"&gt;
        &lt;div class="listing-card-icon" style="background: &lt;?= $cat['color'] ?&gt;1A;"&gt;
            &lt;?= icon($cat['icon'], 'icon') ?&gt;
        &lt;/div&gt;
        &lt;div&gt;
            &lt;h3 class="listing-card-title"&gt;&lt;?= $ex['name'] ?&gt;&lt;/h3&gt;
            &lt;div class="listing-card-meta"&gt;&lt;?= ws_duration($ex['duration'] . ' min') ?&gt;&lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;p class="listing-card-description"&gt;&lt;?= $ex['overview'] ?&gt;&lt;/p&gt;
    &lt;div class="listing-card-footer"&gt;
        &lt;?= ws_category($cat['name'], $cat['color']) ?&gt;
    &lt;/div&gt;
&lt;?php ws_card_end(); ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Flush with header, body, and footer</h3>
        <p class="ds-section-desc">The slot API is only reachable by including the template directly &mdash; <code class="ds-code-inline">ws_card_start()</code> doesn't accept <code class="ds-code-inline">header</code>, <code class="ds-code-inline">slot</code>, or <code class="ds-code-inline">footer</code>. Use it when the card needs internal dividers.</p>
        <div style="max-width: 400px;">
            <?php
            $card = [
                'variant' => 'flush',
                'header' => '<div style="display: flex; align-items: center; gap: 10px;"><span class="material-symbols-outlined" style="color: var(--brand);">auto_awesome</span><strong>Session Summary</strong></div>',
                'slot' => '<p class="ds-card-demo-note" style="margin: 0;">Your design sprint covered 5 exercises across 3 hours with 8 participants. Overall engagement was high.</p>',
                'footer' => '<div style="display: flex; gap: 8px;">' . ws_button('View Report', ['variant' => 'primary', 'size' => 'sm']) . ws_button('Dismiss', ['variant' => 'ghost', 'size' => 'sm']) . '</div>',
            ];
            include __DIR__ . '/../../../includes/components/card.php';
            ?>
        </div>
        <div class="ds-code"><pre>$card = [
    'variant' => 'flush',
    'header'  => '&lt;strong&gt;Session Summary&lt;/strong&gt;',
    'slot'    => '&lt;p&gt;Body content...&lt;/p&gt;',
    'footer'  => ws_button('View Report', ['variant' => 'primary', 'size' => 'sm']),
];
include 'includes/components/card.php';</pre></div>
    </div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <p class="ds-section-desc">There are two APIs. <code class="ds-code-inline">ws_card_start()</code> / <code class="ds-code-inline">ws_card_end()</code> wrap arbitrary markup; <code class="ds-code-inline">ws_card($content, $options)</code> is the same thing for a string. Including the template directly unlocks the slot options in the second table.</p>

    <h3 class="ds-subsection-title">Helper options</h3>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>variant</code></td><td>string</td><td><code>'content'</code></td><td><code>content</code> | <code>feature</code> | <code>compact</code> | <code>flush</code></td></tr>
            <tr><td><code>hoverable</code></td><td>bool</td><td><code>false</code></td><td>Pointer cursor and hover lift</td></tr>
            <tr><td><code>elevated</code></td><td>bool</td><td><code>false</code></td><td>Static shadow, no border</td></tr>
            <tr><td><code>bordered</code></td><td>bool</td><td><code>false</code></td><td>Heavier border</td></tr>
            <tr><td><code>href</code></td><td>string</td><td><code>null</code></td><td>Renders an <code>&lt;a&gt;</code> instead of a <code>&lt;div&gt;</code>. The accessible way to make a card clickable.</td></tr>
            <tr><td><code>tag</code></td><td>string</td><td><code>div</code> (or <code>a</code> with <code>href</code>)</td><td>Override the wrapper element</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>null</code></td><td>Element ID</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra HTML attributes as key/value pairs</td></tr>
        </tbody>
    </table>

    <h3 class="ds-subsection-title">Template-only options</h3>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>header</code></td><td>string</td><td><code>null</code></td><td>Top section HTML, rendered into <code>.ws-card__header</code></td></tr>
            <tr><td><code>slot</code></td><td>string</td><td><code>''</code></td><td>Body HTML, rendered into <code>.ws-card__body</code></td></tr>
            <tr><td><code>footer</code></td><td>string</td><td><code>null</code></td><td>Bottom section HTML, rendered into <code>.ws-card__footer</code></td></tr>
            <tr><td><code>data</code></td><td>array</td><td><code>[]</code></td><td><code>['id' => '123']</code> becomes <code>data-id="123"</code></td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">warning</span>
        <span>All three slots render as raw HTML. Escape any user-supplied content before it goes in.</span>
    </div>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Semantics</td><td>A card is a plain <code>&lt;div&gt;</code> with no role &mdash; correct, because it's a visual grouping. The meaning comes from the heading inside it.</td></tr>
            <tr><td>Clickable cards</td><td><strong>The one thing to get right.</strong> Use <code>href</code> so the card renders as an <code>&lt;a&gt;</code>: focusable, keyboard-activatable, and announced as a link. A JS click handler on a <code>hoverable</code> <code>&lt;div&gt;</code> is invisible to keyboard and screen-reader users.</td></tr>
            <tr><td>Nested actions</td><td>Buttons inside a linked card create nested interactive elements, which is invalid and traps clicks. Either make the card a link with no inner buttons, or keep the card inert and let the inner controls act.</td></tr>
            <tr><td>Link or button</td><td>A card whose only action is opening it is one link: pass <code>href</code> (with <code>hoverable</code>) and put no button inside. A card that carries, or will carry, a second action (a menu, duplicate, delete, favourite) stays inert, with a button per action whose name includes the item: visible text "Open", <code>aria-label</code> "Open Sprint retrospective", the visible word first so voice control still finds it. A person's own workshops are the second kind, since <code>ws_workshop_list</code>'s cards carry a menu, which is why the filtered-workshop-list recipe keeps its cards inert with an Open button.</td></tr>
            <tr><td>Headings</td><td>Give each card a real heading at the right level for the page outline: <code>ws_text($title, ['variant' =&gt; 'title'])</code>, an <code>&lt;h3&gt;</code> under the section's <code>&lt;h2&gt;</code> (its <code>tag</code> option moves it). A bare <code>&lt;h3&gt;</code> is unstyled in a card, and a grid of cards whose titles are <code>&lt;div&gt;</code>s is unnavigable by heading.</td></tr>
            <tr><td>Icon-only actions</td><td>Row action buttons need <code>aria-label</code> &mdash; and it should name the item, not just the verb: "Favourite Crazy 8s", not "Favourite". A grid of identical "Share" buttons is useless out of context.</td></tr>
            <tr><td>Contrast</td><td>The border against the surface is deliberately low-contrast because it's decorative. Don't rely on it alone to separate cards &mdash; spacing does that work.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--card-bg</code></td><td>Surface fill</td></tr>
            <tr><td><code>--card-border</code></td><td>Border colour</td></tr>
            <tr><td><code>--card-radius</code></td><td>Corner radius</td></tr>
            <tr><td><code>--shadow-md</code></td><td>Elevated variant, and the hover lift</td></tr>
            <tr><td><code>--shadow-lg</code></td><td>Hover on an already-elevated card</td></tr>
            <tr><td><code>--gray-100</code></td><td>Internal dividers between the flush slots</td></tr>
            <tr><td><code>--transition-base</code></td><td>Hover lift and shadow transition</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-card</code></td><td>Base surface, border, and radius</td></tr>
            <tr><td><code>.ws-card--content</code></td><td>Standard padding</td></tr>
            <tr><td><code>.ws-card--feature</code></td><td>Larger padding</td></tr>
            <tr><td><code>.ws-card--compact</code></td><td>Tighter padding</td></tr>
            <tr><td><code>.ws-card--flush</code></td><td>No padding &mdash; for the slot API</td></tr>
            <tr><td><code>.ws-card--hoverable</code></td><td>Pointer cursor and hover lift</td></tr>
            <tr><td><code>.ws-card--elevated</code></td><td>Static shadow, border removed</td></tr>
            <tr><td><code>.ws-card--bordered</code></td><td>Heavier border</td></tr>
            <tr><td><code>.ws-card__header</code></td><td>Header slot</td></tr>
            <tr><td><code>.ws-card__body</code></td><td>Body slot</td></tr>
            <tr><td><code>.ws-card__footer</code></td><td>Footer slot</td></tr>
        </tbody>
    </table>
    <p class="ds-section-desc">The listing pattern layers its own classes on top &mdash; <code class="ds-code-inline">.listing-card-header</code>, <code class="ds-code-inline">-icon</code>, <code class="ds-code-inline">-title</code>, <code class="ds-code-inline">-meta</code>, <code class="ds-code-inline">-description</code>, <code class="ds-code-inline">-footer</code> &mdash; defined in <code class="ds-code-inline">css/listing-redesign.css</code>, not in the component library.</p>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_card_start()</code>, <code>ws_card_end()</code>, <code>ws_card()</code> &mdash; note these build markup inline rather than including the template</td></tr>
            <tr><td><code>includes/components/card.php</code></td><td>Template with the header/body/footer slots</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-card</code> rules)</td></tr>
            <tr><td><code>includes/partials/listing-card.php</code></td><td>The composed listing card used by the library pages</td></tr>
            <tr><td><code>css/listing-redesign.css</code></td><td><code>.listing-card</code> styles</td></tr>
        </tbody>
    </table>
</section>

<style>
/* Demo-only styles. Tokens, not literals — per templates/README.md. */
.ds-card-demo-note {
    font-size: var(--text-small, 14px);
    color: var(--text-muted, #78716C);
    line-height: 1.6;
    margin-top: 8px;
}
.listing-card-demo .listing-card-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
}
.listing-card-demo .listing-card-icon {
    width: 40px;
    height: 40px;
    border-radius: var(--radius-lg, 8px);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.listing-card-demo .listing-card-icon .icon { font-size: 20px; }
.listing-card-demo .listing-card-title {
    font-size: var(--text-ui, 15px);
    font-weight: 600;
    color: var(--text-dark, #1C1917);
    margin: 0;
}
.listing-card-demo .listing-card-meta {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 2px;
}
.listing-card-demo .listing-card-description {
    font-size: var(--text-small, 14px);
    color: var(--text-muted, #57534E);
    line-height: 1.5;
    margin: 0 0 12px 0;
}
.listing-card-demo .listing-card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 12px;
    border-top: 1px solid var(--gray-100, #F5F5F4);
}
.listing-card-demo .listing-card-actions { display: flex; gap: 4px; }
.listing-card-demo .listing-card-action {
    background: none;
    border: none;
    padding: 6px;
    border-radius: var(--radius-md, 6px);
    cursor: pointer;
    color: var(--gray-400, #A8A29E);
    transition: all var(--transition-fast, 150ms ease);
}
.listing-card-demo .listing-card-action:hover {
    background: var(--gray-100, #F5F5F4);
    color: var(--gray-600, #57534E);
}
.listing-card-demo .listing-card-action .icon { font-size: 18px; }
</style>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
