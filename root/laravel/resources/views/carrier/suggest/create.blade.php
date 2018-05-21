@extends('layouts.carrier')
@section('content')

{!! MyHTML::errorMessage($errors) !!}
{!! MyHTML::flashMessage() !!}

<div class="box">
    <div class="box-body">
        <h2 class="page-header">ご提案作成</h2>

        <div class="request__block">
            {!! Form::open(['url' => 'carrier/suggest/confirm', 'class' => 'request__boxes']) !!}
                {!! Form::hidden('estimate_id', $estimate_data->estimate_id) !!}

                <div class="order__box bulletAccordOrderBox">
                    <ul class="lists">
                        <li class="list list-title">ご提案メッセージ</li>
                        <li class="list list-value">
                            {!! \Form::textarea('body', old('body'), ['class' => 'form-control']) !!}
                        </li>
                    </ul>
                </div>

                {!! Form::submit('確認画面へ進む', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
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
            <a href="{{ url('') }}/carrier/estimate" class="btn btn-block btn-primary">作成した見積一覧に戻る</a>
        </p>

    </div>
</div>

@endsection
