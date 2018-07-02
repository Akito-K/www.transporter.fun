<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8" />
<title>Transporter</title>

    @include('mailbody.include.style')
    @yield('style')

</head>
<body>

<div class="block">
    @include('mailbody.include.header')

    @yield('content')

    @include('mailbody.include.footer')
</div>

</body>
</html>