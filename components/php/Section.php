<?php
/**
 * Section — portable mirror of the "Section Variants" pattern.
 *
 * Renders a full-width page section in one of the platform's surface variants.
 *
 * @param string $content  Inner section markup.
 * @param array  $options  variant(light|alt|dark|navy|accent-green|accent-amber),
 *                          tag(section|div|footer), id, class, attrs[]
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function section(string $content, array $options = []): string
{
    $variant = $options['variant'] ?? 'light';
    $tag     = $options['tag'] ?? 'section';
    $id      = $options['id'] ?? null;
    $class   = $options['class'] ?? '';
    $attrs   = $options['attrs'] ?? [];

    $classString = cx([
        'section',
        'section-' . $variant,
        $class,
    ]);

    $attrString = attrs(array_merge($id ? ['id' => $id] : [], $attrs));
    if ($attrString !== '') {
        $attrString = ' ' . $attrString;
    }

    return '<' . $tag . ' class="' . $classString . '"' . $attrString . '>'
        . $content
        . '</' . $tag . '>';
}
