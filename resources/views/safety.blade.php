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
<!-- Hero -->
<section class="relative text-white h-[420px] md:h-[340px] bg-cover bg-center bg-no-repeat"
         aria-label="Safety hero"
         style="background-image: url('{{ asset('images/safety/scover.jpg') }}');">
  <!-- layered overlay for contrast -->
  <div class="absolute inset-0">
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-black/20"></div>
    <div class="absolute inset-0"
         style="background: radial-gradient(115% 70% at 50% 120%, rgba(0,0,0,.45), transparent 60%);"></div>
  </div>

  <!-- centered content -->
  <div class="absolute inset-0 flex items-center justify-center px-6 text-center">
    <div class="relative inline-block">
      <!-- depth/3D back layer -->
    

      <!-- main title -->
      <h1 class="relative text-4xl md:text-5xl font-extrabold tracking-tight leading-tight
                 drop-shadow-[0_8px_24px_rgba(0,0,0,0.55)]">
        Safety, <span class="text-red-500">Health</span> & Environment
      </h1>

      <!-- accent underline -->
      <div class="mx-auto mt-4 h-[3px] w-24 rounded-full bg-gradient-to-r from-red-500 via-red-400 to-red-500"></div>
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
</section>

<!-- Intro / Promise -->
<section class="relative py-16 bg-gradient-to-b from-gray-50 to-white">
  <!-- soft background accents -->
  <div class="pointer-events-none absolute inset-0 opacity-70"
       style="background:
         radial-gradient(60% 40% at 15% 12%, rgba(255,0,0,0.05), transparent 60%),
         radial-gradient(45% 35% at 85% 18%, rgba(0,0,0,0.04), transparent 60%);"></div>

  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
      <div class="lg:col-span-2">
        <h3 class="text-3xl font-extrabold text-gray-900">
          <span class="text-red-600">SAFETY</span> in everything we do
        </h3>

        <div class="mt-5 max-w-[72ch] text-gray-700 space-y-4 text-base leading-7 text-justify">
          <p>SEC’s commitment to safety is one of its core values, along with caring for our employee’s health and wellness. We also care a great deal about the environment in which we operate. This is clear in each and every one of our construction projects.</p>
          <p>Moreover, developing and preserving the environment is evident from our keen attention to conserving resources, especially in the use of water, energy, and recycling in our various project sites.</p>
          <p>We are passionate about excellence and doing our work right. Our reputation depends on our delivered value in the eyes of every client. We are relentless at keeping people safe, in addition to providing a healthy work environment.</p>
          <p>Our investment in training and development of our employees’ welfare, health and concern for their individual growth puts SEC in the lead.</p>
          <p>Such commitment has made SEC an employer of choice to career-minded professionals in the construction business. Team work is one of our highest goals and collective employees’ performance is measured according to their adherence to this effort.</p>
          <p>SEC recognizes the importance of establishing long-term partnerships with its clients. For this purpose, we always ensure to employ state-of-the-art innovative technical solutions in the development and execution of the construction projects.</p>
        </div>
      </div>

      <!-- Feature Image -->
      <aside class="lg:col-span-1">
        <figure class="relative animate-fade-up">
          <div class="overflow-hidden rounded-3xl shadow-2xl ring-1 ring-black/5 bg-gray-50">
            <img
              src="{{ asset('images/safety/vest.jpg') }}"
              alt="Site team demonstrating PPE compliance"
              class="w-full h-80 object-cover transition-transform duration-500 hover:scale-[1.02]"
              loading="lazy"
            />
          </div>
          <figcaption class="mt-3 text-xs text-gray-500 text-center">© Shannon Engineering</figcaption>
        </figure>
      </aside>
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
