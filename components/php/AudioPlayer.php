<?php
/**
 * AudioPlayer — portable mirror of ws_audio_player() / includes/components/audio-player.php
 *
 * Minimal custom audio player (play/pause + progress + duration). Renders static
 * markup with data-* hooks; ws-audio-player JS drives playback.
 *
 * @param string $src     Audio file URL (required)
 * @param array  $options duration(int seconds), label, note_id, deletable(bool),
 *                        id, class, attrs[]
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function audio_player(string $src, array $options = []): string
{
    $duration  = (int) ($options['duration'] ?? 0);
    $label     = $options['label'] ?? '';
    $noteId    = $options['note_id'] ?? '';
    $deletable = $options['deletable'] ?? false;
    $id        = $options['id'] ?? 'ws-player-' . uniqid();
    $class     = $options['class'] ?? '';
    $attrs     = $options['attrs'] ?? [];

    $classString = cx([
        'ws-audio-player',
        $class,
    ]);

    $attrString = attrs(array_merge(
        [
            'id'       => $id,
            'data-src' => $src,
        ],
        $noteId ? ['data-note-id' => $noteId] : [],
        $attrs
    ));

    $durationFormatted = '0:00';
    if ($duration > 0) {
        $mins = (int) floor($duration / 60);
        $secs = $duration % 60;
        $durationFormatted = $mins . ':' . str_pad((string) $secs, 2, '0', STR_PAD_LEFT);
    }

    $labelHtml = $label
        ? '<span class="ws-audio-player__label">' . e($label) . '</span>'
        : '';

    $deleteHtml = $deletable
        ? '<button class="ws-audio-player__delete" type="button" data-player-action="delete" title="Delete voice note">'
            . icon('close')
            . '</button>'
        : '';

    return '<div class="' . $classString . '" ' . $attrString . '>'
        . '<button class="ws-audio-player__btn" type="button" data-player-action="toggle">'
        . icon('play_arrow', 'ws-audio-player__icon--play')
        . '<span class="material-symbols-outlined ws-audio-player__icon--pause" hidden>pause</span>'
        . '</button>'
        . '<div class="ws-audio-player__track">'
        . '<div class="ws-audio-player__progress"><div class="ws-audio-player__fill"></div></div>'
        . $labelHtml
        . '</div>'
        . '<span class="ws-audio-player__time">' . e($durationFormatted) . '</span>'
        . $deleteHtml
        . '<audio preload="none" src="' . e($src) . '"></audio>'
        . '</div>';
}
