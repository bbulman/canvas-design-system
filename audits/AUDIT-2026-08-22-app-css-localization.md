# Audit: localized CSS in `app/` and `design-system/`

**Date:** 22 August 2026
**Scope:** `app/` (the consolidated shell and its 19 views), `design-system/`
**Question asked:** which CSS is stranded inside PHP files, and which of it belongs in the design system?

---

## Addendum: the homepage, `index.php`

Audited and cleaned in the same pass. It was the worst single case in the repository: **1,591 lines of which 1,305 were CSS**, in two `<style>` blocks, and **892 of those lines were dead**.

The cause is identical to `app/`. The page renders its hero through `ws_section_hero()` and its DNA band through `ws_dna_cta()`, which emit `.wsh-hero*` and `.ws-dna-cta*`. The hand-rolled families they replaced were never deleted: `.home-hero*`, `.hp-hero*` and `.hp-dna-band*`, plus `.hp-product-card*`, `.hp-solution*`, `.hp-tool-card*`, `.hp-journey-grid`, `.hp-final-cta*`, `.hp-mini-agenda*` and `.hp-phase-pill`. **Three hero designs were declared in CSS; one is rendered.** None of the dead class names appears in any markup anywhere in the repository.

Two findings specific to this page.

**The retired phase palette survived here.** Plan blue `#0284C7`, Facilitate purple `#7C4DFF` and Reflect emerald `#10B981` were written as hardcoded fallbacks behind `--phase-plan`, `--phase-facilitate` and `--phase-reflect`. Those tokens are all `#E54D4D` today, so nothing painted them, but a fallback is a value waiting for its token to move. All of it sat inside the dead rules and went with them.

**The checker gap proved itself in real time.** The moment the CSS became a `.css` file, `check-drift.php` failed on `.hp-quote-card { padding: 24px }`, a card literal that had been sitting in plain sight inside `index.php` for as long as the file existed. That is finding P0-2 demonstrating itself: the rule existed, the violation existed, and the only thing standing between them was the file extension.

Result: `index.php` is 286 lines, the CSS is `/css/homepage.css`, markup is byte-identical, and 55 surviving rules moved unchanged. Two rules were deliberately altered: `body` now takes `--paper-grid-image` / `--paper-grid-size` (identical pixels, and the token drops to `none` under forced-colors where the literal gradient would not), and `.hp-quote-card` moved onto `--card-padding` / `--card-radius` / `--card-shadow`, of which only the padding is a real change, 24px to 20px. The baseline entry dropped from `{"doctype-outside-layout": 1, "hardcoded-hex": 17}` to `{"doctype-outside-layout": 1}`.

### New finding: component templates style themselves inline

Discovered while tracing where `.wsh-hero*` was defined. Five design-system component templates carry their own `<style>` blocks rather than putting CSS in `components.css`, which is CLAUDE.md §11 rule 8:

| Template | Inline CSS |
| --- | ---: |
| `includes/components/footer.php` | 269 lines |
| `includes/components/header.php` | 159 lines |
| `includes/components/section-hero.php` | 109 lines |
| `includes/components/dna-cta.php` | 39 lines |
| `includes/components/app-footer.php` | 5 lines |

581 lines in total, against 8,304 in `components.css`. This is worse than a page doing it: a component ships its styles to every page that calls it, so the CSS is duplicated into the document on each render rather than cached once, and none of it is reachable by either checker. Not fixed here.

### Still open on this page

`index.php` hand-rolls its own `<!DOCTYPE>` and `<head>` instead of using `includes/header.php`, which is the one violation left in its baseline. And it declares a private alias layer over the platform tokens (`--paper`, `--ink`, `--ink-soft`, `--rule`, `--learn`, `--display`, `--text`, `--ease`), so the homepage names colours differently from every other page. Both were left alone: the alias layer is spoken by all 55 surviving rules, so unwinding it is a rewrite rather than a move.

---

## Status: steps 1 to 3 applied, 22 August 2026

Roadmap steps 1, 2 and 3 are done. Steps 4, 5 and 6 are open and need design decisions.

**Removed as dead** (no markup or JS reference anywhere under `app/`, `planner/`, `includes/`, `js/`):

| Location | Removed | What it was |
| --- | ---: | --- |
| `app/views/plan/home.php` | 164 lines | `body.launchpad-page` token block (unreachable selector) plus the `.lp2-recent*`, `.lp2-grid`, `.lp2-card*`, `.lp2-life*`, `.lp2-btn*` families |
| `app/views/facilitate/home.php` | 83 lines | the entire `<style>` block; 23 of its 24 classes were orphaned |
| `app/css/synthesize-home.css` | 201 lines | whole file deleted; every rule described the three stacked sections the view stopped drawing |
| `app/css/dashboard.css` | 205 lines | the `needs attention` section (`.dash__list`, `.dash__row*`, `.dash__thumb`, `.dash__cta`, `.dash__phase*`) and its narrow-width reflow |
| `app/css/app-shell.css` | 9 selectors | dead names in the workshop-card border rule and the section-heading rule |

Every one of these was orphaned by the same event: the page moved to `ws_workshop_list()` and its old styles were never deleted.

**Moved out of PHP into `app/css/app-shell.css`**: the `.modal-overlay` FOUC guard (now in `<head>`, where it beats the first paint), `.lp2-nudge*`, `.prvh-*`, and `.pwa-install-banner*`. The card rules were repointed at `--card-padding` and `--card-radius` instead of the `18px` / `12px` literals, and `.prvh-card:hover` now uses `--card-shadow-hover` rather than the untokenised warm shadow.

**One behaviour change**: `app/views/prove/home.php` now wears the shared `.app-hero` instead of its own `.prvh-title` / `.prvh-sub`, and `.prvh` was added to the shell's page-frame neutraliser, which it had been missing. Prove previously double-padded its left edge, the exact bug the neutraliser's comment describes, and its heading was the one section heading not matching the rest of the frame.

**Result**: inline CSS in `app/views/` went from 410 lines to 127, all of it now the deliberately-local block in `synthesize/recap.php`. `check-drift.php` passes, `check-page.php --all` passes, and `app/views/plan/home.php` lost all 11 of its tolerated `hardcoded-hex` violations, so the baseline entry was tightened to `{"raw-component": 4}` rather than left carrying debt that no longer exists.

**Not verified in a browser.** No dev server was available in this session, so the pages were not loaded. Verification was static: PHP lint on every changed file, both design-system checkers, and a resolver check confirming every class in the four changed views still resolves to a rule in a stylesheet that page loads. That check surfaced two pre-existing unresolved classes in `plan/home.php`, `create-workshop-checkboxes` and `planner-toast-container`, both defined only in `css/planner/components/_modals.css`, which the shell deliberately does not load. They were unresolved before this work and are untouched by it. The four pages should be eyeballed before deploy.

---

## Executive summary

`app/` carries **447 lines of CSS inside PHP and HTML files**, plus 3,183 lines across six local stylesheets. The most important finding is not the volume: it is that **roughly half the inline CSS is already dead**, left behind when three views migrated their markup to `ws_workshop_list()` and nobody deleted the styles the old markup used.

The second finding is a governance hole. `check-drift.php` enforces card geometry against `.css` files only (158 scanned this run), and `check-page.php` reads `<style>` blocks but looks for hex literals alone. So CSS written inside a PHP file is governed by nothing: the three hand-rolled card definitions in `app/views/` all use `padding: 18px` where `--card-padding` resolves to 20px, and none of them appear in `card-geometry-baseline.json`.

The third is a component that claims design-system membership without holding it. `ws_workshop_list()` is 904 lines of PHP, 832 lines of CSS and four JS modules living entirely in `app/`, with five production callers and a documentation page, but zero entries in either JSON manifest. Meanwhile `ws_lifecycle()`, a fully registered and demoed component, has no callers at all while three hand-rolled copies of the same journey strip exist elsewhere.

### Issue counts by severity

| Severity | Count | Theme |
| --- | --- | --- |
| P0 | 3 | Ungoverned CSS, dead CSS, a component outside the system |
| P1 | 4 | Duplicated card/hero/lifecycle objects, unsanctioned shadow |
| P2 | 2 | Design-system doc pages, fallback-only tokens |

### Measured inventory

| File | Inline CSS | Notes |
| --- | ---: | --- |
| `app/views/plan/home.php` | 182 | 3 style blocks; ~2/3 dead |
| `app/views/synthesize/recap.php` | 127 | Live, scoped to `.synth`, well documented |
| `app/views/facilitate/home.php` | 81 | 23 of 24 classes dead |
| `app/offline.html` | 37 | Standalone document, legitimately self-contained |
| `app/views/prove/home.php` | 20 | Live, but duplicates the shared card and hero |
| **Total** | **447** | |

Local stylesheets: `app-shell.css` 1,115 · `dashboard.css` 858 · `workshop-list.css` 832 · `synthesize-home.css` 201 · `prove-report.css` 90 · `synth-rail.css` 87. Total 3,183 lines, 252 hex literals of which 241 are `var()` fallbacks and 11 are bare.

---

## Findings

### P0-1 · `ws_workshop_list()` is a design-system component living outside the design system

**Evidence.** The helper and its 16 sibling functions are defined in `app/includes/workshop-list.php` (904 lines). Its CSS is `app/css/workshop-list.css` (832 lines, 40+ top-level selectors under the `.wl-` prefix). Its behaviour is four modules under `app/js/`. It has five production call sites:

- `app/views/plan/home.php:236`
- `app/views/home.php:349` and `:365`
- `app/views/facilitate/home.php:187`
- `app/views/synthesize/home.php:86`

It has a documentation page at `design-system/app-workshop-list.php` with six worked examples.

**The problem.** `grep -c ws_workshop_list` returns **0** against both `workshopr-design-system.json` and `components.generated.json`. `check-drift.php` validates that helpers.php and the JSON agree (this run: 64 functions, 64 JSON components, PASS). This component sits on neither side of that mirror, so no check governs it, and the `design-system-enforcer` MCP cannot return it from `list_components` or `suggest_component`. A developer asking the oracle "what should I use for a workshop listing?" is told nothing exists.

The `ws_` prefix is a claim of membership. Right now it is an unbacked claim.

**Fix.** Apply CLAUDE.md §11 rule 8 as written: helper into `includes/components/helpers.php`, templates into `includes/components/`, CSS into `includes/components/components.css`, register in `workshopr-design-system.json`, keep the demo page where it is. The data-layer functions (`ws_workshop_list_fetch`, `ws_workshop_list_normalize`) are app logic, not presentation, and should stay in `app/includes/` under a non-`ws_` name so the boundary reads honestly.

---

### P0-2 · Inline CSS in PHP is invisible to both design-system checkers

**Evidence.** `check-drift.php` Check 4 walks the tree filtering on `strtolower($f->getExtension())` for CSS (line 278) and reported `Card geometry literals: 124`, all tolerated from `card-geometry-baseline.json`. `check-page.php` does extract `<style>` blocks (line 83) but the only rule it applies to them is a hex-literal scan (line 93).

Consequence, from the three hand-rolled card definitions:

```
.lp2-card   { border-radius: 12px; padding: 18px; }   app/views/plan/home.php:84
.prvh-card  { border-radius: 12px; padding: 18px; }   app/views/prove/home.php:27
.fach-card  { border-radius: 12px; padding: 18px; }   app/views/facilitate/home.php:50
```

`--card-radius` resolves to `--radius-xl` = 12px, so the radius happens to match by luck. `--card-padding` resolves to `--space-5` = 20px, so **the padding does not**: 18px is `--space-4-5`, a step the card contract does not use. None of these three appear in the geometry baseline, because the baseline can only list what the scanner can see.

**Fix.** Two moves, in order. First, extend `check-page.php` to run the card-geometry rule over `<style>` blocks, so the hole closes and cannot silently reopen. Second, move the CSS out (see P0-3 and P1-1), which makes the first check pass by construction rather than by ratchet.

---

### P0-3 · The whole inline block in `app/views/facilitate/home.php` is dead

**Evidence.** Of the 24 real class selectors declared in that 81-line block, **only `.fach` is referenced anywhere** in `app/`, `planner/`, `includes/` or `js/`. Dead: `.fach-head`, `.fach-head__row`, `.fach-head__all`, `.fach-title`, `.fach-sub`, `.fach-tabs`, `.fach-panel`, `.fach-panel__note`, `.fach-panel__empty`, `.fach-grid`, `.fach-card`, `.fach-card__name`, `.fach-card__meta`, `.fach-card__foot`, `.fach-life`, `.fach-life__step`, `.fach-life__dot`, `.fach-life__bar`, `.fach-btn`, `.fach-empty`, and three more.

The file's own comment at the `ws_workshop_list()` call explains why: the Ready-to-run / In-progress tab pair was replaced by the shared listing, and the card, grid, lifecycle strip and button all went with it. The styles stayed.

**Fix.** Delete lines 15 to 97, keeping only the `.fach` container rule, which moves to `app-shell.css` beside `.app-hero` since it is the same page-wrapper measure (`max-width: 1120px; padding: 40px 24px 72px`) that `.lp2` and `.prvh` also declare independently.

---

### P1-1 · Two of the three inline blocks in `app/views/plan/home.php` are dead or inert

**Block 1 (lines 32 to 57).** The `.modal-overlay` FOUC guard is live: `planner/includes/modal-planner.php` is included by this page and uses that class. The `body.launchpad-page { ... }` override below it **can never match**: the shell sets `$body_class = 'app-shell'` at `app/index.php:386`, and nothing under `/app/` ever adds `launchpad-page`. Those eight hardcoded hex values are inert, and they account for eight of the eleven `hardcoded-hex` violations this file carries in `page-baseline.json`.

**Block 2 (lines 60 to 147).** Live: `.lp2` and the six `.lp2-nudge*` classes. Dead: `.lp2-recent`, `.lp2-recent__head`, `.lp2-recent__title`, `.lp2-recent__all`, `.lp2-grid`, `.lp2-card`, `.lp2-card__name`, `.lp2-card__meta`, `.lp2-card__foot`, `.lp2-life`, `.lp2-life__step`, `.lp2-life__dot`, `.lp2-life__bar`, `.lp2-btn`, `.lp2-btn--primary`, `.lp2-btn--quiet`, `.lp2-btn--sm`. Same cause as P0-3: superseded by `ws_workshop_list()`.

Those classes are still live in `planner/planner-home.php`, which carries a near-identical copy of the same block at lines 111 to 186 and renders the cards client-side. That is the legacy standalone page, not a reason to keep the copy here.

**Block 3 (lines 271 to 344).** `.pwa-install-banner` is live and correct, but it is a platform-level object: an install prompt is not plan-specific, and `app/manifest.json` and `app/sw.js` are shell-level. It belongs in `components.css` as `ws_banner`'s install variant, or failing that in `app-shell.css`.

**Fix.** Delete block 1's `body.launchpad-page` rule and block 2's dead classes. Move `.lp2-nudge*` to `app-shell.css` (or better, replace it with `ws_suggestion_card`, which is the same object: icon tile, eyebrow, description, right-aligned CTA). Move the PWA banner to the design system.

---

### P1-2 · Four implementations of the journey strip; the registered component has none

**Evidence.**

| Implementation | Location | Status |
| --- | --- | --- |
| `ws_lifecycle()` | `helpers.php:1079`, CSS `components.css:6897`, demo `components/demos/lifecycle.php`, registered in the JSON | **Zero callers** |
| `.wl-journey` | `app/css/workshop-list.css:464` | Live, the one users see |
| `.lp2-life` | `app/views/plan/home.php:93` inline | Dead |
| `.fach-life` | `app/views/facilitate/home.php:64` inline | Dead |

`includes/components/lifecycle.php:41` states the position plainly in its own comment: grep confirms the component has no committed callers. The changelog documents it twice, including a migration from the retired three-step reading to the current four phases, for a component nothing calls.

The two dead copies each duplicate the same inline-SVG checkmark mask verbatim, once for `-webkit-mask` and once for `mask`, so the same 180-character data URI appears four times across two files.

**Fix.** Delete the two dead copies with their parent blocks. Then decide the one real question: either `.wl-journey` is refactored to consume `ws_lifecycle()`, or `ws_lifecycle()` is retired and `.wl-journey` becomes the registered component when the listing moves into the design system under P0-1. Two documented components drawing one strip is the state to leave behind. My recommendation is the second: `.wl-journey` is the version with real users and real states.

---

### P1-3 · The card hover uses a shadow no token defines, copy-pasted six times

**Evidence.** This exact declaration appears verbatim in six files:

```css
transform: translateY(-2px);
box-shadow: 0 4px 14px rgba(60,40,30,.08), 0 1px 3px rgba(60,40,30,.05);
```

`app/views/plan/home.php`, `app/views/prove/home.php`, `app/views/facilitate/home.php`, `planner/planner-home.php`, `facilitator/facilitator-home.php`, `facilitator/facilitator-home 2.php`.

`platform-tokens.css` defines `--shadow-xs` through `--shadow-xl` and maps `--card-shadow-hover: var(--shadow-md)`, which is `0 4px 6px rgba(0,0,0,0.07)`: cooler, tighter, and visibly different. So every card on these six pages lifts with a warm brown shadow the design system does not know exists, while the token that is supposed to describe card hover goes unused.

**Fix.** Decide which one is right and make it the token. The warm shadow is arguably the better call on Stone paper, in which case `--card-shadow-hover` should be redefined to match and the six copies replaced with `var(--card-shadow-hover)`. Either way, one definition.

---

### P1-4 · The page hero is hand-rolled per view while `ws_hero()` goes unused

**Evidence.** `.app-hero` in `app-shell.css:452` is used by three views (plan, facilitate, synthesize home), twelve references total. But:

- `app/views/prove/home.php` hand-rolls `.prvh-title` and `.prvh-sub` inline instead, with its own `clamp(2rem, 4vw, 2.75rem)` type ramp
- `app/views/facilitate/run.php` uses `.picker-header__title` / `.picker-header__subtitle`
- `app/views/synthesize/home.php` also carries `.start-hero`
- `ws_hero()` is registered in the design system and called from `app/` zero times

Four heroes, one of them the actual system component, and the system component is the one nobody uses.

**Fix.** Point `prove/home.php` at `.app-hero`, which deletes its inline block outright (its remaining rules are the duplicated card from P0-2). Then reconcile `.app-hero` and `ws_hero()`: `.app-hero` has three real consumers and the eyebrow / two-line-title / lede structure the sections actually use, so promote it into `components.css` as the app-page variant of `ws_hero` rather than maintaining both.

---

### P2-1 · `design-system/` doc pages carry 1,110 lines of their own inline CSS

**Evidence.** `overview.php` 377 lines, `index.php` 256, `animations.php` 206, `video.php` 101, `changelog.php` 50, `presentations.php` 44, plus six smaller blocks.

These are documentation pages, not product surfaces, so the user-facing risk is nil. The cost is credibility: the pages that teach the rule are the pages breaking it, and anyone reading `overview.php` for an example of how to structure a page finds 377 lines of inline CSS.

Also noted while walking the directory: `design-system/app-synthesize 2.php` and `design-system/debt-register 2.md` are stale Finder-duplicate copies of live files, and `facilitator/facilitator-home 2.php` is a third. They should be deleted, not audited.

**Fix.** Low priority. One `design-system/css/docs.css` absorbs all of it. Do it opportunistically, not as a project.

---

### P2-2 · Sixty fallback-only tokens, and `app/` is actively adding more

**Evidence.** `check-drift.php` reports 60 tokens referenced only as `var(--x, #fallback)` with no definition anywhere. Worst offenders: `--stone-400` (28 refs), `--warm-ink` (24), `--planner-text-muted` (11), `--warm-cream` (9), `--fac-border` (8), `--color-ink-text` (8).

Every `var(--x, #hex)` is a bet that the token exists. Across `app/css/`, 241 of 252 hex literals are fallbacks, and the inline blocks are denser still: `app/views/facilitate/home.php` writes `var(--gray-900, #1C1917)` fourteen times. Where the token does exist the fallback is dead weight; where it does not, the fallback is silently the real value and the token name is fiction.

**Fix.** Not urgent, but stop adding them. When CSS moves out of PHP under the fixes above, drop the fallbacks for tokens that demonstrably exist in `platform-tokens.css` and define the ones that do not.

---

## Remediation roadmap

Ordered so that each step makes the next one smaller. Steps 1 to 3 are pure deletion and carry near-zero risk.

**Step 1: delete what is dead.** No behaviour change, no visual change.
- `app/views/facilitate/home.php`: remove lines 15 to 97 except the `.fach` rule
- `app/views/plan/home.php`: remove the `body.launchpad-page` rule and the 17 dead `.lp2-*` classes
- Delete `design-system/app-synthesize 2.php`, `design-system/debt-register 2.md`, `facilitator/facilitator-home 2.php`
- Expected: about 160 lines of CSS gone, and 8 of the 11 tolerated `hardcoded-hex` violations in `page-baseline.json` drop out. Re-baseline afterwards.

**Step 2: close the checker hole.** Extend `check-page.php` to apply the card-geometry rule to `<style>` blocks, so P0-2 cannot silently recur. Baseline whatever survives step 1 so the ratchet starts from the post-cleanup state.

**Step 3: move the survivors into stylesheets.** Nothing enters the design system yet; this only gets CSS out of PHP.
- `.fach`, `.lp2`, `.prvh` collapse into one `.app-page` wrapper in `app-shell.css` (all three declare the same `max-width: 1120px; padding: 40px 24px 72px`)
- `.lp2-nudge*` and `.pwa-install-banner` move to `app-shell.css`
- `app/views/prove/home.php` switches to `.app-hero` and the shared card; its inline block disappears entirely
- `app/views/synthesize/recap.php`'s block is the one that should mostly stay: it is tightly scoped to `.synth`, corrects for the shell's `zoom: 0.8`, and is genuinely local to that document. Move it to a `recap.css` sheet rather than dissolving it.

**Step 4: reconcile the duplicated objects into the design system.** This is where design decisions are needed, not just moves.
- Card: one definition using `--card-radius` / `--card-padding`, and one hover shadow decision (P1-3)
- Hero: promote `.app-hero` into `components.css`, retire or fold in `ws_hero()` (P1-4)
- Lifecycle: pick `.wl-journey` or `ws_lifecycle()`, retire the loser (P1-2)

**Step 5: bring `ws_workshop_list()` into the design system.** Helper and templates into `includes/components/`, CSS into `components.css`, register in `workshopr-design-system.json`, split the data-layer functions back out under a non-`ws_` name. Run `check-drift.php` to confirm the mirror still balances at the new count.

**Step 6 (opportunistic):** `design-system/css/docs.css` for P2-1, and drop dead `var()` fallbacks as files are touched for P2-2.

---

## What is already right

Worth recording, because the audit is not all deficit.

- `app/index.php`'s conditional `$extra_css` loading is precise and each branch is justified in a comment that names the failure it prevents. That is the opposite of a kitchen-sink bundle.
- `app/views/synthesize/recap.php`'s inline CSS opens by stating it is the only invented CSS in the file and that everything else comes from `synthesize.css`, then justifies each rule against a design decision. If inline CSS has to exist, this is the shape it should take.
- `card-geometry-baseline.json` carries an explicit instruction never to grow the list to unblock new code. The ratchet discipline is sound; the gap is only that it cannot see PHP.
- Per-module `filemtime()` cache-busting in `plan/home.php` correctly replaced a `time()` call that made every module uncacheable.
