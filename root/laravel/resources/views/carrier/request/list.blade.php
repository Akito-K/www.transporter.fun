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
                        <th>見積依頼日時</th>
                        <th>募集終了日時</th>
                        <th>見積り数</th>
                        <th>提案日時</th>
                        <th>各種操作</th>
                    </tr>

                    @if(!empty($datas))
                    @foreach($datas as $k => $data)
                    <tr>
                        <td>{{ $k+1 }}</td>
                        <td>{{ $data->name }}</td>
                        <td>
                            @if( $data->flag_hide_owner )
                            ***（非公開）
                            @else
                            <a href="{{ url('') }}/mypage/owner/{{ $data->owner_id }}/detail">{{ $data->user->name }}</a><br />
                            @include('include.star', ['star' => $data->owner->star])
                            @endif
                        </td>
                        <td>{!! \Func::getAddress($data->send, ['pref', 'city']) !!}</td>
                        <td>{!! \Func::getAddress($data->arrive, ['pref', 'city']) !!}</td>
                        <td>{!! \Func::dateFormat($data->estimate_start_at, 'y/n/j H:i') !!}</td>
                        <td>{!! \Func::dateFormat($data->estimate_close_at, 'y/n/j H:i') !!}</td>
                        <td>{{ $data->estimate_count }} 件</td>
                        <td>
                            @if($data->my_estimate)
                            {{ $data->my_estimate->estimated_at }}
                            @else
                            -
                            @endif
                        </td>
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
