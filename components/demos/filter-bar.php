<?php
$ds_page  = 'components/demos/filter-bar';
$ds_title = 'Filter Bar';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Filter Bar</h1>
    <p>The controls above a listing grid: a search box, dropdown filters, and chips for what's currently applied.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            A listing needs GET-based search or filtering, with or without filters: exercise lists, workshop catalogues, saved-plan tables, a search box above "Your workshops". It standardises controls that were previously rebuilt per page. Its "Clear all" link beside the chips is the one clear control DESIGN.md 11.6 allows: it loads the unfiltered list, and Back undoes it. On a page routed by its query string, pass <code>keep</code> with the names that route it (inside <code>/app/</code>, <code>['view', 'step']</code>), and give the no-match empty state's "Show all workshops" the same address: <code>'?' . http_build_query(array_intersect_key($_GET, array_flip(['view', 'step'])))</code>. Put a one-line count under the bar with <code>ws_text</code>'s <code>caption</code> variant ("Showing 3 of 12 workshops for “retro”") and leave focus where the reload puts it.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The search field belongs to a form about something else, or sits in the site header rather than above a list &mdash; use <a href="<?= $ds_base ?>/components/demos/input.php">Input</a> with <code>type: 'search'</code>. For client-side switching between a few fixed sets, <a href="<?= $ds_base ?>/components/demos/tabs.php">Tabs</a> is lighter.
        </div>
    </div>
</section>

<div class="ds-note" style="margin-bottom: 32px;">
    <span class="material-symbols-outlined">check_circle</span>
    <span><strong>Fixed July 2026.</strong> Chip remove buttons call <code>wsFilterBarRemove(name)</code>, which the template referenced but nothing defined &mdash; every chip threw <em>ReferenceError: wsFilterBarRemove is not defined</em>. It now ships in <code>components.js</code>: it drops that parameter from the query string, resets <code>page</code>, and reloads, preserving all other filters and the hash. No consumer code required.</span>
</div>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Search and filters</h3>
        <p class="ds-section-desc">The common case. Filters render through <a href="<?= $ds_base ?>/components/demos/select.php">Select</a> internally, so they inherit its styling and focus treatment.</p>
        <div class="ds-card">
            <?= ws_filter_bar([
                ['name' => 'category_id', 'label' => 'Category', 'options' => [1 => 'Design Sprints', 2 => 'Icebreakers', 3 => 'Retrospectives'], 'value' => 1],
                ['name' => 'duration', 'label' => 'Duration', 'options' => ['short' => 'Under 30 min', 'medium' => '30&ndash;60 min', 'long' => 'Over 1 hour']],
            ], [
                'search' => ['placeholder' => 'Search activities…', 'value' => ''],
                'color' => 'learn',
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_filter_bar([
    ['name' => 'category_id', 'label' => 'Category',
     'options' => [1 => 'Design Sprints', 2 => 'Icebreakers'], 'value' => 1],
    ['name' => 'duration', 'label' => 'Duration',
     'options' => ['short' => 'Under 30 min', 'long' => 'Over 1 hour']],
], [
    'search' => ['placeholder' => 'Search activities…'],
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Search only</h3>
        <p class="ds-section-desc">The search box above a list, with no filters: pass an empty filters array. The submit button reads "Search" rather than "Filter", and <code>showSearchLabel</code> puts the field's name above it as a visible label, which a placeholder is not.</p>
        <div class="ds-card">
            <?= ws_filter_bar([], [
                'search' => ['placeholder' => 'e.g. retrospective', 'name' => 'q'],
                'searchLabel' => 'Search your workshops by name',
                'showSearchLabel' => true,
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_filter_bar([], [
    'search' =&gt; ['placeholder' =&gt; 'e.g. retrospective', 'value' =&gt; $q, 'name' =&gt; 'q'],
    'searchLabel' =&gt; 'Search your workshops by name',
    'showSearchLabel' =&gt; true,
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With active chips</h3>
        <p class="ds-section-desc">Chips summarise what's applied, with a "Clear all" alongside. Each remove button names its filter, here "Remove Design Sprints filter".</p>
        <div class="ds-card">
            <?= ws_filter_bar([
                ['name' => 'category_id', 'label' => 'Category', 'options' => [1 => 'Design Sprints', 2 => 'Icebreakers'], 'value' => 1],
            ], [
                'search' => ['placeholder' => 'Search activities…'],
                'activeChips' => [['label' => 'Design Sprints', 'name' => 'category_id', 'value' => 1]],
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_filter_bar($filters, [
    'activeChips' => [['label' => 'Design Sprints', 'name' => 'category_id', 'value' => 1]],
]) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>A GET form. Submitting puts search and filter values in the query string, so filtered views are linkable and survive a reload.</td></tr>
            <tr><td>Filter selected</td><td>Pass the filter's current <code>value</code> so the dropdown reflects the query string on redisplay.</td></tr>
            <tr><td>Focus</td><td>Search and selects use the shared <code>--focus-ring-width</code> / <code>--focus-ring-offset</code> geometry.</td></tr>
            <tr><td>Chips shown</td><td>Rendered whenever <code>activeChips</code> is non-empty, with a "Clear all" link: the one clear control DESIGN.md 11.6 allows, because it loads the unfiltered list and Back undoes it. Building the chip array is yours &mdash; the component doesn't derive it from the filters.</td></tr>
            <tr><td>Chip removal</td><td>Handled by <code>wsFilterBarRemove()</code> in <code>components.js</code>: drops that one parameter, resets <code>page</code>, keeps the rest of the query string and the hash, then reloads.</td></tr>
            <tr><td>Empty results</td><td>Not handled here. Pair the bar with <a href="<?= $ds_base ?>/components/demos/empty-state.php">Empty State</a> below the grid.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The exercises listing. Chips are derived from the query string, and the missing remove function is supplied locally &mdash; it drops one parameter and reloads, which is all it needs to do.</p>
    <div class="ds-code"><pre>&lt;?php
$chips = [];
if (!empty($_GET['category_id'])) {
    $chips[] = ['label' =&gt; $categoryNames[$_GET['category_id']],
                'name'  =&gt; 'category_id',
                'value' =&gt; $_GET['category_id']];
}
if (!empty($_GET['duration'])) {
    $chips[] = ['label' =&gt; $durationLabels[$_GET['duration']],
                'name'  =&gt; 'duration',
                'value' =&gt; $_GET['duration']];
}
?&gt;
&lt;?= ws_filter_bar($filters, [
    'search'      => ['placeholder' => 'Search activities…', 'value' => $_GET['q'] ?? ''],
    'activeChips' => $chips,
]) ?&gt;

&lt;!-- Chip removal needs no wiring — wsFilterBarRemove() ships in components.js --&gt;

&lt;?php if (!$results): ?&gt;
    &lt;?= ws_empty_state('No activities match those filters', [
        'description' => 'Drop a filter, or search for one word from the name.',
        'icon' => 'filter_alt_off', 'action' => 'Show all activities', 'actionHref' => '?',
        'actionVariant' => 'secondary',
    ]) ?&gt;
&lt;?php endif; ?&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>

    <h3 class="ds-subsection-title">Bar options</h3>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>$filters</code></td><td>array</td><td><code>[]</code></td><td>Positional. Dropdown configs; may be empty for search-only.</td></tr>
            <tr><td><code>search</code></td><td>array</td><td><code>null</code></td><td><code>['placeholder' =&gt; …, 'value' =&gt; …, 'name' =&gt; 'q']</code>. Omit for filters only.</td></tr>
            <tr><td><code>searchLabel</code></td><td>string</td><td>the placeholder</td><td>The search input's accessible name (its <code>aria-label</code>). Defaults to the placeholder less any trailing ellipsis, or "Search". Set it when the placeholder is an example rather than a description.</td></tr>
            <tr><td><code>showSearchLabel</code></td><td>bool</td><td><code>false</code></td><td>Shows <code>searchLabel</code> as a visible <code>&lt;label&gt;</code> above the field; the row then lines up on the inputs.</td></tr>
            <tr><td><code>submitLabel</code></td><td>string</td><td><code>'Search'</code> or <code>'Filter'</code></td><td>The submit button's text: "Search" with no filters, "Filter" with them.</td></tr>
            <tr><td><code>keep</code></td><td>array</td><td><code>[]</code></td><td>Query-string names the search and "Clear all" carry through, as hidden fields: inside <code>/app/</code>, <code>['view', 'step']</code>, or a search sends the person back to Home. Inside a tab panel of a <code>ws_tabs</code> with a <code>param</code>, the panel's own tab is carried too, without listing it.</td></tr>
            <tr><td><code>activeChips</code></td><td>array</td><td><code>[]</code></td><td><code>[['label' =&gt; …, 'name' =&gt; …, 'value' =&gt; …]]</code>. You build this from the query string.</td></tr>
            <tr><td><code>color</code></td><td>string</td><td><code>'learn'</code></td><td><code>learn</code> | <code>plan</code> | <code>facilitate</code> | <code>reflect</code>. <code>learn</code>, the default, has no rule of its own: it is the base look, and since the Red Unification the other three render the same.</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes on the container</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra HTML attributes on the container</td></tr>
        </tbody>
    </table>

    <h3 class="ds-subsection-title">Filter options</h3>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>name</code></td><td>string</td><td><code>''</code></td><td>Query-string parameter name</td></tr>
            <tr><td><code>label</code></td><td>string</td><td><code>''</code></td><td>The select's accessible name (its <code>aria-label</code>) and the text of its empty "any" option</td></tr>
            <tr><td><code>options</code></td><td>array</td><td><code>[]</code></td><td>Flat <code>value =&gt; label</code> pairs, as <code>ws_select()</code> takes</td></tr>
            <tr><td><code>value</code></td><td>string</td><td><code>''</code></td><td>Currently selected value</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Semantics</td><td>A real GET <code>&lt;form&gt;</code> with native inputs, so filtered views are linkable and the back button behaves.</td></tr>
            <tr><td>Names</td><td>Every control is named without changing the look. Each select's <code>aria-label</code> is its filter <code>label</code>; the search input's is <code>searchLabel</code>, or the placeholder. They are <code>aria-label</code> rather than a hidden <code>&lt;label for&gt;</code> because a select's id defaults to its field name, and two bars with the same filter on one page would point both labels at the first select. A placeholder alone is not a name: it disappears as soon as someone types.</td></tr>
            <tr><td>Visible label</td><td>Set <code>showSearchLabel</code> when the brief asks for visible labels, when the placeholder is an example ("e.g. retrospective") rather than a description, or when no heading directly above says what the field searches. Without it, the placeholder stands in for the label, so it must describe the field ("Search your workshops"). With it, the <code>&lt;label&gt;</code> wraps the field and its <code>aria-hidden</code> icon: the computed name is <code>searchLabel</code> alone, though a tool reading <code>textContent</code> also shows the icon's ligature word. Check names in the accessibility tree, not in <code>textContent</code>.</td></tr>
            <tr><td>Search landmark</td><td>With a search field the form is <code>role="search"</code>, named like the field, so a screen reader can jump straight to it. The landmark and the field sharing one name is intended: the landmark list and the field both say what is searched. Two bars on one page need different <code>searchLabel</code>s, or the landmark list shows two entries with the same name.</td></tr>
            <tr><td>Keyboard</td><td>Native throughout: <kbd>Tab</kbd> across search and selects, <kbd>Enter</kbd> in the search field submits.</td></tr>
            <tr><td>Chip remove buttons</td><td>Each names its filter, <code>aria-label="Remove Design Sprints filter"</code>, so a row of chips does not announce the same words for every button.</td></tr>
            <tr><td>Announcing results</td><td>Submitting loads a new page, and a new page is read from the top, so nothing is announced by itself: the count has to be on the page. Put one visible line between the bar and the results, <code>ws_text($count, ['variant' =&gt; 'caption'])</code>, in every state ("12 workshops", "Showing 3 of 12 workshops for “retro”"), worded so it does not repeat the empty state's title. Its <code>live</code> option adds nothing after a reload; set it only when a script changes the count without one.</td></tr>
            <tr><td>Focus after reload</td><td>Leave focus where the reload puts it, at the top of the page. Do not move it to the results on load: the field and its button come before them, so the next <kbd>Tab</kbd> would skip both, and a screen reader starts reading mid-page with no warning. The search landmark and the count line just below it are how a screen-reader user gets back to the results.</td></tr>
            <tr><td>Search icon</td><td>Decorative and <code>aria-hidden</code>, so the icon's ligature text is not read. The field's own name carries the meaning.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--bg-surface</code></td><td>Bar and search-field background</td></tr>
            <tr><td><code>--color-border</code></td><td>Bar and field borders</td></tr>
            <tr><td><code>--color-ink</code> / <code>--color-ink-muted</code></td><td>Field text and the chips label</td></tr>
            <tr><td><code>--brand</code> / <code>--phase-facilitate</code> / <code>--phase-reflect</code>, with <code>--phase-plan-light</code> / <code>--phase-facilitate-light</code> / <code>--phase-reflect-light</code></td><td>Colour-key accents (all red since Red Unification)</td></tr>
            <tr><td><code>--focus-ring-width</code> / <code>--focus-ring-offset</code></td><td>Focus geometry on search and selects</td></tr>
            <tr><td><code>--radius-lg</code></td><td>Bar and field corners</td></tr>
            <tr><td><code>--space-2</code> / <code>--space-3</code> / <code>--space-4</code> / <code>--space-6</code></td><td>Control spacing and the chips row</td></tr>
            <tr><td><code>--text-caption</code> / <code>--text-ui</code></td><td>Chip and control type scale</td></tr>
            <tr><td><code>--font-body</code> / <code>--font-medium</code></td><td>Face and weight</td></tr>
            <tr><td><code>--transition-fast</code></td><td>Hover and focus transitions</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-filter-bar</code></td><td>The form container</td></tr>
            <tr><td><code>.ws-filter-bar--plan / --facilitate / --reflect</code></td><td>Colour keys. <code>--learn</code>, the default, is emitted by the template but has no rule: it is the base look.</td></tr>
            <tr><td><code>.ws-filter-bar__controls</code></td><td>Search and selects row</td></tr>
            <tr><td><code>.ws-filter-bar__search</code> / <code>__search-input</code> / <code>__search-icon</code></td><td>Search field and its icon</td></tr>
            <tr><td><code>.ws-filter-bar__selects</code></td><td>Dropdown group</td></tr>
            <tr><td><code>.ws-filter-bar__submit</code></td><td>Submit button</td></tr>
            <tr><td><code>.ws-filter-bar__chips</code> / <code>__chips-label</code></td><td>Active-chip row and its label</td></tr>
            <tr><td><code>.ws-filter-bar__clear-all</code></td><td>"Clear all" link</td></tr>
            <tr><td><code>.ws-filter-chip</code></td><td>An individual chip. Carries <code>data-filter-name</code> and <code>data-filter-value</code>.</td></tr>
            <tr><td><code>.ws-filter-chip__clear</code></td><td>Chip remove button; calls <code>wsFilterBarRemove()</code></td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_filter_bar()</code> helper function</td></tr>
            <tr><td><code>includes/components/filter-bar.php</code></td><td>Template &mdash; form, search, chips. Renders <code>ws_select()</code> for each filter.</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-filter-bar</code> and <code>.ws-filter-chip</code> rules)</td></tr>
            <tr><td><code>includes/components/components.js</code></td><td><code>wsFilterBarRemove()</code> &mdash; chip removal</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
