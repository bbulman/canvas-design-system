import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';

export type WsButtonVariant = 'primary' | 'secondary' | 'ghost' | 'danger';
export type WsButtonSize = 'sm' | 'md' | 'lg';

export interface WsButtonProps {
  /** Button label. Omit (with an `icon`) for an icon-only button. */
  text?: string;
  variant?: WsButtonVariant;
  size?: WsButtonSize;
  /** Material Symbols icon name. */
  icon?: string;
  iconPosition?: 'left' | 'right';
  /** If set, renders an anchor instead of a button. */
  href?: string;
  type?: 'button' | 'submit' | 'reset';
  disabled?: boolean;
  loading?: boolean;
  fullWidth?: boolean;
  id?: string;
  className?: string;
  onClick?: React.MouseEventHandler<HTMLButtonElement | HTMLAnchorElement>;
}

/** Mirror of ws_button() — renders the `ws-btn` markup. */
export function WsButton({
  text,
  variant = 'primary',
  size = 'md',
  icon,
  iconPosition = 'left',
  href,
  type = 'button',
  disabled,
  loading,
  fullWidth,
  id,
  className,
  onClick,
}: WsButtonProps): React.ReactElement {
  const classes = cx(
    'ws-btn',
    `ws-btn--${variant}`,
    `ws-btn--${size}`,
    fullWidth && 'ws-btn--full',
    loading && 'ws-btn--loading',
    icon && !text && 'ws-btn--icon-only',
    className,
  );

  const iconEl = icon ? (
    <span className="ws-btn__icon">
      <Icon name={icon} />
    </span>
  ) : null;

  const content = (
    <>
      {icon && iconPosition === 'left' && iconEl}
      {text && <span className="ws-btn__text">{text}</span>}
      {icon && iconPosition === 'right' && iconEl}
      {loading && <span className="ws-btn__spinner" />}
    </>
  );

  if (href && !disabled) {
    return (
      <a id={id} href={href} className={classes} onClick={onClick}>
        {content}
      </a>
    );
  }

  return (
    <button
      id={id}
      type={type}
      className={classes}
      disabled={disabled || loading}
      aria-busy={loading || undefined}
      onClick={onClick}
    >
      {content}
    </button>
  );
}
