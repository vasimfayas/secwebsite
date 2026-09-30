@extends('layouts.app')

@section('title', 'Our Projects - Shannon Engineering Company')

@section('content')

<x-page-hero title="Our" highlight="Projects" subtitle="Reflected SEC success through diverse, high quality engineering achievements." :crumbs="['Projects' => null]" />

{{-- Featured Projects (disabled)
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4 section-title inline-block">
                Featured Projects
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Our most significant achievements in construction and engineering
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
            Lulu Abu Sidra Mall 
            <div class="project-card bg-white rounded-lg shadow-xl overflow-hidden">
                <img src="https://images.unsplash.com/photo-1555636222-cae831e670b3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2077&q=80"
                    alt="Lulu Abu Sidra Mall"
                    class="w-full h-64 object-cover">
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Lulu Abu Sidra Mall</h3>
                    <p class="text-gray-600 mb-6">
                        A state-of-the-art shopping mall featuring retail spaces, dining options, and entertainment facilities. This project showcases our expertise in large-scale commercial development with modern architectural design and advanced engineering solutions.
                    </p>
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Commercial</span>
                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Retail</span>
                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Entertainment</span>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                        <div>
                            <strong>Location:</strong> Abu Sidra, Qatar
                        </div>
                        <div>
                            <strong>Completion:</strong> 2023
                        </div>
                        <div>
                            <strong>Size:</strong> 50,000 sqm
                        </div>
                        <div>
                            <strong>Type:</strong> Shopping Mall
                        </div>
                    </div>
                </div>
            </div>

           Lexus Showroom 
            <div class="project-card bg-white rounded-lg shadow-xl overflow-hidden">
                <img src="https://images.unsplash.com/photo-1562141961-d80459d5c4b8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                    alt="Lexus Showroom"
                    class="w-full h-64 object-cover">
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Lexus Showroom</h3>
                    <p class="text-gray-600 mb-6">
                        A premium automotive showroom featuring modern architecture and sophisticated design elements. The project demonstrates our capability in creating luxury commercial spaces that reflect brand excellence and customer experience.
                    </p>
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Commercial</span>
                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Automotive</span>
                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Luxury</span>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                        <div>
                            <strong>Location:</strong> Doha, Qatar
                        </div>
                        <div>
                            <strong>Completion:</strong> 2022
                        </div>
                        <div>
                            <strong>Size:</strong> 3,500 sqm
                        </div>
                        <div>
                            <strong>Type:</strong> Automotive Showroom
                        </div>
                    </div>
                </div>
            </div>
        </div>

       Al Iman Emergency Hospital 
        <div class="project-card bg-white rounded-lg shadow-xl overflow-hidden mb-16">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <img src="https://images.unsplash.com/photo-1586773860418-d37222d8fce3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2073&q=80"
                    alt="Al Iman Emergency Hospital"
                    class="w-full h-64 lg:h-full object-cover">
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Al Iman Emergency Hospital</h3>
                    <p class="text-gray-600 mb-6">
                        A specialized emergency medical facility designed to provide rapid response healthcare services. This project highlights our expertise in healthcare construction with advanced medical infrastructure and patient-centered design.
                    </p>
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Healthcare</span>
                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Emergency</span>
                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Medical</span>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                        <div>
                            <strong>Location:</strong> Doha, Qatar
                        </div>
                        <div>
                            <strong>Completion:</strong> 2023
                        </div>
                        <div>
                            <strong>Size:</strong> 15,000 sqm
                        </div>
                        <div>
                            <strong>Type:</strong> Emergency Hospital
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<!-- Ongoing highlight -->
<section class="relative bg-white py-20 md:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <a href="{{ route('ongoingProjects') }}" data-reveal
           class="group relative isolate flex min-h-[320px] flex-col justify-end overflow-hidden rounded-[2rem] bg-ink-900 p-8 text-white md:p-12">
            <img src="{{ asset('images/optimized/lulu-1920.webp') }}"
                 srcset="{{ asset('images/optimized/lulu-960.webp') }} 960w, {{ asset('images/optimized/lulu-1920.webp') }} 1920w"
                 sizes="(min-width: 1280px) 1216px, 100vw" alt="" loading="lazy" decoding="async"
                 class="absolute inset-0 -z-10 h-full w-full object-cover transition-transform duration-[1.5s] ease-out group-hover:scale-105">
            <div class="absolute inset-0 -z-10 bg-gradient-to-r from-ink-900/95 via-ink-900/60 to-transparent"></div>
            <span class="inline-flex w-fit items-center gap-2 rounded-full bg-yellow-400 px-3 py-1 text-xs font-bold uppercase tracking-wider text-gray-900">
                <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-gray-900"></span> Live sites
            </span>
            <h2 class="mt-4 max-w-xl font-display text-3xl font-bold text-white md:text-5xl">Ongoing Projects</h2>
            <p class="mt-3 max-w-lg text-white/70">See what we are building across Qatar right now.</p>
            <span class="btn-ghost mt-8 w-fit">
                Explore ongoing
                <svg class="btn-arrow h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </span>
        </a>
    </div>
</section>

<!-- Project Categories -->
<section class="bg-gray-50 py-20 md:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto mb-16 max-w-2xl text-center" data-reveal>
            <p class="eyebrow justify-center">Delivered projects</p>
            <h2 class="section-heading">Project Categories</h2>
            <p class="section-lead">We deliver excellence across multiple sectors</p>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3" data-reveal-stagger>
            @foreach($categories as $cat)
            <a href="{{ route('listprojects', $cat->id) }}" data-reveal
               class="group relative isolate flex aspect-[4/5] flex-col justify-end overflow-hidden rounded-3xl bg-ink-900 p-7 text-white shadow-[0_24px_48px_-24px_rgba(16,24,40,.45)]">
                <img src="{{ asset('storage/' . $cat->card_img) }}" alt="{{ $cat->category }} Projects" loading="lazy" decoding="async"
                     class="absolute inset-0 -z-10 h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-110">
                <div class="absolute inset-0 -z-10 bg-gradient-to-t from-black/90 via-black/40 to-black/0 transition-colors duration-500 group-hover:from-red-950/95"></div>

                <h3 class="font-display text-2xl font-semibold text-white">{{ $cat->category }}</h3>
                <div class="grid grid-rows-[1fr] transition-all duration-500 md:grid-rows-[0fr] md:group-hover:grid-rows-[1fr]">
                    <p class="overflow-hidden text-sm leading-relaxed text-white/75">
                        <span class="block pt-3">{{ $cat->description }}</span>
                    </p>
                </div>
                <span class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-white">
                    View projects
                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-white/15 backdrop-blur transition-colors duration-300 group-hover:bg-red-600">
                        <svg class="btn-arrow h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </span>
                </span>
            </a>
            @endforeach
        </div>
    </div>
</section>

@endsection
