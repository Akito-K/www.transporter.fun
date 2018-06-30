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

            <section class="sec_form_status" id="registration">
                <h1 class="title_style02">会員登録</h1>
                <div class="status_in">
                    <ul>
                        <li class="active">
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
                        <li>
                            <span class="step">STEP5</span>
                            <p>登録完了</p>
                        </li>
                    </ul>
                </div>
            </section>

            <section class="sec_form">
                <div class="form_wrap">
                    <form class="form-horizontal" method="POST" action="{{ url('') }}/signup">
                        {{ csrf_field() }}
                        <p class="mt30">メールアドレスを入力してください。</p>

                        <div class="form_groupe">
                            <div class="title">メールアドレス（※半角英数字）<span class="hissu">必須</span></div>
                            <div class="form_parts_box">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="例：mail@transporter.jp">
                            </div>

                            @if ($errors->has('email'))
                            <p class="error_message">必須項目です。メールアドレス（※半角英数字）をご入力ください。</p>
                            @endif
                        </div>

                        <p class="mt30">下記のボタンを押すと本登録用のURLが記載されたメールが届きます。<br />メール内のリンクよりアクセスして、本登録へお進みください。</p>

                        <div class="button_wrap"><button type="submit">本登録用メールを送信する</button></div>
                    </form>
                </div>
            </section>
        </article>
    </div>
</div>

@endsection
