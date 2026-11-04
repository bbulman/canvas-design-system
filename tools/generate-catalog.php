<?php
/**
 * generate-catalog.php: derive the agent contract for the design system from source.
 *
 * components.generated.json is the one file every agent tool reads (ds:find, the
 * design-system-enforcer MCP, the playground). It is generated, never hand-edited:
 *
 *   components  every ws_* function: helpers.php (scope "component"), the other
 *               includes/components/*.php files (scope "page") and
 *               app/includes/workshop-list.php (scope "app-local"). Each carries
 *               its signature, summary, option names and an optionSpec of
 *               values and defaults, the demo path, whether the playground has a
 *               fixture, derivable states, and usage extracted from the demo
 *               (or, where the demo is silent, from @whenToUse / @whenNotToUse /
 *               @example / @a11y tags in the function's docblock), the
 *               @insteadOf alternatives, and the playground preview: previewKind
 *               is "curated" (a hand-written fixture), "auto" (the playground
 *               builds the call from this entry) or "none", with previewSkip
 *               saying why.
 *   tokens      every custom property in platform-tokens.css with its value,
 *               purpose (inline or preceding comment), group (section banner),
 *               tier (brand | semantic | primitive | alias) and, for an alias
 *               of the brand reds, the --brand* token to `use` instead.
 *   legacy      the hand-curated legacy-patterns.json: lookalikes to avoid and
 *               what replaces them. A drift check cannot see these.
 *   recipes     recipes.json: whole screens (design-system/recipes/<id>.php) with
 *               the helpers each one calls, its states and a preview URL per state.
 *
 * Option values: the template's declaration (`a|b|c (default: x)` or an inline
 * `// a | b | c` beside `$x['key'] ?? 'x'`) and the curated workshopr-design-system.json
 * are only candidate lists. When the template renders an option into a class or a
 * data attribute, a value is valid only if includes/components/components.css has a
 * rule for the class that option renders (not one another option renders, and not
 * inside :not()), the template branches on it with its own markup, or it is the
 * template default (the base class draws that look). Every candidate that fails,
 * every valid value one list omits, and every default the two disagree on is listed
 * in meta.optionConflicts, and --check fails while that list is not empty. An option
 * that renders no class (ws_input's type) must simply read the same in both lists.
 * A positional argument passed straight into an option (ws_status's $status) gets
 * that option's values on its `params` entry.
 *
 * Modes:
 *   php design-system/tools/generate-catalog.php             Write components.generated.json
 *   php design-system/tools/generate-catalog.php --check     Fail (exit 1) if the file is stale, a curated
 *                                                       signature drifted, an option value conflicts,
 *                                                       or the completeness ratchet in catalog-baseline.json moved
 *   php design-system/tools/generate-catalog.php --baseline  Rewrite catalog-baseline.json from today's gaps
 */

$root       = dirname(__DIR__, 2);
$helpers    = $root . '/includes/components/helpers.php';
$outPath    = dirname(__DIR__) . '/components.generated.json';
$curated    = dirname(__DIR__) . '/workshopr-design-system.json';
$tokensPath = dirname(__DIR__) . '/platform-tokens.css';
$legacyPath = dirname(__DIR__) . '/legacy-patterns.json';
$recipesPath = dirname(__DIR__) . '/recipes.json';
$basePath   = getenv('DS_CATALOG_BASELINE') ?: dirname(__DIR__) . '/baselines/catalog-baseline.json';  // override lets a test prove the ratchet on a copy
$fixtures   = dirname(__DIR__) . '/includes/playground-fixtures.php';
$check      = in_array('--check', $argv, true);
$rebase     = in_array('--baseline', $argv, true);

foreach ([$helpers, $tokensPath, $legacyPath] as $required) {
    if (!is_readable($required)) {
        fwrite(STDERR, "FATAL: cannot read $required\n");
        exit(2);
    }
}

$demoDir = dirname(__DIR__) . '/components/demos';

/** Strip HTML to readable text, keeping link text and decoding entities. */
function ds_clean(string $html): string {
    $t = preg_replace('/<\?.*?\?>/s', '', $html);             // strip PHP tags first (demos are templates)
    $t = preg_replace('/<a\b[^>]*>(.*?)<\/a>/is', '$1', $t);  // keep link text, drop href
    $t = strip_tags($t);
    $t = html_entity_decode($t, ENT_QUOTES | ENT_HTML5);
    return trim(preg_replace('/\s+/', ' ', $t));
}

/**
 * A demo's Concern/Behavior table as "Concern: behavior" lines. The header row (every
 * cell a <th>) is dropped; a body row may still lead with <th scope="row">.
 */
function ds_a11y_rows(string $table): string {
    $lines = [];
    preg_match_all('/<tr\b[^>]*>(.*?)<\/tr>/is', $table, $rows);
    foreach ($rows[1] as $row) {
        if (!preg_match('/<td\b/i', $row)) continue;
        preg_match_all('/<t[hd]\b[^>]*>(.*?)<\/t[hd]>/is', $row, $cells);
        $cells = array_map('ds_clean', $cells[1]);
        $concern = array_shift($cells) ?? '';
        $behavior = trim(implode(' ', array_filter($cells, fn($c) => $c !== '')));
        $line = $concern !== '' && $behavior !== '' ? "$concern: $behavior" : $concern . $behavior;
        if ($line !== '') $lines[] = $line;
    }
    return $lines ? implode("\n", $lines) : ds_clean($table);
}

/** First canonical call ws_name( ... ) in a page, tolerating one nested paren level. */
function ds_example(string $name, string $html): ?string {
    if (preg_match('/(?<![a-z0-9_])' . preg_quote($name, '/') . '\((?:[^()]|\([^()]*\))*\)/s', $html, $mm)) {
        return '<?= ' . trim(preg_replace('/\s+/', ' ', $mm[0])) . ' ?>';
    }
    return null;
}

/**
 * Usage guidance + a canonical example for a ws_* function from its demo page.
 *
 * A demo named after the function owns its usage text. A page found only because
 * it calls the function (nav.php renders ws_header) contributes the demo path and
 * the example, never the usage blocks, which describe that page's own component.
 */
function ds_extract_demo(string $name, string $demoDir, string $root): array {
    $base = substr($name, 3); // drop "ws_"
    $candidates = [
        $demoDir . '/' . str_replace('_', '-', $base) . '.php', // section_header -> section-header.php
        $demoDir . '/' . explode('_', $base)[0] . '.php',       // card_start -> card.php
    ];
    $out = ['demo' => null, 'example' => null, 'whenToUse' => null, 'whenNotToUse' => null, 'a11y' => null];
    $file = null;
    foreach ($candidates as $c) { if (is_readable($c)) { $file = $c; break; } }

    if ($file === null) {
        // The page that calls it most is the one demonstrating it.
        $best = null; $bestHits = 0;
        $sitePages = [];
        foreach (['', '/getting-started', '/foundations', '/apps', '/components', '/patterns', '/resources'] as $sub) {
            $sitePages = array_merge($sitePages, glob(dirname($demoDir, 2) . $sub . '/*.php') ?: []);
        }
        usort($sitePages, fn($a, $b) => strcmp(basename($a), basename($b)));  // the flat folder's order, so a tie picks the same page
        $pages = array_merge(glob($demoDir . '/*.php') ?: [], $sitePages);
        foreach ($pages as $page) {
            // A history log quotes calls, and the review page lays itself out with them: neither demonstrates them.
            if (preg_match('/ \d+\.php$/', $page) || in_array(basename($page), ['changelog.php', 'review.php'], true)) continue;
            $hits = preg_match_all('/(?<![a-z0-9_])' . preg_quote($name, '/') . '\(/', file_get_contents($page));
            if ($hits > $bestHits) { $best = $page; $bestHits = $hits; }
        }
        if ($best !== null) {
            $out['demo'] = '/' . substr($best, strlen($root) + 1);
            // Prose on a guide page names calls like ws_stats() or ws_icon_button($icon, $options);
            // only a call with literal arguments shows how to use it.
            $example = ds_example($name, file_get_contents($best));
            if ($example !== null && preg_match('/\((?=[^)]*[\'"\[0-9])/', $example)) $out['example'] = $example;
        }
        return $out;
    }

    $html = file_get_contents($file);
    $out['demo'] = '/' . substr($file, strlen($root) + 1);
    // "When to Use" do / don't blocks (the trailing '"' avoids matching ds-do-dont).
    if (preg_match('/class="ds-do"\s*>(.*?)<\/div>/is', $html, $mm)) {
        $t = ds_clean(preg_replace('/^.*?<\/strong>/is', '', $mm[1]));
        if ($t !== '') $out['whenToUse'] = $t;
    }
    if (preg_match('/class="ds-dont"\s*>(.*?)<\/div>/is', $html, $mm)) {
        $t = ds_clean(preg_replace('/^.*?<\/strong>/is', '', $mm[1]));
        if ($t !== '') $out['whenNotToUse'] = $t;
    }
    // First block under an "Accessibility" section heading — a <p> OR a <table>.
    // Most demos document accessibility as a Concern/Behavior table rather than
    // prose; matching only <p> silently dropped 42 of them, so the machine
    // catalog reported 11/66 coverage against a real 53/57. A table becomes one
    // "Concern: behavior" line per row: flattened whole, it read
    // "ConcernBehavior ARIANone applied", and no rule kept its concern.
    // An intro paragraph before the table is kept with it: taking the first block
    // alone dropped the table from ten entries, ws_toggle's role rules among them.
    if (preg_match('/ds-section-title"\s*>\s*Accessibility\s*<\/h2>\s*(?:<p[^>]*>(.*?)<\/p>)?\s*(?:<table[^>]*>(.*?)<\/table>)?/is', $html, $mm)) {
        $t = trim(ds_clean($mm[1] ?? '') . "\n" . ds_a11y_rows($mm[2] ?? ''));
        if ($t !== '') $out['a11y'] = $t;
    }
    $out['example'] = ds_example($name, $html);
    return $out;
}

/** The body of the function whose `function` keyword starts at $offset, braces balanced. */
function ds_function_body(string $src, int $offset): string {
    $open = strpos($src, '{', $offset);
    if ($open === false) return '';
    $depth = 0;
    $len = strlen($src);
    for ($i = $open; $i < $len; $i++) {
        if ($src[$i] === '{') $depth++;
        elseif ($src[$i] === '}' && --$depth === 0) return substr($src, $open, $i - $open + 1);
    }
    return substr($src, $open);
}

/** Docblock lines with the leading " * " removed. */
function ds_doc_lines(string $doc): array {
    return array_map(fn($l) => preg_replace('/^\s*\*\s?/', '', $l), explode("\n", trim($doc)));
}

/**
 * Usage tags in a function's docblock: @whenToUse, @whenNotToUse, @example, @a11y,
 * @js (its twin in js/ws.js, such as "ws.button(text, options)") and any number of @insteadOf lines ("@insteadOf ws_side_panel when ..."). A tag
 * runs on over the following lines until a blank line or the next @tag. The demo
 * page's own usage text wins; a tag fills what the demo does not say.
 */
function ds_doc_tags(array $lines): array {
    $out = ['whenToUse' => null, 'whenNotToUse' => null, 'example' => null, 'a11y' => null, 'js' => null, 'insteadOf' => []];
    $cur = null; $buf = [];
    $flush = function () use (&$out, &$cur, &$buf) {
        if ($cur === null) return;
        $text = trim(preg_replace('/\s+/', ' ', implode(' ', $buf)));
        if ($cur === 'insteadOf') {
            if (preg_match('/^((?:ws_[a-z0-9_]+|recipe:[a-z0-9-]+))\s+(.+)$/', $text, $m)) $out['insteadOf'][] = ['use' => $m[1], 'when' => $m[2]];
            else $out['insteadOf'][] = ['use' => null, 'when' => $text];
        } elseif ($text !== '') {
            $out[$cur] = $text;
        }
        $cur = null; $buf = [];
    };
    foreach ($lines as $l) {
        $t = trim($l);
        if (preg_match('/^@(whenToUse|whenNotToUse|example|a11y|js|insteadOf)\b\s*(.*)$/', $t, $m)) {
            $flush();
            $cur = $m[1]; $buf = [$m[2]];
        } elseif ($t === '' || $t[0] === '@') {
            $flush();
        } elseif ($cur !== null) {
            $buf[] = $t;
        }
    }
    $flush();
    return $out;
}

/** First non-empty line of a docblock's prose, before any @tag and its continuation lines. */
function ds_summary(array $lines): string {
    foreach ($lines as $l) {
        $l = trim($l);
        if ($l !== '' && $l[0] === '@') return '';
        if ($l !== '') return $l;
    }
    return '';
}

/** A PHP literal default as JSON-able data, or null when it is an expression. */
function ds_literal(string $raw, ?bool &$ok) {
    $ok = true;
    $raw = trim($raw);
    if (preg_match("/^'((?:[^'\\\\]|\\\\.)*)'$/s", $raw, $m) || preg_match('/^"([^"$]*)"$/', $raw, $m)) return stripslashes($m[1]);
    $lower = strtolower($raw);
    if ($lower === 'true') return true;
    if ($lower === 'false') return false;
    if ($lower === 'null') return null;
    if ($raw === '[]') return [];
    if (is_numeric($raw)) return $raw + 0;
    $ok = false;
    return null;
}

function ds_type_of($value): ?string {
    return match (true) {
        is_bool($value)   => 'bool',
        is_int($value), is_float($value) => 'number',
        is_string($value) => 'string',
        is_array($value)  => 'array',
        default           => null,
    };
}

/**
 * Option names, defaults and declared values a template or helper body reads.
 *
 * $vars are the array names the options live in ($options, $modal, $card …).
 * Values come from a `@param type $key - a|b|c (default: x)` line or an inline
 * `// a | b | c` comment on the line that reads the option.
 */
function ds_template_spec(string $src, array $vars): array {
    $spec = [];
    $alt  = implode('|', array_map(fn($v) => preg_quote($v, '/'), $vars));
    if (preg_match_all('/\$(?:' . $alt . ")\['([A-Za-z0-9_]+)'\]\s*\?\?\s*([^;\n]+?)\s*;([^\n]*)/", $src, $mm, PREG_SET_ORDER)) {
        foreach ($mm as $m) {
            $key = $m[1];
            if (isset($spec[$key])) continue;
            $entry = [];
            $default = ds_literal($m[2], $ok);
            if ($ok) {
                $entry['default'] = $default;
                if (($t = ds_type_of($default)) !== null) $entry['type'] = $t;
            }
            if (preg_match('/\/\/\s*([a-z0-9-]+(?:\s*\|\s*[a-z0-9-]+)+)\s*$/i', $m[3], $cm)) {
                $entry['values'] = array_map('trim', explode('|', $cm[1]));
            }
            $spec[$key] = $entry;
        }
    }
    if (preg_match_all('/@param\s+(\S+)\s+\$([A-Za-z0-9_]+)\s*-\s*([a-z0-9-]+(?:\|[a-z0-9-]+)+)(?:\s*\(default:\s*([^)]+)\))?/i', $src, $mm, PREG_SET_ORDER)) {
        foreach ($mm as $m) {
            $key = $m[2];
            if (!isset($spec[$key])) continue;       // a documented param the template never reads is not an option
            $spec[$key]['values'] = explode('|', $m[3]);
            $spec[$key]['type'] ??= 'string';
        }
    }
    return $spec;
}

/**
 * Defaults declared as an array merged under the caller's options:
 * `$o = array_merge(['key' => 'x', …], $opts)` or `$opts + ['key' => 'x', …]`.
 */
function ds_merged_defaults(string $body): array {
    $spec = [];
    if (!preg_match('/(?:array_merge\s*\(\s*\[|\$(?:options|opts)\s*\+\s*\[)/', $body, $m, PREG_OFFSET_CAPTURE)) return $spec;
    $start = $m[0][1] + strlen($m[0][0]);
    $depth = 1; $i = $start; $len = strlen($body);
    for (; $i < $len && $depth > 0; $i++) {
        if ($body[$i] === '[') $depth++;
        elseif ($body[$i] === ']') $depth--;
    }
    $literal = preg_replace('#/\*.*?\*/|//[^\n]*#s', '', substr($body, $start, $i - $start - 1));
    // Only top-level keys: blank out nested [...] so their keys are not read as options.
    while (preg_match('/\[[^\[\]]*\]/', $literal)) $literal = preg_replace('/\[[^\[\]]*\]/', '__NESTED__', $literal);
    if (preg_match_all("/'([A-Za-z0-9_]+)'\s*=>\s*([^,]+?)\s*(?:,|$)/", $literal, $mm, PREG_SET_ORDER)) {
        foreach ($mm as $e) {
            $entry = [];
            $default = ds_literal($e[2], $ok);
            if ($ok) {
                $entry['default'] = $default;
                if (($t = ds_type_of($default)) !== null) $entry['type'] = $t;
            } elseif ($e[2] === '__NESTED__') {
                $entry['type'] = 'array';
            }
            $spec[$e[1]] = $entry;
        }
    }
    return $spec;
}

/** The array variables a helper body passes its options through to a template. */
function ds_option_vars(string $body): array {
    $vars = ['options', 'opts'];
    $body = preg_replace('#/\*.*?\*/#s', '', $body);  // a ; in a comment inside the merged defaults must not end the match
    if (preg_match_all('/\$([A-Za-z_][A-Za-z0-9_]*)\s*=\s*(?:\$(?:options|opts)\s*;|array_merge\s*\([^;]*\$(?:options|opts)\b[^;]*\)\s*;)/', $body, $mm)) {
        foreach ($mm[1] as $v) $vars[] = $v;
    }
    return array_values(array_unique($vars));
}

/**
 * Every ws_* function in a file: name, signature, docblock, body.
 *
 * The docblock is the one that ends right above the function, allowing for an
 * `if (!function_exists('…')) {` guard between them. With none, the file's own
 * header docblock supplies the summary.
 */
function ds_scan_file(string $path): array {
    $src = file_get_contents($path);
    $out = [];
    $fileDoc = preg_match('/^<\?php\s*\/\*\*(.*?)\*\//s', $src, $fd) ? ds_doc_lines($fd[1]) : [];
    if (!preg_match_all('/^[ \t]*function\s+(ws_[a-z0-9_]+)\s*\(/mi', $src, $mm, PREG_SET_ORDER | PREG_OFFSET_CAPTURE)) return $out;
    foreach ($mm as $m) {
        $name  = $m[1][0];
        $start = $m[0][1];
        $head  = substr($src, $start, (strpos($src, '{', $start) ?: $start) - $start);
        preg_match('/function\s+ws_[a-z0-9_]+\s*\((.*)\)\s*(?::\s*(\??[\\\\\w|]+))?\s*$/s', trim($head), $hm);
        $params = trim(preg_replace('/\s+/', ' ', $hm[1] ?? ''));
        $sig    = $name . '(' . $params . ')' . (!empty($hm[2]) ? ': ' . $hm[2] : '');

        $before = substr($src, 0, $start);
        $doc = [];
        if (preg_match('/\/\*\*((?:(?!\*\/).)*)\*\/\s*(?:if\s*\(\s*!\s*function_exists\([^)]*\)\s*\)\s*\{\s*)?$/s', $before, $dm)) {
            $doc = ds_doc_lines($dm[1]);
        }
        $out[$name] = [
            'signature' => $sig,
            'doc'       => $doc,
            'fileDoc'   => $fileDoc,
            'body'      => ds_function_body($src, $start),
        ];
    }
    return $out;
}

// ---- Scan every ws_* function, with its scope ----------------------------
$scopes = ['component' => [$helpers], 'page' => [], 'app-local' => [$root . '/app/includes/workshop-list.php']];
foreach (glob($root . '/includes/components/*.php') ?: [] as $f) {
    if ($f === $helpers || preg_match('/ \d+\.php$/', $f)) continue;  // numbered sync duplicates
    $scopes['page'][] = $f;
}

$found = [];
foreach ($scopes as $scope => $files) {
    foreach ($files as $f) {
        if (!is_readable($f)) continue;
        foreach (ds_scan_file($f) as $name => $info) {
            if (isset($found[$name])) continue;
            $found[$name] = $info + ['scope' => $scope, 'file' => $f];
        }
    }
}

$curatedJson = is_readable($curated) ? json_decode(file_get_contents($curated), true) : [];
$curatedComponents = $curatedJson['components'] ?? [];

/** Does a signature take an options array ($options / $opts) that another helper's option set could describe? */
function ds_takes_options(string $signature): bool {
    return (bool) preg_match('/\barray\s+\$(?:options|opts)\b/', $signature);
}

// A helper with no curated entry inherits the options of one that lists it as an
// alternative: ws_modal's entry documents ws_modal_start's options too. A helper
// with no options array (ws_modal_end) takes none of them.
$curatedOptions = [];
foreach ($curatedComponents as $key => $entry) {
    if (!is_array($entry) || $key === '' || $key[0] === '_') continue;
    if (!empty($entry['options']) && is_array($entry['options'])) $curatedOptions[$key] = $entry['options'];
}
foreach ($curatedComponents as $key => $entry) {
    if (!is_array($entry) || empty($curatedOptions[$key])) continue;
    foreach (array_keys($entry['alternatives'] ?? []) as $altKey) {
        if (!preg_match_all('/ws_[a-z0-9_]+/', $altKey, $am)) continue;
        foreach ($am[0] as $alt) {
            if (isset($found[$alt]) && ds_takes_options($found[$alt]['signature'])) $curatedOptions[$alt] ??= $curatedOptions[$key];
        }
    }
}

$fixtureHelpers = [];
$fixtureStates  = [];
$autoPreviews   = [];  // helper => playground key, for helpers the playground builds from the catalog
if (is_readable($fixtures)) {
    require_once $fixtures;
    if (function_exists('dsPlaygroundFixtures')) {
        foreach (dsPlaygroundFixtures() as $fixtureKey => $fixture) {
            // A fixture previews its helper and any it covers (ws_card_start's also shows ws_card_end).
            foreach (array_merge([$fixture['helper'] ?? null], $fixture['covers'] ?? []) as $h) {
                if ($h === null) continue;
                $fixtureHelpers[$h] ??= $fixtureKey;
                foreach (array_keys($fixture['states'] ?? []) as $s) $fixtureStates[$h][$s] = true;
            }
        }
    }
    if (function_exists('dsPlaygroundAutoHelpers')) {
        $autoPreviews = array_flip(dsPlaygroundAutoHelpers(array_map(fn($i) => ['signature' => $i['signature'], 'scope' => $i['scope'], 'source' => '/' . substr($i['file'], strlen($root) + 1)], $found)));
    }
}

// Options whose boolean form is a visual state an agent should know to preview.
$STATE_OPTIONS = ['disabled', 'loading', 'error', 'selected', 'active', 'checked', 'open', 'expanded',
                  'collapsed', 'indeterminate', 'readonly', 'invalid', 'empty', 'dismissible'];

// ---- Template-derived option specs, following includes and delegation ----
$templateSpec = [];
$templateSrc  = [];
foreach ($found as $name => $info) {
    $body = $info['body'];
    $vars = ds_option_vars($body);
    $spec = ds_template_spec($body, $vars) + ds_merged_defaults($body);
    $src  = $body;
    if (preg_match_all("/include(?:_once)?\s+__DIR__\s*\.\s*'\/([a-z0-9-]+\.php)'/", $body, $im)) {
        foreach ($im[1] as $inc) {
            $path = dirname($info['file']) . '/' . $inc;
            if (!is_readable($path)) continue;
            $incSrc = file_get_contents($path);
            $spec += ds_template_spec($incSrc, $vars);
            $src  .= "\n" . $incSrc;
        }
    }
    // A key the template reads any other way (isset, !empty, a bare read) is an option too, with nothing more known.
    // One with a leading underscore is the template's own working state, not an option.
    $alt = implode('|', array_map(fn($v) => preg_quote($v, '/'), $vars));
    if (preg_match_all('/\$(?:' . $alt . ")\['([A-Za-z][A-Za-z0-9_]*)'\]/", $src, $km)) {
        foreach ($km[1] as $k) $spec[$k] ??= [];
    }
    $templateSpec[$name] = $spec;
    $templateSrc[$name]  = ['src' => $src, 'vars' => $vars];
}
// ws_modal renders through ws_modal_start, ws_icon_button through ws_button. A
// wrapper without an options array (ws_status) inherits none of them: its
// positional arguments are mapped onto the delegate's options after the build.
// A wrapper whose whole body is `return ws_x(..., array_merge([defaults], $options));`
// (ws_icon_button) takes every option of its delegate, with its own defaults on top.
foreach ($found as $name => $info) {
    if ($info['scope'] !== 'component' || !ds_takes_options($info['signature'])) continue;
    if ($templateSpec[$name]) {
        if (!preg_match('/^\{\s*return\s+(ws_[a-z0-9_]+)\s*\((.*)\)\s*;\s*\}$/s', trim($info['body']), $wm) || $wm[1] === $name) continue;
        if (empty($templateSpec[$wm[1]]) || !preg_match('/\$(?:options|opts)\b(?!\s*\[)/', $wm[2])) continue;
        $spec = $templateSpec[$wm[1]];
        foreach ($templateSpec[$name] as $key => $entry) $spec[$key] = $entry + ($spec[$key] ?? []);
        $templateSpec[$name] = $spec;
        $templateSrc[$name]  = $templateSrc[$wm[1]];
        continue;
    }
    if (preg_match('/(?<![a-z0-9_$>])(ws_[a-z0-9_]+)\s*\(/', $info['body'], $dm) && $dm[1] !== $name && !empty($templateSpec[$dm[1]])) {
        $templateSpec[$name] = $templateSpec[$dm[1]];
        $templateSrc[$name]  = $templateSrc[$dm[1]];
    }
}

// ---- CSS truth for option values -----------------------------------------
// A value is valid when the class (or data attribute) the template renders for
// it has a rule in components.css, when the template branches on it with its own
// markup, or when it is the template default (the base class draws that look).
// Template and curated lists are only candidates. A rule counts only for the
// option that renders its class: .ws-skeleton--circle belongs to the boolean
// `circle`, so it is no evidence for a variant named circle. A class named only
// inside :not(...) is not styled by that rule.
$componentsCss = preg_replace('#/\*.*?\*/#s', '', (string) @file_get_contents($root . '/includes/components/components.css'));
$componentsCssRules = preg_replace('/:not\((?:[^()]|\([^()]*\))*\)/', '', $componentsCss);

/** Occurrences of a class or attribute selector in components.css. */
function ds_css_rules(string $css, string $selector): int {
    if ($selector[0] === '[') return substr_count($css, $selector);
    return preg_match_all('/\.' . preg_quote($selector, '/') . '(?![A-Za-z0-9_-])/', $css);
}

/** A class fragment a value is appended to: a modifier ("--", "__") or a ws-/wl- class stem. */
function ds_is_class_prefix(string $p): bool {
    return str_ends_with($p, '-') && (str_contains($p, '--') || str_contains($p, '__') || preg_match('/^(?:ws|wl)-[a-z0-9]/', $p));
}

/**
 * How a template turns option $key into markup: the class prefixes and data
 * attributes it renders the value into (concatenated, interpolated or echoed
 * inline), the literal values it branches on, and the literal classes each
 * `if (...) $classes[] = '...'` adds with the variables its condition reads.
 */
function ds_option_mapping(string $src, array $vars, string $key): array {
    $var = $key;
    $default = null;
    $alt = implode('|', array_map(fn($v) => preg_quote($v, '/'), $vars));
    if (preg_match('/\$([A-Za-z_]\w*)\s*=\s*\$(?:' . $alt . ")\\['" . preg_quote($key, '/') . "'\\]/", $src, $vm)) {
        $var = $vm[1];
    } elseif (preg_match('/\$([A-Za-z_]\w*)\s*=\s*\$[A-Za-z_]\w*' . "\\['" . preg_quote($key, '/') . "'\\]\s*\?\?\s*([^;\n]+?)\s*;/", $src, $vm)) {
        $var = $vm[1];  // a template reading its own array ($pillData, $filterData …)
        $lit = ds_literal($vm[2], $ok);
        if ($ok) $default = $lit;
    }
    $v = preg_quote($var, '/');
    $wrap = '(?:\$?[A-Za-z_]\w*\(\s*)?';      // htmlspecialchars($x), $h($x)
    $echo = '<\?(?:=|php\s+echo)\s*' . $wrap;   // a short echo tag or an echo statement
    $out = ['var' => $var, 'prefixes' => [], 'attrs' => [], 'branches' => [], 'guarded' => [], 'default' => $default];
    $found = [];
    if (preg_match_all("/'((?:[a-z0-9_-]+\s)*[a-z0-9_-]*-)'\s*\.\s*" . $wrap . '\$' . $v . '(?![A-Za-z0-9_])/', $src, $m)) {
        foreach ($m[1] as $p) { $parts = preg_split('/\s+/', $p); $found[] = end($parts); }
    }
    if (preg_match_all('/(?<=["\s])([a-z][a-z0-9_-]*-)\{?\$' . $v . '\}?(?![A-Za-z0-9_\[])/', $src, $m)) {
        foreach ($m[1] as $p) $found[] = $p;
    }
    if (preg_match_all('/(?<=["\s])([a-z][a-z0-9_-]*-)' . $echo . '\$' . $v . '(?![A-Za-z0-9_\[])/', $src, $m)) {
        foreach ($m[1] as $p) $found[] = $p;
    }
    foreach ($found as $p) if (ds_is_class_prefix($p)) $out['prefixes'][] = $p;
    if (preg_match_all("/(data-[a-z0-9-]+)=\"'\s*\.\s*" . $wrap . '\$' . $v . '(?![A-Za-z0-9_])/', $src, $m)) {
        foreach ($m[1] as $a) $out['attrs'][] = $a;
    }
    if (preg_match_all('/(data-[a-z0-9-]+)="' . $echo . '\$' . $v . '(?![A-Za-z0-9_\[])/', $src, $m)) {
        foreach ($m[1] as $a) $out['attrs'][] = $a;
    }
    if (preg_match_all("/\\$" . $v . "\s*[!=]==?\s*(?:'([a-z0-9_-]+)'|([0-9]+)(?![0-9.]))/", $src, $m)) $out['branches'] = array_values(array_filter(array_map(fn($a, $b) => $a !== '' ? $a : $b, $m[1], $m[2]), 'strlen'));
    if (preg_match('/switch\s*\(\s*\$' . $v . '\s*\)/', $src) && preg_match_all("/case\s+'([a-z0-9_-]+)'\s*:/", $src, $m)) {
        $out['branches'] = array_merge($out['branches'], $m[1]);
    }
    if (preg_match_all('/\bif\s*\(((?:[^()]|\((?:[^()]|\([^()]*\))*\))*)\)\s*\$[A-Za-z_]\w*\[\]\s*=\s*\'([a-z0-9_ -]+)\'\s*;/', $src, $m, PREG_SET_ORDER)) {
        foreach ($m as $g) {
            preg_match_all('/\$([A-Za-z_]\w*)/', $g[1], $cv);
            foreach (preg_split('/\s+/', trim($g[2])) as $cls) {
                $out['guarded'][$cls] = array_values(array_unique(array_merge($out['guarded'][$cls] ?? [], $cv[1])));
            }
        }
    }
    foreach (['prefixes', 'attrs', 'branches'] as $k) $out[$k] = array_values(array_unique($out[$k]));
    return $out;
}

// ---- Build entries --------------------------------------------------------
$components = [];
$conflicts  = [];
$insteadOfErrors = [];
foreach ($found as $name => $info) {
    $docLines = $info['doc'];
    $summary  = ds_summary($docLines);
    $context  = ds_summary($info['fileDoc']);
    if ($summary === '') $summary = $context;

    // @param entries + option names from the options array's "(a, b, c)" list. Only
    // an array the signature takes as options counts: "(for initials)" on a string
    // and "(label, icon, …)" on an $items list describe something else. An entry
    // must be a bare key once a trailing dash note ("attrs, see app-bar.php") is cut.
    $params  = [];
    $options = [];
    foreach ($docLines as $l) {
        if (preg_match('/@param\s+(\S+)\s+(\$\S+)\s*(.*)/', $l, $pm)) {
            $params[] = ['type' => $pm[1], 'name' => $pm[2], 'desc' => trim($pm[3])];
            $isOptions = str_contains(strtolower($pm[1]), 'array')
                && preg_match('/\barray\s+' . preg_quote($pm[2], '/') . '\b/', $info['signature'])
                && (preg_match('/^\$(?:options|opts)$/', $pm[2]) || preg_match('/\boptions?\b/i', $pm[3]));
            if ($isOptions && preg_match('/\(([^)]+)\)/', $pm[3], $om)) {
                foreach (explode(',', $om[1]) as $opt) {
                    $opt = trim(preg_split('/\s+[\x{2014}\x{2013}-]\s+|\s*\(/u', $opt)[0]);
                    // "(bool)" or "(optional)" in a param description is a type note, not an option list.
                    if (!preg_match('/^[A-Za-z_][A-Za-z0-9_]*$/', $opt) || in_array(strtolower($opt), ['bool', 'string', 'int', 'array', 'float', 'mixed', 'callable', 'null', 'optional', 'required'], true)) continue;
                    $options[] = $opt;
                }
            }
        }
    }

    // optionSpec: template first (it renders the class), curated fills the gaps.
    $spec = [];
    foreach ($templateSpec[$name] as $key => $t) $spec[$key] = $t + ['source' => 'template'];
    foreach (($curatedOptions[$name] ?? []) as $key => $c) {
        // A curated "$phase" documents a positional argument, not an option key.
        if (!is_array($c) || !preg_match('/^[A-Za-z_]\w*$/', (string) $key)) continue;
        $cValues = $c['values'] ?? $c['enum'] ?? null;
        $entry = $spec[$key] ?? ['source' => 'curated'];
        foreach (['type', 'description', 'required'] as $f) {
            if (isset($c[$f]) && !isset($entry[$f])) $entry[$f] = $c[$f];
        }
        if (is_array($cValues)) {
            if (isset($entry['values'])) {
                $a = $entry['values']; $b = $cValues; sort($a); sort($b);
                $m = isset($templateSrc[$name]) ? ds_option_mapping($templateSrc[$name]['src'], $templateSrc[$name]['vars'], (string) $key) : null;
                $cssDecides = $m && ($m['prefixes'] || $m['attrs']);  // resolved against components.css below
                if ($a !== $b && !$cssDecides) $conflicts[] = "$name.$key values: template [" . implode(', ', $entry['values']) . "], JSON [" . implode(', ', $cValues) . ']';
            } else {
                $entry['values'] = array_values($cValues);
                $entry['valuesFrom'] = 'curated';
            }
        }
        if (array_key_exists('default', $c)) {
            if (array_key_exists('default', $entry)) {
                if ($entry['default'] !== $c['default'] && isset($entry['values'])) {
                    $conflicts[] = "$name.$key default: template " . json_encode($entry['default']) . ', JSON ' . json_encode($c['default']);
                }
            } else {
                $entry['default'] = $c['default'];
            }
        }
        $spec[$key] = $entry;
    }
    // Resolve every option that renders a class or data attribute against components.css.
    $resolve = [];
    foreach (array_keys($spec) as $key) {
        if (!isset($templateSrc[$name])) break;
        $map = ds_option_mapping($templateSrc[$name]['src'], $templateSrc[$name]['vars'], (string) $key);
        if (!$map['prefixes'] && !$map['attrs']) continue;
        $tValues = $templateSpec[$name][$key]['values'] ?? [];
        if (!$tValues && preg_match('/@param\s+\S+\s+\$' . preg_quote((string) $key, '/') . '\s*-\s*([a-z0-9-]+(?:\|[a-z0-9-]+)+)/i', $templateSrc[$name]['src'], $pm)) {
            $tValues = explode('|', $pm[1]);  // a template reading its own array still declares its values
        }
        $cRaw    = $curatedOptions[$name][$key] ?? null;
        $cValues = is_array($cRaw) ? ($cRaw['values'] ?? $cRaw['enum'] ?? null) : null;
        if (!$tValues && !is_array($cValues)) continue;
        // One candidate per spelling: the docblock's "2" and the JSON's 2 are the same value, kept as the JSON types it.
        $candidates = [];
        foreach (array_merge($tValues, is_array($cValues) ? $cValues : []) as $val) $candidates[(string) $val] ??= $val;
        foreach ((is_array($cValues) ? $cValues : []) as $val) $candidates[(string) $val] = $val;
        $resolve[$key] = ['map' => $map, 'tValues' => array_map('strval', $tValues), 'cValues' => is_array($cValues) ? array_map('strval', $cValues) : null, 'candidates' => $candidates];
    }
    foreach ($resolve as $key => $r) {
        $map = $r['map'];
        // Classes another option renders: a literal its own condition adds, or another option's value under a shared prefix.
        $foreign = [];
        foreach ($map['guarded'] as $cls => $condVars) {
            if (!in_array($map['var'], $condVars, true)) $foreign[$cls] = true;
        }
        foreach ($resolve as $otherKey => $o) {
            if ($otherKey === $key) continue;
            foreach ($o['map']['prefixes'] as $p) {
                foreach (array_keys($o['candidates']) as $ov) {
                    if (!isset($r['candidates'][$ov])) $foreign[$p . $ov] = true;
                }
            }
        }
        $tDefault = $templateSpec[$name][$key]['default'] ?? $map['default'];
        $valid = [];
        foreach ($r['candidates'] as $sval => $val) {
            $sval = (string) $sval;
            $n = 0;
            foreach ($map['prefixes'] as $p) {
                if (!isset($foreign[$p . $sval])) $n += ds_css_rules($componentsCssRules, $p . $sval);
            }
            foreach ($map['attrs'] as $a) $n += ds_css_rules($componentsCssRules, '[' . $a . '="' . $sval . '"]');
            $ok = $n > 0 || ($tDefault !== null && $sval === (string) $tDefault) || in_array($sval, $map['branches'], true);
            if ($ok) { $valid[] = $val; continue; }
            $where = array_filter([in_array($sval, $r['tValues'], true) ? 'template' : null, $r['cValues'] !== null && in_array($sval, $r['cValues'], true) ? 'JSON' : null]);
            $conflicts[] = "$name.$key value \"$sval\" has no rule of its own for " . implode(' or ', array_merge(array_map(fn($p) => ".$p$sval", $map['prefixes']), array_map(fn($a) => "[$a=\"$sval\"]", $map['attrs'])))
                . ' in components.css but is listed by the ' . implode(' and ', $where);
        }
        foreach ($valid as $val) {
            if ($r['tValues'] && !in_array((string) $val, $r['tValues'], true)) $conflicts[] = "$name.$key value \"$val\" is valid in components.css but missing from the template docblock";
            if ($r['cValues'] !== null && !in_array((string) $val, $r['cValues'], true)) $conflicts[] = "$name.$key value \"$val\" is valid in components.css but missing from workshopr-design-system.json";
        }
        $spec[$key]['values']     = $valid;
        $spec[$key]['valuesFrom'] = 'css';
    }

    foreach ($options as $o) {
        if (preg_match('/^[A-Za-z_][A-Za-z0-9_]*$/', $o)) $spec[$o] ??= ['source' => 'docblock'];
    }
    // "@param array $opts ['id' => '', 'class' => '']" documents the defaults of an
    // options array the body reads without a ?? literal.
    foreach ($docLines as $l) {
        if (!preg_match('/@param\s+array\s+\$(?:options|opts)\s+\[(.*)\]\s*$/', $l, $dm)) continue;
        if (!preg_match_all("/'([A-Za-z0-9_]+)'\s*=>\s*([^,]+?)\s*(?:,|$)/", $dm[1], $pairs, PREG_SET_ORDER)) continue;
        foreach ($pairs as $pair) {
            $default = ds_literal($pair[2], $ok);
            if (!$ok || isset($spec[$pair[1]]['default'])) continue;
            $spec[$pair[1]] = ($spec[$pair[1]] ?? ['source' => 'docblock']) + ['default' => $default];
            if (($t = ds_type_of($default)) !== null) $spec[$pair[1]]['type'] ??= $t;
            if (!in_array($pair[1], $options, true)) $options[] = $pair[1];
        }
    }
    foreach (array_keys($spec) as $key) {
        if (!in_array($key, $options, true)) $options[] = $key;
    }

    $demo = ds_extract_demo($name, $demoDir, $root);
    $tags = ds_doc_tags($docLines);
    foreach (['example', 'whenToUse', 'whenNotToUse', 'a11y'] as $f) $demo[$f] ??= $tags[$f];
    foreach ($tags['insteadOf'] as $alt) {
        if ($alt['use'] === null) $insteadOfErrors[] = "$name has an @insteadOf line that does not start with a ws_* helper or recipe:<id>";
    }
    $fixtureKey = $fixtureHelpers[$name] ?? null;
    $previewKey = $fixtureKey ?? $autoPreviews[$name] ?? null;
    $previewKind = $fixtureKey !== null ? 'curated' : ($previewKey !== null ? 'auto' : 'none');

    $states = array_keys($fixtureStates[$name] ?? []);
    foreach ($STATE_OPTIONS as $s) {
        if (isset($spec[$s]) && ($spec[$s]['type'] ?? '') === 'bool' && !in_array($s, $states, true)) $states[] = $s;
    }

    $components[$name] = [
        'signature'    => $info['signature'],
        'summary'      => $summary,
        'context'      => $info['scope'] !== 'component' && $context !== $summary ? ($context ?: null) : null,
        'scope'        => $info['scope'],
        'source'       => '/' . substr($info['file'], strlen($root) + 1),
        'params'       => $params,
        'options'      => $options,
        'optionSpec'   => (object) $spec,
        'states'       => $states,
        'demo'         => $demo['demo'],
        'fixture'      => $fixtureKey !== null,
        'previewKind'  => $previewKind,
        'preview'      => $previewKey !== null && function_exists('dsPlaygroundPreviewUrl') ? dsPlaygroundPreviewUrl($previewKey) : null,
        'previewSkip'  => $previewKind === 'none' && function_exists('dsPlaygroundSkipReason') ? dsPlaygroundSkipReason($name, ['signature' => $info['signature'], 'scope' => $info['scope'], 'source' => '/' . substr($info['file'], strlen($root) + 1)]) : null,
        'example'      => $demo['example'],
        'whenToUse'    => $demo['whenToUse'],
        'whenNotToUse' => $demo['whenNotToUse'],
        'a11y'         => $demo['a11y'],
        'js'           => $tags['js'] !== null && preg_match('/^ws\.[a-zA-Z]+\(.*\)$/', $tags['js']) ? $tags['js'] : null,
        'insteadOf'    => array_values(array_filter($tags['insteadOf'], fn($a) => $a['use'] !== null)),
        'tokens'       => [],  // filled from components.css once the tokens are parsed
        'antiPattern'  => "Don't hand-write raw HTML that {$name}() already produces. Call the helper so markup, classes, tokens, and accessibility stay correct.",
    ];
}

// ---- Positional arguments that feed an option -------------------------------
// ws_status($text, $status) renders ws_badge($text, ['status' => $status]), so its
// second argument takes exactly the values ws_badge's status option resolved to;
// ws_activity_badge($type) merges ['type' => $type] into its own options. The
// values land on that argument's entry in `params`, with its 0-based position.
foreach ($found as $name => $info) {
    if (!preg_match('/^ws_\w+\((.*)\)(?::\s*\S+)?$/', $info['signature'], $sm) || trim($sm[1]) === '') continue;
    $sigParams = [];
    foreach (preg_split('/,(?![^\[]*\])/', $sm[1]) as $i => $raw) {
        if (preg_match('/^(?:(\??[\\\\\w|]+)\s+)?&?(?:\.\.\.)?\$(\w+)(?:\s*=\s*(.+))?$/', trim($raw), $pm)) {
            $sigParams[$pm[2]] = ['position' => $i, 'type' => $pm[1] ?? '', 'default' => $pm[3] ?? null];
        }
    }
    $body = $info['body'];
    $sources = [];  // [argument text, the component whose optionSpec reads it]
    $outside = $body;
    if (preg_match_all('/(?<![a-z0-9_$>:])(ws_[a-z0-9_]+)\s*\(/', $body, $calls, PREG_SET_ORDER | PREG_OFFSET_CAPTURE)) {
        foreach ($calls as $call) {
            $dlg = $call[1][0];
            if ($dlg === $name || !isset($components[$dlg])) continue;
            $open = $call[0][1] + strlen($call[0][0]);
            $depth = 1;
            for ($j = $open, $len = strlen($body); $j < $len && $depth > 0; $j++) {
                if ($body[$j] === '(') $depth++;
                elseif ($body[$j] === ')') $depth--;
            }
            $sources[] = [substr($body, $open, $j - $open - 1), $dlg];
            $outside = substr_replace($outside, str_repeat(' ', $j - $open), $open, $j - $open);
        }
    }
    $sources[] = [$outside, $name];
    foreach ($sources as [$argText, $target]) {
        if (!preg_match_all("/'([A-Za-z0-9_]+)'\s*=>\s*\\$([A-Za-z_]\w*)\s*(?=[,\])]|$)/", $argText, $pairs, PREG_SET_ORDER)) continue;
        $targetSpec = (array) $components[$target]['optionSpec'];
        foreach ($pairs as [, $optKey, $argVar]) {
            if (!isset($sigParams[$argVar]) || str_contains($sigParams[$argVar]['type'], 'array')) continue;
            $tSpec = $targetSpec[$optKey] ?? null;
            if (!is_array($tSpec) || !isset($tSpec['values'])) continue;
            $at = null;
            foreach ($components[$name]['params'] as $k => $p) { if ($p['name'] === '$' . $argVar) { $at = $k; break; } }
            if ($at === null) {
                $components[$name]['params'][] = ['type' => $sigParams[$argVar]['type'], 'name' => '$' . $argVar, 'desc' => ''];
                $at = array_key_last($components[$name]['params']);
            }
            $entry = ['position' => $sigParams[$argVar]['position'], 'values' => $tSpec['values'], 'valuesFrom' => $tSpec['valuesFrom'] ?? $tSpec['source'] ?? null, 'mapsTo' => "$target.$optKey"];
            if ($sigParams[$argVar]['default'] !== null) {
                $default = ds_literal($sigParams[$argVar]['default'], $ok);
                if ($ok) $entry['default'] = $default;
            }
            $components[$name]['params'][$at] += $entry;
        }
    }
}
ksort($components);
sort($conflicts);
foreach ($components as $name => $c) {
    foreach ($c['insteadOf'] as $alt) {
        if (str_starts_with($alt['use'], 'ws_') && !isset($components[$alt['use']])) $insteadOfErrors[] = "$name @insteadOf names {$alt['use']}, which is not in the catalog";
        if ($alt['use'] === $name) $insteadOfErrors[] = "$name @insteadOf names itself";
    }
}

// ---- Tokens from platform-tokens.css --------------------------------------
$LEGACY_FAMILIES = ['phase', 'mainsite', 'tips', 'podcasts', 'planner', 'coach', 'intervention',
                    'facilitator', 'dna', 'training', 'companion'];
$SEMANTIC_PREFIXES = ['button-', 'card-', 'input-', 'modal-', 'badge-', 'tooltip-', 'toast-', 'divider-',
                      'link-', 'focus-ring', 'color-success', 'color-warning', 'color-error', 'color-info',
                      'color-primary-on-white', 'header-bg', 'overlay-', 'backdrop-'];

/**
 * Tokens in source order: the first definition of each name, plus the @media
 * blocks that redefine it (reduced motion, more contrast, forced colors).
 */
function ds_parse_tokens(string $css): array {
    $tokens = [];
    $lines  = explode("\n", $css);
    $group = null; $pending = null; $media = null;
    $inComment = false; $comment = []; $commentEnd = -2; $bannerNext = false;
    $depth = 0;
    $n = count($lines);
    for ($i = 0; $i < $n; $i++) {
        $line = $lines[$i];
        $trim = trim($line);
        if ($inComment) {
            if ($bannerNext && $trim !== '' && !preg_match('/^=+/', $trim)) {
                $group = rtrim(preg_replace('/\s*=+\s*\*\/$/', '', $trim));
                $bannerNext = false;
            }
            $comment[] = $line;
            if (str_contains($line, '*/')) { $inComment = false; $commentEnd = $i; }
            continue;
        }
        if (preg_match('/^\/\*/', $trim) && !preg_match('/^\/\*.*\*\/\s*$/', $trim)) {
            $inComment = true;
            $comment = [$line];
            $bannerNext = (bool) preg_match('/^\/\*\s*=+\s*$/', $trim);
            continue;
        }
        if (preg_match('/^\/\*(.*)\*\/\s*$/', $trim, $cm)) { $comment = [$line]; $commentEnd = $i; continue; }

        if (preg_match('/^@media\s*([^{]+)\{/', $trim, $mm)) { $media = trim($mm[1], " ()"); $depth++; continue; }
        $depth += substr_count($line, '{') - substr_count($line, '}');
        if ($depth <= 0) $media = null;

        if (!preg_match('/^\s*(--[a-z0-9-]+)\s*:\s*(.*)$/i', $line, $m)) continue;
        $name = $m[1];
        $rest = $m[2];
        $start = $i;  // a value spanning lines moves $i on; its comment sits above where it starts
        while (!str_contains($rest, ';') && $i + 1 < $n) $rest .= ' ' . trim($lines[++$i]);
        $value = trim(preg_replace('/\s+/', ' ', substr($rest, 0, strpos($rest, ';'))));
        $tail  = substr($rest, strpos($rest, ';') + 1);

        if ($media !== null) {
            if (isset($tokens[$name])) $tokens[$name]['modes'][$media] = $value;
            continue;
        }
        if (isset($tokens[$name])) continue;

        $purpose = null;
        if (preg_match('/\/\*\s*(.*?)\s*(?:\*\/|$)/', $tail, $cm) && stripos($cm[1], 'ds-lint') === false && $cm[1] !== '') {
            $purpose = $cm[1];
        } elseif ($commentEnd === $start - 1 && $comment && !preg_match('/=====/', implode('', $comment))) {
            $text = preg_replace(['#^\s*/\*+#', '#\*+/\s*$#'], '', implode(' ', array_map('trim', $comment)));
            $text = trim(preg_replace('/\s+/', ' ', $text));
            if ($text !== '' && stripos($text, 'ds-lint') === false) $purpose = $text;
        }
        $tokens[$name] = ['value' => $value, 'purpose' => $purpose, 'group' => $group];
    }
    return $tokens;
}

$rawTokens = ds_parse_tokens(file_get_contents($tokensPath));

/** Follow single var() aliases to the last token name in the chain. */
$resolveChain = function (string $name) use ($rawTokens): array {
    $chain = [];
    $seen = [];
    while (isset($rawTokens[$name]) && !isset($seen[$name])) {
        $seen[$name] = true;
        if (!preg_match('/^var\(\s*(--[a-z0-9-]+)\s*(?:,[^)]*)?\)$/i', $rawTokens[$name]['value'], $vm)) break;
        $name = $vm[1];
        $chain[] = $name;
    }
    return $chain;
};

$tokens = [];
foreach ($rawTokens as $name => $t) {
    $bare   = substr($name, 2);
    $family = explode('-', $bare)[0];
    $chain  = $resolveChain($name);
    $end    = $chain ? end($chain) : null;
    $brandUse = null;
    foreach ($chain as $link) { if (preg_match('/^--brand(-|$)/', $link)) { $brandUse = $link; break; } }

    if (preg_match('/^brand(-|$)/', $bare)) $tier = 'brand';
    elseif (in_array($family, $LEGACY_FAMILIES, true) && $chain) $tier = 'alias';
    elseif (in_array($family, $LEGACY_FAMILIES, true)) $tier = 'primitive';
    elseif (str_contains($t['value'], 'var(') || stripos((string) $t['group'], 'SEMANTIC') !== false) $tier = 'semantic';
    else {
        $tier = 'primitive';
        foreach ($SEMANTIC_PREFIXES as $p) { if (str_starts_with($bare, $p)) { $tier = 'semantic'; break; } }
    }

    $entry = ['value' => $t['value']];
    if ($end !== null) $entry['resolved'] = $rawTokens[$end]['value'] ?? null;
    $entry['purpose'] = $t['purpose'];
    $entry['group']   = $t['group'];
    $entry['tier']    = $tier;
    if ($tier === 'alias' && $brandUse !== null) $entry['use'] = $brandUse;
    if (!empty($t['modes'])) $entry['modes'] = $t['modes'];
    $tokens[$name] = $entry;
}

// ---- The tokens each component draws with, from components.css --------------
// A rule belongs to the components that render what its selector styles. Its
// compounds are read right to left, and the first one naming something a
// template renders decides, so `.ws-card .ws-btn` is the button's rule and
// `.ws-table th` the table's. A selector naming a ws-/wl- class belongs to that
// class's owners or to none; one naming none falls to any other class a template
// writes in a class attribute (.listing-card), then to a data attribute it
// renders ([data-tooltip]). A class written whole wins over one a
// template builds from a prefix ('ws-btn--' . $variant). A helper that renders
// nothing of its own takes what the first helper it calls renders (ws_status
// draws a ws_badge), and a _start or _end helper that renders nothing takes its
// partner's.
// Component-local custom properties (--wea-*) are not tokens: the tokens their
// definitions name count for the rule that defines them. Page and app CSS is
// not read, so a component styled only there lists no tokens.

/** The template files a piece of a helper includes or requires by path (__DIR__ . '/x.php', dirname(__DIR__) . '/partials/x.php'), helpers.php left out. */
function ds_includes(string $src, string $file): array {
    preg_match_all("/(?:include|require)(?:_once)?\s*\(?\s*(__DIR__|dirname\(__DIR__\))\s*\.\s*'(\/[A-Za-z0-9_\/-]+\.php)'/", $src, $im, PREG_SET_ORDER);
    $paths = [];
    foreach ($im as [, $base, $rel]) {
        $path = ($base === '__DIR__' ? dirname($file) : dirname($file, 2)) . $rel;
        // The helper library itself (footer.php requires helpers.php for its functions) is not markup.
        if (is_readable($path) && !str_ends_with(str_replace('\\', '/', $path), 'includes/components/helpers.php')) $paths[] = $path;
    }
    return array_values(array_unique($paths));
}

/** A helper's rendered source: its template source plus the files it includes, two levels deep. */
function ds_rendered_source(string $src, string $file, int $depth = 0): string {
    if ($depth > 1) return $src;
    foreach (ds_includes($src, $file) as $path) {
        $inc = file_get_contents($path);
        if (!str_contains($src, $inc)) $src .= "\n" . ds_rendered_source($inc, $path, $depth + 1);
    }
    return $src;
}

/** The ws_* functions a piece of PHP calls, in order, read by the tokenizer: a name in a string or a comment is not a call. */
function ds_php_calls(string $code): array {
    $skip = [T_WHITESPACE, T_COMMENT, T_DOC_COMMENT];
    $member = [T_FUNCTION, T_OBJECT_OPERATOR, T_NULLSAFE_OBJECT_OPERATOR, T_DOUBLE_COLON];
    $tokens = token_get_all($code);
    $out = [];
    $prev = null;
    for ($i = 0, $n = count($tokens); $i < $n; $i++) {
        $t = $tokens[$i];
        if (is_array($t) && in_array($t[0], $skip, true)) continue;
        if (is_array($t) && in_array($t[0], [T_STRING, T_NAME_FULLY_QUALIFIED], true) && str_starts_with(ltrim($t[1], '\\'), 'ws_')) {
            $j = $i + 1;
            while ($j < $n && is_array($tokens[$j]) && in_array($tokens[$j][0], $skip, true)) $j++;
            if ($j < $n && $tokens[$j] === '(' && !(is_array($prev) && in_array($prev[0], $member, true))) $out[ltrim($t[1], '\\')] = true;
        }
        $prev = $t;
    }
    return array_keys($out);
}

/** The ws_* helpers a helper calls: from its own body, then from the templates it includes, two levels deep. */
function ds_helper_calls(string $code, string $file, bool $isBody = true, int $depth = 0): array {
    $calls = ds_php_calls($isBody ? '<?php ' . $code : $code);
    if ($depth > 1) return $calls;
    foreach (ds_includes($code, $file) as $path) {
        $calls = array_merge($calls, ds_helper_calls(file_get_contents($path), $path, false, $depth + 1));
    }
    return array_values(array_unique($calls));
}

/** What a template renders that a selector can name: ws-/wl- classes whole and as prefixes, other classes, data attributes. */
function ds_template_hooks(string $src): array {
    $src = preg_replace(['#/\*.*?\*/#s', '#<!--.*?-->#s', '#^\s*//.*$#m'], '', $src);
    $whole = []; $prefixes = []; $other = []; $attrs = [];
    preg_match_all('/(?<![A-Za-z0-9_-])((?:ws|wl)-[a-z0-9_-]+)/', $src, $m);
    foreach ($m[1] as $c) {
        if (!str_ends_with($c, '-')) $whole[$c] = true;
        elseif (ds_is_class_prefix($c)) $prefixes[$c] = true;
    }
    preg_match_all('/\bclass\s*=\s*(?:"([^"]*)"|\'([^\']*)\')/', $src, $m, PREG_SET_ORDER);
    foreach ($m as $g) {
        $value = preg_replace(['/<\?.*?\?>/s', '/\{\$[^}]*\}/', '/\$[A-Za-z_]\w*/'], ' ', ($g[1] ?? '') . ($g[2] ?? ''));
        foreach (preg_split('/\s+/', $value) as $c) {
            if (preg_match('/^[a-z][a-z0-9_-]*[a-z0-9]$/', $c) && !preg_match('/^(?:ws|wl)-/', $c)) $other[$c] = true;
        }
    }
    preg_match_all('/(?<![A-Za-z0-9_-])(data-[a-z0-9]+(?:-[a-z0-9]+)*)/', $src, $m);
    foreach ($m[1] as $a) $attrs[$a] = true;
    return ['whole' => array_keys($whole), 'prefixes' => array_keys($prefixes), 'other' => array_keys($other), 'attrs' => array_keys($attrs)];
}

/** The offset just past the brace that closes the block opened at $open. */
function ds_css_block_end(string $css, int $open): int {
    $depth = 0;
    for ($i = $open, $n = strlen($css); $i < $n; $i++) {
        if ($css[$i] === '{') $depth++;
        elseif ($css[$i] === '}' && --$depth === 0) return $i + 1;
    }
    return $n;
}

/**
 * Every style rule in a comment-free stylesheet as [selector list, declarations].
 * Grouping at-rules (@media, @container, @supports, @layer, @starting-style) are
 * opened; any other at-rule block (@keyframes, @font-face) is skipped whole.
 */
function ds_css_style_rules(string $css): array {
    $rules = [];
    $pos = 0;
    while (preg_match('/[{}]/', $css, $m, PREG_OFFSET_CAPTURE, $pos)) {
        $at = $m[0][1];
        if ($m[0][0] === '}') { $pos = $at + 1; continue; }
        $prelude = substr($css, $pos, $at - $pos);
        if (($semi = strrpos($prelude, ';')) !== false) $prelude = substr($prelude, $semi + 1);
        $prelude = trim($prelude);
        if (str_starts_with($prelude, '@')) {
            $pos = preg_match('/^@(?:media|container|supports|layer|starting-style)\b/i', $prelude) ? $at + 1 : ds_css_block_end($css, $at);
            continue;
        }
        $end = ds_css_block_end($css, $at);
        $rules[] = [$prelude, substr($css, $at + 1, $end - $at - 2)];
        $pos = $end;
    }
    return $rules;
}

/** $s split at any character of $seps that sits outside brackets, parentheses and quotes. */
function ds_css_split(string $s, string $seps): array {
    $parts = []; $buf = ''; $depth = 0; $quote = null;
    for ($i = 0, $n = strlen($s); $i < $n; $i++) {
        $c = $s[$i];
        if ($quote !== null) { if ($c === $quote) $quote = null; $buf .= $c; continue; }
        if ($c === '"' || $c === "'") $quote = $c;
        elseif ($c === '(' || $c === '[') $depth++;
        elseif ($c === ')' || $c === ']') $depth--;
        elseif ($depth === 0 && str_contains($seps, $c)) { $parts[] = $buf; $buf = ''; continue; }
        $buf .= $c;
    }
    $parts[] = $buf;
    return array_values(array_filter(array_map('trim', $parts), 'strlen'));
}

$hooksOf = [];
$renderedOf = [];
foreach ($found as $name => $info) {
    $renderedOf[$name] = ds_rendered_source($templateSrc[$name]['src'] ?? $info['body'], $info['file']);
    $hooksOf[$name] = ds_template_hooks($renderedOf[$name]);
}
$rendersNothing = fn(array $h): bool => !$h['whole'] && !$h['prefixes'] && !$h['other'] && !$h['attrs'];
$calls = [];  // helper => the other helpers it calls, in order
foreach ($found as $name => $info) {
    $calls[$name] = array_values(array_filter(ds_helper_calls($info['body'], $info['file']), fn($c) => $c !== $name && isset($found[$c])));
}
// What a helper that renders nothing draws: the first helper it calls that draws
// something, followed through wrappers in call order whatever order they were scanned in.
$resolvedHooks = [];
$resolveHooks = function (string $name, array $seen) use (&$resolveHooks, &$resolvedHooks, $hooksOf, $calls, $rendersNothing): array {
    if (isset($resolvedHooks[$name])) return $resolvedHooks[$name];
    $hooks = $hooksOf[$name];
    if ($rendersNothing($hooks)) {
        $seen[$name] = true;
        foreach ($calls[$name] as $callee) {
            if (isset($seen[$callee])) continue;
            $theirs = $resolveHooks($callee, $seen);
            if (!$rendersNothing($theirs)) { $hooks = $theirs; break; }
        }
    }
    return $resolvedHooks[$name] = $hooks;
};
foreach (array_keys($found) as $name) $resolveHooks($name, []);
$hooksOf = $resolvedHooks;
foreach ($found as $name => $info) {
    if (!$rendersNothing($hooksOf[$name]) || !preg_match('/^(.+)_(start|end)$/', $name, $pm)) continue;
    $partner = $pm[1] . ($pm[2] === 'start' ? '_end' : '_start');
    if (isset($hooksOf[$partner])) $hooksOf[$name] = $hooksOf[$partner];
}
$owners = ['whole' => [], 'prefixes' => [], 'other' => [], 'attrs' => []];
foreach ($hooksOf as $name => $h) {
    foreach ($owners as $kind => $_) foreach ($h[$kind] as $hook) $owners[$kind][$hook][] = $name;
}

/** The components a selector styles: owners of the rightmost compound that names something a template renders. */
$ownersOf = function (string $selector) use ($owners): array {
    $selector = preg_replace('/:(?:not|has)\((?:[^()]|\((?:[^()]|\([^()]*\))*\))*\)/', '', $selector);
    $compounds = array_reverse(ds_css_split($selector, " \t\r\n>+~"));
    // A selector that names a ws-/wl- class styles that component or none: a generic
    // class beside it (.ws-chip__remove .material-symbols-outlined) is not evidence.
    $passes = preg_match('/\.(?:ws|wl)-/', $selector) ? ['ws'] : ['other', 'attrs'];
    foreach ($passes as $pass) {
        foreach ($compounds as $compound) {
            $found = [];
            if ($pass === 'attrs') {
                preg_match_all('/\[\s*(data-[a-z0-9-]+)/', $compound, $am);
                foreach ($am[1] as $a) foreach ($owners['attrs'][$a] ?? [] as $o) $found[$o] = true;
            } else {
                preg_match_all('/\.([A-Za-z_][A-Za-z0-9_-]*)/', $compound, $cm);
                $byPrefix = [];
                foreach ($cm[1] as $cls) {
                    $isWs = (bool) preg_match('/^(?:ws|wl)-/', $cls);
                    if ($pass === 'other') {
                        if (!$isWs) foreach ($owners['other'][$cls] ?? [] as $o) $found[$o] = true;
                        continue;
                    }
                    if (!$isWs) continue;
                    foreach ($owners['whole'][$cls] ?? [] as $o) $found[$o] = true;
                    foreach ($owners['prefixes'] as $p => $list) {
                        if (str_starts_with($cls, $p)) foreach ($list as $o) $byPrefix[$o] = true;
                    }
                }
                if (!$found) $found = $byPrefix;
            }
            if ($found) return array_keys($found);
        }
    }
    return [];
};

$directUsers = [];  // token => [component => true]
foreach (ds_css_style_rules($componentsCss) as [$selectorList, $decls]) {
    if (!preg_match_all('/var\(\s*(--[A-Za-z0-9_-]+)/', $decls, $vm)) continue;
    $used = array_filter(array_unique($vm[1]), fn($t) => isset($tokens[$t]));
    if (!$used) continue;
    foreach (ds_css_split($selectorList, ',') as $selector) {
        foreach ($ownersOf($selector) as $owner) {
            foreach ($used as $t) $directUsers[$t][$owner] = true;
        }
    }
}
foreach (array_keys($components) as $name) {
    $components[$name]['tokens'] = array_values(array_filter(array_keys($tokens), fn($t) => isset($directUsers[$t][$name])));
}

// usedBy is every component a change to the token reaches: the ones that name it,
// and the ones that name a token whose value (or a mode's) names it.
$referencedBy = [];
foreach ($tokens as $name => $t) {
    preg_match_all('/var\(\s*(--[A-Za-z0-9_-]+)/', implode(' ', array_merge([$t['value']], array_values($t['modes'] ?? []))), $rm);
    foreach (array_unique($rm[1]) as $ref) {
        if ($ref !== $name && isset($tokens[$ref])) $referencedBy[$ref][] = $name;
    }
}
$reach = function (string $token, array $seen) use (&$reach, $referencedBy, $directUsers): array {
    $out = $directUsers[$token] ?? [];
    $seen[$token] = true;
    foreach ($referencedBy[$token] ?? [] as $via) {
        if (!isset($seen[$via])) $out += $reach($via, $seen);
    }
    return $out;
};
foreach (array_keys($tokens) as $name) {
    $users = array_keys($reach($name, []));
    sort($users);
    $tokens[$name]['usedBy'] = $users;
}

$legacy = json_decode(file_get_contents($legacyPath), true);
if (!is_array($legacy)) {
    fwrite(STDERR, "FATAL: legacy-patterns.json is not valid JSON\n");
    exit(2);
}
unset($legacy['_comment']);

// ---- Screen recipes from recipes.json --------------------------------------
// The file is the contract: a recipe must list exactly the ws_* helpers its file
// calls, so an agent reading the catalog is never told to reach for one it skips.
$RECIPE_STATES = ['default', 'loading', 'empty', 'error'];
$recipes = [];
$recipeErrors = [];
$recipeSource = json_decode((string) @file_get_contents($recipesPath), true);
if (!is_array($recipeSource) || !is_array($recipeSource['recipes'] ?? null)) {
    $recipeErrors[] = 'recipes.json is missing or is not valid JSON with a "recipes" list';
    $recipeSource = ['recipes' => []];
}
foreach ($recipeSource['recipes'] as $r) {
    $id = is_array($r) ? (string) ($r['id'] ?? '') : '';
    if (!preg_match('/^[a-z0-9-]+$/', $id)) { $recipeErrors[] = 'a recipe has no valid id (lowercase letters, digits and hyphens)'; continue; }
    foreach (['title', 'whenToUse', 'mobile', 'why'] as $f) {
        if (!is_string($r[$f] ?? null) || trim($r[$f]) === '') $recipeErrors[] = "recipe $id has no $f";
    }
    $states = array_values(array_filter((array) ($r['states'] ?? []), 'is_string'));
    if ($missing = array_diff($RECIPE_STATES, $states)) $recipeErrors[] = "recipe $id does not show the " . implode(', ', $missing) . ' state(s)';
    $listed = array_values(array_filter((array) ($r['components'] ?? []), 'is_string'));
    foreach ($listed as $name) {
        if (!isset($components[$name])) $recipeErrors[] = "recipe $id lists $name, which is not in the catalog";
    }
    $file = dirname(__DIR__) . '/recipes/' . $id . '.php';
    if (!is_readable($file)) {
        $recipeErrors[] = "recipe $id has no file design-system/recipes/$id.php";
    } else {
        $code = preg_replace('#/\*.*?\*/|//[^\n]*#s', '', file_get_contents($file));
        preg_match_all('/(?<![a-z0-9_$>:])(ws_[a-z0-9_]+)\s*\(/', $code, $cm);
        $called = array_values(array_unique(array_filter($cm[1], fn($n) => isset($components[$n]))));
        if ($extra = array_diff($called, $listed)) $recipeErrors[] = "recipe $id calls " . implode(', ', $extra) . ' but does not list it in recipes.json';
        if ($unused = array_diff($listed, $called)) $recipeErrors[] = "recipe $id lists " . implode(', ', $unused) . ' but its file never calls it';
    }
    $previews = [];
    foreach ($states as $s) $previews[$s] = function_exists('dsRecipePreviewUrl') ? dsRecipePreviewUrl($id, $s) : null;
    $recipes[$id] = [
        'title'      => $r['title'] ?? null,
        'whenToUse'  => $r['whenToUse'] ?? null,
        'components' => $listed,
        'states'     => $states,
        'mobile'     => $r['mobile'] ?? null,
        'why'        => $r['why'] ?? null,
        'source'     => "/design-system/recipes/$id.php",
        'stylesheet' => '/design-system/assets/recipes.css',
        'guide'      => "/design-system/patterns/composition.php#recipe-$id",
        'preview'    => $previews['default'] ?? null,
        'previews'   => (object) $previews,
    ];
}
sort($recipeErrors);
foreach ($components as $name => $c) {
    foreach ($c['insteadOf'] as $alt) {
        if (str_starts_with($alt['use'], 'recipe:') && !isset($recipes[substr($alt['use'], 7)])) $insteadOfErrors[] = "$name @insteadOf names {$alt['use']}, which is not in recipes.json";
    }
}
sort($insteadOfErrors);

$scopeCount = array_count_values(array_column($components, 'scope'));
ksort($scopeCount);
$coverage = [
    'example'   => count(array_filter($components, fn($c) => $c['example'] !== null)),
    'whenToUse' => count(array_filter($components, fn($c) => $c['whenToUse'] !== null)),
    'a11y'      => count(array_filter($components, fn($c) => $c['a11y'] !== null)),
    'fixture'   => count(array_filter($components, fn($c) => $c['fixture'])),
    'autoPreview' => count(array_filter($components, fn($c) => $c['previewKind'] === 'auto')),
    'insteadOf' => count(array_filter($components, fn($c) => $c['insteadOf'])),
    'js'        => count(array_filter($components, fn($c) => $c['js'] !== null)),
    'tokens'    => count(array_filter($components, fn($c) => $c['tokens'])),
];

$catalog = [
    'meta' => [
        '_comment'      => 'GENERATED by design-system/generate-catalog.php. Do not edit by hand; run the generator. components: every ws_* function (helpers.php, includes/components/*.php, app/includes/workshop-list.php) with signature, optionSpec values and defaults, demo, fixture, previewKind (curated, auto or none) and preview URL, states, demo-extracted usage and tokens (the platform tokens its components.css rules name). tokens: every custom property in platform-tokens.css with purpose, group, tier, the --brand* token to use for an alias, and usedBy (every component whose components.css rules name it, directly or through a token whose value names it). legacy: design-system/legacy-patterns.json. recipes: design-system/recipes.json, whole screens with the helpers they call and a preview URL per state.',
        'generatedFrom' => ['/includes/components/helpers.php', '/includes/components/*.php', '/app/includes/workshop-list.php', '/design-system/platform-tokens.css', '/includes/components/components.css', '/design-system/legacy-patterns.json', '/design-system/recipes.json', '/design-system/recipes/*.php'],
        'enrichedFrom'  => ['/design-system/components/demos/*.php', '/design-system/workshopr-design-system.json', '/design-system/includes/playground-fixtures.php'],
        'count'         => count($components),
        'countByScope'  => $scopeCount,
        'tokenCount'    => count($tokens),
        'recipeCount'   => count($recipes),
        'coverage'      => $coverage,
        'optionConflicts' => $conflicts,
    ],
    'components' => $components,
    'tokens'     => $tokens,
    'legacy'     => $legacy,
    'recipes'    => (object) $recipes,
];

$json = json_encode($catalog, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n";

// ---- The knowledge graph: how components, tokens, recipes and rules connect --
// The same facts as the catalog, turned into edges an agent can walk: what a
// token change reaches, what a component is made of, what a rule names. Pages and
// stylesheets are left out because they change with every page edit; ds:graph
// reads them live (scripts/ds-graph.mjs).
$graphPath = dirname(__DIR__) . '/knowledge-graph/knowledge-graph.json';
$EDGE_TYPES = [
    'draws-with'  => 'component -> token: a components.css rule for something the component renders names the token',
    'calls'       => 'component -> component: the helper, or a template it includes, calls the other helper',
    'instead-use' => 'component -> component or recipe: its docblock says to use the other instead, and when (attrs.when)',
    'references'  => 'token -> token: the token\'s value names the other (attrs.mode when only a media mode does)',
    'replaced-by' => 'token or legacy pattern -> token or component: the legacy thing and what to use instead',
    'covers'      => 'legacy pattern -> token: the token matches a legacy token pattern',
    'uses'        => 'recipe -> component: the screen recipe calls the helper',
    'mentions'    => 'rule -> anything: the rule\'s text in workshopr-design-system.json names it',
];
$gNodes = [];
$gEdges = [];
$addEdge = function (string $from, string $type, string $to, array $attrs = []) use (&$gEdges): void {
    $gEdges[$from . "\0" . $type . "\0" . $to . "\0" . json_encode($attrs)] = $attrs ? [$from, $type, $to, $attrs] : [$from, $type, $to];
};
foreach ($components as $name => $c) {
    $gNodes["component:$name"] = array_filter(['type' => 'component', 'scope' => $c['scope'], 'summary' => $c['summary'] ?: null, 'source' => $c['source'], 'demo' => $c['demo']], fn($v) => $v !== null);
    foreach ($c['tokens'] as $t) $addEdge("component:$name", 'draws-with', "token:$t");
    foreach ($calls[$name] ?? [] as $callee) $addEdge("component:$name", 'calls', "component:$callee");
    foreach ($c['insteadOf'] as $alt) $addEdge("component:$name", 'instead-use', str_starts_with($alt['use'], 'recipe:') ? $alt['use'] : 'component:' . $alt['use'], ['when' => $alt['when']]);
}
foreach ($tokens as $name => $t) {
    $gNodes["token:$name"] = array_filter(['type' => 'token', 'tier' => $t['tier'], 'group' => $t['group'], 'value' => $t['value'], 'purpose' => $t['purpose']], fn($v) => $v !== null);
    preg_match_all('/var\(\s*(--[A-Za-z0-9_-]+)/', $t['value'], $rm);
    $inValue = array_unique($rm[1]);
    foreach ($inValue as $ref) if ($ref !== $name && isset($tokens[$ref])) $addEdge("token:$name", 'references', "token:$ref");
    foreach ($t['modes'] ?? [] as $mode => $value) {
        preg_match_all('/var\(\s*(--[A-Za-z0-9_-]+)/', $value, $rm);
        foreach (array_diff(array_unique($rm[1]), $inValue) as $ref) {
            if ($ref !== $name && isset($tokens[$ref])) $addEdge("token:$name", 'references', "token:$ref", ['mode' => $mode]);
        }
    }
    if (isset($t['use']) && isset($tokens[$t['use']])) $addEdge("token:$name", 'replaced-by', "token:{$t['use']}");
}
foreach ($recipes as $id => $r) {
    $gNodes["recipe:$id"] = ['type' => 'recipe', 'title' => $r['title'], 'source' => $r['source']];
    foreach ($r['components'] as $name) $addEdge("recipe:$id", 'uses', "component:$name");
}
foreach ($legacy['classes'] ?? [] as $l) {
    if (!is_array($l) || !isset($l['pattern'])) continue;
    $id = 'legacy:' . $l['pattern'];
    $gNodes[$id] = array_filter(['type' => 'legacy-class', 'why' => $l['why'] ?? null], fn($v) => $v !== null);
    $use = (string) ($l['use'] ?? '');
    if (isset($components[$use])) $addEdge($id, 'replaced-by', "component:$use");
    elseif (isset($tokens[$use])) $addEdge($id, 'replaced-by', "token:$use");
    elseif ($use !== '') $gNodes[$id]['use'] = $use;
}
foreach ($legacy['tokens'] ?? [] as $l) {
    if (!is_array($l) || !isset($l['pattern'])) continue;
    $id = 'legacy:' . $l['pattern'];
    $gNodes[$id] = array_filter(['type' => 'legacy-token', 'use' => $l['use'] ?? null, 'why' => $l['why'] ?? null], fn($v) => $v !== null);
    $match = '/' . str_replace('/', '\/', (string) ($l['match'] ?? '')) . '/';
    if (($l['match'] ?? '') === '' || @preg_match($match, '') === false) continue;
    foreach (array_keys($tokens) as $name) if (preg_match($match, $name)) $addEdge($id, 'covers', "token:$name");
}
// A rule names a helper, a token, a legacy pattern or a file; a named file that
// no longer exists is kept, marked missing, because that is a stale rule.
foreach ($curatedJson['rules'] ?? [] as $key => $rule) {
    if ($key === '' || $key[0] === '_' || !is_array($rule)) continue;
    $gNodes["rule:$key"] = array_filter(['type' => 'rule', 'rule' => $rule['rule'] ?? null, 'severity' => $rule['severity'] ?? null], fn($v) => $v !== null);
    $text = json_encode($rule, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    preg_match_all('/(?<![A-Za-z0-9_])ws_[a-z0-9_]+/', $text, $m);
    foreach (array_unique($m[0]) as $n) if (isset($components[$n])) $addEdge("rule:$key", 'mentions', "component:$n");
    preg_match_all('/(?<![A-Za-z0-9_-])--[a-z][a-z0-9-]*[a-z0-9]/', $text, $m);
    foreach (array_unique($m[0]) as $n) if (isset($tokens[$n])) $addEdge("rule:$key", 'mentions', "token:$n");
    foreach (array_keys($gNodes) as $id) {
        if (str_starts_with($id, 'legacy:.') && preg_match('/(?<![A-Za-z0-9_-])' . preg_quote(substr($id, 7), '/') . '(?![A-Za-z0-9_-])/', $text)) $addEdge("rule:$key", 'mentions', $id);
    }
    preg_match_all('#(?<![A-Za-z0-9_.:/-])(/[A-Za-z0-9_.-]+(?:/[A-Za-z0-9_.-]+)*\.(?:php|css|json|js|md))(?![A-Za-z0-9])#', $text, $m);
    foreach (array_unique($m[1]) as $path) {
        $gNodes["file:$path"] = ['type' => 'file', 'exists' => null];
        $addEdge("rule:$key", 'mentions', "file:$path");
    }
}
// A named file exists when git tracks it, so a gitignored local copy (coach/ is
// gitignored) cannot make this machine's graph differ from CI's. The pre-commit
// snapshot is not a repository; there, being in the snapshot is being in the index.
$namedFiles = array_map(fn($id) => substr($id, 5), array_values(array_filter(array_keys($gNodes), fn($id) => str_starts_with($id, 'file:'))));
$trackedFiles = null;
if ($namedFiles && file_exists($root . '/.git')) {
    exec('git -C ' . escapeshellarg($root) . ' ls-files -z -- ' . implode(' ', array_map(fn($p) => escapeshellarg(ltrim($p, '/')), $namedFiles)) . ' 2>/dev/null', $lsOut, $lsRc);
    if ($lsRc === 0) $trackedFiles = array_flip(array_filter(explode("\0", implode('', $lsOut)), 'strlen'));
}
foreach ($namedFiles as $path) {
    $gNodes["file:$path"]['exists'] = $trackedFiles !== null ? isset($trackedFiles[ltrim($path, '/')]) : is_file($root . $path);
}
ksort($gNodes);
$gEdges = array_values($gEdges);
usort($gEdges, fn($a, $b) => [$a[0], $a[1], $a[2], json_encode($a[3] ?? [])] <=> [$b[0], $b[1], $b[2], json_encode($b[3] ?? [])]);
foreach ($gEdges as $e) {
    foreach ([$e[0], $e[2]] as $end) if (!isset($gNodes[$end])) $gNodes[$end] = ['type' => explode(':', $end, 2)[0], 'missing' => true];
}
ksort($gNodes);
$countBy = fn(array $list) => (function () use ($list) { $c = array_count_values($list); ksort($c); return $c; })();
$jsonFlags = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;
$indent = fn(string $j) => str_replace("\n", "\n    ", $j);
$graphMeta = [
    '_comment'  => 'GENERATED by design-system/tools/generate-catalog.php, from the same sources as components.generated.json. Do not edit by hand; run the generator. '
                 . 'Nodes are keyed type:name (component, token, recipe, rule, legacy, file). Each edge is [from, type, to], with a fourth element of attributes when it has any. '
                 . 'What pages and stylesheets reach changes with every page edit, so it is not stored: npm run ds:graph -- <name> --impact reads it live.',
    'edgeTypes' => $EDGE_TYPES,
    'counts'    => ['nodes' => $countBy(array_column($gNodes, 'type')), 'edges' => $countBy(array_column($gEdges, 1))],
];
$graphJson = "{\n    \"meta\": " . $indent(json_encode($graphMeta, JSON_PRETTY_PRINT | $jsonFlags))
    . ",\n    \"nodes\": " . $indent(json_encode((object) $gNodes, JSON_PRETTY_PRINT | $jsonFlags))
    . ",\n    \"edges\": [\n" . implode(",\n", array_map(fn($e) => '        ' . json_encode($e, $jsonFlags), $gEdges)) . "\n    ]\n}\n";

// ---- Completeness ratchet --------------------------------------------------
// App-local helpers (ws_wl_*) are one page's internals, not a public surface, so
// the ratchet holds components and page-level helpers only.
$gaps = [];
foreach ($components as $name => $c) {
    if ($c['scope'] === 'app-local') continue;
    foreach (['whenToUse', 'example', 'a11y'] as $f) {
        if ($c[$f] === null) $gaps[] = "$name:$f";
    }
    if (preg_match('/\barray\s+\$(options|opts)\b/', $c['signature']) && !array_filter((array) $c['optionSpec'], fn($o) => isset($o['values']) || array_key_exists('default', $o))) {
        $gaps[] = "$name:options";
    }
}
sort($gaps);

$green = "\033[32m"; $red = "\033[31m"; $yellow = "\033[33m"; $reset = "\033[0m";

if ($rebase) {
    file_put_contents($basePath, json_encode([
        '_comment' => 'Ratchet for generate-catalog.php --check. Each entry is a ws_* function missing whenToUse, example or a11y '
                    . '(from its demo, or an @whenToUse / @example / @a11y tag in its docblock), or an options array with no documented values or defaults. A function not listed here '
                    . 'fails when it has a gap; fixing a listed gap fails until its entry is deleted. Never add an entry to unblock new code.',
        'gaps' => $gaps,
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n");
    echo "Wrote " . count($gaps) . " tolerated catalog gaps to " . basename($basePath) . "\n";
    exit(0);
}

if (!$check) {
    file_put_contents($outPath, $json);
    file_put_contents($graphPath, $graphJson);
    echo "{$green}Wrote{$reset} " . basename($outPath) . ": " . count($components) . " functions, " . count($tokens) . " tokens.\n";
    echo "{$green}Wrote{$reset} " . basename($graphPath) . ": " . count($gNodes) . " nodes, " . count($gEdges) . " edges.\n";
    if ($conflicts) echo "{$yellow}NOTE{$reset}  " . count($conflicts) . " option value conflict(s) in meta.optionConflicts; --check fails until they are resolved.\n";
    foreach (array_merge($recipeErrors, $insteadOfErrors) as $e) echo "{$yellow}NOTE{$reset}  $e; --check fails until it is fixed.\n";
    exit(0);
}

// ---- --check: freshness + curated-JSON signature parity + completeness ratchet ----
$errors = [];

$existing = is_readable($outPath) ? file_get_contents($outPath) : '';
if ($existing !== $json) {
    $errors[] = "components.generated.json is stale. Run: php design-system/tools/generate-catalog.php";
}
if ((is_readable($graphPath) ? file_get_contents($graphPath) : '') !== $graphJson) {
    $errors[] = "knowledge-graph/knowledge-graph.json is stale. Run: php design-system/tools/generate-catalog.php";
}

foreach ($curatedComponents as $key => $entry) {
    if ($key === '' || $key[0] === '_' || !is_array($entry)) continue;
    if (!isset($components[$key])) continue; // roster parity is check-drift's job
    $curatedSig = $entry['function'] ?? null;
    if ($curatedSig !== null && $curatedSig !== $components[$key]['signature']) {
        $errors[] = "Signature drift for {$key}:\n      source : {$components[$key]['signature']}\n      JSON   : {$curatedSig}";
    }
}

if ($conflicts) {
    $errors[] = "Option values disagree with components.css or between the template docblock and workshopr-design-system.json "
              . "(a value is valid only when components.css styles the class the template renders for it):\n    - " . implode("\n    - ", $conflicts);
}

if ($insteadOfErrors) {
    $errors[] = "@insteadOf lines name something the catalog does not have:\n    - " . implode("\n    - ", $insteadOfErrors);
}
if ($recipeErrors) {
    $errors[] = "Screen recipes disagree with recipes.json or their files:\n    - " . implode("\n    - ", $recipeErrors);
}

$baseline = is_readable($basePath) ? (json_decode(file_get_contents($basePath), true)['gaps'] ?? null) : null;
if (!is_array($baseline)) {
    $errors[] = "catalog-baseline.json is missing or unreadable. Run: php design-system/tools/generate-catalog.php --baseline";
} else {
    $new   = array_values(array_diff($gaps, $baseline));
    $fixed = array_values(array_diff($baseline, $gaps));
    if ($new) {
        $errors[] = "New catalog gaps (document them in the demo, or give the options values/defaults):\n    - " . implode("\n    - ", $new);
    }
    if ($fixed) {
        $errors[] = "Gaps fixed since the baseline; delete these entries from catalog-baseline.json:\n    - " . implode("\n    - ", $fixed);
    }
}

echo "\nComponent catalog check\n  functions: " . count($components) . "  tokens: " . count($tokens) . "  recipes: " . count($recipes)
    . "  tolerated gaps: " . count($gaps) . "\n\n";
if (!$errors) {
    echo "{$green}PASS{$reset}  Generated catalog and knowledge graph are current, curated signatures match source, no new catalog gaps.\n\n";
    exit(0);
}
foreach ($errors as $e) echo "{$red}FAIL{$reset}  $e\n";
echo "\n{$red}" . count($errors) . " issue(s).{$reset}\n\n";
exit(1);
