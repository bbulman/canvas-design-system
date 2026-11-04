<?php
/**
 * Skeleton — portable mirror of ws_skeleton() / includes/components/skeleton.php
 *
 * @param array $options  variant(text|avatar|image|card|workshop|button|input), size(sm|md|lg),
 *                        lines(int, text variant), count(int, workshop variant),
 *                        width, height, rounded(bool), circle(bool), id, class, attrs[]
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function skeleton(array $options = []): string
{
    $variant = $options['variant'] ?? 'text';
    $size    = $options['size'] ?? 'md';
    $lines   = $options['lines'] ?? 1;
    $width   = $options['width'] ?? null;
    $height  = $options['height'] ?? null;
    $rounded = $options['rounded'] ?? null;
    $circle  = $options['circle'] ?? false;
    $id      = $options['id'] ?? null;
    $class   = $options['class'] ?? '';
    $attrs   = $options['attrs'] ?? [];

    $classString = cx([
        'ws-skeleton',
        'ws-skeleton--' . $variant,
        $size !== 'md' ? 'ws-skeleton--' . $size : '',
        $circle ? 'ws-skeleton--circle' : '',
        $rounded === true ? 'ws-skeleton--rounded' : '',
        $class,
    ]);

    $styles = [];
    if ($width)  $styles[] = 'width: ' . e($width);
    if ($height) $styles[] = 'height: ' . e($height);
    $style = $styles ? ' style="' . implode('; ', $styles) . '"' : '';

    $attrString = attrs(array_merge(
        $id ? ['id' => $id] : [],
        ['aria-hidden' => 'true'],
        $attrs
    ));
    if ($attrString !== '') {
        $attrString = ' ' . $attrString;
    }

    if ($variant === 'card') {
        return '<div class="' . cx(['ws-skeleton-card', $class]) . '"' . $attrString . '>'
            . '<div class="ws-skeleton ws-skeleton--image"></div>'
            . '<div class="ws-skeleton-card__body">'
            . '<div class="ws-skeleton ws-skeleton--text ws-skeleton--text-title"></div>'
            . '<div class="ws-skeleton ws-skeleton--text"></div>'
            . '<div class="ws-skeleton ws-skeleton--text ws-skeleton--text-short"></div>'
            . '</div>'
            . '</div>';
    }

    // Workshop card placeholder — mirrors the saved-workshop card on the app
    // homes (name, meta, lifecycle, footer action) so the grid keeps its shape.
    if ($variant === 'workshop') {
        $count = max(1, (int)($options['count'] ?? 1));
        $out = '';
        for ($i = 0; $i < $count; $i++) {
            $out .= '<div class="' . cx(['ws-skeleton-workshop', $class]) . '"'
                . ($i === 0 ? $attrString : ' aria-hidden="true"') . '>'
                . '<div class="ws-skeleton ws-skeleton--text ws-skeleton--text-title"></div>'
                . '<div class="ws-skeleton-workshop__meta">'
                . '<div class="ws-skeleton ws-skeleton-workshop__chip"></div>'
                . '<div class="ws-skeleton ws-skeleton-workshop__chip ws-skeleton-workshop__chip--wide"></div>'
                . '<div class="ws-skeleton ws-skeleton-workshop__chip"></div>'
                . '</div>'
                . '<div class="ws-skeleton-workshop__life">'
                . '<div class="ws-skeleton ws-skeleton-workshop__dot"></div>'
                . '<div class="ws-skeleton ws-skeleton-workshop__bar"></div>'
                . '<div class="ws-skeleton ws-skeleton-workshop__dot"></div>'
                . '<div class="ws-skeleton ws-skeleton-workshop__bar"></div>'
                . '<div class="ws-skeleton ws-skeleton-workshop__dot"></div>'
                . '</div>'
                . '<div class="ws-skeleton-workshop__foot">'
                . '<div class="ws-skeleton ws-skeleton--button ws-skeleton--sm"></div>'
                . '</div>'
                . '</div>';
        }
        return $out;
    }

    if ($variant === 'text' && $lines > 1) {
        $rows = '';
        for ($i = 0; $i < $lines; $i++) {
            $shortCls = ($i === $lines - 1) ? ' ws-skeleton--text-short' : '';
            $rows .= '<div class="ws-skeleton ws-skeleton--text' . $shortCls . '"' . $style . '></div>';
        }
        return '<div class="' . cx(['ws-skeleton-text', $class]) . '"' . $attrString . '>' . $rows . '</div>';
    }

    return '<div class="' . $classString . '"' . $style . $attrString . '></div>';
}
