<?php
/**
 * Button — portable mirror of ws_button() / includes/components/button.php
 *
 * @param string $text     Button text (empty + icon => icon-only button)
 * @param array  $options  variant(primary|secondary|ghost|danger), size(sm|md|lg),
 *                          icon, iconPosition(left|right), href, type(button|submit|reset),
 *                          disabled(bool), loading(bool), fullWidth(bool), id, class, attrs[]
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function button(string $text, array $options = []): string
{
    $variant      = $options['variant'] ?? 'primary';
    $size         = $options['size'] ?? 'md';
    $icon         = $options['icon'] ?? null;
    $iconPosition = $options['iconPosition'] ?? 'left';
    $href         = $options['href'] ?? null;
    $type         = $options['type'] ?? 'button';
    $disabled     = $options['disabled'] ?? false;
    $loading      = $options['loading'] ?? false;
    $fullWidth    = $options['fullWidth'] ?? false;
    $id           = $options['id'] ?? null;
    $class        = $options['class'] ?? '';
    $attrs        = $options['attrs'] ?? [];

    $classString = cx([
        'ws-btn',
        'ws-btn--' . $variant,
        'ws-btn--' . $size,
        $fullWidth ? 'ws-btn--full' : '',
        $loading ? 'ws-btn--loading' : '',
        ($icon && !$text) ? 'ws-btn--icon-only' : '',
        $class,
    ]);

    $iconHtml = $icon ? '<span class="ws-btn__icon">' . icon($icon) . '</span>' : '';

    $content = '';
    if ($icon && $iconPosition === 'left')  $content .= $iconHtml;
    if ($text)                              $content .= '<span class="ws-btn__text">' . e($text) . '</span>';
    if ($icon && $iconPosition === 'right') $content .= $iconHtml;
    if ($loading)                           $content .= '<span class="ws-btn__spinner"></span>';

    if ($href && !$disabled) {
        $attrString = attrs(array_merge($id ? ['id' => $id] : [], ['href' => $href], $attrs));
        return '<a class="' . $classString . '" ' . $attrString . '>' . $content . '</a>';
    }

    $attrString = attrs(array_merge(
        $id ? ['id' => $id] : [],
        ['type' => $type],
        ($disabled || $loading) ? ['disabled' => true] : [],
        $loading ? ['aria-busy' => 'true'] : [],
        $attrs
    ));
    return '<button class="' . $classString . '" ' . $attrString . '>' . $content . '</button>';
}
