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
                        <li class="active">
                            <span class="step">STEP3</span>
                            <p>会員情報</p>
                        </li>
                        <li>
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

                    <form class="form-horizontal" method="POST" action="{{ url('') }}/signup/update">
                        {{ csrf_field() }}
                        <input type="hidden" name="signup_key" value="{{ $signup_key }}">

                        <p class="mt30">基本情報を入力して、確認画面にお進みください。</p>

                        <div class="form_groupe">
                            <div class="title">メールアドレス</div>
                            <div class="form_parts_box">
                                <p class="conf_text">{{ $data->email }}</p>
                            </div>
                        </div>
                        <div class="form_groupe">
                            <div class="title">氏名</div>
                            <div class="form_parts_box">
                                <p class="conf_text">{{ $data->sei }} {{ $data->mei }} 様</p>
                            </div>
                        </div>
                        <div class="form_groupe">
                            <div class="title">しめい（かな）</div>
                            <div class="form_parts_box">
                                <p class="conf_text">{{ $data->sei_kana }} {{ $data->mei_kana }} さま</p>
                            </div>
                        </div>

{!! MyHTML::errorMessage($errors) !!}
{!! MyHTML::flashMessage() !!}

                        <div class="form_groupe">
                            <div class="title">郵便番号<span class="hissu">必須</span></div>
                            <div class="form_parts_box form_parts_box--zip">
                                <input id="zip1" type="text" class="form-control form-control--mini form-control--20" name="zip1" value="{!! old('zip1')?: $data->zip1 !!}" required autofocus placeholder="例：123">
                                <span class="hyphen"><i class="fa fa-minus"></i></span>
                                <input id="zip2" type="text" class="form-control form-control--mini form-control--30" name="zip2" value="{!! old('zip2')?: $data->zip2 !!}" required onKeyUp="AjaxZip3.zip2addr('zip1', 'zip2', 'pref_id','city', 'address');" placeholder="例：4567">
                            </div>
                        </div>

                        <div class="form_groupe">
                            <div class="title">都道府県<span class="hissu">必須</span></div>
                            <div class="form_parts_box form_parts_box--">
                                {!! \Form::select('pref_id', $prefs, old('pref_id')?: $data->pref_id, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form_groupe">
                            <div class="title">市区郡<span class="hissu">必須</span></div>
                            <div class="form_parts_box">
                                <input id="city" type="text" class="form-control" name="city" value="{!! old('city')?: $data->city !!}" required autofocus placeholder="例：港区">
                            </div>
                        </div>

                        <div class="form_groupe">
                            <div class="title">以降の住所<span class="hissu">必須</span></div>
                            <div class="form_parts_box">
                                <input id="address" type="text" class="form-control" name="address" value="{!! old('address')?: $data->address !!}" required autofocus placeholder="例：1-2-3">
                            </div>
                        </div>

                        <div class="form_groupe">
                            <div class="title">携帯電話番号<span class="hissu">必須</span></div>
                            <div class="form_parts_box form_parts_box--tel">
                                <input id="mobile1" type="text" class="form-control form-control--mini form-control--20" name="mobiles[1]" value="{!! old('mobiles[1]')?: $data->mobiles[1] !!}" placeholder="例：012">
                                <span class="hyphen"><i class="fa fa-minus"></i></span>
                                <input id="mobile2" type="text" class="form-control form-control--mini form-control--20" name="mobiles[2]" value="{!! old('mobiles[2]')?: $data->mobiles[2] !!}" placeholder="例：345">
                                <span class="hyphen"><i class="fa fa-minus"></i></span>
                                <input id="mobile3" type="text" class="form-control form-control--mini form-control--20" name="mobiles[3]" value="{!! old('mobiles[3]')?: $data->mobiles[3] !!}" placeholder="例：6789">
                            </div>
                        </div>

                        <div class="form_groupe">
                            <div class="title">固定電話番号</div>
                            <div class="form_parts_box form_parts_box--tel">
                                <input id="tel1" type="text" class="form-control form-control--mini form-control--20" name="tels[1]" value="{!! old('tels[1]')?: $data->tels[1] !!}" placeholder="例：012">
                                <span class="hyphen"><i class="fa fa-minus"></i></span>
                                <input id="tel2" type="text" class="form-control form-control--mini form-control--20" name="tels[2]" value="{!! old('tels[2]')?: $data->tels[2] !!}" placeholder="例：345">
                                <span class="hyphen"><i class="fa fa-minus"></i></span>
                                <input id="tel3" type="text" class="form-control form-control--mini form-control--20" name="tels[3]" value="{!! old('tels[3]')?: $data->tels[3] !!}" placeholder="例：6789">
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

                        <!--p class="mt30">下記のボタンを押して入力内容をご確認ください。</p-->

                        <div class="button_wrap"><button type="submit" class="bulletNextBtn">確認画面に進む</button></div>
                    </form>

                    <div class="button_wrap mt10">
                        <a href="{!! url('') !!}/signup/{{ $signup_key }}/create" class="btn btn-warning btn-sm">前のページに戻る</a>
                    </div>
                </div>
            </section>
        </article>
    </div>
</div>
@endsection
