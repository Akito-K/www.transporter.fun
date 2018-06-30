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

{!! MyHTML::errorMessage($errors) !!}
{!! MyHTML::flashMessage() !!}

<div class="page_contact page_main">
    <div class="container">

        <article class="content">

            <section class="sec_top_text">
                <p>物流サービス案件の詳細や発送時期などについては、荷主様（お客様）に直接お問い合わせください。また、Transporterのご利用で不具合が生じた場合、ブラウザの初期化やブラウザを変更することで解消する場合があります。<br>詳しくは下記をご覧ください。</p>
            </section>

            <section class="sec_browser">
                <p class="title">１.ブラウザの初期化を実施</p>
                <p class="text">※各ブラウザやそのVer.、端末によって初期化の方法は異なります。詳しくはお使いのブラウザのサポートにご確認ください。</p>
                <p class="title">2.他のブラウザでお試しください</p>
                <ul class="link_list">
                    <li><a href="#" target="_blank">Google Chromeのインストールはこちらから</a></li>
                    <li><a href="#" target="_blank">InternetExplorerのインストールはこちらから</a></li>
                    <li><a href="#" target="_blank">FireFoxのインストールはこちらから</a></li>
                </ul>
                <p>その他、<a class="textlink" href="{{ env('help_url') }}/qa_inquiry/">ヘルプ</a>ページで解決しない場合には、必要な項目をご入力の上お問い合わせください。</p>
            </section>

            <section class="sec_form_status">
                <div class="status_in">
                    <ul>
                        <li class="active">
                            <span class="step">STEP1</span>
                            <p>入力</p>
                        </li>
                        <li>
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
                    {!! Form::open(['url' => 'contact/confirm']) !!}

                        <div class="form_groupe">
                            <div class="title">お問い合わせの種類<span class="hissu">必須</span></div>
                            <div class="form_parts_box">
                                <select name="type_id" id="contact_type">
                                    {!! \MyForm::options($type_names, old('type_id')) !!}
                                </select>
                            </div>
                        </div>
                        <div class="form_groupe">
                            <div class="title">お問い合わせ内容<span class="hissu">必須</span></div>
                            <div class="form_parts_box" id="contact_subject">
                                <select name="subject_id1" id="contact_subject_1">
                                    {!! \MyForm::options($subject_names_ary[1], old('subject_id1')) !!}
                                </select>
                                <select name="subject_id2" id="contact_subject_2">
                                    {!! \MyForm::options($subject_names_ary[2], old('subject_id2')) !!}
                                </select>
                                <select name="subject_id3" id="contact_subject_3">
                                    {!! \MyForm::options($subject_names_ary[3], old('subject_id3')) !!}
                                </select>
                                <select name="subject_id4" id="contact_subject_4">
                                    {!! \MyForm::options($subject_names_ary[4], old('subject_id4')) !!}
                                </select>
                                <select name="subject_id5" id="contact_subject_5">
                                    {!! \MyForm::options($subject_names_ary[5], old('subject_id5')) !!}
                                </select>
                                <select name="subject_id6" id="contact_subject_6">
                                    {!! \MyForm::options($subject_names_ary[6], old('subject_id6')) !!}
                                </select>
                            </div>
                        </div>
                        <div class="form_groupe">
                            <div class="title">会社名</div>
                            <div class="form_parts_box">
                                <input name="company" type="text" placeholder="例：トランスポーター" value="{{ old('company') }}">
                            </div>
                        </div>
                        <div class="form_groupe">
                            <div class="title">部署名</div>
                            <div class="form_parts_box">
                                <input name="section" type="text" placeholder="例：営業部" value="{{ old('section') }}">
                            </div>
                        </div>
                        <div class="form_groupe">
                            <div class="title">お名前<span class="hissu">必須</span></div>
                            <div class="form_parts_box form_parts_name">
                                <div class="sei">姓 <input name="sei" type="text" placeholder="" value="{{ old('sei') }}"></div>
                                <div class="mei">名 <input name="mei" type="text" placeholder="" value="{{ old('mei') }}"></div>
                            </div>
                        </div>
                        <div class="form_groupe">
                            <div class="title">メールアドレス<span class="hissu">必須</span></div>
                            <div class="form_parts_box">
                                <input name="email" type="text" placeholder="例：mail@transporter.jp" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="form_groupe">
                            <div class="title">メールアドレス（確認）<span class="hissu">必須</span></div>
                            <div class="form_parts_box">
                                <input name="email_confirmation" type="text" placeholder="例：mail@transporter.jp" value="{{ old('email_confirmation') }}">
                            </div>
                        </div>
                        <div class="form_groupe">
                            <div class="title">連絡のつく電話番号<span class="hissu">必須</span></div>
                            <div class="form_parts_box">
                                <input name="tel" type="text" placeholder="" value="{{ old('tel') }}">
                            </div>
                        </div>
                        <div class="form_groupe form_groupe_textarea">
                            <div class="title">お問い合わせ詳細<span class="hissu">必須</span></div>
                            <div class="form_parts_box">
                                <textarea name="body" id="" placeholder="全角500字以内で入力してください。">{{ old('body') }}</textarea>
                            </div>
                        </div>

                        <div class="doui_box">
                            <h2 class="title_style02">同意事項</h2>
                            <div class="box_in">
                                <p>個人情報の取り扱いに同意の上、お問い合わせください。<br><a href="{{ env('www_url') }}/privacypolicy/">個人情報の取り扱いについてはこちら ＞</a></p>
                                <div class="checkbox_wrap">
                                    <label for="checkbox">
                                    <input type="checkbox" id="checkbox" name="accept" @if( old('accept') == "1") checked @endif>
                                    個人情報の取り扱いに同意する。
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="button_wrap"><button type="submit">入力内容を確認する</button></div>

                    </form>
                </div>
            </section>

        </article>

    </div>

    <div class="totop"><a class="scroll" href="#wrapper"></a></div>

</div><!-- .page_main -->

@endsection


@section('script')
<script>
    $(function(){
        $("#contact_subject select").hide();
        $("#contact_type").on("change", function(e){
            $("#contact_subject select").hide();
            var num = $(e.currentTarget).val();
            $("#contact_subject_" + num).show();
        });

        if( $("#contact_type").val() != ""){
            var typeId = $("#contact_type").val();
            console.log(typeId);
            $("#contact_subject_" + typeId).show();
        }
    });
</script>
@endsection
