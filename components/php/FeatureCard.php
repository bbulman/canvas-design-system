<?php
/**
 * FeatureCard — portable mirror of ws_feature_card() / includes/components/feature-card.php
 *
 * @param string $title       Card title
 * @param string $description Card description
 * @param array  $options     icon, svg(raw HTML), variant(default|compact|coming-soon),
 *                            href, id, class, attrs[]
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function feature_card(string $title, string $description, array $options = []): string
{
    $iconName = $options['icon'] ?? null;
    $svg      = $options['svg'] ?? null;
    $variant  = $options['variant'] ?? 'default';
    $href     = $options['href'] ?? null;
    $id       = $options['id'] ?? null;
    $class    = $options['class'] ?? '';
    $attrs    = $options['attrs'] ?? [];

    $classString = cx([
        'ws-feature-card',
        $variant !== 'default' ? 'ws-feature-card--' . $variant : '',
        $class,
    ]);

    $tag = $href ? 'a' : 'div';

    $attrString = attrs(array_merge(
        $id ? ['id' => $id] : [],
        $href ? ['href' => $href] : [],
        $attrs
    ));
    if ($attrString !== '') {
        $attrString = ' ' . $attrString;
    }

    $iconHtml = '';
    if ($iconName) {
        $iconHtml = icon($iconName);
    } elseif ($svg) {
        $iconHtml = $svg;
    }

    $html = '<' . $tag . ' class="' . $classString . '"' . $attrString . '>';

    if ($iconHtml) {
        $html .= '<div class="ws-feature-card__icon">' . $iconHtml . '</div>';
    }

    $html .= '<div class="ws-feature-card__content">'
        . '<h3 class="ws-feature-card__title">' . e($title) . '</h3>'
        . '<p class="ws-feature-card__desc">' . e($description) . '</p>'
        . '</div>'
        . '</' . $tag . '>';

    return $html;
}
