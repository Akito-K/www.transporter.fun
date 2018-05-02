<ul class="signup__conf__lists">
    <li class="signup__conf__list signup__conf__list--title">ログインID</li>
    <li class="signup__conf__list signup__conf__list--value">{{ $data->login_id }}</li>
</ul>

<ul class="signup__conf__lists">
    <li class="signup__conf__list signup__conf__list--title">パスワード</li>
    <li class="signup__conf__list signup__conf__list--value">*** （セキュリティにより非表示）</li>
</ul>

<ul class="signup__conf__lists">
    <li class="signup__conf__list signup__conf__list--title">メールアドレス</li>
    <li class="signup__conf__list signup__conf__list--value">{{ $data->email }}</li>
</ul>

<ul class="signup__conf__lists">
    <li class="signup__conf__list signup__conf__list--title">氏名</li>
    <li class="signup__conf__list signup__conf__list--value">{{ $data->sei }} {{ $data->mei }}</li>
</ul>

<ul class="signup__conf__lists">
    <li class="signup__conf__list signup__conf__list--title">シメイ</li>
    <li class="signup__conf__list signup__conf__list--value">{{ $data->sei_kana }} {{ $data->mei_kana }}</li>
</ul>

<ul class="signup__conf__lists">
    <li class="signup__conf__list signup__conf__list--title">郵便番号</li>
    <li class="signup__conf__list signup__conf__list--value">〒{{ $address->zip1 }}-{{ $address->zip2 }}</li>
</ul>

<ul class="signup__conf__lists">
    <li class="signup__conf__list signup__conf__list--title">ご住所</li>
    <li class="signup__conf__list signup__conf__list--value">{{ $prefs[ $address->pref_code ] }}<br />{{ $address->city }}<br />{{ $address->address }}</li>
</ul>

<ul class="signup__conf__lists">
    <li class="signup__conf__list signup__conf__list--title">携帯電話</li>
    <li class="signup__conf__list signup__conf__list--value">{{ $data->mobile }}</li>
</ul>

<ul class="signup__conf__lists">
    <li class="signup__conf__list signup__conf__list--title">固定電話</li>
    <li class="signup__conf__list signup__conf__list--value">{{ $data->tel }}</li>
</ul>

<ul class="signup__conf__lists">
    <li class="signup__conf__list signup__conf__list--title">登録内容</li>
    <li class="signup__conf__list signup__conf__list--value">
        @if( $data->flag_owner ) <i class="fa fa-check-square-o"></i> @else <i class="fa fa-square-o"></i> @endif
        荷主として使う
        <br />
        @if( $data->flag_carrier ) <i class="fa fa-check-square-o"></i> @else <i class="fa fa-square-o"></i> @endif
        運送会社として使う
    </li>
</ul>

