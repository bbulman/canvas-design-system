import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';

export type WsFeatureCardVariant = 'default' | 'compact' | 'coming-soon';

export interface WsFeatureCardProps {
  title: string;
  description: string;
  /** Material Symbols icon name. */
  icon?: string;
  /** Custom icon node (alternative to `icon`, mirrors the PHP `svg` option). */
  svg?: React.ReactNode;
  variant?: WsFeatureCardVariant;
  /** When set, renders the card as an anchor. */
  href?: string;
  id?: string;
  className?: string;
}

/** Mirror of ws_feature_card() — renders the `ws-feature-card` markup. */
export function WsFeatureCard({
  title,
  description,
  icon,
  svg,
  variant = 'default',
  href,
  id,
  className,
}: WsFeatureCardProps): React.ReactElement {
  const classes = cx(
    'ws-feature-card',
    variant !== 'default' && `ws-feature-card--${variant}`,
    className,
  );

  const iconNode = icon ? <Icon name={icon} /> : svg ?? null;

  const inner = (
    <>
      {iconNode && <div className="ws-feature-card__icon">{iconNode}</div>}
      <div className="ws-feature-card__content">
        <h3 className="ws-feature-card__title">{title}</h3>
        <p className="ws-feature-card__desc">{description}</p>
      </div>
    </>
  );

  if (href) {
    return (
      <a id={id} href={href} className={classes}>
        {inner}
      </a>
    );
  }

  return (
    <div id={id} className={classes}>
      {inner}
    </div>
  );
}
