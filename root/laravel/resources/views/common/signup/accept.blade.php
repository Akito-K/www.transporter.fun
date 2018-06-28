@extends('layouts.common.auth')
@section('content')

<div class="crumb">
    <div class="container">
        <ul>
            <li><a href="/">Home</a></li>
            <li><span>新規会員登録</span></li>
        </ul>
    </div>
</div>

<div class="page_register page_main">
    <div class="container">
        <article class="content">

            <section class="sec_form_status mt30" id="registration">
                <h1 class="title_style02">会員登録</h1>
                <div class="status_in">
                    <ul>
                        <li>
                            <span class="step">STEP1</span>
                            <p>Eメール</p>
                        </li>
                        <li>
                            <span class="step">STEP2</span>
                            <p>認証情報</p>
                        </li>
                        <li>
                            <span class="step">STEP3</span>
                            <p>会員情報</p>
                        </li>
                        <li class="active">
                            <span class="step">STEP4</span>
                            <p>内容確認</p>
                        </li>
                        <li>
                            <span class="step">STEP5</span>
                            <p>登録完了</p>
                        </li>
                    </ul>
                </div>
            </section>

            <section class="sec_form">
                <div class="form_wrap">

                    <div class="signup__conf mb40">
                        @include('include.common.accept.confirm')
                    </div>

                    <div class="signup__accept">
                        <h4 class="signup__accept__title">トランスポーター<span class="f_bold">会員登録</span>に関する同意事項</h4>
                        <div class="signup__accept__box">
                            @include('include.common.accept.account')
                        </div>
                    </div>

                    @if( $data->flag_owner )
                    <div class="signup__accept">
                        <h4 class="signup__accept__title">トランスポーター<span class="f_bold">荷主登録</span>に関する同意事項</h4>
                        <div class="signup__accept__box">
                            @include('include.common.accept.owner')
                        </div>
                    </div>
                    @endif

                    @if( $data->flag_carrier )
                    <div class="signup__accept">
                        <h4 class="signup__accept__title">トランスポーター<span class="f_bold">運送会社登録</span>に関する同意事項</h4>
                        <div class="signup__accept__box">
                            @include('include.common.accept.carrier')
                        </div>
                    </div>
                    @endif

                    <div class="button_wrap mt10">
                        <p class="pt5 pb5">上記に同意して</p>
                        <a href="{!! url('') !!}/signup/{{ $data->key }}/accepted" class="btn btn-primary">
                            @if( $data->flag_carrier )
                            キャンペーン適用申込に進む
                            @else
                            トランスポーターの利用を開始する
                            @endif
                        </a>
                    </div>
                    <div class="button_wrap mt10">
                        <a href="{!! url('') !!}/signup/{{ $signup_key }}/edit" class="btn btn-warning btn-sm">前のページに戻る</a>
                    </div>

                </div>
            </section>
        </article>
    </div>
</div>
@endsection
