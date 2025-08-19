<div class="col s12">
    <div class="container vert-align">
        <div class="section">
            <div class="card">
                <div class="card-content">
                    <div class="row center-align" id="gradient-Analytics">
                        <div class="row">
                            <div class="col s12">
                                <div class="col s12 m4 l4 card-width">
                                    <div class="card row gradient-45deg-deep-orange-orange gradient-shadow white-text padding-4 mt-5">
                                        <div class="col s12 card-width center">
                                            <i class="material-icons background-round">add_shopping_cart</i>
                                            <p>Daftar Hadir Kegiatan</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m4 l4 card-width">
                                    <div class="card row gradient-45deg-blue-indigo gradient-shadow white-text padding-4 mt-5">
                                        <div class="col s12 card-width center">
                                            <i class="material-icons background-round">add_shopping_cart</i>
                                            <p>Sertifikat Kegiatan</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m4 l4 card-width center">
                                    @if(file_exists($filepath))
                                        <img onContextMenu="return false;" style="height:3.8cm; width: 2.8cm; object-fit: contain; vertical-align: center"
                                             src="{{secure_url('storage/foto/' . $DPMahasiswa['nim'] .'/'. $DPMahasiswa['nim'] .'_ktm.jpg' . '?t=' . time())}}" alt=""/>
                                    @elseif (!file_exists($filepath))
                                        <img onContextMenu="return false;" style="height:3.8cm; width: 2.8cm; object-fit: contain;" src="{{secure_url('app-assets/images/no_image.png' . '?t=' . time())}}" alt=""/>
                                        {{--                                        <input type="file" name="image" class="image" accept=".jpg, .jpeg">--}}
                                    @endif
                                    @if(!empty($dataLayanan))
                                        @foreach($dataLayanan as $item)
                                            @if($item->id_jenis == '1')
                                                @if($item->status == 'baru' || $item->status =='gagal' )
                                                    @if ($upload == true)
                                                        <form action="{{route('mahasiswa.layanan.upload')}}" method="post" files="true" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="col s12">
                                                                <input type="file" name="image" class="image" accept=".jpg, .jpeg">
                                                                <input type="hidden" value="{{Crypt::encrypt( $DPMahasiswa['nim'])}}" name="nim">
                                                            </div>
                                                        </form>
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach
                                    @else
                                        @if ($upload == true)
                                            <form action="{{route('mahasiswa.layanan.upload')}}" method="post" files="true" enctype="multipart/form-data">
                                                @csrf
                                                <div class="col s12">
                                                    <input type="file" name="image" class="image" accept=".jpg, .jpeg">
                                                    <input type="hidden" value="{{Crypt::encrypt( $DPMahasiswa['nim'])}}" name="nim">
                                                </div>
                                            </form>
                                        @endif
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
