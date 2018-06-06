@extends('layouts.owner')
@section('content')

{!! MyHTML::errorMessage($errors) !!}
{!! MyHTML::flashMessage() !!}

<div class="box">
    <div class="box-body">
        <h2 class="page-header">発注依頼作成（確認）</h2>

        <div class="request__block">
            <div class="request__boxes">
                <ul class="work__box-lists">
                    <li class="work__box-list"><a href="#message">メッセージ</a></li>
                    <li class="work__box-list"><a href="#order">案件内容</a></li>
                    <li class="work__box-list"><a href="#estimate">見積書</a></li>
                </ul>
            </div>

            {!! Form::open(['url' => 'owner/place/execute', 'class' => 'work__boxes']) !!}
                {!! Form::hidden('estimate_id', $estimate_data->order_id) !!}

                <h5 class="work__box__title" id="message">メッセージ</h5>
                <div class="work__box__suggest work__box__suggest--confirm">

                    <h6 class="work__box__subtitle">発注メッセージ</h6>
                    @include('include.estimate_message_you', [
                        'data' => $owner_data,
                        'date_at' => new \Datetime(),
                        'body' => \Func::N2BR( old('body') )
                        ])
                    {!! \Form::hidden('body', old('body') ) !!}

                    <h6 class="work__box__subtitle">提案メッセージ</h6>
                    @include('include.estimate_message_me', [
                        'data' => $carrier_data,
                        'date_at' => $estimate_data->suggested_at,
                        'body' => \Func::N2BR( $estimate_data->suggest_message )
                        ])

                </div>

                {!! Form::submit('この内容で発注する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
                <a href="{{ url('') }}/owner/place/{{ old('estimate_id') }}/create" class="btn btn-block btn-primary">入力画面に戻る</a>
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
