import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';

export type WsActivityInspectorType = 'exercise' | 'icebreaker' | 'break' | 'custom';

export interface WsActivityEnergyDimension {
  label: string;
  delta: string;
  /** 0..100 */
  fill?: number;
}

export interface WsActivityEnergy {
  net?: string;
  dimensions: WsActivityEnergyDimension[];
}

export interface WsActivityNotes {
  body: string;
  author?: string;
  date?: string;
  canAdd?: boolean;
}

export interface WsActivityContext {
  time?: string;
  description?: string;
}

export interface WsActivityAction {
  label: string;
  icon?: string;
  action?: string;
  href?: string;
}

export interface WsPlannerActivityInspectorProps {
  type?: WsActivityInspectorType;
  duration?: string;
  groupSize?: string;
  title: string;
  tags?: string[];
  closable?: boolean;
  overview?: string;
  /** Step strings (numbered list) or an HTML string. When set, Overview becomes tabbed. */
  instructions?: string[] | string;
  activeTab?: 'overview' | 'instructions';
  energy?: WsActivityEnergy;
  logistics?: string[];
  notes?: WsActivityNotes;
  context?: WsActivityContext;
  actions?: WsActivityAction[];
  destructive?: WsActivityAction;
  id?: string;
  className?: string;
}

const TYPE_LABEL: Record<WsActivityInspectorType, string> = {
  exercise: 'EXERCISE',
  icebreaker: 'ICEBREAKER',
  break: 'BREAK',
  custom: 'CUSTOM',
};

const clamp = (n: number, min: number, max: number): number => Math.min(Math.max(n, min), max);

function ActionButton({
  action,
  variant = 'default',
}: {
  action: WsActivityAction;
  variant?: 'default' | 'danger';
}): React.ReactElement {
  const label = action.label ?? '';
  const actionKey = action.action ?? label.toLowerCase().replace(/ /g, '-');
  const Tag = (action.href ? 'a' : 'button') as 'a' | 'button';
  const tagProps = action.href ? { href: action.href } : ({ type: 'button' } as { type: 'button' });
  return (
    <Tag
      className={cx(
        'ws-planner-activity-inspector__btn',
        variant === 'danger' && 'ws-planner-activity-inspector__btn--danger',
      )}
      data-action={actionKey}
      {...tagProps}
    >
      {action.icon && (
        <span className="ws-planner-activity-inspector__btn-icon" aria-hidden="true">
          <Icon name={action.icon} />
        </span>
      )}
      <span className="ws-planner-activity-inspector__btn-label">{label}</span>
    </Tag>
  );
}

/** Mirror of ws_planner_activity_inspector() — renders the `ws-planner-activity-inspector` markup. */
export function WsPlannerActivityInspector({
  type = 'exercise',
  duration = '',
  groupSize = '',
  title,
  tags = [],
  closable = true,
  overview = '',
  instructions,
  activeTab = 'overview',
  energy,
  logistics = [],
  notes,
  context,
  actions = [],
  destructive,
  id,
  className,
}: WsPlannerActivityInspectorProps): React.ReactElement {
  const tabGroup = React.useId();
  const eyebrowText = [TYPE_LABEL[type], duration, groupSize].filter((v) => v !== '').join(' · ');

  const hasInstructions = Array.isArray(instructions)
    ? instructions.length > 0
    : typeof instructions === 'string' && instructions.trim() !== '';

  const overviewActive = activeTab === 'overview';

  return (
    <aside
      id={id}
      className={cx('ws-planner-activity-inspector', `ws-planner-activity-inspector--${type}`, className)}
    >
      {/* Identity */}
      <section className="ws-planner-activity-inspector__section">
        <div className="ws-planner-activity-inspector__eyebrow-row">
          <span className="ws-planner-activity-inspector__eyebrow">{eyebrowText}</span>
          {closable && (
            <button
              type="button"
              className="ws-planner-activity-inspector__close"
              aria-label="Close inspector"
              data-action="close"
            >
              &times;
            </button>
          )}
        </div>
        <h2 className="ws-planner-activity-inspector__title">{title}</h2>
        {tags.length > 0 && (
          <p className="ws-planner-activity-inspector__tags">{tags.join(' · ').toUpperCase()}</p>
        )}
      </section>

      {/* Overview / Instructions */}
      {(overview !== '' || hasInstructions) &&
        (hasInstructions ? (
          <section className="ws-planner-activity-inspector__section" data-tab-group={tabGroup}>
            <div className="ws-planner-activity-inspector__tabs" role="tablist">
              <button
                type="button"
                className={cx('ws-planner-activity-inspector__tab', overviewActive && 'is-active')}
                role="tab"
                aria-selected={overviewActive}
                aria-controls={`${tabGroup}-overview`}
                data-tab="overview"
              >
                Overview
              </button>
              <button
                type="button"
                className={cx('ws-planner-activity-inspector__tab', !overviewActive && 'is-active')}
                role="tab"
                aria-selected={!overviewActive}
                aria-controls={`${tabGroup}-instructions`}
                data-tab="instructions"
              >
                Instructions
              </button>
            </div>

            <div
              className={cx('ws-planner-activity-inspector__panel', overviewActive && 'is-active')}
              id={`${tabGroup}-overview`}
              role="tabpanel"
              data-panel="overview"
              hidden={!overviewActive}
            >
              {overview !== '' ? (
                <p className="ws-planner-activity-inspector__body">{overview}</p>
              ) : (
                <p className="ws-planner-activity-inspector__body ws-planner-activity-inspector__body--empty">
                  No overview yet.
                </p>
              )}
            </div>

            <div
              className={cx('ws-planner-activity-inspector__panel', !overviewActive && 'is-active')}
              id={`${tabGroup}-instructions`}
              role="tabpanel"
              data-panel="instructions"
              hidden={overviewActive}
            >
              {Array.isArray(instructions) ? (
                <ol className="ws-planner-activity-inspector__steps">
                  {instructions.map((step, i) => (
                    <li key={i} className="ws-planner-activity-inspector__step">
                      {step}
                    </li>
                  ))}
                </ol>
              ) : (
                <div
                  className="ws-planner-activity-inspector__instructions-html"
                  dangerouslySetInnerHTML={{ __html: instructions as string }}
                />
              )}
            </div>
          </section>
        ) : (
          <section className="ws-planner-activity-inspector__section">
            <div className="ws-planner-activity-inspector__label">
              <span>Overview</span>
            </div>
            <p className="ws-planner-activity-inspector__body">{overview}</p>
          </section>
        ))}

      {/* Energy impact */}
      {energy && energy.dimensions.length > 0 && (
        <section className="ws-planner-activity-inspector__section">
          <div className="ws-planner-activity-inspector__label">
            <span>Energy impact</span>
            {energy.net && energy.net !== '' && (
              <span className="ws-planner-activity-inspector__net">{energy.net} NET</span>
            )}
          </div>
          <div className="ws-planner-activity-inspector__dims">
            {energy.dimensions.map((d, i) => (
              <div key={i} className="ws-planner-activity-inspector__dim">
                <span className="ws-planner-activity-inspector__dim-label">{d.label}</span>
                <span className="ws-planner-activity-inspector__dim-bar" aria-hidden="true">
                  <span
                    className="ws-planner-activity-inspector__dim-fill"
                    style={{ width: `${clamp(d.fill ?? 0, 0, 100).toFixed(2)}%` }}
                  />
                </span>
                <span className="ws-planner-activity-inspector__dim-val">{d.delta}</span>
              </div>
            ))}
          </div>
        </section>
      )}

      {/* Logistics */}
      {logistics.length > 0 && (
        <section className="ws-planner-activity-inspector__section">
          <div className="ws-planner-activity-inspector__label">
            <span>Logistics</span>
          </div>
          <div className="ws-planner-activity-inspector__logistics">
            {logistics.map((item, i) => (
              <span key={i} className="ws-planner-activity-inspector__log-item">
                {item}
              </span>
            ))}
          </div>
        </section>
      )}

      {/* Facilitator notes */}
      {notes && notes.body && (() => {
        const attr = [notes.author, notes.date].filter((v) => v && v !== '').join(' · ');
        return (
          <section className="ws-planner-activity-inspector__section">
            <div className="ws-planner-activity-inspector__label">
              <span>Facilitator notes</span>
              {notes.canAdd && (
                <button
                  type="button"
                  className="ws-planner-activity-inspector__add"
                  data-action="add-note"
                >
                  + Add
                </button>
              )}
            </div>
            <blockquote className="ws-planner-activity-inspector__note">{notes.body}</blockquote>
            {attr !== '' && (
              <p className="ws-planner-activity-inspector__note-attr">&mdash; {attr.toUpperCase()}</p>
            )}
          </section>
        );
      })()}

      {/* When it runs */}
      {context && (context.time || context.description) && (
        <section className="ws-planner-activity-inspector__section">
          <div className="ws-planner-activity-inspector__label">
            <span>When it runs</span>
          </div>
          <div className="ws-planner-activity-inspector__when">
            {context.time && <b>{context.time}</b>}
            {context.description && <span>{(context.time ? ' · ' : '') + context.description}</span>}
          </div>
        </section>
      )}

      {/* Actions */}
      {(actions.length > 0 || destructive) && (
        <section className="ws-planner-activity-inspector__section ws-planner-activity-inspector__section--last">
          <div className="ws-planner-activity-inspector__label">
            <span>Actions</span>
          </div>
          {actions.length > 0 && (
            <div
              className="ws-planner-activity-inspector__actions"
              style={{ gridTemplateColumns: `repeat(${actions.length}, 1fr)` }}
            >
              {actions.map((a, i) => (
                <ActionButton key={i} action={a} variant="default" />
              ))}
            </div>
          )}
          {destructive && (
            <div className="ws-planner-activity-inspector__destructive">
              <ActionButton action={destructive} variant="danger" />
            </div>
          )}
        </section>
      )}
    </aside>
  );
}
