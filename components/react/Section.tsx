import React from 'react';
import { cx } from './cx';

export type WsSectionVariant =
  | 'light'
  | 'alt'
  | 'dark'
  | 'navy'
  | 'accent-green'
  | 'accent-amber';

export interface WsSectionProps {
  variant?: WsSectionVariant;
  /** Element to render. Defaults to `section`. */
  tag?: 'section' | 'div' | 'footer';
  id?: string;
  className?: string;
  children?: React.ReactNode;
}

/** Mirror of the "Section Variants" pattern — a full-width surface section. */
export function WsSection({
  variant = 'light',
  tag: Tag = 'section',
  id,
  className,
  children,
}: WsSectionProps): React.ReactElement {
  return (
    <Tag id={id} className={cx('section', `section-${variant}`, className)}>
      {children}
    </Tag>
  );
}
