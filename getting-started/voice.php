<?php
$ds_page  = 'getting-started/voice';
$ds_title = 'Voice & Tone';

require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>Voice & Tone</h1>
    <p>How we write at Workshopr. Expert, personal, immediately actionable—and unmistakably human.</p>
</div>

<div style="margin: 0 0 28px; padding: 14px 18px; border-left: 3px solid var(--color-ink, #2C2416); background: var(--bg-page-alt, #FFFBF8); border-radius: 8px; font-size: 14px; line-height: 1.6; color: var(--color-ink-secondary, #57534E);">
    <strong>Canonical source:</strong> <code>/DESIGN.md</code> &sect;4&ndash;6 is the single source of truth for Workshopr's voice and writing style. This page is an illustrative reference &mdash; if it ever conflicts with <code>DESIGN.md</code>, <code>DESIGN.md</code> wins. See <code>/design-system/START-HERE.md</code> for the full source-of-truth hierarchy.
</div>

<!-- Brand Voice -->
<section class="ds-section">
    <h2 class="ds-section-title">Brand voice</h2>
    <p class="ds-section-desc">We sound like a trusted senior colleague sharing what they've learned over coffee—not from a podium.</p>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>We sound like</strong>
            A practitioner with 15+ years in the trenches. Direct. Opinionated. Helpful.
        </div>
        <div class="ds-dont">
            <strong>We don't sound like</strong>
            An academic textbook, a motivational speaker, a corporate training manual, or ChatGPT.
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Voice attributes</div>
        <table class="ds-table">
            <thead>
                <tr>
                    <th>Attribute</th>
                    <th>Guideline</th>
                    <th>Example</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Authority</strong></td>
                    <td>Speak as a practitioner. Don't hedge. Own your positions.</td>
                    <td>"This is absolutely critical." "Here's what actually works."</td>
                </tr>
                <tr>
                    <td><strong>The Hook</strong></td>
                    <td>Every piece opens with a personal, non-design anecdote that becomes the metaphor for the business topic.</td>
                    <td>Fleetwood Mac lineup &rarr; team composition. The Stagg Kettle &rarr; useful, usable, beautiful. Dinner with a chef &rarr; staging. Miles Davis &rarr; productive silence.</td>
                </tr>
                <tr>
                    <td><strong>Metaphorical Language</strong></td>
                    <td>Simplify complex concepts through strong, memorable analogies. Carry them through the entire piece&mdash;don't grab a new one at the end.</td>
                    <td>Gardening (Rose, Thorn, Bud). Orchestra conductor (facilitation). Super Group (team dynamics).</td>
                </tr>
                <tr>
                    <td><strong>Direct & Actionable</strong></td>
                    <td>No academic filler. Every section should convert to something the reader can do Monday morning.</td>
                    <td>"Draw three symbols on your whiteboard. Give your team five minutes."</td>
                </tr>
                <tr>
                    <td><strong>Personal</strong></td>
                    <td>Use first person. Share real stories, real mistakes, real uncertainty.</td>
                    <td>"I screwed this up last month." "I'm still figuring this out."</td>
                </tr>
                <tr>
                    <td><strong>Non-judgmental</strong></td>
                    <td>Frame challenges as information, not failures. Create psychological safety even in the writing.</td>
                    <td>"What thorns did we encounter?" not "What went wrong?"</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Brand voice details</div>
        <div class="ds-grid-2">
            <div class="ds-card">
                <div style="font-weight: 600; margin-bottom: 12px; color: #166534;">We use humor</div>
                <p style="margin: 0; color: #57534E; font-size: 14px;">Dry observations, self-deprecating asides, light sarcasm about industry trends.</p>
            </div>
            <div class="ds-card">
                <div style="font-weight: 600; margin-bottom: 12px; color: #991B1B;">We don't use</div>
                <p style="margin: 0; color: #57534E; font-size: 14px;">Forced jokes, memes, or anything that feels try-hard.</p>
            </div>
        </div>
        <div class="ds-grid-2" style="margin-top: 16px;">
            <div class="ds-card">
                <div style="font-weight: 600; margin-bottom: 12px; color: #166534;">We cite</div>
                <p style="margin: 0; color: #57534E; font-size: 14px;">Bren&eacute; Brown, Amy Edmondson, personal client stories, specific failures and wins.</p>
            </div>
            <div class="ds-card">
                <div style="font-weight: 600; margin-bottom: 12px; color: #991B1B;">We don't cite</div>
                <p style="margin: 0; color: #57534E; font-size: 14px;">Generic business books, buzzwords without substance, trendy frameworks without proof.</p>
            </div>
        </div>
    </div>
</section>

<!-- Core Beliefs -->
<section class="ds-section">
    <h2 class="ds-section-title">Core thematic beliefs</h2>
    <p class="ds-section-desc">All content reinforces these five convictions. They're the backbone of everything we write.</p>

    <div class="ds-card">
        <table class="ds-table" style="margin: 0;">
            <thead>
                <tr>
                    <th style="width: 220px;">Belief</th>
                    <th>What It Means</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Influence is the goal</strong></td>
                    <td>Design maturity means moving from project delivery to systemic organizational influence.</td>
                </tr>
                <tr>
                    <td><strong>Rituals define culture</strong></td>
                    <td>Consistent practices create predictability and psychological safety.</td>
                </tr>
                <tr>
                    <td><strong>Problems are information</strong></td>
                    <td>Every thorn reveals a bud. Challenges are data, not failures.</td>
                </tr>
                <tr>
                    <td><strong>Scaling requires structure</strong></td>
                    <td>Growth must be intentional&mdash;hiring, process, culture preservation.</td>
                </tr>
                <tr>
                    <td><strong>Design is business strategy</strong></td>
                    <td>Prove value through ROI, retention, efficiency&mdash;not just "good UX."</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<!-- Article structure -->
<section class="ds-section">
    <h2 class="ds-section-title">Article structure</h2>
    <p class="ds-section-desc">Every article follows this six-part arc. The hook carries through to the close.</p>

    <div class="ds-card">
        <div style="display: flex; flex-direction: column; gap: 0;">
            <div style="display: flex; gap: 16px; padding: 16px; border-bottom: 1px solid #E7E5E4;">
                <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--mainsite-gradient, linear-gradient(135deg, #E54D4D, #C73E3E)); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 14px; flex-shrink: 0;">1</div>
                <div>
                    <div style="font-weight: 600; color: #2C2416;">Hook & Tension</div>
                    <div style="color: #57534E; font-size: 14px; margin-top: 4px;">Open with the personal anecdote, then state the universal problem it illuminates.</div>
                </div>
            </div>
            <div style="display: flex; gap: 16px; padding: 16px; border-bottom: 1px solid #E7E5E4;">
                <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--mainsite-gradient, linear-gradient(135deg, #E54D4D, #C73E3E)); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 14px; flex-shrink: 0;">2</div>
                <div>
                    <div style="font-weight: 600; color: #2C2416;">Framework / Model</div>
                    <div style="color: #57534E; font-size: 14px; margin-top: 4px;">Introduce your core concept (RTB, Maturity Model, etc.).</div>
                </div>
            </div>
            <div style="display: flex; gap: 16px; padding: 16px; border-bottom: 1px solid #E7E5E4;">
                <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--mainsite-gradient, linear-gradient(135deg, #E54D4D, #C73E3E)); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 14px; flex-shrink: 0;">3</div>
                <div>
                    <div style="font-weight: 600; color: #2C2416;">Actionable Breakdown</div>
                    <div style="color: #57534E; font-size: 14px; margin-top: 4px;">The bulk. Break the framework into phases or components with concrete examples from real work.</div>
                </div>
            </div>
            <div style="display: flex; gap: 16px; padding: 16px; border-bottom: 1px solid #E7E5E4;">
                <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--mainsite-gradient, linear-gradient(135deg, #E54D4D, #C73E3E)); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 14px; flex-shrink: 0;">4</div>
                <div>
                    <div style="font-weight: 600; color: #2C2416;">The "Why"</div>
                    <div style="color: #57534E; font-size: 14px; margin-top: 4px;">Explain the deeper reason it works&mdash;the psychology, the mechanism, the underlying principle.</div>
                </div>
            </div>
            <div style="display: flex; gap: 16px; padding: 16px; border-bottom: 1px solid #E7E5E4;">
                <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--mainsite-gradient, linear-gradient(135deg, #E54D4D, #C73E3E)); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 14px; flex-shrink: 0;">5</div>
                <div>
                    <div style="font-weight: 600; color: #2C2416;">Measurement</div>
                    <div style="color: #57534E; font-size: 14px; margin-top: 4px;">Tie it to outcomes. Specific ratios where possible. Numbers beat vague claims.</div>
                </div>
            </div>
            <div style="display: flex; gap: 16px; padding: 16px;">
                <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--mainsite-gradient, linear-gradient(135deg, #E54D4D, #C73E3E)); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 14px; flex-shrink: 0;">6</div>
                <div>
                    <div style="font-weight: 600; color: #2C2416;">Challenge</div>
                    <div style="color: #57534E; font-size: 14px; margin-top: 4px;">End with a strong, simple call to action. One thing they can try immediately. No summary.</div>
                </div>
            </div>
        </div>
    </div>

    <div class="ds-note" style="margin-top: 16px;">
        <span class="material-symbols-outlined">lightbulb</span>
        <div>The opening metaphor should return in the close. Don't grab a new one at the end&mdash;tie the story back together.</div>
    </div>
</section>

<!-- Content type variations -->
<section class="ds-section">
    <h2 class="ds-section-title">Content type variations</h2>
    <p class="ds-section-desc">Same voice, different formats. Each content type has its own specs.</p>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Articles (Substack / Blog)</div>
        <div class="ds-card">
            <table class="ds-table" style="margin: 0;">
                <tbody>
                    <tr><td style="width: 140px;"><strong>Length</strong></td><td>1,200&ndash;2,000 words typically</td></tr>
                    <tr><td><strong>Structure</strong></td><td>Hook &rarr; Framework &rarr; Breakdown &rarr; Why &rarr; Pitfalls &rarr; Measurement &rarr; Challenge</td></tr>
                    <tr><td><strong>Tone</strong></td><td>Conversational but slightly more formal than podcast</td></tr>
                    <tr><td><strong>Formatting</strong></td><td>Bold for key terms, headers for clear sections, occasional bullet lists</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Podcast scripts</div>
        <div class="ds-card">
            <table class="ds-table" style="margin: 0;">
                <tbody>
                    <tr><td style="width: 140px;"><strong>Length</strong></td><td>14&ndash;25 min (sweet spot: 20 min). 3,500&ndash;5,000 words.</td></tr>
                    <tr><td><strong>Structure</strong></td><td>Segmented with clear markers (SEGMENT 1, 2, etc.)</td></tr>
                    <tr><td><strong>Interaction</strong></td><td>Host/co-host dynamic&mdash;questions drive narrative, not monologues</td></tr>
                    <tr><td><strong>Production</strong></td><td>Include [PAUSE], [SFX], music cues, chapter markers</td></tr>
                    <tr><td><strong>Energy</strong></td><td>High open &rarr; vulnerability at POV moments &rarr; confident send-off</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Workshop instructions</div>
        <div class="ds-card">
            <table class="ds-table" style="margin: 0;">
                <tbody>
                    <tr><td style="width: 140px;"><strong>Clarity</strong></td><td>Step-by-step, numbered instructions</td></tr>
                    <tr><td><strong>Specificity</strong></td><td>Exact timing, materials, participant count</td></tr>
                    <tr><td><strong>Rationale</strong></td><td>Always explain the "why" behind each step</td></tr>
                    <tr><td><strong>Tips</strong></td><td>Anticipate what can go wrong, provide recovery tactics</td></tr>
                    <tr><td><strong>Variations</strong></td><td>Offer alternatives for different contexts and team maturity levels</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Measurement -->
<section class="ds-section">
    <h2 class="ds-section-title">Measurement & metrics in writing</h2>
    <p class="ds-section-desc">Use real numbers. Vague claims undermine authority.</p>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Specific (do this)</strong>
            "User satisfaction scores jumped 30%."<br>
            "Healthy RTB sessions settle around 60% roses, 40% thorns."<br>
            "Target 20&ndash;30% bud conversion rate into actual initiatives."
        </div>
        <div class="ds-dont">
            <strong>Vague (not this)</strong>
            "User satisfaction improved significantly."<br>
            "The results were impressive."<br>
            "It had a positive impact on the team."
        </div>
    </div>

    <div class="ds-note" style="margin-top: 16px;">
        <span class="material-symbols-outlined">lightbulb</span>
        <div>Quote specific numbers from real projects when possible. Even rough numbers ("about 30%") beat generic qualifiers ("significantly," "dramatically").</div>
    </div>
</section>

<!-- Writing principles -->
<section class="ds-section">
    <h2 class="ds-section-title">Writing principles</h2>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Be direct and concise</div>
        <div class="ds-card">
            <p style="margin-bottom: 16px;">Get to the point. Cut padding. Write the way you'd speak in a casual conversation.</p>
            <div class="ds-do-dont" style="margin: 0;">
                <div class="ds-do">
                    <strong>Do</strong>
                    "Email me the draft tomorrow."<br>
                    "The event starts at 10 a.m."<br>
                    "Can you edit this blog post?"
                </div>
                <div class="ds-dont">
                    <strong>Don't</strong>
                    "I wanted to reach out and see if you might be able to..."<br>
                    "Allow me to elucidate the process."<br>
                    "Can you facilitate the editing of this blog post?"
                </div>
            </div>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Use simple language</div>
        <div class="ds-card">
            <table class="ds-table" style="margin: 0;">
                <thead>
                    <tr>
                        <th>Instead of</th>
                        <th>Write</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Utilize</td><td>Use</td></tr>
                    <tr><td>Commence</td><td>Start</td></tr>
                    <tr><td>Finalize</td><td>Finish</td></tr>
                    <tr><td>Facilitate</td><td>Help / Run / Lead</td></tr>
                    <tr><td>Optimize</td><td>Improve</td></tr>
                    <tr><td>Implement</td><td>Do / Build / Start</td></tr>
                    <tr><td>In order to</td><td>To</td></tr>
                    <tr><td>Due to the fact that</td><td>Because</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Eliminate fluff</div>
        <div class="ds-card">
            <table class="ds-table" style="margin: 0;">
                <thead>
                    <tr>
                        <th>Fluffy</th>
                        <th>Direct</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>"We successfully submitted the comprehensive report."</td><td>"We submitted the report."</td></tr>
                    <tr><td>"The incredibly talented team completely finished the highly complex project."</td><td>"The team finished the project."</td></tr>
                    <tr><td>"I would like to kindly request that you..."</td><td>"Please..."</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Be honest and authentic</div>
        <div class="ds-card">
            <p style="margin-bottom: 12px;">Write truthfully, even when it's not perfect. Have opinions. Acknowledge complexity.</p>
            <ul style="margin: 0; padding-left: 20px; color: #57534E;">
                <li style="margin-bottom: 8px;">"I think this might work, but let's test it first."</li>
                <li style="margin-bottom: 8px;">"Honestly, I'm unsure about this approach."</li>
                <li style="margin-bottom: 8px;">"I've tried this both ways. Neither is perfect."</li>
                <li>"This is impressive but also kind of unsettling."</li>
            </ul>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Vary your rhythm</div>
        <div class="ds-card">
            <p style="margin-bottom: 12px;">Mix it up. Short punchy sentences. Then longer ones that take their time getting where they're going.</p>
            <ul style="margin: 0; padding-left: 20px; color: #57534E;">
                <li style="margin-bottom: 8px;">It's fine to start sentences with conjunctions</li>
                <li style="margin-bottom: 8px;">It's fine to end sentences with prepositions</li>
                <li style="margin-bottom: 8px;">It's fine to use fragments for emphasis. Like this.</li>
                <li>Contractions make writing warmer (it's, don't, you'll, I've, we're)</li>
            </ul>
        </div>
    </div>
</section>

<!-- Banned words -->
<section class="ds-section">
    <h2 class="ds-section-title">Banned words & phrases</h2>
    <p class="ds-section-desc">These signal AI-generated or generic marketing content. Never use them.</p>

    <div class="ds-grid-2">
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 12px; color: #991B1B;">Buzzwords</div>
            <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                <code>dive in</code>
                <code>deep dive</code>
                <code>unlock</code>
                <code>leverage</code>
                <code>navigate</code>
                <code>landscape</code>
                <code>robust</code>
                <code>fostering</code>
                <code>delve</code>
                <code>elevate</code>
                <code>streamline</code>
                <code>seamless</code>
                <code>holistic</code>
                <code>synergy</code>
                <code>harness</code>
                <code>empower</code>
                <code>impactful</code>
            </div>
        </div>
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 12px; color: #991B1B;">Hype phrases</div>
            <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                <code>cutting-edge</code>
                <code>best-in-class</code>
                <code>world-class</code>
                <code>groundbreaking</code>
                <code>revolutionary</code>
                <code>transformative</code>
                <code>game-changing</code>
                <code>next-generation</code>
                <code>state-of-the-art</code>
                <code>paradigm shift</code>
                <code>industry-leading</code>
                <code>supercharge</code>
            </div>
        </div>
    </div>

    <div class="ds-grid-2" style="margin-top: 16px;">
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 12px; color: #991B1B;">Filler phrases</div>
            <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                <code>at the end of the day</code>
                <code>in today's fast-paced world</code>
                <code>it's important to note</code>
                <code>it goes without saying</code>
                <code>moving forward</code>
                <code>at its core</code>
                <code>this is where the magic happens</code>
                <code>in order to</code>
                <code>due to the fact that</code>
                <code>needless to say</code>
                <code>it's worth noting</code>
            </div>
        </div>
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 12px; color: #991B1B;">Hedge words</div>
            <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                <code>I think / I believe</code>
                <code>somewhat / fairly</code>
                <code>kind of / sort of</code>
                <code>it could be argued</code>
                <code>some might say</code>
                <code>it seems like</code>
                <code>there's a possibility</code>
                <code>maybe / perhaps</code>
            </div>
        </div>
    </div>
</section>

<!-- AI patterns to avoid -->
<section class="ds-section">
    <h2 class="ds-section-title">AI patterns to avoid</h2>
    <p class="ds-section-desc">AI-generated content has recognizable patterns. Here's how to sound human instead.</p>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Structure patterns</div>
        <table class="ds-table">
            <thead>
                <tr>
                    <th>AI pattern</th>
                    <th>Human alternative</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Identical parallel structures (every section has exactly 4 bullets)</td>
                    <td>Vary rhythm. One section gets three short points, another gets two long paragraphs.</td>
                </tr>
                <tr>
                    <td>Numbered frameworks with branded names ("The 5 Pillars of...")</td>
                    <td>Just describe the thing. If it's voice, posture, and eyes&mdash;call them that.</td>
                </tr>
                <tr>
                    <td>Pristine percentages that add up perfectly</td>
                    <td>Acknowledge messiness: "These aren't equal slices. Some days I barely synthesize at all."</td>
                </tr>
                <tr>
                    <td>Every section ends with a summary</td>
                    <td>Let some sections just end. Trust the reader.</td>
                </tr>
                <tr>
                    <td>Headers that telegraph exactly what follows ("Key Takeaways")</td>
                    <td>Headers can be intriguing, incomplete, or conversational.</td>
                </tr>
                <tr>
                    <td>Always three examples (rule of three)</td>
                    <td>Sometimes one example is enough. Sometimes you need five.</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Voice patterns</div>
        <table class="ds-table">
            <thead>
                <tr>
                    <th>AI pattern</th>
                    <th>Human alternative</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Vague authority ("Studies suggest," "Experts agree")</td>
                    <td>Either cite specifically or own it: "I've seen this play out dozens of times."</td>
                </tr>
                <tr>
                    <td>Manufactured sensory language ("the hum of markers racing across whiteboards")</td>
                    <td>Sensory details should come from actual memory. If you can't remember the moment, cut the detail.</td>
                </tr>
                <tr>
                    <td>Polished aphorisms ("The silence is where meaning lives")</td>
                    <td>Rough it up: "Silence is where the actual thinking happens&mdash;if you don't kill it first."</td>
                </tr>
                <tr>
                    <td>Relentlessly positive framing</td>
                    <td>Have opinions. Some things are just bad. Say so.</td>
                </tr>
                <tr>
                    <td>Examples that feel like scenarios ("Imagine a team that...")</td>
                    <td>Specific stories: "Last month, I walked into what I thought was a strategy session..."</td>
                </tr>
                <tr>
                    <td>Perfect confidence throughout</td>
                    <td>Real expertise includes uncertainty: "This one's harder&mdash;I'm still figuring it out."</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Sentence-level tells</div>
        <table class="ds-table">
            <thead>
                <tr>
                    <th>AI pattern</th>
                    <th>Human alternative</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Every sentence grammatically complete</td>
                    <td>Use fragments. "Not always. But often enough."</td>
                </tr>
                <tr>
                    <td>Smooth transitions between every paragraph</td>
                    <td>Sometimes you just move to the next thing.</td>
                </tr>
                <tr>
                    <td>Consistent sentence length</td>
                    <td>Mix short punches with longer, more complex sentences.</td>
                </tr>
                <tr>
                    <td>Passive voice to avoid ownership</td>
                    <td>Active voice, first person: "I told them X. It was wrong."</td>
                </tr>
                <tr>
                    <td>Lists that all start the same way</td>
                    <td>Vary your list structure. Not every item needs parallel construction.</td>
                </tr>
                <tr>
                    <td>Excessive use of colons and semicolons</td>
                    <td>Break into separate sentences or use periods.</td>
                </tr>
                <tr>
                    <td>New metaphor introduced in the conclusion</td>
                    <td>The opening metaphor should carry through or return at the end.</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Word-level patterns</div>
        <div class="ds-card">
            <p style="margin-bottom: 16px; font-weight: 500;">High-frequency AI vocabulary to avoid:</p>
            <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                <code>Additionally</code>
                <code>Crucial</code>
                <code>Delve</code>
                <code>Emphasizing</code>
                <code>Enduring</code>
                <code>Enhance</code>
                <code>Fostering</code>
                <code>Garner</code>
                <code>Highlight</code>
                <code>Interplay</code>
                <code>Intricate</code>
                <code>Pivotal</code>
                <code>Showcase</code>
                <code>Tapestry</code>
                <code>Testament</code>
                <code>Underscore</code>
                <code>Vibrant</code>
            </div>
        </div>

        <div class="ds-card" style="margin-top: 16px;">
            <p style="margin-bottom: 16px; font-weight: 500;">Use simple verbs instead of elaborate constructions:</p>
            <table class="ds-table" style="margin: 0;">
                <thead>
                    <tr>
                        <th>Instead of</th>
                        <th>Write</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>serves as / stands as</td><td>is</td></tr>
                    <tr><td>boasts / features / offers</td><td>has</td></tr>
                    <tr><td>marks / represents</td><td>is</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Examples -->
<section class="ds-section">
    <h2 class="ds-section-title">Before & after</h2>
    <p class="ds-section-desc">See the difference between generic and human writing.</p>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Soulless vs. human</div>
        <div class="ds-do-dont">
            <div class="ds-dont">
                <strong>Before (clean but soulless)</strong>
                The workshop produced interesting results. Participants generated 47 ideas. Some stakeholders were impressed while others were skeptical. The implications remain unclear.
            </div>
            <div class="ds-do">
                <strong>After (has a pulse)</strong>
                I genuinely don't know how to feel about this one. 47 ideas in 90 minutes, most of them from people who'd never spoken up in a meeting before. Half the leadership team is raving, half are asking if we "really need" another workshop. The truth is probably somewhere boring in the middle&mdash;but I keep thinking about the quiet product manager who wouldn't stop writing on sticky notes.
            </div>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">AI-sounding vs. direct</div>
        <div class="ds-do-dont">
            <div class="ds-dont">
                <strong>Before (AI-sounding)</strong>
                The new software update serves as a testament to the company's commitment to innovation. Moreover, it provides a seamless, intuitive, and powerful user experience&mdash;ensuring that users can accomplish their goals efficiently. It's not just an update, it's a revolution in how we think about productivity.
            </div>
            <div class="ds-do">
                <strong>After (humanized)</strong>
                The software update adds batch processing, keyboard shortcuts, and offline mode. Early feedback from beta testers has been positive, with most reporting faster task completion.
            </div>
        </div>
    </div>
</section>

<!-- Podcast Voice & Tone -->
<section class="ds-section">
    <h2 class="ds-section-title" style="display: flex; align-items: center; gap: 10px;">
        <span style="width: 12px; height: 12px; background: #BE123C; border-radius: 4px;"></span>
        Podcast Voice & Tone
    </h2>
    <p class="ds-section-desc">The Workshopr Podcast brings the writing voice to life through two hosts&mdash;conversational expertise that sounds like colleagues figuring things out together.</p>

    <div class="ds-subsection">
        <div class="ds-subsection-title">The Format</div>
        <div class="ds-card">
            <table class="ds-table" style="margin: 0;">
                <tbody>
                    <tr><td style="width: 140px;"><strong>Length</strong></td><td>20&ndash;35 minutes (sweet spot: 30 min). 3,500&ndash;5,000 words.</td></tr>
                    <tr><td><strong>Host</strong></td><td>Bill &mdash; Expert/Primary (15+ years facilitation experience)</td></tr>
                    <tr><td><strong>Co-Host</strong></td><td>Sarah &mdash; Practitioner/Question-Asker (represents the listener)</td></tr>
                    <tr><td><strong>Style</strong></td><td>Conversational deep-dive, not interview</td></tr>
                    <tr><td><strong>Episode types</strong></td><td>Deep-Dive (standard), Exercise Spotlight, Problem/Solution, Introduction/Trailer</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">The Two Voices</div>
        <div class="ds-grid-2">
            <div class="ds-card">
                <div style="font-weight: 600; margin-bottom: 12px; color: #1A2744;">Bill: The Experienced Practitioner</div>
                <ul style="margin: 0; padding-left: 20px; color: #57534E; font-size: 14px;">
                    <li style="margin-bottom: 6px;"><strong>Authority</strong> &mdash; States positions directly. "Here's what actually works."</li>
                    <li style="margin-bottom: 6px;"><strong>Storytelling</strong> &mdash; Opens with personal anecdotes, real failures, real wins</li>
                    <li style="margin-bottom: 6px;"><strong>Vulnerability</strong> &mdash; Admits mistakes freely. "I screwed this up at Autodesk."</li>
                    <li><strong>Challenge</strong> &mdash; Pushes back on orthodoxy. "Dot voting is broken."</li>
                </ul>
            </div>
            <div class="ds-card">
                <div style="font-weight: 600; margin-bottom: 12px; color: #1A2744;">Sarah: The Smart Practitioner</div>
                <ul style="margin: 0; padding-left: 20px; color: #57534E; font-size: 14px;">
                    <li style="margin-bottom: 6px;"><strong>Clarification</strong> &mdash; "Wait, what do you mean by that?"</li>
                    <li style="margin-bottom: 6px;"><strong>Challenge</strong> &mdash; "But what about when X happens?"</li>
                    <li style="margin-bottom: 6px;"><strong>Synthesis</strong> &mdash; "So what you're saying is..."</li>
                    <li><strong>Practitioner lens</strong> &mdash; "How would I use this Monday morning?"</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Energy Arc</div>
        <div class="ds-card">
            <div style="display: flex; gap: 4px; align-items: flex-end; height: 80px; margin-bottom: 16px;">
                <div style="flex: 1; background: #FECDD3; border-radius: 4px 4px 0 0; height: 90%;" title="Cold Open: High energy"></div>
                <div style="flex: 1; background: #FECDD3; border-radius: 4px 4px 0 0; height: 70%;" title="Context: Setting the scene"></div>
                <div style="flex: 1; background: #FECDD3; border-radius: 4px 4px 0 0; height: 80%;" title="Core Discussion: Building"></div>
                <div style="flex: 1; background: #BE123C; border-radius: 4px 4px 0 0; height: 50%;" title="POV Moments: Vulnerability"></div>
                <div style="flex: 1; background: #FECDD3; border-radius: 4px 4px 0 0; height: 75%;" title="Practical Application"></div>
                <div style="flex: 1; background: #FECDD3; border-radius: 4px 4px 0 0; height: 100%;" title="Close: Confident send-off"></div>
            </div>
            <div style="display: flex; gap: 4px; font-size: 11px; color: #78716C;">
                <div style="flex: 1; text-align: center;">Open<br><span style="color: #BE123C;">high</span></div>
                <div style="flex: 1; text-align: center;">Context<br><span style="color: #57534E;">setting</span></div>
                <div style="flex: 1; text-align: center;">Core<br><span style="color: #57534E;">building</span></div>
                <div style="flex: 1; text-align: center;">POV<br><span style="color: #BE123C;">vulnerable</span></div>
                <div style="flex: 1; text-align: center;">Practical<br><span style="color: #57534E;">focused</span></div>
                <div style="flex: 1; text-align: center;">Close<br><span style="color: #BE123C;">confident</span></div>
            </div>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Dialogue Dynamic</div>
        <p style="margin-bottom: 16px; color: #57534E;">This is <strong>not</strong> an interview. It's two colleagues processing ideas together.</p>
        <div class="ds-do-dont">
            <div class="ds-dont">
                <strong>Bad (Interview format)</strong>
                <div style="font-size: 13px; margin-top: 8px; font-family: monospace; line-height: 1.6;">
                    SARAH: Tell us about psychological safety.<br>
                    BILL: Well, psychological safety is defined as... [3-min monologue]<br>
                    SARAH: That's great. Now tell us about timeboxing.
                </div>
            </div>
            <div class="ds-do">
                <strong>Good (Conversation)</strong>
                <div style="font-size: 13px; margin-top: 8px; font-family: monospace; line-height: 1.6;">
                    BILL: Psychological safety isn't about being nice. It's about being able to say "this idea won't work" without retaliation.<br><br>
                    SARAH: But doesn't that conflict with positivity?<br><br>
                    BILL: Exactly&mdash;that's toxic positivity. Real safety means the junior designer can look at the VP's concept and say "I don't think users will understand this."
                </div>
            </div>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Episode Structure</div>
        <div class="ds-card">
            <table class="ds-table" style="margin: 0;">
                <thead>
                    <tr>
                        <th>Segment</th>
                        <th>Duration</th>
                        <th>Words</th>
                        <th>Guidance</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Cold Open</strong></td>
                        <td>30&ndash;60 sec</td>
                        <td>100&ndash;150</td>
                        <td>Start mid-thought. Provocative statement or scene. Never "Welcome to..."</td>
                    </tr>
                    <tr>
                        <td><strong>Introduction</strong></td>
                        <td>1&ndash;2 min</td>
                        <td>200&ndash;300</td>
                        <td>Establish topic and why it matters now</td>
                    </tr>
                    <tr>
                        <td><strong>Core Discussion</strong></td>
                        <td>15&ndash;20 min</td>
                        <td>2,500&ndash;3,500</td>
                        <td>5&ndash;7 segments, 2&ndash;4 min each. Include POV moments.</td>
                    </tr>
                    <tr>
                        <td><strong>Ad Breaks</strong></td>
                        <td>4 &times; 30 sec</td>
                        <td>&mdash;</td>
                        <td>After Seg 1 (~6:00), Seg 3 (~12:30), Seg 5 (~18:30), outro</td>
                    </tr>
                    <tr>
                        <td><strong>Practical</strong></td>
                        <td>3&ndash;5 min</td>
                        <td>500&ndash;800</td>
                        <td>"What's the one thing to do differently this week?"</td>
                    </tr>
                    <tr>
                        <td><strong>Close</strong></td>
                        <td>1 min</td>
                        <td>100&ndash;200</td>
                        <td>End with a challenge. No summary, no "thanks for listening."</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Bill's POV Moments</div>
        <p style="margin-bottom: 16px; color: #57534E;">The secret weapon. Real stories from real work&mdash;not hypotheticals. Minimum 5&ndash;8 per episode.</p>
        <div class="ds-card">
            <table class="ds-table" style="margin: 0;">
                <thead>
                    <tr>
                        <th>Element</th>
                        <th>What It Means</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Specificity</strong></td>
                        <td>"At Autodesk in 2019" not "at a tech company once"</td>
                    </tr>
                    <tr>
                        <td><strong>Stakes</strong></td>
                        <td>Something was on the line&mdash;a project, a relationship, a career moment</td>
                    </tr>
                    <tr>
                        <td><strong>Vulnerability</strong></td>
                        <td>Often involves a mistake Bill made or a moment of uncertainty</td>
                    </tr>
                    <tr>
                        <td><strong>Resolution</strong></td>
                        <td>What happened, what he learned, what he'd do differently</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="background: #FFE4E6; border: 1px solid #FECDD3; border-radius: 8px; padding: 16px; margin-top: 16px;">
            <div style="font-size: 13px; font-style: italic; color: #BE123C;">
                "I'll never forget this workshop at Salesforce. We were three hours in, and I realized nobody had spoken except the two most senior people. The junior designers&mdash;the ones closest to the users&mdash;hadn't said a word. I stopped everything and said 'We're going to try something different.'"
            </div>
        </div>
        <div class="ds-note" style="margin-top: 16px;">
            <span class="material-symbols-outlined">rule</span>
            <div><strong>POV moment requirements:</strong> At least one in cold open or first segment. At least one involving a failure. At least one from a named company.</div>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Production Markers</div>
        <div class="ds-card">
            <table class="ds-table" style="margin: 0;">
                <thead>
                    <tr>
                        <th>Marker</th>
                        <th>Usage</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td><code>[PAUSE]</code></td><td>Beat for emphasis or transition</td></tr>
                    <tr><td><code>[SFX: description]</code></td><td>Sound effect cue</td></tr>
                    <tr><td><code>[MUSIC: description]</code></td><td>Music cue or transition</td></tr>
                    <tr><td><code>[BILL'S POV MOMENT]</code></td><td>Flags a personal story for production emphasis</td></tr>
                    <tr><td><code>[LAUGHS]</code> / <code>[SIGHS]</code></td><td>Natural vocal reactions (don't force)</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Podcast-Specific Phrases</div>
        <div class="ds-grid-2">
            <div class="ds-card" style="border-left: 4px solid #166534;">
                <div style="font-weight: 600; margin-bottom: 12px; color: #166534;">Use</div>
                <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                    <code>Here's the thing...</code>
                    <code>Let me tell you what happened...</code>
                    <code>No, actually, it's worse than that.</code>
                    <code>Wait, back up&mdash;</code>
                    <code>The mistake I made was...</code>
                    <code>What actually works is...</code>
                </div>
            </div>
            <div class="ds-card" style="border-left: 4px solid #991B1B;">
                <div style="font-weight: 600; margin-bottom: 12px; color: #991B1B;">Avoid</div>
                <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                    <code>Let's dive in</code>
                    <code>Let's unpack that</code>
                    <code>At the end of the day</code>
                    <code>This is where the magic happens</code>
                    <code>Game-changing</code>
                    <code>Leverage / Navigate</code>
                </div>
            </div>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Dialogue Patterns</div>
        <table class="ds-table">
            <thead>
                <tr>
                    <th>AI/Generic Pattern</th>
                    <th>Human Alternative</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Both speakers respond with complete thoughts</td>
                    <td>Interruptions, "wait, let me finish," "actually&mdash;"</td>
                </tr>
                <tr>
                    <td>Perfect turn-taking, no overlap</td>
                    <td>Natural conversational flow, occasional talking over</td>
                </tr>
                <tr>
                    <td>Sarah only asks setup questions</td>
                    <td>Sarah challenges, disagrees, shares her own experiences</td>
                </tr>
                <tr>
                    <td>Every Bill answer is 3 paragraphs</td>
                    <td>Some answers are one sentence. Some are stories.</td>
                </tr>
                <tr>
                    <td>No verbal fillers</td>
                    <td>A few natural "ums" humanize the audio</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Viral Clip Criteria</div>
        <p style="margin-bottom: 12px; color: #57534E;">Identify 3&ndash;5 moments per episode that work as short-form content.</p>
        <div class="ds-card">
            <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                <span style="background: #FFE4E6; color: #BE123C; padding: 4px 12px; border-radius: 100px; font-size: 13px; font-weight: 500;">Punchy &mdash; understood without context</span>
                <span style="background: #FFE4E6; color: #BE123C; padding: 4px 12px; border-radius: 100px; font-size: 13px; font-weight: 500;">Quotable &mdash; memorable phrasing</span>
                <span style="background: #FFE4E6; color: #BE123C; padding: 4px 12px; border-radius: 100px; font-size: 13px; font-weight: 500;">Contrarian &mdash; challenges wisdom</span>
                <span style="background: #FFE4E6; color: #BE123C; padding: 4px 12px; border-radius: 100px; font-size: 13px; font-weight: 500;">Actionable &mdash; immediate value</span>
                <span style="background: #FFE4E6; color: #BE123C; padding: 4px 12px; border-radius: 100px; font-size: 13px; font-weight: 500;">Emotional &mdash; creates "aha"</span>
            </div>
        </div>
    </div>

    <div class="ds-note">
        <span class="material-symbols-outlined">format_quote</span>
        <div><strong>The ultimate test:</strong> Does this sound like two people talking, or a corporate training video? Would I listen to this if I wasn't being paid to make it? Is there a moment that made me laugh, nod, or say "oh, that's good"?</div>
    </div>
</section>

<!-- Checklist -->
<section class="ds-section">
    <h2 class="ds-section-title">Authenticity checklist</h2>
    <p class="ds-section-desc">Before publishing, verify your writing passes these checks.</p>

    <div class="ds-grid-2">
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 12px; color: #166534;">Content checks</div>
            <ul style="margin: 0; padding-left: 20px; color: #57534E; font-size: 14px;">
                <li style="margin-bottom: 6px;">Does the opening hook come from an actual memory I can picture?</li>
                <li style="margin-bottom: 6px;">Have I admitted at least one mistake or limitation?</li>
                <li style="margin-bottom: 6px;">Is there a moment of genuine uncertainty?</li>
                <li style="margin-bottom: 6px;">Are my examples specific (names, dates, places) rather than hypothetical?</li>
                <li style="margin-bottom: 6px;">Is the closing metaphor connected to the opening, not a new one grabbed at the end?</li>
                <li>Does at least one section break the pattern of the others?</li>
            </ul>
        </div>
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 12px; color: #166534;">Voice checks</div>
            <ul style="margin: 0; padding-left: 20px; color: #57534E; font-size: 14px;">
                <li style="margin-bottom: 6px;">Would I actually say this out loud to a colleague?</li>
                <li style="margin-bottom: 6px;">Did I use contractions throughout?</li>
                <li style="margin-bottom: 6px;">Does it sound like me talking, or like a corporate blog?</li>
                <li style="margin-bottom: 6px;">Did I resist the urge to summarize at the end?</li>
                <li style="margin-bottom: 6px;">Did I vary the structural rhythm (section lengths, bullet counts, paragraph sizes)?</li>
                <li>Are there any sentences I'd be embarrassed to read out loud?</li>
            </ul>
        </div>
    </div>

    <div class="ds-card" style="margin-top: 16px;">
        <div style="font-weight: 600; margin-bottom: 12px; color: #166534;">Pattern checks</div>
        <div class="ds-grid-2" style="gap: 24px;">
            <ul style="margin: 0; padding-left: 20px; color: #57534E; font-size: 14px;">
                <li style="margin-bottom: 6px;">Did I cut any phrase from the banned words list?</li>
                <li style="margin-bottom: 6px;">Did I check for -ing phrase tack-ons?</li>
                <li style="margin-bottom: 6px;">Did I use "is/are/has" instead of "serves as/features"?</li>
            </ul>
            <ul style="margin: 0; padding-left: 20px; color: #57534E; font-size: 14px;">
                <li style="margin-bottom: 6px;">Did I avoid the rule of three?</li>
                <li style="margin-bottom: 6px;">Did I remove negative parallelisms ("It's not just...it's...")?</li>
                <li style="margin-bottom: 6px;">Did I cut em dash overuse?</li>
            </ul>
        </div>
    </div>
</section>

<!-- Quick reference -->
<section class="ds-section">
    <h2 class="ds-section-title">Quick reference</h2>

    <div class="ds-grid-2">
        <div class="ds-card" style="border-left: 4px solid #166534;">
            <div style="font-weight: 600; margin-bottom: 12px; color: #166534;">Do</div>
            <ul style="margin: 0; padding-left: 20px; color: #57534E; font-size: 14px;">
                <li style="margin-bottom: 6px;">Start with a story only you could tell</li>
                <li style="margin-bottom: 6px;">Admit when something didn't work</li>
                <li style="margin-bottom: 6px;">Use contractions (it's, don't, you'll)</li>
                <li style="margin-bottom: 6px;">Let sentences be short. Or fragments.</li>
                <li style="margin-bottom: 6px;">Have opinions and state them directly</li>
                <li style="margin-bottom: 6px;">End with a challenge, not a summary</li>
                <li style="margin-bottom: 6px;">Carry one metaphor through the piece</li>
                <li style="margin-bottom: 6px;">Acknowledge mixed feelings and complexity</li>
                <li style="margin-bottom: 6px;">Include at least one "I screwed this up" moment</li>
                <li>Reference specific projects, clients, or experiences</li>
            </ul>
        </div>
        <div class="ds-card" style="border-left: 4px solid #991B1B;">
            <div style="font-weight: 600; margin-bottom: 12px; color: #991B1B;">Don't</div>
            <ul style="margin: 0; padding-left: 20px; color: #57534E; font-size: 14px;">
                <li style="margin-bottom: 6px;">Open with definitions or context-setting</li>
                <li style="margin-bottom: 6px;">Name your frameworks with capital letters</li>
                <li style="margin-bottom: 6px;">Manufacture statistics</li>
                <li style="margin-bottom: 6px;">Include sensory details you don't remember</li>
                <li style="margin-bottom: 6px;">End sections by restating what you said</li>
                <li style="margin-bottom: 6px;">Hedge with "some might say"</li>
                <li style="margin-bottom: 6px;">Use any word from the banned list</li>
                <li style="margin-bottom: 6px;">Force ideas into groups of three</li>
                <li style="margin-bottom: 6px;">Write the same structure for every section</li>
                <li>Sound like you're giving a keynote</li>
            </ul>
        </div>
    </div>

    <div class="ds-note" style="margin-top: 24px;">
        <span class="material-symbols-outlined">format_quote</span>
        <div><strong>The ultimate test:</strong> Read it out loud. If it sounds like a keynote speech or a Wikipedia article, rewrite it. If it sounds like you explaining something to a smart friend who's short on time, you're there.</div>
    </div>
</section>

<!-- Source reference -->
<section class="ds-section" style="opacity: 0.7;">
    <p style="font-size: 13px; color: #78716C; margin: 0;">
        Source: <code>/content/articles/workshopr_writing_style_guide.md</code> + <code>/content/workshopr_podcast_style_guide.md</code>
    </p>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
