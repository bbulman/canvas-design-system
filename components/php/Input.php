<?php
/**
 * Input — portable mirror of ws_input() / includes/components/input.php
 *
 * @param string $name     Field name
 * @param array  $options  type(text|email|password|number|tel|url|search|textarea|select),
 *                          id, label, placeholder, value, error, hint, required(bool), optional(bool),
 *                          disabled(bool), readonly(bool), autocomplete, minlength, maxlength,
 *                          pattern, options[] ([value,label,disabled?] for select), rows(textarea),
 *                          showPasswordToggle(bool), size(sm|md|lg), class, attrs[]
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function input(string $name, array $options = []): string
{
    $type               = $options['type'] ?? 'text';
    $id                 = $options['id'] ?? $name;
    $label              = $options['label'] ?? null;
    $placeholder        = $options['placeholder'] ?? '';
    $value              = $options['value'] ?? '';
    $error              = $options['error'] ?? null;
    $hint               = $options['hint'] ?? null;
    $required           = $options['required'] ?? false;
    $optional           = $options['optional'] ?? false;
    $disabled           = $options['disabled'] ?? false;
    $readonly           = $options['readonly'] ?? false;
    $autocomplete       = $options['autocomplete'] ?? null;
    $minlength          = $options['minlength'] ?? null;
    $maxlength          = $options['maxlength'] ?? null;
    $pattern            = $options['pattern'] ?? null;
    $selectOptions      = $options['options'] ?? [];
    $rows               = $options['rows'] ?? 4;
    $showPasswordToggle = $options['showPasswordToggle'] ?? true;
    $size               = $options['size'] ?? 'md';
    $class              = $options['class'] ?? '';
    $attrs              = $options['attrs'] ?? [];

    $wrapperClass = cx([
        'ws-field',
        'ws-field--' . $size,
        $error ? 'ws-field--error' : '',
        $disabled ? 'ws-field--disabled' : '',
        $class,
    ]);

    $inputClass = cx([
        'ws-input',
        'ws-input--' . $size,
        $error ? 'ws-input--error' : '',
    ]);

    $common = array_merge(
        ['id' => $id, 'name' => $name],
        $placeholder ? ['placeholder' => $placeholder] : [],
        $required ? ['required' => true] : [],
        $disabled ? ['disabled' => true] : [],
        $readonly ? ['readonly' => true] : [],
        $autocomplete ? ['autocomplete' => $autocomplete] : [],
        $minlength !== null ? ['minlength' => (int) $minlength] : [],
        $maxlength !== null ? ['maxlength' => (int) $maxlength] : [],
        $pattern ? ['pattern' => $pattern] : [],
        $error ? ['aria-invalid' => 'true', 'aria-describedby' => $id . '-error'] : ($hint ? ['aria-describedby' => $id . '-hint'] : []),
        $attrs
    );
    $attrString = attrs($common);

    $labelHtml = '';
    if ($label) {
        $labelHtml = '<label class="ws-field__label" for="' . e($id) . '">'
            . e($label)
            . ($optional ? '<span class="ws-field__optional">(optional)</span>' : '')
            . '</label>';
    }

    if ($type === 'textarea') {
        $field = '<textarea class="' . $inputClass . ' ws-textarea" rows="' . (int) $rows . '" '
            . $attrString . '>' . e($value) . '</textarea>';
    } elseif ($type === 'select') {
        $opts = '';
        if ($placeholder) {
            $opts .= '<option value="" disabled' . (!$value ? ' selected' : '') . '>' . e($placeholder) . '</option>';
        }
        foreach ($selectOptions as $opt) {
            $opts .= '<option value="' . e($opt['value']) . '"'
                . (($value == ($opt['value'] ?? null)) ? ' selected' : '')
                . (!empty($opt['disabled']) ? ' disabled' : '')
                . '>' . e($opt['label'] ?? '') . '</option>';
        }
        $field = '<div class="ws-select-wrapper">'
            . '<select class="' . $inputClass . ' ws-select" ' . $attrString . '>' . $opts . '</select>'
            . '<span class="ws-select__arrow">' . icon('expand_more') . '</span>'
            . '</div>';
    } elseif ($type === 'password' && $showPasswordToggle) {
        $field = '<div class="ws-password-wrapper">'
            . '<input type="password" class="' . $inputClass . '" value="' . e($value) . '" ' . $attrString . '>'
            . '<button type="button" class="ws-password-toggle" aria-label="Toggle password visibility">'
            . '<span class="eye-open">' . icon('visibility') . '</span>'
            . '<span class="eye-closed hidden">' . icon('visibility_off') . '</span>'
            . '</button>'
            . '</div>';
    } else {
        $field = '<input type="' . e($type) . '" class="' . $inputClass . '" value="' . e($value) . '" ' . $attrString . '>';
    }

    $note = '';
    if ($error) {
        $note = '<p class="ws-field__error" id="' . e($id) . '-error" role="alert">' . e($error) . '</p>';
    } elseif ($hint) {
        $note = '<p class="ws-field__hint" id="' . e($id) . '-hint">' . e($hint) . '</p>';
    }

    return '<div class="' . $wrapperClass . '">' . $labelHtml . $field . $note . '</div>';
}
