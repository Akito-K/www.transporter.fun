<?php
/**
 * $prefix
 */
?>
<ul class="lists">
    <li class="list list-title">氏名</li>
    <li class="list list-value">
        {!! \Form::text($prefix.'sei', old($prefix.'sei'), ['class' => 'form-control form-control--mini form-control--40', 'id' => $prefix.'sei']) !!}
        {!! \Form::text($prefix.'mei', old($prefix.'mei'), ['class' => 'form-control form-control--mini form-control--40', 'id' => $prefix.'mei']) !!}
    </li>
</ul>
<ul class="lists">
    <li class="list list-title must">郵便番号</li>
    <li class="list list-value">
        〒 {!! \Form::number($prefix.'zip1', old($prefix.'zip1'), ['class' => 'form-control form-control--mini form-control--30', 'id' => $prefix.'zip1']) !!}
        - {!! \Form::number($prefix.'zip2', old($prefix.'zip2'), ['class' => 'form-control form-control--mini form-control--40', 'id' => $prefix.'zip2', 'onKeyUp' => 'AjaxZip3.zip2addr(\''.$prefix.'zip1\', \''.$prefix.'zip2\', \''.$prefix.'pref_code\',\''.$prefix.'city\', \''.$prefix.'address\');']) !!}
    </li>
</ul>
<ul class="lists">
    <li class="list list-title must">都道府県</li>
    <li class="list list-value">
        {!! \Form::select($prefix.'pref_code', $prefs, old($prefix.'pref_code'), ['class' => 'form-control', 'id' => $prefix.'pref_code']) !!}
    </li>
</ul>
<ul class="lists">
    <li class="list list-title must">市区町</li>
    <li class="list list-value">
        {!! \Form::text($prefix.'city', old($prefix.'city'), ['class' => 'form-control', 'id' => $prefix.'city']) !!}
    </li>
</ul>
<ul class="lists">
    <li class="list list-title must">以降の住所</li>
    <li class="list list-value">
        {!! \Form::textarea($prefix.'address', old($prefix.'address'), ['class' => 'form-control', 'id' => $prefix.'address']) !!}
    </li>
</ul>
<ul class="lists">
    <li class="list list-title">電話番号</li>
    <li class="list list-value">
        <ul class="params">
            <li class="param param-30">{!! Form::text($prefix.'tels[1]', old($prefix.'tels[1]'), ['class' => 'form-control', 'id' => $prefix.'tels-1']) !!}</li>
            <li class="param param-10">-</li>
            <li class="param param-40">{!! Form::text($prefix.'tels[2]', old($prefix.'tels[2]'), ['class' => 'form-control', 'id' => $prefix.'tels-2']) !!}</li>
            <li class="param param-10">-</li>
            <li class="param param-40">{!! Form::text($prefix.'tels[3]', old($prefix.'tels[3]'), ['class' => 'form-control', 'id' => $prefix.'tels-3']) !!}</li>
        </ul>
    </li>
</ul>