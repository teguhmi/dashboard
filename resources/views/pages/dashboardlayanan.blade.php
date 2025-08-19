<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    @include('panels.biru.head')
    @yield('head')

</head>
@yield('css')
<!-- END: Head-->
{{--<body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 2-columns" data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">--}}
<body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions  2-columns  menu-collapse" data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">
<!-- BEGIN: Header-->
@include('panels.biru.header')
<!-- END: Header-->

<!-- BEGIN: SideNav-->
@include('panels.leftmenulayanan')
<!-- END: SideNav-->

<!-- BEGIN: Page Main-->
@yield('content')

<!-- END: Page Main-->

<!-- BEGIN: Footer-->
@include('panels.biru.footer')
<!-- END: Footer-->
<!-- BEGIN Script-->
@include('panels.biru.scripts')
@yield('script')
{{--<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css">--}}
{{--<script>--}}
{{--    var botmanWidget = {--}}
{{--        aboutText: 'ssdsd',--}}
{{--        frameEndpoint: '/iFrameUrl',--}}
{{--        introMessage: "✋ Hi! I'm form ItSolutionStuff.com"--}}
{{--    };--}}
{{--</script>--}}

{{--<script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>--}}
<!-- END: Script-->
</body>
</html>
