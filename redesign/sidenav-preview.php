<?php
/**
 * Bare preview of ws_sidenav — no design-system chrome, full viewport height,
 * so the rail is seen in the context it was built for: an app shell with no
 * browser chrome above it.
 *
 *   ?variant=rail|expanded   which variant to show (default expanded)
 *   ?both=1                  both side by side
 */
require_once __DIR__ . '/../../includes/config.php';
require_once ws_path('includes/icon.php');
require_once ws_path('includes/components/helpers.php');

$variant = ($_GET['variant'] ?? 'expanded') === 'rail' ? 'rail' : 'expanded';
$both    = ($_GET['both'] ?? '') === '1';

$nav = [
    ['label' => 'Home',       'icon' => 'home',              'href' => '/'],
    ['label' => 'Strategize', 'icon' => 'knight',            'href' => '/strategist/app.php', 'active' => true],
    ['label' => 'Plan',       'icon' => 'calendar_view_day', 'href' => '/planner/'],
    ['label' => 'Facilitate', 'icon' => 'groups',            'href' => '/facilitator/'],
    ['label' => 'Synthesize', 'icon' => 'hub',               'href' => '/synthesize/'],
    ['type'  => 'divider'],
    ['label' => 'Library',      'icon' => 'auto_stories', 'href' => '/library/'],
    ['label' => 'Rescue Cards', 'icon' => 'stacks',       'href' => '/library/collections/', 'badge' => 37],
    ['label' => 'More', 'icon' => 'more_horiz', 'expands' => true, 'id' => 'pvMore', 'children' => [
        ['label' => 'Academy',   'icon' => 'school',        'href' => '/academy/'],
        ['label' => 'Tips',      'icon' => 'emoji_objects', 'href' => '/tips/'],
        ['label' => 'Changelog', 'icon' => 'article',       'href' => '/changelog/'],
    ]],
];
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ws_sidenav — bare preview</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,400,0,0&display=swap">
<link rel="stylesheet" href="/design-system/platform-tokens.css">
<link rel="stylesheet" href="/includes/components/components.css?v=<?= @filemtime(ws_path('includes/components/components.css')) ?: '1' ?>">
<style>
    html, body { height: 100%; }
    body { margin: 0; display: flex; font-family: 'Inter', system-ui, sans-serif; background: var(--bg-surface); }
    .pv-app { flex: 1; min-width: 0; padding: var(--space-8); }
    .pv-app h1 { font-family: 'Fraunces', Georgia, serif; font-size: var(--text-h2); margin: 0 0 var(--space-3); color: var(--color-ink); }
    .pv-app p { margin: 0 0 var(--space-2); color: var(--text-muted); font-size: var(--text-small); max-width: 60ch; }
    .pv-app code { font-size: var(--text-meta); }
    .pv-sep { width: 1px; background: var(--gray-200); }
</style>
</head>
<body>

<?= ws_sidenav($nav, [
    'variant' => $both ? 'expanded' : $variant,
    'brand' => ['label' => 'Workshopr', 'sub' => 'Strategist', 'icon' => 'graph_3', 'href' => '/'],
    'ariaLabel' => 'Primary',
]) ?>

<?php if ($both): ?>
<div class="pv-sep"></div>
<?= ws_sidenav($nav, [
    'variant' => 'rail',
    'brand' => ['label' => 'Workshopr', 'icon' => 'graph_3', 'href' => '/'],
    'ariaLabel' => 'Primary, rail',
]) ?>
<?php endif; ?>

<main class="pv-app">
    <h1>App content</h1>
    <p>Bare preview of <code>ws_sidenav()</code> at full viewport height &mdash; no design-system chrome, which is the context the rail was built for.</p>
    <p>Switch with <code>?variant=rail</code>, <code>?variant=expanded</code>, or <code>?both=1</code>.</p>
    <p>Hover and tab through the destinations to see the Material 3 state layers, the pill indicator, and the rail's tooltips.</p>
</main>

</body>
</html>
