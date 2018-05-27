@extends('layouts.carrier')
@section('content')

{!! MyHTML::errorMessage($errors) !!}
{!! MyHTML::flashMessage() !!}

<div class="box">
    <div class="box-body">
        <h2 class="page-header">仕事の詳細</h2>

        <div class="request__block">
            <div class="request__boxes">
                <h4 class="order__box__title trigAccordOrderBox" data-open="0">案件情報</h4>
                <div class="request__order bulletAccordOrderBox initial-close">
                    @include('include.carrier.order_estimate', ['data' => $data->order])
                </div>
                <div class="estimate">
                    @include('include.carrier.estimate', ['order_data' => $data->order, 'data' => $data->estimate])
                </div>

                <div class="order__box">
                    <h5>ご提案内容</h5>
                    <ul class="lists">
                        <li class="list list-title">{!! \Func::dateFormat( $data->estimate->suggested_at ) !!}</li>
                        <li class="list list-value">{!! \Func::N2BR( $data->estimate->suggest_message ) !!}</li>
                    </ul>
                </div>

            </div>
        </div>

        <p>
            <a href="{{ url('') }}/carrier/work" class="btn btn-block btn-primary">進行中の仕事一覧に戻る</a>
        </p>

    </div>
</div>

@endsection
