<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', $company->company_name ?? 'PT Solusi Koneksi Anda')</title>

    {{-- Logo perusahaan sebagai ikon tab browser (favicon) --}}
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    {{-- Bootstrap CSS --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    {{-- CSS utama website --}}
    <link href="{{ asset('css/site.css') }}" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    {{-- Smart Animations --}}
    <link
        rel="stylesheet"
        href="{{ asset('css/smart-animations.css') }}"
    >

    <script>
        if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            document.documentElement.classList.add('js-anim');
        }
    </script>

</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top border-bottom">
        <div class="container">

            <a
                class="navbar-brand fw-bold d-flex align-items-center gap-2"
                href="{{ route('home') }}"
            >
                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="Logo PT Solusi Koneksi Anda"
                    width="42"
                    height="42"
                    style="object-fit: contain;"
                >

                <span>
                    PT Solusi <span class="text-primary">Koneksi Anda</span>
                </span>
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navMain"
                aria-controls="navMain"
                aria-expanded="false"
                aria-label="Buka navigasi"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}">Profil</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products') }}">Layanan</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('articles') }}">Artikel</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('gallery') }}">Galeri</a>
                    </li>

                    <li class="nav-item ms-lg-2">
                        <a
                            class="btn btn-primary rounded-pill px-4"
                            href="{{ route('contact') }}"
                        >
                            Hubungi Kami
                            <span aria-hidden="true">↗</span>
                        </a>
                    </li>

                </ul>
            </div>

        </div>
    </nav>

    {{-- NOTIFIKASI SUKSES --}}
    @if (session('success'))
        <div class="container mt-3">
            <div
                class="alert alert-success alert-dismissible fade show"
                role="alert"
                aria-live="polite"
                data-auto-dismiss="5000"
            >
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Tutup"
                ></button>
            </div>
        </div>
    @endif

    {{-- KONTEN HALAMAN --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="footer mt-5">
        <div class="container py-5">
            <div class="row g-4">

                <div class="col-md-5">
                    <a
                        class="navbar-brand fw-bold text-white d-inline-flex align-items-center gap-2"
                        href="{{ route('home') }}"
                    >
                        <img
                            src="{{ asset('images/logo.png') }}"
                            alt="Logo PT Solusi Koneksi Anda"
                            width="42"
                            height="42"
                            style="object-fit: contain;"
                        >

                        <span>PT Solusi Koneksi Anda</span>
                    </a>

                    <p class="text-white-50 mt-3">
                        {{ $company->tagline ?? 'Solusi digital untuk mendukung pertumbuhan bisnis Anda.' }}
                    </p>
                </div>

                <div class="col-md-3">
                    <h6>Jelajahi</h6>

                    <a href="{{ route('profile') }}">Profil perusahaan</a>
                    <a href="{{ route('products') }}">Produk &amp; layanan</a>
                    <a href="{{ route('gallery') }}">Galeri kegiatan</a>
                    <a href="{{ route('articles') }}">Artikel</a>
                </div>

                <div class="col-md-4">
                    <h6>Kontak</h6>

                    <p class="text-white-50 mb-1">
                        {{ $company->address ?? '' }}
                    </p>

                    <p class="text-white-50 mb-1">
                        {{ $company->email ?? '' }}
                    </p>

                    <p class="text-white-50">
                        {{ $company->phone ?? '' }}
                    </p>
                </div>

            </div>

            <hr class="border-secondary">

            <small class="text-white-50">
                &copy; {{ date('Y') }} PT Solusi Koneksi Anda.
                Dibuat untuk pertumbuhan bisnis.
            </small>
        </div>
    </footer>

    {{-- Bootstrap JavaScript --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Smart Animations JavaScript --}}
    <script src="{{ asset('js/smart-animations.js') }}"></script>

    {{-- Hilangkan notifikasi sukses setelah 5 detik --}}
    <script>
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
    </script>

</body>
</html>