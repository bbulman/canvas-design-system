import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';

export type WsLevelUpPhase = 'learn' | 'plan' | 'facilitate' | 'reflect';

export interface WsLevelUpApp {
  /** Stable app key, also used to exclude the current app. */
  key: string;
  title: string;
  description: string;
  /** Material Symbols icon name. */
  icon: string;
  phase: WsLevelUpPhase;
  href: string;
  linkText: string;
}

export interface WsLevelUpPhaseCopy {
  title: string;
  description?: string;
}

export interface WsLevelUpGridProps {
  /** App key to exclude from the grid. */
  currentApp?: string;
  /** Small label above the title. */
  eyebrow?: string;
  /** Section heading. */
  title?: string;
  /** App catalog to render. */
  apps: WsLevelUpApp[];
  /** Render per-phase sub-sections with prose intros. */
  groupByPhase?: boolean;
  /** Per-phase title/description copy (used when groupByPhase). */
  phaseCopy?: Partial<Record<WsLevelUpPhase, WsLevelUpPhaseCopy>>;
  id?: string;
  className?: string;
}

const PHASE_ORDER: WsLevelUpPhase[] = ['learn', 'plan', 'facilitate', 'reflect'];

function Card({ app }: { app: WsLevelUpApp }): React.ReactElement {
  return (
    <a
      href={app.href}
      className={`ws-level-up__card ws-level-up__card--${app.phase}`}
      data-phase={app.phase}
      data-app={app.key}
    >
      <div className="ws-level-up__card-icon">
        <Icon name={app.icon} />
      </div>
      <h3 className="ws-level-up__card-title">{app.title}</h3>
      <p className="ws-level-up__card-desc">{app.description}</p>
      <span className="ws-level-up__card-link">
        {app.linkText}
        <Icon name="arrow_forward" />
      </span>
    </a>
  );
}

/** Mirror of ws_level_up_grid() — renders the `ws-level-up` ecosystem grid. */
export function WsLevelUpGrid({
  currentApp,
  eyebrow = 'More from Workshopr',
  title = 'Level Up Your Facilitation',
  apps,
  groupByPhase,
  phaseCopy,
  id,
  className,
}: WsLevelUpGridProps): React.ReactElement {
  const visible = apps.filter((a) => a.key !== currentApp);

  let body: React.ReactNode;
  if (groupByPhase) {
    body = PHASE_ORDER.map((phase) => {
      const phaseApps = visible.filter((a) => a.phase === phase);
      if (phaseApps.length === 0) return null;
      const copy: WsLevelUpPhaseCopy =
        phaseCopy?.[phase] ?? { title: phase.charAt(0).toUpperCase() + phase.slice(1) };
      const gridMod = phaseApps.length <= 3 ? ' ws-level-up__grid--3' : '';
      return (
        <div key={phase} className={`ws-level-up__phase ws-level-up__phase--${phase}`}>
          <div className="ws-level-up__phase-head">
            <h3 className="ws-level-up__phase-title">{copy.title}</h3>
            {copy.description && <p className="ws-level-up__phase-desc">{copy.description}</p>}
          </div>
          <div className={`ws-level-up__grid${gridMod}`}>
            {phaseApps.map((app) => (
              <Card key={app.key} app={app} />
            ))}
          </div>
        </div>
      );
    });
  } else {
    body = (
      <div className="ws-level-up__grid">
        {visible.map((app) => (
          <Card key={app.key} app={app} />
        ))}
      </div>
    );
  }

  return (
    <section id={id} className={cx('ws-level-up', className)}>
      <div className="ws-level-up__container">
        <div className="ws-level-up__header">
          <span className="ws-level-up__eyebrow">
            <Icon name="apps" />
            {eyebrow}
          </span>
          <h2 className="ws-level-up__title">{title}</h2>
        </div>
        {body}
      </div>
    </section>
  );
}
