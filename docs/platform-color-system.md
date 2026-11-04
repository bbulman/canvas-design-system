# Workshopr Platform Color Architecture

> **Status:** Current
> **Last synced:** July 2026
> **Canonical source:** `design-system/platform-tokens.css` (values) · `/DESIGN.md` (intent) · `workshopr-design-system.json` (hand-maintained machine mirror, guarded by `check-drift.php`) · hierarchy: `START-HERE.md`

This document explains the *structure* of the color system — the phase abstraction, the deliberate app-level exceptions, and the token naming convention. It does not mirror hex values. Every previous version of this file duplicated per-app hex codes, and those copies drifted out of sync with the CSS five times over. Hex values live in exactly one place now: `platform-tokens.css`. If anything here ever conflicts with that file, the CSS wins.

## Table of Contents

1. [The four-phase system](#the-four-phase-system)
2. [Documented color exceptions](#documented-color-exceptions)
3. [Per-app colors](#per-app-colors)
4. [Shared foundation (quick reference)](#shared-foundation-quick-reference)

---

## The four-phase system

Workshopr's information architecture moves users through four phases: **Learn → Plan → Facilitate → Reflect**. Since the **Red Unification (decision D1, July 2026 — see `token-audit-2026-07.md`)**, phases are a *naming and grouping* system, not a color system: every `--phase-{name}` token in `platform-tokens.css` resolves to the same Learn Red family.

| Phase | Color | Hex | Description |
|-------|-------|-----|-------------|
| **Learn** | Red | `#E54D4D` | Discovery, knowledge, content consumption |
| **Plan** | Red | `#E54D4D` | Building, creating, structuring workshops (naming-only) |
| **Facilitate** | Red | `#E54D4D` | Live sessions, real-time assistance (naming-only) |
| **Reflect** | Red | `#E54D4D` | Growth, renewal, skill development (naming-only) |

The retired per-phase accents (Plan sky blue `#0284C7`, Facilitate purple `#7C4DFF`, Reflect emerald `#10B981`) are **historical** — never restore them. Apps differentiate through category tint ramps, not accent color.

---

## Documented color exceptions

Since Red Unification (D1), there are no per-app accent-color exceptions — every app's `--{app}-primary` is `#E54D4D`. The deliberate non-red survivors are exactly three:

| Survivor | What it is | Why it stays |
|----------|-----------|--------------|
| **Focus ring** (`--focus-ring-color`, sky blue `rgba(2,132,199,0.5)`) | The one intentional non-red accent, platform-wide | Keyboard focus must be unmistakable against an all-red UI (audit D2). Do not "fix" it. |
| **Tips category tints** (`--tips-cat-1..6`) | An actual purple tint scale for tip categories | Category differentiation, not a brand/phase accent |
| **Facilitator `--fac-purple*` aliases** | Legacy *names* whose values resolve to red | Kept so old CSS keeps working; the values are red |

`scripts/ds-lint.mjs` flags any blue/purple/emerald signature hex in app CSS as `wrong-phase`.

**Rule of thumb:** every phase token and every `--{app}-primary` is red. Always check `platform-tokens.css` for current values, never a written table — and never reintroduce a retired accent (including Podcasts' old crimson `#BE123C`, which no longer exists in the token file).

---

## Per-app colors

Hex values are **not** listed here — read them from `platform-tokens.css`, which defines a consistent token set per app:

```
--{app}-primary      Main brand color
--{app}-dark         Darker variant (hover, gradients)
--{app}-light        Light variant (backgrounds, highlights)
--{app}-very-light   Very light variant (subtle backgrounds)
--{app}-gradient     Standard gradient
--{app}-shadow       Colored shadow
--{app}-cat-{n}      Category-specific tints (numbered, dark→light)
```

Apps with this token set include: `mainsite`, `tips`, `podcasts`, `planner`, `coach`, `facilitator`, `intervention`, `dna`, `training`. Some apps also define mode- or category-specific tint scales (e.g. `--coach-mode-*`, `--intervention-cat-*`, `--dna-cat-*`, `--tips-cat-*`) — search `platform-tokens.css` for the app prefix to see its full set.

Before touching any app's color, grep `platform-tokens.css` for `--{app}-` rather than trusting a written table — that file is regenerated/edited directly and is always current.

---

## Shared foundation (quick reference)

These tokens are stable and shared across all apps. Listed here as a convenience — **`platform-tokens.css` is authoritative if this ever differs.**

**Ink palette (warm near-black):**
```css
--color-ink: #2C2416;           /* Primary text */
--color-ink-secondary: #5C5242; /* Secondary text */
--color-ink-muted: #78716C;     /* Muted text */
--color-ink-faint: #A8A29E;     /* Faint/disabled text */
```

**Backgrounds:**
```css
--bg-page: #FEF7F1;      /* Warm cream page background */
--bg-page-alt: #FFFBF8;  /* Slightly lighter alternative */
--bg-surface: #FFFFFF;   /* Cards, panels */
--bg-muted: #F5F5F4;     /* Subtle gray backgrounds */
--bg-subtle: #FAFAF9;    /* Very subtle backgrounds */
```

**Gray scale — warm Stone (Tailwind Stone palette; warm grays, not cool blue-grays):**
```css
--gray-50: #FAFAF9;   --gray-500: #78716C;
--gray-100: #F5F5F4;  --gray-600: #57534E;
--gray-200: #E7E5E4;  --gray-700: #44403C;
--gray-300: #D6D3D1;  --gray-800: #292524;
--gray-400: #A8A29E;  --gray-900: #1C1917;
```

**Semantic colors:**
```css
--color-success: #22C55E;  --color-success-dark: #16A34A;
--color-warning: #F59E0B;  --color-warning-dark: #D97706;
--color-error: #EF4444;    --color-error-dark: #DC2626;
--color-info: #3B82F6;     --color-info-dark: #2563EB;
```
Each also has `-light` and `-very-light` variants in `platform-tokens.css`.

**Navy (headers, dark UI):**
```css
--color-navy: #1A2744;
--color-navy-light: #2E3D5C;
```

**Typography families:**
```css
--font-heading: 'Fraunces', Georgia, serif;            /* H1-H3, display text */
--font-body: 'Inter', -apple-system, ..., sans-serif;   /* H4, body, UI text */
```

**Shadows:**
```css
--shadow-xs: 0 1px 2px rgba(0, 0, 0, 0.04);
--shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.06);
--shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07);
--shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.08);
--shadow-xl: 0 20px 25px rgba(0, 0, 0, 0.10);
```

**Border radius:**
```css
--radius-sm: 4px;   --radius-lg: 8px;    --radius-2xl: 16px;
--radius-md: 6px;   --radius-xl: 12px;   --radius-full: 9999px;
```
