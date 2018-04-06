@extends('layouts.admin')
@section('content')

    <div class="box news">
        <div class="box-body news__block">
            <h2 class="page-header">都道府県一覧</h2>

            @if( !empty($datas))
            <table>

            <table class="staff__table--list">
                <tr>
                    <th class="staff__cell">コード</th>
                    <th class="staff__cell">都道府県名</th>
                    <th class="staff__cell">地域</th>
                </tr>

                @foreach($datas as $data)
                <tr>
                    <td>{{ $data->code }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->region }}</td>

                </tr>
                @endforeach

            </table>
            @endif

        </div>
    </div>
@endsection
