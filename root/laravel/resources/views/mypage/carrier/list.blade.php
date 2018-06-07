@extends('layouts.mypage')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">運送会社 一覧</h2>

        <div class="orders__block">

            <div class="orders__table-wrap">
                <table class="orders__table">
                    <tr>
                        <th>No</th>
                        <th class="orders__table__owner">法人名</th>
                        <th>スター</th>
                        <th>保有車両台数</th>
                        <th>受注数 / 提案数</th>
                        <th>取引額</th>
                        <th>現在の空車台数</th>
                        <th>各種操作</th>
                    </tr>

                    @if(!empty($carrier_datas))
                    @foreach($carrier_datas as $k => $data)
                    <tr>
                        <td>{{ $k+1 }}</td>
                        <td>{{ $data->company }}</td>
                        <td>{!! $data->star !!}</td>
                        <td>{{ $data->total_cars_count }} 台</td>
                        <td>{{ $data->total_worked_count }} / {{ $data->total_estimated_order_count }}</td>
                        <td>{{ number_format( \Func::digitFormat($data->total_transaction_amount, 1000) ) }}千円</td>
                        <td>{{ $data->total_empties_count }} 台</td>
                        <td>
                            <a href="{{ url('') }}/mypage/carrier/{{ $data->carrier_id }}" class="btn btn-primary btn-sm">詳細</a>

                            @if( $data->carrier_id != \Auth::user()->carrier_id )
                            <a href="{{ url('') }}/mypage/board/carrier/{{ $data->carrier_id }}" class="btn btn-success btn-sm">運送会社にコンタクト</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>

</div>


@endsection
