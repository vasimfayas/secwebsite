@extends('layouts.app')

@section('title', 'Mission, Vision & Values')

@section('content')
<!-- Hero Section -->
<section class="relative text-white h-[420px] md:h-[340px] bg-cover bg-center bg-no-repeat"
         aria-label="About hero"
         style="background-image: url('{{ asset('images/home/skyline.jpg') }}');">

  <!-- layered overlays: gradient + vignette + subtle noise -->
  <div class="absolute inset-0">
    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/35 to-transparent"></div>
    <div class="absolute inset-0"
         style="background: radial-gradient(120% 70% at 50% 120%, rgba(0,0,0,.45), transparent 60%);"></div>
    <div class="absolute inset-0 opacity-[.08] mix-blend-multiply"
         style="background-image:url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%224%22 height=%224%22><rect width=%224%22 height=%224%22 fill=%22%23fff%22/><circle cx=%220.5%22 cy=%220.5%22 r=%220.5%22 fill=%22%23000%22/></svg>');"></div>
  </div>

  <!-- content: bottom-left glass card (best on light photos) -->
  <div class="absolute bottom-8 left-6 right-6  md:left-6 md:right-auto">
    <div class="backdrop-blur-md bg-white/10 ring-1 ring-white/20 rounded-2xl p-5 md:p-6 shadow-lg">
      <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight leading-tight">
        <span class="drop-shadow-[0_6px_18px_rgba(0,0,0,0.45)]">Vision & </span>
        <span class="text-red-400 drop-shadow-[0_6px_18px_rgba(0,0,0,0.45)]">Mission</span>
      </h1>
      <p class="mt-2 text-sm md:text-lg text-white/90">
        Building Qatar's future with success, excellence & commitment.
      </p>
    </div>
  </div>
</section>

<!-- Mission & Vision -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            

            <div class="bg-white p-8 rounded-lg shadow-lg">
                <div class="w-16 h-16 bg-red-100 rounded-lg flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Our Vision</h3>
                <p class="text-gray-600">
                    To be recognized as a market leader in delivering successful, excellent and committed Grade A contracting services. </p>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <div class="w-16 h-16 bg-red-100 rounded-lg flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Our Mission</h3>
                <p class="text-gray-600">
                    Shannon Engineering Company is dedicated to deliver projects with the highest standards of quality, safety, and innovation. We build long-term partnerships with our clients through reliability, technical excellence, and a strong commitment to our people and community.</p> </div>
        </div>
    </div>
</section>

<!-- Our Values -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4 section-title inline-block">
                Our Values
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
Built on trust, driven by excellence </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Excellence
                   </h3>
                <p class="text-gray-600">
                    Delivering superior quality and embracing innovation in every project.
                </p>
            </div>

            <div class="text-center">
                <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Sustainability
                    </h3>
                <p class="text-gray-600">
                    Building with respect for the environment and future generations.
                </p>
            </div>

            <div class="text-center">
                <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Responsibility
                   </h3>
                <p class="text-gray-600">
                    Ensuring safety, integrity, and ethical practices at all times.
                </p>
            </div>

            <div class="text-center">
                <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Partnership</h3>
                <p class="text-gray-600">
                    Creating long-term value through collaboration and client focus.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-red-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold mb-6">
            Ready to Work With Us?
        </h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">
            Let's discuss how Shannon Engineering Company can bring your construction vision to life.
        </p>
        <a href="{{ route('contact') }}" class="bg-white text-red-600 hover:bg-gray-100 px-8 py-4 rounded-lg font-semibold text-lg inline-block transition-all duration-300">
            Get In Touch
        </a>
    </div>
</section>
@endsection