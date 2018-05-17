
<a href="{{ url('') }}/carrier/estimate/{{ $data->estimate_id }}/detail" class="orders__btn btn btn-primary btn-sm">見積詳細</a>
<a href="{{ url('') }}/carrier/estimate/{{ $data->estimate_id }}/edit" class="orders__btn btn btn-warning btn-sm">編集</a>

@if( !$data->suggested_at )
<a href="{{ url('') }}/carrier/estimate/{{ $data->estimate_id }}/delete" class="orders__btn btn btn-danger btn-sm">削除</a>
@endif
