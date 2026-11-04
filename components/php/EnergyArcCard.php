<?php
/**
 * EnergyArcCard — portable mirror of ws_energy_arc_card() / includes/components/energy-arc-card.php
 *
 * Retrospective/analytics card summarizing the "energy arc" of a workshop:
 * eyebrow header (label + time used + status), score row (score + interpretive
 * badge), a sparkline SVG with time-axis ticks, and a grid of bar-fill metrics.
 *
 * @param array $options
 *   - showHeader (bool)   render the eyebrow header row (default: true)
 *   - eyebrow    (string) top-left label (default: 'Energy Arc')
 *   - timeUsed   (string) middle-top muted text (e.g. '8 of 8h used')
 *   - status     (array)  ['text','type' success|warning|danger|info|neutral]
 *   - score      (int)    0..scoreMax (required)
 *   - scoreMax   (int)    default 100
 *   - scoreBadge (array)  ['text','type','variant' pill|note]
 *   - chartData  (array)  [['time','value' 0..100], ...]
 *   - timeLabels (array)  x-axis tick strings
 *   - metrics    (array)  up to 4 ['label','value','fill' 0..100, optional 'barColor']
 *   - theme      (string) 'light' | 'dark' (default: 'light')
 *   - accent     (string) override accent hex
 *   - id, class, attrs[]
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function energy_arc_card(array $options = []): string
{
    $showHeader = $options['showHeader'] ?? true;
    $eyebrow    = $options['eyebrow']    ?? 'Energy Arc';
    $timeUsed   = $options['timeUsed']   ?? '';
    $status     = $options['status']     ?? null;
    $score      = isset($options['score']) ? (int) $options['score'] : 0;
    $scoreMax   = isset($options['scoreMax']) ? (int) $options['scoreMax'] : 100;
    $scoreBadge = $options['scoreBadge'] ?? null;
    $chartData  = $options['chartData']  ?? [];
    $timeLabels = $options['timeLabels'] ?? [];
    $metrics    = $options['metrics']    ?? [];
    $theme      = $options['theme']      ?? 'light';
    $accent     = $options['accent']     ?? null;
    $id         = $options['id']         ?? null;
    $class      = $options['class']      ?? '';
    $attrs      = $options['attrs']      ?? [];

    if ($score < 0)         $score = 0;
    if ($score > $scoreMax) $score = $scoreMax;

    $classString = cx([
        'ws-energy-arc',
        'ws-energy-arc--' . ($theme === 'light' ? 'light' : 'dark'),
        $class,
    ]);

    $attrString = attrs(array_merge(
        $id ? ['id' => $id] : [],
        $accent ? ['style' => '--wea-accent: ' . $accent . ';'] : [],
        $attrs
    ));
    if ($attrString !== '') {
        $attrString = ' ' . $attrString;
    }

    // --- Build the sparkline SVG path ---------------------------------------
    $svgW = 300;
    $svgH = 88;
    $padL = 4;
    $padR = 4;
    $padT = 6;
    $padB = 6;

    $points = [];
    $n = count($chartData);
    if ($n >= 2) {
        $innerW = $svgW - $padL - $padR;
        $innerH = $svgH - $padT - $padB;
        foreach (array_values($chartData) as $i => $d) {
            $v = isset($d['value']) ? (float) $d['value'] : 0.0;
            if ($v < 0)   $v = 0;
            if ($v > 100) $v = 100;
            $x = $padL + ($i / ($n - 1)) * $innerW;
            $y = $padT + (1 - ($v / 100)) * $innerH;
            $points[] = [$x, $y];
        }
    }

    $linePath = '';
    $areaPath = '';
    if (count($points) >= 2) {
        $segs = [];
        foreach ($points as $i => $p) {
            $segs[] = ($i === 0 ? 'M' : 'L')
                    . number_format($p[0], 2, '.', '') . ',' . number_format($p[1], 2, '.', '');
        }
        $linePath = implode(' ', $segs);

        $lastX   = number_format($points[count($points) - 1][0], 2, '.', '');
        $firstX  = number_format($points[0][0], 2, '.', '');
        $bottomY = number_format($svgH - $padB, 2, '.', '');
        $areaPath = $linePath . " L{$lastX},{$bottomY} L{$firstX},{$bottomY} Z";
    }

    $statusType   = $status['type']        ?? 'neutral';
    $statusText   = $status['text']        ?? '';
    $badgeType    = $scoreBadge['type']    ?? 'neutral';
    $badgeText    = $scoreBadge['text']    ?? '';
    $badgeVariant = $scoreBadge['variant'] ?? 'pill';

    $html = '<div class="' . $classString . '"' . $attrString . '>';

    if ($showHeader) {
        $html .= '<div class="ws-energy-arc__header">';
        $html .= '<span class="ws-energy-arc__eyebrow">' . e(strtoupper($eyebrow)) . '</span>';
        if ($timeUsed !== '') {
            $html .= '<span class="ws-energy-arc__timeused">' . e(strtoupper($timeUsed)) . '</span>';
        }
        if ($statusText !== '') {
            $html .= '<span class="ws-energy-arc__status ws-energy-arc__status--' . e($statusType) . '">'
                   . e(strtoupper($statusText)) . '</span>';
        }
        $html .= '</div>';
    }

    $html .= '<div class="ws-energy-arc__card">';

    $html .= '<div class="ws-energy-arc__score-row">';
    $html .= '<div class="ws-energy-arc__score">'
           . '<span class="ws-energy-arc__score-value">' . e((string) $score) . '</span>'
           . '<span class="ws-energy-arc__score-max"> / ' . e((string) $scoreMax) . '</span>'
           . '</div>';
    if ($badgeText !== '') {
        $variantClass = $badgeVariant === 'note' ? ' ws-energy-arc__badge--note' : '';
        $html .= '<span class="ws-energy-arc__badge ws-energy-arc__badge--' . e($badgeType) . $variantClass . '">'
               . e($badgeText) . '</span>';
    }
    $html .= '</div>';

    if ($linePath !== '') {
        $gradId = 'wea-grad-' . uniqid('', false);
        $html .= '<div class="ws-energy-arc__chart">'
               . '<svg class="ws-energy-arc__svg" viewBox="0 0 ' . $svgW . ' ' . $svgH . '"'
               . ' preserveAspectRatio="none" role="img" aria-label="Energy arc over time"'
               . ' xmlns="http://www.w3.org/2000/svg">'
               . '<defs><linearGradient id="' . e($gradId) . '" x1="0" y1="0" x2="0" y2="1">'
               . '<stop offset="0%" stop-color="var(--wea-accent)" stop-opacity="0.35" />'
               . '<stop offset="100%" stop-color="var(--wea-accent)" stop-opacity="0.02" />'
               . '</linearGradient></defs>'
               . '<path class="ws-energy-arc__area" d="' . e($areaPath) . '"'
               . ' fill="var(--wea-accent)" fill-opacity="0.12" stroke="none" />'
               . '<path class="ws-energy-arc__line" d="' . e($linePath) . '"'
               . ' fill="none" stroke="var(--wea-accent)" stroke-width="1.75"'
               . ' stroke-linecap="round" stroke-linejoin="round" />';
        foreach ($points as $p) {
            $html .= '<circle class="ws-energy-arc__dot" cx="' . number_format($p[0], 2, '.', '')
                   . '" cy="' . number_format($p[1], 2, '.', '') . '" r="2.25"'
                   . ' fill="var(--wea-surface)" stroke="var(--wea-accent)" stroke-width="1.5" />';
        }
        $html .= '</svg></div>';

        if (!empty($timeLabels)) {
            $html .= '<div class="ws-energy-arc__axis">';
            foreach ($timeLabels as $t) {
                $html .= '<span class="ws-energy-arc__tick">' . e((string) $t) . '</span>';
            }
            $html .= '</div>';
        }
    }

    if (!empty($metrics)) {
        $html .= '<div class="ws-energy-arc__metrics">';
        foreach ($metrics as $m) {
            $mLabel = $m['label'] ?? '';
            $mValue = $m['value'] ?? '';
            $mFill  = isset($m['fill']) ? (float) $m['fill'] : 0.0;
            if ($mFill < 0)   $mFill = 0;
            if ($mFill > 100) $mFill = 100;
            $mBarColor = $m['barColor'] ?? null;
            $barStyle = 'width: ' . number_format($mFill, 2, '.', '') . '%;';
            if ($mBarColor) {
                $barStyle .= ' background:' . e($mBarColor) . ';';
            }
            $html .= '<div class="ws-energy-arc__metric">'
                   . '<span class="ws-energy-arc__metric-label">' . e(strtoupper($mLabel)) . '</span>'
                   . '<span class="ws-energy-arc__metric-bar" aria-hidden="true">'
                   . '<span class="ws-energy-arc__metric-bar-fill" style="' . $barStyle . '"></span>'
                   . '</span>'
                   . '<span class="ws-energy-arc__metric-value">' . e((string) $mValue) . '</span>'
                   . '</div>';
        }
        $html .= '</div>';
    }

    $html .= '</div>'; // .ws-energy-arc__card
    $html .= '</div>'; // .ws-energy-arc

    return $html;
}
