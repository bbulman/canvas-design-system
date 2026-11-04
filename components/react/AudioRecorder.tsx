import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';

export type WsAudioRecorderEntityType = 'exercise' | 'icebreaker' | 'plan_item' | 'session' | '';

export interface WsAudioRecorderProps {
  id?: string;
  /** Polymorphic type of the linked entity. */
  entityType?: WsAudioRecorderEntityType;
  /** ID of the linked entity. */
  entityId?: string | number;
  className?: string;
}

/**
 * Mirror of ws_audio_recorder() — renders the static four-state markup.
 * Behavior (MediaRecorder) is driven by the ws-audio-recorder JS.
 */
export function WsAudioRecorder({
  id,
  entityType = '',
  entityId = '',
  className,
}: WsAudioRecorderProps): React.ReactElement {
  return (
    <div
      id={id}
      className={cx('ws-audio-recorder', className)}
      data-entity-type={entityType}
      data-entity-id={entityId}
    >
      <div className="ws-audio-recorder__state ws-audio-recorder__state--idle" data-state="idle">
        <button
          className="ws-audio-recorder__btn ws-audio-recorder__btn--record"
          type="button"
          data-recorder-action="start"
        >
          <Icon name="mic" />
          <span className="ws-audio-recorder__label">Record Voice Note</span>
        </button>
      </div>

      <div
        className="ws-audio-recorder__state ws-audio-recorder__state--recording"
        data-state="recording"
        hidden
      >
        <div className="ws-audio-recorder__indicator">
          <span className="ws-audio-recorder__pulse" />
          <span className="ws-audio-recorder__timer">0:00</span>
        </div>
        <button
          className="ws-audio-recorder__btn ws-audio-recorder__btn--stop"
          type="button"
          data-recorder-action="stop"
        >
          <Icon name="stop" />
          <span className="ws-audio-recorder__label">Stop</span>
        </button>
      </div>

      <div
        className="ws-audio-recorder__state ws-audio-recorder__state--done"
        data-state="done"
        hidden
      >
        <div className="ws-audio-recorder__preview">
          <button
            className="ws-audio-recorder__btn ws-audio-recorder__btn--play-preview"
            type="button"
            data-recorder-action="preview"
          >
            <Icon name="play_arrow" />
          </button>
          <span className="ws-audio-recorder__duration">0:00</span>
        </div>
        <div className="ws-audio-recorder__actions">
          <button
            className="ws-audio-recorder__btn ws-audio-recorder__btn--discard"
            type="button"
            data-recorder-action="discard"
          >
            <Icon name="delete" />
          </button>
          <button
            className="ws-audio-recorder__btn ws-audio-recorder__btn--save"
            type="button"
            data-recorder-action="save"
          >
            <Icon name="check" />
            <span className="ws-audio-recorder__label">Save</span>
          </button>
        </div>
      </div>

      <div
        className="ws-audio-recorder__state ws-audio-recorder__state--uploading"
        data-state="uploading"
        hidden
      >
        <span className="ws-audio-recorder__spinner" />
        <span className="ws-audio-recorder__label">Saving…</span>
      </div>
    </div>
  );
}
