import React from 'react';
import { Icon } from './Icon';

export interface WsListingCardData {
  id: number | string;
  type: string;
  title: string;
  category: string;
  categoryIcon: string;
  categoryColor: string;
  /** Pre-formatted duration label, e.g. "30 min". */
  duration: string;
  durationRaw?: number;
  detailUrl: string;
  views?: number;
  createdAt?: string;
  inCollection?: boolean;
  commentCount?: number;
}

export interface WsListingCardProps {
  card: WsListingCardData;
  /** Optional handlers; when omitted, the buttons are inert no-ops. */
  onNote?: (id: number | string, type: string, title: string) => void;
  onFavorite?: (e: React.MouseEvent, id: number | string, type: string) => void;
  onShare?: (title: string, detailUrl: string) => void;
}

/** Mirror of ws_listing_card() — renders the `listing-card` markup for listing pages, with no sketch or description. */
export function WsListingCard({
  card,
  onNote,
  onFavorite,
  onShare,
}: WsListingCardProps): React.ReactElement {
  const {
    id,
    type,
    title,
    category,
    categoryIcon,
    categoryColor,
    duration,
    durationRaw = 0,
    detailUrl,
    views = 0,
    createdAt = '',
    inCollection = false,
    commentCount = 0,
  } = card;

  const categoryDisplay = category ? category.charAt(0).toUpperCase() + category.slice(1) : '';

  return (
    <a
      href={detailUrl}
      className="listing-card card-wrapper"
      data-title={title.toLowerCase()}
      data-category={category.toLowerCase()}
      data-duration={duration}
      data-duration-raw={durationRaw}
      data-views={views}
      data-created={createdAt}
      data-in-collection={inCollection ? '1' : '0'}
      data-id={id}
      data-type={type}
    >
      <div className="listing-card-header">
        <div
          className="listing-card-icon"
          style={{ background: `${categoryColor}1A`, color: categoryColor }}
        >
          <Icon name={categoryIcon} className="icon" />
        </div>
        <div>
          <h3 className="listing-card-title">{title}</h3>
          <div className="listing-card-meta">
            <span className="ws-duration">
              <span className="material-symbols-outlined">schedule</span>
              {duration}
            </span>
            {commentCount > 0 && (
              <span
                className="listing-card-comments"
                title={`${commentCount} comment${commentCount !== 1 ? 's' : ''}`}
              >
                <Icon name="chat_bubble" className="icon" />
                <span>{commentCount}</span>
              </span>
            )}
          </div>
        </div>
      </div>
      <div className="listing-card-footer">
        <span className="ws-category" style={{ '--category-color': categoryColor } as React.CSSProperties}>
          {categoryDisplay}
        </span>
        <div className="listing-card-actions">
          <button
            className="listing-card-action note-btn"
            title="My notes"
            aria-label="My notes"
            onClick={(e) => {
              e.preventDefault();
              onNote?.(id, type, title);
            }}
          >
            <Icon name="note_add" className="icon" />
          </button>
          <button
            className="listing-card-action favorite-btn"
            title="Add to favorites"
            aria-label="Add to favorites"
            onClick={(e) => {
              e.preventDefault();
              onFavorite?.(e, id, type);
            }}
          >
            <Icon name="favorite_border" className="icon" />
          </button>
          <button
            className="listing-card-action"
            title="Share"
            onClick={(e) => {
              e.preventDefault();
              onShare?.(title, detailUrl);
            }}
          >
            <Icon name="share" className="icon" />
          </button>
        </div>
      </div>
    </a>
  );
}
