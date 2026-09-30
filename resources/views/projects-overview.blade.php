@extends('layouts.app')

@section('title', 'Our Projects - Shannon Engineering Company')

@section('content')

<x-page-hero title="Our" highlight="Projects" subtitle="Reflected SEC success through diverse, high quality engineering achievements." :crumbs="['Projects' => null]" />

<!-- ============ BY STATUS ============ -->
<section class="bg-white py-16 md:py-20">
    <div class="mx-auto grid max-w-7xl grid-cols-1 gap-6 px-4 sm:px-6 md:grid-cols-2 lg:px-8" data-reveal-stagger>
        @foreach ([
            ['key' => 'ongoing', 'title' => 'Ongoing Projects', 'text' => 'See what we are building across Qatar right now.', 'badge' => 'Live sites', 'href' => route('ongoingProjects')],
            ['key' => 'delivered', 'title' => 'Delivered Projects', 'text' => 'Completed projects delivered with success, excellence and commitment.', 'badge' => 'Completed', 'href' => route('projects', ['status' => 'delivered'])],
        ] as $card)
            <a href="{{ $card['href'] }}" data-reveal
               class="group relative isolate flex min-h-[280px] flex-col justify-end overflow-hidden rounded-[2rem] bg-ink-900 p-8 text-white md:min-h-[320px] md:p-10">
                <img src="{{ $covers[$card['key']] }}" alt="" loading="lazy" decoding="async"
                     class="absolute inset-0 -z-10 h-full w-full object-cover transition-transform duration-[1.5s] ease-out group-hover:scale-105">
                <div class="absolute inset-0 -z-10 bg-gradient-to-t from-ink-900/95 via-ink-900/55 to-ink-900/10"></div>

                <div class="flex items-center gap-3">
                    <span class="inline-flex w-fit items-center gap-2 rounded-full px-3 py-1 text-xs font-bold uppercase tracking-wider
                        {{ $card['key'] === 'ongoing' ? 'bg-yellow-400 text-gray-900' : 'bg-emerald-500 text-white' }}">
                        <span class="h-1.5 w-1.5 rounded-full bg-current {{ $card['key'] === 'ongoing' ? 'animate-pulse' : '' }}"></span>
                        {{ $card['badge'] }}
                    </span>
                    <span class="text-sm font-semibold text-white/70">{{ $statusCounts[$card['key']] }} {{ \Illuminate\Support\Str::plural('project', $statusCounts[$card['key']]) }}</span>
                </div>
                <h2 class="mt-4 font-display text-3xl font-bold text-white md:text-4xl">{{ $card['title'] }}</h2>
                <p class="mt-2 max-w-md text-white/70">{{ $card['text'] }}</p>
                <span class="btn-ghost mt-6 w-fit">
                    Explore
                    <svg class="btn-arrow h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </span>
            </a>
        @endforeach
    </div>
</section>

<!-- ============ CATEGORIES ============ -->
<section class="bg-gray-50 py-20 md:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto mb-16 max-w-2xl text-center" data-reveal>
            <p class="eyebrow justify-center">Browse by sector</p>
            <h2 class="section-heading">Project Categories</h2>
            <p class="section-lead">We deliver excellence across multiple sectors</p>
        </div>

        @if ($categories->isEmpty())
            <div class="rounded-3xl border border-dashed border-gray-300 bg-white py-20 text-center text-lg text-gray-500">
                Project categories will appear here soon.
            </div>
        @else
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3" data-reveal-stagger>
                @foreach ($categories as $cat)
                    <a href="{{ route('listprojects', $cat->id) }}" data-reveal
                       class="group relative isolate flex aspect-[4/5] flex-col justify-end overflow-hidden rounded-3xl bg-ink-900 p-7 text-white shadow-[0_24px_48px_-24px_rgba(16,24,40,.45)]">
                        @if ($cat->card_img)
                            <img src="{{ asset('storage/' . $cat->card_img) }}" alt="{{ $cat->category }} Projects" loading="lazy" decoding="async"
                                 class="absolute inset-0 -z-10 h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-110">
                        @endif
                        <div class="absolute inset-0 -z-10 bg-gradient-to-t from-black/90 via-black/40 to-black/0 transition-colors duration-500 group-hover:from-red-950/95"></div>

                        <!-- Counts -->
                        <div class="absolute left-5 top-5 flex flex-wrap gap-2">
                            @if ($cat->projects_count === 0)
                                <span class="rounded-full bg-white/15 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-white/80 backdrop-blur">Coming soon</span>
                            @else
                                @if ($cat->ongoing_count)
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-yellow-400/90 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-gray-900 backdrop-blur">
                                        <span class="h-1.5 w-1.5 rounded-full bg-gray-900"></span>{{ $cat->ongoing_count }} ongoing
                                    </span>
                                @endif
                                @if ($cat->delivered_count)
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-500/90 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-white backdrop-blur">
                                        <span class="h-1.5 w-1.5 rounded-full bg-white"></span>{{ $cat->delivered_count }} delivered
                                    </span>
                                @endif
                            @endif
                        </div>

                        <h3 class="font-display text-2xl font-semibold text-white">{{ $cat->category }}</h3>
                        @if ($cat->description)
                            <div class="grid grid-rows-[1fr] transition-all duration-500 md:grid-rows-[0fr] md:group-hover:grid-rows-[1fr]">
                                <p class="overflow-hidden text-sm leading-relaxed text-white/75">
                                    <span class="block pt-3">{{ $cat->description }}</span>
                                </p>
                            </div>
                        @endif
                        <span class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-white">
                            View {{ $cat->projects_count }} {{ \Illuminate\Support\Str::plural('project', $cat->projects_count) }}
                            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-white/15 backdrop-blur transition-colors duration-300 group-hover:bg-red-600">
                                <svg class="btn-arrow h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </span>
                        </span>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
