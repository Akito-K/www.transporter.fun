@extends('layouts.common.auth')
@section('content')

<div class="crumb">
    <div class="container">
        <ul>
            <li><a href="/">Home</a></li>
            <li><span>新規会員登録</span></li>
        </ul>
    </div>
</div>

<div class="page_register page_main page_signup">
    <div class="container">
        <article class="content">

            <section class="sec_form_status mt30" id="registration">
                <h1 class="title_style02">会員登録</h1>
                <div class="status_in">
                    <ul>
                        <li>
                            <span class="step">STEP1</span>
                            <p>Eメール</p>
                        </li>
                        <li>
                            <span class="step">STEP2</span>
                            <p>認証情報</p>
                        </li>
                        <li>
                            <span class="step">STEP3</span>
                            <p>会員情報</p>
                        </li>
                        <li>
                            <span class="step">STEP4</span>
                            <p>内容確認</p>
                        </li>
                        <li class="active">
                            <span class="step">STEP5</span>
                            <p>登録完了</p>
                        </li>
                    </ul>
                </div>
            </section>

            <section class="sec_complete_text">
                <p class="thanks">新規会員登録が完了いたしました。</p>
                <p class="text">ご登録ありがとうございました。<br>完了の確認メールを、ご入力頂いたメールアドレス宛に送信しています。</p>
            </section>

            <section class="sec_form">
                <div class="form_wrap">
                    <div class="button_wrap">
                        <a href="{{ url('') }}/mypage">こちら</a>よりマイページへお進みください。
                    </div>
                </div>
            </section>
        </article>
    </div>
</div>
@endsection
