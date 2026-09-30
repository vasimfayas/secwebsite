@extends('layouts.app')

@section('title', 'Shannon Engineering Company - Building Qatar\'s Future with Excellence and Innovation')

@php
    use Illuminate\Support\Str;

    $heroSlides = ['shaqab', 'mosque', 'villa', 'compound', 'lexus', 'home1', 'lulu'];
    $heroUrls = collect($heroSlides)->map(fn ($name) => [
        'src' => asset("images/optimized/{$name}-1920.webp"),
        'srcset' => asset("images/optimized/{$name}-960.webp") . ' 960w, ' . asset("images/optimized/{$name}-1920.webp") . ' 1920w',
    ]);

    $stats = [
        ['value' => 90,  'suffix' => '',  'label' => 'Projects Completed'],
        ['value' => 25,  'suffix' => '',  'label' => 'Years Experience'],
        ['value' => 85,  'suffix' => '+', 'label' => 'Happy Clients'],
        ['value' => 60,  'suffix' => '+', 'label' => 'Engineers & Staff'],
        ['value' => 500, 'suffix' => '+', 'label' => 'Labours'],
    ];

    $services = [
        ['title' => 'General Contracting', 'text' => 'Complete construction solutions from planning to execution.',
         'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 18h18M5 18v-3a7 7 0 0 1 14 0v3M12 8V5m-3 3.5V6.2M15 8.5V6.2"/>'],
        ['title' => 'Construction', 'text' => 'Residential and commercial buildings built with precision.',
         'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/>'],
        ['title' => 'Design & Build', 'text' => 'Smart design combined with efficient project execution.',
         'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2m0 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-1.2 3.6L5 21m7.2-12.4L19 21M7.5 16.5h9"/>'],
        ['title' => 'Facilities Management', 'text' => 'Ongoing maintenance and support for building performance.',
         'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z"/>'],
        ['title' => 'Interior Design', 'text' => 'Custom interior solutions that blend style and functionality. Transforming spaces with creative, modern interior solutions.',
         'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 11V8a3 3 0 0 1 3-3h10a3 3 0 0 1 3 3v3M3 16v-3a2 2 0 1 1 4 0v1h10v-1a2 2 0 1 1 4 0v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm2 2v2m14-2v2"/>'],
    ];

    $reasons = [
        ['title' => 'Expertise & Experience', 'text' => 'Decades of proven experience in the construction industry, our highly skilled team delivers knowledge and hands on expertise to every project we undertake.'],
        ['title' => 'Quality & Precision', 'text' => 'We maintain the highest standards of quality and precision in all our construction and engineering work. Ensuring every detail reflects the trust placed in us.'],
        ['title' => 'Timely Delivery', 'text' => 'We understand the importance of timelines and ensure that all our projects are guaranteed for on-schedule delivery.'],
        ['title' => 'Client Satisfaction', 'text' => 'Our client-centric approach ensures that we not only meet but also exceed expectations by listening, understanding, and anticipating their needs. We consistently deliver beyond expectations and build long-term partnerships based on trust.'],
    ];
@endphp

@push('preload')
    <link rel="preload" as="image" href="{{ $heroUrls[0]['src'] }}" imagesrcset="{{ $heroUrls[0]['srcset'] }}" imagesizes="100vw" fetchpriority="high">
@endpush

@section('content')

<!-- ============ HERO ============ -->
<section
    x-data="{
        slides: @js($heroUrls),
        current: 0,
        loaded: [0, 1],
        duration: 6500,
        timer: null,
        paused: false,
        go(i) {
            const n = this.slides.length;
            this.current = (i + n) % n;
            const ahead = (this.current + 1) % n;
            if (!this.loaded.includes(ahead)) this.loaded.push(ahead);
            this.restart();
        },
        next() { this.go(this.current + 1) },
        prev() { this.go(this.current - 1) },
        restart() {
            clearTimeout(this.timer);
            if (!this.paused) this.timer = setTimeout(() => this.next(), this.duration);
        },
        init() {
            this.restart();
            document.addEventListener('visibilitychange', () => {
                this.paused = document.hidden;
                this.restart();
            });
        }
    }"
    @keydown.left.window="prev()" @keydown.right.window="next()"
    class="relative isolate flex min-h-[100svh] items-center overflow-hidden bg-ink-900 text-white"
    aria-roledescription="carousel" aria-label="Featured projects"
>
    <!-- Slides -->
    <div class="absolute inset-0 -z-20">
        <template x-for="(slide, i) in slides" :key="i">
            <div class="absolute inset-0 transition-opacity duration-[1400ms] ease-out"
                 :class="current === i ? 'opacity-100' : 'opacity-0'" :aria-hidden="current !== i">
                <img :src="loaded.includes(i) ? slide.src : null"
                     :srcset="loaded.includes(i) ? slide.srcset : null"
                     sizes="100vw" alt="" decoding="async"
                     :fetchpriority="i === 0 ? 'high' : 'low'"
                     class="h-full w-full object-cover"
                     :class="current === i && 'animate-ken-burns'">
            </div>
        </template>
        {{-- First slide is server rendered so it paints before Alpine boots --}}
        <img src="{{ $heroUrls[0]['src'] }}" srcset="{{ $heroUrls[0]['srcset'] }}" sizes="100vw" alt=""
             fetchpriority="high" class="absolute inset-0 -z-10 h-full w-full object-cover">
    </div>

    <!-- Overlays -->
    <div class="absolute inset-0 -z-10 bg-gradient-to-r from-ink-900/90 via-ink-900/55 to-ink-900/10"></div>
    <div class="absolute inset-0 -z-10 bg-gradient-to-t from-ink-900 via-transparent to-ink-900/40"></div>
    <div class="absolute inset-0 -z-10 bg-grid opacity-40 [mask-image:radial-gradient(ellipse_at_left,black,transparent_65%)]"></div>

    <!-- Content -->
    <div class="mx-auto w-full max-w-7xl px-5 pb-40 pt-36 sm:px-6 lg:px-8">
        <p class="eyebrow animate-fade-up text-yellow-400 [animation-delay:.1s]">Qatar's Trusted Contractor</p>

        <h1 class="mt-6 font-display font-bold leading-[0.95] text-white" style="font-size: clamp(3rem, 8vw, 6.75rem);">
            <span class="block overflow-hidden pb-2"><span class="block animate-rise [animation-delay:.2s]"><span class="text-red-500">S</span>uccess</span></span>
            <span class="block overflow-hidden pb-2"><span class="block animate-rise [animation-delay:.35s]"><span class="text-red-500">E</span>xcellence</span></span>
            <span class="block overflow-hidden pb-2"><span class="block animate-rise [animation-delay:.5s]"><span class="text-red-500">C</span>ommitment</span></span>
        </h1>

        <p class="mt-8 max-w-lg animate-fade-up text-lg font-medium leading-relaxed text-white/75 [animation-delay:.7s] md:text-xl">
            Grade A Construction Company Operating in Qatar
        </p>

        <div class="mt-10 flex flex-wrap gap-4 animate-fade-up [animation-delay:.85s]">
            <a href="{{ route('projects') }}" class="btn-primary px-8 py-4 uppercase tracking-widest">
                Explore Our Projects
                <svg class="btn-arrow h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            <a href="{{ route('about') }}" class="btn-ghost px-8 py-4 uppercase tracking-widest">
                About Us
            </a>
        </div>
    </div>

    <!-- Controls -->
    <div class="absolute inset-x-0 bottom-0">
        <div class="mx-auto flex max-w-7xl items-end justify-between gap-6 px-5 pb-8 sm:px-6 md:pb-10 lg:px-8">
            <div class="flex items-center gap-5">
                <div class="flex gap-2">
                    <button type="button" @click="prev()" aria-label="Previous slide"
                            class="flex h-12 w-12 items-center justify-center rounded-full border border-white/25 bg-white/5 backdrop-blur transition hover:border-white hover:bg-white hover:text-gray-900">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button type="button" @click="next()" aria-label="Next slide"
                            class="flex h-12 w-12 items-center justify-center rounded-full border border-white/25 bg-white/5 backdrop-blur transition hover:border-white hover:bg-white hover:text-gray-900">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
                <p class="hidden font-display text-sm tabular-nums text-white/60 sm:block">
                    <span class="text-2xl font-semibold text-white" x-text="String(current + 1).padStart(2, '0')">01</span>
                    / <span x-text="String(slides.length).padStart(2, '0')">07</span>
                </p>
            </div>

            <!-- Progress segments -->
            <div class="flex max-w-xs flex-1 gap-1.5 sm:max-w-sm">
                <template x-for="(slide, i) in slides" :key="'bar' + i">
                    <button type="button" @click="go(i)" :aria-label="'Go to slide ' + (i + 1)"
                            class="group relative h-6 flex-1">
                        <span class="absolute inset-x-0 top-1/2 h-[3px] -translate-y-1/2 overflow-hidden rounded-full bg-white/20 transition group-hover:bg-white/40">
                            <span class="absolute inset-y-0 left-0 rounded-full bg-yellow-400"
                                  :style="current === i
                                      ? `width:100%; transition: width ${duration}ms linear`
                                      : (i < current ? 'width:100%; transition:none' : 'width:0; transition:none')"></span>
                        </span>
                    </button>
                </template>
            </div>

            <!-- Scroll cue -->
            <a href="#about" class="hidden flex-col items-center gap-2 text-[10px] font-semibold uppercase tracking-[0.3em] text-white/60 transition hover:text-white lg:flex">
                <span class="flex h-10 w-6 justify-center rounded-full border-2 border-white/40 pt-2">
                    <span class="h-2 w-1 animate-scroll-dot rounded-full bg-white"></span>
                </span>
                Scroll
            </a>
        </div>
    </div>
</section>

<!-- ============ STATS ============ -->
<section class="relative z-10 -mt-px bg-ink-900 pb-16 text-white md:pb-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 gap-px overflow-hidden rounded-3xl bg-white/10 ring-1 ring-white/10 md:grid-cols-5" data-reveal-stagger>
            @foreach($stats as $stat)
                <div class="bg-ink-900 px-6 py-8 text-center md:py-10 {{ $loop->last ? 'col-span-2 md:col-span-1' : '' }}" data-reveal>
                    <p class="font-display text-4xl font-bold tabular-nums text-white md:text-5xl">
                        <span data-count="{{ $stat['value'] }}">{{ $stat['value'] }}</span><span class="text-red-500">{{ $stat['suffix'] }}</span>
                    </p>
                    <p class="mt-2 text-xs font-semibold uppercase tracking-[0.18em] text-white/50">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ============ ABOUT ============ -->
<section id="about" class="relative overflow-hidden bg-white py-24 md:py-32">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 items-center gap-16 lg:grid-cols-2">
            <div data-reveal="left">
                <p class="eyebrow">Who we are</p>
                <h2 class="section-heading">About Shannon Engineering</h2>
                <p class="mt-6 text-lg leading-relaxed text-gray-600">
                    Shannon Engineering Company (SEC) is a Grade A Construction Company operating in the GCC and Middle East.
                </p>
                <p class="mt-4 text-lg leading-relaxed text-gray-600">
                    With a commitment to quality, innovation, and client satisfaction, we have established ourselves as a trusted partner in Qatar's development journey.
                </p>
                <a href="{{ route('about') }}" class="btn-primary mt-10">
                    Learn More About Us
                    <svg class="btn-arrow h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            <div class="relative" data-reveal="right">
                <div class="absolute -right-6 -top-6 h-full w-full rounded-[2rem] border-2 border-red-100"></div>
                <div class="relative overflow-hidden rounded-[2rem] shadow-2xl">
                    <img src="{{ asset('images/optimized/cap-1091.webp') }}" alt="Modern construction site"
                         width="1091" height="780" loading="lazy" decoding="async"
                         class="h-[420px] w-full object-cover transition-transform duration-[1.5s] hover:scale-105">
                </div>
                <div class="absolute -bottom-8 left-6 flex items-center gap-4 rounded-2xl bg-white p-5 shadow-[0_24px_60px_-20px_rgba(16,24,40,.35)] ring-1 ring-gray-100 md:-left-8">
                    <span class="font-display text-5xl font-bold text-red-600">25</span>
                    <span class="text-sm font-semibold leading-tight text-gray-700">Years of<br>experience</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============ SERVICES ============ -->
<section class="relative bg-gray-50 py-24 md:py-32">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto mb-16 max-w-3xl text-center" data-reveal>
            <p class="eyebrow justify-center">What we do</p>
            <h2 class="section-heading">Our Services</h2>
            <p class="section-lead">We provide comprehensive construction and engineering solutions across various sectors</p>
        </div>

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-5" data-reveal-stagger>
            @foreach($services as $service)
                <div class="group relative overflow-hidden card card-hover p-7" data-reveal>
                    <span class="absolute right-5 top-4 font-display text-5xl font-bold text-gray-100 transition-colors duration-500 group-hover:text-red-50">
                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                    </span>
                    <div class="relative flex h-14 w-14 items-center justify-center rounded-2xl bg-red-50 text-red-600 transition-all duration-500 group-hover:rotate-[-6deg] group-hover:bg-red-600 group-hover:text-white">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">{!! $service['icon'] !!}</svg>
                    </div>
                    <h3 class="relative mt-6 text-lg font-semibold text-gray-900">{{ $service['title'] }}</h3>
                    <p class="relative mt-2 text-sm leading-relaxed text-gray-500">{{ $service['text'] }}</p>
                    <span class="absolute inset-x-0 bottom-0 h-1 origin-left scale-x-0 bg-gradient-to-r from-red-600 to-orange-400 transition-transform duration-500 group-hover:scale-x-100"></span>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ============ ONGOING PROJECTS ============ -->
<section class="overflow-hidden bg-white py-24 md:py-32">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-12 flex flex-col items-start justify-between gap-8 md:flex-row md:items-end" data-reveal>
            <div class="max-w-3xl">
                <p class="eyebrow">Under construction</p>
                <h2 class="section-heading">Ongoing Projects</h2>
                <p class="section-lead">
                    Our ongoing projects reflect Shannon Engineering’s continuous growth and trusted reputation in Qatar’s construction sector, delivering through Success, Excellence and Commitment.
                </p>
            </div>
            @if(count($featuredprojects) > 1)
                <div class="hidden shrink-0 gap-2 md:flex">
                    <button type="button" onclick="document.getElementById('ongoing-track').scrollBy({ left: -380, behavior: 'smooth' })" aria-label="Scroll left"
                            class="flex h-12 w-12 items-center justify-center rounded-full border border-gray-200 text-gray-700 transition hover:border-red-600 hover:bg-red-600 hover:text-white">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button type="button" onclick="document.getElementById('ongoing-track').scrollBy({ left: 380, behavior: 'smooth' })" aria-label="Scroll right"
                            class="flex h-12 w-12 items-center justify-center rounded-full border border-gray-200 text-gray-700 transition hover:border-red-600 hover:bg-red-600 hover:text-white">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            @endif
        </div>

        @if(count($featuredprojects) === 0)
            <div class="rounded-3xl border border-dashed border-gray-300 py-20 text-center text-lg text-gray-500">
                No featured projects available at the moment. Please check back later.
            </div>
        @else
            <div id="ongoing-track"
                 class="scrollbar-hide -mx-4 flex snap-x snap-mandatory gap-6 overflow-x-auto scroll-smooth px-4 pb-10 pt-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8"
                 data-reveal-stagger>
                @foreach($featuredprojects as $project)
                    <x-project-card :project="$project" :href="route('detailprojects', $project->id)"
                                    class="w-[85%] shrink-0 snap-start sm:w-[360px]" data-reveal />
                @endforeach
            </div>

            <div class="mt-4 text-center">
                <a href="{{ route('ongoingProjects') }}" class="btn-dark">
                    View All Projects
                    <svg class="btn-arrow h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        @endif
    </div>
</section>

<!-- ============ WHY CHOOSE US ============ -->
<section class="relative overflow-hidden bg-ink-900 py-24 text-white md:py-32">
    <div class="pointer-events-none absolute inset-0 bg-grid opacity-40 [mask-image:radial-gradient(ellipse_at_center,black,transparent_70%)]"></div>
    <div class="pointer-events-none absolute -left-40 top-1/3 h-96 w-96 rounded-full bg-red-600/25 blur-3xl"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 items-center gap-16 lg:grid-cols-2">
            <div class="relative" data-reveal="left">
                <div class="relative aspect-video overflow-hidden rounded-[2rem] bg-black shadow-2xl ring-1 ring-white/10">
                    <button type="button" data-youtube="qpmrD94lSqk" aria-label="Play Shannon Engineering video"
                            class="group absolute inset-0 h-full w-full">
                        <img src="https://i.ytimg.com/vi/qpmrD94lSqk/hqdefault.jpg" alt="" loading="lazy" decoding="async"
                             class="h-full w-full object-cover opacity-80 transition duration-700 group-hover:scale-105 group-hover:opacity-100">
                        <span class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></span>
                        <span class="absolute left-1/2 top-1/2 flex h-20 w-20 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full bg-red-600 text-white shadow-2xl shadow-red-600/50 transition duration-300 group-hover:scale-110">
                            <span class="absolute inset-0 animate-ping rounded-full bg-red-600/40"></span>
                            <svg class="relative ml-1 h-8 w-8" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </span>
                    </button>
                </div>
            </div>

            <div data-reveal="right">
                <p class="eyebrow text-red-400">Why SEC</p>
                <h2 class="section-heading text-white">Why Choose Us</h2>

                <div class="mt-10 space-y-3" x-data="{ active: 0 }">
                    @foreach($reasons as $reason)
                        <div class="rounded-2xl border transition-all duration-300"
                             :class="active === {{ $loop->index }} ? 'border-white/15 bg-white/[.06]' : 'border-transparent hover:bg-white/[.03]'">
                            <button type="button" @click="active = active === {{ $loop->index }} ? null : {{ $loop->index }}"
                                    class="flex w-full items-center gap-5 px-5 py-4 text-left" :aria-expanded="active === {{ $loop->index }}">
                                <span class="font-display text-sm font-bold tabular-nums transition-colors"
                                      :class="active === {{ $loop->index }} ? 'text-red-500' : 'text-white/40'">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="flex-1 font-display text-lg font-semibold text-white md:text-xl">{{ $reason['title'] }}</span>
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-white/10 transition-transform duration-300"
                                      :class="active === {{ $loop->index }} && 'rotate-45 bg-red-600'">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
                                </span>
                            </button>
                            <div x-show="active === {{ $loop->index }}" x-collapse @if(!$loop->first) x-cloak @endif>
                                <p class="px-5 pb-5 pl-[3.75rem] leading-relaxed text-white/65">{{ $reason['text'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
