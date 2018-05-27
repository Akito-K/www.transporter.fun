@extends('layouts.owner')
@section('content')
@include('include.calendar')

{!! MyHTML::errorMessage($errors) !!}
{!! MyHTML::flashMessage() !!}

<div class="box">
    <div class="box-body">
        <h2 class="page-header">入金通知作成</h2>

        <div class="request__block">
            <div class="request__boxes">
                <ul class="work__box-lists">
                    <li class="work__box-list"><a href="#payed">入金通知</a></li>
                    <li class="work__box-list"><a href="#report">完了報告</a></li>
                    <li class="work__box-list"><a href="#message">メッセージ</a></li>
                    <li class="work__box-list"><a href="#order">案件内容</a></li>
                    <li class="work__box-list"><a href="#estimate">見積書</a></li>
                </ul>
            </div>

            {!! Form::open(['url' => 'owner/payed/execute', 'class' => 'work__boxes']) !!}
                {!! Form::hidden('estimate_id', old('estimate_id') ) !!}

                <h5 class="work__box__title" id="payed">入金通知</h5>
                <div class="work__box__suggest">
                    <ul class="lists">
                        <li class="list list-title">入金手続日時</li>
                        <li class="list list-value">
                            {{ old('payed_at') }} {!! sprintf('%02d', old('payed_at_hour') ) !!}時
                            {!! Form::hidden( 'hide_payed_at', old('hide_payed_at') ) !!}
                            {!! Form::hidden( 'payed_at_hour', old('payed_at_hour') ) !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">入金処理種別</li>
                        <li class="list list-value">
                            {{ $payment_types[ old('type') ] }}
                            {!! Form::hidden( 'type', old('type') ) !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">金融機関名</li>
                        <li class="list list-value">
                            {{ old('bank_name') }}
                            {!! Form::hidden('bank_name', old('bank_name')) !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">入金金額</li>
                        <li class="list list-value">
                            ￥{{ number_format( old('amount') ) }}
                            {!! Form::hidden('amount', old('amount')) !!}
                        </li>
                    </ul>
                </div>

                {!! Form::submit('この内容で通知する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
                <a href="{{ url('') }}/owner/payed/{{ old('estimate_id') }}/create" class="btn btn-block btn-primary">入力画面に戻る</a>
            {!! \Form::close() !!}
        </div>

        <div class="request__block">
            <div class="request__boxes">
                <h5 class="work__box__title" id="report">完了報告</h5>
                <div class="work__boxes">
                    @include('include.carrier.report', ['data' => $report_data])
                </div>

                <h5 class="work__box__title" id="message">メッセージ</h5>
                <div class="work__boxes">
                    @include('include.carrier.message', ['data' => $estimate_data])
                </div>

                <h5 class="work__box__title" id="order">案件内容</h5>
                <div class="request__order">
                    @include('include.carrier.order_estimate', ['data' => $order_data])
                </div>

                <h5 class="work__box__title" id="estimate">見積書</h5>
                <div class="estimate">
                    @include('include.carrier.estimate', ['order_data' => $order_data, 'data' => $estimate_data])
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
