import React from 'react';
import { cx } from './cx';

export interface WsCardProps {
  variant?: string;
  hoverable?: boolean;
  elevated?: boolean;
  bordered?: boolean;
  /** Render as an anchor when set. */
  href?: string;
  id?: string;
  className?: string;
  children?: React.ReactNode;
}

/** Mirror of ws_card() — renders the `ws-card` container. */
export function WsCard({
  variant = 'content',
  hoverable,
  elevated,
  bordered,
  href,
  id,
  className,
  children,
}: WsCardProps): React.ReactElement {
  const classes = cx(
    'ws-card',
    `ws-card--${variant}`,
    hoverable && 'ws-card--hoverable',
    elevated && 'ws-card--elevated',
    bordered && 'ws-card--bordered',
    className,
  );

  if (href) {
    return (
      <a id={id} href={href} className={classes}>
        {children}
      </a>
    );
  }

  return (
    <div id={id} className={classes}>
      {children}
    </div>
  );
}
