<div class="col s12">
    <div class="container">
        <div class="col s12 m12 l12">
            @if ($message = Session::get('warning'))
                <div class="card-alert card gradient-45deg-amber-amber" role ="alert">
                    <div class="card-content white-text">
                        <p style="text-align:center">
                            <i class="material-icons">warning</i> {{$message}}
                        </p>
                    </div>
                </div>
            @endif
            @if ($message = Session::get('success'))
                <div class="card-alert card gradient-45deg-green-teal" role ="alert">
                    <div class="card-content white-text">
                        <p style="text-align:center">
                            <i class="material-icons">check</i>{{$message}}
                        </p>
                    </div>
                </div>
            @endif
            @if ($message = Session::get('error'))
                <div class="card-alert card gradient-45deg-red-pink" role ="alert">
                    <div class="card-content white-text">
                        <p style="text-align:center">
                            <i class="material-icons">error</i>{{$message}}
                        </p>
                    </div>
                </div>
            @endif
            @if ($message = Session::get('info'))
                <div class="card-alert card gradient-45deg-yellow-teal" role ="alert">
                    <div class="card-content white-text">
                        <p style="text-align:center;color: #000000">
                            <i class="material-icons">error</i>{{$message}}
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
