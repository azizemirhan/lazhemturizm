document.addEventListener('DOMContentLoaded', function() {
    /* ═════════════════ HEADER SCROLL ═════════════════ */
    const header = document.getElementById('siteHeader');
    if (header) {
        window.addEventListener('scroll', () => {
            const y = window.scrollY;
            if (y > 20) header.classList.add('scrolled');
            else header.classList.remove('scrolled');
        }, { passive: true });
    }

    /* ═════════════════ MEGA MENUS (DESKTOP) ═════════════════ */
    const megaItems = document.querySelectorAll('.has-mega');
    const backdrop = document.getElementById('megaBackdrop');
    let openTimer, closeTimer;

    function openMega(item) {
        clearTimeout(closeTimer);
        megaItems.forEach(i => {
            if (i !== item) {
                i.classList.remove('is-open');
                const target = document.getElementById('mega' + cap(i.dataset.mega));
                if (target) target.classList.remove('is-open');
                const btn = i.querySelector('.nav-link');
                if (btn) btn.setAttribute('aria-expanded', 'false');
            }
        });
        item.classList.add('is-open');
        const target = document.getElementById('mega' + cap(item.dataset.mega));
        if (target) target.classList.add('is-open');
        if (backdrop) backdrop.classList.add('is-active');
        const btn = item.querySelector('.nav-link');
        if (btn) btn.setAttribute('aria-expanded', 'true');
    }
    function closeAllMega() {
        megaItems.forEach(i => {
            i.classList.remove('is-open');
            const target = document.getElementById('mega' + cap(i.dataset.mega));
            if (target) target.classList.remove('is-open');
            const btn = i.querySelector('.nav-link');
            if (btn) btn.setAttribute('aria-expanded', 'false');
        });
        if (backdrop) backdrop.classList.remove('is-active');
    }
    function cap(s) { return s.charAt(0).toUpperCase() + s.slice(1); }

    megaItems.forEach(item => {
        const target = document.getElementById('mega' + cap(item.dataset.mega));
        item.addEventListener('mouseenter', () => {
            clearTimeout(closeTimer);
            openTimer = setTimeout(() => openMega(item), 80);
        });
        item.addEventListener('mouseleave', () => {
            clearTimeout(openTimer);
            closeTimer = setTimeout(closeAllMega, 220);
        });
        if (target) {
            target.addEventListener('mouseenter', () => clearTimeout(closeTimer));
            target.addEventListener('mouseleave', () => {
                closeTimer = setTimeout(closeAllMega, 220);
            });
        }
        const btn = item.querySelector('.nav-link');
        if (btn) {
            btn.addEventListener('click', (e) => {
                if (btn.tagName === 'A' && !e.target.closest('svg')) return;
                e.preventDefault();
                if (item.classList.contains('is-open')) closeAllMega();
                else openMega(item);
            });
        }
    });
    if (backdrop) backdrop.addEventListener('click', closeAllMega);
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeAllMega(); });

    /* ═════════════════ MOBILE PANEL ═════════════════ */
    const hamburger = document.getElementById('hamburger');
    const mobilePanel = document.getElementById('mobilePanel');
    const closeMobile = document.getElementById('closeMobilePanel');
    const openFromBottom = document.getElementById('openMobileMenu');

    function toggleMobile(open) {
        if (!mobilePanel || !hamburger) return;
        mobilePanel.classList.toggle('open', open);
        hamburger.classList.toggle('active', open);
        hamburger.setAttribute('aria-expanded', open);
        mobilePanel.setAttribute('aria-hidden', !open);
        document.body.style.overflow = open ? 'hidden' : '';
    }
    if (hamburger) hamburger.addEventListener('click', () => toggleMobile(!mobilePanel.classList.contains('open')));
    if (closeMobile) closeMobile.addEventListener('click', () => toggleMobile(false));
    if (openFromBottom) openFromBottom.addEventListener('click', (e) => { e.preventDefault(); toggleMobile(true); });

    document.querySelectorAll('.mobile-panel__nav .m-nav-toggle').forEach(btn => {
        if (btn.tagName !== 'BUTTON') return;
        btn.addEventListener('click', () => {
            const item = btn.closest('.m-nav-item');
            const wasOpen = item.classList.contains('open');
            document.querySelectorAll('.mobile-panel__nav .m-nav-item.open').forEach(i => i.classList.remove('open'));
            if (!wasOpen) item.classList.add('open');
        });
    });

    /* ═════════════════ TOUR SLIDER ═════════════════ */
    (function () {
        const viewport = document.getElementById('sliderViewport');
        const prev = document.getElementById('sliderPrev');
        const next = document.getElementById('sliderNext');
        const counter = document.getElementById('sliderCount');
        if (!viewport || !prev || !next) return;

        const track = viewport.querySelector('.slider__track');
        if (!track) return;
        
        function getStep() {
            const firstCard = track.firstElementChild;
            if (!firstCard) return 0;
            const gap = parseFloat(getComputedStyle(track).gap) || 0;
            return firstCard.offsetWidth + gap;
        }

        function currentIndex() {
            const step = getStep();
            if (step === 0) return 0;
            return Math.round(viewport.scrollLeft / step);
        }

        function updateUI() {
            const total = track.children.length;
            const idx = currentIndex();
            const padded = String(idx + 1).padStart(2, '0');
            const totalPadded = String(total).padStart(2, '0');
            if (counter) counter.innerHTML = `${padded} <em>/ ${totalPadded}</em>`;

            prev.disabled = viewport.scrollLeft <= 4;
            next.disabled = viewport.scrollLeft >= viewport.scrollWidth - viewport.clientWidth - 4;
        }

        prev.addEventListener('click', () => {
            viewport.scrollBy({ left: -getStep(), behavior: 'smooth' });
        });
        next.addEventListener('click', () => {
            viewport.scrollBy({ left: getStep(), behavior: 'smooth' });
        });

        let scrollTimer;
        viewport.addEventListener('scroll', () => {
            clearTimeout(scrollTimer);
            scrollTimer = setTimeout(updateUI, 80);
        }, { passive: true });

        viewport.setAttribute('tabindex', '0');
        viewport.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight') { e.preventDefault(); next.click(); }
            if (e.key === 'ArrowLeft') { e.preventDefault(); prev.click(); }
        });

        let isDown = false, startX = 0, startScroll = 0;
        viewport.addEventListener('mousedown', (e) => {
            if (e.target.closest('a, button, input')) return;
            isDown = true;
            startX = e.pageX;
            startScroll = viewport.scrollLeft;
            viewport.style.cursor = 'grabbing';
            viewport.style.scrollBehavior = 'auto';
        });
        window.addEventListener('mouseup', () => {
            if (!isDown) return;
            isDown = false;
            viewport.style.cursor = '';
            viewport.style.scrollBehavior = '';
        });
        window.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            viewport.scrollLeft = startScroll - (e.pageX - startX) * 1.2;
        });

        window.addEventListener('resize', updateUI);
        updateUI();
    })();

    /* ═════════ Bungalov Tab Switcher ═════════ */
    (function () {
        const tabs = document.querySelectorAll('.bn-tab');
        const showcases = document.querySelectorAll('.bn-showcase');
        const counter = document.getElementById('bnCurrent');
        if (!tabs.length) return;

        tabs.forEach((tab, idx) => {
            tab.addEventListener('click', () => {
                const id = tab.dataset.bn;
                tabs.forEach(t => t.classList.toggle('active', t === tab));
                showcases.forEach(s => s.classList.toggle('active', s.dataset.show === id));
                if (counter) {
                    const num = String(idx + 1).padStart(2, '0');
                    counter.innerHTML = `${num} <em>/ ${String(tabs.length).padStart(2, '0')}</em>`;
                }
            });
        });
    })();

    /* ═════════ Misc Interactions ═════════ */
    document.querySelectorAll('.fchip').forEach(chip => {
        chip.addEventListener('click', () => chip.classList.toggle('active'));
    });
    document.querySelectorAll('.ftoggle').forEach(t => {
        t.addEventListener('click', () => t.classList.toggle('active'));
    });
});
