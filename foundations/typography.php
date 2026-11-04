<?php
$ds_page  = 'foundations/typography';
$ds_title = 'Typography';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>Typography</h1>
    <p>Two fonts, clear roles. Fraunces for personality in headings, Inter for clarity in everything else.</p>
</div>

<!-- Font Families -->
<section class="ds-section">
    <h2 class="ds-section-title">Font Families</h2>

    <div class="ds-grid-2">
        <div class="ds-card">
            <div style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: #A8A29E; margin-bottom: 12px;">Headings</div>
            <div style="font-family: 'Fraunces', Georgia, serif; font-size: 28px; font-weight: 700; color: #1A2744; margin-bottom: 8px; letter-spacing: -0.02em;">Fraunces</div>
            <div style="font-size: 13px; color: #78716C; line-height: 1.6; margin-bottom: 12px;">Used for H1, H2, H3 -- page titles, section headers, card titles. If it <strong>names or introduces</strong> a section, use Fraunces.</div>
            <div class="ds-code" style="font-size: 12px;">--font-heading: 'Fraunces', Georgia, serif;</div>
        </div>
        <div class="ds-card">
            <div style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: #A8A29E; margin-bottom: 12px;">Body & UI</div>
            <div style="font-family: 'Inter', sans-serif; font-size: 28px; font-weight: 700; color: #1A2744; margin-bottom: 8px;">Inter</div>
            <div style="font-size: 13px; color: #78716C; line-height: 1.6; margin-bottom: 12px;">Used for H4, body text, buttons, labels, UI elements. If it <strong>describes, labels, or instructs</strong>, use Inter.</div>
            <div class="ds-code" style="font-size: 12px;">--font-body: 'Inter', -apple-system, sans-serif;</div>
        </div>
    </div>
</section>

<!-- Type Scale -->
<section class="ds-section">
    <h2 class="ds-section-title">Type Scale</h2>
    <p class="ds-section-desc">Live preview of every size in the scale.</p>

    <div style="display: flex; flex-direction: column; gap: 12px;">
        <?php
        $scale = [
            ['token' => '--text-display', 'size' => '46px', 'font' => 'Fraunces', 'weight' => '700', 'sample' => 'Display Text', 'ff' => "'Fraunces', Georgia, serif"],
            ['token' => '--text-h1',      'size' => '32px', 'font' => 'Fraunces', 'weight' => '700', 'sample' => 'Page Title H1', 'ff' => "'Fraunces', Georgia, serif"],
            ['token' => '--text-h2',      'size' => '24px', 'font' => 'Fraunces', 'weight' => '700', 'sample' => 'Section Header H2', 'ff' => "'Fraunces', Georgia, serif"],
            ['token' => '--text-h3',      'size' => '20px', 'font' => 'Fraunces', 'weight' => '600', 'sample' => 'Card Title H3', 'ff' => "'Fraunces', Georgia, serif"],
            ['token' => '--text-h4',      'size' => '18px', 'font' => 'Inter',    'weight' => '600', 'sample' => 'UI Subheading H4', 'ff' => "'Inter', sans-serif"],
            ['token' => '--text-body',    'size' => '16px', 'font' => 'Inter',    'weight' => '400', 'sample' => 'Body paragraph text used for content and descriptions.', 'ff' => "'Inter', sans-serif"],
            ['token' => '--text-small',   'size' => '14px', 'font' => 'Inter',    'weight' => '400', 'sample' => 'Small text for meta info and secondary content.', 'ff' => "'Inter', sans-serif"],
            ['token' => '--text-caption', 'size' => '12px', 'font' => 'Inter',    'weight' => '500', 'sample' => 'CAPTION TEXT FOR LABELS AND TIMESTAMPS', 'ff' => "'Inter', sans-serif"],
        ];
        foreach ($scale as $s): ?>
        <div class="ds-card" style="display: flex; align-items: center; gap: 20px; padding: 16px 20px;">
            <div style="min-width: 140px; flex-shrink: 0;">
                <div style="font-family: monospace; font-size: 12px; color: #E54D4D;"><?php echo $s['token']; ?></div>
                <div style="font-size: 11px; color: #A8A29E; margin-top: 2px;"><?php echo $s['size']; ?> / <?php echo $s['font']; ?> / <?php echo $s['weight']; ?></div>
            </div>
            <div style="font-family: <?php echo $s['ff']; ?>; font-size: <?php echo $s['size']; ?>; font-weight: <?php echo $s['weight']; ?>; color: #2C2416; line-height: 1.3;">
                <?php echo htmlspecialchars($s['sample'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Quick Reference -->
<section class="ds-section">
    <h2 class="ds-section-title">Quick Reference: What Size for What</h2>

    <table class="ds-table">
        <thead><tr><th>Element</th><th>Size Token</th><th>Font</th><th>Weight</th></tr></thead>
        <tbody>
            <tr><td>Hero headline</td><td><code>--text-display</code></td><td>Fraunces</td><td>700</td></tr>
            <tr><td>Page title</td><td><code>--text-h1</code></td><td>Fraunces</td><td>700</td></tr>
            <tr><td>Section header</td><td><code>--text-h2</code></td><td>Fraunces</td><td>700</td></tr>
            <tr><td>Card title</td><td><code>--text-h3</code></td><td>Fraunces</td><td>600</td></tr>
            <tr><td>UI subheading</td><td><code>--text-h4</code></td><td>Inter</td><td>600</td></tr>
            <tr><td>Body paragraph</td><td><code>--text-body</code></td><td>Inter</td><td>400</td></tr>
            <tr><td>Button label</td><td><code>--text-small</code> to <code>--text-body</code></td><td>Inter</td><td>600</td></tr>
            <tr><td>Duration/meta badge</td><td><code>--text-small</code></td><td>Inter</td><td>500</td></tr>
            <tr><td>Timestamp, caption</td><td><code>--text-caption</code></td><td>Inter</td><td>500</td></tr>
        </tbody>
    </table>
</section>

<!-- Font Weights -->
<section class="ds-section">
    <h2 class="ds-section-title">Font Weights</h2>

    <div class="ds-grid-4">
        <?php
        $weights = [
            ['name' => 'Normal',   'value' => '400', 'token' => '--font-normal',   'usage' => 'Body text'],
            ['name' => 'Medium',   'value' => '500', 'token' => '--font-medium',   'usage' => 'Labels, badges'],
            ['name' => 'Semibold', 'value' => '600', 'token' => '--font-semibold', 'usage' => 'Card titles, buttons'],
            ['name' => 'Bold',     'value' => '700', 'token' => '--font-bold',     'usage' => 'Page titles, display'],
        ];
        foreach ($weights as $w): ?>
        <div class="ds-card" style="text-align: center;">
            <div style="font-family: 'Inter', sans-serif; font-size: 32px; font-weight: <?php echo $w['value']; ?>; color: #1A2744; margin-bottom: 8px;">Aa</div>
            <div style="font-weight: 600; font-size: 14px; margin-bottom: 2px;"><?php echo $w['name']; ?></div>
            <div style="font-family: monospace; font-size: 12px; color: #78716C;"><?php echo $w['value']; ?></div>
            <div style="font-family: monospace; font-size: 11px; color: #A8A29E;"><?php echo $w['token']; ?></div>
            <div style="font-size: 12px; color: #A8A29E; margin-top: 8px; padding-top: 8px; border-top: 1px solid #F5F5F4;"><?php echo $w['usage']; ?></div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Line Heights -->
<section class="ds-section">
    <h2 class="ds-section-title">Line Heights</h2>

    <table class="ds-table">
        <thead><tr><th>Token</th><th>Value</th><th>Usage</th></tr></thead>
        <tbody>
            <tr><td><code>--leading-tight</code></td><td>1.2</td><td>Headlines -- compact, punchy</td></tr>
            <tr><td><code>--leading-snug</code></td><td>1.35</td><td>Card titles, small headings</td></tr>
            <tr><td><code>--leading-normal</code></td><td>1.5</td><td>Body text -- comfortable reading</td></tr>
            <tr><td><code>--leading-relaxed</code></td><td>1.625</td><td>Long-form content, articles</td></tr>
        </tbody>
    </table>
</section>

<!-- Letter Spacing -->
<section class="ds-section">
    <h2 class="ds-section-title">Letter Spacing</h2>

    <table class="ds-table">
        <thead><tr><th>Token</th><th>Value</th><th>Usage</th></tr></thead>
        <tbody>
            <tr><td><code>--tracking-tight</code></td><td>-0.02em</td><td>Headlines -- pulls letters together</td></tr>
            <tr><td><code>--tracking-normal</code></td><td>0</td><td>Body text</td></tr>
            <tr><td><code>--tracking-wide</code></td><td>0.025em</td><td>Uppercase labels, button text</td></tr>
        </tbody>
    </table>
</section>

<!-- Display Text Pattern -->
<section class="ds-section">
    <h2 class="ds-section-title">Display Text Pattern</h2>
    <p class="ds-section-desc">Hero/display text uses a distinctive two-part styling with an italic emphasis word.</p>

    <div class="ds-card" style="text-align: center; padding: 40px 24px; background: #FEF7F1;">
        <div style="font-family: 'Fraunces', Georgia, serif; font-size: 36px; font-weight: 700; line-height: 1.2; letter-spacing: -0.02em; color: #5C5242;">
            Transform Your <em style="font-style: italic; color: #C73E3E; text-decoration: underline; text-decoration-color: #FEE2E2; text-decoration-thickness: 8px; text-underline-offset: 0px; text-decoration-skip-ink: none;">Facilitation</em>
        </div>
    </div>

    <div class="ds-code" style="margin-top: 16px;">
&lt;h1 class="display-text"&gt;Transform Your &lt;em&gt;Facilitation&lt;/em&gt;&lt;/h1&gt;

.display-text em {
  font-style: italic;
  color: var(--phase-learn-dark);
  text-decoration: underline;
  text-decoration-color: var(--phase-learn-light);
  text-decoration-thickness: 8px;
  text-underline-offset: 0;
}</div>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
