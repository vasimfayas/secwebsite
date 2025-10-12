@extends('layouts.app')

@section('title', 'Our Clients - Shannon Engineering Company')

@section('content')
<!-- Hero Section -->
<section class="relative text-white h-[420px] md:h-[340px] bg-cover bg-center bg-no-repeat"
         aria-label="Strategic Partners hero"
         style="background-image: url('{{ asset('images/home/banner2.png') }}');">

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
      <!-- 3D shadow layer (behind) -->
    

      <!-- main title -->
      <h1 class="relative text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight
                 drop-shadow-[0_6px_20px_rgba(0,0,0,0.45)]">
        <span class="bg-clip-text text-transparent bg-gradient-to-br from-white to-gray-200">
          Strategic <span class="text-red-400">Partners</span>
        </span>
      </h1>

      <!-- subtle accent line -->
      <div class="mx-auto mt-4 h-[3px] w-24 rounded-full bg-gradient-to-r from-red-500 via-red-400 to-red-500 opacity-90"></div>
    </div>
  </div>
</section>


<!-- Client Logos -->
<section class="py-20 bg-gray-50 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4 section-title inline-block">
                Trusted By Leading Organizations
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                We're proud to partner with leading Organization across Qatar, delivering projects that reflected our success, excellence & commitment
            </p>
        </div>

        @php
        $logos = [
        '1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg',
        '6.png', '7.png', '8.jpg', '9.jpg', '10.jpg',
        '11.jpg', '12.jpg', '13.jpg',
        ];
        @endphp

        <div class="relative w-full overflow-hidden">
            <div class="animate-scroll flex gap-6 py-2 whitespace-nowrap min-w-max">
                @foreach(array_merge($logos, $logos,$logos) as $logo)
                <div class="w-36 h-24 flex items-center justify-center bg-white rounded-lg shadow-md p-2 shrink-0">
                    <img src="{{ asset('images/client/' . $logo) }}"
                        alt="Client Logo"
                        class="h-full w-full object-contain" />
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Client Testimonials -->
<section id="consultants" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4 section-title inline-block">
                Consultants We Work With
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                We proudly collaborate with some of the most reputable consulting firms in Qatar,<br> delivering projects that reflect shared values of success, excellence, and commitment.
            </p>
        </div>
        @php
        $consultant = [
        '1.jpg', '2.png', '3.jpg', '4.jpg', '5.jpg',
        '6.jpg', '7.png', '8.jpg', '9.jpg', '10.jpg',
        '11.jpg','12.png'
        ];
        @endphp

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-8 items-center">
            @foreach($consultant as $logo)
            <div class="w-full h-24 bg-white flex items-center justify-center p-4 border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition">
                <img src="{{ asset('images/consultant/' . $logo) }}"
                    alt="Consulting Logo"
                    class="h-full w-full object-contain grayscale hover:grayscale-0 transition duration-300" />
            </div>
            @endforeach
        </div>

    </div>
</section>


<!-- Call to Action -->
<section class="py-20 bg-red-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold mb-6">
            Join Our Satisfied Clients
        </h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">
            Experience the Shannon Engineering difference. Let us bring your construction vision to life with excellence and innovation.
        </p>
        <a href="{{ route('contact') }}" class="bg-white text-red-600 hover:bg-gray-100 px-8 py-4 rounded-lg font-semibold text-lg inline-block transition-all duration-300">
            Start Your Project
        </a>
    </div>
</section>
@endsection

@push('scripts')
<style>
    @keyframes scroll {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-33.5%);
        }
    }

    .animate-scroll {
        animation: scroll 35s linear infinite;
        display: flex;
    }

    .animate-scroll:hover {
        animation-play-state: paused;
    }
</style>
@endpush