<?php
$ds_page  = 'foundations/colors';
$ds_title = 'Color System';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<style>
.color-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 12px; }
.color-card { background: #fff; border: 1px solid #E7E5E4; border-radius: 10px; overflow: hidden; }
.color-swatch { height: 72px; }
.color-info { padding: 10px 12px; }
.color-name { font-weight: 600; font-size: 13px; color: #2C2416; margin-bottom: 2px; }
.color-hex { font-family: 'SF Mono', monospace; font-size: 12px; color: #78716C; }
.color-token { font-family: 'SF Mono', monospace; font-size: 11px; color: #A8A29E; display: block; margin-top: 2px; }
</style>

<div class="ds-page-header">
    <h1>Color System</h1>
    <p>Our color palette uses warm tones instead of cool grays, creating an approachable yet professional feel across all apps.</p>
</div>

<div class="ds-note">
    <span class="material-symbols-outlined">info</span>
    <span>Source of truth: <code class="ds-code-inline">design-system/platform-tokens.css</code>. If this page and the CSS file disagree, the CSS file wins.</span>
</div>

<!-- Ink Palette -->
<section class="ds-section">
    <h2 class="ds-section-title">Ink Palette (Text Colors)</h2>
    <p class="ds-section-desc">Warm near-black tones with subtle red/brown undertones instead of pure black.</p>

    <div class="color-grid">
        <?php
        $inks = [
            ['name' => 'Ink',           'hex' => '#2C2416', 'token' => '--color-ink',           'desc' => 'Headings, primary text'],
            ['name' => 'Ink Secondary',  'hex' => '#5C5242', 'token' => '--color-ink-secondary', 'desc' => 'Body text, descriptions'],
            ['name' => 'Ink Muted',      'hex' => '#706965', 'token' => '--color-ink-muted',     'desc' => 'Secondary labels, metadata'],
            ['name' => 'Ink Faint',      'hex' => '#A8A29E', 'token' => '--color-ink-faint',     'desc' => 'Disabled text, hints'],
        ];
        foreach ($inks as $c): ?>
        <div class="color-card">
            <div class="color-swatch" style="background: <?php echo $c['hex']; ?>;"></div>
            <div class="color-info">
                <div class="color-name"><?php echo $c['name']; ?></div>
                <div class="color-hex"><?php echo $c['hex']; ?></div>
                <span class="color-token"><?php echo $c['token']; ?></span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="ds-subsection" style="margin-top: 24px;">
        <h3 class="ds-subsection-title">Semantic Text Aliases</h3>
        <table class="ds-table">
            <thead><tr><th>Token</th><th>Maps To</th><th>Usage</th></tr></thead>
            <tbody>
                <tr><td><code>--text-dark</code></td><td>var(--color-ink)</td><td>Headlines, strong emphasis</td></tr>
                <tr><td><code>--text-default</code></td><td>var(--color-ink-secondary)</td><td>Body paragraphs</td></tr>
                <tr><td><code>--text-muted</code></td><td>var(--color-ink-muted)</td><td>Captions, metadata</td></tr>
                <tr><td><code>--text-faint</code></td><td>var(--color-ink-faint)</td><td>Hints, disabled states</td></tr>
                <tr><td><code>--text-inverse</code></td><td>#FFFFFF</td><td>Text on dark backgrounds</td></tr>
            </tbody>
        </table>
    </div>
</section>

<!-- Backgrounds -->
<section class="ds-section">
    <h2 class="ds-section-title">Background Colors</h2>
    <p class="ds-section-desc">Warm tones for page backgrounds, warm paper for cards (<code>--card-bg</code>), pure white for modals, inputs and menus.</p>

    <div class="color-grid">
        <?php
        $bgs = [
            ['name' => 'Page',       'hex' => '#FEF7F1', 'token' => '--bg-page'],
            ['name' => 'Page Alt',   'hex' => '#FFFBF8', 'token' => '--bg-page-alt'],
            ['name' => 'Surface',    'hex' => '#FFFFFF', 'token' => '--bg-surface'],
            ['name' => 'Card',       'hex' => '#F7F1EA', 'token' => '--card-bg'],
            ['name' => 'Muted',      'hex' => '#F5F5F4', 'token' => '--bg-muted'],
            ['name' => 'Subtle',     'hex' => '#FAFAF9', 'token' => '--bg-subtle'],
            ['name' => 'Paper',      'hex' => '#FAF7F2', 'token' => '--bg-paper'],
            ['name' => 'Paper Dark', 'hex' => '#F0EBE3', 'token' => '--bg-paper-dark'],
        ];
        foreach ($bgs as $c): ?>
        <div class="color-card">
            <div class="color-swatch" style="background: <?php echo $c['hex']; ?>; border-bottom: 1px solid #E7E5E4;"></div>
            <div class="color-info">
                <div class="color-name"><?php echo $c['name']; ?></div>
                <div class="color-hex"><?php echo $c['hex']; ?></div>
                <span class="color-token"><?php echo $c['token']; ?></span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Warm Gray Scale -->
<section class="ds-section">
    <h2 class="ds-section-title">Gray Scale (Warm Stone)</h2>
    <p class="ds-section-desc">Warm stone tones, not cool blue-grays, to match the ink palette.</p>

    <div style="display: flex; gap: 2px; border-radius: 10px; overflow: hidden; margin-bottom: 16px;">
        <?php
        $grays = [
            ['label' => '50',  'hex' => '#FAFAF9'],
            ['label' => '100', 'hex' => '#F5F5F4'],
            ['label' => '200', 'hex' => '#E7E5E4'],
            ['label' => '300', 'hex' => '#D6D3D1'],
            ['label' => '400', 'hex' => '#A8A29E'],
            ['label' => '500', 'hex' => '#78716C'],
            ['label' => '600', 'hex' => '#57534E'],
            ['label' => '700', 'hex' => '#44403C'],
            ['label' => '800', 'hex' => '#292524'],
            ['label' => '900', 'hex' => '#1C1917'],
        ];
        foreach ($grays as $g): ?>
        <div style="flex: 1; height: 64px; background: <?php echo $g['hex']; ?>; display: flex; align-items: flex-end; justify-content: center; padding-bottom: 6px;">
            <span style="font-size: 10px; font-weight: 600; color: <?php echo intval(substr($g['label'], 0)) >= 500 ? '#fff' : '#57534E'; ?>;"><?php echo $g['label']; ?></span>
        </div>
        <?php endforeach; ?>
    </div>

    <table class="ds-table">
        <thead><tr><th>Token</th><th>Hex</th><th>Usage</th></tr></thead>
        <tbody>
            <tr><td><code>--gray-50</code></td><td>#FAFAF9</td><td>Section backgrounds</td></tr>
            <tr><td><code>--gray-100</code></td><td>#F5F5F4</td><td>Chip backgrounds, muted areas</td></tr>
            <tr><td><code>--gray-200</code></td><td>#E7E5E4</td><td>Borders, dividers</td></tr>
            <tr><td><code>--gray-300</code></td><td>#D6D3D1</td><td>Hover borders</td></tr>
            <tr><td><code>--gray-400</code></td><td>#A8A29E</td><td>Placeholder text</td></tr>
            <tr><td><code>--gray-500</code></td><td>#78716C</td><td>Secondary text</td></tr>
            <tr><td><code>--gray-600</code></td><td>#57534E</td><td>Body text alternative</td></tr>
            <tr><td><code>--gray-700</code></td><td>#44403C</td><td>Strong body text</td></tr>
            <tr><td><code>--gray-800</code></td><td>#292524</td><td>Headlines alternative</td></tr>
            <tr><td><code>--gray-900</code></td><td>#1C1917</td><td>Darkest gray</td></tr>
        </tbody>
    </table>
</section>

<!-- Phase Colors -->
<section class="ds-section">
    <h2 class="ds-section-title">Phase Colors</h2>
    <p class="ds-section-desc">Each phase of the facilitator journey has a base color.</p>

    <div class="ds-grid-4">
        <?php
        $phases = [
            ['name' => 'Learn',      'hex' => '#E54D4D', 'token' => '--phase-learn',      'apps' => 'Main Site, Podcasts, Academy'],
            ['name' => 'Plan',       'hex' => '#0284C7', 'token' => '--phase-plan',       'apps' => 'Planner'],
            ['name' => 'Facilitate', 'hex' => '#7C4DFF', 'token' => '--phase-facilitate', 'apps' => 'Coach, Intervention, Facilitator, Tips&dagger;'],
            ['name' => 'Reflect',    'hex' => '#10B981', 'token' => '--phase-reflect',    'apps' => 'DNA*'],
        ];
        foreach ($phases as $p): ?>
        <div class="ds-card" style="text-align: center;">
            <div style="width: 56px; height: 56px; background: <?php echo $p['hex']; ?>; border-radius: 14px; margin: 0 auto 12px;"></div>
            <div style="font-weight: 600; font-size: 15px; margin-bottom: 2px;"><?php echo $p['name']; ?></div>
            <div style="font-family: monospace; font-size: 12px; color: #78716C;"><?php echo $p['hex']; ?></div>
            <div style="font-family: monospace; font-size: 11px; color: #A8A29E; margin-top: 2px;"><?php echo $p['token']; ?></div>
            <div style="font-size: 12px; color: #A8A29E; margin-top: 8px; padding-top: 8px; border-top: 1px solid #F5F5F4;"><?php echo $p['apps']; ?></div>
        </div>
        <?php endforeach; ?>
    </div>
    <p class="ds-section-desc" style="margin-top: 14px;">
        &dagger; <strong>Tips</strong> is Learn-phase <em>content</em> but deliberately ships Facilitate purple (<code>#7C4DFF</code>) &mdash; the one sanctioned cross-phase exception. <strong>Academy / Training</strong> is Learn red (<code>#E54D4D</code>); an earlier "Reflect green" mapping was never implemented and has been retired. DNA's surface primary is the lighter <code>#34D399</code> within the <code>#10B981</code> Reflect phase. See <a href="<?= $ds_base ?>/apps/theming.php">App Theming</a> and <a href="<?= $ds_base ?>/getting-started/start-here.php">Start Here</a>.
    </p>
</section>

<!-- Semantic Status Colors -->
<section class="ds-section">
    <h2 class="ds-section-title">Semantic Status Colors</h2>
    <p class="ds-section-desc">Used for feedback states across all apps.</p>

    <div class="ds-grid-4">
        <?php
        $statuses = [
            ['name' => 'Success', 'hex' => '#22C55E', 'light' => '#DCFCE7', 'token' => '--color-success', 'icon' => 'check_circle'],
            ['name' => 'Warning', 'hex' => '#F59E0B', 'light' => '#FEF3C7', 'token' => '--color-warning', 'icon' => 'warning'],
            ['name' => 'Error',   'hex' => '#EF4444', 'light' => '#FEE2E2', 'token' => '--color-error',   'icon' => 'error'],
            ['name' => 'Info',    'hex' => '#3B82F6', 'light' => '#DBEAFE', 'token' => '--color-info',    'icon' => 'info'],
        ];
        foreach ($statuses as $s): ?>
        <div style="background: <?php echo $s['light']; ?>; border-radius: 10px; padding: 20px; text-align: center;">
            <span class="material-symbols-outlined" style="font-size: 28px; color: <?php echo $s['hex']; ?>; margin-bottom: 8px;"><?php echo $s['icon']; ?></span>
            <div style="font-weight: 600; font-size: 14px; color: <?php echo $s['hex']; ?>;"><?php echo $s['name']; ?></div>
            <div style="font-family: monospace; font-size: 12px; color: #78716C; margin-top: 4px;"><?php echo $s['hex']; ?></div>
            <div style="font-family: monospace; font-size: 11px; color: #A8A29E;"><?php echo $s['token']; ?></div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Brand Colors -->
<section class="ds-section">
    <h2 class="ds-section-title">Brand Colors (Main Site)</h2>

    <div class="color-grid">
        <?php
        $brand = [
            ['name' => 'Primary',    'hex' => '#E54D4D', 'token' => '--mainsite-primary'],
            ['name' => 'Dark',       'hex' => '#C73E3E', 'token' => '--mainsite-dark'],
            ['name' => 'Light',      'hex' => '#FEE2E2', 'token' => '--mainsite-light'],
            ['name' => 'Very Light', 'hex' => '#FEF2F2', 'token' => '--mainsite-very-light'],
        ];
        foreach ($brand as $c): ?>
        <div class="color-card">
            <div class="color-swatch" style="background: <?php echo $c['hex']; ?>;<?php echo $c['hex'] === '#FEF2F2' || $c['hex'] === '#FEE2E2' ? 'border-bottom: 1px solid #E7E5E4;' : ''; ?>"></div>
            <div class="color-info">
                <div class="color-name"><?php echo $c['name']; ?></div>
                <div class="color-hex"><?php echo $c['hex']; ?></div>
                <span class="color-token"><?php echo $c['token']; ?></span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Gradients -->
<section class="ds-section">
    <h2 class="ds-section-title">Gradients</h2>
    <p class="ds-section-desc">All gradients use a consistent 135-degree angle.</p>

    <div class="ds-grid-3">
        <div style="height: 80px; background: var(--mainsite-gradient); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 13px; font-weight: 600;">Primary</div>
        <div style="height: 80px; background: linear-gradient(135deg, #1A2744 0%, #2E3D5C 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 13px; font-weight: 600;">Navy</div>
        <div style="height: 80px; background: linear-gradient(135deg, #7C4DFF 0%, #6D28D9 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 13px; font-weight: 600;">Coach</div>
    </div>

    <div class="ds-note" style="margin-top: 16px;">
        <span class="material-symbols-outlined">info</span>
        <span>Only use gradients for buttons, section headers, and icon containers. Never for card backgrounds or decorative fills.</span>
    </div>
</section>

<!-- Contrast & Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Contrast &amp; Accessibility</h2>
    <p class="ds-section-desc">WCAG AA requires a minimum contrast ratio of 4.5:1 for normal text and 3:1 for large text (18px+ or 14px bold).</p>

    <h3 style="font-size: 14px; margin: 16px 0 8px; color: var(--ds-heading);">Known Contrast Risks</h3>
    <table class="ds-table">
        <thead><tr><th>Combination</th><th>Ratio</th><th>Result</th><th>Guidance</th></tr></thead>
        <tbody>
            <tr>
                <td>White on <code>--mainsite-primary</code> (#E54D4D)</td>
                <td>3.82:1</td>
                <td style="color: #B45309; font-weight: 600;">AA Large only</td>
                <td>Use for headings 18px+. For body text, use <code>--color-primary-on-white</code> (#C73E3E, 5.02:1)</td>
            </tr>
            <tr>
                <td><code>--color-ink-faint</code> (#A8A29E) on white</td>
                <td>2.8:1</td>
                <td style="color: #DC2626; font-weight: 600;">Fails AA</td>
                <td>Decorative use only (borders, icons). For text, use <code>--color-ink-faint-accessible</code> (#706965, 5.39:1)</td>
            </tr>
            <tr>
                <td>White on <code>--mainsite-dark</code> (#C73E3E)</td>
                <td>5.02:1</td>
                <td style="color: #16A34A; font-weight: 600;">AA pass</td>
                <td>Safe for all text sizes on white backgrounds</td>
            </tr>
            <tr>
                <td><code>--color-ink</code> (#2C2416) on white</td>
                <td>14.5:1</td>
                <td style="color: #16A34A; font-weight: 600;">AAA pass</td>
                <td>Primary text color — excellent contrast</td>
            </tr>
        </tbody>
    </table>

    <div class="ds-note" style="margin-top: 16px;">
        <span class="material-symbols-outlined">warning</span>
        <span>When placing text on brand colors, always use <code>--color-primary-on-white</code> instead of <code>--mainsite-primary</code>. The brand red (#E54D4D) is safe for large headings and decorative elements, but not for body text on white.</span>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
