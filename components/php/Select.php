<?php
/**
 * Select — portable mirror of ws_select() / includes/components/select.php
 *
 * @param string $name           Field name
 * @param array  $selectOptions  Key-value pairs of option value => label
 * @param array  $options        label, value, placeholder, required(bool), optional(bool), disabled(bool),
 *                               error, helper, size(sm|md|lg), id, class, attrs[]
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function select(string $name, array $selectOptions, array $options = []): string
{
    $label       = $options['label'] ?? null;
    $value       = $options['value'] ?? '';
    $placeholder = $options['placeholder'] ?? null;
    $required    = $options['required'] ?? false;
    $optional    = $options['optional'] ?? false;
    $disabled    = $options['disabled'] ?? false;
    $error       = $options['error'] ?? null;
    $helper      = $options['helper'] ?? null;
    $size        = $options['size'] ?? 'md';
    $id          = $options['id'] ?? $name;
    $class       = $options['class'] ?? '';
    $attrs       = $options['attrs'] ?? [];

    $fieldClass = cx([
        'ws-field',
        $error ? 'ws-field--error' : '',
    ]);

    $selectClass = cx([
        'ws-select',
        'ws-select--' . $size,
        $class,
    ]);

    $attrString = attrs(array_merge(
        ['name' => $name, 'id' => $id],
        $required ? ['required' => true] : [],
        $disabled ? ['disabled' => true] : [],
        $attrs
    ));

    $labelHtml = '';
    if ($label) {
        $labelHtml = '<label class="ws-field__label" for="' . e($id) . '">'
            . e($label)
            . ($optional ? '<span class="ws-field__optional">(optional)</span>' : '')
            . '</label>';
    }

    $opts = '';
    if ($placeholder) {
        $opts .= '<option value=""' . ($value === '' ? ' selected' : '') . '>' . e($placeholder) . '</option>';
    }
    foreach ($selectOptions as $optValue => $optLabel) {
        $opts .= '<option value="' . e((string) $optValue) . '"'
            . ($value === (string) $optValue ? ' selected' : '') . '>'
            . e($optLabel) . '</option>';
    }

    $note = '';
    if ($error) {
        $note = '<span class="ws-field__error">' . e($error) . '</span>';
    } elseif ($helper) {
        $note = '<span class="ws-field__helper">' . e($helper) . '</span>';
    }

    return '<div class="' . $fieldClass . '">'
        . $labelHtml
        . '<div class="ws-select-wrap">'
        . '<select class="' . $selectClass . '" ' . $attrString . '>' . $opts . '</select>'
        . '<span class="ws-select__arrow"><span class="material-symbols-outlined">expand_more</span></span>'
        . '</div>'
        . $note
        . '</div>';
}
