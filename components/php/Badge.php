<?php
/**
 * Badge — portable mirror of ws_badge() / includes/components/badge.php
 *
 * @param string $text                 Badge text
 * @param array  $options              variant(default|duration|category|status|count|new),
 *                                      size(sm|md|lg), icon, color(hex, category only),
 *                                      status(success|warning|error|info), pill(bool),
 *                                      id, class, attrs[]
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function badge(string $text, array $options = []): string
{
    $variant = $options['variant'] ?? 'default';
    $size    = $options['size'] ?? 'md';
    $icon    = $options['icon'] ?? null;
    $color   = $options['color'] ?? null;
    $status  = $options['status'] ?? null;
    $pill    = $options['pill'] ?? false;
    $id      = $options['id'] ?? null;
    $class   = $options['class'] ?? '';
    $attrs   = $options['attrs'] ?? [];

    $classString = cx([
        'ws-badge',
        'ws-badge--' . $variant,
        'ws-badge--' . $size,
        $pill ? 'ws-badge--pill' : '',
        $status ? 'ws-badge--' . $status : '',
        $class,
    ]);

    $style = '';
    if ($color && $variant === 'category') {
        $style = ' style="--badge-color: ' . e($color) . '; --badge-bg: ' . e($color) . '1A;"';
    }

    $attrString = attrs(array_merge($id ? ['id' => $id] : [], $attrs));
    if ($attrString !== '') {
        $attrString = ' ' . $attrString;
    }

    $iconHtml = $icon ? '<span class="ws-badge__icon">' . icon($icon) . '</span>' : '';

    return '<span class="' . $classString . '"' . $style . $attrString . '>'
        . $iconHtml
        . '<span class="ws-badge__text">' . e($text) . '</span>'
        . '</span>';
}
