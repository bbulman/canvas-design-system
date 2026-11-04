import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';

export type WsInputType =
  | 'text'
  | 'email'
  | 'password'
  | 'number'
  | 'tel'
  | 'url'
  | 'search'
  | 'textarea'
  | 'select';

export type WsInputSize = 'sm' | 'md' | 'lg';

export interface WsInputSelectOption {
  value: string;
  label: string;
  disabled?: boolean;
}

export interface WsInputProps {
  name: string;
  type?: WsInputType;
  id?: string;
  label?: string;
  placeholder?: string;
  value?: string;
  defaultValue?: string;
  error?: string;
  hint?: string;
  required?: boolean;
  /** Appends "(optional)" to the label. Workshopr defaults to required, so required draws no mark. */
  optional?: boolean;
  disabled?: boolean;
  readOnly?: boolean;
  autoComplete?: string;
  minLength?: number;
  maxLength?: number;
  pattern?: string;
  /** Options for the `select` type. */
  options?: WsInputSelectOption[];
  /** Rows for the `textarea` type. */
  rows?: number;
  /** Show the visibility toggle for the `password` type. */
  showPasswordToggle?: boolean;
  size?: WsInputSize;
  className?: string;
  onChange?: React.ChangeEventHandler<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>;
}

/** Mirror of ws_input() — renders the `ws-field` form field markup. */
export function WsInput({
  name,
  type = 'text',
  id,
  label,
  placeholder = '',
  value,
  defaultValue,
  error,
  hint,
  required,
  optional,
  disabled,
  readOnly,
  autoComplete,
  minLength,
  maxLength,
  pattern,
  options = [],
  rows = 4,
  showPasswordToggle = true,
  size = 'md',
  className,
  onChange,
}: WsInputProps): React.ReactElement {
  const fieldId = id ?? name;

  const wrapperClass = cx(
    'ws-field',
    `ws-field--${size}`,
    error && 'ws-field--error',
    disabled && 'ws-field--disabled',
    className,
  );

  const inputClass = cx('ws-input', `ws-input--${size}`, error && 'ws-input--error');

  const describedBy = error ? `${fieldId}-error` : hint ? `${fieldId}-hint` : undefined;

  const shared = {
    id: fieldId,
    name,
    placeholder: placeholder || undefined,
    required,
    disabled,
    readOnly,
    autoComplete,
    minLength,
    maxLength,
    pattern,
    'aria-invalid': error ? true : undefined,
    'aria-describedby': describedBy,
  };

  const labelEl = label ? (
    <label className="ws-field__label" htmlFor={fieldId}>
      {label}
      {optional && <span className="ws-field__optional">(optional)</span>}
    </label>
  ) : null;

  let field: React.ReactElement;
  if (type === 'textarea') {
    field = (
      <textarea
        {...shared}
        className={`${inputClass} ws-textarea`}
        rows={rows}
        value={value}
        defaultValue={defaultValue}
        onChange={onChange as React.ChangeEventHandler<HTMLTextAreaElement>}
      />
    );
  } else if (type === 'select') {
    field = (
      <div className="ws-select-wrapper">
        <select
          {...shared}
          className={`${inputClass} ws-select`}
          value={value}
          defaultValue={defaultValue}
          onChange={onChange as React.ChangeEventHandler<HTMLSelectElement>}
        >
          {placeholder && (
            <option value="" disabled>
              {placeholder}
            </option>
          )}
          {options.map((opt) => (
            <option key={opt.value} value={opt.value} disabled={opt.disabled}>
              {opt.label}
            </option>
          ))}
        </select>
        <span className="ws-select__arrow">
          <Icon name="expand_more" />
        </span>
      </div>
    );
  } else if (type === 'password' && showPasswordToggle) {
    field = (
      <div className="ws-password-wrapper">
        <input
          {...shared}
          type="password"
          className={inputClass}
          value={value}
          defaultValue={defaultValue}
          onChange={onChange as React.ChangeEventHandler<HTMLInputElement>}
        />
        <button type="button" className="ws-password-toggle" aria-label="Toggle password visibility">
          <span className="eye-open">
            <Icon name="visibility" />
          </span>
          <span className="eye-closed hidden">
            <Icon name="visibility_off" />
          </span>
        </button>
      </div>
    );
  } else {
    field = (
      <input
        {...shared}
        type={type}
        className={inputClass}
        value={value}
        defaultValue={defaultValue}
        onChange={onChange as React.ChangeEventHandler<HTMLInputElement>}
      />
    );
  }

  return (
    <div className={wrapperClass}>
      {labelEl}
      {field}
      {error ? (
        <p className="ws-field__error" id={`${fieldId}-error`} role="alert">
          {error}
        </p>
      ) : hint ? (
        <p className="ws-field__hint" id={`${fieldId}-hint`}>
          {hint}
        </p>
      ) : null}
    </div>
  );
}
