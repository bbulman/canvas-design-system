<?php
/**
 * ActivityBadge — portable mirror of ws_activity_badge() / includes/components/activity-badge.php
 *
 * Type-colored inline badge for exercise/icebreaker/break/custom items.
 *
 * @param string $type    exercise|icebreaker|break|custom
 * @param array  $options text(override display text), size(sm|md), id, class
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function activity_badge(string $type, array $options = []): string
{
    $text  = $options['text'] ?? ucfirst($type);
    $size  = $options['size'] ?? 'md';
    $id    = $options['id'] ?? null;
    $class = $options['class'] ?? '';

    $classString = cx([
        'ws-activity-badge',
        'ws-activity-badge--' . $type,
        $size !== 'md' ? 'ws-activity-badge--' . $size : '',
        $class,
    ]);

    $attrString = attrs($id ? ['id' => $id] : []);
    if ($attrString !== '') {
        $attrString = ' ' . $attrString;
    }

    return '<span class="' . $classString . '"' . $attrString . '>' . e($text) . '</span>';
}
