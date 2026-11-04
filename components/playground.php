<?php
require_once __DIR__ . '/../../includes/icon.php';
require_once __DIR__ . '/../../includes/components/helpers.php';
require_once __DIR__ . '/../includes/playground-fixtures.php';
$selection = dsPlaygroundSelection($_GET);
extract($selection, EXTR_SKIP);
$catalog = json_decode(file_get_contents(__DIR__ . '/../components.generated.json'), true);
$metadata = $catalog['components'][$fixture['helper']] ?? [];
$escape = static fn($value) => htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
$isPreview = ($_GET['preview'] ?? '') === '1';
$recipe = $isPreview ? dsRecipeSelection($_GET) : null;
$assetBase = ($_SERVER['HTTP_HOST'] ?? '') === 'canvas.workshopr.io' ? 'https://workshopr.io' : '';
$dsBase = $assetBase ? '' : '/design-system';
$assetVersion = filemtime(__DIR__ . '/../assets/playground.css');
$opensModal = $recipe ? ($recipe['recipe']['previewOpensModal'] ?? null) : ($fixture['opens'] ?? null);
if ($isPreview):
?><!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $recipe ? $escape($recipe['recipe']['title']) . ' preview' : 'Component preview' ?></title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fraunces:wght@400;600;700&amp;family=Inter:wght@400;500;600;700&amp;family=Material+Symbols+Outlined&amp;display=swap">
<link rel="stylesheet" href="<?= $assetBase ?>/design-system/platform-tokens.css">
<link rel="stylesheet" href="<?= $assetBase ?>/includes/components/components.css">
<link rel="stylesheet" href="<?= $dsBase ?>/assets/playground.css?v=<?= $assetVersion ?>">
<?php if ($recipe): ?><link rel="stylesheet" href="<?= $dsBase ?>/assets/recipes.css?v=<?= filemtime(__DIR__ . '/../assets/recipes.css') ?>"><?php endif; ?>
</head><body class="ds-playground-preview" data-preview-kind="<?= $recipe ? 'recipe' : ($auto ? 'auto' : 'curated') ?>"><?php if (!$recipe && $auto): ?>
<p class="ds-playground-auto-note"><?= ws_badge('Auto preview', ['size' => 'sm']) ?> Built from the catalog signature, not a curated fixture.</p>
<?php endif; ?><main id="component-preview">
<?php
if ($recipe) {
    echo dsRenderRecipe($recipe['recipe']['id'], $recipe['state']);
} else {
    echo dsPlaygroundRender($selection);
}
?>
</main><script src="<?= $assetBase ?>/includes/components/components.js?v=<?= filemtime(__DIR__ . '/../../includes/components/components.js') ?>"></script>
<?php if (!$recipe && ($script = dsPlaygroundScript($fixture))): ?><script src="<?= $assetBase ?>/<?= $script ?>?v=<?= filemtime(__DIR__ . '/../../' . $script) ?>"></script><?php endif; ?>
<?php if ($opensModal): ?>
<script>
(function (id) {
    if (window.self === window.top) { wsModalOpen(id); return; }
    // Framed on composition.php: moving focus into the frame would scroll that page to it.
    var overlay = document.getElementById(id + '-overlay');
    if (overlay) overlay.classList.add('is-open');
})(<?= json_encode($opensModal) ?>);
</script>
<?php endif; ?>
<?php if (!$recipe && ($toasts = dsPlaygroundToasts($selection))): ?>
<script>
(function (toasts) {
    toasts.forEach(function (t) {
        // Held on screen so the preview and its screenshot show them; a real toast leaves after four seconds.
        var options = { duration: 600000 };
        if (t[2]) options.action = { label: t[2], onClick: function () {} };
        wsToast(t[0], t[1], options);
    });
})(<?= json_encode($toasts, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>);
</script>
<?php endif; ?>
</body></html>
<?php exit; endif;
$ds_page = 'components/playground';
$ds_title = 'Component playground';
require __DIR__ . '/../includes/ds-header.php';
$previewQuery = http_build_query(array_merge($_GET, ['component' => $key, 'state' => $state, 'preview' => '1']));
$textSlot = $fixture['text'] ?? null;
$demo = is_string($metadata['demo'] ?? null) && str_starts_with($metadata['demo'], '/design-system/') ? $ds_base . substr($metadata['demo'], strlen('/design-system')) : null;
?>
<link rel="stylesheet" href="<?= $ds_base ?>/assets/playground.css?v=<?= $assetVersion ?>">
<div class="ds-page-header"><h1>Component playground</h1><p>Choose a component, try its states, and copy the PHP that renders it. Components marked auto have no curated fixture yet: the playground builds their call from the catalog.</p></div>
<div class="ds-playground">
<section aria-labelledby="choose-component">
<h2 id="choose-component">Choose a component</h2>
<form method="get">
<?= ws_input('component', ['type' => 'select', 'label' => 'Component', 'value' => $key, 'options' => array_map(static fn($value, $label) => ['value' => $value, 'label' => $label], array_keys(dsPlaygroundKeys()), dsPlaygroundKeys())]) ?>
<?= ws_button('Choose component', ['type' => 'submit', 'variant' => 'secondary']) ?>
</form>
<h2>Try a state</h2>
<div class="ds-playground__states">
<?php foreach ($fixture['states'] as $name => $unused): ?>
<?= ws_button(ucfirst(str_replace('-', ' ', $name)), ['variant' => 'ghost', 'href' => '?' . http_build_query(['component' => $key, 'state' => $name]), 'attrs' => $state === $name ? ['aria-current' => 'true'] : []]) ?>
<?php endforeach; ?>
</div>
<form method="get" class="ds-playground__controls">
<input type="hidden" name="component" value="<?= $escape($key) ?>">
<input type="hidden" name="state" value="<?= $escape($state) ?>">
<?php if ($textSlot !== null): ?>
<?= ws_input('text', ['label' => 'Preview text', 'value' => html_entity_decode(strip_tags((string) $args[$textSlot]), ENT_QUOTES, 'UTF-8')]) ?>
<?php endif; ?>
<?php foreach ($options ?? [] as $name => $value):
if ($name === 'id') continue;
if (is_bool($value)) $control = ['type' => 'select', 'value' => $value ? '1' : '0', 'options' => [['value' => '0', 'label' => 'No'], ['value' => '1', 'label' => 'Yes']]];
elseif (isset($fixture['choices'][$name])) $control = ['type' => 'select', 'value' => $value, 'options' => array_map(static fn($choice) => ['value' => $choice, 'label' => ucfirst($choice)], $fixture['choices'][$name])];
elseif (is_string($value) && in_array($name, $fixture['editable'] ?? [], true)) $control = ['value' => $value];
else continue;
echo ws_input($name, ['label' => ucfirst($name)] + $control);
endforeach; ?>
<?= ws_button('Update preview', ['type' => 'submit']) ?>
</form>
</section>
<section aria-labelledby="preview-heading">
<h2 id="preview-heading">Preview</h2>
<?php if ($auto): ?>
<p class="ds-playground__auto"><?= ws_badge('Auto preview', ['size' => 'sm']) ?> Not a curated fixture. The call is built from the catalog signature, the option defaults and the literal arguments of the documented example, so read the demo before you copy it.</p>
<?php endif; ?>
<p>Uses the production component. Open it separately to test at any browser width.</p>
<iframe class="ds-playground__frame" title="Live component preview" src="?<?= $escape($previewQuery) ?>"></iframe>
<p><a href="?<?= $escape($previewQuery) ?>" target="_blank" rel="noopener">Open isolated preview</a></p>
<h2>Use this component</h2>
<p><?= $escape($metadata['whenToUse'] ?? '') ?></p>
<p><strong>Avoid:</strong> <?= $escape($metadata['whenNotToUse'] ?? '') ?></p>
<?php if ($demo): ?>
<p><a href="<?= $escape($demo) ?>">Full usage and accessibility guidance</a></p>
<?php endif; ?>
<?= ws_button('Copy PHP', ['variant' => 'secondary', 'id' => 'copy-component-code']) ?>
<p id="copy-status" role="status"></p>
<pre class="ds-playground__code" tabindex="0" aria-label="PHP example"><code id="component-code"><?= $escape(dsPlaygroundCode($selection)) ?></code></pre>
</section>
</div>
<script src="<?= $ds_base ?>/assets/playground.js?v=<?= filemtime(__DIR__ . '/../assets/playground.js') ?>"></script>
<?php require __DIR__ . '/../includes/ds-footer.php'; ?>
