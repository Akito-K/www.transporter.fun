<?php
/**
 * 運送会社 -> 案件
 * 'W-01' => '見積提出済',
 * 'W-02' => '荷主検討中',
 * 'W-03' => '受注中',
 * 'W-04' => '進行中',
 * 'W-05' => '入金未確認',
 * 'W-07' => '入金確認済',
 * 'W-99' => '失注',
 */
?>

<a href="{{ url('') }}/carrier/request/{{ $data->order_id }}/detail" class="orders__btn btn btn-primary btn-sm">案件詳細</a>

@if($data->my_estimate)
<a href="{{ url('') }}/carrier/estimate/{{ $data->order_id }}" class="orders__btn btn btn-success btn-sm">見積一覧</a>
@else
<a href="{{ url('') }}/carrier/estimate/{{ $data->order_id }}/create" class="orders__btn btn btn-warning btn-sm">見積作成</a>
@endif

<?php /*
@if( in_array($data->status_id, ['ORD-STS-11', 'ORD-STS-16', 'ORD-STS-21', 'ORD-STS-26', 'ORD-STS-31', 'ORD-STS-36', 'ORD-STS-41', 'ORD-STS-46']) )
<a href="{{ url('') }}/owner/order/estimate/{{ $data->order_id }}/detail" class="orders__btn btn btn-warning btn-sm">進行中の見積詳細</a>
<a href="{{ url('') }}/owner/order/board/{{ $data->order_id }}" class="orders__btn btn btn-success btn-sm">メッセージボード</a>
@endif


@if( in_array($data->status_id, ['ORD-STS-06']) )
<a href="{{ url('') }}/owner/order/request/{{ $data->order_id }}/cancel" class="orders__btn btn btn-danger btn-sm">取り消し</a>
@endif


@if( in_array($data->status_id, ['ORD-STS-01']) )
<a href="{{ url('') }}/owner/order/request/{{ $data->order_id }}" class="orders__btn btn btn-success btn-md">見積依頼</a>
<a href="{{ url('') }}/owner/order/{{ $data->order_id }}/detail" class="orders__btn btn btn-primary btn-sm">詳細</a>
<a href="{{ url('') }}/owner/order/{{ $data->order_id }}/edit" class="orders__btn btn btn-warning btn-sm">編集</a>
<a href="{{ url('') }}/owner/order/{{ $data->order_id }}/delete" class="orders__btn btn btn-danger btn-sm">削除</a>
<a href="{{ url('') }}/owner/order/{{ $data->order_id }}/duplicate" class="orders__btn btn btn-info btn-sm">複製</a>

@else

<a href="{{ url('') }}/owner/order/estimate/{{ $data->order_id }}" class="orders__btn btn btn-warning btn-sm">見積一覧へ</a>
<a href="{{ url('') }}/owner/order/{{ $data->order_id }}/detail" class="orders__btn btn btn-primary btn-sm">詳細</a>
<a href="{{ url('') }}/owner/order/{{ $data->order_id }}/duplicate" class="orders__btn btn btn-info btn-sm">複製</a>
@endif

*/ ?>