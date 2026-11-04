import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';

export type WsUserPlan = 'free' | 'pro' | 'team';

export interface WsUserMenuItem {
  /** Material Symbols icon name. */
  icon?: string;
  text?: string;
  href?: string;
  divider?: boolean;
  danger?: boolean;
}

export interface WsUserMenuProps {
  loggedIn?: boolean;
  name?: string;
  email?: string;
  initials?: string;
  plan?: WsUserPlan;
  /** Logged-out CTA target + label. */
  signInHref?: string;
  signInText?: string;
  /** Dropdown menu items. */
  items?: WsUserMenuItem[];
  id?: string;
  className?: string;
}

const DEFAULT_ITEMS: WsUserMenuItem[] = [
  { icon: 'dashboard', text: 'My Dashboard', href: '/myworkshopr/' },
  { icon: 'bookmark', text: 'Saved Items', href: '/myworkshopr/saved/' },
  { icon: 'settings', text: 'Settings', href: '/account/' },
  { divider: true },
  { icon: 'logout', text: 'Sign Out', href: '/logout', danger: true },
];

/** Mirror of the "User Menu & Sign-in" pattern — auth states + account dropdown. */
export function WsUserMenu({
  loggedIn = false,
  name = '',
  email = '',
  initials = '',
  plan,
  signInHref = '#',
  signInText = 'Sign In',
  items = DEFAULT_ITEMS,
  id,
  className,
}: WsUserMenuProps): React.ReactElement {
  if (!loggedIn) {
    return (
      <div id={id} className={cx('ws-user-menu', className)}>
        <a className="ws-user-menu__signin" href={signInHref}>
          <Icon name="login" />
          <span>{signInText}</span>
        </a>
      </div>
    );
  }

  return (
    <div id={id} className={cx('ws-user-menu', className)}>
      <button type="button" className="ws-user-menu__trigger" aria-haspopup="true" aria-expanded="false">
        <span className="ws-user-menu__avatar">{initials}</span>
        <span className="ws-user-menu__name">{name}</span>
        <Icon name="expand_more" className="ws-user-menu__chevron" />
      </button>
      <div className="ws-user-menu__dropdown" role="menu">
        <div className="ws-user-menu__head">
          <span className="ws-user-menu__avatar ws-user-menu__avatar--lg">{initials}</span>
          <div className="ws-user-menu__identity">
            <div className="ws-user-menu__display-name">{name}</div>
            <div className="ws-user-menu__email">{email}</div>
            {plan && (
              <span className={cx('ws-user-menu__plan', `ws-user-menu__plan--${plan}`)}>
                {plan.charAt(0).toUpperCase() + plan.slice(1)}
              </span>
            )}
          </div>
        </div>
        <div className="ws-user-menu__items">
          {items.map((item, i) =>
            item.divider ? (
              <div key={`divider-${i}`} className="ws-user-menu__divider" />
            ) : (
              <a
                key={item.href ?? `item-${i}`}
                className={cx('ws-user-menu__item', item.danger && 'ws-user-menu__item--danger')}
                href={item.href ?? '#'}
              >
                <Icon name={item.icon ?? 'circle'} className="ws-user-menu__item-icon" />
                <span>{item.text}</span>
              </a>
            ),
          )}
        </div>
      </div>
    </div>
  );
}
