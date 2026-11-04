<?php
/**
 * Banner — portable mirror of ws_banner() / includes/components/banner.php
 *
 * Full-width announcement/promotional banner for the top of pages.
 *
 * @param string $message  Banner text content (supports inline HTML, as in the template)
 * @param array  $options  variant(default|brand|success|warning|dark), icon, action,
 *                         href, onclick, dismissible(bool), centered(bool, default true),
 *                         id, class
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function banner(string $message, array $options = []): string
{
    $variant     = $options['variant'] ?? 'default';
    $iconName    = $options['icon'] ?? '';
    $action      = $options['action'] ?? '';
    $href        = $options['href'] ?? '#';
    $onclick     = $options['onclick'] ?? '';
    $dismissible = $options['dismissible'] ?? false;
    $id          = $options['id'] ?? '';
    $class       = $options['class'] ?? '';
    $centered    = $options['centered'] ?? true;

    $classString = cx([
        'ws-banner',
        'ws-banner--' . $variant,
        $centered ? 'ws-banner--centered' : '',
        $class,
    ]);

    $rootAttrs = ($id ? ' id="' . e($id) . '"' : '') . ($dismissible ? ' data-dismissible' : '');

    $html = '<div class="' . $classString . '"' . $rootAttrs . '>'
        . '<div class="ws-banner__inner">';

    if ($iconName) {
        $html .= '<span class="ws-banner__icon">' . icon($iconName) . '</span>';
    }

    $html .= '<span class="ws-banner__message">' . $message . '</span>';

    if ($action) {
        $onclickAttr = $onclick ? ' onclick="' . e($onclick) . '"' : '';
        $html .= '<a class="ws-banner__action" href="' . e($href) . '"' . $onclickAttr . '>'
            . e($action)
            . '<span class="ws-banner__arrow">&rarr;</span>'
            . '</a>';
    }

    if ($dismissible) {
        $html .= '<button type="button" class="ws-banner__close" '
            . 'onclick="this.closest(\'.ws-banner\').style.display=\'none\'" aria-label="Dismiss banner">'
            . icon('close')
            . '</button>';
    }

    $html .= '</div></div>';

    return $html;
}
