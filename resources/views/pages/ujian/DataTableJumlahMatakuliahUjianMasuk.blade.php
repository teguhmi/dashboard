@if(!empty($sql_jumlah))
    <div class="col s12">
        <div id="basic-form" class="card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title">Jumlah Matakuliah Numpang Ujian Masuk {{config('app.upbjj')}} </h4>
                <div class="row">
                    {{--                        @if(!empty($masaujian) && !empty($tanggalawal) && !empty($tanggalakhir))--}}
                    <div class="col s12">
                        <a class="waves-effect waves-light btn gradient-45deg-green-teal z-depth-4 mr-1 mb-2"
                           href="{{route('ujian.laporannumpangmasuk.excel', ['a' => $masaujian, 'b' =>'masuk','c' => $tanggalawal,'d' =>$tanggalakhir,'e'=>'jumlah']) }}">Excel Jumlah Numpang
                        </a>
                        <a class="waves-effect waves-light btn gradient-45deg-green-teal z-depth-4 mr-1 mb-2"
                           href="{{route('ujian.laporannumpangmasuk.excel', ['a' => $masaujian, 'b' =>'masuk','c' => $tanggalawal,'d' =>$tanggalakhir,'e'=>'daftar']) }}">Excel Daftar Numpang
                        </a>
                    </div>
                    <div>
{{--                    <div class="col s2 float-left">--}}

                    </div>
                    {{--                        @endif--}}
                    <br>

                    <div class="col s12">
                        <table id="page-length-option" class="display">
                            <thead>
                            <tr>
                                <th>Masa</th>
                                <th>Kode TPU</th>
                                <th>Nama TPU</th>
                                <th>Kode Matakuliah</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $no = 1
                            @endphp
                            @foreach($sql_jumlah as $item)
                                <tr>
                                    <td>{{$item->masa}}</td>
                                    <td>{{$item->kode_tpu}}</td>
                                    <td>{{$item->nama_tpu}}</td>
                                    <td>{{$item->kode_mtk}}</td>
                                    <td>{{$item->total}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
