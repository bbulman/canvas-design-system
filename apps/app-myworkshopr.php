<?php
$ds_page  = 'apps/app-myworkshopr';
$ds_title = 'MyWorkshopr (retired)';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>MyWorkshopr — retired</h1>
    <p>The personal dashboard was absorbed into the app shell in August 2026. This page is the map from what it used to be to where each part now lives; the guide that stood here documented a sidebar, seven panels, a team workspace and four stylesheets, none of which exist.</p>
</div>

<section class="ds-section">
    <h2 class="ds-section-title">Where everything went</h2>
    <table class="ds-table">
        <thead>
            <tr><th>What it was</th><th>Where it is now</th></tr>
        </thead>
        <tbody>
            <tr><td>The dashboard (<code>/myworkshopr/</code>, <code>?tab=overview</code>)</td><td><code>/app/</code> — the funnel, the attention list and up-next, all reading the Workshop Record</td></tr>
            <tr><td>Favorites, Notes, Comments, Submissions, Published</td><td><code>/app/?view=stuff&amp;step=…</code> — one view, five steps, built from <code>ws_*</code></td></tr>
            <tr><td>Add Exercise (<code>add-exercise.php</code>)</td><td><code>/app/?view=stuff&amp;step=contribute</code> — reached from the Submissions step, not from the tab strip</td></tr>
            <tr><td>Settings (8 panels)</td><td><code>/app/?view=settings</code>, deep-linkable on <code>&amp;section=</code></td></tr>
            <tr><td>Saved agendas (<code>?tab=agendas</code>, <code>myworkshops.php</code>)</td><td><code>/app/?view=plan&amp;step=saved</code> — Pro-gated, deliberately</td></tr>
            <tr><td>Workshop Record (<code>record.php</code>)</td><td><code>/app/?view=stuff</code>: the Impact Report it used to reach was retired with Prove in September 2026</td></tr>
            <tr><td>Team, Team Playbooks, Team Favorites</td><td>Parked. The pages are gone and the DB tables are kept; <code>.htaccess</code> 301s <code>team*</code> and <code>playbook.php</code> to <code>/app/</code></td></tr>
        </tbody>
    </table>
</section>

<section class="ds-section">
    <h2 class="ds-section-title">What the design system lost with it</h2>
    <ul class="ds-list">
        <li><code>/myworkshopr/css/myworkshopr.css</code>, <code>/css/myworkshopr/myworkshopr-v2.css</code>, <code>/css/myworkshopr/add-exercise.css</code>, <code>/myworkshopr/record.css</code> and <code>/js/myworkshopr.js</code> — deleted rather than migrated. What survived was rewritten as <code>app/css/settings.css</code>, <code>app/css/stuff.css</code> and <code>app/css/stuff-contribute.css</code>, each scoped to its view's root class and painting only from platform tokens.</li>
        <li>The per-type blue / green / purple icon tints and the orange <code>--exercise-accent</code> family. Red Unification (D1) retired the per-app palettes; every accent in the ported views is the one Learn red.</li>
        <li><code>ws_lifecycle()</code> and its demo page — see the changelog, v2.9.99. The journey strip the platform draws is <code>ws_wl_journey()</code> in <code>app/includes/workshop-list.php</code>, documented under <a href="app-workshop-list.php">Workshop List</a>.</li>
    </ul>
</section>

<section class="ds-section">
    <h2 class="ds-section-title">Building on the shell</h2>
    <p>New personal-workspace work belongs in <code>app/views/</code>, not here. The shell's own chrome is documented under <strong>Redesign</strong> (side navigation, dashboard patterns), the workshop cards under <a href="app-workshop-list.php">Workshop List</a>, and every component it uses in the <a href="../components/component-library.php">Component Library</a>.</p>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
