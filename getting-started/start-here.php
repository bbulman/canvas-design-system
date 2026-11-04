<?php
$ds_page  = 'getting-started/start-here';
$ds_title = 'Start Here';

require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>Start Here</h1>
    <p>One entry point for designers, developers, and Claude. It tells you which file is authoritative for what, and where to go next. The written companion is <code>/design-system/START-HERE.md</code>.</p>
</div>

<!-- Source-of-truth hierarchy -->
<section class="ds-section">
    <h2 class="ds-section-title">The source-of-truth hierarchy</h2>
    <p style="margin-bottom: 16px; color: var(--color-ink-secondary, #57534E); max-width: 70ch;">
        Several documents describe Workshopr's look, voice, and components. They do <strong>not</strong> rank equally. When two files disagree, the higher one wins.
    </p>
    <div class="ds-card" style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
            <thead>
                <tr style="text-align: left; border-bottom: 2px solid var(--gray-200, #E7E5E4);">
                    <th style="padding: 8px 12px; width: 48px;">Rank</th>
                    <th style="padding: 8px 12px;">File</th>
                    <th style="padding: 8px 12px;">Authoritative for</th>
                    <th style="padding: 8px 12px; width: 110px;">Audience</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid var(--gray-100, #F5F5F4);">
                    <td style="padding: 8px 12px; font-weight: 700;">1</td>
                    <td style="padding: 8px 12px;"><code>/DESIGN.md</code> &middot; <code>/motion.md</code></td>
                    <td style="padding: 8px 12px;">Brand, voice, visual system, UX, forms &middot; motion stack — the canonical intent</td>
                    <td style="padding: 8px 12px;">Human + Claude</td>
                </tr>
                <tr style="border-bottom: 1px solid var(--gray-100, #F5F5F4);">
                    <td style="padding: 8px 12px; font-weight: 700;">2</td>
                    <td style="padding: 8px 12px;"><code>platform-tokens.css</code> &middot; <code>helpers.php</code></td>
                    <td style="padding: 8px 12px;">The literal token <em>values</em> and component <em>behavior</em> every app imports</td>
                    <td style="padding: 8px 12px;">Code</td>
                </tr>
                <tr style="border-bottom: 1px solid var(--gray-100, #F5F5F4);">
                    <td style="padding: 8px 12px; font-weight: 700;">3</td>
                    <td style="padding: 8px 12px;"><code>workshopr-design-system.json</code></td>
                    <td style="padding: 8px 12px;">Machine-readable mirror of tokens + component catalog + rules (hand-maintained)</td>
                    <td style="padding: 8px 12px;">Claude / tooling</td>
                </tr>
                <tr style="border-bottom: 1px solid var(--gray-100, #F5F5F4);">
                    <td style="padding: 8px 12px; font-weight: 700;">4</td>
                    <td style="padding: 8px 12px;"><code>workshopr-style-guide.md</code></td>
                    <td style="padding: 8px 12px;">Long-form written spec</td>
                    <td style="padding: 8px 12px;">Human</td>
                </tr>
                <tr>
                    <td style="padding: 8px 12px; font-weight: 700;">5</td>
                    <td style="padding: 8px 12px;">This site &middot; <code>app-*.php</code> &middot; <code>components/*.php</code></td>
                    <td style="padding: 8px 12px;">Live, rendered demos and per-app guides</td>
                    <td style="padding: 8px 12px;">Human (browser)</td>
                </tr>
            </tbody>
        </table>
    </div>
    <p style="margin-top: 16px; color: var(--color-ink-secondary, #57534E); max-width: 70ch;">
        <strong>Plain version:</strong> <code>DESIGN.md</code> + <code>motion.md</code> decide <em>intent</em>. <code>platform-tokens.css</code> + <code>helpers.php</code> are the <em>implementation truth</em>. The JSON is a convenience mirror, guarded against drift by <code>check-drift.php</code>. These demo pages are illustrative, not law.
    </p>
</section>

<!-- On-ramps -->
<section class="ds-section">
    <h2 class="ds-section-title">Pick your on-ramp</h2>
    <div class="ds-card-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px;">
        <div class="ds-card">
            <h3 style="margin: 0 0 8px; font-size: 16px;">&#129302; Claude / AI</h3>
            <ol style="margin: 0; padding-left: 18px; font-size: 14px; line-height: 1.7; color: var(--color-ink-secondary, #57534E);">
                <li><code>/DESIGN.md</code> — non-negotiable brand/voice/UX rules</li>
                <li><code>workshopr-design-system.json</code> — tokens, full <code>ws_*</code> catalog, the <code>rules</code> block</li>
                <li><code>helpers.php</code> — ground truth if JSON and a real function disagree</li>
                <li><code>app-&lt;name&gt;.php</code> — layout + the phase color to use</li>
            </ol>
        </div>
        <div class="ds-card">
            <h3 style="margin: 0 0 8px; font-size: 16px;">&#127912; Designer</h3>
            <ol style="margin: 0; padding-left: 18px; font-size: 14px; line-height: 1.7; color: var(--color-ink-secondary, #57534E);">
                <li><code>/DESIGN.md</code> — the brand and voice bible</li>
                <li>Browse this site: <a href="<?= $ds_base ?>/foundations/colors.php">Colors</a>, <a href="<?= $ds_base ?>/foundations/typography.php">Typography</a>, <a href="<?= $ds_base ?>/components/component-library.php">Components</a></li>
                <li><code>workshopr-style-guide.md</code> — the written deep-dive</li>
                <li><a href="<?= $ds_base ?>/apps/theming.php">App Theming</a> — per-app phase colors</li>
            </ol>
        </div>
        <div class="ds-card">
            <h3 style="margin: 0 0 8px; font-size: 16px;">&#128296; Developer</h3>
            <ol style="margin: 0; padding-left: 18px; font-size: 14px; line-height: 1.7; color: var(--color-ink-secondary, #57534E);">
                <li><code>@import 'platform-tokens.css'</code> — every color/space/type/radius/shadow var</li>
                <li>Use <code>ws_*</code> helpers (49 of them) — <a href="<?= $ds_base ?>/components/component-library.php">live demos</a></li>
                <li><code>ADOPTION.md</code> — what each app has migrated</li>
                <li>After any change: <code>php design-system/tools/check-drift.php</code></li>
            </ol>
        </div>
    </div>
</section>

<!-- Governance -->
<section class="ds-section">
    <h2 class="ds-section-title">Keeping it honest: drift control</h2>
    <p style="margin-bottom: 16px; color: var(--color-ink-secondary, #57534E); max-width: 70ch;">
        The JSON is a hand-maintained mirror, so two guards keep it from silently falling out of sync with the CSS and PHP. CI and the pre-commit hook enforce both.
    </p>
    <div class="ds-card-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
        <div class="ds-card">
            <h3 style="margin: 0 0 8px; font-size: 15px;"><code>check-drift.php</code></h3>
            <p style="margin: 0; font-size: 14px; line-height: 1.6; color: var(--color-ink-secondary, #57534E);">Fails if any <code>ws_*</code> helper is undocumented in the JSON (or vice-versa), or if phase-color tokens in <code>platform-tokens.css</code> disagree with the JSON. Resolves <code>var()</code> aliases.</p>
            <p style="margin: 10px 0 0;"><code style="font-size: 12px;">npm run lint:ds:drift</code></p>
        </div>
        <div class="ds-card">
            <h3 style="margin: 0 0 8px; font-size: 15px;"><code>generate-catalog.php</code></h3>
            <p style="margin: 0; font-size: 14px; line-height: 1.6; color: var(--color-ink-secondary, #57534E);">Generates <code>components.generated.json</code>, a source-derived roster of every <code>ws_*</code> helper (signature, summary, declared options) parsed from the <code>helpers.php</code> docblocks. The can't-drift companion to the curated JSON.</p>
            <p style="margin: 10px 0 0;"><code style="font-size: 12px;">npm run gen:ds:catalog</code></p>
        </div>
    </div>
</section>

<!-- Phase architecture + color exceptions -->
<section class="ds-section">
    <h2 class="ds-section-title">Four phases &amp; documented color exceptions</h2>
    <p style="margin-bottom: 16px; color: var(--color-ink-secondary, #57534E); max-width: 70ch;">
        <strong>LEARN</strong> (#E54D4D) &rarr; <strong>PLAN</strong> (#0284C7) &rarr; <strong>FACILITATE</strong> (#7C4DFF) &rarr; <strong>REFLECT</strong> (#10B981). Each app uses its phase color — <a href="<?= $ds_base ?>/apps/theming.php">with these sanctioned exceptions</a>:
    </p>
    <div class="ds-card">
        <ul style="margin: 0; padding-left: 18px; font-size: 14px; line-height: 1.8; color: var(--color-ink-secondary, #57534E);">
            <li><strong>Tips ships Facilitate purple</strong> (<code>#7C4DFF</code>), not Learn red — a deliberate cross-phase brand choice. (<code>apps.tips.colorNote</code>)</li>
            <li><strong>Academy/Training is Learn red</strong> (<code>#E54D4D</code>). The unimplemented "training = green" mapping was retired.</li>
            <li><strong>DNA</strong> surface primary is the lighter <code>#34D399</code>; the Reflect phase anchor is <code>#10B981</code> — layering within one phase, not drift.</li>
        </ul>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
