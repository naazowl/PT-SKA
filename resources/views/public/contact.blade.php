@extends('layouts.public')

@section('title', 'Kontak Kami')

@section('content')

<style>
    .contact-page {
        overflow: hidden;
        background: #fff;
    }

    /* HERO */
    .contact-hero {
        position: relative;
        overflow: hidden;
        padding: 100px 0 85px;
        background:
            radial-gradient(ellipse at 85% 15%, rgba(96, 165, 250, .18), transparent 34%),
            radial-gradient(ellipse at 10% 90%, rgba(191, 219, 254, .30), transparent 35%),
            linear-gradient(135deg, #f8fbff 0%, #eef5ff 52%, #fff 100%);
        border-bottom: 1px solid #eaf0f8;
    }

    .contact-hero::before,
    .contact-hero::after {
        position: absolute;
        border: 1px solid rgba(37, 99, 235, .12);
        border-radius: 50%;
        content: "";
        pointer-events: none;
    }

    .contact-hero::before {
        top: -130px;
        right: -100px;
        width: 360px;
        height: 360px;
    }

    .contact-hero::after {
        top: -70px;
        right: -40px;
        width: 240px;
        height: 240px;
    }

    .contact-hero .container {
        position: relative;
        z-index: 1;
    }

    .contact-eyebrow {
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

    .contact-eyebrow::before {
        width: 7px;
        height: 7px;
        background: #3b82f6;
        border-radius: 50%;
        content: "";
        box-shadow: 0 0 0 4px rgba(59, 130, 246, .12);
    }

    .contact-hero h1 {
        max-width: 850px;
        color: #14213d;
        font-size: clamp(2.5rem, 5vw, 4.2rem);
        line-height: 1.13;
        letter-spacing: -2px;
    }

    .contact-gradient-text {
        color: #2563eb;
        background: linear-gradient(100deg, #2563eb, #06b6d4);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .contact-hero-description {
        max-width: 610px;
        color: #64748b;
        font-size: 17px;
        line-height: 1.9;
    }

    /* MAIN */
    .contact-main-section {
        padding-top: 65px;
        padding-bottom: 90px;
    }

    .contact-section-heading {
        margin-bottom: 30px;
    }

    .contact-section-heading h2 {
        margin-bottom: 8px;
        color: #172554;
        font-size: clamp(23px, 3vw, 30px);
        font-weight: 800;
        letter-spacing: -.8px;
    }

    .contact-section-heading p {
        margin-bottom: 0;
        color: #64748b;
        font-size: 14px;
        line-height: 1.8;
    }

    .contact-panel,
    .contact-info-panel {
        height: 100%;
        padding: 32px;
        background: #fff;
        border: 1px solid #e7edf5;
        border-radius: 22px;
        box-shadow: 0 8px 28px rgba(15, 23, 42, .035);
    }

    .contact-panel {
        position: relative;
        overflow: hidden;
    }

    .contact-panel::before {
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        height: 4px;
        background: linear-gradient(90deg, #2563eb, #06b6d4);
        content: "";
    }

    .contact-panel-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 58px;
        height: 58px;
        margin-bottom: 22px;
        color: #2563eb;
        background: #eff6ff;
        border: 1px solid #dbeafe;
        border-radius: 17px;
        font-size: 25px;
    }

    .contact-panel h2 {
        margin-bottom: 12px;
        color: #172554;
        font-size: 25px;
        font-weight: 800;
        letter-spacing: -.5px;
    }

    .contact-panel-description {
        max-width: 500px;
        margin-bottom: 26px;
        color: #64748b;
        font-size: 14px;
        line-height: 1.9;
    }

    /* FORM PESAN */
    .contact-form {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .contact-form-group label {
        display: block;
        margin-bottom: 8px;
        color: #334155;
        font-size: 13px;
        font-weight: 700;
    }

    .contact-form-group label .required {
        color: #ef4444;
    }

    .contact-input,
    .contact-textarea {
        display: block;
        width: 100%;
        padding: 13px 15px;
        color: #172554;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        outline: none;
        font-family: inherit;
        font-size: 14px;
        transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
    }

    .contact-input {
        min-height: 48px;
    }

    .contact-textarea {
        min-height: 145px;
        resize: vertical;
        line-height: 1.8;
    }

    .contact-input:focus,
    .contact-textarea:focus {
        background: #fff;
        border-color: #60a5fa;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, .10);
    }

    .contact-input::placeholder,
    .contact-textarea::placeholder {
        color: #94a3b8;
    }

    .contact-input.is-invalid,
    .contact-textarea.is-invalid {
        border-color: #ef4444;
    }

    .contact-error {
        display: block;
        margin-top: 6px;
        color: #dc2626;
        font-size: 12px;
    }

    .contact-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        min-height: 49px;
        padding: 13px 20px;
        color: #fff;
        background: linear-gradient(100deg, #2563eb, #0ea5e9);
        border: 0;
        border-radius: 12px;
        box-shadow: 0 7px 16px rgba(37, 99, 235, .15);
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .contact-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 22px rgba(37, 99, 235, .22);
    }

    .contact-submit:disabled {
        opacity: .65;
        cursor: not-allowed;
        transform: none;
    }

    .contact-form-note {
        display: flex;
        align-items: flex-start;
        gap: 9px;
        margin: 0;
        color: #64748b;
        font-size: 12px;
        line-height: 1.8;
    }

    .contact-form-note i {
        margin-top: 2px;
        color: #2563eb;
    }

    .contact-alert {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 22px;
        padding: 14px 16px;
        border-radius: 12px;
        font-size: 13px;
        line-height: 1.7;
    }

    .contact-alert-success {
        color: #166534;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
    }

    .contact-alert-error {
        color: #991b1b;
        background: #fef2f2;
        border: 1px solid #fecaca;
    }

    /* INFORMASI KONTAK */
    .contact-info-panel {
        background:
            radial-gradient(ellipse at 100% 0%, rgba(219, 234, 254, .45), transparent 38%),
            #fff;
    }

    .contact-info-heading {
        margin-bottom: 25px;
        color: #172554;
        font-size: 20px;
        font-weight: 800;
        letter-spacing: -.4px;
    }

    .contact-info-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 19px 0;
        border-bottom: 1px solid #edf2f8;
    }

    .contact-info-item:first-of-type {
        padding-top: 0;
    }

    .contact-info-item:last-child {
        padding-bottom: 0;
        border-bottom: none;
    }

    .contact-info-icon {
        display: flex;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        color: #2563eb;
        background: #eff6ff;
        border: 1px solid #dbeafe;
        border-radius: 13px;
        font-size: 19px;
        transition: color .2s ease, background .2s ease;
    }

    .contact-info-text {
        min-width: 0;
        padding-top: 2px;
    }

    .contact-info-text h3 {
        margin: 0 0 6px;
        color: #172554;
        font-size: 13px;
        font-weight: 800;
    }

    .contact-info-text p,
    .contact-info-text a {
        margin: 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.8;
        overflow-wrap: anywhere;
    }

    .contact-info-text a {
        text-decoration: none;
        transition: color .2s ease;
    }

    .contact-info-text a:hover {
        color: #2563eb;
    }

    .contact-map-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 8px;
        color: #2563eb !important;
        font-size: 12px !important;
        font-weight: 700;
    }

    .contact-map-link:hover {
        text-decoration: underline !important;
    }

    .contact-info-bottom {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        margin-top: 25px;
        padding: 16px;
        color: #475569;
        background: #f8fbff;
        border: 1px solid #e7edf5;
        border-radius: 14px;
        font-size: 12px;
        line-height: 1.8;
    }

    .contact-info-bottom i {
        margin-top: 2px;
        color: #2563eb;
        font-size: 16px;
    }

    @media (max-width: 767.98px) {
        .contact-hero {
            padding: 75px 0 65px;
        }

        .contact-hero h1 {
            letter-spacing: -1.3px;
        }

        .contact-hero-description {
            font-size: 15px;
        }

        .contact-main-section {
            padding-top: 45px;
            padding-bottom: 60px;
        }

        .contact-panel,
        .contact-info-panel {
            padding: 25px 22px;
            border-radius: 19px;
        }

        .contact-panel h2 {
            font-size: 22px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .contact-input,
        .contact-textarea,
        .contact-submit,
        .contact-info-icon {
            transition: none;
        }

        .contact-submit:hover {
            transform: none;
        }
    }
</style>

<div class="contact-page">

    {{-- HERO --}}
    <section class="contact-hero">
        <div class="container">
            <span class="contact-eyebrow smart-reveal">MARI TERHUBUNG</span>

            <h1 class="fw-bold mt-4" data-smart-title>
                Ceritakan rencana<br>
                <span class="contact-gradient-text">Anda kepada kami.</span>
            </h1>

            <p class="contact-hero-description mt-4 mb-0 smart-reveal smart-delay-2">
                Kami siap mendengarkan kebutuhan dan membantu menemukan
                langkah berikutnya untuk bisnis Anda.
            </p>
        </div>
    </section>

    {{-- KONTEN KONTAK --}}
    <section class="container contact-main-section">

        <div class="contact-section-heading">
            <h2 data-smart-title>Hubungi Kami</h2>
            <p class="smart-reveal smart-delay-1">Pilih cara komunikasi yang paling nyaman untuk Anda.</p>
        </div>

        @if (session('success'))
            <div class="contact-alert contact-alert-success smart-reveal" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="contact-alert contact-alert-error smart-reveal" role="alert">
                <i class="bi bi-exclamation-circle-fill"></i>
                <div>
                    <strong>Pesan belum berhasil dikirim.</strong>
                    <div>Periksa kembali data yang kamu masukkan.</div>
                </div>
            </div>
        @endif

        <div class="row g-4">

            {{-- FORM PESAN --}}
            <div class="col-lg-7">
                <div class="contact-panel smart-reveal smart-delay-1">

                    <div class="contact-panel-icon">
                        <i class="bi bi-chat-square-text"></i>
                    </div>

                    <h2>Kirim Pesan</h2>

                    <p class="contact-panel-description">
                        Punya pertanyaan, ide, atau kebutuhan digital yang ingin didiskusikan?
                        Isi formulir berikut dan sampaikan pesanmu kepada kami.
                    </p>

                    <form action="{{ route('contact.send') }}" method="POST" class="contact-form">
                        @csrf

                        <div class="contact-form-group">
                            <label for="name">
                                Nama lengkap <span class="required">*</span>
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="contact-input @error('name') is-invalid @enderror"
                                value="{{ old('name') }}"
                                placeholder="Masukkan nama lengkap"
                                maxlength="100"
                                autocomplete="name"
                                required
                            >
                            @error('name')
                                <span class="contact-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="contact-form-group">
                            <label for="email">
                                Alamat email <span class="required">*</span>
                            </label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="contact-input @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                placeholder="nama@email.com"
                                maxlength="150"
                                autocomplete="email"
                                required
                            >
                            @error('email')
                                <span class="contact-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="contact-form-group">
                            <label for="subject">
                                Subjek pesan <span class="required">*</span>
                            </label>
                            <input
                                type="text"
                                id="subject"
                                name="subject"
                                class="contact-input @error('subject') is-invalid @enderror"
                                value="{{ old('subject') }}"
                                placeholder="Contoh: Pertanyaan pembuatan website"
                                maxlength="150"
                                required
                            >
                            @error('subject')
                                <span class="contact-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="contact-form-group">
                            <label for="message">
                                Isi pesan <span class="required">*</span>
                            </label>
                            <textarea
                                id="message"
                                name="message"
                                class="contact-textarea @error('message') is-invalid @enderror"
                                placeholder="Tuliskan pesan atau kebutuhan Anda di sini..."
                                rows="6"
                                maxlength="5000"
                                required
                            >{{ old('message') }}</textarea>
                            @error('message')
                                <span class="contact-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="contact-submit">
                            <i class="bi bi-send-fill"></i>
                            Kirim Pesan
                        </button>

                        <p class="contact-form-note">
                            <i class="bi bi-shield-check"></i>
                            <span>
                                Pastikan alamat email yang dimasukkan benar agar kami
                                dapat menghubungi Anda kembali.
                            </span>
                        </p>
                    </form>

                </div>
            </div>

            {{-- INFORMASI KONTAK --}}
            <div class="col-lg-5">
                <div class="contact-info-panel smart-reveal smart-delay-2">

                    <h2 class="contact-info-heading">Informasi Kontak</h2>

                    {{-- ALAMAT --}}
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>

                        <div class="contact-info-text">
                            <h3>Alamat</h3>

                            @if ($company->address)
                                <p>{{ $company->address }}</p>

                                <a
                                    class="contact-map-link"
                                    href="https://www.google.com/maps/search/?api=1&query={{ urlencode($company->address) }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    <i class="bi bi-map"></i>
                                    Lihat di Google Maps
                                    <i class="bi bi-arrow-up-right"></i>
                                </a>
                            @else
                                <p>Informasi alamat belum tersedia.</p>
                            @endif
                        </div>
                    </div>

                    {{-- TELEPON --}}
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <i class="bi bi-telephone-fill"></i>
                        </div>

                        <div class="contact-info-text">
                            <h3>Telepon</h3>

                            @if ($company->phone)
                                <a href="tel:{{ preg_replace('/[^\d+]/', '', $company->phone) }}">
                                    {{ $company->phone }}
                                </a>
                            @else
                                <p>Informasi telepon belum tersedia.</p>
                            @endif
                        </div>
                    </div>

                    {{-- EMAIL --}}
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <i class="bi bi-envelope-fill"></i>
                        </div>

                        <div class="contact-info-text">
                            <h3>Email</h3>

                            @if ($company->email)
                                <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ rawurlencode($company->email) }}"
                                target="_blank"
                                rel="noopener noreferrer">
                                    {{ $company->email }}
                                </a>
                            @else
                                <p>Informasi email belum tersedia.</p>
                            @endif
                        </div>
                    </div>

                    {{-- WHATSAPP --}}
                    @if ($company->whatsapp)
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="bi bi-whatsapp"></i>
                            </div>

                            <div class="contact-info-text">
                                <h3>WhatsApp</h3>

                                <a
                                    href="https://wa.me/{{ preg_replace('/\D/', '', $company->whatsapp) }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    {{ $company->whatsapp }}
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="contact-info-bottom">
                        <i class="bi bi-info-circle-fill"></i>
                        <span>
                            Kami siap membantu menjawab pertanyaan dan mendiskusikan
                            kebutuhan website atau layanan digital Anda.
                        </span>
                    </div>

                </div>
            </div>

        </div>
    </section>

</div>

@endsection