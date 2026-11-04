<?php
/**
 * ListingCard — portable mirror of ws_listing_card() / includes/partials/listing-card.php
 *
 * Renders a single content card for listing pages. Expects a prepared card
 * array (the shape produced by the app's prepareCardData()). Like the partial,
 * it shows no sketch and no description: overview and illustration are ignored.
 *
 * @param array $card id, type, title, category, category_class, category_icon,
 *                    category_color, duration, duration_raw, detail_url,
 *                    views, created_at, in_collection(bool), comment_count(int)
 *
 * Favorite / note / share buttons are wired up by the listing page scripts via
 * the onclick handlers and data-* attributes rendered here.
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function listing_card(array $card): string
{
    $title         = $card['title'] ?? '';
    $titleLower    = strtolower($title);
    $category      = $card['category'] ?? '';
    $categoryLower = strtolower($category);
    $duration      = $card['duration'] ?? '';
    $durationRaw   = (int) ($card['duration_raw'] ?? 0);
    $detailUrl     = $card['detail_url'] ?? '';
    $categoryIcon  = $card['category_icon'] ?? '';
    $categoryColor = $card['category_color'] ?? '';
    $views         = (int) ($card['views'] ?? 0);
    $createdAt     = $card['created_at'] ?? '';
    $inCollection  = !empty($card['in_collection']) ? '1' : '0';
    $itemId        = $card['id'] ?? '';
    $itemType      = $card['type'] ?? '';
    $categoryDisp  = ucfirst($category);
    $commentCount  = (int) ($card['comment_count'] ?? 0);

    // JS-safe title for inline onclick handlers.
    $titleJs = e(addslashes($title));

    $cardAttrs = attrs([
        'href'              => $detailUrl,
        'class'             => 'listing-card card-wrapper',
        'data-title'        => $titleLower,
        'data-category'     => $categoryLower,
        'data-duration'     => $duration,
        'data-duration-raw' => (string) $durationRaw,
        'data-views'        => (string) $views,
        'data-created'      => $createdAt,
        'data-in-collection' => $inCollection,
        'data-id'           => (string) $itemId,
        'data-type'         => $itemType,
    ]);

    $html = '<a ' . $cardAttrs . '>'
        . '<div class="listing-card-header">'
        . '<div class="listing-card-icon" style="background: ' . e($categoryColor) . '1A; color: '
        . e($categoryColor) . ';">'
        . icon($categoryIcon, 'icon')
        . '</div>'
        . '<div>'
        . '<h3 class="listing-card-title">' . e($title) . '</h3>'
        . '<div class="listing-card-meta">'
        . '<span class="ws-duration"><span class="material-symbols-outlined">schedule</span>' . e((string) $duration) . '</span>';

    if ($commentCount > 0) {
        $plural = $commentCount !== 1 ? 's' : '';
        $html .= '<span class="listing-card-comments" title="' . $commentCount . ' comment' . $plural . '">'
            . icon('chat_bubble', 'icon')
            . '<span>' . $commentCount . '</span>'
            . '</span>';
    }

    $html .= '</div></div></div>'
        . '<div class="listing-card-footer">'
        . '<span class="ws-category" style="--category-color: ' . e($categoryColor) . ';">'
        . e($categoryDisp) . '</span>'
        . '<div class="listing-card-actions">'
        . '<button class="listing-card-action note-btn" title="My notes" aria-label="My notes" '
        . 'onclick="event.preventDefault(); openCardNote(\'' . e((string) $itemId) . '\', \'' . e($itemType) . '\', \'' . $titleJs . '\');">'
        . icon('note_add', 'icon')
        . '</button>'
        . '<button class="listing-card-action favorite-btn" title="Add to favorites" aria-label="Add to favorites" '
        . 'onclick="event.preventDefault(); toggleFavorite(event, \'' . e((string) $itemId) . '\', \'' . e($itemType) . '\');">'
        . icon('favorite_border', 'icon')
        . '</button>'
        . '<button class="listing-card-action" title="Share" '
        . 'onclick="event.preventDefault(); shareItem(\'' . $titleJs . '\', \'' . e($detailUrl) . '\');">'
        . icon('share', 'icon')
        . '</button>'
        . '</div></div></a>';

    return $html;
}
