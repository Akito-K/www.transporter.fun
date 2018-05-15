<li class="navi__list navi__list--parent"><span class="navi__list__parent"><i class="fa fa-th-list"></i> 見積もり</span></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/carrier/request"><i class="fa fa-file-text-o"></i> <span>見積依頼一覧</span></a></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/carrier/item"><i class="fa fa-file-text-o"></i> <span>見積用商品一覧</span></a></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/carrier/estimate"><i class="fa fa-file-text-o"></i> <span>作成した見積もり</span></a></li>

<li class="navi__list navi__list--parent"><span class="navi__list__parent"><i class="fa fa-th-list"></i> 案件</span></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/carrier/work"><i class="fa fa-file-text-o"></i> <span>進行中の仕事一覧</span></a></li>

<li class="navi__list navi__list--parent"><span class="navi__list__parent"><i class="fa fa-users"></i> アカウント</span></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/carrier/account">運送会社登録情報</a></li>

<li class="navi__list navi__list--logout">{!! \MyHTML::logout('<i class="fa fa-sign-out"></i> ログアウト') !!}</li>
