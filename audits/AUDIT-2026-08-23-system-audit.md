# Design system audit: `design-system/` and the `app/` platform

**Date:** 23 August 2026
**Scope:** `design-system/`, `includes/components/`, `app/`
**Dimensions:** inventory, naming, completeness, accessibility (WCAG 2.2 AA), token coverage, theming

---

## Executive summary

The system is in better shape than its reputation. The registry mirrors cleanly, token coverage is 92.7%, theming is deliberately single-theme and the docs say so, and reduced motion is handled by a universal gate rather than per-component guesswork.

Accessibility is where the real defects were, and they were of one kind: **the design system described a focus ring that large parts of the site never applied.** `platform-tokens.css` defines `--focus-ring` and documents at length why it is sky blue, but nothing applied it globally. The only site-wide `:focus-visible` rule lives in `css/styles.css`, which reaches a page only through `includes/header.php`. Every page that hand-rolls its own `<head>` had no visible keyboard focus outside forced-colors mode: the homepage, everything under `tips/`, and every page of this design system.

Four defects were fixed. Two findings need a decision from you and were left alone.

### Issue counts by severity

| Severity | Count | Fixed | Theme |
| --- | ---: | ---: | --- |
| P0 | 3 | 3 | Missing focus indicator, two invalid focus declarations, two undersized targets |
| P1 | 2 | 1 | Tips bundle missing tokens; primary-button contrast |
| P2 | 4 | 0 | Missing demos, prefix leaks, bare hex, one page with no external CSS |

### Dimensions that passed

- **Inventory / registry.** 64 `ws_*` helpers, 64 components in `workshopr-design-system.json`. The four extra JSON keys are metadata (`_comment`, `_css`, `_helpers`, `_templates`), not phantom components. `check-drift.php` confirms the mirror.
- **Token coverage.** `components.css` carries 1,661 `var()` references against 619 hex literals, 574 of them `var()` fallbacks. 92.7% tokenised.
- **Theming.** No dark mode and no `[data-theme]` support, which is correct: `design-system/theming.md:14` states plainly that none exists or is planned. Docs match code.
- **Reduced motion.** `platform-tokens.css` gates every animation through `*, *::before, *::after` plus eleven `!important` token overrides. The seven per-component guards in `components.css` are belt-and-braces, not the mechanism. The 104 animated rules are covered.
- **Contrast, text tokens.** Every ink level passes AA on both surfaces: `--color-ink` 14.67:1, `--color-ink-secondary` 7.34:1, `--color-ink-muted` 4.59:1. The focus ring is 3.92:1 on `--bg-page`, above the 3:1 that SC 1.4.11 asks of a non-text indicator, and the token's own comment already records that figure correctly.

---

## Fixed

### P0-1 · No baseline focus indicator on pages that hand-roll `<head>` (WCAG 2.2 SC 2.4.7, AA)

`css/styles.css:492` holds the site's global `*:focus-visible`, and it is reached only via `includes/header.php`. `platform-tokens.css` had a `*:focus-visible` rule, but inside `@media (forced-colors: active)`, so it applied only in high-contrast mode.

Pages confirmed to have had no visible keyboard focus: `index.php`, all of `design-system/`, all of `tips/`, `library/index.php`, `academy/index.php`.

**Fixed** by adding a zero-specificity baseline to `platform-tokens.css`, the one sheet every page loads:

```css
:where(a, button, input, select, textarea, summary, [tabindex], [contenteditable="true"]):focus-visible {
  outline: var(--focus-ring);
  outline-offset: var(--focus-ring-offset);
}
```

`:where()` keeps specificity at zero, so it is a floor that never fights a component's own rule or `styles.css`'s. It sits in the design system rather than in `styles.css` because the ring is a design-system decision, and because `platform-tokens.css` is imported at the top of every bundle's cascade, so anything more specific still wins.

### P0-2 · Two components declared a focus ring that could not draw

`--focus-ring` is a shorthand (`2px solid <colour>`), not a colour. Two rules used it in a longhand slot:

```css
outline: 2px solid var(--focus-ring, #38BDF8);   /* -> 2px solid 2px solid #0284C7 */
```

That expands to an invalid value, so `.ws-app-bar__switch-option` and `.ws-choice-card` drew **no focus ring at all**. Both now read `outline: var(--focus-ring, …)`, matching the eleven correct usages elsewhere in the file.

### P0-3 · Two pointer targets below 24x24 (WCAG 2.2 SC 2.5.8, AA)

Most small dimensions in `components.css` are inner glyphs inside a larger hit area and are fine. Two were the target itself:

- `.ws-chip__remove`: 18x18 with `padding: 0`. Fixed with a `::after { inset: -3px }` hit-area expansion, so the target reaches 24x24 with no layout shift and the chip keeps its height.
- `.ws-planner-activity-inspector__close`: 22x22, raised to 24x24.

`--target-min: 24px` already existed in the token file, annotated with the SC number. Nothing was using it.

### P1-1 · `tips/` never loaded the platform tokens

`css/tips/styles.css` declared its own palette and imported nothing, unlike `css/dna/styles.css` and `css/academy/*.css` which both import `platform-tokens.css`. Combined with P0-1 that left `/tips/` with no focus indicator. Added the import, matching the other app bundles.

---

## Needs your decision

### P1-2 · White on the primary button is 3.82:1 (WCAG SC 1.4.3, AA)

`.ws-btn--primary` paints `--button-text-primary` (white) on `--button-bg-primary`, which is `--mainsite-gradient`, running `#E54D4D` to `#C73E3E`. Contrast is measured at the worst point:

| Gradient stop | White on it | AA normal text |
| --- | ---: | --- |
| `#E54D4D` (light end) | 3.82:1 | fails |
| `#C73E3E` (dark end) | 5.02:1 | passes |

Button text is `--text-small`, 0.875rem, which at `html { font-size: 80% }` computes to 11.2px. That is normal text, so the bar is 4.5:1, not the 3:1 large-text allowance.

Darkening the light stop to roughly `#D13A3A` reaches 4.80:1. That is a visible change to the brand's primary button across the whole platform, so I have not made it. The alternatives are raising the button's text size or weight into the large-text band, or accepting the finding.

### P2-1 · Three components have no demo page

`ws_audio_recorder`, `ws_audio_player` and `ws_sidenav` are registered in the JSON and styled in `components.css` but have no page under `design-system/components/demos/`. 51 demos for 64 components; the other ten gaps are covered by demos that exercise several helpers at once.

---

## Reported, not fixed

**P2-2 · Seven non-prefixed classes in `components.css`.** `action-buttons-standalone`, `listing-card-footer`, `listing-card-meta`, `page-header`, `pv-toggle`, `pv-toggle__opt`, `pv-toggle__opt--on`. Everything else in the file is `ws-*`. Renaming touches markup, so it is not a mechanical fix.

**P2-3 · 45 bare hex literals in `components.css`**, 28 distinct. Most have exact tokens already: `#E54D4D` is `--phase-learn`, `#C73E3E` is `--phase-learn-dark`, `#FEE2E2` is `--phase-learn-very-light`, `#0284C7` is `--focus-ring-color`, `#FFFFFF` is `--text-inverse` or `--bg-surface` depending on the property. That last ambiguity is why this should not be scripted.

**P2-4 · `academy/training/index.php` loads no external stylesheet at all**, only a 959-line inline `<style>`. It is the one page still without a focus indicator after this pass, because there is no sheet for the tokens to arrive through. Same defect class as the `app/` and homepage work of 22 August.

**Carried forward from the 22 August audit**, still open: five component templates hold 581 lines of inline CSS that belongs in `components.css` (`footer.php` 269, `header.php` 159, `section-hero.php` 109, `dna-cta.php` 39, `app-footer.php` 5); `ws_workshop_list()` is a `ws_*` component living in `app/` and absent from both JSON manifests; and `ws_lifecycle()` remains registered with zero callers while `.wl-journey` does the work.

---

---

## Resolution log (23 August 2026, later the same day)

The open items above were worked through. Four of this report's own claims did not survive checking, and are corrected here.

### Closed

- **P1-2, button contrast.** Decision taken: darken the gradient's light stop to `#D13A3A` (4.80:1). Applied to `--mainsite-gradient`. **This report understated the defect**: `--planner-gradient` was a byte-identical copy with white text on it in two places (the planner topbar and `.recommend-item__select:hover`), and `css/planner/base/_variables.css` rebuilt the gradient from `--mainsite-primary` rather than sharing it, so the planner would have kept the failing stop after the button was fixed. Both now alias the one corrected gradient.
- **P2-1, missing demos.** Created for `ws_audio_recorder`, `ws_audio_player` and `ws_sidenav`, and added to the microsite sidebar, which the report did not mention and without which they are direct-URL only.
- **P2-4, `academy/training/index.php`.** Token sheet added, after confirming the page uses zero `rem` values so the sheet's `html { font-size: 80% }` cannot rescale it. Two further defects would have defeated the fix on their own and were also corrected: `outline: none` on the newsletter email field, which erases focus in forced-colors mode too, and an emerald `rgba(16, 185, 129, .15)` focus halo left over from the retired "Training (Green/Growth)" palette.
- **Inline CSS extraction (carried forward).** Only `dna-cta.php` (39 lines) was extractable. See the correction below.

### Corrections to this report

1. **P2-3 overstates the opportunity.** It says 45 literals, 28 distinct, and that "most have exact tokens already". Measured against `platform-tokens.css`: **40 literals, 26 distinct, and only 4 are unambiguous.** 19 map to several tokens at once (the `#FFFFFF` ambiguity it flags affects seven hexes, not one) and 17 have no token at all. Six `#FFFFFF` were tokenised anyway, because the property settles what the abstract hex cannot: five are text on a filled pill, one is a toggle knob surface.
2. **P2-2 is three different problems, not one.** `.action-buttons-standalone` and the three `.pv-toggle*` classes had zero markup and were deleted. `.page-header` must not be renamed: it appears in 169 places across 156 files **and is defined in six separate stylesheets**, so it is a shared platform class, not a prefix leak. `.listing-card-footer` and `.listing-card-meta` must not be renamed in isolation either: they belong to a 14-class `listing-card` family spanning six stylesheets that is entirely unprefixed, so renaming two members leaves a half-prefixed component. The real finding underneath both is that several stylesheets own the same class names.
3. **The 581-line inline-CSS item is mostly not a defect.** Four of the five templates are inline *for a reason*, confirmed by fetching the rendered pages rather than by static analysis: `/academy/`, `/sidekick/`, `/podcasts/` and `/intervention/` render `header.php` and `footer.php` while loading **no** `components.css` at all. `app-footer.php` reaches every path in `WS_APP_PATHS` and its own docblock already explains why. Only 39 of the 591 lines belonged in `components.css`. The remaining 552 cannot move until those pages load the shared stylesheet.
4. **`academy/training/index.php` was not "the one page still without a focus indicator".** 28 user-facing pages still have none. Ten are the reader-facing `academy/learn/` book pages, where **this fix does not transfer**: each carries 51 to 73 `rem` values with no root pin, so adding the token sheet would shrink every one by 20%. Those need the sheet paired with an explicit `html { font-size: 100% }`.

### Still open, needing a decision

- **`ws_workshop_list` cannot simply be added to the JSON.** Check 1b in `check-drift.php` requires every top-level JSON key to resolve to a function in `helpers.php`; adding it would make it an orphan and fail a check that currently passes. It is the entry point to a 904-line, 17-function app module that includes DB fetching and kanban/timeline view logic. Either promote the module properly, or rename it to drop the `ws_` prefix and accept it is app-local. It is not a manifest edit.
- **`ws_lifecycle` zero callers: confirmed correct.** The 22 apparent hits are changelog entries, tests and its own docblock. No production caller. Left alone, since the component documents this as deliberate.
- The 17 untokenised literals and 19 ambiguous ones in `components.css`, which need token decisions rather than mechanical substitution.

### Verification of this pass

`check-drift.php` PASS, `check-page.php --all` PASS (exit 0), `php -l` clean on every edited PHP file, `components.css` braces balanced at 1237/1237. Contrast recomputed independently: `#D13A3A` 4.80:1, `#C73E3E` 5.02:1. The tokenised `ws_dna_cta` block was rendered in headless Chromium and every value confirmed byte-identical to the literal it replaced.

---

## Verification

`check-drift.php` passes with the JSON mirror in sync. `check-page.php --all` passes. Brace balance confirmed on all three edited stylesheets. Focus coverage re-tested across twelve representative pages by resolving each page's stylesheet set, following `@import` chains, and excluding `forced-colors` blocks: eleven now resolve a focus ring, against six before.

Not verified in a browser: no dev server was available in this session.
