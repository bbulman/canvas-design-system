<?php
/**
 * Modal — portable mirror of ws_modal_start()/ws_modal_end()/ws_modal()/ws_modal_footer()
 * (includes/components/modal.php, modal-close.php, modal-footer.php)
 *
 * modal_open($options)  opens the overlay + header + body start tag.
 * modal_close($options) closes body (+ optional footer) + modal + overlay.
 * modal($content, $opts) renders a complete modal with body content.
 * modal_footer($options) renders the standardized left/right footer button row.
 *
 * Open/close behavior is driven by the shared components.js (wsModalClose()).
 *
 * @param array $options id, title, subtitle(HTML), icon, size(sm|default|lg|xl|full),
 *                       variant(default|drawer|bottom-sheet), closable(bool),
 *                       backdrop(bool), headerColor(hex), footer(HTML), class, attrs[]
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';
require_once __DIR__ . '/Button.php';

function modal_open(array $options = []): string
{
    $id          = $options['id'] ?? 'ws-modal-' . uniqid();
    $title       = $options['title'] ?? null;
    $subtitle    = $options['subtitle'] ?? null;
    $iconName    = $options['icon'] ?? null;
    $size        = $options['size'] ?? 'default';
    $variant     = $options['variant'] ?? 'default';
    $closable    = $options['closable'] ?? true;
    $backdrop    = $options['backdrop'] ?? true;
    $class       = $options['class'] ?? '';
    $attrs       = $options['attrs'] ?? [];
    $headerColor = $options['headerColor'] ?? null;

    $modalClass = cx([
        'ws-modal',
        'ws-modal--' . $size,
        'ws-modal--' . $variant,
        $class,
    ]);

    $attrString = attrs($attrs);
    if ($attrString !== '') {
        $attrString = ' ' . $attrString;
    }

    $headerStyle = $headerColor
        ? ' style="background: ' . e($headerColor) . '; color: #fff;"'
        : '';

    $overlayClose = $backdrop ? ' data-close-on-click="true"' : '';
    $labelledBy   = $title ? ' aria-labelledby="' . e($id) . '-title"' : '';

    $html = '<div class="ws-modal-overlay" id="' . e($id) . '-overlay"' . $overlayClose . '>'
        . '<div class="' . $modalClass . '" id="' . e($id) . '" role="dialog" aria-modal="true"'
        . $labelledBy . $attrString . '>';

    if ($title || $closable || $iconName) {
        $headerClass = 'ws-modal__header' . (($iconName || $subtitle) ? ' ws-modal__header--illustrated' : '');
        $html .= '<div class="' . $headerClass . '"' . $headerStyle . '>';

        if ($iconName) {
            $html .= '<div class="ws-modal__icon">' . icon($iconName) . '</div>';
        }

        if ($title || $subtitle) {
            $html .= '<div class="ws-modal__title-wrap">';
            if ($title) {
                $html .= '<h2 class="ws-modal__title" id="' . e($id) . '-title">' . e($title) . '</h2>';
            }
            if ($subtitle) {
                $html .= '<p class="ws-modal__subtitle">' . $subtitle . '</p>';
            }
            $html .= '</div>';
        }

        if ($closable) {
            $html .= '<button type="button" class="ws-modal__close" aria-label="Close modal" onclick="wsModalClose(\''
                . e($id) . '\')">'
                . '<span class="material-symbols-outlined">close</span>'
                . '</button>';
        }

        $html .= '</div>';
    }

    $html .= '<div class="ws-modal__body">';

    return $html;
}

function modal_close(array $options = []): string
{
    $footer = $options['footer'] ?? false;

    $html = '</div>';
    if ($footer) {
        $html .= '<div class="ws-modal__footer">' . $footer . '</div>';
    }
    $html .= '</div></div>';

    return $html;
}

function modal(string $content, array $options = []): string
{
    return modal_open($options) . $content . modal_close($options);
}

function modal_footer(array $options): string
{
    $cancel  = $options['cancel'] ?? null;
    $primary = $options['primary'] ?? null;
    $left    = $options['left'] ?? null;
    $id      = $options['id'] ?? null;
    $class   = $options['class'] ?? '';

    $singleBtn = $primary && !$cancel && !$left;
    $fullWidth = $primary && !empty($primary['fullWidth']);

    $classString = cx([
        'ws-modal-footer',
        ($singleBtn || $fullWidth) ? 'ws-modal-footer--single' : '',
        $class,
    ]);

    $idAttr = $id ? ' id="' . e($id) . '"' : '';

    $html = '<div class="' . $classString . '"' . $idAttr . '>';

    if ($left) {
        $html .= '<div class="ws-modal-footer__left">'
            . button($left['text'] ?? '', [
                'variant' => $left['variant'] ?? 'ghost',
                'icon'    => $left['icon'] ?? null,
                'id'      => $left['id'] ?? null,
                'class'   => $left['class'] ?? '',
            ])
            . '</div>';
    }

    $html .= '<div class="ws-modal-footer__right">';

    if ($cancel) {
        $html .= button($cancel['text'] ?? 'Cancel', [
            'variant' => 'secondary',
            'id'      => $cancel['id'] ?? null,
            'class'   => $cancel['class'] ?? '',
        ]);
    }

    if ($primary) {
        $html .= button($primary['text'] ?? 'Confirm', [
            'variant' => 'primary',
            'icon'    => $primary['icon'] ?? null,
            'id'      => $primary['id'] ?? null,
            'class'   => ($primary['class'] ?? '') . ($fullWidth ? ' ws-btn--full-width' : ''),
        ]);
    }

    $html .= '</div></div>';

    return $html;
}
