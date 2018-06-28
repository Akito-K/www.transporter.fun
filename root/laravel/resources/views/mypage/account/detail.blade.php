@extends('layouts.mypage')
@section('content')

    <div class="box">
        <div class="box-body">
            <h2 class="page-header">詳細</h2>

            <div class="account__block">
                <div class="account__box">
                    <ul class="lists account__lists">
                        <li class="list list-title account__list">ログインID</li>
                        <li class="list list-value account__list">{{ $data->login_id }}</li>
                    </ul>
                    <ul class="lists account__lists">
                        <li class="list list-title account__list">ログインパスワード</li>
                        <li class="list list-value account__list">***</li>
                    </ul>
                    <ul class="lists account__lists">
                        <li class="list list-title account__list">アイコン</li>
                        <li class="list list-value account__list">
                            <span class="account__thumbnail">
                                <span class="my-thumbnail">
                                    <span class="my-thumbnail__img" style="background-image: url({!! \Func::getImage($data->icon_filepath) !!});"></span>
                                </span>
                            </span>
                        </li>
                    </ul>
                    <ul class="lists account__lists">
                        <li class="list list-title account__list">氏名</li>
                        <li class="list list-value account__list">{{ $data->sei }} {{ $data->mei }}</li>
                    </ul>
                    <ul class="lists account__lists">
                        <li class="list list-title account__list">シメイ</li>
                        <li class="list list-value account__list">{{ $data->sei_kana }} {{ $data->mei_kana }}</li>
                    </ul>
                    <!--ul class="lists account__lists">
                        <li class="list list-title account__list">荷主ID</li>
                        <li class="list list-value account__list">{{ $data->owner_id }}</li>
                    </ul>
                    <ul class="lists account__lists">
                        <li class="list list-title account__list">運送会社ID</li>
                        <li class="list list-value account__list">{{ $data->carrier_id }}</li>
                    </ul-->
                    <ul class="lists account__lists">
                        <li class="list list-title account__list">メールアドレス</li>
                        <li class="list list-value account__list">{{ $data->email }}</li>
                    </ul>

                    <ul class="lists">
                        <li class="list list-title">郵便番号</li>
                        <li class="list list-value">〒 {{ $data->zip1 }} - {{ $data->zip2 }}</li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">都道府県</li>
                        <li class="list list-value">{{ $prefs[ $data->pref_id ] }}</li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">市区町</li>
                        <li class="list list-value">{{ $data->city }}</li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">以降の住所</li>
                        <li class="list list-value">{{ $data->address }}</li>
                    </ul>

                    <ul class="lists account__lists">
                        <li class="list list-title account__list">携帯電話番号</li>
                        <li class="list list-value account__list">{{ $data->mobile }}</li>
                    </ul>
                    <ul class="lists account__lists">
                        <li class="list list-title account__list">固定電話番号</li>
                        <li class="list list-value account__list">{{ $data->tel }}</li>
                    </ul>
                    <ul class="lists account__lists">
                        <li class="list list-title account__list">最終ログイン日時</li>
                        <li class="list list-value account__list">{{ \Func::dateFormat($data->last_logined_at, 'Y/n/j(wday)') }} {{ \Func::dateFormat($data->last_logined_at, 'H:i:s') }}</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <p><a href="{{ url('') }}/mypage/account/edit" class="btn btn-warning btn-block">編集する</a></p>

@endsection
