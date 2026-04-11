@extends('layouts.app')

@section('title', 'Safety, Health & Environment (HSE) | SEC Qatar')

{{-- ✅ SEO: unique meta description + structured data --}}
@push('meta')
<meta name="description" content="SEC’s Safety, Health & Environment (HSE): zero-harm culture, PPE compliance, stop-work authority, and continuous training to protect people and planet.">
<link rel="canonical" href="{{ url()->current() }}">
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Safety, Health & Environment (HSE)",
  "description": "SEC’s Safety, Health & Environment commitments in Qatar.",
  "publisher": { "@type": "Organization", "name": "SEC" }
}
</script>
@endpush

@section('content')

<!-- Hero Section -->
<section class="relative text-white h-[300px] md:h-[280px] bg-cover bg-center bg-no-repeat"
         aria-label="Our Projects hero"
         style="background-image: url('{{ asset('images/home/skyline.jpg') }}');">

  <!-- Overlays: soft white lift + gentle vignette (better on dark images) -->
  <div class="absolute inset-0">
    <!-- subtle white glow behind center/bottom area -->
    <div class="absolute inset-0"
         style="background:
           radial-gradient(60% 45% at 35% 70%, rgba(255,255,255,0.12), transparent 60%),
           radial-gradient(70% 55% at 65% 80%, rgba(255,255,255,0.08), transparent 65%);">
    </div>
    <!-- light vignette to keep edges rich -->
    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/20 to-transparent"></div>
  </div>

  <!-- Text Content: glass card, bottom-left -->
  <div class="absolute bottom-8 left-6 right-6  md:left-6 md:right-auto">
    <div class="inline-block rounded-2xl backdrop-blur-md bg-white/10 ring-1 ring-white/20 px-5 py-4 shadow-lg">
      <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight leading-tight drop-shadow">
        <span class="bg-clip-text text-transparent bg-gradient-to-br from-white to-gray-200"> Safety, <span class="text-red-500">Health</span> & Environment</span>
      
      </h1>
     
      <div class="mt-3 h-[3px] w-20 rounded-full bg-gradient-to-r from-red-500 via-red-400 to-red-500"></div>
    </div>
  </div>
</section>

<!-- KPI Band (with count-up animation) -->
<section class="py-12 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-center text-xl font-semibold text-gray-900">
      Our <span class="text-red-600">Safety</span> at a glance
    </h2>

    <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
      <!-- Card -->
      <div class="rounded-2xl border border-gray-200 p-6 shadow-sm bg-white transition hover:shadow-lg hover:-translate-y-0.5">
        <div class="text-3xl font-extrabold text-gray-900">
          <span class="countup" data-target="999" data-suffix="+">0</span>
        </div>
        <div class="mt-1 text-xs uppercase tracking-wider text-gray-500">Accident-free days</div>
      </div>

      <div class="rounded-2xl border border-gray-200 p-6 shadow-sm bg-white transition hover:shadow-lg hover:-translate-y-0.5">
        <div class="text-3xl font-extrabold text-gray-900">
          <span class="countup" data-target="100" data-suffix="%">0</span>
        </div>
        <div class="mt-1 text-xs uppercase tracking-wider text-gray-500">PPE compliance</div>
      </div>

      <div class="rounded-2xl border border-gray-200 p-6 shadow-sm bg-white transition hover:shadow-lg hover:-translate-y-0.5">
        <div class="text-3xl font-extrabold text-gray-900">24/7</div>
        <div class="mt-1 text-xs uppercase tracking-wider text-gray-500">Stop-Work Authority</div>
      </div>

      <div class="rounded-2xl border border-gray-200 p-6 shadow-sm bg-white transition hover:shadow-lg hover:-translate-y-0.5">
        <div class="text-3xl font-extrabold text-gray-900">
          <span class="countup" data-target="4">0</span>
        </div>
        <div class="mt-1 text-xs uppercase tracking-wider text-gray-500">HSE Trainings / Month</div>
      </div>
    </div>
  </div>
</section><!-- Intro / Promise -->
<section class="relative py-20 bg-gradient-to-b from-gray-50 to-white overflow-hidden">

  <!-- Background accents -->
  <div class="pointer-events-none absolute inset-0 opacity-60"
       style="background:
       radial-gradient(60% 40% at 15% 12%, rgba(220,38,38,0.08), transparent 60%),
       radial-gradient(45% 35% at 85% 18%, rgba(0,0,0,0.04), transparent 60%);">
  </div>

  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

      <!-- LEFT CONTENT -->
      <div>
        <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight">
          <span class="text-red-600">SAFETY</span> in everything we do
        </h3>

        <div class="mt-6 space-y-5 text-gray-700 text-base leading-7 text-justify max-w-2xl">
          <p>SEC’s commitment to safety is one of its core values, along with caring for our employee’s health and wellness. We also care a great deal about the environment in which we operate.</p>

          <p>Developing and preserving the environment is evident from our attention to conserving resources, especially water, energy, and recycling across project sites.</p>

          <p>We are passionate about excellence and doing our work right. Our reputation depends on delivered value in the eyes of every client.</p>

          <p>We invest heavily in training, employee welfare, and professional growth, making SEC a preferred employer in the construction industry.</p>

          <p>Teamwork and collaboration are core values, ensuring collective performance and long-term success.</p>

          <p>We build long-term partnerships with clients using innovative technical solutions and modern construction practices.</p>
        </div>
      </div>

      <!-- RIGHT VIDEO -->
      <div class="flex justify-center lg:justify-end">

        <div class="w-full max-w-xl rounded-2xl overflow-hidden shadow-2xl border border-gray-100 bg-white">

          <div class="aspect-video">
            <iframe
              class="w-full h-full"
              src="https://www.youtube.com/embed/SYIPYBn0c-4?autoplay=1&mute=1&controls=1&rel=0&modestbranding=1"
              title="HSE Video"
              frameborder="0"
              allow="autoplay; encrypted-media"
              allowfullscreen>
            </iframe>
          </div>

        </div>

      </div>

    </div>

  </div>
</section>
<!-- HSE Pillars -->
<section class="relative py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h3 class="text-2xl font-bold text-gray-900">HSE <span class="text-red-600">Pillars</span></h3>
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="rounded-2xl bg-white shadow-xl ring-1 ring-black/5 p-6 animate-fade-up">
        <div class="text-red-600 font-semibold">1 · Safety Culture</div>
        <p class="mt-3 text-gray-700 text-sm leading-6">Leadership walks. Near-miss learning. KPIs that drive action (TRIR, LTIFR, timely closures).</p>
        <ul class="mt-4 space-y-2 text-sm text-gray-700">
          <li>• Daily toolbox talks & JSA</li>
          <li>• Contractor alignment</li>
          <li>• Behavior observations</li>
        </ul>
      </div>
      <div class="rounded-2xl bg-white shadow-xl ring-1 ring-black/5 p-6 animate-fade-up [animation-delay:120ms]">
        <div class="text-red-600 font-semibold">2 · Health & Wellbeing</div>
        <p class="mt-3 text-gray-700 text-sm leading-6">Heat stress controls, hydration, medical readiness, ergonomics, fatigue management.</p>
        <ul class="mt-4 space-y-2 text-sm text-gray-700">
          <li>• Heat index & rest cycles</li>
          <li>• First-aiders & drills</li>
          <li>• Occupational screening</li>
        </ul>
      </div>
      <div class="rounded-2xl bg-white shadow-xl ring-1 ring-black/5 p-6 animate-fade-up [animation-delay:240ms]">
        <div class="text-red-600 font-semibold">3 · Environment & Sustainability</div>
        <p class="mt-3 text-gray-700 text-sm leading-6">PTW, spill prevention, waste segregation, noise/dust control, emissions tracking.</p>
        <ul class="mt-4 space-y-2 text-sm text-gray-700">
          <li>• LOTO & equipment tagging</li>
          <li>• Spill kits & reporting</li>
          <li>• Waste management</li>
        </ul>
      </div>
    </div>
  </div>
</section>

@endsection

@push('styles')
<style>
/* subtle enter animations (no library) */
@keyframes fadeUp { from { opacity:.0; transform: translateY(12px) } to { opacity:1; transform: translateY(0) } }
.animate-fade-up { animation: fadeUp .7s ease both; }

/* respect reduced motion */
@media (prefers-reduced-motion: reduce) {
  .animate-fade-up { animation: none !important; }
}
</style>
@endpush

@push('scripts')
<script>
/* Count-up animation for .countup elements */
(function() {
  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const els = document.querySelectorAll('.countup');
  if (!els.length) return;

  const animate = el => {
    const end = parseFloat(el.dataset.target || '0');
    const suffix = el.dataset.suffix || '';
    const duration = 1400; // ms
    const startTime = performance.now();
    const startVal = 0;
    const easeOut = t => 1 - Math.pow(1 - t, 3);

    function frame(now) {
      const elapsed = now - startTime;
      const p = Math.min(1, elapsed / duration);
      const val = Math.floor(startVal + (end - startVal) * easeOut(p));
      el.textContent = val.toLocaleString() + suffix;
      if (p < 1) requestAnimationFrame(frame);
    }
    if (prefersReduced) { el.textContent = end.toLocaleString() + suffix; return; }
    requestAnimationFrame(frame);
  };

  const once = new WeakSet();
  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting && !once.has(e.target)) {
        once.add(e.target);
        animate(e.target);
      }
    });
  }, { threshold: 0.35 });

  els.forEach(el => io.observe(el));
})();
</script>
@endpush
