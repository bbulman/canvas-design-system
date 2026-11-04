<?php
/**
 * Stat — portable mirror of ws_stat() / includes/components/stat.php
 *
 * @param string $value   Stat number/value (e.g. "50+")
 * @param string $label   Stat label (e.g. "Workshops")
 * @param array  $options color(hex|CSS var, applied to value), icon, id, class
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function stat(string $value, string $label, array $options = []): string
{
    $color = $options['color'] ?? null;
    $icon  = $options['icon'] ?? null;
    $id    = $options['id'] ?? null;
    $class = $options['class'] ?? '';

    $classString = cx([
        'ws-stat',
        $class,
    ]);

    $attrString = attrs($id ? ['id' => $id] : []);
    if ($attrString !== '') {
        $attrString = ' ' . $attrString;
    }

    $style = $color ? ' style="color: ' . e($color) . ';"' : '';

    $iconHtml = $icon ? '<span class="ws-stat__icon">' . icon($icon) . '</span>' : '';

    return '<div class="' . $classString . '"' . $attrString . '>'
        . $iconHtml
        . '<span class="ws-stat__value"' . $style . '>' . e($value) . '</span>'
        . '<span class="ws-stat__label">' . e($label) . '</span>'
        . '</div>';
}
