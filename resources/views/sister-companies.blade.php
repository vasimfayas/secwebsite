@extends('layouts.app')

@section('title', 'Sister Companies - Shannon Engineering Company')

@php
$companies = [
    [
        'id' => 'flame-qatar',
        'logo' => 'flameLogo.webp',
        'name' => 'FLAME QATAR',
        'grade' => 'Electrical Contracting',
        'desc' => 'specializing in complete range electrical installations with international quality standards for residential, commercial, and industrial projects.',
        'url' => 'https://www.flameqatar.com/',
        'points' => ['Power Systems', 'Lighting Solutions', 'Electrical Design'],
        'accent' => '#1d4ed8',
        'tag' => 'Electrical',
    ],
    [
        'id' => 'sidra',
        'logo' => 'sidra.webp',
        'name' => 'SIDRA',
        'grade' => 'Mechanical Contracting',
        'desc' => 'specializing in advanced mechanical systems, HVAC, plumbing, and comprehensive MEP solutions for commercial and industrial projects.',
        'url' => 'https://sidraengineering.com/',
        'points' => ['HVAC systems', 'Mechanical Design', 'Plumbing & Piping'],
        'accent' => '#16a34a',
        'tag' => 'Mechanical',
    ],
    [
        'id' => 'marblearch',
        'logo' => 'marble.webp',
        'name' => 'MarbleArch',
        'grade' => null,
        'desc' => 'Specializing in premium marble, granite, and natural stone solutions for architectural and interior applications. Delivering exquisite finishes for residential and commercial spaces.',
        'url' => 'https://marblearchqtr.com/',
        'points' => ['Premium Marble & Granite', 'Natural Stone Solutions', 'Architectural Finishes', 'Custom Fabrication'],
        'accent' => '#1e3a8a',
        'tag' => 'Stone & Marble',
    ],
    [
        'id' => 'acting',
        'logo' => 'acting.webp',
        'name' => 'ACTING',
        'grade' => null,
        'desc' => 'One of the largest suppliers of finishing packages in the Gulf Region, offering premium materials, architectural finishes, and comprehensive interior solutions for luxury projects.',
        'url' => 'https://actingtradecont.com/',
        'points' => ['Finishing Packages', 'Premium Materials', 'Gulf Region Supply', 'Luxury Interiors'],
        'accent' => '#7f1d1d',
        'tag' => 'Finishing',
    ],
];
@endphp

@section('content')

<x-page-hero title="SEC" highlight="Group" subtitle="Strengthening our capabilities and expanding our impact through strategic subsidiaries and trusted partnerships" :crumbs="['SEC Group' => null]" />

<!-- ============ OUR NETWORK ============ -->
<section class="relative overflow-hidden bg-white py-20 md:py-28">
    <div class="mx-auto grid max-w-7xl grid-cols-1 items-center gap-14 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
        <div data-reveal="left">
            <p class="eyebrow">One group, every trade</p>
            <h2 class="section-heading">Our Network</h2>
            <p class="section-lead">
                Through our sister companies, we provide comprehensive solutions across the construction and engineering industry
            </p>

            <div class="mt-8 flex flex-wrap gap-2">
                @foreach ($companies as $c)
                    <a href="#{{ $c['id'] }}" class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 transition hover:-translate-y-0.5 hover:border-gray-300 hover:shadow-sm">
                        <span class="h-2 w-2 rounded-full" style="background: {{ $c['accent'] }}"></span>
                        {{ $c['tag'] }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Group diagram: SEC at the centre, sister companies around it -->
        <div class="relative mx-auto aspect-square w-full max-w-[520px]" data-reveal="zoom">
            <svg class="absolute inset-0 h-full w-full" viewBox="0 0 100 100" fill="none" aria-hidden="true">
                <circle cx="50" cy="50" r="36" stroke="#e5e7eb" stroke-width=".3" stroke-dasharray="1.2 1.2" />
                <circle cx="50" cy="50" r="22" stroke="#fee2e2" stroke-width=".3" />
                @foreach ([[18, 18], [82, 18], [18, 82], [82, 82]] as [$x, $y])
                    <line x1="50" y1="50" x2="{{ $x }}" y2="{{ $y }}" stroke="#fca5a5" stroke-width=".35" stroke-dasharray="1.5 1.5" class="group-line" />
                @endforeach
            </svg>
            <div class="pointer-events-none absolute left-1/2 top-1/2 h-2/3 w-2/3 -translate-x-1/2 -translate-y-1/2 rounded-full bg-red-500/10 blur-3xl"></div>

            <!-- Centre -->
            <div class="absolute left-1/2 top-1/2 flex h-[34%] w-[34%] -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full bg-white p-5 shadow-[0_30px_60px_-20px_rgba(220,38,38,.45)] ring-1 ring-red-100">
                <span class="absolute inset-0 animate-ping rounded-full bg-red-500/10 [animation-duration:3s]"></span>
                <img src="{{ asset('images/optimized/logo-320.webp') }}" alt="Shannon Engineering Company" class="relative w-full" loading="lazy">
            </div>

            <!-- Nodes -->
            @foreach ($companies as $i => $c)
                @php $pos = [['18%', '18%'], ['82%', '18%'], ['18%', '82%'], ['82%', '82%']][$i]; @endphp
                <a href="#{{ $c['id'] }}" title="{{ $c['name'] }}"
                   class="group absolute flex h-[26%] w-[26%] -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-3xl bg-white p-3 shadow-[0_16px_40px_-18px_rgba(16,24,40,.35)] ring-1 ring-gray-100 transition duration-300 hover:scale-105 hover:shadow-[0_24px_50px_-18px_rgba(16,24,40,.45)]"
                   style="left: {{ $pos[0] }}; top: {{ $pos[1] }};">
                    <img src="{{ asset('images/optimized/group/' . $c['logo']) }}" alt="{{ $c['name'] }}" class="max-h-full max-w-full object-contain" loading="lazy">
                    <span class="absolute -bottom-3 left-1/2 -translate-x-1/2 whitespace-nowrap rounded-full px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider text-white shadow"
                          style="background: {{ $c['accent'] }}">{{ $c['tag'] }}</span>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- ============ COMPANIES ============ -->
<section class="bg-gray-50 py-20 md:py-28">
    <div class="mx-auto max-w-7xl space-y-10 px-4 sm:px-6 md:space-y-14 lg:px-8">
        @foreach ($companies as $i => $c)
            <article id="{{ $c['id'] }}" data-reveal
                     class="group grid grid-cols-1 overflow-hidden rounded-[2rem] bg-white shadow-[0_1px_2px_rgba(16,24,40,.04),0_24px_60px_-30px_rgba(16,24,40,.25)] ring-1 ring-gray-100 lg:grid-cols-12">

                <!-- Logo panel -->
                <div class="relative flex items-center justify-center overflow-hidden p-10 md:p-14 lg:col-span-5 {{ $i % 2 ? 'lg:order-2' : '' }}"
                     style="background: radial-gradient(120% 90% at 50% 50%, #ffffff 0%, {{ $c['accent'] }}14 60%, {{ $c['accent'] }}26 100%);">
                    <span class="absolute left-6 top-5 font-display text-6xl font-bold opacity-10 md:text-7xl" style="color: {{ $c['accent'] }}">
                        {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                    </span>
                    <div class="relative flex aspect-[4/3] w-full max-w-xs items-center justify-center rounded-3xl bg-white p-8 shadow-[0_20px_50px_-24px_rgba(16,24,40,.35)] transition-transform duration-700 group-hover:scale-[1.03]">
                        <img src="{{ asset('images/optimized/group/' . $c['logo']) }}" alt="{{ $c['name'] }}" loading="lazy" decoding="async"
                             class="max-h-full max-w-full object-contain">
                    </div>
                </div>

                <!-- Content -->
                <div class="flex flex-col p-8 md:p-12 lg:col-span-7">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-bold uppercase tracking-wider text-white" style="background: {{ $c['accent'] }}">
                            {{ $c['tag'] }}
                        </span>
                        @if ($c['grade'])
                            <span class="inline-flex items-center gap-2 rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-700 ring-1 ring-red-100">
                                <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 1.944A11.954 11.954 0 0 1 2.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0 1 10 1.944ZM13.707 8.707a1 1 0 0 0-1.414-1.414L9 10.586 7.707 9.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd"/></svg>
                                Grade A · {{ $c['grade'] }} Company
                            </span>
                        @endif
                    </div>

                    <h3 class="mt-5 font-display text-3xl font-bold text-gray-900 md:text-4xl">{{ $c['name'] }}</h3>
                    <p class="mt-4 text-lg leading-relaxed text-gray-600">{{ ucfirst($c['desc']) }}</p>

                    <ul class="mt-7 grid grid-cols-1 gap-3 sm:grid-cols-2">
                        @foreach ($c['points'] as $point)
                            <li class="flex items-center gap-3 rounded-2xl bg-gray-50 px-4 py-3 text-sm font-semibold text-gray-700 ring-1 ring-gray-100">
                                <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full text-white" style="background: {{ $c['accent'] }}">
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="m5 13 4 4L19 7"/></svg>
                                </span>
                                {{ $point }}
                            </li>
                        @endforeach
                    </ul>

                    <div class="mt-auto flex flex-wrap items-center gap-4 pt-8">
                        <a href="{{ $c['url'] }}" target="_blank" rel="noopener noreferrer" class="btn-primary">
                            Visit {{ $c['name'] }}
                            <svg class="h-4 w-4 transition-transform duration-300 group-hover:-translate-y-0.5 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                        </a>
                        <span class="text-sm text-gray-400">{{ preg_replace('#^https?://(www\.)?|/$#', '', $c['url']) }}</span>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</section>

<!-- ============ CTA ============ -->
<section class="bg-gray-50 pb-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="relative isolate overflow-hidden rounded-[2rem] bg-gradient-to-br from-red-600 via-red-600 to-orange-500 px-8 py-14 text-white md:px-16 md:py-16" data-reveal="zoom">
            <div class="pointer-events-none absolute inset-0 -z-10 bg-grid opacity-40 [mask-image:radial-gradient(ellipse_at_right,black,transparent_70%)]"></div>
            <div class="pointer-events-none absolute -right-20 -top-20 -z-10 h-72 w-72 rounded-full bg-white/20 blur-3xl"></div>
            <div class="flex flex-col items-start justify-between gap-8 md:flex-row md:items-center">
                <div class="max-w-2xl">
                    <h2 class="font-display text-3xl font-bold text-white md:text-4xl">Interested in Partnership?</h2>
                    <p class="mt-3 text-lg text-white/85">
                        Contact us to learn more about partnership opportunities and our expanding network.
                    </p>
                </div>
                <a href="{{ route('contact') }}" class="btn shrink-0 bg-white px-8 py-4 text-red-600 shadow-xl hover:-translate-y-0.5 hover:bg-gray-50">
                    Contact Us
                    <svg class="btn-arrow h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
