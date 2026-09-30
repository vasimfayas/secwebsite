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

        <!-- Category -->
        <nav aria-label="Project category" class="scrollbar-hide -mx-4 flex min-w-0 gap-2 overflow-x-auto px-4 sm:mx-0 sm:px-0">
            <a href="{{ $url(null, $status) }}"
               class="shrink-0 rounded-full px-4 py-2 text-sm font-semibold transition-all duration-300
               {{ ! $category ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                All sectors <span class="ml-1 opacity-60">{{ $allCount }}</span>
            </a>
            @foreach ($categories as $cat)
                <a href="{{ $url($cat->id, $status) }}"
                   class="shrink-0 rounded-full px-4 py-2 text-sm font-semibold transition-all duration-300
                   {{ $category?->id === $cat->id ? 'bg-gray-900 text-white' : ($cat->projects_count ? 'bg-gray-100 text-gray-700 hover:bg-gray-200' : 'bg-gray-50 text-gray-400 hover:bg-gray-100') }}">
                    {{ $cat->category }} <span class="ml-1 opacity-60">{{ $cat->projects_count }}</span>
                </a>
            @endforeach
        </nav>
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
