@extends('layouts.owner')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">案件登録</h2>

        <div class="order__block">
            {!! Form::open(['url' => 'owner/order/insert', 'class' => 'order__boxes']) !!}

                <h4 class="order__box__title trigAccordOrderBox" data-open="1">基本情報</h4>
                <div class="order__box bulletAccordOrderBox">
                    <ul class="lists">
                        <li class="list list-title must">案件名</li>
                        <li class="list list-value">
                            {{ $data['name'] }}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">案件クラス</li>
                        <li class="list list-value">
                            {{ $carrier_classes[$data['class_id']] }}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">発送予定日時</li>
                        <li class="list list-value">
                            <ul class="params">
                                <li class="param param-50">
                                    {{ $data['send_at'] }}
                                </li>
                                <li class="param param-50">
                                    @if( isset($data['send_timezone']) ) {{ $timezones[ $data['send_timezone'] ] }} @endif
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">到着予定日時</li>
                        <li class="list list-value">
                            <ul class="params">
                                <li class="param param-50">
                                    {{ $data['arrive_at'] }}
                                </li>
                                <li class="param param-50">
                                    @if( isset($data['arrive_timezone']) ) {{ $timezones[ $data['arrive_timezone'] ] }} @endif
                                </li>
                            </ul>
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
                            {{ $cargo_names[ $data['cargo_name'] ] }}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">寸法（mm）</li>
                        <li class="list list-value">
                            <ul class="params">
                                <li class="param param-10">L: </li>
                                <li class="param param-40">{{ $data['cargo_size_L'] }} mm</li>
                                <li class="param param-10">W: </li>
                                <li class="param param-40">{{ $data['cargo_size_W'] }} mm</li>
                                <li class="param param-10">H: </li>
                                <li class="param param-40">{{ $data['cargo_size_H'] }} mm</li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">個数（個）</li>
                        <li class="list list-value">{{ $data['cargo_count'] }} 個</li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">重量（kg）</li>
                        <li class="list list-value">{!! number_format($data['cargo_weight']) !!} kg/個</li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">総重量（kg）</li>
                        <li class="list list-value">
                            {!! number_format($data['cargo_count'] * $data['cargo_weight']) !!} kg
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">荷姿</li>
                        <li class="list list-value">
                            {{ $cargo_forms[ $data['cargo_form'] ] }}
                        </li>
                    </ul>
                </div>

                <h4 class="order__box__title trigAccordOrderBox" data-open="1">希望車種</h4>
                <div class="order__box bulletAccordOrderBox">
                    <ul class="lists">
                        <li class="list list-title">希望車種</li>
                        <li class="list list-value">
                            {{ $option_car_names[ $data['option_car'] ] }}
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
                            @if( isset($data['option_equipments'][$key]) && $data['option_equipments'][$key] > 0 )
                            <ul class="params params-left">
                                <li class="param param-80 param-left">
                                    {{ $equipment->name }}
                                </li>

                                @if($equipment->unit !== NULL)
                                @if($data['option_equipments'][$key] > 0)
                                <li class="param param-40">
                                    {{ $data['option_equipments'][$key] }}
                                    {{ $equipment->unit }}
                                </li>
                                @endif
                                @elseif( isset($data['option_equipments'][$key]) )
                                <li class="param param-40 param-left">
                                    {{ $umu[ $data['option_equipments'][$key] ] }}
                                </li>
                                @endif

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
                            @if( isset($data['option_others'][$key]) && $data['option_others'][$key] > 0 )
                            <ul class="params params-left">
                                <li class="param param-80 param-left">
                                    {{ $name }}
                                </li>
                                <li class="param param-40 param-left">
                                    {{ $umu[ $data['option_others'][$key] ] }}
                                </li>
                            </ul>
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
                            {!! \Form::textarea('notes', old('notes'), ['class' => 'form-control']) !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">希望の価格帯</li>
                        <li class="list list-value">
                            <ul class="params">
                                <li class="param param-50">{!! Form::number('amount_hope_min', old('amount_hope_min'), ['class' => 'form-control']) !!}</li>
                                <li class="param param-10">～</li>
                                <li class="param param-50">{!! Form::number('amount_hope_max', old('amount_hope_max'), ['class' => 'form-control']) !!}</li>
                                <li class="param param-10">円</li>
                            </ul>
                        </li>
                    </ul>
                </div>

                {!! Form::submit('この内容で登録する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
            {!! \Form::close() !!}

        </div>

        <p>
            <a href="{{ url('') }}/owner/order" class="btn btn-block btn-primary">一覧に戻る</a>
        </p>

    </div>
</div>

@endsection
