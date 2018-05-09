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

