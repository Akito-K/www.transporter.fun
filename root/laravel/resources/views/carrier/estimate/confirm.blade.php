@extends('layouts.carrier')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">見積作成（確認画面）</h2>

        <div class="request__block">
            @if( $action == 'create' )
            {!! Form::open(['url' => 'carrier/estimate/insert', 'class' => 'request__boxes']) !!}
                {!! Form::hidden('order_id', old('order_id') ) !!}
            @elseif( $action == 'edit' )
            {!! Form::open(['url' => 'carrier/estimate/update', 'class' => 'request__boxes']) !!}
                {!! Form::hidden('order_id', old('order_id') ) !!}
                {!! Form::hidden('estimate_id', old('estimate_id') ) !!}
            @endif

                <h4 class="order__box__title trigAccordOrderBox" data-open="0">案件情報</h4>
                <div class="request__order bulletAccordOrderBox initial-close" id="bulletQuoteOrder">
                    @include('include.carrier.order_estimate', ['data' => $order_data])
                </div>

                <div class="estimate">
                    <div class="estimate__block table-scroll-wrap">
                        <table class="estimate__table table-scroll">
                            <thead class="estimate__theader">
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>

                                <tr>
                                    <td class="estimate__table__cell estimate__table__cell--title" colspan="6">御見積書</td>
                                </tr>
                                <tr>
                                    <td class="estimate__table__cell" id="bulletQuoteOrderOwner" colspan="3" rowspan="2">
                                        {!! \Func::N2BR($order_data->owner_name) !!}様
                                    </td>
                                    <td class="estimate__table__cell align-right">見積番号</td>
                                    <td class="estimate__table__cell" colspan="2">:
                                        {{ old('number') }}
                                        {!! Form::hidden('number', old('number') ) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="estimate__table__cell align-right">見積日</td>
                                    <td class="estimate__table__cell" colspan="2">:
                                        {{ old('estimated_at') }}
                                        {!! Form::hidden('hide_estimated_at', old('hide_estimated_at') ) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="estimate__table__cell" colspan="3">
                                        「<span id="bulletQuoteOrderName">{{ $order_data->name }}</span>」のお見積
                                    </td>
                                    <td class="estimate__table__cell align-right">有効期限</td>
                                    <td class="estimate__table__cell" colspan="2">:
                                        {{ old('limit_at') }}
                                        {!! Form::hidden('hide_limit_at', old('hide_limit_at') ) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="estimate__table__cell estimate__table__cell--space" colspan="6"></td>
                                </tr>
                                <tr>
                                    <td class="estimate__table__cell estimate__theader__name">型番</td>
                                    <td class="estimate__table__cell estimate__theader__name" colspan="2">| 項目名</td>
                                    <td class="estimate__table__cell estimate__theader__name">| 単価</td>
                                    <td class="estimate__table__cell estimate__theader__name">| 数量</td>
                                    <td class="estimate__table__cell estimate__theader__name">| 小計</td>
                                </tr>
                            </thead>

                            <tbody class="estimate__tbody" id="bulletItems">

                                @if(!empty( old('item_code') ))
                                @foreach( old('item_code') as $num => $v )
                                <tr class="estimate__table__margin-top">
                                    <td class="estimate__table__cell">{{ old('item_code.'.$num) }}</td>
                                    <td class="estimate__table__cell" colspan="2">{{ old('item_name.'.$num) }}</td>
                                    <td class="estimate__table__cell">{{ old('item_amount.'.$num) }}</td>
                                    <td class="estimate__table__cell">{{ old('item_count.'.$num) }}</td>
                                    <td class="estimate__table__cell">{!! number_format( \Func::numberFormatDecode( old('item_subtotal.'.$num) ) ) !!}</td>
                                </tr>
                                <tr class="estimate__table__margin-bottom">
                                    <td class="estimate__table__cell estimate__table__cell--sm-title estimate__table__cell--line align-right">
                                        （特記事項）
                                    </td>
                                    <td class="estimate__table__cell estimate__table__cell--notes estimate__table__cell--line" colspan="4">
                                        {!! \Func::N2BR( old('item_notes.'.$num) )  !!}
                                    </td>
                                    <td class="estimate__table__cell estimate__table__cell--line"></td>
                                </tr>
                                {!! Form::hidden('item_code['.$num.']', old('item_code.'.$num) ) !!}
                                {!! Form::hidden('item_name['.$num.']', old('item_name.'.$num) ) !!}
                                {!! Form::hidden('item_amount['.$num.']', old('item_amount.'.$num) ) !!}
                                {!! Form::hidden('item_count['.$num.']', old('item_count.'.$num) ) !!}
                                {!! Form::hidden('item_subtotal['.$num.']', old('item_subtotal.'.$num) ) !!}
                                {!! Form::hidden('item_notes['.$num.']', old('item_notes.'.$num) ) !!}
                                @endforeach
                                @endif

                            </tbody>

                            <tbody class="estimate__tfooter">
                                <tr>
                                    <td class="estimate__table__cell estimate__table__cell--total" colspan="2">
                                        合計金額<br />
                                        {{ number_format( \Func::numberFormatDecode( old('total') ) ) }} 円
                                    </td>
                                    <td class="estimate__table__cell" colspan="4">
                                        特記事項<br />
                                        {!! \Func::N2BR( old('notes') ) !!}
                                        {!! Form::hidden('notes', old('notes') ) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="estimate__table__cell estimate__table__cell--space" colspan="6"></td>
                                </tr>
                                <tr>
                                    <td class="estimate__table__cell" colspan="4">
                                    <td class="estimate__table__cell estimate__table__cell--carrier align-right" colspan="2">
                                        作成者・・・{{ $carrier->company }}<br />（担当：{{ $carrier->sei }}{{ $carrier->mei }}）
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

                @if( $action == 'create' )
                {!! Form::submit('この内容で保存する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
                @elseif( $action == 'edit' )
                {!! Form::submit('この内容で更新する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
                @endif

            {!! \Form::close() !!}

        </div>

        <p>
            @if( $action == 'create' )
            <a href="{{ url('') }}/carrier/estimate/{{ old('order_id') }}/create" class="btn btn-block btn-primary">入力画面に戻る</a>
            @elseif( $action == 'edit' )
            <a href="{{ url('') }}/carrier/estimate/{{ old('estimate_id') }}/edit" class="btn btn-block btn-primary">編集画面に戻る</a>
            @endif
        </p>

    </div>
</div>

@endsection
