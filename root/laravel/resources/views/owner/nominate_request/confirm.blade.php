@extends('layouts.owner')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">見積依頼作成</h2>

        <div class="request__block">
            {!! Form::open(['url' => 'owner/nominate_request/execute', 'class' => 'request__boxes']) !!}
                {!! Form::hidden('order_id', $data->order_id) !!}
                {!! Form::hidden('carrier_id', old('carrier_id')) !!}

                <h4 class="order__box__title trigAccordOrderBox" data-open="1">案件情報</h4>
                <div class="request__order bulletAccordOrderBox">
                    @include('include.owner.order_request', ['data' => $data])
                </div>

                <div class="order__box">
                    <ul class="lists">
                        <li class="list list-title">指定見積依頼先の運送会社</li>
                        <li class="list list-value">
                            {{ $select_carriers_names[ old('carrier_id') ] }}
                        </li>
                    </ul>

                    <div class="request__order__carrier">
                        @include('include.carrier.detail.base',  ['carrier_data' => $carrier_data])
                    </div>

                    <ul class="lists">
                        <li class="list list-title">受付終了日時</li>
                        <li class="list list-value">
                            {{ old('estimate_close_at') }}
                            {{ old('estimate_close_at_hour') }}:{!! sprintf('%02d',  old('estimate_close_at_minutes') ) !!}

                            {!! Form::hidden('hide_estimate_close_at', old('hide_estimate_close_at') ) !!}
                            {!! Form::hidden('estimate_close_at_hour', old('estimate_close_at_hour') ) !!}
                            {!! Form::hidden('estimate_close_at_minutes', old('estimate_close_at_minutes') ) !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">メッセージ</li>
                        <li class="list list-value">{!! \Func::N2BR( old('body') ) !!}
                        </li>
                        {!! Form::hidden('body', old('body') ) !!}
                    </ul>
                </div>

                {!! Form::submit('この内容で見積依頼を行う', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
            {!! \Form::close() !!}

        </div>

        <p>
            <a href="{{ url('') }}/owner/nominate_request/{{ $data->order_id }}/create" class="btn btn-block btn-primary">入力に戻る</a>
        </p>

    </div>
</div>

@endsection
