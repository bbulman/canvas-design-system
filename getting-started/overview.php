<?php
$ds_page  = 'index';
$ds_title = 'Overview';
require_once __DIR__ . '/../../includes/icon.php';
require_once __DIR__ . '/../../includes/components/helpers.php';
require_once __DIR__ . '/../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<style>
    /* ========== Hero ========== */
    .ds-hero {
        background: linear-gradient(135deg, #1A2744 0%, #243B5E 50%, #1A2744 100%);
        border-radius: 16px;
        padding: 56px 48px;
        margin-bottom: 56px;
        position: relative;
        overflow: hidden;
        color: #fff;
    }

    .ds-hero::before {
        content: '';
        position: absolute;
        top: -60%;
        right: -20%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(229, 77, 77, 0.15) 0%, transparent 70%);
        pointer-events: none;
    }

    .ds-hero::after {
        content: '';
        position: absolute;
        bottom: -40%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(124, 77, 255, 0.1) 0%, transparent 70%);
        pointer-events: none;
    }

    .ds-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(8px);
        padding: 5px 14px;
        border-radius: 100px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 24px;
    }

    .ds-hero-badge .material-symbols-outlined {
        font-size: 15px;
        color: #E54D4D;
    }

    .ds-hero h1 {
        font-family: 'Fraunces', Georgia, serif;
        font-size: clamp(2rem, 5vw, 2.75rem);
        font-weight: 700;
        line-height: 1.15;
        letter-spacing: -0.03em;
        color: #fff;
        margin-bottom: 16px;
    }

    .ds-hero h1 span {
        background: linear-gradient(90deg, #E54D4D, #F59E0B);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .ds-hero p {
        font-size: 17px;
        line-height: 1.7;
        color: rgba(255, 255, 255, 0.7);
        max-width: 520px;
        margin-bottom: 32px;
    }

    .ds-hero-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .ds-hero-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 22px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 150ms ease;
    }

    .ds-hero-btn--primary {
        background: linear-gradient(135deg, #E54D4D, #C73E3E);
        color: #fff;
        box-shadow: 0 2px 8px rgba(229, 77, 77, 0.3);
    }

    .ds-hero-btn--primary:hover {
        box-shadow: 0 4px 14px rgba(229, 77, 77, 0.45);
        transform: translateY(-1px);
    }

    .ds-hero-btn--ghost {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
    }

    .ds-hero-btn--ghost:hover {
        background: rgba(255, 255, 255, 0.14);
    }

    .ds-hero-btn .material-symbols-outlined {
        font-size: 18px;
    }

    /* ========== Color Strip ========== */
    .ds-color-strip {
        display: flex;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 56px;
        height: 56px;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08);
    }

    .ds-color-strip-swatch {
        flex: 1;
        position: relative;
        cursor: default;
        transition: flex 300ms ease;
    }

    .ds-color-strip-swatch:hover {
        flex: 2.5;
    }

    .ds-color-strip-swatch .swatch-label {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 0 10px 8px;
        font-size: 11px;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.9);
        opacity: 0;
        transform: translateY(4px);
        transition: all 200ms ease;
        white-space: nowrap;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
    }

    .ds-color-strip-swatch:hover .swatch-label {
        opacity: 1;
        transform: translateY(0);
    }

    /* ========== Phase Bar ========== */
    .ds-phase-bar {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        padding: 28px 24px;
        background: #FAFAF9;
        border-radius: 12px;
        border: 1px solid #E7E5E4;
        flex-wrap: wrap;
    }

    .ds-phase-pill {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        color: #fff;
        border-radius: 100px;
        font-weight: 600;
        font-size: 14px;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.1);
        text-decoration: none;
        transition: transform 150ms ease, box-shadow 150ms ease;
    }

    .ds-phase-pill:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(15, 23, 42, 0.15);
    }

    .ds-phase-pill .material-symbols-outlined { font-size: 18px; }
    .ds-phase-arrow { color: #D6D3D1; font-size: 20px; }

    /* ========== Stat Cards ========== */
    .ds-stat-card { text-align: center; padding: 28px 20px; }

    .ds-stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
    }

    .ds-stat-icon .material-symbols-outlined { font-size: 22px; }

    .ds-stat-value {
        font-size: 28px;
        font-weight: 700;
        color: #2C2416;
        font-family: 'Fraunces', serif;
        letter-spacing: -0.02em;
    }

    .ds-stat-label {
        font-size: 13px;
        color: #78716C;
        margin-top: 2px;
    }

    /* ========== App Cards ========== */
    .ds-app-card {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        text-decoration: none;
        color: inherit;
    }

    .ds-app-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .ds-app-icon .material-symbols-outlined { font-size: 22px; color: #fff; }

    /* ========== Principle Cards ========== */
    .ds-principle {
        display: flex;
        gap: 20px;
        align-items: flex-start;
    }

    .ds-principle-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .ds-principle-icon .material-symbols-outlined { font-size: 24px; }

    /* ========== Getting Started ========== */
    .ds-getting-started-step {
        display: flex;
        gap: 20px;
        align-items: flex-start;
        padding: 20px 24px;
    }

    .ds-step-number {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
        background: linear-gradient(135deg, #E54D4D, #C73E3E);
    }

    /* ========== Typography Preview ========== */
    .ds-type-preview {
        display: flex;
        flex-direction: column;
        gap: 0;
    }

    .ds-type-row {
        display: flex;
        align-items: baseline;
        gap: 20px;
        padding: 16px 0;
        border-bottom: 1px solid #F5F5F4;
    }

    .ds-type-row:last-child { border-bottom: none; }

    .ds-type-meta {
        width: 120px;
        flex-shrink: 0;
        font-size: 12px;
        font-weight: 500;
        color: #A8A29E;
        font-family: 'JetBrains Mono', monospace;
    }

    .ds-type-sample { flex: 1; color: #2C2416; }

    /* ========== Token Preview ========== */
    .ds-token-preview {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .ds-token-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 14px 6px 8px;
        background: #FAFAF9;
        border: 1px solid #E7E5E4;
        border-radius: 100px;
        font-size: 12px;
        font-family: 'JetBrains Mono', monospace;
        color: #57534E;
        transition: all 150ms ease;
    }

    .ds-token-chip:hover {
        border-color: #D6D3D1;
        background: #F5F5F4;
    }

    .ds-token-dot {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        flex-shrink: 0;
        border: 1px solid rgba(0, 0, 0, 0.08);
    }

    /* ========== Quick Link Cards ========== */
    .ds-quick-link {
        display: block;
        text-decoration: none;
        color: inherit;
        transition: transform 150ms ease;
    }

    .ds-quick-link:hover {
        transform: translateY(-2px);
    }

    .ds-quick-link .ds-card {
        height: 100%;
    }

    /* ========== Responsive ========== */
    @media (max-width: 768px) {
        .ds-hero { padding: 36px 24px; }
        .ds-hero h1 { font-size: 1.75rem; }
        .ds-color-strip { height: 40px; }
        .ds-color-strip-swatch .swatch-label { font-size: 10px; }
    }
</style>

<!-- Hero -->
<div class="ds-hero ds-fade-up ds-stagger-1">
    <div class="ds-hero-badge">
        <span class="material-symbols-outlined">hub</span>
        Design System
    </div>
    <h1>Build for facilitators.<br><span>Design with intent.</span></h1>
    <p>The shared language behind every Workshopr app. Tokens, components, and patterns for a platform that helps people run better workshops.</p>
    <div class="ds-hero-actions">
        <a href="<?= $ds_base ?>/components/component-library.php" class="ds-hero-btn ds-hero-btn--primary">
            <span class="material-symbols-outlined">widgets</span>
            Component Library
        </a>
        <a href="<?= $ds_base ?>/foundations/colors.php" class="ds-hero-btn ds-hero-btn--ghost">
            <span class="material-symbols-outlined">palette</span>
            Foundations
        </a>
        <a href="<?= $ds_base ?>/platform-tokens.css" class="ds-hero-btn ds-hero-btn--ghost" target="_blank">
            <span class="material-symbols-outlined">data_object</span>
            Tokens CSS
        </a>
    </div>
</div>

<!-- Live Color Strip -->
<div class="ds-color-strip ds-fade-up ds-stagger-2">
    <?php
    $swatches = [
        ['color' => '#FEF7F1', 'label' => 'Page BG'],
        ['color' => '#2C2416', 'label' => 'Ink'],
        ['color' => '#5C5242', 'label' => 'Ink Secondary'],
        ['color' => '#E54D4D', 'label' => 'Learn / Red'],
        ['color' => '#C73E3E', 'label' => 'Red Dark'],
        ['color' => '#F87171', 'label' => 'Tips / Coral'],
        ['color' => '#0284C7', 'label' => 'Plan / Blue'],
        ['color' => '#7C4DFF', 'label' => 'Facilitate / Purple'],
        ['color' => '#9333EA', 'label' => 'Intervention'],
        ['color' => '#10B981', 'label' => 'Reflect / Green'],
        ['color' => '#F59E0B', 'label' => 'Warning'],
        ['color' => '#1A2744', 'label' => 'Navy'],
    ];
    foreach ($swatches as $s): ?>
    <div class="ds-color-strip-swatch" style="background: <?= $s['color'] ?>;">
        <span class="swatch-label"><?= $s['label'] ?></span>
    </div>
    <?php endforeach; ?>
</div>

<!-- Quick Stats -->
<div class="ds-grid-4 ds-fade-up ds-stagger-2" style="margin-bottom: 56px;">
    <?php
    $stats = [
        ['icon' => 'palette',     'color' => '#E54D4D', 'bg' => '#fef2f4', 'value' => '4',    'label' => 'Phase Colors'],
        ['icon' => 'apps',        'color' => '#486581', 'bg' => '#f0f4f8', 'value' => '8',    'label' => 'Themed Apps'],
        ['icon' => 'data_object', 'color' => '#7C4DFF', 'bg' => '#f5f3ff', 'value' => '280+', 'label' => 'Design Tokens'],
        ['icon' => 'widgets',     'color' => '#4a7c59', 'bg' => '#f0faf4', 'value' => '33',   'label' => 'Components'],
    ];
    foreach ($stats as $stat): ?>
    <div class="ds-card ds-stat-card">
        <div class="ds-stat-icon" style="background: <?= $stat['bg'] ?>;">
            <span class="material-symbols-outlined" style="color: <?= $stat['color'] ?>;"><?= $stat['icon'] ?></span>
        </div>
        <div class="ds-stat-value"><?= $stat['value'] ?></div>
        <div class="ds-stat-label"><?= $stat['label'] ?></div>
    </div>
    <?php endforeach; ?>
</div>

<!-- Getting Started -->
<section class="ds-section ds-fade-up ds-stagger-3">
    <h2 class="ds-section-title">Getting Started</h2>
    <p class="ds-section-desc">Three steps to start building with the Workshopr design system.</p>

    <div style="display: flex; flex-direction: column; gap: 0;">
        <div class="ds-card ds-getting-started-step">
            <div class="ds-step-number">1</div>
            <div>
                <div style="font-weight: 600; font-size: 15px; margin-bottom: 4px;">Import the platform tokens</div>
                <div style="font-size: 14px; color: #78716C; line-height: 1.6; margin-bottom: 10px;">Every app starts with the shared token file. This gives you access to all colors, typography, and spacing variables.</div>
                <div class="ds-code" style="margin: 0;"><pre>@import '/design-system/platform-tokens.css';</pre></div>
            </div>
        </div>

        <div class="ds-card ds-getting-started-step">
            <div class="ds-step-number">2</div>
            <div>
                <div style="font-weight: 600; font-size: 15px; margin-bottom: 4px;">Include the component library</div>
                <div style="font-size: 14px; color: #78716C; line-height: 1.6; margin-bottom: 10px;">Add the CSS and PHP helpers for production-ready UI components.</div>
                <div class="ds-code" style="margin: 0;"><pre>&lt;link rel="stylesheet" href="/includes/components/components.css"&gt;

&lt;?php require_once 'includes/components/helpers.php'; ?&gt;</pre></div>
            </div>
        </div>

        <div class="ds-card ds-getting-started-step">
            <div class="ds-step-number">3</div>
            <div>
                <div style="font-weight: 600; font-size: 15px; margin-bottom: 4px;">Use semantic tokens, not raw values</div>
                <div style="font-size: 14px; color: #78716C; line-height: 1.6; margin-bottom: 10px;">Always reference CSS custom properties so your UI stays consistent across themes.</div>
                <div class="ds-do-dont" style="margin: 0;">
                    <div class="ds-do">
                        <strong>Do</strong>
                        <code style="font-size: 12px;">color: var(--color-ink);</code>
                    </div>
                    <div class="ds-dont">
                        <strong>Don't</strong>
                        <code style="font-size: 12px;">color: #2C2416;</code>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Typography Preview -->
<section class="ds-section ds-fade-up ds-stagger-3">
    <h2 class="ds-section-title">Typography at a Glance</h2>
    <p class="ds-section-desc">Two typefaces. Fraunces for headings that feel warm and grounded. Inter for body text that reads clearly at any size.</p>

    <div class="ds-card" style="padding: 32px;">
        <div class="ds-type-preview">
            <div class="ds-type-row">
                <div class="ds-type-meta">Fraunces 700<br>2.25rem</div>
                <div class="ds-type-sample" style="font-family: 'Fraunces', serif; font-size: 2.25rem; font-weight: 700; letter-spacing: -0.03em; line-height: 1.15;">Page Title</div>
            </div>
            <div class="ds-type-row">
                <div class="ds-type-meta">Fraunces 700<br>1.5rem</div>
                <div class="ds-type-sample" style="font-family: 'Fraunces', serif; font-size: 1.5rem; font-weight: 700; letter-spacing: -0.02em; line-height: 1.25;">Section Heading</div>
            </div>
            <div class="ds-type-row">
                <div class="ds-type-meta">Fraunces 600<br>1.125rem</div>
                <div class="ds-type-sample" style="font-family: 'Fraunces', serif; font-size: 1.125rem; font-weight: 600; line-height: 1.3;">Card Title</div>
            </div>
            <div class="ds-type-row">
                <div class="ds-type-meta">Inter 400<br>1rem</div>
                <div class="ds-type-sample" style="font-family: 'Inter', sans-serif; font-size: 1rem; color: #5C5242; line-height: 1.7;">Body text uses Inter for clean readability. Warm ink tones instead of pure black keep it approachable.</div>
            </div>
            <div class="ds-type-row">
                <div class="ds-type-meta">Inter 500<br>0.875rem</div>
                <div class="ds-type-sample" style="font-family: 'Inter', sans-serif; font-size: 0.875rem; font-weight: 500; color: #78716C; line-height: 1.5;">UI labels, metadata, secondary text</div>
            </div>
            <div class="ds-type-row">
                <div class="ds-type-meta">JetBrains Mono<br>0.8125rem</div>
                <div class="ds-type-sample" style="font-family: 'JetBrains Mono', monospace; font-size: 0.8125rem; color: #486581;">--color-ink: #2C2416;</div>
            </div>
        </div>
    </div>

    <div style="text-align: right; margin-top: 8px;">
        <a href="<?= $ds_base ?>/foundations/typography.php" style="font-size: 14px; font-weight: 600; color: #486581; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
            Full type scale
            <span class="material-symbols-outlined" style="font-size: 16px;">arrow_forward</span>
        </a>
    </div>
</section>

<!-- Token Preview Chips -->
<section class="ds-section ds-fade-up ds-stagger-3">
    <h2 class="ds-section-title">Token Samples</h2>
    <p class="ds-section-desc">A handful of the 180+ CSS custom properties available in <code class="ds-code-inline">platform-tokens.css</code>.</p>

    <div class="ds-token-preview">
        <?php
        $tokens = [
            ['var' => '--color-ink',          'hex' => '#2C2416'],
            ['var' => '--bg-page',            'hex' => '#FEF7F1'],
            ['var' => '--bg-surface',         'hex' => '#FFFFFF'],
            ['var' => '--phase-learn',        'hex' => '#E54D4D'],
            ['var' => '--phase-plan',         'hex' => '#0284C7'],
            ['var' => '--phase-facilitate',   'hex' => '#7C4DFF'],
            ['var' => '--phase-reflect',      'hex' => '#10B981'],
            ['var' => '--color-warning',      'hex' => '#F59E0B'],
            ['var' => '--color-success',      'hex' => '#22C55E'],
            ['var' => '--color-error',        'hex' => '#EF4444'],
            ['var' => '--gray-200',           'hex' => '#E7E5E4'],
            ['var' => '--gray-500',           'hex' => '#78716C'],
        ];
        foreach ($tokens as $t): ?>
        <div class="ds-token-chip">
            <span class="ds-token-dot" style="background: <?= $t['hex'] ?>;"></span>
            <?= $t['var'] ?>
        </div>
        <?php endforeach; ?>
    </div>

    <div style="text-align: right; margin-top: 12px;">
        <a href="<?= $ds_base ?>/resources/tokens.php" style="font-size: 14px; font-weight: 600; color: #486581; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
            Full token reference
            <span class="material-symbols-outlined" style="font-size: 16px;">arrow_forward</span>
        </a>
    </div>
</section>

<!-- The Facilitator Journey -->
<section class="ds-section ds-fade-up ds-stagger-4">
    <h2 class="ds-section-title">The Facilitator Journey</h2>
    <p class="ds-section-desc">Workshopr is organized around four phases. Each phase has a color, and every app inherits its phase color so users always know where they are.</p>

    <div class="ds-phase-bar" style="margin-bottom: 24px;">
        <?php
        $phases = [
            ['label' => 'Learn',      'icon' => 'menu_book', 'from' => '#E54D4D', 'to' => '#C73E3E'],
            ['label' => 'Plan',       'icon' => 'edit_note', 'from' => '#0284C7', 'to' => '#075985'],
            ['label' => 'Facilitate', 'icon' => 'groups',    'from' => '#7C4DFF', 'to' => '#6D28D9'],
            ['label' => 'Reflect',    'icon' => 'insights',  'from' => '#10B981', 'to' => '#059669'],
        ];
        foreach ($phases as $i => $phase): ?>
            <?php if ($i > 0): ?>
                <span class="material-symbols-outlined ds-phase-arrow">arrow_forward</span>
            <?php endif; ?>
            <a href="<?= $ds_base ?>/apps/theming.php" class="ds-phase-pill" style="background: linear-gradient(135deg, <?= $phase['from'] ?> 0%, <?= $phase['to'] ?> 100%);">
                <span class="material-symbols-outlined"><?= $phase['icon'] ?></span>
                <?= $phase['label'] ?>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- App Map -->
    <div class="ds-grid-2" style="margin-bottom: 16px;">
        <?php
        $apps = [
            ['name' => 'Main Site',     'desc' => 'Workshop & exercise library',                      'icon' => 'explore',         'from' => '#E54D4D', 'to' => '#C73E3E', 'phase' => 'Learn'],
            ['name' => 'Tips',          'desc' => 'Facilitation articles & guides',                   'icon' => 'tips_and_updates','from' => '#F87171', 'to' => '#EF4444', 'phase' => 'Learn'],
            ['name' => 'Podcasts',      'desc' => 'Audio conversations for practitioners',            'icon' => 'podcasts',        'from' => '#BE123C', 'to' => '#9F1239', 'phase' => 'Learn'],
            ['name' => 'Planner',       'desc' => 'Drag-and-drop agenda builder',                     'icon' => 'edit_note',       'from' => '#0284C7', 'to' => '#075985', 'phase' => 'Plan'],
            ['name' => 'Coach',         'desc' => 'AI facilitation guidance: prep, live, reflect',    'icon' => 'smart_toy',       'from' => '#7C4DFF', 'to' => '#6D28D9', 'phase' => 'Facilitate'],
            ['name' => 'Intervention',  'desc' => '37 rescue cards for live sessions',                'icon' => 'front_hand',      'from' => '#9333EA', 'to' => '#7E22CE', 'phase' => 'Facilitate'],
            ['name' => 'DNA',           'desc' => 'Team culture analytics (coming soon)',             'icon' => 'biotech',         'from' => '#10B981', 'to' => '#059669', 'phase' => 'Reflect'],
            ['name' => 'Training',      'desc' => 'Facilitation courses',                             'icon' => 'school',          'from' => '#34D399', 'to' => '#10B981', 'phase' => 'Reflect'],
            ['name' => 'Companion (iOS)', 'desc' => 'Native in-room facilitation companion',          'icon' => 'phone_iphone',    'from' => '#E54D4D', 'to' => '#C73E3E', 'phase' => 'Cross-phase'],
        ];
        foreach ($apps as $app): ?>
        <div class="ds-card" style="padding: 20px;">
            <div class="ds-app-card">
                <div class="ds-app-icon" style="background: linear-gradient(135deg, <?= $app['from'] ?>, <?= $app['to'] ?>);">
                    <span class="material-symbols-outlined"><?= $app['icon'] ?></span>
                </div>
                <div>
                    <div style="font-weight: 600; font-size: 15px; color: #2C2416; margin-bottom: 2px;"><?= $app['name'] ?></div>
                    <div style="font-size: 13px; color: #78716C; line-height: 1.5;"><?= $app['desc'] ?></div>
                    <div style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: <?= $app['from'] ?>; margin-top: 6px;"><?= $app['phase'] ?></div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="ds-note">
        <span class="material-symbols-outlined">info</span>
        <span>DNA is coming soon. Tokens are defined but the app is not yet launched.</span>
    </div>
</section>

<!-- Design Principles -->
<section class="ds-section ds-fade-up ds-stagger-4">
    <h2 class="ds-section-title">Design Principles</h2>
    <p class="ds-section-desc">Workshopr builds tools for people who guide human connection. The interface should feel warm and confident -- never cold, never cute.</p>

    <div style="display: flex; flex-direction: column; gap: 16px;">
        <?php
        $principles = [
            ['icon' => 'local_fire_department', 'bg' => '#FEF2F2', 'color' => '#E54D4D', 'title' => 'Warm, not cute',
             'desc' => 'Warm neutrals and soft shadows, but precise typography and spacing. Ink text instead of pure black; cream backgrounds instead of pure white.'],
            ['icon' => 'grid_on', 'bg' => '#E0F2FE', 'color' => '#0284C7', 'title' => 'Structured, not rigid',
             'desc' => 'Cards and grids provide order; generous spacing provides breathing room. 12px radius, 24px gaps, clear visual hierarchy.'],
            ['icon' => 'palette', 'bg' => '#EDE9FE', 'color' => '#7C4DFF', 'title' => 'Color has meaning',
             'desc' => 'Phase colors orient users in the facilitator journey. Red = Learn, Blue = Plan, Purple = Facilitate, Green = Reflect.'],
            ['icon' => 'unfold_more', 'bg' => '#DCFCE7', 'color' => '#10B981', 'title' => 'Progressive disclosure',
             'desc' => 'Show what matters now, reveal complexity on demand. Collapsible sections, contextual actions, layered detail.'],
            ['icon' => 'view_quilt', 'bg' => '#FEF3C7', 'color' => '#F59E0B', 'title' => 'Consistent surface, varied content',
             'desc' => 'Cards share the same shell (radius, shadow, padding) but have different internal layouts. Content cards, collection cards, and metric cards all look cohesive.'],
        ];
        foreach ($principles as $p): ?>
        <div class="ds-card">
            <div class="ds-principle">
                <div class="ds-principle-icon" style="background: <?= $p['bg'] ?>;">
                    <span class="material-symbols-outlined" style="color: <?= $p['color'] ?>;"><?= $p['icon'] ?></span>
                </div>
                <div>
                    <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;"><?= $p['title'] ?></div>
                    <div style="font-size: 14px; color: #57534E; line-height: 1.6;"><?= $p['desc'] ?></div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Voice & Tone -->
<section class="ds-section ds-fade-up ds-stagger-5">
    <h2 class="ds-section-title">Voice &amp; Tone</h2>
    <p class="ds-section-desc">We sound like a trusted senior colleague sharing what they've learned over coffee -- not from a podium. Expert, personal, immediately actionable.</p>

    <div class="ds-grid-2" style="margin-bottom: 16px;">
        <div class="ds-card" style="border-left: 4px solid #166534;">
            <div style="font-weight: 600; margin-bottom: 10px; color: #166534;">We sound like</div>
            <div style="font-size: 14px; color: #57534E; line-height: 1.7;">A practitioner with 15+ years in the trenches. Direct. Opinionated. Helpful. Real stories from real work.</div>
        </div>
        <div class="ds-card" style="border-left: 4px solid #991B1B;">
            <div style="font-weight: 600; margin-bottom: 10px; color: #991B1B;">We don't sound like</div>
            <div style="font-size: 14px; color: #57534E; line-height: 1.7;">An academic textbook, a motivational speaker, a corporate training manual, or ChatGPT.</div>
        </div>
    </div>

    <div style="text-align: right;">
        <a href="<?= $ds_base ?>/getting-started/voice.php" style="font-size: 14px; font-weight: 600; color: #486581; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
            Full writing style guide
            <span class="material-symbols-outlined" style="font-size: 16px;">arrow_forward</span>
        </a>
    </div>
</section>

<!-- Explore the System -->
<section class="ds-section">
    <h2 class="ds-section-title">Explore the System</h2>
    <p class="ds-section-desc">Jump to any section of the design system documentation.</p>

    <div class="ds-grid-3">
        <?php
        $links = [
            ['href' => 'foundations/colors.php',             'icon' => 'palette',          'color' => '#E54D4D', 'bg' => '#fef2f4', 'title' => 'Colors',            'desc' => 'Ink palette, backgrounds, semantic colors, per-app accents.'],
            ['href' => 'foundations/typography.php',          'icon' => 'format_size',      'color' => '#486581', 'bg' => '#f0f4f8', 'title' => 'Typography',         'desc' => 'Fraunces & Inter, type scale, weights, and line heights.'],
            ['href' => 'foundations/spacing.php',             'icon' => 'space_dashboard',  'color' => '#7C4DFF', 'bg' => '#f5f3ff', 'title' => 'Spacing & Layout',   'desc' => '4px base grid, breakpoints, and container patterns.'],
            ['href' => 'foundations/elevation.php',           'icon' => 'layers',           'color' => '#78716C', 'bg' => '#FAFAF9', 'title' => 'Elevation & Depth',   'desc' => 'Shadow scale, focus rings, and interactive elevation.'],
            ['href' => 'foundations/icons.php',               'icon' => 'emoji_symbols',    'color' => '#0e7c7b', 'bg' => '#effcf6', 'title' => 'Icons',               'desc' => 'Material Symbols usage, sizing, and custom icons.'],
            ['href' => 'foundations/animations.php',          'icon' => 'animation',        'color' => '#d4a832', 'bg' => '#fefdf4', 'title' => 'Animations',           'desc' => 'Transition durations, easing curves, and motion patterns.'],
            ['href' => 'components/component-library.php',   'icon' => 'deployed_code',    'color' => '#4a7c59', 'bg' => '#f0faf4', 'title' => 'Component Library',   'desc' => '33 production-ready PHP components with helper functions.'],
            ['href' => 'apps/theming.php',             'icon' => 'tune',             'color' => '#8b4513', 'bg' => '#fdf8f3', 'title' => 'App Theming',          'desc' => 'Per-app tokens for Learn, Plan, Facilitate, Reflect.'],
            ['href' => 'resources/accessibility.php',       'icon' => 'accessibility_new','color' => '#486581', 'bg' => '#f0f4f8', 'title' => 'Accessibility',        'desc' => 'Contrast, focus, touch targets, and ARIA patterns.'],
        ];
        foreach ($links as $link): ?>
        <a href="<?= $ds_base ?>/<?= $link['href'] ?>" class="ds-quick-link">
            <div class="ds-card">
                <div style="width: 40px; height: 40px; background: <?= $link['bg'] ?>; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
                    <span class="material-symbols-outlined" style="font-size: 20px; color: <?= $link['color'] ?>;"><?= $link['icon'] ?></span>
                </div>
                <div style="font-weight: 600; font-size: 15px; color: #2C2416; margin-bottom: 4px;"><?= $link['title'] ?></div>
                <div style="font-size: 13px; color: #78716C; line-height: 1.6;"><?= $link['desc'] ?></div>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
</section>

<!-- Source of Truth -->
<section class="ds-section">
    <h2 class="ds-section-title">Source of Truth</h2>
    <p class="ds-section-desc">The canonical token file is the single source of truth for all design values across every Workshopr app.</p>

    <table class="ds-table">
        <thead>
            <tr>
                <th>File</th>
                <th>Purpose</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><code>design-system/platform-tokens.css</code></td>
                <td>All CSS custom properties (canonical)</td>
            </tr>
            <tr>
                <td><code>design-system/docs/workshopr-style-guide.md</code></td>
                <td>Full written design specification</td>
            </tr>
            <tr>
                <td><code>design-system/workshopr-design-system.json</code></td>
                <td>Machine-readable token export</td>
            </tr>
            <tr>
                <td><code>includes/components/helpers.php</code></td>
                <td>Component helper functions (ws_badge, ws_button, etc.)</td>
            </tr>
            <tr>
                <td><code>includes/components/components.css</code></td>
                <td>Component library styles</td>
            </tr>
            <tr>
                <td><code>content/workshopr_writing_style_guide.md</code></td>
                <td>Writing voice, tone, and authenticity checklist</td>
            </tr>
        </tbody>
    </table>
</section>

<p style="font-size: 13px; color: #A8A29E; text-align: center; padding-top: 24px; border-top: 1px solid #E7E5E4;">Last updated: March 2026</p>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
