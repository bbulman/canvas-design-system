import React from 'react';
import { cx } from './cx';

export interface WsFormRowProps {
  label?: string;
  /**
   * @deprecated Ignored. Workshopr defaults to required and draws no mark, and
   * the row cannot reach into its children: set `required` on the control.
   */
  required?: boolean;
  /** Appends "(optional)" to the label. Workshopr defaults to required, so required draws no mark. */
  optional?: boolean;
  helper?: string;
  error?: string;
  inline?: boolean;
  /** Number of grid columns this row spans. */
  columns?: number;
  id?: string;
  /**
   * The id of the one control the label names. ws_form_row finds it in the
   * markup; children here are elements, so pass it, set `id`, and point the
   * control's aria-describedby at `${id}-helper` or `${id}-error`. Leave it
   * out for several controls and the row becomes a labelled group instead.
   */
  htmlFor?: string;
  className?: string;
  /** The field content (e.g. <WsInput /> or <WsSelect />). */
  children?: React.ReactNode;
}

/** Mirror of ws_form_row() — wraps a field in the `ws-form-row` layout. */
export function WsFormRow({
  label,
  optional,
  helper,
  error,
  inline,
  columns,
  id,
  htmlFor,
  className,
  children,
}: WsFormRowProps): React.ReactElement {
  const generated = React.useId();
  const rowKey = id || `ws-form-row${generated}`;
  const labelId = label ? `${rowKey}-label` : undefined;
  const noteId = error || helper ? `${rowKey}-${error ? 'error' : 'helper'}` : undefined;
  const group = label && !htmlFor;
  const classes = cx(
    'ws-form-row',
    inline && 'ws-form-row--inline',
    error && 'ws-form-row--error',
    className,
  );

  const style = columns ? ({ gridColumn: `span ${columns}` } as React.CSSProperties) : undefined;

  return (
    <div
      className={classes}
      id={id}
      style={style}
      role={group ? 'group' : undefined}
      aria-labelledby={group ? labelId : undefined}
      aria-describedby={group ? noteId : undefined}
    >
      {label && (
        <label className="ws-form-row__label" id={labelId} htmlFor={htmlFor}>
          {label}
          {optional && <span className="ws-form-row__optional">(optional)</span>}
        </label>
      )}

      <div className="ws-form-row__field">{children}</div>

      {error ? (
        <p className="ws-form-row__error" id={noteId} role="alert">{error}</p>
      ) : helper ? (
        <p className="ws-form-row__helper" id={noteId}>{helper}</p>
      ) : null}
    </div>
  );
}
