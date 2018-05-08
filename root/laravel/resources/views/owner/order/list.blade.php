@extends('layouts.owner')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">案件情報</h2>

        <div class="order__block">
            <div class="order__boxes">
                @if(!empty($datas))
                @foreach($datas as $k => $data)
                <div class="order__box order__box--list">
                    <h5 class="order__box__title">{!! sprintf('%02d', $k+1) !!} 「{{ $data->name }}」</h5>
                    <p class="order__box__body">
                        〒{!! \Func::getZipCode($data) !!}<br>
                        {!! \Func::getAddress($data) !!}<br>
                        {{ $data->sei }} {{ $data->mei }}<span class="order__box__body__ate"> 宛</span>
                    </p>
                    <p class="order__box__buttons">
                        <a href="{{ url('') }}/owner/order/{{ $data->order_id }}/detail" class="btn btn-primary btn-sm">詳細</a>
                        <a href="{{ url('') }}/owner/order/{{ $data->order_id }}/edit" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> 編集</a>
                        @if( $data->name != '登録住所')
                        <a href="{{ url('') }}/owner/order/{{ $data->order_id }}/delete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> 削除</a>
                        @endif
                    </p>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>

</div>

<p><a href="{{ url('') }}/owner/order/create" class="btn btn-warning btn-block">新しく登録する</a></p>

@endsection
