<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0b0f17">
    <title>@yield('title', 'Shannon Engineering Company - Building Qatar\'s Future')</title>
    <meta name="description" content="@yield('description', 'Shannon Engineering Company (SEC) is a premier construction and contracting company in Qatar, delivering exceptional projects across residential, commercial, industrial, medical, and religious sectors.')">
    <link rel="icon" href="{{ asset('images/logo/logo.png') }}" type="image/png">

    {{-- First-visit launcher: decide before first paint so it never flashes --}}
    <script>
        (function () {
            // Show once per visit: not again on this device for 6 hours (also across new tabs).
            try {
                var last = Number(localStorage.getItem('sec-intro-seen') || 0);
                if (Date.now() - last > 6 * 60 * 60 * 1000) {
                    document.documentElement.classList.add('intro-active');
                    localStorage.setItem('sec-intro-seen', String(Date.now()));
                }
            } catch (e) { /* storage blocked: skip the intro */ }
        })();
    </script>
    <link rel="preload" as="image" href="{{ asset('images/optimized/logo-light-320.webp') }}">
    <style>
        #intro { display: none; }
        .intro-active, .intro-leaving { overflow: hidden; }
        .intro-active #intro, .intro-leaving #intro {
            position: fixed; inset: 0; z-index: 200; display: flex; align-items: center; justify-content: center;
            background: #0b0f17; color: #fff;
            clip-path: inset(0 0 0 0);
            transition: clip-path 1s cubic-bezier(.77, 0, .18, 1);
        }
        .intro-leaving #intro { clip-path: inset(0 0 100% 0); }
        .intro-leaving .intro-inner { opacity: 0; transform: translateY(-40px); transition: all .6s cubic-bezier(.77, 0, .18, 1); }
        /* Hold page animations (hero text, zoom) until the curtain lifts */
        .intro-active main *, .intro-active main *::before { animation-play-state: paused !important; }

        .intro-glow {
            position: absolute; width: 60vmax; height: 60vmax; border-radius: 50%;
            background: radial-gradient(circle, rgba(220, 38, 38, .28), transparent 60%);
            animation: intro-glow 3s ease-in-out infinite alternate;
        }
        .intro-inner { position: relative; display: flex; flex-direction: column; align-items: center; }
        .intro-logo-wrap { position: relative; width: 220px; }
        .intro-logo {
            display: block; width: 100%; height: auto;
            clip-path: inset(0 100% 0 0); filter: blur(8px); transform: scale(.9);
            animation: intro-logo 1.1s cubic-bezier(.2, .7, .2, 1) .15s forwards;
        }
        .intro-shine {
            position: absolute; inset: 0; pointer-events: none;
            -webkit-mask-size: contain; mask-size: contain; -webkit-mask-repeat: no-repeat; mask-repeat: no-repeat;
            -webkit-mask-position: center; mask-position: center;
            background: linear-gradient(110deg, transparent 35%, rgba(255, 255, 255, .95) 50%, transparent 65%);
            background-size: 250% 100%; background-position: 150% 0; opacity: 0;
            animation: intro-shine 1.1s ease-in-out 1.05s forwards;
        }
        .intro-tagline {
            margin-top: 28px; display: flex; align-items: center; gap: 14px;
            font: 600 11px/1 'Plus Jakarta Sans', system-ui, sans-serif; letter-spacing: .5em; text-transform: uppercase;
            color: rgba(255, 255, 255, .7);
        }
        .intro-tagline span { opacity: 0; transform: translateY(10px); animation: intro-up .7s cubic-bezier(.2, .7, .2, 1) forwards; }
        .intro-tagline span:nth-of-type(1) { animation-delay: .9s; }
        .intro-tagline span:nth-of-type(2) { animation-delay: 1.05s; }
        .intro-tagline span:nth-of-type(3) { animation-delay: 1.2s; }
        .intro-tagline i { width: 4px; height: 4px; border-radius: 50%; background: #ef4444; opacity: 0; animation: intro-up .5s ease forwards 1.1s; }
        .intro-bar { margin-top: 36px; width: 160px; height: 2px; border-radius: 2px; background: rgba(255, 255, 255, .12); overflow: hidden; }
        .intro-bar span { display: block; height: 100%; width: 0; background: linear-gradient(90deg, #dc2626, #fb923c); animation: intro-bar 1.8s cubic-bezier(.4, 0, .2, 1) .2s forwards; }
        .intro-leaving .intro-bar span { width: 100%; animation: none; }

        @keyframes intro-logo { to { clip-path: inset(0 0 0 0); filter: blur(0); transform: scale(1); } }
        @keyframes intro-shine { 0% { opacity: 1; background-position: 150% 0; } 100% { opacity: 1; background-position: -50% 0; } }
        @keyframes intro-up { to { opacity: 1; transform: none; } }
        @keyframes intro-bar { to { width: 85%; } }
        @keyframes intro-glow { from { transform: scale(.85); opacity: .7; } to { transform: scale(1.1); opacity: 1; } }

        @media (max-width: 480px) {
            .intro-logo-wrap { width: 170px; }
            .intro-tagline { letter-spacing: .3em; font-size: 10px; gap: 10px; }
        }
        @media (prefers-reduced-motion: reduce) {
            .intro-logo, .intro-tagline span, .intro-tagline i { animation: none; clip-path: none; filter: none; transform: none; opacity: 1; }
            .intro-shine, .intro-glow { display: none; }
            .intro-active #intro, .intro-leaving #intro { transition: opacity .25s; }
            .intro-leaving #intro { clip-path: none; opacity: 0; }
        }
    </style>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    @stack('preload')
    @stack('meta')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>

@php
    $projectCategories = \App\Models\ProjectCategory::orderBy('id')->get(['id', 'category']);
    // Pages without a dark hero at the top get a solid header from the start.
    $solidNav = $__env->hasSection('solid-nav');

    $aboutLinks = [
        ['route' => 'about', 'label' => 'Message from CEO'],
        ['route' => 'about.vision', 'label' => 'Vision, Mission & Values'],
        ['route' => 'about.team', 'label' => 'Meet Our Team'],
        ['route' => 'about.culture', 'label' => 'Our Culture'],
    ];
    $partnerLinks = [
        ['href' => route('clients') . '#clients', 'label' => 'Our Clients'],
        ['href' => route('clients') . '#consultants', 'label' => 'Consultants'],
    ];
@endphp

<body class="bg-white antialiased {{ $solidNav ? 'pt-20' : '' }}">

    @include('partials.intro')

    <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[100] focus:rounded-full focus:bg-white focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:shadow-lg">
        Skip to content
    </a>

    <!-- ============ HEADER ============ -->
    <header
        x-data="{
            scrolled: false,
            progress: 0,
            mobileOpen: false,
            solid: {{ $solidNav ? 'true' : 'false' }},
            onScroll() {
                const y = window.scrollY;
                this.scrolled = y > 40;
                const h = document.documentElement.scrollHeight - window.innerHeight;
                this.progress = h > 0 ? (y / h) * 100 : 0;
            },
            toggleMobile(state) {
                this.mobileOpen = typeof state === 'boolean' ? state : !this.mobileOpen;
                document.documentElement.classList.toggle('overflow-hidden', this.mobileOpen);
            }
        }"
        x-init="onScroll()"
        @scroll.window.passive="onScroll()"
        @keydown.escape.window="toggleMobile(false)"
        class="fixed inset-x-0 top-0 z-50"
    >
        <div
            :class="(scrolled || solid)
                ? 'bg-white/90 shadow-[0_8px_30px_-12px_rgba(0,0,0,.18)] backdrop-blur-xl border-b border-gray-100'
                : 'bg-gradient-to-b from-black/60 via-black/25 to-transparent'"
            class="transition-all duration-500"
        >
            <div class="mx-auto flex max-w-[1440px] items-center justify-between gap-6 px-4 md:px-8"
                 :class="(scrolled || solid) ? 'h-20' : 'h-24'">

                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex shrink-0 items-center" aria-label="Shannon Engineering Company – Home">
                    {{-- Light logo over dark hero, original logo once the header turns white --}}
                    <img src="{{ asset($solidNav ? 'images/optimized/logo-320.webp' : 'images/optimized/logo-light-320.webp') }}"
                         :src="(scrolled || solid) ? '{{ asset('images/optimized/logo-320.webp') }}' : '{{ asset('images/optimized/logo-light-320.webp') }}'"
                         alt="Shannon Engineering Company" width="100" height="64"
                         class="h-auto w-[92px] transition-all duration-500 drop-shadow-[0_2px_8px_rgba(0,0,0,.35)]"
                         :class="(scrolled || solid) ? 'w-[88px] drop-shadow-none' : 'w-[100px]'">
                </a>

                <!-- Desktop navigation -->
                <nav class="hidden xl:flex items-center gap-1" aria-label="Main">
                    @php
                        $linkClass = "nav-link";
                        $linkColor = "(scrolled || solid) ? 'text-gray-800 hover:text-red-600' : 'text-white/90 hover:text-white'";
                        $chevron = '<svg class="h-3.5 w-3.5 transition-transform duration-300" :class="open && \'rotate-180\'" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7"/></svg>';
                    @endphp

                    <a href="{{ route('home') }}" class="{{ $linkClass }} {{ request()->routeIs('home') ? 'is-active' : '' }}" :class="{{ $linkColor }}">Home</a>

                    <!-- About -->
                    <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" @focusin="open = true" @focusout="open = $el.contains($event.relatedTarget)" class="relative">
                        <a href="{{ route('about') }}" class="{{ $linkClass }} {{ request()->routeIs('about*') ? 'is-active' : '' }}" :class="{{ $linkColor }}" :aria-expanded="open">
                            About Us {!! $chevron !!}
                        </a>
                        <div x-show="open" x-cloak
                             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                             class="dropdown-panel w-64">
                            @foreach($aboutLinks as $link)
                                <a href="{{ route($link['route']) }}" class="dropdown-item {{ request()->routeIs($link['route']) ? 'bg-red-50 text-red-600' : '' }}">
                                    <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>{{ $link['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Projects (mega menu) -->
                    <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" @focusin="open = true" @focusout="open = $el.contains($event.relatedTarget)" class="relative">
                        <a href="{{ route('projects') }}" class="{{ $linkClass }} {{ request()->routeIs('projects', 'listprojects', 'detailprojects', 'ongoingProjects', 'ongoingdetails') ? 'is-active' : '' }}" :class="{{ $linkColor }}" :aria-expanded="open">
                            Projects {!! $chevron !!}
                        </a>
                        <div x-show="open" x-cloak
                             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                             class="dropdown-panel w-[560px] p-3">
                            <div class="grid grid-cols-5 gap-3">
                                <div class="col-span-2 flex flex-col gap-2">
                                    <a href="{{ route('ongoingProjects') }}"
                                       class="group relative flex flex-1 flex-col justify-end overflow-hidden rounded-xl bg-gray-900 p-4 text-white">
                                        <img src="{{ \App\Models\Project::ongoingCoverUrl() }}" alt="" loading="lazy" decoding="async"
                                             class="absolute inset-0 h-full w-full object-cover opacity-50 transition duration-500 group-hover:scale-105 group-hover:opacity-60">
                                        <span class="relative inline-flex w-fit items-center gap-1.5 rounded-full bg-yellow-400/90 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-gray-900">
                                            <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-gray-900"></span> Live
                                        </span>
                                        <span class="relative mt-2 font-display text-lg font-semibold">Ongoing Projects</span>
                                        <span class="relative text-xs text-white/70">Currently under construction</span>
                                    </a>
                                    <a href="{{ route('projects') }}" class="dropdown-item justify-between bg-gray-50">
                                        All Projects
                                        <svg class="btn-arrow h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </div>
                                <div class="col-span-3">
                                    <p class="px-4 pb-1 pt-2 text-[11px] font-bold uppercase tracking-[0.2em] text-gray-400">Delivered Projects</p>
                                    @foreach($projectCategories as $category)
                                        <a href="{{ route('listprojects', $category->id) }}" class="dropdown-item py-2 {{ request()->is('projects/cat/'.$category->id) ? 'bg-red-50 text-red-600' : '' }}">
                                            <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>{{ $category->category }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('safety') }}" class="{{ $linkClass }} {{ request()->routeIs('safety') ? 'is-active' : '' }}" :class="{{ $linkColor }}">Safety, Health &amp; Environment</a>

                    <!-- Partners -->
                    <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" @focusin="open = true" @focusout="open = $el.contains($event.relatedTarget)" class="relative">
                        <a href="{{ route('clients') }}" class="{{ $linkClass }} {{ request()->routeIs('clients') ? 'is-active' : '' }}" :class="{{ $linkColor }}" :aria-expanded="open">
                            Strategic Partners {!! $chevron !!}
                        </a>
                        <div x-show="open" x-cloak
                             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                             class="dropdown-panel w-56">
                            @foreach($partnerLinks as $link)
                                <a href="{{ $link['href'] }}" class="dropdown-item">
                                    <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>{{ $link['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <a href="{{ route('sister-companies') }}" class="{{ $linkClass }} {{ request()->routeIs('sister-companies') ? 'is-active' : '' }}" :class="{{ $linkColor }}">SEC Group</a>
                    <a href="{{ route('careers') }}" class="{{ $linkClass }} {{ request()->routeIs('careers') ? 'is-active' : '' }}" :class="{{ $linkColor }}">Careers</a>

                    <a href="{{ route('contact') }}" class="btn-primary ml-3 px-5 py-2.5 text-[13px] uppercase tracking-wider">
                        Contact Us
                        <svg class="btn-arrow h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </nav>

                <!-- Mobile toggle -->
                <button type="button" @click="toggleMobile()"
                        class="xl:hidden inline-flex h-11 w-11 items-center justify-center rounded-full transition"
                        :class="(scrolled || solid) ? 'bg-gray-900 text-white' : 'bg-white/15 text-white ring-1 ring-white/30 backdrop-blur'"
                        :aria-expanded="mobileOpen" aria-controls="mobile-menu" aria-label="Open menu">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M10 17h10" />
                    </svg>
                </button>
            </div>

            <!-- Scroll progress -->
            <div class="absolute bottom-0 left-0 h-0.5 bg-gradient-to-r from-red-600 to-orange-400 transition-[width] duration-150"
                 :style="`width: ${progress}%`"></div>
        </div>

        <!-- ============ MOBILE DRAWER ============ -->
        <div x-show="mobileOpen" x-cloak class="xl:hidden" id="mobile-menu">
            <div x-show="mobileOpen" x-transition.opacity.duration.300ms @click="toggleMobile(false)"
                 class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm"></div>

            <aside x-show="mobileOpen"
                   x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                   x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                   x-data="{ section: null }"
                   class="fixed inset-y-0 right-0 z-50 flex w-full max-w-sm flex-col bg-white shadow-2xl">

                <div class="flex items-center justify-between border-b border-gray-100 px-5 py-4">
                    <img src="{{ asset('images/optimized/logo-320.webp') }}" alt="Shannon Engineering Company" class="w-20" width="80" height="51">
                    <button type="button" @click="toggleMobile(false)" class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 text-gray-700 hover:bg-red-50 hover:text-red-600" aria-label="Close menu">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                @php
                    $mLink = 'flex items-center justify-between rounded-xl px-4 py-3 text-base font-semibold text-gray-900 hover:bg-gray-50';
                    $mSub = 'block rounded-lg px-4 py-2.5 text-sm font-medium text-gray-600 hover:bg-red-50 hover:text-red-600';
                    $mChevron = '<svg class="h-4 w-4 text-gray-400 transition-transform duration-300" :class="section === \'%s\' && \'rotate-180 text-red-600\'" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7"/></svg>';
                @endphp

                <nav class="flex-1 space-y-1 overflow-y-auto px-3 py-4" aria-label="Mobile">
                    <a href="{{ route('home') }}" class="{{ $mLink }} {{ request()->routeIs('home') ? 'text-red-600' : '' }}">Home</a>

                    <div>
                        <button type="button" @click="section = section === 'about' ? null : 'about'" class="{{ $mLink }} w-full" :aria-expanded="section === 'about'">
                            About Us {!! sprintf($mChevron, 'about') !!}
                        </button>
                        <div x-show="section === 'about'" x-collapse x-cloak class="ml-4 border-l-2 border-red-100 pl-2">
                            @foreach($aboutLinks as $link)
                                <a href="{{ route($link['route']) }}" class="{{ $mSub }} {{ request()->routeIs($link['route']) ? 'text-red-600' : '' }}">{{ $link['label'] }}</a>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <button type="button" @click="section = section === 'projects' ? null : 'projects'" class="{{ $mLink }} w-full" :aria-expanded="section === 'projects'">
                            Projects {!! sprintf($mChevron, 'projects') !!}
                        </button>
                        <div x-show="section === 'projects'" x-collapse x-cloak class="ml-4 border-l-2 border-red-100 pl-2">
                            <a href="{{ route('projects') }}" class="{{ $mSub }}">All Projects</a>
                            <a href="{{ route('ongoingProjects') }}" class="{{ $mSub }}">Ongoing Projects</a>
                            <p class="px-4 pb-1 pt-3 text-[11px] font-bold uppercase tracking-[0.2em] text-gray-400">Delivered</p>
                            @foreach($projectCategories as $category)
                                <a href="{{ route('listprojects', $category->id) }}" class="{{ $mSub }} {{ request()->is('projects/cat/'.$category->id) ? 'text-red-600' : '' }}">{{ $category->category }}</a>
                            @endforeach
                        </div>
                    </div>

                    <a href="{{ route('safety') }}" class="{{ $mLink }} {{ request()->routeIs('safety') ? 'text-red-600' : '' }}">Safety, Health &amp; Environment</a>

                    <div>
                        <button type="button" @click="section = section === 'partners' ? null : 'partners'" class="{{ $mLink }} w-full" :aria-expanded="section === 'partners'">
                            Strategic Partners {!! sprintf($mChevron, 'partners') !!}
                        </button>
                        <div x-show="section === 'partners'" x-collapse x-cloak class="ml-4 border-l-2 border-red-100 pl-2">
                            @foreach($partnerLinks as $link)
                                <a href="{{ $link['href'] }}" @click="toggleMobile(false)" class="{{ $mSub }}">{{ $link['label'] }}</a>
                            @endforeach
                        </div>
                    </div>

                    <a href="{{ route('sister-companies') }}" class="{{ $mLink }} {{ request()->routeIs('sister-companies') ? 'text-red-600' : '' }}">SEC Group</a>
                    <a href="{{ route('careers') }}" class="{{ $mLink }} {{ request()->routeIs('careers') ? 'text-red-600' : '' }}">Careers</a>
                </nav>

                <div class="space-y-3 border-t border-gray-100 p-5">
                    <a href="{{ route('contact') }}" class="btn-primary w-full">Contact Us</a>
                    <div class="flex items-center justify-center gap-4 text-sm text-gray-500">
                        <a href="tel:+97444355656" class="hover:text-red-600">+974 4435 5656</a>
                        <span class="h-1 w-1 rounded-full bg-gray-300"></span>
                        <a href="mailto:info@shannoneng.com" class="hover:text-red-600">info@shannoneng.com</a>
                    </div>
                </div>
            </aside>
        </div>
    </header>

    <!-- ============ MAIN ============ -->
    <main id="main">
        @yield('content')
    </main>

    <!-- ============ FOOTER ============ -->
    <footer class="relative overflow-hidden bg-ink-900 text-gray-400">
        <div class="pointer-events-none absolute inset-0 bg-grid opacity-40 [mask-image:radial-gradient(ellipse_at_top,black,transparent_70%)]"></div>
        <div class="pointer-events-none absolute -top-40 left-1/2 h-80 w-[40rem] -translate-x-1/2 rounded-full bg-red-600/20 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- CTA strip -->
            <div class="flex flex-col items-start justify-between gap-6 border-b border-white/10 py-14 md:flex-row md:items-center">
                <div>
                    <p class="eyebrow text-red-500">Let's build together</p>
                    <h2 class="mt-3 max-w-xl font-display text-3xl font-bold text-white md:text-4xl">Ready to start your next project?</h2>
                    <p class="mt-3 max-w-xl text-gray-400">Contact us today to discuss how Shannon Engineering Company can bring your vision to life.</p>
                </div>
                <a href="{{ route('contact') }}" class="btn-primary shrink-0">
                    Get in touch
                    <svg class="btn-arrow h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 gap-12 py-14 sm:grid-cols-2 lg:grid-cols-12">
                <!-- Brand -->
                <div class="lg:col-span-4">
                    <a href="{{ route('home') }}" class="inline-block">
                        <img src="{{ asset('images/optimized/logo-light-320.webp') }}" alt="Shannon Engineering Company" class="w-28" width="112" height="72" loading="lazy">
                    </a>
                    <p class="mt-6 max-w-sm text-sm leading-relaxed">
                        A premier construction and contracting company in Qatar, delivering exceptional projects across various sectors.
                    </p>
                    <div class="mt-6 flex items-center gap-3">
                        <a href="https://www.linkedin.com/company/shannon-engineering" target="_blank" rel="noopener" aria-label="LinkedIn"
                           class="flex h-10 w-10 items-center justify-center rounded-full bg-white/5 text-gray-300 ring-1 ring-white/10 transition hover:-translate-y-0.5 hover:bg-[#0a66c2] hover:text-white">
                            <svg viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path d="M4.98 3.5C4.98 4.88 3.86 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1s2.48 1.12 2.48 2.5zM.5 8h4V23h-4V8zm7.5 0h3.8v2.05h.05c.53-1 1.84-2.05 3.8-2.05 4.06 0 4.8 2.67 4.8 6.15V23h-4v-7.3c0-1.74-.03-3.98-2.43-3.98-2.44 0-2.81 1.9-2.81 3.86V23h-4V8z"/></svg>
                        </a>
                        <a href="https://www.facebook.com/ShannonEngineering" target="_blank" rel="noopener" aria-label="Facebook"
                           class="flex h-10 w-10 items-center justify-center rounded-full bg-white/5 text-gray-300 ring-1 ring-white/10 transition hover:-translate-y-0.5 hover:bg-[#1877f2] hover:text-white">
                            <svg viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path d="M22 12a10 10 0 1 0-11.5 9.9v-7h-2.3V12h2.3V9.8c0-2.3 1.4-3.6 3.5-3.6 1 0 2 .2 2 .2v2.2h-1.1c-1.1 0-1.5.7-1.5 1.4V12h2.6l-.4 2.9h-2.2v7A10 10 0 0 0 22 12z"/></svg>
                        </a>
                        <a href="https://youtube.com/@shannonengineering8110?si=_4jo1PEImon7J0Hn" target="_blank" rel="noopener" aria-label="YouTube"
                           class="flex h-10 w-10 items-center justify-center rounded-full bg-white/5 text-gray-300 ring-1 ring-white/10 transition hover:-translate-y-0.5 hover:bg-[#ff0000] hover:text-white">
                            <svg viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.6 3.5 12 3.5 12 3.5s-7.6 0-9.4.6A3 3 0 0 0 .5 6.2C0 8 0 12 0 12s0 4 .5 5.8a3 3 0 0 0 2.1 2.1c1.8.6 9.4.6 9.4.6s7.6 0 9.4-.6a3 3 0 0 0 2.1-2.1c.5-1.8.5-5.8.5-5.8s0-4-.5-5.8zM9.5 15.5v-7l6 3.5-6 3.5z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Company -->
                <div class="lg:col-span-2">
                    <h3 class="font-display text-sm font-semibold uppercase tracking-[0.2em] text-white">Company</h3>
                    <ul class="mt-5 space-y-3 text-sm">
                        @foreach($aboutLinks as $link)
                            <li><a href="{{ route($link['route']) }}" class="transition hover:text-white">{{ $link['label'] }}</a></li>
                        @endforeach
                        <li><a href="{{ route('safety') }}" class="transition hover:text-white">Safety, Health &amp; Environment</a></li>
                        <li><a href="{{ route('sister-companies') }}" class="transition hover:text-white">SEC Group</a></li>
                        <li><a href="{{ route('careers') }}" class="transition hover:text-white">Careers</a></li>
                    </ul>
                </div>

                <!-- Projects -->
                <div class="lg:col-span-2">
                    <h3 class="font-display text-sm font-semibold uppercase tracking-[0.2em] text-white">Projects</h3>
                    <ul class="mt-5 space-y-3 text-sm">
                        <li><a href="{{ route('ongoingProjects') }}" class="transition hover:text-white">Ongoing Projects</a></li>
                        @foreach($projectCategories as $category)
                            <li><a href="{{ route('listprojects', $category->id) }}" class="transition hover:text-white">{{ $category->category }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <!-- Contact -->
                <div class="lg:col-span-4">
                    <h3 class="font-display text-sm font-semibold uppercase tracking-[0.2em] text-white">Contact Us</h3>
                    <ul class="mt-5 space-y-4 text-sm">
                        <li class="flex gap-3">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                            <span>Al Gassar Tower, 19th Floor, West Bay<br>P.O. Box: 24041<br>Doha, Qatar</span>
                        </li>
                        <li class="flex gap-3">
                            <svg class="h-5 w-5 shrink-0 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106a1.125 1.125 0 0 0-1.173.417l-.97 1.293a1.125 1.125 0 0 1-1.21.38 12.035 12.035 0 0 1-7.143-7.143 1.125 1.125 0 0 1 .38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                            <a href="tel:+97444355656" class="transition hover:text-white">+974 4435 5656</a>
                        </li>
                        <li class="flex gap-3">
                            <svg class="h-5 w-5 shrink-0 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                            <a href="mailto:info@shannoneng.com" class="transition hover:text-white">info@shannoneng.com</a>
                        </li>
                    </ul>
                    <div class="mt-6 h-40 overflow-hidden rounded-2xl ring-1 ring-white/10">
                        <iframe
                            title="Shannon Engineering Location Map"
                            src="https://www.google.com/maps?q=Al+Gassar+Tower,+Doha,+Qatar&output=embed"
                            allowfullscreen
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            class="h-full w-full border-0 grayscale-[60%] transition duration-500 hover:grayscale-0"
                        ></iframe>
                    </div>
                </div>
            </div>

            <!-- Bottom bar -->
            <div class="flex flex-col items-center justify-between gap-6 border-t border-white/10 py-8 md:flex-row">
                <p class="text-center text-sm md:text-left">
                    © {{ date('Y') }} Shannon Engineering Company. All rights reserved.
                </p>
                <div class="flex flex-wrap items-center justify-center gap-3">
                    <img src="{{ asset('images/iso/iso_1.png') }}" alt="ISO Certification 1" class="h-14 w-auto rounded-lg bg-white p-1" loading="lazy" decoding="async">
                    <img src="{{ asset('images/iso/iso_2.png') }}" alt="ISO Certification 2" class="h-14 w-auto rounded-lg bg-white p-1" loading="lazy" decoding="async">
                    <img src="{{ asset('images/iso/iso_3.png') }}" alt="ISO Certification 3" class="h-14 w-auto rounded-lg bg-white p-1" loading="lazy" decoding="async">
                    <img src="{{ asset('images/iso/icv.jpg') }}" alt="ICV Certification" class="h-14 w-auto rounded-lg bg-white p-1" loading="lazy" decoding="async">
                </div>
            </div>
        </div>
    </footer>

    <!-- ============ FLOATING ACTIONS ============ -->
    <div x-data="{ show: false }" @scroll.window.passive="show = window.scrollY > 600"
         class="fixed bottom-5 right-5 z-40 flex flex-col items-center gap-3 md:bottom-8 md:right-8">
        <a href="https://youtube.com/@shannonengineering8110" target="_blank" rel="noopener noreferrer" aria-label="Visit our YouTube channel"
           class="flex h-12 w-12 items-center justify-center rounded-full bg-red-600 text-white shadow-xl shadow-red-600/30 ring-1 ring-black/5 transition hover:-translate-y-0.5 hover:bg-red-700">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
        </a>
        <a href="https://www.facebook.com/ShannonEngineering" target="_blank" rel="noopener noreferrer" aria-label="Facebook"
           class="flex h-12 w-12 items-center justify-center rounded-full bg-[#1877f2] text-white shadow-xl shadow-blue-600/30 ring-1 ring-black/5 transition hover:-translate-y-0.5">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12a10 10 0 1 0-11.5 9.9v-7h-2.3V12h2.3V9.8c0-2.3 1.4-3.6 3.5-3.6 1 0 2 .2 2 .2v2.2h-1.1c-1.1 0-1.5.7-1.5 1.4V12h2.6l-.4 2.9h-2.2v7A10 10 0 0 0 22 12z"/></svg>
        </a>
        <button type="button" x-show="show" x-cloak x-transition @click="window.scrollTo({ top: 0, behavior: 'smooth' })" aria-label="Back to top"
                class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-900 text-white shadow-xl ring-1 ring-white/10 transition hover:-translate-y-0.5 hover:bg-black">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/></svg>
        </button>
    </div>

    @yield('component')
    @livewireScripts
    @stack('scripts')
</body>

</html>
