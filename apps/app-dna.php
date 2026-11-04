<?php
$ds_page  = 'apps/app-dna';
$ds_title = 'Facilitator DNA App Guide';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>Facilitator's DNA</h1>
    <p>A self-discovery microsite that helps facilitators uncover their natural style through a 15-question quiz. Five DNA profiles -- Energizer, Architect, Connector, Explorer, and Sage -- with shareable results, radar charts, and personalized growth insights.</p>
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
            <div style="font-weight: 600; color: #E54D4D;">Discover</div>
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
            <div style="font-weight: 600;">Fraunces + System Sans</div>
        </div>
    </div>
</section>

<!-- Design Philosophy -->
<section class="ds-section">
    <h2 class="ds-section-title">Design Philosophy</h2>
    <p class="ds-section-desc">DNA is a self-discovery tool. Every design choice should feel warm, inviting, and personal -- like a guided conversation, not a clinical assessment.</p>

    <div style="display: flex; flex-direction: column; gap: 16px;">
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FEE2E2; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #E54D4D;">self_improvement</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Warmth over clinical</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">This is self-discovery, not a test. The warm paper background (<code class="ds-code-inline">#FAF7F2</code>), Fraunces display font, and borders-only depth strategy create an approachable, journal-like feel. No heavy shadows.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FCA5A5; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #C73E3E;">palette</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Single red accent</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">All five profiles share one Learn red (<code class="ds-code-inline">#E54D4D</code>) rather than distinct colors. This keeps the brand unified and avoids implying any profile is "better" than another. Deliberate exception (June 2026): the DNA app ships Learn red; the Reflect phase token (<code class="ds-code-inline">--phase-reflect</code>) remains #10B981.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FCA5A5; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #C73E3E;">linear_scale</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Guided progression</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">The quiz flow (landing &rarr; quiz &rarr; results &rarr; profile) uses a narrow, centered container (<code class="ds-code-inline">600px</code> quiz, <code class="ds-code-inline">680px</code> results) to maintain focus. Progress bars and step numbers provide orientation.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #E54D4D; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #7F1D1D;">share</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Shareable by design</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Results are built for social sharing. Each profile has OG-optimized badge images, pre-written share text, and a share modal with LinkedIn/Twitter/copy-link options.</div>
            </div>
        </div>
    </div>
</section>

<!-- Color Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Color Tokens</h2>
    <p class="ds-section-desc">DNA uses a Learn red palette representing growth and discovery. Deliberate exception (June 2026): the DNA app ships Learn red; the Reflect phase token (<code class="ds-code-inline">--phase-reflect</code>) remains #10B981. All tokens are defined in <code class="ds-code-inline">css/dna/styles.css</code>.</p>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Accent Palette</h3>
        <div style="display: flex; gap: 8px; margin-bottom: 24px;">
            <?php
            $colors = [
                ['token' => '--accent', 'hex' => '#E54D4D', 'label' => 'Accent'],
                ['token' => '--accent-hover', 'hex' => '#C73E3E', 'label' => 'Hover'],
                ['token' => '--accent-light', 'hex' => '#FCA5A5', 'label' => 'Light'],
                ['token' => '--accent-very-light', 'hex' => '#FEE2E2', 'label' => 'Very Light'],
                ['token' => '--accent-bg', 'hex' => '#FEE2E2', 'label' => 'Background'],
            ];
            foreach ($colors as $c): ?>
            <div style="flex: 1; text-align: center;">
                <div style="height: 48px; background: <?= $c['hex'] ?>; border-radius: 8px; margin-bottom: 8px;<?= in_array($c['hex'], ['#FEE2E2', '#FCA5A5']) ? 'border: 1px solid #FCA5A5;' : '' ?>"></div>
                <div style="font-size: 12px; font-weight: 600; color: #475569;"><?= $c['label'] ?></div>
                <div style="font-family: 'JetBrains Mono', monospace; font-size: 11px; color: #94a3b8;"><?= $c['token'] ?></div>
                <div style="font-family: 'JetBrains Mono', monospace; font-size: 10px; color: #cbd5e1;"><?= $c['hex'] ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Surface & Text</h3>
        <div style="display: flex; gap: 8px; margin-bottom: 16px;">
            <?php
            $surfaces = [
                ['token' => '--bg-page', 'hex' => '#FAF7F2', 'label' => 'Page'],
                ['token' => '--bg-surface', 'hex' => '#ffffff', 'label' => 'Surface'],
                ['token' => '--bg-muted', 'hex' => '#F0EBE3', 'label' => 'Muted'],
                ['token' => '--text-primary', 'hex' => '#0f172a', 'label' => 'Text Primary'],
                ['token' => '--text-secondary', 'hex' => '#475569', 'label' => 'Text Secondary'],
                ['token' => '--text-muted', 'hex' => '#64748b', 'label' => 'Text Muted'],
            ];
            foreach ($surfaces as $s): ?>
            <div style="flex: 1; text-align: center;">
                <div style="height: 40px; background: <?= $s['hex'] ?>; border-radius: 6px; margin-bottom: 6px;<?= in_array($s['hex'], ['#FAF7F2', '#ffffff', '#F0EBE3']) ? 'border: 1px solid #E7E5E4;' : '' ?>"></div>
                <div style="font-size: 10px; font-weight: 600; color: #475569; line-height: 1.3;"><?= $s['label'] ?></div>
                <div style="font-family: 'JetBrains Mono', monospace; font-size: 9px; color: #94a3b8;"><?= $s['hex'] ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="ds-code"><pre>/* DNA app tokens -- Deliberate exception (June 2026): DNA ships Learn red;
   the Reflect phase token (--phase-reflect) remains #10B981. */
--accent: #E54D4D;
--accent-hover: #C73E3E;
--accent-dark: #C73E3E;
--accent-light: #FCA5A5;
--accent-very-light: #FEE2E2;
--accent-bg: #FEE2E2;
--accent-border: rgba(229, 77, 77, 0.3);

/* All 5 DNA profiles share Learn red */
--energizer: #E54D4D;
--architect: #E54D4D;
--connector: #E54D4D;
--explorer: #E54D4D;
--sage: #E54D4D;

/* Warm paper foundation */
--bg-page: #FAF7F2;
--bg-surface: #ffffff;
--bg-muted: #F0EBE3;

/* Borders-only depth */
--border: rgba(0, 0, 0, 0.08);
--shadow: 0 1px 3px rgba(0, 0, 0, 0.08); /* minimal */</pre></div>
</section>

<!-- DNA Profile Types -->
<section class="ds-section">
    <h2 class="ds-section-title">The 5 DNA Profiles</h2>
    <p class="ds-section-desc">Each profile represents a facilitation archetype. All share the red accent -- identity comes from icon and description, not color.</p>

    <div class="ds-grid-3" style="gap: 12px;">
        <?php
        $profiles = [
            ['name' => 'The Energizer', 'icon' => 'bolt', 'desc' => 'High-energy, keeps momentum and engagement through dynamic activities'],
            ['name' => 'The Architect', 'icon' => 'architecture', 'desc' => 'Methodical, designs structured experiences with clear outcomes'],
            ['name' => 'The Connector', 'icon' => 'diversity_3', 'desc' => 'Relationship-focused, creates safety and brings out every voice'],
            ['name' => 'The Explorer', 'icon' => 'explore', 'desc' => 'Curious, thrives in ambiguity and discovers unexpected insights'],
            ['name' => 'The Sage', 'icon' => 'self_improvement', 'desc' => 'Wisdom-focused, creates space for deep reflection and dialogue'],
        ];
        foreach ($profiles as $p): ?>
        <div class="ds-card" style="padding: 16px;">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                <div style="width: 32px; height: 32px; background: #FEE2E2; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined" style="font-size: 18px; color: #E54D4D;"><?= $p['icon'] ?></span>
                </div>
                <div style="font-weight: 600; font-size: 14px;"><?= $p['name'] ?></div>
            </div>
            <div style="font-size: 13px; color: #57534E; line-height: 1.5;"><?= $p['desc'] ?></div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Layout Patterns -->
<section class="ds-section">
    <h2 class="ds-section-title">Layout Patterns</h2>
    <p class="ds-section-desc">Each page in the DNA flow has a focused layout optimized for its purpose.</p>

    <table class="ds-table">
        <thead>
            <tr>
                <th>Page</th>
                <th>Max Width</th>
                <th>Key Pattern</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Landing</strong></td>
                <td><code>1080px</code></td>
                <td>2-col hero grid, 5-card profile row, 3-step how-it-works, dark CTA</td>
            </tr>
            <tr>
                <td><strong>Quiz</strong></td>
                <td><code>600px</code></td>
                <td>Centered card, progress bar, single-select options, back/forward nav</td>
            </tr>
            <tr>
                <td><strong>Results</strong></td>
                <td><code>680px</code></td>
                <td>Badge + title, radar chart, 2-col insights grid, match bars, share modal</td>
            </tr>
            <tr>
                <td><strong>Profile</strong></td>
                <td><code>720px</code></td>
                <td>Hero with badge, stacked info sections, bulleted lists, CTA banner</td>
            </tr>
            <tr>
                <td><strong>About</strong></td>
                <td><code>720px</code></td>
                <td>Content page explaining the methodology</td>
            </tr>
        </tbody>
    </table>
</section>

<!-- Key Components -->
<section class="ds-section">
    <h2 class="ds-section-title">Key Components</h2>
    <p class="ds-section-desc">DNA-specific UI patterns. The app is a standalone microsite with its own CSS rather than the shared component library.</p>

    <div style="display: flex; flex-direction: column; gap: 16px;">
        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">Quiz Card + Options</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #FEE2E2; color: #7F1D1D; border-radius: 100px; font-weight: 600;">DNA-specific</span>
            </div>
            <div style="font-size: 14px; color: #57534E; margin-bottom: 12px;">White card (<code class="ds-code-inline">.quiz-card</code>) with Fraunces question text and stacked option buttons. Options highlight with red border and background on hover/selection. Single-select only.</div>
            <div class="ds-code"><pre>&lt;div class="quiz-card"&gt;
  &lt;h2 class="quiz-question"&gt;...&lt;/h2&gt;
  &lt;div class="quiz-options"&gt;
    &lt;button class="quiz-option"&gt;Option text&lt;/button&gt;
    &lt;button class="quiz-option selected"&gt;Selected&lt;/button&gt;
  &lt;/div&gt;
&lt;/div&gt;</pre></div>
        </div>

        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">Progress Bar</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #FEE2E2; color: #7F1D1D; border-radius: 100px; font-weight: 600;">DNA-specific</span>
            </div>
            <div style="font-size: 14px; color: #57534E;">Thin 4px red bar with animated fill transition. Header shows "Question X of 15" left-aligned and percentage right-aligned in muted text.</div>
        </div>

        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">Radar Chart + Skill Scores</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #FEE2E2; color: #7F1D1D; border-radius: 100px; font-weight: 600;">DNA-specific</span>
            </div>
            <div style="font-size: 14px; color: #57534E;">SVG radar chart (<code class="ds-code-inline">280px</code> wide) showing scores across all 5 profiles. Below the chart, a 5-column grid displays tabular-nums scores with uppercase labels using monospace font.</div>
        </div>

        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">Share Modal</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #FEE2E2; color: #7F1D1D; border-radius: 100px; font-weight: 600;">DNA-specific</span>
            </div>
            <div style="font-size: 14px; color: #57534E;">Centered overlay with backdrop blur and animated entrance (scale + translateY). Pre-written share text preview, copy-to-clipboard button, and circular social buttons (LinkedIn, Twitter, email).</div>
        </div>

        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">Profile Badge Cards</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #FEE2E2; color: #7F1D1D; border-radius: 100px; font-weight: 600;">DNA-specific</span>
            </div>
            <div style="font-size: 14px; color: #57534E;">5-column grid of clickable profile cards with badge images, names, and taglines. All cards share the same red hover state. On mobile, the grid stays 5-wide with reduced padding.</div>
        </div>
    </div>
</section>

<!-- Do / Don't -->
<section class="ds-section">
    <h2 class="ds-section-title">Do / Don't</h2>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Use warm, encouraging language</strong>
            <div style="margin-top: 8px; font-size: 13px;">This is self-discovery, not evaluation. "Your superpower" and "growth edge" rather than "strengths" and "weaknesses".</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Rank or compare profiles</strong>
            <div style="margin-top: 8px; font-size: 13px;">No profile is better than another. Avoid language or design that implies hierarchy. All five use the same red accent intentionally.</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Keep the quiz flow focused</strong>
            <div style="margin-top: 8px; font-size: 13px;">Narrow containers (600px), no sidebar, one question at a time. The user should feel guided, not overwhelmed.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Show multiple questions per screen</strong>
            <div style="margin-top: 8px; font-size: 13px;">Even if faster, multi-question layouts feel like a form. One question per card maintains the conversational feel.</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Use borders-only depth strategy</strong>
            <div style="margin-top: 8px; font-size: 13px;">Cards use <code class="ds-code-inline">1px solid var(--border)</code> with no box-shadow. This keeps visual weight light and consistent with the paper aesthetic.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Add heavy shadows or elevation</strong>
            <div style="margin-top: 8px; font-size: 13px;">The DNA app avoids shadow-based depth. Only use <code class="ds-code-inline">--shadow</code> for modals and tooltips, never for static cards.</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Make sharing frictionless</strong>
            <div style="margin-top: 8px; font-size: 13px;">Pre-write share text, include OG images per profile, and offer one-click copy. Social proof drives quiz completions.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Require login to see results</strong>
            <div style="margin-top: 8px; font-size: 13px;">DNA is a top-of-funnel tool. No gates before results. Capture emails optionally afterward, not before.</div>
        </div>
    </div>
</section>

<!-- File Reference -->
<section class="ds-section">
    <h2 class="ds-section-title">File Reference</h2>

    <table class="ds-table">
        <thead>
            <tr>
                <th>File</th>
                <th>Purpose</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><code>dna/index.php</code></td>
                <td>Landing page with hero, profile cards, how-it-works, and CTA</td>
            </tr>
            <tr>
                <td><code>dna/quiz.php</code></td>
                <td>15-question guided quiz (client-side scoring, no server round-trips)</td>
            </tr>
            <tr>
                <td><code>dna/results.php</code></td>
                <td>Personalized results with radar chart, insights, and share modal</td>
            </tr>
            <tr>
                <td><code>dna/profile.php</code></td>
                <td>Deep-dive profile pages (<code>?type=energizer</code>)</td>
            </tr>
            <tr>
                <td><code>dna/about.php</code></td>
                <td>Methodology explanation page</td>
            </tr>
            <tr>
                <td><code>css/dna/styles.css</code></td>
                <td>All DNA styles and tokens (~1400 lines, standalone from platform-tokens)</td>
            </tr>
            <tr>
                <td><code>images/dna/badges/</code></td>
                <td>Profile badge images (display + LinkedIn OG variants)</td>
            </tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
