@extends('layouts.carrier')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">見積用商品一覧</h2>

        <div class="item__block">
            <div class="item__box">

                <p>
                    <a href="{{ url('') }}/carrier/item/create" class="btn btn-block btn-warning">商品を追加する</a>
                </p>

                <div class="table-scroll-wrap">
                    <table class="table-scroll">
                        <tr>
                            <th>No</th>
                            <th>型番</th>
                            <th>商品名</th>
                            <th>単価</th>
                            <th>特記事項</th>
                            <th>各種操作</th>
                        </tr>

                        @if(!empty($datas))
                        @foreach($datas as $k => $data)
                        <tr>
                            <td>{{ $k + 1 }}</td>
                            <td>{{ $data->code }}</td>
                            <td>{{ $data->name }}</td>
                            <td>￥{{ number_format($data->amount) }}</td>
                            <td>{!! \Func::getExcerpt( $data->notes ) !!}</td>
                            <td>
                                <a href="{{ url('') }}/carrier/item/{{ $data->item_id }}/detail" class="btn btn-primary">詳細</a>
                                <a href="{{ url('') }}/carrier/item/{{ $data->item_id }}/edit" class="btn btn-warning">編集</a>
                                <a href="{{ url('') }}/carrier/item/{{ $data->item_id }}/delete" class="btn btn-danger">削除</a>
                            </td>
                        </tr>
                        @endforeach
                        @endif

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
