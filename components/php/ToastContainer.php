<?php
/**
 * ToastContainer — portable mirror of ws_toast_container() / includes/components/toast.php
 *
 * Renders the empty container that JS (wsToast) injects toast notifications into.
 * Include once per page.
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function toast_container(): string
{
    return '<div class="ws-toast-container" id="ws-toast-container" aria-live="polite" aria-atomic="true"></div>';
}
