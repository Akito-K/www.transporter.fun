@extends('layouts.carrier')
@section('content')
@include('include.calendar')

<div class="block-hide">
    @if(!empty($car_datas))
    @foreach($car_datas as $k => $car_data)
    <span class="paramCarData" data-id="{{ $car_data->car_id }}" data-filepath="{{ $car_data->filepath }}"></span>
    @endforeach
    @endif
</div>

<div class="box">
    <div class="box-body">
        <h2 class="page-header">運送会社 空車情報</h2>

        <div class="account__box">
            {!! Form::open(['url' => 'carrier/account/empty/update', 'class' => '']) !!}

                <div class="account__cars__boxes" id="bulletEditEmpties">
                    @php $num = 0; @endphp

                    @if(!empty($empty_datas))
                    @foreach($empty_datas as $k => $empty_data)
                    @php $num++; @endphp
                    @include('include.carrier.edit_empty', ['number' => $num, 'data' => $empty_data ])
                    @endforeach

                    @else
                    @php $num++; @endphp
                    @include('include.carrier.edit_empty', ['number' => $num])

                    @endif

                </div>

                <div class="account__cars__btns-plus">
                    <div>
                        <span class="account__cars__box__btn account__cars__box__btn--plus" id="trigAddEditEmpty" data-num="{{ $num }}"><i class="fa fa-plus"></i></span>
                    </div>
                </div>

                {!! Form::submit('更新する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
                <a href="{{ url('') }}/carrier/account" class="btn btn-primary btn-block btn-sm">運送会社情報に戻る</a>
            {!! \Form::close() !!}
        </div>

    </div>
</div>

@endsection
