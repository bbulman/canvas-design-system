# Design-system burn-down: runbook

**Goal:** `php design-system/tools/check-page.php --count` reaches **0**, net of the approved entries in `design-system/baselines/page-exceptions.json`. On 14 Oct 2026 it read 3,902 in 259 pages. `admin/_archive/` (retired, never served) and `includes/components/` (component templates) are skipped by check-page, Bill's call on 14 Oct. The agent is `.claude/agents/design-system.md`.

There are two ways a run happens. Both follow this file.

| | **Unattended** | **Local** |
|---|---|---|
| Trigger | GitHub Actions, `.github/workflows/ds-burndown.yml`, every 4 hours | a Ralph loop in a Claude Code session opened in this repo |
| Does | invisible fixes only | invisible fixes, plus visible review batches with screenshots |
| Commits | the workflow, after it verifies | the loop, after it verifies |
| Model | Sonnet (mechanical, verified swaps) | Opus (judgment, components) |
| Can reach | the repo only: no database, no FTP | the local dev server for read-only page renders |

**Invisible** means the rendered page is pixel-identical. `scripts/ds-burndown-verify-invisible.mjs` proves it: it accepts only a safe-token swap and a filemtime cache bust, and nothing else. **Visible** means anything else, and only Bill approves it.

## Files

| File | What it holds |
|---|---|
| `design-system/baselines/page-baseline.json` | the ratchet; lowered with `check-page.php --baseline-lower`, never rewritten |
| `design-system/baselines/page-exceptions.json` | exceptions; the agent proposes (`approved: false`), Bill approves |
| `design-system/burndown/runs/` | one JSON file per run: the record of progress |
| `design-system/burndown/locks.json` | files held by pending review batches; nothing else touches them |
| `design-system/burndown/deletions-proposed.md` | dead or duplicate files, with evidence, waiting on Bill |
| `design-system/burndown/approvals.md` | where Bill writes `approve NN` or `reject NN: why` (chat works too in local runs) |
| `design-system/burndown/no-render.txt` | pages never rendered for screenshots (they write on load, or need a login) |
| `design-system/burndown/harvest.json` | one record per component Bill pressed Build this on: its status, pilot, batches, the markup files left, and the files left out with a reason. Written only by `scripts/ds-harvest.mjs` |
| `design-system/burndown/.run/` | scratch for the current run (gitignored) |
| `reports/ds-burndown/batch-NN/` | a visible batch: `batch.md`, `batch.patch`, before/after screenshots |

## Unattended run (GitHub Actions)

The workflow does steps 1, 2, 5 and 6. The agent does steps 3 and 4.

1. **Start.** Record the starting state: `git status --porcelain > design-system/burndown/.run/dirty-at-start.txt` (empty in CI). Then `php design-system/tools/check-page.php --count --json --detail > design-system/burndown/.run/before.json`.
2. **Hex swaps (script, no AI).** `node scripts/ds-hex-swap.mjs --pick --out design-system/burndown/.run/hex-batch.txt` moves hardcoded hexes onto the nearest safe token on up to `pages_per_run` pages, when the CIEDE2000 distance is within `max_delta_e` in `design-system/burndown/hex-policy.json` (Bill approved unattended hex swaps on 20 Oct 2026; 0 means exact matches only). It skips email HTML and standalone pages that never load `platform-tokens.css`, picks among same-colour tokens by the CSS property, and never touches selectors, `url(#id)`, `var()` fallbacks or alpha hexes. A hex further than the cap is a colour change and stays for the local loop.
   **Pick.** `node scripts/ds-burndown-queue.mjs --mode invisible --limit 10 --json` (it skips the hex step's pages). If nothing is picked, stop: there's no invisible work left, and the remaining work belongs to the local loop.
3. **Fix (agent).** For each picked file, apply only:
   - safe-token swaps (`node scripts/ds-burndown-verify-invisible.mjs --list-safe`);
   - filemtime cache busts with a path that resolves.

   Leave every visible violation alone, and list it in the report.
4. **Check (agent).** Run `node scripts/ds-burndown-verify-invisible.mjs <files>` and `php -l`. Then check that no rule rose on any page: compare `php design-system/tools/check-page.php --count --json --detail` with `.run/before.json`. Undo any file that fails, using Edit; git is off-limits in unattended runs. End with the `DS-BURNDOWN REPORT` block.
5. **Verify (workflow).**
   - Every changed file must be in the batch.
   - The verifier, `php -l` and `check-page.php` must pass on every changed file. A file that fails is reverted.
   - Then `php design-system/tools/check-page.php --baseline-lower`.
   - `--count` must now be lower than in `before.json`, or nothing is committed.
6. **Commit and push (workflow).**
   - Stage the changed pages, `page-baseline.json`, and this run's file in `runs/`, all by name.
   - Message: `ds-burndown: <before> -> <after> (unattended)`.
   - Push to `main`. Nothing deploys: deploys stay manual FTP by Bill.

## Local run (Ralph loop, in a session opened in this repo)

You, the main session, run the steps. You call the `design-system` agent for steps 4, 6 and 7b.

1. **Start.**
   - `mkdir -p design-system/burndown/.run && git status --porcelain > design-system/burndown/.run/dirty-at-start.txt`
   - `touch design-system/burndown/.run/loop.lock`. The weekly harvest digest skips its run while it exists. Remove it when the iteration ends, however it ends.
   - `git pull --ff-only`: the unattended job may have pushed. If it can't fast-forward, stop and tell Bill.
2. **Approvals.** Bill decides on the control panel's **Design system** tab (`node content/control/server.mjs`, then http://127.0.0.1:8097/#ds), page by page. Its **Apply and commit** button runs `node scripts/ds-burndown-review.mjs apply --batch NN`: the approved pages' patches, the finish gate, `npm run check:ds`, one commit, the locks released, and a `(done …)` line per page in `approvals.md`. There is nothing for you to apply.
   - Read the `reject NN <page>: why` lines added since the last iteration and pass the reasons to the agent in step 6, so they go into its memory.
   - A page marked "Needs attention" on the panel (it no longer applies, or the gate took it back out) stays locked. Rebuild it in a new batch if it is still worth doing, then `decide --decision reject --note "rebuilt in batch MM"` on the old one.
   - **Exceptions Bill approved** (`approved: true`): nothing to do; `--count` already nets them.
   - **Deletions Bill approved** in `deletions-proposed.md`: `git rm` them, then commit `ds-burndown: remove approved dead files`.
   - **Harvest bookkeeping.** Run `node scripts/ds-harvest.mjs next --json` until it returns something other than `register`, `cancel` or `settle`. It registers what Bill pressed Build this on (on `design-system/components/review.php`), cancels what he dismissed, and settles the harvest batches he has decided; a `settle` with a `todo` (a component that needs a rebuild) is yours to carry out. A `register` with `"status": "spread"` is a `-word` entry (`-menu`, `-timeline`): differently named pieces that share only a word, so nothing is built; tell Bill to dismiss it on the review page. A `register` with `"status": "below-floor"` is hand-written on fewer than 3 pages, so nothing is built; a later `register` with no status means a third page copied it and it is now approved. `"status": "described"` is a piece an agent described in words, with no class to find its copies by, and `"status": "gone"` (or a `cancel` with `"why": "no longer suggested"`) one that left the suggestion list: neither is built, and each is one line in your report. Keep the last action it returned for step 7b. Commit `design-system/burndown/harvest.json` by name if it changed: `ds-burndown: harvest state`. Never edit `harvest.json` by hand.
3. **Measure and pick.**
   - `php design-system/tools/check-page.php --count --json --detail > design-system/burndown/.run/before.json`
   - `node scripts/ds-burndown-queue.mjs --mode all --limit 10 --json`. It already skips dirty and locked files.
4. **Invisible pass (agent).** Give the agent the batch and say *local mode, invisible pass*. It applies the invisible fixes and verifies each file with `scripts/ds-burndown-verify-invisible.mjs`.
5. **Verify and commit the invisible pass.**
   - Write the batch to `design-system/burndown/.run/batch.txt`, one path per line.
   - `node scripts/ds-burndown-finish.mjs --mode local --batch design-system/burndown/.run/batch.txt`. On each changed page it runs the verifier and `php -l`, checks that no rule rose and the page total fell, and reverts any page that fails. It then runs `--baseline-lower`, refuses if the count didn't drop, writes the run record, and prints the `stage` list. Exit 3 means nothing to commit.
   - `npm run check:ds`.
   - Stage exactly the `stage` list (`git add -- <each path>`) and commit: `ds-burndown: <before> -> <after> (local)`.
   - **Never** stage a file listed in `dirty-at-start.txt`; the finish script already leaves them out.
6. **Visible pass (agent).** Only if fewer than 5 batches are pending (count the batch folders not marked done). Give the agent the same files and say *local mode, visible pass, batch NN*. It makes the visible changes in the working tree, builds any new component per DESIGN.md §12.4, and returns its report.
7. **Package the batch** (you), with the agent's changes still in the working tree:
   1. Write the agent's per-page notes to `design-system/burndown/.run/notes.json`: `{"<page>": {"why": "<what changes on screen>", "components": ["ws_new_thing"]}}`. When the agent built or extended a component, add `"_component": {"name": "ws_new_thing", "files": [<every file it added or changed for the component>], "why": "<why no existing helper fit>"}`. A page moved onto an existing helper, with no component in the batch, gets `"uses": "ws_x"` instead.
   2. `node scripts/ds-burndown-review.mjs package --notes design-system/burndown/.run/notes.json <files>`, listing the pages only. It writes one patch per page, takes the after and before screenshots, takes the changes back out of the tree, counts the rules both ways, writes `review.json` and `batch.md`, and locks the pages. Admin pages and anything in `no-render.txt` get the diff only. With `_component` it also makes the component an item of its own, listed first: one patch for its files (new files included, and removed from the tree with the rest), a shot of its catalog `preview`, its files locked, and the deploy manifest's upload set in `batch.md`. Bill decides the component before its pages; applying commits it on its own first, and the finish gate judges its pages by the helper call (`--uses`), not by a lower count.
   3. Commit the batch folder and `locks.json` by name: `ds-burndown: batch NN ready for review`.
7b. **Harvest pass** (agent, then you). Only while fewer than 5 batches are pending, and only after step 7 has taken its changes out of the tree, so the two never share the working tree. Run `node scripts/ds-harvest.mjs next --json` again (step 7 may have changed what is due) and act on what it returns:
   - `pilot`: give the agent the action's JSON and say *local mode, harvest pilot*. It designs one helper from every copy in `markupFiles` (or an option on the closest helper), builds it per DESIGN.md §12.4, and migrates one page from `candidates`; with `layoutMove` it also moves that page onto `includes/header.php` and `footer.php`. `lastRejection` is Bill's reason for the last pilot he rejected. Package it as in step 7, with `"_component": {"name", "files", "why"}` in the notes and the pilot page as the only page, then `node scripts/ds-harvest.mjs packaged --id <id> --batch NN`, and commit the batch folder, `locks.json` and `harvest.json` by name, with `no-render.txt` if the agent added a page that writes on load: `ds-burndown: harvest <name> pilot, batch NN ready for review`.
   - `rollout`: give the agent the action's JSON and say *local mode, harvest rollout*. It moves each file in `files` onto `helper`, answering any reason in `rejectedBefore`, and reports the files it had to leave out. Record each with `node scripts/ds-harvest.mjs note --id <id> --blocked <file> --why "..."` (or `--not-migratable` for a copy in JavaScript), package the rest with `"uses": "<helper>"` on every page, run `packaged`, and commit as for a pilot, with `rollout` in the message.
   - `blocked`: report the shared files Bill must commit before anything can be built. `no-pilot`: report it with the line that lets the pilot move its page onto the layout, `harvest <id>: layout-move pilot ok`, for Bill to add to `approvals.md` if he wants it. `none`: nothing to do.
   - If the agent stops before its work is packaged, take its changes back out of the tree by reversing its own diff (`git diff -- <its files> | git apply -R`, plus removing any file it created). Never `git checkout` a file. `harvest.json` is unchanged, so the next iteration offers the same action.
8. **Record.** The finish script wrote `design-system/burndown/runs/<UTC>-local.json` in step 5. Add the batch made, exceptions and deletions proposed, and blockers to it, and commit it with the batch commit in step 7 or 7b, with `harvest.json` if it changed.
9. **Report** to Bill in four lines: the count before → after, the batches waiting on him, anything blocked, and harvest (`node scripts/ds-harvest.mjs status`, one line per component not done).
10. **Done check.** Print `<promise>DS BASELINE ZERO</promise>` **only** when all of these are true:
    - `php design-system/tools/check-page.php --count` reports 0;
    - no batch is pending;
    - no exception is unapproved;
    - `deletions-proposed.md` has nothing waiting;
    - no harvest component is `approved`, `blocked`, `pilot` or `rollout`.

    Otherwise just end the iteration.

### `batch.md` template

```
# Batch NN — <one-line summary>
Files: <list>
Violations removed if approved: <n> (<per rule>)
Why visible: <what changes on screen, per file>
New components: <none | ws_name: why no existing helper fits>
Component files: <none | each file, new ones marked>
Screenshots: <before/after pairs, or "diff only: admin / no-render">
Upload set: <none | the deploy manifest's output; never components.css wholesale>

Review on the control panel's Design system tab: the component first, then page by page.
```

## Harvest digest (daily, on this Mac)

The desktop-app routine `ds-harvest-weekly` (daily at 10:30 since late October, Auto, despite its id) runs `node scripts/ds-harvest.mjs weekly`. It refreshes the enforcer gate's suggested components (UI hand-built on three or more pages with no `ws_*` helper that fits), picks up to three Bill has not seen, and emails them to `ADMIN_EMAIL` through `scripts/ds-harvest-email.php`, linking to the Suggested area of `design-system/components/review.php`, where he presses Build this or Dismiss. Nothing new sends nothing; a run while the local loop holds `design-system/burndown/.run/loop.lock` skips. It uses no model and no git. Every proposal shows the component as it renders: a crop of the real element from up to three of its pages, made on `withRenderServer` (`scripts/ds-burndown-shots.mjs`), a server on a free port whose database session refuses writes and which proves it is that server before anything renders. Admin pages, `no-render.txt` and a page whose own file writes are never rendered. A proposal no page can picture is not emailed and rests seven days (`unpictured` in `.ds-enforcer/harvest-mail.json`), so later runs reach the ones below it; a run renders at most nine candidates, and a renderer that fails outright stops the run with an error. What it emailed is in `.ds-enforcer/harvest-mail.json` (gitignored). `--dry-run` prints the email and records nothing. Building what Bill marks Build this belongs to the local loop (`.scratch/ds-harvest/`, slice 05).

## Never

- Never use `check-page.php --baseline` (the full rewrite), `git add -A` or `.`, `--no-verify`, `git push --force`, or deploy.
- Never write to the database. Page renders for screenshots only read.
- Never commit a visible change Bill hasn't approved.
