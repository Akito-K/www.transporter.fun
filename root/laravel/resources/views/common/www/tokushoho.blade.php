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
                    <p class="mb25">荷物・運搬物の運送・配送は全て各パーソナルポーター（運送会社様）自身が行っておりますので、直接パーソナルポーター様へご連絡ください。</p>
                    <ol>
                        <li><p class="f_bold mb15">１．役務のび配送代金</p>
                            <ol>
                                <li class="mb25">
                                    <p class="mb10"><span class="f_bold">（1）手数料</span><br>
                                        運送・配送依頼する場合・・・決済システム利用等を含め当サイトからはサイト利用料以外の一切料金はかかりません。</p>
                                    <ul>
                                        <li><a class="textlink" href="{{ env('help_url') }}/qa_inquiry/tp/contents/#001">サイト利用料とは →</a></li>
                                        <li><a class="textlink" href="{{ env('help_url') }}/qa_inquiry/tp/contents/#006">配送料金のお支払いは →</a></li>
                                    </ul>
                                </li>
                                <li class="mb40">
                                    <p class="mb5"><span class="f_bold">（2）当社が掲載している配送案件価格</span><br>
                                        当社が掲載する配送・運送価格は、表示された金額（表示価格/税込み）といたします。
                                        なお、(1)のサイト利用料は別途発生いたしますのでご了承ください。</p>
                                    <small class="f_small">※配送価格は物流案件内容に含めて表示</small>
                                </li>
                            </ol>
                        </li>
                        <li><p class="f_bold mb15">２．運送・配送代金の支払方法と支払時期</p>
                            <ol>
                                <li>
                                    <p class="f_bold mb10">（1）支払方法</p>
                                    <table class="separated stripe mb10">
                                        <tr>
                                            <th>販売価格帯</th>
                                            <td>利用内容によって異なります。</td>
                                        </tr>
                                        <tr>
                                            <th>輸送代金以外に必要な費用</th>
                                            <td>消費税、振込手数料</td>
                                        </tr>
                                        <tr>
                                            <th>商品等の引き渡し時期</th>
                                            <td>本サービス上で予約成立後、予約内容に従い運送サービスが提供されます。</td>
                                        </tr>
                                        <tr>
                                            <th>代金の支払い方法と時期</th>
                                            <td>
                                                <p class="mb10">当社では、以下の方法よりお支払い方法をご選択いただけます。<br>
                                                代金は、ご利用毎の都度払いです（運送・配送サービス終了後のお支払い）</p>
                                                <ul>
                                                    <li>・コンビニ決済</li>
                                                    <li>・クレジットカード（コーポレートカード）</li>
                                                    <li>・請求書払い（法人向け）</li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </table>
                                    <small class="f_xsmall">※ 法人/個人事業主のみご利用いただけます。請求書は、受注確定運送会社様宛に配送完了報告と同時にトランスポーター株式会社ウェブサイト上より発行されます。<br>
                                    また、振込手数料等詳細は荷主様と受注運送会社様にてサイト上内にて予めお取決め願います。<br>
                                    下記URLを参照いただき、ご了承の上お申込みください。<br>
                                    <a class="textlink" href="{{ env('www_url') }}/guide/003">https://www.transporter.fun/guide/003</a></small>
                                </li>
                            </ol>
                        </li>
                    </ol>
                </div>
            </section>
            <section class="sec">
                <h2 class="title_style02">事業者名称</h2>
                <div class="text_wrap">
                    <p>トランスポーター株式会社</p>
                </div>
            </section>
            <section class="sec">
                <h2 class="title_style02">運営責任者</h2>
                <div class="text_wrap">
                    <p>代表取締役社長: 河野 公美</p>
                </div>
            </section>
            <section class="sec">
                <h2 class="title_style02">所在地および連絡先</h2>
                <div class="text_wrap">
                    <p>所在地：兵庫県姫路市白浜町丙152-1<br>
                    TEL：090-6062-1551<br>
                    FAX：079-245-2813<br>
                    営業時間　平日8：30～18：30（土・日・祝日を除く）<br>
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
                    <p>各種物流運搬物のサービス内容によって異なります。</p>
                </div>
            </section>
            <section class="sec">
                <h2 class="title_style02">荷物・運搬物の取引完了代金以外に必要な費用</h2>
                <div class="text_wrap">
                    <p>消費税、振込手数料</p>
                </div>
            </section>
            <section class="sec">
                <h2 class="title_style02">荷物・運搬物の引き渡し時期</h2>
                <div class="text_wrap">
                    <p>本サービス上で予約取引成立後、予約内容に従い運送サービスが提供されます。</p>
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
                    <p>取り扱い運搬物の特性上、不良品という概念は設けません。</p>
                </div>
            </section>

        </article>

        @include('include.common.www.side_about_service')
    </div>
    <div class="totop"><a class="scroll" href="#wrapper"></a></div>

</div><!-- .page_main -->

@endsection
