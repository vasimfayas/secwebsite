@extends('layouts.app')

@section('title', 'Shannon Engineering Company - Building Qatar\'s Future with Excellence and Innovation')

@section('content')
@php use Illuminate\Support\Str; @endphp
<!-- Hero Section -->
<section
    x-data="() => ({
        currentSlide: 0,
        slides: [
            '/images/home/lexus.webp',
            '/images/home/lulu.webp',
            '/images/home/lulu2.webp'
        ],
        intervalId: null,

        goToSlide(i) {
            this.currentSlide = i;
        },
        nextSlide() {
            this.currentSlide = (this.currentSlide + 1) % this.slides.length;
        },
        startAuto() {
            if (this.intervalId) clearInterval(this.intervalId);
            this.intervalId = setInterval(() => this.nextSlide(), 8000);
        },
        init() {
            this.startAuto();
        }
    })"
    x-init="init"
    class="relative min-h-screen flex items-center justify-center text-white overflow-hidden">

    <!-- Sliding Background with Fade Effect -->
    <div class="absolute inset-0 w-full h-full overflow-hidden">
        <template x-for="(slide, index) in slides" :key="index">
            <div class="absolute inset-0 transition-opacity duration-1000"
                :class="{
                    'opacity-100 z-10': currentSlide === index,
                    'opacity-0 z-0': currentSlide !== index
                }"
                :style="`background-image: url(${slide}); background-size: cover; background-position: center;`">
            </div>
        </template>
    </div>

    <!-- Foreground Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
            <span class="text-red-500">S</span>uccess,  <span class="text-red-500">E</span>xcellence,  <span class="text-red-500">C</span>ommitment<br>
        </h1> 
        <h2 class="text-2xl md:text-4xl font-bold mb-6 leading-tight">Driving Qatar’s Future</h2>
       
        <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
            Grade A Construction Company Operating in Qatar
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('projects') }}" class="btn-primary bg-red-600 hover:bg-red-700 text-white px-8 py-4 rounded-lg font-semibold text-lg inline-block">
                Explore Our Projects
            </a>
        </div>
    </div>

    <!-- Dot Navigation -->
    <div class="absolute bottom-6 w-full flex justify-center space-x-3 z-20">
        <template x-for="(slide, index) in slides" :key="index">
            <button
                @click="goToSlide(index)"
                class="w-3 h-3 rounded-full border-2 border-white"
                :class="{
                    'bg-white': currentSlide === index,
                    'bg-transparent': currentSlide !== index
                }">
            </button>
        </template>
    </div>
</section>

<!-- About Shannon Engineering -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-4xl font-bold text-gray-800 mb-6 section-title">
                    About Shannon Engineering
                </h2>
                <p class="text-lg text-gray-600 mb-6">
                    Shannon Engineering Company (SEC) is a Grade A Construction Company operating in the GCC and Middle East. </p>
                <p class="text-lg text-gray-600 mb-8">
                    With a commitment to quality, innovation, and client satisfaction, we have established ourselves as a trusted partner in Qatar's development journey.
                </p>
                <a href="{{ route('about') }}" class="btn-primary bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold inline-block">
                    Learn More About Us
                </a>
            </div>
            <div class="relative">
                <img src="{{asset('/images/home/safety.webp')}}"
                    alt="Modern construction site"
                    class="rounded-lg shadow-xl w-full h-96 object-cover">
            </div>
        </div>
    </div>
</section>

<!-- Our Services -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4 section-title inline-block">
                Our Services
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                We provide comprehensive construction and engineering solutions across various sectors
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Residential Construction -->
            <div class="service-card bg-white p-8 rounded-lg shadow-lg border border-gray-100">
                <div class="w-16 h-16 bg-red-100 rounded-lg flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Residential Construction</h3>
                <p class="text-gray-600">
                    Luxury villas, apartment complexes, and residential communities built to the highest standards of quality and comfort.
                </p>
            </div>

            <!-- Commercial Development -->
            <div class="service-card bg-white p-8 rounded-lg shadow-lg border border-gray-100">
                <div class="w-16 h-16 bg-red-100 rounded-lg flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Commercial Development</h3>
                <p class="text-gray-600">
                    Shopping malls, office buildings, hotels, and retail spaces designed for functionality, aesthetics, and business success.
                </p>
            </div>

            <!-- Industrial Facilities -->
            <div class="service-card bg-white p-8 rounded-lg shadow-lg border border-gray-100">
                <div class="w-16 h-16 bg-red-100 rounded-lg flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Industrial Facilities</h3>
                <p class="text-gray-600">
                    Factories, warehouses, and industrial complexes engineered for efficiency, safety, and operational excellence.
                </p>
            </div>

            <!-- Medical Buildings -->
            <div class="service-card bg-white p-8 rounded-lg shadow-lg border border-gray-100">
                <div class="w-16 h-16 bg-red-100 rounded-lg flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Medical Buildings</h3>
                <p class="text-gray-600">
                    Hospitals, clinics, and healthcare facilities constructed with precision to support modern medical services.
                </p>
            </div>

            <!-- Mosque Construction -->
            <div class="service-card bg-white p-8 rounded-lg shadow-lg border border-gray-100">
                <div class="w-16 h-16 bg-red-100 rounded-lg flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Mosque Construction</h3>
                <p class="text-gray-600">
                    Beautiful and functional mosques that serve as spiritual centers for communities, combining traditional elements with modern engineering.
                </p>
            </div>

            <!-- Engineering Solutions -->
            <div class="service-card bg-white p-8 rounded-lg shadow-lg border border-gray-100">
                <div class="w-16 h-16 bg-red-100 rounded-lg flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Engineering Solutions</h3>
                <p class="text-gray-600">
                    Comprehensive engineering services including structural design, MEP systems, and project management.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Projects -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Signature Projects</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Explore our signature projects that redefine the standards of design, quality, and innovation. 
                They reflect Shannon Engineering’s excellence and commitment to our valued clients.</p> </div>

        @if(count($featuredprojects) === 0)
        <div class="text-center text-gray-500 text-lg py-20">
            No featured projects available at the moment. Please check back later.
        </div>
        @else
        <!-- Scrollable Container -->
        <div
            x-data="{ scroll: $refs.projects }"
            class="relative">

            <!-- Arrow Left -->
            @if(count($featuredprojects) > 3)
            <button @click="scroll.scrollBy({ left: -300, behavior: 'smooth' })"
                class="absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white border border-gray-300 rounded-full p-2 shadow hover:bg-gray-100 hidden md:block">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            @endif

            <!-- Cards -->
            <div
                x-ref="projects"
                class="flex overflow-x-auto space-x-6 pb-4 scroll-smooth snap-x snap-mandatory md:scrollbar-hide 
                {{ count($featuredprojects) === 1 ? 'justify-center' : '' }}">


                @foreach($featuredprojects as $project)
                <div class="min-w-[300px] snap-center bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="{{ 'storage/'.$project['card_img'] }}" alt="{{ $project['title'] }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">{{ $project['title'] }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::words($project['description'], 25, '...') }}</p>
                        <a href="{{ route('detailprojects',$project->id) }}" class="text-red-600 hover:text-red-700 font-semibold">View Project →</a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Arrow Right -->
            @if(count($featuredprojects) > 3)
            <button @click="scroll.scrollBy({ left: 300, behavior: 'smooth' })"
                class="absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white border border-gray-300 rounded-full p-2 shadow hover:bg-gray-100 hidden md:block">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
            @endif
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('projects') }}"
                class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-lg font-semibold inline-block transition-all duration-300">
                View All Projects
            </a>
        </div>
        @endif
    </div>
</section>



<!-- Why Choose Us -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="relative">
                    <iframe  class="rounded-lg shadow-xl w-full h-96 object-cover" width="560" height="315" src="https://www.youtube-nocookie.com/embed/qpmrD94lSqk?si=5WDv1NesVf7NMb-g&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <div>
                <h2 class="text-4xl font-bold text-gray-800 mb-8 section-title">
                    Why Choose Us
                </h2>

                <div class="space-y-8">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">Expertise & Experience</h3>
                        <p class="text-gray-600">
                            Decades of proven experience in the construction industry, our highly skilled team delievers knowledge and hands on experties to every project we undertake.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">Quality & Precision</h3>
                        <p class="text-gray-600">
                            We maintain the highest standards of quality and precision in all our construction and engineering work. Ensuring every detail reflect the trust placed in us.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">Timely Delivery</h3>
                        <p class="text-gray-600">
                            We understand the importance of timelines and ensure that all our projects are guaranteed for on-schedule delivery.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">Client Satisfaction</h3>
                        <p class="text-gray-600">
                            Our client-centric approach ensures that we not only meet but also exceed expectations by listening, understanding, and anticipating their needs. We consistently deliver beyond expectations and build long-term partnerships based on trust.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-red-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold mb-6">
            Ready to Start Your Next Project?
        </h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">
            Contact us today to discuss how Shannon Engineering Company can bring your vision to life.
        </p>
        <a href="{{ route('contact') }}" class="bg-white text-red-600 hover:bg-gray-100 px-8 py-4 rounded-lg font-semibold text-lg inline-block transition-all duration-300">
            Contact Us
        </a>
    </div>
</section>
@endsection