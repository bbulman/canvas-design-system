import React from 'react';
import { Icon } from './Icon';
import { cx } from './cx';

export interface WsAudioPlayerProps {
  /** Audio file URL (required). */
  src: string;
  /** Duration in seconds (displayed formatted as m:ss). */
  duration?: number;
  label?: string;
  /** Database voice_note ID (for delete). */
  noteId?: string | number;
  deletable?: boolean;
  id?: string;
  className?: string;
}

function formatDuration(seconds: number): string {
  if (seconds <= 0) return '0:00';
  const mins = Math.floor(seconds / 60);
  const secs = seconds % 60;
  return `${mins}:${String(secs).padStart(2, '0')}`;
}

/**
 * Mirror of ws_audio_player() — renders the static player markup.
 * Playback is driven by the ws-audio-player JS via the data-* hooks.
 */
export function WsAudioPlayer({
  src,
  duration = 0,
  label,
  noteId,
  deletable,
  id,
  className,
}: WsAudioPlayerProps): React.ReactElement {
  return (
    <div
      id={id}
      className={cx('ws-audio-player', className)}
      data-src={src}
      data-note-id={noteId || undefined}
    >
      <button className="ws-audio-player__btn" type="button" data-player-action="toggle">
        <Icon name="play_arrow" className="ws-audio-player__icon--play" />
        <span className="material-symbols-outlined ws-audio-player__icon--pause" hidden>
          pause
        </span>
      </button>
      <div className="ws-audio-player__track">
        <div className="ws-audio-player__progress">
          <div className="ws-audio-player__fill" />
        </div>
        {label && <span className="ws-audio-player__label">{label}</span>}
      </div>
      <span className="ws-audio-player__time">{formatDuration(duration)}</span>
      {deletable && (
        <button
          className="ws-audio-player__delete"
          type="button"
          data-player-action="delete"
          title="Delete voice note"
        >
          <Icon name="close" />
        </button>
      )}
      <audio preload="none" src={src} />
    </div>
  );
}
