@extends('pages.dashboardmahasiswa')
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

@section('content')
    <div id="main">
        <div class="row">
            <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
            <div class="breadcrumbs-dark pb-0 pt-2" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0">
                                <span>Layanan Mahasiswa {{config('app.upbjj')}}</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('mahasiswa.dashboard')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="">Mahasiswa</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('panels.bannerinfo')
        @if(!empty($DPMahasiswa))
            @include('pages.layanan.mahasiswa.mahasiswa_menu_atas')
        @endif
        @if(!empty($pesan))
            <div class="col s12">
                <div class="container">
                    <div class="col s12 m12 l12">
                        <div class="card-alert card gradient-45deg-red-pink ">
                            <div class="card-content white-text">
                                <p style="text-align:center">
                                    <i class="material-icons">check </i> {{$pesan}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="col s12 ">
            <div class="container">

                @if(empty($DPMahasiswa))
                    <div class="col s12">
                        <div id="Form-advance" class="card card card-default scrollspy">
                            <div class="card-content">
                                <h4 class="card-title">Layanan Mahasiswa {{config('app.upbjj')}}</h4>
                                <form role="form" method="GET" action="{{ route('mahasiswa.layanan') }}" id="form">
                                    @csrf
                                    <div class="row">
                                        <div class="input-field col s12 m3 l3">
                                            <input type="text" id="nim" name="nim" maxlength="9" class="angka">
                                            <span class="error" style="color: red; display: none">* Masukkan angka (0 - 9)</span>
                                            <label for="nim">NIM</label>
                                        </div>
                                                                                <div class="input-field col s12 m3 l3">
                                                                                    <input type="text" name="tgl_lahir" id="tgl_lahir" required="required">
                                                                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                                                                </div>
                                        <div class="input-field col m3 s12">
                                            <label>Captcha</label>
                                            <input placeholder="" name="captcha" id="captcha" type="text" required>
                                            {{--                                            <span><small>masukkan hasil penjumlahan </small></span>--}}
                                            @if ($errors->has('captcha'))
                                                {{--                                                <br>--}}
                                                <span> <strong>{{ $errors->first('captcha') }}</strong></span>
                                            @endif
                                        </div>

                                        <div class="col m4 s12">
                                            <div id="captcha">
                                                <span> <?= captcha_img(); ?></span>
                                                <button type="button"
                                                        class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange"
                                                        id="recaptcha">
                                                    <i class="material-icons">refresh</i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <button class="btn cyan waves-effect waves-light left" type="submit"
                                                    name="action">
                                                Masuk
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
                @if(!empty($DPMahasiswa))
                    <div class="row">
                        <div class="col s12">
                            @include('pages.srs.data_pribadi')
                        </div>
                        <div class="col s12">
                            <div id="basic-form" class="card card card-default scrollspy">
                                <div class="card-content">
                                    <div class="row">
                                        <h4 class="card-title">Data Permohonan Layanan</h4>
                                        <br>
                                        <br>
                                        <div id="view-select">
                                            <form role="form" method="POST"
                                                  action="{{route('mahasiswa.layanan.simpan')}}" id="form">
                                                @csrf
                                                <input type="hidden" name="nim" id="nim"
                                                       value="{{Crypt::encrypt($DPMahasiswa['nim'])}}">
                                                <div class="input-field col s12 m6 l6">
                                                    <p class="font-bold">Nomor Handphone</p>
                                                    <label for="nomor_handphone"></label>
                                                    <input type="text" class="angka" name="nomor_handphone"
                                                           id="nomor_handphone"

                                                           required>
                                                    <span
                                                        style="font-size: x-small">Contoh penulisan nomor 08123456789</span><br>
                                                    <span class="error"
                                                          style="color: red; display: none ;font-size: x-small">* Masukkan angka (0 - 9)</span>
                                                </div>
                                                <div class="input-field col s12 m6 l6">
                                                    <p class="font-bold">Email</p>
                                                    <label for="email"></label>
                                                    <input type="email" name="email" id="email"
                                                           value="{{$DPMahasiswa['nim'] . '@ecampus.ut.ac.id'}}"
                                                           readonly>
                                                </div>

                                                <div class="input-field col s12 ">
                                                    <p class="font-bold">Pilih Layanan yang diinginkan</p>
                                                    {{--                                                                <label for="jenis_surat">Pilih Layanan yang diinginkan</label>--}}
                                                    <select name="jenis_surat" id="jenis_surat" required>
                                                        {{--                                                                    <option value="" disabled selected></option>--}}
                                                        @if (!empty($jenisLayanan))
                                                            @foreach ($jenisLayanan as $data)
                                                                <option
                                                                    value="{{$data['id_jenis']}}"> {{$data['keterangan']}} </option>
                                                            @endforeach
                                                        @endif
                                                    </select>

                                                </div>

                                                <div class="input-field col s12" id="ket">
                                                                <textarea id="txtketerangan" name="txtketerangan"
                                                                          class="materialize-textarea"></textarea>
                                                    <label for="txtketerangan">Keterangan</label>
                                                    <span id="response"></span>
                                                </div>

                                                <br>
                                                <div class="col s12">
                                                    <button class="btn btn-w-m btn-light-green right"
                                                            type="submit">
                                                        Ajukan Permohonan
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @include('pages.layanan.mahasiswa.DTLayananMahasiswaAjuan')
            </div>
        </div>
    </div>
    <div id="modal" class="modal">
        <div class="modal-body">
            <div class="img-container">
                <div class="row">
                    <div class="col s12 m8 l8">
                        <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                        @if(!empty($DPMahasiswa))
                            <input type="hidden" name="id" id="id" value="{{$DPMahasiswa['nim']}}">
                        @endif
                    </div>
                    <div class="col s12 m4 l4">
                        <div class="preview"></div>
                        <a href="#!"
                           class="modal-action modal-close waves-effect waves-red btn btn-secondary"
                           data-dismiss="modal">Batal</a>
                        <button type="button" class="btn btn-primary modal-action modal-close"
                                id="crop">Crop
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{'../../../app-assets/js/scripts/data-tables.js'}}"></script>
    <script src="{{'../../../app-assets/js/jquery.maskedinput.js'}}"></script>
    <script src="{{'../../../app-assets/js/scripts/advance-ui-modals.js'}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"
            integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY="
            crossorigin="anonymous"></script>
    <script type="text/javascript">
        $("#recaptcha").click(function () {
            $.ajax({
                type: "GET",
                url: "{{ route('refresh.captcha') }}",
                success: function (data) {
                    $("#captcha span").html(data.captcha);
                }
            });
        });
        $(document).ready(function () {
            $('textarea').keypress(function (event) {

                if (event.keyCode == 13) {
                    event.preventDefault();
                }
            });
            $(".angka").bind("keypress", function (e) {
                var keyCode = e.which ? e.which : e.keyCode
                if (!(keyCode >= 48 && keyCode <= 57)) {
                    $(".error").css("display", "inline");
                    return false;
                } else {
                    $(".error").css("display", "none");
                }
            });
        });
        $("#tgl_lahir").mask("99/99/9999", {placeholder: "__/__/____"});

        var $modal = $('#modal');
        var image = document.getElementById('image');
        var cropper;


        $("body").on("change", ".image", function (e) {
            var files = e.target.files;
            var done = function (url) {
                image.src = url;
                $modal.modal('open');
            };
            var reader;
            var file;
            var url;
            if (files && files.length > 0) {
                file = files[0];
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
        var nim = document.getElementById(nim);
        $("#crop").click(function () {
            canvas = cropper.getCroppedCanvas({
                width: 354,
                height: 472,
            });
            $;
            canvas.toBlob(function (blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function () {
                    var base64data = reader.result;
                    var nim = $('#id').val();
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "mahasiswa/upload",
                        data: {_token: "{{ csrf_token() }}", 'image': base64data, nim: nim},
                        success: function (data) {
                            $modal.modal('close');
                        }
                    });
                }
            });
        })

        $('#ket').hide();
        $("#jenis_surat").change(function () {
            var id = $("#jenis_surat").val();
            if (id == 4 || id == 5 || id == 6) {
                $('#ket').show();
                $('#ket').val("");
                $("#jenis_surat").focus();

            } else {
                $('#ket').hide();
            }
            $.ajax({
                type: "GET",
                dataType: 'JSON',
                url: "{{ route('mahasiswa.getjenislayananbyid') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                },
                success: function (data) {
                    $("#response").text(data[0].informasi);
                }
            });
        });
    </script>
@endsection
