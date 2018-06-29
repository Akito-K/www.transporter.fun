@extends('layouts.common.www')
@section('content')

<div class="crumb">
    <div class="container">
        <ul>
            <li><a href="/">Home</a></li>
            <li><span>空車情報一覧</span></li>
        </ul>
    </div>
</div>

<div class="page_safety page_main">
    <div class="container">

        <article class="content">
            
            <section class="sec">
                <h1 class="title_style03">あんしんへの取り組み</h1>
                <h2 class="title_style02">Transporterのあんしんへの取り組み</h2>
                <p>Transporterでは、荷主様（お客様）と全てのパーソナルポーター（運送会社様）安心して物流案件をお取引いただくために様々な様々な取り組みや機能を提供しています。<br>
                    また、今まで培ってきた運送ノウハウを生かし様々な事態に対応できるような専門機関として「Transporter安心安全委員会」を設置し、より一層ご安全に安心してお取引できるよう努めてまいります。</p>
            </section>
            
            <section class="sec">
                <h2 class="title_style02">Transporter安心安全委員会によるパトロールの実施</h2>
                <p>取引の公平性や運送・配送の質を維持するため、委員会による荷物・運搬物チェックやパーソナルポーターのチェックを行っております。 問題の起こりそうな荷物・運搬物や、トラブルの多い会員に対してはTransporterの利用停止措置を行っております。</p>
                <ol class="list_decimal">
                    <li>新規登録パーソナルポーターの基本情報登録内容をチェックしTransporterの定める条件に満たない場合は登録を許可せず削除いたします。</li>
                    <li>荷物・運搬物内容をランダムにチェックし引っ越しによる運送などTransporterの定める条件に満たない案件は即時削除いたします。</li>
                    <li>随時、取引の評価、クレーム発生をチェック。</li>
                    <li>違法なランキング操作や取引のチェック。</li>
                </ol>
            </section>
            
            <section class="sec">
                <h2 class="title_style02">プレミアムポーター制度</h2>
                <p>Transporterには、安心してお取引いただけるようTransporter公認のプレミアムポーターがいます。<br>
                    初めてTransporterをご利用される方、ネットでのお取引が不安な方は、プレミアムポーターからの荷物・運搬物の運送・配送をおススメします。</p>
                <p><a class="textlink" href="{{ env('www_url') }}/transporter/premium.php">プレミアムポーターについて詳しくはこちら  →</a></p>
            </section>
            
            <section class="sec">
                <h2 class="title_style02">後払い決済</h2>
                <p>お客様（荷主様）に荷物・運搬物が届き、その内容を確認後、サイト上で到着通知（取引を完了）をすることで、取引完了となりお支払いが確定します。 運搬物の到着確認することができるため、「荷物・運搬物が届かない」「荷物・運搬物内容や運送時間が全く違う」などの 不安やトラブルの場合でも、代金の持ち逃げをされることがありません。 お取引がキャンセルとなった場合、クレジットカードの場合は与信が解除され、現金で振り込まれた方はお客様の口座へ全額返金致します。</p>
                <p><a class="textlink" href="{{ env('help_url') }}/what_transporter/021.php">Transporterの安心・安全決済システムについて詳しくはこちら  →</a></p>
            </section>
            
            <section class="sec">
              <h2 class="title_style02">Transporter安心安全委員会とは</h2>
                <div class="img_right"><img src="{{ env('www_url') }}/assets/images/safety/thumb01.jpg" alt="安心安全委員会" width="280" height="200" srcset="{{ env('www_url') }}/assets/images/safety/thumb01.jpg 1x,{{ env('www_url') }}/assets/images/safety/thumb01@2x.jpg 2x"></div>
                <p>Transporter安心安全委員会 Transporter上の商品、取引における安心、安全、公平性を保つための特別に設けられた委員会です。今まで の培ったノウハウを生かしトラブルを防止するための日々の監視やパトロール、各種保証制度における調査・解決を専門に扱う機関となり、トラブル発生時には早期解決が図れるよう努めてまいります。 安心して荷物・運搬物のお取引にご活用ください。</p>
            </section>
            
            <section class="sec">
                <h2 class="title_style02">適切な個人情報の管理</h2>
                <p>Transporterでは、お客様の個人情報を守るため、システム保守に万全を期しています。また、今後も、日々システム保守に努め、安全で安心して気持ちよく運送のお取引ができる環境を提供できるよう努めて参ります。</p>
                <p><a class="textlink" href="{{ env('www_url') }}/privacypolicy/">プライバシーの考え方について詳しくはこちら  →</a></p>
            </section>
            
        </article>

    </div>
    <div class="totop"><a class="scroll" href="#wrapper"></a></div>

</div><!-- .page_main -->

@endsection
