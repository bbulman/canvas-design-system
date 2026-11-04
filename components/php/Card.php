<?php
/**
 * Card — portable mirror of ws_card()/ws_card_start()/ws_card_end()
 *
 * card($content, $options) renders a complete card.
 * card_open($options) / card_close($options) wrap arbitrary markup.
 *
 * @param array $options variant(content|...), hoverable, elevated, bordered,
 *                        tag, href, id, class, attrs[]
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function card_open(array $options = []): string
{
    $tag       = $options['tag'] ?? (isset($options['href']) ? 'a' : 'div');
    $href      = $options['href'] ?? null;
    $variant   = $options['variant'] ?? 'content';
    $hoverable = $options['hoverable'] ?? false;
    $elevated  = $options['elevated'] ?? false;
    $bordered  = $options['bordered'] ?? false;
    $id        = $options['id'] ?? null;
    $class     = $options['class'] ?? '';
    $attrs     = $options['attrs'] ?? [];

    $classString = cx([
        'ws-card',
        'ws-card--' . $variant,
        $hoverable ? 'ws-card--hoverable' : '',
        $elevated ? 'ws-card--elevated' : '',
        $bordered ? 'ws-card--bordered' : '',
        $class,
    ]);

    $attrString = attrs(array_merge(
        $id ? ['id' => $id] : [],
        $href ? ['href' => $href] : [],
        $attrs
    ));
    if ($attrString !== '') {
        $attrString = ' ' . $attrString;
    }

    return '<' . $tag . ' class="' . $classString . '"' . $attrString . '>';
}

function card_close(array $options = []): string
{
    $tag = $options['tag'] ?? (isset($options['href']) ? 'a' : 'div');
    return '</' . $tag . '>';
}

function card(string $content, array $options = []): string
{
    return card_open($options) . $content . card_close($options);
}
