@extends('layouts.mypage')
@section('content')

    {!! MyHTML::errorMessage($errors) !!}
    {!! MyHTML::flashMessage() !!}

    <div class="box">
        <div class="box-body">
            <h2 class="page-header">編集</h2>

            <div class="account__block">
                {!! Form::open(['url' => 'mypage/account/update', 'class' => 'account__box']) !!}
                    {!! Form::hidden('icon_filepath', $data->icon_filepath, ['id' => 'icon_filepath']) !!}

                    <ul class="lists account__lists">
                        <li class="list list-title account__list">ログインID</li>
                        <li class="list list-value account__list">{!! Form::text('login_id', $data->login_id, ['class' => 'form-control form-control--mini form-control--50']) !!}</li>
                    </ul>
                    <ul class="lists account__lists">
                        <li class="list list-title account__list">ログインパスワード</li>
                        <li class="list list-value account__list">{!! Form::password('password', ['class' => 'form-control form-control--mini form-control--50']) !!} 変更の場合のみ入力して下さい</li>
                    </ul>
                    <ul class="lists account__lists">
                        <li class="list list-title account__list">パスワード再入力</li>
                        <li class="list list-value account__list">{!! Form::password('password_confirmation', ['class' => 'form-control form-control--mini form-control--50']) !!} 変更の場合のみ入力して下さい</li>
                    </ul>
                    <ul class="lists account__lists">
                        <li class="list list-title account__list">アイコン</li>
                        <li class="list list-value account__list">
                            <div class="staff__edit__icon">
                                <div class="staff__edit__icon__thumbnail" id="bulletUploadedImage" style="background-image: url({!! \Func::getImage($data->icon_filepath) !!});"></div>
                                <div class="staff__edit__icon__upload ajaxing__upload-box">
                                    <p class="ajaxing__upload-box__drag-area trigAjaxingUploadingArea">ここにファイルをドラッグしてください。</p>
                                    <button type="button" class="btn ajaxing__upload-box__btn-input trigAjaxingUploadingBtn">ファイル</button>
                                    <input type="file" multiple="multiple" class="ajaxing__upload-box__fake-input" id="bulletFakeInput" data-type="image" data-target="user" data-ajaxing="0">
                                    {!! Form::hidden('upload_id', '', ['id' => 'upload_id']) !!}
                                </div>
                            </div>
                        </li>
                    </ul>

                    <ul class="lists account__lists">
                        <li class="list list-title account__list">表示名</li>
                        <li class="list list-value account__list">{!! Form::text('name', $data->name, ['class' => 'form-control form-control--mini form-control--60']) !!}</li>
                    </ul>
                    <ul class="lists account__lists">
                        <li class="list list-title account__list">氏名</li>
                        <li class="list list-value account__list">
                            <ul class="params">
                                <li class="param param-10">姓</li>
                                <li class="param param-40">{!! Form::text('sei', $data->sei, ['class' => 'form-control form-control--mini form-control--']) !!}</li>
                                <li class="param param-10">名</li>
                                <li class="param param-40">{!! Form::text('mei', $data->mei, ['class' => 'form-control form-control--mini form-control--']) !!}</li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="lists account__lists">
                        <li class="list list-title account__list">シメイ</li>
                        <li class="list list-value account__list">
                            <ul class="params">
                                <li class="param param-10">セイ</li>
                                <li class="param param-40">{!! Form::text('sei_kana', $data->sei_kana, ['class' => 'form-control form-control--mini form-control--']) !!}</li>
                                <li class="param param-10">メイ</li>
                                <li class="param param-40">{!! Form::text('mei_kana', $data->mei_kana, ['class' => 'form-control form-control--mini form-control--']) !!}</li>
                            </ul>
                        </li>
                    </ul>

                    <ul class="lists account__lists">
                        <li class="list list-title account__list">メールアドレス</li>
                        <li class="list list-value account__list">{{ $data->email }} <a href="/mypage/account/email" class="btn btn-sm btn-danger">変更</a></li>
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

                    <ul class="lists account__lists">
                        <li class="list list-title account__list">携帯電話番号</li>
                        <li class="list list-value account__list">
                            <ul class="params">
                                <li class="param param-30">{!! Form::text('mobiles[1]', $data->mobiles[1], ['class' => 'form-control']) !!}</li>
                                <li class="param param-10">-</li>
                                <li class="param param-40">{!! Form::text('mobiles[2]', $data->mobiles[2], ['class' => 'form-control']) !!}</li>
                                <li class="param param-10">-</li>
                                <li class="param param-40">{!! Form::text('mobiles[3]', $data->mobiles[3], ['class' => 'form-control']) !!}</li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="lists account__lists">
                        <li class="list list-title account__list">固定電話番号</li>
                        <li class="list list-value account__list">
                            <ul class="params">
                                <li class="param param-30">{!! Form::text('tels[1]', $data->tels[1], ['class' => 'form-control']) !!}</li>
                                <li class="param param-10">-</li>
                                <li class="param param-40">{!! Form::text('tels[2]', $data->tels[2], ['class' => 'form-control']) !!}</li>
                                <li class="param param-10">-</li>
                                <li class="param param-40">{!! Form::text('tels[3]', $data->tels[3], ['class' => 'form-control']) !!}</li>
                            </ul>
                        </li>
                    </ul>

                    {!! Form::submit('この内容で更新する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
                {!! \Form::close() !!}

            </div>

        </div>
    </div>

    <a href="{{ url('') }}/mypage/account" class="btn btn-block btn-primary">前のページへ戻る</a>

@endsection
