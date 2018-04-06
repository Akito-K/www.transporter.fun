@extends('layouts.admin')
@section('content')

    <div class="box news">
        <div class="box-body news__block">
            <h2 class="page-header">運送業者クラス一覧</h2>

            @if( !empty($datas))
            <table>

            <table class="staff__table--list">
                <tr>
                    <th class="staff__cell">ID</th>
                    <th class="staff__cell">名称</th>
                    <th class="staff__cell">月額</th>
                    <th class="staff__cell">操作</th>
                </tr>

                @foreach($datas as $data)
                <tr>
                    <td>{{ $data->class_id }}</td>
                    <td>{{ $data->name }}</td>
                    <td>￥{!! number_format($data->amount) !!}</td>
                    <td>
                        <a class="btn btn-sm btn-warning" href="{{ url('') }}/admin/carrier_class/{!! $data->class_id !!}/edit">編集</a>
                        <a class="btn btn-sm btn-danger" href="{{ url('') }}/admin/carrier_class/{!! $data->class_id !!}/delete">削除</a>
                    </td>

                </tr>
                @endforeach

            </table>
            @endif

            <p><a href="{{ url('') }}/admin/carrier_class/create" class="btn btn-block btn-warning">新規作成</a></p>

        </div>
    </div>
@endsection
