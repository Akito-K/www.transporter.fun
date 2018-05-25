<div class="estimate-message__lists estimate-message__lists--you">
    <div class="estimate-message__list estimate-message__list--you">
        <div class="estimate-message__list__img estimate-message__list__img--you">
            {!! \MyHTML::Thumbnail( \Func::getImage( $data->icon_filepath ) ) !!}
        </div>
        <div class="estimate-message__list__info estimate-message__list__info--you">
            <p class="estimate-message__list__company">{{ $data->company }}</p>
            <p class="estimate-message__list__name">{{ $data->sei }} {{ $data->mei }}</p>
            <p class="estimate-message__list__messaged-at">{{ \Func::dateFormat( $date_at, 'Y/m/d H:i' ) }}</p>
        </div>
    </div>
    <div class="estimate-message__list estimate-message__list--yours">
        {!! $body !!}
        <p class="estimate-message__list__fukidashi estimate-message__list__fukidashi--you">
            @include('include.svg.fukidashi01')
        </p>
    </div>
</div>
