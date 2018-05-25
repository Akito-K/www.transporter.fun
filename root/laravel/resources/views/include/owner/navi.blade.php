<li class="navi__list navi__list--parent"><span class="navi__list__parent"><i class="fa fa-th-list"></i> 案件</span></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/owner/order"><i class="fa fa-file-text-o"></i> <span>未発注の案件一覧</span></a></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/owner/active_order"><i class="fa fa-file-text-o"></i> <span>進行中の案件一覧</span></a></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/owner/closed_order"><i class="fa fa-file-text-o"></i> <span>終了した案件一覧</span></a></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/owner/order/create"><i class="fa fa-file-o"></i> <span>案件登録</span></a></li>

<li class="navi__list navi__list--parent"><span class="navi__list__parent"><i class="fa fa-users"></i> アカウント</span></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/owner/account">荷主登録情報</a></li>

<li class="navi__list navi__list--logout">{!! \MyHTML::logout('<i class="fa fa-sign-out"></i> ログアウト') !!}</li>
