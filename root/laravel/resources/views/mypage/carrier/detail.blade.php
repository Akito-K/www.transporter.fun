@extends('layouts.mypage')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">運送会社 詳細情報</h2>

        @include('include.carrier.detail.base',  ['carrier_data' => $carrier_data])
        @include('include.carrier.detail.car',   ['car_datas' => $car_datas])
        @include('include.carrier.detail.empty', ['empty_datas' => $empty_datas])

        @if( $carrier_data->carrier_id != \Auth::user()->carrier_id )
        <a href="{{ url('') }}/mypage/board/carrier/{{ $carrier_data->carrier_id }}" class="btn btn-success btn-block btn-sm">運送会社にコンタクト</a>
        @endif

    </div>
</div>

@endsection
