    </main><!-- end .ds-main -->
</div><!-- end .ds-layout -->

<!-- Component JavaScript (modals, toasts, tabs, accordion) -->
<script src="<?= $site_base ?>/includes/components/components.js?v=<?= @filemtime(dirname(__DIR__, 2) . '/includes/components/components.js') ?: '1' ?>"></script>

<script>
function toggleSidebar() {
    document.getElementById('ds-sidebar').classList.toggle('open');
    document.getElementById('ds-overlay').classList.toggle('open');
}

function toggleNavSection(btn) {
    btn.closest('.ds-nav-group').classList.toggle('open');
}

/* --- Copy-to-Clipboard on code blocks --- */
document.querySelectorAll('.ds-code').forEach(block => {
    const btn = document.createElement('button');
    btn.className = 'ds-code-copy';
    btn.innerHTML = '<span class="material-symbols-outlined">content_copy</span> Copy';
    btn.addEventListener('click', () => {
        const pre = block.querySelector('pre');
        const text = pre ? pre.textContent : block.textContent;
        navigator.clipboard.writeText(text.trim()).then(() => {
            btn.innerHTML = '<span class="material-symbols-outlined">check</span> Copied';
            btn.classList.add('ds-code-copy--copied');
            setTimeout(() => {
                btn.innerHTML = '<span class="material-symbols-outlined">content_copy</span> Copy';
                btn.classList.remove('ds-code-copy--copied');
            }, 2000);
        });
    });
    block.appendChild(btn);
});

/* --- Responsive Preview for demo containers --- */
document.querySelectorAll('.ds-demo-hero, [class*="ds-demo"]').forEach(demo => {
    // Skip if already wrapped
    if (demo.parentElement.classList.contains('ds-demo-wrap')) return;

    const wrap = document.createElement('div');
    wrap.className = 'ds-demo-wrap';
    demo.parentNode.insertBefore(wrap, demo);
    wrap.appendChild(demo);

    const bar = document.createElement('div');
    bar.className = 'ds-responsive-bar';
    bar.innerHTML = `
        <button class="ds-responsive-btn active" data-width="100%" title="Desktop">
            <span class="material-symbols-outlined">desktop_windows</span> Desktop
        </button>
        <button class="ds-responsive-btn" data-width="768px" title="Tablet">
            <span class="material-symbols-outlined">tablet_mac</span> Tablet
        </button>
        <button class="ds-responsive-btn" data-width="375px" title="Mobile">
            <span class="material-symbols-outlined">phone_iphone</span> Mobile
        </button>
    `;
    wrap.parentNode.insertBefore(bar, wrap);

    bar.querySelectorAll('.ds-responsive-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            bar.querySelectorAll('.ds-responsive-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const w = btn.dataset.width;
            wrap.style.maxWidth = w;
            wrap.className = 'ds-demo-wrap';
            if (w === '768px') wrap.classList.add('ds-demo-wrap--tablet');
            if (w === '375px') wrap.classList.add('ds-demo-wrap--mobile');
        });
    });
});
</script>
</body>
</html>
