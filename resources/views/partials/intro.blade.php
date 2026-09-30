{{--
    First-visit launcher: shown once per browser session, before the page is revealed.
    Enabled by the inline script in <head> (adds .intro-active to <html>), so it never
    flashes for returning visitors or when JavaScript is off.
--}}
@php $introLogo = asset('images/optimized/logo-light-320.webp'); @endphp

<div id="intro" aria-hidden="true">
    <div class="intro-glow"></div>
    <div class="intro-inner">
        <div class="intro-logo-wrap">
            <img src="{{ $introLogo }}" alt="" class="intro-logo" width="220" height="140" decoding="sync" fetchpriority="high">
            <span class="intro-shine" style="-webkit-mask-image:url('{{ $introLogo }}'); mask-image:url('{{ $introLogo }}');"></span>
        </div>
        <p class="intro-tagline">
            <span>Success</span><i></i><span>Excellence</span><i></i><span>Commitment</span>
        </p>
        <div class="intro-bar"><span></span></div>
    </div>
</div>

<script>
    (function () {
        var root = document.documentElement;
        if (!root.classList.contains('intro-active')) {
            var el = document.getElementById('intro');
            if (el) el.remove();
            return;
        }

        var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        var MIN = reduce ? 300 : 1900;   // let the logo animation play out
        var MAX = 3500;                  // hard cap, whatever happens
        var start = performance.now();
        var finished = false;

        function finish() {
            if (finished) return;
            finished = true;
            var wait = Math.max(0, MIN - (performance.now() - start));
            setTimeout(function () {
                root.classList.add('intro-leaving');
                root.classList.remove('intro-active');   // hero animations start as the curtain lifts
                setTimeout(function () {
                    root.classList.remove('intro-leaving');
                    var el = document.getElementById('intro');
                    if (el) el.remove();
                }, reduce ? 250 : 1000);
            }, wait);
        }

        // Leave once the page is parsed (the hero image is preloaded with high priority);
        // don't wait for every image, video thumbnail or map on the page.
        if (document.readyState !== 'loading') finish();
        else document.addEventListener('DOMContentLoaded', finish);
        setTimeout(finish, MAX);
    })();
</script>
