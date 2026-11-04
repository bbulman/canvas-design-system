<?php
/**
 * CategoryIcon — portable mirror of the "Category Icon Gradients" pattern.
 *
 * Content card icons use gradient-filled containers per category.
 *
 * @param string $icon     Material Symbols icon name (e.g. "lightbulb").
 * @param array  $options  category(ideation|strategy|team|design|feedback|remote|default),
 *                          gradient(custom "start, end" hex pair — overrides category),
 *                          size(px, default 40), id, class, attrs[]
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function category_icon(string $icon, array $options = []): string
{
    $category = $options['category'] ?? 'default';
    $gradient = $options['gradient'] ?? null;
    $size     = $options['size'] ?? 40;
    $id       = $options['id'] ?? null;
    $class    = $options['class'] ?? '';
    $attrs    = $options['attrs'] ?? [];

    $gradients = [
        'ideation' => '#F59E0B, #D97706',
        'strategy' => '#3B82F6, #2563EB',
        'team'     => '#10B981, #059669',
        'design'   => '#8B5CF6, #7C3AED',
        'feedback' => '#EC4899, #DB2777',
        'remote'   => '#06B6D4, #0891B2',
        'default'  => '#E54D4D, #C73E3E',
    ];
    $grad = $gradient ?? ($gradients[$category] ?? $gradients['default']);

    $classString = cx([
        'category-icon',
        'category-icon--' . $category,
        $class,
    ]);

    $style = 'width: ' . (int) $size . 'px; height: ' . (int) $size . 'px;'
        . ' background: linear-gradient(135deg, ' . e($grad) . ');'
        . ' border-radius: 8px; display: flex; align-items: center; justify-content: center;';

    $attrString = attrs(array_merge($id ? ['id' => $id] : [], $attrs));
    if ($attrString !== '') {
        $attrString = ' ' . $attrString;
    }

    return '<div class="' . $classString . '" style="' . $style . '"' . $attrString . '>'
        . icon($icon)
        . '</div>';
}
