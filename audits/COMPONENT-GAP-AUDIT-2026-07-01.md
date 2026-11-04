# Component Gap Audit — New `ws_*` Components to Build

**Date:** 2026-07-01
**Method:** 4 parallel codebase scans (planner+coach · academy/dna/tips/intervention · library/myworkshopr/admin/site · cross-cutting CSS), each deduped against the existing **49 `ws_*` helpers**. Findings cross-validated: patterns surfaced by **≥2 independent scans** are highest-confidence (real cross-app repetition).
**Framing:** recommend *new* components that would remove repeated raw-HTML/CSS and raise consistency. Distinct from adoption gaps (raw HTML that should use a component that already exists — listed separately at the end).

---

## Executive summary

The system is strong on primitives (buttons, cards, inputs, badges, modals, stats). The gaps are **compositional patterns** the apps keep re-rolling — display chips, toggles, filter bars, drawers, CTA blocks — and one big structural hole: **admin has no shared partials**, so every admin list page hand-rolls its table/toolbar/pagination.

**13 recommended new components in 3 tiers** (+ a clear "don't build these" list). Two structural notes shape the recommendations:
- **Library already abstracts its listing surface** (`includes/partials/listing-*.php`) → those are *promotion* candidates (partial → `ws_*`), not raw gaps.
- **Admin is the opposite** — near-zero sharing → the highest-volume, highest-ROI new components live there.

| Tier | Count | Theme |
|---|---|---|
| **Tier 1 — build now** | 4 | High impact, tiny effort, cross-app validated |
| **Tier 2 — build next** | 4 | High impact, medium effort (incl. the admin table system) |
| **Tier 3 — evaluate/queue** | 5 | Real but narrower, or needs a build-vs-extend decision |

---

## Tier 1 — Build now (High impact · Small effort · cross-app validated)

### 1. `ws_pill` / `ws_tag` — read-only display chip ⭐ *(found by 2 scans)*
A rounded label/tag for category · difficulty · type · count. **Distinct from `ws_chip_input`** (that's an editable control; this is a read-only label — the gap the cross-cutting scan explicitly flagged).
- **Evidence:** `.detail-pill`, `.ae-difficulty-pill`, `.category-pill`, `.mw-pill`, `.type-chip` (×10), `.launchpad-tech-chip`, `.attendee-chip`… ~45 refs across **7 apps** (planner, coach, myworkshopr, facilitator, library, tips, hybrid). Variance: **low** — nearly all are `pill radius + tint bg + small font`.
- **Why first:** highest raw count of any gap, widest spread, trivial to unify (`ws_pill($text, ['variant'=>…, 'color'=>…, 'size'=>…])`).

### 2. `ws_toggle` — bare on/off switch ⭐ *(found by 3 scans)*
The iOS-style switch (`label.switch` + track + slider). **Two divergent implementations already exist** (`toggle-*` and `launchpad-toggle-*`) — the clearest "component is missing" signal.
- **Evidence:** `account/index.php` (~10), `myworkshopr/settings.php:339` (~8), `planner/planner.php` (~4), `survey/includes/modals.php`, admin goals, planner `launchpad-toggle-*` (3 files). Cross-app: settings/preferences everywhere.
- **Pairs with:** `ws_setting_item` (Tier 3) — the label+description+switch row.

### 3. `ws_cta_section` — full-width bottom-of-page conversion block ⭐
Eyebrow/headline + subcopy + 1–2 buttons on a colored panel. **Copy-pasted identically across ~24 marketing/solutions pages with no include.** Distinct from `ws_hero` (top of page).
- **Evidence:** `.solt-final-cta` across **17 solutions pages** (`solutions/byoutcome/*`, `byrole/*`, `bytype/*` — pure copy-paste), `.hp-final-cta` on `index.php:1096`, `planner/index.php`, `planner/landing.php`, `sidekick/index.php`, `pro/index.php`.
- **Why:** smallest effort, ~24 call sites, marketing-visible. Highest ROI quick win.

### 4. `ws_how_steps` — numbered "how it works" step grid ⭐
`.how-step { icon + number "01" + h3 + p }` in a `.how-grid`. **No ordinal-step semantics in `ws_feature_card`.**
- **Evidence:** 12 uses across **3 apps** — `dna/index.php` (two 3-step grids), `intervention/index.php:164-182`, `academy/training/index.php`. Obvious fit for Tips/Hybrid onboarding.

---

## Tier 2 — Build next (High impact · Medium effort)

### 5. `ws_data_table` (+ `ws_table_pagination` + `ws_bulk_action_bar`) — the admin table system ⭐ *top structural fix*
`.data-table` with select-all column, status-badge cells, and a trailing `.actions-cell` of icon actions; plus the `.table-footer` pagination row and the "N selected" bulk bar. **Every admin list page rebuilds all three by hand.**
- **Evidence:** `.data-table` in **8 admin files** (exercises, users, collections, goals, icebreakers, tips, workshops, tip-digest), `.action-btn`/`.actions-cell` ×8, `.table-footer` ×5, `.bulk-bar` in users + saved-workshops. `<table>` appears in 23 admin files.
- **Ship as one system** — replaces the single largest volume of hand-rolled markup in the codebase.

### 6. `ws_filter_bar` — listing/search filter row ⭐ *(found by 2 scans)*
Label + selects + clear + active-filter chips above a grid. **A de-facto shared partial already exists** (`includes/partials/listing-filters.php`) — evidence it wants to be a real component.
- **Evidence:** `.filter-select` (×11), `.filter-group`, `.filter-chip`, `.mw-filters`, `.analytics-filters`, `.listing-filter-pill`… across **7 areas** (planner, library, search, tips, admin, myworkshopr, coach). Config-driven: `ws_filter_bar($filters, $activeChips)`.

### 7. `ws_drawer` — side / off-canvas panel ⭐
Slide-in panel: header/close + body + optional footer + backdrop. **3–4 near-identical shells maintained separately.**
- **Evidence:** `.coach-drawer` (×11), `.intervention-drawer` (×7), `.ai-builder-drawer`, `.drawer-*` — dedicated files `intervention-drawer.css`, `ai-builder-drawer.css` + partials `includes/footer/coach-drawer.php`, `includes/footer/intervention-drawer.php`, `facilitator/app.php`. Shell is very mergeable; content stays a slot.

### 8. `ws_email_capture` — email/lead-gate form
Single-field email + submit + helper note + inline error + success-swap; **per-app phase color as a param.** The shared monetization surface.
- **Evidence:** 16 files / 23 instances — `intervention/index.php` `.download-form`, `dna/email-gate.php` `#gate-form`, `dna/quiz.php`/`results.php` gates, `academy/learn/book-1..6.php` + `download.php` (7 forms), tips subscribe. Every app hand-rolls markup + JS + error styling.

---

## Tier 3 — Evaluate / queue (real, but narrower or needs a build-vs-extend call)

| # | Component | Note | I×E |
|---|---|---|---|
| 9 | `ws_dropdown_menu` | Highest raw count (~80 refs, 6 areas: nav/topbar/user/kebab) but many per-app skins → consolidate the headers first. | H×M |
| 10 | `ws_metric_card` | Boxed dashboard tile (icon chip + big number + delta). Consolidates **3 competing `.stat-card` CSS definitions** (admin.css, admin-v2.css, users.php inline) + `myworkshopr .dash-stat-card`. Decide: new component vs. a card-variant of `ws_stat`. | M×S |
| 11 | `ws_stepper` / `ws_phase_progress` | Multi-step tracker (planner brief flow, coach prep→facilitate→reflect, dna quiz, academy path). `ws_progress` only does a linear bar. Possibly one component w/ orientation option. Split off a tiny `ws_number_stepper` (the +/- `duration-stepper`, ×16). | M×S |
| 12 | `ws_form_section` + `ws_setting_item` | Titled fieldset wrapper (admin edit forms hand-roll `.form-section` > `.form-group`) and the label+description+switch preference row (`myworkshopr/settings.php` ~20 uses). Pair with adopting `ws_form_row` + `ws_toggle`. | M×S |
| 13 | `ws_definition_list` · `ws_category_tile` · `ws_archetype_card` | Read-only key→value summary w/ empty state (planner brief-preview, ~4 pages); icon+name+count nav tile (intervention/tips category grids); image/badge+name+tagline result card (dna archetypes). Each real but more app-scoped; build if a 2nd consumer is confirmed. | M×S |

---

## Don't build these (promotion, extend, or too app-specific)

- **`ws_panel`** — ~high count but **overlaps `ws_card` + `ws_section_header`**; audit those cover it before building. Likely not a new component.
- **`ws_template_card`** (planner) — JS-rendered; evaluate **extending `ws_listing_card`** first rather than a net-new helper.
- **`ws_agenda_item`** (planner) — planner-only; **promote the existing `<template>`** + reconcile with `ws_planner_card`, not net-new.
- **`ws_footer`** — 3 divergent footers exist; that's a **refactor/merge** of partials, not a repetition gap.
- **`ws_gated_content`, library `listing-*` partials** — already centralized partials; **promote to `ws_*`** for discoverability (low urgency), not raw gaps.
- **`changelog-entry`, `ws_settings_nav`, `ws_card_stack`, `ws_intervention_result`** — single-page-type or JS-string-rendered; below the cross-app bar.

---

## Adoption gaps (no new component — migrate to what exists)

These are raw HTML duplicating an *existing* `ws_*` — fixing them is pure adoption:
- **`section-eyebrow` + title + subtitle** (17 uses, all 4 content apps) → `ws_section_header(label: …)`.
- **`hero-stat` + divider** (9+ uses: dna/intervention/academy) → `ws_stats`.
- **Admin status pills** (`admin/users.php`, `admin/exercises.php`) → `ws_badge` / `ws_status`.
- **Raw `.form-group` rows** (10+ admin/myworkshopr files) → `ws_form_row` + `ws_input`.
- **Inline stat markup** (coach hero, planner analytics) → `ws_stat` (may need `icon`/`detail` options).
- **`launchpad-accordion*`** (planner brief, 4 pages) → `ws_accordion` + a status-badge/leading-icon option.

---

## Recommended build order
1. **`ws_pill`** — widest spread, smallest effort, instant consistency win.
2. **`ws_cta_section`** — ~24 marketing call sites, quick + visible.
3. **`ws_toggle`** (+ `ws_setting_item`) — unifies 2 divergent switch implementations.
4. **`ws_how_steps`** — clean 3-app onboarding win.
5. **`ws_data_table` system** (+ pagination + bulk bar + `ws_toolbar`) — biggest structural payoff; replaces the most hand-rolled markup.
6. **`ws_filter_bar`** — formalize the existing shared partial.
7. **`ws_drawer`** — retire 3–4 duplicated shells.
8. **`ws_email_capture`** — highest-leverage monetization surface.
Then Tier 3 as capacity allows; run the adoption-gap migrations in parallel (they're cheap and raise the coverage number).

## Process note
Per the design-system rules, any new `ws_*` needs: the helper in `includes/components/helpers.php`, a template in `includes/components/`, CSS in `components.css`, a demo in `design-system/components/demos/`, a JSON entry, and `php design-system/check-drift.php` green. Follow with `/create-component` per item.
