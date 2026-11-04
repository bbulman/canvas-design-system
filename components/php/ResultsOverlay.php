<?php
/**
 * ResultsOverlay — portable mirror of ws_results_overlay() / includes/components/results-overlay.php
 *
 * Animated results panel for operation outcomes. Renders hidden static markup
 * (the list is populated by JS). Use as a full overlay or an inline block.
 *
 * @param array $options
 *   - id         (string) Element ID (required)
 *   - variant    (string) overlay|inline (default: overlay)
 *   - title      (string) Results title
 *   - icon       (string) Material icon name (default: check_circle)
 *   - buttonText (string) Action button text (overlay only)
 *   - buttonId   (string) Action button ID (overlay only)
 *   - listId     (string) Results list UL ID (default: {id}-list)
 *   - class      (string) Additional CSS classes
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function results_overlay(array $options): string
{
    $id         = $options['id'] ?? '';
    $variant    = $options['variant'] ?? 'overlay';
    $title      = $options['title'] ?? 'Complete';
    $ico        = $options['icon'] ?? 'check_circle';
    $buttonText = $options['buttonText'] ?? 'Done';
    $buttonId   = $options['buttonId'] ?? $id . '-done';
    $listId     = $options['listId'] ?? $id . '-list';
    $class      = $options['class'] ?? '';

    $isOverlay = $variant === 'overlay';

    $classString = cx([
        'ws-results',
        'ws-results--' . $variant,
        $class,
    ]);

    $header = '<div class="ws-results__header">'
        . '<span class="ws-results__icon">' . icon($ico) . '</span>'
        . '<span class="ws-results__title">' . e($title) . '</span>'
        . '</div>';

    $list = '<ul class="ws-results__list" id="' . e($listId) . '"></ul>';

    $button = $isOverlay
        ? '<button class="ws-results__btn" id="' . e($buttonId) . '" type="button">' . e($buttonText) . '</button>'
        : '';

    $inner = $header . $list . $button;
    if ($isOverlay) {
        $inner = '<div class="ws-results__inner">' . $inner . '</div>';
    }

    return '<div class="' . $classString . '" id="' . e($id) . '" style="display: none;">'
        . $inner
        . '</div>';
}
