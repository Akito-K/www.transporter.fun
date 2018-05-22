@extends('layouts.owner')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">案件詳細</h2>

        <div class="request__block">
            <div class="request__boxes">
                <ul class="work__box-lists">
                    <li class="work__box-list"><a href="#order">案件内容</a></li>
                    <li class="work__box-list"><a href="#estimate">見積書</a></li>
                    <li class="work__box-list"><a href="#message">メッセージ</a></li>
                </ul>
            </div>

            <div class="request__boxes">

                <h5 class="work__box__title" id="order">案件内容</h5>
                <div class="request__order">
                    @include('include.owner.order_request', ['data' => $data->order])
                </div>

                <h5 class="work__box__title" id="estimate">見積書</h5>
                <div class="estimate">
                    @include('include.carrier.estimate', ['order_data' => $data->order, 'data' => $data])
                </div>

                <h5 class="work__box__title" id="message">メッセージ</h5>
                <div class="order__box">
                    <ul class="lists">
                        <li class="list list-title">{!! \Func::dateFormat( $data->suggested_at ) !!}</li>
                        <li class="list list-value">{!! \Func::N2BR( $data->suggest_message ) !!}</li>
                    </ul>
                </div>

            </div>
        </div>

        <p>
            <a href="{{ url('') }}/owner/estimate/{{ $data->order->order_id }}/list" class="btn btn-block btn-primary">この案件の見積一覧に戻る</a>
        </p>

    </div>
</div>

@endsection
