@extends('layouts.app')

@section('title', 'Our Projects - Shannon Engineering Company')

@section('content')
<!-- Hero Section -->
<section class="bg-gray-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Our Projects</h1>
        <p class="text-xl max-w-3xl mx-auto">
            Explore our portfolio of landmark projects that showcase our expertise and commitment to excellence
        </p>
    </div>
</section>

<!-- Featured Projects
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
</section> -->

<!-- Project Categories -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4 section-title inline-block">
                Project Categories
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                We deliver excellence across multiple sectors
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Residential -->
            @foreach($categories as $cat)
            <div class="bg-white rounded-2xl overflow-hidden shadow group transition-all duration-300 hover:shadow-lg">
                <img src="{{asset('storage/' .$cat->card_img) }}"
                    alt="Residential Projects"
                    class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">{{$cat->category}}</h3>
                    <p class="text-gray-600 mb-4">
                        {{$cat->description}}
                    </p>
                    <div class="text-red-600 font-semibold"><a href="{{route('listprojects',$cat->id)}}">View more--></a></div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-red-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold mb-6">
            Have a Project in Mind?
        </h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">
            Let's discuss how we can bring your construction vision to life with our expertise and commitment to excellence.
        </p>
        <a href="{{ route('contact') }}" class="bg-white text-red-600 hover:bg-gray-100 px-8 py-4 rounded-lg font-semibold text-lg inline-block transition-all duration-300">
            Start Your Project
        </a>
    </div>
</section>
@endsection