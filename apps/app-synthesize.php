<?php
/**
 * Synthesize app guide + component gallery.
 *
 * Synthesize renders every screen from JavaScript template strings
 * (synthesize/synthesize.js), so there are no ws_* helpers to demo — the
 * contract is the class names in synthesize/synthesize.css. This page renders
 * those classes directly, in every state, against the real stylesheet: edit
 * synthesize.css and the specimens here move with the app.
 *
 * Everything in synthesize.css is scoped under `.synth`, so each specimen sits
 * inside a .synth wrapper. The exceptions are .synth-modal, .synth-overlay and
 * .synth-topbar, which are top-level — those are marked where they appear.
 */
$ds_page  = 'apps/app-synthesize';
$ds_title = 'Synthesize App Guide';

require_once __DIR__ . '/../../includes/icon.php';
require_once __DIR__ . '/../../includes/components/helpers.php';
require_once __DIR__ . '/../includes/ds-header.php';

/**
 * Frame one specimen: a label, the live markup, and an optional note.
 * $wrap = false for the handful of classes that live outside .synth.
 */
function sy_spec(string $label, string $html, string $note = '', bool $wrap = true): void {
    echo '<div class="sy-spec">';
    echo '<div class="sy-spec__label">' . htmlspecialchars($label) . '</div>';
    echo '<div class="sy-spec__stage">' . ($wrap ? '<div class="synth">' . $html . '</div>' : $html) . '</div>';
    if ($note !== '') echo '<div class="sy-spec__note">' . $note . '</div>';
    echo '</div>';
}

/** A row of specimens that should be compared side by side. */
function sy_row_start(string $cols = 'repeat(auto-fit, minmax(280px, 1fr))'): void {
    echo '<div class="sy-specs" style="grid-template-columns: ' . $cols . '">';
}
function sy_row_end(): void { echo '</div>'; }

$ico = static fn(string $n): string => '<span class="material-symbols-outlined">' . $n . '</span>';
?>
<link rel="stylesheet" href="<?= $site_base ?>/synthesize/synthesize.css">
<style>
    /* Gallery chrome only — never ship these to the app. Kept deliberately
       neutral so the specimens, not the frame, carry all the colour. */
    /* align-items: start so a short specimen isn't stretched to match a tall
       neighbour — the frame should never add height the component doesn't have. */
    .sy-specs { display: grid; gap: 16px; margin-bottom: 16px; align-items: start; }
    .sy-spec { border: 1px solid var(--border-light); border-radius: 10px; overflow: hidden; background: var(--bg-surface); }
    .sy-spec__label {
        font-size: 11px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase;
        padding: 8px 12px; border-bottom: 1px solid var(--border-light);
        color: var(--color-ink-muted); background: var(--bg-subtle);
    }
    .sy-spec__stage { padding: 16px; background: var(--bg-page); }
    .sy-spec__note { font-size: 12px; line-height: 1.5; padding: 8px 12px; border-top: 1px solid var(--border-light); color: var(--color-ink-muted); }
    .sy-spec__note code { font-size: 11px; }
    /* The frame's own .synth wrappers must not inherit the app's locked-viewport
       rules — the gallery scrolls like a normal page. */
    .sy-spec__stage .synth { min-height: 0; background: none; }
    .sy-anatomy { display: flex; flex-direction: column; gap: 6px; }
    .sy-anatomy div { padding: 9px 14px; border-radius: 4px; font-size: 13px; background: var(--bg-subtle); border-left: 3px solid var(--phase-learn); }
    .sy-meta-label { font-size: 11px; text-transform: uppercase; letter-spacing: .08em; color: var(--color-ink-faint); margin-bottom: 8px; }
    .sy-note { font-size: 13px; color: var(--color-ink-muted); }
</style>

<div class="ds-page-header">
    <h1>Synthesize</h1>
    <p>The post-session sense-making tool: drop in transcripts, board photos, and recordings, and get back themes, decisions, and action items you would actually send. Reflect phase.</p>
</div>

<!-- How to use this page -->
<section class="ds-section">
    <h2 class="ds-section-title">How to use this page</h2>
    <p class="ds-section-desc">Synthesize has no <code class="ds-code-inline">ws_*</code> helpers of its own. Every screen is built from JavaScript template strings in <code class="ds-code-inline">synthesize/synthesize.js</code>, so the real contract is the class names in <code class="ds-code-inline">synthesize/synthesize.css</code>. This page renders those classes against that stylesheet — change the CSS and these specimens move with the app.</p>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Design here first</strong>
            <div style="margin-top: 8px; font-size: 13px;">Every element appears in all its states — empty, loading, done, muted, overflowing. Most of Synthesize's rough edges are states that were never seen next to each other.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't add styles to this page</strong>
            <div style="margin-top: 8px; font-size: 13px;">The only CSS here is gallery chrome. A specimen that needs a style to look right is telling you the style belongs in <code>synthesize.css</code>.</div>
        </div>
    </div>

    <div class="ds-card" style="margin-top: 16px;">
        <strong style="font-size: 14px;">The <code class="ds-code-inline">.synth</code> scope</strong>
        <div style="font-size: 14px; line-height: 1.6; margin-top: 6px;">Everything in <code class="ds-code-inline">synthesize.css</code> is scoped under <code class="ds-code-inline">.synth</code>. Specimens here are wrapped accordingly. If a block on this page renders unstyled, it is missing its wrapper. The three exceptions — <code class="ds-code-inline">.synth-modal</code>, <code class="ds-code-inline">.synth-overlay</code>, <code class="ds-code-inline">.synth-topbar</code> — are top-level and marked where they appear.</div>
    </div>
</section>

<!-- App Identity -->
<section class="ds-section">
    <h2 class="ds-section-title">App Identity</h2>
    <div class="ds-grid-3" style="margin-bottom: 16px;">
        <div class="ds-card">
            <div class="sy-meta-label">Phase</div>
            <div style="font-weight: 600; color: var(--phase-learn-dark);">Reflect</div>
        </div>
        <div class="ds-card">
            <div class="sy-meta-label">Accent</div>
            <div style="display: flex; align-items: center; gap: 8px;">
                <span style="width: 20px; height: 20px; background: var(--phase-learn); border-radius: 4px;"></span>
                <code class="ds-code-inline">--phase-learn</code>
            </div>
        </div>
        <div class="ds-card">
            <div class="sy-meta-label">Rendering</div>
            <div style="font-weight: 600;">Client-side (vanilla JS)</div>
        </div>
    </div>
    <p class="sy-note">Red Unification: Synthesize sits in the Reflect phase by name only. Like every app on the platform it renders in the Learn red family — the legacy Reflect emerald is retired.</p>
</section>

<!-- Token aliases -->
<section class="ds-section">
    <h2 class="ds-section-title">Token Aliases</h2>
    <p class="ds-section-desc"><code class="ds-code-inline">synthesize.css</code> opens with a block of short local variables aliased onto platform tokens, so the app's rules stay terse. Anything without a platform token behind it is listed as such — those are the honest gaps, not drift.</p>
    <table class="ds-table">
        <thead><tr><th>Local</th><th>Resolves to</th><th>Notes</th></tr></thead>
        <tbody>
            <tr><td><code>--accent / --accentD / --accentVL</code></td><td><code>--phase-learn</code> / <code>-dark</code> / <code>-light</code></td><td>Unified brand red</td></tr>
            <tr><td><code>--accentL</code></td><td><em>none</em> — <code>#FCA5A5</code></td><td>Red-300 step between light and main; no platform token exists</td></tr>
            <tr><td><code>--ink / --ink2 / --muted / --faint</code></td><td><code>--color-ink*</code> ramp</td><td>Warm ink</td></tr>
            <tr><td><code>--hair</code></td><td><em>none</em> — <code>#C4BCB0</code></td><td>Hairline between faint ink and border</td></tr>
            <tr><td><code>--bgPage / --surface / --subtle</code></td><td><code>--bg-page</code> / <code>--bg-surface</code> / <code>--bg-subtle</code></td><td></td></tr>
            <tr><td><code>--border / --inner</code></td><td><em>none</em> — <code>#E8E3DC</code> / <code>#F0EBE4</code></td><td>Warm borders; the platform only defines a cool border token</td></tr>
            <tr><td><code>--ok</code></td><td><em>none</em> — <code>#047857</code></td><td>Decision green — the one non-red semantic in the app</td></tr>
            <tr><td><code>--sticky</code></td><td><em>none</em> — <code>#FEF9C3</code></td><td>Rendered sticky-note yellow; functional, mirrors the source board</td></tr>
            <tr><td><code>--rCard / --rModal / --rBadge</code></td><td><code>--radius-xl</code> / <code>-2xl</code> / <code>-sm</code></td><td></td></tr>
        </tbody>
    </table>
</section>

<!-- App frame -->
<section class="ds-section">
    <h2 class="ds-section-title">App Frame</h2>
    <p class="ds-section-desc">Every working screen wears the same frame: sources rail, working surface, and the AI panel when open. All three render inside <code class="ds-code-inline">#synth-app</code> so the app's single delegated click/drag handler keeps working.</p>

    <?php sy_row_start('1fr'); ?>
    <?php sy_spec('.sy-app — rail + working surface',
        '<div class="sy-app" style="grid-template-columns:200px minmax(0,1fr)">'
        . '<aside class="sy-rail"><h2 class="sy-rail__h">Sources<span class="sy-rail__count">2</span></h2>'
        . '<div class="sy-rail__empty">Nothing added yet.</div></aside>'
        . '<div class="sy-main"><div class="sy-main__bar">'
        . '<button class="linkback">' . $ico('arrow_back') . ' All syntheses</button>'
        . '<div class="sy-tools">'
        . '<button class="sy-tool">' . $ico('videocam') . '<span class="sy-tool__tip">Meeting recording</span></button>'
        . '<button class="sy-tool">' . $ico('description') . '<span class="sy-tool__tip">Transcript</span></button>'
        . '<button class="sy-tool">' . $ico('photo_camera') . '<span class="sy-tool__tip">Whiteboard photos</span></button>'
        . '</div></div>'
        . '<div style="min-height:90px"></div>'
        . '<div class="sy-main__foot"><span class="hint">Sign in to save drafts.</span>'
        . '<button class="ws-btn ws-btn--primary ws-btn--md">' . $ico('auto_awesome') . ' Start synthesis</button></div>'
        . '</div></div>',
        'The working surface carries the drafting grid over <code>--bg-page</code>, so page and surface read as one sheet. Grid cell and line colour both come from platform tokens.'
    ); ?>
    <?php sy_row_end(); ?>

    <h3 class="ds-subsection-title">Anatomy</h3>
    <div class="sy-anatomy">
        <div><code>.sy-app</code> — the grid. Two columns; a third 340px column appears above 1440px when the AI panel opens.</div>
        <div><code>.sy-rail</code> — sticky sources rail, <code>--app-rail-width</code> (320px).</div>
        <div><code>.sy-main</code> — working surface. Drafting grid, hairline border, <code>--rCard</code> radius.</div>
        <div><code>.sy-main__bar</code> — row one: where you are (back link or tabs) + how to add material.</div>
        <div><code>.sy-tools</code> / <code>.sy-tool</code> — 38px icon rail; labels live in <code>.sy-tool__tip</code> on hover.</div>
        <div><code>.sy-main__foot</code> — hint on the left, committing action on the right.</div>
    </div>

    <h3 class="ds-subsection-title" style="margin-top: 24px;">Responsive behaviour</h3>
    <table class="ds-table">
        <thead><tr><th>Width</th><th>Frame</th><th>AI panel</th></tr></thead>
        <tbody>
            <tr><td>&ge; 1440px</td><td>Three columns</td><td>Grid column, 340px</td></tr>
            <tr><td>1081&ndash;1439px</td><td>Two columns</td><td>Fixed sheet on the right edge, under the chrome via <code>--synth-stage-top</code></td></tr>
            <tr><td>&le; 1080px</td><td>Single column, rail last</td><td>Bottom sheet, 78vh</td></tr>
        </tbody>
    </table>
</section>

<!-- Sources -->
<section class="ds-section">
    <h2 class="ds-section-title">Sources</h2>
    <p class="ds-section-desc">What you gathered. The rail persists through the whole session, so after synthesis it is still how you get back to where a theme came from.</p>

    <?php sy_row_start(); ?>
    <?php sy_spec('.tray-item — default',
        '<div class="tray tray--rail"><div class="tray-item">'
        . '<div class="tray-tile">' . $ico('description') . '</div>'
        . '<div class="tray-main"><div class="tray-title">Q2 offsite transcript</div>'
        . '<div class="tray-meta">Transcript &middot; 4,210 words</div></div>'
        . '<button class="del">' . $ico('close') . '</button></div></div>'
    ); ?>
    <?php sy_spec('.tray-item--session — workshop record',
        '<div class="tray tray--rail"><div class="tray-item tray-item--session">'
        . '<div class="tray-tile">' . $ico('sensors') . '</div>'
        . '<div class="tray-main"><div class="tray-title">Live session signals</div>'
        . '<div class="tray-meta">14 notes &middot; 3 polls &middot; 8 reactions</div></div>'
        . '<button class="del">' . $ico('close') . '</button></div></div>',
        'Accent border and tint mark the one artifact that keeps changing — it is re-imported, not uploaded.'
    ); ?>
    <?php sy_spec('.tray-title — long name (2-line clamp)',
        '<div class="tray tray--rail"><div class="tray-item">'
        . '<div class="tray-tile">' . $ico('folder_open') . '</div>'
        . '<div class="tray-main"><div class="tray-title">Q3 platform strategy workshop &mdash; combined notes, whiteboard captures and the follow-up thread</div>'
        . '<div class="tray-meta">Document &middot; 18 pages</div></div>'
        . '<button class="del">' . $ico('close') . '</button></div></div>',
        'A source is identified by its name, so the rail wraps to two lines rather than truncating mid-word.'
    ); ?>
    <?php sy_spec('.sy-rail__empty',
        '<aside class="sy-rail"><h2 class="sy-rail__h">Sources<span class="sy-rail__count">0</span></h2>'
        . '<div class="sy-rail__empty">Nothing added yet. Drop a file on the canvas, or use the icons above it.'
        . '<button class="ws-btn ws-btn--secondary ws-btn--sm">' . $ico('space_dashboard') . ' Try a demo board</button></div>'
        . '</aside>'
    ); ?>
    <?php sy_row_end(); ?>

    <?php sy_row_start('1fr'); ?>
    <?php sy_spec('.sy-drop — the empty state\'s centre',
        '<label class="dropzone sy-drop">' . $ico('upload_file')
        . '<span class="sy-drop__text"><strong>Drop anything here</strong><br>Board photos, caption files (.vtt/.srt), transcripts or docs (.pdf/.docx/.txt) &mdash; or paste text or a FigJam link anywhere on this page.</span></label>'
    ); ?>
    <?php sy_row_end(); ?>
</section>

<!-- Themes -->
<section class="ds-section">
    <h2 class="ds-section-title">Themes</h2>
    <p class="ds-section-desc">The clustering output — now rendered by the recap-first surface, not the specimens this section used to show.</p>

    <div class="ds-card">
        <strong style="font-size: 14px;">Retired 2026-08-09 — see Workspace's Themes tab instead</strong>
        <div style="font-size: 14px; line-height: 1.6; margin-top: 6px;">
            <code class="ds-code-inline">.theme-card</code>, <code class="ds-code-inline">.themes-grid</code>, <code class="ds-code-inline">.theme-chev</code>, <code class="ds-code-inline">.theme-top</code>, <code class="ds-code-inline">.theme-dot</code>, <code class="ds-code-inline">.theme-title</code>, <code class="ds-code-inline">.theme-notes</code>, <code class="ds-code-inline">.theme-badges</code>, <code class="ds-code-inline">.theme-points</code>, <code class="ds-code-inline">.themes-bar</code>, the bare <code class="ds-code-inline">.evidence</code>/<code class="ds-code-inline">.ev-card</code> containers, the theme card's <code class="ds-code-inline">.menu</code>/<code class="ds-code-inline">.menu-wrap</code> overflow menu, and the "Alternate layouts" <code class="ds-code-inline">.kanban</code>/<code class="ds-code-inline">.kan-*</code> and <code class="ds-code-inline">.outline</code>/<code class="ds-code-inline">.ol-*</code> specimens that lived here were deleted from <code class="ds-code-inline">synthesize.css</code> when Task 11 (recap-first redesign closeout) confirmed zero remaining callers.<br><br>
            The current theme surface is <code class="ds-code-inline">.recap-theme</code>/<code class="ds-code-inline">.recap-theme__head</code>/<code class="ds-code-inline">.recap-theme__title</code>/<code class="ds-code-inline">.recap-evidence</code>/<code class="ds-code-inline">.recap-evidence__toggle</code> (the "View sources (N)" disclosure), shared verbatim between the Recap document (<code class="ds-code-inline">synthesize/js/modules/recap.js</code>) and Workspace's Themes tab (<code class="ds-code-inline">synthesize/js/modules/workspace.js</code>). The inner evidence-row pieces (<code class="ds-code-inline">.ev-text</code>/<code class="ds-code-inline">.ev-by</code>/<code class="ds-code-inline">.ev-foot</code>/<code class="ds-code-inline">.ev-quote</code>) are unchanged and still live. Each row cites its source with the shared <code class="ds-code-inline">ws_source_chip</code> (drawn by <code class="ds-code-inline">WsAgent.sourceChip()</code> in the app), which replaced Synthesize's own <code class="ds-code-inline">.src-chip</code>; see its <a href="../components/demos/source-chip.php">demo</a>.
        </div>
    </div>
</section>

<!-- Priorities -->
<section class="ds-section">
    <h2 class="ds-section-title">Priorities</h2>
    <p class="ds-section-desc">Three lenses on the same themes. A theme sits in the tray until it has been placed under the current lens — an empty grid is honest about the fact that nobody has judged anything yet.</p>

    <?php sy_row_start('1fr'); ?>
    <?php sy_spec('.prio-bar + .prio-tray — nothing placed yet',
        '<div class="prio-bar"><div class="seg prio-fw">'
        . '<button class="on">Impact &times; Effort</button>'
        . '<button>Eisenhower &middot; Urgent &times; Important</button>'
        . '<button>Value &times; Risk</button></div>'
        . '<div class="prio-tools"><button class="ws-btn ws-btn--secondary ws-btn--sm">' . $ico('bolt') . ' Auto-Sort</button>'
        . '<button class="ws-btn ws-btn--secondary ws-btn--sm">' . $ico('save') . ' Save</button>'
        . '<button class="ws-btn ws-btn--secondary ws-btn--sm">' . $ico('restart_alt') . ' Reset</button></div></div>'
        . '<div class="prio-tray"><span class="prio-tray__label">Drag onto the grid</span>'
        . '<button class="prio-chip">Decisions go undocumented</button>'
        . '<button class="prio-chip">Too much synchronous status</button>'
        . '<button class="prio-chip">Whose voice gets heard</button></div>',
        'The lens is a named choice, not a carousel position. The tray sits <em>below</em> the grid, so reading order runs lens &rarr; grid &rarr; what is still unplaced. Watch the vertical budget: the 2&times;2 is 543px tall, so with enough unplaced themes the tray wraps to several rows and falls below the fold on a 900px viewport.'
    ); ?>
    <?php sy_spec('.prio-tray — everything placed',
        '<div class="prio-tray"><span class="prio-tray__done">' . $ico('check_circle') . ' Every theme is on the grid.</span></div>'
    ); ?>
    <?php sy_spec('.matrix — with .dot-card',
        '<div class="matrix-wrap"><div class="matrix" style="max-width:520px">'
        . '<span class="axis-label axis-top">High impact</span>'
        . '<span class="axis-label axis-bottom">Low impact</span>'
        . '<span class="axis-label axis-left">Low effort</span>'
        . '<span class="axis-label axis-right">High effort</span>'
        . '<span class="quad-label" style="top:48px;left:48px">Quick wins</span>'
        . '<span class="quad-label" style="top:48px;right:48px">Big bets</span>'
        . '<span class="quad-label" style="bottom:48px;left:48px">Fill-ins</span>'
        . '<span class="quad-label" style="bottom:48px;right:48px">Park</span>'
        . '<div class="vline"></div><div class="hline"></div>'
        . '<div id="prio-plot-demo" style="position:absolute;inset:44px">'
        . '<div class="dot-card" style="left:28%;top:30%"><span class="pri-dot" style="background:var(--phase-learn-dark)"></span>Decisions go undocumented</div>'
        . '<div class="dot-card" style="left:70%;top:66%">Whose voice gets heard</div>'
        . '</div></div></div>',
        '<code>.dot-card</code> is drag-positioned in percentages, so the grid stays responsive.'
    ); ?>
    <?php sy_row_end(); ?>
</section>

<!-- Actions & Decisions -->
<section class="ds-section">
    <h2 class="ds-section-title">Action Items &amp; Decisions</h2>
    <p class="ds-section-desc">The two facts that decide whether an action happens — who owns it and when it is due — now render inline in the recap document, not as the grid cards this section used to show.</p>

    <div class="ds-card">
        <strong style="font-size: 14px;">Retired 2026-08-09 — see the recap document's Decisions/Actions sections instead</strong>
        <div style="font-size: 14px; line-height: 1.6; margin-top: 6px;">
            <code class="ds-code-inline">.act-grid</code>, <code class="ds-code-inline">.act-card</code> (open/done/unassigned), <code class="ds-code-inline">.act-progress</code>, <code class="ds-code-inline">.dec-grid</code>, and <code class="ds-code-inline">.dec-card</code> were deleted from <code class="ds-code-inline">synthesize.css</code> when Task 11 confirmed zero remaining callers — the card-grid layout they demoed is gone, replaced by a one-document read (<code class="ds-code-inline">#recap-actions</code>/<code class="ds-code-inline">#recap-decisions</code> in <code class="ds-code-inline">synthesize/js/modules/recap.js</code>).<br><br>
            The reusable, non-hover-scoped inner pieces are unchanged and still live, just nested in the new <code class="ds-code-inline">.recap-action</code>/<code class="ds-code-inline">.recap-decision</code> containers instead: <code class="ds-code-inline">.act-body</code>, <code class="ds-code-inline">.act-text</code>, <code class="ds-code-inline">.act-meta</code>, <code class="ds-code-inline">.act-field</code>, <code class="ds-code-inline">.act-check</code>, <code class="ds-code-inline">.carried-chip</code>, <code class="ds-code-inline">.dec-check</code>, <code class="ds-code-inline">.dec-text</code>.
        </div>
    </div>
</section>

<!-- Quick Summary -->
<section class="ds-section">
    <h2 class="ds-section-title">Quick Summary</h2>
    <p class="ds-section-desc">The first tab, and the first thing anyone reads. Numbered so it reads as an ordered take rather than a bag of bullets, and flagged as a draft in words rather than by implication.</p>

    <?php sy_row_start('1fr'); ?>
    <?php sy_spec('.sum-head + .sum-list',
        '<div class="sum-head"><span class="sum-flag">' . $ico('bolt') . ' Draft</span>'
        . '<span class="sum-note">Not a final summary. Edit any line, or ask for a fresh pass.</span>'
        . '</div>'
        . '<ol class="sum-list">'
        . '<li class="sum-card"><span class="sum-num">1</span><span class="sum-text">The group is hungry for clearer decisions &mdash; three separate threads all point at the same gap.</span><button class="del">' . $ico('close') . '</button></li>'
        . '<li class="sum-card"><span class="sum-num">2</span><span class="sum-text">Status meetings are the most-named drag on the team\'s time.</span><button class="del">' . $ico('close') . '</button></li>'
        . '<li class="sum-card"><span class="sum-num">3</span><span class="sum-text">The offsite-is-too-long tension is loud enough to flag up.</span><button class="del">' . $ico('close') . '</button></li>'
        . '</ol>'
    ); ?>
    <?php sy_spec('Redraft lives in the app bar, not here',
        '<div class="sum-head"><span class="sum-flag">' . $ico('bolt') . ' Draft</span>'
        . '<span class="sum-note">Not a final summary. Edit any line, or ask for a fresh pass.</span></div>',
        'The head states the draft status and nothing else. Redraft is a chrome action (<code>#synthTopbarRedraft</code>), shown only while Quick Summary is the active tab and disabled while a rewrite is in flight. It runs over the board <em>as it stands after your edits</em>, not the material the first pass saw.'
    ); ?>
    <?php sy_row_end(); ?>
</section>

<!-- Synthesizer AI -->
<section class="ds-section">
    <h2 class="ds-section-title">Synthesizer AI</h2>
    <p class="ds-section-desc">A chat grounded in the board you have open. It reads the themes, decisions, and actions; nothing it says is written into the synthesis unless you copy it there yourself.</p>

    <div class="ds-card">
        <strong style="font-size: 14px;">Retired 2026-08-09 — the fixed side flyout is gone, the chat log stays</strong>
        <div style="font-size: 14px; line-height: 1.6; margin-top: 6px;">
            <code class="ds-code-inline">.sy-ai</code> (the fixed-position side panel, both its base rule and its &lt;1080px sheet override) and its <code class="ds-code-inline">.ai-head</code>/<code class="ds-code-inline">.ai-head__icon</code>/<code class="ds-code-inline">.ai-title</code> title-bar chrome were deleted from <code class="ds-code-inline">synthesize.css</code> when Task 11 confirmed zero remaining callers — Synthesizer AI is now Workspace's own "Ask Synthesizer" tab, embedded inline in the content column (<code class="ds-code-inline">synthesize/js/modules/workspace.js</code>) rather than a flyout, so it needs no fixed positioning or its own close-button header.<br><br>
            Reused verbatim by that tab: <code class="ds-code-inline">.ai-log</code>, <code class="ds-code-inline">.ai-empty</code>, <code class="ds-code-inline">.ai-suggestions</code>/<code class="ds-code-inline">.ai-suggest</code>, <code class="ds-code-inline">.ai-msg</code>, <code class="ds-code-inline">.ai-bubble</code> (including <code class="ds-code-inline">.is-error</code>) and <code class="ds-code-inline">.ai-composer</code>. The shared agent components replaced the rest: the AI's side of each message carries <code class="ds-code-inline">ws_ai_mark</code> where <code class="ds-code-inline">.ai-avatar</code> stood, the typing bubble (<code class="ds-code-inline">.ai-bubble--typing</code>) is now the <code class="ds-code-inline">ws_agent_status</code> thinking line, and a drafted change is a <code class="ds-code-inline">ws_agent_proposal</code> card. The app draws all three through <code class="ds-code-inline">WsAgent</code> (<code class="ds-code-inline">js/ws-agent.js</code>). The specimens below render on the live stylesheet.
        </div>
    </div>

    <?php sy_row_start('repeat(auto-fit, minmax(320px, 1fr))'); ?>
    <?php sy_spec('.ai-bubble.is-error',
        '<div class="ai-log" style="padding:0">'
        . '<div class="ai-msg ai-msg--ai">' . ws_ai_mark(['size' => 'md', 'label' => 'Synthesizer'])
        . '<div class="ai-bubble is-error">Couldn\'t reach the assistant. Check your connection and try again.</div></div>'
        . '</div>',
        'A failed turn stays in the log as a message rather than a toast, so the thread still reads in order. The AI mark, labelled, stands for the Synthesizer.'
    ); ?>
    <?php sy_spec('ws_agent_status (thinking)',
        '<div class="ai-log" style="padding:0">'
        . '<div class="ai-msg ai-msg--ai">' . ws_agent_status(['label' => 'Reading the board']) . '</div>'
        . '</div>',
        'While a reply is on its way. The app draws it through <code>WsAgent.mountStatus()</code>, so the line is read out once per wait.'
    ); ?>
    <?php sy_row_end(); ?>
</section>

<!-- Review & loading -->
<section class="ds-section">
    <h2 class="ds-section-title">Review &amp; Loading</h2>
    <p class="ds-section-desc">The steps between dropping material and seeing a board.</p>

    <?php sy_row_start(); ?>
    <?php sy_spec('.load-steps',
        '<ul class="load-steps">'
        . '<li class="load-step done">' . $ico('check_circle') . 'Reading your sources</li>'
        . '<li class="load-step done">' . $ico('radio_button_checked') . 'Clustering the notes</li>'
        . '<li class="load-step">' . $ico('radio_button_unchecked') . 'Naming the themes</li>'
        . '<li class="load-step">' . $ico('radio_button_unchecked') . 'Pulling out decisions and actions</li>'
        . '</ul><div class="load-hint" style="margin-top:16px">This usually takes a few seconds. We\'re drafting &mdash; you\'ll edit everything next.</div>',
        'Shown without its <code>.loading</code> wrapper, which centres the steps in a <code>56vh</code> grid on the real screen.'
    ); ?>
    <?php sy_spec('.ws-skeleton — boot skeleton',
        '<div class="sy-app" style="grid-template-columns:120px minmax(0,1fr)">'
        . '<aside class="sy-rail">' . ws_skeleton(['variant' => 'text', 'class' => 'ws-skeleton--text-title']) . '</aside>'
        . '<div class="sy-main">' . ws_skeleton(['variant' => 'text', 'class' => 'ws-skeleton--text-title'])
        . ws_skeleton(['variant' => 'text', 'class' => 'ws-skeleton--text-short']) . ws_skeleton(['variant' => 'text']) . '</div></div>',
        'Platform skeletons, which bring their own shimmer; a still screenshot catches it mid-sweep.'
    ); ?>
    <?php sy_spec('.ws-alert--warning',
        ws_alert("That's a lot of material (72,400 chars). Trim it under 60,000 before synthesizing.", ['variant' => 'warning'])
    ); ?>
    <?php sy_spec('.ws-empty-state',
        ws_empty_state('No decisions captured', ['icon' => 'gavel', 'description' => 'Add one below if the group committed to something.'])
    ); ?>
    <?php sy_row_end(); ?>
</section>

<!-- Tabs & segmented -->
<section class="ds-section">
    <h2 class="ds-section-title">Navigation</h2>
    <?php sy_row_start('1fr'); ?>
    <?php sy_spec('.ws-tabs--underline',
        '<div class="ws-tabs ws-tabs--underline ws-tabs--md ws-tabs--scrollable"><div class="ws-tabs__nav" role="tablist">'
        . '<button type="button" class="ws-tabs__btn is-active"><span class="ws-tabs__label">Quick Summary</span></button>'
        . '<button type="button" class="ws-tabs__btn"><span class="ws-tabs__label">Themes</span><span class="ws-tabs__count">8</span></button>'
        . '<button type="button" class="ws-tabs__btn"><span class="ws-tabs__label">Priorities</span></button>'
        . '<button type="button" class="ws-tabs__btn"><span class="ws-tabs__label">Action Items</span><span class="ws-tabs__count">4</span></button>'
        . '<button type="button" class="ws-tabs__btn"><span class="ws-tabs__label">Decisions</span><span class="ws-tabs__count">3</span></button>'
        . '</div></div>',
        'Platform tabs. <code>components.js</code> only auto-binds <code>.ws-tabs</code> on <code>DOMContentLoaded</code>, and Synthesize renders these later &mdash; so the active state stays the app\'s to manage, which it already did.'
    ); ?>
    <?php sy_spec('.seg — segmented control',
        '<div class="seg"><button class="on">Grid</button><button>List</button><button>Kanban</button></div>',
        '<strong>No platform equivalent exists.</strong> Synthesize, Planner, and Facilitator each have their own segmented control. This is the strongest candidate for a real <code>ws_segmented</code>.'
    ); ?>
    <?php sy_row_end(); ?>
</section>

<!-- Adopted from the platform -->
<section class="ds-section">
    <h2 class="ds-section-title">Adopted from the Platform</h2>
    <p class="ds-section-desc"><code class="ds-code-inline">includes/header.php</code> loads <code class="ds-code-inline">components.css</code> on every page, so all 58 platform components were already present inside Synthesize &mdash; the app just re-implemented a handful of them privately. Those private copies are gone. The PHP <code class="ds-code-inline">ws_*</code> helpers still can't be called from a client-rendered app, so <code class="ds-code-inline">synthesize.js</code> emits the same class names directly; small mirrors of the templates live next to <code class="ds-code-inline">icon()</code> in that file.</p>

    <table class="ds-table">
        <thead><tr><th>Was</th><th>Now</th><th>What stayed local, and why</th></tr></thead>
        <tbody>
            <tr><td><code>.btn</code>, <code>--accent</code>, <code>--sm</code>, <code>--ghost</code></td><td><code>.ws-btn</code> + <code>--primary</code>/<code>--secondary</code>/<code>--ghost</code> + sizes</td><td>Only the Material Symbols sizing &mdash; <code>ws_button</code> ships inline SVG, the app emits ligatures</td></tr>
            <tr><td><code>.sy-skel</code> + its shimmer</td><td><code>.ws-skeleton</code> + 9 variants</td><td>Nothing. Emitted as <code>&lt;div&gt;</code>: the component sets no <code>display</code>, so a span would collapse</td></tr>
            <tr><td><code>.guardrail</code></td><td><code>.ws-alert--warning</code> / <code>--error</code></td><td><code>.synth-alert--spaced</code>, for an alert sitting inside a modal body</td></tr>
            <tr><td><code>.empty</code></td><td><code>.ws-empty-state</code></td><td>Nothing. Loading lines moved to <code>.load-hint</code> &mdash; they were never empty states</td></tr>
            <tr><td><code>.badge</code>, <code>.pill</code></td><td><code>.ws-badge</code>, <code>.ws-pill</code></td><td><code>.pri-badge</code> and <code>.cat-pill</code>: both carry a colour set inline from app state, so they only make the text legible on top of it</td></tr>
            <tr><td><code>.tabrow</code> / <code>.tab</code></td><td><code>.ws-tabs--underline</code></td><td>Nothing. This also retired the reset Synthesize needed against the global <code>.tab</code> pill rule</td></tr>
        </tbody>
    </table>

    <div class="ds-card" style="margin-top: 16px;">
        <strong style="font-size: 14px;">Not adopted yet</strong>
        <div style="font-size: 14px; line-height: 1.6; margin-top: 6px;">
            <code class="ds-code-inline">.synth-modal</code> / <code class="ds-code-inline">.synth-overlay</code> &rarr; <code class="ds-code-inline">.ws-modal</code>: needs the focus trap in <code class="ds-code-inline">components.js</code> checked against Synthesize's own handling first.<br>
            <span style="color: var(--text-muted, #A8A29E);">(The <code class="ds-code-inline">.sy-ai</code> &rarr; <code class="ds-code-inline">.ws-modal--drawer</code> row that used to sit here is moot: <code class="ds-code-inline">.sy-ai</code> was deleted 2026-08-09 — Synthesizer AI is a Workspace tab now, not a panel to adopt a drawer shell for. See the Synthesizer AI section above.)</span>
        </div>
    </div>

    <div class="ds-card" style="margin-top: 12px;">
        <strong style="font-size: 14px;">The one real gap: no shared segmented control</strong>
        <div style="font-size: 14px; line-height: 1.6; margin-top: 6px;">Synthesize, Planner, and Facilitator each ship their own <code class="ds-code-inline">.seg</code>. There is no <code class="ds-code-inline">ws_segmented</code> to adopt, which makes it the strongest candidate for the next real component &mdash; not a swap, a promotion.</div>
    </div>
</section>

<!-- Stays local -->
<section class="ds-section">
    <h2 class="ds-section-title">Stays Local</h2>
    <p class="ds-section-desc">These have exactly one consumer. Promoting them to <code class="ds-code-inline">ws_*</code> would be speculative generality and would add drift-check burden for no reuse &mdash; so they stay in <code class="ds-code-inline">synthesize.css</code>, documented here instead.</p>
    <table class="ds-table">
        <thead><tr><th>Component</th><th>Classes</th><th>Why it stays</th></tr></thead>
        <tbody>
            <tr><td>App frame</td><td><code>.sy-app</code>, <code>.sy-rail</code>, <code>.sy-main</code>, <code>.sy-tools</code></td><td>Planner and Facilitator have their own shells with different anatomy</td></tr>
            <tr><td>Theme/evidence card</td><td><code>.recap-theme</code>, <code>.recap-evidence</code>, <code>.ev-text</code>/<code>.ev-by</code>/<code>.ev-foot</code>/<code>.ev-quote</code></td><td>Evidence-traced clustering output; nothing else on the platform produces it. (Renamed 2026-08-09 from <code>.theme-card</code>/<code>.theme-points</code>/<code>.evidence</code>/<code>.ev-card</code>, retired with the old five-tab board.)</td></tr>
            <tr><td>Priority matrix</td><td><code>.matrix</code>, <code>.dot-card</code>, <code>.prio-tray</code>, <code>.prio-chip</code></td><td>Drag-positioned 2&times;2 tied to the framework definitions in <code>synthesize.js</code></td></tr>
            <tr><td>Source artifact card</td><td><code>.tray-item</code>, <code>.tray-item--session</code></td><td>Shape is dictated by the artifact types Synthesize ingests</td></tr>
            <tr><td>AI panel</td><td><code>.ai-msg</code>, <code>.ai-bubble</code>, <code>.ai-composer</code></td><td>Chat is Synthesize-only today &mdash; revisit if a second app grows one. (No longer <code>.sy-ai</code>: that fixed side-panel container was retired 2026-08-09; these classes now live inline in Workspace's Ask Synthesizer tab.)</td></tr>
            <tr><td>Summary card</td><td><code>.sum-card</code>, <code>.sum-num</code>, <code>.sum-flag</code></td><td>Numbered draft list; close to <code>ws_checklist</code> but semantically different</td></tr>
        </tbody>
    </table>
</section>

<!-- Do / Don't -->
<section class="ds-section">
    <h2 class="ds-section-title">Do / Don't</h2>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: say it is a draft</strong>
            <div style="margin-top: 8px; font-size: 13px;">Synthesize outputs a first pass over someone's workshop. The Draft flag and the editable-everything rule are the product's honesty about that.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: present output as an answer</strong>
            <div style="margin-top: 8px; font-size: 13px;">A confident summary of a session the model half-understood is worse than no summary. Never hide the seams.</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: show what a grouping is made of</strong>
            <div style="margin-top: 8px; font-size: 13px;">Themes render their first notes collapsed, and evidence traces back to its source. The user is checking the machine's work.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: hide evidence behind a click</strong>
            <div style="margin-top: 8px; font-size: 13px;">A theme title alone gives no way to judge whether the clustering held.</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: start empty when nothing has been judged</strong>
            <div style="margin-top: 8px; font-size: 13px;">The priority grid opens empty with every theme in the tray. Auto-Sort is one click away when you want the machine's read.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: pre-place items and call it a judgement</strong>
            <div style="margin-top: 8px; font-size: 13px;">A grid that looks filled in implies agreement nobody expressed &mdash; the same reason unplaced themes are excluded from the cross-lens consensus read.</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: keep chrome in the app bar</strong>
            <div style="margin-top: 8px; font-size: 13px;">Session name, undo/redo, save state, AI, Export, Save and New all live in <code>ws_app_bar</code>. The canvas is pure workspace.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: add a second toolbar in the canvas</strong>
            <div style="margin-top: 8px; font-size: 13px;">The retired <code>.res-head</code> duplicated the doc-bar. A test asserts it never comes back.</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: animate only what persists</strong>
            <div style="margin-top: 8px; font-size: 13px;">The app re-renders wholesale on every state change, so animation belongs on infinite indicators, not on entry.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: add entry animations to re-rendered nodes</strong>
            <div style="margin-top: 8px; font-size: 13px;">They replay on every keystroke-free update and read as flicker.</div>
        </div>
    </div>
</section>

<!-- Shared components used -->
<section class="ds-section">
    <h2 class="ds-section-title">Shared Components Used</h2>
    <p class="ds-section-desc">Two <code class="ds-code-inline">ws_*</code> helpers are called from the PHP shell. The rest of the platform components reach the app as <em>classes</em>, emitted from <code class="ds-code-inline">synthesize.js</code> &mdash; the helpers can't be called from a client-rendered body, but the CSS is already on the page either way.</p>
    <table class="ds-table">
        <thead><tr><th>Component</th><th>How it gets there</th><th>Usage</th></tr></thead>
        <tbody>
            <tr><td><code>ws_app_bar()</code></td><td>PHP, <code>synthesize/app.php</code></td><td>Session name, undo/redo, library, AI, Export, Save, New</td></tr>
            <tr><td><code>ws_header()</code></td><td>PHP, <code>synthesize/app.php</code></td><td>Platform nav above the shell (<code>$ws_header_section = 'synthesize'</code>)</td></tr>
            <tr><td><code>.ws-btn</code></td><td>Class, from JS</td><td>Every button in the app &mdash; 66 call sites</td></tr>
            <tr><td><code>.ws-tabs--underline</code></td><td>Class, from JS</td><td>The five results tabs</td></tr>
            <tr><td><code>.ws-badge</code> / <code>.ws-pill</code></td><td>Class, from JS (<code>wsBadge</code>, <code>wsPill</code>)</td><td>Priority bands, category tags, the muted marker</td></tr>
            <tr><td><code>.ws-alert</code></td><td>Class, from JS (<code>wsAlert</code>)</td><td>The material-size guardrail; board-import errors</td></tr>
            <tr><td><code>.ws-empty-state</code></td><td>Class, from JS (<code>wsEmpty</code>)</td><td>Empty summary, actions, decisions, workshop list, saved list, detached source</td></tr>
            <tr><td><code>.ws-skeleton</code></td><td>Class, from JS (<code>wsSkel</code>)</td><td>Boot and saved-list skeletons</td></tr>
        </tbody>
    </table>
</section>

<!-- Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>synthesize/app.php</code></td><td>Shell: header, app bar, <code>#synth-app</code> mount</td></tr>
            <tr><td><code>synthesize/synthesize.js</code></td><td>Every screen, rendered from template strings</td></tr>
            <tr><td><code>synthesize/synthesize.css</code></td><td>All app styles, scoped under <code>.synth</code></td></tr>
            <tr><td><code>api/synthesize.php</code></td><td>Synthesis, persistence, imports, and the Synthesizer AI <code>chat</code> action</td></tr>
            <tr><td><code>synthesize/tests/synthesize.spec.js</code></td><td>Playwright E2E over the shell, tabs, priorities, and the AI panel</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
