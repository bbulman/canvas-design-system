<?php
$ds_page  = 'components/demos/hero';
$ds_title = 'Hero';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">
<link rel="stylesheet" href="<?= $site_base ?>/css/styles.css">

<div class="ds-page-header">
    <h1>Hero</h1>
    <p>Opens a page with its headline, its argument, and its primary action. Owns the page's <code class="ds-code-inline">&lt;h1&gt;</code>.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            At the top of a landing page, app homepage, or marketing page &mdash; once. It carries the value proposition and the primary call to action.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            You're on an interior or detail page &mdash; use <a href="<?= $ds_base ?>/components/demos/section-header.php">Section Header</a>, which renders <code>h2</code>/<code>h3</code>. Never place two heroes on one page: the component emits an <code>&lt;h1&gt;</code>, and two would break the outline.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Full</h3>
        <p class="ds-section-desc">Badge, title with accent, subtitle, actions, and stats. Two buttons at most &mdash; a primary and one lower-commitment alternative.</p>
        <div class="ds-demo-hero">
            <?= ws_hero('Facilitate better', 'workshops &amp; sprints.', [
                'badge' => 'Workshop Facilitation Platform',
                'badgeIcon' => 'view_kanban',
                'subtitle' => 'The all-in-one platform for planning, running, and reflecting on remote workshops.',
                'buttons' => [
                    ws_button('Browse Library', ['variant' => 'primary', 'icon' => 'explore', 'href' => '#']),
                    ws_button('Plan a Workshop', ['variant' => 'secondary', 'icon' => 'calendar_month', 'href' => '#']),
                ],
                'stats' => [
                    ['value' => '50+', 'label' => 'Workshops'],
                    ['value' => '120+', 'label' => 'Exercises'],
                    ['value' => '40+', 'label' => 'Icebreakers'],
                ],
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_hero('Facilitate better', 'workshops &amp; sprints.', [
    'badge'     => 'Workshop Facilitation Platform',
    'badgeIcon' => 'view_kanban',
    'subtitle'  => 'The all-in-one platform for planning, running, and reflecting on workshops.',
    'buttons'   => [
        ws_button('Browse Library',  ['variant' => 'primary',   'icon' => 'explore',
                                      'href' => '/library/workshops/']),
        ws_button('Plan a Workshop', ['variant' => 'secondary', 'icon' => 'calendar_month',
                                      'href' => '/planner/']),
    ],
    'stats'     => [
        ['value' => '50+',  'label' => 'Workshops'],
        ['value' => '120+', 'label' => 'Exercises'],
    ],
]) ?&gt;</pre></div>
        <div class="ds-note">
            <span class="material-symbols-outlined">info</span>
            <span><code>buttons</code> takes an array of <em>rendered HTML strings</em>, not option arrays &mdash; call <code>ws_button()</code> yourself and pass the results. That's unusual for this library, and passing option arrays here silently produces nothing.</span>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Title and accent</h3>
        <p class="ds-section-desc">The accent renders italic in the brand colour with an underline. Write the two parts as one sentence &mdash; the accent is the end of the phrase, not a subtitle.</p>
        <div class="ds-demo-hero">
            <?= ws_hero('Browse our curated', 'exercise library.', [
                'badge' => 'Exercise Library',
                'badgeIcon' => 'fitness_center',
                'subtitle' => 'Find the perfect activity for any workshop moment.',
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_hero('Browse our curated', 'exercise library.', [
    'badge'    => 'Exercise Library',
    'subtitle' => 'Find the perfect activity for any workshop moment.',
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Minimal</h3>
        <p class="ds-section-desc">Title, subtitle, one action. Pass an empty string for the accent when the headline stands alone.</p>
        <div class="ds-demo-hero">
            <?= ws_hero('Welcome to the Coach', '', [
                'subtitle' => 'Your AI-powered facilitation assistant for live workshop sessions.',
                'buttons' => [
                    ws_button('Start Session', ['variant' => 'primary', 'icon' => 'play_arrow', 'href' => '#']),
                ],
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_hero('Welcome to the Coach', '', [
    'subtitle' => 'Your AI-powered facilitation assistant.',
    'buttons'  => [ws_button('Start Session', ['variant' => 'primary', 'href' => '/coach/'])],
]) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>Static. The hero itself has no interactive state &mdash; hover and focus belong to the buttons inside it.</td></tr>
            <tr><td>Omitted parts</td><td>Badge, accent, subtitle, buttons, stats, and image each render only when supplied. No empty space is reserved.</td></tr>
            <tr><td>With an image</td><td>Setting <code>image</code> switches to a two-column layout with the visual beside the text. Without it the content spans the container.</td></tr>
            <tr><td>Responsive</td><td>The two-column layout collapses to stacked on narrow viewports; stats wrap.</td></tr>
            <tr><td>Background pattern</td><td>A decorative dot overlay is always rendered as <code>.hero-bg-pattern</code>. Not configurable.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The homepage hero, with library counts read live so the proof figures can't drift from the database, and the primary action switching on auth state.</p>
    <div class="ds-code"><pre>&lt;?php
$counts = getLibraryCounts();
?&gt;
&lt;?= ws_hero('Facilitate better', 'workshops &amp; sprints.', [
    'badge'     => 'Workshop Facilitation Platform',
    'badgeIcon' => 'view_kanban',
    'subtitle'  => 'Plan the agenda, run the room, and turn the notes into something worth sending.',
    'buttons'   => [
        $isLoggedIn
            ? ws_button('Open the Planner', ['variant' => 'primary', 'href' => '/planner/'])
            : ws_button('Start free',       ['variant' => 'primary', 'href' => '/signup']),
        ws_button('Browse the library', ['variant' => 'secondary', 'href' => '/library/']),
    ],
    'stats'     => [
        ['value' => $counts['exercises']   . '+', 'label' => 'Exercises'],
        ['value' => $counts['icebreakers'] . '+', 'label' => 'Icebreakers'],
        ['value' => $counts['workshops']   . '+', 'label' => 'Workshop templates'],
    ],
]) ?&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>$title</code></td><td>string</td><td>required</td><td>First positional. The headline, rendered inside the <code>&lt;h1&gt;</code>.</td></tr>
            <tr><td><code>$accent</code></td><td>string</td><td><code>''</code></td><td>Second positional. Italic brand-coloured continuation of the headline. Pass <code>''</code> to omit.</td></tr>
            <tr><td><code>badge</code></td><td>string</td><td><code>''</code></td><td>Small label above the heading</td></tr>
            <tr><td><code>badgeIcon</code></td><td>string</td><td><code>''</code></td><td>Material icon inside the badge</td></tr>
            <tr><td><code>subtitle</code></td><td>string</td><td><code>''</code></td><td>Supporting paragraph</td></tr>
            <tr><td><code>buttons</code></td><td>array</td><td><code>[]</code></td><td><strong>Rendered HTML strings</strong>, not option arrays. Use <code>ws_button()</code> to produce them.</td></tr>
            <tr><td><code>stats</code></td><td>array</td><td><code>[]</code></td><td><code>[['value' =&gt; …, 'label' =&gt; …]]</code>, same shape as <a href="<?= $ds_base ?>/components/demos/stat.php">Stat</a></td></tr>
            <tr><td><code>statColor</code></td><td>string</td><td><code>#E54D4D</code></td><td>Stat value colour. The default is the brand red as a literal &mdash; pass <code>var(--phase-learn)</code> to keep it token-driven.</td></tr>
            <tr><td><code>image</code></td><td>string</td><td><code>''</code></td><td>Hero visual URL. Switches to the two-column layout.</td></tr>
            <tr><td><code>imageAlt</code></td><td>string</td><td><code>''</code></td><td>Alt text. Set it whenever <code>image</code> is set &mdash; see Accessibility.</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>null</code></td><td>Element ID</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Heading</td><td>Renders a real <code>&lt;h1 class="hero-title"&gt;</code>. That's the page's single top-level heading &mdash; which is exactly why there can only be one hero per page.</td></tr>
            <tr><td>Accent</td><td>Sits inside the <code>&lt;h1&gt;</code>, so the announced heading is title plus accent as one phrase. Write them to read continuously.</td></tr>
            <tr><td>Keyboard</td><td>Only the buttons are focusable, and they're the first tab stops on the page. Their order should match their visual priority.</td></tr>
            <tr><td>Image alt</td><td><strong>Your responsibility.</strong> <code>imageAlt</code> defaults to an empty string, which marks the image decorative. That's correct for an abstract illustration, but wrong for a screenshot carrying information &mdash; describe it.</td></tr>
            <tr><td>Background pattern</td><td>Purely decorative and rendered as an empty <code>&lt;div&gt;</code>, so it contributes nothing to the accessibility tree. Correct as-is.</td></tr>
            <tr><td>Stats</td><td>Value and label are adjacent text, announced in order. A value like "50+" reads fine; avoid glyph-only values.</td></tr>
            <tr><td>Contrast</td><td>The hero sits on <code>--bg-warm</code> with brand-red accents. If you set a custom <code>statColor</code>, check it against that background.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <p class="ds-section-desc">Hero is the one component whose styles live in <code class="ds-code-inline">css/styles.css</code> rather than <code class="ds-code-inline">components.css</code>, so it draws on the main-site token set.</p>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--bg-warm</code></td><td>Hero background</td></tr>
            <tr><td><code>--gradient-primary</code></td><td>Accent underline and badge fill</td></tr>
            <tr><td><code>--mainsite-primary</code></td><td>Accent text and badge colour</td></tr>
            <tr><td><code>--phase-learn</code> / <code>--phase-learn-light</code></td><td>Brand accents</td></tr>
            <tr><td><code>--primary-red</code> / <code>-dark</code> / <code>-hover</code> / <code>-light</code></td><td>Legacy red aliases still referenced by the hero rules</td></tr>
            <tr><td><code>--radius-md</code> / <code>--radius-lg</code> / <code>--radius-xl</code></td><td>Badge, button, and image corners</td></tr>
            <tr><td><code>--shadow-lg</code></td><td>Hero visual elevation</td></tr>
            <tr><td><code>--space-1-5</code> through <code>--space-10</code></td><td>Vertical rhythm and stat spacing</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <p class="ds-section-desc">Hero does <strong>not</strong> use the <code class="ds-code-inline">.ws-</code> prefix &mdash; it emits main-site <code class="ds-code-inline">.hero-*</code> classes defined in <code class="ds-code-inline">css/styles.css</code>. A page rendering a hero must load that stylesheet as well as the component library.</p>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.hero</code></td><td>Outer wrapper</td></tr>
            <tr><td><code>.hero-bg-pattern</code></td><td>Decorative dot overlay</td></tr>
            <tr><td><code>.hero-container</code></td><td>Max-width flex container</td></tr>
            <tr><td><code>.hero-content</code></td><td>Text column</td></tr>
            <tr><td><code>.hero-badge</code></td><td>Icon and label above the heading</td></tr>
            <tr><td><code>.hero-title</code></td><td>The <code>&lt;h1&gt;</code></td></tr>
            <tr><td><code>.hero-title-accent</code></td><td>Italic accent inside the heading</td></tr>
            <tr><td><code>.hero-subtitle</code></td><td>Supporting paragraph</td></tr>
            <tr><td><code>.hero-actions</code></td><td>Button row</td></tr>
            <tr><td><code>.hero-stats</code> / <code>.hero-stat</code> / <code>.hero-stat-divider</code></td><td>Stat row, items, and dividers</td></tr>
            <tr><td><code>.hero-visual</code> / <code>.hero-image</code></td><td>Image column and the <code>&lt;img&gt;</code></td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_hero()</code> helper function</td></tr>
            <tr><td><code>includes/components/hero.php</code></td><td>Template &mdash; heading, badge, actions, stats, and visual</td></tr>
            <tr><td><code>css/styles.css</code></td><td>All hero styles (<code>.hero-*</code> rules). Not in <code>components.css</code>.</td></tr>
        </tbody>
    </table>
</section>

<style>
/* Scope the hero demos so their full-bleed styles don't fight the DS shell. */
.ds-demo-hero {
    position: relative;
    border-radius: var(--radius-xl, 12px);
    overflow: hidden;
    border: 1px solid var(--color-border, #e2e8f0);
    margin-bottom: 16px;
}
.ds-demo-hero .hero { border-radius: var(--radius-xl, 12px); }
.ds-demo-hero .hero-title { font-size: clamp(1.5rem, 3vw, 2rem); }
</style>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
