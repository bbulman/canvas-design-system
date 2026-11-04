<?php
$ds_page  = 'components/demos/layout';
$ds_title = 'Layout';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';

$code = fn(string $php): string => '<div class="ds-code"><pre>' . htmlspecialchars(trim($php)) . '</pre></div>';
$sampleCard = fn(string $title, string $meta): string => ws_card(ws_text($title, ['variant' => 'title']) . '<p>' . htmlspecialchars($meta) . '</p>');
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">
<style>
    /* Demo only: outlines that make the layout helpers' edges visible. */
    .layout-demo-outline { outline: 1px dashed var(--brand-line); outline-offset: var(--space-1); }
    .layout-demo-chip { padding: var(--space-2) var(--space-3); border-radius: var(--radius-md); background: var(--brand-tint); color: var(--text-dark); font-size: var(--text-small); }
</style>

<div class="ds-page-header">
    <h1>Layout</h1>
    <p>Four helpers own the space between components: a stack, a cluster, a grid and a container. Reach for them before writing a flex or grid rule of your own.</p>
</div>

<!-- When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            Components sit beside or above one another and the space between them should be a token step: the fields and actions of a form, a row of buttons, a grid of workshop cards, a settings column that should not run the full width of the screen.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The space is inside one component, which already spaces its own parts. Inside an <code>/app/</code> view, the page grid (<code>.app-page</code>) already sets the width, so skip the container there.
        </div>
    </div>
    <table class="ds-table">
        <thead><tr><th>Helper</th><th>Lays out</th><th>Reach for it when</th></tr></thead>
        <tbody>
            <tr><td><code>ws_stack_start</code></td><td>Children one above the other</td><td>Form fields, the sections of a panel, one column of cards</td></tr>
            <tr><td><code>ws_cluster_start</code></td><td>Children side by side, wrapping</td><td>An action row, a field beside its button, chips</td></tr>
            <tr><td><code>ws_grid_start</code></td><td>Equal columns, as many as fit</td><td>Repeated cards, tiles or stats</td></tr>
            <tr><td><code>ws_container_start</code></td><td>A centred column with gutters</td><td>A page or fragment that needs a maximum width of its own</td></tr>
        </tbody>
    </table>
</section>

<!-- Stack -->
<section class="ds-section">
    <h2 class="ds-section-title">Stack</h2>
    <p class="ds-section-desc">One spacing step between each pair of children. The stack owns that space, so its direct children lose their own top and bottom margins. Children fill the column's width, except a button or a bare link, which keeps its own. Anything not displayed, such as a hidden input at the top of a form, adds no space.</p>
    <div class="ds-card">
        <?php ws_stack_start(['gap' => '5', 'tag' => 'form', 'attrs' => ['method' => 'get', 'action' => '#']]) ?>
            <input type="hidden" name="csrf" value="demo">
            <?= ws_input('layout-demo-title', ['label' => 'Workshop title', 'placeholder' => 'Quarterly planning offsite']) ?>
            <?= ws_input('layout-demo-goal', ['label' => 'What should the group leave with?', 'hint' => 'One sentence. The planner uses it to pick exercises.']) ?>
            <?php ws_cluster_start() ?>
                <?= ws_button('Save workshop', ['type' => 'submit']) ?>
                <?= ws_button('Cancel', ['variant' => 'ghost', 'href' => '#']) ?>
            <?php ws_cluster_end() ?>
        <?php ws_stack_end() ?>
    </div>
    <?= $code(<<<'PHP'
<?php ws_stack_start(['gap' => '5', 'tag' => 'form', 'attrs' => ['method' => 'post']]) ?>
    <?= ws_input('title', ['label' => 'Workshop title']) ?>
    <?= ws_input('goal', ['label' => 'What should the group leave with?', 'hint' => 'One sentence.']) ?>
    <?php ws_cluster_start() ?>
        <?= ws_button('Save workshop', ['type' => 'submit']) ?>
        <?= ws_button('Cancel', ['variant' => 'ghost', 'href' => '/app/']) ?>
    <?php ws_cluster_end() ?>
<?php ws_stack_end() ?>
PHP) ?>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Values</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>gap</code></td><td><code>1</code> <code>2</code> <code>3</code> <code>4</code> <code>5</code> <code>6</code> <code>8</code> <code>10</code> <code>12</code></td><td><code>4</code></td><td>The <code>--space-N</code> step between children</td></tr>
            <tr><td><code>tag</code></td><td><code>div</code> <code>section</code> <code>ul</code> <code>ol</code> <code>form</code></td><td><code>div</code></td><td>The element. A list gets <code>role="list"</code>; a form takes <code>method</code> and <code>action</code> through <code>attrs</code></td></tr>
            <tr><td><code>id</code>, <code>class</code>, <code>attrs</code></td><td>&mdash;</td><td>&mdash;</td><td>Passed to the element</td></tr>
        </tbody>
    </table>
</section>

<!-- Cluster -->
<section class="ds-section">
    <h2 class="ds-section-title">Cluster</h2>
    <p class="ds-section-desc">Children side by side, wrapping onto the next line when they run out of room. Items keep their own widths.</p>
    <div class="ds-card">
        <?php ws_stack_start(['gap' => '6']) ?>
            <?php ws_cluster_start(['tag' => 'ul', 'gap' => '2']) ?>
                <li class="layout-demo-chip">Energisers</li>
                <li class="layout-demo-chip">Decision making</li>
                <li class="layout-demo-chip">Retrospectives</li>
                <li class="layout-demo-chip">Remote friendly</li>
            <?php ws_cluster_end() ?>
            <?php ws_cluster_start(['justify' => 'between']) ?>
                <?= ws_button('Back', ['variant' => 'ghost', 'icon' => 'arrow_back']) ?>
                <?= ws_button('Continue', ['icon' => 'arrow_forward', 'iconPosition' => 'right']) ?>
            <?php ws_cluster_end() ?>
            <?php ws_cluster_start(['align' => 'end', 'grow' => 'first']) ?>
                <?= ws_input('layout-demo-search', ['type' => 'search', 'label' => 'Search workshops by name']) ?>
                <?= ws_button('Search', ['type' => 'button', 'variant' => 'secondary']) ?>
            <?php ws_cluster_end() ?>
        <?php ws_stack_end() ?>
    </div>
    <?= $code(<<<'PHP'
<?php ws_cluster_start(['justify' => 'between']) ?>
    <?= ws_button('Back', ['variant' => 'ghost', 'icon' => 'arrow_back']) ?>
    <?= ws_button('Continue', ['icon' => 'arrow_forward', 'iconPosition' => 'right']) ?>
<?php ws_cluster_end() ?>

<?php ws_cluster_start(['align' => 'end', 'grow' => 'first']) ?>
    <?= ws_input('q', ['type' => 'search', 'label' => 'Search workshops by name']) ?>
    <?= ws_button('Search', ['type' => 'submit', 'variant' => 'secondary']) ?>
<?php ws_cluster_end() ?>
PHP) ?>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Values</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>gap</code></td><td><code>1</code> <code>2</code> <code>3</code> <code>4</code> <code>5</code> <code>6</code> <code>8</code></td><td><code>3</code></td><td>The <code>--space-N</code> step between items, across and down</td></tr>
            <tr><td><code>justify</code></td><td><code>start</code> <code>center</code> <code>end</code> <code>between</code></td><td><code>start</code></td><td>Where the row sits; <code>between</code> pushes the first and last items to the edges</td></tr>
            <tr><td><code>align</code></td><td><code>start</code> <code>center</code> <code>end</code> <code>baseline</code> <code>stretch</code></td><td><code>center</code></td><td>Cross-axis alignment. <code>end</code> lines a button up with a labelled field's input</td></tr>
            <tr><td><code>grow</code></td><td><code>none</code> <code>first</code> <code>last</code></td><td><code>none</code></td><td>The item that takes the row's free width, keeping <code>--grid-min-sm</code> before the row wraps: a search field beside its button</td></tr>
            <tr><td><code>tag</code></td><td><code>div</code> <code>ul</code> <code>ol</code></td><td><code>div</code></td><td>A list gets <code>role="list"</code></td></tr>
            <tr><td><code>id</code>, <code>class</code>, <code>attrs</code></td><td>&mdash;</td><td>&mdash;</td><td>Passed to the element</td></tr>
        </tbody>
    </table>
</section>

<!-- Grid -->
<section class="ds-section">
    <h2 class="ds-section-title">Grid</h2>
    <p class="ds-section-desc">As many equal columns as fit, never narrower than a column floor. There are no breakpoints: the grid drops a column as the screen narrows and reaches one column on a phone. A short last row keeps the width of a full one, so cards always match their neighbours.</p>
    <div class="ds-card">
        <?php ws_grid_start(['tag' => 'ul']) ?>
            <li><?= $sampleCard('Quarterly planning offsite', 'Two days, 14 people') ?></li>
            <li><?= $sampleCard('Team retrospective', '90 minutes, remote, with a silent-writing round before the discussion so the quieter half of the team is heard') ?></li>
            <li><?= $sampleCard('Design sprint kickoff', 'Half day, in person') ?></li>
            <li><?= $sampleCard('Onboarding workshop', '2 hours, hybrid') ?></li>
        <?php ws_grid_end() ?>
    </div>
    <?= $code(<<<'PHP'
<?php ws_grid_start(['tag' => 'ul']) ?>
    <?php foreach ($workshops as $w): ?>
        <li><?= ws_card(ws_text($w['title'], ['variant' => 'title'])) ?></li>
    <?php endforeach; ?>
<?php ws_grid_end() ?>
PHP) ?>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Values</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>min</code></td><td><code>sm</code> <code>md</code> <code>lg</code></td><td><code>md</code></td><td>The column floor: <code>--grid-min-sm</code> for compact tiles and stats, <code>--grid-min-md</code> for cards, <code>--grid-min-lg</code> for wide cards</td></tr>
            <tr><td><code>gap</code></td><td><code>2</code> <code>3</code> <code>4</code> <code>5</code> <code>6</code> <code>8</code></td><td><code>4</code></td><td>The <code>--space-N</code> step between items</td></tr>
            <tr><td><code>tag</code></td><td><code>div</code> <code>section</code> <code>ul</code> <code>ol</code></td><td><code>div</code></td><td>A list gets <code>role="list"</code>; wrap each item in an <code>li</code></td></tr>
            <tr><td><code>id</code>, <code>class</code>, <code>attrs</code></td><td>&mdash;</td><td>&mdash;</td><td>Passed to the element</td></tr>
        </tbody>
    </table>
</section>

<!-- Container -->
<section class="ds-section">
    <h2 class="ds-section-title">Container</h2>
    <p class="ds-section-desc">A centred column at a <code>--container-*</code> maximum width with <code>--space-4</code> gutters. It sets width only; space the parts inside it with a stack.</p>
    <div class="ds-card">
        <?php ws_container_start(['width' => 'xs', 'class' => 'layout-demo-outline']) ?>
            <?= ws_section_header('Notification settings', ['tag' => 'h3', 'align' => 'left', 'description' => 'This column stops at --container-xs and stays centred.']) ?>
        <?php ws_container_end() ?>
    </div>
    <?= $code(<<<'PHP'
<?php ws_container_start(['width' => 'sm']) ?>
    <?php ws_stack_start(['gap' => '6']) ?>
        <?= ws_section_header('Notification settings', ['tag' => 'h1', 'align' => 'left']) ?>
        ...
    <?php ws_stack_end() ?>
<?php ws_container_end() ?>
PHP) ?>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Values</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>width</code></td><td><code>xs</code> <code>sm</code> <code>md</code> <code>lg</code> <code>xl</code> <code>2xl</code></td><td><code>lg</code></td><td>The <code>--container-*</code> maximum width</td></tr>
            <tr><td><code>gutter</code></td><td>bool</td><td><code>true</code></td><td><code>false</code> drops the side padding, for a container inside something that already pads</td></tr>
            <tr><td><code>tag</code></td><td><code>div</code> <code>section</code> <code>article</code></td><td><code>div</code></td><td>The element</td></tr>
            <tr><td><code>id</code>, <code>class</code>, <code>attrs</code></td><td>&mdash;</td><td>&mdash;</td><td>Passed to the element</td></tr>
        </tbody>
    </table>
</section>

<!-- Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">They nest. A settings page outside the app shell: a container for the width, a stack for the rhythm, a cluster for the actions. Every end closes the most recent start of its own kind.</p>
    <?= $code(<<<'PHP'
<?php ws_container_start(['width' => 'sm']) ?>
    <?php ws_stack_start(['gap' => '6']) ?>
        <?= ws_section_header('Notification settings', ['tag' => 'h1', 'align' => 'left']) ?>
        <?php ws_stack_start(['tag' => 'form', 'gap' => '5', 'attrs' => ['method' => 'post']]) ?>
            <?= ws_input('email', ['type' => 'email', 'label' => 'Send notifications to', 'error' => $emailError]) ?>
            <?php ws_cluster_start() ?>
                <?= ws_button('Save settings', ['type' => 'submit']) ?>
            <?php ws_cluster_end() ?>
        <?php ws_stack_end() ?>
    <?php ws_stack_end() ?>
<?php ws_container_end() ?>
PHP) ?>
</section>

<!-- Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Order</td><td>None of the helpers reorders anything: reading order and Tab order follow the source, row by row in a grid.</td></tr>
            <tr><td>Lists</td><td>With <code>tag</code> <code>ul</code> or <code>ol</code> the helper sets <code>role="list"</code>, because removing the bullets drops list semantics in Safari. A screen reader then announces how many items there are.</td></tr>
            <tr><td>Landmarks</td><td>No helper adds a role or landmark. Use <code>tag</code> <code>section</code> only with a heading inside it, and never in place of the page's <code>main</code>.</td></tr>
            <tr><td>Reflow</td><td>Clusters wrap and grids drop columns, so nothing scrolls sideways at 320px (WCAG 1.4.10).</td></tr>
        </tbody>
    </table>
</section>

<!-- Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--space-1</code> to <code>--space-12</code></td><td>Every <code>gap</code> step</td></tr>
            <tr><td><code>--grid-min-sm</code> / <code>--grid-min-md</code> / <code>--grid-min-lg</code></td><td>Grid column floors</td></tr>
            <tr><td><code>--container-xs</code> to <code>--container-2xl</code></td><td>Container widths</td></tr>
        </tbody>
    </table>
</section>

<!-- CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-stack</code>, <code>.ws-stack--gap-N</code></td><td>Stack and its step</td></tr>
            <tr><td><code>.ws-cluster</code>, <code>.ws-cluster--gap-N</code>, <code>--justify-*</code>, <code>--align-*</code></td><td>Cluster</td></tr>
            <tr><td><code>.ws-grid</code>, <code>.ws-grid--gap-N</code>, <code>.ws-grid--min-sm</code>, <code>.ws-grid--min-lg</code></td><td>Grid</td></tr>
            <tr><td><code>.ws-container</code>, <code>.ws-container--{width}</code>, <code>.ws-container--flush</code></td><td>Container</td></tr>
        </tbody>
    </table>
</section>

<!-- Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td>The start and end helpers</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles, between <code>LAYOUT: START</code> and <code>LAYOUT: END</code></td></tr>
            <tr><td><code>design-system/platform-tokens.css</code></td><td>The <code>--grid-min-*</code> column floors</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
