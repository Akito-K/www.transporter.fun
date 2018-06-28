<div class="form_groupe">
    <div class="title">メールアドレス</div>
    <div class="form_parts_box">
        <p class="conf_text">{{ $data->email }}</p>
    </div>
</div>
<div class="form_groupe">
    <div class="title">ログインID</div>
    <div class="form_parts_box">
        <p class="conf_text">{{ $data->login_id }}</p>
    </div>
</div>
<div class="form_groupe">
    <div class="title">パスワード</div>
    <div class="form_parts_box">
        <p class="conf_text">*** （セキュリティにより非表示）</p>
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

<div class="form_groupe">
    <div class="title">郵便番号</div>
    <div class="form_parts_box">
        <p class="conf_text">{{ $data->zip1 }}-{{ $data->zip2 }}</p>
    </div>
</div>

<div class="form_groupe">
    <div class="title">ご住所</div>
    <div class="form_parts_box form_parts_box--">
        <p class="conf_text">{{ $prefs[ $data->pref_id ] }}　{{ $data->city }}　{{ $data->address }}</p>
    </div>
</div>

<div class="form_groupe">
    <div class="title">携帯電話番号</div>
    <div class="form_parts_box">
        <p class="conf_text">{{ $data->mobile }}</p>
    </div>
</div>
<div class="form_groupe">
    <div class="title">固定電話番号</div>
    <div class="form_parts_box">
        <p class="conf_text">{{ $data->tel }}</p>
    </div>
</div>
<div class="form_groupe">
    <div class="title">登録内容</div>
    <div class="form_parts_box">
        <p class="conf_text">
            @if( $data->flag_owner ) <i class="fa fa-check-square-o"></i> @else <i class="fa fa-square-o"></i> @endif
            荷主として使う
            　
            @if( $data->flag_carrier ) <i class="fa fa-check-square-o"></i> @else <i class="fa fa-square-o"></i> @endif
            運送会社として使う
        </p>
    </div>
</div>
