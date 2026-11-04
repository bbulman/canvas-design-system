<?php
$ds_page  = 'patterns/patterns';
$ds_title = 'Patterns & Templates';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>Patterns & Templates</h1>
    <p>Reusable page-level patterns, background textures, and section variants used across the platform.</p>
</div>

<!-- Page Backgrounds -->
<section class="ds-section">
    <h2 class="ds-section-title">Page Backgrounds</h2>
    <p class="ds-section-desc">Three background strategies depending on the app context.</p>

    <div class="ds-grid-3">
        <div class="ds-card" style="padding: 0; overflow: hidden;">
            <div style="height: 100px; background: #FEF7F1;"></div>
            <div style="padding: 16px;">
                <div style="font-weight: 600; font-size: 14px; margin-bottom: 4px;">Warm Cream</div>
                <div style="font-size: 12px; color: #78716C;">Default for main site.</div>
                <code style="font-size: 11px; display: block; margin-top: 8px; color: #E54D4D;">--bg-page: #FEF7F1</code>
            </div>
        </div>
        <div class="ds-card" style="padding: 0; overflow: hidden;">
            <div style="height: 100px; background: #FAF7F2; background-image: linear-gradient(rgba(44, 36, 22, 0.12) 1px, transparent 1px), linear-gradient(90deg, rgba(44, 36, 22, 0.12) 1px, transparent 1px); background-size: 24px 24px;"></div>
            <div style="padding: 16px;">
                <div style="font-weight: 600; font-size: 14px; margin-bottom: 4px;">Paper + Grid</div>
                <div style="font-size: 12px; color: #78716C;">Tips, Intervention, Podcasts.</div>
                <code style="font-size: 11px; display: block; margin-top: 8px; color: #E54D4D;">bg-pattern-grid</code>
            </div>
        </div>
        <div class="ds-card" style="padding: 0; overflow: hidden;">
            <div style="height: 100px; background: #FAF7F2; background-image: radial-gradient(circle, rgba(26, 39, 68, 0.08) 1px, transparent 1px); background-size: 16px 16px;"></div>
            <div style="padding: 16px;">
                <div style="font-weight: 600; font-size: 14px; margin-bottom: 4px;">Dot Pattern</div>
                <div style="font-size: 12px; color: #78716C;">Subtle texture layer.</div>
                <code style="font-size: 11px; display: block; margin-top: 8px; color: #E54D4D;">bg-pattern-dots</code>
            </div>
        </div>
    </div>
</section>

<!-- Section Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Section Variants</h2>

    <div style="display: flex; flex-direction: column; gap: 4px; border-radius: 12px; overflow: hidden; border: 1px solid #E7E5E4;">
        <div style="padding: 20px 24px; background: #FFFFFF; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-weight: 600; font-size: 14px; color: #2C2416;">section-light</div>
                <div style="font-size: 12px; color: #78716C;">#FFFFFF -- Standard content sections</div>
            </div>
            <code style="font-size: 11px; color: #A8A29E;">.section-light</code>
        </div>
        <div style="padding: 20px 24px; background: #FAFAF9; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-weight: 600; font-size: 14px; color: #2C2416;">section-alt</div>
                <div style="font-size: 12px; color: #78716C;">gray-50 -- Alternating sections</div>
            </div>
            <code style="font-size: 11px; color: #A8A29E;">.section-alt</code>
        </div>
        <div style="padding: 20px 24px; background: #2C2416; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-weight: 600; font-size: 14px; color: #fff;">section-dark</div>
                <div style="font-size: 12px; color: rgba(255,255,255,0.7);">Ink (#2C2416) -- Footers, features</div>
            </div>
            <code style="font-size: 11px; color: rgba(255,255,255,0.5);">.section-dark</code>
        </div>
        <div style="padding: 20px 24px; background: linear-gradient(135deg, #1A2744 0%, #2E3D5C 100%); display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-weight: 600; font-size: 14px; color: #fff;">section-navy</div>
                <div style="font-size: 12px; color: rgba(255,255,255,0.7);">Navy gradient -- Coach headers, CTAs</div>
            </div>
            <code style="font-size: 11px; color: rgba(255,255,255,0.5);">.section-navy</code>
        </div>
        <div style="padding: 20px 24px; background: #D1FAE5; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-weight: 600; font-size: 14px; color: #166534;">section-accent-green</div>
                <div style="font-size: 12px; color: #166534;">Success tint -- Podcast hosts</div>
            </div>
            <code style="font-size: 11px; color: #166534;">.section-accent-green</code>
        </div>
        <div style="padding: 20px 24px; background: #FEF3C7; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="font-weight: 600; font-size: 14px; color: #92400E;">section-accent-amber</div>
                <div style="font-size: 12px; color: #92400E;">Warning tint -- Tips subscribe</div>
            </div>
            <code style="font-size: 11px; color: #92400E;">.section-accent-amber</code>
        </div>
    </div>
</section>

<!-- Category Icon Gradients -->
<section class="ds-section">
    <h2 class="ds-section-title">Category Icon Gradients</h2>
    <p class="ds-section-desc">Content card icons use gradient-filled containers per category.</p>

    <div style="display: flex; flex-wrap: wrap; gap: 12px;">
        <?php
        $cats = [
            ['name' => 'Ideation/Energizer',  'grad' => '#F59E0B, #D97706'],
            ['name' => 'Strategy/Sprint',      'grad' => '#3B82F6, #2563EB'],
            ['name' => 'Team/Alignment',       'grad' => '#10B981, #059669'],
            ['name' => 'Design/Creative',      'grad' => '#8B5CF6, #7C3AED'],
            ['name' => 'Feedback/Retro',       'grad' => '#EC4899, #DB2777'],
            ['name' => 'Remote/Innovation',    'grad' => '#06B6D4, #0891B2'],
            ['name' => 'Default',              'grad' => '#E54D4D, #C73E3E'],
        ];
        foreach ($cats as $cat): ?>
        <div style="display: flex; align-items: center; gap: 10px; background: #fff; border: 1px solid #E7E5E4; border-radius: 8px; padding: 10px 16px;">
            <div style="width: 40px; height: 40px; background: linear-gradient(135deg, <?php echo $cat['grad']; ?>); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <span class="material-symbols-outlined" style="font-size: 20px; color: #fff;">lightbulb</span>
            </div>
            <span style="font-size: 13px; font-weight: 500; color: #57534E;"><?php echo $cat['name']; ?></span>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- App Switcher -->
<section class="ds-section">
    <h2 class="ds-section-title">App Switcher (Property Switcher)</h2>
    <p class="ds-section-desc">Global navigation component for switching between Workshopr applications. Appears in the unified header.</p>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Trigger Button</div>
        <div class="ds-card">
            <div style="display: flex; align-items: center; gap: 16px; flex-wrap: wrap;">
                <!-- Example trigger -->
                <div style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 12px; background: #FAFAF9; border-radius: 8px; cursor: pointer;">
                    <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(229, 77, 77, 0.1); display: flex; align-items: center; justify-content: center;">
                        <span class="material-symbols-outlined" style="font-size: 18px; color: #E54D4D;">menu_book</span>
                    </div>
                    <span style="font-family: var(--font-heading); font-size: 15px; font-weight: 600; color: #1A2744;">Library</span>
                    <span class="material-symbols-outlined" style="font-size: 20px; color: #A8A29E;">expand_more</span>
                </div>
                <div style="font-size: 13px; color: #78716C;">→ Click to open dropdown</div>
            </div>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Dropdown Structure</div>
        <div class="ds-card" style="background: #FAFAF9;">
            <div style="background: #fff; border: 1px solid #E7E5E4; border-radius: 12px; padding: 16px; max-width: 640px;">
                <!-- Two column grid -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                    <!-- Learn Phase -->
                    <div>
                        <div style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #A8A29E; padding: 0 8px 8px; border-bottom: 1px solid #F5F5F4; margin-bottom: 8px;">Learn</div>
                        <div style="display: flex; flex-direction: column; gap: 4px;">
                            <div style="display: flex; align-items: center; gap: 12px; padding: 10px 12px; border-radius: 8px; background: rgba(229, 77, 77, 0.08);">
                                <div style="width: 36px; height: 36px; border-radius: 8px; background: rgba(229, 77, 77, 0.1); display: flex; align-items: center; justify-content: center;">
                                    <span class="material-symbols-outlined" style="font-size: 20px; color: #E54D4D;">menu_book</span>
                                </div>
                                <div>
                                    <div style="font-size: 14px; font-weight: 500; color: #1A2744;">Library</div>
                                    <div style="font-size: 12px; color: #78716C;">Browse exercises</div>
                                </div>
                                <span class="material-symbols-outlined" style="font-size: 18px; color: #E54D4D; margin-left: auto;">check</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 12px; padding: 10px 12px; border-radius: 8px;">
                                <div style="width: 36px; height: 36px; border-radius: 8px; background: #FEE2E2; display: flex; align-items: center; justify-content: center;">
                                    <span class="material-symbols-outlined" style="font-size: 20px; color: #F87171;">tips_and_updates</span>
                                </div>
                                <div>
                                    <div style="font-size: 14px; font-weight: 500; color: #1A2744;">Tips</div>
                                    <div style="font-size: 12px; color: #78716C;">Quick advice</div>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 12px; padding: 10px 12px; border-radius: 8px;">
                                <div style="width: 36px; height: 36px; border-radius: 8px; background: #FFE4E6; display: flex; align-items: center; justify-content: center;">
                                    <span class="material-symbols-outlined" style="font-size: 20px; color: #BE123C;">podcasts</span>
                                </div>
                                <div>
                                    <div style="font-size: 14px; font-weight: 500; color: #1A2744;">Podcasts</div>
                                    <div style="font-size: 12px; color: #78716C;">Audio content</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Plan & Facilitate Phase -->
                    <div>
                        <div style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #A8A29E; padding: 0 8px 8px; border-bottom: 1px solid #F5F5F4; margin-bottom: 8px;">Plan & Facilitate</div>
                        <div style="display: flex; flex-direction: column; gap: 4px;">
                            <div style="display: flex; align-items: center; gap: 12px; padding: 10px 12px; border-radius: 8px;">
                                <div style="width: 36px; height: 36px; border-radius: 8px; background: rgba(2, 132, 199, 0.1); display: flex; align-items: center; justify-content: center;">
                                    <span class="material-symbols-outlined" style="font-size: 20px; color: #0284C7;">calendar_month</span>
                                </div>
                                <div>
                                    <div style="font-size: 14px; font-weight: 500; color: #1A2744;">Planner</div>
                                    <div style="font-size: 12px; color: #78716C;">Build agendas</div>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 12px; padding: 10px 12px; border-radius: 8px;">
                                <div style="width: 36px; height: 36px; border-radius: 8px; background: rgba(124, 77, 255, 0.1); display: flex; align-items: center; justify-content: center;">
                                    <span class="material-symbols-outlined" style="font-size: 20px; color: #7C4DFF;">smart_toy</span>
                                </div>
                                <div>
                                    <div style="font-size: 14px; font-weight: 500; color: #1A2744;">Coach</div>
                                    <div style="font-size: 12px; color: #78716C;">AI assistant</div>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 12px; padding: 10px 12px; border-radius: 8px;">
                                <div style="width: 36px; height: 36px; border-radius: 8px; background: rgba(124, 77, 255, 0.1); display: flex; align-items: center; justify-content: center;">
                                    <span class="material-symbols-outlined" style="font-size: 20px; color: #7C4DFF;">style</span>
                                </div>
                                <div>
                                    <div style="font-size: 14px; font-weight: 500; color: #1A2744;">Interventions</div>
                                    <div style="font-size: 12px; color: #78716C;">Response cards</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">App Colors Reference</div>
        <table class="ds-table">
            <thead>
                <tr>
                    <th>App</th>
                    <th>Phase</th>
                    <th>Primary Color</th>
                    <th>CSS Variable</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Library</strong></td>
                    <td>Learn</td>
                    <td><span style="display: inline-flex; align-items: center; gap: 6px;"><span style="width: 12px; height: 12px; background: #E54D4D; border-radius: 3px;"></span> #E54D4D</span></td>
                    <td><code>--mainsite-primary</code></td>
                </tr>
                <tr>
                    <td><strong>Tips</strong></td>
                    <td>Learn</td>
                    <td><span style="display: inline-flex; align-items: center; gap: 6px;"><span style="width: 12px; height: 12px; background: #F87171; border-radius: 3px;"></span> #F87171</span></td>
                    <td><code>--tips-primary</code></td>
                </tr>
                <tr>
                    <td><strong>Podcasts</strong></td>
                    <td>Learn</td>
                    <td><span style="display: inline-flex; align-items: center; gap: 6px;"><span style="width: 12px; height: 12px; background: #BE123C; border-radius: 3px;"></span> #BE123C</span></td>
                    <td><code>--podcasts-primary</code></td>
                </tr>
                <tr>
                    <td><strong>Planner</strong></td>
                    <td>Plan</td>
                    <td><span style="display: inline-flex; align-items: center; gap: 6px;"><span style="width: 12px; height: 12px; background: #0284C7; border-radius: 3px;"></span> #0284C7</span></td>
                    <td><code>--planner-primary</code></td>
                </tr>
                <tr>
                    <td><strong>Coach</strong></td>
                    <td>Facilitate</td>
                    <td><span style="display: inline-flex; align-items: center; gap: 6px;"><span style="width: 12px; height: 12px; background: #7C4DFF; border-radius: 3px;"></span> #7C4DFF</span></td>
                    <td><code>--coach-primary</code></td>
                </tr>
                <tr>
                    <td><strong>Interventions</strong></td>
                    <td>Facilitate</td>
                    <td><span style="display: inline-flex; align-items: center; gap: 6px;"><span style="width: 12px; height: 12px; background: #7C4DFF; border-radius: 3px;"></span> #7C4DFF</span></td>
                    <td><code>--intervention-primary</code></td>
                </tr>
                <tr>
                    <td><strong>Training</strong></td>
                    <td>Reflect</td>
                    <td><span style="display: inline-flex; align-items: center; gap: 6px;"><span style="width: 12px; height: 12px; background: #10B981; border-radius: 3px;"></span> #10B981</span></td>
                    <td><code>--training-primary</code></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="ds-note">
        <span class="material-symbols-outlined">info</span>
        <div>CSS: <code>ws_header</code> (<code>includes/components/header.php</code>) emits its own styles; the app switcher is built in. Pass the section as the first argument, e.g. <code>ws_header('coach')</code>.</div>
    </div>
</section>

<!-- User Menu / Sign-in Dropdown -->
<section class="ds-section">
    <h2 class="ds-section-title">User Menu & Sign-in</h2>
    <p class="ds-section-desc">Authentication states and user account dropdown in the unified header.</p>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Logged Out State</div>
        <div class="ds-card">
            <div style="display: flex; align-items: center; gap: 16px; flex-wrap: wrap;">
                <a href="#" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; background: linear-gradient(135deg, #E54D4D 0%, #C73E3E 100%); color: #fff; border-radius: 8px; font-size: 14px; font-weight: 600; text-decoration: none;">
                    <span class="material-symbols-outlined" style="font-size: 18px;">login</span>
                    Sign In
                </a>
                <div style="font-size: 13px; color: #78716C;">Primary CTA button with app gradient</div>
            </div>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Logged In - Trigger</div>
        <div class="ds-card">
            <div style="display: flex; align-items: center; gap: 16px; flex-wrap: wrap;">
                <div style="display: inline-flex; align-items: center; gap: 8px; padding: 4px 8px 4px 4px; border: 1px solid transparent; border-radius: 100px; cursor: pointer;">
                    <div style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #E54D4D 0%, #C73E3E 100%); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 13px; font-weight: 600;">JD</div>
                    <span style="font-size: 14px; font-weight: 500; color: #1A2744;">Jane</span>
                    <span class="material-symbols-outlined" style="font-size: 18px; color: #A8A29E;">expand_more</span>
                </div>
                <div style="font-size: 13px; color: #78716C;">Avatar + name + chevron</div>
            </div>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">User Dropdown</div>
        <div class="ds-card" style="background: #FAFAF9;">
            <div style="background: #fff; border: 1px solid #E7E5E4; border-radius: 12px; padding: 8px; max-width: 280px;">
                <!-- Header -->
                <div style="display: flex; align-items: center; gap: 12px; padding: 12px; border-bottom: 1px solid #F5F5F4; margin-bottom: 8px;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #E54D4D 0%, #C73E3E 100%); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 15px; font-weight: 600;">JD</div>
                    <div>
                        <div style="font-size: 14px; font-weight: 600; color: #1A2744;">Jane Doe</div>
                        <div style="font-size: 12px; color: #78716C;">jane@company.com</div>
                        <span style="display: inline-block; margin-top: 4px; padding: 2px 8px; font-size: 10px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; border-radius: 100px; background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); color: #D97706;">Pro</span>
                    </div>
                </div>
                <!-- Menu items -->
                <div style="display: flex; flex-direction: column; gap: 2px;">
                    <a href="#" style="display: flex; align-items: center; gap: 10px; padding: 10px 12px; font-size: 14px; color: #44403C; text-decoration: none; border-radius: 8px;">
                        <span class="material-symbols-outlined" style="font-size: 18px; color: #A8A29E;">dashboard</span>
                        My Dashboard
                    </a>
                    <a href="#" style="display: flex; align-items: center; gap: 10px; padding: 10px 12px; font-size: 14px; color: #44403C; text-decoration: none; border-radius: 8px;">
                        <span class="material-symbols-outlined" style="font-size: 18px; color: #A8A29E;">bookmark</span>
                        Saved Items
                    </a>
                    <a href="#" style="display: flex; align-items: center; gap: 10px; padding: 10px 12px; font-size: 14px; color: #44403C; text-decoration: none; border-radius: 8px;">
                        <span class="material-symbols-outlined" style="font-size: 18px; color: #A8A29E;">settings</span>
                        Settings
                    </a>
                    <div style="height: 1px; background: #F5F5F4; margin: 4px 0;"></div>
                    <a href="#" style="display: flex; align-items: center; gap: 10px; padding: 10px 12px; font-size: 14px; color: #E54D4D; text-decoration: none; border-radius: 8px;">
                        <span class="material-symbols-outlined" style="font-size: 18px; color: #E54D4D;">logout</span>
                        Sign Out
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Account Type Badges</div>
        <div style="display: flex; gap: 12px; flex-wrap: wrap;">
            <span style="padding: 3px 10px; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; border-radius: 100px; background: #F5F5F4; color: #57534E;">Free</span>
            <span style="padding: 3px 10px; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; border-radius: 100px; background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); color: #D97706;">Pro</span>
            <span style="padding: 3px 10px; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; border-radius: 100px; background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); color: #2563EB;">Team</span>
        </div>
    </div>
</section>

<!-- Standard Page Template -->
<section class="ds-section">
    <h2 class="ds-section-title">Standard Page Template</h2>
    <p class="ds-section-desc">Every page follows this PHP template structure.</p>

    <div class="ds-code">&lt;?php
$page_title = 'Page Title';
require_once 'includes/data.php';
require_once 'includes/header.php';
?&gt;

&lt;div class="container"&gt;
  &lt;h1&gt;Page Title&lt;/h1&gt;
  &lt;!-- content --&gt;
&lt;/div&gt;

&lt;?php require_once 'includes/footer.php'; ?&gt;</div>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
