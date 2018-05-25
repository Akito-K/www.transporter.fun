<div class="work__box__suggest">
    <ul class="lists">
        <li class="list list-title">現地到着日時</li>
        <li class="list list-value">
            {!! \Func::dateFormat( $data->arrived_at, 'Y/n/j(wday) H時' ) !!}
        </li>
    </ul>
    <ul class="lists">
        <li class="list list-title">荷降ろし完了日時</li>
        <li class="list list-value">
            {!! \Func::dateFormat( $data->completed_at, 'Y/n/j(wday) H時' ) !!}
        </li>
    </ul>
    <ul class="lists">
        <li class="list list-title">トラブル報告</li>
        <li class="list list-value">
            {!! \Func::N2BR( $data->trouble ) !!}
        </li>
    </ul>
    <ul class="lists">
        <li class="list list-title">その他コメント</li>
        <li class="list list-value">
            {!! \Func::N2BR( $data->comment ) !!}
        </li>
    </ul>
    <ul class="lists">
        <li class="list list-title">受領書・報告書ファイル添付</li>
        <li class="list list-value">
        </li>
    </ul>
</div>