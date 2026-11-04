<?php
/**
 * Checklist — portable mirror of ws_checklist() / includes/components/checklist.php
 *
 * @param array $items    List of text items
 * @param array $options  icon(default: check_circle), variant(default|compact), id, class
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function checklist(array $items, array $options = []): string
{
    $iconName = $options['icon'] ?? 'check_circle';
    $variant  = $options['variant'] ?? 'default';
    $id       = $options['id'] ?? null;
    $class    = $options['class'] ?? '';

    $classString = cx([
        'ws-checklist',
        $variant !== 'default' ? 'ws-checklist--' . $variant : '',
        $class,
    ]);

    $attrString = attrs($id ? ['id' => $id] : []);
    if ($attrString !== '') {
        $attrString = ' ' . $attrString;
    }

    $lis = '';
    foreach ($items as $item) {
        $lis .= '<li class="ws-checklist__item">'
            . '<span class="ws-checklist__icon">' . icon($iconName) . '</span>'
            . '<span class="ws-checklist__text">' . e($item) . '</span>'
            . '</li>';
    }

    return '<ul class="' . $classString . '"' . $attrString . '>' . $lis . '</ul>';
}
