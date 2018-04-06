@extends('layouts.admin')
@section('content')

    <div class="box news">
        <div class="box-body news__block">
            <h2 class="page-header">評価項目一覧</h2>

            @if( !empty($datas))
            <table>

            <table class="staff__table--list">
                <tr>
                    <th class="staff__cell">ID</th>
                    <th class="staff__cell">評価対象</th>
                    <th class="staff__cell">名称</th>
                    <th class="staff__cell">有効期限</th>
                    <th class="staff__cell">適用状態</th>
                    <th class="staff__cell">操作</th>
                </tr>

                @foreach($datas as $data)
                <tr>
                    <td>{{ $data->item_id }}</td>
                    <td>{{ $targets[$data->target] }}</td>
                    <td>{{ $data->name }}</td>
                    <td class="text-center">
                        {!! \Func::dateFormat( $data->validated_at, 'Y/n/j(wday)') !!}
                        ～
                        {!! \Func::dateFormat( $data->period_at, 'Y/n/j(wday)') !!}
                    </td>
                    <td class="text-center auth-hide">
                        @if($data->published_at)
                        <i class="fa fa-circle-o"></i>
                        @else
                        <i class="fa fa-close"></i>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-sm btn-warning" href="{{ url('') }}/admin/evaluation_item/{!! $data->item_id !!}/edit">編集</a>
                        <a class="btn btn-sm btn-danger" href="{{ url('') }}/admin/evaluation_item/{!! $data->item_id !!}/delete">削除</a>
                    </td>

                </tr>
                @endforeach

            </table>
            @endif

            <p><a href="{{ url('') }}/admin/evaluation_item/create" class="btn btn-block btn-warning">新規作成</a></p>

        </div>
    </div>
@endsection
