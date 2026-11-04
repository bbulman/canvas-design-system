import React from 'react';
import { WsButton, WsButtonProps } from './Button';

export interface WsIconButtonProps extends Omit<WsButtonProps, 'text' | 'icon'> {
  /** Material Symbols icon name. */
  icon: string;
}

/** Mirror of ws_icon_button() — icon-only ghost button by default. */
export function WsIconButton({
  icon,
  variant = 'ghost',
  size = 'sm',
  ...rest
}: WsIconButtonProps): React.ReactElement {
  return <WsButton icon={icon} variant={variant} size={size} {...rest} />;
}
