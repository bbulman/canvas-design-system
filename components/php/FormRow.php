<?php
/**
 * FormRow — portable mirror of ws_form_row() / includes/components/form-row.php
 *
 * @param string $content  Inner field HTML (typically input()/select() output)
 * @param array  $options  label, required(bool), optional(bool), helper, error, inline(bool),
 *                         columns(int), id, class
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function form_row(string $content, array $options = []): string
{
    $label    = $options['label'] ?? '';
    $required = $options['required'] ?? false;
    $optional = $options['optional'] ?? false;
    $helper   = $options['helper'] ?? '';
    $error    = $options['error'] ?? '';
    $inline   = $options['inline'] ?? false;
    $columns  = $options['columns'] ?? null;
    $id       = $options['id'] ?? '';
    $class    = $options['class'] ?? '';

    $classString = cx([
        'ws-form-row',
        $inline ? 'ws-form-row--inline' : '',
        $error ? 'ws-form-row--error' : '',
        $class,
    ]);

    // Same binding as includes/components/form-row.php: one control gets the label's
    // for= and the note's aria-describedby; several, none, or one with its own label
    // make the row a labelled group.
    static $seq = 0;
    $seq++;
    $rowKey  = $id !== '' ? $id : 'ws-form-row-' . $seq;
    $noteId  = ($error || $helper) ? $rowKey . ($error ? '-error' : '-helper') : null;
    $labelId = $label ? $rowKey . '-label' : null;
    $fieldId = null;
    $group   = [];
    if ($label) {
        $visible = preg_replace_callback('#<(template|script)\b.*?</\1\s*>#is', fn($m) => str_repeat(' ', strlen($m[0])), $content);
        preg_match_all('/<(?:input|select|textarea)\b(?:[^>"\']|"[^"]*"|\'[^\']*\')*>/i', $visible, $found, PREG_OFFSET_CAPTURE);
        $controls = array_values(array_filter($found[0], fn($c) => strtolower((string) (form_row_tag_attrs($c[0])['type'] ?? '')) !== 'hidden'));
        $tagAttrs = count($controls) === 1 ? form_row_tag_attrs($controls[0][0]) : [];
        $ownLabel = isset($tagAttrs['id']) && preg_match('/<label\b[^>]*\sfor\s*=\s*["\']?' . preg_quote((string) $tagAttrs['id'], '/') . '["\'\s>]/i', $visible);
        if (count($controls) === 1 && !$ownLabel) {
            [$tag, $offset] = $controls[0];
            $add = [];
            if (isset($tagAttrs['id']) && $tagAttrs['id'] !== true && $tagAttrs['id'] !== '') {
                $fieldId = $tagAttrs['id'];
            } else {
                $fieldId = $rowKey . '-field';
                $add[] = 'id="' . e($fieldId) . '"';
            }
            $bound = $tag;
            if ($noteId) {
                $described = is_string($tagAttrs['aria-describedby'] ?? null) ? trim($tagAttrs['aria-describedby'] . ' ' . $noteId) : $noteId;
                if (isset($tagAttrs['aria-describedby'])) $bound = preg_replace('/\saria-describedby\s*=\s*(?:"[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $bound, 1);
                $add[] = 'aria-describedby="' . e($described) . '"';
            }
            if ($error && !isset($tagAttrs['aria-invalid'])) $add[] = 'aria-invalid="true"';
            if ($required && !isset($tagAttrs['required']) && !isset($tagAttrs['aria-required'])) $add[] = 'aria-required="true"';
            if ($add) $bound = preg_replace('/^<(\w+)/', '<$1 ' . implode(' ', $add), $bound);
            $content = substr_replace($content, $bound, $offset, strlen($tag));
        } else {
            $group = ['role' => 'group', 'aria-labelledby' => $labelId] + ($noteId ? ['aria-describedby' => $noteId] : []);
        }
    }

    $attrString = attrs(array_merge(
        $id ? ['id' => $id] : [],
        $columns ? ['style' => 'grid-column: span ' . (int) $columns . ';'] : [],
        $group
    ));
    if ($attrString !== '') {
        $attrString = ' ' . $attrString;
    }

    $labelHtml = '';
    if ($label) {
        $labelHtml = '<label class="ws-form-row__label" id="' . e($labelId) . '"'
            . ($fieldId !== null ? ' for="' . e($fieldId) . '"' : '') . '>'
            . e($label)
            . ($optional ? '<span class="ws-form-row__optional">(optional)</span>' : '')
            . '</label>';
    }

    $note = '';
    if ($error) {
        $note = '<p class="ws-form-row__error" id="' . e($noteId) . '" role="alert">' . e($error) . '</p>';
    } elseif ($helper) {
        $note = '<p class="ws-form-row__helper" id="' . e($noteId) . '">' . e($helper) . '</p>';
    }

    return '<div class="' . $classString . '"' . $attrString . '>'
        . $labelHtml
        . '<div class="ws-form-row__field">' . $content . '</div>'
        . $note
        . '</div>';
}

/** The attributes of one start tag, lower-cased name => value (true when bare). Quote-aware. */
function form_row_tag_attrs(string $tag): array
{
    $out = [];
    $body = preg_replace('/^<[a-z0-9-]+|\/?>$/i', '', $tag);
    preg_match_all('/([^\s"\'=\/>]+)(?:\s*=\s*(?:"([^"]*)"|\'([^\']*)\'|([^\s"\'=<>`]+)))?/', $body, $m, PREG_SET_ORDER);
    foreach ($m as $a) {
        $value = $a[2] ?? '';
        if (($a[3] ?? '') !== '') $value = $a[3];
        if (($a[4] ?? '') !== '') $value = $a[4];
        $out[strtolower($a[1])] ??= isset($a[2]) ? html_entity_decode($value, ENT_QUOTES | ENT_HTML5) : true;
    }
    return $out;
}
