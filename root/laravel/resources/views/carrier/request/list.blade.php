@extends('layouts.carrier')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">見積依頼一覧</h2>

        <div class="orders__block">

            <div class="orders__table-wrap">
                <table class="orders__table">
                    <tr>
                        <th>No</th>
                        <th>案件名</th>
                        <th class="orders__table__owner">依頼者</th>
                        <th>発送地</th>
                        <th>到着地</th>
                        <th>募集終了日時</th>
                        <th>作成数</th>
                        <th>提案日時</th>
                        <th>提案総数</th>
                        <th>各種操作</th>
                    </tr>

                    @if(!empty($datas))
                    @foreach($datas as $k => $data)
                    <tr>
                        <td>{{ $k+1 }}</td>
                        <td>
                            {!! \MyHTML::iconRegular($data->flag_regular) !!}
                            <a href="{{ url('') }}/carrier/request/{{ $data->order_id }}/detail">{{ $data->name }}</a>
                        </td>
                        <td>
                            {!! \MyHTML::iconNominate($data->nominated_carrier_id ) !!}
                            {!! $data->owner_name_with_star !!}
                        </td>
                        <td>{!! \Func::getAddress($data->send, ['pref', 'city']) !!}</td>
                        <td>{!! \Func::getAddress($data->arrive, ['pref', 'city']) !!}</td>
                        <td>{!! \Func::dateFormat($data->estimate_close_at, 'y/n/j H:i') !!}</td>

                        <td>{{ $data->my_estimate_count }}件</td>
                        <td>
                            @if( isset($data->my_estimate_data->suggested_at) )
                            {!! \Func::dateFormat($data->my_estimate_data->suggested_at, 'y/n/j H:i') !!}
                            @else
                            -
                            @endif
                        </td>
                        <td>{{ $data->estimate_count }}件</td>

                        <td>
                            @include('include.buttons.carrier.request', ['data' => $data])
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
