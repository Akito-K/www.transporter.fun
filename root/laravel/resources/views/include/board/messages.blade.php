<?php
/**
 * @param $messages
 * @param $user
 *
 */
?>
@if (!empty($messages))
@foreach ($messages as $message)

@include('include.board.message', ['user' => $user])

@endforeach
@endif
