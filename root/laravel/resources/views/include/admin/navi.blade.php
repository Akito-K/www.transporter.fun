<li class="navi__list navi__list--parent"><span class="navi__list__parent"><i class="fa fa-book"></i> 連絡帳</span></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/note"><i class="fa fa-eye"></i> <span>利用者一覧</span></a></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/note/creates_day"><i class="fa fa-pencil"></i> <span>日付からまとめて書く</span></a></li>

<li class="navi__list navi__list--parent"><span class="navi__list__parent"><i class="fa fa-comments-o"></i> 機能</span></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/boards"><i class="fa fa-comments-o"></i> <span>コンタクトボード</span></a></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/announce"><i class="fa fa-envelope-o"></i> <span>一斉メール</span></a></li>

<li class="navi__list navi__list--parent"><span class="navi__list__parent"><i class="fa fa-users"></i> ユーザー</span></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/staff"><i class="fa fa-user"></i> <span>職員一覧</span></a></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/customer"><i class="fa fa-users"></i> <span>利用者一覧</span></a></li>

@if( \Func::isManager() )
<li class="navi__list navi__list--parent"><span class="navi__list__parent"><i class="fa fa-gear"></i> 設定</span></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/news">更新情報</a></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/facility">施設情報</a></li>
@endif
@if( \Func::isDeveloper() )
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/authority">権限</a></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/pagemeta">ページメタ</a></li>
@endif

@if( \Func::isManager() )
<li class="navi__list navi__list--parent"><span class="navi__list__parent"><i class="fa fa-gear"></i> 連絡帳設定</span></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/note_bathing">入浴</a></li>
<!--li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/note_nail">爪切り</a></li-->
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/note_reha">リハビリ</a></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/note_meal">食事</a></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/note_mouthcare">口腔ケア</a></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/note_template">定型文</a></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/note_agree">挨拶文</a></li>
<li class="navi__list navi__list--child"><a href="{{ url('') }}/admin/weather">お天気ログ</a></li>
@endif

<li class="navi__list navi__list--logout">{!! \MyHTML::logout('<i class="fa fa-sign-out"></i> ログアウト') !!}</li>
