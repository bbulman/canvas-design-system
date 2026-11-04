<?php
/**
 * PageTemplate — portable mirror of the "Standard Page Template" pattern.
 *
 * Wraps page content in the standard container layout with an optional H1.
 * Mirrors the structure every platform page follows:
 *   <div class="container"><h1>…</h1> …content… </div>
 *
 * @param string $content  Inner page markup.
 * @param array  $options  title(string, rendered as <h1>), container(class, default "container"),
 *                          id, class, attrs[]
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function page_template(string $content, array $options = []): string
{
    $title     = $options['title'] ?? null;
    $container = $options['container'] ?? 'container';
    $id        = $options['id'] ?? null;
    $class     = $options['class'] ?? '';
    $attrs     = $options['attrs'] ?? [];

    $classString = cx([$container, $class]);

    $attrString = attrs(array_merge($id ? ['id' => $id] : [], $attrs));
    if ($attrString !== '') {
        $attrString = ' ' . $attrString;
    }

    $heading = $title !== null ? '<h1>' . e($title) . '</h1>' : '';

    return '<div class="' . $classString . '"' . $attrString . '>'
        . $heading
        . $content
        . '</div>';
}
