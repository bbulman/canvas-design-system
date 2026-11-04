<?php
$ds_page  = 'patterns/composition';
$ds_title = 'Composition Examples';

require_once __DIR__ . '/../../includes/icon.php';
require_once __DIR__ . '/../../includes/components/helpers.php';
require_once __DIR__ . '/../includes/playground-fixtures.php';

$recipes = dsRecipes();
$shown = dsRecipeSelection($_GET);
$catalog = json_decode((string) file_get_contents(__DIR__ . '/../components.generated.json'), true);
$escape = static fn($value) => htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');

require_once __DIR__ . '/../includes/ds-header.php';
?>
<link rel="stylesheet" href="<?= $ds_base ?>/assets/recipes.css?v=<?= filemtime(__DIR__ . '/../assets/recipes.css') ?>">

<div class="ds-page-header">
    <h1>Composition Examples</h1>
    <p>Screen recipes first: whole screens built from real components, each with its loading, empty and error states. Then smaller pairs of components that often sit together. Every example renders the production helpers from fixture data, and the layout classes come from <code class="ds-code-inline">recipes.css</code>, which uses tokens only.</p>
</div>

<!-- Screen recipes -->
<section class="ds-section" aria-labelledby="screen-recipes">
    <h2 class="ds-section-title" id="screen-recipes">Screen recipes</h2>
    <p class="ds-section-desc">Start here when you are building a page rather than one component. <code class="ds-code-inline">npm run ds:find -- "a page listing workshops with filters"</code> and the enforcer's <code class="ds-code-inline">suggest_component</code> return these for screen-level requests. Each state has its own preview address, so you can open it alone and resize the window.</p>
</section>

<?php foreach ($recipes as $id => $recipe):
    $state = ($shown && $shown['recipe']['id'] === $id) ? $shown['state'] : 'default';
    // On canvas.workshopr.io the web root is design-system/, so the path loses that prefix (as playground.php does).
    $preview = $ds_base . substr(dsRecipePreviewUrl($id, $state), strlen('/design-system'));
?>
<section class="ds-section" id="recipe-<?= $escape($id) ?>" aria-labelledby="recipe-<?= $escape($id) ?>-title">
    <h2 class="ds-section-title" id="recipe-<?= $escape($id) ?>-title"><?= $escape($recipe['title']) ?></h2>
    <p class="ds-section-desc"><?= $escape($recipe['whenToUse']) ?></p>

    <nav class="ds-recipe-states" aria-label="<?= $escape($recipe['title']) ?> states">
        <?php foreach ($recipe['states'] as $name): ?>
            <?= ws_button(ucfirst($name), [
                'variant' => $name === $state ? 'secondary' : 'ghost',
                'size' => 'sm',
                'href' => '?' . http_build_query(['recipe' => $id, 'state' => $name]) . '#recipe-' . $id,
                'attrs' => $name === $state ? ['aria-current' => 'true'] : [],
            ]) ?>
        <?php endforeach; ?>
    </nav>

    <div class="ds-demo-recipe">
        <iframe class="ds-recipe-frame" src="<?= $escape($preview) ?>" title="<?= $escape($recipe['title'] . ', ' . $state . ' state') ?>" loading="lazy"></iframe>
    </div>
    <p><a href="<?= $escape($preview) ?>" target="_blank" rel="noopener">Open the <?= $escape($state) ?> state on its own</a> to try it at any width.</p>

    <div class="ds-recipe-meta">
        <div>
            <h3 class="ds-subsection-title">Why these components</h3>
            <p><?= $escape($recipe['why']) ?></p>
        </div>
        <div>
            <h3 class="ds-subsection-title">On mobile</h3>
            <p><?= $escape($recipe['mobile']) ?></p>
        </div>
    </div>

    <h3 class="ds-subsection-title">Components used</h3>
    <?php ws_cluster_start(['gap' => '2']) ?>
        <?php foreach ($recipe['components'] as $name):
            $demo = $catalog['components'][$name]['demo'] ?? null; ?>
            <?php if ($demo): ?><a href="<?= $escape($demo) ?>"><code class="ds-code-inline"><?= $escape($name) ?>()</code></a><?php else: ?><code class="ds-code-inline"><?= $escape($name) ?>()</code><?php endif; ?>
        <?php endforeach; ?>
    <?php ws_cluster_end() ?>

    <h3 class="ds-subsection-title">PHP</h3>
    <p class="ds-section-desc">The whole recipe file, <code class="ds-code-inline">design-system/recipes/<?= $escape($id) ?>.php</code>. Swap the fixture arrays for the caller's own records and keep the four states.</p>
    <div class="ds-code"><pre><?= $escape(file_get_contents(dsRecipeFile($id))) ?></pre></div>
</section>
<?php endforeach; ?>

<!-- Component pairs -->
<section class="ds-section" aria-labelledby="component-pairs">
    <h2 class="ds-section-title" id="component-pairs">Component pairs</h2>
    <p class="ds-section-desc">Smaller combinations that recur inside screens. Each renders the real helpers; copy the PHP beneath it.</p>
</section>

<!-- Card + Avatar + Badge -->
<section class="ds-section">
    <h2 class="ds-section-title">Card + Avatar + Badge</h2>
    <p class="ds-section-desc">A user profile or team member card. A category badge takes its colour from the category's own record; with none it stays neutral.</p>

    <div class="ds-card">
        <?php ws_card_start(['variant' => 'content', 'bordered' => true]); ?>
            <div class="ds-recipe-person">
                <?= ws_avatar('Jane Doe', ['size' => 'md']) ?>
                <div class="ds-recipe-person__text">
                    <p class="ds-recipe-person__name">Jane Doe</p>
                    <p class="ds-recipe-person__role">Lead Facilitator</p>
                </div>
                <?= ws_status('Active', 'success') ?>
            </div>
            <?php ws_cluster_start(['gap' => '2']) ?>
                <?= ws_category('Design Sprint') ?>
                <?= ws_category('Retro') ?>
                <?= ws_duration('120+ hours') ?>
            <?php ws_cluster_end() ?>
        <?php ws_card_end(); ?>
    </div>

    <div class="ds-code"><pre>&lt;?php ws_card_start(['variant' =&gt; 'content', 'bordered' =&gt; true]); ?&gt;
  &lt;div class="ds-recipe-person"&gt;
    &lt;?= ws_avatar('Jane Doe', ['size' =&gt; 'md']) ?&gt;
    &lt;div class="ds-recipe-person__text"&gt;
      &lt;p class="ds-recipe-person__name"&gt;Jane Doe&lt;/p&gt;
      &lt;p class="ds-recipe-person__role"&gt;Lead Facilitator&lt;/p&gt;
    &lt;/div&gt;
    &lt;?= ws_status('Active', 'success') ?&gt;
  &lt;/div&gt;
  &lt;?php ws_cluster_start(['gap' =&gt; '2']) ?&gt;
    &lt;?= ws_category('Design Sprint') ?&gt;
    &lt;?= ws_category('Retro') ?&gt;
    &lt;?= ws_duration('120+ hours') ?&gt;
  &lt;?php ws_cluster_end() ?&gt;
&lt;?php ws_card_end(); ?&gt;</pre></div>
</section>

<!-- Section Header + Feature Cards -->
<section class="ds-section">
    <h2 class="ds-section-title">Section Header + Feature Cards</h2>
    <p class="ds-section-desc">A feature/benefits section on a landing page.</p>

    <div class="ds-card">
        <?php ws_stack_start(['gap' => '6']) ?>
            <?= ws_section_header('Everything you need to run', [
                'subtitle' => 'world-class workshops.',
                'description' => 'Plan the agenda, run the room and keep what happened, in one place.',
            ]) ?>
            <?php ws_grid_start() ?>
                <?= ws_feature_card('Curated library', 'Browse workshops, exercises and icebreakers.', ['icon' => 'menu_book']) ?>
                <?= ws_feature_card('Agenda planner', 'Drag activities into a timed agenda with breaks.', ['icon' => 'calendar_month']) ?>
                <?= ws_feature_card('Live facilitation', 'Run the session with timers and participant reactions.', ['icon' => 'groups']) ?>
            <?php ws_grid_end() ?>
        <?php ws_stack_end() ?>
    </div>

    <div class="ds-code"><pre>&lt;?php ws_stack_start(['gap' =&gt; '6']) ?&gt;
  &lt;?= ws_section_header('Everything you need to run', [
      'subtitle' =&gt; 'world-class workshops.',
      'description' =&gt; 'Plan the agenda, run the room and keep what happened, in one place.',
  ]) ?&gt;
  &lt;?php ws_grid_start() ?&gt;
    &lt;?= ws_feature_card('Curated library', 'Browse workshops, exercises and icebreakers.', ['icon' =&gt; 'menu_book']) ?&gt;
    &lt;?= ws_feature_card('Agenda planner', 'Drag activities into a timed agenda with breaks.', ['icon' =&gt; 'calendar_month']) ?&gt;
    &lt;?= ws_feature_card('Live facilitation', 'Run the session with timers and participant reactions.', ['icon' =&gt; 'groups']) ?&gt;
  &lt;?php ws_grid_end() ?&gt;
&lt;?php ws_stack_end() ?&gt;</pre></div>
</section>

<!-- Alert + Form -->
<section class="ds-section">
    <h2 class="ds-section-title">Alert + Form Fields</h2>
    <p class="ds-section-desc">A form with a validation error. The alert says the submit failed; the field's own error says why. <code class="ds-code-inline">ws_input</code> carries its label and error wiring, so it needs no <code class="ds-code-inline">ws_form_row</code> around it.</p>

    <div class="ds-card">
        <?php ws_stack_start(['tag' => 'form', 'gap' => '5', 'attrs' => ['action' => '#', 'method' => 'post']]) ?>
            <?= ws_alert('Fix the highlighted field, then submit again.', ['variant' => 'error', 'title' => 'Check the form']) ?>
            <?= ws_input('comp-name', ['label' => 'Name', 'placeholder' => 'Your name', 'required' => true, 'autocomplete' => 'name']) ?>
            <?= ws_input('comp-email', [
                'type' => 'email',
                'label' => 'Email',
                'value' => 'you@example',
                'required' => true,
                'autocomplete' => 'email',
                'error' => 'Enter an email address like name@example.com.',
            ]) ?>
            <?php ws_cluster_start() ?>
                <?= ws_button('Submit', ['type' => 'submit']) ?>
            <?php ws_cluster_end() ?>
        <?php ws_stack_end() ?>
    </div>

    <div class="ds-code"><pre>&lt;?php ws_stack_start(['tag' =&gt; 'form', 'gap' =&gt; '5', 'attrs' =&gt; ['method' =&gt; 'post']]) ?&gt;
  &lt;?= ws_alert('Fix the highlighted field, then submit again.', ['variant' =&gt; 'error', 'title' =&gt; 'Check the form']) ?&gt;
  &lt;?= ws_input('name', ['label' =&gt; 'Name', 'required' =&gt; true, 'autocomplete' =&gt; 'name']) ?&gt;
  &lt;?= ws_input('email', [
      'type' =&gt; 'email', 'label' =&gt; 'Email', 'required' =&gt; true, 'autocomplete' =&gt; 'email',
      'error' =&gt; 'Enter an email address like name@example.com.',
  ]) ?&gt;
  &lt;?php ws_cluster_start() ?&gt;
    &lt;?= ws_button('Submit', ['type' =&gt; 'submit']) ?&gt;
  &lt;?php ws_cluster_end() ?&gt;
&lt;?php ws_stack_end() ?&gt;</pre></div>
</section>

<!-- Breadcrumb + Section Header -->
<section class="ds-section">
    <h2 class="ds-section-title">Breadcrumb + Section Header</h2>
    <p class="ds-section-desc">Detail page intro pattern.</p>

    <div class="ds-card">
        <?php ws_stack_start(['gap' => '5']) ?>
            <?= ws_breadcrumb([
                ['label' => 'Home', 'href' => '/'],
                ['label' => 'Workshops', 'href' => '/library/workshops/'],
                ['label' => 'Design Sprint'],
            ]) ?>
            <?= ws_section_header('Design Sprint', [
                'subtitle' => 'by Jake Knapp',
                'description' => 'A 5-day process for answering critical business questions through design, prototyping, and testing.',
                'align' => 'left',
            ]) ?>
            <?php ws_cluster_start(['gap' => '2']) ?>
                <?= ws_category('Strategy') ?>
                <?= ws_duration('5 days') ?>
                <?= ws_status('Popular', 'success') ?>
            <?php ws_cluster_end() ?>
        <?php ws_stack_end() ?>
    </div>

    <div class="ds-code"><pre>&lt;?php ws_stack_start(['gap' =&gt; '5']) ?&gt;
  &lt;?= ws_breadcrumb([
      ['label' =&gt; 'Home', 'href' =&gt; '/'],
      ['label' =&gt; 'Workshops', 'href' =&gt; '/library/workshops/'],
      ['label' =&gt; 'Design Sprint'],
  ]) ?&gt;
  &lt;?= ws_section_header('Design Sprint', [
      'subtitle' =&gt; 'by Jake Knapp',
      'description' =&gt; 'A 5-day process for answering critical business questions.',
      'align' =&gt; 'left',
  ]) ?&gt;
  &lt;?php ws_cluster_start(['gap' =&gt; '2']) ?&gt;
    &lt;?= ws_category('Strategy') ?&gt;
    &lt;?= ws_duration('5 days') ?&gt;
    &lt;?= ws_status('Popular', 'success') ?&gt;
  &lt;?php ws_cluster_end() ?&gt;
&lt;?php ws_stack_end() ?&gt;</pre></div>
</section>

<!-- Empty State + Button -->
<section class="ds-section">
    <h2 class="ds-section-title">Empty State + Action</h2>
    <p class="ds-section-desc">When a list has no results.</p>

    <div class="ds-card">
        <?= ws_empty_state('No workshops match “retro”', [
            'description' => 'Check the spelling, or search for one word from the name.',
            'icon' => 'search_off',
            'action' => 'Show all workshops',
            'actionHref' => '/library/workshops/',
            'actionVariant' => 'secondary',
        ]) ?>
    </div>

    <div class="ds-code"><pre>&lt;?= ws_empty_state('No workshops match “' . $q . '”', [
    'description' =&gt; 'Check the spelling, or search for one word from the name.',
    'icon' =&gt; 'search_off',
    'action' =&gt; 'Show all workshops',
    'actionHref' =&gt; '/library/workshops/',
    'actionVariant' =&gt; 'secondary',
]) ?&gt;</pre></div>
</section>

<!-- Tabs + Card Content -->
<section class="ds-section">
    <h2 class="ds-section-title">Tabs + Content Panels</h2>
    <p class="ds-section-desc"><code class="ds-code-inline">ws_tabs</code> renders the tab row only. Give each panel <code class="ds-code-inline">id="{tab id}-panel"</code> and the <code class="ds-code-inline">ws-tab-pane</code> class; <code class="ds-code-inline">components.js</code> moves <code class="ds-code-inline">is-active</code> between them.</p>

    <div class="ds-card">
        <?= ws_tabs([
            ['id' => 'comp-overview', 'label' => 'Overview', 'active' => true],
            ['id' => 'comp-agenda', 'label' => 'Agenda'],
            ['id' => 'comp-notes', 'label' => 'Notes', 'count' => 3],
        ], ['variant' => 'underline', 'id' => 'comp-tabs']) ?>
        <div class="ws-tab-pane is-active" id="comp-overview-panel" role="tabpanel" aria-label="Overview">
            <?= ws_card('<p>A two-hour session to agree the quarter\'s priorities.</p>', ['variant' => 'content']) ?>
        </div>
        <div class="ws-tab-pane" id="comp-agenda-panel" role="tabpanel" aria-label="Agenda">
            <?= ws_card('<p>Warm-up, context, three decision rounds, wrap-up.</p>', ['variant' => 'content']) ?>
        </div>
        <div class="ws-tab-pane" id="comp-notes-panel" role="tabpanel" aria-label="Notes">
            <?= ws_card('<p>Three notes from the last run.</p>', ['variant' => 'content']) ?>
        </div>
    </div>

    <div class="ds-code"><pre>&lt;?= ws_tabs([
    ['id' =&gt; 'overview', 'label' =&gt; 'Overview', 'active' =&gt; true],
    ['id' =&gt; 'agenda',   'label' =&gt; 'Agenda'],
    ['id' =&gt; 'notes',    'label' =&gt; 'Notes', 'count' =&gt; 3],
], ['variant' =&gt; 'underline']) ?&gt;

&lt;div class="ws-tab-pane is-active" id="overview-panel" role="tabpanel" aria-label="Overview"&gt;
  &lt;?= ws_card('&lt;p&gt;Workshop overview content...&lt;/p&gt;', ['variant' =&gt; 'content']) ?&gt;
&lt;/div&gt;
&lt;div class="ws-tab-pane" id="agenda-panel" role="tabpanel" aria-label="Agenda"&gt;
  &lt;?= ws_card('&lt;p&gt;Agenda timeline...&lt;/p&gt;', ['variant' =&gt; 'content']) ?&gt;
&lt;/div&gt;</pre></div>
</section>

<!-- Stats + Checklist -->
<section class="ds-section">
    <h2 class="ds-section-title">Stats + Checklist</h2>
    <p class="ds-section-desc">Marketing social proof section. A stat's <code class="ds-code-inline">color</code> takes a token, never a hex.</p>

    <div class="ds-card">
        <div class="ds-recipe-split">
            <?= ws_stats([
                ['value' => '50+', 'label' => 'Workshops', 'color' => 'var(--brand-ink)'],
                ['value' => '120+', 'label' => 'Exercises', 'color' => 'var(--brand-ink)'],
            ]) ?>
            <?= ws_checklist([
                'Pre-built agendas for every session',
                'A library of exercises and icebreakers',
                'Timers and run mode for the live session',
                'Free to get started',
            ]) ?>
        </div>
    </div>

    <div class="ds-code"><pre>&lt;div class="ds-recipe-split"&gt;
  &lt;?= ws_stats([
      ['value' =&gt; '50+', 'label' =&gt; 'Workshops', 'color' =&gt; 'var(--brand-ink)'],
      ['value' =&gt; '120+', 'label' =&gt; 'Exercises', 'color' =&gt; 'var(--brand-ink)'],
  ]) ?&gt;
  &lt;?= ws_checklist([
      'Pre-built agendas for every session',
      'A library of exercises and icebreakers',
      'Timers and run mode for the live session',
      'Free to get started',
  ]) ?&gt;
&lt;/div&gt;</pre></div>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
