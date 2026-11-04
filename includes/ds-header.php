<?php
/**
 * Design System Microsite - Shared Header & Navigation
 * Inspired by Dogwood Design System (studiopimmit.com)
 *
 * Expected variables before include:
 *   $ds_page    - current page slug (e.g. 'philosophy', 'colors')
 *   $ds_title   - page <title> suffix
 */
$ds_page  = $ds_page  ?? 'index';
$ds_title = $ds_title ?? 'Design System';

// Detect if running on canvas.workshopr.io subdomain (doc root = design-system/)
$is_canvas = (($_SERVER['HTTP_HOST'] ?? '') === 'canvas.workshopr.io');
$ds_base   = $is_canvas ? '' : '/design-system';           // prefix for design-system pages/assets
$site_base = $is_canvas ? 'https://workshopr.io' : '';      // prefix for main site assets

$ds_nav = [
    // Getting Started
    ['slug' => 'getting-started/start-here',        'label' => 'Start Here',         'icon' => 'flag',               'section' => 'Getting Started'],
    ['slug' => 'index',             'label' => 'Overview',           'icon' => 'dashboard'],
    ['slug' => 'getting-started/philosophy',        'label' => 'Philosophy',         'icon' => 'lightbulb'],
    ['slug' => 'getting-started/voice',             'label' => 'Voice & Tone',       'icon' => 'record_voice_over'],
    ['slug' => 'getting-started/decisions',         'label' => 'Design Decisions',   'icon' => 'account_tree'],

    // Foundations
    ['slug' => 'foundations/colors',            'label' => 'Colors',             'icon' => 'palette',            'section' => 'Foundations'],
    ['slug' => 'foundations/typography',        'label' => 'Typography',         'icon' => 'format_size'],
    ['slug' => 'foundations/icons',             'label' => 'Icons',              'icon' => 'emoji_symbols'],
    ['slug' => 'foundations/spacing',           'label' => 'Spacing & Layout',   'icon' => 'space_dashboard'],
    ['slug' => 'foundations/elevation',         'label' => 'Elevation & Depth',  'icon' => 'layers'],
    ['slug' => 'foundations/animations',        'label' => 'Animations',         'icon' => 'animation'],
    ['slug' => 'foundations/illustrations',     'label' => 'Illustrations',      'icon' => 'brush'],

    // App Guides
    ['slug' => 'apps/app-mainsite',      'label' => 'Main Site',          'icon' => 'home',               'section' => 'App Guides'],
    ['slug' => 'apps/app-planner',       'label' => 'Planner',            'icon' => 'edit_note'],
    ['slug' => 'apps/app-facilitator',   'label' => 'Facilitator',        'icon' => 'groups'],
    ['slug' => 'apps/app-synthesize',    'label' => 'Synthesize',         'icon' => 'hub'],
    ['slug' => 'apps/app-coach',         'label' => 'Coach',              'icon' => 'psychology'],
    ['slug' => 'apps/app-intervention',  'label' => 'Intervention Cards', 'icon' => 'stacks'],
    ['slug' => 'apps/app-tips',          'label' => 'Tips',               'icon' => 'lightbulb_2'],
    ['slug' => 'apps/app-podcasts',      'label' => 'Podcasts',           'icon' => 'podcasts'],
    ['slug' => 'apps/app-dna',           'label' => 'Facilitator DNA',    'icon' => 'fingerprint'],
    ['slug' => 'apps/app-academy',       'label' => 'Academy',            'icon' => 'school'],
    ['slug' => 'apps/app-myworkshopr',   'label' => 'MyWorkshopr',        'icon' => 'dashboard'],
    ['slug' => 'apps/app-hybrid',        'label' => 'Hybrid Kit',         'icon' => 'all_inclusive'],
    ['slug' => 'apps/app-admin',         'label' => 'Admin Panel',        'icon' => 'admin_panel_settings'],
    ['slug' => 'apps/theming',           'label' => 'App Theming',        'icon' => 'tune'],

    // Components
    ['slug' => 'components/playground', 'label' => 'Playground', 'icon' => 'tune', 'section' => 'Components'],
    ['slug' => 'components/components',            'label' => 'Components',         'icon' => 'widgets',            'section' => 'Components'],
    ['slug' => 'components/component-library',     'label' => 'Component Library',  'icon' => 'deployed_code'],
    ['slug' => 'components/javascript',            'label' => 'In JavaScript',      'icon' => 'data_object'],
    ['slug' => 'components/demos/audio-player',   'label' => 'Audio Player',    'icon' => 'play_circle'],
    ['slug' => 'components/demos/audio-recorder', 'label' => 'Audio Recorder',  'icon' => 'mic'],
    ['slug' => 'components/demos/badge',      'label' => 'Badge',              'icon' => 'label'],
    ['slug' => 'components/demos/banner',     'label' => 'Banner',             'icon' => 'web_stories'],
    ['slug' => 'components/demos/button',     'label' => 'Button',             'icon' => 'smart_button'],
    ['slug' => 'components/demos/input',      'label' => 'Input',              'icon' => 'text_fields'],
    ['slug' => 'components/demos/select',     'label' => 'Select',             'icon' => 'arrow_drop_down_circle'],
    ['slug' => 'components/demos/range',      'label' => 'Range',              'icon' => 'tune'],
    ['slug' => 'components/demos/card',       'label' => 'Card',               'icon' => 'crop_portrait'],
    ['slug' => 'components/demos/avatar',     'label' => 'Avatar',             'icon' => 'account_circle'],
    ['slug' => 'components/demos/modal',      'label' => 'Modal',              'icon' => 'picture_in_picture'],
    ['slug' => 'components/demos/tabs',       'label' => 'Tabs',               'icon' => 'tab'],
    ['slug' => 'components/demos/toast',      'label' => 'Toast',              'icon' => 'notifications'],
    ['slug' => 'components/demos/tooltip',    'label' => 'Tooltip',            'icon' => 'help_outline'],
    ['slug' => 'components/demos/accordion',  'label' => 'Accordion',          'icon' => 'expand_more'],
    ['slug' => 'components/demos/progress',   'label' => 'Progress',           'icon' => 'linear_scale'],
    ['slug' => 'components/demos/alert',      'label' => 'Alert',              'icon' => 'warning'],
    ['slug' => 'components/demos/skeleton',       'label' => 'Skeleton',           'icon' => 'hourglass_empty'],
    ['slug' => 'components/demos/section-header', 'label' => 'Section Header',     'icon' => 'title'],
    ['slug' => 'components/demos/feature-card',   'label' => 'Feature Card',       'icon' => 'featured_play_list'],
    ['slug' => 'components/demos/level-up-grid',  'label' => 'Level Up Grid',      'icon' => 'grid_view'],
    ['slug' => 'components/demos/footer',         'label' => 'Footer',             'icon' => 'call_to_action'],
    ['slug' => 'components/demos/app-footer',     'label' => 'App Footer',         'icon' => 'horizontal_rule'],
    ['slug' => 'components/demos/stat',           'label' => 'Stat',               'icon' => 'tag'],
    ['slug' => 'components/demos/checklist',      'label' => 'Checklist',          'icon' => 'checklist'],
    ['slug' => 'components/demos/empty-state',    'label' => 'Empty State',        'icon' => 'inbox'],
    ['slug' => 'components/demos/breadcrumb',     'label' => 'Breadcrumb',         'icon' => 'chevron_right'],
    ['slug' => 'components/demos/hero',           'label' => 'Hero',               'icon' => 'web'],
    ['slug' => 'components/demos/listing-card',   'label' => 'Listing Card',       'icon' => 'view_agenda'],
    ['slug' => 'components/demos/choice-card',    'label' => 'Choice Card',        'icon' => 'alt_route'],
    ['slug' => 'components/demos/prompt-select',   'label' => 'Prompt Select',      'icon' => 'chat_bubble'],
    ['slug' => 'components/demos/form-row',       'label' => 'Form Row',           'icon' => 'input'],
    ['slug' => 'components/demos/layout',         'label' => 'Layout',             'icon' => 'dashboard'],
    ['slug' => 'components/demos/agenda',         'label' => 'Agenda',             'icon' => 'schedule'],
    ['slug' => 'components/demos/text',           'label' => 'Text',               'icon' => 'title'],
    ['slug' => 'components/demos/nav',            'label' => 'Navigation',         'icon' => 'menu'],
    ['slug' => 'components/demos/sidenav',        'label' => 'Side Nav (API)',     'icon' => 'left_panel_open'],
    ['slug' => 'components/demos/chip-input',         'label' => 'Chip Input',         'icon' => 'sell'],
    ['slug' => 'components/demos/radio-card-group',   'label' => 'Radio Card Group',   'icon' => 'grid_view'],
    ['slug' => 'components/demos/checkbox-card-group', 'label' => 'Checkbox Card Group','icon' => 'toggle_on'],
    ['slug' => 'components/demos/suggestion-card',    'label' => 'Suggestion Card',    'icon' => 'recommend'],
    ['slug' => 'components/demos/modal-footer',       'label' => 'Modal Footer',       'icon' => 'call_to_action'],
    ['slug' => 'components/demos/activity-badge',     'label' => 'Activity Badge',     'icon' => 'label_important'],
    ['slug' => 'components/demos/planner-card',          'label' => 'Planner Card',           'icon' => 'view_timeline'],
    ['slug' => 'components/demos/planner-library-rail',     'label' => 'Planner Library Rail',    'icon' => 'view_sidebar'],
    ['slug' => 'components/demos/planner-inspector-rail',    'label' => 'Planner Inspector Rail',   'icon' => 'splitscreen_right'],
    ['slug' => 'components/demos/planner-activity-inspector','label' => 'Planner Activity Inspector','icon' => 'info'],
    ['slug' => 'components/demos/energy-arc-card',           'label' => 'Energy Arc Card',          'icon' => 'ssid_chart'],
    ['slug' => 'components/demos/results-overlay',    'label' => 'Results Overlay',    'icon' => 'check_circle'],
    ['slug' => 'components/demos/app-bar',            'label' => 'App Bar',            'icon' => 'toolbar'],
    ['slug' => 'components/demos/app-dock',           'label' => 'App Dock',           'icon' => 'bottom_panel_open'],
    ['slug' => 'components/demos/phase-toolbar',      'label' => 'Phase Toolbar',      'icon' => 'dock_to_bottom'],
    ['slug' => 'components/demos/ai-mark',            'label' => 'AI Mark',            'icon' => 'auto_awesome'],
    ['slug' => 'components/demos/agent-status',       'label' => 'Agent Status',       'icon' => 'progress_activity'],
    ['slug' => 'components/demos/agent-steps',        'label' => 'Agent Steps',        'icon' => 'timeline'],
    ['slug' => 'components/demos/agent-check',        'label' => 'Agent Check',        'icon' => 'fact_check'],
    ['slug' => 'components/demos/agent-proposal',     'label' => 'Agent Proposal',     'icon' => 'rule'],
    ['slug' => 'components/demos/source-chip',        'label' => 'Source Chip',        'icon' => 'link'],
    ['slug' => 'components/demos/consent-row',        'label' => 'Consent Row',        'icon' => 'verified_user'],
    ['slug' => 'patterns/patterns',                  'label' => 'Patterns',           'icon' => 'grid_view'],
    ['slug' => 'patterns/utilities',                 'label' => 'Utility Classes',    'icon' => 'build'],
    ['slug' => 'patterns/page-templates',            'label' => 'Page Templates',     'icon' => 'description'],
    ['slug' => 'apps/app-shell-layouts',        'label' => 'App Shell Layouts',  'icon' => 'space_dashboard'],
    ['slug' => 'apps/app-screen-components',    'label' => 'App Screen Components','icon' => 'category'],
    ['slug' => 'patterns/composition',               'label' => 'Composition',        'icon' => 'dashboard_customize'],
    ['slug' => 'patterns/when-to-use',               'label' => 'When to Use',        'icon' => 'help_center'],

    // Redesign — the new-direction track. Components here are global and
    // shipping, but they belong to the app-shell redesign rather than to the
    // established component set, so they are documented separately.
    ['slug' => 'redesign/index',    'label' => 'About the Redesign', 'icon' => 'auto_awesome',       'section' => 'Redesign'],
    ['slug' => 'redesign/sidenav',  'label' => 'Side Navigation',    'icon' => 'left_panel_open'],
    ['slug' => 'redesign/sidenav-playground', 'label' => 'Side Nav Playground', 'icon' => 'tune'],
    ['slug' => 'redesign/sidenav-preview',    'label' => 'Side Nav Preview',    'icon' => 'fullscreen'],
    ['slug' => 'redesign/dashboard',          'label' => 'Dashboard Patterns',  'icon' => 'dashboard'],

    // Resources
    ['slug' => 'resources/presentations',     'label' => 'Presentations',      'icon' => 'slideshow',          'section' => 'Resources'],
    ['slug' => 'resources/video',             'label' => 'Video',              'icon' => 'videocam'],
    ['slug' => 'resources/accessibility',     'label' => 'Accessibility',      'icon' => 'accessibility_new'],
    ['slug' => 'resources/tokens',            'label' => 'Token Reference',    'icon' => 'code'],
    ['slug' => 'changelog',         'label' => 'Changelog',          'icon' => 'history'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__ . '/../../includes/analytics-ga.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($ds_title, ENT_QUOTES, 'UTF-8'); ?> - Canvas Design System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,400;1,9..144,500&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet">

    <!-- Design Tokens -->
    <link rel="stylesheet" href="<?= $ds_base ?>/platform-tokens.css">
    <!-- Component Styles (real ws_* component library) -->
    <link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">
    <!-- Design system app badge styles -->
    <link rel="stylesheet" href="<?= $ds_base ?>/components/components.css">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="<?= $site_base ?>/images/favicon.svg">

    <style>
        /* ============================
           Workshopr Design System Shell
           Inspired by Dogwood (studiopimmit.com)
           ============================ */

        /* --- Reset --- */
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        /* --- Base --- */
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, system-ui, sans-serif;
            background: #ffffff;
            color: #0f172a;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        ::selection {
            background-color: #faf0c0;
            color: #1A2744;
        }

        /* --- Custom Scrollbar --- */
        .ds-sidebar::-webkit-scrollbar { width: 5px; }
        .ds-sidebar::-webkit-scrollbar-track { background: transparent; }
        .ds-sidebar::-webkit-scrollbar-thumb { background-color: #e2e8f0; border-radius: 9999px; }
        .ds-sidebar::-webkit-scrollbar-thumb:hover { background-color: #cbd5e1; }

        /* --- Animations --- */
        @keyframes ds-fade-up {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .ds-fade-up { animation: ds-fade-up 0.6s cubic-bezier(0.22, 1, 0.36, 1) forwards; opacity: 0; }
        .ds-stagger-1 { animation-delay: 0ms; }
        .ds-stagger-2 { animation-delay: 100ms; }
        .ds-stagger-3 { animation-delay: 200ms; }
        .ds-stagger-4 { animation-delay: 300ms; }
        .ds-stagger-5 { animation-delay: 400ms; }

        /* ========== Top Bar ========== */
        .ds-topbar {
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
            padding: 0 24px;
            background-color: #2C2416;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.12) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.12) 1px, transparent 1px);
            background-size: 24px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .ds-topbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #FAF7F2;
        }

        .ds-brand-icon {
            width: 28px;
            height: 28px;
            flex-shrink: 0;
        }

        .ds-topbar-brand span {
            font-family: 'Fraunces', Georgia, serif;
            font-size: 17px;
            font-weight: 600;
            letter-spacing: -0.02em;
            color: #FAF7F2;
        }

        .ds-topbar-brand em {
            font-style: normal;
            font-family: 'Inter', sans-serif;
            font-size: 11px;
            font-weight: 600;
            color: #A8A29E;
            margin-left: 10px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .ds-topbar-actions {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .ds-topbar-link {
            font-size: 13px;
            font-weight: 500;
            color: #A8A29E;
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 6px;
            transition: all 150ms ease;
        }

        .ds-topbar-link:hover {
            color: #FAF7F2;
            background: rgba(255, 255, 255, 0.08);
        }

        .ds-menu-toggle {
            display: none;
            background: none;
            border: none;
            color: #A8A29E;
            cursor: pointer;
            padding: 6px;
            border-radius: 6px;
            transition: background 150ms ease;
        }

        .ds-menu-toggle:hover {
            background: rgba(255, 255, 255, 0.08);
        }

        /* ========== Layout ========== */
        .ds-layout {
            display: flex;
            min-height: calc(100vh - 64px);
        }

        /* ========== Sidebar ========== */
        .ds-sidebar {
            width: 280px;
            flex-shrink: 0;
            background: #f8fafc;
            border-right: 1px solid #e2e8f0;
            padding: 20px 0;
            position: sticky;
            top: 64px;
            height: calc(100vh - 64px);
            overflow-y: auto;
        }

        .ds-nav { list-style: none; }

        .ds-nav-group { border-bottom: 1px solid #e2e8f0; }
        .ds-nav-group:last-child { border-bottom: none; }

        .ds-nav-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 24px 14px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #94a3b8;
            cursor: pointer;
            user-select: none;
            transition: color 150ms ease;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
        }

        .ds-nav-group:first-child .ds-nav-section { padding-top: 8px; }

        .ds-nav-section:hover { color: #64748b; }

        .ds-nav-section__chevron {
            font-size: 18px;
            transition: transform 200ms ease;
            color: #cbd5e1;
        }

        .ds-nav-group.open .ds-nav-section__chevron {
            transform: rotate(180deg);
        }

        .ds-nav-group.open .ds-nav-section {
            color: #64748b;
        }

        /* Collapse pattern: hidden unless the group has `.open`. No height cap
           so long sections render in full (Components has ~41 items). The items
           fade+slide in via the inner transform so it still feels animated. */
        .ds-nav-items {
            display: none;
        }

        .ds-nav-items__inner {
            list-style: none;
            animation: ds-nav-items-in 220ms cubic-bezier(0.16, 1, 0.3, 1);
        }

        .ds-nav-group.open .ds-nav-items {
            display: block;
        }

        @keyframes ds-nav-items-in {
            from { opacity: 0; transform: translateY(-4px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .ds-nav-item a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 24px;
            font-size: 14px;
            font-weight: 500;
            color: #64748b;
            text-decoration: none;
            transition: all 150ms ease;
            border-radius: 0;
        }

        .ds-nav-item a:hover {
            color: #0f172a;
            background: rgba(0, 0, 0, 0.03);
        }

        .ds-nav-item a .material-symbols-outlined {
            font-size: 18px;
            color: #94a3b8;
            transition: color 150ms ease;
        }

        .ds-nav-item a:hover .material-symbols-outlined {
            color: #64748b;
        }

        .ds-nav-item.active a {
            color: #486581;
            background: rgba(72, 101, 129, 0.08);
            font-weight: 600;
        }

        .ds-nav-item.active a .material-symbols-outlined {
            color: #486581;
        }

        /* ========== Main Content ========== */
        .ds-main {
            flex: 1;
            min-width: 0;
            padding: 48px 56px 96px;
            max-width: 860px;
            background: #ffffff;
        }

        /* --- Page Header --- */
        .ds-page-header {
            margin-bottom: 48px;
        }

        .ds-page-header h1 {
            font-family: 'Fraunces', Georgia, serif;
            font-size: clamp(1.75rem, 4vw, 2.25rem);
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.03em;
            line-height: 1.15;
            margin-bottom: 4px;
        }

        /* Dogwood-style decorative underline */
        .ds-page-header h1::after {
            content: '';
            display: block;
            width: 48px;
            height: 3px;
            background: linear-gradient(90deg, #E54D4D, #F59E0B);
            border-radius: 2px;
            margin-top: 16px;
        }

        .ds-page-header p {
            font-size: 16px;
            color: #64748b;
            max-width: 560px;
            line-height: 1.7;
            margin-top: 16px;
        }

        /* Artifact maturity badge (templates/README.md) — sits inside the h1:
           <h1>Name <span class="ds-status ds-status--beta">beta</span></h1> */
        .ds-status {
            display: inline-block;
            vertical-align: middle;
            margin-left: 10px;
            padding: 3px 10px;
            border-radius: 999px;
            font-family: 'Inter', sans-serif;
            font-size: 0.6875rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }
        .ds-status--stable { background: #DCFCE7; color: #166534; }
        .ds-status--beta { background: #FEF3C7; color: #92400E; }
        .ds-status--deprecated { background: #FEE2E2; color: #991B1B; }

        /* --- Sections --- */
        .ds-section {
            margin-bottom: 64px;
        }

        .ds-section-title {
            font-family: 'Fraunces', Georgia, serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 12px;
            letter-spacing: -0.02em;
            padding-bottom: 12px;
            border-bottom: 1px solid #e2e8f0;
        }

        .ds-section-desc {
            font-size: 15px;
            color: #64748b;
            margin-bottom: 24px;
            line-height: 1.7;
        }

        .ds-subsection {
            margin-bottom: 36px;
        }

        .ds-subsection-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 12px;
        }

        /* --- Cards --- */
        .ds-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 16px;
            transition: box-shadow 200ms ease, border-color 200ms ease;
        }

        .ds-card:hover {
            box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.07), 0 2px 4px -2px rgba(15, 23, 42, 0.05);
            border-color: #cbd5e1;
        }

        /* --- Code --- */
        .ds-code {
            background: #0f172a;
            color: #e2e8f0;
            padding: 16px 20px;
            border-radius: 8px;
            font-family: 'JetBrains Mono', 'SF Mono', 'Fira Code', monospace;
            font-size: 13px;
            line-height: 1.7;
            overflow-x: auto;
            margin: 12px 0;
            position: relative;
        }

        .ds-code-copy {
            position: absolute;
            top: 8px;
            right: 8px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 6px;
            color: #94a3b8;
            font-size: 12px;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            cursor: pointer;
            transition: all 150ms ease;
            opacity: 0;
            pointer-events: none;
        }

        .ds-code:hover .ds-code-copy {
            opacity: 1;
            pointer-events: auto;
        }

        .ds-code-copy:hover {
            background: rgba(255, 255, 255, 0.14);
            color: #e2e8f0;
        }

        .ds-code-copy .material-symbols-outlined { font-size: 14px; }

        .ds-code-copy--copied {
            color: #4ade80 !important;
            border-color: rgba(74, 222, 128, 0.3);
        }

        /* --- Responsive Preview --- */
        .ds-responsive-bar {
            display: flex;
            align-items: center;
            gap: 4px;
            margin-bottom: 8px;
            padding: 4px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            width: fit-content;
        }

        .ds-responsive-btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 5px 12px;
            background: none;
            border: none;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            color: #64748b;
            cursor: pointer;
            transition: all 150ms ease;
        }

        .ds-responsive-btn:hover { background: #e2e8f0; color: #0f172a; }
        .ds-responsive-btn.active { background: #0f172a; color: #fff; }
        .ds-responsive-btn .material-symbols-outlined { font-size: 16px; }

        .ds-demo-wrap {
            transition: max-width 300ms ease;
            max-width: 100%;
        }

        .ds-demo-wrap--tablet { max-width: 768px; }
        .ds-demo-wrap--mobile { max-width: 375px; }

        .ds-code-inline {
            background: #f1f5f9;
            color: #486581;
            padding: 2px 7px;
            border-radius: 4px;
            font-family: 'JetBrains Mono', 'SF Mono', monospace;
            font-size: 13px;
        }

        /* --- Tables --- */
        .ds-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            margin: 12px 0;
        }

        .ds-table th {
            text-align: left;
            font-weight: 600;
            color: #475569;
            padding: 10px 12px;
            border-bottom: 2px solid #e2e8f0;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .ds-table td {
            padding: 12px;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
        }

        .ds-table tr:last-child td { border-bottom: none; }

        .ds-table tr:nth-child(even) td {
            background: #f8fafc;
        }

        .ds-table code {
            background: #f1f5f9;
            padding: 2px 6px;
            border-radius: 4px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            color: #486581;
        }

        /* --- Grids --- */
        .ds-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        /* Demo layout: a row of components, a readable measure, a line of space above. */
        .ds-row { display: flex; flex-wrap: wrap; gap: var(--space-4); align-items: center; }
        .ds-measure { max-width: 34rem; }
        .ds-gap-above { margin-top: var(--space-3); }
        .ds-prose { margin: 0; line-height: var(--leading-relaxed); }
        .ds-grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; }
        .ds-grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }

        /* --- Notes --- */
        .ds-note {
            background: #fefdf4;
            border: 1px solid #faf0c0;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 13px;
            color: #7a5520;
            display: flex;
            align-items: flex-start;
            gap: 8px;
            margin: 12px 0;
        }

        .ds-note .material-symbols-outlined {
            font-size: 18px;
            flex-shrink: 0;
            margin-top: 1px;
            color: #d4a832;
        }

        /* --- Do / Don't --- */
        .ds-do-dont { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin: 16px 0; }

        .ds-do, .ds-dont { border-radius: 8px; padding: 16px; font-size: 14px; }

        .ds-do {
            background: #f0faf4;
            border: 1px solid #d4edda;
            color: #305a3c;
        }

        .ds-dont {
            background: #fef2f4;
            border: 1px solid #fde3e8;
            color: #93162c;
        }

        .ds-do strong, .ds-dont strong { display: block; margin-bottom: 4px; }

        /* ========== Mobile ========== */
        @media (max-width: 768px) {
            .ds-menu-toggle { display: block; }

            .ds-sidebar {
                position: fixed;
                left: -280px;
                top: 64px;
                z-index: 90;
                width: 280px;
                height: calc(100vh - 64px);
                transition: left 200ms ease;
                box-shadow: 4px 0 24px rgba(0, 0, 0, 0.08);
            }

            .ds-sidebar.open { left: 0; }

            .ds-overlay {
                display: none;
                position: fixed;
                inset: 64px 0 0 0;
                background: rgba(0, 0, 0, 0.3);
                z-index: 80;
                backdrop-filter: blur(2px);
            }

            .ds-overlay.open { display: block; }

            .ds-main { padding: 28px 20px 60px; }

            .ds-grid-2, .ds-grid-3, .ds-grid-4 { grid-template-columns: 1fr; }
            .ds-do-dont { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<!-- Top Bar -->
<header class="ds-topbar">
    <a href="<?= $ds_base ?>/" class="ds-topbar-brand">
        <svg class="ds-brand-icon" viewBox="0 -960 960 960" xmlns="http://www.w3.org/2000/svg">
            <path fill="#E54D4D" d="M480-80q-50 0-85-35t-35-85q0-5 .5-11t1.5-11l-83-47q-16 14-36 21.5t-43 7.5q-50 0-85-35t-35-85q0-50 35-85t85-35q24 0 45 9t38 25l119-60q-3-23 2.5-45t19.5-41l-34-52q-7 2-14.5 3t-15.5 1q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 20-6.5 38.5T456-688l35 52q8-2 15-3t15-1q17 0 32 4t29 12l66-54q-4-10-6-20.5t-2-21.5q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35q-17 0-32-4.5T699-617l-66 55q4 10 6 20.5t2 21.5q0 50-35 85t-85 35q-24 0-45.5-9T437-434l-118 59q2 9 1.5 18t-2.5 18l84 48q16-14 35.5-21.5T480-320q50 0 85 35t35 85q0 50-35 85t-85 35ZM200-320q17 0 28.5-11.5T240-360q0-17-11.5-28.5T200-400q-17 0-28.5 11.5T160-360q0 17 11.5 28.5T200-320Zm160-400q17 0 28.5-11.5T400-760q0-17-11.5-28.5T360-800q-17 0-28.5 11.5T320-760q0 17 11.5 28.5T360-720Zm120 560q17 0 28.5-11.5T520-200q0-17-11.5-28.5T480-240q-17 0-28.5 11.5T440-200q0 17 11.5 28.5T480-160Zm40-320q17 0 28.5-11.5T560-520q0-17-11.5-28.5T520-560q-17 0-28.5 11.5T480-520q0 17 11.5 28.5T520-480Zm240-200q17 0 28.5-11.5T800-720q0-17-11.5-28.5T760-760q-17 0-28.5 11.5T720-720q0 17 11.5 28.5T760-680Z"/>
        </svg>
        <span>Canvas <em>Design System</em></span>
    </a>
    <div class="ds-topbar-actions">
        <a href="<?= $site_base ?>/" class="ds-topbar-link">Main Site</a>
        <a href="<?= $ds_base ?>/platform-tokens.css" class="ds-topbar-link" target="_blank">Tokens</a>
        <button class="ds-menu-toggle" onclick="toggleSidebar()" aria-label="Toggle navigation">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>
</header>

<!-- Layout -->
<div class="ds-layout">
    <!-- Overlay for mobile -->
    <div class="ds-overlay" id="ds-overlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <nav class="ds-sidebar" id="ds-sidebar">
        <ul class="ds-nav">
            <?php
            // Group nav items by section
            $sections = [];
            $currentSection = null;
            foreach ($ds_nav as $item) {
                if (!empty($item['section'])) {
                    $currentSection = $item['section'];
                    if (!isset($sections[$currentSection])) {
                        $sections[$currentSection] = [];
                    }
                }
                if ($currentSection) {
                    $sections[$currentSection][] = $item;
                }
            }

            $defaultOpen = ['Getting Started', 'Foundations'];

            foreach ($sections as $sectionName => $items):
                // Check if this section contains the active page
                $sectionHasActive = false;
                foreach ($items as $item) {
                    if ($ds_page === $item['slug']) {
                        $sectionHasActive = true;
                        break;
                    }
                }
                $isOpen = $sectionHasActive || in_array($sectionName, $defaultOpen);
            ?>
            <li class="ds-nav-group<?= $isOpen ? ' open' : '' ?>">
                <button class="ds-nav-section" onclick="toggleNavSection(this)">
                    <?= $sectionName ?>
                    <span class="material-symbols-outlined ds-nav-section__chevron">expand_more</span>
                </button>
                <div class="ds-nav-items">
                    <ul class="ds-nav-items__inner">
                        <?php foreach ($items as $item): ?>
                        <li class="ds-nav-item <?= $ds_page === $item['slug'] ? 'active' : '' ?>">
                            <a href="<?= $ds_base ?>/<?= $item['slug'] === 'index' ? '' : $item['slug'] . '.php' ?>">
                                <span class="material-symbols-outlined"><?= $item['icon'] ?></span>
                                <?= $item['label'] ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <!-- Main Content -->
    <main class="ds-main">
