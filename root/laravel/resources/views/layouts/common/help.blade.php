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

    <title>{!! $pagemeta->description !!}：{!! $pagemeta->title !!}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ env('help_url') }}/assets/css/style.css">

<?php /*
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script type="text/javascript" src="https://ajaxzip3.github.io/ajaxzip3.js" charset="utf-8"></script>
*/ ?>

</head>
<body>
    <div id="wrapper">
        @include('include.common.help.header')

        <div class="page_home page_main">

            <article class="content">
                <div class="container">

                    <section class="sec_intro">
                        <div class="title_style01">
                            <div class="inner">
                                <h1 class="sitetitle">総合ご利用ガイド</h1>
                            </div>
                        </div>
                        <p class="cacth">ご利用ガイドを活用して、安心・安全な運搬物運送を。</p>
                        <p class="description">Transporter（トランスポーター）は、自社にいながら日本中の特殊な運搬物を運送したい人と、日本国内に存在するあらゆる運搬物を対象とする運送会社様（パーソナルポーター、プレミアムポーター）をマッチングする日本に広がる新しいカタチの物流運送サービスです。トランスポーターで今まで探しづらかった特殊運搬物を運送する運送会社様を当サイトで簡単に見つけたり、運送会社様が自社の強みを発揮してプレミアムポーターを目指したり、自社の保有車両を必要とする荷主様と、当サイトを通じて出会えたり、ご利用ガイドを活用して、トランスポーターをより使いこなして、今までになかった充実感、楽しさを味わってもらえれば幸いです。</p>
                    </section>

                    <section class="sec_nav">
                        @include('include.common.help.side')
                    </section>
                </div>

            </article>

            <div class="totop"><a class="scroll" href="#wrapper"></a></div>

        </div><!-- .page_main -->

    </div><!-- #wrapper -->


    @include('include.common.help.footer')
    @include('include.common.help.scripts')

</body>
</html>
