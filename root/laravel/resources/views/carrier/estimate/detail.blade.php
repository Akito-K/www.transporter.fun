@extends('layouts.carrier')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">見積詳細</h2>

        <div class="request__block">
            <div class="request__boxes">

                <h4 class="order__box__title trigAccordOrderBox" data-open="0">案件情報</h4>
                <div class="request__order bulletAccordOrderBox initial-close" id="bulletQuoteOrder">
                    @include('include.carrier.order_estimate', ['data' => $order_data])
                </div>

                <div class="estimate">
                    @include('include.carrier.estimate', ['data' => $data])
                </div>

            </div>

        </div>

        <p>
            <a href="{{ url('') }}/carrier/estimate/{{ $data->order_id }}/list" class="btn btn-block btn-primary">この案件の見積一覧に戻る</a>
            <a href="{{ url('') }}/carrier/estimate/" class="btn btn-block btn-primary">作成した見積一覧に戻る</a>
        </p>

    </div>
</div>

@endsection
