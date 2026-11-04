import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';

export type WsResultsOverlayVariant = 'overlay' | 'inline';

export interface WsResultsOverlayProps {
  /** Element ID (required). */
  id: string;
  variant?: WsResultsOverlayVariant;
  title?: string;
  /** Material Symbols icon name. */
  icon?: string;
  /** Action button text (overlay only). */
  buttonText?: string;
  /** Action button ID (overlay only). Defaults to `{id}-done`. */
  buttonId?: string;
  /** Results list UL ID. Defaults to `{id}-list`. */
  listId?: string;
  className?: string;
}

/** Mirror of ws_results_overlay() — renders the hidden `ws-results` panel (JS fills the list). */
export function WsResultsOverlay({
  id,
  variant = 'overlay',
  title = 'Complete',
  icon = 'check_circle',
  buttonText = 'Done',
  buttonId,
  listId,
  className,
}: WsResultsOverlayProps): React.ReactElement {
  const isOverlay = variant === 'overlay';
  const resolvedButtonId = buttonId ?? `${id}-done`;
  const resolvedListId = listId ?? `${id}-list`;

  const inner = (
    <>
      <div className="ws-results__header">
        <span className="ws-results__icon">
          <Icon name={icon} />
        </span>
        <span className="ws-results__title">{title}</span>
      </div>
      <ul className="ws-results__list" id={resolvedListId} />
      {isOverlay && (
        <button className="ws-results__btn" id={resolvedButtonId} type="button">
          {buttonText}
        </button>
      )}
    </>
  );

  return (
    <div
      id={id}
      className={cx('ws-results', `ws-results--${variant}`, className)}
      style={{ display: 'none' }}
    >
      {isOverlay ? <div className="ws-results__inner">{inner}</div> : inner}
    </div>
  );
}
