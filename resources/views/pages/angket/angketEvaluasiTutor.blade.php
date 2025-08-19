@extends('pages.dashboardjadwal')
@section('head')

@endsection
@section('content')

    <!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">

            <div class="breadcrumbs-inline pt-3 pb-1" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6 breadcrumbs-left">
                            <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Data Tutorial</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('angket.tutor')}}">Evaluasi Kinerja Tutor</a>

                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            @include('panels.bannerinfo')
            <div class="col s12 m6 l6">
                <div class="section section-data-tables">
                    <div id="button-trigger" class="card card card-default scrollspy">
                        <div class="card-content">
                            <h4 class="card-title">Data Evaluasi Tutor </h4>
                            <form role="form" method="get" action="{{ route('angket.evaluasi') }}" id="form">
                                @csrf
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="id">Masukkan kata kunci berupa masa tutorial</label>
                                        <input placeholder="" name='id' type="text" value="">
                                        <button class="btn cyan waves-effect waves-light left" type="submit" name="action">Lihat Data
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($masa))
                <div class="col s12 m6 l6">
                    <div class="section section-data-tables">
                        <div id="button-trigger" class="card card card-default scrollspy">
                            <div class="card-content">
                                <div class="row">
                                    <a class="col s12 btn cyan waves-effect waves-light"
                                       href="{{route ('angket.penilaian', ['id' => Crypt::encrypt($masa),'jenis'=>'jadwal'])}}">Sync Jadwal Tutorial Masa {{$masa}}
                                    </a>
                                </div>
                                {{--                                <br>--}}
                                {{--                                <div class="row">--}}
                                {{--                                    <a class="col s12 btn cyan waves-effect waves-light left"--}}
                                {{--                                       href="{{route ('angket.penilaian', ['id' => $masa,'jenis'=>'penilaian'])}}">Proses Penilaian Tutor Masa {{$masa}}--}}
                                {{--                                    </a>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
        @endif
        <!-- Page Length Options -->
            <div class="row">
                <div class="col s12">
                    <div id="Fixed-width-tabs" class="card card card-default scrollspy">
                        <div class="card-content">
                            <div class="row">
                                <ul class="tabs tabs-fixed-width tab-demo z-depth-1">
                                    <li class="tab"><a class="active" href="#dataEvaluasi">Hasil Evaluasi</a></li>
                                    <li class="tab"><a href="#hasilEvaluasi">Data Evaluasi</a></li>
                                </ul>
                                <div id="dataEvaluasi">
                                    @include('pages.angket.datatables_hasil_evaluasi')
                                </div>
                                <div id="hasilEvaluasi">
                                    @include('pages.angket.datatables_data_evaluasi')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{url('app-assets/js/scripts/data-tables.js')}}"></script>
@endsection


