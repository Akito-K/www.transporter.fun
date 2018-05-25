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

            {!! Form::open(['url' => 'owner/payed/confirm', 'class' => 'work__boxes']) !!}
                {!! Form::hidden('estimate_id', $estimate_data->estimate_id) !!}

                <h5 class="work__box__title" id="payed">入金通知</h5>
                <div class="work__box__suggest">
                    <ul class="lists">
                        <li class="list list-title">入金手続日時</li>
                        <li class="list list-value">
                            <ul class="params">
                                <li class="param param-50">
                                    @include('include.date_create', ['date_input_name' => 'payed', 'placeholder' => '必須', 'add_class' => '' ])
                                </li>
                                <li class="param param-50">
                                    <select name="payed_at_hour" class="form-control form-control--mini form-control--70">
                                        {!! \MyForm::selectHour( old('payed_at_hour') ) !!}
                                    </select> 時
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">入金処理種別</li>
                        <li class="list list-value">
                            {!! \Form::select('type', $payment_types, old('type'), ['class' => 'form-control']) !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">金融機関名</li>
                        <li class="list list-value">
                            {!! Form::text('bank', old('bank'), ['class' => 'form-control']) !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">入金金額</li>
                        <li class="list list-value">
                            {!! Form::number('amount', old('amount', $estimate_data->total ), ['class' => 'form-control']) !!}
                        </li>
                    </ul>
                </div>

                {!! Form::submit('確認画面へ進む', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
                <a href="{{ url('') }}/owner/active_order" class="btn btn-block btn-primary">進行中の案件一覧に戻る</a>
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
