<?php
$ds_page  = 'components/demos/stat';
$ds_title = 'Stat';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Stat</h1>
    <p>Puts a single number and its label at display size, so the figure lands before the explanation.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            A number is the point &mdash; hero proof figures, dashboard KPIs, a session's headline metrics. Use <code>ws_stats()</code> for a row of two to four related figures.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The number is incidental metadata on a card &mdash; that's <a href="<?= $ds_base ?>/components/demos/badge.php">Badge</a>. For a proportion of a whole use <a href="<?= $ds_base ?>/components/demos/progress.php">Progress</a>, and for more than four figures use a table.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Single stat</h3>
        <p class="ds-section-desc"><code class="ds-code-inline">ws_stat()</code> renders one figure. Value and label are both positional and both required.</p>
        <div class="ds-card" style="display: flex; gap: 32px; align-items: center;">
            <?= ws_stat('50+', 'Workshops') ?>
            <?= ws_stat('120+', 'Exercises', ['color' => 'var(--brand-ink)']) ?>
            <?= ws_stat('1,000+', 'Facilitators', ['icon' => 'groups']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_stat('50+', 'Workshops') ?&gt;
&lt;?= ws_stat('120+', 'Exercises', ['color' => 'var(--brand-ink)']) ?&gt;
&lt;?= ws_stat('1,000+', 'Facilitators', ['icon' => 'groups']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Stat group</h3>
        <p class="ds-section-desc"><code class="ds-code-inline">ws_stats()</code> lays out a row with dividers between items. It takes the same per-item keys as the single helper.</p>
        <div class="ds-card">
            <?= ws_stats([
                ['value' => '50+', 'label' => 'Workshops'],
                ['value' => '120+', 'label' => 'Exercises'],
                ['value' => '80+', 'label' => 'Icebreakers'],
                ['value' => '1,000+', 'label' => 'Facilitators'],
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_stats([
    ['value' => '50+',    'label' => 'Workshops'],
    ['value' => '120+',   'label' => 'Exercises'],
    ['value' => '80+',    'label' => 'Icebreakers'],
    ['value' => '1,000+', 'label' => 'Facilitators'],
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With colour</h3>
        <p class="ds-section-desc">Colour applies to the value only. Pass a token reference rather than a literal hex so the figures follow the palette.</p>
        <div class="ds-card">
            <?= ws_stats([
                ['value' => '50+', 'label' => 'Workshops', 'color' => 'var(--brand-ink)'],
                ['value' => '120+', 'label' => 'Exercises', 'color' => 'var(--brand-ink)'],
                ['value' => '80+', 'label' => 'Icebreakers', 'color' => 'var(--brand-ink)'],
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_stats([
    ['value' => '50+', 'label' => 'Workshops', 'color' => 'var(--brand-ink)'],
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With icons</h3>
        <p class="ds-section-desc">Apply icons to the whole row or to none of it &mdash; a partly-iconed group reads as broken.</p>
        <div class="ds-card">
            <?= ws_stats([
                ['value' => '50+', 'label' => 'Workshops', 'icon' => 'school'],
                ['value' => '120+', 'label' => 'Exercises', 'icon' => 'fitness_center'],
                ['value' => '80+', 'label' => 'Icebreakers', 'icon' => 'ac_unit'],
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_stats([
    ['value' => '50+', 'label' => 'Workshops', 'icon' => 'school'],
]) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>The only state. Stats are static text with no hover, focus, or interactive treatment.</td></tr>
            <tr><td>Zero</td><td>Renders "0" at full display size &mdash; visually as loud as a large number. When zero means "nothing yet", <a href="<?= $ds_base ?>/components/demos/empty-state.php">Empty State</a> communicates better.</td></tr>
            <tr><td>Long values</td><td>No truncation or auto-fitting. A long value widens the item and can unbalance a group, so pre-format big numbers ("1.2k", not "1,247").</td></tr>
            <tr><td>Single item in a group</td><td><code>ws_stats()</code> with one item renders without dividers &mdash; safe, but <code>ws_stat()</code> is the clearer call.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The hero proof row on a landing page: counts pulled live from the library so the marketing figures can't drift from the database.</p>
    <div class="ds-card">
        <?= ws_stats([
            ['value' => '120+', 'label' => 'Exercises', 'color' => 'var(--brand-ink)'],
            ['value' => '80+', 'label' => 'Icebreakers', 'color' => 'var(--brand-ink)'],
            ['value' => '50+', 'label' => 'Workshop templates', 'color' => 'var(--brand-ink)'],
        ]) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_stats([
    ['value' => $counts['exercises'] . '+',   'label' => 'Exercises'],
    ['value' => $counts['icebreakers'] . '+', 'label' => 'Icebreakers'],
    ['value' => $counts['workshops'] . '+',   'label' => 'Workshop templates'],
]) ?&gt;</pre></div>
    <p class="ds-section-desc"><a href="<?= $ds_base ?>/components/demos/hero.php">Hero</a> takes a <code class="ds-code-inline">stats</code> option in the same shape, so inside a hero you don't call this component directly.</p>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>

    <h3 class="ds-subsection-title">ws_stat()</h3>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>$value</code></td><td>string</td><td><code>''</code></td><td>Positional. The figure, pre-formatted &mdash; "50+", "1,000+", "98%".</td></tr>
            <tr><td><code>$label</code></td><td>string</td><td><code>''</code></td><td>Positional. What the figure counts. Plural nouns read best.</td></tr>
            <tr><td><code>color</code></td><td>string</td><td><code>null</code></td><td>Value colour. Accepts a hex or a CSS variable; prefer a token, <code>var(--brand-ink)</code> for red text.</td></tr>
            <tr><td><code>icon</code></td><td>string</td><td><code>null</code></td><td>Material icon above the value</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>null</code></td><td>Element ID</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
        </tbody>
    </table>

    <h3 class="ds-subsection-title">ws_stats()</h3>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>$stats</code></td><td>array</td><td>required</td><td>Positional array of items, each accepting <code>value</code>, <code>label</code>, <code>color</code>, and <code>icon</code></td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>null</code></td><td>Container ID</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes on the container</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>ARIA</td><td>None applied. Value and label are adjacent text read in order &mdash; "50 plus, Workshops" &mdash; which is the correct reading without any extra wiring.</td></tr>
            <tr><td>Reading order</td><td>The value comes before the label in the DOM as well as visually, so the announcement matches what's on screen.</td></tr>
            <tr><td>Keyboard</td><td>Not focusable. Stats are output, not controls.</td></tr>
            <tr><td>Abbreviations</td><td>A value like "1.2k" is read literally and may not be understood. Spell it out in the label when precision matters, or pass the full number.</td></tr>
            <tr><td>Not a heading</td><td>The value renders large but isn't a heading element, so it won't pollute the page outline &mdash; deliberate. Don't wrap it in one to get the size.</td></tr>
            <tr><td>Contrast</td><td>Values default to <code>--text-dark</code> and labels to <code>--text-muted</code>. A custom <code>color</code> bypasses that check &mdash; verify it against the surface.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--text-dark</code></td><td>Default value colour</td></tr>
            <tr><td><code>--text-muted</code></td><td>Label colour</td></tr>
            <tr><td><code>--gray-300</code></td><td>Divider between items in a group</td></tr>
            <tr><td><code>--text-h2</code> / <code>--text-h3</code></td><td>Value display size</td></tr>
            <tr><td><code>--text-caption</code></td><td>Label size</td></tr>
            <tr><td><code>--font-heading</code></td><td>Fraunces on the value</td></tr>
            <tr><td><code>--font-body</code> / <code>--font-bold</code></td><td>Inter on the label, and the value's weight</td></tr>
            <tr><td><code>--space-1</code> / <code>--space-4</code> / <code>--space-6</code></td><td>Value-to-label gap and the spacing between group items</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-stat</code></td><td>Single stat wrapper</td></tr>
            <tr><td><code>.ws-stat__value</code></td><td>The figure &mdash; display size, heading face</td></tr>
            <tr><td><code>.ws-stat__label</code></td><td>The caption beneath</td></tr>
            <tr><td><code>.ws-stat__icon</code></td><td>Optional icon above the value</td></tr>
            <tr><td><code>.ws-stats</code></td><td>Group container (flex row)</td></tr>
            <tr><td><code>.ws-stats__divider</code></td><td>Vertical rule between group items</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_stat()</code> and <code>ws_stats()</code> helper functions</td></tr>
            <tr><td><code>includes/components/stat.php</code></td><td>Single stat template</td></tr>
            <tr><td><code>includes/components/stats.php</code></td><td>Group template &mdash; loops items and inserts dividers</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-stat</code> and <code>.ws-stats</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
