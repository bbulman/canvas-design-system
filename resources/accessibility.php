<?php
$ds_page  = 'resources/accessibility';
$ds_title = 'Accessibility';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>Accessibility</h1>
    <p>Workshopr targets WCAG AA compliance. Every interactive element must be keyboard-accessible, clearly focused, and properly labeled.</p>
</div>

<!-- Requirements overview -->
<section class="ds-section">
    <h2 class="ds-section-title">Requirements at a Glance</h2>

    <div style="display: flex; flex-direction: column; gap: 12px;">
        <?php
        $reqs = [
            ['icon' => 'contrast',         'title' => 'Color Contrast',    'desc' => 'WCAG AA: 4.5:1 for normal text, 3:1 for large text (18px+ bold or 24px+ regular).'],
            ['icon' => 'center_focus_strong', 'title' => 'Focus Visibility', 'desc' => 'box-shadow: 0 0 0 3px {app-light-color} on all interactive elements. Never use outline: none without a replacement.'],
            ['icon' => 'touch_app',        'title' => 'Touch Targets',     'desc' => 'Minimum 44x44px on mobile for all tap targets (buttons, links, form controls).'],
            ['icon' => 'label',            'title' => 'Form Labels',       'desc' => 'All inputs must have associated <label> elements. Placeholder text alone is never sufficient.'],
            ['icon' => 'image',            'title' => 'Icon Semantics',    'desc' => 'Standalone icons get aria-label. Decorative icons get aria-hidden="true".'],
            ['icon' => 'animation',        'title' => 'Motion',            'desc' => 'All transitions under 300ms with ease curve. No bouncy/spring effects. Respect prefers-reduced-motion.'],
            ['icon' => 'phone_iphone',     'title' => 'iOS Safe Areas',    'desc' => 'Fixed elements use env(safe-area-inset-top) and env(safe-area-inset-bottom).'],
        ];
        foreach ($reqs as $r): ?>
        <div class="ds-card" style="display: flex; gap: 16px; align-items: flex-start; padding: 16px 20px;">
            <div style="width: 40px; height: 40px; background: #DBEAFE; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 20px; color: #3B82F6;"><?php echo $r['icon']; ?></span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 14px; margin-bottom: 2px;"><?php echo htmlspecialchars($r['title'], ENT_QUOTES, 'UTF-8'); ?></div>
                <div style="font-size: 13px; color: #57534E; line-height: 1.6;"><?php echo $r['desc']; ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Color contrast -->
<section class="ds-section">
    <h2 class="ds-section-title">Color Contrast Checks</h2>
    <p class="ds-section-desc">Key text/background pairs and their approximate contrast ratios.</p>

    <table class="ds-table">
        <thead><tr><th>Pair</th><th>Text</th><th>Background</th><th>Ratio</th><th>Pass?</th></tr></thead>
        <tbody>
            <tr>
                <td>Ink on Page</td>
                <td><code>#2C2416</code></td>
                <td><code>#FEF7F1</code></td>
                <td>~12.5:1</td>
                <td style="color: #22C55E; font-weight: 600;">AAA</td>
            </tr>
            <tr>
                <td>Ink Secondary on Page</td>
                <td><code>#5C5242</code></td>
                <td><code>#FEF7F1</code></td>
                <td>~6.8:1</td>
                <td style="color: #22C55E; font-weight: 600;">AA</td>
            </tr>
            <tr>
                <td>Ink Muted on Page</td>
                <td><code>#78716C</code></td>
                <td><code>#FEF7F1</code></td>
                <td>~4.5:1</td>
                <td style="color: #22C55E; font-weight: 600;">AA</td>
            </tr>
            <tr>
                <td>White on Primary Red</td>
                <td><code>#FFFFFF</code></td>
                <td><code>#E54D4D</code></td>
                <td>~3.5:1</td>
                <td style="color: #22C55E; font-weight: 600;">AA Large</td>
            </tr>
            <tr>
                <td>White on Navy</td>
                <td><code>#FFFFFF</code></td>
                <td><code>#1A2744</code></td>
                <td>~14.2:1</td>
                <td style="color: #22C55E; font-weight: 600;">AAA</td>
            </tr>
            <tr>
                <td>Ink Faint on Page</td>
                <td><code>#A8A29E</code></td>
                <td><code>#FEF7F1</code></td>
                <td>~2.8:1</td>
                <td style="color: #F59E0B; font-weight: 600;">Decorative only</td>
            </tr>
        </tbody>
    </table>

    <div class="ds-note" style="margin-top: 16px;">
        <span class="material-symbols-outlined">warning</span>
        <span><code>--color-ink-faint</code> (#A8A29E) does not meet AA contrast on cream backgrounds. Use only for decorative text, disabled states, or placeholders -- never for essential content.</span>
    </div>
</section>

<!-- Focus states -->
<section class="ds-section">
    <h2 class="ds-section-title">Focus States</h2>
    <p class="ds-section-desc">Every interactive element gets a visible focus ring using box-shadow.</p>

    <div class="ds-code">/* Standard focus ring */
:focus-visible {
  outline: none;
  box-shadow: 0 0 0 3px var(--mainsite-light);  /* #FEE2E2 */
}

/* Per-app variants */
.planner :focus-visible { box-shadow: 0 0 0 3px var(--planner-very-light); }
.coach :focus-visible   { box-shadow: 0 0 0 3px var(--coach-very-light); }</div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Use box-shadow for focus</strong>
            <div style="font-size: 13px;">box-shadow doesn't affect layout and works with border-radius.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Remove outline with nothing</strong>
            <div style="font-size: 13px;">outline: none without a replacement makes elements invisible to keyboard users.</div>
        </div>
    </div>
</section>

<!-- Touch targets -->
<section class="ds-section">
    <h2 class="ds-section-title">Touch Targets</h2>

    <div class="ds-grid-2">
        <div class="ds-card" style="text-align: center;">
            <div style="width: 44px; height: 44px; background: #DCFCE7; border: 2px dashed #22C55E; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin: 0 auto 8px;">
                <span style="font-size: 11px; font-weight: 700; color: #22C55E;">44px</span>
            </div>
            <div style="font-weight: 600; font-size: 14px;">Minimum Target</div>
            <div style="font-size: 12px; color: #78716C;">Required on mobile</div>
        </div>
        <div class="ds-card" style="text-align: center;">
            <div style="width: 48px; height: 48px; background: #DBEAFE; border: 2px dashed #3B82F6; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin: 0 auto 8px;">
                <span style="font-size: 11px; font-weight: 700; color: #3B82F6;">48px</span>
            </div>
            <div style="font-weight: 600; font-size: 14px;">Recommended</div>
            <div style="font-size: 12px; color: #78716C;">Comfortable tap area</div>
        </div>
    </div>
</section>

<!-- ARIA patterns -->
<section class="ds-section">
    <h2 class="ds-section-title">ARIA Patterns</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Icons</h3>
        <div class="ds-code">&lt;!-- Standalone icon (meaningful) --&gt;
&lt;button aria-label="Delete item"&gt;
  &lt;span class="material-symbols-outlined"&gt;delete&lt;/span&gt;
&lt;/button&gt;

&lt;!-- Decorative icon (ignored by screen readers) --&gt;
&lt;span class="material-symbols-outlined" aria-hidden="true"&gt;schedule&lt;/span&gt;
&lt;span&gt;30 min&lt;/span&gt;</div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Modals</h3>
        <div class="ds-code">&lt;div role="dialog" aria-modal="true" aria-labelledby="modal-title"&gt;
  &lt;h2 id="modal-title"&gt;Confirm Action&lt;/h2&gt;
  &lt;!-- content --&gt;
&lt;/div&gt;</div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Reduced Motion</h3>
        <div class="ds-code">@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.01ms !important;
    transition-duration: 0.01ms !important;
  }
}</div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
