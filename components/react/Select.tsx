import React from 'react';
import { cx } from './cx';

export type WsSelectSize = 'sm' | 'md' | 'lg';

export interface WsSelectOption {
  value: string;
  label: string;
}

export interface WsSelectProps {
  name: string;
  /** Options as {value, label} pairs. */
  options: WsSelectOption[];
  label?: string;
  value?: string;
  defaultValue?: string;
  placeholder?: string;
  required?: boolean;
  /** Appends "(optional)" to the label. Workshopr defaults to required, so required draws no mark. */
  optional?: boolean;
  disabled?: boolean;
  error?: string;
  helper?: string;
  size?: WsSelectSize;
  id?: string;
  className?: string;
  onChange?: React.ChangeEventHandler<HTMLSelectElement>;
}

/** Mirror of ws_select() — renders the `ws-select` field markup. */
export function WsSelect({
  name,
  options,
  label,
  value,
  defaultValue,
  placeholder,
  required,
  optional,
  disabled,
  error,
  helper,
  size = 'md',
  id,
  className,
  onChange,
}: WsSelectProps): React.ReactElement {
  const fieldId = id ?? name;

  const fieldClass = cx('ws-field', error && 'ws-field--error');
  const selectClass = cx('ws-select', `ws-select--${size}`, className);

  return (
    <div className={fieldClass}>
      {label && (
        <label className="ws-field__label" htmlFor={fieldId}>
          {label}
          {optional && <span className="ws-field__optional">(optional)</span>}
        </label>
      )}

      <div className="ws-select-wrap">
        <select
          name={name}
          id={fieldId}
          className={selectClass}
          required={required}
          disabled={disabled}
          value={value}
          defaultValue={defaultValue}
          onChange={onChange}
        >
          {placeholder && <option value="">{placeholder}</option>}
          {options.map((opt) => (
            <option key={opt.value} value={opt.value}>
              {opt.label}
            </option>
          ))}
        </select>
        <span className="ws-select__arrow">
          <span className="material-symbols-outlined">expand_more</span>
        </span>
      </div>

      {error ? (
        <span className="ws-field__error">{error}</span>
      ) : helper ? (
        <span className="ws-field__helper">{helper}</span>
      ) : null}
    </div>
  );
}
