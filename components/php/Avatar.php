<?php
/**
 * Avatar — portable mirror of ws_avatar() / includes/components/avatar.php
 *
 * @param string $name      User name (used for initials fallback)
 * @param array  $options   image, size(xs|sm|md|lg|xl), color(hex bg for initials),
 *                          ring(bool), status(online|offline|busy), id, class, attrs[]
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function avatar(string $name, array $options = []): string
{
    $image  = $options['image'] ?? null;
    $size   = $options['size'] ?? 'md';
    $color  = $options['color'] ?? null;
    $ring   = $options['ring'] ?? false;
    $status = $options['status'] ?? null;
    $id     = $options['id'] ?? null;
    $class  = $options['class'] ?? '';
    $attrs  = $options['attrs'] ?? [];

    // Generate initials from name
    $initials = '';
    if ($name !== '') {
        $parts = explode(' ', trim($name));
        if (count($parts) >= 2) {
            $initials = strtoupper(substr($parts[0], 0, 1) . substr($parts[count($parts) - 1], 0, 1));
        } else {
            $initials = strtoupper(substr($parts[0], 0, 1));
        }
    }

    $classString = cx([
        'ws-avatar',
        'ws-avatar--' . $size,
        $ring ? 'ws-avatar--ring' : '',
        $status ? 'ws-avatar--has-status' : '',
        !$image ? 'ws-avatar--initials' : '',
        $class,
    ]);

    $style = '';
    if ($color && !$image) {
        $style = ' style="--avatar-bg: ' . e($color) . ';"';
    }

    $attrString = attrs(array_merge(
        $id ? ['id' => $id] : [],
        $attrs,
        ['title' => $name]
    ));
    if ($attrString !== '') {
        $attrString = ' ' . $attrString;
    }

    $inner = $image
        ? '<img src="' . e($image) . '" alt="' . e($name) . '" class="ws-avatar__image" loading="lazy">'
        : '<span class="ws-avatar__initials">' . e($initials) . '</span>';

    $statusHtml = $status
        ? '<span class="ws-avatar__status ws-avatar__status--' . e($status) . '"></span>'
        : '';

    return '<div class="' . $classString . '"' . $style . $attrString . '>'
        . $inner
        . $statusHtml
        . '</div>';
}
