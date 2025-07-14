@extends('layouts.app')

@section('title', 'Our Projects - Shannon Engineering Company')
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4 section-title inline-block">
                Project Categories
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                We deliver excellence across multiple sectors
            </p>
        </div>

        <!-- Commercial -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                alt="Commercial Projects"
                class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Commercial Projects</h3>
                <p class="text-gray-600 mb-4">
                    Shopping malls, office buildings, hotels, and retail spaces designed for business success.
                </p>
                <div class="text-red-600 font-semibold">25+ Projects Completed</div>
            </div>
        </div>

        <!-- Industrial -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                alt="Industrial Projects"
                class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Industrial Projects</h3>
                <p class="text-gray-600 mb-4">
                    Factories, warehouses, and industrial complexes engineered for operational excellence.
                </p>
                <div class="text-red-600 font-semibold">12+ Projects Completed</div>
            </div>
        </div>

        <!-- Healthcare -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="https://images.unsplash.com/photo-1586773860418-d37222d8fce3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2073&q=80"
                alt="Healthcare Projects"
                class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Healthcare Projects</h3>
                <p class="text-gray-600 mb-4">
                    Hospitals, clinics, and healthcare facilities constructed with precision and care.
                </p>
                <div class="text-red-600 font-semibold">8+ Projects Completed</div>
            </div>
        </div>

        <!-- Religious -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="https://images.unsplash.com/photo-1564769625392-651b2c0e7b8a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                alt="Religious Projects"
                class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Religious Projects</h3>
                <p class="text-gray-600 mb-4">
                    Beautiful mosques that serve as spiritual centers, combining tradition with modern engineering.
                </p>
                <div class="text-red-600 font-semibold">10+ Projects Completed</div>
            </div>
        </div>

        <!-- Infrastructure -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                alt="Infrastructure Projects"
                class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Infrastructure Projects</h3>
                <p class="text-gray-600 mb-4">
                    Roads, bridges, and infrastructure projects that support Qatar's development.
                </p>
                <div class="text-red-600 font-semibold">20+ Projects Completed</div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection