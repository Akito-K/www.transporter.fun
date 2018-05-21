@extends('layouts.carrier')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">「<a href="{{ url('') }}/carrier/request/{{ $datas[0]->order_id }}/detail">{{ $datas[0]->order->name }}</a>」の件で作成した見積一覧</h2>
        <p class="">依頼者：{!! $datas[0]->order->owner_name_with_star !!}</p>

        <div class="orders__block">

            <div class="orders__table-wrap">
                <table class="orders__table">
                    <tr>
                        <th>見積合計金額</th>
                        <th>更新日時</th>
                        <th>ご提案</th>
                        <th>各種操作</th>
                    </tr>

                    @if(!empty($datas))
                    @foreach($datas as $k => $data)
                    <tr>
                        <td>￥{{ number_format($data->total) }}</td>
                        <td>{{ \Func::dateFormat($data->updated_at, 'y/n/j H:i' ) }}</td>
                        <td>
                            @if( $data->suggested_at )
                            {{ \Func::dateFormat($data->suggested_at, 'y/n/j H:i') }}
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
