@extends('pages.dashboardjadwal')
@section('head')

@endsection
@section('content')
    <div id="main">
        <div class="row">
            <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
            <div class="breadcrumbs-dark pb-0 pt-2" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                <div class="container">
                    <div class="row">
                        <div class="col s10 m6 l6 breadcrumbs-left">
                            <h5 class="breadcrumbs-title mt-0 mb-0 display-inline hide-on-small-and-down"><span>Hasil ETM</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('jadwal.tutorial')}}">Hasil ETM</a>

                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            @include('panels.bannerinfo')

            <div class="col s12">
                <div class="container">
                    <div class="section section-data-tables">
                        <div id="button-trigger" class="card card card-default scrollspy">
                            <div class="card-content">
                                <h4 class="card-title">Data Hasil Angket Evaluasi Tutor oleh Mahasiswa </h4>
                                <div class="row">
                                    <div class="col s12">
                                        <table id="scroll-dynamic" class="display">
                                            {{--                                        <table class="bordered">--}}
                                            <thead>
                                            <tr style="font-weight: bold">
                                                <td colspan="16" class="center">Data Evaluasi Tutor oleh Mahasiswa {{config('app.upbjj')}}</td>
                                            </tr>
                                            <tr style="font-weight: bold" class="center">
                                                {{--                                                <td width="5%" rowspan="2" class="center">Responden</td>--}}
                                                <td colspan="16" class="center"> @if (!empty($query)) {{$query[0]->nama_tutor}} @endif/ {{$query[0]->kode_mtk}} - {{$query[0]->nama_mtk}}</td>
                                            </tr>
                                            <tr style="font-weight: bold">
                                                <td width="5%" class="center">Responden</td>
                                                @for ($i=1;$i<=15;$i++)
                                                    <td>{{$i}}</td>
                                                @endfor
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php $no = 1; $a = '$data->H_' ;
                                            @endphp
                                            @if (!empty($query))
                                                @foreach($query as $data)
                                                    <tr style="height: 5px;">
                                                        <td class="center" width="1%">
                                                            {{$no++}}
                                                        </td>
                                                        @for ($i=1;$i<=15;$i++)
                                                            @php $a = 'H_'. $i @endphp
                                                            <td class="center">{{$data->$a}}</td>
                                                        @endfor
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                            <tfoot>
                                            @if(!empty($ratarata))
                                                <tr>
                                                    <td style="text-align: left">Rata-Rata</td>
                                                    @foreach($ratarata as $data)
                                                        <td class="center">{{$data}}</td>
                                                    @endforeach
                                                </tr>
                                            @endif
                                            @if(!empty($total))
                                                <tr>
                                                    <td class="center">Total</td>
                                                    <td class="center" colspan="15">{{$total}}</td>
                                                </tr>
                                            @endif
                                            </tfoot>
                                        </table>
                                    </div>
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
