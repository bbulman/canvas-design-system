import React from 'react';
import { cx } from './cx';

export interface WsSectionHeaderProps {
  title: string;
  /** Secondary text rendered italic + brand color, below the title. */
  subtitle?: string;
  description?: string;
  tag?: 'h2' | 'h3';
  align?: 'left' | 'center';
  /** Small label above the heading. */
  label?: string;
  id?: string;
  className?: string;
}

/** Mirror of ws_section_header() — renders the `ws-section-header` markup. */
export function WsSectionHeader({
  title,
  subtitle,
  description,
  tag = 'h2',
  align = 'center',
  label,
  id,
  className,
}: WsSectionHeaderProps): React.ReactElement {
  const Tag = tag;
  return (
    <div
      id={id}
      className={cx(
        'ws-section-header',
        align !== 'center' && `ws-section-header--${align}`,
        className,
      )}
    >
      {label && <span className="ws-section-header__label">{label}</span>}
      <Tag className="ws-section-header__title">
        {title}
        {subtitle && (
          <>
            <br />
            <span className="ws-section-header__subtitle">{subtitle}</span>
          </>
        )}
      </Tag>
      {description && <p className="ws-section-header__desc">{description}</p>}
    </div>
  );
}
