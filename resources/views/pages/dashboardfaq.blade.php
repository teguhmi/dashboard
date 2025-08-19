<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    @include('panels.horizontal.head')
    @yield('head')
</head>
<body class="horizontal-layout page-header-light horizontal-menu preload-transitions 2-columns" data-open="click" data-menu="horizontal-menu" data-col="2-columns">
@include('panels.horizontal.header_faq')
<div id="main">
    @yield('content')

    @include('panels.horizontal.footer')
</div>
    @include('panels.horizontal.script')
    @yield('script')
</body>
</html>
