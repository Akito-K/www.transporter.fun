@extends('layouts.mypage')
@section('content')

{!! MyHTML::errorMessage($errors) !!}
{!! MyHTML::flashMessage() !!}

<div class="box">
    <div class="box-body">
        <h2 class="page-header">運送会社として利用開始する</h2>
        <button type="button" class="btn btn-success btn-sm" id="trigQuoteUserAccount" data-id="{{ $me->hashed_id }}">アカウント登録情報を使用する</button>

        <div class="address__block">
            {!! Form::open(['url' => 'mypage/start/carrier/confirm']) !!}

                <div class="address__box">
                    <div class="address__box-wrap">
                        <ul class="lists">
                            <li class="list list-title">御社名</li>
                            <li class="list list-value">
                                {!! \Form::text('company', old('company')?: $data['company'], ['class' => 'form-control', 'id' => 'company']) !!}
                            </li>
                        </ul>
                        <ul class="lists">
                            <li class="list list-title">部署</li>
                            <li class="list list-value">
                                {!! \Form::text('section', old('section')?: $data['section'], ['class' => 'form-control', 'id' => 'section']) !!}
                            </li>
                        </ul>
                        <ul class="lists">
                            <li class="list list-title">役職</li>
                            <li class="list list-value">
                                {!! \Form::text('role', old('role')?: $data['role'], ['class' => 'form-control', 'id' => 'role']) !!}
                            </li>
                        </ul>
                        <ul class="lists">
                            <li class="list list-title">氏名</li>
                            <li class="list list-value">{{ $me->sei }} {{ $me->mei }} 様</li>
                        </ul>

                        <ul class="lists">
                            <li class="list list-title">郵便番号</li>
                            <li class="list list-value">
                                〒 {!! \Form::number('zip1', old('zip1')?: $data['zip1'], ['class' => 'form-control form-control--mini form-control--30', 'id' => 'zip1']) !!}
                                - {!! \Form::number('zip2', old('zip2')?: $data['zip2'], ['class' => 'form-control form-control--mini form-control--40', 'id' => 'zip2', 'onKeyUp' => 'AjaxZip3.zip2addr(\'zip1\', \'zip2\', \'pref_id\',\'city\', \'address\');']) !!}
                            </li>
                        </ul>
                        <ul class="lists">
                            <li class="list list-title">都道府県</li>
                            <li class="list list-value">
                                {!! \Form::select('pref_id', $prefs, old('pref_id')?: $data['pref_id'], ['class' => 'form-control', 'id' => 'pref_id']) !!}
                            </li>
                        </ul>
                        <ul class="lists">
                            <li class="list list-title">市区町</li>
                            <li class="list list-value">
                                {!! \Form::text('city', old('city')?: $data['city'], ['class' => 'form-control', 'id' => 'city']) !!}
                            </li>
                        </ul>
                        <ul class="lists">
                            <li class="list list-title">以降の住所</li>
                            <li class="list list-value">
                                {!! \Form::textarea('address', old('address')?: $data['address'], ['class' => 'form-control', 'id' => 'address']) !!}
                            </li>
                        </ul>
                        <ul class="lists">
                            <li class="list list-title">電話番号</li>
                            <li class="list list-value">
                                <ul class="params">
                                    <li class="param param-30">{!! Form::text('tels[1]', old('tels[1]')?: $data['tels'][1], ['class' => 'form-control', 'id' => 'tels-1']) !!}</li>
                                    <li class="param param-10">-</li>
                                    <li class="param param-40">{!! Form::text('tels[2]', old('tels[2]')?: $data['tels'][2], ['class' => 'form-control', 'id' => 'tels-2']) !!}</li>
                                    <li class="param param-10">-</li>
                                    <li class="param param-40">{!! Form::text('tels[3]', old('tels[3]')?: $data['tels'][3], ['class' => 'form-control', 'id' => 'tels-3']) !!}</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                {!! Form::submit('入力内容を確認する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
            {!! \Form::close() !!}

        </div>
    </div>
</div>

@endsection
