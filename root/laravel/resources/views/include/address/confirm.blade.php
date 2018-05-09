<?php
/**
 * $prefix
 */
$prefix_sei = $prefix.'sei';
$prefix_mei = $prefix.'mei';
$prefix_zip1 = $prefix.'zip1';
$prefix_zip2 = $prefix.'zip2';
$prefix_pref_code = $prefix.'pref_code';
$prefix_city = $prefix.'city';
$prefix_address = $prefix.'address';
$prefix_tel = $prefix.'tel';
?>
<ul class="lists">
    <li class="list list-title">氏名</li>
    <li class="list list-value">{{ $data->$prefix_sei }} {{ $data->$prefix_mei }}
    </li>
</ul>
<ul class="lists">
    <li class="list list-title must">住所</li>
    <li class="list list-value">
        〒 {{ $data->$prefix_zip1 }} - {{ $data->$prefix_zip2 }}<br />
        {{ $prefs[ $data->$prefix_pref_code ] }} {{ $data->$prefix_city }}<br />
        {{ $data->$prefix_address }}
    </li>
</ul>
<ul class="lists">
    <li class="list list-title">電話番号</li>
    <li class="list list-value">{{ $data->$prefix_tel }}</li>
</ul>