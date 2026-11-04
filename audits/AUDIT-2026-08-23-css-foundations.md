# Design system audit: CSS and foundations

**Date:** 23 August 2026
**Scope:** the foundation layer only. `design-system/platform-tokens.css` and every stylesheet that redeclares a platform token.
**Dimensions:** token architecture, scale coherence, cascade correctness, naming, unit consistency.

This is a narrower and deeper pass than `AUDIT-2026-08-23-system-audit.md` earlier today. That audit covered inventory, components, accessibility and theming, and recorded token coverage as 92.7% healthy. It measured whether tokens were *referenced*. This pass measures whether they *resolve*, which turns out to be a different question.

---

## Executive summary

**The headline defect: 59 custom properties across five stylesheets are defined as themselves, which under the CSS cycles rule destroys them. They do not fall back to the platform value. They compute to nothing, and every declaration reading them without its own fallback is discarded.**

The pattern looks harmless and reads as documentation:

```css
/* css/academy/training.css, under the comment "Spacing Scale - from platform tokens" */
--space-4: var(--space-4);
```

The intent was clearly "inherit this from the platform." The effect is the opposite. Because the app sheet imports `platform-tokens.css` at the top and then redeclares `:root` below it, the cyclic declaration wins the cascade, and a custom property that references itself is invalid at computed-value time. The platform value is not inherited; it is overwritten with nothing.

I verified this in Chromium against the real stylesheets rather than reasoning from the spec:

| Token | Platform says | Actually computes to |
| --- | --- | --- |
| `--space-4` | `16px` | `""` (empty) |
| `--space-6` | `24px` | `""` |
| `--space-16` | `64px` | `""` |
| `--radius-full` | `9999px` | `""` |

A fallback written into the *definition* does not rescue it either. `--space-1: var(--space-1, 4px)`, the form used in `css/dna/styles.css` and `css/auth-modal.css`, is still a cycle and still computes to empty. Only a fallback at the *consumer* survives: `padding: var(--space-4, 99px)` correctly yields 99px. That distinction is why this has stayed invisible.

**335 declarations on live pages are currently discarded by this.** They fall back to the CSS initial value, which for padding, margin and gap is `0`.

Two further foundation defects are independent of the cycles: the planner runs on a spacing scale 20% smaller than the platform's because of a px/rem fork, and the academy radius scale is inverted so that `--radius-sm` is larger than `--radius-lg`.

### Issue counts by severity

| Severity | Count | Theme |
| --- | ---: | --- |
| P0 | 2 | Token cycles discarding 335 live declarations; inverted radius scale |
| P1 | 2 | px/rem spacing fork across the planner; type scale comments overstate every size by 25% |
| P2 | 3 | Visited links indistinguishable; z-index collision; malformed `--ease-in` curve |
| P3 | 2 | 13 duplicated colour families; two dead stylesheets carrying cycles |

### What is healthy

The token file itself is genuinely well kept. Deprecations are dated and justified, contrast figures are recorded next to the values they describe, and several comments explicitly warn against "fixing" a deliberate decision. The reduced-motion, forced-colors and `prefers-contrast` blocks are complete and correct. None of the defects below are in `platform-tokens.css`; they are all in sheets that consume it.

---

## P0-1 · 59 token cycles discard 335 declarations on live pages

**Severity: P0.** Silent, widespread, and affects layout on shipped pages.

Per file, counting only declarations that read a dead token with no consumer-side fallback:

| Stylesheet | Dead tokens | Broken declarations | Loaded in production? |
| --- | ---: | ---: | --- |
| `css/dna/styles.css` | 10 | **197** | Yes, 11 references |
| `css/academy/training.css` | 24 | **73** | Yes, 3 references |
| `css/auth-modal.css` | 19 | **65** | Yes, via `includes/footer/modals-inline.php:201` |
| `css/coach/coach-design-system.css` | 4 | 30 | No references found |
| `content/handouts/handout-styles.css` | 2 | 17 | No references found |

Live total: **335**. The bottom two rows are dead code and are filed as P3-2.

The worst concentration is `css/dna/styles.css`, where all ten spacing tokens are dead and the heaviest users are `--space-6` (39 declarations), `--space-3` (37), `--space-4` (31) and `--space-5` (29). Every one of those is currently painting `0`.

`css/academy/training.css` is the broadest case: the cycle covers not just spacing but `--font-body`, `--bg-page`, `--shadow-sm`, `--shadow-md`, the four semantic status colours, `--radius-full`, `--transition-fast`, and four z-index tokens.

### Why it was invisible

Three things hid it. The comment above each block says "from platform tokens", which reads as correct intent. The failure mode is a collapse to zero rather than an error, so it looks like a layout choice. And `check-drift.php` validates that a referenced token is *defined somewhere*, which these all are, by themselves.

### Recommended fix

Delete the cyclic declarations outright. A token that should come from the platform needs no local declaration at all; the import already provides it. For `css/academy/training.css` that means removing lines 25, 58, 60, 62, 64, 79, 87, 89, 99, 102 to 111, 123, 127, 128, 130 and 131, keeping only the genuinely local values (`--space-20: 80px`, `--space-24: 96px`, `--radius-xl: 24px`).

This is a mechanical change, but it is not a no-op: 335 declarations that currently paint `0` will start painting their intended values, so spacing on `/dna/`, `/academy/training/` and the auth modal will visibly change. It should be reviewed in a browser, not merged blind.

### Recommended guard

`check-drift.php` should gain a fourth check that fails on any `--x: var(--x…)`. It is a two-line regex and would have caught all 59.

---

## P0-2 · The academy radius scale is inverted

`css/academy/training.css` lines 93 to 99 rewire the radius scale by aliasing each step to the next one up, then redefining the top of the scale locally. Because all six declarations sit in the same `:root` block, they resolve against each other, and the result inverts the order.

Measured in Chromium against the real sheet:

| Token | Resolves to | Expected |
| --- | ---: | ---: |
| `--radius-sm` | **24px** | 4px |
| `--radius-lg` | **16px** | 8px |
| `--radius-full` | **empty** | 9999px |

`--radius-sm` is 50% larger than `--radius-lg`. Any academy component asking for a small radius gets the largest one in the system, and anything asking for a pill gets no radius at all.

**Recommendation:** delete the alias block and let the platform scale through, adding back only `--radius-xl: 24px` if the larger corner is a deliberate academy choice.

---

## P1-1 · The planner runs on a spacing scale 20% smaller than the platform's

Five files define `--space-*`, in two different units:

| File | `--space-4` | Unit |
| --- | --- | --- |
| `design-system/platform-tokens.css` | `16px` | px |
| `css/planner/design-system.css` | `1rem` | rem |
| `css/design-system.css` | `1rem` | rem |
| `css/tokens/_variables.css` | (partial scale) | px |
| `css/academy/training.css` | (cyclic, see P0-1) | n/a |

The platform sets `html { font-size: 80% }`, so the root font size is **12.8px**, not 16px. `1rem` therefore resolves to 12.8px, and every rem-based spacing token is 20% smaller than the px token of the same name.

This is live. `planner/includes/header.php:135` loads `css/planner/design-system.css` after `planner-new.css` has already pulled in the platform tokens at line 130, so the rem values win across the entire planner. `planner/landing.php:60` does the same with `css/design-system.css`.

The token file's own comment explains the design intent: "font sizes are rem (text), spacing is px (layout), so scaling the root font-size shrinks all text to 80% while leaving layout intact." The planner's rem spacing defeats exactly that, shrinking its layout too.

**Recommendation:** convert both `design-system.css` copies to the platform's px values. This is a deliberate visual change to planner spacing and needs your sign-off before anyone makes it.

---

## P1-2 · Every size comment in the token file overstates the real value by 25%

`platform-tokens.css` annotates the type scale with pixel values that assume a 16px root:

```css
--text-body: 1rem;       /* 16px */
--text-small: 0.875rem;  /* 14px */
--text-h1: 2rem;         /* 32px */
```

Measured with the file loaded, the real values are **12.8px**, **11.2px** and **25.6px**. Every comment in the type scale, timer scale and display scale is wrong by the same 25%, because `html { font-size: 80% }` sits 380 lines above them and is easy to miss.

Three app stylesheets have already independently discovered this and written local warnings about it (`beta/beta.css:304`, `app/css/dashboard.css:20`, `synthesize/synthesize.css:2814`). That is the tell: three separate authors each hit the same surprise and documented it locally rather than fixing the source.

This is also what makes the earlier audit's open finding on primary-button contrast worse than it reads. Button text at `--text-small` is 11.2px, comfortably normal-size text, so the 4.5:1 bar applies and there is no large-text allowance available.

**Recommendation:** correct the comments to the computed values, or state both, for example `/* 1rem = 12.8px at the 80% root */`. Documentation-only, no rendering change.

---

## P2 findings

**P2-1 · Visited links are indistinguishable from unvisited ones.** `--link-color` is `var(--phase-plan)` and `--link-visited` is `var(--phase-facilitate)`. Under Red Unification both phases resolve to `#E54D4D`, so both compute to the identical colour. The distinction the tokens were built to express no longer exists. Either point `--link-visited` at a real second value such as `--phase-learn-dark`, or delete it so nobody assumes it works.

**P2-2 · `--z-header` and `--z-modal-backdrop` are both 1100.** Two tokens at the same layer means the header and a modal backdrop stack by DOM order rather than by intent, so whether a modal covers the header depends on where it was injected. Separate them, most simply by moving the backdrop to 1150.

**P2-3 · `--ease-in` is not an ease-in curve.** It is `cubic-bezier(0.4, 0, 1, 0.2)`. A cubic-bezier easing must end at y=1; this one ends at 0.2, so it undershoots and then snaps, which is visible on exit transitions. The neighbouring `--ease-out` is the correct mirror `cubic-bezier(0, 0, 0.2, 1)`, which strongly suggests a typo for `cubic-bezier(0.4, 0, 1, 1)`.

---

## P3 findings

**P3-1 · Thirteen token families repeat the same literal hex instead of aliasing.** `#E54D4D` is typed 24 times in `platform-tokens.css` and `#C73E3E` 21 times, across `--phase-learn`, `--mainsite`, `--tips`, `--podcasts`, `--phase-plan`, `--planner`, `--phase-facilitate`, `--coach`, `--intervention`, `--phase-reflect`, `--dna`, `--training` and `--companion`. The `--facilitator-*` family already shows the better pattern, aliasing `var(--phase-facilitate)` rather than restating the value. Changing the brand red currently means 45 correct edits with no failure signal if one is missed.

**P3-2 · Two stylesheets carrying cycles appear to be dead.** `css/coach/coach-design-system.css` has zero references anywhere in the repo, and `content/handouts/handout-styles.css` is referenced only from an August audit sidecar. Together they hold 6 cycles and 47 broken declarations. Confirm and delete rather than repair.

---

## Remediation roadmap

| Order | Action | Risk | Visual change |
| --- | --- | --- | --- |
| 1 | Add the `--x: var(--x)` check to `check-drift.php` | None | No |
| 2 | Confirm and delete the two dead stylesheets (P3-2) | Low | No |
| 3 | Fix comments (P1-2), `--ease-in` (P2-3), z-index (P2-2), `--link-visited` (P2-1) | Low | Minimal |
| 4 | Remove cycles from the three live sheets (P0-1) | Medium | **Yes, needs browser review** |
| 5 | Fix the inverted academy radius scale (P0-2) | Medium | **Yes** |
| 6 | Unify the px/rem spacing fork (P1-1) | Medium | **Yes, planner-wide** |
| 7 | Alias the duplicated colour families (P3-1) | Low | No |

Steps 1 to 3 are safe to do immediately. Steps 4 to 6 each change how shipped pages render and are the ones to decide on deliberately.

---

## Verification

Findings were measured, not inferred. A headless Chromium instance loaded the real `css/dna/styles.css`, `css/academy/training.css` and `design-system/platform-tokens.css` from a static server and reported computed values via `getComputedStyle`. Cycle semantics, including the non-rescue by a definition-side fallback and the rescue by a consumer-side one, were confirmed against an isolated reproduction before being applied to the real files. Cycle counts come from a parser that takes the last winning declaration per file; the 584 raw hits reported by the scan collapse to 59 in the working tree once the twelve `.claude/worktrees/` copies are excluded.

Not verified: the visual result of any proposed fix. No fix was applied, per the assessment-first rule.

## Changelog

No code changed in this pass, so `changelog/index.php` and `design-system/changelog.php` are untouched. Both need an entry when the remediation lands.
