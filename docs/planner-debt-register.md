# Planner Design Debt Register

Living document — created from the July 3, 2026 design-debt audit of `planner/`.
Update status as items resolve; re-audit quarterly. Priority = Severity × Frequency / Effort.

Scope audited: 17 entry pages in `planner/`, `planner/includes/`, `planner/js/`, ~35k lines across `css/planner/**`.
Sources of truth: `DESIGN.md`, `design-system/workshopr-design-system.json`, `platform-tokens.css`, `ws_*` library, `design-system/docs/ADOPTION.md`.
Reminder: Planner ships mainsite red (#E54D4D) by documented exception — red is NOT debt.

| # | Issue | Category | Severity | Frequency | Effort | Status |
|---|---|---|---|---|---|---|
| 1 | ~~Custom modal system has no `role="dialog"`, no `aria-modal`, no focus trap.~~ **RESOLVED July 2026.** Added `role="dialog"`/`aria-modal`/`aria-labelledby` to the modal markup (edit.php ×3, the reusable modal-planner.php partial → covers generator/getStarted/studio modals, saved.php iframe modal) and shipped `js/planner-modal-a11y.js` — a standalone, mechanism-agnostic focus manager (trap + restore) that watches every `.modal-overlay`/`.planner-modal-overlay` regardless of v1/v2/v3 reveal mechanism. Wired into edit/planner/planner-home/saved. Hermetically verified (8/8, both mechanisms) + live-verified on planner.php. | Accessibility | Critical | High | M | **Resolved** |
| 2 | Parallel button system: `.btn, .btn-primary/-secondary/-ghost/-outline/-destructive/-sm/-lg/-icon` competes with `ws_button`; plus one-off families (`launchpad-bottombar__btn--amber/--teal`, `live-confirm__btn`, `briefing-suggestion__btn`, …). ADOPTION.md: topbar, sidebar, index.php, landing.php still unmigrated. | Visual | Moderate | High | M | Open |
| 3 | Component gaps vs `ws_*` (per ADOPTION.md, confirmed in CSS): toasts (TWO custom toast systems in `_modals.css` alone: `.planner-toast-container` + `.calendar-success-toast`), chip input, activity badges, suggestion cards, radio/checkbox cards, results overlay. Zero `ws_modal` usage anywhere in planner/. | Visual / Documentation | Moderate | High | M–L | Open |
| 4 | CSS architecture: header.php loads 10 stylesheets spanning three generations (`design-system.css` local overrides + `app.css` + `planner-new.css` + component partials + `shared-components.css` + `unified-header.css`), plus per-page sheets (launchpad 2,848 lines, live-mode 2,656, workshop-studio 2,080, `_modals.css` 4,645). ~35–41k lines total for one app. | Structural | Moderate | High (every page load) | L (project) | Open |
| 5 | Navigation/IA drift: only 2 of 17 entry pages (planner-home, templates) use the unified global header; the rest ship a bespoke topbar. Overlapping entry points: index vs landing vs planner-home. | Structural | Moderate | High | M | Open |
| 6 | Stale project docs: CLAUDE.md names `planner-new/` as "the canonical rewrite" — **the directory does not exist** (only `css/planner/planner-new.css` survives); `header-kiosk.php` / `header-embedded.php` referenced in CLAUDE.md are gone. Misleads every contributor and agent session. | Documentation | Moderate | High (every session) | Low | Open |
| 7 | `planner/live/` still shipped though Facilitator PRD §12 declares Live Mode deprecated (features ported to /facilitator/). 2,656-line stylesheet + JS tree kept in the bundle; three live tools coexist (live mode, sidekick, facilitator). | Structural | Moderate | Low usage | M (decision + removal) | Open — needs decision |
| 8 | Prototype/mockup trees inside the served app dir: `planner/mockups/`, `planner/before-the-agenda/` (has its own dev-server config), `planner/figjam/`, `planner/prd/`, `planner/docs/` — reachable via production routing. | Structural | Minor | Low | Low | Open |
| 9 | Genuine phase-color violations: `css/planner/briefing.css:169` (#7C4DFF) and `:174` (#6D28D9) — facilitate purple in the red planner (ds-lint confirmed; only 2 real hits in planner). | Visual | Minor | Low | Trivial | Open |
| 10 | ~~Token drift concentration: hardcoded hexes — launchpad.css 288, prep.css 87, `_modals.css` 71, `_topbar.css` 68, `_history.css` 54.~~ **CORRECTED July 31, 2026 — these counts were wrong.** They included hexes inside `var(--token, #hex)` fallbacks, which are correct defensive code, not drift. launchpad.css has 315 hexes of which **313 are fallbacks and 2 are truly hardcoded**. The other figures need the same re-measurement before any work is scheduled against them. See `debt-register.md` D9 (the counting bug, present in `check-page.php` and already fixed in `ds-lint.mjs`) and D14. | Implementation | Minor | Low | Trivial | **Corrected — re-measure after D9** |
| 11 | Thin a11y coverage overall: 18 `:focus-visible` rules and 6 `prefers-reduced-motion` blocks across ~35k CSS lines; 34 `aria-*` attributes across all planner PHP. Drag-and-drop canvas has no keyboard alternative documented. | Accessibility | Moderate | High | Rolling | Open |
| 12 | ADOPTION.md accuracy: claims Phase 5 "migrated … modals.php … to ws_* components" — buttons inside modals were migrated, but modal shells remain fully custom (its own component table contradicts the summary row). | Documentation | Minor | Low | Trivial | Open |

## Write-offs (documented, not scheduled)
- `planner/email-preview.php` — 51 inline styles are **correct** (email HTML requires inline styles; email templates are excluded from platform font/token rules).
- Launchpad/Prep token drift (#10 partial) — both are hidden from production nav; fix when the feature ships, not before. Note the recorded counts are inflated (see #10) — re-measure first.

## Remediation plan
1. **Quick wins (< 1 day):** #9 briefing purple swap · #6 CLAUDE.md corrections · #12 ADOPTION.md correction.
2. **Highest-value project:** #1 + #3 together — migrate planner dialogs to `ws_modal_start/end` (gets `role="dialog"`, `aria-modal`, focus trap for free) and collapse the two toast systems into `ws_toast`. Fixes the Critical a11y item and the largest visual-consistency gap in one motion.
3. **Second project:** #2 button consolidation (finish ADOPTION.md's started migration: topbar, sidebar, index, landing).
4. **Roadmap-level:** #4 CSS consolidation + #5 header/IA unification — scope together; decide #7 (delete `planner/live/` or un-deprecate) first since it removes 2,656 lines from scope.
5. **Rolling:** #11 a11y backlog — add focus-visible + reduced-motion coverage per component as files are touched.
