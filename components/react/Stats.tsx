import React from 'react';
import { WsStat } from './Stat';
import { cx } from './cx';

export interface WsStatItem {
  value: string;
  label: string;
  /** Value color (hex or CSS var). */
  color?: string;
  /** Material Symbols icon name. */
  icon?: string;
}

export interface WsStatsProps {
  /** Stats rendered horizontally, separated by dividers. */
  stats: WsStatItem[];
  id?: string;
  className?: string;
}

/** Mirror of ws_stats() — renders the `ws-stats` group with dividers. */
export function WsStats({ stats, id, className }: WsStatsProps): React.ReactElement {
  return (
    <div id={id} className={cx('ws-stats', className)}>
      {stats.map((s, i) => (
        <React.Fragment key={i}>
          {i > 0 && <div className="ws-stats__divider" />}
          <WsStat value={s.value} label={s.label} color={s.color} icon={s.icon} />
        </React.Fragment>
      ))}
    </div>
  );
}
