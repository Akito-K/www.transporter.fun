<?php
/**
 * 運送会社 -> 案件
 * 'W-05' => '見積提出済',
 * 'W-10' => '荷主検討中',
 * 'W-15' => '受注中',
 * 'W-20' => '進行中',
 * 'W-25' => '入金未確認',
 * 'W-30' => '入金確認済',
 * 'W-00' => '失注',
 */
?>

@if($data->status_id == 'W-15')
<a href="{{ url('') }}/carrier/receive/{{ $data->work_id }}/create" class="orders__btn btn btn-success btn-md">受注する</a>

@elseif($data->status_id == 'W-20')
<a href="{{ url('') }}/carrier/report/{{ $data->work_id }}/create" class="orders__btn btn btn-success btn-md">完了報告</a>

@endif

<a href="{{ url('') }}/carrier/work/{{ $data->work_id }}/detail" class="orders__btn btn btn-primary btn-sm">仕事の詳細</a>


@if($data->status_id == '')
@elseif($data->status_id == '')
@endif

<?php /*

@if($data->my_estimate)
<a href="{{ url('') }}/carrier/estimate/{{ $data->order_id }}" class="orders__btn btn btn-success btn-sm">見積一覧</a>
@else
<a href="{{ url('') }}/carrier/estimate/{{ $data->order_id }}/create" class="orders__btn btn btn-warning btn-sm">見積作成</a>
@endif

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