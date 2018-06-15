@extends('layouts.admin')
@section('content')

    <div class="box">
        <div class="box-body">
            <h2 class="page-header">詳細</h2>

            <div>
                <ul class="lists">
                    <li class="list list-title">ログインID</li>
                    <li class="list list-value">{{ $data->login_id }}</li>
                </ul>
                <ul class="lists">
                    <li class="list list-title">ログインパスワード</li>
                    <li class="list list-value">***</li>
                </ul>
                <ul class="lists">
                    <li class="list list-title">画像</li>
                    <li class="list list-value">
                        <span class="user__cell__img">
                            <span class="my-thumbnail">
                                <span class="my-thumbnail__img" style="background-image: url({!! \Func::getImage($data->icon_filepath) !!});"></span>
                            </span>
                        </span>
                    </li>
                </ul>
                <ul class="lists">
                    <li class="list list-title">表示名</li>
                    <li class="list list-value">{{ $data->name }}</li>
                </ul>

                <ul class="lists">
                    <li class="list list-title">氏名</li>
                    <li class="list list-value">{{ $data->sei }} {{ $data->mei }}</li>
                </ul>
                <ul class="lists">
                    <li class="list list-title">しめい</li>
                    <li class="list list-value">{{ $data->sei_kana }} {{ $data->mei_kana }}</li>
                </ul>

                <ul class="lists">
                    <li class="list list-title">荷主ID</li>
                    <li class="list list-value">{{ $data->owner_id }}</li>
                </ul>
                <ul class="lists">
                    <li class="list list-title">運送会社ID</li>
                    <li class="list list-value">{{ $data->carrier_id }}</li>
                </ul>

                <ul class="lists">
                    <li class="list list-title">メールアドレス</li>
                    <li class="list list-value">{{ $data->email }}</li>
                </ul>
                <ul class="lists">
                    <li class="list list-title">携帯番号</li>
                    <li class="list list-value">{{ $data->mobile }}</li>
                </ul>
                <ul class="lists">
                    <li class="list list-title">電話番号</li>
                    <li class="list list-value">{{ $data->tel }}</li>
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
                <ul class="lists">
                    <li class="list list-title">最終ログイン日時</li>
                    <li class="list list-value">{{ \Func::dateFormat($data->last_logined_at, 'Y/n/j(wday)') }} {{ \Func::dateFormat($data->last_logined_at, 'H:i:s') }}</li>
                </ul>
                <ul class="lists">
                    <li class="list list-title">BAN</li>
                    <li class="list list-value">{{ $data->banned_at }}</li>
                </ul>

            </div>

        </div>
    </div>

    @if(!$data->banned_at)
    <p><a href="{{ url('') }}/admin/user/{!! $data->hashed_id !!}/edit" class="btn btn-warning btn-block btn-lg">編集する</a></p>
    @endif

    <p><a href="{{ url('') }}/admin/user/{!! $data->hashed_id !!}/delete" class="btn btn-danger btn-block btn-sm">削除する</a></p>
    <p><a href="{{ url('') }}/admin/user" class="btn btn-block btn-primary">一覧へ戻る</a></p>

@endsection
