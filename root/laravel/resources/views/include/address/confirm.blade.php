<?php
/**
 * $prefix
 */
?>
<ul class="lists">
    <li class="list list-title">氏名</li>
    <li class="list list-value">{{ $data[ $prefix.'sei' ] }} {{ $data[ $prefix.'mei' ] }}
    </li>
</ul>
<ul class="lists">
    <li class="list list-title must">住所</li>
    <li class="list list-value">
        〒 {{ $data[ $prefix.'zip1' ] }} - {{ $data[ $prefix.'zip2' ] }}<br />
        {{ $prefs[ $data[$prefix.'pref_code'] ] }} {{ $data[$prefix.'city'] }}<br />
        {{ $data[$prefix.'address'] }}
    </li>
</ul>
<ul class="lists">
    <li class="list list-title">電話番号</li>
    <li class="list list-value">{{ $data[ $prefix.'tel' ] }}</li>
</ul>