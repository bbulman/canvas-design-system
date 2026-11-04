# Workshopr Motion System

| | |
|---|---|
| **Status** | stable — proposals P1–P4 approved and applied July 3, 2026 |
| **Governs** | duration, easing, choreography, and reduced-motion behavior across all apps |
| **Source of truth** | `/motion.md` (intent + long-form patterns) · `design-system/platform-tokens.css` (token values) |
| **Guards** | reduced-motion gate in platform-tokens.css · impeccable design hook (`bounce-easing`, `layout-transition` rules) |

## Purpose

Two motion vocabularies grew independently: `/motion.md` (page-level reveals,
0.6–1.4s, "a page that breathes") and the token file's animation section
(micro-interactions, 150–300ms). This spec reconciles them into one system with
two named regimes, and catalogs the shipped patterns so new motion is assembled,
not invented.

## Principles (from /motion.md, binding)

1. **Unhurried, confident, quiet** — motion supports content; nothing snaps,
   bounces, or competes.
2. **No overshoot.** Real objects decelerate smoothly. (The design hook enforces
   this; the one shipped "pop" settles *within* its keyframe, using a pure
   deceleration curve.)
3. **Transform + opacity only.** Never animate width/height/margin/top — use
   `transform: scaleX()` for bars, `grid-template-rows` for height.
4. **No libraries.** CSS transitions, `@keyframes`, `IntersectionObserver`.
5. **Reduced motion is not optional.** The global gate in platform-tokens.css
   zeroes durations under `prefers-reduced-motion`; any keyframe animation an
   app adds must additionally be wrapped in
   `@media (prefers-reduced-motion: no-preference)`.

## The two regimes

| Regime | Where | Durations | Canonical ease |
|---|---|---|---|
| **UI micro-motion** | components: hovers, toggles, overlays, toasts, bars | `--duration-fast` 150ms · `--duration-base` 200ms · `--duration-slow`/`--duration-enter` 300ms · `--duration-exit` 200ms | `--ease-out` for entries, `--ease-in` for exits, `--ease-spring` for organic settles |
| **Page reveals** | marketing/landing: hero sequences, scroll reveals | 600–1400ms per /motion.md | `--ease-reveal` (`cubic-bezier(0.22, 1, 0.36, 1)`) — tokenized July 2026 (P1) |

The regimes never mix: a modal is micro-motion even on a landing page; a hero
headline is a reveal even if it's small.

## Specification — easing

| Token | Curve | Use for |
|---|---|---|
| `--ease-out` | `cubic-bezier(0, 0, 0.2, 1)` | Elements entering, color/border state changes |
| `--ease-in` | `cubic-bezier(0.4, 0, 1, 0.2)` | Elements leaving |
| `--ease-in-out` | `cubic-bezier(0.4, 0, 0.2, 1)` | Looping opacity pulses (live dots) |
| `--ease-spring` | `cubic-bezier(0.16, 1, 0.3, 1)` | Organic settles: pops, bar growth, sheet slide-ups. Pure deceleration — despite the name it does **not** overshoot |
| `--ease-default` | `ease` | Legacy; prefer an explicit curve |
| `--ease-reveal` | `cubic-bezier(0.22, 1, 0.36, 1)` | Page-reveal regime only (marketing/landing) — see /motion.md |

`--ease-bounce` (`cubic-bezier(0.34, 1.56, 0.64, 1)`) was **deleted** from the tokens in July 2026 (P2): it overshoots, violating principle 2, and had zero consumers. Do not redefine it — use `--ease-spring`.

## Named pattern catalog

All shipped, all token-mapped; copy these rather than inventing new motion.

| Pattern | Recipe | Shipped example |
|---|---|---|
| **enter** | `opacity 0→1` + `translateY(8–16px)→0`, `--duration-enter` `--ease-out` (or `--animate-fade-in` / `--animate-slide-up`) | overlays, toasts |
| **exit** | `opacity 1→0`, `--duration-exit` `--ease-in` (`--animate-fade-out`) | overlays closing |
| **pop** | keyframe `scale(1)→1.08→1`, 450ms `--ease-spring`; optional dissipating ring via box-shadow keyframe | `fac-react-pop` / `fac-react-ring` (facilitator reactions) |
| **live-pulse** | looping `opacity 1→0.35→1`, 2s `--ease-in-out`, on a 6px dot | `fac-live-dot`, `pa-live-dot` (LIVE chips) |
| **progress** | fill as `transform: scaleX(fraction)`, `transform-origin: left`, 300–500ms `--ease-spring` | poll vote bars (facilitator + participant) |
| **nudge-in** | `translateY(14px)+opacity→0`, 450ms `--ease-spring`, once | `pa-nudge-in` (first-poll toast) |
| **reveal** *(page regime)* | `IntersectionObserver` adds `.is-visible`; CSS fades up 16–32px over 0.8–1.2s, stagger 120ms | /motion.md pattern catalog |

Choreography: stagger related micro-motion by 30–50ms (page reveals: 120ms per
/motion.md); one orchestrated moment beats scattered effects; sequences ≤500ms
total in the UI regime.

**What does not animate:** table sorting, text changes, timer digits (they tick,
they don't transition), anything in the facilitator's critical path while a
session runs — a live timer must never wait for an animation.

## Token changes (P1–P4, applied July 3 2026)

| # | Change | Status |
|---|---|---|
| P1 | Reveal regime added: `--ease-reveal: cubic-bezier(0.22, 1, 0.36, 1)`, `--duration-reveal: 800ms`, `--duration-reveal-lg: 1200ms`, `--stagger-reveal: 120ms` — all zeroed under reduced motion | ✅ shipped |
| P2 | `--ease-bounce` **deleted** (zero consumers; `--animate-scale` repointed to `--ease-spring`) | ✅ shipped |
| P3 | `--transition-*` shorthands marked `@deprecated` — new code uses `--duration-* + --ease-*` | ✅ shipped |
| P4 | `--ease-spring` documented as non-overshooting at its definition | ✅ shipped |

Known stray: `css/base/_animations.css` *uses* `var(--ws-ease-bounce)` in the
`ws-bounce-in` shorthand (line 324), but the variable is **defined nowhere in the
repo** — a dangling custom property (the animation falls back to the browser
default timing function). Queued for migration to the **pop** pattern
(`token-audit-2026-07.md` F-item).

## Exceptions

| Exception | Recorded in | Why |
|---|---|---|
| Timer digits update without transitions | this doc | glanceability — a countdown must read instantly |
| `.pa-start__status-icon` spin (loading) persists under reduced motion | participant.css | conveys essential in-progress state (allowed per reduced-motion policy). ⚠️ *Intent only — not implemented:* participant.css has no carve-out for the spin, and its reduced-motion block (line ~1455) targets `.participant-view`, a class absent from `facilitator/participant.php` markup. Needs a code fix. |

## Related

- `/motion.md` — long-form intent, page-reveal patterns, IntersectionObserver recipes
- `token-audit-2026-07.md` F4 — the vocabulary overlap this spec resolves
- `theming.md` — the other themeable axis
