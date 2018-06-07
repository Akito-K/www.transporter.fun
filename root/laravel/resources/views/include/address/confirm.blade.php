<?php
/**
 * $prefix
 */
$prefix_sei = $prefix.'sei';
$prefix_mei = $prefix.'mei';
$prefix_zip1 = $prefix.'zip1';
$prefix_zip2 = $prefix.'zip2';
$prefix_pref_id = $prefix.'pref_id';
$prefix_city = $prefix.'city';
$prefix_address = $prefix.'address';
$prefix_tels = $prefix.'tels';

if(!isset($prefs)){
    $prefs = \Func::getPrefNames();
}
?>
<ul class="lists">
    <li class="list list-title">氏名</li>
    <li class="list list-value">{{ old($prefix_sei) }} {{ old($prefix_mei) }}
    </li>
</ul>
<ul class="lists">
    <li class="list list-title must">住所</li>
    <li class="list list-value">
        〒 {{ old($prefix_zip1) }} - {{ old($prefix_zip2) }}<br />
        {{ $prefs[ old($prefix_pref_id) ] }} {{ old($prefix_city) }}<br />
        {{ old($prefix_address) }}
    </li>
</ul>
<ul class="lists">
    <li class="list list-title">電話番号</li>
    <li class="list list-value">{!! \Func::telFormat( old($prefix_tels) ) !!}</li>
</ul>

{!! Form::hidden( $prefix_sei , old( $prefix_sei )) !!}
{!! Form::hidden( $prefix_mei , old( $prefix_mei )) !!}
{!! Form::hidden( $prefix_zip1 , old( $prefix_zip1 )) !!}
{!! Form::hidden( $prefix_zip2 , old( $prefix_zip2 )) !!}
{!! Form::hidden( $prefix_pref_id , old( $prefix_pref_id )) !!}
{!! Form::hidden( $prefix_city , old( $prefix_city )) !!}
{!! Form::hidden( $prefix_address , old( $prefix_address )) !!}
{!! Form::hidden( $prefix_tels.'[1]' , old( $prefix_tels.'.1' )) !!}
{!! Form::hidden( $prefix_tels.'[2]' , old( $prefix_tels.'.2' )) !!}
{!! Form::hidden( $prefix_tels.'[3]' , old( $prefix_tels.'.3' )) !!}
