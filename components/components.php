<?php
$ds_page  = 'components/components';
$ds_title = 'Components';

require_once __DIR__ . '/../../includes/icon.php';
require_once __DIR__ . '/../../includes/components/helpers.php';
require_once __DIR__ . '/../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Components</h1>
    <p>Reusable UI building blocks. Live interactive demos with the PHP code you need to implement them.</p>
</div>

<!-- Buttons -->
<section class="ds-section">
    <h2 class="ds-section-title">Buttons</h2>
    <p class="ds-section-desc">Three main variants: Primary (gradient CTA), Secondary (outlined), and Ghost (minimal). All use 10px radius and semibold weight.</p>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Primary Button</h3>
        <p style="font-size: 13px; color: var(--gray-500); margin-bottom: 12px;">Red gradient, white text. Used for main CTAs.</p>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
            <?= ws_button('Small', ['variant' => 'primary', 'size' => 'sm']) ?>
            <?= ws_button('Default', ['variant' => 'primary']) ?>
            <?= ws_button('Large', ['variant' => 'primary', 'size' => 'lg']) ?>
            <?= ws_button('With Icon', ['variant' => 'primary', 'icon' => 'add']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_button('Default', ['variant' => 'primary']) ?&gt;
&lt;?= ws_button('With Icon', ['variant' => 'primary', 'icon' => 'add']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Secondary Button</h3>
        <p style="font-size: 13px; color: var(--gray-500); margin-bottom: 12px;">Cream background, navy border, navy text. For secondary actions.</p>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
            <?= ws_button('Secondary', ['variant' => 'secondary']) ?>
            <?= ws_button('Settings', ['variant' => 'secondary', 'icon' => 'settings']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_button('Secondary', ['variant' => 'secondary']) ?&gt;
&lt;?= ws_button('Settings', ['variant' => 'secondary', 'icon' => 'settings']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Ghost Button</h3>
        <p style="font-size: 13px; color: var(--gray-500); margin-bottom: 12px;">Transparent background, subtle border. For less prominent actions.</p>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
            <?= ws_button('Ghost', ['variant' => 'ghost']) ?>
            <?= ws_button('Cancel', ['variant' => 'ghost', 'icon' => 'close']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_button('Ghost', ['variant' => 'ghost']) ?&gt;
&lt;?= ws_button('Cancel', ['variant' => 'ghost', 'icon' => 'close']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Danger Button</h3>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
            <?= ws_button('Delete', ['variant' => 'danger']) ?>
            <?= ws_button('Remove', ['variant' => 'danger', 'icon' => 'delete']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_button('Delete', ['variant' => 'danger']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">States</h3>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
            <?= ws_button('Disabled', ['variant' => 'primary', 'disabled' => true]) ?>
            <?= ws_button('Loading', ['variant' => 'primary', 'loading' => true]) ?>
            <?= ws_button('Full Width', ['variant' => 'secondary', 'fullWidth' => true]) ?>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Size Modifiers</h3>
        <table class="ds-table">
            <thead><tr><th>Size</th><th>Code</th></tr></thead>
            <tbody>
                <tr><td>Small</td><td><code>'size' => 'sm'</code></td></tr>
                <tr><td>Medium (default)</td><td><code>'size' => 'md'</code></td></tr>
                <tr><td>Large</td><td><code>'size' => 'lg'</code></td></tr>
            </tbody>
        </table>
    </div>
</section>

<!-- Cards -->
<section class="ds-section">
    <h2 class="ds-section-title">Cards</h2>
    <p class="ds-section-desc">Cards are the primary content container. Use <code class="ds-code-inline">ws_card()</code> for simple cards or <code class="ds-code-inline">ws_card_start()</code> / <code class="ds-code-inline">ws_card_end()</code> for complex content.</p>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Basic Card</h3>
        <div class="ds-card">
            <?= ws_card('This is a basic card with simple text content.') ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_card('This is a basic card with simple text content.') ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Card with Title</h3>
        <div class="ds-card">
            <?= ws_card('<h3>Card Title</h3><p>A card description that provides useful information.</p>') ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_card('&lt;h3&gt;Card Title&lt;/h3&gt;&lt;p&gt;Description text.&lt;/p&gt;') ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Custom Card Content</h3>
        <div class="ds-card">
            <?php ws_card_start(); ?>
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                    <?= ws_avatar('Workshop', ['size' => 'md']) ?>
                    <div>
                        <div style="font-weight: 600; font-size: 16px; color: var(--text-primary);">Team Workshop</div>
                        <div style="font-size: 13px; color: var(--text-secondary);">Design Sprint &middot; 45 min</div>
                    </div>
                </div>
                <p style="font-size: 14px; color: var(--text-secondary); line-height: 1.5; margin-bottom: 16px;">A collaborative exercise for rapid ideation and prototyping.</p>
                <div style="display: flex; gap: 8px;">
                    <?= ws_category('Ideation') ?>
                    <?= ws_duration('45 min') ?>
                </div>
            <?php ws_card_end(); ?>
        </div>
        <div class="ds-code"><pre>&lt;?php ws_card_start(); ?&gt;
    &lt;!-- Custom card content --&gt;
&lt;?php ws_card_end(); ?&gt;</pre></div>
    </div>
</section>

<!-- Inputs -->
<section class="ds-section">
    <h2 class="ds-section-title">Inputs</h2>
    <p class="ds-section-desc">All inputs use 12px radius, consistent padding, and a focus ring in the app's accent color.</p>

    <div class="ds-card">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div>
                <?= ws_input('demo_text', ['label' => 'Text Input', 'placeholder' => 'Enter text...']) ?>
            </div>
            <div>
                <?= ws_input('demo_email', ['label' => 'Email Input', 'type' => 'email', 'placeholder' => 'you@example.com']) ?>
            </div>
            <div>
                <?= ws_input('demo_search', ['label' => 'Search', 'type' => 'search', 'placeholder' => 'Search...']) ?>
            </div>
            <div>
                <?= ws_input('demo_disabled', ['label' => 'Disabled', 'placeholder' => 'Disabled', 'disabled' => true]) ?>
            </div>
        </div>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_input('field', ['label' => 'Label', 'placeholder' => 'Enter text...']) ?&gt;
&lt;?= ws_input('q', ['label' => 'Search', 'type' => 'search']) ?&gt;</pre></div>
</section>

<!-- Badges -->
<section class="ds-section">
    <h2 class="ds-section-title">Badges</h2>
    <p class="ds-section-desc">Category, status, and duration badges for labeling content.</p>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Variants</h3>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
            <?= ws_badge('Default') ?>
            <?= ws_status('Success', 'success') ?>
            <?= ws_status('Warning', 'warning') ?>
            <?= ws_status('Error', 'error') ?>
            <?= ws_status('Info', 'info') ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_status('Success', 'success') ?&gt;
&lt;?= ws_status('Warning', 'warning') ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With Icons</h3>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
            <?= ws_badge('Active', ['variant' => 'status', 'status' => 'success', 'icon' => 'check_circle']) ?>
            <?= ws_badge('Pending', ['variant' => 'status', 'status' => 'warning', 'icon' => 'schedule']) ?>
            <?= ws_badge('Error', ['variant' => 'status', 'status' => 'error', 'icon' => 'error']) ?>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Duration Badge</h3>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
            <?= ws_duration('15 min') ?>
            <?= ws_duration('30 min') ?>
            <?= ws_duration('1 hour') ?>
            <?= ws_duration('1h 30m') ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_duration('30 min') ?&gt;
&lt;?= ws_duration('1h 30m') ?&gt;</pre></div>
    </div>
</section>

<!-- Alerts -->
<section class="ds-section">
    <h2 class="ds-section-title">Alerts</h2>
    <p class="ds-section-desc">Contextual feedback messages for user actions.</p>

    <div class="ds-card" style="display: flex; flex-direction: column; gap: 12px;">
        <?= ws_alert('This is a success message.', ['variant' => 'success']) ?>
        <?= ws_alert('This is a warning message.', ['variant' => 'warning']) ?>
        <?= ws_alert('This is an error message.', ['variant' => 'error']) ?>
        <?= ws_alert('This is an informational message.', ['variant' => 'info']) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_alert('Message text.', ['variant' => 'success']) ?&gt;
&lt;?= ws_alert('Warning text.', ['variant' => 'warning']) ?&gt;</pre></div>
</section>

<!-- Avatar -->
<section class="ds-section">
    <h2 class="ds-section-title">Avatars</h2>
    <p class="ds-section-desc">User images with initials fallback.</p>

    <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 16px; align-items: center;">
        <?= ws_avatar('Bill Bulman', ['size' => 'sm']) ?>
        <?= ws_avatar('Jane Doe', ['size' => 'md']) ?>
        <?= ws_avatar('Alex Smith', ['size' => 'lg']) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_avatar('Bill Bulman', ['size' => 'sm']) ?&gt;
&lt;?= ws_avatar('Jane Doe', ['size' => 'md']) ?&gt;
&lt;?= ws_avatar('Alex Smith', ['size' => 'lg']) ?&gt;</pre></div>
</section>

<!-- Select -->
<section class="ds-section">
    <h2 class="ds-section-title">Select</h2>
    <p class="ds-section-desc">Dropdown select fields styled consistently with inputs.</p>

    <div class="ds-card" style="max-width: 320px;">
        <?= ws_select('demo_category', [
            '' => 'Select a category...',
            'ideation' => 'Ideation',
            'team-building' => 'Team Building',
            'strategy' => 'Strategy',
            'retrospective' => 'Retrospective',
        ], ['label' => 'Category']) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_select('category', [
    '' => 'Select...',
    'ideation' => 'Ideation',
    'strategy' => 'Strategy',
], ['label' => 'Category']) ?&gt;</pre></div>
</section>

<!-- Modals -->
<section class="ds-section">
    <h2 class="ds-section-title">Modals</h2>
    <p class="ds-section-desc">Five size presets. Below 600px, modals convert to bottom sheets.</p>

    <div class="ds-card">
        <?= ws_button('Open Demo Modal', ['variant' => 'primary', 'attrs' => ['onclick' => "document.getElementById('demo-modal').classList.add('ws-modal--open')"]]) ?>
    </div>

    <?php ws_modal_start(['id' => 'demo-modal', 'title' => 'Example Modal', 'size' => 'default']); ?>
        <p style="color: var(--text-secondary); line-height: 1.6;">This is a live modal rendered using the <code>ws_modal_start()</code> and <code>ws_modal_end()</code> helpers.</p>
        <?= ws_modal_footer([
            'primary' => ['text' => 'Confirm', 'variant' => 'primary'],
            'cancel' => ['text' => 'Cancel'],
        ]) ?>
    <?php ws_modal_end(); ?>

    <table class="ds-table" style="margin-top: 16px;">
        <thead><tr><th>Size</th><th>Max Width</th><th>Use Case</th></tr></thead>
        <tbody>
            <tr><td>Small</td><td>360px</td><td>Confirmations, simple actions</td></tr>
            <tr><td>Default</td><td>500px</td><td>Standard forms, details</td></tr>
            <tr><td>Large</td><td>640px</td><td>Complex forms, settings</td></tr>
            <tr><td>XL</td><td>800px</td><td>Multi-step flows</td></tr>
            <tr><td>Full</td><td><code>100vw - 48px</code></td><td>Image viewers, rich editors</td></tr>
        </tbody>
    </table>

    <div class="ds-note">
        <span class="material-symbols-outlined">phone_iphone</span>
        <span><strong>Mobile behavior (below 600px):</strong> Modals convert to bottom sheets with full width, rounded top corners (20px), and a drag indicator bar.</span>
    </div>
</section>

<!-- Empty States -->
<section class="ds-section">
    <h2 class="ds-section-title">Empty States</h2>
    <p class="ds-section-desc">Placeholder content when data is not available.</p>

    <div class="ds-card">
        <?= ws_empty_state('No items found', [
            'icon' => 'inbox',
            'description' => 'Get started by creating your first item.',
            'action' => ws_button('Create Item', ['variant' => 'primary', 'icon' => 'add']),
        ]) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_empty_state('No items found', [
    'icon' => 'inbox',
    'description' => 'Get started by creating your first item.',
    'action' => ws_button('Create Item', ['variant' => 'primary', 'icon' => 'add']),
]) ?&gt;</pre></div>
</section>

<!-- Tabs -->
<section class="ds-section">
    <h2 class="ds-section-title">Tabs</h2>
    <p class="ds-section-desc">Navigation tabs for switching between views.</p>

    <div class="ds-card">
        <?= ws_tabs([
            ['label' => 'Exercises', 'active' => true],
            ['label' => 'Icebreakers'],
            ['label' => 'Workshops'],
            ['label' => 'Templates'],
        ]) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_tabs([
    ['label' => 'Exercises', 'active' => true],
    ['label' => 'Icebreakers'],
    ['label' => 'Workshops'],
]) ?&gt;</pre></div>
</section>

<!-- Progress -->
<section class="ds-section">
    <h2 class="ds-section-title">Progress</h2>
    <p class="ds-section-desc">Visual progress indicators.</p>

    <div class="ds-card" style="display: flex; flex-direction: column; gap: 16px;">
        <?= ws_progress(25, ['label' => 'Getting Started']) ?>
        <?= ws_progress(60, ['label' => 'In Progress']) ?>
        <?= ws_progress(100, ['label' => 'Complete']) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_progress(60, ['label' => 'In Progress']) ?&gt;</pre></div>
</section>

<!-- Accordion -->
<section class="ds-section">
    <h2 class="ds-section-title">Accordion</h2>
    <p class="ds-section-desc">Expandable content sections.</p>

    <div class="ds-card">
        <?= ws_accordion([
            ['title' => 'What is Workshopr?', 'content' => 'Workshopr is a comprehensive workshop facilitation platform with an integrated AI Coach.'],
            ['title' => 'How do I get started?', 'content' => 'Sign up for a free account and explore the exercise library to find activities for your next workshop.'],
            ['title' => 'Can I collaborate with my team?', 'content' => 'Yes! The My Workshopr dashboard supports team collaboration on shared workshops.'],
        ]) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_accordion([
    ['title' => 'Question?', 'content' => 'Answer text.'],
    ['title' => 'Another?', 'content' => 'More details.'],
]) ?&gt;</pre></div>
</section>

<!-- Tooltip -->
<section class="ds-section">
    <h2 class="ds-section-title">Tooltip</h2>
    <p class="ds-section-desc">Contextual information on hover.</p>

    <div class="ds-card" style="display: flex; gap: 24px; align-items: center;">
        <?= ws_tooltip('Hover over me', ['text' => 'This is a helpful tooltip']) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_tooltip('Hover over me', ['text' => 'This is a helpful tooltip']) ?&gt;</pre></div>
</section>

<!-- Breadcrumb -->
<section class="ds-section">
    <h2 class="ds-section-title">Breadcrumb</h2>
    <p class="ds-section-desc">Navigation breadcrumbs for wayfinding.</p>

    <div class="ds-card">
        <?= ws_breadcrumb([
            ['label' => 'Home', 'href' => '/'],
            ['label' => 'Library', 'href' => '/library'],
            ['label' => 'Exercises', 'href' => '/library/exercises'],
            ['label' => 'Dot Voting'],
        ]) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_breadcrumb([
    ['label' => 'Home', 'href' => '/'],
    ['label' => 'Library', 'href' => '/library'],
    ['label' => 'Current Page'],
]) ?&gt;</pre></div>
</section>

<!-- Skeleton -->
<section class="ds-section">
    <h2 class="ds-section-title">Skeleton</h2>
    <p class="ds-section-desc">Loading placeholders that indicate content is being loaded.</p>

    <div class="ds-card">
        <?= ws_skeleton(['variant' => 'card']) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_skeleton(['variant' => 'card']) ?&gt;</pre></div>
</section>

<!-- Stats -->
<section class="ds-section">
    <h2 class="ds-section-title">Stats</h2>
    <p class="ds-section-desc">Numeric statistics with labels.</p>

    <div class="ds-card">
        <?= ws_stats([
            ['value' => '2,847', 'label' => 'Exercises'],
            ['value' => '156', 'label' => 'Workshops'],
            ['value' => '12k+', 'label' => 'Facilitators'],
            ['value' => '4.8', 'label' => 'Rating'],
        ]) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_stats([
    ['value' => '2,847', 'label' => 'Exercises'],
    ['value' => '156', 'label' => 'Workshops'],
]) ?&gt;</pre></div>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
