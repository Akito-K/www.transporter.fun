@extends('layouts.mypage')
@section('content')

    <div class="box">
        <div class="box-body">
            <h2 class="page-header">登録状況</h2>

            <div class="status__block">
                <div class="status__box">
                    <ul class="status__lists">
                        <li class="status__list">表示名</li>
                        <li class="status__list">{{ $me->name }}</li>
                    </ul>
                    <ul class="status__lists">
                        <li class="status__list">荷主登録</li>
                        <li class="status__list">無料会員</li>
                    </ul>
                    <ul class="status__lists">
                        <li class="status__list">運送会社登録</li>
                        <li class="status__list">トライアル会員【残り12日】</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
