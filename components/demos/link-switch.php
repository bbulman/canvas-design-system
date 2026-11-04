<?php
$ds_page  = 'components/demos/link-switch';
$ds_title = 'Link Switch';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';

$demoLength = ($_GET['length'] ?? '') === '60' ? 60 : 90;
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Link Switch</h1>
    <p>Two to four links to versions of the same page, one of them current: 90 | 60, In person | Remote. Each choice is a URL, so it can be shared, bookmarked and printed.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            The reader picks which version of this page to see and the choice belongs in the URL, such as a recipe's length or setting. It needs no JavaScript.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            Panels switch in place without a reload (<a href="<?= $ds_base ?>/components/demos/tabs.php">Tabs</a>), a setting saves (<a href="<?= $ds_base ?>/components/demos/toggle.php">Toggle</a>), or a list narrows (<a href="<?= $ds_base ?>/components/demos/filter-bar.php">Filter Bar</a>).
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With a visible label</h3>
        <p class="ds-section-desc">This one is live: choosing an option reloads this page with <code class="ds-code-inline">?length=</code> set. The current option is <code class="ds-code-inline">aria-current="true"</code>.</p>
        <div class="ds-card">
            <?= ws_link_switch([
                ['label' => '90 min', 'href' => '?length=90', 'current' => $demoLength === 90],
                ['label' => '60 min', 'href' => '?length=60', 'current' => $demoLength === 60],
            ], ['label' => 'Length', 'showLabel' => true, 'id' => 'demo-length']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_link_switch([
    ['label' =&gt; '90 min', 'href' =&gt; '?code=sprint-retro&amp;length=90', 'current' =&gt; true],
    ['label' =&gt; '60 min', 'href' =&gt; '?code=sprint-retro&amp;length=60'],
], ['label' =&gt; 'Length', 'showLabel' =&gt; true]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Without a visible label</h3>
        <p class="ds-section-desc">When the page already says what is being chosen, <code class="ds-code-inline">label</code> still names the list for screen readers.</p>
        <div class="ds-card">
            <?= ws_link_switch([
                ['label' => 'In person', 'href' => '?mode=in-person', 'current' => true],
                ['label' => 'Remote', 'href' => '?mode=remote'],
            ], ['label' => 'Setting']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_link_switch([
    ['label' =&gt; 'In person', 'href' =&gt; '?mode=in-person', 'current' =&gt; true],
    ['label' =&gt; 'Remote', 'href' =&gt; '?mode=remote'],
], ['label' =&gt; 'Setting']) ?&gt;</pre></div>
    </div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>$items</code></td><td>array</td><td>required</td><td>Each option: <code>label</code>, <code>href</code>, <code>current</code></td></tr>
            <tr><td><code>label</code></td><td>string</td><td>required</td><td>What is being switched; names the list</td></tr>
            <tr><td><code>showLabel</code></td><td>bool</td><td><code>false</code></td><td>Show the label as text before the options</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>''</code></td><td>Element ID; the visible label's id is <code>{id}-label</code></td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra HTML attributes</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Semantics</td><td>A list of links, named by the visible label (<code>aria-labelledby</code>) or by <code>aria-label</code>. Not a tablist: choosing an option loads a page.</td></tr>
            <tr><td>Current</td><td><code>aria-current="true"</code> on the current option, so it is announced as current, not only shown in red.</td></tr>
            <tr><td>Target size</td><td>Each option is at least 44px tall.</td></tr>
            <tr><td>Focus</td><td>The ring sits inside the option, because the options clip to the rounded border.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--brand</code>, <code>--text-inverse</code></td><td>The current option</td></tr>
            <tr><td><code>--gray-200</code></td><td>The border and the dividers</td></tr>
            <tr><td><code>--gray-600</code>, <code>--gray-50</code></td><td>Other options, and their hover</td></tr>
            <tr><td><code>--font-body</code>, <code>--text-small</code></td><td>The label and options</td></tr>
            <tr><td><code>--focus-ring</code></td><td>Keyboard focus</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-link-switch</code></td><td>The label and the options</td></tr>
            <tr><td><code>.ws-link-switch__label</code></td><td>The visible label</td></tr>
            <tr><td><code>.ws-link-switch__options</code></td><td>The bordered list</td></tr>
            <tr><td><code>.ws-link-switch__option</code> / <code>.is-current</code></td><td>One option, and the current one</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_link_switch()</code></td></tr>
            <tr><td><code>includes/components/link-switch.php</code></td><td>Template</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-link-switch</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
