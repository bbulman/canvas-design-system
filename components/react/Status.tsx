import React from 'react';
import { WsBadge, WsBadgeStatus } from './Badge';

export interface WsStatusProps {
  /** Status text. */
  text: string;
  /** Status type. */
  status?: WsBadgeStatus;
  className?: string;
}

/** Mirror of ws_status() — status badge. */
export function WsStatus({
  text,
  status = 'info',
  className,
}: WsStatusProps): React.ReactElement {
  return (
    <WsBadge
      text={text}
      variant="status"
      status={status}
      className={className}
    />
  );
}
