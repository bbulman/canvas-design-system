<?php
$ds_page  = 'components/demos/avatar';
$ds_title = 'Avatar';

require_once __DIR__ . '/../../../includes/icon.php';
require_once __DIR__ . '/../../../includes/components/helpers.php';

require_once __DIR__ . '/../../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<div class="ds-page-header">
    <h1>Avatar</h1>
    <p>Identifies a person, falling back to their initials when there's no photo.</p>
</div>

<!-- 2. When to Use -->
<section class="ds-section">
    <h2 class="ds-section-title">When to Use</h2>
    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Use when:</strong>
            You're representing a specific person &mdash; the header account control, a participant list, a comment author, a facilitator stack. The initials fallback means the layout holds even when nobody has uploaded a photo.
        </div>
        <div class="ds-dont">
            <strong>Don't use when:</strong>
            The subject isn't a person. Use an icon for a generic actor, an <code>&lt;img&gt;</code> for a logo or thumbnail, and <a href="<?= $ds_base ?>/components/demos/badge.php">Badge</a> for a count that happens to sit near people.
        </div>
    </div>
</section>

<!-- 3. Variants -->
<section class="ds-section">
    <h2 class="ds-section-title">Variants</h2>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Sizes</h3>
        <p class="ds-section-desc">Five sizes. <code class="ds-code-inline">xs</code> and <code class="ds-code-inline">sm</code> for dense lists and stacks, <code class="ds-code-inline">md</code> for the default inline case, <code class="ds-code-inline">lg</code> and <code class="ds-code-inline">xl</code> for profile headers.</p>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 16px; align-items: center;">
            <?= ws_avatar('Alice Brown', ['size' => 'xs']) ?>
            <?= ws_avatar('Bob Smith', ['size' => 'sm']) ?>
            <?= ws_avatar('Carol White', ['size' => 'md']) ?>
            <?= ws_avatar('David Lee', ['size' => 'lg']) ?>
            <?= ws_avatar('Eve Johnson', ['size' => 'xl']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_avatar('Alice Brown', ['size' => 'xs']) ?&gt;
&lt;?= ws_avatar('Carol White', ['size' => 'md']) ?&gt;
&lt;?= ws_avatar('Eve Johnson', ['size' => 'xl']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">With an image</h3>
        <p class="ds-section-desc">Passing <code class="ds-code-inline">image</code> replaces the initials. The <code class="ds-code-inline">name</code> is still required &mdash; it becomes the image's alt text.</p>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 16px; align-items: center;">
            <?= ws_avatar('John Doe', ['size' => 'md', 'image' => 'https://i.pravatar.cc/80?img=1']) ?>
            <?= ws_avatar('Jane Smith', ['size' => 'md', 'image' => 'https://i.pravatar.cc/80?img=5']) ?>
            <?= ws_avatar('Alex Johnson', ['size' => 'lg', 'image' => 'https://i.pravatar.cc/120?img=3']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_avatar('John Doe', ['image' => '/uploads/avatars/12.jpg']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Custom colour</h3>
        <p class="ds-section-desc">Overrides the initials background. Use it to encode a stable attribute like team or role &mdash; not to decorate. Contrast against white text is your responsibility once you override.</p>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 16px; align-items: center;">
            <?= ws_avatar('Plan User', ['size' => 'md', 'color' => '#0284C7']) ?>
            <?= ws_avatar('Coach User', ['size' => 'md', 'color' => '#7C4DFF']) ?>
            <?= ws_avatar('Reflect User', ['size' => 'md', 'color' => '#10B981']) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_avatar('Plan User', ['color' => '#0284C7']) ?&gt;</pre></div>
    </div>

    <div class="ds-subsection">
        <h3 class="ds-subsection-title">Ring</h3>
        <p class="ds-section-desc">A surface-coloured ring that separates an avatar from a busy background, or marks the current user in a stack.</p>
        <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 16px; align-items: center;">
            <?= ws_avatar('Ring User', ['size' => 'md', 'ring' => true, 'image' => 'https://i.pravatar.cc/80?img=8']) ?>
            <?= ws_avatar('Ring Initials', ['size' => 'md', 'ring' => true]) ?>
        </div>
        <div class="ds-code"><pre>&lt;?= ws_avatar('User', ['ring' => true]) ?&gt;</pre></div>
    </div>
</section>

<!-- 4. States -->
<section class="ds-section">
    <h2 class="ds-section-title">States</h2>
    <p class="ds-section-desc">The status dot is the only stateful part. It's presentational &mdash; the component never derives it, so the caller supplies the current value.</p>
    <div class="ds-card" style="display: flex; flex-wrap: wrap; gap: 16px; align-items: center;">
        <?= ws_avatar('Online User', ['size' => 'md', 'status' => 'online']) ?>
        <?= ws_avatar('Offline User', ['size' => 'md', 'status' => 'offline']) ?>
        <?= ws_avatar('Busy User', ['size' => 'md', 'status' => 'busy']) ?>
    </div>
    <table class="ds-table">
        <thead><tr><th>State</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>No status</td><td>Default. No dot is rendered at all.</td></tr>
            <tr><td><code>online</code></td><td>Green dot (<code>--color-success</code>), bottom-right, ringed in <code>--bg-surface</code> so it reads against the avatar.</td></tr>
            <tr><td><code>offline</code></td><td>Grey dot (<code>--gray-400</code>).</td></tr>
            <tr><td><code>busy</code></td><td>Red dot (<code>--color-error</code>).</td></tr>
            <tr><td>Image fails to load</td><td>No fallback &mdash; the broken image stays and the initials do <em>not</em> reappear, because the branch is decided server-side. Pass <code>image</code> only when you know the file exists.</td></tr>
        </tbody>
    </table>
    <div class="ds-code"><pre>&lt;?= ws_avatar('User', ['status' => 'online']) ?&gt;
&lt;?= ws_avatar('User', ['status' => 'busy']) ?&gt;</pre></div>
</section>

<!-- 5. Real-World Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Real-World Usage</h2>
    <p class="ds-section-desc">The facilitator stack in the planner's inspector rail: small avatars, overlapped via <code class="ds-code-inline">.ws-avatar-group</code>, with a ring separating each from the one behind it and a status dot on the person currently presenting.</p>
    <div class="ds-card">
        <div class="ws-avatar-group" style="display: flex;">
            <?= ws_avatar('Bill Bulman', ['size' => 'sm', 'ring' => true, 'status' => 'online']) ?>
            <?= ws_avatar('Rita Chen', ['size' => 'sm', 'ring' => true]) ?>
            <?= ws_avatar('Sam Okoro', ['size' => 'sm', 'ring' => true]) ?>
        </div>
    </div>
    <div class="ds-code"><pre>&lt;div class="ws-avatar-group"&gt;
    &lt;?php foreach ($facilitators as $f): ?&gt;
        &lt;?= ws_avatar($f['name'], [
            'size'   => 'sm',
            'ring'   => true,
            'image'  => $f['avatar_url'] ?? null,
            'status' => $f['is_presenting'] ? 'online' : null,
        ]) ?&gt;
    &lt;?php endforeach; ?&gt;
&lt;/div&gt;</pre></div>
</section>

<!-- 6. Options -->
<section class="ds-section">
    <h2 class="ds-section-title">Options</h2>
    <table class="ds-table">
        <thead>
            <tr><th>Option</th><th>Type</th><th>Default</th><th>Purpose</th></tr>
        </thead>
        <tbody>
            <tr><td><code>$name</code></td><td>string</td><td><code>''</code></td><td>Positional and effectively required. Drives the initials, the <code>title</code>, and the image alt text.</td></tr>
            <tr><td><code>image</code></td><td>string</td><td><code>null</code></td><td>Photo URL. When set, the initials branch isn't rendered.</td></tr>
            <tr><td><code>size</code></td><td>string</td><td><code>'md'</code></td><td><code>xs</code> | <code>sm</code> | <code>md</code> | <code>lg</code> | <code>xl</code></td></tr>
            <tr><td><code>color</code></td><td>string</td><td><code>null</code></td><td>Hex background for the initials variant. Emitted as an inline style.</td></tr>
            <tr><td><code>ring</code></td><td>bool</td><td><code>false</code></td><td>Adds the surface-coloured separating ring</td></tr>
            <tr><td><code>status</code></td><td>string</td><td><code>null</code></td><td><code>online</code> | <code>offline</code> | <code>busy</code>. Omit for no dot.</td></tr>
            <tr><td><code>id</code></td><td>string</td><td><code>null</code></td><td>Element ID</td></tr>
            <tr><td><code>class</code></td><td>string</td><td><code>''</code></td><td>Additional CSS classes</td></tr>
            <tr><td><code>attrs</code></td><td>array</td><td><code>[]</code></td><td>Extra HTML attributes as key/value pairs</td></tr>
        </tbody>
    </table>
    <div class="ds-note">
        <span class="material-symbols-outlined">info</span>
        <span>Initials are derived from the first and last whitespace-separated parts of <code>name</code> &mdash; "Bill Bulman" gives BB, a single-word name gives one letter. Names are escaped for the <code>title</code> and <code>alt</code>, but the derived initials are echoed raw; they come from your own data, so keep it that way.</span>
    </div>
</section>

<!-- 7. Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <table class="ds-table">
        <thead><tr><th>Concern</th><th>Behavior</th></tr></thead>
        <tbody>
            <tr><td>Image variant</td><td>The <code>&lt;img&gt;</code> carries <code>alt="{name}"</code>, so screen readers announce the person's name. It also loads lazily.</td></tr>
            <tr><td>Initials variant</td><td>The container's <code>title="{name}"</code> is the only full name available; the visible initials are read as letters. Adequate when the name also appears in adjacent text &mdash; otherwise pair the avatar with a visible label.</td></tr>
            <tr><td>Keyboard</td><td>Not focusable. If you wrap an avatar in a link or button, that wrapper owns the focus treatment &mdash; the ring option is decorative, not a focus indicator.</td></tr>
            <tr><td>Status dot</td><td>Purely visual, with no text equivalent. If presence matters to the task, state it in words nearby rather than relying on the colour of a 8px dot.</td></tr>
            <tr><td>Contrast</td><td>The default initials pairing is token-controlled. A custom <code>color</code> bypasses that check &mdash; verify it against the white initials before shipping.</td></tr>
        </tbody>
    </table>
</section>

<!-- 8. Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Tokens</h2>
    <table class="ds-table">
        <thead><tr><th>Token</th><th>Used for</th></tr></thead>
        <tbody>
            <tr><td><code>--avatar-bg</code></td><td>Default initials background</td></tr>
            <tr><td><code>--brand</code> / <code>--brand-ink</code></td><td>Brand fill and ring accent</td></tr>
            <tr><td><code>--text-inverse</code></td><td>Initials text on the coloured fill</td></tr>
            <tr><td><code>--bg-surface</code></td><td>The ring, and the outline around the status dot</td></tr>
            <tr><td><code>--color-success</code></td><td>Online status dot</td></tr>
            <tr><td><code>--gray-400</code></td><td>Offline status dot</td></tr>
            <tr><td><code>--color-error</code></td><td>Busy status dot</td></tr>
            <tr><td><code>--text-nano</code> / <code>--text-caption</code> / <code>--text-small</code> / <code>--text-h4</code> / <code>--text-h2</code></td><td>Initials size across <code>xs</code>&ndash;<code>xl</code></td></tr>
            <tr><td><code>--font-body</code> / <code>--font-semibold</code></td><td>Initials face and weight</td></tr>
        </tbody>
    </table>
</section>

<!-- 9. CSS Classes -->
<section class="ds-section">
    <h2 class="ds-section-title">CSS Classes</h2>
    <table class="ds-table">
        <thead><tr><th>Class</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>.ws-avatar</code></td><td>Base container</td></tr>
            <tr><td><code>.ws-avatar--xs / --sm / --md / --lg / --xl</code></td><td>Size modifiers</td></tr>
            <tr><td><code>.ws-avatar--ring</code></td><td>Separating ring</td></tr>
            <tr><td><code>.ws-avatar--initials</code></td><td>Emitted whenever no image is supplied &mdash; <strong>currently has no CSS rule</strong>. It's a styling hook you can target, not something that changes the rendering today.</td></tr>
            <tr><td><code>.ws-avatar__image</code></td><td>The <code>&lt;img&gt;</code></td></tr>
            <tr><td><code>.ws-avatar__initials</code></td><td>Initials <code>&lt;span&gt;</code></td></tr>
            <tr><td><code>.ws-avatar__status</code></td><td>Status dot</td></tr>
            <tr><td><code>.ws-avatar__status--online / --offline / --busy</code></td><td>Status dot colours</td></tr>
            <tr><td><code>.ws-avatar-group</code></td><td>Overlapping stack wrapper. Applied by you to a container of avatars &mdash; the helper never emits it.</td></tr>
        </tbody>
    </table>
</section>

<!-- 10. Files -->
<section class="ds-section">
    <h2 class="ds-section-title">Files</h2>
    <table class="ds-table">
        <thead><tr><th>File</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>includes/components/helpers.php</code></td><td><code>ws_avatar()</code> helper function</td></tr>
            <tr><td><code>includes/components/avatar.php</code></td><td>Template &mdash; initials derivation and markup</td></tr>
            <tr><td><code>includes/components/components.css</code></td><td>Styles (<code>.ws-avatar</code> rules)</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../../includes/ds-footer.php'; ?>
