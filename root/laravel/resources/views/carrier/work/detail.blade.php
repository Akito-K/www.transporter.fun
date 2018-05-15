@extends('layouts.carrier')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">見積依頼詳細</h2>

        <div class="order__block">
            <div class="order__boxes">

                <h4 class="order__box__title trigAccordOrderBox" data-open="1">基本情報</h4>
                <div class="order__box bulletAccordOrderBox">
                    <ul class="lists">
                        <li class="list list-title must">案件名</li>
                        <li class="list list-value">{{ $data->name }}</li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">案件クラス</li>
                        <li class="list list-value">{{ $data->carrier_class }}</li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">荷主名</li>
                        <li class="list list-value">{!! $data->owner_with_star !!}</li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">発送予定日時</li>
                        <li class="list list-value">
                            {!! \Func::dateFormat($data->send_at, 'Y/n/j(wday)') !!}
                            {{ $data->send_timezone_str }}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">到着予定日時</li>
                        <li class="list list-value">
                            {!! \Func::dateFormat($data->arrive_at, 'Y/n/j(wday)') !!}
                            {{ $data->arrive_timezone_str }}
                        </li>
                    </ul>
                </div>

                <h4 class="order__box__title trigAccordOrderBox" data-open="1">発送元</h4>
                <div class="order__box bulletAccordOrderBox">
                    @include('include.address.confirm', ['prefix' => 'send_'])
                </div>

                <h4 class="order__box__title trigAccordOrderBox" data-open="1">配送先</h4>
                <div class="order__box bulletAccordOrderBox">
                    @include('include.address.confirm', ['prefix' => 'arrive_'])
                </div>

                <h4 class="order__box__title trigAccordOrderBox" data-open="1">運搬物</h4>
                <div class="order__box bulletAccordOrderBox">
                    <ul class="lists">
                        <li class="list list-title">品名</li>
                        <li class="list list-value">{{ $data->cargo_name }}</li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">寸法（mm）</li>
                        <li class="list list-value">
                            <ul class="params">
                                <li class="param param-10">L: </li>
                                <li class="param param-40">{{ $data->cargo_size_L }} mm</li>
                                <li class="param param-10">W: </li>
                                <li class="param param-40">{{ $data->cargo_size_W }} mm</li>
                                <li class="param param-10">H: </li>
                                <li class="param param-40">{{ $data->cargo_size_H }} mm</li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">個数（個）</li>
                        <li class="list list-value">{{ $data->cargo_count }} 個</li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">重量（kg）</li>
                        <li class="list list-value">{!! number_format($data->cargo_weight) !!} kg/個</li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">総重量（kg）</li>
                        <li class="list list-value">
                            {!! number_format($data->cargo_count * $data->cargo_weight) !!} kg
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">荷姿</li>
                        <li class="list list-value">{{ $data->cargo_form }}</li>
                    </ul>
                </div>

                <h4 class="order__box__title trigAccordOrderBox" data-open="1">希望車種</h4>
                <div class="order__box bulletAccordOrderBox">
                    <ul class="lists">
                        <li class="list list-title">希望車種</li>
                        <li class="list list-value">{{ $data->order_request_results->car }}</li>
                    </ul>
                </div>

                <h4 class="order__box__title trigAccordOrderBox" data-open="1">オプション装備</h4>
                <div class="order__box bulletAccordOrderBox">
                    <ul class="lists">
                        <li class="list list-title">オプション設備</li>
                        <li class="list list-value">{{ $data->order_request_results->equipment }}</li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">オプションその他</li>
                        <li class="list list-value">{{ $data->order_request_results->other }}</li>
                    </ul>
                </div>

                <h4 class="order__box__title trigAccordOrderBox" data-open="1">その他</h4>
                <div class="order__box bulletAccordOrderBox">
                    <ul class="lists">
                        <li class="list list-title">特記事項</li>
                        <li class="list list-value">
                            {!! \Func::N2BR( $data->notes ) !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">希望の価格帯</li>
                        <li class="list list-value">
                            {{ number_format($data->amount_hope_min) }} ～ {{ number_format($data->amount_hope_max) }} 円
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <p>
            <a href="{{ url('') }}/carrier/estimate/{{ $data->order_id }}/create" class="orders__btn btn btn-warning btn-block">見積作成</a>
            <a href="{{ url('') }}/carrier/request" class="btn btn-block btn-primary">一覧に戻る</a>
        </p>

    </div>
</div>

@endsection
