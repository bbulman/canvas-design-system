import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';
import { WsPlannerCard, WsPlannerCardProps } from './PlannerCard';

export interface WsPlannerRailSearch {
  placeholder?: string;
  kbd?: string;
  name?: string;
  value?: string;
}

export interface WsPlannerRailCategoryItem {
  label: string;
  color?: string;
  count?: string | number;
  active?: boolean;
  href?: string;
  id?: string;
}

export interface WsPlannerRailCategories {
  title?: string;
  count?: string | number;
  items: WsPlannerRailCategoryItem[];
}

export interface WsPlannerRailFilterOption {
  value?: string;
  label?: string;
  selected?: boolean;
}

export interface WsPlannerRailFilter {
  name?: string;
  options: WsPlannerRailFilterOption[];
}

export interface WsPlannerRailCategoryButton {
  id?: string | number;
  name: string;
  icon?: string;
  count?: string | number;
  type?: string;
}

export interface WsPlannerRailInstruction {
  icon?: string;
  body: string;
}

/** Flat-item sections take planner-card option bags (plus the title). */
export type WsPlannerRailItem = { title: string } & Omit<WsPlannerCardProps, 'title'>;

export interface WsPlannerRailSection {
  title?: string;
  meta?: string;
  icon?: string;
  kind?: 'items' | 'instructions';
  collapsible?: boolean;
  defaultOpen?: boolean;
  filter?: WsPlannerRailFilter;
  categoryButtons?: WsPlannerRailCategoryButton[];
  items?: WsPlannerRailItem[] | WsPlannerRailInstruction[];
  /** instructions: visible count before "Show more". */
  showMore?: number;
  id?: string;
}

export interface WsPlannerRailFooterButton {
  text?: string;
  icon?: string;
  id?: string;
  action?: string;
  href?: string;
}

export interface WsPlannerRailFooter {
  label?: string;
  button: WsPlannerRailFooterButton;
}

export interface WsPlannerLibraryRailProps {
  search?: WsPlannerRailSearch;
  categories?: WsPlannerRailCategories;
  sections?: WsPlannerRailSection[];
  footer?: WsPlannerRailFooter;
  id?: string;
  className?: string;
}

/** Mirror of ws_planner_library_rail() — renders the `ws-planner-rail` markup. */
export function WsPlannerLibraryRail({
  search,
  categories,
  sections = [],
  footer,
  id,
  className,
}: WsPlannerLibraryRailProps): React.ReactElement {
  return (
    <aside id={id} className={cx('ws-planner-rail', className)}>
      {search && (
        <div className="ws-planner-rail__search" role="search">
          <svg
            className="ws-planner-rail__search-icon"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            strokeWidth="1.8"
            aria-hidden="true"
          >
            <circle cx="11" cy="11" r="7" />
            <path d="M21 21l-4.4-4.4" />
          </svg>
          <input
            type="search"
            name={search.name ?? 'q'}
            defaultValue={search.value ?? ''}
            placeholder={search.placeholder ?? 'Search…'}
            aria-label={search.placeholder ?? 'Search…'}
          />
          {search.kbd && (
            <span className="ws-planner-rail__search-kbd" aria-hidden="true">
              {search.kbd}
            </span>
          )}
        </div>
      )}

      {categories && categories.items.length > 0 && (
        <>
          <div className="ws-planner-rail__h">
            <span>{categories.title ?? 'Library'}</span>
            {categories.count != null && categories.count !== '' && <span>{categories.count}</span>}
          </div>
          <nav className="ws-planner-rail__categories" aria-label={categories.title ?? 'Library'}>
            {categories.items.map((cat, i) => {
              const Tag = (cat.href ? 'a' : 'button') as 'a' | 'button';
              const tagProps = cat.href
                ? { href: cat.href }
                : ({ type: 'button' } as { type: 'button' });
              return (
                <Tag
                  key={cat.id ?? i}
                  id={cat.id}
                  className={cx('ws-planner-rail__cat', cat.active && 'is-active')}
                  aria-current={cat.active ? 'page' : undefined}
                  {...tagProps}
                >
                  <span
                    className="ws-planner-rail__cat-dot"
                    style={{ background: cat.color ?? '#888888' }}
                    aria-hidden="true"
                  />
                  <span className="ws-planner-rail__cat-label">{cat.label}</span>
                  {cat.count != null && <span className="ws-planner-rail__cat-count">{cat.count}</span>}
                </Tag>
              );
            })}
          </nav>
        </>
      )}

      {sections.map((sec, sIdx) => {
        const title = sec.title ?? '';
        const meta = sec.meta ?? '';
        const kind = sec.kind ?? 'items';
        const collapsible = !!sec.collapsible;
        const open = sec.defaultOpen === undefined || !!sec.defaultOpen;
        const items = sec.items ?? [];
        const catBtns = sec.categoryButtons;
        const filter = sec.filter;
        const showMore = sec.showMore;
        const secId = sec.id ?? `wpr-sec-${sIdx}`;

        if (title === '' && items.length === 0 && !(catBtns && catBtns.length)) return null;

        const visibleCount = showMore ?? items.length;

        return (
          <section
            key={secId}
            className={cx(
              'ws-planner-rail__section',
              collapsible && 'is-collapsible',
              collapsible && !open && 'is-collapsed',
              kind === 'instructions' && 'is-instructions',
            )}
            data-section-id={secId}
          >
            {(title !== '' || meta !== '') &&
              (collapsible ? (
                <button
                  type="button"
                  className="ws-planner-rail__h ws-planner-rail__h--toggle"
                  aria-expanded={open}
                  aria-controls={`${secId}-body`}
                  data-rail-toggle={secId}
                >
                  <span className="ws-planner-rail__h-left">
                    {sec.icon && (
                      <span className="ws-planner-rail__h-icon" aria-hidden="true">
                        <Icon name={sec.icon} />
                      </span>
                    )}
                    <span>{title}</span>
                  </span>
                  <span className="ws-planner-rail__h-right">
                    {meta !== '' && <span>{meta}</span>}
                    <span className="ws-planner-rail__h-chevron" aria-hidden="true">
                      <Icon name="expand_more" />
                    </span>
                  </span>
                </button>
              ) : (
                <div className="ws-planner-rail__h">
                  <span className="ws-planner-rail__h-left">
                    {sec.icon && (
                      <span className="ws-planner-rail__h-icon" aria-hidden="true">
                        <Icon name={sec.icon} />
                      </span>
                    )}
                    <span>{title}</span>
                  </span>
                  {meta !== '' && <span>{meta}</span>}
                </div>
              ))}

            <div className="ws-planner-rail__body" id={`${secId}-body`} hidden={collapsible && !open}>
              {filter && filter.options.length > 0 && (
                <div className="ws-planner-rail__filter">
                  <select name={filter.name ?? 'filter'} className="ws-planner-rail__select">
                    {filter.options.map((opt, i) => (
                      <option key={i} value={opt.value ?? ''} defaultChecked={opt.selected}>
                        {opt.label ?? ''}
                      </option>
                    ))}
                  </select>
                  <span className="ws-planner-rail__select-chevron" aria-hidden="true">
                    <Icon name="expand_more" />
                  </span>
                </div>
              )}

              {catBtns && catBtns.length > 0 && (
                <div className="ws-planner-rail__cat-grid" role="list">
                  {catBtns.map((btn, i) => (
                    <button
                      key={btn.id ?? i}
                      type="button"
                      className="ws-planner-rail__cat-btn"
                      role="listitem"
                      data-category-id={btn.id ?? ''}
                      data-category-name={btn.name}
                      data-type={btn.type}
                    >
                      {btn.icon && (
                        <span className="ws-planner-rail__cat-btn-icon" aria-hidden="true">
                          <Icon name={btn.icon} />
                        </span>
                      )}
                      <span className="ws-planner-rail__cat-btn-name">{btn.name}</span>
                      {btn.count != null && (
                        <span className="ws-planner-rail__cat-btn-count">{btn.count}</span>
                      )}
                    </button>
                  ))}
                </div>
              )}

              {kind === 'instructions' && items.length > 0 ? (
                <div className="ws-planner-rail__instructions">
                  {(items as WsPlannerRailInstruction[]).map((tip, i) => {
                    const hidden = showMore !== undefined && i >= visibleCount;
                    return (
                      <div
                        key={i}
                        className={cx('ws-planner-rail__tip', hidden && 'is-hidden-more')}
                        hidden={hidden}
                      >
                        <span className="ws-planner-rail__tip-icon" aria-hidden="true">
                          <Icon name={tip.icon ?? 'lightbulb'} />
                        </span>
                        <p className="ws-planner-rail__tip-body">{tip.body}</p>
                      </div>
                    );
                  })}
                  {showMore !== undefined && items.length > visibleCount && (
                    <button
                      type="button"
                      className="ws-planner-rail__show-more"
                      data-rail-show-more={secId}
                    >
                      <span className="ws-planner-rail__show-more-icon" aria-hidden="true">
                        <Icon name="expand_more" />
                      </span>
                      <span data-label-more="Show more" data-label-less="Show less">
                        Show more
                      </span>
                    </button>
                  )}
                </div>
              ) : (
                items.length > 0 && (
                  <div className="ws-planner-rail__items">
                    {(items as WsPlannerRailItem[]).map((item, i) => {
                      const { title: itemTitle, ...rest } = item;
                      return (
                        <WsPlannerCard
                          key={i}
                          title={itemTitle}
                          size="sm"
                          draggable
                          {...rest}
                        />
                      );
                    })}
                  </div>
                )
              )}
            </div>
          </section>
        );
      })}

      {footer && footer.button && (() => {
        const btn = footer.button;
        const Tag = (btn.href ? 'a' : 'button') as 'a' | 'button';
        const tagProps = btn.href ? { href: btn.href } : ({ type: 'button' } as { type: 'button' });
        return (
          <div className="ws-planner-rail__footer">
            {footer.label && <p className="ws-planner-rail__footer-label">{footer.label}</p>}
            <Tag
              id={btn.id}
              className="ws-planner-rail__footer-btn"
              data-action={btn.action}
              {...tagProps}
            >
              <span className="ws-planner-rail__footer-btn-icon" aria-hidden="true">
                <Icon name={btn.icon ?? 'add_circle'} />
              </span>
              <span>{btn.text ?? 'Create'}</span>
            </Tag>
          </div>
        );
      })()}
    </aside>
  );
}
