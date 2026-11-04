# ws_header (redesign)

**Source of truth:** Figma `workshopr.io`, frame `global-header`, node `2336:3284` (1440 x 64).
**Status:** specification. Not yet implemented.
**Supersedes:** the current render in `includes/components/header.php` (which itself retired `includes/global-header.php`).

The redesign is mostly a subtraction. The brand and the right-hand controls survive; the section tag, the section nav, and the app-switcher panel do not.

---

## When to use

Once per document, as the first element in `<body>`, on every page of the platform. There is no variant of a Workshopr page that omits it.

Do not use it inside the Planner canvas, kiosk, or embedded modes, which run their own chrome via `planner/includes/header.php`.

## Example

```php
<?= ws_header('strategist', ['avatar' => $avatar_val]) ?>
```

The signature is unchanged so existing call sites keep working. What `$section` *does* changes: see Props.

## Anatomy

Geometry is taken directly from the frame. All values are CSS pixels at 1440 wide.

| # | Part | Class | Box | Position |
|---|------|-------|-----|----------|
| 1 | Bar | `.wsh-header` | 1440 x 64 | fixed to viewport top |
| 2 | Brand link | `.wsh-header__brand` | auto x 36 | left 24, top 14 |
| 3 | Mark chip | `.wsh-header__mark` | 36 x 36, radius 9 | left 24, top 14 |
| 4 | Mark glyph | `icon('graph_3')` | 24 x 24 | inset 7 inside the chip |
| 5 | Wordmark | `.wsh-header__word` | 118 x 27 | left 69, top 18 |
| 6 | Brand dot | `.wsh-header__dot` | inline | offset 97 within the wordmark, top +2 |
| 7 | Search | `.wsh-header__icon-btn` | 20 x 20 glyph | left 1300, top 22 |
| 8 | Library | `.wsh-header__icon-btn` | 20 x 20 glyph | left 1342, top 22 |
| 9 | Avatar | `.wsh-header__avatar` | 36 x 36, radius 18 | left 1380, top 14 |
| 10 | Rule | `.wsh-header` bottom border | 1440 x 1 | top 64 |

Derived spacing, which is what the implementation should encode rather than the absolute offsets:

- **Outer gutters are symmetric at 24px.** Left edge of the mark is 24; right edge of the avatar is 1416, so 1440 - 1416 = 24.
- **Mark to wordmark: 9px** (24 + 36 = 60, wordmark starts at 69).
- **Search to library: 22px** between glyph boxes (1300 + 20 = 1320, next starts at 1342).
- **Library to avatar: 18px** (1342 + 20 = 1362, avatar starts at 1380).
- The 20px glyphs are optically centred against the 36px avatar: glyph top 22 + 10 = 32, avatar top 14 + 18 = 32. Both sit on the 32px centreline of a 64px bar.

### What the redesign removes

Three things present in today's header are absent from the frame. Each has a consequence worth deciding deliberately rather than by omission:

| Removed | Current class | Consequence |
|---------|---------------|-------------|
| Section tag pill | `.wsh-header__tag` | The header no longer names which app you are in. |
| Section nav | `.wsh-header__nav` | The 17-entry registry, the `activeHref` matching logic, and `aria-current="page"` all become dead code. |
| App switcher | `.wsh-header__switcher`, `.wsh-header__panel` | The only cross-app jump in the chrome disappears. |

**Open question for the designer.** With the nav and the switcher both gone, `library_books` is the only remaining candidate for cross-app navigation, but the frame does not show what it opens. Until that is decided this spec cannot say whether the switcher panel is deleted or simply re-parented under a new trigger. Everything else here is implementable now.

## Variants

The frame defines one variant. The redesign is deliberately variant-free: same bar on every page, differing only by state.

`$opts['bg']` remains as a per-page background override. It exists today for surfaces that need to blend with a coloured hero and is retained for that reason alone, not as a designed variant.

## Props / params

`ws_header(?string $section = null, array $opts = []): string`

| Param | Status | Behaviour |
|-------|--------|-----------|
| `$section` | **narrowed** | Still emits `data-section` for page-level CSS hooks and analytics. No longer selects the mark glyph or a nav set. |
| `$opts['avatar']` | unchanged | Image URL, or a single character for the initial fallback. |
| `$opts['bg']` | unchanged | Background override. Defaults to `var(--header-bg, #F0EBE3)`. |
| `$opts['nav']` | **deprecated** | No nav to populate. Keep accepting and ignoring it for one release so the 17 registries can be removed separately from the render change. |
| `$opts['activeHref']` | **deprecated** | Same reasoning. Nothing to highlight. |

**Behaviour change worth calling out.** Today the mark renders the *section's* icon via `_wsh_icon($cfg['icon'])`, so it changes per app. In the frame the mark is `graph_3`, the brand glyph. The mark becomes constant. That is the single largest semantic change in the redesign: the header stops being an indicator of place and becomes purely a brand plus a control cluster.

## States

The frame shows one state (signed in). The rest are specified here and need design confirmation.

| State | Specification |
|-------|---------------|
| **Signed in** | As drawn. Avatar shows the profile image, or the first initial on `--mainsite-light` when there is none. |
| **Signed out** | **Not in the frame.** Reuse the existing `.wsh-header__signin` control in the avatar's slot, right-aligned to the same 24px gutter. Needs a decision on whether search and library remain visible when signed out. |
| **Icon hover** | Glyph moves from `--color-ink-muted` to `--color-ink`. |
| **Icon focus** | Platform sky-blue focus ring, `var(--focus-ring)` at `var(--focus-ring-offset)`. The one sanctioned non-red accent. |
| **Avatar menu open** | `aria-expanded="true"`, menu anchored to the avatar's right edge. |
| **Scrolled** | Not in the frame. The 1px bottom rule already separates the bar from the page, so no elevation change is specified. |

## Accessibility

Contrast measured against the `#F0EBE3` bar:

| Element | Ratio | Verdict |
|---------|-------|---------|
| Wordmark `--color-ink` | 12.91:1 | Passes comfortably. |
| Icon glyphs `--color-ink-muted` | 4.04:1 | Passes the 3:1 required of icons and UI components. |
| Brand dot `--mainsite-dark` | 4.23:1 | Below 4.5:1, but exempt: WCAG 1.4.3 excludes text that is part of a logotype. No change needed. |
| Mark chip and avatar fill `--mainsite-light` | 1.03:1 | See below. |

**Two findings to resolve before build:**

1. **The avatar is a control that is nearly invisible.** `#FEE2E2` on `#F0EBE3` is 1.03:1, so the only thing separating the account button from the bar is its `0 2px 8px rgba(0,0,0,0.06)` shadow. UI components need 3:1 against the adjacent colour under WCAG 1.4.11. This passes only while the avatar carries a photo. For the initial-fallback case it needs a darker fill or a visible border.
2. **Removing the nav removes the only "you are here" signal.** `aria-current="page"` disappears with it. If section navigation moves into the library menu, that menu has to carry the current-page semantics the nav used to.

Requirements that carry over unchanged:

- `<header>` landmark with `aria-label="Site header"`.
- All three controls are icon-only and require accessible names: "Search", "Library", "Account". The glyph name is not a label.
- Search is `aria-haspopup="dialog"`; the avatar is `aria-haspopup="true"` with `aria-expanded` maintained.
- Full keyboard path: brand, search, library, avatar, in DOM order. Menus close on Escape and restore focus to their trigger.
- The bar is 64px tall and its controls are 36px and 20px. The 20px glyphs need a 44px minimum hit area via padding on `.wsh-header__icon-btn`, which the visual box does not itself provide.

## Content guidelines

The wordmark is always "Workshopr.io" with the period in `--mainsite-dark`. It is set as three nodes (word, dot, word) rather than one string so the dot can take its own colour and weight: Fraunces Black Italic for the word, Fraunces SemiBold for the dot. Never substitute a styled span for the period in a way that changes its weight.

Icon-only controls take a tooltip only if the same text is already their accessible name.

## Tokens used

Every colour in the frame resolves to an existing platform token. Nothing new is required.

| Figma value | Token | Applied to |
|-------------|-------|-----------|
| `#F0EBE3` | `--header-bg` | Bar background |
| `#FEE2E2` | `--mainsite-light` | Mark chip, avatar fill and border |
| `#2C2416` | `--color-ink` | Wordmark, icon hover |
| `#C73E3E` | `--mainsite-dark` | Brand dot |
| `#78716C` | `--color-ink-muted` | Icon glyphs at rest |
| radius 9 | `--radius-lg` (8px) | Mark chip. **1px off**; use the token and accept 8, or add a token. |
| radius 18 | half of 36 | Avatar. Circular, so `--radius-full`. |
| shadow `0 2px 8px rgba(0,0,0,0.06)` | **no matching token** | Avatar. `--shadow-sm` is `0 1px 3px rgba(0,0,0,0.06)`, a different blur and offset. Either accept `--shadow-sm` or add a token; do not hardcode the frame value. |
| 18px / 27px, tracking -0.2px | Fraunces Black Italic | Wordmark |
| 20px | `--icon-md` | Glyph size (confirmed present) |

### Asset fidelity

No remote asset needs downloading. Every icon in the frame resolves to a glyph the project already ships:

- **`graph_3`** is already the brand glyph: it is the `home` registry icon in `header.php`, and is used by `section-hero.php` and `planner/landing.php`. Render via `icon('graph_3')`. Outer chip 36 x 36, inner leaf 24 x 24 at a 7px inset. Both dimensions explicit; do not let the leaf fill the chip.
- **`search`** is a Material Symbols ligature in the frame itself, and is already the current header's search glyph. 20 x 20.
- **`library_books`** is a Material Symbols glyph in the same family. It replaces today's `settings` glyph, which currently links to `/myworkshopr/`. 20 x 20.

## Related components

- `ws_footer` (the other half of the global chrome)
- `ws_avatar` (should back `.wsh-header__avatar` rather than the header hand-rolling it)
- The Planner's own header, `planner/includes/header.php`, which is out of scope and unaffected

## Changelog

- **2026-08-04** Specified from Figma `global-header` `2336:3284`. Not yet implemented.

---

## Implementation notes

Two things to fix in the same change, both pre-existing:

1. **`design-system/workshopr-design-system.json` is stale.** `rules.globalHeader` still points at `/includes/global-header.php`, a file that no longer exists. It must point at `ws_header()` in `includes/components/header.php`.
2. **Dead code after the nav is removed.** The 17-entry section registry, `$navKey`, the `activeHref` resolution, and `_wsh_panel_html()` all become unreachable. Removing the render without removing the registry leaves roughly 200 lines of nav-matching logic that nothing calls. Stage it: change the render first with `nav`/`activeHref` accepted-and-ignored, then delete the registry once no caller passes them.
