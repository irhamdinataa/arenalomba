@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
<!--archive header-->
<div class="archive-header text-center mt-40">
    <div class="container">
        <h2><span class="color3">{{ $title }}</span></h2>
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
        <form action="{{ route('pengajuan-lomba-store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
        @csrf
        @method('POST')
            <div class="row">
                <div class="col-12">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show hide-alert" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show hide-alert" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header">Form Lomba</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="name">Nama Pengaju</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" placeholder="Tambahkan Nama.." required autofocus>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="post_title">Judul</label>
                                <input type="text" class="form-control @error('post_title') is-invalid @enderror" value="{{ old('post_title') }}" name="post_title" placeholder="Tambahkan Judul.." required>
                                @error('post_title')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="post_title">Teaser</label>
                                <textarea name="post_teaser" class="form-control" placeholder="Masukan Deskripsi Singkat"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="level">Tingkat</label>
                                <input type="text" class="form-control @error('level') is-invalid @enderror" value="{{ old('level') }}" name="level" placeholder="Kabupaten/Provinsi/Nasional/Internasional.." required>
                                @error('level')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="level">Peserta</label>
                                <div class="form-check">
                                    <input class="form-check-input" name="participant[]" type="checkbox" value="SD/Sederajat">
                                    <label class="form-check-label" for="">
                                        SD/Sederajat
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="participant[]" type="checkbox" value="SMP/Sederajat">
                                    <label class="form-check-label" for="">
                                        SMP/Sederajat
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="participant[]" type="checkbox" value="SMA/Sederajat">
                                    <label class="form-check-label" for="">
                                        SMA/Sederajat
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="participant[]" type="checkbox" value="Gapyear">
                                    <label class="form-check-label" for="">
                                        Gapyear
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="participant[]" type="checkbox" value="Mahasiswa">
                                    <label class="form-check-label" for="">
                                        Mahasiswa
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="participant[]" type="checkbox" value="Umum">
                                    <label class="form-check-label" for="">
                                        Umum
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="participant[]" type="checkbox" value="Guru">
                                    <label class="form-check-label" for="">
                                        Guru
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="post_title">Lokasi</label>
                                <select name="location" id="location" class="form-control cat" required>
                                    <option value="">Pilih Lokasi</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->name }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="level"><b>Tanggal Pendaftaran</b></label>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="start_date" class="form-label">Tanggal Mulai:</label>
                                    <input class="form-control" name="start_date" id="start_date" type="date"/>
                                </div>
                                <div class="col-md-6">
                                    <label for="end_date" class="form-label">Tanggal Akhir:</label>
                                    <input class="form-control" name="end_date" id="end_date" type="date"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="payment">Pembayaran</label>
                                <select name="payment" id="payment" class="form-control" oninput="checkPayment()" required>
                                    <option value="">Pilih Pembayaran</option>
                                    <option value="Gratis">Gratis</option>
                                    <option value="Berbayar">Berbayar</option>
                                </select>
                            </div>
                            <div class="mb-3" style="display: none;" id="show_payment">
                                <label for="level">Biaya Pendaftaran</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp.</div>
                                    </div>
                                    <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}" placeholder="0000000" required>
                                    @error('price')
                                        <div class="invalid-feedback">
                                            {{ $message; }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="organizer" class="form-label">Penyelenggara</label>
                                    <input type="text" class="form-control @error('organizer') is-invalid @enderror" value="{{ old('organizer') }}" name="organizer" placeholder="Masukan Nama Penyelenggara.." required>
                                    @error('organizer')
                                        <div class="invalid-feedback">
                                            {{ $message; }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="end_date" class="form-label">Status:</label>
                                    <select name="status" id="status" class="form-control w-100" required>
                                        <option value="">Pilih...</option>
                                        <option value="Online">Online</option>
                                        <option value="Offline">Offline</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message; }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-0">
                                <label for="exampleFormControlTextarea1">Konten</label>
                                <textarea class="form-control" name="post_content" id="full-featured"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-header-actions mb-4">
                        <div class="card-header">
                            Kategori
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="categories_id">Kategori</label>
                                <select class="form-control cat" id="category" name="categories_id" required>
                                    <option>Pilih..</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card card-header-actions mb-4">
                        <div class="card-header">
                            Thumbnail
                        </div>
                        <div class="card-body">
                            <img id="preview-img" src="/admin/assets/img/empty-image.jpg" class="img-fluid rounded mb-2" alt="Preview Image" style="height: 165px;">
                            <div class="mb-3">
                                <label for="post-image">Pilih Foto</label>
                                <input type="file" id="post-image" name="post_image" class="form-control" accept="image/*" required>
                                @error('post_image')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="post-image">Deskripsi Foto</label>
                                <textarea name="post_image_description" class="form-control @error('post_image_description') is-invalid @enderror" required></textarea>
                                @error('post_image_description')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card card-header-actions">
                        <div class="card-header">
                            Publish
                            <i class="text-muted" data-feather="info" data-bs-toggle="tooltip" data-bs-placement="left" title="Setelah mengirimkan, posting Anda akan ditinjau untuk dipublikasikan."></i>
                        </div>
                        <div class="card-body">
                            <div class="d-grid">
                                <input type="submit" name="publish" value="Buat Pengajuan" class="w-100 btn btn-primary">   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('addon-style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.1.1/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <script src="https://cdn.tiny.cloud/1/23hwlquvohkqizv4qhwxvjuskiuruw4x1kv3iipsqa73woc6/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
@endpush

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function checkPayment() {
            const showPayment = document.getElementById('show_payment');
            showPayment.style.display = document.getElementById('payment').value === 'Berbayar' ? 'block' : 'none';
        }

        function readURL(input) {
            if (!input.files?.[0]) return;
            
            const reader = new FileReader();
            reader.onload = (e) => $('#preview-img').attr('src', e.target.result);
            reader.readAsDataURL(input.files[0]);
        }

        $("#post-image").change((e) => readURL(e.target));

        $(".cat").select2({
            theme: "bootstrap-5"
        });

        tinymce.init({
            selector: 'textarea#full-featured',
            deprecation_warnings: false,
            plugins: 'print preview paste searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table custom help',
            toolbar1: 'undo redo | bold italic underline | formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | fullscreen  preview | link',
            toolbar2: 'custom_dialog',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            link_list: [
                { title: 'My page 1', value: 'https://www.tiny.cloud' },
                { title: 'My page 2', value: 'http://www.moxiecode.com' }
            ],
            image_list: [
                { title: 'My page 1', value: 'https://www.tiny.cloud' },
                { title: 'My page 2', value: 'http://www.moxiecode.com' }
            ],
            image_class_list: [
                { title: 'None', value: '' },
                { title: 'Some class', value: 'class-name' }
            ],
            importcss_append: true,
            file_picker_callback: function (callback, value, meta) {
                /* Provide file and text for the link dialog */
                if (meta.filetype === 'file') {
                    callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
                }

                /* Provide image and alt text for the image dialog */
                if (meta.filetype === 'image') {
                    callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
                }

                /* Provide alternative source and posted for the media dialog */
                if (meta.filetype === 'media') {
                    callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
                }
            },
            templates: [
                { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
                { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
                { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
            ],
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 950,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image imagetools table',
            skin: 'oxide',
            content_css: 'default',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });

        let price = document.getElementById('price');

        price.addEventListener('keyup', function(e){
            price.value = formatRupiah(this.value);
        });

        function formatRupiah(angka, prefix){
            let number_string = angka.replace(/[^,\d]/g, '').toString(),
                split    = number_string.split(','),
                sisa     = split[0].length % 3,
                rupiah     = split[0].substr(0, sisa),
                ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
                
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
@endpush