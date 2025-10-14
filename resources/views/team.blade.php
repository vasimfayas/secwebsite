@extends('layouts.app')

@section('title', 'Meet Our Team')

@section('content')
<!-- Hero Section -->
<section class="relative text-white h-[420px] md:h-[340px] bg-cover bg-center bg-no-repeat"
         aria-label="Meet Our Team hero"
         style="background-image: url('{{ asset('images/home/banner1.png') }}');">

  <!-- layered overlays: deeper bottom gradient + gentle vignette -->
  <div class="absolute inset-0">
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent"></div>
    <div class="absolute inset-0"
         style="background: radial-gradient(120% 70% at 50% 115%, rgba(0,0,0,.45), transparent 60%);">
    </div>
  </div>

  <!-- content: bottom-left glass card (best for bright photos) -->
  <div class="absolute bottom-8 left-6 right-6  md:left-6 md:right-auto">
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

<!-- Meet Our Team -->
<section id="team" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
   
  
      <div
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10 justify-items-stretch items-stretch
               [grid-auto-rows:1fr]">
        
        <!-- Card -->
        <div class="group bg-white rounded-xl shadow-md p-6 transition-all duration-300 h-full flex flex-col">
          <div class="mx-auto mb-4 rounded-full ring-1 ring-gray-200 overflow-hidden">
            <img
              src="{{ asset('images/team/pp.webp') }}"
              alt="Eng Hany Abdel Fattah"
              class="size-28 aspect-square object-cover" />
          </div>
          <div class="flex-1 flex flex-col">
            <!-- Reserve consistent height for name block to avoid jumpy cards -->
            <div class="min-h-[3.5rem] flex items-start justify-center">
              <h3 class="text-xl font-semibold text-gray-800 leading-tight text-balance">
                Eng Hany Abdel Fattah
              </h3>
            </div>
            <p class="text-gray-500 mt-auto">CEO</p>
          </div>
          <div class="mt-4 h-1 w-0 group-hover:w-full bg-gray-100 transition-all duration-300 rounded-full"></div>
        </div>
  
        <!-- Duplicate cards with only name / role changed -->
        <div class="group bg-white rounded-xl shadow-md p-6 transition-all duration-300 h-full flex flex-col">
          <div class="mx-auto mb-4 rounded-full ring-1 ring-gray-200 overflow-hidden">
            <img src="{{ asset('images/team/pp.webp') }}" alt="Eng Badawi Gaber Badawi"
                 class="size-28 aspect-square object-cover" />
          </div>
          <div class="flex-1 flex flex-col">
            <div class="min-h-[3.5rem] flex items-start justify-center">
              <h3 class="text-xl font-semibold text-gray-800 leading-tight text-balance">
                Eng Badawi Gaber Badawi
              </h3>
            </div>
            <p class="text-gray-500 mt-auto">Operations Manager</p>
          </div>
          <div class="mt-4 h-1 w-0 group-hover:w-full bg-gray-100 transition-all duration-300 rounded-full"></div>
        </div>
  
        <div class="group bg-white rounded-xl shadow-md p-6 transition-all duration-300 h-full flex flex-col">
          <div class="mx-auto mb-4 rounded-full ring-1 ring-gray-200 overflow-hidden">
            <img src="{{ asset('images/team/pp.webp') }}" alt="Eng Ehab Mahmoud Abbas"
                 class="size-28 aspect-square object-cover" />
          </div>
          <div class="flex-1 flex flex-col">
            <div class="min-h-[3.5rem] flex items-start justify-center">
              <h3 class="text-xl font-semibold text-gray-800 leading-tight text-balance">
                Eng Ehab Mahmoud Abbas
              </h3>
            </div>
            <p class="text-gray-500 mt-auto">Projects Manager</p>
          </div>
          <div class="mt-4 h-1 w-0 group-hover:w-full bg-gray-100 transition-all duration-300 rounded-full"></div>
        </div>
  
        <div class="group bg-white rounded-xl shadow-md p-6 transition-all duration-300 h-full flex flex-col">
          <div class="mx-auto mb-4 rounded-full ring-1 ring-gray-200 overflow-hidden">
            <img src="{{ asset('images/team/pp.webp') }}" alt="M.Dushyantha Saman K Cooray"
                 class="size-28 aspect-square object-cover" />
          </div>
          <div class="flex-1 flex flex-col">
            <div class="min-h-[3.5rem] flex items-start justify-center">
              <h3 class="text-xl font-semibold text-gray-800 leading-tight text-balance">
                M.Dushyantha Saman K Cooray
              </h3>
            </div>
            <p class="text-gray-500 mt-auto">Tender Manager</p>
          </div>
          <div class="mt-4 h-1 w-0 group-hover:w-full bg-gray-100 transition-all duration-300 rounded-full"></div>
        </div>
  
        <div class="group bg-white rounded-xl shadow-md p-6 transition-all duration-300 h-full flex flex-col">
          <div class="mx-auto mb-4 rounded-full ring-1 ring-gray-200 overflow-hidden">
            <img src="{{ asset('images/team/pp.webp') }}" alt="Santhosh Kumar"
                 class="size-28 aspect-square object-cover" />
          </div>
          <div class="flex-1 flex flex-col">
            <div class="min-h-[3.5rem] flex items-start justify-center">
              <h3 class="text-xl font-semibold text-gray-800 leading-tight text-balance">
                Santhosh Kumar
              </h3>
            </div>
            <p class="text-gray-500 mt-auto">Accounts Manager</p>
          </div>
          <div class="mt-4 h-1 w-0 group-hover:w-full bg-gray-100 transition-all duration-300 rounded-full"></div>
        </div>
  
        <div class="group bg-white rounded-xl shadow-md p-6 transition-all duration-300 h-full flex flex-col">
          <div class="mx-auto mb-4 rounded-full ring-1 ring-gray-200 overflow-hidden">
            <img src="{{ asset('images/team/pp.webp') }}" alt="Ibrahim Abdelhafez"
                 class="size-28 aspect-square object-cover" />
          </div>
          <div class="flex-1 flex flex-col">
            <div class="min-h-[3.5rem] flex items-start justify-center">
              <h3 class="text-xl font-semibold text-gray-800 leading-tight text-balance">
                Ibrahim Abdelhafez
              </h3>
            </div>
            <p class="text-gray-500 mt-auto">HR Manager</p>
          </div>
          <div class="mt-4 h-1 w-0 group-hover:w-full bg-gray-100 transition-all duration-300 rounded-full"></div>
        </div>
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