<?php
$ds_page  = 'apps/app-hybrid';
$ds_title = 'Hybrid Kit App Guide';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>Hybrid Kit</h1>
    <p>A focused microsite for facilitators running hybrid (mixed remote + in-person) workshops. It's a resource library of playbooks, equity audits, tech checklists, and starter kits — not a tool, a reference.</p>
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
            <div style="font-weight: 600; color: #C73E3E;">Plan</div>
        </div>
        <div class="ds-card">
            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; margin-bottom: 8px;">Primary Color</div>
            <div style="display: flex; align-items: center; gap: 8px;">
                <span style="width: 20px; height: 20px; background: #E54D4D; border-radius: 4px;"></span>
                <code class="ds-code-inline">#E54D4D</code>
                <span style="color: #94a3b8; margin-left: 8px;">(Learn Red — Red Unification, Jul 2026)</span>
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
    <p class="ds-section-desc">Hybrid Kit is a standalone microsite — a niche content surface aimed at the "future of work" audience. It behaves more like a thoughtful landing/resource site than a platform app.</p>

    <div style="display: flex; flex-direction: column; gap: 16px;">
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FEE2E2; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #E54D4D;">download</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Downloadable-first</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Playbooks, checklists, and kits are PDF/markdown downloads. Every resource card leads with the file, not a long-form page. Facilitators take these into the room.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FEE2E2; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #C73E3E;">balance</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Equity-forward framing</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">The content angle is hybrid equity — keeping remote participants as engaged as in-room ones. Visual treatment should avoid "one over the other" imagery.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FEF2F2; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #C73E3E;">scale</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Niche, not comprehensive</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Hybrid Kit targets a specific problem. Don't dilute it with general facilitation content — link out to <code class="ds-code-inline">/library</code> and <code class="ds-code-inline">/tips</code> for that.</div>
            </div>
        </div>
    </div>
</section>

<!-- Key Patterns -->
<section class="ds-section">
    <h2 class="ds-section-title">Key Patterns</h2>
    <table class="ds-table">
        <thead><tr><th>Area</th><th>Pattern</th><th>Notes</th></tr></thead>
        <tbody>
            <tr><td><strong>Landing hero</strong></td><td>Fraunces display headline + 2-3 sentence value prop + primary download CTA.</td><td>Use <code>ws_hero</code> or custom equivalent.</td></tr>
            <tr><td><strong>Resource grid</strong></td><td>Card grid of kits/playbooks. Each card shows title, one-liner, file type, size, download button.</td><td>Consider <code>ws_feature_card</code>.</td></tr>
            <tr><td><strong>Kit detail page</strong></td><td>Long-form description + what's inside + download CTA.</td><td>Narrow measure for body text.</td></tr>
            <tr><td><strong>Cross-links</strong></td><td>Footer or inline callouts to Planner, Facilitator, and main Library for related work.</td><td>Don't make users dead-end on the kit.</td></tr>
        </tbody>
    </table>
</section>

<!-- Do / Don't -->
<section class="ds-section">
    <h2 class="ds-section-title">Do / Don't</h2>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Lead with the download</strong>
            <div style="margin-top: 8px; font-size: 13px;">A kit without a visible download button is a blog post. Make the file action the hero.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Gate downloads behind email forms</strong>
            <div style="margin-top: 8px; font-size: 13px;">Workshopr is a content platform, not a lead-gen funnel. Friction kills trust.</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Use the Learn Red family as the accent</strong>
            <div style="margin-top: 8px; font-size: 13px;">Since Red Unification (D1, July 2026) every app — Hybrid Kit included — renders the Learn Red family: <code class="ds-code-inline">var(--phase-learn)</code> / <code class="ds-code-inline">#E54D4D</code>, with <code class="ds-code-inline">#C73E3E</code> for text on light grounds. "Plan" survives as a phase name only; the shipped <code class="ds-code-inline">/toolkits/hybrid/</code> page already sets <code class="ds-code-inline">--phase-plan: #E54D4D</code>. Never reintroduce the retired Plan blue (<code class="ds-code-inline">#0284C7</code>).</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Invent a standalone brand color</strong>
            <div style="margin-top: 8px; font-size: 13px;">Hybrid Kit is a focused microsite, not a separate product. Staying in the platform palette signals "part of the whole."</div>
        </div>
    </div>
</section>

<!-- File Reference -->
<section class="ds-section">
    <h2 class="ds-section-title">File Reference</h2>
    <table class="ds-table">
        <thead><tr><th>Path</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>/toolkits/hybrid/</code></td><td>Hybrid Kit microsite root</td></tr>
        </tbody>
    </table>
    <p class="ds-section-desc" style="margin-top: 16px; font-size: 13px; color: #78716C;">As of April 2026, Hybrid Kit is an early-stage microsite. Expand this file reference as pages are added.</p>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
