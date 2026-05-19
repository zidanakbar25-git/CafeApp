
@once
<style>
:root {
    --sb-width: 260px;
    --sb-collapsed: 68px;
    --sb-bg: #ffffff;
    --sb-border: #f0f0f0;
    --sb-text: #374151;
    --sb-muted: #9ca3af;
    --sb-label: #6b7280;
    --sb-active-bg: #f3f4f6;
    --sb-active-text: #111827;
    --sb-hover-bg: #f9fafb;
    --sb-ease: 0.22s cubic-bezier(0.4,0,0.2,1);
}

body {
    margin: 0;
    font-family: 'DM Sans', 'Segoe UI', system-ui, sans-serif;
    background: #f8f9fb;
}

/* ── Layout wrapper ─────────────────────────── */
.admin-layout {
    display: flex;
    min-height: 100vh;
}

.admin-content {
    flex: 1;
    margin-left: var(--sb-width);
    transition: margin-left var(--sb-ease);
    min-width: 0;
}

.admin-layout.sb-collapsed .admin-content {
    margin-left: var(--sb-collapsed);
}

/* ── Sidebar shell ──────────────────────────── */
.sb {
    position: fixed;
    top: 0; left: 0;
    height: 100vh;
    width: var(--sb-width);
    background: var(--sb-bg);
    border-right: 1px solid var(--sb-border);
    display: flex;
    flex-direction: column;
    z-index: 100;
    overflow: hidden;
    transition: width var(--sb-ease);
}

.admin-layout.sb-collapsed .sb {
    width: var(--sb-collapsed);
}

/* ── Brand ──────────────────────────────────── */
.sb-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 20px 16px;
    border-bottom: 1px solid var(--sb-border);
    flex-shrink: 0;
    overflow: hidden;
}

.sb-avatar {
    width: 36px; height: 36px; min-width: 36px;
    background: #111827; color: #fff;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 700; letter-spacing: 0.5px;
    flex-shrink: 0;
}

.sb-brand-info {
    flex: 1; overflow: hidden;
}

.sb-brand-name {
    display: block;
    font-size: 14px; font-weight: 700; color: var(--sb-text);
    white-space: nowrap; line-height: 1.3;
}

.sb-brand-role {
    display: block;
    font-size: 11px; color: var(--sb-muted);
    white-space: nowrap; margin-top: 1px;
}

.sb-toggle {
    min-width: 28px; width: 28px; height: 28px;
    border: none; background: transparent;
    border-radius: 7px; cursor: pointer;
    color: var(--sb-muted);
    display: flex; align-items: center; justify-content: center;
    transition: background var(--sb-ease), color var(--sb-ease);
    flex-shrink: 0;
}
.sb-toggle:hover { background: var(--sb-active-bg); color: var(--sb-text); }

/* ── Nav ────────────────────────────────────── */
.sb-nav {
    flex: 1;
    overflow-y: auto; overflow-x: hidden;
    padding: 12px 10px;
    scrollbar-width: thin;
    scrollbar-color: var(--sb-border) transparent;
}
.sb-nav::-webkit-scrollbar { width: 4px; }
.sb-nav::-webkit-scrollbar-thumb { background: var(--sb-border); border-radius: 4px; }

.sb-section { margin-bottom: 6px; }

.sb-section-label {
    display: block;
    font-size: 10.5px; font-weight: 600;
    letter-spacing: 0.8px; text-transform: uppercase;
    color: var(--sb-label);
    padding: 8px 8px 4px;
    white-space: nowrap;
    transition: opacity var(--sb-ease);
}

.sb-list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 2px; }

.sb-item {
    display: flex; align-items: center; gap: 10px;
    padding: 9px 10px; border-radius: 9px;
    text-decoration: none;
    color: var(--sb-text);
    font-size: 13.5px; font-weight: 500;
    white-space: nowrap; overflow: hidden;
    position: relative;
    transition: background var(--sb-ease), color var(--sb-ease);
}
.sb-item:hover  { background: var(--sb-hover-bg); color: var(--sb-active-text); }
.sb-item.active { background: var(--sb-active-bg); color: var(--sb-active-text); font-weight: 600; }

.sb-icon {
    display: flex; align-items: center; justify-content: center;
    width: 20px; min-width: 20px;
    opacity: 0.7;
    transition: opacity var(--sb-ease);
}
.sb-item:hover .sb-icon,
.sb-item.active .sb-icon { opacity: 1; }

.sb-label { flex: 1; overflow: hidden; text-overflow: ellipsis; }

.sb-badge {
    background: #111827; color: #fff;
    font-size: 10px; font-weight: 700;
    min-width: 18px; height: 18px; padding: 0 5px;
    border-radius: 20px;
    display: flex; align-items: center; justify-content: center;
}

/* ── Footer ─────────────────────────────────── */
.sb-footer {
    padding: 10px 10px 16px;
    border-top: 1px solid var(--sb-border);
    flex-shrink: 0;
}
.sb-footer .sb-item { color: var(--sb-muted); }
.sb-footer .sb-item:hover { color: var(--sb-text); }

/* ── Collapsed: sembunyikan teks ────────────── */
.admin-layout.sb-collapsed .sb-brand-info,
.admin-layout.sb-collapsed .sb-label,
.admin-layout.sb-collapsed .sb-section-label,
.admin-layout.sb-collapsed .sb-badge {
    opacity: 0;
    pointer-events: none;
    width: 0;
}

.logout-btn {
    width: 100%;
    padding: 9px 10px;
    border-radius: 10px;
    background: #ef4444;
    color: #111827 !important;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-size: 13.5px;
    font-weight: 600;
    transition: background 0.2s ease;
    box-sizing: border-box;
}

.logout-btn:hover {
    background: #dc2626;
}



.logo-wrapper {
    width: 36px;
    height: 36px;
    min-width: 36px;
    border-radius: 10px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #5C3A21;
    flex-shrink: 0;
}

.logo-img {
    width: 78%;
    height: 78%;
    object-fit: contain;
}

/* ── Collapsed: tooltip hover ───────────────── */
.admin-layout.sb-collapsed .sb-item::after {
    content: attr(data-tip);
    position: absolute;
    left: calc(100% + 12px); top: 50%;
    transform: translateY(-50%);
    background: #111827; color: #fff;
    padding: 5px 10px; border-radius: 7px;
    font-size: 12px; font-weight: 500;
    white-space: nowrap; pointer-events: none;
    opacity: 0;
    transition: opacity 0.15s ease;
    z-index: 200;
}
.admin-layout.sb-collapsed .sb-item:hover::after { opacity: 1; }

/* ── Overlay mobile ─────────────────────────── */
.sb-overlay {
    display: none;
    position: fixed; inset: 0;
    background: rgba(0,0,0,0.3);
    backdrop-filter: blur(2px);
    z-index: 99;
}

/* ── Mobile ─────────────────────────────────── */
.sb-mobile-btn {
    display: none;
    align-items: center; justify-content: center;
    width: 38px; height: 38px;
    border: 1px solid var(--sb-border);
    border-radius: 9px; background: #fff;
    cursor: pointer; color: var(--sb-text);
    flex-shrink: 0;
}

@media (max-width: 768px) {
    .sb {
        transform: translateX(-100%);
        width: var(--sb-width) !important;
        transition: transform var(--sb-ease);
    }
    .admin-layout.sb-open .sb        { transform: translateX(0); }
    .admin-layout.sb-open .sb-overlay { display: block; }
    .admin-content                    { margin-left: 0 !important; }
    .sb-mobile-btn                    { display: flex; }
}
</style>
@endonce

{{-- ═══════════════════════════════════════════
     HTML
════════════════════════════════════════════ --}}
<aside class="sb">

    <div class="sb-brand">
        <div class="logo-wrapper">
            <img src="{{ asset('images/logo/logo.png') }}" class="logo-img">
        </div>
        <div class="sb-brand-info">
            <span class="sb-brand-name">Cozy Cafe</span>
            <span class="sb-brand-role">Admin Panel</span>
        </div>
        <button class="sb-toggle" id="sbToggle" title="Toggle Sidebar">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="3" y1="6" x2="21" y2="6"/>
                <line x1="3" y1="12" x2="21" y2="12"/>
                <line x1="3" y1="18" x2="21" y2="18"/>
            </svg>
        </button>
    </div>

    <nav class="sb-nav">

        <div class="sb-section">
            <span class="sb-section-label">Overview</span>
            <ul class="sb-list">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                       data-tip="Dashboard"
                       class="sb-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <span class="sb-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
                                <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
                            </svg>
                        </span>
                        <span class="sb-label">Dashboard</span>
                        @if(($pendingOrderCount ?? 0) > 0)
                            <span class="sb-badge">{{ $pendingOrderCount }}</span>
                        @endif
                    </a>
                </li>
            </ul>
        </div>

        <div class="sb-section">
            <span class="sb-section-label">Manajemen</span>
            <ul class="sb-list">
                <li>
                    <a href="{{ route('admin.tables.index') }}"
                       data-tip="Manajemen Meja"
                       class="sb-item {{ request()->routeIs('admin.tables.*') ? 'active' : '' }}">
                        <span class="sb-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2"/>
                                <line x1="3" y1="9" x2="21" y2="9"/>
                                <line x1="3" y1="15" x2="21" y2="15"/>
                                <line x1="9" y1="3" x2="9" y2="21"/>
                            </svg>
                        </span>
                        <span class="sb-label">Manajemen Meja</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.menu.index') }}"
                       data-tip="Manajemen Menu"
                       class="sb-item {{ request()->routeIs('admin.menu.*') ? 'active' : '' }}">
                        <span class="sb-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"/><path d="M7 2v20"/>
                                <path d="M21 15V2a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3zm0 0v7"/>
                            </svg>
                        </span>
                        <span class="sb-label">Manajemen Menu</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.admins.index') }}"
                       data-tip="Manajemen Admin"
                       class="sb-item {{ request()->routeIs('admin.admins.*') ? 'active' : '' }}">
                        <span class="sb-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="8" r="4"/>
                                <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                            </svg>
                        </span>
                        <span class="sb-label">Manajemen Admin</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="sb-section">
            <span class="sb-section-label">Riwayat</span>
            <ul class="sb-list">
                <li>
                    <a href="{{ route('admin.orders.history') }}"
                       data-tip="History Pesanan"
                       class="sb-item {{ request()->routeIs('admin.orders.history') ? 'active' : '' }}">
                        <span class="sb-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="9"/>
                                <path d="M12 7v5l3 3"/>
                            </svg>
                        </span>
                        <span class="sb-label">History Pesanan</span>
                    </a>
                </li>
            </ul>
        </div>

    </nav>

   <div class="sb-footer">
    <a href="/logout" class="logout-btn">
        Logout
    </a>
</div>

</aside>

<div class="sb-overlay" id="sbOverlay"></div>

{{-- ═══════════════════════════════════════════
     JS  (hanya di-render sekali)
════════════════════════════════════════════ --}}
@once
<script>
(function () {
    var STORE  = 'mochi_sb_collapsed';
    var layout = document.querySelector('.admin-layout');

    // Restore state saat halaman dibuka
    if (localStorage.getItem(STORE) === 'true' && window.innerWidth > 768) {
        layout && layout.classList.add('sb-collapsed');
    }

    // Toggle collapse (desktop) atau tutup (mobile)
    var toggle = document.getElementById('sbToggle');
    toggle && toggle.addEventListener('click', function () {
        if (window.innerWidth <= 768) {
            layout && layout.classList.remove('sb-open');
            return;
        }
        layout && layout.classList.toggle('sb-collapsed');
        localStorage.setItem(STORE, layout && layout.classList.contains('sb-collapsed'));
    });

    // Tutup sidebar lewat overlay (mobile)
    var overlay = document.getElementById('sbOverlay');
    overlay && overlay.addEventListener('click', function () {
        layout && layout.classList.remove('sb-open');
    });

    // Tombol buka sidebar mobile — taruh di topbar kamu dengan id="sbMobileBtn"
    var mobileBtn = document.getElementById('sbMobileBtn');
    mobileBtn && mobileBtn.addEventListener('click', function () {
        layout && layout.classList.add('sb-open');
    });

    // ESC menutup sidebar di mobile
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') layout && layout.classList.remove('sb-open');
    });
})();
</script>
@endonce