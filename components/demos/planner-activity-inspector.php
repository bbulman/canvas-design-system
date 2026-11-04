<?php
$ds_page  = 'components/demos/planner-activity-inspector';
$ds_title = 'Planner Activity Inspector';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Planner Activity Inspector</h1>
    <p>The Planner's right column when an activity is selected: everything known about that one item, and what you can do to it.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            The user has selected a card on the timeline. It's the sibling of <a href="<?= $ds_base ?>/components/demos/planner-inspector-rail.php">Planner Inspector Rail</a> &mdash; same visual shell, different sections &mdash; and you swap between them on selection state.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            Nothing is selected &mdash; show the inspector rail instead. Never render both at once; the right column is one or the other.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Canonical &mdash; fully annotated activity</h3>
        <p class="ds-section-desc">Seven sections: identity, overview, energy impact, logistics, notes, when it runs, and actions. The left border carries the type accent so the rail ties visually to the selected card.</p>
        <div class="ds-card">
            <div class="ds-ai-stage">
                <div class="ds-ai-shell">
                    <?= ws_planner_activity_inspector([
                        'type'      => 'exercise',
                        'duration'  => '60 min',
                        'groupSize' => '6–12 ppl',
                        'title'     => 'Abstraction Laddering',
                        'tags'      => ['Strategy', 'Facilitation', 'Divergent'],
                        'overview'  => 'A structured way to move a group up (more abstract) and down (more concrete) to surface shared understanding around a problem.',
                        'instructions' => [
                            'Frame a specific problem at the center of the board.',
                            'Climb UP — ask "why does this matter?" three times, writing each level above the last.',
                            'Climb DOWN — ask "how might we…?" for each upward answer that resonated.',
                            'Vote on 2–3 "how might we" questions to take forward into the next session.',
                        ],
                        'energy'    => [
                            'net' => '+16',
                            'dimensions' => [
                                ['label' => 'Cognitive', 'delta' => '+8', 'fill' => 80],
                                ['label' => 'Social',    'delta' => '+5', 'fill' => 50],
                                ['label' => 'Physical',  'delta' => '+0', 'fill' =>  4],
                                ['label' => 'Emotional', 'delta' => '+3', 'fill' => 30],
                            ],
                        ],
                        'logistics' => ['60 min', '6–12 ppl', 'Standing', 'Stickies, markers'],
                        'notes'     => [
                            'body'   => 'Keep the ladder visible throughout. "Why" questions push up; "how" questions push down.',
                            'author' => 'Priya',
                            'date'   => 'Jan 14',
                            'canAdd' => true,
                        ],
                        'context'   => [
                            'time'        => '09:45 → 10:45',
                            'description' => 'right after Stakeholder mapping',
                        ],
                        'actions'   => [
                            ['label' => 'Swap',      'icon' => 'swap_horiz',   'action' => 'swap'],
                            ['label' => 'Duplicate', 'icon' => 'content_copy', 'action' => 'duplicate'],
                            ['label' => 'Adjust',    'icon' => 'schedule',     'action' => 'adjust'],
                        ],
                        'destructive' => ['label' => 'Remove from agenda', 'icon' => 'close', 'action' => 'remove'],
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="ds-note">
            <span class="material-symbols-outlined">info</span>
            <span>Supplying <code>instructions</code> turns the overview into a two-tab panel &mdash; Overview and Instructions. Without them, the overview renders as a plain block.</span>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Type accents</h3>
        <p class="ds-section-desc">One <code class="ds-code-inline">type</code> drives the whole card: left border, energy bars, net badge tint, logistics bullets, note rule, and button hover. Never hardcode these downstream.</p>
        <div class="ds-card">
            <div class="ds-ai-stage">
                <div class="ds-ai-shell" style="min-height: 520px;">
                    <?= ws_planner_activity_inspector([
                        'type'      => 'icebreaker',
                        'duration'  => '10 min',
                        'groupSize' => 'any group',
                        'title'     => 'Two truths and a lie',
                        'tags'      => ['Icebreaker', 'Energize'],
                        'overview'  => 'A low-stakes warmup where each person shares three statements — two true, one false — and the group guesses the lie.',
                        'energy'    => [
                            'net' => '+12',
                            'dimensions' => [
                                ['label' => 'Cognitive', 'delta' => '+3', 'fill' => 30],
                                ['label' => 'Social',    'delta' => '+8', 'fill' => 80],
                                ['label' => 'Physical',  'delta' => '+1', 'fill' => 10],
                                ['label' => 'Emotional', 'delta' => '+0', 'fill' =>  0],
                            ],
                        ],
                        'logistics' => ['10 min', 'any group', 'Seated', 'No materials'],
                        'context'   => ['time' => '09:00 → 09:10', 'description' => 'opens the workshop'],
                        'actions'   => [
                            ['label' => 'Swap',      'icon' => 'swap_horiz',   'action' => 'swap'],
                            ['label' => 'Duplicate', 'icon' => 'content_copy', 'action' => 'duplicate'],
                        ],
                        'destructive' => ['label' => 'Remove from agenda', 'icon' => 'close', 'action' => 'remove'],
                    ]) ?>
                </div>
                <div class="ds-ai-shell" style="min-height: 520px;">
                    <?= ws_planner_activity_inspector([
                        'type'      => 'break',
                        'duration'  => '10 min',
                        'groupSize' => '',
                        'title'     => 'Coffee break',
                        'tags'      => ['Break', 'Recovery'],
                        'overview'  => 'A short recovery break to let the group reset between deep-work blocks.',
                        'energy'    => [
                            'net' => '−2',
                            'dimensions' => [
                                ['label' => 'Cognitive', 'delta' => '−4', 'fill' => 40],
                                ['label' => 'Social',    'delta' => '+2', 'fill' => 20],
                                ['label' => 'Physical',  'delta' => '+4', 'fill' => 40],
                                ['label' => 'Emotional', 'delta' => '−4', 'fill' => 40],
                            ],
                        ],
                        'logistics' => ['10 min', 'Any space', 'Optional', 'Coffee, water'],
                        'context'   => ['time' => '10:45 → 10:55', 'description' => 'between sessions 2 and 3'],
                        'actions'   => [
                            ['label' => 'Extend',  'icon' => 'schedule', 'action' => 'extend'],
                            ['label' => 'Shorten', 'icon' => 'compress', 'action' => 'shorten'],
                        ],
                        'destructive' => ['label' => 'Remove from agenda', 'icon' => 'close', 'action' => 'remove'],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Minimal &mdash; identity and actions</h3>
        <p class="ds-section-desc">Every section is optional. This is what a custom activity or an un-annotated library item looks like.</p>
        <div class="ds-card">
            <div class="ds-ai-stage">
                <div class="ds-ai-shell" style="min-height: 260px;">
                    <?= ws_planner_activity_inspector([
                        'type'      => 'custom',
                        'duration'  => '15 min',
                        'groupSize' => 'any',
                        'title'     => 'Client check-in',
                        'tags'      => ['Custom'],
                        'actions'   => [
                            ['label' => 'Rename', 'icon' => 'edit'],
                            ['label' => 'Adjust', 'icon' => 'schedule'],
                        ],
                        'destructive' => ['label' => 'Remove from agenda', 'icon' => 'close'],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Section omitted</td><td>Passing <code>null</code> or leaving a key out removes that section entirely, dividers included. The last rendered section takes <code>--section--last</code>.</td></tr>
            <tr><td>Overview without instructions</td><td>Renders as a plain block, no tabs.</td></tr>
            <tr><td>Overview with instructions</td><td>Becomes a tab panel. <code>activeTab</code> chooses which is active on first paint; the tabs carry <code>data-tab</code> and <code>data-tab-group</code> for your switching code.</td></tr>
            <tr><td>Instructions as array vs string</td><td>An array renders a numbered list with mono step counters. A string is rendered as raw HTML &mdash; you own the markup, and the escaping.</td></tr>
            <tr><td>Empty body</td><td>With no optional sections at all the body takes <code>--body--empty</code>, tightening the layout rather than leaving a gap.</td></tr>
            <tr><td>Closable</td><td><code>closable</code> defaults to true, rendering the × in the eyebrow row with <code>data-action="close"</code>. Your code handles the click and swaps back to the inspector rail.</td></tr>
            <tr><td>Action fallback</td><td>An action without an explicit <code>action</code> key derives one from its label &mdash; "Remove from agenda" becomes <code>remove-from-agenda</code>. Set it explicitly if your handler expects a specific value.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The selection swap in the Planner's right column, with the energy figures coming from the scorer and notes from the facilitator's own record.</p>
    <div class="ds-code"><pre>&lt;?php if ($selected): ?&gt;
    &lt;?= ws_planner_activity_inspector([
        'type'         => $selected['item_type'],
        'duration'     => $selected['duration'] . ' min',
        'groupSize'    => $selected['group_size'],
        'title'        => $selected['title'],
        'tags'         => $selected['tags'],
        'overview'     => $selected['overview'],
        'instructions' => $selected['instructions'],       // array ⇒ numbered list
        'energy'       => $energyScorer-&gt;itemImpact($selected['id']),
        'logistics'    => [$selected['duration'] . ' min', $selected['group_size'],
                           $selected['posture'], $selected['materials']],
        'notes'        => $notes ? [
            'body' => $notes['content'], 'author' => $notes['author'],
            'date' => $notes['date'],    'canAdd' => true,
        ] : null,
        'context'      => ['time'        => $startTime . ' → ' . $endTime,
                           'description' => 'right after ' . $previous['title']],
        'actions'      => [
            ['label' => 'Swap',      'icon' => 'swap_horiz',   'action' => 'swap'],
            ['label' => 'Duplicate', 'icon' => 'content_copy', 'action' => 'duplicate'],
            ['label' => 'Adjust',    'icon' => 'schedule',     'action' => 'adjust'],
        ],
        'destructive'  => ['label' => 'Remove from agenda', 'icon' => 'close', 'action' => 'remove'],
    ]) ?&gt;
&lt;?php else: ?&gt;
    &lt;?= ws_planner_inspector_rail($railOptions) ?&gt;
&lt;?php endif; ?&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>title</code></td><td>string</td><td>Required. The activity name, in the display face.</td></tr>
            <tr><td><code>type</code></td><td>string</td><td><code>exercise</code> (default) | <code>icebreaker</code> | <code>break</code> | <code>custom</code>. Drives every accent in the panel.</td></tr>
            <tr><td><code>duration</code> / <code>groupSize</code></td><td>string</td><td>Composed into the eyebrow: <em>EXERCISE · 60 MIN · 6&ndash;12 PPL</em>. Omit either to drop it.</td></tr>
            <tr><td><code>tags</code></td><td>array</td><td>Short strings joined with <code>·</code> below the title</td></tr>
            <tr><td><code>closable</code></td><td>bool</td><td>Show the × control. Default <code>true</code>.</td></tr>
            <tr><td><code>overview</code></td><td>string</td><td>One or two sentences. Deeper description belongs on the library detail page.</td></tr>
            <tr><td><code>instructions</code></td><td>array|string|null</td><td>Array of steps, or an HTML string. Presence switches the overview to tabs.</td></tr>
            <tr><td><code>activeTab</code></td><td>string</td><td><code>overview</code> (default) | <code>instructions</code></td></tr>
            <tr><td><code>energy</code></td><td>array|null</td><td><code>['net', 'dimensions' =&gt; [['label', 'delta', 'fill' =&gt; 0..100]]]</code>. The net badge is the headline; dimensions are supporting detail.</td></tr>
            <tr><td><code>logistics</code></td><td>array</td><td>Strings in a two-column mono grid with accent-tinted bullets</td></tr>
            <tr><td><code>notes</code></td><td>array|null</td><td><code>['body', 'author', 'date', 'canAdd']</code>. Renders as a blockquote with an accent rule; <code>canAdd</code> surfaces the add affordance.</td></tr>
            <tr><td><code>context</code></td><td>array|null</td><td><code>['time', 'description']</code> &mdash; when the item runs, as a dashed mono pill</td></tr>
            <tr><td><code>actions</code></td><td>array</td><td><code>[['label', 'icon?', 'action?', 'href?']]</code>. Three at most at this width &mdash; mono labels wrap badly in narrow columns.</td></tr>
            <tr><td><code>destructive</code></td><td>array|null</td><td>One destructive action, full width below the primary row. Keep removal out of <code>actions</code> &mdash; the separate slot exists so it reads as different.</td></tr>
            <tr><td><code>id</code> / <code>class</code> / <code>attrs</code></td><td>string / string / array</td><td>Standard passthrough</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Tabs</td><td>The overview/instructions panel emits the full pattern: <code>role="tablist"</code>, <code>role="tab"</code> with <code>aria-selected</code> and <code>aria-controls</code>, and <code>role="tabpanel"</code> on each panel &mdash; better wired than the standalone <a href="<?= $ds_base ?>/components/demos/tabs.php">Tabs</a> component, which never emits panels.</td></tr>
            <tr><td>Tab keyboard</td><td><strong>Same gap as Tabs:</strong> the roles promise arrow-key navigation between tabs, but only <kbd>Tab</kbd> and <kbd>Enter</kbd>/<kbd>Space</kbd> work. Two tabs makes it less painful, but the promise is still unmet.</td></tr>
            <tr><td>Close control</td><td>Labelled <code>aria-label="Close inspector"</code> &mdash; it names the region, not just the glyph.</td></tr>
            <tr><td>Decorative icons</td><td>Bullets, dividers, and step counters carry <code>aria-hidden="true"</code>.</td></tr>
            <tr><td>Energy bars</td><td>The delta is text next to each label, so the number is announced; the bar is reinforcement. Good.</td></tr>
            <tr><td>Focus on selection</td><td><strong>Yours to handle.</strong> Swapping the rail replaces the DOM, so focus drops to <code>&lt;body&gt;</code>. Move focus to the inspector's title when it opens, and back to the timeline card when it closes.</td></tr>
            <tr><td>Destructive action</td><td>Marked by a red-tinted border and the word "Remove". Colour is reinforcement, not the signal &mdash; keep the verb in the label.</td></tr>
            <tr><td>Instructions as HTML</td><td>A string is rendered raw. Escape anything user-supplied before passing it.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <p class="ds-section-desc">Like its sibling rail, the inspector resolves the shared scales into a locally-scoped set on the root, then references those internally &mdash; which is why one <code class="ds-code-inline">type</code> can retint the entire panel.</p>
    <table class="ds-table">
        <thead><tr><th>Token group</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td>Type accent (<code>--planner-*</code>)</td><td>Left border stripe, energy bar fills, net badge tint, logistics bullets, note rule, and button hover</td></tr>
            <tr><td>Surface and edge</td><td>Panel background and section dividers &mdash; the planner "paper" surface</td></tr>
            <tr><td>Ink scale</td><td>Title, overview, labels, and meta text across four weights</td></tr>
            <tr><td>Display and mono faces</td><td>Fraunces title; mono for eyebrows, tags, logistics, and step counters</td></tr>
            <tr><td>Error colour</td><td>The destructive action's border and hover</td></tr>
        </tbody>
    </table>
    <p class="ds-section-desc">See the <code class="ds-code-inline">.ws-planner-activity-inspector</code> rules in <code class="ds-code-inline">components.css</code> for exact declarations, and <a href="<?= $ds_base ?>/resources/tokens.php">Token Reference</a> for values.</p>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-planner-activity-inspector</code></td><td>Root panel</td></tr>
            <tr><td><code>.ws-planner-activity-inspector--exercise / --icebreaker / --break / --custom</code></td><td>Type accents</td></tr>
            <tr><td><code>__eyebrow</code> / <code>__eyebrow-row</code></td><td>Type, duration, group size, and the close control</td></tr>
            <tr><td><code>__close</code></td><td>× control, <code>data-action="close"</code></td></tr>
            <tr><td><code>__title</code> / <code>__tags</code></td><td>Activity identity</td></tr>
            <tr><td><code>__tabs</code> / <code>__tab</code> / <code>__panel</code></td><td>Overview / Instructions tab set</td></tr>
            <tr><td><code>__steps</code> / <code>__step</code></td><td>Numbered instruction list</td></tr>
            <tr><td><code>__instructions-html</code></td><td>Wrapper when instructions are passed as a string</td></tr>
            <tr><td><code>__net</code></td><td>Net energy badge</td></tr>
            <tr><td><code>__dims</code> / <code>__dim</code> / <code>__dim-label</code> / <code>__dim-bar</code> / <code>__dim-fill</code> / <code>__dim-val</code></td><td>Per-dimension energy rows</td></tr>
            <tr><td><code>__logistics</code> / <code>__log-item</code></td><td>Two-column logistics grid</td></tr>
            <tr><td><code>__note</code> / <code>__note-attr</code> / <code>__add</code></td><td>Facilitator note, its attribution, and the add affordance</td></tr>
            <tr><td><code>__when</code></td><td>When-it-runs pill</td></tr>
            <tr><td><code>__actions</code> / <code>__btn</code> / <code>__btn-icon</code></td><td>Primary action row</td></tr>
            <tr><td><code>__destructive</code> / <code>__btn--danger</code></td><td>Destructive action</td></tr>
            <tr><td><code>__section</code> / <code>__section--last</code> / <code>__body</code> / <code>__body--empty</code> / <code>__label</code></td><td>Section scaffolding</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_planner_activity_inspector()</code> helper function</td></tr>
            <tr><td><code>includes/components/planner-activity-inspector.php</code></td><td>Template &mdash; sections, tab wiring, and accent resolution</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-planner-activity-inspector</code> rules)</td></tr>
            <tr><td><code>css/planner/components/_sidebar.css</code></td><td>Planner-side rail styling</td></tr>
        </tbody>
    </table>
</section>

<style>
.ds-ai-stage { display: flex; flex-wrap: wrap; gap: 24px; }
.ds-ai-shell {
    width: 340px;
    min-height: 680px;
    border: 1px solid var(--color-border, #E5E7EB);
    border-radius: var(--radius-xl, 12px);
    overflow: hidden;
    background: var(--bg-page-warm, #F7F2EA);
}
</style>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
