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
    <a href="{{ url('') }}/owner/place/{{ $data->estimate_id }}/create" class="orders__btn btn btn-warning btn-md">この見積もりで発注する</a>
    <a href="{{ url('') }}/owner/estimate/{{ $data->estimate_id }}/detail" class="orders__btn btn btn-primary btn-sm">見積詳細</a>
    <a href="{{ url('') }}/owner/reject/{{ $data->estimate_id }}" class="orders__btn btn btn-danger btn-sm">お断り</a>
    @else
    <a href="{{ url('') }}/owner/estimate/{{ $data->estimate_id }}/detail" class="orders__btn btn btn-primary btn-sm">見積詳細</a>
    @endif

@endif


<a href="{{ url('') }}/owner/board/estimate/{{ $data->estimate_id }}" class="btn btn-success btn-sm">運送会社にコンタクト</a>
