<?php
$ds_page  = 'components/demos/cta-section';
$ds_title = 'CTA Section';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>CTA Section</h1>
    <p>Closes a marketing page with one conversion prompt: eyebrow, headline, subtitle, and up to two buttons.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            A marketing, landing, or solutions page ends and the reader should do something next. One per page, at the very bottom &mdash; it consolidates CTA markup that was previously hand-rolled on each page.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            You're opening a page &mdash; that's <a href="<?= $ds_base ?>/components/demos/hero.php">Hero</a>. For a prompt mid-content use <a href="<?= $ds_base ?>/components/demos/banner.php">Banner</a>, and inside app screens skip it entirely; product UI shouldn't carry marketing CTAs.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Full &mdash; eyebrow, subtitle, two buttons</h3>
        <p class="ds-section-desc">The complete form. Two buttons work when the second is a genuinely lower-commitment path, not a rewording of the first.</p>
        <div class="ds-card" style="padding: 0; overflow: hidden;">
            <?= ws_cta_section('Plan your workshop today', [
                'eyebrow' => 'Ready to start?',
                'subtitle' => 'Build your agenda in 3 minutes with the drag-and-drop planner.',
                'primaryBtn' => ['text' => 'Get Started', 'href' => '#'],
                'secondaryBtn' => ['text' => 'Browse the Library', 'href' => '#'],
                'color' => 'learn',
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_cta_section('Plan your workshop today', [
    'eyebrow'      => 'Ready to start?',
    'subtitle'     => 'Build your agenda in 3 minutes with the drag-and-drop planner.',
    'primaryBtn'   => ['text' => 'Get Started',        'href' => '/planner/'],
    'secondaryBtn' => ['text' => 'Browse the Library', 'href' => '/library/exercises/'],
    'color'        => 'learn',
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Minimal &mdash; title and one button</h3>
        <p class="ds-section-desc">Often stronger. When the page has already made the argument, the CTA only needs to name the action.</p>
        <div class="ds-card" style="padding: 0; overflow: hidden;">
            <?= ws_cta_section('Discover your Facilitator DNA', [
                'primaryBtn' => ['text' => 'Take the Quiz', 'href' => '#'],
                'color' => 'reflect',
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_cta_section('Discover your Facilitator DNA', [
    'primaryBtn' => ['text' => 'Take the Quiz', 'href' => '/dna/'],
    'color'      => 'reflect',
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Colour</h3>
        <p class="ds-section-desc">Five keys. Since Red Unification the four phase keys resolve to the same red, so the practical choice is <strong>phase versus neutral</strong> &mdash; neutral being the muted variant for pages that shouldn't shout.</p>
        <div class="ds-card" style="padding: 0; overflow: hidden;">
            <?= ws_cta_section('A quieter close', [
                'subtitle' => 'The neutral key, for pages where a full-colour panel would be too loud.',
                'primaryBtn' => ['text' => 'Continue', 'href' => '#'],
                'color' => 'neutral',
            ]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_cta_section('A quieter close', ['color' => 'neutral', /* … */]) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Default</td><td>Full-bleed panel with the content constrained to <code>--container-max</code>. Static &mdash; the section itself has no interactive state.</td></tr>
            <tr><td>Button states</td><td>Hover, focus, and disabled all belong to <a href="<?= $ds_base ?>/components/demos/button.php">Button</a>, which both slots render through.</td></tr>
            <tr><td>Omitted parts</td><td>Eyebrow, subtitle, and secondary button each render only when supplied. No empty space is reserved.</td></tr>
            <tr><td>No buttons</td><td>Renders headline-only. Almost certainly a mistake &mdash; a CTA section without a call to action is just a heading.</td></tr>
            <tr><td>Button defaults</td><td>Passing an empty array for a slot still renders a button, with the fallback text "Get Started" or "Learn More". Omit the key entirely to leave a slot out.</td></tr>
        </tbody>
    </table>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The end of a solutions page, with the CTA gated on auth state &mdash; a signed-in reader gets taken to the product, a visitor gets asked to sign up.</p>
    <div class="ds-card" style="padding: 0; overflow: hidden;">
        <?= ws_cta_section('Run a workshop people actually remember', [
            'eyebrow' => 'Start free',
            'subtitle' => 'The library, the planner, and the AI coach &mdash; no card required.',
            'primaryBtn' => ['text' => 'Create your first workshop', 'href' => '#', 'icon' => 'arrow_forward', 'iconPosition' => 'right'],
            'secondaryBtn' => ['text' => 'See how it works', 'href' => '#'],
        ]) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_cta_section('Run a workshop people actually remember', [
    'eyebrow'      => 'Start free',
    'subtitle'     => 'The library, the planner, and the AI coach — no card required.',
    'primaryBtn'   => $isLoggedIn
        ? ['text' => 'Open the Planner', 'href' => '/planner/']
        : ['text' => 'Create your first workshop', 'href' => '/signup',
           'icon' => 'arrow_forward', 'iconPosition' => 'right'],
    'secondaryBtn' => ['text' => 'See how it works', 'href' => '/about/'],
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
            <tr><td><code>$title</code></td><td>string</td><td><code>''</code></td><td>Positional headline. Make it the outcome, not the product.</td></tr>
            <tr><td><code>eyebrow</code></td><td>string</td><td><code>null</code></td><td>Small label above the title</td></tr>
            <tr><td><code>subtitle</code></td><td>string</td><td><code>null</code></td><td>One supporting sentence</td></tr>
            <tr><td><code>primaryBtn</code></td><td>array</td><td><code>null</code></td><td>Forwarded to <code>ws_button()</code>. Text defaults to "Get Started" if the array is present but has no <code>text</code>.</td></tr>
            <tr><td><code>secondaryBtn</code></td><td>array</td><td><code>null</code></td><td>Same, defaulting to "Learn More"</td></tr>
            <tr><td><code>color</code></td><td>string</td><td><code>'learn'</code></td><td><code>learn</code> | <code>plan</code> | <code>facilitate</code> | <code>reflect</code> | <code>neutral</code></td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes on the section</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra HTML attributes on the section element</td></tr>
        </tbody>
    </table>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Semantics</td><td>Renders a <code>&lt;section&gt;</code>. It has no accessible name of its own &mdash; add <code>attrs =&gt; ['aria-labelledby' =&gt; …]</code> if the page has several landmarks and this one needs distinguishing.</td></tr>
            <tr><td>Heading level</td><td>The title is styled display text rather than a heading element, so it doesn't join the page outline. Deliberate for a closing panel, but it means screen-reader users browsing by heading won't land here &mdash; the buttons are how they'll find it.</td></tr>
            <tr><td>Keyboard</td><td>Only the buttons are focusable, and they inherit Button's native behaviour. As the last thing on the page, they're the final tab stops.</td></tr>
            <tr><td>Link text</td><td>The buttons are usually links. Name the destination: "Create your first workshop" beats "Get Started", which is meaningless in a screen reader's link list.</td></tr>
            <tr><td>Eyebrow</td><td>Read before the title in document order, so the two should make sense together &mdash; "Ready to start? Plan your workshop today".</td></tr>
            <tr><td>Contrast</td><td>Each colour key pairs a tested background with <code>--color-ink</code> or its muted variants. Don't override one side alone.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--bg-page-warm</code> / <code>--phase-plan-light</code> / <code>--phase-facilitate-light</code> / <code>--phase-reflect-light</code></td><td>Panel background per colour key</td></tr>
            <tr><td><code>--brand</code> / <code>--phase-facilitate</code> / <code>--phase-reflect</code></td><td>Eyebrow colour per colour key (learn and plan read <code>--brand</code>)</td></tr>
            <tr><td><code>--bg-muted</code> / <code>--bg-page-warm</code></td><td>Neutral key background</td></tr>
            <tr><td><code>--color-border</code></td><td>Panel edge</td></tr>
            <tr><td><code>--color-ink</code> / <code>--color-ink-secondary</code> / <code>--color-ink-muted</code></td><td>Title, subtitle, and eyebrow text</td></tr>
            <tr><td><code>--container-max</code></td><td>Inner content width</td></tr>
            <tr><td><code>--text-h2</code> / <code>--text-ui</code> / <code>--text-meta</code></td><td>Title, subtitle, and eyebrow type scale</td></tr>
            <tr><td><code>--font-heading</code> / <code>--font-body</code> / <code>--font-bold</code></td><td>Fraunces title, Inter subtitle</td></tr>
            <tr><td><code>--space-2</code> through <code>--space-16</code></td><td>Internal rhythm and the panel's generous vertical padding</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-cta-section</code></td><td>Full-bleed section</td></tr>
            <tr><td><code>.ws-cta-section--learn / --plan / --facilitate / --reflect / --neutral</code></td><td>Colour keys</td></tr>
            <tr><td><code>.ws-cta-section__container</code></td><td>Max-width wrapper</td></tr>
            <tr><td><code>.ws-cta-section__content</code></td><td>Text column</td></tr>
            <tr><td><code>.ws-cta-section__eyebrow</code></td><td>Small label above the title</td></tr>
            <tr><td><code>.ws-cta-section__title</code></td><td>Display headline</td></tr>
            <tr><td><code>.ws-cta-section__subtitle</code></td><td>Supporting paragraph</td></tr>
            <tr><td><code>.ws-cta-section__actions</code></td><td>Button row</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_cta_section()</code> helper function</td></tr>
            <tr><td><code>includes/components/cta-section.php</code></td><td>Template &mdash; layout and the button calls</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-cta-section</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
