<?php
/**
 * $date_input_name
 */
$name_at = $date_input_name.'_at';
$hide_at = 'hide_'.$name_at;
$add_class = $add_class?: '';
/**
 * $placeholder
 */
?>
<div class="date-input trigShowCalendar" data-calendar="{{ $date_input_name }}">
    {!! Form::text($name_at, old($name_at)?: $req_data->$name_at, ['id' => $name_at, 'placeholder' => $placeholder, 'class' => 'form-control '.$add_class, 'readonly' => 'readonly']) !!}
    {!! Form::hidden($hide_at, old($hide_at)?: $req_data->$hide_at, ['id' => $hide_at]) !!}
    <i class="fa fa-calendar"></i>
</div>
