<?php
$ds_page  = 'components/demos/button';
$ds_title = 'Button';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Button</h1>
    <p>Triggers an action. The most-used interactive component on the platform, so its rules are the strictest.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            Something happens on click (save, delete, submit, open a modal), or when a navigation target is important enough to be a call to action. One <code>primary</code> per view; everything else is <code>secondary</code> or <code>ghost</code>. A form's button needs <code>'type' =&gt; 'submit'</code>: the default is <code>button</code>, which submits nothing. A form with one action puts it straight in the form's stack; two or more go in a <code>ws_cluster_start</code> row, primary first (DESIGN.md 11.6). With <code>href</code> it is a link styled as a button: use that for a way to another page, such as an empty state's "Show all workshops" or a card's "Open".
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The target is ordinary inline navigation &mdash; use a plain anchor. For switching between views use <a href="<?= $ds_base ?>/components/demos/tabs.php">Tabs</a>; for an on/off setting use <a href="<?= $ds_base ?>/components/demos/toggle.php">Toggle</a>.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Style</h3>
        <p class="ds-section-desc">Four variants, in descending order of emphasis. <code class="ds-code-inline">danger</code> is not more important than <code class="ds-code-inline">primary</code> &mdash; it's for destructive actions only.</p>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
            <?= ws_button('Primary', ['variant' => 'primary']) ?>
            <?= ws_button('Secondary', ['variant' => 'secondary']) ?>
            <?= ws_button('Ghost', ['variant' => 'ghost']) ?>
            <?= ws_button('Danger', ['variant' => 'danger']) ?>
        </div>
        <table class="ds-table">
            <thead><tr><th>Variant</th><th>Use for</th></tr></thead>
            <tbody>
                <tr><td><code>primary</code></td><td>The single most important action in the view</td></tr>
                <tr><td><code>secondary</code></td><td>Alternative actions alongside the primary. Inherits <code>--phase-color</code>.</td></tr>
                <tr><td><code>ghost</code></td><td>Low-emphasis and repeated actions &mdash; toolbar controls, row actions</td></tr>
                <tr><td><code>danger</code></td><td>Destructive, irreversible actions. Pair with a confirmation.</td></tr>
            </tbody>
        </table>
        <div class="ds-code"><pre>&lt;?= ws_button('Primary', ['variant' => 'primary']) ?&gt;
&lt;?= ws_button('Secondary', ['variant' => 'secondary']) ?&gt;
&lt;?= ws_button('Ghost', ['variant' => 'ghost']) ?&gt;
&lt;?= ws_button('Danger', ['variant' => 'danger']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Sizes</h3>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
            <?= ws_button('Small', ['variant' => 'primary', 'size' => 'sm']) ?>
            <?= ws_button('Medium', ['variant' => 'primary', 'size' => 'md']) ?>
            <?= ws_button('Large', ['variant' => 'primary', 'size' => 'lg']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_button('Small', ['size' => 'sm']) ?&gt;
&lt;?= ws_button('Large', ['size' => 'lg']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With icons</h3>
        <p class="ds-section-desc">The icon sits left by default. Put it right only when it signals forward motion, as on a "next" step.</p>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
            <?= ws_button('Add Workshop', ['variant' => 'primary', 'icon' => 'add']) ?>
            <?= ws_button('Save Draft', ['variant' => 'ghost', 'icon' => 'save']) ?>
            <?= ws_button('Next Step', ['variant' => 'secondary', 'icon' => 'arrow_forward', 'iconPosition' => 'right']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_button('Add Workshop', ['variant' => 'primary', 'icon' => 'add']) ?&gt;
&lt;?= ws_button('Next Step', [
    'variant'      => 'secondary',
    'icon'         => 'arrow_forward',
    'iconPosition' => 'right',
]) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">As a link</h3>
        <p class="ds-section-desc">Passing <code class="ds-code-inline">href</code> renders an <code class="ds-code-inline">&lt;a&gt;</code> instead of a <code class="ds-code-inline">&lt;button&gt;</code>. Use it when the action is really navigation &mdash; that keeps middle-click, right-click, and copy-link-address working.</p>
        <div class="ds-card">
            <?= ws_button('View Workshops', ['variant' => 'primary', 'href' => '/library/workshops/']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_button('View Workshops', ['variant' => 'primary', 'href' => '/library/workshops/']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Phase theming</h3>
        <p class="ds-section-desc">The secondary variant reads <code class="ds-code-inline">--phase-color</code> for its border and <code class="ds-code-inline">--phase-color-dark</code> for its text, falling back to <code class="ds-code-inline">--brand</code> and <code class="ds-code-inline">--brand-ink</code>. Since Red Unification (July 2026) nothing sets them: leave them unset and every secondary button is the brand red, as below. Setting them to one of the old per-phase tokens changes nothing, because those all resolve to <code class="ds-code-inline">--brand</code> now.</p>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 24px; align-items: center;">
            <?= ws_button('Open in Plan', ['variant' => 'secondary']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_button('Open in Plan', ['variant' =&gt; 'secondary']) ?&gt;</pre></div>
        <div class="ds-note">
            <span class="material-symbols-outlined">warning</span>
            <span>Never hardcode a legacy phase hex as a fallback (<code>var(--phase-plan, #0284C7)</code>). The blue, purple, and emerald phase colours were retired &mdash; a fallback like that resurrects them wherever the token fails to load. See <a href="<?= $ds_base ?>/foundations/colors.php">Colors</a>.</span>
        </div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
        <?= ws_button('Default', ['variant' => 'primary']) ?>
        <?= ws_button('Disabled', ['variant' => 'primary', 'disabled' => true]) ?>
        <?= ws_button('Loading', ['variant' => 'primary', 'loading' => true]) ?>
    </div>
    <div style="max-width: 320px; margin-top: 12px;">
        <?= ws_button('Full Width', ['variant' => 'secondary', 'fullWidth' => true]) ?>
    </div>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Hover</td><td>Per-variant colour shift, gated on <code>:not(:disabled)</code>. Primary also lifts with <code>--button-shadow-primary-hover</code>.</td></tr>
            <tr><td>Active</td><td>Presses down via <code>.ws-btn:active:not(:disabled)</code>.</td></tr>
            <tr><td>Focus</td><td>Browser default focus ring &mdash; the platform's one sanctioned non-red accent. Don't remove it without providing a replacement.</td></tr>
            <tr><td>Disabled</td><td>Sets the native <code>disabled</code> attribute, so the button is unclickable and skipped by <kbd>Tab</kbd>. Hover and active rules are suppressed.</td></tr>
            <tr><td>Loading</td><td>Adds <code>.ws-btn--loading</code>, renders <code>.ws-btn__spinner</code>, and disables the button so it can't be double-submitted.</td></tr>
            <tr><td>Full width</td><td><code>.ws-btn--full</code> stretches to the container. <code>.ws-btn--half</code> exists for narrow card columns but has no helper option &mdash; pass it through <code>class</code>.</td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">warning</span>
        <span><code>disabled</code> has no effect when <code>href</code> is set &mdash; anchors ignore the attribute, so a "disabled" link button stays clickable. For a disabled navigation action, render a real <code>&lt;button&gt;</code> or omit the control.</span>
    </div>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">A modal footer &mdash; ghost cancel on the left, primary confirm on the right, and the confirm carrying the loading state while the request is in flight. This is the pattern <a href="<?= $ds_base ?>/components/demos/modal-footer.php">Modal Footer</a> encodes, so prefer that component over rebuilding it.</p>
    <div class="ds-card" style="display: flex; justify-content: flex-end; gap: 12px;">
        <?= ws_button('Cancel', ['variant' => 'ghost']) ?>
        <?= ws_button('Save Workshop', ['variant' => 'primary', 'icon' => 'save']) ?>
    </div>
    <div class="ds-code"><pre>&lt;?= ws_button('Cancel', ['variant' => 'ghost', 'attrs' => ['data-close' => '']]) ?&gt;
&lt;?= ws_button('Save Workshop', [
    'variant' => 'primary',
    'icon'    => 'save',
    'type'    => 'submit',
    'loading' => $isSaving,
]) ?&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>$text</code></td><td>string</td><td>&mdash;</td><td>Positional label. Lead with a verb: "Save workshop", not "OK".</td></tr>
            <tr><td><code>variant</code></td><td>string</td><td><code>'primary'</code></td><td><code>primary</code> | <code>secondary</code> | <code>ghost</code> | <code>danger</code></td></tr>
            <tr><td><code>size</code></td><td>string</td><td><code>'md'</code></td><td><code>sm</code> | <code>md</code> | <code>lg</code></td></tr>
            <tr><td><code>icon</code></td><td>string</td><td><code>null</code></td><td>Material icon name</td></tr>
            <tr><td><code>iconPosition</code></td><td>string</td><td><code>'left'</code></td><td><code>left</code> | <code>right</code></td></tr>
            <tr><td><code>href</code></td><td>string</td><td><code>null</code></td><td>Renders an <code>&lt;a&gt;</code> instead of a <code>&lt;button&gt;</code></td></tr>
            <tr><td><code>type</code></td><td>string</td><td><code>'button'</code></td><td><code>button</code> | <code>submit</code> | <code>reset</code>. Set <code>submit</code> explicitly inside forms.</td></tr>
            <tr><td><code>disabled</code></td><td>bool</td><td><code>false</code></td><td>Native disabled state. Ignored when <code>href</code> is set.</td></tr>
            <tr><td><code>loading</code></td><td>bool</td><td><code>false</code></td><td>Shows the spinner and disables the button</td></tr>
            <tr><td><code>fullWidth</code></td><td>bool</td><td><code>false</code></td><td>Stretch to the container width</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>null</code></td><td>Element ID</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra HTML attributes as key/value pairs</td></tr>
        </tbody>
    </table>
    <p class="ds-section-desc"><code class="ds-code-inline">ws_icon_button($icon, $options)</code> is a shorthand for an icon-only ghost button at <code class="ds-code-inline">sm</code>. It passes an empty label, so give it an <code class="ds-code-inline">attrs =&gt; ['aria-label' =&gt; …]</code> &mdash; see below.</p>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Semantics</td><td>Renders a real <code>&lt;button&gt;</code>, or an <code>&lt;a&gt;</code> when <code>href</code> is set. Both are natively focusable and correctly announced &mdash; no ARIA role is added or needed.</td></tr>
            <tr><td>Keyboard</td><td>Native: <kbd>Tab</kbd> to reach, <kbd>Enter</kbd> or <kbd>Space</kbd> to activate a button, <kbd>Enter</kbd> for a link.</td></tr>
            <tr><td>Focus</td><td>Browser default focus ring. It's the sky-blue accent that survived Red Unification precisely because focus visibility outranks brand consistency.</td></tr>
            <tr><td>Disabled</td><td>The native attribute removes the button from the tab order entirely. That's correct for form submission, but means keyboard users get no explanation &mdash; put the reason in adjacent text rather than a <code>title</code>.</td></tr>
            <tr><td>Loading</td><td>The button is disabled while loading, so focus is dropped. If the user activated it from the keyboard, move focus to the result or a status region when the request resolves.</td></tr>
            <tr><td>Icon-only buttons</td><td><strong>Needs your attention.</strong> An icon-only button has no accessible name &mdash; the icon glyph isn't text. Always pass <code>attrs =&gt; ['aria-label' =&gt; 'Delete workshop']</code>. The component does not add one for you.</td></tr>
            <tr><td>Contrast</td><td>Variants pair tested token foreground and background. The ghost variant's resting text is <code>--text-default</code>, not a muted grey, for exactly this reason.</td></tr>
        </tbody>
    </table>
    <div class="ds-code"><pre>&lt;?= ws_icon_button('delete', [
    'variant' => 'danger',
    'attrs'   => ['aria-label' => 'Delete workshop'],
]) ?&gt;</pre></div>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--button-bg-primary</code> / <code>--button-text-primary</code></td><td>Primary fill and label</td></tr>
            <tr><td><code>--button-shadow-primary-hover</code></td><td>Primary hover lift</td></tr>
            <tr><td><code>--phase-color</code> / <code>--phase-color-dark</code> / <code>--phase-color-very-light</code></td><td>Secondary variant theming, set by an ancestor</td></tr>
            <tr><td><code>--brand</code> / <code>--brand-ink</code> / <code>--brand-tint</code></td><td>Fallback when no phase colour is set</td></tr>
            <tr><td><code>--color-error</code> / <code>--color-error-dark</code></td><td>Danger variant</td></tr>
            <tr><td><code>--gray-50</code> / <code>--gray-300</code> / <code>--gray-400</code></td><td>Ghost hover fill, borders, and disabled treatment</td></tr>
            <tr><td><code>--text-default</code> / <code>--text-inverse</code></td><td>Label colours</td></tr>
            <tr><td><code>--text-meta</code> / <code>--text-small</code> / <code>--text-ui</code></td><td>Label type scale across sizes</td></tr>
            <tr><td><code>--icon-lg</code></td><td>The icon, 24px on every page; beside a label it overlaps the padding, so the button keeps its height</td></tr>
            <tr><td><code>--font-body</code> / <code>--font-semibold</code> / <code>--tracking-wide</code></td><td>Face, weight, and letter-spacing</td></tr>
            <tr><td><code>--transition-interactive</code></td><td>Hover and active transitions</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-btn</code></td><td>Base styles, on the <code>&lt;button&gt;</code> or <code>&lt;a&gt;</code></td></tr>
            <tr><td><code>.ws-btn--primary</code></td><td>Primary variant</td></tr>
            <tr><td><code>.ws-btn--secondary</code></td><td>Secondary variant (phase-themed)</td></tr>
            <tr><td><code>.ws-btn--ghost</code></td><td>Ghost variant</td></tr>
            <tr><td><code>.ws-btn--danger</code></td><td>Danger variant</td></tr>
            <tr><td><code>.ws-btn--sm / --md / --lg</code></td><td>Size modifiers</td></tr>
            <tr><td><code>.ws-btn--full</code></td><td>Full width (<code>fullWidth: true</code>)</td></tr>
            <tr><td><code>.ws-btn--half</code></td><td>50% width for narrow card columns &mdash; no helper option, pass via <code>class</code></td></tr>
            <tr><td><code>.ws-btn--loading</code></td><td>Loading state</td></tr>
            <tr><td><code>.ws-btn--icon-only</code></td><td>Icon-only button with no label</td></tr>
            <tr><td><code>.ws-btn__icon</code></td><td>Icon wrapper (either side)</td></tr>
            <tr><td><code>.ws-btn__text</code></td><td>Label wrapper</td></tr>
            <tr><td><code>.ws-btn__spinner</code></td><td>Loading spinner</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_button()</code> and the <code>ws_icon_button()</code> shorthand</td></tr>
            <tr><td><code>includes/components/button.php</code></td><td>Template &mdash; tag selection and class assembly</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-btn</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
