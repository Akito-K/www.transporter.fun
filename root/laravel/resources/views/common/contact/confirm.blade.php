@extends('layouts.common.www')
@section('content')

<section class="sec_visual">
    <div class="container">
        <div class="visual_wrap">
            <div class="visual_thumb"><img src="{{ env('www_url') }}/assets/images/transporter/visual.jpg" alt="" width="1200" height="140" srcset="{{ env('www_url') }}/assets/images/transporter/visual.jpg 1x,{{ env('www_url') }}/assets/images/transporter/visual@2x.jpg 2x"></div>
            <h1 class="visual_title">ヘルプ（カスタマーサポートへのお問い合わせ）</h1>
        </div>
    </div>
</section>

<div class="crumb">
    <div class="container">
        <ul>
            <li><a href="{{ env('www_url') }}">Home</a></li>
            <li><span>ヘルプ（カスタマーサポートへのお問い合わせ）</span></li>
        </ul>
    </div>
</div>

<div class="page_contact page_main">
    <div class="container">

        <article class="content">

            <section class="sec_top_text">
                <p>物流サービス案件の詳細や発送時期などについては、荷主様（お客様）に直接お問い合わせください。また、Transporterのご利用で不具合が生じた場合、ブラウザの初期化やブラウザを変更することで解消する場合があります。</p>
            </section>

            <section class="sec_form_status">
                <div class="status_in">
                    <ul>
                        <li>
                            <span class="step">STEP1</span>
                            <p>入力</p>
                        </li>
                        <li class="active">
                            <span class="step">STEP2</span>
                            <p>確認</p>
                        </li>
                        <li>
                            <span class="step">STEP3</span>
                            <p>完了</p>
                        </li>
                    </ul>
                </div>
            </section>

            <section class="sec_form">
                <div class="form_wrap">
                    {!! Form::open(['url' => 'contact/execute']) !!}

                        <div class="form_groupe">
                            <div class="title">お問い合わせの種類<span class="hissu">必須</span></div>
                            <div class="form_parts_box">
                                <p class="conf_text">{{ $contacts[ old('type_id') ]['type'] }}</p>
                                {{ Form::hidden('type_id', old('type_id')) }}
                            </div>
                        </div>
                        <div class="form_groupe">
                            <div class="title">お問い合わせ内容<span class="hissu">必須</span></div>
                            <div class="form_parts_box" id="contact_subject">
                                <p class="conf_text">{{ $contacts[ old('type_id') ]['subjects'][ old('subject_id'.old('type_id')) ] }}</p>
                                {{ Form::hidden('subject_id', old('subject_id'.old('type_id')) ) }}
                            </div>
                        </div>
                        <div class="form_groupe">
                            <div class="title">会社名</div>
                            <div class="form_parts_box">
                                <p class="conf_text">{{ old('company') }}</p>
                                {{ Form::hidden('company', old('company')) }}
                            </div>
                        </div>
                        <div class="form_groupe">
                            <div class="title">部署名</div>
                            <div class="form_parts_box">
                                <p class="conf_text">{{ old('section') }}</p>
                                {{ Form::hidden('section', old('section')) }}
                            </div>
                        </div>
                        <div class="form_groupe">
                            <div class="title">お名前<span class="hissu">必須</span></div>
                            <div class="form_parts_box form_parts_name">
                                <p class="conf_text">{{ old('sei') }} {{ old('mei') }}</p>
                                {{ Form::hidden('sei', old('sei')) }}
                                {{ Form::hidden('mei', old('mei')) }}
                            </div>
                        </div>
                        <div class="form_groupe">
                            <div class="title">メールアドレス<span class="hissu">必須</span></div>
                            <div class="form_parts_box">
                                <p class="conf_text">{{ old('email') }}</p>
                                {{ Form::hidden('email', old('email')) }}
                            </div>
                        </div>
                        <div class="form_groupe">
                            <div class="title">連絡のつく電話番号<span class="hissu">必須</span></div>
                            <div class="form_parts_box">
                                <p class="conf_text">{{ old('tel') }}</p>
                                <input name="tel" type="text" placeholder="" value="">
                                {{ Form::hidden('tel', old('tel')) }}
                            </div>
                        </div>
                        <div class="form_groupe form_groupe_textarea">
                            <div class="title">お問い合わせ詳細<span class="hissu">必須</span></div>
                            <div class="form_parts_box">
                                <p class="conf_text">{!! \Func::N2BR( old('body') ) !!}</p>
                                {{ Form::hidden('body', old('body')) }}
                            </div>
                        </div>
                        <div class="button_wrap">
                            <button class="back" onClick="location.href='/contact/'; return false;">前の画面に戻って修正する</button>
                            <button class="send" type="submit">送信する</button>
                        </div>

                    </form>
                </div>
            </section>

        </article>

    </div>

    <div class="totop"><a class="scroll" href="#wrapper"></a></div>

</div><!-- .page_main -->

@endsection

