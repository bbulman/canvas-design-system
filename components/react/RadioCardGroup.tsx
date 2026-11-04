import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';

export interface WsRadioCardItem {
  value: string;
  label: string;
  icon?: string;
  description?: string;
  checked?: boolean;
  disabled?: boolean;
}

export interface WsRadioCardGroupProps {
  name: string;
  items: WsRadioCardItem[];
  label?: string;
  columns?: 2 | 3 | 4;
  id?: string;
  className?: string;
  onChange?: React.ChangeEventHandler<HTMLInputElement>;
}

/** Mirror of ws_radio_card_group() — card-style radio selector grid. */
export function WsRadioCardGroup({
  name,
  items,
  label,
  columns = 4,
  id,
  className,
  onChange,
}: WsRadioCardGroupProps): React.ReactElement {
  const classes = cx('ws-radio-card-group', `ws-radio-card-group--cols-${columns}`, className);

  return (
    <>
      {label && <p className="ws-radio-card-group__label">{label}</p>}
      <div className={classes} id={id ?? `${name}-group`}>
        {items.map((item) => (
          <label
            key={item.value}
            className={cx(
              'ws-radio-card',
              item.checked && 'ws-radio-card--selected',
              item.disabled && 'ws-radio-card--disabled',
            )}
          >
            <input
              type="radio"
              name={name}
              value={item.value}
              defaultChecked={item.checked}
              disabled={item.disabled}
              onChange={onChange}
            />
            <div className="ws-radio-card__visual">
              {item.icon && (
                <span className="ws-radio-card__icon">
                  <Icon name={item.icon} />
                </span>
              )}
              <span className="ws-radio-card__label">{item.label}</span>
              {item.description && (
                <span className="ws-radio-card__desc">{item.description}</span>
              )}
            </div>
          </label>
        ))}
      </div>
    </>
  );
}
