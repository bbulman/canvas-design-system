# WORKSHOPR PLATFORM DESIGN SYSTEM AUDIT & ARCHITECTURAL REPORT
**Author:** Gemini CLI Design-Systems Architect  
**Date:** July 2, 2026  
**Status:** Canonical Audit & Recommendations Document  
**Reference Specification:** `/DESIGN.md`, `/motion.md`, `design-system/platform-tokens.css`

---

## 1. EXECUTIVE SUMMARY

The Workshopr Design System is a mature, high-caliber, in-code design system. Comprising **49 semantic PHP `ws_*` components** (defined in `includes/components/helpers.php`) and a single source of truth for variables (`platform-tokens.css`), it successfully sets a high-end visual tone for the SaaS platform. The inclusion of `check-drift.php` (verifying code vs. JSON schema) and the recently engineered strict git-differential pre-commit linter (`ds-lint.mjs`) provides a solid baseline for preventing design system decay.

However, a thorough audit reveals that **component coverage, token application, localization, and accessibility have diverged significantly from the canonical design documents.** While the atomic design tokens (colors, font families) are solid, the platform suffers from **structural pattern repetition, shadow variable overrides, missing keyboard operability, and localized expansion gaps.**

This report outlines the platform-wide audit findings across **four distinct architectural layers** and provides a roadmap of prioritized recommendations.

---

## 2. THE AUTHORITATIVE HIERARCHY CRITIQUE

The current source-of-truth hierarchy is laid out as follows:
1. `/DESIGN.md` (Brand, voice, UX principles)
2. `/motion.md` (Motion specs, ease-spring)
3. `design-system/platform-tokens.css` (Atomic CSS variables)
4. `/includes/components/helpers.php` (Standard `ws_*` code implementation)
5. `design-system/workshopr-design-system.json` (Convenience JSON mirror)

### The Evaluation
*   **The Strength:** Having `/DESIGN.md` and `/motion.md` as Rank 1 human/AI readable files is highly effective. Linking code directly to tokens prevents hardcoded variables.
*   **The Weakness:** The `workshopr-design-system.json` mirror is hand-maintained. While `check-drift.php` successfully checks that the names of functions in `helpers.php` match the keys in the JSON, it **cannot verify that actual component options, CSS class combinations, or styling boundaries align.** 
*   **Recommendation:** Evolve `check-drift.php` from a basic name-matcher into an AST (Abstract Syntax Tree) validator that parses `helpers.php` docblocks to automatically regenerate parts of `workshopr-design-system.json`, ensuring option-level synchronicity.

---

## 3. ATOMIC TOKEN COMPLIANCE & THE SHADOW TRAP

The atomic tokens defined in `platform-tokens.css` are beautiful (using the Learn Phase Red `#E54D4D`, warm ink `#2C2416`, and cream background `#FEF7F1`). 

### Key Gaps & Drift
*   **Local `:root` Hijacking:** Prior to our high-priority visual patches, core apps like `dna/` and `planner/` re-declared local `:root` variables, hardcoding hex values and local scales. While we patched the most severe regressions, residual custom variables (e.g. `--color-paper: #FAF7F2` or `--color-paper-dark: #F0EBE3` in `css/academy/styles.css` and `planner/index.php`) still isolate those pages from the global theme variables (`--bg-page` and `--bg-page-alt`).
*   **Pixel-Based Sizing Backlog:** While `platform-tokens.css` correctly declares rem-based font sizes (`--text-body: 1rem`, `--text-h1: 2rem`), many layout files still use hardcoded pixel sizes (like `font-size: 15px;` in `.btn` on `planner/index.php`) or declare local pixelscales. This prevents the browser from scaling text cleanly when the root `html { font-size: ... }` changes.
*   **Color-Contrast Compliance (WCAG AA):** The "on-white" phase text variants (e.g., `#C73E3E` for Learn Red, `#0284C7` for Plan Blue) are designed to pass WCAG AA contrast. However, the background tint variables (e.g. `--phase-learn-light` at `#FEE2E2`) are sometimes paired with white text on custom badges, resulting in severe contrast violations (< 1.5:1).

---

## 4. COMPONENT GAP ANALYSIS

Based on the deduped codebase scans from `COMPONENT-GAP-AUDIT-2026-07-01.md` and live structural realities, **Workshopr has a structural hole at the composition layer.** Primitives exist, but composite patterns are constantly hand-rolled.

```
       +---------------------------------------------+
       |           COMPOSITE PATTERNS (The Gap)       |
       |  (Toggles, Filter Bars, Tables, Drawers)     |
       +---------------------------------------------+
                              ↓
       +---------------------------------------------+
       |           PRIMITIVE COMPONENTS              |
       |  (Buttons, Badges, Inputs, Modals, Stats)   |
       +---------------------------------------------+
                              ↓
       +---------------------------------------------+
       |             ATOMIC DESIGN TOKENS            |
       |  (platform-tokens.css: colors, space, type) |
       +---------------------------------------------+
```

### Recommended Component Roadmap

| Component Name | Type | Key Props | Target Location |
|---|---|---|---|
| **`ws_pill` / `ws_tag`** | Primitive | `text`, `variant` (primary|secondary|tint), `size` (sm|md), `color` (phase/neutral) | Replaces custom pill classes in **7 apps** (`detail-pill`, `ae-difficulty-pill`). |
| **`ws_toggle`** | Control | `name`, `checked`, `disabled`, `id`, `label` | Replaces the duplicate `toggle-*` and `launchpad-toggle-*` hand-rolled markup. |
| **`ws_cta_section`** | Composite | `eyebrow`, `title`, `subtitle`, `primary_btn` (array), `secondary_btn` (array), `bg` | Consolidates identical CTA markup on **24 marketing and solutions pages**. |
| **`ws_data_table`** | Layout | `headers` (array), `rows` (matrix), `bulk_actions` (array), `pagination` (bool) | Replaces hand-rolled `<table>` markup across **23 admin pages**. |
| **`ws_filter_bar`** | Composite | `filters` (array), `active_chips` (array), `on_change` | Standardizes user controls above listing grids in Library and MyWorkshopr. |
| **`ws_drawer`** | Container | `title`, `open`, `position` (right|left), `footer_actions` | Consolidates `.coach-drawer` and `.intervention-drawer` into a single reusable layout. |

---

## 5. ACCESSIBILITY AUDIT (WCAG POUR PRINCIPLES)

An evaluation of component rendering and user interaction patterns across the platform revealed several critical accessibility barriers:

### Perceivable (Color & Text Contrast)
*   **Issue (Major):** Light-tint buttons and tags (e.g. `.ws-btn--secondary` and `.wsh-hero__badge`) often pair theme tint backgrounds (like `#FEE2E2` or `#E0F2FE`) with insufficient text contrast (such as white text or light-themed text).
*   **Remediation:** Enforce the rule that text on tint backgrounds **must** use the `-on-white` or dark phase variant (e.g., `#C73E3E` for Learn Red, `#0369A1` for Plan Blue) to guarantee WCAG AA contrast (minimum 4.5:1 ratio).

### Visual Hierarchy & Eye Flow
*   **Issue (`minor issue`):** When error messages or validation states are triggered on forms (e.g., in `dna/quiz.php`), they rely solely on color changes (border turning red).
*   **Remediation:** Under WCAG 2.1, color must not be the sole conveyor of information. Always prefix error messages with an explicit icon (e.g., `error` material symbol) and text label.

### Composition & Keyboard Operability

> **STATUS (July 2, 2026): RESOLVED.** `wsTrapFocus()` / `wsReleaseFocus()` now live in `includes/components/components.js` as a shared utility; `ws_modal` uses it, and the coach panel (`includes/footer/coach-drawer.php`) and intervention drawer (`js/intervention-drawer.js`) are wired with guarded calls.

*   **Issue (Critical):** Custom dialogs and panel overlays (like `.ws-modal` and off-canvas drawers `.coach-drawer`) do not implement **Keyboard Focus Traps**. When a modal is open, pressing `Tab` allows the focus to escape into the background page, rendering the overlay completely inoperable for screen-reader and keyboard-only users.
*   **Remediation:** Integrate a lightweight focus-trap utility inside the global modal script:
    ```javascript
    function trapFocus(element) {
      const focusableEls = element.querySelectorAll('a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), [tabindex="0"]');
      const firstFocusable = focusableEls[0];
      const lastFocusable = focusableEls[focusableEls.length - 1];
      
      element.addEventListener('keydown', function(e) {
        if (e.key === 'Tab') {
          if (e.shiftKey) { // Shift + Tab
            if (document.activeElement === firstFocusable) {
              lastFocusable.focus();
              e.preventDefault();
            }
          } else { // Tab
            if (document.activeElement === lastFocusable) {
              firstFocusable.focus();
              e.preventDefault();
            }
          }
        }
      });
    }
    ```

---

## 6. LOCALIZATION & CULTURAL GRACE

Workshopr is currently positioned as an English-first platform, but the CSS architecture is highly vulnerable to breaking under internationalization (i.e. translating to German, French, or Right-to-Left scripts like Arabic).

### Text Expansion Safety
*   **Issue (Major):** The header navigation menu links, button labels, and bento cards use hardcoded container sizes and narrow flex structures. German and Finnish translations typically expand text by **25% to 40%**. Under this expansion, the current horizontal menu in `index.php` will break its margins and wrap awkwardly into multiple lines, corrupting the layout.
*   **Remediation:** Eliminate fixed pixel widths on UI elements. Transition layout constraints to use flexible intrinsic sizes (`min-width` instead of `width`, `min-height`, and allow flex elements to use `flex-wrap: wrap` where appropriate).

### RTL (Right-to-Left) Mirroring Readiness
*   **Issue (Major):** Styling files extensively use directional physical properties (e.g., `margin-left: 24px;`, `padding-right: 16px;`, `text-align: left;`, `float: left;`). Under RTL locales (Arabic/Hebrew), physical properties do not auto-mirror, causing elements to render in reversed, unaligned collusions.
*   **Remediation:** Transition stylesheets to use **CSS Logical Properties**:
    ```css
    /* PHYSICAL (Physical direction) */
    margin-left: 16px;
    padding-right: 8px;
    text-align: left;

    /* LOGICAL (Logical direction - mirrors automatically with dir="rtl") */
    margin-inline-start: 16px;
    padding-inline-end: 8px;
    text-align: start;
    ```

---

## 7. MOTION SYSTEM SYNTAX AUDIT

The motion parameters in `/motion.md` specify standardized easing functions (like `--ease-spring: cubic-bezier(0.16, 1, 0.3, 1)`) and durations. 

### Key Findings
*   **The Positive:** Easing parameters are highly professional, providing smooth, hardware-accelerated animations on hover and entry states.
> **STATUS (July 2, 2026): RESOLVED.** The global `prefers-reduced-motion` override block below now ships at the end of `design-system/platform-tokens.css`.

*   **The Deficit (Reduced Motion):** While `--transition-fast` and `--transition-base` are declared in `platform-tokens.css`, there is **no global override for prefers-reduced-motion**. Users with vestibular or motion disorders will still experience sliding overlays and bouncing elements, which can cause real physical distress.
*   **Remediation:** Add a global reduced-motion override block directly in the `:root` section of `/design-system/platform-tokens.css`:
    ```css
    @media (prefers-reduced-motion: reduce) {
      :root {
        --transition-fast: 0s !important;
        --transition-base: 0s !important;
        --transition-slow: 0s !important;
        --duration-enter: 0s !important;
        --duration-exit: 0s !important;
        --animate-slide-up: none !important;
        --animate-scale: none !important;
      }
      *, *::before, *::after {
        animation-delay: -1ms !important;
        animation-duration: 1ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0s !important;
        scroll-behavior: auto !important;
      }
    }
    ```

---

## 8. SYSTEM GOVERNANCE & MAINTENANCE

To keep the design system healthy as the platform scales, the contribution and release process must be systematized.

### Governance Model (Hybrid Contribution)
We recommend a **Hybrid Governance Model**:
1.  **Core Foundation:** A core designated owner maintains the global token values (`platform-tokens.css`) and primitive layout specs.
2.  **Federated Features:** Product teams can draft or propose new components. If a product team builds a component that is used in $\ge 2$ places, it is promoted to a global `ws_*` helper.

```
       +---------------------------------------------+
       |   Product Team builds local UI block        |
       +---------------------------------------------+
                              ↓
       +---------------------------------------------+
       |   UI block repeated in second app?          |
       +---------------------------------------------+
               yes (Review & Spec)     no
                      ↓                 ↓
       +-------------------------+   +---------------+
       | Promote to ws_* helper  |   | Keep local UI |
       | (helpers.php + JSON)    |   | in app folder |
       +-------------------------+   +---------------+
```

### Semantic Versioning (SemVer) Contract
The design system must strictly implement **Semantic Versioning** (`MAJOR.MINOR.PATCH`):
*   **PATCH (1.0.x):** Bug fixes, CSS refactorings under the hood, accessibility refinements (no option signature changes).
*   **MINOR (1.x.0):** Introducing a new `ws_*` component helper or adding non-breaking optional arguments to an existing helper.
*   **MAJOR (x.0.0):** Renaming or removing an option from an existing `ws_*` helper, changing default layouts, or altering color tokens.

### Deprecation Policy
When a component or token is scheduled to be retired:
1.  **Release $N$ (Announce):** Add `@deprecated` annotations in `helpers.php` docblocks and log it clearly in the changelog. The component still works but logs a PHP console warning in dev mode.
2.  **Release $N+1$ (Sunset):** Keep the legacy helper intact but map its inner render to the new component.
3.  **Release $N+2$ (Removal):** Completely purge the legacy code from the library.

---

## 9. IMPLEMENTATION PLAN

To move the platform toward total visual maturity, we propose a three-phase execution plan:

### Phase 1: Establish Motion & A11y Anchors (Immediate)
*   Deploy the global `prefers-reduced-motion` override system inside `platform-tokens.css`.
*   Establish focus trapping inside `ws_modal` and drawer templates.

### Phase 2: Build High-Volume Composite Components (Mid-Term)

> **STATUS (July 2, 2026): PARTIALLY DONE.** `ws_pill`, `ws_toggle`, `ws_cta_section`, `ws_filter_bar`, and `ws_how_steps` are shipped (helpers + templates + CSS + JSON + demo pages). Still open: `ws_data_table` and `ws_drawer`. The pre-commit lint gate is wired via `.git/hooks/pre-commit` → `node scripts/ds-lint.mjs --staged` (hook is per-clone; re-create after a fresh clone).

*   Scaffold the Tier 1 gaps: `ws_pill` (for read-only tags), `ws_toggle` (to replace iOS-style checkboxes), and `ws_cta_section` (to unify bottom marketing panels).
*   Integrate the `ws_data_table` component to completely clean up administrative layout grids.

### Phase 3: Total Spacing and Intrinsic Logical Properties Refactoring (Long-Term)
*   Refactor physical layout margins in stylesheets to use logical block/inline selectors (`margin-inline-start`, etc.).
*   Remove remaining hardcoded custom variables in `css/academy/styles.css`.

---
*Report generated successfully by Gemini CLI Design-Systems Enforcer.*