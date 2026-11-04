<?php
$ds_page  = 'components/demos/audio-recorder';
$ds_title = 'Audio Recorder';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<style>
/* Demo scaffolding only. The component ships all four states in the DOM and
   hides three of them with the `hidden` attribute; JS swaps which one shows.
   These rules force one state visible per stage so every state can be seen at
   once on this page. Nothing here belongs in production markup.
   No token fallbacks: the design-system shell always loads platform-tokens.css,
   so a fallback would only mask a missing token. */
.ds-rec-stage[data-show] .ws-audio-recorder__state { display: none; }
.ds-rec-stage[data-show="idle"]      .ws-audio-recorder__state--idle,
.ds-rec-stage[data-show="recording"] .ws-audio-recorder__state--recording,
.ds-rec-stage[data-show="done"]      .ws-audio-recorder__state--done,
.ds-rec-stage[data-show="uploading"] .ws-audio-recorder__state--uploading { display: flex; }

.ds-rec-row {
    display: flex;
    flex-direction: column;
    gap: var(--space-2);
    margin-bottom: var(--space-5);
}
.ds-rec-row:last-child { margin-bottom: 0; }
.ds-rec-row__name {
    font-size: var(--text-micro);
    font-weight: var(--font-semibold);
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--text-tertiary);
}
.ds-rec-stage {
    max-width: 380px;
    padding: var(--space-3);
    border: 1px dashed var(--gray-200);
    border-radius: var(--radius-md);
}
</style>

<div class="ds-page-header">
    <h1>Audio Recorder</h1>
    <p>Captures a voice note in the browser with the MediaRecorder API, previews it, then uploads it against a workshop entity.</p>
</div>

<div class="ds-note" style="margin-bottom: 32px;">
    <span class="material-symbols-outlined">info</span>
    <span><strong>The helper renders markup only; the behaviour ships separately.</strong> <code>ws_audio_recorder()</code> emits all four states with <code>data-recorder-action</code> hooks and stops there. Microphone access, the timer, the preview and the upload all live in <code>FacilitatorVoiceNotes</code> (<code>facilitator/js/modules/voice-notes.js</code>), which is <em>not</em> part of <code>components.js</code>. Drop the component onto a page without loading that module and you get four buttons that do nothing. The examples below are static markup for the same reason.</span>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            A facilitator needs to capture something mid-session faster than they can type it, and the note belongs to a specific thing: an exercise, an icebreaker, an agenda item, or a session. The four <code>entity_type</code> values are enforced by the API, so the recorder is only correct where one of them applies.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The note is typed. That is a plain textarea saved through <code>coach.php?action=add_note</code>. Also not for playback: once a note exists, render it with <a href="<?= $ds_base ?>/components/demos/audio-player.php">Audio Player</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>
    <p class="ds-section-desc">There is one variant. The component's whole surface is the four-state machine below, and the only thing a caller changes is which entity the recording gets attached to.</p>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Bound to an agenda item</h3>
        <p class="ds-section-desc">The form the Facilitator ships. <code class="ds-code-inline">entity_type</code> and <code class="ds-code-inline">entity_id</code> land on the root element as <code class="ds-code-inline">data-entity-type</code> and <code class="ds-code-inline">data-entity-id</code>, which is where the upload reads them from at save time, not from PHP.</p>
        <div class="ds-card">
            <?= ws_audio_recorder(['id' => 'ds-rec-item', 'entity_type' => 'plan_item', 'entity_id' => '0']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_audio_recorder([
    'id'          => 'fac-voice-recorder',
    'entity_type' => 'plan_item',
    'entity_id'   => $currentItemId,
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Bound to an exercise</h3>
        <p class="ds-section-desc">Same markup, different owner. Nothing about the control changes; the entity pair decides which record the file is filed against and which notes a later <code class="ds-code-inline">GET /api/upload-voice-note.php?entity_type=&amp;entity_id=</code> returns.</p>
        <div class="ds-card">
            <?= ws_audio_recorder(['id' => 'ds-rec-exercise', 'entity_type' => 'exercise', 'entity_id' => '42']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_audio_recorder([
    'entity_type' => 'exercise',
    'entity_id'   => $exercise['id'],
]) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <p class="ds-section-desc">All four are rendered into the page at once, three carrying the native <code class="ds-code-inline">hidden</code> attribute. The JS swaps <code class="ds-code-inline">hidden</code> between them; it never rebuilds the markup. Each stage below is one real component with the demo forcing a different state visible.</p>

    <div class="ds-card">
        <div class="ds-rec-row">
            <span class="ds-rec-row__name">Idle</span>
            <div class="ds-rec-stage" data-show="idle">
                <?= ws_audio_recorder(['id' => 'ds-rec-idle', 'entity_type' => 'session', 'entity_id' => '1']) ?>
            </div>
        </div>
        <div class="ds-rec-row">
            <span class="ds-rec-row__name">Recording</span>
            <div class="ds-rec-stage" data-show="recording">
                <?= ws_audio_recorder(['id' => 'ds-rec-recording', 'entity_type' => 'session', 'entity_id' => '1']) ?>
            </div>
        </div>
        <div class="ds-rec-row">
            <span class="ds-rec-row__name">Done (preview before upload)</span>
            <div class="ds-rec-stage" data-show="done">
                <?= ws_audio_recorder(['id' => 'ds-rec-done', 'entity_type' => 'session', 'entity_id' => '1']) ?>
            </div>
        </div>
        <div class="ds-rec-row">
            <span class="ds-rec-row__name">Uploading</span>
            <div class="ds-rec-stage" data-show="uploading">
                <?= ws_audio_recorder(['id' => 'ds-rec-uploading', 'entity_type' => 'session', 'entity_id' => '1']) ?>
            </div>
        </div>
    </div>

    <table class="ds-table">
        <thead><tr><th>State</th><th>Contains</th><th>Leaves via</th></tr></thead>
        <tbody>
            <tr><td><code>idle</code></td><td>One "Record Voice Note" button with a red <code>mic</code> glyph.</td><td><code>data-recorder-action="start"</code>, which requests the microphone. A denial or a missing device keeps the state at idle and raises a browser <code>alert()</code>.</td></tr>
            <tr><td><code>recording</code></td><td>A pulsing red dot, a tabular-numeral timer, and a solid red Stop button.</td><td><code>data-recorder-action="stop"</code>. Duration is captured at stop, not at save, so a slow upload cannot inflate it.</td></tr>
            <tr><td><code>done</code></td><td>A circular preview play button, the recorded duration, then discard and Save pushed right by <code>margin-left: auto</code>.</td><td><code>discard</code> returns to idle and drops the blob; <code>save</code> goes to uploading. <code>preview</code> plays the blob in place and swaps its own glyph between <code>play_arrow</code> and <code>pause</code>.</td></tr>
            <tr><td><code>uploading</code></td><td>A spinner and "Saving...". No cancel.</td><td>Success or failure in <code>/api/upload-voice-note.php</code>. There is no error state in the markup, so a failed upload surfaces as an <code>alert()</code> and a return to an earlier state.</td></tr>
            <tr><td>Hover</td><td colspan="2">Buttons lift their border to <code>--gray-300</code> over a <code>--gray-50</code> ground. Stop and Save darken instead, since they are already filled.</td></tr>
            <tr><td>Disabled</td><td colspan="2">Not supported. There is no <code>disabled</code> option and no disabled styling. If a surface must block recording, hide or unmount the component.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The Facilitator's note card, in <code class="ds-code-inline">app/views/facilitate/run.php</code>. The recorder is rendered once with <code class="ds-code-inline">entity_id</code> at <code class="ds-code-inline">'0'</code> and then repointed as the agenda advances, because the current item is not known at render time.</p>
    <div class="ds-code"><pre>&lt;div class="note-card__voice-section" id="voice-section" hidden&gt;
    &lt;div class="note-card__voice-divider"&gt;or record a voice note&lt;/div&gt;
    &lt;?= ws_audio_recorder([
        'id'          => 'fac-voice-recorder',
        'entity_type' => 'plan_item',
        'entity_id'   => '0',
    ]) ?&gt;
    &lt;div class="note-card__voice-list" id="voice-list"&gt;&lt;/div&gt;
&lt;/div&gt;

&lt;script src="/facilitator/js/modules/voice-notes.js?v=2"&gt;&lt;/script&gt;
&lt;script&gt;
FacilitatorVoiceNotes.initRecorder(
    document.getElementById('fac-voice-recorder'), 'plan_item', currentItemId);

// When the agenda moves on, repoint the same recorder rather than re-rendering.
FacilitatorVoiceNotes.setEntity('plan_item', nextItemId);
&lt;/script&gt;</pre></div>
    <div class="ds-note">
        <span class="material-symbols-outlined">warning</span>
        <span><strong>An empty <code>entity_id</code> fails silently at save.</strong> Omit the option and the template writes <code>data-entity-id=""</code>; the upload then refuses with a console message and no visible feedback, because the missing-entity branch never reaches the UI. Either pass a real ID or call <code>setEntity()</code> before the user can reach Save.</span>
    </div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <p class="ds-section-desc">Five, all of them plumbing. The component has no visual options at all: no size, no variant, no label override.</p>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>id</code></td><td>string</td><td><code>'ws-recorder-' . uniqid()</code></td><td>Root element ID. Auto-generated, but pass a stable one: the JS needs a handle to call <code>initRecorder()</code> with.</td></tr>
            <tr><td><code>entity_type</code></td><td>string</td><td><code>''</code></td><td>Rendered as <code>data-entity-type</code>. The API accepts exactly <code>exercise</code>, <code>icebreaker</code>, <code>plan_item</code>, <code>session</code> and rejects anything else with a 400.</td></tr>
            <tr><td><code>entity_id</code></td><td>string|int</td><td><code>''</code></td><td>Rendered as <code>data-entity-id</code>. See the warning above about the empty default.</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Extra classes on the root, appended after <code>.ws-audio-recorder</code>.</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra HTML attributes on the root. Values are escaped; boolean-style attributes are not supported here, every entry renders as <code>key="value"</code>.</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Controls</td><td>Real <code>&lt;button type="button"&gt;</code> throughout, so keyboard and AT behaviour comes free. Record, Stop and Save carry visible text; the icon-only preview and discard buttons carry <code>aria-label</code>.</td></tr>
            <tr><td>State changes are not announced</td><td><strong>Gap.</strong> The state swap uses the <code>hidden</code> attribute with no live region, so a screen reader user gets no signal that recording started, that it stopped, or that the upload finished. If you place this on a new surface, add an <code>aria-live="polite"</code> status near it.</td></tr>
            <tr><td>The timer is silent</td><td>Elapsed time is visual only. A blind user cannot tell how long they have been recording.</td></tr>
            <tr><td>Errors go through <code>alert()</code></td><td>Microphone denial, a missing device and an upload failure all raise a native alert rather than an inline message. It is announced, but it is not the platform's <code>ws_alert</code> pattern and there is no persistent record once dismissed.</td></tr>
            <tr><td>Motion</td><td><strong>Gap.</strong> The recording pulse and the upload spinner run continuously with no <code>prefers-reduced-motion</code> guard, unlike the sidenav and modal rules in the same stylesheet.</td></tr>
            <tr><td>Colour</td><td>Recording state is red plus a moving dot plus a running timer, so it does not depend on hue alone. Save uses <code>--color-success-darker</code> rather than the base green because white on the base step measures 2.28:1.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--color-error</code> / <code>--color-error-dark</code></td><td>Mic glyph, pulse, timer, Stop fill and its hover</td></tr>
            <tr><td><code>--color-success-darker</code> / <code>--color-success-dark</code></td><td>Save fill and its hover</td></tr>
            <tr><td><code>--color-primary</code></td><td>The spinner's leading arc</td></tr>
            <tr><td><code>--text-inverse</code></td><td>Label and glyph on the filled Stop and Save buttons</td></tr>
            <tr><td><code>--gray-50</code> / <code>--gray-200</code> / <code>--gray-300</code></td><td>Button hover ground, resting border, hover border, spinner track</td></tr>
            <tr><td><code>--bg-surface</code></td><td>Button ground</td></tr>
            <tr><td><code>--text-secondary</code> / <code>--text-tertiary</code></td><td>Button label, preview duration, discard glyph</td></tr>
            <tr><td><code>--radius-md</code></td><td>Button shape</td></tr>
            <tr><td><code>--space-1</code> / <code>--space-1-5</code> / <code>--space-2</code> / <code>--space-3</code></td><td>Button padding and the gaps between states' parts</td></tr>
            <tr><td><code>--font-body</code> / <code>--font-semibold</code></td><td>Face and label weight</td></tr>
            <tr><td><code>--text-caption</code></td><td>Label and timer scale, icon size</td></tr>
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
            <tr><td><code>.ws-audio-recorder</code></td><td>Root, carrying the entity data attributes</td></tr>
            <tr><td><code>.ws-audio-recorder__state</code></td><td>One state block; three of the four carry <code>hidden</code></td></tr>
            <tr><td><code>.ws-audio-recorder__state--idle</code> / <code>--recording</code> / <code>--done</code> / <code>--uploading</code></td><td>The four states</td></tr>
            <tr><td><code>.ws-audio-recorder__btn</code></td><td>Base button, with <code>--record</code>, <code>--stop</code>, <code>--play-preview</code>, <code>--discard</code> and <code>--save</code> modifiers</td></tr>
            <tr><td><code>.ws-audio-recorder__indicator</code> / <code>__pulse</code> / <code>__timer</code></td><td>Recording readout</td></tr>
            <tr><td><code>.ws-audio-recorder__preview</code> / <code>__duration</code> / <code>__actions</code></td><td>Done-state layout</td></tr>
            <tr><td><code>.ws-audio-recorder__spinner</code></td><td>Upload indicator</td></tr>
            <tr><td><code>.ws-audio-recorder__label</code></td><td>Button text, held on one line</td></tr>
        </tbody>
    </table>
    <p class="ds-section-desc">Two JS contracts sit alongside the classes: <code class="ds-code-inline">data-state</code> on each state block and <code class="ds-code-inline">data-recorder-action</code> on each button (<code>start</code>, <code>stop</code>, <code>preview</code>, <code>discard</code>, <code>save</code>). Renaming either breaks the module.</p>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_audio_recorder()</code> helper function</td></tr>
            <tr><td><code>includes/components/audio-recorder.php</code></td><td>Template, all four states</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-audio-recorder</code> rules)</td></tr>
            <tr><td><code>facilitator/js/modules/voice-notes.js</code></td><td><code>FacilitatorVoiceNotes</code>, the behaviour. Not bundled into <code>components.js</code>.</td></tr>
            <tr><td><code>api/upload-voice-note.php</code></td><td>Upload, list and delete. Validates <code>entity_type</code>.</td></tr>
            <tr><td><code>design-system/components/php/AudioRecorder.php</code></td><td>Portable namespaced mirror of the helper</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
