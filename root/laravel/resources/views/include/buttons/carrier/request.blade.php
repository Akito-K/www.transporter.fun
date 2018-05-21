
<a href="{{ url('') }}/carrier/estimate/{{ $data->order_id }}/create" class="orders__btn btn btn-warning btn-sm">見積作成</a>

@if($data->my_estimate_count > 0)
<a href="{{ url('') }}/carrier/estimate/{{ $data->order_id }}/list" class="orders__btn btn btn-success btn-sm">作成した見積一覧</a>
@endif

