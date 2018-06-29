<?php
/**
 * 運送会社 -> 案件
 * 'W-05' => '',
 * 'W-10' => '荷主検討中',
 * 'W-15' => '',
 * 'W-20' => '受注中',
 * 'W-25' => '進行中',
 * 'W-30' => '未着金',
 * 'W-35' => '着金あり（未確認）',
 * 'W-40' => '取引終了',
 * 'W-00' => '失注',
 */
?>

@if( in_array($data->status_id, ['W-30', 'W-30', 'W-40']) )
    @if(!$data->evaluated_at)
    <a href="{{ url('') }}/carrier/review/{{ $data->work_id }}/create" class="orders__btn btn btn-warning btn-md">荷主を評価する</a>
    @endif
@endif

<a href="{{ url('') }}/carrier/pre_work/{{ $data->work_id }}/detail" class="orders__btn btn btn-primary btn-sm">仕事の詳細</a>

@if( !$data->status_id )

@elseif( in_array($data->status_id, ['W-05', 'W-10', 'W-15']) )

@elseif($data->status_id == 'W-20')
<a href="{{ url('') }}/carrier/receive/{{ $data->work_id }}/create" class="orders__btn btn btn-success btn-md">受注する</a>

@elseif($data->status_id == 'W-25')
<a href="{{ url('') }}/carrier/report/{{ $data->work_id }}/create" class="orders__btn btn btn-success btn-md">完了報告</a>

@elseif($data->status_id == 'W-35')
<a href="{{ url('') }}/carrier/confirm_payment/{{ $data->work_id }}" class="orders__btn btn btn-success btn-md">入金確認報告</a>

@elseif($data->status_id == 'W-40')

@endif

<a href="{{ url('') }}/carrier/board/{{ $data->work_id }}" class="btn btn-success btn-sm">依頼者にコンタクト</a>
