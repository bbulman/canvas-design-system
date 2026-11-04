<?php
/**
 * CheckboxCardGroup — portable mirror of ws_checkbox_card_group() / includes/components/checkbox-card-group.php
 *
 * Card-style checkbox list with icons and toggle switches.
 *
 * @param array $items    Array of option arrays: id, title, description, icon,
 *                        iconColor(blue|orange|purple|red|green), checked(bool), highlight(bool)
 * @param array $options  label, id, class
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function checkbox_card_group(array $items, array $options = []): string
{
    $label = $options['label'] ?? null;
    $id    = $options['id'] ?? null;
    $class = $options['class'] ?? '';

    $classString = cx(['ws-checkbox-card-group', $class]);

    $labelHtml = $label
        ? '<p class="ws-checkbox-card-group__label">' . e($label) . '</p>'
        : '';

    $groupAttrs = $id ? ' id="' . e($id) . '"' : '';

    $cards = '';
    foreach ($items as $item) {
        $itemId    = $item['id'] ?? '';
        $title     = $item['title'] ?? '';
        $desc      = $item['description'] ?? '';
        $ico       = $item['icon'] ?? null;
        $icoColor  = $item['iconColor'] ?? 'blue';
        $checked   = !empty($item['checked']);
        $highlight = !empty($item['highlight']);

        $cardClass = cx([
            'ws-checkbox-card',
            $highlight ? 'ws-checkbox-card--highlight' : '',
        ]);

        $iconHtml = $ico
            ? '<div class="ws-checkbox-card__icon ws-checkbox-card__icon--' . e($icoColor) . '">' . icon($ico) . '</div>'
            : '';

        $inputAttrs = attrs(array_merge(
            ['type' => 'checkbox', 'id' => $itemId],
            $checked ? ['checked' => true] : []
        ));

        $cards .= '<label class="' . $cardClass . '">'
            . '<div class="ws-checkbox-card__content">'
            . $iconHtml
            . '<div class="ws-checkbox-card__text">'
            . '<span class="ws-checkbox-card__title">' . e($title) . '</span>'
            . ($desc ? '<span class="ws-checkbox-card__desc">' . e($desc) . '</span>' : '')
            . '</div>'
            . '</div>'
            . '<div class="ws-toggle">'
            . '<input ' . $inputAttrs . '>'
            . '<span class="ws-toggle__slider"></span>'
            . '</div>'
            . '</label>';
    }

    return $labelHtml
        . '<div class="' . $classString . '"' . $groupAttrs . '>' . $cards . '</div>';
}
