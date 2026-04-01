@extends('layouts.app')

@section('title', 'Shannon Engineering Company - Building Qatar\'s Future with Excellence and Innovation')

@section('content')
@php use Illuminate\Support\Str; @endphp
<section
x-data="{
    currentSlide: 0,
    slides: [
        '/images/home/lexus.webp',
        '/images/home/lulu.webp',
        '/images/home/lulu2.1.png',
    ],
    intervalId: null,

    next() {
        this.currentSlide = (this.currentSlide + 1) % this.slides.length
    },

    prev() {
        this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length
    },

    start() {
        this.intervalId = setInterval(() => this.next(), 8000)
    },

    init() {
        this.start()
    }
}"
x-init="init"
class="relative min-h-screen flex items-center justify-center text-white overflow-hidden bg-black"
>

    {{-- Sliding Track --}}
    <div class="absolute inset-0 overflow-hidden">
        <div
            class="flex h-full transition-transform duration-700 ease-in-out"
            :style="`width: ${slides.length * 100}%; transform: translateX(-${currentSlide * (100 / slides.length)}%)`"
        >
            <template x-for="(slide, index) in slides" :key="index">
                <div
                    class="relative h-full flex-shrink-0 bg-cover bg-center"
                    :style="`width: ${100 / slides.length}%; background-image: url(${slide})`"
                >
                    <div class="absolute inset-0" style="background: linear-gradient(90deg, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.35) 55%, rgba(0,0,0,0.05) 100%);"></div>
                </div>
            </template>
        </div>
    </div>
{{-- Content --}}
<div class="relative z-10 w-full max-w-7xl mx-auto flex flex-col justify-center min-h-screen px-6 md:px-14" style="
    margin-left: 0px;
">

    <p class="text-xs uppercase tracking-[0.2em] text-yellow-400 font-semibold mb-4">
        Qatar's Trusted Contractor
    </p>

    <h1
        class="font-normal leading-tight mb-5"
        style="font-size: clamp(40px, 6vw, 68px);"
    >
        <span class="text-red-500">S</span>uccess<br>
        <span class="text-red-500">E</span>xcellence<br>
        <span class="text-red-500">C</span>ommitment
    </h1>

    <p class="text-sm md:text-base font-light text-white/70 max-w-lg leading-relaxed mb-10">
        Grade A Construction Company Operating in Qatar
    </p>

    <a href="{{ route('projects') }}"
        class="inline-flex items-center gap-3 bg-red-600 hover:bg-red-700 text-white px-8 py-4 font-semibold text-sm tracking-widest uppercase transition w-fit">
        Explore Our Projects
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
    </a>

</div>

    {{-- PREV button --}}
    <button
        @click="prev"
        class="absolute left-5 bottom-10 z-20 w-12 h-12 rounded-full
               flex items-center justify-center
               bg-white/10 border border-white/20
               hover:bg-white/20 hover:border-white/50 transition">
        <svg class="w-5 h-5" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>

    {{-- NEXT button --}}
    <button
        @click="next"
        class="absolute left-20 bottom-10 z-20 w-12 h-12 rounded-full
               flex items-center justify-center
               bg-white/10 border border-white/20
               hover:bg-white/20 hover:border-white/50 transition">
        <svg class="w-5 h-5" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
    </button>

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
                <img src="{{asset('/images/home/QMIC.jpg')}}"
                    alt="Modern construction site"
                    class="rounded-lg shadow-xl w-full h-96 object-cover">
            </div>
        </div>
    </div>
</section>

<!-- Company Statistics -->
<section class="py-20 bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">
                Our Achievements
            </h2>

            <p class="text-gray-300 text-lg">
                Numbers that reflect our commitment and excellence
            </p>
        </div>

        <div 
        x-data="counterSection()"
        x-init="startCounting()"
        class="grid grid-cols-2 md:grid-cols-4 gap-10 text-center">

            <!-- Projects -->
            <div class="space-y-3">
                <div class="text-red-500 flex justify-center">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" d="M3 21h18M5 21V7l8-4v18M19 21V11l-6-4"/>
                    </svg>
                </div>

                <div class="text-5xl font-bold">
                    <span x-text="projects"></span>
                </div>

                <div class="text-gray-300 text-lg">
                    Projects Completed
                </div>
            </div>

            <!-- Experience -->
            <div class="space-y-3">

                <div class="text-red-500 flex justify-center">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor">
                        <path stroke-width="2" d="M12 8v5l3 3M12 3a9 9 0 1 0 0 18"/>
                    </svg>
                </div>

                <div class="text-5xl font-bold">
                    <span x-text="years"></span>
                </div>

                <div class="text-gray-300 text-lg">
                    Years Experience
                </div>

            </div>

            <!-- Clients -->
            <div class="space-y-3">

                <div class="text-red-500 flex justify-center">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor">
                        <path stroke-width="2" d="M17 20h5V4H2v16h5"/>
                    </svg>
                </div>

                <div class="text-5xl font-bold">
                    <span x-text="clients"></span>+
                </div>

                <div class="text-gray-300 text-lg">
                    Happy Clients
                </div>

            </div>

            <!-- Engineers -->
            <div class="space-y-3">

                <div class="text-red-500 flex justify-center">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor">
                        <path stroke-width="2" d="M16 14a4 4 0 1 0-8 0"/>
                    </svg>
                </div>

                <div class="text-5xl font-bold">
                    <span x-text="engineers"></span>+
                </div>

                <div class="text-gray-300 text-lg">
                    Engineers & Staff
                </div>

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
          <h2 class="text-4xl font-bold text-gray-800 mb-4">Ongoing Projects</h2>

<p class="text-lg text-gray-600 max-w-3xl mx-auto">
Our ongoing projects reflect Shannon Engineering’s continuous growth and trusted reputation in Qatar’s construction sector, delivering through Success, Excellence and Commitment.
</p> </div>

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
<script>

function counterSection(){

return{

projects:0,
years:0,
clients:0,
engineers:0,

targetProjects:90,
targetYears:25,
targetClients:85,
targetEngineers:60,

startCounting(){

this.animateValue('projects',this.targetProjects)
this.animateValue('years',this.targetYears)
this.animateValue('clients',this.targetClients)
this.animateValue('engineers',this.targetEngineers)

},

animateValue(field,target){

let duration=2000

let stepTime=Math.abs(Math.floor(duration/target))

let interval=setInterval(()=>{

if(this[field]<target){

this[field]++

}else{

clearInterval(interval)

}

},stepTime)

}

}

}

</script>