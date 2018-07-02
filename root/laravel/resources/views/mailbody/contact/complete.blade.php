<?php
if( !isset($contacts) || !isset($request_data) ){
    $type =
    $subject =
    $company =
    $section =
    $sei =
    $mei =
    $email =
    $tel =
    $body = 'Test';
}else{
    $type = $contacts[ $request_data['type_id'] ]['type'];
    $subject = $contacts[ $request_data['type_id'] ]['subjects'][ $request_data['subject_id'] ];
    $company = $request_data['company'];
    $section = $request_data['section'];
    $sei = $request_data['sei'];
    $mei = $request_data['mei'];
    $email = $request_data['email'];
    $tel = $request_data['tel'];
    $body = $request_data['body'];
}

?>
@extends('mailbody.layouts.mail')

@section('style')
<style>
.subtitle {
    font-size: 18px;
}
.conf-text {
    padding-left: 16px;
}
</style>
@endsection


@section('content')
    <div class="box">
        <h1 class="center title">お問い合わせをありがとうございました。</h1>
        <p class="body">完了の確認メールを、ご入力頂いたメールアドレス宛に送信しています。<br />
            いただいた内容に関しましては、後日ご回答させていただきますのでお待ちくださいませ。</p>

        <h3 class="subtitle">ご入力内容</h3>
        <p class="conf-text">お問い合わせ種別：{{ $type }}</p>
        <p class="conf-text">お問い合わせ内容：{{ $subject }}</p>
        <p class="conf-text">御社名：{{ $company }}</p>
        <p class="conf-text">部署名：{{ $section }}</p>
        <p class="conf-text">氏　名：{{ $sei }} {{ $mei }} 様</p>
        <p class="conf-text">メールアドレス：{{ $email }}</p>
        <p class="conf-text">電話番号：{{ $tel }}</p>
        <p class="conf-text">お問い合わせ本文：<br />{!! \Func::N2BR( $body ) !!}</p>
    </div>
@endsection
