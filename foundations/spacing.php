<?php
$ds_page  = 'foundations/spacing';
$ds_title = 'Spacing & Layout';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>Spacing & Layout</h1>
    <p>A 4px base grid, responsive breakpoints, and consistent container patterns for every Workshopr app.</p>
</div>

<!-- Spacing Scale -->
<section class="ds-section">
    <h2 class="ds-section-title">Spacing Scale</h2>
    <p class="ds-section-desc">Based on a 4px base unit. Every spacing value is a multiple of 4.</p>

    <div style="display: flex; flex-direction: column; gap: 8px; margin-bottom: 24px;">
        <?php
        $spaces = [
            ['token' => '--space-0-5','px' => 2,  'rem' => '0.125rem','usage' => 'Hairline adjustments'],
            ['token' => '--space-1',  'px' => 4,  'rem' => '0.25rem', 'usage' => 'Icon-to-text gaps'],
            ['token' => '--space-1-5','px' => 6,  'rem' => '0.375rem','usage' => 'Tight inline spacing'],
            ['token' => '--space-2',  'px' => 8,  'rem' => '0.5rem',  'usage' => 'Tight component padding, inline gaps'],
            ['token' => '--space-2-5','px' => 10, 'rem' => '0.625rem','usage' => 'Badge/chip internal padding'],
            ['token' => '--space-3',  'px' => 12, 'rem' => '0.75rem', 'usage' => 'Default gap between related items'],
            ['token' => '--space-3-5','px' => 14, 'rem' => '0.875rem','usage' => 'Comfortable small gaps'],
            ['token' => '--space-4',  'px' => 16, 'rem' => '1rem',    'usage' => 'Card internal padding, form field gaps'],
            ['token' => '--space-4-5','px' => 18, 'rem' => '1.125rem','usage' => 'Between-group spacing'],
            ['token' => '--space-5',  'px' => 20, 'rem' => '1.25rem', 'usage' => 'Comfortable component padding'],
            ['token' => '--space-6',  'px' => 24, 'rem' => '1.5rem',  'usage' => 'Card padding, container padding, grid gaps'],
            ['token' => '--space-8',  'px' => 32, 'rem' => '2rem',    'usage' => 'Section margins, major separation'],
            ['token' => '--space-10', 'px' => 40, 'rem' => '2.5rem',  'usage' => 'Large section padding'],
            ['token' => '--space-12', 'px' => 48, 'rem' => '3rem',    'usage' => 'Section gaps on desktop'],
            ['token' => '--space-16', 'px' => 64, 'rem' => '4rem',    'usage' => 'Hero section vertical padding'],
        ];
        foreach ($spaces as $s): ?>
        <div style="display: flex; align-items: center; gap: 16px; background: #fff; border: 1px solid #E7E5E4; border-radius: 8px; padding: 10px 16px;">
            <div style="width: <?php echo $s['px']; ?>px; height: 24px; background: #E54D4D; border-radius: 3px; flex-shrink: 0;"></div>
            <div style="min-width: 110px; flex-shrink: 0;">
                <div style="font-family: monospace; font-size: 13px; color: #E54D4D; font-weight: 600;"><?php echo $s['token']; ?></div>
            </div>
            <div style="min-width: 70px; flex-shrink: 0; font-family: monospace; font-size: 12px; color: #78716C;">
                <?php echo $s['px']; ?>px
            </div>
            <div style="font-size: 13px; color: #57534E;"><?php echo $s['usage']; ?></div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Container -->
<section class="ds-section">
    <h2 class="ds-section-title">Container</h2>
    <p class="ds-section-desc">Content is centered with a max-width and horizontal padding.</p>

    <div class="ds-code">max-width: 1120px;
padding: 0 24px;

@media (max-width: 768px) {
  padding: 0 20px;
}</div>
</section>

<!-- Breakpoints -->
<section class="ds-section">
    <h2 class="ds-section-title">Breakpoints</h2>

    <div style="display: flex; gap: 12px; margin-bottom: 24px; flex-wrap: wrap;">
        <?php
        $breakpoints = [
            ['name' => 'sm',  'value' => '480px',  'target' => 'Mobile',              'color' => '#E54D4D'],
            ['name' => 'md',  'value' => '640px',  'target' => 'Mobile landscape',    'color' => '#F59E0B'],
            ['name' => 'lg',  'value' => '768px',  'target' => 'Tablet',              'color' => '#0284C7'],
            ['name' => 'xl',  'value' => '960px',  'target' => 'Tablet landscape',    'color' => '#7C4DFF'],
            ['name' => '2xl', 'value' => '1120px', 'target' => 'Small desktop',       'color' => '#10B981'],
            ['name' => '3xl', 'value' => '1280px', 'target' => 'Desktop',             'color' => '#486581'],
        ];
        foreach ($breakpoints as $bp): ?>
        <div class="ds-card" style="flex: 1; min-width: 160px; text-align: center;">
            <div style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: <?php echo $bp['color']; ?>; margin-bottom: 4px;"><?php echo $bp['name']; ?></div>
            <div style="font-family: monospace; font-size: 18px; font-weight: 700; color: #2C2416;"><?php echo $bp['value']; ?></div>
            <div style="font-size: 12px; color: #78716C; margin-top: 4px;"><?php echo $bp['target']; ?></div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Grid Patterns -->
<section class="ds-section">
    <h2 class="ds-section-title">Grid Patterns</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Content Cards: 3 &rarr; 2 &rarr; 1</h3>
        <div class="ds-code">display: grid;
grid-template-columns: repeat(3, 1fr);
gap: 24px;

@media (max-width: 1024px) { grid-template-columns: repeat(2, 1fr); }
@media (max-width: 600px)  { grid-template-columns: 1fr; }</div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Collection Cards: 2 &rarr; 1</h3>
        <div class="ds-code">display: grid;
grid-template-columns: repeat(2, 1fr);
gap: 24px;

@media (max-width: 768px) { grid-template-columns: 1fr; }</div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Visual Preview</h3>
        <div style="display: flex; gap: 24px;">
            <div style="flex: 1; background: #fff; border: 1px solid #E7E5E4; border-radius: 8px; padding: 16px;">
                <div style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: #A8A29E; margin-bottom: 12px;">Desktop (3 cols)</div>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px;">
                    <div style="height: 40px; background: #FEE2E2; border-radius: 4px;"></div>
                    <div style="height: 40px; background: #FEE2E2; border-radius: 4px;"></div>
                    <div style="height: 40px; background: #FEE2E2; border-radius: 4px;"></div>
                </div>
            </div>
            <div style="flex: 0.7; background: #fff; border: 1px solid #E7E5E4; border-radius: 8px; padding: 16px;">
                <div style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: #A8A29E; margin-bottom: 12px;">Tablet (2 cols)</div>
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px;">
                    <div style="height: 40px; background: #DBEAFE; border-radius: 4px;"></div>
                    <div style="height: 40px; background: #DBEAFE; border-radius: 4px;"></div>
                </div>
            </div>
            <div style="flex: 0.4; background: #fff; border: 1px solid #E7E5E4; border-radius: 8px; padding: 16px;">
                <div style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: #A8A29E; margin-bottom: 12px;">Mobile (1 col)</div>
                <div style="display: grid; grid-template-columns: 1fr; gap: 8px;">
                    <div style="height: 40px; background: #DCFCE7; border-radius: 4px;"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
