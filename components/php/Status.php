<?php
/**
 * Status — portable mirror of ws_status()
 *
 * Convenience wrapper over badge() that renders a status badge.
 *
 * @param string $text    Status text
 * @param string $status  Status type (success|warning|error|info)
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';
require_once __DIR__ . '/Badge.php';

function status(string $text, string $status = 'info'): string
{
    return badge($text, [
        'variant' => 'status',
        'status'  => $status,
    ]);
}
