@extends('layouts.app')

@section('title', 'Careers - Shannon Engineering Company')

@section('content')

<x-page-hero title="" highlight="Careers" subtitle="Develop talent to grow, lead and shape the future" :crumbs="['Careers' => null]" />



<!-- Why Work With Us -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4 section-title inline-block">
                Why Choose Shannon Engineering?
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Join a team that values excellence, innovation, and professional growth
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Career Growth</h3>
                <p class="text-gray-600">
                    Opportunities for professional development and career advancement in a growing company.
                </p>
            </div>

            <div class="text-center">
                <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Great Team</h3>
                <p class="text-gray-600">
                    Work alongside experienced professionals in a collaborative and supportive environment.
                </p>
            </div>

            <div class="text-center">
                <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Quality Projects</h3>
                <p class="text-gray-600">
                    Be part of landmark projects that shape Qatar's future and leave a lasting impact.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Current Openings -->
<section id="openings" class="bg-gray-50 py-20 md:py-28">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        @if (session()->has('success'))
            <div class="mb-8 rounded-2xl bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-800 ring-1 ring-emerald-200">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-14 flex flex-col items-start justify-between gap-6 md:flex-row md:items-end" data-reveal>
            <div class="max-w-2xl">
                <p class="eyebrow">Join the team</p>
                <h2 class="section-heading">Current Openings</h2>
                <p class="section-lead">Explore exciting career opportunities across various departments</p>
            </div>
            @if ($careers->isNotEmpty())
                <div class="flex items-center gap-3 rounded-2xl bg-white px-5 py-4 shadow-sm ring-1 ring-gray-100">
                    <span class="font-display text-4xl font-bold text-red-600">{{ $careers->count() }}</span>
                    <span class="text-sm font-medium leading-tight text-gray-500">Open<br>{{ Str::plural('position', $careers->count()) }}</span>
                </div>
            @endif
        </div>

        <div class="space-y-5" data-reveal-stagger x-data="{ open: null }"
             x-init="const m = location.hash.match(/^#job-(\d+)$/); if (m) { open = +m[1]; }">
            @forelse($careers as $career)
                <article id="job-{{ $career->id }}" data-reveal
                         class="scroll-mt-28 overflow-hidden rounded-3xl bg-white ring-1 transition-all duration-300"
                         :class="open === {{ $career->id }} ? 'ring-red-200 shadow-[0_24px_60px_-24px_rgba(220,38,38,.35)]' : 'ring-gray-100 shadow-sm hover:shadow-md'">
                    <div class="flex flex-col gap-6 p-6 md:flex-row md:items-center md:p-8">
                        <div class="hidden h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-red-50 text-red-600 md:flex">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                        </div>

                        <div class="min-w-0 flex-1">
                            <h3 class="font-display text-xl font-semibold text-gray-900 md:text-2xl">{{ $career->title }}</h3>
                            <div class="mt-3 flex flex-wrap items-center gap-2 text-xs font-semibold">
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-3 py-1 text-gray-700">
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                    {{ ucfirst($career->period) }}
                                </span>
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-3 py-1 text-gray-700">
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                                    {{ $career->location }}
                                </span>
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-3 py-1 text-gray-700">
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342"/></svg>
                                    {{ ucfirst($career->experience) }}
                                </span>
                                @if ($career->deadline)
                                    @php $daysLeft = (int) today()->diffInDays($career->deadline, false); @endphp
                                    <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 {{ $daysLeft <= 7 ? 'bg-red-50 text-red-700' : 'bg-emerald-50 text-emerald-700' }}">
                                        Apply by {{ $career->deadline->format('F j, Y') }}
                                        @if ($daysLeft <= 7)
                                            · {{ $daysLeft === 0 ? 'last day' : $daysLeft . ' ' . Str::plural('day', $daysLeft) . ' left' }}
                                        @endif
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="flex shrink-0 items-center gap-2">
                            <button type="button" @click="open = open === {{ $career->id }} ? null : {{ $career->id }}"
                                    class="btn-outline px-5 py-3" :aria-expanded="open === {{ $career->id }}">
                                <span x-text="open === {{ $career->id }} ? 'Hide details' : 'Details'">Details</span>
                                <svg class="h-4 w-4 transition-transform duration-300" :class="open === {{ $career->id }} && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7"/></svg>
                            </button>
                            <button type="button" x-data
                                    @click="$dispatch('open-career-modal', { id: {{ $career->id }} })"
                                    class="btn-primary px-6 py-3">
                                Apply Now
                            </button>
                        </div>
                    </div>

                    <div x-show="open === {{ $career->id }}" x-collapse x-cloak>
                        <div class="border-t border-gray-100 px-6 pb-8 pt-6 md:px-8 md:pl-28">
                            <div class="max-w-3xl text-[15px] leading-relaxed text-gray-600">{!! nl2br(e($career->desc)) !!}</div>
                        </div>
                    </div>
                </article>
            @empty
                <div class="rounded-3xl border border-dashed border-gray-300 bg-white px-6 py-16 text-center">
                    <p class="font-display text-xl font-semibold text-gray-900">No openings available at the moment.</p>
                    <p class="mt-2 text-gray-500">We're always glad to hear from talented people. Check back soon.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-red-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold mb-6">
            Ready to Start Your Career?
        </h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">
            Join Shannon Engineering Company and be part of building Qatar's future with excellence and innovation.
        </p>
     

    </div>
</section>

@endsection
@section('component')
@livewire('mail.career')
@endsection