@extends('layouts.public')

@section('title', $product->name)

@section('content')

<style>
    .product-detail-page {
        overflow: hidden;
        background: #fff;
    }

    .product-detail-hero {
        position: relative;
        overflow: hidden;
        padding: 60px 0 80px;
        background:
            radial-gradient(ellipse at 90% 10%, rgba(96, 165, 250, .18), transparent 35%),
            linear-gradient(145deg, #f8fbff 0%, #eff6ff 55%, #fff 100%);
        border-bottom: 1px solid #eaf0f8;
    }

    .product-detail-hero::before {
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

    .product-detail-hero .container {
        position: relative;
        z-index: 1;
    }

    .product-detail-back {
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

    .product-detail-back:hover {
        color: #2563eb;
        border-color: #bfdbfe;
        transform: translateX(-3px);
    }

    .product-detail-category {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 13px;
        color: #1d4ed8;
        background: #fff;
        border: 1px solid #dbeafe;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .8px;
    }

    .product-detail-category i {
        font-size: 14px;
    }

    .product-detail-title {
        max-width: 950px;
        margin: 22px auto 0;
        color: #14213d;
        font-size: clamp(2.2rem, 5vw, 4rem);
        font-weight: 850;
        line-height: 1.15;
        letter-spacing: -1.8px;
        overflow-wrap: anywhere;
    }

    .product-detail-subtitle {
        max-width: 760px;
        margin: 20px auto 0;
        color: #64748b;
        font-size: 16px;
        line-height: 1.9;
        overflow-wrap: anywhere;
    }

    .product-detail-image {
        position: relative;
        width: 100%;
        height: clamp(260px, 42vw, 500px);
        margin: 42px auto 0;
        overflow: hidden;
        background: linear-gradient(135deg, #eff6ff, #dbeafe);
        border: 1px solid rgba(255, 255, 255, .9);
        border-radius: 24px;
        box-shadow: 0 25px 65px rgba(30, 64, 175, .13);
    }

    .product-detail-image img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .product-detail-image-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        color: #2563eb;
        background:
            radial-gradient(circle at 80% 15%, rgba(96, 165, 250, .25), transparent 35%),
            linear-gradient(135deg, #eff6ff, #dbeafe);
    }

    .product-detail-image-placeholder i {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, .8);
        border: 1px solid #fff;
        border-radius: 28px;
        font-size: 45px;
        box-shadow: 0 15px 35px rgba(37, 99, 235, .12);
    }

    .product-detail-content {
        padding: 55px 0 85px;
    }

    /* Deskripsi sederhana seperti tampilan awal */
    .product-detail-description-card {
        width: 100%;
        max-width: 1076px;
        margin: 0 auto;
        padding: 28px 30px;
        box-sizing: border-box;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
    }

    .product-detail-description {
        margin: 0;
        color: #475569;
        font-size: 17px;
        line-height: 1.9;
        white-space: pre-line;
        overflow-wrap: anywhere;
    }

    .product-detail-cta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        padding: 32px;
        margin-top: 28px;
        background:
            radial-gradient(circle at 90% 10%, rgba(255, 255, 255, .14), transparent 30%),
            linear-gradient(120deg, #1d4ed8, #2563eb 58%, #0891b2);
        border-radius: 22px;
        box-shadow: 0 18px 40px rgba(37, 99, 235, .17);
    }

    .product-detail-cta h2 {
        margin-bottom: 8px;
        color: #fff;
        font-size: clamp(20px, 3vw, 27px);
        font-weight: 800;
        letter-spacing: -.5px;
    }

    .product-detail-cta p {
        max-width: 570px;
        margin-bottom: 0;
        color: rgba(255, 255, 255, .82);
        font-size: 13px;
        line-height: 1.8;
    }

    .product-detail-cta .btn {
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
    .product-detail-cta .btn::after {
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

    .product-detail-cta .btn:hover {
        color: #1d4ed8;
        background: #eff6ff;
        transform: translateY(-2px);
    }

    .product-detail-cta .btn:hover::after {
        left: 140%;
        transition: left .75s ease;
    }

    @media (max-width: 767.98px) {
        .product-detail-hero {
            padding: 38px 0 55px;
        }

        .product-detail-title {
            letter-spacing: -1px;
        }

        .product-detail-subtitle {
            font-size: 14px;
        }

        .product-detail-image {
            margin-top: 30px;
            border-radius: 17px;
        }

        .product-detail-content {
            padding: 42px 0 60px;
        }

        .product-detail-description-card {
            padding: 23px 20px;
            border-radius: 16px;
        }

        .product-detail-description {
            font-size: 15px;
        }

        .product-detail-cta {
            align-items: flex-start;
            flex-direction: column;
            padding: 25px;
            border-radius: 17px;
        }

        .product-detail-cta .btn {
            width: 100%;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .product-detail-back,
        .product-detail-cta .btn {
            transition: none;
        }
    }
</style>

<div class="product-detail-page">

    <section class="product-detail-hero">
        <div class="container">

            <a href="{{ route('products') }}" class="product-detail-back smart-reveal">
                <i class="bi bi-arrow-left"></i>
                <span>Semua layanan</span>
            </a>

            <div class="text-center mt-5">
                <span class="product-detail-category smart-reveal smart-delay-1">
                    <i class="bi bi-grid-1x2"></i>
                    {{ $product->category ?: 'Solusi digital' }}
                </span>

                <h1 class="product-detail-title">
                    {{ $product->name }}
                </h1>

                @if($product->short_description)
                    <p class="product-detail-subtitle smart-reveal smart-delay-2">
                        {{ $product->short_description }}
                    </p>
                @endif
            </div>

            <div class="product-detail-image smart-reveal smart-delay-3">
                @if($product->image)
                    <img
                        src="{{ asset('storage/' . ltrim($product->image, '/')) }}"
                        alt="{{ $product->name }}"
                        loading="lazy"
                    >
                @else
                    <div class="product-detail-image-placeholder">
                        <i class="bi bi-grid-1x2"></i>
                    </div>
                @endif
            </div>

        </div>
    </section>

    <section class="product-detail-content">
        <div class="container">

            <div class="product-detail-description-card smart-reveal">
                <p class="product-detail-description">{{ $product->description }}</p>
            </div>

            <div class="product-detail-cta smart-reveal">
                <div>
                    <h2>Siap mengembangkan bisnis Anda?</h2>
                    <p>
                        Diskusikan kebutuhan Anda bersama kami untuk menemukan
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

@endsection