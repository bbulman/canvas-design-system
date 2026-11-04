import React from 'react';
import { cx } from './cx';

export type WsAvatarSize = 'xs' | 'sm' | 'md' | 'lg' | 'xl';
export type WsAvatarStatus = 'online' | 'offline' | 'busy';

export interface WsAvatarProps {
  /** User name (used for initials fallback and title). */
  name: string;
  /** Image URL. When omitted, initials are shown. */
  image?: string;
  size?: WsAvatarSize;
  /** Custom background color for the initials variant. */
  color?: string;
  ring?: boolean;
  status?: WsAvatarStatus;
  id?: string;
  className?: string;
}

function initialsFromName(name: string): string {
  if (!name) return '';
  const parts = name.trim().split(' ');
  if (parts.length >= 2) {
    return (parts[0][0] + parts[parts.length - 1][0]).toUpperCase();
  }
  return parts[0].slice(0, 1).toUpperCase();
}

/** Mirror of ws_avatar() — renders the `ws-avatar` markup. */
export function WsAvatar({
  name,
  image,
  size = 'md',
  color,
  ring,
  status,
  id,
  className,
}: WsAvatarProps): React.ReactElement {
  const classes = cx(
    'ws-avatar',
    `ws-avatar--${size}`,
    ring && 'ws-avatar--ring',
    status && 'ws-avatar--has-status',
    !image && 'ws-avatar--initials',
    className,
  );

  const style =
    color && !image
      ? ({ '--avatar-bg': color } as React.CSSProperties)
      : undefined;

  return (
    <div id={id} className={classes} style={style} title={name}>
      {image ? (
        <img src={image} alt={name} className="ws-avatar__image" loading="lazy" />
      ) : (
        <span className="ws-avatar__initials">{initialsFromName(name)}</span>
      )}
      {status && <span className={`ws-avatar__status ws-avatar__status--${status}`} />}
    </div>
  );
}
