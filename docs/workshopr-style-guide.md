# Workshopr Design System

> The long-form written spec for building consistent, high-quality UI across every Workshopr app.
> **`/DESIGN.md` (repo root) is the rank-1 canonical design mandate; this document is the rank-4 deep-dive** — see `design-system/START-HERE.md` for the hierarchy. Where they differ, `DESIGN.md` and `platform-tokens.css` win.
> Source of truth for token values: `/design-system/platform-tokens.css`

**Last updated:** July 2026
**Status:** Current · **Canonical value source:** `design-system/platform-tokens.css` · **Canonical intent source:** `/DESIGN.md`

---

## Table of Contents

1. [Design Philosophy](#design-philosophy)
2. [Platform Architecture](#platform-architecture)
3. [Color System](#color-system)
4. [Typography](#typography)
5. [Spacing & Layout](#spacing--layout)
6. [Elevation & Depth](#elevation--depth)
7. [Border Radius](#border-radius)
8. [Components](#components)
9. [Patterns & Templates](#patterns--templates)
10. [Icons & Animation](#icons--animation)
11. [Accessibility](#accessibility)
12. [App Theming](#app-theming)
13. [File Reference](#file-reference)
14. [Known Issues & Migration Notes](#known-issues--migration-notes)

---

## Design Philosophy

Workshopr's design sits at the intersection of **warmth** and **professionalism**. We build tools for facilitators -- people who guide human connection -- so the interface must feel approachable, supportive, and alive without being playful or casual.

### Design Direction: Warmth & Approachability

We chose this direction because:

- **Our users are people-people.** Facilitators value human connection. Cold, clinical interfaces feel wrong.
- **Our tools support high-stakes moments.** Live sessions, workshop planning, and coaching require confidence and clarity.
- **We're a multi-app platform.** Visual consistency across 8+ apps requires a strong shared foundation with room for per-app personality.

### Core Principles

| Principle | What It Means | Example |
|-----------|---------------|---------|
| **Warm, not cute** | Use warm neutrals and soft shadows, but keep typography and spacing precise | Ink text (`#2C2416`) instead of pure black; cream backgrounds instead of pure white |
| **Structured, not rigid** | Cards and grids provide order; generous spacing provides breathing room | 12px radius cards, 24px gaps, clear visual hierarchy |
| **Color has meaning** | One unified brand red carries the whole journey (D1, July 2026); accents signal actions and states, and apps differentiate via category tint ramps, never accent color | All four phases render Learn Red `#E54D4D`; the sky-blue focus ring is the one non-red accent |
| **Progressive disclosure** | Show what matters now, reveal complexity on demand | Coach mode tabs, collapsible sections, contextual actions |
| **Consistent surface, varied content** | Cards share the same shell (radius, shadow, padding) but have different internal layouts | Content cards, collection cards, and metric cards all look cohesive |

### What We Don't Do

- **No pure black text.** Always use `--color-ink` (#2C2416) for warmth.
- **No pure white backgrounds** on the page level. Use `--bg-page` (#FEF7F1) or `--bg-page-alt` (#FFFBF8).
- **No decorative gradients.** Gradients are reserved for buttons, headers, and phase indicators.
- **No overshoot animations.** UI micro-motion is smooth and fast (150–300ms, `--ease-out`/`--ease-in`/`--ease-spring` — the spring token is pure deceleration, no bounce). Page reveals follow `/motion.md` (600–1400ms, `--ease-reveal`).
- **No thick borders for decoration.** Use 1px borders or elevation, never 2px+ decorative borders.

---

## Platform Architecture

Workshopr is organized around the facilitator journey. Since July 2026 (Red Unification, decision D1 in `token-audit-2026-07.md`) the phases are a **naming and grouping system, not a color system** — every app renders the same Learn Red family.

```
LEARN → PLAN → FACILITATE → REFLECT      (all render #E54D4D red)
```

### Phase & App Map

| Phase | Rendered Color | Hex | Apps |
|-------|-------------|-----|------|
| **Learn** | Red | `#E54D4D` | Main site, Library, Tips, Podcasts, Academy/Training |
| **Plan** | Red | `#E54D4D` | Planner, MyWorkshopr |
| **Facilitate** | Red | `#E54D4D` | Facilitator (live), Intervention |
| **Reflect** | Red | `#E54D4D` | Coach |
| *Standalone* | Red | `#E54D4D` | DNA, Admin |

### How App Colors Work

Every `--phase-*` and `--<app>-*` primary resolves to the unified red family (`#E54D4D / #C73E3E / #FECACA / #FEE2E2`). The legacy per-phase exceptions (Plan blue, Facilitate purple, Reflect emerald, Podcasts rose, Tips coral) are **retired — never restore them**. Apps differentiate through category tint ramps (Tips' six purple category tints `--tips-cat-1..6`, Coach's four red mode tints, Intervention/DNA red ramps), never through accent color. The one intentional non-red accent platform-wide is the sky-blue focus ring (`--focus-ring-color`). See `theming.md` for the full exception table.

Import the shared token file in any app:
```css
@import '/design-system/platform-tokens.css';
```

Then use app-specific tokens (e.g., `--tips-primary`, `--planner-primary`) for accent colors, while shared tokens handle everything else.

---

## Color System

### Source of Truth

**`/design-system/platform-tokens.css`** is the canonical token file. If this document and the CSS file disagree, the CSS file wins.

### Naming Convention

Tokens follow this pattern:

```
--{scope}-{property}[-{modifier}]

Scope:     color, bg, text, phase, {app-name}
Property:  ink, primary, surface, etc.
Modifier:  dark, light, very-light, secondary, muted, faint
```

**Examples:**
```css
--color-ink               /* Global ink color */
--color-ink-secondary     /* Lighter ink */
--phase-learn             /* Learn phase base */
--tips-primary            /* Tips app accent */
--tips-dark               /* Tips app hover shade */
--bg-page                 /* Page background */
--text-default            /* Default body text */
```

### Standard Suffixes

Use these suffixes consistently across all token scopes. Listed from darkest to lightest:

| Suffix | Meaning | Example |
|--------|---------|---------|
| `-dark` | Darker variant (hover, pressed states) | `--mainsite-dark` |
| *(none)* | Base / primary value | `--mainsite-primary` |
| `-light` | Lighter tint (borders, subtle accents) | `--mainsite-light` |
| `-very-light` | Very light tint (backgrounds, fills) | `--mainsite-very-light` |

For ink/text scale (semantic intensity, not lightness):

| Suffix | Meaning | Example |
|--------|---------|---------|
| *(none)* | Strongest emphasis | `--color-ink` |
| `-secondary` | Standard body text | `--color-ink-secondary` |
| `-muted` | De-emphasized text | `--color-ink-muted` |
| `-faint` | Decorative / disabled only | `--color-ink-faint` |

For backgrounds:

| Suffix | Meaning | Example |
|--------|---------|---------|
| `-page` | Full-page background | `--bg-page` |
| `-page-alt` | Alternate page background | `--bg-page-alt` |
| `-surface` | Card/panel surface (white) | `--bg-surface` |
| `-muted` | Slightly tinted surface | `--bg-muted` |
| `-subtle` | Barely visible differentiation | `--bg-subtle` |

**Avoid:** `-alt` (prefer `-page-alt` only for backgrounds), `-subtle` outside backgrounds, creating new suffixes without adding them here.

### Ink Palette (Text Colors)

The ink palette uses warm near-black tones instead of pure black. The base ink color `#2C2416` has subtle red/brown undertones that create a softer, more approachable feel.

| Token | Hex | Usage | Notes |
|-------|-----|-------|-------|
| `--color-ink` | `#2C2416` | Headings, primary text, strongest emphasis | Warm near-black |
| `--color-ink-secondary` | `#5C5242` | Body text, descriptions | Readable but softer |
| `--color-ink-muted` | `#78716C` | Secondary labels, metadata | Clearly subordinate |
| `--color-ink-faint` | `#A8A29E` | Disabled text, hints, placeholders | Lowest contrast |

**Semantic text aliases** (prefer these in components):

```css
--text-dark:    var(--color-ink);           /* Headlines, strong emphasis */
--text-default: var(--color-ink-secondary); /* Body paragraphs */
--text-muted:   var(--color-ink-muted);     /* Captions, metadata */
--text-faint:   var(--color-ink-faint);     /* Hints, disabled states */
--text-inverse: #FFFFFF;                     /* Text on dark backgrounds */
```

**When to use which:**

| Writing a... | Use |
|--------------|-----|
| Page title or card title | `--text-dark` |
| Body paragraph | `--text-default` |
| Duration badge, meta info | `--text-muted` |
| Placeholder, disabled label | `--text-faint` |
| Text on navy/dark section | `--text-inverse` |

### Background Colors

| Token | Hex | Usage |
|-------|-----|-------|
| `--bg-page` | `#FEF7F1` | Default page background (warm cream) |
| `--bg-page-alt` | `#FFFBF8` | Coach app, alternative page bg |
| `--bg-surface` | `#FFFFFF` | Cards, modals, panels |
| `--bg-muted` | `#F5F5F4` | Subtle section alternates |
| `--bg-subtle` | `#FAFAF9` | Very light differentiation |
| `--bg-paper` | `#FAF7F2` | Tips/Intervention paper texture |
| `--bg-paper-dark` | `#F0EBE3` | Darker paper sections |

### Gray Scale (Warm Stone)

The gray scale uses warm stone tones (not cool blue-grays) to match the ink palette.

| Token | Hex | Usage |
|-------|-----|-------|
| `--gray-50` | `#FAFAF9` | Section backgrounds |
| `--gray-100` | `#F5F5F4` | Chip backgrounds, muted areas |
| `--gray-200` | `#E7E5E4` | Borders, dividers |
| `--gray-300` | `#D6D3D1` | Hover borders |
| `--gray-400` | `#A8A29E` | Placeholder text |
| `--gray-500` | `#78716C` | Secondary text |
| `--gray-600` | `#57534E` | Body text alternative |
| `--gray-700` | `#44403C` | Strong body text |
| `--gray-800` | `#292524` | Headlines alternative |
| `--gray-900` | `#1C1917` | Darkest gray |

### Semantic Status Colors

| Name | Token | Hex | Light | Usage |
|------|-------|-----|-------|-------|
| Success | `--color-success` | `#22C55E` | `#DCFCE7` | Checkmarks, completion |
| Warning | `--color-warning` | `#F59E0B` | `#FEF3C7` | Alerts, caution states |
| Error | `--color-error` | `#EF4444` | `#FEE2E2` | Validation, destructive |
| Info | `--color-info` | `#3B82F6` | `#DBEAFE` | Informational notices |

Each has `-dark`, `-light`, and `-very-light` variants. See `platform-tokens.css` for full values.

### Brand Colors (Main Site)

| Token | Hex | Usage |
|-------|-----|-------|
| `--mainsite-primary` | `#E54D4D` | CTAs, links, primary buttons |
| `--mainsite-dark` | `#C73E3E` | Hover, pressed, gradient endpoint |
| `--mainsite-light` | `#FEE2E2` | Icon backgrounds, highlights |
| `--mainsite-very-light` | `#FEF2F2` | Subtle tint backgrounds |

### Gradients

Gradients follow a consistent `135deg` angle across the platform.

```css
/* Primary (Main site, Live mode).
   The light stop is #D13A3A, not the flat brand #E54D4D: this gradient backs
   the primary button, and white on #E54D4D is 3.82:1, below the AA 4.5:1 bar.
   #D13A3A measures 4.80:1. Flat brand red is unchanged in --mainsite-primary. */
linear-gradient(135deg, #D13A3A 0%, #C73E3E 100%)

/* Navy (Headers, dark sections) */
linear-gradient(135deg, #1A2744 0%, #2E3D5C 100%)

/* Per-app gradients use {app}-gradient tokens */
background: var(--tips-gradient);
background: var(--planner-gradient);
background: var(--coach-gradient);
```

**Rule:** Only use gradients for buttons, section headers, and icon containers. Never for card backgrounds or decorative fills.

---

## Typography

### Font Families

```css
--font-heading: 'Fraunces', Georgia, serif;
--font-body: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
```

| Token | Font | Used For |
|-------|------|----------|
| `--font-heading` | Fraunces | H1, H2, H3 -- page titles, section headers, card titles |
| `--font-body` | Inter | H4, body text, buttons, labels, UI elements |

**Decision rule:** If it names or introduces a section, use Fraunces. If it describes, labels, or instructs, use Inter.

> Visual reference: `/design-system/foundations/typography.php`

### Type Scale

```css
/* Fraunces headings */
--text-display: 2.875rem;   /* 46px -- Hero/landing pages only */
--text-h1: 2rem;             /* 32px -- Page titles */
--text-h2: 1.5rem;           /* 24px -- Section headers */
--text-h3: 1.25rem;          /* 20px -- Card titles, subsections */

/* Inter body */
--text-h4: 1.125rem;         /* 18px -- Subheadings, emphasis */
--text-body: 1rem;            /* 16px -- Paragraphs, default */
--text-small: 0.875rem;       /* 14px -- Meta text, secondary info */
--text-caption: 0.75rem;      /* 12px -- Labels, timestamps, badges */

### Capitalization Rules

- **Page Titles:** Title Case (e.g., "Workshop Facilitation Guide")
- **Buttons:** Title Case (e.g., "Get Started", "Learn More")
- **Category Labels:** Title Case (e.g., "Energize My Group", "Design Thinking")
- **Body Text:** Sentence case
```

### Quick Reference: What Size for What

| Element | Size Token | Font | Weight |
|---------|-----------|------|--------|
| Hero headline | `--text-display` | Fraunces | `700` |
| Page title | `--text-h1` | Fraunces | `700` |
| Section header | `--text-h2` | Fraunces | `700` |
| Card title | `--text-h3` | Fraunces | `600` |
| UI subheading | `--text-h4` | Inter | `600` |
| Body paragraph | `--text-body` | Inter | `400` |
| Button label | `--text-small` to `--text-body` | Inter | `600` |
| Duration/meta badge | `--text-small` | Inter | `500` |
| Timestamp, caption | `--text-caption` | Inter | `500` |

### Font Weights

```css
--font-normal: 400;    /* Body text */
--font-medium: 500;    /* Labels, badges, secondary emphasis */
--font-semibold: 600;  /* Card titles (H3), buttons, subheadings */
--font-bold: 700;      /* Page titles (H1, H2), display text */
```

### Line Heights

```css
--leading-tight: 1.2;     /* Headlines -- compact, punchy */
--leading-snug: 1.35;     /* Card titles, small headings */
--leading-normal: 1.5;    /* Body text -- comfortable reading */
--leading-relaxed: 1.625; /* Long-form content, articles */
```

### Letter Spacing

```css
--tracking-tight: -0.02em;   /* Headlines -- pulls letters together */
--tracking-normal: 0;         /* Body text */
--tracking-wide: 0.025em;     /* Uppercase labels, button text */
```

### Display Text Pattern

The hero/display text uses a distinctive two-part styling:

```html
<h1 class="display-text">Transform Your <em>Facilitation</em></h1>
```

| Part | Style |
|------|-------|
| All text | Bold, Fraunces, `--text-display` |
| First part | `--text-default` color |
| `<em>` part | Italic, `--phase-learn-dark` color, 8px `--phase-learn-light` underline (flush, no gap) |

```css
.display-text {
  font-family: var(--font-heading);
  font-size: var(--text-display);
  font-weight: var(--font-bold);
  line-height: var(--leading-tight);
  letter-spacing: var(--tracking-tight);
  color: var(--text-default);
}

.display-text em {
  font-style: italic;
  color: var(--phase-learn-dark);
  text-decoration: underline;
  text-decoration-color: var(--phase-learn-light);
  text-decoration-thickness: 8px;
  text-underline-offset: 0;
  text-decoration-skip-ink: none;
}
```

### Heading Implementation

```css
h1 { font-family: var(--font-heading); font-size: var(--text-h1); font-weight: var(--font-bold); line-height: var(--leading-tight); letter-spacing: var(--tracking-tight); color: var(--text-dark); }
h2 { font-family: var(--font-heading); font-size: var(--text-h2); font-weight: var(--font-bold); line-height: var(--leading-tight); letter-spacing: var(--tracking-tight); color: var(--text-dark); }
h3 { font-family: var(--font-heading); font-size: var(--text-h3); font-weight: var(--font-semibold); line-height: var(--leading-snug); color: var(--text-dark); }
h4 { font-family: var(--font-body); font-size: var(--text-h4); font-weight: var(--font-semibold); line-height: var(--leading-snug); color: var(--text-dark); }
p  { font-family: var(--font-body); font-size: var(--text-body); font-weight: var(--font-normal); line-height: var(--leading-normal); color: var(--text-default); }
```

---

## Spacing & Layout

### Spacing Scale

Based on a **4px** base unit (defined in `platform-tokens.css`):

| Token | Value | Common Usage |
|-------|-------|--------------|
| `--space-1` | 4px | Icon-to-text gaps |
| `--space-2` | 8px | Tight component padding, inline gaps |
| `--space-3` | 12px | Default gap between related items |
| `--space-4` | 16px | Card internal padding, form field gaps |
| `--space-5` | 20px | Comfortable component padding |
| `--space-6` | 24px | Card padding, container padding, grid gaps |
| `--space-8` | 32px | Section margins, major separation |
| `--space-10` | 40px | Large section padding |
| `--space-12` | 48px | Section gaps on desktop |
| `--space-16` | 64px | Hero section vertical padding |

### Container

```css
max-width: 1120px;    /* --container-max in some legacy files */
padding: 0 24px;

@media (max-width: 768px) {
  padding: 0 20px;
}
```

### Breakpoints

| Name | Value | Target |
|------|-------|--------|
| sm | 480px | Small mobile |
| md | 600px | Large mobile / bottom sheet threshold |
| lg | 768px | Tablet |
| xl | 1024px | Desktop |

### Grid Patterns

```css
/* Content cards: 3 → 2 → 1 columns */
.listing-content-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
}
@media (max-width: 1024px) { grid-template-columns: repeat(2, 1fr); }
@media (max-width: 600px)  { grid-template-columns: 1fr; }

/* Collection cards: 2 → 1 columns */
.listing-collections-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 24px;
}
@media (max-width: 768px) { grid-template-columns: 1fr; }
```

---

## Elevation & Depth

Workshopr uses a **surface color + subtle shadow** approach. Cards sit on slightly tinted backgrounds, with shadows reinforcing the lift.

### Elevation Levels

| Level | Token | Shadow Value | Usage |
|-------|-------|-------------|-------|
| 0 | `--elevation-0` | none | Flat, disabled |
| 1 | `--shadow-xs` | `0 1px 2px rgba(0,0,0,0.04)` | Inputs, subtle lift |
| 2 | `--shadow-sm` | `0 1px 3px rgba(0,0,0,0.06)` | Cards at rest |
| 3 | `--shadow-md` | `0 4px 6px rgba(0,0,0,0.07)` | Cards, panels |
| 4 | `--shadow-lg` | `0 10px 15px rgba(0,0,0,0.08)` | Card hover, dropdowns |
| 5 | `--shadow-xl` | `0 20px 25px rgba(0,0,0,0.10)` | Modals, popovers |

### Colored Shadows (CTAs)

```css
--mainsite-shadow: 0 4px 14px rgba(229, 77, 77, 0.25);
--planner-shadow:  0 4px 14px rgba(229, 77, 77, 0.25);
--coach-shadow:    0 4px 14px rgba(229, 77, 77, 0.25);
/* Each app has an --{app}-shadow token — all red since D1 (July 2026) */
```

### Interactive Elevation Pattern

```css
.card {
  background: var(--bg-surface);
  border-radius: var(--radius-xl);        /* 12px */
  box-shadow: var(--shadow-sm);
  transition: box-shadow 200ms ease, transform 200ms ease;
}

.card:hover {
  box-shadow: var(--shadow-lg);
  transform: translateY(-2px);
}
```

### Focus Rings

The focus ring is **sky blue** (`--focus-ring-color: rgba(2, 132, 199, 0.5)`) — the one deliberate non-red accent on the platform, kept so keyboard focus is unmistakable against the all-red UI (decision D2). Do not "fix" it to red, and do not use per-app tints.

```css
/* Standard focus ring — the same everywhere */
box-shadow: 0 0 0 3px var(--focus-ring-color);
/* Inputs alias it via --input-ring */
```

---

## Border Radius

| Token | Value | Usage |
|-------|-------|-------|
| `--radius-sm` | 4px | Small badges, tiny elements |
| `--radius-md` | 6px | Chips, compact buttons |
| `--radius-lg` | 8px | Buttons and inputs (per DESIGN.md §7), feature icons, tags |
| `--radius-xl` | 12px | Cards |
| `--radius-2xl` | 16px | Large cards, modals |
| `--radius-full` | 9999px | Pills, avatar circles, tab containers |

**Decision rule (from DESIGN.md §7):** buttons and inputs `--radius-lg` (8px), cards `--radius-xl` (12px), modals `--radius-2xl` (16px). (Note: the shipped `.ws-btn` standard/large sizes currently hardcode 10px in `components.css` — a known intent-vs-implementation gap; don't copy the 10px into new work.)

---

## Components

### Buttons

#### Primary Button

```css
.btn-primary {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: 14px 24px;
  background: var(--mainsite-gradient);       /* or app-specific gradient */
  color: var(--text-inverse);
  border: none;
  border-radius: 10px;
  font-family: var(--font-body);
  font-size: 0.9375rem;                       /* 15px */
  font-weight: var(--font-semibold);
  letter-spacing: var(--tracking-wide);
  cursor: pointer;
  transition: all var(--transition-fast);
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 16px rgba(229, 77, 77, 0.3);
}

.btn-primary:active {
  transform: scale(0.98);
}
```

#### Secondary Button

```css
.btn-secondary {
  padding: 14px 24px;
  background: var(--bg-page-alt);
  color: var(--color-navy);
  border: 2px solid var(--color-navy);
  border-radius: 12px;
  font-size: 1rem;
  font-weight: var(--font-semibold);
}

.btn-secondary:active {
  background: var(--color-navy);
  color: var(--text-inverse);
}
```

#### Ghost/Outline Button

For less prominent actions. Uses 1px border, transparent background.

```css
.btn-ghost {
  padding: 10px 16px;
  background: transparent;
  color: var(--text-default);
  border: 1px solid var(--gray-300);
  border-radius: 10px;
  font-size: var(--text-small);
  font-weight: var(--font-medium);
}

.btn-ghost:hover {
  background: var(--gray-50);
  border-color: var(--gray-400);
}
```

### Cards

#### Standard Content Card

```
+--------------------------------------------+
| [Icon]  Title                         NEW  |
|         clock Duration  people Participants|
|                                            |
| Description text that spans two lines      |
| with ellipsis on overflow...               |
|                                            |
| ----------------------------------------- |
| Category Badge                   heart ... |
+--------------------------------------------+
```

```css
.listing-card {
  background: var(--bg-surface);
  border-radius: var(--radius-xl);
  border: 1px solid var(--gray-200);
  padding: 20px;
  transition: all 200ms ease;
  cursor: pointer;
  position: relative;
}

.listing-card:hover {
  box-shadow: var(--shadow-lg);
  transform: translateY(-2px);
}
```

Key sub-elements:
- **Icon container**: 40x40px, `border-radius: 8px`, gradient background per category
- **Title**: 16px, weight 600, `--color-navy`, letter-spacing -0.01em
- **Meta items**: 12px, `--gray-500`, icon 14px
- **Description**: 14px, `--gray-600`, 2-line clamp
- **Footer**: top border `--gray-100`, flex space-between

#### Collection Card

Larger format for curated sets. Same surface treatment, different internals.

- **Icon container**: 56x56px, `border-radius: 12px`
- **Title**: 18px, weight 600
- **Preview items**: pill chips showing contained items
- **Footer**: author avatar + "Explore" CTA

See live component demos at `/design-system/components/component-library.php` (and per-component pages under `/design-system/components/demos/`).

### Inputs

```css
input[type="text"],
input[type="number"],
select,
textarea {
  width: 100%;
  padding: 14px 16px;
  border: 1px solid var(--gray-200);
  border-radius: var(--radius-xl);
  font-family: var(--font-body);
  font-size: 1rem;
  color: var(--text-dark);
  background: var(--bg-surface);
  transition: all var(--transition-fast);
}

/* Focus state */
:focus {
  outline: none;
  border-color: var(--mainsite-primary);     /* or current app's primary */
  box-shadow: 0 0 0 3px var(--mainsite-light);
}

/* Disabled */
:disabled {
  background: var(--gray-50);
  color: var(--gray-400);
  cursor: not-allowed;
}
```

### Chips / Tags

```css
.chip {
  display: inline-flex;
  align-items: center;
  padding: 6px 14px;
  background: var(--gray-100);
  border: 1px solid var(--gray-200);
  border-radius: var(--radius-full);
  font-size: 0.8125rem;                /* 13px */
  font-weight: var(--font-medium);
  color: var(--gray-500);
  cursor: pointer;
  transition: all var(--transition-fast);
}

.chip:hover,
.chip.active {
  background: var(--mainsite-light);
  border-color: var(--mainsite-primary);
  color: var(--mainsite-primary);
}
```

### Tabs

Four variants available. All share the same interaction pattern.

**Standard Tabs** -- underline indicator, used for primary navigation within a page.

**Pill Tabs** -- contained pill shape, used for secondary mode switching (e.g., Coach modes). Container: `--gray-100` background, `border-radius: 100px`, 4px padding.

**Icon Tabs** -- standard tabs with a leading icon and optional count badge.

**Vertical Tabs** -- sidebar navigation, 200px width, 8px border-radius active state.

See full CSS in the component reference.

### Modals

| Size | Max Width | Use Case |
|------|-----------|----------|
| Small | 360px | Confirmations, simple actions |
| Default | 500px | Standard forms, details |
| Large | 640px | Complex forms, settings |
| XL | 800px | Multi-step flows |
| Full | `100vw - 48px` | Image viewers, rich editors |

**Mobile behavior** (below 600px): Modals convert to bottom sheets with:
- Full width, rounded top corners (20px)
- Drag indicator bar (40x4px, centered)
- `transform: translateY()` animation
- Safe area padding for home indicator

### Form Elements

The design system includes:
- **Custom Select/Dropdown** -- styled trigger + positioned menu (never native `<select>` for styled UI)
- **Toggle Switch** -- 44x24px track, 20px thumb, primary color when checked
- **Toggle Button Group** -- pill container with segmented options
- **Checkbox** -- 20x20px, 6px radius, primary fill when checked, icon checkmark
- **Radio Button** -- 20x20px, circle, primary fill with white inner dot
- **Range Slider** -- 8px track, 24px thumb with gradient fill

All form elements have `:focus` states using `box-shadow: 0 0 0 3px {app-light-color}`.

### Floating Action Button

```css
.fab {
  position: fixed;
  bottom: 24px;
  right: 24px;
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background: var(--mainsite-primary);
  color: var(--text-inverse);
  border: none;
  box-shadow: 0 4px 20px rgba(220, 38, 38, 0.4);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 999;
}
```

### Toast Notifications

Dark red background, white text, 12px message. Three implementations exist — always match these specs.

```css
/* Design system toast (ws-toast in components.css) */
.ws-toast {
  padding: 12px 16px;
  background: #7F1D1D;
  color: #FFFFFF;
  border-radius: var(--radius-xl);           /* 12px */
  font-size: var(--text-caption);            /* 12px (action button uses --text-meta, 13px) */
  font-weight: var(--font-medium);           /* 500 */
  box-shadow: var(--shadow-xl);
}

.ws-toast__icon svg { width: 20px; height: 20px; }
.ws-toast__action   { font-size: 13px; }
.ws-toast__close svg { width: 18px; height: 18px; }
```

| Token | Value | Usage |
|-------|-------|-------|
| `--text-caption` | 12px | Toast message text |
| `--text-caption` | 12px | Toast description / secondary text |
| `--radius-xl` | 12px | Toast border radius |
| `z-index` | 1000 | Above FAB (999) |

**Planner override:** The planner uses `.planner-toast-container .ws-toast` to render compact toasts at 10px / 6px 12px padding / 6px radius / 14px icons.

**Files:** `includes/components/components.css` (ws-toast), `css/toast.css` (standalone), `css/planner/planner-new.css` bundle (planner overrides — the old `planner-v2.css` monolith was retired June 2026).

### Component Library (PHP)

The component library provides reusable PHP functions for consistent UI rendering.

#### Setup

```php
// Include in your page
require_once 'includes/components/helpers.php';

// Add CSS to header.php
<link rel="stylesheet" href="/includes/components/components.css">
```

#### Badge (ws_badge)

```php
// Basic
<?= ws_badge('Label') ?>

// Duration badge with icon
<?= ws_badge('45 min', ['variant' => 'duration', 'icon' => 'schedule']) ?>

// Category badge with custom color
<?= ws_badge('Ideation', ['variant' => 'category', 'color' => '#F59E0B']) ?>

// Status badges
<?= ws_status('Complete', 'success') ?>
<?= ws_status('Pending', 'warning') ?>
<?= ws_status('Failed', 'error') ?>

// Convenience functions
<?= ws_duration('45 min') ?>
<?= ws_category('Strategy', '#3B82F6') ?>
```

**Variants:** `default`, `duration`, `category`, `status`, `count`, `new`
**Sizes:** `sm`, `md`, `lg`

#### Button (ws_button)

```php
// Variants
<?= ws_button('Primary', ['variant' => 'primary']) ?>
<?= ws_button('Secondary', ['variant' => 'secondary']) ?>
<?= ws_button('Ghost', ['variant' => 'ghost']) ?>
<?= ws_button('Danger', ['variant' => 'danger']) ?>

// With icons
<?= ws_button('Add', ['variant' => 'primary', 'icon' => 'add']) ?>
<?= ws_button('Next', ['icon' => 'arrow_forward', 'iconPosition' => 'right']) ?>

// As link
<?= ws_button('View', ['variant' => 'primary', 'href' => '/workshops']) ?>

// States
<?= ws_button('Disabled', ['disabled' => true]) ?>
<?= ws_button('Loading', ['loading' => true]) ?>
```

**Variants:** `primary`, `secondary`, `ghost`, `danger`
**Sizes:** `sm`, `md`, `lg`

#### Input (ws_input)

```php
// Basic
<?= ws_input('name', ['label' => 'Name', 'placeholder' => 'Enter name...']) ?>

// With icon
<?= ws_input('search', ['label' => 'Search', 'icon' => 'search']) ?>

// Select
<?= ws_input('category', [
    'type' => 'select',
    'label' => 'Category',
    'options' => ['ideation' => 'Ideation', 'strategy' => 'Strategy']
]) ?>

// Textarea
<?= ws_input('notes', ['type' => 'textarea', 'label' => 'Notes', 'rows' => 4]) ?>

// Validation states
<?= ws_input('email', ['state' => 'error', 'error' => 'Invalid email']) ?>
<?= ws_input('email', ['state' => 'success', 'helper' => 'Email verified']) ?>
```

#### Card (ws_card)

```php
// Using start/end functions
<?php ws_card_start(['variant' => 'content', 'hoverable' => true]); ?>
  <h3>Card Title</h3>
  <p>Card content here</p>
<?php ws_card_end(); ?>

// As link
<?php ws_card_start(['hoverable' => true, 'href' => '/detail']); ?>
  Content
<?php ws_card_end(); ?>

// Using inline function
<?= ws_card('<p>Content</p>', ['variant' => 'content']) ?>
```

**Variants:** `content`, `feature`, `compact`, `flush`
**Modifiers:** `hoverable`, `elevated`, `bordered`

#### Chip Input (ws_chip_input)

Multi-value input where each entry appears as a removable chip/token. Used for email lists, tag inputs, and attendee fields.

```php
// Email attendee input
<?= ws_chip_input('attendees', [
    'label' => 'Attendees',
    'placeholder' => 'Enter email address',
    'type' => 'email',
    'addIcon' => 'person_add',
    'addText' => 'Add',
]) ?>

// Tag input (no label)
<?= ws_chip_input('tags', [
    'placeholder' => 'Add tag...',
    'addIcon' => 'add',
]) ?>
```

**Params:** `label`, `placeholder`, `type` (email|text), `addIcon`, `addText`, `id`, `class`
**Chip markup:** JS renders `<div class="ws-chip"><span>value</span><button class="ws-chip__remove">...</button></div>` into the `__list` container.

#### Radio Card Group (ws_radio_card_group)

Selectable card grid where only one card can be active. Each card has an icon, title, and description. Used for single-choice selections like workshop format or difficulty level.

```php
<?= ws_radio_card_group('format', [
    ['value' => 'in-person', 'icon' => 'groups', 'label' => 'In-Person', 'desc' => 'Face-to-face workshop'],
    ['value' => 'remote', 'icon' => 'videocam', 'label' => 'Remote', 'desc' => 'Virtual workshop'],
    ['value' => 'hybrid', 'icon' => 'hub', 'label' => 'Hybrid', 'desc' => 'Mixed format'],
], ['selected' => 'remote', 'columns' => 3]) ?>
```

**Params:** `$name` (field name), `$items` (array of `value`/`icon`/`label`/`desc`), `selected`, `columns` (2|3|4), `class`

#### Checkbox Card Group (ws_checkbox_card_group)

Multi-select card grid — same visual pattern as Radio Card Group but allows multiple selections. Used for multi-choice inputs like skills or goals.

```php
<?= ws_checkbox_card_group([
    ['value' => 'ideation', 'icon' => 'lightbulb', 'label' => 'Ideation', 'desc' => 'Generate new ideas'],
    ['value' => 'strategy', 'icon' => 'target', 'label' => 'Strategy', 'desc' => 'Plan and align'],
], ['columns' => 2]) ?>
```

**Params:** `$items` (array of `value`/`icon`/`label`/`desc`), `selected` (array), `columns`, `class`

#### Suggestion Card (ws_suggestion_card)

Action-oriented card used for AI suggestions, recommendations, or contextual prompts. Has icon, title, description, and action button.

```php
<?= ws_suggestion_card([
    'icon' => 'lightbulb',
    'title' => 'Try a Warm-Up',
    'description' => 'Start with an icebreaker to energize the group.',
    'actionText' => 'Add Icebreaker',
    'actionIcon' => 'add',
    'variant' => 'highlighted',
]) ?>
```

**Variants:** `default`, `highlighted`, `compact`
**Params:** `icon`, `title`, `description`, `actionText`, `actionIcon`, `actionId`, `variant`, `class`

#### Modal Footer (ws_modal_footer)

Standardized footer bar for modals with primary/secondary actions. Handles alignment, spacing, and responsive layout consistently.

```php
<?= ws_modal_footer([
    'primary' => ['text' => 'Save', 'icon' => 'check'],
    'secondary' => ['text' => 'Cancel'],
]) ?>

// With danger action
<?= ws_modal_footer([
    'primary' => ['text' => 'Delete', 'icon' => 'delete', 'variant' => 'danger'],
    'secondary' => ['text' => 'Cancel'],
    'align' => 'right',
]) ?>
```

**Params:** `primary` (text/icon/variant/id), `secondary` (text/id), `align` (left|right|space-between), `class`

#### Activity Badge (ws_activity_badge)

Colored badge indicating activity type — exercise, icebreaker, or break. Uses the planner's activity color system.

```php
<?= ws_activity_badge('exercise') ?>
<?= ws_activity_badge('icebreaker', ['size' => 'lg']) ?>
<?= ws_activity_badge('break', ['showLabel' => true]) ?>
```

**Types:** `exercise` (orange), `icebreaker` (purple), `break` (gray)
**Params:** `$type`, `size` (sm|md|lg), `showLabel` (bool), `class`

#### Results Overlay (ws_results_overlay)

Full-screen or inline overlay for showing results, scores, or completion states. Used for quiz results, DNA profiles, and post-workshop summaries.

```php
<?= ws_results_overlay([
    'icon' => 'emoji_events',
    'title' => 'Workshop Complete!',
    'variant' => 'success',
    'listId' => 'results-list',
    'buttonText' => 'View Summary',
    'buttonId' => 'view-summary-btn',
]) ?>
```

**Variants:** `default`, `success`, `info`
**Params:** `icon`, `title`, `variant`, `listId`, `buttonId`, `buttonText`, `class`

---

## Patterns & Templates

### Page Background Patterns

```css
/* Warm cream (default for main site) */
body { background: var(--bg-page); }

/* Paper texture (Tips, Intervention, Podcasts) */
.bg-paper { background: #FAF7F2; }

/* Grid paper overlay (field notes aesthetic) */
.bg-pattern-grid {
  background-image:
    linear-gradient(rgba(44, 36, 22, 0.12) 1px, transparent 1px),
    linear-gradient(90deg, rgba(44, 36, 22, 0.12) 1px, transparent 1px);
  background-size: 24px 24px;
}

/* Dot pattern (subtle texture) */
.bg-pattern-dots {
  background-image: radial-gradient(circle, rgba(26, 39, 68, 0.08) 1px, transparent 1px);
  background-size: 16px 16px;
}
```

### Section Variants

| Class | Background | Text | Usage |
|-------|-----------|------|-------|
| `.section-light` | `#FFFFFF` | Default | Standard content sections |
| `.section-alt` | `--gray-50` | Default | Alternating sections |
| `.section-dark` | `#2C2416` (Ink) | White | Footers, feature sections |
| `.section-navy` | Navy gradient | White | Coach headers, CTAs |
| `.section-accent-green` | `#D1FAE5` | Default | Podcast hosts, success |
| `.section-accent-amber` | `#FEF3C7` | Default | Tips subscribe, alerts |

### Standard Page Template

```php
<?php
$page_title = 'Page Title';
require_once 'includes/data.php';
require_once 'includes/header.php';
?>

<div class="container">
  <h1>Page Title</h1>
  <!-- content -->
</div>

<?php require_once 'includes/footer.php'; ?>
```

### Category Icon Gradients

Content cards use gradient-filled icon containers per category:

| Category | Gradient |
|----------|----------|
| Ideation / Energizer / Planning | `#F59E0B -> #D97706` (Amber) |
| Strategy / Sprint / Introduction | `#3B82F6 -> #2563EB` (Blue) |
| Team / Team Building / Alignment | `#10B981 -> #059669` (Green) |
| Design / Discovery / Creative | `#8B5CF6 -> #7C3AED` (Purple) |
| Feedback / Retrospective | `#EC4899 -> #DB2777` (Pink) |
| Remote / Innovation | `#06B6D4 -> #0891B2` (Cyan) |
| Default | `#E54D4D -> #C73E3E` (Brand Red) |

---

## Icons & Animation

### Icons

**Source**: Material Symbols Outlined (Google)

```html
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

<span class="material-symbols-outlined">favorite</span>
```

Common sizes: 14px (inline meta), 16px (badges), 18px (tabs), 20px (card icons), 24px (default), 28-32px (feature icons)

### Transitions

```css
--transition-fast: 150ms ease;     /* Buttons, chips, toggles */
--transition-base: 200ms ease;     /* Cards, general hover */
--transition-slow: 300ms ease;     /* Modals, panels, overlays */
```

Use `cubic-bezier(0.4, 0, 0.2, 1)` for modal/panel open animations.

### Keyframe Animations

| Animation | Usage | Duration |
|-----------|-------|----------|
| `pulse` | FAB attention ring | 2s infinite |
| `spin` | Loading spinners | 1s linear infinite |
| `slideUp` | Bottom sheet modals | 300ms |
| `fadeScale` | Centered modals | 200ms |
| `slideFromRight` | Side panels | 300ms |
| `typing` | Chat typing indicator (3 dots) | 1.2s |

---

## Accessibility

| Requirement | Implementation |
|-------------|----------------|
| Color contrast | WCAG AA (4.5:1 for normal text, 3:1 for large text) |
| Focus visibility | `box-shadow: 0 0 0 3px {app-light-color}` on all interactive elements |
| Touch targets | Minimum 44x44px on mobile |
| Form labels | All inputs have associated `<label>` elements |
| Icon semantics | Standalone icons have `aria-label`; decorative icons have `aria-hidden="true"` |
| Motion | UI transitions under 300ms; no overshoot effects (`--ease-spring` is fine — it's pure deceleration); respect `prefers-reduced-motion` |
| iOS safe areas | `env(safe-area-inset-top)` and `env(safe-area-inset-bottom)` on fixed elements |

---

## App Theming

Each app overrides a small set of accent tokens while sharing the full foundation. The blocks below are a convenience copy — **`platform-tokens.css` is authoritative and `theming.md` documents the aliasing pattern and exception table**; if this section ever disagrees with them, they win.

### Learn Phase Apps

#### Main Site (`workshopr.io`)

```css
--mainsite-primary: #E54D4D;
--mainsite-dark: #C73E3E;
--mainsite-light: #FEE2E2;
--mainsite-very-light: #FEF2F2;
--mainsite-gradient: linear-gradient(135deg, #D13A3A 0%, #C73E3E 100%);
--mainsite-shadow: 0 4px 14px rgba(229, 77, 77, 0.25);
```

#### Tips (`/tips`)

Unified red since Red Unification (D1, July 2026) — the old purple primary is retired. The **category tints remain purple by design** (they are content differentiation, not a brand accent). Uses paper background + grid pattern.

```css
--tips-primary: #E54D4D;
--tips-dark: #C73E3E;
--tips-light: #FECACA;
--tips-very-light: #FEE2E2;
--tips-gradient: linear-gradient(135deg, #E54D4D 0%, #C73E3E 100%);
--tips-shadow: 0 4px 14px rgba(229, 77, 77, 0.25);

/* 6 category tints (purple, darkest to lightest — intentional survivors) */
--tips-cat-1: #4527A0;  /* Fundamentals */
--tips-cat-2: #5E35B1;  /* Engagement */
--tips-cat-3: #6930C3;  /* Facilitation */
--tips-cat-4: #7C4DFF;  /* Difficult Moments */
--tips-cat-5: #9575CD;  /* Activities */
--tips-cat-6: #B39DDB;  /* Reflection */
```

#### Podcasts (`/podcasts`)

Unified red since Red Unification (D1, July 2026) — the old crimson/rose (`#BE123C`) is retired. Audio studio aesthetic; external platform brand colors stay as-is (they're third-party logos).

```css
--podcasts-primary: #E54D4D;
--podcasts-dark: #C73E3E;
--podcasts-light: #FECACA;
--podcasts-very-light: #FEE2E2;
--podcasts-gradient: linear-gradient(135deg, #E54D4D 0%, #C73E3E 100%);
--podcasts-shadow: 0 4px 14px rgba(229, 77, 77, 0.25);

/* Platform brand colors */
--podcasts-spotify: #1DB954;
--podcasts-apple: #FC3C44;
--podcasts-amazon: #FF9900;
--podcasts-youtube: #FF0000;
```

### Plan Phase Apps

#### Planner (`/planner`)

Red (was plan-blue until June 2026; since Red Unification `--phase-plan` itself is also `#E54D4D`).

```css
--planner-primary: #E54D4D;
--planner-dark: #C73E3E;
--planner-light: #FEE2E2;
--planner-very-light: #FEF2F2;
--planner-accent: #FEF2F2;
--planner-gradient: var(--mainsite-gradient);
--planner-shadow: 0 4px 14px rgba(229, 77, 77, 0.25);
```

### Facilitate Phase Apps

#### Coach (`/coach`) — Reflect phase

Unified red since Red Unification (D1, July 2026) — the old purple family is retired. The mode system is a **red tint ramp**.

```css
--coach-primary: #E54D4D;
--coach-dark: #C73E3E;
--coach-light: #FECACA;
--coach-very-light: #FEE2E2;
--coach-gradient: linear-gradient(135deg, #E54D4D 0%, #C73E3E 100%);
--coach-shadow: 0 4px 14px rgba(229, 77, 77, 0.25);

/* Mode colors (4 red tints) */
--coach-mode-prep: #F87171;        /* Lightest -- planning */
--coach-mode-facilitate: #EF4444;  /* Active session */
--coach-mode-synthesize: #DC2626;  /* Processing */
--coach-mode-debrief: #B91C1C;     /* Deepest reflection */

/* Shared Coach UI */
--coach-bg: #FFFBF8;
--coach-surface: #FFFFFF;
--coach-border: #E8ECF1;
```

**Legacy mode tokens** (historical — no longer referenced in `coach/` as of July 2026; do not reintroduce):
```css
--coach-prep-primary: #3B7DD8;     /* retired blue prep mode */
--coach-live-primary: #E54D4D;     /* red live mode */
--coach-reflect-primary: #7C4DFF;  /* retired purple reflect mode */
```

#### Intervention (`/intervention`)

Unified red (like everything else since D1 — the pre-2026 "exception" framing is obsolete; red is simply the platform color). Uses paper background + grid pattern.

```css
--intervention-primary: #E54D4D;
--intervention-dark: #C73E3E;
--intervention-light: #FEE2E2;
--intervention-very-light: #FEF2F2;
--intervention-gradient: linear-gradient(135deg, #E54D4D 0%, #C73E3E 100%);
--intervention-shadow: 0 4px 14px rgba(229, 77, 77, 0.25);

/* 6 category tints (red, darkest to lightest) */
--intervention-cat-1: #7F1D1D;  /* Energy & Engagement */
--intervention-cat-2: #991B1B;  /* Conflict & Tension */
--intervention-cat-3: #B91C1C;  /* Participation */
--intervention-cat-4: #C73E3E;  /* Time & Pacing */
--intervention-cat-5: #E54D4D;  /* Focus & Clarity */
--intervention-cat-6: #F87171;  /* Connection & Trust */
```

### Reflect Phase & Standalone Apps

#### DNA (`/dna`) — standalone (unphased)

Red (was reflect-emerald until June 2026; since Red Unification `--phase-reflect` itself is also `#E54D4D`). 5 category tints (red ramp).

```css
--dna-primary: #E54D4D;
--dna-dark: #C73E3E;
--dna-light: #FCA5A5;
--dna-very-light: #FEE2E2;
--dna-gradient: linear-gradient(135deg, #E54D4D 0%, #C73E3E 100%);
--dna-shadow: 0 4px 14px rgba(229, 77, 77, 0.25);

/* 5 category tints */
--dna-cat-1: #7F1D1D;  /* Strengths */
--dna-cat-2: #B91C1C;  /* Growth Areas */
--dna-cat-3: #C73E3E;  /* Style */
--dna-cat-4: #E54D4D;  /* History */
--dna-cat-5: #FCA5A5;  /* Goals */
```

#### Training (`/academy`) — Learn phase (red)

```css
--training-primary: #E54D4D;
--training-dark: #C73E3E;
--training-light: #FEE2E2;
--training-very-light: #FEF2F2;
--training-gradient: linear-gradient(135deg, #E54D4D 0%, #C73E3E 100%);
--training-shadow: 0 4px 14px rgba(229, 77, 77, 0.25);
```

### Z-Index Scale

```css
--z-dropdown: 100;
--z-sticky: 200;
--z-overlay: 1000;          /* generic overlays / scrims */
--z-header: 1100;           /* unified header / sticky topbars */
--z-modal-backdrop: 1100;
--z-modal: 1200;
--z-tooltip: 1300;
--z-dialog: 10000;          /* system dialogs (highest band) */
```

**Rule:** FAB uses `z-index: 999` (below `--z-overlay`).

---

## File Reference

### Design System Files

| File | Purpose |
|------|---------|
| `design-system/platform-tokens.css` | **Source of truth** -- all CSS custom properties |
| `design-system/docs/workshopr-style-guide.md` | This document |
| `design-system/docs/platform-color-system.md` | Color architecture reference |
| `design-system/workshopr-design-system.json` | Machine-readable token export |
| `design-system/foundations/typography.php` | Live typography demo |
| `design-system/foundations/colors.php` | Live color system demo |
| `design-system/components/component-library.php` | Live component library index |
| `design-system/components/demos/*.php` | Per-component demo pages |
| `design-system/index.php` | Design system dashboard page |

### Component Library Files

| File | Purpose |
|------|---------|
| `includes/components/helpers.php` | Helper functions for inline component rendering |
| `includes/components/components.css` | All component CSS styles |
| `includes/components/badge.php` | Badge component (ws-badge) |
| `includes/components/button.php` | Button component (ws-btn) |
| `includes/components/input.php` | Input/form field component (ws-input) |
| `includes/components/card.php` | Card component (ws-card) |

### App Stylesheets

| App | File |
|-----|------|
| Main Site | `/styles.css` |
| Listing Pages | `/css/listing-redesign.css` |
| Planner | `/planner/css/planner-new.css` (modular, imports `base/_variables.css` → `platform-tokens.css`) |
| Coach | `/coach/css/app.css` |
| Intervention | `/intervention/styles.css` |
| Tips | `/css/tips/styles.css` |
| Podcasts | `/podcasts/styles.css` |
| Training | `/academy/style.css` |

---

## Known Issues & Migration Notes

*Last reviewed: July 2026 (documentation-consistency pass — app-color blocks reconciled to the Red Unification, D1)*

### Resolved (Feb 2026)

The following inconsistencies have been fixed across all documentation files:
- `platform-color-system.md` is a lean color-architecture pointer doc; `platform-tokens.css` is authoritative for hex values
- `workshopr-design-system.json` regenerated from `platform-tokens.css` (v2.0.0)
- Ink naming, gray scale, semantic colors, shadow values, and border radius all aligned

### Legacy Token Aliases

These older tokens appear in existing code and map to current tokens. Migrate when touching these files:

```
--color-primary       → --mainsite-primary
--color-primary-dark  → --mainsite-dark
--color-primary-light → --mainsite-light
--text-primary        → --text-dark (avoid; ambiguous — had two conflicting defs)
--text-secondary      → --text-default or --text-muted (context-dependent)
--font-family         → --font-body
--border-default      → Use --gray-200
--border-light        → Use --gray-200
```

### Cool Gray Legacy

Some legacy CSS files still use Tailwind's cool gray palette (`#F3F4F6`, `#E5E7EB`, `#6B7280`) instead of the warm stone grays in `platform-tokens.css` (`#F5F5F4`, `#E7E5E4`, `#78716C`). These should be migrated opportunistically when modifying those files.

### App-Specific Font Overrides

As of v1.7, Tips, Intervention, and Podcasts use the platform fonts (Fraunces + Inter). Their per-app CSS files still expose display/body aliases for historical reasons:
```css
--font-display: 'Fraunces', Georgia, serif;                     /* Display text */
--font-body: 'Inter', -apple-system, BlinkMacSystemFont, ...;   /* Body text */
```

These alias the canonical platform fonts rather than overriding them. The remaining holdout is Academy/Training, which still declares Bitter + DM Sans in `academy/training/index.php` — see `/design-system/docs/ADOPTION.md` for current status.
