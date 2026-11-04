import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';

export type WsSuggestionType = 'exercise' | 'icebreaker' | 'break' | 'custom';

export interface WsSuggestionCardProps {
  id: number | string;
  name: string;
  type?: WsSuggestionType;
  /** Duration in minutes. */
  duration?: number;
  category?: string;
  reason?: string;
  /** Material Symbols icon name (defaults by type). */
  icon?: string;
  className?: string;
  /** Fired when the add-to-agenda button is clicked. */
  onAdd?: (id: number | string, type: WsSuggestionType) => void;
}

const DEFAULT_ICONS: Record<WsSuggestionType, string> = {
  exercise: 'fitness_center',
  icebreaker: 'ac_unit',
  break: 'coffee',
  custom: 'extension',
};

/** Mirror of ws_suggestion_card() — renders the `ws-suggestion-card` markup. */
export function WsSuggestionCard({
  id,
  name,
  type = 'exercise',
  duration = 0,
  category,
  reason,
  icon,
  className,
  onAdd,
}: WsSuggestionCardProps): React.ReactElement {
  const iconName = icon || DEFAULT_ICONS[type] || 'extension';
  const typeLabel = type.charAt(0).toUpperCase() + type.slice(1);

  return (
    <div
      className={cx('ws-suggestion-card', `ws-suggestion-card--${type}`, className)}
      data-id={id}
      data-type={type}
    >
      <div className="ws-suggestion-card__icon">
        <Icon name={iconName} />
      </div>
      <div className="ws-suggestion-card__content">
        <div className="ws-suggestion-card__header">
          <span className="ws-suggestion-card__name">{name}</span>
        </div>
        <div className="ws-suggestion-card__meta">
          <span className={`ws-activity-badge ws-activity-badge--${type}`}>{typeLabel}</span>
          <span>{duration} min</span>
          {category && <span>{category}</span>}
        </div>
        {reason && <p className="ws-suggestion-card__reason">{reason}</p>}
      </div>
      <button
        className="ws-suggestion-card__add"
        title="Add to agenda"
        type="button"
        onClick={() => onAdd?.(id, type)}
      >
        <Icon name="add" />
      </button>
    </div>
  );
}
