<?php
/**
 * @param $message
 * @param $my_data
 */
?>
<div class="bulletMessageBox" data-id="{{ $message->message_id }}">

    {!! \Form::hidden('', $message->message_id, ['class' => 'paramMessageIds']) !!}

    <div class="board__content__box board__content__box--staff">
        <div class="board__content__box__message board__content__box__message--staff">
            <p class="board__content__box__message__body board__content__box__message__body--staff bulletMessageBody">
                {!! \MyHTML::boardMessage($message) !!}
            </p>
            <p class="board__content__box__message__time board__content__box__message__time--staff">{!! \Func::dateFormat($message->created_at, 'n/j') !!}<br>{!! \Func::dateFormat($message->created_at, 'H:i') !!}</p>
            <p class="board__content__box__message__fukidashi board__content__box__message__fukidashi--staff">
                @include('include.svg.fukidashi01')
            </p>
        </div>
    </div>

</div>
