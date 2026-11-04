<?php
$ds_page  = 'components/demos/synth-action-bar';
$ds_title = 'Synth Action Bar';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Synth Action Bar</h1>
    <p>The stone rail that closes an empty Synthesize surface: a pinned note saying what the room should have brought back, and the one action that starts the work.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            A Synthesize surface has nothing on it yet. The bar answers the two questions an empty page raises at once: what counts as material, and where do I start.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The page already has material. Once there is something to work with, the note is telling the reader something they have already done, and the rail should give way to the work.
        </div>
    </div>
</section>

<!-- 3. The bar -->
<section class="ds-section">
    <h2 class="ds-section-title">The bar</h2>
    <p class="ds-section-desc">The note rotates through its set every 12 seconds. Hovering it holds the current note, and under <code>prefers-reduced-motion</code> the first note simply stays put.</p>
    <div class="ds-card" style="padding: 0; overflow: hidden;">
        <?= ws_synth_action_bar([
            'action' => ['label' => 'Start from raw material', 'href' => '#'],
        ]) ?>
    </div>
</section>

<!-- 4. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Your own notes</h3>
        <p class="ds-section-desc">Pass a set and it replaces the built-in nudges. Each note is a situation and what to do about it, in that order.</p>
        <div class="ds-card" style="padding: 0; overflow: hidden;">
            <?= ws_synth_action_bar([
                'notes'  => [
                    ['title' => 'Recording still uploading?', 'body' => 'Start anyway. It joins the synthesis when it lands.'],
                    ['title' => 'Two sessions, one theme set?', 'body' => 'Add both. Synthesis reads them as one room.'],
                ],
                'rotate' => 4000,
                'action' => ['label' => 'Add material', 'href' => '#'],
            ]) ?>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">A single note</h3>
        <p class="ds-section-desc">One note holds still. Nothing rotates, and no script is emitted for it.</p>
        <div class="ds-card" style="padding: 0; overflow: hidden;">
            <?= ws_synth_action_bar([
                'notes'  => [['title' => 'Bring the room back.', 'body' => 'Notes, transcript, photos, or a board export.']],
                'action' => ['label' => 'Start from raw material', 'href' => '#'],
            ]) ?>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Action only</h3>
        <p class="ds-section-desc">For a surface that has already said what it needs, above the rail.</p>
        <div class="ds-card" style="padding: 0; overflow: hidden;">
            <?= ws_synth_action_bar([
                'noteHidden' => true,
                'action'     => ['label' => 'Build the synthesis', 'href' => '#'],
            ]) ?>
        </div>
    </div>
</section>

<!-- 5. Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Usage</h2>
    <pre class="ds-code"><code>&lt;?= ws_synth_action_bar([
    'action' =&gt; ['label' =&gt; 'Start from raw material', 'href' =&gt; '/app/?view=synthesize&amp;step=make'],
    'rotate' =&gt; 12000,
]) ?&gt;</code></pre>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Write a note as situation, then remedy.</strong>
            "Nothing here to synthesize?" then what to bring. A note that only says "add something" tells the reader what they already know.
        </div>
        <div class="ds-dont">
            <strong>Don't rotate faster than a reader reads.</strong>
            Twelve seconds is the floor for two lines. The note is an aside, and an aside that flickers becomes the loudest thing on the page.
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
