<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Shannon Engineering Company - Building Qatar\'s Future')</title>
    <meta name="description" content="@yield('description', 'Shannon Engineering Company (SEC) is a premier construction and contracting company in Qatar, delivering exceptional projects across residential, commercial, industrial, medical, and religious sectors.')">
    <link rel="icon" href="{{ asset('images/logo/logo.png') }}" type="image/png">
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Custom CSS -->
    <style>
        .slider-container {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            overflow: hidden;
            z-index: 0;
        }



        .slide-bg {
            min-width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
        }


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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{asset('images/logo/secLOGO.jpeg')}}" alt="Comapny Logo" style="width: 80px;">
                    </a>
                </div>
                @php
                $projectCategories = App\Models\ProjectCategory::all();
                @endphp <!-- Desktop Navigation -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8 relative group">
                        <a href="{{ route('home') }}" class="nav-link text-gray-800 hover:text-red-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('home') ? 'text-red-600' : '' }}">Home</a>
                        <a href="{{ route('about') }}" class="nav-link text-gray-800 hover:text-red-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('about') ? 'text-red-600' : '' }}">About us</a>

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

                        <a href="{{ route('sister-companies') }}" class="nav-link text-gray-800 hover:text-red-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('siste-companies') ? 'text-red-600' : '' }}">Sister Companies</a>
                        <a href="{{ route('clients') }}" class="nav-link text-gray-800 hover:text-red-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('clients') ? 'text-red-600' : '' }}">Our Clients</a>
                        <a href="{{ route('careers') }}" class="nav-link text-gray-800 hover:text-red-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('careers') ? 'text-red-600' : '' }}">Careers</a>

                        <a href="{{ route('contact') }}" class="nav-link text-gray-800 hover:text-red-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('contact') ? 'text-red-600' : '' }}">Contact</a>
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
                <a href="{{ route('sister-companies') }}" class="nav-link text-gray-800 hover:text-red-600 block px-3 py-2 text-base font-medium">Sister Companies</a>
                <a href="{{ route('clients') }}" class="nav-link text-gray-800 hover:text-red-600 block px-3 py-2 text-base font-medium">Our Clients</a>
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
                <div class="col-span-1">
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-colors">Home</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-white transition-colors">About us</a></li>
                        <li><a href="{{ route('projects') }}" class="text-gray-300 hover:text-white transition-colors">Projects</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>

                <!-- Our Services -->
                <div class="col-span-1">
                    <h3 class="text-lg font-semibold mb-4">Our Services</h3>
                    <ul class="space-y-2">
                        <li class="text-gray-300">Residential Construction</li>
                        <li class="text-gray-300">Commercial Development</li>
                        <li class="text-gray-300">Industrial Facilities</li>
                        <li class="text-gray-300">Medical Buildings</li>
                        <li class="text-gray-300">Mosque Construction</li>
                        <li class="text-gray-300">Engineering Solutions</li>
                    </ul>
                </div>

                <!-- Contact Us -->
                <div class="col-span-1">
                    <h3 class="text-lg font-semibold mb-4">Contact Us</h3>
                    <div class="text-gray-300 text-sm space-y-2">
                        <p>Al Gassar Tower 19th Floor, West Bay, </p>
                        <p>P.O.Box : 24041</p>
                        <p>Doha, Qatar</p> <br>
                        <a href="tel:+974 44355656">
                            <p>+974 44355656</p>
                        </a>
                        <a href="mailto:info@shannoneng.com">
                            <p>info@shannoneng.com</p>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p class="text-gray-300 text-sm">
                    © {{ date('Y') }} Shannon Engineering Company. All rights reserved.
                </p>
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
    @stack('scripts')
</body>

</html>