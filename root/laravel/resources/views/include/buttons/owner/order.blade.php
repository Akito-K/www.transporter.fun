<?php
/**
 * 荷主 -> 案件
 * 'O-00' => '下書き',
 * 'O-01' => '見積受付中',
 * 'O-02' => '見積受付終了',
 * 'O-03' => '発注中',
 * 'O-04' => '進行中',
 * 'O-05' => '未入金',
 * 'O-06' => '入金済',
 * 'O-07' => '入金確認済',
 */
?>

@if( in_array($data->status_id, ['O-02', 'O-03', 'O-04', 'O-05', 'O-06', 'O-07']) )
<a href="{{ url('') }}/owner/order/{{ $data->order_id }}/detail" class="orders__btn btn btn-warning btn-sm">進行中の案件詳細</a>
<a href="{{ url('') }}/owner/board/{{ $data->order_id }}" class="orders__btn btn btn-success btn-sm">メッセージボード</a>
@endif


@if( in_array($data->status_id, ['O-01']) )
<a href="{{ url('') }}/owner/request/{{ $data->order_id }}/cancel" class="orders__btn btn btn-danger btn-sm">取り消し</a>
@endif


@if( in_array($data->status_id, ['O-00']) )
<a href="{{ url('') }}/owner/request/{{ $data->order_id }}" class="orders__btn btn btn-success btn-md">見積依頼</a>
<a href="{{ url('') }}/owner/order/{{ $data->order_id }}/detail" class="orders__btn btn btn-primary btn-sm">詳細</a>
<a href="{{ url('') }}/owner/order/{{ $data->order_id }}/edit" class="orders__btn btn btn-warning btn-sm">編集</a>
<a href="{{ url('') }}/owner/order/{{ $data->order_id }}/delete" class="orders__btn btn btn-danger btn-sm">削除</a>
<a href="{{ url('') }}/owner/order/{{ $data->order_id }}/duplicate" class="orders__btn btn btn-info btn-sm">複製</a>

@else

<a href="{{ url('') }}/owner/estimate/{{ $data->order_id }}" class="orders__btn btn btn-warning btn-sm">見積一覧へ</a>
<a href="{{ url('') }}/owner/order/{{ $data->order_id }}/detail" class="orders__btn btn btn-primary btn-sm">詳細</a>
<a href="{{ url('') }}/owner/order/{{ $data->order_id }}/duplicate" class="orders__btn btn btn-info btn-sm">複製</a>
@endif

