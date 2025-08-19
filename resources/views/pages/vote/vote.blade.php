<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
@include('panels.horizontal.head')
<body class="horizontal-layout page-header-light horizontal-menu preload-transitions 2-columns" data-open="click" data-menu="horizontal-menu" data-col="2-columns">
@include('panels.horizontal.header')
<div id="main">
    @if(!empty($pesan))
        <div class="container">
            <div class="col s12">
                <div class="card-alert card @if(empty($warning)) gradient-45deg-red-pink @else {{$warning}} @endif">
                    <div class="card-content white-text">
                        <p style="text-align:center">
                            <i class="material-icons">check </i> {{$pesan}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="col s12">
            <div class="card ">
                <div class="card-content">
                    <h5 style="text-align: center">PEMILIHAN KETUA ORMAWA UT SURAKARTA<br>
                        PERIODE 2025-2027
                    </h5>
                </div>
            </div>
        </div>

        <div class="col s12">
            <div class="card ">
                <div class="card-content">
                    Ormawa UT merupakan wadah pembangunan karakter serta pengembangan potensi dan kemampuan mahasiswa dalam bidang akademik dan non-akademik.
                    <br>
                    <br>
                    Ormawa UT bertujuan untuk:
                    <ol>
                        <li> meningkatkan kecerdasan intelektual, emosional, sosial, dan spiritual mahasiswa;</li>
                        <li> mengembangkan penalaran, minat dan bakat, kreativitas, dan kewirausahaan mahasiswa; dan</li>
                        <li> membentuk dan mengembangkan keterampilan organisasi, kemandirian, dan kepemimpinan mahasiswa</li>

                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="container">
            @if(!empty($kandidat))
                @foreach($kandidat as $rows)
                    <div class="col s12 m4 l4 centered ">
                        <div class="card gradient-shadow gradient-45deg-light-blue-cyan border-radius-3 animate fadeUp">
                            <div class="card-content center">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td style="text-align: center;">
                                            <img style="width: 400px;height: 500px" src="{{ asset ('storage/vote/' . $rows->id . '.jpg') }}"
                                                 alt=""/>&nbsp;
                                        </td>
                                    </tr>
                                    <tr style="background-color: white;">
                                        <td style="text-align: center;">
                                            {!! html_entity_decode($rows->nama) !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a class=" col s12 waves-effect waves-light  btn" href="{{$rows->link_1}}" target="_blank"> Video Presentasi</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a class="col s12 waves-effect waves-light  btn" href="{{secure_url('storage/vote/' . $rows->id . '.pdf')}}" target="_blank">Daftar Riwayat Hidup</a>
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
                <a class="col s12 mb-6 btn btn-large waves-effect waves-light gradient-45deg-purple-deep-orange gradient-shadow btn modal-trigger" href="#modal1">KLIK SAYA UNTUK MENENTUKAN PILIHAN</a>
        </div>
    </div>

</div>
<!-- Modal Trigger -->
<!-- Modal Structure -->
<div id="modal1" class="modal">
    <form role="form" method="POST" action="{{route('vote.simpan')}}" id="form">
        @csrf
        <div class="modal-content">
            <h6>Pilih kandidat</h6>
            <hr>
            <br>
            <div class="row">
                <div class="col s12 m6 l6">
                    <label> NIM
                        <input type="text" name="nim" maxlength="9" required>
                    </label>
                </div>
                <div class="col s12 m6 l6">
                    <label> Tangggal Lahir
                        <input type="text" name="tanggal_lahir" id="tanggal_lahir" required>
                    </label>
                </div>
                <div class="col s12">
                    <label for="kandidat"> Kandidat
                        <select name="kandidat" id="kandidat" required>
                            <option value="" disabled selected>pilih nama kandidat</option>
                            @if (!empty($kandidat))
                                @foreach ($kandidat as $rows)
                                    @php
                                    $arr = explode("<br>", $rows->nama, 2);
                                    $first = $arr[0];
                                    @endphp

                                    <option value="{{$rows->id}}"> {{$first}} </option>
                                @endforeach

                            @endif
                        </select>
                    </label>
                </div>
                {{--                <div class="col m3 s12">--}}
                {{--                    <br>--}}
                {{--                    <label for="captcha">Captcha--}}

                {{--                        <input placeholder="" name="captcha" id="captcha" type="text" required>--}}
                {{--                        @if ($errors->has('captcha'))--}}
                {{--                            <span> <strong>{{ $errors->first('captcha') }}</strong></span>--}}
                {{--                        @endif--}}
                {{--                    </label>--}}

                {{--                </div>--}}
                {{--                <div class="col m4 s12">--}}
                {{--                    <div id="captcha">--}}
                {{--                        <br>--}}
                {{--                        <br>--}}
                {{--                        <span> <?=captcha_img();?></span>--}}
                {{--                        <button type="button" class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange reload" id="reload">--}}
                {{--                            <i class="material-icons">refresh</i>--}}
                {{--                        </button>--}}
                {{--                    </div>--}}
                {{--                </div>--}}

            </div>
            <p></p>
            <button class="waves-effect waves-light btn gradient-45deg-green-teal z-depth-4 mr-1 mb-2 right">Simpan
                <i class="material-icons left">send</i>
            </button>

        </div>
        {{--        <div class="modal-footer">--}}
        {{--            <button class="modal-action modal-close waves-effect waves-green btn-flat ">Simpan</button>--}}
        {{----}}
        {{--        </div>--}}
    </form>
</div>
@include('panels.horizontal.footer')
@include('panels.horizontal.script')
</body>
</html>
<script src="{{asset('app-assets/js/jquery.maskedinput.js')}}"></script>
<script src="{{asset('app-assets/js/scripts/advance-ui-modals.js')}}"></script>
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
    jQuery(function ($) {
        $("#tanggal_lahir").mask("99/99/9999", {placeholder: "__/__/____"});
    });
</script>
