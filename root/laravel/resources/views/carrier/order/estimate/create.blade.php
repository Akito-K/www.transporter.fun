@extends('layouts.carrier')
@section('content')
@include('include.calendar')

{!! MyHTML::errorMessage($errors) !!}
{!! MyHTML::flashMessage() !!}

<div class="box">
    <div class="box-body">
        <h2 class="page-header">見積作成</h2>

        <div class="request__block">
            {!! Form::open(['url' => 'carrier/order/estimate/confirm', 'class' => 'request__boxes']) !!}

                <h4 class="order__box__title trigAccordOrderBox" data-open="0">案件情報</h4>
                <div class="request__order bulletAccordOrderBox initial-close">
                    @include('include.carrier.order_estimate', ['data' => $data])
                </div>

                <div class="estimate">
                    <div class="estimate__to-item">
                        <a href="{{ url('') }}/carrier/item/create" class="btn btn-warning" target="_blank">商品を追加する</a>
                    </div>
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
                                    <td class="estimate__table__cell" colspan="3" rowspan="2">
                                        @if( $data->flag_hide_owner )
                                        *** （非公開） 様
                                        @else
                                        {{ $data->owner->company }}<br />
                                        {{ $data->user->sei }} {{ $data->user->mei }} 様
                                        @endif
                                    </td>
                                    <td class="estimate__table__cell align-right">見積番号</td>
                                    <td class="estimate__table__cell align-right" colspan="2">
                                        {!! Form::text('number', '', ['class' => 'form-control form-control--xsm']) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="estimate__table__cell align-right">見積日</td>
                                    <td class="estimate__table__cell align-right" colspan="2">
                                        @include('include.date_input', ['date_input_name' => 'estimated', 'placeholder' => '必須', 'req_data' => $estimate_data, 'add_class' => 'form-control--xsm'])
                                    </td>
                                </tr>
                                <tr>
                                    <td class="estimate__table__cell" colspan="3">
                                        「{{ $data->name }}」のお見積もり
                                    </td>
                                    <td class="estimate__table__cell align-right">有効期限</td>
                                    <td class="estimate__table__cell align-right" colspan="2">
                                        @include('include.date_input', ['date_input_name' => 'limit', 'placeholder' => '必須', 'req_data' => $estimate_data, 'add_class' => 'form-control--xsm'])
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
                                <tr class="estimate__table__margin-top bulletItem" data-num="0">
                                    <td class="estimate__table__cell estimate__table__cell--quote" colspan="3">
                                        {!! \Form::select('item[0]', $items, old('item[0]'), ['class' => 'form-control form-control--mini form-control--60 form-control--xxsm paramQuoteItem', 'data-num' => 0]) !!}
                                        <button type="button" class="btn btn-default btn-xsm trigQuoteItem" data-num="0">入力</button>
                                    </td>
                                    <td class="estimate__table__cell align-right" colspan="3">
                                        <div class="estimate__table__buttons">
                                            <span class="trigRemoveItem estimate__table__button estimate__table__button--remove" data-num="0"><i class="fa fa-minus"></i></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="estimate__table__margin-bottom bulletItem" data-num="0">
                                    <td class="estimate__table__cell estimate__table__cell--line">
                                        {!! Form::text('code[0]', old('code[0]')?: $estimate_data->items[0]->code, ['class' => 'form-control  form-control--xsm', 'data-num' => 0 ]) !!}
                                    </td>
                                    <td class="estimate__table__cell estimate__table__cell--line" colspan="2">
                                        {!! Form::text('name[0]', old('name[0]')?: $estimate_data->items[0]->name, ['class' => 'form-control  form-control--xsm', 'data-num' => 0 ]) !!}
                                    </td>
                                    <td class="estimate__table__cell estimate__table__cell--line">
                                        {!! Form::number('amount[0]', old('amount[0]')?: $estimate_data->items[0]->amount, ['class' => 'form-control  form-control--xsm trigCalculateSubTotal paramAmount', 'data-num' => 0 ]) !!}
                                    </td>
                                    <td class="estimate__table__cell estimate__table__cell--line">
                                        {!! Form::number('count[0]', old('count[0]')?: $estimate_data->items[0]->count, ['class' => 'form-control  form-control--xsm trigCalculateSubTotal paramCount', 'data-num' => 0 ]) !!}
                                    </td>
                                    <td class="estimate__table__cell estimate__table__cell--line">
                                        {!! Form::text('subtotal[0]', old('subtotal[0]')?: $estimate_data->items[0]->subtotal, ['class' => 'form-control  form-control--xsm paramSubtotal bulletSubTotal readonly', 'readonly' => 'readonly', 'data-num' => 0 ]) !!}
                                    </td>
                                </tr>
                            </tbody>

                            <tbody class="estimate__tfooter">
                                <tr class="estimate__table__margin-top">
                                    <td class="estimate__table__cell align-right" colspan="6">
                                        <div class="estimate__table__buttons">
                                            <span class="estimate__table__button estimate__table__button--add" id="trigAddItem" data-num="0"><i class="fa fa-plus"></i></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="estimate__table__cell" colspan="2">
                                        合計金額<br />
                                        {!! Form::text('total', old('total')?: $estimate_data->total, ['class' => 'form-control  form-control--mini form-control--80 readonly', 'readonly' => 'readonly', 'id' => 'bulletTotal']) !!} 円
                                    </td>
                                    <td class="estimate__table__cell" colspan="4">
                                        特記事項<br />
                                        {!! Form::textarea('notes', old('notes')?: $estimate_data->notes, ['class' => 'form-control']) !!}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

                {!! Form::submit('確認画面へ進む', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
            {!! \Form::close() !!}

        </div>

        <p>
            <a href="{{ url('') }}/carrier/request" class="btn btn-block btn-primary">一覧に戻る</a>
        </p>

    </div>
</div>

@endsection
