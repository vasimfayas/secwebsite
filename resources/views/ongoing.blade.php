@extends('layouts.app')

@section('title',   'On Going Projects - Shannon Engineering Company')

@section('content')
<!-- Hero Section -->
<section class="relative text-white h-[320px] md:h-[320px] bg-cover bg-center bg-no-repeat"
         style="background-image: url('{{ asset('images/home/skyline.jpg') }}');">
    <div class="absolute inset-0">
        <!-- subtle white glow + vignette overlay -->
        <div class="absolute inset-0"
             style="background:
               radial-gradient(60% 45% at 35% 70%, rgba(255,255,255,0.12), transparent 60%),
               radial-gradient(70% 55% at 65% 80%, rgba(255,255,255,0.08), transparent 65%);">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/20 to-transparent"></div>
    </div>
</section>

<!-- Breadcrumbs & Category Navigation -->
<section class="bg-gray-50 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="text-gray-500 text-sm mb-4" aria-label="Breadcrumb">
            <ol class="list-reset flex flex-wrap gap-2">
                <li><a href="{{ route('home') }}" class="hover:text-red-600">Home</a></li>
                <li>/</li>
                <li><a href="{{ route('projects') }}" class="hover:text-red-600">Our Projects</a></li>
                <li>/</li>
            </ol>
        </nav>

        <!-- Category Navigation -->
        {{-- <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('projects') }}"
               class="px-5 py-2 rounded-full font-semibold transition-colors duration-300
               {{ request()->routeIs('projects') ? 'bg-red-600 text-white' : 'bg-white text-red-600 border border-red-600' }}">
                All
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('listprojects', $cat->id) }}"
                   class="px-5 py-2 rounded-full font-semibold transition-colors duration-300
                   {{ $category->id == $cat->id ? 'bg-red-600 text-white' : 'bg-white text-red-600 border border-red-600' }}">
                    {{ $cat->category }}
                </a>
            @endforeach
        </div> --}}
    </div>
</section>

<!-- Projects Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-16">
            <h2 class="text-4xl font-extrabold text-gray-800 mb-4">On Going Projects</h2>
            <p class="text-lg text-gray-600 max-w-xl mx-auto">
                Explore our delivered and under construction projects in this category.
            </p>
        </div>

        @if($projects->isEmpty())
            <div class="text-center text-gray-500 text-lg py-16">
                No projects found under this category at the moment.
            </div>
        @else
            <!-- Projects Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projects as $project)
                    <div class="bg-white rounded-2xl overflow-hidden shadow group transition-all duration-300 hover:shadow-lg">
                        <!-- Project Image -->
                        @if($project->card_img)
                            <div class="h-48 overflow-hidden">
                                <img src="{{ asset('storage/' . $project->card_img) }}" alt="{{ $project->title }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                            </div>
                        @endif

                        <!-- Project Content -->
                        <div class="p-5 flex flex-col h-full">
                            <div class="flex-grow">
                                <h3 class="text-xl font-semibold text-gray-800 mb-1">{{ $project->title }}</h3>
                                <p class="text-sm text-gray-500 mb-1">{{ $project->location }}</p>
                                <p class="text-sm text-gray-500 mb-2">
                                    <strong>Size: </strong>{!! $project->size ? formatIndianNumber($project->size) . ' m<sup>2</sup>' : 'N/A' !!}
                                </p>
                                <p class="text-sm text-gray-600 mb-4 line-clamp-3">{{ $project->description }}</p>

                                <span class="inline-block px-3 py-1 text-xs font-medium rounded-full
                                    {{ strtolower($project->status) == 'ongoing' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                                    Project Status: {{ strtolower($project->status) == 'ongoing' ? 'Under Construction' : 'Delivered' }}
                                </span>

                                <div class="pt-4 mt-auto">
                                    <a href="{{ route('ongoingdetails', $project->id) }}" class="inline-block text-red-600 hover:text-red-700 font-semibold">
                                        View Project →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Back Button -->
        {{-- <div class="text-center my-10">
            <a href="{{ route('ongoingProjects') }}" class="inline-block px-6 py-2 bg-red-600 text-white font-semibold rounded hover:bg-red-700 transition">
                ← Back to Projects
            </a>
        </div> --}}
    </div>
</section>
@endsection