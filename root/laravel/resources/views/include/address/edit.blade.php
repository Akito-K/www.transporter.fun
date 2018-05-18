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
$prefix_tels = $prefix.'tels';
?>
<ul class="lists">
    <li class="list list-title">氏名</li>
    <li class="list list-value">
        {!! \Form::text($prefix_sei, old($prefix_sei, $data->$prefix_sei), ['class' => 'form-control form-control--mini form-control--40', 'id' => $prefix_sei]) !!}
        {!! \Form::text($prefix_mei, old($prefix_mei, $data->$prefix_mei), ['class' => 'form-control form-control--mini form-control--40', 'id' => $prefix_mei]) !!}
    </li>
</ul>
<ul class="lists">
    <li class="list list-title must">郵便番号</li>
    <li class="list list-value">
        〒 {!! \Form::number($prefix_zip1, old($prefix_zip1, $data->$prefix_zip1), ['class' => 'form-control form-control--mini form-control--30', 'id' => $prefix_zip1]) !!}
        - {!! \Form::number($prefix_zip2, old($prefix_zip2, $data->$prefix_zip2), ['class' => 'form-control form-control--mini form-control--40', 'id' => $prefix_zip2, 'onKeyUp' => 'AjaxZip3.zip2addr(\''.$prefix.'zip1\', \''.$prefix.'zip2\', \''.$prefix.'pref_code\',\''.$prefix.'city\', \''.$prefix.'address\');']) !!}
    </li>
</ul>
<ul class="lists">
    <li class="list list-title must">都道府県</li>
    <li class="list list-value">
        {!! \Form::select($prefix_pref_code, $prefs, old($prefix_pref_code, $data->$prefix_pref_code), ['class' => 'form-control', 'id' => $prefix_pref_code]) !!}
    </li>
</ul>
<ul class="lists">
    <li class="list list-title must">市区町</li>
    <li class="list list-value">
        {!! \Form::text($prefix_city, old($prefix_city, $data->$prefix_city), ['class' => 'form-control', 'id' => $prefix_city]) !!}
    </li>
</ul>
<ul class="lists">
    <li class="list list-title must">以降の住所</li>
    <li class="list list-value">
        {!! \Form::textarea($prefix_address, old($prefix_address, $data->$prefix_address), ['class' => 'form-control', 'id' => $prefix_address]) !!}
    </li>
</ul>
<ul class="lists">
    <li class="list list-title">電話番号</li>
    <li class="list list-value">
        <ul class="params">
            <li class="param param-30">{!! Form::text($prefix.'tels[1]', old($prefix.'tels[1]', $data->$prefix_tels[1]), ['class' => 'form-control', 'id' => $prefix.'tels-1']) !!}</li>
            <li class="param param-10">-</li>
            <li class="param param-40">{!! Form::text($prefix.'tels[2]', old($prefix.'tels[2]', $data->$prefix_tels[2]), ['class' => 'form-control', 'id' => $prefix.'tels-2']) !!}</li>
            <li class="param param-10">-</li>
            <li class="param param-40">{!! Form::text($prefix.'tels[3]', old($prefix.'tels[3]', $data->$prefix_tels[3]), ['class' => 'form-control', 'id' => $prefix.'tels-3']) !!}</li>
        </ul>
    </li>
</ul>