<?php
if( !isset($data) ){
    $data = new \stdClass();
    $data->name = "";
    $data->count = 0;
    $data->filepath = "";
}

?>
<div class="account__cars__box-wrap bulletRemoveEditCar" data-num="{{ $number }}">
    <h5 class="account__cars__box__title">車両 {{ $number }}</h5>
    <ul class="params account__cars__box">
        <li class="param param-100">
            <ul class="lists lists-top">
                <li class="list list-40 list-mr-sm list-mb-sm list-left">
                    <p>{!! Form::text('names['.$number.']', $data->name, ['class' => 'form-control', 'placeholder' => '車両名称' ]) !!}</p>
                    <p>{!! Form::selectRange('counts['.$number.']', 1, 20, $data->count, ['class' => 'form-control form-control--mini form-control--50', 'placeholder' => '0' ]) !!} 台</p>
                </li>
                <li class="list list-50">
                    @include('include.multiple_upload', ['number' => $number, 'target' => 'cars', 'data' => $data ])
                </li>
            </ul>
        </li>

        <li class="param param-10 list-center account__cars__box__btns">
            <span class="account__cars__box__btn account__cars__box__btn--minus trigRemoveEditCar" data-num="{{ $number }}"><i class="fa fa-minus"></i></span>
        </li>
    </ul>

</div>
