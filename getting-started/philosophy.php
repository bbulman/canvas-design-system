<?php
$ds_page  = 'getting-started/philosophy';
$ds_title = 'Design Philosophy';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>Design Philosophy</h1>
    <p>Workshopr's design sits at the intersection of warmth and professionalism. We build tools for facilitators -- people who guide human connection.</p>
</div>

<div style="margin: 0 0 28px; padding: 14px 18px; border-left: 3px solid var(--color-ink, #2C2416); background: var(--bg-page-alt, #FFFBF8); border-radius: 8px; font-size: 14px; line-height: 1.6; color: var(--color-ink-secondary, #57534E);">
    <strong>Canonical source:</strong> <code>/DESIGN.md</code> is the single source of truth for Workshopr's brand, visual system, and UX principles. This page is an illustrative reference &mdash; if it ever conflicts with <code>DESIGN.md</code>, <code>DESIGN.md</code> wins. See <code>/design-system/START-HERE.md</code> for the full source-of-truth hierarchy.
</div>

<!-- Direction -->
<section class="ds-section">
    <h2 class="ds-section-title">Design Direction: Warmth & Approachability</h2>
    <p class="ds-section-desc">We chose this direction for three reasons:</p>

    <div class="ds-grid-3" style="margin-bottom: 24px;">
        <div class="ds-card">
            <div style="width: 40px; height: 40px; background: #FEF3C7; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
                <span class="material-symbols-outlined" style="font-size: 20px; color: #F59E0B;">groups</span>
            </div>
            <div style="font-weight: 600; margin-bottom: 4px;">Our users are people-people</div>
            <div style="font-size: 14px; color: #78716C; line-height: 1.6;">Facilitators value human connection. Cold, clinical interfaces feel wrong.</div>
        </div>
        <div class="ds-card">
            <div style="width: 40px; height: 40px; background: #DBEAFE; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
                <span class="material-symbols-outlined" style="font-size: 20px; color: #3B82F6;">shield</span>
            </div>
            <div style="font-weight: 600; margin-bottom: 4px;">Our tools support high-stakes moments</div>
            <div style="font-size: 14px; color: #78716C; line-height: 1.6;">Live sessions, workshop planning, and coaching require confidence and clarity.</div>
        </div>
        <div class="ds-card">
            <div style="width: 40px; height: 40px; background: #EDE9FE; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
                <span class="material-symbols-outlined" style="font-size: 20px; color: #7C4DFF;">apps</span>
            </div>
            <div style="font-weight: 600; margin-bottom: 4px;">We're a multi-app platform</div>
            <div style="font-size: 14px; color: #78716C; line-height: 1.6;">Visual consistency across 8+ apps requires a strong shared foundation with room for per-app personality.</div>
        </div>
    </div>
</section>

<!-- Core Principles -->
<section class="ds-section">
    <h2 class="ds-section-title">Core Principles</h2>

    <div style="display: flex; flex-direction: column; gap: 16px;">
        <!-- Warm, not cute -->
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FEF2F2; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #E54D4D;">local_fire_department</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Warm, not cute</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Use warm neutrals and soft shadows, but keep typography and spacing precise. Ink text (<code class="ds-code-inline">#2C2416</code>) instead of pure black; cream backgrounds instead of pure white.</div>
            </div>
        </div>

        <!-- Structured, not rigid -->
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #E0F2FE; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #0284C7;">grid_on</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Structured, not rigid</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Cards and grids provide order; generous spacing provides breathing room. 12px radius cards, 24px gaps, clear visual hierarchy.</div>
            </div>
        </div>

        <!-- Color has meaning -->
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #EDE9FE; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #7C4DFF;">palette</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Color has meaning</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Phase colors orient users in the facilitator journey; accents signal actions and states. Red = Learn, Blue = Plan, Purple = Facilitate, Green = Reflect.</div>
            </div>
        </div>

        <!-- Progressive disclosure -->
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #DCFCE7; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #10B981;">unfold_more</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Progressive disclosure</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Show what matters now, reveal complexity on demand. Coach mode tabs, collapsible sections, contextual actions.</div>
            </div>
        </div>

        <!-- Consistent surface, varied content -->
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FEF3C7; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #F59E0B;">view_quilt</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Consistent surface, varied content</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Cards share the same shell (radius, shadow, padding) but have different internal layouts. Content cards, collection cards, and metric cards all look cohesive.</div>
            </div>
        </div>
    </div>
</section>

<!-- What we don't do -->
<section class="ds-section">
    <h2 class="ds-section-title">What We Don't Do</h2>
    <p class="ds-section-desc">Hard rules that keep the design system consistent.</p>

    <div style="display: flex; flex-direction: column; gap: 12px;">
        <div style="display: flex; align-items: center; gap: 12px; padding: 14px 16px; background: #FEF2F2; border-radius: 8px; border: 1px solid #FECACA;">
            <span class="material-symbols-outlined" style="font-size: 18px; color: #E54D4D;">close</span>
            <span style="font-size: 14px; color: #991B1B;"><strong>No pure black text.</strong> Always use <code class="ds-code-inline">--color-ink</code> (#2C2416) for warmth.</span>
        </div>
        <div style="display: flex; align-items: center; gap: 12px; padding: 14px 16px; background: #FEF2F2; border-radius: 8px; border: 1px solid #FECACA;">
            <span class="material-symbols-outlined" style="font-size: 18px; color: #E54D4D;">close</span>
            <span style="font-size: 14px; color: #991B1B;"><strong>No pure white backgrounds</strong> on the page level. Use <code class="ds-code-inline">--bg-page</code> (#FEF7F1) or <code class="ds-code-inline">--bg-page-alt</code> (#FFFBF8).</span>
        </div>
        <div style="display: flex; align-items: center; gap: 12px; padding: 14px 16px; background: #FEF2F2; border-radius: 8px; border: 1px solid #FECACA;">
            <span class="material-symbols-outlined" style="font-size: 18px; color: #E54D4D;">close</span>
            <span style="font-size: 14px; color: #991B1B;"><strong>No decorative gradients.</strong> Gradients are reserved for buttons, headers, and phase indicators.</span>
        </div>
        <div style="display: flex; align-items: center; gap: 12px; padding: 14px 16px; background: #FEF2F2; border-radius: 8px; border: 1px solid #FECACA;">
            <span class="material-symbols-outlined" style="font-size: 18px; color: #E54D4D;">close</span>
            <span style="font-size: 14px; color: #991B1B;"><strong>No bouncy/spring animations.</strong> Transitions are smooth and fast (150-300ms, ease curve).</span>
        </div>
        <div style="display: flex; align-items: center; gap: 12px; padding: 14px 16px; background: #FEF2F2; border-radius: 8px; border: 1px solid #FECACA;">
            <span class="material-symbols-outlined" style="font-size: 18px; color: #E54D4D;">close</span>
            <span style="font-size: 14px; color: #991B1B;"><strong>No thick borders for decoration.</strong> Use 1px borders or elevation, never 2px+ decorative borders.</span>
        </div>
    </div>
</section>

<!-- Do / Don't examples -->
<section class="ds-section">
    <h2 class="ds-section-title">Do / Don't Examples</h2>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Warm ink color</strong>
            <code style="background: rgba(0,0,0,0.08); padding: 2px 6px; border-radius: 4px; font-size: 12px;">color: #2C2416;</code>
            <div style="margin-top: 8px; font-size: 13px;">Subtle brown undertones create approachable text.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Pure black</strong>
            <code style="background: rgba(0,0,0,0.08); padding: 2px 6px; border-radius: 4px; font-size: 12px;">color: #000000;</code>
            <div style="margin-top: 8px; font-size: 13px;">Too harsh, creates uncomfortable contrast.</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Cream page background</strong>
            <code style="background: rgba(0,0,0,0.08); padding: 2px 6px; border-radius: 4px; font-size: 12px;">background: #FEF7F1;</code>
            <div style="margin-top: 8px; font-size: 13px;">Warm, inviting foundation for content.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Pure white page</strong>
            <code style="background: rgba(0,0,0,0.08); padding: 2px 6px; border-radius: 4px; font-size: 12px;">background: #FFFFFF;</code>
            <div style="margin-top: 8px; font-size: 13px;">White is for card surfaces, not page backgrounds.</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Smooth 200ms ease</strong>
            <code style="background: rgba(0,0,0,0.08); padding: 2px 6px; border-radius: 4px; font-size: 12px;">transition: all 200ms ease;</code>
            <div style="margin-top: 8px; font-size: 13px;">Responsive but not distracting.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Bouncy spring effects</strong>
            <code style="background: rgba(0,0,0,0.08); padding: 2px 6px; border-radius: 4px; font-size: 12px;">transition: all 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);</code>
            <div style="margin-top: 8px; font-size: 13px;">Playful animations undermine professional trust.</div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
