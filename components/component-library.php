<?php
$ds_page  = 'components/component-library';
$ds_title = 'Pattern Library';

require_once __DIR__ . '/../../includes/icon.php';
require_once __DIR__ . '/../../includes/components/helpers.php';

require_once __DIR__ . '/../includes/ds-header.php';

/**
 * Every ws_* helper, organized by the problem it solves.
 * 'demo' => slug in components/demos/, or null when no demo page exists yet
 * (rendered as a "docs pending" card instead of a dead link).
 * Categories per design-system/templates/README.md pattern conventions.
 */
$library = [
    'forms' => [
        'title' => 'Forms & Input',
        'desc'  => 'Collecting decisions and data: fields, selectors, and the actions that submit them.',
        'items' => [
            ['demo' => 'button',              'icon' => 'smart_button',           'title' => 'Button',              'desc' => 'Actions, links, form submissions'],
            ['demo' => 'input',               'icon' => 'text_fields',            'title' => 'Input',               'desc' => 'Text, email, password, textarea fields'],
            ['demo' => 'select',              'icon' => 'arrow_drop_down_circle', 'title' => 'Select',              'desc' => 'Dropdown select fields'],
            ['demo' => 'form-row',            'icon' => 'input',                  'title' => 'Form Row',            'desc' => 'Field wrapper with label, helper, error'],
            ['demo' => 'chip-input',          'icon' => 'sell',                   'title' => 'Chip Input',          'desc' => 'Email/tag input with add/remove chips'],
            ['demo' => 'radio-card-group',    'icon' => 'grid_view',              'title' => 'Radio Card Group',    'desc' => 'Card-style single-choice grid'],
            ['demo' => 'checkbox-card-group', 'icon' => 'toggle_on',              'title' => 'Checkbox Card Group', 'desc' => 'Toggle switch list with icons'],
            ['demo' => 'toggle',              'icon' => 'toggle_on',              'title' => 'Toggle',              'desc' => 'Switch control for boolean settings'],
            ['demo' => 'prompt-select',       'icon' => 'tune',                   'title' => 'Prompt Select',       'desc' => 'Inline choice chips for AI prompts'],
            ['demo' => 'filter-bar',          'icon' => 'filter_list',            'title' => 'Filter Bar',          'desc' => 'Search, dropdown filters, active chips'],
            ['demo' => null,                  'icon' => 'radio_button_checked',   'title' => 'Icon Button',         'desc' => 'ws_icon_button — square icon-only action'],
            ['demo' => null,                  'icon' => 'mic',                    'title' => 'Audio Recorder',      'desc' => 'ws_audio_recorder — voice note capture'],
        ],
    ],
    'feedback' => [
        'title' => 'Feedback & Status',
        'desc'  => 'Telling the user what happened, what is happening, and what state things are in.',
        'items' => [
            ['demo' => 'alert',           'icon' => 'warning',          'title' => 'Alert',           'desc' => 'Banners, warnings, status messages'],
            ['demo' => 'toast',           'icon' => 'notifications',    'title' => 'Toast',           'desc' => 'Transient notification feedback'],
            ['demo' => 'tooltip',         'icon' => 'help_outline',     'title' => 'Tooltip',         'desc' => 'Contextual info on hover/focus'],
            ['demo' => 'progress',        'icon' => 'linear_scale',     'title' => 'Progress',        'desc' => 'Progress bars and loading states'],
            ['demo' => 'skeleton',        'icon' => 'hourglass_empty',  'title' => 'Skeleton',        'desc' => 'Loading placeholders'],
            ['demo' => 'results-overlay', 'icon' => 'check_circle',     'title' => 'Results Overlay', 'desc' => 'Animated outcome panel'],
            ['demo' => 'badge',           'icon' => 'label',            'title' => 'Badge',           'desc' => 'Labels, status, categories, counts'],
            ['demo' => 'banner',          'icon' => 'web_stories',      'title' => 'Banner',          'desc' => 'Full-width announcements'],
            ['demo' => 'empty-state',     'icon' => 'inbox',            'title' => 'Empty State',     'desc' => 'Placeholders that invite the first action'],
            ['demo' => 'lifecycle',       'icon' => 'timeline',         'title' => 'Lifecycle',       'desc' => 'Workshop Record strip: Designed → Delivered → Synthesized'],
            ['demo' => null,              'icon' => 'radar',            'title' => 'Status',          'desc' => 'ws_status — dot + label state indicator'],
        ],
    ],
    'navigation' => [
        'title' => 'Navigation & Overlays',
        'desc'  => 'Moving between places, and surfaces that sit above the page.',
        'items' => [
            ['demo' => 'nav',          'icon' => 'menu',               'title' => 'Navigation',   'desc' => 'App switcher and user menu patterns'],
            ['demo' => 'breadcrumb',   'icon' => 'chevron_right',      'title' => 'Breadcrumb',   'desc' => 'Navigation trails'],
            ['demo' => 'tabs',         'icon' => 'tab',                'title' => 'Tabs',         'desc' => 'Tab navigation for content panels'],
            ['demo' => 'link-switch',  'icon' => 'toggle_off',         'title' => 'Link Switch',  'desc' => 'Links to versions of the same page, one current: 90 | 60'],
            ['demo' => 'modal',        'icon' => 'picture_in_picture', 'title' => 'Modal',        'desc' => 'Dialogs, drawers, bottom sheets — with focus trap'],
            ['demo' => 'modal-footer', 'icon' => 'call_to_action',     'title' => 'Modal Footer', 'desc' => 'Standardized modal button layout'],
            ['demo' => 'side-panel',   'icon' => 'right_panel_open',   'title' => 'Side Panel',   'desc' => 'A non-modal panel that slides in beside the page'],
            ['demo' => 'menu',         'icon' => 'more_horiz',         'title' => 'Action menu',  'desc' => 'More actions on a card, row or page'],
            ['demo' => 'accordion',    'icon' => 'expand_more',        'title' => 'Accordion',    'desc' => 'Collapsible content panels'],
            ['demo' => 'app-bar',        'icon' => 'toolbar',        'title' => 'App Bar',        'desc' => 'The document bar a tool shell wears under the header'],
            ['demo' => 'app-dock',       'icon' => 'bottom_panel_open', 'title' => 'App Dock',    'desc' => 'The floating toolbar at the foot of a tool shell'],
            ['demo' => 'phase-toolbar',  'icon' => 'dock_to_bottom', 'title' => 'Phase Toolbar',  'desc' => 'The dock a phase always wears: its slots, order, glyphs and names'],
        ],
    ],
    'content' => [
        'title' => 'Content & Display',
        'desc'  => 'Presenting information: cards, heroes, metrics, and metadata.',
        'items' => [
            ['demo' => 'layout',          'icon' => 'dashboard',          'title' => 'Layout',          'desc' => 'Stack, cluster, grid and container: the space between components'],
            ['demo' => 'agenda',          'icon' => 'schedule',           'title' => 'Agenda',          'desc' => 'A read-only running order with start times'],
            ['demo' => 'exercise-tile',   'icon' => 'grid_view',          'title' => 'Exercise Tile',   'desc' => 'An exercise as a square, and a recipe as tiles joined by plus signs'],
            ['demo' => 'session-shape',   'icon' => 'stacked_line_chart', 'title' => 'Session Shape',   'desc' => 'An energy line over a time bar: a short session at a glance'],
            ['demo' => 'text',            'icon' => 'title',              'title' => 'Text',            'desc' => 'An item title and a small secondary line'],
            ['demo' => 'card',            'icon' => 'crop_portrait',      'title' => 'Card',            'desc' => 'Content containers with variants'],
            ['demo' => 'card-deck',       'icon' => 'style',              'title' => 'Card Deck',       'desc' => 'Up to three suggested cards cascaded, one link to the set'],
            ['demo' => 'listing-card',    'icon' => 'view_agenda',        'title' => 'Listing Card',    'desc' => 'Content library card for listings'],
            ['demo' => 'choice-card',     'icon' => 'alt_route',          'title' => 'Choice Card',     'desc' => 'One way into a task, offered beside the others'],
            ['demo' => 'feature-card',    'icon' => 'featured_play_list', 'title' => 'Feature Card',    'desc' => 'Icon + title + description cards'],
            ['demo' => 'hero',            'icon' => 'web',                'title' => 'Hero',            'desc' => 'Full-width hero with title, actions, stats'],
            ['demo' => 'section-header',  'icon' => 'title',              'title' => 'Section Header',  'desc' => 'Page/section titles with subtitles'],
            ['demo' => 'cta-section',     'icon' => 'campaign',           'title' => 'CTA Section',     'desc' => 'Bottom-of-page conversion panel'],
            ['demo' => 'how-steps',       'icon' => 'stairs',             'title' => 'How Steps',       'desc' => 'Numbered "How It Works" step grid'],
            ['demo' => 'stat',            'icon' => 'tag',                'title' => 'Stat',            'desc' => 'Metric displays and stat groups'],
            ['demo' => 'run-clock',       'icon' => 'timer',              'title' => 'Run Clock',       'desc' => 'The time left on a running block, read across a room'],
            ['demo' => 'checklist',       'icon' => 'checklist',          'title' => 'Checklist',       'desc' => 'Icon-prefixed feature lists'],
            ['demo' => 'avatar',          'icon' => 'account_circle',     'title' => 'Avatar',          'desc' => 'User images with initials fallback'],
            ['demo' => 'pill',            'icon' => 'sell',               'title' => 'Pill',            'desc' => 'Read-only tags for difficulty, topic, metadata'],
            ['demo' => 'level-up-grid',   'icon' => 'apps',               'title' => 'Level Up Grid',   'desc' => 'Cross-app promotion card grid'],
            ['demo' => 'energy-arc-card', 'icon' => 'monitoring',         'title' => 'Energy Arc Card', 'desc' => 'Workshop energy visualization'],
            ['demo' => null,              'icon' => 'category',           'title' => 'Category',        'desc' => 'ws_category — colored category chip'],
            ['demo' => null,              'icon' => 'schedule',           'title' => 'Duration',        'desc' => 'ws_duration — time badge'],
        ],
    ],
    'agent' => [
        'title' => 'AI & Agents',
        'desc'  => 'The shared set every AI screen draws with: the mark that says the AI made something, what it is doing, what it did, what it proposes, where it got it, and consent before anything leaves Workshopr. Each has a JavaScript twin in /js/ws-agent.js.',
        'items' => [
            ['demo' => 'ai-mark',        'icon' => 'auto_awesome',      'title' => 'AI Mark',        'desc' => 'The one glyph for AI-made work; the badge ai variant pairs it with words'],
            ['demo' => 'agent-status',   'icon' => 'progress_activity', 'title' => 'Agent Status',   'desc' => 'Thinking line, or stages done, failed, now and still to come'],
            ['demo' => 'agent-steps',    'icon' => 'timeline',          'title' => 'Agent Steps',    'desc' => 'The visible history of an AI run'],
            ['demo' => 'agent-check',    'icon' => 'fact_check',        'title' => 'Agent Check',    'desc' => 'The rules a result was held to, with verdicts'],
            ['demo' => 'agent-proposal', 'icon' => 'rule',              'title' => 'Agent Proposal', 'desc' => 'Before and after, the reason, then Apply, Adjust or Not now'],
            ['demo' => 'source-chip',    'icon' => 'link',              'title' => 'Source Chip',    'desc' => 'Where a line in an AI result came from'],
            ['demo' => 'consent-row',    'icon' => 'verified_user',     'title' => 'Consent Row',    'desc' => 'Confirm before anything is sent out or runs on its own'],
        ],
    ],
    'live' => [
        'title' => 'Live Session & Planner',
        'desc'  => 'Domain patterns for building and running workshops: the planner rails and the live-facilitation surfaces.',
        'items' => [
            ['demo' => 'activity-badge',              'icon' => 'label_important', 'title' => 'Activity Badge',        'desc' => 'Type-colored badge (exercise/icebreaker/break)'],
            ['demo' => 'suggestion-card',             'icon' => 'recommend',       'title' => 'Suggestion Card',       'desc' => 'Activity recommendation with add button'],
            ['demo' => 'planner-card',                'icon' => 'dashboard',       'title' => 'Planner Card',          'desc' => 'Agenda item card for the planner canvas'],
            ['demo' => 'planner-library-rail',        'icon' => 'view_sidebar',    'title' => 'Library Rail',          'desc' => 'Planner left rail: exercise palette'],
            ['demo' => 'planner-inspector-rail',      'icon' => 'view_sidebar',    'title' => 'Inspector Rail',        'desc' => 'Planner right rail: workshop overview'],
            ['demo' => 'planner-activity-inspector',  'icon' => 'manage_search',   'title' => 'Activity Inspector',    'desc' => 'Right rail: selected-activity detail'],
            ['demo' => null,                          'icon' => 'play_circle',     'title' => 'Audio Player',          'desc' => 'ws_audio_player — voice note playback'],
        ],
    ],
];

// Count for the header
$total = 0;
foreach ($library as $cat) { $total += count($cat['items']); }
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Pattern Library</h1>
    <p><?= $total ?> production components organized by the problem they solve. Every entry links to a live demo with variants, options, accessibility notes, and code. New entries follow <code class="ds-code-inline">templates/component-page.php</code>.</p>
</div>

<!-- Quick Start -->
<section class="ds-section">
    <h2 class="ds-section-title">Quick Start</h2>
    <div class="ds-code"><pre>&lt;?php
// In your page file
require_once 'includes/components/helpers.php';

// In header.php, add the CSS
&lt;link rel="stylesheet" href="/includes/components/components.css"&gt;</pre></div>
    <p class="ds-section-desc" style="margin-top: 12px;">
        Jump to:
        <?php $first = true; foreach ($library as $key => $cat): ?>
            <?= $first ? '' : ' · ' ?><a href="#cat-<?= $key ?>"><?= $cat['title'] ?></a>
        <?php $first = false; endforeach; ?>
    </p>
</section>

<?php foreach ($library as $key => $cat): ?>
<section class="ds-section" id="cat-<?= $key ?>">
    <h2 class="ds-section-title"><?= $cat['title'] ?> <span style="font-weight: 400; color: #A8A29E; font-size: 0.8em;">(<?= count($cat['items']) ?>)</span></h2>
    <p class="ds-section-desc"><?= $cat['desc'] ?></p>
    <div class="ds-grid-3">
        <?php foreach ($cat['items'] as $c): ?>
            <?php if ($c['demo']): ?>
            <a href="<?= $ds_base ?>/components/demos/<?= $c['demo'] ?>.php" style="text-decoration: none; color: inherit;">
                <?php ws_card_start(['variant' => 'content', 'hoverable' => true]); ?>
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                        <span class="material-symbols-outlined" style="font-size: 22px; color: #486581;"><?= $c['icon'] ?></span>
                        <strong style="font-size: 15px;"><?= $c['title'] ?></strong>
                    </div>
                    <p style="font-size: 13px; color: #78716C; line-height: 1.5;"><?= $c['desc'] ?></p>
                <?php ws_card_end(); ?>
            </a>
            <?php else: ?>
                <?php ws_card_start(['variant' => 'content']); ?>
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px; opacity: 0.6;">
                        <span class="material-symbols-outlined" style="font-size: 22px; color: #A8A29E;"><?= $c['icon'] ?></span>
                        <strong style="font-size: 15px;"><?= $c['title'] ?></strong>
                        <span class="ds-status ds-status--beta" style="margin-left: auto;">docs pending</span>
                    </div>
                    <p style="font-size: 13px; color: #A8A29E; line-height: 1.5;"><?= $c['desc'] ?></p>
                <?php ws_card_end(); ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</section>
<?php endforeach; ?>

<!-- App-level patterns -->
<section class="ds-section" id="cat-app-patterns">
    <h2 class="ds-section-title">Documented App Patterns</h2>
    <p class="ds-section-desc">Compositions that live in app CSS today — the promotion queue for future <code class="ds-code-inline">ws_*</code> components. Each is specified in the linked doc.</p>
    <table class="ds-table">
        <thead><tr><th>Pattern</th><th>Lives in</th><th>Documented in</th></tr></thead>
        <tbody>
            <tr><td>Poll result card (leader emphasis, LIVE/FINAL chips)</td><td><code>facilitator/css/facilitator.css</code>, <code>css/facilitator/participant.css</code></td><td><code>motion-system.md</code> (progress, live-pulse)</td></tr>
            <tr><td>Reaction bubble with data-driven pulse</td><td><code>facilitator/css/facilitator.css</code></td><td><code>motion-system.md</code> (pop)</td></tr>
            <tr><td>Confirm dialog (icon tile → title → actions)</td><td><code>facilitator/css/facilitator.css</code> (<code>.confirm-card</code>)</td><td>design-system changelog v2.8.10</td></tr>
            <tr><td>Coach-mark tour (spotlight + tip)</td><td><code>facilitator/js/modules/onboarding.js</code></td><td>changelog v2.42.0</td></tr>
            <tr><td>First-run welcome overlay</td><td><code>facilitator/js/modules/onboarding.js</code></td><td>changelog v2.42.0</td></tr>
            <tr><td>Intervention / rescue card</td><td><code>facilitator/css/facilitator.css</code></td><td>Facilitator PRD §4.2E</td></tr>
        </tbody>
    </table>
</section>

<!-- File Reference -->
<section class="ds-section">
    <h2 class="ds-section-title">File Reference</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td>All ws_* helper functions</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>All component styles</td></tr>
            <tr><td><code>includes/components/components.js</code></td><td>Modal focus trap + interactive component JS</td></tr>
            <tr><td><code>design-system/templates/</code></td><td>Documentation templates for new entries</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
