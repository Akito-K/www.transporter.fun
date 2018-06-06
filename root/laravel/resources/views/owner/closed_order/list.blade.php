@extends('layouts.owner')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">終了した案件情報</h2>

        <div class="orders__block">
            <p><a href="{{ url('') }}/owner/order/create" class="btn btn-warning btn-block">新しく登録する</a></p>

            <div class="orders__table-wrap">
                @if(empty($datas))
                <p>データがありません</p>
                @else

                <table class="orders__table">
                    <tr>
                        <th>No</th>
                        <th>案件名</th>
                        <th>運送会社</th>
                        <th>発送地</th>
                        <th>到着地</th>
                        <th>金額</th>
                        <th>ステータス</th>
                        <th>各種操作</th>
                    </tr>

                    @if(!empty($datas))
                    @foreach($datas as $k => $data)
                    <tr>
                        <td>{{ $k+1 }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{!! $data->estimate_data->carrier_name_with_star !!}</td>
                        <td>{!! \Func::getAddress($data->send, ['pref', 'city']) !!}</td>
                        <td>{!! \Func::getAddress($data->arrive, ['pref', 'city']) !!}</td>
                        <td>￥{{ number_format($data->estimate_data->total) }}</td>
                        <td>{{ $status[$data->status_id] }}</td>
                        <td>
                            @include('include.buttons.owner.closed_order', ['data' => $data])
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </table>

                @endif

            </div>
        </div>
    </div>

</div>


@endsection
