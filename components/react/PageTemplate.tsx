import React from 'react';
import { cx } from './cx';

export interface WsPageTemplateProps {
  /** Rendered as the page <h1>. Omit to skip the heading. */
  title?: string;
  /** Container class. Defaults to "container". */
  container?: string;
  id?: string;
  className?: string;
  children?: React.ReactNode;
}

/** Mirror of the "Standard Page Template" pattern — the container + H1 page shell. */
export function WsPageTemplate({
  title,
  container = 'container',
  id,
  className,
  children,
}: WsPageTemplateProps): React.ReactElement {
  return (
    <div id={id} className={cx(container, className)}>
      {title && <h1>{title}</h1>}
      {children}
    </div>
  );
}
