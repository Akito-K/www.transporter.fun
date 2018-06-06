<?php
/**
 * 荷主 -> 案件
 * 'O-00' => '取消',
 * 'O-05' => '下書き',
 * 'O-10' => '見積受付中',
 * 'O-15' => '見積受付終了',
 * 'O-20' => '発注中',
 * 'O-25' => '進行中',
 * 'O-30' => '未入金',
 * 'O-35' => '入金済',
 * 'O-40' => '入金確認済',
 */
?>

@if( in_array($data->status_id, ['O-40']) )

    @if(!$data->evaluated_at)
    <a href="{{ url('') }}/owner/review/{{ $data->order_id }}/create" class="orders__btn btn btn-warning btn-md">運送会社を評価する</a>
    @endif

<a href="{{ url('') }}/owner/closed_order/{{ $data->order_id }}/detail" class="orders__btn btn btn-primary btn-sm">詳細</a>
<a href="{{ url('') }}/owner/order/{{ $data->order_id }}/duplicate" class="orders__btn btn btn-info btn-sm">複製</a>

@endif


<a href="{{ url('') }}/owner/board/order/{{ $data->order_id }}" class="btn btn-success btn-sm">運送会社にコンタクト</a>
