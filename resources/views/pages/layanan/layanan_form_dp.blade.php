@extends('pages.dashboardlayanan')
@section('head')

@endsection
<!-- Form with validation -->

@section('content')
    <div id="main">
        <div class="row">
            <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
            <div class="breadcrumbs-dark pb-0 pt-2" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Form Layanan</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('dashboardlayanan')}}">Layanan</a></li>
                                <li class="breadcrumb-item"><a href="{{route('layanan.formulir')}}">Formulir Layanan</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            @include('panels.bannerinfo')
            <div class="col s12 m12 l12">
                <div class="container">
                    <div id="Form-advance" class="card card card-default scrollspy">
                        <div class="card-content">
                            <div class="row">
                                <div class="col s6 m6 l6">
                                    <h4 class="card-title">Formulir Layanan dan Keluhan</h4>
                                </div>
                                <div class="col s6 m6 l6">
                                    <a class="waves-effect waves-light btn gradient-45deg-purple-light-blue box-shadow-none border-round mr-1 mb-1 right"
                                       type="submit" href="{{route('layanan.formulir')}}">Buat Baru
                                        <i class="material-icons right">send</i>
                                    </a>
                                </div>
                            </div>
                            <form role="form" method="POST" action="{{ route('layanan.formulir.input') }}" id="form">
                                @csrf
                                <div class="row">
                                    <div id="view-select">
                                        <div class="input-field col s12 m6 l6">
                                            <h7>Sumber Layanan</h7>
                                            <select class="select2 browser-default validate" name="asal" id="asal" required>
                                                @auth
{{--                                                <option value="" disabled selected></option>--}}
                                                @endauth
                                                @if (!empty($asal))
                                                    @foreach ($asal as $data)
                                                        <option value="{{$data->id_asal}}"
                                                                @if(!empty($query))
                                                                @if($data->id_asal == $query[0]->id_asal) selected
                                                            @endif
                                                            @endif> {{$data->nama_asal}}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="input-field col s12 m6 l6">
                                            <h7>Kelompok Pelanggan</h7>
                                            <select class="select2 browser-default" name="kl_kp" id="kl_kp" required>
                                                <option value="" disabled selected></option>
                                                @if (!empty($kp))
                                                    @foreach ($kp as $data)
                                                        <option value="{{$data->id_kp}}" @if(!empty($query))@if($data->id_kp == $query[0]->id_kp) selected @endif @endif > {{$data->nama_kp}} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m2 l2" >
                                        <label for="nim">NIM</label>
                                        <input placeholder="" name="nim" id="nim" type="text" maxlength="9" value="@if(!empty($query)) {{$query[0]->nim}}@endif">
                                        <input placeholder="" name="id_data_dp" id="id_data_dp" type="hidden" value="@if(!empty($query)) {{$query[0]->id_data_dp}}@endif">
                                    </div>
                                    <div class="input-field col s12 m7 l7">
                                        <label for="nama">Nama</label>
                                        <input placeholder="" name="nama" id="nama" type="text" value="@if(!empty($query)) {{$query[0]->nama}}@endif" required>
                                    </div>
                                    <div class="input-field col s12 m3 l3">
                                        <label for="upbjj">UPBJJ</label>
                                        <input placeholder="" name="nama_upbjj" id="nama_upbjj" type="text" value="@if(!empty($query)) {{$query[0]->nama_upbjj}}@endif" readonly>
                                        <input placeholder="" name="kode_upbjj" id="kode_upbjj" type="hidden" value="@if(!empty($query)) {{$query[0]->kode_upbjj}}@endif">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m6 l6">
                                        <label for="id">Nomor Telepon</label>
                                        <input placeholder="" name='telepon' type="text" maxlength="20" value="@if(!empty($query)) {{$query[0]->telepon}}@endif">
                                    </div>
                                    <div class="input-field col s12 m6 l6">
                                        <label for="id">email</label>
                                        <input placeholder="" name='email' type="email" maxlength="30" value="@if(!empty($query)) {{$query[0]->email}}@endif">
                                    </div>

                                </div>
                                <div class="row">
                                    @if(!empty($query[0]->id_data_dp))
                                        @auth
                                        <div class="input-field col s6 m2 l2">
                                            <button class="waves-effect waves-light btn gradient-45deg-purple-light-blue box-shadow-none border-round mr-1 mb-1" type="submit" name="action">Update Data
                                                <i class="material-icons right">send</i>
                                            </button>
                                        </div>
                                        <div class="input-field col s6 m2 l2">
                                            <button class="waves-effect waves-light btn gradient-45deg-purple-light-blue box-shadow-none border-round mr-1 mb-1 modal-trigger"
                                                    data-toggle="modal" href="#kegiatanmodal">Deskripsi Layanan
                                            </button>
                                        </div>
                                            @endauth
                                    @else
                                        <button class="waves-effect waves-light btn gradient-45deg-purple-light-blue box-shadow-none border-round mr-1 mb-1" type="submit" name="action">Simpan Data
                                            <i class="material-icons right">send</i>
                                        </button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(!empty($hasil))
            <div class="col s12">
                <div class="container">
                    <div class="section section-data-tables">
                        <div id="button-trigger" class="card card card-default scrollspy">
                            <div class="card-content">
                                {{--                                    <h4 class="card-title">Data Sertifikat</h4>--}}
                                <div class="row">
                                    <div class="col s12">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Deskripsi Layanan</th>
                                                <th>Kategori</th>
                                                <th>Disposisi</th>
                                                <th>Status</th>
                                                <th>opsi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach($hasil as $data)
                                                <tr>
                                                    <td width="1%">{{$no++}}</td>
                                                    <td>{{$data->deskripsi}}</td>
                                                    <td>{{$data->nama_kategori}}</td>
                                                    <td>{{$data->nama_pj}}</td>
                                                    <td>{{$data->nama_status}}</td>
                                                    <td>
                                                        @auth
                                                            <a title="Menghapus Data {{ $data->nama_kategori}} " class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-amber"
                                                               href="{{route ('layanan.hapus.deskripsi', ['id_deskripsi'=> Crypt::encrypt($data->id_deskripsi), 'id_data_dp'=> Crypt::encrypt($data->id_data_dp)],'/hapusdeskripsi') }}"
                                                               onclick="return confirm('Hapus Kegiatan {{$data->nama_kategori}} ?');"><i class="material-icons">delete_forever</i>
                                                            </a>
                                                            {{--                                                            <button title="Merubah Data {{ $data->nama_kategori}}"--}}
                                                            {{--                                                                    class=" mb-6 btn-floating waves-effect waves-light gradient-45deg-blue-grey-blue modal-trigger"--}}
                                                            {{--                                                                    href="#kegiatanmodal" onclick="edit('{{ $data->id_kategori}}'--}}
                                                            {{--                                                                ,'{{ $data->id_pj}}'--}}
                                                            {{--                                                                ,'{{ $data->deskripsi}}'--}}
                                                            {{--                                                                )"><i class="material-icons">edit</i>--}}
                                                            {{--                                                            </button>--}}
                                                        @endauth
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
            </div>
        @endif
    </div>
    <!-- Modal Structure -->
    <div id="kegiatanmodal" class="modal  modal-fixed-footer">
        <div class="modal-content">
            <div class="col s12">
                <h4>Deskripsi Layanan</h4>
                <br>
                <div id="view-select">
                    <form role="form" method="POST" action="{{ route('layanan.deskripsi.input') }}" id="form">
                        @csrf
                        <input name="id_data_dp" id="id_data_dp" type="hidden" value="@if(!empty($query)) {{$query[0]->id_data_dp}}@endif">
                        <div class="row">
                            <div class="input-field col s12 m6 l6">
                                <label for="id_kategori"></label>
                                <select name="id_kategori" id="id_kategori" required>
                                    <option value="" disabled selected>Kategori</option>
                                    @if (!empty($kategori))
                                        @foreach ($kategori as $data)
                                            <option value="{{$data->id_kategori}}"> {{$data->nama_kategori}} </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="input-field col s12 m6 l6">
                                <label for="id_pj"></label>
                                <select name="id_pj" id="id_pj" required>
                                    <option value="" disabled selected>Disposisi</option>
                                    @if (!empty($pj))
                                        @foreach ($pj as $data)
                                            <option value="{{$data->id_pj}}"> {{$data->nama_pj}} </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="materialize-textarea" name='deskripsi'></textarea>
                            </div>
                        </div>

                        {{--                                        <div class="row">--}}
                        {{--                                            <div class="input-field col s6">--}}
                        {{--                                                <select name="status" id="status">--}}
                        {{--                                                    <option value="" disabled selected>Disposisi</option>--}}
                        {{--                                                    @if (!empty($status))--}}
                        {{--                                                        @foreach ($status as $data)--}}
                        {{--                                                            <option value="{{$data->id_status}} "> {{$data->nama_status}} </option>--}}
                        {{--                                                        @endforeach--}}
                        {{--                                                    @endif--}}
                        {{--                                                </select>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        <div class="input-field col s12">
                            <button class="waves-effect waves-light  btn gradient-45deg-green-teal box-shadow-none border-round mr-1 mb-1 "
                                    type="submit" name="action">Simpan Data
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="../../../app-assets/js/scripts/data-tables.js"></script>
    <script src="../../../app-assets/js/scripts/advance-ui-modals.js"></script>
    <script type="text/javascript">
        $("#nim").keyup(function () {
            var id = $('#nim').val();
            var length = this.value.length;
            if (length == 9) {
                $.ajax({
                    type: "POST",
                    dataType: 'JSON',
                    url: "{{ route('srs.getdpbynim') }}",
                    data: {_token: "{{ csrf_token() }}", nim: id},
                    success: function (result) {
                        $('#kl_kp').val(1).trigger("change");
                        $('#nama').val('');
                        $('#nama').prop('readonly', true); //disable
                        $('#nama').val(result.nama_mahasiswa);
                        $('#nama_upbjj').val(result.nama_upbjj);
                        $('#kode_upbjj').val(result.kode_upbjj);
                    }
                })
            }
            if (length < 9) {
                $('#kl_kp').val(2).trigger("change");
                $('#nama').prop('readonly', false); //enable
                $('#nama').val('');
                $('#kode_upbjj').val('');
                $('#nama_upbjj').val('');
                $('#kl_kp').prop('3');
            }


        });
    </script>
@endsection
