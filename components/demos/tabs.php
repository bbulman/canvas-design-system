<?php
$ds_page  = 'components/demos/tabs';
$ds_title = 'Tabs';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Tabs</h1>
    <p>Switches between sibling views without leaving the page.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            Two or more views sit at the same level and the reader looks at one at a time: content categories, settings sections, filter groups. Tabs preserve context that navigation would break. Pick the variant by what switching changes. <code>underline</code> (the default, size md) switches whole sections of a page or a workshop: Agenda and Notes, Overview and Details. <code>pill</code> narrows a list that stays below it: All, Exercises, Icebreakers. <code>segmented</code> changes how the same content is shown: grid or list, this week or this month. Name the tabs with nouns in sentence case, and give the row a <code>label</code> that says what it switches ("Workshop sections"). Put a <code>count</code> only on a tab whose label is the thing counted ("Exercises 120"), as on a pill filter; a section tab such as Agenda takes none. Give the row a <code>param</code> (<code>'tab'</code>) whenever reload, a shared link or a form in a panel should come back to the open tab.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The reader needs to compare views side by side, or the content is sequential &mdash; steps need a stepper. For expanding several sections at once use <a href="<?= $ds_base ?>/components/demos/accordion.php">Accordion</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Underline (default)</h3>
        <p class="ds-section-desc">The standard page-level treatment, shown with its panels. A <code class="ds-code-inline">count</code> renders a badge after the label. Tab into the row, then use the arrow keys, <kbd>Home</kbd> and <kbd>End</kbd>.</p>
        <div class="ds-card">
            <?= ws_tabs([
                ['id' => 'overview', 'label' => 'Overview', 'active' => true],
                ['id' => 'details', 'label' => 'Details'],
                ['id' => 'resources', 'label' => 'Resources', 'count' => 5],
            ], ['id' => 'demo-tabs-underline', 'label' => 'Workshop sections']) ?>
            <?php ws_tab_panel_start('overview') ?>
                <p>A two-hour retrospective for a team of eight, run in person.</p>
            <?php ws_tab_panel_end() ?>
            <?php ws_tab_panel_start('details') ?>
                <p>Four activities and one break, with the energy peak in the second hour.</p>
            <?php ws_tab_panel_end() ?>
            <?php ws_tab_panel_start('resources') ?>
                <p>Five templates and handouts, ready to print.</p>
            <?php ws_tab_panel_end() ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_tabs([
    ['id' => 'overview',  'label' => 'Overview', 'active' => true],
    ['id' => 'details',   'label' => 'Details'],
    ['id' => 'resources', 'label' => 'Resources', 'count' => 5],
], ['label' => 'Workshop sections']) ?&gt;
&lt;?php ws_tab_panel_start('overview') ?&gt; … &lt;?php ws_tab_panel_end() ?&gt;
&lt;?php ws_tab_panel_start('details') ?&gt; … &lt;?php ws_tab_panel_end() ?&gt;
&lt;?php ws_tab_panel_start('resources') ?&gt; … &lt;?php ws_tab_panel_end() ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Keeping the open tab</h3>
        <p class="ds-section-desc">With <code>param</code>, the URL says which tab is open: <code>?tab=notes</code> opens Notes, switching tabs updates it, and a GET form inside a panel sends it, so saving a note comes back to Notes rather than the first tab.</p>
        <div class="ds-card">
            <?= ws_tabs([
                ['id' => 'keep-agenda', 'label' => 'Agenda', 'active' => true],
                ['id' => 'keep-notes', 'label' => 'Notes'],
            ], ['id' => 'demo-tabs-param', 'label' => 'Workshop sections', 'param' => 'tab']) ?>
            <?php ws_tab_panel_start('keep-agenda') ?>
                <?= ws_agenda([['title' => 'Welcome', 'duration' => 10], ['title' => 'Dot voting', 'duration' => 30]], ['start' => '09:30', 'label' => 'Agenda']) ?>
            <?php ws_tab_panel_end() ?>
            <?php ws_tab_panel_start('keep-notes') ?>
                <?php ws_stack_start(['tag' => 'form', 'gap' => '3', 'attrs' => ['method' => 'get', 'action' => '#demo-tabs-param']]) ?>
                    <?= ws_input('keep_note', ['type' => 'textarea', 'label' => 'Your notes', 'id' => 'keep-note-field', 'value' => (string) ($_GET['keep_note'] ?? '')]) ?>
                    <?= ws_button('Save notes', ['type' => 'submit']) ?>
                <?php ws_stack_end() ?>
            <?php ws_tab_panel_end() ?>
        </div>
        <div class="ds-code"><pre><?= htmlspecialchars(<<<'PHP'
<?= ws_tabs($items, ['label' => 'Workshop sections', 'param' => 'tab']) ?>
<?php ws_tab_panel_start('notes') ?>
    <?php ws_stack_start(['tag' => 'form', 'attrs' => ['method' => 'get']]) ?>
        ...   <!-- the panel adds <input type="hidden" name="tab" value="notes"> -->
    <?php ws_stack_end() ?>
<?php ws_tab_panel_end() ?>
PHP) ?></pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Pill</h3>
        <p class="ds-section-desc">Lighter weight, for filtering a list below rather than switching a whole view.</p>
        <div class="ds-card">
            <?= ws_tabs([
                ['id' => 'pill-all', 'label' => 'All', 'active' => true],
                ['id' => 'pill-exercises', 'label' => 'Exercises'],
                ['id' => 'pill-icebreakers', 'label' => 'Icebreakers'],
            ], ['id' => 'demo-tabs-pill', 'variant' => 'pill']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_tabs($items, ['variant' => 'pill']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Segmented</h3>
        <p class="ds-section-desc">A joined control for two to four mutually exclusive modes &mdash; time ranges, view density. Don't use it for more than four.</p>
        <div class="ds-card">
            <?= ws_tabs([
                ['id' => 'daily', 'label' => 'Daily', 'active' => true],
                ['id' => 'weekly', 'label' => 'Weekly'],
                ['id' => 'monthly', 'label' => 'Monthly'],
            ], ['id' => 'demo-tabs-seg', 'variant' => 'segmented']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_tabs($items, ['variant' => 'segmented']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Sizes</h3>
        <div class="ds-card" style="display: flex; flex-direction: column; gap: 24px;">
            <div>
                <p class="ds-tabs-demo-label">Small</p>
                <?= ws_tabs([
                    ['id' => 'sm1', 'label' => 'Tab A', 'active' => true],
                    ['id' => 'sm2', 'label' => 'Tab B'],
                ], ['id' => 'demo-tabs-sm', 'size' => 'sm']) ?>
            </div>
            <div>
                <p class="ds-tabs-demo-label">Medium (default)</p>
                <?= ws_tabs([
                    ['id' => 'md1', 'label' => 'Tab A', 'active' => true],
                    ['id' => 'md2', 'label' => 'Tab B'],
                ], ['id' => 'demo-tabs-md']) ?>
            </div>
            <div>
                <p class="ds-tabs-demo-label">Large</p>
                <?= ws_tabs([
                    ['id' => 'lg1', 'label' => 'Tab A', 'active' => true],
                    ['id' => 'lg2', 'label' => 'Tab B'],
                ], ['id' => 'demo-tabs-lg', 'size' => 'lg']) ?>
            </div>
        </div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <div class="ds-card">
        <?= ws_tabs([
            ['id' => 'info', 'label' => 'Info', 'icon' => 'info', 'active' => true],
            ['id' => 'premium', 'label' => 'Premium', 'icon' => 'star', 'gated' => true],
            ['id' => 'disabled', 'label' => 'Disabled', 'disabled' => true],
        ], ['id' => 'demo-tabs-icons']) ?>
    </div>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Active</td><td><code>.is-active</code>, <code>aria-selected="true"</code> and <code>tabindex="0"</code>. Exactly one tab should start active; the component doesn't enforce it. With none active, the first enabled tab takes the Tab stop.</td></tr>
            <tr><td>Hover</td><td>Colour shift over <code>--transition-interactive</code>.</td></tr>
            <tr><td>Focus</td><td>The platform focus ring (<code>--focus-ring</code>) on the focused tab. Arrow keys move focus and selection together, so the ring and the active style land on the same tab.</td></tr>
            <tr><td>Disabled</td><td><code>.is-disabled</code> plus the <code>disabled</code> attribute: out of the Tab order, skipped by the arrow keys, and announced as unavailable.</td></tr>
            <tr><td>Gated</td><td><code>.is-gated</code> plus a lock icon, for premium features. Deliberately still focusable so the user can discover what's behind the gate.</td></tr>
            <tr><td>Scrollable</td><td>On by default: <code>.ws-tabs--scrollable</code> lets the row scroll horizontally rather than wrap on narrow screens.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">A library listing filter: counts come from the query so the reader sees how much sits behind each tab, and the active tab is derived from the URL so the state survives a reload.</p>
    <div class="ds-card">
        <?= ws_tabs([
            ['id' => 'all', 'label' => 'All', 'count' => 214, 'active' => true],
            ['id' => 'exercises', 'label' => 'Exercises', 'count' => 120],
            ['id' => 'icebreakers', 'label' => 'Icebreakers', 'count' => 80],
            ['id' => 'workshops', 'label' => 'Workshops', 'count' => 14],
        ], ['id' => 'demo-tabs-real', 'variant' => 'pill']) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_tabs([
    ['id' => 'all',       'label' => 'All',       'count' => $counts['all'], 'active' => true],
    ['id' => 'exercises', 'label' => 'Exercises', 'count' => $counts['exercises']],
], ['id' => 'library-tabs', 'variant' => 'pill', 'param' => 'type', 'label' => 'Library types']) ?&gt;
&lt;?php // ?type=exercises opens Exercises; active marks the tab a bare URL opens on. ?&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>

    <h3 class="ds-subsection-title">Tabs options</h3>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>$items</code></td><td>array</td><td><code>[]</code></td><td>Positional array of tab definitions</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>'ws-tabs-' . uniqid()</code></td><td>Container ID. Set it explicitly if JS needs a handle.</td></tr>
            <tr><td><code>variant</code></td><td>string</td><td><code>'underline'</code></td><td><code>underline</code> | <code>pill</code> | <code>segmented</code></td></tr>
            <tr><td><code>size</code></td><td>string</td><td><code>'md'</code></td><td><code>sm</code> | <code>md</code> | <code>lg</code></td></tr>
            <tr><td><code>scrollable</code></td><td>bool</td><td><code>true</code></td><td>Horizontal scroll instead of wrapping</td></tr>
            <tr><td><code>label</code></td><td>string</td><td><code>''</code></td><td>The tablist's <code>aria-label</code>. Set it when no visible heading names the row.</td></tr>
            <tr><td><code>param</code></td><td>string</td><td><code>''</code></td><td>Query-string name for the open tab, conventionally <code>'tab'</code>, with the item ids as its values. It overrides the items' <code>active</code> flags, rides through every GET form in the row's panels as a hidden field, and follows tab clicks in the URL with <code>replaceState</code>.</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
        </tbody>
    </table>

    <h3 class="ds-subsection-title">Item options</h3>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>id</code></td><td>string</td><td><code>'tab-' . $index</code></td><td>Emitted as <code>data-tab</code>, and used to build the tab's own id <code>{id}-tab</code> and its <code>aria-controls</code> <code>{id}-panel</code>. Keep it unique on the page.</td></tr>
            <tr><td><code>label</code></td><td>string</td><td><code>''</code></td><td>Tab text</td></tr>
            <tr><td><code>icon</code></td><td>string</td><td><code>null</code></td><td>Leading Material icon</td></tr>
            <tr><td><code>count</code></td><td>int</td><td><code>null</code></td><td>Badge count after the label</td></tr>
            <tr><td><code>active</code></td><td>bool</td><td><code>false</code></td><td>Initially selected</td></tr>
            <tr><td><code>disabled</code></td><td>bool</td><td><code>false</code></td><td>A disabled button: dimmed, click-blocked, and skipped by Tab and the arrow keys</td></tr>
            <tr><td><code>gated</code></td><td>bool</td><td><code>false</code></td><td>Lock icon for premium gating</td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">info</span>
        <span><code>ws_tabs</code> renders the row; <code>ws_tab_panel_start('{tabId}')</code> and <code>ws_tab_panel_end()</code> write each panel after it. The panel gets <code>id="{tabId}-panel"</code>, which the tab's <code>aria-controls</code> points at, the <code>ws-tab-pane</code> class, <code>role="tabpanel"</code> and its name, and it is open exactly when its tab is the active item, so a page that posts back to the Notes tab opens on Notes. <code>components.js</code> then shows the active panel and hides the rest of this row's, leaving any other tab row's alone.</span>
    </div>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <p class="ds-section-desc">The <a href="https://www.w3.org/WAI/ARIA/apg/patterns/tabs/" target="_blank" rel="noopener">WAI-ARIA Tabs pattern</a> with automatic activation: moving to a tab shows its panel.</p>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>ARIA</td><td>The row is <code>role="tablist"</code>, named by the <code>label</code> option. Each tab is a real button with <code>role="tab"</code>, <code>id="{id}-tab"</code>, <code>aria-selected</code>, and <code>aria-controls</code> pointing at <code>{id}-panel</code>.</td></tr>
            <tr><td>Keyboard</td><td>Roving <code>tabindex</code>: only the active tab is in the Tab order, so <kbd>Tab</kbd> enters the row on it and the next <kbd>Tab</kbd> leaves for the panel. <kbd>&rarr;</kbd>/<kbd>&larr;</kbd> move to the next or previous tab and wrap at the ends; <kbd>Home</kbd>/<kbd>End</kbd> go to the first or last. Each move also activates the tab, and disabled tabs are skipped. Wired by <code>wsTabsInit()</code> in <code>components.js</code>.</td></tr>
            <tr><td>Focus</td><td>The platform focus ring marks the focused tab; <code>wsTabsSwitch()</code> keeps <code>tabindex</code> in step when a page switches tabs from its own code.</td></tr>
            <tr><td>Panels</td><td><code>ws_tab_panel_start</code> writes <code>role="tabpanel"</code> and <code>aria-labelledby="{id}-tab"</code> into the markup (or <code>aria-label</code> from its <code>label</code> option), so the panel is named before any script runs, and gives <code>tabindex="0"</code> to a panel whose content has nothing focusable, so <kbd>Tab</kbd> reaches its text. A panel holding a control gets no extra stop.</td></tr>
            <tr><td>Ids</td><td>Each item id becomes <code>{id}-tab</code> and <code>{id}-panel</code>, and <code>components.js</code> also looks up the bare item id, for older panes written as <code>&lt;div class="ws-tab-pane" id="{id}"&gt;</code>. It ignores an element without that class, but keep the bare id free all the same, so the next reader is not left to work that out: a field named like a tab takes it, since <code>ws_input('notes')</code> renders <code>id="notes"</code> beside a Notes tab. Give the field its own id (<code>'id' =&gt; 'workshop-notes'</code>) and keep its name for the query string. In a fragment that shares a page with other content, prefix the item ids with what the row belongs to (<code>workshop-agenda</code>, <code>workshop-notes</code>).</td></tr>
            <tr><td>Counts</td><td>The count is plain text inside the tab, so it joins the tab's name: "Exercises 120". That reads well only when the label is the noun counted, which is why counts belong on filter tabs and not on section tabs.</td></tr>
            <tr><td>Colour independence</td><td>The active tab is marked by colour and an underline or fill. <code>aria-selected</code> carries the state non-visually and the script keeps it accurate.</td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">info</span>
        <span><strong>Limits.</strong> The arrow keys follow left-to-right order; there is no right-to-left mirroring. Tab rows rendered by a page's own script after load (Synthesize builds its own) are not bound by the <code>DOMContentLoaded</code> pass: call <code>wsTabsInit()</code> on them once they are in the document.</span>
    </div>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--brand</code> / <code>--brand-soft</code></td><td>Active tab colour and its underline or fill</td></tr>
            <tr><td><code>--bg-surface</code></td><td>Segmented-variant active segment</td></tr>
            <tr><td><code>--gray-50</code> / <code>--gray-100</code> / <code>--gray-200</code></td><td>Track, hover fill, and the underline rule</td></tr>
            <tr><td><code>--gray-400</code> / <code>--gray-500</code></td><td>Inactive label and the disabled state</td></tr>
            <tr><td><code>--text-dark</code> / <code>--text-inverse</code></td><td>Label colours</td></tr>
            <tr><td><code>--radius-full</code> / <code>--radius-lg</code></td><td>Pill and segmented corners</td></tr>
            <tr><td><code>--shadow-sm</code></td><td>Segmented active segment elevation</td></tr>
            <tr><td><code>--text-micro</code> / <code>--text-meta</code> / <code>--text-small</code> / <code>--text-ui</code></td><td>Label and count type scale across sizes</td></tr>
            <tr><td><code>--font-body</code> / <code>--font-medium</code> / <code>--font-semibold</code></td><td>Face, and the weight bump on the active tab</td></tr>
            <tr><td><code>--transition-interactive</code></td><td>Hover and active transitions</td></tr>
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
            <tr><td><code>.ws-tabs</code></td><td>Outer container. Auto-initialised on <code>DOMContentLoaded</code>.</td></tr>
            <tr><td><code>.ws-tabs--pill / --segmented</code></td><td>Variants (<code>underline</code> is the default and emits nothing)</td></tr>
            <tr><td><code>.ws-tabs--sm / --lg</code></td><td>Size modifiers</td></tr>
            <tr><td><code>.ws-tabs--scrollable</code></td><td>Horizontal overflow scrolling</td></tr>
            <tr><td><code>.ws-tabs__nav</code></td><td>The <code>role="tablist"</code> row</td></tr>
            <tr><td><code>.ws-tabs__btn</code></td><td>Each tab button</td></tr>
            <tr><td><code>.ws-tabs__btn.is-active</code></td><td>Selected tab</td></tr>
            <tr><td><code>.ws-tabs__btn.is-disabled</code></td><td>Disabled tab</td></tr>
            <tr><td><code>.ws-tabs__btn.is-gated</code></td><td>Gated tab</td></tr>
            <tr><td><code>.ws-tabs__icon</code></td><td>Leading icon</td></tr>
            <tr><td><code>.ws-tabs__count</code></td><td>Badge count</td></tr>
            <tr><td><code>.ws-tabs__lock</code> / <code>.ws-tabs__lock-icon</code></td><td>Gated lock indicator</td></tr>
            <tr><td><code>.ws-tabs__label</code></td><td>Label wrapper &mdash; <strong>emitted but has no CSS rule</strong>. A hook, not an active style.</td></tr>
            <tr><td><code>.ws-tab-pane</code> / <code>.ws-tab-pane.is-active</code></td><td>A panel, hidden until its tab is active</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_tabs()</code> helper function</td></tr>
            <tr><td><code>includes/components/tabs.php</code></td><td>Template &mdash; markup and ARIA wiring</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-tabs</code> rules)</td></tr>
            <tr><td><code>includes/components/components.js</code></td><td><code>wsTabsInit()</code>, <code>wsTabsKeydown()</code> and <code>wsTabsSwitch()</code>: click and arrow-key switching, roving <code>tabindex</code>, panel wiring, and the auto-init</td></tr>
        </tbody>
    </table>
</section>

<style>
.ds-tabs-demo-label {
    font-size: var(--text-caption, 12px);
    color: var(--text-muted, #78716C);
    margin-bottom: 8px;
}
</style>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
