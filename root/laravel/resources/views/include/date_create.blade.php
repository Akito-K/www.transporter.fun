<?php
/**
 * $date_input_name
 */
$name_at = $date_input_name.'_at';
$hide_at = 'hide_'.$name_at;
$add_class = $add_class?: '';

$default_input_date_at = '';
$default_input_hide_at = '';
if( isset($default_input_at) && $default_input_at instanceof \DatetimeImmutable ){
    $default_input_date_at = \Func::dateFormat($default_input_at, 'Y/n/j(wday)');
    $default_input_hide_at = \Func::dateFormat($default_input_at, 'Y/n/j');
}
/**
 * $placeholder
 */
?>
<div class="date-input trigShowCalendar" data-calendar="{{ $date_input_name }}">
    {!! Form::text($name_at, old($name_at)?: $default_input_date_at, ['id' => $name_at, 'placeholder' => $placeholder, 'class' => 'form-control '.$add_class, 'readonly' => 'readonly']) !!}
    {!! Form::hidden($hide_at, old($hide_at)?: $default_input_hide_at, ['id' => $hide_at]) !!}
    <i class="fa fa-calendar"></i>
</div>
