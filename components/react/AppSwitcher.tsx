import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';

export interface WsAppSwitcherApp {
  key: string;
  name: string;
  /** Material Symbols icon name. */
  icon: string;
  href: string;
  desc?: string;
  beta?: boolean;
  locked?: boolean;
}

export interface WsAppSwitcherPhase {
  key: string;
  label: string;
  /** Material Symbols icon name for the phase header. */
  icon: string;
  apps: WsAppSwitcherApp[];
}

export interface WsAppSwitcherProps {
  title?: string;
  subtitle?: string;
  /** App key to highlight as the current app. */
  active?: string;
  phases?: WsAppSwitcherPhase[];
  id?: string;
  className?: string;
}

const DEFAULT_PHASES: WsAppSwitcherPhase[] = [
  {
    key: 'learn',
    label: 'LEARN',
    icon: 'menu_book',
    apps: [
      { key: 'library', name: 'Library', icon: 'menu_book', href: '/library/', desc: 'Workshop & exercise library' },
      { key: 'academy', name: 'Academy', icon: 'school', href: '/academy/', desc: 'Learn facilitation skills' },
    ],
  },
  {
    key: 'plan',
    label: 'PLAN',
    icon: 'edit_calendar',
    apps: [
      { key: 'planner', name: 'Planner', icon: 'table_view', href: '/planner/', desc: 'Build workshop agendas', beta: true, locked: true },
      { key: 'toolkits', name: 'Toolkits', icon: 'build_circle', href: '/toolkits/', desc: 'Tools for facilitation' },
    ],
  },
  {
    key: 'facilitate',
    label: 'FACILITATE',
    icon: 'record_voice_over',
    apps: [
      { key: 'facilitator', name: 'Facilitator', icon: 'interactive_space', href: '/facilitator/', desc: 'Real-time workshop management', beta: true, locked: true },
      { key: 'intervention', name: 'Intervention Cards', icon: 'stacks', href: '/intervention/', desc: 'In-session rescue prompts' },
      { key: 'tips', name: 'Tips', icon: 'lightbulb', href: '/tips/', desc: 'Quick actionable workshop guidance' },
    ],
  },
  {
    key: 'reflect',
    label: 'REFLECT',
    icon: 'self_improvement',
    apps: [
      { key: 'dna', name: "Facilitator's DNA Quiz", icon: 'genetics', href: '/dna/', desc: 'Discover your facilitation style' },
      { key: 'coach', name: 'Coach', icon: 'sports', href: '/coach/', desc: 'AI-powered workshop reflection' },
    ],
  },
];

const LockIcon = (): React.ReactElement => (
  <svg
    className="gn-switcher__lock"
    width="12"
    height="12"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    strokeWidth="2"
    strokeLinecap="round"
    strokeLinejoin="round"
    aria-label="Pro"
  >
    <rect x="4" y="11" width="16" height="10" rx="2" />
    <path d="M8 11V8a4 4 0 0 1 8 0v3" />
  </svg>
);

/** Mirror of the "App Switcher (Property Switcher)" pattern — the .gn-switcher popover. */
export function WsAppSwitcher({
  title = 'Products',
  subtitle = 'Tools for every stage of facilitation',
  active,
  phases = DEFAULT_PHASES,
  id = 'gn-app-switcher',
  className,
}: WsAppSwitcherProps): React.ReactElement {
  return (
    <div id={id} className={cx('gn-switcher', className)} hidden role="dialog" aria-label="Switch apps">
      <header className="gn-switcher__head">
        <h2 className="gn-switcher__title">{title}</h2>
        <p className="gn-switcher__sub">{subtitle}</p>
      </header>
      <div className="gn-switcher__grid">
        {phases.map((phase) => (
          <section key={phase.key} className="gn-switcher__col" data-phase={phase.key}>
            <header className={cx('gn-switcher__col-head', `gn-switcher__col-head--${phase.key}`)}>
              <Icon name={phase.icon} />
              <span>{phase.label}</span>
            </header>
            {phase.apps.map((app) => (
              <a
                key={app.key}
                className={cx(
                  'gn-switcher__app',
                  `gn-switcher__app--${phase.key}`,
                  active === app.key && 'is-current',
                )}
                href={app.href}
              >
                <span className="gn-switcher__app-icon" aria-hidden="true">
                  <Icon name={app.icon} />
                </span>
                <span className="gn-switcher__app-body">
                  <span className="gn-switcher__app-name">
                    {app.name}
                    {app.beta && <span className="gn-switcher__pill">BETA</span>}
                    {app.locked && <LockIcon />}
                  </span>
                  {app.desc && <span className="gn-switcher__app-desc">{app.desc}</span>}
                </span>
              </a>
            ))}
          </section>
        ))}
      </div>
    </div>
  );
}
