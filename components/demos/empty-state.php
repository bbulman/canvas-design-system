<?php
$ds_page  = 'components/demos/empty-state';
$ds_title = 'Empty State';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Empty State</h1>
    <p>Explains why a region is blank and gives the reader the one action that fills it.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            A list, grid, or panel legitimately has nothing in it: no saved workshops yet, no search results, no notifications. Say why it's empty and what to do next. For a search with no match, the title repeats what they typed ("No workshops match “retro”"), the description gives the next try ("Check the spelling, or search for one word from the name."), and the action is the way back, named for where it goes: "Show all workshops", <code>secondary</code>, linking to the list's own address without the search (DESIGN.md 11.6 and 13). Never "Clear" or "Reset".
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The data is still loading &mdash; use <a href="<?= $ds_base ?>/components/demos/skeleton.php">Skeleton</a>, or the reader will think their content is gone. For a failed request use <a href="<?= $ds_base ?>/components/demos/alert.php">Alert</a> with the <code>error</code> variant; "empty" and "broken" are different messages.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>
    <p class="ds-section-desc">There's one layout. What varies is how much of it you fill in &mdash; build up from title only to the full title, description, and action.</p>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Title only</h3>
        <p class="ds-section-desc">The minimum. Acceptable when the surrounding context already explains the emptiness.</p>
        <div class="ds-card">
            <?= ws_empty_state('No workshops found') ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_empty_state('No workshops found') ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With a description</h3>
        <p class="ds-section-desc">Use the description to name the cause, not to apologise.</p>
        <div class="ds-card">
            <?= ws_empty_state('No workshops found', [
                'description' => 'Try adjusting your search or filters to find what you are looking for.',
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_empty_state('No workshops found', [
    'description' => 'Try adjusting your search or filters.',
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With an action</h3>
        <p class="ds-section-desc">The strongest form, and the one to reach for by default. One action only &mdash; the empty state's job is to remove the dead end.</p>
        <div class="ds-card">
            <?= ws_empty_state('No workshops found', [
                'description' => 'Try adjusting your search, or browse the full library.',
                'icon' => 'search_off',
                'action' => 'Browse All Workshops',
                'actionHref' => '#',
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_empty_state('No workshops found', [
    'icon'       => 'search_off',
    'action'     => 'Browse All Workshops',
    'actionHref' => '/library/workshops/',
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Icons</h3>
        <p class="ds-section-desc">The default is <code class="ds-code-inline">inbox</code>. Pick an icon that matches the specific emptiness &mdash; <code class="ds-code-inline">search_off</code> for no results reads very differently from <code class="ds-code-inline">event_busy</code> for nothing scheduled.</p>
        <div class="ds-card">
            <div class="ds-grid-3">
                <?= ws_empty_state('No saved items', [
                    'icon' => 'bookmark_border',
                    'description' => 'Save workshops for quick access.',
                ]) ?>
                <?= ws_empty_state('No notifications', [
                    'icon' => 'notifications_off',
                    'description' => 'You are all caught up.',
                ]) ?>
                <?= ws_empty_state('No sessions yet', [
                    'icon' => 'event_busy',
                    'description' => 'Start your first session.',
                    'action' => 'Get Started',
                    'actionHref' => '#',
                ]) ?>
            </div>
        </div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>Centred icon, title, optional description, optional action. Static &mdash; the component itself has no interactive state.</td></tr>
            <tr><td>Action hover / focus</td><td>Owned by <a href="<?= $ds_base ?>/components/demos/button.php">Button</a>, which the action renders through. Its variant is controlled by <code>actionVariant</code>.</td></tr>
            <tr><td>Action without <code>actionHref</code></td><td>Passing <code>action</code> alone still renders a button, but with no destination. Always set both.</td></tr>
            <tr><td>Accent theming</td><td>The component reads <code>--ws-empty-accent</code>, <code>--ws-empty-accent-bg</code>, and <code>--ws-empty-accent-light</code>. Set them on an ancestor to tint the icon per app; they fall back to the brand red.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">Two different empties on the same screen. A first-run user has never created anything; a filtering user has created plenty but matched none. Same component, deliberately different copy and action.</p>
    <div class="ds-grid-2">
        <div class="ds-card">
            <?= ws_empty_state('No workshops yet', [
                'icon' => 'add_circle',
                'description' => 'Build your first agenda in the Planner &mdash; it takes about five minutes.',
                'action' => 'Create a workshop',
                'actionHref' => '#',
            ]) ?>
        </div>
        <div class="ds-card">
            <?= ws_empty_state('Nothing matches those filters', [
                'icon' => 'filter_alt_off',
                'description' => 'You have 24 workshops, but none in this category.',
                'action' => 'Show all workshops',
                'actionHref' => '#',
                'actionVariant' => 'secondary',
            ]) ?>
        </div>
    </div>
    <div class="ds-code"><pre>&lt;?php if (!$hasAnyWorkshops): ?&gt;
    &lt;?= ws_empty_state('No workshops yet', [
        'icon'       => 'add_circle',
        'description'=> 'Build your first agenda in the Planner.',
        'action'     => 'Create a workshop',
        'actionHref' => '/planner/',
    ]) ?&gt;
&lt;?php elseif (!$filtered): ?&gt;
    &lt;?= ws_empty_state('Nothing matches those filters', [
        'icon'          => 'filter_alt_off',
        'description'   => "You have {$total} workshops, but none in this category.",
        'action'        => 'Show all workshops',
        'actionHref'    => '?',
        'actionVariant' => 'secondary',
    ]) ?&gt;
&lt;?php endif; ?&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>$title</code></td><td>string</td><td>required</td><td>Positional heading. State the fact plainly: "No workshops yet".</td></tr>
            <tr><td><code>description</code></td><td>string</td><td><code>null</code></td><td>One sentence on why it's empty and what to do</td></tr>
            <tr><td><code>icon</code></td><td>string</td><td><code>'inbox'</code></td><td>Material icon name</td></tr>
            <tr><td><code>action</code></td><td>string</td><td><code>null</code></td><td>Button label. Lead with a verb.</td></tr>
            <tr><td><code>actionHref</code></td><td>string</td><td><code>null</code></td><td>Button destination. Set it whenever you set <code>action</code>.</td></tr>
            <tr><td><code>actionVariant</code></td><td>string</td><td><code>'primary'</code></td><td>Any Button variant. Use <code>secondary</code> when the empty state isn't the page's main event.</td></tr>
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
            <tr><td>ARIA</td><td>None applied &mdash; the title and description are ordinary text read in document order, which is the right behaviour for content that's present at page load.</td></tr>
            <tr><td>Keyboard</td><td>Only the action is focusable, and it inherits Button's native behaviour.</td></tr>
            <tr><td>Heading</td><td>The title is always an <code>&lt;h3&gt;</code>, with no option to change it. Put the empty state under the section's <code>&lt;h2&gt;</code>, where the results' own card titles would also be <code>&lt;h3&gt;</code>.</td></tr>
            <tr><td>Announcing a change</td><td>It depends on how the results changed. After a search or filter that reloads the page (<code>ws_filter_bar</code> does), the new page is read in order, so show the count as a visible <code>ws_text</code> caption line above the results and the empty state needs nothing more. Only when a script swaps results in place without a reload is the swap silent: then give that count line <code>live</code>, so "0 workshops" is announced.</td></tr>
            <tr><td>Icon</td><td>Decorative and unlabelled. The title carries the meaning, so never rely on the icon to distinguish "no results" from "no access".</td></tr>
            <tr><td>Contrast</td><td>Title uses <code>--text-dark</code> and description <code>--text-default</code>, both tested. The icon is deliberately low-contrast because it's decoration &mdash; don't promote it to the sole signal.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--ws-empty-accent</code> / <code>--ws-empty-accent-bg</code> / <code>--ws-empty-accent-light</code></td><td>Component-scoped accent trio for the icon. Override on an ancestor to theme per app.</td></tr>
            <tr><td><code>--brand</code> / <code>--brand-tint</code></td><td>Default accent values behind those variables</td></tr>
            <tr><td><code>--phase-facilitate</code> / <code>--phase-reflect</code></td><td>Phase-scoped accent overrides (all red since Red Unification)</td></tr>
            <tr><td><code>--text-dark</code> / <code>--ink</code></td><td>Title colour</td></tr>
            <tr><td><code>--text-default</code></td><td>Description colour</td></tr>
            <tr><td><code>--text-h3</code> / <code>--text-small</code></td><td>Title and description type scale</td></tr>
            <tr><td><code>--font-heading</code> / <code>--font-body</code> / <code>--font-semibold</code></td><td>Fraunces for the title, Inter for the description</td></tr>
            <tr><td><code>--space-2</code> / <code>--space-4</code> / <code>--space-5</code> / <code>--space-7</code> / <code>--space-14</code></td><td>Internal rhythm and the generous vertical padding</td></tr>
            <tr><td><code>--radius-lg</code></td><td>Icon container corners</td></tr>
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
            <tr><td><code>.ws-empty-state</code></td><td>Centred container with the vertical padding</td></tr>
            <tr><td><code>.ws-empty-state__icon</code></td><td>Accent-tinted icon holder</td></tr>
            <tr><td><code>.ws-empty-state__title</code></td><td>Heading</td></tr>
            <tr><td><code>.ws-empty-state__desc</code></td><td>Description paragraph</td></tr>
            <tr><td><code>.ws-empty-state__action</code></td><td>Action wrapper around the button</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_empty_state()</code> helper function</td></tr>
            <tr><td><code>includes/components/empty-state.php</code></td><td>Template &mdash; markup and the action button call</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles and the accent variables (<code>.ws-empty-state</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
