<?php
$ds_page  = 'components/demos/section-header';
$ds_title = 'Section Header';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Section Header</h1>
    <p>Introduces a section with a heading, an optional italic accent line, and a supporting paragraph.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            You're opening a section within a page &mdash; a feature block on a landing page, a listing's introduction, a settings group. It replaces the inline heading markup that had drifted apart across the site.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            It's the page's own top-level headline &mdash; that's <a href="<?= $ds_base ?>/components/demos/hero.php">Hero</a>, which owns the <code>&lt;h1&gt;</code>. This component renders <code>h2</code> or <code>h3</code>; on a page with no hero, where it opens the page, give it <code>h1</code> so the page still has exactly one.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Centred with a subtitle</h3>
        <p class="ds-section-desc">The signature form. Title and subtitle are one sentence split across two lines &mdash; the subtitle renders italic in the brand colour, so write them to read continuously.</p>
        <div class="ds-card">
            <?= ws_section_header('Everything you need to run', [
                'subtitle' => 'world-class workshops.',
                'description' => 'Ditch the clunky tools. Workshopr gives you a curated library of exercises, agendas, and an AI coach.',
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_section_header('Everything you need to run', [
    'subtitle'    => 'world-class workshops.',
    'description' => 'Ditch the clunky tools…',
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With a label</h3>
        <p class="ds-section-desc">A small uppercase label above the heading, naming the section's role. Keep it to one or two words.</p>
        <div class="ds-card">
            <?= ws_section_header('Democratizing the art of', [
                'subtitle' => 'facilitation.',
                'label' => 'Our Mission',
                'description' => 'We believe every team deserves a great facilitator.',
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_section_header('Democratizing the art of', [
    'subtitle' => 'facilitation.',
    'label'    => 'Our Mission',
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Left aligned</h3>
        <p class="ds-section-desc">Use left alignment inside app screens and listings, where centred text fights the surrounding left-aligned content. Centred belongs on marketing pages.</p>
        <div class="ds-card">
            <?= ws_section_header('Browse Workshops', [
                'description' => 'Find the perfect workshop for your next session.',
                'align' => 'left',
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_section_header('Browse Workshops', [
    'description' => 'Find the perfect workshop for your next session.',
    'align'       => 'left',
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Heading level</h3>
        <p class="ds-section-desc">Pick the tag by document structure, not by the size you want. A section nested inside another section takes <code class="ds-code-inline">h3</code>.</p>
        <div class="ds-card" style="display: flex; flex-direction: column; gap: 24px;">
            <?= ws_section_header('H2 Heading (default)', ['align' => 'left']) ?>
            <?= ws_section_header('H3 Heading', ['tag' => 'h3', 'align' => 'left']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_section_header('Nested section', ['tag' => 'h3', 'align' => 'left']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Title only</h3>
        <p class="ds-section-desc">Everything but the title is optional. When the section is self-explanatory, don't invent a description to fill the slot.</p>
        <div class="ds-card">
            <?= ws_section_header('Simple Section Title') ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_section_header('Simple Section Title') ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>The only state. Static text with no hover, focus, or interactive behaviour.</td></tr>
            <tr><td>Omitted parts</td><td>Label, subtitle, and description each render only when supplied &mdash; no empty elements or reserved space are left behind.</td></tr>
            <tr><td>Long titles</td><td>Wraps naturally with <code>--leading-snug</code> and <code>--tracking-tight</code> holding the display type readable. No truncation.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">Two calls on one page showing the alignment rule in practice: centred to open a marketing block, left-aligned to introduce a listing further down.</p>
    <div class="ds-card" style="display: flex; flex-direction: column; gap: 40px;">
        <?= ws_section_header('Built for facilitators who', [
            'subtitle' => 'actually run the room.',
            'label' => 'Why Workshopr',
            'description' => 'Every feature came from a session that went sideways.',
        ]) ?>
        <?= ws_section_header('Recent workshops', [
            'description' => 'Pick up where you left off.',
            'align' => 'left',
            'tag' => 'h3',
        ]) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_section_header('Built for facilitators who', [
    'subtitle'    => 'actually run the room.',
    'label'       => 'Why Workshopr',
    'description' => 'Every feature came from a session that went sideways.',
]) ?&gt;

&lt;?= ws_section_header('Recent workshops', [
    'description' => 'Pick up where you left off.',
    'align'       => 'left',
    'tag'         => 'h3',
]) ?&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>$title</code></td><td>string</td><td>required</td><td>Positional heading text. With a subtitle, this is the first half of the sentence.</td></tr>
            <tr><td><code>subtitle</code></td><td>string</td><td><code>null</code></td><td>Second line, italic and brand-coloured. Reads as a continuation of the title.</td></tr>
            <tr><td><code>description</code></td><td>string</td><td><code>null</code></td><td>Supporting paragraph below the heading</td></tr>
            <tr><td><code>label</code></td><td>string</td><td><code>null</code></td><td>Small uppercase label above the heading</td></tr>
            <tr><td><code>tag</code></td><td>string</td><td><code>'h2'</code></td><td><code>h1</code> | <code>h2</code> | <code>h3</code>. Choose by outline position; <code>h1</code> only when no hero owns it.</td></tr>
            <tr><td><code>align</code></td><td>string</td><td><code>'center'</code></td><td><code>center</code> | <code>left</code>. Only <code>left</code> emits a modifier class.</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>null</code></td><td>Element ID &mdash; useful as an in-page anchor target</td></tr>
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
            <tr><td>Semantics</td><td>Renders a real <code>&lt;h2&gt;</code> or <code>&lt;h3&gt;</code>, so the section joins the document outline and screen-reader users can jump to it by heading.</td></tr>
            <tr><td>Heading order</td><td><strong>Yours to get right.</strong> The component honours whatever <code>tag</code> you pass, including one that skips a level. Never pick the tag for its size &mdash; use <code>class</code> if you need to adjust appearance.</td></tr>
            <tr><td>Subtitle</td><td>Rendered inside the heading element, so the announced heading is title plus subtitle as one phrase. Write them to make sense read together.</td></tr>
            <tr><td>Label</td><td>Sits outside the heading, so it isn't part of the accessible heading text. Don't put essential context there.</td></tr>
            <tr><td>Keyboard</td><td>Nothing focusable. With an <code>id</code> set, it works as a skip-link or anchor target.</td></tr>
            <tr><td>Contrast</td><td>Title uses <code>--text-dark</code>, description <code>--text-muted</code>, and subtitle <code>--brand</code> &mdash; all tested against the page surface.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--text-dark</code></td><td>Title colour</td></tr>
            <tr><td><code>--brand</code></td><td>Subtitle and label accent</td></tr>
            <tr><td><code>--text-muted</code></td><td>Description colour</td></tr>
            <tr><td><code>--text-h2</code></td><td>Heading display size</td></tr>
            <tr><td><code>--text-small</code> / <code>--text-caption</code></td><td>Description and label sizes</td></tr>
            <tr><td><code>--font-heading</code></td><td>Fraunces on title and subtitle</td></tr>
            <tr><td><code>--font-body</code> / <code>--font-semibold</code> / <code>--font-bold</code></td><td>Inter on the description, and heading weights</td></tr>
            <tr><td><code>--tracking-tight</code></td><td>Letter-spacing on the display heading</td></tr>
            <tr><td><code>--leading-snug</code> / <code>--leading-relaxed</code></td><td>Heading and description line height</td></tr>
            <tr><td><code>--space-2</code> / <code>--space-3</code> / <code>--space-10</code></td><td>Label-to-title gap, title-to-description gap, and the block's bottom margin</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-section-header</code></td><td>Container, centred by default</td></tr>
            <tr><td><code>.ws-section-header--left</code></td><td>Left alignment</td></tr>
            <tr><td><code>.ws-section-header__label</code></td><td>Small uppercase label</td></tr>
            <tr><td><code>.ws-section-header__title</code></td><td>The heading element</td></tr>
            <tr><td><code>.ws-section-header__subtitle</code></td><td>Italic brand-coloured accent inside the heading</td></tr>
            <tr><td><code>.ws-section-header__desc</code></td><td>Description paragraph</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_section_header()</code> helper function</td></tr>
            <tr><td><code>includes/components/section-header.php</code></td><td>Template &mdash; tag selection and conditional parts</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-section-header</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
