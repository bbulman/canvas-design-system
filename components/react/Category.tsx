import React from 'react';
import { WsBadge } from './Badge';

export interface WsCategoryProps {
  /** Category name. */
  category: string;
  /** Category color (hex), applied to the category variant. */
  color?: string;
  className?: string;
}

/** Mirror of ws_category() — category badge. */
export function WsCategory({
  category,
  color,
  className,
}: WsCategoryProps): React.ReactElement {
  return (
    <WsBadge
      text={category}
      variant="category"
      color={color}
      className={className}
    />
  );
}
