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
            <li><span>トランスポーターになるには</span></li>
        </ul>
    </div>
</div>


<div class="page_transporter page_transporter_carrier page_main page_col2">
    <div class="container">

        <article class="content">
            
            <section class="sec_main">
                <div class="intro_box">
                    <div class="thumb"><img src="{{ env('www_url') }}/assets/images/transporter/carrier/truck.png" alt="" width="207" height="207" srcset="{{ env('www_url') }}/assets/images/transporter/carrier/truck.png 1x,{{ env('www_url') }}/assets/images/transporter/carrier/truck@2x.png 2x"></div>
                    <div class="text_wrap">
                        <p class="text">トランスポーターになるには</p>
                        <p class="text">パーソナルポーターになってお好きな時に気に入った荷物・運搬物の運搬案件だけをお選びいただき、日本中どこへでも運搬・お届けできる！</p>
                        <p class="text f_xsmall">※但し、当サイトは個人様の引越サービス等の運搬・運搬は取り扱っておりません。</p>
                    </div>
                </div>
                <section class="sec" id="service">
                    <h2 class="title_style02">サービスの流れ</h2>
                    <div class="text_wrap">
                        <div class="box_white bd_gray step_box">
                            <div class="step step011 step1"><span>STEP1</span></div>
                            <div class="text_wrap">
                                <h2 class="subtitle mb10">気にいったお好きな物流案件のサービスを見つけよう</h2>
                                <p>物流サービス情報や各種物流サービス情報詳細ページの案件リストからご自身の条件に合うお好みの物流案件を選んでください。</p>
                            </div>
                        </div>
                        <div class="img_center">
                            <img src="{{ env('www_url') }}/assets/images/transporter/carrier/angle_down.png" alt="" width="45" height="25" srcset="{{ env('www_url') }}/assets/images/transporter/carrier/angle_down.png 1x,{{ env('www_url') }}/assets/images/transporter/carrier/angle_down@2x.png 2x">
                        </div>
                        <div class="box_white bd_gray step_box">
                            <div class="step step011 step2"><span>STEP2</span></div>
                            <div class="text_wrap">
                                <h2 class="subtitle mb10">物流案件のサービス情報詳細ページを確認して見積提出しよう</h2>
                                <p>物流サービス情報一覧ページから案件タイトルをクリックするとマイページにログインします。そこから該当案件の「見積提出する」ボタンをクリックしてください。</p>
                            </div>
                        </div>
                        <div class="img_center">
                            <img src="{{ env('www_url') }}/assets/images/transporter/carrier/angle_down.png" alt="" width="45" height="25" srcset="{{ env('www_url') }}/assets/images/transporter/carrier/angle_down.png 1x,{{ env('www_url') }}/assets/images/transporter/carrier/angle_down@2x.png 2x">
                        </div>
                        <div class="box_white bd_gray step_box">
                            <div class="step step011 step3"><span>STEP3</span></div>
                            <div class="text_wrap">
                                <h2 class="subtitle mb10">マイページから荷主様と直接詳細確認・商談しよう</h2>
                                <p>荷主様からコンタクトがあればマイページのコンタクトボード等を活用して案件詳細を荷主様と直接やり取りしていただき確認、問題なければ、発注予約を確定させてください。<br>
                                その際にクレジット決済やコンビニ決済、請求書払いの代金お支払方法は、請求書や領収書の発行等も含め事前に荷主様と確認し合い取り決めしておきましょう。</p>
                            </div>
                        </div>
                        <div class="img_center">
                            <img src="{{ env('www_url') }}/assets/images/transporter/carrier/angle_down.png" alt="" width="45" height="25" srcset="{{ env('www_url') }}/assets/images/transporter/carrier/angle_down.png 1x,{{ env('www_url') }}/assets/images/transporter/carrier/angle_down@2x.png 2x">
                        </div>
                        <div class="box_white bd_gray step_box">
                            <div class="step step011 step4"><span>STEP4</span></div>
                            <div class="text_wrap">
                                <h2 class="subtitle mb10">受注が決まったら指定日時に集荷地点に該当荷物・運搬物の集荷に向かおう</h2>
                                <p>受注確定したら指定された時間に間に合うように、集荷地点に向かってください。その際に必ず「運搬へ向かう」ボタンを押してステータスを変更させてください。</p>
                            </div>
                        </div>
                        <div class="img_center">
                            <img src="{{ env('www_url') }}/assets/images/transporter/carrier/angle_down.png" alt="" width="45" height="25" srcset="{{ env('www_url') }}/assets/images/transporter/carrier/angle_down.png 1x,{{ env('www_url') }}/assets/images/transporter/carrier/angle_down@2x.png 2x">
                        </div>
                        <div class="box_white bd_gray step_box">
                            <div class="step step011 step5"><span>STEP5</span></div>
                            <div class="text_wrap">
                                <h2 class="subtitle mb10">該当荷物・運搬物を運搬・輸送しよう</h2>
                                <p>荷物・運搬物を集荷したら、指定された日時に間に合うように運搬・輸送地点へ向かってください。その際に必ず「輸送中にする」ボタンを押して、ステータスを変更させてください。</p>
                            </div>
                        </div>
                        <div class="img_center">
                            <img src="{{ env('www_url') }}/assets/images/transporter/carrier/angle_down.png" alt="" width="45" height="25" srcset="{{ env('www_url') }}/assets/images/transporter/carrier/angle_down.png 1x,{{ env('www_url') }}/assets/images/transporter/carrier/angle_down@2x.png 2x">
                        </div>
                        <div class="box_white bd_gray step_box">
                            <div class="step step011 step6"><span>STEP6</span></div>
                            <div class="text_wrap">
                                <h2 class="subtitle mb10">該当荷物・運搬物を運搬・輸送完了</h2>
                                <p>運搬・輸送が完了したら、「運搬完了」ボタンを押して、輸送完了を報告してください。</p>
                            </div>
                        </div>
                        <div class="img_center">
                            <img src="{{ env('www_url') }}/assets/images/transporter/carrier/angle_down.png" alt="" width="45" height="25" srcset="{{ env('www_url') }}/assets/images/transporter/carrier/angle_down.png 1x,{{ env('www_url') }}/assets/images/transporter/carrier/angle_down@2x.png 2x">
                        </div>
                        <div class="box_white bd_gray step_box">
                            <div class="step step011 step7"><span>STEP7</span></div>
                            <div class="text_wrap">
                                <h2 class="subtitle mb10">取引完了・レビュー</h2>
                                <p>運搬完了報告後、荷主様から「確認済」となったら取引完了です。<br>
                                取引評価（レビュー）を【良い・どちらでもない・悪い】の3段階から選択ください。</p>
                            </div>
                        </div>

                        <div class="alC mt35 mb30">
                            <a class="btn_style02 btn_style02_large" href="{{ env('www_url') }}/register/#registration">パーソナルポーター（運搬会社様）ご登録はこちら</a>
                        </div>
                    </div>
                </section>

                <section class="sec">
                    <h3 class="title_black">Transporterのパーソナルポーターとは？</h3>
                    <div class="text_wrap">
                        <p>荷物・運搬物を運搬・輸送する運搬会社様を指します。<br>
                        自社の保有する車両や特性を生かし、お客様（荷主企業様）とのコミュニケーションを通じて、ニーズに合った最適な荷物・運搬物の運搬・輸送をご提案、また安心・安全・確実に荷物・運搬物の運搬・輸送するスペシャリストのことです！<br>
                        Transporterでは日本中の運搬会社様がパーソナルポーターとして、ホスピタリティ溢れる運搬サービスを提供し、物流サービスの新しい形を育んでいます。</p>
                        <p><a class="textlink" href="{{ env('help_url') }}/what_transporter/006.php">Transporterの特徴はこちら →</a></p>
                    </div>
                </section>

                <section class="sec" id="expense">
                    <h2 class="title_style02">ご利用にかかる費用</h2>
                    <div class="text_wrap">
                        <p class="title_black f_xlarge mb10">ご登録費用はゼロ　￥0</p>
                        <p class="title_black mb5">14日間無料月額利用料ゼロ！今なら運営スタートキャンペーン実施中！</p>
                        <p>★14日無料トライアル終了後、本登録いただいた先着30名様にスマートアクセサリー“ｃｈｉｐｏｌｏ”をプレゼント！！</p>
                        <div class="alC mt35 mb30">
                            <a class="btn_style02 btn_style02_large" href="{{ env('www_url') }}/transporter/driver/#14free_form">無料お試し14日間のお申込みはこちらから</a>
                        </div>
                        <p>※14日間お試しいただいた後、継続利用をお申し込みいただきますと、有料サービスとなります。<br>
                        14日間のお試し終了後、ご継続いただく際は以下、月額ご利用料金が発生いたします。</p>
                    </div>
                    <table class="separated stripe mb15">
                        <tr><th>積載重量13ｔ以下のトラック便</th><td><p>1ヵ月  6,000円 （税込6,480円）</p></td></tr>
                        <tr><th>積載重量32ｔ以下のトレーラー</th><td><p>1ヵ月 15,000円 （税込16,200円）</p></td></tr>
                        <tr><th>積載重量70ｔ以下のトレーラー</th><td><p>1ヵ月 30,000円 （税込32,400円）</p></td></tr>
                        <tr>
                            <th>200ｔ以下の重量物・その他特殊車両</th>
                            <td>
                                <p class="mb5">1ヵ月 50,000円 （税込54,000円）</p>
                                <small class="f_small">※長尺物運搬・特殊鋼材運搬及びその他特殊大型輸送案件を含みます。</small>
                            </td>
                        </tr>
                    </table>
                    <small class="f_small">※複数車両をお持ちでご登録される場合は一番重量の重いご利用料金をいただきます。<br>
                    ※利用料金は、毎月月末締めでイプシロンのクレジット決済にて請求させていただきます。</small>
                </section>
            </section>

            
        </article>

        @include('include.common.www.side_transporter')

    </div>

    <div class="totop"><a class="scroll" href="#wrapper"></a></div>

</div><!-- .page_main -->

@endsection
