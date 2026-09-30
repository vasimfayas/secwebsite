@extends('layouts.app')

@section('title', 'Our Clients - Shannon Engineering Company')

@php
    // Same logos as before; served as optimized WebP copies (originals in public/images/{client,consultant}).
    $logoUrl = fn (string $dir, string $file) => asset('images/optimized/partners/' . $dir . '-' . pathinfo($file, PATHINFO_FILENAME) . '-' . pathinfo($file, PATHINFO_EXTENSION) . '.webp');

    $clients = collect([
        '1.png', '2.jpg', '3.jpg', '4.jpg', '5.jpg',
        '6.png', '7.png', '8.jpg', '9.jpg', '10.jpg',
        '11.jpg', '12.jpg', '13.jpg', '14.jpeg', '15.png', '16.png', '17.webp', '18.png', '19.png', '20.jpeg', '21.png',
    ])->map(fn ($f) => $logoUrl('client', $f));

    $consultants = collect([
        '1.jpg', '2.png', '3.jpg', '4.jpg', '5.jpg',
        '6.jpg', '7.png', '8.jpg', '9.jpg', '10.png',
        '11.jpg', '12.png', '13.jpeg', '14.webp',
    ])->map(fn ($f) => $logoUrl('consultant', $f));

    $half = (int) ceil($clients->count() / 2);
    $marqueeRows = [$clients->take($half)->merge($consultants->take(4)), $clients->slice($half)->merge($consultants->slice(4, 4))];
@endphp

@section('content')

<x-page-hero title="Strategic" highlight="Partners" subtitle="Collaborating with trusted partners to drive growth and deliver excellence." :crumbs="['Strategic Partners' => null]" />

<!-- ============ INTRO + STATS ============ -->
<section class="relative overflow-hidden bg-white pb-6 pt-20 md:pt-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 items-end gap-10 lg:grid-cols-12">
            <div class="lg:col-span-7" data-reveal>
                <p class="eyebrow">Our partners</p>
                <h2 class="section-heading">Trusted By Leading Organizations</h2>
                <p class="section-lead max-w-2xl">
                    We're proud to partner with leading Organization across Qatar, delivering projects that reflected our success, excellence &amp; commitment
                </p>
            </div>
            <dl class="grid grid-cols-3 gap-px overflow-hidden rounded-3xl bg-gray-100 ring-1 ring-gray-100 lg:col-span-5" data-reveal="right">
                @foreach ([
                    ['value' => $clients->count(), 'suffix' => '', 'label' => 'Clients'],
                    ['value' => $consultants->count(), 'suffix' => '', 'label' => 'Consultants'],
                    ['value' => 90, 'suffix' => '+', 'label' => 'Projects'],
                ] as $stat)
                    <div class="bg-white px-4 py-6 text-center">
                        <dd class="font-display text-3xl font-bold text-gray-900 md:text-4xl">
                            <span data-count="{{ $stat['value'] }}">{{ $stat['value'] }}</span><span class="text-red-600">{{ $stat['suffix'] }}</span>
                        </dd>
                        <dt class="mt-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-gray-400">{{ $stat['label'] }}</dt>
                    </div>
                @endforeach
            </dl>
        </div>
    </div>

    <!-- Logo marquee -->
    <div class="group/marquee relative mt-16 space-y-5 [mask-image:linear-gradient(to_right,transparent,black_8%,black_92%,transparent)]" aria-hidden="true">
        @foreach ($marqueeRows as $i => $row)
            <div class="flex w-max gap-5 animate-marquee group-hover/marquee:[animation-play-state:paused] {{ $i === 1 ? '[animation-direction:reverse] [animation-duration:48s]' : '' }}">
                @foreach ([$row, $row] as $copy)
                    @foreach ($copy as $src)
                        <div class="flex h-24 w-44 shrink-0 items-center justify-center rounded-2xl border border-gray-100 bg-white p-4 shadow-sm md:h-28 md:w-52">
                            <img src="{{ $src }}" alt="" decoding="async" class="max-h-full max-w-full object-contain">
                        </div>
                    @endforeach
                @endforeach
            </div>
        @endforeach
    </div>
</section>

<!-- ============ SECTION SWITCH ============ -->
<div class="sticky top-20 z-30 mt-14 border-y border-gray-100 bg-white/90 backdrop-blur-xl"
     x-data="{ active: 'clients' }"
     x-init="
        const io = new IntersectionObserver(es => es.forEach(e => { if (e.isIntersecting) active = e.target.id }), { rootMargin: '-45% 0px -50% 0px' });
        ['clients', 'consultants'].forEach(id => { const el = document.getElementById(id); if (el) io.observe(el); });
     ">
    <nav class="mx-auto flex max-w-7xl justify-center px-4 py-3 sm:px-6 lg:px-8" aria-label="Partner type">
        <div class="flex rounded-full bg-gray-100 p-1">
            @foreach (['clients' => ['Clients', $clients->count()], 'consultants' => ['Consultants', $consultants->count()]] as $id => [$label, $n])
                <a href="#{{ $id }}"
                   class="inline-flex items-center gap-2 rounded-full px-5 py-2 text-sm font-semibold transition-all duration-300"
                   :class="active === '{{ $id }}' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-900'">
                    {{ $label }}
                    <span class="rounded-full px-1.5 text-xs" :class="active === '{{ $id }}' ? 'bg-red-600 text-white' : 'bg-gray-200 text-gray-600'">{{ $n }}</span>
                </a>
            @endforeach
        </div>
    </nav>
</div>

<!-- ============ CLIENTS ============ -->
<section id="clients" class="bg-gray-50 py-20 md:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-12 flex flex-col items-start justify-between gap-4 md:flex-row md:items-end" data-reveal>
            <div>
                <p class="eyebrow">Clients</p>
                <h2 class="section-heading">Organizations we build for</h2>
            </div>
            <p class="max-w-md text-gray-500">Government bodies, developers and leading Qatari brands who trust SEC with their projects.</p>
        </div>

        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:gap-5 lg:grid-cols-5" data-reveal-stagger="45">
            @foreach ($clients as $src)
                <div data-reveal="zoom"
                     class="group relative flex aspect-[3/2] items-center justify-center overflow-hidden rounded-2xl border border-gray-100 bg-white p-5 shadow-[0_1px_2px_rgba(16,24,40,.04)] transition-all duration-500 hover:-translate-y-1 hover:border-red-100 hover:shadow-[0_20px_40px_-20px_rgba(220,38,38,.35)] md:p-6">
                    <img src="{{ $src }}" alt="Client Logo" loading="lazy" decoding="async"
                         class="max-h-full max-w-full object-contain opacity-80 grayscale transition-all duration-500 group-hover:scale-105 group-hover:opacity-100 group-hover:grayscale-0">
                    <span class="absolute inset-x-0 bottom-0 h-0.5 origin-left scale-x-0 bg-gradient-to-r from-red-600 to-orange-400 transition-transform duration-500 group-hover:scale-x-100"></span>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ============ CONSULTANTS ============ -->
<section id="consultants" class="bg-white py-20 md:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-12 flex flex-col items-start justify-between gap-4 md:flex-row md:items-end" data-reveal>
            <div>
                <p class="eyebrow">Consultants</p>
                <h2 class="section-heading">Consultants We Work With</h2>
            </div>
            <p class="max-w-md text-gray-500">
                We proudly collaborate with some of the most reputable consulting firms in Qatar, delivering projects that reflect shared values of success, excellence, and commitment.
            </p>
        </div>

        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:gap-5 lg:grid-cols-4" data-reveal-stagger="45">
            @foreach ($consultants as $src)
                <div data-reveal="zoom"
                     class="group relative flex aspect-[3/2] items-center justify-center overflow-hidden rounded-2xl border border-gray-100 bg-gray-50/60 p-5 transition-all duration-500 hover:-translate-y-1 hover:border-red-100 hover:bg-white hover:shadow-[0_20px_40px_-20px_rgba(220,38,38,.35)] md:p-7">
                    <img src="{{ $src }}" alt="Consulting Logo" loading="lazy" decoding="async"
                         class="max-h-full max-w-full object-contain opacity-80 grayscale mix-blend-multiply transition-all duration-500 group-hover:scale-105 group-hover:opacity-100 group-hover:grayscale-0">
                    <span class="absolute inset-x-0 bottom-0 h-0.5 origin-left scale-x-0 bg-gradient-to-r from-red-600 to-orange-400 transition-transform duration-500 group-hover:scale-x-100"></span>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ============ CTA ============ -->
<section class="bg-white pb-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="relative isolate overflow-hidden rounded-[2rem] bg-gradient-to-br from-red-600 via-red-600 to-orange-500 px-8 py-14 text-white md:px-16 md:py-16" data-reveal="zoom">
            <div class="pointer-events-none absolute inset-0 -z-10 bg-grid opacity-40 [mask-image:radial-gradient(ellipse_at_right,black,transparent_70%)]"></div>
            <div class="pointer-events-none absolute -right-20 -top-20 -z-10 h-72 w-72 rounded-full bg-white/20 blur-3xl"></div>
            <div class="flex flex-col items-start justify-between gap-8 md:flex-row md:items-center">
                <div class="max-w-2xl">
                    <h2 class="font-display text-3xl font-bold text-white md:text-4xl">Join Our Satisfied Clients</h2>
                    <p class="mt-3 text-lg text-white/85">
                        Experience the Shannon Engineering difference. Let us bring your construction vision to life with excellence and innovation.
                    </p>
                </div>
                <a href="{{ route('contact') }}" class="btn shrink-0 bg-white px-8 py-4 text-red-600 shadow-xl hover:-translate-y-0.5 hover:bg-gray-50">
                    Start Your Project
                    <svg class="btn-arrow h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
