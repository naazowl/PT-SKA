
@extends('layouts.public')

@section('title', 'Galeri Kegiatan')

@section('content')

<style>
    .gallery-page {
        overflow: hidden;
        background: #fff;
    }

    .gallery-hero {
        position: relative;
        overflow: hidden;
        padding: 100px 0 85px;
        background:
            radial-gradient(ellipse at 85% 15%, rgba(96, 165, 250, .18), transparent 34%),
            radial-gradient(ellipse at 10% 90%, rgba(191, 219, 254, .30), transparent 35%),
            linear-gradient(135deg, #f8fbff 0%, #eef5ff 52%, #fff 100%);
        border-bottom: 1px solid #eaf0f8;
    }

    .gallery-hero::before,
    .gallery-hero::after {
        position: absolute;
        border: 1px solid rgba(37, 99, 235, .12);
        border-radius: 50%;
        content: "";
        pointer-events: none;
    }

    .gallery-hero::before {
        top: -130px;
        right: -100px;
        width: 360px;
        height: 360px;
    }

    .gallery-hero::after {
        top: -70px;
        right: -40px;
        width: 240px;
        height: 240px;
    }

    .gallery-hero .container {
        position: relative;
        z-index: 1;
    }

    .gallery-eyebrow {
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

    .gallery-eyebrow::before {
        width: 7px;
        height: 7px;
        background: #3b82f6;
        border-radius: 50%;
        content: "";
        box-shadow: 0 0 0 4px rgba(59, 130, 246, .12);
    }

    .gallery-hero h1 {
        max-width: 850px;
        color: #14213d;
        font-size: clamp(2.5rem, 5vw, 4.2rem);
        line-height: 1.13;
        letter-spacing: -2px;
    }

    .gallery-gradient-text {
        color: #2563eb;
        background: linear-gradient(100deg, #2563eb, #06b6d4);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .gallery-hero-description {
        max-width: 610px;
        color: #64748b;
        font-size: 17px;
        line-height: 1.9;
    }

    .gallery-section {
        padding-top: 55px;
        padding-bottom: 80px;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 28px 24px;
        align-items: stretch;
    }

    .gallery-card {
        display: flex;
        flex-direction: column;
        align-self: stretch;
        min-width: 0;
        height: 100%;
        overflow: hidden;
        background: #fff;
        border: 1px solid #e9eef4;
        border-radius: 14px;
        box-shadow: 0 5px 18px rgba(31, 66, 102, .06);
        transition: transform .25s ease, box-shadow .25s ease;
    }

    .gallery-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 28px rgba(31, 66, 102, .12);
    }

    .gallery-image-wrapper {
        position: relative;
        flex: 0 0 auto;
        width: 100%;
        aspect-ratio: 4 / 3;
        overflow: hidden;
        background: #edf3f8;
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;
    }

    .gallery-image {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        cursor: zoom-in;
        border: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        transition: transform .4s ease;
    }

    .gallery-card:hover .gallery-image {
        transform: scale(1.04);
    }

    .gallery-image:focus-visible {
        outline: 3px solid #2789d2;
        outline-offset: -3px;
    }

    .gallery-caption {
        flex: 1 1 auto;
        min-width: 0;
        padding: 17px 18px 19px;
        background: #fff;
        border: 0 !important;
        border-top: 0 !important;
        border-bottom: 0 !important;
        border-radius: 0 !important;
        outline: 0 !important;
        box-shadow: none !important;
    }

    .gallery-caption h5 {
        margin: 0;
        padding: 0;
        color: #203b59;
        font-size: 17px;
        font-weight: 700;
        line-height: 1.5;
        overflow-wrap: anywhere;
        border: 0 !important;
        box-shadow: none !important;
    }

    .gallery-caption p {
        margin: 8px 0 0;
        padding: 0;
        color: #748294;
        font-size: 14px;
        line-height: 1.7;
        overflow-wrap: anywhere;
        border: 0 !important;
        border-bottom: 0 !important;
        box-shadow: none !important;
    }

    .gallery-card,
    .gallery-card *,
    .gallery-card *::before,
    .gallery-card *::after {
        border-bottom-color: transparent;
    }

    .gallery-card {
        border: 1px solid #e9eef4;
    }

    .gallery-empty {
        grid-column: 1 / -1;
        padding: 45px 20px;
        color: #68788a;
        background: #f7faff;
        border: 1px dashed #cbdced;
        border-radius: 14px;
        text-align: center;
    }

    .gallery-pagination {
        display: flex;
        justify-content: center;
        margin-top: 44px;
    }

    .gallery-pagination nav {
        display: flex !important;
        flex-direction: column;
        align-items: center;
        justify-content: center !important;
        width: 100%;
        max-width: 100%;
    }

    .gallery-pagination nav > div {
        width: 100%;
    }

    .gallery-pagination nav > div.d-sm-flex {
        flex-direction: column;
        align-items: center !important;
        justify-content: center !important;
        gap: 16px;
    }

    .gallery-pagination nav > div.d-sm-flex > div:first-child {
        order: 2;
    }

    .gallery-pagination nav > div.d-sm-flex > div:last-child {
        order: 1;
    }

    .gallery-pagination nav > div.d-sm-none {
        justify-content: center !important;
    }

    .gallery-pagination nav p.small {
        margin: 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.6;
        text-align: center;
    }

    .gallery-pagination nav p.small .fw-semibold {
        color: #172554;
        font-weight: 700 !important;
    }

    .gallery-pagination .pagination {
        flex-wrap: wrap;
        justify-content: center;
        gap: 6px;
        margin: 0;
    }

    .gallery-pagination .page-item .page-link {
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

    .gallery-pagination .page-item:not(.active):not(.disabled) .page-link:hover {
        color: #1d4ed8;
        background: #eff6ff;
        border-color: #bfdbfe;
        transform: translateY(-2px);
    }

    .gallery-pagination .page-item.active .page-link {
        color: #fff;
        background: #2563eb;
        border-color: #2563eb;
        box-shadow: 0 8px 18px rgba(37, 99, 235, .25);
    }

    .gallery-pagination .page-item.disabled .page-link {
        color: #94a3b8;
        background: #f8fafc;
        border-color: #e2e8f0;
    }

    #galleryLightbox {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 55px 75px 30px;
        background: rgba(8, 16, 28, .94);
    }

    #galleryLightbox.is-open {
        display: flex;
    }

    .gallery-lightbox-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 14px;
        max-width: 100%;
        max-height: 100%;
    }

    #galleryLightboxImage {
        display: block;
        max-width: 100%;
        max-height: calc(100vh - 130px);
        object-fit: contain;
        border-radius: 8px;
    }

    #galleryLightboxTitle {
        margin: 0;
        color: #fff;
        font-size: 15px;
        line-height: 1.5;
        text-align: center;
    }

    .gallery-lightbox-button {
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        color: #fff;
        cursor: pointer;
        transition: background .2s ease;
    }

    .gallery-lightbox-button:hover {
        background: rgba(255, 255, 255, .25);
    }

    #galleryClose {
        top: 15px;
        right: 24px;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: transparent;
        font-size: 34px;
        line-height: 1;
    }

    #galleryPrev,
    #galleryNext {
        top: 50%;
        transform: translateY(-50%);
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .15);
        font-size: 30px;
    }

    #galleryPrev {
        left: 18px;
    }

    #galleryNext {
        right: 18px;
    }

    @media (max-width: 991px) {
        .gallery-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px 18px;
        }
    }

    @media (max-width: 767.98px) {
        .gallery-hero {
            padding: 75px 0 65px;
        }

        .gallery-hero h1 {
            letter-spacing: -1.3px;
        }

        .gallery-hero-description {
            font-size: 15px;
        }

        .gallery-section {
            padding-top: 40px;
            padding-bottom: 60px;
        }
    }

    @media (max-width: 575px) {
        .gallery-hero {
            padding: 65px 0 50px;
        }

        .gallery-hero h1 {
            font-size: 2.5rem;
        }

        .gallery-hero-description {
            font-size: 14px;
        }

        .gallery-grid {
            grid-template-columns: 1fr;
            gap: 22px;
        }

        .gallery-caption {
            padding: 15px 16px 17px;
        }

        .gallery-caption h5 {
            font-size: 16px;
        }

        #galleryLightbox {
            padding: 55px 42px 25px;
        }

        #galleryPrev,
        #galleryNext {
            width: 34px;
            height: 34px;
            font-size: 23px;
        }

        #galleryPrev {
            left: 4px;
        }

        #galleryNext {
            right: 4px;
        }

        #galleryLightboxImage {
            max-height: calc(100vh - 125px);
        }

        #galleryClose {
            top: 8px;
            right: 8px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .gallery-card,
        .gallery-image,
        .gallery-pagination .page-link {
            transition: none;
        }

        .gallery-card:hover,
        .gallery-card:hover .gallery-image,
        .gallery-pagination .page-item:not(.active):not(.disabled) .page-link:hover {
            transform: none;
        }
    }
</style>

<div class="gallery-page">

    <section class="gallery-hero">
        <div class="container">
            <span class="gallery-eyebrow smart-reveal">GALERI KEGIATAN</span>

            <h1 class="fw-bold mt-4">
                Momen dalam<br>
                <span class="gallery-gradient-text">perjalanan kami.</span>
            </h1>

            <p class="gallery-hero-description mt-4 mb-0 smart-reveal smart-delay-2">
                Dokumentasi kegiatan, kolaborasi, dan cerita di balik proses.
                Lihat berbagai momen dan aktivitas yang menjadi bagian dari perjalanan kami.
            </p>
        </div>
    </section>

    <section class="container gallery-section">
        <div class="gallery-grid">

            @forelse($gallery as $g)
                @if($g->image)
                    <article class="gallery-card smart-reveal smart-delay-{{ ($loop->index % 3) + 1 }}">
                        <div class="gallery-image-wrapper">
                            <img
                                src="{{ asset('storage/' . ltrim($g->image, '/')) }}"
                                alt="{{ $g->title }}"
                                class="gallery-image"
                                loading="lazy"
                                tabindex="0"
                                role="button"
                                aria-label="Lihat foto {{ $g->title }}"
                                data-gallery-image="{{ asset('storage/' . ltrim($g->image, '/')) }}"
                                data-gallery-title="{{ $g->title }}"
                            >
                        </div>

                        <div class="gallery-caption">
                            <h5>{{ $g->title }}</h5>

                            @if(trim((string) $g->description) !== '')
                                <p>{{ $g->description }}</p>
                            @endif
                        </div>
                    </article>
                @endif
            @empty
                <div class="gallery-empty smart-reveal">
                    Galeri kegiatan belum tersedia.
                </div>
            @endforelse

        </div>

        @if(method_exists($gallery, 'hasPages') && $gallery->hasPages())
            <div class="gallery-pagination smart-reveal">
                {{ $gallery->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </section>

</div>

<div
    id="galleryLightbox"
    role="dialog"
    aria-modal="true"
    aria-label="Detail foto galeri"
    aria-hidden="true"
>
    <button
        type="button"
        id="galleryClose"
        class="gallery-lightbox-button"
        aria-label="Tutup foto"
    >
        &times;
    </button>

    <button
        type="button"
        id="galleryPrev"
        class="gallery-lightbox-button"
        aria-label="Foto sebelumnya"
    >
        &#8249;
    </button>

    <div class="gallery-lightbox-content">
        <img id="galleryLightboxImage" src="" alt="">
        <p id="galleryLightboxTitle"></p>
    </div>

    <button
        type="button"
        id="galleryNext"
        class="gallery-lightbox-button"
        aria-label="Foto berikutnya"
    >
        &#8250;
    </button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const lightbox = document.getElementById('galleryLightbox');
    const lightboxImage = document.getElementById('galleryLightboxImage');
    const lightboxTitle = document.getElementById('galleryLightboxTitle');
    const closeButton = document.getElementById('galleryClose');
    const prevButton = document.getElementById('galleryPrev');
    const nextButton = document.getElementById('galleryNext');

    const galleryImages = Array.from(
        document.querySelectorAll('[data-gallery-image]')
    );

    let currentIndex = 0;
    let previousFocus = null;

    function showImage(index) {
        if (galleryImages.length === 0) return;

        currentIndex = (index + galleryImages.length) % galleryImages.length;

        const selectedImage = galleryImages[currentIndex];

        lightboxImage.src = selectedImage.dataset.galleryImage;
        lightboxImage.alt = selectedImage.dataset.galleryTitle || '';
        lightboxTitle.textContent = selectedImage.dataset.galleryTitle || '';

        const showNavigation = galleryImages.length > 1;

        prevButton.style.display = showNavigation ? 'flex' : 'none';
        nextButton.style.display = showNavigation ? 'flex' : 'none';
    }

    function openLightbox(index) {
        previousFocus = document.activeElement;

        showImage(index);

        lightbox.classList.add('is-open');
        lightbox.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';

        closeButton.focus();
    }

    function closeLightbox() {
        lightbox.classList.remove('is-open');
        lightbox.setAttribute('aria-hidden', 'true');
        lightboxImage.src = '';
        document.body.style.overflow = '';

        if (previousFocus) {
            previousFocus.focus();
        }
    }

    galleryImages.forEach(function (image, index) {
        image.addEventListener('click', function () {
            openLightbox(index);
        });

        image.addEventListener('keydown', function (event) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                openLightbox(index);
            }
        });
    });

    closeButton.addEventListener('click', closeLightbox);

    prevButton.addEventListener('click', function () {
        showImage(currentIndex - 1);
    });

    nextButton.addEventListener('click', function () {
        showImage(currentIndex + 1);
    });

    lightbox.addEventListener('click', function (event) {
        if (event.target === lightbox) {
            closeLightbox();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (!lightbox.classList.contains('is-open')) return;

        if (event.key === 'Escape') {
            closeLightbox();
        } else if (event.key === 'ArrowLeft') {
            showImage(currentIndex - 1);
        } else if (event.key === 'ArrowRight') {
            showImage(currentIndex + 1);
        }
    });
});
</script>

@endsection
