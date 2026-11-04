import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';

export type WsBadgeVariant = 'default' | 'duration' | 'category' | 'status' | 'count' | 'new';
export type WsBadgeSize = 'sm' | 'md' | 'lg';
export type WsBadgeStatus = 'success' | 'warning' | 'error' | 'info';

export interface WsBadgeProps {
  text: string;
  variant?: WsBadgeVariant;
  size?: WsBadgeSize;
  /** Material Symbols icon name. */
  icon?: string;
  /** Custom hex color, applied for the `category` variant only. */
  color?: string;
  status?: WsBadgeStatus;
  pill?: boolean;
  id?: string;
  className?: string;
}

/** Mirror of ws_badge() — renders the `ws-badge` markup. */
export function WsBadge({
  text,
  variant = 'default',
  size = 'md',
  icon,
  color,
  status,
  pill,
  id,
  className,
}: WsBadgeProps): React.ReactElement {
  const style =
    color && variant === 'category'
      ? ({ '--badge-color': color, '--badge-bg': `${color}1A` } as React.CSSProperties)
      : undefined;

  return (
    <span
      id={id}
      className={cx(
        'ws-badge',
        `ws-badge--${variant}`,
        `ws-badge--${size}`,
        pill && 'ws-badge--pill',
        status && `ws-badge--${status}`,
        className,
      )}
      style={style}
    >
      {icon && (
        <span className="ws-badge__icon">
          <Icon name={icon} />
        </span>
      )}
      <span className="ws-badge__text">{text}</span>
    </span>
  );
}
