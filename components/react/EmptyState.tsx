import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';
import { WsButton, WsButtonVariant } from './Button';

export interface WsEmptyStateProps {
  title: string;
  description?: string;
  /** Material Symbols icon name (default: inbox). Pass empty string to omit. */
  icon?: string;
  /** Action button label. */
  action?: string;
  actionHref?: string;
  actionVariant?: WsButtonVariant;
  id?: string;
  className?: string;
}

/** Mirror of ws_empty_state() — renders the `ws-empty-state` markup. */
export function WsEmptyState({
  title,
  description,
  icon = 'inbox',
  action,
  actionHref,
  actionVariant = 'primary',
  id,
  className,
}: WsEmptyStateProps): React.ReactElement {
  return (
    <div id={id} className={cx('ws-empty-state', className)}>
      {icon && (
        <div className="ws-empty-state__icon">
          <Icon name={icon} />
        </div>
      )}
      <h3 className="ws-empty-state__title">{title}</h3>
      {description && <p className="ws-empty-state__desc">{description}</p>}
      {action && (
        <div className="ws-empty-state__action">
          <WsButton text={action} variant={actionVariant} href={actionHref} />
        </div>
      )}
    </div>
  );
}
