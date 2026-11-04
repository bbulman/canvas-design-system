<?php
$ds_page  = 'redesign/dashboard';
$ds_title = 'Dashboard Patterns';

require_once __DIR__ . '/../../includes/icon.php';
require_once __DIR__ . '/../../includes/components/helpers.php';

require_once __DIR__ . '/../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/app/css/dashboard.css">

<style>
/* Demo scaffolding only. The stage supplies the paper the shell provides. */
.ds-dash-stage {
    padding: var(--space-6);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-lg);
    background-color: var(--bg-paper);
    background-image: var(--paper-grid-image);
    background-size: var(--paper-grid-size, 24px 24px);
}
.ds-dash-stage--narrow { max-width: 420px; }
</style>

<div class="ds-page-header">
    <h1>Dashboard Patterns</h1>
    <p>The vocabulary the shell&rsquo;s home dashboard (<code class="ds-code-inline">/app/</code>) is drawn with. These are <strong>candidate components</strong>: they live in <code>app/css/dashboard.css</code> under the <code>.dash__*</code> prefix, not yet in <code>components.css</code> as <code>ws_*</code> helpers. This page is the promotion ledger &mdash; a pattern that earns a second consumer graduates; one that stays dashboard-only stays here.</p>
</div>

<div class="ds-note">
    <span class="material-symbols-outlined">info</span>
    <span><strong>Why they are documented before they are components.</strong> CLAUDE.md &sect;11 says new UI becomes a <code>ws_*</code> component or uses one. The dashboard deliberately ran ahead of that rule while its patterns were still moving; registering them here is the decision that they are now design-system material rather than private CSS. Every colour was measured, not assumed: worst text contrast on the page is 5.30:1 (tinted pills), and the sizes are stated in px because the platform&rsquo;s 80% root font-size renders the rem type tokens a fifth small.</span>
</div>

<section class="ds-section">
    <h2>Quick action</h2>
    <p><strong>The <code>.dash__q</code> pill is retired.</strong> It was a tinted, borderless shortcut, deliberately quieter than the hero beneath it, and it held three actions. At two &mdash; New workshop and Run a session &mdash; they are the only ways into the day the page offers, which makes them its calls to action rather than shortcuts past it. So they are <code>ws_button</code> primary now, and the dashboard carries no bespoke button CSS at all. <code>.dash__quick</code> survives as the layout that lays them out.</p>
    <div class="ds-dash-stage">
        <div class="dash__quick" style="margin-left: 0;">
            <?= ws_button('New workshop', ['variant' => 'primary', 'icon' => 'add', 'href' => '#']) ?>
            <?= ws_button('Run a session', ['variant' => 'primary', 'icon' => 'play_arrow', 'href' => '#']) ?>
        </div>
    </div>
</section>

<section class="ds-section">
    <h2>Attention row</h2>
    <p>One stuck workshop per row: what it is, why it is stuck, and the single action that moves it on. The whole row is one link and the pill is decoration inside it &mdash; a nested anchor for the same destination would be a second tab stop going nowhere new.</p>
    <div class="ds-dash-stage">
        <div class="dash__list">
            <a class="dash__row" href="#">
                <?php /* The mark is the phase the workshop has reached, drawn with the
                         rail's icon for it — delivered, so Facilitate. */ ?>
                <span class="dash__thumb" aria-hidden="true"><span class="material-symbols-outlined">co_present</span></span>
                <span class="dash__row-body">
                    <span class="dash__row-title">Q3 Retro &middot; Meridian Labs</span>
                    <span class="dash__row-detail">Delivered 6 days ago &middot; 6 notes and 41 reactions waiting</span>
                </span>
                <span class="dash__cta">Open</span>
            </a>
            <a class="dash__row" href="#">
                <?php /* Designed but the agenda is empty, so it has got no further
                         than the case for it: Strategize. */ ?>
                <span class="dash__thumb" aria-hidden="true"><?= icon('knight') ?></span>
                <span class="dash__row-body">
                    <span class="dash__row-title">Onboarding Sprint Kickoff</span>
                    <span class="dash__row-detail">Designed yesterday &middot; the agenda is still empty</span>
                </span>
                <span class="dash__cta">Open</span>
            </a>
        </div>
    </div>
</section>

<section class="ds-section">
    <h2>Hero card</h2>
    <p>The one card on the page that is not white &mdash; it carries the single decision the dashboard exists to make. Brand gradient, white content, action chips at 95% white. The decorative shapes sit at <code>z-index: 0</code> under the content on purpose: <code>::after</code> paints over children at <code>auto</code>, which put a blob over the title the moment it wrapped.</p>
    <div class="ds-dash-stage">
        <section class="dash__hero" style="max-width: 640px;">
            <span class="dash__when">Today &middot; 09:00</span>
            <h3 class="dash__hero-title">Innovation Spark for Engineers</h3>
            <p class="dash__stage">Designed &middot; not run yet</p>
            <div class="dash__hero-actions">
                <a class="dash__chip" href="#"><?= icon('play_arrow') ?>Run it</a>
                <a class="dash__chip" href="#"><?= icon('edit_calendar') ?>Build on it</a>
            </div>
        </section>
    </div>
</section>

<section class="ds-section">
    <h2>Funnel card</h2>
    <p>Three bars off a shared zero, one hue, the value stated at the end of each. Not stacked and not three colours: the point is the drop between stages. The bars are <code>aria-hidden</code> because each is a second rendering of the number beside it.</p>
    <div class="ds-dash-stage ds-dash-stage--narrow">
        <section class="dash__viz">
            <h3 style="margin: 0 0 12px; font-size: 12px; font-weight: 700; letter-spacing: 0.11em; text-transform: uppercase; color: var(--color-ink-secondary);">Your workshop funnel</h3>
            <div class="dash__frow"><span class="dash__fl">Designed</span><span class="dash__ftrack"><span class="dash__fbar" style="width:100%" aria-hidden="true"></span></span><span class="dash__fv">11</span></div>
            <div class="dash__frow"><span class="dash__fl">Delivered</span><span class="dash__ftrack"><span class="dash__fbar" style="width:100%" aria-hidden="true"></span></span><span class="dash__fv">11</span></div>
            <div class="dash__frow"><span class="dash__fl">Synthesized</span><span class="dash__ftrack"><span class="dash__fbar" style="width:36%" aria-hidden="true"></span></span><span class="dash__fv">4</span></div>
            <div class="dash__split">
                <span class="dash__num">36%</span>
                <p class="dash__sub">of the workshops you ran got synthesized. The number worth moving.</p>
            </div>
        </section>
    </div>
</section>

<section class="ds-section">
    <h2>Promotion ledger</h2>
    <table class="ds-table">
        <thead><tr><th>Pattern</th><th>Overlaps</th><th>Status</th></tr></thead>
        <tbody>
            <tr><td><code>.dash__q</code> quick action</td><td><code>ws_button</code> primary</td><td>Retired &mdash; never found a second surface, and at two actions the row wanted a call to action rather than something quieter. Deleted; the dashboard uses <code>ws_button</code></td></tr>
            <tr><td><code>.dash__row</code> attention row</td><td><code>ws_listing_card</code></td><td>Candidate &mdash; differs in being a single-link row with an inline verb</td></tr>
            <tr><td><code>.dash__hero</code> hero card</td><td><code>ws_hero</code></td><td>Dashboard-only for now; ws_hero is a page hero, this is a card</td></tr>
            <tr><td><code>.dash__viz</code> funnel / trend</td><td><code>ws_stat</code>, <code>ws_progress</code></td><td>Candidate &mdash; ws_stat shows one number, these show a shape</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
