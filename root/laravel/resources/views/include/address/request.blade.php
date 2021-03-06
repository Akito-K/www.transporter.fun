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
$prefix_tel = $prefix.'tel';

if(!isset($prefs)){
    $prefs = \Func::getPrefNames();
}
?>
<p>
    {{ $data->$prefix_sei }} {{ $data->$prefix_mei }}
</p>
<p>
    〒 {{ $data->$prefix_zip1 }} - {{ $data->$prefix_zip2 }}<br />
    {{ $prefs[ $data->$prefix_pref_id ] }} {{ $data->$prefix_city }}<br />
    {{ $data->$prefix_address }}
</p>
<p>
    {{ $data->$prefix_tel }}
</p>