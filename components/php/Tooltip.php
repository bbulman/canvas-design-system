<?php
/**
 * Tooltip — portable mirror of ws_tooltip() / includes/components/tooltip.php
 *
 * Returns the data-* attribute string to spread onto a trigger element.
 *
 * @param string $text      Tooltip text (required)
 * @param array  $options   position(top|bottom|left|right), variant(default|dark|light),
 *                          arrow(bool, default true)
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function tooltip(string $text, array $options = []): string
{
    $position = $options['position'] ?? 'top';
    $variant  = $options['variant'] ?? 'dark';
    $arrow    = $options['arrow'] ?? true;

    return attrs(array_merge(
        [
            'data-tooltip'          => $text,
            'data-tooltip-position' => $position,
        ],
        $variant !== 'dark' ? ['data-tooltip-variant' => $variant] : [],
        !$arrow ? ['data-tooltip-arrow' => 'false'] : []
    ));
}
