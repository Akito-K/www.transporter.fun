@extends('layouts.mypage')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">住所情報</h2>

        <div class="address__block">
            <div class="address__boxes">
                @if(!empty($datas))
                @foreach($datas as $k => $data)
                <div class="address__box address__box--list">
                    <h5 class="address__box__title">{!! sprintf('%02d', $k+1) !!} 「{{ $data->name }}」</h5>
                    <p class="address__box__body">
                        〒{!! \Func::getZipCode($data) !!}<br>
                        {!! \Func::getAddress($data) !!}<br>
                        {{ $data->sei }} {{ $data->mei }}<span class="address__box__body__ate"> 宛</span>
                    </p>
                    <p class="address__box__buttons">
                        <a href="{{ url('') }}/mypage/address/{{ $data->address_id }}/detail" class="btn btn-primary btn-sm">詳細</a>
                        <a href="{{ url('') }}/mypage/address/{{ $data->address_id }}/edit" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> 編集</a>
                        @if( $data->name != '登録住所')
                        <a href="{{ url('') }}/mypage/address/{{ $data->address_id }}/delete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> 削除</a>
                        @endif
                    </p>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>

</div>

<p><a href="{{ url('') }}/mypage/address/create" class="btn btn-warning btn-block">新しく登録する</a></p>

@endsection
