<?php
/**
 * Workshopr\DS component library — loads every portable PHP component.
 *
 *   require_once __DIR__ . '/index.php';
 *   echo Workshopr\DS\button('Save', ['variant' => 'primary']);
 */
require_once __DIR__ . '/_icon.php';
foreach (glob(__DIR__ . '/*.php') as $__ws_component) {
    if (basename($__ws_component) === 'index.php') continue;
    require_once $__ws_component;
}
unset($__ws_component);
