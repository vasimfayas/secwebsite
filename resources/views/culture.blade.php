@extends('layouts.app')

@section('title', 'Our Culture')

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
        <span class="drop-shadow-[0_6px_18px_rgba(0,0,0,0.45)]">Our </span>
        <span class="text-red-400 drop-shadow-[0_6px_18px_rgba(0,0,0,0.45)]">Culture</span>
      </h1>
      <p class="mt-2 text-sm md:text-lg text-white/90">
        Building Qatar's future with success, excellence & commitment.
      </p>
    </div>
  </div>
</section>

<section class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-3 text-sm text-gray-600 flex items-center gap-2">

        <a href="{{ route('about') }}"
           class="{{ request()->routeIs('about') ? 'text-red-600 font-semibold' : 'hover:text-red-600 transition' }}">
            Message From Our CEO
        </a>
     <span class="text-gray-400">/</span>

        <a href="{{ route('about.vision') }}"
           class="{{ request()->routeIs('about.vision') ? 'text-red-600 font-semibold' : 'hover:text-red-600 transition' }}">
            Mission, Vision & Values
        </a>
        <span class="text-gray-400">/</span>

        <a href="{{ route('about.team') }}"
           class="{{ request()->routeIs('about.team') ? 'text-red-600 font-semibold' : 'hover:text-red-600 transition' }}">
            Meet Our Team
        </a>
         <span class="text-gray-400">/</span>
          <a href="{{ route('about.culture') }}"
           class="{{ request()->routeIs('about.culture') ? 'text-red-600 font-semibold' : 'hover:text-red-600 transition' }}">
            Our Culture
        </a>

   

    </div>
</section>


<!-- CONTENT -->
<section class="py-20 bg-white">
  <div class="max-w-5xl mx-auto px-4">

    <h2 class="text-4xl font-bold text-gray-800 mb-8 text-center">
      Our Culture
    </h2>

    <div class="space-y-6 text-gray-600 text-lg leading-8 text-justify">

      <p>
 Staff-first culture where trust, respect, and teamwork drive performance
      </p>
    
      <p>

     
At Shannon Engineering, we believe our people are our greatest asset. We encourage a unified, family-driven culture where every individual-across all levels-is valued, respected, and empowered to contribute.
      </p>
      <p>
Our culture is rooted in trust, accountability, and a shared commitment to excellence. We recognize that every contribution matters, and it is this collective dedication that drives our performance and enables us to consistently deliver exceptional results.
      </p>

<p>
    Shannon Engineering operate as one team, aligned by a common purpose and a strong sense of belonging. This commitment extends beyond the workplace, where regular events and team engagements strengthen collaboration, foster engagement, and enhance our working environment.
</p>
<p>Shannon Engineering actively invest in building a high-performance culture-one that promotes collaboration, accelerates professional growth, and supports long-term sustainability.</p>
<p>Shannon Engineering are more than a company—we are family working together to achieve lasting Success, Excellence and Commitment</p>
     

  

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