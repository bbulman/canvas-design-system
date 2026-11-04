<?php
/**
 * SectionHeader — portable mirror of ws_section_header() / includes/components/section-header.php
 *
 * @param string $title    Primary heading text
 * @param array  $options  subtitle (italic + brand color), description, tag(h2|h3),
 *                         align(left|center), label, id, class
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function section_header(string $title, array $options = []): string
{
    $subtitle    = $options['subtitle'] ?? null;
    $description = $options['description'] ?? null;
    $tag         = $options['tag'] ?? 'h2';
    $align       = $options['align'] ?? 'center';
    $label       = $options['label'] ?? null;
    $id          = $options['id'] ?? null;
    $class       = $options['class'] ?? '';

    $classString = cx([
        'ws-section-header',
        $align !== 'center' ? 'ws-section-header--' . $align : '',
        $class,
    ]);

    $attrString = attrs($id ? ['id' => $id] : []);
    if ($attrString !== '') {
        $attrString = ' ' . $attrString;
    }

    $html = '<div class="' . $classString . '"' . $attrString . '>';

    if ($label) {
        $html .= '<span class="ws-section-header__label">' . e($label) . '</span>';
    }

    $html .= '<' . $tag . ' class="ws-section-header__title">' . e($title);
    if ($subtitle) {
        $html .= '<br><span class="ws-section-header__subtitle">' . e($subtitle) . '</span>';
    }
    $html .= '</' . $tag . '>';

    if ($description) {
        $html .= '<p class="ws-section-header__desc">' . e($description) . '</p>';
    }

    $html .= '</div>';

    return $html;
}
