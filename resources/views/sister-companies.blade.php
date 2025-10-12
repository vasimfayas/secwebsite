@extends('layouts.app')

@section('title', 'Sister Companies - Shannon Engineering Company')

@section('content')
<!-- Hero Section -->
<section class="relative text-white h-[420px] md:h-[340px] bg-cover bg-center bg-no-repeat"
         aria-label="Strategic Partners hero"
         style="background-image: url('{{ asset('images/home/plan.jpg') }}');">

  <!-- gradient + vignette overlay -->
  <div class="absolute inset-0">
    <div class="absolute inset-0 bg-gradient-to-t from-black/65 via-black/35 to-black/15"></div>
    <div class="absolute inset-0 pointer-events-none"
         style="background:
           radial-gradient(120% 70% at 50% 120%, rgba(0,0,0,0.55), transparent 60%),
           radial-gradient(60% 40% at 10% 10%, rgba(255,255,255,0.04), transparent 60%);">
    </div>
  </div>

  <!-- centered content -->
  <div class="absolute inset-0 flex items-center justify-center px-6 text-center">
    <div class="relative inline-block">
      

      <!-- main title -->
      <h1 class="relative text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight
                 drop-shadow-[0_6px_20px_rgba(0,0,0,0.45)]">
        <span class="bg-clip-text text-transparent bg-gradient-to-br from-white to-gray-200">
            <span class="text-red-400">SEC </span>Group
        </span>
      </h1>
      <p class="text-xl max-w-3xl mx-auto">
        Strengthening our capabilities and expanding our impact through strategic subsidiaries and trusted partnerships
    </p>
      <!-- subtle accent line -->
      <div class="mx-auto mt-4 h-[3px] w-24 rounded-full bg-gradient-to-r from-red-500 via-red-400 to-red-500 opacity-90"></div>
    </div>
  </div>
</section>


<!-- Sister Companies -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4 section-title inline-block">
                Our Network
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Through our sister companies, we provide comprehensive solutions across the construction and engineering industry
            </p>
        </div>

        @php
        $logos = [
            ['file' => 'flameLogo.png','name'=>'FLAME QATAR', 'Desp' => 'Grade A electrical expert'],
            ['file' => 'sidra.jpg','name'=>'SIDRA', 'Desp' => 'Grade A mechanical expert'],
            ['file' => 'marble.jpg','name'=>'MarbleArch', 'Desp' => 'Premium specialist in marble & stone work'],
            ['file' => 'acting.jpg','name'=>'ACTING', 'Desp' => 'A state of art to deliver excellence interior'],
        ];
    @endphp
    
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 gap-8 items-stretch">
        @foreach ($logos as $logo)
            <div class="group w-full h-full bg-white p-5 border border-gray-200 rounded-xl shadow-sm hover:shadow-lg hover:border-blue-500 transition-all duration-300 flex flex-col items-center">
                
                <!-- Logo -->
                <div class="h-24 w-full flex items-center justify-center">
                    <img src="{{ asset('images/logo/' . $logo['file']) }}"
                        alt="{{ $logo['name'] }}"
                        class="h-full w-full object-contain grayscale group-hover:grayscale-0 transform group-hover:scale-105 transition duration-300 ease-in-out" />
                </div>
    
                <!-- Name -->
                <p class="mt-3 text-base font-semibold text-gray-800 text-center">
                    {{ $logo['name'] }}
                </p>
    
                <!-- Description -->
                <p class="mt-1 text-sm text-gray-500 text-center">
                    {{ $logo['Desp'] }}
                </p>
            </div>
        @endforeach
    </div>


    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-red-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold mb-6">
            Interested in Partnership?
        </h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">
            Contact us to learn more about partnership opportunities and our expanding network.
        </p>
        <a href="{{ route('contact') }}" class="bg-white text-red-600 hover:bg-gray-100 px-8 py-4 rounded-lg font-semibold text-lg inline-block transition-all duration-300">
            Contact Us
        </a>
    </div>
</section>
@endsection