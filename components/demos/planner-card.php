<?php
$ds_page  = 'components/demos/planner-card';
$ds_title = 'Planner Card';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Planner Card</h1>
    <p>The agenda item, in both the shapes the Planner needs: a timeline card and a palette card.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            You're representing an activity inside the Planner &mdash; <code>lg</code> on the timeline canvas, <code>sm</code> in the library palette. One component keeps the card language identical on both sides of the drag.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The activity is being recommended rather than placed &mdash; that's <a href="<?= $ds_base ?>/components/demos/suggestion-card.php">Suggestion Card</a>. For a library listing outside the Planner use <a href="<?= $ds_base ?>/components/demos/listing-card.php">Listing Card</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Large &mdash; timeline</h3>
        <p class="ds-section-desc">The canvas card: eyebrow label, title, duration pill, optional drag handle and action icons. Type drives the eyebrow and the accent, and the duration pill inherits that accent &mdash; don't override it.</p>
        <div class="ds-card">
            <div class="ds-planner-stack">
                <?= ws_planner_card('Abstraction Laddering', ['type' => 'exercise',   'duration' => '60m', 'size' => 'lg', 'draggable' => true, 'actions' => ['swap', 'delete']]) ?>
                <?= ws_planner_card('Two truths and a lie',  ['type' => 'icebreaker', 'duration' => '10m', 'size' => 'lg', 'draggable' => true, 'actions' => ['swap', 'delete']]) ?>
                <?= ws_planner_card('Morning Coffee Break',  ['type' => 'break',      'duration' => '15m', 'size' => 'lg', 'draggable' => true, 'actions' => ['swap', 'delete']]) ?>
                <?= ws_planner_card('Custom Check-in',       ['type' => 'custom',     'duration' => '20m', 'size' => 'lg', 'draggable' => true, 'actions' => ['swap', 'delete']]) ?>
            </div>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_planner_card('Abstraction Laddering', [
    'type'      => 'exercise',
    'duration'  => '60m',
    'size'      => 'lg',
    'draggable' => true,
    'actions'   => ['swap', 'delete'],
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Small &mdash; palette</h3>
        <p class="ds-section-desc">The compact draggable source. Title and duration at rest, with a swap icon sliding in on hover or focus-within. Coarse-pointer devices show the icon permanently, since there's no hover to reveal it.</p>
        <div class="ds-card">
            <div class="ds-planner-grid">
                <?= ws_planner_card('Lightning Decision Jam', ['type' => 'exercise',   'duration' => '10m', 'size' => 'sm']) ?>
                <?= ws_planner_card('Never Have I Ever',      ['type' => 'icebreaker', 'duration' => '5m',  'size' => 'sm']) ?>
                <?= ws_planner_card('Lunch',                  ['type' => 'break',      'duration' => '45m', 'size' => 'sm']) ?>
                <?= ws_planner_card('Client Standup',         ['type' => 'custom',     'duration' => '15m', 'size' => 'sm']) ?>
            </div>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_planner_card('Lightning Decision Jam', [
    'type' => 'exercise', 'duration' => '10m', 'size' => 'sm',
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Small with a meta line</h3>
        <p class="ds-section-desc">The <code class="ds-code-inline">meta</code> option adds a secondary line to the small card &mdash; group size, format, anything that helps a facilitator choose from the palette. It isn't in the demo history but the template supports it.</p>
        <div class="ds-card">
            <div class="ds-planner-stack">
                <?= ws_planner_card('Assumption Mapping', ['type' => 'exercise', 'duration' => '30m', 'size' => 'sm', 'meta' => '6–12 ppl · remote-friendly']) ?>
            </div>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_planner_card('Assumption Mapping', [
    'type' => 'exercise', 'duration' => '30m', 'size' => 'sm',
    'meta' => '6–12 ppl · remote-friendly',
]) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <div class="ds-card">
        <div class="ds-planner-stack">
            <p class="ds-state-label">Default</p>
            <?= ws_planner_card('Abstraction Laddering', ['type' => 'exercise', 'duration' => '60m', 'draggable' => true, 'actions' => ['swap', 'delete']]) ?>

            <p class="ds-state-label">Selected</p>
            <?= ws_planner_card('Abstraction Laddering', ['type' => 'exercise', 'duration' => '60m', 'state' => 'selected', 'draggable' => true, 'actions' => ['swap', 'delete']]) ?>

            <p class="ds-state-label">Disabled</p>
            <?= ws_planner_card('Abstraction Laddering', ['type' => 'exercise', 'duration' => '60m', 'state' => 'disabled', 'draggable' => true, 'actions' => ['swap', 'delete']]) ?>
        </div>
    </div>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>Type accent on a neutral surface.</td></tr>
            <tr><td>Selected</td><td>Accent-coloured border emphasis, plus <code>aria-selected="true"</code>. Use it for the card currently open in the inspector.</td></tr>
            <tr><td>Disabled</td><td>Dimmed, with <code>aria-disabled="true"</code>. On small cards the hover swap affordance is suppressed &mdash; there's nothing to offer.</td></tr>
            <tr><td>Hover (sm)</td><td>The swap icon slides in. Also triggered by <code>:focus-within</code>, so keyboard users get the same affordance.</td></tr>
            <tr><td>Coarse pointer</td><td>The swap icon is always visible &mdash; hover-only affordances are unreachable on touch.</td></tr>
            <tr><td>Dragging</td><td>Handled by SortableJS in the Planner, not by this component. <code>draggable</code> only renders the handle.</td></tr>
        </tbody>
    </table>
    <div class="ds-code"><pre>&lt;?= ws_planner_card('Abstraction Laddering', [
    'type' => 'exercise', 'duration' => '60m',
    'state' => 'selected',    // default | selected | disabled
]) ?&gt;</pre></div>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">Rendering the agenda from <code class="ds-code-inline">plan_items</code>. The item's ID goes through <code class="ds-code-inline">attrs</code> as a data attribute, which is how the drag handler and the inspector identify what was moved or clicked.</p>
    <div class="ds-code"><pre>&lt;?php foreach ($planItems as $item): ?&gt;
    &lt;?= ws_planner_card($item['title'], [
        'type'      => $item['item_type'],
        'duration'  => (int) $item['duration'],       // ints format as "60m"
        'size'      => 'lg',
        'state'     => $item['id'] === $selectedId ? 'selected' : 'default',
        'draggable' => true,
        'actions'   => ['swap', 'delete'],
        'attrs'     => ['data-item-id' => $item['id']],
    ]) ?&gt;
&lt;?php endforeach; ?&gt;

&lt;script&gt;
// Actions are delegated — each carries data-action.
canvas.addEventListener('click', e =&gt; {
    const btn = e.target.closest('[data-action]');
    if (!btn) return;
    const id = btn.closest('.ws-planner-card').dataset.itemId;
    if (btn.dataset.action === 'delete') removeItem(id);
    if (btn.dataset.action === 'swap')   openSwapPicker(id);
});
&lt;/script&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>$title</code></td><td>string</td><td>required</td><td>Positional. The activity name.</td></tr>
            <tr><td><code>type</code></td><td>string</td><td><code>'exercise'</code></td><td><code>exercise</code> | <code>icebreaker</code> | <code>break</code> | <code>custom</code>. Drives eyebrow and accent; also emitted as <code>data-type</code>.</td></tr>
            <tr><td><code>duration</code></td><td>string|int</td><td><code>''</code></td><td>A label like <code>'60m'</code> or <code>'1h 30m'</code>. Integer minutes are formatted for you.</td></tr>
            <tr><td><code>size</code></td><td>string</td><td><code>'lg'</code></td><td><code>lg</code> (timeline) | <code>sm</code> (palette)</td></tr>
            <tr><td><code>state</code></td><td>string</td><td><code>'default'</code></td><td><code>default</code> | <code>selected</code> | <code>disabled</code></td></tr>
            <tr><td><code>draggable</code></td><td>bool</td><td><code>false</code></td><td>Render the drag handle. Large cards only.</td></tr>
            <tr><td><code>actions</code></td><td>array</td><td><code>[]</code></td><td><code>swap</code> | <code>delete</code> | <code>edit</code>. Large cards only &mdash; the palette deliberately surfaces only its hover swap.</td></tr>
            <tr><td><code>meta</code></td><td>string</td><td><code>null</code></td><td>Secondary line. Small cards only.</td></tr>
            <tr><td><code>href</code></td><td>string</td><td><code>null</code></td><td>Renders the card as an <code>&lt;a&gt;</code></td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>null</code></td><td>Element ID</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra HTML attributes &mdash; where <code>data-item-id</code> goes</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <p class="ds-section-desc">One of the more carefully wired components in the set &mdash; worth copying from.</p>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>ARIA</td><td>The card is <code>role="group"</code> with an <code>aria-label</code> composed from title, type, and duration, so it's announced as one coherent item rather than scattered text.</td></tr>
            <tr><td>State</td><td><code>aria-selected="true"</code> when selected and <code>aria-disabled="true"</code> when disabled &mdash; state is conveyed non-visually, not by styling alone.</td></tr>
            <tr><td>Action buttons</td><td>Each has an <code>aria-label</code>, and the action group is labelled "Card actions". The palette's swap is labelled "Swap".</td></tr>
            <tr><td>Decorative icons</td><td>The drag handle and type glyphs carry <code>aria-hidden="true"</code>, so they aren't read as stray text.</td></tr>
            <tr><td>Hover affordance</td><td>The small card reveals its swap icon on <code>:focus-within</code> as well as <code>:hover</code>, so keyboard users reach it. Coarse pointers get it permanently.</td></tr>
            <tr><td>Drag and drop</td><td><strong>Known gap:</strong> reordering is pointer-only. SortableJS provides no keyboard alternative here, so a keyboard user cannot move an agenda item. Provide move-up/move-down actions or a reorder dialog as an equivalent path.</td></tr>
            <tr><td>Colour independence</td><td>Type is carried by the eyebrow label as well as the accent, so it survives without colour.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <p class="ds-section-desc">The card resolves its type accent into a local <code class="ds-code-inline">--wpc-*</code> set, so internal rules reference one variable rather than branching per type.</p>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--wpc-accent</code> / <code>--wpc-accent-bg</code></td><td>Resolved type accent and its tint</td></tr>
            <tr><td><code>--wpc-surface</code> / <code>--wpc-border</code></td><td>Card surface and border</td></tr>
            <tr><td><code>--wpc-text</code> / <code>--wpc-text-muted</code></td><td>Title and secondary text</td></tr>
            <tr><td><code>--planner-exercise-bg</code> / <code>-color</code></td><td>Exercise accent source</td></tr>
            <tr><td><code>--planner-icebreaker-bg</code> / <code>-color</code></td><td>Icebreaker accent source</td></tr>
            <tr><td><code>--planner-break-bg</code> / <code>-color</code></td><td>Break accent source</td></tr>
            <tr><td><code>--planner-custom-bg</code> / <code>-color</code></td><td>Custom accent source</td></tr>
            <tr><td><code>--color-surface</code> / <code>--gray-100</code> / <code>--gray-200</code></td><td>Neutral surfaces and dividers</td></tr>
            <tr><td><code>--color-ink</code> / <code>--color-ink-muted</code> / <code>--text-inverse</code></td><td>Text colours</td></tr>
            <tr><td><code>--font-mono</code></td><td>Duration pill and eyebrow</td></tr>
            <tr><td><code>--text-nano</code> / <code>--text-micro</code> / <code>--text-caption</code> / <code>--text-small</code> / <code>--text-body</code></td><td>Type scale across both sizes</td></tr>
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
            <tr><td><code>.ws-planner-card</code></td><td>Base card, carrying <code>role="group"</code> and <code>data-type</code></td></tr>
            <tr><td><code>.ws-planner-card--lg / --sm</code></td><td>Size variants</td></tr>
            <tr><td><code>.ws-planner-card--exercise / --icebreaker / --break / --custom</code></td><td>Type accents</td></tr>
            <tr><td><code>.ws-planner-card--selected</code></td><td>Selected emphasis</td></tr>
            <tr><td><code>.ws-planner-card--disabled</code></td><td>Dimmed, non-interactive</td></tr>
            <tr><td><code>.ws-planner-card__header</code> / <code>__body</code> / <code>__footer</code></td><td>Layout regions</td></tr>
            <tr><td><code>.ws-planner-card__eyebrow</code></td><td>Type label above the title</td></tr>
            <tr><td><code>.ws-planner-card__title</code></td><td>Activity name</td></tr>
            <tr><td><code>.ws-planner-card__duration</code></td><td>Duration pill, inheriting the accent</td></tr>
            <tr><td><code>.ws-planner-card__meta</code></td><td>Secondary line (small cards)</td></tr>
            <tr><td><code>.ws-planner-card__handle</code></td><td>Drag handle</td></tr>
            <tr><td><code>.ws-planner-card__actions</code> / <code>__action</code></td><td>Action group and buttons, each with <code>data-action</code></td></tr>
            <tr><td><code>.ws-planner-card__action--hover</code></td><td>The palette's hover-revealed swap</td></tr>
            <tr><td><code>.ws-planner-card__row</code> / <code>__row-end</code></td><td>Internal row layout</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_planner_card()</code> helper function</td></tr>
            <tr><td><code>includes/components/planner-card.php</code></td><td>Template &mdash; accent resolution, ARIA composition, and both size layouts</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-planner-card</code> rules)</td></tr>
            <tr><td><code>css/planner/base/_variables.css</code></td><td>Source of the <code>--planner-*</code> activity colours</td></tr>
            <tr><td><code>css/planner/components/_cards.css</code></td><td>Planner-side card styling that sits alongside this component</td></tr>
        </tbody>
    </table>
</section>

<style>
.ds-planner-stack {
    display: flex;
    flex-direction: column;
    gap: 12px;
    max-width: 420px;
}
.ds-planner-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 12px;
}
.ds-state-label {
    font-size: var(--text-caption, 12px);
    font-weight: 600;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    color: var(--text-muted, #6B7280);
    margin: 4px 0 0;
}
</style>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
