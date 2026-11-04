import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';

export interface WsBreadcrumbItem {
  label: string;
  /** Omit on the last item; it renders as the current page. */
  href?: string;
}

export interface WsBreadcrumbProps {
  items: WsBreadcrumbItem[];
  /** Material Symbols separator icon (default: chevron_right). */
  separator?: string;
  id?: string;
  className?: string;
}

/** Mirror of ws_breadcrumb() — renders the `ws-breadcrumb` markup. */
export function WsBreadcrumb({
  items,
  separator = 'chevron_right',
  id,
  className,
}: WsBreadcrumbProps): React.ReactElement {
  return (
    <nav id={id} className={cx('ws-breadcrumb', className)} aria-label="Breadcrumb">
      <ol className="ws-breadcrumb__list">
        {items.map((item, i) => {
          const isLast = i === items.length - 1;
          return (
            <li
              key={i}
              className={cx('ws-breadcrumb__item', isLast && 'ws-breadcrumb__item--current')}
            >
              {item.href && !isLast ? (
                <a href={item.href} className="ws-breadcrumb__link">
                  {item.label}
                </a>
              ) : (
                <span
                  className="ws-breadcrumb__text"
                  aria-current={isLast ? 'page' : undefined}
                >
                  {item.label}
                </span>
              )}
              {!isLast && (
                <span className="ws-breadcrumb__separator">
                  <Icon name={separator} />
                </span>
              )}
            </li>
          );
        })}
      </ol>
    </nav>
  );
}
