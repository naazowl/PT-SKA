<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Admin — Solusi Admin</title>

    <link rel="icon" href="{{ asset('images/logo.png') }}">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    <style>
        /* =====================================================
           HALAMAN LOGIN MODERN
           ===================================================== */
        .sl-page {
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(0, 1fr);
            min-height: 100vh;
            background: #f8fbff;
            font-family: inherit;
        }

        /* ---------- Panel kiri (visual) ---------- */
        .sl-visual {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px 56px;
            overflow: hidden;
            color: #fff;
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 55%, #0891b2 100%);
            background-size: 200% 200%;
            animation: sl-gradient 14s ease-in-out infinite;
        }

        .sl-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: .55;
            pointer-events: none;
        }

        .sl-blob.b1 {
            top: -120px;
            right: -100px;
            width: 380px;
            height: 380px;
            background: #38bdf8;
            animation: sl-float 11s ease-in-out infinite;
        }

        .sl-blob.b2 {
            bottom: -140px;
            left: -100px;
            width: 420px;
            height: 420px;
            background: #1d4ed8;
            animation: sl-float 14s ease-in-out infinite reverse;
        }

        .sl-blob.b3 {
            top: 45%;
            left: 55%;
            width: 220px;
            height: 220px;
            background: #22d3ee;
            opacity: .35;
            animation: sl-float 9s ease-in-out infinite;
        }

        .sl-ring {
            position: absolute;
            top: -90px;
            right: -70px;
            width: 320px;
            height: 320px;
            border: 1px solid rgba(255, 255, 255, .18);
            border-radius: 50%;
            pointer-events: none;
            animation: sl-spin 40s linear infinite;
        }

        .sl-ring::after {
            position: absolute;
            inset: 40px;
            border: 1px dashed rgba(255, 255, 255, .2);
            border-radius: 50%;
            content: "";
        }

        .sl-brand,
        .sl-visual-body,
        .sl-visual-foot {
            position: relative;
            z-index: 1;
        }

        .sl-brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            color: #fff;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -.3px;
            text-decoration: none;
        }

        .sl-brand:hover {
            color: #fff;
        }

        .sl-brand img {
            display: block;
            width: 46px;
            height: 46px;
            padding: 6px;
            object-fit: contain;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 10px 24px rgba(8, 20, 60, .25);
        }

        .sl-brand b {
            color: #bae6fd;
            font-weight: 800;
        }

        .sl-visual-body h2 {
            max-width: 460px;
            margin: 0 0 18px;
            font-size: clamp(2rem, 3.2vw, 3rem);
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -1.4px;
        }

        .sl-visual-body h2 span {
            color: #bae6fd;
        }

        .sl-visual-body p {
            max-width: 430px;
            margin: 0;
            color: rgba(255, 255, 255, .82);
            font-size: 15px;
            line-height: 1.85;
        }

        .sl-points {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin: 32px 0 0;
            padding: 0;
            list-style: none;
        }

        .sl-points li {
            display: flex;
            align-items: center;
            gap: 12px;
            width: fit-content;
            padding: 11px 16px;
            color: #fff;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .2);
            border-radius: 14px;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            font-size: 13px;
            font-weight: 600;
        }

        .sl-points li svg {
            flex-shrink: 0;
            width: 18px;
            height: 18px;
            color: #bae6fd;
        }

        .sl-visual-foot {
            color: rgba(255, 255, 255, .65);
            font-size: 12px;
        }

        /* ---------- Panel kanan (form) ---------- */
        .sl-form-side {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
            overflow: hidden;
            background:
                radial-gradient(ellipse at 100% 0%, rgba(96, 165, 250, .16), transparent 40%),
                radial-gradient(ellipse at 0% 100%, rgba(191, 219, 254, .35), transparent 40%),
                #f8fbff;
        }

        .sl-card {
            position: relative;
            width: 100%;
            max-width: 440px;
            padding: 42px 38px;
            background: rgba(255, 255, 255, .92);
            border: 1px solid #e7edf5;
            border-radius: 26px;
            box-shadow: 0 30px 70px rgba(30, 64, 175, .12);
            animation: sl-card-in .8s cubic-bezier(.2, .8, .2, 1) both;
        }

        .sl-card::before {
            position: absolute;
            top: 0;
            right: 28px;
            left: 28px;
            height: 3px;
            background: linear-gradient(90deg, #2563eb, #06b6d4);
            border-radius: 0 0 6px 6px;
            content: "";
        }

        .sl-mobile-brand {
            display: none;
            align-items: center;
            gap: 11px;
            margin-bottom: 26px;
            color: #14213d;
            font-size: 18px;
            font-weight: 800;
            text-decoration: none;
        }

        .sl-mobile-brand img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .sl-mobile-brand b {
            color: #2563eb;
        }

        .sl-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 13px;
            color: #1d4ed8;
            background: #eff6ff;
            border: 1px solid #dbeafe;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        .sl-eyebrow::before {
            width: 7px;
            height: 7px;
            background: #3b82f6;
            border-radius: 50%;
            content: "";
            animation: sl-pulse 2s ease-out infinite;
        }

        .sl-card h1 {
            margin: 18px 0 8px;
            color: #14213d;
            font-size: 29px;
            font-weight: 800;
            letter-spacing: -.9px;
        }

        .sl-card h1 span {
            color: #2563eb;
            background: linear-gradient(100deg, #2563eb, #06b6d4);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .sl-sub {
            margin-bottom: 26px;
            color: #64748b;
            font-size: 14px;
            line-height: 1.8;
        }

        /* Animasi masuk bertahap */
        .sl-in {
            animation: sl-up .7s cubic-bezier(.2, .8, .2, 1) both;
        }

        .sl-d1 { animation-delay: .15s; }
        .sl-d2 { animation-delay: .25s; }
        .sl-d3 { animation-delay: .35s; }
        .sl-d4 { animation-delay: .45s; }
        .sl-d5 { animation-delay: .55s; }
        .sl-d6 { animation-delay: .65s; }

        /* Alert */
        .sl-card .alert {
            padding: 12px 15px;
            border-radius: 12px;
            font-size: 13px;
            line-height: 1.7;
        }

        .sl-card .alert-danger {
            animation: sl-shake .45s ease both;
        }

        /* Field */
        .sl-card .form-label {
            margin-bottom: 8px;
            color: #334155;
            font-size: 13px;
            font-weight: 700;
        }

        .sl-field {
            position: relative;
        }

        .sl-field .sl-icon {
            position: absolute;
            top: 50%;
            left: 15px;
            width: 18px;
            height: 18px;
            color: #94a3b8;
            transform: translateY(-50%);
            pointer-events: none;
            transition: color .2s ease;
        }

        .sl-field:focus-within .sl-icon {
            color: #2563eb;
        }

        .sl-card .form-control {
            min-height: 50px;
            padding: 13px 15px 13px 45px;
            color: #172554;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 13px;
            font-size: 14px;
            transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
        }

        .sl-card .form-control::placeholder {
            color: #94a3b8;
        }

        .sl-card .form-control:focus {
            background: #fff;
            border-color: #60a5fa;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, .12);
        }

        .sl-card .sl-field.has-toggle .form-control {
            padding-right: 48px;
        }

        .sl-toggle {
            position: absolute;
            top: 50%;
            right: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            padding: 0;
            color: #94a3b8;
            background: transparent;
            border: 0;
            border-radius: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            transition: color .2s ease, background .2s ease;
        }

        .sl-toggle:hover {
            color: #2563eb;
            background: #eff6ff;
        }

        .sl-toggle svg {
            width: 18px;
            height: 18px;
        }

        .sl-toggle .eye-off {
            display: none;
        }

        .sl-toggle.is-shown .eye {
            display: none;
        }

        .sl-toggle.is-shown .eye-off {
            display: block;
        }

        /* Tombol */
        .sl-submit {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            min-height: 52px;
            margin-top: 8px;
            overflow: hidden;
            color: #fff;
            background: linear-gradient(100deg, #2563eb, #0ea5e9);
            border: 0;
            border-radius: 14px;
            box-shadow: 0 12px 26px rgba(37, 99, 235, .28);
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            transition: transform .2s ease, box-shadow .2s ease, opacity .2s ease;
        }

        .sl-submit::before {
            position: absolute;
            top: 0;
            left: -120%;
            width: 60%;
            height: 100%;
            background: linear-gradient(100deg, transparent, rgba(255, 255, 255, .35), transparent);
            content: "";
            transform: skewX(-20deg);
            transition: left .6s ease;
        }

        .sl-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 32px rgba(37, 99, 235, .35);
        }

        .sl-submit:hover::before {
            left: 140%;
        }

        .sl-submit:active {
            transform: translateY(0);
        }

        .sl-submit .sl-arrow {
            transition: transform .2s ease;
        }

        .sl-submit:hover .sl-arrow {
            transform: translateX(4px);
        }

        .sl-submit .sl-spinner {
            display: none;
            width: 18px;
            height: 18px;
            border: 2px solid rgba(255, 255, 255, .4);
            border-top-color: #fff;
            border-radius: 50%;
            animation: sl-spin .7s linear infinite;
        }

        .sl-submit.is-loading {
            opacity: .85;
            pointer-events: none;
        }

        .sl-submit.is-loading .sl-spinner {
            display: inline-block;
        }

        .sl-submit.is-loading .sl-arrow {
            display: none;
        }

        .sl-back {
            margin: 26px 0 0;
            color: #64748b;
            font-size: 13px;
            text-align: center;
        }

        .sl-back a {
            color: #2563eb;
            font-weight: 700;
            text-decoration: none;
        }

        .sl-back a:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }

        /* Keyframes */
        @keyframes sl-gradient {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        @keyframes sl-float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, 40px) scale(1.08); }
        }

        @keyframes sl-spin {
            to { transform: rotate(360deg); }
        }

        @keyframes sl-card-in {
            from { opacity: 0; transform: translateY(28px) scale(.97); }
            to { opacity: 1; transform: none; }
        }

        @keyframes sl-up {
            from { opacity: 0; transform: translateY(18px); }
            to { opacity: 1; transform: none; }
        }

        @keyframes sl-pulse {
            0% { box-shadow: 0 0 0 0 rgba(59, 130, 246, .45); }
            100% { box-shadow: 0 0 0 9px rgba(59, 130, 246, 0); }
        }

        @keyframes sl-shake {
            0%, 100% { transform: translateX(0); }
            20% { transform: translateX(-6px); }
            40% { transform: translateX(6px); }
            60% { transform: translateX(-4px); }
            80% { transform: translateX(4px); }
        }

        /* Responsif */
        @media (max-width: 991.98px) {
            .sl-page {
                grid-template-columns: 1fr;
            }

            .sl-visual {
                display: none;
            }

            .sl-mobile-brand {
                display: inline-flex;
            }
        }

        @media (max-width: 575.98px) {
            .sl-form-side {
                padding: 24px 16px;
            }

            .sl-card {
                padding: 34px 24px;
                border-radius: 22px;
            }

            .sl-card h1 {
                font-size: 25px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .sl-visual,
            .sl-blob,
            .sl-ring,
            .sl-card,
            .sl-in,
            .sl-eyebrow::before,
            .sl-card .alert-danger {
                animation: none !important;
            }

            .sl-submit,
            .sl-submit::before,
            .sl-submit .sl-arrow {
                transition: none;
            }
        }
    </style>
</head>
<body>

    <div class="sl-page">

        {{-- PANEL KIRI --}}
        <aside class="sl-visual">
            <span class="sl-blob b1"></span>
            <span class="sl-blob b2"></span>
            <span class="sl-blob b3"></span>
            <span class="sl-ring"></span>

            <a href="{{ route('home') }}" class="sl-brand sl-in">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Solusi Admin">
                <span>Solusi <b>Admin</b></span>
            </a>

            <div class="sl-visual-body">
                <h2 class="sl-in sl-d2">
                    Kelola semua konten <span>dalam satu tempat.</span>
                </h2>

                <p class="sl-in sl-d3">
                    Perbarui layanan, artikel, galeri, dan informasi perusahaan
                    dengan cepat dan aman dari satu dashboard.
                </p>

                <ul class="sl-points">
                    <li class="sl-in sl-d4">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                        Pengelolaan konten yang praktis
                    </li>
                    <li class="sl-in sl-d5">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                        Akses khusus pengelola
                    </li>
                    <li class="sl-in sl-d6">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                        Perubahan langsung tampil di website
                    </li>
                </ul>
            </div>

            <div class="sl-visual-foot sl-in sl-d6">
                &copy; {{ date('Y') }} Solusi Admin. Semua hak dilindungi.
            </div>
        </aside>

        {{-- PANEL KANAN --}}
        <main class="sl-form-side">
            <div class="sl-card">

                <a href="{{ route('home') }}" class="sl-mobile-brand sl-in">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Solusi Admin">
                    <span>Solusi <b>Admin</b></span>
                </a>

                <span class="sl-eyebrow sl-in sl-d1">AREA PENGELOLA</span>

                <h1 class="sl-in sl-d2">
                    Selamat datang <span>kembali.</span>
                </h1>

                <p class="sl-sub sl-in sl-d3">
                    Masuk untuk mengelola konten website perusahaan.
                </p>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.submit') }}" id="loginForm">
                    @csrf

                    <div class="mb-3 sl-in sl-d4">
                        <label for="email" class="form-label">
                            Email admin
                        </label>

                        <div class="sl-field">
                            <svg class="sl-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>

                            <input
                                id="email"
                                class="form-control"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="admin@perusahaan.com"
                            >
                        </div>
                    </div>

                    <div class="mb-3 sl-in sl-d5">
                        <label for="password" class="form-label">
                            Password
                        </label>

                        <div class="sl-field has-toggle">
                            <svg class="sl-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="11" width="16" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/></svg>

                            <input
                                id="password"
                                class="form-control"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Masukkan password"
                            >

                            <button
                                type="button"
                                class="sl-toggle"
                                id="togglePassword"
                                aria-label="Tampilkan password"
                            >
                                <svg class="eye" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg>
                                <svg class="eye-off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.9 17.9A10.7 10.7 0 0 1 12 19c-6.4 0-10-7-10-7a18 18 0 0 1 4.1-4.9M9.9 5.2A9.7 9.7 0 0 1 12 5c6.4 0 10 7 10 7a18 18 0 0 1-2.2 3.2M1 1l22 22"/><path d="M9.9 9.9a3 3 0 0 0 4.2 4.2"/></svg>
                            </button>
                        </div>
                    </div>

                    <button
                        class="sl-submit sl-in sl-d6"
                        type="submit"
                        id="loginSubmit"
                    >
                        <span class="sl-spinner"></span>
                        <span class="sl-label">Masuk ke dashboard</span>
                        <span class="sl-arrow">→</span>
                    </button>
                </form>

                <p class="sl-back sl-in sl-d6">
                    Kembali ke
                    <a href="{{ route('home') }}">website publik</a>.
                </p>

            </div>
        </main>

    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('loginForm');
        var submit = document.getElementById('loginSubmit');
        var password = document.getElementById('password');
        var toggle = document.getElementById('togglePassword');

        // Tampilkan / sembunyikan password
        toggle.addEventListener('click', function () {
            var show = password.type === 'password';

            password.type = show ? 'text' : 'password';
            toggle.classList.toggle('is-shown', show);
            toggle.setAttribute(
                'aria-label',
                show ? 'Sembunyikan password' : 'Tampilkan password'
            );
        });

        // Status loading saat form dikirim
        form.addEventListener('submit', function () {
            if (!form.checkValidity()) return;

            submit.classList.add('is-loading');
            submit.querySelector('.sl-label').textContent = 'Memproses...';
        });

        // Reset tombol bila halaman dipulihkan dari cache browser (tombol Back)
        window.addEventListener('pageshow', function (event) {
            if (event.persisted) {
                submit.classList.remove('is-loading');
                submit.querySelector('.sl-label').textContent = 'Masuk ke dashboard';
            }
        });
    });
    </script>

</body>
</html>