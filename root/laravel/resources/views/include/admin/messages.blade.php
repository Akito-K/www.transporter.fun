<?php
/**
 * @param $messages
 * @param $user
 *
 */
?>
@if (!empty($messages))
@foreach ($messages as $message)

@include('include.admin.message', ['user' => $customer])

@endforeach
@endif
