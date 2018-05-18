@extends('layouts.carrier')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">見積詳細</h2>

        <div class="request__block">
            <div class="request__boxes">

                <h4 class="order__box__title trigAccordOrderBox" data-open="0">案件情報</h4>
                <div class="request__order bulletAccordOrderBox initial-close" id="bulletQuoteOrder">
                    @include('include.carrier.order_estimate', ['data' => $data])
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
                                        {!! \Func::N2BR($data->owner) !!}様
                                    </td>
                                    <td class="estimate__table__cell align-right">見積番号</td>
                                    <td class="estimate__table__cell" colspan="2">:
                                        {{ $estimate_data->number }}</td>
                                </tr>
                                <tr>
                                    <td class="estimate__table__cell align-right">見積日</td>
                                    <td class="estimate__table__cell" colspan="2">:
                                        {{ date_format($estimate_data->estimated_at, 'Y年n月j日') }}</td>
                                </tr>
                                <tr>
                                    <td class="estimate__table__cell" colspan="3">
                                        「<span id="bulletQuoteOrderName">{{ $data->name }}</span>」のお見積
                                    </td>
                                    <td class="estimate__table__cell align-right">有効期限</td>
                                    <td class="estimate__table__cell" colspan="2">:
                                        {{ date_format($estimate_data->limit_at, 'Y年n月j日') }}</td>
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
                                @foreach( $estimate_data->items as $num => $item )
                                <tr class="estimate__table__margin-top">
                                    <td class="estimate__table__cell">{{ $item->code }}</td>
                                    <td class="estimate__table__cell" colspan="2">{{ $item->name }}</td>
                                    <td class="estimate__table__cell">{{ $item->amount }}</td>
                                    <td class="estimate__table__cell">{{ $item->count }}</td>
                                    <td class="estimate__table__cell">{!! number_format( $item->amount * $item->count ) !!}</td>
                                </tr>
                                <tr class="estimate__table__margin-bottom">
                                    <td class="estimate__table__cell estimate__table__cell--sm-title estimate__table__cell--line align-right">
                                        （特記事項）
                                    </td>
                                    <td class="estimate__table__cell estimate__table__cell--notes estimate__table__cell--line" colspan="4">
                                        {!! \Func::N2BR($item->notes)  !!}
                                    </td>
                                    <td class="estimate__table__cell estimate__table__cell--line"></td>
                                </tr>
                                @endforeach
                                @endif

                            </tbody>

                            <tbody class="estimate__tfooter">
                                <tr>
                                    <td class="estimate__table__cell estimate__table__cell--total" colspan="2">
                                        合計金額<br />
                                        {{ number_format($estimate_data->total) }} 円
                                    </td>
                                    <td class="estimate__table__cell" colspan="4">
                                        特記事項<br />
                                        {!! \Func::N2BR( $estimate_data->notes ) !!}
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

            </div>

        </div>

        <p>
            <a href="{{ url('') }}/carrier/estimate/{{ $estimate_data->order_id }}/list" class="btn btn-block btn-primary">この案件の見積一覧に戻る</a>
            <a href="{{ url('') }}/carrier/estimate/" class="btn btn-block btn-primary">作成した見積一覧に戻る</a>
        </p>

    </div>
</div>

@endsection
