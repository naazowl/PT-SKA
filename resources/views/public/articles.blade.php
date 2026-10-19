@extends('layouts.public')

@section('title', 'Artikel & Informasi')

@section('content')

<style>
    .articles-page {
        overflow: hidden;
        background: #fff;
    }

    .articles-hero {
        position: relative;
        overflow: hidden;
        padding: 100px 0 85px;
        background:
            radial-gradient(ellipse at 85% 15%, rgba(96, 165, 250, .18), transparent 34%),
            radial-gradient(ellipse at 10% 90%, rgba(191, 219, 254, .30), transparent 35%),
            linear-gradient(135deg, #f8fbff 0%, #eef5ff 52%, #fff 100%);
        border-bottom: 1px solid #eaf0f8;
    }

    .articles-hero::before,
    .articles-hero::after {
        position: absolute;
        border: 1px solid rgba(37, 99, 235, .12);
        border-radius: 50%;
        content: "";
        pointer-events: none;
    }

    .articles-hero::before {
        top: -130px;
        right: -100px;
        width: 360px;
        height: 360px;
    }

    .articles-hero::after {
        top: -70px;
        right: -40px;
        width: 240px;
        height: 240px;
    }

    .articles-hero .container {
        position: relative;
        z-index: 1;
    }

    .articles-eyebrow {
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

    .articles-eyebrow::before {
        width: 7px;
        height: 7px;
        background: #3b82f6;
        border-radius: 50%;
        content: "";
        box-shadow: 0 0 0 4px rgba(59, 130, 246, .12);
    }

    .articles-hero h1 {
        max-width: 850px;
        color: #14213d;
        font-size: clamp(2.5rem, 5vw, 4.2rem);
        line-height: 1.13;
        letter-spacing: -2px;
    }

    .articles-gradient-text {
        color: #2563eb;
        background: linear-gradient(100deg, #2563eb, #06b6d4);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .articles-hero-description {
        max-width: 610px;
        color: #64748b;
        font-size: 17px;
        line-height: 1.9;
    }

    .articles-list-section {
        padding-top: 65px;
        padding-bottom: 90px;
    }

    .articles-section-heading {
        margin-bottom: 30px;
    }

    .articles-section-heading h2 {
        margin-bottom: 8px;
        color: #172554;
        font-size: clamp(23px, 3vw, 30px);
        font-weight: 800;
        letter-spacing: -.8px;
    }

    .articles-section-heading p {
        margin-bottom: 0;
        color: #64748b;
        font-size: 14px;
        line-height: 1.8;
    }

    .articles-card {
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

    .articles-card:hover {
        transform: translateY(-7px);
        border-color: #bfdbfe;
        box-shadow: 0 20px 45px rgba(37, 99, 235, .11);
    }

    .articles-card-image {
        position: relative;
        height: 220px;
        overflow: hidden;
        background: linear-gradient(135deg, #eff6ff, #e0f2fe);
        border-radius: 15px;
    }

    .articles-card-image img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform .5s ease;
    }

    .articles-card:hover .articles-card-image img {
        transform: scale(1.055);
    }

    .articles-image-placeholder {
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

    .articles-image-placeholder i {
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

    .articles-card:hover .articles-image-placeholder i {
        transform: rotate(-8deg) scale(1.08);
    }

    .articles-image-placeholder span {
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .articles-card-body {
        display: flex;
        flex: 1;
        flex-direction: column;
        padding: 22px 12px 14px;
    }

    .articles-category {
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

    .articles-card-date {
        margin-top: 13px;
        color: #94a3b8;
        font-size: 11px;
        font-weight: 600;
    }

    .articles-card-title {
        margin: 10px 0;
        color: #172554;
        font-size: 21px;
        font-weight: 800;
        line-height: 1.4;
        letter-spacing: -.4px;
        overflow-wrap: anywhere;
    }

    .articles-card-description {
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

    .articles-card-link {
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

    .articles-card-link:hover {
        color: #1d4ed8;
        background: transparent;
        box-shadow: none;
        text-decoration: none;
    }

    .articles-empty {
        padding: 55px 20px;
        background: #f8fbff;
        border: 1px dashed #cbd5e1;
        border-radius: 20px;
        text-align: center;
    }

    .articles-empty-icon {
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

    .articles-empty h3 {
        color: #172554;
        font-size: 20px;
        font-weight: 800;
    }

    .articles-empty p {
        margin-bottom: 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.8;
    }

    /* ===== Pagination (rapi, tengah, keterangan di bawah) ===== */
    .articles-pagination {
        display: flex;
        justify-content: center;
        margin-top: 44px;
    }

    .articles-pagination nav {
        display: flex !important;
        flex-direction: column;
        align-items: center;
        justify-content: center !important;
        width: 100%;
        max-width: 100%;
    }

    .articles-pagination nav > div {
        width: 100%;
    }

    /* Tampilan desktop: nomor halaman di atas, keterangan "Showing" di bawah */
    .articles-pagination nav > div.d-sm-flex {
        flex-direction: column;
        align-items: center !important;
        justify-content: center !important;
        gap: 16px;
    }

    .articles-pagination nav > div.d-sm-flex > div:first-child {
        order: 2;
    }

    .articles-pagination nav > div.d-sm-flex > div:last-child {
        order: 1;
    }

    /* Tampilan HP: tombol sebelumnya / berikutnya */
    .articles-pagination nav > div.d-sm-none {
        justify-content: center !important;
    }

    .articles-pagination nav p.small {
        margin: 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.6;
        text-align: center;
    }

    .articles-pagination nav p.small .fw-semibold {
        color: #172554;
        font-weight: 700 !important;
    }

    .articles-pagination .pagination {
        flex-wrap: wrap;
        justify-content: center;
        gap: 6px;
        margin: 0;
    }

    .articles-pagination .page-item .page-link {
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

    .articles-pagination .page-item:not(.active):not(.disabled) .page-link:hover {
        color: #1d4ed8;
        background: #eff6ff;
        border-color: #bfdbfe;
        transform: translateY(-2px);
    }

    .articles-pagination .page-item.active .page-link {
        color: #fff;
        background: #2563eb;
        border-color: #2563eb;
        box-shadow: 0 8px 18px rgba(37, 99, 235, .25);
    }

    .articles-pagination .page-item.disabled .page-link {
        color: #94a3b8;
        background: #f8fafc;
        border-color: #e2e8f0;
    }

    @media (max-width: 767.98px) {
        .articles-hero {
            padding: 75px 0 65px;
        }

        .articles-hero h1 {
            letter-spacing: -1.3px;
        }

        .articles-hero-description {
            font-size: 15px;
        }

        .articles-list-section {
            padding-top: 45px;
            padding-bottom: 60px;
        }

        .articles-card-image {
            height: 210px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .articles-card,
        .articles-card-image img,
        .articles-image-placeholder i,
        .articles-pagination .page-link {
            transition: none;
        }

        .articles-card:hover,
        .articles-card:hover .articles-card-image img,
        .articles-card:hover .articles-image-placeholder i,
        .articles-pagination .page-item:not(.active):not(.disabled) .page-link:hover {
            transform: none;
        }
    }
</style>

<div class="articles-page">

    <section class="articles-hero">
        <div class="container">
            <span class="articles-eyebrow smart-reveal">WAWASAN TERKINI</span>

            <h1 class="fw-bold mt-4">
                Cerita, ide, dan<br>
                <span class="articles-gradient-text">perspektif.</span>
            </h1>

            <p class="articles-hero-description mt-4 mb-0 smart-reveal smart-delay-2">
                Temukan insight seputar teknologi dan perkembangan bisnis.
                Dapatkan perspektif baru untuk mendukung langkah dan keputusan bisnis Anda.
            </p>
        </div>
    </section>

    <section class="container articles-list-section">
        <div class="articles-section-heading">
            <h2>Artikel &amp; Informasi</h2>
            <p class="smart-reveal smart-delay-1">
                Jelajahi wawasan dan informasi terbaru dari kami.
            </p>
        </div>

        <div class="row g-4">
            @forelse($articles as $a)
                <div class="col-md-6 col-lg-4">
                    <article class="articles-card smart-reveal smart-delay-{{ ($loop->index % 3) + 1 }}">

                        <div class="articles-card-image">
                            @if(!empty($a->image))
                                <img
                                    src="{{ asset('storage/' . ltrim($a->image, '/')) }}"
                                    alt="{{ $a->title }}"
                                    loading="lazy"
                                >
                            @else
                                <div class="articles-image-placeholder">
                                    <i class="bi bi-journal-text"></i>
                                    <span>Insight & Informasi</span>
                                </div>
                            @endif
                        </div>

                        <div class="articles-card-body">
                            <span class="articles-category">ARTIKEL &amp; INFORMASI</span>

                            <small class="articles-card-date">
                                {{ optional($a->published_at)->format('d M Y') ?? $a->created_at->format('d M Y') }}
                            </small>

                            <h3 class="articles-card-title">
                                {{ $a->title }}
                            </h3>

                            <p class="articles-card-description">
                                {{ $a->excerpt }}
                            </p>

                            <a
                                href="{{ route('articles.show', $a) }}"
                                class="articles-card-link"
                            >
                                <span>Baca artikel →</span>
                            </a>
                        </div>

                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="articles-empty smart-reveal">
                        <div class="articles-empty-icon">
                            <i class="bi bi-journal-text"></i>
                        </div>

                        <h3>Artikel segera hadir</h3>

                        <p>
                            Saat ini belum ada artikel yang dipublikasikan.
                            Silakan kunjungi kembali untuk melihat informasi terbaru.
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

        @if(method_exists($articles, 'hasPages') && $articles->hasPages())
            <div class="articles-pagination smart-reveal">
                {{ $articles->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </section>

</div>

@endsection