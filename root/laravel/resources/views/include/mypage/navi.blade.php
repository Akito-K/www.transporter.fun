<li class="navi__list"><a href="{{ url('') }}/mypage/board"><i class="fa fa-comments-o"></i> <span>コンタクトボード</span></a></li>
<li class="navi__list"><a href="{{ url('') }}/mypage/user"><i class="fa fa-user"></i> <span>登録情報</span></a></li>

@if( \Func::isDeveloper() )
<li class="navi__list"><a href="{{ url('') }}/admin"><i class="fa fa-gear"></i> <span>管理ページ</span></a></li>
@endif

<li class="navi__list">{!! \MyHTML::logout('<i class="fa fa-sign-out"></i> ログアウト') !!}</li>