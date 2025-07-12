@extends('layouts.admin')

@section('title')
    Lomba
@endsection

@section('container')
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-xl px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="monitor"></i></div>
                                Pengajuan
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-4">
            <!-- Account page navigation-->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-header-actions mb-4">
                        <div class="card-header">
                            List Pengajuan Lomba
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
          { data: 'name', name: 'name' },
          { data: 'category.name', name: 'category.name' },
          { data: 'published_at', name: 'published_at', className: 'text-center' },
          { data: 'is_approve', name: 'is_approve', className: 'text-center' },
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


