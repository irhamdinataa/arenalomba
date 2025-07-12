@extends('layouts.admin')

@section('title')
    Dashboard
@endsection

@section('container')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="activity"></i></div>
                                Dashboard
                            </h1>
                            <div class="page-header-subtitle">Administrator Panel</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
            <div class="row">
                <div class="col-xxl-4 col-xl-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body h-100 p-5">
                            <div class="row align-items-center">
                                <div class="col-xl-8 col-xxl-12">
                                    <div class="text-center text-xl-start text-xxl-center mb-4 mb-xl-0 mb-xxl-4">
                                        <h1 class="text-primary">Selamat Datang di Website {{ $app->name }} !</h1>
                                        <p class="text-gray-700 mb-0">{{ $app->title }} </p>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-xxl-12 text-center"><img class="img-fluid" src="/admin/assets/img/illustrations/at-work.svg" style="max-width: 26rem" /></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Example Colored Cards for Dashboard Demo-->
            @if (Auth::user()->roles == 'Administrator')
            <div class="row">
                <div class="col-lg-6 col-xl-3 mb-4">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-75 small">Semua Artikel</div>
                                    <div class="text-lg fw-bold">{{ number_format($all_post,0,",",".") }}</div>
                                </div>
                                <i class="feather-xl text-white-50" data-feather="file-text"></i>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between small">
                            <a class="text-white stretched-link" href="{{ route('post.index') }}">Selengkapnya</a>
                            <div class="text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3 mb-4">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-75 small">Artikel (Published)</div>
                                    <div class="text-lg fw-bold">{{ number_format($published,0,",",".") }}</div>
                                </div>
                                <i class="feather-xl text-white-50" data-feather="check"></i>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between small">
                            <a class="text-white stretched-link" href="{{ route('post-published') }}">Selengkapnya</a>
                            <div class="text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3 mb-4">
                    <div class="card bg-warning text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-75 small">Artikel (Draft)</div>
                                    <div class="text-lg fw-bold">{{ number_format($draft,0,",",".") }}</div>
                                </div>
                                <i class="feather-xl text-white-50" data-feather="file"></i>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between small">
                            <a class="text-white stretched-link" href="{{ route('post-draft') }}">Selengkapnya</a>
                            <div class="text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3 mb-4">
                    <div class="card bg-danger text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-75 small">Artikel (Sampah)</div>
                                    <div class="text-lg fw-bold">{{ number_format($trash,0,",",".") }}</div>
                                </div>
                                <i class="feather-xl text-white-50" data-feather="trash"></i>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between small">
                            <a class="text-white stretched-link" href="{{ route('post-trash') }}">Selengkapnya</a>
                            <div class="text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-xl-3 mb-4">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-75 small">Semua Lomba</div>
                                    <div class="text-lg fw-bold">{{ number_format($all_contest,0,",",".") }}</div>
                                </div>
                                <i class="feather-xl text-white-50" data-feather="monitor"></i>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between small">
                            <a class="text-white stretched-link" href="{{ route('contest.index') }}">Selengkapnya</a>
                            <div class="text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3 mb-4">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-75 small">Lomba (Published)</div>
                                    <div class="text-lg fw-bold">{{ number_format($published_contest,0,",",".") }}</div>
                                </div>
                                <i class="feather-xl text-white-50" data-feather="check"></i>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between small">
                            <a class="text-white stretched-link" href="{{ route('contest-published') }}">Selengkapnya</a>
                            <div class="text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3 mb-4">
                    <div class="card bg-warning text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-75 small">Lomba (Draft)</div>
                                    <div class="text-lg fw-bold">{{ number_format($draft_contest,0,",",".") }}</div>
                                </div>
                                <i class="feather-xl text-white-50" data-feather="file"></i>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between small">
                            <a class="text-white stretched-link" href="{{ route('contest-draft') }}">Selengkapnya</a>
                            <div class="text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3 mb-4">
                    <div class="card bg-danger text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-75 small">Lomba (Sampah)</div>
                                    <div class="text-lg fw-bold">{{ number_format($trash_contest,0,",",".") }}</div>
                                </div>
                                <i class="feather-xl text-white-50" data-feather="trash"></i>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between small">
                            <a class="text-white stretched-link" href="{{ route('contest-trash') }}">Selengkapnya</a>
                            <div class="text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-xl-3 mb-4">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-75 small">Semua Kelas</div>
                                    <div class="text-lg fw-bold">{{ number_format($all_course,0,",",".") }}</div>
                                </div>
                                <i class="feather-xl text-white-50" data-feather="layers"></i>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between small">
                            <a class="text-white stretched-link" href="{{ route('course.index') }}">Selengkapnya</a>
                            <div class="text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3 mb-4">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-75 small">Kelas (Published)</div>
                                    <div class="text-lg fw-bold">{{ number_format($published_course,0,",",".") }}</div>
                                </div>
                                <i class="feather-xl text-white-50" data-feather="check"></i>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between small">
                            <a class="text-white stretched-link" href="{{ route('course-published') }}">Selengkapnya</a>
                            <div class="text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3 mb-4">
                    <div class="card bg-warning text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-75 small">Kelas (Draft)</div>
                                    <div class="text-lg fw-bold">{{ number_format($draft_course,0,",",".") }}</div>
                                </div>
                                <i class="feather-xl text-white-50" data-feather="file"></i>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between small">
                            <a class="text-white stretched-link" href="{{ route('contest-draft') }}">Selengkapnya</a>
                            <div class="text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3 mb-4">
                    <div class="card bg-danger text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-75 small">Kelas (Sampah)</div>
                                    <div class="text-lg fw-bold">{{ number_format($trash_course,0,",",".") }}</div>
                                </div>
                                <i class="feather-xl text-white-50" data-feather="trash"></i>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between small">
                            <a class="text-white stretched-link" href="{{ route('course-trash') }}">Selengkapnya</a>
                            <div class="text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-xl-3 mb-4">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-75 small">Semua Video</div>
                                    <div class="text-lg fw-bold">{{ number_format($all_video,0,",",".") }}</div>
                                </div>
                                <i class="feather-xl text-white-50" data-feather="film"></i>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between small">
                            <a class="text-white stretched-link" href="{{ route('video.index') }}">Selengkapnya</a>
                            <div class="text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3 mb-4">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-75 small">Video (Published)</div>
                                    <div class="text-lg fw-bold">{{ number_format($published_video,0,",",".") }}</div>
                                </div>
                                <i class="feather-xl text-white-50" data-feather="check"></i>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between small">
                            <a class="text-white stretched-link" href="{{ route('video-published') }}">Selengkapnya</a>
                            <div class="text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3 mb-4">
                    <div class="card bg-warning text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-75 small">Video (Draft)</div>
                                    <div class="text-lg fw-bold">{{ number_format($draft_video,0,",",".") }}</div>
                                </div>
                                <i class="feather-xl text-white-50" data-feather="file"></i>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between small">
                            <a class="text-white stretched-link" href="{{ route('video-draft') }}">Selengkapnya</a>
                            <div class="text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3 mb-4">
                    <div class="card bg-danger text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-75 small">Video (Sampah)</div>
                                    <div class="text-lg fw-bold">{{ number_format($trash_video,0,",",".") }}</div>
                                </div>
                                <i class="feather-xl text-white-50" data-feather="trash"></i>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between small">
                            <a class="text-white stretched-link" href="{{ route('video-trash') }}">Selengkapnya</a>
                            <div class="text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-lg-6 col-xl-6 mb-4">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-75 small">Artikel (Draft)</div>
                                    <div class="text-lg fw-bold">{{ $draft }}</div>
                                </div>
                                <i class="feather-xl text-white-50" data-feather="file-text"></i>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between small">
                            <a class="text-white stretched-link" href="{{ route('post.index') }}">Selengkapnya</a>
                            <div class="text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-6 mb-4">
                    <div class="card bg-warning text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-75 small">Artikel (Published)</div>
                                    <div class="text-lg fw-bold">{{ $published }}</div>
                                </div>
                                <i class="feather-xl text-white-50" data-feather="file-text"></i>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between small">
                            <a class="text-white stretched-link" href="{{ route('post.index') }}">Selengkapnya</a>
                            <div class="text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>    
            @endif
        </div>
    </main>
@endsection