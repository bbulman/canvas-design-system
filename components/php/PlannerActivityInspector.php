<?php
/**
 * PlannerActivityInspector — portable mirror of ws_planner_activity_inspector()
 * / includes/components/planner-activity-inspector.php
 *
 * The activity-detail mode of the planner right rail. Shares the inspector
 * shell but is driven by the selected agenda item. Sections (all optional):
 *   Identity · Overview (optionally tabbed with Instructions) · Energy impact ·
 *   Logistics · Facilitator notes · When it runs · Actions (+ destructive row).
 *
 * @param array $options
 *   - type         (string) exercise|icebreaker|break|custom (drives accent)
 *   - duration     (string) e.g. '60 min'
 *   - groupSize    (string) e.g. '6–12 ppl'
 *   - title        (string) Activity title (required)
 *   - tags         (array)  String tags under the title
 *   - closable     (bool)   Render the × close control (default: true)
 *   - overview     (string) Description paragraph / Overview tab body
 *   - instructions (array|string|null) Step strings (<ol>) or HTML string; when set, Overview becomes tabbed
 *   - activeTab    (string) 'overview' | 'instructions' (default: 'overview')
 *   - energy       (array|null) ['net','dimensions' [{label,delta,fill 0..100}]]
 *   - logistics    (array)  Strings rendered as a 2-col mono bulleted grid
 *   - notes        (array|null) ['body','author','date','canAdd' bool]
 *   - context      (array|null) ['time','description']
 *   - actions      (array)  [{label,icon?,action?,href?}] — primary action row
 *   - destructive  (array|null) Single destructive action, same shape as actions[*]
 *   - id, class, attrs[]
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function planner_activity_inspector(array $options = []): string
{
    $type         = $options['type']         ?? 'exercise';
    $duration     = $options['duration']     ?? '';
    $groupSize    = $options['groupSize']    ?? '';
    $title        = $options['title']        ?? '';
    $tags         = $options['tags']         ?? [];
    $closable     = $options['closable']     ?? true;
    $overview     = $options['overview']     ?? '';
    $instructions = $options['instructions'] ?? null;
    $activeTab    = $options['activeTab']    ?? 'overview';
    if (!in_array($activeTab, ['overview', 'instructions'], true)) {
        $activeTab = 'overview';
    }
    $energy      = $options['energy']      ?? null;
    $logistics   = $options['logistics']   ?? [];
    $notes       = $options['notes']       ?? null;
    $context     = $options['context']     ?? null;
    $actions     = $options['actions']     ?? [];
    $destructive = $options['destructive'] ?? null;
    $id          = $options['id']          ?? null;
    $class       = $options['class']       ?? '';
    $attrs       = $options['attrs']       ?? [];

    $allowedTypes = ['exercise', 'icebreaker', 'break', 'custom'];
    if (!in_array($type, $allowedTypes, true)) {
        $type = 'exercise';
    }

    $classString = cx([
        'ws-planner-activity-inspector',
        'ws-planner-activity-inspector--' . $type,
        $class,
    ]);

    $attrString = attrs(array_merge($id ? ['id' => $id] : [], $attrs));
    if ($attrString !== '') {
        $attrString = ' ' . $attrString;
    }

    $typeLabel = [
        'exercise'   => 'EXERCISE',
        'icebreaker' => 'ICEBREAKER',
        'break'      => 'BREAK',
        'custom'     => 'CUSTOM',
    ][$type];

    $eyebrowParts = array_filter([$typeLabel, $duration, $groupSize], static fn ($v) => $v !== '');
    $eyebrowText  = implode(' · ', $eyebrowParts);

    $renderAction = static function (array $a, string $variant = 'default'): string {
        $label  = $a['label']  ?? '';
        $icon   = $a['icon']   ?? null;
        $href   = $a['href']   ?? null;
        $action = $a['action'] ?? strtolower(str_replace(' ', '-', $label));
        $tag    = $href ? 'a' : 'button';
        $base   = $href ? ' href="' . e($href) . '"' : ' type="button"';
        $cls    = cx([
            'ws-planner-activity-inspector__btn',
            $variant === 'danger' ? 'ws-planner-activity-inspector__btn--danger' : '',
        ]);

        $out = '<' . $tag . ' class="' . $cls . '"' . $base . ' data-action="' . e($action) . '">';
        if ($icon) {
            $out .= '<span class="ws-planner-activity-inspector__btn-icon" aria-hidden="true">' . icon($icon) . '</span>';
        }
        $out .= '<span class="ws-planner-activity-inspector__btn-label">' . e($label) . '</span>';
        return $out . '</' . $tag . '>';
    };

    $html = '<aside class="' . $classString . '"' . $attrString . '>';

    // --- Identity -----------------------------------------------------------
    $html .= '<section class="ws-planner-activity-inspector__section">'
           . '<div class="ws-planner-activity-inspector__eyebrow-row">'
           . '<span class="ws-planner-activity-inspector__eyebrow">' . e($eyebrowText) . '</span>';
    if ($closable) {
        $html .= '<button type="button" class="ws-planner-activity-inspector__close"'
               . ' aria-label="Close inspector" data-action="close">&times;</button>';
    }
    $html .= '</div>';
    $html .= '<h2 class="ws-planner-activity-inspector__title">' . e($title) . '</h2>';
    if (!empty($tags)) {
        $html .= '<p class="ws-planner-activity-inspector__tags">'
               . e(strtoupper(implode(' · ', $tags))) . '</p>';
    }
    $html .= '</section>';

    // --- Overview / Instructions -------------------------------------------
    $hasInstructions = !empty($instructions)
        && (is_array($instructions) ? !empty($instructions) : trim((string) $instructions) !== '');

    if ($overview !== '' || $hasInstructions) {
        if ($hasInstructions) {
            $tabGroup       = 'wpai-tabs-' . substr(md5(uniqid('', true)), 0, 8);
            $overviewActive = $activeTab === 'overview';

            $html .= '<section class="ws-planner-activity-inspector__section" data-tab-group="' . e($tabGroup) . '">'
                   . '<div class="ws-planner-activity-inspector__tabs" role="tablist">'
                   . '<button type="button" class="ws-planner-activity-inspector__tab' . ($overviewActive ? ' is-active' : '') . '"'
                   . ' role="tab" aria-selected="' . ($overviewActive ? 'true' : 'false') . '"'
                   . ' aria-controls="' . e($tabGroup) . '-overview" data-tab="overview">Overview</button>'
                   . '<button type="button" class="ws-planner-activity-inspector__tab' . (!$overviewActive ? ' is-active' : '') . '"'
                   . ' role="tab" aria-selected="' . (!$overviewActive ? 'true' : 'false') . '"'
                   . ' aria-controls="' . e($tabGroup) . '-instructions" data-tab="instructions">Instructions</button>'
                   . '</div>';

            $html .= '<div class="ws-planner-activity-inspector__panel' . ($overviewActive ? ' is-active' : '') . '"'
                   . ' id="' . e($tabGroup) . '-overview" role="tabpanel" data-panel="overview"'
                   . ($overviewActive ? '' : ' hidden') . '>';
            if ($overview !== '') {
                $html .= '<p class="ws-planner-activity-inspector__body">' . e($overview) . '</p>';
            } else {
                $html .= '<p class="ws-planner-activity-inspector__body ws-planner-activity-inspector__body--empty">No overview yet.</p>';
            }
            $html .= '</div>';

            $html .= '<div class="ws-planner-activity-inspector__panel' . (!$overviewActive ? ' is-active' : '') . '"'
                   . ' id="' . e($tabGroup) . '-instructions" role="tabpanel" data-panel="instructions"'
                   . (!$overviewActive ? '' : ' hidden') . '>';
            if (is_array($instructions)) {
                $html .= '<ol class="ws-planner-activity-inspector__steps">';
                foreach ($instructions as $step) {
                    $html .= '<li class="ws-planner-activity-inspector__step">' . e($step) . '</li>';
                }
                $html .= '</ol>';
            } else {
                // string variant — caller owns the markup
                $html .= '<div class="ws-planner-activity-inspector__instructions-html">' . $instructions . '</div>';
            }
            $html .= '</div>';
            $html .= '</section>';
        } else {
            $html .= '<section class="ws-planner-activity-inspector__section">'
                   . '<div class="ws-planner-activity-inspector__label"><span>Overview</span></div>'
                   . '<p class="ws-planner-activity-inspector__body">' . e($overview) . '</p>'
                   . '</section>';
        }
    }

    // --- Energy impact ------------------------------------------------------
    if (is_array($energy) && !empty($energy['dimensions'])) {
        $net = $energy['net'] ?? '';
        $html .= '<section class="ws-planner-activity-inspector__section">'
               . '<div class="ws-planner-activity-inspector__label"><span>Energy impact</span>';
        if ($net !== '') {
            $html .= '<span class="ws-planner-activity-inspector__net">' . e($net) . ' NET</span>';
        }
        $html .= '</div><div class="ws-planner-activity-inspector__dims">';
        foreach ($energy['dimensions'] as $d) {
            $dLabel = $d['label'] ?? '';
            $dDelta = $d['delta'] ?? '';
            $dFill  = isset($d['fill']) ? (float) $d['fill'] : 0.0;
            if ($dFill < 0)   $dFill = 0;
            if ($dFill > 100) $dFill = 100;
            $html .= '<div class="ws-planner-activity-inspector__dim">'
                   . '<span class="ws-planner-activity-inspector__dim-label">' . e($dLabel) . '</span>'
                   . '<span class="ws-planner-activity-inspector__dim-bar" aria-hidden="true">'
                   . '<span class="ws-planner-activity-inspector__dim-fill" style="width: ' . number_format($dFill, 2, '.', '') . '%;"></span>'
                   . '</span>'
                   . '<span class="ws-planner-activity-inspector__dim-val">' . e($dDelta) . '</span>'
                   . '</div>';
        }
        $html .= '</div></section>';
    }

    // --- Logistics ----------------------------------------------------------
    if (!empty($logistics)) {
        $html .= '<section class="ws-planner-activity-inspector__section">'
               . '<div class="ws-planner-activity-inspector__label"><span>Logistics</span></div>'
               . '<div class="ws-planner-activity-inspector__logistics">';
        foreach ($logistics as $item) {
            $html .= '<span class="ws-planner-activity-inspector__log-item">' . e($item) . '</span>';
        }
        $html .= '</div></section>';
    }

    // --- Facilitator notes --------------------------------------------------
    if (is_array($notes) && !empty($notes['body'])) {
        $nAuthor = $notes['author'] ?? '';
        $nDate   = $notes['date']   ?? '';
        $canAdd  = !empty($notes['canAdd']);
        $attr    = trim(implode(' · ', array_filter([$nAuthor, $nDate], static fn ($v) => $v !== '')));

        $html .= '<section class="ws-planner-activity-inspector__section">'
               . '<div class="ws-planner-activity-inspector__label"><span>Facilitator notes</span>';
        if ($canAdd) {
            $html .= '<button type="button" class="ws-planner-activity-inspector__add" data-action="add-note">+ Add</button>';
        }
        $html .= '</div>'
               . '<blockquote class="ws-planner-activity-inspector__note">' . e($notes['body']) . '</blockquote>';
        if ($attr !== '') {
            $html .= '<p class="ws-planner-activity-inspector__note-attr">&mdash; ' . e(strtoupper($attr)) . '</p>';
        }
        $html .= '</section>';
    }

    // --- When it runs -------------------------------------------------------
    if (is_array($context) && (!empty($context['time']) || !empty($context['description']))) {
        $html .= '<section class="ws-planner-activity-inspector__section">'
               . '<div class="ws-planner-activity-inspector__label"><span>When it runs</span></div>'
               . '<div class="ws-planner-activity-inspector__when">';
        if (!empty($context['time'])) {
            $html .= '<b>' . e($context['time']) . '</b>';
        }
        if (!empty($context['description'])) {
            $sep = !empty($context['time']) ? ' · ' : '';
            $html .= '<span>' . e($sep . $context['description']) . '</span>';
        }
        $html .= '</div></section>';
    }

    // --- Actions ------------------------------------------------------------
    if (!empty($actions) || is_array($destructive)) {
        $html .= '<section class="ws-planner-activity-inspector__section ws-planner-activity-inspector__section--last">'
               . '<div class="ws-planner-activity-inspector__label"><span>Actions</span></div>';
        if (!empty($actions)) {
            $html .= '<div class="ws-planner-activity-inspector__actions"'
                   . ' style="grid-template-columns: repeat(' . count($actions) . ', 1fr);">';
            foreach ($actions as $a) {
                $html .= $renderAction($a, 'default');
            }
            $html .= '</div>';
        }
        if (is_array($destructive)) {
            $html .= '<div class="ws-planner-activity-inspector__destructive">'
                   . $renderAction($destructive, 'danger')
                   . '</div>';
        }
        $html .= '</section>';
    }

    $html .= '</aside>';

    return $html;
}
