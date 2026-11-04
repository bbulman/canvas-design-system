import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';

export interface WsHeroStat {
  value: string;
  label: string;
}

export interface WsHeroProps {
  /** Primary heading content (wrapped in <strong>). */
  title: React.ReactNode;
  /** Italic accent text shown in brand color below the title. */
  accent?: string;
  badge?: string;
  /** Material Symbols icon name shown in the badge. */
  badgeIcon?: string;
  subtitle?: string;
  /** Action buttons (e.g. <WsButton /> elements). */
  buttons?: React.ReactNode;
  stats?: WsHeroStat[];
  /** Color for stat values (default: #E54D4D). */
  statColor?: string;
  image?: string;
  imageAlt?: string;
  id?: string;
  className?: string;
}

/** Mirror of ws_hero() — renders the standard `hero` section. */
export function WsHero({
  title,
  accent = '',
  badge = '',
  badgeIcon = '',
  subtitle = '',
  buttons,
  stats = [],
  statColor = '#E54D4D',
  image = '',
  imageAlt = '',
  id,
  className,
}: WsHeroProps): React.ReactElement {
  return (
    <header className={cx('hero', className)} id={id || undefined}>
      <div className="hero-bg-pattern" />
      <div className="hero-container">
        <div className="hero-content">
          {badge && (
            <div className="hero-badge">
              {badgeIcon && <Icon name={badgeIcon} />}
              {badge}
            </div>
          )}

          <h1 className="hero-title">
            <strong>{title}</strong>
            {accent && (
              <>
                <br />
                <span className="hero-title-accent">{accent}</span>
              </>
            )}
          </h1>

          {subtitle && <p className="hero-subtitle">{subtitle}</p>}

          {buttons && <div className="hero-actions">{buttons}</div>}

          {stats.length > 0 && (
            <div className="hero-stats">
              {stats.map((stat, i) => (
                <React.Fragment key={`${stat.label}-${i}`}>
                  {i > 0 && <div className="hero-stat-divider" />}
                  <div className="hero-stat">
                    <span className="stat-number" style={{ color: statColor }}>
                      {stat.value}
                    </span>
                    <span className="stat-label">{stat.label}</span>
                  </div>
                </React.Fragment>
              ))}
            </div>
          )}
        </div>

        {image && (
          <div className="hero-visual">
            <img src={image} alt={imageAlt} className="hero-image" />
          </div>
        )}
      </div>
    </header>
  );
}
