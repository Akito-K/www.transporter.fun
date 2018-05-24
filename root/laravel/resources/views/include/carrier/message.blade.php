<div class="work__box__suggest work__box__suggest--confirm">
    <ul class="lists">
        <li class="list list-title">受注メッセージ</li>
        <li class="list list-value">
            {!! \Func::N2BR( $data->receive_message ) !!}
        </li>
    </ul>
    <ul class="lists">
        <li class="list list-title">発注メッセージ<br>（{{ $order_data->owner_name }}）</li>
        <li class="list list-value">
            {!! \Func::N2BR( $data->place_message ) !!}
        </li>
    </ul>
    <ul class="lists">
        <li class="list list-title">提案メッセージ</li>
        <li class="list list-value">
            {!! \Func::N2BR( $data->suggest_message ) !!}
        </li>
    </ul>
</div>
