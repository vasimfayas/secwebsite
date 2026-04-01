@extends('layouts.app')

@section('title', 'Meet Our Team')

@section('content')
<!-- Hero Section -->
<section class="relative text-white h-[420px] md:h-[340px] bg-cover bg-center bg-no-repeat"
         style="background-image: url('{{ asset('images/home/banner1.png') }}');">

  <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent"></div>

  <!-- Hero Text -->
  <div class="absolute bottom-8 left-6 right-6 md:left-6 md:right-auto">
    <div class="inline-block rounded-2xl backdrop-blur-md bg-black/20 ring-1 ring-white/20 px-5 py-4 shadow-lg">
      <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight leading-tight drop-shadow-[0_6px_18px_rgba(0,0,0,0.45)]">
        Meet Our <span class="text-red-400">Team</span>
      </h1>
      <p class="mt-1 text-sm md:text-lg text-white/90">
        Our dedicated professionals are here to support your projects.
      </p>
      <div class="mt-3 h-[3px] w-20 rounded-full bg-gradient-to-r from-red-500 via-red-400 to-red-500"></div>
    </div>
  </div>
</section>

<!-- Team Section -->
<section id="team" class="py-24 bg-red-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="text-center mb-16">
      <p class="text-xs uppercase tracking-[0.25em] text-red-500 font-semibold mb-3">The People Behind The Work</p>
      <h2 class="text-5xl font-black text-gray-900" >Our Team</h2>
      <div class="mt-4 mx-auto w-12 h-[2px] bg-red-600"></div>
    </div>

    @php
      $team = [
        ['name' => 'Hany Abdel Fattah',            'role' => 'CEO',                'message' => 'Leading our vision with commitment to excellence, innovation, and sustainable growth.'],
        ['name' => 'Badawi Gaber Badawi',           'role' => 'Operations Manager', 'message' => 'Ensuring smooth operations and delivering efficiency in every step of our work.'],
        ['name' => 'Ehab Mahmoud Abbas',            'role' => 'Projects Manager',   'message' => 'Driving projects forward with precision, quality, and timely execution.'],
        ['name' => 'M. Dushyantha Saman K Cooray', 'role' => 'Tender Manager',     'message' => 'Securing opportunities through strategic planning and competitive proposals.'],
        ['name' => 'Santhosh Kumar',                'role' => 'Accounts Manager',   'message' => 'Maintaining financial integrity and supporting smart business decisions.'],
        ['name' => 'Ibrahim Abdelhafez',            'role' => 'HR Manager',         'message' => 'Leading workforce transformation through talent excellence and a results-driven culture.'],
      ];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($team as $member)

      <div class="group relative rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500
                  bg-white border-t-4 border-red-500">

        {{-- Subtle red tint background --}}
        <div class="absolute inset-0 bg-gradient-to-br from-red-50/80 via-white to-red-50/40 pointer-events-none"></div>

        {{-- Default State --}}
        <div class="relative flex flex-col items-center text-center px-8 py-14 transition-opacity duration-300 group-hover:opacity-0 group-hover:pointer-events-none">

          <h3 class="text-base font-semibold text-gray-900 leading-snug mb-2">{{ $member['name'] }}</h3>

          <span class="text-[11px] uppercase tracking-[0.18em] text-red-600 font-medium bg-red-100 px-3 py-1 rounded-full">
            {{ $member['role'] }}
          </span>

        </div>

        {{-- Hover State --}}
        <div class="absolute inset-0 bg-red-600 flex flex-col items-center justify-center text-center px-8 py-10
                    translate-y-full group-hover:translate-y-0
                    transition-transform duration-500 ease-in-out">

          <h3 class="text-base font-semibold text-white leading-snug mb-1">{{ $member['name'] }}</h3>

          <span class="text-[11px] uppercase tracking-[0.18em] text-red-200 font-medium bg-white/15 px-3 py-1 rounded-full mb-5">
            {{ $member['role'] }}
          </span>

          <div class="w-8 h-px bg-white/30 mb-5"></div>

          <p class="text-sm text-white/90 leading-relaxed italic">
            "{{ $member['message'] }}"
          </p>

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
            Ready to Build Your Dream?
        </h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">
            Contact Shannon Engineering Company today and let's discuss how we can bring your construction project to life with success story.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="tel:+97444355656" class="bg-white text-red-600 hover:bg-gray-100 px-8 py-4 rounded-lg font-semibold text-lg inline-block transition-all duration-300">
                Call Now
            </a>
            <a href="mailto:info@shannoneng.com" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-red-600 px-8 py-4 rounded-lg font-semibold text-lg inline-block transition-all duration-300">
                Send Email
            </a>
        </div>
    </div>
</section>
@endsection