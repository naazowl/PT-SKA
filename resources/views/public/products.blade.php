@extends('layouts.public')

@section('title', 'Produk & Layanan')

@section('content')

<style>
    .products-page {
        overflow: hidden;
        background: #fff;
    }

    .products-hero {
        position: relative;
        overflow: hidden;
        padding: 100px 0 85px;
        background:
            radial-gradient(ellipse at 85% 15%, rgba(96, 165, 250, .18), transparent 34%),
            radial-gradient(ellipse at 10% 90%, rgba(191, 219, 254, .30), transparent 35%),
            linear-gradient(135deg, #f8fbff 0%, #eef5ff 52%, #fff 100%);
        border-bottom: 1px solid #eaf0f8;
    }

    .products-hero::before,
    .products-hero::after {
        position: absolute;
        border: 1px solid rgba(37, 99, 235, .12);
        border-radius: 50%;
        content: "";
        pointer-events: none;
    }

    .products-hero::before {
        top: -130px;
        right: -100px;
        width: 360px;
        height: 360px;
    }

    .products-hero::after {
        top: -70px;
        right: -40px;
        width: 240px;
        height: 240px;
    }

    .products-hero .container {
        position: relative;
        z-index: 1;
    }

    .products-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 9px 15px;
        color: #1d4ed8;
        background: rgba(255, 255, 255, .8);
        border: 1px solid #dbeafe;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.6px;
    }

    .products-eyebrow::before {
        width: 7px;
        height: 7px;
        background: #3b82f6;
        border-radius: 50%;
        content: "";
        box-shadow: 0 0 0 4px rgba(59, 130, 246, .12);
    }

    .products-hero h1 {
        max-width: 850px;
        color: #14213d;
        font-size: clamp(2.5rem, 5vw, 4.2rem);
        line-height: 1.13;
        letter-spacing: -2px;
    }

    .products-gradient-text {
        color: #2563eb;
        background: linear-gradient(100deg, #2563eb, #06b6d4);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .products-hero-description {
        max-width: 610px;
        color: #64748b;
        font-size: 17px;
        line-height: 1.9;
    }

    .products-hero-note {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        margin-top: 24px;
        color: #475569;
        font-size: 12px;
        font-weight: 600;
    }

    .products-hero-note i {
        color: #2563eb;
        font-size: 17px;
    }

    .products-list-section {
        padding-top: 65px;
        padding-bottom: 90px;
    }

    .products-section-heading {
        margin-bottom: 30px;
    }

    .products-section-heading h2 {
        margin-bottom: 8px;
        color: #172554;
        font-size: clamp(23px, 3vw, 30px);
        font-weight: 800;
        letter-spacing: -.8px;
    }

    .products-section-heading p {
        margin-bottom: 0;
        color: #64748b;
        font-size: 14px;
        line-height: 1.8;
    }

    .products-card {
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
        padding: 12px;
        overflow: hidden;
        background: #fff;
        border: 1px solid #e7edf5;
        border-radius: 22px;
        box-shadow: 0 8px 28px rgba(15, 23, 42, .035);
        transition: transform .28s ease, box-shadow .28s ease, border-color .28s ease;
    }

    .products-card:hover {
        transform: translateY(-7px);
        border-color: #bfdbfe;
        box-shadow: 0 20px 45px rgba(37, 99, 235, .11);
    }

    .products-card-image {
        position: relative;
        height: 220px;
        overflow: hidden;
        background: linear-gradient(135deg, #eff6ff, #e0f2fe);
        border-radius: 15px;
    }

    .products-card-image img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform .5s ease;
    }

    .products-card:hover .products-card-image img {
        transform: scale(1.055);
    }

    .products-image-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 12px;
        width: 100%;
        height: 100%;
        color: #2563eb;
        background:
            radial-gradient(circle at 80% 20%, rgba(96, 165, 250, .24), transparent 32%),
            linear-gradient(135deg, #eff6ff, #dbeafe);
    }

    .products-image-placeholder i {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 76px;
        height: 76px;
        background: rgba(255, 255, 255, .85);
        border: 1px solid rgba(255, 255, 255, .9);
        border-radius: 23px;
        font-size: 36px;
        box-shadow: 0 10px 28px rgba(37, 99, 235, .10);
        transition: transform .35s ease;
    }

    .products-card:hover .products-image-placeholder i {
        transform: rotate(-8deg) scale(1.08);
    }

    .products-image-placeholder span {
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .products-card-body {
        display: flex;
        flex: 1;
        flex-direction: column;
        padding: 22px 12px 14px;
    }

    .products-category {
        display: inline-flex;
        align-self: flex-start;
        max-width: 100%;
        padding: 7px 11px;
        overflow: hidden;
        color: #1d4ed8;
        background: #eff6ff;
        border: 1px solid #dbeafe;
        border-radius: 8px;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .5px;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .products-card-title {
        margin: 16px 0 10px;
        color: #172554;
        font-size: 21px;
        font-weight: 800;
        line-height: 1.4;
        letter-spacing: -.4px;
        overflow-wrap: anywhere;
    }

    .products-card-description {
        display: -webkit-box;
        min-height: 66px;
        margin-bottom: 22px;
        overflow: hidden;
        color: #64748b;
        font-size: 13px;
        line-height: 1.8;
        overflow-wrap: anywhere;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
    }

    /* Link layanan tanpa kotak ikon */

    .products-card .products-card-link {
        display: inline-flex;
        align-items: center;
        align-self: flex-start;
        gap: 6px;
        width: 100%;
        padding: 16px 0 0;
        margin-top: auto;
        color: #2563eb;
        border: none;
        border-top: 1px solid #edf2f8;
        border-radius: 0;
        outline: none;
        background: transparent;
        box-shadow: none;
        font-size: 13px;
        font-weight: 600;
        line-height: 1.5;
        text-decoration: none;
        transition: color .2s ease;
    }

    .products-card .products-card-link span {
        display: inline;
        padding: 0;
        margin: 0;
        border: none;
        border-radius: 0;
        background: transparent;
        box-shadow: none;
        color: inherit;
    }

    .products-card .products-card-link i {
        display: none !important;
    }

    .products-card .products-card-link::before,
    .products-card .products-card-link::after {
        content: none !important;
        display: none !important;
    }

    .products-card .products-card-link:hover {
        color: #1d4ed8;
        background: transparent;
        box-shadow: none;
        text-decoration: none;
    }

    .products-empty {
        padding: 55px 20px;
        background: #f8fbff;
        border: 1px dashed #cbd5e1;
        border-radius: 20px;
        text-align: center;
    }

    .products-empty-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 65px;
        height: 65px;
        margin: 0 auto 18px;
        color: #2563eb;
        background: #eff6ff;
        border-radius: 20px;
        font-size: 28px;
    }

    .products-empty h3 {
        color: #172554;
        font-size: 20px;
        font-weight: 800;
    }

    .products-empty p {
        margin-bottom: 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.8;
    }

    /* ===== Pagination (rapi, tengah, keterangan di bawah) ===== */
    .products-pagination {
        display: flex;
        justify-content: center;
        margin-top: 44px;
    }

    .products-pagination nav {
        display: flex !important;
        flex-direction: column;
        align-items: center;
        justify-content: center !important;
        width: 100%;
        max-width: 100%;
    }

    .products-pagination nav > div {
        width: 100%;
    }

    /* Tampilan desktop: nomor halaman di atas, keterangan "Showing" di bawah */
    .products-pagination nav > div.d-sm-flex {
        flex-direction: column;
        align-items: center !important;
        justify-content: center !important;
        gap: 16px;
    }

    .products-pagination nav > div.d-sm-flex > div:first-child {
        order: 2;
    }

    .products-pagination nav > div.d-sm-flex > div:last-child {
        order: 1;
    }

    /* Tampilan HP: tombol sebelumnya / berikutnya */
    .products-pagination nav > div.d-sm-none {
        justify-content: center !important;
    }

    .products-pagination nav p.small {
        margin: 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.6;
        text-align: center;
    }

    .products-pagination nav p.small .fw-semibold {
        color: #172554;
        font-weight: 700 !important;
    }

    .products-pagination .pagination {
        flex-wrap: wrap;
        justify-content: center;
        gap: 6px;
        margin: 0;
    }

    .products-pagination .page-item .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 42px;
        min-height: 42px;
        margin-left: 0 !important;
        padding: 9px 14px;
        color: #2563eb;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 999px !important;
        font-size: 13px;
        font-weight: 700;
        box-shadow: none;
        transition: background .2s ease, color .2s ease, border-color .2s ease, transform .2s ease;
    }

    .products-pagination .page-item:not(.active):not(.disabled) .page-link:hover {
        color: #1d4ed8;
        background: #eff6ff;
        border-color: #bfdbfe;
        transform: translateY(-2px);
    }

    .products-pagination .page-item.active .page-link {
        color: #fff;
        background: #2563eb;
        border-color: #2563eb;
        box-shadow: 0 8px 18px rgba(37, 99, 235, .25);
    }

    .products-pagination .page-item.disabled .page-link {
        color: #94a3b8;
        background: #f8fafc;
        border-color: #e2e8f0;
    }

    @media (max-width: 767.98px) {
        .products-hero {
            padding: 75px 0 65px;
        }

        .products-hero h1 {
            letter-spacing: -1.3px;
        }

        .products-hero-description {
            font-size: 15px;
        }

        .products-list-section {
            padding-top: 45px;
            padding-bottom: 60px;
        }

        .products-card-image {
            height: 210px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .products-card,
        .products-card-image img,
        .products-image-placeholder i,
        .products-pagination .page-link {
            transition: none;
        }

        .products-card:hover,
        .products-card:hover .products-card-image img,
        .products-card:hover .products-image-placeholder i,
        .products-pagination .page-item:not(.active):not(.disabled) .page-link:hover {
            transform: none;
        }
    }
</style>

<div class="products-page">

    <section class="products-hero">
        <div class="container">
            <span class="products-eyebrow smart-reveal">SOLUSI KAMI</span>

            <h1 class="fw-bold mt-4">
                Layanan untuk langkah<br>
                <span class="products-gradient-text">bisnis berikutnya.</span>
            </h1>

            <p class="products-hero-description mt-4 mb-0 smart-reveal smart-delay-2">
                Solusi digital yang dirancang sesuai kebutuhan nyata bisnis Anda.
                Kami membantu menghadirkan pendekatan yang relevan untuk mendukung
                perkembangan dan tujuan bisnis Anda.
            </p>

            <div class="products-hero-note smart-reveal smart-delay-3">
                <i class="bi bi-check-circle-fill"></i>
                <span>Solusi relevan. Pendekatan profesional.</span>
            </div>
        </div>
    </section>

    <section class="container products-list-section">
        <div class="products-section-heading">
            <h2>Jelajahi Produk &amp; Layanan</h2>
            <p class="smart-reveal smart-delay-1">
                Temukan layanan yang sesuai dengan kebutuhan dan rencana bisnis Anda.
            </p>
        </div>

        <div class="row g-4">
            @forelse($products as $p)
                <div class="col-md-6 col-lg-4">
                    <article class="products-card smart-reveal smart-delay-{{ ($loop->index % 3) + 1 }}">

                        <div class="products-card-image">
                            @if($p->image)
                                <img
                                    src="{{ asset('storage/' . ltrim($p->image, '/')) }}"
                                    alt="{{ $p->name }}"
                                    loading="lazy"
                                >
                            @else
                                <div class="products-image-placeholder">
                                    <i class="bi bi-grid-1x2"></i>
                                    <span>Solusi Digital</span>
                                </div>
                            @endif
                        </div>

                        <div class="products-card-body">
                            <span class="products-category">
                                {{ $p->category ?: 'Solusi digital' }}
                            </span>

                            <h3 class="products-card-title">
                                {{ $p->name }}
                            </h3>

                            <p class="products-card-description">
                                {{ $p->short_description }}
                            </p>

                            <a
                                href="{{ route('products.show', $p) }}"
                                class="products-card-link"
                            >
                                <span>Pelajari layanan →</span>
                            </a>
                        </div>

                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="products-empty smart-reveal">
                        <div class="products-empty-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>

                        <h3>Produk dan layanan segera hadir</h3>

                        <p>
                            Saat ini belum ada layanan yang dipublikasikan.
                            Silakan kunjungi kembali untuk melihat pembaruan terbaru.
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

        @if(method_exists($products, 'hasPages') && $products->hasPages())
            <div class="products-pagination smart-reveal">
                {{ $products->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </section>

</div>

@endsection