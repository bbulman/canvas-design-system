<?php
/**
 * Breadcrumb — portable mirror of ws_breadcrumb() / includes/components/breadcrumb.php
 *
 * @param array $items   Array of ['label' => 'Home', 'href' => '/'] pairs.
 *                       The last item has no href and is marked current.
 * @param array $options separator (default: chevron_right), id, class
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function breadcrumb(array $items, array $options = []): string
{
    $separator = $options['separator'] ?? 'chevron_right';
    $id        = $options['id'] ?? null;
    $class     = $options['class'] ?? '';

    $classString = cx([
        'ws-breadcrumb',
        $class,
    ]);

    $attrString = attrs($id ? ['id' => $id] : []);
    if ($attrString !== '') {
        $attrString = ' ' . $attrString;
    }

    $html = '<nav class="' . $classString . '"' . $attrString . ' aria-label="Breadcrumb">'
        . '<ol class="ws-breadcrumb__list">';

    $count = count($items);
    foreach (array_values($items) as $i => $item) {
        $isLast = $i === $count - 1;
        $href   = $item['href'] ?? null;
        $label  = $item['label'] ?? '';

        $html .= '<li class="ws-breadcrumb__item' . ($isLast ? ' ws-breadcrumb__item--current' : '') . '">';

        if ($href && !$isLast) {
            $html .= '<a href="' . e($href) . '" class="ws-breadcrumb__link">' . e($label) . '</a>';
        } else {
            $html .= '<span class="ws-breadcrumb__text"' . ($isLast ? ' aria-current="page"' : '') . '>'
                . e($label) . '</span>';
        }

        if (!$isLast) {
            $html .= '<span class="ws-breadcrumb__separator">' . icon($separator) . '</span>';
        }

        $html .= '</li>';
    }

    $html .= '</ol></nav>';

    return $html;
}
