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
                    {!! Form::hidden('icon_filepath', $data->icon_filepath, ['id' => 'icon_filepath']) !!}

                    <table class="staff__table staff__table--edit customer__table">
                        <tr>
                            <th>ログインID</th>
                            <td>{!! Form::text('login_id', $data->login_id, ['class' => 'form-control form-control--mini form-control--50']) !!}</td>
                        </tr>

                        @if($me->user_id == $data->user_id)
                        <tr>
                            <th>ログインパスワード</th>
                            <td>{!! Form::password('password', ['class' => 'form-control form-control--mini form-control--50']) !!} 変更の場合のみ入力して下さい</td>
                        </tr>
                        @endif

                        <tr>
                            <th>アイコン</th>
                            <td>
                                <div class="staff__edit__icon">
                                    <div class="staff__edit__icon__thumbnail" id="bulletUploadedImage" style="background-image: url({!! \Func::getImage($data->icon_filepath) !!});"></div>
                                    <div class="staff__edit__icon__upload ajaxing__upload-box">
                                        <p class="ajaxing__upload-box__drag-area trigAjaxingUploadingArea">ここにファイルをドラッグしてください。</p>
                                        <button type="button" class="btn ajaxing__upload-box__btn-input trigAjaxingUploadingBtn">ファイル</button>
                                        <input type="file" multiple="multiple" class="ajaxing__upload-box__fake-input" id="bulletFakeInput" data-type="image" data-target="user" data-ajaxing="0">
                                        {!! Form::hidden('upload_id', '', ['id' => 'upload_id']) !!}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>表示名</th>
                            <td>
                                {!! Form::text('name', $data->name, ['class' => 'form-control form-control--mini form-control--60']) !!}
                            </td>
                        </tr>
                        <tr>
                            <th>しめい</th>
                            <td>
                                <ul class="staff__edit__names">
                                    <li class="staff__edit__name staff__edit__name--title">せい</li>
                                    <li class="staff__edit__name staff__edit__name--value">{!! Form::text('sei_kana', $data->sei_kana, ['class' => 'form-control form-control--mini form-control--60']) !!}</li>
                                    <li class="staff__edit__name staff__edit__name--title">めい</li>
                                    <li class="staff__edit__name staff__edit__name--value">{!! Form::text('mei_kana', $data->mei_kana, ['class' => 'form-control form-control--mini form-control--60']) !!}</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th>氏名</th>
                            <td>
                                <ul class="staff__edit__names">
                                    <li class="staff__edit__name staff__edit__name--title">姓</li>
                                    <li class="staff__edit__name staff__edit__name--value">{!! Form::text('sei', $data->sei, ['class' => 'form-control form-control--mini form-control--60']) !!}</li>
                                    <li class="staff__edit__name staff__edit__name--title">名</li>
                                    <li class="staff__edit__name staff__edit__name--value">{!! Form::text('mei', $data->mei, ['class' => 'form-control form-control--mini form-control--60']) !!}</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th>メールアドレス</th>
                            <td>{!! Form::text('email', $data->email, ['class' => 'form-control form-control--mini form-control--60']) !!}</td>
                        </tr>
                        <tr>
                            <th>携帯番号</th>
                            <td>
                                <ul class="params">
                                    <li class="param param-30">{!! Form::text('mobiles[1]', $data->mobiles[1], ['class' => 'form-control']) !!}</li>
                                    <li class="param param-10">-</li>
                                    <li class="param param-40">{!! Form::text('mobiles[2]', $data->mobiles[2], ['class' => 'form-control']) !!}</li>
                                    <li class="param param-10">-</li>
                                    <li class="param param-40">{!! Form::text('mobiles[3]', $data->mobiles[3], ['class' => 'form-control']) !!}</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th>電話番号</th>
                            <td>
                                <ul class="params">
                                    <li class="param param-30">{!! Form::text('tels[1]', $data->tels[1], ['class' => 'form-control']) !!}</li>
                                    <li class="param param-10">-</li>
                                    <li class="param param-40">{!! Form::text('tels[2]', $data->tels[2], ['class' => 'form-control']) !!}</li>
                                    <li class="param param-10">-</li>
                                    <li class="param param-40">{!! Form::text('tels[3]', $data->tels[3], ['class' => 'form-control']) !!}</li>
                                </ul>
                            </td>
                        </tr>

                        <tr>
                            <th>権限</th>
                            <td>
                                <ul class="staff__edit__authorities">

                                    @if(!empty($authorities))
                                    @foreach($authorities as $key => $name)

                                    <li class="staff__edit__authority">{!! Form::checkbox('authorities[]', $key, in_array($key, $data->authorities), ['id' => 'auth-'.$key, 'class' => 'staff__edit__authority__checkbox']) !!} <label for="auth-{!! $key !!}">{{ $name }}</label></li>

                                    @endforeach
                                    @endif

                                </div>
                            </td>
                        </tr>

                    </table>
                    {!! Form::submit('この内容で更新する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
                {!! \Form::close() !!}
            </div><!-- /.customer__block -->
        </div>
    </div>

    <a href="{{ url('') }}/admin/user/{!! $data->hashed_id !!}/detail" class="btn btn-block btn-primary">前のページへ戻る</a>

@endsection
