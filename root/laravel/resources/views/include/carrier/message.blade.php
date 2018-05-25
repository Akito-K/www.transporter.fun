<div class="work__box__suggest work__box__suggest--confirm">
    <h6 class="work__box__subtitle">受注メッセージ</h6>
    @include('include.estimate_message_me', [
        'data' => $carrier,
        'date_at' => $estimate_data->received_at,
        'body' => \Func::N2BR( $data->receive_message )
        ])

    <h6 class="work__box__subtitle">発注メッセージ</h6>
    @include('include.estimate_message_you', [
        'data' => $owner_data,
        'date_at' => $estimate_data->placed_at,
        'body' => \Func::N2BR( $estimate_data->place_message )
        ])

    <h6 class="work__box__subtitle">提案メッセージ</h6>
    @include('include.estimate_message_me', [
        'data' => $carrier,
        'date_at' => $estimate_data->suggested_at,
        'body' => \Func::N2BR( $estimate_data->suggest_message )
        ])

</div>
