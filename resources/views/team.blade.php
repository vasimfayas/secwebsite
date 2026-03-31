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
<section id="team" class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-bold text-red-700 text-center">Our Team</h2>
    <p class="mt-2 text-center text-gray-500">People behind the work</p>

    <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">

      @php
        $team = [
          ['name'=>'Hany Abdel Fattah','role'=>'CEO','message'=>'Building systems that scale and teams that thrive.'],
          ['name'=>'Badawi Gaber Badawi','role'=>'Operations Manager','message'=>'Driving operations that deliver excellence.'],
          ['name'=>'Ehab Mahmoud Abbas','role'=>'Projects Manager','message'=>'Delivering projects on time and beyond expectations.'],
          ['name'=>'M.Dushyantha Saman K Cooray','role'=>'Tender Manager','message'=>'Precision and planning make the best bids.'],
          ['name'=>'Santhosh Kumar','role'=>'Accounts Manager','message'=>'Balancing books, powering growth.'],
          ['name'=>'Ibrahim Abdelhafez','role'=>'HR Manager','message'=>'Empowering people to achieve their best.'],
        ];
      @endphp

      @foreach($team as $member)
      <div class="relative group rounded-2xl overflow-hidden shadow-lg border border-red-200 bg-gradient-to-br from-white via-red-50 to-white transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">

        <div class="p-6 flex flex-col items-center text-center space-y-2 relative">

          <!-- Name & Role -->
          <h3 class="text-lg font-semibold text-gray-900 group-hover:text-red-700 transition-colors">{{ $member['name'] }}</h3>
          <p class="text-sm text-gray-600 group-hover:text-red-500 transition-colors">{{ $member['role'] }}</p>

          <!-- Slide-Up Message -->
          <div class="message absolute bottom-0 left-0 right-0 bg-red-600 text-white p-4 text-sm rounded-t-xl -translate-y-full opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
            {{ $member['message'] }}
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