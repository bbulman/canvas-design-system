<?php
$ds_page  = 'components/demos/audio-player';
$ds_title = 'Audio Player';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';

/** A path shaped like a real upload. Nothing is fetched: preload is "none". */
$ds_note_src = '/uploads/voice_notes/example.webm';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<style>
/* Demo scaffolding only. The player is width-greedy, so the stages below cap it
   at the widths it actually gets in the Facilitator's note list.
   No token fallbacks: the design-system shell always loads platform-tokens.css,
   so a fallback would only mask a missing token. */
.ds-player-stage { max-width: 420px; }
.ds-player-stage--narrow { max-width: 260px; }
.ds-player-stack {
    display: flex;
    flex-direction: column;
    gap: var(--space-2);
    max-width: 420px;
}
.ds-player-fill-30 .ws-audio-player__fill { width: 38%; }
</style>

<div class="ds-page-header">
    <h1>Audio Player</h1>
    <p>Plays one voice note back inline: a round play button, a scrub bar, a duration, and an optional delete.</p>
</div>

<div class="ds-note" style="margin-bottom: 32px;">
    <span class="material-symbols-outlined">info</span>
    <span><strong>The helper renders markup only; the behaviour ships separately.</strong> <code>ws_audio_player()</code> emits a real <code>&lt;audio preload="none"&gt;</code> plus <code>data-player-action</code> hooks. Play, pause, scrub, the progress fill and the delete confirmation all live in <code>FacilitatorVoiceNotes</code> (<code>facilitator/js/modules/voice-notes.js</code>), which is <em>not</em> part of <code>components.js</code>. The examples on this page are therefore static: the buttons will not play anything here.</span>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            Playing back a saved voice note beside the thing it belongs to: an agenda item's note list, an exercise's notes, a session record. It is sized for a list row, so several stack cleanly.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The audio is long-form or is the page's main content. A podcast episode or a lesson recording wants a full transport with a seek time readout and speed control, not a 28px button. For capturing audio rather than playing it, see <a href="<?= $ds_base ?>/components/demos/audio-recorder.php">Audio Recorder</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>
    <p class="ds-section-desc">There is no <code class="ds-code-inline">variant</code> option. What changes between these is which of the four content options are present, and each one adds or removes a part.</p>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Source only</h3>
        <p class="ds-section-desc">The minimum call. With no <code class="ds-code-inline">duration</code> the time reads <code class="ds-code-inline">0:00</code> until playback starts and the JS begins writing remaining time into it.</p>
        <div class="ds-card ds-player-stage">
            <?= ws_audio_player($ds_note_src) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_audio_player('/uploads/voice_notes/file.webm') ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With a duration</h3>
        <p class="ds-section-desc">Pass seconds, get <code class="ds-code-inline">m:ss</code>. Always pass it: the stored value is known server-side, and without it the row shows a false <code class="ds-code-inline">0:00</code> for a note that is two minutes long.</p>
        <div class="ds-card ds-player-stack">
            <?= ws_audio_player($ds_note_src, ['duration' => 45]) ?>
            <?= ws_audio_player($ds_note_src, ['duration' => 138]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_audio_player($note['file_path'], ['duration' => $note['duration']]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With a label</h3>
        <p class="ds-section-desc">The label sits under the scrub bar in <code class="ds-code-inline">--text-micro</code> and truncates with an ellipsis rather than wrapping, so the row keeps its height whatever the note is called.</p>
        <div class="ds-card ds-player-stack">
            <?= ws_audio_player($ds_note_src, ['duration' => 45, 'label' => 'Energy dipped after lunch']) ?>
            <?= ws_audio_player($ds_note_src, ['duration' => 92, 'label' => 'Stakeholder pushback on the second option, worth replaying before the readout']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_audio_player($note['file_path'], [
    'duration' => $note['duration'],
    'label'    => $note['label'],
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Deletable</h3>
        <p class="ds-section-desc"><code class="ds-code-inline">deletable</code> adds the trailing close button; <code class="ds-code-inline">note_id</code> is what makes it work. The JS reads <code class="ds-code-inline">data-note-id</code> off the root and does nothing at all when it is missing, so the two options only make sense together.</p>
        <div class="ds-card ds-player-stage">
            <?= ws_audio_player($ds_note_src, [
                'duration'  => 45,
                'label'     => 'Energy dipped after lunch',
                'note_id'   => 128,
                'deletable' => true,
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_audio_player($note['file_path'], [
    'duration'  => $note['duration'],
    'label'     => $note['label'],
    'note_id'   => $note['id'],
    'deletable' => true,
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Narrow column</h3>
        <p class="ds-section-desc">The scrub bar takes the slack, so the control survives a sidebar width. The label truncates first, then the bar shortens.</p>
        <div class="ds-card ds-player-stage--narrow">
            <?= ws_audio_player($ds_note_src, ['duration' => 45, 'label' => 'Energy dipped after lunch', 'note_id' => 129, 'deletable' => true]) ?>
        </div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <p class="ds-section-desc">One class carries the only state: <code class="ds-code-inline">.ws-audio-player--playing</code>, which swaps the glyph. Everything else is the browser's. The second example below is the playing state, faked through the <code class="ds-code-inline">class</code> option plus a demo rule on the fill, since nothing here is actually playing.</p>

    <div class="ds-card ds-player-stack">
        <?= ws_audio_player($ds_note_src, ['duration' => 45, 'label' => 'Paused (default)']) ?>
        <?= ws_audio_player($ds_note_src, [
            'duration' => 45,
            'label'    => 'Playing',
            'class'    => 'ws-audio-player--playing ds-player-fill-30',
        ]) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_audio_player($src, ['class' => 'ws-audio-player--playing']) ?&gt;
&lt;!-- In production the JS adds and removes this class; do not ship it. --&gt;</pre></div>

    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Paused</td><td>Default. <code>play_arrow</code> shows, <code>pause</code> is hidden by the <code>:not(--playing)</code> rule as well as by its own <code>hidden</code> attribute.</td></tr>
            <tr><td>Playing</td><td><code>.ws-audio-player--playing</code> on the root swaps the glyphs. The JS pauses every other player on the page first, so two notes never talk over each other.</td></tr>
            <tr><td>Progress</td><td><code>.ws-audio-player__fill</code> is driven by inline <code>width</code> from <code>timeupdate</code>, with a 0.1s linear transition so it moves smoothly rather than ticking.</td></tr>
            <tr><td>Time readout</td><td>Shows the <em>total</em> duration at rest and counts <em>down</em> the remaining time while playing. It never shows elapsed time, which surprises people reading the code.</td></tr>
            <tr><td>Ended</td><td>The playing class is dropped and the fill resets to <code>0%</code>. The row returns to its resting look.</td></tr>
            <tr><td>Seek</td><td>Clicking anywhere on <code>.ws-audio-player__progress</code> jumps to that ratio of the duration. Pointer only, see Accessibility.</td></tr>
            <tr><td>Hover</td><td>The play button darkens; the delete button turns <code>--color-error</code>. The row itself has no hover treatment.</td></tr>
            <tr><td>Missing file</td><td>No handling. A 404 on the <code>src</code> leaves a control that looks live and does nothing when pressed.</td></tr>
            <tr><td>Disabled</td><td>Not supported. There is no option and no styling for it.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The Facilitator's voice note list. Notes saved earlier in the session come back from the API and render server-side; notes recorded during the session are appended client-side, which is why the same markup exists twice.</p>
    <div class="ds-card ds-player-stack">
        <?= ws_audio_player($ds_note_src, ['duration' => 32, 'label' => 'Opening round ran long', 'note_id' => 201, 'deletable' => true]) ?>
        <?= ws_audio_player($ds_note_src, ['duration' => 74, 'label' => 'Two people carried the whole discussion', 'note_id' => 202, 'deletable' => true]) ?>
        <?= ws_audio_player($ds_note_src, ['duration' => 118, 'label' => 'Park the pricing question for the readout', 'note_id' => 203, 'deletable' => true]) ?>
    </div>
    <div class="ds-code"><pre>&lt;?php foreach ($notes as $note): ?&gt;
    &lt;?= ws_audio_player($note['file_path'], [
        'duration'  => $note['duration'],
        'label'     => $note['label'],
        'note_id'   => $note['id'],
        'deletable' => true,
    ]) ?&gt;
&lt;?php endforeach; ?&gt;

&lt;script&gt;
// Bind after render, and again after appending any new player.
FacilitatorVoiceNotes.initPlayers(document.getElementById('voice-list'));
&lt;/script&gt;</pre></div>
    <div class="ds-note">
        <span class="material-symbols-outlined">warning</span>
        <span><strong>The JS builds this markup by hand as well.</strong> <code>voice-notes.js</code> constructs a <code>.ws-audio-player</code> string for notes recorded in-session rather than calling back to PHP. Any change to the template has to be mirrored there or the two copies drift, which is exactly the duplication a component is meant to prevent. Check both before editing either.</span>
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
            <tr><td><code>$src</code></td><td>string</td><td><code>''</code></td><td>Positional and required in practice. Written to both <code>data-src</code> on the root and the <code>&lt;audio src&gt;</code>.</td></tr>
            <tr><td><code>duration</code></td><td>int</td><td><code>0</code></td><td>Seconds. Cast with <code>(int)</code> and formatted as <code>m:ss</code>; <code>0</code> or absent renders <code>0:00</code>. The design system JSON lists this as a string, which is wrong: pass an integer.</td></tr>
            <tr><td><code>label</code></td><td>string</td><td><code>''</code></td><td>Caption under the scrub bar. Omitted entirely when empty, so the row shrinks rather than leaving a gap.</td></tr>
            <tr><td><code>note_id</code></td><td>int|string</td><td><code>''</code></td><td>Renders <code>data-note-id</code>, which the delete handler needs. Omitted when empty, so the attribute is absent rather than blank.</td></tr>
            <tr><td><code>deletable</code></td><td>bool</td><td><code>false</code></td><td>Adds the trailing delete button. Pair it with <code>note_id</code> or the button is inert.</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>'ws-player-' . uniqid()</code></td><td>Root element ID. Auto-generated; set it only if you need a stable handle.</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Extra classes on the root.</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra HTML attributes on the root. Every entry renders as <code>key="value"</code>; there is no boolean-attribute form.</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Play button</td><td>A real <code>&lt;button&gt;</code> with <code>aria-label="Play audio"</code>. <strong>Gap:</strong> the label is static, so it still says "Play audio" while the note is playing and the button actually pauses.</td></tr>
            <tr><td>Delete button</td><td>Uses <code>title</code> for its name rather than <code>aria-label</code>. Announced by most screen readers, but <code>title</code> is the weaker hook and it is invisible to touch users.</td></tr>
            <tr><td>Scrub bar</td><td><strong>Gap.</strong> <code>.ws-audio-player__progress</code> is a <code>&lt;div&gt;</code> with a click handler: no <code>tabindex</code>, no <code>role="slider"</code>, no arrow-key handling. Seeking is pointer-only. Play and pause are reachable, so the note is still listenable end to end.</td></tr>
            <tr><td>Time readout</td><td>Plain text with no live region, which is correct here: a per-second countdown announced aloud would be unusable.</td></tr>
            <tr><td>Colour</td><td>The progress fill is <code>--color-primary</code> on <code>--gray-100</code>, decorative rather than informational, and the same information is in the time readout.</td></tr>
            <tr><td>Loading</td><td><code>preload="none"</code>, so a list of twenty notes costs no bandwidth until one is played. Nothing signals the fetch, so a slow first press looks like nothing happened.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--color-primary</code></td><td>Play button fill and the progress fill</td></tr>
            <tr><td><code>--text-inverse</code></td><td>Glyph on the play button</td></tr>
            <tr><td><code>--gray-100</code> / <code>--gray-200</code></td><td>Progress track, row border</td></tr>
            <tr><td><code>--bg-surface</code></td><td>Row ground</td></tr>
            <tr><td><code>--text-secondary</code> / <code>--text-tertiary</code></td><td>Time readout, label, delete glyph</td></tr>
            <tr><td><code>--color-error</code></td><td>Delete glyph on hover</td></tr>
            <tr><td><code>--radius-md</code> / <code>--radius-sm</code></td><td>Row shape, delete hit area</td></tr>
            <tr><td><code>--space-2</code> / <code>--space-3</code></td><td>Row padding and the gaps between parts</td></tr>
            <tr><td><code>--font-body</code></td><td>Face for label and time</td></tr>
            <tr><td><code>--text-micro</code> / <code>--text-caption</code></td><td>Label, time, delete glyph, play glyph</td></tr>
            <tr><td><code>--icon-lg</code></td><td>Icons, at least 24px on every page (DESIGN.md §8)</td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">warning</span>
        <span><strong>One hover colour is not a real token.</strong> <code>.ws-audio-player__btn:hover</code> resolves <code>var(--color-primary-dark, #651FFF)</code>, and <code>--color-primary-dark</code> is not defined in <code>platform-tokens.css</code>. Outside Coach and the detail sidebar, which each define it locally, the play button hovers to a deep purple left over from before Red Unification. Worth fixing in <code>components.css</code>, which this page deliberately does not do.</span>
    </div>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-audio-player</code></td><td>Root row, carrying <code>data-src</code> and optionally <code>data-note-id</code></td></tr>
            <tr><td><code>.ws-audio-player--playing</code></td><td>Set by JS during playback; swaps play for pause</td></tr>
            <tr><td><code>.ws-audio-player__btn</code></td><td>The round play or pause button</td></tr>
            <tr><td><code>.ws-audio-player__icon--play</code> / <code>__icon--pause</code></td><td>The two glyphs, one hidden at a time</td></tr>
            <tr><td><code>.ws-audio-player__track</code></td><td>Column holding the scrub bar and the label</td></tr>
            <tr><td><code>.ws-audio-player__progress</code> / <code>__fill</code></td><td>Scrub bar and its inline-width fill</td></tr>
            <tr><td><code>.ws-audio-player__label</code></td><td>Caption, truncated with an ellipsis</td></tr>
            <tr><td><code>.ws-audio-player__time</code></td><td>Duration at rest, remaining time while playing</td></tr>
            <tr><td><code>.ws-audio-player__delete</code></td><td>Trailing delete, rendered only when <code>deletable</code></td></tr>
        </tbody>
    </table>
    <p class="ds-section-desc">The JS contract is <code class="ds-code-inline">data-player-action</code>, with values <code>toggle</code> and <code>delete</code>, plus the <code class="ds-code-inline">&lt;audio&gt;</code> element inside the root. Renaming any of those breaks playback.</p>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_audio_player()</code> helper function</td></tr>
            <tr><td><code>includes/components/audio-player.php</code></td><td>Template, including the <code>m:ss</code> formatting</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-audio-player</code> rules)</td></tr>
            <tr><td><code>facilitator/js/modules/voice-notes.js</code></td><td><code>FacilitatorVoiceNotes.initPlayers()</code> and the hand-built markup copy</td></tr>
            <tr><td><code>api/upload-voice-note.php</code></td><td>Serves the note list and handles delete</td></tr>
            <tr><td><code>design-system/components/php/AudioPlayer.php</code></td><td>Portable namespaced mirror of the helper</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
