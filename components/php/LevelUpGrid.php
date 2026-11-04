<?php
/**
 * LevelUpGrid — portable mirror of ws_level_up_grid() / includes/components/level-up-grid.php
 *
 * A responsive grid of Workshopr app cards grouped by facilitation phase
 * (Learn, Plan, Facilitate, Reflect). Cross-promotes the Workshopr ecosystem.
 *
 * @param array $options
 *   - current_app    (string) App key to exclude from the grid
 *   - eyebrow        (string) Small label above the title
 *   - title          (string) Section heading
 *   - apps           (array)  Override the default app catalog (keyed by app key)
 *   - group_by_phase (bool)   Render per-phase sub-sections with prose intros
 *   - phase_copy     (array)  Override default phase title/description copy
 *   - id             (string) Section ID
 *   - class          (string) Additional CSS classes
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function level_up_grid(array $options = []): string
{
    $currentApp   = $options['current_app'] ?? null;
    $eyebrow      = $options['eyebrow'] ?? 'More from Workshopr';
    $title        = $options['title'] ?? 'Level Up Your Facilitation';
    $id           = $options['id'] ?? null;
    $extraClass   = $options['class'] ?? '';
    $groupByPhase = !empty($options['group_by_phase']);

    $defaultPhaseCopy = [
        'learn'      => ['title' => 'Learn.', 'description' => ''],
        'plan'       => ['title' => 'Plan.', 'description' => ''],
        'facilitate' => ['title' => 'Facilitate.', 'description' => ''],
        'reflect'    => ['title' => 'Reflect.', 'description' => ''],
    ];
    $phaseCopy = array_replace_recursive($defaultPhaseCopy, $options['phase_copy'] ?? []);

    $defaultApps = [
        'library'      => ['title' => 'Workshop Library', 'description' => '300+ workshop templates & facilitation guides', 'icon' => 'auto_stories', 'phase' => 'learn', 'href' => '/library/', 'link_text' => 'Browse Library'],
        'academy'      => ['title' => 'Academy', 'description' => 'Free ebooks, toolkits, and facilitation learning paths', 'icon' => 'school', 'phase' => 'learn', 'href' => '/academy/', 'link_text' => 'Start Learning'],
        'podcasts'     => ['title' => 'Podcast', 'description' => 'Deep dives and interviews on facilitation craft', 'icon' => 'podcasts', 'phase' => 'learn', 'href' => '/podcasts/', 'link_text' => 'Listen Now'],
        'planner'      => ['title' => 'Planner', 'description' => 'Drag-and-drop agenda builder with AI assistance', 'icon' => 'view_day', 'phase' => 'plan', 'href' => '/planner/', 'link_text' => 'Open Planner'],
        'hybrid'       => ['title' => 'Hybrid Toolkit', 'description' => 'Playbooks and checklists for hybrid workshops', 'icon' => 'devices', 'phase' => 'plan', 'href' => '/toolkits/hybrid/', 'link_text' => 'Get the Kit'],
        'facilitator'  => ['title' => 'Facilitator', 'description' => 'Full-screen command center for live sessions', 'icon' => 'interactive_space', 'phase' => 'facilitate', 'href' => '/facilitator/', 'link_text' => 'Run a Session'],
        'sidekick'     => ['title' => 'Sidekick', 'description' => 'Chrome extension — your script in a side panel', 'icon' => 'picture_in_picture_alt', 'phase' => 'facilitate', 'href' => '/sidekick/', 'link_text' => 'Install Sidekick'],
        'intervention' => ['title' => 'Intervention Cards', 'description' => '37 cards for handling difficult workshop moments', 'icon' => 'stacks', 'phase' => 'facilitate', 'href' => '/intervention/', 'link_text' => 'Get Cards'],
        'tips'         => ['title' => 'Facilitation Tips', 'description' => '60+ actionable tips for better workshops', 'icon' => 'lightbulb', 'phase' => 'facilitate', 'href' => '/tips/', 'link_text' => 'Browse Tips'],
        'dna'          => ['title' => "Facilitator's DNA", 'description' => 'Discover your natural facilitation style', 'icon' => 'genetics', 'phase' => 'reflect', 'href' => '/dna/', 'link_text' => 'Take the Quiz'],
        'coach'        => ['title' => 'AI Coach', 'description' => 'AI guidance before, during, and after sessions', 'icon' => 'sports', 'phase' => 'reflect', 'href' => '/coach/', 'link_text' => 'Try Coach'],
        'roi'          => ['title' => 'ROI Calculator', 'description' => 'Quantify the business value of your workshops', 'icon' => 'calculate', 'phase' => 'reflect', 'href' => '/roi/', 'link_text' => 'Calculate ROI'],
    ];

    $apps = $options['apps'] ?? $defaultApps;

    if ($currentApp && isset($apps[$currentApp])) {
        unset($apps[$currentApp]);
    }

    $classString = cx([
        'ws-level-up',
        $extraClass,
    ]);

    $attrString = attrs($id ? ['id' => $id] : []);
    if ($attrString !== '') {
        $attrString = ' ' . $attrString;
    }

    $renderCard = function (string $key, array $app): string {
        return '<a href="' . e($app['href'] ?? '') . '"'
            . ' class="ws-level-up__card ws-level-up__card--' . e($app['phase'] ?? '') . '"'
            . ' data-phase="' . e($app['phase'] ?? '') . '"'
            . ' data-app="' . e($key) . '">'
            . '<div class="ws-level-up__card-icon">' . icon($app['icon'] ?? '') . '</div>'
            . '<h3 class="ws-level-up__card-title">' . e($app['title'] ?? '') . '</h3>'
            . '<p class="ws-level-up__card-desc">' . e($app['description'] ?? '') . '</p>'
            . '<span class="ws-level-up__card-link">' . e($app['link_text'] ?? '') . icon('arrow_forward') . '</span>'
            . '</a>';
    };

    $body = '';
    if ($groupByPhase) {
        $byPhase = ['learn' => [], 'plan' => [], 'facilitate' => [], 'reflect' => []];
        foreach ($apps as $key => $app) {
            $phase = $app['phase'] ?? null;
            if ($phase && isset($byPhase[$phase])) {
                $byPhase[$phase][$key] = $app;
            }
        }
        foreach ($byPhase as $phaseKey => $phaseApps) {
            if (empty($phaseApps)) {
                continue;
            }
            $copy    = $phaseCopy[$phaseKey] ?? ['title' => ucfirst($phaseKey), 'description' => ''];
            $gridMod = count($phaseApps) <= 3 ? ' ws-level-up__grid--3' : '';
            $cards   = '';
            foreach ($phaseApps as $key => $app) {
                $cards .= $renderCard($key, $app);
            }
            $desc = !empty($copy['description'])
                ? '<p class="ws-level-up__phase-desc">' . e($copy['description']) . '</p>'
                : '';
            $body .= '<div class="ws-level-up__phase ws-level-up__phase--' . e($phaseKey) . '">'
                . '<div class="ws-level-up__phase-head">'
                . '<h3 class="ws-level-up__phase-title">' . e($copy['title']) . '</h3>'
                . $desc
                . '</div>'
                . '<div class="ws-level-up__grid' . $gridMod . '">' . $cards . '</div>'
                . '</div>';
        }
    } else {
        $cards = '';
        foreach ($apps as $key => $app) {
            $cards .= $renderCard($key, $app);
        }
        $body = '<div class="ws-level-up__grid">' . $cards . '</div>';
    }

    return '<section class="' . $classString . '"' . $attrString . '>'
        . '<div class="ws-level-up__container">'
        . '<div class="ws-level-up__header">'
        . '<span class="ws-level-up__eyebrow">' . icon('apps') . e($eyebrow) . '</span>'
        . '<h2 class="ws-level-up__title">' . e($title) . '</h2>'
        . '</div>'
        . $body
        . '</div>'
        . '</section>';
}
