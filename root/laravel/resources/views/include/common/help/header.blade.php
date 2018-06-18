<header>
    <div class="sp_header sp">
        <div class="h_logo"><a href="{{ env('www_url') }}"><img src="{{ env('help_url') }}/assets/images/h_logo.png" alt="transporter" width="283" height="55" srcset="{{ env('help_url') }}/assets/images/h_logo.png 1x,{{ env('help_url') }}/assets/images/h_logo@2x.png 2x"></a><p class="text">総合ご利用ガイド</p></div>
        <div class="menu_open"><a href="{{ env('help_url') }}"><img src="{{ env('help_url') }}/assets/images/menu_open.png" alt="transporter" width="46" height="46" srcset="{{ env('help_url') }}/assets/images/menu_open.png 1x,{{ env('help_url') }}/assets/images/menu_open@2x.png 2x"></a></div>
        <div class="h_search sp">
            <a href="{{ env('help_url') }}">
                <div class="to_top_icon">
                    <img src="{{ env('help_url') }}/assets/images/icon_guide_top.png" alt="" width="40" height="40" srcset="{{ env('help_url') }}/assets/images/icon_guide_top.png 1x,{{ env('help_url') }}/assets/images/icon_guide_top@2x.png 2x">
                    <span>ガイドTOPへ</span>
                </div>
            </a>
            <form action="{{ env('help_url') }}/delivery_services/search/" method="get">
                <div class="search_word">
                    <div class="text"><input class="input_text" type="text" value="" placeholder="ご利用ガイド内検索"></div>
                    <div class="submit opacity"><button class="button_submit" type="submit"><img src="{{ env('help_url') }}/assets/images/icon_search.png" alt="検索" width="18" height="18" srcset="{{ env('help_url') }}/assets/images/icon_search.png 1x,{{ env('help_url') }}/assets/images/icon_search@2x.png 2x"></button></div>
                </div>
            </form>
        </div>
    </div>

    <div class="header_wrap">
        <div class="container">
            <div class="menu_close sp"><a href="{{ env('help_url') }}"><img src="{{ env('help_url') }}/assets/images/menu_close.png" alt="transporter" width="46" height="46" srcset="{{ env('help_url') }}/assets/images/menu_close.png 1x,{{ env('help_url') }}/assets/images/menu_close@2x.png 2x"></a></div>
            <div class="h_top">
                <div class="h_logo pc"><a href="{{ env('www_url') }}"><img src="{{ env('help_url') }}/assets/images/h_logo.png" alt="transporter" width="283" height="55" srcset="{{ env('help_url') }}/assets/images/h_logo.png 1x,{{ env('help_url') }}/assets/images/h_logo@2x.png 2x"></a><span class="text">総合ご利用ガイド</span></div>
                <div class="h_search pc">
                    <ul>
                        <li class="left">
                    <form action="{{ env('help_url') }}/delivery_services/search/" method="get">
                        <div class="search_word">
                            <div class="text"><input class="input_text" type="text" value="" placeholder="ご利用ガイド内検索"></div>
                            <div class="submit opacity"><button class="button_submit" type="submit"><img src="{{ env('help_url') }}/assets/images/icon_search.png" alt="検索" width="18" height="18" srcset="{{ env('help_url') }}/assets/images/icon_search.png 1x,{{ env('help_url') }}/assets/images/icon_search@2x.png 2x"></button></div>
                        </div>
                    </form>
                        </li>
                        <li class="right">
                            <a href="{{ env('help_url') }}">
                                <div class="to_top_icon">
                                    <img src="{{ env('help_url') }}/assets/images/icon_guide_top.png" alt="" width="40" height="40" srcset="{{ env('help_url') }}/assets/images/icon_guide_top.png 1x,{{ env('help_url') }}/assets/images/icon_guide_top@2x.png 2x">
                                    <span>ガイドTOPへ</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            @include('include.common.help.side')

        </div>
    </div>
</header>


