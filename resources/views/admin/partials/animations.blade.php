<style>
    @keyframes adm-up {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: none; }
    }

    @keyframes adm-row {
        from { opacity: 0; transform: translateX(-16px); }
        to   { opacity: 1; transform: none; }
    }

    @keyframes adm-pop {
        from { opacity: 0; transform: scale(.5) rotate(-10deg); }
        to   { opacity: 1; transform: none; }
    }

    @keyframes adm-drop {
        from { opacity: 0; transform: translateY(-14px); }
        to   { opacity: 1; transform: none; }
    }

    @keyframes adm-float {
        0%, 100% { transform: translateY(0); }
        50%      { transform: translateY(-5px); }
    }

    @keyframes adm-pulse {
        0%   { box-shadow: 0 0 0 0 rgba(37, 99, 235, .45); }
        100% { box-shadow: 0 0 0 8px rgba(37, 99, 235, 0); }
    }

    /* ---------- Header halaman ---------- */
    .admin-heading {
        animation: adm-up .6s cubic-bezier(.2, .8, .2, 1) both;
    }

    /* ---------- Panel daftar (produk, artikel, pesan) ---------- */
    .product-panel,
    .article-panel,
    .msg-panel {
        animation: adm-up .7s cubic-bezier(.2, .8, .2, 1) .1s both;
    }

    .product-panel-icon,
    .article-panel-icon,
    .msg-panel-icon,
    .product-empty-icon,
    .article-empty-icon,
    .msg-empty-icon {
        animation: adm-pop .6s cubic-bezier(.2, .8, .2, 1) .3s both;
    }

    .product-empty-icon,
    .article-empty-icon,
    .msg-empty-icon {
        animation: adm-pop .6s cubic-bezier(.2, .8, .2, 1) .3s both,
                   adm-float 3.5s ease-in-out 1s infinite;
    }

    /* ---------- Baris tabel muncul bergantian ---------- */
    :is(.product-modern-table, .article-modern-table, .msg-table) tbody tr {
        animation: adm-row .5s cubic-bezier(.2, .8, .2, 1) both;
        animation-delay: calc(.25s + var(--r, 0) * .06s);
    }

    :is(.product-modern-table, .article-modern-table, .msg-table) tbody tr:nth-child(1)  { --r: 0; }
    :is(.product-modern-table, .article-modern-table, .msg-table) tbody tr:nth-child(2)  { --r: 1; }
    :is(.product-modern-table, .article-modern-table, .msg-table) tbody tr:nth-child(3)  { --r: 2; }
    :is(.product-modern-table, .article-modern-table, .msg-table) tbody tr:nth-child(4)  { --r: 3; }
    :is(.product-modern-table, .article-modern-table, .msg-table) tbody tr:nth-child(5)  { --r: 4; }
    :is(.product-modern-table, .article-modern-table, .msg-table) tbody tr:nth-child(6)  { --r: 5; }
    :is(.product-modern-table, .article-modern-table, .msg-table) tbody tr:nth-child(7)  { --r: 6; }
    :is(.product-modern-table, .article-modern-table, .msg-table) tbody tr:nth-child(8)  { --r: 7; }
    :is(.product-modern-table, .article-modern-table, .msg-table) tbody tr:nth-child(9)  { --r: 8; }
    :is(.product-modern-table, .article-modern-table, .msg-table) tbody tr:nth-child(n+10) { --r: 9; }

    /* ---------- Tombol aksi ---------- */
    .product-btn,
    .article-btn,
    .msg-btn {
        transition: all .18s ease, transform .18s ease;
    }

    .product-btn:hover,
    .article-btn:hover,
    .msg-btn:hover {
        transform: translateY(-2px);
    }

    .product-create-btn,
    .article-create-btn,
    .msg-btn-main {
        position: relative;
        overflow: hidden;
    }

    .product-create-btn::before,
    .article-create-btn::before,
    .msg-btn-main::before {
        position: absolute;
        top: 0;
        left: -120%;
        width: 55%;
        height: 100%;
        background: linear-gradient(100deg, transparent, rgba(255, 255, 255, .32), transparent);
        content: "";
        transform: skewX(-20deg);
        transition: left .6s ease;
        pointer-events: none;
    }

    .product-create-btn:hover::before,
    .article-create-btn:hover::before,
    .msg-btn-main:hover::before {
        left: 140%;
    }

    /* ---------- Pesan masuk ---------- */
    .msg-avatar {
        animation: adm-pop .5s cubic-bezier(.2, .8, .2, 1) .35s both;
    }

    .msg-status-new .msg-status-dot {
        animation: adm-pulse 1.8s ease-out infinite;
    }

    .msg-alert {
        animation: adm-drop .5s cubic-bezier(.2, .8, .2, 1) both;
    }

    /* ---------- Galeri ---------- */
    .adm-card {
        animation: adm-up .6s cubic-bezier(.2, .8, .2, 1) both;
        animation-delay: calc(.1s + min(var(--i, 0), 8) * .07s);
    }

    .adm-card .panel {
        transition: transform .28s ease, box-shadow .28s ease, border-color .28s ease;
    }

    .adm-card .panel:hover {
        transform: translateY(-6px);
        border-color: #bfdbfe;
        box-shadow: 0 18px 38px rgba(37, 99, 235, .12);
    }

    .adm-thumb {
        overflow: hidden;
        border-radius: .375rem;
    }

    .adm-thumb img {
        display: block;
        transition: transform .5s ease;
    }

    .adm-card .panel:hover .adm-thumb img {
        transform: scale(1.06);
    }

    /* ---------- Muncul saat di-scroll (profil, dll.) ---------- */
    .adm-scroll {
        opacity: 0;
        transform: translateY(26px);
        transition: opacity .7s cubic-bezier(.2, .8, .2, 1),
                    transform .7s cubic-bezier(.2, .8, .2, 1);
    }

    .adm-scroll.is-in {
        opacity: 1;
        transform: none;
    }

    .adm-icon {
        transition: transform .3s ease;
    }

    .adm-scroll.is-in .adm-icon {
        animation: adm-pop .6s cubic-bezier(.2, .8, .2, 1) .2s both;
    }

    .adm-scroll:hover .adm-icon {
        transform: rotate(-8deg) scale(1.08);
    }

    .adm-subcard {
        transition: border-color .25s ease, box-shadow .25s ease, transform .25s ease;
    }

    .adm-subcard:hover {
        border-color: #bfdbfe !important;
        box-shadow: 0 10px 24px rgba(37, 99, 235, .08);
        transform: translateY(-3px);
    }

    .adm-scroll .form-control {
        transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
    }

    .adm-scroll .btn {
        transition: transform .2s ease, box-shadow .2s ease,
            background .2s ease, color .2s ease, border-color .2s ease;
    }

    .adm-scroll .btn:hover {
        transform: translateY(-2px);
    }

    @media (prefers-reduced-motion: reduce) {
        .admin-heading,
        .product-panel,
        .article-panel,
        .msg-panel,
        .product-panel-icon,
        .article-panel-icon,
        .msg-panel-icon,
        .product-empty-icon,
        .article-empty-icon,
        .msg-empty-icon,
        :is(.product-modern-table, .article-modern-table, .msg-table) tbody tr,
        .msg-avatar,
        .msg-status-new .msg-status-dot,
        .msg-alert,
        .adm-card,
        .adm-scroll.is-in .adm-icon {
            animation: none !important;
        }

        .adm-scroll {
            opacity: 1;
            transform: none;
            transition: none;
        }

        .product-btn:hover,
        .article-btn:hover,
        .msg-btn:hover,
        .adm-card .panel:hover,
        .adm-card .panel:hover .adm-thumb img,
        .adm-subcard:hover,
        .adm-scroll:hover .adm-icon,
        .adm-scroll .btn:hover {
            transform: none;
        }
    }
</style>

<noscript>
    <style>
        .adm-scroll {
            opacity: 1 !important;
            transform: none !important;
        }
    </style>
</noscript>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var items = document.querySelectorAll('.adm-scroll');
    if (!items.length) return;

    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Tanpa animasi / browser lama: tampilkan semuanya langsung
    if (reduceMotion || !('IntersectionObserver' in window)) {
        items.forEach(function (el) {
            el.classList.add('is-in');
        });
        return;
    }

    var observer = new IntersectionObserver(function (entries, obs) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-in');
                obs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.08, rootMargin: '0px 0px -30px 0px' });

    items.forEach(function (el) {
        observer.observe(el);
    });
});
</script>