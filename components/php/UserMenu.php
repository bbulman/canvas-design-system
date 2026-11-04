<?php
/**
 * UserMenu — portable mirror of the "User Menu & Sign-in" pattern.
 *
 * Authentication states + account dropdown for the unified header.
 * Logged-out renders a Sign In CTA; logged-in renders the avatar trigger and
 * the account dropdown (header, menu items, account-type badge).
 *
 * @param array $options
 *   loggedIn(bool), name, email, initials, plan(free|pro|team),
 *   signInHref(string, logged-out CTA), signInText(string),
 *   items(array) — each ['icon'=>'dashboard','text'=>'My Dashboard','href'=>'#',
 *                         'divider'=>false,'danger'=>false]
 *   id, class, attrs[]
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function user_menu(array $options = []): string
{
    $loggedIn   = $options['loggedIn'] ?? false;
    $name       = $options['name'] ?? '';
    $email      = $options['email'] ?? '';
    $initials   = $options['initials'] ?? '';
    $plan       = $options['plan'] ?? null;
    $signInHref = $options['signInHref'] ?? '#';
    $signInText = $options['signInText'] ?? 'Sign In';
    $id         = $options['id'] ?? null;
    $class      = $options['class'] ?? '';
    $attrs      = $options['attrs'] ?? [];

    $classString = cx(['ws-user-menu', $class]);
    $attrString  = attrs(array_merge($id ? ['id' => $id] : [], $attrs));
    if ($attrString !== '') {
        $attrString = ' ' . $attrString;
    }

    /* Logged-out: primary Sign In CTA with the app gradient. */
    if (!$loggedIn) {
        return '<div class="' . $classString . '"' . $attrString . '>'
            . '<a class="ws-user-menu__signin" href="' . e($signInHref) . '">'
            . icon('login')
            . '<span>' . e($signInText) . '</span>'
            . '</a>'
            . '</div>';
    }

    /* Account-type badge (Free / Pro / Team). */
    $planBadge = '';
    if ($plan) {
        $planBadge = '<span class="ws-user-menu__plan ws-user-menu__plan--' . e($plan) . '">'
            . e(ucfirst($plan)) . '</span>';
    }

    /* Menu items. */
    $defaultItems = [
        ['icon' => 'dashboard', 'text' => 'My Dashboard', 'href' => '/app/'],
        ['icon' => 'bookmark',  'text' => 'Saved Items',  'href' => '/app/?view=stuff'],
        ['icon' => 'settings',  'text' => 'Settings',     'href' => '/app/?view=settings'],
        ['divider' => true],
        ['icon' => 'logout',    'text' => 'Sign Out',     'href' => '/logout', 'danger' => true],
    ];
    $items = $options['items'] ?? $defaultItems;

    $itemsHtml = '';
    foreach ($items as $item) {
        if (!empty($item['divider'])) {
            $itemsHtml .= '<div class="ws-user-menu__divider"></div>';
            continue;
        }
        $linkClass = cx([
            'ws-user-menu__item',
            !empty($item['danger']) ? 'ws-user-menu__item--danger' : '',
        ]);
        $itemsHtml .= '<a class="' . $linkClass . '" href="' . e($item['href'] ?? '#') . '">'
            . icon($item['icon'] ?? 'circle', 'ws-user-menu__item-icon')
            . '<span>' . e($item['text'] ?? '') . '</span>'
            . '</a>';
    }

    /* Trigger: avatar + name + chevron. */
    $trigger = '<button type="button" class="ws-user-menu__trigger" aria-haspopup="true" aria-expanded="false">'
        . '<span class="ws-user-menu__avatar">' . e($initials) . '</span>'
        . '<span class="ws-user-menu__name">' . e($name) . '</span>'
        . icon('expand_more', 'ws-user-menu__chevron')
        . '</button>';

    /* Dropdown: header + menu items. */
    $dropdown = '<div class="ws-user-menu__dropdown" role="menu">'
        . '<div class="ws-user-menu__head">'
        . '<span class="ws-user-menu__avatar ws-user-menu__avatar--lg">' . e($initials) . '</span>'
        . '<div class="ws-user-menu__identity">'
        . '<div class="ws-user-menu__display-name">' . e($name) . '</div>'
        . '<div class="ws-user-menu__email">' . e($email) . '</div>'
        . $planBadge
        . '</div>'
        . '</div>'
        . '<div class="ws-user-menu__items">' . $itemsHtml . '</div>'
        . '</div>';

    return '<div class="' . $classString . '"' . $attrString . '>'
        . $trigger
        . $dropdown
        . '</div>';
}
