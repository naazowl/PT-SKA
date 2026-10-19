<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Admin') — PT Solusi Koneksi Anda</title>

        {{-- Favicon logo perusahaan pada tab browser --}}
        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
          
        <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    <link
        rel="stylesheet"
        href="{{ asset('css/smart-animations.css') }}"
    >

    <style>
        :root {
            --admin-primary: #2563eb;
            --admin-primary-dark: #1d4ed8;
            --admin-sidebar: #ffffff;
            --admin-bg: #f5f7fb;
            --admin-border: #e8edf4;
            --admin-text: #1e293b;
            --admin-muted: #64748b;
        }

        body {
            margin: 0;
            background: var(--admin-bg);
            color: var(--admin-text);
            font-family: system-ui, -apple-system, BlinkMacSystemFont,
                         "Segoe UI", sans-serif;
            font-size: 14px;
        }

        .admin-shell {
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 1030;
            display: flex;
            flex-direction: column;
            width: 258px;
            padding: 26px 18px 18px;
            overflow-y: auto;
            background: var(--admin-sidebar);
            border-right: 1px solid var(--admin-border);
        }

        .admin-brand {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 0 10px;
            margin-bottom: 36px;
            color: var(--admin-text);
            font-size: 16px;
            font-weight: 800;
            text-decoration: none;
            letter-spacing: -0.3px;
        }

        .admin-brand img {
            display: block;
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            object-fit: contain;
        }

        .admin-brand-name {
            line-height: 1.35;
        }

        .brand-mark {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            color: #fff;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border-radius: 12px;
            font-size: 21px;
            font-weight: 800;
            box-shadow: 0 5px 12px rgba(37, 99, 235, 0.2);
        }

        .sidebar-label {
            padding: 0 12px;
            margin-bottom: 12px;
            color: #94a3b8;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.2px;
        }

        .sidebar > a:not(.admin-brand) {
            display: flex;
            align-items: center;
            gap: 13px;
            min-height: 46px;
            padding: 12px 14px;
            margin-bottom: 5px;
            color: #64748b;
            border: 1px solid transparent;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s ease, color 0.2s ease,
                        border-color 0.2s ease;
        }

        .sidebar > a:not(.admin-brand) > i {
            width: 20px;
            text-align: center;
            font-size: 17px;
        }

        .sidebar > a:not(.admin-brand):hover {
            color: var(--admin-primary);
            background: #f1f5ff;
        }

        .sidebar > a.active {
            color: var(--admin-primary);
            background: #eff6ff;
            border-color: #dbeafe;
            font-weight: 700;
        }

        .sidebar-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 22px;
            height: 22px;
            padding: 0 7px;
            margin-left: auto;
            color: #fff;
            background: #ef4444;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
            line-height: 1;
        }

        .sidebar-bottom {
            padding-top: 18px;
            margin-top: auto;
            border-top: 1px solid var(--admin-border);
        }

        .sidebar-bottom a,
        .sidebar-bottom button {
            display: flex;
            align-items: center;
            gap: 13px;
            width: 100%;
            padding: 12px 14px;
            color: #64748b;
            background: transparent;
            border: 0;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-align: left;
            text-decoration: none;
            transition: 0.2s ease;
        }

        .sidebar-bottom a i,
        .sidebar-bottom button i {
            width: 20px;
            text-align: center;
            font-size: 17px;
        }

        .sidebar-bottom a:hover {
            color: var(--admin-primary);
            background: #f1f5ff;
        }

        .sidebar-bottom button:hover {
            color: #dc2626;
            background: #fef2f2;
        }

        /* Area utama */
        .admin-main {
            min-width: 0;
            min-height: 100vh;
            margin-left: 258px;
        }

        .admin-topbar {
            position: sticky;
            top: 0;
            z-index: 1020;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            min-height: 76px;
            padding: 15px 34px;
            background: rgba(255, 255, 255, 0.96);
            border-bottom: 1px solid var(--admin-border);
            backdrop-filter: blur(12px);
        }

        .topbar-breadcrumb {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 5px;
            color: #94a3b8;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .topbar-breadcrumb i {
            font-size: 12px;
        }

        .topbar-heading {
            color: var(--admin-text);
            font-size: 16px;
            font-weight: 750;
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            color: var(--admin-primary);
            background: #eff6ff;
            border: 1px solid #dbeafe;
            border-radius: 50%;
            font-size: 14px;
            font-weight: 800;
        }

        .admin-user-name {
            color: #334155;
            font-size: 12px;
            font-weight: 700;
        }

        .admin-user-role {
            margin-top: 2px;
            color: #94a3b8;
            font-size: 10px;
        }

        .admin-content {
            width: 100%;
            max-width: 1600px;
            padding: 30px 34px 40px;
            margin: 0 auto;
        }

        /* Heading halaman */
        .admin-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 26px;
        }

        .admin-heading h1 {
            margin: 0 0 7px;
            color: var(--admin-text);
            font-size: clamp(22px, 2vw, 27px);
            font-weight: 800;
            letter-spacing: -0.7px;
        }

        .admin-heading p {
            margin: 0;
            color: var(--admin-muted);
            font-size: 13px;
            line-height: 1.7;
        }

        /* Panel dan tabel */
        .panel {
            background: #fff;
            border: 1px solid var(--admin-border);
            border-radius: 15px;
            box-shadow: 0 3px 12px rgba(15, 23, 42, 0.025);
        }

        .table {
            --bs-table-bg: transparent;
            --bs-table-color: var(--admin-text);
        }

        .table thead th {
            padding: 14px 12px;
            color: #64748b;
            background: #f8fafc;
            border-bottom: 1px solid var(--admin-border);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .table tbody td {
            border-color: #edf1f6;
            font-size: 13px;
        }

        .table tbody tr:last-child td {
            border-bottom: 0;
        }

        /* Tombol */
        .btn {
            border-radius: 9px;
            font-size: 12px;
            font-weight: 650;
            transition: 0.2s ease;
        }

        .btn-primary {
            background: var(--admin-primary);
            border-color: var(--admin-primary);
        }

        .btn-primary:hover {
            background: var(--admin-primary-dark);
            border-color: var(--admin-primary-dark);
        }

        .btn-outline-primary {
            color: var(--admin-primary);
            border-color: #bfdbfe;
        }

        .btn-outline-primary:hover {
            color: #fff;
            background: var(--admin-primary);
            border-color: var(--admin-primary);
        }

        .form-label {
            color: #334155;
            font-size: 12px;
            font-weight: 700;
        }

        .form-control,
        .form-select {
            min-height: 42px;
            border-color: #dce3ed;
            border-radius: 9px;
            font-size: 13px;
        }

        textarea.form-control {
            min-height: auto;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #93c5fd;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .stat-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 52px;
            height: 52px;
            flex-shrink: 0;
            color: var(--admin-primary);
            background: #eff6ff;
            border-radius: 13px;
            font-size: 24px;
        }

        .alert {
            border: 0;
            border-radius: 11px;
            font-size: 13px;
        }

        /* Transisi notifikasi */
        .alert.fade {
            transition: opacity 0.25s linear;
        }

        .pagination {
            gap: 5px;
        }

        .pagination .page-link {
            color: var(--admin-primary);
            border-color: var(--admin-border);
            border-radius: 8px;
            font-size: 12px;
        }

        .pagination .page-item.active .page-link {
            color: #fff;
            background: var(--admin-primary);
            border-color: var(--admin-primary);
        }

        /* Tombol menu layar kecil */
        .mobile-menu-btn {
            display: none;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            color: #334155;
            background: #f8fafc;
            border: 1px solid var(--admin-border);
            border-radius: 9px;
            font-size: 20px;
        }

        .sidebar-backdrop {
            display: none;
        }

        /* Modal konfirmasi logout */
        .logout-modal-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 70px;
            color: #dc2626;
            background: #fef2f2;
            border-radius: 50%;
            font-size: 30px;
        }

        .logout-modal .modal-content {
            overflow: hidden;
            border: 0;
            border-radius: 18px;
        }

        .logout-modal .modal-title {
            color: var(--admin-text);
            font-size: 20px;
            font-weight: 800;
        }

        .logout-modal .modal-description {
            color: var(--admin-muted);
            font-size: 13px;
            line-height: 1.8;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.25s ease;
            }

            body.sidebar-open .sidebar {
                transform: translateX(0);
            }

            .sidebar-backdrop {
                position: fixed;
                inset: 0;
                z-index: 1025;
                background: rgba(15, 23, 42, 0.35);
            }

            body.sidebar-open .sidebar-backdrop {
                display: block;
            }

            .admin-main {
                margin-left: 0;
            }

            .mobile-menu-btn {
                display: inline-flex;
            }

            .admin-topbar {
                padding: 14px 22px;
            }

            .admin-content {
                padding: 25px 22px 35px;
            }
        }

        @media (max-width: 575.98px) {
            .admin-topbar {
                min-height: 68px;
                padding: 12px 15px;
            }

            .admin-content {
                padding: 22px 15px 30px;
            }

            .admin-heading {
                align-items: flex-start;
                margin-bottom: 22px;
            }

            .admin-heading > a {
                max-width: 100%;
            }

            .admin-user-name,
            .admin-user-role {
                display: none;
            }

            .panel {
                border-radius: 12px;
            }

            .logout-modal .modal-dialog {
                margin: 16px;
            }
        }
    </style>
</head>

<body>

@php
    // Jumlah pesan kontak yang belum dibaca.
    // Admin tetap dapat dibuka jika tabel belum tersedia.
    try {
        $unreadMessages = \App\Models\ContactMessage::whereNull('read_at')->count();
    } catch (\Throwable $e) {
        $unreadMessages = 0;
    }
@endphp

<div class="admin-shell">

    <aside class="sidebar" id="adminSidebar">

        <a href="{{ route('admin.dashboard') }}" class="admin-brand">
            <img
                src="{{ asset('images/logo.png') }}"
                alt="Logo PT Solusi Koneksi Anda"
            >

            <span class="admin-brand-name">
                PT Solusi<br>
                <span class="text-primary">Koneksi Anda</span>
            </span>
        </a>

        <div class="sidebar-label">MENU UTAMA</div>

        <a
            class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
            href="{{ route('admin.dashboard') }}"
        >
            <i class="bi bi-grid-1x2"></i>
            <span>Dashboard</span>
        </a>

        <a
            class="{{ request()->routeIs('admin.produk.*') ? 'active' : '' }}"
            href="{{ route('admin.produk.index') }}"
        >
            <i class="bi bi-box-seam"></i>
            <span>Produk &amp; Layanan</span>
        </a>

        <a
            class="{{ request()->routeIs('admin.artikel.*') ? 'active' : '' }}"
            href="{{ route('admin.artikel.index') }}"
        >
            <i class="bi bi-file-earmark-text"></i>
            <span>Artikel</span>
        </a>

        <a
            class="{{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}"
            href="{{ route('admin.galeri.index') }}"
        >
            <i class="bi bi-images"></i>
            <span>Galeri</span>
        </a>

        <a
            class="{{ request()->routeIs('admin.profile.*') ? 'active' : '' }}"
            href="{{ route('admin.profile.edit') }}"
        >
            <i class="bi bi-building"></i>
            <span>Profil Perusahaan</span>
        </a>

        <a
            class="{{ request()->routeIs('admin.pesan.*') ? 'active' : '' }}"
            href="{{ route('admin.pesan.index') }}"
        >
            <i class="bi bi-envelope"></i>
            <span>Pesan</span>

            @if ($unreadMessages > 0)
                <span class="sidebar-badge">
                    {{ $unreadMessages > 99 ? '99+' : $unreadMessages }}
                </span>
            @endif
        </a>

        <div class="sidebar-bottom">

            <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer">
                <i class="bi bi-box-arrow-up-right"></i>
                <span>Lihat website</span>
            </a>

            <form method="POST" action="{{ route('admin.logout') }}" id="logoutForm">
                @csrf

                <button
                    type="button"
                    data-bs-toggle="modal"
                    data-bs-target="#logoutModal"
                >
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Keluar</span>
                </button>
            </form>

        </div>
    </aside>

    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <main class="admin-main">

        <header class="admin-topbar">

            <div class="d-flex align-items-center gap-3">
                <button
                    type="button"
                    class="mobile-menu-btn"
                    id="mobileMenuBtn"
                    aria-label="Buka menu navigasi"
                    aria-controls="adminSidebar"
                    aria-expanded="false"
                >
                    <i class="bi bi-list"></i>
                </button>

                <div>
                    <div class="topbar-breadcrumb">
                        <span>PT SOLUSI KONEKSI ANDA</span>
                        <i class="bi bi-chevron-right"></i>
                        <span>@yield('heading', 'Dashboard')</span>
                    </div>

                    <div class="topbar-heading">
                        @yield('heading', 'Dashboard')
                    </div>
                </div>
            </div>

            <div class="admin-user">
                <span class="avatar">
                    {{ strtoupper(substr(session('admin_name', 'A'), 0, 1)) }}
                </span>

                <div>
                    <div class="admin-user-name">
                        {{ session('admin_name', 'Admin') }}
                    </div>

                    <div class="admin-user-role">
                        Administrator
                    </div>
                </div>
            </div>

        </header>

        <div class="admin-content">

            {{-- Notifikasi sukses: hilang otomatis setelah 5 detik --}}
            @if (session('success'))
                <div
                    class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2"
                    role="alert"
                    aria-live="polite"
                    data-auto-dismiss="5000"
                >
                    <i class="bi bi-check-circle-fill"></i>
                    <div>{{ session('success') }}</div>

                    <button
                        type="button"
                        class="btn-close ms-auto"
                        data-bs-dismiss="alert"
                        aria-label="Tutup"
                    ></button>
                </div>
            @endif

            {{-- Notifikasi peringatan: hilang otomatis setelah 5 detik --}}
            @if (session('warning'))
                <div
                    class="alert alert-warning alert-dismissible fade show d-flex align-items-center gap-2"
                    role="alert"
                    aria-live="polite"
                    data-auto-dismiss="5000"
                >
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <div>{{ session('warning') }}</div>

                    <button
                        type="button"
                        class="btn-close ms-auto"
                        data-bs-dismiss="alert"
                        aria-label="Tutup"
                    ></button>
                </div>
            @endif

            {{-- Pesan validasi tidak otomatis hilang --}}
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <div class="fw-bold mb-2">
                        <i class="bi bi-exclamation-circle me-1"></i>
                        Periksa kembali data yang dimasukkan.
                    </div>

                    <ul class="mb-0 ps-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')

        </div>

    </main>

</div>

{{-- Modal konfirmasi logout --}}
<div
    class="modal fade logout-modal"
    id="logoutModal"
    tabindex="-1"
    aria-labelledby="logoutModalLabel"
    aria-describedby="logoutModalDescription"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-body text-center p-4 p-md-5">

                <div class="logout-modal-icon mb-3">
                    <i class="bi bi-box-arrow-right"></i>
                </div>

                <h5 class="modal-title mb-2" id="logoutModalLabel">
                    Konfirmasi Logout
                </h5>

                <p class="modal-description mb-4" id="logoutModalDescription">
                    Apakah Anda yakin ingin keluar dari halaman admin?
                    Anda perlu login kembali untuk mengakses dashboard.
                </p>

                <div class="d-flex justify-content-center flex-wrap gap-2">
                    <button
                        type="button"
                        class="btn btn-light border px-4 py-2"
                        data-bs-dismiss="modal"
                    >
                        <i class="bi bi-x-lg me-1"></i>
                        Batal
                    </button>

                    <button
                        type="submit"
                        form="logoutForm"
                        class="btn btn-danger px-4 py-2"
                    >
                        <i class="bi bi-box-arrow-right me-1"></i>
                        Ya, Keluar
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Tutup notifikasi sukses dan peringatan setelah 5 detik.
    document.addEventListener('DOMContentLoaded', function () {
        const notifications = document.querySelectorAll(
            '[data-auto-dismiss="5000"]'
        );

        notifications.forEach(function (notification) {
            window.setTimeout(function () {
                if (!notification.isConnected) {
                    return;
                }

                if (typeof bootstrap !== 'undefined' && bootstrap.Alert) {
                    bootstrap.Alert
                        .getOrCreateInstance(notification)
                        .close();
                } else {
                    notification.remove();
                }
            }, 5000);
        });
    });

    // Menu sidebar untuk layar kecil.
    const menuButton = document.getElementById('mobileMenuBtn');
    const backdrop = document.getElementById('sidebarBackdrop');

    function closeSidebar() {
        document.body.classList.remove('sidebar-open');

        if (menuButton) {
            menuButton.setAttribute('aria-expanded', 'false');
            menuButton.setAttribute('aria-label', 'Buka menu navigasi');
            menuButton.innerHTML = '<i class="bi bi-list"></i>';
        }
    }

    if (menuButton) {
        menuButton.addEventListener('click', function () {
            const isOpen = document.body.classList.toggle('sidebar-open');

            menuButton.setAttribute('aria-expanded', String(isOpen));
            menuButton.setAttribute(
                'aria-label',
                isOpen ? 'Tutup menu navigasi' : 'Buka menu navigasi'
            );

            menuButton.innerHTML = isOpen
                ? '<i class="bi bi-x-lg"></i>'
                : '<i class="bi bi-list"></i>';
        });
    }

    if (backdrop) {
        backdrop.addEventListener('click', closeSidebar);
    }

    document.querySelectorAll('#adminSidebar a').forEach(function (link) {
        link.addEventListener('click', closeSidebar);
    });
</script>

<script>
    // Peringatan sebelum meninggalkan form yang belum disimpan.
    (function () {
        var content = document.querySelector('.admin-content');

        if (!content) {
            return;
        }

        // Jika halaman dimuat ulang karena validasi gagal, isian lama
        // masih tampil di form, jadi langsung dianggap belum tersimpan.
        var dirty = {{ $errors->any() ? 'true' : 'false' }};

        // Hanya form di area konten yang dilacak (bukan form logout,
        // bukan form pencarian/filter yang memakai method GET).
        function isTrackedForm(element) {
            var form = element.closest ? element.closest('form') : null;

            if (!form || !content.contains(form)) {
                return false;
            }

            if (form.hasAttribute('data-no-warn')) {
                return false;
            }

            var method = (form.getAttribute('method') || 'get').toLowerCase();

            return method !== 'get';
        }

        function markDirty(event) {
            if (isTrackedForm(event.target)) {
                dirty = true;
            }
        }

        document.addEventListener('input', markDirty);
        document.addEventListener('change', markDirty);

        // Saat form disimpan, jangan tampilkan peringatan.
        document.addEventListener('submit', function (event) {
            if (event.defaultPrevented) {
                return;
            }

            if (event.target && content.contains(event.target)) {
                dirty = false;
            }
        });

        window.addEventListener('beforeunload', function (event) {
            if (!dirty) {
                return;
            }

            event.preventDefault();
            event.returnValue = '';
        });
    })();
</script>

</body>
</html>