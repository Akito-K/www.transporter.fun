<div class="work__box__suggest work__box__suggest--confirm">
    <ul class="lists">
        <li class="list list-title">入金手続日時</li>
        <li class="list list-value">
            {!! \Func::dateFormat( $payed_data->payed_at, 'y/n/j(wday) H:i' ) !!}
        </li>
    </ul>
    <ul class="lists">
        <li class="list list-title">入金処理種別</li>
        <li class="list list-value">
            {{ $payed_data->type_str }}
        </li>
    </ul>
    <ul class="lists">
        <li class="list list-title">金融機関名</li>
        <li class="list list-value">
            {{ $payed_data->bank_name }}
        </li>
    </ul>
    <ul class="lists">
        <li class="list list-title">入金金額</li>
        <li class="list list-value">
            ￥{{ number_format( $payed_data->amount ) }}
        </li>
    </ul>

</div>
