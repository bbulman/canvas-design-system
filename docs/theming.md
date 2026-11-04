# Workshopr Theming System

| | |
|---|---|
| **Status** | stable — D1 decided July 3, 2026: **the entire platform is red**; phases are naming-only |
| **Governs** | how apps derive their visual identity from platform tokens without forking them |
| **Source of truth** | `design-system/platform-tokens.css` (values) · `workshopr-design-system.json` (per-app records, `colorNote` fields) |
| **Guards** | `php design-system/tools/check-drift.php` · `npm run lint:ds:dtcg` · `node scripts/ds-lint.mjs` |

## Purpose

One component library (`ws_*`) serves nine apps. Theming is how each app gets
its identity — accent, chrome, category tints — by *mapping* platform tokens,
never by redefining values. No dark mode exists or is planned; the only theme
axis is per-app branding.

## Principles

1. **Tokens flow one way.** `platform-tokens.css` defines; app CSS consumes.
   An app file that writes a raw hex where a token exists is a bug (ds-lint
   enforces this).
2. **Apps alias, they don't fork.** An app may rename a platform token into its
   own vocabulary (`--fac-purple: var(--mainsite-primary)`) — it may never
   introduce a new *value* without promoting it to platform-tokens.css first.
3. **Aliases must add meaning.** `--fac-purple → red` encodes a documented
   exception: good. `--planner-gray-200: var(--gray-200)` renames without
   meaning: frozen legacy, do not extend (audit finding B3).
4. **Exceptions live in the JSON.** Any deviation from an app's phase identity
   is recorded in `workshopr-design-system.json` → `apps.<name>.colorNote`,
   or it doesn't exist. The linter's phase map must agree with the colorNotes.
5. **Every ws_* component themes through the semantic layer** (`--button-*`,
   `--card-*`, `--modal-*` …) — that layer is currently defined but unwired
   (audit D3); wiring it is the standing migration goal.

## Architecture (three layers)

| Layer | Tokens | Who may edit |
|---|---|---|
| 1 · Global palette | `--gray-*`, `--color-*` semantic status colors, type/space/radius/shadow scales | Design-system changes only, guarded by drift/DTCG checks |
| 2 · App & phase families | `--mainsite-*`, `--planner-*`, `--coach-*`, … and `--phase-*` (all resolve red per D1) | Design-system changes; every family mirrored in the JSON |
| 3 · Semantic component tokens | `--button-*`, `--card-*`, `--input-*`, `--modal-*`, `--badge-*`, `--toast-*`, `--tooltip-*` | Theming happens here: an app that needs a different button accent overrides `--button-bg-primary` in its scope, not the component CSS |

## The Red Unification (D1, decided July 3 2026)

Every `--phase-*` and `--<app>-*` family resolves to the mainsite red family
(`#E54D4D / #C73E3E / #FECACA / #FEE2E2`). This is fully aligned across
platform-tokens.css (values + comments), the JSON (`phases`, `apps`,
`rules.phaseColors`), the ds-lint phase map (now enforcing red everywhere —
0 violations), DESIGN.md §3, and START-HERE.md.

- Never "restore" an app or phase to blue/purple/emerald.
- `--phase-*` tokens are stable and red; alias off them freely.
- Differentiation between apps comes from **category tint ramps**, not accents:
  tips (6 purple tints — the one surviving purple family), intervention/DNA
  (red ramps), coach (4 red mode tints), podcasts/meeting-platform brand colors.

## The blessed app-alias pattern

Facilitator's bridge is the model (audit B4). A new app theme is one small
`:root` block in the app's entry stylesheet:

```css
/* ============================================
   <APP> THEME BRIDGE
   Maps app vocabulary onto platform tokens.
   Values live in platform-tokens.css ONLY.
   ============================================ */
:root {
  --myapp-accent:            var(--mainsite-primary);
  --myapp-accent-dark:       var(--mainsite-dark);
  --myapp-accent-very-light: var(--mainsite-very-light);
  --myapp-ink:               var(--color-ink);
  --myapp-ink-muted:         var(--color-ink-muted);
  /* app-specific literals are allowed ONLY as promoted platform tokens */
}
```

Anti-patterns, all live in the codebase today (see audit B1–B3):
- **Shadow vocabulary** — referencing undefined tokens that survive on
  fallbacks (`var(--blue-400, #60A5FA)` where `--blue-400` exists nowhere).
  21 cases in participant.css, 43 in planner `_modals.css`. Migration owed.
- **1:1 rename walls** — re-mapping the whole gray scale under an app prefix.
  Frozen; new code uses platform names directly.
- **Raw hex** — ds-lint blocks at commit.

## Adding a new app theme (checklist)

1. Add the app family to `platform-tokens.css` layer 2 **as aliases** of an
   existing family (or promote genuinely new values with design sign-off).
2. Mirror the family in `workshopr-design-system.json` → `apps.<name>` —
   including a `colorNote` if it deviates from its phase. Run
   `php design-system/tools/check-drift.php`.
3. Add the app to the `scripts/ds-lint.mjs` phase map so the linter knows what
   to enforce.
4. Create the app's theme bridge (pattern above) in its entry CSS.
5. Regenerate the DTCG mirror: `php design-system/tools/generate-tokens-dtcg.php`.
6. Add the app row to `ADOPTION.md`.

Six steps, zero forked values.

## Exceptions

After the Red Unification most former "exceptions" dissolved — red is simply
the platform color. What remains:

| Exception | Recorded in | Why |
|---|---|---|
| Focus ring stays sky-blue `rgba(2,132,199,.5)` — the one non-red accent | audit D2 (decided: keep) + tokens comment | keyboard focus must be unmistakable against all-red UI |
| Tips' category tint ramp is purple (`--tips-cat-1..6`) | tokens + `apps.tips.categories` | category coding, not an accent |
| Facilitator's `--fac-purple*` alias *names* survive (values are red) | `apps.facilitator.colorNote` | rename churn not worth it; documented alias pattern |
| Planner activity-type colors: exercise blue `#2563EB`, icebreaker green `#10B981`, break gray, custom purple `#9333EA` | `css/planner/base/_variables.css` + CLAUDE.md §11 (sanctioned July 2026) | functional coding — item types must be distinguishable at a glance on the agenda canvas; not a brand accent |

## Related

- `token-audit-2026-07.md` — decisions D1–D3 that gate this spec's final form
- `/motion.md` (repo root) + [`motion-system.md`](motion-system.md) — the other themeable axis
- `ADOPTION.md` — per-app adoption state
- `templates/foundation-doc.md` — this document's template
