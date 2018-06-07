@extends('layouts.carrier')
@section('content')

{!! Form::hidden('', '1', ['id' => 'flagMultipleUpload']) !!}

<div class="box">
    <div class="box-body">
        <h2 class="page-header">運送会社 車両情報</h2>

        <div class="account__box">
            {!! Form::open(['url' => 'carrier/account/car/update', 'class' => '']) !!}

                <div class="account__cars__boxes" id="bulletEditCars">
                    @php $num = 0; @endphp

                    @if(!empty($car_datas->toArray()))
                        @foreach($car_datas as $k => $car_data)
                        @php $num++; @endphp
                        @include('include.carrier.edit_car', ['number' => $num, 'target' => 'cars', 'data' => $car_data ])
                        @endforeach

                    @else
                        @php $num++; @endphp
                        @include('include.carrier.edit_car', ['number' => $num, 'target' => 'cars'])

                    @endif

                </div>

                <div class="account__cars__btns-plus">
                    <div>
                        <span class="account__cars__box__btn account__cars__box__btn--plus" id="trigAddEditCar" data-num="{{ $num }}"><i class="fa fa-plus"></i></span>
                    </div>
                </div>

                {!! Form::submit('更新する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
                <a href="{{ url('') }}/carrier/account" class="btn btn-primary btn-block btn-sm">運送会社情報に戻る</a>
            {!! \Form::close() !!}
        </div>

    </div>
</div>

@endsection
