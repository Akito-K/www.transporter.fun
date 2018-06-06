<?php
/**
 * @param $message
 * @param $user
 */
?>
<div class="bulletMessageBox" data-id="{{ $message->message_id }}">

    {!! \Form::hidden('', $message->message_id, ['class' => 'paramMessageIds']) !!}

    @if ($message->sender_user_id == $user->user_id)
    <div class="board__content__box board__content__box--customer">
        <div class="board__content__box__lists">
            <div class="board__content__box__list board__content__box__list--img">
                <span class="board__content__box__list__img" style="background-image: url({!! \Func::getImage($user->icon_filepath) !!});"></span>
            </div>
            <div class="board__content__box__list board__content__box__list--info board__content__box__message board__content__box__message--customer">
                <p class="board__content__box__message__name">{!! $user->sei !!} {!! $user->mei !!} さん</p>
                <p class="board__content__box__message__body board__content__box__message__body--customer bulletMessageBody">
                    {!! \MyHTML::boardMessage($message) !!}
                </p>
                <p class="board__content__box__message__time board__content__box__message__time--customer">{!! \Func::dateFormat($message->created_at, 'n/j') !!}<br>{!! \Func::dateFormat($message->created_at, 'H:i') !!}</p>
                <p class="board__content__box__message__fukidashi board__content__box__message__fukidashi--customer">
                    @include('include.svg.fukidashi01')
                </p>
            </div>
        </div>
    </div>

    @else
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
    @endif

</div>
