@extends('mailbody.layouts.mail')

@section('style')
<style>
</style>
@endsection


@section('content')
    <div class="box">
        <h1 class="center title">パスワードリセットの申請を受け付けました。</h1>
        <p class="body">申請内容に間違いない場合、これより <span class="bold">{!! env('AUTHORIZATION_LIMIT_HOURS', 24) !!}時間</span> 以内に下記の「パスワードリセット画面へ」よりアクセスして、変更を行ってください。</p>

        <p class="center"><a href="{{ $reset_url }}" class="btn btn-auth">パスワードリセット画面へ</a></p>
    </div>
@endsection
