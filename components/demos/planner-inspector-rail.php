<?php
$ds_page  = 'components/demos/planner-inspector-rail';
$ds_title = 'Planner Inspector Rail';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Planner Inspector Rail</h1>
    <p>The Planner's right column when nothing is selected: energy, coach suggestions, and who else is in the room.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            You need the Planner's right column in its default, whole-agenda state &mdash; three fixed sections, each optional. It's the counterpart to <a href="<?= $ds_base ?>/components/demos/planner-activity-inspector.php">Planner Activity Inspector</a>, which takes over when an item is selected.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            An activity is selected &mdash; swap to the activity inspector. And don't reach for it if you need sections beyond these three; the anatomy is deliberately fixed.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Canonical &mdash; all three sections</h3>
        <p class="ds-section-desc">Note the energy section's title and meta sit <em>outside</em> the card: the rail auto-sets <code class="ds-code-inline">showHeader =&gt; false</code> on the wrapped <a href="<?= $ds_base ?>/components/demos/energy-arc-card.php">Energy Arc Card</a> and defaults its score badge to the <code class="ds-code-inline">note</code> variant, so the badge sits beside the score without dominating.</p>
        <div class="ds-card">
            <div class="ds-ir-stage">
                <div class="ds-ir-shell">
                    <?= ws_planner_inspector_rail([
                        'energy' => [
                            'title' => 'Energy arc',
                            'meta'  => '8 of 4h used · 0m over',
                            'card'  => [
                                'score'      => 82,
                                'scoreBadge' => ['text' => 'Strong shape', 'type' => 'success'],
                                'chartData'  => [
                                    ['time' => '9:00',  'value' => 48],
                                    ['time' => '10:15', 'value' => 82],
                                    ['time' => '11:10', 'value' => 62],
                                    ['time' => '12:00', 'value' => 92],
                                ],
                                'timeLabels' => ['9:00', '10:15', '11:10', '12:00'],
                                'metrics' => [
                                    ['label' => 'Cognitive', 'value' => '72', 'fill' => 72],
                                    ['label' => 'Social',    'value' => '88', 'fill' => 88],
                                    ['label' => 'Physical',  'value' => '54', 'fill' => 54],
                                    ['label' => 'Emotional', 'value' => '76', 'fill' => 76],
                                ],
                            ],
                        ],
                        'coach' => [
                            'title' => 'Coach suggests',
                            'meta'  => '3 notes',
                            'items' => [
                                ['icon' => 'schedule',    'pre' => 'TIMING', 'line' => 'Five Whys runs long in groups of 3 &mdash; budget <em>45 min</em>, not 40.', 'meta' => 'Based on 142 prior runs', 'action' => 'apply'],
                                ['icon' => 'monitoring',  'pre' => 'ENERGY', 'line' => 'The 2-hour mark is where cognitive load peaks &mdash; consider a <em>standing</em> exercise around 11:00.', 'meta' => '+6 pts to Physical', 'action' => 'preview'],
                                ['icon' => 'chat_bubble', 'pre' => 'CLOSE',  'line' => 'Pre-mortems land harder when the close <em>commits in writing</em>, not just verbally. Add a 3-min capture.', 'meta' => 'Reflect phase', 'action' => 'add 3m'],
                            ],
                        ],
                        'facilitators' => [
                            'title' => 'Facilitators',
                            'meta'  => '3 collaborating',
                            'avatars' => [
                                ['initials' => 'PS', 'bg' => 'linear-gradient(135deg,#2E77B3,#1E5887)'],
                                ['initials' => 'MK', 'bg' => 'linear-gradient(135deg,#D64545,#A12E2E)'],
                                ['initials' => 'LG', 'bg' => 'linear-gradient(135deg,#B8862E,#8B6520)'],
                            ],
                            'presence' => ['name' => 'Priya Sundararajan', 'status' => 'editing · 2 others viewing'],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_planner_inspector_rail([
    'energy' => [
        'title' => 'Energy arc',
        'meta'  => '8 of 4h used · 0m over',
        'card'  => [ /* forwarded to ws_energy_arc_card */ ],
    ],
    'coach' => [
        'title' => 'Coach suggests',
        'meta'  => '3 notes',
        'items' => [
            ['icon' => 'schedule', 'pre' => 'TIMING',
             'line' => 'Five Whys runs long — budget &lt;em&gt;45 min&lt;/em&gt;, not 40.',
             'meta' => 'Based on 142 prior runs', 'action' => 'apply'],
        ],
    ],
    'facilitators' => [
        'title'    => 'Facilitators',
        'avatars'  => [['initials' => 'PS', 'bg' => '…']],
        'presence' => ['name' => 'Priya Sundararajan', 'status' => 'editing · 2 others viewing'],
    ],
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Energy only</h3>
        <p class="ds-section-desc">Omit a section and it disappears. Use this when the rail only needs to surface the arc &mdash; a solo facilitator with no coach notes.</p>
        <div class="ds-card">
            <div class="ds-ir-stage">
                <div class="ds-ir-shell" style="height: 380px;">
                    <?= ws_planner_inspector_rail([
                        'energy' => [
                            'title' => 'Energy arc',
                            'meta'  => '4 of 4h used',
                            'card'  => [
                                'score'      => 94,
                                'scoreBadge' => ['text' => 'Excellent', 'type' => 'success'],
                                'chartData'  => [
                                    ['time' => '9:00',  'value' => 65],
                                    ['time' => '10:30', 'value' => 80],
                                    ['time' => '12:00', 'value' => 92],
                                    ['time' => '3:00',  'value' => 96],
                                ],
                                'timeLabels' => ['9:00', '12:00', '3:00'],
                                'metrics' => [
                                    ['label' => 'Cognitive', 'value' => '85', 'fill' => 85],
                                    ['label' => 'Social',    'value' => '91', 'fill' => 91],
                                    ['label' => 'Physical',  'value' => '80', 'fill' => 80],
                                    ['label' => 'Emotional', 'value' => '88', 'fill' => 88],
                                ],
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_planner_inspector_rail(['energy' => ['title' => 'Energy arc', 'card' => $arc]]) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Section present</td><td>Rendered with a divider above it. The last section takes <code>--section--last</code> and drops its trailing rule.</td></tr>
            <tr><td>Section omitted</td><td>Passing <code>null</code> or leaving the key out removes it entirely &mdash; no heading, no divider.</td></tr>
            <tr><td>Suggestion emphasis</td><td>Inline <code>&lt;em&gt;</code> inside a coach <code>line</code> renders in the phase colour. It's the one place markup is honoured, so escape any user data before it goes in.</td></tr>
            <tr><td>Suggestion icons</td><td>Defaulted from <code>pre</code> when no <code>icon</code> is given: <em>TIMING</em>&rarr;<code>schedule</code>, <em>ENERGY</em>&rarr;<code>monitoring</code>, <em>CLOSE</em>&rarr;<code>chat_bubble</code>.</td></tr>
            <tr><td>Presence</td><td>Static text as passed. The rail doesn't poll or subscribe &mdash; supply fresh values from your own presence layer.</td></tr>
            <tr><td>Phase theming</td><td>Accents read <code>--wpir-phase</code>. Override it on the container through <code>attrs</code> to retheme the rail for another app.</td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">warning</span>
        <span>When overriding <code>--wpir-phase</code>, pass a token reference &mdash; <code>style="--wpir-phase: var(--phase-facilitate);"</code> &mdash; not a literal hex. Earlier guidance here suggested <code>#7C4DFF</code>, which is the retired pre-unification purple; every phase token now resolves to Learn Red.</span>
    </div>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The Planner's right column, swapping between this rail and the activity inspector on selection. Energy comes from the scorer; suggestions from the Coach; presence from the live layer.</p>
    <div class="ds-code"><pre>&lt;?php if ($selectedItem): ?&gt;
    &lt;?= ws_planner_activity_inspector($selectedItem) ?&gt;
&lt;?php else: ?&gt;
    &lt;?= ws_planner_inspector_rail([
        'energy' => [
            'title' => 'Energy arc',
            'meta'  => formatDuration($used) . ' of ' . formatDuration($total) . ' used',
            'card'  => $energyScorer-&gt;cardOptions($planId),
        ],
        'coach' => $suggestions ? [
            'title' => 'Coach suggests',
            'meta'  => count($suggestions) . ' notes',
            'items' => array_map(fn($s) => [
                'pre'    => strtoupper($s['category']),
                'line'   => $s['html'],          // pre-escaped, may contain &lt;em&gt;
                'meta'   => $s['evidence'],
                'action' => $s['action_label'],
            ], $suggestions),
        ] : null,
        'facilitators' => $collaborators ? [
            'title'    => 'Facilitators',
            'meta'     => count($collaborators) . ' collaborating',
            'avatars'  => array_map(fn($c) => ['initials' => $c['initials'], 'bg' => $c['color']],
                                    $collaborators),
            'presence' => ['name' => $activeEditor['name'], 'status' => $activeEditor['status']],
        ] : null,
    ]) ?&gt;
&lt;?php endif; ?&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>energy</code></td><td>array|null</td><td><code>['title', 'meta', 'card']</code>. <code>card</code> is forwarded to <code>ws_energy_arc_card()</code>; the rail sets <code>showHeader =&gt; false</code> and defaults the score badge to <code>note</code>.</td></tr>
            <tr><td><code>coach</code></td><td>array|null</td><td><code>['title', 'meta', 'items']</code>, each item <code>['icon?', 'pre', 'line', 'meta', 'action', 'href?']</code>. <code>line</code> honours inline <code>&lt;em&gt;</code>.</td></tr>
            <tr><td><code>facilitators</code></td><td>array|null</td><td><code>['title', 'meta', 'avatars', 'presence']</code>. <code>avatars</code> is <code>[['initials', 'bg']]</code> where <code>bg</code> takes any CSS background including gradients; <code>presence</code> is <code>['name', 'status']</code>.</td></tr>
            <tr><td><code>id</code></td><td>string</td><td>Element ID</td></tr>
            <tr><td><code>class</code></td><td>string</td><td>Additional CSS classes</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td>Extra HTML attributes &mdash; where the <code>--wpir-phase</code> override goes</td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">info</span>
        <span>The avatar stack uses an initials pattern rather than <a href="<?= $ds_base ?>/components/demos/avatar.php">Avatar</a>. That's intentional for density at this size &mdash; don't substitute <code>&lt;img&gt;</code> avatars here.</span>
    </div>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Decorative icons</td><td>Suggestion icons and dividers carry <code>aria-hidden="true"</code>, so they aren't read as stray text.</td></tr>
            <tr><td>Section headings</td><td>Rendered as text rather than heading elements, so the rail doesn't pollute the page outline. The trade-off is that screen-reader users can't jump between sections by heading &mdash; acceptable in a fixed three-section rail.</td></tr>
            <tr><td>Suggestion actions</td><td>Action labels are short verbs ("apply", "preview", "add 3m"). Out of context those are ambiguous &mdash; give each an <code>aria-label</code> naming what it applies to.</td></tr>
            <tr><td>Emphasis</td><td>Inline <code>&lt;em&gt;</code> is semantic emphasis, announced as such. Good &mdash; the phase colour reinforces rather than replaces it.</td></tr>
            <tr><td>Presence</td><td>Changes to who's editing aren't announced; the text is rendered once. If presence matters live, add a polite live region.</td></tr>
            <tr><td>Avatar initials</td><td>Initials alone are near-meaningless to a screen reader. The presence line names the active editor, which covers the common case &mdash; but the other avatars are unnamed. Add a <code>title</code> or visually-hidden name per avatar if the roster matters.</td></tr>
            <tr><td>Energy chart</td><td>Owned by <a href="<?= $ds_base ?>/components/demos/energy-arc-card.php">Energy Arc Card</a> &mdash; see that page for its text-alternative behaviour.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <p class="ds-section-desc">The rail resolves the shared scales into a local <code class="ds-code-inline">--wpir-*</code> set, so its internal rules reference one variable per role and the whole rail can be rethemed from the container.</p>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--wpir-phase</code></td><td>Accent for the score, chart line, suggestion icons, and inline <code>&lt;em&gt;</code>. The override point.</td></tr>
            <tr><td><code>--wpir-surface</code> / <code>--wpir-paper-edge</code></td><td>Rail surface and its section dividers</td></tr>
            <tr><td><code>--wpir-ink</code> / <code>-soft</code> / <code>-quiet</code> / <code>-whisper</code></td><td>The four text weights, from title down to meta</td></tr>
            <tr><td><code>--wpir-display</code> / <code>--wpir-mono</code></td><td>Resolved display and mono faces</td></tr>
            <tr><td><code>--color-surface</code> / <code>--gray-200</code></td><td>Source surfaces and borders</td></tr>
            <tr><td><code>--color-ink</code> / <code>-secondary</code> / <code>-muted</code> / <code>-faint</code></td><td>Source ink scale</td></tr>
            <tr><td><code>--font-display</code> / <code>--font-sans</code> / <code>--font-mono</code></td><td>Source faces &mdash; Fraunces titles, Inter body, mono eyebrows</td></tr>
            <tr><td><code>--planner-exercise-color</code></td><td>Activity accent where a suggestion references one</td></tr>
            <tr><td><code>--text-nano</code> / <code>--text-caption</code> / <code>--text-meta</code></td><td>Type scale across the rail</td></tr>
            <tr><td><code>--text-inverse</code></td><td>Initials on the avatar gradients</td></tr>
            <tr><td><code>--icon-lg</code></td><td>Icons, at least 24px on every page (DESIGN.md §8)</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-planner-inspector-rail</code></td><td>Rail container &mdash; where <code>--wpir-*</code> is defined and can be overridden</td></tr>
            <tr><td><code>.ws-planner-inspector-rail__section</code></td><td>A section block</td></tr>
            <tr><td><code>.ws-planner-inspector-rail__section--last</code></td><td>Final section; drops the trailing divider</td></tr>
            <tr><td><code>.ws-planner-inspector-rail__title</code></td><td>Section title and its meta</td></tr>
            <tr><td><code>.ws-planner-inspector-rail__energy</code></td><td>Energy slot wrapping the arc card</td></tr>
            <tr><td><code>.ws-planner-inspector-rail__suggestions</code></td><td>Coach suggestion list</td></tr>
            <tr><td><code>.ws-planner-inspector-rail__sugg</code></td><td>One suggestion</td></tr>
            <tr><td><code>.ws-planner-inspector-rail__sugg-icon</code> / <code>-pre</code> / <code>-line</code> / <code>-meta</code></td><td>Suggestion internals</td></tr>
            <tr><td><code>.ws-planner-inspector-rail__avatars</code></td><td>Facilitator initials stack</td></tr>
            <tr><td><code>.ws-planner-inspector-rail__presence</code> / <code>-meta</code></td><td>Active-editor line</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_planner_inspector_rail()</code> helper function</td></tr>
            <tr><td><code>includes/components/planner-inspector-rail.php</code></td><td>Template &mdash; the three sections and the energy-card forwarding</td></tr>
            <tr><td><code>includes/components/energy-arc-card.php</code></td><td>Renders the energy slot</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles and the <code>--wpir-*</code> definitions</td></tr>
            <tr><td><code>css/planner/components/_sidebar.css</code></td><td>Planner-side rail styling</td></tr>
        </tbody>
    </table>
</section>

<style>
.ds-ir-stage { display: flex; flex-wrap: wrap; gap: 24px; }
.ds-ir-shell {
    width: 340px;
    height: 720px;
    border: 1px solid var(--color-border, #E5E7EB);
    border-radius: var(--radius-xl, 12px);
    overflow: hidden;
    background: var(--bg-page-warm, #F7F2EA);
}
</style>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
