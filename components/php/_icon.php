<?php
/**
 * Shared helpers for the Workshopr\DS portable PHP components.
 * Keep this dependency-free so the components work without the rest of the app.
 */

namespace Workshopr\DS;

if (!function_exists('Workshopr\\DS\\icon')) {
    /** Render a Google Material Symbols icon. */
    function icon(string $name, string $class = ''): string
    {
        $cls = trim('material-symbols-outlined ' . $class);
        return '<span class="' . htmlspecialchars($cls) . '" aria-hidden="true">'
            . htmlspecialchars($name) . '</span>';
    }
}

if (!function_exists('Workshopr\\DS\\cx')) {
    /** Join a list of class names, dropping empty/false/null entries. */
    function cx(array $classes): string
    {
        return implode(' ', array_filter(
            $classes,
            static fn($c) => $c !== '' && $c !== null && $c !== false
        ));
    }
}

if (!function_exists('Workshopr\\DS\\attrs')) {
    /**
     * Build an HTML attribute string from an assoc array.
     * - true  => boolean attribute (e.g. disabled)
     * - false/null => omitted
     */
    function attrs(array $attrs): string
    {
        $parts = [];
        foreach ($attrs as $k => $v) {
            if ($v === true) {
                $parts[] = htmlspecialchars((string) $k);
            } elseif ($v === false || $v === null) {
                continue;
            } else {
                $parts[] = htmlspecialchars((string) $k) . '="' . htmlspecialchars((string) $v) . '"';
            }
        }
        return implode(' ', $parts);
    }
}

if (!function_exists('Workshopr\\DS\\e')) {
    /** Short HTML-escape helper. */
    function e(?string $s): string
    {
        return htmlspecialchars($s ?? '');
    }
}
