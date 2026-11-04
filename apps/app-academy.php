<?php
$ds_page  = 'apps/app-academy';
$ds_title = 'Academy / Training App Guide';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>Academy (Training)</h1>
    <p>Workshopr Academy is the learning-management side of the platform — learning paths, microbits, ebooks, and practice sessions. It turns new facilitators into confident ones.</p>
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
                <span style="color: #94a3b8; margin-left: 8px;">+ green accent (#10B981) for growth/progress</span>
            </div>
        </div>
        <div class="ds-card">
            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; margin-bottom: 8px;">Font Stack</div>
            <div style="font-weight: 600;">Fraunces + Inter</div>
            <div style="font-size: 12px; color: #78716C; margin-top: 4px;">Migrated from Bitter + DM Sans in April 2026</div>
        </div>
    </div>
</section>

<!-- Design Philosophy -->
<section class="ds-section">
    <h2 class="ds-section-title">Design Philosophy</h2>
    <p class="ds-section-desc">Academy is a library of structured learning. It borrows from great self-paced courseware — clear progress, one thing at a time, bite-sized modules you can complete in a coffee break.</p>

    <div style="display: flex; flex-direction: column; gap: 16px;">
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #ECFDF5; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #10B981;">trending_up</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Progress is the reward</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Every surface makes progress visible: % completed, microbits remaining, learning path milestones. Green is the growth color — use it sparingly, deliberately.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FEE2E2; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #E54D4D;">menu_book</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Book-like reading surfaces</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Long-form microbits and ebook modules use narrow measure (~65ch), generous line-height (1.7), and Fraunces for headings. Paper-card backgrounds evoke field notebooks.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FECACA; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #DC2626;">route</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Paths, not menus</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Learning paths are curated sequences. Use <code class="ds-code-inline">ws_level_up_grid</code> for the sequence view. Don't dump modules into an alphabetical list — that's a library, not a curriculum.</div>
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
            <tr><td><strong>Learning path index</strong></td><td>Hero + sequence grid + CTA to start.</td><td><code>/academy/learning-paths/</code></td></tr>
            <tr><td><strong>Microbit reader</strong></td><td>Narrow measure, progress bar, next/prev nav.</td><td><code>/academy/microbits/</code></td></tr>
            <tr><td><strong>Ebook viewer</strong></td><td>Chapter sidebar + reading pane.</td><td><code>/academy/ebook/</code></td></tr>
            <tr><td><strong>Profile / progress</strong></td><td>Grid of started/completed items, streak indicators.</td><td><code>/academy/training/index.php</code></td></tr>
        </tbody>
    </table>
</section>

<!-- Do / Don't -->
<section class="ds-section">
    <h2 class="ds-section-title">Do / Don't</h2>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Use green only for progress and completion</strong>
            <div style="margin-top: 8px; font-size: 13px;">Completion checkmarks, progress fills, "unlocked" indicators. Green earns its meaning through restraint.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Paint the page green</strong>
            <div style="margin-top: 8px; font-size: 13px;">Green buttons for generic CTAs, green section backgrounds, green nav pills — dilutes the progress-signal and conflicts with Reflect phase (DNA/analytics).</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Keep reading surfaces narrow</strong>
            <div style="margin-top: 8px; font-size: 13px;">65ch max-width on microbits and ebook pages. Long lines hurt comprehension.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Use full-width body text for learning content</strong>
            <div style="margin-top: 8px; font-size: 13px;">Academy isn't a dashboard — don't treat its long-form pages like one.</div>
        </div>
    </div>
</section>

<!-- File Reference -->
<section class="ds-section">
    <h2 class="ds-section-title">File Reference</h2>
    <table class="ds-table">
        <thead><tr><th>Path</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>/academy/training/</code></td><td>Training landing page + profile/progress</td></tr>
            <tr><td><code>/academy/learning-paths/</code></td><td>Curated sequences of microbits</td></tr>
            <tr><td><code>/academy/microbits/</code></td><td>Individual bite-sized lessons</td></tr>
            <tr><td><code>/academy/ebook/</code></td><td>Full ebook reader (chaptered long-form)</td></tr>
            <tr><td><code>/css/academy/styles.css</code></td><td>Academy-specific styles</td></tr>
            <tr><td><code>/css/academy/training.css</code></td><td>Training landing styles</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
