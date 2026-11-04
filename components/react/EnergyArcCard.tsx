import React from 'react';
import { cx } from './cx';

export type WsEnergyArcTheme = 'light' | 'dark';
export type WsEnergyArcStatusType = 'success' | 'warning' | 'danger' | 'info' | 'neutral';
export type WsEnergyArcBadgeVariant = 'pill' | 'note';

export interface WsEnergyArcStatus {
  text: string;
  type?: WsEnergyArcStatusType;
}

export interface WsEnergyArcBadge {
  text: string;
  type?: WsEnergyArcStatusType;
  variant?: WsEnergyArcBadgeVariant;
}

export interface WsEnergyArcChartPoint {
  time?: string;
  /** 0..100 */
  value: number;
}

export interface WsEnergyArcMetric {
  label: string;
  value: string | number;
  /** 0..100 */
  fill?: number;
  /** Override bar color (hex). */
  barColor?: string;
}

export interface WsEnergyArcCardProps {
  showHeader?: boolean;
  eyebrow?: string;
  timeUsed?: string;
  status?: WsEnergyArcStatus;
  score?: number;
  scoreMax?: number;
  scoreBadge?: WsEnergyArcBadge;
  chartData?: WsEnergyArcChartPoint[];
  timeLabels?: string[];
  metrics?: WsEnergyArcMetric[];
  theme?: WsEnergyArcTheme;
  /** Override accent hex via the --wea-accent custom property. */
  accent?: string;
  id?: string;
  className?: string;
}

const SVG_W = 300;
const SVG_H = 88;
const PAD_L = 4;
const PAD_R = 4;
const PAD_T = 6;
const PAD_B = 6;

const fmt = (n: number): string => n.toFixed(2);
const clamp = (n: number, min: number, max: number): number => Math.min(Math.max(n, min), max);

/** Mirror of ws_energy_arc_card() — renders the `ws-energy-arc` markup. */
export function WsEnergyArcCard({
  showHeader = true,
  eyebrow = 'Energy Arc',
  timeUsed = '',
  status,
  score = 0,
  scoreMax = 100,
  scoreBadge,
  chartData = [],
  timeLabels = [],
  metrics = [],
  theme = 'light',
  accent,
  id,
  className,
}: WsEnergyArcCardProps): React.ReactElement {
  const clampedScore = clamp(score, 0, scoreMax);

  const classes = cx('ws-energy-arc', `ws-energy-arc--${theme === 'light' ? 'light' : 'dark'}`, className);

  const style = accent ? ({ '--wea-accent': accent } as React.CSSProperties) : undefined;

  // Build the sparkline points.
  const points: Array<[number, number]> = [];
  const n = chartData.length;
  if (n >= 2) {
    const innerW = SVG_W - PAD_L - PAD_R;
    const innerH = SVG_H - PAD_T - PAD_B;
    chartData.forEach((d, i) => {
      const v = clamp(d.value ?? 0, 0, 100);
      const x = PAD_L + (i / (n - 1)) * innerW;
      const y = PAD_T + (1 - v / 100) * innerH;
      points.push([x, y]);
    });
  }

  let linePath = '';
  let areaPath = '';
  if (points.length >= 2) {
    linePath = points.map((p, i) => `${i === 0 ? 'M' : 'L'}${fmt(p[0])},${fmt(p[1])}`).join(' ');
    const lastX = fmt(points[points.length - 1][0]);
    const firstX = fmt(points[0][0]);
    const bottomY = fmt(SVG_H - PAD_B);
    areaPath = `${linePath} L${lastX},${bottomY} L${firstX},${bottomY} Z`;
  }

  const statusType = status?.type ?? 'neutral';
  const statusText = status?.text ?? '';
  const badgeType = scoreBadge?.type ?? 'neutral';
  const badgeText = scoreBadge?.text ?? '';
  const badgeVariant = scoreBadge?.variant ?? 'pill';

  const gradId = React.useId();

  return (
    <div id={id} className={classes} style={style}>
      {showHeader && (
        <div className="ws-energy-arc__header">
          <span className="ws-energy-arc__eyebrow">{eyebrow.toUpperCase()}</span>
          {timeUsed !== '' && <span className="ws-energy-arc__timeused">{timeUsed.toUpperCase()}</span>}
          {statusText !== '' && (
            <span className={`ws-energy-arc__status ws-energy-arc__status--${statusType}`}>
              {statusText.toUpperCase()}
            </span>
          )}
        </div>
      )}

      <div className="ws-energy-arc__card">
        <div className="ws-energy-arc__score-row">
          <div className="ws-energy-arc__score">
            <span className="ws-energy-arc__score-value">{clampedScore}</span>
            <span className="ws-energy-arc__score-max"> / {scoreMax}</span>
          </div>
          {badgeText !== '' && (
            <span
              className={cx(
                'ws-energy-arc__badge',
                `ws-energy-arc__badge--${badgeType}`,
                badgeVariant === 'note' && 'ws-energy-arc__badge--note',
              )}
            >
              {badgeText}
            </span>
          )}
        </div>

        {linePath !== '' && (
          <>
            <div className="ws-energy-arc__chart">
              <svg
                className="ws-energy-arc__svg"
                viewBox={`0 0 ${SVG_W} ${SVG_H}`}
                preserveAspectRatio="none"
                role="img"
                aria-label="Energy arc over time"
                xmlns="http://www.w3.org/2000/svg"
              >
                <defs>
                  <linearGradient id={gradId} x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stopColor="var(--wea-accent)" stopOpacity="0.35" />
                    <stop offset="100%" stopColor="var(--wea-accent)" stopOpacity="0.02" />
                  </linearGradient>
                </defs>
                <path
                  className="ws-energy-arc__area"
                  d={areaPath}
                  fill="var(--wea-accent)"
                  fillOpacity="0.12"
                  stroke="none"
                />
                <path
                  className="ws-energy-arc__line"
                  d={linePath}
                  fill="none"
                  stroke="var(--wea-accent)"
                  strokeWidth="1.75"
                  strokeLinecap="round"
                  strokeLinejoin="round"
                />
                {points.map((p, i) => (
                  <circle
                    key={i}
                    className="ws-energy-arc__dot"
                    cx={fmt(p[0])}
                    cy={fmt(p[1])}
                    r="2.25"
                    fill="var(--wea-surface)"
                    stroke="var(--wea-accent)"
                    strokeWidth="1.5"
                  />
                ))}
              </svg>
            </div>
            {timeLabels.length > 0 && (
              <div className="ws-energy-arc__axis">
                {timeLabels.map((t, i) => (
                  <span key={i} className="ws-energy-arc__tick">
                    {t}
                  </span>
                ))}
              </div>
            )}
          </>
        )}

        {metrics.length > 0 && (
          <div className="ws-energy-arc__metrics">
            {metrics.map((m, i) => {
              const fill = clamp(m.fill ?? 0, 0, 100);
              const barStyle: React.CSSProperties = { width: `${fmt(fill)}%` };
              if (m.barColor) barStyle.background = m.barColor;
              return (
                <div key={i} className="ws-energy-arc__metric">
                  <span className="ws-energy-arc__metric-label">{(m.label ?? '').toUpperCase()}</span>
                  <span className="ws-energy-arc__metric-bar" aria-hidden="true">
                    <span className="ws-energy-arc__metric-bar-fill" style={barStyle} />
                  </span>
                  <span className="ws-energy-arc__metric-value">{m.value}</span>
                </div>
              );
            })}
          </div>
        )}
      </div>
    </div>
  );
}
