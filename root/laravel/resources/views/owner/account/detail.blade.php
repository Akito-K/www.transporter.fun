@extends('layouts.owner')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">荷主 登録情報</h2>

        <div class="account__box">
            <h5 class="account__box__title">基本情報</h5>
            <ul class="lists">
                <li class="list list-title">社名</li>
                <li class="list list-value">{{ $owner_data->company }}</li>
            </ul>
            <ul class="lists">
                <li class="list list-title">スター</li>
                <li class="list list-value">{!! $owner_data->star !!}</li>
            </ul>

            <ul class="lists">
                <li class="list list-title">部署名</li>
                <li class="list list-value">{{ $owner_data->section }}</li>
            </ul>
            <ul class="lists">
                <li class="list list-title">役職</li>
                <li class="list list-value">{{ $owner_data->role }}</li>
            </ul>

            <ul class="lists">
                <li class="list list-title">氏名</li>
                <li class="list list-value">{{ $owner_data->sei }} {{ $owner_data->mei }}</li>
            </ul>

            <ul class="lists">
                <li class="list list-title">郵便番号</li>
                <li class="list list-value">〒 {{ $owner_data->zip1 }}-{{ $owner_data->zip2 }}</li>
            </ul>
            <ul class="lists">
                <li class="list list-title">都道府県</li>
                <li class="list list-value">{{ $prefs[ $owner_data->pref_id ] }}</li>
            </ul>
            <ul class="lists">
                <li class="list list-title">市区町村</li>
                <li class="list list-value">{{ $owner_data->city }}</li>
            </ul>
            <ul class="lists">
                <li class="list list-title">以降の住所</li>
                <li class="list list-value">{{ $owner_data->address }}</li>
            </ul>
            <ul class="lists">
                <li class="list list-title">電話番号</li>
                <li class="list list-value">{{ $owner_data->tel }}</li>
            </ul>
            <ul class="lists">
                <li class="list list-title">サイトURL</li>
                <li class="list list-value">{!! \Func::stringToAnchor( $owner_data->site_url ) !!}</li>
            </ul>
            <ul class="lists">
                <li class="list list-title">メッセージ</li>
                <li class="list list-value">{!! \Func::N2BR( $owner_data->message ) !!}</li>
            </ul>
            <p class="account__box__btn">
                <a href="{{ url('') }}/owner/account/base/edit" class="btn btn-warning account__box__btn btn-sm">基本情報を編集する</a>
            </p>
        </div>

    </div>
</div>

@endsection
