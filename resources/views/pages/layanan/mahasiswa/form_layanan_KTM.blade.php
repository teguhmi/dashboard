@extends('pages.dashboardlayanan')
@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"
          integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous"/>
@endsection
@section('css')
    <style type="text/css">
        img {
            display: block;
            max-width: 100%;
        }

        .preview {
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }

        .image {
            max-width: 1000px !important;
            /*width: 100%;*/
            /*max-height: 100%;*/
            /*height: 100%;*/
        }

    </style>
@endsection
<!-- Form with validation -->

@section('content')
    <div id="main">
        <div class="row">
            <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
            <div class="breadcrumbs-dark pb-0 pt-2" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="col s12 m12 l12">
                    <div class="container">
                        <div class="row">
                            <div class="col s10 m6 l6">
                                <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Pelayanan Administrasi Akademik</span></h5>
                                <ol class="breadcrumbs mb-0">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('dashboardlayanan')}}">Layanan</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('layanan.laporan')}}">Laporan - Peragaan Data Layanan</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <div id="report" class="card card-tabs">
                        <div class="card-content">
                            <div class="card-title">
                                <p><strong>Data Permohonan @if(!empty($jenis)){{$jenis}} @endif {{config('app.upbjj')}}</strong></p>
                            </div>
                            <form role="form" method="get" action="{{ route('layanan.ktm') }}" id="form">
                                @csrf
                                <div class="row">
                                    <br>
                                    <div class="col s12 m12 l12" id="st">
                                        <input type="hidden" value="ktm" name="jenis">
                                        <label for="status"></label>
                                        <select class="select2 browser-default" name="status" id="status">
                                            <option value="baru">Baru</option>
                                            <option value="proses">Proses</option>
                                            <option value="selesai">Selesai</option>
                                            <option value="diambil">Sudah diambil</option>
                                            <option value="gagal">Gagal Validasi Foto</option>
                                        </select>
                                    </div>
                                    {{--                                        <div class="col s6 m2" id="awal" hidden>--}}
                                    {{--                                            <input id="tanggal_awal" name="tanggal_awal" type="text">--}}
                                    {{--                                            <label for="tanggal_akhir">Tanggal Awal</label>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="col s6 m2 l2" id="akhir" hidden>--}}
                                    {{--                                            <input id="tanggal_akhir" name="tanggal_akhir" type="text">--}}
                                    {{--                                            <label for="tanggal_akhir">Tanggal Akhir</label>--}}
                                    {{--                                        </div>--}}

                                </div>
                                <br>
                                <div class="row">
                                    <div class="col s6 m2 l2" id="akhir">
                                        <button class="waves-effect waves-light btn gradient-45deg-purple-deep-orange box-shadow-none border-round mr-1 mb-1" type="submit">
                                            Cari Data
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @if(!empty($sql))
                    <div class="col s12">
                        <div class="section section-data-tables">
                            <div id="button-trigger" class="card card card-default scrollspy">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col col s6 m6 l6">
                                            <h4 class="card-title">Proses Layanan KTM</h4>
                                        </div>
                                        @if($sql[0]->status <> 'baru')
                                            <div class="col col s6 m6 l6">
                                                <a class="btn waves-effect waves-light gradient-45deg-green-teal gradient-shadow btn-small right" style="font-size: small" onclick="return confirm('Download File?');"
                                                   href="{{route('layanan.ktm.unduh',['id'=>Crypt::encrypt($sql[0]->status)])}}">Unduh Foto
                                                </a>
                                            </div>
                                        @endif
                                        <br>
                                        <br>
                                        <br>
                                        <div class="col s12">
                                            <table id="page-length-option" class="display">
                                                <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>NIM</th>
                                                    <th>Nama Mahasiswa</th>
                                                    <th>Nomor HP</th>
                                                    <th>Email</th>
                                                    <th>Foto</th>
                                                    <th>Opsi</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach($sql as $data)
                                                    <tr>
                                                        <td>{{$no++}}</td>
                                                        <td id="dtnim">{{$data->nim}}</td>
                                                        <td>{{$data->nama_mahasiswa}}</td>
                                                        <td>{{$data->handphone}}</td>
                                                        <td>{{$data->email}}</td>

                                                        <td>
                                                            @if (file_exists(public_path('storage/foto/' . $data->nim . '/'. $data->nim . '_ktm.jpg')))
                                                                <div class="foto">
                                                                    <a class="foto-ktm modal-trigger" data-toggle="modal" href="#modal" onclick="edit('{{$data->nim}}')">
                                                                        <img style="height:2.79cm; width: 2.16cm; object-fit: contain;" class="image"
                                                                             src="{{secure_url('/storage/foto/' . $data->nim . '/'. $data->nim . '_ktm.jpg' . '?t=' . time())}}" alt=""/>
                                                                    </a>

                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($data->status == 'baru')
                                                                <div class="row">
                                                                    <a class="waves-effect gradient-45deg-indigo-light-blue btn btn-small" onclick="return confirm('File Foto {{$data->nama_mahasiswa}} Telah Sesuai?');"
                                                                       href=" {{route('layanan.ktm.validasi',['id'=>Crypt::encrypt($data->id),'jenis'=>'valid'] )}}">Foto Sesuai
                                                                    </a>
                                                                    <a class="btn waves-effect waves-light purple lighten-1 gradient-shadow btn-small"
                                                                       href=" {{route('layanan.ktm.validasi',['id'=>Crypt::encrypt($data->id),'jenis'=>'bs'] )}}" onclick="return confirm('Foto {{$data->nama_mahasiswa}} Belum Sesuai?');">Foto Belum Sesuai
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div id="modal" class="modal">
                <div class="modal-body">
                    <div class="img-container">
                        <div class="col s12">
                            <div class="row">
                                <div class="col s12 m8 l8">
                                    <img id="image" src="https://avatars0.githubusercontent.com/u/3456749" alt="">
                                    <input type="hidden" name="id" id="id">
                                </div>
                                <div class="col s12 m4 l4">
                                    <div class="preview"></div>
                                    <table>
                                        <tr>
                                            <td>
                                                <strong>Ketentuan Foto : </strong><br>
                                                <ol style="font-size: smaller">
                                                    <li> Sesuaikan gambar pada kotak yang tersedia dengan menggeser gambar sesuai kotak yang tersedia.</li>
                                                    <li> Perbesar/perkecil gambar dengan menggunakan scroll pada mouse atau dengan gerakan mencubit (menyapukan jempol dan jari telunjuk) ke arah luar/dalam</li>
                                                    <li>Berikan jarak batas atas, kiri, dan kanan secara proporsional.</li>

                                                </ol>
                                            </td>
                                        </tr>
                                    </table>
                                    <div>
                                        <a href="#!" class="modal-action modal-close waves-effect waves-red btn btn-secondary"
                                           data-dismiss="modal">Batal</a>
                                        <button type="button" class="btn btn-primary modal-action modal-close" id="crop">Crop
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Trigger -->

        </div>
    </div>
    <!-- Modal Structure -->

@endsection
@section('script')
    <script src="../../../app-assets/js/scripts/data-tables.js"></script>
    <script src="../../../app-assets/js/jquery.maskedinput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"
            integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $('input[type="radio"]').click(function () {
            var inputValue = $(this).attr("value");
            if (inputValue === "tanggal") {
                $("#awal").show();
                $("#akhir").show();
                $("#st").hide();

            } else {
                $("#awal").hide();
                $("#akhir").hide();
                $("#st").show();
            }
        });
        jQuery(function ($) {
            $("#tanggal_awal").mask("9999-99-99", {placeholder: "____-__-__"});
            $("#tanggal_akhir").mask("9999-99-99", {placeholder: "____-__-__"});
        });

        function edit(nim) {
            $('#id').val(nim);
        }

        var $modal = $('#modal');
        var image = document.getElementById('image');
        var cropper;

        $('.foto a').click(function (e) {
            var imgPath = $(this).find(".image").attr("src");
            $("#image").attr("src", imgPath);
            var files = e.target.files;
            var done = function (url) {
                image.src = url;
                $modal.modal('open');
            };
            var reader;
            var file;
            var url;
            if (files && files.length > 0) {
                file = files;
                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        jQuery(function ($) {
            $modal.modal({
                onOpenEnd: function () {
                    cropper = new Cropper(image, {
                        preview: '.preview',
                        dragMode: 'move',
                        autoCropArea: 1,
                        guides: true,
                        background: false,
                        cropBoxMovable: false,
                        cropBoxResizable: false,
                        toggleDragModeOnDblclick: false,
                        imageSmoothingEnabled: true,
                        imageSmoothingQuality: 'high',
                        ready: function () {
                            cropper.setCropBoxData({
                                width: 354,
                                height: 472,
                            });
                            cropper.getCroppedCanvas({
                                Width: 354,
                                Height: 472,
                                // maxWidth: 4096,
                                // maxHeight: 4096,
                            });
                        },
                    });
                },
                onCloseEnd: function () {
                    cropper.destroy();
                    cropper = null;
                },
            });
        });
        $("#crop").click(function () {
            var id = $('#id').val();
            canvas = cropper.getCroppedCanvas({
                width: 354,
                height: 472,
            });
            $
            canvas.toBlob(function (blob) {
                // url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function () {
                    var base64data = reader.result;
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{route('mahasiswa.upload')}}",
                        data: {_token: "{{ csrf_token() }}", 'image': base64data, nim: id},
                        success: function (data) {
                            $modal.modal('close');
                        }
                    });
                }
            });
        });
        $(document).ajaxStop(function () {
            window.location.reload();
        });
    </script>
@endsection
