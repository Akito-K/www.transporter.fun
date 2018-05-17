
<a href="{{ url('') }}/carrier/request/{{ $data->order_id }}/detail" class="orders__btn btn btn-primary btn-sm">案件詳細</a>

@if($data->my_estimate_count > 0)
<a href="{{ url('') }}/carrier/estimate/{{ $data->order_id }}/list" class="orders__btn btn btn-success btn-sm">作成した見積一覧</a>
@endif

<a href="{{ url('') }}/carrier/estimate/{{ $data->order_id }}/create" class="orders__btn btn btn-warning btn-sm">見積作成</a>
