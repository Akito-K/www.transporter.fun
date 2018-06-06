<ul class="board__you__boxes">
    <li class="board__you__box board__you__box--thumbnail">
        {!! \MyHTML::Thumbnail( \Func::getImage( $data->icon_filepath ) ) !!}
    </li>
    <li class="board__you__box board__you__box--info">
        <p class="board__you__name">{{ $data->name }} さん</p>
        <p class="board__you__company">{{ $data->company }}</p>
        <p class="board__you__fullkana">{{ $data->sei_kana }} {{ $data->mei_kana }}</p>
        <p class="board__you__fullname">{{ $data->sei }} {{ $data->mei }} さん</p>
    </li>
</ul>
