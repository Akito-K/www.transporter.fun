@extends('layouts.owner')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">見積依頼作成</h2>

        <div class="request__block">
            {!! Form::open(['url' => 'owner/request/execute', 'class' => 'request__boxes']) !!}
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
                            {{ $req_data->estimate_start_at }}
                            {{ $req_data->estimate_start_at_hour }}:{!! sprintf('%02d',  $req_data->estimate_start_at_minutes) !!}
                        </li>
                    </ul>
*/ ?>
                    <ul class="lists">
                        <li class="list list-title">受付終了日時</li>
                        <li class="list list-value">
                            {{ $req_data->estimate_close_at }}
                            {{ $req_data->estimate_close_at_hour }}:{!! sprintf('%02d',  $req_data->estimate_close_at_minutes) !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">メッセージ</li>
                        <li class="list list-value">{!! \Func::N2BR($req_data->body) !!}
                        </li>
                    </ul>
                </div>

                {!! Form::submit('この内容で見積依頼を行う', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
            {!! \Form::close() !!}

        </div>

        <p>
            <a href="{{ url('') }}/owner/request/{{ $data->order_id }}" class="btn btn-block btn-primary">入力に戻る</a>
        </p>

    </div>
</div>

@endsection
