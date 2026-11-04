**Status:** Current
**Last updated:** July 2026
**Canonical source:** this file governs DS doc structure

# Documentation Templates

This file gives you copy-paste templates for documenting Workshopr design-system artifacts — components, patterns, and foundations. Use them so every doc/page in `/design-system` looks and reads the same way, no matter who wrote it. When you start a new DS doc, copy the matching template below, fill it in, and don't invent a different structure.

## Shared conventions

Every DS doc follows these rules, regardless of which template it uses:

1. **Standard header block at the top.** Every doc opens with three lines before anything else:
   ```
   **Status:** Current / Draft / Deprecated
   **Last updated:** Month YYYY
   **Canonical source:** which file is authoritative for this content
   ```
   If the doc itself is the canonical source, say so explicitly (as this file does above).

2. **One H1, then `##` sections.** Each doc has exactly one `# Title` at the top. Everything below it is `##` (or `###` for sub-splits within a section). Don't skip levels, and don't use multiple H1s.

3. **Table of Contents for anything over ~150 lines.** If the doc runs long, add a `## Contents` section right after the header block and intro paragraph, linking to each `##` section. Skip it for short docs — it's just noise below ~150 lines.

4. **Tables for comparisons, code alongside visuals/usage.** When you're contrasting options (sizes, variants, do/don't), use a Markdown table rather than prose. When you show a code snippet, pair it with what it produces or when to reach for it — don't paste code in isolation.

5. **Second person, lead with the important stuff.** Write "you" — "you should," "you can," "call this when." Put the most important fact in the first sentence of every section, not buried at the end of a paragraph.

6. **Status indicators for maturity.** Mark components/patterns with 🟢 Stable, 🟡 Beta, or 🔴 Deprecated (words are fine too: "Stable" / "Beta" / "Deprecated"). Put this next to the title, not just in the header block, so it's visible when scanning.

---

## Template A — Component doc (for `ws_*` components)

Use this for anything documented in `design-system/components/demos/*.php` or the component library.

```markdown
**Status:** Current
**Last updated:** Month YYYY
**Canonical source:** includes/components/helpers.php (ws_componentName)

# ws_componentName

🟢 Stable

One sentence on what this component is and the single job it does.

## When to use

- Bullet the situations where this is the right choice.
- Bullet what to use instead when it isn't (link the alternative component).

## Example

\`\`\`php
<?php echo ws_componentName([
    'label' => 'Example',
    'variant' => 'primary',
]); ?>
\`\`\`

Show the rendered result (screenshot or description) right next to the code.

## Anatomy

Describe the visual parts (e.g. icon, label, container) and how they relate — a numbered list or small diagram.

## Variants

| Variant | Use case |
| --- | --- |
| `primary` | ... |
| `secondary` | ... |

## Props / params

| Param | Type | Default | Description |
| --- | --- | --- | --- |
| `label` | string | — | ... |
| `variant` | string | `primary` | ... |

## States

| State | Notes |
| --- | --- |
| Default | ... |
| Hover | ... |
| Focus | ... |
| Active | ... |
| Disabled | ... |
| Loading | ... |
| Error | ... |

## Accessibility

- **Roles:** ARIA role(s) used and why.
- **Keyboard:** tab order, key handlers (Enter/Space/Esc), focus trapping if any.
- **Contrast:** confirm text/icon contrast meets the token-defined minimum.

## Content guidelines

Voice/length rules for any text this component renders (labels, helper text, error copy).

## Tokens used

List the CSS variables this component consumes (colors, spacing, radii, shadows) — link back to `platform-tokens.css`.

## Related components

Link the components you'd reach for instead, or that commonly pair with this one.

## Changelog

| Date | Change |
| --- | --- |
| Month YYYY | Initial version |
```

---

## Template B — Pattern doc

Use this for cross-component UX patterns (e.g. empty states, confirmation flows, form validation) — typically `design-system/patterns/patterns.php` or a dedicated pattern page.

```markdown
**Status:** Current
**Last updated:** Month YYYY
**Canonical source:** design-system/patterns/patterns.php

# Pattern name

🟡 Beta

## Problem statement

One or two sentences: what user or product problem this pattern solves.

## Context

When this pattern applies — which apps, which flows, which conditions trigger it. Be specific enough that someone can tell whether their situation qualifies.

## Solution

The recommended approach, described plainly, referencing the `ws_*` components involved.

## Behavior

Step through what happens: triggers, transitions, edge cases (empty data, long text, slow network, error responses).

## Examples

**✅ Good**

Short example (code or description) showing the pattern applied correctly, and why it works.

**❌ Bad**

Short counter-example showing a common misuse, and why it fails.

## Accessibility

Keyboard and screen-reader behavior specific to this pattern (not just the components inside it — the sequence/flow itself).

## Related patterns

Link adjacent or competing patterns, and when to pick one over the other.
```

---

## Template C — Foundation doc

Use this for color, spacing, typography, motion, and other cross-cutting foundations — e.g. `colors.php`, `elevation.php`, `motion.md`.

```markdown
**Status:** Current
**Last updated:** Month YYYY
**Canonical source:** platform-tokens.css (or the relevant foundation file)

# Foundation name

## Purpose

Why this foundation exists and what problem it prevents (e.g. inconsistent spacing, clashing phase colors).

## Principles

The 2-4 guiding rules behind the spec — not the values themselves, the reasoning.

## Rules / specs

The actual scale, tokens, or values, in a table.

| Token | Value | Usage |
| --- | --- | --- |
| `--space-4` | 16px | Default component padding |

## Examples

Show the foundation applied in real UI — code snippet plus what it looks like.

## Exceptions

Documented, deliberate departures from the rule (e.g. the sky-blue focus ring — the one intentional non-red accent after the Red Unification). If there are none, say "No known exceptions."

## Resources / canonical source

Link the authoritative file(s) — usually `platform-tokens.css` and/or `workshopr-design-system.json`.
```

---

## Where each template applies

| Workshopr DS location | Template |
| --- | --- |
| `design-system/components/demos/*.php` (component demos) | A — Component |
| `design-system/components/component-library.php` | A — Component (one section per component) |
| `design-system/patterns/patterns.php` (if/when created) | B — Pattern |
| `design-system/foundations/colors.php` | C — Foundation |
| `design-system/patterns/composition.php` (spacing/layout) | C — Foundation |
| `design-system/typography` sections | C — Foundation |
| `design-system/foundations/animations.php` / `motion.md` | C — Foundation |
| `design-system/foundations/elevation.php` | C — Foundation |
| `design-system/resources/accessibility.php` | C — Foundation (with heavier Accessibility section) |
| `design-system/app-*.php` (per-app guides) | Neither — these are app-specific overlays, not DS artifacts; keep their existing do/don't format |
