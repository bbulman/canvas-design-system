# Workshopr Design System: folder map

**Read [`START-HERE.md`](START-HERE.md) first.** It owns the source-of-truth hierarchy, the agent workflow and the rules. This file only says what lives where. It lists no counts and no file-by-file inventory: `ls` answers those and never goes stale.

The pages are the Canvas microsite, served at `/design-system/` on workshopr.io and at the root of canvas.workshopr.io. The folders mirror the site's navigation. The URLs the pages had before they moved into folders (November 2026) redirect to them, through `.htaccess` in this folder.

```
design-system/
  START-HERE.md  README.md  llms.txt   entry points: the guide, this map, the short index for agents
  index.php  changelog.php             the microsite's home page and its changelog
  platform-tokens.css                  every token value; every app imports it
  workshopr-design-system.json         hand-maintained rules, phases, apps and curated option lists
  components.generated.json            the agent contract, generated (tools/generate-catalog.php)
  tokens.dtcg.json                     the tokens in W3C DTCG format, generated (tools/generate-tokens-dtcg.php)
  synonyms.json  legacy-patterns.json  recipes.json   inputs to the catalog and to ds:find

  getting-started/   start here, philosophy, voice, design decisions, overview, case study
  foundations/       colors, typography, icons, spacing, elevation, animations, illustrations
  apps/              one guide per app (app-*.php), app theming, the app shell layouts
  components/        the playground, the component library, In JavaScript, the review page
    demos/           one demo page per component
    php/  react/     component source for the React-based apps
  patterns/          patterns, composition (the screen recipes rendered), utilities, page templates, when to use
  resources/         presentations, video, accessibility, the token reference
  knowledge-graph/   knowledge-graph.json: how components, tokens, recipes and rules connect,
                     generated beside the catalog; query it with npm run ds:graph
  recipes/           each screen recipe as a runnable file (listed in recipes.json)
  redesign/          the app-shell redesign track
  includes/          the microsite's header and footer, the playground fixtures, the review page's data
  assets/            the playground, review and recipe stylesheets, the playground script, the slide grid
  tools/             command-line checkers and generators (check-drift, check-page, generate-catalog,
                     generate-tokens-dtcg) and the Figma plugin script; refused over the web
  baselines/         the ratchets the checks hold pages and the catalog to; only Bill rebaselines
  docs/              written guides: adoption, native apps, theming, motion, the style guide,
                     illustration guidelines, colour system, debt registers, specs
  audits/            dated audits and the July 2026 token audit
  templates/         documentation templates
  burndown/          the design-system burn-down loop's runbook, locks and run logs
```
