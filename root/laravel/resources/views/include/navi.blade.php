<li class="navi__list navi__list--parent"><span class="navi__list__parent"><i class="fa fa-users"></i> マイページ</span></li>
@if( \Func::isManager() )
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin"><i class="fa fa-gear"></i> <span>管理ページ</span></a></li>
@endif

<li class="navi__list navi__list--child"><a href="{{ url('') }}/mypage"><i class="fa fa-user"></i> <span>マイページ</span></a></li>

@if( \Func::isOwner() )
<li class="navi__list navi__list--child"><a href="{{ url('') }}/owner"><i class="fa fa-thumbs-o-up"></i> <span>荷主ページ</span></a></li>
@endif

@if( \Func::isCarrier() )
<li class="navi__list navi__list--child"><a href="{{ url('') }}/carrier"><i class="fa fa-bus"></i> <span>運送会社ページ</span></a></li>
@endif
