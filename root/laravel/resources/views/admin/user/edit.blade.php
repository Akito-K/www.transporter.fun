@extends('layouts.admin')
@section('content')

    {!! MyHTML::errorMessage($errors) !!}
    {!! MyHTML::flashMessage() !!}

    <div class="box">
        <div class="box-body">
            <h2 class="page-header">編集</h2>

            <div class="customer__block">
                <h4 class="customer__block__title">基本情報</h4>

                {!! Form::open(['url' => 'admin/user/update']) !!}
                    {!! Form::hidden('hashed_id', $data->hashed_id) !!}
                    {!! Form::hidden('icon_filepath', old('icon_filepath')?: $data->icon_filepath, ['id' => 'icon_filepath']) !!}

                    <div>
                        <ul class="lists">
                            <li class="list list-title">ログインID</li>
                            <li class="list list-value">{!! Form::text('login_id', old('login_id')?: $data->login_id, ['class' => 'form-control form-control--mini form-control--50']) !!}</li>
                        </ul>

                        @if($data->user_id == \Auth::user()->user_id)
                        <ul class="lists">
                            <li class="list list-title">ログインパスワード</li>
                            <li class="list list-value">{!! Form::password('password', ['class' => 'form-control form-control--mini form-control--50']) !!} 変更の場合のみ入力して下さい</li>
                        </ul>
                        @endif

                        <ul class="lists">
                            <li class="list list-title">アイコン</li>
                            <li class="list list-value">
                                <div class="staff__edit__icon">
                                    <div class="staff__edit__icon__thumbnail" id="bulletUploadedImage" style="background-image: url({!! \Func::getImage( old('icon_filepath')?: $data->icon_filepath ) !!});"></div>
                                    <div class="staff__edit__icon__upload ajaxing__upload-box">
                                        <p class="ajaxing__upload-box__drag-area trigAjaxingUploadingArea">ここにファイルをドラッグしてください。</p>
                                        <button type="button" class="btn ajaxing__upload-box__btn-input trigAjaxingUploadingBtn">ファイル</button>
                                        <input type="file" multiple="multiple" class="ajaxing__upload-box__fake-input" id="bulletFakeInput" data-type="image" data-target="user" data-ajaxing="0">
                                        {!! Form::hidden('upload_id', '', ['id' => 'upload_id']) !!}
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul class="lists">
                            <li class="list list-title">氏名</li>
                            <li class="list list-value">
                                <ul class="staff__edit__names">
                                    <li class="staff__edit__name staff__edit__name--title">姓</li>
                                    <li class="staff__edit__name staff__edit__name--value">{!! Form::text('sei', old('sei')?: $data->sei, ['class' => 'form-control form-control--mini form-control--60']) !!}</li>
                                    <li class="staff__edit__name staff__edit__name--title">名</li>
                                    <li class="staff__edit__name staff__edit__name--value">{!! Form::text('mei', old('mei')?: $data->mei, ['class' => 'form-control form-control--mini form-control--60']) !!}</li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="lists">
                            <li class="list list-title">しめい</li>
                            <li class="list list-value">
                                <ul class="staff__edit__names">
                                    <li class="staff__edit__name staff__edit__name--title">せい</li>
                                    <li class="staff__edit__name staff__edit__name--value">{!! Form::text('sei_kana', old('sei_kana')?:  $data->sei_kana, ['class' => 'form-control form-control--mini form-control--60']) !!}</li>
                                    <li class="staff__edit__name staff__edit__name--title">めい</li>
                                    <li class="staff__edit__name staff__edit__name--value">{!! Form::text('mei_kana', old('mei_kana')?: $data->mei_kana, ['class' => 'form-control form-control--mini form-control--60']) !!}</li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="lists">
                            <li class="list list-title">メールアドレス</li>
                            <li class="list list-value">{!! Form::text('email', old('email')?: $data->email, ['class' => 'form-control form-control--mini form-control--60']) !!}</li>
                        </ul>
                        <ul class="lists">
                            <li class="list list-title">携帯番号</li>
                            <li class="list list-value">
                                <ul class="params">
                                    <li class="param param-30">{!! Form::text('mobiles[1]', old('mobiles.1')?: $data->mobiles[1], ['class' => 'form-control']) !!}</li>
                                    <li class="param param-10">-</li>
                                    <li class="param param-40">{!! Form::text('mobiles[2]', old('mobiles.2')?: $data->mobiles[2], ['class' => 'form-control']) !!}</li>
                                    <li class="param param-10">-</li>
                                    <li class="param param-40">{!! Form::text('mobiles[3]', old('mobiles.3')?: $data->mobiles[3], ['class' => 'form-control']) !!}</li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="lists">
                            <li class="list list-title">電話番号</li>
                            <li class="list list-value">
                                <ul class="params">
                                    <li class="param param-30">{!! Form::text('tels[1]', old('tels.1')?: $data->tels[1], ['class' => 'form-control']) !!}</li>
                                    <li class="param param-10">-</li>
                                    <li class="param param-40">{!! Form::text('tels[2]', old('tels.2')?: $data->tels[2], ['class' => 'form-control']) !!}</li>
                                    <li class="param param-10">-</li>
                                    <li class="param param-40">{!! Form::text('tels[3]', old('tels.3')?: $data->tels[3], ['class' => 'form-control']) !!}</li>
                                </ul>
                            </li>
                        </ul>

                        <ul class="lists">
                            <li class="list list-title">権限</li>
                            <li class="list list-value">
                                <ul class="staff__edit__authorities">

                                    @if(!empty($authorities))
                                    @foreach($authorities as $key => $name)

                                    <li class="staff__edit__authority">{!! Form::checkbox('authorities[]', $key, in_array($key, old('authorities')?: $data->authorities), ['id' => 'auth-'.$key, 'class' => 'staff__edit__authority__checkbox']) !!} <label for="auth-{!! $key !!}">{{ $name }}</label></li>

                                    @endforeach
                                    @endif

                                </div>
                            </li>
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

                    </div>
                    {!! Form::submit('この内容で更新する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
                {!! \Form::close() !!}
            </div><!-- /.customer__block -->
        </div>
    </div>

    <a href="{{ url('') }}/admin/user/{!! $data->hashed_id !!}/detail" class="btn btn-block btn-primary">前のページへ戻る</a>

@endsection
