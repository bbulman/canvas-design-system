<?php
/**
 * PlannerLibraryRail — portable mirror of ws_planner_library_rail()
 * / includes/components/planner-library-rail.php
 *
 * The left palette sidebar of the Workshop Planner. Composes an optional
 * search input, a top-level categories nav, one or more stacked sections
 * (flat item lists, onboarding "instructions" blocks, or filter + category
 * drill-in grids), and an optional footer CTA. Activity items render through
 * planner_card() at size=sm so the card language stays consistent.
 *
 * @param array $options
 *   - search     (array|null) ['placeholder','kbd','name','value']
 *   - categories (array|null) ['title','count','items' [{label,color,count?,active?,href?,id?}]]
 *   - sections   (array)      see section shape below
 *   - footer     (array|null) ['label','button' {text,icon,id?,action?,href?}]
 *   - id, class, attrs[]
 *
 * Section shape:
 *   - title, meta, icon
 *   - kind            'items' (default) | 'instructions'
 *   - collapsible (bool), defaultOpen (bool, default true)
 *   - filter          ['name','options' [{value,label,selected?}]]
 *   - categoryButtons [{id,name,icon?,count?,type?}]
 *   - items           items=planner_card option bags / instructions=[{icon,body}]
 *   - showMore (int)  instructions: visible count before "Show more"
 *   - id              section id
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';
require_once __DIR__ . '/PlannerCard.php';

function planner_library_rail(array $options = []): string
{
    $search     = $options['search']     ?? null;
    $categories = $options['categories'] ?? null;
    $sections   = $options['sections']   ?? [];
    $footer     = $options['footer']     ?? null;
    $id         = $options['id']         ?? null;
    $class      = $options['class']      ?? '';
    $attrs      = $options['attrs']      ?? [];

    $classString = cx(['ws-planner-rail', $class]);

    $attrString = attrs(array_merge($id ? ['id' => $id] : [], $attrs));
    if ($attrString !== '') {
        $attrString = ' ' . $attrString;
    }

    $hasCollapsibleOrShowMore = false;
    foreach ($sections as $sec) {
        if (!empty($sec['collapsible']) || !empty($sec['showMore'])) {
            $hasCollapsibleOrShowMore = true;
            break;
        }
    }

    $html = '<aside class="' . $classString . '"' . $attrString . '>';

    // --- Search -------------------------------------------------------------
    if (is_array($search)) {
        $sPlaceholder = $search['placeholder'] ?? 'Search…';
        $sKbd         = $search['kbd']         ?? '';
        $sName        = $search['name']        ?? 'q';
        $sValue       = $search['value']       ?? '';

        $html .= '<div class="ws-planner-rail__search" role="search">'
               . '<svg class="ws-planner-rail__search-icon" viewBox="0 0 24 24" fill="none"'
               . ' stroke="currentColor" stroke-width="1.8" aria-hidden="true">'
               . '<circle cx="11" cy="11" r="7"/><path d="M21 21l-4.4-4.4"/></svg>'
               . '<input type="search" name="' . e($sName) . '" value="' . e($sValue) . '"'
               . ' placeholder="' . e($sPlaceholder) . '" aria-label="' . e($sPlaceholder) . '" />';
        if ($sKbd !== '') {
            $html .= '<span class="ws-planner-rail__search-kbd" aria-hidden="true">' . e($sKbd) . '</span>';
        }
        $html .= '</div>';
    }

    // --- Categories nav -----------------------------------------------------
    if (is_array($categories) && !empty($categories['items'])) {
        $cTitle = $categories['title'] ?? 'Library';
        $cCount = $categories['count'] ?? '';

        $html .= '<div class="ws-planner-rail__h"><span>' . e($cTitle) . '</span>';
        if ($cCount !== '') {
            $html .= '<span>' . e((string) $cCount) . '</span>';
        }
        $html .= '</div>';

        $html .= '<nav class="ws-planner-rail__categories" aria-label="' . e($cTitle) . '">';
        foreach ($categories['items'] as $cat) {
            $cLabel  = $cat['label']  ?? '';
            $cColor  = $cat['color']  ?? '#888888';
            $cCtCnt  = $cat['count']  ?? null;
            $cActive = !empty($cat['active']);
            $cHref   = $cat['href']   ?? null;
            $cId     = $cat['id']     ?? null;
            $catTag  = $cHref ? 'a' : 'button';

            $catAttrString = attrs(array_merge(
                $cHref ? ['href' => $cHref] : ['type' => 'button'],
                $cId ? ['id' => $cId] : [],
                $cActive ? ['aria-current' => 'page'] : []
            ));
            $catClasses = cx(['ws-planner-rail__cat', $cActive ? 'is-active' : '']);

            $html .= '<' . $catTag . ' class="' . $catClasses . '" ' . $catAttrString . '>'
                   . '<span class="ws-planner-rail__cat-dot" style="background: ' . e($cColor) . ';" aria-hidden="true"></span>'
                   . '<span class="ws-planner-rail__cat-label">' . e($cLabel) . '</span>';
            if ($cCtCnt !== null) {
                $html .= '<span class="ws-planner-rail__cat-count">' . e((string) $cCtCnt) . '</span>';
            }
            $html .= '</' . $catTag . '>';
        }
        $html .= '</nav>';
    }

    // --- Sections -----------------------------------------------------------
    foreach ($sections as $sIdx => $sec) {
        $secTitle       = $sec['title']           ?? '';
        $secMeta        = $sec['meta']            ?? '';
        $secIcon        = $sec['icon']            ?? null;
        $secKind        = $sec['kind']            ?? 'items';
        $secCollapsible = !empty($sec['collapsible']);
        $secOpen        = !isset($sec['defaultOpen']) || !empty($sec['defaultOpen']);
        $secFilter      = $sec['filter']          ?? null;
        $secCatBtns     = $sec['categoryButtons'] ?? null;
        $secItems       = $sec['items']           ?? [];
        $secShowMore    = isset($sec['showMore']) ? (int) $sec['showMore'] : null;
        $secId          = $sec['id']              ?? ('wpr-sec-' . $sIdx);

        if ($secTitle === '' && empty($secItems) && empty($secCatBtns)) {
            continue;
        }

        $secClasses = cx([
            'ws-planner-rail__section',
            $secCollapsible ? 'is-collapsible' : '',
            ($secCollapsible && !$secOpen) ? 'is-collapsed' : '',
            $secKind === 'instructions' ? 'is-instructions' : '',
        ]);

        $html .= '<section class="' . $secClasses . '" data-section-id="' . e($secId) . '">';

        if ($secTitle !== '' || $secMeta !== '') {
            if ($secCollapsible) {
                $html .= '<button type="button" class="ws-planner-rail__h ws-planner-rail__h--toggle"'
                       . ' aria-expanded="' . ($secOpen ? 'true' : 'false') . '"'
                       . ' aria-controls="' . e($secId) . '-body"'
                       . ' data-rail-toggle="' . e($secId) . '">'
                       . '<span class="ws-planner-rail__h-left">';
                if ($secIcon) {
                    $html .= '<span class="ws-planner-rail__h-icon" aria-hidden="true">' . icon($secIcon) . '</span>';
                }
                $html .= '<span>' . e($secTitle) . '</span></span>'
                       . '<span class="ws-planner-rail__h-right">';
                if ($secMeta !== '') {
                    $html .= '<span>' . e($secMeta) . '</span>';
                }
                $html .= '<span class="ws-planner-rail__h-chevron" aria-hidden="true">' . icon('expand_more') . '</span>'
                       . '</span></button>';
            } else {
                $html .= '<div class="ws-planner-rail__h"><span class="ws-planner-rail__h-left">';
                if ($secIcon) {
                    $html .= '<span class="ws-planner-rail__h-icon" aria-hidden="true">' . icon($secIcon) . '</span>';
                }
                $html .= '<span>' . e($secTitle) . '</span></span>';
                if ($secMeta !== '') {
                    $html .= '<span>' . e($secMeta) . '</span>';
                }
                $html .= '</div>';
            }
        }

        $bodyHidden = ($secCollapsible && !$secOpen) ? ' hidden' : '';
        $html .= '<div class="ws-planner-rail__body" id="' . e($secId) . '-body"' . $bodyHidden . '>';

        // Filter select
        if (is_array($secFilter) && !empty($secFilter['options'])) {
            $html .= '<div class="ws-planner-rail__filter">'
                   . '<select name="' . e($secFilter['name'] ?? 'filter') . '" class="ws-planner-rail__select">';
            foreach ($secFilter['options'] as $opt) {
                $selected = !empty($opt['selected']) ? ' selected' : '';
                $html .= '<option value="' . e($opt['value'] ?? '') . '"' . $selected . '>'
                       . e($opt['label'] ?? '') . '</option>';
            }
            $html .= '</select>'
                   . '<span class="ws-planner-rail__select-chevron" aria-hidden="true">' . icon('expand_more') . '</span>'
                   . '</div>';
        }

        // Category drill-in grid
        if (is_array($secCatBtns) && !empty($secCatBtns)) {
            $html .= '<div class="ws-planner-rail__cat-grid" role="list">';
            foreach ($secCatBtns as $btn) {
                $bId    = $btn['id']    ?? '';
                $bName  = $btn['name']  ?? '';
                $bIcon  = $btn['icon']  ?? null;
                $bCount = $btn['count'] ?? null;
                $bType  = $btn['type']  ?? null;

                $btnAttrs = attrs(array_merge(
                    ['data-category-id' => $bId, 'data-category-name' => $bName],
                    $bType ? ['data-type' => $bType] : []
                ));
                $html .= '<button type="button" class="ws-planner-rail__cat-btn" role="listitem" ' . $btnAttrs . '>';
                if ($bIcon) {
                    $html .= '<span class="ws-planner-rail__cat-btn-icon" aria-hidden="true">' . icon($bIcon) . '</span>';
                }
                $html .= '<span class="ws-planner-rail__cat-btn-name">' . e($bName) . '</span>';
                if ($bCount !== null) {
                    $html .= '<span class="ws-planner-rail__cat-btn-count">' . e((string) $bCount) . '</span>';
                }
                $html .= '</button>';
            }
            $html .= '</div>';
        }

        // Instructions tips or item cards
        if ($secKind === 'instructions' && !empty($secItems)) {
            $html .= '<div class="ws-planner-rail__instructions">';
            $visibleCount = $secShowMore ?? count($secItems);
            foreach ($secItems as $iIdx => $tip) {
                $tIcon  = $tip['icon'] ?? 'lightbulb';
                $tBody  = $tip['body'] ?? '';
                $hidden = $secShowMore !== null && $iIdx >= $visibleCount;
                $html .= '<div class="ws-planner-rail__tip' . ($hidden ? ' is-hidden-more' : '') . '"'
                       . ($hidden ? ' hidden' : '') . '>'
                       . '<span class="ws-planner-rail__tip-icon" aria-hidden="true">' . icon($tIcon) . '</span>'
                       . '<p class="ws-planner-rail__tip-body">' . e($tBody) . '</p>'
                       . '</div>';
            }
            if ($secShowMore !== null && count($secItems) > $visibleCount) {
                $html .= '<button type="button" class="ws-planner-rail__show-more" data-rail-show-more="' . e($secId) . '">'
                       . '<span class="ws-planner-rail__show-more-icon" aria-hidden="true">' . icon('expand_more') . '</span>'
                       . '<span data-label-more="Show more" data-label-less="Show less">Show more</span>'
                       . '</button>';
            }
            $html .= '</div>';
        } elseif (!empty($secItems)) {
            $html .= '<div class="ws-planner-rail__items">';
            foreach ($secItems as $item) {
                $itemTitle = $item['title'] ?? '';
                $cardOpts  = array_merge(['size' => 'sm', 'draggable' => true], $item);
                unset($cardOpts['title']);
                if (!isset($cardOpts['attrs']) || !is_array($cardOpts['attrs'])) {
                    $cardOpts['attrs'] = [];
                }
                if (!isset($cardOpts['attrs']['draggable'])) {
                    $cardOpts['attrs']['draggable'] = 'true';
                }
                $html .= planner_card($itemTitle, $cardOpts);
            }
            $html .= '</div>';
        }

        $html .= '</div>';  // .ws-planner-rail__body
        $html .= '</section>';
    }

    // --- Footer CTA ---------------------------------------------------------
    if (is_array($footer) && !empty($footer['button'])) {
        $fLabel  = $footer['label'] ?? '';
        $fBtn    = $footer['button'];
        $fText   = $fBtn['text']   ?? 'Create';
        $fIcon   = $fBtn['icon']   ?? 'add_circle';
        $fId     = $fBtn['id']     ?? null;
        $fAction = $fBtn['action'] ?? null;
        $fHref   = $fBtn['href']   ?? null;
        $fTag    = $fHref ? 'a' : 'button';

        $fAttrString = attrs(array_merge(
            $fHref ? ['href' => $fHref] : ['type' => 'button'],
            $fId ? ['id' => $fId] : [],
            $fAction ? ['data-action' => $fAction] : []
        ));

        $html .= '<div class="ws-planner-rail__footer">';
        if ($fLabel !== '') {
            $html .= '<p class="ws-planner-rail__footer-label">' . e($fLabel) . '</p>';
        }
        $html .= '<' . $fTag . ' class="ws-planner-rail__footer-btn" ' . $fAttrString . '>'
               . '<span class="ws-planner-rail__footer-btn-icon" aria-hidden="true">' . icon($fIcon) . '</span>'
               . '<span>' . e($fText) . '</span>'
               . '</' . $fTag . '>';
        $html .= '</div>';
    }

    $html .= '</aside>';

    return $html;
}
