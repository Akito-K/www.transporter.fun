@extends('layouts.owner')
@section('content')

{!! MyHTML::errorMessage($errors) !!}
{!! MyHTML::flashMessage() !!}

<div class="box">
    <div class="box-body">
        <h2 class="page-header">荷主 登録情報編集</h2>

        <div class="address__block">
            {!! Form::open(['url' => 'owner/account/base/update']) !!}
                {!! \Form::hidden('owner_id', $owner_data->owner_id) !!}

                <div class="address__box">
                    <div class="address__box-wrap">
                        <ul class="lists">
                            <li class="list list-title">氏名</li>
                            <li class="list list-value">
                                {!! \Form::text('sei', $owner_data->sei, ['class' => 'form-control form-control--mini form-control--40']) !!}
                                {!! \Form::text('mei', $owner_data->mei, ['class' => 'form-control form-control--mini form-control--40']) !!}
                            </li>
                        </ul>
                        <ul class="lists">
                            <li class="list list-title">郵便番号</li>
                            <li class="list list-value">
                                〒 {!! \Form::number('zip1', $owner_data->zip1, ['class' => 'form-control form-control--mini form-control--30']) !!}
                                - {!! \Form::number('zip2', $owner_data->zip2, ['class' => 'form-control form-control--mini form-control--40', 'onKeyUp' => 'AjaxZip3.zip2addr(\'zip1\', \'zip2\', \'pref_id\',\'city\', \'address\');']) !!}
                            </li>
                        </ul>
                        <ul class="lists">
                            <li class="list list-title">都道府県</li>
                            <li class="list list-value">
                                {!! \Form::select('pref_id', $prefs, $owner_data->pref_id, ['class' => 'form-control']) !!}
                            </li>
                        </ul>
                        <ul class="lists">
                            <li class="list list-title">市区町</li>
                            <li class="list list-value">
                                {!! \Form::text('city', $owner_data->city, ['class' => 'form-control']) !!}
                            </li>
                        </ul>
                        <ul class="lists">
                            <li class="list list-title">以降の住所</li>
                            <li class="list list-value">
                                {!! \Form::textarea('address', $owner_data->address, ['class' => 'form-control']) !!}
                            </li>
                        </ul>
                        <ul class="lists">
                            <li class="list list-title">電話番号</li>
                            <li class="list list-value">
                                <ul class="params">
                                    <li class="param param-30">{!! Form::text('tels[1]', $owner_data->tels[1], ['class' => 'form-control']) !!}</li>
                                    <li class="param param-10">-</li>
                                    <li class="param param-40">{!! Form::text('tels[2]', $owner_data->tels[2], ['class' => 'form-control']) !!}</li>
                                    <li class="param param-10">-</li>
                                    <li class="param param-40">{!! Form::text('tels[3]', $owner_data->tels[3], ['class' => 'form-control']) !!}</li>
                                </ul>
                            </li>
                        </ul>

                        <ul class="lists">
                            <li class="list list-title">サイト URL</li>
                            <li class="list list-value">
                                {!! \Form::text('site_url', $owner_data->site_url, ['class' => 'form-control', 'placeholder' => 'https://']) !!}
                            </li>
                        </ul>
                        <ul class="lists">
                            <li class="list list-title">運送会社からのメッセージ</li>
                            <li class="list list-value">
                                {!! \Form::textarea('message', $owner_data->message, ['class' => 'form-control']) !!}
                            </li>
                        </ul>
                    </div>
                </div>

                {!! Form::submit('この内容で更新する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
            {!! \Form::close() !!}

        </div>

        <p>
            <a href="{{ url('') }}/owner/account" class="btn btn-block btn-primary">前のページに戻る</a>
        </p>

    </div>
</div>

@endsection
