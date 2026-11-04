# Design Token Audit — July 2026

> **RESOLVED July 3, 2026.** All three decisions made and executed:
> **D1(a)** — the entire platform is red; phases are naming-only. Aligned:
> tokens comments + annotations, JSON `phases`/`meta`, ds-lint phase map
> (now 0 violations / 103 files), DESIGN.md §3, START-HERE.md, theming.md.
> **D2** — focus ring stays sky blue, documented as intentional in the tokens.
> **D3** — deprecation list added to the tokens header ("delete after Aug 2026");
> semantic component layer + `--animate-*` kept as theming/motion hooks;
> `--ease-bounce` deleted (zero consumers). Also executed: F1 (DTCG regen),
> F2 (dedupe), F3 (stale annotations), F4 via motion P3 (transition shorthands
> deprecated), motion P1 (reveal-regime tokens added, reduced-motion gated).
> Remaining follow-ups: B1/B2 shadow-vocabulary migrations, `--ws-ease-bounce`
> in `css/base/_animations.css` (local overshoot easing outside this pass).

Step 1 of the design-system consolidation pass. Findings only — no token edits
were made except regenerating the DTCG mirror (its documented fix).
Method: full read of `platform-tokens.css`, `ds-lint.mjs` + `check-drift.php` +
`lint:ds:dtcg` runs, per-token usage scan across all app CSS/PHP, undefined-token
scans of the bridge files.

## Executive summary

| Metric | Value |
|---|---|
| Tokens defined in platform-tokens.css | 344 |
| Unused (zero `var()` consumers outside the token file) | 112 (33%) |
| Undefined tokens referenced in `css/facilitator/participant.css` | 21 (survive via fallbacks) |
| Undefined tokens referenced in `css/planner/components/_modals.css` | 43 |
| Genuinely duplicated definitions in `:root` | 5 |
| ds-lint violations | 13 — all `wrong-phase`, all revealing a config/reality conflict, not CSS bugs |
| DTCG mirror (`tokens.dtcg.json`) | Was stale — regenerated during this audit |
| JSON mirror (`check-drift.php`) | PASS |

**The headline finding: the system's sources of truth disagree about what color
the platform is.** The token *values* say everything is red. The token file's own
*comments*, the JSON `colorNote` narrative, the inline annotations, and the
ds-lint phase map still describe a blue/purple/emerald phase world.

## Decision required before any token edits

### D1 — Phase abstraction vs. all-red reality (the big one)
`--phase-plan`, `--phase-facilitate`, and `--phase-reflect` all now resolve to
`#E54D4D` — while their section comments still read "Sky Blue", "Purple",
"Emerald", the facilitator token block annotates `var(--phase-facilitate)` as
`/* #7C4DFF */`, the planner/DNA exception comments promise "the phase
abstraction stays blue/emerald", and `scripts/ds-lint.mjs` still enforces purple
for tips/live-mode files (producing all 13 current violations against
*intentionally red* CSS). Coach — documented everywhere as "the app that still
renders facilitate purple" — now has red tokens and red mode tints. Tips'
"deliberate purple exception" (JSON colorNote, START-HERE) now has red tokens.

Two coherent resolutions:
- **(a) All-red is the new truth.** Phases become an organizational grouping,
  not a color system. Update: section comments, stale inline annotations, JSON
  colorNotes (tips/coach), the ds-lint phase map (kills all 13 violations),
  START-HERE's exceptions doc, and the "phase color" narrative in DESIGN.md.
  The theming spec (step 3) is then written around the red-monochrome reality.
- **(b) The recolor overreached.** Restore blue/purple/emerald to the three
  `--phase-*` families only (apps stay red), keeping the documented
  "phase = abstraction, app = exception" model true.

Everything in this pass that touches color documentation is blocked on this call.

### D2 — Focus ring is still sky blue
`--focus-ring-color: rgba(2, 132, 199, 0.5)` (plan blue) — the only surviving
blue in the system. Keep (a11y-distinct focus color is defensible, arguably
better than red-on-red) or align to the red family. Recommend: **keep**, and
document it as intentional.

### D3 — Unused-token disposition (112 tokens)
Not one bucket. Proposed split:
- **Keep + wire (do not delete):** the semantic component layer (`--button-*`,
  `--card-*`, `--input-*`, `--modal-*`, `--toast-*`, `--tooltip-*`, `--badge-*`),
  composed motion (`--animate-*`), `--focus-ring-*`, `--container-*`, `--bp-*`.
  These are the theming and motion hooks steps 3–4 of this pass are about;
  they're "unused" because components.css predates them.
- **Deprecate/delete candidates:** `--podcasts-spotify/apple/amazon/youtube`,
  `--planner-blue-dark/-light`, `--tips-cat-6`, unused `--*-gradient/-shadow`
  app variants, `--text-cool-*`, `--color-purple-200`, `--color-orange-200`.
- **Stale-comment tokens:** `--z-dialog*` (comment claims planner live-mode
  uses them; nothing does).

## Findings (no decision needed — mechanical)

| # | Finding | Fix |
|---|---|---|
| F1 | DTCG mirror was stale | Regenerated ✔ (`generate-tokens-dtcg.php`) |
| F2 | 5 tokens defined twice in `:root`: `--bg-page-warm`, `--bg-warm-muted`, `--color-success-ink`, `--color-warning-ink`, `--color-warning-ink-dark` (~L325–331 and ~L678–686) | Remove the first set; keep the semantic-section copies |
| F3 | Stale inline annotations: `--facilitator-*` annotated `/* #7C4DFF */` etc. while resolving red; `--z-dialog` comment names a consumer that doesn't exist | Correct after D1 |
| F4 | `--transition-*` duplicates `--duration-* + --ease-default` (two overlapping motion vocabularies) | Motion step (4) should bless one and deprecate the other |
| F5 | `--text-*` namespace holds both sizes (`--text-h1`) and colors (`--text-dark`) | Document; renaming is not worth the migration |

## Bridge-file findings (migration recommendations)

| # | File | Pattern | Recommendation |
|---|---|---|---|
| B1 | `css/facilitator/participant.css` | 21 undefined tokens (`--blue-400`, `--green-500`, `--text-primary`, `--border-default`…) — a Tailwind-ish shadow vocabulary living entirely on fallbacks | Either promote the needed names as platform aliases or migrate refs to real tokens. Highest risk: a future token with the same name silently changes this page. |
| B2 | `css/planner/components/_modals.css` | 43 undefined token refs | Same as B1; fold into the planner modal migration already tracked in planner-debt-register.md |
| B3 | `css/planner/base/_variables.css` | ~30 pure 1:1 re-mappings (`--planner-gray-200: var(--gray-200)` × whole gray scale, radii, shadows, fonts) | Freeze: no new `--planner-*` aliases; new code uses platform names. Existing 1,240+ usages: leave (mechanical churn, no value). |
| B4 | `facilitator/css/facilitator.css` | `--fac-*` aliases re-map platform tokens BUT encode the red exception (`--fac-purple → --mainsite-primary`) | Keep — this is the documented exception mechanism; the theming spec (step 3) formalizes it as *the* app-alias pattern. |

Three apps, three different alias strategies (meaningful aliases, 1:1 renames,
undefined fallbacks) — the theming spec should bless exactly one (B4's).

## Adoption snapshot
Hardcoded-value hotspots (hex count per file, excluding token definitions):
`css/planner/launchpad.css` 288 · `css/planner/prep.css` 87 ·
`css/planner/components/_modals.css` 71 · `_topbar.css` 68 · `_history.css` 54
(launchpad/prep are production-hidden — deferred per planner-debt-register.md).
Facilitator/participant CSS are near-fully tokenized after the July work.

Full unused-token list: run `bash /tmp/token-usage.sh` or see the scan method
above; the deprecate-candidates subset is listed in D3.
