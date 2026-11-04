<?php
$ds_page  = 'apps/app-admin';
$ds_title = 'Admin Panel App Guide';
require_once __DIR__ . '/../includes/ds-header.php';
?>

<div class="ds-page-header">
    <h1>Admin Panel</h1>
    <p>Internal operations surface — content curation, user management, subscription oversight, system health, and audit logs. Used by the Workshopr team, not customers. Lower design-system priority, but still earns adoption.</p>
</div>

<!-- App Identity -->
<section class="ds-section">
    <h2 class="ds-section-title" style="display: flex; align-items: center; gap: 10px;">
        <span style="width: 12px; height: 12px; background: #44403C; border-radius: 4px;"></span>
        App Identity
    </h2>

    <div class="ds-grid-3" style="margin-bottom: 24px;">
        <div class="ds-card">
            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; margin-bottom: 8px;">Phase</div>
            <div style="font-weight: 600; color: #44403C;">Internal (no phase)</div>
        </div>
        <div class="ds-card">
            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; margin-bottom: 8px;">Primary Color</div>
            <div style="display: flex; align-items: center; gap: 8px;">
                <span style="width: 20px; height: 20px; background: #44403C; border-radius: 4px;"></span>
                <code class="ds-code-inline">--gray-700</code>
                <span style="color: #94a3b8; margin-left: 8px;">(neutral)</span>
            </div>
        </div>
        <div class="ds-card">
            <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; margin-bottom: 8px;">Font Stack</div>
            <div style="font-weight: 600;">Fraunces + Inter</div>
        </div>
    </div>
</section>

<!-- Design Philosophy -->
<section class="ds-section">
    <h2 class="ds-section-title">Design Philosophy</h2>
    <p class="ds-section-desc">Admin is a power-user tool, not a product surface. Prioritize information density, keyboard navigation, and scannable tables. Borrows from operational consoles (Stripe Dashboard, Linear admin, Supabase Studio) rather than consumer UI.</p>

    <div style="display: flex; flex-direction: column; gap: 16px;">
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #F5F5F4; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #44403C;">table_rows</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Tables are primary</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Users, subscriptions, exercises, logs — all tabular. Dense rows (36–40px), tight padding, sortable columns, inline actions. No "pretty cards" for operational data.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #E7E5E4; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #292524;">keyboard</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Keyboard-navigable</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Power users live in the keyboard. Focus rings visible, tab order logical, common actions bound (e.g., <kbd>/</kbd> for search). Never swallow keyboard events in modals.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #D6D3D1; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #1C1917;">shield_person</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Destructive actions need friction</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Delete user, revoke subscription, wipe cache — always behind a confirm modal with the target name typed back. Admin mistakes affect real customers.</div>
            </div>
        </div>
        <div class="ds-card" style="display: flex; gap: 20px; align-items: flex-start;">
            <div style="width: 48px; height: 48px; background: #F5F5F4; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span class="material-symbols-outlined" style="font-size: 24px; color: #57534E;">palette</span>
            </div>
            <div>
                <div style="font-weight: 600; font-size: 16px; margin-bottom: 4px;">Neutral palette, phase accents</div>
                <div style="font-size: 14px; color: #57534E; line-height: 1.6;">Backgrounds are warm gray. Accents come from status (green/amber/red for success/warn/error). Brand phase colors appear only when linking to phase-owned entities (a blue badge next to a saved plan).</div>
            </div>
        </div>
    </div>
</section>

<!-- Key Patterns -->
<section class="ds-section">
    <h2 class="ds-section-title">Key Patterns</h2>
    <table class="ds-table">
        <thead><tr><th>Area</th><th>Pattern</th><th>Files</th></tr></thead>
        <tbody>
            <tr><td><strong>Admin shell</strong></td><td>Sidebar nav + breadcrumbed main pane + consistent header with search.</td><td><code>/admin/</code></td></tr>
            <tr><td><strong>Data tables</strong></td><td>Sortable, filterable, paginated. Row-level actions in a kebab menu.</td><td><code>/admin/api/*</code> + matching PHP views</td></tr>
            <tr><td><strong>Detail drawers</strong></td><td>Click a row → side drawer opens with detail/edit. Preserves list context.</td><td>uses <code>ws_modal</code> variant=drawer</td></tr>
            <tr><td><strong>Audit logs</strong></td><td>Chronological event feed with actor, action, target, diff.</td><td><code>/admin/audit/</code> (if present)</td></tr>
            <tr><td><strong>Content curation</strong></td><td>Exercise/icebreaker/workshop CRUD with preview, validation, and publish state.</td><td><code>/admin/content/</code></td></tr>
        </tbody>
    </table>
</section>

<!-- Do / Don't -->
<section class="ds-section">
    <h2 class="ds-section-title">Do / Don't</h2>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Default to tables for any list of 10+</strong>
            <div style="margin-top: 8px; font-size: 13px;">Admins need to scan, sort, filter. Cards add visual weight without helping.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Copy the planner's listing-card pattern into admin</strong>
            <div style="margin-top: 8px; font-size: 13px;">Listing cards are for consumer browsing. Admin needs rows of 40+ items at once.</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Use phase colors as inline status badges</strong>
            <div style="margin-top: 8px; font-size: 13px;">A "plan" entity shows a small blue dot. A "coach session" shows green. Instant wayfinding in long tables.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Theme the whole admin surface in a phase color</strong>
            <div style="margin-top: 8px; font-size: 13px;">Admin spans every phase — picking one muddies the signal. Keep chrome neutral.</div>
        </div>
    </div>

    <div class="ds-do-dont">
        <div class="ds-do">
            <strong>Do: Confirm destructive actions with typed confirmation</strong>
            <div style="margin-top: 8px; font-size: 13px;">"Type DELETE to confirm" or "Type the user's email to confirm." Mistakes hurt real customers.</div>
        </div>
        <div class="ds-dont">
            <strong>Don't: Ship one-click deletes on user/subscription/content tables</strong>
            <div style="margin-top: 8px; font-size: 13px;">A misclick in a dense table is easy. Friction is safety here.</div>
        </div>
    </div>
</section>

<!-- File Reference -->
<section class="ds-section">
    <h2 class="ds-section-title">File Reference</h2>
    <table class="ds-table">
        <thead><tr><th>Path</th><th>Purpose</th></tr></thead>
        <tbody>
            <tr><td><code>/admin/</code></td><td>Admin root</td></tr>
            <tr><td><code>/admin/api/</code></td><td>Admin-specific API endpoints</td></tr>
            <tr><td><code>/css/admin/admin.css</code></td><td>Admin shell + table styles</td></tr>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
