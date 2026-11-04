<?php
/**
 * Progress — portable mirror of ws_progress() / includes/components/progress.php
 *
 * @param int|float $value  Progress value 0-100
 * @param array     $options variant(primary|success|warning|error|info), size(sm|md|lg),
 *                           label, showValue(bool), striped(bool), animated(bool),
 *                           indeterminate(bool), id, class, attrs[]
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function progress(int|float $value, array $options = []): string
{
    $variant       = $options['variant'] ?? 'primary';
    $size          = $options['size'] ?? 'md';
    $label         = $options['label'] ?? null;
    $showValue     = $options['showValue'] ?? false;
    $striped       = $options['striped'] ?? false;
    $animated      = $options['animated'] ?? false;
    $indeterminate = $options['indeterminate'] ?? false;
    $id            = $options['id'] ?? null;
    $class         = $options['class'] ?? '';
    $attrs         = $options['attrs'] ?? [];

    $value = max(0, min(100, $value));

    $wrapperClass = cx([
        'ws-progress',
        'ws-progress--' . $size,
        $class,
    ]);

    $barClass = cx([
        'ws-progress__bar',
        'ws-progress__bar--' . $variant,
        $striped ? 'ws-progress__bar--striped' : '',
        $animated ? 'ws-progress__bar--animated' : '',
        $indeterminate ? 'ws-progress__bar--indeterminate' : '',
    ]);

    $attrString = attrs(array_merge(
        $id ? ['id' => $id] : [],
        [
            'role' => 'progressbar',
            'aria-valuenow' => (string) $value,
            'aria-valuemin' => '0',
            'aria-valuemax' => '100',
        ],
        $label ? ['aria-label' => $label] : [],
        $attrs
    ));

    $html = '';
    $hasHeader = $label || $showValue;
    if ($hasHeader) {
        $html .= '<div class="ws-progress-wrapper">';
        if ($label) {
            $html .= '<span class="ws-progress__label">' . e($label) . '</span>';
        }
        if ($showValue && !$indeterminate) {
            $html .= '<span class="ws-progress__value">' . round($value) . '%</span>';
        }
    }

    $style = $indeterminate ? '' : ' style="width: ' . $value . '%"';

    $html .= '<div class="' . $wrapperClass . '" ' . $attrString . '>'
        . '<div class="' . $barClass . '"' . $style . '></div>'
        . '</div>';

    if ($hasHeader) {
        $html .= '</div>';
    }

    return $html;
}
