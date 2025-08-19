<!DOCTYPE html>
<html class="loading" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    @include('panels.pelangi.head')
    @yield('head')
</head>
<!-- END: Head-->

<body class="vertical-layout page-header-light vertical-menu-collapsible preload-transitions 2-columns" data-open="click" data-menu="vertical-menu-nav-dark" data-col="2-columns">
{{--<body class="vertical-layout page-header-light vertical-menu-collapsible vertical-gradient-menu preload-transitions 2-columns   " data-open="click" data-menu="vertical-gradient-menu" data-col="2-columns">--}}

<!-- BEGIN: Header-->
@include('panels.pelangi.header')
<!-- END: Header-->
<!-- BEGIN: SideNav-->
@include('panels.leftmenupresensi')
<!-- END: SideNav-->
<!-- BEGIN: Page Main-->

@yield('content')
<!-- END: Page Main-->
<!-- BEGIN: Footer-->
@include('panels.pelangi.footer')
<!-- END: Footer-->
<!-- BEGIN Script-->
@include('panels.pelangi.scripts')
@yield('script')
<!-- END: Script-->
</body>

</html>
