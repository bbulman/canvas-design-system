<?php
/**
 * SuggestionCard — portable mirror of ws_suggestion_card() / includes/components/suggestion-card.php
 *
 * Activity suggestion card with type badge, metadata, and add button.
 *
 * @param array $options id, name, type(exercise|icebreaker|break|custom),
 *                       duration(int, minutes), category, reason, icon, class
 *
 * The add button is wired up by the shared components.js behavior via the
 * data-id / data-type attributes rendered here.
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function suggestion_card(array $options): string
{
    $itemId   = $options['id'] ?? '';
    $name     = $options['name'] ?? '';
    $type     = $options['type'] ?? 'exercise';
    $duration = $options['duration'] ?? 0;
    $category = $options['category'] ?? null;
    $reason   = $options['reason'] ?? null;
    $ico      = $options['icon'] ?? null;
    $class    = $options['class'] ?? '';

    $classString = cx([
        'ws-suggestion-card',
        'ws-suggestion-card--' . $type,
        $class,
    ]);

    $defaultIcons = [
        'exercise'   => 'fitness_center',
        'icebreaker' => 'ac_unit',
        'break'      => 'coffee',
        'custom'     => 'extension',
    ];
    $iconName = $ico ?: ($defaultIcons[$type] ?? 'extension');

    $html = '<div class="' . $classString . '" data-id="' . e((string) $itemId)
        . '" data-type="' . e($type) . '">'
        . '<div class="ws-suggestion-card__icon">' . icon($iconName) . '</div>'
        . '<div class="ws-suggestion-card__content">'
        . '<div class="ws-suggestion-card__header">'
        . '<span class="ws-suggestion-card__name">' . e($name) . '</span>'
        . '</div>'
        . '<div class="ws-suggestion-card__meta">'
        . '<span class="ws-activity-badge ws-activity-badge--' . e($type) . '">'
        . e(ucfirst($type)) . '</span>'
        . '<span>' . (int) $duration . ' min</span>';

    if ($category) {
        $html .= '<span>' . e($category) . '</span>';
    }

    $html .= '</div>';

    if ($reason) {
        $html .= '<p class="ws-suggestion-card__reason">' . e($reason) . '</p>';
    }

    $html .= '</div>'
        . '<button class="ws-suggestion-card__add" title="Add to agenda" type="button">'
        . icon('add')
        . '</button>'
        . '</div>';

    return $html;
}
