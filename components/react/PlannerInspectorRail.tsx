import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';
import { WsEnergyArcCard, WsEnergyArcCardProps } from './EnergyArcCard';

export interface WsInspectorEnergy {
  title?: string;
  meta?: string;
  card?: WsEnergyArcCardProps;
}

export interface WsInspectorCoachItem {
  /** Material Symbols icon name. Defaults from the `pre` label. */
  icon?: string;
  pre?: string;
  /** May contain inline markup (rendered as HTML). */
  line?: string;
  meta?: string;
  action?: string;
  href?: string;
}

export interface WsInspectorCoach {
  title?: string;
  meta?: string;
  items: WsInspectorCoachItem[];
}

export interface WsInspectorAvatar {
  initials: string;
  /** Background color or gradient. */
  bg?: string;
}

export interface WsInspectorPresence {
  name?: string;
  status?: string;
}

export interface WsInspectorFacilitators {
  title?: string;
  meta?: string;
  avatars?: WsInspectorAvatar[];
  presence?: WsInspectorPresence;
}

export interface WsPlannerInspectorRailProps {
  energy?: WsInspectorEnergy;
  coach?: WsInspectorCoach;
  facilitators?: WsInspectorFacilitators;
  id?: string;
  className?: string;
}

const DEFAULT_ICON: Record<string, string> = {
  TIMING: 'schedule',
  ENERGY: 'monitoring',
  CLOSE: 'chat_bubble',
  PACE: 'speed',
  FOCUS: 'center_focus_strong',
};

function SectionTitle({ title, meta }: { title: string; meta: string }): React.ReactElement | null {
  if (title === '' && meta === '') return null;
  return (
    <div className="ws-planner-inspector-rail__title">
      <span>{title}</span>
      {meta !== '' && <b>{meta}</b>}
    </div>
  );
}

/** Mirror of ws_planner_inspector_rail() — renders the `ws-planner-inspector-rail` markup. */
export function WsPlannerInspectorRail({
  energy,
  coach,
  facilitators,
  id,
  className,
}: WsPlannerInspectorRailProps): React.ReactElement {
  // Inspector energy cards are headerless and default to the compact "note" badge.
  const energyCard: WsEnergyArcCardProps | undefined = energy
    ? {
        showHeader: false,
        ...energy.card,
        scoreBadge: energy.card?.scoreBadge
          ? { variant: 'note', ...energy.card.scoreBadge }
          : energy.card?.scoreBadge,
      }
    : undefined;

  return (
    <aside id={id} className={cx('ws-planner-inspector-rail', className)}>
      {energy && energyCard && (
        <section className="ws-planner-inspector-rail__section">
          <SectionTitle title={energy.title ?? ''} meta={energy.meta ?? ''} />
          <div className="ws-planner-inspector-rail__energy">
            <WsEnergyArcCard {...energyCard} />
          </div>
        </section>
      )}

      {coach && coach.items.length > 0 && (
        <section className="ws-planner-inspector-rail__section">
          <SectionTitle title={coach.title ?? ''} meta={coach.meta ?? ''} />
          <div className="ws-planner-inspector-rail__suggestions">
            {coach.items.map((item, i) => {
              const pre = item.pre ?? '';
              const line = item.line ?? '';
              const meta = item.meta ?? '';
              const action = item.action ?? '';
              const iconName = item.icon ?? DEFAULT_ICON[pre.toUpperCase()] ?? 'lightbulb';
              const Tag = (item.href ? 'a' : 'button') as 'a' | 'button';
              const tagProps = item.href
                ? { href: item.href }
                : ({ type: 'button' } as { type: 'button' });
              return (
                <Tag key={i} className="ws-planner-inspector-rail__sugg" {...tagProps}>
                  <span className="ws-planner-inspector-rail__sugg-icon" aria-hidden="true">
                    <Icon name={iconName} />
                  </span>
                  {pre !== '' && (
                    <span className="ws-planner-inspector-rail__sugg-pre">{pre.toUpperCase()}</span>
                  )}
                  {line !== '' && (
                    <p
                      className="ws-planner-inspector-rail__sugg-line"
                      dangerouslySetInnerHTML={{ __html: line }}
                    />
                  )}
                  {(meta !== '' || action !== '') && (
                    <span className="ws-planner-inspector-rail__sugg-meta">
                      {meta !== '' && <span>{meta}</span>}
                      {action !== '' && <span>· {action}</span>}
                    </span>
                  )}
                </Tag>
              );
            })}
          </div>
        </section>
      )}

      {facilitators &&
        ((facilitators.avatars && facilitators.avatars.length > 0) || facilitators.presence) && (
          <section className="ws-planner-inspector-rail__section ws-planner-inspector-rail__section--last">
            <SectionTitle title={facilitators.title ?? ''} meta={facilitators.meta ?? ''} />
            <div className="ws-planner-inspector-rail__presence">
              {facilitators.avatars && facilitators.avatars.length > 0 && (
                <div className="ws-planner-inspector-rail__avatars" aria-hidden="true">
                  {facilitators.avatars.map((a, i) => (
                    <span key={i} style={{ background: a.bg ?? '#888' }}>
                      {a.initials ?? '?'}
                    </span>
                  ))}
                </div>
              )}
              {facilitators.presence && (
                <div className="ws-planner-inspector-rail__presence-meta">
                  {facilitators.presence.name && <b>{facilitators.presence.name}</b>}
                  {facilitators.presence.status && <span>{facilitators.presence.status}</span>}
                </div>
              )}
            </div>
          </section>
        )}
    </aside>
  );
}
