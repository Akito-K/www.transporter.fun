@extends('layouts.admin')
@section('content')

    <div class="box">
        <div class="box-body note-area" id="note-area">

            @if( !empty($datas))
            <div class="note__view note__view--customer">
                <ul class="note__view__tab">
                    @php $i = 0; @endphp
                    @foreach($datas as $num => $dates)
                    <li class="note__view__tab__body trigChangeNotesView @if(!$i) selected @endif" data-key="{{ $num }}">{!! $tabs[$num] !!}</li>
                    @php $i++; @endphp

                    @endforeach
                </ul>

                <div class="note__view__boxes note__view__boxes--customer">
                    @php $j = 0; @endphp
                    @foreach($datas as $num => $dates)
                    <div class="note__view__box bulletNotesBox @if(!$j) show @endif" data-key="{{ $num }}">
                        @if( !empty($dates))

                        <div class="customer__boxes">
                            <table>
                                <tr>
                                    <th>日付</th>
                                    <th>天気</th>
                                    <th>Weather</th>
                                    <th>気温</th>
                                </tr>

                                @foreach($dates as $date => $data)
                                <tr>
                                    <td>{!! \Func::dateFormat($data->date_at, 'Y年n月j日') !!} {{ $data->hour }}時</td>
                                    <td>{!! $data->weather_ja !!}</td>
                                    <td>{!! $data->weather_en !!}</td>
                                    <td>{!! $data->temperature !!}°C</td>
                                </tr>
                                @endforeach

                            </table>
                        </div>

                        @endif
                    </div>
                    @php $j++; @endphp

                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>

@endsection
