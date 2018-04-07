<li class="navi__list navi__list--parent"><span class="navi__list__parent"><i class="fa fa-users"></i> ユーザー</span></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/mypage/account"><i class="fa fa-user"></i> <span>アカウント</span></a></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/mypage/status"><i class="fa fa-yen"></i> <span>登録状況</span></a></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/mypage/address"><i class="fa fa-list-alt"></i> <span>住所情報</span></a></li>

@if( !\Auth::user()->carrier_id )
<li class="navi__list navi__list--child"><a href="{{ url('') }}/mypage/transporter"><i class="fa fa-bus"></i> <span>運送業者登録</span></a></li>
@endif

<li class="navi__list navi__list--parent"><span class="navi__list__parent"><i class="fa fa-comments-o"></i> その他</span></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/mypage/carrier">運送業者一覧</a></li>

<li class="navi__list navi__list--logout">{!! \MyHTML::logout('<i class="fa fa-sign-out"></i> ログアウト') !!}</li>
