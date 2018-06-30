@if(!empty($class_datas))
@foreach($class_datas as $class_data)

<li class="col5">
    <a href="{{ env('www_url') }}/delivery_services/Category/{{ $class_data->class_id }}">

        <img class="pc" src="{{ env('www_url') }}/assets/images/home/btn_weight{{ $class_data->img_num }}.jpg" alt="ウイング便（13t以下）" width="233" height="240" srcset="{{ env('www_url') }}/assets/images/home/btn_weight{{ $class_data->img_num }}.jpg 1x,{{ env('www_url') }}/assets/images/home/btn_weight{{ $class_data->img_num }}@2x.jpg 2x">

        <img class="sp" src="{{ env('www_url') }}/assets/images/home/sp_btn_weight{{ $class_data->img_num }}.jpg" alt="ウイング便（13t以下）" width="460" height="140" srcset="{{ env('www_url') }}/assets/images/home/sp_btn_weight{{ $class_data->img_num }}.jpg 1x,{{ env('www_url') }}/assets/images/home/sp_btn_weight{{ $class_data->img_num }}@2x.jpg 2x">

     </a>
 </li>

@endforeach
@endif
