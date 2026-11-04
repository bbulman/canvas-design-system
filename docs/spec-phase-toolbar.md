# ws_phase_toolbar

**Source of truth:** Figma `workshopr.io` (the plan frame and Page 1's facilitate toolbar, 2026-09-15), plus the four shipped docks it standardises.
**Status:** implemented. `includes/components/phase-toolbar.php` renders it; `includes/components/phase-toolbars.php` is the canon it renders.
**Builds on:** `ws_app_dock()` (DESIGN.md §12.9), which owns the geometry. This owns the contents.

---

## 1. Overview

A phase toolbar is the dock a phase of the platform always wears: the same slots, in the same order, with the same glyphs and the same names, on every screen of that phase.

`ws_app_dock()` already gave the platform one floating toolbar. What it did not give was an answer to "what goes in it", so each phase answered separately at its own call site. Four hand-assembled arrays meant four places to look before you could say what Plan's toolbar holds, and four places to edit when it changed. Adding a slot to Facilitate touched app code; nobody reviewing the design system could see it happen.

`ws_phase_toolbar()` moves the *shape* into the design system and leaves the *wiring* in the app.

| Owned by the design system | Owned by the app |
|---|---|
| Which slots the phase shows | The `id` a handler binds to |
| The order they appear in | The `href` a step navigates to |
| Each slot's icon | The `data-action` / `data-act` its JS dispatches |
| Each slot's name (accessible name and tooltip) | The badge counts it writes |
| The landmark label | Which slots this particular screen drops |
| Whether the phase has lead and trail pills, and their shape | The text those pills read out |

The slot key is the contract between the two columns. Renaming one is a breaking change to every call site of that phase.

### When to use

Rendering the dock for Strategize, Plan, Facilitate or Synthesize. There is no case where one of those phases should hand-assemble a `ws_app_dock()` instead.

### When not to use

- **A one-off toolbar on a screen that is not a phase.** Call `ws_app_dock()` directly. The canon is for toolbars that repeat.
- **Prove.** It has no toolbar, deliberately: see §9.
- **A single action.** A dock of one slot is a floating button. Use `ws_button()`.

---

## 2. Anatomy

The rendered anatomy is `ws_app_dock()`'s, unchanged:

```
[ lead pill ]   ( slot · slot · slot · slot )   [ trail pill ]
```

What this component adds is which of those parts each phase has, and what fills them.

| Phase | Lead pill | Slots, in order | Trail pill |
|---|---|---|---|
| **strategize** | none | reload, sentence, practice, pitch, check | none |
| **plan** | none | history, cleanup, suggest, share, export, template, deck, calendar, reset | none |
| **facilitate** | Previous (`chevron_left`) | polls, reactions, note, moment, joincode | Next (`chevron_right`, icon right) |
| **synthesize** | source count (static) | video, audio, transcript, board, photo, document | Synthesize (`auto_awesome`, icon right) |

Slot keys, glyphs and names in full are in `includes/components/phase-toolbars.php`. That file is the canon; this table is a reading of it and will be the thing that rots if the two disagree.

**Required vs optional.** Everything in the table above is rendered by default. Nothing is required of the caller except the label of a pill the canon leaves wordless (Synthesize's count), because those pills read out app state the design system cannot know. A pill left unlabelled is dropped rather than drawn blank.

---

## 3. Variants

There is one variant axis, and it is the phase. The four phases above are the whole set. A fifth appears when a new phase earns a dock, by being added to the canon rather than by growing a parameter here.

Within a phase, three sanctioned deviations:

1. **A screen drops a slot** it genuinely cannot offer: `'slots' => ['deck' => false]`. One visible line, at the call site, so the absence is legible.
2. **A screen appends a slot** only it has: `'extra' => [[...]]`. Appended after the canon's, never interleaved, so the canonical order stays recognisable.
3. **A screen rewords a slot** it owns the vocabulary for: `'slots' => ['share' => ['label' => 'Send to the room']]`. For wording, not for repurposing. A slot whose label no longer matches its glyph or its key is a new slot, and belongs in the canon.

Anything beyond those three is a design change, and the place to make it is the canon.

---

## 4. Props / API

```php
ws_phase_toolbar(string $phase, array $opts = []): string
```

| Prop | Type | Default | Required | Description |
|---|---|---|---|---|
| `$phase` | string | none | yes | `strategize`, `plan`, `facilitate`, `synthesize`. An app's own path name resolves too: `planner`, `facilitator`, `strategist`, `synth`. Anything else renders nothing. |
| `slots` | array | `[]` | no | Per-key wiring, merged over the canon's icon and label. The caller's keys win. `false` drops that slot. Keys the canon does not define are ignored. |
| `extra` | array | `[]` | no | Slots appended after the canon's, each exactly as `ws_app_dock()` takes an item. |
| `lead` | array \| false | `[]` | no | Merged over the phase's lead pill. `false` drops it. |
| `trail` | array \| false | `[]` | no | Merged over the phase's trail pill. `false` drops it. |
| `id` | string | none | no | Passed through to the dock element. |
| `class` | string | `''` | no | Extra classes on the dock (app hooks). |
| `ariaLabel` | string | the phase's own | no | Landmark label. Override only if the screen genuinely repurposes the toolbar. |
| `hidden` | bool | `false` | no | Render hidden; the app reveals it when its screen wants it. |
| `attrs` | array | `[]` | no | Additional HTML attributes on the dock. |

**Per-slot wiring** accepts everything `ws_app_dock()` accepts on an item: `id`, `href`, `active`, `disabled`, `hidden`, `attrs`, `badge`, and `icon` / `label` as the override of last resort.

**Merge order**, every time: canon first, caller second. There is no key the canon can defend against a caller who names it, which is deliberate. The canon sets what a screen gets for free, not what it is forbidden.

---

## 5. States

Slot and pill states are `ws_app_dock()`'s, and are reached the same way.

| State | How it is set | What it looks like |
|---|---|---|
| Default | the resting state | 24px white glyph on the red pill |
| Hover | pointer over the slot | state layer at 8% |
| Focus | keyboard | state layer at 12%, plus a 2px white outline offset 2px |
| Pressed | pointer or key down | state layer at 12%, slot scales to 0.96 |
| Active | `'active' => true` | state layer at 16%, `aria-pressed="true"` |
| Disabled | `'disabled' => true` | 50% opacity, not clickable |
| Hidden | `'hidden' => true` | not rendered, keeps its slot key for the app to reveal |
| Dropped | `=> false` | not rendered at all, and no element to reveal |
| Badged | `'badge' => [...]` | count pinned to the slot's corner; the app writes and shows it |

Two states belong to this component rather than the dock:

| State | Trigger | Result |
|---|---|---|
| **No toolbar** | a phase with no canon entry (`prove`, a typo, an empty string) | renders the empty string. Not an empty pill, not a warning. |
| **Wordless pill** | a pill the canon leaves unlabelled and the caller does not label | the pill is dropped. A blank red lozenge reports nothing. |

Under `prefers-reduced-motion` the state layer and the press scale hold still, as they do for the dock.

---

## 6. Behavior

**Rendering.** Synchronous, server-side, no JS of its own. The component emits exactly what `ws_app_dock()` emits; it holds no state and binds no events. Everything interactive is the app's own delegated handler, reached through the `id` or `attrs` the call site supplied.

**Order resolution.** Canon order, always. A caller's `slots` map is read by key, not by position, so writing it in a different order changes nothing. `extra` appends. This is what makes the canon worth having: reorder the canon and every screen of that phase reorders.

**Positioning and clearance.** Inherited from the dock, and still the shell's job: the shell that wears one sets `position: relative` on itself and pads its scroll region by `--app-dock-clearance` while the toolbar is showing.

**Responsive.** Under 720px the slots take a row of their own and the two labelled pills share the row beneath. The rule is the dock's and reads the viewport.

**Edge cases.**

| Case | Behavior |
|---|---|
| Unknown phase | renders `''` |
| `slots` names a key the canon does not define | ignored. Use `extra`. |
| Every slot dropped, pills kept | renders the pills, no slot pill. Legal but almost certainly a mistake. |
| Caller passes `lead` to a phase with no canonical lead | rendered, as long as it carries a label |
| Caller overrides `icon` but not `label` | the slot keeps its canonical name. The two are separate keys on purpose. |
| Two screens of one phase disagree about a slot | they should not. Both get the canon; the only sanctioned difference is a drop. |

---

## 7. Accessibility

Inherited, and unchanged from `ws_app_dock()`:

- The toolbar is a `<nav>` landmark labelled by `ariaLabel`, which now defaults to the phase's own name ("Agenda tools", "Session controls", "Add material", "Strategize steps") rather than to a generic fallback a caller might forget to replace.
- Every slot's `label` is its `aria-label` and its tooltip, so a glyph is never the whole name. The canon guarantees the label exists, which is the accessibility argument for the canon: a hand-assembled dock can ship a nameless slot, and this one cannot.
- Tooltips open upward, because the toolbar sits at the foot of the region.
- `'active' => true` announces as `aria-pressed`.
- A static pill renders as a `<span>`. Give it `role="status"` through `attrs` when its text changes while the reader works, as Synthesize's count does.
- Focus order is DOM order: lead pill, then slots left to right, then trail pill.

**What to check when adding a slot to the canon:** that its name reads as an action ("Clean up agenda", not "Cleanup"), that it is distinct from every other name in that phase when read aloud, and that the glyph is not already doing a different job elsewhere in the same toolbar.

---

## 8. Usage guidelines

### Do

```php
<?= ws_phase_toolbar('plan', [
    'id'     => 'plannerDock',
    'hidden' => true,
    'slots'  => [
        'history' => ['id' => 'versionHistoryBtn'],
        'cleanup' => ['id' => 'cleanupBtn'],
    ],
]) ?>
```

Pass wiring, take the shape.

### Don't

```php
// Don't rebuild a phase's toolbar by hand.
<?= ws_app_dock(['items' => [
    ['icon' => 'history', 'label' => 'Version history', 'id' => 'versionHistoryBtn'],
    // ...seven more, in an order nobody can check against anything
]]) ?>

// Don't reorder by reordering the caller's map. It is read by key; this does nothing.
<?= ws_phase_toolbar('plan', ['slots' => ['reset' => [...], 'history' => [...]]]) ?>

// Don't repurpose a slot. This is a new slot wearing another one's key.
<?= ws_phase_toolbar('plan', ['slots' => [
    'calendar' => ['icon' => 'delete', 'label' => 'Delete workshop'],
]]) ?>
```

### Content rules

- Slot names are verb phrases naming the act: "Mark moment", "Add a transcript", "Sanity-check the scope".
- Names are sentence case, and never end in a full stop. They are read aloud as the slot's name.
- A pill's label is the app's words, so it follows the app's own vocabulary: the same string the app shows for the same thing anywhere else on the screen.

### Related

| Component | Relationship |
|---|---|
| `ws_app_dock()` | the shape this fills. Use it directly only for a toolbar that is not a phase's. |
| `ws_app_bar()` | the document bar above. Its shared cluster is save, delete, continue. The bar acts on the document; the toolbar acts on the work. |
| `ws_button()` | when the screen's action is one action. |

---

## 9. Why Prove has no toolbar

Not an omission. The Impact Report is a surface you read and send, not one you operate: its save, share and export act on the document, so they belong in the app bar's shared cluster (DESIGN.md §12.8).

A phase earns a toolbar when it has a handful of tools you reach for *while* working, and one of them is the way forward. Prove has one act, and it is already in the bar. Adding a toolbar to give the phase symmetry with its neighbours would add a second address for actions that already have one, which is the thing §12.9's "one address per action" rule exists to prevent.

The same test applies to any phase that wants one later.
