@extends('layouts.carrier')
@section('content')

<div class="box news">
    <div class="box-body">
        <h2 class="page-header">見積用商品詳細</h2>
        <div class="item__block">

            <div class="item__box">
                <ul class="lists">
                    <li class="list list-title">型番</li>
                    <li class="list list-value">{{ $data->code }}</li>
                </ul>
                <ul class="lists">
                    <li class="list list-title">名称</li>
                    <li class="list list-value">{{ $data->name }}</li>
                </ul>
                <ul class="lists">
                    <li class="list list-title">単価</li>
                    <li class="list list-value">￥{{ number_format($data->amount) }}</li>
                </ul>
                <ul class="lists">
                    <li class="list list-title">特記事項</li>
                    <li class="list list-value">{!! \Func::N2BR( $data->notes ) !!}</li>
                </ul>

            </div>
        </div>

    </div>
</div>

<a href="{{ url('') }}/carrier/item" class="btn btn-block btn-primary">一覧に戻る</a>

@endsection
