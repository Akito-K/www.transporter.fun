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
            <li><span>Transporterとは</span></li>
        </ul>
    </div>
</div>

<div class="page_transporter page_main page_col2">
    <div class="container">

        <article class="content">

            <section class="sec_main">
                <div class="intro_box">
                    <div class="thumb"><img src="{{ env('www_url') }}/assets/images/transporter/thumb_main.png" alt="" width="456" height="215" srcset="{{ env('www_url') }}/assets/images/transporter/thumb_main.png 1x,{{ env('www_url') }}/assets/images/transporter/thumb_main@2x.png 2x"></div>
                    <div class="text_wrap">
                        <p class="text">全てのお客様の想いを運ぶ <br class="pc">運搬物配送マッチングサイト</p>
                        <p class="text">日本の物流をちょっとずつ<br class="pc">変えたい、助けたい<br class="pc">Transporter</p>
                    </div>
                </div>
                <div class="block">
                    <h2 class="title_style02">Transporterとは</h2>
                    <p class="text">Transporterは、荷主様と運送会社様がオンラインで直接繋がることで運搬物に適した車両検索の手間を省き、より「安く」、より「早く」、より「安心」して物流案件を依頼できるサービスを開発実現した荷物・運搬物の荷主となる企業様と運送会社様向けの物流運搬マッチングサイトです。</p>
                    <p class="f_small">※当サイトは個人様向けの引越サービス等の運搬・運搬は一切行っておりません。</p>

                    <p class="link"><a href="{{ env('help_url') }}/what_transporter/001.php">Transporter（トランスポーター）ってどんなサイト？ →</a></p>
                </div>

                <div class="block">
                    <h2 class="title_style02">取扱車両30以上</h2>
                    <div class="thumb"><img src="{{ env('www_url') }}/assets/images/transporter/thumb01.jpg" alt="" width="283" height="215" srcset="{{ env('www_url') }}/assets/images/transporter/thumb01.jpg 1x,{{ env('www_url') }}/assets/images/transporter/thumb01@2x.jpg 2x"></div>
                    <p class="text">当サイトでしか入手できない日本で取り扱っている特殊保有設備車両や国内保有のレアな車両がたくさんそろっています。</p>
                </div>
                <div class="block">
                    <h2 class="title_style02">適正価格でおトクに配送・輸送</h2>
                    <div class="thumb"><img src="{{ env('www_url') }}/assets/images/transporter/thumb02.jpg" alt="" width="283" height="215" srcset="{{ env('www_url') }}/assets/images/transporter/thumb02.jpg 1x,{{ env('www_url') }}/assets/images/transporter/thumb02@2x.jpg 2x"></div>
                    <p class="text">自社にいながら御社のタイミングで御社のニーズに適した車両を適正価格で、お得に運搬・輸送依頼することができます</p>
                </div>
            </section>

            <section class="sec_point">
                <h2 class="subtitle_style02">知っておきたい５つのポイント</h2>
                <div class="block_style01">
                    <div class="thumb"><img src="{{ env('www_url') }}/assets/images/transporter/thumb_point01.jpg" alt="" width="362" height="237" srcset="{{ env('www_url') }}/assets/images/transporter/thumb_point01.jpg 1x,{{ env('www_url') }}/assets/images/transporter/thumb_point01@2x.jpg 2x"></div>
                    <div class="text_wrap num_wrap">
                        <div class="num"><span>1</span></div>
                        <div class="text_content">
                            <h3 class="title">中間マージンをコストカットできるから圧倒的に安い！</h3>
                            <p class="link"><a href="{{ env('www_url') }}/transporter/carrier/">サービスの流れについてもっと見る →　</a></p>
                        </div>
                    </div>
                </div><!-- .block -->
                <div class="block_style01">
                    <div class="thumb"><img src="{{ env('www_url') }}/assets/images/transporter/thumb_point02.jpg" alt="" width="362" height="237" srcset="{{ env('www_url') }}/assets/images/transporter/thumb_point02.jpg 1x,{{ env('www_url') }}/assets/images/transporter/thumb_point02@2x.jpg 2x"></div>
                    <div class="text_wrap num_wrap">
                        <div class="num"><span>2</span></div>
                        <div class="text_content">
                            <h3 class="title">オンラインで日本中のパーソナルポーターがあなたの荷物・運搬物を輸送サポート！</h3>
                            <p class="text">運送会社様もいつでも、どこでも、新規取引のチャンス！</p>
                            <p class="link"><a href="{{ env('www_url') }}/transporter/personal.php">パーソナルポーターについてもっと見る  →　</a></p>
                        </div>
                    </div>
                </div><!-- .block -->
                <div class="block_style01">
                    <div class="thumb"><img src="{{ env('www_url') }}/assets/images/transporter/thumb_point03.jpg" alt="" width="362" height="237" srcset="{{ env('www_url') }}/assets/images/transporter/thumb_point03.jpg 1x,{{ env('www_url') }}/assets/images/transporter/thumb_point03@2x.jpg 2x"></div>
                    <div class="text_wrap num_wrap">
                        <div class="num"><span>3</span></div>
                        <div class="text_content">
                            <h3 class="title">信頼できるパーソナルポーター（運送業者様）と直接やり取りできるから安心・安全！</h3>
                            <p class="link"><a href="{{ env('www_url') }}/register/">会員登録する　→　</a></p>
                        </div>
                    </div>
                </div><!-- .block -->

                <!--
                <div class="block_style01">
                    <div class="thumb"><img src="{{ env('www_url') }}/assets/images/transporter/thumb_point04.jpg" alt="" width="362" height="237" srcset="{{ env('www_url') }}/assets/images/transporter/thumb_point04.jpg 1x,{{ env('www_url') }}/assets/images/transporter/thumb_point04@2x.jpg 2x"></div>
                    <div class="text_wrap num_wrap">
                        <div class="num"><span>4</span></div>
                        <div class="text_content">
                            <h3 class="title">いろいろ選べる決済方法</h3>
                            <ul>
                                <li>クレジットカード（コーポレートカード）</li>
                                <li>コンビニ支払い</li>
                                <li>現金振り込み（請求書払い）</li>
                            </ul>
                            <p class="f_small">※Transporter（トランスポーター）は、荷主様・運送会社様とも会員登録料・入会金一切無料です。<br>荷主様は月会費無料、運送会社様は積載重量13ｔ以下のウイング車・平車：6,000円、積載重量13ｔ以下のトレーラー：15,000円・重量物等特殊車両（10～27ｔ）：15,000円、その他大型特殊輸送案件（27～200ｔ）：30,000円となります。複数の車両種別を保有される運送会社様は一番大きい車両トン数が月会費となります。<br>月額の会費は『カード決済』 のみとなり、クレジットカード決済代行のGMOイプシロン株式会社 の決済代行サービスを利用しております。 ご注文後、イプシロン決済画面へ移動いたしますので決済を完了させてください。 安心してお支払いをしていただくために、お客様の情報がイプシロンサイト経由で送信される際にはSSL(128bit)による暗号化通信で行い、クレジットカード情報は当サイトでは保有せず、同社で厳重に管理しております。</p>
                            <p class="f_small">※物流案件ごとの輸送・運搬のお代金お支払いは、荷主様と運送会社様とで直接やり取りいただき、クレジットカード（コーポレートカード）払い、請求書払いをお選びいただけます。</p>
                            <p class="f_small">※また、別途マイページよりお申込みいただいた会員様だけがご利用いただけるサービスとして「トランスポーター運賃全額保証」をご紹介いたします。</p>
                            <p class="f_small">※詳しくは以下サイトをご参照ください。<br>
                            トラスト＆グロース売掛保証　<a href="https://uriho.jp/" target="_blank">https://uriho.jp/</a></p>
                        </div>
                    </div>
                </div> -->

                <div class="block_style01">
                    <div class="thumb"><img src="{{ env('www_url') }}/assets/images/transporter/thumb_point05.jpg" alt="" width="362" height="237" srcset="{{ env('www_url') }}/assets/images/transporter/thumb_point05.jpg 1x,{{ env('www_url') }}/assets/images/transporter/thumb_point05@2x.jpg 2x"></div>
                    <div class="text_wrap num_wrap">
                        <div class="num"><span>4</span></div>
                        <div class="text_content">
                            <h3 class="title">安心のカスタマーサービス</h3>
                            <p class="text">なにかお困りのときには、いつでもTransporterにお問い合わせください。<br>万全の体制でサポートします。</p>
                            <p class="link"><a href="{{ env('www_url') }}/contact/">お問い合わせはこちら　→　</a></p>
                        </div>
                    </div>
                </div><!-- .block -->
            </section>

        </article>

        @include('include.common.www.side_transporter')

    </div>

    <div class="totop"><a class="scroll" href="#wrapper"></a></div>

</div><!-- .page_main -->

@endsection
