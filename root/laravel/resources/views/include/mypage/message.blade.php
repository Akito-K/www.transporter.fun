<?php
/**
 * @param $message
 * @param $user
 *
 */
?>
{!! \Form::hidden('', $message->message_id, ['class' => 'paramMessageIds']) !!}

@if( !$message->flag_memo )
@if( \Func::isViewer($message->sender_user_id) )

@php
$staff = \Func::getStaff($message->sender_user_id);
@endphp

<div class="board__content__box board__content__box--customer">
    <div class="board__content__box__lists">
        <div class="board__content__box__list board__content__box__list--img">
            <span class="board__content__box__list__img" style="background-image: url({!! \Func::getImage($staff->icon_filepath) !!});"></span>
        </div>
        <div class="board__content__box__list board__content__box__list--info board__content__box__message board__content__box__message--customer">
            <p class="board__content__box__message__name">{!! $staff->sei !!} {!! $staff->mei !!}</p>
            <p class="board__content__box__message__body board__content__box__message__body--customer">
                @if($message->filepath)
                {!! \MyHTML::boardFile($message) !!}
                @else
                {!! \Func::N2BR( \Func::stringToAnchor( $message->body) ) !!}
                @endif
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
        <p class="board__content__box__message__body board__content__box__message__body--staff">
            @if($message->filepath)
            {!! \MyHTML::boardFile($message) !!}
            @else
            {!! \Func::N2BR( \Func::stringToAnchor( $message->body) ) !!}
            @endif
        </p>
        <p class="board__content__box__message__time board__content__box__message__time--staff">{!! \Func::dateFormat($message->created_at, 'n/j') !!}<br>{!! \Func::dateFormat($message->created_at, 'H:i') !!}</p>
        <p class="board__content__box__message__fukidashi board__content__box__message__fukidashi--staff">
            @include('include.svg.fukidashi01')
        </p>
    </div>
</div>
@endif
@endif
