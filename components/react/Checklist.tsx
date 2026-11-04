import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';

export type WsChecklistVariant = 'default' | 'compact';

export interface WsChecklistProps {
  items: string[];
  /** Material Symbols icon name (default: check_circle). */
  icon?: string;
  variant?: WsChecklistVariant;
  id?: string;
  className?: string;
}

/** Mirror of ws_checklist() — renders the `ws-checklist` list. */
export function WsChecklist({
  items,
  icon = 'check_circle',
  variant = 'default',
  id,
  className,
}: WsChecklistProps): React.ReactElement {
  const classes = cx(
    'ws-checklist',
    variant !== 'default' && `ws-checklist--${variant}`,
    className,
  );

  return (
    <ul className={classes} id={id}>
      {items.map((item, i) => (
        <li className="ws-checklist__item" key={i}>
          <span className="ws-checklist__icon">
            <Icon name={icon} />
          </span>
          <span className="ws-checklist__text">{item}</span>
        </li>
      ))}
    </ul>
  );
}
