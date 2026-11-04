<?php
/**
 * Stats — portable mirror of ws_stats() / includes/components/stats.php
 *
 * Renders a horizontal group of stats separated by dividers.
 *
 * @param array $stats   List of ['value' => '50+', 'label' => 'Workshops', 'color' => '#E54D4D']
 * @param array $options id, class
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';
require_once __DIR__ . '/Stat.php';

function stats(array $stats, array $options = []): string
{
    $id    = $options['id'] ?? null;
    $class = $options['class'] ?? '';

    $classString = cx([
        'ws-stats',
        $class,
    ]);

    $attrString = attrs($id ? ['id' => $id] : []);
    if ($attrString !== '') {
        $attrString = ' ' . $attrString;
    }

    $items = '';
    foreach ($stats as $i => $s) {
        if ($i > 0) {
            $items .= '<div class="ws-stats__divider"></div>';
        }
        $items .= stat($s['value'] ?? '', $s['label'] ?? '', $s);
    }

    return '<div class="' . $classString . '"' . $attrString . '>' . $items . '</div>';
}
