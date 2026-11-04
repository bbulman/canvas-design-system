import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';
import { WsButton, WsButtonVariant } from './Button';

export type WsModalSize = 'sm' | 'default' | 'lg' | 'xl' | 'full';
export type WsModalVariant = 'default' | 'drawer' | 'bottom-sheet';

export interface WsModalFooterButton {
  text?: string;
  id?: string;
  icon?: string;
  className?: string;
  variant?: WsButtonVariant;
  /** Primary only: render the button full-width. */
  fullWidth?: boolean;
  onClick?: React.MouseEventHandler<HTMLButtonElement | HTMLAnchorElement>;
}

export interface WsModalFooterProps {
  cancel?: WsModalFooterButton;
  primary?: WsModalFooterButton;
  left?: WsModalFooterButton;
  id?: string;
  className?: string;
}

/** Mirror of ws_modal_footer() — standardized left/right button row. */
export function WsModalFooter({
  cancel,
  primary,
  left,
  id,
  className,
}: WsModalFooterProps): React.ReactElement {
  const singleBtn = !!primary && !cancel && !left;
  const fullWidth = !!primary && !!primary.fullWidth;

  return (
    <div
      id={id}
      className={cx('ws-modal-footer', (singleBtn || fullWidth) && 'ws-modal-footer--single', className)}
    >
      {left && (
        <div className="ws-modal-footer__left">
          <WsButton
            text={left.text ?? ''}
            variant={left.variant ?? 'ghost'}
            icon={left.icon}
            id={left.id}
            className={left.className}
            onClick={left.onClick}
          />
        </div>
      )}
      <div className="ws-modal-footer__right">
        {cancel && (
          <WsButton
            text={cancel.text ?? 'Cancel'}
            variant="secondary"
            id={cancel.id}
            className={cancel.className}
            onClick={cancel.onClick}
          />
        )}
        {primary && (
          <WsButton
            text={primary.text ?? 'Confirm'}
            variant="primary"
            icon={primary.icon}
            id={primary.id}
            className={cx(primary.className, fullWidth && 'ws-btn--full-width') || undefined}
            onClick={primary.onClick}
          />
        )}
      </div>
    </div>
  );
}

export interface WsModalProps {
  /** Whether the modal is rendered. When false, nothing is output. */
  open?: boolean;
  /** Fired when the close button (or backdrop, when enabled) is activated. */
  onClose?: () => void;
  id?: string;
  title?: string;
  /** Subtitle node shown under the title. */
  subtitle?: React.ReactNode;
  /** Material Symbols icon shown in a pill next to the title. */
  icon?: string;
  size?: WsModalSize;
  variant?: WsModalVariant;
  closable?: boolean;
  /** Close when the backdrop is clicked. */
  backdrop?: boolean;
  /** Colored header background (hex). */
  headerColor?: string;
  /** Footer node (e.g. <WsModalFooter />). */
  footer?: React.ReactNode;
  className?: string;
  children?: React.ReactNode;
}

let modalSeq = 0;

/** Mirror of ws_modal() — renders the `ws-modal` overlay, header, body and footer. */
export function WsModal({
  open = true,
  onClose,
  id,
  title,
  subtitle,
  icon,
  size = 'default',
  variant = 'default',
  closable = true,
  backdrop = true,
  headerColor,
  footer,
  className,
  children,
}: WsModalProps): React.ReactElement | null {
  const baseId = React.useMemo(() => id ?? `ws-modal-${++modalSeq}`, [id]);

  if (!open) return null;

  const headerStyle: React.CSSProperties | undefined = headerColor
    ? { background: headerColor, color: '#fff' }
    : undefined;

  const showHeader = !!(title || closable || icon);

  return (
    <div
      className="ws-modal-overlay"
      id={`${baseId}-overlay`}
      data-close-on-click={backdrop ? 'true' : undefined}
      onClick={backdrop ? (e) => e.target === e.currentTarget && onClose?.() : undefined}
    >
      <div
        className={cx('ws-modal', `ws-modal--${size}`, `ws-modal--${variant}`, className)}
        id={baseId}
        role="dialog"
        aria-modal="true"
        aria-labelledby={title ? `${baseId}-title` : undefined}
      >
        {showHeader && (
          <div
            className={cx('ws-modal__header', (icon || subtitle) && 'ws-modal__header--illustrated')}
            style={headerStyle}
          >
            {icon && (
              <div className="ws-modal__icon">
                <Icon name={icon} />
              </div>
            )}
            {(title || subtitle) && (
              <div className="ws-modal__title-wrap">
                {title && (
                  <h2 className="ws-modal__title" id={`${baseId}-title`}>
                    {title}
                  </h2>
                )}
                {subtitle && <p className="ws-modal__subtitle">{subtitle}</p>}
              </div>
            )}
            {closable && (
              <button
                type="button"
                className="ws-modal__close"
                aria-label="Close modal"
                onClick={onClose}
              >
                <span className="material-symbols-outlined">close</span>
              </button>
            )}
          </div>
        )}
        <div className="ws-modal__body">{children}</div>
        {footer && <div className="ws-modal__footer">{footer}</div>}
      </div>
    </div>
  );
}
