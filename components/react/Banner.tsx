import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';

export type WsBannerVariant = 'default' | 'brand' | 'success' | 'warning' | 'dark';

export interface WsBannerProps {
  /** Banner text. PHP accepts an HTML string; React accepts children. */
  children?: React.ReactNode;
  variant?: WsBannerVariant;
  /** Material Symbols icon name. */
  icon?: string;
  /** Action link label. */
  action?: string;
  href?: string;
  /** Center text (default: true). */
  centered?: boolean;
  dismissible?: boolean;
  id?: string;
  className?: string;
  /** Called when the action link is clicked. */
  onActionClick?: React.MouseEventHandler<HTMLAnchorElement>;
  /** Called when the close button is clicked (dismissible banners only). */
  onClose?: () => void;
}

/** Mirror of ws_banner() — renders the `ws-banner` markup. */
export function WsBanner({
  children,
  variant = 'default',
  icon,
  action,
  href = '#',
  centered = true,
  dismissible,
  id,
  className,
  onActionClick,
  onClose,
}: WsBannerProps): React.ReactElement {
  return (
    <div
      id={id}
      className={cx(
        'ws-banner',
        `ws-banner--${variant}`,
        centered && 'ws-banner--centered',
        className,
      )}
      data-dismissible={dismissible ? '' : undefined}
    >
      <div className="ws-banner__inner">
        {icon && (
          <span className="ws-banner__icon">
            <Icon name={icon} />
          </span>
        )}

        <span className="ws-banner__message">{children}</span>

        {action && (
          <a className="ws-banner__action" href={href} onClick={onActionClick}>
            {action}
            <span className="ws-banner__arrow">&rarr;</span>
          </a>
        )}

        {dismissible && (
          <button
            type="button"
            className="ws-banner__close"
            aria-label="Dismiss banner"
            onClick={onClose}
          >
            <Icon name="close" />
          </button>
        )}
      </div>
    </div>
  );
}
