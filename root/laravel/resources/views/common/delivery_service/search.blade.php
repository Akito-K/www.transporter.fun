@extends('layouts.common.www')
@section('content')

<div class="crumb">
    <div class="container">
        <ul>
            <li><a href="/">Home</a></li>
            <li><span>物流サービス情報一覧</span></li>
                    <li><span>フリーワード検索</span></li>
        </ul>
    </div>
</div>

<div class="page_request_search page_search page_main page_home">
    <div class="container">

        <article class="content">
            <h1 class="title_style03">フリーワード検索</h1>

            <section class="sec">
                <form action="{{ env('www_url') }}/delivery_services/search/" method="get">
                    <div class="box_orange box_orange_search mb0">
                        <div class="search_word mb20">
                            <div class="text"><input name="keywords" class="input_text" type="text" value="{{ urldecode(request()->keywords) }}" placeholder="フリーワード検索"></div>
                            <div class="submit opacity"><button class="button_submit" type="submit"><img src="{{ env('www_url') }}/assets/images/icon_search.png" alt="検索" width="18" height="18" srcset="{{ env('www_url') }}/assets/images/icon_search.png 1x,{{ env('www_url') }}/assets/images/icon_search@2x.png 2x"></button></div>
                        </div>
                    </div>
                </form>
            </section>

            <section class="sec">
                <div class="table">
                    <p class="f_bold f_large alC">該当件数　<span class="search_count f_bold f_large">{{ number_format(count($order_datas)) }}</span>　件</p>
                </div>
            </section>

            <section class="sec_service">
                <div class="container">
                    <h2 class="title_style01"><span class="inner">物流サービス情報</span></h2>
                    <p class="description">現在、見積り受付中の物流案件です。</p>
                    <ul class="list_service">
                        @include('include.common.www.delivery_services', ['order_datas' => $order_datas])
                    </ul>
                </div>
            </section>
        </article>

    </div>
    <div class="totop"><a class="scroll" href="#wrapper"></a></div>

</div><!-- .page_main -->

@endsection

