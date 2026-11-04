// ============================================================
// WORKSHOPR DESIGN SYSTEM — Figma Plugin Script
// Run in: Plugins > Development > Open Console > paste & run
// Creates: Color Styles, Text Styles, Visual Foundation Frames
// ============================================================

// --- UTILITIES ---
function hexToRgb(hex) {
  hex = hex.replace('#', '');
  return {
    r: parseInt(hex.substring(0, 2), 16) / 255,
    g: parseInt(hex.substring(2, 4), 16) / 255,
    b: parseInt(hex.substring(4, 6), 16) / 255
  };
}

function solidPaint(hex, opacity) {
  const rgb = hexToRgb(hex);
  const paint = { type: 'SOLID', color: rgb };
  if (opacity !== undefined) paint.opacity = opacity;
  return [paint];
}

// ============================================================
// PART 1: COLOR STYLES
// ============================================================
async function createColorStyles() {

  const colors = {

    // --- Phase Colors ---
    'Phase/Learn': '#E54D4D',
    'Phase/Learn Dark': '#C73E3E',
    'Phase/Learn Light': '#FEE2E2',
    'Phase/Learn Very Light': '#FEF2F2',

    'Phase/Plan': '#0284C7',
    'Phase/Plan Dark': '#075985',
    'Phase/Plan Light': '#E0F2FE',
    'Phase/Plan Very Light': '#F0F9FF',

    'Phase/Facilitate': '#7C4DFF',
    'Phase/Facilitate Dark': '#6D28D9',
    'Phase/Facilitate Light': '#DDD6FE',
    'Phase/Facilitate Very Light': '#EDE9FE',

    'Phase/Reflect': '#10B981',
    'Phase/Reflect Dark': '#059669',
    'Phase/Reflect Light': '#A7F3D0',
    'Phase/Reflect Very Light': '#D1FAE5',

    // --- App: Main Site ---
    'App/Mainsite/Primary': '#E54D4D',
    'App/Mainsite/Dark': '#C73E3E',
    'App/Mainsite/Light': '#FEE2E2',
    'App/Mainsite/Very Light': '#FEF2F2',

    // --- App: Tips ---
    'App/Tips/Primary': '#7C4DFF',
    'App/Tips/Dark': '#6930C3',
    'App/Tips/Light': '#E8DEFF',
    'App/Tips/Very Light': '#F3EEFF',
    'App/Tips/Cat 1 Fundamentals': '#4527A0',
    'App/Tips/Cat 2 Engagement': '#5E35B1',
    'App/Tips/Cat 3 Facilitation': '#6930C3',
    'App/Tips/Cat 4 Difficult Moments': '#7C4DFF',
    'App/Tips/Cat 5 Activities': '#9575CD',
    'App/Tips/Cat 6 Reflection': '#B39DDB',

    // --- App: Podcasts ---
    'App/Podcasts/Primary': '#BE123C',
    'App/Podcasts/Dark': '#9F1239',
    'App/Podcasts/Light': '#FECDD3',
    'App/Podcasts/Very Light': '#FFE4E6',
    'App/Podcasts/Spotify': '#1DB954',
    'App/Podcasts/Apple': '#FC3C44',
    'App/Podcasts/Amazon': '#FF9900',
    'App/Podcasts/YouTube': '#FF0000',

    // --- App: Planner ---
    'App/Planner/Primary': '#0284C7',
    'App/Planner/Dark': '#075985',
    'App/Planner/Light': '#BAE6FD',
    'App/Planner/Very Light': '#E0F2FE',
    'App/Planner/Accent': '#F0F9FF',

    // --- App: Coach ---
    'App/Coach/Primary': '#7C4DFF',
    'App/Coach/Dark': '#6D28D9',
    'App/Coach/Light': '#DDD6FE',
    'App/Coach/Very Light': '#EDE9FE',
    'App/Coach/Mode Prep': '#A78BFA',
    'App/Coach/Mode Facilitate': '#8B5CF6',
    'App/Coach/Mode Synthesize': '#7C3AED',
    'App/Coach/Mode Debrief': '#6D28D9',
    'App/Coach/BG': '#FFFBF8',
    'App/Coach/Surface': '#FFFFFF',
    'App/Coach/Border': '#E8ECF1',

    // --- App: Intervention ---
    'App/Intervention/Primary': '#7C4DFF',
    'App/Intervention/Dark': '#5B21B6',
    'App/Intervention/Light': '#DDD6FE',
    'App/Intervention/Very Light': '#EDE9FE',
    'App/Intervention/Cat 1 Energy': '#4C1D95',
    'App/Intervention/Cat 2 Conflict': '#5B21B6',
    'App/Intervention/Cat 3 Participation': '#6D28D9',
    'App/Intervention/Cat 4 Pacing': '#7C3AED',
    'App/Intervention/Cat 5 Focus': '#8B5CF6',
    'App/Intervention/Cat 6 Trust': '#A78BFA',

    // --- App: DNA ---
    'App/DNA/Primary': '#34D399',
    'App/DNA/Dark': '#10B981',
    'App/DNA/Light': '#6EE7B7',
    'App/DNA/Very Light': '#A7F3D0',
    'App/DNA/Cat 1 Strengths': '#047857',
    'App/DNA/Cat 2 Growth': '#059669',
    'App/DNA/Cat 3 Style': '#10B981',
    'App/DNA/Cat 4 History': '#34D399',
    'App/DNA/Cat 5 Goals': '#6EE7B7',

    // --- App: Training ---
    'App/Training/Primary': '#E54D4D',
    'App/Training/Dark': '#C73E3E',
    'App/Training/Light': '#FEE2E2',
    'App/Training/Very Light': '#FEF2F2',

    // --- Semantic ---
    'Semantic/Success': '#22C55E',
    'Semantic/Success Dark': '#16A34A',
    'Semantic/Success Light': '#BBF7D0',
    'Semantic/Success Very Light': '#DCFCE7',
    'Semantic/Success Ink': '#065F46',

    'Semantic/Warning': '#F59E0B',
    'Semantic/Warning Dark': '#D97706',
    'Semantic/Warning Light': '#FDE68A',
    'Semantic/Warning Very Light': '#FEF3C7',
    'Semantic/Warning Ink': '#92400E',

    'Semantic/Error': '#EF4444',
    'Semantic/Error Dark': '#DC2626',
    'Semantic/Error Light': '#FECACA',
    'Semantic/Error Very Light': '#FEE2E2',
    'Semantic/Error Ink': '#9A1F2B',

    'Semantic/Info': '#3B82F6',
    'Semantic/Info Dark': '#2563EB',
    'Semantic/Info Light': '#BFDBFE',
    'Semantic/Info Very Light': '#DBEAFE',

    // --- Ink / Text ---
    'Ink/Default': '#2C2416',
    'Ink/Secondary': '#5C5242',
    'Ink/Muted': '#706965',
    'Ink/Faint': '#A8A29E',
    'Ink/Inverse': '#FFFFFF',

    // --- Backgrounds ---
    'Background/Page': '#FEF7F1',
    'Background/Page Alt': '#FFFBF8',
    'Background/Page Warm': '#FAF4ED',
    'Background/Surface': '#FFFFFF',
    'Background/Muted': '#F5F5F4',
    'Background/Subtle': '#FAFAF9',
    'Background/Warm Muted': '#F5F3EF',
    'Background/Cool': '#F5F7FA',

    // --- Gray Scale (Warm Stone) ---
    'Gray/50': '#FAFAF9',
    'Gray/100': '#F5F5F4',
    'Gray/200': '#E7E5E4',
    'Gray/300': '#D6D3D1',
    'Gray/400': '#A8A29E',
    'Gray/500': '#78716C',
    'Gray/600': '#57534E',
    'Gray/700': '#44403C',
    'Gray/800': '#292524',
    'Gray/900': '#1C1917',

    // --- Navy ---
    'Navy/Base': '#1A2744',
    'Navy/Light': '#2E3D5C',

    // --- Cool UI ---
    'Cool/Border': '#E8ECF1',
    'Cool/Text Muted': '#6B7A94',
    'Cool/Text Faint': '#9CA8BC',
  };

  let count = 0;
  for (const [name, hex] of Object.entries(colors)) {
    const style = figma.createPaintStyle();
    style.name = name;
    style.paints = solidPaint(hex);
    count++;
  }

  console.log(`✅ Created ${count} color styles`);
  return count;
}

// ============================================================
// PART 2: TEXT STYLES
// ============================================================
async function createTextStyles() {

  // Load fonts first
  await figma.loadFontAsync({ family: 'Inter', style: 'Regular' });
  await figma.loadFontAsync({ family: 'Inter', style: 'Medium' });
  await figma.loadFontAsync({ family: 'Inter', style: 'Semi Bold' });
  await figma.loadFontAsync({ family: 'Inter', style: 'Bold' });

  // Note: Fraunces may not be available in Figma by default.
  // We'll use a fallback — you can swap after import.
  let headingFamily = 'Inter'; // fallback
  let headingLoaded = false;
  try {
    await figma.loadFontAsync({ family: 'Fraunces', style: 'Bold' });
    await figma.loadFontAsync({ family: 'Fraunces', style: 'Semi Bold' });
    headingFamily = 'Fraunces';
    headingLoaded = true;
  } catch (e) {
    console.log('⚠️  Fraunces font not found — using Inter as heading fallback. Install Fraunces in Figma, then update styles.');
  }

  const textStyles = [
    // Headings (Fraunces or fallback)
    { name: 'Heading/Display',  size: 46, weight: 'Bold',      family: headingFamily, lineHeight: 1.2,  letterSpacing: -0.02 },
    { name: 'Heading/H1',      size: 32, weight: 'Bold',      family: headingFamily, lineHeight: 1.2,  letterSpacing: -0.02 },
    { name: 'Heading/H2',      size: 24, weight: 'Semi Bold', family: headingFamily, lineHeight: 1.2,  letterSpacing: -0.02 },
    { name: 'Heading/H3',      size: 20, weight: 'Semi Bold', family: headingFamily, lineHeight: 1.35, letterSpacing: 0 },

    // UI Text (Inter)
    { name: 'Body/H4',         size: 18, weight: 'Semi Bold', family: 'Inter', lineHeight: 1.35, letterSpacing: 0 },
    { name: 'Body/Body',       size: 16, weight: 'Regular',   family: 'Inter', lineHeight: 1.5,  letterSpacing: 0 },
    { name: 'Body/Body Medium',size: 16, weight: 'Medium',    family: 'Inter', lineHeight: 1.5,  letterSpacing: 0 },
    { name: 'Body/Body Bold',  size: 16, weight: 'Bold',      family: 'Inter', lineHeight: 1.5,  letterSpacing: 0 },
    { name: 'Body/UI',         size: 15, weight: 'Regular',   family: 'Inter', lineHeight: 1.5,  letterSpacing: 0 },
    { name: 'Body/UI Medium',  size: 15, weight: 'Medium',    family: 'Inter', lineHeight: 1.5,  letterSpacing: 0 },
    { name: 'Body/Small',      size: 14, weight: 'Regular',   family: 'Inter', lineHeight: 1.5,  letterSpacing: 0 },
    { name: 'Body/Small Medium',size: 14, weight: 'Medium',   family: 'Inter', lineHeight: 1.5,  letterSpacing: 0 },
    { name: 'Body/Meta',       size: 13, weight: 'Regular',   family: 'Inter', lineHeight: 1.5,  letterSpacing: 0.025 },
    { name: 'Body/Meta Medium',size: 13, weight: 'Medium',    family: 'Inter', lineHeight: 1.5,  letterSpacing: 0.025 },
    { name: 'Body/Caption',    size: 12, weight: 'Regular',   family: 'Inter', lineHeight: 1.5,  letterSpacing: 0.025 },
    { name: 'Body/Caption Medium',size: 12, weight: 'Medium', family: 'Inter', lineHeight: 1.5,  letterSpacing: 0.025 },
    { name: 'Body/Micro',      size: 11, weight: 'Medium',    family: 'Inter', lineHeight: 1.35, letterSpacing: 0.025 },
    { name: 'Body/Nano',       size: 10, weight: 'Medium',    family: 'Inter', lineHeight: 1.35, letterSpacing: 0.025 },
  ];

  let count = 0;
  for (const def of textStyles) {
    const style = figma.createTextStyle();
    style.name = def.name;
    style.fontName = { family: def.family, style: def.weight };
    style.fontSize = def.size;
    style.lineHeight = { value: def.size * def.lineHeight, unit: 'PIXELS' };
    if (def.letterSpacing !== 0) {
      style.letterSpacing = { value: def.letterSpacing * 100, unit: 'PERCENT' };
    }
    count++;
  }

  console.log(`✅ Created ${count} text styles` + (headingLoaded ? '' : ' (Fraunces not found — using Inter fallback)'));
  return count;
}

// ============================================================
// PART 3: VISUAL REFERENCE FRAMES
// ============================================================
async function createFoundationFrames() {

  await figma.loadFontAsync({ family: 'Inter', style: 'Regular' });
  await figma.loadFontAsync({ family: 'Inter', style: 'Medium' });
  await figma.loadFontAsync({ family: 'Inter', style: 'Semi Bold' });
  await figma.loadFontAsync({ family: 'Inter', style: 'Bold' });

  const page = figma.currentPage;

  // ---- Helper: create a labeled color swatch ----
  function createSwatch(parent, x, y, hex, label, sublabel) {
    const rect = figma.createRectangle();
    rect.x = x;
    rect.y = y;
    rect.resize(80, 80);
    rect.cornerRadius = 12;
    rect.fills = solidPaint(hex);
    parent.appendChild(rect);

    const nameText = figma.createText();
    nameText.x = x;
    nameText.y = y + 88;
    nameText.fontSize = 12;
    nameText.fontName = { family: 'Inter', style: 'Semi Bold' };
    nameText.characters = label;
    nameText.fills = solidPaint('#2C2416');
    parent.appendChild(nameText);

    const hexText = figma.createText();
    hexText.x = x;
    hexText.y = y + 104;
    hexText.fontSize = 11;
    hexText.fontName = { family: 'Inter', style: 'Regular' };
    hexText.characters = hex;
    hexText.fills = solidPaint('#78716C');
    parent.appendChild(hexText);

    return 108; // column width
  }

  // ---- Helper: section title ----
  function createTitle(parent, x, y, text, size) {
    const t = figma.createText();
    t.x = x;
    t.y = y;
    t.fontSize = size || 24;
    t.fontName = { family: 'Inter', style: 'Bold' };
    t.characters = text;
    t.fills = solidPaint('#2C2416');
    parent.appendChild(t);
  }

  function createSubtitle(parent, x, y, text) {
    const t = figma.createText();
    t.x = x;
    t.y = y;
    t.fontSize = 14;
    t.fontName = { family: 'Inter', style: 'Medium' };
    t.characters = text;
    t.fills = solidPaint('#78716C');
    parent.appendChild(t);
  }

  // === MAIN FRAME ===
  const main = figma.createFrame();
  main.name = '🎨 Workshopr Design System — Foundations';
  main.resize(2400, 4800);
  main.fills = solidPaint('#FFFFFF');
  page.appendChild(main);
  main.x = 200;
  main.y = 200;

  let yPos = 60;

  // --- HEADER ---
  createTitle(main, 60, yPos, 'Workshopr Design System v3.0', 36);
  yPos += 50;
  createSubtitle(main, 60, yPos, 'LEARN → PLAN → FACILITATE → REFLECT');
  yPos += 60;

  // === SECTION: PHASE COLORS ===
  createTitle(main, 60, yPos, 'Phase Colors');
  yPos += 40;

  const phases = [
    { name: 'Learn', colors: [['Primary', '#E54D4D'], ['Dark', '#C73E3E'], ['Light', '#FEE2E2'], ['Very Light', '#FEF2F2']] },
    { name: 'Plan', colors: [['Primary', '#0284C7'], ['Dark', '#075985'], ['Light', '#E0F2FE'], ['Very Light', '#F0F9FF']] },
    { name: 'Facilitate', colors: [['Primary', '#7C4DFF'], ['Dark', '#6D28D9'], ['Light', '#DDD6FE'], ['Very Light', '#EDE9FE']] },
    { name: 'Reflect', colors: [['Primary', '#10B981'], ['Dark', '#059669'], ['Light', '#A7F3D0'], ['Very Light', '#D1FAE5']] },
  ];

  for (const phase of phases) {
    createSubtitle(main, 60, yPos, phase.name.toUpperCase());
    yPos += 28;
    let xPos = 60;
    for (const [label, hex] of phase.colors) {
      createSwatch(main, xPos, yPos, hex, label, '');
      xPos += 108;
    }
    yPos += 140;
  }

  // === SECTION: APP COLORS ===
  yPos += 20;
  createTitle(main, 60, yPos, 'App Colors');
  yPos += 40;

  const apps = [
    { name: 'Mainsite (Learn)', colors: [['Primary', '#E54D4D'], ['Dark', '#C73E3E'], ['Light', '#FEE2E2'], ['Very Light', '#FEF2F2']] },
    { name: 'Planner (Plan)', colors: [['Primary', '#0284C7'], ['Dark', '#075985'], ['Light', '#BAE6FD'], ['Very Light', '#E0F2FE'], ['Accent', '#F0F9FF']] },
    { name: 'Coach (Facilitate)', colors: [['Primary', '#7C4DFF'], ['Dark', '#6D28D9'], ['Light', '#DDD6FE'], ['Very Light', '#EDE9FE'], ['Prep', '#A78BFA'], ['Facilitate', '#8B5CF6'], ['Synthesize', '#7C3AED'], ['Debrief', '#6D28D9']] },
    { name: 'Intervention (Facilitate)', colors: [['Primary', '#7C4DFF'], ['Dark', '#5B21B6'], ['Cat 1', '#4C1D95'], ['Cat 2', '#5B21B6'], ['Cat 3', '#6D28D9'], ['Cat 4', '#7C3AED'], ['Cat 5', '#8B5CF6'], ['Cat 6', '#A78BFA']] },
    { name: 'Tips (Facilitate)', colors: [['Primary', '#7C4DFF'], ['Dark', '#6930C3'], ['Cat 1', '#4527A0'], ['Cat 2', '#5E35B1'], ['Cat 3', '#6930C3'], ['Cat 4', '#7C4DFF'], ['Cat 5', '#9575CD'], ['Cat 6', '#B39DDB']] },
    { name: 'DNA (Reflect)', colors: [['Primary', '#34D399'], ['Dark', '#10B981'], ['Light', '#6EE7B7'], ['Very Light', '#A7F3D0'], ['Strengths', '#047857'], ['Growth', '#059669'], ['Style', '#10B981'], ['History', '#34D399'], ['Goals', '#6EE7B7']] },
    { name: 'Podcasts (Learn)', colors: [['Primary', '#BE123C'], ['Dark', '#9F1239'], ['Light', '#FECDD3'], ['Very Light', '#FFE4E6']] },
    { name: 'Training (Learn)', colors: [['Primary', '#E54D4D'], ['Dark', '#C73E3E'], ['Light', '#FEE2E2'], ['Very Light', '#FEF2F2']] },
  ];

  for (const app of apps) {
    createSubtitle(main, 60, yPos, app.name.toUpperCase());
    yPos += 28;
    let xPos = 60;
    for (const [label, hex] of app.colors) {
      createSwatch(main, xPos, yPos, hex, label, '');
      xPos += 108;
    }
    yPos += 140;
  }

  // === SECTION: SEMANTIC COLORS ===
  yPos += 20;
  createTitle(main, 60, yPos, 'Semantic Colors');
  yPos += 40;

  const semantics = [
    { name: 'Success', colors: [['Base', '#22C55E'], ['Dark', '#16A34A'], ['Light', '#BBF7D0'], ['Very Light', '#DCFCE7'], ['Ink', '#065F46']] },
    { name: 'Warning', colors: [['Base', '#F59E0B'], ['Dark', '#D97706'], ['Light', '#FDE68A'], ['Very Light', '#FEF3C7'], ['Ink', '#92400E']] },
    { name: 'Error', colors: [['Base', '#EF4444'], ['Dark', '#DC2626'], ['Light', '#FECACA'], ['Very Light', '#FEE2E2'], ['Ink', '#9A1F2B']] },
    { name: 'Info', colors: [['Base', '#3B82F6'], ['Dark', '#2563EB'], ['Light', '#BFDBFE'], ['Very Light', '#DBEAFE']] },
  ];

  for (const sem of semantics) {
    createSubtitle(main, 60, yPos, sem.name.toUpperCase());
    yPos += 28;
    let xPos = 60;
    for (const [label, hex] of sem.colors) {
      createSwatch(main, xPos, yPos, hex, label, '');
      xPos += 108;
    }
    yPos += 140;
  }

  // === SECTION: INK & BACKGROUNDS ===
  yPos += 20;
  createTitle(main, 60, yPos, 'Ink & Backgrounds');
  yPos += 40;

  createSubtitle(main, 60, yPos, 'INK (TEXT COLORS)');
  yPos += 28;
  let xPos = 60;
  for (const [label, hex] of [['Default', '#2C2416'], ['Secondary', '#5C5242'], ['Muted', '#706965'], ['Faint', '#A8A29E'], ['Inverse', '#FFFFFF']]) {
    createSwatch(main, xPos, yPos, hex, label, '');
    xPos += 108;
  }
  yPos += 150;

  createSubtitle(main, 60, yPos, 'BACKGROUNDS');
  yPos += 28;
  xPos = 60;
  for (const [label, hex] of [['Page', '#FEF7F1'], ['Page Alt', '#FFFBF8'], ['Page Warm', '#FAF4ED'], ['Surface', '#FFFFFF'], ['Muted', '#F5F5F4'], ['Subtle', '#FAFAF9'], ['Cool', '#F5F7FA']]) {
    createSwatch(main, xPos, yPos, hex, label, '');
    xPos += 108;
  }
  yPos += 150;

  // === SECTION: GRAY SCALE ===
  createSubtitle(main, 60, yPos, 'GRAY SCALE (WARM STONE)');
  yPos += 28;
  xPos = 60;
  for (const [label, hex] of [['50', '#FAFAF9'], ['100', '#F5F5F4'], ['200', '#E7E5E4'], ['300', '#D6D3D1'], ['400', '#A8A29E'], ['500', '#78716C'], ['600', '#57534E'], ['700', '#44403C'], ['800', '#292524'], ['900', '#1C1917']]) {
    createSwatch(main, xPos, yPos, hex, label, '');
    xPos += 108;
  }
  yPos += 160;

  // === SECTION: TYPOGRAPHY SCALE ===
  yPos += 20;
  createTitle(main, 60, yPos, 'Typography Scale');
  yPos += 50;

  const typeScale = [
    { name: 'Display', size: 46, font: 'Bold', desc: '46px · Fraunces Bold · Hero text' },
    { name: 'H1', size: 32, font: 'Bold', desc: '32px · Fraunces Bold' },
    { name: 'H2', size: 24, font: 'Semi Bold', desc: '24px · Fraunces SemiBold' },
    { name: 'H3', size: 20, font: 'Semi Bold', desc: '20px · Fraunces SemiBold' },
    { name: 'H4', size: 18, font: 'Semi Bold', desc: '18px · Inter SemiBold' },
    { name: 'Body', size: 16, font: 'Regular', desc: '16px · Inter Regular' },
    { name: 'UI', size: 15, font: 'Regular', desc: '15px · Inter Regular' },
    { name: 'Small', size: 14, font: 'Regular', desc: '14px · Inter Regular' },
    { name: 'Meta', size: 13, font: 'Regular', desc: '13px · Inter Regular' },
    { name: 'Caption', size: 12, font: 'Regular', desc: '12px · Inter Regular' },
    { name: 'Micro', size: 11, font: 'Medium', desc: '11px · Inter Medium' },
    { name: 'Nano', size: 10, font: 'Medium', desc: '10px · Inter Medium' },
  ];

  for (const t of typeScale) {
    // Sample text
    const sample = figma.createText();
    sample.x = 60;
    sample.y = yPos;
    sample.fontSize = t.size;
    sample.fontName = { family: 'Inter', style: t.font };
    sample.characters = t.name;
    sample.fills = solidPaint('#2C2416');
    main.appendChild(sample);

    // Description
    const desc = figma.createText();
    desc.x = 500;
    desc.y = yPos + Math.max(0, (t.size - 13) / 2);
    desc.fontSize = 13;
    desc.fontName = { family: 'Inter', style: 'Regular' };
    desc.characters = t.desc;
    desc.fills = solidPaint('#78716C');
    main.appendChild(desc);

    yPos += Math.max(t.size * 1.5, 32) + 16;
  }

  // === SECTION: SPACING SCALE ===
  yPos += 40;
  createTitle(main, 60, yPos, 'Spacing Scale (4px base)');
  yPos += 50;

  const spacingScale = [
    ['0.5', 2], ['1', 4], ['1.5', 6], ['2', 8], ['2.5', 10],
    ['3', 12], ['3.5', 14], ['4', 16], ['4.5', 18], ['5', 20],
    ['6', 24], ['8', 32], ['10', 40], ['12', 48], ['16', 64],
  ];

  for (const [token, px] of spacingScale) {
    // Bar
    const bar = figma.createRectangle();
    bar.x = 160;
    bar.y = yPos;
    bar.resize(px, 24);
    bar.cornerRadius = 4;
    bar.fills = solidPaint('#0284C7');
    main.appendChild(bar);

    // Label
    const label = figma.createText();
    label.x = 60;
    label.y = yPos + 4;
    label.fontSize = 13;
    label.fontName = { family: 'Inter', style: 'Medium' };
    label.characters = `space-${token}`;
    label.fills = solidPaint('#2C2416');
    main.appendChild(label);

    // Value
    const val = figma.createText();
    val.x = 160 + px + 12;
    val.y = yPos + 4;
    val.fontSize = 12;
    val.fontName = { family: 'Inter', style: 'Regular' };
    val.characters = `${px}px`;
    val.fills = solidPaint('#78716C');
    main.appendChild(val);

    yPos += 36;
  }

  // === SECTION: BORDER RADIUS ===
  yPos += 40;
  createTitle(main, 60, yPos, 'Border Radius');
  yPos += 50;

  const radii = [
    ['sm', 4], ['md', 6], ['lg', 8], ['xl', 12], ['2xl', 16], ['full', 9999],
  ];

  xPos = 60;
  for (const [token, radius] of radii) {
    const rect = figma.createRectangle();
    rect.x = xPos;
    rect.y = yPos;
    rect.resize(80, 80);
    rect.cornerRadius = Math.min(radius, 40);
    rect.fills = solidPaint('#E0F2FE');
    rect.strokes = [{ type: 'SOLID', color: hexToRgb('#0284C7') }];
    rect.strokeWeight = 2;
    main.appendChild(rect);

    const label = figma.createText();
    label.x = xPos;
    label.y = yPos + 90;
    label.fontSize = 12;
    label.fontName = { family: 'Inter', style: 'Semi Bold' };
    label.characters = token;
    label.fills = solidPaint('#2C2416');
    main.appendChild(label);

    const val = figma.createText();
    val.x = xPos;
    val.y = yPos + 106;
    val.fontSize = 11;
    val.fontName = { family: 'Inter', style: 'Regular' };
    val.characters = radius === 9999 ? 'pill' : `${radius}px`;
    val.fills = solidPaint('#78716C');
    main.appendChild(val);

    xPos += 110;
  }
  yPos += 140;

  // === SECTION: SHADOWS ===
  yPos += 40;
  createTitle(main, 60, yPos, 'Shadows');
  yPos += 50;

  const shadows = [
    ['xs', 0, 1, 2, 0.04],
    ['sm', 0, 1, 3, 0.06],
    ['md', 0, 4, 6, 0.07],
    ['lg', 0, 10, 15, 0.08],
    ['xl', 0, 20, 25, 0.10],
  ];

  xPos = 60;
  for (const [token, offX, offY, blur, alpha] of shadows) {
    const rect = figma.createRectangle();
    rect.x = xPos;
    rect.y = yPos;
    rect.resize(120, 80);
    rect.cornerRadius = 12;
    rect.fills = solidPaint('#FFFFFF');
    rect.effects = [{
      type: 'DROP_SHADOW',
      visible: true,
      color: { r: 0, g: 0, b: 0, a: alpha },
      offset: { x: offX, y: offY },
      radius: blur,
      spread: 0,
      blendMode: 'NORMAL',
    }];
    main.appendChild(rect);

    const label = figma.createText();
    label.x = xPos;
    label.y = yPos + 90;
    label.fontSize = 12;
    label.fontName = { family: 'Inter', style: 'Semi Bold' };
    label.characters = `shadow-${token}`;
    label.fills = solidPaint('#2C2416');
    main.appendChild(label);

    xPos += 150;
  }

  // Resize main frame to fit
  main.resize(2400, yPos + 160);

  console.log('✅ Foundation frames created');
}

// ============================================================
// RUN EVERYTHING
// ============================================================
(async () => {
  console.log('🚀 Starting Workshopr Design System import...');
  console.log('');

  const colorCount = await createColorStyles();
  const textCount = await createTextStyles();
  await createFoundationFrames();

  console.log('');
  console.log('🎉 DONE!');
  console.log(`   ${colorCount} color styles`);
  console.log(`   ${textCount} text styles`);
  console.log(`   1 visual reference frame`);
  console.log('');
  console.log('💡 Check your Local Styles panel (right sidebar) for all styles.');
  console.log('💡 Zoom to fit (Ctrl/Cmd+1) to see the foundation reference frame.');

  figma.closePlugin();
})();
