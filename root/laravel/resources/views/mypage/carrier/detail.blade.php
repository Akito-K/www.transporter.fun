@extends('layouts.mypage')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">運送会社 詳細情報</h2>

        <div class="account__box account__box--carrier">
            <h5 class="account__box__title">基本情報</h5>
            <ul class="lists">
                <li class="list list-title">社名</li>
                <li class="list list-value">{{ $carrier_data->company }}</li>
            </ul>
            <ul class="lists">
                <li class="list list-title">スター</li>
                <li class="list list-value">{!! $carrier_data->star !!}</li>
            </ul>

            <ul class="lists">
                <li class="list list-title">部署名</li>
                <li class="list list-value">{{ $carrier_data->section }}</li>
            </ul>
            <ul class="lists">
                <li class="list list-title">役職</li>
                <li class="list list-value">{{ $carrier_data->role }}</li>
            </ul>

            <ul class="lists">
                <li class="list list-title">担当者名</li>
                <li class="list list-value">{{ $carrier_data->sei }} {{ $carrier_data->mei }}</li>
            </ul>

            <ul class="lists">
                <li class="list list-title">所在地</li>
                <li class="list list-value">{{ \Func::getAddress( $carrier_data ) }}</li>
            </ul>
            <ul class="lists">
                <li class="list list-title">電話番号</li>
                <li class="list list-value">{{ $carrier_data->tel }}</li>
            </ul>
            <ul class="lists">
                <li class="list list-title">サイトURL</li>
                <li class="list list-value">{!! \Func::stringToAnchor( $carrier_data->site_url ) !!}</li>
            </ul>
            <ul class="lists">
                <li class="list list-title">メッセージ</li>
                <li class="list list-value">{!! \Func::N2BR( $carrier_data->message ) !!}</li>
            </ul>
        </div>


        <div class="account__box account__box--carrier">
            <h5 class="account__box__title">車両情報</h5>
            <div class="account__car">
                @if(!empty($car_datas))
                <div class="account__car__block table-scroll-wrap">
                    <table class="account__car__table table-scroll">
                        <tr>
                            <th>No</th>
                            <th>画像</th>
                            <th>車両名称</th>
                            <th>稼働台数</th>
                        </tr>

                        @php $j = 0; @endphp
                        @foreach($car_datas as $car_id => $car_data)
                        @php $j++; @endphp
                        <tr>
                            <td>{{ $j }}</td>
                            <td>
                                {!! \MyHTML::ThumbnailSquare( $car_data->filepath ) !!}
                            </td>
                            <td>{{ $car_data->name }}</td>
                            <td>{{ $car_data->count }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                @endif
            </div>
        </div>

        <div class="account__box account__box--carrier">
            <h5 class="account__box__title">空車情報</h5>
            <div class="account__car">
                @if(!empty($empty_datas))
                <div class="account__car__block table-scroll-wrap">
                    <table class="account__car__table table-scroll">
                        <tr>
                            <th>No</th>
                            <th>任意名</th>
                            <th>車名</th>
                            <th>画像</th>
                            <th>エリア</th>
                            <th>期間</th>
                            <th>台数</th>
                        </tr>

                        @foreach($empty_datas as $k => $empty_data)
                        <tr>
                            <td>{{ $k + 1 }}</td>
                            <td>{{ $empty_data->name }}</td>
                            <td>{{ $car_datas[ $empty_data->car_id ]->name }}</td>
                            <td>
                                {!! \MyHTML::ThumbnailSquare( $car_datas[ $empty_data->car_id ]->filepath ) !!}
                            </td>
                            <td>{{ $area_names[ $empty_data->area_id ] }}</td>
                            <td>
                                {{ $empty_data->start_at->format('y/n/j H:i') }} ～ {{ $empty_data->end_at->format('y/n/j H:i') }}
                            </td>
                            <td>{{ $empty_data->count }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                @endif
            </div>
        </div>

        @if( $carrier_data->carrier_id != \Auth::user()->carrier_id )
        <a href="{{ url('') }}/mypage/board/carrier/{{ $carrier_data->carrier_id }}" class="btn btn-success btn-block btn-sm">運送会社にコンタクト</a>
        @endif


    </div>
</div>

@endsection
