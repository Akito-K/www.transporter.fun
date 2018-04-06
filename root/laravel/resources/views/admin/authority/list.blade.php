@extends('layouts.admin')
@section('content')

    {!! MyHTML::errorMessage($errors) !!}
    {!! MyHTML::flashMessage() !!}

    <div class="box">
        <div class="box-body">
            <h2 class="page-header">一覧</h2>

            @if( !empty($datas))

            <table class="authority__table--list">
                <tr>
                    <th class="authority__cell">ID</th>
                    <th class="authority__cell">名称</th>
                    <th class="authority__cell">割当数</th>
                    <th class="authority__cell">操作</th>
                </tr>

                @foreach($datas as $data)
                <tr>
                    <td class="authority__cell">{!! $data->authority_id !!}</td>
                    <td class="authority__cell">{!! $data->name !!}</td>
                    <td class="authority__cell">{!! $data->count !!}</td>
                    <td class="authority__cell">
                        <a class="btn btn-sm btn-warning" href="{{ url('') }}/admin/authority/{!! $data->authority_id !!}/edit">編集</a>
                        <a class="btn btn-sm btn-danger" href="{{ url('') }}/admin/authority/{!! $data->authority_id !!}/delete">削除</a>
                    </td>
                </tr>
                @endforeach

            </table>

            @endif

            <p class="auth-hide">
                <a href="{{ url('') }}/admin/authority/create" class="btn btn-block btn-warning">新規作成</a>
            </p>

        </div>
    </div>

@endsection
