@extends('layouts.public')

@section('title', 'Profil Perusahaan')

@section('content')

@php
    $companyName = 'PT Solusi Koneksi Anda';

    // Ambil teks sorotan, buang "Mendorong Kemajuan" bila ikut tersimpan di database agar tidak dobel
    $rawHighlight = $company->profile_hero_highlight ?: 'Menghubungkan Ide,';
    $heroHighlight = trim(str_ireplace('Mendorong Kemajuan', '', $rawHighlight), " \t\n\r.,");
    $heroHighlight = ($heroHighlight !== '' ? $heroHighlight : 'Menghubungkan Ide') . ',';

    $heroDescription = $company->profile_hero_description
        ?: ($company->tagline
            ?: 'Membangun koneksi yang bermakna melalui solusi teknologi yang relevan, inovatif, dan berorientasi pada kebutuhan pelanggan.');

    $aboutText = $company->about
        ?: 'PT Solusi Koneksi Anda hadir dengan semangat untuk membantu pelanggan menemukan solusi yang sesuai dengan kebutuhan mereka. Kami percaya bahwa konektivitas, pemanfaatan teknologi, dan komunikasi yang baik merupakan bagian penting dalam mendukung perkembangan bisnis.';

    $profilePoints = [
        [
            'title' => $company->profile_point_1_title ?: 'Berorientasi pada Pelanggan',
            'description' => $company->profile_point_1_description ?: 'Memahami kebutuhan dan mengutamakan komunikasi yang jelas dalam setiap kerja sama.',
        ],
        [
            'title' => $company->profile_point_2_title ?: 'Solusi yang Relevan',
            'description' => $company->profile_point_2_description ?: 'Mengedepankan pendekatan yang sesuai dengan tujuan, kebutuhan, dan kondisi pelanggan.',
        ],
        [
            'title' => $company->profile_point_3_title ?: 'Komitmen pada Kualitas',
            'description' => $company->profile_point_3_description ?: 'Berupaya menjaga profesionalisme, ketelitian, dan kualitas dalam proses pelayanan.',
        ],
    ];

    $profileValues = [
        [
            'title' => $company->profile_value_1_title ?: 'Integritas',
            'description' => $company->profile_value_1_description ?: 'Menjunjung kejujuran, tanggung jawab, dan keterbukaan dalam menjalin hubungan dengan pelanggan maupun mitra.',
            'icon' => 'bi-shield-check',
        ],
        [
            'title' => $company->profile_value_2_title ?: 'Inovasi',
            'description' => $company->profile_value_2_description ?: 'Terbuka terhadap perkembangan dan gagasan baru untuk menemukan pendekatan yang semakin relevan.',
            'icon' => 'bi-lightbulb',
        ],
        [
            'title' => $company->profile_value_3_title ?: 'Profesionalisme',
            'description' => $company->profile_value_3_description ?: 'Mengutamakan komunikasi yang jelas, proses kerja yang tertata, dan perhatian terhadap kualitas.',
            'icon' => 'bi-briefcase',
        ],
        [
            'title' => $company->profile_value_4_title ?: 'Kolaborasi',
            'description' => $company->profile_value_4_description ?: 'Membangun hubungan yang saling mendukung untuk mencapai tujuan bersama secara berkelanjutan.',
            'icon' => 'bi-people',
        ],
    ];

    $profileCommitments = [
        [
            'title' => $company->profile_commitment_1_title ?: 'Komunikasi Terbuka',
            'description' => $company->profile_commitment_1_description ?: 'Menjaga komunikasi agar kebutuhan dan tujuan kerja sama dapat dipahami dengan baik.',
            'icon' => 'bi-chat-dots',
        ],
        [
            'title' => $company->profile_commitment_2_title ?: 'Pendekatan yang Tepat',
            'description' => $company->profile_commitment_2_description ?: 'Mempertimbangkan kebutuhan sebelum menentukan pendekatan dan solusi yang ditawarkan.',
            'icon' => 'bi-bullseye',
        ],
        [
            'title' => $company->profile_commitment_3_title ?: 'Perbaikan Berkelanjutan',
            'description' => $company->profile_commitment_3_description ?: 'Terus belajar dan melakukan evaluasi untuk meningkatkan kualitas proses kerja.',
            'icon' => 'bi-graph-up-arrow',
        ],
        [
            'title' => $company->profile_commitment_4_title ?: 'Hubungan Jangka Panjang',
            'description' => $company->profile_commitment_4_description ?: 'Mengutamakan kerja sama yang saling mendukung dan berorientasi pada kepercayaan.',
            'icon' => 'bi-heart',
        ],
    ];

    $visionText = $company->vision
        ?: 'Menjadi perusahaan yang dipercaya dalam menghadirkan solusi konektivitas dan teknologi yang relevan, berkualitas, serta memberikan nilai tambah bagi pelanggan dan mitra.';

    $missionText = trim((string) $company->mission);

    $missionItems = preg_split('/\r\n|\r|\n/', $missionText);
    $missionItems = array_values(array_filter(
        array_map('trim', $missionItems),
        fn ($item) => $item !== ''
    ));

    if (empty($missionItems)) {
        $missionItems = [
            'Memahami kebutuhan pelanggan dan berupaya memberikan solusi yang sesuai.',
            'Menjaga kualitas pelayanan melalui komunikasi dan proses kerja yang profesional.',
            'Mengikuti perkembangan teknologi untuk mendukung kebutuhan yang terus berubah.',
            'Membangun kemitraan yang dilandasi kepercayaan, kolaborasi, dan tanggung jawab.',
        ];
    }
@endphp

<style>
    .profile-page {
        --p-navy: #14213d;
        --p-blue: #2563eb;
        --p-blue-dark: #1d4ed8;
        --p-text: #475569;
        --p-muted: #64748b;
        --p-border: #e2e8f0;
        --p-soft: #eff6ff;
        --p-gradient: linear-gradient(120deg, #1d4ed8, #2563eb 58%, #0891b2);
        overflow: hidden;
        background: #fff;
        color: var(--p-text);
    }

    /* ===== Hero ===== */
    .profile-page .profile-hero {
        position: relative;
        overflow: hidden;
        padding: 70px 0 80px;
        text-align: center;
        background:
            radial-gradient(ellipse at 90% 10%, rgba(96, 165, 250, .18), transparent 35%),
            linear-gradient(145deg, #f8fbff 0%, #eff6ff 55%, #fff 100%);
        border-bottom: 1px solid #eaf0f8;
    }

    .profile-page .profile-hero::before {
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

    .profile-page .profile-hero .container {
        position: relative;
        z-index: 1;
    }

    .profile-page .profile-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 13px;
        color: var(--p-blue-dark);
        background: #fff;
        border: 1px solid #dbeafe;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .8px;
    }

    .profile-page .profile-eyebrow i {
        font-size: 14px;
    }

    .profile-page .profile-hero h1 {
        max-width: 760px;
        margin: 20px auto 0;
        color: #0f172a;
        font-size: clamp(1.7rem, 3.4vw, 2.6rem);
        font-weight: 800;
        line-height: 1.25;
        letter-spacing: -.8px;
        overflow-wrap: anywhere;
    }

    .profile-page .hero-highlight {
        display: block;
        color: var(--p-blue);
    }

    .profile-page .hero-dark {
        display: block;
        color: #0f172a;
    }

    .profile-page .hero-description {
        max-width: 640px;
        margin: 16px auto 0;
        color: var(--p-muted);
        font-size: 15px;
        line-height: 1.8;
        overflow-wrap: anywhere;
    }

    .profile-page .hero-actions {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 12px;
        margin-top: 28px;
    }

    /* Tombol bulat (pill) */
    .profile-page .btn-profile-primary,
    .profile-page .btn-profile-outline {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 13px 26px;
        overflow: hidden;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
        text-decoration: none;
        transition: background .2s ease, color .2s ease, border-color .2s ease, transform .2s ease;
    }

    .profile-page .btn-profile-primary {
        color: #fff;
        background: var(--p-blue);
        border: 1px solid var(--p-blue);
        box-shadow: 0 10px 24px rgba(37, 99, 235, .22);
    }

    .profile-page .btn-profile-primary:hover {
        color: #fff;
        background: var(--p-blue-dark);
        transform: translateY(-2px);
    }

    .profile-page .btn-profile-outline {
        color: #475569;
        background: rgba(255, 255, 255, .85);
        border: 1px solid var(--p-border);
    }

    .profile-page .btn-profile-outline:hover {
        color: var(--p-blue);
        border-color: #bfdbfe;
        transform: translateY(-2px);
    }

    /* Kilau menyapu pada tombol hero */
    .profile-page .btn-profile-primary::after,
    .profile-page .btn-profile-outline::after {
        position: absolute;
        top: 0;
        left: -80%;
        width: 50%;
        height: 100%;
        background: linear-gradient(100deg, transparent, rgba(255, 255, 255, .55), transparent);
        content: "";
        transform: skewX(-20deg);
        pointer-events: none;
    }

    .profile-page .btn-profile-primary:hover::after,
    .profile-page .btn-profile-outline:hover::after {
        left: 140%;
        transition: left .75s ease;
    }

    .profile-page .hero-note {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 24px;
        color: var(--p-muted);
        font-size: 12.5px;
        font-weight: 600;
    }

    .profile-page .hero-note i {
        color: #16a34a;
    }

    /* ===== Umum ===== */
    .profile-page .profile-section {
        padding: 80px 0;
    }

    .profile-page .section-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 14px;
        padding: 7px 12px;
        color: var(--p-blue-dark);
        background: var(--p-soft);
        border: 1px solid #dbeafe;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .8px;
        text-transform: uppercase;
    }

    .profile-page .section-heading {
        margin-bottom: 18px;
        color: var(--p-navy);
        font-size: clamp(1.8rem, 3vw, 2.5rem);
        font-weight: 850;
        line-height: 1.2;
        letter-spacing: -.8px;
        overflow-wrap: anywhere;
    }

    .profile-page .section-description {
        color: var(--p-muted);
        font-size: 16px;
        line-height: 1.9;
        overflow-wrap: anywhere;
    }

    /* ===== Tentang ===== */
    .profile-page .about-visual {
        position: relative;
        display: flex;
        align-items: flex-end;
        min-height: 420px;
        height: 100%;
        padding: 28px;
        overflow: hidden;
        background:
            radial-gradient(circle at 80% 15%, rgba(96, 165, 250, .35), transparent 35%),
            linear-gradient(135deg, #eff6ff, #dbeafe);
        border: 1px solid rgba(255, 255, 255, .9);
        border-radius: 24px;
        box-shadow: 0 25px 65px rgba(30, 64, 175, .13);
    }

    .profile-page .about-visual::before {
        position: absolute;
        top: -110px;
        right: -90px;
        width: 320px;
        height: 320px;
        border: 1px solid rgba(37, 99, 235, .15);
        border-radius: 50%;
        box-shadow: 0 0 0 28px rgba(37, 99, 235, .035);
        content: "";
        pointer-events: none;
    }

    /* Logo perusahaan (latar transparan, tanpa kartu) */
    .profile-page .visual-logo {
        position: absolute;
        top: 40%;
        left: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 240px;
        height: 240px;
        background: transparent;
        border: 0;
        border-radius: 0;
        box-shadow: none;
        transform: translate(-50%, -50%);
    }

    .profile-page .visual-logo img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: contain;
        background: transparent;
        filter: drop-shadow(0 14px 22px rgba(30, 64, 175, .2));
    }

    /* Logo melayang pelan (memakai properti "translate" agar tidak bentrok dengan transform di atas) */
    .js-anim .profile-page .visual-logo {
        animation: smartFloat 6s ease-in-out infinite;
    }

    .profile-page .visual-caption {
        position: relative;
        z-index: 1;
        width: 100%;
        padding: 22px;
        background: rgba(255, 255, 255, .9);
        border: 1px solid #fff;
        border-radius: 18px;
        box-shadow: 0 12px 30px rgba(30, 64, 175, .1);
    }

    .profile-page .visual-caption small {
        display: block;
        margin-bottom: 8px;
        color: var(--p-blue);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .8px;
    }

    .profile-page .visual-caption h3 {
        margin: 0;
        color: var(--p-navy);
        font-size: 1.3rem;
        font-weight: 800;
        line-height: 1.4;
        overflow-wrap: anywhere;
    }

    .profile-page .visual-caption p {
        margin: 8px 0 0;
        color: var(--p-muted);
        font-size: 14px;
    }

    .profile-page .about-checklist {
        display: grid;
        gap: 14px;
        margin-top: 26px;
    }

    .profile-page .about-check-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 17px 18px;
        background: #fff;
        border: 1px solid var(--p-border);
        border-radius: 16px;
        transition: transform .2s ease, border-color .2s ease, box-shadow .2s ease;
    }

    .profile-page .about-check-item:hover {
        transform: translateX(4px);
        border-color: #bfdbfe;
        box-shadow: 0 10px 26px rgba(30, 64, 175, .07);
    }

    .profile-page .check-circle {
        display: inline-flex;
        flex: 0 0 32px;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        color: var(--p-blue);
        background: var(--p-soft);
        border: 1px solid #dbeafe;
        border-radius: 10px;
        font-size: 15px;
    }

    .profile-page .about-check-item strong {
        display: block;
        margin-bottom: 4px;
        color: var(--p-navy);
        font-size: 15px;
        font-weight: 800;
    }

    .profile-page .about-check-item p {
        margin: 0;
        color: var(--p-muted);
        font-size: 14px;
        line-height: 1.75;
    }

    /* ===== Nilai ===== */
    .profile-page .values-section {
        padding: 80px 0 85px;
        background:
            radial-gradient(circle at 0% 0%, rgba(96, 165, 250, .14), transparent 30%),
            #f8fbff;
        border-top: 1px solid #eaf0f8;
        border-bottom: 1px solid #eaf0f8;
    }

    .profile-page .value-card {
        height: 100%;
        padding: 28px 24px;
        background: #fff;
        border: 1px solid var(--p-border);
        border-radius: 20px;
        transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    }

    .profile-page .value-card:hover {
        transform: translateY(-6px);
        border-color: #bfdbfe;
        box-shadow: 0 20px 42px rgba(30, 64, 175, .1);
    }

    .profile-page .value-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 54px;
        height: 54px;
        margin-bottom: 20px;
        color: #fff;
        background: var(--p-gradient);
        border-radius: 16px;
        font-size: 24px;
        box-shadow: 0 12px 26px rgba(37, 99, 235, .2);
        transition: transform .35s ease;
    }

    .profile-page .value-card:hover .value-icon {
        transform: rotate(-8deg) scale(1.08);
    }

    .profile-page .value-card h3 {
        margin-bottom: 10px;
        color: var(--p-navy);
        font-size: 1.1rem;
        font-weight: 800;
        overflow-wrap: anywhere;
    }

    .profile-page .value-card p {
        margin: 0;
        color: var(--p-muted);
        font-size: 14.5px;
        line-height: 1.8;
    }

    /* ===== Visi & Misi ===== */
    .profile-page .vision-mission-section {
        padding: 85px 0;
        background: #fff;
    }

    .profile-page .vision-card {
        position: relative;
        height: 100%;
        padding: 34px;
        overflow: hidden;
        border-radius: 22px;
    }

    .profile-page .vision-card.vision {
        color: #fff;
        background:
            radial-gradient(circle at 90% 10%, rgba(255, 255, 255, .14), transparent 30%),
            var(--p-gradient);
        box-shadow: 0 18px 40px rgba(37, 99, 235, .17);
    }

    .profile-page .vision-card.mission {
        background: #fff;
        border: 1px solid var(--p-border);
    }

    .profile-page .vision-tag {
        display: inline-block;
        margin-bottom: 18px;
        padding: 7px 12px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .8px;
    }

    .profile-page .vision-card.vision .vision-tag {
        color: #fff;
        background: rgba(255, 255, 255, .16);
        border: 1px solid rgba(255, 255, 255, .3);
    }

    .profile-page .vision-card.mission .vision-tag {
        color: var(--p-blue-dark);
        background: var(--p-soft);
        border: 1px solid #dbeafe;
    }

    .profile-page .vision-card h3 {
        margin-bottom: 14px;
        font-size: 1.7rem;
        font-weight: 850;
        letter-spacing: -.4px;
    }

    .profile-page .vision-card.vision h3 {
        color: #fff;
    }

    .profile-page .vision-card.mission h3 {
        color: var(--p-navy);
    }

    .profile-page .vision-card p {
        margin: 0;
        font-size: 16px;
        line-height: 1.9;
        overflow-wrap: anywhere;
    }

    .profile-page .vision-card.vision p {
        color: rgba(255, 255, 255, .88);
    }

    .profile-page .mission-list {
        display: grid;
        gap: 14px;
        margin: 22px 0 0;
        padding: 0;
        list-style: none;
    }

    .profile-page .mission-list li {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        color: var(--p-text);
        line-height: 1.75;
        overflow-wrap: anywhere;
    }

    .profile-page .mission-list li span {
        display: inline-flex;
        flex: 0 0 28px;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        color: var(--p-blue);
        background: var(--p-soft);
        border: 1px solid #dbeafe;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 800;
    }

    /* ===== Komitmen ===== */
    .profile-page .commitment-section {
        padding: 80px 0;
        background:
            radial-gradient(circle at 100% 0%, rgba(96, 165, 250, .14), transparent 32%),
            #f8fbff;
        border-top: 1px solid #eaf0f8;
    }

    .profile-page .commitment-point {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        height: 100%;
        padding: 20px;
        background: #fff;
        border: 1px solid var(--p-border);
        border-radius: 18px;
        transition: transform .2s ease, border-color .2s ease, box-shadow .2s ease;
    }

    .profile-page .commitment-point:hover {
        transform: translateY(-4px);
        border-color: #bfdbfe;
        box-shadow: 0 14px 32px rgba(30, 64, 175, .08);
    }

    .profile-page .point-icon {
        display: flex;
        flex: 0 0 42px;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        color: var(--p-blue);
        background: var(--p-soft);
        border: 1px solid #dbeafe;
        border-radius: 12px;
        font-size: 19px;
        transition: transform .35s ease;
    }

    .profile-page .commitment-point:hover .point-icon {
        transform: rotate(-8deg) scale(1.08);
    }

    .profile-page .commitment-point h4 {
        margin: 2px 0 6px;
        color: var(--p-navy);
        font-size: 1rem;
        font-weight: 800;
        overflow-wrap: anywhere;
    }

    .profile-page .commitment-point p {
        margin: 0;
        color: var(--p-muted);
        font-size: 14px;
        line-height: 1.75;
    }

    /* ===== CTA ===== */
    .profile-page .profile-cta-wrap {
        padding: 70px 0 85px;
        background: #fff;
    }

    .profile-page .profile-cta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        padding: 36px;
        background:
            radial-gradient(circle at 90% 10%, rgba(255, 255, 255, .14), transparent 30%),
            var(--p-gradient);
        border-radius: 22px;
        box-shadow: 0 18px 40px rgba(37, 99, 235, .17);
    }

    .profile-page .profile-cta h2 {
        margin-bottom: 8px;
        color: #fff;
        font-size: clamp(20px, 3vw, 27px);
        font-weight: 800;
        letter-spacing: -.5px;
    }

    .profile-page .profile-cta p {
        max-width: 620px;
        margin-bottom: 0;
        color: rgba(255, 255, 255, .82);
        font-size: 13px;
        line-height: 1.8;
    }

    .profile-page .profile-cta .btn-cta {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        flex-shrink: 0;
        padding: 13px 26px;
        overflow: hidden;
        color: var(--p-blue-dark);
        background: #fff;
        border: 1px solid rgba(255, 255, 255, .7);
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
        text-decoration: none;
        transition: background .2s ease, transform .2s ease;
    }

    .profile-page .profile-cta .btn-cta::after {
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

    .profile-page .profile-cta .btn-cta:hover {
        color: var(--p-blue-dark);
        background: var(--p-soft);
        transform: translateY(-2px);
    }

    .profile-page .profile-cta .btn-cta:hover::after {
        left: 140%;
        transition: left .75s ease;
    }

    /* ===== Responsive ===== */
    @media (max-width: 767.98px) {
        .profile-page .profile-hero {
            padding: 50px 0 55px;
        }

        .profile-page .profile-hero h1 {
            font-size: 1.6rem;
            letter-spacing: -.4px;
        }

        .profile-page .hero-description {
            font-size: 13.5px;
        }

        .profile-page .hero-actions a {
            width: 100%;
        }

        .profile-page .profile-section,
        .profile-page .values-section,
        .profile-page .vision-mission-section,
        .profile-page .commitment-section {
            padding: 55px 0;
        }

        .profile-page .about-visual {
            min-height: 340px;
            border-radius: 17px;
        }

        .profile-page .visual-logo {
            width: 190px;
            height: 190px;
        }

        .profile-page .vision-card {
            padding: 26px;
            border-radius: 17px;
        }

        .profile-page .profile-cta-wrap {
            padding: 50px 0 60px;
        }

        .profile-page .profile-cta {
            align-items: flex-start;
            flex-direction: column;
            padding: 25px;
            border-radius: 17px;
        }

        .profile-page .profile-cta .btn-cta {
            width: 100%;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .profile-page *,
        .profile-page *::before,
        .profile-page *::after {
            animation: none !important;
            transition: none !important;
            scroll-behavior: auto !important;
        }
    }
</style>

<div class="profile-page">

    {{-- HERO --}}
    <section class="profile-hero">
        <div class="container">
            <span class="profile-eyebrow smart-reveal">
                <i class="bi bi-building"></i>
                {{ strtoupper($companyName) }}
            </span>

            <h1>
                <span class="hero-highlight">{{ $heroHighlight }}</span>
                <span class="hero-dark">Mendorong Kemajuan.</span>
            </h1>

            <p class="hero-description smart-reveal smart-delay-2">
                {{ $heroDescription }}
            </p>

            <div class="hero-actions smart-reveal smart-delay-3">
                <a href="{{ route('contact') }}" class="btn-profile-primary">
                    Hubungi Kami
                    <i class="bi bi-arrow-right"></i>
                </a>

                <a href="{{ route('products') }}" class="btn-profile-outline">
                    Jelajahi Layanan
                    <i class="bi bi-arrow-up-right"></i>
                </a>
            </div>

            <div class="hero-note smart-reveal smart-delay-4">
                <i class="bi bi-check-circle-fill"></i>
                Berorientasi pada kebutuhan, kualitas, dan hubungan jangka panjang.
            </div>
        </div>
    </section>

    {{-- TENTANG PERUSAHAAN --}}
    <section class="profile-section">
        <div class="container">
            <div class="row align-items-center g-5">

                <div class="col-lg-5">
                    <div class="about-visual smart-reveal">
                        <div class="visual-logo">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo {{ $companyName }}">
                        </div>

                        <div class="visual-caption">
                            <small>PROFIL PERUSAHAAN</small>
                            <h3>{{ $companyName }}</h3>
                            <p>Koneksi yang kuat, peluang yang lebih luas.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <span class="section-label smart-reveal">
                        <i class="bi bi-info-circle"></i>
                        Tentang Kami
                    </span>

                    <h2 class="section-heading">
                        Tentang {{ $companyName }}
                    </h2>

                    <div class="section-description smart-reveal smart-delay-1">
                        {!! nl2br(e($aboutText)) !!}
                    </div>

                    <div class="about-checklist">
                        @foreach ($profilePoints as $point)
                            <div class="about-check-item smart-reveal {{ $loop->iteration <= 4 ? 'smart-delay-' . $loop->iteration : '' }}">
                                <span class="check-circle" aria-hidden="true">
                                    <i class="bi bi-check-lg"></i>
                                </span>
                                <div>
                                    <strong>{{ $point['title'] }}</strong>
                                    <p>{{ $point['description'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- NILAI PERUSAHAAN --}}
    <section class="values-section">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <span class="section-label smart-reveal">
                        <i class="bi bi-stars"></i>
                        Nilai Kami
                    </span>
                    <h2 class="section-heading">
                        Prinsip yang Menjadi Dasar Kami
                    </h2>
                    <p class="section-description mb-0 smart-reveal smart-delay-1">
                        Kami ingin membangun kerja sama yang bukan hanya berfokus
                        pada hasil, tetapi juga pada proses yang baik dan hubungan
                        yang saling memberikan manfaat.
                    </p>
                </div>
            </div>

            <div class="row g-4">
                @foreach ($profileValues as $value)
                    <div class="col-md-6 col-lg-3">
                        <div class="value-card smart-reveal {{ $loop->iteration <= 4 ? 'smart-delay-' . $loop->iteration : '' }}">
                            <div class="value-icon" aria-hidden="true">
                                <i class="bi {{ $value['icon'] }}"></i>
                            </div>
                            <h3>{{ $value['title'] }}</h3>
                            <p>{{ $value['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- VISI DAN MISI --}}
    <section class="vision-mission-section">
        <div class="container">
            <div class="row align-items-stretch g-4">

                <div class="col-lg-5">
                    <div class="vision-card vision smart-reveal">
                        <span class="vision-tag">ARAH KAMI</span>
                        <h3>Visi Perusahaan</h3>

                        <p>{{ $visionText }}</p>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="vision-card mission smart-reveal smart-delay-2">
                        <span class="vision-tag">LANGKAH KAMI</span>
                        <h3>Misi Perusahaan</h3>

                        <ul class="mission-list">
                            @foreach ($missionItems as $index => $missionItem)
                                <li>
                                    <span>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                    <div>{{ $missionItem }}</div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- KOMITMEN KAMI --}}
    <section class="commitment-section">
        <div class="container">
            <div class="row align-items-center g-5">

                <div class="col-lg-5">
                    <span class="section-label smart-reveal">
                        <i class="bi bi-patch-check"></i>
                        Komitmen Kami
                    </span>

                    <h2 class="section-heading">
                        Kerja Sama yang Dibangun dengan Kepercayaan
                    </h2>

                    <p class="section-description mb-0 smart-reveal smart-delay-1">
                        Kami percaya bahwa hubungan bisnis yang baik berawal
                        dari pemahaman, komunikasi, dan komitmen untuk terus
                        memberikan pelayanan yang lebih baik.
                    </p>
                </div>

                <div class="col-lg-7">
                    <div class="row g-3">
                        @foreach ($profileCommitments as $commitment)
                            <div class="col-md-6">
                                <div class="commitment-point smart-reveal {{ $loop->iteration <= 4 ? 'smart-delay-' . $loop->iteration : '' }}">
                                    <div class="point-icon" aria-hidden="true">
                                        <i class="bi {{ $commitment['icon'] }}"></i>
                                    </div>
                                    <div>
                                        <h4>{{ $commitment['title'] }}</h4>
                                        <p>{{ $commitment['description'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- AJAKAN MENGHUBUNGI --}}
    <section class="profile-cta-wrap">
        <div class="container">
            <div class="profile-cta smart-reveal">
                <div>
                    <h2>Mari Bangun Koneksi yang Lebih Baik</h2>
                    <p>
                        Punya kebutuhan atau ingin mengetahui lebih lanjut
                        tentang layanan kami? Hubungi {{ $companyName }}
                        untuk memulai percakapan dan menemukan peluang kerja sama.
                    </p>
                </div>

                <a href="{{ route('contact') }}" class="btn-cta">
                    Hubungi Kami
                    <i class="bi bi-arrow-up-right"></i>
                </a>
            </div>
        </div>
    </section>

</div>

@endsection