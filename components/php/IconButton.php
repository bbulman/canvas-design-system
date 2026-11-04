<?php
/**
 * IconButton — portable mirror of ws_icon_button()
 *
 * Convenience wrapper over button() that renders an icon-only ghost button.
 *
 * @param string $icon     Material Symbols icon name
 * @param array  $options  Any button() option (variant, size, href, disabled, etc.)
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';
require_once __DIR__ . '/Button.php';

function icon_button(string $icon, array $options = []): string
{
    return button('', array_merge([
        'icon'    => $icon,
        'variant' => 'ghost',
        'size'    => 'sm',
    ], $options));
}
