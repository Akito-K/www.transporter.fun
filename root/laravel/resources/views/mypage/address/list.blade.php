@extends('layouts.mypage')
@section('content')

    <div class="box">
        <div class="box-body">
            <h2 class="page-header">住所情報</h2>

            <div class="address__block">
                <div class="address__boxes">
                    @if(!empty($datas))
                    @foreach($datas as $k => $data)
                    <div class="address__box">
                        <h5 class="address__box__title">住所情報 {!! $k+1 !!}</h5>
                        <div class="address__box-wrap">
                            <ul class="address__lists">
                                <li class="address__list address__list--title">登録名</li>
                                <li class="address__list address__list--value">{{ $data->name }}</li>
                            </ul>
                            <ul class="address__lists">
                                <li class="address__list address__list--title">氏名</li>
                                <li class="address__list address__list--value">{{ $data->sei }} {{ $data->mei }}<span class="address__list__ate">宛</span></li>
                            </ul>
                            <ul class="address__lists">
                                <li class="address__list address__list--title">郵便番号</li>
                                <li class="address__list address__list--value">〒{!! \Func::getZipCode($data) !!}</li>
                            </ul>
                            <ul class="address__lists">
                                <li class="address__list address__list--title">住所</li>
                                <li class="address__list address__list--value">{!! \Func::getAddress($data) !!}</li>
                            </ul>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>

    </div>

    <p><a href="{{ url('') }}/mypage/address/edit" class="btn btn-warning btn-block btn-lg">編集する</a></p>

@endsection
