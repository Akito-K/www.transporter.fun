@extends('layouts.carrier')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">作成した見積一覧</h2>

        <div class="orders__block">

            <div class="orders__table-wrap">
                <table class="orders__table">
                    <tr>
                        <th>案件名</th>
                        <th class="orders__table__owner">依頼者</th>
                        <th>見積合計金額</th>
                        <th>更新日時</th>
                        <th>ご提案</th>
                        <th>各種操作</th>
                    </tr>

                    @if(!empty($datas))
                    @foreach($datas as $k => $data)
                    <tr>
                        <td><a href="{{ url('') }}/carrier/request/{{ $data->order_id }}/detail">{{ $data->order->name }}</a></td>
                        <td>{!! $data->order->owner_name_with_star !!}</td>
                        <td>￥{{ number_format($data->total) }}</td>
                        <td>{{ \Func::dateFormat($data->updated_at, 'y/n/j H:i' ) }}</td>
                        <td>
                            @if( $data->suggested_at )
                            {{ \Func::dateFormat($data->suggested_at, 'y/n/j H:i') }}

                            @if( $data->placed_at )
                            <i class="fa fa-arrow-right"></i> 受注
                            @elseif( $data->rejected_at )
                            <i class="fa fa-arrow-right"></i> 失注
                            @endif

                            @else
                            <a href="{{ url('') }}/carrier/suggest/{{ $data->estimate_id }}/create" class="orders__btn btn btn-success btn-sm">この見積で提案する</a>
                            @endif
                        </td>
                        <td>@include('include.buttons.carrier.estimate', ['data' => $data])</td>
                    </tr>
                    @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>

</div>


@endsection
