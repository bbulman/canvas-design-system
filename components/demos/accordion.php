<?php
$ds_page  = 'components/demos/accordion';
$ds_title = 'Accordion';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Accordion</h1>
    <p>Collapses a list of headings so readers can scan first and expand only what they need.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            You have FAQs, step-by-step instructions, or a long list of independent sections readers will scan and sample. Accordion cuts page length without hiding anything from search or the DOM.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            All the content should be visible at once (a short form), or there are only two items &mdash; show those inline. For switching between mutually exclusive views, use <a href="<?= $ds_base ?>/components/demos/tabs.php">Tabs</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Default</h3>
        <p class="ds-section-desc">Divider-separated rows. Opening one panel closes the others.</p>
        <div class="ds-card">
            <?= ws_accordion([
                ['title' => 'What is Workshopr?', 'content' => '<p>Workshopr is a platform for workshop facilitators featuring a content library and AI Facilitation Coach.</p>', 'open' => true],
                ['title' => 'How does the AI Coach work?', 'content' => '<p>The AI Coach provides real-time guidance during your workshops, helping you adapt to group dynamics and keep sessions on track.</p>'],
                ['title' => 'Is there a free plan?', 'content' => '<p>Yes! Workshopr offers a free tier with access to the content library. Premium features are available with Pro and Team plans.</p>'],
            ], ['id' => 'demo-accordion']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_accordion([
    ['title' => 'Question 1', 'content' => 'Answer 1', 'open' => true],
    ['title' => 'Question 2', 'content' => 'Answer 2'],
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Bordered</h3>
        <p class="ds-section-desc">Each panel becomes a discrete card. Use when the accordion sits directly on a page background rather than inside a container.</p>
        <div class="ds-card">
            <?= ws_accordion([
                ['title' => 'Getting Started', 'content' => '<p>Create an account and explore the content library to find exercises and workshops for your next session.</p>', 'icon' => 'rocket_launch'],
                ['title' => 'Planning a Workshop', 'content' => '<p>Use the Planner to drag and drop exercises into a timeline, then export your agenda.</p>', 'icon' => 'edit_note'],
                ['title' => 'Running a Session', 'content' => '<p>The Coach provides real-time support during your workshop with intervention suggestions and timing guidance.</p>', 'icon' => 'groups'],
            ], ['id' => 'demo-accordion-bordered', 'variant' => 'bordered']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_accordion($items, ['variant' => 'bordered']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Multiple open</h3>
        <p class="ds-section-desc">Set <code class="ds-code-inline">multiple: true</code> when panels are independent and readers may want to compare them side by side.</p>
        <div class="ds-card">
            <?= ws_accordion([
                ['title' => 'Panel One', 'content' => '<p>This accordion allows multiple panels to be open simultaneously.</p>', 'open' => true],
                ['title' => 'Panel Two', 'content' => '<p>Click to open without closing the other panels.</p>', 'open' => true],
                ['title' => 'Panel Three', 'content' => '<p>All three can be open at the same time.</p>'],
            ], ['id' => 'demo-accordion-multiple', 'multiple' => true]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_accordion($items, ['multiple' => true]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With icons</h3>
        <p class="ds-section-desc">A per-item Material icon adds category context. Keep icons consistent across the set &mdash; a mix of iconed and plain rows reads as an error.</p>
        <div class="ds-card">
            <?= ws_accordion([
                ['title' => 'Design Sprint', 'content' => '<p>A 5-day process for answering critical business questions through design, prototyping, and testing.</p>', 'icon' => 'design_services'],
                ['title' => 'Retrospective', 'content' => '<p>A meeting for the team to reflect on what went well, what didn&rsquo;t, and what to improve.</p>', 'icon' => 'history'],
            ], ['id' => 'demo-accordion-icons', 'variant' => 'bordered']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_accordion([
    ['title' => 'Design Sprint', 'content' => '...', 'icon' => 'design_services'],
    ['title' => 'Retrospective', 'content' => '...', 'icon' => 'history'],
], ['variant' => 'bordered']) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Collapsed</td><td>Panel carries <code>hidden</code>; trigger reports <code>aria-expanded="false"</code>. The content stays in the DOM.</td></tr>
            <tr><td>Open</td><td>Item gains <code>.is-open</code>, <code>hidden</code> is removed, <code>aria-expanded="true"</code>. Fires a bubbling <code>ws-accordion-open</code> event.</td></tr>
            <tr><td>Closing</td><td>Fires <code>ws-accordion-close</code>. In single-open mode, closing the siblings happens before the new panel opens.</td></tr>
            <tr><td>Disabled</td><td>Item gains <code>.is-disabled</code> and the trigger's click handler returns early. Set per item, not per accordion.</td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">info</span>
        <span>Both events bubble, so you can listen once on the container rather than per item &mdash; useful for analytics on which FAQ entries get opened.</span>
    </div>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The pricing FAQ pattern: single-open (so the page length stays stable), bordered (it sits on the page background), first item closed so the reader sees the full question list before committing to one.</p>
    <div class="ds-card">
        <?= ws_accordion([
            ['title' => 'Can I use Workshopr for client work?', 'content' => '<p>Yes. Every plan permits commercial facilitation. Team plans add shared collections so co-facilitators work from the same library.</p>', 'icon' => 'work'],
            ['title' => 'What happens to my workshops if I downgrade?', 'content' => '<p>Nothing is deleted. Plans above the free tier\'s limit become read-only until you either archive some or upgrade again.</p>', 'icon' => 'inventory_2'],
            ['title' => 'Do you offer nonprofit pricing?', 'content' => '<p>We do &mdash; get in touch with your organisation details and we\'ll sort it out.</p>', 'icon' => 'volunteer_activism'],
        ], ['id' => 'demo-accordion-faq', 'variant' => 'bordered']) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_accordion($faqItems, [
    'id'      => 'pricing-faq',
    'variant' => 'bordered',
]) ?&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>

    <h3 class="ds-subsection-title">Accordion options</h3>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>id</code></td><td>string</td><td><code>'ws-accordion-' . uniqid()</code></td><td>Container ID. Auto-generated, but set it explicitly if you need to target the accordion from JS.</td></tr>
            <tr><td><code>variant</code></td><td>string</td><td><code>'default'</code></td><td><code>default</code> | <code>bordered</code> | <code>flush</code></td></tr>
            <tr><td><code>size</code></td><td>string</td><td><code>'md'</code></td><td><code>sm</code> | <code>md</code> | <code>lg</code> &mdash; drives trigger padding and title size</td></tr>
            <tr><td><code>multiple</code></td><td>bool</td><td><code>false</code></td><td>Allow several panels open at once. Emitted as <code>data-multiple</code> and read by the JS at init.</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
        </tbody>
    </table>

    <h3 class="ds-subsection-title">Item options</h3>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>title</code></td><td>string</td><td><code>''</code></td><td>Trigger text. Write it as the question the reader is actually asking.</td></tr>
            <tr><td><code>content</code></td><td>string</td><td><code>''</code></td><td>Panel body. Rendered as HTML, so wrap prose in <code>&lt;p&gt;</code>.</td></tr>
            <tr><td><code>open</code></td><td>bool</td><td><code>false</code></td><td>Initially expanded. In single-open mode, marking more than one leaves them all open until the first interaction.</td></tr>
            <tr><td><code>icon</code></td><td>string</td><td><code>null</code></td><td>Material icon name, rendered before the title</td></tr>
            <tr><td><code>disabled</code></td><td>bool</td><td><code>false</code></td><td>Prevents toggling</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <p class="ds-section-desc">Structurally this follows the <a href="https://www.w3.org/WAI/ARIA/apg/patterns/accordion/" target="_blank" rel="noopener">WAI-ARIA Accordion pattern</a>. The wiring below is what the component actually ships &mdash; see the gap note at the end.</p>

    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>ARIA</td><td>Triggers carry <code>aria-expanded</code> (kept in sync by <code>wsAccordionOpen</code>/<code>Close</code>) and <code>aria-controls</code> pointing at their panel. Panels are <code>role="region"</code> with <code>aria-labelledby</code> back to the trigger.</td></tr>
            <tr><td>Keyboard</td><td><kbd>Tab</kbd> moves between triggers; <kbd>Enter</kbd> and <kbd>Space</kbd> toggle the focused panel. Both come free from using real <code>&lt;button&gt;</code> elements &mdash; no JS key handling is involved.</td></tr>
            <tr><td>Focus</td><td>Focus stays on the trigger when a panel opens, so the next <kbd>Tab</kbd> enters the revealed content. Collapsed panels use <code>hidden</code>, which removes their contents from the tab order.</td></tr>
            <tr><td>Screen readers</td><td>Collapsed content stays in the DOM under <code>hidden</code> rather than being destroyed, so the accordion's structure is traversable and the expanded/collapsed state is announced.</td></tr>
            <tr><td>Reduced motion</td><td>No JS-driven animation; the panel show/hide is an attribute toggle. Nothing to suppress.</td></tr>
        </tbody>
    </table>

    <div class="ds-note">
        <span class="material-symbols-outlined">warning</span>
        <span><strong>Known gap:</strong> the APG pattern's optional roving arrow-key navigation (<kbd>↑</kbd>/<kbd>↓</kbd>/<kbd>Home</kbd>/<kbd>End</kbd> moving between triggers) is <em>not</em> implemented &mdash; <code>wsAccordionInit()</code> binds <code>click</code> only. This page previously documented those keys as working; they never were. Tab-based navigation is conformant, so this is an enhancement rather than a WCAG failure.</span>
    </div>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--gray-50</code></td><td>Trigger hover fill</td></tr>
            <tr><td><code>--gray-200</code></td><td>Item dividers and the bordered variant's outline</td></tr>
            <tr><td><code>--gray-400</code></td><td>Chevron in its resting state</td></tr>
            <tr><td><code>--brand</code></td><td>Leading icon accent</td></tr>
            <tr><td><code>--radius-xl</code></td><td>Bordered-variant card corners</td></tr>
            <tr><td><code>--text-default</code> / <code>--text-dark</code></td><td>Title and body text</td></tr>
            <tr><td><code>--text-body</code> / <code>--text-ui</code> / <code>--text-small</code> / <code>--text-meta</code></td><td>Type scale across the size modifiers</td></tr>
            <tr><td><code>--font-body</code> / <code>--font-semibold</code></td><td>Body face and trigger weight</td></tr>
            <tr><td><code>--transition-base</code> / <code>--transition-fast</code></td><td>Chevron rotation and hover fill</td></tr>
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
            <tr><td><code>.ws-accordion</code></td><td>Outer container. Auto-initialised on <code>DOMContentLoaded</code>.</td></tr>
            <tr><td><code>.ws-accordion--bordered</code></td><td>Card-per-panel variant</td></tr>
            <tr><td><code>.ws-accordion--flush</code></td><td>Borderless variant</td></tr>
            <tr><td><code>.ws-accordion--sm / --lg</code></td><td>Size modifiers (<code>md</code> is the default and emits nothing)</td></tr>
            <tr><td><code>.ws-accordion__item</code></td><td>Panel wrapper</td></tr>
            <tr><td><code>.ws-accordion__item.is-open</code></td><td>Expanded state &mdash; the hook JS toggles</td></tr>
            <tr><td><code>.ws-accordion__item.is-disabled</code></td><td>Disabled state</td></tr>
            <tr><td><code>.ws-accordion__trigger</code></td><td>The <code>&lt;button&gt;</code> header</td></tr>
            <tr><td><code>.ws-accordion__icon</code></td><td>Optional leading icon</td></tr>
            <tr><td><code>.ws-accordion__title</code></td><td>Heading text</td></tr>
            <tr><td><code>.ws-accordion__arrow</code></td><td>Expand/collapse chevron</td></tr>
            <tr><td><code>.ws-accordion__panel</code></td><td>Collapsible <code>role="region"</code> container</td></tr>
            <tr><td><code>.ws-accordion__content</code></td><td>Padding wrapper inside the panel</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_accordion()</code> helper function</td></tr>
            <tr><td><code>includes/components/accordion.php</code></td><td>Template &mdash; markup and ARIA wiring</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-accordion</code> rules)</td></tr>
            <tr><td><code>includes/components/components.js</code></td><td><code>wsAccordionInit()</code>, <code>wsAccordionOpen/Close/Toggle()</code> and the auto-init</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
