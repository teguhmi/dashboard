@if(!empty($deskripsi))
    <div class="col s12">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <h4 class="card-title">Data FAQ @if(!empty($deskripsi)) Kategori {{$deskripsi[0]->keterangan}} @endif
                                @auth()
                                    <button class="waves-effect waves-light btn gradient-45deg-purple-light-blue box-shadow-none border-round mr-1 mb-1 modal-trigger right"
                                            href="#deskripsimodal" onclick="baru()">Tambah Kegiatan
                                    </button>
                                @endauth
                            </h4>

                            <table id="page-length-option" class="display" style="width: 100%">
                                <thead>
                                <tr>
                                    {{--                                    <th style="width: 10%">Kategori</th>--}}
                                    @auth()
                                        <th style="width: 2%">Urutan</th>
                                    @endauth
                                    <th style="width: 30%">Pertanyaan</th>
                                    <th style="width: 50%">Jawaban</th>
                                    @auth()
                                        <th>Opsi</th>
                                    @endauth

                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach($deskripsi as $data)
                                    <tr>
                                        {{--                                        <td style="vertical-align: top">{{$data->keterangan}}</td>--}}
                                        @auth
                                            <td style="vertical-align: top">{{$data->urut}}</td>
                                        @endauth
                                        <td style="vertical-align: top">{{$data->pertanyaan}}</td>
                                        <td style="vertical-align: top">{!! html_entity_decode($data->jawaban) !!} </td>
                                        @auth
                                            <td>
                                                <a class="mb-6 btn-floating waves-effect waves-light gradient-45deg-purple-amber"
                                                   href="{{route('faq.deskripsi.opsi',['id' => Crypt::encrypt($data->id),'jenis' => 'hapus'])}}"><i class="material-icons">delete_forever</i>
                                                </a>

                                                <button title="Perbaiki data deskripsi..? " class=" mb-6 btn-floating waves-effect waves-light gradient-45deg-blue-grey-blue modal-trigger"
                                                        href="#deskripsimodal" onclick="edit('{{$data->id}}','{{$data->id_faq}}','{{$data->pertanyaan}}','{{$data->jawaban}}','{{$data->urut}}')">
                                                    <i class="material-icons">edit</i>
                                                </button>
                                            </td>
                                        @endauth
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
