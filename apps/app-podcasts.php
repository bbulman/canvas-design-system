<?php
$ds_page  = 'apps/app-podcasts';
$ds_title = 'Podcasts App Guide';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>Podcasts App</h1>
    <p>The Workshopr Podcast is an audio-first content experience for facilitation tips, workshop methods, and design thinking discussions. Shares the warm, paper-textured aesthetic with Tips but uses a crimson accent for its own identity.</p>
</div>

<!-- App Identity -->
<section class="ds-section">
    <h2 class="ds-section-title" style="display: flex; align-items: center; gap: 10px;">
        <span style="width: 12px; height: 12px; background: #BE123C; border-radius: 4px;"></span>
        App Identity
    </h2>

    <div class="ds-grid-3" style="margin-bottom: 24px;">
        <div class="ds-card">
            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; margin-bottom: 8px;">Phase</div>
            <div style="font-weight: 600; color: #BE123C;">Learn</div>
        </div>
        <div class="ds-card">
            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; margin-bottom: 8px;">Primary Color</div>
            <div style="display: flex; align-items: center; gap: 8px;">
                <span style="width: 20px; height: 20px; background: #BE123C; border-radius: 4px;"></span>
                <code class="ds-code-inline">#BE123C</code>
            </div>
        </div>
        <div class="ds-card">
            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; margin-bottom: 8px;">Font Stack</div>
            <div style="font-weight: 600;">Fraunces + Inter (shared)</div>
        </div>
    </div>
</section>

<!-- Design Philosophy -->
<section class="ds-section">
    <h2 class="ds-section-title">Design Philosophy</h2>
    <p class="ds-section-desc">The podcast experience channels an audio studio aesthetic -- warm, tactile, and focused on listening. It shares the paper-like warmth of Tips but with a deeper crimson identity and audio-centric UI patterns.</p>

    <div style="display: flex; flex-direction: column; gap: 16px;">
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FFE4E6; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #BE123C;">podcasts</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Audio-first hierarchy</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">The latest episode gets a hero-sized player card. Episode listings lead with play controls. Everything is designed to get users listening quickly, with reading as a secondary action.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FECDD3; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #9F1239;">palette</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Crimson accent on warm paper</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Crimson (<code class="ds-code-inline">#BE123C</code>) is deeper than the Tips coral. Paired with the shared paper background (<code class="ds-code-inline">#FAF7F2</code>), it creates a rich, editorial feel suited for long-form audio content.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FEE2E2; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #BE123C;">image</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Episode artwork as anchor</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Each episode card features a generated cover image. The artwork uses warm gradients and abstract patterns that reinforce the episode theme. Missing artwork falls back to a crimson gradient placeholder.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #FFE4E6; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #9F1239;">share</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Multi-platform distribution</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Platform links (Spotify, Amazon Music, iHeart Radio, Substack) use each platform's brand color as accent. The subscribe bar appears prominently to drive platform follows.</div>
            </div>
        </div>
    </div>
</section>

<!-- Color Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Color Tokens</h2>
    <p class="ds-section-desc">Crimson palette for the podcast identity. Deeper and more editorial than Tips coral.</p>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Core Palette</h3>
        <div style="display: flex; gap: 8px; margin-bottom: 24px;">
            <?php
            $colors = [
                ['token' => '--color-accent', 'hex' => '#BE123C', 'label' => 'Primary (Crimson)'],
                ['token' => '--color-accent-dark', 'hex' => '#9F1239', 'label' => 'Dark'],
                ['token' => '--color-accent-light', 'hex' => '#FECDD3', 'label' => 'Light'],
                ['token' => '--color-accent-very-light', 'hex' => '#FFE4E6', 'label' => 'Very Light'],
            ];
            foreach ($colors as $c): ?>
            <div style="flex: 1; text-align: center;">
                <div style="height: 48px; background: <?= $c['hex'] ?>; border-radius: 8px; margin-bottom: 8px;<?= in_array($c['hex'], ['#FECDD3', '#FFE4E6']) ? 'border: 1px solid #E7E5E4;' : '' ?>"></div>
                <div style="font-size: 12px; font-weight: 600; color: #475569;"><?= $c['label'] ?></div>
                <div style="font-family: 'JetBrains Mono', monospace; font-size: 11px; color: #94a3b8;"><?= $c['token'] ?></div>
                <div style="font-family: 'JetBrains Mono', monospace; font-size: 10px; color: #cbd5e1;"><?= $c['hex'] ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Shared Surface Palette</h3>
        <div style="display: flex; gap: 8px; margin-bottom: 16px;">
            <?php
            $surfaces = [
                ['token' => '--color-paper', 'hex' => '#FAF7F2', 'label' => 'Paper'],
                ['token' => '--color-paper-dark', 'hex' => '#F0EBE3', 'label' => 'Paper Dark'],
                ['token' => '--color-kraft', 'hex' => '#D4C4A8', 'label' => 'Kraft'],
                ['token' => '--color-ink', 'hex' => '#2C2416', 'label' => 'Ink'],
                ['token' => '--color-ink-light', 'hex' => '#5C5242', 'label' => 'Ink Light'],
                ['token' => '--color-pencil', 'hex' => '#78716C', 'label' => 'Pencil'],
            ];
            foreach ($surfaces as $s): ?>
            <div style="flex: 1; text-align: center;">
                <div style="height: 40px; background: <?= $s['hex'] ?>; border-radius: 6px; margin-bottom: 6px;<?= in_array($s['hex'], ['#FAF7F2', '#F0EBE3', '#D4C4A8']) ? 'border: 1px solid #E7E5E4;' : '' ?>"></div>
                <div style="font-size: 10px; font-weight: 600; color: #475569; line-height: 1.3;"><?= $s['label'] ?></div>
                <div style="font-family: 'JetBrains Mono', monospace; font-size: 9px; color: #94a3b8;"><?= $s['hex'] ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Platform Brand Colors</h3>
        <div style="display: flex; gap: 8px; margin-bottom: 16px;">
            <?php
            $platforms = [
                ['token' => '--color-spotify', 'hex' => '#1DB954', 'label' => 'Spotify'],
                ['token' => '--color-amazon', 'hex' => '#FF9900', 'label' => 'Amazon Music'],
                ['token' => '--color-iheart', 'hex' => '#C6002B', 'label' => 'iHeart Radio'],
                ['token' => '--color-substack', 'hex' => '#FF6719', 'label' => 'Substack'],
            ];
            foreach ($platforms as $p): ?>
            <div style="flex: 1; text-align: center;">
                <div style="height: 40px; background: <?= $p['hex'] ?>; border-radius: 6px; margin-bottom: 6px;"></div>
                <div style="font-size: 10px; font-weight: 600; color: #475569; line-height: 1.3;"><?= $p['label'] ?></div>
                <div style="font-family: 'JetBrains Mono', monospace; font-size: 9px; color: #94a3b8;"><?= $p['hex'] ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="ds-code"><pre>/* Podcast app tokens */
--color-accent: #BE123C;           /* Primary crimson */
--color-accent-dark: #9F1239;      /* Dark crimson */
--color-accent-light: #FECDD3;     /* Light crimson */
--color-accent-very-light: #FFE4E6;/* Very light crimson */
--shadow-accent: 0 4px 14px rgba(190, 18, 60, 0.3);

/* Shared warm surfaces (from Tips) */
--color-paper: #FAF7F2;
--color-paper-dark: #F0EBE3;
--color-kraft: #D4C4A8;
--color-ink: #2C2416;
--color-ink-light: #5C5242;
--color-pencil: #78716C;

/* Platform brand colors */
--color-spotify: #1DB954;
--color-amazon: #FF9900;
--color-iheart: #C6002B;
--color-substack: #FF6719;</pre></div>
</section>

<!-- Layout Patterns -->
<section class="ds-section">
    <h2 class="ds-section-title">Layout Patterns</h2>
    <p class="ds-section-desc">Two-page app: listings index with hero player, and episode detail with embedded audio.</p>

    <div class="ds-card" style="margin-bottom: 16px;">
        <div style="font-weight: 600; margin-bottom: 12px;">Listings Page Structure</div>
        <div class="ds-code"><pre>┌────────────────────────────────────────────────┐
│  Unified Header (main site nav)                │
├────────────────────────────────────────────────┤
│                                                │
│  ┌────────────────────────────────────────────┐│
│  │  Hero: Latest Episode (full-width card)    ││
│  │  [Cover Art]  Title / Description / Play   ││
│  │               Stats: Episodes | Weekly     ││
│  └────────────────────────────────────────────┘│
│                                                │
│  ┌──────────────────────────────────────────┐  │
│  │  Platform Subscribe Bar (Spotify, etc.)  │  │
│  └──────────────────────────────────────────┘  │
│                                                │
│  ┌──────┐ ┌──────┐ ┌──────┐                   │
│  │ Ep.  │ │ Ep.  │ │ Ep.  │                   │
│  │ Card │ │ Card │ │ Card │  ...              │
│  │      │ │      │ │      │                   │
│  └──────┘ └──────┘ └──────┘                   │
│                                                │
│  Grid: repeat(auto-fill, minmax(350px, 1fr))   │
│  Max container: 1140px                         │
│                                                │
└────────────────────────────────────────────────┘</pre></div>
    </div>

    <div class="ds-card" style="margin-bottom: 16px;">
        <div style="font-weight: 600; margin-bottom: 12px;">Episode Detail Structure</div>
        <div class="ds-code"><pre>┌────────────────────────────────────────────────┐
│  Unified Header                                │
├────────────────────────────────────────────────┤
│                                                │
│  ← Back to Episodes                           │
│                                                │
│  ┌────────────────────────────────────────────┐│
│  │  Episode Hero                              ││
│  │  [Cover Art]  S01E05 · Category            ││
│  │               Title                        ││
│  │               Description                  ││
│  │               [▶ Play] [Subscribe]         ││
│  └────────────────────────────────────────────┘│
│                                                │
│  ┌────────────────────────────────────────────┐│
│  │  Embedded Substack Audio Player            ││
│  └────────────────────────────────────────────┘│
│                                                │
│  ┌────────────────────────────────────────────┐│
│  │  Show Notes / Transcript (long-form text)  ││
│  └────────────────────────────────────────────┘│
│                                                │
│  Related Episodes (3 cards)                    │
│                                                │
└────────────────────────────────────────────────┘</pre></div>
    </div>

    <table class="ds-table">
        <thead>
            <tr>
                <th>Element</th>
                <th>Spec</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Container max-width</td>
                <td><code>1140px</code></td>
            </tr>
            <tr>
                <td>Container padding</td>
                <td><code>32px</code></td>
            </tr>
            <tr>
                <td>Section spacing</td>
                <td><code>80px</code></td>
            </tr>
            <tr>
                <td>Episode grid gap</td>
                <td><code>auto-fill, minmax(350px, 1fr)</code></td>
            </tr>
            <tr>
                <td>Page background</td>
                <td><code>--color-paper (#FAF7F2)</code></td>
            </tr>
            <tr>
                <td>Card background</td>
                <td><code>white</code></td>
            </tr>
            <tr>
                <td>Card shadow</td>
                <td><code>--shadow-paper</code></td>
            </tr>
        </tbody>
    </table>
</section>

<!-- Key Components -->
<section class="ds-section">
    <h2 class="ds-section-title">Key Components</h2>

    <div style="display: flex; flex-direction: column; gap: 16px;">
        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">Episode Card</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #FFE4E6; color: #9F1239; border-radius: 100px; font-weight: 600;">Podcast-specific</span>
            </div>
            <div style="font-size: 14px; color: #57534E; margin-bottom: 12px;">White card with episode artwork, season/episode badge, title, description, and play button. Hover lifts the card with an elevated shadow. Artwork uses a 1:1 aspect ratio with 12px radius.</div>
            <div class="ds-code"><pre>.episode-card {
    background: var(--color-white);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--shadow-paper);
    transition: all 0.3s var(--ease-out);
    cursor: pointer;
}
.episode-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-card);
}</pre></div>
        </div>

        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">Hero Player Card</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #FFE4E6; color: #9F1239; border-radius: 100px; font-weight: 600;">Podcast-specific</span>
            </div>
            <div style="font-size: 14px; color: #57534E; margin-bottom: 12px;">Full-width featured card for the latest episode. Two-column layout with large cover art on the left and episode details + play/subscribe CTAs on the right. Stats bar shows episode count and release schedule.</div>
        </div>

        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">Platform Subscribe Bar</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #FFE4E6; color: #9F1239; border-radius: 100px; font-weight: 600;">Podcast-specific</span>
            </div>
            <div style="font-size: 14px; color: #57534E; margin-bottom: 12px;">Horizontal strip with platform logos and brand-colored link buttons (Spotify green, Amazon orange, iHeart crimson, Substack orange). Each link opens the podcast on that platform. Centered layout with platform icon + label.</div>
            <div style="display: flex; gap: 12px; flex-wrap: wrap; margin-top: 8px;">
                <div style="display: flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 100px; background: #F0FFF4; color: #1DB954; font-size: 13px; font-weight: 600; border: 1px solid #1DB95440;">
                    <span class="material-symbols-outlined" style="font-size: 16px;">music_note</span>
                    Spotify
                </div>
                <div style="display: flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 100px; background: #FFFBEB; color: #D97706; font-size: 13px; font-weight: 600; border: 1px solid #FF990040;">
                    <span class="material-symbols-outlined" style="font-size: 16px;">music_note</span>
                    Amazon Music
                </div>
                <div style="display: flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 100px; background: #FFF1F2; color: #C6002B; font-size: 13px; font-weight: 600; border: 1px solid #C6002B40;">
                    <span class="material-symbols-outlined" style="font-size: 16px;">favorite</span>
                    iHeart Radio
                </div>
                <div style="display: flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 100px; background: #FFF7ED; color: #EA580C; font-size: 13px; font-weight: 600; border: 1px solid #FF671940;">
                    <span class="material-symbols-outlined" style="font-size: 16px;">mail</span>
                    Substack
                </div>
            </div>
        </div>

        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">Embedded Audio Player</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #F1F5F9; color: #64748B; border-radius: 100px; font-weight: 600;">Third-party embed</span>
            </div>
            <div style="font-size: 14px; color: #57534E;">Substack-hosted audio player embedded via iframe on the episode detail page. Styled with a card wrapper to match the paper aesthetic. Provides play/pause, progress, and speed controls.</div>
        </div>

        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <div style="font-weight: 600; font-size: 16px;">Episode Artwork Placeholder</div>
                <span style="font-size: 12px; padding: 3px 10px; background: #FFE4E6; color: #9F1239; border-radius: 100px; font-weight: 600;">Podcast-specific</span>
            </div>
            <div style="font-size: 14px; color: #57534E;">When episode artwork is missing, a gradient placeholder fills the space. Uses a crimson-to-dark gradient with a centered podcast icon. Maintains the 1:1 aspect ratio of the artwork slot.</div>
        </div>
    </div>
</section>

<!-- Do / Don't -->
<section class="ds-section">
    <h2 class="ds-section-title">Do / Don't</h2>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Use crimson, not Tips coral</strong>
            <div style="margin-top: 8px; font-size: 13px;"><code class="ds-code-inline">#BE123C</code> for Podcasts, <code class="ds-code-inline">#F87171</code> for Tips. The deeper crimson conveys editorial authority suited for audio content.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Mix crimson with Tips coral</strong>
            <div style="margin-top: 8px; font-size: 13px;">Each app has its own accent. Using <code class="ds-code-inline">#F87171</code> in the podcast UI breaks the app identity boundary.</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Use platform brand colors for links</strong>
            <div style="margin-top: 8px; font-size: 13px;">Spotify green, Amazon orange, etc. Users recognize these instantly and trust the links.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Style all platform links with the crimson accent</strong>
            <div style="margin-top: 8px; font-size: 13px;">Generic styling makes platform links look like internal navigation. Brand colors communicate "this takes you to Spotify."</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Lead with audio controls</strong>
            <div style="margin-top: 8px; font-size: 13px;">Play buttons should be the most prominent interactive element on every episode card and detail page.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Bury the play action below the fold</strong>
            <div style="margin-top: 8px; font-size: 13px;">This is an audio experience. If users have to scroll to press play, the hierarchy is wrong.</div>
        </div>
    </div>
</section>

<!-- Typography -->
<section class="ds-section">
    <h2 class="ds-section-title">Typography</h2>
    <p class="ds-section-desc">Podcasts uses the shared platform type stack — Fraunces for display and Inter for body — matching Tips and Intervention.</p>

    <table class="ds-table">
        <thead>
            <tr>
                <th>Role</th>
                <th>Font</th>
                <th>Usage</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Display / Headings</td>
                <td><code>Fraunces</code></td>
                <td>Episode titles, hero heading, section titles</td>
            </tr>
            <tr>
                <td>Body / UI</td>
                <td><code>Inter</code></td>
                <td>Descriptions, metadata, buttons, navigation</td>
            </tr>
            <tr>
                <td>Accent / Serif</td>
                <td><code>Fraunces</code> (italic)</td>
                <td>Decorative pull-quotes, season labels</td>
            </tr>
        </tbody>
    </table>
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
                <td><code>/podcasts/index.php</code></td>
                <td>Episode listings with hero player</td>
            </tr>
            <tr>
                <td><code>/podcasts/episode.php</code></td>
                <td>Episode detail with embedded audio</td>
            </tr>
            <tr>
                <td><code>/css/podcasts/styles.css</code></td>
                <td>All podcast-specific styles and tokens</td>
            </tr>
        </tbody>
    </table>
</section>

<!-- Font Migration -->
<section class="ds-section">
    <h2 class="ds-section-title" style="color: #059669;">Font Migration Complete</h2>
    <div class="ds-note" style="background: #ECFDF5; border-color: #10B981;">
        <span class="material-symbols-outlined" style="color: #059669;">check_circle</span>
        <span><strong>Shipped v1.7:</strong> Podcasts now uses the platform fonts Fraunces (display) + Inter (body), replacing the former Bitter + DM Sans stack. Font variables live in <code>css/podcasts/styles.css</code>.</span>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
