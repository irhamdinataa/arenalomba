@extends('layouts.app')

@section('title')
    Arena Lomba
@endsection

@section('content')
<!--  Recent Articles start -->
<div class="recent-area pt-50 pb-50 background12">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <div class="widget-header position-relative mb-30">
                    <h5 class="widget-title mb-30 text-uppercase color1 font-weight-ultra">Artikel</h5>
                    <div class="letter-background">Artikel</div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                
            </div>
        </div>
        <div class="row">
            @php
                $no = 1;
            @endphp
            @forelse ($post as $item)
                <div class="col-lg-6 col-md-6">
                    <div class="loop-list">
                        <article class="row mb-50">
                            <div class="col-md-6">
                                <div class="post-thumb position-relative thumb-overlay mr-20">
                                    <div class="img-hover-slide border-radius-5 position-relative" style="background-image: url({{ Storage::url($item->post_image) }})">
                                        <a class="img-link" href="{{ route('post-detail', $item->slug) }}"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 align-center-vertical">
                                <div class="post-content">
                                    <div class="entry-meta meta-0 font-small mb-15">
                                        @php
                                            $sc = App\Models\Category::where('id', $item->sub_categories)->first();
                                        @endphp
                                        @if ($item->sub_categories != NULL)
                                            <a href="{{ route('home-category', $sc->slug) }}">
                                                <span class="post-cat background{{ $no++; }} color-white">
                                                    {{ $sc->name; }}
                                                </span>
                                            </a>
                                        @else
                                            <a href="{{ route('home-category', $item->category->slug) }}">
                                                <span class="post-cat background{{ $no++; }} color-white">
                                                    {{ $item->category->name; }}
                                                </span>
                                            </a>
                                        @endif
                                    </div>
                                    <h4 class="post-title">
                                        <a href="{{ route('post-detail', $item->slug) }}">{{ $item->post_title; }}</a>
                                    </h4>
                                    <div class="entry-meta meta-1 font-small color-grey mt-15 mb-15">
                                        <span class="time-reading">
                                            <i class="ti-user"></i>{{ splitName($item->user->name) }}
                                        </span>
                                        <span class="post-on"><i class="ti-marker-alt"></i>
                                            {{ date('d F Y', strtotime($item->published_at));}}
                                        </span>
                                    </div>
                                    <p class="font-medium">
                                        {{ $item->post_teaser; }}
                                    </p>
                                    <a class="readmore-btn font-small text-uppercase font-weight-ultra" href="{{ route('post-detail', $item->slug) }}">
                                        Baca Selengkapnya<i class="ti-arrow-right ml-5"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            @empty
                <div class="col-lg-12">
                    <div class="alert alert-danger" role="alert">
                        Artikel tidak tersedia
                    </div>
                </div>
            @endforelse
            
            <!--Start pagination -->
            <div class="pagination-area pt-30 text-center bt-1 border-color-1">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="single-wrap d-flex justify-content-center">
                                @if ($post->hasPages())
                                    <ul class="pagination" role="navigation">
                                        {{-- Previous Page Link --}}
                                        @if ($post->onFirstPage())
                                            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                                <span class="page-link" aria-hidden="true">&lsaquo;</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $post->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                                            </li>
                                        @endif

                                        <?php
                                            $start = $post->currentPage() - 1; 
                                            $end = $post->currentPage() + 1; 
                                            if($start < 1) {
                                                $start = 1; 
                                                $end += 1;
                                            } 
                                            if($end >= $post->lastPage() ) $end = $post->lastPage(); 
                                        ?>

                                        @if($start > 1)
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $post->url(1) }}">{{1}}</a>
                                            </li>
                                            @if($post->currentPage() != 4)
                                                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                                            @endif
                                        @endif
                                            @for ($i = $start; $i <= $end; $i++)
                                                <li class="page-item {{ ($post->currentPage() == $i) ? ' active' : '' }}">
                                                    <a class="page-link" href="{{ $post->url($i) }}">{{$i}}</a>
                                                </li>
                                            @endfor
                                        @if($end < $post->lastPage())
                                            @if($post->currentPage() + 3 != $post->lastPage())
                                                {{-- "Three Dots" Separator --}}
                                                <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                                            @endif
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $post->url($post->lastPage()) }}">{{$post->lastPage()}}</a>
                                            </li>
                                        @endif

                                        {{-- Next Page Link --}}
                                        @if ($post->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $post->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                                            </li>
                                        @else
                                            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                                                <span class="page-link" aria-hidden="true">&rsaquo;</span>
                                            </li>
                                        @endif
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End pagination  -->
        </div>
    </div>
</div>
<!--Recent Articles End -->
<!-- Recent Posts Start -->
<div class="pt-50 pb-50 background-white">
    <div class="container mb-50">
        <div class="sidebar-widget loop-grid">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="widget-header position-relative mb-30">
                        <h5 class="widget-title mb-30 text-uppercase color4 font-weight-ultra">Info Lomba</h5>
                        <div class="letter-background">Info</div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="news-flash-cover text-right">
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="pt-30 bt-1 border-color-1"></div>
                </div>
                @forelse ($contest as $item)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
                        <div class="post-thumb position-relative thumb-overlay hover-box-shadow-2 mb-30">
                            <div class="img-hover-slide border-radius-5 position-relative" style="background-image: url({{ Storage::url($item->post_image) }})">
                                <a class="img-link" href="{{ route('contest-detail', $item->slug) }}"></a>
                                <span class="top-right-icon background8"><i class="mdi mdi-camera-alt"></i></span>
                            </div>
                        </div>
                        <div class="post-content">
                            <div class="entry-meta meta-0 font-small mb-15">
                                <a href="{{ route('home-category', $item->category->slug) }}">
                                    <span class="post-cat background1 color-white">
                                        {{ $item->category->name; }}
                                    </span>
                                </a>
                            </div>
                            <h4 class="post-title">
                                <a href="{{ route('contest-detail', $item->slug) }}">{{ $item->post_title; }}</a>
                            </h4>
                            <div class="entry-meta meta-1 font-small color-grey mt-15 mb-15">
                                <span class="time-reading">
                                    <i class="ti-user"></i>{{ splitName($item->user->name) }}
                                </span>
                                <span class="post-on"><i class="ti-marker-alt"></i>
                                    {{ date('d F Y', strtotime($item->published_at));}}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-12">
                        <div class="alert alert-danger" role="alert">
                            Artikel tidak tersedia
                        </div>
                    </div>
                @endforelse
                <div class="col-12">
                    <div class="mt-30 bt-1 border-color-1"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Youtube -->
    <div class="video-area background_dark area-padding pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sidebar-widget">
                        <div class="widget-header position-relative mb-30">
                            <div class="row">
                                <div class="col-7">
                                    <h5 class="widget-title text-uppercase color4 font-weight-ultra">LATEST VIDEOS</h5>
                                    <div class="letter-background">IN MOTION</div>
                                </div>
                                <div class="col-5 text-right">
                                    <h6 class="text-uppercase font-medium">
                                        <i class="ti-video-clapper color-white mr-5"></i>
                                        <a class="color-white" href="{{ route('video-home.index') }}">Semua Video</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        @php
                            $mainVideo = $videos->first(); 
                            $otherVideo = $videos->skip(1); 
                        @endphp
                        <div class="block-tab-item post-module-1 post-module-4 mt-50">
                            <div class="row">
                                <div class="col-lg-5 col-md-6">
                                    @if($mainVideo)
                                    <div class="post-thumb position-relative">
                                        <div class="thumb-overlay img-hover-slide border-radius-5 position-relative" style="background-image: url(https://img.youtube.com/vi/{{ $mainVideo->embed_link }}/hqdefault.jpg)">
                                            {{-- <span class="top-right-icon background3"><i class="mdi mdi-favorite"></i></span> --}}
                                            <a class="img-link" href="{{ route('video-home-detail', $mainVideo->slug) }}"></a>
                                            <div class="post-content-overlay">
                                                <div class="entry-meta meta-0 font-small mb-20">
                                                    <a href="category.html"><span class="post-cat background2 color-white">{{ $mainVideo->category->name; }}</span></a>
                                                </div>
                                                <h2 class="post-title">
                                                    <a class="color-white" href="{{ route('video-home-detail', $mainVideo->slug) }}">{{ $mainVideo->post_title }}</a>
                                                </h2>
                                                <div class="entry-meta meta-1 font-small color-grey mt-10 pr-5 pl-5">
                                                    <span class="time-reading">
                                                        <i class="ti-user"></i>{{ splitName($mainVideo->user->name) }}
                                                    </span>
                                                    <span class="post-on">{{ date('d F Y', strtotime($mainVideo->published_at));}}</span>
                                                </div>
                                            </div>
                                            <div class="play_btn">
                                                <a href="{{ route('video-home-detail', $mainVideo->slug) }}">
                                                    <i class="ti-control-play"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-lg-7 col-md-6">
                                    <div class="row">
                                        @foreach($otherVideo as $video)
                                        <div class="slider-single col-lg-4 col-md-6 mb-30">
                                            <div class="img-hover-scale border-radius-5">
                                                {{-- <span class="top-right-icon background10"><i class="mdi mdi-flash-on"></i></span> --}}
                                                <a href="{{ route('video-home-detail', $video->slug) }}">
                                                    <img class="border-radius-5" src="https://img.youtube.com/vi/{{ $video->embed_link }}/hqdefault.jpg" alt="post-slider">
                                                </a>
                                                <div class="play_btn play_btn_small">
                                                    <a href="{{ route('video-home-detail', $video->slug) }}">
                                                        <i class="ti-control-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <h6 class="post-title pr-5 pl-5 mb-10 mt-15 text-limit-2-row">
                                                <a class="color-white" href="{{ route('video-home-detail', $video->slug) }}">{{ $video->post_title }}</a>
                                            </h6>
                                            <div class="entry-meta meta-1 font-small color-grey mt-10 pr-5 pl-5">
                                                <span class="time-reading">
                                                    <i class="ti-user"></i>{{ splitName($mainVideo->user->name) }}
                                                </span>
                                                <span class="post-on">{{ date('d F Y', strtotime($mainVideo->published_at));}}</span>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Start youtube -->
    <div class="container mt-50">
        <div class="sidebar-widget">
            <div class="widget-header position-relative mb-30">
                <h5 class="widget-title mb-30 text-uppercase color2 font-weight-ultra">Kelas</h5>
                <div class="letter-background">Kelas</div>
            </div>
            <div class="post-carausel-2 post-module-1 row">
                @forelse ($courses as $item)
                    <div class="col">
                        <div class="post-thumb position-relative">
                            <div class="thumb-overlay img-hover-slide border-radius-5 position-relative" style="background-image: url({{ Storage::url($item->post_image) }})">
                                <a class="img-link" href="{{ route('kelas-detail', $item->slug) }}"></a>
                                <span class="top-right-icon background2"><i class="mdi mdi-favorite"></i></span>
                                <div class="post-content-overlay">
                                    <div class="entry-meta meta-0 font-small mb-10">
                                        <a href="{{ route('kelas-detail', $item->slug) }}">
                                            <span class="post-cat background2 color-white">
                                                {{ $item->category->name; }}
                                            </span>
                                        </a>
                                    </div>
                                    <h6 class="post-title">
                                        <a class="color-white" href="{{ route('kelas-detail', $item->slug) }}">{{ $item->post_title; }}</a>
                                    </h6>
                                    <div class="entry-meta meta-1 font-small color-grey mt-10 pr-5 pl-5">
                                        <span class="time-reading">
                                            <i class="ti-user"></i>{{ splitName($item->user->name) }}
                                        </span>
                                        <span class="post-on"><i class="ti-marker-alt"></i>
                                            {{ date('d F Y', strtotime($item->published_at));}}
                                        </span>
                                        <span class="post-on"><i class="ti-money"></i>
                                            {{ number_format($item->price, 0, ",", ".") }}
                                        </span>
                                        <a class="float-right" href="#"><i class="ti-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-12">
                        <div class="alert alert-danger w-100" role="alert">
                            Artikel tidak tersedia
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
<!-- Recent Posts End -->
@endsection

