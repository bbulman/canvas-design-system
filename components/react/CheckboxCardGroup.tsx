import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';

export type WsCheckboxCardIconColor = 'blue' | 'orange' | 'purple' | 'red' | 'green';

export interface WsCheckboxCardItem {
  id: string;
  title: string;
  description?: string;
  icon?: string;
  iconColor?: WsCheckboxCardIconColor;
  checked?: boolean;
  highlight?: boolean;
}

export interface WsCheckboxCardGroupProps {
  items: WsCheckboxCardItem[];
  label?: string;
  id?: string;
  className?: string;
  onChange?: React.ChangeEventHandler<HTMLInputElement>;
}

/** Mirror of ws_checkbox_card_group() — checkbox cards with toggle switches. */
export function WsCheckboxCardGroup({
  items,
  label,
  id,
  className,
  onChange,
}: WsCheckboxCardGroupProps): React.ReactElement {
  const classes = cx('ws-checkbox-card-group', className);

  return (
    <>
      {label && <p className="ws-checkbox-card-group__label">{label}</p>}
      <div className={classes} id={id}>
        {items.map((item) => (
          <label
            key={item.id}
            className={cx('ws-checkbox-card', item.highlight && 'ws-checkbox-card--highlight')}
          >
            <div className="ws-checkbox-card__content">
              {item.icon && (
                <div
                  className={`ws-checkbox-card__icon ws-checkbox-card__icon--${item.iconColor ?? 'blue'}`}
                >
                  <Icon name={item.icon} />
                </div>
              )}
              <div className="ws-checkbox-card__text">
                <span className="ws-checkbox-card__title">{item.title}</span>
                {item.description && (
                  <span className="ws-checkbox-card__desc">{item.description}</span>
                )}
              </div>
            </div>
            <div className="ws-toggle">
              <input
                type="checkbox"
                id={item.id}
                defaultChecked={item.checked}
                onChange={onChange}
              />
              <span className="ws-toggle__slider" />
            </div>
          </label>
        ))}
      </div>
    </>
  );
}
