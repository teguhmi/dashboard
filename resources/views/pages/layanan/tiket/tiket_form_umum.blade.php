<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
@include('panels.pelangi.head')
<body class="horizontal-layout page-header-light horizontal-menu preload-transitions 1-column forgot-bg   blank-page blank-page" data-open="click" data-menu="horizontal-menu" data-col="1-column">
<div class="row">
    <div class="col s12">
        <div class="container">
            <div id="lock-screen" class="row">
                <div class="col s12 m8 l6 z-depth-4 card-panel border-radius-6 forgot-card bg-opacity-8">
                    @include('panels.bannerinfo')
                    <div class="row">
                        <div class="input-field col s12 center-align mt-2">
                            <img class="z-depth-4 circle responsive-img" width="100" src="../../../app-assets/images/logo/logo_ut.png" alt="">
                            <h5>{{config('app.upbjj')}}
                        </div>
                        <form role="form" method="POST" action="{{ route('layanan.tiketinput') }}" id="form">
                            @csrf
                            <div class="row margin">
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
                            <div class="row margin">
                                <div class="input-field col s12 m3 l3">
                                    <label for="nim">NIM</label>
                                    <input placeholder="" name="nim" id="nim" type="text" maxlength="9" value="@if(!empty($query)) {{$query[0]->nim}}@endif" autofocus>
                                    <input placeholder="" name="id_data_dp" id="id_data_dp" type="hidden" value="@if(!empty($query)) {{$query[0]->id_data_dp}}@endif">
                                </div>
                                <div class="input-field col s12 m9 l9">
                                    <label for="nama">Nama</label>
                                    <input placeholder="" name="nama" id="nama" type="text" value="@if(!empty($query)) {{$query[0]->nama}}@endif" required>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12 m4 l4">
                                    <label for="telepon">Nomor Telepon</label>
                                    <input placeholder="" name='telepon' id="telepon" type="text" maxlength="20" value="@if(!empty($query)) {{$query[0]->telepon}}@endif" required>
                                    <span class="error" style="color: red; display: none">* Masukkan angka (0 - 9)</span>
                                </div>
                                <div class="input-field col s12 m3 l4">
                                    <label for="email">email</label>
                                    <input placeholder="" name='email' id ="email" type="email" maxlength="30" value="@if(!empty($query)) {{$query[0]->email}}@endif">
                                </div>
                                <div class="input-field col s12 m4 l4">
                                    <label for="nama_upbjj">UPBJJ</label>
                                    <input placeholder="" name="nama_upbjj" id="nama_upbjj" type="text" value="@if(!empty($query)) {{$query[0]->nama_upbjj}}@endif" readonly>
                                    <input placeholder="" name="kode_upbjj" id="kode_upbjj" type="hidden" value="@if(!empty($query)) {{$query[0]->kode_upbjj}}@endif">
                                </div>
                            </div>
                            <div class="input-field col s12">
                                <button onclick="openFullscreen();" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12" type="submit" name="action">Simpan Data
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </form>
                        <div class="row">
                            <div class="input-field col s4 m4 l4">
                                <p class="margin medium-small"><a href="{{route('home')}}">Dashboard</a></p>
                            </div>
{{--                            <div class="input-field col s4 m4 l4 center" >--}}
{{--                                <a class="waves-effect waves-block waves-light toggle-fullscreen" href="javascript:void(0);">--}}
{{--                                    <i class="material-icons">settings_overscan</i>--}}
{{--                                </a>--}}
{{--                            </div>--}}
                            <div class="input-field col s4 m4 l4 right">
                                <p class="margin right-align medium-small "><a href="{{route('layanan.tiket')}}">Refresh</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../../../app-assets/js/vendors.min.js"></script>
<script src="../../../app-assets/js/plugins.js"></script>
<script src="../../../app-assets/js/search.js"></script>
<script src="../../../app-assets/js/custom/custom-script.js"></script>
<script type="text/javascript">
    $("#nim").keyup(function () {
        var id = $('#nim').val();
        var length = this.value.length;
        if (length === 9) {
            $.ajax({
                type: "POST",
                dataType: 'JSON',
                url: "{{ route('srs.getdpbynimAJAX') }}",
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
    $("document").ready(function () {
        setTimeout(function () {
            $("div.card-alert").remove();
        }, 10000); // 10 secs
    });

    $(document).ready(function () {
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

    function openFullscreen() {
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.webkitRequestFullscreen) { /* Safari */
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) { /* IE11 */
            elem.msRequestFullscreen();
        }
    }
</script>

</body>
</html>
