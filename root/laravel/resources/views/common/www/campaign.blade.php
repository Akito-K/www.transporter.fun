@extends('layouts.common.www')
@section('content')

<div class="page_home page_main page_campaign">
    <div class="container">
        <article class="content">

            <section class="sec">
                <div class="container">
                    <div class="pos_rel sec_top_half">
                        <div class="pos_rel">
                            <img class="bg_top_half" src="{{ env('www_url') }}/assets/images/campaign/bg_top_half.jpg" alt="" width="1200" height="729" srcset="{{ env('www_url') }}/assets/images/campaign/bg_top_half.jpg 1x,{{ env('www_url') }}/assets/images/campaign/bg_top_half@2x.jpg 2x">
                            <img class="str" src="{{ env('www_url') }}/assets/images/campaign/str.png" alt="運営スタートキャンペーン実施中 14日間月額利用料ゼロ！今ならご成約先着30名様に「chipolo」プレゼント！" width="499" height="367" srcset="{{ env('www_url') }}/assets/images/campaign/str.png 1x,{{ env('www_url') }}/assets/images/campaign/str@2x.png 2x">
                        </div>
                        <div class="box_blue">
                            <h3>14日間無料月額利用料ゼロ！<br>今なら運営スタートキャンペーン実施中！</h3>
                            <p>新規ご加入の場合、スタート時にかかる費用ゼロ！14日間無料でお試しいただけます！<br>まずは、お試しいただき、サービス内容をご覧いただければ、月々のご利用料金はすぐに元がとれる金額だということをご実感いただけると思います。</p>
                            <div class="downwards_arrow_blue">
                                <div class="circled_white">
                                    <span>さらに</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pos_rel sec_bottom_half">
                        <img class="bg_bottom_half" src="{{ env('www_url') }}/assets/images/campaign/bg_bottom_half.jpg" alt="" width="1200" height="983" srcset="{{ env('www_url') }}/assets/images/campaign/bg_bottom_half.jpg 1x,{{ env('www_url') }}/assets/images/campaign/bg_bottom_half@2x.jpg 2x">
                        <div class="sec_middle">
                            <div class="chipolo_box">
                                <h2>14日間の無料トライアル終了後、<br>本登録いただいた先着30名様に、<br>スマートアクセサリー“ｃｈｉｐｏｌｏ”をプレゼント！！</h2>
                                <img class="chipolo" src="{{ env('www_url') }}/assets/images/campaign/chipolo.jpg" alt="" width="439" height="428" srcset="{{ env('www_url') }}/assets/images/campaign/chipolo.jpg 1x,{{ env('www_url') }}/assets/images/campaign/chipolo@2x.jpg 2x">
                                <p>“ｃｈｉｐｏｌｏ”はスロベニア生まれのスタイリッシュ＆コンパクトなスマートアクセサリーです。<br>お手持ちのスマートフォンと“ｃｈｉｐｏｌｏ”をペアリングするだけであなたのお探しものをスマートフォンが追跡して見つけてくれちゃいます！！</p>
                            </div>
                            <div class="proviso">
                                <p class="ti_-1">※14日間のお試し終了後、ご利用中止をされない場合には、サービスは自動的に継続されクレジットにて決済されます。</p>
                            </div>
                        </div>
                        <!--a class="btn_orange" href="{{ env('www_url') }}/signup">無料お試し14日間のお申込みはこちらから →</a-->
                    </div>
                </div>
            </section>

        </article>

    </div>
    <div class="totop"><a class="scroll" href="#wrapper"></a></div>

</div><!-- .page_main -->

@endsection
