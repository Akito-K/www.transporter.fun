@extends('layouts.owner')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">「<a href="{{ url('') }}/owner/order/{{ $order_data->order_id }}/detail">{{ $order_data->name }}</a>」の件で提案された見積一覧</h2>

        <div class="orders__block">

            <div class="orders__table-wrap">
                <table class="orders__table">
                    <tr>
                        <th>提案日時</th>
                        <th class="orders__table__owner">提案者</th>
                        <th>見積金額</th>
                        <th>各種操作</th>
                    </tr>

                    @if(!empty($datas))
                    @foreach($datas as $k => $data)
                    <tr>
                        <td>{{ \Func::dateFormat($data->suggested_at, 'y/n/j H:i') }}</td>
                        <td>{!! $data->carrier_name_with_star !!}</td>
                        <td>￥{{ number_format($data->total) }}</td>
                        <td>@include('include.buttons.owner.estimate', ['data' => $data])</td>
                    </tr>
                    @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>

</div>


@endsection
