import React from 'react';
import { cx } from './cx';

export type WsProgressVariant = 'primary' | 'success' | 'warning' | 'error' | 'info';
export type WsProgressSize = 'sm' | 'md' | 'lg';

export interface WsProgressProps {
  /** Progress value 0-100 (clamped). */
  value: number;
  variant?: WsProgressVariant;
  size?: WsProgressSize;
  label?: string;
  showValue?: boolean;
  striped?: boolean;
  animated?: boolean;
  indeterminate?: boolean;
  id?: string;
  className?: string;
}

/** Mirror of ws_progress() — renders the `ws-progress` markup. */
export function WsProgress({
  value,
  variant = 'primary',
  size = 'md',
  label,
  showValue,
  striped,
  animated,
  indeterminate,
  id,
  className,
}: WsProgressProps): React.ReactElement {
  const clamped = Math.max(0, Math.min(100, value));

  const bar = (
    <div
      id={id}
      role="progressbar"
      aria-valuenow={clamped}
      aria-valuemin={0}
      aria-valuemax={100}
      aria-label={label || undefined}
      className={cx('ws-progress', `ws-progress--${size}`, className)}
    >
      <div
        className={cx(
          'ws-progress__bar',
          `ws-progress__bar--${variant}`,
          striped && 'ws-progress__bar--striped',
          animated && 'ws-progress__bar--animated',
          indeterminate && 'ws-progress__bar--indeterminate',
        )}
        style={indeterminate ? undefined : { width: `${clamped}%` }}
      />
    </div>
  );

  const hasHeader = !!label || !!showValue;
  if (!hasHeader) {
    return bar;
  }

  return (
    <div className="ws-progress-wrapper">
      {label && <span className="ws-progress__label">{label}</span>}
      {showValue && !indeterminate && (
        <span className="ws-progress__value">{Math.round(clamped)}%</span>
      )}
      {bar}
    </div>
  );
}
