<div class="account__box account__box--carrier">
    <h5 class="account__box__title">車両情報</h5>
    <div class="account__car">
        @if(!empty($car_datas))
        <div class="account__car__block table-scroll-wrap">
            <table class="account__car__table table-scroll">
                <tr>
                    <th>No</th>
                    <th>画像</th>
                    <th>車両名称</th>
                    <th>稼働台数</th>
                </tr>

                @php $j = 0; @endphp
                @foreach($car_datas as $car_id => $car_data)
                @php $j++; @endphp
                <tr>
                    <td>{{ $j }}</td>
                    <td>
                        {!! \MyHTML::ThumbnailSquare( $car_data->filepath ) !!}
                    </td>
                    <td>{{ $car_data->name }}</td>
                    <td>{{ $car_data->count }}</td>
                </tr>
                @endforeach
            </table>
        </div>
        @endif
    </div>
</div>
