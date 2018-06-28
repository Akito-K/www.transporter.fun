@extends('layouts.common.auth')

@section('content')

<div class="crumb">
    <div class="container">
        <ul>
            <li><a href="/">Home</a></li>
            <li><span>パスワードリセット</span></li>
        </ul>
    </div>
</div>

<div class="page_register page_main">
    <div class="container">

        <article class="content">
            <section class="sec_form">
                <div class="form_wrap">

                    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="token" value="{{ $token }}">

                        <p class="mt30">確認のため再度メールアドレスと、新しいパスワードを入力してください。</p>

                        <div class="form_groupe">
                            <div class="title">メールアドレス（※半角英数字）<span class="hissu">必須</span></div>
                            <div class="form_parts_box">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
                            </div>
                            @if ($errors->has('email'))
                            <p class="error_message">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                        <div class="form_groupe">
                            <div class="title">パスワード<span class="hissu">必須</span></div>
                            <div class="form_parts_box">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>

                            @if ($errors->has('password'))
                            <p class="error_message"><strong>{{ $errors->first('password') }}</strong></p>
                            @endif
                        </div>
                        <div class="form_groupe">
                            <div class="title">パスワード（※再入力）<span class="hissu">必須</span></div>
                            <div class="form_parts_box">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>

                            @if ($errors->has('password_confirmation'))
                            <p class="error_message"><strong>{{ $errors->first('password_confirmation') }}</strong></p>
                            @endif
                        </div>

                        <div class="button_wrap"><button type="submit">パスワードを再設定する</button></div>
                    </form>
                </div>
            </section>
        </article>

    </div>

</div><!-- .page_main -->
@endsection
