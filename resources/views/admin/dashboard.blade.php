@extends('layouts.admin')

@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('content')

<style>
    /* =====================================================
       ANIMASI DASHBOARD ADMIN
       (berdiri sendiri, tidak bergantung pada file JS lain)
       ===================================================== */
    @keyframes dash-up {
        from { opacity: 0; transform: translateY(22px); }
        to   { opacity: 1; transform: none; }
    }

    @keyframes dash-fade {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    @keyframes dash-pop {
        from { opacity: 0; transform: scale(.6) rotate(-12deg); }
        to   { opacity: 1; transform: none; }
    }

    @keyframes dash-float {
        0%, 100% { transform: translateY(0); }
        50%      { transform: translateY(-4px); }
    }

    @keyframes dash-row {
        from { opacity: 0; transform: translateX(-14px); }
        to   { opacity: 1; transform: none; }
    }

    @keyframes dash-shine {
        from { left: -80%; }
        to   { left: 140%; }
    }

    .dash-in {
        opacity: 0;
        animation: dash-up .7s cubic-bezier(.2, .8, .2, 1) forwards;
    }

    .dash-d1 { animation-delay: .05s; }
    .dash-d2 { animation-delay: .15s; }
    .dash-d3 { animation-delay: .25s; }
    .dash-d4 { animation-delay: .35s; }
    .dash-d5 { animation-delay: .45s; }

    /* Kartu statistik */
    .dash-stat {
        position: relative;
        overflow: hidden;
        transition: transform .28s ease, box-shadow .28s ease, border-color .28s ease;
    }

    .dash-stat::before {
        position: absolute;
        top: 0;
        left: -80%;
        width: 50%;
        height: 100%;
        background: linear-gradient(100deg, transparent, rgba(96, 165, 250, .14), transparent);
        content: "";
        transform: skewX(-20deg);
        pointer-events: none;
    }

    .dash-stat:hover {
        transform: translateY(-6px);
        border-color: #bfdbfe;
        box-shadow: 0 20px 42px rgba(37, 99, 235, .12);
    }

    .dash-stat:hover::before {
        animation: dash-shine .9s ease;
    }

    .dash-stat .stat-icon {
        opacity: 0;
        animation: dash-pop .6s cubic-bezier(.2, .8, .2, 1) .35s forwards,
                   dash-float 4s ease-in-out 1.2s infinite;
        transition: transform .3s ease;
    }

    .dash-stat:hover .stat-icon {
        animation-play-state: running, paused;
        transform: rotate(-8deg) scale(1.1);
    }

    .dash-stat h2 {
        font-variant-numeric: tabular-nums;
    }

    .dash-stat a i {
        display: inline-block;
        transition: transform .2s ease;
    }

    .dash-stat a:hover i {
        transform: translateX(5px);
    }

    /* Tombol di header dan panel */
    .admin-heading .btn,
    .dash-panel .btn {
        transition: transform .2s ease, box-shadow .2s ease,
            background .2s ease, color .2s ease, border-color .2s ease;
    }

    .admin-heading .btn:hover,
    .dash-panel .btn:hover {
        transform: translateY(-2px);
    }

    .admin-heading .btn i.bi-box-arrow-up-right {
        display: inline-block;
        transition: transform .2s ease;
    }

    .admin-heading .btn:hover i.bi-box-arrow-up-right {
        transform: translate(2px, -2px);
    }

    /* Panel tabel */
    .dash-panel .bi-clock-history {
        display: inline-block;
        animation: dash-fade .6s ease .6s both;
    }

    .dash-panel .btn i.bi-arrow-right {
        display: inline-block;
        transition: transform .2s ease;
    }

    .dash-panel .btn:hover i.bi-arrow-right {
        transform: translateX(4px);
    }

    /* Baris tabel muncul bergantian */
    .dash-panel tbody tr {
        opacity: 0;
        animation: dash-row .55s cubic-bezier(.2, .8, .2, 1) forwards;
        transition: background .2s ease;
    }

    .dash-panel tbody tr:nth-child(1) { animation-delay: .55s; }
    .dash-panel tbody tr:nth-child(2) { animation-delay: .65s; }
    .dash-panel tbody tr:nth-child(3) { animation-delay: .75s; }
    .dash-panel tbody tr:nth-child(4) { animation-delay: .85s; }
    .dash-panel tbody tr:nth-child(n+5) { animation-delay: .95s; }

    .dash-panel tbody tr:hover > * {
        background: #f8fbff;
    }

    .dash-panel .badge {
        transition: transform .2s ease;
    }

    .dash-panel tbody tr:hover .badge {
        transform: scale(1.06);
    }

    .dash-panel .bi-inbox {
        display: inline-block;
        animation: dash-float 3.5s ease-in-out infinite;
    }

    @media (prefers-reduced-motion: reduce) {
        .dash-in,
        .dash-stat .stat-icon,
        .dash-panel tbody tr,
        .dash-panel .bi-clock-history,
        .dash-panel .bi-inbox {
            opacity: 1;
            animation: none !important;
        }

        .dash-stat,
        .dash-stat .stat-icon,
        .dash-stat a i,
        .admin-heading .btn,
        .dash-panel .btn,
        .dash-panel .badge {
            transition: none;
        }

        .dash-stat:hover,
        .dash-stat:hover .stat-icon,
        .dash-stat a:hover i,
        .admin-heading .btn:hover,
        .dash-panel .btn:hover,
        .dash-panel tbody tr:hover .badge {
            transform: none;
        }
    }
</style>

<div class="admin-heading dash-in dash-d1">
    <div>
        <h1>Dashboard</h1>
        <p>Ringkasan konten PT Koneksi Solusi Anda.</p>
    </div>

    <a href="{{ route('home') }}"
       target="_blank"
       class="btn btn-outline-primary px-3 py-2">
        <i class="bi bi-box-arrow-up-right me-2"></i>
        Lihat website
    </a>
</div>

{{-- Kartu statistik --}}
<div class="row g-4 mb-4">

    {{-- Produk dan layanan --}}
    <div class="col-md-4">
        <div class="panel dash-stat dash-in dash-d2 h-100 p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <span class="text-secondary small fw-semibold">
                        PRODUK & LAYANAN
                    </span>

                    <h2 class="fw-bold mb-0 mt-2" data-count>
                        {{ $products }}
                    </h2>
                </div>

                <div class="stat-icon">
                    <i class="bi bi-box-seam"></i>
                </div>
            </div>

            <p class="text-secondary small mb-3">
                Jumlah produk dan layanan yang dikelola.
            </p>

            <a href="{{ route('admin.produk.index') }}"
               class="text-decoration-none fw-semibold small">
                Kelola produk
                <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>

    {{-- Artikel dan informasi --}}
    <div class="col-md-4">
        <div class="panel dash-stat dash-in dash-d3 h-100 p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <span class="text-secondary small fw-semibold">
                        ARTIKEL & INFORMASI
                    </span>

                    <h2 class="fw-bold mb-0 mt-2" data-count>
                        {{ $articles }}
                    </h2>
                </div>

                <div class="stat-icon">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
            </div>

            <p class="text-secondary small mb-3">
                Jumlah artikel dan informasi yang dikelola.
            </p>

            <a href="{{ route('admin.artikel.index') }}"
               class="text-decoration-none fw-semibold small">
                Kelola artikel
                <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>

    {{-- Galeri kegiatan --}}
    <div class="col-md-4">
        <div class="panel dash-stat dash-in dash-d4 h-100 p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <span class="text-secondary small fw-semibold">
                        GALERI KEGIATAN
                    </span>

                    <h2 class="fw-bold mb-0 mt-2" data-count>
                        {{ $gallery }}
                    </h2>
                </div>

                <div class="stat-icon">
                    <i class="bi bi-images"></i>
                </div>
            </div>

            <p class="text-secondary small mb-3">
                Jumlah foto kegiatan yang tersimpan.
            </p>

            <a href="{{ route('admin.galeri.index') }}"
               class="text-decoration-none fw-semibold small">
                Kelola galeri
                <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>

</div>

{{-- Produk terbaru --}}
<div class="panel dash-panel dash-in dash-d5 p-4">

    <div class="d-flex flex-wrap justify-content-between
                align-items-center gap-3 mb-4">

        <div>
            <h5 class="fw-bold mb-1">
                <i class="bi bi-clock-history me-2 text-primary"></i>
                Produk terbaru
            </h5>

            <p class="text-secondary small mb-0">
                Ringkasan produk dan layanan perusahaan.
            </p>
        </div>

        <a href="{{ route('admin.produk.index') }}"
           class="btn btn-outline-primary px-3 py-2">
            Lihat semua
            <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">

            <thead>
                <tr>
                    <th style="min-width: 250px;">Nama produk</th>
                    <th style="min-width: 160px;">Kategori</th>
                    <th style="width: 150px;">Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($recentProducts as $p)
                    <tr>
                        <td class="py-3">
                            <div class="fw-semibold">
                                {{ $p->name }}
                            </div>

                            @if($p->short_description)
                                <div class="small text-secondary mt-1">
                                    {{ $p->short_description }}
                                </div>
                            @endif
                        </td>

                        <td class="py-3">
                            {{ $p->category ?: '—' }}
                        </td>

                        <td class="py-3">
                            @if($p->is_published)
                                <span class="badge rounded-pill text-bg-success px-3 py-2">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Dipublikasikan
                                </span>
                            @else
                                <span class="badge rounded-pill text-bg-secondary px-3 py-2">
                                    <i class="bi bi-pencil-square me-1"></i>
                                    Draft
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3"
                            class="text-center py-5 text-secondary">

                            <div class="mb-3">
                                <i class="bi bi-inbox"
                                   style="font-size: 42px;"></i>
                            </div>

                            <div class="fw-semibold">
                                Belum ada produk
                            </div>

                            <div class="small mt-1">
                                Tambahkan produk atau layanan untuk mulai mengelola konten.
                            </div>

                            <a href="{{ route('admin.produk.create') }}"
                               class="btn btn-primary btn-sm mt-3 px-3 py-2">
                                <i class="bi bi-plus-lg me-1"></i>
                                Tambah produk
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduceMotion) return;

    // Angka statistik naik dari 0
    document.querySelectorAll('[data-count]').forEach(function (el) {
        var target = parseInt(el.textContent.replace(/\D/g, ''), 10);
        if (isNaN(target) || target <= 0) return;

        var original = el.textContent.trim();
        var duration = 1300;
        var start = null;

        el.textContent = '0';

        function step(ts) {
            if (start === null) start = ts;

            var p = Math.min((ts - start) / duration, 1);
            var eased = 1 - Math.pow(1 - p, 3);

            el.textContent = Math.round(target * eased);

            if (p < 1) {
                requestAnimationFrame(step);
            } else {
                el.textContent = original;
            }
        }

        setTimeout(function () {
            requestAnimationFrame(step);
        }, 450);
    });
});
</script>

@endsection