@extends('layouts.mypage')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">荷主として利用開始する</h2>

        <div class="address__block">
            {!! Form::open(['url' => 'mypage/start/owner/execute', 'class' => 'address__box']) !!}
                <div class="address__box-wrap">
                    <ul class="lists">
                        <li class="list list-title">御社名</li>
                        <li class="list list-value">{{ $data['company'] }}</li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">部署</li>
                        <li class="list list-value">{{ $data['section'] }}</li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">役職</li>
                        <li class="list list-value">{{ $data['role'] }}</li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">氏名</li>
                        <li class="list list-value">{{ $user->sei }} {{ $user->mei }} 様</li>
                    </ul>

                    <ul class="lists">
                        <li class="list list-title">郵便番号</li>
                        <li class="list list-value">{{ $data['zip1'] }} - {{ $data['zip2'] }}</li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">都道府県</li>
                        <li class="list list-value">{{ $prefs[ $data['pref_code'] ] }}</li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">市区町</li>
                        <li class="list list-value">{{ $data['city'] }}</li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">以降の住所</li>
                        <li class="list list-value">{{ $data['address'] }}</li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">電話番号</li>
                        <li class="list list-value">{{ $data['tel'] }}</li>
                    </ul>
                </div>

                {!! Form::submit('この内容で利用開始する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
            {!! \Form::close() !!}

            <p><a href="{!! url('') !!}/mypage/start/owner" class="btn btn-primary btn-block">前のページに戻る</a></p>

        </div>
    </div>
</div>

@endsection
