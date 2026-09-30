@props([
    'title',
    'highlight' => null,
    'subtitle' => null,
    'eyebrow' => null,
    'image' => 'skyline',
    'crumbs' => [],
])

@push('preload')
    <link rel="preload" as="image" href="{{ asset("images/optimized/{$image}-1920.webp") }}"
          imagesrcset="{{ asset("images/optimized/{$image}-960.webp") }} 960w, {{ asset("images/optimized/{$image}-1920.webp") }} 1920w"
          imagesizes="100vw" fetchpriority="high">
@endpush

<section class="relative isolate flex min-h-[420px] items-end overflow-hidden bg-ink-900 pb-14 pt-36 text-white md:min-h-[480px] md:pb-20">
    <img src="{{ asset("images/optimized/{$image}-1920.webp") }}"
         srcset="{{ asset("images/optimized/{$image}-960.webp") }} 960w, {{ asset("images/optimized/{$image}-1920.webp") }} 1920w"
         sizes="100vw" alt="" fetchpriority="high" decoding="async"
         class="absolute inset-0 -z-20 h-full w-full animate-ken-burns object-cover">
    <div class="absolute inset-0 -z-10 bg-gradient-to-t from-ink-900 via-ink-900/70 to-ink-900/30"></div>
    <div class="absolute inset-0 -z-10 bg-gradient-to-r from-ink-900/80 via-transparent to-transparent"></div>
    <div class="absolute inset-0 -z-10 bg-grid opacity-30 [mask-image:linear-gradient(to_top,black,transparent)]"></div>

    <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
        <nav aria-label="Breadcrumb" class="animate-fade-up mb-6">
            <ol class="flex flex-wrap items-center gap-2 text-xs font-semibold uppercase tracking-[0.18em] text-white/60">
                <li><a href="{{ route('home') }}" class="transition hover:text-white">Home</a></li>
                @foreach($crumbs as $label => $url)
                    <li aria-hidden="true" class="text-red-500">/</li>
                    <li>
                        @if($url)
                            <a href="{{ $url }}" class="transition hover:text-white">{{ $label }}</a>
                        @else
                            <span class="text-white" aria-current="page">{{ $label }}</span>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>

        @if($eyebrow)
            <p class="eyebrow animate-fade-up text-red-400">{{ $eyebrow }}</p>
        @endif

        <h1 class="mt-3 max-w-4xl overflow-hidden font-display text-4xl font-bold leading-[1.05] text-white md:text-6xl lg:text-7xl">
            <span class="block animate-rise">
                {{ $title }}@if($highlight) <span class="bg-gradient-to-r from-red-500 to-orange-400 bg-clip-text text-transparent">{{ $highlight }}</span>@endif
            </span>
        </h1>

        @if($subtitle)
            <p class="mt-5 max-w-2xl animate-fade-up text-base leading-relaxed text-white/75 [animation-delay:.25s] md:text-lg">
                {{ $subtitle }}
            </p>
        @endif

        <div class="mt-8 h-1 w-20 origin-left animate-fade-up rounded-full bg-gradient-to-r from-red-600 to-orange-400 [animation-delay:.4s]"></div>

        {{ $slot }}
    </div>
</section>
