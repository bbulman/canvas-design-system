import React from 'react';
import { cx } from './cx';

export type WsSkeletonVariant = 'text' | 'avatar' | 'image' | 'card' | 'workshop' | 'button' | 'input';
export type WsSkeletonSize = 'sm' | 'md' | 'lg';

export interface WsSkeletonProps {
  variant?: WsSkeletonVariant;
  size?: WsSkeletonSize;
  /** Number of text lines (text variant only). */
  lines?: number;
  /** Number of sibling cards (workshop variant only). */
  count?: number;
  width?: string;
  height?: string;
  rounded?: boolean;
  circle?: boolean;
  id?: string;
  className?: string;
}

/** Mirror of ws_skeleton() — loading placeholder. */
export function WsSkeleton({
  variant = 'text',
  size = 'md',
  lines = 1,
  count = 1,
  width,
  height,
  rounded,
  circle,
  id,
  className,
}: WsSkeletonProps): React.ReactElement {
  const style: React.CSSProperties | undefined =
    width || height ? { width, height } : undefined;

  if (variant === 'card') {
    return (
      <div id={id} className={cx('ws-skeleton-card', className)} aria-hidden="true">
        <div className="ws-skeleton ws-skeleton--image" />
        <div className="ws-skeleton-card__body">
          <div className="ws-skeleton ws-skeleton--text ws-skeleton--text-title" />
          <div className="ws-skeleton ws-skeleton--text" />
          <div className="ws-skeleton ws-skeleton--text ws-skeleton--text-short" />
        </div>
      </div>
    );
  }

  // Workshop card placeholder — mirrors the saved-workshop card on the app
  // homes (name, meta, lifecycle, footer action) so the grid keeps its shape.
  if (variant === 'workshop') {
    return (
      <>
        {Array.from({ length: Math.max(1, count) }).map((_, i) => (
          <div key={i} id={i === 0 ? id : undefined} className={cx('ws-skeleton-workshop', className)} aria-hidden="true">
            <div className="ws-skeleton ws-skeleton--text ws-skeleton--text-title" />
            <div className="ws-skeleton-workshop__meta">
              <div className="ws-skeleton ws-skeleton-workshop__chip" />
              <div className="ws-skeleton ws-skeleton-workshop__chip ws-skeleton-workshop__chip--wide" />
              <div className="ws-skeleton ws-skeleton-workshop__chip" />
            </div>
            <div className="ws-skeleton-workshop__life">
              <div className="ws-skeleton ws-skeleton-workshop__dot" />
              <div className="ws-skeleton ws-skeleton-workshop__bar" />
              <div className="ws-skeleton ws-skeleton-workshop__dot" />
              <div className="ws-skeleton ws-skeleton-workshop__bar" />
              <div className="ws-skeleton ws-skeleton-workshop__dot" />
            </div>
            <div className="ws-skeleton-workshop__foot">
              <div className="ws-skeleton ws-skeleton--button ws-skeleton--sm" />
            </div>
          </div>
        ))}
      </>
    );
  }

  if (variant === 'text' && lines > 1) {
    return (
      <div id={id} className={cx('ws-skeleton-text', className)} aria-hidden="true">
        {Array.from({ length: lines }).map((_, i) => (
          <div
            key={i}
            className={cx('ws-skeleton', 'ws-skeleton--text', i === lines - 1 && 'ws-skeleton--text-short')}
            style={style}
          />
        ))}
      </div>
    );
  }

  const classes = cx(
    'ws-skeleton',
    `ws-skeleton--${variant}`,
    size !== 'md' && `ws-skeleton--${size}`,
    circle && 'ws-skeleton--circle',
    rounded && 'ws-skeleton--rounded',
    className,
  );

  return <div id={id} className={classes} style={style} aria-hidden="true" />;
}
