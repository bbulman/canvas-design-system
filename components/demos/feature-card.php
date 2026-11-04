<?php
$ds_page  = 'components/demos/feature-card';
$ds_title = 'Feature Card';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Feature Card</h1>
    <p>Icon, title, and one line of description &mdash; the unit a benefits grid is built from.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            You're presenting three to six parallel capabilities or benefits in a grid, each summarised in a sentence. The fixed icon-title-description shape is what makes the set scannable.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The items are content records rather than features &mdash; use <a href="<?= $ds_base ?>/components/demos/listing-card.php">Listing Card</a>. For an arbitrary container use <a href="<?= $ds_base ?>/components/demos/card.php">Card</a>, and for numbered sequences use <a href="<?= $ds_base ?>/components/demos/how-steps.php">How Steps</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Default</h3>
        <div class="ds-card">
            <div class="ds-grid-3">
                <?= ws_feature_card('Curated Library', 'Browse our collection of workshops, exercises, and icebreakers.', ['icon' => 'menu_book']) ?>
                <?= ws_feature_card('AI Facilitation Coach', 'Get real-time guidance powered by AI during your sessions.', ['icon' => 'psychology']) ?>
                <?= ws_feature_card('Workshop Planner', 'Drag and drop to build your perfect agenda.', ['icon' => 'calendar_month']) ?>
            </div>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_feature_card('Curated Library', 'Browse our collection…', [
    'icon' => 'menu_book',
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Compact</h3>
        <p class="ds-section-desc">Smaller icon and tighter padding, for grids inside app screens rather than full-width marketing sections.</p>
        <div class="ds-card">
            <div class="ds-grid-2">
                <?= ws_feature_card('Quick Setup', 'Get started in under 5 minutes.', ['icon' => 'bolt', 'variant' => 'compact']) ?>
                <?= ws_feature_card('Team Ready', 'Built for groups of any size.', ['icon' => 'group', 'variant' => 'compact']) ?>
            </div>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_feature_card('Quick Setup', 'Get started fast.', [
    'icon'    => 'bolt',
    'variant' => 'compact',
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Coming soon</h3>
        <p class="ds-section-desc">Dims the card to mark a feature as not yet available. Don't pass <code class="ds-code-inline">href</code> alongside it &mdash; a dimmed card that still navigates is worse than no card.</p>
        <div class="ds-card">
            <div class="ds-grid-3">
                <?= ws_feature_card('Custom Builder', 'Create your own workshops from scratch.', ['icon' => 'construction', 'variant' => 'coming-soon']) ?>
                <?= ws_feature_card('Analytics', 'Track session outcomes and engagement.', ['icon' => 'analytics', 'variant' => 'coming-soon']) ?>
                <?= ws_feature_card('Templates', 'Start from proven templates.', ['icon' => 'description', 'variant' => 'coming-soon']) ?>
            </div>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_feature_card('Custom Builder', 'Create your own workshops.', [
    'icon'    => 'construction',
    'variant' => 'coming-soon',
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">As links</h3>
        <p class="ds-section-desc">With <code class="ds-code-inline">href</code> the card renders as an <code class="ds-code-inline">&lt;a&gt;</code>, making the whole surface focusable and clickable &mdash; the accessible way to make a feature card actionable.</p>
        <div class="ds-card">
            <div class="ds-grid-3">
                <?= ws_feature_card('Workshops', 'Full-day and half-day formats.', ['icon' => 'groups', 'href' => '#']) ?>
                <?= ws_feature_card('Exercises', 'Targeted activities for any moment.', ['icon' => 'fitness_center', 'href' => '#']) ?>
                <?= ws_feature_card('Icebreakers', 'Quick energizers to kick things off.', ['icon' => 'ac_unit', 'href' => '#']) ?>
            </div>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_feature_card('Workshops', 'Full-day and half-day formats.', [
    'icon' => 'groups',
    'href' => '/library/workshops/',
]) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>Surface fill, bordered, with a tinted icon holder.</td></tr>
            <tr><td>Hover</td><td>Only meaningful on the link form: border and shadow step up over <code>--transition-base</code>.</td></tr>
            <tr><td>Focus</td><td>Native focus ring, present only when <code>href</code> makes the card an anchor. A non-link card has no focus state.</td></tr>
            <tr><td>Coming soon</td><td>Adds <code>.ws-feature-card--coming-soon</code>, which dims the card. Purely visual &mdash; it doesn't disable anything.</td></tr>
            <tr><td>Icon vs SVG</td><td><code>icon</code> renders a Material Symbol; <code>svg</code> injects raw markup instead. Passing both is redundant &mdash; pick one.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The homepage capability grid: three live features as links into the apps, one marked coming-soon and deliberately not linked.</p>
    <div class="ds-card">
        <div class="ds-grid-2">
            <?= ws_feature_card('Plan', 'Build an agenda that fits the room and the clock.', ['icon' => 'edit_note', 'href' => '#']) ?>
            <?= ws_feature_card('Facilitate', 'Run the session with timings and prompts at hand.', ['icon' => 'groups', 'href' => '#']) ?>
            <?= ws_feature_card('Reflect', 'Turn your notes into a readout worth sending.', ['icon' => 'hub', 'href' => '#']) ?>
            <?= ws_feature_card('Analytics', 'See how engagement moved across the session.', ['icon' => 'analytics', 'variant' => 'coming-soon']) ?>
        </div>
    </div>
    <div class="ds-code"><pre>&lt;?php foreach ($features as $f): ?&gt;
    &lt;?= ws_feature_card($f['title'], $f['description'], [
        'icon'    => $f['icon'],
        'href'    => $f['live'] ? $f['url'] : null,
        'variant' => $f['live'] ? 'default' : 'coming-soon',
    ]) ?&gt;
&lt;?php endforeach; ?&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>$title</code></td><td>string</td><td>required</td><td>Positional. The capability, in one or two words.</td></tr>
            <tr><td><code>$description</code></td><td>string</td><td>required</td><td>Positional. One sentence. Keep lengths even across a grid so the cards align.</td></tr>
            <tr><td><code>icon</code></td><td>string</td><td><code>null</code></td><td>Material icon name</td></tr>
            <tr><td><code>svg</code></td><td>string</td><td><code>null</code></td><td>Raw SVG markup, as an alternative to <code>icon</code></td></tr>
            <tr><td><code>variant</code></td><td>string</td><td><code>'default'</code></td><td><code>default</code> | <code>compact</code> | <code>coming-soon</code></td></tr>
            <tr><td><code>href</code></td><td>string</td><td><code>null</code></td><td>Renders the card as an <code>&lt;a&gt;</code></td></tr>
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
            <tr><td>Semantics</td><td>A <code>&lt;div&gt;</code> normally, an <code>&lt;a&gt;</code> with <code>href</code>. Use <code>href</code> rather than a JS click handler &mdash; it's the difference between a keyboard-reachable card and an invisible one.</td></tr>
            <tr><td>Title element</td><td>The title is styled text, not a heading element. That keeps the page outline clean but means a screen-reader user can't jump between cards by heading &mdash; introduce the grid with a <a href="<?= $ds_base ?>/components/demos/section-header.php">Section Header</a> so the set is findable.</td></tr>
            <tr><td>Link text</td><td>As a link, the accessible name is the title plus description &mdash; usually good. Avoid titles like "Learn more" that say nothing out of context.</td></tr>
            <tr><td>Coming soon</td><td><strong>Known gap:</strong> the state is conveyed by dimming alone. Nothing in the markup says "coming soon", so it's invisible to screen readers and easily missed at low contrast. Put the words in the description &mdash; "Coming soon &mdash; track engagement…".</td></tr>
            <tr><td>Icons</td><td>Decorative. The title always carries the meaning, so an icon-only card would have nothing to announce.</td></tr>
            <tr><td>Contrast</td><td>Title uses <code>--text-dark</code> and description <code>--text-muted</code>. The coming-soon variant reduces contrast further &mdash; don't stack extra opacity on top.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--bg-surface</code></td><td>Card background</td></tr>
            <tr><td><code>--gray-200</code> / <code>--gray-300</code></td><td>Border, resting and hover</td></tr>
            <tr><td><code>--brand</code> / <code>--brand-tint</code></td><td>Icon colour and its tinted holder</td></tr>
            <tr><td><code>--text-dark</code></td><td>Title</td></tr>
            <tr><td><code>--text-muted</code></td><td>Description</td></tr>
            <tr><td><code>--text-inverse</code></td><td>Icon on a solid fill</td></tr>
            <tr><td><code>--radius-xl</code></td><td>Card corners</td></tr>
            <tr><td><code>--shadow-lg</code></td><td>Hover elevation on the link form</td></tr>
            <tr><td><code>--text-ui</code> / <code>--text-body</code> / <code>--text-small</code> / <code>--text-meta</code></td><td>Type scale across variants</td></tr>
            <tr><td><code>--font-heading</code> / <code>--font-body</code> / <code>--font-semibold</code></td><td>Fraunces title, Inter description</td></tr>
            <tr><td><code>--transition-base</code></td><td>Hover transition</td></tr>
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
            <tr><td><code>.ws-feature-card</code></td><td>Base card, <code>&lt;div&gt;</code> or <code>&lt;a&gt;</code></td></tr>
            <tr><td><code>.ws-feature-card--compact</code></td><td>Reduced padding and icon size</td></tr>
            <tr><td><code>.ws-feature-card--coming-soon</code></td><td>Dimmed unavailable state</td></tr>
            <tr><td><code>.ws-feature-card__icon</code></td><td>Tinted icon holder</td></tr>
            <tr><td><code>.ws-feature-card__title</code></td><td>Title text</td></tr>
            <tr><td><code>.ws-feature-card__desc</code></td><td>Description text</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_feature_card()</code> helper function</td></tr>
            <tr><td><code>includes/components/feature-card.php</code></td><td>Template &mdash; tag selection and icon/SVG branch</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-feature-card</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
