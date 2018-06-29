@extends('layouts.owner')
@section('content')
@include('include.calendar')

{!! MyHTML::errorMessage($errors) !!}
{!! MyHTML::flashMessage() !!}

<div class="box">
    <div class="box-body">
        <h2 class="page-header">案件登録</h2>

        <div class="order__block">
            {!! Form::open(['url' => 'owner/order/confirm', 'class' => 'order__boxes']) !!}

                <h4 class="order__box__title trigAccordOrderBox" data-open="1">基本情報</h4>
                <div class="order__box bulletAccordOrderBox">
                    <ul class="lists">
                        <li class="list list-title must">案件名</li>
                        <li class="list list-value">
                            {!! \Form::text('name', old('name'), ['class' => 'form-control']) !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">荷主名を公開しない</li>
                        <li class="list list-value">
                            {!! \MyForm::radio('flag_hide_owner', $hide_owners, old('flag_hide_owner')? 1: 0, ['class' => ''], 'span') !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">定期案件</li>
                        <li class="list list-value">
                            <label>
                                {!! \Form::checkbox('flag_regular', 1, old('flag_regular'), ['class' => '']) !!}
                                定期案件
                            </label>
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">案件クラス</li>
                        <li class="list list-value">
                            {!! \Form::select('class_id', $carrier_classes, old('class_id'), ['class' => 'form-control']) !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">発送予定日時</li>
                        <li class="list list-value">
                            <ul class="params">
                                <li class="param param-50">
                                    <div class="date-input trigShowCalendar" data-calendar="send">
                                        {!! Form::text('send_at', old('send_at'), ['id' => 'send_at', 'placeholder' => '任意', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                                        {!! Form::hidden('hide_send_at', old('hide_send_at'), ['id' => 'hide_send_at']) !!}
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </li>
                                <li class="param param-50">
                                    {!! \Form::select('send_timezone', $timezones, old('send_timezone')?: 0, ['class' => 'form-control']) !!}
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">到着予定日時</li>
                        <li class="list list-value">
                            <ul class="params">
                                <li class="param param-50">
                                    <div class="date-input trigShowCalendar" data-calendar="arrive">
                                        {!! Form::text('arrive_at', old('arrive_at'), ['id' => 'arrive_at', 'placeholder' => '任意', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                                        {!! Form::hidden('hide_arrive_at', old('hide_arrive_at'), ['id' => 'hide_arrive_at']) !!}
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </li>
                                <li class="param param-50">
                                    {!! \Form::select('arrive_timezone', $timezones, old('arrive_timezone')?: 0, ['class' => 'form-control']) !!}
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <h4 class="order__box__title trigAccordOrderBox" data-open="1">発送元</h4>
                <div class="order__box bulletAccordOrderBox">
                    <ul class="lists">
                        <li class="list list-title">登録済住所から入力する</li>
                        <li class="list list-value">
                            <ul class="params">
                                <li class="param param-80">
                                    {!! \Form::select('send_address_id', $addresses, old('send_address_id'), ['class' => 'form-control paramQuoteAddress', 'data-type' => 'send']) !!}
                                </li>
                                <li class="param param-20">
                                    <button type="button" class="btn btn-info btn-sm trigQuoteAddress" data-type="send">入力</button>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    @include('include.address.create', ['prefix' => 'send_'])
                </div>

                <h4 class="order__box__title trigAccordOrderBox" data-open="0">配送先</h4>
                <div class="order__box bulletAccordOrderBox initial-close">
                    <ul class="lists">
                        <li class="list list-title">登録済住所から入力する</li>
                        <li class="list list-value">
                            <ul class="params">
                                <li class="param param-80">
                                    {!! \Form::select('arrive_address_id', $addresses, old('arrive_address_id'), ['class' => 'form-control paramQuoteAddress', 'data-type' => 'arrive']) !!}
                                </li>
                                <li class="param param-20">
                                    <button type="button" class="btn btn-info btn-sm trigQuoteAddress" data-type="arrive">入力</button>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    @include('include.address.create', ['prefix' => 'arrive_'])
                </div>

                <h4 class="order__box__title trigAccordOrderBox" data-open="0">運搬物</h4>
                <div class="order__box bulletAccordOrderBox initial-close">
                    <ul class="lists">
                        <li class="list list-title">品名</li>
                        <li class="list list-value">
                            {!! \Form::select('cargo_name', $cargo_names, old('cargo_name'), ['class' => 'form-control']) !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">寸法（mm）</li>
                        <li class="list list-value">
                            <ul class="params">
                                <li class="param param-10">L</li>
                                <li class="param param-40">{!! Form::number('cargo_size_L', old('cargo_size_L'), ['class' => 'form-control form-control--mini form-control--100']) !!}</li>
                                <li class="param param-10">W</li>
                                <li class="param param-40">{!! Form::number('cargo_size_W', old('cargo_size_W'), ['class' => 'form-control form-control--mini form-control--100']) !!}</li>
                                <li class="param param-10">H</li>
                                <li class="param param-40">{!! Form::number('cargo_size_H', old('cargo_size_H'), ['class' => 'form-control form-control--mini form-control--100']) !!}</li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">個数（個）</li>
                        <li class="list list-value">
                            {!! Form::number('cargo_count', old('cargo_count'), ['class' => 'form-control form-control--mini form-control--50 trigTotalWeight', 'id' => 'paramCount']) !!} 個
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">重量（kg）</li>
                        <li class="list list-value">
                            {!! Form::text('cargo_weight', old('cargo_weight'), ['class' => 'form-control form-control--mini form-control--50 trigTotalWeight', 'id' => 'paramWeight']) !!} kg/個
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">総重量（kg）</li>
                        <li class="list list-value">
                            <span class="bulletTotalWeight">
                                {{ number_format( old('total_weight') ) }}
                            </span> kg
                            {!! Form::hidden('total_weight', old('total_weight'), ['class' => 'bulletTotalWeight']) !!}
                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">荷姿</li>
                        <li class="list list-value">
                            {!! \Form::select('cargo_form', $cargo_forms, old('cargo_form'), ['class' => 'form-control']) !!}
                        </li>
                    </ul>
                </div>

                <h4 class="order__box__title trigAccordOrderBox" data-open="0">希望車種</h4>
                <div class="order__box bulletAccordOrderBox initial-close">
                    <ul class="lists">
                        <li class="list list-title">希望車種</li>
                        <li class="list list-value">
                            {!! \Form::select('option_car', $option_car_names, old('option_car'), ['class' => 'form-control']) !!}
                        </li>
                    </ul>
                </div>

                <h4 class="order__box__title trigAccordOrderBox" data-open="0">オプション装備</h4>
                <div class="order__box bulletAccordOrderBox initial-close">
                    <ul class="lists">
                        <li class="list list-title">オプション設備</li>
                        <li class="list list-value">

                            @if(!empty($option_equipments))
                            @foreach($option_equipments as $key => $equipment)
                            <ul class="params params-left">
                                <li class="param param-80 param-left">
                                    {{ $equipment->name }}
                                </li>

                                @if($equipment->unit !== NULL)
                                <li class="param param-30">
                                    {!! Form::number('option_equipments['.$key.']', old('option_equipments.'.$key), ['class' => 'form-control']) !!}
                                </li>
                                <li class="param param-10">
                                    {{ $equipment->unit }}
                                </li>
                                @else
                                <li class="param param-40 param-left">
                                    {!! \MyForm::radio('option_equipments['.$key.']', $umu, old('option_equipments.'.$key)? 1: 0, ['class' => ''], 'span') !!}
                                </li>
                                @endif

                            </ul>
                            @endforeach
                            @endif

                        </li>
                    </ul>
                    <ul class="lists">
                        <li class="list list-title">オプションその他</li>
                        <li class="list list-value">

                            @if(!empty($option_other_names))
                            @foreach($option_other_names as $key => $name)
                            <ul class="params params-left">
                                <li class="param param-80 param-left">
                                    {{ $name }}
                                </li>
                                <li class="param param-40 param-left">
                                    {!! \MyForm::radio('option_others['.$key.']', $umu, old('option_others.'.$key)? 1: 0, ['class' => ''], 'span') !!}
                                </li>
                            </ul>
                            @endforeach
                            @endif

                        </li>
                    </ul>
                </div>

                <h4 class="order__box__title trigAccordOrderBox" data-open="0">その他</h4>
                <div class="order__box bulletAccordOrderBox initial-close">
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

                {!! Form::submit('確認画面へ進む', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
            {!! \Form::close() !!}

        </div>

        <p>
            <a href="{{ url('') }}/owner/pre_order" class="btn btn-block btn-primary">一覧に戻る</a>
        </p>

    </div>
</div>

@endsection
