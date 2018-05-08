@extends('layouts.mypage')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">住所情報</h2>

        <div class="address__block">

            <div class="address__box">
                <div class="address__box-wrap">
                    <ul class="lists">
                        <li class="list list-title">登録名</li>
                        <li class="list list-value">{{ $data->name }}</li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">氏名</li>
                        <li class="list list-value">{{ $data->sei }} {{ $data->mei }}<span class="list__ate"> 宛</span></li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">郵便番号</li>
                        <li class="list list-value">〒 {{ $data->zip1 }} - {{ $data->zip2 }}</li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">都道府県</li>
                        <li class="list list-value">{{ $prefs[ $data->pref_code ] }}</li>
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
                        <li class="list list-title">電話番号</li>
                        <li class="list list-value">{{ $data->tel }}</li>
                    </ul>
                </div>
            </div>

            <p>
                <a href="{{ url('') }}/mypage/address/{{ $data->address_id }}/edit" class="btn btn-block btn-warning"><i class="fa fa-edit"></i> 編集</a>

                @if( $data->name != '登録住所')
                <a href="{{ url('') }}/mypage/address/{{ $data->address_id }}/delete" class="btn btn-block btn-danger"><i class="fa fa-trash"></i> 削除</a>
                @endif

                <a href="{{ url('') }}/mypage/address" class="btn btn-block btn-primary">一覧へ戻る</a>
            </p>
        </div>

    </div>
</div>
@endsection
