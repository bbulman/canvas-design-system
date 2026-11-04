# Design System Adoption Tracker

> **Goal:** All apps should consume `platform-tokens.css` and use `ws_*` components where applicable.
> **Last updated:** August 2026

> **MyWorkshopr is not in the matrix any more.** It was absorbed into the app shell in August 2026
> and `/myworkshopr/` holds nothing but 301 stubs. Its component debt went with it: the panel
> markup, `myworkshopr.css`, `myworkshopr-v2.css` and `add-exercise.css` were deleted rather than
> migrated. `ws_lifecycle()` retired in the same pass — see the design-system changelog, v2.9.99.

> **Compliance is now enforced.** `scripts/ds-lint.mjs` (npm `lint:ds`, pre-commit hook, and CI)
> blocks new cool-gray hex, banned font stacks, and wrong-phase brand-color leakage. Run
> `npm run lint:ds` for the current baseline. See `audits/design-system-audit-2026-06.md` for the
> full audit and remediation plan.

## Adoption Matrix

| App | Imports `platform-tokens.css` | Uses `ws_*` Components | Correct Fonts | Warm Stone Grays | Status |
|-----|:---:|:---:|:---:|:---:|--------|
| **Main Site** | Yes | Yes | Yes (Fraunces + Inter) | Yes | Full adoption |
| **App shell (`/app/`)** | Yes | Yes | Yes (Fraunces + Inter) | Yes | Full adoption. Every view is built from `ws_*` and paints from tokens; `app/css/*.css` adds layout only, each sheet scoped to its view's root class. Aug 2026: absorbed MyWorkshopr — `?view=settings` (8 panels), `?view=stuff` (favorites / notes / comments / submissions / published, plus the hidden `contribute` form). The three ported sheets (`settings.css`, `stuff.css`, `stuff-contribute.css`) dropped MyWorkshopr's `--mainsite-*` reaches, its bare white literals, its per-type blue/green/purple tints and the orange `--exercise-accent` family, all for platform tokens |
| **Planner** | Yes | Partial (growing) | Yes (Fraunces + Inter) | Yes | Tokens adopted; Phase 5 migrated edit.php, modals.php, view.php, saved.php, schedule panel to ws_* components (Apr 2026) |
| **Coach** | Yes | No* | Partial (loads Fraunces + Inter but also others) | Yes | Tokens adopted; bespoke component library **by design** (see `coach/CLAUDE.md`). *Landing/index pages do use a few `ws_*` calls. Cool grays fixed Apr 2026 |
| **Coach V2** | Yes | No | Yes | Yes | Has own `coach-design-system.css` extending tokens |
| **Intervention** | Yes | No | Yes (Fraunces + Inter, migrated 2026) | Partial | Tokens adopted; standalone microsite styling |
| **Tips** | Yes | No | Yes (Fraunces + Inter, migrated 2026) | Partial | Tokens adopted; standalone microsite styling |
| **Podcasts** | Yes | No | Yes (Fraunces + Inter, migrated 2026) | Partial | Tokens adopted; standalone microsite styling |
| **DNA** | Partial | No | Partial | Unknown | Early-stage app |
| **Training** | Yes | No | Partial | Unknown | Early-stage app |
| **Admin** | Yes | No | N/A | N/A | Internal tool, lower priority |

## What "Full Adoption" Means

1. **Imports `platform-tokens.css`** — All colors, spacing, typography, shadows come from shared tokens
2. **Uses `ws_*` components** — Buttons, cards, modals, inputs, badges etc. use the PHP helper functions
3. **Correct fonts** — Fraunces (heading) + Inter (body) as primary fonts
4. **Warm stone grays** — Tailwind Stone palette, no cool grays

## Migration Priority

### Priority 1: Font Migration — ✅ Done

Tips, Intervention, and Podcasts migrated from Bitter + DM Sans ("paper aesthetic") to Fraunces + Inter (see the "Previously:" comments at the top of each app's `css/<app>/styles.css`). `ds-lint.mjs` blocks banned font stacks from returning.

### Priority 2: Component Adoption for Planner

Planner uses some `ws_*` components but has custom implementations for others. Key gaps:

| Component | Current State | Migration Path |
|-----------|--------------|----------------|
| Modals | ~~Custom implementation in `includes/modals.php`~~ Migrated (Oct 2026) | ✅ `modal-planner.php` renders `ws_modal_start` (variant branded) for every planner dialog, including Planner Home and the AI generator |
| Toasts | Custom in `PlannerUI` module | Migrate to `ws_toast` |
| Buttons | ~~Mix of custom CSS and `ws_button`~~ Mostly migrated | ✅ edit.php, modals.php, saved.php, view.php, schedule panel done. Remaining: topbar, sidebar, index.php, landing.php |
| Cards | Custom sidebar/agenda cards | Keep custom (domain-specific) |
| Chip Input | Custom attendee inputs | Migrate to `ws_chip_input` |
| Activity Badges | Inline HTML in agenda items | Migrate to `ws_activity_badge` |
| Suggestion Cards | Custom AI suggestion UI | Migrate to `ws_suggestion_card` |
| Radio/Checkbox Cards | Custom selection cards | Migrate to `ws_radio_card_group` / `ws_checkbox_card_group` |
| Results Overlay | Custom result screens | Migrate to `ws_results_overlay` |

### Priority 3: Cool Gray Cleanup — mostly done, gate now prevents regression

The April 2026 pass replaced 354 cool grays, but they had crept back (75 across 14 files by June 2026 — this tracker's earlier "zero remaining" claim was inaccurate). June 2026 cleanup: cleared `components.css` (incl. dead-token fallbacks that were actively rendering cool gray), `library-goals.css`, the shared `_sidebar.css`, `listing-redesign.css`, and the DNA mobile reading sheet. **Remaining cool-grays (≈25) live only in the duplicated planner CSS trees** and are deferred to the planner-tree consolidation (Priority below). `ds-lint.mjs` now fails any new cool-gray, so this will not silently regress again.

Reference mapping (for future prevention):

| Cool Gray (legacy) | Warm Stone (correct) | Token |
|-------|-------|-------|
| `#F9FAFB` | `#FAFAF9` | `--gray-50` |
| `#F3F4F6` | `#F5F5F4` | `--gray-100` |
| `#E5E7EB` | `#E7E5E4` | `--gray-200` |
| `#D1D5DB` | `#D6D3D1` | `--gray-300` |
| `#9CA3AF` | `#A8A29E` | `--gray-400` |
| `#6B7280` | `#78716C` | `--gray-500` |
| `#4B5563` | `#57534E` | `--gray-600` |
| `#374151` | `#44403C` | `--gray-700` |
| `#1F2937` | `#292524` | `--gray-800` |
| `#111827` | `#1C1917` | `--gray-900` |

**Status:** Mostly done — ≈25 cool grays remain in the duplicated planner CSS trees (deferred to the planner-tree consolidation, per the June 2026 note above). `ds-lint.mjs` blocks new regressions.

#### Planner Hardcoded Color Audit (Updated June 2026)

Remaining hardcoded values (non-gray) across planner CSS files:

| Color | Count | Correct Token |
|-------|-------|---------------|
| `#E54D4D` + rgba | 56 | `var(--planner-red)` |
| `rgba(255,255,255,X)` | 47 | Needs `--planner-overlay-*` tokens |
| `#2563eb` + rgba | 23 | `var(--planner-exercise-color)` |
| `rgba(0,0,0,X)` | 15 | Needs `--planner-backdrop` token |

Migrate file-by-file with visual QA. Biggest offenders: the `css/planner/` bundle sheets — `workshop-studio.css`, `briefing.css`, and the `components/` partials (the old `planner-v2.css` monolith was retired June 2026).

### Priority 4: Microsite Component Libraries

Coach, Intervention, Tips, and Podcasts each have custom component implementations. Long-term goal: extract shared patterns into `ws_*` components or create a lightweight microsite component set.

**Not urgent** — these microsites work and are visually distinct by design. Focus on shared tokens first.

## Tracking Changes

When you modify a file and improve its design system adoption, update this tracker. Examples:
- Swapped cool gray for warm stone in `tips/styles.css` line 42
- Migrated modal in `planner/includes/modals.php` to `ws_modal_start/end`
- Added `@import '/design-system/platform-tokens.css'` to `dna/styles.css`
