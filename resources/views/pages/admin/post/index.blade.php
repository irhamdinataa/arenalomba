@extends('layouts.admin')

@section('title')
    Artikel
@endsection

@section('container')
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-xl px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="file-text"></i></div>
                                Artikel - 
                                @if (request()->is('admin/pos/post'))
                                    Semua Artikel
                                @elseif (request()->is('admin/pos/published'))
                                    Published
                                @elseif (request()->is('admin/pos/draft'))
                                    Draft
                                @elseif (request()->is('admin/pos/trash'))
                                    Sampah
                                @endif
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-4">
            <!-- Account page navigation-->
            <nav class="nav nav-borders">
                <a class="nav-link {{ (request()->is('admin/pos/post')) ? 'active ms-0' : '' }}" href="{{ route('post.index') }}">Semua ({{ $all }})</a>
                <a class="nav-link {{ (request()->is('admin/pos/published')) ? 'active ms-0' : '' }}" href="{{ route('post-published') }}">Published ({{ $published }})</a>
                <a class="nav-link {{ (request()->is('admin/pos/draft')) ? 'active ms-0' : '' }}" href="{{ route('post-draft') }}">Draft ({{ $draft }})</a>
                @if (Auth::user()->roles == 'Administrator')
                    <a class="nav-link {{ (request()->is('admin/pos/trash')) ? 'active ms-0' : '' }}" href="{{ route('post-trash') }}">Sampah ({{ $trash }})</a>
                @endif
            </nav>
            <hr class="mt-0 mb-4" />
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-header-actions mb-4">
                        <div class="card-header">
                            List Artikel
                            @if (Auth::user()->roles == 'Administrator' || Auth::user()->roles == 'Penulis')
                                <a class="btn btn-sm btn-primary" href="{{ route('post.create') }}">
                                    <i data-feather="plus"></i> &nbsp; Tambah Artikel Baru
                                </a>
                            @endif
                        </div>
                        <div class="card-body">
                            {{-- Alert --}}
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show hide-alert" role="alert">
                                    {{ session('success') }}
                                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show hide-alert" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            {{-- List Data --}}
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-sm" id="crudTable">
                                    <thead>
                                        <tr>
                                            <th width="10" class="text-center">No.</th>
                                            <th>Judul</th>
                                            <th>Penulis</th>
                                            <th>Kategori</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>           
        </div>
    </main>
@endsection

@push('addon-script')
  <script>
    var datatable = $('#crudTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
          url: '{!! url()->current() !!}',
        },
        columns: [
          {
            "data": 'DT_RowIndex',
            orderable: false, 
            searchable: false,
            className: 'text-center'
          },
          { data: 'post_title', name: 'post_title' },
          { data: 'user.name', name: 'user.name' },
          { data: 'category.name', name: 'category.name' },
          { data: 'published_at', name: 'published_at', className: 'text-center' },
          { data: 'post_status', name: 'post_status', className: 'text-center' },
          { 
            data: 'action', 
            name: 'action',
            orderable: false,
            searcable: false,
            width: '15%',
            className: 'text-center'
          },
        ]
    });
  </script>
@endpush


