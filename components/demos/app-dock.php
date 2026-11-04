<?php
$ds_page  = 'components/demos/app-dock';
$ds_title = 'App Dock';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';

/* The dock positions itself against the nearest positioned ancestor, so each
   demo stands it inside a relative, fixed-height stage the way a tool shell
   would. Nothing here is fixed to the window. */
$stage = static function (string $dock, string $size = ''): string {
    return '<div class="ds-card ds-dock-stage' . ($size ? ' ds-dock-stage--' . $size : '') . '">' . $dock . '</div>';
};

$materialItems = [
    ['icon' => 'videocam',     'label' => 'Add a video',      'attrs' => ['data-act' => 'dockAdd', 'data-kind' => 'video']],
    ['icon' => 'mic',          'label' => 'Add audio',        'attrs' => ['data-act' => 'dockAdd', 'data-kind' => 'audio']],
    ['icon' => 'list_alt',     'label' => 'Add a transcript', 'attrs' => ['data-act' => 'dockAdd', 'data-kind' => 'transcript']],
    ['icon' => 'dashboard',    'label' => 'Connect a board',  'attrs' => ['data-act' => 'dockAdd', 'data-kind' => 'board']],
    ['icon' => 'photo_camera', 'label' => 'Add photos',       'attrs' => ['data-act' => 'dockAdd', 'data-kind' => 'photo']],
    ['icon' => 'content_copy', 'label' => 'Add a document',   'attrs' => ['data-act' => 'dockAdd', 'data-kind' => 'document']],
];
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">
<style>
    /* A stand-in for the tool shell: the positioned box the dock hangs from. */
    .ds-dock-stage { position: relative; height: 200px; padding: 0; overflow: hidden; background: var(--bg-page); }
    .ds-dock-stage--short { height: 160px; }
    .ds-dock-stage--tall { height: 240px; }
</style>

<div class="ds-page-header">
    <h1>App Dock</h1>
    <p>The floating toolbar at the foot of a tool shell: what you have on the left, the ways to add to it in the middle, what happens next on the right.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            A screen has a small set of ways to act on what is in front of the reader, and one of them is the way forward. The dock keeps all of them in reach without closing the page the way the rail does, so the work can scroll underneath.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The screen's action is a single button, or the actions need labels to be understood. A dock of one glyph is a floating button; a dock of six unfamiliar glyphs is a puzzle. Use the rail, or <code>ws_button()</code> in the page. Laying out the view itself is the page grid, <code>.app-page</code>: a six-column main beside the two-column rail (<a href="<?= $ds_base ?>/apps/app-shell-layouts.php">App Shell Layouts</a>).
        </div>
    </div>
</section>

<!-- 3. The dock -->
<section class="ds-section">
    <h2 class="ds-section-title">The dock</h2>
    <p class="ds-section-desc">As Synthesize wears it on the material screen. The lead pill is a read-out (<code>'static' => true</code>), the six slots open the intake's own pickers, and the trail pill is the screen's primary. Each slot's label is its accessible name and its tooltip, which opens upward because the dock sits at the foot of the window.</p>
    <?= $stage(ws_app_dock([
        'ariaLabel' => 'Add material',
        'lead'      => ['label' => '3 Sources', 'static' => true],
        'items'     => $materialItems,
        'trail'     => ['label' => 'Synthesize', 'icon' => 'auto_awesome', 'iconPosition' => 'right'],
    ])) ?>
</section>

<!-- 4. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Slots only</h3>
        <p class="ds-section-desc">Four steps of a phase, nothing to count and no separate way forward. This is the shape Strategize draws.</p>
        <?= $stage(ws_app_dock([
            'ariaLabel' => 'Strategize steps',
            'items'     => [
                ['icon' => 'assignment',   'label' => 'Say it in one sentence'],
                ['icon' => 'mode_comment', 'label' => 'Practice the conversation'],
                ['icon' => 'construction', 'label' => 'Build your pitch', 'active' => true],
                ['icon' => 'check_circle', 'label' => 'Sanity-check the scope'],
            ],
        ]), 'short') ?>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Not ready yet</h3>
        <p class="ds-section-desc">The trail pill disables under the same condition the screen's primary would, and says why in its tooltip. The dock never hides the way forward; it shows it closed.</p>
        <?= $stage(ws_app_dock([
            'ariaLabel' => 'Add material',
            'lead'      => ['label' => 'No sources', 'static' => true],
            'items'     => $materialItems,
            'trail'     => ['label' => 'Synthesize', 'icon' => 'auto_awesome', 'iconPosition' => 'right',
                            'disabled' => true, 'attrs' => ['title' => 'Add a source first']],
        ])) ?>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Narrow</h3>
        <p class="ds-section-desc">Under a 720px viewport the slots take a row of their own and the two labelled pills share the row beneath, so nothing is squeezed out of reach of a thumb. The rule reads the viewport, not the stage, so it does not show in a narrow box on this page: resize the window to see it.</p>
    </div>
</section>

<!-- 5. Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Usage</h2>
    <pre class="ds-code"><code>&lt;?= ws_app_dock([
    'id'    =&gt; 'synthDock',
    'lead'  =&gt; ['label' =&gt; '3 Sources', 'id' =&gt; 'synthDockCount', 'static' =&gt; true],
    'items' =&gt; [
        ['icon' =&gt; 'videocam', 'label' =&gt; 'Add a video', 'attrs' =&gt; ['data-act' =&gt; 'dockAdd', 'data-kind' =&gt; 'video']],
        ['icon' =&gt; 'mic',      'label' =&gt; 'Add audio',   'attrs' =&gt; ['data-act' =&gt; 'dockAdd', 'data-kind' =&gt; 'audio']],
    ],
    'trail' =&gt; ['label' =&gt; 'Synthesize', 'icon' =&gt; 'auto_awesome', 'iconPosition' =&gt; 'right', 'id' =&gt; 'synthDockGo'],
]) ?&gt;</code></pre>
    <p class="ds-section-desc">The shell that wears it sets <code>position: relative</code> on itself and pads its scroll region by <code>--app-dock-clearance</code> while the dock is showing. Synthesize does that with a <code>has-app-dock</code> class its screen sync toggles.</p>
</section>

<!-- 6. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <ul class="ds-list">
        <li>The dock is a <code>&lt;nav&gt;</code> landmark with the label you pass as <code>ariaLabel</code>. Keep it truthful to what the slots do.</li>
        <li>Every slot's <code>label</code> is its <code>aria-label</code>, so a glyph on its own is never the whole name. The same text is the tooltip on hover and focus.</li>
        <li>A slot passed <code>'active' => true</code> announces as pressed (<code>aria-pressed</code>), for docks that mark where the reader is.</li>
        <li>A static lead pill is a <code>&lt;span&gt;</code>. Give it <code>role="status"</code> through <code>attrs</code> when the count it shows changes while the reader works, as Synthesize does.</li>
        <li>Focus rings are the platform's white-on-red ring, the same as the app bar's actions. Under <code>prefers-reduced-motion</code> the state layer and press scale hold still.</li>
    </ul>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
