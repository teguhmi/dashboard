@if(!empty($DPMahasiswa))
    <div id="basic-form" class="card card card-default scrollspy">
        <div class="card-content">
            <h4 class="card-title">Data Mahasiswa</h4>
            <div class="row">
                <div class="col s12">
                    <table>
                        <tbody>
                        <tr>
                            <td width="25%">NIM</td>
                            <td width="1%">:</td>
                            <td>{{$DPMahasiswa['nim']}}</td>
                            <td>
                                {{--                                @if(file_exists($filepath))--}}
                                {{--                                    <img onContextMenu="return false;" style="height:3.8cm; width: 2.8cm; object-fit: contain; vertical-align: center"--}}
                                {{--                                         src="{{secure_url('storage/foto/' . $DPMahasiswa['nim'] .'/'. $DPMahasiswa['nim'] .'_ktm.jpg' . '?t=' . time())}}" alt=""/>--}}
                                {{--                                @else--}}
                                {{--                                    <img onContextMenu="return false;" style="height:3.8cm; width: 2.8cm; object-fit: contain;" src="{{secure_url('app-assets/images/no_image.png' . '?t=' . time())}}" alt=""/>--}}
                                {{--                                @endif--}}
                                {{--                                @if($upload == true)--}}
                                {{--                                    <form action="{{route('mahasiswa.layanan.upload')}}" method="post" files="true" enctype="multipart/form-data">--}}
                                {{--                                        @csrf--}}
                                {{--                                        <div class="col s12">--}}
                                {{--                                            <input type="file" name="image" class="image" accept=".jpg, .jpeg">--}}
                                {{--                                            <input type="hidden" value="{{Crypt::encrypt( $DPMahasiswa['nim'])}}" name="nim">--}}
                                {{--                                        </div>--}}
                                {{--                                    </form>--}}
                                {{--                                @endif--}}
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Mahasiswa</td>
                            <td>:</td>
                            <td>{{$DPMahasiswa['nama_mahasiswa']}}</td>
                        </tr>
                        @auth()
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>:</td>
                                <td>{{$DPMahasiswa['tempat_lahir_mahasiswa']}}
                                    , {{$DPMahasiswa['tanggal_lahir_mahasiswa']}} </td>
                            </tr>
                        @endauth
                        <tr>
                            <td>UT Daerah</td>
                            <td>:</td>
                            <td>{{$DPMahasiswa['kode_upbjj']}} / {{$DPMahasiswa['nama_upbjj']}}</td>
                        </tr>
                        <tr>
                            <td>Program Studi</td>
                            <td>:</td>
                            <td>{{$DPMahasiswa['nama_program_studi']}}</td>
                        </tr>
                        @if(!empty($yudisium))
                            @foreach($yudisium as $data)
                                <tr>
                                    <td>Nomor SK Rektor</td>
                                    <td>:</td>
                                    <td>{{$data->nomor_sk_rektor}}</td>
                                </tr>
                                <tr>
                                    <td>Nomor Ijazah</td>
                                    <td>:</td>
                                    <td>{{$data->no_ijazah_d}}</td>
                                </tr>
                                @if(!empty($data->no_ijazah_a))
                                    <tr>
                                        <td>Nomor Ijazah Akta</td>
                                        <td>:</td>
                                        <td>{{$data->no_ijazah_a}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endif
