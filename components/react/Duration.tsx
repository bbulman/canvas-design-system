import React from 'react';
import { WsBadge } from './Badge';

export interface WsDurationProps {
  /** Duration text (e.g. "1h 30m"). */
  duration: string;
  /** Show the schedule icon (default: true). */
  withIcon?: boolean;
  className?: string;
}

/** Mirror of ws_duration() — small duration badge. */
export function WsDuration({
  duration,
  withIcon = true,
  className,
}: WsDurationProps): React.ReactElement {
  return (
    <WsBadge
      text={duration}
      variant="duration"
      size="sm"
      icon={withIcon ? 'schedule' : undefined}
      className={className}
    />
  );
}
