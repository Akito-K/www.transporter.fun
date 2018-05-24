@extends('layouts.carrier')
@section('content')

{!! MyHTML::errorMessage($errors) !!}
{!! MyHTML::flashMessage() !!}

<div class="box">
    <div class="box-body">
        <h2 class="page-header">受注受諾作成（確認）</h2>

        <div class="request__block">
            <div class="request__boxes">
                <ul class="work__box-lists">
                    <li class="work__box-list"><a href="#message">メッセージ</a></li>
                    <li class="work__box-list"><a href="#order">案件内容</a></li>
                    <li class="work__box-list"><a href="#estimate">見積書</a></li>
                </ul>
            </div>

            {!! Form::open(['url' => 'carrier/receive/execute', 'class' => 'work__boxes']) !!}
                {!! Form::hidden('work_id', $work_data->work_id) !!}

                <h5 class="work__box__title" id="message">メッセージ</h5>
                <div class="work__box__suggest work__box__suggest--confirm">
                    <ul class="lists">
                        <li class="list list-title">受注メッセージ</li>
                        <li class="list list-value">
                            {!! \Func::N2BR( old('body') ) !!}
                            {!! \Form::hidden('body', old('body') ) !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">発注メッセージ<br>（{{ $order_data->owner_name }}）</li>
                        <li class="list list-value">
                            {!! \Func::N2BR( $estimate_data->place_message ) !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">提案メッセージ</li>
                        <li class="list list-value">
                            {!! \Func::N2BR( $estimate_data->suggest_message ) !!}
                        </li>
                    </ul>
                </div>

                {!! Form::submit('この内容で受注する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
                <a href="{{ url('') }}/carrier/receive/{{ old('work_id') }}/create" class="btn btn-block btn-primary">入力画面に戻る</a>
            {!! \Form::close() !!}
        </div>

        <div class="request__block">
            <div class="request__boxes">
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
