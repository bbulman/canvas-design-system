<?php
$ds_page  = 'components/demos/level-up-grid';
$ds_title = 'Level Up Grid';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Level Up Grid</h1>
    <p>Cross-promotes the rest of the Workshopr ecosystem, grouped by facilitation phase.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            A public landing page or long-form article ends and the reader might want the rest of the platform. Once per page, in the footer region, with <code>current_app</code> set so the page doesn't advertise itself.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The user is inside an authenticated product &mdash; they're already engaged, and a promo grid is a distraction. Never on a detail page competing with its own CTA, and never twice on one page.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Default</h3>
        <p class="ds-section-desc">The full catalogue of 12 apps in one grid. Every app carries its phase, applied per card.</p>
        <div class="ds-card ds-card--full-bleed">
            <?= ws_level_up_grid() ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_level_up_grid() ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Excluding the current app</h3>
        <p class="ds-section-desc">Set <code class="ds-code-inline">current_app</code> to drop the page's own app. Do this on every page that isn't the homepage.</p>
        <div class="ds-card ds-card--full-bleed">
            <?= ws_level_up_grid(['current_app' => 'intervention']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_level_up_grid(['current_app' => 'intervention']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Grouped by phase</h3>
        <p class="ds-section-desc"><code class="ds-code-inline">group_by_phase</code> splits the grid into four sub-sections, each with an italic phase title and a short intro in the Workshopr voice. Use it where you have room to explain the journey rather than just list tools.</p>
        <div class="ds-card ds-card--full-bleed">
            <?= ws_level_up_grid([
                'current_app'    => 'academy',
                'group_by_phase' => true,
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_level_up_grid([
    'current_app'    => 'academy',
    'group_by_phase' => true,
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Custom eyebrow and title</h3>
        <p class="ds-section-desc">Override the heading when the default framing doesn't fit the page's argument.</p>
        <div class="ds-card ds-card--full-bleed">
            <?= ws_level_up_grid([
                'current_app' => 'planner',
                'eyebrow'     => 'The full toolkit',
                'title'       => 'Everything else Workshopr can do',
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_level_up_grid([
    'current_app' => 'planner',
    'eyebrow'     => 'The full toolkit',
    'title'       => 'Everything else Workshopr can do',
]) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>Every card is a link to its app, with icon, title, and one-line description.</td></tr>
            <tr><td>Hover</td><td>Card lifts and its phase accent strengthens.</td></tr>
            <tr><td>Focus</td><td>Native focus ring &mdash; each card is a real anchor.</td></tr>
            <tr><td>Excluded app</td><td><code>current_app</code> removes that card entirely; the grid reflows to 11.</td></tr>
            <tr><td>Grouped</td><td>Four sub-sections, each with a phase heading, intro prose, and a 3- or 4-up grid. A phase whose only app was excluded still renders its heading.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The standard landing-page footer: the grid, then the CTA. <code class="ds-code-inline">ws_footer()</code> already composes both, so on pages using it you don't call this component directly.</p>
    <div class="ds-code"><pre>&lt;!-- On a standalone landing page --&gt;
&lt;?= ws_level_up_grid(['current_app' => 'dna']) ?&gt;
&lt;?= ws_cta_section('Discover your Facilitator DNA', [
    'primaryBtn' => ['text' => 'Take the quiz', 'href' => '/dna/'],
]) ?&gt;

&lt;!-- On a page using the global footer, both are already included --&gt;
&lt;?= ws_footer() ?&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>current_app</code></td><td>string</td><td><code>null</code></td><td>App key to exclude &mdash; <code>library</code>, <code>planner</code>, <code>intervention</code>, and so on</td></tr>
            <tr><td><code>eyebrow</code></td><td>string</td><td><code>'More from Workshopr'</code></td><td>Small label above the title</td></tr>
            <tr><td><code>title</code></td><td>string</td><td><code>'Level Up Your Facilitation'</code></td><td>Section heading</td></tr>
            <tr><td><code>group_by_phase</code></td><td>bool</td><td><code>false</code></td><td>Split into four phase sub-sections with intro prose. <strong>Not in the helper's docblock, but supported.</strong></td></tr>
            <tr><td><code>phase_copy</code></td><td>array</td><td>built-in</td><td>Override the per-phase intro prose. Merged recursively, so you can replace one phase and keep the rest. <strong>Also undocumented in the helper.</strong></td></tr>
            <tr><td><code>apps</code></td><td>array</td><td>built-in catalogue</td><td>Replace the app list entirely. Rarely needed &mdash; the built-in catalogue is the source of truth.</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>null</code></td><td>Section element ID</td></tr>
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
            <tr><td>Semantics</td><td>Each card is a real <code>&lt;a&gt;</code>, so the whole card is focusable and announced as a link. No custom click handling is involved.</td></tr>
            <tr><td>Keyboard</td><td>Standard link tabbing. With 12 cards this is a long run of tab stops at the end of the page &mdash; a reason to set <code>current_app</code> and to keep the grid to one instance.</td></tr>
            <tr><td>Link text</td><td>The accessible name is the card's title plus description, so each is distinct in a screen reader's link list.</td></tr>
            <tr><td>Phase colour</td><td>Decorative only. The phase is also named in the grouped variant's heading, so colour never carries it alone &mdash; which matters more than ever now that all four render the same red.</td></tr>
            <tr><td>Heading levels</td><td>The section title and phase headings are real headings, so the block is navigable. Check the levels suit where you place it.</td></tr>
            <tr><td>Repetition</td><td>Screen-reader users hit this grid on every landing page. Keeping it in a consistent position, always last, makes it easy to skip.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <p class="ds-section-desc">Each card reads its phase token. Since Red Unification all four resolve to the same red &mdash; the phase names remain as semantic grouping, not as distinct colours.</p>
    <table class="ds-table">
        <thead><tr><th>Phase</th><th>Token</th><th>Current value</th><th>Apps</th></tr></thead>
        <tbody>
            <tr><td>learn</td><td><code>--phase-learn</code></td><td><code>#E54D4D</code></td><td>library, academy, podcasts</td></tr>
            <tr><td>plan</td><td><code>--phase-plan</code></td><td><code>#E54D4D</code></td><td>planner, hybrid</td></tr>
            <tr><td>facilitate</td><td><code>--phase-facilitate</code></td><td><code>#E54D4D</code></td><td>facilitator, sidekick, intervention, tips</td></tr>
            <tr><td>reflect</td><td><code>--phase-reflect</code></td><td><code>#E54D4D</code></td><td>dna, coach, roi</td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">warning</span>
        <span><strong>Corrected July 2026.</strong> This table previously listed <code>#0284C7</code> (plan), <code>#7C4DFF</code> (facilitate), and <code>#10B981</code> (reflect) &mdash; the pre-unification colours. Those were retired; every phase token now resolves to Learn Red. Don't reintroduce them as literals or as <code>var()</code> fallbacks. See <a href="<?= $ds_base ?>/foundations/colors.php">Colors</a>.</span>
    </div>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-level-up</code></td><td>Section wrapper</td></tr>
            <tr><td><code>.ws-level-up__container</code></td><td>Max-width wrapper</td></tr>
            <tr><td><code>.ws-level-up__header</code></td><td>Eyebrow and title block</td></tr>
            <tr><td><code>.ws-level-up__eyebrow</code></td><td>Small label above the title</td></tr>
            <tr><td><code>.ws-level-up__grid</code></td><td>Card grid</td></tr>
            <tr><td><code>.ws-level-up__grid--3</code></td><td>Three-up grid, used in the grouped variant</td></tr>
            <tr><td><code>.ws-level-up__phase</code></td><td>Phase sub-section (grouped variant)</td></tr>
            <tr><td><code>.ws-level-up__phase--learn / --plan / --facilitate / --reflect</code></td><td>Phase accents</td></tr>
            <tr><td><code>.ws-level-up__card</code></td><td>An app card &mdash; an <code>&lt;a&gt;</code></td></tr>
            <tr><td><code>.ws-level-up__card--learn / --plan / --facilitate / --reflect</code></td><td>Per-card phase accent</td></tr>
            <tr><td><code>.ws-level-up__card-icon</code> / <code>-title</code> / <code>-desc</code> / <code>-link</code></td><td>Card internals</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_level_up_grid()</code> helper function</td></tr>
            <tr><td><code>includes/components/level-up-grid.php</code></td><td>Template &mdash; the app catalogue, phase copy, and grid markup</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-level-up</code> rules)</td></tr>
            <tr><td><code>includes/components/footer.php</code></td><td>Composes this grid into the global footer</td></tr>
        </tbody>
    </table>
    <p class="ds-section-desc">The app catalogue lives in the template. When an app is added or renamed, update it there &mdash; and keep it consistent with <code class="ds-code-inline">PRODUCT.md</code> §5 and the app switcher.</p>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
