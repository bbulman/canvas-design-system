<?php
/**
 * generate-tokens-dtcg.php — export platform-tokens.css as W3C DTCG tokens.
 *
 * Emits tokens.dtcg.json in the Design Tokens Community Group format
 * (https://tr.designtokens.org/) so Style Dictionary, Figma, Tokens Studio,
 * and AI tooling can ingest the tokens canonically — with $type for each token
 * and var() references expressed as DTCG aliases ({group.name}).
 *
 * Tokens are grouped by their first name segment: --color-ink-secondary becomes
 * color -> "ink-secondary". The CSS comment on a token's line becomes $description.
 *
 * Modes:
 *   php design-system/tools/generate-tokens-dtcg.php          Write tokens.dtcg.json
 *   php design-system/tools/generate-tokens-dtcg.php --check   Fail (exit 1) if stale
 */

$cssPath = dirname(__DIR__) . '/platform-tokens.css';
$outPath = dirname(__DIR__) . '/tokens.dtcg.json';
$check   = in_array('--check', $argv, true);

if (!is_readable($cssPath)) {
    fwrite(STDERR, "FATAL: cannot read $cssPath\n");
    exit(2);
}
$css = file_get_contents($cssPath);

// ---- Collect raw tokens: name => [value, description] ------------------
// The base definition is the token: an @media override (forced-colors, prefers-contrast)
// is a mode, not the value, and letting the last definition win exported the focus ring
// as `Highlight`. A value may span lines (--paper-grid-image).
$raw = [];
$lines = explode("\n", $css);
$depth = 0;
$mediaDepth = null;
for ($i = 0, $n = count($lines); $i < $n; $i++) {
    $line = $lines[$i];
    if ($mediaDepth === null && preg_match('/^\s*@media\b/', $line)) $mediaDepth = $depth;
    $depth += substr_count($line, '{') - substr_count($line, '}');
    if ($mediaDepth !== null && $depth <= $mediaDepth) { $mediaDepth = null; continue; }
    if (!preg_match('/^\s*(--[a-z0-9-]+)\s*:\s*(.*)$/i', $line, $m)) continue;
    $rest = $m[2];
    while (!str_contains($rest, ';') && $i + 1 < $n) $rest .= ' ' . trim($lines[++$i]);
    if ($mediaDepth !== null || isset($raw[$m[1]])) continue;
    $value = trim(preg_replace('/\s+/', ' ', substr($rest, 0, strpos($rest, ';'))));
    $desc  = '';
    if (preg_match('/\/\*\s*(.*?)\s*\*\//', substr($rest, strpos($rest, ';') + 1), $cm)) {
        $c = trim($cm[1]);
        if (stripos($c, 'ds-lint') === false) $desc = $c; // skip lint directives
    }
    $raw[$m[1]] = ['value' => $value, 'desc' => $desc];
}

// ---- Helpers -----------------------------------------------------------
/** DTCG path for a token name: --color-ink-secondary -> "color.ink-secondary". */
function dtcg_path(string $name): array {
    $n = preg_replace('/^--/', '', $name);
    $seg = explode('-', $n, 2);
    return [$seg[0], $seg[1] ?? $seg[0]]; // [group, leaf]; single-segment -> group==leaf
}

/** Infer the DTCG $type from a raw CSS value. */
function dtcg_type(string $v): ?string {
    $v = trim($v);
    if (preg_match('/^#[0-9a-f]{3,8}$/i', $v) || preg_match('/^(rgb|hsl)a?\(/i', $v)) return 'color';
    if (stripos($v, 'gradient') !== false) return 'gradient';
    if (preg_match('/\d+\s*px.*(rgba?|hsla?|#)/i', $v) && strpos($v, ',') !== false) return 'shadow';
    if (preg_match('/^-?\d*\.?\d+(px|rem|em|%|vh|vw)$/i', $v)) return 'dimension';
    if (preg_match('/^-?\d*\.?\d+m?s$/i', $v)) return 'duration';
    if (preg_match('/^cubic-bezier|^(ease|linear|steps)/i', $v)) return 'cubicBezier';
    if (preg_match('/^\d*\.?\d+$/', $v)) return 'number';
    if (preg_match('/(serif|sans-serif|monospace|["\'])/i', $v) && strpos($v, ',') !== false) return 'fontFamily';
    if (preg_match('/^[1-9]\d{2}$/', $v)) return 'fontWeight';
    return null;
}

/** Turn a value into a DTCG $value, resolving a single var(--x[, fb]) to a {alias}. */
function dtcg_value(string $v, array $raw): string {
    if (preg_match('/^var\(\s*(--[a-z0-9-]+)\s*(?:,[^)]*)?\)$/i', trim($v), $m)) {
        [$g, $l] = dtcg_path($m[1]);
        return "{{$g}.{$l}}";
    }
    return $v;
}

// ---- Build nested DTCG tree -------------------------------------------
$tree = [
    '$description' => 'Workshopr design tokens in W3C DTCG format. GENERATED from design-system/platform-tokens.css by generate-tokens-dtcg.php — do not edit by hand.',
];
$count = 0;
foreach ($raw as $name => $info) {
    [$group, $leaf] = dtcg_path($name);
    $token = ['$value' => dtcg_value($info['value'], $raw)];
    $type = dtcg_type($info['value']);
    if ($type !== null) $token['$type'] = $type;
    if ($info['desc'] !== '') $token['$description'] = $info['desc'];
    $token['$extensions'] = ['com.workshopr.cssVar' => $name];
    if (!isset($tree[$group])) $tree[$group] = [];
    $tree[$group][$leaf] = $token;
    $count++;
}

$json = json_encode($tree, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n";

$green = "\033[32m"; $red = "\033[31m"; $reset = "\033[0m";

if (!$check) {
    file_put_contents($outPath, $json);
    echo "{$green}Wrote{$reset} " . basename($outPath) . " — {$count} tokens in DTCG format.\n";
    exit(0);
}

$existing = is_readable($outPath) ? file_get_contents($outPath) : '';
if ($existing !== $json) {
    echo "{$red}FAIL{$reset}  tokens.dtcg.json is stale. Run: php design-system/tools/generate-tokens-dtcg.php\n";
    exit(1);
}
echo "{$green}PASS{$reset}  tokens.dtcg.json is current ({$count} tokens).\n";
exit(0);
