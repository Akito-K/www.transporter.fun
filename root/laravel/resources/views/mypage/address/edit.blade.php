@extends('layouts.mypage')
@section('content')

{!! MyHTML::errorMessage($errors) !!}
{!! MyHTML::flashMessage() !!}

<div class="box">
    <div class="box-body">
        <h2 class="page-header">住所情報</h2>

        <div class="address__block">
            {!! Form::open(['url' => 'mypage/address/update']) !!}
                {!! \Form::hidden('address_id', $data->address_id) !!}

                <div class="address__box">
                    <div class="address__box-wrap">
                        <ul class="lists">
                            <li class="list list-title">登録名</li>
                            <li class="list list-value">
                                @if( $data->name == '登録住所')
                                {{ $data->name }}
                                @else
                                {!! \Form::text('name', $data->name, ['class' => 'form-control']) !!}
                                @endif
                            </li>
                        </ul>
                        <ul class="lists">
                            <li class="list list-title">氏名</li>
                            <li class="list list-value">
                                {!! \Form::text('sei', $data->sei, ['class' => 'form-control form-control--mini form-control--40']) !!}
                                {!! \Form::text('mei', $data->mei, ['class' => 'form-control form-control--mini form-control--40']) !!}
                                <span class="list__ate">宛</span>
                            </li>
                        </ul>
                        <ul class="lists">
                            <li class="list list-title">郵便番号</li>
                            <li class="list list-value">
                                〒 {!! \Form::number('zip1', $data->zip1, ['class' => 'form-control form-control--mini form-control--30']) !!}
                                - {!! \Form::number('zip2', $data->zip2, ['class' => 'form-control form-control--mini form-control--40', 'onKeyUp' => 'AjaxZip3.zip2addr(\'zip1\', \'zip2\', \'pref_id\',\'city\', \'address\');']) !!}
                            </li>
                        </ul>
                        <ul class="lists">
                            <li class="list list-title">都道府県</li>
                            <li class="list list-value">
                                {!! \Form::select('pref_id', $prefs, $data->pref_id, ['class' => 'form-control']) !!}
                            </li>
                        </ul>
                        <ul class="lists">
                            <li class="list list-title">市区町</li>
                            <li class="list list-value">
                                {!! \Form::text('city', $data->city, ['class' => 'form-control']) !!}
                            </li>
                        </ul>
                        <ul class="lists">
                            <li class="list list-title">以降の住所</li>
                            <li class="list list-value">
                                {!! \Form::textarea('address', $data->address, ['class' => 'form-control']) !!}
                            </li>
                        </ul>
                        <ul class="lists">
                            <li class="list list-title">電話番号</li>
                            <li class="list list-value">
                                <ul class="params">
                                    <li class="param param-30">{!! Form::text('tels[1]', $data->tels[1], ['class' => 'form-control']) !!}</li>
                                    <li class="param param-10">-</li>
                                    <li class="param param-40">{!! Form::text('tels[2]', $data->tels[2], ['class' => 'form-control']) !!}</li>
                                    <li class="param param-10">-</li>
                                    <li class="param param-40">{!! Form::text('tels[3]', $data->tels[3], ['class' => 'form-control']) !!}</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                {!! Form::submit('この内容で更新する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
            {!! \Form::close() !!}

        </div>

        <p>
            <a href="{{ url('') }}/mypage/address/{{ $data->address_id }}/detail" class="btn btn-block btn-primary">詳細に戻る</a>

            @if( $data->name != '登録住所')
            <a href="{{ url('') }}/mypage/address/{{ $data->address_id }}/delete" class="btn btn-danger btn-block"><i class="fa fa-trash"></i> 削除</a>
            @endif
        </p>

    </div>
</div>

@endsection
