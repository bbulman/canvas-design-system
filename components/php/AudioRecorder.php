<?php
/**
 * AudioRecorder — portable mirror of ws_audio_recorder() / includes/components/audio-recorder.php
 *
 * Voice recording widget (MediaRecorder API). Renders all four states
 * (idle/recording/done/uploading) as static markup; ws-audio-recorder JS drives behavior.
 *
 * @param array $options
 *   - id          (string) Unique element ID
 *   - entity_type (string) Polymorphic type: exercise|icebreaker|plan_item|session
 *   - entity_id   (int)    ID of the linked entity
 *   - class       (string) Additional CSS classes
 *   - attrs       (array)  Additional HTML attributes
 */

namespace Workshopr\DS;

require_once __DIR__ . '/_icon.php';

function audio_recorder(array $options = []): string
{
    $id         = $options['id'] ?? 'ws-recorder-' . uniqid();
    $entityType = $options['entity_type'] ?? '';
    $entityId   = $options['entity_id'] ?? '';
    $class      = $options['class'] ?? '';
    $attrs      = $options['attrs'] ?? [];

    $classString = cx([
        'ws-audio-recorder',
        $class,
    ]);

    $attrString = attrs(array_merge(
        [
            'id'               => $id,
            'data-entity-type' => $entityType,
            'data-entity-id'   => $entityId,
        ],
        $attrs
    ));

    return '<div class="' . $classString . '" ' . $attrString . '>'
        . '<div class="ws-audio-recorder__state ws-audio-recorder__state--idle" data-state="idle">'
        . '<button class="ws-audio-recorder__btn ws-audio-recorder__btn--record" type="button" data-recorder-action="start">'
        . icon('mic')
        . '<span class="ws-audio-recorder__label">Record Voice Note</span>'
        . '</button>'
        . '</div>'
        . '<div class="ws-audio-recorder__state ws-audio-recorder__state--recording" data-state="recording" hidden>'
        . '<div class="ws-audio-recorder__indicator">'
        . '<span class="ws-audio-recorder__pulse"></span>'
        . '<span class="ws-audio-recorder__timer">0:00</span>'
        . '</div>'
        . '<button class="ws-audio-recorder__btn ws-audio-recorder__btn--stop" type="button" data-recorder-action="stop">'
        . icon('stop')
        . '<span class="ws-audio-recorder__label">Stop</span>'
        . '</button>'
        . '</div>'
        . '<div class="ws-audio-recorder__state ws-audio-recorder__state--done" data-state="done" hidden>'
        . '<div class="ws-audio-recorder__preview">'
        . '<button class="ws-audio-recorder__btn ws-audio-recorder__btn--play-preview" type="button" data-recorder-action="preview">'
        . icon('play_arrow')
        . '</button>'
        . '<span class="ws-audio-recorder__duration">0:00</span>'
        . '</div>'
        . '<div class="ws-audio-recorder__actions">'
        . '<button class="ws-audio-recorder__btn ws-audio-recorder__btn--discard" type="button" data-recorder-action="discard">'
        . icon('delete')
        . '</button>'
        . '<button class="ws-audio-recorder__btn ws-audio-recorder__btn--save" type="button" data-recorder-action="save">'
        . icon('check')
        . '<span class="ws-audio-recorder__label">Save</span>'
        . '</button>'
        . '</div>'
        . '</div>'
        . '<div class="ws-audio-recorder__state ws-audio-recorder__state--uploading" data-state="uploading" hidden>'
        . '<span class="ws-audio-recorder__spinner"></span>'
        . '<span class="ws-audio-recorder__label">Saving…</span>'
        . '</div>'
        . '</div>';
}
