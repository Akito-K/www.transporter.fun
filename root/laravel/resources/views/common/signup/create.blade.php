@extends('layouts.app')
@section('content')

{!! MyHTML::errorMessage($errors) !!}
{!! MyHTML::flashMessage() !!}

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">無料会員登録</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('') }}/signup/insert">
                        {{ csrf_field() }}
                        <input type="hidden" name="signup_key" value="{{ $signup_key }}">

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">表示名</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{!! old('name')?: $data->name !!}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">メールアドレス</label>
                            <div class="col-md-6">
                                {{ $email }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="login_id" class="col-md-4 control-label">ログインID</label>
                            <div class="col-md-6">
                                <input id="login_id" type="text" class="form-control" name="login_id" value="{!! old('login_id')?: $data->login_id !!}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">パスワード</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-warning">
                                    手続きを続ける
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
