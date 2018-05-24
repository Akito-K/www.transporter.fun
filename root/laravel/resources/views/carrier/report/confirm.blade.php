@extends('layouts.carrier')
@section('content')

{!! MyHTML::errorMessage($errors) !!}
{!! MyHTML::flashMessage() !!}

<div class="box">
    <div class="box-body">
        <h2 class="page-header">完了報告作成（確認）</h2>

        <div class="request__block">
            <div class="request__boxes">
                <ul class="work__box-lists">
                    <li class="work__box-list"><a href="#report">完了報告</a></li>
                    <li class="work__box-list"><a href="#message">メッセージ</a></li>
                    <li class="work__box-list"><a href="#order">案件内容</a></li>
                    <li class="work__box-list"><a href="#estimate">見積書</a></li>
                </ul>
            </div>

            {!! Form::open(['url' => 'carrier/report/execute', 'class' => 'work__boxes']) !!}
                {!! Form::hidden('work_id', old('work_id') ) !!}

                <h5 class="work__box__title" id="report">完了報告</h5>
                <div class="work__box__suggest work__box__suggest--confirm">
                    <ul class="lists">
                        <li class="list list-title">現地到着日時</li>
                        <li class="list list-value">
                            {{ old('arrived_at') }} {!! sprintf('%02d', old('arrived_at_hour') ) !!}時
                            {!! Form::hidden( 'hide_arrived_at', old('hide_arrived_at') ) !!}
                            {!! Form::hidden( 'arrived_at_hour', old('arrived_at_hour') ) !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">荷降ろし完了日時</li>
                        <li class="list list-value">
                            {{ old('completed_at') }} {!! sprintf('%02d', old('completed_at_hour') ) !!}時
                            {!! Form::hidden( 'hide_completed_at', old('hide_completed_at') ) !!}
                            {!! Form::hidden( 'completed_at_hour', old('completed_at_hour') ) !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">トラブル報告</li>
                        <li class="list list-value">
                            {!! \Func::N2BR( old('trouble') ) !!}
                            {!! Form::hidden( 'trouble', old('trouble') ) !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">その他コメント</li>
                        <li class="list list-value">
                            {!! \Func::N2BR( old('comment') ) !!}
                            {!! Form::hidden( 'comment', old('comment') ) !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">受領書・報告書ファイル添付</li>
                        <li class="list list-value">
                        </li>
                    </ul>
                </div>

                {!! Form::submit('この内容で報告する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
                <a href="{{ url('') }}/carrier/report/{{ old('work_id') }}/create" class="btn btn-block btn-primary">入力画面に戻る</a>
            {!! \Form::close() !!}
        </div>

        <div class="request__block">
            <div class="request__boxes">
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
