@extends('layouts.carrier')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">仕事一覧</h2>

        <div class="orders__block">

            <div class="orders__table-wrap">
                <table class="orders__table">
                    <tr>
                        <th>No</th>
                        <th>案件名</th>
                        <th class="orders__table__owner">依頼者</th>
                        <th>発送地</th>
                        <th>到着地</th>
                        <th>金額</th>
                        <th>状態</th>
                        <th>全見積り数</th>
                        <th>各種操作</th>
                    </tr>

                    @if(!empty($datas))
                    @foreach($datas as $k => $data)
                    <tr>
                        <td>{{ $k+1 }}</td>
                        <td>{{ $data->order->name }}</td>
                        <td>{!! $data->order->owner_with_star !!}</td>
                        <td>
                            {{ $data->send_timezone_str }}<br />
                            {!! \Func::getAddress($data->order->send, ['pref', 'city']) !!}
                        </td>
                        <td>
                            {{ $data->arrive_timezone_str }}<br />
                            {!! \Func::getAddress($data->order->arrive, ['pref', 'city']) !!}
                            }
                        </td>
                        <td>￥{{ number_format($data->estimate->total) }}</td>
                        <td>{{ $data->status }}</td>
                        <td>{{ $data->estimate->count }} 件</td>
                        <td>@include('include.buttons.carrier.work', ['data' => $data->order])</td>
                    </tr>
                    @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>

</div>


@endsection
