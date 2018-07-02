@extends('layouts.mypage')
@section('content')

    {!! MyHTML::errorMessage($errors) !!}
    {!! MyHTML::flashMessage() !!}

    <div class="box">
        <div class="box-body">
            <h2 class="page-header">メールアドレスの変更申請</h2>

            <div class="customer__block">

                {!! Form::open(['url' => 'mypage/account/email']) !!}

                    <table class="staff__table staff__table--edit customer__table">
                        <tr>
                            <th>変更するメールアドレス</th>
                            <td>{!! Form::text('email', old('email'), ['class' => 'form-control']) !!}</td>
                        </tr>
                    </table>
                    {!! Form::submit('認証メールを送る', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
                {!! \Form::close() !!}
            </div><!-- /.customer__block -->
        </div>
    </div>

    <a href="{{ url('') }}/mypage/account/edit" class="btn btn-block btn-primary">前のページへ戻る</a>

@endsection
