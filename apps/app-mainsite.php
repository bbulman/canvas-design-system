<?php
$ds_page  = 'apps/app-mainsite';
$ds_title = 'Main Site App Guide';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>Main Site</h1>
    <p>Workshopr.io's public-facing surface — homepage, library (exercises / icebreakers / workshops / collections / goals), about, contact, search, legal, and the shared global header/footer. This is the first impression and the content library users browse.</p>
</div>

<!-- App Identity -->
<section class="ds-section">
    <h2 class="ds-section-title" style="display: flex; align-items: center; gap: 10px;">
        <span style="width: 12px; height: 12px; background: #E54D4D; border-radius: 4px;"></span>
        App Identity
    </h2>

    <div class="ds-grid-3" style="margin-bottom: 24px;">
        <div class="ds-card">
            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; margin-bottom: 8px;">Phase</div>
            <div style="font-weight: 600; color: #E54D4D;">Learn</div>
        </div>
        <div class="ds-card">
            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; margin-bottom: 8px;">Primary Color</div>
            <div style="display: flex; align-items: center; gap: 8px;">
                <span style="width: 20px; height: 20px; background: #E54D4D; border-radius: 4px;"></span>
                <code class="ds-code-inline">#E54D4D</code>
            </div>
        </div>
        <div class="ds-card">
            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; margin-bottom: 8px;">Font Stack</div>
            <div style="font-weight: 600;">Fraunces + Inter</div>
        </div>
    </div>
</section>

<!-- Design Philosophy -->
<section class="ds-section">
    <h2 class="ds-section-title">Design Philosophy</h2>
    <p class="ds-section-desc">The main site is a content destination, not a tool. It leans editorial — warm paper backgrounds, wide margins, serif display type — optimized for browsing a library and telling a story about facilitation.</p>

    <div style="display: flex; flex-direction: column; gap: 16px;">
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FEE2E2; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #E54D4D;">auto_stories</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Editorial warmth</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Cream backgrounds (<code class="ds-code-inline">--bg-page: #FEF7F1</code>), no pure whites or blacks. Fraunces sets the voice — confident serif headlines that say "library," not "app."</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FECACA; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #DC2626;">search</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Browse before buy</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">The library is fully public — no login wall. Content cards, category grids, and faceted filters are the core UI. Sign-up only gates save/export/plan.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FEF2F2; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #991B1B;">hub</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Phase routing hub</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Mainsite is the entry point that routes users to the four platform phases (Learn/Plan/Facilitate/Reflect). The global header's phase pills are the wayfinding.</div>
            </div>
        </div>
    </div>
</section>

<!-- Key Patterns -->
<section class="ds-section">
    <h2 class="ds-section-title">Key Patterns</h2>
    <table class="ds-table">
        <thead><tr><th>Area</th><th>Pattern</th><th>Files</th></tr></thead>
        <tbody>
            <tr>
                <td><strong>Global header/footer</strong></td>
                <td>Phase-aware header (blue/purple/red/green accent per page). Footer has newsletter + nav + social.</td>
                <td><code>/includes/components/header.php</code> (ws_header), <code>/includes/footer.php</code></td>
            </tr>
            <tr>
                <td><strong>Library listings</strong></td>
                <td>Category grid → content listing → detail page. Filterable by goal, duration, group size.</td>
                <td><code>/library/exercises/</code>, <code>/library/icebreakers/</code>, <code>/library/workshops/</code></td>
            </tr>
            <tr>
                <td><strong>Detail pages</strong></td>
                <td>Hero + metadata + body + related items. Uses <code>ws_listing_card</code> for related content.</td>
                <td><code>/library/*/detail/index.php</code></td>
            </tr>
            <tr>
                <td><strong>Hero sections</strong></td>
                <td><code>ws_hero()</code> on landing/about/legal. Fraunces display + Inter subtitle.</td>
                <td><code>/index.php</code>, <code>/about/</code></td>
            </tr>
            <tr>
                <td><strong>Search</strong></td>
                <td>Full-library faceted search with type filters (exercise/icebreaker/workshop).</td>
                <td><code>/search/</code></td>
            </tr>
        </tbody>
    </table>
</section>

<!-- Do / Don't -->
<section class="ds-section">
    <h2 class="ds-section-title">Do / Don't</h2>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Use Fraunces for page-level display</strong>
            <div style="margin-top: 8px; font-size: 13px;">H1s, hero titles, section names. The serif is core to the brand voice.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Set Fraunces on body paragraphs</strong>
            <div style="margin-top: 8px; font-size: 13px;">Long-form body text uses Inter. Fraunces as body is fatiguing and off-brand.</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Lead with `#E54D4D` as the brand accent</strong>
            <div style="margin-top: 8px; font-size: 13px;">Primary CTAs, link hovers, emphasis underlines. This is mainsite's ownable color.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Reach for blue, purple, or green as primary</strong>
            <div style="margin-top: 8px; font-size: 13px;">Those are reserved for Plan, Facilitate, and Reflect phases. Using them on mainsite muddles the phase wayfinding.</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Keep the library public</strong>
            <div style="margin-top: 8px; font-size: 13px;">Anyone can browse exercises/workshops/icebreakers without an account. It's a content destination first.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Gate browse behind auth</strong>
            <div style="margin-top: 8px; font-size: 13px;">Auth is required only for save/plan/share/favorite. Gating browse kills discovery.</div>
        </div>
    </div>
</section>

<!-- File Reference -->
<section class="ds-section">
    <h2 class="ds-section-title">File Reference</h2>
    <table class="ds-table">
        <thead><tr><th>Path</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>/index.php</code></td><td>Homepage (hero, featured content, phase routing)</td></tr>
            <tr><td><code>/library/*</code></td><td>Exercise, icebreaker, workshop, collection, and goal libraries</td></tr>
            <tr><td><code>/about/</code>, <code>/contact/</code>, <code>/legal/</code></td><td>Standard marketing pages</td></tr>
            <tr><td><code>/search/</code></td><td>Cross-library search</td></tr>
            <tr><td><code>/changelog/</code></td><td>Platform-wide changelog (all apps)</td></tr>
            <tr><td><code>/includes/components/header.php</code></td><td>Shared global header (ws_header); replaced global-header.php Jul 2026</td></tr>
            <tr><td><code>/css/styles.css</code></td><td>Mainsite styles</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
