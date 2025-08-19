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
            @include('panels.bannerinfo')
            <div class="col s12">
                <div class="container">
                    <div class="col s12 m12 l12">
                        <div id="Form-advance" class="card card card-default scrollspy">
                            <div class="card-content">
                                <h4 class="card-title">Jadwal Tutorial</h4>
                                <form role="form" method="POST" action="{{ route('jadwal.tutorial.cari') }}" id="form">
                                    @csrf
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <label for="id">Masukkan kata kunci berupa NIM atau ID Tutor</label>
                                            <input placeholder="" name='id' type="text" required>
                                            @if ($errors->has('id'))
                                                <div class="error" style="color:red">{{ $errors->first('id')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col m3 s12">
                                            <label>Captcha</label>
                                            <input placeholder="" name="captcha" id="captcha" type="text" required>
                                            <span><small>masukkan hasil penjumlahan </small></span>
                                            @if ($errors->has('captcha'))
                                                <br>
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
                                            <button class="btn cyan waves-effect waves-light left" type="submit" name="action">Cari Jadwal
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
            @if(!empty($query_mhs) || !empty($query_tutor))
                <div class="col s12">
                    <div class="container">
                        <div class="section section-data-tables">
                            <div class="col s12 m12 l12">
                                <div id="button-trigger" class="card card card-default scrollspy">
                                    <div class="card-content">
                                        <h4 class="card-title">Jadwal Tutorial</h4>
                                        <div class="row">
                                            <div class="col s12">
                                                <table id="data-table-simple" class="display" width="100%">
                                                    <thead>
                                                    <tr>
                                                        <th>Masa</th>
                                                        @if(!empty($query_mhs))
                                                            <th width="5%">NIM</th>
                                                            <th width="50%">Nama Mahasiswa</th>
                                                        @endif
                                                        <th width="2%">Kode Mtk</th>
                                                        <th width="20%">Nama Tutor</th>
                                                        {{--                                                        <th>Telp Tutor</th>--}}
                                                        <th>Tanggal Mulai</th>
                                                        <th>Hari</th>
                                                        <th>Jam</th>
                                                        <th>Link</th>
                                                        <th>Kelas</th>
                                                        @if(!empty($query_mhs))
                                                            <th>Aksi</th>
                                                        @endif
                                                        @if (Auth::check())
                                                            @if(!empty($query_tutor))

                                                                <th>Aksi</th>
                                                            @endif
                                                        @endif

                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @if(!empty($query_mhs))
                                                        @foreach($query_mhs as $data)
                                                            <tr>
                                                                <td align='left'>{{ $data->masa }} </td>
                                                                <td align='left'>{{ $data->nim }} </td>
                                                                <td align='left'>{{ $data->nama }} </td>
                                                                <td align='center'>{{ $data->kode_mtk }} </td>
                                                                <td align='left'>{{ $data->namalengkap }} </td>
                                                                {{--                                                                <td align='left'>{{ $data->telepon }} </td>--}}
                                                                <td align='left'>{{ $data->tanggalmulai }} </td>
                                                                <td align='left'> <?php
                                                                    switch ($data->hari) {
                                                                        case "1";
                                                                            echo "Senin";
                                                                            break;
                                                                        case "2";
                                                                            echo "Selasa";
                                                                            break;
                                                                        case "3";
                                                                            echo "Rabu";
                                                                            break;
                                                                        case "4";
                                                                            echo "Kamis";
                                                                            break;
                                                                        case "5";
                                                                            echo "Jumat";
                                                                            break;
                                                                        case "6";
                                                                            echo "Sabtu";
                                                                            break;
                                                                        case "7";
                                                                            echo "Minggu";
                                                                            break;
                                                                    }
                                                                    ?> </td>
                                                                <td align='left'>{{ $data->jam}} </td>
                                                                <td align='left'>
                                                                    @if(empty($data->link))
                                                                        <a>{{ $data->lokasi }}</a>
                                                                    @else
                                                                        <a href="{{ $data->link }}">{{ $data->link }}</a>
                                                                    @endif
                                                                </td>
{{--                                                                <td align='left'><a href="{{ $data->link }}">{{ $data->link }}</a></td>--}}
                                                                <td align="center" width="5%"><a href="{{ route('jadwal.tutorial.idtutorial', ['id' => Crypt::encrypt($data->kelas),'idtutorial' => $data->idtutorial])}}"> {{$data->kelas}} </a></td>
                                                                <td align="center">
                                                                    <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange box-shadow-none border-round mr-1 mb-1"
                                                                       href="{{ route ('angketetm', ['id1' => Crypt::encrypt($data->kelas),'id2' => Crypt::encrypt($data->nim),'id3' =>Crypt::encrypt($data->idtutor)]
                                                                          )}}">Isi Angket
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    @if(!empty($query_tutor))
                                                        @foreach($query_tutor as $data)
                                                            <tr>
                                                                <td align='left'>{{ $data->masa }} </td>
                                                                <td align='center'>{{ $data->kode_mtk }} </td>
                                                                <td align='left'>{{ $data->namalengkap }} </td>
                                                                {{--                                                                <td align='left'>{{ $data->telepon }} </td>--}}
                                                                <td align='left'>{{ $data->tanggalmulai }} </td>
                                                                <td align='left'>
                                                                    <?php
                                                                    switch ($data->hari) {
                                                                        case "1";
                                                                            echo "Senin";
                                                                            break;
                                                                        case "2";
                                                                            echo "Selasa";
                                                                            break;
                                                                        case "3";
                                                                            echo "Rabu";
                                                                            break;
                                                                        case "4";
                                                                            echo "Kamis";
                                                                            break;
                                                                        case "5";
                                                                            echo "Jumat";
                                                                            break;
                                                                        case "6";
                                                                            echo "Sabtu";
                                                                            break;
                                                                        case "7";
                                                                            echo "Minggu";
                                                                            break;
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td align='left'>{{ $data->jam}} </td>
                                                                <td align='left'>
                                                                    @if(empty($data->link))
                                                                        <a>{{ $data->lokasi }}</a>
                                                                    @else
                                                                        <a href="{{ $data->link }}">{{ $data->link }}</a>
                                                                    @endif
                                                                </td>
{{--                                                                <td align='left'>--}}
{{--                                                                        <a href="{{ $data->link }}">{{ $data->link }}</a>--}}
{{--                                                                </td>--}}
                                                                <td align="center" width="5%"><a href="{{ route('jadwal.tutorial.idtutorial', ['id' => Crypt::encrypt($data->kelas),'idtutorial' => $data->idtutorial])}}"> {{$data->kelas}} </a></td>
{{--                                                                @if (Auth::check())--}}
{{--                                                                    <td align="center">--}}
{{--                                                                        <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange box-shadow-none border-round mr-1 mb-1"--}}
{{--                                                                           href="{{ secure_url(URL::route ('angketetu', ['id1' => Crypt::encrypt($data->kelas),'id2' => Crypt::encrypt($data->kode_mtk),'id3' =>Crypt::encrypt($data->idtutor)]--}}
{{--                                                                          ))}}">Isi Angket--}}
{{--                                                                        </a>--}}
{{--                                                                    </td>--}}
{{--                                                                @endif--}}
                                                                <td></td>
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
