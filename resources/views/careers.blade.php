@extends('layouts.app')

@section('title', 'Careers - Shannon Engineering Company')

@section('content')
<!-- Hero Section -->
<section class="bg-gray-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Join Our Team</h1>
        <p class="text-xl max-w-3xl mx-auto">
            Build your career with Qatar's leading construction and engineering company
        </p>
    </div>
</section>

<!-- Why Work With Us -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4 section-title inline-block">
                Why Choose Shannon Engineering?
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Join a team that values excellence, innovation, and professional growth
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Career Growth</h3>
                <p class="text-gray-600">
                    Opportunities for professional development and career advancement in a growing company.
                </p>
            </div>

            <div class="text-center">
                <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Great Team</h3>
                <p class="text-gray-600">
                    Work alongside experienced professionals in a collaborative and supportive environment.
                </p>
            </div>

            <div class="text-center">
                <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Quality Projects</h3>
                <p class="text-gray-600">
                    Be part of landmark projects that shape Qatar's future and leave a lasting impact.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Current Openings -->
<section class="py-20 bg-gray-50">
    @if (session()->has('success'))
    <div class="bg-green-100 text-green-800 p-2 rounded mb-3">
        {{ session('success') }}
    </div>
    @endif
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4 section-title inline-block">
                Current Openings
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Explore exciting career opportunities across various departments
            </p>
        </div>

        <div class="space-y-6">
            <!-- Job Listing -->
            @forelse($careers as $career)
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="mb-4 md:mb-0">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $career->title }}</h3>
                        <p class="text-gray-600 mb-2">{{ $career->desc }}</p>

                        <div class="flex flex-wrap gap-2 mb-2">
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">{{ $career->period }}</span>
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">{{ $career->location }}</span>
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">{{ $career->experience }}</span>
                        </div>

                        @if ($career->deadline)
                        <div class="text-sm text-gray-600 mt-1">
                            <strong>Apply by:</strong> {{ \Carbon\Carbon::parse($career->deadline)->format('F j, Y') }}
                        </div>
                        @endif
                    </div>

                    <!-- simplest fix: give the element its own x-data scope -->
                    <a
                        x-data {{-- creates an Alpine context --}}
                        href="javascript:void(0)"
                        @click="$dispatch('open-career-modal', { id: {{ $career->id }} })"
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                        Apply Now
                    </a>

                </div>
            </div>
            @empty
            <p class="text-gray-500 text-center">No openings available at the moment.</p>
            @endforelse

        </div>


    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-red-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold mb-6">
            Ready to Start Your Career?
        </h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">
            Join Shannon Engineering Company and be part of building Qatar's future with excellence and innovation.
        </p>
        <a
            x-data {{-- creates an Alpine context --}}
            href="javascript:void(0)"
            @click="$dispatch('open-career-modal')"
            class="bg-white text-red-600 hover:bg-gray-100 px-8 py-4 rounded-lg font-semibold text-lg inline-block transition-all duration-300">
            Apply Now
        </a>

    </div>
</section>

@endsection
@section('component')
@livewire('mail.career')
@endsection