<?php
/**
 * EmptyState — portable mirror of ws_empty_state() / includes/components/empty-state.php
 *
 * @param string $title    Empty state title
 * @param array  $options  description, icon (default: inbox), action, actionHref,
 *                         actionVariant (default: primary), id, class
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';
require_once __DIR__ . '/Button.php';

function empty_state(string $title, array $options = []): string
{
    $description   = $options['description'] ?? null;
    $iconName      = $options['icon'] ?? 'inbox';
    $action        = $options['action'] ?? null;
    $actionHref    = $options['actionHref'] ?? null;
    $actionVariant = $options['actionVariant'] ?? 'primary';
    $id            = $options['id'] ?? null;
    $class         = $options['class'] ?? '';

    $classString = cx([
        'ws-empty-state',
        $class,
    ]);

    $attrString = attrs($id ? ['id' => $id] : []);
    if ($attrString !== '') {
        $attrString = ' ' . $attrString;
    }

    $html = '<div class="' . $classString . '"' . $attrString . '>';

    if ($iconName) {
        $html .= '<div class="ws-empty-state__icon">' . icon($iconName) . '</div>';
    }

    $html .= '<h3 class="ws-empty-state__title">' . e($title) . '</h3>';

    if ($description) {
        $html .= '<p class="ws-empty-state__desc">' . e($description) . '</p>';
    }

    if ($action) {
        $html .= '<div class="ws-empty-state__action">'
            . button($action, ['variant' => $actionVariant, 'href' => $actionHref])
            . '</div>';
    }

    $html .= '</div>';

    return $html;
}
