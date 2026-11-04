# Workshopr Illustration Guidelines

> **Status:** Current · **Last updated:** July 2026
> **Canonical source:** this doc (reconciled toward the reference set in §18) · color tokens: `/design-system/platform-tokens.css`

The canonical, deep-dive companion to `/design-system/foundations/illustrations.php`. This doc covers the *why* and the *how* of every illustration that ships under the Workshopr brand — hero images, article covers, feature cards, DNA profiles, inline editorial spots, and AI-generated supplements.

If you're producing or commissioning an illustration, read this end-to-end before generating a single image. If you only have five minutes, read Section 1 (the one-paragraph identity), Section 4 (the prompt formula), and Section 14 (the QA checklist).

**Scope note:** This guide synthesizes the existing style spec at `/design-system/foundations/illustrations.php`, the platform color tokens at `/design-system/platform-tokens.css`, and direct observation of **five canonical reference illustrations** confirmed as on-brand originals (the reference set is described in detail in Section 18). Where the source images and the existing spec disagree, this guide reconciles toward the references.

---

## Contents

1. The visual identity in one paragraph · 2. Color palette · 3. Composition rules · 4. The base AI prompt formula · 5. Character design system · 6. Setting and environment · 7. Props and motifs · 8. Lighting and shadow · 9. Style references · 10. Article cover conventions · 11. Inline editorial spots · 12. Text in illustrations (the no-text rule) · 13. File specs, naming, and storage · 14. QA checklist · 15. When to commission vs. AI-generate · 16. The five-minute version · 17. Companion files · 18. The canonical reference set

---

## 1. The visual identity in one paragraph

A Workshopr illustration is a soft, flat, lightly-isometric digital painting in a warm peach-coral-cream world. The subject is almost always a workshop moment — a facilitator, a small group, a desk in mid-thought, an object that anchors an idea (a mug, a notebook, a stack of papers). The room is contemporary and warm: indoor light through an arched window, a round wall clock, plants in the foreground corners, a wooden round table or cream wall behind the subject. The **plants are themselves coral-pink, not green** — that is the most distinctive Workshopr visual signature, and it's what tells viewers "this is one of ours" before they read a word. Characters are diverse and friendly: simple oval faces, single-line smile, two dot eyes, no visible nose, hair as a flat dark shape, business-casual clothing in palette-matched coral and tan. Sometimes a character is rendered as a literal **paper-cutout person** — a stylistic device that turns participants into pieces of paper, used when the post is about facilitation roles, agendas, or participants-as-content. Generous negative space. No outlines. Soft drop shadows. The whole composition reads from across a room.

What it is not: a clip-art icon, a neon vector, a sharp-edged isometric scene with cool greys, a photoreal stock photo, a meme-style cartoon, a Memphis-pattern explosion of shapes, or anything with naturalistic green foliage. The Workshopr feel is *quiet coral warmth*, not *high-energy graphic design*.

---

## 2. Color palette

### 2.1 Primary illustration palette (mainsite / Learn phase)

**Important calibration note from the references:** The illustration world is *softer* than the mainsite UI palette. Workshopr UI uses a saturated brand red (`#E54D4D`), but the illustrations live one or two steps lighter — in the salmon, peach, and dusty-coral range. Using `#E54D4D` straight as a clothing or object fill in an illustration will look too hot. Pull from the table below.

| Role | Approximate hex | Where it shows up in the references |
|---|---|---|
| Salmon coral (primary) | `#E07B6B` | Lead character clothing, primary monstera leaves, focal accents |
| Soft coral | `#F09988` | Secondary clothing, paper-cutout characters, sticky notes |
| Dusty peach | `#F2B5A4` | Mid-tone surfaces, lighter clothing, palm fronds |
| Pale peach | `#FBE0D6` | Background washes, wall fills |
| Cream page | `#FCF5EE` | Default canvas, room walls |
| Cream warm | `#FAF4ED` (`--bg-page-warm`) | Immersive scene backgrounds |
| Warm wood | `#9C6F4E` | Wooden tables, desks, floors |
| Wood shadow | `#6F4A2F` | Darker wood grain, table edges |
| Hair / ink | `#2B1F18` | Hair, pupils, deepest accents |

The mainsite UI red `#E54D4D` and the `--mainsite-primary` token are still the brand color **in interface contexts** (buttons, links, accents on real pages). Illustrations sit in the warmer, softer companion palette above — same color *family*, lower saturation.

### 2.2 Supporting illustration colors (extended palette)

From the existing illustration spec — used for variety within the warm world:

| Role | Hex | Use |
|---|---|---|
| Terracotta (illustration) | `#C45C4B` | Deep object color, lead character clothing |
| Light terra | `#E07B6B` | Mid-warm objects, hair, secondary clothing |
| Cream | `#F5E6D3` | Paper, walls, lighter wooden surfaces |
| Tan | `#D4C4B0` | Wood grain, mid-toned surfaces |
| Warm brown | `#8B7355` | Wood grain darker tones, deeper shadows, hair |
| Soft gold | `#D4A574` | Accent on metals, frames, late-afternoon light |

### 2.3 Phase-color variants (when illustrating non-mainsite apps)

Since the **Red Unification (D1, July 2026)** every app shares the mainsite red family, so there is no per-app color swap anymore — all apps use the same primary:

| App | Primary | Light | Very-light |
|---|---|---|---|
| All apps (Mainsite, Library, Podcasts, Planner, Coach, Facilitator, Tips, DNA, Training, Academy) | `#E54D4D` | `#FEE2E2` | `#FEF2F2` |

The pre-unification per-app variants (Podcasts crimson `#BE123C`, Planner blue `#0284C7`, Coach/Tips purple `#7C4DFF`, DNA/Academy emerald `#10B981`) are **historical — do not use them in new illustrations.**

**Important:** the *background environment* — wall, floor, plants, secondary props — stays in the cream/peach/tan family. Only the focal subject's clothing and the primary accent objects carry the red-coral accent. This is what keeps a 25-image hero gallery feeling like one brand instead of a rainbow.

### 2.4 Colors to avoid

- **High-saturation primaries.** No traffic-light red `#FF0000`, no electric blue `#0066FF`, no kelly green `#00CC00`.
- **Cool greys.** No `#808080`. If you need a grey, use the warm-tinted `#8B7355` or a desaturated terracotta.
- **Pure black.** Use `--color-ink` (`#2C2416` from platform tokens — warm brown-black) for darkest hair / pupils / line accents. Pure `#000` reads cold and contemporary-corporate.
- **Pure white.** Use cream `#FFFBF8` or `#FEF7F1`. Pure white reads like a UI screenshot, not an illustration.
- **Neon, fluorescent, or jewel tones.** No magenta, no teal, no lime, no royal purple. The warmth is the brand.
- **Gradients with cool stops.** All gradients stay within the warm family.

---

## 3. Composition rules

### 3.1 The single focal subject

Every illustration has one clearly dominant subject occupying roughly the center 40-60% of the frame. Even group scenes have a single focal point (the facilitator at the front, the laptop on the desk, the central object on the table) that the eye lands on first.

Avoid: evenly weighted compositions where the eye doesn't know where to go.

### 3.2 Negative space is the brand

Workshopr illustrations breathe. Plan for roughly **30-45% of the canvas to be empty or near-empty background** — a wall, a floor, a tabletop with nothing on it, a sky equivalent. This is what gives the illustrations their calm, "moment caught" quality.

A frame packed with detail edge-to-edge is off-brand. If the AI generation produces a busy frame, regenerate or crop.

### 3.3 The coral-plant rule (the single most distinctive Workshopr visual)

**Monstera and palm leaves intrude from the corners of every illustration, and they are rendered in coral/salmon — never green.** This is the most recognizable Workshopr move. Across the five reference images, every single one has coral foliage; none has green.

The rules:

- **Color:** Coral / salmon (`#E07B6B`, `#F09988`, `#F2B5A4`) with subtle veining in a deeper coral. Never natural green. Never blue-tinted. Never grey.
- **Plane:** Foreground — in front of the main scene, slightly bleeding over the edges of the canvas
- **Crop:** Cut off at the canvas edge. You only see part of any leaf, never a full plant pushed in from the corner.
- **Plant types:** Monstera (the swiss-cheese plant — leaves with characteristic splits), broad palm fronds, fan palm leaves, occasional fern-like foliage. **Monstera is the default.**
- **Quantity:** 2-3 corners, rarely all 4. Most common pattern is bottom-left + bottom-right or top-left + bottom-right (diagonal).
- **Inside the scene:** A potted monstera (also coral-leafed) can appear as a midground element on the table or beside the subject. The potted plant gets a cream or peach planter, never terracotta-orange.

A Workshopr illustration without coral corner-plants is incomplete. This is the single check that separates "Workshopr" from "generic warm flat illustration."

### 3.4 Perspective

Two perspectives dominate:

- **3/4 isometric or near-isometric** for desk scenes, table scenes, and any composition where the room is the context (top-down at ~30° angle). The reference images of the desk-with-papers scene and the people-around-a-table scene are both in this view.
- **Direct front-facing or slight 3/4 portrait** for single-character scenes and the focal subject of group scenes.

Avoid: dramatic worm's-eye or bird's-eye perspectives. Avoid extreme one-point perspective with long converging lines. The voice is calm and observational, not cinematic.

### 3.5 Frame and aspect ratio defaults

| Use case | Aspect | Pixel dimensions | Notes |
|---|---|---|---|
| Substack / article cover (recommended) | 16:9 | 1456 × 819 | Substack's native sweet spot |
| Hero (homepage, landing) | 16:9 | 1920 × 1080 | Matches existing spec |
| Hero (alternate, taller) | 4:3 | 1440 × 1080 | When subject needs vertical room |
| Article card (legacy) | 5:7 portrait | 750 × 1050 | Existing spec — being phased toward 16:9 |
| Square social | 1:1 | 1200 × 1200 | LinkedIn, Instagram |
| Inline editorial spot | 16:9 or 1:1 | 1024 × 576 or 1024 × 1024 | Inside articles |
| OG / Twitter card | 1.91:1 | 1200 × 630 | Social preview |
| DNA profile hero | 16:9 | 1920 × 1080 | Same canvas as platform hero |

For any new article, default to 16:9 at 1456 × 819. Going from a 1:1 source to 16:9 by center-cropping loses the corner-plant motifs — better to generate at the target aspect.

---

## 4. The base AI prompt formula

Every generated illustration starts with the same skeleton. Only the **scene** swaps. This is the single highest-leverage rule in this guide — consistent prompt scaffolding is what made the existing corpus look like one body of work.

### 4.1 The formula (calibrated to the references)

```
Flat editorial illustration in a soft warm palette of salmon coral (#E07B6B), soft coral (#F09988), dusty peach (#F2B5A4), pale peach (#FBE0D6), cream (#FCF5EE), and warm wood brown (#9C6F4E). [SCENE: subject, action, setting]. Coral-pink monstera and palm leaves (NOT green — the foliage must be the same coral family as the rest of the palette) intruding from at least two corners of the canvas, cropped at the edges. A tall arched window on the left casts soft warm light diagonally into the scene. Wooden round or rounded-rectangular table where surfaces appear. Friendly stylized characters with simple oval faces, two small dot eyes, single-line smile, no visible nose, dark hair as flat solid shapes, business-casual clothing in coral or tan, diverse skin tones from warm tan to deep brown. Any paper, sticky note, card, or notebook shows two to five wavy horizontal lines representing text — never letters or words. No outlines, soft geometric shapes, soft drop shadows in warm coral (not black). Generous negative space — 30%+ of the canvas should be restful pale-peach background. Isometric or 3/4 perspective for scenes with a desk or table; head-on or slight 3/4 portrait for single characters. 1456 x 819 pixels, 16:9 aspect. No text, no letters, no logos, no readable words anywhere in the image. Style: warm editorial flat illustration in the manner of contemporary editorial product marketing, in the vein of Notion or Headspace brand illustrations but with consistently coral foliage and coral palette.
```

### 4.2 What goes in `[SCENE]`

Three sentences max. Use this template:

1. **Subject (who/what):** "A facilitator with curly dark hair and a terracotta sweater" or "An open laptop on a wooden desk"
2. **Action (what's happening):** "stands beside a whiteboard covered in sticky notes" or "with a steaming mug and three stacked papers"
3. **Setting / context (where):** "in a sunlit meeting room with a tall window" or "on a quiet morning kitchen table"

Avoid: long sensory paragraphs, metaphor language, adjective triplets. The base scaffold handles style — `[SCENE]` is just blocking.

### 4.3 Phase-color swap pattern

When the illustration is for a non-mainsite app, append:

```
The focal subject wears [PHASE PRIMARY] clothing as the dominant accent color. Background environment stays in the cream and warm-brown family.
```

Example:

```
The focal subject wears a red-coral (#E54D4D) sweater as the dominant accent color. Background environment stays in the cream and warm-brown family.
```

### 4.4 Generation tools (in order of preference)

1. **Google Gemini (Imagen 3 / Imagen 4)** — best at warm-palette consistency, follows long prompts well
2. **Midjourney v6+** — best for stylistic richness, needs `--style raw --ar 16:9` and explicit "no outlines, flat illustration"
3. **DALL-E 3 (ChatGPT or API)** — fastest, occasionally drifts to cooler palette; specify "warm peach palette only, no blue or cool tones"
4. **Adobe Firefly** — good fallback, integrated into the toolchain, sometimes adds unwanted texture grain

**Do not use:** Stable Diffusion base models without LoRAs — they will produce off-brand cooler illustration styles by default.

---

## 5. Character design system

### 5.1 Faces

- **Eyes:** Two small filled dots or short arcs, never with whites or pupils. Closed-arc "happy eye" for smiling, open dot for neutral.
- **Mouth:** A single curved line. Slight smile is the default. No teeth, no open mouth, no expressive shapes.
- **Nose:** Either omitted entirely or rendered as a small curved arc/bump. Never realistic.
- **Eyebrows:** Optional. Two short horizontal strokes if used; usually omitted.
- **Ears:** Suggested by hair silhouette, rarely drawn directly.
- **Cheeks:** Soft pink dot on the cheekbone is optional and adds warmth — use sparingly.

Compared to a realistic face, this is closer to a Notion/Headspace/Slack illustration than a Pixar character. Simple, kind, low-detail.

### 5.2 Hair

- **Color palette:** Warm brown `#8B7355`, deep coral/brick `#C73E3E`, sandy `#D4A574`, soft warm black `#292524`. Avoid yellow blonde, fire-engine red, or cool ash tones (`#1F2937`-style cool grays included — they're on the platform blacklist).
- **Texture:** Rendered as solid shapes with a single highlight curve, not strand-by-strand. A simple silhouette: bun, ponytail, short cut, curls. No anime spikes.
- **Diversity:** Show a full range of hair textures — coils, waves, locs, straight, cropped, voluminous. The corpus tends toward warm-toned hair regardless of skin tone, which keeps the palette unified.

### 5.3 Skin

- **Tones:** Use a range across the warm spectrum — soft peach, warm tan, deep brown. Never grey, never blue-tinted.
- **Shading:** A single soft shadow zone on the un-lit side (typically lower-right since light comes from upper-left). No multi-step gradient shading. No realistic skin texture.
- **Diversity:** Across any series of illustrations (a page, an article series, a landing page hero grid), the character set should visibly include multiple skin tones and ethnicities. Never a homogeneous cast.

### 5.4 Body proportions

- **Head-to-body ratio:** Roughly 1:5 to 1:6. Slightly taller-headed than realism, slightly more compact than chibi/anime.
- **Posture:** Slightly relaxed. Hands visible doing something specific (holding a marker, gesturing, on a laptop, with a mug). Avoid stiff hands-at-sides poses.
- **Body language:** Match the article's emotional register. The "facilitator freezes" article wants a hesitant posture, slight shoulder hunch. The "energizer in motion" article wants both hands up, mid-stride. Posture is the storytelling.

### 5.5 Clothing

- **Style:** Business casual, weekend smart-casual. Sweaters, knit tops, button-downs with rolled sleeves, jeans, simple pants, comfortable shoes. Never suits with ties (too corporate), never tank tops or anything beachy (off-context).
- **Colors:** Pull from the palette in Section 2. The focal character usually wears the primary terracotta. Secondary characters wear soft peach, tan, or warm brown.
- **Pattern:** Solid color is the default. Occasional simple stripe or color-block. No busy patterns, no logos.

### 5.6 Diversity standards

Every series of illustrations (an article series, a landing page set, the DNA profile gallery) must visibly include:

- A range of skin tones from soft peach to deep brown
- A range of hair textures including coils and locs
- A range of body sizes (not just thin)
- Visible age range (not just 25-35-year-olds)
- At least one character with a visible accessibility detail when appropriate (cane, glasses, etc.)
- Gender expression beyond binary defaults — pull from haircuts, posture, clothing variety

This is not optional. The DNA gallery in particular leads with this — see *Returning to the Stage Part 3* in the corpus, which directly references the facilitator with a cane after an injury.

---

## 6. Setting and environment

### 6.1 Indoor scenes (the default)

Most Workshopr illustrations are indoor scenes. Standard ingredients confirmed from the reference set:

- **Walls:** Pale peach or cream (`#FBE0D6` or `#FCF5EE`). Flat fields, no texture. Subtle vertical gradient is acceptable.
- **The arched window:** A tall arched opening (rounded top, flat sides) on the left side of the frame, with white/cream "light" pouring out of it. This is a recurring environmental signature — three of the five references include it. The arch usually doesn't show outside detail; it reads as pure soft light.
- **The wall clock:** A round wall clock with a coral rim and minimal face appears in desk scenes (image 3). Use sparingly as a focal anchor in scenes about time, prep, or process.
- **Light source:** From the arched window on the upper-left, casting soft diagonal light pools on the floor in a slightly desaturated peach. Light is always warm.
- **Floor / surface:** Wooden tabletop in warm brown (`#9C6F4E`), wooden floor, or simple cream surface. Wood grain is suggested with one or two slightly darker curving lines, not rendered in detail.
- **Plants:** Always coral plants per Section 3.3. In pots on the table or floor (cream/peach planter), in the foreground corners as monstera/palm intrusion, sometimes both at once.
- **Furniture:** Mid-century-adjacent. Round wooden tables, simple soft armchairs in pale peach, four-legged wooden desks. Tables are often **round** (image 4) or **rectangular with rounded corners** (image 1). Never sharp-edged corporate.
- **Clutter level:** Low. A desk has 3-5 carefully placed objects (mug, laptop, notebook, fanned papers, pen), not the chaos of a real desk.

### 6.2 Outdoor / abstract scenes (occasional)

Used when the metaphor requires it (a chef in a kitchen, kids at a backyard birthday party, a school auditorium). Same palette rules apply — terracotta, cream, warm brown. Outdoors might include sky as warm pink-cream, never blue.

### 6.3 The "no setting" abstract scene

For posts that introduce an idea or a tool, the scene can be a simple object — a laptop, a recipe card, a mug, a stack of papers — floating on a cream background with corner-plant intrusion. These are the most flexible compositions and the easiest to make consistent.

---

## 7. Props and motifs (the Workshopr object library)

A core set of objects shows up repeatedly. Use them. Their consistent presence is part of what makes the corpus feel like a coherent universe.

### 7.1 Always-in-stock (verified from references)

- **Coffee mug** — coral-pink mug (`#F09988`) with a steam wisp. Often holds dark coffee (almost black). The single most-used object in the corpus. Appears in all 5 references.
- **Laptop** — neutral grey-silver aluminum, slim profile, screen barely visible or shown closed. Apple-laptop silhouette is fine. Never colorful housings.
- **Sticky notes** — square coral, peach, or cream notes with **wavy horizontal lines** representing text (never letters). Often shown floating around a character (image 5) or stacked on a wall.
- **Papers / printouts** — stacked, fanned, or held in hand. Always with **wavy horizontal lines** representing text. Sometimes a colored dot row at the corner (image 1, 2). Never legible words.
- **Fountain pen** — coral or warm brown body, gold or coral nib, lying horizontally on the surface. The fountain pen is a recurring signature object — more common than ballpoint or marker in the references.
- **Notebook** — open, with wavy line marks suggesting handwriting. Sometimes shown closed with a colored cover.
- **Coral plants** — monstera (default), palm fronds, fan palms. See Section 3.3.
- **Stack of sticky notes / index cards** — a small stack with one peeking out, suggesting plenty more.

### 7.2 Context-specific

- **The round wall clock** — coral rim, cream face, minimal indicators. Anchor for time/prep/process scenes (image 3).
- **Floating sticky notes around a character** — used when the post is about ideation, capture, or thinking through a problem (image 5).
- **Profile / participant cards on a surface** — small rounded-rectangle cards each with a stylized avatar and color-coded badge. Used for posts about teams, rosters, casting (image 2).
- **Sketches on paper** (squiggle lines forming a loose abstract shape) — used when the post is about a workshop in progress, brainstorming, or visualizing (image 4).
- **Index cards stack** — for Intervention Cards content, "pre-read" or agenda articles.
- **Phone (face-down)** — used carefully; phones-up-on-table reads as disengaged participants.
- **Recipe card** — for posts about handoffs, family-recipe metaphors (*The PM Didn't Die*).
- **Cardstock program / pamphlet** — for posts about agendas, participant-facing artifacts (*Two Screens, One Workshop*).

### 7.3 The paper-cutout character motif

A distinctive Workshopr device: characters rendered as **animated paper cutouts** — flat torsos that look like pieces of folded paper with simple drawn-on faces, sometimes with three-dimensional limbs. Seen in:

- **Image 4:** Three participants around a table are rendered as cardboard-box-shaped people with paper-doll heads, while the two facilitators are rendered as normal humans. The visual contrast says "the workshop turns participants into paper, the facilitator stays human."
- **Image 5:** A character at a laptop is surrounded by three small paper-doll figures, each appearing to be cut from paper, with simple drawn faces.

Use the paper-cutout treatment for posts about:
- Facilitation roles or archetypes
- Participants-as-content (turning people into agenda items)
- Workshop deliverables that "become" the team

Don't use it for posts about genuine human moments, vulnerability, or interpersonal conflict — the paper-cutout reads as slightly comic and would undercut emotional weight.

### 7.4 Avoid

- **Stock business handshake**
- **Stock arrows pointing to growth charts**
- **Bullseye / target visuals** unless the article is literally about Bullseye Diagramming
- **Briefcases**
- **Suits and ties on every character**
- **Generic "team" silhouettes facing away**
- **Green plants of any kind** — this is the test. If a plant is green, the illustration is off-brand.

---

## 8. Lighting and shadow

### 8.1 Light source

- **Direction:** Upper-left, consistently across the corpus. This means shadows fall to the lower-right of objects.
- **Quality:** Soft and warm. Never harsh, never multi-directional, never theatrical.
- **Color temperature:** Warm — pulls subtle peach or cream into highlights. Never daylight-cool.

### 8.2 Shadows

- **Drop shadows:** Soft, low-opacity (20-35%), short distance, warm-toned (`#C73E3E` at low opacity, not `#000`). Every primary object should have a soft drop shadow grounding it.
- **Form shadows:** A single soft shadow zone on the un-lit side of each character/object. Not stepped, not gradient-heavy. Think two values: lit and shaded.
- **Cast shadows on the ground:** Optional. When used, very soft and short, blending into the background.

### 8.3 Highlights

- **Use sparingly.** A single highlight on the rim of a mug, the curve of a forehead, the corner of a laptop screen. Often just a slightly lighter wash of the base color rather than a contrasting bright spot.
- **No specular highlights** like on glossy plastic or metal. Everything reads as soft matte.

---

## 9. Style references

### 9.1 What we are like (study these)

- **Notion's brand illustrations** — for character simplicity and palette restraint
- **Headspace's app illustrations** — for warmth and the "calm moment" feel
- **The New York Times Cooking section illustrations** — for warm editorial mood
- **Substack's own marketing illustrations** — for relevance and tone (Workshopr lives on Substack)
- **Pencil & Paper Studio editorial work** — for soft modern flat
- **Behance: "warm flat illustration"** filtered to peach/coral palettes

### 9.2 What we are NOT like (avoid these aesthetics)

- **Corporate Memphis / Alegria** (the bendy-limb "big tech" style with neon palettes) — overused, dated, off-brand
- **Apple SF Symbols vibe** — too iconic / utilitarian
- **Slack's character style** — too cartoony, faces too detailed
- **Stripe's gradient mesh** — too techy
- **Old-school stock vector art** — Shutterstock briefcase guy energy
- **Anime / manga** — wrong cultural register for B2B SaaS
- **Pixar / 3D rendered** — too rich and slick for the calm editorial tone
- **Linocut / hand-drawn ink** — too crafty, not enough digital polish

---

## 10. Article cover conventions

### 10.1 What the cover does

The cover image is the first thing every reader sees. It does three jobs:

1. **Sets the tone** — warm, considered, human
2. **Hints at the metaphor** — if the article opens with mise en place, the cover features a wooden kitchen surface with diced onions. If the article opens with a family recipe, the cover features a handwritten recipe card.
3. **Stays out of the way** — the cover is supporting cast, not the show. Generous negative space, no embedded text, no shouty composition.

### 10.2 Cover composition checklist

- [ ] 16:9 aspect, 1456 × 819 px (Substack sweet spot)
- [ ] One clear focal subject in the center 60% of the frame
- [ ] Corner-plant intrusion on at least one corner
- [ ] Warm palette only (Section 2)
- [ ] Soft directional light from upper-left
- [ ] No embedded text or readable labels
- [ ] If a character is present, they're facing roughly toward the viewer or in 3/4
- [ ] 30%+ of the canvas is restful background

### 10.3 Cover-by-article-type defaults

| Article type | Cover treatment |
|---|---|
| Personal-story essay (most posts) | Scene from the opening anecdote (kitchen, desk, table) with relevant object as focal point |
| Framework / model post | Abstract: the named tool or object on a cream background with plants |
| Weekly Wrap | Loose desk/notebook composition with calendar or week-view feel |
| Podcast episode | Episode-specific scene, plus a small play-button or sound-wave motif in a corner |
| Tactical / how-to post | A facilitator mid-action with one specific prop (whiteboard, sticky notes, intervention cards) |
| Opinion / take | A single object or symbol that anchors the argument (a pan, a recipe card, an empty chair) |

---

## 11. Inline editorial spots

When an article needs a mid-article illustration (a section break, a callout visual), use:

- **Same palette as the cover.** Spots should not introduce new colors.
- **Smaller, simpler composition** — usually just one object or one character, on a near-empty background.
- **Square (1:1) or 16:9.** Avoid portrait orientation in editorial spots.
- **No corner plants** in spots. The cover gets the plants; spots are quieter.
- **One per ~800 words max.** Visual breaks should be earned, not decorative. The corpus mostly has cover-only articles, with longer pieces using one or two spots.

---

## 12. Text in illustrations (the no-text rule)

**No legible text in any illustration. Ever.**

This rule has one reason: AI-generated images render text poorly, producing the garbled-label look visible in several reference images (e.g., the cards in image 2 carrying labels like "$IBA4C7", "TICAEY", "MIEMOQ4" — these are pure AI gibberish that the brain can't quite read but can't quite ignore). Until image-gen models reliably render words, every Workshopr illustration must be text-free.

### The wavy-line convention (Workshopr's signature for "text exists")

The references settle on a single, consistent visual code for text: **two to five wavy horizontal lines of decreasing length**, drawn in a slightly darker tone than the paper. This appears on:

- Papers and printouts (image 1)
- Sticky notes (image 5)
- Cards and small papers held by characters (image 1, 5)
- Open notebook pages (image 3)

The wavy line is the only acceptable way to represent text in a Workshopr illustration. Don't use:

- Real letters (will render as AI gibberish)
- Lorem-ipsum-style straight horizontal bars (too austere, too techy)
- Dots or stippling (reads as code, not prose)
- Music-notation-style notes (reads as audio)

The wavy line is humble, hand-written, and unambiguous. Use it everywhere "text" needs to be implied.

### Other text-substitutes

- **Small filled rectangles** for buttons or labels
- **Single icon-style glyph** if the meaning needs to land (e.g., a star, a heart, a check, a cog, a search magnifier)
- **Colored circle dots** in a row of three (small visual rhythm device — see image 1, 2 where small dot rows appear on papers)

### When a logo or wordmark is required

If the illustration absolutely requires a logo or product wordmark, compose the wordmark in a graphic-design layer *over* the illustration after generation, not inside the prompt.

---

## 13. File specs, naming, and storage

### 13.1 Format

- **Default:** PNG-24 (with transparency support if needed)
- **For very flat illustrations without gradients:** SVG is acceptable when the illustration is composed of geometric shapes only — but the corpus is mostly raster, so default to PNG
- **For animated illustrations (DNA reveal, hero scrolling):** Encode as APNG or short MP4 with looping
- **Never:** GIF (palette degradation), BMP, TIFF, HEIC

### 13.2 Sizes per use case

Each illustration should be exported at three sizes for responsive delivery:

- `@1x` — the canonical size from Section 3.5 (e.g., 1456 × 819 for a cover)
- `@2x` — double resolution for retina (e.g., 2912 × 1638)
- `thumb` — small preview (e.g., 400 × 225 for a cover thumb)

### 13.3 Naming

```
{app}-{category}-{descriptive-slug}.png

Examples:
mainsite-hero-facilitator-coffee.png
planner-cover-agenda-builder.png
coach-spot-intervention-card.png
dna-hero-energizer.png
article-cover-2026-05-08-pre-read.png
```

Lowercase. Hyphens (not underscores). Date prefix on article covers in `YYYY-MM-DD` for sortability.

### 13.4 Storage locations

| Type | Path |
|---|---|
| App hero illustrations | `/images/hero/{app}-hero.png` |
| DNA profile heroes | `/images/dna/dna-{profile}-hero.png` |
| Article covers | `/content/substack/images/{date}_{slug}.png` |
| Inline editorial spots | `/content/articles/{date}_{slug}/images/{n}.png` |
| Design-system reference | `/design-system/illustration-samples/{descriptive-name}.png` |

### 13.5 Sourcing record

Each illustration must have a sourcing note recorded in a `sources.md` adjacent to the file or in the article's distribution doc:

```
Illustration: article-cover-2026-05-08-pre-read.png
Generator: Google Gemini Imagen 3
Date: 2026-05-08
Prompt: [paste full prompt used]
Iterations: 4 (selected #3)
Post-edit: cropped 5% from bottom; brightness +5
Approved by: Bill
```

This is what lets the next person reproduce the look, and what protects against the "great image but nobody remembers how we made it" problem.

---

## 14. QA checklist

Before any illustration ships, every box must be checked.

**Palette**
- [ ] Every color present is in the Section 2 palette (or a phase-color swap per 2.3)
- [ ] No cool greys, no pure black, no pure white, no neon, no jewel tones
- [ ] **No green** — every leaf and plant is coral/salmon, not green
- [ ] Coral tones are in the salmon/peach range, not the saturated `#E54D4D` UI red
- [ ] If for a non-mainsite app, focal subject uses that app's primary color; environment stays warm cream/tan

**Composition**
- [ ] One clear focal subject in center 40-60% of frame
- [ ] 30%+ of canvas is restful negative space
- [ ] **Coral monstera or palm leaves** intrude from at least two corners (for covers)
- [ ] Light source is consistently upper-left, warm-toned
- [ ] If an arched window appears, it's on the left side casting diagonal light
- [ ] Aspect ratio matches Section 3.5 spec for this use case

**Characters (if present)**
- [ ] Faces use simple eye/mouth/nose treatment per Section 5.1
- [ ] Skin tone fits the warm spectrum, not grey or blue
- [ ] Body language matches the article's emotional register
- [ ] Clothing in palette colors, no logos, no busy patterns
- [ ] If the page/article has multiple illustrations, the character set is visibly diverse across skin tone, hair texture, body size, age, and gender expression

**Setting**
- [ ] Indoor scene includes plants, wooden surface, and warm directional light
- [ ] No corporate-cubicle aesthetic, no stock-photo office
- [ ] Furniture and props pulled from Section 7 object library
- [ ] Clutter level is low — desks have 3-5 considered objects

**Text and rendering**
- [ ] No legible words anywhere in the image (no garbled AI text)
- [ ] Any "text" on paper, sticky notes, or cards is rendered as **wavy horizontal lines**, never letters
- [ ] No misshapen hands (regenerate or hand-fix if so)
- [ ] No floating disembodied limbs
- [ ] Drop shadows present and warm-toned, not black

**File**
- [ ] PNG-24, named per Section 13.3
- [ ] Three sizes exported (@1x, @2x, thumb)
- [ ] Sourcing record saved per Section 13.5

**Final read**
- [ ] At 20% zoom, the image still reads (no critical detail in the last 5% of the frame)
- [ ] Side-by-side with three other shipped Workshopr illustrations, this one looks like part of the same family
- [ ] If you cropped to 16:9, the focal subject and at least one corner plant survived

---

## 15. When to commission custom vs. AI-generate

| Scenario | Approach |
|---|---|
| Routine article cover | AI generate, use Section 4 formula |
| Weekly Wrap cover | AI generate, use a simpler "loose desk" scene |
| Inline editorial spot | AI generate, simpler composition |
| DNA profile hero (high-value, evergreen) | Commission custom illustrator, brief them with this guide |
| Homepage / landing page hero | Commission custom OR AI-generate with 10+ iterations and human polish |
| Marketing campaign (paid social, ads) | Commission custom; AI is for editorial, not advertising |
| Pitch deck / investor materials | Commission custom |
| Conference / event speaking visual | Commission custom |

The default is AI generate. Custom commissioning is reserved for evergreen, high-visibility, long-tail content where the cost-per-view amortizes.

---

## 16. The five-minute version

If you read nothing else, hold these five rules:

1. **The foliage is coral, not green.** This is the single most distinctive Workshopr move. Every monstera leaf, every palm frond, every potted plant is in the salmon-coral family. Green foliage = off-brand, no exceptions.
2. **Warm palette only.** Salmon, soft coral, peach, cream, warm wood brown. Never cool. Never neon. Lower saturation than the mainsite UI red.
3. **One focal subject + 30%+ empty space + corner-plant intrusion.** Generous negative space with coral leaves cropped at two corners. This is the canonical composition.
4. **Upper-left warm light, often through an arched window.** Soft diagonal light pool, warm-toned drop shadows.
5. **No text — only wavy lines.** Every paper, sticky note, card, or notebook shows wavy horizontal lines representing text. Never letters.

Get those right and a Workshopr illustration is recognizable from across the room. Get them wrong and it stops looking like part of the family, no matter how nice the individual image is.

---

## 17. Companion files

This guide is the canonical written spec. It pairs with:

- `/design-system/foundations/illustrations.php` — the live in-app reference page with the hero gallery and prompt template (use this for browsing existing assets)
- `/design-system/platform-tokens.css` — the source of truth for color hex values
- `/design-system/workshopr-design-system.json` — machine-readable design system summary
- `/design-system/apps/app-mainsite.php` — the mainsite-specific guide that covers the surrounding UI context

When this guide and any companion disagree, **this guide wins** for illustration questions. Update the others to match.

---

## 18. The canonical reference set

This guide is grounded in five originals confirmed by Bill as on-brand. Each is described in enough detail below that a generator (human or AI) can reproduce the family resemblance without ever seeing the source.

### Reference 1 — *"Two collaborators with stacked papers"* (16:9 landscape)

Isometric view of a rounded-rectangle wooden table from a slight 3/4 angle above. On the table: a stack of papers with wavy horizontal lines and three small colored dots in the top-right corner of the top sheet; a coral fountain pen lying horizontally; a coral coffee mug with steam rising at the top-right; a potted monstera in a cream planter at the top-left with five coral monstera leaves splayed out. Two characters stand on opposite sides of the table — both with dark hair, brown skin, coral sweaters, grey or coral pants, and small coral cards in their hands also bearing wavy lines and a small dot row. The character on the left wears grey pants, the one on the right wears coral pants. Background is pale cream. Two small coral palm leaves crop in at the bottom-left corner. The composition is clean, symmetric, and reads instantly as "two people compare notes."

**Use as template for:** Posts about collaboration, comparing approaches, peer review, "two perspectives" essays.

### Reference 2 — *"Eight participant cards on wood"* (1:1 square)

Top-down view of a warm brown wooden table with a subtle grain swirl. Arranged on the table are 8 small rounded-rectangle cards, each containing a stylized character avatar (head and shoulders, simple round face, dark hair, one of: coral hoodie, grey shirt with cogs over head, lab coat with shield-and-chat icons, etc.), a small colored dot in the bottom-right corner of the card, and a garbled AI-generated label in the top-right (the gibberish text artifact is the cautionary tale for the no-text rule). The central card is largest and shows a smiling person in a coral hoodie with cog icons. Coral monstera leaves intrude from the top-left, palm fronds from the bottom-left, more palm at bottom-right. Top-right has a pink mug with black coffee. Bottom-right has a coral fountain pen.

**Use as template for:** Roster/team scenes, "the cast," personality profiles, casting-the-team articles. Note: regenerate to fix the AI-text labels per Section 12.

### Reference 3 — *"Solo at desk with summary papers"* (1:1 square)

Isometric three-quarter view of a small warm-tinted room. A wooden desk holds an open laptop, fanned coral papers, a notebook with wavy line text, a coral mug with steam, and a small paper labeled "Summary" (another AI-text artifact — would be replaced by wavy lines). A character in a coral collared sweater with brown hair sits in a peach armchair behind the desk, holding the papers and looking down. A coral fountain pen rests on the notebook. Behind: a tall arched window on the left side of the frame casting a diagonal pool of cream light onto the floor; a round wall clock with coral rim mounted above the desk. Coral monstera and palm fronds intrude from the bottom-left and bottom-right corners. The whole scene is in a very limited palette — mostly soft coral and pale peach with one brown wood accent.

**Use as template for:** Posts about prep, synthesis, review, reading the room before you enter, the chef-tasting-air opener, mise-en-place pieces.

### Reference 4 — *"Five collaborators around a round table"* (1:1 square)

Isometric view of a small round white table seen from a low 3/4 angle. Around the table are five characters: three appear to be **paper-cutout / cardboard-box people** (flat torsos that look like folded paper with simple drawn faces), and two appear to be standard humans (one in a coral shoulder-bag-style sweater facing away, one in cream long-sleeves leaning in). On the table: a coral laptop, a coral mug, a cream mug, two small coral papers with squiggly sketches (suggesting workshop ideation), and two coral sticky notes. An arched window on the right side admits diagonal cream light. Coral monstera and palm fronds intrude from the bottom-left corner. The compositional point: the workshop turns participants into paper-doll stand-ins while the facilitators stay human.

**Use as template for:** Posts about facilitation roles, participants-as-content, team archetypes, workshop dynamics where people get "flattened" or simplified.

### Reference 5 — *"Founder at desk with floating sticky notes and paper figures"* (1:1 square)

Front-facing view of a brown-haired character in a coral knit sweater sitting at a wooden desk. On the desk: a slim silver laptop (open, with a small white Apple-style logo), a coral mug with subtle steam, a small notebook, a coral pen lying across it. Around the character's head, three small coral sticky notes float in mid-air with wavy line text. To the right of the laptop, three small **paper-doll figures** (full body cutouts that look like animated paper, one with a topknot and dress, two in shirts, all with simple faces and one small badge dot) stand on the desk surface like little participants. Coral monstera leaves intrude from the bottom-left, palm fronds from the bottom-right. Background is pale cream — about 45% of the canvas is restful empty space above the subject. The character smiles toward the viewer.

**Use as template for:** Posts about building, ideating, founder/creator moments, planning, "founders at work," posts where the writer is in the picture.

### Patterns to lift from this set

- All five use the same coral-cream-wood palette
- All five include coral foliage in at least two corners
- All five include a coffee mug
- All five use wavy lines (or AI-garbled stand-ins for them) as the text convention
- Three of five include the arched window
- Two of five use the paper-cutout character device
- One of five (Reference 1) is already 16:9 — the others are 1:1 and would crop / regenerate to 16:9 for editorial use

---

*Version: 2026-05-24. Created to address the gap between the existing illustration page (which has the palette and a base prompt) and the day-to-day questions that come up when generating new illustrations (composition, character system, motifs, QA). Revised same day after a canonical five-image reference set was confirmed. Lives at `/design-system/docs/illustration-guidelines.md`. Linked from `/design-system/foundations/illustrations.php` and from the project root CLAUDE.md once that link is added.*
