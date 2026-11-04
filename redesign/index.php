<?php
$ds_page  = 'redesign/index';
$ds_title = 'About the Redesign';

require_once __DIR__ . '/../../includes/icon.php';
require_once __DIR__ . '/../../includes/components/helpers.php';

require_once __DIR__ . '/../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>About the Redesign</h1>
    <p>The app-shell redesign track. Components here are global, shipping, and usable anywhere &mdash; they are documented apart from the established set because they belong to a direction still being worked out, not because they are drafts.</p>
</div>

<section class="ds-section">
    <h2 class="ds-section-title">What this section is</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>What lives here:</strong>
            Global <code>ws_*</code> components built for the chromeless app shell &mdash; the window with no browser chrome, where the platform header's horizontal nav is suppressed and the shell has to carry navigation itself. They ship from <code>includes/components/helpers.php</code> like every other component and are available on any page.
        </div>
        <div class="ds-dont">
            <strong>What doesn't:</strong>
            App-specific markup, throwaway mockups, or anything not yet real in code. A component earns a page here once it exists as a <code>ws_*</code> helper with a template, tokenised CSS, and every state specified. Mockups belong in Figma.
        </div>
    </div>
</section>

<section class="ds-section">
    <h2 class="ds-section-title">The rules still apply</h2>
    <p class="ds-section-desc">Being on the redesign track buys no exemptions. Everything here passes the same gates as the rest of the system.</p>
    <ul class="ds-list">
        <li><strong>Workshopr tokens, always.</strong> Where a component follows an external pattern &mdash; Material 3, say &mdash; it borrows the geometry and the interaction model, never the palette. Red Unification and <code>platform-tokens.css</code> outrank any imported colour system.</li>
        <li><strong>Contrast is measured, not assumed.</strong> Every text pairing is computed against its real rendered background before it ships. Two pairings in the side nav were caught failing AA this way and changed.</li>
        <li><strong>Every state is specified.</strong> Rest, hover, focus, pressed, active, disabled &mdash; and demoed live on the page, not described in prose.</li>
        <li><strong>The enforcer passes.</strong> <code>validate_file</code> clean, <code>check-drift.php</code> in sync, registered in <code>workshopr-design-system.json</code>.</li>
    </ul>
</section>

<section class="ds-section">
    <h2 class="ds-section-title">Components</h2>
    <div class="ds-card">
        <h3 class="ds-subsection-title"><a href="<?= $ds_base ?>/redesign/sidenav.php">Side Navigation</a> &mdash; <code class="ds-code-inline">ws_sidenav()</code></h3>
        <p>The vertical rail an app shell wears down its left edge, following the Material 3 navigation rail in Workshopr's colours. Two variants: an 80px collapsed rail and a 240px expanded one.</p>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
