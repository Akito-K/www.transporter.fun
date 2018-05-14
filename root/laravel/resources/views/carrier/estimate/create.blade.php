@extends('layouts.carrier')
@section('content')
@include('include.calendar')

{!! MyHTML::errorMessage($errors) !!}
{!! MyHTML::flashMessage() !!}

<div class="box">
    <div class="box-body">
        <h2 class="page-header">見積作成</h2>

        <div class="request__block">
            {!! Form::open(['url' => 'carrier/estimate/confirm', 'class' => 'request__boxes']) !!}
                <ul class="lists">
                    <li class="list list">
                        {!! Form::select('order_id', $select_orders_names, $data->order_id, ['class' => 'form-control', 'id' => 'paramQuoteOrder']) !!}
                    </li>
                    <li class="list">
                        <button type="button" class="btn btn-default" id="trigQuoteOrder">見積もり対象を変更する</button>
                    </li>
                </ul>

                <h4 class="order__box__title trigAccordOrderBox" data-open="0">案件情報</h4>
                <div class="request__order bulletAccordOrderBox initial-close" id="bulletQuoteOrder">
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
                                    <td class="estimate__table__cell" id="bulletQuoteOrderOwner" colspan="3" rowspan="2">
                                        {!! \Func::N2BR($data->owner) !!}様
                                    </td>
                                    <td class="estimate__table__cell align-right">見積番号</td>
                                    <td class="estimate__table__cell align-right" colspan="2">
                                        {!! Form::text('number', '', ['class' => 'form-control form-control--xsm']) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="estimate__table__cell align-right">見積日</td>
                                    <td class="estimate__table__cell align-right" colspan="2">
                                        @include('include.date_input', ['date_input_name' => 'estimated', 'placeholder' => '必須', 'req_data' => $estimate_data, 'add_class' => 'form-control--xsm', 'default_input_at' => $default_estimated_at ])
                                    </td>
                                </tr>
                                <tr>
                                    <td class="estimate__table__cell" colspan="3">
                                        「<span id="bulletQuoteOrderName">{{ $data->name }}</span>」のお見積もり
                                    </td>
                                    <td class="estimate__table__cell align-right">有効期限</td>
                                    <td class="estimate__table__cell align-right" colspan="2">
                                        @include('include.date_input', ['date_input_name' => 'limit', 'placeholder' => '必須', 'req_data' => $estimate_data, 'add_class' => 'form-control--xsm', 'default_input_at' => $default_limit_at ])
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

                                @if(!empty($estimate_data->items))
                                @php $num = 0; @endphp
                                @foreach( $estimate_data->items as $num => $item )
                                <tr class="estimate__table__margin-top bulletRemoveItem" data-num="{{ $num }}">
                                    <td class="estimate__table__cell estimate__table__cell--quote" colspan="3">
                                        {!! \Form::select('item['.$num.']', $items, old('item['.$num.']'), ['class' => 'form-control form-control--mini form-control--60 form-control--xxsm paramQuoteItem', 'data-num' => $num]) !!}
                                        <button type="button" class="btn btn-default btn-xsm trigQuoteItem" data-num="{{ $num }}">入力</button>
                                    </td>
                                    <td class="estimate__table__cell align-right" colspan="3">
                                        <div class="estimate__table__buttons">
                                            <span class="trigRemoveItem estimate__table__button estimate__table__button--remove" data-num="{{ $num }}"><i class="fa fa-minus"></i></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="bulletRemoveItem" data-num="{{ $num }}">
                                    <td class="estimate__table__cell">
                                        {!! Form::text('code['.$num.']', old('code['.$num.']')?: $estimate_data->items[$num]->code, ['class' => 'form-control  form-control--xsm', 'data-num' => $num, 'id' => 'code_0', 'placeholder' => '型番' ]) !!}
                                    </td>
                                    <td class="estimate__table__cell" colspan="2">
                                        {!! Form::text('name['.$num.']', old('name['.$num.']')?: $estimate_data->items[$num]->name, ['class' => 'form-control  form-control--xsm', 'data-num' => $num, 'id' => 'name_0', 'placeholder' => '名称' ]) !!}
                                    </td>
                                    <td class="estimate__table__cell">
                                        {!! Form::number('amount['.$num.']', old('amount['.$num.']')?: $estimate_data->items[$num]->amount, ['class' => 'form-control  form-control--xsm trigCalculateSubTotal paramAmount', 'data-num' => $num, 'id' => 'amount_0', 'placeholder' => '単価' ]) !!}
                                    </td>
                                    <td class="estimate__table__cell">
                                        {!! Form::number('count['.$num.']', old('count['.$num.']')?: $estimate_data->items[$num]->count, ['class' => 'form-control  form-control--xsm trigCalculateSubTotal paramCount', 'data-num' => $num, 'placeholder' => '数量' ]) !!}
                                    </td>
                                    <td class="estimate__table__cell">
                                        {!! Form::text('subtotal['.$num.']', old('subtotal['.$num.']')?: $estimate_data->items[$num]->subtotal, ['class' => 'form-control  form-control--xsm paramSubtotal bulletSubTotal readonly', 'readonly' => 'readonly', 'data-num' => $num, 'placeholder' => '小計' ]) !!}
                                    </td>
                                </tr>
                                <tr class="estimate__table__margin-bottom bulletRemoveItem" data-num="{{ $num }}">
                                    <td class="estimate__table__cell estimate__table__cell--sm-title estimate__table__cell--line align-right">
                                        （特記事項）
                                    </td>
                                    <td class="estimate__table__cell estimate__table__cell--notes estimate__table__cell--line" colspan="4">
                                        {!! Form::textarea('notes['.$num.']', old('notes['.$num.']')?: $estimate_data->items[$num]->notes, ['class' => 'form-control form-control--xsm paramNote bulletNotes', 'data-num' => $num, 'id' => 'notes_0', 'placeholder' => '' ]) !!}
                                    </td>
                                    <td class="estimate__table__cell estimate__table__cell--line"></td>
                                </tr>
                                @endforeach
                                @endif

                            </tbody>

                            <tbody class="estimate__tfooter">
                                <tr class="estimate__table__margin-top">
                                    <td class="estimate__table__cell align-right" colspan="6">
                                        <div class="estimate__table__buttons">
                                            <span class="estimate__table__button estimate__table__button--add" id="trigAddItem" data-num="{{ $num }}"><i class="fa fa-plus"></i></span>
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
