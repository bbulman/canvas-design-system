import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';

export type WsTabsVariant = 'underline' | 'pill' | 'segmented';
export type WsTabsSize = 'sm' | 'md' | 'lg';

export interface WsTabsItem {
  id: string;
  label: string;
  /** Material Symbols icon name. */
  icon?: string;
  count?: number;
  active?: boolean;
  disabled?: boolean;
  gated?: boolean;
}

export interface WsTabsProps {
  items: WsTabsItem[];
  variant?: WsTabsVariant;
  size?: WsTabsSize;
  scrollable?: boolean;
  id?: string;
  className?: string;
  /** Fired when a (non-disabled) tab is selected. */
  onTabChange?: (tabId: string) => void;
}

let tabsSeq = 0;

/** Mirror of ws_tabs() — renders the `ws-tabs` nav with local active state. */
export function WsTabs({
  items,
  variant = 'underline',
  size = 'md',
  scrollable = true,
  id,
  className,
  onTabChange,
}: WsTabsProps): React.ReactElement {
  const baseId = React.useMemo(() => id ?? `ws-tabs-${++tabsSeq}`, [id]);

  const initialActive = items.find((it) => it.active)?.id ?? items[0]?.id;
  const [activeId, setActiveId] = React.useState<string | undefined>(initialActive);

  const select = (item: WsTabsItem) => {
    if (item.disabled) return;
    setActiveId(item.id);
    onTabChange?.(item.id);
  };

  return (
    <div
      className={cx(
        'ws-tabs',
        `ws-tabs--${variant}`,
        `ws-tabs--${size}`,
        scrollable && 'ws-tabs--scrollable',
        className,
      )}
      id={baseId}
    >
      <div className="ws-tabs__nav" role="tablist">
        {items.map((item) => {
          const isActive = item.id === activeId;
          return (
            <button
              key={item.id}
              type="button"
              className={cx(
                'ws-tabs__btn',
                isActive && 'is-active',
                item.disabled && 'is-disabled',
                item.gated && 'is-gated',
              )}
              data-tab={item.id}
              role="tab"
              aria-selected={isActive}
              aria-controls={`${item.id}-panel`}
              disabled={item.disabled}
              onClick={() => select(item)}
            >
              {item.icon && (
                <span className="ws-tabs__icon">
                  <Icon name={item.icon} />
                </span>
              )}
              <span className="ws-tabs__label">{item.label}</span>
              {item.count != null && <span className="ws-tabs__count">{item.count}</span>}
              {item.gated && (
                <span className="ws-tabs__lock">
                  <Icon name="lock" className="ws-tabs__lock-icon" />
                </span>
              )}
            </button>
          );
        })}
      </div>
    </div>
  );
}
