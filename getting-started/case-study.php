<?php
$ds_page  = 'getting-started/case-study';
$ds_title = 'Case Study: Facilitator DNA';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>Case Study: Facilitator's DNA</h1>
    <p>How we applied the Canvas Design System to build a self-discovery quiz microsite -- from shared foundations to a distinct product personality.</p>
</div>

<!-- The Brief -->
<section class="ds-section">
    <h2 class="ds-section-title">The Brief</h2>
    <p class="ds-section-desc">Build a top-of-funnel quiz that helps facilitators discover their natural style. Results must be shareable on social media. The experience should feel warm and personal, not like a corporate assessment tool.</p>

    <div class="ds-grid-3" style="margin-bottom: 24px;">
        <div class="ds-card">
            <div style="width: 40px; height: 40px; background: #D1FAE5; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
                <span class="material-symbols-outlined" style="font-size: 20px; color: #10B981;">target</span>
            </div>
            <div style="font-weight: 600; margin-bottom: 4px;">Goal</div>
            <div style="font-size: 14px; color: #78716C; line-height: 1.6;">Drive new users to the platform through shareable quiz results on LinkedIn and social media.</div>
        </div>
        <div class="ds-card">
            <div style="width: 40px; height: 40px; background: #DBEAFE; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
                <span class="material-symbols-outlined" style="font-size: 20px; color: #3B82F6;">schedule</span>
            </div>
            <div style="font-weight: 600; margin-bottom: 4px;">Constraint</div>
            <div style="font-size: 14px; color: #78716C; line-height: 1.6;">Must feel like Workshopr without depending on the full component library. Standalone CSS for microsite deployment.</div>
        </div>
        <div class="ds-card">
            <div style="width: 40px; height: 40px; background: #FEF3C7; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
                <span class="material-symbols-outlined" style="font-size: 20px; color: #F59E0B;">people</span>
            </div>
            <div style="font-weight: 600; margin-bottom: 4px;">Audience</div>
            <div style="font-size: 14px; color: #78716C; line-height: 1.6;">New and experienced facilitators. Many arriving from a shared LinkedIn post, not familiar with Workshopr yet.</div>
        </div>
    </div>
</section>

<!-- Design System Decisions -->
<section class="ds-section">
    <h2 class="ds-section-title">What We Took From the System</h2>
    <p class="ds-section-desc">The design system gave us a head start. Here's what carried over directly and what we adapted.</p>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Used directly</h3>
        <table class="ds-table">
            <thead>
                <tr>
                    <th>Foundation</th>
                    <th>Token / Pattern</th>
                    <th>How it was applied</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Warm paper background</strong></td>
                    <td><code>#FAF7F2</code></td>
                    <td>Page background. Immediately signals "Workshopr" to returning users while feeling inviting to newcomers.</td>
                </tr>
                <tr>
                    <td><strong>Fraunces display font</strong></td>
                    <td><code>font-display</code></td>
                    <td>Hero title, section headings, quiz questions. Creates warmth and personality that a system font can't match.</td>
                </tr>
                <tr>
                    <td><strong>4px spacing grid</strong></td>
                    <td><code>--space-1</code> through <code>--space-16</code></td>
                    <td>All padding, margins, and gaps use the same 4px multiple system. Keeps rhythm consistent.</td>
                </tr>
                <tr>
                    <td><strong>Unified header</strong></td>
                    <td><code>global-header.php</code></td>
                    <td>Shared navigation bar creates platform continuity. Users can navigate to other Workshopr apps from any DNA page.</td>
                </tr>
                <tr>
                    <td><strong>Border-radius scale</strong></td>
                    <td><code>6 / 8 / 12 / 16px</code></td>
                    <td>Same rounded corner system. Cards at 12px, buttons at 8px, hero sections at 16px.</td>
                </tr>
                <tr>
                    <td><strong>Text hierarchy</strong></td>
                    <td>4-level system</td>
                    <td>Primary (<code>#0f172a</code>), secondary (<code>#475569</code>), muted (<code>#64748b</code>), faint (<code>#94a3b8</code>). Identical to platform tokens.</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Adapted for DNA</h3>
        <table class="ds-table">
            <thead>
                <tr>
                    <th>Decision</th>
                    <th>System default</th>
                    <th>DNA adaptation</th>
                    <th>Why</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Accent color</strong></td>
                    <td>Coral <code>#E54D4D</code></td>
                    <td>Emerald <code>#10B981</code></td>
                    <td>Green signals growth and self-discovery. Distinct from every other app's accent.</td>
                </tr>
                <tr>
                    <td><strong>Depth strategy</strong></td>
                    <td>Shadows + borders</td>
                    <td>Borders only</td>
                    <td>Lighter visual weight for a calm, focused quiz experience. Shadows felt too heavy.</td>
                </tr>
                <tr>
                    <td><strong>Component library</strong></td>
                    <td><code>ws_*</code> PHP helpers</td>
                    <td>Standalone CSS classes</td>
                    <td>Microsite needed to work independently. Custom CSS follows the same patterns but without the PHP dependency.</td>
                </tr>
                <tr>
                    <td><strong>Body font</strong></td>
                    <td>Source Sans 3</td>
                    <td>System sans-serif stack</td>
                    <td>Faster loading for a viral microsite. System fonts eliminate a network request.</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="ds-note" style="margin-top: 16px;">
        <span class="material-symbols-outlined">psychology</span>
        <div><strong>Key lesson:</strong> A design system doesn't mean every product looks identical. The system provides shared DNA (warm paper, Fraunces, spacing grid) while the product adapts depth, color, and component strategy to its specific context.</div>
    </div>
</section>

<!-- The Design Challenge -->
<section class="ds-section">
    <h2 class="ds-section-title">The Design Challenge</h2>
    <p class="ds-section-desc">Three specific problems we had to solve, and how the design system informed each solution.</p>

    <div style="display: flex; flex-direction: column; gap: 16px;">
        <!-- Challenge 1 -->
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FEF2F2; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #E54D4D;">balance</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Challenge 1: Five profiles, no hierarchy</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6; margin-bottom: 12px;">The system's phase colors (red, blue, purple, green) assign meaning through differentiation. But DNA profiles shouldn't imply that one type is "better" than another. Giving each profile a unique color would create implicit ranking.</div>
                <div style="display: flex; gap: 12px;">
                    <div style="flex: 1; padding: 12px; background: #f0faf4; border: 1px solid #d4edda; border-radius: 8px; font-size: 13px;">
                        <strong style="color: #305a3c; display: block; margin-bottom: 4px;">Solution</strong>
                        <span style="color: #305a3c;">All five profiles share the same emerald green. Identity comes from icon and description, not color. This follows the system's principle that color carries meaning -- and here, the meaning is "equal."</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Challenge 2 -->
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #EDE9FE; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #7C4DFF;">psychology_alt</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Challenge 2: Assessment that doesn't feel like a test</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6; margin-bottom: 12px;">The system's philosophy says "warm, not cute" -- but a quiz can easily feel clinical or patronizing. Standard survey UX (numbered questions, radio buttons, submit) would undermine the emotional goal.</div>
                <div style="display: flex; gap: 12px;">
                    <div style="flex: 1; padding: 12px; background: #f0faf4; border: 1px solid #d4edda; border-radius: 8px; font-size: 13px;">
                        <strong style="color: #305a3c; display: block; margin-bottom: 4px;">Solution</strong>
                        <span style="color: #305a3c;">One question per screen inside a Fraunces-headed card. Scenario-based questions ("Your group is stuck...") instead of self-assessment statements. Auto-advance on selection. Borders-only depth keeps the UI visually quiet. The system's "progressive disclosure" principle applied to quiz flow.</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Challenge 3 -->
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #DBEAFE; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #0284C7;">share</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Challenge 3: Shareable results without losing brand</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6; margin-bottom: 12px;">LinkedIn previews render OG images at fixed sizes with minimal context. The brand needed to be recognizable in a 1200x630px card alongside dozens of other posts.</div>
                <div style="display: flex; gap: 12px;">
                    <div style="flex: 1; padding: 12px; background: #f0faf4; border: 1px solid #d4edda; border-radius: 8px; font-size: 13px;">
                        <strong style="color: #305a3c; display: block; margin-bottom: 4px;">Solution</strong>
                        <span style="color: #305a3c;">Per-profile OG images use the warm paper background and Fraunces typography -- instantly recognizable as Workshopr even at thumbnail size. The emerald accent and profile badge create visual identity. Pre-written share text includes the profile name and a call to action.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Page-by-Page Walkthrough -->
<section class="ds-section">
    <h2 class="ds-section-title">Page-by-Page Walkthrough</h2>
    <p class="ds-section-desc">How each page in the DNA flow applies design system principles.</p>

    <!-- Landing Page -->
    <div class="ds-card" style="margin-bottom: 24px;">
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
            <div style="width: 32px; height: 32px; background: #D1FAE5; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <span class="material-symbols-outlined" style="font-size: 18px; color: #10B981;">home</span>
            </div>
            <div style="font-weight: 600; font-size: 18px;">Landing Page</div>
            <code class="ds-code-inline" style="font-size: 12px;">dna/index.php</code>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
            <div>
                <div style="font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #94a3b8; margin-bottom: 8px;">System patterns used</div>
                <ul style="list-style: none; font-size: 14px; color: #57534E; line-height: 1.8;">
                    <li style="display: flex; align-items: center; gap: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: #10B981;">check_circle</span> 2-column hero grid (1080px max)</li>
                    <li style="display: flex; align-items: center; gap: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: #10B981;">check_circle</span> Fraunces italic accent in hero title</li>
                    <li style="display: flex; align-items: center; gap: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: #10B981;">check_circle</span> Stat row with dividers (mono font)</li>
                    <li style="display: flex; align-items: center; gap: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: #10B981;">check_circle</span> Card-based profile grid</li>
                    <li style="display: flex; align-items: center; gap: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: #10B981;">check_circle</span> 3-step "how it works" section</li>
                    <li style="display: flex; align-items: center; gap: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: #10B981;">check_circle</span> Dark CTA section (inverted text)</li>
                </ul>
            </div>
            <div>
                <div style="font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #94a3b8; margin-bottom: 8px;">DNA-specific choices</div>
                <ul style="list-style: none; font-size: 14px; color: #57534E; line-height: 1.8;">
                    <li style="display: flex; align-items: center; gap: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: #F59E0B;">star</span> 5-column profile grid (never wraps to 3+2)</li>
                    <li style="display: flex; align-items: center; gap: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: #F59E0B;">star</span> Badge images replace generic icons</li>
                    <li style="display: flex; align-items: center; gap: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: #F59E0B;">star</span> Grid paper background pattern</li>
                    <li style="display: flex; align-items: center; gap: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: #F59E0B;">star</span> OG metadata for shared profile links</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Quiz -->
    <div class="ds-card" style="margin-bottom: 24px;">
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
            <div style="width: 32px; height: 32px; background: #D1FAE5; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <span class="material-symbols-outlined" style="font-size: 18px; color: #10B981;">quiz</span>
            </div>
            <div style="font-weight: 600; font-size: 18px;">Quiz</div>
            <code class="ds-code-inline" style="font-size: 12px;">dna/quiz.php</code>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div>
                <div style="font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #94a3b8; margin-bottom: 8px;">System patterns used</div>
                <ul style="list-style: none; font-size: 14px; color: #57534E; line-height: 1.8;">
                    <li style="display: flex; align-items: center; gap: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: #10B981;">check_circle</span> Narrow centered container (600px)</li>
                    <li style="display: flex; align-items: center; gap: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: #10B981;">check_circle</span> Card with border depth</li>
                    <li style="display: flex; align-items: center; gap: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: #10B981;">check_circle</span> Emerald accent for selection state</li>
                    <li style="display: flex; align-items: center; gap: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: #10B981;">check_circle</span> Easing tokens for transitions</li>
                </ul>
            </div>
            <div>
                <div style="font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #94a3b8; margin-bottom: 8px;">DNA-specific choices</div>
                <ul style="list-style: none; font-size: 14px; color: #57534E; line-height: 1.8;">
                    <li style="display: flex; align-items: center; gap: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: #F59E0B;">star</span> Single-question-per-screen flow</li>
                    <li style="display: flex; align-items: center; gap: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: #F59E0B;">star</span> 4px thin progress bar (not full component)</li>
                    <li style="display: flex; align-items: center; gap: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: #F59E0B;">star</span> Client-side scoring (no server trips)</li>
                    <li style="display: flex; align-items: center; gap: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: #F59E0B;">star</span> Scenario-based question copy</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Results -->
    <div class="ds-card">
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
            <div style="width: 32px; height: 32px; background: #D1FAE5; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <span class="material-symbols-outlined" style="font-size: 18px; color: #10B981;">analytics</span>
            </div>
            <div style="font-weight: 600; font-size: 18px;">Results</div>
            <code class="ds-code-inline" style="font-size: 12px;">dna/results.php</code>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div>
                <div style="font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #94a3b8; margin-bottom: 8px;">System patterns used</div>
                <ul style="list-style: none; font-size: 14px; color: #57534E; line-height: 1.8;">
                    <li style="display: flex; align-items: center; gap: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: #10B981;">check_circle</span> Centered container (680px)</li>
                    <li style="display: flex; align-items: center; gap: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: #10B981;">check_circle</span> Card sections with consistent borders</li>
                    <li style="display: flex; align-items: center; gap: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: #10B981;">check_circle</span> Monospace font for data values</li>
                    <li style="display: flex; align-items: center; gap: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: #10B981;">check_circle</span> 2-column insight grid</li>
                </ul>
            </div>
            <div>
                <div style="font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #94a3b8; margin-bottom: 8px;">DNA-specific choices</div>
                <ul style="list-style: none; font-size: 14px; color: #57534E; line-height: 1.8;">
                    <li style="display: flex; align-items: center; gap: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: #F59E0B;">star</span> SVG radar chart (280px)</li>
                    <li style="display: flex; align-items: center; gap: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: #F59E0B;">star</span> Share modal with backdrop blur</li>
                    <li style="display: flex; align-items: center; gap: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: #F59E0B;">star</span> Pre-written share text per profile</li>
                    <li style="display: flex; align-items: center; gap: 8px;"><span class="material-symbols-outlined" style="font-size: 16px; color: #F59E0B;">star</span> "Best for" tags with hover lift</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Language & Tone -->
<section class="ds-section">
    <h2 class="ds-section-title">Language Decisions</h2>
    <p class="ds-section-desc">The Voice & Tone guide says Workshopr is "encouraging, clear, and grounded." Here's how that translated to DNA-specific copy.</p>

    <table class="ds-table">
        <thead>
            <tr>
                <th>Context</th>
                <th style="color: #991B1B;">Instead of</th>
                <th style="color: #305a3c;">We used</th>
                <th>Why</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Profile names</td>
                <td><span style="color: #991B1B;">Analytical Type</span></td>
                <td><span style="color: #305a3c;">The Architect</span></td>
                <td>Evocative names feel personal. "Type A/B" feels clinical.</td>
            </tr>
            <tr>
                <td>Strengths section</td>
                <td><span style="color: #991B1B;">Key strengths</span></td>
                <td><span style="color: #305a3c;">Your superpower</span></td>
                <td>Celebrates rather than evaluates. Every profile gets one.</td>
            </tr>
            <tr>
                <td>Weaknesses</td>
                <td><span style="color: #991B1B;">Areas for improvement</span></td>
                <td><span style="color: #305a3c;">Your growth edge</span></td>
                <td>Growth-oriented framing. Implies potential, not deficit.</td>
            </tr>
            <tr>
                <td>Score display</td>
                <td><span style="color: #991B1B;">Your score: 72%</span></td>
                <td><span style="color: #305a3c;">Radar chart + relative bars</span></td>
                <td>No single number. The blend is the insight, not a grade.</td>
            </tr>
            <tr>
                <td>CTA button</td>
                <td><span style="color: #991B1B;">Start Assessment</span></td>
                <td><span style="color: #305a3c;">Discover Your DNA</span></td>
                <td>"Assessment" signals judgment. "Discover" signals curiosity.</td>
            </tr>
        </tbody>
    </table>
</section>

<!-- What We Learned -->
<section class="ds-section">
    <h2 class="ds-section-title">What We Learned</h2>
    <p class="ds-section-desc">Takeaways that influenced the design system itself.</p>

    <div style="display: flex; flex-direction: column; gap: 16px;">
        <div class="ds-card" style="border-left: 4px solid #10B981;">
            <div style="font-weight: 600; margin-bottom: 8px;">Borders-only depth works</div>
            <p style="margin: 0; font-size: 14px; color: #57534E; line-height: 1.6;">DNA proved that subtle borders create clean, readable interfaces without shadows. This influenced the system's elevation guidelines to include "borders-only" as a documented depth tier alongside shadow-based elevation.</p>
        </div>
        <div class="ds-card" style="border-left: 4px solid #10B981;">
            <div style="font-weight: 600; margin-bottom: 8px;">Standalone CSS still needs system tokens</div>
            <p style="margin: 0; font-size: 14px; color: #57534E; line-height: 1.6;">DNA's standalone stylesheet duplicates every platform token. In hindsight, importing <code class="ds-code-inline">platform-tokens.css</code> and overriding only the accent would have been cleaner. Future microsites should extend, not duplicate.</p>
        </div>
        <div class="ds-card" style="border-left: 4px solid #10B981;">
            <div style="font-weight: 600; margin-bottom: 8px;">Emerald earned its spot in the palette</div>
            <p style="margin: 0; font-size: 14px; color: #57534E; line-height: 1.6;">DNA validated emerald green as a "Discover" phase color alongside the existing red (Learn), blue (Plan), and purple (Facilitate). It's now available as a system-level accent for future growth-oriented features.</p>
        </div>
        <div class="ds-card" style="border-left: 4px solid #10B981;">
            <div style="font-weight: 600; margin-bottom: 8px;">One-question-per-screen is worth the trade-off</div>
            <p style="margin: 0; font-size: 14px; color: #57534E; line-height: 1.6;">The progressive disclosure principle applied to quiz UX. More "screens" but dramatically better completion rates. The conversational flow outperformed every multi-question layout we tested.</p>
        </div>
    </div>
</section>

<!-- Metrics -->
<section class="ds-section">
    <h2 class="ds-section-title">By the Numbers</h2>

    <div class="ds-grid-4">
        <div class="ds-card" style="text-align: center; padding: 20px;">
            <div style="font-family: 'JetBrains Mono', monospace; font-size: 28px; font-weight: 700; color: #10B981; margin-bottom: 4px;">15</div>
            <div style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: #94a3b8;">Questions</div>
        </div>
        <div class="ds-card" style="text-align: center; padding: 20px;">
            <div style="font-family: 'JetBrains Mono', monospace; font-size: 28px; font-weight: 700; color: #10B981; margin-bottom: 4px;">5</div>
            <div style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: #94a3b8;">DNA Profiles</div>
        </div>
        <div class="ds-card" style="text-align: center; padding: 20px;">
            <div style="font-family: 'JetBrains Mono', monospace; font-size: 28px; font-weight: 700; color: #10B981; margin-bottom: 4px;">6</div>
            <div style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: #94a3b8;">Pages Built</div>
        </div>
        <div class="ds-card" style="text-align: center; padding: 20px;">
            <div style="font-family: 'JetBrains Mono', monospace; font-size: 28px; font-weight: 700; color: #10B981; margin-bottom: 4px;">1</div>
            <div style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: #94a3b8;">CSS File</div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
