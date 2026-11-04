<?php
/**
 * Tabs — portable mirror of ws_tabs() / includes/components/tabs.php
 *
 * @param array $items   Each item: id, label, icon, count(int), active(bool),
 *                       disabled(bool), gated(bool)
 * @param array $options variant(underline|pill|segmented), size(sm|md|lg),
 *                       scrollable(bool), id, label, class
 *
 * Tab switching is driven by the shared components.js behavior, which keys off
 * the data-tab / aria-selected attributes rendered here. Each tab is
 * "{item id}-tab" and controls "{item id}-panel"; `label` names the tablist
 * (aria-label). Roving tabindex: the active tab (or, with none active, the
 * first enabled one) is 0 and the rest -1, so Tab enters and leaves the row in
 * one stop and the arrow keys move within it.
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function tabs(array $items, array $options = []): string
{
    $id         = $options['id'] ?? 'ws-tabs-' . uniqid();
    $variant    = $options['variant'] ?? 'underline';
    $size       = $options['size'] ?? 'md';
    $scrollable = $options['scrollable'] ?? true;
    $label      = $options['label'] ?? '';
    $class      = $options['class'] ?? '';

    $focusIndex = null;
    foreach ($items as $index => $item) {
        if (!empty($item['disabled'])) continue;
        if (!empty($item['active'])) { $focusIndex = $index; break; }
        if ($focusIndex === null) $focusIndex = $index;
    }

    $containerClass = cx([
        'ws-tabs',
        'ws-tabs--' . $variant,
        'ws-tabs--' . $size,
        $scrollable ? 'ws-tabs--scrollable' : '',
        $class,
    ]);

    $html = '<div class="' . $containerClass . '" id="' . e($id) . '">'
        . '<div class="ws-tabs__nav" role="tablist"' . ($label !== '' ? ' aria-label="' . e($label) . '"' : '') . '>';

    foreach ($items as $index => $item) {
        $itemId   = $item['id'] ?? 'tab-' . $index;
        $itemLabel = $item['label'] ?? '';
        $icon     = $item['icon'] ?? null;
        $count    = $item['count'] ?? null;
        $active   = $item['active'] ?? false;
        $disabled = $item['disabled'] ?? false;
        $gated    = $item['gated'] ?? false;

        $btnClass = cx([
            'ws-tabs__btn',
            $active ? 'is-active' : '',
            $disabled ? 'is-disabled' : '',
            $gated ? 'is-gated' : '',
        ]);

        $btnAttrs = attrs([
            'type'          => 'button',
            'class'         => $btnClass,
            'id'            => $itemId . '-tab',
            'data-tab'      => $itemId,
            'role'          => 'tab',
            'aria-selected' => $active ? 'true' : 'false',
            'aria-controls' => $itemId . '-panel',
            'tabindex'      => $index === $focusIndex ? '0' : '-1',
            'disabled'      => $disabled ? true : false,
        ]);

        $html .= '<button ' . $btnAttrs . '>';
        if ($icon) {
            $html .= '<span class="ws-tabs__icon">' . icon($icon) . '</span>';
        }
        $html .= '<span class="ws-tabs__label">' . e($itemLabel) . '</span>';
        if ($count !== null) {
            $html .= '<span class="ws-tabs__count">' . (int) $count . '</span>';
        }
        if ($gated) {
            $html .= '<span class="ws-tabs__lock">' . icon('lock', 'ws-tabs__lock-icon') . '</span>';
        }
        $html .= '</button>';
    }

    $html .= '</div></div>';

    return $html;
}
