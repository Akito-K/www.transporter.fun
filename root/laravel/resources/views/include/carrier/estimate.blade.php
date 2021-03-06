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
                    {{ $data->estimate_number }}</td>
            </tr>
            <tr>
                <td class="estimate__table__cell align-right">見積日</td>
                <td class="estimate__table__cell" colspan="2">:
                    {{ date_format($data->estimated_at, 'Y年n月j日') }}</td>
            </tr>
            <tr>
                <td class="estimate__table__cell" colspan="3">
                    「<span id="bulletQuoteOrderName">{{ $order_data->name }}</span>」のお見積
                </td>
                <td class="estimate__table__cell align-right">有効期限</td>
                <td class="estimate__table__cell" colspan="2">:
                    {{ date_format($data->limit_at, 'Y年n月j日') }}</td>
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

            @if(!empty($data->items))
            @foreach( $data->items as $num => $item )
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
                    {{ number_format($data->total) }} 円
                </td>
                <td class="estimate__table__cell" colspan="4">
                    特記事項<br />
                    {!! \Func::N2BR( $data->notes ) !!}
                </td>
            </tr>
            <tr>
                <td class="estimate__table__cell estimate__table__cell--space" colspan="6"></td>
            </tr>
            <tr>
                <td class="estimate__table__cell" colspan="4">
                <td class="estimate__table__cell estimate__table__cell--carrier align-right" colspan="2">
                    作成者・・・{{ $carrier_data->company }}<br />（担当：{{ $carrier_data->sei }}{{ $carrier_data->mei }}）
                </td>
            </tr>
        </tbody>
    </table>
</div>

