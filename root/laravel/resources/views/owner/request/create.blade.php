@extends('layouts.owner')
@section('content')
@include('include.calendar')

{!! MyHTML::errorMessage($errors) !!}
{!! MyHTML::flashMessage() !!}

<div class="box">
    <div class="box-body">
        <h2 class="page-header">見積依頼作成</h2>

        <div class="request__block">
            {!! Form::open(['url' => 'owner/request/confirm', 'class' => 'request__boxes']) !!}
                {!! Form::hidden('order_id', $data->order_id) !!}

                <h4 class="order__box__title trigAccordOrderBox" data-open="1">案件情報</h4>
                <div class="request__order bulletAccordOrderBox">
                    @include('include.owner.order_request', ['data' => $data])
                </div>

                <div class="order__box bulletAccordOrderBox">
<?php /*
                    <ul class="lists">
                        <li class="list list-title">受付開始日時</li>
                        <li class="list list-value">
                            <ul class="params">
                                <li class="param param-50">
                                    <div class="date-input trigShowCalendar" data-calendar="estimate_start">
                                        {!! Form::text('estimate_start_at', old('estimate_start_at')?: $req_data->estimate_start_at, ['id' => 'estimate_start_at', 'placeholder' => '必須', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                                        {!! Form::hidden('hide_estimate_start_at', old('hide_estimate_start_at')?: $req_data->hide_estimate_start_at, ['id' => 'hide_estimate_start_at']) !!}
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </li>
                                <li class="param param-50">
                                    <select name="estimate_start_at_hour" class="form-control form-control--mini form-control--40 form-control--sm">
                                        {!! \MyForm::selectHour( old('estimate_start_at_hour')?: $req_data->estimate_start_at_hour?: 10 ) !!}
                                    </select>時
                                    <select name="estimate_start_at_minutes" class="form-control form-control--mini form-control--40 form-control--sm">
                                        {!! \MyForm::selectMinutes( old('estimate_start_at_minutes')?: $req_data->estimate_start_at_minutes?: 0 ) !!}
                                    </select>分
                                </li>
                            </ul>
                        </li>
                    </ul>
*/ ?>
                    <ul class="lists">
                        <li class="list list-title">受付終了日時</li>
                        <li class="list list-value">
                            <ul class="params">
                                <li class="param param-50">
                                    <div class="date-input trigShowCalendar" data-calendar="estimate_close">
                                        {!! Form::text('estimate_close_at', old('estimate_close_at')?: $req_data->estimate_close_at, ['id' => 'estimate_close_at', 'placeholder' => '必須', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                                        {!! Form::hidden('hide_estimate_close_at', old('hide_estimate_close_at')?: $req_data->hide_estimate_close_at, ['id' => 'hide_estimate_close_at']) !!}
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </li>
                                <li class="param param-50">
                                    <select name="estimate_close_at_hour" class="form-control form-control--mini form-control--40 form-control--sm">
                                        {!! \MyForm::selectHour( old('estimate_close_at_hour')?: $req_data->estimate_close_at_hour?: 10 ) !!}
                                    </select>時
                                    <select name="estimate_close_at_minutes" class="form-control form-control--mini form-control--40 form-control--sm">
                                        {!! \MyForm::selectMinutes( old('estimate_close_at_minutes')?: $req_data->estimate_close_at_minutes?: 0 ) !!}
                                    </select>分
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">メッセージ</li>
                        <li class="list list-value">
                            {!! \Form::textarea('body', old('body')?: $req_data->body, ['class' => 'form-control']) !!}
                        </li>
                    </ul>
                </div>

                {!! Form::submit('確認画面へ進む', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
            {!! \Form::close() !!}

        </div>

        <p>
            <a href="{{ url('') }}/owner/order" class="btn btn-block btn-primary">一覧に戻る</a>
        </p>

    </div>
</div>

@endsection
