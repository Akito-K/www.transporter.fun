@extends('layouts.carrier')
@section('content')

{!! MyHTML::errorMessage($errors) !!}
{!! MyHTML::flashMessage() !!}

<div class="box">
    <div class="box-body">
        <h2 class="page-header">ご提案作成（確認）</h2>

        <div class="request__block">
            {!! Form::open(['url' => 'carrier/suggest/execute', 'class' => 'request__boxes']) !!}
                {!! Form::hidden('estimate_id', $estimate_data->order_id) !!}

                <div class="order__box bulletAccordOrderBox">
                    <ul class="lists">
                        <li class="list list-title">ご提案メッセージ</li>
                        <li class="list list-value">
                            {!! \Func::N2BR( old('body') ) !!}
                            {!! \Form::hidden('body', old('body') ) !!}
                        </li>
                    </ul>
                </div>

                {!! Form::submit('この内容でご提案する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
            {!! \Form::close() !!}
        </div>

        <div class="request__block">
            <div class="request__boxes">
                <h4 class="order__box__title trigAccordOrderBox" data-open="0">案件情報</h4>
                <div class="request__order bulletAccordOrderBox initial-close" id="bulletQuoteOrder">
                    @include('include.carrier.order_estimate', ['data' => $order_data])
                </div>
                <div class="estimate">
                    @include('include.carrier.estimate', ['order_data' => $order_data, 'data' => $estimate_data])
                </div>
            </div>
        </div>

        <p>
            <a href="{{ url('') }}/carrier/suggest/{{ old('estimate_id') }}/create" class="btn btn-block btn-primary">入力画面に戻る</a>
        </p>

    </div>
</div>

@endsection
