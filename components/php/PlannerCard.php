<?php
/**
 * PlannerCard — portable mirror of ws_planner_card() / includes/components/planner-card.php
 *
 * Agenda/timeline card used inside the Workshop Planner (planner blue phase).
 * LG = timeline canvas card (eyebrow, title, duration, drag handle, actions).
 * SM = library palette card (compact title + duration row, optional meta line).
 *
 * @param string $title    Card title (required)
 * @param array  $options  type(exercise|icebreaker|break|custom), duration(string|int),
 *                          size(lg|sm), state(default|selected|disabled), draggable(bool),
 *                          actions[] (string action keys or [action,icon?,label?]),
 *                          meta (SM only), href, id, class, attrs[]
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function planner_card(string $title, array $options = []): string
{
    $type      = $options['type']      ?? 'exercise';
    $duration  = $options['duration']  ?? '';
    $size      = $options['size']      ?? 'lg';
    $state     = $options['state']     ?? 'default';
    $draggable = !empty($options['draggable']);
    $actions   = $options['actions']   ?? [];
    $meta      = $options['meta']      ?? '';
    $href      = $options['href']      ?? null;
    $id        = $options['id']        ?? null;
    $class     = $options['class']     ?? '';
    $attrs     = $options['attrs']     ?? [];

    $allowedTypes = ['exercise', 'icebreaker', 'break', 'custom'];
    if (!in_array($type, $allowedTypes, true)) {
        $type = 'exercise';
    }

    $durationText = is_numeric($duration) ? ((int) $duration) . 'm' : (string) $duration;

    $eyebrow = [
        'exercise'   => 'EXERCISES',
        'icebreaker' => 'ICEBREAKER',
        'break'      => 'BREAK',
        'custom'     => 'CUSTOM',
    ][$type];

    $classString = cx([
        'ws-planner-card',
        'ws-planner-card--' . $size,
        'ws-planner-card--' . $type,
        $state !== 'default' ? 'ws-planner-card--' . $state : '',
        $draggable ? 'is-draggable' : '',
        $class,
    ]);

    $attrString = attrs(array_merge(
        $id ? ['id' => $id] : [],
        $href ? ['href' => $href] : [],
        ['data-type' => $type],
        $state === 'selected' ? ['aria-selected' => 'true'] : [],
        $state === 'disabled' ? ['aria-disabled' => 'true'] : [],
        $attrs
    ));
    if ($attrString !== '') {
        $attrString = ' ' . $attrString;
    }

    $tag = $href ? 'a' : 'div';

    $actionIconMap = [
        'swap'   => 'swap_horiz',
        'delete' => 'delete',
        'edit'   => 'edit',
    ];
    $actionLabelMap = [
        'swap'   => 'Swap',
        'delete' => 'Delete',
        'edit'   => 'Edit',
    ];

    $normalizedActions = [];
    foreach ((array) $actions as $a) {
        if (is_string($a)) {
            $normalizedActions[] = ['action' => $a];
        } elseif (is_array($a)) {
            $normalizedActions[] = $a;
        }
    }

    $html = '<' . $tag . ' class="' . $classString . '"' . $attrString . '>';

    if ($size === 'lg') {
        $html .= '<div class="ws-planner-card__header">';
        $html .= '<span class="ws-planner-card__eyebrow">' . e($eyebrow) . '</span>';
        if (!empty($normalizedActions)) {
            $html .= '<div class="ws-planner-card__actions" role="group" aria-label="Card actions">';
            foreach ($normalizedActions as $a) {
                $actKey   = $a['action'] ?? 'edit';
                $iconName = $a['icon']   ?? ($actionIconMap[$actKey] ?? 'edit');
                $label    = $a['label']  ?? ($actionLabelMap[$actKey] ?? ucfirst($actKey));
                $html .= '<button type="button" class="ws-planner-card__action" data-action="' . e($actKey)
                       . '" aria-label="' . e($label) . '">' . icon($iconName) . '</button>';
            }
            $html .= '</div>';
        }
        $html .= '</div>';

        $html .= '<div class="ws-planner-card__body">';
        if ($draggable) {
            $html .= '<span class="ws-planner-card__handle" aria-hidden="true">' . icon('drag_indicator') . '</span>';
        }
        $html .= '<h3 class="ws-planner-card__title">' . e($title) . '</h3>';
        $html .= '</div>';

        if ($durationText !== '') {
            $html .= '<div class="ws-planner-card__footer">'
                   . '<span class="ws-planner-card__duration">' . e($durationText) . '</span>'
                   . '</div>';
        }
    } else { // sm
        $html .= '<div class="ws-planner-card__row">';
        $html .= '<h4 class="ws-planner-card__title">' . e($title) . '</h4>';
        $html .= '<div class="ws-planner-card__row-end">';
        if ($durationText !== '') {
            $html .= '<span class="ws-planner-card__duration">' . e($durationText) . '</span>';
        }
        $html .= '<button type="button" class="ws-planner-card__action ws-planner-card__action--hover" '
               . 'data-action="swap" aria-label="Swap" tabindex="-1">' . icon('swap_horiz') . '</button>';
        $html .= '</div>';
        $html .= '</div>';

        if ($meta !== '') {
            $html .= '<p class="ws-planner-card__meta">' . e($meta) . '</p>';
        }
    }

    $html .= '</' . $tag . '>';

    return $html;
}
