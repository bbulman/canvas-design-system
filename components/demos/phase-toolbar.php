<?php
$ds_page  = 'components/demos/phase-toolbar';
$ds_title = 'Phase Toolbar';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';

/* The canon itself, so this page cannot drift from what ships: every table and
   every example below is rendered from the same file the apps render from. */
$canon = require __DIR__ . '/../../../includes/components/phase-toolbars.php';

/* The toolbar positions itself against the nearest positioned ancestor, so each
   demo stands it inside a relative, fixed-height stage the way a tool shell
   would. Nothing here is fixed to the window. */
$stage = static function (string $toolbar, string $size = ''): string {
    return '<div class="ds-card ds-dock-stage' . ($size ? ' ds-dock-stage--' . $size : '') . '">' . $toolbar . '</div>';
};
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">
<style>
    /* A stand-in for the tool shell: the positioned box the toolbar hangs from. */
    .ds-dock-stage { position: relative; height: 200px; padding: 0; overflow: hidden; background: var(--bg-page); }
    .ds-dock-stage--short { height: 160px; }
</style>

<div class="ds-page-header">
    <h1>Phase Toolbar</h1>
    <p>The dock a phase always wears. <code>ws_app_dock()</code> is the shape; this is the contents: which slots each phase shows, in which order, with which glyph and name.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            You are drawing the dock for Strategize, Plan, Facilitate or Synthesize. The component supplies the phase's agreed slots, order, glyphs and names; the call site supplies only its own wiring, per slot key. There is no case where one of those phases should hand-assemble a dock instead.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The toolbar belongs to one screen rather than to a phase &mdash; call <code>ws_app_dock()</code> directly. Prove has no toolbar at all: its save, share and export act on the document, so they live in the app bar's shared cluster.
        </div>
    </div>
</section>

<!-- 3. Ownership -->
<section class="ds-section">
    <h2 class="ds-section-title">What the component owns</h2>
    <p class="ds-section-desc">The shape is a design decision, reviewable in one file. The wiring is app code the design system has no business knowing. The slot key is the contract between them, so renaming one is a breaking change to every call site of that phase.</p>
    <table class="ds-table">
        <thead><tr><th>Design system</th><th>The app</th></tr></thead>
        <tbody>
            <tr><td>Which slots the phase shows, and in what order</td><td>The <code>id</code> a handler binds to</td></tr>
            <tr><td>Each slot's icon and name</td><td>The <code>href</code> a step navigates to</td></tr>
            <tr><td>The landmark label</td><td>The <code>data-action</code> its JS dispatches</td></tr>
            <tr><td>Whether the phase has lead and trail pills</td><td>The text those pills read out, and the badge counts</td></tr>
        </tbody>
    </table>
</section>

<!-- 4. The four toolbars -->
<section class="ds-section">
    <h2 class="ds-section-title">The four toolbars</h2>
    <p class="ds-section-desc">Rendered from <code>includes/components/phase-toolbars.php</code>, the same file the apps render from. The pills below carry sample read-outs because their text is the app's to supply; everything else is exactly what ships.</p>

    <?php
    /* Sample labels for the pills the canon deliberately leaves wordless, and
       the active step Strategize marks. Wiring only: no ids, no data-actions. */
    $sample = [
        'strategize' => ['slots' => ['pitch' => ['active' => true]]],
        'facilitate' => ['slots' => [
            'polls'     => ['badge' => ['id' => 'ds-polls-badge',     'text' => '2', 'hidden' => false]],
            'reactions' => ['badge' => ['id' => 'ds-reactions-badge', 'text' => '7', 'hidden' => false]],
        ]],
        'synthesize' => ['lead' => ['label' => '3 Sources']],
    ];
    foreach ($canon as $phase => $spec): ?>
    <div class="ds-subsection">
        <h3 class="ds-subsection-title"><?= htmlspecialchars(ucfirst($phase)) ?></h3>
        <p class="ds-section-desc">
            Landmark &ldquo;<?= htmlspecialchars($spec['ariaLabel']) ?>&rdquo;.
            Slots: <code><?= htmlspecialchars(implode(', ', array_keys($spec['slots']))) ?></code>.
        </p>
        <?= $stage(ws_phase_toolbar($phase, $sample[$phase] ?? []), count($spec['slots']) < 6 ? 'short' : '') ?>
    </div>
    <?php endforeach; ?>
</section>

<!-- 5. Sanctioned deviations -->
<section class="ds-section">
    <h2 class="ds-section-title">Sanctioned deviations</h2>
    <p class="ds-section-desc">Three, and only three. Anything beyond them is a design change, and the place to make it is the canon.</p>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">A screen drops a slot</h3>
        <p class="ds-section-desc">One visible line at the call site, so the absence is legible: <code>'slots' =&gt; ['deck' =&gt; false, 'calendar' =&gt; false]</code>. Here Plan gives up its slide deck and its calendar.</p>
        <?= $stage(ws_phase_toolbar('plan', [
            'slots' => ['deck' => false, 'calendar' => false],
        ])) ?>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">A screen appends one only it has</h3>
        <p class="ds-section-desc">Appended after the canon's, never interleaved, so the canonical order stays recognisable.</p>
        <?= $stage(ws_phase_toolbar('synthesize', [
            'lead'  => ['label' => '3 Sources'],
            'extra' => [['icon' => 'link', 'label' => 'Paste a link']],
        ])) ?>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">The way forward is closed</h3>
        <p class="ds-section-desc">The trail pill disables on the same condition the screen's primary does, so the toolbar and the rail can never disagree about whether there is a next step. The toolbar never hides the way forward; it shows it closed.</p>
        <?= $stage(ws_phase_toolbar('synthesize', [
            'lead'  => ['label' => 'No sources'],
            'trail' => ['disabled' => true, 'attrs' => ['title' => 'Add a source first']],
        ])) ?>
    </div>
</section>

<!-- 6. Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Usage</h2>
    <pre class="ds-code"><code>&lt;?= ws_phase_toolbar('plan', [
    'id'     =&gt; 'plannerDock',
    'hidden' =&gt; true,
    'slots'  =&gt; [
        'history' =&gt; ['id' =&gt; 'versionHistoryBtn'],
        'cleanup' =&gt; ['id' =&gt; 'cleanupBtn'],
    ],
]) ?&gt;</code></pre>
    <p class="ds-section-desc">A slot the caller does not mention still renders: the phase's toolbar is the same toolbar wherever that phase appears. The caller's map is read by key, not by position, so writing it in a different order changes nothing. The shell that wears the toolbar sets <code>position: relative</code> on itself and pads its scroll region by <code>--app-dock-clearance</code> while it is showing. Full specification: <code>design-system/docs/spec-phase-toolbar.md</code>.</p>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <ul class="ds-list">
        <li>The landmark label defaults to the phase's own name, so no screen can ship the generic fallback by forgetting to replace it.</li>
        <li>The canon guarantees every slot has a name, which is the accessibility argument for having a canon: a hand-assembled dock can ship a nameless slot, and this one cannot.</li>
        <li>Every slot's name is its <code>aria-label</code> and its tooltip, which opens upward because the toolbar sits at the foot of the region.</li>
        <li>A slot passed <code>'active' =&gt; true</code> announces as pressed. Strategize marks the step you are on that way.</li>
        <li>A static pill is a <code>&lt;span&gt;</code>. Give it <code>role="status"</code> through <code>attrs</code> when its text changes while the reader works, as Synthesize's count does.</li>
        <li>A pill the canon leaves wordless and the caller does not label is dropped rather than drawn blank: an empty lozenge reports nothing.</li>
    </ul>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
