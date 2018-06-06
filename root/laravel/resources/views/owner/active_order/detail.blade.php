@extends('layouts.owner')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">案件詳細</h2>

        <div class="request__block">
            <div class="request__boxes">
                <ul class="work__box-lists">
                    @if($payed_data)
                    <li class="work__box-list"><a href="#payed">入金通知</a></li>
                    @endif
                    <li class="work__box-list"><a href="#report">完了報告</a></li>
                    <li class="work__box-list"><a href="#message">メッセージ</a></li>
                    <li class="work__box-list"><a href="#order">案件内容</a></li>
                    <li class="work__box-list"><a href="#estimate">見積書</a></li>
                </ul>
            </div>
        </div>

        <div class="request__block">
            <div class="request__boxes">

                @if($payed_data)
                <h5 class="work__box__title" id="payed">入金記録</h5>
                <div class="work__boxes">
                    @include('include.carrier.payed', ['data' => $payed_data])
                </div>
                @endif

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

        <a href="{{ url('') }}/owner/active_order" class="btn btn-block btn-primary">進行中の案件一覧に戻る</a>

    </div>
</div>

@endsection
