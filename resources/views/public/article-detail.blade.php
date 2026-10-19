@extends('layouts.public')

@section('title', $article->title)

@section('content')

@php
    $articleDate = optional($article->published_at)->format('d F Y') ?? $article->created_at->format('d F Y');
    $wordCount = str_word_count(strip_tags((string) $article->content));
    $readingTime = max(1, (int) ceil($wordCount / 200));
    $paragraphs = preg_split('/\R{2,}/', trim((string) $article->content));
    $shareUrl = url()->current();
    $hasCover = !empty($article->image);
@endphp

<style>
    .article-detail-page {
        --article-width: 960px;
        overflow: hidden;
        background: #fff;
    }

    /* ===== Hero ===== */
    .article-detail-hero {
        position: relative;
        overflow: hidden;
        padding: 50px 0 70px;
        background:
            radial-gradient(ellipse at 90% 10%, rgba(96, 165, 250, .18), transparent 35%),
            linear-gradient(145deg, #f8fbff 0%, #eff6ff 55%, #fff 100%);
        border-bottom: 1px solid #eaf0f8;
    }

    .article-detail-hero.has-cover {
        padding-bottom: 120px;
    }

    .article-detail-hero::before {
        position: absolute;
        top: -170px;
        right: -120px;
        width: 420px;
        height: 420px;
        border: 1px solid rgba(37, 99, 235, .12);
        border-radius: 50%;
        content: "";
        pointer-events: none;
    }

    .article-detail-hero .container {
        position: relative;
        z-index: 1;
    }

    .article-detail-head {
        max-width: var(--article-width);
        margin: 0 auto;
    }

    .article-detail-back {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 10px 14px;
        color: #475569;
        background: rgba(255, 255, 255, .8);
        border: 1px solid #e2e8f0;
        border-radius: 11px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: color .2s ease, border-color .2s ease, transform .2s ease;
    }

    .article-detail-back:hover {
        color: #2563eb;
        border-color: #bfdbfe;
        transform: translateX(-3px);
    }

    .article-detail-category {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 34px;
        padding: 8px 13px;
        color: #1d4ed8;
        background: #fff;
        border: 1px solid #dbeafe;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .8px;
    }

    .article-detail-category i {
        font-size: 14px;
    }

    .article-detail-title {
        margin: 20px 0 0;
        color: #14213d;
        font-size: clamp(1.9rem, 4.2vw, 3rem);
        font-weight: 850;
        line-height: 1.2;
        letter-spacing: -1.2px;
        overflow-wrap: anywhere;
    }

    .article-detail-meta {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px 20px;
        margin-top: 22px;
        color: #64748b;
        font-size: 13px;
        font-weight: 600;
    }

    .article-detail-meta span {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .article-detail-meta i {
        color: #2563eb;
    }

    /* ===== Gambar utama (tidak dipotong) ===== */
    .article-detail-cover-wrap {
        position: relative;
        z-index: 2;
        margin-top: -70px;
    }

    .article-detail-image {
        width: 100%;
        max-width: var(--article-width);
        margin: 0 auto;
        overflow: hidden;
        background: #fff;
        border: 6px solid #fff;
        border-radius: 24px;
        box-shadow: 0 25px 65px rgba(30, 64, 175, .15);
    }

    .article-detail-image img {
        display: block;
        width: 100%;
        height: auto;
        border-radius: 18px;
    }

    /* ===== Isi artikel ===== */
    .article-detail-content {
        padding: 50px 0 85px;
    }

    .article-detail-reading {
        max-width: var(--article-width);
        margin: 0 auto;
    }

    .article-detail-lead {
        margin: 0 0 34px;
        padding: 4px 0 4px 20px;
        color: #334155;
        border-left: 4px solid #2563eb;
        font-size: 20px;
        font-weight: 500;
        line-height: 1.8;
        overflow-wrap: anywhere;
    }

    .article-detail-body p {
        margin: 0 0 1.5em;
        color: #475569;
        font-size: 18px;
        line-height: 1.9;
        overflow-wrap: anywhere;
    }

    .article-detail-body p:last-child {
        margin-bottom: 0;
    }

    .article-detail-body h2,
    .article-detail-body h3 {
        margin: 1.8em 0 .7em;
        color: #14213d;
        font-weight: 800;
        line-height: 1.3;
    }

    .article-detail-body img {
        max-width: 100%;
        height: auto;
        border-radius: 14px;
    }

    .article-detail-body ul,
    .article-detail-body ol {
        margin-bottom: 1.5em;
        color: #475569;
        font-size: 18px;
        line-height: 1.9;
    }

    .article-detail-body blockquote {
        margin: 1.8em 0;
        padding: 18px 22px;
        color: #1e3a8a;
        background: #eff6ff;
        border-left: 4px solid #2563eb;
        border-radius: 0 14px 14px 0;
    }

    .article-detail-body a {
        color: #2563eb;
    }

    /* ===== Bagikan ===== */
    .article-detail-share {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 12px;
        margin-top: 44px;
        padding-top: 26px;
        border-top: 1px solid #e2e8f0;
    }

    .article-detail-share-label {
        margin-right: 4px;
        color: #14213d;
        font-size: 13px;
        font-weight: 800;
    }

    .article-detail-share a,
    .article-detail-share button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 14px;
        color: #475569;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 11px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: color .2s ease, border-color .2s ease, background .2s ease, transform .2s ease;
    }

    .article-detail-share a:hover,
    .article-detail-share button:hover {
        color: #2563eb;
        border-color: #bfdbfe;
        transform: translateY(-2px);
    }

    .article-detail-share button.is-copied {
        color: #15803d;
        background: #f0fdf4;
        border-color: #bbf7d0;
    }

    /* ===== CTA ===== */
    .article-detail-cta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        max-width: var(--article-width);
        margin: 60px auto 0;
        padding: 32px;
        background:
            radial-gradient(circle at 90% 10%, rgba(255, 255, 255, .14), transparent 30%),
            linear-gradient(120deg, #1d4ed8, #2563eb 58%, #0891b2);
        border-radius: 22px;
        box-shadow: 0 18px 40px rgba(37, 99, 235, .17);
    }

    .article-detail-cta h2 {
        margin-bottom: 8px;
        color: #fff;
        font-size: clamp(20px, 3vw, 27px);
        font-weight: 800;
        letter-spacing: -.5px;
    }

    .article-detail-cta p {
        max-width: 570px;
        margin-bottom: 0;
        color: rgba(255, 255, 255, .82);
        font-size: 13px;
        line-height: 1.8;
    }

    .article-detail-cta .btn {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        flex-shrink: 0;
        padding: 13px 21px;
        overflow: hidden;
        color: #1d4ed8;
        background: #fff;
        border: 1px solid rgba(255, 255, 255, .7);
        border-radius: 12px;
        font-size: 12px;
        font-weight: 800;
        text-decoration: none;
        transition: background .2s ease, transform .2s ease;
    }

    /* Kilau menyapu pada tombol */
    .article-detail-cta .btn::after {
        position: absolute;
        top: 0;
        left: -80%;
        width: 50%;
        height: 100%;
        background: linear-gradient(100deg, transparent, rgba(37, 99, 235, .25), transparent);
        content: "";
        transform: skewX(-20deg);
        pointer-events: none;
    }

    .article-detail-cta .btn:hover {
        color: #1d4ed8;
        background: #eff6ff;
        transform: translateY(-2px);
    }

    .article-detail-cta .btn:hover::after {
        left: 140%;
        transition: left .75s ease;
    }

    @media (max-width: 767.98px) {
        .article-detail-hero {
            padding: 38px 0 55px;
        }

        .article-detail-hero.has-cover {
            padding-bottom: 95px;
        }

        .article-detail-cover-wrap {
            margin-top: -55px;
        }

        .article-detail-image {
            border-width: 4px;
            border-radius: 17px;
        }

        .article-detail-image img {
            border-radius: 13px;
        }

        .article-detail-content {
            padding: 38px 0 60px;
        }

        .article-detail-lead {
            font-size: 16px;
            padding-left: 16px;
        }

        .article-detail-body p,
        .article-detail-body ul,
        .article-detail-body ol {
            font-size: 16px;
        }

        .article-detail-cta {
            align-items: flex-start;
            flex-direction: column;
            padding: 25px;
            border-radius: 17px;
        }

        .article-detail-cta .btn {
            width: 100%;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .article-detail-back,
        .article-detail-share a,
        .article-detail-share button,
        .article-detail-cta .btn {
            transition: none;
        }
    }
</style>

<div class="article-detail-page">

    <section class="article-detail-hero {{ $hasCover ? 'has-cover' : '' }}">
        <div class="container">
            <div class="article-detail-head">

                <a href="{{ route('articles') }}" class="article-detail-back smart-reveal">
                    <i class="bi bi-arrow-left"></i>
                    <span>Semua artikel</span>
                </a>

                <div>
                    <span class="article-detail-category smart-reveal smart-delay-1">
                        <i class="bi bi-journal-text"></i>
                        WAWASAN &amp; INFORMASI
                    </span>
                </div>

                <h1 class="article-detail-title">
                    {{ $article->title }}
                </h1>

                <div class="article-detail-meta smart-reveal smart-delay-2">
                    <span>
                        <i class="bi bi-calendar3"></i>
                        {{ $articleDate }}
                    </span>
                    <span>
                        <i class="bi bi-clock"></i>
                        {{ $readingTime }} menit baca
                    </span>
                </div>

            </div>
        </div>
    </section>

    @if($hasCover)
        <div class="article-detail-cover-wrap">
            <div class="container">
                <div class="article-detail-image smart-reveal smart-delay-2">
                    <img
                        src="{{ asset('storage/' . ltrim($article->image, '/')) }}"
                        alt="{{ $article->title }}"
                        loading="lazy"
                    >
                </div>
            </div>
        </div>
    @endif

    <section class="article-detail-content">
        <div class="container">

            <div class="article-detail-reading">

                @if(!empty($article->excerpt))
                    <p class="article-detail-lead smart-reveal">{{ $article->excerpt }}</p>
                @endif

                <div class="article-detail-body">
                    @foreach($paragraphs as $paragraph)
                        @if(trim($paragraph) !== '')
                            <p>{!! nl2br(e($paragraph)) !!}</p>
                        @endif
                    @endforeach
                </div>

                <div class="article-detail-share smart-reveal">
                    <span class="article-detail-share-label">Bagikan artikel:</span>

                    <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . $shareUrl) }}"
                       target="_blank" rel="noopener">
                        <i class="bi bi-whatsapp"></i> WhatsApp
                    </a>

                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($shareUrl) }}"
                       target="_blank" rel="noopener">
                        <i class="bi bi-linkedin"></i> LinkedIn
                    </a>

                    <button type="button" id="copy-article-link" data-url="{{ $shareUrl }}">
                        <i class="bi bi-link-45deg"></i>
                        <span>Salin tautan</span>
                    </button>
                </div>

            </div>

            <div class="article-detail-cta smart-reveal">
                <div>
                    <h2>Ingin berdiskusi lebih lanjut?</h2>
                    <p>
                        Ceritakan kebutuhan Anda kepada kami untuk menemukan
                        pendekatan dan solusi yang sesuai dengan tujuan bisnis.
                    </p>
                </div>

                <a href="{{ route('contact') }}" class="btn">
                    Konsultasikan kebutuhan
                    <i class="bi bi-arrow-up-right"></i>
                </a>
            </div>

        </div>
    </section>

</div>

<script>
    (function () {
        var btn = document.getElementById('copy-article-link');
        if (!btn) return;

        btn.addEventListener('click', function () {
            var url = btn.getAttribute('data-url');
            var label = btn.querySelector('span');
            var icon = btn.querySelector('i');

            function done() {
                label.textContent = 'Tautan disalin';
                btn.classList.add('is-copied');
                icon.className = 'bi bi-check2';

                setTimeout(function () {
                    label.textContent = 'Salin tautan';
                    btn.classList.remove('is-copied');
                    icon.className = 'bi bi-link-45deg';
                }, 2000);
            }

            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(url).then(done);
            } else {
                var input = document.createElement('input');
                input.value = url;
                document.body.appendChild(input);
                input.select();
                document.execCommand('copy');
                document.body.removeChild(input);
                done();
            }
        });
    })();
</script>

@endsection