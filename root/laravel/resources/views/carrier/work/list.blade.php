@extends('layouts.carrier')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">進行中の仕事一覧</h2>

        <div class="orders__block">

            <div class="orders__table-wrap">

                @if(empty($datas))
                <p>現在トランスポーターで進行中の仕事はありません</p>
                @else
                <table class="orders__table">
                    <tr>
                        <th>No</th>
                        <th>案件名</th>
                        <th class="orders__table__owner">依頼者</th>
                        <th>発送地</th>
                        <th>到着地</th>
                        <th>金額</th>
                        <th>状態</th>
                        <th>各種操作</th>
                    </tr>

                    @foreach($datas as $k => $data)
                    <tr>
                        <td>{{ $k+1 }}</td>
                        <td><a href="{{ url('') }}/carrier/request/{{ $data->order_id }}/detail">{{ $data->order->name }}</a></td>
                        <td>{!! $data->order->owner_name_with_star !!}</td>
                        <td>
                            {{ $data->send_timezone_str }}<br />
                            {!! \Func::getAddress($data->order->send, ['pref', 'city']) !!}
                        </td>
                        <td>
                            {{ $data->arrive_timezone_str }}<br />
                            {!! \Func::getAddress($data->order->arrive, ['pref', 'city']) !!}
                        </td>
                        <td>￥{{ number_format($data->estimate->total) }}</td>
                        <td>{{ $data->status }}</td>
                        <td>@include('include.buttons.carrier.work', ['data' => $data])</td>
                    </tr>
                    @endforeach
                </table>
                @endif

            </div>
        </div>
    </div>

</div>


@endsection
