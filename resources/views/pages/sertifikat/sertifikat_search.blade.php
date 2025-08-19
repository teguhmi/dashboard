@extends('pages.dashboardsertifikat')
@section('head')

@endsection
<!-- Form with validation -->

@section('content')
    <div id="main">
{{--        <div class="row">--}}
            <div class="breadcrumbs-inline pt-3 pb-1" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                {{--                <div class="container">--}}
                <div class="row">
                    <div class="col s10 m6 l6 breadcrumbs-left">
                        <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Sertifikat</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('sertifikat.dashboard')}}">Sertifikat</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            {{--            </div>--}}
            @include('panels.bannerinfo')
            <div class="col s12">
                <div class="container">
                    <div class="col s12 m12 l12">
                        <div id="Form-advance" class="card card card-default scrollspy">
                            <div class="card-content">
                                <h4 class="card-title">Sertifikat</h4>
                                <form role="form" method="POST" action="{{ route('sertifikat.find') }}" id="form">
                                    @csrf
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <label for="id">Masukkan kata kunci berupa Nama Peserta</label>
                                            <input placeholder="" name='id' type="text">
                                            @if ($errors->has('id'))
                                                <div class="error" style="color:red">{{ $errors->first('id') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col m3 s12">
                                            <label>Captcha</label>
                                            <input placeholder="" name="captcha" id="captcha" type="text" required>
                                            @if ($errors->has('captcha'))
                                                <span> <strong>{{ $errors->first('captcha') }}</strong></span>
                                            @endif
                                        </div>
                                        <p></p>
                                        <div class="input-field col m4 s12">
                                            <div id="captcha">
                                                <span> <?=captcha_img();?></span>
                                                <button type="button" class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange" class="reload" id="reload">
                                                    <i class="material-icons">refresh</i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <button class="btn cyan waves-effect waves-light left" type="submit" name="action">Cari
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
            @if(!empty($hasil))
                <div class="col s12">
                    <div class="container">
                        <div class="section section-data-tables">
                            <div class="col s12 m12 l12">
                                <div id="button-trigger" class="card card card-default scrollspy">
                                    <div class="card-content">
                                        <h4 class="card-title">Data Sertifikat</h4>
                                        <div class="row">
                                            <div class="col s12 m12 l12">
                                                <table id="page-length-option" class="display">
                                                    <thead>
                                                    <tr>
                                                        {{--                                                    <th>No</th>--}}
                                                        <th>Nama</th>
                                                        <th>Jenis Kegiatan</th>
                                                        <th>Opsi</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php
                                                        $no = 1;
                                                    @endphp
                                                    @foreach($hasil as $data)
                                                        <tr>
                                                            {{--                                                        <td width="1%">{{$no++}}</td>--}}
                                                            <td width="20%">{{$data->nama}}</td>
                                                            <td width="70%">{{$data->nama_kegiatan}}</td>
                                                            <td width="1%">
                                                                <a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-indigo-light-blue"
                                                                   href="{{route('sertifikat.pdf', ['id' => Crypt::encrypt($data->id)],'/pdf') }}" target="_blank"><i class="material-icons">print</i>
                                                                </a>
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

    </script>
@endsection
