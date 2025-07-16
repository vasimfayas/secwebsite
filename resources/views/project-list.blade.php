@extends('layouts.app')

@section('title',' Projects - Shannon Engineering Company')

@section('content')
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4 section-title">
                {{$category->category }} Projects
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                'Explore our completed projects in the sector.'
            </p>
        </div>

        @if($projects->isEmpty())
        <div class="text-center text-gray-500 text-lg py-16">
            No projects found under this category at the moment.
        </div>
        @else
        <!-- Project Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($projects as $project)
            <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 group">
                <div class="overflow-hidden h-48">
                    <img src="{{ asset($project->card_img.'') }}" alt="{{ $project->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $project->title }}</h3>
                    <p class="text-gray-600 mb-4">{{ $project->description }}</p>
                    <a href="" class="text-red-600 hover:text-red-700 font-semibold">
                        View Project →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection