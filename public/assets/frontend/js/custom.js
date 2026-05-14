document.addEventListener("DOMContentLoaded", () => {

    // ── DRAWER ──
    const hamburger = document.getElementById('hamburger');
    const drawer = document.getElementById('drawer');
    const overlay = document.getElementById('drawerOverlay');
    const drawerClose = document.getElementById('drawerClose');
    const nav = document.getElementById('mainNav');

    function openDrawer() {
        if (!drawer || !overlay || !hamburger) return;

        drawer.classList.add('open');
        overlay.classList.add('active');
        hamburger.classList.add('active');
        hamburger.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }

    function closeDrawer() {
        if (!drawer || !overlay || !hamburger) return;

        drawer.classList.remove('open');
        overlay.classList.remove('active');
        hamburger.classList.remove('active');
        hamburger.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    if (hamburger) {
        hamburger.addEventListener('click', () => {
            drawer.classList.contains('open') ? closeDrawer() : openDrawer();
        });
    }

    if (drawerClose) drawerClose.addEventListener('click', closeDrawer);
    if (overlay) overlay.addEventListener('click', closeDrawer);

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && drawer && drawer.classList.contains('open')) {
            closeDrawer();
        }
    });

    // ── NAV SCROLL ──
    if (nav) {
        window.addEventListener('scroll', () => {
            nav.classList.toggle('scrolled', window.scrollY > 50);
        });
    }

    // ── SCROLL REVEAL ──
    const reveals = document.querySelectorAll('.reveal');

    if (reveals.length) {
        const revealObserver = new IntersectionObserver(entries => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('visible');
                    }, i * 70);

                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08 });

        reveals.forEach(el => revealObserver.observe(el));
    }

    // Auto-reveal hero
    document.querySelectorAll('.hero .reveal').forEach(el => {
        setTimeout(() => el.classList.add('visible'), 150);
    });

    // ── FAQ ──
    document.querySelectorAll('.faq-question').forEach(btn => {
        btn.addEventListener('click', () => {
            const item = btn.closest('.faq-item');
            if (!item) return;

            const isOpen = item.classList.contains('open');

            document.querySelectorAll('.faq-item.open').forEach(i => {
                i.classList.remove('open');
            });

            if (!isOpen) item.classList.add('open');
        });
    });

    // ── LIGHTBOX ──
    const lightbox = document.getElementById('videoLightbox');
    const lightboxIframe = document.getElementById('lightboxIframe');
    const closeLightboxBtn = document.getElementById('closeLightbox');

    window.openLightbox = function (el) {
        if (!lightbox || !lightboxIframe) return;

        const src = el.getAttribute('data-video-src');

        if (src) {
            lightboxIframe.src = src;
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    };

    function closeLightbox() {
        if (!lightbox || !lightboxIframe) return;

        lightbox.classList.remove('active');
        lightboxIframe.src = '';
        document.body.style.overflow = '';
    }

    if (closeLightboxBtn) {
        closeLightboxBtn.addEventListener('click', closeLightbox);
    }

    if (lightbox) {
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) closeLightbox();
        });
    }

    // ── IMAGE LIGHTBOX ──
    const imgLightbox = document.getElementById('imageLightbox');
    const lightboxImg = document.getElementById('lightboxImg');
    const lightboxTitle = document.getElementById('lightboxTitle');
    const lightboxCategory = document.getElementById('lightboxCategory');

    window.openImageLightbox = function (el) {
        if (!imgLightbox || !lightboxImg) return;

        const img = el.querySelector('img');
        const title = el.querySelector('h3');
        const category = el.querySelector('span');

        if (img) {
            lightboxImg.src = img.src;
            if (title) lightboxTitle.textContent = title.textContent;
            if (category) lightboxCategory.textContent = category.textContent;

            imgLightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    };

    window.closeImageLightbox = function () {
        if (!imgLightbox) return;
        imgLightbox.classList.remove('active');
        document.body.style.overflow = '';
    };

    if (imgLightbox) {
        imgLightbox.addEventListener('click', (e) => {
            if (e.target === imgLightbox) closeImageLightbox();
        });
    }

    // ── FILTER LOGIC (Mainly for Blog) ──
    const globalFilterBtns = document.querySelectorAll('.filter-btn');
    const globalCards = document.querySelectorAll('.card[data-category]');
    const globalEmptyState = document.getElementById('emptyState');
    const globalVisibleCountEl = document.getElementById('visibleCount');

    if (globalCards.length > 0) {
        // ── MOBILE FILTER TOGGLE (Mainly for Blog) ──
        const mobileFilterToggle = document.getElementById('mobileFilterToggle');
        const mobileFilterPanel = document.getElementById('mobileFilterPanel');

        if (mobileFilterToggle && mobileFilterPanel) {
            mobileFilterToggle.addEventListener('click', () => {
                const isOpen = mobileFilterPanel.classList.toggle('open');
                mobileFilterToggle.setAttribute('aria-expanded', isOpen);
                mobileFilterToggle.classList.toggle('open');
            });

            // Close panel when a filter is clicked
            mobileFilterPanel.querySelectorAll('.filter-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    mobileFilterPanel.classList.remove('open');
                    mobileFilterToggle.classList.remove('open');
                    mobileFilterToggle.setAttribute('aria-expanded', 'false');
                });
            });
        }

        globalFilterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                globalFilterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const filter = btn.getAttribute('data-filter');
                let visible = 0;

                globalCards.forEach(card => {
                    const cats = card.getAttribute('data-category').split(' ');
                    if (filter === 'all' || cats.includes(filter)) {
                        card.classList.remove('hidden');
                        card.classList.add('fade-in');
                        visible++;
                        setTimeout(() => card.classList.remove('fade-in'), 400);
                    } else {
                        card.classList.add('hidden');
                    }
                });

                if (globalEmptyState) globalEmptyState.classList.toggle('show', visible === 0);
                if (globalVisibleCountEl) {
                    globalVisibleCountEl.textContent = visible === 0
                        ? "No articles found"
                        : `Showing ${visible} article${visible === 1 ? "" : "s"}`;
                }
            });
        });
    }

    // ── CONSULT TABS HANDLED IN PAGE SPECIFIC SCRIPTS ──

    // ── FORM SUBMIT HANDLED IN PAGE SPECIFIC SCRIPTS ──

});
// -- PRELOADER HIDE -- 
window.addEventListener('load', () => { 
    const preloader = document.getElementById('preloader'); 
    if (preloader) { 
        // Force preloader to stay for at least 1.5 seconds after load
        setTimeout(() => {
            preloader.classList.add('fade-out'); 
            setTimeout(() => { 
                preloader.style.display = 'none'; 
            }, 600); 
        }, 800); 
    } 
});
