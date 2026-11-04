<?php
/**
 * AppSwitcher — portable mirror of the "App Switcher (Property Switcher)" pattern.
 *
 * The phase-grouped product popover from the unified header (.gn-switcher).
 * Each phase column lists the apps that belong to that facilitation stage.
 *
 * @param array $options
 *   title(string), subtitle(string), active(app key, highlights current app),
 *   phases(array) — defaults to the platform phase map. Each phase:
 *     ['key'=>'learn','label'=>'LEARN','icon'=>'menu_book','apps'=>[
 *        ['key'=>'library','name'=>'Library','icon'=>'menu_book','href'=>'/library/',
 *         'desc'=>'Workshop & exercise library','beta'=>false,'locked'=>false],
 *     ]]
 *   id, class, attrs[]
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function app_switcher(array $options = []): string
{
    $title    = $options['title'] ?? 'Products';
    $subtitle = $options['subtitle'] ?? 'Tools for every stage of facilitation';
    $active   = $options['active'] ?? null;
    $id       = $options['id'] ?? 'gn-app-switcher';
    $class    = $options['class'] ?? '';
    $attrs    = $options['attrs'] ?? [];

    $phases = $options['phases'] ?? [
        ['key' => 'learn', 'label' => 'LEARN', 'icon' => 'menu_book', 'apps' => [
            ['key' => 'library', 'name' => 'Library', 'icon' => 'menu_book', 'href' => '/library/', 'desc' => 'Workshop & exercise library'],
            ['key' => 'academy', 'name' => 'Academy', 'icon' => 'school', 'href' => '/academy/', 'desc' => 'Learn facilitation skills'],
        ]],
        ['key' => 'plan', 'label' => 'PLAN', 'icon' => 'edit_calendar', 'apps' => [
            ['key' => 'planner', 'name' => 'Planner', 'icon' => 'table_view', 'href' => '/planner/', 'desc' => 'Build workshop agendas', 'beta' => true, 'locked' => true],
            ['key' => 'toolkits', 'name' => 'Toolkits', 'icon' => 'build_circle', 'href' => '/toolkits/', 'desc' => 'Tools for facilitation'],
        ]],
        ['key' => 'facilitate', 'label' => 'FACILITATE', 'icon' => 'record_voice_over', 'apps' => [
            ['key' => 'facilitator', 'name' => 'Facilitator', 'icon' => 'interactive_space', 'href' => '/facilitator/', 'desc' => 'Real-time workshop management', 'beta' => true, 'locked' => true],
            ['key' => 'intervention', 'name' => 'Intervention Cards', 'icon' => 'stacks', 'href' => '/intervention/', 'desc' => 'In-session rescue prompts'],
            ['key' => 'tips', 'name' => 'Tips', 'icon' => 'lightbulb', 'href' => '/tips/', 'desc' => 'Quick actionable workshop guidance'],
        ]],
        ['key' => 'reflect', 'label' => 'REFLECT', 'icon' => 'self_improvement', 'apps' => [
            ['key' => 'dna', 'name' => "Facilitator's DNA Quiz", 'icon' => 'genetics', 'href' => '/dna/', 'desc' => 'Discover your facilitation style'],
            ['key' => 'coach', 'name' => 'Coach', 'icon' => 'sports', 'href' => '/coach/', 'desc' => 'AI-powered workshop reflection'],
        ]],
    ];

    $cols = '';
    foreach ($phases as $phase) {
        $phaseKey = $phase['key'] ?? '';

        $apps = '';
        foreach ($phase['apps'] ?? [] as $app) {
            $isCurrent = $active !== null && ($app['key'] ?? null) === $active;
            $desc = $app['desc'] ?? '';

            $pill = !empty($app['beta']) ? '<span class="gn-switcher__pill">BETA</span>' : '';
            $lock = !empty($app['locked'])
                ? '<svg class="gn-switcher__lock" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-label="Pro"><rect x="4" y="11" width="16" height="10" rx="2"/><path d="M8 11V8a4 4 0 0 1 8 0v3"/></svg>'
                : '';
            $descHtml = $desc !== '' ? '<span class="gn-switcher__app-desc">' . e($desc) . '</span>' : '';

            $appClass = cx([
                'gn-switcher__app',
                'gn-switcher__app--' . $phaseKey,
                $isCurrent ? 'is-current' : '',
            ]);

            $apps .= '<a class="' . $appClass . '" href="' . e($app['href'] ?? '#') . '">'
                . '<span class="gn-switcher__app-icon" aria-hidden="true">' . icon($app['icon'] ?? 'apps') . '</span>'
                . '<span class="gn-switcher__app-body">'
                . '<span class="gn-switcher__app-name">' . e($app['name'] ?? '') . $pill . $lock . '</span>'
                . $descHtml
                . '</span>'
                . '</a>';
        }

        $cols .= '<section class="gn-switcher__col" data-phase="' . e($phaseKey) . '">'
            . '<header class="gn-switcher__col-head gn-switcher__col-head--' . e($phaseKey) . '">'
            . icon($phase['icon'] ?? 'apps')
            . '<span>' . e($phase['label'] ?? '') . '</span>'
            . '</header>'
            . $apps
            . '</section>';
    }

    $classString = cx(['gn-switcher', $class]);

    $attrString = attrs(array_merge(
        ['id' => $id],
        ['hidden' => true, 'role' => 'dialog', 'aria-label' => 'Switch apps'],
        $attrs
    ));

    return '<div class="' . $classString . '" ' . $attrString . '>'
        . '<header class="gn-switcher__head">'
        . '<h2 class="gn-switcher__title">' . e($title) . '</h2>'
        . '<p class="gn-switcher__sub">' . e($subtitle) . '</p>'
        . '</header>'
        . '<div class="gn-switcher__grid">' . $cols . '</div>'
        . '</div>';
}
