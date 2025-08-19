@extends('pages.dashboardjadwal')
@section('head')

@endsection
<!-- Form with validation -->

@section('content')
    <div id="main">
        {{--        <div class="row">--}}
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
                            <form role="form" method="POST" action="{{ route('ttm.jadwal.cari') }}" id="form">
                                @csrf
                                <div class="row">
                                    <div class="input-field col s2 l2 m2">
                                        <label for="masa">Masa</label>
                                        <input name='masa' type="text" value="20242" required>
                                    </div>
                                    <div class="input-field col s10 m10 l10">
                                        <label for="id">Masukkan kata kunci berupa NIM atau ID Tutor</label>
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
        @if(!empty($data_mhs) || !empty($data_tutor))
            <div class="col s12">
                <div class="container">
                    <div class="section section-data-tables">
                        <div class="col s12">
                            <div id="button-trigger" class="card card card-default scrollspy">
                                <div class="card-content">
                                    <h4 class="card-title">Jadwal Tutorial</h4>
                                    <div class="row">
                                        <div class="col s12">
                                            @if(!empty($data_mhs))
                                                @include('pages.ttm.DataTablebyNIM')
                                            @endif @if(!empty($data_tutor))
                                                @include('pages.ttm.DataTablebyTutor')
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
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
