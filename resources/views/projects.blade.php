@extends('layouts.app')

@php
    // One listing for every combination of the two filters: ongoing yes/no × category.
    $url = function ($categoryId, $status) {
        if ($categoryId) {
            return route('listprojects', array_filter(['cat' => $categoryId, 'status' => $status]));
        }
        return $status === 'ongoing' ? route('ongoingProjects') : route('projects', array_filter(['status' => $status]));
    };

    $statusLabel = ['ongoing' => 'Ongoing', 'delivered' => 'Delivered'][$status] ?? null;

    if ($category) {
        $heroTitle = $category->category;
        $heroSubtitle = $category->description ?: 'Explore our delivered and under construction projects in this category.';
    } else {
        $heroTitle = $statusLabel ?? 'Our';
        $heroSubtitle = match ($status) {
            'ongoing' => 'Projects currently under construction across Qatar.',
            'delivered' => 'Completed projects delivered with success, excellence and commitment.',
            default => 'Reflected SEC success through diverse, high quality engineering achievements.',
        };
    }

    $crumbs = ['Projects' => route('projects')];
    if ($category) $crumbs[$category->category] = $url($category->id, null);
    if ($statusLabel) $crumbs[$statusLabel] = null;
    if (! $category && ! $statusLabel) $crumbs = ['Projects' => null];
    else $crumbs[array_key_last($crumbs)] = null;
@endphp

@section('title', trim(($statusLabel ? $statusLabel . ' ' : '') . ($category ? $category->category . ' ' : '') . 'Projects') . ' - Shannon Engineering Company')

@section('content')

<x-page-hero
    :title="$heroTitle"
    highlight="Projects"
    :subtitle="$heroSubtitle"
    :eyebrow="$category && $statusLabel ? $statusLabel : null"
    :image-url="$category?->card_img ? asset('storage/' . $category->card_img) : null"
    :crumbs="$crumbs"
/>

<!-- ============ FILTERS ============ -->
<div class="sticky top-20 z-30 border-b border-gray-100 bg-white/90 backdrop-blur-xl">
    <div class="mx-auto flex max-w-7xl flex-col gap-3 px-4 py-3 sm:px-6 lg:flex-row lg:items-center lg:gap-6 lg:px-8">

        <!-- Ongoing yes / no -->
        <nav aria-label="Project status" class="flex shrink-0 rounded-full bg-gray-100 p-1">
            @foreach (['' => 'All', 'ongoing' => 'Ongoing', 'delivered' => 'Delivered'] as $key => $label)
                @php $active = $status === ($key ?: null); @endphp
                <a href="{{ $url($category?->id, $key ?: null) }}"
                   @if($active) aria-current="page" @endif
                   class="inline-flex flex-1 items-center justify-center gap-2 whitespace-nowrap rounded-full px-4 py-2 text-sm font-semibold transition-all duration-300
                   {{ $active ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-900' }}">
                    @if ($key === 'ongoing')
                        <span class="h-2 w-2 rounded-full bg-yellow-400 {{ $active ? 'animate-pulse' : '' }}"></span>
                    @elseif ($key === 'delivered')
                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                    @endif
                    {{ $label }}
                    <span class="rounded-full px-1.5 text-xs {{ $active ? 'bg-red-600 text-white' : 'bg-gray-200 text-gray-600' }}">{{ $statusCounts[$key ?: 'all'] }}</span>
                </a>
            @endforeach
        </nav>

        <!-- Sector (dropdown: scales to any number of categories) -->
        <div class="relative lg:ml-auto" x-data="{ open: false, q: '' }" @keydown.escape.window="open = false" @click.outside="open = false">
            <button type="button" @click="open = !open; if (open) $nextTick(() => $refs.q?.focus())" :aria-expanded="open"
                    class="flex w-full items-center justify-between gap-3 rounded-full border px-5 py-2.5 text-sm font-semibold transition lg:w-auto lg:min-w-[260px]
                    {{ $category ? 'border-gray-900 bg-gray-900 text-white' : 'border-gray-200 bg-white text-gray-800 hover:border-gray-300' }}">
                <span class="flex items-center gap-2 truncate">
                    <svg class="h-4 w-4 shrink-0 {{ $category ? 'text-white/70' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z"/></svg>
                    <span class="{{ $category ? 'text-white/60' : 'text-gray-400' }}">Sector:</span>
                    <span class="truncate">{{ $category?->category ?? 'All sectors' }}</span>
                </span>
                <svg class="h-4 w-4 shrink-0 transition-transform duration-300" :class="open && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7"/></svg>
            </button>

            <div x-show="open" x-cloak
                 x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 class="absolute right-0 z-40 mt-2 w-full overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-[0_24px_60px_-20px_rgba(16,24,40,.35)] lg:w-[560px]">
                @if ($categories->count() > 8)
                    <div class="border-b border-gray-100 p-3">
                        <input x-ref="q" x-model="q" type="search" placeholder="Search sectors…"
                               class="w-full rounded-xl border-0 bg-gray-100 px-4 py-2.5 text-sm outline-none focus:outline-none focus:ring-2 focus:ring-red-500/60">
                    </div>
                @endif
                <div class="max-h-[60vh] overflow-y-auto p-2">
                    <a href="{{ $url(null, $status) }}"
                       class="flex items-center justify-between rounded-xl px-4 py-2.5 text-sm font-semibold transition {{ ! $category ? 'bg-red-50 text-red-600' : 'text-gray-800 hover:bg-gray-50' }}"
                       x-show="!q">
                        All sectors <span class="text-xs font-medium text-gray-400">{{ $allCount }}</span>
                    </a>
                    <div class="grid grid-cols-1 gap-0.5 sm:grid-cols-2">
                        @foreach ($categories as $cat)
                            <a href="{{ $url($cat->id, $status) }}"
                               x-show="!q || @js(\Illuminate\Support\Str::lower($cat->category)).includes(q.toLowerCase())"
                               class="flex items-center justify-between gap-3 rounded-xl px-4 py-2.5 text-sm transition
                               {{ $category?->id === $cat->id ? 'bg-red-50 font-semibold text-red-600' : ($cat->projects_count ? 'text-gray-700 hover:bg-gray-50' : 'text-gray-400 hover:bg-gray-50') }}">
                                <span class="truncate">{{ $cat->category }}</span>
                                <span class="shrink-0 rounded-full bg-gray-100 px-2 py-0.5 text-xs font-medium {{ $cat->projects_count ? 'text-gray-600' : 'text-gray-400' }}">{{ $cat->projects_count }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============ RESULTS ============ -->
<section class="bg-gray-50 py-16 md:py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <p class="mb-8 text-sm font-medium text-gray-500">
            {{ $projects->count() }} {{ \Illuminate\Support\Str::plural('project', $projects->count()) }}
            @if ($statusLabel) · <span class="text-gray-900">{{ strtolower($statusLabel) }}</span>@endif
            @if ($category) · <span class="text-gray-900">{{ $category->category }}</span>@endif
        </p>

        @if ($projects->isEmpty())
            <div class="rounded-3xl border border-dashed border-gray-300 bg-white px-6 py-20 text-center">
                <p class="font-display text-xl font-semibold text-gray-900">No {{ $statusLabel ? strtolower($statusLabel) . ' ' : '' }}projects {{ $category ? 'in ' . $category->category : '' }} yet.</p>
                <p class="mt-2 text-gray-500">Try another filter.</p>
                <div class="mt-6 flex flex-wrap justify-center gap-3">
                    @if ($status)
                        <a href="{{ $url($category?->id, null) }}" class="btn-outline">Show all statuses</a>
                    @endif
                    @if ($category)
                        <a href="{{ $url(null, $status) }}" class="btn-outline">Show all sectors</a>
                    @endif
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3" data-reveal-stagger>
                @foreach ($projects as $project)
                    <x-project-card :project="$project" :href="route('detailprojects', $project->id)" data-reveal />
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
