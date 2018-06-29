<div class="account__box account__box--carrier">
    <h5 class="account__box__title">基本情報</h5>
    <ul class="lists">
        <li class="list list-title">社名</li>
        <li class="list list-value">{{ $carrier_data->company }}</li>
    </ul>
    <ul class="lists">
        <li class="list list-title">スター</li>
        <li class="list list-value">{!! $carrier_data->star !!}</li>
    </ul>

    <ul class="lists">
        <li class="list list-title">部署名</li>
        <li class="list list-value">{{ $carrier_data->section }}</li>
    </ul>
    <ul class="lists">
        <li class="list list-title">役職</li>
        <li class="list list-value">{{ $carrier_data->role }}</li>
    </ul>

    <ul class="lists">
        <li class="list list-title">担当者名</li>
        <li class="list list-value">{{ $carrier_data->sei }} {{ $carrier_data->mei }}</li>
    </ul>

    <ul class="lists">
        <li class="list list-title">所在地</li>
        <li class="list list-value">{{ \Func::getAddress( $carrier_data ) }}</li>
    </ul>
    <ul class="lists">
        <li class="list list-title">電話番号</li>
        <li class="list list-value">{{ $carrier_data->tel }}</li>
    </ul>
    <ul class="lists">
        <li class="list list-title">サイトURL</li>
        <li class="list list-value">{!! \Func::stringToAnchor( $carrier_data->site_url ) !!}</li>
    </ul>
    <ul class="lists">
        <li class="list list-title">メッセージ</li>
        <li class="list list-value">{!! \Func::N2BR( $carrier_data->message ) !!}</li>
    </ul>
</div>