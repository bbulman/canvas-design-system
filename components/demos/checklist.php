<?php
$ds_page  = 'components/demos/checklist';
$ds_title = 'Checklist';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Checklist</h1>
    <p>An icon-prefixed list for benefit and feature copy &mdash; presentational, not interactive.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            You're listing what something includes &mdash; plan features, workshop inclusions, benefit bullets on a marketing page. Each item is a short affirmative phrase.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The user has to tick things off &mdash; nothing here is clickable. For trackable tasks use <a href="<?= $ds_base ?>/components/demos/task-checklist.php">Task Checklist</a>; for real checkbox input use <a href="<?= $ds_base ?>/components/demos/checkbox-card-group.php">Checkbox Card Group</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Default</h3>
        <div class="ds-card">
            <?= ws_checklist([
                'Pre-built workshop agendas',
                'Exercises for every challenge',
                'AI-powered facilitation coaching',
                'Drag-and-drop workshop planner',
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_checklist([
    'Pre-built workshop agendas',
    'Exercises for every challenge',
    'AI-powered facilitation coaching',
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Compact</h3>
        <p class="ds-section-desc">Tighter vertical rhythm for sidebars, cards, and constrained columns.</p>
        <div class="ds-card">
            <?= ws_checklist([
                'Includes prep mode',
                'Live session tracking',
                'Post-session reflection',
            ], ['variant' => 'compact']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_checklist($items, ['variant' => 'compact']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Custom icon</h3>
        <p class="ds-section-desc">Any Material icon replaces the default check. Keep one icon per list &mdash; the icon marks the list's character, it doesn't vary by item.</p>
        <div class="ds-card">
            <div class="ds-grid-2">
                <div>
                    <h4 class="ds-subsection-title">Stars</h4>
                    <?= ws_checklist([
                        'Top-rated exercises',
                        'Expert-curated agendas',
                        'Community favourites',
                    ], ['icon' => 'star']) ?>
                </div>
                <div>
                    <h4 class="ds-subsection-title">Lightning</h4>
                    <?= ws_checklist([
                        'Quick 5-min setup',
                        'Instant AI feedback',
                        'Real-time suggestions',
                    ], ['icon' => 'bolt']) ?>
                </div>
            </div>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_checklist($items, ['icon' => 'star']) ?&gt;
&lt;?= ws_checklist($items, ['icon' => 'bolt']) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>The only state. Items are static <code>&lt;li&gt;</code>s with no hover, focus, checked, or disabled treatment.</td></tr>
            <tr><td>Empty array</td><td>Renders an empty <code>&lt;ul&gt;</code> &mdash; invisible but present in the DOM. Guard on the array before calling.</td></tr>
            <tr><td>Long items</td><td>Text wraps and stays aligned; the icon holds its own column rather than sitting inline with the first word.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">A pricing tier's inclusion list &mdash; compact variant inside the plan card, items pulled from the tier definition so the copy and the entitlement never drift apart.</p>
    <div class="ds-card" style="max-width: 320px;">
        <strong>Pro</strong>
        <p style="margin: 4px 0 12px; color: var(--text-muted, #78716C); font-size: var(--text-small, 14px);">Everything in Free, plus:</p>
        <?= ws_checklist([
            'Unlimited saved workshops',
            'AI Coach during live sessions',
            'Synthesize post-session readouts',
            'Export to PDF and Miro',
        ], ['variant' => 'compact']) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_checklist($tier['features'], ['variant' => 'compact']) ?&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>$items</code></td><td>array</td><td>required</td><td>Positional array of plain strings. Each is escaped, so markup inside an item is shown literally rather than rendered.</td></tr>
            <tr><td><code>icon</code></td><td>string</td><td><code>'check_circle'</code></td><td>Material icon name, applied to every item</td></tr>
            <tr><td><code>variant</code></td><td>string</td><td><code>'default'</code></td><td><code>default</code> | <code>compact</code>. Only non-default emits a modifier class.</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>null</code></td><td>Element ID on the <code>&lt;ul&gt;</code></td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Semantics</td><td>A real <code>&lt;ul&gt;</code> of <code>&lt;li&gt;</code>s, so screen readers announce it as a list with an item count and let users jump between items. No ARIA is needed or added.</td></tr>
            <tr><td>Keyboard</td><td>Not interactive and not focusable &mdash; correctly absent from the tab order.</td></tr>
            <tr><td>Escaping</td><td>Item text runs through <code>htmlspecialchars()</code>, so user-supplied strings are safe here.</td></tr>
            <tr><td>Not a form control</td><td>The checkmark is decoration, not state. Never use this list to represent things the user has completed &mdash; a screen-reader user has no way to tell a "done" check from a "included" check.</td></tr>
            <tr><td>Icon announcement</td><td><strong>Known gap:</strong> the icon <code>&lt;span&gt;</code> has no <code>aria-hidden="true"</code>. Material Symbols render from ligature text, so some screen readers read the raw glyph name &mdash; "check circle" before every item. Harmless but noisy; worth fixing in the template.</td></tr>
            <tr><td>Contrast</td><td>Icons use <code>--brand</code> and text uses <code>--text-default</code>, both tested against the page surface.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--brand</code></td><td>Icon colour</td></tr>
            <tr><td><code>--text-default</code></td><td>Item text</td></tr>
            <tr><td><code>--space-2</code> / <code>--space-3</code></td><td>Icon-to-text gap and the gap between items (tightened by <code>compact</code>)</td></tr>
            <tr><td><code>--text-small</code> / <code>--text-meta</code></td><td>Type scale across variants</td></tr>
            <tr><td><code>--font-body</code></td><td>Body face</td></tr>
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
            <tr><td><code>.ws-checklist</code></td><td>The <code>&lt;ul&gt;</code> &mdash; resets list styling and sets the item rhythm</td></tr>
            <tr><td><code>.ws-checklist--compact</code></td><td>Tighter spacing</td></tr>
            <tr><td><code>.ws-checklist__item</code></td><td>Each <code>&lt;li&gt;</code></td></tr>
            <tr><td><code>.ws-checklist__icon</code></td><td>Leading icon wrapper</td></tr>
            <tr><td><code>.ws-checklist__text</code></td><td>Item text wrapper</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_checklist()</code> helper function</td></tr>
            <tr><td><code>includes/components/checklist.php</code></td><td>Template &mdash; list markup and escaping</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-checklist</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
