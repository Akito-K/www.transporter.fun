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

                    <div class="signup__to-epsilon">
                        <h4 class="signup__to-epsilon__title">以下の項目にご同意のチェックをお願いします。</h4>
                        <div class="signup__to-epsilon__box">

                            <ul class="signup__to-epsilon__lists trigCheckAccept" data-checked="0" data-content="1">
                                <li class="signup__to-epsilon__list signup__to-epsilon__list--check bulletCheckAccept"></li>
                                <li class="signup__to-epsilon__list signup__to-epsilon__list--body">本日より14日間全ての機能が無料で利用頂けます。</li>
                            </ul>

                            <ul class="signup__to-epsilon__lists trigCheckAccept" data-checked="0" data-content="2">
                                <li class="signup__to-epsilon__list signup__to-epsilon__list--check bulletCheckAccept"></li>
                                <li class="signup__to-epsilon__list signup__to-epsilon__list--body"><a href="#">開催中のChipolo（チポロ）プレゼントキャンペーン</a>に同時お申込み頂けます。</li>
                            </ul>

                            <ul class="signup__to-epsilon__lists trigCheckAccept" data-checked="0" data-content="3">
                                <li class="signup__to-epsilon__list signup__to-epsilon__list--check bulletCheckAccept"></li>
                                <li class="signup__to-epsilon__list signup__to-epsilon__list--body">14日を経過しますと翌月からは自動継続となります。</li>
                            </ul>

                        </div>
                    </div>

                    <p class="signup__to-epsilon__to-next">
                        <a href="{!! url('') !!}/signup/{{ $data->key }}/accepted" class="btn btn-warning bulletNextBtnEpsilon" disabled>上記すべてに同意の上 決済申し込みに進む</a>
                    </p>

                    <a href="{!! url('') !!}/signup/{{ $signup_key }}/accept" class="btn btn-primary">前のページに戻る</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
