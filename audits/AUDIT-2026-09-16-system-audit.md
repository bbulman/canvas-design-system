# Design System Audit — September 2026

| | |
|---|---|
| **Status** | Findings, no changes applied |
| **Scope** | `design-system/`, `includes/components/`, `platform-tokens.css`, the `ws_*` library, and the five gates that guard them |
| **Method** | Direct file inspection and gate execution against the working tree on 16 September 2026 (`main`, 317 ahead of origin). Every count below came from a command run against this checkout, not from a prior audit. |
| **Predecessors** | `AUDIT-2026-08-23-system-audit.md`, `token-audit-2026-07.md`, `debt-register.md` (D1–D13), `COMPONENT-GAP-AUDIT-2026-07-01.md` |

---

## Executive summary

The design system's foundations are stronger than its instrumentation. The token layer has an accessibility floor most systems never build — a zero-specificity `:where()` focus ring, `prefers-reduced-motion`, `prefers-contrast` with documented ratio improvements, and a `forced-colors` block that restores focus rings the OS would otherwise discard. The Red Unification is fully propagated and `ds-lint` is clean across 130 files. The demo pages are substantive: all 57 carry a "When to use" section and 53 carry a real Accessibility section.

The problem is that the machinery reporting on all of this has quietly gone out of true.

**Four of the five gates fail on a clean tree right now.** `debt-register.md` opens with "The automated gates are green." That was accurate on 31 July. It is not accurate today, and because nothing runs the gates automatically — CI has never executed on these 317 unpushed commits, and `check-page.php` is wired nowhere despite its docblock claiming a PostToolUse hook — nobody was told.

The second systemic finding is that **the design system under-reports its own quality to the one consumer that matters most.** `START-HERE.md` routes Claude to `components.generated.json` for per-component usage. That file says 11 of 66 components have accessibility documentation. The truth is 53 of 57 demos have it; a regex in `generate-catalog.php:71` requires the Accessibility heading to be followed immediately by a `<p>`, and 42 components document theirs in a `<table>` instead. Real accessibility guidance, already written, is invisible to the AI that was told to rely on it.

The third is architectural: **the tier-3 semantic token layer is defined but not wired.** `theming.md` already admits this (principle 5, "currently defined but unwired — audit D3"); this audit quantifies it. `--divider-*`, `--link-*`, `--overlay-*`, `--backdrop-*` and `--target-*` are defined and referenced zero times in `components.css`. Components read tier-1 primitives directly — `--text-*` 380 times, `--space-*` 165, `--gray-*` 109. The theming contract that says "an app overrides `--button-bg-primary` in its scope, not the component CSS" does not currently hold, because the components do not read those tokens.

### Issue counts by severity

| Severity | Count | Definition |
|---|:--:|---|
| **Critical** | 4 | Blocks access, or the safety net itself is broken |
| **High** | 7 | Systemic; compounds with every new page or component |
| **Medium** | 7 | Real inconsistency, contained blast radius |
| **Low** | 3 | Hygiene |
| **Total** | **21** | |

One candidate finding was investigated and **dismissed**: 20 tokens are defined twice in `platform-tokens.css`, but every second definition sits inside `prefers-reduced-motion`, `prefers-contrast` or `forced-colors`. That is correct practice, not drift.

---

## Critical findings

### C-1 · Four of five gates fail on a clean tree

| Gate | Command | Result |
|---|---|---|
| Drift | `php design-system/check-drift.php` | **FAIL** (exit 1) — 2 issues |
| Catalog freshness | `php design-system/generate-catalog.php --check` | **FAIL** — signature drift |
| DTCG export | `php design-system/generate-tokens-dtcg.php --check` | **FAIL** — `tokens.dtcg.json` is stale |
| Page ratchet | `php design-system/check-page.php --all` | **FAIL** (exit 1) — 47 new violations |
| CSS lint | `node scripts/ds-lint.mjs` | **PASS** — clean, 130 files |

The specific failures:

1. **`check-drift`** — `workshopr-design-system.json` still lists `ws_lifecycle`, a component `ADOPTION.md` records as retired in v2.9.99. The curated JSON was never updated when the function was deleted. Second issue: `app/css/app-shell.css:1291` sets `.ws-planner-card--lg` padding with literals instead of card tokens.
2. **`generate-catalog --check`** — `ws_app_footer` gained an `array $options = []` parameter; the curated JSON still records `ws_app_footer(): string`.
3. **`generate-tokens-dtcg --check`** — `platform-tokens.css` has changed since `tokens.dtcg.json` was last generated. Every downstream consumer (Style Dictionary, Figma, Tokens Studio) is reading stale values.
4. **`check-page --all`** — 47 new violations above baseline, concentrated in `academy/learning-paths/bootcamp.php` (31 hardcoded hex, no baseline entry at all) and `academy/foundations/inc/chrome.php` (a new hand-rolled `<!DOCTYPE>` plus 2 uncachebusted assets).

**Why nobody knew.** `ds-lint.yml` runs three of these in CI, but the branch is 317 commits ahead of `origin/main` and deploys are manual FTP, so CI has had nothing to run against. The pre-commit hook only fires the drift and catalog checks when a design-system file is staged — and `academy/learning-paths/bootcamp.php` is not one. `check-page.php`'s own docblock says it is "wired to a PostToolUse hook so violations come back to the agent mid-turn"; `.claude/settings.json` registers exactly one hook, `guard-prod-db.mjs`. That sentence has been false for as long as the file has existed.

**Fix:** run the four gates, resolve each failure, then wire `check-page.php` into both CI (on changed `.php`) and `.claude/settings.json` as the PostToolUse hook it already claims to be.

### C-2 · Accessibility documentation is written but invisible to the machine layer

`components.generated.json` reports `a11y` coverage of **11 of 66**. Fifty-five components appear to have no accessibility guidance, including `ws_button`, `ws_input`, `ws_select`, `ws_form_row` and `ws_alert`.

That number is wrong. **53 of 57 demos carry a real Accessibility section.** The extractor at `generate-catalog.php:71` is:

```php
preg_match('/ds-section-title"\s*>\s*Accessibility\s*<\/h2>\s*<p[^>]*>(.*?)<\/p>/is', …)
```

It only captures prose in a `<p>` immediately after the heading. `components/demos/button.php:197` follows its heading with a `<table class="ds-table">` — a Concern/Behavior table, which is the *better* documentation format and is what most demos use. Every one of those is silently dropped.

The eleven that do parse are genuinely excellent (`ws_planner_library_rail`: "The best-wired component in the library — treat its markup as the reference"; `ws_tabs`: "the keyboard half of that pattern is missing"). This is high-quality work that the system throws away.

**Impact is specific and current.** `START-HERE.md` tells Claude: "For per-component **usage** (canonical `example`, `whenToUse`/`whenNotToUse`, `a11y`, `antiPattern`), read `components.generated.json`." Every AI-assisted UI change in this repo is being made against a file that reports near-total absence of accessibility guidance. That is the most consequential defect in this audit, because it silently degrades every future change.

**Fix:** extend the regex to capture the first `<p>` *or* `<table>` following the heading, then regenerate. Expected coverage after the fix: 53/57 demos, 55+/66 catalog entries. Add a fixture to `--self-test` covering both markup shapes so this cannot regress.

### C-3 · Global 20% text shrink undermines the entire contrast strategy

`platform-tokens.css:34` — `html { font-size: 80%; }`

The comment is candid about it: font sizes are rem, spacing is px, so the root scale shrinks all text and leaves layout intact, and four apps mirror the same 0.8 so it is uniform. Rendered sizes:

| Token | Declared | Actual | AA-large eligible? |
|---|---|---|---|
| `--text-body` | 1rem | **12.8px** | No |
| `--text-h3` | 1.25rem | 16px | Only if bold |
| `--text-h2` | 1.5rem | 24px | Yes |
| `--text-small` | 0.875rem | **11.2px** | No |
| `--text-caption` | 0.75rem | **9.6px** | No |

Browser zoom still works, so this is not a strict WCAG 1.4.4 failure. The damage is indirect and worse: **the AA-large exemption almost never applies on this platform.** Every "passes at 3:1 for large text" allowance in the contrast findings below is unusable, because body, small, caption, h3 and h4 all render below the 24px (or 18.66px bold) threshold. A 3.99:1 token that looks acceptable "for headings" is failing in practice everywhere it is actually used.

Body copy at 12.8px is also simply small for a product whose users are facilitators reading run-of-show material under time pressure.

**Fix:** this is a design decision, not a bug, so it needs a decision — a D-numbered entry alongside D1/D2 in `token-audit-2026-07.md`. The options are to raise the root toward 100% and rescale the type ramp to compensate, or to keep 80% and accept that every colour pair must clear 4.5:1 with no large-text relief. Do not leave it undecided, because the contrast work in C-4 depends on which way it goes.

### C-4 · Brand red fails AA as text (unresolved since July)

Measured this session by resolving tokens through their alias chains and computing WCAG relative luminance:

| Pair | Ratio | AA normal |
|---|:--:|---|
| `#E54D4D` (Learn Red) on `#FFFFFF` | **3.82** | FAIL |
| `#E54D4D` on `--bg-page` `#FEF7F1` | **3.60** | FAIL |
| `--phase-learn-dark` `#C73E3E` on `--bg-page` | 4.73 | pass |
| `--color-ink` `#2C2416` on `--bg-page` | 14.43 | pass |

This is `debt-register.md` D4, rated Critical on 31 July, still **Open**, with 38 CSS declarations setting `#E54D4D` as a `color`. The remedy already exists and is already mandated by DESIGN.md — `--phase-learn-dark` was created for exactly this. Combined with C-3, there is no size at which the raw brand red is safe for body text.

---

## High findings

### H-1 · `--gray-500` fails AA against every warm background

`--gray-500` `#78716C` is the platform's muted-text grey. It clears 4.5:1 on pure white but not on the warm surfaces the brand actually uses:

| Background | Ratio |
|---|:--:|
| `--gray-200` `#E7E5E4` | 3.82 |
| `--bg-paper-dark` `#F0EBE3` | 4.04 |
| `--bg-warm-muted` `#F5F3EF` | 4.33 |
| `--bg-muted` / `--gray-100` `#F5F5F4` | 4.40 |
| `--bg-cool` `#F5F7FA` | 4.47 |
| `--bg-paper` `#FAF7F2` | 4.49 |

Nine pairings land between 3.8 and 4.49 — near-misses, which is why they have never been noticed. The `prefers-contrast: more` block already remaps `--text-muted` to `--color-ink-secondary` (documented 4.80 → 7.66), so the fix pattern is established; it just needs to be the default rather than the opt-in.

*Note on method:* the raw scan flagged 29 failing pairs, but 16 were `--text-inverse` (white) against light backgrounds — a combination no correct code produces. The 13 real failures are the ones above plus the `--phase-learn-dark`/`--gray-200` pair at 3.99.

### H-2 · 28 of 66 component templates carry no ARIA or role attribute

Zero `aria-*` and zero `role=` in: `activity-badge`, `app-shelf`, `avatar`, `card`, `checkbox-card-group`, `checklist`, `cta-section`, `dna-cta`, `empty-state`, `feature-card`, `form-row`, `hero`, `how-steps`, `level-up-grid`, `modal-close`, `modal-footer`, `phase-toolbar`, `phase-toolbars`, `pill`, `prompt-select`, `radio-card-group`, `results-overlay`, `section-header`, `site-links`, `stat`, `stats`, `stsh-header`, `suggestion-card`.

Several are benign — `pill`, `stat` and `section-header` are presentational and native semantics suffice. Four are not:

- **`form-row.php`** wraps every field on the platform and emits no `aria-describedby` linking helper or error text to its input. Its own docblock offers `helper` and `error` options; a screen reader user hears neither.
- **`radio-card-group.php` / `checkbox-card-group.php`** are custom card-style selectors with no `role="radiogroup"` / `role="group"` and no group label association.
- **`results-overlay.php`** is an overlay with no `role="dialog"` or `aria-modal`, matching D12's finding that 3–5 dialogs remain invisible to assistive tech.
- **`modal-close.php`** is a close button; without an accessible name it is D2 (resolved platform-wide in July) reopening inside the component library itself.

The distribution is informative: `header.php` (21 aria, 9 role), `planner-library-rail.php` (19/3) and `sidenav.php` (15/1) are carefully wired. The library is not uniformly weak — it is bimodal, and the well-wired components should be the template for the rest.

### H-3 · Focus styling covers a fraction of hover styling

In `components.css` (8,935 lines, 50 base classes): **121** `:hover` rules, **48** `:focus`, **22** `:focus-visible`, **13** `:disabled`, **12** `:active`. One `sr-only`/`visually-hidden` utility in the entire file.

The global `:where(…):focus-visible` floor in `platform-tokens.css` covers native interactive elements, which is why this is High rather than Critical. But every component that styles its own hover state and not its focus state gets a default ring that may not survive its background — and the zero-specificity floor is deliberately designed to lose to any component rule. Platform-wide this is D5 (58 files with `outline: none`, 30 defining `:focus-visible`), still Open.

### H-4 · The `--text-*` namespace holds two different categories

Seventeen font sizes and six colours share one prefix:

```
--text-display, --text-h1 … --text-h4, --text-body,     ← size (rem)
--text-ui, --text-small, --text-meta, --text-caption …
--text-dark, --text-default, --text-muted,              ← colour (hex/alias)
--text-faint, --text-inverse
```

This breaks the `{category}-{property}-{variant}` convention and it is the highest-traffic namespace in the library — `components.css` references `--text-*` 380 times, more than `--space` (165), `--font` (145) and `--gray` (109) combined. An author reading `var(--text-muted)` beside `var(--text-small)` has no cue that one sets `color` and the other `font-size`.

The DTCG export inherits the ambiguity: its `text` group has 22 members spanning both categories, so any downstream tool typing tokens by group gets it wrong.

**Fix:** rename the six colour tokens to `--color-text-*` (the palette already uses `--color-ink-*` for the same concept, so a third vocabulary is not needed), keep aliases for one release, and let `check-drift` check 3 catch stragglers.

### H-5 · The tier-3 semantic layer is defined but not consumed

`theming.md` declares three layers and states that theming happens at layer 3. Measured consumption in `components.css`:

| Family | Defined | Used in components.css |
|---|:--:|:--:|
| `--divider-*` | 4 | **0** |
| `--link-*` | 3 | **0** |
| `--overlay-*` | 3 | **0** |
| `--backdrop-*` | 3 | **0** |
| `--target-*` | 2 | **0** |
| `--button-*` | 9 | 3 |
| `--modal-*` | 5 | 4 |
| `--badge-*` | 4 | 3 |
| `--card-*` | 9 | 13 |
| `--input-*` | 10 | 13 |
| `--toast-*` | 5 | 5 |
| `--tooltip-*` | 3 | 7 |

Fifteen tokens across five families are dead on arrival. `--button-*` — the family theming.md uses as its worked example ("an app that needs a different button accent overrides `--button-bg-primary`") — is consumed three times out of nine definitions.

This is `theming.md`'s own D3 and `token-audit-2026-07.md`'s D3. It is listed here because it is the root cause of H-6 and because it makes the documented theming contract unenforceable: an app that follows the documentation and overrides `--button-bg-primary` will see almost nothing change.

### H-6 · A private token system lives inside `components.css`

`.ws-planner-activity-inspector` defines 17 `--wpai-*` properties and `.ws-planner-rail` defines 10 `--wpr-*`. They are component-scoped rather than `:root`, so `ds-lint`'s `no-local-root-system` rule does not fire — but they are token *values* declared outside `platform-tokens.css`, which theming.md principle 1 forbids.

Two compounding problems:

- Some carry raw values: `--wpai-danger: #A12E2E`, `--wpai-danger-bg: #FEE2E2`, `--wpai-edge-strong: rgba(38, 30, 18, 0.12)`.
- Several alias tokens that **do not exist anywhere**: `--color-neutral-100`, `--color-text`, `--color-surface`, `--planner-exercise-color`, and `--color-border` (defined in 6 app CSS files, never in `platform-tokens.css`). Each is written as `var(--undefined, #fallback)`, so it renders correctly today and will silently change the day someone defines that name.

This is exactly the B1 pattern `token-audit-2026-07.md` flagged in `css/facilitator/participant.css` — now present in the design system's own component stylesheet. `check-drift` check 3 reports 58 such fallback-only tokens repo-wide as WARN.

### H-7 · The `ws_` prefix means two different things

106 functions carry the prefix. Roughly 66 are components. The rest are utilities and data accessors: `ws_path()`, `ws_substack_fetch()`, `ws_substack_relative()`, `ws_pricing_plans()`, `ws_platform_version()`, `ws_is_app_page()`, `ws_app_shelf_table()`, `ws_site_link_panels()`, plus 20 `ws_wl_*` workshop-list helpers and 6 `ws_workshop_list_*` functions.

The consequence is that `DESIGN.md` §12.1's own discovery command — `grep -rn '^function ws_' includes/ app/includes/` — returns 106 results of which about 40 are not components. Every count in the documentation disagrees as a result:

| Source | Claims |
|---|:--:|
| `START-HERE.md` | 54 |
| `components.generated.json` | 66 |
| `workshopr-design-system.json` | 67 |
| `DESIGN.md` §12.2 | 105 |
| Repo grep (this audit) | **106** |

**Fix:** introduce a second prefix for non-component helpers (`wsx_` or a `Workshopr\` namespace), or add a `@component` docblock tag that the catalog generator filters on. Then have `lint:docs` assert the stated count against the generated roster, so the five numbers cannot diverge again.

---

## Medium findings

### M-1 · 40 `ws_*` functions are absent from the catalog

`check-drift` check 1 verifies that every `ws_*` in **`helpers.php`** appears in the JSON. It does not scan `includes/components/*.php` or `app/includes/`, so components defined elsewhere are invisible to it. The consequential omissions: **`ws_header`** (rendered on every page, 18 section keys, 21 aria attributes — the most accessibility-critical component in the library), **`ws_section_hero`**, `ws_dna_cta`, `ws_dna_profile_cta`, `ws_app_shelf_*`.

Fix alongside H-7: make the roster repo-wide and filtered by an explicit component marker.

### M-2 · 12 catalog entries have no demo page

`ws_card_start`, `ws_card_end`, `ws_modal_start`, `ws_modal_end`, `ws_stats`, `ws_status`, `ws_category`, `ws_duration`, `ws_icon_button`, `ws_choice_cards`, `ws_toast_container`, `ws_is_app_page`.

Most are halves of documented pairs or convenience wrappers, so they inherit guidance from their partner — but `ws_stats` and `ws_icon_button` are independently used, and `ws_icon_button` is the component most likely to reintroduce D2 (icon-only buttons with no accessible name). `ws_is_app_page` is a predicate and should be excluded from the catalog entirely under H-7.

### M-3 · 3 demos have no catalog entry

`dna-profile-ct`, `nav`, `toast`. `nav.php` is the documented demo for `ws_header` (DESIGN.md §12.5 points at it) and `toast.php` for `ws_toast_container` — both orphaned by the naming mismatch between demo filename and function name.

### M-4 · Two mandatory doc sections are near-universally absent

`DOC-TEMPLATE.md` Template A defines the required sections for a component doc. Measured across 57 demos:

| Section | Coverage |
|---|---|
| When to use | 57/57 |
| Variants | 54/57 |
| States | 53/57 |
| Accessibility | 53/57 |
| Props / params | 52/57 |
| **Anatomy** | **4/57** |
| **Tokens used** | **0/57** |

"Tokens used" at zero is the more damaging of the two: it is the section that would make H-5 and H-6 visible to a human reading a component's documentation, and it is the natural place to record which tier-3 tokens a component honours.

### M-5 · `check-page.php` scans agent working directories

`SKIP_PATTERNS` excludes `.claude/` but not `.scratch/` or `.superpowers/`. Eight of the 47 current failures are scratch artifacts — `.superpowers/sdd/investment-plan/pre-task4-index.php` and siblings. This inflates the failure count by 17% and trains readers to discount it.

### M-6 · 58 fallback-only tokens platform-wide

`check-drift` check 3 reports them as WARN, led by `--warm-ink` (24 refs), `--planner-text-muted` (11), `--font-headline` (10), `--warm-cream` (9). Each is a name that renders from its fallback today and changes behaviour the day someone defines it. The check correctly refuses to fail on them; they need a disposition decision, not a louder warning.

### M-7 · Seven design-system documents carry no status or date

`DOC-TEMPLATE.md`'s shared conventions require both. Missing from: `debt-register.md`, `motion-system.md`, `token-audit-2026-07.md`, `planner-debt-register.md`, `mobile-ios.md`, and the three `AUDIT-2026-*` files. For a folder whose central problem is knowing which document is current, this is not cosmetic.

---

## Low findings

- **L-1 · `z-index` tokenisation.** `components.css` uses `var(--z-*)` 6 times against 4 literals. Better than the 17% platform figure in the debt register, but the 10 `--z-*` tokens deserve full adoption inside the library that defines them.
- **L-2 · BEM compliance is good and worth recording as such.** 456 `__element` classes, 178 `--modifier` classes, 75 base classes. No single-dash modifier violations found. `Conventions.md`'s CSS rules are being followed.
- **L-3 · `components.css` carries 20+ hardcoded hex values** outside `var()` fallbacks (`#FEE2E2` ×4, `#F87171` ×3, `#FECACA`, `#E11D48`, `#B91C1C`, `#60A5FA`, `#9333EA`). `ds-lint` does not scan it as an app file. Most are status/semantic colours that have token equivalents.

---

## What is working, and should not be disturbed

Naming these matters as much as the findings, because several are unusual and easy to erode.

1. **The accessibility floor in `platform-tokens.css`.** The `:where(a, button, input, select, textarea, summary, [tabindex], [contenteditable])` focus-visible rule at zero specificity is the right pattern and the comment explains exactly why. The `prefers-contrast: more` block remaps five token families with the resulting ratios written inline (`2.52:1 → 4.80:1`). The `forced-colors` block restores outlines for components that draw focus with `box-shadow`, which is a failure mode most teams never discover. This is better than the platform-wide numbers in D5/D6 suggest.
2. **The gate architecture.** Ratchet baselines that tolerate legacy while blocking new drift; generator/`--check` pairs; `--self-test` fixtures that validate the parsers themselves; a documented bypass. The design is sound — it is the wiring (C-1) that failed, not the concept.
3. **The Red Unification.** Fully propagated across tokens, JSON, linter, DESIGN.md and START-HERE.md, with the sky-blue focus ring preserved as a documented, deliberate exception. `ds-lint` clean on 130 files.
4. **The demo pages.** 57/57 with "When to use", 53/57 with a genuine Accessibility section — and the eleven that reach the catalog are frank about their own gaps ("the keyboard half of that pattern is missing"). C-2 is worth fixing precisely because the underlying work is good.
5. **`debt-register.md`'s intellectual honesty.** D3 and D9 both revised their own findings downward after re-measurement, with the method explained. That is rarer than it should be.

---

## Remediation roadmap

Ordered by dependency: restore the safety net first, because every later step needs it to verify.

### Phase 1 — Restore the gates (half a day)

1. Run all five gates; fix the four failures: remove `ws_lifecycle` from the curated JSON, correct the `ws_app_footer` signature, regenerate `tokens.dtcg.json`, repoint the `app-shell.css:1291` card literal, and resolve or baseline the 39 real page violations (`academy/learning-paths/bootcamp.php` first — 31 of them).
2. Add `.scratch/` and `.superpowers/` to `check-page.php`'s `SKIP_PATTERNS` (M-5).
3. Wire `check-page.php` into `ds-lint.yml` on changed `.php` files and into `.claude/settings.json` as the PostToolUse hook its docblock already promises (C-1).
4. Correct the opening line of `debt-register.md`.

**Verify:** all five gates exit 0; a deliberate hex added to a page fails the hook mid-turn.

### Phase 2 — Fix what the system tells Claude (half a day)

5. Extend the a11y extractor to capture `<p>` or `<table>`, add both shapes to `--self-test`, regenerate (C-2).
6. Add a `@component` docblock tag; make the roster repo-wide and filter on it; extend `check-drift` check 1 to the same scope (H-7, M-1).
7. Reconcile the five component counts and add a `lint:docs` assertion against the generated roster.

**Verify:** `a11y` coverage rises from 11 to 50+; `ws_header` and `ws_section_hero` appear in the catalog; `npm run lint:docs` passes.

### Phase 3 — Accessibility decisions and fixes (two to three days)

8. **Decide the root font size** (C-3) and record it as D4 in `token-audit-2026-07.md`. Everything below depends on whether the large-text exemption is available.
9. Close D4/C-4: replace `#E54D4D` as a `color` with `--phase-learn-dark` across the 38 declarations.
10. Fix H-1: make the `prefers-contrast` remapping of muted text the default, or darken `--gray-500` to clear 4.5:1 on `--bg-paper-dark`.
11. Wire the four consequential templates in H-2: `form-row` (`aria-describedby` for helper and error), `radio-card-group` / `checkbox-card-group` (group roles and labels), `results-overlay` (`role="dialog"`, `aria-modal`), `modal-close` (accessible name). Use `planner-library-rail.php` and `sidenav.php` as the reference implementations.
12. Add `:focus-visible` to the components that style `:hover` and nothing else (H-3).

**Verify:** re-run the contrast script; keyboard-traverse one page per archetype; the four templates announce correctly in VoiceOver.

### Phase 4 — Token architecture (one to two weeks, incremental)

13. Split the `--text-*` namespace (H-4), aliasing the old colour names for one release.
14. Wire or retire the tier-3 layer (H-5): either make `components.css` consume `--button-*`, `--divider-*`, `--link-*`, `--overlay-*`, `--backdrop-*`, `--target-*`, or delete the 15 unused tokens and correct `theming.md` so it stops promising a mechanism that does not exist. Wiring is the better choice; deleting is better than the status quo.
15. Promote `--wpai-*` and `--wpr-*` values into `platform-tokens.css` or resolve them to existing tokens; define or remove the five phantom names they reference (H-6).
16. Give the 58 fallback-only tokens a disposition (M-6).
17. Add a "Tokens used" section to the demo template and backfill it (M-4) — this is the documentation that keeps 14 and 15 from regressing.

**Verify:** `check-drift` check 3's WARN list shrinks each pass; no component references an undefined name.

### Phase 5 — Coverage and hygiene

18. Demos for `ws_icon_button` and `ws_stats`; rename `nav.php` and `toast.php` or add catalog aliases (M-2, M-3).
19. Status and date lines on the seven undated documents (M-7).
20. Tokenise the remaining `z-index` literals and the 20 hardcoded hex values in `components.css` (L-1, L-3).

---

## Suggested follow-ups

- `/design-systems:tokenize` on `includes/components/components.css` for L-3 and Phase 4.
- `/design-systems:create-component` is **not** currently recommended. Adding components before Phase 1 and 2 land means adding them to a system whose gates are red and whose catalog under-reports what exists.
