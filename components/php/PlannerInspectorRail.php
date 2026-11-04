<?php
/**
 * PlannerInspectorRail — portable mirror of ws_planner_inspector_rail()
 * / includes/components/planner-inspector-rail.php
 *
 * The right-column inspector sidebar of the Workshop Planner. Three optional
 * sections stacked with dividers:
 *   1. Energy — wraps energy_arc_card() under a section title.
 *   2. Coach — list of coach-suggestion items (icon + eyebrow + line + meta).
 *   3. Facilitators — avatar stack + presence blurb.
 *
 * @param array $options
 *   - energy       (array|null) ['title','meta','card' (energy_arc_card options)]
 *   - coach        (array|null) ['title','meta','items' [{icon?,pre,line,meta?,action?,href?}]]
 *   - facilitators (array|null) ['title','meta','avatars' [{initials,bg}], 'presence' {name,status}]
 *   - id, class, attrs[]
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';
require_once __DIR__ . '/EnergyArcCard.php';

function planner_inspector_rail(array $options = []): string
{
    $energy       = $options['energy']       ?? null;
    $coach        = $options['coach']        ?? null;
    $facilitators = $options['facilitators'] ?? null;
    $id           = $options['id']           ?? null;
    $class        = $options['class']        ?? '';
    $attrs        = $options['attrs']        ?? [];

    $classString = cx(['ws-planner-inspector-rail', $class]);

    $attrString = attrs(array_merge($id ? ['id' => $id] : [], $attrs));
    if ($attrString !== '') {
        $attrString = ' ' . $attrString;
    }

    // pre-label → default icon
    $defaultIcon = [
        'TIMING' => 'schedule',
        'ENERGY' => 'monitoring',
        'CLOSE'  => 'chat_bubble',
        'PACE'   => 'speed',
        'FOCUS'  => 'center_focus_strong',
    ];

    $sectionTitle = static function (string $title, string $meta): string {
        if ($title === '' && $meta === '') {
            return '';
        }
        $out = '<div class="ws-planner-inspector-rail__title"><span>' . e($title) . '</span>';
        if ($meta !== '') {
            $out .= '<b>' . e($meta) . '</b>';
        }
        return $out . '</div>';
    };

    $html = '<aside class="' . $classString . '"' . $attrString . '>';

    // --- Energy -------------------------------------------------------------
    if (is_array($energy)) {
        $eTitle = $energy['title'] ?? '';
        $eMeta  = $energy['meta']  ?? '';
        $eCard  = is_array($energy['card'] ?? null) ? $energy['card'] : [];
        if (!array_key_exists('showHeader', $eCard)) {
            $eCard['showHeader'] = false;
        }
        if (isset($eCard['scoreBadge']) && is_array($eCard['scoreBadge'])
            && !isset($eCard['scoreBadge']['variant'])) {
            $eCard['scoreBadge']['variant'] = 'note';
        }

        $html .= '<section class="ws-planner-inspector-rail__section">'
               . $sectionTitle($eTitle, $eMeta)
               . '<div class="ws-planner-inspector-rail__energy">' . energy_arc_card($eCard) . '</div>'
               . '</section>';
    }

    // --- Coach suggestions --------------------------------------------------
    if (is_array($coach) && !empty($coach['items'])) {
        $cTitle = $coach['title'] ?? '';
        $cMeta  = $coach['meta']  ?? '';

        $html .= '<section class="ws-planner-inspector-rail__section">'
               . $sectionTitle($cTitle, $cMeta)
               . '<div class="ws-planner-inspector-rail__suggestions">';
        foreach ($coach['items'] as $item) {
            $iPre    = $item['pre']    ?? '';
            $iLine   = $item['line']   ?? '';
            $iMeta   = $item['meta']   ?? '';
            $iAction = $item['action'] ?? '';
            $iHref   = $item['href']   ?? null;
            $iIcon   = $item['icon']   ?? ($defaultIcon[strtoupper($iPre)] ?? 'lightbulb');
            $tag     = $iHref ? 'a' : 'button';
            $hrefA   = $iHref ? ' href="' . e($iHref) . '"' : ' type="button"';

            $html .= '<' . $tag . ' class="ws-planner-inspector-rail__sugg"' . $hrefA . '>'
                   . '<span class="ws-planner-inspector-rail__sugg-icon" aria-hidden="true">' . icon($iIcon) . '</span>';
            if ($iPre !== '') {
                $html .= '<span class="ws-planner-inspector-rail__sugg-pre">' . e(strtoupper($iPre)) . '</span>';
            }
            if ($iLine !== '') {
                // intentionally unescaped so callers can pass <em> markup
                $html .= '<p class="ws-planner-inspector-rail__sugg-line">' . $iLine . '</p>';
            }
            if ($iMeta !== '' || $iAction !== '') {
                $html .= '<span class="ws-planner-inspector-rail__sugg-meta">';
                if ($iMeta !== '') {
                    $html .= '<span>' . e($iMeta) . '</span>';
                }
                if ($iAction !== '') {
                    $html .= '<span>· ' . e($iAction) . '</span>';
                }
                $html .= '</span>';
            }
            $html .= '</' . $tag . '>';
        }
        $html .= '</div></section>';
    }

    // --- Facilitators -------------------------------------------------------
    if (is_array($facilitators)
        && (!empty($facilitators['avatars']) || !empty($facilitators['presence']))) {
        $fTitle   = $facilitators['title']    ?? '';
        $fMeta    = $facilitators['meta']     ?? '';
        $avatars  = $facilitators['avatars']  ?? [];
        $presence = $facilitators['presence'] ?? null;

        $html .= '<section class="ws-planner-inspector-rail__section ws-planner-inspector-rail__section--last">'
               . $sectionTitle($fTitle, $fMeta)
               . '<div class="ws-planner-inspector-rail__presence">';
        if (!empty($avatars)) {
            $html .= '<div class="ws-planner-inspector-rail__avatars" aria-hidden="true">';
            foreach ($avatars as $a) {
                $initials = $a['initials'] ?? '?';
                $bg       = $a['bg']       ?? '#888';
                $html .= '<span style="background: ' . e($bg) . ';">' . e($initials) . '</span>';
            }
            $html .= '</div>';
        }
        if (is_array($presence)) {
            $html .= '<div class="ws-planner-inspector-rail__presence-meta">';
            if (!empty($presence['name'])) {
                $html .= '<b>' . e($presence['name']) . '</b>';
            }
            if (!empty($presence['status'])) {
                $html .= '<span>' . e($presence['status']) . '</span>';
            }
            $html .= '</div>';
        }
        $html .= '</div></section>';
    }

    $html .= '</aside>';

    return $html;
}
