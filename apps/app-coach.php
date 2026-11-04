<?php
$ds_page  = 'apps/app-coach';
$ds_title = 'Workshopr Coach App Guide';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>Workshopr Coach App</h1>
    <p>The AI Facilitation Coach guides facilitators through three modes: Prep, Facilitate, and Reflect. It's the platform's most interactive app, blending AI-powered suggestions with real-time session management.</p>
</div>

<!-- App Identity -->
<section class="ds-section">
    <h2 class="ds-section-title" style="display: flex; align-items: center; gap: 10px;">
        <span style="width: 12px; height: 12px; background: #7C4DFF; border-radius: 4px;"></span>
        App Identity
    </h2>

    <div class="ds-grid-3" style="margin-bottom: 24px;">
        <div class="ds-card">
            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; margin-bottom: 8px;">Phase</div>
            <div style="font-weight: 600; color: #7C4DFF;">Facilitate</div>
        </div>
        <div class="ds-card">
            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; margin-bottom: 8px;">Primary Color</div>
            <div style="display: flex; align-items: center; gap: 8px;">
                <span style="width: 20px; height: 20px; background: #7C4DFF; border-radius: 4px;"></span>
                <code class="ds-code-inline">#7C4DFF</code>
            </div>
        </div>
        <div class="ds-card">
            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; margin-bottom: 8px;">Font Stack</div>
            <div style="font-weight: 600;">Fraunces + Source Sans 3</div>
        </div>
    </div>
</section>

<!-- Design Philosophy -->
<section class="ds-section">
    <h2 class="ds-section-title">Design Philosophy</h2>
    <p class="ds-section-desc">The Coach is a facilitator's trusted companion in high-stakes moments. Every design decision optimizes for calm confidence and quick access.</p>

    <div style="display: flex; flex-direction: column; gap: 16px;">
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #EDE9FE; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #7C4DFF;">psychology</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Calm under pressure</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Live facilitation is stressful. The Coach uses generous whitespace, soft backgrounds (<code class="ds-code-inline">#F8FAFC</code>), and muted borders to create a visually quiet environment. No bold distractions -- information surfaces when needed.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #DDD6FE; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #6D28D9;">view_sidebar</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Mode-driven navigation</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Three modes (Prep, Facilitate, Reflect) each have distinct layouts and color tints. Users always know where they are through tab-based navigation and subtle background shifts.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #C4B5FD; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #5B21B6;">smart_toy</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">AI as a gentle assistant</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">AI suggestions appear in clearly marked cards -- never aggressive pop-ups. AI-generated content uses a subtle left-border accent and a "sparkle" icon to distinguish it from user content.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #A78BFA; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #4C1D95;">timer</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Time-aware interface</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Live mode features timers, progress bars, and session clocks. These use semantic colors (green = on track, amber = watch, red = over) rather than the app's purple accent.</div>
            </div>
        </div>
    </div>
</section>

<!-- Color Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Color Tokens</h2>
    <p class="ds-section-desc">The Coach uses a purple palette with four mode-specific tints. Import from <code class="ds-code-inline">platform-tokens.css</code>.</p>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Core Palette</h3>
        <div style="display: flex; gap: 8px; margin-bottom: 24px;">
            <?php
            $colors = [
                ['token' => '--coach-primary', 'hex' => '#7C4DFF', 'label' => 'Primary'],
                ['token' => '--coach-dark', 'hex' => '#6D28D9', 'label' => 'Dark'],
                ['token' => '--coach-light', 'hex' => '#DDD6FE', 'label' => 'Light'],
                ['token' => '--coach-very-light', 'hex' => '#EDE9FE', 'label' => 'Very Light'],
            ];
            foreach ($colors as $c): ?>
            <div style="flex: 1; text-align: center;">
                <div style="height: 48px; background: <?= $c['hex'] ?>; border-radius: 8px; margin-bottom: 8px;<?= in_array($c['hex'], ['#DDD6FE', '#EDE9FE']) ? 'border: 1px solid #E7E5E4;' : '' ?>"></div>
                <div style="font-size: 12px; font-weight: 600; color: #475569;"><?= $c['label'] ?></div>
                <div style="font-family: 'JetBrains Mono', monospace; font-size: 11px; color: #94a3b8;"><?= $c['token'] ?></div>
                <div style="font-family: 'JetBrains Mono', monospace; font-size: 10px; color: #cbd5e1;"><?= $c['hex'] ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Mode Tints</h3>
        <div style="display: flex; gap: 8px; margin-bottom: 16px;">
            <?php
            $modes = [
                ['token' => '--coach-mode-prep', 'hex' => '#A78BFA', 'label' => 'Prep'],
                ['token' => '--coach-mode-facilitate', 'hex' => '#8B5CF6', 'label' => 'Facilitate'],
                ['token' => '--coach-mode-synthesize', 'hex' => '#7C3AED', 'label' => 'Synthesize'],
                ['token' => '--coach-mode-debrief', 'hex' => '#6D28D9', 'label' => 'Debrief'],
            ];
            foreach ($modes as $m): ?>
            <div style="flex: 1; text-align: center;">
                <div style="height: 40px; background: <?= $m['hex'] ?>; border-radius: 6px; margin-bottom: 6px;"></div>
                <div style="font-size: 12px; font-weight: 600; color: #475569;"><?= $m['label'] ?></div>
                <div style="font-family: 'JetBrains Mono', monospace; font-size: 10px; color: #94a3b8;"><?= $m['hex'] ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="ds-code"><pre>/* Coach app tokens */
--coach-primary: #7C4DFF;
--coach-dark: #6D28D9;
--coach-light: #DDD6FE;
--coach-very-light: #EDE9FE;
--coach-gradient: linear-gradient(135deg, #7C4DFF 0%, #6D28D9 100%);
--coach-shadow: 0 4px 14px rgba(124, 77, 255, 0.25);

/* Mode tints */
--coach-mode-prep: #A78BFA;
--coach-mode-facilitate: #8B5CF6;
--coach-mode-synthesize: #7C3AED;
--coach-mode-debrief: #6D28D9;</pre></div>
</section>

<!-- Layout Patterns -->
<section class="ds-section">
    <h2 class="ds-section-title">Layout Patterns</h2>
    <p class="ds-section-desc">Each Coach mode has a distinct layout optimized for its workflow.</p>

    <table class="ds-table">
        <thead>
            <tr>
                <th>Mode</th>
                <th>Layout</th>
                <th>Max Width</th>
                <th>Key Pattern</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Prep</strong></td>
                <td>Single column, scrollable</td>
                <td><code>1000px</code></td>
                <td>Collapsible info cards, AI briefing panel</td>
            </tr>
            <tr>
                <td><strong>Facilitate</strong></td>
                <td>50/50 split pane</td>
                <td><code>Full width</code></td>
                <td>Agenda left, scripts/resources right</td>
            </tr>
            <tr>
                <td><strong>Reflect</strong></td>
                <td>Single column, guided flow</td>
                <td><code>800px</code></td>
                <td>Sequential debrief questions, analytics</td>
            </tr>
        </tbody>
    </table>
</section>

<!-- Key Components -->
<section class="ds-section">
    <h2 class="ds-section-title">Key Components</h2>
    <p class="ds-section-desc">Coach-specific patterns built on the shared component library.</p>

    <div style="display: flex; flex-direction: column; gap: 16px;">
        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">AI Suggestion Card</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #EDE9FE; color: #6D28D9; border-radius: 100px; font-weight: 600;">Coach-specific</span>
            </div>
            <div style="font-size: 14px; color: #57534E; margin-bottom: 12px;">AI-generated recommendations appear in cards with a left purple border, sparkle icon, and subtle gradient background. Users can accept, dismiss, or regenerate.</div>
            <div class="ds-code"><pre>&lt;div class="ai-suggestion"&gt;
  &lt;div class="ai-suggestion__icon"&gt;&#10024;&lt;/div&gt;
  &lt;div class="ai-suggestion__content"&gt;...&lt;/div&gt;
  &lt;div class="ai-suggestion__actions"&gt;
    &lt;button class="btn-accept"&gt;Use This&lt;/button&gt;
    &lt;button class="btn-dismiss"&gt;Dismiss&lt;/button&gt;
  &lt;/div&gt;
&lt;/div&gt;</pre></div>
        </div>

        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">Session Timer</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #EDE9FE; color: #6D28D9; border-radius: 100px; font-weight: 600;">Coach-specific</span>
            </div>
            <div style="font-size: 14px; color: #57534E; margin-bottom: 12px;">Sticky timer bar in Facilitate mode shows elapsed/remaining time with semantic color states. Uses <code class="ds-code-inline">--color-success</code>, <code class="ds-code-inline">--color-warning</code>, and <code class="ds-code-inline">--color-error</code> tokens.</div>
            <div style="display: flex; gap: 8px;">
                <div style="flex: 1; padding: 10px; background: #DCFCE7; border-radius: 6px; text-align: center; font-size: 13px; font-weight: 600; color: #166534;">On Track</div>
                <div style="flex: 1; padding: 10px; background: #FEF3C7; border-radius: 6px; text-align: center; font-size: 13px; font-weight: 600; color: #92400E;">Watch</div>
                <div style="flex: 1; padding: 10px; background: #FEE2E2; border-radius: 6px; text-align: center; font-size: 13px; font-weight: 600; color: #991B1B;">Over Time</div>
            </div>
        </div>

        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">Mode Tabs</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #F1F5F9; color: #64748B; border-radius: 100px; font-weight: 600;">Shared + extended</span>
            </div>
            <div style="font-size: 14px; color: #57534E; margin-bottom: 12px;">Extends the shared <code class="ds-code-inline">ws_tabs()</code> component with Coach-specific mode icons and color-coded active states. The active tab underline uses the mode's tint color.</div>
        </div>

        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">Agenda Item Row</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #EDE9FE; color: #6D28D9; border-radius: 100px; font-weight: 600;">Coach-specific</span>
            </div>
            <div style="font-size: 14px; color: #57534E; margin-bottom: 12px;">Clickable agenda rows with duration badges, current-item highlight (purple left border), and completion checkmarks. Supports drag-reordering in Prep mode.</div>
        </div>

        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">Plan Selector</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #F1F5F9; color: #64748B; border-radius: 100px; font-weight: 600;">Shared + extended</span>
            </div>
            <div style="font-size: 14px; color: #57534E;">Dropdown for selecting which workshop plan to coach. Uses the shared <code class="ds-code-inline">ws_select()</code> component with custom rendering for plan cards showing title, duration, and item count.</div>
        </div>
    </div>
</section>

<!-- Do / Don't -->
<section class="ds-section">
    <h2 class="ds-section-title">Do / Don't</h2>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Use muted AI indicators</strong>
            <div style="margin-top: 8px; font-size: 13px;">Purple left border + sparkle icon. AI content is clearly marked but doesn't fight for attention.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Use flashy AI badges</strong>
            <div style="margin-top: 8px; font-size: 13px;">Avoid "AI POWERED" banners or glowing effects. The Coach should feel like a natural extension of the facilitator's thinking.</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Use semantic timer colors</strong>
            <div style="margin-top: 8px; font-size: 13px;">Green/amber/red for time status. The facilitator needs instant visual feedback.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Use purple for time states</strong>
            <div style="margin-top: 8px; font-size: 13px;">Purple is the app brand, not a signal color. Reserve semantic colors for meaning.</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Keep Facilitate mode distraction-free</strong>
            <div style="margin-top: 8px; font-size: 13px;">Minimal chrome, no sidebar, focus on agenda + script content.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Add feature-rich toolbars in live mode</strong>
            <div style="margin-top: 8px; font-size: 13px;">Live facilitation needs focus, not options. Progressive disclosure only.</div>
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
                <td>Mode navigation (Prep/Facilitate/Reflect)</td>
                <td>Custom icons, mode-colored active underline</td>
            </tr>
            <tr>
                <td><code>ws_card_start()</code></td>
                <td>AI suggestions, session info, agenda sections</td>
                <td>Purple left-border variant for AI content</td>
            </tr>
            <tr>
                <td><code>ws_progress()</code></td>
                <td>Session progress, time remaining</td>
                <td>Semantic color states</td>
            </tr>
            <tr>
                <td><code>ws_badge()</code></td>
                <td>Duration labels, risk flags, mode indicators</td>
                <td>Purple variant for coach-specific badges</td>
            </tr>
            <tr>
                <td><code>ws_modal_start()</code></td>
                <td>Plan selector, intervention card viewer</td>
                <td>Standard usage</td>
            </tr>
            <tr>
                <td><code>ws_select()</code></td>
                <td>Plan picker, participant count</td>
                <td>Custom option rendering for plans</td>
            </tr>
            <tr>
                <td><code>ws_toast*()</code></td>
                <td>Session saved, timer alerts, AI status</td>
                <td>Standard usage</td>
            </tr>
            <tr>
                <td><code>ws_skeleton()</code></td>
                <td>AI content loading, session data fetching</td>
                <td>Standard usage</td>
            </tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
