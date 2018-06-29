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
            <li><a href="{{ env('www_url') }}">Home</a></li>
            <li><span>プライバシーポリシー</span></li>
        </ul>
    </div>
</div>

<div class="page_all page_main page_col2">
    <div class="container">
        <article class="content">

            <h1 class="title_style03 mb25">プライバシーポリシー</h1>
            <section class="sec">
                <h2 class="title_style02">個人情報保護方針</h2>
                <div class="text_wrap">
                    <p class="mb10 alR">制定日：平成30年4月</p>
                    <p>トランスポーター株式会社（以下「当社」といいます）は、「仕組みを変えれば、世界はもっとよくなる」をコンセプトに、サービス事業、物流に関わる情報・サービス事業（以下「各種サービス」）の提供を行っております。<br>
                    当社は各種サービスにおいて、トランスポーターの利用者（以下「ユーザー」といいます）の個人情報を適切に取得、利用、保護し、ユーザーが快適に各種サービスを利用できるよう、個人情報を正確に取り扱います。個人情報の取り扱いに関する法令、国が定める指針、その他規範、社内規則を遵守します。また、個人情報の取り扱いに関する社内規程、およびそれを実行するための組織体制について、継続的に見直し、その改善に努めます。<br>
                    当社は、すべての事業で取り扱う個人情報に関して、個人情報保護に関する法令、国が定める指針およびその他の規範を遵守するため、日本工業規格「個人情報保護マネジメントシステム‐要求事項」（JIS Q 15001）に準拠した個人情報保護マネジメントシステムの策定を目指し、適切に運用いたします。<br>
                    当社は、事業の内容及び規模を考慮し、個人情報を取得する場合には、事前に利用目的及び提供の有無を明確にし、ユーザーの同意を得た上で、目的の範囲内において適切に利用し、目的外利用を行わないための措置を講じます。<br>
                    当社は、個人情報をユーザーの同意を得た場合及び法令に基づく場合などを除いて、第三者に提供いたしません。また、個人情報の取り扱いの全部または一部を委託する場合には、十分な保護水準を満たした委託先を選定し、契約等により適切な措置を講じます。<br>
                    当社は、個人情報の漏えい、滅失、または毀損等を予防するための合理的な安全対策および是正措置を講じます。<br>
                    当社は、個人情報の取扱い及び当社の個人情報保護マネジメントシステムに関して、ユーザーからの苦情及び相談を受け付けて、適切な対応を行います。<br>
                    当社は、個人情報保護マネジメントシステムを継続的に見直し改善いたします。</p>
                </div>
            </section>
            <section class="sec">
                <h2 class="title_style02">お問い合わせ窓口</h2>
                <div class="text_wrap">
                    <p>ハリマニックス株式会社　個人情報保護相談窓口<br>
                    〒676-0022 兵庫県高砂市高砂町浜田町1丁目7-28<br>
                    電話番号：079-443-5577<br>
                    （受付時間　平日8：30～17：30（土・日・祝日を除く））<br>
                    メールアドレス：info@transporter.fun</p>
                </div>
            </section>
        </article>

        @include('include.common.www.side_about_service')

    </div>
    <div class="totop"><a class="scroll" href="#wrapper"></a></div>

</div><!-- .page_main -->

@endsection
