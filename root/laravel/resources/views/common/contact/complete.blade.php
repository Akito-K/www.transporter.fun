@extends('layouts.common.www')
@section('content')

<section class="sec_visual">
    <div class="container">
        <div class="visual_wrap">
            <div class="visual_thumb"><img src="{{ env('www_url') }}/assets/images/transporter/visual.jpg" alt="" width="1200" height="140" srcset="{{ env('www_url') }}/assets/images/transporter/visual.jpg 1x,{{ env('www_url') }}/assets/images/transporter/visual@2x.jpg 2x"></div>
            <h1 class="visual_title">ヘルプ（カスタマーサポートへのお問い合わせ）</h1>
        </div>
    </div>
</section>

<div class="crumb">
    <div class="container">
        <ul>
            <li><a href="{{ env('www_url') }}">Home</a></li>
            <li><span>ヘルプ（カスタマーサポートへのお問い合わせ）</span></li>
        </ul>
    </div>
</div>

<div class="page_contact page_main">
    <div class="container">

        <article class="content">

            <section class="sec_form_status">
                <div class="status_in">
                    <ul>
                        <li>
                            <span class="step">STEP1</span>
                            <p>入力</p>
                        </li>
                        <li>
                            <span class="step">STEP2</span>
                            <p>確認</p>
                        </li>
                        <li class="active">
                            <span class="step">STEP3</span>
                            <p>完了</p>
                        </li>
                    </ul>
                </div>
            </section>

            <section class="sec_complete_text">
                <p class="thanks">お問い合わせを受付いたしました。</p>
                <p class="text">お問い合わせをありがとうございました。<br>
                    完了の確認メールを、ご入力頂いたメールアドレス宛に送信しています。<br>
                    <br>
                いただいた内容に関しましては、後日ご回答させていただきますのでお待ちくださいませ。</p>
            </section>

            <section class="sec_form">
                <div class="form_wrap">
                    <div class="button_wrap">
                        <a class="button" href="/">TOPページへ</a>
                    </div>
                </div>
            </section>
        </article>

    </div>

    <div class="totop"><a class="scroll" href="#wrapper"></a></div>

</div><!-- .page_main -->

@endsection
