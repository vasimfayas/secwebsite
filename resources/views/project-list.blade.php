@extends('layouts.app')

@section('title', $category->category . ' Projects - Shannon Engineering Company')

@section('content')

<x-page-hero :title="$category->category" highlight="Projects" subtitle="Explore our delivered and under construction projects in this category." :crumbs="['Projects' => route('projects'), $category->category => null]" />

<!-- Category filter -->
<div class="sticky top-20 z-30 border-b border-gray-100 bg-white/85 backdrop-blur-xl">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="scrollbar-hide -mx-4 flex gap-2 overflow-x-auto px-4 py-4 sm:mx-0 sm:flex-wrap sm:justify-center sm:px-0">
            <a href="{{ route('projects') }}"
               class="shrink-0 rounded-full px-5 py-2 text-sm font-semibold transition-all duration-300 bg-gray-100 text-gray-700 hover:bg-gray-200">
                All
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('listprojects', $cat->id) }}"
                   class="shrink-0 rounded-full px-5 py-2 text-sm font-semibold transition-all duration-300
                   {{ $category->id == $cat->id ? 'bg-red-600 text-white shadow-lg shadow-red-600/25' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    {{ $cat->category }}
                </a>
            @endforeach
        </div>
    </div>
</div>

<!-- Projects -->
<section class="bg-gray-50 py-20 md:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-14 max-w-2xl" data-reveal>
            <p class="eyebrow">Portfolio</p>
            <h2 class="section-heading">{{ $category->category }} Projects</h2>
        </div>

        @if($projects->isEmpty())
            <div class="rounded-3xl border border-dashed border-gray-300 bg-white py-20 text-center text-lg text-gray-500">
                No projects found under this category at the moment.
            </div>
        @else
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3" data-reveal-stagger>
                @foreach($projects as $project)
                    <x-project-card :project="$project" :href="route('detailprojects', $project->id)" data-reveal />
                @endforeach
            </div>
        @endif

        <div class="mt-16 text-center">
            <a href="{{ route('projects') }}" class="btn-outline">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18"/></svg>
                Back to Projects
            </a>
        </div>
    </div>
</section>
@endsection
