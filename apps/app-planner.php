<?php
$ds_page  = 'apps/app-planner';
$ds_title = 'Workshopr Planner App Guide';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>Workshopr Planner App</h1>
    <p>The Workshopr Planner is the drag-and-drop workshop agenda builder. It uses a professional SaaS layout with a sidebar (activity library), primary pane (agenda builder), and contextual detail panels.</p>
</div>

<!-- App Identity -->
<section class="ds-section">
    <h2 class="ds-section-title" style="display: flex; align-items: center; gap: 10px;">
        <span style="width: 12px; height: 12px; background: #E54D4D; border-radius: 4px;"></span>
        App Identity
    </h2>

    <div class="ds-grid-3" style="margin-bottom: 24px;">
        <div class="ds-card">
            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; margin-bottom: 8px;">Phase</div>
            <div style="font-weight: 600; color: #E54D4D;">Plan</div>
        </div>
        <div class="ds-card">
            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; margin-bottom: 8px;">Primary Color</div>
            <div style="display: flex; align-items: center; gap: 8px;">
                <span style="width: 20px; height: 20px; background: #E54D4D; border-radius: 4px;"></span>
                <code class="ds-code-inline">#E54D4D</code>
            </div>
        </div>
        <div class="ds-card">
            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; margin-bottom: 8px;">Font Stack</div>
            <div style="font-weight: 600;">Fraunces + Inter</div>
        </div>
    </div>
    <p style="font-size: 13px; color: #78716C; margin-top: -8px;"><em>Deliberate exception (June 2026): the Planner app ships Learn red; the Plan phase token (<code class="ds-code-inline">--phase-plan</code>) remains #0284C7.</em></p>
</section>

<!-- Design Philosophy -->
<section class="ds-section">
    <h2 class="ds-section-title">Design Philosophy</h2>
    <p class="ds-section-desc">The Planner is a workspace, not a webpage. It borrows from productivity tools like Notion and Linear -- clean, structured, and highly functional.</p>

    <div style="display: flex; flex-direction: column; gap: 16px;">
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FEF2F2; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #E54D4D;">view_column</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Three-column layout</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">The Studio uses a sidebar (activity library) + primary pane (agenda builder) + right rail (item details) pattern. This keeps the workspace organized and discoverable.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FEE2E2; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #C73E3E;">drag_indicator</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Direct manipulation</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Drag-and-drop for reordering, inline editing for titles and durations, click-to-expand for details. Every interaction should feel immediate, not modal.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #F0F9FF; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #0369A1;">linear_scale</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Progressive disclosure</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Start with the essentials (name, duration, drag items). Advanced features (AI suggestions, export, calendar) reveal as the agenda takes shape. Don't overwhelm an empty workspace.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #DBEAFE; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #1D4ED8;">density_medium</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">High information density</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Unlike the marketing site, the Planner uses tighter spacing (16px gaps, 12px padding) and smaller text (13-14px body). It's a tool, not a brochure.</div>
            </div>
        </div>
    </div>
</section>

<!-- Color Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Color Tokens</h2>
    <p class="ds-section-desc">Learn red palette for the Planner app. Clean, focused, professional. Deliberate exception (June 2026): the Plan phase token (<code class="ds-code-inline">--phase-plan</code>) remains sky blue #0284C7 — only the Planner app itself ships red.</p>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Core Palette</h3>
        <div style="display: flex; gap: 8px; margin-bottom: 24px;">
            <?php
            $colors = [
                ['token' => '--planner-primary', 'hex' => '#E54D4D', 'label' => 'Primary'],
                ['token' => '--planner-dark', 'hex' => '#C73E3E', 'label' => 'Dark'],
                ['token' => '--planner-light', 'hex' => '#FEE2E2', 'label' => 'Light'],
                ['token' => '--planner-very-light', 'hex' => '#FEF2F2', 'label' => 'Very Light'],
            ];
            foreach ($colors as $c): ?>
            <div style="flex: 1; text-align: center;">
                <div style="height: 48px; background: <?= $c['hex'] ?>; border-radius: 8px; margin-bottom: 8px;<?= in_array($c['hex'], ['#FEE2E2', '#FEF2F2']) ? 'border: 1px solid #E7E5E4;' : '' ?>"></div>
                <div style="font-size: 12px; font-weight: 600; color: #475569;"><?= $c['label'] ?></div>
                <div style="font-family: 'JetBrains Mono', monospace; font-size: 11px; color: #94a3b8;"><?= $c['token'] ?></div>
                <div style="font-family: 'JetBrains Mono', monospace; font-size: 10px; color: #cbd5e1;"><?= $c['hex'] ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Activity Type Colors</h3>
        <p style="font-size: 14px; color: #64748b; margin-bottom: 12px;">Each activity type has a distinct color for quick visual identification.</p>
        <div style="display: flex; gap: 8px; margin-bottom: 16px;">
            <?php
            $types = [
                ['hex' => '#2563EB', 'label' => 'Exercise'],
                ['hex' => '#22C55E', 'label' => 'Icebreaker'],
                ['hex' => '#78716C', 'label' => 'Break'],
                ['hex' => '#9333EA', 'label' => 'Custom'],
                ['hex' => '#E54D4D', 'label' => 'Primary UI'],
            ];
            foreach ($types as $t): ?>
            <div style="flex: 1; text-align: center;">
                <div style="height: 40px; background: <?= $t['hex'] ?>; border-radius: 6px; margin-bottom: 6px;"></div>
                <div style="font-size: 12px; font-weight: 600; color: #475569;"><?= $t['label'] ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="ds-code"><pre>/* Planner app tokens (defined in css/base/_variables.css)
   Deliberate exception (June 2026): the Planner app ships Learn red;
   the Plan phase token (--phase-plan) remains #0284C7. */
--planner-primary: #E54D4D;
--planner-dark: #C73E3E;
--planner-light: #FEE2E2;
--planner-very-light: #FEF2F2;
--planner-accent: #FEF2F2;
--planner-gradient: var(--mainsite-gradient);

/* Activity type tokens (also in _variables.css) */
--planner-exercise-color: #2563EB;   /* Blue */
--planner-icebreaker-color: #22C55E; /* Green */
--planner-break-color: var(--gray-500); /* Gray */
--planner-custom-color: #9333EA;     /* Purple */

/* CSS load order (header.php, modern path):
   1. &lt;link&gt; css/base/_variables.css
      └─ @import platform-tokens.css  (source of truth)
   2. &lt;link&gt; css/planner-v2.css       (main styles, consumes tokens)
   3. &lt;link&gt; css/planner.css      (incremental overrides)
   4. Deferred: _history.css, _exercise-builder.css, run-mode.css */</pre></div>
</section>

<!-- Layout Patterns -->
<section class="ds-section">
    <h2 class="ds-section-title">Layout Patterns</h2>
    <p class="ds-section-desc">The Planner uses a persistent three-column layout optimized for workshop building.</p>

    <div class="ds-card" style="margin-bottom: 16px;">
        <div style="font-weight: 600; margin-bottom: 12px;">Planner Layout Structure</div>
        <div class="ds-code"><pre>┌──────────────────────────────────────────────────┐
│  Top Bar (workshop name, duration, actions)       │
├─────────┬──────────────────────┬─────────────────┤
│         │                      │                 │
│ Sidebar │   Primary Pane       │   Right Rail    │
│ (240px) │   (flex-1)           │   (320px)       │
│         │                      │                 │
│ Activity│   Agenda Builder     │   Item Details  │
│ Library │   (drag-and-drop)    │   / Properties  │
│         │                      │                 │
└─────────┴──────────────────────┴─────────────────┘</pre></div>
    </div>

    <table class="ds-table">
        <thead>
            <tr>
                <th>Column</th>
                <th>Content</th>
                <th>Key Features</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Sidebar</strong></td>
                <td>Exercise/icebreaker library by category</td>
                <td>Category tabs, search, drag source</td>
            </tr>
            <tr>
                <td><strong>Primary Pane</strong></td>
                <td>Drag-and-drop agenda builder</td>
                <td>Timeline ruler, day dividers, cumulative time</td>
            </tr>
            <tr>
                <td><strong>Right Rail</strong></td>
                <td>Selected item details</td>
                <td>Description, materials, facilitator notes</td>
            </tr>
        </tbody>
    </table>
</section>

<!-- Key Components -->
<section class="ds-section">
    <h2 class="ds-section-title">Key Components</h2>
    <p class="ds-section-desc">Planner-specific UI patterns built for workshop creation workflows.</p>

    <div style="display: flex; flex-direction: column; gap: 16px;">
        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">Activity Card (Sidebar)</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #FEE2E2; color: #C73E3E; border-radius: 100px; font-weight: 600;">Planner-specific</span>
            </div>
            <div style="font-size: 14px; color: #57534E; margin-bottom: 12px;">Compact cards in the sidebar library showing exercise name, duration badge, and category color dot. Draggable to the agenda. Hover reveals a quick-add button.</div>
        </div>

        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">Agenda Item Row</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #FEE2E2; color: #C73E3E; border-radius: 100px; font-weight: 600;">Planner-specific</span>
            </div>
            <div style="font-size: 14px; color: #57534E; margin-bottom: 12px;">Draggable rows in the primary pane showing item title, inline-editable duration, type icon, and drag handle. Active item has a red left border. Supports multi-day agendas with day dividers.</div>
        </div>

        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">Right Rail Detail Panel</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #FEE2E2; color: #C73E3E; border-radius: 100px; font-weight: 600;">Planner-specific</span>
            </div>
            <div style="font-size: 14px; color: #57534E; margin-bottom: 12px;">Contextual detail panel that slides in when an agenda item is selected. Shows full exercise description, materials, instructions, and facilitator notes. Uses sticky header for item title.</div>
        </div>

        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">Top Bar</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #FEE2E2; color: #C73E3E; border-radius: 100px; font-weight: 600;">Planner-specific</span>
            </div>
            <div style="font-size: 14px; color: #57534E;">Fixed header bar showing workshop name (inline editable), total duration, progress indicator, and action buttons (save, export, share). Uses planner primary color accent.</div>
        </div>

        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">Duration Calculator</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #F1F5F9; color: #64748B; border-radius: 100px; font-weight: 600;">Shared + extended</span>
            </div>
            <div style="font-size: 14px; color: #57534E;">Auto-calculates total workshop duration from individual items. Displayed in the page header and updates live as items are added/removed/reordered.</div>
        </div>
    </div>
</section>

<!-- Do / Don't -->
<section class="ds-section">
    <h2 class="ds-section-title">Do / Don't</h2>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Use inline editing</strong>
            <div style="margin-top: 8px; font-size: 13px;">Click-to-edit for titles and durations. No modal forms for simple changes.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Open modals for every edit</strong>
            <div style="margin-top: 8px; font-size: 13px;">Modals break flow. Reserve them for complex actions (delete confirmation, share).</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Use compact spacing in tool UI</strong>
            <div style="margin-top: 8px; font-size: 13px;">16px gaps, 12px padding, 13px text. The Studio is a workspace, not a landing page.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Use marketing-style spacing</strong>
            <div style="margin-top: 8px; font-size: 13px;">48px gaps and 18px text waste precious screen real estate in a tool interface.</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Keep the three-column layout stable</strong>
            <div style="margin-top: 8px; font-size: 13px;">Sidebar, primary pane, and rail widths should stay consistent across phases.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Collapse layout between phases</strong>
            <div style="margin-top: 8px; font-size: 13px;">Users rely on spatial memory. Moving elements breaks their mental model.</div>
        </div>
    </div>
</section>

<!-- Shared Components Used -->
<section class="ds-section">
    <h2 class="ds-section-title">Shared Components Used</h2>

    <table class="ds-table">
        <thead>
            <tr>
                <th>Component</th>
                <th>Usage</th>
                <th>Customization</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><code>ws_tabs()</code></td>
                <td>Sidebar category filters</td>
                <td>Compact variant for sidebar</td>
            </tr>
            <tr>
                <td><code>ws_card_start()</code></td>
                <td>Activity cards, agenda items</td>
                <td>Compact variant, draggable attribute</td>
            </tr>
            <tr>
                <td><code>ws_badge()</code></td>
                <td>Duration labels, category tags, day markers</td>
                <td>Red variant for planner badges</td>
            </tr>
            <tr>
                <td><code>ws_input()</code></td>
                <td>Plan name, custom item entry, search</td>
                <td>Inline-edit mode (borderless until focus)</td>
            </tr>
            <tr>
                <td><code>ws_modal_start()</code></td>
                <td>Delete confirm, share workshop, export</td>
                <td>Standard usage</td>
            </tr>
            <tr>
                <td><code>ws_empty_state()</code></td>
                <td>Empty agenda, no search results</td>
                <td>Red accent icon</td>
            </tr>
            <tr>
                <td><code>ws_toast*()</code></td>
                <td>Saved, duplicated, deleted notifications</td>
                <td>Standard usage</td>
            </tr>
            <tr>
                <td><code>ws_tooltip()</code></td>
                <td>Drag handles, action buttons, phase info</td>
                <td>Standard usage</td>
            </tr>
            <tr>
                <td><code>ws_activity_badge()</code></td>
                <td>Type badges on agenda items and sidebar cards</td>
                <td>exercise / icebreaker / break / custom types</td>
            </tr>
            <tr>
                <td><code>ws_suggestion_card()</code></td>
                <td>AI suggestion panel results</td>
                <td>Type-colored with add-to-agenda action</td>
            </tr>
            <tr>
                <td><code>ws_modal_footer()</code></td>
                <td>Export, share, cleanup, calendar modals</td>
                <td>Cancel + primary, or left + cancel + primary</td>
            </tr>
            <tr>
                <td><code>ws_results_overlay()</code></td>
                <td>Cleanup results, operation outcomes</td>
                <td>Overlay variant inside modals</td>
            </tr>
            <tr>
                <td><code>ws_checkbox_card_group()</code></td>
                <td>Cleanup options panel</td>
                <td>Toggle switches with icon colors</td>
            </tr>
            <tr>
                <td><code>ws_radio_card_group()</code></td>
                <td>Export format picker</td>
                <td>4-column grid with icons</td>
            </tr>
            <tr>
                <td><code>ws_chip_input()</code></td>
                <td>Calendar invite attendee list</td>
                <td>Email type with person_add icon</td>
            </tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
