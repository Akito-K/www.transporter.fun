<?php
/**
 * 荷主 -> 案件
 * 'O-05' => '下書き',
 * 'O-10' => '見積受付中',
 * 'O-15' => '見積受付終了',
 * 'O-20' => '発注中',
 * 'O-25' => '進行中',
 * 'O-30' => '未払い',
 * 'O-35' => '入金通知済',
 * 'O-40' => '取引終了',
 * 'O-00' => '取消',
 */
?>

@if( in_array($data->order->status_id, ['O-10', 'O-15']) )
@if( !$data->placed_at && !$data->rejected_at )
<a href="{{ url('') }}/owner/place/{{ $data->estimate_id }}/create" class="orders__btn btn btn-success btn-md">この見積もりで発注する</a>
<a href="{{ url('') }}/owner/estimate/{{ $data->estimate_id }}/detail" class="orders__btn btn btn-primary btn-sm">見積詳細</a>
<a href="{{ url('') }}/owner/reject/{{ $data->estimate_id }}" class="orders__btn btn btn-danger btn-sm">お断り</a>
@else
<a href="{{ url('') }}/owner/estimate/{{ $data->estimate_id }}/detail" class="orders__btn btn btn-primary btn-sm">見積詳細</a>
@endif

@elseif( in_array($data->order->status_id, ['O-30']) )
<a href="{{ url('') }}/owner/payed/{{ $data->order->order_id }}/create" class="orders__btn btn btn-primary btn-sm">入金通知</a>
<a href="{{ url('') }}/owner/order/{{ $data->order->order_id }}/detail" class="orders__btn btn btn-primary btn-sm">案件詳細</a>

@elseif( in_array($data->order->status_id, ['O-40']) )
<a href="{{ url('') }}/owner/review/{{ $data->order->order_id }}/create" class="orders__btn btn btn-primary btn-sm">運送会社を評価する</a>
<a href="{{ url('') }}/owner/order/{{ $data->order->order_id }}/detail" class="orders__btn btn btn-primary btn-sm">案件詳細</a>

@endif


@if( in_array($data->order->status_id, ['O-15', 'O-20', 'O-25', 'O-30', 'O-35', 'O-40']) )
<a href="{{ url('') }}/owner/board/{{ $data->order_id }}" class="orders__btn btn btn-success btn-sm">メッセージボード</a>
@endif
