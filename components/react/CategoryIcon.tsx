import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';

export type WsCategoryIconCategory =
  | 'ideation'
  | 'strategy'
  | 'team'
  | 'design'
  | 'feedback'
  | 'remote'
  | 'default';

export interface WsCategoryIconProps {
  /** Material Symbols icon name, e.g. "lightbulb". */
  icon: string;
  category?: WsCategoryIconCategory;
  /** Custom "start, end" hex pair — overrides the category gradient. */
  gradient?: string;
  /** Square size in px. Defaults to 40. */
  size?: number;
  id?: string;
  className?: string;
}

const GRADIENTS: Record<WsCategoryIconCategory, string> = {
  ideation: '#F59E0B, #D97706',
  strategy: '#3B82F6, #2563EB',
  team: '#10B981, #059669',
  design: '#8B5CF6, #7C3AED',
  feedback: '#EC4899, #DB2777',
  remote: '#06B6D4, #0891B2',
  default: '#E54D4D, #C73E3E',
};

/** Mirror of the "Category Icon Gradients" pattern — a gradient-filled icon tile. */
export function WsCategoryIcon({
  icon,
  category = 'default',
  gradient,
  size = 40,
  id,
  className,
}: WsCategoryIconProps): React.ReactElement {
  const grad = gradient ?? GRADIENTS[category];
  const style: React.CSSProperties = {
    width: size,
    height: size,
    background: `linear-gradient(135deg, ${grad})`,
    borderRadius: 8,
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'center',
  };

  return (
    <div
      id={id}
      className={cx('category-icon', `category-icon--${category}`, className)}
      style={style}
    >
      <Icon name={icon} />
    </div>
  );
}
