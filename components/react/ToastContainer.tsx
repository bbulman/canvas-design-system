import React from 'react';

export interface WsToastContainerProps {
  id?: string;
  className?: string;
}

/**
 * Mirror of ws_toast_container() — the live region JS (wsToast) injects toasts into.
 * Render once per page.
 */
export function WsToastContainer({
  id = 'ws-toast-container',
  className = 'ws-toast-container',
}: WsToastContainerProps = {}): React.ReactElement {
  return <div id={id} className={className} aria-live="polite" aria-atomic="true" />;
}
