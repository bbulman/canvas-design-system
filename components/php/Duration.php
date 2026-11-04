<?php
/**
 * Duration — portable mirror of ws_duration()
 *
 * Convenience wrapper over badge() that renders a small duration badge.
 *
 * @param string $duration  Duration text (e.g. "1h 30m")
 * @param bool   $withIcon  Show the schedule icon (default: true)
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';
require_once __DIR__ . '/Badge.php';

function duration(string $duration, bool $withIcon = true): string
{
    return badge($duration, [
        'variant' => 'duration',
        'icon'    => $withIcon ? 'schedule' : null,
        'size'    => 'sm',
    ]);
}
