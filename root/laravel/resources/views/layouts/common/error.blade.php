<!DOCTYPE html>
<html lang="ja" class="page-common">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>エラー</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ env('www_url') }}/assets/js/slick/slick.css">
    <link rel="stylesheet" href="{{ env('www_url') }}/assets/js/slick/slick-theme.css">

    <link href="{{ url('') }}/css/dest/w_style.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

</head>
<body>
    <div id="wrapper">
        @include('include.common.www.header')

        @yield('content')

    </div><!-- #wrapper -->

    @include('include.common.www.footer')
    @include('include.common.www.scripts')

    @yield('script')

</body>
</html>
