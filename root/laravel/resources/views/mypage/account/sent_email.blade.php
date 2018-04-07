@extends('layouts.mypage')
@section('content')

    <div class="box">
        <div class="box-body">
            <h2 class="page-header">入力されたメールアドレス宛てに認証メールを送りました。</h2>
            <p>これより24時間以内に認証</p>
            <p>URLはメールに載ってる</p>
            <p>URLが途切れてるときはコピペしてね</p>
        </div>
    </div>

    <a href="{{ url('') }}/mypage/account/email" class="btn btn-block btn-primary">再度認証メールを送る</a>

@endsection
