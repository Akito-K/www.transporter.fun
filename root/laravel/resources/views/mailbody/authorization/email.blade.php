@extends('mailbody.layouts.mail')

@section('style')
<style>
</style>
@endsection


@section('content')
    <div class="box">
        <h1 class="center title">メールアドレスの変更申請を受け付けました。</h1>
        <p class="body">申請内容に間違いない場合、これより <span class="bold">{!! env('AUTHORIZATION_LIMIT_HOURS', 24) !!}時間</span> 以内に下記の「認証する」ボタンよりアクセスして、認証を完了してください。</p>

        <p class="center"><a href="http://www.transporter.fun/authorization/{{ $code }}" class="btn btn-auth">認証する</a></p>
    </div>
@endsection
