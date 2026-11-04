# Documentation Templates

Standard structures for every design-system artifact. Based on the strongest
existing demo page (`components/demos/card.php`) — existing pages already
follow most of this, so adoption means filling gaps, not rewriting.

## Which template for what

| Artifact | Template | Format |
|---|---|---|
| Component page (a `ws_*` helper) | `component-page.php` | PHP demo page in `components/demos/` |
| Pattern entry (composition of components) | `component-page.php` (use the Pattern variant sections) | PHP demo page |
| Foundation doc (tokens, theming, motion, spacing) | `foundation-doc.md` | Markdown in `/design-system/` |

## Required sections — component page

In this order. Sections marked *(opt)* may be omitted when empty, never reordered.

1. **Page header** — `$ds_title` + one-sentence purpose (`.ds-page-header`)
2. **When to Use** — `.ds-do-dont` with at least one "don't" that links to the alternative
3. **Variants** — live render + `.ds-code` snippet per group
4. **States** *(opt)* — hover/disabled/error/loading, live-rendered
5. **Real-world usage** — at least one example with production data shapes
6. **Options / API** — `.ds-table` of the helper's parameters
7. **Accessibility** — keyboard behavior, ARIA, focus handling; write "None — static content" explicitly rather than omitting
8. **Tokens** *(opt)* — tokens the component consumes, as a `.ds-table`
9. **CSS Classes** — `.ds-table` of emitted classes
10. **Files** — `.ds-table` of every file that defines the component

Pattern-entry variant: replace Variants/Options with **Problem** (when this
composition applies), **Solution** (the composition, live-rendered),
**Good / bad examples** (`.ds-do-dont`).

## Required sections — foundation doc

1. **Purpose** — what this foundation governs, in two sentences
2. **Principles** — the rules of thumb, before the numbers
3. **Specification** — the tokens/values, as tables mapping name → value → usage
4. **Usage examples** — code, correct and incorrect
5. **Exceptions** — every documented deviation, with links to its decision record
6. **Related** — sibling docs, source files, guards (lint/drift checks)

## Conventions

- **Status badge:** add `<span class="ds-status ds-status--beta">beta</span>`
  (or `--deprecated`) inside the page's `<h1>`; omitting the span means
  `stable`. The `.ds-status` styles live in `ds-header.php`. Markdown docs use
  the `Status:` row in their header table.
- **Chrome:** always `ds-header.php` / `ds-footer.php`; sections are
  `.ds-section` + `.ds-section-title` (+ `.ds-section-desc` for context).
- **Code:** `.ds-code` blocks (they get copy buttons); inline names use
  `.ds-code-inline`. Show the PHP helper call, not raw HTML.
- **Demos at width:** wrap responsive-sensitive demos in `.ds-demo-wrap`
  (`--mobile` / `--tablet` variants).
- **Voice:** second person, lead with what the reader needs first, "when to use"
  before "what it is."
- **Freshness:** the Files table doubles as the audit hook — if a listed file
  moved, the page is stale. Check quarterly alongside the ADOPTION.md review.
- **Never hardcode values in demo copy** — reference tokens even in demo CSS.
