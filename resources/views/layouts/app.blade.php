<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Shannon Engineering Company - Building Qatar\'s Future')</title>
    <meta name="description" content="@yield('description', 'Shannon Engineering Company (SEC) is a premier construction and contracting company in Qatar, delivering exceptional projects across residential, commercial, industrial, medical, and religious sectors.')">
    <link rel="icon" href="{{ asset('images/logo/logo.png') }}" type="image/png">
    <link rel="preload" href="{{ asset('/images/home/lexus.webp') }}" as="image">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
   
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles


    <!-- Custom CSS -->
    <style>
        [x-cloak]{ display:none !important; }
        .hero-bg {
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .nav-link{
    position: relative;
    padding-bottom: .25rem; /* space for underline */
  }
  .nav-link::after{
    content: "";
    position: absolute;
    left: 0; right: 0; bottom: -2px;
    height: 2px;
    background: linear-gradient(90deg, #ef4444, #f87171, #ef4444); /* red gradient */
    transform: scaleX(0);
    transform-origin: left;
    transition: transform .28s ease;
  }
  /* show underline on hover */
  .nav-link:hover::after{
    transform: scaleX(1);
  }
  /* keep underline visible for the active route */
  .nav-link.is-active::after{
    transform: scaleX(1);
  }
  /* optional: make active text red too */
  .nav-link.is-active{
    color: #dc2626; /* Tailwind red-600 */
  }

        .btn-primary {
            background-color: #dc2626;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #b91c1c;
            transform: translateY(-2px);
        }

        .section-title {
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background-color: #dc2626;
        }

        .service-card {
            transition: all 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .project-card {
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .project-card:hover {
            transform: scale(1.05);
        }

        .project-card img {
            transition: all 0.3s ease;
        }

        .project-card:hover img {
            transform: scale(1.1);
        }
    </style>
</head>

<body class="bg-white">
    <!-- Navigation -->
    <nav 
x-data="{ scrolled:false }"
@scroll.window="scrolled = (window.scrollY > 50)"
:class="scrolled ? 'bg-white shadow-lg' : 'bg-white/10 backdrop-blur-sm'"
class="fixed w-full top-0 z-50 transition-all duration-300"
>
        <div>
            <div class="flex justify-between items-center h-16 px-3 md:px-6" style="
            height: fit-content;
        ">
                <!-- Logo -->
                <div class="flex-shrink-0 mr-10">
                    <a href="{{ route('home') }}" class="flex items-center py-2">
                        <img src="{{asset('images/logo/nobgseclogo.png')}}" alt="Comapny Logo" style="width: 100px;">
                    </a>
                </div>
                @php
                $projectCategories = App\Models\ProjectCategory::all();
                @endphp <!-- Desktop Navigation -->
                <div class="hidden md:flex flex-grow justify-end ml-10">
                    <div class="ml-10 flex items-baseline space-x-2 relative group">
                        <a href="{{ route('home') }}" class="nav-link px-3 py-2 text-[15px] font-semibold tracking-wide {{ request()->routeIs('home') ? 'is-active' : '' }}" :class="scrolled ? 'text-gray-800 hover:text-red-600' : 'text-gray-800 hover:text-red-300'"
>HOME</a>
                        <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                            <a href="{{ route('about') }}" class="nav-link px-3 py-2 text-[15px] font-semibold tracking-wide  {{ request()->routeIs('about*') ? 'is-active' : '' }}" :class="scrolled ? 'text-gray-800 hover:text-red-600' : 'text-gray-800 hover:text-red-300'"
>ABOUT US</a>

                            <!-- Dropdown Menu -->
                            <div x-show="open" x-cloak x-transition class="absolute left-0 mt-2 w-48 bg-white border border-gray-200 shadow-lg rounded-md z-50">

                                <a href="{{route('about')}}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-600">
                                    Message from CEO
                                </a>
                                <a href="{{route('about.vision')}}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-600">
                                    Mission, Vision & Values
                                </a>
                                <a href="{{route('about.team')}}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-600">
                                Meet Our Team
                            </a>
                                <a href="{{route('about.culture')}}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-600">
                                Our Culture
                            </a>
                            </div>
                        </div>

                        <!-- Projects with Dropdown -->
                  <div x-data="{ open: false, subOpen: false }"
     @mouseenter="open = true"
     @mouseleave="open = false"
     class="relative">

    <!-- Main Link -->
    <a href="{{ route('projects') }}"
       class="nav-link px-3 py-2 text-[15px] font-semibold tracking-wide {{ request()->routeIs('projects') ? 'is-active' : '' }}"
       :class="scrolled ? 'text-gray-800 hover:text-red-600' : 'text-gray-800 hover:text-red-300'">
        PROJECTS
    </a>

    <!-- Dropdown -->
    <div x-show="open" x-cloak x-transition
         class="absolute left-0 mt-2 w-56 bg-white border border-gray-200 shadow-lg rounded-md z-50">

        <!-- Ongoing -->
        <a href="{{route('ongoingProjects')}}"
           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-600">
            Ongoing Projects
        </a>

        <!-- Delivered (with submenu) -->
        <div class="relative"
             @mouseenter="subOpen = true"
             @mouseleave="subOpen = false">

            <div class="flex justify-between items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-600 cursor-pointer">
                Delivered Projects
                <a href=""></a>
                <span>▶</span>
            </div>

            <!-- Submenu -->
            <div x-show="subOpen" x-transition
                 class="absolute top-0 left-full ml-1 w-56 bg-white border border-gray-200 shadow-lg rounded-md">

                @foreach($projectCategories as $category)
                <a href="{{ route('listprojects', $category->id) }}"
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-600">
                    {{ $category->category }}
                </a>
                @endforeach

            </div>
        </div>

    </div>
</div>
                        <a href="{{ route('safety') }}" class="nav-link px-3 py-2 text-[15px] font-semibold tracking-wide {{ request()->routeIs('safety') ? 'is-active' : '' }}":class="scrolled ? 'text-gray-800 hover:text-red-600' : 'text-gray-800 hover:text-red-300'"
>SAFETY, HEALTH & ENVIRONMENT</a>
                        <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                            <a href="{{ route('clients') }}" class="nav-link px-3 py-2 text-[15px] font-semibold tracking-wide {{ request()->routeIs('clients') ? 'is-active' : '' }}":class="scrolled ? 'text-gray-800 hover:text-red-600' : 'text-gray-800 hover:text-red-300'"
>STRATEGIC PARTNERS</a>

                            <!-- Dropdown Menu -->
                            <div x-show="open" x-cloak x-transition class="absolute left-0 mt-2 w-48 bg-white border border-gray-200 shadow-lg rounded-md z-50">

                                <a href="{{route('clients')}}#clients"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-600">
                                    Our clients
                                </a>
                                <a href="{{route('clients')}}#consultants"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-600">
                                    Consultants
                                </a>

                            </div>
                        </div>

                        <a href="{{ route('sister-companies') }}" class="nav-link px-3 py-2 text-[15px] font-semibold tracking-wide {{ request()->routeIs('sister-companies') ? 'is-active' : '' }}":class="scrolled ? 'text-gray-800 hover:text-red-600' : 'text-gray-800 hover:text-red-300'"
>SEC GROUP</a>
                        <a href="{{ route('careers') }}" class="nav-link px-3 py-2 text-[15px] font-semibold tracking-wide {{ request()->routeIs('careers') ? 'is-active' : '' }}":class="scrolled ? 'text-gray-800 hover:text-red-600' : 'text-gray-800 hover:text-red-300'"
>CAREERS</a>
                        <a href="{{ route('contact') }}" class="nav-link px-3 py-2 text-[15px] font-semibold tracking-wide {{ request()->routeIs('contact') ? 'is-active' : '' }}":class="scrolled ? 'text-gray-800 hover:text-red-600' : 'text-gray-800 hover:text-red-300'"
>CONTACT US</a>
<div x-data="updatesWidget()" x-init="init()" class="relative">

<!-- NAVBAR BUTTON -->
<button 
  @click="toggle()"
  @keydown.escape.window="toggle(false)" 
  :aria-expanded="open.toString()" 
  aria-controls="updates-panel"

  class="relative h-10 w-10 rounded-full bg-red-600 text-gray-800 shadow-lg
         hover:bg-red-700 transition flex items-center justify-center"
>

<!-- ICON -->
<svg xmlns="http://www.w3.org/2000/svg"
viewBox="0 0 24 24"
fill="none" 
stroke="currentColor"
stroke-width="1.8"
class="w-5 h-5">

<path d="M3 11a3 3 0 0 1 3-3h4v8H6a3 3 0 0 1-3-3v-2z"/>
<path d="M10 16.5v3a1.5 1.5 0 0 1-3 0v-3"/>
<path d="M14 8l6-3v14l-6-3V8z"/>
<path d="M21 10l1.5-.5M21 12h1.5M21 14l1.5.5"/>

</svg>

<!-- BADGE -->
<span 
x-show="unread>0"
x-transition
class="absolute -top-1 -right-1 flex items-center justify-center
h-5 min-w-5 px-1 rounded-full
bg-white text-red-600 text-[11px]
font-semibold ring-2 ring-red-600">

<span x-text="unread"></span>

</span>
    {{-- Example dynamic list; replace with your data --}}
    @php
      $updates = $updates ?? [
        ['type' => 'project', 'title' => 'New project awarded: Qatar Logistics Hub', 'meta' => 'Kickoff next week • West Bay'],
       
        ['type' => 'job',     'title' => 'We’re hiring: HSE Officer', 'meta' => 'Apply now', 'url' => route('careers')],
      ];
    @endphp
</button>


<!-- OVERLAY -->
<div 
x-cloak
x-show="open"
@click="toggle(false)"
class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40">
</div>


<!-- PANEL -->
<div 

x-cloak
x-show="open"

@click.stop

x-transition.origin.top.right

class="fixed
top-20
right-6
w-[92vw]
max-w-sm
bg-white
shadow-2xl
ring-1 ring-black/5
rounded-2xl
overflow-hidden
z-50"

id="updates-panel"
role="dialog"
>

<div class="px-4 py-3 border-b flex justify-between">

<div class="text-sm font-semibold">
News
</div>

<button 
@click="toggle(false)"
class="text-gray-400 hover:text-gray-700">

✕

</button>

</div>


<ul class="max-h-96 overflow-auto divide-y">

@foreach($updates as $u)

<li class="p-4 hover:bg-gray-50 flex gap-3">

<div class="text-sm">

<div class="font-medium text-gray-900">

@if(isset($u['url']))

<a href="{{ $u['url'] }}" class="hover:underline">

@endif

{{ $u['title'] }}

@if(isset($u['url']))
</a>
@endif

</div>

@if(!empty($u['meta']))

<div class="text-gray-500">

{{ $u['meta'] }}

</div>

@endif

</div>

</li>

@endforeach

</ul>


<a href="#"
class="block text-center text-sm font-medium text-red-600 py-3 hover:bg-gray-50">

View all updates

</a>

</div>

</div>
                    </div>
                    
                </div>


                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" class="mobile-menu-button bg-gray-800 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
       {{-- Mobile Menu (collapsible) --}}
<div class="mobile-menu hidden md:hidden" x-data="{ aboutOpen:false, projectsOpen:false }">
    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white shadow-lg">
  
      {{-- Home --}}
      <a href="{{ route('home') }}"
         class="nav-link block px-3 py-2 text-base font-medium text-gray-800 hover:text-red-600
                {{ request()->routeIs('home') ? 'text-red-600' : '' }}">
        Home
      </a>
  
      {{-- About us (parent + dropdown) --}}
      <div class="border-t border-gray-100 pt-2">
        <button type="button"
                @click="aboutOpen = !aboutOpen"
                :aria-expanded="aboutOpen.toString()"
                class="w-full flex items-center justify-between px-3 py-2 text-base font-medium text-gray-800 hover:text-red-600">
          <span class="flex-1 text-left">About us</span>
          <!-- chevron -->
          <svg class="h-5 w-5 transform transition" :class="aboutOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
          </svg>
        </button>
  
        <div x-cloak x-show="aboutOpen" x-transition.origin.top class="pl-5 space-y-1 pb-2">
          <a href="{{ route('about') }}"
             class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-red-600
                    {{ request()->routeIs('about') ? 'text-red-600' : '' }}">
            Message from CEO
          </a>
          <a href="{{ route('about.vision') }}"
             class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-red-600
                    {{ request()->routeIs('about.vision') ? 'text-red-600' : '' }}">
            Mission, Vision & Values
          </a>
          <a href="{{ route('about.team') }}"
             class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-red-600
                    {{ request()->routeIs('about.team') ? 'text-red-600' : '' }}">
            Meet our team
          </a>
        </div>
      </div>
  
      {{-- Projects (parent + dropdown) --}}
      @php
        // Ensure categories are available (fallback if not passed from controller)
        $projectCategories = $projectCategories ?? \App\Models\ProjectCategory::all();
      @endphp
      <div class="border-t border-gray-100 pt-2">
        <button type="button"
                @click="projectsOpen = !projectsOpen"
                :aria-expanded="projectsOpen.toString()"
                class="w-full flex items-center justify-between px-3 py-2 text-base font-medium text-gray-800 hover:text-red-600">
          <span class="flex-1 text-left">Projects</span>
          <svg class="h-5 w-5 transform transition" :class="projectsOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
          </svg>
        </button>
  
        <div x-cloak x-show="projectsOpen" x-transition.origin.top class="pl-5 space-y-1 pb-2">
          <a href="{{ route('projects') }}"
             class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-red-600
                    {{ request()->routeIs('projects') ? 'text-red-600' : '' }}">
            All Projects
          </a>
          @foreach($projectCategories as $category)
            <a href="{{ route('listprojects', $category->id) }}"
               class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-red-600
                      {{ request()->is('projects/category/'.$category->id) ? 'text-red-600' : '' }}">
              {{ $category->category }}
            </a>
          @endforeach
        </div>
      </div>
  
      {{-- Other links --}}
      <a href="{{ route('sister-companies') }}"
         class="nav-link block px-3 py-2 text-base font-medium text-gray-800 hover:text-red-600
                {{ request()->routeIs('sister-companies') ? 'text-red-600' : '' }}">
        SEC Group
      </a>
  
      <a href="{{ route('clients') }}"
         class="nav-link block px-3 py-2 text-base font-medium text-gray-800 hover:text-red-600
                {{ request()->routeIs('clients') ? 'text-red-600' : '' }}">
        Strategic Partners
      </a>
  
      <a href="{{ route('careers') }}"
         class="nav-link block px-3 py-2 text-base font-medium text-gray-800 hover:text-red-600
                {{ request()->routeIs('careers') ? 'text-red-600' : '' }}">
        Careers
      </a>
  
      <a href="{{ route('contact') }}"
         class="nav-link block px-3 py-2 text-base font-medium text-gray-800 hover:text-red-600
                {{ request()->routeIs('contact') ? 'text-red-600' : '' }}">
        Contact
      </a>
      
    </div>
  </div>
  
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="col-span-1">
                    <div class="flex items-center mb-4">
                        <div class="bg-white text-white px-2 py-2 rounded font-bold text-xl">
                            <img src="{{asset('images/logo/secLOGO.jpeg')}}" alt="Comapny Logo" style="width: 50px;">
                        </div>
                        
                    </div>
                    <span class=" text-white font-semibold text-lg">Shannon Engineering</span>
                    <p class="text-gray-300 text-sm text-justify">
                        A premier construction and contracting company in Qatar, delivering exceptional projects across various sectors.
                    </p>
                </div>

                <!-- Quick Links -->
            

                <!-- Our Services -->
              <!-- Map -->
<div class="col-span-2">
    <h3 class="text-lg font-semibold mb-4 text-white">Find Us</h3>
    <div class="w-full h-64 md:h-60 rounded-xl overflow-hidden ring-1 ring-white/10 shadow">
      <iframe
        title="Shannon Engineering Location Map"
        src="https://www.google.com/maps?q=Al+Gassar+Tower,+Doha,+Qatar&output=embed"
        allowfullscreen
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        class="w-full h-full border-0"
      ></iframe>
    </div>
  </div>
  
  <!-- Contact Us -->
  <div class="col-span-1">
    <h3 class="text-lg font-semibold mb-4 text-white">Contact Us</h3>
    <div class="text-gray-300 text-sm space-y-3">
      <p>Al Gassar Tower, 19th Floor, West Bay</p>
      <p>P.O. Box: 24041</p>
      <p>Doha, Qatar</p>
  
      <div class="pt-1 space-y-1">
        <a href="tel:+97444355656" class="block hover:text-white transition">+974 4435 5656</a>
        <a href="mailto:info@shannoneng.com" class="block hover:text-white transition">info@shannoneng.com</a>
      </div>
  
      <!-- Socials -->
      <div class="pt-3">
        <p class="mb-2 text-gray-400">Follow us</p>
        <div class="flex items-center gap-3">
          <!-- LinkedIn -->
          <a href="https://www.linkedin.com/company/shannon-engineering" target="_blank" rel="noopener"
             aria-label="LinkedIn"
             class="p-2 rounded-lg bg-white/5 hover:bg-white/10 ring-1 ring-white/10 transition text-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
              <path d="M4.98 3.5C4.98 4.88 3.86 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1s2.48 1.12 2.48 2.5zM.5 8h4V23h-4V8zm7.5 0h3.8v2.05h.05c.53-1 1.84-2.05 3.8-2.05 4.06 0 4.8 2.67 4.8 6.15V23h-4v-7.3c0-1.74-.03-3.98-2.43-3.98-2.44 0-2.81 1.9-2.81 3.86V23h-4V8z"/>
            </svg>
          </a>
          <!-- Facebook -->
          <a href="https:www.facebook.com/ShannonEngineering" target="_blank" rel="noopener"
             aria-label="Facebook"
             class="p-2 rounded-lg bg-white/5 hover:bg-white/10 ring-1 ring-white/10 transition text-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
              <path d="M22 12a10 10 0 1 0-11.5 9.9v-7h-2.3V12h2.3V9.8c0-2.3 1.4-3.6 3.5-3.6 1 0 2 .2 2 .2v2.2h-1.1c-1.1 0-1.5.7-1.5 1.4V12h2.6l-.4 2.9h-2.2v7A10 10 0 0 0 22 12z"/>
            </svg>
          </a>
          <!-- YouTube -->
          <a href="https://youtube.com/@shannonengineering8110?si=_4jo1PEImon7J0Hn" target="_blank" rel="noopener"
             aria-label="YouTube"
             class="p-2 rounded-lg bg-white/5 hover:bg-white/10 ring-1 ring-white/10 transition text-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
              <path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.6 3.5 12 3.5 12 3.5s-7.6 0-9.4.6A3 3 0 0 0 .5 6.2C0 8 0 12 0 12s0 4 .5 5.8a3 3 0 0 0 2.1 2.1c1.8.6 9.4.6 9.4.6s7.6 0 9.4-.6a3 3 0 0 0 2.1-2.1c.5-1.8.5-5.8.5-5.8s0-4-.5-5.8zM9.5 15.5v-7l6 3.5-6 3.5z"/>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </div>
  
            </div>

            <div class="border-t border-gray-700 mt-8 pt-6">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                  
                  <!-- Left: Copyright -->
                  <p class="text-gray-300 text-sm text-center md:text-left">
                    © {{ date('Y') }} Shannon Engineering Company. All rights reserved.
                  </p>
              
                  <!-- Right: ISO Logos -->
                  <div class="grid grid-cols-2 lg:grid-cols-4  gap-2">
                    <img src="{{ asset('images/iso/iso_1.png') }}" alt="ISO Certification 1" class="h-16 w-auto">
                    <img src="{{ asset('images/iso/iso_2.png') }}" alt="ISO Certification 2" class="h-16 w-auto">
                    <img src="{{ asset('images/iso/iso_3.png') }}" alt="ISO Certification 3" class="h-16 w-auto">
                    <img src="{{ asset('images/iso/icv.jpg') }}" alt="ICV Certification" class="h-16 w-auto">
                  </div>
              
                </div>
              </div>
              
        </div>
    </footer>

    <!-- Mobile Menu JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.querySelector('.mobile-menu-button');
            const mobileMenu = document.querySelector('.mobile-menu');

            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        });
    </script>
    @yield('component')
    @livewireScripts
    @stack('scripts')
    {{-- Floating Updates (FAB + Panel) --}}
    
<div 

class="fixed z-[60] bottom-5 right-5 md:bottom-8 md:right-8"
>
<button 
  

>
<a href="https://www.linkedin.com/company/shannon-engineering"      target="_blank"
        rel="noopener noreferrer"
             aria-label="LinkedIn"
             class="h-12 w-12 rounded-full flex items-center justify-center
               bg-blue-400 hover:bg-blue-600 text-white
               shadow-xl ring-1 ring-black/10 transition">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
              <path d="M4.98 3.5C4.98 4.88 3.86 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1s2.48 1.12 2.48 2.5zM.5 8h4V23h-4V8zm7.5 0h3.8v2.05h.05c.53-1 1.84-2.05 3.8-2.05 4.06 0 4.8 2.67 4.8 6.15V23h-4v-7.3c0-1.74-.03-3.98-2.43-3.98-2.44 0-2.81 1.9-2.81 3.86V23h-4V8z"/>
            </svg>
</a>
</button>
<button 
  

>
<a 
   href="https://wa.me/97451785656"
        target="_blank"
        rel="noopener noreferrer"
        class="h-12 w-12 rounded-full flex items-center justify-center
               bg-green-500 hover:bg-green-600 text-white
               shadow-xl ring-1 ring-black/10 transition"
        aria-label="Chat on WhatsApp"
    >
        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
            <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.121 1.531 5.847L.057 23.571a.75.75 0 0 0 .925.926l5.783-1.461A11.945 11.945 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.75a9.725 9.725 0 0 1-4.95-1.355l-.355-.211-3.68.929.957-3.595-.231-.368A9.725 9.725 0 0 1 2.25 12C2.25 6.615 6.615 2.25 12 2.25S21.75 6.615 21.75 12 17.385 21.75 12 21.75z"/>
        </svg>
    </a>

</button>
<button>
<a 
   href="https://youtube.com/@shannonengineering8110"
        target="_blank"
        rel="noopener noreferrer"
        class="h-12 w-12 rounded-full flex items-center justify-center
               bg-red-600 hover:bg-red-700 text-white
               shadow-xl ring-1 ring-black/10 transition"
        aria-label="Visit our YouTube channel"
    >
        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
        </svg>
    </a>

</button>
<button>
 <a href="https:www.facebook.com/ShannonEngineering"  target="_blank"
        rel="noopener noreferrer"
             aria-label="Facebook"
             class="h-12 w-12 rounded-full flex items-center justify-center
               bg-blue-600 hover:bg-blue-700 text-white
               shadow-xl ring-1 ring-black/10 transition">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
              <path d="M22 12a10 10 0 1 0-11.5 9.9v-7h-2.3V12h2.3V9.8c0-2.3 1.4-3.6 3.5-3.6 1 0 2 .2 2 .2v2.2h-1.1c-1.1 0-1.5.7-1.5 1.4V12h2.6l-.4 2.9h-2.2v7A10 10 0 0 0 22 12z"/>
            </svg>
          </a>

</button>


</div>

<script>

function updatesWidget(){

return {

open:false,

unread:2,

init(){

let saved = Number(
localStorage.getItem('updates_unread')
);

if(saved){
this.unread=saved;
}

},

toggle(state){

this.open =
typeof state==='boolean'
? state
: !this.open;

document.body.classList.toggle(
'overflow-hidden',
this.open
);

}

}

}

</script>

</body>

</html>