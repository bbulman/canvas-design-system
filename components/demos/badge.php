<?php
$ds_page  = 'components/demos/badge';
$ds_title = 'Badge';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Badge</h1>
    <p>A small, non-interactive label that attaches a fact &mdash; duration, category, status, count &mdash; to something else.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            You're annotating a card, row, or heading with metadata the reader scans rather than reads &mdash; "45 min", "Ideation", "Completed", "3". Badges are static by design.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The label does something when clicked &mdash; use <a href="<?= $ds_base ?>/components/demos/button.php">Button</a>. For an activity type use <a href="<?= $ds_base ?>/components/demos/activity-badge.php">Activity Badge</a>, for a removable tag use <a href="<?= $ds_base ?>/components/demos/pill.php">Pill</a>, and for anything longer than three words use plain text.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Types</h3>
        <p class="ds-section-desc">Six variants. <code class="ds-code-inline">category</code> takes a custom <code class="ds-code-inline">color</code>; <code class="ds-code-inline">status</code> has no fill of its own and takes its colour from the <code class="ds-code-inline">status</code> key (info when none is given); the rest are self-contained.</p>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
            <?= ws_badge('Default', ['variant' => 'default']) ?>
            <?= ws_badge('45 min', ['variant' => 'duration', 'icon' => 'schedule']) ?>
            <?= ws_badge('Ideation', ['variant' => 'category', 'color' => '#F59E0B']) ?>
            <?= ws_badge('Team Building', ['variant' => 'category', 'color' => '#10B981']) ?>
            <?= ws_badge('NEW', ['variant' => 'new']) ?>
            <?= ws_badge('3', ['variant' => 'count']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_badge('Default') ?&gt;
&lt;?= ws_badge('45 min', ['variant' => 'duration', 'icon' => 'schedule']) ?&gt;
&lt;?= ws_badge('Ideation', ['variant' => 'category', 'color' => '#F59E0B']) ?&gt;
&lt;?= ws_badge('NEW', ['variant' => 'new']) ?&gt;
&lt;?= ws_badge('3', ['variant' => 'count']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Status</h3>
        <p class="ds-section-desc">Four semantic colours (<code class="ds-code-inline">success</code>, <code class="ds-code-inline">warning</code>, <code class="ds-code-inline">error</code>, <code class="ds-code-inline">info</code>) plus <code class="ds-code-inline">gold</code>, the premium marker. Reach for the <code class="ds-code-inline">ws_status()</code> shorthand rather than assembling the variant and status keys by hand.</p>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
            <?= ws_status('Completed', 'success') ?>
            <?= ws_status('Pending', 'warning') ?>
            <?= ws_status('Failed', 'error') ?>
            <?= ws_status('In Review', 'info') ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_status('Completed', 'success') ?&gt;
&lt;?= ws_status('Pending', 'warning') ?&gt;
&lt;?= ws_status('Failed', 'error') ?&gt;
&lt;?= ws_status('In Review', 'info') ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">AI-made</h3>
        <p class="ds-section-desc"><code class="ds-code-inline">'variant' =&gt; 'ai'</code> is the label for work the AI prepared: the <a href="<?= $ds_base ?>/components/demos/ai-mark.php">AI mark</a> and "Prepared by Workshopr" on the brand tint. Pass an empty string and it says that for you; pass your own words when a surface needs them, as long as they still say who made it. It takes no other icon.</p>
        <div class="ds-card ds-row">
            <?= ws_badge('Prepared by Workshopr', ['variant' => 'ai']) ?>
            <?= ws_badge('Prepared by Workshopr', ['variant' => 'ai', 'size' => 'sm']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_badge('Prepared by Workshopr', ['variant' =&gt; 'ai']) ?&gt;</pre></div>
        <p class="ds-section-desc">From JavaScript, <code class="ds-code-inline">WsAgent.aiBadge(text, options)</code> in <code class="ds-code-inline">/js/ws-agent.js</code> prints the same markup.</p>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Sizes</h3>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
            <?= ws_badge('Small', ['size' => 'sm']) ?>
            <?= ws_badge('Medium', ['size' => 'md']) ?>
            <?= ws_badge('Large', ['size' => 'lg']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_badge('Small', ['size' => 'sm']) ?&gt;
&lt;?= ws_badge('Large', ['size' => 'lg']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Pill</h3>
        <p class="ds-section-desc">Swaps the default radius for a full round. Pick one shape per surface and hold it &mdash; mixed radii in the same meta row read as a bug.</p>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
            <?= ws_badge('Rounded', ['pill' => true]) ?>
            <?= ws_badge('Ideation', ['variant' => 'category', 'color' => '#F59E0B', 'pill' => true]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_badge('Rounded', ['pill' => true]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Shorthand helpers</h3>
        <p class="ds-section-desc">Three convenience wrappers cover the cases that appear most. Each just calls <code class="ds-code-inline">ws_badge()</code> with fixed options, so anything below applies to them too.</p>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
            <?= ws_duration('45 min') ?>
            <?= ws_duration('2 hours') ?>
            <?= ws_category('Strategy', '#3B82F6') ?>
            <?= ws_category('Retrospective', '#EC4899') ?>
        </div>
        <table class="ds-table">
            <thead><tr><th>Helper</th><th>Equivalent to</th></tr></thead>
            <tbody>
                <tr><td><code>ws_duration($text, $withIcon = true)</code></td><td><code>ws_badge($text, ['variant' => 'duration', 'icon' => 'schedule', 'size' => 'sm'])</code> &mdash; pass <code>false</code> to drop the icon</td></tr>
                <tr><td><code>ws_category($name, $color = null)</code></td><td><code>ws_badge($name, ['variant' => 'category', 'color' => $color])</code></td></tr>
                <tr><td><code>ws_status($text, $status = 'info')</code></td><td><code>ws_badge($text, ['variant' => 'status', 'status' => $status])</code></td></tr>
            </tbody>
        </table>
        <div class="ds-code"><pre>&lt;?= ws_duration('45 min') ?&gt;
&lt;?= ws_category('Strategy', '#3B82F6') ?&gt;
&lt;?= ws_status('Completed', 'success') ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>The only state. Badges are static <code>&lt;span&gt;</code>s &mdash; no hover, focus, active, or disabled treatment.</td></tr>
            <tr><td>Inside an interactive parent</td><td>A badge in a hoverable card inherits nothing; the parent owns the hover. The <code>--transition-interactive</code> token is present for parent-driven colour changes.</td></tr>
            <tr><td>Empty text</td><td>Renders an empty badge &mdash; a visible coloured sliver. Guard against empty strings at the call site.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">A library card's meta row: category from the database with its stored colour, duration via the shorthand, and a status badge only when the item needs attention.</p>
    <div class="ds-card" style="max-width: 420px;">
        <div style="font-weight: 600; margin-bottom: 10px;">Assumption Mapping</div>
        <div style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
            <?= ws_category('Discovery', '#3B82F6') ?>
            <?= ws_duration('30 min') ?>
            <?= ws_status('New', 'info') ?>
        </div>
    </div>
    <div class="ds-code"><pre>&lt;div class="card-meta"&gt;
    &lt;?= ws_category($ex['category_name'], $ex['category_color']) ?&gt;
    &lt;?= ws_duration($ex['duration'] . ' min') ?&gt;
    &lt;?php if ($ex['is_new']): ?&gt;&lt;?= ws_status('New', 'info') ?&gt;&lt;?php endif; ?&gt;
&lt;/div&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>$text</code></td><td>string</td><td><code>''</code></td><td>Positional label. Keep it to one or two words.</td></tr>
            <tr><td><code>variant</code></td><td>string</td><td><code>'default'</code></td><td><code>default</code> | <code>duration</code> | <code>category</code> | <code>status</code> | <code>count</code> | <code>new</code> | <code>ai</code></td></tr>
            <tr><td><code>size</code></td><td>string</td><td><code>'md'</code></td><td><code>sm</code> | <code>md</code> | <code>lg</code></td></tr>
            <tr><td><code>icon</code></td><td>string</td><td><code>null</code></td><td>Material icon rendered before the text. Not auto-selected &mdash; even <code>duration</code> needs it passed explicitly (the <code>ws_duration()</code> shorthand does this for you).</td></tr>
            <tr><td><code>color</code></td><td>string</td><td><code>null</code></td><td>Hex colour for the <code>category</code> variant, applied inline</td></tr>
            <tr><td><code>status</code></td><td>string</td><td><code>null</code></td><td><code>success</code> | <code>warning</code> | <code>error</code> | <code>info</code> | <code>gold</code>. Adds the status colour class. With <code>variant: 'status'</code> that colour is the whole look; on another variant it replaces the background and text colour but keeps that variant's border. <code>ws_status()</code> is the shorthand.</td></tr>
            <tr><td><code>pill</code></td><td>bool</td><td><code>false</code></td><td>Full border-radius</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>null</code></td><td>Element ID</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra HTML attributes as key/value pairs</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>ARIA</td><td>None applied. The badge is a text <code>&lt;span&gt;</code> in the document flow, so its content is announced in reading order along with whatever it annotates.</td></tr>
            <tr><td>Keyboard</td><td>Not focusable. If a badge ever needs to be actionable, that's a Button.</td></tr>
            <tr><td>Colour independence</td><td>The label always carries the meaning in words &mdash; "Completed", not a bare green dot. Preserve that: don't ship a status badge whose text is generic while only the colour distinguishes it.</td></tr>
            <tr><td>Context for counts</td><td>The <code>count</code> variant renders a bare number, which is meaningless alone to a screen-reader user. Put the noun in adjacent text or an <code>aria-label</code> on the parent &mdash; "3 unread notes", not "3".</td></tr>
            <tr><td>Contrast</td><td>Built-in variants pair tested token foreground/background. A custom <code>color</code> on the <code>category</code> variant bypasses that &mdash; check it before shipping.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--badge-bg</code> / <code>--badge-color</code> / <code>--badge-radius</code></td><td>Base fill, text, and corner radius</td></tr>
            <tr><td><code>--gray-100</code> / <code>--gray-200</code> / <code>--gray-500</code> / <code>--gray-600</code></td><td>Default and duration variant neutrals</td></tr>
            <tr><td><code>--brand</code></td><td><code>new</code> and <code>count</code> variant fill</td></tr>
            <tr><td><code>--color-success-light</code> / <code>--color-success-ink</code></td><td>Success status</td></tr>
            <tr><td><code>--color-warning-very-light</code> / <code>--color-warning-ink</code></td><td>Warning status</td></tr>
            <tr><td><code>--color-warning-light</code> / <code>--color-warning-surface-ink</code></td><td>Gold (Pro) status</td></tr>
            <tr><td><code>--color-error-light</code> / <code>--color-error-ink</code></td><td>Error status</td></tr>
            <tr><td><code>--color-info-light</code> / <code>--color-info-strong</code></td><td>Info status</td></tr>
            <tr><td><code>--text-inverse</code></td><td>Text on solid fills</td></tr>
            <tr><td><code>--radius-full</code></td><td>Pill shape and the circular <code>count</code> badge</td></tr>
            <tr><td><code>--text-micro</code> / <code>--text-caption</code> / <code>--text-meta</code> / <code>--text-small</code></td><td>Type scale across sizes</td></tr>
            <tr><td><code>--font-body</code> / <code>--font-medium</code> / <code>--font-semibold</code></td><td>Face and weight</td></tr>
            <tr><td><code>--transition-interactive</code></td><td>Colour transition when a parent changes state</td></tr>
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
            <tr><td><code>.ws-badge</code></td><td>Base styles</td></tr>
            <tr><td><code>.ws-badge--default</code></td><td>Neutral variant</td></tr>
            <tr><td><code>.ws-badge--duration</code></td><td>Duration variant</td></tr>
            <tr><td><code>.ws-badge--category</code></td><td>Category variant (accepts the inline custom colour)</td></tr>
            <tr><td><code>.ws-badge--new</code></td><td>"New" label variant</td></tr>
            <tr><td><code>.ws-badge--count</code></td><td>Circular count variant</td></tr>
            <tr><td><code>.ws-badge--ai</code></td><td>AI-made variant: the AI mark on the brand tint</td></tr>
            <tr><td><code>.ws-badge--success / --warning / --error / --info</code></td><td>Status colours, emitted from the <code>status</code> option</td></tr>
            <tr><td><code>.ws-badge--sm / --md / --lg</code></td><td>Size modifiers</td></tr>
            <tr><td><code>.ws-badge--pill</code></td><td>Full radius</td></tr>
            <tr><td><code>.ws-badge__icon</code></td><td>Leading icon wrapper</td></tr>
            <tr><td><code>.ws-badge__text</code></td><td>Label wrapper &mdash; <strong>emitted but currently has no CSS rule</strong>. A hook for overrides, not an active style.</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_badge()</code> plus the <code>ws_duration()</code>, <code>ws_category()</code>, and <code>ws_status()</code> shorthands</td></tr>
            <tr><td><code>includes/components/badge.php</code></td><td>Template &mdash; variant and status class assembly</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-badge</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
