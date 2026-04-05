@extends('layouts.app')

@section('title', 'Sister Companies - Shannon Engineering Company')

@section('content')


<!-- Hero Section -->
<section class="relative text-white h-[300px] md:h-[280px] bg-cover bg-center bg-no-repeat"
         aria-label="Our Projects hero"
         style="background-image: url('{{  asset('images/home/plan.jpg') }}');">

 <!-- gradient + vignette overlay -->
  <div class="absolute inset-0">
    <div class="absolute inset-0 bg-gradient-to-t from-black/65 via-black/35 to-black/15"></div>
    <div class="absolute inset-0 pointer-events-none"
         style="background:
           radial-gradient(120% 70% at 50% 120%, rgba(0,0,0,0.55), transparent 60%),
           radial-gradient(60% 40% at 10% 10%, rgba(255,255,255,0.04), transparent 60%);">
    </div>
  </div>
  <!-- Text Content: glass card, bottom-left -->
  <div class="absolute bottom-10 left-6 right-6  md:left-6 md:right-auto">
    <div class="inline-block rounded-2xl backdrop-blur-md bg-white/10 ring-1 ring-white/20 px-5 py-4 shadow-lg">
      <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight leading-tight drop-shadow">
            <span class="text-red-500">SEC </span>Group
      </h1>
      <p class="mt-1 text-sm md:text-lg text-white/90">
      Strengthening our capabilities and expanding our impact through <br>strategic subsidiaries and trusted partnerships
      </p>
      <div class="mt-3 h-[3px] w-20 rounded-full bg-gradient-to-r from-red-500 via-red-400 to-red-500"></div>
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
    [
        'file' => 'flameLogo.png',
        'name' => 'FLAME QATAR',
        'grade' => 'Electrical Contracting',
        'Desp' => 'specializing in complete range electrical installations with international quality standards for residential, commercial, and industrial projects.',
        'url' => 'https://www.flameqatar.com/',
        'points' => ['Power Systems', 'Lighting Solutions', 'Electrical Design']
    ],
    [
        'file' => 'sidra.jpg',
        'name' => 'SIDRA',
        'grade' => 'Mechanical Contracting',
        'Desp' => 'specializing in advanced mechanical systems, HVAC, plumbing, and comprehensive MEP solutions for commercial and industrial projects.',
        'url' => 'https://sidraengineering.com/',
        'points' => ['HVAC systems', 'Mechanical Design', 'Plumbing & Piping']
    ],
    [
        'file' => 'marble.jpg',
        'name' => 'MarbleArch',
        'grade' => null,
        'Desp' => 'Specializing in premium marble, granite, and natural stone solutions for architectural and interior applications. Delivering exquisite finishes for residential and commercial spaces.',
        'url' => 'https://marblearchqtr.com/',
        'points' => ['Premium Marble & Granite', 'Natural Stone Solutions', 'Architectural Finishes', 'Custom Fabrication']
    ],
    [
        'file' => 'acting.jpg',
        'name' => 'ACTING',
        'grade' => null,
        'Desp' => 'One of the largest suppliers of finishing packages in the Gulf Region, offering premium materials, architectural finishes, and comprehensive interior solutions for luxury projects.',
        'url' => 'https://actingtradecont.com/',
        'points' => ['Finishing Packages', 'Premium Materials', 'Gulf Region Supply', 'Luxury Interiors']
    ],
];
@endphp
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-8 items-stretch">
        @foreach ($logos as $logo)
<div class="group flex flex-col md:flex-row bg-white border border-gray-200 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">

  <!-- Logo Left -->
  <div class="md:w-1/4 flex items-center justify-center  p-6">
      <img src="{{ asset('images/logo/' . $logo['file']) }}" 
           alt="{{ $logo['name'] }}" 
           class="h-24 w-auto object-contain"/>
  </div>

  <!-- Content Right -->
  <div class="md:w-3/4 p-6 flex flex-col">
      <!-- Name -->
      <h3 class="text-2xl font-bold text-gray-800 mb-3">{{ $logo['name'] }}</h3>

   <!-- Full Description -->
<p class="text-gray-700 text-sm mb-4 leading-relaxed">
    @if(!empty($logo['grade']))
        <span class="inline-flex items-center gap-1.5 mr-1 align-middle">
            <span class="relative inline-block font-bold text-white text-[10px] tracking-widest uppercase px-2 py-0.5 rounded select-none"
                  style="
                    background: linear-gradient(160deg, #ef4444 0%, #b91c1c 50%, #ef4444 100%);
                    box-shadow:
                      0 2px 0 #7f1d1d,
                      0 3px 0 #6b1a1a,
                      0 5px 10px rgba(185,28,28,0.4),
                      inset 0 1px 0 rgba(255,255,255,0.3),
                      inset 0 -1px 0 rgba(0,0,0,0.2);
                    text-shadow: 0 1px 3px rgba(0,0,0,0.5);
                  ">
                Grade A
            </span>
            <span class="font-semibold text-gray-800 text-xs">{{ $logo['grade'] }} Company</span>
        </span>
    @endif
    {{ $logo['Desp'] }}
</p>

      <!-- Bullet points -->
      <ul class="text-gray-600 text-sm space-y-2 mb-4">
          @foreach($logo['points'] as $point)
          <li class="flex items-start">
              <span class="w-2 h-2 mt-1 bg-red-500 rounded-full mr-2 flex-shrink-0"></span>
              <span>{{ $point }}</span>
          </li>
          @endforeach
      </ul>

      <!-- Button -->
      <div class="mt-auto text-left md:text-right">
          <a href="{{ $logo['url'] }}" target="blank"
             class="inline-block bg-red-600 hover:bg-red-500 text-white py-2 px-6 rounded-lg font-semibold transition-colors">
             Learn More →
          </a>
      </div>
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