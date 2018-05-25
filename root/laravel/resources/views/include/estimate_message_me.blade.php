<div class="estimate-message__lists estimate-message__lists--me">
    <div class="estimate-message__list estimate-message__list--me">
        <div class="estimate-message__list__img estimate-message__list__img--me">
            {!! \MyHTML::Thumbnail( \Func::getImage( $data->icon_filepath ) ) !!}
        </div>
        <div class="estimate-message__list__info estimate-message__list__info--me">
            <p class="estimate-message__list__company">{{ $data->company }}</p>
            <p class="estimate-message__list__name">{{ $data->sei }} {{ $data->mei }}</p>
            <p class="estimate-message__list__messaged-at">{{ \Func::dateFormat( $date_at, 'n/j H:i' ) }}</p>
        </div>
    </div>
    <div class="estimate-message__list estimate-message__list--mine">
        {!! $body !!}
        <p class="estimate-message__list__fukidashi estimate-message__list__fukidashi--me">
            @include('include.svg.fukidashi01')
        </p>
    </div>
</div>
