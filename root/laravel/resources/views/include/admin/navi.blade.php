<li class="navi__list navi__list--parent"><span class="navi__list__parent"><i class="fa fa-book"></i> 公開情報</span></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/news"><i class="fa fa-info"></i> <span>ニュース</span></a></li>

<li class="navi__list navi__list--parent"><span class="navi__list__parent"><i class="fa fa-users"></i> ユーザー</span></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/user"><i class="fa fa-user"></i> <span>一覧</span></a></li>

<li class="navi__list navi__list--parent"><span class="navi__list__parent"><i class="fa fa-gear"></i> マスタ</span></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/authority"><span>権限</span></a></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/carrier_class"><span>運送業者クラス</span></a></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/order_status"><span>案件ステータス</span></a></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/cargo_name"><span>荷物品名</span></a></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/cargo_form"><span>荷物荷姿</span></a></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/evaluation_item"><span>評価項目</span></a></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/pref"><span>都道府県</span></a></li>

<li class="navi__list navi__list--parent"><span class="navi__list__parent"><i class="fa fa-gear"></i> 案件登録オプション</span></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/order_request_option/car"><span>希望車種</span></a></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/order_request_option/equipment"><span>希望設備</span></a></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/order_request_option/other"><span>希望装備</span></a></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/pagemeta">ページメタ</a></li>


<li class="navi__list navi__list--parent"><span class="navi__list__parent"><i class="fa fa-comments-o"></i> その他</span></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/weather">お天気ログ</a></li>

<li class="navi__list navi__list--logout">{!! \MyHTML::logout('<i class="fa fa-sign-out"></i> ログアウト') !!}</li>
