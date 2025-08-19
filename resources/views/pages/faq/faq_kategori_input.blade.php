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
                                <div class="col s12 m4 l4">
                                    <br>
                                    <label for="tombol">Nama Tombol</label>
                                    <input id="tombol" name="tombol" type="text" maxlength="50">
                                </div>
                                <div class="col s12 m5 l5">
                                    <br>
                                    <label for="link">Link</label>
                                    <input id="link" name="link" type="text" maxlength="200">
                                </div>
                                <div class="col s12 m3 l3">
                                    <br>
                                    <label for="urut">Nomor Urut</label>
                                    <input id="urut" name="urut" type="text" maxlength="200">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12">
                                    <br>
                                    <label for="konten"> Deskripsi
                                        <textarea name="konten" class="konten"></textarea>
                                    </label>
                                </div>
                                <div class="input-field col s12">
                                    <button class="btn cyan waves-effect waves-light left" type="submit" name="action">Simpan</button>
                                </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
