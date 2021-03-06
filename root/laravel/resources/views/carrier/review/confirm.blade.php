@extends('layouts.carrier')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">このお仕事の荷主様はいかがでしたか？（確認画面）</h2>

        <div class="request__block">
            {!! Form::open(['url' => 'carrier/review/execute', 'class' => 'work__boxes']) !!}
                {!! Form::hidden('work_id', old('work_id')) !!}

                <div class="review__box">
                    @if(!empty($evaluation_items))
                    @foreach( $evaluation_items as $item_id => $name)
                    <ul class="lists review__box__lists">
                        <li class="list list-title review__box__list">{{ $name }}</li>
                        <li class="list list-value review__box__list">
                            <ul class="params review__box__params" data-id="{{ $item_id }}">
                                <li class="param param-80 param-left review__box__param review__box__param--name">好ましくなかった</li>
                                <li class="param param-100 review__box__param review__box__param--stars">
                                    @include('include.evaluate', ['star' => old('evaluates.'.$item_id)?: '5.0', 'item_id' => $item_id, 'editable' => 0])
                                </li>
                                <li class="param param-80 param-right review__box__param review__box__param--name">好ましかった</li>
                            </ul>
                        </li>
                    </ul>
                    {!! \Form::hidden('evaluates['.$item_id.']', old('evaluates.'.$item_id), ['class' => 'bulletEvaluateStarValue', 'data-id' => $item_id]) !!}
                    @endforeach
                    @endif
                </div>

                {!! Form::submit('この内容で決定する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
                <a href="{{ url('') }}/carrier/review/{{ old('work_id') }}/create" class="btn btn-block btn-primary">入力画面に戻る</a>
            {!! \Form::close() !!}
        </div>

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
        </div>

        <div class="request__block">
            <div class="request__boxes">

                <h5 class="work__box__title" id="payed">入金記録</h5>
                <div class="work__boxes">
                    @include('include.carrier.payed', ['data' => $payed_data])
                </div>

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

        <a href="{{ url('') }}/carrier/closed_work" class="btn btn-block btn-primary">終了した仕事一覧に戻る</a>

    </div>
</div>

@endsection
