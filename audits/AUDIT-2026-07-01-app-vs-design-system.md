# Design System Audit — App-as-Baseline

**Date:** 2026-07-01
**Method:** 4 parallel read-only audits (tokens, components, phase-colors/typography, docs) across the full platform codebase, plus `php design-system/check-drift.php`.
**Framing:** the **shipped app is the source of truth**. Where `design-system/` (tokens, `ws_*` components, `workshopr-design-system.json`, `DESIGN.md`, `motion.md`) disagrees with the app, the **design system is treated as wrong** and should be updated to match — *except* the two recolors in P0-1/P0-2, which contradict foundational brand rules strongly enough to need an explicit human yes/no first.

---

## Executive summary

The design system is in good structural health — `check-drift.php` **passes** (49 `ws_*` helpers, 39 JSON components, 9 apps in sync), and the DS is genuinely thorough about *intentional* color exceptions (intervention red, tips purple, facilitator purple, academy Learn red are all documented with correct `colorNote`s). Drift is concentrated in three places:

1. **Two app recolors the DS never caught up to** — planner and DNA both ship red now.
2. **Token gaps the app routes around** with hardcoded values (z-index band, utility colors).
3. **Stale documentation** — `motion.md` targets the wrong tech stack entirely, and JSON color/component metadata lags the CSS.

### Findings by severity

| Severity | Count | Theme |
|---|---|---|
| **P0** | 6 | Brand-breaking or app-wide: planner/DNA phase colors, tips category colors, z-index scale, motion easing + wrong framework |
| **P1** | 5 | Missing tokens the app hardcodes; JSON component-tier drift; stale reconcile date |
| **P2** | 6 | Missing component wrappers, legacy CSS, stale adoption/changelog notes |

---

## P0 — Critical

### P0-1 · Planner ships RED; the DS says BLUE (and calls red "a bug") ⚠️ needs a decision
- **App (baseline):** `css/planner/base/_variables.css:147` → `--planner-primary: var(--mainsite-primary)` (red `#E54D4D`), comment *"Planner recolored to mainsite red (was plan-phase blue) — June 2026."* Gradient, topbar, dark/light all remapped to red.
- **DS says blue:** `design-system/platform-tokens.css:106` (`--planner-primary: #0284C7`), `DESIGN.md:133` (Plan = Sky Blue `#0284C7`), `workshopr-design-system.json:98` and `:1025`. And `workshopr-design-system.json:1021` explicitly states *"Using red in planner … is a bug."*
- **Decision needed:** (a) recolor is intentional → update the DS to planner = red everywhere; or (b) recolor is a mistake → revert the app (out of audit scope). Per "app is baseline," default is (a).
- **DS fix if (a):** set `--planner-primary`/`dark`/`light`/`very-light`/`gradient` to the red scale in `platform-tokens.css`; update `DESIGN.md` Plan row; update JSON `apps.planner`, `phaseColors.plan`, and remove/rewrite the "red in planner is a bug" rule; add a `colorNote` explaining the June-2026 recolor.

### P0-2 · DNA ships RED; the DS says GREEN ⚠️ needs a decision
- **App (baseline):** `css/dna/styles.css:18` → `--dna-primary: #E54D4D`, comment *"Red accent override — DNA now uses red instead of the reflect-phase green."* Also remaps `--phase-reflect*` to red locally.
- **DS says green:** `platform-tokens.css:195` (`--dna-primary: #34D399` + full emerald scale + category tints), `DESIGN.md:135` (Reflect = Emerald), `workshopr-design-system.json:158`.
- **Decision needed:** same as P0-1 — confirm the recolor is intended.
- **DS fix if confirmed:** update DNA primary/scale + DNA category tints in `platform-tokens.css`, `DESIGN.md` Reflect row, JSON `apps.dna`; add a `colorNote`. DNA stays in the Reflect *phase* grouping (JSON:658) even though its accent is now red — document that split explicitly.

### P0-3 · Tips category colors: JSON says red, tokens/app say purple
- **JSON (wrong):** `workshopr-design-system.json:73–78` lists tips categories 1–6 as a **red** scale (`#991B1B … #FCA5A5`).
- **App/tokens (baseline):** `platform-tokens.css:64–69` declares `--tips-cat-1…6` as a **purple** scale (`#4527A0 … #B39DDB`); app renders purple.
- **DS fix:** replace the JSON tips categories array with the purple values from `platform-tokens.css`.

### P0-4 · Z-index scale doesn't cover what the app uses
- **App (baseline):** uses `z-index: 1000` (40+ sites), `1100` (52+ in `unified-header.css`, coach), and `10000–10004` (30+ in `planner/live-mode.css`).
- **DS (wrong):** `platform-tokens.css` tops out at `--z-tooltip: 1300`; JSON tops out at `600`. The 1000–10004 band is undocumented, so the app hardcodes it.
- **DS fix:** add the real layers to `platform-tokens.css` **and** JSON, e.g. `--z-overlay: 1000; --z-header: 1100; --z-dialog: 10000; --z-dialog-high: 10001; --z-dialog-highest: 10004;` then migrate app hardcodes to them incrementally.

### P0-5 · Motion easing: motion.md contradicts DESIGN.md/JSON
- **motion.md (lines 51/88/119/147/175):** standard ease = `[0.22, 1, 0.36, 1]` for ~90% of animations.
- **DESIGN.md:75 & JSON:340:** canonical spring = `cubic-bezier(0.16, 1, 0.3, 1)`. Materially different curves → wrong easing in every reveal/stagger.
- **DS fix:** pick one canonical curve and reconcile all three files (recommend keeping `cubic-bezier(0.16,1,0.3,1)` and updating motion.md, unless app CSS proves otherwise — spot-check `cubic-bezier(` usages in app CSS/JS to decide).

### P0-6 · motion.md documents the wrong tech stack
- **motion.md (lines 26–27, 211–221):** prescribes **Next.js (App Router) + React + Framer Motion + GSAP/@gsap/react** ("use client" directives, `import { motion } from "framer-motion"`).
- **Reality (baseline):** the platform is **vanilla PHP + vanilla JS + CSS** (CLAUDE.md §2; no React/Framer in the app). Every code example in motion.md is unusable here.
- **DS fix:** rewrite motion.md's "Technical Context" and pattern snippets for CSS transitions/`@keyframes` + vanilla JS (`IntersectionObserver`, event listeners). P0 because it actively misdirects any motion work.

---

## P1 — High

### P1-1 · Utility colors the app uses but `platform-tokens.css` lacks
- `#ea580c` (orange-600) and `#15803d` (green-700) appear in `css/styles.css`, `css/admin/admin.css`, `css/components/_modals.css` (status/icon contexts). They live in `css/design-system.css` but not the canonical `platform-tokens.css`.
- **DS fix:** add `--color-orange-600: #ea580c;` and `--color-green-700: #15803d;` to `platform-tokens.css` (+ JSON).

### P1-2 · More hardcoded colors with no token
- Auth/login reds `#b02a37`, `#c82333` (8+ uses: `styles.css`, `auth-modal.css`, `admin/admin.css`); pastel card-header gradients `#f3e8ff`, `#e9d5ff`, `#ffedd5`, `#fed7aa` (4+ uses).
- **DS fix:** add tokens (`--color-auth-primary`, `--color-auth-gradient-dark`, `--color-purple-100/200`, `--color-orange-100/200`).

### P1-3 · JSON component tiers are muddled (10 real helpers hidden as "convenience/related")
- All 49 `ws_*` names *appear* in the JSON, but 10 exist only as `convenience`/`related` mentions rather than top-level entries: `ws_card_start`, `ws_card_end`, `ws_modal_start`, `ws_modal_end`, `ws_modal_footer`, `ws_duration`, `ws_category`, `ws_status`, `ws_icon_button`, `ws_stats`. (`ws_section_hero`, `ws_dna_cta` are referenced but thinly documented — verify they carry full `options`.)
- **Impact:** easy to miss → raw HTML gets written instead.
- **DS fix:** promote full functions to top-level entries with `function`/`description`/`options`; reserve `convenience` for true aliases. Re-run `check-drift.php` after.

### P1-4 · DNA `--dna-light` value mismatch (part of the recolor)
- App `css/dna/styles.css:20` → `#FCA5A5` (red); `platform-tokens.css:197` → `#6EE7B7` (green). Folds into the P0-2 DNA fix.

### P1-5 · Reconciliation date stale
- `DESIGN.md:82` `last-reconciled: "2026-05-05"` vs `workshopr-design-system.json:14` `lastUpdated: "2026-06-04"` (today 2026-07-01). Undermines the source-of-truth claim in START-HERE.md.
- **DS fix:** bump `DESIGN.md` after this reconciliation.

---

## P2 — Medium

- **P2-1 · Missing component wrappers (planner):** `briefing-*` = 26 raw-HTML uses in `planner/briefing.php` (CSS in `css/planner/briefing.css`); `analytics-*` = 26 raw uses in `planner/analytics.php`. No `ws_*` equivalents. **Fix:** add `ws_briefing_*`/`ws_analytics_*` helpers, or record an app-specific exemption in the JSON.
- **P2-2 · Legacy button CSS + raw markup:** `.btn-primary/.btn-secondary/.btn-tertiary/.btn-outline/.btn-sm/.btn-lg/.btn-block` in `css/styles.css` shadow the modern `.ws-btn--*`; `coach/landing.php` has 2 raw `<a class="btn-primary">`. **Fix:** add a `deprecated_css_classes` section to the JSON; note `.ws-btn` is the base class; migrate coach links to `ws_button()`.
- **P2-3 · ADOPTION.md stale:** claims Coach = "No" ws_* adoption, but `coach/index.php` has 5 `ws_*` calls. **Fix:** re-run adoption tally.
- **P2-4 · Changelog process ambiguous:** DESIGN.md §14.5 says log to `changelog/index.php`, but DS changes belong in `design-system/changelog.php`. **Fix:** clarify both.
- **P2-5 · Facilitator stale fallbacks:** `#7C3AED` fallback literals in `css/facilitator/facilitator.css` (resolves correctly to `#7C4DFF` via `--phase-facilitate`, so cosmetic). **Fix:** update fallbacks to `#7C4DFF`.
- **P2-6 · Housekeeping:** shadow format inconsistency (rgba vs rgb-slash) between `platform-tokens.css` and `css/design-system.css`; deprecated `taste.md`/`principles.md`/`forms.md` still discoverable in repo root (add deprecation headers or move to `/deprecated/`).

---

## Remediation roadmap

1. **Decide the recolors (blocking):** confirm planner = red and DNA = red are intentional (P0-1, P0-2). Everything else assumes app-is-baseline and proceeds without a decision.
2. **Safe DS sync (no app change):** tips categories → purple (P0-3); add z-index tokens (P0-4); add missing color tokens (P1-1, P1-2); bump reconcile date (P1-5).
3. **Fix the docs:** reconcile motion easing (P0-5) and rewrite motion.md for vanilla PHP/JS (P0-6); clarify changelog process (P2-4); refresh ADOPTION.md (P2-3).
4. **Restructure JSON:** promote the 10 hidden helpers to top-level, verify `ws_section_hero`/`ws_dna_cta` options (P1-3); add `deprecated_css_classes` (P2-2).
5. **Component coverage:** add or exempt `ws_briefing_*`/`ws_analytics_*` (P2-1); migrate coach raw buttons; facilitator fallbacks + housekeeping (P2-5, P2-6).
6. **Verify:** run `php design-system/check-drift.php` (must stay green) and `mcp__design-system-enforcer__validate_file` on touched files.

## Per-app phase-color verdict

| App | DS claims | App actually uses | Match? |
|---|---|---|---|
| Planner | blue `#0284C7` | **red `#E54D4D`** | ❌ P0-1 |
| DNA | green `#34D399` | **red `#E54D4D`** | ❌ P0-2 |
| Coach | purple `#7C4DFF` | purple `#7C4DFF` | ✅ |
| Facilitator | purple `#7C4DFF` | purple `#7C4DFF` (stale `#7C3AED` fallbacks) | ✅ (P2-5) |
| Tips | purple `#7C4DFF` (documented exception) | purple `#7C4DFF` | ✅ |
| Intervention | red `#E54D4D` (documented exception) | red `#E54D4D` | ✅ |
| Academy/Training | Learn red `#E54D4D` | red `#E54D4D` | ✅ |
| Mainsite | red `#E54D4D` | red `#E54D4D` | ✅ |

## Files these fixes touch
- `design-system/platform-tokens.css`, `design-system/workshopr-design-system.json`, `DESIGN.md`, `motion.md`, `design-system/ADOPTION.md`, `design-system/changelog.php`
- (optional, for wrappers) `includes/components/helpers.php`, `includes/components/components.css`
