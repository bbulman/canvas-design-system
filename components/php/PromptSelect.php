<?php
/**
 * PromptSelect — portable mirror of ws_prompt_select() / includes/components/prompt-select.php
 *
 * Inline label + dropdown pair, e.g. "I need help with [Goal...]".
 *
 * @param string $label          Prompt label text (displayed in serif italic)
 * @param string $name           Select field name / id
 * @param array  $selectOptions  Key-value pairs of option value => label
 * @param array  $opts           value, onchange, id, class, variant(default|muted)
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function prompt_select(string $label, string $name, array $selectOptions, array $opts = []): string
{
    $value    = $opts['value'] ?? '';
    $onchange = $opts['onchange'] ?? '';
    $id       = $opts['id'] ?? $name;
    $class    = $opts['class'] ?? '';
    $variant  = $opts['variant'] ?? 'default';

    $wrapperClass = cx([
        'ws-prompt-select',
        $variant !== 'default' ? 'ws-prompt-select--' . $variant : '',
        $class,
    ]);

    $selectAttrs = attrs(array_merge(
        ['name' => $name, 'id' => $id, 'class' => 'ws-prompt-select__select'],
        $onchange ? ['onchange' => $onchange] : []
    ));

    $opt = '';
    foreach ($selectOptions as $optValue => $optLabel) {
        $opt .= '<option value="' . e((string) $optValue) . '"'
            . ($value === (string) $optValue ? ' selected' : '') . '>'
            . e($optLabel) . '</option>';
    }

    return '<div class="' . $wrapperClass . '">'
        . '<span class="ws-prompt-select__label"><em>' . e($label) . '</em></span>'
        . '<div class="ws-prompt-select__dropdown">'
        . '<select ' . $selectAttrs . '>' . $opt . '</select>'
        . '</div>'
        . '</div>';
}
