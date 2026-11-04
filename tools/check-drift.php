<?php
/**
 * check-drift.php — Design System drift guard.
 *
 * The JSON (workshopr-design-system.json) is a hand-maintained mirror of the
 * real implementation truth (platform-tokens.css + includes/components/helpers.php).
 * This script fails (exit 1) if the mirror has fallen out of sync, so drift
 * cannot be silently merged.
 *
 * Checks:
 *   1. Every ws_* function in helpers.php is documented somewhere in the JSON
 *      components block (top-level key OR nested convenience/alternatives/related text).
 *   2. Phase-color tokens in platform-tokens.css agree with the JSON apps/phases.
 *   3. Every var(--x) reference in shipped CSS names a custom property that is
 *      defined somewhere real. A reference to a property defined nowhere is
 *      invalid at computed-value time and silently becomes the property's
 *      initial value — the Aug 2026 var(--space-7) bug shipped a padding of 0
 *      this way, and no other check looks at whether a token EXISTS.
 *   4. Card rules draw their padding and radius from card tokens, not literals,
 *      so the card family stays one size. Ratcheted against
 *      card-geometry-baseline.json — legacy literals are tolerated and counted,
 *      anything new fails.
 *   5. Every custom property defined in platform-tokens.css appears in the
 *      tokens section of components.generated.json, the catalog agents read.
 *
 * Usage:   php design-system/tools/check-drift.php
 *          php design-system/tools/check-drift.php --list-var-warnings   full warn list for check 3
 *          php design-system/tools/check-drift.php --self-test           run checks 3, 4 and 6 fixtures
 *          php design-system/tools/check-drift.php --card-baseline       rewrite check 4's ratchet
 *          php design-system/tools/check-drift.php --tokens-css=PATH     read a copy of the token sheet
 * CI:      exits 0 = clean, 1 = drift found.
 */

$root      = dirname(__DIR__, 2);
$jsonPath  = dirname(__DIR__) . '/workshopr-design-system.json';
$cssPath   = dirname(__DIR__) . '/platform-tokens.css';
$helpers   = $root . '/includes/components/helpers.php';

$errors   = [];
$warnings = [];

/**
 * Known, human-reviewed discrepancies. Each keeps the baseline green while
 * staying visible (printed as WARN), so only NEW drift fails the build.
 * Remove an entry once the underlying source is reconciled.
 *
 * Signatures:
 *   "phase-color:<app>"   — accepted color mismatch between CSS and JSON
 *   "undocumented:<fn>"   — accepted helper not yet in the JSON catalog
 */
$KNOWN_DRIFT = [
    // Reconciled 2026-06: tips kept Facilitate purple (Learn content, deliberate brand
    // exception) and training/academy kept Learn red — JSON updated to match the shipped
    // tokens, so both now pass without an allowlist entry. See START-HERE.md.
];

$CLI_FLAGS = array_flip(array_slice($argv ?? [], 1));
// --tokens-css=PATH reads a copy of the token sheet, so Check 5 can be proved
// against a mutated file without touching the real one.
foreach (array_keys($CLI_FLAGS) as $flag) {
    if (str_starts_with((string) $flag, '--tokens-css=')) $cssPath = substr($flag, strlen('--tokens-css='));
}

// --self-test exercises Check 3's parser against fixtures (including the
// historical var(--space-7) case) without touching the repo. Runs before the
// file loads so a broken JSON can't mask a parser regression.
if (isset($CLI_FLAGS['--self-test'])) {
    $bad = check3_self_test() + check4_self_test() + check6_self_test();   // all run; sum is the failure count
    exit($bad === 0 ? 0 : 1);
}

// ---- Load files ---------------------------------------------------------
foreach (['JSON' => $jsonPath, 'tokens CSS' => $cssPath, 'helpers.php' => $helpers] as $label => $p) {
    if (!is_readable($p)) {
        fwrite(STDERR, "FATAL: cannot read $label at $p\n");
        exit(2);
    }
}

$json     = json_decode(file_get_contents($jsonPath), true);
if ($json === null) {
    fwrite(STDERR, "FATAL: workshopr-design-system.json is not valid JSON\n");
    exit(2);
}
$cssText  = file_get_contents($cssPath);
$helpText = file_get_contents($helpers);
// The whole JSON as a string, so nested convenience/alternatives/related
// mentions of a function name count as "documented".
$jsonText = file_get_contents($jsonPath);

// ---- Check 1: every ws_* helper is documented in the JSON ---------------
preg_match_all('/^function (ws_[a-z0-9_]+)\s*\(/mi', $helpText, $m);
$functions = array_unique($m[1]);
sort($functions);

$undocumented = [];
foreach ($functions as $fn) {
    // documented if it appears as a JSON component key OR anywhere in the JSON text
    if (strpos($jsonText, $fn) === false) {
        $sig = "undocumented:$fn";
        if (isset($KNOWN_DRIFT[$sig])) {
            $warnings[] = "[known] $sig — {$KNOWN_DRIFT[$sig]}";
        } else {
            $undocumented[] = $fn;
        }
    }
}
if ($undocumented) {
    $errors[] = "Undocumented ws_* helpers (in helpers.php but absent from the JSON):\n    - "
        . implode("\n    - ", $undocumented);
}

// ---- Check 1a: the ws_ namespace is not claimed outside the design system ----
/* A function named ws_* announces itself as part of the design system. If it is
   defined anywhere other than includes/components/, none of the checks in this
   file apply to it: it is not in the JSON, its tokens are never verified, and it
   can drift from the components it sits beside without anything noticing.
   Either move it into includes/components/ and document it, or give it a local
   prefix so ws_ keeps meaning one thing. */
$nsAllowed = ['includes/components/', 'includes/config.php'];
$nsStray   = [];
$nsIter = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS)
);
foreach ($nsIter as $file) {
    if (!$file->isFile() || $file->getExtension() !== 'php') continue;
    $rel = str_replace($root . '/', '', $file->getPathname());
    if (preg_match('#(^|/)(node_modules|vendor|\.git|\.claude/worktrees)/#', '/' . $rel)) continue;
    if (preg_match('/ \d+\.php$/', $rel)) continue;           // duplicate backups
    foreach ($nsAllowed as $ok) { if (str_starts_with($rel, $ok)) continue 2; }
    $src = file_get_contents($file->getPathname());
    if (!preg_match_all('/^\s*function\s+(ws_[a-z0-9_]+)\s*\(/mi', $src, $mm)) continue;
    $nsStray[$rel] = array_unique($mm[1]);
}
if ($nsStray) {
    $lines = [];
    foreach ($nsStray as $rel => $fns) {
        $lines[] = sprintf('%s — %d function(s): %s', $rel, count($fns),
            implode(', ', array_slice($fns, 0, 4)) . (count($fns) > 4 ? ', …' : ''));
    }
    $warnings[] = "ws_* functions defined outside includes/components/ (unchecked by this gate):\n    - "
        . implode("\n    - ", $lines);
}

// ---- Check 1b: every top-level JSON component maps to a real function ----
// Catches the reverse drift: a component renamed/removed in helpers.php but
// still listed as a top-level JSON entry. (Nested convenience/alternatives/
// related partials live inside a parent entry, not as top-level keys.)
$jsonComponentKeys = array_keys($json['components'] ?? []);
$orphans = [];
foreach ($jsonComponentKeys as $key) {
    if ($key === '' || $key[0] === '_') continue; // skip _comment/_css/_helpers/_templates
    if (!in_array($key, $functions, true)) {
        $orphans[] = $key;
    }
}
if ($orphans) {
    $errors[] = "JSON lists components with no matching ws_* function (renamed or removed?):\n    - "
        . implode("\n    - ", $orphans);
}

// ---- Check 2: phase colors agree between CSS and JSON -------------------
// Map: CSS --<app>-primary  ->  JSON apps.<app>.color
function css_var(string $css, string $name, int $depth = 0): ?string {
    if ($depth > 5) return null; // guard against circular aliases
    if (!preg_match('/--' . preg_quote($name, '/') . '\s*:\s*([^;]+);/', $css, $mm)) {
        return null;
    }
    $value = trim($mm[1]);
    // Direct hex
    if (preg_match('/^#[0-9A-Fa-f]{3,8}/', $value, $hx)) {
        return strtoupper($hx[0]);
    }
    // One level of indirection: var(--other[, fallback])
    if (preg_match('/var\(\s*--([a-z0-9-]+)\s*(?:,\s*(#[0-9A-Fa-f]{3,8}))?\)/i', $value, $vm)) {
        $resolved = css_var($css, $vm[1], $depth + 1);
        if ($resolved !== null) return $resolved;
        if (!empty($vm[2])) return strtoupper($vm[2]); // use fallback hex if alias unresolved
    }
    return null;
}

$apps = $json['apps'] ?? [];
foreach ($apps as $appName => $appData) {
    if (!is_array($appData)) continue;
    $jsonColor = strtoupper($appData['color'] ?? $appData['primary'] ?? '');
    if ($jsonColor === '') continue;
    $cssColor = css_var($cssText, "$appName-primary");
    if ($cssColor === null) {
        // not every JSON app has a --<app>-primary token (microsites); informational only
        $warnings[] = "No --{$appName}-primary token in platform-tokens.css (JSON says {$jsonColor}).";
        continue;
    }
    if ($cssColor !== $jsonColor) {
        $sig = "phase-color:$appName";
        $msg = "Phase color drift for '{$appName}': CSS --{$appName}-primary = {$cssColor}, JSON = {$jsonColor}.";
        if (isset($KNOWN_DRIFT[$sig])) {
            $warnings[] = "[known] $sig — {$KNOWN_DRIFT[$sig]}";
        } else {
            $errors[] = $msg;
        }
    }
}

// ---- Check 3: every var(--x) reference in CSS resolves to a definition ---
//
// A var() naming a custom property that is defined nowhere is invalid at
// computed-value time: the declaration silently resets to its initial value
// (padding → 0, background → transparent) with no console error. check-page.php
// verifies that values USE tokens; nothing verified the token EXISTS until the
// Aug 2026 var(--space-7) incident (the spacing scale has no --space-7, and a
// shipped padding collapsed to 0).
//
// What counts as "defined" is deliberately wider than platform-tokens.css +
// css/planner/base/_variables.css + the referencing file itself. A first scan
// under that strict rule flagged 55 files, nearly all working code, because
// this codebase legitimately defines properties in three other places:
//   - App-local token sheets consumed by sibling files of the same app
//     (--coach-* in css/coach/base/_variables.css, --fac-* in facilitator.css,
//     --admin-* in css/admin/*.css, and a dozen more).
//   - Inline style attributes emitted from PHP/JS markup — per-item values the
//     stylesheet can't know (--i stagger indexes, --cat-color category tints).
//   - Script-set properties: element.style.setProperty('--x', …), and React/
//     TSX inline-style computed keys (["--tint" as any]: tint — dna/mobile).
// So the definition universe is: every declaration in scanned CSS, plus
// literal `--x:` occurrences and quoted '--x' strings in script/markup
// sources (.php/.js/.html/.ts/.tsx/.jsx/.mjs).
// The trade-off (documented, accepted): a property defined in app A but
// referenced by app B's page that never loads A's sheet still passes — the
// checker is load-graph-blind. Catching the "defined nowhere at all" class is
// what would have stopped the shipped bug.
//
// A reference WITH a fallback — var(--x, 12px) — is valid CSS whose fallback
// carries at runtime, so it warns instead of failing.
//
// Accepted one-offs go in $KNOWN_DRIFT as "css-var:<file>:--<token>".

/** Strip /* comments *​/ while keeping line numbers true. */
function css_strip_comments(string $src): string {
    return preg_replace_callback('#/\*.*?\*/#s',
        fn($m) => str_repeat("\n", substr_count($m[0], "\n")), $src);
}

/** Custom properties declared in a chunk of CSS (incl. @property). */
function css_defined_props(string $src): array {
    $src = css_strip_comments($src);
    $out = [];
    if (preg_match_all('/(?<![\w-])--([A-Za-z][A-Za-z0-9_-]*)\s*:/', $src, $m)) {
        foreach ($m[1] as $n) $out[$n] = true;
    }
    if (preg_match_all('/@property\s+--([A-Za-z][A-Za-z0-9_-]*)/', $src, $m)) {
        foreach ($m[1] as $n) $out[$n] = true;
    }
    return $out;
}

/** var(--x…) references: [name, hasFallback, line] triples. */
function css_var_refs(string $src): array {
    $src = css_strip_comments($src);
    $out = [];
    if (preg_match_all('/var\(\s*--([A-Za-z][A-Za-z0-9_-]*)\s*([,)])?/',
            $src, $m, PREG_SET_ORDER | PREG_OFFSET_CAPTURE)) {
        foreach ($m as $hit) {
            $out[] = [
                $hit[1][0],
                ($hit[2][0] ?? '') === ',',
                substr_count($src, "\n", 0, $hit[0][1]) + 1,
            ];
        }
    }
    return $out;
}

/**
 * Custom properties a script/markup source may set at runtime: literal
 * `--x:` (inline style attributes, <style> blocks, JS object literals) and
 * any quoted '--x' string (setProperty calls, React computed style keys).
 */
function check3_inline_defs(string $src): array {
    $out = [];
    if (preg_match_all('/(?<![\w-])--([A-Za-z][A-Za-z0-9_-]*)\s*:/', $src, $m)) {
        foreach ($m[1] as $n) $out[$n] = true;
    }
    if (preg_match_all('/[\'"]--([A-Za-z][A-Za-z0-9_-]*)[\'"]/', $src, $m)) {
        foreach ($m[1] as $n) $out[$n] = true;
    }
    return $out;
}

/**
 * Directories the scan skips. Mirrors check-page.php's philosophy plus the
 * CSS-specific cases: dist/ bundles are compiler output (Tailwind's --tw-*
 * plumbing resolves through its own runtime defaults, not our sheets), and
 * mockups are deliberately standalone.
 */
function check3_excluded(string $path): bool {
    static $EXCLUDE = [
        '#/node_modules/#', '#/vendor/#', '#/\.git/#', '#/\.claude/#',
        '#/playwright-report/#', '#/test-results/#', '#/\.omc/#',
        '#/\.phpunit\.cache/#', '#/uploads/#', '#/ios/#',
        '#/dist/#', '#/mockups?/#',
        // Agent scratch, like .claude and .omc above: working copies of styles
        // that were never routes and are not the platform's to keep in line.
        '#/\.superpowers/#', '#/\.scratch/#',
    ];
    foreach ($EXCLUDE as $p) {
        if (preg_match($p, $path)) return true;
    }
    return false;
}

/** @return array{0: array<string,bool>, 1: string[]} [definition universe, css files] */
function check3_collect(string $root): array {
    $cssFiles = [];
    $defs = [];
    $it = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS)
    );
    foreach ($it as $f) {
        if (!$f->isFile()) continue;
        $ext = strtolower($f->getExtension());
        if (!in_array($ext, ['css', 'php', 'js', 'html', 'ts', 'tsx', 'jsx', 'mjs'], true)) continue;
        $path = $f->getPathname();
        if (check3_excluded($path)) continue;
        $src = @file_get_contents($path);
        if ($src === false) continue;
        if ($ext === 'css') {
            $cssFiles[] = $path;
            $defs += css_defined_props($src);
        } else {
            $defs += check3_inline_defs($src);
        }
    }
    sort($cssFiles);
    return [$defs, $cssFiles];
}

[$check3Defs, $check3CssFiles] = check3_collect($root);

$varFails = [];   // rel => token => ['n' => count, 'line' => first line]
$varWarnAgg = []; // token => ['refs' => n, 'files' => set]
foreach ($check3CssFiles as $path) {
    $rel = substr($path, strlen($root) + 1);
    foreach (css_var_refs(file_get_contents($path)) as [$name, $hasFallback, $line]) {
        if (isset($check3Defs[$name])) continue;
        $sig = "css-var:$rel:--$name";
        if (isset($KNOWN_DRIFT[$sig])) {
            $warnings[] = "[known] $sig — {$KNOWN_DRIFT[$sig]}";
            continue;
        }
        if ($hasFallback) {
            $varWarnAgg[$name]['refs'] = ($varWarnAgg[$name]['refs'] ?? 0) + 1;
            $varWarnAgg[$name]['files'][$rel] = true;
        } else {
            $varFails[$rel][$name]['n'] = ($varFails[$rel][$name]['n'] ?? 0) + 1;
            $varFails[$rel][$name]['line'] ??= $line;
        }
    }
}

if ($varFails) {
    $lines = [];
    foreach ($varFails as $rel => $tokens) {
        foreach ($tokens as $name => $info) {
            $lines[] = "$rel:{$info['line']} var(--$name)"
                . ($info['n'] > 1 ? " ×{$info['n']}" : '')
                . " — no definition anywhere, no fallback";
        }
    }
    $errors[] = "CSS references custom properties that are defined nowhere "
        . "(the declaration is invalid and silently resets — the var(--space-7) bug class):\n    - "
        . implode("\n    - ", $lines);
}

if ($varWarnAgg) {
    uasort($varWarnAgg, fn($a, $b) => $b['refs'] <=> $a['refs']);
    $shown = isset($CLI_FLAGS['--list-var-warnings']) ? $varWarnAgg : array_slice($varWarnAgg, 0, 12, true);
    foreach ($shown as $name => $agg) {
        $nf = count($agg['files']);
        $warnings[] = "--$name defined nowhere but always referenced with a fallback "
            . "({$agg['refs']} ref" . ($agg['refs'] > 1 ? 's' : '') . " in $nf file" . ($nf > 1 ? 's' : '') . ")";
    }
    $hidden = count($varWarnAgg) - count($shown);
    if ($hidden > 0) {
        $warnings[] = "…and $hidden more fallback-only tokens (run with --list-var-warnings for the full list).";
    }
}

// ---- Check 4: card geometry comes from tokens, not literals -------------
//
// Cards are the platform's most-repeated rectangle, and their padding and
// radius drifted per-app for years — the same visual object drawn at 16, 18,
// 20, 24 and 28px depending on which sheet won. --card-padding / --card-radius
// exist so the whole family moves together; a literal in a card rule opts that
// card out of the system silently.
//
// This is a RATCHET, not a clean-room rule: card-geometry-baseline.json holds
// the legacy declarations that predate the tokens, so they stay visible as a
// count without blocking. Anything NOT in the baseline fails. Removing a
// literal is always safe — the baseline only ever shrinks by hand.

/** The last compound in a selector, stripped of pseudo-classes/elements. */
function check4_key_class(string $selector): string {
    $parts = preg_split('/[\s>+~]+/', trim($selector));
    $last  = (string) end($parts);
    return preg_replace('/::?[a-z-]+(\([^)]*\))?/i', '', $last);
}

/**
 * Does a padding / border-radius value draw from the card family?
 *
 * Padding may also be `0`: a card that deliberately has no inset (one whose
 * content is a full-bleed image, say) is not drifting, it is opting out, and
 * there is no token for nothing.
 */
function check4_in_family(string $prop, string $value): bool {
    $v = strtolower($value);
    if ($prop === 'padding' && preg_match('/^0(px|rem|em)?$/', trim($v))) return true;
    $family = $prop === 'border-radius'
        ? ['--card-radius']
        : ['--card-padding', '--card-padding-compact', '--card-padding-roomy'];
    foreach ($family as $token) {
        if (strpos($v, 'var(' . $token) !== false) return true;
    }
    return false;
}

/**
 * Literal padding / border-radius declarations inside rules whose subject is a
 * card class (`.x-card`, plus BEM modifiers like `.ws-card--content`). Element
 * classes such as `.ws-card__title` are NOT cards and are left alone.
 *
 * Keyed by file + selector + property, so a media-query override of a selector
 * the base rule already sets shares one signature. That is deliberate: the
 * ratchet tracks "this card sets its own padding", not how many times.
 *
 * @return array<string,array{file:string,sel:string,prop:string,val:string,line:int}>
 *         keyed by signature "card-geo:<file>:<selector>:<prop>"
 */
function check4_card_geometry(array $cssFiles, string $root): array {
    $out = [];
    foreach ($cssFiles as $path) {
        $src = css_strip_comments((string) @file_get_contents($path));
        if (!preg_match_all('/([^{}]+)\{([^{}]*)\}/', $src, $rules, PREG_SET_ORDER | PREG_OFFSET_CAPTURE)) {
            continue;
        }
        $rel = substr($path, strlen($root) + 1);
        foreach ($rules as $rule) {
            $sel = trim($rule[1][0]);
            if ($sel === '' || $sel[0] === '@') continue;   // at-rule preludes carry no declarations

            $isCard = false;
            foreach (preg_split('/\s*,\s*/', $sel) as $one) {
                // The class name itself may carry hyphens (.ws-choice-card), so the
                // stem is greedy and backtracks onto the trailing -card. `__card` counts
                // too: a BEM element literally named "card" IS one, which is how
                // .app-settings__card drew 16px corners for months without this check
                // ever looking at it. Other elements (.ws-card__title) stay excluded.
                if (preg_match('/\.[A-Za-z0-9_-]+(-|__)card(--[A-Za-z0-9-]+)?$/', check4_key_class($one))) {
                    $isCard = true;
                    break;
                }
            }
            if (!$isCard) continue;

            $line = substr_count($src, "\n", 0, $rule[0][1]) + 1;
            foreach (explode(';', $rule[2][0]) as $decl) {
                if (!preg_match('/^\s*(padding|border-radius)\s*:\s*(\S.*?)\s*$/i', $decl, $d)) continue;
                $prop = strtolower($d[1]);
                // A token reference is not enough: it has to be THIS family's token.
                // --radius-2xl and --space-8 are both perfectly good tokens and both
                // put a card outside the card family, which is exactly the drift the
                // literals used to cause. Anything else is a hit.
                if (check4_in_family($prop, $d[2])) continue;
                $sig  = "card-geo:$rel:" . preg_replace('/\s+/', ' ', $sel) . ":$prop";
                $out[$sig] = ['file' => $rel, 'sel' => $sel, 'prop' => $prop, 'val' => $d[2], 'line' => $line];
            }
        }
    }
    return $out;
}

$check4Baseline = [];
$check4BasePath = dirname(__DIR__) . '/baselines/card-geometry-baseline.json';
if (is_readable($check4BasePath)) {
    $decoded = json_decode(file_get_contents($check4BasePath), true);
    if (!is_array($decoded)) {
        fwrite(STDERR, "FATAL: card-geometry-baseline.json is not valid JSON\n");
        exit(2);
    }
    $check4Baseline = array_flip($decoded['tolerated'] ?? []);
}

$check4Hits = check4_card_geometry($check3CssFiles, $root);

// --card-baseline rewrites the ratchet. Only ever run it deliberately: it
// forgives every literal currently in the tree, including one you just added.
if (isset($CLI_FLAGS['--card-baseline'])) {
    $sigs = array_keys($check4Hits);
    sort($sigs);
    file_put_contents($check4BasePath, json_encode([
        '_comment'  => 'Ratchet for check-drift.php Check 4. Card padding/radius literals that '
                     . 'predate --card-padding / --card-radius. Shrink this list by repointing a '
                     . 'card at the tokens and deleting its entry; never grow it to unblock new code.',
        'tolerated' => $sigs,
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n");
    echo "Wrote " . count($sigs) . " tolerated card-geometry literals to card-geometry-baseline.json\n";
    exit(0);
}

$check4New  = array_diff_key($check4Hits, $check4Baseline);
$check4Gone = count(array_diff_key($check4Baseline, $check4Hits));

if ($check4New) {
    $lines = [];
    foreach ($check4New as $hit) {
        $lines[] = "{$hit['file']}:{$hit['line']} {$hit['sel']} — {$hit['prop']}: {$hit['val']}";
    }
    sort($lines);
    $errors[] = "Card rules set geometry with literals instead of card tokens "
        . "(use var(--card-padding) / var(--card-padding-compact) / var(--card-radius) so the card family stays one size):\n    - "
        . implode("\n    - ", $lines);
}
if ($check4Baseline) {
    $tolerated = count($check4Baseline) - $check4Gone;
    $warnings[] = "$tolerated legacy card-geometry literal(s) tolerated from card-geometry-baseline.json"
        . ($check4Gone > 0 ? " ({$check4Gone} since fixed — trim them from the baseline)" : '');
}

// ---- Check 5: every token in platform-tokens.css is in the agent catalog --
//
// components.generated.json is the contract every agent tool reads, so a token
// it does not list is invisible to ds:find and the enforcer MCP. That is how the
// five --brand* tokens shipped in July 2026 while the tools went on teaching the
// per-phase aliases. Regenerate with php design-system/tools/generate-catalog.php.
$catalogPath = dirname(__DIR__) . '/components.generated.json';
$catalogData = is_readable($catalogPath) ? json_decode(file_get_contents($catalogPath), true) : null;
$check5Missing = [];
if (!is_array($catalogData) || !isset($catalogData['tokens']) || !is_array($catalogData['tokens'])) {
    $errors[] = "components.generated.json has no tokens section. Run: php design-system/tools/generate-catalog.php";
} else {
    foreach (array_keys(css_defined_props($cssText)) as $name) {
        if (!isset($catalogData['tokens']["--$name"])) $check5Missing[] = "--$name";
    }
    if ($check5Missing) {
        sort($check5Missing);
        $errors[] = "Tokens defined in platform-tokens.css but missing from the catalog tokens section "
            . "(agents cannot find them; run php design-system/tools/generate-catalog.php):\n    - "
            . implode("\n    - ", $check5Missing);
    }
}

// ---- Check 6: demo pages cite the tokens their component's CSS uses --------
// The demos are the design-system page agents read, so a token a demo names is a
// claim about the CSS, and in October 2026 61 of them were false: Tokens tables
// still listed --mainsite-primary and --phase-learn a month after components.css
// moved to the --brand* tokens. Each demo's Tokens table (its first column) is
// held to the custom properties its component reads or sets: every rule in
// components.css whose selector names the component's class block, plus the
// template's own <style>. A retired alias (--phase-*, --mainsite-*, --coach-*)
// may appear anywhere else in a demo only where that CSS still uses it, or on a
// line that says it is retired.

/** Demos whose class block is not ws-<file name>. An empty list means the
 *  component is styled outside components.css and its template, so its tokens
 *  cannot be checked here; it is reported as a warning instead. */
function check6_blocks(): array { return [
    'button'               => ['ws-btn'],
    'consent-row'          => ['ws-consent'],
    'energy-arc-card'      => ['ws-energy-arc'],
    'layout'               => ['ws-stack', 'ws-cluster', 'ws-grid', 'ws-container'],
    'level-up-grid'        => ['ws-level-up'],
    'nav'                  => ['wsh'],
    'planner-library-rail' => ['ws-planner-rail'],
    'results-overlay'      => ['ws-results'],
    'hero'                 => [],
    'listing-card'         => [],
    'tooltip'              => [],
]; }
/** Demos whose template file is not named after them. */
function check6_template(string $name): string { return ['nav' => 'header'][$name] ?? $name; }
// A function, not a const: --self-test runs before top-level constants are defined.
function check6_retired(): string { return '/--(?:phase|mainsite|coach)-[A-Za-z0-9_-]+/'; }
function check6_history(): string { return '/retired|legacy|no longer|used to|\bwas\b|\bwere\b|now Learn Red|never hardcode|alias/i'; }

/** [selector, body] for every innermost rule, so rules inside @media count too. */
function check6_rules(string $css): array {
    preg_match_all('/([^{}]+)\{([^{}]*)\}/', css_strip_comments($css), $m, PREG_SET_ORDER);
    return array_map(fn($r) => [$r[1], $r[2]], $m);
}

/** Custom properties a piece of CSS reads (var(--x)) or sets (--x:). */
function check6_props(string $css): array {
    $out = [];
    if (preg_match_all('/var\(\s*(--[A-Za-z][\w-]*)/', $css, $m)) foreach ($m[1] as $n) $out[$n] = true;
    if (preg_match_all('/(?<![\w-])(--[A-Za-z][\w-]*)\s*:/', $css, $m)) foreach ($m[1] as $n) $out[$n] = true;
    return $out;
}

/** What the demo's component uses, or null when its CSS lives elsewhere. */
function check6_component_props(string $name, array $rules, string $templateSrc): ?array {
    // A component's group or item block is the other number: ws-stat and ws-stats, ws-how-steps and ws-how-step.
    $blocks = check6_blocks()[$name] ?? ["ws-$name", str_ends_with($name, 's') ? 'ws-' . substr($name, 0, -1) : "ws-{$name}s"];
    if (!$blocks) return null;
    $pattern = '/\.(?:' . implode('|', array_map(fn($b) => preg_quote($b, '/'), $blocks)) . ')(?![a-z0-9])/';
    $props = [];
    foreach ($rules as [$selector, $body]) {
        if (preg_match($pattern, $selector)) $props += check6_props($body);
    }
    if (preg_match_all('#<style[^>]*>(.*?)</style>#is', $templateSrc, $m)) {
        foreach ($m[1] as $style) $props += check6_props(css_strip_comments($style));
    }
    return $props ?: null;
}

/** One demo's false claims: table rows naming what the CSS never uses, and retired aliases taught elsewhere. */
function check6_demo(string $src, array $props): array {
    $problems = [];
    $rest = $src;
    if (preg_match('#<h2 class="ds-section-title">\s*Tokens\s*</h2>(.*?)</table>#s', $src, $t, PREG_OFFSET_CAPTURE)) {
        preg_match_all('#<tr>(.*?)</tr>#s', $t[1][0], $rows);
        foreach ($rows[1] as $row) {
            if (!preg_match('#<td>(.*?)</td>#s', $row, $cell)) continue;
            preg_match_all('#<code>(--[\w-]+)</code>#', $cell[1], $codes);
            foreach ($codes[1] as $token) {
                if (!isset($props[$token])) $problems[] = "its Tokens table lists $token, which the component's CSS never uses";
            }
        }
        // The table is judged above; blank it, keeping line numbers, for the line pass.
        $rest = substr_replace($src, preg_replace('/[^\n]/', ' ', $t[0][0]), $t[0][1], strlen($t[0][0]));
    }
    foreach (explode("\n", $rest) as $i => $line) {
        if (!preg_match_all(check6_retired(), $line, $m) || preg_match(check6_history(), $line)) continue;
        foreach (array_unique($m[0]) as $token) {
            if (!isset($props[$token])) $problems[] = 'line ' . ($i + 1) . " teaches the retired alias $token";
        }
    }
    return array_values(array_unique($problems));
}

$check6Rules = check6_rules((string) @file_get_contents($root . '/includes/components/components.css'));
$check6Checked = 0;
$check6Unchecked = [];
$check6Problems = [];
foreach (glob(dirname(__DIR__) . '/components/demos/*.php') ?: [] as $demoPath) {
    $name = basename($demoPath, '.php');
    $template = $root . '/includes/components/' . check6_template($name) . '.php';
    $props = check6_component_props($name, $check6Rules, is_file($template) ? (string) file_get_contents($template) : '');
    $src = (string) file_get_contents($demoPath);
    if ($props === null) {
        if (preg_match('#<h2 class="ds-section-title">\s*Tokens\s*</h2>#', $src)) $check6Unchecked[] = $name;
        continue;
    }
    $check6Checked++;
    foreach (check6_demo($src, $props) as $problem) $check6Problems[] = "components/demos/$name.php: $problem";
}
if ($check6Unchecked) {
    $warnings[] = 'Demo token tables not checked, their component is styled outside components.css and its template: '
        . implode(', ', $check6Unchecked);
}
if ($check6Problems) {
    $errors[] = "Demo pages name tokens their component's CSS does not use (a demo is the page agents copy from; "
        . "name what the CSS reads, or say the alias is retired):\n    - " . implode("\n    - ", $check6Problems);
}

function check6_self_test(): int {
    global $green, $red, $reset;
    $css = ".ws-x { color: var(--brand); } @media (min-width: 1px) { .ws-x__a { --ws-x-gap: 4px; } } .ws-y { color: var(--phase-learn); }";
    $rules = check6_rules($css);
    $props = check6_component_props('x', $rules, '<style>.ws-x b { border-color: var(--phase-reflect); }</style>');
    $table = '<h2 class="ds-section-title">Tokens</h2><table><tr><td><code>%s</code></td><td>Fill</td></tr></table>';
    $cases = [
        ['rules inside @media are read', isset($props['--ws-x-gap'])],
        ['the template <style> counts', isset($props['--phase-reflect'])],
        ['another block does not count', !isset($props['--phase-learn'])],
        ['a token the CSS reads passes', check6_demo(sprintf($table, '--brand'), $props) === []],
        ['a stale table row fails', count(check6_demo(sprintf($table, '--mainsite-primary'), $props)) === 1],
        ['a retired alias in example code fails', count(check6_demo("<?= ws_x(['color' => 'var(--phase-learn)']) ?>", $props)) === 1],
        ['a retired alias the CSS still reads passes', check6_demo('Accent: --phase-reflect', $props) === []],
        ['a line saying it is retired passes', check6_demo('The --phase-plan colour was retired in July.', $props) === []],
        ['a component styled elsewhere is skipped', check6_component_props('hero', $rules, '') === null],
        ['the plural group block counts', isset(check6_component_props('x', check6_rules('.ws-xs { gap: var(--space-6); }'), '')['--space-6'])],
    ];
    $bad = 0;
    foreach ($cases as [$label, $ok]) {
        if (!$ok) $bad++;
        echo ($ok ? "{$green}PASS{$reset}" : "{$red}FAIL{$reset}") . "  $label\n";
    }
    echo $bad === 0
        ? "\n{$green}Check 6 self-test clean.{$reset}\n\n"
        : "\n{$red}$bad Check 6 self-test assertion(s) failed.{$reset}\n\n";
    return $bad;
}

/** Fixtures for --self-test: a synthetic universe that encodes the historical
 *  var(--space-7) case plus every parser subtlety, so the repo's own state
 *  can never mask a regression in this check. Returns a process exit code. */
function check3_self_test(): int {
    $tokens = "--space-6: 24px;\n--ok: 1;";
    $inlinePhp = '<div style="--runtime-set: 3"></div>';
    $inlineJs  = "el.style.setProperty('--js-set', hue);";
    $inlineTsx = 'style={{ ["--tsx-set" as any]: tint }}';
    $css = <<<'CSS'
:root { --local-def: red; }
/* a comment mentioning var(--in-comment) never counts */
.a { padding: var(--space-7) var(--space-6); }
.b { padding: var(--space-7, 28px); }
.c { color: var(--local-def); }
.d { color: var(--ok); }
.e { transition: all .2s var(--ghost); }
.f { width: var( --spaced-name , 4px); }
@property --registered { syntax: '*'; inherits: false; initial-value: 0; }
.g { top: var(--registered); }
.h { color: var(--runtime-set); border-color: var(--js-set); outline-color: var(--tsx-set); }
CSS;

    $defs = css_defined_props($tokens) + css_defined_props($css);
    foreach ([$inlinePhp, $inlineJs, $inlineTsx] as $src) {
        $defs += check3_inline_defs($src);
    }

    $fails = []; $warns = [];
    foreach (css_var_refs($css) as [$name, $hasFallback, $line]) {
        if (isset($defs[$name])) continue;
        if ($hasFallback) $warns[$name] = $line; else $fails[$name] = $line;
    }

    $expect = [
        ['fails carry exactly the undefined, fallback-less tokens',
            array_keys($fails) === ['space-7', 'ghost']],
        ['the historical case — var(--space-7), no fallback — FAILS',
            isset($fails['space-7']) && $fails['space-7'] === 3],
        ['a fallback demotes the same token to WARN',
            isset($warns['space-7'])],
        ['whitespace inside var( --x , f) still parses as a fallback ref',
            isset($warns['spaced-name'])],
        ['locally-defined, token-defined, @property and runtime-set names all resolve',
            !isset($fails['local-def']) && !isset($fails['ok']) && !isset($fails['registered'])
            && !isset($fails['runtime-set']) && !isset($fails['js-set']) && !isset($fails['tsx-set'])],
        ['references inside comments are ignored',
            !isset($fails['in-comment']) && !isset($warns['in-comment'])],
    ];

    $green = "\033[32m"; $red = "\033[31m"; $reset = "\033[0m";
    $bad = 0;
    echo "\nCheck 3 self-test\n";
    foreach ($expect as [$label, $ok]) {
        echo ($ok ? "{$green}PASS{$reset}" : "{$red}FAIL{$reset}") . "  $label\n";
        if (!$ok) $bad++;
    }
    echo $bad === 0
        ? "\n{$green}Check 3 self-test clean.{$reset}\n"
        : "\n{$red}$bad Check 3 self-test assertion(s) failed.{$reset}\n";
    return $bad;
}

/** Fixtures for Check 4: which selectors count as cards, and which
 *  declarations count as literals. Returns the number of failed assertions. */
function check4_self_test(): int {
    $css = <<<'CSS'
.wl-card { padding: 20px; border-radius: 12px; }
.ok-card { padding: var(--card-padding); border-radius: var(--card-radius, 12px); }
.ws-card--content { padding: 18px; }
.ws-card__title { padding: 4px; border-radius: 3px; }
.deck .promo-card:hover { border-radius: 9px; }
.card-shelf { padding: 30px; }
.ws-choice-card { padding: 21px; }
.app-settings__card { padding: var(--space-8); border-radius: var(--radius-2xl); }
.roomy-card { padding: var(--card-padding-roomy); }
.bleed-card { padding: 0; }
@media (max-width: 600px) { .wl-card { padding: 8px; } }
CSS;

    $tmp = tempnam(sys_get_temp_dir(), 'c4') . '.css';
    file_put_contents($tmp, $css);
    $hits = check4_card_geometry([$tmp], dirname($tmp));
    unlink($tmp);

    $sels = [];
    foreach ($hits as $h) $sels[] = "{$h['sel']}|{$h['prop']}";

    $expect = [
        ['a literal padding on a card class is caught',        in_array('.wl-card|padding', $sels, true)],
        ['a literal radius on a card class is caught',         in_array('.wl-card|border-radius', $sels, true)],
        ['a BEM modifier of a card is still a card',           in_array('.ws-card--content|padding', $sels, true)],
        ['pseudo-classes do not hide the card subject',        in_array('.deck .promo-card:hover|border-radius', $sels, true)],
        ['literals inside @media still count',                 count(array_filter($sels, fn($s) => $s === '.wl-card|padding')) >= 1],
        ['a card-family token passes',                         !in_array('.ok-card|padding', $sels, true)
                                                               && !in_array('.ok-card|border-radius', $sels, true)],
        ['--card-padding-roomy is in the family',              !in_array('.roomy-card|padding', $sels, true)],
        ['a zero inset is opting out, not drifting',           !in_array('.bleed-card|padding', $sels, true)],
        ['a token OUTSIDE the family is caught',               in_array('.app-settings__card|padding', $sels, true)
                                                               && in_array('.app-settings__card|border-radius', $sels, true)],
        ['a BEM element named "card" IS a card',               in_array('.app-settings__card|padding', $sels, true)],
        ['card ELEMENTS (__title) are not cards',              !in_array('.ws-card__title|padding', $sels, true)],
        ['a class merely containing "card" is not a card',     !in_array('.card-shelf|padding', $sels, true)],
        ['a multi-hyphen card name is still a card',           in_array('.ws-choice-card|padding', $sels, true)],
    ];

    $green = "\033[32m"; $red = "\033[31m"; $reset = "\033[0m";
    $bad = 0;
    echo "\nCheck 4 self-test\n";
    foreach ($expect as [$label, $ok]) {
        echo ($ok ? "{$green}PASS{$reset}" : "{$red}FAIL{$reset}") . "  $label\n";
        if (!$ok) $bad++;
    }
    echo $bad === 0
        ? "\n{$green}Check 4 self-test clean.{$reset}\n\n"
        : "\n{$red}$bad Check 4 self-test assertion(s) failed.{$reset}\n\n";
    return $bad;
}

// ---- Report -------------------------------------------------------------
$green = "\033[32m"; $red = "\033[31m"; $yellow = "\033[33m"; $reset = "\033[0m";

$topLevelJsonComponents = count(array_filter($jsonComponentKeys, fn($k) => $k !== '' && $k[0] !== '_'));
echo "\nDesign System drift check\n";
echo "  helpers.php functions  : " . count($functions) . "\n";
echo "  JSON components (top)   : " . $topLevelJsonComponents . "\n";
echo "  JSON apps checked       : " . count($apps) . "\n";
echo "  CSS files var-checked   : " . count($check3CssFiles) . "\n";
echo "  Card geometry literals  : " . count($check4Hits) . "\n";
echo "  Catalog tokens          : " . count($catalogData['tokens'] ?? []) . "\n";
echo "  Demo pages token-checked: " . $check6Checked . "\n\n";

foreach ($warnings as $w) {
    echo "{$yellow}WARN{$reset}  $w\n";
}

if (!$errors) {
    echo "{$green}PASS{$reset}  JSON mirror is in sync with platform-tokens.css and helpers.php.\n\n";
    exit(0);
}

foreach ($errors as $e) {
    echo "{$red}FAIL{$reset}  $e\n";
}
echo "\n{$red}" . count($errors) . " drift issue(s) found.{$reset} Fix the JSON (or the source) and re-run.\n\n";
exit(1);
