<?php
$ds_page  = 'components/demos/suggestion-card';
$ds_title = 'Suggestion Card';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Suggestion Card</h1>
    <p>Proposes an activity for the agenda, with the reason it's being suggested and a one-click way to accept it.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            The system is recommending something the user can accept or ignore &mdash; Coach suggestions in the Planner, "you might also add" panels, gap-filling prompts. The <code>reason</code> is what separates a suggestion from a list item.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The user is browsing rather than being recommended to &mdash; the library palette uses <a href="<?= $ds_base ?>/components/demos/planner-card.php">Planner Card</a>. For an item already on the agenda, that's Planner Card too.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>
    <p class="ds-section-desc">Four type variants, colour-matched to the planner's activity coding so a suggestion reads the same as the card it will become. These colours are the sanctioned exception to Red Unification.</p>
    <div class="ds-card">
        <?= ws_suggestion_card([
            'id' => 1, 'name' => 'Crazy 8s', 'type' => 'exercise',
            'duration' => 30, 'category' => 'Ideation',
            'reason' => 'Great for generating ideas quickly in a structured timeframe',
        ]) ?>
        <?= ws_suggestion_card([
            'id' => 2, 'name' => 'Two Truths and a Lie', 'type' => 'icebreaker',
            'duration' => 10, 'category' => 'Team Building',
        ]) ?>
        <?= ws_suggestion_card([
            'id' => 3, 'name' => 'Coffee Break', 'type' => 'break', 'duration' => 15,
        ]) ?>
        <?= ws_suggestion_card([
            'id' => 4, 'name' => 'Custom Activity', 'type' => 'custom',
            'duration' => 20, 'reason' => 'Tailored to your workshop goals',
        ]) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_suggestion_card([
    'id'       => 1,
    'name'     => 'Crazy 8s',
    'type'     => 'exercise',
    'duration' => 30,
    'category' => 'Ideation',
    'reason'   => 'Great for generating ideas quickly',
]) ?&gt;</pre></div>
    <table class="ds-table">
        <thead><tr><th>Type</th><th>Accent</th></tr></thead>
        <tbody>
            <tr><td><code>exercise</code></td><td>Blue &mdash; <code>--planner-exercise-*</code></td></tr>
            <tr><td><code>icebreaker</code></td><td>Green &mdash; <code>--planner-icebreaker-*</code></td></tr>
            <tr><td><code>break</code></td><td>Grey &mdash; <code>--planner-break-*</code></td></tr>
            <tr><td><code>custom</code></td><td>Purple &mdash; <code>--planner-custom-*</code></td></tr>
        </tbody>
    </table>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>Card on <code>--surface-default</code> with a <code>--border-default</code> outline and the type's icon accent.</td></tr>
            <tr><td>Hover</td><td>Border moves to <code>--border-hover</code>. The card itself isn't clickable &mdash; the add button is the target.</td></tr>
            <tr><td>Focus</td><td>On the add button only; the card is not focusable.</td></tr>
            <tr><td>Without a reason</td><td>The reason line is omitted entirely and the card tightens up. Fine for obvious suggestions, but the reason is the component's whole point &mdash; supply one where you can.</td></tr>
            <tr><td>Without a category</td><td>The category is dropped from the meta row. Breaks typically have none.</td></tr>
            <tr><td>Accepted / dismissed</td><td>Neither state exists. The card doesn't know it's been added &mdash; remove it from the DOM yourself once the user acts, or it will sit there implying nothing happened.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The Coach panel in the Planner's inspector rail. Each card carries <code class="ds-code-inline">data-id</code> and <code class="ds-code-inline">data-type</code>, which is how the click handler knows what to add and to which endpoint.</p>
    <div class="ds-card" style="max-width: 420px;">
        <?= ws_suggestion_card([
            'id' => 87, 'name' => 'Assumption Mapping', 'type' => 'exercise',
            'duration' => 30, 'category' => 'Discovery',
            'reason' => 'Your agenda jumps from framing to solutions with nothing testing the premise',
        ]) ?>
    </div>
    <div class="ds-code"><pre>&lt;?php foreach ($coach-&gt;suggestions($planId) as $s): ?&gt;
    &lt;?= ws_suggestion_card([
        'id'       => $s['item_id'],
        'name'     => $s['name'],
        'type'     => $s['item_type'],
        'duration' => $s['duration'],
        'category' => $s['category_name'] ?? null,
        'reason'   => $s['rationale'],
    ]) ?&gt;
&lt;?php endforeach; ?&gt;

&lt;script&gt;
document.querySelectorAll('.ws-suggestion-card__add').forEach(btn =&gt; {
    btn.addEventListener('click', async () =&gt; {
        const card = btn.closest('.ws-suggestion-card');
        await addToAgenda(card.dataset.id, card.dataset.type);
        card.remove();               // the card has no "accepted" state
        wsToastSuccess('Added to agenda');
    });
});
&lt;/script&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <p class="ds-section-desc">Everything is passed in one array &mdash; <code class="ds-code-inline">ws_suggestion_card()</code> takes no positional arguments, and unlike most helpers the array is required.</p>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>id</code></td><td>int|string</td><td><code>''</code></td><td>The item's identifier. Emitted as <code>data-id</code> &mdash; your click handler needs it.</td></tr>
            <tr><td><code>name</code></td><td>string</td><td><code>''</code></td><td>Activity name</td></tr>
            <tr><td><code>type</code></td><td>string</td><td><code>'exercise'</code></td><td><code>exercise</code> | <code>icebreaker</code> | <code>break</code> | <code>custom</code>. Drives the accent and is emitted as <code>data-type</code>.</td></tr>
            <tr><td><code>duration</code></td><td>int</td><td><code>0</code></td><td>Minutes. Zero renders as "0 min" rather than being hidden &mdash; pass a real value.</td></tr>
            <tr><td><code>category</code></td><td>string</td><td><code>null</code></td><td>Category name in the meta row</td></tr>
            <tr><td><code>reason</code></td><td>string</td><td><code>null</code></td><td>Why this is being suggested. Write it about <em>their</em> agenda, not the activity in general.</td></tr>
            <tr><td><code>icon</code></td><td>string</td><td>by type</td><td>Overrides the type's default icon</td></tr>
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
            <tr><td>Semantics</td><td>A plain container with a button inside. No ARIA is applied, and the card itself isn't interactive &mdash; which is correct, since only the add action does anything.</td></tr>
            <tr><td>Add button</td><td><strong>Needs your attention.</strong> The button is icon-only and gets no <code>aria-label</code>, so it announces as an unnamed button. In a list of suggestions every one sounds identical. Add a label naming the activity: "Add Crazy 8s to agenda".</td></tr>
            <tr><td>Keyboard</td><td>The add button is a real button and reachable with <kbd>Tab</kbd>. Nothing else in the card is focusable.</td></tr>
            <tr><td>Focus after acceptance</td><td>Removing the card destroys the focused button and drops focus to <code>&lt;body&gt;</code>. Move focus to the next suggestion, or to the panel heading if none remain.</td></tr>
            <tr><td>Announcing the result</td><td>Adding an item changes the agenda elsewhere on the page. Confirm it &mdash; a <a href="<?= $ds_base ?>/components/demos/toast.php">Toast</a> or a live region &mdash; or the action is silent to non-visual users.</td></tr>
            <tr><td>Colour independence</td><td>Type is conveyed by accent colour and icon. The type word isn't always in the text, so include it in the add button's label if the distinction matters.</td></tr>
        </tbody>
    </table>
    <div class="ds-code"><pre>&lt;!-- Until the template takes a label, set it after render --&gt;
document.querySelectorAll('.ws-suggestion-card').forEach(card =&gt; {
    const name = card.querySelector('.ws-suggestion-card__name').textContent.trim();
    card.querySelector('.ws-suggestion-card__add')
        .setAttribute('aria-label', `Add ${name} to agenda`);
});</pre></div>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--planner-exercise-bg</code> / <code>-color</code></td><td>Exercise accent</td></tr>
            <tr><td><code>--planner-icebreaker-bg</code> / <code>-color</code></td><td>Icebreaker accent</td></tr>
            <tr><td><code>--planner-break-bg</code> / <code>-color</code></td><td>Break accent</td></tr>
            <tr><td><code>--planner-custom-bg</code> / <code>-color</code></td><td>Custom accent</td></tr>
            <tr><td><code>--surface-default</code></td><td>Card background</td></tr>
            <tr><td><code>--border-default</code> / <code>--border-hover</code></td><td>Card border, resting and hover</td></tr>
            <tr><td><code>--color-ink</code> / <code>--color-ink-secondary</code> / <code>--color-ink-muted</code></td><td>Name, meta, and reason text</td></tr>
            <tr><td><code>--brand</code> / <code>--brand-ink</code></td><td>Add button</td></tr>
            <tr><td><code>--gray-50</code> / <code>--gray-500</code></td><td>Fallback fill and text for an unrecognised type</td></tr>
            <tr><td><code>--radius-md</code></td><td>Card and icon corners</td></tr>
            <tr><td><code>--space-2</code> / <code>--space-3</code></td><td>Internal spacing</td></tr>
            <tr><td><code>--text-caption</code> / <code>--text-small</code></td><td>Meta, reason, and name type scale</td></tr>
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
            <tr><td><code>.ws-suggestion-card</code></td><td>Card container. Carries <code>data-id</code> and <code>data-type</code>.</td></tr>
            <tr><td><code>.ws-suggestion-card--exercise / --icebreaker / --break / --custom</code></td><td>Type accents</td></tr>
            <tr><td><code>.ws-suggestion-card__header</code></td><td>Icon and name row</td></tr>
            <tr><td><code>.ws-suggestion-card__icon</code></td><td>Type icon in its tinted holder</td></tr>
            <tr><td><code>.ws-suggestion-card__content</code></td><td>Text column</td></tr>
            <tr><td><code>.ws-suggestion-card__name</code></td><td>Activity name</td></tr>
            <tr><td><code>.ws-suggestion-card__meta</code></td><td>Duration and category row</td></tr>
            <tr><td><code>.ws-suggestion-card__reason</code></td><td>Rationale line</td></tr>
            <tr><td><code>.ws-suggestion-card__add</code></td><td>Add button &mdash; the hook your click handler binds to</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_suggestion_card()</code> helper function</td></tr>
            <tr><td><code>includes/components/suggestion-card.php</code></td><td>Template &mdash; type mapping and markup</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-suggestion-card</code> rules)</td></tr>
            <tr><td><code>css/planner/base/_variables.css</code></td><td>Source of the <code>--planner-*</code> activity colours</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
