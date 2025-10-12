<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Shannon Engineering Company - Building Qatar\'s Future')</title>
    <meta name="description" content="@yield('description', 'Shannon Engineering Company (SEC) is a premier construction and contracting company in Qatar, delivering exceptional projects across residential, commercial, industrial, medical, and religious sectors.')">
    <link rel="icon" href="{{ asset('images/logo/logo.png') }}" type="image/png">
    <link rel="preload" href="{{ asset('/images/home/lexus.webp') }}" as="image">
   
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles


    <!-- Custom CSS -->
    <style>
        .hero-bg {
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .nav-link {
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #dc2626;
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
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50">
        <div>
            <div class="flex justify-between items-center h-16 px-4 md:px-8" style="
            height: fit-content;
        ">
                <!-- Logo -->
                <div class="flex-shrink-0 mr-10">
                    <a href="{{ route('home') }}" class="flex items-center py-2">
                        <img src="{{asset('images/logo/secLOGO.jpeg')}}" alt="Comapny Logo" style="width: 140px;">
                    </a>
                </div>
                @php
                $projectCategories = App\Models\ProjectCategory::all();
                @endphp <!-- Desktop Navigation -->
                <div class="hidden md:flex flex-grow justify-end ml-20">
                    <div class="ml-10 flex items-baseline space-x-8 relative group">
                        <a href="{{ route('home') }}" class="nav-link text-gray-800 hover:text-red-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('home') ? 'text-red-600' : '' }}">Home</a>
                        <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                            <a href="{{ route('about') }}" class="nav-link text-gray-800 hover:text-red-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('about*') ? 'text-red-600' : '' }}">About us</a>

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
                                Meet our team
                            </a>
                            </div>
                        </div>

                        <!-- Projects with Dropdown -->
                        <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                            <a href="{{ route('projects') }}" class="nav-link text-gray-800 hover:text-red-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('projects') ? 'text-red-600' : '' }}">Projects</a>

                            <!-- Dropdown Menu -->
                            <div x-show="open" x-cloak x-transition class="absolute left-0 mt-2 w-48 bg-white border border-gray-200 shadow-lg rounded-md z-50">
                                @foreach($projectCategories as $category)
                                <a href="{{route('listprojects',$category->id)}}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-600">
                                    {{ $category->category }}
                                </a>
                                @endforeach
                            </div>
                        </div>
                        <a href="{{ route('safety') }}" class="nav-link text-gray-800 hover:text-red-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('safety') ? 'text-red-600' : '' }}">Safety, Health & Environment</a>
                        <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                            <a href="{{ route('clients') }}" class="nav-link text-gray-800 hover:text-red-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('clients') ? 'text-red-600' : '' }}">Strategic Partners</a>

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

                        <a href="{{ route('sister-companies') }}" class="nav-link text-gray-800 hover:text-red-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('siste-companies') ? 'text-red-600' : '' }}">SEC Group</a>
                        <a href="{{ route('careers') }}" class="nav-link text-gray-800 hover:text-red-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('careers') ? 'text-red-600' : '' }}">Careers</a>
                        <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                            <a href="{{ route('contact') }}" class="nav-link text-gray-800 hover:text-red-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('contact') ? 'text-red-600' : '' }}">Contact Us</a>
                   

                            <!-- Dropdown Menu -->
                            <div x-show="open" x-cloak x-transition class="absolute left-0 mt-2 w-48 bg-white border border-gray-200 shadow-lg rounded-md z-50">

                               

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
        <div class="mobile-menu hidden md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white shadow-lg">
                <a href="{{ route('home') }}" class="nav-link text-gray-800 hover:text-red-600 block px-3 py-2 text-base font-medium">Home</a>
                <a href="{{ route('about') }}" class="nav-link text-gray-800 hover:text-red-600 block px-3 py-2 text-base font-medium">About us</a>
                <a href="{{ route('projects') }}" class="nav-link text-gray-800 hover:text-red-600 block px-3 py-2 text-base font-medium">Projects</a>
                <a href="{{ route('sister-companies') }}" class="nav-link text-gray-800 hover:text-red-600 block px-3 py-2 text-base font-medium">SEC Group</a>
                <a href="{{ route('clients') }}" class="nav-link text-gray-800 hover:text-red-600 block px-3 py-2 text-base font-medium">Strategic Partners</a>
                <a href="{{ route('careers') }}" class="nav-link text-gray-800 hover:text-red-600 block px-3 py-2 text-base font-medium">Careers</a>
                <a href="{{ route('contact') }}" class="nav-link text-gray-800 hover:text-red-600 block px-3 py-2 text-base font-medium">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-16">
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
                        <span class="ml-2 text-white font-semibold text-lg">Shannon Engineering</span>
                    </div>
                    <p class="text-gray-300 text-sm">
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
                  <div class="flex items-center gap-4">
                    <img src="{{ asset('images/iso/iso_1.png') }}" alt="ISO Certification 1" class="h-16 w-auto">
                    <img src="{{ asset('images/iso/iso_2.png') }}" alt="ISO Certification 2" class="h-16 w-auto">
                    <img src="{{ asset('images/iso/iso_3.png') }}" alt="ISO Certification 3" class="h-16 w-auto">
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
</body>

</html>