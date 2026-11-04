import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';

export type WsChipInputType = 'email' | 'text';

export interface WsChipInputProps {
  name: string;
  label?: string;
  /** Appends "(optional)" to the label. Workshopr defaults to required, so required draws no mark. */
  optional?: boolean;
  placeholder?: string;
  type?: WsChipInputType;
  addIcon?: string;
  addText?: string;
  id?: string;
  className?: string;
}

/**
 * Mirror of ws_chip_input() — renders the static `ws-chip-input` markup.
 * Add/remove behaviour is wired up by the consuming app against the data-id elements.
 */
export function WsChipInput({
  name,
  label,
  optional,
  placeholder = 'Add item...',
  type = 'text',
  addIcon = 'add',
  addText,
  id,
  className,
}: WsChipInputProps): React.ReactElement {
  const fieldId = id ?? name;
  const classes = cx('ws-chip-input', className);

  return (
    <div className={classes} id={`${fieldId}-wrap`}>
      {label && (
        <label className="ws-chip-input__label" htmlFor={`${fieldId}-input`}>
          {label}
          {optional && <> <span className="ws-field__optional">(optional)</span></>}
        </label>
      )}
      <div className="ws-chip-input__field">
        <input
          type={type}
          id={`${fieldId}-input`}
          className="ws-input"
          placeholder={placeholder}
        />
        <button type="button" className="ws-chip-input__add" id={`${fieldId}-add`}>
          <Icon name={addIcon} />
          {addText && <span>{addText}</span>}
        </button>
      </div>
      <div className="ws-chip-input__list" id={`${fieldId}-list`} />
    </div>
  );
}
