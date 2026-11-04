<?php
/**
 * Accordion — portable mirror of ws_accordion() / includes/components/accordion.php
 *
 * @param array $items   Each item: title, content(HTML), open(bool), icon, disabled(bool)
 * @param array $options multiple(bool), variant(default|bordered|flush), size(sm|md|lg),
 *                       id, class
 *
 * Interactive expand/collapse is driven by the shared components.js behavior,
 * which keys off the rendered markup + aria-* / data-multiple attributes.
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function accordion(array $items, array $options = []): string
{
    $id       = $options['id'] ?? 'ws-accordion-' . uniqid();
    $multiple = $options['multiple'] ?? false;
    $variant  = $options['variant'] ?? 'default';
    $size     = $options['size'] ?? 'md';
    $class    = $options['class'] ?? '';

    $containerClass = cx([
        'ws-accordion',
        'ws-accordion--' . $variant,
        'ws-accordion--' . $size,
        $class,
    ]);

    $html = '<div class="' . $containerClass . '" id="' . e($id) . '" data-multiple="'
        . ($multiple ? 'true' : 'false') . '">';

    foreach ($items as $index => $item) {
        $itemId   = $id . '-item-' . $index;
        $title    = $item['title'] ?? '';
        $content  = $item['content'] ?? '';
        $open     = $item['open'] ?? false;
        $icon     = $item['icon'] ?? null;
        $disabled = $item['disabled'] ?? false;

        $itemClass = cx([
            'ws-accordion__item',
            $open ? 'is-open' : '',
            $disabled ? 'is-disabled' : '',
        ]);

        $triggerAttrs = attrs([
            'type'          => 'button',
            'class'         => 'ws-accordion__trigger',
            'id'            => $itemId . '-trigger',
            'aria-expanded' => $open ? 'true' : 'false',
            'aria-controls' => $itemId . '-panel',
            'disabled'      => $disabled ? true : false,
        ]);

        $panelAttrs = attrs([
            'class'           => 'ws-accordion__panel',
            'id'              => $itemId . '-panel',
            'role'            => 'region',
            'aria-labelledby' => $itemId . '-trigger',
            'hidden'          => !$open ? true : false,
        ]);

        $iconHtml = $icon
            ? '<span class="ws-accordion__icon">' . icon($icon) . '</span>'
            : '';

        $html .= '<div class="' . $itemClass . '" id="' . e($itemId) . '">'
            . '<button ' . $triggerAttrs . '>'
            . $iconHtml
            . '<span class="ws-accordion__title">' . e($title) . '</span>'
            . '<span class="ws-accordion__arrow">'
            . '<span class="material-symbols-outlined" aria-hidden="true">expand_more</span>'
            . '</span>'
            . '</button>'
            . '<div ' . $panelAttrs . '>'
            . '<div class="ws-accordion__content">' . $content . '</div>'
            . '</div>'
            . '</div>';
    }

    $html .= '</div>';

    return $html;
}
