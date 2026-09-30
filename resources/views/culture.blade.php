@extends('layouts.app')

@section('title', 'Our Culture')

@section('content')

<x-page-hero title="Our" highlight="Culture" subtitle="Building Qatar's future with success, excellence & commitment." :crumbs="['About Us' => route('about'), 'Our Culture' => null]" />


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