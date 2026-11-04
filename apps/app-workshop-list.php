<?php
/**
 * Workshop listing — pattern demo and tweaking surface.
 *
 * The component lives in app/includes/workshop-list.php. This page renders it
 * with the Figma frames' own sample content so the pattern can be compared
 * against the design and adjusted without touching Plan, Facilitate or
 * Synthesize (and without needing to be signed in).
 */

require_once dirname(__DIR__, 2) . '/includes/bootstrap.php';
require_once ws_path('app/includes/workshop-list.php');

$ds_page  = 'apps/app-workshop-list';
$ds_title = 'Workshop Listing Pattern';
require_once __DIR__ . '/../includes/ds-header.php';

/* The eight workshops from the Figma "Recent workshops" frames, carrying the
   timeline frame's scheduling data on the rows that have it. One array feeds
   all four views — that is the point of the component.

   The two rows with no items carry no duration either: the real query sums
   plan_items.duration, so an empty agenda always sums to zero and prints
   nothing. A demo row with a duration and no items would tune the pattern
   against a card that cannot exist. */
$sample = array_map('ws_workshop_list_normalize', [
    [
        'id' => 1, 'name' => 'make a decision we keep postponing', 'stage' => 'plan',
        'duration' => null, 'items' => 0, 'updated_label' => '2 weeks ago', 'tag' => 'Decision',
        'group' => 'scheduled', 'date' => ['dow' => 'Mon', 'day' => '17'],
        'time' => '10:00', 'location' => 'Remote · Zoom',
    ],
    [
        'id' => 2, 'name' => 'Innovation Spark for Engineers', 'stage' => 'facilitate',
        'duration' => '2h', 'items' => 6, 'updated_label' => '5/13/2026', 'tag' => 'Innovation',
        'group' => 'recent', 'time' => '14:00', 'location' => 'Studio A', 'icon' => 'groups',
    ],
    [
        'id' => 3, 'name' => 'Igniting Innovation for Engineers', 'stage' => 'facilitate',
        'duration' => '2h', 'items' => 8, 'updated_label' => '5/13/2026', 'tag' => 'Innovation',
        'group' => 'recent', 'time' => '11:00', 'location' => 'Studio B', 'icon' => 'groups',
    ],
    [
        'id' => 4, 'name' => 'User Journey Mapping Essentials', 'stage' => 'synthesize',
        'duration' => '2h', 'items' => 6, 'updated_label' => '4/27/2026', 'tag' => 'Research',
        'group' => 'recent', 'time' => '09:30', 'location' => 'Studio A', 'icon' => 'lightbulb',
    ],
    [
        'id' => 5, 'name' => 'Untitled Workshop', 'stage' => 'strategize',
        'duration' => '1h 45m', 'items' => 2, 'updated_label' => '5/11/2026', 'tag' => 'Misc',
        'group' => 'drafts', 'location' => 'TBD', 'icon' => 'edit_note',
    ],
    [
        'id' => 6, 'name' => 'Retrospective: Q2 Product Sprint', 'stage' => 'synthesize',
        'duration' => '1h 30m', 'items' => 10, 'updated_label' => '5/9/2026', 'tag' => 'Retro',
        'group' => 'recent', 'time' => '16:00', 'location' => 'Remote · Zoom', 'icon' => 'lightbulb',
    ],
    [
        'id' => 7, 'name' => 'Design Principles Alignment', 'stage' => 'facilitate',
        'duration' => '3h', 'items' => 12, 'updated_label' => '5/7/2026', 'tag' => 'Design',
        'group' => 'scheduled', 'date' => ['dow' => 'Tue', 'day' => '18'],
        'time' => '10:00', 'location' => 'Studio A',
    ],
    [
        'id' => 8, 'name' => 'Quarterly Goals Workshop', 'stage' => 'strategize',
        'duration' => null, 'items' => 0, 'updated_label' => '5/3/2026', 'tag' => 'Strategy',
        'group' => 'drafts', 'location' => 'TBD', 'icon' => 'edit_note',
    ],
]);
?>

<?php /* The docs column caps at 860px, which is narrower than the /app/ content
         column this pattern actually lives in (~1131px) — at 860 the grid loses
         its third card and the kanban columns squeeze. Widened here so what you
         are tweaking is what ships. */ ?>
<style>
    .ds-main { max-width: 1360px; }
    .wl-demo-stage {
        background: var(--bg-paper, #FAF7F2);
        border: 1px solid var(--gray-200, #E7E5E4);
        border-radius: var(--radius-xl, 12px);
        padding: var(--space-8, 32px);
    }
</style>

<div class="ds-page-header">
    <h1>Workshop Listing</h1>
    <p>One listing, four views. This is the shared pattern behind Plan's <em>Recent workshop agendas</em>, Facilitate's <em>Choose a Workshop</em> and Synthesize's <em>Ready to synthesize</em> — the same workshop record seen from three points in the journey, so it renders from one component instead of three hand-cut card templates.</p>
    <p><strong>Component:</strong> <code>app/includes/workshop-list.php</code> · <strong>Styles:</strong> <code>app/css/workshop-list.css</code> · <strong>Behaviour:</strong> <code>app/js/workshop-list-views.js</code> + <code>app/js/workshop-list-pages.js</code></p>
</div>

<section class="ds-section">
    <h2 class="ds-section-title">The full pattern</h2>
    <p>Every view is server-rendered; the switcher toggles which one is visible, and the stage chips filter rows already in the page. Both are instant and cost no fetch. The chosen view is remembered per listing.</p>

    <div class="wl-demo-stage">
        <?= ws_workshop_list([
            'id'        => 'wlDemo',
            'eyebrow'   => 'Workshop library',
            'title'     => 'Recent workshops',
            'subtitle'  => '8 workshops across 4 stages',
            'workshops' => $sample,
            'cta'       => ['label' => 'Continue', 'href' => '/app/?view=plan&step=build&plan={id}'],
            'footer'    => ['label' => 'All workshops', 'href' => '/app/?view=plan&step=saved'],
        ]) ?>
    </div>
</section>

<section class="ds-section">
    <h2 class="ds-section-title">How each page configures it</h2>
    <p>The three pages differ only in their copy, which workshops they pass, and where the action goes. Each is pinned to the grid view here to make the comparison readable; drop <code>'views'</code> to offer the full switcher.</p>

    <h3 style="margin-top: 32px;">Plan — the Plan chip opens pressed</h3>
    <div class="wl-demo-stage">
        <?= ws_workshop_list([
            'id'        => 'wlPlan',
            'title'     => 'Recent workshop agendas',
            'views'     => ['grid'],
            'filter'    => 'plan',
            'workshops' => $sample,
            'cta'       => ['label' => 'Continue', 'href' => '/app/?view=plan&step=build&plan={id}'],
            'footer'    => ['label' => 'All workshops', 'href' => '/app/?view=plan&step=saved'],
            'empty'     => 'No workshops yet — start a new one above.',
        ]) ?>
    </div>

    <h3 style="margin-top: 32px;">Facilitate — the Facilitate chip opens pressed</h3>
    <div class="wl-demo-stage">
        <?= ws_workshop_list([
            'id'        => 'wlFacilitate',
            'title'     => 'Choose a workshop',
            'subtitle'  => 'Select a saved workshop to start facilitating.',
            'views'     => ['grid'],
            'filter'    => 'facilitate',
            'workshops' => $sample,
            'cta'       => ['label' => 'Start', 'href' => '/app/?view=facilitate&step=run&plan={id}'],
            'footer'    => ['label' => 'All workshops', 'href' => '/app/?view=plan&step=saved'],
            'empty'     => 'No workshops yet. Plan one first.',
        ]) ?>
    </div>

    <h3 style="margin-top: 32px;">Synthesize — the Synthesize chip opens pressed</h3>
    <div class="wl-demo-stage">
        <?= ws_workshop_list([
            'id'        => 'wlSynthesize',
            'title'     => 'Ready to synthesize',
            'views'     => ['grid'],
            'filter'    => 'synthesize',
            'workshops' => $sample,
            'cta'       => ['label' => 'Synthesize', 'href' => '/app/?view=synthesize&step=make&plan={id}'],
            'empty'     => 'No workshops waiting on a recap.',
        ]) ?>
    </div>
</section>

<section class="ds-section">
    <h2 class="ds-section-title">Chips and pages together</h2>
    <p>With <code>pageSize</code> set, the pager windows the rows the active chip leaves visible — never the whole collection. Fourteen rows here, six to a page, opening on the Plan chip: nine plan rows page in two; switch to <em>All</em> and fourteen page in three; switch to <em>Synthesize</em> and its two rows show no pager at all. Changing the chip always re-pages from page one. On a paged listing, <code>workshop-list-pages.js</code> is the sole writer of row visibility and the chips report the active stage to it — that single ownership is what keeps a row from going missing between the two systems. Kanban and timeline are whole-collection layouts and never paginate.</p>

    <?php
    /* Fourteen rows, deliberately lopsided across stages so every pager state
       above is reachable from the chips. Static, like everything on this
       page — it must render signed out. */
    $pagedSample = array_map('ws_workshop_list_normalize', array_map(
        fn($n) => [
            'id'            => 100 + $n,
            'name'          => 'Workshop ' . str_pad((string) $n, 2, '0', STR_PAD_LEFT)
                             . ' · ' . ($n <= 9 ? 'agenda in progress' : ($n <= 12 ? 'ready to run' : 'awaiting recap')),
            'stage'         => $n <= 9 ? 'plan' : ($n <= 12 ? 'facilitate' : 'synthesize'),
            'duration'      => '2h', 'items' => $n, 'updated_label' => 'May 2026',
        ],
        range(1, 14)
    ));
    ?>
    <div class="wl-demo-stage">
        <?= ws_workshop_list([
            'id'        => 'wlPaged',
            'title'     => 'Fourteen workshops, six to a page',
            'views'     => ['grid', 'list'],
            'filter'    => 'plan',
            'pageSize'  => 6,
            'workshops' => $pagedSample,
            'cta'       => ['label' => 'Continue', 'href' => '/app/?view=plan&step=build&plan={id}'],
        ]) ?>
    </div>
</section>

<section class="ds-section">
    <h2 class="ds-section-title">Empty state</h2>
    <div class="wl-demo-stage">
        <?= ws_workshop_list([
            'id'        => 'wlEmpty',
            'title'     => 'Ready to synthesize',
            'workshops' => [],
            'empty'     => 'No workshops waiting on a recap.',
        ]) ?>
    </div>
</section>

<section class="ds-section">
    <h2 class="ds-section-title">Usage</h2>
    <pre class="ds-code"><code>require_once ws_path('app/includes/workshop-list.php');

echo ws_workshop_list([
    'title'     =&gt; 'Recent workshop agendas',
    'workshops' =&gt; array_map('ws_workshop_list_normalize', $rows),
    'cta'       =&gt; ['label' =&gt; 'Continue', 'href' =&gt; '/app/?view=plan&amp;step=build&amp;plan={id}'],
    'footer'    =&gt; ['label' =&gt; 'All workshops', 'href' =&gt; '/app/?view=plan&amp;step=saved'],
    'views'     =&gt; ['grid', 'list', 'kanban', 'timeline'],  // omit for all four
    'chips'     =&gt; true,     // draw the stage filter chips; default true
    'filter'    =&gt; 'plan',   // the stage lens; default 'all'
    'pageSize'  =&gt; 12,       // pages grid + list over the active chip's rows
]);</code></pre>

    <p><code>filter</code> names the listing's stage lens: <code>'all'</code> or a stage key, and a value outside the listing's own <code>stages</code> scope falls back to <code>'all'</code>. With <code>chips =&gt; true</code> it is the chip that opens pressed, and first-paint row visibility matches it. With <code>chips =&gt; false</code> it is the listing's whole subject: the rows are cut to that stage server-side and nothing can widen them, which is what a phase page wants. Plan, Facilitate, Synthesize and Prove each list the work they are owed, head it with a count, and close with a link back to Home; Home keeps the chips and the whole collection. <code>pageSize</code> pages the grid and list views client-side over the rows the active chip leaves visible: changing the chip re-pages from page one, and a chip with <code>pageSize</code> rows or fewer shows no pager.</p>

    <p><code>ws_workshop_list_normalize()</code> accepts a <code>/api/plans.php</code> row merged with <code>stage</code> and <code>stage_complete</code> from <code>/api/workshop-record.php</code>. The stage is the phase a workshop currently <em>owes work in</em>, derived server-side by <code>wrDeriveStage()</code> from the agenda size, the Strategist handoff and the delivery and synthesis stamps — never stored. Rows may also carry <code>tag</code> (kanban chip) and <code>group</code>/<code>date</code>/<code>time</code>/<code>location</code> (timeline).</p>
    <p>The retired three-value <code>lifecycle_status</code> (<code>designed</code>, <code>delivered</code>, <code>synthesized</code>) is still accepted as an input but is no longer emitted: it could not tell a pre-planned workshop from an untouched one, which is the distinction the four phases exist to draw.</p>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
