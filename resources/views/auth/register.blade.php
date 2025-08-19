@extends('pages.dashboarduser')

@section('content')
    <div id="main">
        <div class="row">
            <div class="col s12">
                <div id="basic-form" class="card card card-default scrollspy">
                    <div class="card-content">
                        <h4 class="card-title">Registrasi Pengguna</h4>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="input-field col s2 m2 l2">
                                    <p for="name">UPBJJ</p>
                                    <input id="kodeupbjj" name="kodeupbjj" type="text" value="{{config('app.kode_upbjj')}}" readonly>
                                </div>
                                <div class="input-field col s10 m4 l4">
                                    <p>&ensp;</p>
                                    <input id="upbjj" name="upbjj" type="text" value="{{config('app.upbjj')}}" readonly>
                                </div>

                                <div class="input-field col s12 m6 l6">
                                    <p for="name">Hak Akses</p>
                                    {{--                                    <h7>Hak Akses</h7>--}}
                                    <select class="select2 browser-default validate" name="hakakses" id="hakakses" required>
                                        <option value="admin">Admin</option>
                                        <option value="frontdesk">Frontdesk</option>
                                        <option value="pjw">Penanggung Jawab Wilayah</option>
                                        <option value="user" selected>Pengguna Umum</option>
                                    </select>

                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <p for="name">Nama Pengguna</p>
                                    <input placeholder="" id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                    @enderror
                                </div>
                                <div class="input-field col s12 m6 l6">
                                    <p for="email">{{ __('E-Mail Address') }}</p>
                                    <input placeholder="" id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <p for="password">{{ __('Password') }}</p>
                                    <input placeholder="" id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                    @enderror
                                </div>

                                <div class="input-field col s12 m6 l6">
                                    <p for="password-confirm">{{ __('Confirm Password') }}</p>
                                    <input placeholder="" id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="row">
                                <div class=" switch">
                                    <div class="input-field col s6 l3 m3">
                                        <label>
                                            Off
                                            <input type="checkbox" id="status" name=status checked>
                                            <span class="lever"></span>
                                            On
                                        </label>
                                    </div>
                                </div>

                                <div class="input-field col s6 m3 l3">
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
    </div>
@endsection

