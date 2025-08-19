<div class="col s12">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h4 class="card-title">Data FAQ</h4>
                        <form role="form" method="POST" action="{{ route('faq.deskripsi.simpan') }}" id="form">
                            @csrf
                            <div class="row">
                                <div class="col s12">
                                    <label for="kategori">Kategori FAQ</label>
                                    <select class="select2 browser-default" name="kategori" id="kategori">
                                        <option value='' disabled selected></option>
                                        @if (!empty($kategori))
                                            @foreach ($kategori as $data)
                                                <option value="{{$data->id_faq}}"> {{$data->keterangan}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col s12">
                                    <br>
                                    <label for="tanya">Tanya</label>
                                    <input id="tanya" name="tanya" type="text" maxlength="1000">
                                </div>

                                {{--                                <div class="col s12 m3 l3">--}}
                                {{--                                    <br>--}}
                                {{--                                    <label for="urut">Nomor Urut</label>--}}
                                {{--                                    <input id="urut" name="urut" type="text" maxlength="10">--}}
                                {{--                                </div>--}}
                            </div>
                            <div class="row">
                                <div class="col s12">
                                    <br>
                                    <label for="jawab"> Jawab
                                        <textarea name="jawab" class="jawab" maxlength="10000"></textarea>
                                    </label>
                                </div>

                                <input type="hidden" name="modal_id" id="modal_id" value="">
                                <div class="col s12">
                                    <label for="nomorurut">Nomor Urut</label><input type="text" name="nomorurut" id="nomorurut" value="">
                                </div>
                                <input type="hidden" name="jenis" id="jenis" value="">
                                <div class="input-field col s12">
                                    <button class="btn cyan waves-effect waves-light left" type="submit" name="action">Simpan</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
