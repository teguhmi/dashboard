@extends('pages.dashboardjadwal')
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
                            <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Jadwal</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('jadwal.tutorial')}}">Tutorial</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @include('panels.bannerinfo')
            @if(!empty($query))
                @foreach($query->data as $data)
                    <div class="col s12 m8 l8">
                        {{--                        <div class="container">--}}
                        {{--                            <div class="col s12 m12 l12">--}}
                        <div id="Form-advance" class="card card card-default scrollspy">
                            <div class="card-content">
                                <div class="row">
                                    <div class="input-field col s12 m12 l12">
                                        <label>Masa / ID Kelas / ID Tutorial</label>
                                        <input type="text" name="kelas" readonly value="{{$data->masa}} / {{$data->id_kelas}} / {{$data->id_tutorial}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m12 l12">
                                        <label>Matakuliah</label>
                                        <input type="text" name="matakuliah" readonly value="{{$data->kode_matakuliah}} / {{$data->nama_matakuliah}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m12 l12">
                                        <label>Tutor</label>
                                        <input type="text" name="idtutorial" readonly value="{{$data->id_tutor }} /  {{$data->nama_lengkap }}">
                                    </div>
                                </div>
                                @if(!empty($data->link))
                                    <div class="row">
                                        <div class="input-field col s12 m12 l12">
                                            <label>Link Tuweb</label>
                                            <input type="text" name="link" readonly value="{{$data->link}}">
                                        </div>
                                    </div>
                                @endif
                            </div>
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                    @break
                @endforeach
                <div class="col s12 m4 l4">
                    <div id="Form-advance" class="card card card-default scrollspy">
                        <div class="card-content">
                        </div>
                    </div>
                </div>
                <div class="col s12">
                    <div class="section section-data-tables">
                        <div id="button-trigger" class="card card card-default scrollspy">
                            <div class="card-content">
                                <h4 class="card-title">Daftar Nama Mahasiswa</h4>
                                <div class="row">
                                    <div class="col s12">
                                        <table id="data-table-simple" class="display">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIM</th>
                                                <th>Nama Mahasiswa</th>
                                                <th>UT Daerah</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @if(!empty($query))
                                                @foreach($query->data as $data)


                                                    <tr>
                                                        <td>{{ $no++ }} </td>
                                                        <td>{{ $data->nim }} </td>
                                                        <td>{{ $data->nama }} </td>
                                                        <td> </td>

                                                        {{--                                            <td align='left'>{{ $data->nomor_hp }} </td>--}}
                                                    </tr>
                                                @endforeach
                                            @endif
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
