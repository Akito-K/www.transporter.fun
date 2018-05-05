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
                    <form class="form-horizontal" method="POST" action="{{ url('') }}/signup/update">
                        {{ csrf_field() }}
                        <input type="hidden" name="signup_key" value="{{ $signup_key }}">

                        <div class="form-group signup__box">
                            <label class="col-md-4 control-label">氏名</label>
                            <ul class="col-md-6 signup__box__lists">
                                <li class="signup__box__list signup__box__list--title">姓</li>
                                <li class="signup__box__list signup__box__list--value">
                                    <input id="sei" type="text" class="form-control" name="sei" value="{!! old('sei')?: $data->sei !!}">
                                </li>

                                <li class="signup__box__list signup__box__list--title">名</li>
                                <li class="signup__box__list signup__box__list--value">
                                    <input id="mei" type="text" class="form-control" name="mei" value="{!! old('mei')?: $data->mei !!}">
                                </li>
                            </ul>
                        </div>

                        <div class="form-group signup__box">
                            <label class="col-md-4 control-label">シメイ</label>
                            <ul class="col-md-6 signup__box__lists">
                                <li class="signup__box__list signup__box__list--title">セイ</li>
                                <li class="signup__box__list signup__box__list--value">
                                    <input id="sei_kana" type="text" class="form-control" name="sei_kana" value="{!! old('sei_kana')?: $data->sei_kana !!}">
                                </li>

                                <li class="signup__box__list signup__box__list--title">メイ</li>
                                <li class="signup__box__list signup__box__list--value">
                                    <input id="mei_kana" type="text" class="form-control" name="mei_kana" value="{!! old('mei_kana')?: $data->mei_kana !!}">
                                </li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">郵便番号</label>
                            <div class="col-md-6">
                                <input id="zip1" type="text" class="form-control form-control--mini form-control--20" name="zip1" value="{!! old('zip1')?: $data->zip1 !!}" required autofocus>
                                -
                                <input id="zip2" type="text" class="form-control form-control--mini form-control--30" name="zip2" value="{!! old('zip2')?: $data->zip2 !!}" required onKeyUp="AjaxZip3.zip2addr('zip1', 'zip2', 'pref_code','city', 'address');">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pref_code" class="col-md-4 control-label">都道府県</label>
                            <div class="col-md-6">
                                {!! \Form::select('pref_code', $prefs, old('pref_code')?: $data->pref_code, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="city" class="col-md-4 control-label">市区郡</label>
                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city" value="{!! old('city')?: $data->city !!}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="col-md-4 control-label">以降の住所</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{!! old('address')?: $data->address !!}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mobile1" class="col-md-4 control-label">携帯電話番号</label>
                            <div class="col-md-6">
                                <input id="mobile1" type="text" class="form-control form-control--mini form-control--20" name="mobiles[1]" value="{!! old('mobile[1]')?: $data->mobiles[1] !!}">
                                 - <input id="mobile2" type="text" class="form-control form-control--mini form-control--20" name="mobiles[2]" value="{!! old('mobile[2]')?: $data->mobiles[2] !!}">
                                 - <input id="mobile3" type="text" class="form-control form-control--mini form-control--20" name="mobiles[3]" value="{!! old('mobile[3]')?: $data->mobiles[3] !!}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tel1" class="col-md-4 control-label">固定電話番号</label>
                            <div class="col-md-6">
                                <input id="tel1" type="text" class="form-control form-control--mini form-control--20" name="tels[1]" value="{!! old('tel[1]')?: $data->tels[1] !!}">
                                 - <input id="tel2" type="text" class="form-control form-control--mini form-control--20" name="tels[2]" value="{!! old('tel[2]')?: $data->tels[2] !!}">
                                 - <input id="tel3" type="text" class="form-control form-control--mini form-control--20" name="tels[3]" value="{!! old('tel[3]')?: $data->tels[3] !!}">
                            </div>
                        </div>


                        <div class="form-group signup__type">
                            <ul class="signup__type__boxes">
                                <li class="signup__type__box signup__type__box--owner trigSelectType" data-select="1">
                                    <label class="signup__type__box__t-wrap">
                                        <div class="signup__type__box__t-row">
                                            <div class="signup__type__box__t-cell">
                                                <input type="checkbox" name="flag_owner" id="flag_owner" checked>
                                                荷主として使う
                                            </div>
                                        </div>
                                    </label>
                                </li>

                                <li class="signup__type__box signup__type__box--carrier trigSelectType" data-select="1">
                                    <label class="signup__type__box__t-wrap">
                                        <div class="signup__type__box__t-row">
                                            <div class="signup__type__box__t-cell">
                                                <input type="checkbox" name="flag_carrier" id="flag_carrier" checked>
                                                運送業者として使う<br />
                                                ※14日間無料＆<a href="#">特別入会特典</a><br />
                                                キャンペーン中！（5/30まで）
                                            </div>
                                        </div>
                                    </label>
                                </li>
                            </ul>
                        </div>


                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-warning bulletNextBtn">
                                    確認画面に進む
                                </button>
                            </div>
                        </div>
                    </form>

                    <a href="{!! url('') !!}/signup/{{ $signup_key }}/create" class="btn btn-primary">前のページに戻る</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
