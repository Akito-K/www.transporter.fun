@extends('layouts.common.auth')

@section('content')

<div class="crumb">
    <div class="container">
        <ul>
            <li><a href="/">Home</a></li>
            <li><span>会員ページログイン</span></li>
        </ul>
    </div>
</div>

<div class="page_login page_main">
    <div class="container">

        <article class="content">
            <h1 class="title_style03">会員ページログイン</h1>

            <section class="sec">
                <h1 class="title_style02">会員ページログイン</h1>
                <div class="box_white bd_blue">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="login_form_wrap">
                            <ul>
                                <li>
                                    ログインID：<input id="login_id" type="text" class="form-control" name="login_id" value="{{ old('login_id') }}" required autofocus>
                                </li>

                                <li>
                                    パスワード：<input id="password" type="password" class="form-control" name="password" required>
                                </li>
                            </ul>

                            @if ($errors->has('login_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('login_id') }}</strong>
                                </span>
                            @endif
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif

                            <div class="is_save">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> ログイン状態を保存する
                                </label>
                            </div>
                            <div class="btn_wrap">
                                <button class="btn_style02" type="submit">ログイン</button>
                            </div>
                        </div>
                    </form>

                    <p class="mt30">
                        <a href="{{ route('password.request') }}" class="scroll textlink">ログインID・パスワードを忘れた場合 → </a><br />
                        <a href="{{ url('') }}/signup" class="scroll textlink">新規無料会員登録 → </a>
                    </p>
                </div>
            </section>
        </article>

    </div>

    <div class="totop"><a class="scroll" href="#wrapper"></a></div>

</div><!-- .page_main -->


@endsection
