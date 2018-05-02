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

                    <div class="signup__conf">
                        @include('include.common.accept.confirm')
                    </div>

                    <div class="signup__accept">
                        <h4 class="signup__accept__title">トランスポーター会員登録に関する同意事項</h4>
                        <div class="signup__accept__box">
                            @include('include.common.accept.account')
                        </div>
                    </div>

                    @if( $data->flag_owner )
                    <div class="signup__accept">
                        <h4 class="signup__accept__title">トランスポーター荷主登録に関する同意事項</h4>
                        <div class="signup__accept__box">
                            @include('include.common.accept.owner')
                        </div>
                    </div>
                    @endif

                    @if( $data->flag_carrier )
                    <div class="signup__accept">
                        <h4 class="signup__accept__title">トランスポーター運送会社登録に関する同意事項</h4>
                        <div class="signup__accept__box">
                            @include('include.common.accept.carrier')
                        </div>
                    </div>
                    @endif

                    <p class="signup__accept__to-next">
                        この内容で<br />
                        <a href="{!! url('') !!}/signup/{{ $data->key }}/accepted" class="btn btn-warning">
                            @if( $data->flag_carrier )
                            キャンペーン適用申込に進む
                            @else
                            トランスポーターの利用を開始する
                            @endif
                        </a>
                    </p>

                    <a href="{!! url('') !!}/signup/{{ $signup_key }}/edit" class="btn btn-primary">前のページに戻る</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
