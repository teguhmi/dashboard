@extends('pages.dashboardlayanan')
@section('head')

@endsection
@section('content')

    <!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">
            <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
            <div class="breadcrumbs-dark pb-0 pt-2" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6 breadcrumbs-left">
                            <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Kelompok Pelanggan</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('dashboardlayanan')}}">Layanan</a></li>
                                <li class="breadcrumb-item"><a href="{{route('layanan.data.kp')}}">Kelompok Pelanggan</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            @include('panels.bannerinfo')
            <div class="col s12">
                <div class="container">
                    <div class="card">
                        <div class="card-content">
                            <p class="caption mb-0">
                                <button class="waves-effect waves-light btn gradient-45deg-purple-light-blue box-shadow-none border-round mr-1 mb-1 modal-trigger"
                                        data-toggle="modal" href="#modaltambah">Tambah Data
                                </button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Length Options -->
            @if(!empty($query))
                <div class="col s12">
                    <div class="container">
                        <div class="section section-data-tables">
                            <div id="button-trigger" class="card card card-default scrollspy">
                                <div class="card-content">
                                    <h4 class="card-title">Kelompok Pelanggan</h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <table id="page-length-option" class="display">
                                                <thead>
                                                <tr>
                                                    <th width="5%">No</th>
                                                    <th width="70%">Kelompok Pelanggan</th>
                                                    <th width="20%" align="center">Opsi</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach($query as $data)
                                                    <tr>
                                                        <td>{{$no++}}</td>
                                                        <td>{{$data->nama_kp}}</td>
                                                        <td align="center">
                                                            <p align="center">

                                                                <button title="Merubah nama {{ $data->nama_kp}}"
                                                                        class="btn mb-6 btn-floating waves-effect waves-light purple lightrn-1 modal-trigger"
                                                                        data-toggle="modal" href="#modalUbah" onclick="edit('{{  Crypt::encrypt($data->id_kp)}}','{{ $data->nama_kp}}')">
                                                                    <i class="material-icons">edit</i>
                                                                </button>
                                                                <a title="Menghapus  {{ $data->nama_kp}} " class="mb-6 btn-floating waves-effect waves-light gradient-45deg-red-pink gradient-shadow"
                                                                   href="{{route ('layanan.data.kp.hapus', ['id'=> Crypt::encrypt($data->id_kp)],'/hapus') }}"
                                                                   onclick="return confirm('Hapus {{$data->nama_kp}}  ?');"><i class="material-icons">delete_forever</i>
                                                                </a>
                                                            </p>
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
    </div>

    <div id="modalUbah" class="modal">
        <div class="modal-content">
            <div class="col s12">
                <div class="container">
                    <div class="card">
                        <div id="Form-advance" class="card card card-default scrollspy">
                            <div class="card-content">
                                <h4 class="card-title">Edit Kelompok Pelanggan</h4>
                                <br>
                                <form role="form" method="POST" action="{{ route('layanan.data.kp.ubah') }}" id="form">
                                    @csrf
                                    <input placeholder="" type="hidden" id="id_kp" name="id_kp">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <label>Nama Penanggung Jawab</label>
                                            <input placeholder="" type="text" maxlength="200" id="nama_kp" name="nama_kp" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Simpan
                                                <i class="material-icons right">send</i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modaltambah" class="modal">
        <div class="modal-content">
            <div class="col s12">
                <div class="container">
                    <div class="card">
                        <div id="Form-advance" class="card card card-default scrollspy">
                            <div class="card-content">
                                <h4 class="card-title">Nama Penanggung Jawab</h4>
                                <br>
                                <form role="form" method="POST" action="{{ route('layanan.data.kp.tambah') }}" id="form">
                                    @csrf
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <label>Nama Penanggung Jawab</label>
                                            <input placeholder="" type="text" maxlength="200" id="nama_kp" name="nama_kp">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Simpan
                                                <i class="material-icons right">send</i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- BEGIN PAGE VENDOR JS-->
{{--    <script src="../../../app-assets/vendors/formatter/jquery.formatter.min.js"></script>--}}
{{--    <script src="../../../app-assets/js/scripts/form-masks.js"></script>--}}
    <script src="{{url('app-assets/js/scripts/data-tables.js')}}"></script>
    <script type="text/javascript">

        function edit(id_kp, nama_kp) {
            $('#id_kp').val(id_kp);
            $('#nama_kp').val(nama_kp);
        }
    </script>
@endsection
