<?php
$ds_page  = 'redesign/sidenav-playground';
$ds_title = 'Side Navigation — Playground';

require_once __DIR__ . '/../../includes/icon.php';
require_once __DIR__ . '/../../includes/components/helpers.php';

require_once __DIR__ . '/../includes/ds-header.php';

$pg_nav = [
    ['label' => 'Home',       'icon' => 'home',              'href' => '#'],
    ['label' => 'Strategize', 'icon' => 'knight',            'href' => '#', 'active' => true],
    ['label' => 'Plan',       'icon' => 'calendar_view_day', 'href' => '#'],
    ['label' => 'Facilitate', 'icon' => 'groups',            'href' => '#'],
    ['label' => 'Synthesize', 'icon' => 'hub',               'href' => '#'],
    ['type'  => 'divider'],
    ['label' => 'Library',      'icon' => 'auto_stories', 'href' => '#'],
    ['label' => 'Rescue Cards', 'icon' => 'stacks',       'href' => '#', 'badge' => 37],
    ['label' => 'More', 'icon' => 'more_horiz', 'expands' => true, 'id' => 'pgMore', 'children' => [
        ['label' => 'Academy', 'icon' => 'school',        'href' => '#'],
        ['label' => 'Tips',    'icon' => 'emoji_objects', 'href' => '#'],
    ]],
];
?>
<link rel="stylesheet" href="<?= $site_base ?>/includes/components/components.css">

<style>
.pg-wrap { display: grid; grid-template-columns: minmax(0, 1fr) 320px; gap: var(--space-6); align-items: start; }
.pg-stages { display: flex; gap: var(--space-6); flex-wrap: wrap; }
.pg-stage {
    display: flex;
    height: 620px;
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-lg);
    background: var(--bg-surface);
    overflow: hidden;
}
.pg-stage__body { flex: 1; min-width: 120px; padding: var(--space-5); color: var(--text-muted); font-size: var(--text-small); }
.pg-stage__cap { font-size: var(--text-meta); font-weight: var(--font-semibold); color: var(--text-muted); margin-bottom: var(--space-2); }

.pg-panel {
    position: sticky;
    top: var(--space-5);
    padding: var(--space-5);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-lg);
    background: var(--bg-surface);
}
.pg-panel h3 { margin: 0 0 var(--space-4); font-size: var(--text-body); }
.pg-group { margin-bottom: var(--space-5); }
.pg-group > strong { display: block; font-size: var(--text-nano); letter-spacing: 1px; text-transform: uppercase; color: var(--text-faint); margin-bottom: var(--space-3); }
.pg-row { display: grid; grid-template-columns: 1fr 56px; gap: var(--space-2); align-items: center; margin-bottom: var(--space-2-5); font-size: var(--text-meta); }
.pg-row label { color: var(--color-ink-secondary); }
.pg-row input[type=range] { grid-column: 1 / -1; width: 100%; accent-color: var(--phase-learn); }
.pg-row output { font-variant-numeric: tabular-nums; color: var(--text-muted); text-align: right; }
.pg-row input[type=color] { width: 100%; height: 28px; padding: 0; border: 1px solid var(--gray-300); border-radius: var(--radius-sm); background: none; }
.pg-actions { display: flex; gap: var(--space-2); margin-top: var(--space-4); }
.pg-out { margin-top: var(--space-5); }
.pg-out pre {
    margin: 0; padding: var(--space-4);
    background: var(--color-ink); color: var(--text-inverse);
    border-radius: var(--radius-md);
    font-size: var(--text-meta); line-height: 1.6;
    overflow-x: auto; white-space: pre;
}
</style>

<div class="ds-page-header">
    <h1>Side Navigation &mdash; Playground</h1>
    <p>Every M3 metric on <code class="ds-code-inline">ws_sidenav()</code> is a CSS custom property. Drag the controls to retune both variants live, then copy the block at the bottom &mdash; that is the real override, not a mockup.</p>
</div>

<div class="pg-wrap">
    <div>
        <div class="pg-stages">
            <div>
                <div class="pg-stage__cap">Expanded</div>
                <div class="pg-stage">
                    <?= ws_sidenav($pg_nav, [
                        'id' => 'pgExpanded',
                        'brand' => ['label' => 'Workshopr', 'sub' => 'Strategist', 'icon' => 'graph_3', 'href' => '#'],
                        'ariaLabel' => 'Playground, expanded',
                    ]) ?>
                    <div class="pg-stage__body">App content</div>
                </div>
            </div>
            <div>
                <div class="pg-stage__cap">Rail</div>
                <div class="pg-stage">
                    <?= ws_sidenav($pg_nav, [
                        'id' => 'pgRail',
                        'variant' => 'rail',
                        'brand' => ['label' => 'Workshopr', 'icon' => 'graph_3', 'href' => '#'],
                        'ariaLabel' => 'Playground, rail',
                    ]) ?>
                    <div class="pg-stage__body">App content</div>
                </div>
            </div>
        </div>

        <div class="pg-out">
            <h3 class="ds-subsection-title">Your overrides</h3>
            <p class="ds-section-desc">Only the properties you changed appear. Drop this anywhere the rail is used &mdash; or hand it back and I will bake it into the component defaults.</p>
            <pre id="pgOut">/* Nothing changed yet — the component is at its M3 defaults. */</pre>
        </div>
    </div>

    <form class="pg-panel" id="pgPanel">
        <h3>Tweak</h3>

        <div class="pg-group">
            <strong>Size</strong>
            <div class="pg-row"><label for="c-w">Expanded width</label><output id="o-w"></output>
                <input type="range" id="c-w" data-var="--ws-sidenav-width" data-target="expanded" min="180" max="360" step="4"></div>
            <div class="pg-row"><label for="c-rw">Rail width</label><output id="o-rw"></output>
                <input type="range" id="c-rw" data-var="--ws-sidenav-width" data-target="rail" min="64" max="120" step="4"></div>
            <div class="pg-row"><label for="c-ih">Item height</label><output id="o-ih"></output>
                <input type="range" id="c-ih" data-var="--ws-sidenav-item-height" min="40" max="72" step="2"></div>
            <div class="pg-row"><label for="c-rih">Rail item height</label><output id="o-rih"></output>
                <input type="range" id="c-rih" data-var="--ws-sidenav-rail-item-height" min="44" max="88" step="2"></div>
            <div class="pg-row"><label for="c-inset">Inset</label><output id="o-inset"></output>
                <input type="range" id="c-inset" data-var="--ws-sidenav-inset" min="0" max="32" step="2"></div>
            <div class="pg-row"><label for="c-gap">Gap between items</label><output id="o-gap"></output>
                <input type="range" id="c-gap" data-var="--ws-sidenav-item-gap" min="0" max="16" step="1"></div>
        </div>

        <div class="pg-group">
            <strong>Indicator</strong>
            <div class="pg-row"><label for="c-iw">Rail indicator width</label><output id="o-iw"></output>
                <input type="range" id="c-iw" data-var="--ws-sidenav-indicator-w" min="32" max="72" step="2"></div>
            <div class="pg-row"><label for="c-ihh">Rail indicator height</label><output id="o-ihh"></output>
                <input type="range" id="c-ihh" data-var="--ws-sidenav-indicator-h" min="24" max="56" step="2"></div>
            <?php /* A select, not a slider: the default is a 9999px pill, which
                     no sensible slider range can express. */ ?>
            <div class="pg-row"><label for="c-r">Corner radius</label><span></span>
                <select id="c-r" data-var="--ws-sidenav-radius" data-unit="" class="ws-select">
                    <option value="9999px">Full (pill)</option>
                    <option value="20px">20px</option>
                    <option value="16px">16px</option>
                    <option value="12px">12px</option>
                    <option value="8px">8px</option>
                    <option value="4px">4px</option>
                    <option value="0px">Square</option>
                </select></div>
        </div>

        <div class="pg-group">
            <strong>Type &amp; icon</strong>
            <div class="pg-row"><label for="c-icon">Icon size</label><output id="o-icon"></output>
                <input type="range" id="c-icon" data-var="--ws-sidenav-icon-size" min="16" max="32" step="1"></div>
            <div class="pg-row"><label for="c-ls">Label size</label><output id="o-ls"></output>
                <input type="range" id="c-ls" data-var="--ws-sidenav-label-size" min="11" max="17" step="1"></div>
            <div class="pg-row"><label for="c-rls">Rail label size</label><output id="o-rls"></output>
                <input type="range" id="c-rls" data-var="--ws-sidenav-rail-label-size" min="9" max="15" step="1"></div>
        </div>

        <div class="pg-group">
            <strong>State layers</strong>
            <div class="pg-row"><label for="c-sh">Hover opacity</label><output id="o-sh"></output>
                <input type="range" id="c-sh" data-var="--ws-sidenav-state-hover" data-unit="" min="0" max="0.24" step="0.01"></div>
            <div class="pg-row"><label for="c-sf">Focus opacity</label><output id="o-sf"></output>
                <input type="range" id="c-sf" data-var="--ws-sidenav-state-focus" data-unit="" min="0" max="0.24" step="0.01"></div>
        </div>

        <div class="pg-group">
            <strong>Colour</strong>
            <div class="pg-row"><label for="c-surface">Surface</label><span></span>
                <input type="color" id="c-surface" data-var="--ws-sidenav-surface" data-unit=""></div>
            <div class="pg-row"><label for="c-ind">Active indicator</label><span></span>
                <input type="color" id="c-ind" data-var="--ws-sidenav-indicator" data-unit=""></div>
            <div class="pg-row"><label for="c-oni">On indicator</label><span></span>
                <input type="color" id="c-oni" data-var="--ws-sidenav-on-indicator" data-unit=""></div>
            <div class="pg-row"><label for="c-ons">Inactive text</label><span></span>
                <input type="color" id="c-ons" data-var="--ws-sidenav-on-surface" data-unit=""></div>
        </div>

        <div class="pg-actions">
            <?= ws_button('Reset to M3', ['variant' => 'secondary', 'size' => 'sm', 'id' => 'pgReset']) ?>
            <?= ws_button('Copy CSS', ['variant' => 'primary', 'size' => 'sm', 'id' => 'pgCopy', 'icon' => 'content_copy']) ?>
        </div>
        <p class="ds-section-desc" id="pgContrast"></p>
    </form>
</div>

<script>
(function () {
    'use strict';
    var navs   = { expanded: document.getElementById('pgExpanded'), rail: document.getElementById('pgRail') };
    var all    = [navs.expanded, navs.rail];
    var panel  = document.getElementById('pgPanel');
    var out    = document.getElementById('pgOut');
    var inputs = Array.prototype.slice.call(panel.querySelectorAll('[data-var]'));
    var defaults = {};

    function toHex(v) {
        v = (v || '').trim();
        if (v.charAt(0) === '#') return v.length === 4
            ? '#' + v[1] + v[1] + v[2] + v[2] + v[3] + v[3] : v;
        var m = v.match(/\d+/g);
        if (!m) return '#000000';
        return '#' + m.slice(0, 3).map(function (x) {
            return ('0' + (+x).toString(16)).slice(-2);
        }).join('');
    }

    /* Some custom properties resolve to a token in rem (the type scale), so
       reading the property gives 0.875 where the slider wants 14. For those,
       seed from the rendered element instead — geometry is always in px. */
    var seedFrom = {
        'c-ls':  ['#pgExpanded .ws-sidenav__label', 'fontSize'],
        'c-rls': ['#pgRail .ws-sidenav__label',     'fontSize']
    };

    /* Seed each control from what the component actually computes, so the
       playground starts at the real defaults instead of a copy of them. */
    inputs.forEach(function (el) {
        var raw;
        if (seedFrom[el.id]) {
            var probe = document.querySelector(seedFrom[el.id][0]);
            raw = probe ? getComputedStyle(probe)[seedFrom[el.id][1]] : '';
        } else {
            var target = el.dataset.target ? navs[el.dataset.target] : navs.expanded;
            raw = getComputedStyle(target).getPropertyValue(el.dataset.var).trim();
        }
        if (el.type === 'color') el.value = toHex(raw);
        else if (el.tagName === 'SELECT') el.value = raw;
        else el.value = parseFloat(raw) || 0;
        /* Store the value the control actually settled on, not the raw string.
           A slider rounds 11.2 to 11 and a colour input lowercases its hex, so
           comparing against the raw value would mark everything dirty on load. */
        defaults[el.id] = el.value;
        sync(el);
    });

    function unit(el) { return el.dataset.unit === undefined ? 'px' : el.dataset.unit; }

    function sync(el) {
        var o = document.getElementById('o-' + el.id.slice(2));
        if (!o) return;
        o.textContent = el.type === 'color' ? '' : el.value + (unit(el) === 'px' ? '' : '');
    }

    function apply(el) {
        var value = (el.type === 'color' || el.tagName === 'SELECT')
            ? el.value : el.value + unit(el);
        var targets = el.dataset.target ? [navs[el.dataset.target]] : all;
        targets.forEach(function (n) { n.style.setProperty(el.dataset.var, value); });
        sync(el);
        render();
    }

    function changed() {
        return inputs.filter(function (el) { return el.value !== defaults[el.id]; });
    }

    function render() {
        var list = changed();
        if (!list.length) {
            out.textContent = '/* Nothing changed yet — the component is at its M3 defaults. */';
        } else {
            var shared = [], perVariant = { expanded: [], rail: [] };
            list.forEach(function (el) {
                var v = (el.type === 'color' || el.tagName === 'SELECT')
                    ? el.value : el.value + unit(el);
                var line = '  ' + el.dataset.var + ': ' + v + ';';
                if (el.dataset.target) perVariant[el.dataset.target].push(line);
                else shared.push(line);
            });
            var css = '';
            if (shared.length) css += '.ws-sidenav {\n' + shared.join('\n') + '\n}\n';
            if (perVariant.expanded.length) css += '\n.ws-sidenav--expanded {\n' + perVariant.expanded.join('\n') + '\n}\n';
            if (perVariant.rail.length) css += '\n.ws-sidenav--rail {\n' + perVariant.rail.join('\n') + '\n}\n';
            out.textContent = css;
        }
        contrast();
    }

    /* Contrast is the thing most easily broken by a colour tweak, so check it
       live rather than letting a pretty pairing ship unmeasured. */
    function lum(hex) {
        var c = [1, 3, 5].map(function (i) { return parseInt(hex.substr(i, 2), 16) / 255; })
            .map(function (v) { return v <= 0.03928 ? v / 12.92 : Math.pow((v + 0.055) / 1.055, 2.4); });
        return 0.2126 * c[0] + 0.7152 * c[1] + 0.0722 * c[2];
    }
    function ratio(a, b) {
        var la = lum(a), lb = lum(b), hi = Math.max(la, lb), lo = Math.min(la, lb);
        return (hi + 0.05) / (lo + 0.05);
    }
    function contrast() {
        var ind = toHex(getComputedStyle(navs.expanded).getPropertyValue('--ws-sidenav-indicator'));
        var oni = toHex(getComputedStyle(navs.expanded).getPropertyValue('--ws-sidenav-on-indicator'));
        var surf = toHex(getComputedStyle(navs.expanded).getPropertyValue('--ws-sidenav-surface'));
        var ons = toHex(getComputedStyle(navs.expanded).getPropertyValue('--ws-sidenav-on-surface'));
        var a = ratio(oni, ind), b = ratio(ons, surf);
        var ok = a >= 4.5 && b >= 4.5;
        document.getElementById('pgContrast').textContent =
            'Contrast — active ' + a.toFixed(2) + ':1, inactive ' + b.toFixed(2) + ':1 · ' +
            (ok ? 'both clear AA' : 'BELOW AA (4.5:1 needed)');
    }

    panel.addEventListener('input', function (e) {
        if (e.target.dataset.var) apply(e.target);
    });

    document.getElementById('pgReset').addEventListener('click', function () {
        inputs.forEach(function (el) {
            var targets = el.dataset.target ? [navs[el.dataset.target]] : all;
            targets.forEach(function (n) { n.style.removeProperty(el.dataset.var); });
            el.value = defaults[el.id];
            sync(el);
        });
        render();
    });

    document.getElementById('pgCopy').addEventListener('click', function () {
        navigator.clipboard.writeText(out.textContent).then(function () {
            /* ws_button renders its text in a __text span — swap that, not the
               whole button, or the icon gets wiped out. */
            var label = document.querySelector('#pgCopy .ws-btn__text') || document.getElementById('pgCopy');
            var t = label.textContent;
            label.textContent = 'Copied';
            setTimeout(function () { label.textContent = t; }, 1200);
        });
    });

    render();
})();
</script>

<?php require_once __DIR__ . '/../includes/ds-footer.php'; ?>
