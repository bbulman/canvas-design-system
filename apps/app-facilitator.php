<?php
$ds_page  = 'apps/app-facilitator';
$ds_title = 'Facilitator App Guide';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>Facilitator</h1>
    <p>The live-session surface. Facilitators run a workshop from here — timers, participant tracking, agenda progression, interventions on demand. Unlike other apps, Facilitator is designed to be glanced at mid-session, not studied.</p>
</div>

<!-- App Identity -->
<section class="ds-section">
    <h2 class="ds-section-title" style="display: flex; align-items: center; gap: 10px;">
        <span style="width: 12px; height: 12px; background: #7C4DFF; border-radius: 4px;"></span>
        App Identity
    </h2>

    <div class="ds-grid-3" style="margin-bottom: 24px;">
        <div class="ds-card">
            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; margin-bottom: 8px;">Phase</div>
            <div style="font-weight: 600; color: #7C4DFF;">Facilitate</div>
        </div>
        <div class="ds-card">
            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; margin-bottom: 8px;">Primary Color</div>
            <div style="display: flex; align-items: center; gap: 8px;">
                <span style="width: 20px; height: 20px; background: #7C4DFF; border-radius: 4px;"></span>
                <code class="ds-code-inline">#7C4DFF</code>
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
    <p class="ds-section-desc">Facilitator UI is used while running a live session — attention is on people in the room, not the screen. Every design choice should reduce cognitive load and keep the next action obvious.</p>

    <div style="display: flex; flex-direction: column; gap: 16px;">
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #EDE9FE; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #7C4DFF;">timer</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Glanceable over detailed</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Time remaining, current activity, next-up — these must be readable from across the room. Oversized type, high contrast, no decorative flourish.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #DDD6FE; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #6D28D9;">bolt</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">One primary action always visible</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">"Advance to next item," "Start timer," "Add 5 min" — the expected next move is a single oversized button, never buried in a menu.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #C4B5FD; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #5B21B6;">medical_services</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Interventions are one tap away</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">When a group goes off the rails, the facilitator shouldn't hunt through menus. Intervention cards are in a persistent drawer, filterable by category, always reachable.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #F5F3FF; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #4C1D95;">dark_mode</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Dark surfaces for stage display</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Live-mode / presenter view uses a dark palette with glassmorphism overlays — low-glare for projectors, no accidental bright flashes when a modal opens.</div>
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
            <tr><td><strong>Live mode (stage)</strong></td><td>Full-screen timer + current activity + next-up. Dark palette, glassmorphism.</td><td><code>/planner/live/</code>, <code>/css/planner/live-mode.css</code></td></tr>
            <tr><td><strong>Facilitator dashboard</strong></td><td>Session list, participant count, quick-start, recent sessions.</td><td><code>/facilitator/</code></td></tr>
            <tr><td><strong>Intervention drawer</strong></td><td>Persistent side drawer with category chips + card list. Purple gradient header.</td><td><code>/css/intervention-drawer.css</code></td></tr>
            <tr><td><strong>Participant view</strong></td><td>Mobile-optimized participant-facing screens (prep, live timer, RSVP).</td><td><code>/css/facilitator/participant.css</code>, <code>/css/participant/</code></td></tr>
            <tr><td><strong>Session summary</strong></td><td>Post-session reflection prompts + metrics.</td><td><code>/css/facilitator/summary.css</code></td></tr>
        </tbody>
    </table>
</section>

<!-- Do / Don't -->
<section class="ds-section">
    <h2 class="ds-section-title">Do / Don't</h2>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Use purple as the Facilitate phase signal</strong>
            <div style="margin-top: 8px; font-size: 13px;"><code class="ds-code-inline">#7C4DFF</code> for primary actions, accents, phase nav. Paired with dark purple gradient for hero/drawer headers.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Mix purple with Plan blue as accent colors</strong>
            <div style="margin-top: 8px; font-size: 13px;">The handoff from Plan → Facilitate is a phase transition. A plan-mode blue accent inside facilitator UI muddles that.</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Oversize typography in live mode</strong>
            <div style="margin-top: 8px; font-size: 13px;">Current activity title at 48px+, timer at 72px+. Readable from 10 meters away.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Apply live-mode sizing to the dashboard</strong>
            <div style="margin-top: 8px; font-size: 13px;">The dashboard is used at a desk. Use the default platform type scale there.</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Surface the intervention drawer on every facilitator page</strong>
            <div style="margin-top: 8px; font-size: 13px;">Facilitators might need a technique at any moment. The drawer trigger is always reachable (bottom-right floating button).</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Hide interventions behind a "more" menu</strong>
            <div style="margin-top: 8px; font-size: 13px;">Extra clicks cost attention mid-workshop. Flatten the path.</div>
        </div>
    </div>
</section>

<!-- Memory note -->
<section class="ds-section">
    <div class="ds-note" style="background: #F5F3FF; border-color: #7C4DFF;">
        <span class="material-symbols-outlined" style="color: #7C4DFF;">info</span>
        <div><strong>Phase mapping reminder:</strong> The <strong>Facilitator</strong> page (<code>/facilitator/</code>) is in the <strong>Facilitate</strong> phase. The <strong>Coach</strong> page (<code>/coach/</code>) is in the <strong>Reflect</strong> phase — don't confuse them.</div>
    </div>
</section>

<!-- File Reference -->
<section class="ds-section">
    <h2 class="ds-section-title">File Reference</h2>
    <table class="ds-table">
        <thead><tr><th>Path</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>/facilitator/</code></td><td>Facilitator dashboard + session views</td></tr>
            <tr><td><code>/planner/live/</code></td><td>Live stage mode (run a session)</td></tr>
            <tr><td><code>/css/facilitator/facilitator.css</code></td><td>Dashboard/session styles</td></tr>
            <tr><td><code>/css/facilitator/participant.css</code></td><td>Participant-side views</td></tr>
            <tr><td><code>/css/facilitator/summary.css</code></td><td>Post-session summary</td></tr>
            <tr><td><code>/css/planner/live-mode.css</code></td><td>Dark stage-mode styling</td></tr>
            <tr><td><code>/css/intervention-drawer.css</code></td><td>Intervention drawer shared across apps</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
