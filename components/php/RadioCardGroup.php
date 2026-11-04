<?php
/**
 * RadioCardGroup — portable mirror of ws_radio_card_group() / includes/components/radio-card-group.php
 *
 * Card-style radio selector grid.
 *
 * @param string $name     Radio group name
 * @param array  $items    Array of option arrays: value, label, icon,
 *                         description, checked(bool), disabled(bool)
 * @param array  $options  label, columns(2|3|4), id, class
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function radio_card_group(string $name, array $items, array $options = []): string
{
    $label   = $options['label'] ?? null;
    $columns = $options['columns'] ?? 4;
    $id      = $options['id'] ?? $name . '-group';
    $class   = $options['class'] ?? '';

    $classString = cx([
        'ws-radio-card-group',
        'ws-radio-card-group--cols-' . $columns,
        $class,
    ]);

    $labelHtml = $label
        ? '<p class="ws-radio-card-group__label">' . e($label) . '</p>'
        : '';

    $cards = '';
    foreach ($items as $item) {
        $val      = $item['value'] ?? '';
        $lbl      = $item['label'] ?? '';
        $ico      = $item['icon'] ?? null;
        $desc     = $item['description'] ?? null;
        $checked  = !empty($item['checked']);
        $disabled = !empty($item['disabled']);

        $cardClass = cx([
            'ws-radio-card',
            $checked ? 'ws-radio-card--selected' : '',
            $disabled ? 'ws-radio-card--disabled' : '',
        ]);

        $inputAttrs = attrs(array_merge(
            ['type' => 'radio', 'name' => $name, 'value' => $val],
            $checked ? ['checked' => true] : [],
            $disabled ? ['disabled' => true] : []
        ));

        $cards .= '<label class="' . $cardClass . '">'
            . '<input ' . $inputAttrs . '>'
            . '<div class="ws-radio-card__visual">'
            . ($ico ? '<span class="ws-radio-card__icon">' . icon($ico) . '</span>' : '')
            . '<span class="ws-radio-card__label">' . e($lbl) . '</span>'
            . ($desc ? '<span class="ws-radio-card__desc">' . e($desc) . '</span>' : '')
            . '</div>'
            . '</label>';
    }

    return $labelHtml
        . '<div class="' . $classString . '" id="' . e($id) . '">' . $cards . '</div>';
}
