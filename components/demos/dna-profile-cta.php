<?php
$ds_page  = 'components/demos/dna-profile-cta';
$ds_title = 'DNA Profile CTA';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';
require_once __DIR__ . '/../../../includes/components/dna-profile-cta.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>DNA Profile CTA</h1>
    <p>The facilitator DNA card in the app right rail: the archetype's medallion overlapping a tinted pill, or &mdash; before the quiz &mdash; the pill alone with the DNA glyph. From the app wireframes' badge frames.</p>
</div>

<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            A surface wants a way into the facilitator's DNA profile &mdash; the app rail is the reference consumer (<code>app/includes/rail.php</code>). Pass the archetype when the account has one; call it bare otherwise and it renders the quiz invitation.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            You need the profile itself or the quiz &mdash; this is the doorway, not the room. It also isn't a generic promo card: the medallion artwork is the point, so anything without an archetype behind it wants <code>ws_feature_card</code> instead.
        </div>
    </div>
</section>

<section class="ds-section">
    <h2 class="ds-section-title">The two states</h2>
    <p class="ds-section-desc">Earned: the medallion's ribbon carries the archetype's name, so the words on the card stay constant and the aria-label and the image's alt carry the name in text. Start: the same pill standing alone, DISCOVER doing the asking. Both open in a new tab &mdash; the rail sits beside a workshop in progress, and the DNA pages are a detour off it.</p>

    <div class="ds-demo" style="display: grid; gap: 24px; max-width: 320px;">
        <?= ws_dna_profile_cta(['archetype' => 'architect', 'name' => 'The Architect']) ?>
        <?= ws_dna_profile_cta(['archetype' => 'connector', 'name' => 'The Connector']) ?>
        <?= ws_dna_profile_cta() ?>
    </div>

    <div class="ds-code"><pre>&lt;?= ws_dna_profile_cta(['archetype' =&gt; 'architect', 'name' =&gt; 'The Architect']) ?&gt;
&lt;?= ws_dna_profile_cta() ?&gt;   // the pre-quiz card</pre></div>
</section>

<section class="ds-section">
    <h2 class="ds-section-title">All five archetypes</h2>
    <p class="ds-section-desc">One medallion per archetype (<code>images/dna/profile/medallion-&lt;slug&gt;.png</code>, exported at 2x from the frames). A slug whose medallion is missing on disk falls back to the start card rather than rendering a broken roundel.</p>
    <div class="ds-demo" style="display: grid; gap: 24px; max-width: 320px;">
        <?php foreach (['energizer' => 'The Energizer', 'explorer' => 'The Explorer', 'sage' => 'The Sage'] as $demoSlug => $demoName): ?>
            <?= ws_dna_profile_cta(['archetype' => $demoSlug, 'name' => $demoName]) ?>
        <?php endforeach; ?>
    </div>
</section>

<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead><tr><th>Option</th><th>Type</th><th>Default</th><th>Description</th></tr></thead>
        <tbody>
            <tr><td><code>archetype</code></td><td>string</td><td><code>''</code></td><td>Slug: architect, connector, energizer, explorer, sage. Anything else renders the start card.</td></tr>
            <tr><td><code>name</code></td><td>string</td><td><code>The &lt;Slug&gt;</code></td><td>The archetype's display name, carried by the aria-label and the medallion's alt.</td></tr>
            <tr><td><code>href</code></td><td>string</td><td>profile / quiz</td><td>Where the card goes. Earned defaults to <code>/dna/profile.php?type=&lt;slug&gt;</code>, start to <code>/dna/quiz.php</code>.</td></tr>
            <tr><td><code>target</code></td><td>string</td><td><code>_blank</code></td><td>Link target; <code>_blank</code> adds <code>rel="noopener"</code>.</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Extra classes on the link.</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
