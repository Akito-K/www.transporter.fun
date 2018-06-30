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
                        <li class="active">
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
                    <form class="form-horizontal" method="POST" action="{{ url('') }}/signup/insert">
                        {{ csrf_field() }}
                        <input type="hidden" name="signup_key" value="{{ $signup_key }}">

                        <p class="mt30">氏名を入力して、ログインID・パスワードをご設定ください。</p>

                        <div class="form_groupe">
                            <div class="title">メールアドレス</div>
                            <div class="form_parts_box">
                                <p class="conf_text">{{ $email }}</p>
                            </div>
                        </div>

{!! MyHTML::errorMessage($errors) !!}
{!! MyHTML::flashMessage() !!}

                        <div class="form_groupe">
                            <div class="title">氏名<span class="hissu">必須</span></div>
                            <div class="form_parts_box form_parts_box--double">
                                <input id="sei" type="text" class="form-control" name="sei" value="{!! old('sei')?: $data->sei !!}" required autofocus placeholder="例：菱田">
                                <input id="mei" type="text" class="form-control" name="mei" value="{!! old('mei')?: $data->mei !!}" required autofocus placeholder="例：好美">
                            </div>
                        </div>

                        <div class="form_groupe">
                            <div class="title">しめい（かな）<span class="hissu">必須</span></div>
                            <div class="form_parts_box form_parts_box--double">
                                <input id="sei_kana" type="text" class="form-control" name="sei_kana" value="{!! old('sei_kana')?: $data->sei_kana !!}" required autofocus placeholder="例：ひしだ">
                                <input id="mei_kana" type="text" class="form-control" name="mei_kana" value="{!! old('mei_kana')?: $data->mei_kana !!}" required autofocus placeholder="例：よしみ">
                            </div>
                        </div>

                        <div class="form_groupe">
                            <div class="title">ログインID<span class="hissu">必須</span></div>
                            <div class="form_parts_box">
                                <input id="login_id" type="text" class="form-control" name="login_id" value="{!! old('login_id')?: $data->login_id !!}" required placeholder="例：yoshimi-555">
                            </div>
                        </div>

                        <div class="form_groupe">
                            <div class="title">パスワード<span class="hissu">必須</span></div>
                            <div class="form_parts_box">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <p class="mt30">下記のボタンを押して本登録をお続けください。</p>

                        <div class="button_wrap"><button type="submit">次へ</button></div>
                    </form>
                </div>
            </section>
        </article>
    </div>
</div>

@endsection
