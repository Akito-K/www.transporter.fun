<?php
if( !isset($data) ){
    $data = new \stdClass();
    $data->name = "";
    $data->notes = "";
    $data->car_id = "";
    $data->area_id = "";
    $data->count = 0;
    $data->start_at = new \DatetimeImmutable();
    $data->start_hour = 11;
    $data->start_minutes = 0;
    $data->end_at = new \DatetimeImmutable();
    $data->end_hour = 11;
    $data->end_minutes = 0;
}

?>
<div class="account__cars__box-wrap bulletRemoveEditEmpty" data-num="{{ $number }}">
    <h5 class="account__cars__box__title">空車 {{ $number }}</h5>

    <ul class="params">
        <li class="param param-100">
            <ul class="lists">
                <li class="list list-70">
                    <p>{!! Form::text('names['.$number.']', $data->name, ['class' => 'form-control', 'placeholder' => '任意の空車名' ]) !!}</p>
                    <p>{!! Form::textarea('noteses['.$number.']', $data->notes, ['class' => 'form-control', 'placeholder' => '特記事項' ]) !!}</p>
                </li>
            </ul>

            <ul class="lists">
                <li class="list list-70">
                    <ul class="params params-top">
                        <li class="param param-20 param-mr-sm">
                            {!! \MyHTML::ThumbnailSquare('', ['class' => 'bulletSelectEmptyCar', 'data-num' => $number ]) !!}
                        </li>
                        <li class="param param-80 param-left">
                            車両名を選択してください
                            {!! Form::select('car_ids['.$number.']', $car_names, $data->car_id, ['class' => 'trigSelectEmptyCar form-control', 'data-num' => $number ]) !!}
                        </li>
                    </ul>
                </li>
            </ul>

            <ul class="lists">
                <li class="list list-50 list-mb-sm">
                    <ul class="params">
                        <li class="param param-80 param-mr-sm">
                            @include('include.date_create', ['date_input_name' => 'empty_start_'.$number, 'placeholder' => '日付', 'add_class' => 'form-control', 'default_input_at' => $data->start_at ])
                        </li>
                        <li class="param param-30">
                            <select name="empty_start_hours[{{ $number }}]" class="form-control">
                                {!! \MyForm::selectHour($data->start_hour) !!}
                            </select>
                        </li>
                        <li class="param param-10">:</li>
                        <li class="param param-30">
                            <select name="empty_start_minuteses[{{ $number }}]" class="form-control">
                                {!! \MyForm::selectMinutes($data->start_minutes) !!}
                            </select>
                        </li>
                    </ul>
                </li>
                <li class="list list-50">
                    <ul class="params">
                        <li class="param param-10 param-mr-md">～ </li>
                        <li class="param param-80 param-mr-sm">
                            @include('include.date_create', ['date_input_name' => 'empty_end_'.$number, 'placeholder' => '日付', 'add_class' => 'form-control', 'default_input_at' => $data->end_at ])
                        </li>
                        <li class="param param-30">
                            <select name="empty_end_hours[{{ $number }}]" class="form-control">
                                {!! \MyForm::selectHour($data->end_hour) !!}
                            </select>
                        </li>
                        <li class="param param-10">:</li>
                        <li class="param param-30">
                            <select name="empty_end_minuteses[{{ $number }}]" class="form-control">
                                {!! \MyForm::selectMinutes($data->end_minutes) !!}
                            </select>
                        </li>
                    </ul>
                </li>
            </ul>

            <ul class="lists">
                <li class="list list-50 list-mb-sm">
                    <ul class="params">
                        <li class="param param-40 param-left">所在エリア</li>
                        <li class="param param-60 param-left">
                            {!! Form::select('area_ids['.$number.']', $area_names, $data->area_id, ['class' => 'form-control' ]) !!}
                        </li>
                    </ul>
                </li>
                <li class="list list-50">
                    <ul class="params">
                        <li class="param param-40 param-left">空車台数</li>
                        <li class="param param-60 param-left">
                            {!! Form::selectRange('counts['.$number.']', 1, 20, $data->count, ['class' => 'form-control form-control--mini form-control--50', 'placeholder' => '0' ]) !!} 台
                        </li>
                    </ul>
                </li>
            </ul>
        </li>

        <li class="param param-10 list-center account__cars__box__btns">
            <span class="account__cars__box__btn account__cars__box__btn--minus trigRemoveEditEmpty" data-num="{{ $number }}"><i class="fa fa-minus"></i></span>
        </li>
    </ul>

</div>
