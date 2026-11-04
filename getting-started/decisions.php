<?php
$ds_page  = 'getting-started/decisions';
$ds_title = 'Design Decisions';

require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>Design Decisions</h1>
    <p>The reasoning behind key design choices for each application in the Workshopr platform. Understanding the "why" helps maintain consistency as we evolve.</p>
</div>

<!-- Platform Overview -->
<section class="ds-section">
    <h2 class="ds-section-title">Platform philosophy</h2>
    <p class="ds-section-desc">Workshopr follows a three-phase facilitation model: Learn, Plan, Facilitate. Each phase has distinct user needs and emotional contexts.</p>

    <div class="ds-card">
        <table class="ds-table" style="margin: 0;">
            <thead>
                <tr>
                    <th>Phase</th>
                    <th>User goal</th>
                    <th>Emotional state</th>
                    <th>Design approach</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span style="display: inline-flex; align-items: center; gap: 6px;"><span style="width: 8px; height: 8px; background: #E54D4D; border-radius: 2px;"></span> <strong>Learn</strong></span></td>
                    <td>Discover exercises, get inspired</td>
                    <td>Curious, exploratory</td>
                    <td>Warm, inviting, content-rich browsing</td>
                </tr>
                <tr>
                    <td><span style="display: inline-flex; align-items: center; gap: 6px;"><span style="width: 8px; height: 8px; background: #0284C7; border-radius: 2px;"></span> <strong>Plan</strong></span></td>
                    <td>Build agenda, prepare session</td>
                    <td>Focused, productive</td>
                    <td>Clean, professional, tool-like</td>
                </tr>
                <tr>
                    <td><span style="display: inline-flex; align-items: center; gap: 6px;"><span style="width: 8px; height: 8px; background: #7C4DFF; border-radius: 2px;"></span> <strong>Facilitate</strong></span></td>
                    <td>Run session, get real-time support</td>
                    <td>Focused but anxious, needs confidence</td>
                    <td>Calm, supportive, minimal distraction</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="ds-note" style="margin-top: 16px;">
        <span class="material-symbols-outlined">psychology</span>
        <div><strong>Key insight:</strong> Each phase serves a different cognitive mode. Learn is divergent (exploring options), Plan is convergent (making decisions), Facilitate is executive (taking action under pressure).</div>
    </div>
</section>

<!-- Cross-app architecture: The Workshop Record -->
<section class="ds-section">
    <h2 class="ds-section-title">The Workshop Record</h2>
    <p class="ds-section-desc">How one workshop stays a single object across Planner, Facilitator, and Synthesize. The user-facing noun is <strong>"Workshop"</strong>; internally, the <code>plans</code> row is the spine — one plan = one workshop. Every app stamps its rows with <code>plan_id</code>, and <code>getWorkshopRecord()</code> federates them into one time-sorted story at read time. Lifecycle (Designed &rarr; Delivered &rarr; Synthesized) is derived, never stored.</p>

    <?php /* docs/ answers 403 on the host, so these open only on a local checkout. */ ?>
    <?php if (in_array($_SERVER['SERVER_NAME'] ?? '', ['localhost', '127.0.0.1'], true)): ?>
    <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
        <a href="<?= $site_base ?>/docs/workshop-record-diagram.html" target="_blank" rel="noopener" class="ds-hero-btn ds-hero-btn--primary">
            <span class="material-symbols-outlined">account_tree</span>
            View the architecture diagram
        </a>
        <a href="<?= $site_base ?>/docs/workshop-record.md" target="_blank" rel="noopener" class="ds-hero-btn ds-hero-btn--ghost">
            <span class="material-symbols-outlined">description</span>
            Read the architecture note
        </a>
    </div>
    <?php endif; ?>

    <div class="ds-note" style="margin-top: 16px;">
        <span class="material-symbols-outlined">hub</span>
        <div><strong>Why it matters for design:</strong> <code>ws_wl_journey()</code> renders this journey on every workshop card and picker, in the platform's four phases &mdash; Strategize &rarr; Plan &rarr; Facilitate &rarr; Synthesize. The stage is the phase a workshop currently <em>owes work in</em>, derived by <code>wrDeriveStage()</code> and never stored. The diagram is the source of truth for what each stage means. (The older <code>ws_lifecycle</code> component, which drew the retired three-step Designed &rarr; Delivered &rarr; Synthesized reading, was retired in August 2026 &mdash; it never had a caller.)</div>
    </div>
</section>

<!-- Main Site -->
<section class="ds-section">
    <h2 class="ds-section-title" style="display: flex; align-items: center; gap: 10px;">
        <span style="width: 12px; height: 12px; background: #E54D4D; border-radius: 4px;"></span>
        Main Site (workshopr.io)
    </h2>
    <p class="ds-section-desc">The content library and brand hub. First impression for most users.</p>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Purpose</div>
        <div class="ds-card">
            <p style="margin: 0;">A curated library of workshop exercises, icebreakers, and facilitation resources. Users browse, discover, and save activities for later use in the Planner.</p>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Key decisions & rationale</div>
        <table class="ds-table">
            <thead>
                <tr>
                    <th>Decision</th>
                    <th>Why</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Warm coral red primary (#E54D4D)</strong></td>
                    <td>Establishes brand identity. Red conveys energy and action—appropriate for facilitation. Warm undertone keeps it approachable rather than aggressive.</td>
                </tr>
                <tr>
                    <td><strong>Card-based content layout</strong></td>
                    <td>Supports scanning and comparison. Users often browse multiple exercises before choosing. Cards create clear visual boundaries and enable hover states for quick preview.</td>
                </tr>
                <tr>
                    <td><strong>Category color-coding</strong></td>
                    <td>Helps users quickly filter by exercise type (Ideation = amber, Team Building = green, etc.). Visual differentiation reduces cognitive load when scanning large libraries.</td>
                </tr>
                <tr>
                    <td><strong>Fraunces serif for headings</strong></td>
                    <td>Adds warmth and personality. Distinguishes Workshopr from cold SaaS tools. The slight quirkiness signals creativity and approachability.</td>
                </tr>
                <tr>
                    <td><strong>Generous whitespace</strong></td>
                    <td>Content-heavy pages need breathing room. Users aren't in a rush here—they're exploring. Space creates calm and improves readability.</td>
                </tr>
                <tr>
                    <td><strong>No sidebar navigation on content pages</strong></td>
                    <td>Maximizes content area. Breadcrumbs and clear back-navigation handle wayfinding without persistent chrome stealing space.</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<!-- Planner -->
<section class="ds-section">
    <h2 class="ds-section-title" style="display: flex; align-items: center; gap: 10px;">
        <span style="width: 12px; height: 12px; background: #0284C7; border-radius: 4px;"></span>
        Planner (planner.workshopr.io)
    </h2>
    <p class="ds-section-desc">Drag-and-drop workshop agenda builder. The "productivity tool" of the platform.</p>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Purpose</div>
        <div class="ds-card">
            <p style="margin: 0;">Construct workshop agendas by combining exercises, breaks, and custom activities. Export to PDF/calendar. Send to Coach for real-time facilitation support.</p>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Key decisions & rationale</div>
        <table class="ds-table">
            <thead>
                <tr>
                    <th>Decision</th>
                    <th>Why</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Cool blue primary (#0284C7)</strong></td>
                    <td>Signals "tool mode"—focused and professional. Blue is universally associated with productivity software (Notion, Linear, Figma). Creates clear visual distinction from the marketing site.</td>
                </tr>
                <tr>
                    <td><strong>Persistent sidebar for activity library</strong></td>
                    <td>Drag-and-drop requires source and target to be visible simultaneously. Collapsible accordion sections prevent overwhelming users with choices.</td>
                </tr>
                <tr>
                    <td><strong>Timeline visualization</strong></td>
                    <td>Workshops are time-bound. Visual timeline helps facilitators see pacing at a glance. Progress bar shows total duration vs. target, preventing over-scheduling.</td>
                </tr>
                <tr>
                    <td><strong>Inline editing over modals</strong></td>
                    <td>Quick tweaks (duration, notes) shouldn't interrupt flow. Expanding panels keep context visible while editing. Modals reserved for complex operations (save, export, share).</td>
                </tr>
                <tr>
                    <td><strong>Colored header modals</strong></td>
                    <td>Strong visual anchor for important actions. The blue header creates hierarchy and makes modals feel intentional rather than interruptive.</td>
                </tr>
                <tr>
                    <td><strong>Kiosk mode option</strong></td>
                    <td>When opened from AI Builder or in iframe, removes main site chrome. Focuses attention on the task. Reduces cognitive load for first-time users going through onboarding.</td>
                </tr>
                <tr>
                    <td><strong>Activity type color bars</strong></td>
                    <td>Left-edge color indicates type (exercise/icebreaker/break) at a glance. Helps facilitators visually scan agenda structure and identify missing variety.</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="ds-note" style="margin-top: 16px;">
        <span class="material-symbols-outlined">lightbulb</span>
        <div><strong>Design principle:</strong> Planner should feel like a focused workspace, not a website. Every pixel should serve the task of building an agenda.</div>
    </div>
</section>

<!-- Coach -->
<section class="ds-section">
    <h2 class="ds-section-title" style="display: flex; align-items: center; gap: 10px;">
        <span style="width: 12px; height: 12px; background: #7C4DFF; border-radius: 4px;"></span>
        Coach (coach.workshopr.io)
    </h2>
    <p class="ds-section-desc">AI-powered facilitation assistant. Three modes: Prep, Live, Reflect.</p>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Purpose</div>
        <div class="ds-card">
            <p style="margin: 0;">Provide intelligent support before, during, and after workshops. Prep mode reviews agendas and flags risks. Live mode offers real-time intervention suggestions. Reflect mode guides debrief conversations.</p>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Key decisions & rationale</div>
        <table class="ds-table">
            <thead>
                <tr>
                    <th>Decision</th>
                    <th>Why</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Purple primary (#7C4DFF)</strong></td>
                    <td>Distinct from both red (brand) and blue (planner). Purple signals intelligence and insight—appropriate for AI assistance. Also differentiates clearly from other apps in tab switching.</td>
                </tr>
                <tr>
                    <td><strong>Darker, calmer color palette</strong></td>
                    <td>Live facilitation is high-pressure. The interface should be calming, not stimulating. Dark backgrounds reduce eye strain during long sessions and minimize distraction.</td>
                </tr>
                <tr>
                    <td><strong>Large, glanceable typography</strong></td>
                    <td>Facilitators check Coach while managing a room. Information must be readable at arm's length or quick glance. No squinting at small text during a workshop.</td>
                </tr>
                <tr>
                    <td><strong>Passive suggestion model (Live mode)</strong></td>
                    <td>AI shouldn't interrupt the facilitator. Suggestions appear in a designated area, visible but not demanding. Facilitator chooses when to engage. Respects their expertise and flow.</td>
                </tr>
                <tr>
                    <td><strong>Intervention cards system</strong></td>
                    <td>Pre-defined response patterns for common situations (low energy, conflict, confusion). Gives facilitators specific language and actions rather than vague advice. Reduces decision fatigue.</td>
                </tr>
                <tr>
                    <td><strong>Timer as primary UI element</strong></td>
                    <td>Time is the facilitator's most precious resource. Always-visible timer with activity context helps maintain pacing without mental math.</td>
                </tr>
                <tr>
                    <td><strong>Three distinct modes, one URL</strong></td>
                    <td>Prep → Live → Reflect is a natural flow. Single app with mode switching (vs. three separate apps) preserves context and reduces cognitive overhead of tool-switching.</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="ds-do-dont" style="margin-top: 16px;">
        <div class="ds-do">
            <strong>Live mode design goals</strong>
            Minimal, calm, glanceable. One primary action visible. Suggestions ready but not pushy. Timer always visible.
        </div>
        <div class="ds-dont">
            <strong>What we avoid</strong>
            Busy dashboards, notifications that demand attention, small text, features that require reading during a session.
        </div>
    </div>
</section>

<!-- MyWorkshopr -->
<section class="ds-section">
    <h2 class="ds-section-title" style="display: flex; align-items: center; gap: 10px;">
        <span style="width: 12px; height: 12px; background: #1A2744; border-radius: 4px;"></span>
        MyWorkshopr (Dashboard)
    </h2>
    <p class="ds-section-desc">User account area. Saved workshops, settings, subscription management.</p>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Purpose</div>
        <div class="ds-card">
            <p style="margin: 0;">Central hub for authenticated users to manage their saved work, access history, and configure their account. Gateway to all personalized features.</p>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Key decisions & rationale</div>
        <table class="ds-table">
            <thead>
                <tr>
                    <th>Decision</th>
                    <th>Why</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Navy blue (#1A2744) for chrome</strong></td>
                    <td>Professional, trustworthy, premium. Navy is the "serious" anchor color—appropriate for account management and settings. Consistent with the nav across all apps.</td>
                </tr>
                <tr>
                    <td><strong>Sidebar navigation</strong></td>
                    <td>Dashboard is a multi-section area (workshops, templates, settings, billing). Persistent sidebar provides orientation and quick switching. Standard pattern users expect.</td>
                </tr>
                <tr>
                    <td><strong>Cards for saved workshops</strong></td>
                    <td>Same card pattern as main site for consistency. Users recognize their saved items. Hover states reveal actions (edit, delete, duplicate, send to coach).</td>
                </tr>
                <tr>
                    <td><strong>Recent activity on landing</strong></td>
                    <td>Most users return to continue previous work. Showing recent items first reduces clicks to resume. "Pick up where you left off" improves perceived speed.</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<!-- Tips -->
<section class="ds-section">
    <h2 class="ds-section-title" style="display: flex; align-items: center; gap: 10px;">
        <span style="width: 12px; height: 12px; background: #F87171; border-radius: 4px;"></span>
        Tips (tips.workshopr.io)
    </h2>
    <p class="ds-section-desc">Quick, actionable facilitation advice. Bite-sized learning for busy facilitators.</p>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Purpose</div>
        <div class="ds-card">
            <p style="margin: 0;">Deliver focused facilitation tips in an easily digestible format. Each tip addresses a specific challenge or technique, helping facilitators improve incrementally without time commitment.</p>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Key decisions & rationale</div>
        <table class="ds-table">
            <thead>
                <tr>
                    <th>Decision</th>
                    <th>Why</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Coral red primary (#F87171)</strong></td>
                    <td>Part of the Learn phase color family (red spectrum). Lighter than main site red to feel approachable and quick. Signals bite-sized, easy-to-digest content.</td>
                </tr>
                <tr>
                    <td><strong>Card-per-tip layout</strong></td>
                    <td>Each tip is self-contained. Cards allow quick scanning and easy sharing. No long-form scrolling required—users get value immediately.</td>
                </tr>
                <tr>
                    <td><strong>Category tags (Engagement, Timing, Conflict, etc.)</strong></td>
                    <td>Facilitators often need help in specific areas. Tags enable filtering to relevant content quickly. Helps users build targeted skill sets.</td>
                </tr>
                <tr>
                    <td><strong>Save/bookmark functionality</strong></td>
                    <td>Users return to favorite tips before sessions. Building a personal collection increases engagement and creates habit loops.</td>
                </tr>
                <tr>
                    <td><strong>Daily tip email option</strong></td>
                    <td>Passive learning without requiring app visits. Keeps Workshopr top-of-mind. Email format encourages sharing with colleagues.</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<!-- Interventions -->
<section class="ds-section">
    <h2 class="ds-section-title" style="display: flex; align-items: center; gap: 10px;">
        <span style="width: 12px; height: 12px; background: #7C4DFF; border-radius: 4px;"></span>
        Interventions (intervention.workshopr.io)
    </h2>
    <p class="ds-section-desc">Intervention card library. Ready-to-use responses for common facilitation challenges.</p>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Purpose</div>
        <div class="ds-card">
            <p style="margin: 0;">Provide facilitators with pre-written scripts and actions for handling difficult moments—low energy, conflict, confusion, silence, and more. Reduces decision fatigue during high-pressure situations.</p>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Key decisions & rationale</div>
        <table class="ds-table">
            <thead>
                <tr>
                    <th>Decision</th>
                    <th>Why</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Purple primary (#7C4DFF)</strong></td>
                    <td>Part of the Facilitate phase (same as Coach). Interventions are used during live facilitation—sharing Coach's purple creates visual unity. Users associate purple with "in-session support."</td>
                </tr>
                <tr>
                    <td><strong>Physical card metaphor</strong></td>
                    <td>Interventions feel tangible and actionable. Card format mirrors index cards facilitators might actually use. Easy to mentally "grab" during a session.</td>
                </tr>
                <tr>
                    <td><strong>Category-based organization (6 categories)</strong></td>
                    <td>Energy, Engagement, Conflict, Confusion, Time, and Group Dynamics. Clear mental model matches how facilitators diagnose problems. Quick navigation under pressure.</td>
                </tr>
                <tr>
                    <td><strong>Script + action format</strong></td>
                    <td>Each card has "What to say" and "What to do" sections. Removes guesswork. Facilitators can use verbatim or adapt. Structure prevents blank-mind moments.</td>
                </tr>
                <tr>
                    <td><strong>Severity indicators</strong></td>
                    <td>Cards marked as quick-fix vs. deeper intervention. Helps facilitators match response to situation gravity. Prevents over- or under-reacting.</td>
                </tr>
                <tr>
                    <td><strong>Coach integration</strong></td>
                    <td>Same cards appear in Coach Live mode as suggestions. Consistency between browsing and in-session use. Familiarity reduces cognitive load.</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="ds-note" style="margin-top: 16px;">
        <span class="material-symbols-outlined">tips_and_updates</span>
        <div><strong>Design principle:</strong> Intervention cards should be usable at a glance. A facilitator with 10 seconds to spare should be able to read, understand, and act.</div>
    </div>
</section>

<!-- Podcasts -->
<section class="ds-section">
    <h2 class="ds-section-title" style="display: flex; align-items: center; gap: 10px;">
        <span style="width: 12px; height: 12px; background: #BE123C; border-radius: 4px;"></span>
        Podcasts (podcasts.workshopr.io)
    </h2>
    <p class="ds-section-desc">Audio content for facilitators. Learn on the go through conversations and deep dives.</p>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Purpose</div>
        <div class="ds-card">
            <p style="margin: 0;">Extend learning beyond screen time. Podcast episodes cover facilitation techniques, expert interviews, case studies, and behind-the-scenes stories. Perfect for commutes, walks, or background listening.</p>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Key decisions & rationale</div>
        <table class="ds-table">
            <thead>
                <tr>
                    <th>Decision</th>
                    <th>Why</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Crimson primary (#BE123C)</strong></td>
                    <td>Part of the Learn phase color family (red spectrum). Deeper and richer than main site red—signals depth and immersion appropriate for long-form audio content.</td>
                </tr>
                <tr>
                    <td><strong>Episode card layout with waveform preview</strong></td>
                    <td>Visual waveform indicates episode energy and pacing. Cards show duration, guest, and topic at a glance. Helps users choose episodes that match their mood/time.</td>
                </tr>
                <tr>
                    <td><strong>Chapter markers</strong></td>
                    <td>Long episodes need navigation. Chapter markers let users skip to relevant sections. Increases completion rates and return visits.</td>
                </tr>
                <tr>
                    <td><strong>Transcript availability</strong></td>
                    <td>Accessibility requirement. Also enables searching within episodes. Users can quote or reference specific moments. SEO benefit for discoverability.</td>
                </tr>
                <tr>
                    <td><strong>Embedded player + external platform links</strong></td>
                    <td>Some users prefer listening on-site, others in their podcast app. Supporting both respects user habits. Platform links (Spotify, Apple) expand reach.</td>
                </tr>
                <tr>
                    <td><strong>Related exercises sidebar</strong></td>
                    <td>Connect audio content to actionable library items. Episode about icebreakers links to icebreaker exercises. Drives cross-platform engagement.</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<!-- Training -->
<section class="ds-section">
    <h2 class="ds-section-title" style="display: flex; align-items: center; gap: 10px;">
        <span style="width: 12px; height: 12px; background: #10B981; border-radius: 4px;"></span>
        Training (workshopr.io/training)
    </h2>
    <p class="ds-section-desc">Structured learning paths and courses. From beginner to advanced facilitation mastery.</p>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Purpose</div>
        <div class="ds-card">
            <p style="margin: 0;">Provide comprehensive facilitation education through structured courses, video lessons, and hands-on exercises. Includes certification paths for professional development and credentialing.</p>
        </div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">Key decisions & rationale</div>
        <table class="ds-table">
            <thead>
                <tr>
                    <th>Decision</th>
                    <th>Why</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Emerald primary (#10B981)</strong></td>
                    <td>Part of the Reflect phase color family (green spectrum). Green signals growth, progress, and achievement—perfect for structured learning. Encourages users to see training as personal development.</td>
                </tr>
                <tr>
                    <td><strong>Progress tracking with visual milestones</strong></td>
                    <td>Learning is a journey. Visual progress (percentage, badges, milestones) motivates continuation. Users see investment building over time.</td>
                </tr>
                <tr>
                    <td><strong>Module-based course structure</strong></td>
                    <td>Break large courses into digestible chunks. Each module is 15-30 minutes. Allows learning in short sessions. Clear completion states per module.</td>
                </tr>
                <tr>
                    <td><strong>Video + text + practice format</strong></td>
                    <td>Different learners prefer different formats. Videos for visual learners, text for readers, exercises for practitioners. Multimodal approach increases retention.</td>
                </tr>
                <tr>
                    <td><strong>Certificate generation</strong></td>
                    <td>Professional development requires proof. Downloadable/shareable certificates validate learning. LinkedIn integration for career visibility.</td>
                </tr>
                <tr>
                    <td><strong>Cohort-based live courses option</strong></td>
                    <td>Some learning benefits from community. Live cohorts create accountability and peer connection. Premium offering for serious learners.</td>
                </tr>
                <tr>
                    <td><strong>Path as subdirectory (/training) not subdomain</strong></td>
                    <td>Training is part of the main site experience, not a separate tool. Users browse content library and training together. Simplifies navigation and SEO.</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="ds-do-dont" style="margin-top: 16px;">
        <div class="ds-do">
            <strong>Training design goals</strong>
            Encouraging, structured, progress-oriented. Clear paths from beginner to expert. Celebrate completions. Make learning feel achievable.
        </div>
        <div class="ds-dont">
            <strong>What we avoid</strong>
            Overwhelming course catalogs, unclear prerequisites, hidden paywalls mid-course, gamification that feels patronizing.
        </div>
    </div>
</section>

<!-- Cross-app decisions -->
<section class="ds-section">
    <h2 class="ds-section-title">Cross-platform decisions</h2>
    <p class="ds-section-desc">Choices that apply across all applications.</p>

    <table class="ds-table">
        <thead>
            <tr>
                <th>Decision</th>
                <th>Why</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Shared design tokens</strong></td>
                <td>One source of truth for colors, spacing, typography. Apps override only accent colors. Ensures consistency and simplifies maintenance.</td>
            </tr>
            <tr>
                <td><strong>Shared component library</strong></td>
                <td>Same buttons, inputs, cards, modals across apps. Users learn once, patterns apply everywhere. Reduces development time and ensures accessibility.</td>
            </tr>
            <tr>
                <td><strong>Consistent navigation bar</strong></td>
                <td>Navy header appears across all apps (when logged in). Creates sense of unified platform rather than disconnected tools. Logo always returns to main site.</td>
            </tr>
            <tr>
                <td><strong>Persistent user session</strong></td>
                <td>Login once, authenticated everywhere. Reduces friction when moving between apps. Session persists across subdomains.</td>
            </tr>
            <tr>
                <td><strong>Material Symbols icons</strong></td>
                <td>Google's icon set is comprehensive, well-designed, and actively maintained. Variable font means we can adjust weight and fill. Consistent visual language.</td>
            </tr>
            <tr>
                <td><strong>Inter + Fraunces typography</strong></td>
                <td>Inter for body (highly readable, professional). Fraunces for headings (warmth, personality). The pairing balances approachability with credibility.</td>
            </tr>
            <tr>
                <td><strong>12px border radius default</strong></td>
                <td>Soft but not bubbly. Modern without being trendy. Large enough to feel friendly, not so large that it wastes space or feels childish.</td>
            </tr>
            <tr>
                <td><strong>Toast notifications (not alerts)</strong></td>
                <td>Non-blocking feedback. Users can continue working while seeing confirmation. Bottom-right placement follows muscle memory from other tools.</td>
            </tr>
        </tbody>
    </table>
</section>

<!-- Anti-patterns -->
<section class="ds-section">
    <h2 class="ds-section-title">What we deliberately avoid</h2>
    <p class="ds-section-desc">Patterns we've chosen not to use, and why.</p>

    <div class="ds-grid-2">
        <div class="ds-card" style="border-left: 4px solid #991B1B;">
            <div style="font-weight: 600; margin-bottom: 8px;">Aggressive onboarding flows</div>
            <p style="margin: 0; font-size: 14px; color: #57534E;">No forced product tours or modal sequences. Users can explore at their own pace. Tooltips and empty states provide contextual guidance instead.</p>
        </div>
        <div class="ds-card" style="border-left: 4px solid #991B1B;">
            <div style="font-weight: 600; margin-bottom: 8px;">Dark patterns</div>
            <p style="margin: 0; font-size: 14px; color: #57534E;">No hidden fees, confusing cancellation, or manipulative copy. Facilitators need to trust their tools. Trust is earned through transparency.</p>
        </div>
        <div class="ds-card" style="border-left: 4px solid #991B1B;">
            <div style="font-weight: 600; margin-bottom: 8px;">Feature overload in primary views</div>
            <p style="margin: 0; font-size: 14px; color: #57534E;">Advanced features live in menus, not on main screens. First-time users see essential actions only. Power features reveal progressively.</p>
        </div>
        <div class="ds-card" style="border-left: 4px solid #991B1B;">
            <div style="font-weight: 600; margin-bottom: 8px;">Notifications that demand attention</div>
            <p style="margin: 0; font-size: 14px; color: #57534E;">Especially in Coach Live mode. The facilitator's attention belongs to their participants, not to our UI. Suggestions are passive, never interruptive.</p>
        </div>
    </div>
</section>

<!-- Decision log -->
<section class="ds-section">
    <h2 class="ds-section-title">Recent decision log</h2>
    <p class="ds-section-desc">Major design decisions made recently, for historical context.</p>

    <div class="ds-card">
        <table class="ds-table" style="margin: 0;">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Decision</th>
                    <th>Rationale</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="white-space: nowrap;">Feb 2026</td>
                    <td>Moved Planner modals to shared include system</td>
                    <td>Reduced planner.php from 1288 to 557 lines. Improves maintainability and ensures modal consistency.</td>
                </tr>
                <tr>
                    <td style="white-space: nowrap;">Feb 2026</td>
                    <td>Added Progress, Alert, Skeleton components</td>
                    <td>Completing the component library for common loading and feedback patterns.</td>
                </tr>
                <tr>
                    <td style="white-space: nowrap;">Feb 2026</td>
                    <td>Created Voice & Tone documentation</td>
                    <td>Codifying writing style to maintain consistency as content team grows.</td>
                </tr>
                <tr>
                    <td style="white-space: nowrap;">Jan 2026</td>
                    <td>Standardized on ws_ prefix for component helpers</td>
                    <td>Clear namespace prevents conflicts with other PHP functions. ws_button, ws_input, ws_modal, etc.</td>
                </tr>
                <tr>
                    <td style="white-space: nowrap;">Jan 2026</td>
                    <td>Adopted colored modal headers for Planner</td>
                    <td>Blue header creates strong visual hierarchy and consistent app identity within modals.</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
