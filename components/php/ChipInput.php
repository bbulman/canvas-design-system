<?php
/**
 * ChipInput — portable mirror of ws_chip_input() / includes/components/chip-input.php
 *
 * Email/tag chip input with add/remove. Renders the static markup; the
 * add/remove behaviour is wired up by the app's JS against the data-id elements.
 *
 * @param string $name     Field name / ID prefix
 * @param array  $options  label, optional(bool), placeholder, type(email|text), addIcon, addText,
 *                         removeIcon, id, class, attrs[]
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function chip_input(string $name, array $options = []): string
{
    $label       = $options['label'] ?? null;
    $optional    = $options['optional'] ?? false;
    $placeholder = $options['placeholder'] ?? 'Add item...';
    $type        = $options['type'] ?? 'text';
    $addIcon     = $options['addIcon'] ?? 'add';
    $addText     = $options['addText'] ?? null;
    $id          = $options['id'] ?? $name;
    $class       = $options['class'] ?? '';
    $attrs       = $options['attrs'] ?? [];

    $classString = cx(['ws-chip-input', $class]);

    $attrString = attrs($attrs);
    if ($attrString !== '') {
        $attrString = ' ' . $attrString;
    }

    $labelHtml = '';
    if ($label) {
        $labelHtml = '<label class="ws-chip-input__label" for="' . e($id) . '-input">' . e($label)
            . ($optional ? ' <span class="ws-field__optional">(optional)</span>' : '') . '</label>';
    }

    $addContent = icon($addIcon)
        . ($addText ? '<span>' . e($addText) . '</span>' : '');

    return '<div class="' . $classString . '" id="' . e($id) . '-wrap"' . $attrString . '>'
        . $labelHtml
        . '<div class="ws-chip-input__field">'
        . '<input type="' . e($type) . '" id="' . e($id) . '-input" class="ws-input" placeholder="' . e($placeholder) . '">'
        . '<button type="button" class="ws-chip-input__add" id="' . e($id) . '-add">' . $addContent . '</button>'
        . '</div>'
        . '<div class="ws-chip-input__list" id="' . e($id) . '-list"></div>'
        . '</div>';
}
