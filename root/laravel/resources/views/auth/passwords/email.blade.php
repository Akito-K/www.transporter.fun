@extends('layouts.common.auth')

@section('content')

<div class="crumb">
    <div class="container">
        <ul>
            <li><a href="/">Home</a></li>
            <li><span>ログインID・パスワードを忘れた</span></li>
        </ul>
    </div>
</div>

<div class="page_login page_main">
    <div class="container">

        <article class="content">
            <section class="sec" id="forget_password">
                <h1 class="title_style02">パスワードをリセットする</h1>
                <div class="box_white bd_blue">
                    <p>ログインID・パスワードが分からなくなった場合には、ご登録いただいているメールアドレスへパスワードリセット用のご案内を送ります。<br>ご登録いただいているメールアドレスを入力し、[送信]ボタンをクリックしてください。</p>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>

                    @else
                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        <div class="login_form_wrap">
                            <ul>
                                <li>ご登録メールアドレス：<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required> <button class="sm_send_btn" type="submit">送信</button></li>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </ul>
                        </div>
                    </form>

                    @endif

                    <p>※メールが届かない場合は、<a href="{{ env('help_url') }}/qa_inquiry/tp/contents/#041" class="scroll textlink">こちら</a>をご覧ください。</p>
                </div>
            </section>
        </article>

    </div>

    <div class="totop"><a class="scroll" href="#wrapper"></a></div>

</div><!-- .page_main -->
@endsection
