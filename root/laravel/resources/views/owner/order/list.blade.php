@extends('layouts.owner')
@section('content')

<div class="box">
    <div class="box-body">
        <h2 class="page-header">未発注の案件情報</h2>

        <div class="orders__block">
            <p><a href="{{ url('') }}/owner/order/create" class="btn btn-warning btn-block">新しく登録する</a></p>

            <div class="orders__table-wrap">
                <table class="orders__table">
                    <tr>
                        <th>No</th>
                        <th>案件名</th>
                        <th>発送地</th>
                        <th>到着地</th>
                        <th>見積依頼日時</th>
                        <th>募集終了日時</th>
                        <th>ステータス</th>
                        <th>見積り数</th>
                        <th>各種操作</th>
                    </tr>

                    @if(!empty($datas))
                    @foreach($datas as $k => $data)
                    <tr>
                        <td>{{ $k+1 }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{!! \Func::getAddress($data->send, ['pref', 'city']) !!}</td>
                        <td>{!! \Func::getAddress($data->arrive, ['pref', 'city']) !!}</td>
                        <td>{!! \Func::dateFormat($data->estimate_start_at, 'y/n/j H:i') !!}</td>
                        <td>{!! \Func::dateFormat($data->estimate_close_at, 'y/n/j H:i') !!}</td>
                        <td>{{ $status[$data->status_id] }}</td>
                        <td>{{ $data->estimate_count }} 件</td>
                        <td>
                            @include('include.buttons.owner.order', ['data' => $data])
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
