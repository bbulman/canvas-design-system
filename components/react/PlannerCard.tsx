import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';

export type WsPlannerCardType = 'exercise' | 'icebreaker' | 'break' | 'custom';
export type WsPlannerCardSize = 'lg' | 'sm';
export type WsPlannerCardState = 'default' | 'selected' | 'disabled';
export type WsPlannerCardActionKey = 'swap' | 'delete' | 'edit';

export interface WsPlannerCardAction {
  action: string;
  /** Material Symbols icon name. Defaults from the action key. */
  icon?: string;
  /** aria-label. Defaults from the action key. */
  label?: string;
}

export interface WsPlannerCardProps {
  title: string;
  type?: WsPlannerCardType;
  /** Duration string ("60m") or minutes — numbers become "{n}m". */
  duration?: string | number;
  size?: WsPlannerCardSize;
  state?: WsPlannerCardState;
  draggable?: boolean;
  /** Action keys or full action objects shown top-right (LG only). */
  actions?: Array<WsPlannerCardActionKey | string | WsPlannerCardAction>;
  /** Secondary line (SM only). */
  meta?: string;
  /** Renders the card as an anchor. */
  href?: string;
  id?: string;
  className?: string;
}

const EYEBROW: Record<WsPlannerCardType, string> = {
  exercise: 'EXERCISES',
  icebreaker: 'ICEBREAKER',
  break: 'BREAK',
  custom: 'CUSTOM',
};

const ACTION_ICON: Record<string, string> = {
  swap: 'swap_horiz',
  delete: 'delete',
  edit: 'edit',
};

const ACTION_LABEL: Record<string, string> = {
  swap: 'Swap',
  delete: 'Delete',
  edit: 'Edit',
};

/** Mirror of ws_planner_card() — renders the `ws-planner-card` markup. */
export function WsPlannerCard({
  title,
  type = 'exercise',
  duration = '',
  size = 'lg',
  state = 'default',
  draggable,
  actions = [],
  meta = '',
  href,
  id,
  className,
}: WsPlannerCardProps): React.ReactElement {
  const durationText = typeof duration === 'number' ? `${Math.trunc(duration)}m` : duration;
  const eyebrow = EYEBROW[type];

  const classes = cx(
    'ws-planner-card',
    `ws-planner-card--${size}`,
    `ws-planner-card--${type}`,
    state !== 'default' && `ws-planner-card--${state}`,
    draggable && 'is-draggable',
    className,
  );

  const normalizedActions: WsPlannerCardAction[] = actions.map((a) =>
    typeof a === 'string' ? { action: a } : a,
  );

  const dataAttrs = {
    'data-type': type,
    'aria-selected': state === 'selected' ? true : undefined,
    'aria-disabled': state === 'disabled' ? true : undefined,
  };

  const body =
    size === 'lg' ? (
      <>
        <div className="ws-planner-card__header">
          <span className="ws-planner-card__eyebrow">{eyebrow}</span>
          {normalizedActions.length > 0 && (
            <div className="ws-planner-card__actions" role="group" aria-label="Card actions">
              {normalizedActions.map((a, i) => {
                const iconName = a.icon ?? ACTION_ICON[a.action] ?? 'edit';
                const label =
                  a.label ?? ACTION_LABEL[a.action] ?? a.action.charAt(0).toUpperCase() + a.action.slice(1);
                return (
                  <button
                    key={i}
                    type="button"
                    className="ws-planner-card__action"
                    data-action={a.action}
                    aria-label={label}
                  >
                    <Icon name={iconName} />
                  </button>
                );
              })}
            </div>
          )}
        </div>
        <div className="ws-planner-card__body">
          {draggable && (
            <span className="ws-planner-card__handle" aria-hidden="true">
              <Icon name="drag_indicator" />
            </span>
          )}
          <h3 className="ws-planner-card__title">{title}</h3>
        </div>
        {durationText !== '' && (
          <div className="ws-planner-card__footer">
            <span className="ws-planner-card__duration">{durationText}</span>
          </div>
        )}
      </>
    ) : (
      <>
        <div className="ws-planner-card__row">
          <h4 className="ws-planner-card__title">{title}</h4>
          <div className="ws-planner-card__row-end">
            {durationText !== '' && <span className="ws-planner-card__duration">{durationText}</span>}
            <button
              type="button"
              className="ws-planner-card__action ws-planner-card__action--hover"
              data-action="swap"
              aria-label="Swap"
              tabIndex={-1}
            >
              <Icon name="swap_horiz" />
            </button>
          </div>
        </div>
        {meta !== '' && <p className="ws-planner-card__meta">{meta}</p>}
      </>
    );

  if (href) {
    return (
      <a id={id} href={href} className={classes} {...dataAttrs}>
        {body}
      </a>
    );
  }

  return (
    <div id={id} className={classes} {...dataAttrs}>
      {body}
    </div>
  );
}
