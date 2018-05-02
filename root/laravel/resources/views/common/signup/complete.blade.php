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
                    アカウント登録が完了しました。<a href="{{ url('') }}/mypage">こちら</a>よりマイページへお進みください。
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
