<?php
// Detect if running on canvas.workshopr.io subdomain (doc root = design-system/)
$is_canvas = (($_SERVER['HTTP_HOST'] ?? '') === 'canvas.workshopr.io');
$ds_base   = $is_canvas ? '' : '/design-system';
$site_base = $is_canvas ? 'https://workshopr.io' : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__ . '/../includes/analytics-ga.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canvas — Workshopr Design System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,400;1,9..144,500&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="<?= $site_base ?>/images/favicon.svg">

    <!-- Main site styles (for footer) -->
    <link rel="stylesheet" href="<?= $site_base ?>/css/styles.css">

    <style>
        /* Reset */
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, system-ui, sans-serif;
            background-color: #2C2416;
            background-image:
                linear-gradient(rgba(229, 77, 77, 0.15) 1px, transparent 1px),
                linear-gradient(90deg, rgba(229, 77, 77, 0.15) 1px, transparent 1px);
            background-size: 32px 32px;
            color: #f1f5f9;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
        }

        .page-wrapper {
            max-width: 960px;
            margin: 0 auto;
            padding: 80px 24px 80px;
        }

        ::selection {
            background-color: rgba(229, 77, 77, 0.3);
            color: #fff;
        }

        /* ========== Hero Card ========== */
        .ds-hero {
            padding: 0;
            max-width: 960px;
            width: 100%;
            position: relative;
            color: #f1f5f9;
            text-align: center;
        }

        /* Badge */
        .ds-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(229, 77, 77, 0.12);
            border: 1px solid rgba(229, 77, 77, 0.25);
            backdrop-filter: blur(8px);
            padding: 5px 14px;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: #ffffff;
            margin-bottom: 24px;
        }

        .ds-hero-badge .material-symbols-outlined {
            font-size: 15px;
            color: #E54D4D;
        }

        /* Headline */
        .ds-hero h1 {
            font-family: 'Fraunces', Georgia, serif;
            font-size: clamp(2.5rem, 7vw, 4.5rem);
            font-weight: 700;
            line-height: 1.15;
            letter-spacing: -0.03em;
            color: #f1f5f9;
            margin-bottom: 16px;
        }

        .ds-hero h1 span {
            background: linear-gradient(90deg, #E54D4D, #F59E0B);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Subtitle */
        .ds-hero p {
            font-size: 17px;
            line-height: 1.7;
            color: #ffffff;
            max-width: 520px;
            margin: 0 auto 32px;
        }

        /* CTAs */
        .ds-hero-actions {
            display: flex;
            justify-content: center;
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

        .ds-hero-btn .material-symbols-outlined { font-size: 18px; }

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
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #f1f5f9;
        }

        .ds-hero-btn--ghost:hover {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(255, 255, 255, 0.25);
        }

        /* ========== Phase Pills ========== */
        .phase-row {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 48px;
        }

        .phase-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 22px;
            border-radius: 100px;
            color: #fff;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.2);
            transition: transform 200ms ease, box-shadow 200ms ease;
        }

        .phase-pill:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .phase-pill .material-symbols-outlined { font-size: 18px; }

        .phase-arrow {
            color: rgba(255, 255, 255, 0.3);
            font-size: 18px;
        }

        /* ========== JSON Section ========== */
        .ds-json-section {
            margin-top: 80px;
            text-align: left;
        }

        .ds-json-header {
            max-width: 640px;
            margin-bottom: 32px;
        }

        .ds-json-header h2 {
            font-family: 'Fraunces', Georgia, serif;
            font-size: 28px;
            color: #f1f5f9;
            margin-bottom: 12px;
        }

        .ds-json-header p {
            font-size: 15px;
            line-height: 1.6;
            color: #A8A29E;
        }

        .ds-json-card {
            background: #1C1917;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .ds-json-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.03);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .ds-json-card-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            font-weight: 500;
            color: #78716C;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .ds-json-card-title .material-symbols-outlined { font-size: 16px; color: #E54D4D; }

        .ds-json-card-body {
            padding: 0;
            max-height: 500px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.1) transparent;
        }

        .ds-json-card-body pre {
            margin: 0;
            padding: 24px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 13px;
            line-height: 1.5;
            color: #E7E5E4;
            tab-size: 2;
        }

        .ds-json-card-body::-webkit-scrollbar { width: 8px; }
        .ds-json-card-body::-webkit-scrollbar-track { background: transparent; }
        .ds-json-card-body::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.1); border-radius: 10px; }

        /* ========== Responsive ========== */
        @media (max-width: 768px) {
            .page-wrapper { padding: 32px 16px 60px; }
            .ds-hero { padding: 36px 24px; }
            .ds-hero h1 { font-size: 1.75rem; }
            .ds-hero-actions { flex-direction: column; }
            .ds-hero-btn { justify-content: center; }
            .phase-row { gap: 8px; }
            .phase-pill { padding: 8px 16px; font-size: 13px; }
            .phase-arrow { display: none; }
        }
    </style>
</head>
<body>

<div class="page-wrapper">
    <div class="ds-hero">
        <div class="ds-hero-badge">
            <span class="material-symbols-outlined">graph_3</span>
            Canvas
        </div>
        <h1>Build for facilitators.<br><span>Design with intent.</span></h1>
        <p>The shared language behind every Workshopr app. Tokens, components, and patterns for a platform that helps people run better workshops.</p>
        <div class="ds-hero-actions">
            <a href="<?= $ds_base ?>/getting-started/start-here.php" class="ds-hero-btn ds-hero-btn--primary">
                <span class="material-symbols-outlined">flag</span>
                Start Here
            </a>
            <a href="<?= $ds_base ?>/components/component-library.php" class="ds-hero-btn ds-hero-btn--ghost">
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

    <!-- Phase Journey -->
    <div class="phase-row">
        <?php
        $phases = [
            ['label' => 'Learn',      'icon' => 'menu_book', 'from' => '#E54D4D', 'to' => '#C73E3E'],
            ['label' => 'Plan',       'icon' => 'edit_note', 'from' => '#0284C7', 'to' => '#075985'],
            ['label' => 'Facilitate', 'icon' => 'groups',    'from' => '#7C4DFF', 'to' => '#6D28D9'],
            ['label' => 'Reflect',    'icon' => 'insights',  'from' => '#10B981', 'to' => '#059669'],
        ];
        foreach ($phases as $i => $phase): ?>
            <?php if ($i > 0): ?>
                <span class="material-symbols-outlined phase-arrow">chevron_right</span>
            <?php endif; ?>
            <a href="<?= $ds_base ?>/apps/theming.php" class="phase-pill" style="background: linear-gradient(135deg, <?= $phase['from'] ?>, <?= $phase['to'] ?>);">
                <span class="material-symbols-outlined"><?= $phase['icon'] ?></span>
                <?= $phase['label'] ?>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- Machine-Readable Source of Truth -->
    <div class="ds-json-section">
        <div class="ds-json-header">
            <h2>Machine-Readable Single Source of Truth</h2>
            <p>This JSON file translates visual design tokens into a deterministic API contract for AI assistants. It ensures that every generated component adheres strictly to brand colors, component constraints, and architectural rules.</p>
        </div>

        <div class="ds-json-card">
            <div class="ds-json-card-header">
                <div class="ds-json-card-title">
                    <span class="material-symbols-outlined">data_object</span>
                    workshopr-design-system.json
                </div>
                <div class="ds-json-card-actions">
                    <a href="<?= $ds_base ?>/workshopr-design-system.json" target="_blank" class="ds-hero-btn ds-hero-btn--ghost" style="padding: 4px 12px; font-size: 11px;">
                        Raw View
                    </a>
                </div>
            </div>
            <div class="ds-json-card-body">
                <pre><code><?= htmlspecialchars(file_get_contents(__DIR__ . '/workshopr-design-system.json')) ?></code></pre>
            </div>
        </div>
    </div>
</div>

</body>
</html>
