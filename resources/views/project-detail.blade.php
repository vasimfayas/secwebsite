@extends('layouts.app')

@section('title',$project->title.' Project - Shannon Engineering Company')

@section('content')
<section class="bg-gray-50 py-16" x-data='{
        activeImage: @json(asset("storage/" . $project->card_img)),
        images: @json($images->map(fn($img) => asset("storage/" . $img->image_path)))
    }'>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Hero Image with Thumbnails -->
        <div class="mb-10">
            <!-- Main Image -->
            <div class="rounded-xl overflow-hidden shadow mb-4">
                <img :src="activeImage" alt="Project Image" class="w-full h-96 object-contain transition-all duration-300">
            </div>

            <!-- Thumbnail Queue -->
            <div class="flex space-x-4 overflow-x-auto">
                <template x-for="(img, index) in images" :key="index">
                    <img
                        :src="img"
                        @click="activeImage = img"
                        class="w-28 h-20 object-cover rounded-lg border-2 cursor-pointer transition-all duration-300"
                        :class="{ 'border-red-600': activeImage === img, 'border-transparent': activeImage !== img }">
                </template>
            </div>
        </div>

        <!-- Project Title & Status -->
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-extrabold text-gray-800 mb-2">{{$project->title}}</h1>
          
            <span class="inline-block px-3 py-1 text-xs font-medium rounded-full 
            {{ strtolower($project->status) == 'ongoing' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
            Project Status : {{ strtolower($project->status) == 'ongoing' ? 'Under Construction' : 'Delivered' }}
        </span>
        </div>

        <!-- Project Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 text-gray-700 mb-12">
            <div>
                <h2 class="text-lg font-semibold text-gray-900 mb-2">Client</h2>
                <p></p>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-900 mb-2">Consultant</h2>
             </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 text-gray-700 mb-12">
            <div>
                <h2 class="text-lg font-semibold text-gray-900 mb-2">Location</h2>
                <p>{{$project->location}}</p>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-900 mb-2">Project Size</h2>
                <p>{!! $project->size ? formatIndianNumber($project->size).' m<sup>2</sup>': 'N/A'!!} </p>
            </div>
        </div>

        <!-- Description -->
        <div class="mb-16">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Project Description</h2>
            <p class="text-gray-600 leading-relaxed">
                {{$project->description}}
            </p>
        </div>

        <!-- Back Button -->
        <div class="text-center">
            <a href="{{ route('listprojects',$project->category_id)}}" class="inline-block px-6 py-2 bg-red-600 text-white font-semibold rounded hover:bg-red-700 transition">
                ← Back to Projects
            </a>
        </div>

    </div>
</section>
@endsection