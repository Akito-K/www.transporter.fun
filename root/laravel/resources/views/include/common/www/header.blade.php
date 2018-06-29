<header>
    <div class="sp_header sp">
        <div class="h_logo"><a href="/"><img src="{{ env('www_url') }}/assets/images/h_logo.png" alt="transporter" width="283" height="55" srcset="{{ env('www_url') }}/assets/images/h_logo.png 1x,{{ env('www_url') }}/assets/images/h_logo@2x.png 2x"></a></div>
        <div class="menu_open"><a href="/"><img src="{{ env('www_url') }}/assets/images/menu_open.png" alt="transporter" width="46" height="46" srcset="{{ env('www_url') }}/assets/images/menu_open.png 1x,{{ env('www_url') }}/assets/images/menu_open@2x.png 2x"></a></div>
        <div class="h_member sp">
            @auth
            <a href="{{ url('/mypage') }}" class="scroll textlink">ようこそ</a>　{{ \Auth::user()->sei }} {{ \Auth::user()->mei }} 様
            @else
            <ul>
                <li class="signup"><a href="{{ url('') }}/signup">今すぐ会員登録<span class="icon icon_signup"></span></a></li>
                <li class="login"><a href="{{ route('login') }}">ログイン<span class="icon icon_login"></span></a></li>
            </ul>
            @endauth
        </div>
        <div class="h_search sp">
            <form action="{{ env('www_url') }}/delivery_services/search/" method="get">
                <div class="search_word">
                    <div class="text"><input class="input_text" type="text" value="" placeholder="フリーワード検索"></div>
                    <div class="submit opacity"><button class="button_submit" type="submit"><img src="{{ env('www_url') }}/assets/images/icon_search.png" alt="検索" width="18" height="18" srcset="{{ env('www_url') }}/assets/images/icon_search.png 1x,{{ env('www_url') }}/assets/images/icon_search@2x.png 2x"></button></div>
                </div>
            </form>
        </div>
    </div>

    <div class="header_wrap">
        <div class="container">
            <div class="menu_close sp"><a href="/"><img src="{{ env('www_url') }}/assets/images/menu_close.png" alt="transporter" width="46" height="46" srcset="{{ env('www_url') }}/assets/images/menu_close.png 1x,{{ env('www_url') }}/assets/images/menu_close@2x.png 2x"></a></div>
            <div class="h_top">
                <div class="h_logo pc"><a href="/"><img src="{{ env('www_url') }}/assets/images/h_logo.png" alt="transporter" width="283" height="55" srcset="{{ env('www_url') }}/assets/images/h_logo.png 1x,{{ env('www_url') }}/assets/images/h_logo@2x.png 2x"></a></div>
                <div class="h_text pc">平車・重量物・超重量物を取り扱う運送会社をお探しなら、<br>Transporter「トランスポーター」物流マッチングサイトがおすすめ！</div>
                <div class="h_member pc">
                    @auth
                    <a href="{{ url('/mypage') }}" class="scroll textlink">ようこそ</a>　{{ \Auth::user()->sei }} {{ \Auth::user()->mei }} 様
                    ({!! \MyHTML::logout('ログアウト', 'scroll textlink') !!})
                    @else
                    <ul>
                        <li class="signup"><a href="{{ url('') }}/signup">今すぐ会員登録<span class="icon icon_signup"></span></a></li>
                        <li class="login"><a href="{{ route('login') }}">ログイン<span class="icon icon_login"></span></a></li>
                    </ul>
                    @endauth
                </div>
            </div>
            <nav class="gnav">
                <ul>
                    <li><a class="cur" href="/">home</a></li>
                    <li><a href="{{ env('www_url') }}/trucks">荷主の皆様へ</a></li>
                    <li><a href="{{ env('www_url') }}/delivery_services">運送会社の皆様へ</a></li>
                    <li><a href="{{ env('www_url') }}/transporter">トランスポーターとは</a></li>
                    <li><a href="{{ env('help_url') }}/qa_inquiry">お困りの時は</a></li>
                    <li><a href="{{ env('help_url') }}">ご利用ガイド</a></li>
                </ul>
            </nav>
            <div class="search col">
                <div class="col3"><a class="btn_style01" href="{{ env('www_url') }}/delivery_services/withintoday">本日まで</a></div>
                <div class="col3"><a class="btn_style01" href="{{ env('www_url') }}/delivery_services/fewdays">近日中</a></div>
                <div class="col3 pc">
                    <form action="{{ env('www_url') }}/delivery_services/search/" method="get">
                        <div class="search_word">
                            <div class="text"><input class="input_text" type="text" value="" placeholder="フリーワード検索"></div>
                            <div class="submit opacity"><button class="button_submit" type="submit"><img src="{{ env('www_url') }}/assets/images/icon_search.png" alt="検索" width="18" height="18" srcset="{{ env('www_url') }}/assets/images/icon_search.png 1x,{{ env('www_url') }}/assets/images/icon_search@2x.png 2x"></button></div>
                        </div>
                    </form>
                </div>
                <div class="col4">
                    <div class="btn_select">
                        <a class="label cs_pointer">カテゴリー選択　｜　選択してください</a>
                        <div class="child_wrap">
                            <ul class="child">
                                <li><a href="{{ env('www_url') }}/delivery_services/Category/#001">ウイング便（13t以下）</a></li>
                                <li><a href="{{ env('www_url') }}/delivery_services/Category/#002">平車（13t以下）</a></li>
                                <li><a href="{{ env('www_url') }}/delivery_services/Category/#003">トレーラー（32t以下）</a></li>
                                <li><a href="{{ env('www_url') }}/delivery_services/Category/#004">トレーラー（70t以下）</a></li>
                                <li><a href="{{ env('www_url') }}/delivery_services/Category/#005">重量物・その他大型特殊車両（200t以下）</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col4"><a class="btn_style01" href="{{ env('www_url') }}/delivery_services/Regularly">定期案件</a></div>
                <div class="col4"><a class="btn_style01" href="{{ env('www_url') }}/delivery_services/Occasionally">不定期案件</a></div>
                <div class="col4 pos_relative">
                    <div class="special_menu_wrap">
                        <ul class="menu">
                            <li><a href="{{ env('www_url') }}/transporter"><span class="text">トランスポーターについて</span><span class="img"><img src="{{ env('www_url') }}/assets/images/home/special_menu_icon/icon1.png" alt="" width="39" height="28" srcset="{{ env('www_url') }}/assets/images/home/special_menu_icon/icon1.png 1x,{{ env('www_url') }}/assets/images/home/special_menu_icon/icon1@2x.png 2x"></span></a></li>
                            <li><a href="{{ env('www_url') }}/transporter/driver/#14free"><span class="text">14日間無料お試し</span><span class="img"><img src="{{ env('www_url') }}/assets/images/home/special_menu_icon/icon2.png" alt="" width="51" height="18" srcset="{{ env('www_url') }}/assets/images/home/special_menu_icon/icon2.png 1x,{{ env('www_url') }}/assets/images/home/special_menu_icon/icon2@2x.png 2x"></span></a></li>
                            <li><a href="{{ env('www_url') }}/transporter/carrier"><span class="text">トランスポーターになるには</span><span class="img"><img src="{{ env('www_url') }}/assets/images/home/special_menu_icon/icon3.png" alt="" width="33" height="33" srcset="{{ env('www_url') }}/assets/images/home/special_menu_icon/icon3.png 1x,{{ env('www_url') }}/assets/images/home/special_menu_icon/icon3@2x.png 2x"></span></a></li>
                            <li><a href="{{ env('www_url') }}/transporter/ranking"><span class="text">トランスポーター人気ランキング</span><span class="img"><img src="{{ env('www_url') }}/assets/images/home/special_menu_icon/icon4.png" alt="" width="37" height="28" srcset="{{ env('www_url') }}/assets/images/home/special_menu_icon/icon4.png 1x,{{ env('www_url') }}/assets/images/home/special_menu_icon/icon4@2x.png 2x"></span></a></li>
                            <li><a href="#"><span class="text">物流ニュース</span><span class="img"><img src="{{ env('www_url') }}/assets/images/home/special_menu_icon/icon5.png" alt="" width="36" height="36" srcset="{{ env('www_url') }}/assets/images/home/special_menu_icon/icon5.png 1x,{{ env('www_url') }}/assets/images/home/special_menu_icon/icon5@2x.png 2x"></span></a></li>
                            <li><a href="{{ env('www_url') }}/safety"><span class="text">安心への取り組み</span><span class="img"><img src="{{ env('www_url') }}/assets/images/home/special_menu_icon/icon6.png" alt="" width="25" height="28" srcset="{{ env('www_url') }}/assets/images/home/special_menu_icon/icon6.png 1x,{{ env('www_url') }}/assets/images/home/special_menu_icon/icon6@2x.png 2x"></span></a></li>
                            <li><a href="{{ env('www_url') }}/qa"><span class="text">よくあるご質問</span><span class="img"><img src="{{ env('www_url') }}/assets/images/home/special_menu_icon/icon7.png" alt="" width="35" height="35" srcset="{{ env('www_url') }}/assets/images/home/special_menu_icon/icon7.png 1x,{{ env('www_url') }}/assets/images/home/special_menu_icon/icon7@2x.png 2x"></span></a></li>
                            <li><a target="_blank" href="{{ env('www_url') }}/compliance"><span class="text">コンプライアンス輸送</span><span class="img"><img src="{{ env('www_url') }}/assets/images/home/special_menu_icon/icon8.png" alt="" width="33" height="33" srcset="{{ env('www_url') }}/assets/images/home/special_menu_icon/icon8.png 1x,{{ env('www_url') }}/assets/images/home/special_menu_icon/icon8@2x.png 2x"></span></a></li>
                        </ul>
                        <div class="open_menu_btn">
                            <a class="cs_pointer">
                                <div class="cell">メニュー</div>
                                <div class="cell">
                                    <img src="{{ env('www_url') }}/assets/images/downwards_arrow.png" alt="" width="30" height="30" srcset="{{ env('www_url') }}/assets/images/downwards_arrow.png 1x,{{ env('www_url') }}/assets/images/downwards_arrow@2x.png 2x">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


