<?php
$ds_page  = 'components/demos/choice-card';
$ds_title = 'Choice Card';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Choice Card</h1>
    <p>One way into a task, offered beside the others. An icon, a name, a sentence of what you get, and a foot saying what it costs you and what happens next.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            The reader has to pick a route before anything happens, and the routes differ in effort as much as in outcome. Plan's home, the planner home and the builder's empty canvas all open the same three paths this way.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            You are listing things rather than offering routes. A saved workshop, an exercise, a collection: those are <code>ws_listing_card</code>. A choice card promises that clicking it starts something.
        </div>
    </div>
</section>

<!-- 3. The row -->
<section class="ds-section">
    <h2 class="ds-section-title">The row</h2>
    <p class="ds-section-desc">Three is the working width. At most one card is <code>featured</code>, and it carries the badge that says why.</p>
    <div class="ds-card">
        <?= ws_choice_cards([
            [
                'icon'     => 'auto_awesome',
                'badge'    => 'Recommended',
                'featured' => true,
                'title'    => 'Generate with AI',
                'desc'     => 'Describe the outcome you need. You get a full agenda to edit.',
                'time'     => '~30 seconds',
                'cta'      => 'Generate',
                'href'     => '#',
            ],
            [
                'icon'  => 'dashboard_customize',
                'title' => 'Build it yourself',
                'desc'  => 'Start from an empty canvas and pull in exercises as you go.',
                'time'  => 'Your pace',
                'cta'   => 'Open the builder',
                'href'  => '#',
            ],
            [
                'icon'  => 'fact_check',
                'title' => 'Check an agenda',
                'desc'  => 'Paste one you already have and see where it will sag.',
                'time'  => '~2 minutes',
                'cta'   => 'Run the check',
                'href'  => '#',
            ],
        ]) ?>
    </div>
</section>

<!-- 4. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Two columns</h3>
        <p class="ds-section-desc">Pass <code>columns</code> when there are only two routes, so the pair fills the width instead of leaving a hole.</p>
        <div class="ds-card">
            <?= ws_choice_cards([
                [
                    'icon'  => 'note_add',
                    'title' => 'Start from raw material',
                    'desc'  => 'Notes, transcript, photos, or a board export.',
                    'cta'   => 'Add material',
                    'href'  => '#',
                ],
                [
                    'icon'  => 'history',
                    'title' => 'Use a workshop you ran',
                    'desc'  => 'Everything captured on the day, already in order.',
                    'cta'   => 'Pick a workshop',
                    'href'  => '#',
                ],
            ], ['columns' => 2]) ?>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Buttons, not links</h3>
        <p class="ds-section-desc">Leave <code>href</code> off and the card renders as a real <code>&lt;button&gt;</code>. Use that when the choice opens something on the page rather than navigating.</p>
        <div class="ds-card">
            <?= ws_choice_cards([
                [
                    'icon'  => 'auto_awesome',
                    'title' => 'Generate with AI',
                    'desc'  => 'Opens the generator over the canvas.',
                    'cta'   => 'Generate',
                    'attrs' => ['data-demo-open' => 'generator'],
                ],
                [
                    'icon'  => 'library_add',
                    'title' => 'Browse the library',
                    'desc'  => 'Opens the exercise rail beside the agenda.',
                    'cta'   => 'Browse',
                    'attrs' => ['data-demo-open' => 'library'],
                ],
            ], ['columns' => 2]) ?>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Bare</h3>
        <p class="ds-section-desc">Everything but the title and sentence is optional. Drop the time when the route has no honest estimate: an invented number is worse than none.</p>
        <div class="ds-card">
            <?= ws_choice_cards([
                ['icon' => 'edit_note', 'title' => 'Write it out', 'desc' => 'A blank page and the outcome you are after.', 'href' => '#'],
                ['icon' => 'upload_file', 'title' => 'Import one', 'desc' => 'Bring an agenda over from somewhere else.', 'href' => '#'],
                ['icon' => 'explore', 'title' => 'Look around first', 'desc' => 'See what other facilitators run for this.', 'href' => '#'],
            ]) ?>
        </div>
    </div>
</section>

<!-- 5. Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Usage</h2>
    <pre class="ds-code"><code>&lt;?= ws_choice_cards([
    [
        'icon'     =&gt; 'auto_awesome',
        'badge'    =&gt; 'Recommended',
        'featured' =&gt; true,
        'title'    =&gt; 'Generate with AI',
        'desc'     =&gt; 'Describe the outcome you need. You get a full agenda to edit.',
        'time'     =&gt; '~30 seconds',
        'cta'      =&gt; 'Generate',
        'href'     =&gt; '/app/?view=plan&amp;step=build',
    ],
    // …
]) ?&gt;</code></pre>

    <p class="ds-section-desc">Geometry comes from <code>--card-padding</code> and <code>--card-radius</code>, the same tokens every other card on the platform reads, so the family moves together. <code>check-drift.php</code> Check 4 fails any card rule that sets padding or radius with a literal instead.</p>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Say what the route costs.</strong>
            "~30 seconds" against "Your pace" is the difference the reader is actually choosing on. The titles rarely carry it.
        </div>
        <div class="ds-dont">
            <strong>Don't feature more than one.</strong>
            The featured card is the recommendation. Two recommendations is no recommendation, and the row goes back to being a menu.
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
