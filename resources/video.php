<?php
$ds_page  = 'resources/video';
$ds_title = 'Video Style Guide';

require_once __DIR__ . '/../includes/ds-header.php';
?>

<style>
.video-preview {
    aspect-ratio: 16/9;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    position: relative;
}

.video-preview-vertical {
    aspect-ratio: 9/16;
    max-width: 160px;
}

.video-preview-square {
    aspect-ratio: 1/1;
    max-width: 200px;
}

.video-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
}

.video-label {
    font-size: 13px;
    font-weight: 600;
    color: #1A2744;
    margin-top: 12px;
    margin-bottom: 4px;
}

.video-desc {
    font-size: 12px;
    color: #78716C;
}

.play-button {
    width: 48px;
    height: 48px;
    background: rgba(255,255,255,0.95);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.play-button .material-symbols-outlined {
    font-size: 24px;
    color: #E54D4D;
    margin-left: 3px;
}

.timeline-bar {
    height: 4px;
    background: rgba(255,255,255,0.3);
    border-radius: 2px;
    position: absolute;
    bottom: 12px;
    left: 12px;
    right: 12px;
}

.timeline-progress {
    height: 100%;
    background: #E54D4D;
    border-radius: 2px;
    width: 35%;
}

.color-chip {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 10px;
    background: #fff;
    border: 1px solid #E7E5E4;
    border-radius: 6px;
    font-size: 12px;
}

.color-chip-swatch {
    width: 20px;
    height: 20px;
    border-radius: 4px;
}

.waveform {
    display: flex;
    align-items: center;
    gap: 2px;
    height: 32px;
}

.waveform-bar {
    width: 3px;
    background: #E54D4D;
    border-radius: 2px;
}
</style>

<div class="ds-page-header">
    <h1>Video Style Guide</h1>
    <p>Guidelines for creating on-brand Workshopr video content across social media, tutorials, webinars, and promotional materials.</p>
</div>

<!-- Video Formats -->
<section class="ds-section">
    <h2 class="ds-section-title">Video Formats & Dimensions</h2>
    <p class="ds-section-desc">Standard formats for different platforms and use cases.</p>

    <div class="ds-grid-3">
        <div class="ds-card" style="text-align: center;">
            <div class="video-preview" style="background: linear-gradient(135deg, #1A2744 0%, #2E3D5C 100%); display: flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                <div class="play-button">
                    <span class="material-symbols-outlined">play_arrow</span>
                </div>
                <div class="timeline-bar"><div class="timeline-progress"></div></div>
            </div>
            <div style="font-weight: 600; color: #1A2744; margin-bottom: 4px;">Landscape (16:9)</div>
            <div style="font-size: 13px; color: #78716C; margin-bottom: 8px;">1920 × 1080px (1080p)</div>
            <div style="font-size: 12px; color: #A8A29E;">YouTube, Webinars, Tutorials</div>
        </div>
        <div class="ds-card" style="text-align: center; display: flex; flex-direction: column; align-items: center;">
            <div class="video-preview video-preview-vertical" style="background: linear-gradient(135deg, #E54D4D 0%, #C73E3E 100%); display: flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                <div class="play-button" style="width: 36px; height: 36px;">
                    <span class="material-symbols-outlined" style="font-size: 18px;">play_arrow</span>
                </div>
            </div>
            <div style="font-weight: 600; color: #1A2744; margin-bottom: 4px;">Vertical (9:16)</div>
            <div style="font-size: 13px; color: #78716C; margin-bottom: 8px;">1080 × 1920px</div>
            <div style="font-size: 12px; color: #A8A29E;">TikTok, Reels, Shorts, Stories</div>
        </div>
        <div class="ds-card" style="text-align: center; display: flex; flex-direction: column; align-items: center;">
            <div class="video-preview video-preview-square" style="background: linear-gradient(135deg, #7C4DFF 0%, #6D28D9 100%); display: flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                <div class="play-button" style="width: 40px; height: 40px;">
                    <span class="material-symbols-outlined" style="font-size: 20px;">play_arrow</span>
                </div>
            </div>
            <div style="font-weight: 600; color: #1A2744; margin-bottom: 4px;">Square (1:1)</div>
            <div style="font-size: 13px; color: #78716C; margin-bottom: 8px;">1080 × 1080px</div>
            <div style="font-size: 12px; color: #A8A29E;">LinkedIn, Instagram Feed</div>
        </div>
    </div>

    <div class="ds-card" style="margin-top: 20px;">
        <div style="font-weight: 600; margin-bottom: 16px; color: #1A2744;">Technical Specifications</div>
        <table class="ds-table" style="margin: 0;">
            <thead>
                <tr>
                    <th>Specification</th>
                    <th>Standard</th>
                    <th>High Quality</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Frame Rate</strong></td>
                    <td>30fps</td>
                    <td>60fps (motion graphics)</td>
                </tr>
                <tr>
                    <td><strong>Codec</strong></td>
                    <td>H.264</td>
                    <td>H.265/HEVC, ProRes</td>
                </tr>
                <tr>
                    <td><strong>Bitrate (1080p)</strong></td>
                    <td>8-12 Mbps</td>
                    <td>20-50 Mbps</td>
                </tr>
                <tr>
                    <td><strong>Audio</strong></td>
                    <td>AAC, 128kbps stereo</td>
                    <td>AAC, 320kbps stereo</td>
                </tr>
                <tr>
                    <td><strong>Sample Rate</strong></td>
                    <td>44.1kHz</td>
                    <td>48kHz</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<!-- Color Palette -->
<section class="ds-section">
    <h2 class="ds-section-title">Video Color Palette</h2>
    <p class="ds-section-desc">Consistent colors for backgrounds, text, and graphics.</p>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Background Colors</div>
        <div style="display: flex; flex-wrap: wrap; gap: 12px;">
            <div class="color-chip">
                <div class="color-chip-swatch" style="background: linear-gradient(135deg, #1A2744 0%, #2E3D5C 100%);"></div>
                <div>
                    <div style="font-weight: 500;">Navy Gradient</div>
                    <div style="color: #78716C;">Primary background</div>
                </div>
            </div>
            <div class="color-chip">
                <div class="color-chip-swatch" style="background: #FFFFFF; border: 1px solid #E7E5E4;"></div>
                <div>
                    <div style="font-weight: 500;">White</div>
                    <div style="color: #78716C;">Clean, minimal</div>
                </div>
            </div>
            <div class="color-chip">
                <div class="color-chip-swatch" style="background: #FEF7F1;"></div>
                <div>
                    <div style="font-weight: 500;">Warm Cream</div>
                    <div style="color: #78716C;">Soft, approachable</div>
                </div>
            </div>
            <div class="color-chip">
                <div class="color-chip-swatch" style="background: linear-gradient(135deg, #E54D4D 0%, #C73E3E 100%);"></div>
                <div>
                    <div style="font-weight: 500;">Red Gradient</div>
                    <div style="color: #78716C;">Accent sections</div>
                </div>
            </div>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Text & Graphics</div>
        <div style="display: flex; flex-wrap: wrap; gap: 12px;">
            <div class="color-chip">
                <div class="color-chip-swatch" style="background: #FFFFFF; border: 1px solid #E7E5E4;"></div>
                <div>
                    <div style="font-weight: 500;">White Text</div>
                    <div style="color: #78716C;">On dark backgrounds</div>
                </div>
            </div>
            <div class="color-chip">
                <div class="color-chip-swatch" style="background: #2C2416;"></div>
                <div>
                    <div style="font-weight: 500;">Ink Text</div>
                    <div style="color: #78716C;">On light backgrounds</div>
                </div>
            </div>
            <div class="color-chip">
                <div class="color-chip-swatch" style="background: #E54D4D;"></div>
                <div>
                    <div style="font-weight: 500;">Workshopr Red</div>
                    <div style="color: #78716C;">Highlights, CTAs</div>
                </div>
            </div>
            <div class="color-chip">
                <div class="color-chip-swatch" style="background: #78716C;"></div>
                <div>
                    <div style="font-weight: 500;">Muted Gray</div>
                    <div style="color: #78716C;">Subtitles, captions</div>
                </div>
            </div>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Accent Colors (for graphics, highlights)</div>
        <div style="display: flex; flex-wrap: wrap; gap: 12px;">
            <div class="color-chip">
                <div class="color-chip-swatch" style="background: #0284C7;"></div>
                <div>
                    <div style="font-weight: 500;">Sky Blue</div>
                    <div style="color: #78716C;">#0284C7</div>
                </div>
            </div>
            <div class="color-chip">
                <div class="color-chip-swatch" style="background: #7C4DFF;"></div>
                <div>
                    <div style="font-weight: 500;">Purple</div>
                    <div style="color: #78716C;">#7C4DFF</div>
                </div>
            </div>
            <div class="color-chip">
                <div class="color-chip-swatch" style="background: #10B981;"></div>
                <div>
                    <div style="font-weight: 500;">Emerald</div>
                    <div style="color: #78716C;">#10B981</div>
                </div>
            </div>
            <div class="color-chip">
                <div class="color-chip-swatch" style="background: #F59E0B;"></div>
                <div>
                    <div style="font-weight: 500;">Amber</div>
                    <div style="color: #78716C;">#F59E0B</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Typography -->
<section class="ds-section">
    <h2 class="ds-section-title">Video Typography</h2>
    <p class="ds-section-desc">Font usage for titles, lower thirds, and captions.</p>

    <div class="ds-card">
        <table class="ds-table" style="margin: 0;">
            <thead>
                <tr>
                    <th>Element</th>
                    <th>Font</th>
                    <th>Size (1080p)</th>
                    <th>Weight</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Main Title</strong></td>
                    <td>Fraunces</td>
                    <td>72-120px</td>
                    <td>Bold (700)</td>
                    <td>Opening/closing screens</td>
                </tr>
                <tr>
                    <td><strong>Section Title</strong></td>
                    <td>Fraunces</td>
                    <td>48-64px</td>
                    <td>Bold (700)</td>
                    <td>Chapter/topic intros</td>
                </tr>
                <tr>
                    <td><strong>Lower Third - Name</strong></td>
                    <td>Inter</td>
                    <td>36-42px</td>
                    <td>Semibold (600)</td>
                    <td>Speaker identification</td>
                </tr>
                <tr>
                    <td><strong>Lower Third - Title</strong></td>
                    <td>Inter</td>
                    <td>24-28px</td>
                    <td>Regular (400)</td>
                    <td>Role/company</td>
                </tr>
                <tr>
                    <td><strong>On-Screen Text</strong></td>
                    <td>Inter</td>
                    <td>32-48px</td>
                    <td>Medium (500)</td>
                    <td>Key points, callouts</td>
                </tr>
                <tr>
                    <td><strong>Captions/Subtitles</strong></td>
                    <td>Inter</td>
                    <td>42-48px</td>
                    <td>Medium (500)</td>
                    <td>White with dark outline/bg</td>
                </tr>
                <tr>
                    <td><strong>Animated Text</strong></td>
                    <td>Inter</td>
                    <td>28-36px</td>
                    <td>Semibold (600)</td>
                    <td>Pop-up keywords</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="ds-note" style="margin-top: 16px;">
        <span class="material-symbols-outlined">tips_and_updates</span>
        <div><strong>Safe zones:</strong> Keep text within 90% of frame (54px margins on 1080p) to avoid cropping on different devices and platforms.</div>
    </div>
</section>

<!-- Lower Thirds & Graphics -->
<section class="ds-section">
    <h2 class="ds-section-title">Lower Thirds & Graphics</h2>
    <p class="ds-section-desc">Standard overlays for speaker identification and callouts.</p>

    <div class="video-grid">
        <!-- Lower Third - Standard -->
        <div>
            <div class="video-preview" style="background: linear-gradient(135deg, #1A2744 0%, #2E3D5C 100%); display: flex; align-items: flex-end; padding: 20px;">
                <div style="background: rgba(255,255,255,0.95); padding: 12px 20px; border-radius: 8px; border-left: 4px solid #E54D4D;">
                    <div style="font-family: 'Inter', sans-serif; font-size: 12px; font-weight: 600; color: #2C2416;">Sarah Mitchell</div>
                    <div style="font-family: 'Inter', sans-serif; font-size: 9px; color: #78716C;">Senior Facilitator, Workshopr</div>
                </div>
            </div>
            <div class="video-label">Lower Third - Standard</div>
            <div class="video-desc">White card with red accent bar, bottom-left</div>
        </div>

        <!-- Lower Third - Minimal -->
        <div>
            <div class="video-preview" style="background: #FEF7F1; display: flex; align-items: flex-end; padding: 20px;">
                <div style="padding: 8px 0;">
                    <div style="font-family: 'Inter', sans-serif; font-size: 12px; font-weight: 600; color: #2C2416;">Sarah Mitchell</div>
                    <div style="font-family: 'Inter', sans-serif; font-size: 9px; color: #E54D4D;">Senior Facilitator</div>
                </div>
            </div>
            <div class="video-label">Lower Third - Minimal</div>
            <div class="video-desc">Text only with red subtitle, for light backgrounds</div>
        </div>

        <!-- Topic Card -->
        <div>
            <div class="video-preview" style="background: linear-gradient(135deg, #1A2744 0%, #2E3D5C 100%); display: flex; align-items: center; justify-content: center; text-align: center; padding: 20px;">
                <div>
                    <div style="font-family: 'Inter', sans-serif; font-size: 8px; font-weight: 500; color: #E54D4D; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 6px;">Chapter 2</div>
                    <div style="font-family: 'Fraunces', serif; font-size: 16px; font-weight: 700; color: #fff;">Setting Clear Objectives</div>
                </div>
            </div>
            <div class="video-label">Chapter/Topic Card</div>
            <div class="video-desc">Red label above Fraunces title, centered</div>
        </div>

        <!-- Callout Box -->
        <div>
            <div class="video-preview" style="background: #FFFFFF; display: flex; align-items: center; justify-content: center; padding: 20px;">
                <div style="background: #FEF2F2; border: 2px solid #E54D4D; border-radius: 10px; padding: 12px 20px; display: flex; align-items: center; gap: 10px;">
                    <span class="material-symbols-outlined" style="font-size: 20px; color: #E54D4D;">lightbulb</span>
                    <div style="font-family: 'Inter', sans-serif; font-size: 10px; font-weight: 500; color: #2C2416;">Pro Tip: Always check your tech before going live</div>
                </div>
            </div>
            <div class="video-label">Callout Box</div>
            <div class="video-desc">Highlighted tips with icon, red border</div>
        </div>

        <!-- Quote Overlay -->
        <div>
            <div class="video-preview" style="background: linear-gradient(135deg, #E54D4D 0%, #C73E3E 100%); display: flex; align-items: center; justify-content: center; text-align: center; padding: 24px;">
                <div>
                    <div style="font-family: 'Fraunces', serif; font-size: 11px; font-style: italic; color: #fff; margin-bottom: 8px; line-height: 1.4;">"The best facilitators know when to step back and let the group work."</div>
                    <div style="font-family: 'Inter', sans-serif; font-size: 8px; color: rgba(255,255,255,0.8);">— Bill, Workshopr</div>
                </div>
            </div>
            <div class="video-label">Quote Overlay</div>
            <div class="video-desc">Full-screen red with italic Fraunces quote</div>
        </div>

        <!-- Stat/Number -->
        <div>
            <div class="video-preview" style="background: #FFFFFF; display: flex; align-items: center; justify-content: center; text-align: center; padding: 20px;">
                <div>
                    <div style="font-family: 'Fraunces', serif; font-size: 36px; font-weight: 700; color: #E54D4D;">73%</div>
                    <div style="font-family: 'Inter', sans-serif; font-size: 9px; color: #5C5242; margin-top: 4px;">of teams report better outcomes<br>with structured facilitation</div>
                </div>
            </div>
            <div class="video-label">Statistic Overlay</div>
            <div class="video-desc">Large red number with supporting text</div>
        </div>
    </div>
</section>

<!-- Intro & Outro -->
<section class="ds-section">
    <h2 class="ds-section-title">Intro & Outro Sequences</h2>
    <p class="ds-section-desc">Standard opening and closing animations for brand consistency.</p>

    <div class="ds-grid-2">
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 16px; color: #1A2744; display: flex; align-items: center; gap: 8px;">
                <span class="material-symbols-outlined" style="color: #10B981;">play_circle</span>
                Intro Sequence (3-5 seconds)
            </div>
            <div style="background: linear-gradient(135deg, #1A2744 0%, #2E3D5C 100%); border-radius: 8px; padding: 20px; margin-bottom: 16px;">
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <div style="width: 6px; height: 6px; background: #E54D4D; border-radius: 50%;"></div>
                        <span style="font-size: 11px; color: rgba(255,255,255,0.7);">0.0s - Logo appears (fade/scale)</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <div style="width: 6px; height: 6px; background: #E54D4D; border-radius: 50%;"></div>
                        <span style="font-size: 11px; color: rgba(255,255,255,0.7);">1.0s - Logo settles + brand sound</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <div style="width: 6px; height: 6px; background: #E54D4D; border-radius: 50%;"></div>
                        <span style="font-size: 11px; color: rgba(255,255,255,0.7);">2.0s - Title text animates in</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <div style="width: 6px; height: 6px; background: #E54D4D; border-radius: 50%;"></div>
                        <span style="font-size: 11px; color: rgba(255,255,255,0.7);">3.5s - Transition to content</span>
                    </div>
                </div>
            </div>
            <p style="font-size: 13px; color: #78716C; margin: 0;">Keep intros short. For social content (Reels, TikTok), skip intro entirely or use 1-second logo flash.</p>
        </div>

        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 16px; color: #1A2744; display: flex; align-items: center; gap: 8px;">
                <span class="material-symbols-outlined" style="color: #E54D4D;">stop_circle</span>
                Outro Sequence (5-8 seconds)
            </div>
            <div style="background: linear-gradient(135deg, #1A2744 0%, #2E3D5C 100%); border-radius: 8px; padding: 20px; margin-bottom: 16px;">
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <div style="width: 6px; height: 6px; background: #E54D4D; border-radius: 50%;"></div>
                        <span style="font-size: 11px; color: rgba(255,255,255,0.7);">0.0s - Content fades to navy</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <div style="width: 6px; height: 6px; background: #E54D4D; border-radius: 50%;"></div>
                        <span style="font-size: 11px; color: rgba(255,255,255,0.7);">1.0s - Logo + CTA appears</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <div style="width: 6px; height: 6px; background: #E54D4D; border-radius: 50%;"></div>
                        <span style="font-size: 11px; color: rgba(255,255,255,0.7);">3.0s - Social handles animate in</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <div style="width: 6px; height: 6px; background: #E54D4D; border-radius: 50%;"></div>
                        <span style="font-size: 11px; color: rgba(255,255,255,0.7);">5.0s - Subscribe/follow prompt</span>
                    </div>
                </div>
            </div>
            <p style="font-size: 13px; color: #78716C; margin: 0;">Include clear CTA (Subscribe, Visit site, Follow). For YouTube, add end screen elements in final 20 seconds.</p>
        </div>
    </div>
</section>

<!-- Motion & Animation -->
<section class="ds-section">
    <h2 class="ds-section-title">Motion & Animation</h2>
    <p class="ds-section-desc">Consistent motion language across all video content.</p>

    <div class="ds-grid-2">
        <div class="ds-card" style="border-left: 4px solid #166534;">
            <div style="font-weight: 600; margin-bottom: 12px; color: #166534;">Recommended</div>
            <ul style="margin: 0; padding-left: 20px; font-size: 14px; color: #57534E;">
                <li style="margin-bottom: 8px;"><strong>Ease curves:</strong> Use ease-out for entrances, ease-in-out for transitions</li>
                <li style="margin-bottom: 8px;"><strong>Duration:</strong> 200-400ms for UI elements, 500-800ms for larger animations</li>
                <li style="margin-bottom: 8px;"><strong>Fade transitions:</strong> Simple fades between scenes (300-500ms)</li>
                <li style="margin-bottom: 8px;"><strong>Slide-in text:</strong> Horizontal or vertical slides with opacity</li>
                <li style="margin-bottom: 8px;"><strong>Scale:</strong> Subtle scale (95% → 100%) for pop-in effects</li>
                <li><strong>Consistency:</strong> Same animation style throughout a video</li>
            </ul>
        </div>
        <div class="ds-card" style="border-left: 4px solid #991B1B;">
            <div style="font-weight: 600; margin-bottom: 12px; color: #991B1B;">Avoid</div>
            <ul style="margin: 0; padding-left: 20px; font-size: 14px; color: #57534E;">
                <li style="margin-bottom: 8px;">Bouncy spring animations (too playful)</li>
                <li style="margin-bottom: 8px;">3D rotations or flips</li>
                <li style="margin-bottom: 8px;">Excessive particle effects</li>
                <li style="margin-bottom: 8px;">Fast strobing or flashing</li>
                <li style="margin-bottom: 8px;">Motion that distracts from content</li>
                <li>Mismatched animation styles within a video</li>
            </ul>
        </div>
    </div>

    <div class="ds-subsection" style="margin-top: 24px;">
        <div class="ds-subsection-title">Animation Timing Reference</div>
        <div class="ds-card">
            <table class="ds-table" style="margin: 0;">
                <thead>
                    <tr>
                        <th>Element</th>
                        <th>Animation</th>
                        <th>Duration</th>
                        <th>Easing</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Lower third appear</td>
                        <td>Slide up + fade</td>
                        <td>300ms</td>
                        <td>ease-out</td>
                    </tr>
                    <tr>
                        <td>Text pop-in</td>
                        <td>Scale (95%→100%) + fade</td>
                        <td>250ms</td>
                        <td>ease-out</td>
                    </tr>
                    <tr>
                        <td>Scene transition</td>
                        <td>Cross-fade</td>
                        <td>400-600ms</td>
                        <td>ease-in-out</td>
                    </tr>
                    <tr>
                        <td>Icon/graphic appear</td>
                        <td>Fade + slight scale</td>
                        <td>300ms</td>
                        <td>ease-out</td>
                    </tr>
                    <tr>
                        <td>Logo animation</td>
                        <td>Custom (brand motion)</td>
                        <td>800-1000ms</td>
                        <td>custom bezier</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Audio -->
<section class="ds-section">
    <h2 class="ds-section-title">Audio Guidelines</h2>
    <p class="ds-section-desc">Standards for voice, music, and sound design.</p>

    <div class="ds-grid-2">
        <div class="ds-card">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                <div style="width: 40px; height: 40px; background: #FEF2F2; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined" style="color: #E54D4D;">mic</span>
                </div>
                <div style="font-weight: 600; color: #1A2744;">Voice & Narration</div>
            </div>
            <ul style="margin: 0; padding-left: 20px; font-size: 14px; color: #57534E;">
                <li style="margin-bottom: 6px;"><strong>Level:</strong> -12dB to -6dB (peaks at -3dB max)</li>
                <li style="margin-bottom: 6px;"><strong>Tone:</strong> Warm, conversational, confident</li>
                <li style="margin-bottom: 6px;"><strong>Pacing:</strong> Natural, not rushed (150-160 WPM)</li>
                <li style="margin-bottom: 6px;"><strong>Room tone:</strong> Minimal reverb, treated space</li>
                <li><strong>Processing:</strong> Light compression, de-essing, EQ</li>
            </ul>
        </div>

        <div class="ds-card">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                <div style="width: 40px; height: 40px; background: #EDE9FE; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined" style="color: #7C4DFF;">music_note</span>
                </div>
                <div style="font-weight: 600; color: #1A2744;">Background Music</div>
            </div>
            <ul style="margin: 0; padding-left: 20px; font-size: 14px; color: #57534E;">
                <li style="margin-bottom: 6px;"><strong>Level:</strong> -24dB to -18dB under voice</li>
                <li style="margin-bottom: 6px;"><strong>Style:</strong> Upbeat but not distracting, modern</li>
                <li style="margin-bottom: 6px;"><strong>Avoid:</strong> Lyrics, heavy bass, jarring changes</li>
                <li style="margin-bottom: 6px;"><strong>Fade:</strong> 1-2 second fades at cuts</li>
                <li><strong>Licensing:</strong> Always use licensed/royalty-free tracks</li>
            </ul>
        </div>
    </div>

    <div class="ds-card" style="margin-top: 20px;">
        <div style="font-weight: 600; margin-bottom: 16px; color: #1A2744;">Audio Levels Reference</div>
        <div style="background: #1A2744; border-radius: 8px; padding: 20px;">
            <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 12px;">
                <span style="font-size: 12px; color: rgba(255,255,255,0.7); width: 100px;">Voice</span>
                <div style="flex: 1; height: 8px; background: rgba(255,255,255,0.1); border-radius: 4px; position: relative;">
                    <div style="position: absolute; left: 50%; right: 25%; height: 100%; background: linear-gradient(90deg, #10B981, #F59E0B); border-radius: 4px;"></div>
                    <div style="position: absolute; right: 12.5%; width: 2px; height: 100%; background: #EF4444;"></div>
                </div>
                <span style="font-size: 11px; color: rgba(255,255,255,0.5);">-12 to -6dB</span>
            </div>
            <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 12px;">
                <span style="font-size: 12px; color: rgba(255,255,255,0.7); width: 100px;">Music</span>
                <div style="flex: 1; height: 8px; background: rgba(255,255,255,0.1); border-radius: 4px; position: relative;">
                    <div style="position: absolute; left: 25%; right: 50%; height: 100%; background: linear-gradient(90deg, #10B981, #7C4DFF); border-radius: 4px;"></div>
                </div>
                <span style="font-size: 11px; color: rgba(255,255,255,0.5);">-24 to -18dB</span>
            </div>
            <div style="display: flex; align-items: center; gap: 16px;">
                <span style="font-size: 12px; color: rgba(255,255,255,0.7); width: 100px;">SFX</span>
                <div style="flex: 1; height: 8px; background: rgba(255,255,255,0.1); border-radius: 4px; position: relative;">
                    <div style="position: absolute; left: 37.5%; right: 37.5%; height: 100%; background: linear-gradient(90deg, #0284C7, #10B981); border-radius: 4px;"></div>
                </div>
                <span style="font-size: 11px; color: rgba(255,255,255,0.5);">-18 to -12dB</span>
            </div>
        </div>
    </div>

    <div class="ds-subsection" style="margin-top: 24px;">
        <div class="ds-subsection-title">Sound Effects</div>
        <div class="ds-card">
            <div class="ds-grid-2" style="gap: 24px;">
                <div>
                    <div style="font-weight: 600; margin-bottom: 8px; color: #166534;">Use</div>
                    <ul style="margin: 0; padding-left: 20px; font-size: 14px; color: #57534E;">
                        <li style="margin-bottom: 6px;">Subtle whooshes for transitions</li>
                        <li style="margin-bottom: 6px;">Soft clicks for UI interactions</li>
                        <li style="margin-bottom: 6px;">Gentle chimes for notifications</li>
                        <li>Pop sounds for text appearing</li>
                    </ul>
                </div>
                <div>
                    <div style="font-weight: 600; margin-bottom: 8px; color: #991B1B;">Avoid</div>
                    <ul style="margin: 0; padding-left: 20px; font-size: 14px; color: #57534E;">
                        <li style="margin-bottom: 6px;">Loud, jarring sound effects</li>
                        <li style="margin-bottom: 6px;">Cartoonish or comedic sounds</li>
                        <li style="margin-bottom: 6px;">Overused stock sounds</li>
                        <li>Sound effects on every element</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Thumbnails -->
<section class="ds-section">
    <h2 class="ds-section-title">Thumbnails</h2>
    <p class="ds-section-desc">Eye-catching thumbnails that maintain brand consistency.</p>

    <div class="video-grid">
        <div>
            <div style="aspect-ratio: 16/9; background: linear-gradient(135deg, #1A2744 0%, #2E3D5C 100%); border-radius: 8px; padding: 16px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                <div style="flex: 1;">
                    <div style="font-family: 'Fraunces', serif; font-size: 14px; font-weight: 700; color: #fff; line-height: 1.2;">5 Workshop<br>Mistakes</div>
                </div>
                <div style="width: 50px; height: 50px; background: #E54D4D; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <span style="font-family: 'Fraunces', serif; font-size: 20px; font-weight: 700; color: #fff;">5</span>
                </div>
            </div>
            <div class="video-label">Listicle Style</div>
            <div class="video-desc">Bold number, short title, navy background</div>
        </div>

        <div>
            <div style="aspect-ratio: 16/9; background: #FEF7F1; border-radius: 8px; padding: 16px; display: flex; align-items: center; gap: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #E7E5E4, #D6D3D1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined" style="color: #78716C;">person</span>
                </div>
                <div>
                    <div style="font-family: 'Fraunces', serif; font-size: 12px; font-weight: 700; color: #2C2416; line-height: 1.2;">Interview Title</div>
                    <div style="font-size: 9px; color: #E54D4D; margin-top: 4px;">Guest Name</div>
                </div>
            </div>
            <div class="video-label">Interview/Podcast</div>
            <div class="video-desc">Face photo, name, cream background</div>
        </div>

        <div>
            <div style="aspect-ratio: 16/9; background: linear-gradient(135deg, #E54D4D 0%, #C73E3E 100%); border-radius: 8px; padding: 16px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                <div style="font-family: 'Fraunces', serif; font-size: 14px; font-weight: 700; color: #fff; line-height: 1.2;">Tutorial Title</div>
                <div style="font-size: 9px; color: rgba(255,255,255,0.8); margin-top: 6px;">Step-by-step guide</div>
            </div>
            <div class="video-label">Tutorial/How-To</div>
            <div class="video-desc">Red background, centered text</div>
        </div>
    </div>

    <div class="ds-card" style="margin-top: 24px;">
        <div style="font-weight: 600; margin-bottom: 12px; color: #1A2744;">Thumbnail Best Practices</div>
        <div class="ds-grid-2" style="gap: 24px;">
            <div>
                <ul style="margin: 0; padding-left: 20px; font-size: 14px; color: #57534E;">
                    <li style="margin-bottom: 6px;"><strong>Dimensions:</strong> 1280 × 720px minimum</li>
                    <li style="margin-bottom: 6px;"><strong>Text:</strong> 3-5 words maximum, legible at small sizes</li>
                    <li style="margin-bottom: 6px;"><strong>Faces:</strong> Include faces when possible (higher CTR)</li>
                    <li><strong>Contrast:</strong> Ensure text is readable over background</li>
                </ul>
            </div>
            <div>
                <ul style="margin: 0; padding-left: 20px; font-size: 14px; color: #57534E;">
                    <li style="margin-bottom: 6px;"><strong>Branding:</strong> Include logo or consistent element</li>
                    <li style="margin-bottom: 6px;"><strong>Avoid:</strong> Clickbait arrows, excessive text, cluttered designs</li>
                    <li style="margin-bottom: 6px;"><strong>Test:</strong> View at 50px height to check readability</li>
                    <li><strong>Consistency:</strong> Maintain series look across related videos</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Captions & Subtitles -->
<section class="ds-section">
    <h2 class="ds-section-title">Captions & Subtitles</h2>
    <p class="ds-section-desc">Accessible, on-brand caption styling.</p>

    <div class="ds-grid-2">
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 12px; color: #1A2744;">Standard Style (Recommended)</div>
            <div style="background: #1A2744; border-radius: 8px; aspect-ratio: 16/9; display: flex; align-items: flex-end; justify-content: center; padding-bottom: 20px; margin-bottom: 12px;">
                <div style="background: rgba(0,0,0,0.75); padding: 8px 16px; border-radius: 6px;">
                    <span style="font-family: 'Inter', sans-serif; font-size: 11px; font-weight: 500; color: #fff;">This is an example caption with good contrast.</span>
                </div>
            </div>
            <ul style="margin: 0; padding-left: 20px; font-size: 13px; color: #78716C;">
                <li>White text on semi-transparent black box</li>
                <li>Inter Medium, 42-48px at 1080p</li>
                <li>Centered at bottom of frame</li>
            </ul>
        </div>

        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 12px; color: #1A2744;">Animated Style (Social)</div>
            <div style="background: #FEF7F1; border-radius: 8px; aspect-ratio: 16/9; display: flex; align-items: center; justify-content: center; padding: 20px; margin-bottom: 12px;">
                <div style="text-align: center;">
                    <span style="font-family: 'Inter', sans-serif; font-size: 12px; font-weight: 700; color: #2C2416;">This is </span>
                    <span style="font-family: 'Inter', sans-serif; font-size: 12px; font-weight: 700; color: #E54D4D;">ANIMATED</span>
                    <span style="font-family: 'Inter', sans-serif; font-size: 12px; font-weight: 700; color: #2C2416;"> text</span>
                </div>
            </div>
            <ul style="margin: 0; padding-left: 20px; font-size: 13px; color: #78716C;">
                <li>Keywords highlighted in red</li>
                <li>Word-by-word or phrase animation</li>
                <li>For TikTok, Reels, Shorts</li>
            </ul>
        </div>
    </div>

    <div class="ds-note" style="margin-top: 16px;">
        <span class="material-symbols-outlined">accessibility_new</span>
        <div><strong>Accessibility:</strong> Always include captions. 85% of social media videos are watched without sound. Use SRT/VTT files for platform-native captions.</div>
    </div>
</section>

<!-- Video Types -->
<section class="ds-section">
    <h2 class="ds-section-title">Video Types</h2>
    <p class="ds-section-desc">Format guidelines for different content categories.</p>

    <div class="ds-grid-2">
        <div class="ds-card">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                <div style="width: 40px; height: 40px; background: #FEE2E2; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined" style="color: #E54D4D;">play_lesson</span>
                </div>
                <div style="font-weight: 600; color: #1A2744;">Tutorial / How-To</div>
            </div>
            <p style="font-size: 14px; color: #57534E; margin-bottom: 12px;">Step-by-step educational content.</p>
            <ul style="margin: 0; padding-left: 20px; font-size: 13px; color: #78716C;">
                <li>5-15 minutes typical length</li>
                <li>Clear chapter markers</li>
                <li>Screen recordings with face overlay</li>
                <li>Numbered steps on screen</li>
                <li>Summary/recap at end</li>
            </ul>
        </div>

        <div class="ds-card">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                <div style="width: 40px; height: 40px; background: #E0F2FE; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined" style="color: #0284C7;">videocam</span>
                </div>
                <div style="font-weight: 600; color: #1A2744;">Webinar / Live</div>
            </div>
            <p style="font-size: 14px; color: #57534E; margin-bottom: 12px;">Live or recorded educational sessions.</p>
            <ul style="margin: 0; padding-left: 20px; font-size: 13px; color: #78716C;">
                <li>30-60 minutes typical</li>
                <li>Speaker + slides layout</li>
                <li>Lower thirds for speakers</li>
                <li>Q&A section at end</li>
                <li>Branded waiting room screen</li>
            </ul>
        </div>

        <div class="ds-card">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                <div style="width: 40px; height: 40px; background: #EDE9FE; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined" style="color: #7C4DFF;">bolt</span>
                </div>
                <div style="font-weight: 600; color: #1A2744;">Short-Form Social</div>
            </div>
            <p style="font-size: 14px; color: #57534E; margin-bottom: 12px;">TikTok, Reels, YouTube Shorts.</p>
            <ul style="margin: 0; padding-left: 20px; font-size: 13px; color: #78716C;">
                <li>15-60 seconds max</li>
                <li>Vertical (9:16) format</li>
                <li>Hook in first 2 seconds</li>
                <li>Animated captions required</li>
                <li>No intro, minimal branding</li>
            </ul>
        </div>

        <div class="ds-card">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                <div style="width: 40px; height: 40px; background: #D1FAE5; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined" style="color: #10B981;">record_voice_over</span>
                </div>
                <div style="font-weight: 600; color: #1A2744;">Interview / Podcast</div>
            </div>
            <p style="font-size: 14px; color: #57534E; margin-bottom: 12px;">Conversations and guest content.</p>
            <ul style="margin: 0; padding-left: 20px; font-size: 13px; color: #78716C;">
                <li>20-45 minutes typical</li>
                <li>Two-camera or remote setup</li>
                <li>Lower thirds for each speaker</li>
                <li>B-roll inserts welcome</li>
                <li>Clip highlights for social</li>
            </ul>
        </div>

        <div class="ds-card">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                <div style="width: 40px; height: 40px; background: #FEF3C7; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined" style="color: #F59E0B;">campaign</span>
                </div>
                <div style="font-weight: 600; color: #1A2744;">Promo / Ad</div>
            </div>
            <p style="font-size: 14px; color: #57534E; margin-bottom: 12px;">Marketing and promotional content.</p>
            <ul style="margin: 0; padding-left: 20px; font-size: 13px; color: #78716C;">
                <li>15-30 seconds for ads</li>
                <li>60-90 seconds for promos</li>
                <li>Strong hook, clear CTA</li>
                <li>High production value</li>
                <li>Multiple aspect ratios needed</li>
            </ul>
        </div>

        <div class="ds-card">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                <div style="width: 40px; height: 40px; background: #FCE7F3; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined" style="color: #EC4899;">format_quote</span>
                </div>
                <div style="font-weight: 600; color: #1A2744;">Testimonial</div>
            </div>
            <p style="font-size: 14px; color: #57534E; margin-bottom: 12px;">Customer stories and reviews.</p>
            <ul style="margin: 0; padding-left: 20px; font-size: 13px; color: #78716C;">
                <li>60-120 seconds typical</li>
                <li>Authentic, unscripted feel</li>
                <li>Name/company lower third</li>
                <li>Pull quotes on screen</li>
                <li>Logo at end only</li>
            </ul>
        </div>
    </div>
</section>

<!-- Screen Recording -->
<section class="ds-section">
    <h2 class="ds-section-title">Screen Recording Guidelines</h2>
    <p class="ds-section-desc">Standards for software demos and tutorials.</p>

    <div class="ds-grid-2">
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 12px; color: #1A2744;">Recording Setup</div>
            <ul style="margin: 0; padding-left: 20px; font-size: 14px; color: #57534E;">
                <li style="margin-bottom: 6px;"><strong>Resolution:</strong> 1920×1080 or 2560×1440 (scale down)</li>
                <li style="margin-bottom: 6px;"><strong>Frame rate:</strong> 30fps minimum, 60fps for smooth scrolling</li>
                <li style="margin-bottom: 6px;"><strong>Cursor:</strong> Highlight or enlarge for visibility</li>
                <li style="margin-bottom: 6px;"><strong>Clicks:</strong> Add visual click indicators</li>
                <li style="margin-bottom: 6px;"><strong>Zoom:</strong> Zoom in on small UI elements (150-200%)</li>
                <li><strong>Clean desktop:</strong> Hide notifications, use neutral wallpaper</li>
            </ul>
        </div>

        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 12px; color: #1A2744;">Face Overlay (Picture-in-Picture)</div>
            <ul style="margin: 0; padding-left: 20px; font-size: 14px; color: #57534E;">
                <li style="margin-bottom: 6px;"><strong>Size:</strong> 200-300px circle or rounded rectangle</li>
                <li style="margin-bottom: 6px;"><strong>Position:</strong> Bottom-right corner (default)</li>
                <li style="margin-bottom: 6px;"><strong>Border:</strong> 3px white or red border</li>
                <li style="margin-bottom: 6px;"><strong>Background:</strong> Blurred or solid (not distracting)</li>
                <li style="margin-bottom: 6px;"><strong>Lighting:</strong> Face well-lit, no harsh shadows</li>
                <li><strong>Hide when:</strong> Full-screen demos or complex UI</li>
            </ul>
        </div>
    </div>
</section>

<!-- Pre-Production Checklist -->
<section class="ds-section">
    <h2 class="ds-section-title">Production Checklists</h2>

    <div class="ds-grid-2">
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 12px; color: #1A2744;">Pre-Production</div>
            <ul style="margin: 0; padding-left: 20px; font-size: 14px; color: #57534E;">
                <li style="margin-bottom: 6px;">Script or outline complete</li>
                <li style="margin-bottom: 6px;">Aspect ratio determined for platform</li>
                <li style="margin-bottom: 6px;">Graphics/lower thirds prepared</li>
                <li style="margin-bottom: 6px;">Music selected and licensed</li>
                <li style="margin-bottom: 6px;">Equipment tested (camera, mic, lighting)</li>
                <li>Quiet recording environment secured</li>
            </ul>
        </div>

        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 12px; color: #1A2744;">Post-Production</div>
            <ul style="margin: 0; padding-left: 20px; font-size: 14px; color: #57534E;">
                <li style="margin-bottom: 6px;">Color graded (consistent across videos)</li>
                <li style="margin-bottom: 6px;">Audio levels normalized</li>
                <li style="margin-bottom: 6px;">Captions/subtitles added</li>
                <li style="margin-bottom: 6px;">Intro and outro included</li>
                <li style="margin-bottom: 6px;">Thumbnail created</li>
                <li>Export in correct format/codec</li>
            </ul>
        </div>
    </div>

    <div class="ds-card" style="margin-top: 20px;">
        <div style="font-weight: 600; margin-bottom: 12px; color: #1A2744;">Quality Check Before Publishing</div>
        <div class="ds-grid-3" style="gap: 16px;">
            <div>
                <div style="font-weight: 500; margin-bottom: 8px; color: #57534E;">Visual</div>
                <ul style="margin: 0; padding-left: 16px; font-size: 13px; color: #78716C;">
                    <li>Brand colors correct</li>
                    <li>Fonts are Fraunces/Inter</li>
                    <li>Logo appears correctly</li>
                    <li>No visual glitches</li>
                </ul>
            </div>
            <div>
                <div style="font-weight: 500; margin-bottom: 8px; color: #57534E;">Audio</div>
                <ul style="margin: 0; padding-left: 16px; font-size: 13px; color: #78716C;">
                    <li>Voice is clear</li>
                    <li>Music not too loud</li>
                    <li>No pops/clicks/hum</li>
                    <li>Levels consistent</li>
                </ul>
            </div>
            <div>
                <div style="font-weight: 500; margin-bottom: 8px; color: #57534E;">Content</div>
                <ul style="margin: 0; padding-left: 16px; font-size: 13px; color: #78716C;">
                    <li>Spelling checked</li>
                    <li>Links/CTAs correct</li>
                    <li>Captions accurate</li>
                    <li>End screen working</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
