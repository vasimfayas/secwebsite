@extends('layouts.app')

@section('title', 'Shannon Engineering Company - Building Qatar\'s Future with Excellence and Innovation')

@section('content')
@php use Illuminate\Support\Str; @endphp
<section
x-data="{
    currentSlide: 1,
    transitioning: false,
    slides: [
        '/images/home/shaqab.png',
        '/images/home/mosque.webp',
        '/images/home/villa.jpg', 
         '/images/home/compound.jpg', 
        '/images/home/lexus.webp',
        '/images/home/home1.jpeg',
        '/images/home/lulu.webp',
        

    ],
    intervalId: null,

    get track() {
        return [this.slides[this.slides.length - 1], ...this.slides, this.slides[0]]
    },

    get realIndex() {
        if (this.currentSlide === 0) return this.slides.length - 1
        if (this.currentSlide === this.track.length - 1) return 0
        return this.currentSlide - 1
    },

  next() {
    if (this.transitioning) return
    this.resetTimer()
    this.transitioning = true
    this.currentSlide++
},

    prev() {
    if (this.transitioning) return
    this.resetTimer()
    this.transitioning = true
    this.currentSlide--
},

goTo(index) {
    if (this.transitioning) return
    this.resetTimer()
    this.transitioning = true
    this.currentSlide = index + 1
},

start() {
    this.intervalId = setInterval(() => this.next(), 5000)
},

resetTimer() {
    clearInterval(this.intervalId)
    this.start()
},

    onTransitionEnd() {
        this.transitioning = false
        if (this.currentSlide === 0) {
            this.currentSlide = this.slides.length
        } else if (this.currentSlide === this.track.length - 1) {
            this.currentSlide = 1
        }
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
            class="flex h-full"
            :style="`
                width: ${track.length * 100}%;
                transform: translateX(-${currentSlide * (100 / track.length)}%);
                transition: ${transitioning ? 'transform 500ms ease-in-out' : 'none'};
            `"
            @transitionend="onTransitionEnd"
        >
            <template x-for="(slide, index) in track" :key="index">
                <div
                    class="relative h-full flex-shrink-0 bg-cover bg-center"
                    :style="`width: ${100 / track.length}%; background-image: url(${slide})`"
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

        <p class="text-base md:text-lg font-medium text-white/70 max-w-lg leading-relaxed mb-10">
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

    {{-- Dot Indicators --}}
    <div class="absolute bottom-10 right-14 flex gap-2 z-20">
        <template x-for="(slide, i) in slides" :key="i">
            <button
                @click="goTo(i)"
                class="rounded-full transition-all duration-300"
                :class="realIndex === i
                    ? 'w-5 h-1.5 bg-yellow-400'
                    : 'w-1.5 h-1.5 bg-white/30 hover:bg-white/60'"
            ></button>
        </template>
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
        <div class="grid grid-cols-1 text-justify lg:grid-cols-2 gap-12 items-center">
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
                <img src="{{asset('/images/home/cap.png')}}"
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
            <h2 class="text-4xl font-bold mb-4">Our Achievements</h2>
            <p class="text-gray-300 text-lg">Numbers that reflect our commitment and excellence</p>
        </div>

        <div
            x-data="counterSection()"
            x-init="startCounting()"
            class="grid grid-cols-2 md:grid-cols-5 gap-5 text-center">

            <!-- Projects Completed: Blueprint/grid icon -->
            <div class="space-y-3">
                <div class="text-red-500 flex justify-center">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" d="M3 21h18M5 21V7l8-4v18M19 21V11l-6-4"/>
                    </svg>
                </div>
                <div class="text-5xl font-bold">
                    <span x-text="projects"></span>
                </div>
                <div class="text-gray-300 text-lg">Projects Completed</div>
            </div>

            <!-- Years Experience: Calendar icon -->
            <div class="space-y-3">
                <div class="text-red-500 flex justify-center">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="14" x2="8" y2="14" stroke-width="3" stroke-linecap="round"/>
                        <line x1="12" y1="14" x2="12" y2="14" stroke-width="3" stroke-linecap="round"/>
                        <line x1="16" y1="14" x2="16" y2="14" stroke-width="3" stroke-linecap="round"/>
                        <line x1="8" y1="18" x2="8" y2="18" stroke-width="3" stroke-linecap="round"/>
                        <line x1="12" y1="18" x2="12" y2="18" stroke-width="3" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="text-5xl font-bold">
                    <span x-text="years"></span>
                </div>
                <div class="text-gray-300 text-lg">Years Experience</div>
            </div>

       

          <!-- Happy Clients: Smiley face icon -->
<div class="space-y-3">
    <div class="text-red-500 flex justify-center">
        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <!-- Face circle -->
            <circle cx="12" cy="12" r="10"/>
            <!-- Eyes -->
            <circle cx="9" cy="10" r="1" fill="currentColor" stroke="none"/>
            <circle cx="15" cy="10" r="1" fill="currentColor" stroke="none"/>
            <!-- Smile -->
            <path d="M8 14 C9 17 15 17 16 14"/>
        </svg>
    </div>
    <div class="text-5xl font-bold">
        <span x-text="clients"></span>+
    </div>
    <div class="text-gray-300 text-lg">Happy Clients</div>
</div>

<!-- Engineers & Staff: Construction hard hat -->
<div class="space-y-3">
    <div class="text-red-500 flex justify-center">
        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <!-- Hat dome -->
            <path d="M12 4 C7 4 4 8 4 12 L20 12 C20 8 17 4 12 4 Z"/>
            <!-- Center ridge stripe -->
            <line x1="12" y1="4" x2="12" y2="12"/>
            <!-- Brim -->
            <line x1="2" y1="12" x2="22" y2="12"/>
            <!-- Brim underside curve -->
            <path d="M2 12 Q2 15 5 15 L19 15 Q22 15 22 12"/>
        </svg>
    </div>
    <div class="text-5xl font-bold">
        <span x-text="engineers"></span>+
    </div>
    <div class="text-gray-300 text-lg">Engineers & Staff</div>
</div>

<!-- Labours: Worker avatar -->
<div class="space-y-3">
    <div class="text-red-500 flex justify-center">
        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <!-- Head -->
            <circle cx="12" cy="6" r="3"/>
            <!-- Neck + torso -->
            <path d="M9 9 C9 9 7 10 7 13 L7 17 L17 17 L17 13 C17 10 15 9 15 9 Z"/>
            <!-- Left arm holding shovel -->
            <line x1="7" y1="12" x2="4" y2="16"/>
            <!-- Shovel blade -->
            <path d="M2 15 L4 16 L5 18 L3 19 Z"/>
            <!-- Right arm out -->
            <line x1="17" y1="12" x2="20" y2="14"/>
            <!-- Legs -->
            <line x1="10" y1="17" x2="9" y2="22"/>
            <line x1="14" y1="17" x2="15" y2="22"/>
        </svg>
    </div>
    <div class="text-5xl font-bold">
        <span x-text="labours"></span>+
    </div>
    <div class="text-gray-300 text-lg">Labours</div>
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

       <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">

    <!-- General Contracting -->
    <div class="group bg-white p-6 rounded-2xl shadow-md border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition duration-300">
        <div class="w-14 h-14 bg-red-100 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition">
            <i class="fa-solid fa-helmet-safety text-red-600 text-xl"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-800 mb-2">General Contracting</h3>
        <p class="text-gray-500 text-sm">
            Complete construction solutions from planning to execution.
        </p>
    </div>

    <!-- Construction -->
    <div class="group bg-white p-6 rounded-2xl shadow-md border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition duration-300">
        <div class="w-14 h-14 bg-red-100 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition">
            <i class="fa-solid fa-building text-red-600 text-xl"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-800 mb-2">Construction</h3>
        <p class="text-gray-500 text-sm">
            Residential and commercial buildings built with precision.
        </p>
    </div>

    <!-- Design & Build -->
    <div class="group bg-white p-6 rounded-2xl shadow-md border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition duration-300">
        <div class="w-14 h-14 bg-red-100 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition">
            <i class="fa-solid fa-drafting-compass text-red-600 text-xl"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-800 mb-2">Design & Build</h3>
        <p class="text-gray-500 text-sm">
            Smart design combined with efficient project execution.
        </p>
    </div>

    <!-- Facilities Management -->
    <div class="group bg-white p-6 rounded-2xl shadow-md border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition duration-300">
        <div class="w-14 h-14 bg-red-100 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition">
            <i class="fa-solid fa-screwdriver-wrench text-red-600 text-xl"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-800 mb-2">Facilities Management</h3>
        <p class="text-gray-500 text-sm">
            Ongoing maintenance and support for building performance.
        </p>
    </div>
        <!-- Facilities Management -->
    <div class="group bg-white p-6 rounded-2xl shadow-md border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition duration-300">
        <div class="w-14 h-14 bg-red-100 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition">
   <i class="fa-solid fa-kitchen-set text-red-600 text-xl"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-800 mb-2">Interior Design</h3>
        <p class="text-gray-500 text-sm">
            ⁠Custom interior solutions that blend style and functionality.
⁠Transforming spaces with creative, modern interior solutions.

        </p>
    </div>

</div>
    </div>
</section>

<!-- Featured Projects -->
<section class="py-10 bg-gray-50">
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
                        <a href="{{ route('ongoingdetails', $project->id) }}" class="inline-block text-red-600 hover:text-red-700 font-semibold">
                                        View Project →
                                    </a>
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
            <a href="{{ route('ongoingProjects') }}"
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
                    <iframe  class="rounded-lg shadow-xl w-full h-full object-cover" width="560" height="315" src="https://www.youtube-nocookie.com/embed/qpmrD94lSqk?autoplay=1&mute=1&controls=1&rel=0&modestbranding=1" title="YouTube video player" frameborder="0" allow="autoplay; encrypted-media" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <div>
                <h2 class="text-4xl font-bold text-gray-800 mb-8 section-title">
                    Why Choose Us
                </h2>

                <div class="space-y-8 text-justify">
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
labours:0,

targetProjects:90,
targetYears:25,
targetClients:85,
targetEngineers:60,
targetLabours:500,

startCounting(){

this.animateValue('projects',this.targetProjects)
this.animateValue('years',this.targetYears)
this.animateValue('clients',this.targetClients)
this.animateValue('engineers',this.targetEngineers)
this.animateValue('labours',this.targetLabours)

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