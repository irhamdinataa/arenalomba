@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
<div class="main-search-form transition-02s">
    <div class="pt-50 pb-50 main-search-form-cover">
        <form class="form-contact comment_form" action="{{ route('lomba.index') }}" method="GET" autocomplete="off">
            <div class="row mb-20">
                <div class="col-lg-3">
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="ti-search"></i></div>
                            </div>
                            <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control" id="keyword"  placeholder="Cari disini..">
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 px-0">
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="ti-user"></i></div>
                            </div>
                            <select name="participant" id="participant" class="form-control" required>
                                <option value="all" {{ request('participant') == 'all' ? 'selected' : '' }}>Semua Peserta</option>
                                <option value="SD/Sederajat" {{ request('participant') == 'SD/Sederajat' ? 'selected' : '' }}>SD/Sederajat</option>
                                <option value="SMP/Sederajat" {{ request('participant') == 'SMP/Sederajat' ? 'selected' : '' }}>SMP/Sederajat</option>
                                <option value="SMA/Sederajat" {{ request('participant') == 'SMA/Sederajat' ? 'selected' : '' }}>SMA/Sederajat</option>
                                <option value="Gapyear" {{ request('participant') == 'Gapyear' ? 'selected' : '' }}>Gapyear</option>
                                <option value="Mahasiswa" {{ request('participant') == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                <option value="Umum" {{ request('participant') == 'Umum' ? 'selected' : '' }}>Umum</option>
                                <option value="Guru" {{ request('participant') == 'Guru' ? 'selected' : '' }}>Guru</option>
                            </select>                                
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="ti-location-pin"></i></div>
                            </div>
                            <select name="location" id="location" class="form-control" required>
                                <option value="all" {{ request('location') == 'all' ? 'selected' : '' }}>Semua Lokasi</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->name }}"
                                        {{ request('location') == $province->name ? 'selected' : '' }}>
                                        {{ $province->name }}
                                    </option>
                                @endforeach
                            </select>                                
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 px-0">
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="ti-layout-grid2"></i></div>
                            </div>
                            <select name="categories_id" id="categories_id" class="form-control" required>
                                <option value="all" {{ request('categories_id') == 'all' ? 'selected' : '' }}>Semua Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('categories_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-1">
                    <button type="submit" name="search" class="button button-contactForm">Cari</button>
                </div>
                <div class="col-lg-12">
                    @php
                        $selectedPayments = request('payment', []);
                        $selectedStatus = request('status', []);
                    @endphp
                    <div class="d-flex flex-wrap" style="gap: 5px;">
                        @foreach(['Gratis', 'Berbayar'] as $option)
                            <label class="custom-checkbox">
                                <input type="checkbox" name="payment[]" value="{{ $option }}"
                                    {{ in_array($option, $selectedPayments) ? 'checked' : '' }}>
                                <div><span>{{ $option }}</span></div>
                            </label>
                        @endforeach

                        @foreach(['Online', 'Offline'] as $option_status)
                            <label class="custom-checkbox">
                                <input type="checkbox" name="status[]" value="{{ $option_status }}"
                                    {{ in_array($option_status, $selectedStatus) ? 'checked' : '' }}>
                                <div><span>{{ $option_status }}</span></div>
                            </label>
                        @endforeach
                    </div>
                </div>                    
            </div>
        </form>
    </div>
</div>
<!--archive header-->
<div class="archive-header text-center mt-20">
    <div class="container">
        <h2><span class="color2">INFO LOMBA</span></h2>
        <div class="breadcrumb">
            <a href="{{ route('home') }}" rel="nofollow">Beranda</a>
            <span></span> {{ $title }}
        </div>
        <div class="bt-1 border-color-1 mt-30 mb-50"></div>
    </div>
</div>
<!--main content-->
<div class="main_content sidebar_right pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <!--loop-list-->
                <div class="loop-grid row">
                    @forelse ($post as $item)                  
                    <article class="col-lg-6 mb-50 animate-conner">
                        <div class="post-thumb d-flex mb-30 border-radius-5 img-hover-scale animate-conner-box">
                            <a href="{{ route('contest-detail', $item->slug) }}">
                                <img src="{{ Storage::url($item->post_image) }}" alt="">
                            </a>
                        </div>
                        <div class="post-content">
                            <div class="entry-meta meta-0 font-small mb-15">
                                @php
                                    $sc = App\Models\CategoryContest::where('id', $item->sub_categories)->first();
                                @endphp
                                @if ($item->sub_categories != NULL)
                                    <a href="{{ route('contest-category', $sc->slug) }}">
                                        <span class="post-cat background1 color-white">
                                            {{ $sc->name; }}
                                        </span>
                                    </a>
                                @else
                                    <a href="{{ route('contest-category', $item->category->slug) }}">
                                        <span class="post-cat background1 color-white">
                                            {{ $item->category->name; }}
                                        </span>
                                    </a>
                                @endif
                            </div>
                            <h3 class="post-title">
                                <a href="{{ route('contest-detail', $item->slug) }}">{{ $item->post_title; }}</a>
                            </h3>
                            <div class="entry-meta meta-1 font-small color-grey mt-15 mb-15">
                                <span class="post-by">
                                    By <a href="{{ route('author', $item->user->id) }}">{{ splitName($item->user->name); }}</a>
                                </span>
                                <span class="post-on has-dot">{{ date('d F Y', strtotime($item->published_at));}}</span>
                            </div>
                            <div class="post-excerpt mb-25">
                                <p>
                                    {{ $item->post_teaser; }}
                                </p>
                            </div>
                        </div>
                    </article>
                    @empty
                    <div class="col-lg-12">
                        <div class="alert alert-danger" role="alert">
                            Data tidak tersedia
                        </div>
                    </div>
                    @endforelse
                </div>
                <!--pagination-->
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
                                                $start = $post->currentPage() - 1; // show 3 pagination links before current
                                                $end = $post->currentPage() + 1; // show 3 pagination links after current
                                                if($start < 1) {
                                                    $start = 1; // reset start to 1
                                                    $end += 1;
                                                } 
                                                if($end >= $post->lastPage() ) $end = $post->lastPage(); // reset end to last page
                                            ?>

                                            @if($start > 1)
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $post->url(1) }}">{{1}}</a>
                                                </li>
                                                @if($post->currentPage() != 4)
                                                    {{-- "Three Dots" Separator --}}
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
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 primary-sidebar sticky-sidebar">
                <div class="sidebar-widget widget-social-network mb-50">
                    <div class="widget-header position-relative mb-20 pb-10">
                        <h5 class="widget-title mb-10">Pengajuan Informasi</h5>
                        <div class="bt-1 border-color-1"></div>
                    </div>
                    <div class="social-network">
                        <div class="follow-us d-flex align-items-center">
                            <a class="follow-us-facebook clearfix mr-5 mb-10 w-100" href="{{ route('pengajuan-lomba') }}">
                                <div class="social-icon">
                                    <i class="ti-plus mr-5 v-align-space"></i>
                                    <i class="ti-plus mr-5 v-align-space nth-2"></i>
                                </div>
                                <span class="social-name">Buat Pengajuan</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="widget-area pl-30">
                    <!--Widget latest posts style 1-->
                    <div class="sidebar-widget widget_alitheme_lastpost mb-50">
                        <div class="widget-header position-relative mb-20 pb-10">
                            <h5 class="widget-title mb-10">Berita Terbaru</h5>
                            <div class="bt-1 border-color-1"></div>
                        </div>
                        <div class="post-block-list post-module-1">
                            <ul class="list-post">
                                @php
                                    $no=1;
                                @endphp
                                @foreach ($latest_post as $latest)                              
                                <li class="mb-30">
                                    <div class="d-flex">
                                        <div class="post-thumb d-flex mr-15 border-radius-5 img-hover-scale">
                                            <a href="{{ route('contest-detail', $latest->slug) }}">
                                                <img src="{{ Storage::url($latest->post_image) }}" alt="">
                                            </a>
                                        </div>
                                        <div class="post-content media-body">
                                            <div class="entry-meta meta-0 mb-10">
                                                @if ($latest->sub_categories != NULL)
                                                    <a href="{{ route('contest-category', $sc->slug) }}">
                                                        <span class="post-cat background1 color-white">
                                                            {{ $sc->name; }}
                                                        </span>
                                                    </a>
                                                @else
                                                    <a href="{{ route('contest-category', $latest->category->slug) }}">
                                                        <span class="post-cat background1 color-white">
                                                            {{ $latest->category->name; }}
                                                        </span>
                                                    </a>
                                                @endif
                                            </div>
                                            <h6 class="post-title mb-10 text-limit-2-row">
                                                {{ $latest->post_title; }}
                                            </h6>
                                            <div class="entry-meta meta-1 font-x-small color-grey">
                                                <span class="post-on">
                                                    {{ date('d F Y', strtotime($latest->published_at));}}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.1.1/dist/select2-bootstrap-5-theme.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=61acbda059afaf001ae4aa06&product=inline-share-buttons" async="async"></script>
<style>
    .custom-checkbox {
        display: inline-block;
        margin: 5px;
    }

    .custom-checkbox input[type="checkbox"] {
        display: none;
    }

    .custom-checkbox div {
        padding: 8px 16px;
        border: 2px solid #ccc;
        border-radius: 25px;
        cursor: pointer;
        transition: all 0.3s ease;
        background-color: #f9f9f9;
        color: #333;
    }

    .custom-checkbox input[type="checkbox"]:checked + div {
        background-color: #ef3f48;
        color: white;
        border-color: #ef3f48;
    }

    .custom-checkbox div:hover {
        background-color: #e6e6e6;
    }

    .select2-selection__rendered {
        line-height: 33px !important;
    }

    .select2-container .select2-selection--single {
        height: 47px !important;
    }
</style>

@endpush

@push('addon-script')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('body').addClass("open-search-form");
        $('button.search-icon').hide();
        $('.search-close').show();

        $('#location').select2({
            theme: "bootstrap-5",
            dropdownAutoWidth: true,
        });

        $('#categories_id').select2({
            theme: "bootstrap-5",
            dropdownAutoWidth: true,
        });
    });

    $(function() {
        var suggestions = [
            "olimpiade", "essay", "poster", "cerdas cermat",
            "puisi", "matematika", "international", "story"
        ];

        $("#keyword").autocomplete({
            source: suggestions,
            minLength: 0 
        }).on('focus', function () {
            $(this).autocomplete("search", "");
        });
    });
</script>
@endpush