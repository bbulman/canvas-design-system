<?php
$ds_page  = 'foundations/animations';
$ds_title = 'Animations';

require_once __DIR__ . '/../includes/ds-header.php';
?>

<style>
/* Animation Demo Styles */
.anim-demo {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 80px;
    background: #FAFAF9;
    border-radius: 8px;
    overflow: hidden;
}

.anim-demo-box {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #E54D4D 0%, #C73E3E 100%);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
}

.anim-demo-box.blue {
    background: linear-gradient(135deg, #0284C7 0%, #075985 100%);
}

.anim-demo-box.purple {
    background: linear-gradient(135deg, #7C4DFF 0%, #6D28D9 100%);
}

.anim-demo-box.green {
    background: linear-gradient(135deg, #10B981 0%, #059669 100%);
}

.anim-trigger {
    padding: 6px 12px;
    background: #1A2744;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
    transition: background 150ms ease;
}

.anim-trigger:hover {
    background: #2E3D5C;
}

/* Live Animation Keyframes */
@keyframes demo-spin {
    to { transform: rotate(360deg); }
}

@keyframes demo-pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

@keyframes demo-pulse-scale {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

@keyframes demo-fade-in {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes demo-fade-in-up {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes demo-fade-in-down {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes demo-scale-in {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}

@keyframes demo-slide-in-up {
    from { opacity: 0; transform: translateY(30px) scale(0.95); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

@keyframes demo-slide-in-down {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes demo-slide-in-right {
    from { transform: translateX(50px); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

@keyframes demo-slide-in-left {
    from { transform: translateX(-50px); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

@keyframes demo-bounce-in {
    0% { opacity: 0; transform: scale(0.3); }
    50% { transform: scale(1.1); }
    70% { transform: scale(0.9); }
    100% { opacity: 1; transform: scale(1); }
}

@keyframes demo-shake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-6px); }
    20%, 40%, 60%, 80% { transform: translateX(6px); }
}

@keyframes demo-skeleton {
    0% { background-position: -200% 0; }
    100% { background-position: 200% 0; }
}

/* Continuous animations */
.anim-spin { animation: demo-spin 1s linear infinite; }
.anim-pulse { animation: demo-pulse 2s ease-in-out infinite; }
.anim-pulse-scale { animation: demo-pulse-scale 2s ease-in-out infinite; }

/* Triggered animations */
.anim-fade-in { animation: demo-fade-in 0.5s ease-out; }
.anim-fade-in-up { animation: demo-fade-in-up 0.5s ease-out; }
.anim-fade-in-down { animation: demo-fade-in-down 0.5s ease-out; }
.anim-scale-in { animation: demo-scale-in 0.3s ease-out; }
.anim-slide-in-up { animation: demo-slide-in-up 0.5s cubic-bezier(0, 0, 0.2, 1); }
.anim-slide-in-down { animation: demo-slide-in-down 0.3s ease-out; }
.anim-slide-in-right { animation: demo-slide-in-right 0.4s ease-out; }
.anim-slide-in-left { animation: demo-slide-in-left 0.4s ease-out; }
.anim-bounce-in { animation: demo-bounce-in 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55); }
.anim-shake { animation: demo-shake 0.5s ease-in-out; }

/* Skeleton demo */
.skeleton-demo {
    height: 16px;
    background: linear-gradient(90deg, #E7E5E4 25%, #F5F5F4 50%, #E7E5E4 75%);
    background-size: 200% 100%;
    animation: demo-skeleton 1.5s ease-in-out infinite;
    border-radius: 4px;
}

/* Spinner demo */
.spinner-demo {
    width: 32px;
    height: 32px;
    border: 3px solid #E7E5E4;
    border-top-color: #E54D4D;
    border-radius: 50%;
    animation: demo-spin 0.7s linear infinite;
}

/* Loading dots */
@keyframes demo-loading-dots {
    0%, 80%, 100% { transform: scale(0.6); opacity: 0.5; }
    40% { transform: scale(1); opacity: 1; }
}

.loading-dots-demo {
    display: flex;
    gap: 6px;
}

.loading-dots-demo span {
    width: 10px;
    height: 10px;
    background: #E54D4D;
    border-radius: 50%;
    animation: demo-loading-dots 1.4s ease-in-out infinite;
}

.loading-dots-demo span:nth-child(2) { animation-delay: 0.16s; }
.loading-dots-demo span:nth-child(3) { animation-delay: 0.32s; }

/* Stagger demo */
.stagger-demo {
    display: flex;
    gap: 8px;
}

.stagger-demo .stagger-item {
    width: 40px;
    height: 40px;
    background: #E54D4D;
    border-radius: 6px;
    opacity: 0;
}

.stagger-demo.animate .stagger-item {
    animation: demo-fade-in-up 0.4s ease-out forwards;
}

.stagger-demo.animate .stagger-item:nth-child(1) { animation-delay: 0ms; }
.stagger-demo.animate .stagger-item:nth-child(2) { animation-delay: 80ms; }
.stagger-demo.animate .stagger-item:nth-child(3) { animation-delay: 160ms; }
.stagger-demo.animate .stagger-item:nth-child(4) { animation-delay: 240ms; }
.stagger-demo.animate .stagger-item:nth-child(5) { animation-delay: 320ms; }
</style>

<div class="ds-page-header">
    <h1>Animations</h1>
    <p>Motion design tokens, keyframe animations, and transition utilities for consistent, performant animations across the platform.</p>
</div>

<!-- Timing Tokens -->
<section class="ds-section">
    <h2 class="ds-section-title">Timing Tokens</h2>
    <p class="ds-section-desc">Standardized durations and easing functions for consistent motion.</p>

    <div class="ds-grid-2">
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 16px; color: #1A2744;">Durations</div>
            <table class="ds-table" style="margin: 0;">
                <thead>
                    <tr>
                        <th>Token</th>
                        <th>Value</th>
                        <th>Use Case</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>--transition-fast</code></td>
                        <td>150ms</td>
                        <td>Hover states, micro-interactions</td>
                    </tr>
                    <tr>
                        <td><code>--transition-base</code></td>
                        <td>200ms</td>
                        <td>Standard transitions, button clicks</td>
                    </tr>
                    <tr>
                        <td><code>--transition-slow</code></td>
                        <td>300ms</td>
                        <td>Page transitions, modals, panels</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 16px; color: #1A2744;">Easing Functions</div>
            <table class="ds-table" style="margin: 0;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Value</th>
                        <th>Use Case</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>ease</code></td>
                        <td>Default</td>
                        <td>General purpose</td>
                    </tr>
                    <tr>
                        <td><code>ease-out</code></td>
                        <td>Fast start, slow end</td>
                        <td>Entrances, appearing elements</td>
                    </tr>
                    <tr>
                        <td><code>ease-in</code></td>
                        <td>Slow start, fast end</td>
                        <td>Exits, disappearing elements</td>
                    </tr>
                    <tr>
                        <td><code>cubic-bezier(0, 0, 0.2, 1)</code></td>
                        <td>Decelerate</td>
                        <td>Cards, dropdowns</td>
                    </tr>
                    <tr>
                        <td><code>cubic-bezier(0.68, -0.55, 0.265, 1.55)</code></td>
                        <td>Bounce</td>
                        <td>Attention, playful UI</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Continuous Animations -->
<section class="ds-section">
    <h2 class="ds-section-title">Continuous Animations</h2>
    <p class="ds-section-desc">Looping animations for loading states and attention.</p>

    <div class="ds-grid-3">
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 12px; color: #1A2744;">Spin</div>
            <div class="anim-demo" style="margin-bottom: 12px;">
                <div class="anim-demo-box anim-spin">
                    <span class="material-symbols-outlined">refresh</span>
                </div>
            </div>
            <code style="font-size: 11px;">ws-animate-spin</code>
            <p style="font-size: 12px; color: #78716C; margin-top: 8px;">Loading spinners, refresh indicators</p>
        </div>
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 12px; color: #1A2744;">Pulse (Opacity)</div>
            <div class="anim-demo" style="margin-bottom: 12px;">
                <div class="anim-demo-box blue anim-pulse">
                    <span class="material-symbols-outlined">notifications</span>
                </div>
            </div>
            <code style="font-size: 11px;">ws-animate-pulse</code>
            <p style="font-size: 12px; color: #78716C; margin-top: 8px;">Attention, live indicators</p>
        </div>
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 12px; color: #1A2744;">Pulse (Scale)</div>
            <div class="anim-demo" style="margin-bottom: 12px;">
                <div class="anim-demo-box purple anim-pulse-scale">
                    <span class="material-symbols-outlined">favorite</span>
                </div>
            </div>
            <code style="font-size: 11px;">ws-animate-pulse-scale</code>
            <p style="font-size: 12px; color: #78716C; margin-top: 8px;">Heartbeat, recording</p>
        </div>
    </div>
</section>

<!-- Entrance Animations -->
<section class="ds-section">
    <h2 class="ds-section-title">Entrance Animations</h2>
    <p class="ds-section-desc">Animations for elements appearing on screen. Click "Replay" to see them in action.</p>

    <div class="ds-grid-2">
        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <div style="font-weight: 600; color: #1A2744;">Fade In</div>
                <button class="anim-trigger" onclick="replayAnimation(this, 'anim-fade-in')">Replay</button>
            </div>
            <div class="anim-demo" style="margin-bottom: 12px;">
                <div class="anim-demo-box anim-fade-in" data-anim="anim-fade-in"></div>
            </div>
            <code style="font-size: 11px;">ws-animate-fade-in</code>
        </div>
        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <div style="font-weight: 600; color: #1A2744;">Fade In Up</div>
                <button class="anim-trigger" onclick="replayAnimation(this, 'anim-fade-in-up')">Replay</button>
            </div>
            <div class="anim-demo" style="margin-bottom: 12px;">
                <div class="anim-demo-box blue anim-fade-in-up" data-anim="anim-fade-in-up"></div>
            </div>
            <code style="font-size: 11px;">ws-animate-fade-in-up</code>
        </div>
        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <div style="font-weight: 600; color: #1A2744;">Fade In Down</div>
                <button class="anim-trigger" onclick="replayAnimation(this, 'anim-fade-in-down')">Replay</button>
            </div>
            <div class="anim-demo" style="margin-bottom: 12px;">
                <div class="anim-demo-box purple anim-fade-in-down" data-anim="anim-fade-in-down"></div>
            </div>
            <code style="font-size: 11px;">ws-animate-fade-in-down</code>
        </div>
        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <div style="font-weight: 600; color: #1A2744;">Scale In</div>
                <button class="anim-trigger" onclick="replayAnimation(this, 'anim-scale-in')">Replay</button>
            </div>
            <div class="anim-demo" style="margin-bottom: 12px;">
                <div class="anim-demo-box green anim-scale-in" data-anim="anim-scale-in"></div>
            </div>
            <code style="font-size: 11px;">ws-animate-scale-in</code>
        </div>
        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <div style="font-weight: 600; color: #1A2744;">Slide In Up</div>
                <button class="anim-trigger" onclick="replayAnimation(this, 'anim-slide-in-up')">Replay</button>
            </div>
            <div class="anim-demo" style="margin-bottom: 12px;">
                <div class="anim-demo-box anim-slide-in-up" data-anim="anim-slide-in-up"></div>
            </div>
            <code style="font-size: 11px;">ws-animate-slide-in-up</code>
        </div>
        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <div style="font-weight: 600; color: #1A2744;">Slide In Down</div>
                <button class="anim-trigger" onclick="replayAnimation(this, 'anim-slide-in-down')">Replay</button>
            </div>
            <div class="anim-demo" style="margin-bottom: 12px;">
                <div class="anim-demo-box blue anim-slide-in-down" data-anim="anim-slide-in-down"></div>
            </div>
            <code style="font-size: 11px;">ws-animate-slide-in-down</code>
        </div>
        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <div style="font-weight: 600; color: #1A2744;">Slide In Right</div>
                <button class="anim-trigger" onclick="replayAnimation(this, 'anim-slide-in-right')">Replay</button>
            </div>
            <div class="anim-demo" style="margin-bottom: 12px;">
                <div class="anim-demo-box purple anim-slide-in-right" data-anim="anim-slide-in-right"></div>
            </div>
            <code style="font-size: 11px;">ws-animate-slide-in-right</code>
        </div>
        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <div style="font-weight: 600; color: #1A2744;">Slide In Left</div>
                <button class="anim-trigger" onclick="replayAnimation(this, 'anim-slide-in-left')">Replay</button>
            </div>
            <div class="anim-demo" style="margin-bottom: 12px;">
                <div class="anim-demo-box green anim-slide-in-left" data-anim="anim-slide-in-left"></div>
            </div>
            <code style="font-size: 11px;">ws-animate-slide-in-left</code>
        </div>
    </div>
</section>

<!-- Attention Animations -->
<section class="ds-section">
    <h2 class="ds-section-title">Attention Animations</h2>
    <p class="ds-section-desc">Animations to draw user attention or indicate state changes.</p>

    <div class="ds-grid-2">
        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <div style="font-weight: 600; color: #1A2744;">Bounce In</div>
                <button class="anim-trigger" onclick="replayAnimation(this, 'anim-bounce-in')">Replay</button>
            </div>
            <div class="anim-demo" style="margin-bottom: 12px;">
                <div class="anim-demo-box anim-bounce-in" data-anim="anim-bounce-in">
                    <span class="material-symbols-outlined">check</span>
                </div>
            </div>
            <code style="font-size: 11px;">ws-animate-bounce-in</code>
            <p style="font-size: 12px; color: #78716C; margin-top: 8px;">Success confirmations, achievements</p>
        </div>
        <div class="ds-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <div style="font-weight: 600; color: #1A2744;">Shake</div>
                <button class="anim-trigger" onclick="replayAnimation(this, 'anim-shake')">Replay</button>
            </div>
            <div class="anim-demo" style="margin-bottom: 12px;">
                <div class="anim-demo-box anim-shake" data-anim="anim-shake" style="background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);">
                    <span class="material-symbols-outlined">warning</span>
                </div>
            </div>
            <code style="font-size: 11px;">ws-animate-shake</code>
            <p style="font-size: 12px; color: #78716C; margin-top: 8px;">Errors, invalid input</p>
        </div>
    </div>
</section>

<!-- Loading States -->
<section class="ds-section">
    <h2 class="ds-section-title">Loading States</h2>
    <p class="ds-section-desc">Visual feedback for async operations and content loading.</p>

    <div class="ds-grid-3">
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 16px; color: #1A2744;">Spinner</div>
            <div class="anim-demo" style="margin-bottom: 12px;">
                <div class="spinner-demo"></div>
            </div>
            <code style="font-size: 11px;">ws-spinner</code>
            <p style="font-size: 12px; color: #78716C; margin-top: 8px;">Button loading, async operations</p>
        </div>
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 16px; color: #1A2744;">Loading Dots</div>
            <div class="anim-demo" style="margin-bottom: 12px;">
                <div class="loading-dots-demo">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <code style="font-size: 11px;">ws-loading-dots</code>
            <p style="font-size: 12px; color: #78716C; margin-top: 8px;">AI thinking, typing indicator</p>
        </div>
        <div class="ds-card">
            <div style="font-weight: 600; margin-bottom: 16px; color: #1A2744;">Skeleton</div>
            <div class="anim-demo" style="flex-direction: column; gap: 8px; padding: 16px; align-items: stretch;">
                <div class="skeleton-demo" style="width: 60%;"></div>
                <div class="skeleton-demo" style="width: 100%;"></div>
                <div class="skeleton-demo" style="width: 80%;"></div>
            </div>
            <code style="font-size: 11px;">ws-skeleton</code>
            <p style="font-size: 12px; color: #78716C; margin-top: 8px;">Content placeholder loading</p>
        </div>
    </div>
</section>

<!-- Staggered Animations -->
<section class="ds-section">
    <h2 class="ds-section-title">Staggered Animations</h2>
    <p class="ds-section-desc">Sequential animations for lists and grids.</p>

    <div class="ds-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <div style="font-weight: 600; color: #1A2744;">Stagger Children</div>
            <button class="anim-trigger" onclick="replayStagger()">Replay</button>
        </div>
        <div class="anim-demo" style="padding: 24px;">
            <div class="stagger-demo animate" id="stagger-demo">
                <div class="stagger-item"></div>
                <div class="stagger-item"></div>
                <div class="stagger-item"></div>
                <div class="stagger-item"></div>
                <div class="stagger-item"></div>
            </div>
        </div>
        <div style="margin-top: 16px;">
            <code style="font-size: 11px;">ws-stagger-children</code>
            <p style="font-size: 12px; color: #78716C; margin-top: 8px;">Card grids, list items, navigation menus. Each child animates with 50ms delay.</p>
        </div>
    </div>

    <div class="ds-code" style="margin-top: 16px;">
<span style="color: #9CA3AF;">/* Stagger delay pattern (up to 12 children) */</span>
.ws-stagger-children > *:nth-child(1) { animation-delay: 0ms; }
.ws-stagger-children > *:nth-child(2) { animation-delay: 50ms; }
.ws-stagger-children > *:nth-child(3) { animation-delay: 100ms; }
.ws-stagger-children > *:nth-child(4) { animation-delay: 150ms; }
<span style="color: #9CA3AF;">/* ... continues to 12 */</span></div>
</section>

<!-- Component Animations -->
<section class="ds-section">
    <h2 class="ds-section-title">Component Animation Patterns</h2>
    <p class="ds-section-desc">Standard animations used by UI components.</p>

    <table class="ds-table">
        <thead>
            <tr>
                <th>Component</th>
                <th>Enter Animation</th>
                <th>Exit Animation</th>
                <th>Duration</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Modal</strong></td>
                <td><code>scale-in</code> + <code>fade-in</code></td>
                <td><code>scale-out</code> + <code>fade-out</code></td>
                <td>200ms / 150ms</td>
            </tr>
            <tr>
                <td><strong>Dropdown</strong></td>
                <td><code>slide-in-down</code> + <code>fade-in</code></td>
                <td><code>fade-out</code></td>
                <td>200ms / 150ms</td>
            </tr>
            <tr>
                <td><strong>Toast</strong></td>
                <td><code>slide-in-right</code></td>
                <td><code>fade-out</code> + translateX</td>
                <td>300ms / 200ms</td>
            </tr>
            <tr>
                <td><strong>Drawer</strong></td>
                <td><code>slide-in-right</code></td>
                <td><code>slide-out-right</code></td>
                <td>300ms</td>
            </tr>
            <tr>
                <td><strong>Card (list)</strong></td>
                <td><code>slide-in-up</code> + stagger</td>
                <td><code>fade-out</code></td>
                <td>400ms / 200ms</td>
            </tr>
            <tr>
                <td><strong>Tooltip</strong></td>
                <td><code>fade-in</code></td>
                <td><code>fade-out</code></td>
                <td>150ms</td>
            </tr>
            <tr>
                <td><strong>Button (loading)</strong></td>
                <td><code>spin</code></td>
                <td>—</td>
                <td>700ms loop</td>
            </tr>
            <tr>
                <td><strong>Page transition</strong></td>
                <td><code>page-enter</code></td>
                <td><code>page-exit</code></td>
                <td>400ms / 200ms</td>
            </tr>
        </tbody>
    </table>
</section>

<!-- Accessibility -->
<section class="ds-section">
    <h2 class="ds-section-title">Accessibility</h2>
    <p class="ds-section-desc">Motion accessibility is built into the animation system.</p>

    <div class="ds-card">
        <div style="font-weight: 600; margin-bottom: 12px; color: #1A2744;">Reduced Motion Support</div>
        <p style="font-size: 14px; color: #57534E; margin-bottom: 16px;">All animations respect the user's <code>prefers-reduced-motion</code> setting. When enabled, animations are disabled or reduced to simple opacity changes.</p>
        <div class="ds-code" style="margin: 0;">
@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }

  .ws-skeleton, .ws-shimmer { animation: none; }
  .ws-spinner { animation: none; }
}</div>
    </div>

    <div class="ds-note" style="margin-top: 16px;">
        <span class="material-symbols-outlined">accessibility_new</span>
        <div>Always provide non-animated fallbacks. Loading spinners should include <code>aria-label="Loading"</code> or equivalent text. Never rely solely on animation to convey information.</div>
    </div>
</section>

<!-- Usage -->
<section class="ds-section">
    <h2 class="ds-section-title">Usage</h2>

    <div class="ds-subsection">
        <div class="ds-subsection-title">CSS Classes</div>
        <div class="ds-code">
<span style="color: #9CA3AF;">/* Add animation class to trigger */</span>
&lt;div class="ws-animate-fade-in-up"&gt;Content&lt;/div&gt;

<span style="color: #9CA3AF;">/* Stagger children */</span>
&lt;div class="ws-stagger-children"&gt;
  &lt;div&gt;Item 1&lt;/div&gt;
  &lt;div&gt;Item 2&lt;/div&gt;
  &lt;div&gt;Item 3&lt;/div&gt;
&lt;/div&gt;

<span style="color: #9CA3AF;">/* Loading spinner */</span>
&lt;div class="ws-spinner"&gt;&lt;/div&gt;
&lt;div class="ws-spinner ws-spinner--lg ws-spinner--white"&gt;&lt;/div&gt;</div>
    </div>

    <div class="ds-subsection">
        <div class="ds-subsection-title">JavaScript Trigger</div>
        <div class="ds-code">
<span style="color: #9CA3AF;">// Trigger animation on event</span>
element.classList.add('ws-animate-bounce-in');

<span style="color: #9CA3AF;">// Remove after animation completes</span>
element.addEventListener('animationend', () => {
  element.classList.remove('ws-animate-bounce-in');
});</div>
    </div>

    <div class="ds-grid-2" style="margin-top: 24px;">
        <div class="ds-card" style="border-left: 4px solid #166534;">
            <div style="font-weight: 600; margin-bottom: 12px; color: #166534;">Do</div>
            <ul style="margin: 0; padding-left: 20px; color: #57534E; font-size: 14px;">
                <li style="margin-bottom: 6px;">Use subtle animations (200-400ms)</li>
                <li style="margin-bottom: 6px;">Animate entrance, not exit (faster exits)</li>
                <li style="margin-bottom: 6px;">Use ease-out for entrances</li>
                <li style="margin-bottom: 6px;">Stagger lists for visual flow</li>
                <li>Respect reduced motion preferences</li>
            </ul>
        </div>
        <div class="ds-card" style="border-left: 4px solid #991B1B;">
            <div style="font-weight: 600; margin-bottom: 12px; color: #991B1B;">Don't</div>
            <ul style="margin: 0; padding-left: 20px; color: #57534E; font-size: 14px;">
                <li style="margin-bottom: 6px;">Animate everything (be selective)</li>
                <li style="margin-bottom: 6px;">Use long durations (&gt;500ms)</li>
                <li style="margin-bottom: 6px;">Block user interaction during animations</li>
                <li style="margin-bottom: 6px;">Use bounce/spring for serious UI</li>
                <li>Animate layout properties (width/height)</li>
            </ul>
        </div>
    </div>
</section>

<!-- File Reference -->
<section class="ds-section">
    <h2 class="ds-section-title">File Reference</h2>

    <div class="ds-card">
        <table class="ds-table" style="margin: 0;">
            <thead>
                <tr>
                    <th>File</th>
                    <th>Purpose</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>css/base/_animations.css</code></td>
                    <td>All keyframes, utility classes, spinners, skeletons</td>
                </tr>
                <tr>
                    <td><code>design-system/platform-tokens.css</code></td>
                    <td>Timing tokens (--transition-fast, --transition-base, --transition-slow)</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<script>
function replayAnimation(button, animClass) {
    const container = button.closest('.ds-card');
    const box = container.querySelector('[data-anim]');
    box.classList.remove(animClass);
    void box.offsetWidth; // Force reflow
    box.classList.add(animClass);
}

function replayStagger() {
    const demo = document.getElementById('stagger-demo');
    demo.classList.remove('animate');
    void demo.offsetWidth;
    demo.classList.add('animate');
}
</script>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
