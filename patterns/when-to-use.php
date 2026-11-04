<?php
$ds_page  = 'patterns/when-to-use';
$ds_title = 'When to Use';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>When to Use</h1>
    <p>Decision guidance for choosing the right component. When two components look similar, this guide helps you pick the correct one.</p>
</div>

<!-- Badge vs Status vs Chip -->
<section class="ds-section">
    <h2 class="ds-section-title">Badge vs Status vs Category</h2>
    <p class="ds-section-desc">All three render as small labels but serve different purposes.</p>

    <table class="ds-table">
        <thead>
            <tr>
                <th>Component</th>
                <th>Use For</th>
                <th>Example</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong><a href="<?= $ds_base ?>/components/demos/badge.php" style="color: #486581;">Badge</a></strong> <code>ws_badge()</code></td>
                <td>Generic metadata labels, counts, small tags</td>
                <td><code>ws_badge('NEW', ['variant' => 'new'])</code></td>
            </tr>
            <tr>
                <td><strong>Status</strong> <code>ws_status()</code></td>
                <td>State indicators with semantic colors (success, warning, error, info)</td>
                <td><code>ws_status('Completed', 'success')</code></td>
            </tr>
            <tr>
                <td><strong>Category</strong> <code>ws_category()</code></td>
                <td>Content type labels with custom colors matching the category palette</td>
                <td><code>ws_category('Ideation', '#F59E0B')</code></td>
            </tr>
            <tr>
                <td><strong>Duration</strong> <code>ws_duration()</code></td>
                <td>Time durations with clock icon</td>
                <td><code>ws_duration('45 min')</code></td>
            </tr>
        </tbody>
    </table>

    <div class="ds-note">
        <span class="material-symbols-outlined">info</span>
        <div><code>ws_status()</code>, <code>ws_category()</code>, and <code>ws_duration()</code> are all convenience wrappers around <code>ws_badge()</code>. They set the right variant and styling automatically.</div>
    </div>
</section>

<!-- Alert vs Toast -->
<section class="ds-section">
    <h2 class="ds-section-title">Alert vs Toast</h2>

    <table class="ds-table">
        <thead>
            <tr>
                <th>Component</th>
                <th>Use For</th>
                <th>Persistence</th>
                <th>Position</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong><a href="<?= $ds_base ?>/components/demos/alert.php" style="color: #486581;">Alert</a></strong> <code>ws_alert()</code></td>
                <td>Contextual messages that relate to page content &mdash; warnings, errors, info banners</td>
                <td>Persistent (stays in page flow)</td>
                <td>Inline with content</td>
            </tr>
            <tr>
                <td><strong><a href="<?= $ds_base ?>/components/demos/toast.php" style="color: #486581;">Toast</a></strong> <code>wsToastSuccess()</code></td>
                <td>Feedback from user actions &mdash; save confirmations, error responses, status changes</td>
                <td>Auto-dismiss (3&ndash;5 seconds)</td>
                <td>Fixed overlay (bottom-right)</td>
            </tr>
        </tbody>
    </table>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use Alert for:</strong>
            Form validation summaries, permission warnings, feature announcements, important notices that need to stay visible.
        </div>
        <div class="ds-dont">
            <strong>Use Toast for:</strong>
            "Saved!", "Copied to clipboard", "Item added to collection", "Error: try again" &mdash; transient feedback the user can miss.
        </div>
    </div>
</section>

<!-- Card vs Feature Card vs Listing Card -->
<section class="ds-section">
    <h2 class="ds-section-title">Card vs Feature Card vs Listing Card</h2>

    <table class="ds-table">
        <thead>
            <tr>
                <th>Component</th>
                <th>Use For</th>
                <th>Key Difference</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong><a href="<?= $ds_base ?>/components/demos/card.php" style="color: #486581;">Card</a></strong> <code>ws_card_start()</code></td>
                <td>Generic content containers &mdash; wraps any content with border, padding, optional hover</td>
                <td>No predefined layout; you build the inside</td>
            </tr>
            <tr>
                <td><strong><a href="<?= $ds_base ?>/components/demos/feature-card.php" style="color: #486581;">Feature Card</a></strong> <code>ws_feature_card()</code></td>
                <td>Marketing feature/benefit grids &mdash; icon + title + description</td>
                <td>Fixed icon-title-description structure</td>
            </tr>
            <tr>
                <td><strong><a href="<?= $ds_base ?>/components/demos/listing-card.php" style="color: #486581;">Listing Card</a></strong> <code>ws_listing_card()</code></td>
                <td>Content library items &mdash; workshops, exercises, icebreakers</td>
                <td>Has category icon, duration, footer actions, links to detail page</td>
            </tr>
        </tbody>
    </table>
</section>

<!-- Section Header vs Hero -->
<section class="ds-section">
    <h2 class="ds-section-title">Section Header vs Hero</h2>

    <table class="ds-table">
        <thead>
            <tr>
                <th>Component</th>
                <th>Use For</th>
                <th>Scale</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong><a href="<?= $ds_base ?>/components/demos/hero.php" style="color: #486581;">Hero</a></strong> <code>ws_hero()</code></td>
                <td>Page-level hero with badge, title, subtitle, buttons, stats, and optional image</td>
                <td>Full-width, top of page only</td>
            </tr>
            <tr>
                <td><strong><a href="<?= $ds_base ?>/components/demos/section-header.php" style="color: #486581;">Section Header</a></strong> <code>ws_section_header()</code></td>
                <td>Section titles within a page &mdash; features, content areas, form sections</td>
                <td>Contained width, repeated within page</td>
            </tr>
        </tbody>
    </table>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use Hero for:</strong>
            Landing page tops, app homepage, any page that needs a prominent call-to-action area.
        </div>
        <div class="ds-dont">
            <strong>Use Section Header for:</strong>
            "Features" section headings, "Related Workshops" headers, form group labels &mdash; anything mid-page.
        </div>
    </div>
</section>

<!-- Input vs Form Row -->
<section class="ds-section">
    <h2 class="ds-section-title">Input vs Form Row</h2>

    <table class="ds-table">
        <thead>
            <tr>
                <th>Component</th>
                <th>Use For</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong><a href="<?= $ds_base ?>/components/demos/input.php" style="color: #486581;">Input</a></strong> <code>ws_input()</code></td>
                <td>The raw field element. Has its own <code>label</code> option for simple cases. Use standalone when you need just a field.</td>
            </tr>
            <tr>
                <td><strong><a href="<?= $ds_base ?>/components/demos/form-row.php" style="color: #486581;">Form Row</a></strong> <code>ws_form_row()</code></td>
                <td>A layout wrapper. Use when building multi-field forms that need consistent spacing, external labels, helper text, or error messages. Wraps any field (input, select, textarea).</td>
            </tr>
        </tbody>
    </table>
</section>

<!-- Modal vs Drawer -->
<section class="ds-section">
    <h2 class="ds-section-title">Modal (Center) vs Modal (Drawer)</h2>

    <table class="ds-table">
        <thead>
            <tr>
                <th>Variant</th>
                <th>Use For</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Center Modal</strong> <code>variant: 'center'</code></td>
                <td>Confirmations, alerts, small forms, focused content. User must acknowledge before continuing.</td>
            </tr>
            <tr>
                <td><strong>Drawer</strong> <code>variant: 'drawer'</code></td>
                <td>Side panels for settings, filters, detail views. Can be used alongside main content.</td>
            </tr>
        </tbody>
    </table>
</section>

<!-- Progress vs Skeleton -->
<section class="ds-section">
    <h2 class="ds-section-title">Progress vs Skeleton</h2>

    <table class="ds-table">
        <thead>
            <tr>
                <th>Component</th>
                <th>Use For</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong><a href="<?= $ds_base ?>/components/demos/progress.php" style="color: #486581;">Progress</a></strong> <code>ws_progress()</code></td>
                <td>Known progress percentage (uploads, form completion, step progress). Shows a determinate bar or indeterminate spinner.</td>
            </tr>
            <tr>
                <td><strong><a href="<?= $ds_base ?>/components/demos/skeleton.php" style="color: #486581;">Skeleton</a></strong> <code>ws_skeleton()</code></td>
                <td>Content loading placeholders. Shows the shape of incoming content (text lines, avatars, cards) while data loads.</td>
            </tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
