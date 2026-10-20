@extends('layouts.public')

@section('title', 'Beranda | ' . $company->company_name)

@section('content')

<style>
    /* =====================================================
       HERO
       ===================================================== */
    section.hero {
        position: relative;
        overflow: hidden;
        padding: 100px 0 85px;
        background:
            radial-gradient(ellipse at 85% 15%, rgba(96, 165, 250, .18), transparent 34%),
            radial-gradient(ellipse at 10% 90%, rgba(191, 219, 254, .30), transparent 35%),
            linear-gradient(135deg, #f8fbff 0%, #eef5ff 52%, #fff 100%);
        border-bottom: 1px solid #eaf0f8;
    }

    section.hero::before,
    section.hero::after {
        position: absolute;
        border: 1px solid rgba(37, 99, 235, .12);
        border-radius: 50%;
        content: "";
        pointer-events: none;
    }

    section.hero::before {
        top: -130px;
        right: -100px;
        width: 360px;
        height: 360px;
    }

    section.hero::after {
        top: -70px;
        right: -40px;
        width: 240px;
        height: 240px;
    }

    section.hero .container {
        position: relative;
        z-index: 1;
    }

    .eyebrow {
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

    .eyebrow .pulse {
        display: inline-block;
        width: 7px;
        height: 7px;
        background: #3b82f6;
        border-radius: 50%;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, .12);
    }

    .eyebrow:not(:has(.pulse))::before {
        width: 7px;
        height: 7px;
        background: #3b82f6;
        border-radius: 50%;
        content: "";
        box-shadow: 0 0 0 4px rgba(59, 130, 246, .12);
    }

    section.hero h1 {
        max-width: 850px;
        color: #14213d;
        font-size: clamp(2.5rem, 5vw, 4.2rem);
        line-height: 1.13;
        letter-spacing: -2px;
    }

    .gradient-text {
        color: #2563eb;
        background: linear-gradient(100deg, #2563eb, #06b6d4);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    section.hero .lead {
        max-width: 610px;
        color: #64748b !important;
        font-size: 17px;
        line-height: 1.9;
    }

    section.hero .btn {
        font-size: 13px;
        font-weight: 800;
        transition: background .2s ease, color .2s ease,
            border-color .2s ease, transform .2s ease;
    }

    section.hero .btn-primary {
        background: #2563eb;
        border-color: #2563eb;
        box-shadow: 0 10px 24px rgba(37, 99, 235, .22);
    }

    section.hero .btn-primary:hover {
        background: #1d4ed8;
        border-color: #1d4ed8;
        transform: translateY(-2px);
    }

    section.hero .btn-outline-dark {
        color: #475569;
        background: rgba(255, 255, 255, .85);
        border-color: #e2e8f0;
    }

    section.hero .btn-outline-dark:hover {
        color: #2563eb;
        background: #fff;
        border-color: #bfdbfe;
        transform: translateY(-2px);
    }

    section.hero .hero-stats {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
    }

    section.hero .hero-stats > div {
        display: flex;
        flex-direction: column;
        gap: 2px;
        min-width: 150px;
        padding: 14px 18px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 8px 22px rgba(15, 23, 42, .035);
    }

    section.hero .hero-stats strong {
        color: #14213d;
        font-size: 15px;
        font-weight: 800;
    }

    section.hero .hero-stats span {
        color: #64748b;
        font-size: 12px;
        font-weight: 500;
    }

    section.hero .visual-card {
        background: #fff;
        border: 1px solid #e7edf5;
        border-radius: 24px;
        box-shadow: 0 25px 65px rgba(30, 64, 175, .13);
    }

    section.hero .visual-top {
        display: flex;
        align-items: center;
        gap: 7px;
        padding: 18px 22px;
        border-bottom: 1px solid #edf2f8;
    }

    section.hero .visual-top .dot {
        display: inline-block;
        width: 10px;
        height: 10px;
        background: #dbeafe;
        border-radius: 50%;
    }

    section.hero .visual-content {
        padding: 30px;
    }

    section.hero .visual-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 58px;
        height: 58px;
        margin-bottom: 16px;
        color: #fff;
        background: linear-gradient(120deg, #1d4ed8, #2563eb 58%, #0891b2);
        border-radius: 18px;
        font-size: 26px;
        box-shadow: 0 12px 26px rgba(37, 99, 235, .25);
    }

    section.hero .visual-content h3 {
        color: #14213d;
    }

    section.hero .progress {
        height: 8px;
        background: #eaf1fb;
        border-radius: 999px;
    }

    section.hero .progress-bar {
        background: linear-gradient(100deg, #2563eb, #06b6d4);
        border-radius: 999px;
    }

    section.hero .floating-note {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px;
        margin-top: 24px;
        background: #fff;
        border: 1px solid #e7edf5;
        border-radius: 16px;
        box-shadow: 0 14px 34px rgba(30, 64, 175, .13);
    }

    section.hero .floating-note .note-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        flex-shrink: 0;
        color: #2563eb;
        background: #eff6ff;
        border: 1px solid #dbeafe;
        border-radius: 10px;
    }

    section.hero .floating-note strong {
        display: block;
        color: #14213d;
        font-size: 13px;
    }

    section.hero .floating-note small {
        color: #64748b;
        font-size: 11px;
    }

    /* =====================================================
       SECTION
       ===================================================== */
    section.section-pad {
        padding-top: 80px;
        padding-bottom: 85px;
    }

    .section-heading h2 {
        color: #172554;
        font-size: clamp(1.8rem, 3.4vw, 2.6rem);
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: -.8px;
    }

    .section-heading .eyebrow {
        margin-bottom: 16px;
    }

    .section-heading p {
        color: #64748b;
        font-size: 15px;
        line-height: 1.85;
    }

    .home-cards-section {
        background:
            radial-gradient(circle at 100% 0%, rgba(96, 165, 250, .12), transparent 32%),
            #f8fbff;
        border-top: 1px solid #eaf0f8;
    }

    .home-cards-section a.text-decoration-none {
        color: #2563eb;
        font-size: 14px;
        font-weight: 700;
        transition: color .2s ease;
    }

    .home-cards-section a.text-decoration-none:hover {
        color: #1d4ed8;
    }

    .home-cards-section .btn-outline-primary {
        padding-top: 11px;
        padding-bottom: 11px;
        color: #2563eb;
        background: #fff;
        border-color: #bfdbfe;
        font-size: 13px;
        font-weight: 800;
        transition: background .2s ease, color .2s ease,
            border-color .2s ease, transform .2s ease;
    }

    .home-cards-section .btn-outline-primary:hover {
        color: #fff;
        background: #2563eb;
        border-color: #2563eb;
        transform: translateY(-2px);
    }

    /* =====================================================
       KARTU LAYANAN DAN ARTIKEL
       ===================================================== */
    .home-cards-section .home-service-card,
    .home-cards-section .home-article-card {
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
        transition: transform .28s ease, box-shadow .28s ease,
            border-color .28s ease;
    }

    .home-cards-section .home-service-card:hover,
    .home-cards-section .home-article-card:hover {
        transform: translateY(-7px);
        border-color: #bfdbfe;
        box-shadow: 0 20px 45px rgba(37, 99, 235, .11);
    }

    .home-cards-section .home-card-image {
        position: relative;
        height: 220px;
        flex-shrink: 0;
        overflow: hidden;
        background: linear-gradient(135deg, #eff6ff, #e0f2fe);
        border-radius: 15px;
    }

    .home-cards-section .home-card-image img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform .5s ease;
    }

    .home-cards-section .home-service-card:hover .home-card-image img,
    .home-cards-section .home-article-card:hover .home-card-image img {
        transform: scale(1.055);
    }

    .home-cards-section .home-image-placeholder {
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

    .home-cards-section .home-image-placeholder i {
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
    }

    .home-cards-section .home-image-placeholder span {
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .home-cards-section .home-card-body {
        display: flex;
        flex: 1;
        flex-direction: column;
        min-width: 0;
        padding: 22px 12px 14px;
    }

    .home-cards-section .home-card-category {
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

    .home-cards-section .home-card-date {
        margin-top: 13px;
        color: #94a3b8;
        font-size: 11px;
        font-weight: 600;
    }

    .home-cards-section .home-card-title {
        margin: 16px 0 10px;
        color: #172554;
        font-size: 21px;
        font-weight: 800;
        line-height: 1.4;
        letter-spacing: -.4px;
        overflow-wrap: anywhere;
    }

    .home-cards-section .home-article-card .home-card-title {
        margin-top: 10px;
    }

    .home-cards-section .home-card-description {
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

    .home-cards-section .home-card-link {
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

    .home-cards-section .home-card-link span {
        display: inline;
        padding: 0;
        margin: 0;
        border: none;
        border-radius: 0;
        color: inherit;
        background: transparent;
        box-shadow: none;
    }

    .home-cards-section .home-card-link:hover {
        color: #1d4ed8;
        background: transparent;
        box-shadow: none;
        text-decoration: none;
    }

    /* =====================================================
       PESAN KONTEN KOSONG
       ===================================================== */
    .home-empty-state {
        padding: 38px 24px;
        text-align: center;
        background: rgba(255, 255, 255, .85);
        border: 1px dashed #cbd5e1;
        border-radius: 20px;
    }
    
    .home-empty-state .empty-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 58px;
        height: 58px;
        margin-bottom: 14px;
        color: #2563eb;
        background: #eff6ff;
        border-radius: 18px;
        font-size: 25px;
    }

    .home-empty-state h3 {
        color: #172554;
        font-size: 18px;
        font-weight: 800;
    }

    .home-empty-state p {
        max-width: 480px;
        margin: 0 auto;
        color: #64748b;
        font-size: 13px;
        line-height: 1.8;
    }

    /* =====================================================
       CTA BAND
       ===================================================== */
    section.cta-band {
        padding: 64px 0;
        background:
            radial-gradient(circle at 90% 10%, rgba(255, 255, 255, .14), transparent 30%),
            linear-gradient(120deg, #1d4ed8, #2563eb 58%, #0891b2);
    }

    section.cta-band .eyebrow {
        color: #fff !important;
        background: rgba(255, 255, 255, .16);
        border-color: rgba(255, 255, 255, .3);
    }

    section.cta-band .eyebrow::before {
        background: #fff;
        box-shadow: 0 0 0 4px rgba(255, 255, 255, .18);
    }

    section.cta-band h2 {
        font-weight: 800;
        letter-spacing: -.5px;
    }

    section.cta-band p.text-white-50 {
        color: rgba(255, 255, 255, .82) !important;
    }

    section.cta-band .btn-light {
        color: #1d4ed8;
        background: #fff;
        border: 1px solid rgba(255, 255, 255, .7);
        font-size: 13px;
        font-weight: 800;
        transition: background .2s ease, transform .2s ease;
    }

    section.cta-band .btn-light:hover {
        color: #1d4ed8;
        background: #eff6ff;
        transform: translateY(-2px);
    }

    /* =====================================================
       RESPONSIVE
       ===================================================== */
    @media (max-width: 767.98px) {
        section.hero {
            padding: 75px 0 65px;
        }

        section.hero h1 {
            letter-spacing: -1.3px;
        }

        section.hero .lead {
            font-size: 15px;
        }

        section.hero .hero-stats > div {
            flex: 1 1 100%;
        }

        section.section-pad {
            padding-top: 55px;
            padding-bottom: 60px;
        }

        section.cta-band {
            padding: 48px 0;
        }

        section.cta-band .btn-light {
            width: 100%;
            text-align: center;
        }

        .home-cards-section .home-card-image {
            height: 210px;
        }

        .home-cards-section .home-card-title {
            font-size: 19px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .home-cards-section .home-service-card,
        .home-cards-section .home-article-card,
        .home-cards-section .home-card-image img,
        section.hero .btn,
        section.cta-band .btn-light,
        .home-cards-section .btn-outline-primary {
            transition: none;
        }

        .home-cards-section .home-service-card:hover,
        .home-cards-section .home-article-card:hover,
        .home-cards-section .home-service-card:hover .home-card-image img,
        .home-cards-section .home-article-card:hover .home-card-image img,
        section.hero .btn:hover,
        section.cta-band .btn-light:hover,
        .home-cards-section .btn-outline-primary:hover {
            transform: none;
        }
    }
</style>

{{-- =====================================================
     HERO
     ===================================================== --}}
<section class="hero">
    <div class="container">
        <div class="row align-items-center g-5">
           <div class="col-lg-7 smart-reveal">
                <span class="eyebrow">
                    <span class="pulse"></span>
                    PARTNER DIGITAL UNTUK BISNIS
                </span>

                <h1 class="display-3 fw-bold mt-4">
                    Ide hebat layak punya
                    <span class="gradient-text">solusi digital</span> terbaik.
                </h1>

                <p class="lead text-secondary mt-4 mb-4">
                    {{ $company->tagline }}
                    Kami membantu bisnis bergerak lebih cepat melalui teknologi yang tepat.
                </p>

                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('products') }}"
                       class="btn btn-primary btn-lg rounded-pill px-4">
                        Jelajahi Layanan ↗
                    </a>

                    <a href="{{ route('profile') }}"
                       class="btn btn-outline-dark btn-lg rounded-pill px-4">
                        Kenali Kami
                    </a>
                </div>

                <div class="hero-stats mt-5">
                    <div>
                        <strong>Solusi</strong>
                        <span>Berorientasi hasil</span>
                    </div>
                    <div>
                        <strong>Kolaborasi</strong>
                        <span>Partner jangka panjang</span>
                    </div>
                    <div>
                        <strong>Digital</strong>
                        <span>Siap berkembang</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 smart-reveal smart-delay-2">
                <div class="visual-card">
                    <div class="visual-top">
                        <span class="dot"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                        <span class="ms-auto small text-secondary">
                            Koneksi Workspace
                        </span>
                    </div>

                    <div class="visual-content">
                        <div class="visual-icon">✳</div>
                        <p class="small text-secondary mb-1">YOUR NEXT CHAPTER</p>

                        <h3 class="fw-bold">
                            Build something<br>
                            <span class="text-primary">meaningful.</span>
                        </h3>

                        <div class="progress mt-4">
                            <div class="progress-bar" style="width: 78%"></div>
                        </div>

                        <div class="d-flex justify-content-between small text-secondary mt-2">
                            <span>Digital progress</span>
                            <span>78%</span>
                        </div>

                        <div class="floating-note">
                            <span class="note-icon">↗</span>
                            <div>
                                <strong>Better connections</strong>
                                <small>One step at a time</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- =====================================================
     PRODUK UNGGULAN
     Hanya produk publik yang ditandai sebagai unggulan
     ===================================================== --}}
<section class="section-pad home-cards-section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">APA YANG KAMI LAKUKAN</span>

            <h2>
                Teknologi yang bekerja<br>
                untuk <span class="gradient-text">tujuan Anda.</span>
            </h2>

            <p>
                Temukan layanan unggulan yang membantu bisnis Anda tumbuh
                melalui solusi digital yang tepat.
            </p>
        </div>

        <div class="row g-4 mt-2">
            @forelse($products as $p)
                <div class="col-md-6 col-lg-4">
                    <article class="home-service-card smart-reveal {{ $loop->iteration <= 4 ? 'smart-delay-' . $loop->iteration : '' }}">
                        <div class="home-card-image">
                            @if($p->image)
                                <img
                                    src="{{ asset('storage/' . ltrim($p->image, '/')) }}"
                                    alt="{{ $p->name }}"
                                    loading="lazy"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                >

                                <div class="home-image-placeholder" style="display:none;">
                                    <i class="bi bi-grid-1x2"></i>
                                    <span>Solusi Digital</span>
                                </div>
                            @else
                                <div class="home-image-placeholder">
                                    <i class="bi bi-grid-1x2"></i>
                                    <span>Solusi Digital</span>
                                </div>
                            @endif
                        </div>

                        <div class="home-card-body">
                            <span class="home-card-category">
                                {{ $p->category ?: 'Solusi digital' }}
                            </span>

                            <h3 class="home-card-title">
                                {{ $p->name }}
                            </h3>

                            <p class="home-card-description">
                                {{ $p->short_description ?: 'Hubungi kami untuk mengetahui lebih lanjut tentang layanan ini.' }}
                            </p>

                            <a href="{{ route('products.show', $p) }}"
                               class="home-card-link">
                                <span>Pelajari layanan →</span>
                            </a>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="home-empty-state">
                        <div class="empty-icon">
                            <i class="bi bi-grid-1x2"></i>
                        </div>

                        <h3>Produk unggulan segera hadir</h3>

                        <p>
                            Saat ini belum ada produk yang ditampilkan sebagai unggulan.
                            Silakan kunjungi halaman layanan untuk melihat layanan
                            yang tersedia.
                        </p>

                        <a href="{{ route('products') }}"
                           class="btn btn-outline-primary rounded-pill px-4 mt-3">
                            Lihat semua layanan
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('products') }}"
               class="btn btn-outline-primary rounded-pill px-4">
                Lihat semua layanan
            </a>
        </div>
    </div>
</section>

{{-- =====================================================
     CTA
     ===================================================== --}}
<section class="cta-band smart-reveal">
    <div class="container d-lg-flex align-items-center justify-content-between">
        <div>
            <span class="eyebrow text-white-50">MULAI DARI SINI</span>

            <h2 class="text-white mt-2 mb-2">
                Punya tantangan bisnis?
            </h2>

            <p class="text-white-50 mb-lg-0">
                Mari temukan solusi yang tepat bersama.
            </p>
        </div>

        <a href="{{ route('contact') }}"
           class="btn btn-light rounded-pill px-4 py-3 mt-3 mt-lg-0">
            Diskusikan kebutuhan Anda ↗
        </a>
    </div>
</section>

{{-- =====================================================
     ARTIKEL TERBARU
     ===================================================== --}}
<section class="section-pad home-cards-section">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
            <div class="section-heading mb-0">
                <span class="eyebrow">WAWASAN</span>

                <h2>
                    Ide untuk terus
                    <span class="gradient-text">bertumbuh.</span>
                </h2>
            </div>

            <a href="{{ route('articles') }}"
               class="text-decoration-none">
                Semua artikel →
            </a>
        </div>

        <div class="row g-4">
            @forelse($articles as $a)
                <div class="col-md-6 col-lg-4">
                    <article class="home-article-card smart-reveal {{ $loop->iteration <= 4 ? 'smart-delay-' . $loop->iteration : '' }}">
                        <div class="home-card-image">
                            @if($a->image)
                                <img
                                    src="{{ asset('storage/' . ltrim($a->image, '/')) }}"
                                    alt="{{ $a->title }}"
                                    loading="lazy"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                >

                                <div class="home-image-placeholder" style="display:none;">
                                    <i class="bi bi-journal-text"></i>
                                    <span>Insight &amp; Informasi</span>
                                </div>
                            @else
                                <div class="home-image-placeholder">
                                    <i class="bi bi-journal-text"></i>
                                    <span>Insight &amp; Informasi</span>
                                </div>
                            @endif
                        </div>

                        <div class="home-card-body">
                            <span class="home-card-category">
                                ARTIKEL &amp; INFORMASI
                            </span>

                            <small class="home-card-date">
                                {{ optional($a->published_at)->format('d M Y') ?? $a->created_at->format('d M Y') }}
                            </small>

                            <h3 class="home-card-title">
                                {{ $a->title }}
                            </h3>

                            <p class="home-card-description">
                                {{ $a->excerpt ?: 'Baca artikel ini untuk mendapatkan wawasan lebih lanjut.' }}
                            </p>

                            <a href="{{ route('articles.show', $a) }}"
                               class="home-card-link">
                                <span>Baca artikel →</span>
                            </a>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="home-empty-state">
                        <div class="empty-icon">
                            <i class="bi bi-journal-text"></i>
                        </div>

                        <h3>Belum ada artikel</h3>

                        <p>
                            Artikel terbaru akan muncul di sini setelah dipublikasikan
                            melalui halaman admin.
                        </p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection