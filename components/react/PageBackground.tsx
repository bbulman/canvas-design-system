import React from 'react';
import { cx } from './cx';

export type WsPageBackgroundVariant = 'cream' | 'grid' | 'dots';

export interface WsPageBackgroundProps {
  /**
   * Background strategy:
   * - `cream` warm cream (--bg-page), default for main site
   * - `grid`  paper + grid texture (bg-pattern-grid)
   * - `dots`  subtle dot texture (bg-pattern-dots)
   */
  variant?: WsPageBackgroundVariant;
  id?: string;
  className?: string;
  children?: React.ReactNode;
}

const VARIANT_CLASS: Record<WsPageBackgroundVariant, string> = {
  cream: '',
  grid: 'bg-pattern-grid',
  dots: 'bg-pattern-dots',
};

/** Mirror of the "Page Backgrounds" pattern — wraps content in a page background. */
export function WsPageBackground({
  variant = 'cream',
  id,
  className,
  children,
}: WsPageBackgroundProps): React.ReactElement {
  return (
    <div
      id={id}
      className={cx('bg-page', `bg-page--${variant}`, VARIANT_CLASS[variant], className)}
    >
      {children}
    </div>
  );
}
