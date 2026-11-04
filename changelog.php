<?php
$ds_page  = 'changelog';
$ds_title = 'Changelog';

require_once __DIR__ . '/../includes/icon.php';
require_once __DIR__ . '/../includes/components/helpers.php';

require_once __DIR__ . '/includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<style>
    .changelog-entry { margin-bottom: 48px; }
    .changelog-date {
        font-size: 13px;
        font-weight: 600;
        color: var(--color-ink-faint, #A8A29E);
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 8px;
    }
    .changelog-version {
        font-family: var(--font-heading, 'Fraunces'), Georgia, serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--color-ink, #2C2416);
        margin-bottom: 16px;
        letter-spacing: -0.02em;
    }
    .changelog-tag {
        display: inline-block;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 2px 8px;
        border-radius: 4px;
        margin-right: 6px;
    }
    .changelog-tag--new { background: var(--color-success-very-light, #dcfce7); color: #166534; }
    .changelog-tag--improved { background: var(--color-info-very-light, #dbeafe); color: #1e40af; }
    .changelog-tag--fixed { background: var(--color-warning-very-light, #fef3c7); color: #92400e; }
    .changelog-tag--breaking { background: var(--color-error-very-light, #fee2e2); color: #991b1b; }
    .changelog-tag--deprecated { background: var(--gray-100, #F5F5F4); color: var(--gray-600, #57534E); }
    .changelog-list { list-style: none; padding: 0; margin: 0; }
    .changelog-list li {
        padding: 8px 0;
        border-bottom: 1px solid var(--gray-100, #F5F5F4);
        font-size: 14px;
        color: var(--color-ink-secondary, #57534E);
        line-height: 1.6;
    }
    .changelog-list li:last-child { border-bottom: none; }
    .changelog-list code {
        background: var(--gray-100, #F5F5F4);
        padding: 1px 5px;
        border-radius: 3px;
        font-family: 'JetBrains Mono', monospace;
        font-size: 12px;
        color: var(--color-ink-secondary, #486581);
    }
</style>

<div class="ds-page-header">
    <h1>Changelog</h1>
    <p>A log of additions, improvements, and fixes to the Canvas Design System.</p>
</div>

<div class="changelog-entry">
    <div class="changelog-date">November 4, 2026</div>
    <div class="changelog-version">v2.89.0: One menu panel per list, and the workshop list on ws_menu</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>ws_menu_panel($items, $options)</code></strong> and a <code>panel</code> option on <code>ws_menu</code>. The panel prints once, as <code>&lt;template data-ws-menu-template&gt;</code>; each row's <code>ws_menu</code> names it and draws only its trigger. <code>components.js</code> clones the panel in after the trigger on open (the clone gets <code>{id}-panel</code> and <code>{id}-list</code>, the list its name, the trigger <code>aria-controls</code>), fires <code>ws-menu-open</code> so a listener can cut it down to the row, and removes it on close. <code>ws.menu()</code> takes <code>panel</code> too; <code>ws_menu_panel</code> has no JS twin, as no script draws one. Demo: <a href="<?= $ds_base ?>/components/demos/menu-panel.php">one panel per list</a>, a section on the Action Menu page, and the <code>menu-panel</code> playground fixture.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The workshop list's card menu is a <code>ws_menu</code>.</strong> <code>ws_wl_menu()</code> and <code>ws_wl_menu_template()</code> (<code>app/includes/workshop-list.php</code>) are thin wrappers that keep every <code>data-wl-*</code> hook; <code>app/js/workshop-list-menu.js</code> no longer opens, places, closes or keys a menu of its own (574 lines to 464, most of what is left being the unchanged network code): it cuts each clone down to the row, runs the actions, and fills the confirmation. It inherits Tab to the next card, a 3:1 trigger, 4.5:1 danger text and <code>more_horiz</code>. Delete and "Remove from my workshops" are danger items that open the page's one confirmation (<code>ws_wl_menu_confirm()</code>, the destructive-confirmation pattern); after a delete, focus moves to the next card's menu button, or the list's heading, and is restored there after the reload. The <code>.wl-menu*</code> CSS is gone but the card-head placement.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>A modal closed while it was still fading in lost focus.</strong> <code>wsFocusWhenVisible</code>'s late focus landed in the closing dialog and dropped to <code>&lt;body&gt;</code>; <code>wsReleaseFocus</code> now cancels it, so Escape straight after a modal opens hands focus back as it should.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Menu icons with no SVG</strong> fall back to the Material Symbols ligature, now clipped to its 24px box, so a font that has not loaded never spills its name down the list.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Tests.</strong> <code>tests/design-system/wl-menu.spec.js</code> renders the listing's own PHP into a stub page with <code>/api/plans.php</code> stubbed (12 cases, no database); <code>ws-components.spec.js</code> gains two shared-panel parity cases; the four live E2E specs for the listing use the new selectors and wait for Bill to run them.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">November 4, 2026</div>
    <div class="changelog-version">v2.88.0: Folders</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>design-system/</code> is in folders.</strong> The pages follow the site's navigation: <code>getting-started/</code>, <code>foundations/</code>, <code>apps/</code> (every <code>app-*.php</code> and <code>theming.php</code>), <code>components/</code> (playground, component library, In JavaScript, the review page), <code>patterns/</code> and <code>resources/</code>. The rest by kind: <code>tools/</code> (<code>check-drift.php</code>, <code>check-page.php</code>, <code>generate-catalog.php</code>, <code>generate-tokens-dtcg.php</code>, the Figma plugin script), <code>baselines/</code> (every ratchet), <code>docs/</code>, <code>audits/</code> and <code>assets/</code>. The top level keeps only the entry docs, <code>index.php</code>, <code>changelog.php</code>, <code>platform-tokens.css</code> and the JSON data. Every reference outside history moved with them: npm scripts, CI, the pre-commit triggers and their test reference, the enforcer config and its path-keyed baseline, the hooks, the skills, the agent plugins' walls and guards, the tests and the standing docs. Each page's <code>$ds_page</code> and its nav slug now carry the folder.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>design-system/.htaccess</code></strong> redirects (301) every old page, doc, audit and asset URL to its new place, on www.workshopr.io under <code>/design-system/</code> and on canvas.workshopr.io at the root, keeping the query string. Each rule is written once per host rather than with an optional prefix, and it uses <code>RedirectMatch</code>, not mod_rewrite, so the root <code>.htaccess</code> rewrites still run for this folder. Tested on Apache 2.4 for both hosts.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The command-line tools are off the web.</strong> <code>tools/.htaccess</code> refuses the folder, and the old addresses (<code>/design-system/check-drift.php</code> and the rest, whose copies stay on the host because the deploy never deletes) answer 410 Gone. Before, <code>/design-system/check-drift.php</code> ran on any request.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The agent plugins' baseline wall</strong> (<code>agents/*/scripts/walls.mjs</code>) matched only baselines at the top of <code>design-system/</code>; it now covers <code>baselines/</code> as well.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">November 4, 2026</div>
    <div class="changelog-version">v2.87.0: The knowledge graph</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>knowledge-graph.json</code></strong>, written by <code>generate-catalog.php</code> beside the catalog: components, tokens, recipes, rules, legacy patterns and the files rules name, joined by eight edge types (<code>draws-with</code>, <code>calls</code>, <code>instead-use</code>, <code>references</code>, <code>replaced-by</code>, <code>covers</code>, <code>uses</code>, <code>mentions</code>), each documented in its <code>meta.edgeTypes</code>. Pages and stylesheets are not stored, since they change with every page edit.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>npm run ds:graph</code></strong> (<code>scripts/ds-graph.mjs</code>) shows a node and its edges, and with <code>--impact</code> what a change reaches: for a token, the tokens whose value names it, the components that draw with any of them, the components that call those and the recipes that use them, then, read live from the working tree, the pages that call those helpers, the scripts and inline scripts that call their <code>js/ws.js</code> twins, and the stylesheets and inline styles that name the tokens. <code>scripts/test/ds-graph.test.mjs</code> (<code>npm run test:ds:graph</code>, and in CI) tests the walk on a small fixture graph and holds the real graph to the catalog.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The catalog links components and tokens.</strong> Each component has <code>tokens</code>, the platform tokens named by the <code>components.css</code> rules for what it renders (the rightmost compound of a selector decides; a ws-/wl- class first, then another class its template writes, then a data attribute); each token has <code>usedBy</code>, every component that names it directly or through a token whose value names it. A helper that renders nothing of its own takes what the first helper it calls renders, read with the PHP tokenizer so a helper named in a string does not count, and a classless <code>_start</code> or <code>_end</code> takes its partner's. 97 of 131 helpers list tokens; the rest are styled outside <code>components.css</code> or return data.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Stale rule paths</strong> in <code>workshopr-design-system.json</code>, found by the graph: <code>globalHeader</code> now names <code>ws_header()</code> in <code>/includes/components/header.php</code> instead of the retired global header; the planner's stylesheets point at <code>/css/planner/</code>, with <code>planner-new.css</code> as the entry point in place of the retired <code>planner-v2.css</code>; the coach entry, a stylesheet no page loads, is gone.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Freshness.</strong> <code>generate-catalog.php --check</code> fails when the graph is stale, and the pre-commit catalog check now runs when <code>components.css</code>, <code>knowledge-graph.json</code>, <code>recipes.json</code> or a recipe file is staged.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">November 4, 2026</div>
    <div class="changelog-version">v2.86.0: An action menu, ws_menu</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>ws_menu($label, $items, $options)</code></strong> (<code>includes/components/menu.php</code>): the three dots, or a labelled button, that open a short list of actions on one card, row or page. Mode <code>menu</code> (the default) is the WAI-ARIA menu button: <code>role="menu"</code> named by its trigger, arrow keys that wrap, Home and End, type-ahead, Escape back to the trigger, Tab on to the next control. Mode <code>disclosure</code> is for a few links to other pages: a plain list in the Tab order, no menu roles; its panel is hidden until script opens it, a documented limitation. Items take <code>href</code> (http, https, mailto, tel, relative or a fragment; any other scheme, <code>javascript:</code> among them, is dropped), <code>action</code>, <code>icon</code>, <code>description</code>, <code>danger</code>, <code>disabled</code> (still focusable, its description the reason), <code>current</code>, <code>modal</code>, <code>sidePanel</code> and <code>attrs</code>, plus separators and headings that group. Options: <code>trigger</code> (icon, button), <code>icon</code> (<code>more_horiz</code>), <code>variant</code>, <code>size</code>, <code>align</code>, <code>placement</code>, <code>mode</code>, <code>class</code>, <code>attrs</code>, <code>triggerAttrs</code>. Attribute names in <code>attrs</code> and <code>triggerAttrs</code> are lowercased, and nothing the component writes itself (the trigger's ids, role, name and ARIA; an item's role, tabindex, href, type, ARIA and <code>data-ws-menu-*</code>) is taken from them, in either mode. An item whose href is refused and that has nothing else to do renders disabled rather than as a button that does nothing. A button trigger whose text <code>ws_button</code> would drop (a label of 0) is named by <code>aria-label</code>.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Destructive items confirm in a modal.</strong> A <code>danger</code> item names a <code>ws_modal</code> through <code>modal</code>, built as <code>recipes/destructive-confirmation.php</code> builds it, and the modal wins over an <code>href</code>, so a danger item is always a button. Choosing it closes the menu, puts focus on the trigger, fires <code>ws-menu-dialog</code> (never <code>ws-menu-action</code>, so a listener for the action cannot run before the confirmation) and opens the dialog, which takes focus as every <code>ws_modal</code> does and hands it back to the trigger when it closes. Any item that opens a modal or side panel fires <code>ws-menu-dialog</code>. A danger item with no modal renders disabled. Mistakes (no label, a danger item with an href or no modal, a dropped href) raise <code>E_USER_WARNING</code> on the dev server or with <code>APP_ENV=local</code>, after the helper's output buffer has closed; <code>ws.menu()</code> warns in the console on a local host.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong>MENU COMPONENT in <code>components.css</code> and <code>components.js</code>.</strong> The panel renders in place after its trigger and is shown in the top layer with the Popover API, so no clipping, transform or z-index cuts it off; it is placed against the trigger, flips when the preferred side lacks room (its entrance then drifts the right way), scrolls when neither side has it, follows the trigger on scroll and closes once the trigger has left the viewport or a scrolling container that clips it; only containers on the trigger's containing-block chain count, so one an absolutely positioned wrapper escapes never closes it. A menu that closes on its own leaves focus on its trigger, never on <code>&lt;body&gt;</code>. A click with no pointer behind it (<code>detail</code> 0) opens on the first item; a middle click on a link closes the menu as a click does. Without the API a CSS fallback places it under the trigger. Behaviour is delegated from <code>document</code> and <code>window</code>, so a menu drawn after load needs no init; <code>wsMenuOpen</code>, <code>wsMenuClose</code> and <code>wsMenuToggle</code> script it, and <code>ws-menu-open</code>, <code>ws-menu-close</code>, <code>ws-menu-action</code> and <code>ws-menu-dialog</code> bubble from the wrapper. Tokens only: items one icon tall plus padding (40px) with a fine pointer and 44px on a coarse one; a focused danger item's description in <code>--color-error-ink</code> (6.6:1 on the tint; <code>--text-muted</code> was 4.41:1); forced colours draw separators in CanvasText and disabled items in GrayText; reduced-motion and more-contrast rules. The CSS is one block, MENU COMPONENT: START to END, which deploys as a hunk of its own.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>ws.menu(label, items, options)</code></strong> in <code>js/ws.js</code>, held to the PHP markup by <code>ws-components.spec.js</code> for every fixture state and choice and thirteen hand cases, with tests of its own for empty output, ids, attributes and hrefs. <code>js/ws.js</code> carries ten more icons (43).</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Demo, playground and catalog.</strong> <a href="<?= $ds_base ?>/components/demos/menu.php">Action Menu</a> demo, a card in the component library, the curated <code>menu</code> fixture (states default, button, sections, disclosure, long) and the <code>ws_menu</code> entry in <code>workshopr-design-system.json</code>. <code>ws_select</code> and <code>ws_icon_button</code> point to it in <code>@insteadOf</code>. Tests: <code>tests/design-system/menu.spec.js</code> (27 behaviour cases) and seven screenshots in <code>playground.spec.js</code>.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Finding it.</strong> <code>synonyms.json</code> gives <code>ws_menu</code> the general names (kebab, meatball, three dots, overflow, more actions, dropdown menu, menu of links and the rest; not context menu, which is a right-click menu it is not); <code>ws_wl_menu</code> keeps only the workshop-card ones. &ldquo;Dropdown menu of actions&rdquo; now finds <code>ws_menu</code>, not <code>ws_select</code>. Three tuning cases join <code>agent-eval.json</code>.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The enforcer's lookalike gate knows <code>menu</code>.</strong> A hand-built menu in a new file is a bespoke lookalike (<code>gate/lookalikes.mjs</code>): a <code>*-menu</code> block class, a <code>*__menu</code> element class, or either set through <code>className</code> by a script (read for menus only). The 23 such classes already in the project went into <code>.ds-enforcer/baseline.json</code> one by one, so only new ones are flagged.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">November 4, 2026</div>
    <div class="changelog-version">v2.85.0: The Planner's reading column</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Planner reading column.</strong> <code>css/planner/components/_item-detail.css</code> lays the embedded builder's <code>.item-detail</code> column into the band right of the six-column canvas: <code>--app-rail</code> wide at least, three grid columns at most, from a 1320 frame up, narrowing <code>.agenda-main</code> while it is up. Empty, it lays down no surface of its own and its <code>ws_empty_state</code> runs the column's full height on <code>--bg-paper</code> instead of <code>--bg-paper-dark</code>, prompt centred. It is built from <code>ws_empty_state</code>, <code>ws_activity_badge</code>, <code>ws_text</code>, <code>ws_skeleton</code>, <code>ws_alert</code>, <code>ws_button</code>, and in the body <code>ws_category</code>, <code>ws_pill</code> and <code>ws_accordion</code>. <code>ws_planner_activity_inspector</code> was not used: it is the redesign's inspector and the live builder has not adopted that card language (enforcer case C-21f453).</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Planner cards.</strong> The <code>.item-notes-btn</code> and <code>.edit-notes-input</code> rules left with the card's notes field, and <code>.item-duration-badge</code> no longer wraps.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">November 4, 2026</div>
    <div class="changelog-version">v2.84.0: The enforcer runs anywhere, version 1.4.0</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The last Workshopr defaults left the enforcer's code.</strong> The 24px icon rule (<code>iconSize</code>), the gate's page rules and file types (<code>componentGate.pages</code>, <code>files</code>, <code>scanSkip</code>), the token-name preferences (<code>tokenNames</code>) and the tool-description examples now come from <code>enforcer.config.json</code>; radius, shadow, font and root-size advice is worked out from the tokens and <code>rootPx</code>. Workshopr's output is unchanged; its config moved to <code>configVersion</code> 3.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong>A test suite that needs no Workshopr.</strong> The enforcer's <code>npm test</code> runs against its own fixtures (an invented PHP-helper kit plus React, Vue and Svelte projects) and passes in a copy of the folder alone; Workshopr's own checks of it moved to <code>tests/enforcer/workshopr.test.mjs</code>. <code>npm run test:enforcer</code> runs both.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Tests no longer write into the repo</strong> (<code>app/views/zz-gate-test-*.php</code>), <code>fix_file</code> and the checklist report refuse a path a symlink leads outside the project, and an npm install of the enforcer finds its hoisted dependencies instead of reinstalling on every start.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">November 3, 2026</div>
    <div class="changelog-version">v2.83.0: The enforcer reads Workshopr from its config</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The enforcer's code no longer assumes Workshopr.</strong> The <code>ws_</code> and <code>ws-</code> names, <code>helpers.php</code> and <code>js/ws.js</code>, the house wording, the commit gate's page, drift, catalog, DTCG and ws.js icon checks, the component gate's skip list, review link and shell parser, and the reviewer's name now live in <code>enforcer.config.json</code> (<code>components</code>, <code>text</code>, <code>staged.checks</code>, <code>componentGate</code>). Workshopr's output is unchanged apart from the <code>apply_review</code> description, which no longer uses a pronoun.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>configVersion</code> 2.</strong> With a config older than that, <code>check --commit</code> and the commit gate stop and list the settings that moved, instead of quietly running with the component rules off; plain <code>check</code>, the edit hook and the MCP server warn once.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The commit gate reads one config.</strong> The rule check and the project checks read the same file: the staged copy once it carries <code>configVersion</code> 2, the working-tree copy with a note until then. A config that fails to parse now stops a commit that has something to check, where before the page, drift and catalog checks were skipped.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">November 3, 2026</div>
    <div class="changelog-version">v2.82.2: The comments panel's save step is gone</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Comments panel.</strong> The Strategize save step added with the panel (<code>.app-comments__save</code>, its <code>data-st-save-account</code> button and its two rules in <code>app/css/comments.css</code>) is removed, with the script's <code>ws-plan-saved</code> listener and its <code>Strategist</code> plan source. The Strategize rework took away the unsaved sentence it served and stopped loading <code>strategist.js</code>, so a step's workshop now comes from <code>?plan=</code>. Saving is the page's job in every phase; the panel offers none.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">November 3, 2026</div>
    <div class="changelog-version">v2.82.1: A side panel never slides under the scrollbar</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Side Panel.</strong> <code>.ws-side-panel</code> is sized in <code>100%</code>, not <code>100vw</code>, in its base cap and its 600px rule. Fixed in place, a percentage measures the window without its scrollbar, while <code>100vw</code> counted the scrollbar: in a narrow desktop window the full-width panel hung 15px off its left edge and left a strip on the right. Phones, whose scrollbars overlay the page, and the 360px panel at desktop width are unchanged.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">November 3, 2026</div>
    <div class="changelog-version">v2.82.0: A session shape without its energy line</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Session Shape.</strong> <code>ws_session_shape</code> takes <code>showEnergy</code> (default true). With it false the energy line and its axis word go, and the time bar stands on its own. The demo shows it under "The time bar alone", and the playground has a time-only state.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Recipe page.</strong> The setting and length are two <code>ws_link_switch</code> toggles above the session card, which now draws the time bar alone. <code>js/recipe-length.js</code> takes its length from the Length switch instead of the slider: a plain click redraws the page in place, and a modified click opens the other length as any link does.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">November 3, 2026</div>
    <div class="changelog-version">v2.81.0: Exercise tile actions, and linked cards draw as blocks</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>ws_exercise_tile</code> <code>actions</code></strong> (needs <code>href</code>): icon buttons, each <code>icon</code>, <code>label</code> and <code>attrs</code>, drawn as <code>ws_icon_button</code> at size sm padded to <code>--target-comfortable</code> (44px), named "{label} {name}" with the label as a <code>data-tooltip</code>. The tile becomes a box (<code>.ws-exercise-tile--actions</code>) whose name is the link (<code>.ws-exercise-tile__link</code>), stretched over the square by <code>::after</code>, which also carries the focus ring; the buttons sit in the grid's middle row (<code>.ws-exercise-tile__actions</code>, as wide as its buttons so the rest of the row still opens the exercise). They rise on <code>:hover</code> and <code>:focus-within</code> (opacity and a <code>--space-1</code> lift over <code>--duration-fast</code> <code>--ease-out</code>; opacity only under reduced motion) and always show under <code>(hover: none), (pointer: coarse)</code>. Below 600px a formula item holding a tile with actions is 12rem rather than 11rem, so a three-line name stays square. The recipe page uses it for Swap and Quick view, each opening a <code>ws_side_panel</code>. Demo, catalog entry and an <code>actions</code> playground state added.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>ws_exercise_tile</code> <code>linkAttrs</code></strong> (needs <code>href</code>): extra attributes on the tile's link, the tile itself or, with actions, its name. The recipe page passes its Quick view's <code>data-ws-side-panel-open</code>, <code>aria-controls</code> and <code>aria-expanded</code>, so a click anywhere on the tile opens the panel and the link and the eye button share one <code>aria-expanded</code>.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Side panel triggers can be links</strong> (<code>components.js</code>): on an <code>a[href]</code> carrying <code>data-ws-side-panel-open</code>, a plain click opens the panel and a click with Ctrl, Cmd, Shift or Alt, or any button but the main one, follows the href. Without script the link is an ordinary link. Buttons behave as before.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>a.ws-card</code></strong>: a card given <code>href</code> renders as an <code>&lt;a&gt;</code>, which nothing set to block, so it broke into inline fragments in link colour with an underline. It is <code>display: block</code> in inherited colour with no underline. No live page used a linked card before the recipe page's Swap panel.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">November 3, 2026</div>
    <div class="changelog-version">v2.80.1: JavaScript copies with a twin block at commit</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>commitGate.jsComponents: "block"</code></strong> in <code>enforcer.config.json</code>. Under <code>check --commit</code> (the pre-commit gate and CI), a new <code>hand-copied-component</code> finding in a <code>.js</code> file whose helper has a <code>js/ws.js</code> twin fails; a copy of a component with no twin yet (<code>ws_progress</code>, <code>ws_suggestion_card</code>, <code>ws_planner_card</code>, <code>ws_energy_arc_card</code>) and a bespoke lookalike still inform. The 245 existing copies are in the baseline. The edit hook's JavaScript note now says a new copy is blocked at commit. <code>test/staged.test.mjs</code> covers both outcomes.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">November 3, 2026</div>
    <div class="changelog-version">v2.80.0: The commit gate and the small-icon rule</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>small-icon</code> rule</strong> (<code>icon-size.js</code>, in <code>validate_file</code>, <code>check_snippet</code>, the edit hook and <code>check</code>): a glyph <code>font-size</code> or an icon SVG's width or height under 24px in CSS and <code>&lt;style&gt;</code> blocks, a small inline icon SVG on the 24-unit grids or inline glyph size in PHP, JS and HTML, and any <code>var(--icon-xs|sm|md)</code>. Relative sizes are left alone. 2,353 existing findings, all in mockups, docs, emails, the DNA mobile app, legacy Coach CSS and Sidekick, are recorded in <code>.ds-enforcer/baseline.json</code>.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>ds-enforcer staged</code></strong>, run by <code>scripts/git-hooks/pre-commit</code> after the CSS lint and by <code>npm run ds:staged</code>: it exports the index to a temporary snapshot and runs the enforcer's rules (<code>check --commit --fail-on medium</code>, new findings only), <code>check-page.php</code>, and, when their sources are staged, the drift, catalog, DTCG and <code>js/ws.js</code> icon checks there, so only what is committed is judged. A renamed file keeps its baseline entries; the staged copy of the enforcer runs the rules once it can. <code>check</code> gained <code>--commit</code> (JS and HTML lookalikes inform unless <code>commitGate.jsComponents</code> is <code>"block"</code>), <code>--files-from</code>, and rename-following for <code>--since</code>. CI's <code>ds-enforcer</code> job runs the same rules on every push and pull request. Tests: <code>test/icon-size.test.mjs</code>, <code>test/staged.test.mjs</code> (a throwaway worktree).</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Starting the MCP server.</strong> <code>.mcp.json</code>, <code>.codex/config.toml</code> and a new <code>.gemini/settings.json</code> start it through <code>bin/ds-enforcer.mjs</code>, which links the main checkout's dependency into a worktree that lacks it, or installs it.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">November 3, 2026</div>
    <div class="changelog-version">v2.79.4: The wand icon</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>images/icons/auto_fix_high.svg</code>.</strong> The file had been wrong since the site's first import: its path drew a sparkle, an L and a bar. Replaced with Material Symbols Outlined <code>auto_fix_high</code> (weight 400, 24px) from Google's icon CDN, in the folder's own shell (<code>fill="currentColor"</code>). <code>js/ws.js</code> carries it again (33 icons), so Agenda Check's Fix all prints the SVG PHP prints. The agent-steps playground baseline updated.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">November 3, 2026</div>
    <div class="changelog-version">v2.79.3: The 24px icon floor, site-wide</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Every icon, not only components'.</strong> <code>css/styles.css</code> sizes <code>.icon</code> to <code>max(var(--icon-lg), 1em)</code> and, with <code>components.css</code>, floors every <code>svg.icon</code> and every SVG directly inside a link, button or icon box with <code>min-width</code>/<code>min-height: var(--icon-lg)</code>. Across 89 stylesheets and the <code>&lt;style&gt;</code> blocks of PHP pages, every glyph <code>font-size</code> under 24px (258 plus 59) and every icon-SVG width or height under 24px (1,169, matched by selectors ending in <code>.icon</code> or <code>svg</code>, with charts, rings, arcs, logos, dots and the like left out) reads <code>--icon-lg</code>; a relative one (an <code>em</code>, or Synthesize's <code>calc(… * var(--tscale))</code>) became <code>max(var(--icon-lg), original)</code> so it still grows (54). Markup: 320 inline icon SVGs on the 24-unit grids (<code>0 0 24 24</code>, <code>0 -960 960 960</code>) had small <code>width</code>/<code>height</code> raised to 24 and 129 unsized ones gained them, in the same quote style; 65 inline glyph <code>font-size</code> styles went to 24px, and twelve inline styles left holding only a size or a colour moved into classes (<code>.ws-pill__icon</code> now carries the pill icon's look in <code>components.css</code>, in <code>pill.php</code> and <code>ws.pill</code> alike). Removed the pins that made icons small on purpose (<code>css/investment/styles.css</code>, as on the dashboard and Salt to Taste). The level-up card link's glyph is a 1em box with overflow hidden, so its name in words cannot widen the card before the icon font loads. <code>--icon-xs</code>, <code>--icon-sm</code> and <code>--icon-md</code> carry a purpose saying they are retired for icons; values unchanged for the native mirrors. Two footer baselines updated. Measured with the real icon font on 127 pages (every section index and every <code>/app/</code> view): 3,395 visible icons, none under 24px but two in Substack's own markup on <code>/newsletter/confirm/</code>.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">November 3, 2026</div>
    <div class="changelog-version">v2.79.2: The 24px icon floor, in every component</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Icon floor.</strong> <code>components.css</code> gives every SVG icon inside a <code>ws-*</code> component (or a <code>.listing-card</code>) a <code>min-width</code> and <code>min-height</code> of <code>--icon-lg</code>, which no smaller width a page sets can undercut, and sets an icon-font glyph there to <code>--icon-lg</code> unless its component sets it larger. 95 component declarations that sized an icon below 24px (many through a text token, which is 0.8 of its name inside the app) now read <code>--icon-lg</code>: badges, the modal, tabs, select, toast, accordion, alert close, banner, feature card, stat, checklist, empty state, breadcrumb, chip input and chips, checkbox, suggestion and choice cards, results, the audio recorder and player, level-up, the planner card, rails and inspector, how-steps, filter chips, task checklist, the journey strip, app bar and dock, sidenav, DNA CTAs, side panel, the AI mark, agent status, steps and check, source chip and card deck. Boxes made to hold an icon grew to fit: the chip's remove dot (18px to 24px), the planner card's handle (20px to 24px) and the journey strip's dots (16px and 22px to <code>--space-8</code>). <code>ws_pill</code>'s inline icon style is <code>--icon-lg</code> with line-height 1, in <code>pill.php</code> and <code>ws.pill</code> alike. Page overrides that shrank component icons are gone or raised: <code>app/css/dashboard.css</code> and <code>css/taste.css</code> (rules removed; the component now gives SVG and glyph the same box), the planner bridge, <code>css/academy/home.css</code>, <code>css/academy/styles.css</code>, <code>facilitator/css/facilitator.css</code>, <code>app/css/app-shell.css</code> and <code>synthesize/synthesize.css</code> (at least 24px under its text scale). 20 demo Tokens tables drop the text tokens only their icons read and list <code>--icon-lg</code>. 17 playground baselines updated after inspection; in them the icon font is blocked, so its ligature names show as wider text.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">November 3, 2026</div>
    <div class="changelog-version">v2.79.1: Icons are at least 24px</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Button and alert icons.</strong> <code>.ws-btn__icon</code> and <code>.ws-alert__icon</code> size their SVG or glyph to <code>--icon-lg</code> (24px) themselves. <code>css/styles.css</code> sizes every <code>.icon</code> to <code>1em</code>, so inside the app a button's icon had been about 10px while design-system pages showed 24px. Beside a label the button icon takes negative block margins of <code>(1lh - 24px) / 2</code>, so it overlaps the padding and a button with an icon is exactly as tall as one without; an icon-only button stays square around the full glyph (40px at sm). The alert icon was 20px (<code>--text-h3</code>). DESIGN.md §8 now states the 24px minimum; the alert and button demos list <code>--icon-lg</code>. Three playground baselines updated (the modal footer's icon button is no longer 10px taller than its neighbour).</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>list_components.</strong> The enforcer's component table has a JavaScript column naming each <code>js/ws.js</code> twin.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">November 3, 2026</div>
    <div class="changelog-version">v2.79.0: Components in JavaScript</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong>js/ws.js.</strong> <code>ws.button</code>, <code>ws.iconButton</code>, <code>ws.badge</code>, <code>ws.status</code>, <code>ws.duration</code>, <code>ws.category</code>, <code>ws.pill</code>, <code>ws.alert</code>, <code>ws.input</code>, <code>ws.select</code>, <code>ws.avatar</code>, <code>ws.tabs</code>, <code>ws.tabPanel</code>, <code>ws.skeleton</code>, <code>ws.emptyState</code> and <code>ws.card</code> print the markup of the PHP helper each is named after, with its arguments and options, plus <code>ws.esc</code>, <code>ws.icon</code> and <code>ws.init(container)</code> to bind tabs drawn after load. It carries 32 icons as SVG (<code>npm run ds:ws-icons -- &lt;name&gt;</code> adds one) and draws any other from the icon font. <code>tests/design-system/ws-components.spec.js</code> renders every playground state and choice of these components, and about sixty hand-written cases, through PHP and JS and compares the DOM.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Catalog <code>js</code> field.</strong> An <code>@js</code> docblock tag on each PHP helper names its twin; <code>generate-catalog.php</code> carries it, and <code>ds:find</code>, <code>suggest_component</code> and <code>consult_ui</code> print it. The enforcer's JS lookalike note now says "Use ws.button() from js/ws.js" where a twin exists, and treats <code>js/ws.js</code> and <code>js/ws-agent.js</code> as component source. Page: <a href="<?= $ds_base ?>/javascript.php">In JavaScript</a>.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>First adopter: Agenda Check.</strong> <code>agenda-check/agenda-check.js</code> draws its five buttons and its alerts with <code>ws.button</code>, <code>ws.iconButton</code> and <code>ws.alert</code> (unbordered, like the planner's own JS alerts), and <code>app/views/plan/check.php</code> loads <code>js/ws.js</code> first. Its markup changed only where the component differs from the hand copy: icons are the SVGs <code>icon()</code> prints rather than font glyphs, and each alert gains <code>role="alert"</code>, its message a <code>div</code>. The three files ship together.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">November 3, 2026</div>
    <div class="changelog-version">v2.78.0: A control under the session shape's time bar</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Session Shape.</strong> <code>ws_session_shape</code> takes <code>control</code> (rendered HTML, a <code>ws_range</code>) and <code>controlLabel</code>, and draws them as a row under the time bar: the axis word beside it, hidden from assistive technology, and the control as wide as the bar (<code>.ws-session-shape__control</code>). Documented in the demo, the JSON and the catalog; unit-tested in <code>RecipeComponentsTest</code>.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Recipe length.</strong> The recipe page's 90/60 <code>ws_link_switch</code> is a two-stop <code>ws_range</code> in that row, with "60 min" and "90 min" marked under its ends. <code>js/recipe-length.js</code> swaps in each length's own component output from a <code>&lt;template&gt;</code> and moves the time bar FLIP-style: each block is put back in its old box with <code>translateX</code> and <code>scaleX</code>, then eased home over <code>--duration-slow</code> with <code>--ease-spring</code>, its name and minutes fading back in; the energy line crossfades. Transform and opacity only, per motion.md, and skipped under reduced motion. With script off the slider is a GET form with a Show button.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">November 3, 2026</div>
    <div class="changelog-version">v2.77.1: The exercise formula spans its row</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Exercise Formula.</strong> <code>ws_exercise_formula</code> spans its container: the first tile starts the row, the last ends it, and the width the tiles leave goes into the gaps, so on a recipe page the three tiles sit under the full width of the session shape rather than at its left with 295px empty beside them. The tiles keep one width, <code>--formula-tile</code> (14rem, set on <code>.ws-exercise-formula</code>); each gap is at least <code>--space-12</code> and its plus sign stays centred in it. The gap before an item is that item's own inline-start padding, and every item has the same content-box basis, so a row too narrow for full tiles shrinks them alike. Below 600px they stack as before. The recipe print sheet sets <code>--formula-tile: 9rem</code> in place of the items' <code>max-inline-size</code>.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">November 3, 2026</div>
    <div class="changelog-version">v2.77.0: The session shape</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>ws_session_shape()</code>.</strong> An energy line over a time bar on one horizontal scale, from the Workshopr Recipe Page design. The line is an SVG named in words ("Energy starts low at Check-in, peaks during Reverse Brainstorming and ends low at Commit"). The bar is an ordered list, each block named "Check-in, 10 minutes": a linked block by <code>aria-label</code>, a plain one by hidden text, because <code>aria-label</code> on a plain span is ignored. Block widths come from <code>.ws-session-shape__block--m5</code> to <code>--m120</code>, the minutes rounded to 5, so the markup carries no inline style. Opening and closing blocks are <code>--gray-100</code> and exercises <code>--brand-soft</code>, where the design's amber and blue would have broken Red Unification. Below 600px the names give way to the minutes. Demo at <code>components/demos/session-shape.php</code>.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>List names in Safari.</strong> <code>ws_exercise_formula</code>'s <code>ol</code> and <code>ws_link_switch</code>'s <code>ul</code> carry <code>role="list"</code>. Safari drops the list role from a list with <code>list-style: none</code>, and with it the list's name ("Length", "Setting") and its count. <code>_ws_layout_open</code> already did this for stacks and grids.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">November 3, 2026</div>
    <div class="changelog-version">v2.76.1: White exercise tiles, bigger symbols and plus signs</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>ws_exercise_tile()</code>.</strong> The tile is white (<code>--bg-surface</code>) with a 2px <code>--card-border</code> edge, which strengthens under high contrast, in place of <code>--brand-soft</code> and <code>--brand-line</code>. Its symbol goes from <code>--text-h1</code> to <code>--text-display-lg</code>. A linked tile still turns its border <code>--brand</code> on hover.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>ws_exercise_formula()</code>.</strong> The plus signs are bold at <code>--text-display</code>, up from <code>--text-h2</code>, and the gap they sit in widens from <code>--space-8</code> to <code>--space-12</code> so they clear both tiles, in the row and stacked below 600px.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">November 3, 2026</div>
    <div class="changelog-version">v2.76.0: Exercise tiles, the exercise formula and the link switch</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>ws_exercise_tile()</code>.</strong> One exercise as a square: its two-letter symbol top left in Fraunces, the step's minutes top right and its name in capitals bottom right, on <code>--brand-soft</code> with a <code>--brand-line</code> border. The name comes first in the markup and the capitals are CSS, so it reads "Brainwriting, 20 minutes". A linked tile carries that as its <code>aria-label</code>, because Chrome puts a space between the grid's blocks when it computes a link's name. Demo at <code>components/demos/exercise-tile.php</code>.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>ws_exercise_formula()</code>.</strong> A recipe's tiles in order, joined by plus signs: an ordered list with the plus signs <code>aria-hidden</code> in the gap, so every tile keeps the same width. One row, stacked below 600px.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>ws_link_switch()</code>.</strong> Two to four links to versions of the same page, one current, drawn like the segmented tabs: 90 | 60, In person | Remote. Each option is a link carrying the setting, so it needs no JavaScript and prints the chosen version; the current one is <code>aria-current="true"</code> and every option is at least 44px tall. Use <code>ws_tabs</code> when panels switch in place. Demo at <code>components/demos/link-switch.php</code>.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>ws_listing_card()</code> takes <code>actions</code>.</strong> Any of <code>notes</code>, <code>favorite</code> and <code>share</code>, all three by default, so existing cards render exactly as before. A card with no Library record, such as a recipe, passes <code>['share']</code>.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Search.</strong> <code>ws_source_chip</code> answers "link back to the recording" and "back to the source". The new link switch had taken the top spot for a source-chip request on the word "link"; the eval is back to 131 of 143.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">November 2, 2026</div>
    <div class="changelog-version">v2.75.3: The app shell's sheets on tokens alone</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Brand reds.</strong> The 130 legacy aliases in <code>app/css/</code> (<code>--phase-learn</code>, <code>--phase-learn-dark</code>, <code>--phase-learn-light</code>, <code>--phase-learn-very-light</code>, the four <code>--mainsite-*</code> reds, <code>--planner-primary</code> and <code>--planner-very-light</code>) now name the brand token they resolve to. <code>--planner-very-light</code> on the launchpad nudge icon is <code>--brand-tint</code>, though its old fallback read <code>#FEE2E2</code> and <code>css/planner/base/_variables.css</code> points the alias at <code>--mainsite-light</code>: the plan view loads <code>platform-tokens.css</code> after that sheet, so the token sheet's <code>--brand-tint</code> is what painted.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>No fallbacks.</strong> 666 <code>var()</code> fallbacks are gone from the 11 sheets, each for a token defined at the top level of <code>:root</code> in <code>platform-tokens.css</code> that resolves without one. Every page that loads these sheets loads the token sheet too (<code>includes/header.php</code> through <code>css/styles.css</code>, <code>ds-header.php</code>, and <code>sidekick_new</code>'s layout), so a fallback never painted; it only held a second copy of the value that could drift. <code>--app-footer-height</code>, defined in <code>app-shell.css</code> itself, keeps its fallback.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Undefined tokens.</strong> <code>var(--bg-white, #FFFFFF)</code> is <code>var(--bg-surface)</code> and <code>var(--text-secondary, var(--gray-600))</code> is <code>var(--gray-600)</code>. Neither token was defined, so both rules painted their fallback.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Spacing.</strong> Twelve padding, margin and gap literals that sat exactly on the scale (all 2px) are <code>var(--space-0-5)</code>, the negative one <code>calc(-1 * var(--space-0-5))</code>. One-pixel hairlines, positional offsets and component dimensions stay literal. The Prove report's px type sizes, its documented reading-ramp exception, are unchanged.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">November 2, 2026</div>
    <div class="changelog-version">v2.75.2: Two more cards on the card tokens</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Sidekick card stack.</strong> <code>.sk-deck__card</code> in <code>sidekick/src/styles/redesign.css</code> takes <code>border-radius: var(--card-radius)</code> in place of <code>12px</code>. The token resolves to 12px, so nothing moves.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Flows section card.</strong> <code>.section-card</code> in <code>tools/flows/ui/flows.css</code> takes <code>var(--card-radius)</code> and <code>var(--card-padding-compact)</code>, which were <code>var(--radius-lg)</code> and <code>var(--space-3)</code>. The padding is unchanged at 12px; the corners go from 8px to the card family's 12px. With both, Check 4 of <code>check-drift.php</code> passes and the card-geometry baseline does not grow.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 31, 2026</div>
    <div class="changelog-version">v2.75.1: Taller library cards</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Listing Card.</strong> <code>.listing-card</code> in <code>css/listing-redesign.css</code> has <code>min-height: 200px</code> (it sized to its content, 139px with a one-line title). The footer's <code>margin-top: auto</code> takes the extra height, so the gap opens between the title block and the category row, and a card with a two-line title no longer stands taller than its neighbours. Tip cards, with their sketch and text, are well over the minimum and do not change. The three library popular pages, which pin the stylesheet, now ask for <code>?v=20261031</code>.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Goal card.</strong> <code>.goal-card</code> in <code>css/library/library-goals.css</code> has <code>min-height: 240px</code> (it was 181px).</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Collection pages.</strong> The 19 pages under <code>library/collections/</code> render their items with <code>renderCard()</code> but never loaded <code>css/listing-redesign.css</code>, so every <code>.listing-card</code> on them was unstyled, on production too. Each now loads it before <code>css/library/library-collections.css</code>. Beyond the <code>.listing-*</code> family the stylesheet defines only <code>.hidden</code>, which no collection page uses.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Brand collection pages.</strong> The six brand collections (18F, d.school, Google Ventures, IDEO, Liberating Structures, LUMA Institute) used <code>brand-header</code>, <code>brand-principles</code>, <code>principles-grid</code> and <code>principle-item</code>, which no stylesheet defined. They now use the <code>collection-hero</code> and <code>collection-tips</code> / <code>tips-grid</code> / <code>tip-item</code> markup the 13 topic collections use, with the principle number in a <code>.tip-icon</code>. In <code>css/library/library-collections.css</code>, the new <code>.brand-icon-large</code> (a 56px <code>--brand-tint</code> tile) stands where a topic collection shows its category badge, and <code>.principle-number</code> sets the number in <code>--font-heading</code> and <code>--brand-ink</code>. d.school's hand-built coming-soon notice is <code>ws_empty_state</code> with a Browse collections action.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Collection tips grid.</strong> <code>.tips-grid</code> is <code>repeat(auto-fit, minmax(180px, 1fr))</code>, which was <code>auto-fill</code> at 220px, so three or five items fill the row at desktop width instead of leaving an empty column or one item on its own.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 31, 2026</div>
    <div class="changelog-version">v2.75.0: Every proposed component arrives as a picture of itself</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Harvest pictures.</strong> The component email shows each proposal as it renders: a crop of the first element carrying its class on up to three of its pages, tried on up to six. It used to render only pages a committed burn-down batch had already rendered, and none had, so every email so far carried code samples. A proposal no page can picture is not emailed; the next candidate takes its place, and the unpictured one rests seven days (<code>unpictured</code> in <code>harvest-mail.json</code>) so later runs reach the ones below it. Admin pages, <code>no-render.txt</code> and a page whose own file writes are still never rendered. Each run renders at most nine candidates (one with no renderable page costs nothing), and a renderer that fails outright stops the run with an error rather than sending nothing quietly.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Read-only render server.</strong> <code>withRenderServer()</code> in <code>scripts/ds-burndown-shots.mjs</code> starts its own <code>php -S</code> on a free port with <code>WS_DB_READ_ONLY=1</code> and a one-off nonce, through <code>scripts/ds-render-router.php</code>, which answers a probe with the nonce only in a read-only process. Nothing renders until the probe answers, so a server already holding the port is never used, and it stops what it started. <code>shootElements()</code> always renders on it. <code>getDbConnection()</code> in <code>includes/config.php</code> reads the flag: a non-persistent connection set <code>SESSION TRANSACTION READ ONLY</code>, or no connection if that fails, so a page that writes on load errors instead of writing to the production database the local <code>.env</code> points at.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 31, 2026</div>
    <div class="changelog-version">v2.74.1: Harvest leaves spread suggestions alone</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Spread suggestions.</strong> The gate names a suggestion <code>-word</code> (<code>-menu</code>, <code>-timeline</code>) when it gathers differently named classes that share only a component word, such as a site search overlay and a picker's search box. <code>isSpread()</code> in <code>scripts/ds-harvest.mjs</code> marks them: <code>pickNew()</code> no longer emails one, and <code>next</code> registers one Bill pressed Build this on as <code>spread</code>, which is never piloted and is cancelled once he dismisses it. The control panel's Components block shows it as not one component and leaves it out of the approved count, and the runbook's step 2 says what to tell Bill. Families (<code>solo-*-card</code>) are unchanged.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 29, 2026</div>
    <div class="changelog-version">v2.74.0: The library card drops its sketch and description</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Listing Card.</strong> <code>ws_listing_card</code> (<code>includes/partials/listing-card.php</code>), its mirrors <code>ListingCard.php</code> and <code>ListingCard.tsx</code>, the older <code>renderCard()</code> in <code>includes/data.php</code> and the topic card on <code>library/collections/</code> no longer render <code>.listing-card-illustration</code> or <code>.listing-card-description</code>; <code>overview</code> and <code>illustration</code> are ignored. The per-page <code>illustration_path => null</code> overrides on the exercises, icebreakers, workshops and goals lists are gone. Both classes stay in <code>css/listing-redesign.css</code> for the tips cards, which keep their sketch and text. The demo page's states, options, accessibility and class tables follow.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Card share.</strong> <code>shareItem()</code>, which the card's share button calls, lives in <code>includes/footer/share.php</code> beside <code>openShareModal()</code>, so every page that loads the share modal has it. <code>js/listing-page.js</code> (now <code>?v=20261029</code> on its five pages) and <code>library/collections/</code> drop their own copies, and <code>library/goals/</code> asks <code>library-footer.php</code> for share and favorites.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Stretched cards.</strong> In <code>css/listing-redesign.css</code> the footer takes a stretched card's spare height (<code>margin-top: auto</code>) instead of the description growing, which had shown a sliver of the line after its two-line clamp. The five pages that pinned the stylesheet at <code>?v=20260212</code> now ask for <code>?v=20261029</code>.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Solutions outcome pages.</strong> The five <code>solutions/byoutcome/</code> pages render their exercises, icebreakers and workshop templates with <code>ws_listing_card</code> in a <code>ws_grid_start</code> list, from library rows picked by short code through the new <code>pickByShortCode()</code> in <code>includes/listing-helpers.php</code>. The hand-built <code>solo-exercise-card</code>, <code>solo-icebreaker-card</code>, <code>solo-template-card</code> and <code>solo-badge</code> markup and their 29 rules in <code>css/solutions-outcome.css</code> are gone; the three grids keep only their 1140px measure.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Harvest floor.</strong> <code>pickNew()</code> in <code>scripts/ds-harvest.mjs</code> drops a suggestion written on fewer than <code>MIN_PAGES</code> (3) pages, the floor the weekly email states. It had counted markup files, so a family in partials, views and admin files reached the email on two pages.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 29, 2026</div>
    <div class="changelog-version">v2.73.0: The local loop builds what Bill approves, pilot first</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Harvest state.</strong> <code>design-system/burndown/harvest.json</code> keeps one record per component Bill pressed Build this on: approved, blocked, no-pilot, pilot, rollout, done, rejected, stopped or cancelled, with its pilot, its batches, the markup files left and the files left out with a reason. Only <code>scripts/ds-harvest.mjs</code> writes it: <code>next</code> registers, cancels and settles by itself and hands the loop one piece of work (a pilot, a rollout of up to ten files, a blocked or no-pilot report); <code>packaged</code> records a batch once it exists; <code>note</code> records a file left out; <code>status</code> prints it.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong>The pilot rule.</strong> A pilot page requires the platform layout, is not admin or in <code>no-render.txt</code>, writes nothing on load, and is neither locked nor uncommitted. With none, the component is no-pilot until Bill adds <code>harvest &lt;id&gt;: layout-move pilot ok</code> to <code>approvals.md</code>. Any of the shared component files uncommitted blocks a build and names the file. One pilot waits on Bill at a time; a rejected component is rebuilt once with his reason, then stopped; a page he rejects comes back once with his reason, then is left out.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> The runbook's local run takes a loop lock, does the harvest bookkeeping in step 2, the harvest work in a new step 7b after the visible batch is out of the tree, and reports harvest; the done check waits for harvest to finish. The design-system agent has a harvest section (design from every copy, extend a near fit, pilot on a page that writes nothing, never link the platform stylesheets into a hand-rolled head), the gate's consult, record and scan tools, and no longer quotes a stale count.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 28, 2026</div>
    <div class="changelog-version">v2.72.0: A weekly email proposes new components</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong>The harvest digest.</strong> <code>node scripts/ds-harvest.mjs weekly</code> refreshes the enforcer gate's suggested components and emails Bill up to three he has not seen, ranked by how many PHP files write the markup: where each one is built, its code or a picture, how its copies differ (or, for a family, the names it goes by), and the closest existing components with what they are not for. The email links to the Suggested area of <code>design-system/review.php</code>, where Build this and Dismiss already work. Nothing new sends nothing. It runs every Monday at 10:30 as the <code>ds-harvest-weekly</code> routine, uses no model, no git and no database, and renders a page only when a burn-down batch already rendered it. <code>--dry-run</code> prints the email instead.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>pagesFor()</code> in <code>scripts/ds-harvest.mjs</code> turns a suggestion's files into the PHP files that write its markup (include partials among them) and the routable pages, leaving out CSS, JavaScript, Finder copies and a class only named in a style block. <code>scripts/ds-burndown-shots.mjs</code> gains <code>shootElements</code>, which crops the first element a selector matches.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 28, 2026</div>
    <div class="changelog-version">v2.71.0: A new component is reviewed before the pages that use it</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong>A burn-down batch can carry a new component.</strong> When the agent builds or extends a <code>ws_*</code> helper for a batch, <code>scripts/ds-burndown-review.mjs package</code> takes a <code>_component</code> note (its name and files) and makes the component an item of its own, listed first: one patch for all its files, new ones included, and a screenshot of its playground preview, cropped to the component. Every page in that batch uses it.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong>The component is decided first, and applied on its own.</strong> On the control panel's Design system tab a page that uses the component can be approved only once the component is, and rejecting the component rejects its pages with it. Applying puts the component's patch onto the index and the working tree, runs <code>php -l</code> and <code>npm run check:ds</code>, and commits exactly that, before any page. Uncommitted edits of your own in the same files stay yours and stay uncommitted. A component whose patch no longer applies is marked Needs rebuild and nothing changes.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>A page moved onto a component passes the finish gate when it calls the helper.</strong> Swapping hand-built markup for a helper rarely lowers the violation count, so <code>scripts/ds-burndown-finish.mjs --uses</code> judges such a page by the helper call, <code>php -l</code> and no rule rising, instead of a lower count. The net-progress check now runs before the baseline is lowered, so a page taken back out never leaves the baseline lowered for it.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>scripts/ds-burndown-shots.mjs</code> exports its server start, skip rules and render, and its new <code>--url</code> form renders one local path into one file. A component batch's <code>batch.md</code> lists the upload set from the deploy manifest.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 28, 2026</div>
    <div class="changelog-version">v2.70.0: Agents consult the components before they build</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong>An agent has to tell the enforcer what it is building before it adds markup to a <code>.php</code> or <code>.css</code> file.</strong> With the component gate on (<code>componentGate.enabled</code> in the enforcer's <code>enforcer.config.json</code>), the first write in a session that brings a new element or class name into such a file (for a shell command, one whose own text brings it, such as a heredoc or an echo) is refused until the agent has consulted on it, one plain line per piece, through <code>consult_ui</code> or <code>ds-enforcer consult</code>. The answer lists up to five components that could build each piece, each with an example call and a preview link, or says nothing fits. A change to wording or logic is never refused, and files matching <code>componentGate.skip</code> (<code>api/</code>, <code>tests/</code>, <code>includes/components/</code> and the rest) are never gated. A file is refused twice at most: the third attempt goes through and is recorded as an unconsulted case, so a broken enforcer never stalls a build. Before an agent finishes, every piece it declared must be built with one of its candidates or recorded as a case with its reason (<code>record_case</code>); each item left blocks that agent once, with the list, and a later turn blocks again only for an item it has not been blocked on. The hooks run from <code>.claude/settings.json</code>, which is gitignored, so only sessions in the main checkout get them; the enforcer README's "Workshopr component gate" section records the wiring.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Wider lookalike rules.</strong> The edit hook now flags, at medium severity, markup whose class names end in a component word (<code>status-badge</code>, <code>promo-card</code>, or a name ending <code>-modal</code>, <code>-toast</code>, <code>-tabs</code>, <code>-empty</code> and the like), and a component's own root class copied by hand outside <code>includes/components/</code> (a link given the <code>ws-btn</code> class by hand where <code>ws_button()</code> renders one). A hand-copied class names the helper that renders it; a bespoke name sends the agent to <code>consult_ui</code>, and the finish check lists the components that could replace it. Files <code>componentGate.skip</code> names (email templates, tests, the design system's own pages and the rest) are not checked by these rules. The 4,929 findings they raise in existing code (4,265 bespoke names, 664 hand-copied) went into <code>.ds-enforcer/baseline.json</code>, so only new ones are reported. In <code>.js</code> and <code>.html</code> files they are reported for information only, never gated, blocked or queued, since those files cannot call a <code>ws_*</code> helper. The rules run only with the gate on, so other projects using the enforcer see no change.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong>A local review page for the pieces agents kept.</strong> <code>design-system/review.php</code> shows the waiting cases one at a time: the agent's version beside the component, the agent's reason, and three choices, Use the component, Keep the agent's version and Decide later; a piece nothing fits offers Fine as it is and Should become a component instead. It runs only on the local dev server (PHP's built-in server on a loopback address, <code>localhost:8084</code>), takes changes only from its own pages, never runs the PHP in an agent's markup, renders each sample in a frame that loads only static files, and never opens a database connection. It only records Bill's choices: his decisions in <code>.ds-enforcer/review.json</code>, and Build this and Dismiss in <code>.ds-enforcer/suggestions.json</code> (both gitignored). When Bill tells an agent to apply the design system review, <code>apply_review</code> hands it each change to make, then re-checks the files and marks what is done. Keep, Fine as it is and Should become a component each move the case's finding, where it has one, into the baseline, so it does not come back.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Automatic swaps, and a report of every one.</strong> With <code>autoSwap</code> on in <code>componentGate</code> (it is off by default), hand-copied <code>ws-*</code> markup may not stay, because it maps to exactly one helper: the finish check tells the agent to switch to the helper and keeps the original line, with the lines around it to find the place, so the change can be undone. Only hand-copied markup is forced. A bespoke class name never is, and neither is anything in a file written without a consult or holding a nothing-fitting case. Nothing is swapped silently: the end-of-session summary names each automatic swap by file and component, and the review page's Changed automatically list shows every one with an Undo button.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Suggested new components.</strong> <code>scan_components</code> (or <code>ds-enforcer suggest</code>) looks through the tracked PHP, CSS and JS files for bespoke patterns that keep recurring with no component in the inventory: a class name in three or more files, or one component word across three or more bespoke classes. It adds the pieces agents built because nothing fitted and the cases Bill marked "Should become a component", and ranks the list, with each entry's classes and the agents' reasons where there are any. The Stop hook refreshes it in the background at most once a day, and the summary says when it gains an entry. On the review page each suggestion has Build this, which adds it to the build list for a future design system task, and Dismiss, which stops it being suggested again. Nothing is created automatically.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The gate reaches every agent's work, and stays quiet where it is not installed.</strong> In the desktop app a subagent hands its report back before its finish check can hold it, so the main session now takes on what a subagent left: it is told at its next edit or shell command, once, and its own finish still holds it to anything left. A shell command's changed files count only when the command names them, so another session's edits in the same checkout are never charged to the agent. The hook commands exit quietly in a checkout whose enforcer has no gate, such as a worktree branched before it.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 28, 2026</div>
    <div class="changelog-version">v2.69.0: The enforcer checks every edit, not just PHP pages</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <strong>The enforcer's own Claude Code hooks are wired in <code>.claude/settings.json</code>.</strong> They shipped with the enforcer but were written for a plugin install, so they never ran here, and only <code>.php</code> edits were checked (by <code>check-page.php</code>). Now every Edit or Write on a <code>.php</code>, <code>.css</code>, <code>.js</code>, <code>.swift</code> or <code>.html</code> file runs the same checks as <code>validate_file</code>, with no AI, in about a tenth of a second, and a new finding is handed back to Claude to fix in the same turn. When Claude finishes, the Stop hook writes <code>design-system-report.md</code> for the files edited that session (gitignored). <code>.ds-enforcer/baseline.json</code> records the 23,514 existing findings across 3,921 files, so only new ones are reported.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 25, 2026</div>
    <div class="changelog-version">v2.68.1: Three components that broke in a 360px panel</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>.ws-app-dock</code> takes <code>width: max-content</code> under its existing max-width. Positioned at <code>left: 50%</code>, an absolutely positioned box only has half its container to shrink into, so the dock wrapped its pills in any container under twice its width (the Sidekick panel). Wide pages draw exactly as before.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>.ws-btn</code> is <code>box-sizing: border-box</code>. A link button is content-box by default, so on a page without a global reset a full-width one added its padding and overflowed its column.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>ws_app_bar()</code> under 640px hides a labelled action's label from sight only. It used <code>display: none</code>, and a labelled action carries no <code>aria-label</code>, so on a phone the button had no accessible name.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 25, 2026</div>
    <div class="changelog-version">v2.68.0: A card deck for the Intervention Cards, activity badges on the type tokens, and agendas on time within a minute</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_card_deck()</code>: the Intervention Card peek from the Sidekick cockpit. Up to three <code>ws-card ws-card--compact</code> cards cascaded, the ones behind scaled to 95% and 90% a <code>--space-8</code> strip apart so only their titles show, and the front card whole: title, an icon in <code>--brand-ink</code> and a caption ("Difficult Participants · 1 of 3"). The whole deck is one link (<code>href</code>) named for every card, front first ("Intervention Cards, 3 suggested: The Naysayer, The Silent One, Running Over"); <code>name</code> and <code>label</code> shape that name, and without <code>href</code> it is a named group. <code>position</code> <code>float</code> pins it to the bottom right of its positioned container, and <code>--ws-card-deck-bottom</code> lifts it clear of a dock. On hover and focus the shadows go from <code>--shadow-md</code> to <code>--shadow-lg</code> and the strips fan open, a transform left out under <code>prefers-reduced-motion</code>. No card renders nothing. Demo, playground fixture (one, two and three cards), curated JSON, <code>tests/Unit/CardDeckComponentTest.php</code> and two new visual baselines.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>ws_activity_badge()</code> on a page without the Planner's CSS fell back to hardcoded hex, including an icebreaker green at 2.18:1 and a purple custom. It now takes the sanctioned tokens there: exercise <code>--color-info-strong</code> on <code>--exercise-very-light</code> (7.23:1), icebreaker <code>--color-success-ink</code> on <code>--icebreaker-very-light</code> (6.42:1), break <code>--gray-600</code> on <code>--gray-100</code> and custom <code>--gray-700</code> on <code>--gray-200</code>, both neutral. Inside the Planner the <code>--planner-*</code> colours still win, so the canvas is unchanged.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>ws_agenda()</code> live state: a done block is "On time" within 60 seconds of its plan either way, where only an exact match counted before. Items may pass <code>actual_seconds</code> (which wins over <code>actual</code> in minutes) and <code>planned_seconds</code>. A done row is read once, as "Done, took 7 of 5 minutes, 2 over" ("1 under", "on time"), with its short visible form hidden from a screen reader, and with <code>live</code> the list's label gains ", live". Rows without the live keys still render byte for byte as before; four new cases in <code>AgendaComponentTest.php</code> and a visual baseline for the live state.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 25, 2026</div>
    <div class="changelog-version">v2.67.0: The header avatar from the Field Guide app</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>ws_header()</code> avatar: two initials (the first two words of the name, else of the email, the Field Guide's own rule, so "Bill Bulman" is BB) in Fraunces 700 at <code>--text-h4</code>, on a <code>--brand</code> to <code>--brand-ink</code> gradient, inside a 2px <code>--bg-surface</code> border, a 1px <code>--brand-ink</code> ring and a lift shadow. It moves off <code>--mainsite-light</code>. The header script's new <code>wshInitials()</code> draws the same initials as the PHP. The Field Guide's coral gradient (<code>#D97757</code> to <code>#B4483B</code>) stays off-system, so the web uses the brand pair.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> Signed out, <code>.wsh-header__signin</code> is the same circle in white holding <code>account_circle</code>, on a <code>--brand-line</code> border and named "Sign in or register", in place of the red Sign In/Register pill. It keeps its class, href, <code>data-wsh-auth</code> and <code>data-auth-open</code>, so the auth toggle, the sign-in modal and the header auth tests are unchanged.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>app/css/app-shell.css</code>: the sign-in circle takes the shell's 44px hit area beside the avatar, and a new <code>--shell-text-body</code> alias sets the initials at 16px there.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 25, 2026</div>
    <div class="changelog-version">v2.66.0: A run clock, proposals that name their source, and agendas that show a session as it runs</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_run_clock()</code>: the time left on the running block, read across a room. It counts down (<code>07:20</code>), turns warning ink in the last two minutes, then counts up past the plan in brand ink (<code>+5:10</code>, "over its 20 min"); sizes <code>md</code>, <code>lg</code> and <code>xl</code> on <code>--text-h1</code> and the two display steps, in Inter with tabular figures. <code>role="timer"</code>, so seconds are never read out; a polite region speaks on entering the last two minutes, on going over and once for each further minute over, never on page load. A paused clock drops <code>endsAt</code>, and the script leaves it alone. With <code>endsAt</code>, the new <code>/js/ws-run-clock.js</code> keeps it right from the timestamp, not a tick counter. Demo, playground fixture (running, ending, over, paused) and <code>tests/Unit/RunClockComponentTest.php</code>.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_agent_proposal()</code> takes <code>source</code>: <code>ai</code> (the default, unchanged) or <code>rules</code>, which drops the AI mark and sets <code>data-ws-proposal-source="rules"</code>, for a change the agenda rules worked out rather than a model. <code>WsAgent.proposal()</code> prints the same markup; two parity cases in <code>agent-components.spec.js</code>.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_agenda()</code> shows a session as it runs: items may carry <code>state</code> (done, now, next), <code>actual</code>, <code>planned_start</code> and <code>change</code> (trimmed, skipped, added), and <code>live</code> marks the running row with <code>aria-current="step"</code>. Done rows read "7 of 5 min" with a <code>ws_status</code> delta, the running row sits on <code>--brand-tint</code>, a moved start says "was 14:25", and every state is also said in words. Rows without the new keys render byte for byte as before; five new cases in <code>AgendaComponentTest.php</code>, and the Impact Report, briefing and Solt agenda tests pass unchanged.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 24, 2026</div>
    <div class="changelog-version">v2.65.2: Google first on the Field Guide sign-in sheet, with its G</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>SignInSheet</code>: Continue with Google sits above Continue with Apple, both still the same height and on screen without scrolling, which is all Apple's guidelines ask of Sign in with Apple beside another sign-in. The button shows Google's four-colour G from <code>Assets.xcassets/GoogleG</code>, an unmodified vector (SVG, vector data preserved) at 20pt; its colours are Google's brand mark, outside the token set like Apple's black button. <code>lint:ds:native</code>: 0 new findings.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 24, 2026</div>
    <div class="changelog-version">v2.65.1: The Field Guide's signed-in avatar ring is brand ink</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>AvatarButton</code> in <code>Components/Controls.swift</code>: signed in, the 1pt ring outside the avatar's white ring is <code>Palette.brandDark</code> (#C73E3E, the app's mirror of <code>--brand-ink</code>) on every screen, instead of the section's tone line. Signed out, the account icon keeps its tone hairline. <code>lint:ds:native</code>: 0 new findings.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 24, 2026</div>
    <div class="changelog-version">v2.65.0: The Field Guide's theme follows the web scales</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>Theme.swift</code> gains <code>Space</code> (the web spacing scale, 2 to 64 with its half steps) and <code>Radius</code> (4, 6, 8, 12, 16), and every padding, stack spacing and corner in the app reads them: no spacing or radius literal is left in a view. Buttons and inputs take 8, cards 12, sheets and panels 16, pills a capsule, as DESIGN.md sets. <code>Typo</code> trades literal sizes for six text roles (12, 13, 14, 15, 16, and 18 for the timer's step text, read at arm's length) and four display roles (18, 22, 28, 34) plus the timer's 36, each scaling with Dynamic Type through <code>relativeTo</code>; 20 distinct sizes become 11. Opacity outside the theme drops from 17 values to 3 (animation and state only), with named <code>Palette</code> and <code>Tone</code> colours for the rest, and the one hex in a view (<code>FavoritesView</code>) moves into the theme. Uppercase labels share one tracking value through <code>eyebrow</code>.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> One <code>PrimaryButton</code> in <code>Components/Controls.swift</code> replaces <code>SubmitButton</code>, Account settings' <code>primary</code> and <code>PrimaryButtonLabel</code>, and three exact copies: 52pt minimum, the tone gradient, a spinner while busy, its title as its accessibility label. Text-bearing controls use <code>minHeight</code>, and <code>minimumScaleFactor</code> is gone, so labels wrap rather than clip or shrink at large text sizes. The gradients, fonts, light-only appearance and the timer ring are unchanged, pending Bill's decisions. <code>lint:ds:native</code>: 0 new findings, 11 baselined, 27 fixed since the baseline.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> The Field Guide sign-in sheet adds Continue with Apple (Apple's own <code>SignInWithAppleButton</code>, black, as Apple requires) and Continue with Google (white on the <code>Palette.border</code> hairline, ink text, with Google's official G mark once a <code>GoogleG</code> image is added), both <code>@ScaledMetric</code> 52pt and <code>Radius.lg</code>, under a quiet "or" rule. Apple sits first and at least as prominent, which App Review requires when Google is offered.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 24, 2026</div>
    <div class="changelog-version">v2.64.0: Light tokens for exercises and icebreakers</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>--exercise-light</code> (#C2DBFF), <code>--exercise-very-light</code> (#DDEBFF), <code>--icebreaker-light</code> (#C7E3BD) and <code>--icebreaker-very-light</code> (#E0EFDB), in a new SEMANTIC: ACTIVITY TYPES block of <code>platform-tokens.css</code> and mirrored as <code>colors.activityTypes</code> in <code>workshopr-design-system.json</code>. Each step takes the OKLCH lightness and chroma of <code>--brand-line</code> and <code>--brand-soft</code> (#FECACA, #FEE2E2), at hues 120 degrees either side of the very light red's (blue 258, green 138: a triad), so beside those reds the three types read as one set at one weight. <code>--exercise-light</code> falls just outside sRGB at that point, so it is clipped and about 4% less saturated than its red. Chosen over hues matched to the app's existing blue and green, which left the green mint, and over a split-complementary pair, which turned the blue sky. The greens replace the Field Guide's emerald (#A7F3D0, #D1FAE5), 1.5 to 1.6 times as saturated as the reds. Text on the blues takes <code>--color-info-strong</code> (6.18:1, 7.23:1), on the greens <code>--color-success-ink</code> (5.54:1, 6.42:1). They are the activity-type exception to Red Unification, for marking an exercise or an icebreaker; the Field Guide's section theming is the one wider use, still pending Bill's confirmation of its <code>Tone</code> scope. The Planner's <code>--planner-exercise-*</code> and <code>--planner-icebreaker-*</code> are a separate set whose steps don't line up (its <code>-light</code> is nearer this <code>-very-light</code>) and stay as they are for now.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> The Field Guide's <code>Tone.exercise</code> and <code>Tone.icebreaker</code> <code>tint</code> and <code>pale</code> carry the new values, each with a trailing token comment, which <code>native.md</code> and the manifest's <code>annotation</code> now allow; the native check does not read them, so those copies are kept in sync by hand. <code>Tone.top</code>, the colour each section's background fades from, is the very light step of each (<code>--brand-soft</code>, <code>--exercise-very-light</code>, <code>--icebreaker-very-light</code>), and <code>ToneBackground</code> fades it into paper within a fixed 220pt instead of 56% of the screen. Workshops, Exercises and workshop detail, which were plain paper under a 6pt coloured band, take the same fade and lose the band: <code>SwatchBackground</code>, <code>TopSwatch</code> and <code>swatchScreen</code> are removed, and every section screen calls <code>sectionScreen</code>. <code>PinnedTopBar</code>, the detail pages' top row, drew a flat <code>Tone.top</code> block with a hard edge about 122pt down; it now draws the same slice of the fade the screen draws behind it (still at 0.86 over the material), so at rest the bar has no edge. The rest of those tones (accent, ink) and <code>Tone.workshop</code>'s tint and pale (#FDECEC, #F6C4C4) are unchanged, so in the app the workshop chips still read paler than the other two. Every text pairing on these fills in the app stays at or above 6.42:1. <code>field-guide/field-guide.css</code> points its exercise and icebreaker tints at the new tokens, and its icebreaker label (#047857 on #E0EFDB) holds 4.58:1. <code>tokens.dtcg.json</code> and <code>components.generated.json</code> are regenerated; <code>check-drift.php</code>, <code>lint:docs</code>, <code>lint:ds:native</code> (0 new findings) and both generator checks pass.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 23, 2026</div>
    <div class="changelog-version">v2.63.3: The Workshopr Companion is retired</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> The Expo Companion app is retired, so the system stops describing it: <code>app-companion.php</code> and <code>mobile-ios.md</code> are deleted, the nav link goes from <code>ds-header.php</code>, the four <code>--companion-*</code> tokens (used nowhere but their own docs) go from <code>platform-tokens.css</code>, and the <code>companion</code> entries go from both the per-app block and the <code>native</code> block of <code>workshopr-design-system.json</code>. <code>native.md</code>, <code>START-HERE.md</code>, <code>README.md</code>, <code>llms.txt</code> and <code>ADOPTION.md</code> lose their Companion rows. <code>tokens.dtcg.json</code> and <code>components.generated.json</code> are regenerated; <code>check-drift.php</code>, <code>lint:docs</code> and <code>lint:ds:native</code> pass. The enforcer's generic <code>external</code> app handling stays for any future out-of-repo app.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 23, 2026</div>
    <div class="changelog-version">v2.63.2: Checkbox card groups submit with a form, and can show checkboxes</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_checkbox_card_group</code> takes <code>control</code>: <code>toggle</code> (the default, unchanged) or <code>checkbox</code>, which puts a native checkbox at the start of each row (<code>.ws-checkbox-card__check</code>, 20px, <code>accent-color: var(--brand)</code>) and gives a ticked row the soft brand fill (<code>--brand-tint</code> with a <code>--brand-line</code> border, through <code>:has()</code>). Use it for picking items from a list; keep switches for options that apply together. Styles in <code>components.css</code>; on the host the block was appended to production's own copy, which still differs from the local file. Checked in a browser on the referral picker at 1440 and 375.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>ws_checkbox_card_group</code> takes an optional <code>name</code> (e.g. <code>books[]</code>), and each item an optional <code>value</code> that falls back to its <code>id</code>. With a name, every checkbox submits its value under it; without one the markup is unchanged and submits nothing, so existing callers are untouched. No CSS changed. The curated entry in <code>workshopr-design-system.json</code> lists the option and the catalog is regenerated. First used by the referral book picker in <code>referrals/_books.php</code>, which wraps each group in <code>ws_form_row_start</code> so the group has a name, since the component itself still renders no fieldset.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 22, 2026</div>
    <div class="changelog-version">v2.63.1: Status alerts and badges pass AA</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> The info, success and error variants of <code>ws_alert</code> and <code>ws_badge</code> (so <code>ws_status</code> too) set each family's <code>-dark</code> step on its <code>-light</code> tint, which failed WCAG AA: info 3.64:1, success 2.72:1, error 3.34:1. Text now takes the ink step the tokens already name for those tints, <code>--color-info-strong</code> (6.14:1), <code>--color-success-ink</code> (6.34:1) and <code>--color-error-ink</code> (5.57:1), and so do the alert's action links and the bordered alert's accent, which is <code>currentColor</code>. The fills are unchanged. Warning was already 6.09:1 and is untouched. The fallback hexes in these rules now match the tokens they stand in for. Measured in a browser on the homepage test dashboard preview.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> The <code>gold</code> badge, the Pro marker, set <code>--color-warning-darker</code> on <code>--color-warning-light</code> at 4.03:1. It keeps the bright gold fill and takes <code>--color-warning-surface-ink</code> for text (5.87:1), a copper that stays orange where the warning badge's ink is brown on a pale cream fill, so it still reads as metal rather than as a warning. Checked beside the warning and success badges at all three sizes, with and without its icon.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 21, 2026</div>
    <div class="changelog-version">v2.63.0: Range slider (ws_range)</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_range($name, $options)</code> renders a native <code>&lt;input type="range"&gt;</code> with a real <code>&lt;label for&gt;</code> (visually hidden with <code>hideLabel</code>, never removed), an optional description wired as <code>aria-describedby</code>, and <code>valueText</code> as <code>aria-valuetext</code>. Template <code>includes/components/range.php</code>, styles <code>.ws-range</code> in <code>components.css</code>, demo at <a href="components/demos/range.php">Range</a>, a playground fixture, and an entry in <code>workshopr-design-system.json</code>; the catalog is regenerated.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> Two variants. <code>default</code> is the browser's slider tinted with <code>--brand</code> through <code>accent-color</code>, in a 44px tall box, and needs no script. <code>bare</code> makes track and thumb transparent for a handle the page draws (a divider between panes): the thumb keeps its size (<code>--ws-range-thumb</code>, 44px) and carries the focus ring and halo, and the input is exactly one thumb tall, because WebKit pins a styled thumb to the top of a taller track and the ring then sat above the drawn grip.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> The hinge on <code>/index4.php</code> uses the bare variant instead of building its label and input in script, so the control is in the markup and check-page measures it honestly (project total unchanged at 3466). It stays hidden until the page's script wires it, so a page without script shows the default split and no dead control. Checked in a browser at 1440: the thumb's centre and the drawn grip coincide at every step, the arrow keys move it two points at a time and <code>aria-valuetext</code> follows; at 390 the control is out of the layout and the tab order.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 21, 2026</div>
    <div class="changelog-version">v2.62.3: Dialog focus trap skips hidden controls</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>wsTrapFocus</code> in <code>includes/components/components.js</code> collected its focusable list once, when the dialog opened, including controls hidden at the time (the sign-in dialog's name row). When one of those ended the list, Tab from the last visible control left the dialog. The trap now measures the controls that can take focus at each Tab. Every <code>ws_modal</code> gets the fix; checked in a browser on <code>index.php</code> and <code>index1.php</code>, 20 Tabs and 20 Shift+Tabs at 1440 and 390 without leaving the dialog.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 20, 2026</div>
    <div class="changelog-version">v2.62.2: Dark waitlist forms on ws_input and ws_button</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> The early-access forms on <code>/field-guide/</code> and <code>/pocket/</code> render their fields with <code>ws_input</code> and their submit with <code>ws_button</code>, which clears check-page's <code>raw-component</code> findings on both. The dark panels keep their look by setting <code>--input-border-hover</code>, the property <code>.ws-input</code> reads on hover, and by giving the component's focus ring way to the existing red outline. The scripts write the button's state into <code>.ws-btn__text</code>, so the span survives.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> The Field Guide form's error red is one property, <code>--fg-error</code>, behind a single justified <code>ds-lint-disable</code> instead of two. A focused field on either form no longer shows the faint legacy blue glow from <code>css/styles.css</code> in the 1px gap between the field and its red outline; nothing else on either form changed, pixel for pixel.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 20, 2026</div>
    <div class="changelog-version">v2.62.1: check-drift's card rule passes</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>.profiles-grid--featured .profile-card</code> in <code>css/dna/styles.css</code> is padded with <code>--card-padding</code> (20px) instead of <code>--space-6</code> (24px), so the featured DNA cards are back in the card family.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> The dark download block on <code>/pocket/live.php</code> is <code>.bp-get__panel</code>, not <code>.bp-get__card</code>: a full-width section band, like <code>.fg-cta__panel</code>, whose 28px corners and 56px inset are deliberate. Nothing on the page moves. <code>php design-system/check-drift.php</code> exits 0 again.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 20, 2026</div>
    <div class="changelog-version">v2.62.0: Academy landing on tokens</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>css/academy/home.css</code>: the status pills on the shelf, the paths and the hero carousel share one rule on <code>--color-success-very-light</code> / <code>--color-success-ink</code> and <code>--bg-surface</code>, small red text uses <code>--brand-ink</code>, and the secondary button's hover is <code>--brand-tint</code> and <code>--brand-ink</code> instead of hex literals.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>--ink-whisper</code> points at <code>--color-ink-faint-accessible</code> in the stylesheet's existing token block, rather than in a second <code>:root</code> block, so essential small text clears AA.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>ws_section_hero('academy')</code> has the start-here subtitle, the 72-hour plan and Foundations path buttons, four stats and one status vocabulary in its carousel.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 20, 2026</div>
    <div class="changelog-version">v2.61.0: Field Guide landing page</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>field-guide/field-guide.css</code> styles <code>/field-guide/</code> and <code>/field-guide/live.php</code> on platform tokens. The app's three kind colours stay scoped to the rows about that kind: workshops are <code>--brand-ink</code> on <code>--brand-tint</code>, the exercise tint is <code>--color-info-very-light</code>, and the exercise blue and icebreaker greens are a justified <code>ds-lint-disable</code> under the activity-type exception, since no web token carries them.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> The dark join and download block is <code>.fg-cta__panel</code>: a full-width section band with 28px corners and a 56px inset, kept outside the card family on purpose rather than drawn at <code>--card-radius</code>. The early-access form's error red stays <code>#FCA5A5</code> with a justified disable, because no token carries an error colour for a dark surface.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_header('field-guide')</code> is the header section for the Field Guide pages.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 19, 2026</div>
    <div class="changelog-version">v2.60.0: Native apps in the design system</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>design-system/native.md</code> is the design system for the three SwiftUI apps (Back Pocket, Field Guide, Workshopr Planner for Mac): where each lives, the token contract (values only in the theme files, mirroring <code>platform-tokens.css</code>), the platform rules, how to build, run and screenshot each app, the Swift rules, the hazards, and the drift the 19 October survey found, written as decisions for Bill.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>workshopr-design-system.json</code> 3.2.0 carries a <code>native</code> block, the manifest that binds each app to its paths, project, scheme, theme files and sanctioned scopes. The enforcer MCP and <code>npm run lint:ds:native</code> read it.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> The design-system-enforcer MCP (1.1.0) reads Swift: <code>validate_file</code> and <code>check_snippet</code> run eight native rules (token drift, unknown tokens, off-system values, colour literals in views, pure black, off-brand and system fonts, fixed-size fonts), <code>list_tokens</code> takes <code>platform: "swift"</code> and an <code>app</code>, and the new <code>native_apps</code> tool prints each app's binding and live findings. In PHP it now reports raw controls as <code>raw-control</code>, the rule <code>check-page.php</code> already applies.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>npm run lint:ds:native</code> checks every app against <code>native-baseline.json</code> and fails on any new finding; <code>npm run check:ds</code> runs it on the Swift files it is given.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> The design agent plugin (1.4.1) charges Swift edits to the enforcer, asks <code>native_apps</code> and <code>list_tokens</code> before writing Swift, and has its critic run <code>npm run lint:ds:native</code> and check Dynamic Type, dark appearance, VoiceOver labels and 44pt targets in the simulator.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>START-HERE.md</code> gains a native workflow, a section on the design agent and the full list of enforcer tools, and step 5 says what the enforcer now sees in PHP. <code>llms.txt</code>, DESIGN.md (new §12.11), CLAUDE.md §11 and AGENTS.md point native work at <code>native.md</code>.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>mobile-ios.md</code> and <code>app-companion.php</code> match the Companion's code again: the page is <code>#F0EBE3</code>, navigation is three tabs on a custom bottom bar, the Run Mode stage card is red, the timer is 72pt, and the palette and component inventory are current.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 17, 2026</div>
    <div class="changelog-version">v2.59.0: Library review page</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>css/admin/library-review.css</code> styles the before and after diff on <code>/admin/content/library-review.php</code>: removed and added words on the error and success soft tokens, with visually hidden "Removed:" and "Added:" labels for screen readers. Tokens only; everything else on the page is <code>ws_*</code> components.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>.lr-value</code> shares the diff box rule, so each field of a new draft on the page's New items tab (<code>?view=new</code>) sits in the same box as a before and after. The tab itself is <code>ws_tabs</code> with <code>ws_tab_panel</code>.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 14, 2026</div>
    <div class="changelog-version">v2.58.0: Section sketches on the library lists</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>.listing-page-header-inner.has-sketch</code> and <code>.listing-page-sketch</code> in <code>css/listing-redesign.css</code> put an ink sketch beside a listing page's title and subtitle (220px tall, 104px at 768px and below), with the title block centred on it and the subtitle wrapping at 56ch. The workshops, exercises and icebreakers lists use hand-drawn versions of their Material icons (<code>co_present</code>, <code>extension</code>, <code>ac_unit</code>) from <code>images/library/</code>.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 14, 2026</div>
    <div class="changelog-version">v2.57.0: The burn-down agent</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> The <code>design-system</code> agent (<code>.claude/agents/design-system.md</code>) works one goal: <code>php design-system/check-page.php --count</code> down to 0, net of approved exceptions in <code>page-exceptions.json</code>. Invisible fixes (exact safe-token swaps, filemtime cache busts) run unattended every 4 hours from <code>.github/workflows/ds-burndown.yml</code>; visible fixes go to review batches with before/after screenshots in a local loop. <code>design-system/burndown/RUNBOOK.md</code> has both runs.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>check-page.php --count [--json [--detail]]</code> measures without writing; <code>--baseline-lower [pages]</code> only ever lowers counts. <code>scripts/ds-burndown-verify-invisible.mjs</code> proves a change is invisible; <code>ds-burndown-queue.mjs</code>, <code>ds-burndown-finish.mjs</code> and <code>ds-burndown-shots.mjs</code> pick, gate and screenshot a batch; <code>.claude/hooks/ds-agent-guard.mjs</code> holds the agent's walls.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>check-page.php</code> skips <code>admin/_archive/</code> (retired, never served) and <code>includes/components/</code> (raw controls inside a <code>ws_*</code> template are the component). Live count on 14 Oct: 3,902 in 259 pages.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 14, 2026</div>
    <div class="changelog-version">v2.56.1: taste.md is current again</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>taste.md</code> is back as a live file with a narrower job: the judgment no check can enforce (reference anchors, what reads as "AI", the cut test, the kill list, ethics lines), in Bill's words from his design taste interview. Every rule a check could enforce stays in <code>DESIGN.md</code>, and <code>taste.md</code> links to it rather than repeating it. <code>DESIGN.md</code> (intro, §17 file index), <code>CLAUDE.md</code> and <code>START-HERE.md</code> no longer call it deprecated, and <code>npm run lint:docs</code> now checks it with the other guides.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 12, 2026</div>
    <div class="changelog-version">v2.56.0: Listing Card sketch</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> Listing Card takes an optional <code>illustration</code> (a web path, from <code>prepareCardData()</code>'s <code>illustration_path</code>) and renders it as the <code>.listing-card-illustration</code> band the tips cards already used. <code>includes/partials/listing-card.php</code> and the portable <code>design-system/components/php/ListingCard.php</code> both carry it; the demo shows it on a fourth card.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>css/detail-immersive.css</code>: <code>.immersive-hero-inner.has-illustration</code> puts an exercise's sketch (<code>.immersive-hero-illustration</code>) in a second column beside the title, and above the category chip at 768px and below. The hero is unchanged without one.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 10, 2026</div>
    <div class="changelog-version">v2.55.3: Email tokens</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>includes/email-templates/_tokens.php</code>: the design tokens an email needs (brand, ink, surfaces, rules, radii, shadow, font stacks) as literal values, since email clients ignore CSS variables. <code>tests/Unit/EmailTokensTest.php</code> resolves each against <code>platform-tokens.css</code> and fails on drift. The tip digest (<code>includes/email-templates/tips/tip-digest.php</code>) and the DNA daily tip (<code>emails/templates/dna-daily-tip.php</code>) read every colour, radius and font from it; they used Tailwind slate grays, a navy heading and <code>#dc3545</code>. <code>dailyReadingBodyToHtml()</code> paragraphs are <code>--color-ink-secondary</code>.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 10, 2026</div>
    <div class="changelog-version">v2.55.2: Planner modals on ws_modal</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>planner/includes/modal-planner.php</code> now renders <code>ws_modal_start</code> with <code>'variant' =&gt; 'branded'</code>, so all eighteen planner dialogs are <code>.ws-modal</code>s: the id is on the dialog, the overlay is <code>{id}-overlay</code>, and <code>PlannerModals.open/close</code>, <code>planner-home.js</code> and <code>PlannerGenerator</code> go through <code>wsModalOpen</code>/<code>wsModalClose</code> (focus in, trap, inert page, focus return). Planner sizes map onto the system's: 2xl to xl, 3xl to full capped by <code>.planner-modal--wide</code>. The footer include opens <code>.ws-modal__footer</code>; <code>single_btn</code> is <code>.planner-modal__footer--single</code>. <code>close_id</code> is accepted but renders nothing: the close button is the template's.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>.planner-modal</code> field spacing in <code>css/planner/components/_modals.css</code> (stacked <code>.ws-field</code> and side-by-side <code>.ws-form-row</code>), replacing what the <code>.modal-overlay</code> bridge rules supplied. The per-modal <code>.red-header-modal</code> overrides for Load Workshop, Templates, Energy Score, Clean Up and the generator now target <code>.ws-modal</code> / <code>.ws-modal__body</code> / <code>.ws-modal__footer</code>, or were dropped where the shell already does the job. The planner-only gradient on modal primary buttons is gone; they are the standard <code>ws-btn--primary</code>.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>ws_input</code> with <code>type =&gt; select</code> renders <code>.ws-select-wrapper</code>, but <code>components.css</code> only positioned <code>.ws-select-wrap</code>, so the absolute <code>.ws-select__arrow</code> left the field wherever no bridge rule caught it. Both names are positioned now, and <code>select.ws-input</code>'s background chevron is dropped inside the wrapper so the field shows one arrow.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>modal.php</code> falls back to the Material Symbols font for a header icon <code>icon()</code> cannot find in <code>images/icons/</code> (as <code>ws_button</code> does); the pill was blank for names like <code>delete_forever</code>.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 7, 2026</div>
    <div class="changelog-version">v2.55.1: Planner times past the end of the day</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>.item-time.is-past-day-end</code> in <code>css/planner/components/_cards.css</code>: an agenda item's start time in <code>--color-error-ink</code> when the item runs past the end of its day. Not <code>--color-error-dark</code>, the energy arc's overtime red: the time is small text on the type-tinted cards, and error-dark falls to 4.44:1 on the exercise tint and 4.09:1 on the custom tint; error-ink clears 6.8:1 on all five. <code>planner-v2.js</code> adds a <code>.sr-only</code> "runs past the end of the day" and a title, rather than an <code>aria-label</code> on the plain div. The <code>_cards.css</code> import in <code>planner-new.css</code> moves to <code>?v=20261007b</code>.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 6, 2026</div>
    <div class="changelog-version">v2.55.0: The component gaps builders kept hitting</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_agent_status</code> takes <code>'size' =&gt; 'sm'</code> in thinking mode: an inline line with no fill, border or padding at <code>ws-btn--sm</code>'s text size, for use beside a button or field. It keeps <code>role="status"</code> and the reduced-motion stop on the dots. CSS: <code>.ws-agent-status--sm</code> in the AGENT COMPONENTS block of <code>components.css</code>. <code>WsAgent.status()</code> prints the same class, and the demo, a playground state and the parity spec cover it.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>WsAgent.consentRow(options)</code> in <code>js/ws-agent.js</code> prints the same markup as <code>ws_consent_row()</code>, held together by five new parity cases. Synthesize's push-consent step uses it, and its <code>&lt;template&gt;</code> is gone, so <code>app/views/synthesize/make.php</code>, <code>synthesize/synthesize.js</code> and <code>js/ws-agent.js</code> ship together.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>--color-ink-muted</code> moves from #78716C to #706965, the lightest value of the same warm stone that clears 4.5:1 on <code>--bg-paper-dark</code>. <code>--text-muted</code> was 4.28:1 on <code>--card-bg</code> and 4.04:1 on the header band; it is now 4.80:1 and 4.54:1, and 5.39:1 on white. <code>--color-ink-faint-accessible</code>, a second copy of the old hex, now points at it. <code>css/academy/training.css</code> still overrides <code>--text-muted</code> with the faint ink (2.52:1) on learning-paths pages; left for a decision.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> The legacy ratchet in <code>check-page.php</code> counts a legacy name only where it is used as a class (class attributes, <code>'class' =&gt;</code> options, classList and selector strings, style rules), not in prose, ids, file paths or comments. 20 such hits left the count (1595 to 1575) and <code>legacy-baseline.json</code> was lowered to match. <code>tests/Unit/CheckPageLegacyTest.php</code> holds both sides.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> The 31 entries of the 4 Oct build run's friction log are all answered: ten were already fixed, twenty now have a written rule (DESIGN.md 7 Headings, 10.2, 11.6 and 13; START-HERE step 5 on what <code>check_snippet</code> and the page check each cover; docblocks for <code>ws_workshop_list</code>, <code>ws_card</code>, <code>ws_listing_card</code> and the layout helpers; the filter-bar, empty-state, card, tabs, input, button and layout demos), and one is deliberate (two playground fixtures keep a bare <code>h3</code> rather than move baselines). Demos say "Show all workshops" where they said "Clear filters".</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>synonyms.json</code> gained everyday words for twelve components, from the 13 held-out eval requests both finders missed. Those 39 held-out cases are now tuning cases (<code>tunedOn</code>), and a fresh blind batch of 30 is the held-out set: top-1 19, top-3 22, scored before the tuning and not tuned against. Overall 131 of 143 top-1 and 135 top-3 (MCP 136); the ratchet is raised to match.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 5, 2026</div>
    <div class="changelog-version">v2.54.1: The app page grid, where agents look</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag improved">Improved</span> The <code>/app/</code> page grid (<code>.app-page</code>: eight columns of <code>--app-grid-col</code> with <code>--app-grid-gutter</code>, a six-column main beside the two-column rail) was documented only on <a href="app-shell-layouts.php">App Shell Layouts</a> and in the curated JSON, which no agent entry point reached. DESIGN.md 7 now states its rules (the columns, the spans, which nested grids stay on it, the 1100px step), START-HERE opens with it for <code>/app/</code> work, and <code>llms.txt</code> names it. <code>ws_grid_start</code>, <code>ws_container_start</code> and the app bar, dock and footer demos, which <code>ds:find</code> returns for layout requests, now point to it, and <code>--app-grid-col</code>, <code>--app-rail</code> and <code>--app-content-wide</code> gained search phrases and purposes.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 5, 2026</div>
    <div class="changelog-version">v2.54.0: Steering for every agent, and demo pages held to their CSS</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> The design-system-enforcer MCP (<code>.claude/mcp-servers/design-system-enforcer/</code>) is tracked in git, without its <code>node_modules</code>; it was gitignored while <code>.mcp.json</code>, <code>ds:eval</code>, <code>ds:build-eval</code> and <code>test:ds</code> all depended on it, and <code>.mcp.json</code> now starts it from <code>${CLAUDE_PROJECT_DIR}</code> instead of one machine's path. AGENTS.md and GEMINI.md, which other agents read, now carry the design-system rule (a <code>ws_*</code> component before HTML, a token before a hex or pixel value) and the two commands that apply it, <code>npm run ds:find</code> and <code>npm run check:ds</code>. Both had said "There is no CI"; <code>lint:docs</code> now fails that claim while <code>.github/workflows/ci.yml</code> exists.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>check-drift.php</code> check 6 holds each demo page to its component's CSS. A Tokens table may list only custom properties that the component's rules in <code>components.css</code> (matched by its class block) or its template's own <code>&lt;style&gt;</code> read or set, and a retired alias (<code>--phase-*</code>, <code>--mainsite-*</code>, <code>--coach-*</code>) may appear elsewhere in a demo only where that CSS still uses it or the line says it is retired. It found 82 false claims in 25 demos, mostly <code>--mainsite-primary</code> and <code>--phase-learn</code> a month after <code>components.css</code> moved to the <code>--brand*</code> tokens, plus <code>--transition-fast</code> where the CSS reads <code>--transition-interactive</code>; all are corrected. The button demo's four identical phase-themed buttons are one secondary button, and the stat and modal examples pass <code>--brand-ink</code> and <code>--brand</code>. hero, listing-card and tooltip are styled elsewhere and reported as unchecked. The pre-commit hook now runs the drift check when a demo or <code>components.css</code> is staged.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 5, 2026</div>
    <div class="changelog-version">v2.53.4: The solutions pages on ws_agenda</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> The five <code>solutions/bytype/</code> pages draw their sample agenda with <code>ws_agenda</code>. <code>renderSoltAgenda()</code> (<code>includes/data.php</code>) maps a library workshop through <code>soltAgendaItems()</code>: each item keeps its own start time, breaks stay breaks except the welcome and wrap-up blocks (activities), and an item named or phased as an icebreaker is one. Each page's hard-coded fallback agenda is a <code>ws_agenda</code> call with the same copy, its times computed from a start and the durations (checked row for row against the old ones). The fourteen <code>.solt-agenda__item</code>, dot, name, description, duration and day-label rules are gone from <code>css/solutions-type.css</code>; the list frame takes the side padding. The per-type dot colours (two of them retired phase colours) are gone with them. Also fixed: the title bar's workshop name inherits the bar's white, because <code>css/styles.css</code> colours every heading <code>--text-dark</code>.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 5, 2026</div>
    <div class="changelog-version">v2.53.3: The Impact Report on ws_agenda</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> The Impact Report's "What happened" agenda, in the app (<code>app/views/prove/report.php</code>) and on the share link (<code>prove/r/index.php</code>), is <code>ws_agenda</code> through <code>irAgendaItems()</code> in <code>includes/impact-report.php</code>, instead of two copies of a bare <code>&lt;ol&gt;</code>. It now writes each item's type and groups a multi-day workshop by day; a stored snapshot without <code>item_type</code> or <code>day_number</code> renders as one plain list. <code>.prv-agenda__mins</code> is gone. The library's workshop page is not moved: its agenda links each exercise to the library, and <code>ws_agenda</code> has no per-item link yet.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 5, 2026</div>
    <div class="changelog-version">v2.53.2: The first page on ws_agenda</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> The shared briefing (<code>planner/briefing-view.php</code>) draws its interim agenda with <code>ws_agenda</code> instead of the editor's input classes, which the read-only view had been hiding with overrides; <code>briefingAgendaItems()</code> in <code>planner/includes/briefing-data.php</code> maps its blocks. Blocks carry no start time or type, so the agenda shows neither, and the total is written as the rows are ("3 hr 5 min"). The page now loads <code>components.css</code>, so the AGENDA block must be on the host first. Five hand-rolled agendas remain.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 5, 2026</div>
    <div class="changelog-version">v2.53.1: Review fixes for tabs that remember, text steps and optional fields</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>ws_tab_panel_end</code> puts the tab's hidden field last in each GET form, just before <code>&lt;/form&gt;</code>, and leaves it out when the form already submits a field of that name, so the browser never sends <code>tab</code> twice. Inside a panel, <code>ws_filter_bar</code> carries that panel's tab in its form and its "Clear all" link, with or without <code>keep</code>, rather than the tab the page loaded on, which is stale once someone switches tabs. The tags are read whole and in order, as a browser reads them. So <code>&lt;form</code> inside a script, a comment, a textarea, an attribute value, <code>&lt;form-row&gt;</code> or <code>&lt;style-guide&gt;</code> is never taken for a form, and a form nested in another is ignored. Disabled, unchecked and <code>form=</code>-owned fields don't count as sending the tab. A form whose <code>action</code> loads another page is skipped: another path, another host or port, or a host with no path. <code>./view.php</code>, <code>../dir/view.php</code> and a bare <code>action</code> count as this page, and so does any <code>method</code> other than <code>post</code> or <code>dialog</code>. The patterns are possessive, so a script of a megabyte or more no longer exhausts PCRE and silently skips the panel. Controls inside scripts, comments and templates no longer stop an otherwise empty panel from being a Tab stop.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>ws_tabs</code> with numeric item ids opens the tab the URL names; the ids were compared to the query string without casting.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>ws_text</code> treats an unknown <code>variant</code> as a caption rather than writing it into the class, and accepts <code>variant</code> and <code>tag</code> in any case.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>ws_filter_bar</code>'s "Clear all" link builds its query with <code>&amp;</code> explicitly, so a host whose <code>arg_separator.output</code> is <code>&amp;amp;</code> cannot double-escape it. Its guidance says two bars on one page need different <code>searchLabel</code>s, since each names its search landmark.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>ws_chip_input</code> takes <code>optional</code>, like <code>ws_input</code>, and so do its PHP and React mirrors. The rest of the optional fields now use the option instead of "(optional)" typed into the label (prep link URL, deck client logo, Strategist save description, the two cancel questions), the planner's custom activity no longer says "Optional" twice, and Contribute marks Materials, Category and Instructions, which the server never required. The unused <code>.ws-field__required</code> and <code>.ws-form-row__required</code> rules are gone, and the React <code>WsFormRow</code>'s <code>required</code> prop is marked as ignored.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> DESIGN.md 11.6 and <code>ws_filter_bar</code> no longer disagree. The ban on Reset and Clear buttons now covers forms someone fills in, where one click wipes what they typed, and names the filter bar's "Clear all" link as the exception: it loads the unfiltered list, and Back restores the filters. A builder in the fourth friction run hit the conflict.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 5, 2026</div>
    <div class="changelog-version">v2.53.0: Text steps, tabs that remember, and empty states that show their icon</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_text($text, ['variant' =&gt; 'title'|'caption'])</code>: the two text steps builders kept writing by hand. <code>title</code> is the card-title step (Fraunces, <code>--text-h4</code>, semibold, an <code>h3</code> unless <code>tag</code> says otherwise); <code>caption</code> is <code>--text-small</code> in <code>--text-default</code>, which passes contrast on a card where <code>--text-muted</code> does not. <code>live</code> makes it a status for counts a script changes. The filtered-list recipe's card titles use it. Demo: <a href="components/demos/text.php">Text</a>.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_tabs(..., ['param' =&gt; 'tab'])</code>: the URL says which tab is open. <code>?tab=notes</code> opens Notes over the items' <code>active</code> flags (an unknown or disabled tab is ignored), <code>ws_tab_panel_end</code> adds the tab as a hidden field to each GET form in its panel, and <code>components.js</code> keeps the URL in step as tabs change, so saving a note comes back to Notes.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> Optional fields are marked in words, not required ones with an asterisk (DESIGN.md 11.3). <code>ws_input</code>, <code>ws_select</code> and <code>ws_form_row</code> take <code>optional</code>, which appends "(optional)" to the label, and <code>required</code> now sets only the browser's check, with no red asterisk; the PHP and React mirrors match. On the pages that mix required and optional fields, the 30 genuinely optional ones are marked (Contribute, Connect, prework, planner edit, the planner modals, prep). A field was left unmarked when a script or the server rejects it empty, when it is a select that always sends a value, or when it is pre-filled and a blank falls back to a default.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>ws_empty_state</code> draws its icon from the Material Symbols font when there is no local SVG, as <code>ws_button</code> does. The default, <code>inbox</code>, has none, so the icon circle rendered empty, as did <code>filter_alt_off</code> and <code>bookmark_border</code>.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 4, 2026</div>
    <div class="changelog-version">v2.52.0: Tab panels that follow their tabs, and one search box above a list</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_tab_panel_start('{tab id}')</code> / <code>ws_tab_panel_end()</code> write the panel a <code>ws_tabs</code> tab controls: <code>id="{id}-panel"</code>, <code>role="tabpanel"</code>, named by its tab (or <code>label</code>), spaced <code>--space-4</code> from the row, and open exactly when its tab is the active item, so a page that posts back to a tab opens on it. A panel with nothing focusable is a Tab stop; one holding a control is not. In every friction run, every builder hand-wrote these divs and set nothing from the server. The tabs demo uses the helper.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>ws_filter_bar</code> is the search box above a list, with or without filters. Search-only, its button reads "Search" (with filters, "Filter"; <code>submitLabel</code> sets it), the form is a <code>role="search"</code> landmark named like the field, and <code>showSearchLabel</code> puts the field's name above it as a real <code>&lt;label&gt;</code>. Its guidance no longer sends search-only to <code>ws_input</code>, which keeps search inside other forms and in headers. <code>keep</code> carries named query parameters through the search and "Clear all" as hidden fields, so inside <code>/app/</code> (<code>['view', 'step']</code>) a search no longer sends the person back to Home. The filtered-list recipe's way out reads "Show all workshops".</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 4, 2026</div>
    <div class="changelog-version">v2.51.0: An agenda to read, a switch you can click by its words, and one rule for confirming a save</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_agenda($items, $options)</code>: a read-only running order, each row a start time, the title with its type written out, and the duration. Times run on from <code>start</code> through each numeric duration; an item's own <code>start</code> resets them and a duration written as text stops them rather than inventing one. Items with a <code>day</code> are grouped under Day labels. Breaks are muted, never coloured, so the activity-type colours stay on the Planner's canvas. Six apps hand-roll this today (<code>.solt-agenda</code>, <code>.briefing-agenda</code>, <code>.prv-agenda</code> and others); builders in the friction run reached for <code>ws_planner_card</code> and fought its Swap button. Demo: <a href="components/demos/agenda.php">Agenda</a>.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_form_row_start</code> / <code>ws_form_row_end</code>: a form row around content that helpers print rather than return, such as a stack of switches, with the same label binding as <code>ws_form_row</code> and no output buffering in the caller.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_cluster_start(['grow' =&gt; 'first'])</code> (or <code>last</code>): that item takes the row's free width and keeps <code>--grid-min-sm</code> before the row wraps, as a search field beside its button should.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>ws_toggle</code>: the whole row is now one <code>&lt;label&gt;</code>, so a click on the text or the description flips the switch (only the slider did), and the input carries <code>role="switch"</code>, so screen readers say "switch, on". <code>ws_consent_row</code>, whose control only enables its Send button, passes <code>role</code> <code>checkbox</code> and stays one.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>.ws-input</code> is <code>box-sizing: border-box</code>, so <code>width: 100%</code> plus padding no longer overflows its column on a page without a reset.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> One rule for confirming a save (DESIGN.md 10.2, and the Alert and Toast demos): <code>wsToast</code> when the person stays on the page; a success <code>ws_alert</code> when the save reloaded it, because a toast fired during page load is easily missed; and a failed save never a toast alone. <code>wsToast</code> is the toast to call; <code>window.Toast</code> (<code>js/toast.js</code>) and the Planner's <code>showToast()</code> are legacy, and the build eval no longer loads <code>js/toast.js</code>.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> The playground runs a fixture's calls in one output buffer, as a page would, so a pair whose start buffers its own content previews in order.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Eleven catalog entries (<code>ws_modal</code>, <code>ws_tabs</code>, <code>ws_toggle</code>, <code>ws_tooltip</code>, <code>ws_accordion</code> and others) now carry their demo's whole accessibility table: the generator took only the first block under the heading, so a demo that opens with a sentence lost its rows. A builder found <code>ws_toggle</code>'s role rule missing this way.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 4, 2026</div>
    <div class="changelog-version">v2.50.0: Layout helpers, and a form row whose label names its field</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> Four layout helpers own the space between components: <code>ws_stack_start</code> (one above the other, with a <code>gap</code> step, as a <code>div</code>, <code>section</code>, list or <code>form</code>), <code>ws_cluster_start</code> (a wrapping row with <code>justify</code> and <code>align</code>), <code>ws_grid_start</code> (as many equal columns as fit above a column floor, no breakpoints) and <code>ws_container_start</code> (a centred <code>--container-*</code> column with gutters), each closed by its <code>_end</code>. They nest (closing one out of order raises a warning), lists get <code>role="list"</code>, the stack spaces with <code>gap</code> so a hidden input adds no space and no child's margin leaks in, a button in a stack keeps its own width, and cards in a list grid's row end level. Styles sit last in <code>components.css</code> between <code>LAYOUT: START</code> and <code>LAYOUT: END</code>; the demo is <a href="components/demos/layout.php">Layout</a>. In the first friction run every builder hand-wrote these.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>--grid-min-sm</code>, <code>--grid-min-md</code> and <code>--grid-min-lg</code> (200, 280 and 360px): the narrowest a <code>ws_grid</code> column gets before the grid drops one.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>ws_form_row</code>'s label now names what it wraps. With one control inside it gets <code>for</code> that control (adding an id if it has none), the helper or error joins the control's <code>aria-describedby</code>, an error sets <code>aria-invalid</code> and is announced, and <code>required</code> sets <code>aria-required</code> behind an <code>aria-hidden</code> asterisk. With several controls, or one that already has its own label, the row is a labelled <code>role="group"</code>, so no control carries two names. Controls in a <code>&lt;template&gt;</code> or a script are not counted, and attribute values are parsed, not pattern-matched. Before, a field labelled only by the row had no accessible name. Same in the portable <code>components/php/FormRow.php</code>; <code>components/react/FormRow.tsx</code> takes an <code>htmlFor</code>.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> The three screen recipes and the component pairs on <code>composition.php</code> lay out with the new helpers, so copying one copies no CSS; <code>.ds-recipe-stack</code>, <code>-grid</code>, <code>-row</code>, <code>-actions</code> and <code>-narrow</code> are gone from <code>recipes.css</code>. The workshop list's loading placeholders share its <code>ws_grid</code>, so they keep the cards' columns. The settings form's actions now lead with Save, aligned left with the fields (DESIGN.md 11.6).</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> DESIGN.md 11.7's form example gives each field its own label and hint and lays the form out with a stack and a cluster; it taught the unbound row label, a red asterisk that 11.3 forbids, and a <code>placeholder</code> the row ignored. 7 names the layout helpers.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 4, 2026</div>
    <div class="changelog-version">v2.49.0: Agents say where they had to guess</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> The build eval asks each builder agent for a friction log: every point where the system left it to guess, find nothing, or choose between sources that disagree. A run merges the logs into a <code>friction.json</code> beside the builds, ranked by the helpers and tokens they name, so the next fix is the one agents trip on most. It is never scored.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> Every semantic token in <code>platform-tokens.css</code> now states its purpose (69 had none), with contrast where it decides use: <code>--text-muted</code> for meta lines, <code>--text-faint</code> decorative only, status colours for icons and fills with their <code>-ink</code> partner for text. Component tokens the <code>ws_*</code> components do not read say so, and name what does.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> A component's <code>a11y</code> in <code>components.generated.json</code> is now one <code>Concern: behavior</code> line per rule; 50 entries read as run-together text before.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> The design-system-enforcer MCP reloads the catalog, synonyms and tokens when any of them changes, instead of answering from the catalog the session started with.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>llms.txt</code> gives the same source-of-truth order as START-HERE.md, leads with <code>components.generated.json</code>, and is now held to its claims by <code>npm run lint:docs</code>.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>tokens.dtcg.json</code> exported 20 tokens at their <code>@media</code> override instead of their value: every duration and transition as <code>0s !important</code> (reduced motion), the focus ring as <code>Highlight</code> (forced colours), <code>--text-muted</code> at its high-contrast step. The generator now keeps the base definition, as the catalog does, and reads values that span lines; all 356 match the catalog.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> A token whose value spans several lines (<code>--paper-grid-image</code>) kept no purpose in the catalog: the generator looked for its comment above the last line, not the first.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>ds:find</code> and the MCP's <code>suggest_component</code> list every option a helper takes, with its type. Options with no default were dropped, which hid <code>ws_agent_proposal</code>'s <code>title</code>, <code>why</code>, <code>adjust</code> and <code>returnFocus</code>; three of five builders in the first friction run had to dig them out of the JSON.</li>
        <li><span class="changelog-tag changelog-tag--deprecated">Removed</span> <code>figma-tokens.json</code>, untouched since May and read by nothing, still listed the retired blue, purple and emerald phase colours as current. <code>tokens.dtcg.json</code> is the Figma and Tokens Studio export.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 2, 2026</div>
    <div class="changelog-version">v2.48.3: A waitlist form for the Salt to Taste thank-you page</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>.taste-waitlist</code> in <code>css/taste.css</code>: a <code>ws_input</code> and a secondary <code>ws_button</code> stacked inside the existing <code>.taste-onward</code> block, with a status line that keeps its height so the confirmation does not shift the page. Errors read in <code>--brand-ink</code>.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 30, 2026</div>
    <div class="changelog-version">v2.48.2: A billing switch on the homepage Pro card</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>.ctr-billing</code> in <code>css/index2.css</code>: the /pricing/ Monthly / Yearly toggle at card size, two ghost <code>ws_button</code>s in a <code>--brand-line</code> track with the chosen one filled <code>--brand-ink</code>. A negative block margin keeps the Pro card's head row at the h3's height so its price lines up with Free's.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>.ctr-plan__cta.is-busy</code> and <code>.ctr-plan__err</code>: the Pro button dims while Stripe checkout opens, and a failure reads under it in <code>--brand-ink</code>, as on /pricing/.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 30, 2026</div>
    <div class="changelog-version">v2.48.1: The listing card moves in sequence</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> Listing card hover runs as one sequence in <code>css/listing-redesign.css</code>: the card lifts, then the category tile warms to <code>--brand-soft</code> and grows to 106%, then the title turns <code>--brand-ink</code>, then the actions brighten, 40ms apart. Delays apply on hover only, so leaving returns everything at once. Hover-capable pointers only.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>listing-card-enter</code>: on the first library listing page of a session (<code>.listing-enter</code> on <code>&lt;html&gt;</code>), the first nine cards fade up 12px in a 40ms stagger, <code>--duration-slow</code> and <code>--ease-spring</code>.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> The listing card's motion now honours reduced motion: no lift, no tile scale, no delays, no entrance. The tile's colours moved from an inline style in <code>includes/partials/listing-card.php</code> to <code>--brand-tint</code> and <code>--brand-ink</code> in CSS.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 30, 2026</div>
    <div class="changelog-version">v2.48.1: Every call site on contract</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>.ws-field__hint</code>, the help line <code>ws_input</code> renders, had no styles, so every input hint showed at body size; it now shares the <code>.ws-field__helper</code> rule.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_input</code> type <code>file</code> is styled (the picker button reads as a secondary button) and documented.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>ws_section_header</code> takes <code>tag: h1</code> on a page with no hero, where it opens the page.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> No call site passes an option value or name its component does not support. Status colours go through the <code>status</code> key, activity types through <code>ws_activity_badge</code>, and button attributes through <code>attrs</code>.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 30, 2026</div>
    <div class="changelog-version">v2.48.0: Built for agents, and for agent screens</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> A shared set for AI screens: <code>ws_ai_mark</code> and the <code>ws_badge</code> <code>ai</code> variant ("Prepared by Workshopr"), <code>ws_agent_status</code> (thinking, or stages with a retry on a failed one), <code>ws_agent_steps</code>, <code>ws_agent_check</code>, <code>ws_agent_proposal</code> (before and after, Apply, Not now, Undo), <code>ws_source_chip</code> and <code>ws_consent_row</code>. <code>js/ws-agent.js</code> draws the same markup from JavaScript, and a parity test holds the two together.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> Three screen recipes with default, loading, empty and error states: a filtered workshop list, a settings form and a confirmation before deleting. <code>ds:find</code> and the MCP return a recipe when the request is for a whole screen.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>npm run ds:build-eval</code> scores what an agent builds, not just what it finds: components, option values, tokens, legacy patterns, rendering, required states and keyboard access, in a locked-down PHP sandbox.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> An option value is valid only when <code>components.css</code> styles it, and <code>generate-catalog.php --check</code> fails on any disagreement. Every entry says when to use it, when not to, what to choose instead, and what accessibility work the caller owns. <code>ws_input</code> lists the options it really reads (<code>hint</code>, not <code>helper</code>).</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> The playground previews most helpers, curated or built from the signature, with visual baselines for each curated fixture. START-HERE.md opens with the five-step agent workflow.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>components.css</code> reads the five brand tokens instead of the legacy phase and site aliases, with no change to any resolved value. A new ratchet in <code>check-page.php</code> stops pages adding <code>.modal-overlay</code> or hand-rolled card classes.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Tabs follow the WAI-ARIA pattern: arrow keys, Home and End, and panels labelled by their tab. Filter bar dropdowns and search have accessible names.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Secondary button text uses <code>--brand-ink</code> and the <code>ws_empty_state</code> description uses <code>--text-default</code>, so both meet contrast guidelines.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Token cycles that silently broke styling when stylesheets loaded in a different order: <code>--font-body</code> and nine more in <code>css/tokens/_variables.css</code>, self-references in the academy, DNA and auth modal sheets, and the Planner's <code>--color-warning</code>.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 1, 2026</div>
    <div class="changelog-version">v2.47.2: One contract for agents</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>components.generated.json</code> is now the contract every agent tool reads. Each <code>ws_*</code> function, including <code>ws_header</code>, <code>ws_section_hero</code>, the DNA and app shelf helpers and <code>ws_workshop_list</code>, carries its option values and defaults, demo, playground fixture, states and scope. A new <code>tokens</code> section lists every token with its purpose, group, tier and, for a legacy alias, the <code>--brand*</code> token to use. A new <code>legacy</code> section, from <code>legacy-patterns.json</code>, names the lookalikes to avoid.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>ds:find</code> and the design-system-enforcer MCP rank requests with one shared search over the catalog and <code>synonyms.json</code>, and <code>ds:find</code> now returns tokens for styling requests. The MCP warns on legacy alias tokens, lookalike classes and option values the catalog does not list.</li>
        <li><span class="changelog-tag changelog-tag--new">New</span> <code>npm run ds:eval</code> scores both finders on plain-language requests and fails if a score drops. Two new gates: <code>check-drift.php</code> fails when a token is missing from the catalog, and <code>generate-catalog.php --check</code> holds a completeness ratchet in <code>catalog-baseline.json</code>.</li>
        <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>tokens.dtcg.json</code> regenerated with the five brand tokens, so <code>npm run check:ds</code> passes. START-HERE.md names commands instead of hard-coded counts and is now checked by <code>npm run lint:docs</code>.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">October 1, 2026</div>
    <div class="changelog-version">v2.47.1: One red, five names</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> Five brand tokens in platform-tokens.css: <code>--brand</code>, <code>--brand-ink</code>, <code>--brand-line</code>, <code>--brand-soft</code> and <code>--brand-tint</code>.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> The 53 phase and app reds (<code>--phase-*</code>, <code>--mainsite-*</code>, <code>--planner-*</code>, <code>--coach-*</code> and the rest) now point at those five instead of repeating the hex, so the red changes in one place. Every token resolves to the value it had before. Error, chart and category colours keep their own values.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 30, 2026</div>
    <div class="changelog-version">v2.47.0: Find, preview, verify</div>
    <ul class="changelog-list">
        <li><span class="changelog-tag changelog-tag--new">New</span> Component playground with editable states, isolated previews, and matching PHP examples.</li>
        <li><span class="changelog-tag changelog-tag--improved">Improved</span> Catalog search and a database-free browser suite give Claude a repeatable component workflow with visual regression checks.</li>
    </ul>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.46.1: Plan's toolbar is its tools; a wider launcher</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>ws_phase_toolbar('plan')</code></strong> has no lead or trail pill. The canon (<code>includes/components/phase-toolbars.php</code>) drops the <code>timer</code> read-out and the <code>tone: success</code> time-left read-out, since the strip above the builder's canvas carries both. <code>tone: success</code> stays supported in <code>ws_app_dock()</code>; nothing uses it now. Spec, demo, DESIGN.md §12 and <code>PhaseToolbarTest</code> follow; Synthesize's count is now the example of a wordless pill.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>App launcher</strong> (<code>.app-launcher__panel</code>, <code>app/css/app-shell.css</code>): 720px wide instead of 536, still two columns, so each app's description stays on one line.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.46.0: Comments from a workshop card</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Workshop card menu: Comments</strong> (<code>ws_wl_menu_template()</code>, <code>data-wl-act="comments"</code>, <code>data-wl-need="comments"</code>), after the phase jumps. <code>app/js/workshop-list-menu.js</code> keeps it only where the page carries the comments panel, and opens it through <code>window.wsCommentsOpen(id, name, returnTo)</code>, which the panel script now exposes: it opens <code>ws_side_panel()</code> on a named workshop, with the subtitle naming it, or switches workshop in place when the panel is already open, and hands focus back to the card's <code>more_vert</code> on close. A listing books the panel for its page through <code>appCommentsBookForList()</code>; a bar that also asked for it keeps its phase.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Comments panel save step</strong> (<code>.app-comments__save</code>): on Strategize with no saved workshop, a small primary <code>ws_button</code> Save to account sits under the note. It carries the bar's <code>data-st-save-account</code> hook, so it opens the same naming dialog. <code>strategist.js</code> fires <code>ws-plan-saved</code> after a save, and an open panel reloads on it and moves focus to the comment field.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.45.1: The header paints signed in</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>ws_header()</code></strong> renders the auth state its cookie session already resolves for the account menu: <code>.wsh-header__signin</code> arrives <code>hidden</code> and <code>.wsh-header__account[data-wsh-auth="in"]</code> visible for a signed-in reader, the reverse for everyone else. It rendered Sign In/Register for all and left <code>wshApplyAuth()</code> to swap in the avatar after load, which flashed on every page. <code>wshApplyAuth()</code> now counts the server session as signed in while localStorage has the user but not yet the Bearer token; clearing <code>workshopr_user</code> still signs the header out. Pinned by <code>tests/E2E/header-auth-first-paint.spec.js</code>.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>ws_header()</code> dropdowns</strong> take <code>.wsh-header__link--active</code> on any page their menu lists, not only the one their own href names, so the <code>home</code> section's Company stays lit across all five company pages. Off-site and fragment items never match. Pinned by <code>tests/E2E/header-company-active.spec.js</code>.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.45.0: Side Panel; comments on every phase</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>ws_side_panel($body, $options)</code></strong> (<code>includes/components/side-panel.php</code>, <code>.ws-side-panel</code> in <code>components.css</code>, <code>wsSidePanelOpen/Close/Toggle()</code> in <code>components.js</code>, demo at <code>components/demos/side-panel.php</code>): a non-modal panel that slides in from the right edge. <code>role="dialog"</code> with <code>aria-modal="false"</code>; nothing goes inert and focus is not trapped. Any <code>[data-ws-side-panel-open="{id}"]</code> toggles it and keeps its <code>aria-expanded</code> in step; Escape (focus in the panel or on its toggle) or the close button put it away and hand focus back; one is open at a time. It fires <code>ws-side-panel-open</code> and <code>ws-side-panel-close</code>. In on <code>--duration-enter</code> and <code>--ease-spring</code>, out on <code>--duration-exit</code> and <code>--ease-in</code>, transform only. It layers one step under overlays (<code>--z-overlay</code> minus 100), so modals, toasts, header menus and the launcher land on top of it. Placement is <code>--ws-side-panel-top</code> / <code>--ws-side-panel-bottom</code> (the app shell keeps its 60px header and its footer clear); opened from a bar (<code>.ws-app-bar</code> or <code>[data-ws-side-panel-anchor]</code>) it starts under that bar and follows it as the page scrolls; full screen below 600px. Added to <code>workshopr-design-system.json</code> and the generated catalog.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>ws_side_panel()</code> branded variant:</strong> <code>'variant' =&gt; 'branded'</code> puts the head on the red band the branded <code>ws_modal</code> wears (<code>--phase-learn</code>, white title, subtitle on <code>--overlay-medium</code>, close on <code>--overlay-light</code>), and <code>'icon'</code> adds the icon pill beside the heading (<code>.ws-side-panel__icon</code>, on a light veil in the band). The comments panel wears both.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>ws_app_bar()</code> action that opens a side panel:</strong> white and filled with a red icon while its panel is open (<code>[data-ws-side-panel-open][aria-expanded="true"]</code>).</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Comments panel</strong> (<code>app/includes/comments-panel.php</code>, <code>app/css/comments.css</code>, <code>app/js/comments-panel.js</code>; Figma: Workshopr Teams mockups, Leave a comment, 10:1465) on <code>ws_side_panel()</code>. <code>appCommentsBarAction($phase)</code> puts <code>mode_comment</code> beside the save on Strategize's, Plan's, Facilitate's and Synthesize's bars, and <code>appCommentsPanelForPage()</code> renders the panel at body level. The form is <code>ws_select</code>, <code>ws_input</code> (textarea) and a full-width primary <code>ws_button</code>; the thread draws <code>.ws-avatar</code> (red for the workshop's owner, grey otherwise), <code>.ws-badge</code> for Facilitator and a <code>.ws-pill</code> count. Each thread's first comment carries Resolve beside Reply (<code>.app-comments__actions</code>), shown only to an owner or editor or the thread's author, as the API allows; a resolved thread leaves the list and <code>.app-comments__resolved</code> offers Undo, with focus moved onto it. Show resolved (<code>.app-comments__resolved-section</code>, a toggle with <code>aria-expanded</code>) lists the resolved threads under the open ones, their context and text on <code>--color-ink-muted</code>, a neutral Resolved <code>.ws-pill</code> on each first comment, Reopen in place of Resolve and no Reply. The API's list, add and resolve answers carry <code>resolved</code> and <code>resolved_total</code> beside the open threads. It reads and writes through <code>api/plan-comments.php</code> (list, add with <code>parent_id</code> for replies, resolve) and says comments are not switched on where that API or its table is missing. Facilitate's live shortcuts (<code>facilitator/js/modules/keyboard.js</code>) and the builder's undo (<code>planner/js/modules/history.js</code>) stand aside while focus is in a side panel.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.44.2: One workspace menu; install on every rail</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>ws_header()</code> account menu:</strong> the Workspaces section is gone, with <code>.wsh-header__menu-section</code>, <code>.wsh-header__menu-divider</code>, <code>.wsh-header__menu-item--team</code> and the <code>.wsh-header__team-*</code> rules; the menu is My Stuff, Settings and Sign out. The workspace switcher (<code>.wsh-ws</code>) is the one place to change or create a workspace. <code>page-baseline.json</code> counts the switcher's trigger among the header's raw buttons, as the avatar and app-switcher triggers already were.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>appShellRail()</code>:</strong> the Install Workshopr block (<code>.app-rail__install</code>, its toast slot and the secondary <code>ws_button</code>) renders on every rail, straight under the journey card, or in its place on a view without one. It was Home's alone, at the foot of the rail.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Workspace page (<code>app/css/team.css</code>):</strong> Recent files is one card per file on <code>--card-padding</code> and <code>--card-radius</code> (<code>.app-team__recent-list</code>), replacing the single <code>.app-team__recent-card</code>. A file's Launch menu draws each phase with the side nav's own icon, read from the nav's config and drawn as <code>ws_sidenav</code> draws it (the local SVG, <code>.app-team__menu-icon</code>, else the font glyph). The rail's Invite people button aligns right.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Favicons:</strong> <code>images/favicon-32x32.png</code> and <code>images/favicon-16x16.png</code> are rendered from <code>images/favicon.svg</code> (graph_3), and <code>images/apple-touch-icon.png</code> is the app's 180px graph_3 icon. They still carried the retired W, and Chrome takes a PNG whose <code>sizes</code> fits over the SVG, so the tab showed the W. <code>includes/header.php</code> versions the three links (<code>?v=2</code>) so a cached icon is refetched. The install toast (<code>app/js/app-install.js</code>) draws graph_3 where <code>wsToast()</code> draws its info circle.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.44.1: Paper empty phases; no Beta pill</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Empty phases on paper:</strong> the Strategize, Plan, Facilitate and Synthesize lists pass <code>'class' =&gt; 'wl--phase'</code> to <code>ws_workshop_list()</code>, and <code>app/css/app-shell.css</code> sets their <code>.ws-empty-state</code> on <code>--bg-paper</code> in place of the component's darker paper. Home and Prove keep the component's own.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>ws_app_footer()</code> full variant:</strong> the 2.0 Beta pill is gone, with <code>.ws-app-footer__beta</code> and the shell's size override for it; the bar now reads the wordmark and the build version. The component demo follows.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.44.0: A settings page for each workspace</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>/app/?view=team&amp;section=settings</code></strong>: the team view is two pages now, set by <code>data-team-mode</code> on its root. The workspace page keeps the invite notices and Workshops; the settings page puts Members, Plan &amp; seats (<code>#team-billing</code>) and Team settings in the main column, the settings rows side by side there. Both render every section and <code>team.js</code> runs the same; <code>[data-team-mode-only]</code> in <code>app/css/team.css</code> keeps each section to its own page. The workspace page's rail gains a full-width secondary Workspace settings <code>ws_button</code> under Seats, and Seats' Manage seats opens the settings page at Plan &amp; seats. Switching workspace from the settings page stays on settings. (The switcher had a Workspace settings row too; it was taken off, so the rail's button is the way in.)</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>No first-paint flicker:</strong> the view resolves the workspace it opens on the server (the address, the current workspace, then the first team) and renders its name, the reader's role line and the full trail, handing team.js the same id through <code>data-current-workspace</code>. "Work together." is only the no-team state now. The indeterminate <code>ws_progress</code> gives way to <code>ws_skeleton</code> placeholders shaped like the sections on their way (the Workshops card's rows, the member tiles, the Plan &amp; seats card), hidden when the section they stand for draws, and the rail's Seats card shows its own skeleton (<code>.is-pending</code>) for the people it will fill for.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Workshop cards:</strong> the Workshops container is gone, and with it <code>.app-team__card--workshops</code> and its dashed-to-solid red mask; the heading, count and Add a workshop sit on the page (<code>.app-team__head--above</code>) and the list is <code>.app-team__ws-grid</code>, tiles three across on <code>--card-bg</code> with <code>--shadow-sm</code> like the member cards (icon and options menu on top, the name clamped to two lines, then its details), dropping to two and one by a container query on <code>.app-team__workshops</code>. Plan &amp; seats' bar is <code>ws_progress()</code> now rather than hand-written markup.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Recent files</strong> on the workspace page, grown from the Teams build's "New in the library" rail card into a main-column section: <code>.app-team__recent</code>, the heading above a card of rows (icon tile, name, then kind, workshop, who and when), opening on <code>ws_skeleton</code> rows. Fed by <code>/api/teams.php?action=recent_files</code> (<code>wsTeamRecentFiles()</code>, <code>includes/team.php</code>): the workspace's agendas, the reader's own syntheses (anyone else's is private, so it would be a dead link) and, while Prove is on, Impact Reports. Each row carries the page's <code>more_horiz</code> menu (kind <code>file</code>) to launch its workshop in Strategize, Plan, Facilitate or Synthesize, on the listing's routes (<code>ws_wl_stage_routes()</code>); each file names its <code>plan_id</code> for it.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Workspace page to its Figma (Workshopr Teams mockups, S03):</strong> <code>.app-team__hero--home</code> (the Workspace pill with the role line, the name, <code>.app-team__people</code> with an <code>.ws-avatar-group</code> and the count of each role); <code>.app-team__month</code>, three counts on a card; <code>.app-team__ws-toolbar</code> with a search <code>ws_input</code> and the shared listing's <code>.wl-chip</code> buttons (<code>workshop-list.css</code> now loads on the team view) for All, Mine and Shared with me; and <code>.app-team__ws-card</code>, whose stage chip (<code>.app-team__stage</code>), next-step label and route come from the listing's own rules (<code>ws_wl_cta_for_stage()</code>, <code>ws_wl_stage_href()</code>) through <code>/api/teams.php?action=workshops</code>. Invite people is a rail <code>ws_card</code> above Seats. (The hero's New workshop button and its dialog were built, then taken off.) Not built, because this branch has no data for them: the Library tab, the Editing now chip, the email domain and the Builder and Viewer roles.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.43.0: Create a workspace in a dialog</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>appWorkspaceCreateModal()</code></strong> (<code>app/includes/workspace-modal.php</code>, driven by <code>app/js/workspace-create.js</code>): the switcher's Create workspace row (<code>[data-wsh-ws-create]</code>) opens a branded <code>ws_modal</code> with one <code>ws_form_row()</code> field, whose helper line becomes the error after blur and carries any refusal from <code>/api/teams.php?action=create</code>, and the actions in <code>ws_modal_footer()</code>. The app shell renders it on every page the switcher shows on; the row keeps its href to the team page's create card for when script is off.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Focus in a dialog opened from a menu:</strong> <code>wsModalOpen()</code>'s trap focuses the first control (the close button) once the overlay has faded in, so a dialog that wants its field focused does it after that, on the overlay's <code>transitionend</code> and a timer past the trap's. Focus moves to the switcher's button before the dialog opens, so closing hands it back there rather than to a row in a hidden menu.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.42.1: The brand mark is graph_3 again</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>images/icons/graph_3.svg</code> was a copy of <code>picture_in_picture_alt.svg</code></strong>, so every <code>icon('graph_3')</code> drew a window: the homepage hero badge (<code>section-hero.php</code>), the <code>/app/</code> sign-in brand, the planner's logo menu and onboarding. It now holds the real Material Symbols <code>graph_3</code> path, the one <code>images/favicon.svg</code> and the header's font glyph already draw. It keeps its <code>#E54D4D</code> fill, because onboarding loads it as an <code>&lt;img&gt;</code> where <code>currentColor</code> cannot reach.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The <code>/app/</code> install icons are the brand mark:</strong> <code>app/icons/</code> swaps the four squares for a white <code>graph_3</code> on the red tile, with PNG 192 and 512, a full-bleed maskable 512 and a 180 <code>apple-touch-icon.png</code> (Safari and iOS ignore SVG touch icons). <code>app/manifest.json</code> lists them.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Rail promo cards are light red on every rail:</strong> <code>.app-rail__tips</code> (Tips, Intervention Cards, Academy) rests on <code>--phase-learn-very-light</code>, as the Strategize rail already drew it; hover firms the edge to <code>--phase-learn-light</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Toasts clear the <code>/app/</code> frame footer:</strong> above 900px, <code>body.app-shell &gt; .ws-toast-container</code> sits <code>--app-footer-height</code> (48px, new, also the footer's height) plus <code>--space-6</code> up. Home's install toast opens in <code>.app-rail__install-toast</code>, a live-region slot above its button, rather than in the corner stack.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.42.0: Cards are warm paper</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>--card-bg</code> is now <code>#F7F1EA</code></strong>, a warm paper tone between <code>--bg-paper</code> (<code>#FAF7F2</code>) and <code>--bg-paper-dark</code> (<code>#F0EBE3</code>). It was an alias of <code>--bg-surface</code>; it now holds its own value at the semantic layer, the way <code>--toast-bg</code> does. White stays for what opens over or inside a card: modals, menus, inputs and checkboxes. Mirrored in <code>workshopr-design-system.json</code> (<code>colors.backgrounds.card</code>), <code>tokens.dtcg.json</code> (<code>card.bg</code>), the Colors and Tokens pages, and <code>DESIGN.md</code> §7, which no longer calls cards white.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Every component that already read <code>var(--card-bg)</code> follows without an edit:</strong> <code>ws_card</code>, <code>ws_choice_cards</code>, <code>ws_task_checklist</code>, the library <code>.listing-card</code>, and in <code>/app/</code> the workshop card, the settings, contribute and sign-in cards and the stuff rows.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The <code>/app/</code> cards that painted white directly now read the token:</strong> <code>.app-team__card</code> (<code>app/css/team.css</code>), the kanban card <code>.wl-kcard</code> and timeline row <code>.wl-tl__row</code> (<code>app/css/workshop-list.css</code>), and in <code>app/css/app-shell.css</code> the handoff sheet <code>.app-shell__sheet</code>, Plan's Strategist nudge <code>.lp2-nudge</code> and the Strategize rail's compact checklist. Fallbacks that still said <code>#FFFFFF</code> beside <code>--card-bg</code> now say <code>#F7F1EA</code>. Tables, list containers, menus, the launcher and the Synthesize action rail keep their white.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Figma:</strong> <code>color/card/bg</code> in the Canvas Design System's <code>Primitives</code> collection (fill scopes, WEB code syntax <code>var(--card-bg)</code>) with a matching paint style, bound as the fill of <code>Card</code>, <code>Listing card</code>, <code>Task checklist</code>, <code>wl-card</code>, <code>card-296</code>, <code>rail-todos</code>, <code>rail-film</code>, <code>plan-choice-card</code> and <code>plan-nudge</code>. Consuming files pick it up after the library is published.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.41.0: Workspaces on the components</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Workspace page (<code>app/css/team.css</code>):</strong> the shell trail (<code>appShellCrumbs()</code>) now opens it, with the open workspace's name set by <code>team.js</code>. <code>.app-team__card--workshops</code> sits on <code>--bg-paper</code> inside a 1px <code>--phase-learn</code> edge dashed 4 on, 4 off, drawn as an SVG mask on <code>::before</code> because <code>border-style: dashed</code> cannot set the dash or the gap; with workshops in it (<code>.has-workshops</code>, set by <code>team.js</code>) the mask goes and the 1px border shows solid in the same red. <code>.app-team__invite-card</code> fills with <code>--phase-learn-light</code>. Members and pending invites are <code>.app-team__grid</code> tiles three across, on <code>--card-bg</code> with no container card around them, dropping to two and one by a container query on <code>.app-team__members</code>'s width rather than the viewport's. The seat count is a large <code>ws_select</code> on the Seats row, tied to the billing form by <code>form=""</code> and enabled only for the owner once billing is live.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The workspace dialogs are on the components:</strong> Invite teammates and Add a workshop to the team now follow the shell's modal pattern (<code>appPlanTemplateSaveModal()</code>, <code>appStrategizeNewCaseModal()</code>): the branded header with an icon and a subtitle, fields through <code>ws_form_row()</code> with <code>ws_input()</code> and <code>ws_select()</code> in place of raw <code>&lt;input&gt;</code> and <code>&lt;select&gt;</code>, the row's remove as <code>ws_icon_button()</code>, the empty state as <code>ws_alert()</code>, and the actions in <code>ws_modal_footer()</code>, whose type=button primary <code>team.js</code> submits along with Enter. Per-row invite errors use <code>.ws-form-row__error</code> and <code>.ws-form-row--error</code>, with <code>aria-invalid</code> and <code>aria-describedby</code> on the field. <code>group_add</code> is not in <code>images/icons/</code>, so the dialog wears <code>groups</code> and its button <code>add</code>.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Rail Seats card</strong> (Figma: Workshopr Teams mockups, Card · Builder seats, 12:1528): <code>appShellRail()</code> takes <code>afterProfile</code>, HTML set directly under the DNA card, and the workspace page puts a <code>ws_card</code> there built from <code>ws_badge</code> (status, success), <code>ws_progress</code>, an <code>.ws-avatar-group</code> of <code>ws-avatar--xs</code> and a secondary <code>ws_button</code>, styled as <code>.app-rail__seats</code> in <code>app/css/team.css</code>. The frame's copy is the new role model's (Builders take seats; viewers and guests are free); on this branch every member and pending invite takes a seat, and the card says so. <code>ws_card()</code> takes <code>id</code> but not <code>attrs</code>, and its <code>data</code> option prints nothing, so the card is found by id and kept out of sight by a class until <code>team.js</code> fills it.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Team settings, redesigned and in the rail:</strong> <code>.app-team__setting</code> rows (what it does, then its control; side by side in the main column, stacked under <code>.app-rail</code>), a <code>.app-team__danger</code> zone on <code>--color-error-very-light</code>, and Leave and Delete in branded <code>ws_modal</code> dialogs with a <code>danger</code> primary in <code>ws_modal_footer()</code> in place of <code>confirm()</code> and <code>prompt()</code>. The team root (<code>data-team-root</code>) is now the whole <code>.app-page</code>, rail included, so <code>team.js</code> reaches the cards there.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Invite notices:</strong> an email-matched invite card carries a close <code>ws-btn--icon-only</code> (remembered per browser under <code>workshopr_team_invites_dismissed</code>) and fades after 30 seconds on <code>--duration-slow</code>, the clock pausing on hover and focus as <code>wsToast</code>'s does.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Workspace switcher</strong> in <code>ws_header()</code> (Figma: Workshopr Teams mockups, Workspace menu, 70:6288), <code>.wsh-ws</code>: a trigger beside the logotype and a menu of Personal and every workspace, with Create workspace and Workspace settings. It renders only when the page passes <code>'workspaceSwitcher' =&gt; true</code> (the app shell does, through <code>$ws_header_opts</code>) and <code>teamsVisible()</code> is on. <code>window.wshSetWorkspace(teamId)</code> lets a page correct the current workspace after load.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.40.4: Toasts are plain text</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>wsToast()</code> wrote its message and action label into <code>innerHTML</code></strong>, so any caller passing a server message that carried a user-typed name (a team name in <code>app/js/team.js</code>, a participant name in the pre-work tool) handed that name to the HTML parser. Both are now set with <code>textContent</code> in <code>includes/components/components.js</code>; the icons stay static markup. The legacy inline <code>Toast.show()</code> in <code>includes/footer/toast-inline.php</code> does the same for its title, message and action text. Pass raw text: the callers that pre-escaped (<code>app/js/plan-template-save.js</code>, <code>plan-templates-page.js</code>, <code>plan-template-picker.js</code> and the first-save toast in <code>planner/js/planner-v2.js</code>) no longer do, or they would show <code>&amp;amp;</code>. The planner's &ldquo;Removed &middot; Undo&rdquo; toast, the one caller that passed markup, now appends its <code>.toast-undo-btn</code>, <code>.toast-undo-hint</code> and <code>.sr-only</code> spoken form as nodes inside <code>.ws-toast__message</code>, so it looks the same. The four pages that loaded <code>components.js</code> with no <code>?v=</code> (the pre-work tool, <code>dna/about.php</code>, <code>intervention/card.php</code> and the design-system footer) now cache-bust it. Covered in <code>tests/toast-a11y.spec.js</code> and the planner delete-and-undo test in <code>planner/tests/planner.spec.js</code>.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.40.3: Accordion panels have a name</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>ws_accordion</code> panels pointed <code>aria-labelledby</code> at the item wrapper</strong>, which holds the panel itself, so screen readers named each region with its heading and its whole body text. The trigger now carries <code>{id}-trigger</code> and the panel points at it, and the <code>expand_more</code> arrow is <code>aria-hidden</code>. Same change in <code>includes/components/accordion.php</code>, <code>components/php/Accordion.php</code> and <code>components/react/Accordion.tsx</code>.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.40.2: The intro survey on the system</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>/survey/</code> is rebuilt from <code>ws_pill</code>, <code>ws_progress</code>, <code>ws_radio_card_group</code>, <code>ws_input</code> and <code>ws_button</code></strong> inside the site header and footer, on a card that matches <code>/start/</code>. Its own stylesheet and inline SVG buttons are gone; layout lives in <code>survey/survey.css</code> on platform tokens.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>ws_radio_card_group</code> icons had no size</strong> and painted at about 12px. The survey sizes them at 24px locally; the component itself still leaves it to the page.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.40.1: Modal footer attrs, focus rings</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>ws_modal_footer()</code> now passes <code>attrs</code> through</strong> to its left, cancel and primary buttons (<code>includes/components/modal-footer.php</code>). The docblock always promised it; the template dropped them, so a footer button could not carry <code>data-modal-close</code> or a <code>data-*</code> hook. It broke the Cancel subscription dialog in Settings (neither button did anything) and the demo buttons on the modal page.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Keyboard focus rings are sky-blue site-wide.</strong> <code>*:focus-visible</code> and <code>button:focus-visible</code> in <code>css/styles.css</code> painted <code>--primary-red</code>; they now use <code>--focus-ring-color</code>, <code>--focus-ring-width</code>, <code>--focus-ring-offset</code> and <code>--focus-ring-halo</code>, the one non-red accent Red Unification keeps.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Modal body copy in Settings</strong> (<code>app/css/settings.css</code>): spacing between paragraphs and fields, <code>--text-body</code> on <code>--color-ink</code>, and an underlined <code>--phase-learn-dark</code> link, instead of the unstyled 9.8px black text <code>ws_modal</code> leaves.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The Cancel subscription dialog is <code>variant =&gt; 'branded'</code></strong>, matching every other dialog in the app shell.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.40.0: Plan templates</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Plan's toolbar gains a ninth slot, <code>template</code></strong> (Save as template, glyph <code>bookmark_add</code>), between Export agenda and Slide deck in <code>includes/components/phase-toolbars.php</code>. <code>images/icons/bookmark_add.svg</code> is new. The builder shows the slot once the workshop is saved. <code>design-system/spec-phase-toolbar.md</code> lists it.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>The Save as template dialog,</strong> <code>appPlanTemplateSaveModal()</code> in <code>app/includes/plan-template-modal.php</code>: a branded <code>ws_modal</code> shaped like Name Workshop, one <code>ws_form_row</code>, <code>ws_modal_footer</code>. It renames too. A clashing name draws an inline Replace it inside the row's error (<code>.pt-save-replace</code>).</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>The template picker and card</strong> (<code>app/views/plan/template-picker.php</code>, <code>app/css/plan-templates.css</code>): a large branded <code>ws_modal</code> with <code>ws_tabs</code>, and <code>.pt-card</code> on <code>ws_card</code>: name, job line, duration and item count, an outline of four with the planner's activity-type dots, a <code>ws_badge</code> for slots to fill, and a Use button. Skeletons, empty and error states are <code>ws_skeleton</code>, <code>ws_empty_state</code> and <code>ws_alert</code>.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>The My templates rows</strong> (<code>.pt-rows</code>, <code>.pt-row</code>) with an inline delete confirmation (<code>.pt-del__pop</code>) drawn as the workshop card menu's is.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The workshop card ⋮ menu</strong> offers Save as template under Duplicate, for workshops you own.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.39.4: Control-centre homepage rules</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>css/index2.css</code>, the <code>.ctr-*</code> rules for /index2.php:</strong> the bento rows at the frame's uneven widths, captions below each tile, cropped screenshot tiles, the fanned intervention cards, the plans, the voices and the red closing box, all on platform tokens. It loads the Fraunces 600 and 700 italics the display emphasis uses, since the site loads only the 400 italic.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.39.3: App analytics admin rules</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>.aa-*</code> rules in <code>css/admin/admin-v2.css</code> for App analytics:</strong> period buttons, filter chips, phase dots and the journey timeline, all on platform tokens.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.39.2: Homepage facts, table and FAQ sections</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>.tue-facts</code> and <code>.tue-faq</code> (<code>css/index-new.css</code>).</strong> Two homepage sections on the plans' rhythm, headed by <code>ws_section_header</code>: a two-column fact list, a semantic stage table (<code>.tue-facts__table</code>: Inter, <code>--gray-700</code> header on <code>--gray-50</code>, <code>--gray-200</code> rules, horizontal scroll below 900px), and a <code>ws_accordion</code> FAQ. Tokens only; the h2 shares the plans' existing size rule.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.39.1: Shell-scaled type aliases in app-shell.css</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>--shell-text-*</code> aliases on <code>html.app-shell-root</code> (<code>app-shell.css</code>).</strong> The shell root is 70%, so the rem type tokens paint at 70% inside it; <code>--shell-text-h3</code>, <code>-small</code>, <code>-meta</code>, <code>-caption</code>, <code>-micro</code> and <code>-nano</code> divide the token by <code>--shell-scale</code> so a component the frames draw at library size can say so with a token. The footer, the See All button, the Strategize bar title and the shell breadcrumbs use them in place of px literals.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Icon boxes and negative margins on the rail take tokens</strong>: <code>--icon-xs</code> and <code>--icon-md</code> for the tips and DNA arrows, <code>--space-1</code> and <code>--space-1-5</code> for the academy art and medal offsets. The four values no token lands on (the 9px beta tag, the See All button's 9px pad and corner, the kit head's 5px nudge) carry a <code>ds-lint-disable-line</code> with the reason, matching the file's existing convention.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.39.0: First-run form, rehearsal bar, one checklist label set</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Home's first-run form (<code>app-shell.css</code>).</strong> <code>.dash__firstrun-title</code>, <code>-lede</code>, <code>-form</code>, <code>-date</code> and <code>-alt</code>, tokens only, built from <code>ws_input</code> and <code>ws_button</code>. The <code>.app-ob*</code> welcome overlay and <code>.app-tour*</code> coach-mark rules are removed with the JS that drew them.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>.fac-rehearsal-bar</code> (<code>facilitator/css/facilitator.css</code>)</strong>: a persistent bar above every console screen in a rehearsal, <code>ws_badge</code> plus two <code>ws_button</code> links, and a red icon override on the rehearsal-complete screen.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The Display Text Pattern keeps its red in /app/ headers.</strong> <code>.app-crumbs + .app-hero .app-hero__title em</code> takes <code>--mainsite-dark</code> instead of <code>inherit</code>, and the <code>.st-page--home .st-hero__title em</code> ink override is removed, so the four phase indexes and the Strategize index match the steps: bold italic dark red on the light red underline.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>One label set for the journey checklist</strong> (<code>appRailJourneyCard()</code>, the <code>ws_task_checklist</code> demo, and <code>rail-todos</code> <code>130:332</code> in the Canvas Design System Figma file, whose checks are now circles to match the component). The compact subtitle's step count is derived from the rows.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.38.2: Session-start dialog cards, Strategize rail and hero on the phase indexes</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>One hero for the four phase indexes.</strong> <code>.app-crumbs + .app-hero</code> (Plan, Facilitate, Synthesize) is drawn to <code>.st-hero</code>'s measurements: 24 under the hero, the lede at <code>--text-body</code> on a 62ch measure in <code>--text-secondary</code>, and the listing heading (<code>.wl__title</code>, plus Plan's <code>.launchpad-choice-screen__title</code>) at <code>--text-h2</code> semibold. All four titles wear the Display Text Pattern: upright bold first line, <code>em</code> bold italic <code>--mainsite-dark</code> on an inset 8px <code>--mainsite-light</code> underline (underlined words in an /app/ header are always red); <code>.st-page--home .st-hero__title</code> joins <code>.st-page--workbench</code> for it. Home's <code>.dash__greeting</code> (<code>dashboard.css</code>) moves from <code>--text-h2</code> to <code>--text-display-lg</code> at 1.12, the index title's size; <code>.dash__hero-title</code> is unchanged. The three views no longer take <code>.app-hero--compact</code> or <code>titleHidden</code>; Prove still does. Synthesize's index joins <code>$barlessIndex</code> and gains <code>appShellCrumbs()</code>.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Admin contributions drawer: review findings panel.</strong> <code>.review-findings</code>, <code>.review-finding--blocking | --should | --nice</code> and their parts are styled in the page's own <code>&lt;style&gt;</code> block, in the admin's existing idiom (literal admin colours, not platform tokens; the admin area sits outside the design system). Every server string is inserted as <code>textContent</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Synthesize intake wears the app frame again.</strong> <code>Intake.view</code> renders <code>.wrap--app.wrap--intake &gt; .sy-app.sy-intake</code> with <code>aside.sy-rail.sy-artifacts-rail</code> first and <code>section.sy-main.sy-intake-left</code> after it, and <code>viewBooting()</code> draws the same classes, so the skeleton and the screen are one layout. <code>synthesize.css</code> drops the intake's own <code>1fr 340px</code> grid. In the shell (<code>app-shell.css</code>, from 1081 up) the tan column is a <code>--bg-paper-dark</code> gradient on <code>.sy-intake</code> to <code>--app-rail-width</code>, the rail is transparent, <code>min-height: 0</code> and capped at <code>100dvh - 2 * --app-bar-height - --space-12</code> so it sticks; the rail pads 12 a side (296 of content), the surface <code>24 48 110 32</code>; the wrap's 24 and the stage's 96 dock clearance are zeroed on this screen via <code>:has(.sy-intake)</code>. <code>$wearsFooter</code> in <code>app/index.php</code> now includes <code>synthesize</code>. The compact journey card's finished state no longer takes a <code>cta</code>. <code>.synth</code> (<code>synthesize.css</code>) paints <code>--bg-page</code>, <code>--paper-grid-image</code> and <code>--paper-grid-size</code> in longhand; it was the <code>background:</code> shorthand, which wiped the grid on every screen that did not draw its own surface.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Session-start dialog, second pass.</strong> <code>#facStartModal-overlay .ws-modal__title</code> steps to <code>--text-h2</code> (the agenda check's precedent for a branded header); <code>.fac-start__value</code> drops from a literal 22px to <code>--text-h2</code> and its label to <code>--text-meta</code>; cards are 12 by 16; each row carries a <code>ws-pill ws-pill--md</code> (<code>.fac-start__item-type</code>: white, the card's edge colour, ink text) before a 4em right-aligned duration column. The visually hidden type prefix is gone, the pill says it.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The session-start dialog (<code>.fac-start</code>, <code>app-shell.css</code>).</strong> New <code>.fac-start__head</code> puts the name left and <code>.fac-start__stats</code> right-aligned on one row (wraps under the name when it runs out of room). <code>.fac-start__agenda</code> loses its paper box and row dividers; each <code>.fac-start__item</code> is a thin card (8 by 12, <code>--radius-md</code>, 6 gap) whose tint and 1px edge come from <code>data-type</code> (<code>exercise</code>, <code>icebreaker</code>, <code>break</code>). The shell does not load the console's sheet, so the three <code>--fac-type-*</code> pairs are restated as <code>--fac-start-*</code> on <code>.fac-start</code> and must move with them. <code>facilitate-start.js</code> resolves the type the way <code>FacilitatorAgenda.planToAgenda</code> does, plus the meal types, and says it in a <code>.ws-visually-hidden</code> prefix.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>appShellRail()</code> takes <code>'look' =&gt; 'strategize'</code></strong>: another view gets Strategize's rail item for item (compact checklist at every stage, no waiting card) and the aside wears <code>.app-rail--strategize</code> beside its own class so the redrawn cards apply. <code>'newWorkshop' =&gt; 'standalone'</code> renders the naming dialog with the state factory, as Home does. Plan's index uses both; Saved agendas keeps the default Plan rail.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.38.1: Strategize index and steps, one app bar tooltip</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>ws_app_bar()</code> drew two tooltips on every icon-only action.</strong> <code>app-bar.php</code> had gained the platform <code>data-tooltip</code> (opening downward) without losing its own <code>.ws-app-bar__tip</code> span, so both fired on hover in every engine, the span behind and up-left of the pseudo-element. The span and its CSS in <code>components.css</code> are removed; the platform tooltip, with its Esc dismissal, is the one that stays. Every app bar is affected, not only Strategize.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The Strategize toolbar canon is four slots.</strong> <code>reload</code> is removed from <code>phase-toolbars.php</code> and from the shell's call site, along with the <code>$strategizeStateId</code> it was the last reader of. The dock demo's first slot now wears the canon's <code>assignment</code> glyph; it had kept <code>autorenew</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Strategize index and steps.</strong> <code>appStrategizeQueue()</code> is index-only and renders the whole queue; <code>.st-newcase</code> (the "+" tile) and <code>.st-hero--boxed</code> are retired from <code>app-shell.css</code> and the JSON, and the index hero and the sentence hero both drop their 48 top padding under the trail. <code>appStrategizeCrumbs()</code> with no argument is the index's two-item trail. The sentence step's headline (<code>.st-page--workbench .st-hero__title</code>) wears the Display Text Pattern like <code>.st-tools__title</code>: upright bold, then <code>em</code> in bold italic <code>--mainsite-dark</code> on an inset 8px <code>--mainsite-light</code> underline; the shell's section heroes keep the upright red second line. <code>appShellRail()</code> takes <code>'newWorkshop' =&gt; 'index' | 'steps'</code>: the button on every Strategize rail, and on a step the naming dialog without a second copy of <code>storage.js</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>One edge for the rail's promo cards.</strong> <code>.app-rail--strategize .app-rail__academy</code> and <code>.app-rail__cards</code> no longer take <code>--phase-learn-very-light</code> as their border; all three keep the card rule (<code>--card-border</code>, 1px <code>#E7E5E4</code>), as Tips always did. In Figma, the three variants of <code>rail-cta</code> (Canvas Design System, set <code>141:516</code>) have their stroke bound to <code>color/gray/200</code>; Academy and Intervention Cards were bound to <code>color/brand/red-very-light</code>. The library needs publishing for the screen frames in the synthesize file to pick it up.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>ws_breadcrumb()</code> items take <code>target</code></strong> (<code>_top</code>, <code>_parent</code>, <code>_blank</code>, <code>_self</code>; <code>_blank</code> adds <code>rel="noopener"</code>), for a trail inside an iframe whose links have to leave it. The embedded planner uses it for <code>.agenda-crumbs</code> (Home / Plan / Build your agenda, first in <code>.agenda-main</code>, 13 on 16 with slash separators like <code>.st-crumbs--shell</code>), styled in <code>css/planner/layouts/_planner.css</code>; the bundle's <code>?v=</code> stamps for that sheet and for <code>components.css</code> are bumped to <code>20260918a</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The embedded planner is on the page grid and the paper.</strong> <code>--embedded-rail</code> (<code>_sidebar.css</code>) is two of <code>.app-page</code>'s eight columns at any width: <code>calc((min(100vw - 96px, 1244px) - 140px) / 4 + 20px)</code>, 296 at 1440 and wider, 231 at 1180; it applies from 1025 up, under which the planner's own compact palette and drawer are unchanged. <code>.embedded-mode .agenda-main</code> takes <code>padding-right: max(48px, 100vw - 1292px)</code>, so the canvas is six columns and stops at the 1244 cap. Both columns drop their opaque <code>gray-50</code> (the palette from 769 up only, where it is not a drawer), so the body's <code>--paper-grid-image</code> shows. Standalone <code>/planner/</code> is untouched.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>.sidebar-custom-activity-section</code> takes a 1px <code>--planner-red</code> border</strong> and its button reads Custom Activity, with <code>aria-label="Create custom activity"</code> so the accessible name keeps the verb and still contains the visible label. In Figma, <code>plan-custom-activity</code> (<code>160:1102</code>) gained the outer card it had never drawn (white, 16 pad, radius 8, stroke bound to <code>color/brand/red</code>) and the new label.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>.fac-script-empty--break</code></strong> (<code>facilitator.css</code>): the console's guidance card for a break, a solid-edged variant of the dashed empty state with a Fraunces title. <code>facilitatorBreakNote()</code> in <code>facilitator/js/modules/scripts.js</code> (<code>?v=9</code>, both shells) picks the line by the break's name, falls back by keyword only for items typed as a break, and leaves every other item's "No script" message alone.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The planner's three pick menus are one pattern</strong> (<code>css/planner/components/_exercise-builder.css</code>, appended block; stamp <code>20260919a</code>): <code>.icebreaker-swap-menu</code>, <code>.exercise-swap-menu</code> and <code>.break-suggestion__menu</code> share <code>--pick-tint</code>, <code>--pick-edge</code> and <code>--pick-ink</code> per activity type, a Fraunces title bar (the break menu's drawn by <code>::before</code>, since script fills it with rows only), rows as 1px-edged cards in Inter at <code>--text-ui</code> (they had been <code>--text-h3</code> in the UA button font), and the count or duration as a tabular-figure pill at the right. <code>.break-suggestion:has(.is-open)</code> lifts to <code>--planner-z-dropdown</code> and pauses <code>breakPulse</code>, which had been fading the open menu to 0.85.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>ws_header()</code> draws one brand mark, <code>graph_3</code>, on every section.</strong> <code>.wsh-header__mark</code> no longer reads the section's <code>icon</code> key, which stays in the registry. <code>header.php</code> is one of the header trio, so it deploys with <code>helpers.php</code> and the merged <code>components.css</code>.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>ws_app_bar()</code> takes <code>centerActions</code>:</strong> actions in the same shape as <code>actions</code>, drawn in the centre of the bar when no raw <code>center</code> is passed. The shell's live console (<code>app/views/facilitate/run.php</code>) uses it for play and stop, and its trail is now the shared cluster: settings (<code>open-options</code>), save (<code>save-session</code>), delete (<code>discard-session</code>) and the arrow. The three handlers live in <code>facilitator/js/facilitator.js</code> (<code>?v=25</code>) and call what the console already does; <code>discardSession()</code> deliberately skips <code>end_live</code>, so a discarded run is not marked delivered, and deletes nothing on the server. <code>#overlay-options</code> reuses the confirm card with <code>.options-card__list</code> (<code>facilitator.css</code>).</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>appShellCrumbs()</code> and <code>.app-crumbs</code></strong> (<code>app/includes/rail.php</code>, <code>app-shell.css</code>): the shell's trail for any page, Home plus the items passed, sharing every rule <code>.st-crumbs--shell</code> wears; <code>.app-crumbs + .app-hero</code> drops the hero's 48 top padding. Facilitate's index is the first caller, and it joins Plan's in <code>$barlessIndex</code>: no <code>ws_app_bar()</code> on either.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>appRailWaitingCard($rows, $stage)</code> serves Plan as well as Synthesize.</strong> <code>appRailJourneySignals()</code> gains <code>plan_list</code> (the rows at the Plan stage); with <code>'plan'</code> the card is titled "Waiting for an agenda" and its rows open the builder. <code>appShellRail()</code> takes <code>'profile' =&gt; true</code> for the DNA card on a view that leaves it out by default. Plan's index passes it with <code>'promos' =&gt; ['tips', 'cards']</code>, so its rail is DNA card, waiting card, film, Tips, Intervention Cards; Saved agendas keeps the default. Plan's index also calls <code>appShellCrumbs()</code>.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>ws_wl_see_all()</code></strong> (<code>app/includes/workshop-list.php</code>): the See All Workshops button under a phase index's queue, secondary, in <code>.app-see-all</code> (renamed from <code>.st-queue__all</code>, same px sizing). Strategize, Plan and Facilitate call it; Plan's and Facilitate's listings drop their ghost <code>footer</code> link. The shell also stops rendering <code>ws_app_bar()</code> on Plan's index (<code>$planIndex</code> in <code>app/index.php</code>).</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The schedule panel's duration pill is white.</strong> A leftover <code>#calendarDurationText</code> rule in <code>css/planner/components/_modals.css</code> (600, <code>--planner-gray-900</code>, from the retired calendar modal) outranked <code>.schedule-panel__meta-pill</code> by targeting the id. The rule is removed; the pill now matches its two siblings in colour and weight.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The Strategist bundle's <code>?v=</code> follows its newest file.</strong> Both shells versioned all eight scripts off <code>strategist.js</code>'s mtime, so a fix to a module alone shipped behind the old query string.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Pitch, practice and check read trail, title, sentence card, panel.</strong> The three views call <code>appStrategizeCrumbs()</code>, their <code>.st-tools__head</code> and then <code>st_recap_card()</code> directly; <code>appStrategizeSubhead()</code>, which wrapped the trail and the card in <code>.st-subhead</code> above the title, is removed along with the shell's two <code>.st-subhead</code> rules and <code>.st-tools__head--tight</code>. In <code>app/css/app-shell.css</code>, under <code>.st-page--tool</code>: the head's margin is <code>0 0 var(--space-6)</code>, <code>.st-recap</code> carries <code>var(--space-6)</code> below it, and <code>.st-split .st-panel</code> drops its 16 top margin, which a grid item cannot collapse. Measured at 1440: trail 144, title 184, card 252, panel 338 on all three. The kit and the standalone Strategist are untouched. <code>tests/E2E/app-strategize.spec.js</code> pins the three 24s per step.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.38.0: Strategize, rebuilt from its Figma frames</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>app/includes/strategize.php</code></strong>: what the shell adds around the Strategist's own markup, which still serves the standalone app untouched. <code>appStrategizeCrumbs()</code> (Home / Strategize / step through <code>ws_breadcrumb()</code>, deliberately not <code>.st-crumbs</code>: <code>bindNav()</code> stamps the open sentence's <code>?id=</code> onto every link in that class, and stamped, Strategize became a link to the sentence), <code>appStrategizeQueue()</code> (the section's workshops through <code>ws_workshop_list()</code>: two rows and the plus tile, primary buttons, heading from <code>ws_wl_phase_title('strategize')</code>), <code>appStrategizeRail()</code> (the promo pair each frame draws) and <code>appStrategizeNewCaseModal()</code>.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>strategize/home.php</code>, and <code>?view=strategize</code> opens it.</strong> <code>$strategizeSteps</code> leads with <code>home</code>; a URL carrying <code>id</code>, <code>plan</code> or <code>objection</code> with no <code>step</code> still means the sentence. The picker renders no document bar, no dock and no Strategist bundle, because there is no open sentence for any of them to act on. Hero: <code>.st-hero--boxed</code>, the library's <code>app-hero</code> card (white, 48 all round, 268 tall with the lede at 1.6).</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>The naming dialog, on the design system's modal pattern:</strong> <code>ws_modal()</code> in the <code>branded</code> variant the shell's other dialogs wear, one <code>ws_form_row()</code> with a helper that becomes the error after blur and says how to fix it, and <code>ws_modal_footer()</code> with Go directly to Plan (secondary, left), Cancel and the primary. <code>app/js/strategize-queue.js</code> writes a fresh <code>StStorage</code> state with <code>workshopName</code> and <code>nameTouched</code> and opens the sentence on its <code>?id=</code>: localStorage only, no server write. <code>?new=1</code> opens it on arrival and is stripped from the URL. The tile is a <code>ws_card()</code> link to that URL, so it works without script.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Two additive options on <code>ws_workshop_list()</code>:</strong> <code>cta['variant']</code> sets every card's button, and <code>gridAppend</code> adds one tile to the end of the grid and renders the grid in place of the empty state. Both default off; no other caller moved.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The Strategize rail, scoped by a new <code>.app-rail--{view}</code> modifier on the aside.</strong> <code>appRailJourneyCard($counts, true)</code> is the compact checklist (title, a line, the rows; no button and no badges), which is what let it back onto a view it was kept off because its button outranked the page's primary. <code>'promos'</code> names the promo cards in order; <code>appRailAcademyCard()</code> is the third, its art exported from the library component with its shadows. Sizes are the frames' in literal px (20 / 12, a 14 checkbox, cards at 221 / 258 / 311 / 330), because the library redrew these larger than the shared rail paints them and the shell's 70% root has no token that lands on them; the other views keep their pinned sizes until the redraw is rolled out.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Measured against the frames at 1440:</strong> sentence, kit, pitch and practice match on every anchor (trail 144, sentence card 184 or 219 under the kit's save pill, exit strip, queue heading, grid) and down the whole rail (192 / 292 / 529 / 645 / 919 or 991). <code>tests/E2E/app-strategize.spec.js</code> pins the picker, the rail order and sizes per step, the trail, the naming flow with a no-server-writes assertion, and <code>?new=1</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Home's rail has one shortcut, New workshop</strong> (primary, <code>data-st-newcase</code>), and <code>appShellRail()</code> renders the naming dialog on Home so it opens in place; its href is the same dialog on the picker for when script is off. In the dialog's footer, Cancel and the primary share a line, a divider follows, and under it Go directly to Plan runs the full width of the dialog's content on <code>--phase-learn-very-light</code>. <code>ws_modal_footer()</code> is a padded flex row written for a footer outside a padded body; here it sits inside the form, so this dialog drops its side padding, replaces the row with one full-width grid track and removes the left group's auto margin, which in a grid would outrank the stretch. Bill's calls, 18 Sep; the comment in <code>rail.php</code> records the trade against the quieter buttons it replaced.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.37.4: the app screens in Figma are layers, not pictures</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Fourteen frames in App &mdash; Screens rebuilt as native, editable layers.</strong> The five Strategize steps, Library, Plan saved / check / build, Facilitate run, Synthesize make, Settings, My Stuff and Contribute were rectangles filled with a screenshot. Each is now the live page walked node by node (<code>~/.claude/tools/figbuild</code>: <code>extract.mjs</code> &rarr; <code>compile.mjs</code> &rarr; <code>preview.mjs</code> &rarr; <code>builder.js</code> fetched by the plugin from port 80): real text in Fraunces, Inter and Material Symbols, vector icons, frames with their fills, strokes and radii, the document bar and the dock, all signed in with real data and every write request swallowed by the extractor. No missing fonts, no builder warnings. The six frames drawn from library instances (home and the four phase pickers, plus the Prove report) were already editable and are unchanged.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The side-nav highlight is right on every frame.</strong> All twenty had inherited the layout template's Strategize highlight. Home, Plan, Facilitate, Synthesize and Strategize light their own item; Settings, My Stuff, Library and Prove light none, which is what the live shell does.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.37.3: the rest of Plan and Facilitate in Figma</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>In Figma:</strong> <code>App / plan / saved</code>, <code>App / plan / check</code> and <code>App / facilitate / run</code> in App &mdash; Screens, completing both phases beside the existing <code>plan / home</code>, <code>plan / build</code> and <code>facilitate / home</code>. Saved agendas is a signed-in 1244 capture of the page grid (three 296 cards a row beside the Plan rail); the check and the console's ready-to-facilitate state are full-bleed 1340 region captures. All three were taken with every non-GET request aborted (<code>~/.claude/tools/figbuild/cap-readonly.mjs</code>), so a capture cannot write to the database the local <code>.env</code> points at. The console's live state is not drawn: starting a session writes one.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.37.2: what the review of the grid rebuild found</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The shell's Synthesize grid rules are guarded by <code>@media (min-width: 1081px)</code>.</strong> <code>synthesize.css</code> collapses <code>.sy-intake</code> and <code>.ws-shell</code> to one column inside <code>max-width: 1080px</code>, and a media query adds no specificity: <code>.app-shell .synth .sy-intake</code> carries one more class than the selector in that block, so unguarded it won at every width and the collapse could never happen between 900 and 1080. <code>app-tool-rails.spec.js</code> now loads the intake at 1000 wide and asserts one track.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>.app-rail__lead</code>, and the rail's type step moved off the rail itself.</strong> <code>appShellRail()</code> wraps a view's <code>'lead'</code> in <code>&lt;div class="app-rail__lead"&gt;</code>, and the seven stepped-down <code>--text-*</code> tokens are declared on <code>.app-rail &gt; :not(.app-rail__lead)</code> instead of <code>.app-rail</code>, because a custom property set on a parent cannot be un-set for one child. The Settings account summary and the Contribute preview are page content written against the platform scale; stepped down with the rail's own cards their captions painted at 7.7px. They are back at 8.4 / 12.6, and the rail's pinned sizes (9.8 / 12.6 / 9.1) did not move.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>app/js/settings.js</code> binds section links document-wide.</strong> The aside's <code>[data-settings-section]</code> link renders in the rail now, outside <code>.app-settings</code>, so the root-scoped listener missed it and the click became a page load. <code>switchSection()</code> stays root-scoped, so only nav items take <code>is-active</code>. <code>app-settings.spec.js</code> clicks it and checks a marker on <code>window</code> survives.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>prove/report.php</code>'s not-found branch opens the page grid</strong> and renders the rail before its early <code>return</code>, which fired above the wrapper the batch-5 change added. Not browser-verified: Prove is switched off locally.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> A dead <code>max-width: 900px</code> block in <code>settings.css</code> that un-stuck an aside which no longer sticks is gone, and <code>app-grid.spec.js</code> measures all six My Stuff steps (twenty routes), so the open-in-<code>_chrome.php</code>, close-in-<code>index.php</code> split is exercised on every path.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.37.1: the grid, measured signed in</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>ws_choice_cards()</code> inside the page grid takes the grid's gutter.</strong> The component ships <code>--ws-choice-gap: var(--space-4)</code>, which put three cards at 299 across a 928 main, 3px off the 296 columns <code>.wl-grid</code> lands on below them. <code>.app-page__main .ws-choice-cards { --ws-choice-gap: var(--app-grid-gutter) }</code> in <code>app-shell.css</code>; <code>components.css</code> is untouched because the gap was already a custom property. Found by the first signed-in measurement once the database was reachable again.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>app-rail.spec.js</code> pins its viewport to 1440 &times; 900.</strong> The DNA card now fills a rail that is two columns of a fluid grid, so its width follows the viewport (296 at 1440, 256 at 1280); the old fixed 280 card never needed one. The pixel pins are the 1440 ones, so the viewport is part of the assertion.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Signed-in verification of the whole rebuild:</strong> <code>app-grid</code> (16 route cases), <code>app-rail</code> (5), <code>app-settings</code> and <code>app-tool-rails</code> (3) all pass, and the Settings, My Stuff and Contribute frames in Figma are live 1244 captures instead of drawn placeholders. The Prove report frame stays a placeholder while <code>PROVE_ENABLED</code> is off locally.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.37.0: the in-tool left rails join the grid</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The embedded Planner palette is on the page grid.</strong> <code>.embedded-mode .activity-sidebar</code> (<code>css/planner/components/_sidebar.css</code>) is <code>calc(var(--space-12) + var(--app-rail))</code> wide with the 48 as left padding and no right border, and <code>.embedded-mode .agenda-main</code> (<code>layouts/_planner.css</code>) starts one <code>--app-grid-gutter</code> later, so the canvas begins on the third grid line (364). <code>body.embedded-mode</code> is what <code>planner.php?embedded=1</code> already set; standalone <code>/planner/</code> keeps its bordered 320 column through <code>--planner-sidebar-width</code>. Both import stamps in <code>planner-new.css</code> bumped to <code>20260917a</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Synthesize's two material rails are on it too.</strong> In the ported-sections block of <code>app-shell.css</code>: <code>.app-shell .synth .sy-intake</code> is <code>minmax(0, 1fr) var(--app-rail)</code> at <code>--app-grid-gutter</code> inside 48px insets (928 + 20 + 296, the artifacts rail on the right like every page rail, where standalone draws 1fr + 340), and <code>.app-shell .synth .ws-shell</code> is <code>var(--app-rail) minmax(0, 1fr)</code> at the same gap and insets with no 1240 cap and no centring (the sources rail on the left, surface from 364). <code>synthesize.css</code> is untouched and keeps serving the standalone app; its <code>.sy-app</code> rule turned out to have no caller since the August intake rewrite.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>tests/E2E/app-tool-rails.spec.js</code></strong> reads both geometries back: the palette at x 0 and 344 wide inside <code>#appPlannerFrame</code> with the canvas at 344 and a 20 left pad, and the intake's tracks 928 + 296 at a 20 gap from x 48 with the artifacts rail at x 996, and (when a local text route opens it) the workspace's first track 296 at x 48. The three standalone projects (<code>planner</code>, <code>synthesize</code>, <code>components</code>) are the control.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>In Figma:</strong> <code>App / plan / build</code> and <code>App / synthesize / make</code> in App &mdash; Screens, the full-bleed region captured live at 1340 with the palette on columns one and two.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.36.0: the reading measure and .app-cols retire</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>prove/report.php</code> and the handoff sheet open <code>.app-page</code>.</strong> The report keeps a document measure inside the main, <code>.prv-report { max-width: 770px; margin: 0 }</code>: five grid columns, left-aligned on the first grid line, where the old 720 was off-grid and centred 104px in (the print override still lifts the cap). The <code>else</code> branch in <code>app/index.php</code> wraps <code>.app-shell__sheet</code> and renders <code>appShellRail(&hellip;, $view)</code>, so Library has the rail; signed out that is the Tips card alone.</li>
            <li><span class="changelog-tag changelog-tag--breaking">Removed</span> <strong><code>$wideContent</code>, <code>.app-shell__content--wide</code>, <code>.app-cols</code>, <code>.app-cols__main</code>, <code>.app-cols--aside</code></strong> and their 1100px collapse rules. <code>.app-shell__content</code> caps at <code>calc(var(--app-content-wide) + var(--space-12) * 2)</code> (1340, the region at 1440) for every non-bleed view, because every one of them opens <code>.app-page</code> and the six-column main is the measure. The twenty lines of comments that argued each view into the wide set went with the flag.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Docs:</strong> <code>app-shell-layouts.php</code> describes three archetypes (full bleed, page grid, handoff sheet on the page grid) instead of four, and the grid table lost its two retiring rows; <code>workshopr-design-system.json</code> <code>layout.appShell</code> drops <code>readingMeasure</code>, rewrites <code>wide</code> as the only column, and its class inventory no longer lists <code>app-cols</code>.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>app-grid.spec.js</code></strong> adds the library route; fifteen routes in all, every non-bleed view but the report (which needs a plan id).</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>In Figma:</strong> <code>App / prove / report</code> and <code>App / library</code> in App &mdash; Screens: the report as a 770 document block on the first five columns of the main (a placeholder, since the report is signed-in only and the database was down), the library as the live signed-out sheet captured at 928 with the Tips-only rail.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.35.0: My Stuff and Settings on the page grid</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>My Stuff opens <code>.app-page</code> in <code>stuff/_chrome.php</code> and closes it in <code>app/index.php</code></strong> after the step require, rendering <code>appShellRail(&hellip;, 'stuff', ['lead' =&gt; $stuffRailLead ?? ''])</code>; the six step files stay rail-agnostic. <strong>Contribute</strong> renders its preview aside into <code>$stuffRailLead</code> (an <code>ob_start()</code> block above the form) instead of a 320 column: <code>.app-contribute__layout</code> is now <code>.app-grid-6</code> with the form on <code>.app-span-4</code> (612, two 296 cards across), and <code>stuff-contribute.css</code> loses the 1120 cap, its own split and the aside's sticky rule (the rail is the sticky element).</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Settings wraps itself in <code>.app-page</code> and hands its account summary to the rail</strong> as the lead, with <code>'journey' =&gt; false</code>. <code>.app-settings__layout</code> is two tracks inside the 928 main, <code>minmax(0, 240px) minmax(0, 1fr)</code> at a 40 gap, so the panel is 648 and <code>.app-settings__grid-2</code> still lands two fields of about 300; the aside's own sticky rule and the 300 third track are gone.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Nested spans reset at 1100px.</strong> <code>.app-span-3/-4/-6</code> go full-row where the nested grids drop to three and two tracks, for the same reason the page spans already did: <code>span 4</code> on three tracks creates an implicit column.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>tests/E2E/app-settings.spec.js</code></strong> pins the settings shape (tracks 240 + 648, main 928, rail 296, the aside inside the rail and no journey card) behind a <code>?section=subscription</code> deep link; <code>app-grid.spec.js</code> adds settings, stuff/favorites and stuff/contribute, fourteen routes in all.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>In Figma:</strong> <code>App / settings</code>, <code>App / stuff</code> (favorites) and <code>App / stuff / contribute</code> in App &mdash; Screens, drawn from components and labelled blocks on the grid (240 + 648 nav and panel, 612 form with 296 cards, 296 rail with the lead card first) because both views are signed-in only and the database was unreachable for a live capture; swap in captures when it is back.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.34.0: the Strategize tools gain the rail</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>strategize/kit.php</code>, <code>pitch.php</code>, <code>practice.php</code> and <code>check.php</code> open <code>.app-page</code> inside <code>#stApp</code></strong> and render <code>appShellRail(&hellip;, 'strategize')</code>, the first views to gain a rail rather than swap one. <code>#stApp</code> and the announcer stay outermost (the JS contract); <code>$wideContent</code> now covers every Strategize step. <code>strategist.css</code> is untouched: <code>.st-split</code> at 5fr/6fr lands 413 + 495 inside 928, and the frame shows the date and cost fields still side by side at that width, so the split stays.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>app-grid.spec.js</code></strong> measures the four steps beside the sentence, eleven routes in all.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>In Figma:</strong> <code>App / strategize / kit</code>, <code>/ pitch</code>, <code>/ practice</code> and <code>/ check</code> in App &mdash; Screens, each the standalone tool page captured at 928 (<code>~/.claude/tools/figbuild/cap-st-tool.mjs</code>) under no hero, with the Strategize rail beside it; the pitch frame is 1152 tall to hold the whole split.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.33.0: the last four .app-cols pages move</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>facilitate/home.php</code>, <code>synthesize/home.php</code>, <code>prove/home.php</code> and <code>strategize/sentence.php</code> open <code>.app-page</code>.</strong> A wrapper swap and nothing else: each view keeps its own <code>&lt;main&gt;</code>, hero and listing, and Synthesize's static <code>.synth-rail</code> commit bar stays inside the main column. With these, <code>.app-cols</code> has no caller under <code>/app/</code>; the rules stay in <code>app-shell.css</code> until batch 5 deletes them with the reading measure.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>app-grid.spec.js</code></strong> measures the four routes beside home and plan, seven in all, with Prove gated on the same feature flag the shell reads (<code>proveEnabled()</code> from <code>tests/helpers/app-routes.js</code>).</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>In Figma:</strong> <code>App / facilitate / home</code>, <code>App / synthesize / home</code>, <code>App / prove / home</code> and <code>App / strategize / sentence</code> in App &mdash; Screens, each a copy of the Plan frame re-filled per view: the compact <code>app-hero</code>, three <code>wl-card</code> at 296, and the rail in <code>rail.php</code>'s order (Facilitate: DNA, checklist, film, Intervention Cards; Synthesize: waiting list, film, Tips; Prove: DNA, checklist, Tips). Prove has no hero, card or film variant of its own yet, so its frame re-texts the Synthesize ones; the Strategize frame carries the live workbench as a 928-wide capture under the Strategize hero.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.32.0: Plan on the page grid</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>app/views/plan/home.php</code> and <code>plan/saved.php</code> open <code>.app-page</code></strong> instead of <code>.app-cols</code>. Plan home is the batch-1 proof of the arithmetic: <code>ws_choice_cards()</code> and <code>.wl-grid</code> both land three 296 cards across the 928 main with nothing but the grid deciding it. Saved agendas gains the rail (<code>appShellRail(&hellip;, 'plan')</code>) and joins the wide set in <code>app/index.php</code>; the wrapper lives in the app view, never in <code>saved-body.php</code>, which the standalone <code>planner/saved.php</code> still renders railless.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The saved body's inline layout is neutralised inside the shell.</strong> <code>.app-shell .saved-workshops-page</code> in the ported-sections block of <code>app-shell.css</code> drops the 1200 cap, the <code>72px auto</code> margin written for the standalone page's fixed header, and the 24px side padding, so the list sits on the grid line under the app hero.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>tests/E2E/app-grid.spec.js</code></strong> now measures <code>/app/?view=plan&amp;step=home</code> and <code>&amp;step=saved</code> beside home: eight tracks of 138, main 928, rail 296 at x 948, and no <code>.app-cols</code> left on the route.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>In Figma:</strong> <code>App / plan / home</code> in the App &mdash; Screens section of the templates page, a copy of the <code>App / home</code> frame with the compact <code>app-hero</code> (Surface=Plan), three <code>plan-choice-card</code> at 296, <code>plan-nudge</code>, three <code>wl-card</code> (stage=Plan), and <code>rail-todos</code>, <code>rail-film</code> (view=Plan) and the Daily Tips <code>rail-cta</code> down the rail, in the order <code>rail.php</code> renders them for Plan.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.31.0: one page grid for /app/</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>.app-page</code>, the page grid every non-bleed <code>/app/</code> view will sit on.</strong> Eight columns of <code>--app-grid-col</code> (138px) with <code>--app-grid-gutter</code> (20px) between them, 8&nbsp;&times;&nbsp;138 + 7&nbsp;&times;&nbsp;20 = <code>--app-content-wide</code> (1244), the content column at 1440. <code>.app-page__main</code> spans six (928) and the rail spans two (<code>--app-rail</code>, 296); <code>.app-page--rail-left</code> puts the rail first. The rail is the same <code>&lt;aside class="app-rail"&gt;</code> <code>appShellRail()</code> has always rendered, so a view moves by changing its wrapper, not its rail. <code>app/css/app-shell.css</code>, replacing the September grid block.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Nested grids that close on the page columns:</strong> <code>.app-grid-6</code>, <code>-3</code> and <code>-2</code> inside a 928 main (138 / 296 / 454), <code>.app-grid-4</code> and <code>-2</code> at the full width (296 / 612), and <code>.app-span-2/-3/-4/-6/-full</code>. The two that do not close (<code>-4</code> inside a main at 217, <code>-3</code> at the full width) are documented as off-grid on <code>app-shell-layouts.php</code> rather than offered. <code>.wl-grid</code> inside a 928 main lands on 296 by itself.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Four tokens under APP SHELL METRICS:</strong> <code>--app-grid-col</code>, <code>--app-grid-gutter</code>, <code>--app-content-wide</code>, <code>--app-rail</code>. Literal px, because the DTCG export and <code>tests/header-shell.spec.js</code> read them as strings. <code>--app-rail-width</code> stays at 320: the Facilitator console, the standalone Planner palette and Synthesize intake read it, and none of them are on this grid.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>tests/E2E/app-grid.spec.js</code></strong> reads the used track sizes back from the browser on a public wide route: eight tracks of 138, grid 1244, main 928, rail 296 at 1440, and the rail dropping under the main column at 1100. It carries the list of migrated routes and asserts none of them still open <code>.app-cols</code>. <code>header-shell.spec.js</code> asserts the four new tokens beside the existing 320 pin.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>.app-cols</code> and <code>.app-cols--aside</code> marked retiring</strong> in <code>app-shell-layouts.php</code> and the JSON mirror. They stay, unchanged, until the last view has moved: migration is one view at a time against an approved Figma frame, and retuning the old split in place would move six pages in one commit with nothing to approve. The dead sub-900 grid step went with the rewrite; the shell replaces itself with the mobile notice there.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>app/index.php</code> loaded <code>qr-creator.min.js</code> without a cache-bust, the one page-gate failure standing in the shell, and the reason the check-page hook blocked every edit to that file.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Home is the first screen on the grid.</strong> Both branches of <code>app/views/home.php</code> open <code>.app-page</code>: the dashboard as before, and the first-run checklist, which had no rail at all, now carries one minus its journey card, because the main column <em>is</em> the checklist there. <code>appShellRail()</code> gained <code>$opts</code> for exactly that: <code>'journey' =&gt; false</code>, and <code>'lead' =&gt; $html</code> for the settings and contribute rails to come. Default behaviour unchanged, so no other caller moved.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The DNA card takes the rail.</strong> It was drawn at 280 and right-aligned inside the 320 rail, which left its left edge 16px off the first column; at two columns it is 296 wide, matching the design file's <code>rail-dna</code>. <code>app-rail.spec.js</code> re-pins the card to 296&nbsp;&times;&nbsp;80 and the pill to 266&nbsp;&times;&nbsp;50; the font-size pins are the rail's own type scale and did not move.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>In Figma:</strong> <code>App / Template / 7 &hellip; / no bar</code> (content from y 24, for the views that render no document bar) and the first screen frame, <code>App / home</code>, a detached copy of it filled with instances of <code>app-hero</code>, <code>dash-hero</code>, three <code>wl-card</code> at 296 across the 928 main, and <code>rail-dna</code>, <code>rail-todos</code>, <code>rail-film</code> and both <code>rail-cta</code> cards down the 296 rail, in the order <code>rail.php</code> renders them for home.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.30.0: what /app/ is actually built from</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>app-screen-components.php</code>.</strong> Home (238 named nodes, 66 distinct classes) and the plan builder (203 / 67) inventoried from signed-in captures. The good news first: <strong>all 66 <code>helpers.php</code> functions are already registered</strong> in the JSON, so nothing on either screen that belongs to the design system is missing from it.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>externalComponents</code> in <code>workshopr-design-system.json</code></strong> names the three families that are not: <strong>workshopList</strong> (24 <code>ws_wl_*</code> functions, 32KB of CSS, <strong>12 <code>.wl-card</code> instances on home</strong> and the most repeated card on the platform), <strong>dashboardAndRail</strong>, and <strong>planner</strong> (the largest surface and the only one with <em>zero</em> helper functions). Deliberately NOT added to <code>components</code>: check 1b requires every key there to resolve to a <code>helpers.php</code> function. <code>check-drift</code> has warned about the first family all along; this is the inventory step it asks for.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Five of them now exist in the Figma library</strong> (Canvas Design Sysetm › 🧩 Components › &sect; App screens): <code>wl-card</code> as a four-stage variant set, <code>agenda-item</code> as a four-type variant set, plus <code>wl-stage</code>, <code>item-duration-badge</code> and <code>category-btn</code>. Geometry and colour taken from the captures: the card ships at <strong>284&times;175</strong>, which is exactly what <code>.wl-grid</code> yields in the current 892px main column. <strong>Resized to 296&times;197 on request</strong>, 296 being one column of <code>.app-grid-4</code>, so the component now presupposes the four-column layout rather than the shipped one.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>dash-hero</code>, the red band on home.</strong> 892&times;146 as shipped, spanning the full main column of <code>.app-cols</code>. Rebuilt from the capture rather than by eye: two background layers (<code>linear-gradient(135deg, #E54D4D, #7F1D1D)</code> under a radial white highlight), two decorative 10%-white shapes, the larger of which overflows the top edge so the frame has to clip. Its ghost button measures 46 tall against the solid one's 42 because of a 2px border on a shared 42px content box.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>card-296</code>, a proposed single card in four variants:</strong> library (category icon / title / time / category pill / favourite / share), agenda (checkbox / phase pill / title / time / item count / action), cta, todo. Fixed 296&times;197. Nothing ships on it: 296 is one column of <code>.app-grid-4</code>, so it presupposes the four-column layout, and 197 is a fixed height that still needs a truncation rule per text slot.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Red Unification verified rather than assumed:</strong> all 12 stage pills on home are <code>#FEE2E2</code> on <code>#C73E3E</code> whatever the stage, so <code>wl-stage</code> needs no colour variants. The agenda row does keep its four type colours, which DESIGN.md sanctions as the exception.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.29.1: the layout specs get measured against the app</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The <code>ws-app-bar</code> Figma component was 72 tall; the shipped bar is 60.</strong> Measured on <code>/app/?view=synthesize&amp;step=home</code> at 1440: <code>.ws-app-bar</code> is 1340&nbsp;&times;&nbsp;60, matching <code>--app-bar-height</code>. All four variants resized, and because the actions cluster was a fixed-height auto-layout and the title carried a <code>MIN</code> vertical constraint, neither recentred on its own and both had to be re-seated. The content slot moves from y&nbsp;96 to y&nbsp;84 in every template that wears a bar.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The handoff sheet was drawn with a document bar. It has none.</strong> <code>app/index.php</code> renders the bar only for <code>plan</code>, <code>facilitate</code>, <code>synthesize</code> and <code>prove</code>; <code>/app/?view=library</code> returns no <code>.ws-app-bar</code> at all, and its <code>.app-shell__sheet</code> sits at y&nbsp;84 on the page, which is 24px inside a region that starts at 60. Bar removed and the slot moved to y&nbsp;24 in both Figma files and in the docs.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The reading measure went back to 1131.</strong> It had been widened to 1244 so every template shared one content width; the app renders 1131 (<code>.app-shell__sheet</code> measured at exactly that, inside a <code>.app-shell__content</code> capped at 1227). The templates were reverted rather than the CSS widened, because the cap exists to keep prose and forms off a 1400px line.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>app-shell-layouts.php</code> drops its &ldquo;Known divergences&rdquo; section</strong> for one that records what was measured and what was corrected. <code>layout.appShell</code> in the JSON loses <code>divergences</code> and gains <code>resolved</code>, <code>barRendersFor</code> and per-archetype slot origins.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.29.0: the app shell gets a layout system</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>app-shell-layouts.php</code>, the <code>/app/</code> layout system.</strong> The shell is config-driven: every view declares label, icon, header, eyebrow, title and lede, and two flags in <code>app/index.php</code> (<code>$fullBleed</code>, <code>$wideContent</code>) pick the frame. That yields four archetypes, not twenty-six layouts. Full bleed puts the slot at x&nbsp;0 w&nbsp;1340 with no footer; wide is x&nbsp;48 w&nbsp;1244; the reading measure is x&nbsp;48 w&nbsp;1131 (<code>max-width: calc(1131px + 48px * 2)</code>); the handoff sheet is a reading measure holding <code>.app-shell__sheet</code>. Chrome is constant at header&nbsp;60, rail&nbsp;100, main&nbsp;1340, bar&nbsp;60, footer&nbsp;48. All measured from the live DOM at 1440 and cross-checked against <code>app/css/app-shell.css</code>. Mirrored into <code>workshopr-design-system.json</code> under <code>layout.appShell</code>, beside the existing <code>layout.containers</code>, which describes the main site and never applied here.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>.app-cols--aside</code>, <code>.app-grid-4</code> and <code>.app-grid-8</code></strong> in <code>app/css/app-shell.css</code>, beside <code>.app-cols</code>. They go there rather than in <code>includes/components/components.css</code> for two reasons: the family they join is already there, and that file is a standing deploy hazard. At the wide column's 1244 the arithmetic is exact: <code>.app-cols</code> 892&nbsp;+&nbsp;32&nbsp;+&nbsp;320, <code>.app-cols--aside</code> 320&nbsp;+&nbsp;24&nbsp;+&nbsp;900, <code>.app-grid-4</code> 296&nbsp;&times;4, <code>.app-grid-8</code> 138&nbsp;&times;8. Eight subdivides four exactly (138&nbsp;+&nbsp;20&nbsp;+&nbsp;138&nbsp;=&nbsp;296), so a span of two aligns with one of four; that holds only while both keep the 20px gap. Both grids halve at 1100px and again at 900px rather than dropping to one column, so a span keeps meaning the same fraction of the row.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>.app-grid-8</code> is documented as a spanning grid, not a card grid.</strong> 138px is barely half the 260px floor <code>.wl-grid</code> enforces, and that floor exists because an uncapped <code>repeat(3, 1fr)</code> once drew 214px cards. Neither new grid has a caller yet: <code>.wl-grid</code> still caps at three on purpose, so reach for these when a design asks, not by default.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>page-templates.php</code> claimed &ldquo;every page follows one of these templates&rdquo;</strong> while describing only the main-site pattern of <code>includes/header.php</code> plus a <code>.container</code>. Nothing on it applies inside <code>/app/</code>, which has a rail, a document bar, a self-scrolling region and drafting paper. It now scopes itself to the main site and links to the app's own layouts.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Two Figma-versus-code divergences are recorded rather than reconciled in silence.</strong> The reading measure is 1131 in CSS and 1244 in the Figma templates, widened deliberately so every template shares one content width, which leaves a screen designed there 113px wider than it renders. The document bar is 60 in CSS (<code>--app-bar-height</code>) and 72 in the <code>ws-app-bar</code> Figma component, which puts Figma content slots at y&nbsp;96 where the app puts them at y&nbsp;84. Both are listed as open in <code>layout.appShell.divergences</code>.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.28.0: the gates start reporting again</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Four of the five gates were failing on a clean tree</strong> and nothing said so. <code>check-drift</code> still listed <code>ws_lifecycle</code>, retired in v2.9.99, and flagged a card in <code>app/css/app-shell.css</code> setting its own geometry; <code>generate-catalog --check</code> had <code>ws_app_footer(): string</code> against a source that gained <code>array $options = []</code>; <code>tokens.dtcg.json</code> was stale. All fixed &mdash; the curated JSON drops the dead entry, carries the real <code>ws_app_footer</code> signature with its <code>variant</code> and <code>launcher</code> options, and both generated files are current at 66 components and 347 tokens. The audit that found them is <code>AUDIT-2026-09-16-system-audit.md</code>.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>components.generated.json</code> reported a11y coverage of 11/66 against a real 54/66.</strong> The extractor in <code>generate-catalog.php</code> took the first <code>&lt;p&gt;</code> under an Accessibility heading, and most demos document accessibility as a Concern/Behavior table instead, so 43 components' notes were dropped on the floor. It now takes a <code>&lt;p&gt;</code> or a <code>&lt;table&gt;</code>. This mattered more than the number suggests: START-HERE.md sends AI assistants to that file for per-component usage, so every assisted UI change was being made against a catalog claiming accessibility guidance barely existed. The 12 still blank are the 12 with no demo page to read.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>check-page.php</code> is finally wired to something.</strong> Its docblock has always said &ldquo;wired to a PostToolUse hook &hellip; exit 1 = new violations (hook turns this into a 2)&rdquo;; that hook did not exist, so from the day it shipped the checker ran only when someone typed it. <code>.claude/hooks/check-page.mjs</code> is the missing half, and <code>ds-lint.yml</code> gains a <code>ds-pages</code> job. Both check only the files that changed, the way the CSS job does, so the ~4,700 baselined legacy violations stay tolerated while new drift fails. The hook fails open: a bad payload, a missing <code>php</code>, a crashing checker all exit 0, because a broken hook must never block ordinary work. Self-test: <code>node .claude/hooks/check-page.mjs --self-test</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The page checker no longer scans agent working directories.</strong> <code>.scratch/</code>, <code>.superpowers/</code>, <code>.omc/</code> and <code>.impeccable/</code> hold snapshot copies of real pages &mdash; <code>.superpowers/sdd/</code> keeps one per task step &mdash; so their drift was being counted twice, once against the copy and once against the page it came from. Eight of the 47 reported violations were this. Real count: 39, across 26 files, 17 of them never committed.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The plan-check modal's agenda card draws its inset from the card family.</strong> <code>padding: var(--space-2) var(--space-3) var(--space-3)</code> became <code>var(--space-2) var(--card-padding-compact) var(--card-padding-compact)</code> &mdash; same 8px/12px, no visual change, but the sides and floor now move with the card tokens instead of drifting away from them. The tightened top stays deliberate and is commented as such.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>debt-register.md</code> no longer claims the gates are green.</strong> It opened with that line, true when measured on 31 July and untrue since, with no way for a reader to tell. It now carries the one-line command that re-runs all five and says plainly that CI cannot announce a red gate on a branch this far ahead of origin.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.27.0: the phase toolbars</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>ws_phase_toolbar()</code></strong> (<code>includes/components/phase-toolbar.php</code>), the dock a phase always wears. <code>ws_app_dock()</code> was the shape; this is the contents. The canon in <code>includes/components/phase-toolbars.php</code> fixes which slots Strategize, Plan, Facilitate and Synthesize each show, in which order, with which glyph and name, so the same phase carries the same toolbar on every screen of that phase. Demo at <code>components/demos/phase-toolbar.php</code>, full specification at <code>design-system/spec-phase-toolbar.md</code>, DESIGN.md §12.10, and the JSON catalog carries the entry.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The four docks are now four calls that pass only wiring.</strong> <code>app/index.php</code>, <code>planner/planner.php</code>, <code>app/views/facilitate/run.php</code> and <code>app/views/synthesize/make.php</code> each dropped their hand-assembled <code>items</code> array and name slots by key instead. Every rendered attribute is byte-identical to what shipped before: the same ids, hrefs, <code>data-action</code>s, badges and pills, so no handler in <code>planner-v2.js</code>, <code>facilitator.js</code>, <code>synthesize.js</code> or <code>strategist.js</code> changes.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The landmark label defaults to the phase's own name</strong> (Strategize steps, Agenda tools, Session controls, Add material), so no screen can ship the generic &ldquo;App dock&rdquo; fallback by forgetting to replace it. The canon also guarantees every slot has a glyph and a name, which a hand-assembled dock could not: <code>tests/Unit/PhaseToolbarTest.php</code> holds both, along with the rule that the caller's order never changes the toolbar's.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Three sanctioned deviations, and no more:</strong> a screen may drop a slot (<code>'slots' =&gt; ['deck' =&gt; false]</code>), append one only it has (<code>extra</code>), or reword one whose vocabulary it owns. A pill the canon deliberately leaves wordless (Plan's two clock read-outs, Synthesize's source count) is dropped rather than drawn blank when no label arrives. Anything else is a design change, and the place to make it is the canon.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The pattern library lists the shell's three toolbars</strong> under Navigation &amp; Overlays: App Bar, App Dock and Phase Toolbar. The first two had demos but no card, so the only way to find them was to know they existed.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.26.0: the app dock, and the bar settles on four actions</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>ws_app_dock()</code></strong> (<code>includes/components/app-dock.php</code>), the floating toolbar a tool shell wears at the foot of its region: a pill of icon-only slots with an optional labelled pill either side. Material 3's floating toolbar supplies the geometry (a 64px pill, 48px slots, a 40px state layer at 8/12/16%, 24px glyphs); Workshopr supplies every colour, <code>--phase-learn-dark</code> under <code>--text-inverse</code>, lifted by <code>--shadow-sm</code> over <code>--shadow-md</code>. It positions against the nearest positioned ancestor and lets clicks through the gaps between its pills. Demo at <code>components/demos/app-dock.php</code>; the JSON catalog carries the entry.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> A slot <code>badge</code> on <code>ws_app_dock()</code>: a count pinned to the slot's corner, white on the red, for a tool with something waiting behind it. The Facilitator's polls and reactions slots wear it; the app writes the number and shows it with inline display, the same contract its old nav badges had.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> A pill <code>tone</code> on <code>ws_app_dock()</code>: <code>success</code> paints a static read-out <code>--color-success-dark</code>, the one place the dock leaves the red family, and only to report a state (Plan's time-left pill while the agenda fits), never for an action.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Two layout tokens beside <code>--app-bar-height</code>: <code>--app-dock-height</code> (64px) and <code>--app-dock-clearance</code> (96px), the room a shell's scroll region keeps clear while the dock is up.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>DESIGN.md §12.8 names the shared action cluster</strong> every phase bar now wears (home, save, delete, continue), and <strong>§12.9</strong> documents the dock, including the rule that it replaces the rail on the screen it appears on rather than stacking above it. Synthesize wears both on its tool step; the app frame wears the dock for Strategize as a child of <code>.app-shell__body</code>, which is now <code>position: relative</code> and pads the scroll region by the clearance under a <code>has-app-dock</code> class.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The <code>.agenda-gen-6c</code> sequence strip and the <code>.agenda-gen-c</code> step chip are retired</strong> from <code>css/planner/components/_agenda-generative.css</code>: the generator no longer renders either, so the spine, dots, note and chip rules went with them.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>The moment strip and moment rows</strong> in <code>facilitator/css/facilitator.css</code>: <code>.fac-moment-strip</code> is a paper pill that rises above the dock (its foot sits at <code>--app-dock-clearance</code> plus <code>--space-2</code>, one z-index step above <code>--z-sticky</code>) holding a 24px drain ring in <code>--fac-red</code> and four ghost <code>ws_button()</code>s whose 1&ndash;4 key hints are drawn from <code>data-key</code> with <code>::after</code>, because the button template escapes its label. <code>.fac-moment</code> rows sit beside <code>.fac-note</code> in the sidebar and the summary with a tabular-nums session clock and a <code>ws-pill--tint</code> tag. The orphaned <code>.fac-toast</code> rules are gone; the console\'s confirmations come from the shared <code>wsToast()</code>. All motion runs on the platform durations and easings and switches off under <code>prefers-reduced-motion</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The shared bar cluster is three actions, not four:</strong> <code>ws_app_bar()</code>'s own defaults drop the home action, and with it every phase bar and picker bar in the platform. DESIGN.md §12.8 carries the rule: the rail names Home on every screen a bar appears on, so a second route to the dashboard was the one action in the cluster that had nothing to do with the document.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Every <code>ws_modal()</code> with a coloured header had square top corners.</strong> The shell carries <code>--modal-radius</code>, but the header and the body paint their own backgrounds straight into it, so a branded band covered the curve. The header now inherits the top radii and the last child inherits the bottom pair, rather than clipping the whole dialog with <code>overflow: hidden</code>, which would cut off anything a modal legitimately hangs outside itself.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>The Agenda Check dialog is two columns while you are pasting</strong> (<code>app/css/app-shell.css</code>): the sheet's body becomes a <code>360px</code> + <code>1fr</code> grid, the pitch on the left under an <code>.app-hero--dialog</code> variant of the section hero, the composer on the right. Both the grid and the left column are keyed off <code>:has(.ac-screen--input)</code>, so the moment the module swaps the composer for the report the sheet widens back to the report's <code>1400px</code> measure and the column disappears without a line of JavaScript. One column below <code>1100px</code>. The report screen is condensed in the same scope: <code>ws_planner_card--lg</code> gives up its 96px floor and takes tighter padding, the issue rows drop from 20px to 12px, and the energy-arc score steps from <code>--text-h1</code> to <code>--text-display</code>, none of it leaking outside the dialog. The report sheet itself is <code>1120px</code> rather than the page's <code>1400px</code>, its rail <code>420px</code> rather than <code>630px</code> (at the module's own <code>1024px</code> breakpoint, so narrow widths keep their single column), and it caps at <code>660px</code> tall and scrolls its body.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.25.0: a fifth phase, and the surfaces Prove brought with it</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>ws_app_bar()</code> takes a fifth state</strong>, <code>prove</code>, beside strategize, plan, facilitate and synthesize. It needs no colour rule of its own: the platform has been unified under Learn Red since July, so the four existing states already paint the same bar and a fifth would only have been a fifth way to write the same declaration. An unknown state still falls back rather than rendering a class nothing defines.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>ws_workshop_list()</code> knows a fifth stage.</strong> Adding <code>prove</code> to <code>ws_workshop_list_stages()</code> is the whole change: the stage pill, the chips, the kanban's fifth column and the fifth dot on <code>ws_wl_journey()</code> all read that one map, which is why they could never disagree about how many stops the journey has. The row meta line gained two bits from the same listing: how many people answered the feedback form, and, on the Prove picker, how many commitments a workshop carries and how many are waiting on the facilitator's word.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>app/css/prove-report.css</code> is back</strong>, and its print contract now hides <code>.prv-owner-only</code> along with the shell bar, the back link, the gap cards and the missing list. That one class is the whole owner surface: the share panel, the per-answer remove controls, the commitment status strip and the collect card. The stylesheet's header documents why its font sizes are px literals rather than tokens: the root sits at 80%, so a rem token never paints the size its name suggests, and the report is a document with its own reading ramp.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>prove/r/report-share.css</code></strong> for the public share page, which reuses the report's own stylesheet and adds only what a page outside the shell needs. The client's brand accent is scoped to the document rather than set on the header, so a shared report can carry someone else's colour without repainting Workshopr's chrome.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>facilitator/css/commit.css</code></strong> for the two public commitment pages, <code>commit.php</code> and <code>checkin.php</code>: a stranger on a phone with one job, built from tokens only. The facilitator's own panel is a separate <code>.wcm-*</code> block appended to <code>facilitator/css/facilitator.css</code>, because it lives inside the run console's overlay and inherits it.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.24.0: a stepper, and a danger primary in the modal footer</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>ws_stepper()</code></strong>: a number input between a decrement and an increment button, for a value edited in fixed jumps that still has to be typeable. Built from the duration control the exercise contribution form hand-rolled as <code>.app-contribute__stepper</code>, which it replaces; the planner's <code>.duration-stepper</code> is the same control and is the next thing to move onto it. As with every component here it ships no JavaScript: the row carries <code>data-ws-stepper</code>, <code>data-step</code>, <code>data-min</code> and <code>data-max</code>, the buttons carry <code>data-ws-stepper-dec</code> / <code>-inc</code>, and one delegated handler on the page serves every stepper on it.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>ws_modal_footer()</code>'s primary slot accepts <code>variant</code></strong>, defaulting to <code>primary</code>. The one other value with a job is <code>danger</code>. The Settings cancel-subscription modal had hand-rolled its entire footer on the strength of a comment claiming the component "passes no attrs through to its buttons", which was false, and then bolted <code>ws-btn--danger</code> onto a primary button because there was no honest way to ask for red. The demo's note saying primary was always primary is corrected.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.23.0: tracking as a ratio, and one tier in the card</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Every Fraunces heading is tracked at <code>-0.02em</code>.</strong> Eight rules wrote it as a px literal, which has to be recomputed per size, and the spread had drifted from <code>-0.0156em</code> to <code>-0.0469em</code>: <code>.dash__hero-title</code> and <code>.wl__title</code> both render at 25.6px on the same page and carried <code>-0.6px</code> and <code>-0.512px</code>, while <code>.app-shell__title</code> sat at more than twice the norm. Written as a ratio it cannot drift again.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>.app-rail__film-title</code> is set in the heading font.</strong> It was Inter, and the modal the card opens titles the same words at the same size in Fraunces, so the phrase a reader had just clicked changed typeface under them. <code>rules.typography</code> names card titles as heading-font at severity mandatory, so this was a rule break rather than a preference.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>.ws-dna-profile-cta__text</code> is tracked at <code>0.08em</code>.</strong> Uppercase at <code>0.01em</code> was the one piece of untracked caps in the frame, against 0.12em on the eyebrows and 0.08em on table headers. Measured after: 175px of text in a 320px pill, 43px of headroom, so the <code>nowrap</code> holds.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The workshop card's tertiary tier is one size.</strong> Stage pill, meta line and action were drawn at 9.6px, 9.6px and 10.4px: a spread too small to read as hierarchy and big enough to be three things to keep right. All three take <code>--text-meta</code> now, which takes the card from five type levels to three. The journey strip stays at <code>--text-micro</code> and is the deliberate exception: at three columns it needs 238px of a 234px box at the next step up.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>.lp2-nudge__desc</code> takes the 62ch measure</strong> that <code>.app-shell__lede</code> already uses in the same stylesheet. It ran to 95 characters a line over two lines, which is where a long measure actually costs a reader: the return sweep has to find a line it left nearly 600px ago.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.22.0: the card check learns what it was missing</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Check 4 of <code>check-drift.php</code> accepted any <code>var()</code> as proof a card was in the system.</strong> It exists to keep card padding and radius on <code>--card-padding</code> / <code>--card-radius</code>, but its token test was <code>stripos($value, 'var(')</code>, so <code>border-radius: var(--radius-2xl)</code> passed. <code>--radius-2xl</code> is a perfectly good token and it puts a card outside the card family, which is the same drift the literals used to cause. The test now asks whether the value draws from <em>that</em> family.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>A BEM element literally named "card" is now treated as a card.</strong> The matcher required a <code>-card</code> stem, so <code>.app-settings__card</code> read as an element like <code>.ws-card__title</code> and was skipped. That is how the Settings panel drew 16px corners in a 12px frame without this check ever looking at it.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>--card-padding-roomy: var(--space-8)</code></strong>, the third and last member of the card inset set, for a full-width panel carrying a form where 20px against 840px of card reads as no inset at all. Settings drew <code>--space-8</code> directly because there was nothing to reach for.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Five more surfaces join the card family:</strong> <code>.app-settings__card</code> (was <code>--radius-2xl</code> and a raw <code>--space-8</code>), <code>.app-stuff__row</code> (was <code>--radius-lg</code> with no shadow), <code>.app-signin__card</code>, <code>.app-ob__card</code>, and <code>.st-exit</code>, which keeps its tinted fill and accent border because it is a callout band rather than a neutral card, and only gives up its asymmetric inset.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Agent scratch directories are out of the CSS sweep.</strong> <code>.superpowers/</code> and <code>.scratch/</code> join <code>.claude/</code> and <code>.omc/</code> on check 3's exclusion list; working copies of stylesheets that were never routes were being counted as platform drift.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The ratchet is rebuilt at 384 entries, up from 124.</strong> That growth is the rule getting stricter, not new drift: 260 declarations across Synthesize, Sidekick, the surveys, Academy, Admin, Login, Start and Strategist were always outside the card family and were always invisible to the old test. Nothing in <code>app/</code> is on the list. Shrink it by repointing a card at the tokens and deleting its entry.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.21.0: one card, and a card that groups</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>.ws-task-checklist</code> draws the card tokens instead of a private copy of them.</strong> It hand-rolled <code>--bg-surface</code>, <code>--gray-200</code>, <code>--radius-2xl</code> and <code>--space-6</code> where <code>--card-bg</code>, <code>--card-border</code>, <code>--card-radius</code> (12px) and <code>--card-padding</code> (20px) already said the same thing in four of those five cases and something different in the fifth. In a rail beside <code>ws_card</code> surfaces it was the one object with 16px corners.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The app rail's film and Tips cards stop overriding <code>--card-padding</code>.</strong> Both set <code>16px 20px</code> over the <code>.ws-card--content</code> inset, which put three vertical paddings (16, 20 and the hero's 24) against a constant horizontal 20 across surfaces with the same job. They inherit now.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Rail cards carry <code>--card-shadow</code>.</strong> Card white (<code>#FFFFFF</code>) against the app's page colour (<code>#FAFAF9</code>) is 1.04:1, so a card was separated from the paper by a 1px border at 1.26:1 and by wherever the 24px grid texture fell behind it. A shadow makes that separation even all the way round. Scoped to the app rail: <code>.ws-card</code> stays flat platform-wide, which is deliberate, and <code>--elevated</code> remains the opt-in.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The workshop card groups by proximity.</strong> Its five rows sat at a uniform 12px, so the pill row, the name, the meta line, the journey strip and the action all read as peers. Name to meta is 4px now, meta to strip 6px, and the action is pushed to the foot with a 16px floor above it: one group, then the thing you do about it.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The listing's column floor drops from 280px to 260px,</strong> restoring three columns at 276px on a 1440px window. The 280 was chosen while the frame painted at 0.64 scale; at true scale it forced two columns of 417px, where the meta line filled 48% of its row and the action 37%. Measured at 1440, 1200, 1024 and 375: names wrap to two lines at most and no journey strip overflows.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>.wl-journey__bar</code> floors at 6px rather than 10px.</strong> The bar grows to fill whatever the strip has spare and renders at 9px in a 276px card, so the floor only binds when the card is tight, where the three bars' old 30px minimum was the last 5px pushing the strip past the card edge.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.20.0: the app frame stops taking the 80% twice</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The app shell was painting at 0.64x the design system, not 0.8x.</strong> <code>html { font-size: 80% }</code> makes every rem token paint at 0.8x its nominal value, which v2.18.0 wrote into each token's comment. <code>body.app-shell</code> then applied <code>zoom: 0.8</code> on top, and the two multiplied. A workshop card title set in <code>--text-h4</code> (nominal 18px, documented as painting 14.4px) was reaching the screen at 11.52px; <code>--text-nano</code> on the journey strip arrived at 6.4px. Both reductions were documented, each in a comment that accounted for itself and not the other. <code>app/css/app-shell.css</code> even carries a note reasoning about the rem 0.8 from inside the file whose body rule was applying the second one. The <code>zoom</code> is gone; the root percentage is the single reduction, and it is the 80% the frame was asked for.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Everything that existed to compensate for the zoom goes with it.</strong> <code>height: 125dvh</code> on the shell body and the two sign-in minimums return to <code>100dvh</code> (the 125 was 100 / 0.8), and <code>.app-shell .synth-shell { zoom: 1.25 }</code>, a counter-zoom whose only job was to cancel the 0.8, is removed rather than left to magnify Synthesize by a quarter. Four stylesheets carried comments explaining layout decisions in terms of the zoom; each now states the reason that is still true, which is that these views scroll inside the shell's own region rather than the window.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>ws_choice_card</code> fills only the featured card's action.</strong> The component has always said at most one card per row is featured, but every card drew the same solid red button, so a row of three paths presented three equal primaries. The featured card keeps the fill; the rest take the 2px outline <code>ws_button</code>'s secondary variant draws, with the border on both so the two never differ in size. Affects the Planner home, the builder's empty canvas and Plan inside the app shell.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The workshop card's journey strip used the decorative ink for essential text.</strong> <code>--color-ink-faint</code> is annotated in <code>platform-tokens.css</code> as "decorative only, never essential text" at 2.52:1 on white, and the strip's upcoming stages were painted with it, while naming which phase a workshop has reached, which is the strip's entire purpose. It now takes <code>--color-ink-faint-accessible</code> at 4.6:1, and <code>--text-micro</code> over <code>--text-nano</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The workshop card title moves from <code>--text-h4</code> to <code>--text-h3</code>.</strong> Everything under it (meta line, journey strip, action) is one tertiary tier around 9 to 10px, and at h4 the title sat 1.2x above that tier, inside the range the eye reads as the same level. It is 1.5x clear now. Fraunces stays: <code>rules.typography</code> names card titles as heading-font, severity mandatory.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>featureFirst</code> on <code>ws_workshop_list()</code></strong>, which outlines the first visible row's action while the rest stay ghost. Off by default, and only safe where the chips are off, since filtering changes which row is first.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.19.0: one sheet of paper under the whole platform</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Every in-scope page now paints <code>--bg-page</code> with <code>--paper-grid-image</code>.</strong> All 203 real pages were rendered headless, their body children hidden so only the page background survived, and the resulting 240&times;240 crop measured for dominant colour and 24px line periodicity. 61 pages failed. 41 were drift and are fixed; the other 20 are the deliberately dark surfaces (Coach landing, Live mode, Better Meetings, the five Academy book covers), the email preview, and six files that are partials or generators rather than routes. The measurement is repeatable: it is pixels, not a grep for the token name.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The <code>background:</code> shorthand was the cause in almost every case</strong> &mdash; exactly the failure <code>platform-tokens.css</code> documents at the token, and the reason it says five pages had already lost the grid this way. <code>css/tips/styles.css</code>, <code>css/academy/styles.css</code>, <code>css/planner/briefing.css</code>, <code>css/planner/design-system.css</code>, <code>facilitator/css/feedback.css</code> and <code>prework.css</code> all wrote <code>background: var(&hellip;)</code> over the global body rule and wiped the grid with it. They are longhand now, each carrying the note.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Five paper stocks collapse into one.</strong> The off-canon pages were painting <code>#FAF7F2</code>, <code>#FEF7F1</code>, <code>#FBF9F5</code>, <code>#FAF6EC</code>, <code>#F5FAF7</code> (a mint green, in Learning Paths), <code>#F8FAFC</code> (a cool slate, in the DNA rating thanks page) and plain white. All now take <code>--bg-page</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The app shell's paper moves to <code>--bg-page</code></strong> in <code>app/css/app-shell.css</code>: <code>.app-shell__main</code>, the plan-check dialog body that deliberately mirrors it, and <code>.app-boot-veil</code>, which has to match the page it covers. <code>body.app-shell</code> stays white by the note already in the file &mdash; the paper lives on main, and the body is never visible behind a <code>125dvh</code> frame with <code>overflow: hidden</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The Admin console joins the platform grid.</strong> <code>css/admin/admin-v2.css</code> had a bespoke background: its own <code>--paper</code> at <code>#FAF6EC</code>, a 24px grid at <code>rgba(38, 30, 18, 0.045)</code>, and a second 96px accent grid over it. It now takes <code>--bg-page</code> and <code>--paper-grid-image</code>, so it also drops out under forced-colors with every other page. The two warm radial washes stay, layered above the grid.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Two pages drew the grid twice.</strong> <code>planner/index.php</code> and <code>planner/templates.php</code> carried a fixed <code>body::before</code> painting a second 24px grid in <code>--color-border</code> at 50% opacity. With the body rule restored that would have doubled up, so the overlay is gone.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Three Tips pages had no page background at all.</strong> <code>tips/preferences.php</code>, <code>tips/unsubscribe.php</code> and <code>tips/vote-confirm.php</code> render on white: they link <code>/tips/styles.css</code>, which exists on production but not in the repo, so the background cannot depend on it. Each now declares the paper in its own style block, and links <code>platform-tokens.css</code> explicitly through the same localhost/www switch it already uses for <code>components.css</code>. The tokens did reach these pages before, but only through an <code>@import</code> inside the auth modal's stylesheet, which none of them includes itself &mdash; a page background should not depend on a modal shipping with it.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The restored grids are <code>background-attachment: fixed</code></strong>, matching <code>css/styles.css</code> and <code>_backgrounds.css</code>. Without it the grid scrolls with the content, which on the Academy book readers (up to 34,000px tall) and the 23,000px Tips index reads as a moving texture rather than paper under the page. 26 rules.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Five self-contained pages define the paper tokens locally</strong> &mdash; the five Academy book readers, Coach coming-soon, the handouts index, the DNA rating thanks page and the Planner landing page. They cannot link <code>platform-tokens.css</code>, which also sets <code>html { font-size: 80% }</code> and would rescale their whole layout, so each mirrors the four values in its own <code>:root</code> with a comment naming the source.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.18.0: the type scale says what it paints</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Every <code>--text-*</code> token now documents its rendered size, not its nominal one.</strong> <code>html { font-size: 80% }</code> sets the root to 12.8px platform-wide and by design, so a rem token paints at 0.8x the size its comment claimed: <code>--text-small</code> was labelled 14px and renders 11.2px, <code>--text-h1</code> was labelled 32px and renders 25.6px. Each token now reads <code>paints 11.2px (nominal 14px)</code>, and the block carries a warning against swapping a px literal for the token that shares its nominal value. This is almost certainly why stylesheets across the platform still write px literals: the tokens never gave the size the documentation promised.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>--space-7: 28px</code></strong>, between <code>--space-6</code> and <code>--space-8</code>. Five call sites in <code>app/css/app-shell.css</code>, <code>css/stsh-shell.css</code> and <code>includes/components/components.css</code> already referenced it with a 28px fallback, so the step existed in practice and not in the scale.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>check-drift.php</code> reports the <code>ws_</code> namespace being claimed outside the design system.</strong> A function named <code>ws_*</code> announces itself as part of the system, but if it lives anywhere other than <code>includes/components/</code> none of this gate's checks reach it. Six files hold 33 such functions; <code>app/includes/workshop-list.php</code> alone defines 26, including four whole listing view modes.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The gate passes again.</strong> It was failing on <code>content/plan/synthesize-mockups/mockup 2.css</code>, a duplicate backup whose canonical twin passes.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.17.1: the check's issue rows on platform cards</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>.ac .energy-arc-rec</code> is restated as a platform card</strong> (<code>agenda-check/agenda-check.css</code>): <code>var(--bg-surface)</code> behind a <code>var(--gray-200)</code> edge at <code>var(--radius-xl)</code>, replacing the cream-and-orange row it inherited from <code>css/planner/prep.css</code>, whose <code>--warm-cream</code> was defined nowhere on the platform. Scoped to <code>.ac</code>, so the planner's prep page keeps its own.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The same rule restated its own border.</strong> A <code>border-left</code> sat under the <code>border</code> shorthand at the identical width and colour, saying nothing the line above had not already said. The line is gone.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">September 2026</div>
    <div class="changelog-version">v2.17.0: a gold badge, and badges draw font-only icons</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>.ws-badge--gold</code></strong> (<code>includes/components/components.css</code>): the premium marker, for Pro and anything else that reads as an upgrade. It borrows the amber ramp rather than owning tokens of its own, <code>var(--color-warning-light)</code> behind <code>var(--color-warning-darker)</code>, taking the darker step for text so it reads as metal rather than as a warning. First use is the Pro pill on the planner's Slide deck modal, which was <code>info</code> blue and said "beta feature" where it meant "paid".</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>ws_badge()</code> draws icons the set has no SVG for.</strong> It called <code>icon()</code> alone, and <code>icon()</code> answers a name it cannot find with an empty span, so a font-only name such as <code>workspace_premium</code> rendered as a blank gap inside the badge. It now falls back to the Material Symbols ligature, the same guard <code>ws_button()</code> already carried. Only names that had no SVG change.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>ws_app_bar()</code> tested the wrong thing.</strong> It branched on whether <code>icon()</code> exists rather than on whether it returned an SVG, which drew Slide deck (<code>co_present</code>) as a blank button in the planner toolbar. Both the action and the centre-control paths now test the result.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.16.0: the canvas directory gets a recommender and a pager</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>.cv-find</code></strong> (<code>css/canvas/styles.css</code>): the Canvas Directory's guided recommender, a conversation panel sitting above the grid. The block covers the head and its <code>Ask</code> toggle, the thread's two bubble sides (<code>.cv-find__msg--agent</code> on white behind a <code>var(--gray-200)</code> edge, <code>.cv-find__msg--user</code> right-aligned on <code>var(--phase-learn-light)</code>), the starter and answer chips, a three-dot <code>.cv-find__typing</code> indicator that holds still under <code>prefers-reduced-motion</code>, and the result group: a <code>.cv-find__best</code> label, an italic <code>.cv-find__why</code> line, and the card capped at 420px so a recommendation reads as one answer rather than a second grid.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>.cv-pager</code></strong>: the index paginates at 15 canvases a page, so it needed a pager. Every control is an existing <code>.cv-chip</code> rather than a new numeral button; the current page is that chip's <code>.is-active</code> state. The one addition is <code>.cv-chip--disabled</code>, 0.45 opacity with <code>pointer-events: none</code>, for the Previous and Next ends, which the page renders as <code>&lt;span&gt;</code> so a reader never tabs to a link that goes nowhere.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>.cv-note a</code> now carries <code>var(--phase-learn-dark)</code> and <code>var(--font-semibold)</code>.</strong> The attribution footnote is <code>var(--gray-100)</code> under <code>var(--text-muted)</code> body text, and its two links are the whole way a reader reports a wrong credit or suggests a canvas. At the block's own weight they read as prose. Weighted, they read as the actions they are.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The canvas of the day and the find panel take a <code>var(--phase-learn-dark)</code> border.</strong> Both sit on the index above a grid whose cards are edged in <code>var(--gray-200)</code>, and a light edge left them reading as two more cards in it. The dark red says they are the page's two offers instead. <code>.cv-today__card:hover</code> keeps the same border colour and moves only the 1px lift, so the edge never announces itself twice.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The directory's stylesheet moved from <code>css/canvases/</code> to <code>css/canvas/</code>.</strong> The pages now live at <code>/canvas/</code>, and the sheet's path was the last thing on the platform still naming the old route.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.15.0: the hero folds, and the card menu ships once</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>.app-hero--compact</code></strong> (<code>app/css/app-shell.css</code>): the section hero for a reader who is already using the product. The full hero is a pitch: pill, two display lines and a lede, about 280px of it, which on 1440x900 put the reader's own list below the fold on every visit to Plan, Facilitate, Synthesize and Prove. The modifier drops the lede and the red second line, takes the headline to <code>var(--text-display)</code> on one line, and closes the gap below to <code>var(--space-5)</code>. The 48px above is deliberately untouched: <code>.app-rail</code> opens level with the hero at that same value, and moving one without the other steps the two columns apart.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>chips</code> option on <code>ws_workshop_list()</code></strong>: whether to draw the stage filter chips, default true, with <code>filters</code> kept as its older name rather than added as a second switch that could disagree. With the chips off, <code>filter</code> stops being a control and becomes the listing's subject: the rows are cut to that stage server-side, so the heading's count, the pager, the empty state and what the reader can see all describe one set. The <code>footer</code> option gained a <code>variant</code> key, for the plain text link the phase pages close their list with.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The card actions menu is one <code>&lt;template&gt;</code> per listing, not a popover per card.</strong> Every row used to ship its whole panel: nine or so links and buttons, in each of the views, none reachable until a trigger is pressed, which came to 421 links and buttons in a home page showing fourteen workshops. <code>ws_wl_menu()</code> now emits the trigger and the row's facts as data attributes (<code>data-wl-owned</code>, <code>data-wl-collab</code>, <code>data-wl-delivered</code>, <code>data-wl-deck</code>, <code>data-wl-stage</code>); <code>ws_wl_menu_template()</code> emits the superset once with <code>{id}</code> where the plan id goes, and <code>workshop-list-menu.js</code> clones it on open, drops what the row does not have, and throws the clone away on close. Same document at 148. Every entry, the keyboard traversal, the in-panel confirmation and the focus return are unchanged.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>meta_extra</code> on a listing row</strong>: extra bits for the card's meta line, after the facts every listing states. Prove is the first caller: it says when the room happened and what it captured. Also <code>counts</code>, carried through from the Workshop Record so a page can build its own line without a second query.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>badge</code> on a <code>ws_task_checklist()</code> row</strong> (<code>includes/components/task-checklist.php</code>): a short count rendered as a quiet <code>ws_badge</code> pill after the label, for a step whose name cannot say how much of it is left ("Run the session &middot; 2 ready"). A done row carrying a badge stays actionable rather than going inert, because a completed step with work still queued behind it is somewhere the reader needs to be able to go.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>short</code> on a <code>ws_sidenav()</code> item</strong> (<code>includes/components/sidenav.php</code>): a second, shorter name for widths the full one cannot survive. Both ship in the DOM, <code>.ws-sidenav__label--short</code> is hidden by default and the layout picks which one shows, and the item takes the full label as its <code>aria-label</code> so the accessible name never shortens with the screen. The app shell's bottom bar is the first caller: below 640px Strategize, Facilitate and Synthesize were all running off the end into an ellipsis, and now read Strategy, Run and Synth.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>About 60 lines of dead stylesheet removed.</strong> <code>.prvh-grid</code>, <code>.prvh-card</code> and their two media queries were the last hand-rolled workshop card on the platform; Prove renders <code>ws_workshop_list()</code> now, so they went, and the card-border rule in <code>app-shell.css</code> stopped naming a selector nothing draws.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.14.12: the home hero's primary button answers the pointer</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>.dash__hero-btn.ws-btn--primary</code> now has its own hover and focus state.</strong> Rest, <code>:hover</code> and <code>:focus-visible</code> shared one declaration in <code>app/css/dashboard.css</code>, so the one emphatic button on the app home page never moved under the cursor or the keyboard. Hover and focus take <code>var(--phase-learn-very-light)</code> as the fill and keep <code>var(--bg-surface)</code> as the border, so the edge stays put while the face darkens.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.14.11: the frame bar offers the real app window</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>The app footer's full bar carries an "Install the app" action.</strong> Rendered hidden and revealed only by Chrome's <code>beforeinstallprompt</code> — the installed PWA is the one window a browser draws without a URL row, which no popup feature string is permitted to do. The click spends the event's one-shot <code>prompt()</code>; either outcome retires the button for the visit, <code>appinstalled</code> retires it for good, and browsers that never fire the event never show it. Wired in the template's own script (registered at parse, since Chrome can fire before <code>DOMContentLoaded</code>); the control reuses <code>.ws-app-footer__link</code>, so no new CSS.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.14.10: the featured row leads with the front door</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The app shelf's featured row now points at <code>/start/</code>.</strong> <code>ws_app_shelf_featured()</code> sends the Workshopr App row through the app's landing page, which pitches the app and signs the visitor in on one screen, then forwards an already-signed-in reader straight to <code>/app/</code>. No site surface lands anyone on the shell's bare sign-in wall any more.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.14.9: the app shelf grows a featured row</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The app shelf's consolidated-app row moved above the phases.</strong> <code>ws_app_shelf_featured()</code> returns the Workshopr App as its own row, and the logotype dropdown (<code>.wsh-panel__app--featured</code>), the homepage shelf (<code>.tue-shelf__app--featured</code>) and the features shelf (<code>.ft-shelf__app--featured</code>) all render it full-width above the phase groups. Strategist and Planner left the STRATEGIZE/PLAN group on the same reasoning that removed Facilitator: they are views inside the app the featured row already covers.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.14.8: the password field's eye is anchored, and stops seeing double</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>ws_input</code>'s password reveal.</strong> Two rules the component always needed lived only in one app's stylesheet. <code>.ws-password-wrapper</code> had no <code>position</code>, so the absolutely-positioned toggle anchored to whatever ancestor happened to be positioned: on the app shell's new sign-in screen it landed at the far right edge of the window, a pair of eyes floating in the paper. And the inline handler swaps the two eyes by toggling a <code>hidden</code> class that nothing defined, so both drew at once on every password field on the platform. Both rules now ship with the component, scoped to the toggle rather than claiming a global <code>.hidden</code> utility.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.14.7: ws_choice_cards counts columns from its container</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>ws_choice_cards</code> is no longer laid out against the window.</strong> The set was <code>repeat(3, 1fr)</code> with breakpoints at 1100px and 640px, which is a measurement of the browser, not of the grid: inside the app shell the same component sits in a column that gives up 320px to the rail and paints at <code>zoom: 0.8</code>, so at a 1160px window each card was about 200px wide and its time label collided with its button. The track floor is now <code>max(240px, (100% - 2 * gap) / 3)</code> with <code>auto-fill</code>, which reads the container: three columns while there is room for three, then two, then one, and never more than three however wide the screen gets. The featured card still takes the full row once the set folds, now via <code>@container (max-width: 760px)</code> rather than a window breakpoint. <code>--2</code> and <code>--1</code> keep their meaning as caps.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.14.6: ws_app_bar's icon actions get their tooltips</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Icon-only actions in <code>ws_app_bar</code> now carry a tooltip.</strong> The component's docblock has always claimed tooltip behaviour, but an icon action shipped with <code>aria-label</code> alone: named for assistive technology, silent to a pointer. Each one now also gets <code>data-tooltip</code> from the same label plus <code>data-tooltip-position="bottom"</code>, since the bar sits at the top of the window and the default top placement would open off-screen. A caller passing its own <code>data-tooltip</code> in <code>attrs</code> keeps it, and labelled actions are untouched (their text is already the name). No CSS was needed: the bar was already <code>overflow: visible</code> and the <code>[data-tooltip]</code> rules were already there.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.14.5: A lighter gear</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>icon('settings_light')</code></strong>, the weight-300 cut of the Material Symbols gear at <code>images/icons/settings_light.svg</code>. The stock weight-400 <code>settings</code> glyph carries about a third more ink than the outline icons it sits beside (measured 10.1% coverage against home's 7.5%), so on a red app bar it read as bold; the 300 cut lands at 7.3%. First used by the planner's Plan settings button; reach for it wherever a gear sits in a row of outline icons.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.14.4: ws_task_checklist stops crossing things out</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Done rows dim instead of striking through.</strong> <code>.ws-task-checklist__item.is-done .ws-task-checklist__label</code> drops <code>text-decoration: line-through</code> and keeps the <code>--text-muted</code> shift; the check is already the state, and a stack of struck labels reads as ruled lines between the rows rather than as finished work. The complete state's <code>text-decoration: none</code> reset went with it, being redundant now.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The card's action right-aligns.</strong> <code>.ws-task-checklist__cta</code> becomes a flex row justified to <code>flex-end</code>, so the button lands under the rows' arrows at the card's trailing edge. Consumers that ship no <code>cta</code> (the app home's first-run card, whose action is its own element) are unaffected.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The rail's Getting started card halved in height</strong> (<code>app/includes/rail.php</code>): no subtitle, no per-step <code>description</code> or <code>phase</code>, and <code>progress =&gt; false</code>. Every one of those was already optional on the component, so this is a caller change, not a component one.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.14.3: The Intervention Cards rail card shows the deck, not a diagram of it</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>.app-rail__cards-art</code> carries two cards instead of five.</strong> The fanned-five artwork was recognisable as a deck but rendered each card at roughly 55px wide, too small for the livery or the scene to read, so the card advertised "cards" in the abstract. It now carries a composed pair (<code>images/intervention/cta-cards-pair.png</code>): the hero square-on with a second angled behind it, built from the real fronts in <code>images/intervention/cards/</code> rather than a Nano Banana imitation, with shadows derived from each card's own alpha so the rounded corners cast correctly. This is the move the DNA rail card already makes, where the medallion is the pitch rather than an icon standing in for one. The sizing rule goes <code>200x150</code> fixed to <code>216px</code> wide with <code>height: auto</code>: the pair is portrait, and a fixed height would squash the angled card. Quantised to 38KB from 139KB, visually identical at display size.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.14.2: The DNA badge label sits on one line</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>.ws-dna-profile-cta__text</code> goes 14px/17px to 16px/20px semibold on a single line.</strong> "Your DNA Profile" and "Discover your DNA Profile" lose their <code>&lt;br&gt;</code> and gain <code>white-space: nowrap</code>; tracking eases from 0.02em to 0.01em so the earned pill's 156px text box still holds the phrase beside the medallion. Both states keep their 59px pill; the line simply centres in it. Sizes stay in px for the reason the block documents.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.14.1: The DNA medallion loses its plate, its label gains a step, and the feedback modal widens</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The <code>ws_dna_profile_cta</code> medallions are transparent.</strong> The five <code>images/dna/profile/medallion-*.png</code> exports carried an opaque <code>#F5F5F5</code> plate, which painted a pale box over the tinted pill the roundel is supposed to overlap. The plate is knocked out by a border-seeded contiguous flood fill rather than a global colour replace, because the artwork holds near-white of its own (the shirt, the scroll, the roundel's inner field) that a global replace would punch through. The anti-aliased rim is unmixed against the plate colour, so no grey halo survives on the tint. No CSS or markup change: the component's <code>filemtime</code> cache-bust carries the new files.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>.ws-dna-profile-cta__text</code> goes 12px/15px to 14px/17px.</strong> At the 80% root the frames' 12px read small beside the medallion. Both states keep their geometry: two lines still clear the pill's 59px box, and the start card is unchanged at 59px. Sizes stay in px for the reason the block already documents: <code>--text-*</code> would paint this at 0.8x the size the wireframe frames are drawn at.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The app footer's Send feedback modal moves from <code>sm</code> to <code>default</code></strong> (360px to 500px), giving the message textarea a usable measure. A size step the modal component already ships, not a one-off width. The v2.14.0 entry below describes the original <code>sm</code>.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.14.0: The app footer's three actions grow up</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The full app footer's right side reworked.</strong> Send feedback is now a button opening a <code>ws_modal</code> (size sm, branded) whose fields are <code>ws_select</code> and <code>ws_input</code> (textarea type included), footed by <code>ws_modal_footer</code>; it posts JSON to the existing <code>api/contact.php</code> with client-side floors mirroring the endpoint's own. Resources and Company open small link panels anchored above their buttons (disclosure pattern: <code>aria-haspopup</code>/<code>aria-expanded</code>/<code>aria-controls</code>, menu roles inside, no <code>aria-modal</code>), carrying the marketing footer's four Resources and six Company links. Panels close on Escape (focus returns to the trigger), on outside click, and when the other opens; arrow keys, Home and End walk the items. All panel chrome is tokens; the explicit <code>.ws-app-footer__panel[hidden]</code> rule keeps the display gotcha closed. The launcher lost its footer entry point: the rail's More button is its one way in, and <code>data-app-footer-launcher</code> plus the <code>launcher</code> option are gone.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.13.0: The DNA Profile CTA takes the wireframes' badge design, and [hidden] learns to win</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>ws_dna_profile_cta()</code> rebuilt from the app wireframes' badge frames</strong> (file kRqtDXi210tzoXK5uoHQLz: one frame per archetype plus the default). Earned: the archetype's illustrated medallion, its name lettered on the ribbon, overlapping a tinted "Your DNA Profile" pill; the aria-label and the medallion's alt carry the name in text. Start: the pill alone with the DNA glyph and "Discover your DNA Profile". All five medallions exported at 2x to <code>images/dna/profile/medallion-&lt;slug&gt;.png</code>; a slug without its medallion on disk falls back to the start card. Card chrome is all tokens: <code>--phase-learn-very-light</code> fill, <code>--phase-learn-dark</code> border and type, <code>--radius-lg</code>. New demo page at <code>design-system/components/demos/dna-profile-cta.php</code>.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The workshop listing's <code>[hidden]</code> attribute now always wins.</strong> <code>.wl-card</code>'s <code>display: flex</code> (and its kanban, timeline and pager siblings) beat the user-agent's <code>[hidden] { display: none }</code> (the exact trap the bulk bar's own comment documents), so a filtered-out card stayed fully painted while the filtered-empty note counted it as gone. The chips have carried this since they shipped; the per-phase default filters made it visible on every phase home. One rule in <code>workshop-list.css</code> closes it for every element the filter and the pager govern.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.12.1: The listing footer link becomes a real button</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The <code>footer</code> link on <code>ws_workshop_list()</code></strong> now renders through <code>ws_button()</code> as a small secondary variant with a right-hand <code>arrow_forward</code> icon, replacing the hand-rolled red text link and its literal arrow glyph. The listing's exit is an action, and it inherits the button's phase-colour hover and focus behaviour instead of restating them. <code>.wl__all</code> survives as a layout hook only; the colour, weight and size rules it carried are gone, so the footer no longer redefines what a secondary button already looks like.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.12.0: The workshop listing's chips learn a default, and the pager learns the chips</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>filter</code> option on <code>ws_workshop_list()</code></strong> — which chip opens pressed (<code>'all'</code> or a stage key, default <code>'all'</code>), with first-paint row visibility matching it server-side. A value outside the listing's own <code>stages</code> scope falls back to <code>'all'</code> rather than opening on a chip that isn't rendered. The four phase homes each open on their own stage; Home opens on All.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Paging composes with the chips</strong> instead of refusing them. The old guard existed because two scripts writing <code>hidden</code> on the same rows is how a card goes missing; the replacement is single ownership: on a paged listing, <code>workshop-list-pages.js</code> is the sole writer of row visibility on grid and list, and the chips (<code>workshop-list-views.js</code>) report the active stage to it. The window runs over the rows the active chip leaves visible, a chip change re-pages from page one, and a chip with <code>pageSize</code> rows or fewer shows no pager. Kanban columns and the timeline stay with views.js: whole-collection layouts, never paged.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>A stale stored view preference no longer blanks the listing.</strong> <code>setView()</code> hid every panel before discovering the requested one didn't exist — exactly what a remembered kanban would do on a listing that stopped offering it. It now checks first and leaves the current view standing.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The pattern page</strong> (<code>design-system/app-workshop-list.php</code>) documents both options and demos the chips and pager working together: fourteen static rows, six to a page, opening on the Plan chip. Still renders signed out.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.11.2: <code>ws_choice_card</code> loses its tint</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>.ws-choice-card</code></strong> (<code>includes/components/components.css</code>): the <code>linear-gradient</code> from <code>--phase-learn-very-light</code> down to <code>--card-bg</code> is gone; the card now paints a flat <code>var(--card-bg)</code> like every other card on the platform. The tint was the component's only deviation from the plain card surface, and it read as a wash across the top of each card rather than as emphasis. Featured cards still separate themselves by border colour and the filled badge, which is where the emphasis belonged all along. Applies everywhere the component is used: Plan's home, the planner home, and the builder's empty canvas.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>.lp2 .launchpad-choice-screen__header</code></strong> (<code>app/css/app-shell.css</code>): the header now sets <code>margin-bottom: var(--space-6)</code>, replacing an inline <code>style="margin-bottom:0"</code> in <code>app/views/plan/home.php</code> that left the choice cards sitting directly under the subtitle. The standalone planner home keeps <code>--space-10</code> there, which is a page-opening gap rather than a heading-to-cards one. Note the shell renders under <code>zoom: 0.8</code>, so 24px of token space is 19.2 physical pixels; author against the tokens, not the ruler.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.11.2: The Agenda Check dialog joins the paper, and loses a one-off chip</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>#planCheckModal-overlay .ws-modal__body</code> paints the drafting paper</strong> (<code>app/css/app-shell.css</code>): <code>--bg-paper</code> plus <code>--paper-grid-image</code>, so the dialog stands on the same ground as the region it opens over rather than a white sheet floating above it. The composer and the report cards already paint their own <code>--bg-surface</code>, so they still read as cards on paper. Written longhand for the reason <code>platform-tokens.css</code> gives at the token: the <code>background:</code> shorthand wipes <code>background-image</code>, which is how five pages have silently lost the grid before. Scoped to this dialog, not to <code>.ws-modal__body</code> at large: the other Plan dialogs are forms, and a form on grid paper reads as a mistake.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>.ac-sample-chip</code> is retired</strong> (<code>agenda-check/agenda-check.css</code>). "Try a sample agenda" was a dashed pill with its own hover, focus ring and transition, and no second instance anywhere on the platform; it now renders <code>ws-btn ws-btn--secondary ws-btn--md</code>, the same vocabulary as the "Check my agenda" primary two rows above it. The <code>✨</code> became a <code>ws-btn__icon</code> holding Material Symbols <code>auto_awesome</code>, since a raw emoji inside a design-system button was the tell that it was not one. <code>#acSampleChip</code> stays: <code>agenda-check.js</code> toggles its <code>hidden</code> as the textarea fills, so the id is contract and only the styling changed.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.11.1: The rail's DNA card becomes artwork</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>.app-rail__dna-art</code></strong> (<code>app/css/app-shell.css</code>): the block for the baked DNA cards in <code>images/dna/profile/</code>. Deliberately chrome-free: the artwork carries its own border, padding and cream ground, so a <code>ws_card</code> wrapper would have drawn a second frame around the first. The image holds its slot with <code>aspect-ratio: 27 / 10</code> rather than a fixed height, so a slow network cannot reflow the rail beneath it, and it caps at 360px under 1100px where the rail goes full width, because the widest cut is 640px and a stretched rail would upscale the artwork into mush.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The old <code>.app-rail__dna</code> row is now the fallback, not the default.</strong> <code>appRailProfileCard()</code> returns the artwork when both cuts of a card exist and the text row otherwise, so an archetype added without art degrades to a working card rather than a broken image. The block comment says so; do not delete it as dead CSS.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Not to be confused with <code>ws_dna_cta</code></strong> (<code>includes/components/dna-cta.php</code>), the full-width marketing strip on the homepage and library index. That one is real text with a real button and has no earned state; this one is a 270&times;100 rail widget whose wording is part of the image. Two different jobs, and worth keeping straight before either grows into the other. <code>ws_dna_cta</code> still points at the pre-Red-Unification green Energizer badge.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.11.0: The app frame footer, the checklist's celebration state, and the branded modal earns its styles</div>
    <div class="changelog-content">
        <ul>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>ws_app_footer()</code> grows a <code>full</code> variant</strong>: the consolidated shell's 56px beta bar (wordmark, 2.0 Beta pill, build version read live from the changelog, Send feedback, Resources as the launcher trigger, Company). The 24px band stays the default; the composite's automatic routing is unchanged, and the shell picks the variant through <code>$GLOBALS['ws_app_footer_options']</code>. The template also honours <code>$appFooterStylesOnly</code> so a documentation page can borrow the styles without consuming its one footer.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>ws_task_checklist()</code> gains <code>cta</code> and a designed complete state.</strong> The in-card action renders through <code>ws_button</code> below the items; with every item done the card wears <code>.ws-task-checklist--complete</code>: red-tinted surface, red filled checks, plain ink labels. The app shell's rail journey card (<code>app/includes/rail.php</code>) is the reference consumer, with past-tense labels and a dismiss that persists by cookie.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>ws_modal</code>'s <code>branded</code> variant renders.</strong> The JSON has documented <code>variant: branded</code> since the catalog was written, but only the per-call <code>headerColor</code> path had styles, so the variant fell through to the default. It now paints the red header band the planner dialogs and the app launcher wear; reach for the variant before <code>headerColor</code>.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>The workshop listing pages.</strong> <code>ws_workshop_list()</code> accepts <code>pageSize</code>: rows past page one ship <code>hidden</code>, <code>workshop-list-pages.js</code> draws the strip (numbers to seven pages, arrows and a count past that), and pagination refuses to engage alongside the stage filters: both hide rows, and two hands on one attribute loses cards. Grid and list only.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>The app shell's two-column frame.</strong> <code>.app-cols</code> + <code>.app-rail</code> (app-shell.css): the 320px sticky aside Home, Plan, Facilitate and Synthesize share, carrying the DNA badge card, the journey checklist, the film cards and the promo cards from the app wireframes.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The shell's hero second line goes upright.</strong> Every app wireframe draws the hero's red line without the italic or the tint underline, so <code>.app-hero__title em</code> (and the Strategist's <code>.st-hero</code> copy, inside the shell) retire the Display Text Pattern there. The pattern stays the marketing surfaces' signature per DESIGN.md &sect;7; the <code>&lt;em&gt;</code> stays in the markup because the emphasis is real, only the slant is not.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.10.1: The bulk bar honours <code>[hidden]</code>; the card menu honours ownership</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>.wl-bulkbar</code> ignored its own <code>hidden</code> attribute.</strong> The block sets <code>display: flex</code>, which beats the user agent's <code>[hidden] { display: none }</code>, so the bar the script hides by toggling that attribute stayed on screen under every workshop listing, Delete button and all. Clicking that Delete did nothing, because <code>workshop-list-select.js</code> returns early on an empty selection. An explicit <code>.wl-bulkbar[hidden] { display: none }</code> now closes it, and the block header says why the rule is not redundant.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Arrow keys inside the card menu's confirmation stayed inside it.</strong> <code>hidden</code> sits on the list and confirmation wrappers, not on the buttons within them, so the popover-wide focus query in <code>workshop-list-menu.js</code> walked ArrowDown from Cancel onto the invisible Delete and appeared to swallow the key. The traversal now reads from whichever panel is showing.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>ws_wl_menu()</code> renders per ownership.</strong> Duplicate, Copy share link, Slide deck and Delete are owner-only in <code>api/plans.php</code>, every one of them scoping its query to <code>user_id = ?</code>, so the menu now omits them on a shared card and offers <strong>Remove from my workshops</strong> instead, backed by <code>remove_collaborator</code>, which gained a plan-scoped self-service branch: one account can hold more than one accepted row on a plan (the unique key is <code>plan_id</code> + <code>email</code>), and dropping a single row would leave the workshop on the list. A row with no <code>owned</code> key reads as not owned, matching <code>ws_wl_select_box()</code>, which has applied the same rule to the selection checkbox since it shipped.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.10.0: The app launcher becomes the journey, five phases across</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>.app-launcher__groups</code> is a five-column grid.</strong> The launcher now lists Learn, Strategize, Plan, Facilitate and Synthesize, and the grid was still <code>repeat(4, 1fr)</code>, so the fifth phase wrapped to a second row and stopped reading as a step in a sequence. The column count is fixed rather than auto-fitting, for that reason.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>.app-launcher__panel</code> widens to 1360px</strong> (from 1040), which holds five columns at 246px each — the width the longest app name plus its leaves-the-frame mark needs. The break to three columns moved from 860px to 1130px to match. Both numbers are window measurements against a frame that paints at <code>zoom: 0.8</code>, and the block says so: 1130px of window is 1412 CSS pixels inside the shell, which is the panel plus its padding.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>A launcher row's name no longer runs under its leaves-the-frame mark.</strong> The mark is positioned out of flow, so nothing held the name back from it; "Post-Workshop Toolkit" finished two pixels short of touching. <code>.app-launcher__app:has(.app-launcher__out) .app-launcher__name</code> now reserves <code>var(--space-6)</code> on the right.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.99: <code>ws_lifecycle()</code> retired; My Stuff gains a submission form</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>ws_lifecycle()</code> is gone.</strong> The helper (<code>includes/components/helpers.php</code>), its template (<code>includes/components/lifecycle.php</code>), its demo page (<code>design-system/components/demos/lifecycle.php</code>) and its entry in <code>workshopr-design-system.json</code> were all removed with the MyWorkshopr consolidation. It shipped as a second, older answer to a question <code>ws_wl_journey()</code> (<code>app/includes/workshop-list.php</code>) already answered, and it never gained a caller in eleven months: a documented component nobody uses is a component the next person builds against by mistake. <strong>The <code>.ws-lifecycle</code> CSS in <code>components.css</code> stays</strong> — <code>planner/includes/views/saved-body.php</code> still hand-rolls that markup in JS for the saved-agenda cards, and is now the block's only consumer. Retire it there and the CSS goes with it; the block header says so.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>/app/?view=stuff&amp;step=contribute</code></strong> — the exercise submission form, ported out of <code>myworkshopr/add-exercise.php</code> (742 lines, an inline IIFE, its own orange accent family) into the shell. Everything the old page hand-rolled is a component now: <code>ws_input</code> for the eight fields, <code>ws_radio_card_group</code> for difficulty and the category picker, <code>ws_chip_input</code> for materials, <code>ws_icon_button</code> for the duration stepper and the step deletes, and the platform Toast in place of a hand-built <code>.ws-alert</code> template string. New sheet at <code>app/css/stuff-contribute.css</code>, scoped to <code>.app-contribute</code> and painting entirely from platform tokens — the retired <code>--exercise-accent</code> orange is the one Learn red now, per Red Unification. The fixed right-hand drawer became a sticky column: the shell draws at <code>zoom: 0.8</code> inside its own scroll region, where a viewport-anchored drawer lands against the wrong edges.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The <code>myworkshopr</code> header section is retired.</strong> <code>_wsh_sections()</code> in <code>includes/components/header.php</code> lost the key and its <code>[data-section="myworkshopr"]</code> tag-width rule, <code>WS_APP_PATHS</code> in <code>helpers.php</code> lost the path, and the nav inventory at <code>includes/nav-example.php</code> lost the row. Every <code>/myworkshopr/</code> URL is a 301 that renders no header at all, and an unknown section key already falls back to <code>home</code>, which is what the shell uses.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.98: The colour input becomes a control</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>ws_input($name, ['type' =&gt; 'color'])</code> rendered as a hairline.</strong> A colour input's intrinsic content box is a few pixels tall, so <code>.ws-input</code>'s shared padding left a ~6px swatch inside a 26px field — a control that read as broken rather than as a colour. <code>input[type="color"].ws-input</code> now carries the rendered height of a text field (44px, 36px at <code>--sm</code>), 4px of padding, and a borderless swatch inset to the field's radius. The Planner's new Slide deck modal is the first place two of them sit side by side, which is how it surfaced.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.97: Closing out the 23 August audit</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>--mainsite-gradient</code> starts at <code>#D13A3A</code>, not <code>#E54D4D</code></strong> (WCAG SC 1.4.3, Level AA). This gradient backs <code>--button-bg-primary</code>, whose label is <code>--text-small</code>: 11.2px at the 80% root, so normal text with a 4.5:1 bar. White measured 3.82:1 at the light stop. It is now 4.80:1, with the dark stop unchanged at 5.02:1. Flat brand red is untouched and still lives in <code>--mainsite-primary</code>.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>--planner-gradient</code> and <code>--planner-topbar-bg</code> now alias <code>--mainsite-gradient</code>.</strong> The audit named only the primary button, but the planner carried the identical failure with white text on it in two places: the topbar and <code>.recommend-item__select:hover</code>. Worse, <code>css/planner/base/_variables.css</code> rebuilt the gradient from <code>--mainsite-primary</code> rather than sharing it, so the planner would have kept the failing stop after the button was fixed. One definition now, one place to fix.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>.ws-audio-player__btn</code> hovered purple.</strong> It read <code>var(--color-primary-dark, #651FFF)</code>, and neither <code>--color-primary</code> nor <code>--color-primary-dark</code> exists in <code>platform-tokens.css</code>, so the rest state fell back to red while the hover fell back to a pre-Red-Unification violet. Both now read the real phase tokens.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>ws_dna_cta</code>'s CSS moved into <code>components.css</code> and was tokenised.</strong> It also referenced <code>var(--text, ...)</code> and <code>var(--display, ...)</code>, neither of which is a token, so both always rode their literal fallbacks; they now read <code>--font-body</code> and <code>--font-heading</code>. Every rendered value was verified byte-identical afterwards. Font sizes stay in px deliberately: at the 80% root, <code>var(--text-body)</code> would paint 12.8px, not the 16px the banner is drawn at.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Six bare <code>#FFFFFF</code> literals tokenised</strong> in the pill and toggle components. The audit called these ambiguous, and they are in the abstract, but the property settles it: five are text on a filled pill (<code>--text-inverse</code>) and one is a toggle knob surface (<code>--bg-surface</code>).</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Dead CSS removed:</strong> <code>.action-buttons-standalone</code> and the <code>.pv-toggle</code> block, the latter a transitional planner v1/v2 switch whose own comment asked for its deletion once the rollout landed. Neither had any markup left.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Demo pages</strong> for <code>ws_audio_player</code>, <code>ws_audio_recorder</code> and <code>ws_sidenav</code>, added to the sidebar so they are reachable rather than direct-URL only.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Second audit</strong> at <code>AUDIT-2026-08-23-css-foundations.md</code>, covering the foundation layer specifically. Its headline finding is that 59 custom properties across five stylesheets are defined as themselves, which under the CSS cycles rule destroys them rather than inheriting the platform value, discarding 335 declarations on live pages. Not yet fixed: each change is visible and wants review.</li>
        </ul>
    </div>

    <div class="changelog-version">v2.9.96: The focus ring the system described but never applied</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Baseline <code>:focus-visible</code> indicator in <code>platform-tokens.css</code></strong> (WCAG 2.2 SC 2.4.7, Level AA). The file defined <code>--focus-ring</code> and documented at length why it is sky blue, but nothing applied it: the site's only global rule lives in <code>css/styles.css</code>, which a page gets only through <code>includes/header.php</code>. Every page that hand-rolls its own <code>&lt;head&gt;</code> had no visible keyboard focus outside forced-colors mode, including the homepage, all of <code>/tips/</code>, and every page of this design system. The new rule uses <code>:where()</code> so its specificity is zero: a floor that never fights a component's own focus style.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>.ws-app-bar__switch-option</code> and <code>.ws-choice-card</code> drew no focus ring at all.</strong> Both wrote <code>outline: 2px solid var(--focus-ring, #38BDF8)</code>, but <code>--focus-ring</code> is the whole shorthand, so the value expanded to <code>2px solid 2px solid #0284C7</code> and was discarded as invalid. Both now read <code>outline: var(--focus-ring, ...)</code> like the eleven correct usages elsewhere in the file.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Two pointer targets under 24x24</strong> (WCAG 2.2 SC 2.5.8, Level AA). <code>.ws-chip__remove</code> was 18x18 with no padding and now carries an <code>::after { inset: -3px }</code> hit area, which reaches 24x24 without changing the chip's height. <code>.ws-planner-activity-inspector__close</code> went from 22x22 to 24x24. <code>--target-min: 24px</code> already existed, annotated with the SC number, and nothing was using it.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>css/tips/styles.css</code> imports <code>platform-tokens.css</code></strong>, as <code>css/dna/styles.css</code> and the academy bundles already did. It declared its own palette and imported nothing, so no token ever reached <code>/tips/</code>.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Audit</strong> at <code>AUDIT-2026-08-23-system-audit.md</code>: inventory, naming, completeness, WCAG 2.2 AA, token coverage and theming. Registry mirrors cleanly at 64 = 64, token coverage is 92.7%, theming is deliberately single-theme and documented as such, and reduced motion is handled by a universal gate. One finding needs a product decision: white on <code>.ws-btn--primary</code> is 3.82:1 at the light end of the brand gradient, below the 4.5:1 that 11.2px button text requires.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.95: The homepage gives up its inline CSS</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>/css/homepage.css</code></strong>, holding what were two <code>&lt;style&gt;</code> blocks in <code>index.php</code>. The page was 1,591 lines, 1,305 of them CSS; it is now 287. Markup is byte-identical and every surviving rule moved unchanged.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>892 dead lines removed, 156 rules.</strong> The page renders its hero with <code>ws_section_hero()</code> and its DNA band with <code>ws_dna_cta()</code>, which emit <code>.wsh-hero*</code> and <code>.ws-dna-cta*</code>. The hand-rolled <code>.home-hero*</code>, <code>.hp-hero*</code> and <code>.hp-dna-band*</code> families they replaced were still declared, along with <code>.hp-product-card*</code>, <code>.hp-solution*</code>, <code>.hp-tool-card*</code>, <code>.hp-journey-grid</code>, <code>.hp-final-cta*</code>, <code>.hp-mini-agenda*</code> and <code>.hp-phase-pill</code>. Three hero designs were declared; one is rendered.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The retired phase palette is gone from the homepage.</strong> Plan blue <code>#0284C7</code>, Facilitate purple <code>#7C4DFF</code> and Reflect emerald <code>#10B981</code> survived as hardcoded fallbacks behind <code>--phase-plan</code>, <code>--phase-facilitate</code> and <code>--phase-reflect</code>. Those tokens are <code>#E54D4D</code> today so nothing painted them, but a fallback is a value waiting for its token to move. All of it sat inside the dead rules.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>body</code> takes <code>--paper-grid-image</code> / <code>--paper-grid-size</code></strong> instead of re-typing the two gradients. <code>--grid-line-color</code> is <code>rgba(44, 36, 22, 0.06)</code> and the size is <code>24px 24px</code>, exactly what the page had, so this is identical pixels; the token also resolves to <code>none</code> under forced-colors, which a literal gradient does not. The token's own comment names this as how five pages lost the grid.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>.hp-quote-card</code> onto the card tokens.</strong> Moving the CSS into a <code>.css</code> file made it visible to <code>check-drift.php</code> for the first time, which immediately failed it on <code>padding: 24px</code>. It now reads <code>--card-padding</code> (20px, a real 4px change), plus <code>--card-radius</code> and <code>--card-shadow</code> in place of <code>--radius-xl</code> and <code>--shadow-sm</code>, which are renames at identical values.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Known gaps, not closed here:</strong> five component templates still carry their own <code>&lt;style&gt;</code> blocks rather than using <code>components.css</code> (<code>footer.php</code> 269 lines, <code>header.php</code> 159, <code>section-hero.php</code> 109, <code>dna-cta.php</code> 39, <code>app-footer.php</code> 5), and the homepage still speaks a private token alias layer (<code>--paper</code>, <code>--ink</code>, <code>--learn</code>, <code>--display</code>, <code>--text</code>) over the platform tokens.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.94: The app shell's views give up their inline CSS</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Four <code>&lt;style&gt;</code> blocks moved out of <code>app/views/*.php</code> into <code>app/css/app-shell.css</code></strong>: the <code>.modal-overlay</code> FOUC guard, <code>.lp2-nudge*</code>, <code>.prvh-*</code> and <code>.pwa-install-banner*</code>. Inline CSS in a PHP file is invisible to <code>check-drift.php</code>, which filters on the <code>.css</code> extension, so the card rules in those blocks had drifted to <code>border-radius: 12px; padding: 18px</code> with nothing to catch them. They now read <code>--card-radius</code> and <code>--card-padding</code>, and the card hover reads <code>--card-shadow-hover</code> instead of a hand-rolled warm shadow that no token defined.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>About 660 lines of dead stylesheet removed.</strong> <code>.lp2-card*</code>, <code>.lp2-life*</code>, <code>.lp2-btn*</code>, <code>.lp2-recent*</code>, the whole <code>.fach-*</code> vocabulary, all of <code>app/css/synthesize-home.css</code>, and <code>dashboard.css</code>'s <code>.dash__row</code> section were each orphaned by the same event: the page moved to <code>ws_workshop_list()</code> and its old styles stayed. <code>app-shell.css</code>'s workshop-card border rule and section-heading rule were carrying nine of those names.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>body.launchpad-page</code> deleted from Plan's home view.</strong> It re-declared nine <code>--mainsite-*</code> and <code>--planner-*</code> tokens as red, and it could never match: the shell sets <code>$body_class = 'app-shell'</code>. Those were eight of the eleven <code>hardcoded-hex</code> violations the file carried in <code>page-baseline.json</code>; the entry is now <code>{"raw-component": 4}</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Prove's picker joins <code>.app-hero</code>.</strong> It was the one section with a hand-rolled heading and its own <code>clamp()</code> ramp, and the one page missing from the shell's page-frame neutraliser, so it indented its content further than every other view.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Known gap, not yet closed:</strong> <code>check-page.php</code> reads <code>&lt;style&gt;</code> blocks but only scans them for hex literals, so card geometry written inside a PHP file is still ungoverned. See <code>AUDIT-2026-08-22-app-css-localization.md</code>.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.93: The 6C sequence strip and step chips</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>.agenda-gen-6c</code></strong> in <code>css/planner/components/_agenda-generative.css</code>: the 6C sequence strip in the generator's rationale panel. Six rows on a shared vertical spine drawn with a <code>::before</code> hairline in <code>--planner-gray-200</code>, trimmed to half height on the first and last rows so the line starts and ends at the dots rather than overshooting. A covered step gets a filled <code>--phase-learn-dark</code> dot with a <code>--planner-bg-white</code> ring punching it out of the spine; a missing step gets a hollow dashed <code>--planner-gray-400</code> dot and its minutes column turns red. Grid is <code>16px 1fr auto</code> so the minutes stay right-aligned and <code>tabular-nums</code> keeps them from dancing.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>.agenda-gen-c</code></strong>: the per-row step chip (Connect, Collect, Choose, Create, Commit, Celebrate) sitting next to <code>ws_activity_badge</code> in the generated agenda row head. Brand red on <code>--phase-learn-very-light</code> with a <code>--phase-learn-light</code> border.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Two colour systems, deliberately kept apart.</strong> The activity-type badge keeps its sanctioned functional coding (exercise blue, icebreaker green, break grey, custom purple) because item types must stay distinguishable on the canvas. The 6C steps are a <em>sequence</em>, not categories, so they are not colour-coded against each other: one brand-red accent marks "covered" and a hollow dot marks a gap. Giving the steps their own six-colour scale would have put a second colour axis in direct competition with the type colours in the same row.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.92: Plan Settings goes tabbed, and the app-bar gear turns white</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>.planner-settings-tabs</code></strong> in <code>css/planner/components/_modals.css</code>: the modal's <code>ws_tabs</code> nav, flush under the modal header with a <code>--planner-border</code> rule beneath it. The panes are stock <code>.ws-tab-pane</code>, and switching runs on the existing <code>wsTabsInit</code>/<code>wsTabsSwitch</code> pair in <code>includes/components/components.js</code> rather than a second implementation. Note that <code>components.js</code> already auto-runs <code>wsTabsInit</code> over every <code>.ws-tabs</code> on <code>DOMContentLoaded</code>, so callers should only ever call <code>wsTabsSwitch</code>; calling <code>wsTabsInit</code> again double-binds the click handlers.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Ghost icon buttons in an app-bar trail were reading dark on the red bar.</strong> <code>ws_icon_button</code> renders a <code>.ws-btn--ghost</code>, which inherits the default warm ink, while every <code>.ws-app-bar__action</code> beside it is <code>--text-inverse</code> white. Added <code>.workshop-planner .ws-app-bar__trail .ws-btn--ghost</code> to <code>_component-bridge.css</code> giving the glyph, hover and focus ring the same white treatment as its neighbours. Scoped to the planner deliberately: Synthesize's gear sits in the same slot and has the same problem, but sweeping it is a separate call.</li>
            <li><span class="changelog-tag changelog-tag--deprecated">Removed</span> <strong><code>.planner-settings-section</code> and <code>.planner-settings-section__title</code></strong> from <code>css/planner/components/_modals.css</code>. Tabs replaced the stacked sections, so there is no adjacent-sibling divider to draw and no section heading to style. <code>.planner-settings-note</code> stays (it still styles the signed-out and no-workshop captions) and <code>.deck-settings-hint</code> is untouched.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Paired fields in modals must be direct children of <code>.ws-form-row</code>.</strong> <code>ws_form_row($a . $b)</code> nests its content in a single <code>.ws-form-row__field</code>, which is a block, so the two <code>.ws-field</code> elements never become flex siblings and <code>.modal-overlay .ws-form-row .ws-field { flex: 1 }</code> has nothing to act on. Use a raw <code>&lt;div class="ws-form-row"&gt;</code> with the fields inside it, as the Create New Workshop modal does. No CSS change was needed; the rule was already correct.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.91: Planner settings modal styles</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Planner settings-modal section styles</strong> in <code>css/planner/components/_modals.css</code>: <code>.planner-settings-section</code> (adjacent sections divided by a <code>--planner-border</code> rule), <code>.planner-settings-section__title</code> (mirrors <code>.export-label</code>), <code>.planner-settings-note</code> (muted caption), and <code>.deck-settings-hint</code> (the export modal's pointer to Planner Settings). All values are platform tokens; the modal itself is the standard <code>modal-planner.php</code> shell with <code>ws_input</code>/<code>ws_select</code>/<code>ws_button</code> fields, and the topbar gear is a stock <code>ws_icon_button</code>.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.90: The lifecycle strip catches up to the fourth phase</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>ws_lifecycle()</code> now renders all four workshop phases</strong>: Strategize, Plan, Facilitate, Synthesize, matching the vocabulary <code>ws_wl_journey()</code> already uses in the workshop listing. The component previously still spoke the retired three-step reading (Designed, Delivered, Synthesized) even though nothing calls it: a documented design-system component teaching a lifecycle the product no longer has would mislead anyone building from it. The retired three values are kept as aliases (<code>designed</code> &rarr; <code>plan</code>, <code>delivered</code> &rarr; <code>synthesize</code>, <code>synthesized</code> &rarr; <code>synthesize</code>), cheap insurance since this repository's working tree carries substantial uncommitted work that a plain grep of committed code cannot see.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The strip wraps instead of overflowing at narrow widths.</strong> <code>.ws-lifecycle</code> and <code>.ws-lifecycle__steps</code> gained <code>flex-wrap: wrap</code>, a <code>max-width: 100%</code> ceiling, and a <code>row-gap</code> token for the wrapped state. The old single-row layout held three steps at any width but pushed a fourth off the edge of a 375px viewport.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.89 &mdash; The unified shell, rehearsed in mockups</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Record-strand mockup set</strong>: 24 tokens-only HTML states at <code>synthesize/mockups/record-strand/</code> (contact sheet at <code>index.html</code>) rehearsing the unified app shell: white global header, dark icon rail, red per-app bar, and a bottom action rail. Every value is a <code>var()</code> against <code>platform-tokens.css</code>, so the mockups cannot drift from the system. The shell patterns (<code>ws-global-header</code>, rail-variant sidenav, <code>ws-app-bar</code>, <code>synth-action-bar</code>) are candidates for promotion to <code>ws_*</code> components when the strand is built.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.88 &mdash; Every card is one size, and the check that keeps it that way</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>ws_choice_card()</code> and <code>ws_choice_cards()</code></strong>: one way into a task, offered beside the others. Icon, title, a sentence of what you get, and a foot carrying the time cost and the action. Three pages were each carrying their own copy of this markup and CSS — Plan's home, the planner home, and the builder's empty canvas — and the copies had drifted: 20px padding against 18px, a link-styled call to action against a filled button. One component now, with a <a href="components/demos/choice-card.php">demo page</a>.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The card is a real control.</strong> The old markup was a <code>&lt;div role="button"&gt;</code>, which looks like a button and does nothing on Enter unless you write the key handling yourself, and nobody had. It renders as a <code>&lt;button&gt;</code>, or an <code>&lt;a&gt;</code> when you pass <code>href</code>, and brings the behaviour with it.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>--card-padding</code> now means something.</strong> It was declared at 24px and read by nothing while every page-level card drew itself at 20. The token moves to 20 — the value the cards were actually at — and <code>--card-padding-compact</code> (12px) joins it for dense rows like the planner's library. <code>.wl-card</code>, <code>.listing-card</code>, <code>.library-card</code> and <code>.ws-card--content</code> now read the card tokens instead of hardcoding their own geometry.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Check 4 in <code>check-drift.php</code></strong>: a card rule that sets <code>padding</code> or <code>border-radius</code> with a literal instead of a token fails the build. Ratcheted against <code>card-geometry-baseline.json</code>, which grandfathers the 124 literals that predate the tokens — they show as a WARN count, and shrink as cards are repointed. Nine self-test fixtures cover what counts as a card: BEM modifiers and pseudo-classes do, <code>__element</code> classes and <code>.card-shelf</code> do not.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.87 &mdash; The Synthesize action rail, and a note that changes its mind</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>ws_synth_action_bar()</code></strong>: the stone rail that closes an empty Synthesize surface. A note pinned at the left says what the room should have brought back; the one way in sits at the right, rendered through <code>ws_button()</code> rather than hand-cut. Built from the <code>synth-action-bar</code> frame, which is now a component in Figma too.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>The note rotates.</strong> One nudge covers one situation, and a reader with nothing to synthesize is rarely stuck for the reason the first note names, so the bar cycles its set every 12 seconds instead of repeating itself. Hovering or focusing holds the current note, a hidden tab stops the clock, and under <code>prefers-reduced-motion</code> nothing moves at all. Pass your own <code>notes</code>, or one note to make it stand still.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The note is paper, not handwriting.</strong> The mock set it in Marker Felt; the platform has two families and this is not one of them, so the sticky reads as a sticky through the tilt, the amber paper, and the soft shadow, with the text in Inter. Colours all resolve to existing tokens: <code>--color-warning-very-light</code> paper, <code>--color-warning-light</code> edge, <code>--color-ink-secondary</code> ink, <code>--color-ink-faint</code> rail.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.86 &mdash; The app bar learns which app it is in</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>'state'</code> option</strong> on <code>ws_app_bar()</code>: <code>strategize</code>, <code>plan</code>, <code>facilitate</code> or <code>synthesize</code>. Each supplies that app's centre (nothing for Strategize, the duration/date/start-time read-out for Plan, start-session and join-code for Facilitate, the Recap/Workspace switch for Synthesize) plus the shared action cluster, with Share replacing Continue in Synthesize. Built from the four bars drawn in Figma, which are now one component set there with a matching <code>state</code> variant.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>.ws-app-bar__control</code> and <code>.ws-app-bar__switch</code></strong>: the read-out and the segmented switch, promoted out of the planner's and Synthesize's own markup into the component. Both are translucent white, because they sit on the red bar rather than on a surface.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>A named state fills only what the caller left empty.</strong> Pass your own <code>center</code> or <code>actions</code> and they survive untouched. A state <em>inferred</em> from the shell's <code>?view=</code> is more cautious still, adding only the <code>.ws-app-bar--{state}</code> class: the existing callers pass their own actions, and a bar must never grow controls the page has no code behind.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>App Bar demo page</strong> at <code>/design-system/components/demos/app-bar.php</code>, showing the four states together.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.85 &mdash; The workshop listing learns its stage scope, and all three pages now share it</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>'stages'</code> option</strong> on <code>ws_workshop_list()</code>: the stages a given listing can actually contain, e.g. <code>['plan', 'facilitate']</code>. It drives the filter chips and the kanban columns together, so neither offers a stage that can never appear there. It deliberately does <em>not</em> touch a card's journey strip &mdash; that shows the workshop's whole life, and truncating it would misreport where the workshop is. Added when Facilitate exposed the inconsistency: hiding its chips because only two stages apply, while the kanban still drew four columns with two that could never fill.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>All three list pages now render from this one component</strong>, each configured to its own job rather than forked: Plan's "Recent workshop agendas" (in-planning only, six, grid and list), Facilitate's "Choose a workshop" (runnable only, scoped to two stages, with the kanban standing in for the retired Ready-to-run / In-progress tabs), and Synthesize's picker (all stages, per-row action by stage). Between them this retired three hand-cut card templates, three copies of the same fetch-and-render JavaScript, and the skeleton placeholders all three used to paint while waiting.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.84 &mdash; Synthesize gets a bottom rail: one place to commit</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>The Synthesize bottom rail</strong> (<code>app/css/synth-rail.css</code>, filled per screen by <code>syncRail()</code> in <code>synthesize.js</code>): context on the left, the screen's one commit action on the right. Intake's "Start synthesis" left the artifacts rail, review's "build the synthesis" left the end of a long scroll, and the extraction screen's Cancel left the content &mdash; all three now share one address. The rail owns no logic: its buttons re-dispatch the <code>data-act</code> values the delegated handler already had, so each action still has exactly one implementation.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>A surface outside <code>#synth-app</code> needs its own <code>data-act</code> listener.</strong> <code>render()</code> owns that node's innerHTML, so anything that must survive a re-render lives outside it &mdash; and the delegation bound to the root never sees those clicks. The topbar already carried its own binding for this reason; the rail shipped without one and its buttons rendered perfectly while doing nothing. Caught by the existing Playwright suite, and now covered by a test that asserts the click reaches the handler rather than that a screen changed.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Its own stylesheet rather than a block in <code>synthesize.css</code>, because the picker page does not load the tool's stylesheet and two copies of the rules would drift. Not fixed-position either: <code>.synth-shell</code> is already a flex column with a scrolling stage, so the rail is that column's last child and never covers the content above it.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.83 &mdash; The workshop listing gets its data layer, and Synthesize adopts it first</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_workshop_list_fetch($pdo, $userId)</code> returns every workshop a user can see, already normalized. It calls the same functions the two endpoints wrap &mdash; <code>getWorkshopList()</code> for lifecycle stage and the room's counts, plus one grouped join for duration and item count &mdash; so a page renders its rows in the HTML instead of painting a skeleton and filling it a round-trip later. The three list pages can now share one server-side read.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> An unknown item count renders as nothing rather than "0 items": <code>ws_workshop_list_normalize()</code> keeps a missing count as <code>null</code>, and the meta line omits it. Claiming zero when you mean "not known" is a different and wrong statement.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_wl_duration()</code> formats minutes as "2h" / "1h 45m" locally rather than borrowing <code>includes/data.php</code>'s <code>formatDuration()</code> &mdash; that file calls <code>loadFromDatabase()</code> at the bottom, so requiring it for a string helper would fire a full content load on every page that lists workshops.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Synthesize's home page is the first adopter</strong>: its "Ready to synthesize", "Working from something else?" and "Recent recaps" sections are replaced by the listing, and the page's list JavaScript is gone with them. Timeline is deliberately not among the offered views there &mdash; it groups by scheduled date and the Workshop Record carries no scheduled-at stamp yet, so every row would land in one undated bucket.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.82 &mdash; The workshop listing becomes one shared pattern</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>ws_workshop_list()</code></strong> (<code>app/includes/workshop-list.php</code>, styles in <code>app/css/workshop-list.css</code>, behaviour in <code>app/js/workshop-list-views.js</code>): one listing with four interchangeable views &mdash; grid, list, kanban by stage, and a timeline grouped by scheduled / recent / drafts &mdash; under one chrome of eyebrow, title, stage filter chips, view switcher and an "All workshops" footer. Built from the Figma <em>Recent workshops</em> frames; the file's three variables map exactly onto existing tokens (paper <code>#FAF7F2</code> = <code>--bg-paper</code>, <code>#C73E3E</code> = <code>--phase-learn-dark</code>, <code>#FEE2E2</code> = <code>--phase-learn-light</code>), so it introduced no new colour.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Server-rendered, unlike the three hand-cut lists it is meant to replace: every view is in the HTML and the switcher only toggles which is visible, so changing view or filtering by stage costs no fetch and no skeleton flash. <code>ws_workshop_list_normalize()</code> takes a <code>/api/plans.php</code> row plus <code>lifecycle_status</code> and maps it to the stage a workshop is ready <em>for</em> (<code>designed</code> &rarr; Plan, <code>delivered</code> &rarr; Facilitate, <code>synthesized</code> &rarr; Synthesize).</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Demo and tweaking surface at <code>/design-system/app-workshop-list.php</code>, carrying the Figma frames' own sample content plus the three per-page configurations. Not yet adopted by Plan, Facilitate or Synthesize &mdash; those three swaps are the next step.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.81 &mdash; Tokens must exist: the drift check resolves every var() reference</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>check-drift.php check 3</strong>: every <code>var(--x)</code> in shipped CSS must name a custom property defined somewhere real. The universe is all scanned sheets plus runtime-set properties (inline <code>--x:</code> in markup, <code>setProperty</code>, React computed style keys), because app-local token sheets and per-item inline values are legitimate here; what fails is a no-fallback reference to a property defined nowhere at all, the class where the declaration is invalid at computed-value time and silently resets. References carrying a fallback warn instead. <code>--self-test</code> runs the parser fixtures, including the historical <code>var(--space-7)</code> case that shipped a collapsed padding; accepted one-offs go in <code>$KNOWN_DRIFT</code> as <code>css-var:&lt;file&gt;:--&lt;token&gt;</code>.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> The 26 no-fallback references the first run caught: <code>--space-7</code> (taste buy strip), <code>--space-9</code> (workshop-record artifact icons), Facilitator's never-defined <code>--font-size-base/sm/xs</code> scale (29 declarations were inheriting instead of sizing), the orange card/badge family plus two legacy surface and ink names in <code>styles.css</code>, admin's <code>--admin-accent-*</code> variants, MyWorkshopr v3's neutral vocabulary, <code>--planner-primary-dark</code> &rarr; <code>--planner-red-dark</code>, <code>--color-amber-700</code> defined beside its existing <code>--color-amber-100</code>, the unused <code>.mw-svg-icon</code> mask block removed, and the bounce-in animation riding <code>--ease-out</code> now that the overshoot easing is retired.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Ported Synthesize renders at native scale inside the <code>/app/</code> frame: the frame's 0.8 zoom had shrunk the app's literal-px type and its rem-token <code>ws_*</code> labels alike, so <code>.app-shell .synth-shell { zoom: 1.25 }</code> composes back to 1:1 rather than compensating per component.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.80 &mdash; The stsh shell becomes a shared component</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>The phase-journey shell (top bar + dark rail + ruled canvas) is now shared chrome</strong>: markup in <code>includes/components/stsh.php</code> (<code>stsh_topbar()</code>, <code>stsh_rail()</code>, <code>stsh_sym()</code>), styles in <code>css/stsh-shell.css</code>, and a document-head layout at <code>includes/components/stsh-header.php</code> (registered in check-page's LAYOUT_FILES). Born in the Strategist; extracted when Synthesize adopted it. The Strategist's <code>st_*</code> helpers now delegate here, and the <code>/app/</code> frame deliberately never loads it &mdash; its own sidenav is the chrome there.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>.stsh-canvas--app</code> variant for viewport-locked tools: the canvas stops scrolling and hands its box to the app inside, keeping the app's own <code>#main-content</code> sizing rules working unchanged.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.79 &mdash; Synthesize's results screen finishes adopting shared platform chrome</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The metadata-first "New synthesis" modal, source toolbar, flat/triage review, five-tab result board, Kanban/Outline theme layouts, persistent source rail, and side-panel AI are removed with their dead CSS</strong> &mdash; each had no remaining caller once the recap-first redesign shipped (Tasks 2&ndash;10). The legacy internal home/gallery is <strong>not</strong> among them: it is retired from the in-shell experience only (the "Your syntheses" control and the Back-past-earliest-stage path now redirect to the <code>/app/</code> product home instead of rendering it) and is retained solely as the standalone <code>synthesize/app.php</code> entry's legacy/anonymous landing and boot-failure fallback. What's left carrying the in-shell screen is entirely shared platform pattern: the <code>ws_app_bar</code>, the <code>.ws-tabs</code> component driving Workspace's own tab bar, the <code>.recap-*</code>/<code>.ev-*</code> evidence-card family, the platform focus-ring token on every disclosure and tab control, and the existing responsive rules. No new shared component was added here &mdash; this closes out adoption of ones already in the system, not a new pattern.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>.ol-theme</code> and the rest of the retired Outline/Kanban/theme-card/card-menu selectors are deleted rather than left as unreferenced rules for the next design audit to re-flag.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.78 &mdash; The Workshop Thread graduates to a production page</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>The connected-workshop direction now renders at <code>/index-app.php</code> with production components.</strong> The root-owned responsive stylesheet and interaction script retain the Thread mockup's two-page hero, four-stage workflow, and accessible tab behavior while the real <code>ws_header()</code>, <code>ws_button()</code>, and <code>ws_footer()</code> supply the shared shell.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.77 &mdash; The run-sheet preview is a two-page stack</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The Workshop Thread hero layers the facilitator-notes page behind the agenda.</strong> Opposing token-based offsets expose the back page's dark rail while keeping the front page dominant; mobile narrows the spread so the stack stays inside the viewport.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.76 &mdash; The Workshop Thread hero shows the finished run sheet</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The landing mockup's hero artifact now uses the real Planner run-sheet preview.</strong> A token-based paper mount and restrained offset layer keep the tall export legible in the asymmetric hero, then remove the rotation and narrow the preview on smaller screens.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.75 &mdash; The Workshop Thread begins before the agenda</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The landing mockup's lifecycle now supports four connected stages.</strong> Strategize precedes Plan, Facilitate, and Reflect; the mobile stage switcher becomes a two-by-two grid so all four labels remain readable without shrinking the type.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.74 &mdash; app pages close on a 24px rail, not on the marketing footer</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>ws_app_footer()</code> &mdash; a 24px <code>--gray-400</code> rail</strong> (template <code>includes/components/app-footer.php</code>) that ends a page inside a sub-application. It holds nothing: no links, no signup, no copyright. A tool the user opened deliberately should stop when the content stops, and the previous ending was 2,500px of Level Up grid, newsletter CTA and dark brand bar below every workspace. Self-contained like the composite it replaces &mdash; it emits the token sheet, its own style block, and the toast/auth core, each once &mdash; because the Planner and Facilitator run their own CSS stacks and don't all load <code>components.css</code>. Carries <code>aria-hidden="true"</code>: an empty <code>contentinfo</code> landmark is one more thing a screen-reader user has to check and discard.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The routing is one test in one file, not a flag on every page.</strong> <code>ws_footer()</code>, a direct <code>components/footer.php</code> include and the legacy <code>includes/footer.php</code> all funnel through the composite template, so <code>if (ws_is_app_page())</code> at its top covers roughly 120 pages across sixteen apps without touching any of them. <code>ws_is_app_page()</code> matches the first request-path segment against <code>WS_APP_PATHS</code>, which mirrors the app inventory in PRODUCT.md §5 &mdash; adding an app is one string. Reading the request path rather than the script path is deliberate: under the built-in dev server the router owns <code>SCRIPT_NAME</code>, so the real page is only visible via <code>REQUEST_URI</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Marketing surfaces are untouched.</strong> The homepage, <code>/about/</code>, <code>/pro/</code>, <code>/solutions/</code>, <code>/help-center/</code> and <code>/changelog/</code> keep the full composite &mdash; the Level Up grid and the newsletter CTA are how those pages earn their keep, and the rail would cost signups. The split is by path, so an app's own landing page (<code>/planner/</code>, <code>/facilitator/</code>) takes the rail with the rest of its app.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Documented at <code>components/demos/app-footer.php</code></strong>, with the Footer demo now linking to it instead of repeating the stale claim that app shells run footer-less. Both demos are in the sidebar; Footer had never been listed. DESIGN.md §12.7 replaces its "app-shell exception" with the app rule.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.73 &mdash; /app/ renders at 80% via zoom, not via redeclared tokens</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>body.app-shell</code> takes <code>zoom: 0.8</code>.</strong> This is the second attempt at a smaller frame and it is deliberately the other mechanism. <code>zoom</code> scales the rendered result, so every proportion inside stays the one the design system specifies and the frame is simply drawn smaller; redeclaring tokens at a fraction (v2.9.68, reverted in v2.9.71) rounds each token independently, so a 2px hairline and a 48px gutter shrink by different ratios and the relationships drift &mdash; which is what made 0.67 read as broken rather than small. It also composes with the reader's own zoom instead of replacing it: a reader at 125% sees this frame at 100%. And one property reverses it, where the token pass needed two stylesheets, 128 <code>var()</code> fallbacks and 45 literals put back.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The body height is <code>125dvh</code>, not <code>100dvh</code>.</strong> <code>zoom</code> scales the box after layout, so <code>100dvh</code> is drawn at 80% of the viewport and leaves a fifth of the screen blank under the frame; 100 / 0.8 fills it exactly. This is the one real cost of the approach, and any viewport unit added to these stylesheets needs the same treatment. Verified: the frame bottom sits flush with the window, and the launcher scrim still covers the full viewport despite the zoomed containing block.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The workshop card takes a <code>#A8A29E</code> border in the shell</strong> &mdash; <code>--gray-400</code>, four steps up from the <code>--gray-200</code> it had, so the card reads as a drawn edge on the drafting paper rather than a hairline that dissolves into it. <code>.dash__row</code>, <code>.lp2-card</code>, <code>.fach-card</code>, <code>.synh-card</code> and <code>.synh-pickup</code> are one object seen from five places, so they are named together in <code>app-shell.css</code> rather than edited in four files &mdash; which also leaves the standalone pages on the <code>--gray-200</code> they share with the rest of the site. <code>.dash__viz</code>, <code>.dash__ftrack</code> and <code>.dash__empty</code> keep the neutral border: they are panels, not workshops.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The dashboard row's hover no longer runs backwards.</strong> That hover was tuned to lift <code>--gray-200</code> to <code>--gray-300</code>; against a <code>--gray-400</code> rest state the same rule <em>lightens</em> the edge, so the card receded at the moment it lifted. <code>.app-shell .dash__row:hover</code> takes <code>--gray-500</code> and keeps the direction the interaction was designed around. It is the only one of the five whose hover touches the border; the rest move transform and shadow.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Synthesize's hero eyebrow carries a BETA marker</strong> &mdash; <code>.app-hero__beta</code>, inside the <code>.app-hero__eyebrow</code> pill rather than beside it. As a sibling pill it read as a second eyebrow: same outline, same fill, so the eye had to read both to learn one was a status. Inverted and tucked inside, it is unmistakably a marker on the section name, and solid <code>--phase-learn-dark</code> carries white at 4.98:1 where the eyebrow's own light fill would have put 10px text at 3.49:1.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.72 &mdash; The shell's header bar is 48px, and it is a layout decision, not a scalar</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>body.app-shell > .wsh-header</code> is 48px with 20px gutters</strong>, down from the component's 64px and 24px. Inside the shell the bar carries a brand, two icon buttons and an avatar &mdash; the nav, section tag and switcher are hidden &mdash; so it is an app title bar, not the site's navigation band, and 64px gave a row of chrome the height of a content card.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The controls come down to 32px</strong> (mark, icon buttons, avatar), radius 9&rarr;8px, mark glyph 22&rarr;20px, wordmark 18&rarr;16px. 36px boxes in a 48px bar leave 6px of clearance, which reads as a bar too short for its contents; 32px restores a clean 8px, measured. The icon glyphs inside the buttons are untouched &mdash; the target tightens, not the icon.</li>
            <li><span class="changelog-tag changelog-tag--deprecated">Note</span> <strong>This is the shape v2.9.71 said a density change should take.</strong> One region is resized and its contents fitted to it, so the bar reads as deliberately compact; the 0.67 pass that preceded it applied a scalar to the whole token set and read as a zoomed-out page. Restated in <code>app-shell.css</code> rather than the component because <code>ws_header</code> draws itself in literal px with no height token to theme.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.71 &mdash; The shell's 0.67 density is reverted; /app/ renders at platform scale</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The <code>body.app-shell</code> token block is gone.</strong> v2.9.68 redeclared spacing, radii, the type scale and icon sizes at 0.67 to correct a frame judged too large. What it produced read as a permanently zoomed-out page: <code>--text-body</code> resolved to 0.67rem against the platform's 80% root, so body copy painted at 8.6px. The tokens are inherited from <code>platform-tokens.css</code> again, which restores every <code>ws_*</code> component rendered inside the app at once.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The literals that were scaled to match are back too</strong> &mdash; 128 <code>var()</code> fallbacks across <code>app-shell.css</code> and <code>dashboard.css</code>, plus 45 bare values in the dashboard and the shell's launcher, hero and onboarding. Borders, outlines, focus offsets and breakpoints are untouched, because they were never scaled down.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The <code>ws_header</code> override block is deleted rather than rewritten.</strong> It existed only to restate the header at 0.67 in the literal px the component draws itself in; with the shell at platform scale the header renders at its own 64px, which is the point. The nav, section tag and switcher stay hidden &mdash; that is composition, not sizing.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The rail returns to its documented 108px</strong> with a 56px indicator, 64px destination height, 24dp icon and 12px label &mdash; the figures its own comment describes, which the 0.67 pass had left the comment out of step with.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The content column returns to 1131px</strong>, and the sentence step's 992px override is removed with it: that cap existed to widen the step against a 758px column and would now be pinning it narrower than the page it sits on. The sparkline keeps its 316px cap &mdash; that makes a user unit a pixel and is independent of the density question &mdash; and its labels go back to 10.5 and 12 units.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.70 &mdash; The section hero opens on 48px, not on the content padding</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>.app-hero</code> takes <code>padding-top: 48px</code>, and Strategize's <code>.st-hero</code> takes it inside the shell</strong>, so all four sections open on the same gap above the pill. The pill had been sitting on <code>.app-shell__content</code>'s 16px alone, which read as the page starting mid-scroll rather than at its top.</li>
            <li><span class="changelog-tag changelog-tag--deprecated">Note</span> <strong>48 is a literal, not <code>var(--space-12)</code>.</strong> The shell declares its spacing scale at 0.67, so the token would have rendered 32px; the figure here is the one measured on screen. Any future convergence of <code>.st-hero</code> onto <code>.app-hero</code> inherits it from the one rule.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.69 &mdash; The sentence step opts out of the shell's reading measure</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>.app-shell__content</code> widens from 822px to 1056px on the Strategize sentence step</strong>, taking the madlib card from 758px to the 992px it renders at standalone (the app's own 1040px page less its 48px gutters). The cap is a reading measure and the sentence is not prose &mdash; it is six inline controls read across a line, and at 758px it wrapped mid-clause into short ragged lines. Selected with <code>:has(#stSentencePage)</code> rather than a new body class, so the other four Strategize steps, which are prose and cards, keep the 822px measure untouched.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The hero sub on that step takes a 62ch measure</strong> &mdash; the same figure <code>.app-shell__lede</code> uses &mdash; so the copy above the card does not stretch to the card's new width. Widening a container widens everything in it; the measure has to move down to the prose that still wants one.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.68 &mdash; The app shell encodes its density instead of relying on browser zoom</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>/app/</code> renders at 0.67 of the platform scale, stated in CSS rather than reached by zooming out.</strong> The shell had been drawn ~1.5&times; too large and only read correctly at 67% browser zoom. A forced <code>zoom</code> was rejected: it overrides the reader's own zoom instead of composing with it, and media queries keep measuring the unscaled window, so every breakpoint fires at the wrong width. Instead <code>body.app-shell</code> redeclares the spacing, radius, type and icon tokens at 0.67, which carries every <code>var(--space-4, …)</code> in <code>app/css</code> and every <code>ws_*</code> component rendered inside the app; the 229 literal px in those two files are scaled to match. Scoped to the shell's own <code>&lt;body&gt;</code>, so nothing outside <code>/app/</code> moves.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>ws_header</code> is scaled to match inside the shell.</strong> The component draws itself in literal px in its own <code>&lt;style&gt;</code>, so the token scale cannot reach it and it would otherwise sit a third larger than the frame under it. <code>app-shell.css</code> restates the pieces the shell actually shows &mdash; height 64&rarr;43px, brand mark and icon buttons 36&rarr;24px, the account menu &mdash; and skips the nav, tag and switcher, which the shell already hides.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The dashboard sparkline's labels were painting at twice the surrounding text.</strong> Its sizes are SVG presentation attributes in user units, so a stretched chart magnifies them: at full column width a 10.5-unit month label rendered at 15.9px beside 8px body copy. The attributes are scaled and the SVG is capped at its own 316-unit viewBox so it never renders above 1:1. This is the one place encoded density and real browser zoom genuinely differ &mdash; the grid columns are <code>fr</code>, so they keep their pixel width while their contents shrink, where zoom would have enlarged the CSS viewport instead.</li>
            <li><span class="changelog-tag changelog-tag--deprecated">Note</span> <strong>Breakpoints, border widths and focus rings are deliberately unscaled.</strong> Breakpoints map to real device widths and shrinking them would hand a 390px phone the desktop layout; a 0.67px hairline renders as a smudge; the focus ring is an affordance, not decoration. The cost of leaving breakpoints alone is that the shell collapses to its narrow layout slightly earlier than a zoomed browser would, which costs nothing because it collapses to a layout that works.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.67 &mdash; The app launcher adopts the coloured modal header</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The shell rail's active indicator inverts</strong> &mdash; <code>--ws-sidenav-indicator</code> moves from <code>--phase-learn</code> to <code>--phase-learn-light</code> and <code>--ws-sidenav-on-indicator</code> from <code>--phase-learn-light</code> to <code>--phase-learn-dark</code>, so a filled dark red glyph sits on a light red pill. The rail's active label takes the pill's light red too, so both halves of the state read as one thing. Themed entirely through the component's own token API in <code>app-shell.css</code> &mdash; <code>ws_sidenav</code> itself is untouched, and its default light-rail theme still applies wherever else it renders. Numbers: glyph 4.06:1 on the pill (past the 3:1 for a filled shape), rail label 12.6:1 on ink, up from the 4.01:1 it used to run at. The expanded variant wraps the whole row in the pill, so its 15px label sits at 4.06:1 &mdash; under the 4.5 text floor, up from the 3.13:1 this replaced, and recorded in the stylesheet rather than adjusted away.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The All applications launcher takes <code>ws_modal</code>'s coloured header.</strong> Same <code>--phase-learn</code> the Strategist passes to <code>headerColor</code>, same white title, same translucent close. It is bespoke markup rather than a <code>ws_modal</code> &mdash; it carries its own scrim, focus handling and rise animation &mdash; so this matches the component's treatment rather than replacing the dialog wholesale. Structure follows too: the panel drops its padding and clips, so the band runs full width and the corners cut it, and the scroll moves off the panel onto <code>.app-launcher__groups</code> so a long list travels under a header that stays put, which is the split <code>ws_modal</code> makes with a <code>flex-shrink:0</code> header over a scrolling body. The panel widens from 880px to 1040px at the same time: at 880 every one of the four phase columns wrapped its descriptions, which made four short lists read as one dense block.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The launcher's close is the platform's close again.</strong> It is a <code>ws_icon_button</code>, so it arrived in ghost chrome &mdash; grey border, near-white hover fill &mdash; which on a red band read as a white box with a white glyph lost inside it. It now matches <code>.ws-modal__close</code> on a coloured header exactly: no border, no fill at rest, a 70% white glyph, and a 10% white wash on hover. The quarter turn is <code>ws_modal</code>'s as well, and it turns the glyph rather than the button, so the X becomes a + and the button's own square does not move. Overriding the ghost hover needs <code>:hover:not(:disabled)</code> &mdash; <code>.ws-btn--ghost:hover:not(:disabled)</code> outranks a plain <code>:hover</code>.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.66 &mdash; Dashboard rows: stacked, on paper, marked by phase</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>.dash__row</code> is a full-width row again rather than a 199px two-up card.</strong> One column of long rectangles gives a "what next" queue a single left edge to scan down; the two-up grid made each entry a destination to weigh against its neighbour. <code>.dash__list</code> is a flex column, the row is one line of icon &rarr; body &rarr; pill with the pill taking the slack on <code>margin-left:auto</code>, <code>.dash__phases</code> runs horizontally and wraps, and the title is one ellipsised line at 16px. The narrow-screen grid that keeps the icon beside the title is unchanged, but its <code>.dash__cta</code> rule now matches the one-line rule's specificity &mdash; an auto margin beats <code>justify-self</code> and had stranded the pill on the far right of its own row.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>Every dashboard surface moves to <code>--bg-paper</code> from <code>--bg-surface</code></strong> &mdash; <code>.dash__row</code>, <code>.dash__viz</code> and <code>.dash__empty</code>. The shell already paints paper, so white cards floated a layer above the page; on paper they read as sheets on that desk, with borders and the hover lift doing the separating. <code>ws_task_checklist</code> carries its own white card, which reinstated the white inside the two panels that hold one, so it drops its background, border, radius and padding inside <code>.dash__journey</code> and <code>.dash__firstrun</code> and lets the panel be the card. Scoped to those two containers rather than changed at the component &mdash; MyWorkshopr's overview panel uses the checklist standalone and still wants the card, and its demo page is unchanged.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>.dash__cta</code> reads "Open" on every row</strong>, in both the recent and attention lists, replacing "Synthesize it", "Build the agenda" and "Run it". The destination is unchanged &mdash; each row still opens on its own unfinished step &mdash; but the phase strip beside the button already names where the workshop is, and a button naming it again in different words could only disagree.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The row's icon names the phase the workshop has reached</strong> &mdash; the furthest <code>done</code> in journey order, not its lifecycle stage. Marks are the shell rail's own, so a row and the rail agree: Strategize <code>knight</code>, Plan <code>calendar_view_day</code>, Facilitate <code>co_present</code>, Synthesize <code>lightbulb</code>. Strategize was <code>lightbulb_2</code> in the rail, a near-twin of Synthesize's bulb; it is the knight in both now, which also picks up the <code>knight-fill.svg</code> active state added in v2.9.64.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Facilitate rows rendered an empty icon tile.</strong> <code>co_present</code> is font-only and <code>icon()</code> returns an empty placeholder for it &mdash; the same trap <code>ws_button</code> hit in v2.9.65. <code>appDashboardIcon()</code> in <code>app/includes/dashboard.php</code> takes the SVG when there is one and lets the font draw the ligature otherwise.</li>
            <li><span class="changelog-tag changelog-tag--deprecated">Retired</span> <strong><code>.dash__q</code> is retired and its CSS deleted.</strong> The quick action was a tinted borderless pill, deliberately quieter than the hero, sized for a row of three. The row is two now &mdash; New workshop and Run a session, after "Pull a rescue card" moved out to the rail where it belongs &mdash; and at two they are the only ways into the day the page offers, which makes them calls to action rather than shortcuts past it. Both are <code>ws_button</code> primary, so the dashboard carries no bespoke button CSS at all. <code>.dash__quick</code> stays as the flex row that lays them out; the promotion ledger on <code>design-system/redesign/dashboard.php</code> records the pattern as retired rather than candidate.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.65 &mdash; ws_button: an icon name without an SVG no longer renders a gap</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>ws_button()</code> drew a blank space wherever the icon name had no local asset.</strong> The Material Symbols set is far larger than <code>images/icons/</code>, and <code>icon()</code> returns an empty <code>&lt;span&gt;</code> placeholder for anything it cannot find — so <code>co_present</code>, <code>lightbulb_2</code> and the rest of the font-only names produced a button with a hole where its icon should be. The button now takes the SVG when one exists and lets the font draw the ligature otherwise, which is the same fallback <code>ws_sidenav()</code> has used since v2.9.64. Template: <code>includes/components/button.php</code>; no new classes, no markup change for icons that already resolved.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.64 &mdash; ws_sidenav: the active destination's icon fills in</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>The active item's glyph now renders in Material's filled style</strong>, per the M3 rail spec. The local SVG set is outline-only and its cutouts are wound for the default fill rule, so CSS cannot solid-fill it (tried, verified); instead a <code>{name}-fill.svg</code> asset wins when one exists, and everything else falls back to the Material Symbols font glyph with the <code>FILL</code> axis on, which the platform's font request already loads. <code>images/icons/knight-fill.svg</code> ships for the custom knight. Template: <code>$renderActiveIcon</code> in <code>includes/components/sidenav.php</code>; one new class, <code>.ws-sidenav__icon--filled</code>.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.63 &mdash; Dashboard patterns, registered before they are components</div>
    <div class="changelog-content">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><a href="<?= $ds_base ?>/redesign/dashboard.php">Redesign &rsaquo; Dashboard Patterns</a>: the promotion ledger for the shell home's vocabulary.</strong> The consolidated shell's dashboard ran ahead of the ws_* rule while its patterns were still moving; this page is the decision that they are design-system material. Four candidates &mdash; quick-action pill, attention row, hero card, funnel card &mdash; each shown live from <code>app/css/dashboard.css</code>, each mapped against the ws_* component it overlaps, with a stated graduation rule: a pattern that earns a second consumer becomes a <code>ws_*</code> helper; one that stays dashboard-only stays a pattern.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>The measurements travel with the patterns.</strong> Worst text contrast on the dashboard is 5.30:1 (dark red on the tint), the hero's decorative shapes sit at <code>z-index: 0</code> because <code>::after</code> otherwise paints over the title, and every font size is stated in px because the platform's 80% root font-size renders the rem type tokens a fifth small.</li>
        </ul>
    </div>
</div>

<!-- v2.9.60 -->
<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.62 — The Material 3 navigation rail, in Workshopr's colours</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>A <a href="<?= $ds_base ?>/redesign/index.php">Redesign</a> section in the design system.</strong> The app-shell redesign track: global, shipping components that belong to a direction still being worked out, documented apart from the established set. Same gates as everything else — Workshopr tokens, measured contrast, every state specified, enforcer clean.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>ws_sidenav()</code> — the vertical rail an app shell wears down its left edge.</strong> A standalone global component: it ships from <code>includes/components/helpers.php</code> like every other <code>ws_*</code> and works on any page, not just the Strategist. Built for the chromeless window, where there is no browser chrome and no horizontal platform nav, so the rail is the only way between apps. Template at <code>includes/components/sidenav.php</code>, styles under <code>.ws-sidenav</code>, documented at <a href="<?= $ds_base ?>/redesign/sidenav.php">Redesign &rsaquo; Side Navigation</a>. It pairs with <code>ws_app_bar()</code>: the rail moves you between apps, the bar acts on the open document.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Follows the Material 3 navigation rail for geometry and interaction</strong> — a pill-shaped active indicator, 24dp icons, a 56×32 indicator in the collapsed rail and a 56dp-tall pill when expanded, 60dp destinations, and state layers at 8%&thinsp;/&thinsp;10% rather than flat hover swatches. <strong>Colour is not Material's.</strong> Red Unification and <code>platform-tokens.css</code> outrank an imported palette, so M3's roles map onto ours: <code>secondaryContainer</code> → <code>--phase-learn-light</code>, <code>onSurfaceVariant</code> → <code>--color-ink-secondary</code>.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Two variants.</strong> <code>rail</code> (80px, label under the icon, indicator around the icon alone) and <code>expanded</code> (240px, icon beside label, the pill <em>is</em> the item container, inset 20px). Labels show in both, as M3 prescribes; the rail keeps a tooltip on hover <em>and</em> focus because Workshopr's destination names are longer than the short words an M3 rail assumes, and a truncated label must stay recoverable from the keyboard.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Two colour pairings failed AA and were caught by measuring rather than assuming.</strong> M3's <code>onSecondaryContainer</code> was first set to <code>--phase-learn-dark</code>, which measures <strong>4.11:1</strong> on the indicator — under the 4.5 floor for text this size. It is now <code>--color-ink</code> at 12.5:1, which is also the more faithful reading of M3, whose light theme puts a near-black tone on the tonal pill. The badge was <code>--phase-learn</code> at <strong>3.82:1</strong> against white; it is now <code>--phase-learn-dark</code> at 5.0:1.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Every state is specified and demoed:</strong> rest, hover, focus, pressed, active, disabled, badge, disclosure open/closed, and the rail tooltip. M3 ships no visible focus ring, so the platform's sky-blue one is kept on top of the state layer — a keyboard user needs it. Current-page never rests on colour alone: the indicator is a filled shape, backed by a weight change, <code>aria-current="page"</code>, and a <code>forced-colors</code> mapping to <code>Highlight</code>.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>images/icons/knight.svg</code></strong> — a chess knight for the Strategize entry, drawn to the house 24px / <code>0 -960 960 960</code> convention and checked for legibility down to 20px. The platform's own Strategist glyph is <code>strategy</code>, which has no local SVG; the knight is a deliberate substitution for this nav, not a replacement for it.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>A closed disclosure was still rendering its children.</strong> <code>.ws-sidenav__sublist { display: flex }</code> is a class selector, so it outranks the user-agent's <code>[hidden]</code> rule and the attribute silently did nothing. Restored with an explicit <code>.ws-sidenav__sublist[hidden] { display: none }</code> — worth remembering for any component that sets <code>display</code> on a element it also toggles with <code>hidden</code>.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Every M3 metric is now a CSS custom property</strong> — <code>--ws-sidenav-item-height</code>, <code>--ws-sidenav-indicator-w/h</code>, <code>--ws-sidenav-radius</code>, <code>--ws-sidenav-inset</code>, <code>--ws-sidenav-icon-size</code>, the label sizes, the state-layer opacities, and the four colour roles. A shell can retune the rail without forking it, and the defaults remain the M3 spec values.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>A <a href="<?= $ds_base ?>/redesign/sidenav-playground.php">playground</a> and a <a href="<?= $ds_base ?>/redesign/sidenav-preview.php?both=1">bare preview</a>.</strong> The playground drives those properties live and emits only the ones you changed as a copyable override block; it also reports the active and inactive contrast ratios as you pick colours, so a pretty pairing cannot ship unmeasured. The preview renders the rail full-height with no design-system chrome — the context it was actually built for — via <code>?variant=rail</code>, <code>?variant=expanded</code> or <code>?both=1</code>.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The rail clipped its own tooltips and grew a stray horizontal scrollbar.</strong> The list was set to <code>overflow-y: auto</code> with a comment claiming <code>overflow-x</code> stayed visible — CSS does not allow that, and computes the second axis to <code>auto</code> as soon as the first scrolls. Only the expanded variant scrolls now; the rail is <code>overflow: visible</code>, since a rail holding more destinations than fit is a content problem rather than something to hide behind a scrollbar.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Icon sizing uses <code>--icon-sm/md/lg</code> rather than the type scale — icons are not type, and the tokens already existed for exactly this.</li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.61 — The first illustrated hero, a rule about the mascot, and a background the model would not match</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Strategist gains a hero illustration in the platform house style</strong> at <code>/images/hero/strategist_hero.png</code> — a facilitator filling the last blank in her sentence, the unbooked room waiting empty behind the glass. Filed with the rest of the set in <code>images/hero/</code> under the <code>&lt;app&gt;_hero.png</code> convention. Matches the Facilitator / Pre-Read / Post-Workshop heroes: <strong>1344×768 (16:9), full-bleed monochrome red scene, populated workspace</strong>, presented full width under the hero copy at <code>--radius-2xl</code> with the same soft shadow as <code>.prk-hero-image</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>The house hero spec, written down:</strong> ~16:9 (1344×768 dominant, 1024×576 also in use), one warm red hue family over cream, mean saturation 0.33–0.47, full bleed, a real populated room. Measure a candidate against that saturation band before shipping — the image model consistently lands near 0.20, roughly half as saturated as the existing set, and reads washed out beside them.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>New rule, narrowing DESIGN.md §9: Nano Banana never stands in for the user.</strong> The first version of this hero cast the banana as the facilitator making the pitch, and was rejected — "it should never be the banana." §9's character remains right for ebook covers, chapter openers and emotional beats, but where an illustration depicts the person <em>using</em> Workshopr, draw a person. Prompts need an explicit "no fruit, no banana, no animal or food characters" ban or the model reintroduces one.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Two prompt lessons worth reusing: raster words must be drawn as abstract rounded bars of <em>varying</em> length to read as prose (uniform pills read as a form or progress bar, and any attempt at real lettering garbles — one draft produced "ru ama oi"); and the palette needs naming as a closed set, since an open brief let amber and gold in beside the salmon.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The image model will not honour an exact background hex.</strong> Asked repeatedly for a flat <code>#FAFAF9</code> ground, it returned a warm cream <code>#FBEDD9</code> every time — which would have read as a pasted rectangle against <code>--bg-page</code>. Resolved by knocking the background out to alpha with a border-seeded flood fill (contiguous only, tolerance 12), so the character's interior cream highlights and the ivory light wedge survive untouched. The asset now composites onto the page ground with no fringe. <strong>Reuse this approach for the next one — do not trust a hex in the prompt.</strong></li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>.st-land__hero</code> becomes a two-column grid (<code>minmax(0,1fr)</code> + <code>minmax(0,26rem)</code>); the old <code>max-width</code> moved to the new <code>.st-land__hero-copy</code>. Art is bare on the page — no card, border or shadow — and collapses to one column under 900px.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> 369&nbsp;KB → 170&nbsp;KB via <code>pngquant --quality 70-95</code>; palette PNG keeps full alpha. The illustration carries <code>alt=""</code>: it restates the <code>h1</code>, so announcing it would only repeat the headline.</li>
        </ul>
    </div>
</div>

<!-- v2.9.60 -->
<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.60 — The modal close twists, and the Strategist joins the component runtime</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>.ws-modal__close</code> now twists its icon a quarter turn on hover — <code>--duration-base</code> / <code>--ease-out</code> micro-motion, guarded under <code>prefers-reduced-motion</code>. Applies to every <code>ws_modal</code> platform-wide.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> The Strategist header now loads <code>components.js</code> — it always had <code>components.css</code> but not the runtime, so <code>wsModalOpen</code>/<code>wsModalClose</code> (focus trap, inert background) didn't exist there. Its "Other…" sentence modal is the first consumer, using the <code>headerColor</code> red header per the modal demo.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>strategist.css</code> polish pass: panel hints and the practice page's reading text sit at <code>--text-body</code> (labels stay small); <code>.st-toolnav</code> retired with its markup; the exit strip steps up to <code>--text-h2</code> with a <code>--mainsite-dark</code> border; the generated 60-second pitch renders as a <code>--mainsite-very-light</code> card; tool-card CTAs anchor bottom-right; <code>.st-panel__hint--wide</code> lets full-width panels run one line.</li>
        </ul>
    </div>
</div>

<!-- v2.9.59 -->
<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.59 — Strategist becomes six pages, and a max-width in the wrong unit</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>strategist.css</code> gains a marketing block (<code>.st-land</code>) for the new overview page, plus <code>.st-page--tool</code>, <code>.st-subhead</code>, <code>.st-navlink</code> and <code>.st-toolnav</code> for the tool pages. Platform tokens throughout; the only functional color is the unified Learn red.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>A <code>max-width: 40ch</code> on the landing hero crushed the whole column to roughly 320px.</strong> <code>ch</code> resolves against the element's <em>own</em> font-size, and the hero wrapper inherits body text (~16px) — not the display size its heading renders at. The cap now sits on <code>.st-land__title</code>, where <code>ch</code> measures in the display font and 17ch is the three-line hero it was meant to be.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Dead rules retired with the panel-toggle behaviour they served: <code>.st-tool[data-open]</code>, <code>.st-viewport[hidden]</code>, <code>.st-kit[hidden]</code>. Panels are pages now, so nothing toggles.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>.st-panel__title</code> is the <code>h1</code> on a tool page and is sized as one there; the print sheet learned the three new blocks.</li>
        </ul>
    </div>
</div>

<!-- v2.9.58 -->
<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.58 — A bare app-shell token collapsed the Facilitator layout in production</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>The Facilitator live dashboard rendered as one long scrolling column on production while looking correct on localhost.</strong> <code>--app-rail-width</code> arrived with the app-shell metrics and was consumed bare — <code>grid-template-columns: var(--app-rail-width) 1fr 300px</code>. A bare <code>var()</code> that resolves to nothing is invalid at computed-value time, so the whole declaration is dropped and <code>grid-template-columns</code> reverts to <code>none</code>; the agenda rail, script pane, and interventions rail then auto-placed into rows instead of columns. Reproduced in Chromium and verified fixed: with the token file blocked entirely the grid still resolves to <code>320px 804px 300px</code> with all three columns side by side.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> The same bare use existed in <code>synthesize.css</code> and <code>css/planner/base/_variables.css</code>, so Synthesize and Planner carried the identical latent collapse. All four uses now carry the <code>, 320px</code> fallback.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Why production only: the token reaches these files through <code>@import '/design-system/platform-tokens.css?v=…'</code>, and that hand-written stamp was never bumped when the app-shell metrics landed. Production serves CSS with <code>max-age=604800</code>, so a browser can hold a seven-day-old token file under an unchanged URL; the dev server sends no such header. The Facilitator stamp is bumped, but the fallback is what makes the layout independent of it. Pages that stamp with <code>filemtime()</code> instead of a hand-edited date do not have this problem.</li>
        </ul>
    </div>
</div>

<!-- v2.9.57 -->
<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.57 — Every component page in the sidebar was a dead link</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>All 40 component links in the design-system sidebar were dead</strong> — and because <code>ds-header.php</code> is included on every design-system page, they were dead from every page, not just one. The nav listed each component as <code>components/&lt;name&gt;</code> while the pages actually live at <code>components/demos/&lt;name&gt;</code>; the router bounced the missing path to <code>/</code>, so clicking any component in the sidebar silently returned you to the homepage. The card grid on <code>component-library.php</code> was unaffected — it already used the <code>demos/</code> path, which is why the break was easy to miss.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> The nav <code>slug</code> now matches the real page path for components, as it already did for every other entry. It does double duty as both the link target and the active-state key, so all 47 demo pages had their <code>$ds_page</code> updated in step — verified that each of the 40 still highlights itself in the sidebar.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> The Button demo's example linked to <code>/workshops</code>, which does not exist; both the live button and its copyable code sample now point at <code>/library/workshops/</code>.</li>
        </ul>
    </div>
</div>

<!-- v2.9.56 -->
<div class="changelog-entry">
    <div class="changelog-date">August 2026</div>
    <div class="changelog-version">v2.9.56 — Toasts that wait for you, and a truly modal modal</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Toast auto-dismiss now pauses while hovered or focused</strong> (WCAG 2.2.1 Timing Adjustable) — the remaining time is kept across pauses and resumes when the pointer and focus both leave. Previously a toast with an action button could vanish mid-read or mid-Tab. Covered by <code>tests/toast-a11y.spec.js</code>.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>wsModalOpen()</code> now makes the page behind the dialog <code>inert</code></strong> — the focus trap stopped Tab, but screen-reader virtual cursors could still wander the background. Restoration is stack-safe (each modal restores only what it set) and the toast container stays live so toasts fired from modal actions still announce. Covered in <code>tests/modal-focus.spec.js</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>ws_alert()</code> / <code>ws_banner()</code> now document their HTML-slot contract</strong>: <code>$message</code> renders unescaped by design (callers pass <code>&lt;strong&gt;</code>, links) — user-supplied data must be escaped with <code>htmlspecialchars()</code> before passing. The call-site audit found every dynamic caller already does.</li>
        </ul>
    </div>
</div>

<!-- v2.9.55 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.55 — Sixty unnamed buttons, and a ratchet that was counting its own convention</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>60 icon-only buttons had no accessible name</strong> — a WCAG 4.1.2 Level A failure across 24 files. Every one now carries an <code>aria-label</code>. Worst concentrations: <code>includes/footer/modals.php</code> (11), <code>admin/banners.php</code> and <code>admin/system/banners.php</code> (6 each), <code>facilitator/app.php</code> (6). Note <code>icon()</code> emits a bare <code>&lt;svg&gt;</code> with no <code>&lt;title&gt;</code>, so <code>&lt;?= icon('close') ?&gt;</code> inside a button leaves it unnamed.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>check-page.php</code> counted <code>var(--token, #hex)</code> fallbacks as hardcoded hex</strong> — the same defect <code>ds-lint.mjs</code> had fixed in 8dcdacfe, so the page ratchet was firing on the codebase's own defensive convention. The rule now strips fallbacks before counting; a chunk carrying both a real hex and a fallback still reports the real one. Baseline re-derived: <strong>5,601 → 4,723</strong> violations across <strong>320 → 311</strong> files, with zero drift absorbed.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> The one genuinely alt-less image on the product surface — a JS-built reviewer avatar in <code>includes/ratings-ui.php</code> — now carries <code>alt=""</code> (decorative; the reviewer's name renders beside it). The audit's "94 missing alt" figure was a regex artifact: <code>&lt;img\b[^&gt;]*&gt;</code> truncates at the <code>&gt;</code> inside <code>?&gt;</code>, hiding any <code>alt</code> that follows a PHP attribute. Real numbers: 1,133 <code>&lt;img&gt;</code>, 40 without <code>alt</code>, 39 of them in ad creative, ebook HTML, or regex literals that merely contain the text <code>&lt;img</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> All eight <code>TODO: no token match</code> markers cleared from <code>components.css</code> with no visual change: <code>#7F1D1D</code> → <code>--toast-bg</code>, <code>#15803D</code> → <code>--color-green-700</code>, <code>#B45309</code> → <code>--color-warning-darker</code>, plus three comment-only deletions on lines already using tokens. Two were not stale but real token gaps (amber-50 <code>#FFFBEB</code> vs the orange-50 <code>--color-warning-surface</code>; the checkbox-card purple) and are now documented as such.</li>
        </ul>
    </div>
</div>

<!-- v2.9.54 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.54 — The shell arc's missing record, and the review fixes</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Retroactive record of the app-shell arc</strong> (this entry should have shipped with the branch, per the §15 rule the code review caught): <code>ws_app_bar</code> — the shared document bar under <code>ws_header</code> across Planner, Facilitator, and Synthesize; tokens <code>--app-bar-height</code>, <code>--app-rail-width</code> (320px unified rails), <code>--header-bg</code>, <code>--paper-grid-image</code>; <code>--bg-page</code> moved to <code>#FAFAF9</code> with the drafting grid; ~575 lines of shell CSS in <code>components.css</code>.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>DESIGN.md §12.8 written.</strong> <code>synthesize.css</code> and the <code>ws_app_bar</code> docblock cited a §12.8 that didn't exist. It now does: one anatomy, component-owns-the-shell ownership rule, title modes, the single save-state pill, action variants, and the slots-are-for-legacy-JS rule.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>tests/header-shell.spec.js</code> — the header migration's missing coverage: seven migrated pages assert exactly one <code>ws_header</code>, zero references to the retired header stack, zero stylesheet 404s; plus shell-token resolution (<code>--app-rail-width</code> = 320px).</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> The identical seven-property interactive transition, repeated verbatim eight times in <code>components.css</code>, is now one definition: <code>--ws-transition-interactive</code>. Byte-identical expansion, so no visual change is possible.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Change-narration comments rewritten as constraints per CLAUDE.md §0 in <code>academy/training/index.php</code>, <code>podcasts/index.php</code>, <code>includes/components/header.php</code> (×2), and <code>platform-tokens.css</code>.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Stale references to the deleted <code>global-header.php</code> removed from the Navigation demo's Files table and corrected in CLAUDE.md §11 Key Files.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Synthesize docs squared with reality: EVAL-BENCHMARK is now the true contract (36 fixtures, new <strong>category P</strong> row for P-01…P-04 photo/CV traps, High-severity threshold re-based); ROADMAP no longer claims the v2-cv baseline is "pending" (it's committed, from the 16 Jul pre-fix run) and flags that the post-C-01-fix eval run is not yet committed to <code>eval/reports/</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>synthesize.js</code>: both synthesis success paths now enter results through one <code>enterResults()</code> — the duplicated setState + draft-autosave tail can no longer drift apart.</li>
        </ul>
    </div>
</div>

<!-- v2.9.53 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.53 — The defects the doc pass turned up</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Modal focus never entered the dialog.</strong> <code>wsTrapFocus()</code> called <code>focus()</code> in the same tick as the <code>.is-open</code> class, but <code>.ws-modal-overlay</code> animates in from <code>visibility: hidden</code> and an unrendered element can't take focus — so the call was a silent no-op and focus stayed on the trigger, outside the trap it had just installed. New <code>wsFocusWhenVisible()</code> waits for the transition. One frame isn't enough: the overlay reports <code>visible</code> at frame 2 while still at <code>opacity: 0.01</code> and only becomes focusable once painted. Confirmed in headless Chromium, not the preview pane — the pane is itself <code>visibility:hidden</code> and can't measure this.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>wsModalClose()</code> now restores focus to the element that opened the modal, guarded on <code>isConnected</code>. Previously focus dropped to <code>&lt;body&gt;</code>.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>closable: false</code> now blocks Escape — the template emits <code>data-closable="false"</code> and the document handler honours it. Backdrop dismissal stays governed by <code>backdrop</code>.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>wsFilterBarRemove()</code> is now defined in <code>components.js</code>. The filter-bar template had called it since it shipped; nothing implemented it, so every chip remove threw a ReferenceError. Drops one query param, resets <code>page</code>, preserves the rest of the query string and the hash.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>ws_progress</code> omits <code>aria-valuenow</code> when <code>indeterminate</code>, per the ARIA spec — it was announcing a definite percentage for work of unknown length. Both progress animations now honour <code>prefers-reduced-motion</code>, matching <code>ws-skeleton</code>.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>aria-atomic</code> moved from the toast container onto each toast. On the container it told assistive tech to re-read the whole stack whenever one arrived.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>ws_prompt_select</code> renders a real <code>&lt;label for&gt;</code> instead of a <code>&lt;span&gt;</code> — the select had no accessible name, and clicking the prompt did nothing.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>ws_chip_input</code>'s add button falls back to an <code>aria-label</code> when <code>addText</code> is omitted, so the icon-only form isn't an unnamed button.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>tests/modal-focus.spec.js</code> covers all three modal fixes. Note <code>strategist/tests/sections.spec.js</code> is separately broken — it requires <code>js/modules/sections.js</code>, retired in v2.9.51 — so a bare <code>npx playwright test</code> fails before reaching anything else.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Corrected a claim in the previous entry's doc pass: <code>ws_chip_input</code>'s label <em>is</em> properly bound via <code>for</code>. The unbound-label finding stands for Form Row, Prompt Select, and the two card groups.</li>
        </ul>
    </div>
</div>

<!-- v2.9.52 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.52 — Every component page, one structure</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> All 47 pages in <code>components/demos/</code> rebuilt to the section order in <code>templates/README.md</code>: When to Use · Variants · States · Real-World Usage · Options · Accessibility · Tokens · CSS Classes · Files. Adoption was 0/47 before this pass — the template existed, nothing followed it.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Accessibility and Tokens sections on every component. Accessibility was present on 5 pages; Tokens on none. Each is written from the template and CSS source, not assumed — including the gaps.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Input</strong> documented <code>icon</code>, <code>iconPosition</code>, <code>state</code>, and <code>helper</code> — none are read by <code>input.php</code>. Its select example also passed flat <code>value =&gt; label</code> pairs, throwing <em>Cannot access offset of type string on string</em>; <code>ws_input(type: 'select')</code> wants a list of arrays, unlike <code>ws_select()</code>.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Navigation</strong> described a <code>data-property</code> attribute and <code>.property-switcher-*</code> / <code>.ps-*</code> classes that exist nowhere in <code>header.php</code>. Rewritten against <code>ws_header(?string $section, array $opts)</code>, the 17 section keys, and the real <code>.wsh-</code> prefix.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Accordion</strong> and <strong>Tabs</strong> documented arrow-key, Home/End, and roving-tabindex navigation; both JS inits bind <code>click</code> only. <strong>Modal</strong> claimed focus return to trigger and an inert background; neither is implemented. All now recorded as known gaps.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Filter Bar</strong> chips call <code>wsFilterBarRemove()</code>, which is defined nowhere in the codebase — every remove button throws a ReferenceError. Documented, with a working implementation in the usage example.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Unbound labels recorded on <strong>Form Row</strong>, <strong>Prompt Select</strong>, <strong>Chip Input</strong>, <strong>Radio Card Group</strong>, and <strong>Checkbox Card Group</strong> — each renders a visible label with no <code>for</code>, <code>fieldset</code>/<code>legend</code>, or <code>aria-labelledby</code>, leaving the control unnamed.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Retired phase hexes removed from <strong>Level Up Grid</strong> (<code>#0284C7</code>, <code>#7C4DFF</code>, <code>#10B981</code>), <strong>Navigation</strong> (plus <code>#F87171</code>, <code>#BE123C</code>), <strong>Button</strong>'s <code>var()</code> fallbacks, and <strong>Planner Inspector Rail</strong>'s theming advice. Every phase token resolves to <code>#E54D4D</code>.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Emitted-but-unstyled classes flagged where found: <code>.ws-badge__text</code>, <code>.ws-avatar--initials</code>, <code>.ws-tabs__label</code>, and Input's orphaned <code>.ws-input-wrap__icon--*</code> rules.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Undocumented options surfaced: <code>showHeader</code> and <code>scoreBadge.variant</code> on Energy Arc Card, <code>group_by_phase</code> and <code>phase_copy</code> on Level Up Grid, <code>meta</code> on Planner Card, and the phase variants on Banner. Energy Arc Card's <code>theme</code> default corrected from <code>dark</code> to <code>light</code>.</li>
        </ul>
    </div>
</div>

<!-- v2.9.51 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.51 — Strategist madlib rebuild</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>strategist.css</code> rewritten for the madlib screen: hero on the Display Text Pattern and a display-scale six-dropdown sentence own the first viewport, with three tool cards + full-width panels and a soft very-light-red exit bar below the fold. Platform tokens throughout; the page sits on the standard paper-and-grid background.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>.st-blank</code> is a documented strategist-local control (like <code>st-tabs</code> was): an inline sentence blank that <code>ws_input</code>/<code>ws_select</code> can't express — they render labeled block fields. Baselined in <code>check-page</code>; if a second app ever needs inline blanks, promote it to a <code>ws_*</code> component.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Retired the three-phase shell CSS (docbar, phase tabs, steplist, wizard nav, readiness meter, rail). The <code>st-brief</code>/<code>st-doc</code> document blocks stay — <code>brief-view.php</code> renders with them.</li>
        </ul>
    </div>
</div>

<!-- v2.9.50 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.50 — The icon-ligature sweep, finished (and a guard so it stays finished)</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> The remaining ligature-named controls in Synthesize: theme disclosure chevrons and theme overflow menus, which announced as <code>chevron_right</code> and <code>more_vert</code> — 22 of the 58 controls on the results screen, all sharing two names. New <code>disclosureAttrs(what, open)</code> emits the label and <code>aria-expanded</code> together, so a toggle can't ship a name without its state.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> A count rendered in its own span concatenates into the button's name — <code>&lt;span&gt;Themes&lt;/span&gt;&lt;span&gt;11&lt;/span&gt;</code> is announced "Themes11". Where a label and a badge sit in one control, give the control an explicit name with the separator restored.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Regression guard in <code>synthesize.spec.js</code>: it sweeps <em>every</em> visible control on the results screen and fails if any accessible name is a bare snake_case token. Catches new icon-only controls without needing a test per button.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Sweep result across the input, review and results screens: <strong>162 controls, none named by an icon.</strong> The rule this leaves behind — when a control's only content is <code>icon()</code>, it needs an explicit name; the ligature is not one.</li>
        </ul>
    </div>
</div>

<!-- v2.9.49 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.49 — Icon ligatures are not labels; disabled controls owe a reason</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>icon()</code> emits the Material Symbols ligature as real text, so any button whose only content is <code>icon('close')</code> announces as <em>"close"</em> — the wrong verb for a destructive control, and identical on every row of a list. New <code>removeLabel(kind, text)</code> in <code>synthesize.js</code> gives each of the seven per-row remove buttons a name carrying its own row's text, trimmed to 60 chars because these are read aloud in sequence.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Deliberately <strong>not</strong> fixed by marking every icon <code>aria-hidden</code>: plenty of controls here carry no other text, so hiding the ligature would leave them nameless. Label the control, don't silence the icon.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> A disabled control owes the reason it is disabled, in the place people look. Synthesize's Start button has two blocking conditions — too much material already explained itself in an alert; an empty tray explained nothing, and the adjacent hint talked about saving drafts, so the greyed button read as broken. The hint is now conditional and wired via <code>aria-describedby</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Placeholder names should look unfinished. "Workshop synthesis" reads like a real title, so a library of them was unsortable; the fallback now borrows the first source's name.</li>
        </ul>
    </div>
</div>

<!-- v2.9.48 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.48 — Synthesize overlays become real dialogs</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>overlay()</code> in <code>synthesize.js</code> now emits <code>role="dialog"</code> + <code>aria-modal="true"</code> on <code>.synth-modal</code> — the panel, not the backdrop, since the backdrop is the click-to-dismiss surface. One helper, so every Synthesize overlay gained it at once.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>wireOverlayA11y()</code> names each dialog from its own heading via <code>aria-labelledby</code> rather than a hand-maintained name→label map, and pulls focus in. Two traps worth knowing: several overlays lead with a <em>hidden file input</em>, which silently refuses focus — pick the first <em>visible</em> field and verify focus landed, or the dialog keeps focus on <code>&lt;body&gt;</code>. And because <code>render()</code> replaces <code>root.innerHTML</code> wholesale, focus must be restored on every render behind an open overlay, not just on open.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Escape closes the top overlay, with <strong>no</strong> exemption for focused fields. The usual "let the input's own Escape win" rule backfires here: focus lands in a field on open, so exempting fields meant Escape never closed the dialogs that have one — which is most of them.</li>
        </ul>
    </div>
</div>

<!-- v2.9.47 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.47 — Planner: name the keyboard model, and the recovery route per audience</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>.toast-undo-hint</code> in <code>css/planner/components/_modals.css</code> — the keyboard shortcut shown beside the toast's Undo button, quieter than the button so it reads as a hint rather than a competing action. Paired with an <code>.sr-only</code> spoken form, since <code>⌘Z</code> does not read well aloud.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> A toast action button is a mouse affordance. It mounts at the end of the document, focus is elsewhere, and it auto-dismisses — so a keyboard user cannot realistically reach it. When a toast offers recovery, state the shortcut too.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>#agendaItems</code> now carries <code>role="list"</code> + <code>aria-label</code>, and each item an <code>aria-describedby</code> naming the keyboard model. The description is deliberately one sentence: it is read on <em>every</em> focus, so the fuller wording lives in the visible Instructions panel instead.</li>
        </ul>
    </div>
</div>

<!-- v2.9.46 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.46 — ws_header: a nav href's fragment is part of its identity</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>ws_header()</code> compared nav items on path alone, via <code>parse_url(..., PHP_URL_PATH)</code>, which discards the fragment. Nine sections build anchor navs from absolute paths — <code>/synthesize/</code>, <code>/synthesize/#how</code>, <code>/synthesize/#app</code> — so all three collapsed to <code>/synthesize</code> and an <code>activeHref</code> of <code>/synthesize/</code> matched every one, lighting the whole nav. Matching now uses path + fragment.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Fragment items are excluded from path matching outright: the server never receives the anchor, so it cannot know which one the reader is on. Dropping them also leaves the fragment-less sibling as the unique match, where the group previously cancelled out as ambiguous and nothing highlighted.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Bare <code>#anchor</code> hrefs still resolve to <code>""</code> and never match — that is why sections written that way (<code>/sidekick/</code>) were already correct, and why the bug looked inconsistent across the platform.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>activeHref</code> must name the <em>nav item's</em> href, not the current page's URL. Both Facilitator session pages passed <code>/facilitator/app.php</code>, which appears nowhere in that nav, so they highlighted nothing despite a comment saying "highlight Run Session here".</li>
        </ul>
    </div>
</div>

<!-- v2.9.45 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.45 — ws_header: aria-current, and 'active' means CTA not location</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_header()</code> emits <code>aria-current="page"</code> on the nav item matching the current path or the page's <code>activeHref</code>. The red highlight was visual-only, so "you are here" never reached assistive tech.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Only one item can ever carry it. Anchor navs whose hrefs all resolve to a single path (<code>/synthesize/</code>, <code>/synthesize/#how</code>) light several items at once; the highlight tolerates that, the accessibility tree does not.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> The registry's <code>'active' =&gt; true</code> flag paints a section's <strong>call to action</strong> red — it is not a location marker, and <code>aria-current</code> deliberately does not follow it. Setting it on a plain destination lights two items with two different meanings, which is what happened on <code>templates.php</code>. Use <code>activeHref</code> for location.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> The <code>planner</code> section's default nav is now Planner / Templates / Saved Agendas, matching the four planner surfaces. It previously said "Launchpad", a name retired when that page became a 301 to <code>brief/</code>.</li>
        </ul>
    </div>
</div>

<!-- v2.9.44 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.44 — Planner: named the Energy score, retired the mixed badge row</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>.energy-arc__score-label</code> in <code>css/planner/components/_canvas.css</code> — a quiet caption naming the score pill, which otherwise rendered as a bare number discoverable only on hover. Carries <code>aria-hidden</code>, since the button's own <code>aria-label</code> already names the score; without it screen readers hear "Energy" twice.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>.lp2-option__badge</code> now appears once per row, on the featured card only. Three badges in the same slot encoded three unrelated axes — a recommendation, a method, and a price — so the row read as one comparison it wasn't. One slot, one meaning.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Quoted library counts must come from <code>workshopr_count_label()</code> (<code>includes/library-counts.php</code>), never a literal. Four planner pages had drifted to 300+/380+ against a 440-activity library; the helper's docblock already claimed to be the single source of truth, but the call sites had not adopted it.</li>
        </ul>
    </div>
</div>

<!-- v2.9.43 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.43 — Planner: undo control in the toast, named dialog close buttons</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>.toast-undo-btn</code> in <code>css/planner/components/_modals.css</code> — the Undo control inside the agenda delete toast. Inherits the toast's white-on-blue (~8.6:1), and uses <code>display: inline-flex</code> so <code>min-height/min-width: 24px</code> actually applies; on a plain <code>inline</code> button the min-height is ignored and the target lands under the WCAG 2.5.8 floor.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>modal-planner.php</code> now emits <code>aria-label="Close {title}"</code> and <code>type="button"</code> on <code>.red-header-modal-close</code>. One template, so all 15 planner dialogs gained a named close button; they announced as bare "button" before. The overlay already carried <code>role="dialog"</code>/<code>aria-modal</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Client-side field errors should reuse <code>ws_input()</code>'s own error markup — <code>.ws-field--error</code>, <code>.ws-input--error</code>, <code>aria-invalid</code>, and <code>&lt;p class="ws-field__error" role="alert"&gt;</code>. <code>setFieldError()</code> in <code>planner-home.js</code> mirrors it exactly rather than inventing a second error style.</li>
        </ul>
    </div>
</div>

<!-- v2.9.42 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.42 — Synthesize modals: entry animation belongs to opening</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>.synth-overlay</code>'s <code>synth-fade</code> and <code>.synth-modal</code>'s <code>synth-pop</code> restarted on every state change behind an open modal, because Synthesize re-renders by replacing the whole of <code>root.innerHTML</code> — the modal visibly flashed and reopened. New <code>.synth-overlay--settled</code> sets <code>animation: none</code> on an overlay that was already on screen when the render started (<code>snapshotOverlays()</code> in <code>synthesize.js</code>), so the animation only plays on the render that opened it.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Worth copying wherever a string-rendered surface re-mounts animated chrome. <code>.synth .menu</code> and the AI log (which already carries a comment about this) have the same exposure.</li>
        </ul>
    </div>
</div>

<!-- v2.9.41 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.41 — Synthesize frame: full-height rail, flush surface</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>.sy-rail</code> drops its border and radius and stretches to the full height of the frame (<code>.sy-app</code> moves from <code>align-items: start</code> to <code>stretch</code>). It is no longer <code>sticky</code>: a stretched element has nothing to stick to, so keeping the rail fixed under a long board would mean moving it outside <code>.synth-stage</code>.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Full height needed a definite-height ancestor chain. A percentage <code>min-height</code> resolves against nothing when every ancestor is <code>height: auto</code>, so <code>.synth-stage .synth</code> is now a flex column and <code>.wrap--app</code> / <code>.sy-app</code> pass height down with <code>flex: 1</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>.wrap--app</code> loses its top padding and trims the inherited 110px bottom pad to <code>--space-6</code>; <code>.sy-main</code> goes to <code>padding: var(--space-6) 0</code> so content runs the full width of the surface.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> The zero top padding has to be restated inside <code>@media (max-width: 640px)</code>, where <code>.synth .wrap</code>'s <code>padding</code> shorthand resets it at equal specificity.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>.prio-tray</code> moved below the matrix. Noted as a watch item rather than a clean win: the 2&times;2 is 543px tall, so a tray of several rows can fall below the fold on a 900px viewport.</li>
        </ul>
    </div>
</div>

<!-- v2.9.40 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.40 — Synthesize adopts the shared components</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Synthesize's private re-implementations of button, tab, badge, pill, alert, empty state and skeleton are deleted; the app emits the platform class names instead. <code>components.css</code> was already on every page via <code>includes/header.php</code> — the components were present all along, just unused.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>wsAlert</code>, <code>wsEmpty</code>, <code>wsSkel</code>, <code>wsBadge</code>, <code>wsPill</code> in <code>synthesize.js</code>, beside the existing <code>icon()</code>. They mirror the markup <code>includes/components/*.php</code> produces, because the PHP helpers can't be called from a client-rendered body. Keep them in step if those templates change.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> The <code>.tab</code> collision is gone rather than worked around. Synthesize needed an explicit reset of the global pill rule's radius, shadow, shimmer <code>::before</code> and hover lift — same specificity, decided only by source order. Adopting <code>.ws-tabs--underline</code> removed the reason for the reset.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Two loading messages were wearing <code>.empty</code>. They are transient status, not empty states, and now use <code>.load-hint</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> What stayed local is now only what carries data-driven colour: <code>.pri-badge</code> and <code>.cat-pill</code> set a background inline from app state, so the rules that remain do nothing but keep the text legible on top of it.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>.ws-skeleton</code> sets no <code>display</code>, so it must be emitted as a <code>&lt;div&gt;</code> — the <code>&lt;span&gt;</code> the old skeleton used would collapse to nothing.</li>
        </ul>
    </div>
</div>

<!-- v2.9.39 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.39 — Synthesize app guide + component gallery</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>design-system/app-synthesize.php</code> — the fourteenth App Guide, and the first to double as a component gallery. Synthesize renders every screen from JavaScript template strings, so it has no <code>ws_*</code> helpers to demo; the page renders its class names directly against <code>synthesize/synthesize.css</code>, which means editing that stylesheet moves the specimens with the app.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Forty specimens across nine groups, each shown in its real states — empty, loading, done, muted, error, and the degenerate cases (no notes, no owner, an overlong source name). Specimens are wrapped in <code>.synth</code>, since the whole stylesheet is scoped under it.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> A &ldquo;Swap Candidates&rdquo; section pairing each duplicated element with its platform equivalent: <code>.btn</code> ↔ <code>.ws-btn</code>, <code>.badge</code>/<code>.pill</code> ↔ <code>.ws-badge</code>/<code>.ws-pill</code>, <code>.empty</code> ↔ <code>.ws-empty-state</code>, <code>.guardrail</code> ↔ <code>.ws-alert--warning</code>, <code>.sy-skel</code> ↔ <code>.ws-skeleton</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>ds-header.php</code> gains a Synthesize entry under App Guides. Strategist is still missing from that nav — noted, not fixed here.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Recorded the one genuine platform gap the gallery surfaced: there is no shared segmented control, and Synthesize, Planner, and Facilitator each ship their own <code>.seg</code>. Flagged as the strongest candidate for a real <code>ws_segmented</code>.</li>
        </ul>
    </div>
</div>

<!-- v2.9.38 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.38 — Synthesize app frame: rail, working surface, AI panel</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>.sy-app</code> replaces <code>.sy-work</code> as the shell every Synthesize working screen wears: <code>var(--app-rail-width)</code> rail + <code>minmax(0, 1fr)</code> surface, widening to a third <code>340px</code> column for the AI panel above <code>1440px</code>. <code>.sy-work__main</code> is now <code>.sy-main</code> and keeps the drafting grid on <code>var(--bg-page)</code>.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>.sy-ai</code> — a panel that is a grid column on wide screens, a fixed right-edge sheet below <code>1440px</code>, and a bottom sheet below <code>1080px</code>. The sheet's top comes from <code>--synth-stage-top</code>, set once per open, so a fixed element can sit under chrome it can't measure.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>.sy-tools</code> / <code>.sy-tool</code> — a 38px icon rail with a hover tooltip, replacing the spelled-out <code>.sy-rail--add</code> column.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>.synth .tab</code> now resets the global <code>.tab</code> rule's pill radius, shadow, shimmer <code>::before</code>, and hover lift. Same specificity, so only source order was keeping them apart — Synthesize's tabs are an underline row and now say so explicitly.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Retired <code>.uni-drop</code>, <code>.act-table</code>, and <code>.dec-row</code> in favour of <code>.sy-drop</code>, <code>.act-card</code>, and <code>.dec-card</code> — the card forms survive a narrow column, the table did not.</li>
        </ul>
    </div>
</div>

<!-- v2.9.37 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.37 — Synthesize work surface on the page paper</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>.sy-work__main</code> keeps the drafting grid but takes <code>var(--bg-page)</code> (<code>#FAFAF9</code>) instead of the warmer <code>var(--bg-paper)</code>, so the centre column and the page behind it read as one sheet rather than two paper stocks.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>.sy-rail--add</code> is now a panel on <code>var(--bg-paper-dark)</code> (<code>#F0EBE3</code>) — the same wash the global header wears.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Both rails (<code>.sy-rail</code>) picked up the centre column's panel geometry — <code>1px solid var(--border)</code>, <code>--rCard</code> radius, <code>--space-5</code> padding — so the work screen reads as three panels of one family. Fill is the only thing that distinguishes them: grid paper in the middle, the darker wash on the controls, nothing behind the sources list.</li>
        </ul>
    </div>
</div>

<!-- v2.9.36 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.36 — Planner progress-header buttons on the red token</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>.progress-header-btn</code> (the History / Clean up / AI / Share / Export / Schedule / Delete cluster on the planner's agenda bar) takes its background from <code>var(--planner-very-light)</code> instead of a hardcoded <code>rgba(229, 77, 77, 0.08)</code>. Same red family, now a solid <code>#FEE2E2</code> that matches the soft fills used elsewhere on the platform.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Shared <code>?v=</code> stamp on every planner <code>@import</code> bumped to <code>20260726a</code>, per the rule in <code>planner-new.css</code> — the imports are cached for 7 days and the entry file's own stamp does not invalidate them.</li>
        </ul>
    </div>
</div>

<!-- v2.9.35 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.35 — Global header background token</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>--header-bg: #F0EBE3</code> in <code>platform-tokens.css</code> (mirrored as <code>backgrounds.header</code> in the JSON). The global header now sits a step deeper than the <code>#FEF7F1</code> page cream, so the chrome reads as its own band instead of bleeding into content. Same value the apps already carry as <code>--color-paper-dark</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>ws_header()</code> takes the colour from the token in both places it set the old hex — the <code>.wsh-header</code> rule and the inline <code>style</code> attribute the component emits (the inline one wins, so they have to move together). The <code>bg</code> option still overrides per call.</li>
        </ul>
    </div>
</div>

<!-- v2.9.34 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.34 — ws_skeleton workshop-card variant + reduced-motion guard</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_skeleton(['variant' =&gt; 'workshop', 'count' =&gt; 3])</code> — a placeholder that mirrors the saved-workshop card (name, meta row, lifecycle strip, footer action) at the same 12px radius / 18px padding / 12px stack gap the real card uses. <code>count</code> emits sibling cards so it drops straight into an app's own grid. Adopted on <code>planner/planner-home.php</code>, <code>facilitator/facilitator-home.php</code>, and <code>synthesize/synthesize-home.php</code>, replacing three "Loading your workshops…" text lines. New <code>.ws-skeleton-grid</code> helper for pages whose skeleton isn't already inside an app grid.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> The skeleton shimmer now stops under <code>prefers-reduced-motion: reduce</code> (the placeholder stays visible, holding its "content is coming" status) — an infinite loop is decorative motion per DESIGN.md §7.</li>
        </ul>
    </div>
</div>

<!-- v2.9.33 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.33 — ws_app_bar, one document bar for every tool shell</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_app_bar()</code> — the bar every app shell wears under <code>ws_header</code>. One anatomy: app label or document title, contextual controls, save state, action cluster. The component owns the shell (60px min-height, red gradient, Fraunces title, 36px action geometry, tooltips); apps pass only their own markup through the <code>leadSlot</code>, <code>center</code>, <code>trailLead</code>, and <code>trailSlot</code> slots. Template in <code>includes/components/app-bar.php</code>, CSS in <code>includes/components/components.css</code>, registered in <code>workshopr-design-system.json</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Adopted by all three tool shells, replacing <code>.planner-topbar</code>, <code>.synth-topbar</code>, and <code>.fac-app-bar</code>. Every id and class the apps' JS binds to was preserved; the superseded layout, title, action, and tooltip rules were deleted from the three app stylesheets rather than left to fight the component on cascade order.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Removed the dead <code>$header_variant = 'app'</code> / <code>$header_app_title</code> / <code>$header_app_actions</code> block from <code>facilitator/app.php</code> — an unfinished app-mode header nothing ever read.</li>
        </ul>
    </div>
</div>

<!-- v2.9.32 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.32 — Workshop Record architecture note linked from Decisions</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> The <a href="decisions.php">Design Decisions</a> page gained a <strong>Workshop Record</strong> section linking the architecture note (<code>docs/workshop-record.md</code>) and the self-contained, theme-aware diagram (<code>docs/workshop-record-diagram.html</code>). Explains the plan spine, the derived Designed → Delivered → Synthesized lifecycle that <code>ws_lifecycle</code> renders, and the federated read model — so the component's stages have a documented source of truth.</li>
        </ul>
    </div>
</div>

<!-- v2.9.31 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.31 — ws_lifecycle workshop journey strip</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_lifecycle()</code> component — a three-step workshop journey strip (Designed → Delivered → Synthesized). Options: <code>status</code> (<code>designed|delivered|synthesized</code>), <code>variant</code> (<code>compact</code> for card badges, <code>full</code> with an optional next-step <code>cta</code>). Template in <code>includes/components/lifecycle.php</code>, CSS in <code>includes/components/components.css</code>, demo at <code>design-system/components/demos/lifecycle.php</code>, registered in <code>workshopr-design-system.json</code>. Red Unification compliant: completed steps use the very-light red fill with full-strength border, pending steps are neutral outline — state is expressed by fill/weight, never by additional hues.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Adopted on MyWorkshopr workshop cards and the Planner's saved-workshops list, hydrated client-side from <code>GET /api/workshop-record.php?list=1</code> (lifecycle derived server-side; strips are absent, not broken, when the call fails).</li>
        </ul>
    </div>
</div>

<!-- v2.9.30 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.30 — Facilitator start-agenda adopts the Planner card</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>.fac-skeleton</code> shimmer primitive (transform-only animation, reduced-motion-safe) plus per-part skeleton layouts — <code>.picker-skeleton</code>, <code>.fac-sidebar-skeleton</code>, <code>.start-agenda-skeleton__*</code>, <code>.start-stat-skeleton</code>, <code>.fac-script-skeleton</code>, <code>.fac-panel-skeleton</code>, and generic <code>.fac-skel-line</code> width helpers. Emitted by the shared <code>FacilitatorSkeletons</code> JS builders so the live app and the <code>/facilitator/loading-states</code> gallery render identical markup.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>.fac-live__body</code> gained <code>grid-template-rows: 1fr</code> + <code>min-height: 0</code> (and <code>min-height: 0</code> on the three columns) so the left/right columns stretch full height instead of collapsing to a content-sized row.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>facilitator/css/facilitator.css</code> — the Session Start review list (<code>#start-agenda</code>) now reuses the Planner's <code>.agenda-item</code> card anatomy (type-coloured <code>.item-icon</code> square, <code>.item-time</code>, <code>.item-title</code>, <code>.item-duration-badge</code>) plus the shared <code>ws_activity_badge</code>. Class names mirror <code>css/planner/components/_cards.css</code> but the rules are scoped under <code>#start-agenda</code> so they never leak into the rest of the facilitator. Read-only: none of the Planner card's editing chrome (drag/delete/swap/edit) is carried over.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Facilitator type tint tokens <code>--fac-type-{exercise,icebreaker,break}-very-light</code> (<code>#EFF6FF</code> / <code>#ECFDF5</code> / <code>--gray-50</code>, mirroring the Planner's <code>--planner-*-verylight</code>). Applied as per-type card shading on <code>#start-agenda .agenda-item[data-type]</code> — very-light tinted background + full-strength type-colour border, matching the Planner canvas cards.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>.start-cta__btn--compact</code> no longer shrinks the button — the agenda-header "Start Session" now matches the hero CTA's size (the variant only keeps its header placement, not a smaller footprint). <code>.start-cta</code> is now <code>text-align: right</code> so the hero button shares the agenda's right edge with the header button.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>--fac-hero-gradient</code> retinted from maroon (<code>#3D0C0C→#6B1717</code>) to an ink gradient (<code>var(--color-ink)→var(--color-ink-secondary)</code>, <code>#2C2416→#5C5242</code>) for the start screen's dark hero banner; <code>--fac-hero-dark</code> (live dashboard timer bar) likewise retinted from <code>#3D0C0C</code> to <code>var(--color-ink)</code>. <code>.fac-nav</code> (live dashboard bottom bar) background changed from <code>--bg-surface</code> to <code>--fac-ink-faint</code>, with its tool buttons / note button / position / shortcuts text set to <code>--fac-ink</code> for contrast. Added the missing <code>--fac-ink-faint</code> token (<code>var(--color-ink-faint)</code>, <code>#A8A29E</code>) to the facilitator ink scale. <code>.fac-nav__tool-btn</code> (Polls/Reactions) and <code>.fac-nav__note-btn</code> (Quick Note) now inherit the <code>.fac-nav__btn</code> (Previous) treatment — white <code>--bg-surface</code> pill, solid <code>--gray-300</code> border, <code>--radius-lg</code>, <code>--text-meta</code> — so all nav buttons match. Free-floating bar text (<code>.fac-nav__shortcuts</code>, <code>.fac-nav__position</code>) set to white; the pill buttons keep ink labels since their backgrounds are white. Added <code>.fac-nav__btn:not(.fac-nav__btn--primary):hover</code> — the Previous button now hovers to the same red-accent state (<code>--fac-purple</code> border/text, <code>--fac-purple-very-light</code> fill) as the other nav pills; the primary Next button keeps its own red-fill hover.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>.fac-main</code> (live dashboard script panel) now paints the shared graph-paper grid (ink @ 6%, 24px cells over <code>--bg-page</code>) from <code>css/base/_backgrounds.css</code>, instead of a flat <code>--bg-page</code> fill.</li>
        </ul>
    </div>
</div>

<!-- v2.9.29 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.29 — Agenda Health Check app styles</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>agenda-check/agenda-check.css</code> — a deliberately thin app-shell sheet (<code>.ac-*</code>) covering only the topbar/shell layout, input screen, dropzone, analyzing spinner, and sign-in gate wrapper. The report itself reuses the already-loaded <code>components.css</code>, <code>_agenda-generative.css</code>, and the <code>.energy-arc-*</code> card from <code>prep.css</code> — no new CSS for the grade card, dimension bars, recommendation rows, or badges.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>.ac-grade__letter</code> — an additive Fraunces letter-grade flourish layered on the reused energy-arc card, with a one-time fade/settle entrance (<code>--duration-reveal-lg</code> + <code>--ease-reveal</code>) gated behind <code>prefers-reduced-motion</code>.</li>
        </ul>
    </div>
</div>

<!-- v2.9.28 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.28 — Icon set: calendar_view_day + right_panel_open</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> Added <code>calendar_view_day.svg</code> and <code>right_panel_open.svg</code> to <code>images/icons/</code> (official Material Symbols outlines, <code>fill="currentColor"</code>) — the <code>icon()</code> helper renders an empty span for missing files, which had left the Strategist doc-bar's rail toggle blank.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Strategist's "Open in Planner" CTA is now a <code>ws_icon_button</code> (primary, md) with a CSS <code>data-tooltip</code> + <code>aria-label</code> instead of a labeled <code>ws_button</code>.</li>
        </ul>
    </div>
</div>

<!-- v2.9.27 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.27 — Strategist joins the global header</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_header</code> gained a <code>strategist</code> section (Plan phase, <code>strategy</code> icon, "Strategist" tag) with Strategist / Plan Agenda nav, and a matching app-switcher entry under Plan.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> The Strategist page now renders <code>ws_header('strategist')</code> above its locked shell; the shell height accounts for the header (<code>calc(100dvh - 65px)</code>) so the window still never scrolls, and the header joins the app chrome hidden in print.</li>
        </ul>
    </div>
</div>

<!-- v2.9.26 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.26 — Strategist app-shell rework</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> The Strategist shell is now locked to <code>100dvh</code> with a grid-paper canvas: a doc-bar (editable workshop name, readiness pill + breakdown popover, save chip, Planner CTA) pins above an always-visible phase journey, with three independently scrolling bands beneath — no window scroll at any width.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Every phase (Buy-In, Scope, Details) now drives a master–detail step list from <code>StSections</code> beside a single-section editor, with tick marks for complete/touched sections replacing the old inline stepper.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> The brief rail became a tabbed collapsible panel (<code>.st-rail__tabs</code> — Brief / Documents) that switches to a fixed off-canvas drawer below 1100px, with roving-tabindex keyboard support (arrows/Home/End) on the tab pair.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> First-run guidance is now an in-shell start card rather than an overlay.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Below 760px the step list becomes a horizontal, scrollable chip row instead of disappearing off-screen.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Swept the dead <code>.st-wizard*</code> rule family (stepper dots, footer, print hide-list entries) left over from the pre-rework layout, plus the inert <code>.st-wizard__next--last</code> class toggle in <code>strategist.js</code> — neither had any surviving markup or styling effect.</li>
        </ul>
    </div>
</div>

<!-- v2.9.25 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.25 — Synthesize on the platform motion system</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Synthesize micro-motion now pulls from the shared tokens: buttons, icon buttons, action cards, add buttons, and dropzones transition with <code>--duration-fast/base</code> + <code>--ease-out</code>; modals enter with <code>--duration-enter</code> + <code>--ease-spring</code>; menus pop with <code>--duration-fast/base</code>. Reduced-motion zeroing comes free via the token overrides.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> The Synthesize landing hero uses the page-reveal regime (<code>--ease-reveal</code>, <code>--duration-reveal(-lg)</code>): title → description → CTAs cascade on load, transform+opacity only, with an <code>animation-duration</code> kill added to the landing's reduced-motion block.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>.uni-drop</code> variant of the Synthesize dropzone — a slim horizontal drop-anything target on the input screen (token-spaced, tscale-aware).</li>
        </ul>
    </div>
</div>

<!-- v2.9.24 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.24 — Synthesize landing + app fully tokenized; Red Unification comments corrected</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> The Synthesize landing (<code>.sy-land</code>) palette now aliases platform tokens (<code>--phase-learn</code> family, <code>--color-ink(-secondary)</code>, <code>--bg-page/surface</code>) instead of duplicating hex values; stale "red is a deliberate exception, like Intervention" comments in <code>synthesize/index.php</code> and <code>synthesize.css</code> rewritten to reflect Red Unification.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Remaining off-scale values in <code>synthesize.css</code> moved onto tokens: shadow/radius vars alias <code>--shadow-sm</code> / <code>--radius-sm/xl/2xl</code>, off-scale 7/28/36px spacing snapped to the 4px scale, the roadmap goal-card selection ring uses <code>--accentVL</code>, and the roadmap detail modal's red side-tab border became a quiet bordered wash.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Kanban card titles reference <code>var(--font-heading)</code> instead of a hardcoded font-family. All three Synthesize files now pass the enforcer with zero violations.</li>
        </ul>
    </div>
</div>

<!-- v2.9.23 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.23 — Footer consolidation: ws_footer(), tokenized canon, forks retired</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_footer()</code> wraps the global footer composite (Level Up grid · Letter CTA · brand bar) and is registered in <code>workshopr-design-system.json</code>; the composite gained a render-once guard so any include combination yields one footer. Documented in DESIGN.md §12.7 with the footer-less app-shell exception (Planner, Strategist) and the BEM naming rule.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> The canonical footer's 18 enforcer violations: hardcoded hexes replaced with <code>--bg-paper</code>, <code>--phase-learn(-light)</code>, <code>--bg-muted</code>, <code>--color-ink(-muted)</code>, <code>--text-inverse</code>, <code>--bg-surface</code>, and <code>--mainsite-gradient</code>; the raw Subscribe button is now <code>ws_button()</code>.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Footer legal line contrast: <code>rgba(255,255,255,.4)</code> → <code>.55</code> (3.67:1 → ≈5.8:1, AA pass) in both the composite and the legacy stylesheet.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>includes/footer.php</code> now renders the composite via <code>ws_footer()</code>, putting all legacy-footer pages on-canon; the survey fossil footers (3 files) and the Facilitator Bootcamp footer fork were retired.</li>
        </ul>
    </div>
</div>

<!-- v2.9.22 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.22 — Critique fixes: navy aliases retired, toast side-stripes removed, mobile nav</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Red Unification: the legacy <code>--primary-navy</code> and <code>--uh-color-navy</code> aliases now resolve to warm ink (<code>--color-ink</code>), retiring cold navy headings platform-wide; library category chips render brand red instead of raw DB Material hexes; the header's per-phase active-link colors and the purple BETA pill collapsed to the red family.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Toast variants and the facilitator callout dropped the banned side-stripe accent for full light borders on semantic surface tokens.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Both global headers (<code>gn-shell</code>, <code>wsh-header</code>) gained a mobile menu sheet (hamburger toggle, scroll lock, Escape/scrim dismiss, reduced-motion aware) replacing the nav that was <code>display:none</code> below their breakpoints.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>includes/library-counts.php</code>: canonical library counts with floors — the single source for every "N+ exercises" claim.</li>
        </ul>
    </div>
</div>

<!-- v2.9.21 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.21 — Strategist app CSS brought fully on-system</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>strategist/css/strategist.css</code> referenced text-size tokens that don't exist (<code>--text-sm</code>, <code>--text-lg</code>, <code>--text-2xl</code>…), so its font sizing silently inherited. Rebuilt on the real scale (<code>--text-h2/h3</code>, <code>--text-ui/small/meta/caption/micro</code>) during the document-centric redesign.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Strategist focus styles used red outlines; now the platform <code>--focus-ring</code> (sky-blue), the sole sanctioned non-red accent.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Strategist status/verdict surfaces now use the semantic surface tokens (<code>--color-warning-surface</code>, <code>--color-success-surface</code>) with text labels, per the color-has-meaning rule.</li>
        </ul>
    </div>
</div>

<!-- v2.9.20 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.20 — Motion cleanup: retire the bounce curve, add press feedback, scope transitions</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Purged the banned overshoot curve <code>cubic-bezier(0.34, 1.56, 0.64, 1)</code> (removed July 2026) from circulation: neutralized <code>--transition-bounce</code> in <code>css/tokens/_variables.css</code>, corrected per-app <code>--ease-spring</code> overrides (Tips, Podcasts, Academy, Tips v2) that had subverted the sanctioned token, and replaced the raw literals in <code>css/styles.css</code>, both <code>_modals.css</code> sheets, <code>participant.css</code>, and two planner pages with <code>var(--ease-spring)</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>ws_button</code> now has a <code>:active</code> press scale on the base class (covers all variants); global header icon buttons gained a press scale + transition.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Removed <code>transition: all</code> from the shared component library and the planner card/sidebar/modal sheets (~71 rules), scoping each to <code>transform</code>/<code>opacity</code>/color/shadow so state changes composite on the GPU.</li>
        </ul>
    </div>
</div>

<!-- v2.9.19 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.19 — Fix footer overriding secondary button borders</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Scoped the newsletter subscribe-button styles in <code>includes/components/footer.php</code> to <code>.cta</code>. An unscoped <code>.ws-btn { border: none }</code> was loading after <code>components.css</code> and stripping the red border from every <code>.ws-btn--secondary</code> on any page that renders the footer.</li>
        </ul>
    </div>
</div>

<!-- v2.9.18 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.18 — Red Unification: retire "plan blue"</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Repointed the legacy <code>--planner-blue</code> / <code>--planner-blue-dark</code> / <code>--planner-blue-light</code> aliases in <code>platform-tokens.css</code> to the Learn Red family, so surfaces that load only the platform tokens (e.g. <code>planner/index.php</code>) no longer render the retired plan-blue.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Cleared leftover sky-blue / violet accents in <code>css/planner/launchpad.css</code>, <code>css/planner/briefing.css</code>, and <code>planner/email-preview.php</code> that had only been half-converted to red.</li>
        </ul>
    </div>
</div>

<!-- v2.9.17 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.17 — iOS Companion app added to the design system</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> Added <a href="app-companion.php"><code>app-companion.php</code></a>, the per-app guide for the Workshopr Companion iOS app (React Native / Expo) — mobile palette with swatches, type scale, an iOS component inventory grouped by primitives / Run Mode / Capture / Cards, and an iOS patterns section covering safe areas, tactile press, Dynamic Type, and the "one home, two escapes" navigation model.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Added a <code>companion</code> entry to <code>apps</code> in <code>workshopr-design-system.json</code>, mirroring the shape of the existing app entries plus a <code>platform</code> note flagging it as a standalone native codebase with no CSS token.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Added <a href="mobile-ios.md"><code>mobile-ios.md</code></a>, a concise reference mirroring the tone of <code>theming.md</code>/<code>motion-system.md</code>, pointing to <code>workshopr-companion/DESIGN.md</code> and <code>src/theme/</code> as the code source of truth.</li>
        </ul>
    </div>
</div>

<!-- v2.9.16 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.16 — Strategist form-field borders</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Scoped a darker resting border on strategist form fields in <code>strategist/css/strategist.css</code>: <code>.st-app .ws-input</code> / <code>.ws-select</code> move from the platform-default <code>--gray-200</code> to <code>--gray-400</code>, with <code>--gray-500</code> on hover. Scoped to <code>.st-app</code> so the shared <code>ws-input</code>/<code>ws-select</code> components are unchanged platform-wide.</li>
        </ul>
    </div>
</div>

<!-- v2.9.15 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.15 — Strategist Buy-In wizard</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> Added <code>.st-wizard</code> stepper nav and <code>.st-wizard__footer</code> Back/Next bar to <code>strategist/css/strategist.css</code>, splitting the Buy-In phase's five <code>.st-section</code> blocks (in <code>strategist/includes/phase-buyin.php</code>) into wizard steps via <code>.st-step</code> / <code>data-st-buyin-step</code>. Active step uses <code>--phase-learn-dark</code> text on <code>--phase-learn-very-light</code> chip fill; a touched-but-inactive step gets a quieter <code>--gray-200</code> chip. Step transitions are a 200ms fade+4px rise (<code>.st-step--entering</code>), disabled under <code>prefers-reduced-motion</code>. Labels hide under 860px, numbers remain. Print stylesheet forces <code>[data-st-buyin-step]</code> visible and hides the wizard chrome, matching the existing hidden-phase-panel print pattern.</li>
        </ul>
    </div>
</div>

<!-- v2.9.14 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.14 — Strategist generated documents section</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> Added <code>.st-sidebar__section</code> / <code>.st-sidebar__heading</code> card and <code>.st-docs</code> button stack to <code>strategist/css/strategist.css</code>, hosting the new Documents section (Executive Summary, Facilitator Briefing, Risk Report, Agenda Blueprint) in <code>strategist/includes/sidebar.php</code> after the Workshop Brief preview. Generated output reuses the existing <code>.st-script</code> / <code>.st-skeleton</code> patterns from the Objection Coach; the section is hidden from print via the existing print stylesheet.</li>
        </ul>
    </div>
</div>

<!-- v2.9.13 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.13 — Strategist recommendation banner</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> Added <code>.st-reco</code> go/caution/not-yet recommendation banner to <code>strategist/css/strategist.css</code>, hosted at <code>#stRecommendation</code> in <code>strategist/includes/sidebar.php</code> directly above the readiness meter. Status is conveyed by a text label plus a bordered card (<code>--color-success</code> / <code>--color-warning</code> / <code>--gray-200</code>), never by color alone, per Red Unification.</li>
        </ul>
    </div>
</div>

<!-- v2.9.12 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.12 — Global footer Letter CTA form restyle</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Restyled <code>.cta__input</code> in <code>includes/components/footer.php</code>: solid <code>var(--bg-surface)</code> fields with ink text and <code>var(--shadow-xs)</code> replace the translucent white-on-brown inputs, and field focus now uses the platform sky-blue ring (<code>--focus-ring-color</code>) instead of a blush glow, per the focus-ring exception to Red Unification. Added <code>:focus-visible</code> ring to the footer's local <code>.ws-btn</code>.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> The footer now carries a scoped <code>.cta .sr-only</code> fallback so the form's screen-reader labels can't render as visible text on host pages that don't define the class.</li>
        </ul>
    </div>
</div>

<!-- v2.9.11 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.11 — Planner topbar Strategist readiness badge</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> Added <code>.topbar-strategist</code> / <code>.topbar-strategist-icon</code> / <code>.topbar-strategist-badge</code> rules to <code>css/planner/components/_topbar.css</code> for the planner topbar's Strategist handoff link — a quiet white link with a light-red readiness pill (<code>--phase-learn-very-light</code> ground, <code>--phase-learn-dark</code> text) that appears when the strategist has left a readiness pointer. Tokens only (<code>--space-1</code>, <code>--space-2</code>, <code>--text-micro</code>, <code>--radius-full</code>, <code>--planner-transition</code>); no hardcoded values beyond the topbar's existing white-on-red link convention.</li>
        </ul>
    </div>
</div>

<!-- v2.9.10 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.10 — Strategist standalone shared-brief page styles</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> Added <code>.st-app--brief-view</code> and <code>.st-brief--standalone</code> rules to <code>css/strategist.css</code> for the public read-only Workshop Brief page (<code>strategist/brief-view.php</code>): centered 720px column with token-based spacing and an unclamped brief body. Tokens only (<code>--space-6</code>, <code>--space-4</code>); no hardcoded values.</li>
        </ul>
    </div>
</div>

<!-- v2.9.9 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.9 — Tips category tints unified to brand red</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Completed Red Unification (D1) for Tips: the six <code>--tips-cat-1..6</code> category tints in <code>platform-tokens.css</code> were changed from the legacy purple ramp (<code>#4527A0…#B39DDB</code>) to a brand-red ramp (<code>#7F1D1D · #991B1B · #C73E3E · #E54D4D · #F87171 · #FCA5A5</code>), matching the Intervention/DNA red tint ramps and the already-red <code>app-tips.php</code> guide. Regenerated <code>tokens.dtcg.json</code>; drift check passes.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Tips app: the local <code>--cat-*</code> tokens in <code>css/tips/styles.css</code> (half-purple, half-red) and the <code>--tips-cat-*</code> fallbacks in <code>tips/index.php</code> are now the full brand-red ramp.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Migrated the live category colours: the 13 rows in the <code>tip_categories</code> DB table stored 7 distinct purples (the source of the category card/chip colours) — these were remapped to the brand-red ramp so the Tips feed and category pages render red instead of purple.</li>
        </ul>
    </div>
</div>

<!-- v2.9.8 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.8 — Launchpad choice screen heading alignment</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Launchpad heading: upgraded <code>.launchpad-choice-screen__title</code> (the "How would you like to build?" h1 page title) from <code>var(--text-h2, 1.5rem)</code> to standard <code>var(--text-h1, 32px)</code>, matching the premium page typography of other index headings across the platform.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Semantic Card Headings: changed launchpad choice card titles (<code>.launchpad-choice-card__title</code>, e.g. "Build from scratch" and "Generate with AI") from <code>div</code> tags to semantic <code>h1</code> tags and zeroed their margin-top in CSS to maintain design consistency and search engine metadata structure.</li>
        </ul>
    </div>
</div>

<!-- v2.9.7 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.7 — Saved Workshop & Schedule modal improvements</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Applied "Ink Muted" (<code>var(--color-ink-muted, #78716C)</code>) icon styling and neutral <code>var(--bg-muted, #F5F5F4)</code> backgrounds to saved workshop/agenda cards across both the Saved Workshops page (<code>planner/saved.php</code>) and the My Library section of MyWorkshopr (<code>myworkshopr/myworkshops.php</code>). Added precise CSS filters for inline <code>img.icon</code> elements to prevent raw black SVG fallbacks.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Meta Pills color: set all calendar meta-pills text and icon colors in the "Schedule Workshop" slide-out modal to pure white.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Energy Details panel: reduced the width of the expanded energy details dropdown panel (<code>.energy-detail</code>) by 25% (from 920px to 690px) to make the overall canvas layout feel more compact and polished.</li>
        </ul>
    </div>
</div>

<!-- v2.9.6 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.6 — Red Unification cleanup (guide pages + stray gradients)</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>app-tips.php</code> guide rewritten from the retired Facilitate purple (<code>#7C4DFF</code>) to the Learn Red family — identity swatches, philosophy cards, core palette, the six category tints, tab-strip demo, and Do/Don't now all read red. Notes that four legacy purple <code>--cat-*</code> tints still ship in <code>css/tips/styles.css</code> and are flagged for migration.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>app-hybrid.php</code> guide rewritten from the retired Plan blue (<code>#0284C7</code>) to the Learn Red family; the "Do" now points at <code>var(--phase-learn)</code>, matching the shipped <code>/toolkits/hybrid/</code> page.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Finished two half-migrated gradients — <code>collections-tabs.css</code> and <code>_sidebar.css</code> no longer blend brand red into leftover indigo (<code>#6366F1</code>); both are now <code>#E54D4D → #C73E3E</code>.</li>
        </ul>
    </div>
</div>

<!-- v2.9.5 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.5 — ws_task_checklist component (activation flow)</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_task_checklist</code> — progress-tracked task list for activation/setup flows (helper in <code>helpers.php</code>, template <code>task-checklist.php</code>, CSS in <code>components.css</code>, demo at <code>components/demos/task-checklist.php</code>). Items carry real-data done states, optional phase eyebrows, links on undone items, a dismiss hook (<code>data-checklist-dismiss</code>), and <code>data-task</code> keys for JS enhancement. Sky-blue focus ring, <code>:active</code> tactile feedback, 375px-safe. First consumer: the MyWorkshopr Getting Started checklist.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>.topbar-unsaved-pill</code> (planner <code>_topbar.css</code>) — quiet "Not saved" affordance for anonymous builders.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> JSON catalog + generated roster updated (55 components); <code>check-drift.php</code> passes.</li>
        </ul>
    </div>
</div>

<!-- v2.9.4 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.4 — Documentation consistency pass, round 2 (canonical docs + motion pair)</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>/DESIGN.md</code>: frontmatter <code>elevation.colored</code> re-synced to the all-red shipped shadows; motion frontmatter aligned to shipped easing tokens (deleted <code>--ease-bounce</code> removed, <code>--ease-reveal</code>/<code>--ease-spring</code> named correctly); §3 Coach moved to the Reflect row; §7 phantom <code>--shadow-learn</code> → <code>--{app}-shadow</code>; §11.8 and §12.6 pre-D1 color copy corrected; §14.3 "cooler product palette" removed; §10.3 gained the scannability and inclusive-by-default rules recovered from taste.md.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>/motion.md</code> converted from generic template to the dated rank-1 Workshopr mandate: two-regime scoping in the header and Standard Values (page reveals here; 150–300ms UI micro-motion per <code>motion-system.md</code>), stray wrapping code fences removed.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>motion-system.md</code> post-shipping prose: reveal ease is a token (<code>--ease-reveal</code>, P1); <code>--ease-bounce</code> moved out of the live spec table (deleted, P2); the <code>--ws-ease-bounce</code> stray corrected from "defines" to "uses — defined nowhere (dangling)"; the participant reduced-motion spin exception marked as documented-intent-only (not implemented in <code>participant.css</code>).</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>theming.md</code> exceptions table records the planner activity-type colors as a sanctioned functional-coding exception; <code>ADOPTION.md</code> font matrix corrected (Tips/Intervention/Podcasts ship Fraunces + Inter; Priority 1 closed); style guide toast snippet (<code>--text-caption</code>, 12px) and radius decision rule (8px buttons per DESIGN.md, shipped 10px flagged) reconciled.</li>
        </ul>
    </div>
</div>

<!-- v2.9.3 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.3 — Documentation consistency pass (post-D1 reconciliation)</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>workshopr-design-system.json</code> phase mapping: Coach moved from <code>facilitate</code> to <code>reflect</code> (it had inverted the "Coach = Reflect, never swap" rule); DNA marked <code>standalone</code>. <code>check-drift.php</code> passes (54/54 components, 9 apps).</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>workshopr-style-guide.md</code> reconciled to rank-4: deference banner to <code>/DESIGN.md</code> added; stale pre-unification content corrected (per-phase blue/purple/emerald map, Tips/Podcasts/Coach app blocks, colored shadows, app-tinted focus rings → sky-blue ring tokens, z-index scale → shipped tokens, coach legacy mode tokens marked historical).</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>platform-color-system.md</code> rewritten to post-D1 reality (was presenting blue/purple/emerald phases and a per-app "exceptions" model as live while labeled Status: Current).</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>illustration-guidelines.md</code>: wrong ink hex (<code>#1F2937</code> → <code>#2C2416</code>), per-app color-variant table collapsed to the unified red family, stale Planner-blue prompt example.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>README.md</code> architecture line and counts (54 <code>ws_*</code> helpers, 44 demos in <code>components/demos/</code>); <code>ADOPTION.md</code> internal cool-gray contradiction resolved (≈25 remain in planner trees, not "all replaced"); <code>DOC-TEMPLATE.md</code> stale "Tips purple" exception example; <code>START-HERE.md</code> counts, §15 changelog pointer, and pre-D1 "phase color discipline" wording; <code>theming.md</code> dead motion.md link.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>/motion.md</code> illustrative token block aligned to shipped tokens (<code>--duration-reveal</code> 800ms, <code>--duration-reveal-lg</code> 1200ms, <code>--stagger-reveal</code>; deleted-overshoot curve removed); deprecated <code>taste.md</code>/<code>principles.md</code>/<code>forms.md</code> reduced to pointer stubs.</li>
        </ul>
    </div>
</div>

<!-- v2.9.2 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.2 — Audit B1 participant bridge + lint-blind indigo cleanup</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Audit B1: <code>css/facilitator/participant.css</code> referenced 22 undefined tokens surviving on hardcoded fallbacks (a future platform token of the same name would silently restyle the page). Added a participant theme bridge (per <code>theming.md</code>'s app-alias pattern) that defines them once — neutrals alias exact-match platform tokens, activity/status ramps are participant-specific. Zero visual change (verified via computed values).</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Three lint-blind indigo gradients (pre-unification "AI button" styling) that <code>ds-lint</code> misses because indigo isn't a signature phase hex: <code>briefing.css</code> (<code>#536dfe</code>/<code>#4338ca</code>), <code>_sidebar.css</code> and <code>_modals.css</code> (<code>#6366F1</code>) — all repointed to the red family. Zero indigo/violet hexes remain in planner + facilitator CSS.</li>
        </ul>
    </div>
</div>

<!-- v2.9.1 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.1 — Red Unification executed (D1) + audit decisions D2/D3 + motion tokens P1–P4</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <b>D1 — the entire platform is red, everywhere the system speaks.</b> Aligned the last holdouts: <code>platform-tokens.css</code> section comments and stale <code>/* #7C4DFF */</code> annotations, the JSON <code>phases</code> block (was still blue/purple/emerald), and the <code>ds-lint.mjs</code> phase map (tips/coach/live now enforce red — lint is <b>0 violations across 103 files</b>, down from 13 false positives). DESIGN.md §3 and START-HERE.md rewritten: phases are naming-only.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <b>D2</b> — the sky-blue focus ring is documented as the one intentional non-red accent (keyboard visibility against red UI). Do not "fix".</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <b>D3</b> — deprecation register added to the tokens header (delete after Aug 2026: podcast platform brands, planner blues, unused gradients/shadows, cool-text tokens, transition shorthands). The semantic component layer + <code>--animate-*</code> are kept as theming/motion hooks.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Five tokens defined twice in <code>:root</code> deduped (warm backgrounds + status inks — audit F2); stale <code>--z-dialog</code>/facilitator annotations corrected (F3).</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Motion P1: page-reveal regime tokenized (<code>--ease-reveal</code>, <code>--duration-reveal/-lg</code>, <code>--stagger-reveal</code>), zeroed under reduced motion. P2: <code>--ease-bounce</code> deleted (zero consumers; <code>--animate-scale</code> repointed to <code>--ease-spring</code>). P3: <code>--transition-*</code> deprecated. P4: <code>--ease-spring</code> documented as non-overshooting. DTCG mirror regenerated (347 tokens); drift + DTCG + ds-lint all green.</li>
        </ul>
    </div>
</div>

<!-- v2.9.0 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.9.0 — Consolidation pass: token audit, templates, theming + motion specs, pattern library</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>token-audit-2026-07.md</code> — full token audit (344 tokens, 33% unused, shadow vocabularies in participant/planner CSS, 5 duplicate definitions). Three decisions pending (phase-abstraction color, focus ring, unused-token disposition); DTCG mirror regenerated.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>templates/</code> — standard documentation templates (component page, foundation doc) based on the card.php exemplar, plus a <code>.ds-status</code> maturity badge in the ds-header chrome.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>theming.md</code> — three-layer theming architecture, the blessed app-alias bridge pattern, and the six-step new-app checklist. D1-dependent sections marked.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>motion-system.md</code> — reconciles /motion.md with the animation tokens (two regimes), catalogs the shipped named patterns (enter/exit/pop/live-pulse/progress/nudge/reveal), proposes four motion-token changes (P1–P4).</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>component-library.php</code> is now the Pattern Library: 50 components organized into five problem categories with jump links, honest "docs pending" states for the 7 helpers without demo pages, and a documented app-patterns promotion queue.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> START-HERE.md links all consolidation artifacts.</li>
        </ul>
    </div>
</div>

<!-- v2.8.11 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.8.11 — Facilitator wrong-phase purple purge</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>css/facilitator/facilitator.css</code> still had 78 references to the facilitate-purple tokens (<code>var(--phase-facilitate*, #7C4DFF/#6D28D9)</code> and stale purple fallbacks) that bypassed the app's red-resolving <code>--fac-purple*</code> aliases. All now route through <code>--fac-purple*</code> (→ <code>--mainsite-*</code> red) per the documented all-red exception in <code>apps.facilitator.colorNote</code>; the poll-bar gradient's raw <code>#A78BFA</code> was replaced with <code>var(--fac-purple-dark)</code>. <code>ds-lint</code> is now clean for the file.</li>
        </ul>
    </div>
</div>

<!-- v2.8.10 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.8.10 — Facilitator confirm dialog + panel typography</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> The Facilitator's reusable confirm dialog (<code>.confirm-card</code>) had no styles at all — it now follows the established modal anatomy (accent icon tile → Fraunces title → muted subtitle → <code>ws_button</code> row), matching the end-session card.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Slide-in panel titles (Polls, Reactions) adopt the modal heading treatment (Fraunces, <code>--text-h4</code>); poll form validation renders as an inline <code>.poll-form__error</code> notice (error tokens) instead of a native <code>alert()</code>; native <code>confirm()</code> calls (session resume, agenda jump) replaced with the styled dialog.</li>
        </ul>
    </div>
</div>

<!-- v2.8.9 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.8.9 — Audit follow-through: lint exceptions, focus traps, demo pages, facilitator red completion</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>scripts/ds-lint.mjs</code> phase map now encodes the documented app color exceptions (Planner, DNA, Intervention, Facilitator → red; Tips → purple) instead of flagging shipped red as <code>wrong-phase</code>. Full-repo violations dropped from 156 (mostly false positives) to 83 genuine legacy items.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Pre-commit hook (<code>.git/hooks/pre-commit</code>) runs <code>ds-lint.mjs --staged</code> so new CSS drift is blocked at commit time. Note: git hooks are per-clone — re-create after a fresh clone.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Shared <code>wsTrapFocus()</code> / <code>wsReleaseFocus()</code> utility in <code>components.js</code>; <code>ws_modal</code> refactored onto it and the Coach panel + Intervention drawer wired up (guarded, no-op where components.js isn't loaded).</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Demo pages for <code>ws_pill</code>, <code>ws_toggle</code>, <code>ws_cta_section</code>, <code>ws_filter_bar</code>, <code>ws_how_steps</code> under <code>design-system/components/demos/</code>, registered on the component-library index (whose cards now link to <code>demos/</code> — the old links 404'd).</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Facilitator red completed on remaining surfaces: <code>css/facilitator/facilitator.css</code>, <code>participant.css</code>, and <code>summary.css</code> now resolve accents to <code>--mainsite-*</code> tokens (purple fallbacks removed). Stale "facilitator = purple" comment in <code>platform-tokens.css</code> corrected.</li>
        </ul>
    </div>
</div>

<!-- v2.8.8 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.8.8 — Facilitator app red confirmed + live poll cards</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Corrected <code>apps.facilitator.colorNote</code> in <code>workshopr-design-system.json</code>: the ENTIRE Facilitator app (landing and app.php dashboard) is mainsite/Learn red (#E54D4D) — the facilitate purple in the Facilitator PRD is deprecated for this app. <code>facilitator.css</code> keeps the legacy <code>--fac-purple*</code> variable names but resolves them to red. Also updated the <code>phaseColors.facilitate</code> note.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Poll result card styles (<code>.fac-poll</code>, <code>.fac-poll__bar</code>, etc.) in <code>facilitator/css/facilitator.css</code> for the live Polls panel — token-based spacing/color, GPU-friendly (<code>transform: scaleX</code>) vote bars.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Facilitator Reactions + Polls panels visual pass: counts and percentages adopt the timer bar's mono voice (<code>'SF Mono', 'Fira Code'</code>, tabular numerals); reaction bubbles pulse (scale + dissipating ring, <code>--ease-spring</code>, reduced-motion guarded) when a count rises; poll cards gained LIVE/FINAL chips and leader emphasis — only the leading option renders a fully saturated bar (trailing fills at 30% opacity), with in-place bar updates so votes animate between refreshes.</li>
        </ul>
    </div>
</div>

<!-- v2.8.7 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.8.7 — Generative agenda renders from ws_* components</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> The Planner's AI Workshop Generator now composes its output entirely from design-system components. A new client renderer (<code>planner/js/modules/agenda-renderer.js</code>) mirrors the <code>ws-card</code>, <code>ws-activity-badge</code>, <code>ws-badge</code> (duration), <code>ws-suggestion-card</code>, <code>ws-stat</code>, <code>ws-alert</code>, <code>ws-empty-state</code> and <code>ws-skeleton</code> markup instead of bespoke <code>.generator-item</code> HTML — and drops all inline <code>onclick</code> in favor of delegated listeners.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Layout-only stylesheet <code>css/planner/components/_agenda-generative.css</code> (imported by <code>planner-new.css</code>) — all spacing/color/radius via platform tokens, type signalled by the activity badge (no colored side-tab), with a reduced-motion-aware on-canvas assembly animation and a GPU-friendly (<code>transform: scaleX</code>) streaming progress bar.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> The planner's inline "Swap with AI" alternatives now render as <code>ws-suggestion-card</code> via <code>AgendaRenderer.swapAltCard()</code> — removed the bespoke <code>.ai-swap-alt-card</code> markup and its hardcoded inline styles.</li>
        </ul>
    </div>
</div>

<!-- v2.8.6 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.8.6 — Self-contained global footer + facilitator landing exception</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> The global footer composite (<code>includes/components/footer.php</code>) now self-loads its fonts (Fraunces / Inter / JetBrains Mono) and emits its semantic tokens (<code>--paper</code>, <code>--ink</code>, <code>--display</code>, …) as zero-specificity <code>:where(:root)</code> defaults. Host pages no longer need to copy-paste the token block; pages that define the tokens on <code>:root</code> still win.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Documented in <code>workshopr-design-system.json</code> that the <strong>Facilitator landing page</strong> (<code>/facilitator/index.php</code>) ships mainsite/Learn red (#E54D4D) as a deliberate exception, while the Facilitator app dashboard stays Facilitate purple (#7C4DFF).</li>
        </ul>
    </div>
</div>

<!-- v2.8.5 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.8.5 — Synthesize header section (red)</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> Registered a <code>synthesize</code> section in the global header (<code>ws_header</code>) — icon <code>hub</code>, tag "Synthesize", under the REFLECT app-switcher group. The header ships the mainsite red, so Synthesize adopts red as a <strong>deliberate accent exception</strong> (like Intervention and Tips).</li>
        </ul>
    </div>
</div>

<!-- v2.8.4 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.8.4 — Audit close-out (JSON component tiers)</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Promoted the 10 helpers that were only documented as nested <code>convenience</code>/<code>alternatives</code>/<code>related</code> notes to full <strong>top-level component entries</strong> in <code>workshopr-design-system.json</code>: <code>ws_card_start</code>, <code>ws_card_end</code>, <code>ws_modal_start</code>, <code>ws_modal_end</code>, <code>ws_modal_footer</code>, <code>ws_duration</code>, <code>ws_category</code>, <code>ws_status</code>, <code>ws_icon_button</code>, <code>ws_stats</code>. The drift check now catalogues 49/49 helpers at top level (was 39), so they're discoverable and won't get re-implemented as raw HTML. Closes the last open finding (P1-3) from <code>AUDIT-2026-07-01-app-vs-design-system.md</code>.</li>
        </ul>
    </div>
</div>

<!-- v2.8.2 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.8.3 — app-tips.php color fix</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>app-tips.php</code> still showed coral/red.</strong> Tips has shipped Facilitate purple (<code>#7C4DFF</code>) as a deliberate, documented exception since at least v2.8.0 (which corrected the JSON's category colors to match), but the app guide page itself still displayed the old coral/red palette. Updated all color swatches, hex displays, the gradient/shadow, the 6 category tints, and prose ("warm coral" / "coral red" / "coral") to the purple values in <code>platform-tokens.css</code> (<code>#7C4DFF</code> / <code>#6930C3</code> / <code>#E8DEFF</code> / <code>#F3EEFF</code> + <code>--tips-cat-1..6</code>). Clarified the exception note: Tips is Learn-phase content but deliberately ships Facilitate purple, not Learn red.</li>
        </ul>
    </div>
</div>

<!-- v2.8.2 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.8.2 — app-planner.php color fix</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>app-planner.php</code> still showed sky blue.</strong> The v2.8.0 Planner recolor (blue → Learn red) updated <code>platform-tokens.css</code> and the JSON but missed the Planner app guide page itself. Updated all color swatches, hex displays, the gradient, and prose ("blue" → "red") to <code>#E54D4D</code>/<code>#C73E3E</code>/<code>#FEE2E2</code>/<code>#FEF2F2</code>. Added an explicit note that the Plan <em>phase</em> token (<code>--phase-plan</code>) stays <code>#0284C7</code> — only the app itself ships red.</li>
        </ul>
    </div>
</div>

<!-- v2.8.1 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.8.1 — Documentation cleanup</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong><code>platform-color-system.md</code> was badly stale</strong> (last synced Feb 2026) and contradicted the code on five apps (tips shown red, intervention purple, planner blue, dna green, training green). Rewrote it as a lean ~130-line color-<em>architecture</em> doc that points to <code>platform-tokens.css</code> for hex values instead of mirroring them (mirroring was the drift source). Fixed the same stale planner/DNA colors in <code>workshopr-style-guide.md</code>.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong><code>DOC-TEMPLATE.md</code></strong> — standard copy-paste templates (Component / Pattern / Foundation) plus shared doc conventions (status + last-updated header, TOC for long docs, second person, maturity indicators) so every DS doc is structured consistently.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong>De-duplicated the entry docs.</strong> <code>START-HERE.md</code> is the single router (source-of-truth hierarchy + on-ramps); <code>README.md</code> is now purely the detailed file map and no longer repeats the "what to read" guidance. Fixed stale claims (JSON is hand-maintained not generated; DESIGN.md is intent truth; 12 app guides not 8).</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Added standardized <strong>status / last-updated headers</strong> to START-HERE, README, platform-color-system, illustration-guidelines, and a Contents TOC to the long docs. Updated START-HERE's documented color exceptions to include Planner, DNA, and Intervention.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Refreshed the per-app guide pages to match the recolor — <code>app-planner.php</code> → red, <code>app-dna.php</code> → red, <code>app-tips.php</code> → purple — corrected the remaining stale app-color blocks in <code>workshopr-style-guide.md</code> (tips categories → purple, intervention → red, training → red), and fixed <code>app-hybrid.php</code>'s stale "aligned with Planner" note (Hybrid uses the Plan <em>phase</em> blue; the Planner app is now red).</li>
        </ul>
    </div>
</div>

<!-- v2.8.0 -->
<div class="changelog-entry">
    <div class="changelog-date">July 2026</div>
    <div class="changelog-version">v2.8.0 — App-vs-design-system reconciliation (audit)</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Planner recolored blue → red.</strong> The Planner app shipped mainsite/Learn red (<code>#E54D4D</code>) since June 2026 but the DS still said sky blue. Updated <code>--planner-*</code> in <code>platform-tokens.css</code>, <code>apps.planner</code> in the JSON (with a <code>colorNote</code>), and the phase table + a new exception bullet in <code>DESIGN.md</code>. The Plan <em>phase</em> (<code>--phase-plan</code>) stays blue; only the app overrides.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>DNA recolored green → red.</strong> Same treatment for DNA (<code>--dna-*</code> + 5 category tints, JSON, DESIGN.md). The Reflect <em>phase</em> (<code>--phase-reflect</code>) stays emerald because Coach still uses it.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Tips category colors.</strong> The JSON listed a red scale for <code>apps.tips.categories</code>; corrected to the purple scale that <code>platform-tokens.css</code> and the app actually use.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <strong>Motion easing contradiction.</strong> Canonical reveal/spring ease is now <code>cubic-bezier(0.22, 1, 0.36, 1)</code> across <code>DESIGN.md</code>, the JSON, and <code>motion.md</code> (was split between two curves). Added <code>standard</code> (<code>0.4, 0, 0.2, 1</code>) for micro UI transitions.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <strong><code>motion.md</code> rewritten for the real stack</strong> — vanilla CSS transitions/<code>@keyframes</code> + <code>IntersectionObserver</code> (it previously documented Next.js/React/Framer Motion/GSAP, none of which this platform uses).</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Z-index scale extended</strong> to cover what the app actually uses: <code>--z-overlay: 1000</code>, <code>--z-header: 1100</code>, and a high band <code>--z-dialog: 10000</code> / <code>-high: 10001</code> / <code>-highest: 10004</code> (planner live-mode/kiosk). Mirrored in the JSON <code>zIndex</code>.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <strong>Extended utility color tokens</strong> for values the app was hardcoding: <code>--color-orange-600</code>, <code>--color-green-700</code>, <code>--color-auth-primary</code>, <code>--color-auth-gradient-dark</code>, and purple/orange 100–200 pastels.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Aligned <code>css/facilitator/facilitator.css</code> <code>--phase-facilitate</code> fallbacks from stale <code>#7C3AED</code> to the real <code>#7C4DFF</code>. Bumped <code>DESIGN.md</code> <code>last-reconciled</code> to 2026-07-01. Full audit at <code>design-system/AUDIT-2026-07-01-app-vs-design-system.md</code>.</li>
        </ul>
    </div>
</div>

<!-- v2.7.18 -->
<div class="changelog-entry">
    <div class="changelog-date">June 2026</div>
    <div class="changelog-version">v2.7.18 — Intervention accent: purple → red</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Intervention now uses red (Learn red <code>#E54D4D</code>) as its accent instead of facilitate purple. Updated the <code>--intervention-*</code> tokens (primary/dark/light/very-light/gradient/shadow + 6 category tints) in <code>platform-tokens.css</code>, the <code>apps.intervention</code> block in <code>workshopr-design-system.json</code> (with a <code>colorNote</code>), and the <code>app-intervention.php</code> guide. Drift check passes. Intervention stays in the Facilitate phase but is a deliberate color exception, like Tips.</li>
        </ul>
    </div>
</div>

<!-- v2.7.17 -->
<div class="changelog-entry">
    <div class="changelog-date">June 2026</div>
    <div class="changelog-version">v2.7.17 — My Workshopr header section + self-contained footer</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> Added a <code>myworkshopr</code> section to <code>ws_header</code> (icon <code>space_dashboard</code>, tag &ldquo;My Workshopr&rdquo;, single Dashboard nav link). The title band is enlarged for this section (15px, wider) via a <code>[data-section="myworkshopr"]</code>-scoped rule so other apps are unaffected.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> The global footer (<code>includes/components/footer.php</code>) now self-loads <code>platform-tokens.css</code> so it renders correctly on host pages (e.g. MyWorkshopr) that don't already include the token sheet. Browsers dedupe the identical href elsewhere.</li>
        </ul>
    </div>
</div>

<!-- v2.7.16 -->
<div class="changelog-entry">
    <div class="changelog-date">June 2026</div>
    <div class="changelog-version">v2.7.16 — ws_header account menu + wired controls</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_header</code> (<code>includes/components/header.php</code>) gained a logged-in account dropdown (<code>.wsh-header__account</code> / <code>.wsh-header__menu</code>) with avatar, name/email, and links to My Workshopr, My Workshops, Team, Settings, and Sign out.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Header controls are now functional: search button opens the site-search overlay (<code>data-search-trigger</code>), the apps grid icon became a gear linking to <code>/myworkshopr/</code>, and Sign In opens the auth modal in place. The component now self-loads its auth-modal and search-overlay dependencies.</li>
        </ul>
    </div>
</div>

<!-- v2.7.15 -->
<div class="changelog-entry">
    <div class="changelog-date">June 2026</div>
    <div class="changelog-version">v2.7.15 — Letter CTA form polish</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Refined the footer Letter CTA form: input <code>border-radius</code> now matches the button (10px), inputs bumped to 16px / roomier padding (no iOS zoom), added input hover states, a <code>.cta__note</code> privacy line, and a single-column stack under 480px.</li>
        </ul>
    </div>
</div>

<!-- v2.7.14 -->
<div class="changelog-entry">
    <div class="changelog-date">June 2026</div>
    <div class="changelog-version">v2.7.14 — Letter CTA form wired to newsletter API</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> The Letter CTA subscribe form (global footer + <code>academy/components/letter-cta.php</code>) now submits to <code>/api/newsletter.php</code> with loading/success/error states. Added a <code>.cta__hp</code> honeypot field and <code>.cta__msg</code> / <code>.cta__msg--error</code> status-message styles.</li>
        </ul>
    </div>
</div>

<!-- v2.7.13 -->
<div class="changelog-entry">
    <div class="changelog-date">June 2026</div>
    <div class="changelog-version">v2.7.13 — Larger .section-title display headings</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>.section-title</code> display headings increased ~25%: the <code>clamp(28px, 4vw, 38px)</code> rule (Intervention, Podcasts, Tips) is now <code>clamp(35px, 5vw, 48px)</code>; DNA moved <code>--text-3xl</code> &rarr; <code>--text-4xl</code>; shared-components and Academy use <code>calc(token * 1.25)</code>. Small uppercase sidebar/handout labels were intentionally left unchanged.</li>
        </ul>
    </div>
</div>

<!-- v2.7.12 -->
<div class="changelog-entry">
    <div class="changelog-date">June 2026</div>
    <div class="changelog-version">v2.7.12 — Global header label left-aligned</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>ws_header()</code> app/section label (<code>.wsh-header__tag</code>) is now left-aligned (<code>justify-content: flex-start; text-align: left</code>) instead of centered, so multi-line labels like &ldquo;Facilitator Style Quiz&rdquo; read cleanly.</li>
        </ul>
    </div>
</div>

<!-- v2.7.11 -->
<div class="changelog-entry">
    <div class="changelog-date">June 2026</div>
    <div class="changelog-version">v2.7.11 — Global header sticky to top</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>ws_header()</code> (<code>.wsh-header</code>) is now <code>position: sticky; top: 0</code> instead of <code>position: relative</code>, so the global navigation pins to the top of the viewport on scroll. Existing <code>z-index: 1050</code> (above planner topbar/slide panels, below modals) is unchanged.</li>
        </ul>
    </div>
</div>

<!-- v2.7.10 -->
<div class="changelog-entry">
    <div class="changelog-date">June 2026</div>
    <div class="changelog-version">v2.7.10 — Section hero: book-cover carousel</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_section_hero()</code> now supports a per-section <code>carousel</code> config (array of <code>{img, href, title}</code>) that renders an auto-advancing book-cover carousel in the visual slot instead of the static illustration. Includes clickable covers, prev/next arrows, dot navigation, pause-on-hover/focus, and <code>prefers-reduced-motion</code> support. CSS/JS are namespaced under <code>.wsh-carousel</code> and self-emitted once. First used by the Academy hero to showcase all six ebook covers. Each slide also supports an optional top-right status <code>pill</code> (<code>{label, tone}</code> — <code>available</code> green / <code>soon</code> red).</li>
        </ul>
    </div>
</div>

<!-- v2.7.9 -->
<div class="changelog-entry">
    <div class="changelog-date">June 2026</div>
    <div class="changelog-version">v2.7.9 — Section hero component</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_section_hero($section)</code> (<code>includes/components/section-hero.php</code>) — section-aware hero from the Figma "Hero — *" frames, with a per-section registry (home, library, academy, tips, planner). Self-emits its CSS under the <code>.wsh-hero</code> namespace so it renders on any page regardless of bundle. Illustrations live in <code>/images/heroes/</code>. Placed on the home, library, academy, tips, and planner-landing pages.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>section-hero.php</code> is <code>require_once</code>'d by both <code>helpers.php</code> and <code>components/header.php</code>, so any page with the global header can render a section hero without pulling in the full helpers.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>ws_header</code> now establishes a stacking context (<code>position: relative; z-index: 1050</code>) so its app-switcher dropdown clears app chrome (planner topbar/panels) while staying below modals.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Tuned <code>ws_section_hero</code> to match the Figma "Hero — Home" frame exactly — light-weight Fraunces title in warm ink (<code>#4D453B</code>) with the red italic accent, bordered badge, gradient primary CTA, and dark (not red) stat figures. Pulled the exact illustration from Figma.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Recreated the Library hero from the Figma "Hero — Library" frame — added optional <code>imageRounded</code> (16px) and <code>visualChips</code> (category quick-links under the illustration) to the component; Library now shows Workshops / Icebreakers / Collections / Goals chips.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>includes/page-grid.php</code> — a reusable snippet that lays the house graph-paper grid (24px, warm ink, <code>background-attachment: fixed</code>) over the page <code>body</code> background, preserving each page's <code>background-color</code>. Added to the home, library, academy, tips, and planner landing index pages; <code>ws_section_hero</code> also carries the grid so it reads behind the hero.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_dna_cta()</code> (<code>includes/components/dna-cta.php</code>) — Facilitator-DNA quiz promo strip from the Figma "dna cta" frame: light-red bar with an overlapping circular archetype badge, red icon chip, title/subtitle, and a "Take the quiz" button linking to <code>/dna/</code>. Self-emits its CSS; ships with the global header.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>ws_section_hero</code> buttons now accept an optional <code>icon</code> (the Academy hero's "Get the Books" uses it). Synced the Academy hero to its Figma frame (badge "Workshopr Academy", book icon on the primary CTA).</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Hero/CTA icons rendered as literal text on pages (e.g. Academy) that use <code>ws_header</code> but don't load <code>includes/icon.php</code> — the header component now loads the inline-SVG <code>icon()</code> helper so component icons always render.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> The global footer's "Level Up Your Facilitation" section now animates in on scroll — each row fades + rises as it enters the viewport, with cards staggered 70ms within a row (ease-out, ~0.5s). Progressive enhancement via <code>IntersectionObserver</code>: no-JS and <code>prefers-reduced-motion</code> users get the section with no hidden state, and the revealed state is explicit so content is never stuck hidden. Doesn't interfere with the existing card hover-lift.</li>
        </ul>
    </div>
</div>

<!-- v2.7.8 -->
<div class="changelog-entry">
    <div class="changelog-date">June 2026</div>
    <div class="changelog-version">v2.7.8 — Planner recolored to mainsite red</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> The planner phase color is now mainsite red, not the legacy plan-phase blue. <code>_component-bridge.css</code> previously remapped <code>--mainsite-primary → --planner-primary</code> (blue), forcing the whole planner blue. It now points the planner accent tokens (<code>--planner-primary/dark/light/very-light</code>, plus the <code>--planner-interactive*</code> and <code>--planner-blue*</code> aliases) at the native <code>--mainsite-*</code> reds, scoped to <code>body.planner-page</code>/<code>.planner-app-active</code> so it beats the <code>:root</code> token re-imports. Note: aliases declared <code>: var(--planner-primary)</code> at <code>:root</code> are computed there and must be re-declared in the scoped block to recolor.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> AI Workshop Generator loading state (<code>_generator-modal.css</code>) — heading/subtitle dropped from <code>--text-display</code>/<code>--text-h2</code> to <code>--text-h3</code>/<code>--text-small</code>, with a pulsing <code>auto_awesome</code> sparkle layered inside the spinner.</li>
        </ul>
    </div>
</div>

<!-- v2.7.7 -->
<div class="changelog-entry">
    <div class="changelog-date">June 2026</div>
    <div class="changelog-version">v2.7.7 — Generator modal type scale</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> AI Workshop Generator modal (<code>css/planner/components/_generator-modal.css</code>) — form labels/inputs/selects were using heading tokens (<code>--text-h2</code>/<code>--text-h3</code>); right-sized to <code>--text-ui</code>/<code>--text-small</code>/<code>--text-meta</code> so controls match the planner UI scale. Added a <code>:-webkit-autofill</code> override so autofilled fields stay on-theme instead of browser blue. Shared planner <code>@import</code> stamp bumped <code>20260610 → 20260615</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Generator <strong>output view</strong> got the same treatment — agenda item names dropped from <code>--text-h2</code> to <code>--text-h4</code>, start times / headers / rationale / refine input from <code>--text-h3</code> to <code>--text-ui</code>/<code>--text-small</code>, the "total" badge became a pill, and the loud salmon (<code>#FCA5A5</code>) refine strip was softened to a light-red bar with a subtle border.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Generator <strong>error state</strong> now matches the loading state — title/body dropped from <code>--text-display</code>/<code>--text-h2</code> to <code>--text-h3</code>/<code>--text-small</code>, and the icon (which was targeting a never-rendered <code>.material-symbols-rounded</code>) is now a 44px circular error chip. All four generator states — form, output, loading, error — share one type scale and layout language.</li>
        </ul>
    </div>
</div>

<!-- v2.7.6 -->
<div class="changelog-entry">
    <div class="changelog-date">June 2026</div>
    <div class="changelog-version">v2.7.6 — Versioned @imports rolled out platform-wide</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Extended the v2.7.5 stale-cache fix to every other CSS bundle with unversioned <code>@import</code>s: <code>css/styles.css</code> (main site), <code>css/coach/coach.css</code>, <code>css/dna/styles.css</code>, <code>css/academy/training.css</code>, <code>css/intervention/styles.css</code>, <code>css/participant/participant.css</code>, <code>css/facilitator/*.css</code>, <code>css/planner/analytics.css</code>, plus the nested token imports (<code>css/tokens/_variables.css</code>, <code>css/coach/base/_variables.css</code>, <code>assets/css/auth-modal.css</code>, <code>facilitator/css/facilitator.css</code>). All imports now carry the shared <code>?v=YYYYMMDD</code> stamp. <strong>Bump the stamp whenever any imported file changes.</strong> External imports (Google Fonts) and bundler-managed apps (dna/mobile) deliberately excluded.</li>
        </ul>
    </div>
</div>

<!-- v2.7.5 -->
<div class="changelog-entry">
    <div class="changelog-date">June 2026</div>
    <div class="changelog-version">v2.7.5 — Versioned @imports in the planner bundle</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Stale-cache breakage after CSS deploys: the <code>?v=</code> stamp on <code>planner-new.css</code> never invalidated the files it <code>@import</code>s, and the server caches CSS for 7 days &mdash; so production visitors kept week-old partials (collapsed <code>.planner-body</code> flex layout, exposed card edit panels). Every <code>@import</code> in <code>planner-new.css</code> (and the <code>platform-tokens.css</code> import inside <code>base/_variables.css</code>) now carries a shared <code>?v=YYYYMMDD</code> stamp. <strong>Bump the stamp on all imports whenever any planner CSS changes.</strong></li>
        </ul>
    </div>
</div>

<!-- v2.7.4 -->
<div class="changelog-entry">
    <div class="changelog-date">June 2026</div>
    <div class="changelog-version">v2.7.4 — Planner stylesheet consolidation</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Made <code>css/planner/planner-new.css</code> the single canonical planner bundle. The partially-gutted <code>planner-v2.css</code> monolith (1,042 <code>DUPLICATE/EXTRACTED</code> markers) was retired and deleted; every selector it still held was already present in the imported component set, except the <code>.sr-only</code> a11y utility which was migrated into <code>planner-new.css</code>. <code>planner/includes/header.php</code> now loads the one bundle on the modular path (the dead <code>planner.css</code> link and the temporary standalone <code>_modals.css</code> patch are gone), and the kiosk/embedded headers were repointed off the retired monolith. Token <em>values</em> unchanged &mdash; drift check passes.</li>
        </ul>
    </div>
</div>

<!-- v2.7.3 -->
<div class="changelog-entry">
    <div class="changelog-date">June 2026</div>
    <div class="changelog-version">v2.7.3 — Global 80% text scale</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Platform text now renders at 80%. Font sizes are <code>rem</code> and spacing is <code>px</code>, so a root <code>html { font-size: 80% }</code> shrinks all rem text while leaving layout intact. Added to <code>platform-tokens.css</code> and both global headers (<code>unified-header.css</code>, <code>academy/global-header.css</code>) to reach pages outside the token chain; the per-app html bases (mainsite, planner, academy, participant, facilitator) were scaled by the same <code>0.8</code> so it stays uniform. No token <em>values</em> changed, so the JSON mirror stays in sync (drift check passes). Inline <code>px</code> font sizes on bespoke landing pages are not covered.</li>
        </ul>
    </div>
</div>

<!-- v2.7.2 -->
<div class="changelog-entry">
    <div class="changelog-date">June 2026</div>
    <div class="changelog-version">v2.7.2 — Invalid negative-margin token syntax</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Repaired 8 invalid <code>-var(--space-*)</code> negative margins across <code>css/detail-immersive.css</code>, <code>css/styles.css</code>, <code>css/planner/planner-v2.css</code>, <code>css/planner/live-mode.css</code>, and <code>css/academy/styles.css</code>. <code>-var()</code> is not valid CSS, so browsers dropped the entire declaration &mdash; most visibly leaving the library detail-page stats card (<code>.immersive-stats-float</code>) fully left-aligned because its <code>margin: -var(--space-8) auto 0</code> (and with it the <code>auto</code> centering) was ignored. The correct form for negating a token is <code>calc(-1 * var(--space-8))</code>.</li>
        </ul>
    </div>
</div>

<!-- v2.7.1 -->
<div class="changelog-entry">
    <div class="changelog-date">June 2026</div>
    <div class="changelog-version">v2.7.1 — Planner phase-color fix</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> The planner&rsquo;s component bridge (<code>css/planner/components/_component-bridge.css</code>) never remapped <code>--mainsite-primary</code>, so the global header and <code>ws_*</code> components fell back to mainsite red (<code>#E54D4D</code>) instead of the planner Plan-phase blue (<code>#0284C7</code>). Added a body-scoped remap (<code>body.planner-app-active</code>) that beats <code>:root</code> and survives the late <code>platform-tokens.css</code> <code>@import</code> in <code>assets/css/auth-modal.css</code>. Semantic danger reds use their own tokens and are unaffected.</li>
        </ul>
    </div>
</div>

<!-- v2.7.0 -->
<div class="changelog-entry">
    <div class="changelog-date">June 2026</div>
    <div class="changelog-version">v2.7.0 — Portable component library (PHP + React)</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>design-system/components/php/</code> and <code>design-system/components/react/</code> — portable implementations of every <code>ws_*</code> component (49) and all 6 documented patterns. PHP ships as namespaced <code>Workshopr\DS\*</code> standalone functions (collision-free with the global <code>ws_*</code> helpers); React ships as typed <code>.tsx</code> function components (<code>Ws&lt;Name&gt;</code> + <code>Ws&lt;Name&gt;Props</code>).</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Both flavors render the existing <code>ws-*</code> class names from <code>components.css</code> (single source of truth) — no duplicated CSS, no hardcoded colors/sizes/fonts. Shared helpers: <code>_icon.php</code> (<code>icon/cx/attrs/e</code>) and <code>Icon.tsx</code> / <code>cx.ts</code>.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Barrels: <code>php/index.php</code> (requires all 50 components, 59 <code>Workshopr\DS</code> functions) and <code>react/index.ts</code> (52 exports), plus a <code>README.md</code> with usage and a patterns-CSS caveat. All PHP verified with <code>php -l</code> + render smoke tests.</li>
        </ul>
    </div>
</div>

<!-- v2.6.0 -->
<div class="changelog-entry">
    <div class="changelog-date">June 2026</div>
    <div class="changelog-version">v2.6.0 — AI-enablement: enforcer fix, enriched catalog, DTCG export</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> The <code>design-system-enforcer</code> MCP pointed at a stale <code>/sites/newphp</code> dir where the server file doesn&rsquo;t exist, so it never launched &mdash; the AI&rsquo;s real-time compliance oracle was dead. Repointed to the absolute platform path (now reads 325 tokens + 49 <code>ws_*</code> helpers). Wired &ldquo;validate before finishing any UI work&rdquo; (<code>check_snippet</code> / <code>validate_file</code> / <code>suggest_component</code>) into CLAUDE.md, GEMINI.md, and START-HERE.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>generate-catalog.php</code> now enriches <code>components.generated.json</code> with a canonical <code>example</code>, <code>whenToUse</code> / <code>whenNotToUse</code>, an <code>a11y</code> note, and a derived <code>antiPattern</code> per <code>ws_*</code> helper &mdash; extracted from the <code>components/*.php</code> demos. It&rsquo;s now the &ldquo;how do I use this component&rdquo; reference for AI (example 41/49, whenToUse 20/49, a11y 6/49).</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>generate-tokens-dtcg.php</code> &rarr; <code>tokens.dtcg.json</code>: all tokens in W3C DTCG format with <code>$type</code> inference, <code>$description</code> from CSS comments, and <code>var()</code> &rarr; <code>{alias}</code> references. Standard format for Style Dictionary, Figma, Tokens Studio, and AI tooling.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>design-system/llms.txt</code> &mdash; an llms.txt-convention index pointing AI agents at the canonical files, machine-readable sources, rules, and validators. Both new generators have <code>--check</code> modes wired into npm, the CI <code>ds-drift</code> job, and the pre-commit hook.</li>
        </ul>
    </div>
</div>

<!-- v2.5.2 -->
<div class="changelog-entry">
    <div class="changelog-date">June 2026</div>
    <div class="changelog-version">v2.5.2 — Display + timer tokens (font-size scale complete)</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> Extended the type scale with five above-base tokens: <code>--text-display-lg</code> (3.5rem/56px), <code>--text-display-xl</code> (4.5rem/72px) for large hero headings, and <code>--text-timer-sm/md/lg</code> (4/5/6rem) for the live &amp; run-mode countdown numerals.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Tokenized the final 12 held hero/timer declarations. <strong>The platform now has zero bare font-size values — every <code>font-size</code> resolves through a <code>--text-*</code> token.</strong> check-drift passes; all apps verified HTTP&nbsp;200.</li>
        </ul>
    </div>
</div>

<!-- v2.5.1 -->
<div class="changelog-entry">
    <div class="changelog-date">June 2026</div>
    <div class="changelog-version">v2.5.1 — Off-scale font-size normalization</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Snapped <strong>619 off-scale font-sizes</strong> to the nearest type-scale step via <code>ds-tokenize-fontsize.mjs --snap</code>. Each becomes <code>var(--text-*, &lt;token-rem&gt;)</code> so the fallback matches the snapped size. Most deltas are sub-pixel; the visible ones are <code>28px→24px</code> (62×), <code>22px→20px</code> (46×), <code>36px→32px</code>, and <code>40px→46px</code>.</li>
            <li><span class="changelog-tag changelog-tag--deprecated">Held</span> 12 hero declarations (56–96px / 3.5–6rem) are above the top scale step (46px); the snapper holds anything whose nearest step is &gt;8px away rather than collapsing hero text. These await dedicated display tokens.</li>
        </ul>
    </div>
</div>

<!-- v2.5.0 -->
<div class="changelog-entry">
    <div class="changelog-date">June 2026</div>
    <div class="changelog-version">v2.5.0 — Type-scale tokenization</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Tokenized <strong>1,635 hardcoded font-sizes</strong> to <code>--text-*</code> across 104 stylesheets. Only exact on-scale values were converted (px and rem, parsed unit-agnostically), each retaining its original value as a standalone fallback — e.g. <code>font-size: 14px</code> → <code>font-size: var(--text-small, 14px)</code>. Value-preserving, idempotent, and safe on pages that don't load <code>platform-tokens.css</code>.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>scripts/ds-tokenize-fontsize.mjs</code> — exact-match font-size tokenizer. Reports off-scale values rather than snapping them, so no size silently changes.</li>
            <li><span class="changelog-tag changelog-tag--deprecated">Note</span> ~631 off-scale sizes remain (e.g. <code>0.8rem</code>, <code>0.85rem</code>, <code>17px</code>, <code>22px</code>, <code>28px</code>, hero <code>36–96px</code>). These need a typography decision (snap to the nearest scale step = a visual change) and were deliberately not auto-converted.</li>
        </ul>
    </div>
</div>

<!-- v2.4.0 -->
<div class="changelog-entry">
    <div class="changelog-date">June 2026</div>
    <div class="changelog-version">v2.4.0 — Compliance gate + token cleanup</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>scripts/ds-lint.mjs</code> — a low-noise compliance gate that fails on three high-signal regressions: cool-gray hex, banned font stacks (<code>Source Sans 3</code>, legacy Bitter/DM Sans), and wrong-phase brand-color leakage. Scopes phase rules carefully (purple is allowed in the blue planner for activity/icebreaker accents; green is never flagged because it doubles as success/complete). Runs via <code>npm run lint:ds</code>, the pre-commit hook on staged files, and a CI job.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>scripts/ds-tokenize.mjs</code> — value-preserving hex→token rewriter. Maps grays (warm Stone), ink, semantic status, and brand primaries; resolves <code>#fff</code> by context (<code>color:</code>→<code>--text-inverse</code>, else <code>--bg-surface</code>); and skips hexes already in <code>var()</code> fallback position so it never produces redundant <code>var(--x, var(--x))</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>components.css</code> — 55 bare hardcoded colors tokenized and all 27 cool-grays removed. Several were dead-token fallbacks (<code>var(--color-border, #e5e7eb)</code>, <code>var(--color-text, #111827)</code>) referencing undefined variables, so the cool gray was actually rendering; these now resolve to warm Stone / ink tokens. Component demo page verified rendering with zero PHP errors.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Phase-color leakage — Coach mobile app <code>--primary</code> and note-icons moved off mainsite red / planner blue onto Facilitate purple; Tips footer accents moved off red onto Tips purple. Coach, Tips, and Facilitator pages verified at HTTP&nbsp;200.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>Source Sans 3</code> → Inter across facilitator, myworkshopr, participant, and prep stylesheets (12 declarations), enforcing the Fraunces/Inter mandate. Microsite <code>--font-*</code> definitions confirmed already on Fraunces/Inter (Bitter/DM Sans only survive in comments).</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Remaining cool-grays cleared from <code>library-goals.css</code>, the shared <code>_sidebar.css</code>, <code>listing-redesign.css</code>, and the DNA mobile reading sheet, then from the consolidated planner tree — <strong>zero cool-grays platform-wide</strong>.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Resolved the last 22 wrong-phase lint hits. Investigation found these were all <em>intentional</em> danger/CTA reds caught only by their redundant literal <code>#E54D4D</code> fallbacks (facilitator <code>--fac-red</code> = <code>--color-error</code>; planner <code>--planner-red</code> = documented mainsite-CTA alias; <code>--phase-learn</code> status colors). Tokenized them (drop literal, keep the var) for zero visual change; mapped the live-mode <code>--run-danger</code> token to <code>--color-error</code>; and marked the standalone-capable auth-modal CTA with a documented lint exception. <strong>ds-lint now clean across all 112 scanned files.</strong></li>
        </ul>
    </div>
</div>

<!-- v2.3.0 -->
<div class="changelog-entry">
    <div class="changelog-date">June 2026</div>
    <div class="changelog-version">v2.3.0 — Consolidation: single entry point + drift guard</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>START-HERE.md</code> — one entry point with a stated source-of-truth hierarchy (<code>/DESIGN.md</code> + <code>/motion.md</code> for intent; <code>platform-tokens.css</code> + <code>helpers.php</code> for implementation; JSON as a machine mirror) and audience on-ramps for designers, developers, and Claude.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>check-drift.php</code> — guards the JSON mirror against drift: fails if any <code>ws_*</code> helper is undocumented in the JSON, or if phase-color tokens disagree between <code>platform-tokens.css</code> and the JSON. Known source contradictions (tips, training) are allowlisted as visible warnings pending a design decision.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> JSON <code>meta</code> now references the canonical <code>/DESIGN.md</code> and <code>/motion.md</code>, declares itself a hand-maintained mirror (correcting the earlier &ldquo;auto-generated&rdquo; claim), and points to the drift guard.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>README.md</code> now defers to <code>START-HERE.md</code> and corrects the JSON provenance note.</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Phase-color records reconciled to the shipped apps: <strong>Tips</strong> documented as a deliberate Facilitate-purple exception (Learn content, purple brand), and <strong>Academy/Training</strong> documented as Learn red (<code>#E54D4D</code>) — the unimplemented &ldquo;training = green&rdquo; mapping was retired from the JSON, <code>DESIGN.md</code>, and CLAUDE.md &sect;11. Each app now carries a <code>colorNote</code> in the JSON, and both pass <code>check-drift.php</code> without an allowlist.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Added the <code>--facilitator-primary</code> token family (aliased to <code>--phase-facilitate</code>, <code>#7C4DFF</code>) — facilitator was the only app missing its <code>--{app}-primary</code> token. The JSON facilitator color was corrected from the stray <code>#7C3AED</code> to the phase purple, matching coach/intervention.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>check-drift.php</code> now resolves one level of CSS <code>var()</code> indirection, so phase-aliased app tokens validate. Wired into governance: <code>npm run lint:ds:drift</code>, a <code>ds-drift</code> PHP job in the Design System Lint GitHub workflow, and a staged-file gate in the pre-commit hook.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>check-drift.php</code> gained a reverse check — a JSON component with no matching <code>ws_*</code> function (renamed/removed) now fails the build — and reports component counts. Corrected stale counts in <code>README.md</code> (39 demo pages, 49 helpers, not &ldquo;34&rdquo;/&ldquo;40+&rdquo;), and aligned <code>GEMINI.md</code> with the consolidated <code>DESIGN.md</code> (it still pointed at the deprecated taste/principles/forms files).</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>generate-catalog.php</code> + <code>components.generated.json</code> — a real generator that derives a <code>ws_*</code> component roster (signature, summary, declared options) straight from the <code>helpers.php</code> docblocks. The curated JSON keeps its rich hand-authored option metadata; the generated file is the can&rsquo;t-drift companion. <code>--check</code> mode fails on a stale roster or a curated signature that no longer matches source, wired into <code>npm run lint:ds:catalog</code>, the CI <code>ds-drift</code> job, and the pre-commit hook. Also added the canonical-source banner to <code>voice.php</code>/<code>philosophy.php</code> pointing at <code>DESIGN.md</code>.</li>
        </ul>
    </div>
</div>

<!-- v2.2.0 -->
<div class="changelog-entry">
    <div class="changelog-date">May 2026</div>
    <div class="changelog-version">v2.2.0 — Token compliance: extended accent + brand tokens</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Tokenized recurring hardcoded colors across <code>css/academy/styles.css</code>, <code>css/facilitator/facilitator.css</code>, <code>css/planner-new/*</code>, <code>css/styles.css</code>, and <code>css/unified-header.css</code> — raw hex values replaced with platform tokens. Exact color values preserved.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Teal accent tokens for planner secondary actions: <code>--color-teal</code>, <code>--color-teal-dark</code>.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Extended state shades: <code>--color-warning-darker</code>, <code>--color-error-strong</code>, <code>--color-error-darker</code>, <code>--color-info-strong</code>, <code>--planner-accent-dark</code>, <code>--color-success-surface</code>, <code>--color-success-darker</code>, and the soft warning callout surface (<code>--color-warning-surface</code> + <code>-border</code> / <code>-ink</code>).</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Meeting-tool brand tokens mirroring the podcast platform set: <code>--platform-meet</code>, <code>--platform-zoom</code>, <code>--platform-inperson</code> (each with <code>-ink</code> / <code>-bg</code> variants where used).</li>
        </ul>
    </div>
</div>

<!-- v2.1.1 -->
<div class="changelog-entry">
    <div class="changelog-date">May 2026</div>
    <div class="changelog-version">v2.1.1 — Planner sidebar: prototype-matched toolbar + flat suggested list</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>.sidebar-toolbar</code> component for the planner's activity sidebar — sticky search input + pill-style type tabs. Lives in <code>css/planner/components/_sidebar.css</code> (mirrored at <code>css/components/_sidebar.css</code>).</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>.side__group</code> / <code>.side__group-title</code> / <code>.side__list</code> / <code>.side__more</code> / <code>.side__group-empty</code> structural classes for the flat "Suggested for X" list and "Browse all activities" footer link.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>.library-card--lib</code> variant — full-bleed flat draggable card with <code>.lib-card__top</code> (dot + title), <code>.lib-card__meta</code> (pill + duration), <code>.lib-card__dot--{exercise|icebreaker|break}</code>, and <code>.lib-card__pill--{exercise|icebreaker|break}</code> type modifiers. Scoped under <code>.activity-sidebar</code> so it doesn't affect other surfaces that use <code>.library-card</code>.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> All new card / pill colors pull from existing planner tokens (<code>--planner-exercise-color</code>, <code>--planner-icebreaker-color</code>, <code>--planner-break-color</code>) via <code>color-mix()</code> for tinted backgrounds — no new hex values introduced.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Utility hide rules: <code>.sidebar-section[hidden]</code>, <code>.library-card[hidden]</code>, <code>.sidebar-sections[hidden]</code>, <code>.sidebar-custom-activity-section[hidden]</code>, <code>.side__group[hidden]</code>, <code>.side__group-empty[hidden]</code>. Lets the filter module + legacy-section wrapper hide nodes via the native HTML <code>hidden</code> attribute.</li>
        </ul>
    </div>
</div>

<!-- v2.1.0 -->
<div class="changelog-entry">
    <div class="changelog-date">May 2026</div>
    <div class="changelog-version">v2.1.0 — Level Up Grid: phase grouping + button --half</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_level_up_grid()</code> now supports an optional <code>group_by_phase =&gt; true</code> mode that renders Learn / Plan / Facilitate / Reflect as their own sub-sections, each with an italic phase title and a half-paragraph intro in Workshopr voice (overridable via <code>phase_copy</code>).</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> CSS classes for the grouped layout: <code>.ws-level-up__phase</code>, <code>.ws-level-up__phase-head</code>, <code>.ws-level-up__phase-title</code>, <code>.ws-level-up__phase-desc</code>, plus phase-color modifiers (<code>--learn / --plan / --facilitate / --reflect</code>) on the phase block itself.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>.ws-level-up__grid--3</code> modifier for 3-up phase rows (used by Learn and Plan phases). Existing 4-up grid stays the default.</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>.ws-btn--half</code> width modifier (50%) — sized for narrow card columns where <code>--full</code> reads as too dominant.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Responsive overrides updated so both <code>.ws-level-up__grid</code> and <code>.ws-level-up__grid--3</code> step down 4 → 3 → 2 → 1 column, and <code>.ws-level-up__phase-head</code> stacks below 1024px.</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Demo: <code>/design-system/components/demos/level-up-grid.php</code> now showcases the grouped variant. Button demo cheatsheet lists <code>--half</code>.</li>
        </ul>
    </div>
</div>

<!-- v2.0.0 -->
<div class="changelog-entry">
    <div class="changelog-date">April 2026</div>
    <div class="changelog-version">v2.0.0 — Planner ws_* Component Migration (Phase 5)</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Migrated <code>planner/edit.php</code> buttons and form inputs from raw HTML to <code>ws_button()</code> and <code>ws_input()</code></li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Migrated remaining raw inputs in <code>planner/includes/modals.php</code> — invite email, role select, search inputs, category filter</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Replaced raw type badges and duration spans in <code>planner/view.php</code> with <code>ws_badge()</code> and <code>ws_duration()</code></li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Standardized <code>planner/saved.php</code> buttons with <code>ws_button()</code></li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Migrated schedule panel in <code>planner/planner.php</code> — date/time inputs, timezone select, footer buttons</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Tokenized inline checkbox styles in save modal to use <code>var(--space-*)</code> and <code>var(--text-sm)</code></li>
        </ul>
    </div>
</div>

<!-- v1.9.1 -->
<div class="changelog-entry">
    <div class="changelog-date">April 2026</div>
    <div class="changelog-version">v1.9.1 — Planner Brand Color Tokenization</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> Added <code>--planner-overlay-light/medium/heavy</code> and <code>--planner-backdrop/backdrop-light</code> tokens to planner variables</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Tokenized standalone <code>#E54D4D</code> (red), <code>#22C55E</code> (green), <code>#9333EA</code> (purple), <code>#F59E0B</code> (warning) hex values across planner CSS to use <code>var(--planner-*)</code> and <code>var(--color-*)</code> tokens</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Replaced standalone <code>#2563EB</code> in planner cards and generator modal with <code>var(--planner-exercise-color)</code></li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Tokenized status/semantic colors (warning, error, success backgrounds) in planner-v2.css, analytics.css, exercise-builder.css, briefing.css, live-mode.css</li>
        </ul>
    </div>
</div>

<!-- v1.9.0 -->
<div class="changelog-entry">
    <div class="changelog-date">April 2026</div>
    <div class="changelog-version">v1.9.0 — Cool Gray Eradication & Structural Adoption</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Eradicated all 354 hardcoded cool gray hex values across 23 CSS files. Entire platform now uses warm stone grays (<code>--gray-50</code> through <code>--gray-900</code>) exclusively</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Added <code>helpers.php</code> to global <code>header.php</code> — all pages now have automatic access to <code>ws_*</code> component helpers without manual includes</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Migrated <code>/contact/</code> form from raw HTML to <code>ws_input()</code>, <code>ws_select()</code>, <code>ws_button()</code> components</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Replaced 6 hardcoded <code>font-family: 'Bitter'</code> in MyWorkshopr CSS with <code>var(--font-heading)</code></li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Cleaned up 2 <code>DM Sans</code> font fallbacks in Academy CSS</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Coach variables now reference <code>var(--gray-*)</code> tokens for text colors instead of cool gray hex values</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Landing page, auth modal, content gating, and typography base CSS fallbacks updated from cool to warm stone</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Added "Touch It, Fix It" convention to <code>Conventions.md</code> for ongoing adoption enforcement</li>
        </ul>
    </div>
</div>

<!-- v1.8.4 -->
<div class="changelog-entry">
    <div class="changelog-date">April 2026</div>
    <div class="changelog-version">v1.8.4 — Live-Mode Font-Size Normalization</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Normalized all hardcoded <code>font-size</code> values in <code>live-mode.css</code> to design system tokens: compact type scale variables for UI chrome, <code>rem</code> units for presentation display elements, icon sizes preserved as <code>px</code></li>
        </ul>
    </div>
</div>

<div class="changelog-entry">
    <div class="changelog-date">April 2026</div>
    <div class="changelog-version">v1.8.3 — Planner Font-Weight & Font-Size Normalization</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Converted 9 hardcoded <code>font-size</code> px values to <code>rem</code> units in <code>run-mode.css</code> and <code>workshop-studio.css</code></li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Replaced all hardcoded <code>font-weight</code> numeric values (400/500/600/700) with design tokens (<code>--font-normal</code>, <code>--font-medium</code>, <code>--font-semibold</code>, <code>--font-bold</code>) across 7 planner CSS files</li>
        </ul>
    </div>
</div>

<!-- v1.8.2 -->
<div class="changelog-entry">
    <div class="changelog-date">April 2026</div>
    <div class="changelog-version">v1.8.2 — Facilitator CSS Hardening</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Replaced ~25 instances of <code>transition: all</code> in facilitator.css with specific property transitions using design tokens (<code>--duration-fast</code>, <code>--duration-base</code>)</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Tokenized ~40 standalone hardcoded hex colors to CSS variables with fallbacks (<code>--color-warning-*</code>, <code>--color-error-*</code>, <code>--color-success-*</code>, <code>--color-info-*</code>, <code>--phase-facilitate-*</code>, <code>--gray-*</code>)</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Added <code>:focus-visible</code> outlines to all 45+ interactive elements in the Facilitator app (buttons, tabs, cards, inputs)</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Added <code>@media (prefers-reduced-motion: reduce)</code> block scoped to <code>.facilitator-app</code></li>
        </ul>
    </div>
</div>

<!-- v1.8.1 -->
<div class="changelog-entry">
    <div class="changelog-date">March 2026</div>
    <div class="changelog-version">v1.8.1 — Secondary Button Refinement</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>.ws-btn--secondary</code> hover style updated: now uses a subtle background tint (<code>--phase-learn-very-light</code>) and darker text instead of a full solid color fill, matching the academy pattern for a more refined interaction</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> <code>.ws-btn--secondary</code> default background changed from opaque white (<code>--bg-surface</code>) to <code>transparent</code> for better layering on non-white backgrounds</li>
        </ul>
    </div>
</div>

<!-- v1.8.0 -->
<div class="changelog-entry">
    <div class="changelog-date">March 2026</div>
    <div class="changelog-version">v1.8.0 — Semantic Tokens & Cross-App Polish</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> 40+ semantic component tokens added to <code>platform-tokens.css</code> — buttons, cards, inputs, modals, badges, tooltips, toasts, links, and dividers now have dedicated token sets</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Standard suffix convention documented in style guide: <code>-dark</code>, <code>-light</code>, <code>-very-light</code>, <code>-secondary</code>, <code>-muted</code>, <code>-faint</code></li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Semantic component token documentation in <code>tokens.php</code> with full usage tables for each category</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Google Font imports cleaned across 24 PHP templates — removed unused Bitter and DM Sans font families from <code>&lt;link&gt;</code> tags</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Coach landing pages updated: inline CSS font references migrated from DM Sans to Inter</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Token count updated from 180+ to 280+ across documentation and hero stats</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Changelog CSS now uses design tokens instead of hardcoded hex values</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Audit score: <strong>87 → 92/100</strong></li>
        </ul>
    </div>
</div>

<!-- v1.7.0 -->
<div class="changelog-entry">
    <div class="changelog-date">March 2026</div>
    <div class="changelog-version">v1.7.0 — Comprehensive Audit & Migration</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> 6 overlay/backdrop tokens added: <code>--backdrop-light</code>, <code>--backdrop-medium</code>, <code>--backdrop-heavy</code>, <code>--backdrop-brand</code>, <code>--overlay-white</code>, <code>--overlay-surface</code></li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Accessible contrast alternatives: <code>--color-primary-on-white</code> (#C73E3E, 5.02:1) and <code>--color-ink-faint-accessible</code> (#78716C, 4.6:1)</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Contrast reference table added to <code>colors.php</code> documentation</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Deprecation timeline for legacy v1.x tokens — v2.0 sunset plan with console warning phase</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>components/components.css</code> — dedicated component stylesheet separated from token file</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Full ARIA + keyboard navigation documentation added to Tabs, Accordion, Tooltip, and Modal components</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Font migration complete across all microsites: Bitter → Fraunces, DM Sans → Inter in 9 CSS files</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Planner hardcoded color sweep: 156 hex → token replacements across 9 CSS files (86% reduction, 361 → 49)</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Modal component documentation now includes parameters table</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Breakpoint documentation updated from 4 to 6 breakpoints matching <code>platform-tokens.css</code></li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> 8 cool gray hex values in <code>overview.php</code> and 4 in <code>changelog.php</code> replaced with warm stone palette</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>--phase-reflect-light</code> corrected to #A7F3D0; missing <code>-very-light</code> variants added</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Hero stats corrected: "15 Components" → "33", "100+ Design Tokens" → "280+"</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Missing half-step spacing tokens and typography tokens added to documentation</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> <code>.app-badge</code> component CSS moved out of <code>platform-tokens.css</code> into <code>components.css</code></li>
            <li><span class="changelog-tag changelog-tag--deprecated">Deprecated</span> Legacy token aliases (v1.x names) — scheduled for removal in v2.0</li>
            <li><span class="changelog-tag changelog-tag--fixed">Fixed</span> Audit score: <strong>62 → 78 → 87/100</strong></li>
        </ul>
    </div>
</div>

<!-- v1.6.0 -->
<div class="changelog-entry">
    <div class="changelog-date">March 2026</div>
    <div class="changelog-version">v1.6.0 — Specialized Components</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_chip_input()</code> — Multi-value input with removable chip tokens for email lists and tag inputs</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_radio_card_group()</code> — Single-select card grid with icon, title, and description per option</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_checkbox_card_group()</code> — Multi-select card grid for choosing multiple options</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_suggestion_card()</code> — Action-oriented card for AI suggestions and contextual prompts</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_modal_footer()</code> — Standardized modal footer with primary/secondary action buttons</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_activity_badge()</code> — Color-coded activity type badge (exercise/icebreaker/break)</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_results_overlay()</code> — Full-screen/inline overlay for results, scores, and completion states</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>.ws-toggle</code> — Reusable toggle switch CSS extracted from planner patterns</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>.ws-chip</code> — Chip markup pattern with remove button for JS-rendered chips</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Component library grid updated with all 7 new component entries and demo pages</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> CSS uses platform tokens with hardcoded fallbacks so components work outside the planner</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> CLAUDE.md updated with mandatory design system usage rules and full component list</li>
        </ul>
    </div>
</div>

<!-- v1.5.0 -->
<div class="changelog-entry">
    <div class="changelog-date">February 2026</div>
    <div class="changelog-version">v1.5.0 — Developer Experience</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> Copy-to-clipboard button on all <code>.ds-code</code> blocks (hover to reveal)</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Responsive preview toolbar (Desktop / Tablet / Mobile) on component demos</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Live demo for <code>ws_hero()</code> — full, minimal, and accent variants with rendered output</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Live demo for <code>ws_listing_card()</code> — workshop, exercise, and icebreaker card examples</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Code blocks now show copy button on hover with "Copied" confirmation feedback</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Demo containers auto-wrap with responsive preview controls via shared DS footer</li>
        </ul>
    </div>
</div>

<!-- v1.4.0 -->
<div class="changelog-entry">
    <div class="changelog-date">February 2026</div>
    <div class="changelog-version">v1.4.0 — New Components</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_section_header()</code> — Page/section titles with subtitle, label, and alignment options</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_feature_card()</code> — Icon + title + description cards with compact and coming-soon variants</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_stat()</code> / <code>ws_stats()</code> — Single metric display and grouped stat rows with dividers</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_checklist()</code> — Icon-prefixed lists with custom icons and compact variant</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_empty_state()</code> — Placeholder with icon, description, and CTA button</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_breadcrumb()</code> — Accessible navigation trail with separator icons</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Added animation/transition tokens to <code>platform-tokens.css</code></li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Swept <code>index.php</code> and <code>about/index.php</code> to use component library</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Added storybook-style documentation pages for all new components</li>
            <li><span class="changelog-tag changelog-tag--improved">Improved</span> Updated component library grid and sidebar navigation</li>
        </ul>
    </div>
</div>

<!-- v1.3.0 -->
<div class="changelog-entry">
    <div class="changelog-date">January 2026</div>
    <div class="changelog-version">v1.3.0 — Component Library</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_badge()</code>, <code>ws_duration()</code>, <code>ws_category()</code>, <code>ws_status()</code> — Badge system</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_button()</code>, <code>ws_icon_button()</code> — Button with variants, sizes, loading state</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_input()</code>, <code>ws_select()</code> — Form field components</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_card_start()</code> / <code>ws_card_end()</code> — Card containers</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_avatar()</code> — User avatars with initials fallback</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_modal_start()</code> / <code>ws_modal_end()</code> — Dialogs, drawers, bottom sheets</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_tabs()</code> — Tab navigation</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_tooltip()</code> — Contextual hints on hover/focus</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_accordion()</code> — Collapsible content sections</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_progress()</code> — Progress bars and indeterminate loading</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_alert()</code> — Notification banners with actions</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> <code>ws_skeleton()</code> — Loading placeholder system</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Toast notification JS (<code>wsToastSuccess</code>, <code>wsToastError</code>, etc.)</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Component documentation pages for each component</li>
        </ul>
    </div>
</div>

<!-- v1.2.0 -->
<div class="changelog-entry">
    <div class="changelog-date">December 2025</div>
    <div class="changelog-version">v1.2.0 — Design System Foundations</div>
    <div class="ds-card">
        <ul class="changelog-list">
            <li><span class="changelog-tag changelog-tag--new">New</span> Design system microsite with sidebar navigation</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Color palette, typography, spacing, and elevation documentation</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Platform design tokens (<code>platform-tokens.css</code>)</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Philosophy, voice & tone, and design decisions pages</li>
            <li><span class="changelog-tag changelog-tag--new">New</span> Icons reference and accessibility guidelines</li>
        </ul>
    </div>
</div>

<?php require_once __DIR__ . '/includes/ds-footer.php'; ?>
