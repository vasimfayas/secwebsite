@extends('layouts.app')

@section('title',   'On Going Projects - Shannon Engineering Company')

@section('content')

<x-page-hero title="Ongoing" highlight="Projects" subtitle="Projects currently under construction across Qatar." :crumbs="['Projects' => route('projects'), 'Ongoing' => null]" />

<section class="bg-gray-50 py-20 md:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-14 flex flex-col items-start justify-between gap-6 md:flex-row md:items-end" data-reveal>
            <div class="max-w-2xl">
                <p class="eyebrow">Under construction</p>
                <h2 class="section-heading">On Going Projects</h2>
                <p class="section-lead">
                    Our ongoing projects reflect Shannon Engineering’s continuous growth and trusted reputation in Qatar’s construction sector.
                </p>
            </div>
            @unless($projects->isEmpty())
                <div class="flex items-center gap-3 rounded-2xl bg-white px-5 py-4 shadow-sm ring-1 ring-gray-100">
                    <span class="font-display text-4xl font-bold text-red-600">{{ $projects->count() }}</span>
                    <span class="text-sm font-medium leading-tight text-gray-500">Active<br>sites</span>
                </div>
            @endunless
        </div>

        @if($projects->isEmpty())
            <div class="rounded-3xl border border-dashed border-gray-300 bg-white py-20 text-center text-lg text-gray-500">
                No projects found under this category at the moment.
            </div>
        @else
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3" data-reveal-stagger>
                @foreach($projects as $project)
                    <x-project-card :project="$project" :href="route('ongoingdetails', $project->id)" data-reveal />
                @endforeach
            </div>
        @endif

        <div class="mt-16 text-center">
            <a href="{{ route('projects') }}" class="btn-outline">
                Browse all projects
                <svg class="btn-arrow h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>
@endsection
