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

    <title>トランスポーター</title>

    <!-- Styles -->
<?php /*
    <link rel="stylesheet" href="{{ env('www_url') }}/assets/css/style.css">
*/ ?>
    <link href="{{ url('') }}/css/dest/w_style.css" rel="stylesheet">
    <link href="{{ url('') }}/css/dest/style.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script type="text/javascript" src="https://ajaxzip3.github.io/ajaxzip3.js" charset="utf-8"></script>

</head>
<body>
    @include('include.common.www.tagmanager')
    <div id="wrapper">
        @include('include.common.auth.header')

        @yield('content')

    </div><!-- #wrapper -->


    @include('include.common.auth.footer')
    @include('include.common.auth.scripts')

</body>
</html>
