@extends('layouts.common.www')
@section('content')
<section class="sec_visual">
    <div class="container">
        <div class="visual_wrap">
            <div class="visual_thumb"><img src="{{ env('www_url') }}/assets/images/transporter/visual.jpg" alt="" width="1200" height="140" srcset="{{ env('www_url') }}/assets/images/transporter/visual.jpg 1x,{{ env('www_url') }}/assets/images/transporter/visual@2x.jpg 2x"></div>
            <h1 class="visual_title">トランスポーターとは</h1>
        </div>
    </div>
</section>

<div class="crumb">
    <div class="container">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="{{ env('www_url') }}/transporter/">Transporterとは</a></li>
            <li><span>トランスポーター募集</span></li>
        </ul>
    </div>
</div>


<div class="page_transporter page_transporter_driver page_main page_col2">
    <div class="container">

        <article class="content">

            <section class="sec sec_intro">
                <h1 class="title_style03 mb30">トランスポーター募集</h1>
                <p>運搬会社のみなさまへ<br>
                Transporter（トランスポーター）ならお好きな時にお好きな仕事だけを選んで受けられる！<br>
                運搬後の空き車両を活用してもっと稼げる！</p>
            </section>

            <section class="sec">
                <h2 class="title_style02">対象エリア</h2>
                <p>日日本国内全国（一部の離島を除く）が対象エリアです。<br>Transporterは、お客様（荷主様）ニーズに合わせた運搬・輸送を行うサービスです。</p>

                <h3 class="title_black f_large" id="14free">14日間無料トライアル！</h3>
                <div class="clearfix mb20">
                    <div class="img_right">
                        <img src="{{ env('www_url') }}/assets/images/transporter/driver/trial.png" alt="" width="207" height="207" srcset="{{ env('www_url') }}/assets/images/transporter/driver/trial.png 1x,{{ env('www_url') }}/assets/images/transporter/driver/trial@2x.png 2x">
                    </div>
                    <p>新規ご加入の場合、スタート時にかかる費用ゼロ！14日間無料でお試しいただけます！<br>
                    まずは、お試しいただき、サービス内容をご覧いただければ、月々のご利用料金はすぐに元がとれる金額だということをご実感いただけると思います。</p>
                </div>
                <div class="alC mb40">
                    <a class="btn_style02 btn_style02_large scroll" href="#14free_form">無料お試し14日間のお申込みはこちらから</a>
                </div>

                <h4 class="title_black mb10">14日間無料月額利用料ゼロ！今なら運営スタートキャンペーン実施中！</h4>
                <p>★14日間の無料トライアル終了後、本登録いただいた先着30名様に、スマートアクセサリー“ｃｈｉｐｏｌｏ”をプレゼント！！</p>

                <div class="radius_box clearfix mb20">
                    <div class="box_white bd_gray img_right mb0">
                        <img src="{{ env('www_url') }}/assets/images/transporter/driver/chipolo.png" alt="" width="113" height="97" srcset="{{ env('www_url') }}/assets/images/transporter/driver/chipolo.png 1x,{{ env('www_url') }}/assets/images/transporter/driver/chipolo@2x.png 2x">
                    </div>
                    <p class="chipolo"> “ｃｈｉｐｏｌｏ”はスロベニア生まれのスタイリッシュ＆コンパクトなスマートアクセサリーです。
お手持ちのスマートフォンと“ｃｈｉｐｏｌｏ”をペアリングするだけであなたのお探しものをスマートフォンが追跡して見つけてくれちゃいます！！</p>
                </div>
                <small class="f_small">※14日間のお試し終了後、ご利用中止をされない場合には、サービスは自動的に継続されクレジット決済や口座引き落としの場合は自動引き落としされます。</small>
            </section>

            <section class="sec">
                <h2 class="title_style02">Transporterとは</h2>
                <p class="mb10">荷主様と運送会社様がオンラインで直接繋がることで運搬物に適した車両検索の手間を省き、より「安く」、より「早く」、より「安心」して物流案件を依頼できるサービスを開発実現した荷物・運搬物のＢtoＢ向け運搬マッチングサイトです。</p>
                <small class="f_small">※当サイトは個人様の引越サービス等の運搬・輸送は行っておりません。</small>
            </section>

            <section class="sec">
                <h2 class="title_style02">Transporter（トランスポーター）の特徴</h2>
                <p class="mb10">Transporter（トランスポーター）は荷主様（お客様＝企業様）とパーソナルポーター（運送会社様）でサービスの楽しみ方が異なります。以下に主な特徴をあげますが、他にも様々な活用や楽しみ方があるので、ぜひTransporter（トランスポーター）をご活用ください。</p>
                <h3 class="title_inverse mb20">パーソナルポーター（運送会社様）にとっていいこと</h3>
                <p class="title_num">
                    <span class="num">1</span>
                    <span class="text">誰でもパーソナルポーターになれます</span>
                </p>
                <p class="title_num">
                    <span class="num">2</span>
                    <span class="text">上場企業との定例取引チャンスも生まれます！</span>
                </p>
                <p class="title_num">
                    <span class="num">3</span>
                    <span class="text">荷物・運搬物運搬した帰り、空の車両を活かしてパーソナルポーター活動ができます</span>
                </p>
                <p class="title_num">
                    <span class="num">4</span>
                    <span class="text">いつでも、どこでも、新規取引のチャンス到来！</span>
                </p>
                <p class="title_num">
                    <span class="num">5</span>
                    <span class="text">成約までの時間が、とにかく早い！</span>
                </p>
                <p><a class="textlink" href="{{ env('www_url') }}/transporter/">パーソナルポーターになるには →</a></p>
            </section>

        </article>

        @include('include.common.www.side_transporter')

    </div>

    <div class="totop"><a class="scroll" href="#wrapper"></a></div>

</div><!-- .page_main -->

@endsection

@section('script')
<script>
    // ファイルを選ぶとファイル名を表示する
    $('.truck_img_file').on('change', function() {
        var $this = $(this);
        var path = $this.val();
        if (path) $(this.nextElementSibling).find('.truck_img_name').text(path.substr(path.lastIndexOf('\\') + 1));
    });
</script>
@endsection
