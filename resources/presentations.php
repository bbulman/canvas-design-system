<?php
$ds_page  = 'resources/presentations';
$ds_title = 'Presentation Style Guide';

require_once __DIR__ . '/../includes/ds-header.php';
?>

<style>
.slide-preview {
    aspect-ratio: 16/9;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    font-size: 10px;
}

.slide-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
}

.slide-label {
    font-size: 13px;
    font-weight: 600;
    color: #1A2744;
    margin-top: 12px;
    margin-bottom: 4px;
}

.slide-desc {
    font-size: 12px;
    color: #78716C;
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
</style>

<div class="ds-page-header">
    <h1>Presentation Style Guide</h1>
    <p>Guidelines for creating on-brand Workshopr presentations for keynotes, webinars, sales decks, and training materials.</p>
</div>

<!-- Setup -->
<section class="ds-section">
    <h2 class="ds-section-title">Presentation Setup</h2>
    <p class="ds-section-desc">Standard dimensions and file settings for all Workshopr presentations.</p>

    <div class="ds-grid-2">
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 16px; color: #1A2744;">Slide Dimensions</div>
            <table class="ds-table" style="margin: 0;">
                <tbody>
                    <tr>
                        <td><strong>Aspect Ratio</strong></td>
                        <td>16:9 (Widescreen)</td>
                    </tr>
                    <tr>
                        <td><strong>Dimensions</strong></td>
                        <td>1920 × 1080 px</td>
                    </tr>
                    <tr>
                        <td><strong>Safe Margins</strong></td>
                        <td>80px all sides</td>
                    </tr>
                    <tr>
                        <td><strong>Export Format</strong></td>
                        <td>PDF, PPTX, or Google Slides</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 16px; color: #1A2744;">Font Setup</div>
            <table class="ds-table" style="margin: 0;">
                <tbody>
                    <tr>
                        <td><strong>Headings</strong></td>
                        <td>Fraunces (Bold, 700)</td>
                    </tr>
                    <tr>
                        <td><strong>Body Text</strong></td>
                        <td>Inter (Regular, 400)</td>
                    </tr>
                    <tr>
                        <td><strong>Fallback</strong></td>
                        <td>Georgia / Arial</td>
                    </tr>
                    <tr>
                        <td><strong>Download</strong></td>
                        <td><a href="https://fonts.google.com/specimen/Fraunces" target="_blank" style="color: #E54D4D;">Google Fonts</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Color Palette -->
<section class="ds-section">
    <h2 class="ds-section-title">Presentation Color Palette</h2>
    <p class="ds-section-desc">A focused palette for clear, readable slides.</p>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Primary Colors</div>
        <div style="display: flex; flex-wrap: wrap; gap: 12px;">
            <div class="color-chip">
                <div class="color-chip-swatch" style="background: #E54D4D;"></div>
                <div>
                    <div style="font-weight: 500;">Workshopr Red</div>
                    <div style="color: #78716C;">#E54D4D</div>
                </div>
            </div>
            <div class="color-chip">
                <div class="color-chip-swatch" style="background: #1A2744;"></div>
                <div>
                    <div style="font-weight: 500;">Navy</div>
                    <div style="color: #78716C;">#1A2744</div>
                </div>
            </div>
            <div class="color-chip">
                <div class="color-chip-swatch" style="background: #2C2416;"></div>
                <div>
                    <div style="font-weight: 500;">Ink</div>
                    <div style="color: #78716C;">#2C2416</div>
                </div>
            </div>
            <div class="color-chip">
                <div class="color-chip-swatch" style="background: #FFFFFF; border: 1px solid #E7E5E4;"></div>
                <div>
                    <div style="font-weight: 500;">White</div>
                    <div style="color: #78716C;">#FFFFFF</div>
                </div>
            </div>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Background Colors</div>
        <div style="display: flex; flex-wrap: wrap; gap: 12px;">
            <div class="color-chip">
                <div class="color-chip-swatch" style="background: #FFFFFF; border: 1px solid #E7E5E4;"></div>
                <div>
                    <div style="font-weight: 500;">White (Default)</div>
                    <div style="color: #78716C;">#FFFFFF</div>
                </div>
            </div>
            <div class="color-chip">
                <div class="color-chip-swatch" style="background: #FEF7F1;"></div>
                <div>
                    <div style="font-weight: 500;">Warm Cream</div>
                    <div style="color: #78716C;">#FEF7F1</div>
                </div>
            </div>
            <div class="color-chip">
                <div class="color-chip-swatch" style="background: #1A2744;"></div>
                <div>
                    <div style="font-weight: 500;">Navy (Dark slides)</div>
                    <div style="color: #78716C;">#1A2744</div>
                </div>
            </div>
            <div class="color-chip">
                <div class="color-chip-swatch" style="background: #E54D4D;"></div>
                <div>
                    <div style="font-weight: 500;">Red (Accent slides)</div>
                    <div style="color: #78716C;">#E54D4D</div>
                </div>
            </div>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Accent Colors (for charts, highlights)</div>
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
    <h2 class="ds-section-title">Typography Scale</h2>
    <p class="ds-section-desc">Consistent sizing for readability at any venue.</p>

    <div class="ds-card">
        <table class="ds-table" style="margin: 0;">
            <thead>
                <tr>
                    <th>Element</th>
                    <th>Font</th>
                    <th>Size</th>
                    <th>Weight</th>
                    <th>Color</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Slide Title</strong></td>
                    <td>Fraunces</td>
                    <td>48-60px</td>
                    <td>Bold (700)</td>
                    <td>Ink #2C2416 or White</td>
                </tr>
                <tr>
                    <td><strong>Section Divider</strong></td>
                    <td>Fraunces</td>
                    <td>72-96px</td>
                    <td>Bold (700)</td>
                    <td>White on Navy/Red</td>
                </tr>
                <tr>
                    <td><strong>Subtitle</strong></td>
                    <td>Inter</td>
                    <td>24-32px</td>
                    <td>Regular (400)</td>
                    <td>Ink Muted #78716C</td>
                </tr>
                <tr>
                    <td><strong>Body Text</strong></td>
                    <td>Inter</td>
                    <td>24-28px</td>
                    <td>Regular (400)</td>
                    <td>Ink Secondary #5C5242</td>
                </tr>
                <tr>
                    <td><strong>Bullet Points</strong></td>
                    <td>Inter</td>
                    <td>24-28px</td>
                    <td>Regular (400)</td>
                    <td>Ink Secondary #5C5242</td>
                </tr>
                <tr>
                    <td><strong>Quote</strong></td>
                    <td>Fraunces Italic</td>
                    <td>32-40px</td>
                    <td>Medium (500)</td>
                    <td>Ink #2C2416</td>
                </tr>
                <tr>
                    <td><strong>Caption/Source</strong></td>
                    <td>Inter</td>
                    <td>16-18px</td>
                    <td>Regular (400)</td>
                    <td>Ink Faint #A8A29E</td>
                </tr>
                <tr>
                    <td><strong>Slide Number</strong></td>
                    <td>Inter</td>
                    <td>14px</td>
                    <td>Medium (500)</td>
                    <td>Ink Faint #A8A29E</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="ds-note" style="margin-top: 16px;">
        <span class="material-symbols-outlined">tips_and_updates</span>
        <div><strong>Readability tip:</strong> If presenting in large venues, increase body text to 28-32px. Text should be readable from the back of the room.</div>
    </div>
</section>

<!-- Slide Layouts -->
<section class="ds-section">
    <h2 class="ds-section-title">Slide Layouts</h2>
    <p class="ds-section-desc">Core templates for consistent, professional presentations.</p>

    <div class="slide-grid">
        <!-- Title Slide -->
        <div>
            <div class="slide-preview" style="background: linear-gradient(135deg, #1A2744 0%, #2E3D5C 100%); padding: 20px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                <div style="font-family: 'Fraunces', serif; font-size: 18px; font-weight: 700; color: #fff; margin-bottom: 8px;">Presentation Title</div>
                <div style="font-size: 10px; color: rgba(255,255,255,0.7);">Subtitle or Date</div>
                <div style="position: absolute; bottom: 16px; left: 20px;">
                    <svg width="24" height="24" viewBox="0 -960 960 960" fill="#E54D4D"><path d="M480-80q-50 0-85-35t-35-85q0-5 .5-11t1.5-11l-83-47q-16 14-36 21.5t-43 7.5q-50 0-85-35t-35-85q0-50 35-85t85-35q24 0 45 9t38 25l119-60q-3-23 2.5-45t19.5-41l-34-52q-7 2-14.5 3t-15.5 1q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 20-6.5 38.5T456-688l35 52q8-2 15-3t15-1q17 0 32 4t29 12l66-54q-4-10-6-20.5t-2-21.5q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35q-17 0-32-4.5T699-617l-66 55q4 10 6 20.5t2 21.5q0 50-35 85t-85 35q-24 0-45.5-9T437-434l-118 59q2 9 1.5 18t-2.5 18l84 48q16-14 35.5-21.5T480-320q50 0 85 35t35 85q0 50-35 85t-85 35Z"/></svg>
                </div>
            </div>
            <div class="slide-label">Title Slide</div>
            <div class="slide-desc">Navy gradient background, centered title, logo bottom-left</div>
        </div>

        <!-- Section Divider -->
        <div>
            <div class="slide-preview" style="background: #E54D4D; padding: 20px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                <div style="font-family: 'Fraunces', serif; font-size: 22px; font-weight: 700; color: #fff;">Section Title</div>
            </div>
            <div class="slide-label">Section Divider</div>
            <div class="slide-desc">Bold red background, large centered text</div>
        </div>

        <!-- Content - Text -->
        <div>
            <div class="slide-preview" style="background: #FFFFFF; padding: 20px; display: flex; flex-direction: column;">
                <div style="font-family: 'Fraunces', serif; font-size: 14px; font-weight: 700; color: #2C2416; margin-bottom: 12px;">Slide Title Here</div>
                <div style="display: flex; flex-direction: column; gap: 6px;">
                    <div style="display: flex; align-items: flex-start; gap: 6px; font-size: 9px; color: #5C5242;">
                        <span style="color: #E54D4D;">•</span> First bullet point with key insight
                    </div>
                    <div style="display: flex; align-items: flex-start; gap: 6px; font-size: 9px; color: #5C5242;">
                        <span style="color: #E54D4D;">•</span> Second bullet point with detail
                    </div>
                    <div style="display: flex; align-items: flex-start; gap: 6px; font-size: 9px; color: #5C5242;">
                        <span style="color: #E54D4D;">•</span> Third bullet point with action
                    </div>
                </div>
            </div>
            <div class="slide-label">Content - Bullets</div>
            <div class="slide-desc">White background, left-aligned title, red bullet points</div>
        </div>

        <!-- Content - Two Column -->
        <div>
            <div class="slide-preview" style="background: #FFFFFF; padding: 20px; display: flex; flex-direction: column;">
                <div style="font-family: 'Fraunces', serif; font-size: 14px; font-weight: 700; color: #2C2416; margin-bottom: 12px;">Two Column Layout</div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; flex: 1;">
                    <div style="background: #FEF7F1; border-radius: 4px; padding: 8px;">
                        <div style="font-size: 8px; font-weight: 600; color: #2C2416; margin-bottom: 4px;">Left Column</div>
                        <div style="font-size: 7px; color: #78716C;">Supporting content here</div>
                    </div>
                    <div style="background: #FEF7F1; border-radius: 4px; padding: 8px;">
                        <div style="font-size: 8px; font-weight: 600; color: #2C2416; margin-bottom: 4px;">Right Column</div>
                        <div style="font-size: 7px; color: #78716C;">Supporting content here</div>
                    </div>
                </div>
            </div>
            <div class="slide-label">Two Column</div>
            <div class="slide-desc">Side-by-side content with cream cards</div>
        </div>

        <!-- Quote -->
        <div>
            <div class="slide-preview" style="background: #FEF7F1; padding: 20px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                <div style="font-family: 'Fraunces', serif; font-size: 12px; font-style: italic; color: #2C2416; margin-bottom: 8px; max-width: 80%;">"The best workshop I ever ran, I said almost nothing."</div>
                <div style="font-size: 8px; color: #78716C;">— Bill, Workshopr</div>
            </div>
            <div class="slide-label">Quote Slide</div>
            <div class="slide-desc">Cream background, centered italic Fraunces</div>
        </div>

        <!-- Stats/Big Number -->
        <div>
            <div class="slide-preview" style="background: #FFFFFF; padding: 20px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                <div style="font-family: 'Fraunces', serif; font-size: 36px; font-weight: 700; color: #E54D4D;">47%</div>
                <div style="font-size: 10px; color: #5C5242; margin-top: 4px;">of workshop time is wasted on unclear objectives</div>
            </div>
            <div class="slide-label">Big Number/Stat</div>
            <div class="slide-desc">Large red number with supporting context</div>
        </div>

        <!-- Image + Text -->
        <div>
            <div class="slide-preview" style="background: #FFFFFF; padding: 0; display: grid; grid-template-columns: 1fr 1fr;">
                <div style="background: linear-gradient(135deg, #E7E5E4, #D6D3D1); display: flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined" style="font-size: 24px; color: #A8A29E;">image</span>
                </div>
                <div style="padding: 16px; display: flex; flex-direction: column; justify-content: center;">
                    <div style="font-family: 'Fraunces', serif; font-size: 11px; font-weight: 700; color: #2C2416; margin-bottom: 6px;">Title Here</div>
                    <div style="font-size: 8px; color: #5C5242; line-height: 1.4;">Supporting text that explains the image or provides context.</div>
                </div>
            </div>
            <div class="slide-label">Image + Text</div>
            <div class="slide-desc">50/50 split with image on left</div>
        </div>

        <!-- Thank You -->
        <div>
            <div class="slide-preview" style="background: linear-gradient(135deg, #1A2744 0%, #2E3D5C 100%); padding: 20px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                <div style="font-family: 'Fraunces', serif; font-size: 20px; font-weight: 700; color: #fff; margin-bottom: 8px;">Thank You</div>
                <div style="font-size: 9px; color: rgba(255,255,255,0.7);">workshopr.io</div>
                <div style="font-size: 8px; color: rgba(255,255,255,0.5); margin-top: 4px;">@workshopr</div>
            </div>
            <div class="slide-label">Closing Slide</div>
            <div class="slide-desc">Navy background, URL and social handles</div>
        </div>
    </div>
</section>

<!-- Visual Elements -->
<section class="ds-section">
    <h2 class="ds-section-title">Visual Elements</h2>

    <div class="ds-grid-2">
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 12px; color: #1A2744;">Icons</div>
            <p style="font-size: 14px; color: #57534E; margin-bottom: 12px;">Use Material Symbols (outlined style) for diagrams and illustrations.</p>
            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <div style="width: 48px; height: 48px; background: #FEF2F2; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined" style="color: #E54D4D;">groups</span>
                </div>
                <div style="width: 48px; height: 48px; background: #E0F2FE; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined" style="color: #0284C7;">calendar_month</span>
                </div>
                <div style="width: 48px; height: 48px; background: #EDE9FE; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined" style="color: #7C4DFF;">psychology</span>
                </div>
                <div style="width: 48px; height: 48px; background: #D1FAE5; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined" style="color: #10B981;">trending_up</span>
                </div>
            </div>
            <p style="font-size: 12px; color: #78716C; margin-top: 12px;">Place icons in colored rounded squares (10px radius) with matching light backgrounds.</p>
        </div>
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 12px; color: #1A2744;">Charts & Graphs</div>
            <p style="font-size: 14px; color: #57534E; margin-bottom: 12px;">Use the accent color palette for data visualization.</p>
            <div style="display: flex; align-items: flex-end; gap: 8px; height: 60px;">
                <div style="width: 24px; height: 100%; background: #E54D4D; border-radius: 4px 4px 0 0;"></div>
                <div style="width: 24px; height: 75%; background: #0284C7; border-radius: 4px 4px 0 0;"></div>
                <div style="width: 24px; height: 50%; background: #7C4DFF; border-radius: 4px 4px 0 0;"></div>
                <div style="width: 24px; height: 85%; background: #10B981; border-radius: 4px 4px 0 0;"></div>
                <div style="width: 24px; height: 40%; background: #F59E0B; border-radius: 4px 4px 0 0;"></div>
            </div>
            <p style="font-size: 12px; color: #78716C; margin-top: 12px;">Order: Red → Blue → Purple → Green → Amber</p>
        </div>
    </div>

    <div class="ds-subsection" style="margin-top: 24px;">
        <div class="ds-subsection-title">Photography Guidelines</div>
        <div class="ds-card">
            <div class="ds-grid-2" style="gap: 24px;">
                <div>
                    <div style="font-weight: 600; margin-bottom: 8px; color: #166534;">Do</div>
                    <ul style="margin: 0; padding-left: 20px; font-size: 14px; color: #57534E;">
                        <li style="margin-bottom: 6px;">Use authentic workshop/collaboration photos</li>
                        <li style="margin-bottom: 6px;">Show diverse groups of people</li>
                        <li style="margin-bottom: 6px;">Prefer candid over posed shots</li>
                        <li style="margin-bottom: 6px;">Apply a subtle warm color grade</li>
                        <li>Use high-resolution images (min 1920px wide)</li>
                    </ul>
                </div>
                <div>
                    <div style="font-weight: 600; margin-bottom: 8px; color: #991B1B;">Don't</div>
                    <ul style="margin: 0; padding-left: 20px; font-size: 14px; color: #57534E;">
                        <li style="margin-bottom: 6px;">Use obvious stock photos</li>
                        <li style="margin-bottom: 6px;">Show outdated technology</li>
                        <li style="margin-bottom: 6px;">Use low-resolution or pixelated images</li>
                        <li style="margin-bottom: 6px;">Apply heavy filters or effects</li>
                        <li>Crop faces awkwardly</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Animations -->
<section class="ds-section">
    <h2 class="ds-section-title">Slide Transitions & Animations</h2>
    <p class="ds-section-desc">Keep motion subtle and purposeful.</p>

    <div class="ds-grid-2">
        <div class="ds-card" style="border-left: 4px solid #166534;">
            <div style="font-weight: 600; margin-bottom: 12px; color: #166534;">Recommended</div>
            <ul style="margin: 0; padding-left: 20px; font-size: 14px; color: #57534E;">
                <li style="margin-bottom: 6px;"><strong>Fade</strong> — Simple, professional transition between slides</li>
                <li style="margin-bottom: 6px;"><strong>Appear/Dissolve</strong> — For revealing bullet points one at a time</li>
                <li style="margin-bottom: 6px;"><strong>Wipe Left</strong> — For section dividers (optional)</li>
                <li><strong>Duration:</strong> 0.3-0.5 seconds</li>
            </ul>
        </div>
        <div class="ds-card" style="border-left: 4px solid #991B1B;">
            <div style="font-weight: 600; margin-bottom: 12px; color: #991B1B;">Avoid</div>
            <ul style="margin: 0; padding-left: 20px; font-size: 14px; color: #57534E;">
                <li style="margin-bottom: 6px;">Bouncy or springy animations</li>
                <li style="margin-bottom: 6px;">3D flips, rotations, or cubes</li>
                <li style="margin-bottom: 6px;">Flying elements from off-screen</li>
                <li style="margin-bottom: 6px;">Sound effects</li>
                <li>Animations longer than 1 second</li>
            </ul>
        </div>
    </div>
</section>

<!-- Content Guidelines -->
<section class="ds-section">
    <h2 class="ds-section-title">Content Guidelines</h2>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Slide Content Rules</div>
        <table class="ds-table">
            <thead>
                <tr>
                    <th>Rule</th>
                    <th>Guideline</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>One idea per slide</strong></td>
                    <td>If you have two key points, use two slides</td>
                </tr>
                <tr>
                    <td><strong>6 words per bullet max</strong></td>
                    <td>Bullets are prompts, not paragraphs</td>
                </tr>
                <tr>
                    <td><strong>3-5 bullets per slide max</strong></td>
                    <td>More than 5 = split into multiple slides</td>
                </tr>
                <tr>
                    <td><strong>Use speaker notes</strong></td>
                    <td>Details go in notes, not on the slide</td>
                </tr>
                <tr>
                    <td><strong>Headlines, not sentences</strong></td>
                    <td>"Dot voting fails" not "Traditional dot voting often fails to produce meaningful results"</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Voice & Tone (from Brand Guidelines)</div>
        <div class="ds-card">
            <div class="ds-grid-2" style="gap: 24px;">
                <div>
                    <div style="font-weight: 600; margin-bottom: 8px; color: #1A2744;">Sound like...</div>
                    <p style="font-size: 14px; color: #57534E; margin: 0;">A practitioner with 15+ years in the trenches sharing what they've learned. Direct, opinionated, helpful.</p>
                </div>
                <div>
                    <div style="font-weight: 600; margin-bottom: 8px; color: #1A2744;">Don't sound like...</div>
                    <p style="font-size: 14px; color: #57534E; margin: 0;">An academic textbook, a motivational speaker, a corporate training manual, or AI-generated content.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Logo Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Logo Usage</h2>

    <div class="ds-card">
        <div class="ds-grid-3" style="gap: 24px; align-items: center;">
            <div style="text-align: center;">
                <div style="background: #FFFFFF; padding: 24px; border-radius: 8px; border: 1px solid #E7E5E4; margin-bottom: 12px;">
                    <svg width="120" height="40" viewBox="0 -960 960 960" fill="#E54D4D"><path d="M480-80q-50 0-85-35t-35-85q0-5 .5-11t1.5-11l-83-47q-16 14-36 21.5t-43 7.5q-50 0-85-35t-35-85q0-50 35-85t85-35q24 0 45 9t38 25l119-60q-3-23 2.5-45t19.5-41l-34-52q-7 2-14.5 3t-15.5 1q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 20-6.5 38.5T456-688l35 52q8-2 15-3t15-1q17 0 32 4t29 12l66-54q-4-10-6-20.5t-2-21.5q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35q-17 0-32-4.5T699-617l-66 55q4 10 6 20.5t2 21.5q0 50-35 85t-85 35q-24 0-45.5-9T437-434l-118 59q2 9 1.5 18t-2.5 18l84 48q16-14 35.5-21.5T480-320q50 0 85 35t35 85q0 50-35 85t-85 35Z"/></svg>
                </div>
                <div style="font-size: 12px; color: #78716C;">Light backgrounds</div>
            </div>
            <div style="text-align: center;">
                <div style="background: #1A2744; padding: 24px; border-radius: 8px; margin-bottom: 12px;">
                    <svg width="120" height="40" viewBox="0 -960 960 960" fill="#E54D4D"><path d="M480-80q-50 0-85-35t-35-85q0-5 .5-11t1.5-11l-83-47q-16 14-36 21.5t-43 7.5q-50 0-85-35t-35-85q0-50 35-85t85-35q24 0 45 9t38 25l119-60q-3-23 2.5-45t19.5-41l-34-52q-7 2-14.5 3t-15.5 1q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 20-6.5 38.5T456-688l35 52q8-2 15-3t15-1q17 0 32 4t29 12l66-54q-4-10-6-20.5t-2-21.5q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35q-17 0-32-4.5T699-617l-66 55q4 10 6 20.5t2 21.5q0 50-35 85t-85 35q-24 0-45.5-9T437-434l-118 59q2 9 1.5 18t-2.5 18l84 48q16-14 35.5-21.5T480-320q50 0 85 35t35 85q0 50-35 85t-85 35Z"/></svg>
                </div>
                <div style="font-size: 12px; color: #78716C;">Dark backgrounds</div>
            </div>
            <div style="text-align: center;">
                <div style="background: #E54D4D; padding: 24px; border-radius: 8px; margin-bottom: 12px;">
                    <svg width="120" height="40" viewBox="0 -960 960 960" fill="#FFFFFF"><path d="M480-80q-50 0-85-35t-35-85q0-5 .5-11t1.5-11l-83-47q-16 14-36 21.5t-43 7.5q-50 0-85-35t-35-85q0-50 35-85t85-35q24 0 45 9t38 25l119-60q-3-23 2.5-45t19.5-41l-34-52q-7 2-14.5 3t-15.5 1q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 20-6.5 38.5T456-688l35 52q8-2 15-3t15-1q17 0 32 4t29 12l66-54q-4-10-6-20.5t-2-21.5q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35q-17 0-32-4.5T699-617l-66 55q4 10 6 20.5t2 21.5q0 50-35 85t-85 35q-24 0-45.5-9T437-434l-118 59q2 9 1.5 18t-2.5 18l84 48q16-14 35.5-21.5T480-320q50 0 85 35t35 85q0 50-35 85t-85 35Z"/></svg>
                </div>
                <div style="font-size: 12px; color: #78716C;">Brand backgrounds (white logo)</div>
            </div>
        </div>
        <div style="margin-top: 20px; padding-top: 16px; border-top: 1px solid #E7E5E4;">
            <p style="font-size: 13px; color: #78716C; margin: 0;"><strong>Placement:</strong> Bottom-left corner of title and closing slides. Minimum size: 100px width. Clear space: 24px around logo.</p>
        </div>
    </div>
</section>

<!-- Template Downloads -->
<section class="ds-section">
    <h2 class="ds-section-title">Presentation Types</h2>
    <p class="ds-section-desc">Use the appropriate template for each context.</p>

    <div class="ds-grid-2">
        <div class="ds-card">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                <div style="width: 40px; height: 40px; background: #FEF2F2; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined" style="color: #E54D4D;">campaign</span>
                </div>
                <div style="font-weight: 600; color: #1A2744;">Keynote / Conference</div>
            </div>
            <p style="font-size: 14px; color: #57534E; margin-bottom: 12px;">Large venue presentations with bold visuals and minimal text.</p>
            <ul style="margin: 0; padding-left: 20px; font-size: 13px; color: #78716C;">
                <li>Large type (48-96px headlines)</li>
                <li>High-contrast colors</li>
                <li>Full-bleed images</li>
                <li>Speaker-driven, slides as backdrop</li>
            </ul>
        </div>
        <div class="ds-card">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                <div style="width: 40px; height: 40px; background: #E0F2FE; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined" style="color: #0284C7;">videocam</span>
                </div>
                <div style="font-weight: 600; color: #1A2744;">Webinar / Virtual</div>
            </div>
            <p style="font-size: 14px; color: #57534E; margin-bottom: 12px;">Screen-shared presentations for remote audiences.</p>
            <ul style="margin: 0; padding-left: 20px; font-size: 13px; color: #78716C;">
                <li>More text acceptable (28-32px body)</li>
                <li>Consider chat/Q&A real estate</li>
                <li>Use cream backgrounds (easier on eyes)</li>
                <li>Slides carry more content</li>
            </ul>
        </div>
        <div class="ds-card">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                <div style="width: 40px; height: 40px; background: #EDE9FE; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined" style="color: #7C4DFF;">handshake</span>
                </div>
                <div style="font-weight: 600; color: #1A2744;">Sales Deck</div>
            </div>
            <p style="font-size: 14px; color: #57534E; margin-bottom: 12px;">Client-facing presentations with clear value propositions.</p>
            <ul style="margin: 0; padding-left: 20px; font-size: 13px; color: #78716C;">
                <li>Problem/solution structure</li>
                <li>Social proof (logos, testimonials)</li>
                <li>Clear CTAs</li>
                <li>Leave-behind friendly</li>
            </ul>
        </div>
        <div class="ds-card">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                <div style="width: 40px; height: 40px; background: #D1FAE5; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined" style="color: #10B981;">school</span>
                </div>
                <div style="font-weight: 600; color: #1A2744;">Training / Educational</div>
            </div>
            <p style="font-size: 14px; color: #57534E; margin-bottom: 12px;">Internal or customer training with detailed content.</p>
            <ul style="margin: 0; padding-left: 20px; font-size: 13px; color: #78716C;">
                <li>Step-by-step structures</li>
                <li>More detail per slide acceptable</li>
                <li>Screenshots and demos</li>
                <li>Include exercises/interactions</li>
            </ul>
        </div>
    </div>
</section>

<!-- Checklist -->
<section class="ds-section">
    <h2 class="ds-section-title">Pre-Presentation Checklist</h2>

    <div class="ds-card">
        <div class="ds-grid-2" style="gap: 24px;">
            <div>
                <div style="font-weight: 600; margin-bottom: 12px; color: #1A2744;">Design Check</div>
                <ul style="margin: 0; padding-left: 20px; font-size: 14px; color: #57534E;">
                    <li style="margin-bottom: 6px;">Fraunces for headings, Inter for body</li>
                    <li style="margin-bottom: 6px;">Colors from approved palette only</li>
                    <li style="margin-bottom: 6px;">Logo on title and closing slides</li>
                    <li style="margin-bottom: 6px;">Consistent slide numbers</li>
                    <li style="margin-bottom: 6px;">All images high-resolution</li>
                    <li>Text readable from back of room</li>
                </ul>
            </div>
            <div>
                <div style="font-weight: 600; margin-bottom: 12px; color: #1A2744;">Content Check</div>
                <ul style="margin: 0; padding-left: 20px; font-size: 14px; color: #57534E;">
                    <li style="margin-bottom: 6px;">One idea per slide</li>
                    <li style="margin-bottom: 6px;">No more than 5 bullets</li>
                    <li style="margin-bottom: 6px;">Bullets are headlines, not sentences</li>
                    <li style="margin-bottom: 6px;">Speaker notes complete</li>
                    <li style="margin-bottom: 6px;">No banned words (leverage, synergy, etc.)</li>
                    <li>Spell check complete</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
