@props([
    'project',
    'images',
    'prev' => null,
    'next' => null,
    'related' => collect(),
    'detailRoute',       // route name used for prev / next / related links
    'backUrl',
    'backLabel',
    'crumbs' => [],
])

@php
    $ongoing = strtolower($project->status) === 'ongoing';
    $cover = $project->card_img ? asset('storage/' . $project->card_img) : asset('images/optimized/skyline-1920.webp');

    $gallery = collect($project->card_img ? [asset('storage/' . $project->card_img)] : [])
        ->merge($images->map(fn ($img) => asset('storage/' . $img->image_path)))
        ->unique()
        ->values();

    $hasSize = $project->size && preg_replace('/[^0-9]/', '', $project->size) !== '';
    $size = $hasSize ? formatIndianNumber($project->size) . ' m<sup>2</sup>' : null;

    $facts = array_filter([
        ['label' => 'Location', 'value' => e($project->location), 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>'],
        ['label' => 'Project Size', 'value' => $size ?? 'N/A', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15"/>'],
        ['label' => 'Sector', 'value' => e($project->category?->category), 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z"/>'],
        ['label' => $ongoing ? 'Status' : 'Completed', 'value' => $ongoing ? 'Under Construction' : ($project->completed_year ?: 'Delivered'), 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>'],
        ['label' => 'Duration', 'value' => $project->duration ? number_format($project->duration) . ' ' . \Illuminate\Support\Str::plural('day', $project->duration) : null, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>'],
    ], fn ($f) => filled($f['value']));

    // Client, consultant and size are always shown, with N/A when not set.
    $parties = [
        ['label' => 'Client', 'model' => $project->client, 'emoji' => '🏢'],
        ['label' => 'Consultant', 'model' => $project->consultant, 'emoji' => '👷'],
    ];
@endphp

@push('preload')
    <link rel="preload" as="image" href="{{ $cover }}" fetchpriority="high">
@endpush

<div x-data="{
        images: @js($gallery),
        open: false,
        index: 0,
        touchX: null,
        show(i) { this.index = i; this.open = true; document.documentElement.classList.add('overflow-hidden'); },
        close() { this.open = false; document.documentElement.classList.remove('overflow-hidden'); },
        next() { this.index = (this.index + 1) % this.images.length },
        prev() { this.index = (this.index - 1 + this.images.length) % this.images.length },
        swipe(e) {
            if (this.touchX === null) return;
            const dx = e.changedTouches[0].clientX - this.touchX;
            if (Math.abs(dx) > 40) dx < 0 ? this.next() : this.prev();
            this.touchX = null;
        }
    }"
    @keydown.escape.window="open && close()"
    @keydown.arrow-right.window="open && next()"
    @keydown.arrow-left.window="open && prev()">

    <!-- ============ HERO ============ -->
    <section class="relative isolate flex min-h-[78svh] items-end overflow-hidden bg-ink-900 pt-36 text-white">
        <img src="{{ $cover }}" alt="{{ $project->title }}" fetchpriority="high" decoding="async"
             class="absolute inset-0 -z-20 h-full w-full animate-ken-burns object-cover">
        <div class="absolute inset-0 -z-10 bg-gradient-to-t from-ink-900 via-ink-900/60 to-ink-900/20"></div>
        <div class="absolute inset-0 -z-10 bg-gradient-to-r from-ink-900/80 via-ink-900/20 to-transparent"></div>

        <div class="mx-auto w-full max-w-7xl px-4 pb-10 sm:px-6 lg:px-8">
            <nav aria-label="Breadcrumb" class="animate-fade-up mb-6">
                <ol class="flex flex-wrap items-center gap-2 text-xs font-semibold uppercase tracking-[0.18em] text-white/60">
                    <li><a href="{{ route('home') }}" class="transition hover:text-white">Home</a></li>
                    @foreach($crumbs as $label => $url)
                        <li aria-hidden="true" class="text-red-500">/</li>
                        <li><a href="{{ $url }}" class="transition hover:text-white">{{ $label }}</a></li>
                    @endforeach
                </ol>
            </nav>

            <div class="flex flex-wrap items-center gap-3 animate-fade-up [animation-delay:.1s]">
                <span class="inline-flex items-center gap-2 rounded-full px-3.5 py-1.5 text-xs font-bold uppercase tracking-wider backdrop-blur
                    {{ $ongoing ? 'bg-yellow-400/90 text-gray-900' : 'bg-emerald-500/90 text-white' }}">
                    <span class="h-1.5 w-1.5 rounded-full bg-current {{ $ongoing ? 'animate-pulse' : '' }}"></span>
                    {{ $ongoing ? 'Under Construction' : 'Delivered' }}
                </span>
                @if($project->category)
                    <span class="rounded-full bg-white/10 px-3.5 py-1.5 text-xs font-semibold uppercase tracking-wider text-white/90 ring-1 ring-white/20 backdrop-blur">
                        {{ $project->category->category }}
                    </span>
                @endif
            </div>

            <h1 class="mt-5 max-w-5xl overflow-hidden font-display text-4xl font-bold leading-[1.05] text-white md:text-6xl lg:text-7xl">
                <span class="block animate-rise [animation-delay:.15s]">{{ $project->title }}</span>
            </h1>

            @if(count($facts))
                <dl class="mt-10 grid grid-cols-2 gap-px overflow-hidden rounded-3xl bg-white/10 ring-1 ring-white/15 backdrop-blur-md animate-fade-up [animation-delay:.35s] {{ [1 => 'md:grid-cols-1', 2 => 'md:grid-cols-2', 3 => 'md:grid-cols-3', 4 => 'md:grid-cols-4', 5 => 'md:grid-cols-5'][count($facts)] }}">
                    @foreach($facts as $fact)
                        <div class="bg-ink-900/40 px-5 py-5 md:px-6 {{ $loop->last && count($facts) % 2 === 1 ? 'col-span-2 md:col-span-1' : '' }}">
                            <dt class="flex items-center gap-2 text-[11px] font-semibold uppercase tracking-[0.18em] text-white/55">
                                <svg class="h-4 w-4 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">{!! $fact['icon'] !!}</svg>
                                {{ $fact['label'] }}
                            </dt>
                            <dd class="mt-2 font-display text-lg font-semibold text-white md:text-xl">{!! $fact['value'] !!}</dd>
                        </div>
                    @endforeach
                </dl>
            @endif
        </div>
    </section>

    <!-- ============ BODY ============ -->
    <section class="bg-white py-20 md:py-28">
        <div class="mx-auto grid max-w-7xl grid-cols-1 gap-14 px-4 sm:px-6 lg:grid-cols-12 lg:px-8">

            <!-- Main column -->
            <div class="lg:col-span-8">
                <div data-reveal>
                    <p class="eyebrow">Project overview</p>
                    <h2 class="section-heading">About this project</h2>
                    @if($project->description)
                        <div @class(['rich-text mt-8', 'has-dropcap' => mb_strlen($project->description_text) > 220])>
                            {!! $project->description_html !!}
                        </div>
                    @else
                        <p class="mt-8 text-lg text-gray-500">Details for this project will be available soon.</p>
                    @endif
                </div>

                @if($gallery->count())
                    <div class="mt-20" data-reveal>
                        <div class="mb-8 flex items-end justify-between gap-4">
                            <div>
                                <p class="eyebrow">Gallery</p>
                                <h2 class="section-heading">Project in pictures</h2>
                            </div>
                            <span class="hidden text-sm font-medium text-gray-400 sm:block">{{ $gallery->count() }} {{ \Illuminate\Support\Str::plural('photo', $gallery->count()) }}</span>
                        </div>

                        @php $visible = $gallery->take(5); $extra = $gallery->count() - $visible->count(); @endphp
                        <div class="grid auto-rows-[160px] grid-cols-2 gap-3 md:auto-rows-[200px] md:grid-cols-4">
                            @foreach($visible as $i => $src)
                                <button type="button" @click="show({{ $i }})"
                                        class="group relative overflow-hidden rounded-2xl bg-gray-100 focus:outline-none focus-visible:ring-4 focus-visible:ring-red-500/40
                                        {{ $i === 0 ? 'col-span-2 row-span-2' : '' }}
                                        {{ $visible->count() === 2 && $i === 1 ? 'col-span-2 row-span-2' : '' }}"
                                        aria-label="Open photo {{ $i + 1 }}">
                                    <img src="{{ $src }}" alt="{{ $project->title }} photo {{ $i + 1 }}" loading="lazy" decoding="async"
                                         class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-110">
                                    <span class="absolute inset-0 bg-black/0 transition-colors duration-300 group-hover:bg-black/25"></span>
                                    <span class="absolute bottom-3 right-3 flex h-9 w-9 scale-75 items-center justify-center rounded-full bg-white/90 text-gray-900 opacity-0 transition duration-300 group-hover:scale-100 group-hover:opacity-100">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15"/></svg>
                                    </span>
                                    @if($loop->last && $extra > 0)
                                        <span class="absolute inset-0 flex items-center justify-center bg-ink-900/70 font-display text-3xl font-bold text-white backdrop-blur-[2px]">+{{ $extra }}</span>
                                    @endif
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-4">
                <div class="space-y-6 lg:sticky lg:top-28" data-reveal="right">
                        <div class="card p-6">
                            <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-gray-400">Project partners</h3>
                            <div class="mt-5 space-y-4">
                                @foreach($parties as $party)
                                    <div class="flex items-center gap-4">
                                        <div class="flex h-16 w-20 shrink-0 items-center justify-center rounded-xl bg-gray-50 p-2 ring-1 ring-gray-100">
                                            @if($party['model']?->img)
                                                <img src="{{ asset('storage/' . $party['model']->img) }}" alt="{{ $party['model']->name }} logo" loading="lazy"
                                                     class="max-h-full max-w-full object-contain">
                                            @else
                                                <span class="text-2xl">{{ $party['emoji'] }}</span>
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-gray-400">{{ $party['label'] }}</p>
                                            <p class="mt-0.5 font-display text-base font-semibold leading-snug {{ $party['model'] ? 'text-gray-900' : 'text-gray-400' }}">{{ $party['model']?->name ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    <div class="relative overflow-hidden rounded-3xl bg-ink-900 p-7 text-white">
                        <div class="pointer-events-none absolute -right-16 -top-16 h-48 w-48 rounded-full bg-red-600/40 blur-3xl"></div>
                        <p class="relative font-display text-2xl font-semibold leading-snug text-white">Planning something similar?</p>
                        <p class="relative mt-3 text-sm leading-relaxed text-white/65">Talk to our team about your next project in Qatar.</p>
                        <a href="{{ route('contact') }}" class="btn-primary relative mt-6 w-full">
                            Contact Us
                            <svg class="btn-arrow h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ $backUrl }}" class="btn-outline flex-1 px-4">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18"/></svg>
                            {{ $backLabel }}
                        </a>
                        <a href="{{ route('projects') }}" class="btn-dark flex-1 px-4">All Projects</a>
                    </div>
                </div>
            </aside>
        </div>
    </section>

    <!-- ============ PREV / NEXT ============ -->
    @if($prev || $next)
        <section class="border-t border-gray-100 bg-white">
            <div class="mx-auto grid max-w-7xl grid-cols-1 gap-4 px-4 py-10 sm:px-6 md:grid-cols-2 lg:px-8">
                @foreach([['p' => $prev, 'label' => 'Previous project', 'dir' => 'prev'], ['p' => $next, 'label' => 'Next project', 'dir' => 'next']] as $nav)
                    @if($nav['p'])
                        <a href="{{ route($detailRoute, $nav['p']->id) }}"
                           class="group relative isolate flex min-h-[140px] items-center gap-5 overflow-hidden rounded-3xl bg-ink-900 p-6 text-white {{ $nav['dir'] === 'next' ? 'md:col-start-2 md:flex-row-reverse md:text-right' : '' }}">
                            @if($nav['p']->card_img)
                                <img src="{{ asset('storage/' . $nav['p']->card_img) }}" alt="" loading="lazy" decoding="async"
                                     class="absolute inset-0 -z-10 h-full w-full object-cover opacity-40 transition duration-700 group-hover:scale-105 group-hover:opacity-55">
                            @endif
                            <div class="absolute inset-0 -z-10 bg-gradient-to-r from-ink-900/90 to-ink-900/40"></div>
                            <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-white/10 ring-1 ring-white/20 backdrop-blur transition group-hover:bg-red-600 group-hover:ring-red-600">
                                <svg class="h-5 w-5 transition-transform duration-300 {{ $nav['dir'] === 'next' ? 'group-hover:translate-x-1' : 'group-hover:-translate-x-1' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $nav['dir'] === 'next' ? 'M9 5l7 7-7 7' : 'M15 19l-7-7 7-7' }}"/>
                                </svg>
                            </span>
                            <span class="min-w-0">
                                <span class="block text-[11px] font-semibold uppercase tracking-[0.2em] text-white/55">{{ $nav['label'] }}</span>
                                <span class="mt-1 block truncate font-display text-xl font-semibold text-white">{{ $nav['p']->title }}</span>
                            </span>
                        </a>
                    @endif
                @endforeach
            </div>
        </section>
    @endif

    <!-- ============ MORE PROJECTS ============ -->
    @if($related->isNotEmpty())
        <section class="bg-gray-50 py-20 md:py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-12 flex items-end justify-between gap-6" data-reveal>
                    <div>
                        <p class="eyebrow">Keep exploring</p>
                        <h2 class="section-heading">More projects</h2>
                    </div>
                    <a href="{{ $backUrl }}" class="hidden items-center gap-2 text-sm font-semibold text-red-600 sm:inline-flex">
                        View all
                        <svg class="btn-arrow h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3" data-reveal-stagger>
                    @foreach($related as $item)
                        <x-project-card :project="$item" :href="route($detailRoute, $item->id)" data-reveal />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- ============ LIGHTBOX ============ -->
    <template x-teleport="body">
        <div x-show="open" x-cloak x-transition.opacity.duration.300ms
             class="fixed inset-0 z-[80] flex flex-col bg-black/95 backdrop-blur-sm"
             role="dialog" aria-modal="true" aria-label="Project photos"
             @touchstart.passive="touchX = $event.touches[0].clientX" @touchend="swipe($event)">
            <div class="flex items-center justify-between px-4 py-4 text-white md:px-8">
                <p class="font-display text-sm tabular-nums text-white/70">
                    <span class="text-lg font-semibold text-white" x-text="index + 1"></span> / <span x-text="images.length"></span>
                </p>
                <p class="hidden truncate px-6 text-sm font-medium text-white/80 md:block">{{ $project->title }}</p>
                <button type="button" @click="close()" aria-label="Close"
                        class="flex h-11 w-11 items-center justify-center rounded-full bg-white/10 transition hover:bg-white hover:text-gray-900">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="relative flex flex-1 items-center justify-center px-4 md:px-24" @click.self="close()">
                <template x-for="(src, i) in images" :key="i">
                    <img x-show="index === i" :src="open && Math.abs(index - i) <= 1 || index === i ? src : null"
                         x-transition:enter="transition duration-300 ease-out" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                         :alt="'{{ addslashes($project->title) }} photo ' + (i + 1)"
                         class="absolute max-h-[calc(100svh-180px)] max-w-[calc(100%-2rem)] rounded-xl object-contain shadow-2xl md:max-w-[calc(100%-12rem)]">
                </template>

                <button type="button" x-show="images.length > 1" @click="prev()" aria-label="Previous photo"
                        class="absolute left-3 flex h-12 w-12 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-white hover:text-gray-900 md:left-8">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button type="button" x-show="images.length > 1" @click="next()" aria-label="Next photo"
                        class="absolute right-3 flex h-12 w-12 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-white hover:text-gray-900 md:right-8">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>

            <div class="scrollbar-hide flex justify-center gap-2 overflow-x-auto px-4 py-4" x-show="images.length > 1">
                <template x-for="(src, i) in images" :key="'t' + i">
                    <button type="button" @click="index = i" :aria-label="'Photo ' + (i + 1)"
                            class="h-14 w-20 shrink-0 overflow-hidden rounded-lg ring-2 transition"
                            :class="index === i ? 'ring-red-500 opacity-100' : 'ring-transparent opacity-50 hover:opacity-80'">
                        <img :src="open ? src : null" alt="" class="h-full w-full object-cover">
                    </button>
                </template>
            </div>
        </div>
    </template>
</div>
