<?php
/**
 * Category — portable mirror of ws_category()
 *
 * Convenience wrapper over badge() that renders a category badge.
 *
 * @param string      $category  Category name
 * @param string|null $color     Category color (hex), applied to the category variant
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';
require_once __DIR__ . '/Badge.php';

function category(string $category, ?string $color = null): string
{
    return badge($category, [
        'variant' => 'category',
        'color'   => $color,
    ]);
}
