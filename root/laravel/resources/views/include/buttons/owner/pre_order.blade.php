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

@if( in_array($data->status_id, ['O-05']) )
<a href="{{ url('') }}/owner/request/{{ $data->order_id }}/create" class="orders__btn btn btn-success btn-md">見積依頼</a>
<a href="{{ url('') }}/owner/pre_order/{{ $data->order_id }}/detail" class="orders__btn btn btn-primary btn-sm">詳細</a>
<a href="{{ url('') }}/owner/order/{{ $data->order_id }}/edit" class="orders__btn btn btn-warning btn-sm">編集</a>
<a href="{{ url('') }}/owner/order/{{ $data->order_id }}/delete" class="orders__btn btn btn-danger btn-sm">削除</a>
<a href="{{ url('') }}/owner/order/{{ $data->order_id }}/duplicate" class="orders__btn btn btn-info btn-sm">複製</a>

@elseif( in_array($data->status_id, ['O-10']) )
<a href="{{ url('') }}/owner/estimate/{{ $data->order_id }}/list" class="orders__btn btn btn-warning btn-md">この案件の見積一覧へ</a>
<a href="{{ url('') }}/owner/request/{{ $data->order_id }}/cancel" class="orders__btn btn btn-danger btn-sm">見積依頼の取消</a>
<a href="{{ url('') }}/owner/pre_order/{{ $data->order_id }}/detail" class="orders__btn btn btn-primary btn-sm">詳細</a>
<a href="{{ url('') }}/owner/order/{{ $data->order_id }}/duplicate" class="orders__btn btn btn-info btn-sm">複製</a>

@elseif( in_array($data->status_id, ['O-15']) )
<a href="{{ url('') }}/owner/estimate/{{ $data->order_id }}" class="orders__btn btn btn-warning btn-md">この案件の見積一覧へ</a>
<a href="{{ url('') }}/owner/pre_order/{{ $data->order_id }}/detail" class="orders__btn btn btn-primary btn-sm">詳細</a>
<a href="{{ url('') }}/owner/order/{{ $data->order_id }}/duplicate" class="orders__btn btn btn-info btn-sm">複製</a>

@endif
