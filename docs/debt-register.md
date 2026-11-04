# Platform Design Debt Register

| | |
|---|---|
| **Status** | Living register. Last re-measured 4 October 2026 (third pass, below). |
| **Owner** | Bill |
| **Review** | Quarterly; next due January 2027 |

Living document, created from the July 31, 2026 platform-wide design-debt audit of workshopr.io. **Read the third pass first:** it re-derives every open item and supersedes the July figures where they disagree.
Scope: every served `.php` page and every `.css` file outside `vendor/`, `node_modules/`, `coach/` (bespoke by design), and `emails/` (excluded from token rules).
Sources of truth: `DESIGN.md`, `motion.md`, `design-system/workshopr-design-system.json`, `platform-tokens.css`, the `ws_*` library.

Companion to `planner-debt-register.md` (July 3, 2026, planner-only). That register stays authoritative for planner-internal items; this one covers the platform and supersedes its item #10.
Update status as items resolve; re-audit quarterly. Priority = Severity × Frequency ÷ Effort.

## Measured baseline (July 31, 2026)

| Metric | Value |
|---|---|
| Served PHP pages carrying violations | ~~320~~ **311** of ~800 |
| Ratchet-counted violations (`page-baseline.json`) | ~~5,601~~ **4,723** (D9 fixed, re-baselined Jul 31) |
| — `hardcoded-hex` | ~~3,650~~ **2,795** |
| — `raw-component` / `uncachebusted-asset` / `doctype-outside-layout` | 1,721 / 135 / 72 |
| CSS shipped (`css/` + `includes/components/`) | 100,098 lines across 577 files |
| `ws_*` components defined / in sync | 58 / 58 (`check-drift.php` PASS) |
| `ds-lint` | clean, 122 files |
| `check-page.php --all` | PASS — no new drift above baseline |
| Type tokenised | 81% (1,268 `var()` / 295 literals) |
| Spacing tokenised | 65% (2,484 `var()` / 1,322 literals) |
| `z-index` tokenised | 17% (42 `var()` / 199 literals) |
| Media queries on sanctioned breakpoints | 61% (149 of 246) |

The automated gates were green on the day this baseline was measured. **They are not self-announcing** — CI only runs on push, and this branch sits far ahead of `origin/main` with manual FTP deploys, so a red gate can sit unnoticed for weeks. The September 2026 audit (`AUDIT-2026-09-16-system-audit.md`) found four of five failing on a clean tree for exactly that reason. Re-run them before trusting this table:

```bash
php design-system/tools/check-drift.php && php design-system/tools/generate-catalog.php --check && php design-system/tools/generate-tokens-dtcg.php --check && node scripts/ds-lint.mjs && php design-system/tools/check-page.php --all
```

Everything below is debt the gates were built to tolerate, plus the categories they do not measure at all (accessibility, structural duplication, pattern fragmentation).

## Third pass: 4 October 2026 (re-measurement and new debt)

Method: every open item re-derived against the working tree (main, 10 ahead of origin, plus uncommitted work), scope 1,482 served files after excluding `vendor/`, `coach/`, emails, agent dirs, tests, `content/`, nested `node_modules/`, `dist/`, and sync duplicates (` 2.`, ` 3.`, ` 4.`). Every total below was checked by reading ten or more real matches first. Scanner scripts lived in the session scratchpad and were not committed.

### Gates

| Gate | 16 Sep | 4 Oct |
|---|---|---|
| `check-drift.php` | FAIL | **PASS** (56 fallback-only token WARNs; 6 card-geometry baseline entries now fixed and trimmable) |
| `generate-catalog.php --check` | FAIL | **PASS** (109 functions, 356 tokens) |
| `generate-tokens-dtcg.php --check` | FAIL | **PASS** |
| `ds-lint.mjs` | PASS | **PASS** (167 files) |
| `check-page.php --all` | FAIL (47) | **FAIL (151 new in 24 files)**, see D27 |

### Headline

1. **The July figures for D4, D6, D19, D20, D21 and D25 were not comparable to today's**, mostly because July counted only `.css` files and only literal hex, not alias chains or PHP `<style>`/`style=""`. Treat the July rows as superseded; the figures in the table below are the new baseline. Do not read the jumps as a regression.
2. **D6 was largely resolved before July measured it.** `platform-tokens.css:916` carries a global `prefers-reduced-motion` reset with `!important`, nothing overrides it, and every page on the shared header gets it. Only 21 hand-rolled pages miss it.
3. **D1 cannot be closed by deleting the flat admin copies.** The copies the nav links are the *less* secure ones: eight of them have no `adminCsrfVerify()` while their unlinked flat twins do (verified 4 Oct: `add-user`, `banners`, `bulk-status`, `collections`, `comments`, `exercise-edit`, `icebreaker-edit`, `users`; no shared include verifies CSRF globally). `admin/system/banners.php` also lacks the twin's `bannerSafeUrl()` check. Merge the fixes into the subfolder copies first. This is a security defect, not design debt, and should be fixed ahead of anything else here.
4. **New surfaces since 16 Sep are mostly clean.** All 18 new stylesheets pass `ds-lint`; the app shell grid, `ws_app_dock()` and the agent components are fully in-system. The new debt is concentrated in pages that bypass the shared header.
5. **Sep-16 audit closures:** C-1 (four gates), C-2 (a11y extractor; 83 of 109 entries now carry guidance), H-7/M-1 (catalog scope tagging, `ws_header` catalogued), M-5 (scratch dirs skipped). Still open: C-3 root font size (no decision recorded anywhere), C-4 = D4, H-1, H-2 (four of five templates unchanged; `modal-close.php` was a false finding, the close button lives in `modal.php:81` with a label), H-4, H-5, H-6 (worse: 4 private prefixes, 51 declarations), M-4 Anatomy (0 of 65 demos), L-3 (31 hex in `components.css`).

### Re-measured open items

| # | July | 4 Oct | Verdict |
|---|---|---|---|
| D1 | 26 pairs | 26 pairs, 12,154 lines; linked copies missing CSRF in 8 | Unchanged, **riskier** |
| D2 | 0 (resolved) | **15** icon-only buttons with no name: 5 PHP (`facilitator/app.php:302,306`, `app/views/facilitate/run.php:341,345`, `includes/ratings-ui.php:80` ×5 in a loop), 10 in JS templates (`calendar.js` 3, `onboarding.js` 3, `planner.js:835`, `launchpad.js:614`, `planner-v2.js:9729`, `live.js:407`) | **Reopened.** Part July miss, part regression (`run.php` copied the poll buttons 9 Aug) |
| D4 | 38 | Brand red as text: **350** strict (literal or direct brand token), 1,306 via all aliases. `--gray-400` as text: 122 strict. `--gray-500` as text: 403 strict | **Mismeasured.** About 9% are icons (3:1 suffices). Worst: `css/styles.css`, `css/facilitator/facilitator.css`, `components.css` |
| D5 | 58 / 30 files | 266 outline removals; 216 replaced; **about 26 genuine ring-killers**, plus 8 replaced only by a faint background (`header.php:652`) | **Improved.** A class selector `outline:none` ties the `:where()` floor and wins on source order, so each of the 26 really removes the ring |
| D6 | 101 / 29 files | Global reset covers all token-loading pages; 21 hand-rolled pages and 14 rAF-driven JS files without `matchMedia` remain | **Mismeasured; largely resolved** |
| D7 | 56 | 63 unfocusable click targets (30 `<label>`, 16 `<div>`, 15 `<span>`, 2 `<p>`) + 14 `<a href="#" onclick>` | Unchanged. Worst: `toolkits/hybrid/equity-audit.php` 33 (radios `display:none`), `includes/footer/modals.php` 21 |
| D8+D22 | 12 CSS / 16 JS | **16 CSS families, 14 JS implementations** in 17 files. Sanctioned `wsToast()` has 80 calls in 28 files; legacy `Toast.*` 17 in 7. The `js/listing-page.js` call to an undefined `showToastNotification` went with its clipboard fallback on 29 Oct 2026, when `shareItem()` moved into `includes/footer/share.php` | **Worse** |
| D10 | 358 / `.btn` 99 | 544 classes containing `btn`, 363 root families; `.btn` 171 rules, `.ws-btn` 68 | Worse or not comparable |
| D11 | 55 files | 57 CSS + 37 PHP inline `:root` blocks; `--font-display` redeclared in 13, `--shadow-sm` 10 | Unchanged |
| D12 | 3 to 5 dialogs unannounced | **About 31 dialog roots with no `role="dialog"`** (incl. share, comments and both auth modals in `includes/footer/modals-inline.php`); 5 more missing `aria-modal` or a name. `_modals.css` pair 6,880 lines | **Worse than recorded** |
| D13 | 135 / 72 | 121 / 69 | Slightly better |
| D16 | open | Still ships; `planner/live/live-mode.css` (2,659 lines) is a dead duplicate, the page loads `/css/planner/live-mode.css` | Unchanged; dead file is free to remove |
| D17 | 5 planner trees | `admin/legacy/` gone; add `synthesize/mockups/` (52 pages), `library/mockups/` (10), `facilitator/mockups/` (4). `.htaccess` covers none, nor the PDFs in `planner/prd/` (one is a competitive brief) | Larger than recorded |
| D18 | 2,795 / 320 files | 2,592 in 159 files; admin holds 1,151 | Slightly better |
| D19 | 154 px | `.css` only: 326 px (211 on-scale, 115 off). All sources: 1,956 | Not comparable; new baseline |
| D20 | 42 var / 199 lit | 56 var / **456 literals, 51 values** (303 in `.css` alone) | Not comparable; new baseline |
| D21 | 97 of 246 off-set | **347 of 621 (56%)**; 1024 ×67, 900 ×53, 600 ×49; sanctioned 1120 used 0 times, 1280 twice | Worse. The code has voted: adopt 1024 and 600, retire 1120 |
| D23 | 191 in 19 files | 166 (76 alert, 79 confirm, 11 prompt) in 87 files; admin 53. Still no `ws_confirm` | Slightly better; new code still adds them (`app/js/team.js:940,947,950`, `facilitator/js/modules/commitments.js:476`) |
| D24 | academy, dna zero | academy improved (foundations); **dna and library still zero** of all three | Partly improved |
| D25 | 241 off-scale | `.css` only: 636 of 3,886; all sources 1,595 of 9,616 | Not comparable; new baseline |

### New items

| # | Issue | Category | Sev | Freq | Effort | Score | Status |
|---|---|---|:---:|:---:|:---:|:---:|---|
| **D27** | **Page ratchet red: 151 new violations, about 60 genuine.** 84 come from commit `60b4e4bb` renaming `academy/training/*` to `academy/learning-paths/*` with identical content; the baseline still keys 14 dead paths. 7 are pages copying `--bg-page` into their own `:root` because they cannot load the tokens under the 80% root rule (accept). Genuine: `bettermeetings/cards/index.php` 39, `facilitator/commit.php` + `checkin.php` raw controls, `admin/contributions.php` 6, `academy/foundations/inc/chrome.php` head. Separately, baseline rewrites since 16 Sep silently absorbed new raw controls in `app/views/team.php`, `canvas/index.php`, `includes/components/app-footer.php` | Implementation | Moderate | High | Low | **6.0** | Open: re-key the 14 entries, then fix the genuine 60 |
| **D28** | **Cache-bust gaps on header-bypassing pages.** No `?v=` on `platform-tokens.css` in `academy/foundations/inc/chrome.php:29-30`, `facilitator/commit.php:18`, `checkin.php:23`; frozen `?v=1` in `commit.php:21,68`, `checkin.php:26,60`, `investment/index.php:188-189`; `intro/index.php:45` passes `?v=1` into a header that appends its own. The tokens changed 30 Sep; with FTP deploys these pages can serve stale tokens | Implementation | Moderate | Med | Low | **4.0** | Open |
| **D29** | **Legacy alias tokens written into new CSS.** 171 `--phase-*`/`--mainsite-*` references across 15 of 18 new stylesheets, against 11 `--brand*`. Worst `css/canvas/styles.css` 39, `css/index2.css` 21. `ds-lint` does not check this, so §11 rule 4 is unenforced | Implementation | Minor | High | Med | **1.5** | Open: add a ds-lint rule for new files |
| **D30** | **Sync duplicates and strays are publicly served.** 54 `* 3.*`/`* 4.*` files (e.g. `api/workshop-record 4.php`, `bettermeetings/index 4.php`), plus `index_old.php`, `academy/learning-paths1/`, `taste/index 2.php` | Structural | Moderate | High | Low | **6.0** | Open: destructive, needs Bill |
| **D31** | **About 115 to 125 unlabelled form controls** (estimate from 294 raw controls in user-facing dirs; 3 false positives in a 20-sample). Worst `planner/brief/pages/*` 53, where a visible `<label>` is not linked. WCAG 1.3.1 / 4.1.2 (A). `form-row.php`'s `<label>` has no `for` either, which seeds the pattern | Accessibility | Critical | High | Med | **6.0** | Open: fix `form-row.php` first |
| **D32** | **`bettermeetings/cards/` sits wholly outside the system**: own DOCTYPE, private navy palette, `--focus:#3B82F6` instead of the sky-blue token, 15 raw buttons, no `ws_header`. DESIGN.md has no exception covering it or its sibling | Visual | Moderate | Low | High | **1.0** | Open: decide exception or migrate |
| **D33** | **8 new stylesheets are missing from `design-system/changelog.php`**: intro, start, connect, foundations, forgot, pricing, pricing-compare, features (§11 rule 6) | Documentation | Minor | Med | Low | **2.0** | Open |
| **D34** | **px type on new marketing pages runs a second scale.** `pricing.css`, `features.css`, `index-new.css` (55 declarations) set headings in px while body uses rem under the 80% root, so the pages render at a different ratio from their neighbours | Visual | Moderate | Med | Med | **2.0** | Open; blocked on C-3 |
| **D35** | **`admin/contributions.php:542,647` Approve buttons** render green text on a red `#FEE2E2` fill, left half-converted by Red Unification | Visual | Minor | Low | Low | **1.0** | Open |

### Revised priority order

1. **D1 security half** (CSRF and URL checks into the linked admin copies). Not design debt; do it first.
2. **D27** re-key the baseline so the ratchet means something again, then **D28** cache-busts. Both under an hour.
3. **D31 + H-2 templates**: fix `form-row.php`, `radio-card-group.php`, `checkbox-card-group.php`, `results-overlay.php` once, which fixes every consumer.
4. **D12 dialogs** starting with the four in `includes/footer/modals-inline.php` (on every page), then **D2** (15) and the 26 ring-killers in **D5**.
5. **C-3 decision** (root font size), which unblocks D4's real scope and D34.
6. **D30** needs Bill's sign-off to delete; **D21** needs a one-line decision (adopt 1024/600).
7. Structural (D8/D22/D12 consolidation, `ws_confirm` for D23) as before.

## Register

| # | Issue | Category | Sev | Freq | Effort | Score | Status |
|---|---|---|:---:|:---:|:---:|:---:|---|
| **D1** | **26 admin pages exist twice** — a flat copy and a subfolder copy (`admin/users.php` + `admin/users/users.php`, ×26). ~11,400 duplicated lines, diverged 82–99.7%. Nav links only the subfolder copies; the flat copies are unlinked but still route and serve. They carry **591 baseline violations (10.6% of the total)**. `admin/security-events.php` was last touched Mar 15; its live twin May 7 — the orphan is a stale admin surface behind a live auth guard. | Structural / Implementation | Critical | High | Low | **12.0** | Open |
| **D2** | ~~81~~ **60 icon-only buttons with no accessible name** — `<button>` containing only a Material Symbols span, a bare `<svg>`, or `<?= icon('…') ?>` (which emits an SVG with no title), and no `aria-label`/`aria-labelledby`/`title`. WCAG 2.2 **4.1.2 Name, Role, Value (Level A)**. Worst: `includes/footer/modals.php` (11), `admin/banners.php` + `admin/system/banners.php` (6 each), `facilitator/app.php` (6). **RESOLVED July 31, 2026** — `aria-label` added to all 60 across 24 files; detector now returns zero. *Count corrected from 81: 21 of the original matches carry PHP-rendered text labels (`<?php echo $isNew ? 'Create Exercise' : 'Save Changes'; ?>`) and were never violations — see the measurement note below.* | Accessibility | Critical | High | Low | **12.0** | **Resolved** |
| **D3** | ~~94 of 457 `<img>` tags have no `alt` (21%)~~ — **this finding was almost entirely a measurement artifact and is now closed.** True figures: **1,133 `<img>` tags, 40 without `alt` (3.5%)**, and of those 40 only **one** was on the product surface. The rest: 24 in `content/ads/ads.html` (ad creative), 10 in `content/ebooks/training-taste.html`, 1 in a local `file://` card template, and **4 that are not markup at all** — regex literals and a code comment that merely contain the characters `<img` (`includes/substack-feed.php` ×2, `admin/tools/test-suite.php`, `admin/api/site-health.php`). **RESOLVED July 31, 2026** — the one real violation, a JS-built avatar in `includes/ratings-ui.php:570`, now carries `alt=""` (decorative: the reviewer's name renders adjacent, matching the sibling fallback branch). | Accessibility | Critical | Med | Low | **8.0** | **Resolved — finding was inflated** |
| **D4** | **Brand red fails AA as body text.** `#E54D4D` = **3.82:1** on white, **3.66:1** on the `#FAFAF9` paper background — below the 4.5:1 AA floor. 38 CSS declarations set it as a `color`. `--phase-learn-dark` `#C73E3E` (5.02:1) exists precisely for this and DESIGN.md mandates it. Separately, `--gray-400` `#A8A29E` = **2.52:1** and is used as a text color in 22 places — fails at any size. | Accessibility | Critical | High | Med | **6.0** | Open |
| **D5** | **Focus indicators suppressed more often than restored.** 58 CSS files contain `outline: none`/`outline: 0`; only 30 define any `:focus-visible` rule. WCAG **2.4.7 Focus Visible (AA)**. Keyboard users lose the caret on roughly half the surface. | Accessibility | Critical | High | Med | **6.0** | Open |
| **D6** | **Motion ignores `prefers-reduced-motion` on 71% of animated surface.** 101 CSS files declare `@keyframes` or `transition`; 29 honour the query. WCAG **2.3.3 Animation from Interactions (AAA)** and a `motion.md` mandate. Mostly a mechanical per-file addition. | Accessibility | Moderate | High | Low | **6.0** | Open |
| **D7** | **56 non-semantic interactive elements** — 38 `<div>`/`<span>` with `onclick`, 18 `<a onclick>` with no `role`. Not focusable, not announced, not keyboard-operable. WCAG **2.1.1 Keyboard (A)** + **4.1.2 (A)**. | Accessibility | Critical | Med | Med | **4.0** | Open |
| **D8** | **Twelve parallel toast systems.** `.ws-toast`, `.toast`, `.planner-toast`, `.coach-toast`, `.fac-toast`, `.live-toast`, `.launchpad-toast`, `.dna-gate-toast`, `.onboarding-toast`, `.calendar-success-toast`, `.pa-help-toast`, `.fac-help-toast` — twelve visual treatments for one interaction, of which `ws_toast_container` is the sanctioned one. | Visual | Moderate | High | Med | **3.0** | Open |
| **D9** | **The ratchet over-reported itself by 23%.** `check-page.php`'s `hardcoded-hex` rule counted every hex inside `style=""`/`<style>`, including the fallback in `var(--token, #E54D4D)` — correct defensive code, not debt. `ds-lint.mjs` was fixed for this in 8dcdacfe; `check-page.php` was not. **RESOLVED July 31, 2026** — rule now strips `var()` fallbacks before counting (verified three ways: real hex counts, fallback-only doesn't, mixed reports exactly the real one). Baseline rewritten: **5,601 → 4,723 violations, 320 → 311 files**, `hardcoded-hex` 3,650 → 2,795. Diffed old against new: **zero drift absorbed**; the 9 dropped files were all-fallback, and a −23 `raw-component` shift came from 5 `strategist/includes/` files this branch deleted. | Documentation / Implementation | Minor | High | Low | **3.0** | **Resolved** |
| **D10** | **358 distinct `.btn*` selectors** across the CSS. `.btn` (99 rules) runs in parallel with `.ws-btn` (67), plus per-app families: `.quick-add-btn` (44), `.action-icon-btn` (21), `.topbar-action-btn` (19), `.time-to-plan-btn` (18), `.tr-btn`, `.prepare-btn`, `.briefing-btn` (16 each). Extends planner register #2 to the platform. | Visual | Moderate | High | High | **2.0** | Open |
| **D11** | **Token namespaces have forked.** 55 CSS files declare their own `:root` block. Core tokens are redeclared outside `platform-tokens.css`: `--shadow-sm` in 11 files, `--radius-md` in 9, `--font-display` in 9, `--space-4` in 8. Each fork is a place where a token change silently fails to propagate. | Implementation | Moderate | High | High | **2.0** | Open |
| **D12** | **Twenty modal/overlay root families, two `_modals.css` files** (`css/components/_modals.css` 2,045 lines + `css/planner/components/_modals.css` 4,840 = 6,885 lines for one pattern). 21 files ship `.modal-overlay` markup; 18 have `role="dialog"`, 16 have `aria-modal` — so 3–5 dialogs are still invisible to assistive tech. | Structural / Accessibility | Moderate | High | High | **2.0** | Open |
| **D13** | **135 files hand-roll `<!DOCTYPE>`** (72 counted as violations after the skip list). A forked `<head>` silently drops CSRF meta, SEO tags, analytics, and `components.js`. Concentrated in `academy/learn/*` (10), `dna/` (9), `tips/` (9), `intervention/` (6). | Structural | Moderate | High | High | **2.0** | Open |
| **D14** | **planner register #10 is wrong and this register corrects it.** It records "launchpad.css 288 hardcoded hexes". Of the 315 hexes in that file, **313 are `var()` fallbacks; 2 are truly hardcoded.** Same over-count as D9. The register's other token-drift figures (prep.css 87, `_modals.css` 71, `_topbar.css` 68) need the same re-measurement before anyone schedules work against them. | Documentation | Minor | Med | Low | **2.0** | Corrected in `planner-debt-register.md` |
| **D15** | **Eight stale `TODO: no token match` markers in `includes/components/components.css`** — the design system's own stylesheet. **RESOLVED July 31, 2026** — all eight cleared, zero visual change: three exact-value substitutions (`#7F1D1D` → `--toast-bg`, `#15803D` → `--color-green-700`, `#B45309` → `--color-warning-darker`), three comment-only deletions on lines already using tokens. **Two were not stale — they are real token gaps** and now say so: `#FFFBEB` (amber-50; nearest `--color-warning-surface` is `#FFF7ED` orange-50, so swapping shifts hue) and `#9333EA` (exists only as `--planner-custom-color`, out of scope for `components.css`). Both need a design call, not a substitution. | Documentation | Minor | Low | Low | **1.0** | **Resolved — 2 token gaps raised as D26** |
| **D16** | **`planner/live/` still ships** (2,659-line stylesheet + JS tree) though Facilitator PRD §12 declares Live Mode deprecated. Three live tools now coexist: live mode, sidekick, facilitator. Carried forward from planner register #7 — still unresolved. | Structural | Moderate | Low | Med | **1.0** | Open — needs decision |
| **D17** | **Prototype trees reachable in production**: `planner/mockups/`, `planner/before-the-agenda/`, `planner/figjam/`, `planner/prd/`, `planner/docs/`, `admin/backstage-style-web/`, `admin/legacy/`, `intervention/mockups/`. Carried forward from planner register #8 — all five planner trees confirmed still present. | Structural | Minor | Low | Low | **1.0** | Open |
| **D18** | **2,795 truly-hardcoded hexes in inline styles** across 320 pages (after removing the 855 fallbacks). Worst: `facilitator/index.php` 132, `admin/analytics/card-downloads.php` 76, `admin/collection-items.php` 66. Roughly a fifth of the total sits in the D1 orphans and disappears with them. | Implementation | Minor | High | High | **1.0** | Rolling |

## Second pass — July 31, 2026 (systems layer)

The first pass measured pages and components. This pass measured the *systems beneath them*: the type scale, spacing scale, stacking order, responsive breakpoints, interaction-state coverage, and the JavaScript behind the duplicated CSS patterns. D1–D18 were re-verified unchanged (320 files, 5,601 counted violations, all three gates green).

The theme of this pass: **the tokens are good and largely unused.** Every system below has a well-designed, documented token set in `platform-tokens.css` that the code routes around. This is not a design problem — it is an adoption problem, and most of it is mechanical substitution rather than a decision.

| # | Issue | Category | Sev | Freq | Effort | Score | Status |
|---|---|---|:---:|:---:|:---:|:---:|---|
| **D19** | **154 font sizes are declared in `px`**, which do not respond to the reader's default font-size setting (browser zoom still works, so this is a degraded-but-not-broken AA concern under WCAG **1.4.4 Resize Text**). The wider finding is easier than it looks: of 291 total font-size literals, **256 exactly equal an existing `--text-*` token** — `14px` is `--text-small`, `18px` is `--text-h4`, `0.9375rem` is `--text-ui`, and so on. That is pure substitution with no design decision attached. Only **35 are genuinely off the type scale** (17px ×7, 22px ×5, 19px ×4, 28px ×6, plus singletons at 9, 21, 44, 54, 88px). Overall the platform is 81% tokenised on type (1,268 `var()` vs 295 literals). | Accessibility / Implementation | Moderate | High | Low | **6.0** | Open |
| **D20** | **Stacking order is decided by escalation, not by the ladder.** `platform-tokens.css` defines a clean ten-step `--z-*` scale (`--z-dropdown` 100 → `--z-dialog-highest` 10004). Only **42 of 241** `z-index` declarations use it; **199 are literals across 36 distinct values**, including `9999` (×11), `10000` (×10), `10001` (×4), `999`, `998`, `1001`, `900`, `899`. Raw `9999` and `10001` sit either side of the tokenised `--z-dialog: 10000`, so whether a dialog covers an overlay currently depends on which file won the last increment. This is the mechanism behind the "modal appears underneath" class of bug. | Implementation / Structural | Moderate | High | Med | **3.0** | Open |
| **D21** | **The responsive system in the code is not the one in the tokens.** Sanctioned breakpoints are 480 / 640 / 768 / 960 / 1120 / 1280. Of 246 media queries, **97 (39%) sit off that set** — and the two biggest offenders are not edge cases: **`1024px` is the second most-used breakpoint in the entire platform (39 queries)** and **`600px` the fourth (27)**, neither of them a token. Meanwhile the sanctioned `1120px` and `1280px` are barely used. Near-misses compound it: 767, 769, 700, 800, 820, 880, 900, 992, 1080, 1100, 1200. (CSS cannot use `var()` inside `@media`, so literals are unavoidable — but the *values* should still be the sanctioned six.) | Structural | Moderate | High | Med | **3.0** | Open |
| **D22** | **Sixteen JavaScript toast implementations** sit behind D8's twelve CSS families — `js/toast.js`, `includes/components/components.js`, `js/myworkshopr.js`, `js/onboarding.js`, `js/listing-page.js`, six separate `planner/js/modules/*`, `planner/js/app.js`, `planner/js/planner-v2.js`, `planner/live/live-mode.js`, `planner/brief/js/launchpad.js`, and the prework tree. D8 is therefore larger than a CSS consolidation: the behaviour is forked too. Fix them as one item. | Visual / Implementation | Moderate | High | Med | **3.0** | Open — merge with D8 |
| **D23** | **191 native `alert()` / `confirm()` calls are production UI** (104 alerts, 87 confirms) across 19 JS files — unstyled browser chrome in a product with a full modal system. Worst: `planner/js/planner-v2.js` (11), `js/myworkshopr.js` (11), `js/planner.js` (7), `facilitator/js/modules/voice-notes.js` (7). This is how the flagship app reports failure: `alert('Failed to load plan')`, `alert('Failed to add item')`, `alert('Failed to generate share link')`. **Root cause is a genuine component gap — there is no `ws_confirm`**, only `ws_modal_start/end`, so every destructive confirmation reached for the browser instead. `confirm()` also blocks the main thread. | Visual / Documentation | Moderate | High | Med | **3.0** | Open — needs `ws_confirm` first |
| **D24** | **Interaction states were never designed for four apps.** `academy/` and `dna/` ship **zero** empty states, **zero** skeletons and **zero** error states; `facilitator/` and `synthesize/` have skeletons but no empty states. Error states are close to absent platform-wide — one file in `library/`, one in `admin/`, none anywhere else — despite `ws_empty_state`, `ws_skeleton` and `ws_alert` all existing and being used elsewhere. Classic "shipped the happy path" debt: the first-run and failure experiences in these apps are undesigned, which is why D23's `alert()` calls exist. | Structural | Moderate | Med | Med | **2.0** | Open |
| **D25** | **241 genuinely off-scale spacing values.** Of 1,322 literal-px `padding`/`margin`/`gap` declarations, **1,081 land exactly on a sanctioned step** (pure substitution). The remaining 241 are real drift, in two flavours: sub-step values that read as nudges (`3px` ×48, `1px` ×33, `5px` ×31, `7px` ×18, `9px` ×17) and large gaps with no token (`28px` ×25, `60px` ×21, `36px` ×9, `56px` ×8, `80px` ×6). The large ones are worth a token decision; the nudges are worth deleting. Platform is 65% tokenised on spacing (2,484 `var()` vs 1,322 literals). | Implementation | Minor | High | Med | **1.5** | Open |

| **D26** | **Two genuine token gaps surfaced by D15**, both in shared `ws_*` components: the warning banner uses amber-50 `#FFFBEB` where the sanctioned `--color-warning-surface` is orange-50 `#FFF7ED` (the warning family is amber elsewhere, so the *token* may be the wrong one); and `.ws-checkbox-card__icon--purple` needs a purple that exists only as planner-scoped `--planner-custom-color`. Each is one decision, then a one-line change. | Documentation | Minor | Low | Low | **1.0** | Open — needs a design call |

### Measurement note — a repeat of the D9/D14 trap, caught before it shipped

My first cut of D25 flagged `2px`, `6px`, `10px`, `14px` and `18px` as off-grid, on the assumption of a 4px scale — roughly 350 phantom violations. The Workshopr scale has **half-steps** (`--space-0-5` 2px through `--space-4-5` 18px), so all five are sanctioned. Corrected before entry.

That is the third time in two passes that a plausible assumption about the design system produced inflated debt numbers (D9's `var()` fallbacks, D14's launchpad count, this one). **Read the token file before counting against it** — and treat any inherited debt figure as unverified until you have.

**A fourth, found during remediation: D2 was 81, not 60.** The detector stripped `<?php … ?>` blocks with a generic `<[^>]+>` tag regex — which swallows a PHP block whole, since it contains no `>` until `?>`. Twenty-one buttons with perfectly good PHP-rendered labels (`<?php echo $isNew ? 'Create Exercise' : 'Save Changes'; ?>`) therefore looked empty. Correcting it needed two passes: first over-correcting the other way, because `<?= icon('close') ?>` *does* render an icon with no text and must still count. The distinction that matters is **what the PHP emits**, not whether PHP is present.

**A fifth, and the largest: D3 was 94, then 130, and is actually 40 — one of which mattered.** Three different regexes gave three different answers. `<img\b[^>]*>` truncates at the first `>`, which inside `<?= $x ?>` is the one in `?>` — so any `alt` after a PHP attribute was invisible, undercounting. Widening it to `(?:[^>]|<\?.*?\?>)*?` made it worse: the `[^>]` branch matches the `<` of `<?=` first, so the PHP branch never fired and the same truncation persisted, this time reported as 130 *missing* alts on tags that plainly had them. Only ordering the alternation PHP-block-first — `(?:<\?.*?\?>|"…"|[^>"'])*` — gives the real number.

**The lesson is not "write better regexes."** It is that four of these five errors were caught only by *reading the matches*. The 130-count looked authoritative and was almost entirely false; one glance at the quoted context showed `alt="<?= htmlspecialchars($card['name']) ?> card, front"` sitting right there in a supposedly alt-less tag.

Five measurement errors in five attempts. Before acting on any figure in this register, re-derive it, and **read ten actual matches before believing any total.** A count you have not eyeballed is a hypothesis, not a finding.

### Scoreboard correction

Two of the register's Critical items were largely artifacts (D3 real count 1, not 94; D2 real count 60, not 81). That does not vindicate the codebase — D2's 60 were genuine Level A failures now fixed — but it does mean **the accessibility block is meaningfully smaller than the first pass claimed.** D4, D5, D6 and D7 have not been re-derived and should be treated as unverified until they are.

## Write-offs — documented, not scheduled

- **Admin design-system adoption.** `admin/` has 11 `ws_*` calls against 750 raw form controls across 120 files — effectively zero adoption. Internal tool, staff-only reach, and a full migration is a project-sized effort for no user-facing gain. Fix opportunistically when a page is touched for other reasons; do not schedule. (D1 is the exception — that one is worth doing on its own.)
- **`coach/`** — bespoke component library by documented decision (`coach/CLAUDE.md`). Excluded from this audit, not debt.
- **`emails/` and `includes/email-templates/`** — inline styles and non-platform fonts are required by email clients. Correct as-is.
- **Planner activity-type colors** (exercise blue, icebreaker green, break gray, custom purple) — sanctioned functional-coding exception to Red Unification. Not debt.
- **Launchpad / Prep token drift** — both hidden from production nav since June 2026. Re-measure against D9's corrected rule before scheduling; the recorded numbers are inflated.

## Remediation plan

**Quick wins — under a day each, no design decisions needed**

1. **D9 — fix `check-page.php` to skip `var()` fallbacks**, mirroring the fix already in `ds-lint.mjs`, then re-run `--baseline`. Do this *first*: it makes every number below trustworthy and removes 855 phantom violations. It also unblocks re-measuring D14 and the launchpad/prep write-off.
2. **D1 — delete the 26 orphaned flat admin pages** after confirming no external bookmarks or cron jobs hit them. Removes ~11,400 lines, 591 violations (10.6% of the register), and a stale admin surface. **Destructive — needs your sign-off, and the divergence should be diffed first** in case a flat copy holds a fix the live one never got.
3. **D15 — replace the eight stale TODO hexes** in `components.css` with the tokens that now exist.
4. **D3 — add `alt` to the 94 bare `<img>` tags** (`alt=""` where decorative).

**Accessibility sprint — the Critical block, roughly one focused week**

D2 (83 unnamed icon buttons) → D4 (red-as-text and gray-400-as-text swaps) → D5 (pair every `outline: none` with a `:focus-visible` rule) → D7 (56 non-semantic click targets) → D6 (reduced-motion, mechanical, good filler work).

These are five separate WCAG Level A/AA failures across the whole product, and every one is low-effort per instance. This is the highest-value block in the register and the only one carrying compliance risk.

**Token adoption — mechanical, no design decisions, ideal filler work**

The second pass found ~1,600 substitutions where the literal already equals a sanctioned token: 256 font sizes (D19), 1,081 spacing values (D25), and most of the 199 `z-index` literals (D20). These need no design review and no judgement — only care. Sequence them:

1. **D20 first**, because it fixes bugs rather than tidiness. Map the 36 literal z-index values onto the ten-step `--z-*` ladder; the `9999`/`10000`/`10001` cluster around `--z-dialog` is where stacking is currently accidental.
2. **D19's 154 px font sizes** → the `--text-*` equivalents. Then decide the 35 genuinely off-scale sizes: add a token or snap to the nearest step.
3. **D25's 1,081 exact matches** → `--space-*`. Delete the 1/3/5/7/9px nudges; decide tokens for the recurring large gaps (28, 36, 56, 60, 80px).
4. **D21** needs a decision before any substitution: either adopt `1024px` and `600px` into the sanctioned set (they are heavily used and conventional) or migrate 97 queries onto the existing six. Adopting is cheaper and more honest — the code has already voted.

**Structural projects — roadmap-scale, schedule deliberately**

- **D8 + D22 + D12 together**: collapse twelve CSS toast families *and their sixteen JS implementations* into `ws_toast_container`, and migrate dialogs to `ws_modal_start/end` — which delivers `role="dialog"`, `aria-modal`, and a focus trap for free, closing D12's a11y half. One motion, three register items.
- **D23 + D24 together**: build the missing `ws_confirm` helper, then replace 191 native `alert()`/`confirm()` calls with it and `ws_alert`. Doing this forces the D24 conversation — you cannot replace `alert('Failed to load plan')` without deciding what a designed error state looks like in each app. Start with `planner/` (25 of the 191 calls) since it has the most and the highest reach; `academy/` and `dna/` need the states designed from nothing.
- **D10 + D11**: button consolidation and token-namespace unification. Do D11 first — the forked `:root` blocks are why button families drifted in the first place.
- **D13**: retire `<!DOCTYPE>` forks app by app, trimming `LAYOUT_FILES` in `check-page.php` as each retires. That list shrinking is the progress metric.
- **D16**: decide `planner/live/` — delete or un-deprecate. It removes 2,659 lines from D10/D11/D12's scope, so decide before scoping those.
- **D17**: move prototype trees out of served directories.

**Rolling**

D18 token drift and D6 reduced-motion, fixed per-file as files are touched. The ratchet already prevents new instances; these only shrink.

## How to re-run this audit

```bash
php design-system/tools/check-drift.php          # token/JSON mirror in sync
php design-system/tools/check-page.php --all     # page ratchet, exit 0 = no new drift
npm run lint:ds                            # fonts, cool-gray hex, phase-color leakage
```

None of the three measure accessibility, structural duplication, or pattern fragmentation — categories D1–D8 and D12 exist because nothing automated looks for them. Re-derive those by hand next quarter, or add them to `check-page.php` as new rules (D2, D3, D5, and D7 are all regex-detectable and would ratchet cleanly).
