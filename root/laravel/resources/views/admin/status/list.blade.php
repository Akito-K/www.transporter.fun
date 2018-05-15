@extends('layouts.admin')
@section('content')

    <div class="box news">
        <div class="box-body news__block">
            <h2 class="page-header">ステータス一覧</h2>

            @if( !empty($datas))
            <table>

            <table class="staff__table--list">
                <tr>
                    <th class="staff__cell">ID</th>
                    <th class="staff__cell">名称</th>
                    <th class="staff__cell">視点</th>
                </tr>

                @foreach($datas as $data)
                <tr>
                    <td>{{ $data->status_id }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->point_of_view }}</td>
                </tr>
                @endforeach

            </table>
            @endif

        </div>
    </div>
@endsection
