<div class="request__order__boxes">

    <div class="request__order__box request__order__box--33">
        <h4 class="request__order__box__title">基本情報</h4>
        <table>
            <tr>
                <th>案件名</th>
                <td>{{ $data->name }}</td>
            </tr>
            <tr>
                <th>荷主名</th>
                <td>{!! $data->owner_name_with_star !!}</td>
            </tr>
            <tr>
                <th>案件クラス</th>
                <td>{{ $data->carrier_class }}</td>
            </tr>
            <tr>
                <th>発送予定日時</th>
                <td>
                    {!! \Func::dateFormat($data->send_at, 'Y/n/j(wday)') !!}
                    {{ $data->send_timezone_str }}
                </td>
            </tr>
            <tr>
                <th>到着予定日時</th>
                <td>
                    {!! \Func::dateFormat($data->arrive_at, 'Y/n/j(wday)') !!}
                    {{ $data->arrive_timezone_str }}
                </td>
            </tr>
        </table>
    </div>

    <div class="request__order__box request__order__box--66">
        <h4 class="request__order__box__title">配送情報</h4>
        <div class="params request__order__box__panels">
            <div class="param param-50 param-left request__order__box__panel">
                @include('include.address.estimate', ['prefix' => 'send_'])
            </div>
            <div class="param param-10">
                <i class="fa fa-arrow-right request__order__box__arrow"></i>
            </div>
            <div class="param param-50 param-left request__order__box__panel">
                @include('include.address.estimate', ['prefix' => 'arrive_'])
            </div>
        </div>
    </div>
</div>


<div class="request__order__boxes">
    <div class="request__order__box request__order__box--66">
        <h4 class="request__order__box__title">運搬物</h4>
        <table>
            <tr>
                <th>品名</th>
                <td>{{ $data->cargo_name }}</td>
            </tr>
            <tr>
                <th>寸法（mm）</th>
                <td>
                    L {{ $data->cargo_size_L }} x W {{ $data->cargo_size_W }} x H {{ $data->cargo_size_H }}
                </td>
            </tr>
            <tr>
                <th>個数</th>
                <td>{{ $data->cargo_count }} 個</td>
            </tr>
            <tr>
                <th>重量</th>
                <td>{!! number_format($data->cargo_weight) !!} kg/個</td>
            </tr>
            <tr>
                <th>総重量</th>
                <td>{!! number_format($data->cargo_count * $data->cargo_weight) !!} kg</td>
            </tr>
            <tr>
                <th>荷姿</th>
                <td>{{ $data->cargo_form }}</td>
            </tr>
        </table>
    </div>

    <div class="request__order__box request__order__box--33">
        <h4 class="request__order__box__title">希望オプション</h4>
        <table>
            <tr>
                <th>車種</th>
                <td>{{ $data->order_request_results->car }}</td>
            </tr>
            <tr>
                <th>設備</th>
                <td>{{ $data->order_request_results->equipment }}</td>
            </tr>
            <tr>
                <th>装備</th>
                <td>{{ $data->order_request_results->other }}</td>
            </tr>
        </table>
    </div>
</div>

<div class="request__order__boxes">
    <div class="request__order__box request__order__box--66">
        <h4 class="request__order__box__title">その他</h4>
        <table>
            <tr>
                <th>特記事項</th>
                <td>{!! \Func::N2BR( $data->notes ) !!}</td>
            </tr>
            <tr>
                <th>希望の価格帯</th>
                <td>{{ number_format($data->amount_hope_min) }} ～ {{ number_format($data->amount_hope_max) }} 円</td>
            </tr>
        </table>
    </div>

</div>

