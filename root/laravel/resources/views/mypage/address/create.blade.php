@extends('layouts.mypage')
@section('content')

{!! MyHTML::errorMessage($errors) !!}
{!! MyHTML::flashMessage() !!}

<div class="box">
    <div class="box-body">
        <h2 class="page-header">住所情報</h2>

        <div class="address__block">
            {!! Form::open(['url' => 'mypage/address/insert']) !!}

                <div class="address__box">
                    <div class="address__box-wrap">
                        <ul class="address__lists">
                            <li class="address__list address__list--title">登録名</li>
                            <li class="address__list address__list--value">
                                {!! \Form::text('name', old('name'), ['class' => 'form-control']) !!}
                            </li>
                        </ul>
                        <ul class="address__lists">
                            <li class="address__list address__list--title">氏名</li>
                            <li class="address__list address__list--value">
                                {!! \Form::text('sei', old('sei'), ['class' => 'form-control form-control--mini form-control--40']) !!}
                                {!! \Form::text('mei', old('mei'), ['class' => 'form-control form-control--mini form-control--40']) !!}
                                <span class="address__list__ate">宛</span>
                            </li>
                        </ul>
                        <ul class="address__lists">
                            <li class="address__list address__list--title">郵便番号</li>
                            <li class="address__list address__list--value">
                                〒 {!! \Form::number('zip1', old('zip1'), ['class' => 'form-control form-control--mini form-control--30']) !!}
                                - {!! \Form::number('zip2', old('zip2'), ['class' => 'form-control form-control--mini form-control--40', 'onKeyUp' => 'AjaxZip3.zip2addr(\'zip1\', \'zip2\', \'pref_code\',\'city\', \'address\');']) !!}
                            </li>
                        </ul>
                        <ul class="address__lists">
                            <li class="address__list address__list--title">都道府県</li>
                            <li class="address__list address__list--value">
                                {!! \Form::select('pref_code', $prefs, old('pref_code'), ['class' => 'form-control']) !!}
                            </li>
                        </ul>
                        <ul class="address__lists">
                            <li class="address__list address__list--title">市区町</li>
                            <li class="address__list address__list--value">
                                {!! \Form::text('city', old('city'), ['class' => 'form-control']) !!}
                            </li>
                        </ul>
                        <ul class="address__lists">
                            <li class="address__list address__list--title">以降の住所</li>
                            <li class="address__list address__list--value">
                                {!! \Form::textarea('address', old('address'), ['class' => 'form-control']) !!}
                            </li>
                        </ul>
                        <ul class="address__lists">
                            <li class="address__list address__list--title">電話番号</li>
                            <li class="address__list address__list--value">
                                {!! \Form::text('tel', old('tel'), ['class' => 'form-control']) !!}
                            </li>
                        </ul>
                    </div>
                </div>

                {!! Form::submit('この内容で登録する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
            {!! \Form::close() !!}

        </div>

        <p>
            <a href="{{ url('') }}/mypage/address" class="btn btn-block btn-primary">一覧に戻る</a>
        </p>

    </div>
</div>

@endsection
