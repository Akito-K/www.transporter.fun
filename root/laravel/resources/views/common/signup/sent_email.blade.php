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

            <section class="sec">
                <h2 class="title_style02">下記の件名でメールを送信しております。ご確認ください。</h2>
                <div class="mb50 ml20">
                    <p>件名：【トランスポーター】アカウント発行手続きのご案内</p>
                </div>

                <h2 class="title_style02">トランスポーターの本登録はまだ完了しておりません。</h2>
                <div class="mb50 ml20">
                    <p>ご入力頂いたメールアドレスに本登録のご案内メールをお送りしましたので、続いて認証情報の入力をお願いいたします。</p>
                </div>

                <h2 class="title_style02">今後の流れ</h2>
                <div class="mb50 ml20">
                    <p class="title_style--child">・メールの確認</p>
                    <p class="ml10">入力されたメールアドレスにメールが届いているかご確認ください。<br />※メールがとどかない場合はサポートページをご確認ください。</p>

                    <p class="title_style--child">・メール本文のアカウント登録ボタンをクリック</p>
                    <p class="ml10">アカウント登録ボタンをクリックし、本登録ページにアクセスしてください。</p>

                    <p class="title_style--child">・お客様情報の登録</p>
                    <p class="ml10">お客様情報の登録ページにて必要事項をご入力ください。</p>
                </div>

            </section>
        </article>
    </div>
</div>

@endsection

