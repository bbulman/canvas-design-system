<?php
/**
 * PageBackground — portable mirror of the "Page Backgrounds" pattern.
 *
 * Wraps page content in one of the platform's three background strategies.
 *
 * @param string $content  Inner page markup.
 * @param array  $options  variant(cream|grid|dots), id, class, attrs[]
 *                          - cream => warm cream (--bg-page), default for main site
 *                          - grid  => paper + grid texture (bg-pattern-grid)
 *                          - dots  => subtle dot texture (bg-pattern-dots)
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function page_background(string $content, array $options = []): string
{
    $variant = $options['variant'] ?? 'cream';
    $id      = $options['id'] ?? null;
    $class   = $options['class'] ?? '';
    $attrs   = $options['attrs'] ?? [];

    $variantClass = [
        'cream' => '',
        'grid'  => 'bg-pattern-grid',
        'dots'  => 'bg-pattern-dots',
    ][$variant] ?? '';

    $classString = cx([
        'bg-page',
        'bg-page--' . $variant,
        $variantClass,
        $class,
    ]);

    $attrString = attrs(array_merge($id ? ['id' => $id] : [], $attrs));
    if ($attrString !== '') {
        $attrString = ' ' . $attrString;
    }

    return '<div class="' . $classString . '"' . $attrString . '>' . $content . '</div>';
}
