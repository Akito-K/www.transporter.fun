@extends('mailbody.layouts.mail')

@section('style')
<style>
</style>
@endsection


@section('content')
    <div class="box">
        <h1 class="center title">ご入力頂いたメールアドレス宛てに<br />登録用メールを送りました。</h1>
        <p class="body">申請内容に間違いない場合、これより <span class="bold">{!! env('AUTHORIZATION_LIMIT_HOURS', 24) !!}時間</span> 以内に下記の「本登録ページへ」ボタンよりアクセスして、認証を完了してください。</p>

        <p class="center"><a href="http://www.transporter.fun/signup/{{ $key }}/create" class="btn btn-auth">本登録ページへ</a></p>
    </div>
@endsection
