<?php
$ds_page  = 'patterns/page-templates';
$ds_title = 'Page Templates';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>Page Templates</h1>
    <p>Standard page layouts for the main site: a page is <code>includes/header.php</code>, a <code>.container</code>, and <code>includes/footer.php</code>.</p>
</div>

<div class="ds-note">
    <span class="material-symbols-outlined">info</span>
    <div>These do not describe <code>/app/</code>. The consolidated app shell has its own frame and its own layout system &mdash; see <a href="../apps/app-shell-layouts.php">App Shell Layouts</a>.</div>
</div>

<!-- Standard Page -->
<section class="ds-section">
    <h2 class="ds-section-title">Standard Page</h2>
    <p class="ds-section-desc">The base template for all pages. Sets the page title, loads data, and wraps content between header and footer.</p>

    <div class="ds-code"><pre>&lt;?php
$page_title = 'Page Title';
require_once 'includes/data.php';
require_once 'includes/header.php';
?&gt;

&lt;div class="container"&gt;
  &lt;h1&gt;Page Title&lt;/h1&gt;
  &lt;!-- content --&gt;
&lt;/div&gt;

&lt;?php require_once 'includes/footer.php'; ?&gt;</pre></div>

    <div class="ds-note">
        <span class="material-symbols-outlined">info</span>
        <div><code>header.php</code> auto-loads component helpers, icon helper, and the unified header navigation. <code>footer.php</code> loads the toast container and component JavaScript.</div>
    </div>
</section>

<!-- Listing Page -->
<section class="ds-section">
    <h2 class="ds-section-title">Listing Page</h2>
    <p class="ds-section-desc">Used for workshops, exercises, and icebreakers. Features filtering, sorting, and a card grid.</p>

    <div style="display: flex; flex-direction: column; gap: 6px; margin-bottom: 20px;">
        <div style="padding: 12px 16px; background: #dbeafe; border-left: 3px solid #3b82f6; border-radius: 4px; font-size: 13px;"><strong>Header</strong> &mdash; Unified nav bar</div>
        <div style="padding: 12px 16px; background: #fef3c7; border-left: 3px solid #f59e0b; border-radius: 4px; font-size: 13px;"><strong>Hero</strong> &mdash; <code>ws_hero()</code> with title, subtitle, stats</div>
        <div style="padding: 12px 16px; background: #f0fdf4; border-left: 3px solid #22c55e; border-radius: 4px; font-size: 13px;"><strong>Filter Bar</strong> &mdash; Category tabs + search + sort</div>
        <div style="padding: 12px 16px; background: #fafaf9; border-left: 3px solid #a8a29e; border-radius: 4px; font-size: 13px;"><strong>Card Grid</strong> &mdash; <code>.listing-content-grid</code> with <code>ws_listing_card()</code> items</div>
        <div style="padding: 12px 16px; background: #f5f3ff; border-left: 3px solid #8b5cf6; border-radius: 4px; font-size: 13px;"><strong>Footer</strong> &mdash; Site footer</div>
    </div>

    <div class="ds-code"><pre>&lt;?php
$page_title = 'Workshops';
require_once 'includes/data.php';
require_once 'includes/listing-helpers.php';
require_once 'includes/header.php';

$pageData = prepareListingPageData($workshops, 'workshop');
?&gt;

&lt;?= ws_hero('Browse our curated', 'workshop library.', [
    'badge' => 'Workshop Library',
    'badgeIcon' => 'school',
    'subtitle' => 'Find the perfect framework...',
]) ?&gt;

&lt;section class="section"&gt;
  &lt;div class="listing-content-grid"&gt;
    &lt;?php foreach ($pageData['items'] as $item):
      $card = prepareCardData($item, $pageData);
      echo ws_listing_card($card);
    endforeach; ?&gt;
  &lt;/div&gt;
&lt;/section&gt;

&lt;?php require_once 'includes/footer.php'; ?&gt;</pre></div>
</section>

<!-- Detail Page -->
<section class="ds-section">
    <h2 class="ds-section-title">Detail Page</h2>
    <p class="ds-section-desc">Content detail pages for individual workshops, exercises, and icebreakers. Features a hero area, content body, and sidebar.</p>

    <div style="display: flex; flex-direction: column; gap: 6px; margin-bottom: 20px;">
        <div style="padding: 12px 16px; background: #dbeafe; border-left: 3px solid #3b82f6; border-radius: 4px; font-size: 13px;"><strong>Header</strong> &mdash; Unified nav bar</div>
        <div style="padding: 12px 16px; background: #fef3c7; border-left: 3px solid #f59e0b; border-radius: 4px; font-size: 13px;"><strong>Breadcrumb</strong> &mdash; <code>ws_breadcrumb()</code></div>
        <div style="padding: 12px 16px; background: #f0fdf4; border-left: 3px solid #22c55e; border-radius: 4px; font-size: 13px;"><strong>Detail Header</strong> &mdash; Title, badges, actions</div>
        <div style="padding: 12px 16px; background: #fafaf9; border-left: 3px solid #a8a29e; border-radius: 4px; font-size: 13px;"><strong>Content + Sidebar</strong> &mdash; Two-column layout (main content left, metadata right)</div>
        <div style="padding: 12px 16px; background: #fef2f2; border-left: 3px solid #ef4444; border-radius: 4px; font-size: 13px;"><strong>Related Items</strong> &mdash; <code>.listing-content-grid</code> with related cards</div>
        <div style="padding: 12px 16px; background: #f5f3ff; border-left: 3px solid #8b5cf6; border-radius: 4px; font-size: 13px;"><strong>Footer</strong> &mdash; Site footer</div>
    </div>

    <div class="ds-code"><pre>&lt;?php
$page_title = $workshop['title'];
require_once 'includes/data.php';
require_once 'includes/header.php';
?&gt;

&lt;?= ws_breadcrumb([
    ['label' => 'Home', 'href' => '/'],
    ['label' => 'Workshops', 'href' => '/library/workshops/'],
    ['label' => $workshop['title']],
]) ?&gt;

&lt;div class="detail-layout"&gt;
  &lt;main class="detail-content"&gt;
    &lt;!-- Content body --&gt;
  &lt;/main&gt;
  &lt;aside class="detail-sidebar"&gt;
    &lt;!-- Metadata, actions --&gt;
  &lt;/aside&gt;
&lt;/div&gt;

&lt;?php require_once 'includes/footer.php'; ?&gt;</pre></div>
</section>

<!-- Landing Page -->
<section class="ds-section">
    <h2 class="ds-section-title">Landing Page</h2>
    <p class="ds-section-desc">Marketing/landing pages for apps (Coach, Tips, Podcasts). Feature-heavy with hero, feature grids, and CTAs.</p>

    <div style="display: flex; flex-direction: column; gap: 6px; margin-bottom: 20px;">
        <div style="padding: 12px 16px; background: #dbeafe; border-left: 3px solid #3b82f6; border-radius: 4px; font-size: 13px;"><strong>Header</strong> &mdash; Unified nav bar (can hide for standalone)</div>
        <div style="padding: 12px 16px; background: #fef3c7; border-left: 3px solid #f59e0b; border-radius: 4px; font-size: 13px;"><strong>Hero Section</strong> &mdash; <code>ws_hero()</code></div>
        <div style="padding: 12px 16px; background: #f0fdf4; border-left: 3px solid #22c55e; border-radius: 4px; font-size: 13px;"><strong>Features Section</strong> &mdash; <code>ws_section_header()</code> + <code>.features-grid</code></div>
        <div style="padding: 12px 16px; background: #fafaf9; border-left: 3px solid #a8a29e; border-radius: 4px; font-size: 13px;"><strong>Content Section</strong> &mdash; Mixed content + sample cards</div>
        <div style="padding: 12px 16px; background: #fef2f2; border-left: 3px solid #ef4444; border-radius: 4px; font-size: 13px;"><strong>Coming Soon</strong> &mdash; <code>.coming-soon-grid</code> with future feature cards</div>
        <div style="padding: 12px 16px; background: #f5f3ff; border-left: 3px solid #8b5cf6; border-radius: 4px; font-size: 13px;"><strong>Footer</strong> &mdash; Site footer</div>
    </div>
</section>

<!-- Form Page -->
<section class="ds-section">
    <h2 class="ds-section-title">Form Page</h2>
    <p class="ds-section-desc">Settings, admin forms, and data entry pages. Use <code>ws_form_row()</code> for consistent field layouts.</p>

    <div class="ds-code"><pre>&lt;?php
$page_title = 'Settings';
require_once 'includes/header.php';
?&gt;

&lt;div class="container" style="max-width: var(--container-sm);"&gt;
  &lt;?= ws_section_header('Account Settings', ['align' => 'left']) ?&gt;

  &lt;form style="display: flex; flex-direction: column; gap: 20px;"&gt;
    &lt;?= ws_form_row(ws_input('name', ['value' => $user['name']]), [
        'label' => 'Display Name',
        'required' => true,
    ]) ?&gt;
    &lt;?= ws_form_row(ws_input('email', ['type' => 'email', 'value' => $user['email']]), [
        'label' => 'Email',
        'required' => true,
        'helper' => 'Used for sign-in and notifications.',
    ]) ?&gt;
    &lt;?= ws_form_row(ws_select('timezone', $timezones), [
        'label' => 'Timezone',
    ]) ?&gt;
    &lt;?= ws_button('Save Changes', ['variant' => 'primary', 'type' => 'submit']) ?&gt;
  &lt;/form&gt;
&lt;/div&gt;

&lt;?php require_once 'includes/footer.php'; ?&gt;</pre></div>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
