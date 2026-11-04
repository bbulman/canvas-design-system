# Start here: the Workshopr design system

One entry point for agents, developers and designers. It says which file answers which question, and which file wins when two disagree. Counts are never written here: run the command beside a claim instead.

---

## Before you add markup: say what you are building

The component gate refuses the first edit in a session that adds markup (an element or class name the file did not have) to a `.php` or `.css` file, until you have consulted on that file. Folders such as `includes/components/`, `api/` and `tests/` are left out (the list is `componentGate.skip`). So, before that edit:

1. **Consult.** Call the enforcer's `consult_ui` with the file and one plain-words line per UI piece ("a status label on each team member row", "a confirm-before-delete dialog"). Without the MCP tool, run `node .claude/mcp-servers/design-system-enforcer/bin/ds-enforcer.mjs consult --file <path> --piece "<description>"`, repeating `--piece "<description>"` for each piece. Each piece comes back with a piece id (like `P-1a2b3c`) and the components that could build it, or with nothing fitting.
2. **Build with a candidate, or record a case.** Call one of the piece's candidates in the file. If you keep your own version, or nothing fits, call `record_case` with the file, the piece id, the markup you wrote and your reason; the shell form is `node .claude/mcp-servers/design-system-enforcer/bin/ds-enforcer.mjs record-case --json '{"file": "<path>", "reason": "<why>", "markup": "<what you wrote>", "piece_id": "<P-...>"}'`. A lookalike finding from the edit hook (a lookalike is a block class ending in a component word, such as `status-badge`, or a component's own `ws-*` root class written by hand), which ends `(finding: <key>)`, is settled the same way: switch to the component, or record a case with `"finding": "<key>"` in place of the piece id.
3. **Finishing checks it.** When you stop, or a subagent stops, every piece you declared and every new lookalike in the `.php` and `.css` files you changed must be built with a component or recorded. Each item left holds you back once, with the list; a later turn is held back again only for an item you have not seen before. If a subagent you started stops with items left, you are told at your next edit or shell command; resolve them for it.

Lookalikes in `.js` and `.html` files are reported for information while you work, never gated or queued, so there is nothing to record. A `.js` file cannot call a `ws_*` helper, but it can call the helper's twin in `js/ws.js` (step 4 below): a hand-copied `ws-*` class whose component has one is reported with the twin to use, and a new one is blocked at commit.

The four tools are `consult_ui` (before building), `record_case` (your own version, or nothing fits), `apply_review` (when Bill asks you to carry out the decisions he made on the review page, `review.php` on the local dev server) and `scan_components` (suggested new components, from bespoke patterns that keep recurring). On the review page Bill picks Use the component, Keep the agent's version or Decide later, or, for a piece nothing fits, Fine as it is or Should become a component; the page writes his choices to `review.json` and `suggestions.json` in `.ds-enforcer/`. A recorded case's finding stays quiet until the decision is carried out, and Keep, Fine as it is and Should become a component each move it into the baseline. They exist only while `componentGate.enabled` is true in `.claude/mcp-servers/design-system-enforcer/enforcer.config.json`. How the gate works and how its hooks are wired is in the enforcer's [README](../.claude/mcp-servers/design-system-enforcer/README.md).

### Before you commit

Every commit runs the design-system gate (`scripts/git-hooks/pre-commit`; `npm run ds:staged` runs it by hand after you stage). It checks the staged copy of each PHP, CSS, JS, HTML and Swift file, never the working tree: the enforcer's rules and the page check, measured against their baselines so only new findings at medium and above block, plus the drift, catalog, token-export and `js/ws.js` icon checks when you staged one of their sources. In JavaScript, a new hand-copied component that has a `ws.*` twin is blocked: call the twin. Fix what it lists and stage the fix. A finding that is genuinely right here takes `ds-lint-disable-line` on that line and a reason in the commit message; `git commit --no-verify` is for Bill to decide. CI runs the same rules on every push and pull request, so a skipped hook is still caught.

---

## Agent workflow: building UI

0. **Inside `/app/`, start from the page grid.** A view opens `.app-page`, with its content in a six-column `.app-page__main` beside the two-column rail. [app-shell-layouts.php](apps/app-shell-layouts.php) has the columns, the spans, the 1100px step and the four page archetypes; DESIGN.md §7 has the rules.
1. **Find the component.** Run `npm run ds:find -- "<need>"` (or `npm run ds:find -- "<need>" --json` for structured output) or call the design-system-enforcer MCP's `suggest_component`. Both rank the same catalog. A screen recipe (a runnable file in `recipes/`, listed in `recipes.json` and shown on [composition.php](patterns/composition.php)) is offered only when a page, screen or flow is the head noun of the request: "a page listing workshops with filters" asks for one, "a toggle on the settings page" and "the page header" ask for a component. Even then the recipe must share a synonym or two words of its own with the request, and it comes first only when it scores at least as high as the best component; otherwise it takes its place by score.
2. **Read its catalog entry and demo.** Every result comes from `components.generated.json`: the options with the only values each one takes and its default, `whenToUse`, `insteadOf` (what to use instead, and when), `a11y`, `tokens` (the platform tokens its `components.css` rules draw with), a canonical example and the demo page. The demo is the full guidance when the entry is thin.
3. **Open the preview.** The entry's `preview` is an isolated page in [the playground](components/playground.php), and `previewKind` says what it shows. `curated` is a hand-written fixture whose states you switch with `state=`; in the playground you can edit its options and copy the PHP. `auto` is a call the playground builds from the catalog entry: it proves the helper renders, but it is not curated, so trust the demo over it. `none` comes with `previewSkip`, the reason it cannot render there (it needs the database, it is app-local, or it returns data rather than markup). A recipe has a preview for each state.
4. **Build with `ws_*` helpers and tokens.** Call the helper rather than writing the markup it renders, pass only option values the entry lists, and take every colour, space, radius and shadow from `platform-tokens.css`. Arrange them with the layout helpers (`ws_stack_start`, `ws_cluster_start`, `ws_grid_start`, `ws_container_start`) rather than a flex or grid rule of your own. For red, use the brand tokens the catalog's `tokens` section marks as tier `brand`, never the legacy aliases it maps to them.
   **In JavaScript, call the twin.** A script that draws a component calls `js/ws.js` rather than writing the component's `ws-*` markup. Each `ws.*` function takes its PHP helper's arguments in the same order and its options by the same names, and returns an HTML string; the catalog entry's `js` field gives the call, and `ds:find`, `suggest_component` and `consult_ui` print it. Every value is escaped except an alert's message and a card's content, which take markup as their PHP slots do, so put text through `ws.esc()` first. Markup added after the page loaded has no behaviour yet: once it, panels included, is in the page, call `ws.init(container)`. The page loads `js/ws.js` after `components.js`, with a `?v=` cache-bust. An icon `ws.js` does not carry draws from the icon font; `npm run ds:ws-icons -- <name>` adds its SVG. `tests/design-system/ws-components.spec.js` renders every playground state through both and fails on a difference. A component with no `js` field has no twin yet; the agent components are `WsAgent` in `js/ws-agent.js`.
5. **Check it.** Run `npm run check:ds -- <changed PHP/CSS files>`, then the enforcer's `check_snippet` or `validate_file` on what you wrote, and resolve what they report. Load the affected page and run its own test as well. Know what each check can see, because a clean result from one is not a clean page:
   - **`check_snippet`** takes two arguments, `code` (the snippet itself) and `language` (`css`, `php`, `js` or `swift`); a call missing either is refused with a message naming both. An optional `file_path` tells it which app, theme file or view a Swift snippet belongs to. In a session where the tool's schema is deferred, load it first (ToolSearch) so the names are known before the call. It reports hardcoded colours, sizes, radii and shadows, inline styles, legacy tokens and lookalike classes, icons drawn under 24px (`small-icon`), option names and values the catalog does not list, and raw markup that carries a lookalike class (`<button class="btn">`, `<div class="card">`). In PHP, `check_snippet` and `validate_file` also report a raw `<button>`, `<select>`, `<textarea>` or non-hidden `<input>` as `raw-control`, the same rule as `check-page.php`, and name the helper to use instead; like the page check, they skip files under `includes/components/` and `design-system/`, where the helpers' own markup lives. Neither sees a bare heading or anything about accessibility. The enforcer reloads the catalog when `components.generated.json` changes, so a warning that contradicts the catalog entry and the template means the catalog is stale: regenerate it, and trust the template.
   - **The check-page hook** (`.claude/hooks/check-page.mjs`, running `check-page.php` on every `.php` file an agent writes) still matters, because it runs whether or not anyone called the enforcer and holds each page to its ratchet baseline. It also catches what the enforcer does not: a hand-rolled doctype, a local asset without `?v=`, and legacy lookalikes counted against `legacy-baseline.json`. It never runs on a snippet you have not written to a file.
   - **Neither checks accessibility.** No automated check here computes accessible names, landmarks, heading order or focus. Load the page and read its accessibility tree (the Browser pane's `read_page`, or a Playwright `getByRole` test): `textContent` is not the accessible name, because it includes `aria-hidden` text such as an icon's ligature word.

`npm run ds:build-eval` measures whether agents build correctly with this system: it scores builder agents' fragments for `tests/design-system/build-tasks.json`. Each builder also logs every point where the system left it to guess, find nothing, or choose between sources that disagree, and the run merges those logs into `friction.json` beside the builds: the missing context, ranked by how often agents trip on it. It is a measurement, not a step in building. `npm run ds:eval` measures whether ds:find and the MCP find the right component in the first place.

### Adding to the playground

Curated fixtures live in `includes/playground-fixtures.php`; each is database-free and prints the same PHP it renders. Add one when a helper needs states worth teaching, then add its screenshot and behaviour tests to `../tests/design-system/playground.spec.js`. Only for an intentional visual change, run `npm run test:ds -- --update-snapshots` restricted with `-g` to the tests you changed, open every image it writes, and rerun without the flag. Baselines are OS- and browser-specific, and the tests block external requests, so icon fonts show their ligature names and text uses the token fallback fonts; check the real page with its webfonts for typography and icons.

## Agent workflow: building native UI

Back Pocket, Field Guide and Workshopr Planner for Mac are SwiftUI apps that take the same tokens through their own theme files. [native.md](docs/native.md) is their guide; the `native` block of `workshopr-design-system.json` binds each app to its paths, theme files and sanctioned scopes.

1. **Find the binding and the value.** Call the enforcer's `native_apps` with the app's key for its paths, build commands and hazards, then `list_tokens` with `platform: "swift"` and the same `app` for each token as a Swift colour beside the app constants that mirror it.
2. **Build from the theme file.** Every colour, font, radius and duration comes from a named constant in the app's theme files, which mirror `platform-tokens.css`. A value the theme file lacks gets a new constant there, never a literal in a view.
3. **Check it.** Run `validate_file` on every Swift file you changed, then `npm run lint:ds:native`, which fails on any finding that `native-baseline.json` does not already hold.
4. **Render it.** Build and run it in the iOS Simulator (or run the Mac app) and screenshot it in light and dark appearance and at the largest accessibility text size. Never run a shell from inside `workshopr-app/WorkshoprApp/`.

## The design agent

The `design-agent` plugin iterates a design to a quality bar instead of drafting it once. `/design-loop <target>` starts a run: the director (`design-agent:design-director`) frames and builds, and an independent critic (`design-agent:design-critic`) scores each rendered pass with fresh eyes until the exit bar, the budget or a plateau stops it. It works through the enforcer MCP, asking it before building and checking with it after, and its exit bar includes 0 new enforcer violations on the files a run touched. Its source is `agents/design-agent/plugin/`, and `agents/design-agent/README.md` has the commands, the exit bar and the walls it keeps. `/agents/` is gitignored, so those files exist only in a local checkout, never in git or CI.

## Before you change a token or a component: ask the graph

`knowledge-graph/knowledge-graph.json` is the catalog turned into edges: which tokens each component draws with, which tokens name which, which helpers call which, what each docblock says to use instead, which helpers each recipe uses, what each legacy pattern is replaced by, and what each rule in `workshopr-design-system.json` names. `npm run ds:graph` walks it.

```bash
npm run ds:graph -- --brand-line            # the node, and every edge in and out of it
npm run ds:graph -- --brand-line --impact   # everything a change to it reaches
npm run ds:graph -- ws_badge --impact       # the components and recipes built on a helper, and the pages that call them
npm run ds:graph -- --list rule             # every node of a type
```

On a token, `npm run ds:graph -- <token> --impact` follows the tokens whose value names it, the components that draw with any of them, the components that call those, and the recipes that use them. It then reads the working tree for the pages that call those components, the scripts (and PHP pages' inline scripts) that call their `js/ws.js` twins, and the stylesheets (and PHP pages' inline styles) that name the tokens, because those change with every page edit and are not stored. `npm run ds:graph -- <name> --impact --json` gives the same as structured output, and `npm run ds:graph -- <name> --impact --no-live` skips the working tree. Know its limits:

- A component's tokens come from `components.css` only. A component styled in an app stylesheet (`ws_header`, the app shelf) lists none, though the live stylesheet search still finds that stylesheet's tokens.
- A page counts when its text calls a helper, so a page that only quotes a call counts too.
- The native apps are not in it. `native_apps` and `list_tokens` with `platform: "swift"` say which Swift constants mirror a token.
- A rule's edges are the names its text happens to mention. A file a rule names that no longer exists is kept and marked, because that is a stale rule.

---

## The source-of-truth hierarchy

When two files disagree, the higher one wins:

| Rank | File | Authoritative for | Audience |
|:----:|------|-------------------|----------|
| 1 | **`/DESIGN.md`** (repo root) | Brand, voice, writing style, visual system, UX principles, forms: the design mandate | Human and agent |
| 1 | **`/motion.md`** (repo root) | Motion stack, easings, durations, animation patterns | Human and agent |
| 2 | **`platform-tokens.css`** | The token *values* every app imports | Code |
| 2 | **`/includes/components/helpers.php`** and the templates beside it | What every `ws_*` component renders (count them with `grep -c '^function ws_' includes/components/helpers.php`) | Code |
| 3 | **`components.generated.json`** | The agent contract: every `ws_*` function, token, legacy lookalike and screen recipe, generated from rank 2 and the demos | Agents and tooling |
| 3 | **`knowledge-graph/knowledge-graph.json`** | How those components, tokens, recipes, legacy patterns and rules connect, generated beside the catalog | Agents and tooling (`npm run ds:graph`) |
| 4 | **`workshopr-design-system.json`** | Hand-maintained rules (`componentFirst`, `tokenFirst`, `phaseColors`), phases, apps, the curated option lists the catalog merges, and the `native` block that binds each native app | Agents and tooling |
| 5 | **`workshopr-style-guide.md`** | Long-form written spec | Human |
| 6 | **`apps/app-*.php`, `components/demos/*.php` and the other microsite pages** | Rendered demos and per-app guides | Human (browser) |

`DESIGN.md` and `motion.md` decide intent. `platform-tokens.css` and the helpers are the implementation truth. The catalog is generated from them, so it cannot drift silently; the hand-maintained JSON can, and `check-drift.php` guards it. The deprecated `/principles.md` and `/forms.md` are superseded by `/DESIGN.md`; don't cite them. `/taste.md` is current: it holds judgment, not rules, and links to `/DESIGN.md` for every rule.

## Other on-ramps

**Designers:** read `/DESIGN.md`, then browse the Canvas microsite (`index.php`, then `foundations/` for colors, typography, spacing and elevation, and `components/component-library.php`). `docs/workshopr-style-guide.md` is the written deep-dive, and each `apps/app-<name>.php` gives one app's do and don't.

**Developers:** import `platform-tokens.css`, find helpers with the workflow above, and see `ADOPTION.md` for what each app has migrated. Before a token or component change, `npm run ds:graph -- <token or helper> --impact` shows what it reaches. After any token, component or JSON change, run `php design-system/tools/check-drift.php` and log the change in `changelog.php` (CLAUDE.md §11 rule 6).

Supporting records: [`token-audit-2026-07.md`](audits/token-audit-2026-07.md) (decisions D1, red unification, and D2, the focus ring), [`theming.md`](docs/theming.md) (how apps theme off tokens), [`motion-system.md`](docs/motion-system.md) (the motion pattern catalog), and [`templates/`](templates/README.md) (documentation templates).

---

## The four phases, one colour

```
LEARN  ->  PLAN  ->  FACILITATE  ->  REFLECT      (all render #E54D4D red)
```

One guide per app (`ls design-system/apps/app-*.php`), four phases, one token system and one colour. Since July 2026 (decision D1 in `token-audit-2026-07.md`) the whole platform ships the red family: phases are a naming and grouping system, not a colour system. Apps differ through category tint ramps (the tips category tints, the intervention and DNA red ramps, the coach mode tints), never through an accent colour.

- Every `--phase-*` and per-app family resolves to red. Never restore an app to blue, purple or emerald: those are retired, not missing.
- The one intentional non-red accent is the sky-blue focus ring, `--focus-ring-color` (decision D2), so keyboard focus is unmistakable. Don't "fix" it.
- Legacy purple names survive in two places by design: the tips category tint tokens (real purple values) and the facilitator's purple alias names (which resolve red).
- `scripts/ds-lint.mjs` flags any blue, purple or emerald signature hex in app CSS as `wrong-phase`.

---

## Keeping it honest

- **`generate-catalog.php`** writes `components.generated.json` and `knowledge-graph/knowledge-graph.json` from `helpers.php` and the other component files, `components.css`, the demos, `platform-tokens.css`, `legacy-patterns.json`, `recipes.json` and the playground fixtures. Its header docblock documents every field. An option value counts only when `includes/components/components.css` styles the class the template renders for it; any disagreement is listed in `meta.optionConflicts`. `php design-system/tools/generate-catalog.php --check` fails when either file is stale, a curated signature drifted, an option value conflicts, a recipe disagrees with its file, or the completeness ratchet in `baselines/catalog-baseline.json` moves.
  ```bash
  php design-system/tools/generate-catalog.php          # regenerate (npm run gen:ds:catalog)
  php design-system/tools/generate-catalog.php --check  # stale, drifted or less complete: fail
  ```
- **`check-drift.php`** fails when a `ws_*` function in `helpers.php` is missing from `workshopr-design-system.json` (or the reverse), when phase-colour tokens disagree with the JSON, when a token in `platform-tokens.css` is missing from the catalog's `tokens` section, or when a demo page names a token its component's CSS does not use: a Tokens table row the CSS never reads, or a retired alias such as `--phase-learn` in example code (`npm run lint:ds:drift`).
- **`generate-tokens-dtcg.php`** writes `tokens.dtcg.json`, every token in W3C DTCG format for Style Dictionary, Figma and Tokens Studio (`npm run gen:ds:dtcg`; `npm run lint:ds:dtcg` fails when it is stale).
- **The design-system-enforcer MCP** is `.claude/mcp-servers/design-system-enforcer/`, tracked in git without its `node_modules`: on a fresh checkout run `npm --prefix .claude/mcp-servers/design-system-enforcer install`. `.mcp.json` starts it from `${CLAUDE_PROJECT_DIR}`, and `node .claude/mcp-servers/design-system-enforcer/self-test.js` checks it. Its tools: `suggest_component` (the component for a described need), `list_components`, `list_tokens` (web by default, Swift with `platform: "swift"` and an `app`), `check_snippet`, `validate_file` and `audit_page` (PHP, CSS, JS and Swift), `fix_file` (safe automatic fixes, never for Swift), and `native_apps` (each native app's binding and its live findings). An agent without MCP gets the same catalog from `npm run ds:find` and `npm run check:ds`, and the Swift rules from `npm run lint:ds:native`.
- **`npm run lint:docs`** holds this file, `llms.txt`, CLAUDE.md and DESIGN.md to what they claim: every helper, path, class and token they name must exist.
- When you add or change a component, follow CLAUDE.md §11 rule 5 (helper with its docblock, template, CSS, demo, curated JSON entry), then regenerate the catalog and rerun the checks.

---

## File map

```
design-system/
|-- START-HERE.md                  <- you are here
|-- README.md                      <- what lives in each folder
|-- llms.txt                       <- short index for AI agents
|
|   IMPLEMENTATION TRUTH
|-- platform-tokens.css            <- token values, imported by every app
|   /includes/components/          <- helpers.php and the component templates
|   /js/ws.js                      <- the same components drawn from JavaScript (ws.button() and the rest)
|
|   AGENT CONTRACT (generated, never hand-edited)
|-- components.generated.json      <- components, tokens, legacy lookalikes, recipes
|-- knowledge-graph/knowledge-graph.json <- how they and the rules connect (npm run ds:graph)
|-- tokens.dtcg.json               <- tokens in W3C DTCG format
|
|   HAND-CURATED INPUTS
|-- workshopr-design-system.json   <- rules, phases, apps, curated option lists
|-- synonyms.json                  <- how people describe components, for ds:find and the MCP
|-- legacy-patterns.json           <- lookalikes to avoid and what replaces them
|-- recipes.json, recipes/         <- screen recipes, each a runnable file
|
|   TOOLS AND RATCHETS
|-- tools/                         <- generate-catalog.php (writes the contract and the graph, guards
|                                     them with --check), generate-tokens-dtcg.php, check-drift.php,
|                                     check-page.php; refused over the web
|-- baselines/                     <- catalog-, page-, legacy-, native- and card-geometry- baselines,
|                                     page-exceptions.json; only Bill rebaselines
|
|   THE MICROSITE (folders mirror its navigation; the old flat URLs redirect, see .htaccess)
|-- index.php, changelog.php
|-- getting-started/ foundations/ apps/ patterns/ resources/ redesign/
|-- components/playground.php      <- every helper previewed, curated or auto
|-- includes/playground-fixtures.php <- the curated fixtures and the auto builder
|-- patterns/composition.php       <- the screen recipes, rendered
|-- components/component-library.php <- pattern library by problem
|-- components/demos/              <- one demo page per component
|-- apps/                          <- one guide per app: ls design-system/apps/app-*.php
|
|   WRITTEN SPEC AND RECORDS
|-- docs/                          <- the style guide, colour system, adoption tracker, native.md
|                                     (the SwiftUI apps: token contract, rules, build and run), theming,
|                                     motion, illustration guidelines, debt registers, specs
|-- audits/                        <- dated audits and the July 2026 token audit
`-- templates/                     <- documentation templates (DOC-TEMPLATE.md, foundation-doc.md, component-page.php)
```

---

## Five rules you cannot break

1. **`platform-tokens.css` and the helpers are implementation truth; `/DESIGN.md` is intent truth.** Everything else mirrors them.
2. **Warm stone greys, never cool greys.** `#FAFAF9 / #F5F5F4 / #E7E5E4`, not `#F9FAFB / #F3F4F6 / #E5E7EB`.
3. **No pure black text** (`--color-ink`) and **no pure white page background** (`--bg-page`).
4. **Fonts:** Fraunces for headlines, Inter for body. No others unless an app explicitly overrides.
5. **Red Unification (D1).** Every app renders the red family; the sky-blue focus ring is the one intentional non-red accent.
