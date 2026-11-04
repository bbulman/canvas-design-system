<?php
/**
 * Alert — portable mirror of ws_alert() / includes/components/alert.php
 *
 * @param string $message  Alert message (supports inline HTML, as in the template)
 * @param array  $options  variant(info|success|warning|error), title, icon (auto by variant),
 *                         dismissible(bool), bordered(bool, default true), filled(bool),
 *                         actions[ {text, href?, onclick?} ], id, class, attrs[]
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function alert(string $message, array $options = []): string
{
    $variant     = $options['variant'] ?? 'info';
    $title       = $options['title'] ?? null;
    $iconName    = $options['icon'] ?? null;
    $dismissible = $options['dismissible'] ?? false;
    $bordered    = $options['bordered'] ?? true;
    $filled      = $options['filled'] ?? false;
    $actions     = $options['actions'] ?? [];
    $id          = $options['id'] ?? null;
    $class       = $options['class'] ?? '';
    $attrs       = $options['attrs'] ?? [];

    if ($iconName === null) {
        $iconName = match ($variant) {
            'success' => 'check_circle',
            'warning' => 'warning',
            'error'   => 'error',
            'info'    => 'info',
            default   => 'info',
        };
    }

    $classString = cx([
        'ws-alert',
        'ws-alert--' . $variant,
        $bordered ? 'ws-alert--bordered' : '',
        $filled ? 'ws-alert--filled' : '',
        $dismissible ? 'ws-alert--dismissible' : '',
        $class,
    ]);

    $attrString = attrs(array_merge(
        $id ? ['id' => $id] : [],
        ['role' => 'alert'],
        $attrs
    ));

    $html = '<div class="' . $classString . '" ' . $attrString . '>';

    if ($iconName) {
        $html .= '<div class="ws-alert__icon">' . icon($iconName) . '</div>';
    }

    $html .= '<div class="ws-alert__content">';
    if ($title) {
        $html .= '<div class="ws-alert__title">' . e($title) . '</div>';
    }
    $html .= '<div class="ws-alert__message">' . $message . '</div>';

    if (!empty($actions)) {
        $html .= '<div class="ws-alert__actions">';
        foreach ($actions as $action) {
            if (isset($action['href'])) {
                $html .= '<a href="' . e($action['href']) . '" class="ws-alert__action">'
                    . e($action['text'] ?? '') . '</a>';
            } else {
                $onclick = isset($action['onclick']) ? ' onclick="' . e($action['onclick']) . '"' : '';
                $html .= '<button type="button" class="ws-alert__action"' . $onclick . '>'
                    . e($action['text'] ?? '') . '</button>';
            }
        }
        $html .= '</div>';
    }
    $html .= '</div>';

    if ($dismissible) {
        $html .= '<button type="button" class="ws-alert__close" aria-label="Dismiss" onclick="this.parentElement.remove()">'
            . icon('close')
            . '</button>';
    }

    $html .= '</div>';

    return $html;
}
