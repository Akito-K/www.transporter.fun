<div class="account__box account__box--carrier">
    <h5 class="account__box__title">空車情報</h5>
    <div class="account__car">
        @if(!empty($empty_datas))
        <div class="account__car__block table-scroll-wrap">
            <table class="account__car__table table-scroll">
                <tr>
                    <th>No</th>
                    <th>任意名</th>
                    <th>車名</th>
                    <th>画像</th>
                    <th>エリア</th>
                    <th>期間</th>
                    <th>台数</th>
                </tr>

                @foreach($empty_datas as $k => $empty_data)
                <tr>
                    <td>{{ $k + 1 }}</td>
                    <td>{{ $empty_data->name }}</td>
                    <td>{{ $car_datas[ $empty_data->car_id ]->name }}</td>
                    <td>
                        {!! \MyHTML::ThumbnailSquare( $car_datas[ $empty_data->car_id ]->filepath ) !!}
                    </td>
                    <td>{{ $area_names[ $empty_data->area_id ] }}</td>
                    <td>
                        {{ $empty_data->start_at->format('y/n/j H:i') }} ～ {{ $empty_data->end_at->format('y/n/j H:i') }}
                    </td>
                    <td>{{ $empty_data->count }}</td>
                </tr>
                @endforeach
            </table>
        </div>
        @endif
    </div>
</div>