<?php
$ds_page  = 'foundations/elevation';
$ds_title = 'Elevation & Depth';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>Elevation & Depth</h1>
    <p>Surface color plus subtle shadow creates visual hierarchy. Cards sit on tinted backgrounds with shadows reinforcing the lift.</p>
</div>

<!-- Elevation Levels -->
<section class="ds-section">
    <h2 class="ds-section-title">Elevation Levels</h2>

    <div style="display: flex; flex-wrap: wrap; gap: 16px; margin-bottom: 24px;">
        <?php
        $elevations = [
            ['level' => '0', 'token' => '--elevation-0', 'shadow' => 'none',                           'usage' => 'Flat, disabled'],
            ['level' => '1', 'token' => '--shadow-xs',    'shadow' => '0 1px 2px rgba(0,0,0,0.04)',    'usage' => 'Inputs, subtle lift'],
            ['level' => '2', 'token' => '--shadow-sm',    'shadow' => '0 1px 3px rgba(0,0,0,0.06)',    'usage' => 'Cards at rest'],
            ['level' => '3', 'token' => '--shadow-md',    'shadow' => '0 4px 6px rgba(0,0,0,0.07)',    'usage' => 'Cards, panels'],
            ['level' => '4', 'token' => '--shadow-lg',    'shadow' => '0 10px 15px rgba(0,0,0,0.08)',  'usage' => 'Card hover, dropdowns'],
            ['level' => '5', 'token' => '--shadow-xl',    'shadow' => '0 20px 25px rgba(0,0,0,0.10)',  'usage' => 'Modals, popovers'],
        ];
        foreach ($elevations as $e): ?>
        <div style="flex: 1; min-width: 140px; background: #fff; border-radius: 12px; padding: 24px; text-align: center; box-shadow: <?php echo $e['shadow']; ?>; <?php echo $e['shadow'] === 'none' ? 'border: 1px solid #E7E5E4;' : ''; ?>">
            <div style="font-size: 28px; font-weight: 700; color: #1A2744; margin-bottom: 4px;"><?php echo $e['level']; ?></div>
            <div style="font-family: monospace; font-size: 11px; color: #E54D4D; margin-bottom: 4px;"><?php echo $e['token']; ?></div>
            <div style="font-size: 12px; color: #78716C;"><?php echo $e['usage']; ?></div>
        </div>
        <?php endforeach; ?>
    </div>

    <table class="ds-table">
        <thead><tr><th>Level</th><th>Token</th><th>Shadow Value</th><th>Usage</th></tr></thead>
        <tbody>
            <?php foreach ($elevations as $e): ?>
            <tr>
                <td><?php echo $e['level']; ?></td>
                <td><code><?php echo $e['token']; ?></code></td>
                <td><code style="font-size: 11px;"><?php echo $e['shadow']; ?></code></td>
                <td><?php echo $e['usage']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<!-- Colored Shadows -->
<section class="ds-section">
    <h2 class="ds-section-title">Colored Shadows (CTAs)</h2>
    <p class="ds-section-desc">Each app has a colored shadow token for call-to-action buttons.</p>

    <div class="ds-grid-3">
        <div style="background: #fff; border-radius: 12px; padding: 20px; text-align: center; box-shadow: 0 4px 14px rgba(229, 77, 77, 0.25);">
            <div style="font-weight: 600; color: #E54D4D; margin-bottom: 4px;">Main Site</div>
            <code style="font-size: 11px; background: #F5F5F4; padding: 2px 6px; border-radius: 4px;">--mainsite-shadow</code>
        </div>
        <div style="background: #fff; border-radius: 12px; padding: 20px; text-align: center; box-shadow: 0 4px 14px rgba(2, 132, 199, 0.25);">
            <div style="font-weight: 600; color: #0284C7; margin-bottom: 4px;">Planner</div>
            <code style="font-size: 11px; background: #F5F5F4; padding: 2px 6px; border-radius: 4px;">--planner-shadow</code>
        </div>
        <div style="background: #fff; border-radius: 12px; padding: 20px; text-align: center; box-shadow: 0 4px 14px rgba(124, 77, 255, 0.25);">
            <div style="font-weight: 600; color: #7C4DFF; margin-bottom: 4px;">Coach</div>
            <code style="font-size: 11px; background: #F5F5F4; padding: 2px 6px; border-radius: 4px;">--coach-shadow</code>
        </div>
    </div>
</section>

<!-- Interactive Elevation -->
<section class="ds-section">
    <h2 class="ds-section-title">Interactive Elevation Pattern</h2>
    <p class="ds-section-desc">Cards lift on hover using a combination of shadow increase and Y translation.</p>

    <div style="display: flex; gap: 24px; align-items: center; justify-content: center; padding: 40px; background: #FEF7F1; border-radius: 12px; border: 1px solid #E7E5E4; margin-bottom: 16px;">
        <div style="background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); width: 200px; text-align: center;">
            <div style="font-weight: 600; margin-bottom: 4px;">At Rest</div>
            <div style="font-size: 12px; color: #78716C;">shadow-sm</div>
        </div>
        <span class="material-symbols-outlined" style="font-size: 24px; color: #D6D3D1;">arrow_forward</span>
        <div style="background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 10px 15px rgba(0,0,0,0.08); transform: translateY(-2px); width: 200px; text-align: center;">
            <div style="font-weight: 600; margin-bottom: 4px;">On Hover</div>
            <div style="font-size: 12px; color: #78716C;">shadow-lg + translateY(-2px)</div>
        </div>
    </div>

    <div class="ds-code">.card {
  box-shadow: var(--shadow-sm);
  transition: box-shadow 200ms ease, transform 200ms ease;
}

.card:hover {
  box-shadow: var(--shadow-lg);
  transform: translateY(-2px);
}</div>
</section>

<!-- Focus Rings -->
<section class="ds-section">
    <h2 class="ds-section-title">Focus Rings</h2>
    <p class="ds-section-desc">All interactive elements get a 3px focus ring in the app's light accent color.</p>

    <div class="ds-code">/* Standard focus ring (main site) */
box-shadow: 0 0 0 3px #FEE2E2;  /* var(--phase-learn-light) */

/* Per-app focus rings */
box-shadow: 0 0 0 3px var(--planner-very-light);  /* Planner */
box-shadow: 0 0 0 3px var(--coach-very-light);     /* Coach */</div>
</section>

<!-- Z-Index -->
<section class="ds-section">
    <h2 class="ds-section-title">Z-Index Scale</h2>

    <div style="display: flex; flex-direction: column; gap: 4px;">
        <?php
        $zindexes = [
            ['token' => '--z-dropdown',       'value' => '100',  'color' => '#D6D3D1'],
            ['token' => '--z-sticky',         'value' => '200',  'color' => '#A8A29E'],
            ['token' => '--z-modal-backdrop',  'value' => '400',  'color' => '#78716C'],
            ['token' => '--z-modal',          'value' => '500',  'color' => '#57534E'],
            ['token' => '--z-tooltip',        'value' => '600',  'color' => '#44403C'],
            ['token' => 'FAB',                'value' => '999',  'color' => '#E54D4D'],
            ['token' => 'Toast',              'value' => '1000', 'color' => '#292524'],
        ];
        foreach ($zindexes as $z): ?>
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="width: <?php echo min(100, intval($z['value']) / 10); ?>%; height: 32px; background: <?php echo $z['color']; ?>; border-radius: 0 6px 6px 0; display: flex; align-items: center; padding-left: 12px; min-width: 60px;">
                <span style="font-size: 12px; font-weight: 600; color: <?php echo intval($z['value']) >= 400 ? '#fff' : '#2C2416'; ?>;"><?php echo $z['value']; ?></span>
            </div>
            <span style="font-family: monospace; font-size: 13px; color: #57534E;"><?php echo $z['token']; ?></span>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
