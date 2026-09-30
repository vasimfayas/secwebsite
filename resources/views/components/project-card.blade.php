@props(['project', 'href'])

@php
    $ongoing = strtolower($project->status) == 'ongoing';
@endphp

<article {{ $attributes->merge(['class' => 'group relative flex flex-col overflow-hidden rounded-3xl bg-white shadow-[0_1px_2px_rgba(16,24,40,.04),0_12px_32px_-16px_rgba(16,24,40,.18)] ring-1 ring-gray-100 transition-all duration-500 hover:-translate-y-1.5 hover:shadow-[0_28px_60px_-24px_rgba(220,38,38,.35)]']) }}>
    <a href="{{ $href }}" class="relative block aspect-[4/3] overflow-hidden bg-gray-100">
        @if($project->card_img)
            <img src="{{ asset('storage/' . $project->card_img) }}" alt="{{ $project->title }}"
                 loading="lazy" decoding="async"
                 class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-110">
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-transparent opacity-80 transition-opacity duration-500 group-hover:opacity-100"></div>

        <span class="absolute left-4 top-4 inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-[11px] font-bold uppercase tracking-wider backdrop-blur
            {{ $ongoing ? 'bg-yellow-400/90 text-gray-900' : 'bg-emerald-500/90 text-white' }}">
            <span class="h-1.5 w-1.5 rounded-full bg-current {{ $ongoing ? 'animate-pulse' : '' }}"></span>
            {{ $ongoing ? 'Under Construction' : 'Delivered' }}
        </span>

        @if($project->location)
            <span class="absolute bottom-4 left-4 inline-flex items-center gap-1.5 text-sm font-medium text-white">
                <svg class="h-4 w-4 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                {{ $project->location }}
            </span>
        @endif
    </a>

    <div class="flex flex-1 flex-col p-6">
        <h3 class="font-display text-xl font-semibold leading-snug text-gray-900 transition-colors group-hover:text-red-600">
            <a href="{{ $href }}">{{ $project->title }}</a>
        </h3>

        <p class="mt-2 text-sm text-gray-500">
            <span class="font-semibold text-gray-700">Size:</span>
            {!! $project->size && preg_replace('/[^0-9]/', '', $project->size) !== '' ? formatIndianNumber($project->size) . ' m<sup>2</sup>' : 'N/A' !!}
        </p>

        @if($project->description_text)
            <p class="mt-3 line-clamp-3 text-sm leading-relaxed text-gray-500">{{ $project->description_text }}</p>
        @endif

        <div class="mt-auto pt-6">
            <a href="{{ $href }}" class="inline-flex items-center gap-2 text-sm font-semibold text-red-600">
                View Project
                <svg class="btn-arrow h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</article>
