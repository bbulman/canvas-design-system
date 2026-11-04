import React from 'react';

export interface IconProps {
  /** Google Material Symbols icon name, e.g. "schedule". */
  name: string;
  className?: string;
}

/** Renders a Google Material Symbols icon. Requires the Material Symbols font. */
export function Icon({ name, className }: IconProps): React.ReactElement {
  return (
    <span className={`material-symbols-outlined ${className ?? ''}`.trim()} aria-hidden="true">
      {name}
    </span>
  );
}
