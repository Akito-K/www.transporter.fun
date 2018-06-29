@if(!empty($order_datas))
@foreach($order_datas as $order_data)

<li>
    <a href="/delivery_services/{{ $order_data->order_id }}/detail">
        <div class="date">
            {{ \Func::dateFormat($order_data->estimate_close_at, 'Y/m/d') }}
            @if( $order_data->is_withtoday )
            <span class="icon">本日まで！</span>
            @elseif( $order_data->is_fewdays )
            <span class="icon">近日中！</span>
            @endif
        </div>
        <p class="text">
            {{ \Func::getAddress($order_data->send, ['pref', 'city']) }} →
            {{ \Func::getAddress($order_data->arrive, ['pref', 'city']) }}
        </p>
        <p class="more">詳しく見る ＞</p>
    </a>
</li>

@endforeach
@endif
