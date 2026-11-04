<?php
$ds_page  = 'patterns/utilities';
$ds_title = 'Utility Classes';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>Utility Classes</h1>
    <p>Reusable layout, section, and grid utility classes used across the platform. Use these instead of writing inline styles.</p>
</div>

<!-- Container -->
<section class="ds-section">
    <h2 class="ds-section-title">Container</h2>
    <p class="ds-section-desc">Centered, max-width containers for page content. Defined in <code>css/styles.css</code> and <code>css/listing-redesign.css</code>.</p>

    <table class="ds-table">
        <thead>
            <tr>
                <th>Class</th>
                <th>Max-Width</th>
                <th>Token</th>
                <th>Usage</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><code>.container</code></td>
                <td>1120px</td>
                <td><code>--container-xl</code></td>
                <td>Default page content wrapper</td>
            </tr>
            <tr>
                <td><code>.hero-container</code></td>
                <td>1120px</td>
                <td><code>--container-xl</code></td>
                <td>Hero section inner wrapper</td>
            </tr>
            <tr>
                <td><code>.listing-content-grid</code></td>
                <td>1120px</td>
                <td><code>--container-xl</code></td>
                <td>Card grid on listing pages</td>
            </tr>
        </tbody>
    </table>

    <div class="ds-code"><pre>&lt;div class="container"&gt;
  &lt;!-- Content centered at max 1120px --&gt;
&lt;/div&gt;</pre></div>

    <div class="ds-note">
        <span class="material-symbols-outlined">info</span>
        <div>Use the <code>--container-*</code> tokens from <code>platform-tokens.css</code> when setting max-widths inline: <code>--container-xs</code> (480px), <code>--container-sm</code> (640px), <code>--container-md</code> (768px), <code>--container-lg</code> (960px), <code>--container-xl</code> (1120px), <code>--container-2xl</code> (1280px).</div>
    </div>
</section>

<!-- Section -->
<section class="ds-section">
    <h2 class="ds-section-title">Sections</h2>
    <p class="ds-section-desc">Section wrappers provide vertical padding and optional background colors. Defined in <code>css/styles.css</code>.</p>

    <table class="ds-table">
        <thead>
            <tr>
                <th>Class</th>
                <th>Behavior</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><code>.section</code></td>
                <td>Vertical padding (80px top/bottom), centered content</td>
            </tr>
            <tr>
                <td><code>.section-light</code></td>
                <td>White background (#FFFFFF)</td>
            </tr>
            <tr>
                <td><code>.section-alt</code></td>
                <td>Alternating gray background (gray-50)</td>
            </tr>
            <tr>
                <td><code>.section-dark</code></td>
                <td>Dark ink background (#2C2416), white text</td>
            </tr>
            <tr>
                <td><code>.section-navy</code></td>
                <td>Navy gradient background, white text</td>
            </tr>
            <tr>
                <td><code>.structured-section</code></td>
                <td>Content-focused section with centered text and grid</td>
            </tr>
            <tr>
                <td><code>.coming-soon</code></td>
                <td>Section for upcoming feature cards</td>
            </tr>
        </tbody>
    </table>

    <div class="ds-code"><pre>&lt;section class="section"&gt;
  &lt;?= ws_section_header('Section Title', ['subtitle' => 'Subtitle text']) ?&gt;
  &lt;div class="features-grid"&gt;
    &lt;!-- Content cards --&gt;
  &lt;/div&gt;
&lt;/section&gt;</pre></div>
</section>

<!-- Grids -->
<section class="ds-section">
    <h2 class="ds-section-title">Grids</h2>
    <p class="ds-section-desc">CSS Grid layout utilities for card grids and content layouts.</p>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Design System Grids</div>
        <p style="font-size: 14px; color: #64748b; margin-bottom: 16px;">Used within design system documentation pages. Defined in <code>ds-header.php</code>.</p>

        <table class="ds-table">
            <thead>
                <tr>
                    <th>Class</th>
                    <th>Columns</th>
                    <th>Gap</th>
                    <th>Mobile</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>.ds-grid-2</code></td>
                    <td>2 equal columns</td>
                    <td>16px</td>
                    <td>Stacks to 1 column</td>
                </tr>
                <tr>
                    <td><code>.ds-grid-3</code></td>
                    <td>3 equal columns</td>
                    <td>16px</td>
                    <td>Stacks to 1 column</td>
                </tr>
                <tr>
                    <td><code>.ds-grid-4</code></td>
                    <td>4 equal columns</td>
                    <td>16px</td>
                    <td>Stacks to 1 column</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Content Grids</div>
        <p style="font-size: 14px; color: #64748b; margin-bottom: 16px;">Used on public-facing pages. Defined in <code>css/styles.css</code> and <code>css/listing-redesign.css</code>.</p>

        <table class="ds-table">
            <thead>
                <tr>
                    <th>Class</th>
                    <th>Columns</th>
                    <th>Usage</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>.features-grid</code></td>
                    <td>3 columns (auto-fill, min 280px)</td>
                    <td>Feature cards on landing pages</td>
                </tr>
                <tr>
                    <td><code>.coming-soon-grid</code></td>
                    <td>2 columns</td>
                    <td>Coming soon feature cards</td>
                </tr>
                <tr>
                    <td><code>.listing-content-grid</code></td>
                    <td>3 columns (auto-fill, min 300px)</td>
                    <td>Listing cards (workshops, exercises, etc.)</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="ds-code"><pre>&lt;!-- Feature grid --&gt;
&lt;div class="features-grid"&gt;
  &lt;?= ws_feature_card('Title', 'Description', ['icon' => 'star']) ?&gt;
  &lt;?= ws_feature_card('Title', 'Description', ['icon' => 'star']) ?&gt;
&lt;/div&gt;

&lt;!-- Listing card grid --&gt;
&lt;div class="listing-content-grid"&gt;
  &lt;?php foreach($items as $item): ?&gt;
    &lt;?php renderListingCard($item); ?&gt;
  &lt;?php endforeach; ?&gt;
&lt;/div&gt;</pre></div>
</section>

<!-- Hero Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">Hero Classes</h2>
    <p class="ds-section-desc">Hero section layout classes. Defined in <code>css/styles.css</code>. See the <strong>ws_hero()</strong> component for the PHP helper.</p>

    <table class="ds-table">
        <thead>
            <tr>
                <th>Class</th>
                <th>Purpose</th>
            </tr>
        </thead>
        <tbody>
            <tr><td><code>.hero</code></td><td>Outer hero wrapper (full-width, padded)</td></tr>
            <tr><td><code>.hero-container</code></td><td>Inner container (max-width 1120px, flex layout)</td></tr>
            <tr><td><code>.hero-content</code></td><td>Text column (max-width 540px)</td></tr>
            <tr><td><code>.hero-badge</code></td><td>Small label above the title</td></tr>
            <tr><td><code>.hero-title</code></td><td>Primary heading (Fraunces, clamp-sized)</td></tr>
            <tr><td><code>.hero-title-accent</code></td><td>Italic + colored + underline span in title</td></tr>
            <tr><td><code>.hero-subtitle</code></td><td>Description paragraph below title</td></tr>
            <tr><td><code>.hero-actions</code></td><td>Button row</td></tr>
            <tr><td><code>.hero-stats</code></td><td>Stat row with dividers</td></tr>
            <tr><td><code>.hero-visual</code></td><td>Image/illustration column</td></tr>
        </tbody>
    </table>
</section>

<!-- Background Patterns -->
<section class="ds-section">
    <h2 class="ds-section-title">Background Patterns</h2>
    <p class="ds-section-desc">Texture classes for page backgrounds. See <a href="<?= $ds_base ?>/patterns/patterns.php" style="color: #486581;">Patterns & Templates</a> for visual reference.</p>

    <table class="ds-table">
        <thead>
            <tr>
                <th>Class</th>
                <th>Effect</th>
                <th>Used By</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><code>.hero-bg-pattern</code></td>
                <td>Dot pattern overlay on hero sections</td>
                <td>Main site, Tips, Coach</td>
            </tr>
            <tr>
                <td><code>bg-pattern-grid</code></td>
                <td>Fine grid lines on paper-colored background</td>
                <td>Tips, Intervention, Podcasts</td>
            </tr>
            <tr>
                <td><code>bg-pattern-dots</code></td>
                <td>Subtle dot texture</td>
                <td>Detail pages</td>
            </tr>
        </tbody>
    </table>
</section>

<!-- Breakpoints Reference -->
<section class="ds-section">
    <h2 class="ds-section-title">Breakpoints</h2>
    <p class="ds-section-desc">Standard breakpoints used across the platform. Use the raw pixel values in <code>@media</code> queries &mdash; CSS custom properties can't be used in media queries.</p>

    <table class="ds-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Value</th>
                <th>Token</th>
                <th>Usage</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Mobile</td>
                <td><code>480px</code></td>
                <td><code>--bp-mobile</code></td>
                <td>Small phones, compact layouts</td>
            </tr>
            <tr>
                <td>Mobile Landscape</td>
                <td><code>640px</code></td>
                <td><code>--bp-mobile-landscape</code></td>
                <td>Phones in landscape, small drawers</td>
            </tr>
            <tr>
                <td>Tablet</td>
                <td><code>768px</code></td>
                <td><code>--bp-tablet</code></td>
                <td>Primary breakpoint &mdash; grid collapse, nav toggle</td>
            </tr>
            <tr>
                <td>Tablet Landscape</td>
                <td><code>960px</code></td>
                <td><code>--bp-tablet-landscape</code></td>
                <td>Sidebar layouts, modals</td>
            </tr>
            <tr>
                <td>Desktop Small</td>
                <td><code>1120px</code></td>
                <td><code>--bp-desktop-sm</code></td>
                <td>Content container max-width</td>
            </tr>
            <tr>
                <td>Desktop</td>
                <td><code>1280px</code></td>
                <td><code>--bp-desktop</code></td>
                <td>Full desktop layouts</td>
            </tr>
        </tbody>
    </table>

    <div class="ds-code"><pre>/* Standard media query pattern */
@media (max-width: 768px) {
  .my-grid { grid-template-columns: 1fr; }
}

@media (max-width: 480px) {
  .my-element { padding: var(--space-4); }
}</pre></div>
</section>

<!-- Misc Utility Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">Miscellaneous</h2>

    <table class="ds-table">
        <thead>
            <tr>
                <th>Class</th>
                <th>Purpose</th>
                <th>Source</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><code>.check-list</code></td>
                <td>Unordered list with checkmark icons (green)</td>
                <td><code>css/styles.css</code></td>
            </tr>
            <tr>
                <td><code>.card-wrapper</code></td>
                <td>Generic card link wrapper with hover effects</td>
                <td><code>css/listing-redesign.css</code></td>
            </tr>
            <tr>
                <td><code>.listing-card</code></td>
                <td>Content listing card (workshops, exercises, etc.)</td>
                <td><code>css/listing-redesign.css</code></td>
            </tr>
            <tr>
                <td><code>.display-text</code></td>
                <td>Hero-scale display heading with accent <code>&lt;em&gt;</code></td>
                <td><code>css/styles.css</code></td>
            </tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
