
<div id="kegiatanmodal" class="modal">
    <div class="modal-content">
        <div class="col s12 m6 l6">
            <h4 class="card-title">Konfigurasi Sertifikat</h4>
            <div class="modal-content">
                <form role="form" method="POST" action="{{ route('sertifikat.new') }}" id="form" files="true" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="jenis_kegiatan" name="jenis_kegiatan" type="text" value="" maxlength="50">
                            <label for="jenis_kegiatan">Jenis Kegiatan</label>
                        </div>

                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="nama_kegiatan" name="nama_kegiatan" type="text" value="" maxlength="200">
                            <label for="nama_kegiatan">Judul Sertifikat</label>
                        </div>
                    </div>
                    <div class="row">

                        <div class="input-field col m4 s12">
                            <input id="xy_nama" name="xy_nama" type="text" value="240" maxlength="3">
                            <label for="xy_nama">XY Nama</label>
                        </div>
                        <div class="input-field col m4 s12">
                            <input id="xy_sebagai" name="xy_sebagai" type="text" value="320" maxlength="3">
                            <label for="xy_sebagai">XY Sebagai</label>
                        </div>
                        <div class="input-field col m4 s12">
                            <input id="warna" name="warna" type="text" value="#00000" max="10">
                            <label for="warna">Warna Tulisan</label>
                        </div>

                    </div>
                    {{--<div class="row">--}}
                        {{--<div class="input-field col m4 s12">--}}
                            {{--<label for="date-demo1">Tanggal Buka</label>--}}
                            {{--<input placeholder="yyyy-mm-dd" id="tanggal_buka" name="tanggal_buka" type="date" class="">--}}
                        {{--</div>--}}
                        {{--<div class="input-field col m4 s12">--}}
                            {{--<label for="date-demo1">Tanggal tutup</label>--}}
                            {{--<input placeholder="yyyy-mm-dd" id="tanggal_tutup" name="tanggal_tutup" type="date" class="">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="row">--}}
                        {{--<div class="input-field col m4 s12">--}}
                            {{--<input placeholder="00:00" id="time-demo" name="jam_buka" type="text" class="">--}}
                            {{--<label for="time-demo">Time</label>--}}
                        {{--</div>--}}
                        {{--<div class="input-field col m4 s12">--}}
                            {{--<input placeholder="00:00" id="time-demo2" name="jam_tutup" type="text" class="">--}}
                            {{--<label for="jam_tutup">Jam Tutup</label>--}}
                        {{--</div>--}}

                    {{--</div>--}}
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
