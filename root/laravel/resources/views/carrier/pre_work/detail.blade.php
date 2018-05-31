@extends('layouts.carrier')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">案件詳細</h2>

        <div class="request__block">
            <div class="request__boxes">
                <ul class="work__box-lists">
                    @if($work_data->status_id)
                    <li class="work__box-list"><a href="#message">メッセージ</a></li>
                    @endif
                    <li class="work__box-list"><a href="#order">案件内容</a></li>
                    <li class="work__box-list"><a href="#estimate">見積書</a></li>
                </ul>
            </div>
        </div>

        <div class="request__block">
            <div class="request__boxes">

                @if($work_data->status_id)
                <h5 class="work__box__title" id="message">メッセージ</h5>
                <div class="work__boxes">
                    @include('include.carrier.message', ['data' => $estimate_data])
                </div>
                @endif

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

        <a href="{{ url('') }}/carrier/pre_work" class="btn btn-block btn-primary">未受注の仕事一覧に戻る</a>

    </div>
</div>

@endsection
