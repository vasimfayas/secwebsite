@extends('layouts.app')

@section('title', 'Sister Companies - Shannon Engineering Company')

@section('content')
<!-- Hero Section -->
<section class="bg-gray-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Sister Companies</h1>
        <p class="text-xl max-w-3xl mx-auto">
            Expanding our reach through strategic partnerships and subsidiary companies
        </p>
    </div>
</section>

<!-- Sister Companies -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4 section-title inline-block">
                Our Network
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Through our sister companies, we provide comprehensive solutions across the construction and engineering industry
            </p>
        </div>

        @php
        $logos = [
        ['file' => 'flameLogo.png', 'name' => 'Elctrical Solutions'],
        ['file' => 'sidra.jpg', 'name' => 'MEP Solutions'],
        ['file' => 'marble.jpg', 'name' => 'Marble Advisory'],
        ['file' => 'acting.jpg', 'name' => 'Construction Equipments and Machinery Supplier'],
        ];
        @endphp

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 gap-8 items-center">
            @foreach ($logos as $logo)
            <div class="w-full bg-white p-4 border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 flex flex-col items-center">
                <div class="h-24 w-full flex items-center justify-center">
                    <img src="{{ asset('images/logo/' . $logo['file']) }}"
                        alt="{{ $logo['name'] }}"
                        class="h-full w-full object-contain grayscale hover:grayscale-0 transition duration-300 ease-in-out" />
                </div>
                <p class="mt-4 text-sm text-gray-700 font-medium text-center">{{ $logo['name'] }}</p>
            </div>
            @endforeach
        </div>


    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-red-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold mb-6">
            Interested in Partnership?
        </h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">
            Contact us to learn more about partnership opportunities and our expanding network.
        </p>
        <a href="{{ route('contact') }}" class="bg-white text-red-600 hover:bg-gray-100 px-8 py-4 rounded-lg font-semibold text-lg inline-block transition-all duration-300">
            Contact Us
        </a>
    </div>
</section>
@endsection