<?php
$ds_page  = 'foundations/icons';
$ds_title = 'Icons';

require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>Icons</h1>
    <p>Workshopr uses Material Symbols as the primary icon library, with a curated set of 339 SVG icons for offline/static use.</p>
</div>

<!-- Icon System Overview -->
<section class="ds-section">
    <h2 class="ds-section-title">Icon System</h2>
    <p class="ds-section-desc">Two icon systems are used depending on context.</p>

    <div class="ds-grid-2">
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 12px; color: #1A2744;">Material Symbols (Primary)</div>
            <p style="font-size: 14px; color: #57534E; margin-bottom: 12px;">Google's variable icon font. Used for dynamic UI, interactive elements, and anywhere icons need to be easily changed.</p>
            <div class="ds-code" style="font-size: 12px;">&lt;span class="material-symbols-outlined"&gt;lightbulb&lt;/span&gt;</div>
            <div style="margin-top: 12px; font-size: 13px; color: #78716C;">
                <strong>339 icons</strong> currently in use across the platform
            </div>
        </div>
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 12px; color: #1A2744;">SVG Icons (Static)</div>
            <p style="font-size: 14px; color: #57534E; margin-bottom: 12px;">Pre-exported SVGs in <code>/images/icons/</code>. Used for email templates, PDFs, and contexts without font loading.</p>
            <div class="ds-code" style="font-size: 12px;">&lt;img src="/images/icons/lightbulb.svg" alt=""&gt;</div>
            <div style="margin-top: 12px; font-size: 13px; color: #78716C;">
                <strong>339 SVG files</strong> matching Material Symbols names
            </div>
        </div>
    </div>

    <div class="ds-note" style="margin-top: 16px;">
        <span class="material-symbols-outlined">info</span>
        <div>The PHP helper <code>icon('name')</code> in <code>includes/icon.php</code> renders Material Symbols with consistent styling. Use this for all dynamic icon rendering.</div>
    </div>
</section>

<!-- High-Frequency Icons -->
<section class="ds-section">
    <h2 class="ds-section-title">High-Frequency Icons</h2>
    <p class="ds-section-desc">The most commonly used icons across the platform.</p>

    <div class="ds-card">
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 16px;">
            <?php
            $highFrequency = [
                ['name' => 'expand_more', 'uses' => 34, 'context' => 'Dropdowns'],
                ['name' => 'check', 'uses' => 26, 'context' => 'Selection'],
                ['name' => 'arrow_forward', 'uses' => 25, 'context' => 'Navigation'],
                ['name' => 'schedule', 'uses' => 22, 'context' => 'Time/Duration'],
                ['name' => 'lightbulb', 'uses' => 18, 'context' => 'Ideas/Tips'],
                ['name' => 'groups', 'uses' => 18, 'context' => 'Team activities'],
                ['name' => 'close', 'uses' => 16, 'context' => 'Dismiss/Close'],
                ['name' => 'psychology', 'uses' => 12, 'context' => 'Facilitation'],
                ['name' => 'play_arrow', 'uses' => 10, 'context' => 'Start/Play'],
                ['name' => 'auto_awesome', 'uses' => 10, 'context' => 'AI features'],
                ['name' => 'podcasts', 'uses' => 9, 'context' => 'Audio content'],
                ['name' => 'edit_note', 'uses' => 9, 'context' => 'Notes/Edit'],
                ['name' => 'info', 'uses' => 8, 'context' => 'Information'],
                ['name' => 'save', 'uses' => 7, 'context' => 'Save action'],
                ['name' => 'add', 'uses' => 7, 'context' => 'Add/Create'],
                ['name' => 'arrow_back', 'uses' => 7, 'context' => 'Back nav'],
            ];
            foreach ($highFrequency as $icon): ?>
            <div style="text-align: center; padding: 12px; border: 1px solid #E7E5E4; border-radius: 8px;">
                <span class="material-symbols-outlined" style="font-size: 28px; color: #1A2744;"><?= $icon['name'] ?></span>
                <div style="font-size: 11px; font-weight: 500; color: #44403C; margin-top: 8px;"><?= $icon['name'] ?></div>
                <div style="font-size: 10px; color: #A8A29E; margin-top: 2px;"><?= $icon['context'] ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Navigation & Actions -->
<section class="ds-section">
    <h2 class="ds-section-title">Navigation & Actions</h2>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Navigation</div>
        <div class="ds-card">
            <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                <?php
                $navIcons = ['arrow_back', 'arrow_forward', 'expand_more', 'chevron_right', 'chevron_left', 'home', 'menu', 'close', 'search', 'open_in_new'];
                foreach ($navIcons as $icon): ?>
                <div style="display: flex; align-items: center; gap: 8px; padding: 8px 12px; background: #FAFAF9; border-radius: 6px;">
                    <span class="material-symbols-outlined" style="font-size: 20px; color: #57534E;"><?= $icon ?></span>
                    <span style="font-size: 12px; color: #57534E;"><?= $icon ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Actions</div>
        <div class="ds-card">
            <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                <?php
                $actionIcons = ['add', 'edit', 'delete', 'save', 'download', 'upload_file', 'refresh', 'check', 'check_circle', 'content_paste', 'bookmark', 'favorite', 'ios_share', 'login', 'logout'];
                foreach ($actionIcons as $icon): ?>
                <div style="display: flex; align-items: center; gap: 8px; padding: 8px 12px; background: #FAFAF9; border-radius: 6px;">
                    <span class="material-symbols-outlined" style="font-size: 20px; color: #57534E;"><?= $icon ?></span>
                    <span style="font-size: 12px; color: #57534E;"><?= $icon ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- App-Specific Icons -->
<section class="ds-section">
    <h2 class="ds-section-title">App-Specific Icons</h2>
    <p class="ds-section-desc">Icons associated with specific applications in the platform.</p>

    <table class="ds-table">
        <thead>
            <tr>
                <th style="width: 60px;">Icon</th>
                <th>App</th>
                <th>Icon Name</th>
                <th>Usage</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><span class="material-symbols-outlined" style="color: #E54D4D;">menu_book</span></td>
                <td><strong>Library</strong></td>
                <td><code>menu_book</code></td>
                <td>Main content library, exercises, workshops</td>
            </tr>
            <tr>
                <td><span class="material-symbols-outlined" style="color: #F87171;">tips_and_updates</span></td>
                <td><strong>Tips</strong></td>
                <td><code>tips_and_updates</code></td>
                <td>Quick facilitation tips</td>
            </tr>
            <tr>
                <td><span class="material-symbols-outlined" style="color: #BE123C;">podcasts</span></td>
                <td><strong>Podcasts</strong></td>
                <td><code>podcasts</code></td>
                <td>Audio content, episodes</td>
            </tr>
            <tr>
                <td><span class="material-symbols-outlined" style="color: #0284C7;">calendar_month</span></td>
                <td><strong>Planner</strong></td>
                <td><code>calendar_month</code></td>
                <td>Workshop agenda builder</td>
            </tr>
            <tr>
                <td><span class="material-symbols-outlined" style="color: #7C4DFF;">smart_toy</span></td>
                <td><strong>Coach</strong></td>
                <td><code>smart_toy</code></td>
                <td>AI facilitation assistant</td>
            </tr>
            <tr>
                <td><span class="material-symbols-outlined" style="color: #7C4DFF;">style</span></td>
                <td><strong>Interventions</strong></td>
                <td><code>style</code></td>
                <td>Intervention card library</td>
            </tr>
            <tr>
                <td><span class="material-symbols-outlined" style="color: #10B981;">school</span></td>
                <td><strong>Training</strong></td>
                <td><code>school</code></td>
                <td>Courses and learning paths</td>
            </tr>
            <tr>
                <td><span class="material-symbols-outlined" style="color: #1A2744;">dashboard</span></td>
                <td><strong>MyWorkshopr</strong></td>
                <td><code>dashboard</code></td>
                <td>User dashboard</td>
            </tr>
        </tbody>
    </table>
</section>

<!-- Intervention Category Icons -->
<section class="ds-section">
    <h2 class="ds-section-title">Intervention Category Icons</h2>
    <p class="ds-section-desc">Icons for the 6 intervention card categories.</p>

    <div class="ds-card">
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 16px;">
            <?php
            $interventionCats = [
                ['icon' => 'person_alert', 'label' => 'Difficult Participants', 'id' => 'difficult_participants'],
                ['icon' => 'battery_charging_full', 'label' => 'Energy Management', 'id' => 'energy_management'],
                ['icon' => 'schedule', 'label' => 'Time Management', 'id' => 'time_management'],
                ['icon' => 'groups', 'label' => 'Group Dynamics', 'id' => 'group_dynamics'],
                ['icon' => 'build', 'label' => 'Technical Issues', 'id' => 'technical_issues'],
                ['icon' => 'psychology', 'label' => 'Facilitation Moments', 'id' => 'facilitation_moments'],
            ];
            foreach ($interventionCats as $cat): ?>
            <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(124, 77, 255, 0.08); border-radius: 8px;">
                <div style="width: 40px; height: 40px; background: rgba(124, 77, 255, 0.15); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined" style="font-size: 22px; color: #7C4DFF;"><?= $cat['icon'] ?></span>
                </div>
                <div>
                    <div style="font-size: 13px; font-weight: 500; color: #1A2744;"><?= $cat['label'] ?></div>
                    <div style="font-size: 11px; color: #7C4DFF;"><?= $cat['icon'] ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Content Type Icons -->
<section class="ds-section">
    <h2 class="ds-section-title">Content Type Icons</h2>

    <div class="ds-grid-2">
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 12px; color: #1A2744;">Activity Types</div>
            <div style="display: flex; flex-direction: column; gap: 8px;">
                <?php
                $activityTypes = [
                    ['icon' => 'view_day', 'label' => 'Workshop', 'desc' => 'Full workshop templates'],
                    ['icon' => 'stacks', 'label' => 'Exercise', 'desc' => 'Individual exercises'],
                    ['icon' => 'waving_hand', 'label' => 'Icebreaker', 'desc' => 'Warm-up activities'],
                    ['icon' => 'coffee', 'label' => 'Break', 'desc' => 'Scheduled breaks'],
                ];
                foreach ($activityTypes as $type): ?>
                <div style="display: flex; align-items: center; gap: 12px; padding: 8px;">
                    <span class="material-symbols-outlined" style="font-size: 22px; color: #E54D4D;"><?= $type['icon'] ?></span>
                    <div>
                        <div style="font-size: 13px; font-weight: 500; color: #1A2744;"><?= $type['label'] ?></div>
                        <div style="font-size: 11px; color: #78716C;"><?= $type['desc'] ?></div>
                    </div>
                    <code style="margin-left: auto; font-size: 11px;"><?= $type['icon'] ?></code>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 12px; color: #1A2744;">Content Categories</div>
            <div style="display: flex; flex-direction: column; gap: 8px;">
                <?php
                $contentCats = [
                    ['icon' => 'palette', 'label' => 'Design', 'color' => '#9c27b0'],
                    ['icon' => 'analytics', 'label' => 'Strategy', 'color' => '#3b82f6'],
                    ['icon' => 'search', 'label' => 'Research', 'color' => '#ef4444'],
                    ['icon' => 'groups', 'label' => 'Team', 'color' => '#f97316'],
                    ['icon' => 'bolt', 'label' => 'Energizer', 'color' => '#eab308'],
                ];
                foreach ($contentCats as $cat): ?>
                <div style="display: flex; align-items: center; gap: 12px; padding: 8px;">
                    <span class="material-symbols-outlined" style="font-size: 22px; color: <?= $cat['color'] ?>;"><?= $cat['icon'] ?></span>
                    <div>
                        <div style="font-size: 13px; font-weight: 500; color: #1A2744;"><?= $cat['label'] ?></div>
                    </div>
                    <code style="margin-left: auto; font-size: 11px;"><?= $cat['icon'] ?></code>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Status & Feedback Icons -->
<section class="ds-section">
    <h2 class="ds-section-title">Status & Feedback</h2>

    <div class="ds-card">
        <div style="display: flex; flex-wrap: wrap; gap: 16px;">
            <?php
            $statusIcons = [
                ['icon' => 'check_circle', 'label' => 'Success', 'color' => '#22C55E'],
                ['icon' => 'warning', 'label' => 'Warning', 'color' => '#F59E0B'],
                ['icon' => 'info', 'label' => 'Info', 'color' => '#3B82F6'],
                ['icon' => 'help', 'label' => 'Help', 'color' => '#78716C'],
                ['icon' => 'radio_button_unchecked', 'label' => 'Pending', 'color' => '#A8A29E'],
                ['icon' => 'radio_button_checked', 'label' => 'Selected', 'color' => '#E54D4D'],
                ['icon' => 'progress_activity', 'label' => 'Loading', 'color' => '#0284C7'],
                ['icon' => 'trending_up', 'label' => 'Increase', 'color' => '#22C55E'],
                ['icon' => 'trending_down', 'label' => 'Decrease', 'color' => '#EF4444'],
            ];
            foreach ($statusIcons as $status): ?>
            <div style="display: flex; flex-direction: column; align-items: center; gap: 6px; padding: 12px 16px; background: #FAFAF9; border-radius: 8px; min-width: 80px;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: <?= $status['color'] ?>;"><?= $status['icon'] ?></span>
                <span style="font-size: 11px; color: #57534E;"><?= $status['label'] ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Media & Communication -->
<section class="ds-section">
    <h2 class="ds-section-title">Media & Communication</h2>

    <div class="ds-grid-2">
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 12px; color: #1A2744;">Media</div>
            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                <?php
                $mediaIcons = ['play_arrow', 'play_circle', 'pause', 'stop_circle', 'skip_next', 'skip_previous', 'headphones', 'mic', 'videocam', 'podcasts'];
                foreach ($mediaIcons as $icon): ?>
                <div style="display: flex; align-items: center; gap: 6px; padding: 6px 10px; background: #FAFAF9; border-radius: 6px;">
                    <span class="material-symbols-outlined" style="font-size: 18px; color: #57534E;"><?= $icon ?></span>
                    <span style="font-size: 11px; color: #78716C;"><?= $icon ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 12px; color: #1A2744;">Communication</div>
            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                <?php
                $commIcons = ['mail', 'chat', 'forum', 'feedback', 'notifications', 'person', 'groups', 'person_add', 'waving_hand'];
                foreach ($commIcons as $icon): ?>
                <div style="display: flex; align-items: center; gap: 6px; padding: 6px 10px; background: #FAFAF9; border-radius: 6px;">
                    <span class="material-symbols-outlined" style="font-size: 18px; color: #57534E;"><?= $icon ?></span>
                    <span style="font-size: 11px; color: #78716C;"><?= $icon ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Coach & AI Icons -->
<section class="ds-section">
    <h2 class="ds-section-title">Coach & AI Features</h2>
    <p class="ds-section-desc">Icons specific to the AI Coach and intelligence features.</p>

    <div class="ds-card">
        <div style="display: flex; flex-wrap: wrap; gap: 12px;">
            <?php
            $aiIcons = [
                ['icon' => 'auto_awesome', 'label' => 'AI Magic'],
                ['icon' => 'smart_toy', 'label' => 'AI Assistant'],
                ['icon' => 'psychology', 'label' => 'Insights'],
                ['icon' => 'psychology_alt', 'label' => 'Analysis'],
                ['icon' => 'auto_fix_high', 'label' => 'Auto-fix'],
                ['icon' => 'bolt', 'label' => 'Quick Actions'],
                ['icon' => 'insights', 'label' => 'Analytics'],
                ['icon' => 'analytics', 'label' => 'Data'],
                ['icon' => 'radar', 'label' => 'Detection'],
            ];
            foreach ($aiIcons as $ai): ?>
            <div style="display: flex; align-items: center; gap: 8px; padding: 10px 14px; background: rgba(124, 77, 255, 0.08); border-radius: 8px;">
                <span class="material-symbols-outlined" style="font-size: 20px; color: #7C4DFF;"><?= $ai['icon'] ?></span>
                <div>
                    <span style="font-size: 12px; font-weight: 500; color: #1A2744;"><?= $ai['label'] ?></span>
                    <span style="font-size: 11px; color: #7C4DFF; margin-left: 8px;"><?= $ai['icon'] ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Full Icon Reference -->
<section class="ds-section">
    <h2 class="ds-section-title">Complete Icon Reference</h2>
    <p class="ds-section-desc">All icons currently used across the Workshopr platform, sorted by frequency.</p>

    <div class="ds-card" style="max-height: 500px; overflow-y: auto;">
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 8px;">
            <?php
            // Complete list of all icons found in the codebase
            $allIcons = [
                'expand_more', 'check', 'arrow_forward', 'schedule', 'lightbulb', 'groups', 'close',
                'psychology', 'play_arrow', 'auto_awesome', 'podcasts', 'edit_note', 'radio_button_unchecked',
                'info', 'save', 'graph_3', 'description', 'arrow_back', 'add', 'tips_and_updates',
                'person', 'download', 'check_circle', 'view_day', 'stacks', 'trending_up', 'settings',
                'play_circle', 'menu_book', 'edit', 'bookmark', 'sticky_note_2', 'smart_toy', 'search',
                'school', 'psychology_alt', 'palette', 'format_quote', 'folder', 'dashboard', 'category',
                'calendar_month', 'bolt', 'analytics', 'waving_hand', 'warning', 'upload_file', 'touch_app',
                'timer', 'style', 'refresh', 'person_alert', 'open_in_new', 'map', 'mail', 'logout',
                'login', 'local_parking', 'inventory_2', 'insights', 'home', 'history', 'headphones',
                'folder_open', 'event_note', 'event_available', 'delete', 'content_paste', 'coffee', 'apps',
                'widgets', 'view_timeline', 'view_quilt', 'view_kanban', 'view_agenda', 'verified',
                'unfold_more', 'trending_down', 'text_fields', 'task_alt', 'summarize', 'stop_circle',
                'stars', 'star', 'sprint', 'speed', 'space_bar', 'skip_previous', 'skip_next', 'shield',
                'sell', 'rounded_corner', 'recommend', 'radio_button_checked', 'radar', 'progress_activity',
                'preview', 'picture_as_pdf', 'phone_iphone', 'pause', 'more_vert', 'mic', 'menu', 'lock',
                'local_fire_department', 'link', 'line_weight', 'layers', 'ios_share', 'inbox', 'how_to_vote',
                'hourglass_empty', 'help', 'grid_on', 'genetics', 'format_size', 'format_list_numbered',
                'folder_off', 'flag', 'fingerprint', 'favorite_border', 'favorite', 'fact_check', 'explore',
                'event', 'edit_document', 'done_all', 'data_object', 'code', 'cloud_upload', 'cloud_off',
                'cleaning_services', 'checklist', 'calendar_today', 'business_center', 'build',
                'battery_charging_full', 'auto_fix_high', 'attach_file', 'add_circle', 'chevron_right',
                'chevron_left', 'article', 'notifications', 'chat', 'forum', 'feedback', 'person_add',
                'videocam', 'record_voice_over', 'accessibility_new', 'account_tree'
            ];
            foreach ($allIcons as $icon): ?>
            <div style="display: flex; flex-direction: column; align-items: center; gap: 4px; padding: 8px; border: 1px solid #F5F5F4; border-radius: 6px; font-size: 10px; color: #78716C;">
                <span class="material-symbols-outlined" style="font-size: 22px; color: #57534E;"><?= $icon ?></span>
                <?= $icon ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Usage Guidelines -->
<section class="ds-section">
    <h2 class="ds-section-title">Usage Guidelines</h2>

    <div class="ds-grid-2">
        <div class="ds-card" style="border-left: 4px solid #166534;">
            <div style="font-weight: 600; margin-bottom: 12px; color: #166534;">Do</div>
            <ul style="margin: 0; padding-left: 20px; color: #57534E; font-size: 14px;">
                <li style="margin-bottom: 6px;">Use the <code>icon()</code> helper for consistent rendering</li>
                <li style="margin-bottom: 6px;">Keep icons at standard sizes: 18px, 20px, 24px, 28px</li>
                <li style="margin-bottom: 6px;">Use semantic icons that match the action (check for complete, add for create)</li>
                <li style="margin-bottom: 6px;">Pair icons with text labels for accessibility</li>
                <li>Use app-specific colors for branded icons</li>
            </ul>
        </div>
        <div class="ds-card" style="border-left: 4px solid #991B1B;">
            <div style="font-weight: 600; margin-bottom: 12px; color: #991B1B;">Don't</div>
            <ul style="margin: 0; padding-left: 20px; color: #57534E; font-size: 14px;">
                <li style="margin-bottom: 6px;">Don't use icons without alt text in images</li>
                <li style="margin-bottom: 6px;">Don't mix icon libraries (stick to Material Symbols)</li>
                <li style="margin-bottom: 6px;">Don't use icons as the only way to convey meaning</li>
                <li style="margin-bottom: 6px;">Don't create custom icons without adding to the SVG library</li>
                <li>Don't use filled variants inconsistently</li>
            </ul>
        </div>
    </div>

    <div class="ds-code" style="margin-top: 16px;">
<span style="color: #9CA3AF;">// PHP helper usage</span>
&lt;?= icon('lightbulb') ?&gt;
&lt;?= icon('check', 'icon-success') ?&gt;
&lt;?= icon('close', '', ['style' => 'color: red']) ?&gt;

<span style="color: #9CA3AF;">// Direct HTML</span>
&lt;span class="material-symbols-outlined"&gt;lightbulb&lt;/span&gt;

<span style="color: #9CA3AF;">// SVG for static contexts</span>
&lt;img src="/images/icons/lightbulb.svg" alt="" width="24" height="24"&gt;</div>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
