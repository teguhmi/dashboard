@extends('pages.dashboardfaq')
@section('head')

@endsection
@section('content')
    @if(!empty($kategori))
        <div class="col s12">
            <div class="section section-data-tables">
                <div class="col s12 m12 l12">
                    <div class="card">
                        <div class="card-content">
                            <h4 class="card-title">Kategori FAQ</h4>
                            <div class="row">
                                <div class="col s12 l12 m12">
                                    <table id="page-length-option" class="display">
                                        <thead>
                                        <tr>
                                            <th style="width: 1%">No</th>
                                            <th style="width: 50%">Nama Kategori</th>
                                            <th style="width: 5%">Icon</th>
                                            <th style="width: 5%">Urutan</th>
                                            <th style="width: 5%">Opsi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $no = '1'
                                        @endphp
                                        @foreach($kategori as $data)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$data->keterangan}}</td>
                                                <td>{{$data->icon}}</td>
                                                <td>{{$data->urut}}</td>
                                                <td>
                                                    <a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-amber"
                                                       href="#"><i class="material-icons">delete_forever</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kategori</th>
                                            <th>Icon</th>
                                            <th>Urutan</th>
                                            <th>opsi</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('script')
    <!-- BEGIN PAGE LEVEL JS-->

    <!-- END PAGE LEVEL JS-->
@endsection
