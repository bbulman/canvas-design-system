<?php
$ds_page  = 'apps/app-screen-components';
$ds_title = 'App Screen Components';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>App Screen Components</h1>
    <p>What <code>/app/</code> is actually made of, family by family, and which families the design system governs.</p>
</div>

<div class="ds-note">
    <span class="material-symbols-outlined">fact_check</span>
    <div>
        Inventoried on 17 September 2026 from two live captures, signed in: <code>/app/</code> (home, 238 named
        nodes across 66 distinct classes) and <code>/app/?view=plan&amp;step=build</code> (the planner, 203 nodes
        across 67 classes). Counts below are instances on those two screens, not guesses.
    </div>
</div>

<!-- The good news -->
<section class="ds-section">
    <h2 class="ds-section-title">What the design system already covers</h2>
    <p class="ds-section-desc">All 66 functions in <code>includes/components/helpers.php</code> are registered in <code>workshopr-design-system.json</code>. Everything on these screens that belongs to the design system is in it; nothing needs creating.</p>

    <table class="ds-table">
        <thead><tr><th>Component</th><th>Class</th><th>Instances (home / planner)</th></tr></thead>
        <tbody>
            <tr><td><code>ws_button</code></td><td><code>.ws-btn</code></td><td>17 / 2</td></tr>
            <tr><td><code>ws_card</code></td><td><code>.ws-card</code></td><td>3 / 0</td></tr>
            <tr><td><code>ws_badge</code></td><td><code>.ws-badge</code></td><td>2 / 0</td></tr>
            <tr><td><code>ws_sidenav</code></td><td><code>.ws-sidenav</code></td><td>1 / 1</td></tr>
            <tr><td><code>ws_task_checklist</code></td><td><code>.ws-task-checklist</code></td><td>1 / 0</td></tr>
            <tr><td><code>ws_dna_profile_cta</code></td><td><code>.ws-dna-profile-cta</code></td><td>1 / 0</td></tr>
            <tr><td><code>ws_app_footer</code></td><td><code>.ws-app-footer</code></td><td>1 / 0</td></tr>
            <tr><td><code>ws_app_bar</code></td><td><code>.ws-app-bar</code></td><td>0 / 1</td></tr>
            <tr><td><code>ws_app_dock</code></td><td><code>.ws-app-dock</code></td><td>0 / 1</td></tr>
            <tr><td><code>ws_header</code></td><td><code>.wsh-header</code></td><td>1 / 1</td></tr>
            <tr><td><code>ws_hero</code></td><td><code>.app-hero</code> wrapper</td><td>1 / 0</td></tr>
        </tbody>
    </table>
</section>

<!-- The gap -->
<section class="ds-section">
    <h2 class="ds-section-title">Three families outside the design system</h2>
    <p class="ds-section-desc">These render most of both screens and none of <code>check-drift</code>'s gates reach them. Its own note on the rule is the brief: <em>either move it into <code>includes/components/</code> and document it, or give it a local gate.</em> Registered in <code>workshopr-design-system.json</code> under <code>externalComponents</code>.</p>

    <div class="ds-subsection">
        <div class="ds-subsection-title">1. Workshop list <span class="ds-status ds-status--deprecated">largest gap</span></div>
        <p class="ds-section-desc"><code>app/includes/workshop-list.php</code>, 24 <code>ws_wl_*</code> functions, plus 32KB of <code>app/css/workshop-list.css</code>. <strong>12 <code>.wl-card</code> instances on home alone</strong>, making it the most repeated card on the platform and the least governed. <code>check-drift</code> already reports it as a warning.</p>
        <table class="ds-table">
            <thead><tr><th>Classes</th><th>Used on</th></tr></thead>
            <tbody>
                <tr>
                    <td><code>.wl-card</code>, <code>.wl-card__top</code>, <code>.wl-card__meta</code>, <code>.wl-stage</code>, <code>.wl-chip</code>, <code>.wl-view</code>, <code>.wl-grid</code>, <code>.wl-page</code>, <code>.wl-select__box</code></td>
                    <td>home, plan/home, plan/saved, <code>planner/saved.php</code></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">2. Dashboard and rail</div>
        <p class="ds-section-desc"><code>app/views/home.php</code>, <code>app/includes/dashboard.php</code>, <code>app/includes/rail.php</code>. The up-next band and the rail's tips and film cards are hand-built around <code>ws_card</code> rather than being components of their own.</p>
        <table class="ds-table">
            <thead><tr><th>Classes</th><th>Used on</th></tr></thead>
            <tbody>
                <tr>
                    <td><code>.dash__hero</code>, <code>.dash__hero-body</code>, <code>.dash__hero-actions</code>, <code>.app-rail__tips-tile</code>, <code>.app-rail__film-tile</code>, <code>.app-rail__quick</code></td>
                    <td>home</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">3. Planner</div>
        <p class="ds-section-desc">The biggest surface and the least componentised: <strong>zero helper functions</strong>, so every one of these is raw markup in <code>planner/</code>. Note that <code>ws_energy_arc_card</code> is a registered component, but the builder's progress header uses the separate <code>.energy-arc</code> classes instead of it.</p>
        <table class="ds-table">
            <thead><tr><th>Classes</th><th>Used on</th></tr></thead>
            <tbody>
                <tr>
                    <td><code>.agenda-item</code>, <code>.item-duration-badge</code>, <code>.item-icon</code>, <code>.item-description</code>, <code>.agenda-progress-header</code>, <code>.activity-sidebar</code>, <code>.category-btn</code>, <code>.category-btn-count</code>, <code>.section-header</code>, <code>.filter-select</code>, <code>.topbar-dropdown</code>, <code>.energy-arc</code></td>
                    <td><code>/app/?view=plan&amp;step=build</code> (iframed planner)</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<!-- Order of work -->
<section class="ds-section">
    <h2 class="ds-section-title">Order of work, and why</h2>
    <p class="ds-section-desc">These are not equal. Promoting a family is a refactor of shipping code, so the order matters more than the count.</p>

    <table class="ds-table">
        <thead><tr><th>#</th><th>Family</th><th>Why here</th><th>Shape of the work</th></tr></thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Workshop list</td>
                <td>Most instances, most reuse across four surfaces, and the functions already exist. This is a promotion, not an invention.</td>
                <td>Move the 24 functions into <code>includes/components/</code>, split the 32KB of CSS, add a demo, and let the existing gates start covering it.</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Dashboard and rail</td>
                <td>Small, self-contained, and only used on one screen, so the blast radius is one page.</td>
                <td>Two or three new <code>ws_*</code> components wrapping what is already <code>ws_card</code> underneath.</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Planner</td>
                <td>Biggest and riskiest. It has no helper layer to promote, the CSS is a modular bundle, and the builder autosaves, so a refactor here can write to production.</td>
                <td>Genuine componentisation from scratch. Should be its own project, not a design-system chore.</td>
            </tr>
        </tbody>
    </table>

    <div class="ds-note">
        <span class="material-symbols-outlined">warning</span>
        <div>None of the three can be promoted without editing <code>app/</code> or <code>planner/</code>. That is shipping code on the two most-used screens, so each family wants its own change, its own tests, and its own deploy set. Registering them here is the inventory step, not the fix.</div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
