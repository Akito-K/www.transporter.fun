@extends('layouts.common.www')
@section('content')

<div class="header_about_service">
    <div class="container">
        <span>サービスについて</span>
    </div>
</div>

<div class="crumb">
    <div class="container">
        <ul>
            <li><a href="/">Home</a></li>
            <li><span>特定商取引法について</span></li>
        </ul>
    </div>
</div>

<div class="page_all page_main page_col2">
    <div class="container">

        <article class="content">

            <h1 class="title_style03 mb25">特定商取引法について</h1>
            <section class="sec">
                <h2 class="title_style02">特定商取引法に関する表記</h2>
                <div class="text_wrap">
                    <p class="mb25">荷物・運搬物の運送・配送は全て各運送会社様自身が行っておりますので、直接運送会社様へご連絡ください。</p>
                </div>
            </section>
            <section class="sec">
                <h2 class="title_style02">事業者名称</h2>
                <div class="text_wrap">
                    <p>トランスポーター株式会社</p>
                </div>
            </section>
            <section class="sec">
                <h2 class="title_style02">運営会社</h2>
                <div class="text_wrap">
                    <p>ハリマニックス株式会社<br>
                    <small class="f_small">※ハリマニックス株式会社はトランスポーター株式会社より運営を委託されています。</small></p>
                </div>
            </section>
            <section class="sec">
                <h2 class="title_style02">運営責任者</h2>
                <div class="text_wrap">
                    <p>菱田 好美</p>
                </div>
            </section>
            <section class="sec">
                <h2 class="title_style02">所在地および連絡先</h2>
                <div class="text_wrap">
                    <p>所在地：兵庫県高砂市高砂町浜田町1丁目7-28<br>
                    TEL：079-443-5577<br>
                    営業時間　平日8：30～17：30（土・日・祝日を除く）<br>
                    Mail: <a class="textlink" href="mailto:info@transporter.fun">info@transporter.fun</a></p>
                </div>
            </section>
            <section class="sec">
                <h2 class="title_style02">お問い合わせ</h2>
                <div class="text_wrap">
                    <p class="mb10">下記メールアドレスへ直接ご連絡いただくか、お問い合わせフォームからご連絡ください。<br>
                    ・Transporterカスタマーサポート：<a class="textlink" href="mailto:info@transporter.fun">info@transporter.fun</a><br>
                    ・お問い合わせフォーム：<a class="textlink" href="{{ env('www_url') }}/contact/">https://www.transporter.fun/contact/</a></p>
                    <small class="f_small">※Transporterカスタマーサポート：info@transporter.fun ※【@ transporter.fun】からのメールを受信できるようご確認ください。</small>
                </div>
            </section>
            <section class="sec">
                <h2 class="title_style02">サービス名</h2>
                <div class="text_wrap">
                    <p>Transporter（トランスポーター）</p>
                </div>
            </section>
            <section class="sec">
                <h2 class="title_style02">取引価格帯</h2>
                <div class="text_wrap">
                    <p>ご利用プランにより異なります。</p>
                </div>
            </section>
            <section class="sec">
                <h2 class="title_style02">サービス利用料以外に必要な費用</h2>
                <div class="text_wrap">
                    <p>消費税</p>
                </div>
            </section>
            <section class="sec">
                <h2 class="title_style02">商品(サービス)の引き渡し時期</h2>
                <div class="text_wrap">
                    <p>当サイト所定の手続き終了後、直ちにご利用いただけます。</p>
                </div>
            </section>
            <section class="sec">
                <h2 class="title_style02">代金の支払い方法と時期</h2>
                <div class="text_wrap">
                    <p class="mb10">当社では、以下の方法よりお支払い方法を選択いただけます。<br>
                    代金は、ご利用毎の都度払いです（運搬物の運送・配送サービス終了後のお支払い）</p>
                    <ul class="mb10 pl1">
                        <li>・コンビニ決済（上限：1回のお取引が30万円まで）</li>
                        <li>・クレジットカード（上限：1回のお取引が1,000万円まで）</li>
                        <li>・請求書払い（法人向け）</li>
                    </ul>
                    <small class="f_small">※個別のお取引に関するお問い合わせや、荷主様からのお問い合わせは、こちらの電話窓口ではご案内できません。<br>
                    ※荷物・運搬物の運送・配送は全てパーソナルポーターが行っているため、荷物・運搬物に関するお問い合わせ(在庫や発送状況など)は直接パーソナルポーターにご連絡ください。<br>
                    パーソナルポーターの氏名または運送会社名称、住所及び電話番号の情報開示をご希望の場合、販売者開示申請書に必要事項を記入いただき、返信用封筒に切手を貼って同封の上、下記の住所へご郵送ください。<br>
                    ※特定商取引法上の取引事業者に該当しない場合は、開示を控えさせていただく場合がございます。予めご了承ください。</small>
                </div>
            </section>
            <section class="sec">
                <h2 class="title_style02">返品の取扱条件</h2>
                <div class="text_wrap">
                    <p>・取り扱い運搬物の特性上、返品・交換は不可能です。<br>
                    ・当日キャンセル等連絡をせずに当該サービスを利用しなかった場合は、直接お取引した運送会社様に全額支払いが必要となります。<br>
                    ・キャンセルについては利用前日まではキャンセル可能。<br>
                    予約確定済みかつ、当日キャンセルの場合は1台あたりキャンセル料金3,000円が発生します。</p>
                </div>
            </section>
            <section class="sec">
                <h2 class="title_style02">不良品の取扱条件</h2>
                <div class="text_wrap">
                    <p>サービスの特性上、不良品という概念は設けません。</p>
                </div>
            </section>

        </article>

        @include('include.common.www.side_about_service')
    </div>
    <div class="totop"><a class="scroll" href="#wrapper"></a></div>

</div><!-- .page_main -->

@endsection
