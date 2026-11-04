<?php
$ds_page  = 'components/demos/text';
$ds_title = 'Text';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Text</h1>
    <p>Two text steps that no other component draws: an item's title, and a small secondary line.</p>
</div>

<!-- When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            A card or list item needs its title, or a page needs a small secondary line such as a result count or a note under a heading. <code>title</code> is the card-title step; <code>caption</code> is the small line, in a colour that passes contrast on the page and on a card.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The heading belongs to a page or a section: use <code>ws_section_header</code>. Running body copy is a plain paragraph, and a field's label is the field's own label option.
        </div>
    </div>
</section>

<!-- Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Title, in a card</h3>
        <p class="ds-section-desc">Fraunces at <code>--text-h4</code>, semibold: the step the saved-workshop cards use. An <code>h3</code> unless <code>tag</code> says otherwise.</p>
        <div class="ds-card">
            <?php ws_grid_start() ?>
                <?php ws_card_start(['variant' => 'content']) ?>
                    <?php ws_stack_start(['gap' => '2']) ?>
                        <?= ws_text('Quarterly planning offsite', ['variant' => 'title']) ?>
                        <?= ws_text('Two days, 14 people. Last edited on Monday.', ['variant' => 'caption']) ?>
                    <?php ws_stack_end() ?>
                <?php ws_card_end() ?>
                <?php ws_card_start(['variant' => 'content']) ?>
                    <?php ws_stack_start(['gap' => '2']) ?>
                        <?= ws_text('Team retrospective', ['variant' => 'title']) ?>
                        <?= ws_text('90 minutes, remote.', ['variant' => 'caption']) ?>
                    <?php ws_stack_end() ?>
                <?php ws_card_end() ?>
            <?php ws_grid_end() ?>
        </div>
        <div class="ds-code"><pre><?= htmlspecialchars(<<<'PHP'
<?php ws_card_start(['variant' => 'content']) ?>
    <?php ws_stack_start(['gap' => '2']) ?>
        <?= ws_text($workshop['title'], ['variant' => 'title']) ?>
        <?= ws_text('Two days, 14 people. Last edited on Monday.', ['variant' => 'caption']) ?>
    <?php ws_stack_end() ?>
<?php ws_card_end() ?>
PHP) ?></pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Caption, as a result count</h3>
        <p class="ds-section-desc"><code>--text-small</code> in <code>--text-default</code>. <code>live</code> makes it a status, read out when a script changes it.</p>
        <div class="ds-card">
            <?= ws_text('Showing 6 of 8 workshops', ['variant' => 'caption', 'live' => true]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_text('Showing 6 of 8 workshops', ['variant' =&gt; 'caption', 'live' =&gt; true]) ?&gt;</pre></div>
    </div>
</section>

<!-- Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>$text</code></td><td>string</td><td>&mdash;</td><td>Positional. Escaped, so pass plain text</td></tr>
            <tr><td><code>variant</code></td><td>string</td><td><code>'caption'</code></td><td><code>title</code> or <code>caption</code>; anything else is a caption</td></tr>
            <tr><td><code>tag</code></td><td>string</td><td><code>h3</code> / <code>p</code></td><td><code>h2</code> to <code>h5</code>, <code>p</code>, <code>span</code> or <code>div</code>; anything else falls back to the default</td></tr>
            <tr><td><code>live</code></td><td>bool</td><td><code>false</code></td><td><code>role="status"</code></td></tr>
            <tr><td><code>id</code>, <code>class</code>, <code>attrs</code></td><td>&mdash;</td><td>&mdash;</td><td>On the element</td></tr>
        </tbody>
    </table>
</section>

<!-- Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Headings</td><td>A title is a real heading element, <code>h3</code> by default. Set <code>tag</code> so the page's outline stays in order.</td></tr>
            <tr><td>Live counts</td><td><code>live</code> sets <code>role="status"</code>, so a count a script changes is read out. Text already on the page when it loads is not announced, so a search that reloads the page gains nothing from it.</td></tr>
            <tr><td>Contrast</td><td>The caption uses <code>--text-default</code> (7.66:1 on white), not <code>--text-muted</code>, which falls below AA for small text on <code>--card-bg</code>.</td></tr>
        </tbody>
    </table>
</section>

<!-- Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_text()</code></td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles, the <code>TEXT (ws_text)</code> block</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
