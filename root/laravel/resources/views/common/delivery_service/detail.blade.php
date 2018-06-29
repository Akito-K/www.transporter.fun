@extends('layouts.common.www')
@section('content')

<div class="crumb">
    <div class="container">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/delivery_services">物流サービス情報一覧</a></li>
            <li><span>{{ $order_data->name }}</span></li>
        </ul>
    </div>
</div>

<div class="page_request_search page_search page_main page_home">
    <div class="container">

        <article class="content">
            <h2 class="title_style02 mb0">
                {{ $order_data->name }}
                @if( $order_data->is_withtoday )
                <span class="deadline_badge">本日まで！</span>
                @elseif( $order_data->is_fewdays )
                <span class="deadline_badge">近日中！</span>
                @endif
            </h2>
            <p class="alR mb10">情報更新日：{{ \Func::dateFormat($order_data->updated_at, 'Y/m/d') }}</p>

            <section class="sec">
                <div class="d_table">
                    <div class="cell">
                        <div class="detail_img">
                            <img src="{{ env('www_url') }}/assets/images/delivery_services/transporter_id/weight05.jpg" alt="transporter" width="233" height="240">
                        </div>
                    </div>
                    <div class="cell">
                        <table class="detail_table">
                            <tr><th colspan="2">基本情報</th></tr>
                            <tr><th>案件名</th><td>{{ $order_data->name }}</td></tr>
                            <tr><th>案件クラス</th><td>{{ $order_data->carrier_class }}</td></tr>
                            <tr><th>発送予定日時</th><td>{!! \Func::dateFormat($order_data->send_at, 'Y/n/j(wday)') !!} {{ $order_data->send_timezone_str }}</td></tr>
                            <tr><th>到着予定日時</th><td>{!! \Func::dateFormat($order_data->arrive_at, 'Y/n/j(wday)') !!} {{ $order_data->arrive_timezone_str }}</td></tr>
                            <tr><th colspan="2">運搬物</th></tr>
                            <tr><th>品名</th><td>{{ $order_data->cargo_name }}</td></tr>
                            <tr><th>寸法（mm）</th>
                                <td>
                                    L:{{ number_format($order_data->cargo_size_L) }}mm
                                    W:{{ number_format($order_data->cargo_size_W) }}mm
                                    H:{{ number_format($order_data->cargo_size_H) }}mm
                                </td>
                            </tr>
                            <tr><th>個数（個）</th><td>{{ $order_data->cargo_count }}個</td></tr>
                            <tr><th>重量（kg）</th><td>{!! number_format($order_data->cargo_weight) !!} kg/個</td></tr>
                            <tr><th>総重量（kg）</th><td>{!! number_format($order_data->cargo_count * $order_data->cargo_weight) !!} kg</td></tr>
                            <tr><th>荷姿</th><td>{{ $order_data->cargo_form }}</td></tr>
                            <tr><th colspan="2">希望車種</th></tr>
                            <tr><td colspan="2">{{ $order_data->order_request_results->car }}</td></tr>
                            <tr><th colspan="2">オプション装備</th></tr>
                            <tr><th>オプション設備</th><td>{{ $order_data->order_request_results->equipment }}</td></tr>
                            <tr><th>オプションその他</th><td>{{ $order_data->order_request_results->other }}</td></tr>
                            <tr><th colspan="2">その他</th></tr>
                            <tr><th>特記事項</th><td>{!! \Func::N2BR( $order_data->notes ) !!}</td></tr>
                            <tr><th>希望の価格帯</th><td>{{ number_format($order_data->amount_hope_min) }} ～ {{ number_format($order_data->amount_hope_max) }} 円</td></tr>
                        </table>
                    </div>
                </div>
                <div class="alC">
                    <a class="btn_style02 btn_style02_short" href="/carrier/estimate/{{ $order_data->order_id }}/create" target="_blank">見積りを提案する</a>
                </div>
            </section>
        </article>

    </div>
    <div class="totop"><a class="scroll" href="#wrapper"></a></div>

</div><!-- .page_main -->

@endsection
