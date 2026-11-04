import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';

export type WsAccordionVariant = 'default' | 'bordered' | 'flush';
export type WsAccordionSize = 'sm' | 'md' | 'lg';

export interface WsAccordionItem {
  title: string;
  /** Panel content (rendered as a React node). */
  content: React.ReactNode;
  /** Whether the panel starts open. */
  open?: boolean;
  /** Material Symbols icon name. */
  icon?: string;
  disabled?: boolean;
}

export interface WsAccordionProps {
  items: WsAccordionItem[];
  /** Allow multiple panels open at once. */
  multiple?: boolean;
  variant?: WsAccordionVariant;
  size?: WsAccordionSize;
  id?: string;
  className?: string;
}

let accordionSeq = 0;

/** Mirror of ws_accordion() — renders the `ws-accordion` markup with local open state. */
export function WsAccordion({
  items,
  multiple = false,
  variant = 'default',
  size = 'md',
  id,
  className,
}: WsAccordionProps): React.ReactElement {
  const baseId = React.useMemo(() => id ?? `ws-accordion-${++accordionSeq}`, [id]);

  const [openSet, setOpenSet] = React.useState<Set<number>>(
    () => new Set(items.map((it, i) => (it.open ? i : -1)).filter((i) => i >= 0)),
  );

  const toggle = (index: number, disabled?: boolean) => {
    if (disabled) return;
    setOpenSet((prev) => {
      const next = new Set(multiple ? prev : []);
      if (prev.has(index)) {
        next.delete(index);
      } else {
        next.add(index);
      }
      return next;
    });
  };

  return (
    <div
      className={cx(
        'ws-accordion',
        `ws-accordion--${variant}`,
        `ws-accordion--${size}`,
        className,
      )}
      id={baseId}
      data-multiple={multiple ? 'true' : 'false'}
    >
      {items.map((item, index) => {
        const itemId = `${baseId}-item-${index}`;
        const isOpen = openSet.has(index);
        return (
          <div
            key={itemId}
            className={cx('ws-accordion__item', isOpen && 'is-open', item.disabled && 'is-disabled')}
            id={itemId}
          >
            <button
              type="button"
              className="ws-accordion__trigger"
              id={`${itemId}-trigger`}
              aria-expanded={isOpen}
              aria-controls={`${itemId}-panel`}
              disabled={item.disabled}
              onClick={() => toggle(index, item.disabled)}
            >
              {item.icon && (
                <span className="ws-accordion__icon">
                  <Icon name={item.icon} />
                </span>
              )}
              <span className="ws-accordion__title">{item.title}</span>
              <span className="ws-accordion__arrow">
                <span className="material-symbols-outlined" aria-hidden="true">expand_more</span>
              </span>
            </button>
            <div
              className="ws-accordion__panel"
              id={`${itemId}-panel`}
              role="region"
              aria-labelledby={`${itemId}-trigger`}
              hidden={!isOpen}
            >
              <div className="ws-accordion__content">{item.content}</div>
            </div>
          </div>
        );
      })}
    </div>
  );
}
