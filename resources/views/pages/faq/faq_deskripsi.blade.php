@extends('pages.dashboardfaq')
@section('head')

@endsection
@section('content')

    <div class="col s12">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
                            <form role="form" method="GET" action="{{ route('faq.deskripsi') }}" id="form">
                                @csrf
                                <div class="row">
                                    <div class="col s12">
                                        <label for="kategori">Kategori FAQ</label>
                                        <input type="hidden" name="jenis" value="getKategori">
                                        <select class="select2 browser-default" name="id" id="id" required>
                                            <option value='' disabled selected></option>
                                            @if (!empty($kategori))
                                                @foreach ($kategori as $data)
                                                    <option value="{{Crypt::encrypt($data->id_faq)}}"> {{$data->keterangan}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="input-field col s12">
                                        <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.faq.faq_deskripsi_dataTabel')
    <div id="deskripsimodal" class="modal">
        <div class="modal-content">
            @include('pages.faq.faq_deskripsi_input')
        </div>
    </div>
    </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('app-assets/vendors/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/advance-ui-modals.js')}}"></script>
    <script>
        tinymce.init({
            selector: 'textarea.jawab',
            entity_encoding: "raw",
            apply_source_formatting: true,
            height: 350,
            plugins: 'lists',
            toolbar: 'undo redo | bold italic | indent outdent | bullist numlist | align | images | emoticicons | link',
            // menu: { tools: { title: 'Tools', items: 'listprops' }},
        })
    </script>
    <script type="text/javascript">
        function edit(id, id_faq, pertanyaan, jawaban, nomorurut, ubah) {

            $('#modal_id').val(id);
            $('#kategori').select2('val', id_faq);
            $('#tanya').val(pertanyaan);
            $('#jawab').html(jawaban);
            $('#nomorurut').val(nomorurut);
            tinymce.activeEditor.setContent(jawaban);
        }

        function baru() {
            $('#modal_id').val('');
            $('#kategori').select2('val', '');
            $('#tanya').val('');
            $('#jawab').html('');
            $('#nomorurut').val('');
            tinymce.activeEditor.setContent('');
        }

        $('#deskripsimodal').on('hidden.bs.modal', function () {
            $('#deskripsimodal form')[0].reset();
        });


    </script>
@endsection
