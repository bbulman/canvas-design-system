<?php
/**
 * Hero — portable mirror of ws_hero() / includes/components/hero.php
 *
 * @param string $title  Primary heading text (HTML allowed; wrapped in <strong>)
 * @param string $accent Italic accent text (brand color)
 * @param array  $options badge, badgeIcon, subtitle, buttons(HTML string[]),
 *                        stats([['value'=>..,'label'=>..]]), statColor(hex),
 *                        image, imageAlt, id, class
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function hero(string $title, string $accent = '', array $options = []): string
{
    $badge     = $options['badge'] ?? '';
    $badgeIcon = $options['badgeIcon'] ?? '';
    $subtitle  = $options['subtitle'] ?? '';
    $buttons   = $options['buttons'] ?? [];
    $stats     = $options['stats'] ?? [];
    $statColor = $options['statColor'] ?? '#E54D4D';
    $image     = $options['image'] ?? '';
    $imageAlt  = $options['imageAlt'] ?? '';
    $id        = $options['id'] ?? '';
    $class     = $options['class'] ?? '';

    $classString = cx(['hero', $class]);
    $idAttr = $id ? ' id="' . e($id) . '"' : '';

    $html = '<header class="' . e($classString) . '"' . $idAttr . '>'
        . '<div class="hero-bg-pattern"></div>'
        . '<div class="hero-container">'
        . '<div class="hero-content">';

    if ($badge) {
        $html .= '<div class="hero-badge">';
        if ($badgeIcon) {
            $html .= icon($badgeIcon);
        }
        $html .= e($badge) . '</div>';
    }

    $html .= '<h1 class="hero-title"><strong>' . $title . '</strong>';
    if ($accent) {
        $html .= '<br><span class="hero-title-accent">' . e($accent) . '</span>';
    }
    $html .= '</h1>';

    if ($subtitle) {
        $html .= '<p class="hero-subtitle">' . e($subtitle) . '</p>';
    }

    if (!empty($buttons)) {
        $html .= '<div class="hero-actions">';
        foreach ($buttons as $btn) {
            $html .= $btn;
        }
        $html .= '</div>';
    }

    if (!empty($stats)) {
        $html .= '<div class="hero-stats">';
        foreach ($stats as $i => $stat) {
            if ($i > 0) {
                $html .= '<div class="hero-stat-divider"></div>';
            }
            $html .= '<div class="hero-stat">'
                . '<span class="stat-number" style="color: ' . e($statColor) . ';">'
                . e($stat['value'] ?? '') . '</span>'
                . '<span class="stat-label">' . e($stat['label'] ?? '') . '</span>'
                . '</div>';
        }
        $html .= '</div>';
    }

    $html .= '</div>';

    if ($image) {
        $html .= '<div class="hero-visual">'
            . '<img src="' . e($image) . '" alt="' . e($imageAlt) . '" class="hero-image">'
            . '</div>';
    }

    $html .= '</div></header>';

    return $html;
}
