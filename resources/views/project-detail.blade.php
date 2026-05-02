@extends('layouts.app')

@section('title', $project->title.' Project - Shannon Engineering Company')

@section('content')

<section
class="relative overflow-hidden bg-gradient-to-br from-slate-50 via-white to-rose-50 py-16"

x-data="projectGallery()"
x-init="init()"
>

    <!-- BACKGROUND EFFECT -->
    <div class="absolute -top-20 -left-20 w-96 h-96 bg-red-200/30 blur-3xl rounded-full animate-pulse"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-orange-100/30 blur-3xl rounded-full animate-pulse"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- HEADER -->
        <div class="text-center my-14 animate-fade-in-down">

            <p class="uppercase tracking-[6px] text-red-600 text-sm font-semibold mb-3">
                Featured Project
            </p>

            <h1 class="text-4xl md:text-5xl font-black text-gray-900 leading-tight">
                {{$project->title}}
            </h1>

            <div class="mt-5">

                <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full text-sm font-semibold shadow-md
                {{ strtolower($project->status) == 'ongoing'
                    ? 'bg-yellow-100 text-yellow-700'
                    : 'bg-green-100 text-green-700' }}">

                    <span class="w-2 h-2 rounded-full bg-current animate-pulse"></span>

                    {{ strtolower($project->status) == 'ongoing'
                        ? 'Under Construction'
                        : 'Delivered Successfully' }}

                </span>

            </div>

        </div>


        <!-- CONTENT GRID -->
        <div class="grid lg:grid-cols-2 gap-12 items-start">

            <!-- LEFT IMAGE -->
            <div class="animate-slide-left">

                <div
                    class="relative rounded-3xl bg-white/90 backdrop-blur-xl border border-white shadow-2xl p-3 overflow-hidden group"
                    @mouseenter="pause()"
                    @mouseleave="play()"
                >

                    <img
                        :src="activeImage"
                        alt="Project Image"
                        class="w-full h-[500px] object-contain rounded-2xl transition-all duration-700"
                    >

                    <!-- Buttons -->
                    <button
                        @click="prevImage()"
                        class="nav-btn left-4"
                    >
                        ←
                    </button>

                    <button
                        @click="nextImage()"
                        class="nav-btn right-4"
                    >
                        →
                    </button>

                    <!-- Progress -->
                    <div class="absolute bottom-0 left-0 h-1 bg-red-600 transition-all duration-300"
                         :style="'width:'+progress+'%'">
                    </div>

                </div>

                <!-- THUMBNAILS -->
                <div class="flex gap-4 mt-5 overflow-x-auto pb-2">

                    <template x-for="(img,index) in images" :key="index">

                        <img
                            :src="img"
                            @click="goTo(index)"
                            class="w-28 h-20 rounded-xl object-cover cursor-pointer border-2 shadow-md transition-all duration-300 hover:scale-105"
                            :class="activeIndex == index
                                ? 'border-red-600 scale-105 shadow-lg'
                                : 'border-transparent opacity-70'"
                        >

                    </template>

                </div>

            </div>



            <!-- RIGHT DETAILS -->
            <div class="animate-slide-right">

                <!-- CARDS -->
                <div class="grid sm:grid-cols-2 gap-5">

                    <div class="lux-card">
                        <div class="icon-box">📍</div>
                        <p class="card-label">Location</p>
                        <h3 class="card-title">{{$project->location}}</h3>
                    </div>

                    <div class="lux-card">
                        <div class="icon-box">📐</div>
                        <p class="card-label">Project Size</p>
                        <h3 class="card-title">
                            {!! $project->size ? formatIndianNumber($project->size).' m<sup>2</sup>' : 'N/A' !!}
                        </h3>
                    </div>

                    <div class="lux-card">
                        <div class="icon-box">🏢</div>
                        <p class="card-label">Client</p>
                        <h3 class="card-title">
                            {{$project->client ?? 'N/A'}}
                        </h3>
                    </div>

                    <div class="lux-card">
                        <div class="icon-box">👷</div>
                        <p class="card-label">Consultant</p>
                        <h3 class="card-title">
                            {{$project->consultant ?? 'N/A'}}
                        </h3>
                    </div>

                </div>


                <!-- DESCRIPTION -->
                <div class="mt-8 glass-panel">

                    <h2 class="text-xl font-bold text-gray-900 mb-4">
                        Project Overview
                    </h2>

                    <p class="text-gray-600 leading-8 text-justify">
                        {{$project->description}}
                    </p>

                </div>


                <!-- BUTTONS -->
                <div class="flex flex-wrap gap-4 mt-8">

                    <a href="{{ route('listprojects',$project->category_id) }}"
                       class="btn-red">
                        ← Back
                    </a>

                    <a href="{{ route('projects') }}"
                       class="btn-dark">
                        All Projects
                    </a>

                </div>

            </div>

        </div>



        <!-- BOTTOM NAV -->
        <div class="flex justify-between items-center mt-20 border-t border-gray-200 pt-8">

            @if($prev)
            <a href="{{ route('detailprojects', $prev->id) }}"
               class="group text-gray-600 hover:text-red-600 transition flex items-center gap-3">

                <span class="text-2xl group-hover:-translate-x-1 transition">←</span>

                <div>
                    <p class="text-xs text-gray-400 uppercase">Previous</p>
                    <p class="font-semibold">{{$prev->title}}</p>
                </div>

            </a>
            @else
            <div></div>
            @endif


            @if($next)
            <a href="{{ route('detailprojects', $next->id) }}"
               class="group text-right text-gray-600 hover:text-red-600 transition flex items-center gap-3">

                <div>
                    <p class="text-xs text-gray-400 uppercase">Next</p>
                    <p class="font-semibold">{{$next->title}}</p>
                </div>

                <span class="text-2xl group-hover:translate-x-1 transition">→</span>

            </a>
            @else
            <div></div>
            @endif

        </div>

    </div>

</section>



<script>
function projectGallery(){
    return {

        activeIndex: 0,
        timer: null,
        progress: 0,

        images: @json(
            collect([asset('storage/'.$project->card_img)])
            ->merge($images->map(fn($img)=>asset('storage/'.$img->image_path)))
            ->unique()
            ->values()
        ),

        get activeImage(){
            return this.images[this.activeIndex];
        },

        init(){
            this.play();
        },

        nextImage(){
            this.activeIndex = (this.activeIndex + 1) % this.images.length;
            this.resetProgress();
        },

        prevImage(){
            this.activeIndex =
                (this.activeIndex - 1 + this.images.length) % this.images.length;
            this.resetProgress();
        },

        goTo(index){
            this.activeIndex = index;
            this.resetProgress();
        },

        play(){
            this.pause();

            this.progress = 0;

            this.timer = setInterval(() => {

                this.progress += 2.5;

                if(this.progress >= 100){
                    this.nextImage();
                }

            },100);
        },

        pause(){
            clearInterval(this.timer);
        },

        resetProgress(){
            this.play();
        }

    }
}
</script>



<style>

.lux-card{
    background: rgba(255,255,255,.85);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,.6);
    border-radius: 22px;
    padding: 24px;
    box-shadow: 0 15px 35px rgba(0,0,0,.06);
    transition: .35s ease;
}

.lux-card:hover{
    transform: translateY(-6px);
    box-shadow: 0 20px 45px rgba(239,68,68,.14);
}

.icon-box{
    width: 42px;
    height: 42px;
    border-radius: 14px;
    background: linear-gradient(135deg,#ef4444,#f97316);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
    margin-bottom:14px;
    color:#fff;
}

.card-label{
    font-size:12px;
    text-transform:uppercase;
    letter-spacing:2px;
    color:#9ca3af;
    margin-bottom:8px;
}

.card-title{
    font-size:18px;
    font-weight:700;
    color:#111827;
    line-height:1.4;
}

.glass-panel{
    background: rgba(255,255,255,.82);
    backdrop-filter: blur(14px);
    border:1px solid rgba(255,255,255,.7);
    border-radius:26px;
    padding:32px;
    box-shadow:0 15px 35px rgba(0,0,0,.06);
}

.nav-btn{
    position:absolute;
    top:50%;
    transform:translateY(-50%);
    width:42px;
    height:42px;
    border-radius:9999px;
    background:rgba(255,255,255,.85);
    backdrop-filter:blur(8px);
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    transition:.3s;
    opacity:0;
}

.group:hover .nav-btn{
    opacity:1;
}

.nav-btn:hover{
    background:#ef4444;
    color:#fff;
}

.btn-red{
    padding:14px 28px;
    border-radius:14px;
    background:#dc2626;
    color:#fff;
    font-weight:600;
    transition:.3s;
    box-shadow:0 10px 20px rgba(220,38,38,.18);
}

.btn-red:hover{
    transform:translateY(-3px);
    background:#b91c1c;
}

.btn-dark{
    padding:14px 28px;
    border-radius:14px;
    background:#111827;
    color:#fff;
    font-weight:600;
    transition:.3s;
}

.btn-dark:hover{
    transform:translateY(-3px);
}

@keyframes fadeDown{
    from{opacity:0;transform:translateY(-30px);}
    to{opacity:1;transform:translateY(0);}
}

@keyframes slideLeft{
    from{opacity:0;transform:translateX(-35px);}
    to{opacity:1;transform:translateX(0);}
}

@keyframes slideRight{
    from{opacity:0;transform:translateX(35px);}
    to{opacity:1;transform:translateX(0);}
}

.animate-fade-in-down{
    animation:fadeDown .8s ease;
}

.animate-slide-left{
    animation:slideLeft .9s ease;
}

.animate-slide-right{
    animation:slideRight .9s ease;
}

</style>

@endsection