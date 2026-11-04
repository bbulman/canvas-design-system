<?php
$ds_page  = 'apps/app-tips';
$ds_title = 'Tips App Guide';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>Tips App</h1>
    <p>A browsable library of facilitation tips organized by category. Like every app since Red Unification (D1, July 2026), Tips renders the Learn Red family (<code class="ds-code-inline">#E54D4D</code>) -- paired with a card-based layout optimized for discovery and reading.</p>
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
            <div style="font-weight: 600; color: #C73E3E;">Learn</div>
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
</section>

<!-- Design Philosophy -->
<section class="ds-section">
    <h2 class="ds-section-title">Design Philosophy</h2>
    <p class="ds-section-desc">Tips is a learning library. The design prioritizes browsability, categorization, and comfortable reading -- like flipping through a well-organized notebook.</p>

    <div style="display: flex; flex-direction: column; gap: 16px;">
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FEF2F2; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #E54D4D;">auto_stories</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Browse-first discovery</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Category tabs sit above a card grid. Users browse by category or search by keyword. The interface encourages exploration -- no login walls, no onboarding.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FEE2E2; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #C73E3E;">palette</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Learn Red accent</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Tips renders the unified Learn Red family: <code class="ds-code-inline">var(--phase-learn)</code> / <code class="ds-code-inline">#E54D4D</code> for active states, <code class="ds-code-inline">#C73E3E</code> for text on light grounds. The former Facilitate-purple treatment was retired by Red Unification (D1, July 2026) -- never reintroduce <code class="ds-code-inline">#7C4DFF</code>.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FEF2F2; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #C73E3E;">border_left</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Color-coded left borders</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Each tip card has a 4px left border matching its category color. Category tints should come from the red family (see Color Tokens below -- four legacy purple tints still ship in <code class="ds-code-inline">css/tips/styles.css</code> and are flagged for migration).</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FEF2F2; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #C73E3E;">format_quote</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Warm background texture</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Uses <code class="ds-code-inline">--bg-warm</code> (<code class="ds-code-inline">#FFFBF8</code>) as the page background with white card surfaces. This subtle warmth distinguishes Tips from the cooler tool apps.</div>
            </div>
        </div>
    </div>
</section>

<!-- Color Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Color Tokens</h2>
    <p class="ds-section-desc">The Learn Red family (Red Unification, D1). Active states, tab accents, and card borders all draw from these tokens -- never the retired <code class="ds-code-inline">#7C4DFF</code> purple.</p>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Core Palette</h3>
        <div style="display: flex; gap: 8px; margin-bottom: 24px;">
            <?php
            $colors = [
                ['token' => '--tips-primary', 'hex' => '#E54D4D', 'label' => 'Primary'],
                ['token' => '--tips-dark', 'hex' => '#C73E3E', 'label' => 'Dark'],
                ['token' => '--tips-light', 'hex' => '#FEE2E2', 'label' => 'Light'],
                ['token' => '--tips-very-light', 'hex' => '#FEF2F2', 'label' => 'Very Light'],
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
        <div style="display: flex; gap: 6px; margin-bottom: 16px;">
            <?php
            $cats = [
                ['token' => '--tips-cat-1', 'hex' => '#7F1D1D', 'label' => 'Fundamentals'],
                ['token' => '--tips-cat-2', 'hex' => '#991B1B', 'label' => 'Engagement'],
                ['token' => '--tips-cat-3', 'hex' => '#C73E3E', 'label' => 'Facilitation'],
                ['token' => '--tips-cat-4', 'hex' => '#E54D4D', 'label' => 'Difficult Moments'],
                ['token' => '--tips-cat-5', 'hex' => '#F87171', 'label' => 'Activities'],
                ['token' => '--tips-cat-6', 'hex' => '#FCA5A5', 'label' => 'Reflection'],
            ];
            foreach ($cats as $cat): ?>
            <div style="flex: 1; text-align: center;">
                <div style="height: 40px; background: <?= $cat['hex'] ?>; border-radius: 6px; margin-bottom: 6px;<?= $cat['hex'] === '#FCA5A5' ? 'border: 1px solid #E7E5E4;' : '' ?>"></div>
                <div style="font-size: 10px; font-weight: 600; color: #475569; line-height: 1.3;"><?= $cat['label'] ?></div>
                <div style="font-family: 'JetBrains Mono', monospace; font-size: 9px; color: #94a3b8;"><?= $cat['hex'] ?></div>
            </div>
            <?php endforeach; ?>
        </div>
        <p style="font-size: 12px; color: #78716C; margin-top: 4px;">Note: <code class="ds-code-inline">css/tips/styles.css</code> still ships the legacy purple <code class="ds-code-inline">--cat-*</code> tints for four categories -- migrate those to the values above.</p>
    </div>

    <div class="ds-code"><pre>/* Tips app tokens */
--tips-primary: #E54D4D;
--tips-dark: #C73E3E;
--tips-light: #FEE2E2;
--tips-very-light: #FEF2F2;
--tips-gradient: linear-gradient(135deg, #E54D4D 0%, #C73E3E 100%);
--tips-shadow: 0 4px 14px rgba(229, 77, 77, 0.25);

/* Category tints (6 red levels) */
--tips-cat-1: #7F1D1D;  /* Fundamentals */
--tips-cat-2: #991B1B;  /* Engagement */
--tips-cat-3: #C73E3E;  /* Facilitation */
--tips-cat-4: #E54D4D;  /* Difficult Moments */
--tips-cat-5: #F87171;  /* Activities */
--tips-cat-6: #FCA5A5;  /* Reflection */</pre></div>
</section>

<!-- Layout Patterns -->
<section class="ds-section">
    <h2 class="ds-section-title">Layout Patterns</h2>
    <p class="ds-section-desc">Simple, content-focused layout embedded within the main site shell.</p>

    <div class="ds-card" style="margin-bottom: 16px;">
        <div style="font-weight: 600; margin-bottom: 12px;">Page Structure</div>
        <div class="ds-code"><pre>┌────────────────────────────────────────────────┐
│  Unified Header (main site nav)                │
├────────────────────────────────────────────────┤
│                                                │
│  ┌──────────────────────────────────────────┐  │
│  │  Back button  |  Page Title  |  Search   │  │
│  └──────────────────────────────────────────┘  │
│                                                │
│  ┌──────────────────────────────────────────┐  │
│  │  Category Tabs (pill-style, scrollable)  │  │
│  └──────────────────────────────────────────┘  │
│                                                │
│  ┌──────┐ ┌──────┐ ┌──────┐                   │
│  │ Tip  │ │ Tip  │ │ Tip  │                   │
│  │ Card │ │ Card │ │ Card │  ...              │
│  │      │ │      │ │      │                   │
│  └──────┘ └──────┘ └──────┘                   │
│                                                │
│  Grid: repeat(auto-fill, minmax(350px, 1fr))   │
│  Max container: 1200px                         │
│                                                │
└────────────────────────────────────────────────┘</pre></div>
    </div>

    <table class="ds-table">
        <thead>
            <tr>
                <th>Element</th>
                <th>Spec</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Container max-width</td>
                <td><code>1200px</code></td>
            </tr>
            <tr>
                <td>Container padding</td>
                <td><code>2rem 1.5rem</code></td>
            </tr>
            <tr>
                <td>Card grid gap</td>
                <td><code>1.25rem</code></td>
            </tr>
            <tr>
                <td>Card min-width in grid</td>
                <td><code>350px</code></td>
            </tr>
            <tr>
                <td>Page background</td>
                <td><code>--bg-warm (#FFFBF8)</code></td>
            </tr>
            <tr>
                <td>Card background</td>
                <td><code>white</code></td>
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
                <div style="font-weight: 600; font-size: 16px;">Tip Card</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #FEF2F2; color: #C73E3E; border-radius: 100px; font-weight: 600;">Tips-specific</span>
            </div>
            <div style="font-size: 14px; color: #57534E; margin-bottom: 12px;">White card with 4px category-colored left border, 12px radius, hover lift effect. Contains tip icon, title, category badge, and preview text. Click opens the full tip in a modal.</div>
            <div class="ds-code"><pre>.tip-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(26, 39, 68, 0.06);
    border-left: 4px solid; /* category color */
    cursor: pointer;
    transition: all 0.2s ease;
}
.tip-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(26, 39, 68, 0.1);
}</pre></div>
        </div>

        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">Category Tabs</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #FEF2F2; color: #C73E3E; border-radius: 100px; font-weight: 600;">Tips-specific</span>
            </div>
            <div style="font-size: 14px; color: #57534E; margin-bottom: 12px;">Pill-style horizontal tab strip with icon, label, and count badge. Scrollable on mobile. Active tab gets a red border and tinted background.</div>
            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                <div style="display: flex; align-items: center; gap: 6px; padding: 8px 16px; border: 2px solid #E54D4D; border-radius: 100px; background: #FEF2F2; font-size: 13px; font-weight: 500; color: #C73E3E;">
                    <span class="material-symbols-outlined" style="font-size: 16px;">star</span>
                    Fundamentals
                    <span style="background: rgba(229, 77, 77, 0.2); padding: 1px 8px; border-radius: 100px; font-size: 11px;">12</span>
                </div>
                <div style="display: flex; align-items: center; gap: 6px; padding: 8px 16px; border: 2px solid transparent; border-radius: 100px; background: white; font-size: 13px; font-weight: 500; color: #6B7A94;">
                    <span class="material-symbols-outlined" style="font-size: 16px;">emoji_people</span>
                    Engagement
                    <span style="background: #F5F7FA; padding: 1px 8px; border-radius: 100px; font-size: 11px;">8</span>
                </div>
                <div style="display: flex; align-items: center; gap: 6px; padding: 8px 16px; border: 2px solid transparent; border-radius: 100px; background: white; font-size: 13px; font-weight: 500; color: #6B7A94;">
                    <span class="material-symbols-outlined" style="font-size: 16px;">groups</span>
                    Facilitation
                    <span style="background: #F5F7FA; padding: 1px 8px; border-radius: 100px; font-size: 11px;">10</span>
                </div>
            </div>
        </div>

        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">Search Bar</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #F1F5F9; color: #64748B; border-radius: 100px; font-weight: 600;">Shared pattern</span>
            </div>
            <div style="font-size: 14px; color: #57534E;">White pill-style search input with icon. Filters tips by keyword across title and content. Positioned in the page header alongside the back button and title.</div>
        </div>

        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">Tip Detail Modal</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #FEF2F2; color: #C73E3E; border-radius: 100px; font-weight: 600;">Tips-specific</span>
            </div>
            <div style="font-size: 14px; color: #57534E;">Full tip content displayed in a modal or expanded view. Shows title, full text, category, related tips, and "Try this" action prompts. Uses the shared <code class="ds-code-inline">ws_modal_start()</code> component.</div>
        </div>
    </div>
</section>

<!-- Do / Don't -->
<section class="ds-section">
    <h2 class="ds-section-title">Do / Don't</h2>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Use the Learn Red family via tokens</strong>
            <div style="margin-top: 8px; font-size: 13px;"><code class="ds-code-inline">var(--phase-learn)</code> / <code class="ds-code-inline">#E54D4D</code> for active states, <code class="ds-code-inline">#C73E3E</code> for text on light grounds. Style from the tokens so a palette change reaches Tips automatically.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Reintroduce the retired Facilitate purple</strong>
            <div style="margin-top: 8px; font-size: 13px;"><code class="ds-code-inline">#7C4DFF</code> was retired platform-wide by Red Unification (D1, July 2026). Tips is not an exception -- it renders the same red as every other app.</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Keep the card grid responsive</strong>
            <div style="margin-top: 8px; font-size: 13px;">Auto-fill grid with 350px min. Cards reflow naturally from 3 columns to 1.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Use fixed column counts</strong>
            <div style="margin-top: 8px; font-size: 13px;">Fixed grids break on tablet. Let the grid adapt to available space.</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Include category color on every card</strong>
            <div style="margin-top: 8px; font-size: 13px;">The 4px left border is the primary visual categorization. Never omit it.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Color the entire card background</strong>
            <div style="margin-top: 8px; font-size: 13px;">Full-color backgrounds reduce readability. The left border provides enough category signal.</div>
        </div>
    </div>
</section>

<!-- Shared Components Used -->
<section class="ds-section">
    <h2 class="ds-section-title">Shared Components Used</h2>

    <table class="ds-table">
        <thead>
            <tr>
                <th>Component</th>
                <th>Usage</th>
                <th>Customization</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><code>ws_modal_start()</code></td>
                <td>Tip detail view</td>
                <td>Category-colored header accent</td>
            </tr>
            <tr>
                <td><code>ws_badge()</code></td>
                <td>Category labels on cards</td>
                <td>Purple variant with category tint</td>
            </tr>
            <tr>
                <td><code>ws_input()</code></td>
                <td>Search bar</td>
                <td>Pill-style with search icon</td>
            </tr>
            <tr>
                <td><code>ws_empty_state()</code></td>
                <td>No search results, empty category</td>
                <td>Purple icon color</td>
            </tr>
            <tr>
                <td><code>ws_skeleton()</code></td>
                <td>Loading state for tip cards</td>
                <td>Card variant with left border placeholder</td>
            </tr>
        </tbody>
    </table>
</section>

<!-- Font Migration -->
<section class="ds-section">
    <h2 class="ds-section-title" style="color: #059669;">Font Migration Complete</h2>
    <div class="ds-note" style="background: #ECFDF5; border-color: #10B981;">
        <span class="material-symbols-outlined" style="color: #059669;">check_circle</span>
        <span><strong>Shipped v1.7:</strong> Tips now uses the platform fonts Fraunces (display) + Inter (body), replacing the former Bitter + DM Sans stack. Font variables live in <code>css/tips/styles.css</code>.</span>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
