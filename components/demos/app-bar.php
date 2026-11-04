<?php
$ds_page  = 'components/demos/app-bar';
$ds_title = 'App Bar';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';

$demoBar = static function (string $state, array $extra = []): string {
    return ws_app_bar(array_merge([
        'state'     => $state,
        'title'     => ['text' => 'User Research Workshop'],
        'saveState' => ['text' => 'Saved', 'state' => 'saved', 'hidden' => false],
        'context'   => ['duration' => '120 min', 'date' => '2026-08-15', 'time' => '09:00'],
    ], $extra));
};
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>App Bar</h1>
    <p>The document bar under the platform header in every tool shell: what you are working on, the controls that app needs, whether it is saved, and what you can do to it.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            A page holds one document the reader is working on: an agenda, a live session, a synthesis. The bar names that document and carries the actions that act on it.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The page is a list, a landing page, or anything without a single subject. <code>ws_header()</code> alone is the whole chrome there. Laying out the view under it is the page grid, <code>.app-page</code>: a six-column main beside the two-column rail (<a href="<?= $ds_base ?>/apps/app-shell-layouts.php">App Shell Layouts</a>).
        </div>
    </div>
</section>

<!-- 3. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <p class="ds-section-desc">One anatomy, four apps. The title, save state, and action cluster are constant; the centre is what changes. Pass <code>'state'</code> to get an app's centre and default actions without spelling them out.</p>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Strategize</h3>
        <p class="ds-section-desc">Nothing in the centre. The work is the page, not the bar.</p>
        <div class="ds-card"><?= $demoBar('strategize') ?></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Plan</h3>
        <p class="ds-section-desc">Reads out the shape of the workshop being built: duration, date, start time. Values come from <code>'context'</code>.</p>
        <div class="ds-card"><?= $demoBar('plan') ?></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Facilitate</h3>
        <p class="ds-section-desc">The two things you reach for in the room: start the session, show the join code.</p>
        <div class="ds-card"><?= $demoBar('facilitate') ?></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Synthesize</h3>
        <p class="ds-section-desc">Switches between the two readings of a finished session. The trailing action is Share rather than Continue, because synthesis ends in something you send.</p>
        <div class="ds-card"><?= $demoBar('synthesize', ['view' => 'recap']) ?></div>
    </div>
</section>

<!-- 4. Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Usage</h2>
    <pre class="ds-code"><code>&lt;?= ws_app_bar([
    'state'     =&gt; 'plan',
    'title'     =&gt; ['mode' =&gt; 'editable', 'text' =&gt; 'Untitled workshop'],
    'context'   =&gt; ['duration' =&gt; '120 min', 'date' =&gt; '2026-08-15', 'time' =&gt; '09:00'],
    'saveState' =&gt; ['text' =&gt; 'Saved', 'state' =&gt; 'saved', 'hidden' =&gt; false],
]) ?&gt;</code></pre>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>A named state fills only what you leave empty.</strong>
            Pass your own <code>'center'</code> or <code>'actions'</code> and they are kept exactly as passed. The state never overwrites a caller.
        </div>
        <div class="ds-dont">
            <strong>An inferred state adds a class, not content.</strong>
            With no <code>'state'</code>, the bar reads the shell's <code>?view=</code> and adds <code>.ws-app-bar--{state}</code> for styling. It does not inject a centre: the apps already pass their own, and a bar should never grow controls its page has no code behind.
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
