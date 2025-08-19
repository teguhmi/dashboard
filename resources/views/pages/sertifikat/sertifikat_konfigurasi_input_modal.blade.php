<div id="kegiatanmodal" class="modal">
    <div class="modal-content">
        <div class="col s12 m6 l6">
            <h4 class="card-title">Konfigurasi Sertifikat</h4>
            <div class="modal-content">
                <form role="form" method="POST" action="{{ route('sertifikat.new') }}" id="form" files="true" enctype="multipart/form-data">
                    @csrf
                    <input id="id_sertifikat" name="id_sertifikat" type="hidden" maxlength="50">
                    <div class="row">
                        <div class="input-field col s12">
                            <input placeholder="" id="jenis_kegiatan" name="jenis_kegiatan" type="text" maxlength="50">
                            <label for="jenis_kegiatan">Jenis Kegiatan</label>
                        </div>

                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input placeholder="" id="nama_kegiatan" name="nama_kegiatan" type="text" value="" maxlength="200">
                            <label for="nama_kegiatan">Judul Sertifikat</label>
                        </div>
                    </div>
                    <div class="row">

                        <div class="input-field col m4 s12">
                            <input placeholder="" id="xy_nama" name="xy_nama" type="text"  maxlength="3">
                            <label for="xy_nama">XY Nama</label>
                        </div>
                        <div class="input-field col m4 s12">
                            <input placeholder="" id="xy_sebagai" name="xy_sebagai" type="text"  maxlength="3">
                            <label for="xy_sebagai">XY Sebagai</label>
                        </div>
                        <div class="input-field col m2 s12">
                            {{--<label for="warna">Warna Tulisan</label>--}}
                            <input placeholder="" id="warna" name="warna" type="color" value="#000000" >

                        </div>
                        {{--<div class="input-field col m2 s12">--}}
                            {{--<input placeholder="" type="color" class="form-control form-control-color" id="warnaa" name="warnaa" value="#563d7c" title="Pilih warna tulisan sertifikat">--}}
                        {{--</div>--}}
                    </div>

{{--                    <div class="row">--}}
{{--                        <div class="col m12 s12 file-field input-field">--}}
{{--                            <div class="btn float-left">--}}
{{--                                <span>File</span>--}}
{{--                                <input type="file" name="file" id="file">--}}

{{--                            </div>--}}
{{--                            <div class="file-path-wrapper">--}}
{{--                                <input class="file-path validate" type="text">--}}
{{--                            </div>--}}

{{--                        </div>--}}

{{--                    </div>--}}
                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="uploadtemplate" class="modal">
    <div class="modal-content">
        <div class="col s12 m6 l6">
            <p class="card-title">Upload File Sertifikat</p>
{{--            <div class="modal-content">--}}
                <form role="form" method="POST" action="{{route('sertifikat.uploadtemplate')}}" id="form" files="true" enctype="multipart/form-data">
                    @csrf
                    <input id="mid_sertifikat" name="mid_sertifikat" type="hidden">
                    <div class="row">
                        <div class="col m12 s12 file-field input-field">
                            <div class="btn float-left">
                                <span>File 1</span>
                                <input type="file" name="file_1" id="file_1">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                                <span>File Sisi Depan</span>
                            </div>
                        </div>
                        <div class="col m12 s12 file-field input-field">
                            <div class="btn float-left">
                                <span>File 2</span>
                                <input type="file" name="file_2" id="file_2">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                                <span>File Sisi Belakang (Kosongkan jika tidak ada)</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </form>
{{--            </div>--}}
        </div>
    </div>
</div>
