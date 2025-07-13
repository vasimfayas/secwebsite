<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Shannon Engineering Company - Building Qatar\'s Future')</title>
    <meta name="description" content="@yield('description', 'Shannon Engineering Company (SEC) is a premier construction and contracting company in Qatar, delivering exceptional projects across residential, commercial, industrial, medical, and religious sectors.')">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom CSS -->
    <style>
        .hero-bg {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1541888946425-d81bb19240f5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
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
                        <img src="{{asset('images/logo/secLOGO.jpeg')}}" alt="Comapny Logo" style="width: 50px;">
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <a href="{{ route('home') }}" class="nav-link text-gray-800 hover:text-red-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('home') ? 'text-red-600' : '' }}">Home</a>
                        <a href="{{ route('about') }}" class="nav-link text-gray-800 hover:text-red-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('about') ? 'text-red-600' : '' }}">About Us</a>
                        <a href="{{ route('projects') }}" class="nav-link text-gray-800 hover:text-red-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('projects') ? 'text-red-600' : '' }}">Projects</a>
                        <a href="{{ route('sister-companies') }}" class="nav-link text-gray-800 hover:text-red-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('sister-companies') ? 'text-red-600' : '' }}">Sister Companies</a>
                        <a href="{{ route('careers') }}" class="nav-link text-gray-800 hover:text-red-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('careers') ? 'text-red-600' : '' }}">Careers</a>
                        <a href="{{ route('clients') }}" class="nav-link text-gray-800 hover:text-red-600 px-3 py-2 text-sm font-medium {{ request()->routeIs('clients') ? 'text-red-600' : '' }}">Our Clients</a>
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
                <a href="{{ route('about') }}" class="nav-link text-gray-800 hover:text-red-600 block px-3 py-2 text-base font-medium">About Us</a>
                <a href="{{ route('projects') }}" class="nav-link text-gray-800 hover:text-red-600 block px-3 py-2 text-base font-medium">Projects</a>
                <a href="{{ route('sister-companies') }}" class="nav-link text-gray-800 hover:text-red-600 block px-3 py-2 text-base font-medium">Sister Companies</a>
                <a href="{{ route('careers') }}" class="nav-link text-gray-800 hover:text-red-600 block px-3 py-2 text-base font-medium">Careers</a>
                <a href="{{ route('clients') }}" class="nav-link text-gray-800 hover:text-red-600 block px-3 py-2 text-base font-medium">Our Clients</a>
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
                        <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-white transition-colors">About Us</a></li>
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
                        <p>Doha, Qatar</p>
                        <p>+974 44355656</p>
                        <p>info@shannoneng.com</p>
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
</body>

</html>