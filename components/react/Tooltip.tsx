import React from 'react';

export type WsTooltipPosition = 'top' | 'bottom' | 'left' | 'right';
export type WsTooltipVariant = 'default' | 'dark' | 'light';

export interface WsTooltipProps {
  /** Tooltip text. */
  text: string;
  position?: WsTooltipPosition;
  variant?: WsTooltipVariant;
  /** Show arrow (default: true). */
  arrow?: boolean;
  /** Element to attach the tooltip data attributes to. */
  children: React.ReactElement;
}

/**
 * Mirror of ws_tooltip() — clones its child and applies the `data-tooltip*`
 * attributes that the tooltip CSS/JS reads. The PHP helper returns an
 * attribute string; in React we attach the same attributes to the child.
 */
export function WsTooltip({
  text,
  position = 'top',
  variant = 'dark',
  arrow = true,
  children,
}: WsTooltipProps): React.ReactElement {
  return React.cloneElement(children, {
    'data-tooltip': text,
    'data-tooltip-position': position,
    ...(variant !== 'dark' ? { 'data-tooltip-variant': variant } : {}),
    ...(!arrow ? { 'data-tooltip-arrow': 'false' } : {}),
  });
}
