import React from 'react';
import { cx } from './cx';

export type WsPromptSelectVariant = 'default' | 'muted';

export interface WsPromptSelectOption {
  value: string;
  label: string;
}

export interface WsPromptSelectProps {
  /** Prompt label text (displayed in serif italic). */
  label: string;
  name: string;
  /** Options as {value, label} pairs. */
  options: WsPromptSelectOption[];
  value?: string;
  defaultValue?: string;
  variant?: WsPromptSelectVariant;
  id?: string;
  className?: string;
  onChange?: React.ChangeEventHandler<HTMLSelectElement>;
}

/** Mirror of ws_prompt_select() — inline "label [Dropdown...]" pair. */
export function WsPromptSelect({
  label,
  name,
  options,
  value,
  defaultValue,
  variant = 'default',
  id,
  className,
  onChange,
}: WsPromptSelectProps): React.ReactElement {
  const wrapperClass = cx(
    'ws-prompt-select',
    variant !== 'default' && `ws-prompt-select--${variant}`,
    className,
  );

  return (
    <div className={wrapperClass}>
      <span className="ws-prompt-select__label">
        <em>{label}</em>
      </span>
      <div className="ws-prompt-select__dropdown">
        <select
          name={name}
          id={id ?? name}
          className="ws-prompt-select__select"
          value={value}
          defaultValue={defaultValue}
          onChange={onChange}
        >
          {options.map((opt) => (
            <option key={opt.value} value={opt.value}>
              {opt.label}
            </option>
          ))}
        </select>
      </div>
    </div>
  );
}
