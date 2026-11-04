<?php
$ds_page  = 'apps/app-shell-layouts';
$ds_title = 'App Shell Layouts';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>App Shell Layouts</h1>
    <p>The layout system behind <code>/app/</code>. Four page archetypes and four content grids, measured at 1440.</p>
</div>

<div class="ds-note">
    <span class="material-symbols-outlined">info</span>
    <div>
        <strong>This is not Page Templates.</strong> That page covers the main site, where a page is
        <code>includes/header.php</code> plus a <code>.container</code>. The app shell is a different frame:
        a fixed rail, a document bar, a main region that scrolls on its own, and drafting paper behind it.
        Nothing on that page applies here.
    </div>
</div>

<!-- The frame -->
<section class="ds-section">
    <h2 class="ds-section-title">The frame</h2>
    <p class="ds-section-desc">Constant on every route. Measured from the live DOM at a 1440 viewport, and matching <code>app/css/app-shell.css</code>.</p>

    <table class="ds-table">
        <thead><tr><th>Region</th><th>Class</th><th>Size</th><th>Notes</th></tr></thead>
        <tbody>
            <tr><td>Global header</td><td><code>.wsh-header</code></td><td>1440 &times; 60</td><td><code>ws_header($section)</code>, 17 section keys</td></tr>
            <tr><td>Rail</td><td><code>.ws-sidenav</code></td><td>100 wide</td><td>Ink <code>#2C2416</code>; the shell inverts the component's light surface</td></tr>
            <tr><td>Main region</td><td><code>.app-shell__main</code></td><td>1340 wide</td><td>Scrolls on its own; drafting paper, 24px grid</td></tr>
            <tr><td>Document bar</td><td><code>.ws-app-bar</code></td><td>1340 &times; 60</td><td><code>--app-bar-height</code>; four states. Renders only for plan, facilitate, synthesize and prove: home, settings, stuff and library have none.</td></tr>
            <tr><td>Footer</td><td><code>.ws-app-footer</code></td><td>1440 &times; 48</td><td>Absent on full-bleed routes</td></tr>
        </tbody>
    </table>
</section>

<!-- The four archetypes -->
<section class="ds-section">
    <h2 class="ds-section-title">Four page archetypes</h2>
    <p class="ds-section-desc">The shell is config-driven. Every view declares label, icon, header, eyebrow, title and lede, and two flags in <code>app/index.php</code> pick the frame. There are four shapes, not twenty-six.</p>

    <table class="ds-table">
        <thead><tr><th>Archetype</th><th>Decided by</th><th>Content slot</th><th>Routes</th></tr></thead>
        <tbody>
            <tr>
                <td><strong>Full bleed</strong></td>
                <td><code>$fullBleed</code></td>
                <td>x 0, w 1340. No column, no gutters, no footer.</td>
                <td>plan/build (iframe), plan/check, facilitate/run, synthesize/make, synthesize/recap</td>
            </tr>
            <tr>
                <td><strong>Page grid</strong></td>
                <td>not full bleed</td>
                <td>x 48, w 1244. <code>.app-shell__content</code> (<code>max-width: calc(var(--app-content-wide) + 48px * 2)</code>) holding <code>.app-page</code>: a six-column main (928) beside the two-column rail (296). The reading measure (1131) and <code>$wideContent</code> retired in September 2026.</td>
                <td>every other route: home, plan/home, plan/saved, strategize &times;5, facilitate/home, synthesize/home, prove/home, prove/report, settings, stuff &times;6, library, sign-in</td>
            </tr>
            <tr>
                <td><strong>Handoff sheet</strong></td>
                <td>the <code>else</code> branch</td>
                <td>The page grid, holding <code>.app-shell__sheet</code> in the main: eyebrow, title, lede, one primary button, with the shared rail beside it (Tips alone for a stranger). <strong>No document bar</strong>, so content starts 24px below the region top rather than 84px.</td>
                <td>library</td>
            </tr>
        </tbody>
    </table>

    <div class="ds-note">
        <span class="material-symbols-outlined">lightbulb</span>
        <div>A dashboard is not prose, and neither is a form. The six-column main (928) is the measure that keeps both off a 1400px line, and a document inside it takes five columns (770, <code>.prv-report</code>) or four (612). That replaced the old choice between a 1131 reading measure and a 1244 wide column.</div>
    </div>
</section>

<!-- Content grids -->
<section class="ds-section">
    <h2 class="ds-section-title">Content grids</h2>
    <p class="ds-section-desc">What goes inside the wide column. All four are measured against its 1244, where the arithmetic closes exactly. Defined in <code>app/css/app-shell.css</code>.</p>

    <p class="ds-section-desc">
        One page grid, since September 2026: eight columns of <code>--app-grid-col</code> (138px) with
        <code>--app-grid-gutter</code> (20px) between them, 8 &times; 138 + 7 &times; 20 =
        <code>--app-content-wide</code> (1244), the content column at 1440. A rail is two columns
        (<code>--app-rail</code>, 296) and the main beside it is six (928). <code>.app-page</code> is the
        page-level grid with the rail and main placed; <code>.app-grid-8</code> is the same tracks as a bare
        primitive for layouts inside a column. The old <code>.app-cols</code> split (892 + 320 at a 32px gap)
        was deleted once its last view had moved.
    </p>

    <table class="ds-table">
        <thead><tr><th>Class</th><th>Columns</th><th>Gap</th><th>Status</th></tr></thead>
        <tbody>
            <tr>
                <td><code>.app-page</code></td>
                <td>138 &times;8 at 1244 &mdash; <code>.app-page__main</code> spans 6 (928), <code>.app-rail</code> spans 2 (296); <code>.app-page--rail-left</code> puts the rail first</td>
                <td><code>--app-grid-gutter</code> 20px</td>
                <td><span class="ds-status ds-status--stable">shipped</span></td>
            </tr>
            <tr>
                <td><code>.app-grid-8</code></td>
                <td>138 &times;8 at 1244 &mdash; the bare primitive; span with <code>.app-span-2/-3/-4/-6/-full</code></td>
                <td><code>--app-grid-gutter</code> 20px</td>
                <td><span class="ds-status ds-status--stable">shipped</span></td>
            </tr>
            <tr>
                <td><code>.app-grid-6</code></td>
                <td>138 &times;6 inside a 928 main</td>
                <td><code>--app-grid-gutter</code> 20px</td>
                <td><span class="ds-status ds-status--stable">shipped</span></td>
            </tr>
            <tr>
                <td><code>.app-grid-4</code></td>
                <td>296 &times;4 at 1244 &mdash; inside the full width only (217 inside a main is off-grid)</td>
                <td><code>--app-grid-gutter</code> 20px</td>
                <td><span class="ds-status ds-status--stable">shipped</span></td>
            </tr>
            <tr>
                <td><code>.app-grid-3</code></td>
                <td>296 &times;3 inside a 928 main &mdash; where <code>.wl-grid</code> lands by itself</td>
                <td><code>--app-grid-gutter</code> 20px</td>
                <td><span class="ds-status ds-status--stable">shipped</span></td>
            </tr>
            <tr>
                <td><code>.app-grid-2</code></td>
                <td>454 &times;2 inside a main, 612 &times;2 at 1244</td>
                <td><code>--app-grid-gutter</code> 20px</td>
                <td><span class="ds-status ds-status--stable">shipped</span></td>
            </tr>
        </tbody>
    </table>

    <div class="ds-code"><pre>&lt;div class="app-shell__content"&gt;
  &lt;div class="app-page"&gt;
    &lt;div class="app-page__main"&gt;&lt;!-- six columns, 928 --&gt;&lt;/div&gt;
    &lt;aside class="app-rail"&gt;&lt;!-- two columns, 296, sticky --&gt;&lt;/aside&gt;
  &lt;/div&gt;
&lt;/div&gt;</pre></div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do</strong> open <code>.app-page</code> on every non-bleed view, keep the rail as the
            <code>&lt;aside class="app-rail"&gt;</code> that <code>appShellRail()</code> renders, and lay the main
            column out with <code>.app-grid-6</code>, <code>-3</code> or <code>-2</code>, which reproduce the page
            columns exactly. Span two or three of <code>.app-grid-8</code> and put a card in that.
        </div>
        <div class="ds-dont">
            <strong>Don't</strong> put one card per column in <code>.app-grid-8</code>. At 138px a card is
            barely half the 260px floor <code>.wl-grid</code> enforces, and that floor was written after an
            uncapped three-column grid drew 214px cards. Don't use <code>.app-grid-4</code> inside a main
            (217 is off-grid) or <code>.app-grid-3</code> at the full width. Don't reintroduce a local
            split or a local cap: the grid owns width.
        </div>
    </div>

    <div class="ds-note">
        <span class="material-symbols-outlined">info</span>
        <div>
            <code>tests/E2E/app-grid.spec.js</code> reads the used track sizes back from the browser: eight
            tracks of 138 at 1440, main 928, rail 296, on every non-bleed route.
            Under 1100px the grid halves and the rail drops beneath the main column at full width.
        </div>
    </div>
</section>

<!-- Reconciled -->
<section class="ds-section">
    <h2 class="ds-section-title">Measured against the running app</h2>
    <p class="ds-section-desc">Every number on this page was taken from <code>/app/</code> in a browser at 1440 on 17 September 2026, not from the CSS alone. Three things the design files had wrong were corrected to match.</p>

    <table class="ds-table">
        <thead><tr><th>What</th><th>Was drawn as</th><th>Actually is</th></tr></thead>
        <tbody>
            <tr>
                <td>Document bar height</td>
                <td>72 (the <code>ws-app-bar</code> Figma component)</td>
                <td><strong>60</strong> (<code>--app-bar-height</code>), which puts the content slot at y&nbsp;84, not y&nbsp;96</td>
            </tr>
            <tr>
                <td>Handoff sheet</td>
                <td>with a document bar, content at y&nbsp;84</td>
                <td><strong>no bar at all</strong>; <code>/app/?view=library</code> renders none, so content starts at y&nbsp;24</td>
            </tr>
            <tr>
                <td>Reading measure</td>
                <td>1244, widened to match the other templates</td>
                <td><strong>1131</strong>; the templates were reverted rather than the app widened</td>
            </tr>
        </tbody>
    </table>

    <div class="ds-note">
        <span class="material-symbols-outlined">check_circle</span>
        <div>The Figma templates and this page now carry the same numbers as the app. Confirmed in the browser: header 60, rail 100, main 1340, bar 60, wide column 1244, reading measure 1131, footer 48.</div>
    </div>
</section>

<!-- Figma -->
<section class="ds-section">
    <h2 class="ds-section-title">In Figma</h2>
    <p class="ds-section-desc">Eight components, one per archetype and one per grid, on the <code>templates</code> page of the <code>synthesize</code> file, in the section &ldquo;App &mdash; Layout Templates&rdquo;.</p>

    <table class="ds-table">
        <thead><tr><th>Component</th><th>Content slot</th></tr></thead>
        <tbody>
            <tr><td>App / Template / 1 Full bleed</td><td>x 0, w 1340</td></tr>
            <tr><td>App / Template / 2 Wide column</td><td>x 48, w 1244</td></tr>
            <tr><td>App / Template / 3 Reading measure</td><td>x 48, w 1131</td></tr>
            <tr><td>App / Template / 4 Handoff sheet</td><td>x 48, w 1131, y 24, no bar</td></tr>
            <tr><td>App / Template / 5 Four columns</td><td>296 &times;4</td></tr>
            <tr><td>App / Template / 6 Small left, large right</td><td>296 + 928 &mdash; rail two columns, then main six; <code>.app-page--rail-left</code></td></tr>
            <tr><td>App / Template / 7 Large left, small right</td><td>928 + 296 &mdash; main six columns, then rail two; <code>.app-page</code></td></tr>
            <tr><td>App / Template / 7 Large left, small right / no bar</td><td>the same without the document bar, content from y 24 &mdash; home, settings, stuff and library render no bar. The first screen drawn on it is <code>App / home</code> in the section &ldquo;App &mdash; Screens&rdquo;, a detached copy filled with library instances.</td></tr>
            <tr><td>App / Template / 8 Eight columns</td><td>138 &times;8 at 20 &mdash; the grid 6 and 7 are spans of; all three slots carry it as a layout grid</td></tr>
        </tbody>
    </table>

    <div class="ds-note">
        <span class="material-symbols-outlined">info</span>
        <div>Every frame is 1440 &times; 1024 with the chrome instanced, so the only thing that varies between templates is the content slot. The rail is cloned from a live capture and its active row reads Strategize on all eight; set it per screen.</div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
