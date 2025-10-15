@extends('layouts.app')

@section('title', 'Meet Our Team')

@section('content')
<!-- Hero Section -->
<section class="relative text-white h-[420px] md:h-[340px] bg-cover bg-center bg-no-repeat"
         aria-label="Meet Our Team hero"
         style="background-image: url('{{ asset('images/home/banner1.png') }}');">

  <!-- layered overlays: deeper bottom gradient + gentle vignette -->
  <div class="absolute inset-0">
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent"></div>
    <div class="absolute inset-0"
         style="background: radial-gradient(120% 70% at 50% 115%, rgba(0,0,0,.45), transparent 60%);">
    </div>
  </div>

  <!-- content: bottom-left glass card (best for bright photos) -->
  <div class="absolute bottom-8 left-6 right-6  md:left-6 md:right-auto">
    <div class="inline-block rounded-2xl backdrop-blur-md bg-black/20 ring-1 ring-white/20 px-5 py-4 shadow-lg">
      <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight leading-tight drop-shadow-[0_6px_18px_rgba(0,0,0,0.45)]">
        Meet Our <span class="text-red-400">Team</span>
      </h1>
      <p class="mt-1 text-sm md:text-lg text-white/90">
        Our dedicated professionals are here to support your projects.
      </p>
      <div class="mt-3 h-[3px] w-20 rounded-full bg-gradient-to-r from-red-500 via-red-400 to-red-500"></div>
    </div>
  </div>
</section>

<section id="team" class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-bold text-red-700 text-center">Our Team</h2>
    <p class="mt-2 text-center text-gray-500">People behind the work</p>

    <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
      <!-- Card -->
      <button
        type="button"
        class="group relative w-full text-left bg-white rounded-2xl shadow ring-1 ring-gray-100 hover:shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-red-500"
        data-name="Hany Abdel Fattah"
        data-role="CEO"
        data-message="Building systems that scale and teams that thrive."
      >
        <div class="p-6 flex items-center gap-4">
          <div class="relative">
            <img src="{{ asset('images/team/pp.webp') }}" alt="Hany Abdel Fattah"
                 class="size-16 rounded-full object-cover ring-2 ring-red-500/30" />
            <span class="absolute -bottom-1 -right-1 size-3 rounded-full bg-red-500 ring-2 ring-white"></span>
          </div>
          <div class="min-w-0">
            <h3 class="font-semibold text-gray-900 group-hover:text-red-700 transition-colors">
              Hany Abdel Fattah
            </h3>
            <p class="text-sm text-gray-500">CEO</p>
          </div>
          <div class="ml-auto">
            <span class="inline-flex items-center justify-center size-8 rounded-full bg-red-50 text-red-600">
              <!-- arrow icon -->
              <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                   stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 18l6-6-6-6" />
              </svg>
            </span>
          </div>
        </div>
        <div class="h-1 w-0 group-hover:w-full bg-red-500 transition-all duration-300 rounded-b-2xl"></div>
      </button>

      <!-- Duplicate cards (change data- attributes, names & roles) -->
      <button type="button" class="group relative w-full text-left bg-white rounded-2xl shadow ring-1 ring-gray-100 hover:shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-red-500"
        data-name="Badawi Gaber Badawi" data-role="Operations Manager"
        data-message="Driving operations that deliver excellence.">
        <div class="p-6 flex items-center gap-4">
          <div class="relative">
            <img src="{{ asset('images/team/pp.webp') }}" alt="Badawi Gaber Badawi"
                 class="size-16 rounded-full object-cover ring-2 ring-red-500/30" />
            <span class="absolute -bottom-1 -right-1 size-3 rounded-full bg-red-500 ring-2 ring-white"></span>
          </div>
          <div class="min-w-0">
            <h3 class="font-semibold text-gray-900 group-hover:text-red-700 transition-colors">Badawi Gaber Badawi</h3>
            <p class="text-sm text-gray-500">Operations Manager</p>
          </div>
          <div class="ml-auto">
            <span class="inline-flex items-center justify-center size-8 rounded-full bg-red-50 text-red-600">
              <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                   stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
            </span>
          </div>
        </div>
        <div class="h-1 w-0 group-hover:w-full bg-red-500 transition-all duration-300 rounded-b-2xl"></div>
      </button>

      <button type="button" class="group relative w-full text-left bg-white rounded-2xl shadow ring-1 ring-gray-100 hover:shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-red-500"
        data-name="Ehab Mahmoud Abbas" data-role="Projects Manager"
        data-message="Delivering projects on time and beyond expectations.">
        <div class="p-6 flex items-center gap-4">
          <div class="relative">
            <img src="{{ asset('images/team/pp.webp') }}" alt="Ehab Mahmoud Abbas"
                 class="size-16 rounded-full object-cover ring-2 ring-red-500/30" />
            <span class="absolute -bottom-1 -right-1 size-3 rounded-full bg-red-500 ring-2 ring-white"></span>
          </div>
          <div class="min-w-0">
            <h3 class="font-semibold text-gray-900 group-hover:text-red-700 transition-colors">Ehab Mahmoud Abbas</h3>
            <p class="text-sm text-gray-500">Projects Manager</p>
          </div>
          <div class="ml-auto">
            <span class="inline-flex items-center justify-center size-8 rounded-full bg-red-50 text-red-600">
              <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                   stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
            </span>
          </div>
        </div>
        <div class="h-1 w-0 group-hover:w-full bg-red-500 transition-all duration-300 rounded-b-2xl"></div>
      </button>

      <button type="button" class="group relative w-full text-left bg-white rounded-2xl shadow ring-1 ring-gray-100 hover:shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-red-500"
        data-name="M.Dushyantha Saman K Cooray" data-role="Tender Manager"
        data-message="Precision and planning make the best bids.">
        <div class="p-6 flex items-center gap-4">
          <div class="relative">
            <img src="{{ asset('images/team/pp.webp') }}" alt="M.Dushyantha Saman K Cooray"
                 class="size-16 rounded-full object-cover ring-2 ring-red-500/30" />
            <span class="absolute -bottom-1 -right-1 size-3 rounded-full bg-red-500 ring-2 ring-white"></span>
          </div>
          <div class="min-w-0">
            <h3 class="font-semibold text-gray-900 group-hover:text-red-700 transition-colors">M.Dushyantha Saman K Cooray</h3>
            <p class="text-sm text-gray-500">Tender Manager</p>
          </div>
          <div class="ml-auto">
            <span class="inline-flex items-center justify-center size-8 rounded-full bg-red-50 text-red-600">
              <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                   stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
            </span>
          </div>
        </div>
        <div class="h-1 w-0 group-hover:w-full bg-red-500 transition-all duration-300 rounded-b-2xl"></div>
      </button>

      <button type="button" class="group relative w-full text-left bg-white rounded-2xl shadow ring-1 ring-gray-100 hover:shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-red-500"
        data-name="Santhosh Kumar" data-role="Accounts Manager"
        data-message="Balancing books, powering growth.">
        <div class="p-6 flex items-center gap-4">
          <div class="relative">
            <img src="{{ asset('images/team/pp.webp') }}" alt="Santhosh Kumar"
                 class="size-16 rounded-full object-cover ring-2 ring-red-500/30" />
            <span class="absolute -bottom-1 -right-1 size-3 rounded-full bg-red-500 ring-2 ring-white"></span>
          </div>
          <div class="min-w-0">
            <h3 class="font-semibold text-gray-900 group-hover:text-red-700 transition-colors">Santhosh Kumar</h3>
            <p class="text-sm text-gray-500">Accounts Manager</p>
          </div>
          <div class="ml-auto">
            <span class="inline-flex items-center justify-center size-8 rounded-full bg-red-50 text-red-600">
              <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                   stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
            </span>
          </div>
        </div>
        <div class="h-1 w-0 group-hover:w-full bg-red-500 transition-all duration-300 rounded-b-2xl"></div>
      </button>

      <button type="button" class="group relative w-full text-left bg-white rounded-2xl shadow ring-1 ring-gray-100 hover:shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-red-500"
        data-name="Ibrahim Abdelhafez" data-role="HR Manager"
        data-message="Empowering people to achieve their best.">
        <div class="p-6 flex items-center gap-4">
          <div class="relative">
            <img src="{{ asset('images/team/pp.webp') }}" alt="Ibrahim Abdelhafez"
                 class="size-16 rounded-full object-cover ring-2 ring-red-500/30" />
            <span class="absolute -bottom-1 -right-1 size-3 rounded-full bg-red-500 ring-2 ring-white"></span>
          </div>
          <div class="min-w-0">
            <h3 class="font-semibold text-gray-900 group-hover:text-red-700 transition-colors">Ibrahim Abdelhafez</h3>
            <p class="text-sm text-gray-500">HR Manager</p>
          </div>
          <div class="ml-auto">
            <span class="inline-flex items-center justify-center size-8 rounded-full bg-red-50 text-red-600">
              <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                   stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
            </span>
          </div>
        </div>
        <div class="h-1 w-0 group-hover:w-full bg-red-500 transition-all duration-300 rounded-b-2xl"></div>
      </button>
    </div>
  </div>
</section>

<!-- Modal -->
<div id="teamModal" class="fixed inset-0 z-50 hidden" aria-hidden="true" role="dialog" aria-modal="true">
  <div class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity"></div>
  <div class="relative mx-auto max-w-lg mt-24 bg-white rounded-2xl shadow-xl ring-1 ring-gray-100 overflow-hidden">
    <div class="flex items-start gap-3 p-5 border-b">
      <div class="size-9 rounded-full bg-red-100 text-red-700 flex items-center justify-center">
        <!-- chat icon -->
        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M21 15a4 4 0 0 1-4 4H7l-4 4V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/>
        </svg>
      </div>
      <div class="min-w-0">
        <h3 id="modalName" class="text-lg font-semibold text-gray-900">Name</h3>
        <p id="modalRole" class="text-sm text-gray-500">Role</p>
      </div>
      <button id="modalClose" class="ml-auto text-gray-500 hover:text-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 rounded-full p-1" aria-label="Close">
        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
      </button>
    </div>
    <div class="p-6">
      <p id="modalMsg" class="text-gray-700 text-base"></p>
    </div>
    <div class="px-6 pb-6">
      <button id="modalOk" class="w-full inline-flex justify-center items-center gap-2 rounded-xl bg-red-600 hover:bg-red-700 text-white px-4 py-2.5 font-medium transition-colors">
        Got it
      </button>
    </div>
  </div>
</div>

<script>
  // Modal behavior with delegation
  const modal = document.getElementById('teamModal');
  const modalName = document.getElementById('modalName');
  const modalRole = document.getElementById('modalRole');
  const modalMsg  = document.getElementById('modalMsg');
  const modalClose = document.getElementById('modalClose');
  const modalOk = document.getElementById('modalOk');

  function openModal({name, role, message}) {
    modalName.textContent = name;
    modalRole.textContent = role;
    modalMsg.textContent  = '“' + message + '”';
    modal.classList.remove('hidden');
    // accessibility
    modal.setAttribute('aria-hidden', 'false');
    modalClose.focus();
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    modal.classList.add('hidden');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }

  document.addEventListener('click', (e) => {
    const card = e.target.closest('button[data-message]');
    if (card) {
      openModal({
        name: card.dataset.name,
        role: card.dataset.role,
        message: card.dataset.message
      });
      return;
    }
    if (e.target === modal || e.target.closest('#modalClose') || e.target.closest('#modalOk')) {
      closeModal();
    }
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
  });
</script>


  
<!-- Call to Action -->
<section class="py-20 bg-red-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold mb-6">
            Ready to Build Your Dream?
        </h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">
            Contact Shannon Engineering Company today and let's discuss how we can bring your construction project to life with success story.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="tel:+97444355656" class="bg-white text-red-600 hover:bg-gray-100 px-8 py-4 rounded-lg font-semibold text-lg inline-block transition-all duration-300">
                Call Now
            </a>
            <a href="mailto:info@shannoneng.com" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-red-600 px-8 py-4 rounded-lg font-semibold text-lg inline-block transition-all duration-300">
                Send Email
            </a>
        </div>
    </div>
</section>
@endsection