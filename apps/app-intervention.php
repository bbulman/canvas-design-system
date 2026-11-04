<?php
$ds_page  = 'apps/app-intervention';
$ds_title = 'Workshopr Intervention Cards Guide';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>Workshopr Intervention Cards</h1>
    <p>37 tap-accessible cards for common facilitation challenges. A standalone microsite that also integrates into the Coach's Facilitate mode. Designed for quick access during live sessions.</p>
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
            <div style="font-weight: 600; color: #E54D4D;">Facilitate</div>
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
            <div style="font-weight: 600;">Fraunces + Inter (shared)</div>
        </div>
    </div>

    <div class="ds-note">
        <span class="material-symbols-outlined">info</span>
        <div>The Intervention site uses the platform fonts <strong>Fraunces</strong> (serif display) + <strong>Inter</strong> (body), matching the rest of Workshopr for cross-app consistency. The editorial, "handbook" feel comes from layout, color, and paper-card metaphors rather than font choice.</div>
    </div>
</section>

<!-- Design Philosophy -->
<section class="ds-section">
    <h2 class="ds-section-title">Design Philosophy</h2>
    <p class="ds-section-desc">Intervention cards must be scannable in seconds. A facilitator reaches for one when something goes wrong -- the design prioritizes speed and clarity over aesthetics.</p>

    <div style="display: flex; flex-direction: column; gap: 16px;">
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FEF2F2; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #E54D4D;">bolt</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">2-second access</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Every card must be reachable in two taps: category, then card. The homepage shows all 6 categories with card counts. No nested navigation, no search-first patterns.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FEE2E2; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #C73E3E;">style</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Physical card metaphor</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Cards use paper-like cream backgrounds (<code class="ds-code-inline">--bg-page</code>), subtle shadows, and rounded corners. The design evokes index cards or flash cards -- tactile, familiar, quick to flip through.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FECACA; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #991B1B;">category</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Category color coding</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">6 categories, 6 red tints. Color appears as left-border on cards, category badges, and hero accents. Users build color associations: darker = more urgent situations.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FCA5A5; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #7F1D1D;">print</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Print-ready design</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Cards are designed to be downloadable and printable. The layout, typography, and contrast work in both digital and physical formats. Print styles strip backgrounds and optimize for paper.</div>
            </div>
        </div>
    </div>
</section>

<!-- Color Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Color Tokens</h2>
    <p class="ds-section-desc">Red palette (Learn red, <code class="ds-code-inline">#E54D4D</code>). Intervention sits in the Facilitate phase but deliberately uses red — not facilitate purple — as its accent. Intervention pages locally override <code class="ds-code-inline">--phase-facilitate</code> / <code class="ds-code-inline">--intervention-primary</code> / <code class="ds-code-inline">--coach-primary</code> to red.</p>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Core Palette</h3>
        <div style="display: flex; gap: 8px; margin-bottom: 24px;">
            <?php
            $colors = [
                ['token' => '--intervention-primary', 'hex' => '#E54D4D', 'label' => 'Primary'],
                ['token' => '--intervention-dark', 'hex' => '#C73E3E', 'label' => 'Dark'],
                ['token' => '--intervention-light', 'hex' => '#FEE2E2', 'label' => 'Light'],
                ['token' => '--intervention-very-light', 'hex' => '#FEF2F2', 'label' => 'Very Light'],
            ];
            foreach ($colors as $c): ?>
            <div style="flex: 1; text-align: center;">
                <div style="height: 48px; background: <?= $c['hex'] ?>; border-radius: 8px; margin-bottom: 8px;<?= in_array($c['hex'], ['#FEE2E2', '#FEF2F2']) ? 'border: 1px solid #E7E5E4;' : '' ?>"></div>
                <div style="font-size: 12px; font-weight: 600; color: #475569;"><?= $c['label'] ?></div>
                <div style="font-family: 'JetBrains Mono', monospace; font-size: 11px; color: #94a3b8;"><?= $c['token'] ?></div>
                <div style="font-family: 'JetBrains Mono', monospace; font-size: 10px; color: #cbd5e1;"><?= $c['hex'] ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Category Tints (6 Red Levels)</h3>
        <p style="font-size: 14px; color: #64748b; margin-bottom: 12px;">Darkest = most urgent situations. Lightest = softest, trust-building scenarios.</p>
        <div style="display: flex; gap: 6px; margin-bottom: 16px;">
            <?php
            $cats = [
                ['token' => '--intervention-cat-1', 'hex' => '#7F1D1D', 'label' => 'Energy & Engagement'],
                ['token' => '--intervention-cat-2', 'hex' => '#991B1B', 'label' => 'Conflict & Tension'],
                ['token' => '--intervention-cat-3', 'hex' => '#B91C1C', 'label' => 'Participation'],
                ['token' => '--intervention-cat-4', 'hex' => '#C73E3E', 'label' => 'Time & Pacing'],
                ['token' => '--intervention-cat-5', 'hex' => '#E54D4D', 'label' => 'Focus & Clarity'],
                ['token' => '--intervention-cat-6', 'hex' => '#F87171', 'label' => 'Connection & Trust'],
            ];
            foreach ($cats as $cat): ?>
            <div style="flex: 1; text-align: center;">
                <div style="height: 40px; background: <?= $cat['hex'] ?>; border-radius: 6px; margin-bottom: 6px;"></div>
                <div style="font-size: 10px; font-weight: 600; color: #475569; line-height: 1.3;"><?= $cat['label'] ?></div>
                <div style="font-family: 'JetBrains Mono', monospace; font-size: 9px; color: #94a3b8;"><?= $cat['hex'] ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="ds-code"><pre>/* Intervention app tokens */
--intervention-primary: #E54D4D;
--intervention-dark: #C73E3E;
--intervention-light: #FEE2E2;
--intervention-very-light: #FEF2F2;
--intervention-gradient: linear-gradient(135deg, #E54D4D 0%, #C73E3E 100%);
--intervention-shadow: 0 4px 14px rgba(229, 77, 77, 0.25);

/* Category tints (dark = urgent, light = soft) */
--intervention-cat-1: #7F1D1D;  /* Energy & Engagement */
--intervention-cat-2: #991B1B;  /* Conflict & Tension */
--intervention-cat-3: #B91C1C;  /* Participation */
--intervention-cat-4: #C73E3E;  /* Time & Pacing */
--intervention-cat-5: #E54D4D;  /* Focus & Clarity */
--intervention-cat-6: #F87171;  /* Connection & Trust */</pre></div>
</section>

<!-- Typography -->
<section class="ds-section">
    <h2 class="ds-section-title">Typography</h2>
    <p class="ds-section-desc">The Intervention site uses a distinct font pairing for its editorial, handbook feel.</p>

    <table class="ds-table">
        <thead>
            <tr>
                <th>Role</th>
                <th>Font</th>
                <th>Weight</th>
                <th>Usage</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Display</strong></td>
                <td><code>Fraunces</code></td>
                <td>500-700</td>
                <td>Hero titles, card titles, section headings</td>
            </tr>
            <tr>
                <td><strong>Body</strong></td>
                <td><code>Inter</code></td>
                <td>400-600</td>
                <td>Card content, descriptions, navigation</td>
            </tr>
            <tr>
                <td><strong>Accent</strong></td>
                <td><code>Fraunces</code></td>
                <td>500-600</td>
                <td>Eyebrows, special callouts</td>
            </tr>
        </tbody>
    </table>

    <div class="ds-note">
        <span class="material-symbols-outlined">info</span>
        <div>Intervention uses the platform type stack (Fraunces + Inter). The "reference book" feel comes from the paper-card visual treatment and category color coding, not from a unique font choice.</div>
    </div>
</section>

<!-- Card Anatomy -->
<section class="ds-section">
    <h2 class="ds-section-title">Card Anatomy</h2>
    <p class="ds-section-desc">Each intervention card follows a consistent structure optimized for scanning.</p>

    <div class="ds-card" style="border-left: 4px solid #E54D4D; margin-bottom: 16px;">
        <div style="font-weight: 600; margin-bottom: 16px; font-size: 16px;">Card Structure</div>
        <div class="ds-code"><pre>┌─────────────────────────────────────┐
│ ┌────┐                              │
│ │Icon│  Card Title                  │
│ └────┘  Category Badge              │
│                                     │
│ Trigger:                            │
│ "When you notice..."                │
│                                     │
│ Quick Response:                     │
│ "Try saying..."                     │
│                                     │
│ ┌─────────────────────────────────┐ │
│ │ Steps:                          │ │
│ │ 1. First action                 │ │
│ │ 2. Follow-up                    │ │
│ │ 3. Resolution                   │ │
│ └─────────────────────────────────┘ │
│                                     │
│ Pro Tip                             │
│ "Advanced advice..."                │
└─────────────────────────────────────┘</pre></div>
    </div>

    <table class="ds-table">
        <thead>
            <tr>
                <th>Element</th>
                <th>Purpose</th>
                <th>Style</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Left border</strong></td>
                <td>Category color identification</td>
                <td><code>border-left: 4px solid var(--cat-color)</code></td>
            </tr>
            <tr>
                <td><strong>Trigger</strong></td>
                <td>When to use this card</td>
                <td>Italic, muted color, "When you notice..." format</td>
            </tr>
            <tr>
                <td><strong>Quick Response</strong></td>
                <td>Immediate thing to say/do</td>
                <td>Bold, boxed, high-contrast for quick scanning</td>
            </tr>
            <tr>
                <td><strong>Steps</strong></td>
                <td>Detailed resolution process</td>
                <td>Numbered list, contained in subtle card</td>
            </tr>
            <tr>
                <td><strong>Pro Tip</strong></td>
                <td>Expert-level advice</td>
                <td>Amber-highlighted callout box</td>
            </tr>
        </tbody>
    </table>
</section>

<!-- Key Components -->
<section class="ds-section">
    <h2 class="ds-section-title">Key Components</h2>

    <div style="display: flex; flex-direction: column; gap: 16px;">
        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">Category Grid</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #FEE2E2; color: #C73E3E; border-radius: 100px; font-weight: 600;">Intervention-specific</span>
            </div>
            <div style="font-size: 14px; color: #57534E;">Homepage grid of 6 category cards. Each shows category icon, name, card count, and a sample card preview. Color-coded left border matches the category tint.</div>
        </div>

        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">Card List View</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #FEE2E2; color: #C73E3E; border-radius: 100px; font-weight: 600;">Intervention-specific</span>
            </div>
            <div style="font-size: 14px; color: #57534E;">Category page showing all cards as compact rows with title, trigger preview, and category dot. Click expands to full card detail.</div>
        </div>

        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">Download CTA Section</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #FEE2E2; color: #C73E3E; border-radius: 100px; font-weight: 600;">Intervention-specific</span>
            </div>
            <div style="font-size: 14px; color: #57534E;">Prominent download section for printable card deck. Email capture with preview image. Uses the intervention gradient as background.</div>
        </div>

        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">Hero Section</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #F1F5F9; color: #64748B; border-radius: 100px; font-weight: 600;">Shared pattern</span>
            </div>
            <div style="font-size: 14px; color: #57534E;">Split hero with text left, card preview image right. Stats row (37 cards, 6 categories, 2s access). Uses the cream paper background with subtle dot-grid pattern.</div>
        </div>
    </div>
</section>

<!-- Integration with Coach -->
<section class="ds-section">
    <h2 class="ds-section-title">Integration with Coach</h2>
    <p class="ds-section-desc">Intervention cards appear inside the Coach's Facilitate mode as a sidebar panel.</p>

    <div class="ds-card">
        <div style="font-weight: 600; margin-bottom: 8px;">Standalone vs. Embedded</div>
        <table class="ds-table">
            <thead>
                <tr>
                    <th>Aspect</th>
                    <th>Standalone Microsite</th>
                    <th>Embedded in Coach</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Layout</strong></td>
                    <td>Full page, marketing hero</td>
                    <td>Sidebar panel, compact cards</td>
                </tr>
                <tr>
                    <td><strong>Typography</strong></td>
                    <td>Fraunces + Inter</td>
                    <td>Inherits Coach fonts (Fraunces + Source Sans)</td>
                </tr>
                <tr>
                    <td><strong>Navigation</strong></td>
                    <td>Breadcrumbs, category pages</td>
                    <td>Accordion categories, search filter</td>
                </tr>
                <tr>
                    <td><strong>Card detail</strong></td>
                    <td>Full page</td>
                    <td>Modal overlay</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<!-- Do / Don't -->
<section class="ds-section">
    <h2 class="ds-section-title">Do / Don't</h2>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Lead with the Quick Response</strong>
            <div style="margin-top: 8px; font-size: 13px;">The facilitator needs one actionable sentence first. Details come second.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Bury the response in theory</strong>
            <div style="margin-top: 8px; font-size: 13px;">Long preambles defeat the purpose. Trigger, then response, then details.</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Use category colors consistently</strong>
            <div style="margin-top: 8px; font-size: 13px;">Left borders, badges, and icons all match. Users learn to spot their category by color.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Mix category color with semantic color</strong>
            <div style="margin-top: 8px; font-size: 13px;">Don't reach for the semantic error red (#EF4444) for a "conflict" category — categories use the intervention red tints (#7F1D1D → #F87171), kept distinct from semantic alert colors.</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Design for print</strong>
            <div style="margin-top: 8px; font-size: 13px;">Cards should look great printed on paper. Test contrast and readability at physical size.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Rely on hover states for critical info</strong>
            <div style="margin-top: 8px; font-size: 13px;">Cards must work on tablets (common in live sessions) and in print. All info should be visible.</div>
        </div>
    </div>
</section>

<!-- Font Migration -->
<section class="ds-section">
    <h2 class="ds-section-title" style="color: #059669;">Font Migration Complete</h2>
    <div class="ds-note" style="background: #ECFDF5; border-color: #10B981;">
        <span class="material-symbols-outlined" style="color: #059669;">check_circle</span>
        <span><strong>Shipped v1.7:</strong> Intervention now uses the platform fonts Fraunces (display) + Inter (body), replacing the former Bitter + DM Sans stack. Font variables live in <code>css/intervention/styles.css</code>.</span>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
