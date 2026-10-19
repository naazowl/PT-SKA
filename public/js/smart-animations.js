(function () {
    'use strict';

    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function ready(callback) {
        if (document.readyState !== 'loading') {
            callback();
        } else {
            document.addEventListener('DOMContentLoaded', callback);
        }
    }

    /* Pecah teks judul menjadi kata-kata, tanpa merusak span di dalamnya */
    function splitTitle(el) {
        var label = el.textContent.replace(/\s+/g, ' ').trim();
        var index = 0;

        el.setAttribute('aria-label', label);

        function walk(node) {
            Array.from(node.childNodes).forEach(function (child) {
                if (child.nodeType === 3) {
                    var parts = child.textContent.split(/(\s+)/);
                    var frag = document.createDocumentFragment();

                    parts.forEach(function (part) {
                        if (part === '') return;

                        if (/^\s+$/.test(part)) {
                            frag.appendChild(document.createTextNode(' '));
                        } else {
                            var word = document.createElement('span');
                            word.className = 'smart-word';
                            word.setAttribute('aria-hidden', 'true');

                            var inner = document.createElement('span');
                            inner.className = 'smart-word-inner';
                            inner.style.setProperty('--w', index++);
                            inner.textContent = part;

                            word.appendChild(inner);
                            frag.appendChild(word);
                        }
                    });

                    child.parentNode.replaceChild(frag, child);
                } else if (child.nodeType === 1 && child.tagName !== 'BR') {
                    walk(child);
                }
            });
        }

        walk(el);
        el.classList.add('smart-split');
    }

    ready(function () {
        var revealItems = document.querySelectorAll('.smart-reveal');

        // Tanpa animasi: tampilkan semua konten langsung
        if (reduceMotion || !('IntersectionObserver' in window)) {
            revealItems.forEach(function (el) {
                el.classList.add('is-visible');
            });
            return;
        }

        /* 1. Muncul saat di-scroll */
        var observer = new IntersectionObserver(function (entries, obs) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -30px 0px' });

        revealItems.forEach(function (el) {
            observer.observe(el);
        });

        /* 2. Animasi judul kata demi kata (hanya halaman publik) */
        if (!document.querySelector('.admin-shell')) {
                var titles = document.querySelectorAll(
                                    '[data-smart-title], section.hero h1, .section-heading h2, .cta-band h2, ' +
                                    '.products-hero h1, .articles-hero h1, .gallery-hero h1, .profile-hero h1, ' +
                                    'h2.section-heading, .profile-cta h2, .vision-card h3, ' +
                                    '.products-section-heading h2, .product-detail-title, .product-detail-cta h2, ' +
                                    '.articles-section-heading h2, .article-detail-title, .article-detail-cta h2'
                                );

            var titleObserver = new IntersectionObserver(function (entries, obs) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('smart-title-in');
                        obs.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.3, rootMargin: '0px 0px -20px 0px' });

            titles.forEach(function (title) {
                if (title.classList.contains('smart-split')) return;
                splitTitle(title);
                titleObserver.observe(title);
            });
        }

        /* 3. Angka progres naik dari 0 (mis. 78%) */
        var progress = document.querySelector('section.hero .progress');

        if (progress && progress.nextElementSibling) {
            var label = progress.nextElementSibling.querySelector('span:last-child');
            var match = label ? label.textContent.match(/(\d+)\s*%/) : null;

            if (match) {
                var target = parseInt(match[1], 10);
                var start = null;
                label.textContent = '0%';

                var step = function (ts) {
                    if (start === null) start = ts;
                    var p = Math.min((ts - start) / 1600, 1);
                    var eased = 1 - Math.pow(1 - p, 3);
                    label.textContent = Math.round(target * eased) + '%';
                    if (p < 1) requestAnimationFrame(step);
                };

                setTimeout(function () {
                    requestAnimationFrame(step);
                }, 900);
            }
        }

        /* 4. Bar progres scroll + parallax hero (hanya halaman publik) */
        if (!document.querySelector('.admin-shell')) {
            var bar = document.createElement('div');
            bar.className = 'smart-scroll-progress';
            document.body.appendChild(bar);

                 var hero = document.querySelector(
                'section.hero, .gallery-hero, .products-hero, .product-detail-hero, .articles-hero, .article-detail-hero'
            );
            var ticking = false;

            var onScroll = function () {
                if (ticking) return;
                ticking = true;

                requestAnimationFrame(function () {
                    var top = window.pageYOffset || document.documentElement.scrollTop;
                    var max = document.documentElement.scrollHeight - window.innerHeight;
                    var ratio = max > 0 ? Math.min(top / max, 1) : 0;

                    bar.style.transform = 'scaleX(' + ratio + ')';

                    if (hero && top < window.innerHeight * 1.5) {
                        hero.style.setProperty('--py', (top * 0.18) + 'px');
                    }

                    ticking = false;
                });
            };

            window.addEventListener('scroll', onScroll, { passive: true });
            onScroll();
        }

        /* 5. Cahaya mengikuti kursor pada kartu (perangkat dengan mouse) */
        if (window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
            var cards = document.querySelectorAll(
                '.home-service-card, .home-article-card, .products-card, .articles-card, .gallery-card'
            );

            cards.forEach(function (card) {
                card.addEventListener('pointermove', function (e) {
                    var rect = card.getBoundingClientRect();
                    card.style.setProperty('--mx', (e.clientX - rect.left) + 'px');
                    card.style.setProperty('--my', (e.clientY - rect.top) + 'px');
                });
            });
        }
    });
})();