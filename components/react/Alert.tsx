import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';

export type WsAlertVariant = 'info' | 'success' | 'warning' | 'error';

export interface WsAlertAction {
  text: string;
  href?: string;
  onClick?: React.MouseEventHandler<HTMLButtonElement>;
}

export interface WsAlertProps {
  /** Alert body. PHP accepts an HTML string; React accepts children. */
  children?: React.ReactNode;
  variant?: WsAlertVariant;
  title?: string;
  /** Material Symbols icon name. Auto-selected by variant if omitted. Pass empty string to omit. */
  icon?: string;
  dismissible?: boolean;
  /** Left border accent (default: true). */
  bordered?: boolean;
  filled?: boolean;
  actions?: WsAlertAction[];
  id?: string;
  className?: string;
  /** Called when the close button is clicked (dismissible alerts only). */
  onClose?: () => void;
}

const VARIANT_ICONS: Record<WsAlertVariant, string> = {
  success: 'check_circle',
  warning: 'warning',
  error: 'error',
  info: 'info',
};

/** Mirror of ws_alert() — renders the `ws-alert` markup. */
export function WsAlert({
  children,
  variant = 'info',
  title,
  icon,
  dismissible,
  bordered = true,
  filled,
  actions = [],
  id,
  className,
  onClose,
}: WsAlertProps): React.ReactElement {
  const iconName = icon === undefined ? VARIANT_ICONS[variant] : icon;

  return (
    <div
      id={id}
      role="alert"
      className={cx(
        'ws-alert',
        `ws-alert--${variant}`,
        bordered && 'ws-alert--bordered',
        filled && 'ws-alert--filled',
        dismissible && 'ws-alert--dismissible',
        className,
      )}
    >
      {iconName && (
        <div className="ws-alert__icon">
          <Icon name={iconName} />
        </div>
      )}

      <div className="ws-alert__content">
        {title && <div className="ws-alert__title">{title}</div>}
        <div className="ws-alert__message">{children}</div>
        {actions.length > 0 && (
          <div className="ws-alert__actions">
            {actions.map((action, i) =>
              action.href ? (
                <a key={i} href={action.href} className="ws-alert__action">
                  {action.text}
                </a>
              ) : (
                <button
                  key={i}
                  type="button"
                  className="ws-alert__action"
                  onClick={action.onClick}
                >
                  {action.text}
                </button>
              ),
            )}
          </div>
        )}
      </div>

      {dismissible && (
        <button
          type="button"
          className="ws-alert__close"
          aria-label="Dismiss"
          onClick={onClose}
        >
          <Icon name="close" />
        </button>
      )}
    </div>
  );
}
