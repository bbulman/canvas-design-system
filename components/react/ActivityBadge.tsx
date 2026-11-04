import React from 'react';
import { cx } from './cx';

export type WsActivityBadgeType = 'exercise' | 'icebreaker' | 'break' | 'custom';
export type WsActivityBadgeSize = 'sm' | 'md';

export interface WsActivityBadgeProps {
  type: WsActivityBadgeType;
  /** Override display text (default: capitalized type). */
  text?: string;
  size?: WsActivityBadgeSize;
  id?: string;
  className?: string;
}

const capitalize = (s: string): string => (s ? s.charAt(0).toUpperCase() + s.slice(1) : s);

/** Mirror of ws_activity_badge() — renders the `ws-activity-badge` markup. */
export function WsActivityBadge({
  type,
  text,
  size = 'md',
  id,
  className,
}: WsActivityBadgeProps): React.ReactElement {
  return (
    <span
      id={id}
      className={cx(
        'ws-activity-badge',
        `ws-activity-badge--${type}`,
        size !== 'md' && `ws-activity-badge--${size}`,
        className,
      )}
    >
      {text ?? capitalize(type)}
    </span>
  );
}
