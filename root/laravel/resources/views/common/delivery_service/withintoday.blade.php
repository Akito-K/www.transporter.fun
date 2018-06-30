@extends('layouts.common.www')
@section('content')

<div class="crumb">
    <div class="container">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/delivery_services">物流サービス情報一覧</a></li>
            <li><span>本日中！</span></li>
        </ul>
    </div>
</div>

<div class="page_request_search page_search page_main page_home">
    <div class="container">

        <article class="content">
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

