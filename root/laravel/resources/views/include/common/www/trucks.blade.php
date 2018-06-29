<table class="table_empty">
    <thead>
        <tr>
            <td>画像</td>
            <td>待機期間</td>
            <td>空車エリア</td>
            <td>タイトル</td>
            <td>特記事項</td>
            <td>車種</td>
            <td>台数</td>
        </tr>
    </thead>
    <tbody>

        @if(!empty($empty_datas))
        @foreach($empty_datas as $empty_data)

        <tr>
            <td><img src="{{ $car_datas[ $empty_data->car_id ]->filepath }}" alt=""></td>
            <td>{{ $empty_data->start_at->format('y/n/j H:i') }} ～ {{ $empty_data->end_at->format('y/n/j H:i') }}</td>
            <td>{{ $area_names[ $empty_data->area_id ] }}</td>
            <td>{{ $empty_data->name }}</td>
            <td>{!! \Func::N2BR($empty_data->notes) !!}</td>
            <td>{{ $car_datas[ $empty_data->car_id ]->name }}</td>
            <td>{{ $empty_data->count }}台</td>
        </tr>

        @endforeach
        @endif

    </tbody>
</table>
