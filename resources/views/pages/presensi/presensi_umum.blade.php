@extends('pages.dashboardpresensi')
@section('head')
@endsection
<!-- Form with validation -->
@section('content')
    <div id="main">
        <div class="row">
            <div class="breadcrumbs-inline pt-3 pb-1" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6 breadcrumbs-left">
                            <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Daftar hadir Kegiatan</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('presensi.umum')}}">Presensi Umum</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            @include('panels.bannerinfo')
            @if ($open == 0)
                <div class="col s12">
                    <div class="container">
                        <div class="col s12 m12 l12">
                            <div class="card-alert card gradient-45deg-green-teal">
                                <div class="card-content white-text">
                                    <p style="text-align:center">
                                        <i class="material-icons">check</i> Belum ada kegiatan yang dibuka...
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col s12">
                    <div class="container">
                        <div class="col s12 m12 l12">
                            <div id="Form-advance" class="card card card-default scrollspy">
                                <div class="card-content">
                                    <h4 class="card-title">Daftar Hadir Kegiatan {{config('app.upbjj')}}</h4>
                                    <form role="form" method="POST" action="{{ route('presensi.umum.save') }}" id="form">
                                        @csrf
                                        <div id="view-select">
                                            <div class="row tooltipped" data-position="center" data-tooltip="Pilih jenis kegiatan">
                                                <div class="input-field col s12">
                                                    <select name="option" id="option" >
                                                        <option  value="" disabled selected>Pilih Jenis Kegiatan</option>
                                                        @if (!empty($getpresensikonfigurasi))
                                                            @foreach ($getpresensikonfigurasi as $data)
                                                                <option value="{{$data->id_kegiatan}}"> {{$data->nama_kegiatan}} </option>
                                                            @endforeach

                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12 m2 l2">
                                                    <label for="id">NIM</label>
                                                    <input placeholder="" name='nim' id="nim" type="text"
                                                           class="tooltipped" data-position="center" data-tooltip="Masukkan NIM jika anda mahasiswa UT">
                                                </div>
                                                <div class="input-field col s12 m10 l10">
                                                    <label for="id">Nama Peserta</label>
                                                    <input class="tooltipped" data-position="center" data-tooltip="Masukkan Nama Lengkap"
                                                           placeholder="Masukkan Nama Lengkap" name='nama' id="nama" type="text" required>
                                                </div>
                                                <div class="input-field col s12 m2 l2">
                                                    <label for="id">Nomor Telepon</label>
                                                    <input class="tooltipped" data-position="center" data-tooltip="Tuliskan hanya angka"
                                                           placeholder="" name='telepon' id = 'telepon' type="text" required>
                                                </div>
                                                <div class="input-field col s10">
                                                    <label for="id">Institusi</label>
                                                    <input placeholder="" name='institusi' type="text">
                                                </div>
                                                <div class="input-field col s2">
                                                    <label>Captcha</label>
                                                    <input class="tooltipped" data-position="center" data-tooltip="Masukkan hasil penjumlahan "
                                                           placeholder="" name="captcha" id="captcha" type="text" required>
                                                    @if ($errors->has('captcha'))
                                                        <span> <strong>{{ $errors->first('captcha') }}</strong></span>
                                                    @endif
                                                </div>
                                                <div class="row">
                                                    <p></p>
                                                    <div class="input-field col m4 s1">
                                                        <div id="captcha">
                                                            <span> <?=captcha_img();?></span>
                                                            <button type="button" class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange" class="reload" id="reload">
                                                                <i class="material-icons">refresh</i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <button class="waves-effect waves-light  btn gradient-45deg-green-teal box-shadow-none border-round mr-1 mb-1 " type="submit" name="action">Simpan Data
                                                        <i class="material-icons right">send</i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('script')
    <script src="{{url('app-assets/js/scripts/data-tables.js')}}"></script>
    <script type="text/javascript">
        $("#reload").click(function () {
            $.ajax({
                type: "GET",
                url: "{{ route('refresh.captcha') }}",
                success: function (data) {
                    $("#captcha span").html(data.captcha);
                }
            });
        });
        $("#nim").keyup(function () {
            var id = $('#nim').val();
            var length = this.value.length;
            if (length == 9) {
                $.ajax({
                    type: "POST",
                    dataType: 'JSON',
                    url: "{{ secure_url('/srs/GetDP') }}",
                    data: {_token: "{{ csrf_token() }}", nim: id},
                    success: function (result) {
                        $('#nama').prop('readonly', true); //disable
                        $('#nama').val(result.nama_mahasiswa);
                    }
                })
            }
            if (length < 9) {
                $('#nama').prop('readonly', false); //disable
                $('#nama').val('');
            }
        });
        $('#telepon').keypress(function (e) {
            var charCode = (e.which) ? e.which : event.keyCode;
            if (String.fromCharCode(charCode).match(/[^0-9]/g))
                return false;
        });

    </script>
@endsection
