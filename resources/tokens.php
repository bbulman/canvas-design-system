<?php
$ds_page  = 'resources/tokens';
$ds_title = 'Token Reference';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>Token Reference</h1>
    <p>Complete index of all CSS custom properties defined in <code class="ds-code-inline">platform-tokens.css</code>. This file is the canonical source of truth.</p>
</div>

<div class="ds-note" style="margin-bottom: 32px;">
    <span class="material-symbols-outlined">info</span>
    <span>If this document and the CSS file disagree, the CSS file wins. View the raw file: <a href="<?= $ds_base ?>/platform-tokens.css" target="_blank" style="color: #92400E; font-weight: 500;">platform-tokens.css</a></span>
</div>

<!-- Naming convention -->
<section class="ds-section">
    <h2 class="ds-section-title">Naming Convention</h2>

    <div class="ds-code">--{scope}-{property}[-{modifier}]

Scope:     color, bg, text, phase, {app-name}, gray
Property:  ink, primary, surface, etc.
Modifier:  dark, light, very-light, secondary, muted, faint</div>

    <div class="ds-subsection" style="margin-top: 16px;">
        <h3 class="ds-subsection-title">Examples</h3>
        <table class="ds-table">
            <thead><tr><th>Token</th><th>Meaning</th></tr></thead>
            <tbody>
                <tr><td><code>--color-ink</code></td><td>Global ink (text) color</td></tr>
                <tr><td><code>--color-ink-secondary</code></td><td>Lighter ink variant</td></tr>
                <tr><td><code>--phase-learn</code></td><td>Learn phase base color</td></tr>
                <tr><td><code>--tips-primary</code></td><td>Tips app accent color</td></tr>
                <tr><td><code>--tips-dark</code></td><td>Tips app hover shade</td></tr>
                <tr><td><code>--bg-page</code></td><td>Page background</td></tr>
                <tr><td><code>--text-default</code></td><td>Default body text color</td></tr>
            </tbody>
        </table>
    </div>
</section>

<!-- Full token tables -->
<section class="ds-section">
    <h2 class="ds-section-title">Phase Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Value</th><th>Phase</th></tr></thead>
        <tbody>
            <?php
            $phases = [
                ['--phase-learn',            '#E54D4D', 'Learn'],
                ['--phase-learn-dark',       '#C73E3E', 'Learn'],
                ['--phase-learn-light',      '#FEE2E2', 'Learn'],
                ['--phase-learn-very-light', '#FEF2F2', 'Learn'],
                ['--phase-plan',             '#0284C7', 'Plan'],
                ['--phase-plan-dark',        '#075985', 'Plan'],
                ['--phase-plan-light',       '#E0F2FE', 'Plan'],
                ['--phase-plan-very-light',  '#F0F9FF', 'Plan'],
                ['--phase-facilitate',       '#7C4DFF', 'Facilitate'],
                ['--phase-facilitate-dark',  '#6D28D9', 'Facilitate'],
                ['--phase-facilitate-light', '#EDE9FE', 'Facilitate'],
                ['--phase-facilitate-very-light', '#EDE9FE', 'Facilitate'],
                ['--phase-reflect',          '#10B981', 'Reflect'],
                ['--phase-reflect-dark',     '#059669', 'Reflect'],
                ['--phase-reflect-light',    '#A7F3D0', 'Reflect'],
                ['--phase-reflect-very-light','#D1FAE5', 'Reflect'],
            ];
            foreach ($phases as $p): ?>
            <tr>
                <td><code><?php echo $p[0]; ?></code></td>
                <td><span style="display: inline-block; width: 12px; height: 12px; background: <?php echo $p[1]; ?>; border-radius: 3px; vertical-align: middle; margin-right: 6px;"></span><?php echo $p[1]; ?></td>
                <td><?php echo $p[2]; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<section class="ds-section">
    <h2 class="ds-section-title">Ink & Text Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Value</th><th>Usage</th></tr></thead>
        <tbody>
            <tr><td><code>--color-ink</code></td><td>#2C2416</td><td>Headings, primary text</td></tr>
            <tr><td><code>--color-ink-secondary</code></td><td>#5C5242</td><td>Body text, descriptions</td></tr>
            <tr><td><code>--color-ink-muted</code></td><td>#706965</td><td>Metadata, captions</td></tr>
            <tr><td><code>--color-ink-faint</code></td><td>#A8A29E</td><td>Disabled, hints</td></tr>
            <tr><td><code>--text-dark</code></td><td>var(--color-ink)</td><td>Alias: headlines</td></tr>
            <tr><td><code>--text-default</code></td><td>var(--color-ink-secondary)</td><td>Alias: body text</td></tr>
            <tr><td><code>--text-muted</code></td><td>var(--color-ink-muted)</td><td>Alias: meta text</td></tr>
            <tr><td><code>--text-faint</code></td><td>var(--color-ink-faint)</td><td>Alias: hints</td></tr>
            <tr><td><code>--text-inverse</code></td><td>#FFFFFF</td><td>Text on dark backgrounds</td></tr>
        </tbody>
    </table>
</section>

<section class="ds-section">
    <h2 class="ds-section-title">Background Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Value</th><th>Usage</th></tr></thead>
        <tbody>
            <tr><td><code>--bg-page</code></td><td>#FEF7F1</td><td>Default page background</td></tr>
            <tr><td><code>--bg-page-alt</code></td><td>#FFFBF8</td><td>Coach app page bg</td></tr>
            <tr><td><code>--bg-surface</code></td><td>#FFFFFF</td><td>Modals, inputs, menus</td></tr>
            <tr><td><code>--bg-muted</code></td><td>#F5F5F4</td><td>Subtle section alternates</td></tr>
            <tr><td><code>--bg-subtle</code></td><td>#FAFAF9</td><td>Very light differentiation</td></tr>
            <tr><td><code>--bg-paper</code></td><td>#FAF7F2</td><td>Tips/Intervention paper</td></tr>
            <tr><td><code>--bg-paper-dark</code></td><td>#F0EBE3</td><td>Darker paper sections</td></tr>
        </tbody>
    </table>
</section>

<section class="ds-section">
    <h2 class="ds-section-title">Typography Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Value</th></tr></thead>
        <tbody>
            <tr><td><code>--font-heading</code></td><td>'Fraunces', Georgia, serif</td></tr>
            <tr><td><code>--font-body</code></td><td>'Inter', -apple-system, sans-serif</td></tr>
            <tr><td><code>--text-display</code></td><td>2.875rem (46px)</td></tr>
            <tr><td><code>--text-h1</code></td><td>2rem (32px)</td></tr>
            <tr><td><code>--text-h2</code></td><td>1.5rem (24px)</td></tr>
            <tr><td><code>--text-h3</code></td><td>1.25rem (20px)</td></tr>
            <tr><td><code>--text-h4</code></td><td>1.125rem (18px)</td></tr>
            <tr><td><code>--text-body</code></td><td>1rem (16px)</td></tr>
            <tr><td><code>--text-ui</code></td><td>0.9375rem (15px)</td></tr>
            <tr><td><code>--text-small</code></td><td>0.875rem (14px)</td></tr>
            <tr><td><code>--text-meta</code></td><td>0.8125rem (13px)</td></tr>
            <tr><td><code>--text-caption</code></td><td>0.75rem (12px)</td></tr>
            <tr><td><code>--text-micro</code></td><td>0.6875rem (11px)</td></tr>
            <tr><td><code>--text-nano</code></td><td>0.625rem (10px)</td></tr>
            <tr><td><code>--font-normal</code></td><td>400</td></tr>
            <tr><td><code>--font-medium</code></td><td>500</td></tr>
            <tr><td><code>--font-semibold</code></td><td>600</td></tr>
            <tr><td><code>--font-bold</code></td><td>700</td></tr>
            <tr><td><code>--leading-tight</code></td><td>1.2</td></tr>
            <tr><td><code>--leading-snug</code></td><td>1.35</td></tr>
            <tr><td><code>--leading-normal</code></td><td>1.5</td></tr>
            <tr><td><code>--leading-relaxed</code></td><td>1.625</td></tr>
            <tr><td><code>--tracking-tight</code></td><td>-0.02em</td></tr>
            <tr><td><code>--tracking-normal</code></td><td>0</td></tr>
            <tr><td><code>--tracking-wide</code></td><td>0.025em</td></tr>
        </tbody>
    </table>
</section>

<section class="ds-section">
    <h2 class="ds-section-title">Spacing Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Value</th></tr></thead>
        <tbody>
            <tr><td><code>--space-0-5</code></td><td>2px (0.125rem)</td></tr>
            <tr><td><code>--space-1</code></td><td>4px (0.25rem)</td></tr>
            <tr><td><code>--space-1-5</code></td><td>6px (0.375rem)</td></tr>
            <tr><td><code>--space-2</code></td><td>8px (0.5rem)</td></tr>
            <tr><td><code>--space-2-5</code></td><td>10px (0.625rem)</td></tr>
            <tr><td><code>--space-3</code></td><td>12px (0.75rem)</td></tr>
            <tr><td><code>--space-3-5</code></td><td>14px (0.875rem)</td></tr>
            <tr><td><code>--space-4</code></td><td>16px (1rem)</td></tr>
            <tr><td><code>--space-4-5</code></td><td>18px (1.125rem)</td></tr>
            <tr><td><code>--space-5</code></td><td>20px (1.25rem)</td></tr>
            <tr><td><code>--space-6</code></td><td>24px (1.5rem)</td></tr>
            <tr><td><code>--space-8</code></td><td>32px (2rem)</td></tr>
            <tr><td><code>--space-10</code></td><td>40px (2.5rem)</td></tr>
            <tr><td><code>--space-12</code></td><td>48px (3rem)</td></tr>
            <tr><td><code>--space-16</code></td><td>64px (4rem)</td></tr>
        </tbody>
    </table>
</section>

<section class="ds-section">
    <h2 class="ds-section-title">Shadow & Elevation Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Value</th></tr></thead>
        <tbody>
            <tr><td><code>--shadow-xs</code></td><td>0 1px 2px rgba(0,0,0,0.04)</td></tr>
            <tr><td><code>--shadow-sm</code></td><td>0 1px 3px rgba(0,0,0,0.06)</td></tr>
            <tr><td><code>--shadow-md</code></td><td>0 4px 6px rgba(0,0,0,0.07)</td></tr>
            <tr><td><code>--shadow-lg</code></td><td>0 10px 15px rgba(0,0,0,0.08)</td></tr>
            <tr><td><code>--shadow-xl</code></td><td>0 20px 25px rgba(0,0,0,0.10)</td></tr>
        </tbody>
    </table>
</section>

<section class="ds-section">
    <h2 class="ds-section-title">Transition Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Value</th><th>Usage</th></tr></thead>
        <tbody>
            <tr><td><code>--transition-fast</code></td><td>150ms ease</td><td>Buttons, chips, toggles</td></tr>
            <tr><td><code>--transition-base</code></td><td>200ms ease</td><td>Cards, general hover</td></tr>
            <tr><td><code>--transition-slow</code></td><td>300ms ease</td><td>Modals, panels, overlays</td></tr>
        </tbody>
    </table>
</section>

<!-- Semantic component tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Semantic Component Tokens</h2>
    <p class="ds-section-desc">Component-level tokens map design intent to primitive values. Use these in component CSS instead of referencing primitives directly — this enables theming and future dark mode support.</p>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Buttons</h3>
        <table class="ds-table">
            <thead><tr><th>Token</th><th>Value</th><th>Usage</th></tr></thead>
            <tbody>
                <tr><td><code>--button-bg-primary</code></td><td>var(--mainsite-primary)</td><td>Primary button background</td></tr>
                <tr><td><code>--button-bg-primary-hover</code></td><td>var(--mainsite-dark)</td><td>Primary button hover</td></tr>
                <tr><td><code>--button-text-primary</code></td><td>var(--text-inverse)</td><td>Primary button text</td></tr>
                <tr><td><code>--button-bg-secondary</code></td><td>var(--bg-surface)</td><td>Secondary button background</td></tr>
                <tr><td><code>--button-text-secondary</code></td><td>var(--color-ink)</td><td>Secondary button text</td></tr>
                <tr><td><code>--button-border-secondary</code></td><td>var(--gray-300)</td><td>Secondary button border</td></tr>
                <tr><td><code>--button-bg-ghost</code></td><td>transparent</td><td>Ghost button background</td></tr>
                <tr><td><code>--button-text-ghost</code></td><td>var(--color-ink-secondary)</td><td>Ghost button text</td></tr>
                <tr><td><code>--button-radius</code></td><td>var(--radius-lg)</td><td>Button border radius</td></tr>
            </tbody>
        </table>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Cards</h3>
        <table class="ds-table">
            <thead><tr><th>Token</th><th>Value</th><th>Usage</th></tr></thead>
            <tbody>
                <tr><td><code>--card-bg</code></td><td>#F7F1EA</td><td>Card background (warm paper)</td></tr>
                <tr><td><code>--card-border</code></td><td>var(--gray-200)</td><td>Card border color</td></tr>
                <tr><td><code>--card-shadow</code></td><td>var(--shadow-sm)</td><td>Card resting shadow</td></tr>
                <tr><td><code>--card-shadow-hover</code></td><td>var(--shadow-md)</td><td>Card hover shadow</td></tr>
                <tr><td><code>--card-radius</code></td><td>var(--radius-xl)</td><td>Card border radius</td></tr>
                <tr><td><code>--card-padding</code></td><td>var(--space-6)</td><td>Card internal padding</td></tr>
            </tbody>
        </table>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Inputs</h3>
        <table class="ds-table">
            <thead><tr><th>Token</th><th>Value</th><th>Usage</th></tr></thead>
            <tbody>
                <tr><td><code>--input-bg</code></td><td>var(--bg-surface)</td><td>Input background</td></tr>
                <tr><td><code>--input-border</code></td><td>var(--gray-300)</td><td>Input border color</td></tr>
                <tr><td><code>--input-border-focus</code></td><td>var(--phase-plan)</td><td>Focused input border</td></tr>
                <tr><td><code>--input-text</code></td><td>var(--color-ink)</td><td>Input text color</td></tr>
                <tr><td><code>--input-placeholder</code></td><td>var(--color-ink-faint)</td><td>Placeholder text</td></tr>
                <tr><td><code>--input-radius</code></td><td>var(--radius-lg)</td><td>Input border radius</td></tr>
                <tr><td><code>--input-ring</code></td><td>var(--focus-ring-color)</td><td>Focus ring color</td></tr>
            </tbody>
        </table>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Modals, Tooltips, Toasts</h3>
        <table class="ds-table">
            <thead><tr><th>Token</th><th>Value</th><th>Usage</th></tr></thead>
            <tbody>
                <tr><td><code>--modal-bg</code></td><td>var(--bg-surface)</td><td>Modal background</td></tr>
                <tr><td><code>--modal-border</code></td><td>var(--gray-200)</td><td>Modal border</td></tr>
                <tr><td><code>--modal-shadow</code></td><td>var(--shadow-xl)</td><td>Modal shadow</td></tr>
                <tr><td><code>--modal-backdrop</code></td><td>var(--backdrop-medium)</td><td>Modal overlay</td></tr>
                <tr><td><code>--modal-radius</code></td><td>var(--radius-2xl)</td><td>Modal border radius</td></tr>
                <tr><td><code>--tooltip-bg</code></td><td>var(--gray-900)</td><td>Tooltip background</td></tr>
                <tr><td><code>--tooltip-text</code></td><td>var(--text-inverse)</td><td>Tooltip text</td></tr>
                <tr><td><code>--toast-bg</code></td><td>var(--bg-surface)</td><td>Toast notification background</td></tr>
                <tr><td><code>--toast-shadow</code></td><td>var(--shadow-lg)</td><td>Toast shadow</td></tr>
            </tbody>
        </table>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Links & Dividers</h3>
        <table class="ds-table">
            <thead><tr><th>Token</th><th>Value</th><th>Usage</th></tr></thead>
            <tbody>
                <tr><td><code>--link-color</code></td><td>var(--phase-plan)</td><td>Default link color</td></tr>
                <tr><td><code>--link-hover</code></td><td>var(--phase-plan-dark)</td><td>Link hover color</td></tr>
                <tr><td><code>--link-visited</code></td><td>var(--phase-facilitate)</td><td>Visited link color</td></tr>
                <tr><td><code>--divider-color</code></td><td>var(--gray-200)</td><td>Default divider/separator</td></tr>
                <tr><td><code>--divider-strong</code></td><td>var(--gray-300)</td><td>Prominent divider</td></tr>
            </tbody>
        </table>
    </div>
</section>

<!-- Legacy aliases -->
<section class="ds-section">
    <h2 class="ds-section-title">Legacy Token Aliases</h2>
    <p class="ds-section-desc">Older tokens that still appear in the codebase. Prefer the current token names. These aliases will be removed in a future release.</p>

    <div class="ds-note" style="margin-bottom: 16px;">
        <span class="material-symbols-outlined">warning</span>
        <span><strong>Deprecation notice:</strong> Legacy aliases are scheduled for removal in v2.0. Migrate to the current token names listed in the "Maps To" column. Console warnings will be added in v1.7 to flag remaining usage.</span>
    </div>

    <table class="ds-table">
        <thead><tr><th>Legacy Token</th><th>Maps To</th><th>Note</th></tr></thead>
        <tbody>
            <tr><td><code>--color-primary</code></td><td>--mainsite-primary</td><td></td></tr>
            <tr><td><code>--color-primary-dark</code></td><td>--mainsite-dark</td><td></td></tr>
            <tr><td><code>--color-primary-light</code></td><td>--mainsite-light</td><td></td></tr>
            <tr><td><code>--text-primary</code></td><td>--text-dark</td><td>Avoid; ambiguous</td></tr>
            <tr><td><code>--text-secondary</code></td><td>--text-default or --text-muted</td><td>Context-dependent</td></tr>
            <tr><td><code>--font-family</code></td><td>--font-body</td><td></td></tr>
            <tr><td><code>--border-default</code></td><td>--gray-200</td><td></td></tr>
            <tr><td><code>--border-light</code></td><td>--gray-200</td><td></td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
