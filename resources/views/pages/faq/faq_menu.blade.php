@extends('pages.dashboardfaq')
@section('content')
    <div class="row">
        <div class="col s12">
            <div class="container">
                <!-- FAQ -->
                <div class="section" id="faq">
                    <div class="row">
                        <div class="col s12">
                            <div id="faq-search" class="card z-depth-0 faq-search-image center-align p-35">
                                <div class="card-content">
                                    <h5>Frequently asked questions.</h5>
                                    {{--                                    <p class="mb-3">Search our help center for quick answers</p>--}}
                                    {{--                                    <input placeholder="Start typing your search..." id="search-input" type="text"--}}
                                    {{--                                           class="search-box validate white search-circle search-shadow">--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="faq row">
                        <div class="col s12 m6 l3">
                            <a class="black-text" href="https://fhisip.ut.ac.id">
                                <div class="card z-depth-0 orange lighten-3 faq-card">
                                    <div class="card-content center-align">
                                        <i class="material-icons dp48 orange-text">search</i>
                                        <h6><b>FHISIP</b></h6>
                                        {{--                                        <p>Fakultas Hukum, Ilmu Sosial, dan Ilmu Politik</p>--}}
                                        <p>-</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col s12 m6 l3">
                            <a class="black-text" href="https://fkip.ut.ac.id">
                                <div class="card z-depth-0 purple lighten-3 faq-card">
                                    <div class="card-content center-align">
                                        <i class="material-icons dp48 red-text">chat_bubble_outline</i>
                                        <h6><b>FKIP</b></h6>
                                        <p>-</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col s12 m6 l3">
                            <a class="black-text" href="https://feb.ut.ac.id">
                                <div class="card grey lighten-3 faq-card">
                                    <div class="card-content center-align">
                                        <i class="material-icons dp48 green-text">perm_identity</i>
                                        <h6><b>FEB</b></h6>
                                        <p>-</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col s12 m6 l3">
                            <a class="black-text" href="https://fkip.ut.ac.id">
                                <div class="card z-depth-0 blue lighten-3 faq-card">
                                    <div class="card-content center-align">
                                        <i class="material-icons dp48 blue-text">content_copy</i>
                                        <h6><b>FKIP</b></h6>
                                        <p>-</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col s12 m3 l3">
                            <div class="card mt-2">
                                <div class="card-content">
                                    <span class="card-title">Kategori</span>
                                    <div class="category-list">

                                        @if(!empty($kategori))
                                            @foreach($kategori as $data)
                                                <p class="mt-4">
                                                    <a href="{{route('faq.get',['id' => Crypt::encrypt($data->id_faq)])}}">
                                                        <i class="material-icons vertical-text-sub {{$data->icon}}">
                                                            panorama_fish_eye </i>
                                                        {{$data->keterangan}}
                                                    </a>
                                                </p>
                                            @endforeach
                                        @endif
                                    </div>
                                    <span class="card-title mt-10">Media Sosial</span>
                                    @if(!empty($medsos))
                                        @foreach($medsos as $data)
                                            <div class="display-flex">
                                                <div class="mr-4">
                                                    <img height="38" width="38"
                                                         src="../../../app-assets/images/{{$data->icon}}" alt="avatar">
                                                </div>
                                                <div class="pl-0">
                                                    <a href="{{$data->link}}" target="_blank">{{$data->nama_medsos}}</a>
                                                    <p class="text-sm">{{$data->keterangan}}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m9 l9">
                            <ul class="collapsible categories-collapsible">
                                @if(!empty($faq))
                                    @foreach($faq as $data)
                                        <li @if($data->urut == 1) class="active" @endif>
                                            <div class="collapsible-header">Q: {{$data->pertanyaan}}
                                                <i class="material-icons"> keyboard_arrow_right </i>
                                            </div>
                                            <div class="collapsible-body">
                                                <p>{!! html_entity_decode($data->jawaban) !!} </p>

                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
@endsection

<!-- END: Page Main-->
