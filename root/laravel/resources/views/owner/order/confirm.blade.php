@extends('layouts.owner')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">案件登録</h2>

        <div class="order__block">
            @if( $action == 'create' )
            {!! Form::open(['url' => 'owner/order/insert', 'class' => 'order__boxes']) !!}
            @elseif( $action == 'edit' )
            {!! Form::open(['url' => 'owner/order/update', 'class' => 'order__boxes']) !!}
                {!! Form::hidden('order_id', old('order_id')) !!}
            @endif

                <h4 class="order__box__title trigAccordOrderBox" data-open="1">基本情報</h4>
                <div class="order__box bulletAccordOrderBox">
                    <ul class="lists">
                        <li class="list list-title must">案件名</li>
                        <li class="list list-value">
                            {{ old('name') }}
                            {!! Form::hidden('name', old('name')) !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">荷主名を公開しない</li>
                        <li class="list list-value">
                            {{ $hide_owners[ old('flag_hide_owner') ] }}
                            {!! Form::hidden('flag_hide_owner', old('flag_hide_owner')) !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">定期案件</li>
                        <li class="list list-value">
                            {{ old('flag_regular')? '定期案件': '不定期案件' }}
                            {!! Form::hidden('flag_regular', old('flag_regular')) !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">案件クラス</li>
                        <li class="list list-value">
                            {{ $carrier_classes[ old('class_id') ] }}
                            {!! Form::hidden('class_id', old('class_id')) !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">発送予定日時</li>
                        <li class="list list-value">
                            {{ old('send_at') }}
                            {{ $timezones[ old('send_timezone') ] }}
                            {!! Form::hidden('send_at', old('send_at')) !!}
                            {!! Form::hidden('hide_send_at', old('hide_send_at')) !!}
                            {!! Form::hidden('send_timezone', old('send_timezone')) !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">到着予定日時</li>
                        <li class="list list-value">
                            {{ old('arrive_at') }}
                            {{ $timezones[ old('arrive_timezone') ] }}
                            {!! Form::hidden('arrive_at', old('arrive_at')) !!}
                            {!! Form::hidden('hide_arrive_at', old('hide_arrive_at')) !!}
                            {!! Form::hidden('arrive_timezone', old('arrive_timezone')) !!}
                        </li>
                    </ul>
                </div>

                <h4 class="order__box__title trigAccordOrderBox" data-open="1">発送元</h4>
                <div class="order__box bulletAccordOrderBox">
                    @include('include.address.confirm', ['prefix' => 'send_'])
                </div>

                <h4 class="order__box__title trigAccordOrderBox" data-open="1">配送先</h4>
                <div class="order__box bulletAccordOrderBox">
                    @include('include.address.confirm', ['prefix' => 'arrive_'])
                </div>

                <h4 class="order__box__title trigAccordOrderBox" data-open="1">運搬物</h4>
                <div class="order__box bulletAccordOrderBox">
                    <ul class="lists">
                        <li class="list list-title">品名</li>
                        <li class="list list-value">
                            {{ $cargo_names[ old('cargo_name') ] }}
                            {!! Form::hidden('cargo_name', old('cargo_name')) !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">寸法（mm）</li>
                        <li class="list list-value">
                            <ul class="params">
                                <li class="param param-10">L: </li>
                                <li class="param param-40">{{ old('cargo_size_L') }} mm</li>
                                <li class="param param-10">W: </li>
                                <li class="param param-40">{{ old('cargo_size_W') }} mm</li>
                                <li class="param param-10">H: </li>
                                <li class="param param-40">{{ old('cargo_size_H') }} mm</li>
                                {!! Form::hidden('cargo_size_L', old('cargo_size_L')) !!}
                                {!! Form::hidden('cargo_size_W', old('cargo_size_W')) !!}
                                {!! Form::hidden('cargo_size_H', old('cargo_size_H')) !!}
                            </ul>
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">個数（個）</li>
                        <li class="list list-value">{{ old('cargo_count') }} 個</li>
                        {!! Form::hidden('cargo_count', old('cargo_count')) !!}
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">重量（kg）</li>
                        <li class="list list-value">{!! number_format( old('cargo_weight') ) !!} kg/個</li>
                        {!! Form::hidden('cargo_weight', old('cargo_weight')) !!}
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">総重量（kg）</li>
                        <li class="list list-value">
                            {!! number_format( old('cargo_count') *  old('cargo_weight')) !!} kg
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">荷姿</li>
                        <li class="list list-value">
                            {{ $cargo_forms[ old('cargo_form') ] }}
                        </li>
                        {!! Form::hidden('cargo_form', old('cargo_form')) !!}
                    </ul>
                </div>

                <h4 class="order__box__title trigAccordOrderBox" data-open="1">希望車種</h4>
                <div class="order__box bulletAccordOrderBox">
                    <ul class="lists">
                        <li class="list list-title">希望車種</li>
                        <li class="list list-value">
                            {{ $option_car_names[ old('option_car') ] }}
                            {!! Form::hidden('option_car', old('option_car')) !!}
                        </li>
                    </ul>
                </div>

                <h4 class="order__box__title trigAccordOrderBox" data-open="1">オプション装備</h4>
                <div class="order__box bulletAccordOrderBox">
                    <ul class="lists">
                        <li class="list list-title">オプション設備</li>
                        <li class="list list-value">

                            @if(!empty($option_equipments))
                            @foreach($option_equipments as $key => $equipment)
                            @if( old('option_equipments.'.$key) > 0 )
                            <ul class="params params-left">
                                <li class="param param-80 param-left">
                                    {{ $equipment->name }}
                                </li>

                                @if($equipment->unit !== NULL)
                                <li class="param param-40">
                                    {{ old('option_equipments.'.$key) }}
                                    {{ $equipment->unit }}
                                </li>
                                @else
                                <li class="param param-40 param">
                                    {{ $umu[ old('option_equipments.'.$key) ] }}
                                </li>
                                @endif
                                {!! Form::hidden('option_equipments['.$key.']', old('option_equipments.'.$key)) !!}

                            </ul>
                            @endif
                            @endforeach
                            @endif

                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">オプションその他</li>
                        <li class="list list-value">

                            @if(!empty($option_other_names))
                            @foreach($option_other_names as $key => $name)
                            @if( old('option_others.'.$key) > 0 )
                            <ul class="params params-left">
                                <li class="param param-80 param-left">
                                    {{ $name }}
                                </li>
                                <li class="param param-40 param">
                                    {{ $umu[ old('option_others.'.$key) ] }}
                                </li>
                            </ul>
                            {!! Form::hidden('option_others['.$key.']', old('option_others.'.$key)) !!}
                            @endif
                            @endforeach
                            @endif

                        </li>
                    </ul>
                </div>

                <h4 class="order__box__title trigAccordOrderBox" data-open="1">その他</h4>
                <div class="order__box bulletAccordOrderBox">
                    <ul class="lists">
                        <li class="list list-title">特記事項</li>
                        <li class="list list-value">
                            {!! \Func::N2BR( old('notes') ) !!}
                            {!! Form::hidden('notes', old('notes')) !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">希望の価格帯</li>
                        <li class="list list-value">
                            {{ number_format( old('amount_hope_min') ) }} ～ {{ number_format( old('amount_hope_max') ) }} 円
                            {!! Form::hidden('amount_hope_min', old('amount_hope_min')) !!}
                            {!! Form::hidden('amount_hope_max', old('amount_hope_max')) !!}
                        </li>
                    </ul>
                </div>

                @if( $action == 'create' )
                {!! Form::submit('この内容で登録する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
                @elseif( $action == 'edit' )
                {!! Form::submit('この内容で更新する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
                @endif
            {!! \Form::close() !!}

        </div>

        <p>
            @if( $action == 'create' )
            <a href="{{ url('') }}/owner/order/create" class="btn btn-block btn-primary">入力に戻る</a>
            @elseif( $action == 'edit' )
            <a href="{{ url('') }}/owner/order/{{ old('order_id') }}/edit" class="btn btn-block btn-primary">編集に戻る</a>
            @endif
        </p>

    </div>
</div>

@endsection
