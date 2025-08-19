@extends('pages.dashboardlayanan')
@section('head')

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
                                <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Layanan Aduan Mahasiswa</span>
                                </h5>
                                <ol class="breadcrumbs mb-0">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('dashboardlayanan')}}">Layanan</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('helpdesk.aduan')}}">Aduan
                                            Mahasiswa</a></li>
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
                                <p><strong>Jenis Ajuan @if(!empty($sql))
                                            {{$sql[0]->keterangan}}
                                        @endif {{config('app.upbjj')}}</strong></p>
                            </div>
                            <form role="form" method="get" action="{{ route('helpdesk.aduan') }}" id="form">
                                @csrf
                                <div class="row">
                                    <br>
                                    @if(!empty($jenisaduan))
                                        <div class="col s12 m6 l6" id="st">
                                            <label for="jenis"> Jenis Aduan</label>
                                            <select class="select2 browser-default" name="jenis" id="jenis">
                                                <option value="" disabled selected></option>
                                                @if (!empty($jenisaduan))
                                                    @foreach ($jenisaduan as $items)
                                                        @if($items->id_jenis!= 1)
                                                            <option @if(!empty($jenis))
                                                                    @if($items->id_jenis == $jenis) selected@endif
                                                                    @endif
                                                                    @endif value="{{$items->id_jenis}}"> {{$items->keterangan}}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    @endif
                                    <div class="col s12 m6 l6" id="st">

                                        <label for="status">Status Aduan</label>
                                        <select class="select2 browser-default" name="status" id="status">
                                            <option value="" disabled selected></option>
                                            @if (!empty($statusaduan))
                                                @foreach ($statusaduan as $items)
                                                    <option
                                                        @if(!empty($status)) @if($items->nama_status == $status) selected
                                                        @endif @endif value="{{$items->nama_status}}"> {{ucwords($items->nama_status)}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col s6 m2 l2" id="akhir">
                                        <button
                                            class="waves-effect waves-light btn gradient-45deg-purple-deep-orange box-shadow-none border-round mr-1 mb-1"
                                            type="submit">
                                            Cari Data
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($jenis))
                @if($jenis == 1)
                    @include('pages.layanan.mahasiswa.DTLayananKTM')
                @elseif($jenis == 2)
                    @include('pages.layanan.mahasiswa.DTLayananWifiID')
                @else
                    @include('pages.layanan.mahasiswa.DTLayananUMUM')
                @endif
            @endif
        </div>
    </div>
    <!-- Modal Structure -->
    <div id="modal1" class="modal">
        <form role="form" method="GET" action="{{route('mahasiswa.aduanumum.simpan')}}" id="form">
            @csrf
            <div class="modal-content">
                <h6>Deskripsi Layanan</h6>
                <hr>
                <br>
                <div class="row">
                    <div class="col s3">
                        <label> NIM
                            <input type="text" name="nim" id="nim" maxlength="9" readonly>
                            <input type="hidden" name="mid" id="mid">
                        </label>
                    </div>
                    <div class="col s9">
                        <label> Nama Mahasiswa
                            <input type="text" name="nama" id="nama" maxlength="9" readonly>
                        </label>
                    </div>
                    <div class="col s12">
                        <label for="mkeluhan"> Informasi Layanan
                            <textarea id="mkeluhan" name="mkeluhan" rows="4" cols="50" class="materialize-textarea"
                                      readonly></textarea>
                        </label>
                    </div>
                    <div class="col s12">
                        <div class="id_1">

                            <label for="mkl_status"> Ubah Status
                                <select name="mkl_status" id="mkl_status">
                                    @if (!empty($statusaduan))
                                        @foreach ($statusaduan as $rows)
                                            <option value="{{$rows->nama_status}}">{{ucwords($rows->nama_status)}}</option>
                                        @endforeach

                                    @endif
                                </select>
                            </label>
                        </div>
                    </div>

                    <div class="col s12">
                        <label for="mjawaban"> Jawaban
                            <textarea id="mjawaban" name="mjawaban" rows="4" cols="50"
                                      class="materialize-textarea"></textarea>
                        </label>
                    </div>
                </div>
                <p></p>
                <button class="waves-effect waves-light btn gradient-45deg-green-teal z-depth-4 mr-1 mb-2 right">Simpan
                </button>

            </div>

        </form>
    </div>
@endsection
@section('script')
    <script src="../../../app-assets/js/scripts/data-tables.js"></script>
    <script src="../../../app-assets/js/jquery.maskedinput.js"></script>
    <script src="{{asset('app-assets/js/scripts/advance-ui-modals.js')}}"></script>
    <script type="text/javascript">

        jQuery(function ($) {
            $("#tanggal_awal").mask("9999-99-99", {placeholder: "____-__-__"});
            $("#tanggal_akhir").mask("9999-99-99", {placeholder: "____-__-__"});
        });


        function edit(id) {
            $.ajax({
                type: "GET",
                dataType: 'JSON',
                url: "{{ route('mahasiswa.getjenisaduanbyid') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                },
                success: function (data) {
                    $("#mkeluhan").val(data[0].keluhan);
                    $("#mjawaban").val(data[0].keterangan);
                    $("#nim").val(data[0].nim);
                    $("#nama").val(data[0].nama_mahasiswa);
                    $("#mid").val(data[0].id);

                    // $('.id_1 option[value=selesai]').attr('selected', 'selected');
                    // $("div.id_1 select").val("selesai");
                    // $("div.id_1").val("selesai").change();
                    // $('id_1 option[value=selesai]').attr('selected','selected');
                    // $("select#mkl_status").val('selesai').change();
                    // $("#modal1 #mkl_status").val('selesai').change();
                    // $("#modal1 #mkl_status option[value="+data[0].status+"]").attr('selected', 'selected');
                    // $('#mkl_status option[value="selesai"]').attr("selected", "selected");
                    // $('#modal1 #mkl_status').val($(this).attr('selesai'));
                }
            });
        }
    </script>
@endsection
