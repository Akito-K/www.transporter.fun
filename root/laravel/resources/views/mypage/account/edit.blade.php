@extends('layouts.mypage')
@section('content')

    {!! MyHTML::errorMessage($errors) !!}
    {!! MyHTML::flashMessage() !!}

    <div class="box">
        <div class="box-body">
            <h2 class="page-header">編集</h2>

            <div class="customer__block">
                <h4 class="customer__block__title">基本情報</h4>

                {!! Form::open(['url' => 'mypage/account/update']) !!}
                    {!! Form::hidden('icon_filepath', $data->icon_filepath, ['id' => 'icon_filepath']) !!}

                    <table class="staff__table staff__table--edit customer__table">
                        <tr>
                            <th>ログインID</th>
                            <td>{!! Form::text('login_id', $data->login_id, ['class' => 'form-control form-control--mini form-control--50']) !!}</td>
                        </tr>

                        <tr>
                            <th>ログインパスワード</th>
                            <td>{!! Form::password('password', ['class' => 'form-control form-control--mini form-control--50']) !!} 変更の場合のみ入力して下さい</td>
                        </tr>
                        <tr>
                            <th>パスワード再入力</th>
                            <td>{!! Form::password('password_confirmation', ['class' => 'form-control form-control--mini form-control--50']) !!} 変更の場合のみ入力して下さい</td>
                        </tr>

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
                            <td>{{ $data->email }} <a href="/mypage/account/email" class="btn btn-sm btn-danger">変更</a></td>
                        </tr>
                        <tr>
                            <th>携帯番号</th>
                            <td>{!! Form::text('mobile', $data->mobile, ['class' => 'form-control form-control--mini form-control--60']) !!}</td>
                        </tr>
                        <tr>
                            <th>電話番号</th>
                            <td>{!! Form::text('tel', $data->tel, ['class' => 'form-control form-control--mini form-control--60']) !!}</td>
                        </tr>

                    </table>
                    {!! Form::submit('この内容で更新する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
                {!! \Form::close() !!}
            </div><!-- /.customer__block -->
        </div>
    </div>

    <a href="{{ url('') }}/mypage/account" class="btn btn-block btn-primary">前のページへ戻る</a>

@endsection
