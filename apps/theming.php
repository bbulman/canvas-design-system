<?php
$ds_page  = 'apps/theming';
$ds_title = 'App Theming';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>App Theming</h1>
    <p>Each app overrides a small set of accent tokens while sharing the full design foundation. Import the shared token file, then layer app-specific accents.</p>
</div>

<div class="ds-code" style="margin-bottom: 32px;">/* Import shared tokens in any app */
@import '/design-system/platform-tokens.css';

/* Then use app-specific tokens for accents */
.btn-primary { background: var(--tips-gradient); }
.btn-primary:hover { box-shadow: var(--tips-shadow); }</div>

<!-- Learn Phase -->
<section class="ds-section">
    <h2 class="ds-section-title" style="display: flex; align-items: center; gap: 10px;">
        <span style="width: 12px; height: 12px; background: #E54D4D; border-radius: 4px;"></span>
        Learn Phase
    </h2>

    <?php
    $learn_apps = [
        [
            'name' => 'Main Site', 'url' => 'workshopr.io',
            'desc' => 'Brand red -- the anchor color.',
            'tokens' => [
                ['token' => '--mainsite-primary',    'hex' => '#E54D4D'],
                ['token' => '--mainsite-dark',       'hex' => '#C73E3E'],
                ['token' => '--mainsite-light',      'hex' => '#FEE2E2'],
                ['token' => '--mainsite-very-light', 'hex' => '#FEF2F2'],
            ],
        ],
        [
            'name' => 'Academy / Training', 'url' => '/academy',
            'desc' => 'Learn red -- the upskilling arm. (An earlier "Reflect green" mapping was never implemented and has been retired.)',
            'tokens' => [
                ['token' => '--training-primary',    'hex' => '#E54D4D'],
                ['token' => '--training-dark',       'hex' => '#C73E3E'],
                ['token' => '--training-light',      'hex' => '#FEE2E2'],
                ['token' => '--training-very-light', 'hex' => '#FEF2F2'],
            ],
        ],
        [
            'name' => 'Podcasts', 'url' => '/podcasts',
            'desc' => 'Crimson red -- deeper, richer. Audio studio aesthetic.',
            'tokens' => [
                ['token' => '--podcasts-primary',    'hex' => '#BE123C'],
                ['token' => '--podcasts-dark',       'hex' => '#9F1239'],
                ['token' => '--podcasts-light',      'hex' => '#FECDD3'],
                ['token' => '--podcasts-very-light', 'hex' => '#FFE4E6'],
            ],
        ],
    ];
    foreach ($learn_apps as $app): ?>
    <div class="ds-card" style="margin-bottom: 16px;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
            <div>
                <div style="font-weight: 600; font-size: 16px; color: #2C2416;"><?php echo $app['name']; ?></div>
                <div style="font-size: 13px; color: #78716C;"><?php echo $app['desc']; ?></div>
            </div>
            <code style="font-size: 12px; color: #A8A29E;"><?php echo $app['url']; ?></code>
        </div>
        <div style="display: flex; gap: 8px;">
            <?php foreach ($app['tokens'] as $t): ?>
            <div style="flex: 1; text-align: center;">
                <div style="height: 40px; background: <?php echo $t['hex']; ?>; border-radius: 6px; margin-bottom: 6px;<?php echo $t['hex'] === '#FEE2E2' || $t['hex'] === '#FEF2F2' || $t['hex'] === '#FECACA' || $t['hex'] === '#FECDD3' || $t['hex'] === '#FFE4E6' ? 'border: 1px solid #E7E5E4;' : ''; ?>"></div>
                <div style="font-family: monospace; font-size: 10px; color: #78716C;"><?php echo $t['token']; ?></div>
                <div style="font-family: monospace; font-size: 10px; color: #A8A29E;"><?php echo $t['hex']; ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>
</section>

<!-- Plan Phase -->
<section class="ds-section">
    <h2 class="ds-section-title" style="display: flex; align-items: center; gap: 10px;">
        <span style="width: 12px; height: 12px; background: #0284C7; border-radius: 4px;"></span>
        Plan Phase
    </h2>

    <div class="ds-card">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
            <div>
                <div style="font-weight: 600; font-size: 16px; color: #2C2416;">Planner</div>
                <div style="font-size: 13px; color: #78716C;">Cold sky blue -- focused, professional SaaS feel.</div>
            </div>
            <code style="font-size: 12px; color: #A8A29E;">/planner</code>
        </div>
        <div style="display: flex; gap: 8px;">
            <?php
            $planner = [
                ['token' => '--planner-primary',    'hex' => '#0284C7'],
                ['token' => '--planner-dark',       'hex' => '#075985'],
                ['token' => '--planner-light',      'hex' => '#BAE6FD'],
                ['token' => '--planner-very-light', 'hex' => '#E0F2FE'],
            ];
            foreach ($planner as $t): ?>
            <div style="flex: 1; text-align: center;">
                <div style="height: 40px; background: <?php echo $t['hex']; ?>; border-radius: 6px; margin-bottom: 6px;<?php echo $t['hex'] === '#BAE6FD' || $t['hex'] === '#E0F2FE' ? 'border: 1px solid #E7E5E4;' : ''; ?>"></div>
                <div style="font-family: monospace; font-size: 10px; color: #78716C;"><?php echo $t['token']; ?></div>
                <div style="font-family: monospace; font-size: 10px; color: #A8A29E;"><?php echo $t['hex']; ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Facilitate Phase -->
<section class="ds-section">
    <h2 class="ds-section-title" style="display: flex; align-items: center; gap: 10px;">
        <span style="width: 12px; height: 12px; background: #7C4DFF; border-radius: 4px;"></span>
        Facilitate Phase
    </h2>

    <div class="ds-card" style="margin-bottom: 16px;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
            <div>
                <div style="font-weight: 600; font-size: 16px; color: #2C2416;">Coach</div>
                <div style="font-size: 13px; color: #78716C;">Purple with a tri-color mode system for the facilitator workflow.</div>
            </div>
            <code style="font-size: 12px; color: #A8A29E;">/coach</code>
        </div>
        <div style="display: flex; gap: 8px; margin-bottom: 16px;">
            <?php
            $coach = [
                ['token' => '--coach-primary',    'hex' => '#7C4DFF'],
                ['token' => '--coach-dark',       'hex' => '#6D28D9'],
                ['token' => '--coach-light',      'hex' => '#DDD6FE'],
                ['token' => '--coach-very-light', 'hex' => '#EDE9FE'],
            ];
            foreach ($coach as $t): ?>
            <div style="flex: 1; text-align: center;">
                <div style="height: 40px; background: <?php echo $t['hex']; ?>; border-radius: 6px; margin-bottom: 6px;<?php echo $t['hex'] === '#DDD6FE' || $t['hex'] === '#EDE9FE' ? 'border: 1px solid #E7E5E4;' : ''; ?>"></div>
                <div style="font-family: monospace; font-size: 10px; color: #78716C;"><?php echo $t['token']; ?></div>
            </div>
            <?php endforeach; ?>
        </div>

        <div style="font-size: 13px; font-weight: 600; color: #44403C; margin-bottom: 8px;">Mode Colors (4 purple tints)</div>
        <div style="display: flex; gap: 8px;">
            <?php
            $modes = [
                ['label' => 'Prep',       'hex' => '#A78BFA'],
                ['label' => 'Facilitate', 'hex' => '#8B5CF6'],
                ['label' => 'Synthesize', 'hex' => '#7C3AED'],
                ['label' => 'Debrief',    'hex' => '#6D28D9'],
            ];
            foreach ($modes as $m): ?>
            <div style="flex: 1; text-align: center;">
                <div style="height: 32px; background: <?php echo $m['hex']; ?>; border-radius: 6px; margin-bottom: 4px;"></div>
                <div style="font-size: 11px; font-weight: 500; color: #57534E;"><?php echo $m['label']; ?></div>
                <div style="font-family: monospace; font-size: 10px; color: #A8A29E;"><?php echo $m['hex']; ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="ds-card">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
            <div>
                <div style="font-weight: 600; font-size: 16px; color: #2C2416;">Intervention</div>
                <div style="font-size: 13px; color: #78716C;">Purple with 6 category tints. Uses paper background + grid pattern.</div>
            </div>
            <code style="font-size: 12px; color: #A8A29E;">/intervention</code>
        </div>
        <div style="display: flex; gap: 6px;">
            <?php
            $intCats = [
                ['label' => 'Cat 1', 'hex' => '#4C1D95'],
                ['label' => 'Cat 2', 'hex' => '#5B21B6'],
                ['label' => 'Cat 3', 'hex' => '#6D28D9'],
                ['label' => 'Cat 4', 'hex' => '#7C3AED'],
                ['label' => 'Cat 5', 'hex' => '#8B5CF6'],
                ['label' => 'Cat 6', 'hex' => '#A78BFA'],
            ];
            foreach ($intCats as $ic): ?>
            <div style="flex: 1; height: 40px; background: <?php echo $ic['hex']; ?>; border-radius: 6px;"></div>
            <?php endforeach; ?>
        </div>
        <div style="display: flex; gap: 6px; margin-top: 4px;">
            <?php foreach ($intCats as $ic): ?>
            <div style="flex: 1; text-align: center; font-family: monospace; font-size: 9px; color: #A8A29E;"><?php echo $ic['hex']; ?></div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="ds-card" style="margin-top: 16px;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
            <div>
                <div style="font-weight: 600; font-size: 16px; color: #2C2416;">Tips <span style="font-size: 11px; color: #7C4DFF; font-weight: 600; letter-spacing: 0.04em;">&middot; EXCEPTION</span></div>
                <div style="font-size: 13px; color: #78716C;">Learn-phase <em>content</em> that deliberately ships Facilitate purple, not Learn red &mdash; the one sanctioned cross-phase color. Uses paper background + grid pattern.</div>
            </div>
            <code style="font-size: 12px; color: #A8A29E;">/tips</code>
        </div>
        <div style="display: flex; gap: 8px;">
            <?php
            $tips = [
                ['token' => '--tips-primary',    'hex' => '#7C4DFF'],
                ['token' => '--tips-dark',       'hex' => '#6930C3'],
                ['token' => '--tips-light',      'hex' => '#E8DEFF'],
                ['token' => '--tips-very-light', 'hex' => '#F3EEFF'],
            ];
            foreach ($tips as $t): ?>
            <div style="flex: 1; text-align: center;">
                <div style="height: 40px; background: <?php echo $t['hex']; ?>; border-radius: 6px; margin-bottom: 6px;<?php echo $t['hex'] === '#E8DEFF' || $t['hex'] === '#F3EEFF' ? 'border: 1px solid #E7E5E4;' : ''; ?>"></div>
                <div style="font-family: monospace; font-size: 10px; color: #78716C;"><?php echo $t['token']; ?></div>
                <div style="font-family: monospace; font-size: 10px; color: #A8A29E;"><?php echo $t['hex']; ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Reflect Phase -->
<section class="ds-section">
    <h2 class="ds-section-title" style="display: flex; align-items: center; gap: 10px;">
        <span style="width: 12px; height: 12px; background: #10B981; border-radius: 4px;"></span>
        Reflect Phase
    </h2>

    <div class="ds-card">
        <div style="font-weight: 600; font-size: 16px; color: #2C2416; margin-bottom: 2px;">DNA <span style="font-size: 12px; color: #A8A29E; font-weight: 400;">Coming Soon</span></div>
        <div style="font-size: 13px; color: #78716C; margin-bottom: 12px;">The only Reflect-phase app. Surface primary is the lighter <code>#34D399</code>; the phase anchor is <code>#10B981</code>. 5 category tints. (Academy/Training is <a href="<?= $ds_base ?>/apps/theming.php#learn">Learn red</a>, not Reflect green.)</div>
        <div style="display: flex; gap: 6px;">
            <?php foreach (['#047857','#059669','#10B981','#34D399','#6EE7B7'] as $hex): ?>
            <div style="flex: 1; height: 32px; background: <?php echo $hex; ?>; border-radius: 4px;"></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Token pattern -->
<section class="ds-section">
    <h2 class="ds-section-title">Token Naming Pattern</h2>
    <p class="ds-section-desc">Every app follows this naming convention.</p>

    <div class="ds-code">--{app}-primary      /* Main accent color */
--{app}-dark         /* Hover/pressed state */
--{app}-light        /* Focus rings, highlights */
--{app}-very-light   /* Subtle tint backgrounds */
--{app}-gradient     /* 135deg gradient */
--{app}-shadow       /* Colored shadow for CTAs */</div>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
