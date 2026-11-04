import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';

export interface WsStatProps {
  /** Stat number/value, e.g. "50+". */
  value: string;
  /** Stat label, e.g. "Workshops". */
  label: string;
  /** Value color (hex or CSS var). */
  color?: string;
  /** Material Symbols icon name. */
  icon?: string;
  id?: string;
  className?: string;
}

/** Mirror of ws_stat() — renders the `ws-stat` markup. */
export function WsStat({
  value,
  label,
  color,
  icon,
  id,
  className,
}: WsStatProps): React.ReactElement {
  const style = color ? ({ color } as React.CSSProperties) : undefined;

  return (
    <div id={id} className={cx('ws-stat', className)}>
      {icon && (
        <span className="ws-stat__icon">
          <Icon name={icon} />
        </span>
      )}
      <span className="ws-stat__value" style={style}>
        {value}
      </span>
      <span className="ws-stat__label">{label}</span>
    </div>
  );
}
