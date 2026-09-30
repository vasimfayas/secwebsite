import './bootstrap';

const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

/**
 * Scroll reveal: any element with [data-reveal] fades/slides in once it enters the viewport.
 * Children of [data-reveal-stagger] get an incremental delay.
 */
function initReveal() {
    document.querySelectorAll('[data-reveal-stagger]').forEach((group) => {
        const step = Number(group.dataset.revealStagger) || 90;
        group.querySelectorAll(':scope > [data-reveal]').forEach((el, i) => {
            el.style.setProperty('--reveal-delay', `${i * step}ms`);
        });
    });

    const items = document.querySelectorAll('[data-reveal]:not(.is-visible)');
    if (reducedMotion || !('IntersectionObserver' in window)) {
        items.forEach((el) => el.classList.add('is-visible'));
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });

    items.forEach((el) => observer.observe(el));
}

/**
 * Animated counters: <span data-count="90">0</span> counts up when visible.
 */
function initCounters() {
    const counters = document.querySelectorAll('[data-count]');
    if (!counters.length) return;

    const run = (el) => {
        const target = Number(el.dataset.count);
        if (reducedMotion) {
            el.textContent = target.toLocaleString();
            return;
        }
        const duration = 1800;
        const start = performance.now();
        const tick = (now) => {
            const p = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - p, 3);
            el.textContent = Math.round(target * eased).toLocaleString();
            if (p < 1) requestAnimationFrame(tick);
        };
        requestAnimationFrame(tick);
    };

    if (!('IntersectionObserver' in window)) {
        counters.forEach(run);
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                run(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.4 });

    counters.forEach((el) => observer.observe(el));
}

/**
 * Lightweight YouTube embed: shows a thumbnail and only loads the heavy iframe on click.
 * <button data-youtube="VIDEO_ID">…</button>
 */
function initYoutubeFacades() {
    document.querySelectorAll('[data-youtube]').forEach((el) => {
        el.addEventListener('click', () => {
            const id = el.dataset.youtube;
            const iframe = document.createElement('iframe');
            iframe.src = `https://www.youtube-nocookie.com/embed/${id}?autoplay=1&rel=0&modestbranding=1`;
            iframe.title = el.getAttribute('aria-label') || 'YouTube video';
            iframe.allow = 'autoplay; encrypted-media; picture-in-picture';
            iframe.allowFullscreen = true;
            iframe.referrerPolicy = 'strict-origin-when-cross-origin';
            iframe.className = 'absolute inset-0 h-full w-full';
            el.replaceWith(iframe);
        }, { once: true });
    });
}

function boot() {
    document.documentElement.classList.remove('no-js');
    initReveal();
    initCounters();
    initYoutubeFacades();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
} else {
    boot();
}

// Re-run after Livewire navigations/updates so new content animates too.
document.addEventListener('livewire:navigated', boot);
