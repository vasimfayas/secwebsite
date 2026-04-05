@extends('layouts.app')

@section('title', 'About Us - Shannon Engineering Company')

@section('content')
<!-- Hero Section -->
<section class="relative text-white h-[300px] md:h-[280px] bg-cover bg-center bg-no-repeat"
         aria-label="About hero"
         style="background-image: url('{{ asset('images/home/skyline.jpg') }}');">

   <!-- Overlays: soft white lift + gentle vignette (better on dark images) -->
  <div class="absolute inset-0">
    <!-- subtle white glow behind center/bottom area -->
    <div class="absolute inset-0"
         style="background:
           radial-gradient(60% 45% at 35% 70%, rgba(255,255,255,0.12), transparent 60%),
           radial-gradient(70% 55% at 65% 80%, rgba(255,255,255,0.08), transparent 65%);">
    </div>
    <!-- light vignette to keep edges rich -->
    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/20 to-transparent"></div>
  </div>

  <!-- content: bottom-left glass card (best on light photos) -->
  <div class="absolute bottom-10 left-6 right-6  md:left-6 md:right-auto">
    <div class="backdrop-blur-md bg-white/10 ring-1 ring-white/20 rounded-2xl p-5 md:p-6 shadow-lg">
      <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight leading-tight">
        <span class="drop-shadow-[0_6px_18px_rgba(0,0,0,0.45)]">About</span>
        <span class="text-red-500 drop-shadow-[0_6px_18px_rgba(0,0,0,0.45)]">Us</span>
      </h1>
      <p class="mt-2 text-sm md:text-lg text-white/90">
        Building Qatar's future with success, excellence & commitment.
      </p>
       <div class="mt-3 h-[3px] w-20 rounded-full bg-gradient-to-r from-red-500 via-red-400 to-red-500"></div>
    </div>
  </div>
</section>


<!-- Company Overview (Float Layout) -->
<section class="relative py-20 bg-white">
    <!-- soft gradient glow -->
    <div class="pointer-events-none absolute inset-0 opacity-60"
         style="background:
           radial-gradient(60% 40% at 10% 10%, rgba(255,0,0,0.06), transparent 60%),
           radial-gradient(60% 40% at 90% 20%, rgba(0,0,0,0.03), transparent 60%);">
    </div>
  
    <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-gray-900 mb-8">
        MESSAGE FROM OUR <span class="text-red-600">CEO</span>
      </h2>
      <div class="mt-3 h-0.5 w-24 bg-gradient-to-r from-red-600 to-red-400 mb-10"></div>
  
      <!-- Floating image -->
      <figure class="relative float-right ml-10 mb-6 w-full sm:w-1/2 lg:w-[55%]">
        <div class="relative overflow-hidden rounded-3xl shadow-2xl ring-1 ring-black/5 bg-gray-50">
          <img
            src="{{ asset('images/team/group.jpg') }}"
            alt="Our Team"
            class="w-full h-auto object-contain transition-transform duration-500 hover:scale-[1.03]"
            loading="lazy"
          />
          <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-red-500 via-red-400 to-red-500"></div>
        </div>
     
        <p class="mt-8 text-xs text-gray-500 text-center">
            © Shannon Engineering Team 2017
          </p>
      </figure>
    
  
      <!-- CEO Message -->
      <div class="text-justify leading-7 max-w-none">
        <p class="text-sm sm:text-base text-gray-700 mb-4">
          I would like to start with the story of SEC which is told through our projects, our employees and our commitment to the community around us. We started as a small group of engineers who were inspired to succeed. Since those days, SEC has thrived due to what we have always believed in our clients deserve the best.
        </p>
        <p class="text-sm sm:text-base text-gray-700 mb-4">
          Our success is due to an unwavering commitment to provide our clients with their own unique opportunities to succeed. We ensure that we exceed their expectations by providing them with tailored options and opportunities.
        </p>
        <p class="text-sm sm:text-base text-gray-700 mb-4">
          We have worked hard on recruiting a professional team of engineers and technical personnel. Our team has surpassed all difficulties by staying strong and understanding the market. We believe in strong values of honesty and work ethics. We desire to be the best, with an obligation to success, excellence and commitment to our clients and employees.
        </p>
        <p class="text-sm sm:text-base text-gray-700">
          I would like to extend my sincerest appreciation for our clients’ trust and support of SEC over the years and hereby promise to devote all our resources and attributes to further their success through maintaining our commitment to excellence.
        </p>
      </div>
  
      <!-- Signature -->
      <div class="clear-both mt-10 flex items-center gap-4">
        <div class="h-10 w-10 rounded-full bg-red-600 text-white flex items-center justify-center font-semibold shadow ring-1 ring-black/5">
          H
        </div>
        <p class="text-sm sm:text-base text-gray-800 font-semibold">
          ENG. HANY ABDEL FATTAH<br>
          <span class="text-gray-600 font-normal">CEO</span>
        </p>
      </div>
    </div>
  </section>
  
  
  
{{-- <section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
            
     

            <!-- CEO Message -->
            <div class="lg:col-span-2">
                <h2 class="text-4xl font-bold text-gray-800 mb-6 section-title">
                    MESSAGE FROM <span class="text-red-500">OPERATION MANAGER</span>
                </h2>

                <div class="space-y-6 text-justify">
                   </div>

                <!-- Signature -->
                <p class="text-base text-gray-700 font-semibold mt-8">
                    ENG. BADAWI GABER BADWI MOHAMMED ABDULGLIL<br>
                    Operation Manager
                </p>
            </div>
                   <!-- Left Frame for Future Image -->
                   <div class="lg:col-span-1 flex justify-center">
                    <div class="w-64 h-80 bg-gray-100 border border-gray-300 rounded-xl shadow-md flex items-center justify-center">
                        <span class="text-gray-400 text-sm">OM Image<br>Placeholder</span>
                    </div>
                </div>
        </div>
    </div>
</section> --}}

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